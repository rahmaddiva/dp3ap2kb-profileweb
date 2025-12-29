<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class AuthController extends BaseController
{

    protected $userModel;
    protected $session;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->session = \Config\Services::session();
    }

    public function login()
    {
        $data = [
            'title' => 'Login',
        ];
        return view('auth/login', $data);
    }

    public function proses_login()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'username' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Username wajib diisi'

                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password wajib diisi'
                ]
            ],
        ]);

        // jika validasi gagal maka muncul error
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // ambil data dari form
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // cari user berdasarkan username
        $user = $this->userModel->where('username', $username)->first();
        if (!$user) {
            return redirect()->back()->withInput()->with('error', 'Username tidak ditemukan');
        }
        // verifikasi password
        if (!password_verify($password, $user['password'])) {
            return redirect()->back()->withInput()->with('error', 'Password salah');
        }

        // regenerate session id
        $this->session->regenerate();

        // set session
        $this->session->set([
            'isLoggedIn' => true,
            'id_users' => $user['id_users'],
            'username' => $user['username'],
            'nama' => $user['nama'],
            'role' => $user['role'],
        ]);
        return redirect()->to('/dashboard');
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/login');
    }
}
