<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ArtikelModel;



class ArtikelController extends BaseController
{
    protected $artikelModel;

    public function __construct()
    {
        $this->artikelModel = new ArtikelModel();
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
            $slug = uniqid('artikel-');
        }
        return $slug;
    }

    /**
     * Handle uploaded image: move to public/kelola-artikel and convert to webp when possible.
     * Returns relative path (e.g. 'artikel/filename.webp') or null.
     */
    private function handleImageUpload($file)
    {
        if (!$file || !$file->isValid()) {
            return null;
        }

        $tmpPath = $file->getTempName();
        $targetDir = FCPATH . 'artikel/';
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        // prefer to always save as webp
        $filename = uniqid('b_') . '.webp';
        $destPath = $targetDir . $filename;

        $converted = $this->convertImageToWebp($tmpPath, $destPath, 80);
        if ($converted) {
            return 'artikel/' . $filename;
        }

        // fallback: move original file keeping extension
        $origExt = strtolower($file->getClientExtension() ?: 'jpg');
        $fallbackName = uniqid('b_') . '.' . $origExt;
        try {
            $file->move($targetDir, $fallbackName);
            return 'artikel/' . $fallbackName;
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
        // menampilkan data artikel menggunakan datatable serverside
        if ($this->request->isAJAX()) {
            $draw = $this->request->getVar('draw');
            $start = $this->request->getVar('start');
            $length = $this->request->getVar('length');
            $searchValue = $this->request->getVar('search[value]');

            // total semua data
            $totalArtikel = $this->artikelModel->countAllResults();

            // total semua data
            $builder = $this->artikelModel;

            if ($searchValue) {
                $builder->groupStart()
                    ->like('title', $searchValue)
                    ->orLike('author', $searchValue)
                    ->groupEnd();
            }

            $builderFiltered = clone $builder;

            $totalFiltered = $builderFiltered->countAllResults(false);

            // ambil data sesuai limit dan offset
            $artikels = $builder->orderBy('id_artikel', 'DESC')
                ->findAll($length, $start);

            // simpan data array untuk datatable
            $data = [];
            $no = $start + 1;

            foreach ($artikels as $row) {
                // button edit, show, dan delete
                $editbtn = '<a href="' . site_url('kelola-artikel/' . $row['id_artikel'] . '/edit') . '" class="btn btn-sm btn-primary me-1">Edit</a>';
                $showbtn = '<a href="' . site_url('kelola-artikel/' . $row['id_artikel']) . '" class="btn btn-sm btn-info me-1">Show</a>';
                $deletebtn = '<form method="post" action="' . site_url('kelola-artikel/' . $row['id_artikel']) . '" style="display:inline;" onsubmit="return confirm(\'Apakah Anda yakin ingin menghapus artikel ini?\');">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                              </form>';
                $data[] = [
                    $no++,
                    esc($row['title']),
                    esc($row['author']),
                    esc($row['status']),
                    date('d F Y', strtotime($row['tanggal'])),
                    $editbtn . $showbtn . $deletebtn
                ];
            }
            $output = [
                "draw" => intval($draw),
                "recordsTotal" => $totalArtikel,
                "recordsFiltered" => $totalFiltered,
                "data" => $data
            ];

            return $this->response->setJSON($output);
        }

        $data = [
            'title' => 'Kelola Artikel',
        ];
        return view('artikel/index', $data);

    }

    public function show($id = null)
    {
        $artikel = $this->artikelModel->find($id);
        if (!$artikel) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Artikel dengan ID $id tidak ditemukan.");
        }

        $data = [
            'title' => 'Detail Artikel',
            'artikel' => $artikel
        ];

        return view('artikel/show', $data);
    }

    public function create()
    {
        return view('artikel/create', ['title' => 'Buat Artikel Baru']);
    }

    public function store()
    {
        // validasi input

        $rules = [
            'title' => 'required|max_length[255]',
            'content' => 'required',
            'author' => 'permit_empty|max_length[100]',
            'tanggal' => 'required|valid_date',
            'image' => 'permit_empty|is_image[image]|max_size[image,10000]|mime_in[image,image/jpg,image/jpeg,image/png,image/gif,image/webp]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // handle image upload + conversion to webp (only if provided)
        $imagePath = null;
        $imageFile = $this->request->getFile('image');
        if ($imageFile && $imageFile->isValid() && !$imageFile->hasMoved()) {
            $imagePath = $this->handleImageUpload($imageFile);
        }
        // generate slug from title and ensure uniqueness
        $title = $this->request->getPost('title');
        $slug = $this->createSlug($title);
        $baseSlug = $slug;
        $i = 1;
        while ($this->artikelModel->where('slug', $slug)->first()) {
            $slug = $baseSlug . '-' . $i;
            $i++;
        }

        // determine author: prefer posted value, otherwise use session username or fallback
        $author = $this->request->getPost('author') ?: (session()->get('username') ?? 'Admin');

        $data = [
            'title' => $title,
            'slug' => $slug,
            'content' => $this->request->getPost('content'),
            'author' => $author,
            'tanggal' => $this->request->getPost('tanggal'),
            'image' => $imagePath,
            'source' => $this->request->getPost('source'),
            'status' => $this->request->getPost('status') ?? 'draft',
            'created_at' => date('Y-m-d H:i:s'),
        ];


        $this->artikelModel->insert($data);
        session()->setFlashdata('success', 'Artikel berhasil dibuat.');
        return redirect()->to('/kelola-artikel');
    }

    public function edit($id = null)
    {
        $artikel = $this->artikelModel->find($id);
        if (!$artikel) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Artikel dengan ID $id tidak ditemukan.");
        }

        $data = [
            'title' => 'Edit Artikel',
            'artikel' => $artikel
        ];

        return view('artikel/edit', $data);
    }


    public function update($id = null)
    {
        $artikel = $this->artikelModel->find($id);
        if (!$artikel) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Artikel dengan ID $id tidak ditemukan.");
        }

        // validasi input
        $rules = [
            'title' => 'required|max_length[255]',
            'content' => 'required',
            'author' => 'required|max_length[100]',
            'tanggal' => 'required|valid_date',
            'image' => 'max_size[image,10000]|is_image[image]|mime_in[image,image/jpg,image/jpeg,image/png,image/gif,image/webp]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // handle image upload if provided
        $imageFile = $this->request->getFile('image');
        $imagePath = null;
        if ($imageFile && $imageFile->isValid() && !$imageFile->hasMoved()) {
            $imagePath = $this->handleImageUpload($imageFile);
        }

        // generate slug from title and ensure uniqueness
        $title = $this->request->getPost('title');
        $slug = $this->createSlug($title);
        $baseSlug = $slug;
        $i = 1;
        while ($this->artikelModel->where('slug', $slug)->first()) {
            $slug = $baseSlug . '-' . $i++;
        }

        $data = [
            'title' => $title,
            'slug' => $slug,
            'content' => $this->request->getPost('content'),
            'author' => $this->request->getPost('author'),
            'tanggal' => $this->request->getPost('tanggal'),
            'source' => $this->request->getPost('source'),
            'status' => $this->request->getPost('status') ?? 'draft',
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $this->artikelModel->update($id, $data);
        // delete old image if new one uploaded
        if ($imagePath && !empty($artikel['image']) && $artikel['image'] !== $imagePath) {
            $oldImagePath = FCPATH . $artikel['image'];
            if (is_file($oldImagePath) && file_exists($oldImagePath)) {
                @unlink($oldImagePath);
            }
        }
        session()->setFlashdata('success', 'Artikel berhasil diperbarui.');
        return redirect()->to('/kelola-artikel');
    }

    public function delete($id = null)
    {
        $artikel = $this->artikelModel->find($id);
        if (!$artikel) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Artikel dengan ID $id tidak ditemukan.");
        }

        // delete associated image file
        if (!empty($artikel['image'])) {
            $imagePath = FCPATH . $artikel['image'];
            if (is_file($imagePath) && file_exists($imagePath)) {
                @unlink($imagePath);
            }
        }
        $this->artikelModel->delete($id);
        session()->setFlashdata('success', 'Artikel berhasil dihapus.');
        return redirect()->to('/kelola-artikel');
    }




}
