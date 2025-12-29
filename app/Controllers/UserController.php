<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;
class UserController extends BaseController
{

    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function index()
    {
        $data = [
            'title' => 'User List',
            'users' => $this->userModel->findAll(),
        ];
        return view('user/index', $data);

    }

    public function show($id)
    {
        $user = $this->userModel->find($id);
        if (!$user) {
            return redirect()->back()->with('error', 'User not found');
        }

        $data = [
            'title' => 'User Details',
            'user' => $user,
        ];
        return view('user/show', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Create User',
        ];
        return view('user/create', $data);
    }

    public function store()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'username' => 'required|is_unique[users.username]',
            'password' => 'required|min_length[6]',
            'email' => 'required|valid_email|is_unique[users.email]',
        ]);
        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }
        $this->userModel->save([
            'nama' => $this->request->getPost('nama'),
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_BCRYPT),
            'email' => $this->request->getPost('email'),
            'role' => 'Admin',
        ]);
        return redirect()->to('/kelola-users')->with('success', 'User created successfully');
    }

    public function edit($id)
    {
        $user = $this->userModel->find($id);
        if (!$user) {
            return redirect()->back()->with('error', 'User not found');
        }
        $data = [
            'title' => 'Edit User',
            'user' => $user,
        ];
        return view('user/edit', $data);
    }

    public function update($id)
    {
        $user = $this->userModel->find($id);
        if (!$user) {
            return redirect()->back()->with('error', 'User not found');
        }

        $validation = \Config\Services::validation();
        $rules = [
            'nama' => 'required',
            'email' => 'required|valid_email',
        ];

        if ($this->request->getPost('username') !== $user['username']) {
            $rules['username'] = 'required|is_unique[users.username]';
        }

        if ($this->request->getPost('password')) {
            $rules['password'] = 'min_length[6]';
        }

        $validation->setRules($rules);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $updateData = [
            'nama' => $this->request->getPost('nama'),
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
        ];

        if ($this->request->getPost('password')) {
            $updateData['password'] = password_hash($this->request->getPost('password'), PASSWORD_BCRYPT);
        }

        $this->userModel->update($id, $updateData);
        return redirect()->to('/kelola-users')->with('success', 'User updated successfully');
    }

    public function delete($id)
    {
        $user = $this->userModel->find($id);
        if (!$user) {
            return redirect()->back()->with('error', 'User not found');
        }
        $this->userModel->delete($id);
        return redirect()->to('/kelola-users')->with('success', 'User deleted successfully');
    }

}
