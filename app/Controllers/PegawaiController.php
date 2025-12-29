<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PegawaiModel;

class PegawaiController extends BaseController
{

    protected $pegawaiModel;

    public function __construct()
    {
        $this->pegawaiModel = new PegawaiModel();
    }

    public function index()
    {
        $data['pegawai'] = $this->pegawaiModel->findAll();
        return view('pegawai/index', $data);
    }

    public function store()
    {
        // validasi input data pegawai
        $allowedJabatan = [
            'Kepala Dinas',
            'Sekretaris',
            'Sub Bagian Perencanaan dan Keuangan',
            'Sub Bagian Umum dan Kepegawaian',
            'Kepala Bidang Keluarga Berencana dan Keluarga Sejahtera',
            'Kepala Bidang Pengendalian Penduduk Data dan Informasi',
            'Kepala Bidang Pemberdayaan Perempuan dan Perlindungan Anak',
            'Kepala UPTD PPA',
            'Jabatan Fungsional Lainnya',
            'Pegawai Outsorcing'
        ];

        $exceptions = [
            'Jabatan Fungsional Lainnya',
            'Pegawai Outsorcing'
        ];

        $jabatan = $this->request->getPost('jabatan');

        // dasar rule untuk jabatan: required dan harus salah satu dari enum
        $jabatanRule = 'required|in_list[' . implode(',', $allowedJabatan) . ']';
        // kecualikan beberapa jabatan dari aturan unik
        if (!in_array($jabatan, $exceptions)) {
            $jabatanRule .= '|is_unique[pegawai.jabatan]';
        }

        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama' => 'required',
            'nip' => 'required',
            'jabatan' => $jabatanRule,

        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        // proses upload gambar (opsional)
        $imageFile = $this->request->getFile('image');
        $imageName = null;
        if ($imageFile && $imageFile->isValid() && $imageFile->getSize() > 0) {
            $allowedMimes = ['image/jpg', 'image/jpeg', 'image/png'];
            if ($imageFile->getSize() <= 2048 * 1024 && in_array($imageFile->getClientMimeType(), $allowedMimes)) {
                $imageName = $imageFile->getRandomName();
                $imageFile->move(FCPATH . 'foto_pegawai', $imageName);
            } else {
                return redirect()->back()->withInput()->with('errors', ['image' => 'File gambar tidak valid atau melebihi ukuran 2MB.']);
            }
        }

        // simpan data pegawai ke database
        $this->pegawaiModel->insert([
            'nama' => $this->request->getPost('nama'),
            'nip' => $this->request->getPost('nip'),
            'jabatan' => $jabatan,
            'image' => $imageName
        ]);

        return redirect()->to('/kelola-pegawai')->with('success', 'Data pegawai berhasil ditambahkan.');
    }

    public function update($id)
    {
        // validasi input data pegawai untuk update
        $allowedJabatan = [
            'Kepala Dinas',
            'Sekretaris',
            'Sub Bagian Perencanaan dan Keuangan',
            'Sub Bagian Umum dan Kepegawaian',
            'Kepala Bidang Keluarga Berencana dan Keluarga Sejahtera',
            'Kepala Bidang Pengendalian Penduduk Data dan Informasi',
            'Kepala Bidang Pemberdayaan Perempuan dan Perlindungan Anak',
            'Kepala UPTD PPA',
            'Jabatan Fungsional Lainnya',
            'Pegawai Outsorcing'
        ];

        $exceptions = [
            'Jabatan Fungsional Lainnya',
            'Pegawai Outsorcing'
        ];

        $jabatan = $this->request->getPost('jabatan');

        $jabatanRule = 'required|in_list[' . implode(',', $allowedJabatan) . ']';
        if (!in_array($jabatan, $exceptions)) {
            // saat update, abaikan record saat ini dengan menambahkan id pada is_unique
            $jabatanRule .= '|is_unique[pegawai.jabatan,id_pegawai,' . $id . ']';
        }

        $nipRule = 'required|is_unique[pegawai.nip,id_pegawai,' . $id . ']';

        $validation = \Config\Services::validation();
        $validation->setRules([
            'nama' => 'required',
            'nip' => $nipRule,
            'jabatan' => $jabatanRule,
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $data = [
            'nama' => $this->request->getPost('nama'),
            'nip' => $this->request->getPost('nip'),
            'jabatan' => $jabatan
        ];

        // jika ada file image baru, proses upload dan masukkan ke data
        $imageFile = $this->request->getFile('image');
        if ($imageFile && $imageFile->isValid() && !$imageFile->hasMoved()) {
            $imageName = $imageFile->getRandomName();
            $imageFile->move(FCPATH . 'foto_pegawai', $imageName);

            // hapus file gambar lama jika ada setelah upload berhasil
            $current = $this->pegawaiModel->find($id);
            if ($current && !empty($current['image'])) {
                $oldPath = FCPATH . 'foto_pegawai' . DIRECTORY_SEPARATOR . $current['image'];
                if (is_file($oldPath)) {
                    @unlink($oldPath);
                }
            }

            $data['image'] = $imageName;
        }

        $this->pegawaiModel->update($id, $data);
        return redirect()->to('/kelola-pegawai')->with('success', 'Data pegawai berhasil diupdate.');
    }

    public function delete($id)
    {
        // hapus data pegawai beserta gambarnya
        $pegawai = $this->pegawaiModel->find($id);
        if ($pegawai) {
            // hapus file gambar jika ada
            if (!empty($pegawai['image'])) {
                $imagePath = FCPATH . 'foto_pegawai' . DIRECTORY_SEPARATOR . $pegawai['image'];
                if (is_file($imagePath)) {
                    @unlink($imagePath);
                }
            }
            $this->pegawaiModel->delete($id);
            return redirect()->to('/kelola-pegawai')->with('success', 'Data pegawai berhasil dihapus.');
        }
        return redirect()->to('/kelola-pegawai')->with('error', 'Data pegawai tidak ditemukan.');
    }
}
