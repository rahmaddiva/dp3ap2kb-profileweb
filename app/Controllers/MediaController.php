<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\MediaModel;
use App\Models\MediaFilesModel;

class MediaController extends BaseController
{

    protected $mediaModel;

    protected $mediaFilesModel;

    public function __construct()
    {
        $this->mediaModel = new MediaModel();
        $this->mediaFilesModel = new MediaFilesModel();
    }

    private function convertImageToWebp(string $sourcePath, string $destPath, int $quality = 80): bool
    {
        if (!file_exists($sourcePath))
            return false;

        $info = @getimagesize($sourcePath);
        if (!$info)
            return false;

        $mime = $info['mime'];

        switch ($mime) {
            case 'image/jpeg':
            case 'image/pjpeg':
                $image = @imagecreatefromjpeg($sourcePath);
                break;
            case 'image/png':
                $image = @imagecreatefrompng($sourcePath);
                break;
            case 'image/gif':
                $image = @imagecreatefromgif($sourcePath);
                break;
            case 'image/webp':
                $image = @imagecreatefromwebp($sourcePath);
                break;
            default:
                return false;
        }

        if (!$image)
            return false;

        // Preserve alpha for PNG
        if ($mime === 'image/png') {
            imagepalettetotruecolor($image);
            imagealphablending($image, false);
            imagesavealpha($image, true);
        }

        $ok = @imagewebp($image, $destPath, $quality);
        imagedestroy($image);
        return (bool) $ok;
    }

    private function createThumbnail(string $sourcePath, string $destPath, int $maxWidth = 300): bool
    {
        if (!file_exists($sourcePath))
            return false;
        $info = @getimagesize($sourcePath);
        if (!$info)
            return false;

        $width = $info[0];
        $height = $info[1];
        $ratio = $width / $height;
        $newWidth = $maxWidth;
        $newHeight = (int) round($newWidth / $ratio);

        $mime = $info['mime'];

        switch ($mime) {
            case 'image/webp':
                $srcImg = @imagecreatefromwebp($sourcePath);
                break;
            case 'image/jpeg':
            case 'image/pjpeg':
                $srcImg = @imagecreatefromjpeg($sourcePath);
                break;
            case 'image/png':
                $srcImg = @imagecreatefrompng($sourcePath);
                break;
            default:
                return false;
        }

        if (!$srcImg)
            return false;

        $thumb = imagecreatetruecolor($newWidth, $newHeight);
        // preserve transparency for png/webp
        imagealphablending($thumb, false);
        imagesavealpha($thumb, true);

        imagecopyresampled($thumb, $srcImg, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

        $ok = imagewebp($thumb, $destPath, 80);
        imagedestroy($thumb);
        imagedestroy($srcImg);
        return (bool) $ok;
    }
    public function index()
    {
        // menampilkan daftar media menggunakan datatable serverside
        if ($this->request->isAJAX()) {
            $draw = $this->request->getVar('draw');
            $start = $this->request->getVar('start');
            $length = $this->request->getVar('length');
            $searchValue = $this->request->getVar('search[value]');

            // total semua data
            $totalMedia = $this->mediaModel->countAllResults();

            // total semua data
            $builder = $this->mediaModel;

            if ($searchValue) {
                $builder = $builder->like('title', $searchValue)
                    ->orLike('author', $searchValue)
                    ->orLike('kategori', $searchValue)
                    ->orLike('status', $searchValue);
            }

            $builderFiltered = clone $builder;
            $totalFiltered = $builderFiltered->countAllResults(false);

            // ambil data sesuai limit dan offset
            $media = $builder->orderBy('created_at', 'DESC')
                ->findAll($length, $start);

            // simpan data array untuk datatable
            $data = [];
            $no = $start + 1;

            foreach ($media as $row) {
                // button edit, show dan delete
                $editbtn = '<a href="' . site_url('kelola-media/edit/' . $row['id_media']) . '" class="btn btn-sm btn-primary me-1">Edit</a>';
                $showbtn = '<a href="' . site_url('kelola-media/' . $row['id_media']) . '" class="btn btn-sm btn-info me-1">Show</a>';
                $deletebtn = '<form method="post" action="' . site_url('kelola-media/' . $row['id_media']) . '" onsubmit="return confirm(\'Hapus media ini?\');" style="display:inline;">
                                ' . csrf_field() . '
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
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
                'draw' => intval($draw),
                'recordsTotal' => $totalMedia,
                'recordsFiltered' => $totalFiltered,
                'data' => $data
            ];

            return $this->response->setJSON($output);

        }

        $data = [
            'title' => 'Kelola Media'
        ];
        return view('media/index', $data);
    }


    public function create()
    {
        $data = [
            'title' => 'Tambah Media'
        ];
        return view('media/create', $data);
    }

    public function show($id = null)
    {
        if (empty($id)) {
            return redirect()->to(site_url('/kelola-media'))->with('error', 'ID media tidak ditemukan');
        }

        $media = $this->mediaModel->find($id);
        if (!$media) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Media tidak ditemukan: ' . $id);
        }

        $files = $this->mediaFilesModel->where('media_id', $id)->orderBy('is_cover', 'DESC')->orderBy('`order`', 'ASC')->findAll();

        $data = [
            'title' => 'Detail Media',
            'media' => $media,
            'files' => $files
        ];

        return view('media/show', $data);
    }

    public function edit($id = null)
    {
        if (empty($id)) {
            return redirect()->to(site_url('/kelola-media'))->with('error', 'ID media tidak ditemukan');
        }

        $media = $this->mediaModel->find($id);
        if (!$media) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Media tidak ditemukan: ' . $id);
        }

        $files = $this->mediaFilesModel->where('media_id', $id)->orderBy('is_cover', 'DESC')->orderBy('`order`', 'ASC')->findAll();

        $data = [
            'title' => 'Edit Media',
            'media' => $media,
            'files' => $files
        ];

        return view('media/edit', $data);
    }

    public function update($id = null)
    {
        helper(['text']);

        if (empty($id)) {
            return redirect()->to(site_url('/kelola-media'))->with('error', 'ID media tidak ditemukan');
        }

        $media = $this->mediaModel->find($id);
        if (!$media) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Media tidak ditemukan: ' . $id);
        }

        $post = $this->request->getPost();

        $rules = [
            'title' => 'required|min_length[3]',
            'kategori' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $db = \Config\Database::connect();
        $db->transStart();

        try {
            $title = $post['title'];
            // update slug only if title changed
            $slug = $media['slug'];
            if ($title !== $media['title']) {
                $slug = url_title($title, '-', true);
                $baseSlug = $slug;
                $i = 1;
                while ($this->mediaModel->where('slug', $slug)->where('id_media !=', $id)->first()) {
                    $slug = $baseSlug . '-' . $i++;
                }
            }

            $mediaData = [
                'title' => $title,
                'slug' => $slug,
                'content' => $post['content'] ?? null,
                'author' => $post['author'] ?? session()->get('username') ?? 'Admin',
                'tanggal' => $post['tanggal'] ?? $media['tanggal'] ?? date('Y-m-d'),
                'kategori' => $post['kategori'] ?? null,
                'source' => $post['source'] ?? null,
                'status' => $post['status'] ?? 'draft',
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $this->mediaModel->update($id, $mediaData);

            // handle delete selected files
            $deleteFiles = $this->request->getPost('delete_files') ?? [];
            if (!empty($deleteFiles) && is_array($deleteFiles)) {
                foreach ($deleteFiles as $fid) {
                    $f = $this->mediaFilesModel->find($fid);
                    if ($f) {
                        $diskPath = FCPATH . $f['filepath'];
                        if (file_exists($diskPath))
                            @unlink($diskPath);
                        $this->mediaFilesModel->delete($fid);
                    }
                }
            }

            // handle new uploaded files (same logic as store)
            $uploaded = $this->request->getFiles();
            $files = $uploaded['media_files'] ?? [];
            if ($files instanceof \CodeIgniter\HTTP\Files\UploadedFile)
                $files = [$files];
            if (!is_array($files))
                $files = [];

            $targetBase = FCPATH . 'uploads/media/' . date('Y/m');
            if (!is_dir($targetBase))
                mkdir($targetBase, 0755, true);

            $orderMax = (int) $this->mediaFilesModel->where('media_id', $id)->select('MAX(`order`) as mo')->first()['mo'] ?? 0;
            $order = $orderMax + 1;

            foreach ($files as $file) {
                if (!$file instanceof \CodeIgniter\HTTP\Files\UploadedFile)
                    continue;
                if (!$file->isValid() || $file->getError() !== UPLOAD_ERR_OK)
                    continue;

                $clientMime = $file->getClientMimeType();
                $ext = $file->getClientExtension() ?: pathinfo($file->getName(), PATHINFO_EXTENSION);
                $random = bin2hex(random_bytes(6));
                $rawName = $id . '_' . time() . '_' . $random . '.' . $ext;

                try {
                    $moved = $file->move($targetBase, $rawName);
                } catch (\Throwable $e) {
                    $moved = false;
                }
                if (!$moved) {
                    log_message('error', 'Media update upload move failed: ' . $file->getName());
                    continue;
                }

                $storedRelDir = 'uploads/media/' . date('Y/m') . '/';
                $storedPath = $storedRelDir . $rawName;
                $storedMime = $clientMime;
                $storedSize = filesize($targetBase . '/' . $rawName);

                if (strpos($clientMime, 'image/') === 0) {
                    $src = $targetBase . '/' . $rawName;
                    $webpName = pathinfo($rawName, PATHINFO_FILENAME) . '.webp';
                    $webpPath = $targetBase . '/' . $webpName;
                    $convertOk = $this->convertImageToWebp($src, $webpPath, 80);
                    if ($convertOk) {
                        @unlink($src);
                        $storedPath = $storedRelDir . $webpName;
                        $storedMime = 'image/webp';
                        $storedSize = filesize($webpPath);
                        $thumbName = 'thumb_' . pathinfo($webpName, PATHINFO_FILENAME) . '.webp';
                        $thumbPath = $targetBase . '/' . $thumbName;
                        $this->createThumbnail($webpPath, $thumbPath, 300);
                    }
                }

                $fileData = [
                    'media_id' => $id,
                    'filename' => basename($storedPath),
                    'filepath' => $storedPath,
                    'mime' => $storedMime,
                    'size' => $storedSize,
                    'is_cover' => 0,
                    'order' => $order,
                    'created_at' => date('Y-m-d H:i:s')
                ];

                $this->mediaFilesModel->insert($fileData);
                $order++;
            }

            $db->transComplete();
            if ($db->transStatus() === false)
                throw new \Exception('Transaksi gagal');

            return redirect()->to(site_url('/kelola-media'))->with('success', 'Media berhasil diperbarui');

        } catch (\Throwable $e) {
            $db->transRollback();
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function store()
    {
        helper(['text']);

        $post = $this->request->getPost();

        $rules = [
            'title' => 'required|min_length[3]',
            'kategori' => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $db = \Config\Database::connect();
        $db->transStart();

        try {
            $title = $post['title'];
            $slug = url_title($title, '-', true);
            $baseSlug = $slug;
            $i = 1;
            while ($this->mediaModel->where('slug', $slug)->first()) {
                $slug = $baseSlug . '-' . $i++;
            }

            $mediaData = [
                'title' => $title,
                'slug' => $slug,
                'content' => $post['content'] ?? null,
                'author' => $post['author'] ?? session()->get('username') ?? 'Admin',
                'tanggal' => $post['tanggal'] ?? date('Y-m-d'),
                'kategori' => $post['kategori'] ?? null,
                'source' => $post['source'] ?? null,
                'status' => $post['status'] ?? 'draft',
                'created_at' => date('Y-m-d H:i:s')
            ];

            $mediaId = $this->mediaModel->insert($mediaData);
            if (!$mediaId) {
                throw new \Exception('Gagal menyimpan data media');
            }

            $uploaded = $this->request->getFiles();
            $files = $uploaded['media_files'] ?? [];
            $targetBase = FCPATH . 'uploads/media/' . date('Y/m');
            if (!is_dir($targetBase)) {
                mkdir($targetBase, 0755, true);
            }

            $order = 0;
            $isFirst = true;

            foreach ($files as $file) {
                if (!$file instanceof \CodeIgniter\HTTP\Files\UploadedFile)
                    continue;
                if (!$file->isValid() || $file->getError() !== UPLOAD_ERR_OK)
                    continue;

                $clientMime = $file->getClientMimeType();
                $size = $file->getSize();
                $ext = $file->getClientExtension() ?: pathinfo($file->getName(), PATHINFO_EXTENSION);
                $random = bin2hex(random_bytes(6));
                $rawName = $mediaId . '_' . time() . '_' . $random . '.' . $ext;

                $moved = $file->move($targetBase, $rawName);
                if (!$moved)
                    continue;

                $storedRelDir = 'uploads/media/' . date('Y/m') . '/';
                $storedPath = $storedRelDir . $rawName;
                $storedMime = $clientMime;
                $storedSize = filesize($targetBase . '/' . $rawName);

                // If image, convert to webp and create thumbnail
                if (strpos($clientMime, 'image/') === 0) {
                    $src = $targetBase . '/' . $rawName;
                    $webpName = pathinfo($rawName, PATHINFO_FILENAME) . '.webp';
                    $webpPath = $targetBase . '/' . $webpName;
                    $convertOk = $this->convertImageToWebp($src, $webpPath, 80);
                    if ($convertOk) {
                        // remove original file
                        @unlink($src);
                        $storedPath = $storedRelDir . $webpName;
                        $storedMime = 'image/webp';
                        $storedSize = filesize($webpPath);

                        // thumbnail
                        $thumbName = 'thumb_' . pathinfo($webpName, PATHINFO_FILENAME) . '.webp';
                        $thumbPath = $targetBase . '/' . $thumbName;
                        $this->createThumbnail($webpPath, $thumbPath, 300);
                    }
                }

                $fileData = [
                    'media_id' => $mediaId,
                    'filename' => basename($storedPath),
                    'filepath' => $storedPath,
                    'mime' => $storedMime,
                    'size' => $storedSize,
                    'is_cover' => $isFirst ? 1 : 0,
                    'order' => $order,
                    'created_at' => date('Y-m-d H:i:s')
                ];


                $this->mediaFilesModel->insert($fileData);
                $isFirst = false;
                $order++;
            }

            $db->transComplete();

            if ($db->transStatus() === false) {
                throw new \Exception('Transaksi gagal');
            }

            return redirect()->to(site_url('/kelola-media'))->with('success', 'Media berhasil disimpan');

        } catch (\Throwable $e) {
            $db->transRollback();
            return redirect()->back()->withInput()->with('error', $e->getMessage());
        }
    }


    public function delete($id = null)
    {
        if (empty($id)) {
            return redirect()->to(site_url('/kelola-media'))->with('error', 'ID media tidak ditemukan');
        }

        $media = $this->mediaModel->find($id);
        if (!$media) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Media tidak ditemukan: ' . $id);
        }

        $db = \Config\Database::connect();
        $db->transStart();

        try {
            // delete associated files from disk and database
            $files = $this->mediaFilesModel->where('media_id', $id)->findAll();
            foreach ($files as $f) {
                $diskPath = FCPATH . $f['filepath'];
                if (file_exists($diskPath))
                    @unlink($diskPath);
                $this->mediaFilesModel->delete($f['id']);
            }

            // delete media record
            $this->mediaModel->delete($id);

            $db->transComplete();
            if ($db->transStatus() === false)
                throw new \Exception(message: 'Transaksi gagal');
            return redirect()->to(site_url('/kelola-media'))->with('success', 'Media berhasil dihapus');
        } catch (\Throwable $e) {
            $db->transRollback();
            return redirect()->to(site_url('/kelola-media'))->with('error', $e->getMessage());
        }
    }

}
