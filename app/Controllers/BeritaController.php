<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\BeritaModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class BeritaController extends BaseController
{
    protected $beritaModel;

    public function __construct()
    {
        $this->beritaModel = new BeritaModel();
    }

    /**
     * Create a URL-friendly slug from a string.
     */
    private function createSlug(string $title): string
    {
        $slug = strtolower($title);
        // replace non-alphanumeric characters with hyphens
        $slug = preg_replace('/[^a-z0-9]+/i', '-', $slug);
        // collapse multiple hyphens, trim
        $slug = preg_replace('/-+/', '-', $slug);
        $slug = trim($slug, '-');
        if ($slug === '') {
            $slug = uniqid('berita-');
        }
        return $slug;
    }

    /**
     * Handle uploaded image: move to public/kelola-berita and convert to webp when possible.
     * Returns relative path (e.g. 'berita/filename.webp') or null.
     */
    private function handleImageUpload($file)
    {
        if (!$file || !$file->isValid()) {
            return null;
        }

        $tmpPath = $file->getTempName();
        $targetDir = FCPATH . 'berita/';
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        // prefer to always save as webp
        $filename = uniqid('b_') . '.webp';
        $destPath = $targetDir . $filename;

        $converted = $this->convertImageToWebp($tmpPath, $destPath, 80);
        if ($converted) {
            return 'berita/' . $filename;
        }

        // fallback: move original file keeping extension
        $origExt = strtolower($file->getClientExtension() ?: 'jpg');
        $fallbackName = uniqid('b_') . '.' . $origExt;
        try {
            $file->move($targetDir, $fallbackName);
            return 'berita/' . $fallbackName;
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Convert various image types to webp using GD. Returns true on success.
     */
    private function convertImageToWebp($src, $dest, $quality = 80)
    {
        if (!file_exists($src))
            return false;
        $info = @getimagesize($src);
        if (!$info || empty($info['mime']))
            return false;
        $mime = $info['mime'];

        switch ($mime) {
            case 'image/jpeg':
                $img = imagecreatefromjpeg($src);
                break;
            case 'image/png':
                $img = imagecreatefrompng($src);
                // ensure truecolor and alpha preserved
                imagepalettetotruecolor($img);
                imagealphablending($img, true);
                imagesavealpha($img, true);
                break;
            case 'image/gif':
                $img = imagecreatefromgif($src);
                break;
            case 'image/webp':
                // already webp - copy
                return copy($src, $dest);
            default:
                return false;
        }

        if (!$img)
            return false;
        if (!function_exists('imagewebp')) {
            imagedestroy($img);
            return false;
        }

        $ok = imagewebp($img, $dest, $quality);
        imagedestroy($img);
        return $ok;
    }

    public function index()
    {
        // menampilkan data berita menggunakan datatable serverside
        if ($this->request->isAJAX()) {
            $draw = $this->request->getVar('draw');
            $start = $this->request->getVar('start');
            $length = $this->request->getVar('length');
            $search = $this->request->getVar('search')['value'];


            // total semua data
            $totalData = $this->beritaModel->countAllResults();

            // total semua data
            $builder = $this->beritaModel;

            if ($search) {
                $builder->groupStart()
                    ->like('title', $search)
                    ->orLike('author', $search)
                    ->orLike('status', $search)
                    ->groupEnd();
            }

            $builderFiltered = clone $builder;

            $totalFiltered = $builderFiltered->countAllResults(false);

            // ambil data sesuai limit & offset
            $berita = $builder->orderBy('id_berita', 'DESC')->findAll($length, $start);

            // simpan data array untuk datatable

            $data = [];
            $no = $start + 1;

            foreach ($berita as $row) {
                // button edit, show, dan delete
                $editbtn = '<a href="/kelola-berita/' . $row['id_berita'] . '/edit" class="btn btn-sm btn-primary me-1 mb-1">Edit</a>';
                $showbtn = '<a href="/kelola-berita/' . $row['id_berita'] . '" class="btn btn-sm btn-info me-1 mb-1">Show</a>';
                $deletebtn = '<form action="/kelola-berita/' . $row['id_berita'] . '" method="post" class="d-inline">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-sm btn-danger mb-1" onclick="return confirm(\'Apakah Anda yakin ingin menghapus berita ini?\')">Delete</button>
                              </form>';
                $data[] = [
                    $no++,
                    esc($row['title']),
                    esc($row['author']),
                    esc($row['status']),
                    esc($row['published_at']),
                    $editbtn . $showbtn . $deletebtn
                ];
            }

            $output = [
                'draw' => intval($draw),
                'recordsTotal' => $totalData,
                'recordsFiltered' => $totalFiltered,
                'data' => $data
            ];

            return $this->response->setJSON($output);
        }

        $data = [
            'title' => 'Kelola Berita'
        ];
        return view('berita/index', $data);

    }

    public function show($id = null)
    {
        $berita = $this->beritaModel->find($id);
        if (!$berita) {
            throw PageNotFoundException::forPageNotFound('Berita tidak ditemukan: ' . $id);
        }

        return view('berita/show', [
            'title' => $berita['title'],
            'berita' => $berita,
        ]);
    }

    public function create()
    {
        return view('berita/create', [
            'title' => 'Tambah Berita'
        ]);
    }

    public function store()
    {
        // basic validation (slug removed from form — generated server-side)
        $rules = [
            'title' => 'required|min_length[3]',
            'content' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Handle image upload + conversion to webp
        $imageFile = $this->request->getFile('image');
        $imagePath = $this->handleImageUpload($imageFile);
        // generate slug from title and ensure uniqueness
        $title = $this->request->getPost('title');
        $slug = $this->createSlug($title);
        $baseSlug = $slug;
        $i = 1;
        while ($this->beritaModel->where('slug', $slug)->first()) {
            $slug = $baseSlug . '-' . $i++;
        }

        $data = [
            'title' => $title,
            'slug' => $slug,
            'excerpt' => $this->request->getPost('excerpt'),
            'content' => $this->request->getPost('content'),
            'image' => $imagePath,
            'source' => $this->request->getPost('source'),
            'author' => session()->get('role'),
            'status' => $this->request->getPost('status') ?? 'draft',
            'tanggal' => $this->request->getPost('tanggal'),
            'published_at' => date('Y-m-d H:i:s'),
            'created_at' => date('Y-m-d H:i:s'),
        ];

        $this->beritaModel->insert($data);
        session()->setFlashdata('success', 'Berita berhasil disimpan.');
        return redirect()->to('/kelola-berita');
    }

    public function edit($id = null)
    {
        $berita = $this->beritaModel->find($id);
        if (!$berita) {
            throw PageNotFoundException::forPageNotFound('Berita tidak ditemukan: ' . $id);
        }

        return view('berita/edit', [
            'title' => 'Edit Berita',
            'berita' => $berita
        ]);
    }

    public function update($id = null)
    {
        $berita = $this->beritaModel->find($id);
        if (!$berita) {
            throw PageNotFoundException::forPageNotFound('Berita tidak ditemukan: ' . $id);
        }

        // validate input
        $rules = [
            'title' => 'required|min_length[3]',
            'content' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Handle image upload if provided
        $imageFile = $this->request->getFile('image');
        $imagePath = null;
        if ($imageFile && $imageFile->isValid() && !$imageFile->hasMoved()) {
            $imagePath = $this->handleImageUpload($imageFile);
        }

        // generate slug from title and ensure uniqueness (exclude current record)
        $title = $this->request->getPost('title');
        $slug = $this->createSlug($title);
        $baseSlug = $slug;
        $i = 1;
        while ($this->beritaModel->where('slug', $slug)->where('id_berita !=', $id)->first()) {
            $slug = $baseSlug . '-' . $i++;
        }

        $data = [
            'title' => $title,
            'slug' => $slug,
            'excerpt' => $this->request->getPost('excerpt'),
            'content' => $this->request->getPost('content'),
            'image' => $imagePath ?: $berita['image'],
            'source' => $this->request->getPost('source'),
            'author' => session()->get('role'),
            'status' => $this->request->getPost('status') ?? 'draft',
            'tanggal' => $this->request->getPost('tanggal'),
            'published_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $this->beritaModel->update($id, $data);
        // Delete old image file if a new one was uploaded
        if ($imagePath && !empty($berita['image']) && $berita['image'] !== $imagePath) {
            $oldFile = FCPATH . $berita['image'];
            if (is_file($oldFile) && file_exists($oldFile)) {
                @unlink($oldFile);
            }
        }
        session()->setFlashdata('success', 'Berita berhasil diperbarui.');
        return redirect()->to('/kelola-berita');
    }

    public function delete($id = null)
    {
        $berita = $this->beritaModel->find($id);
        if (!$berita) {
            return redirect()->back()->with('error', 'Berita tidak ditemukan.');
        }

        // delete image file from filesystem if exists
        if (!empty($berita['image'])) {
            $filePath = FCPATH . $berita['image'];
            if (is_file($filePath) && file_exists($filePath)) {
                @unlink($filePath);
            }
        }

        $this->beritaModel->delete($id);
        session()->setFlashdata('success', 'Berita berhasil dihapus.');
        return redirect()->to('/kelola-berita');
    }


}

