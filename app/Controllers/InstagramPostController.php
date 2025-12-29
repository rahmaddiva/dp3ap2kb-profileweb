<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\InstagramPostModel;

class InstagramPostController extends BaseController
{

    protected $instagramPostModel;

    public function __construct()
    {
        $this->instagramPostModel = new InstagramPostModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Instagram Posts',
            'posts' => $this->instagramPostModel->findAll()
        ];
        return view('instagram_posts/index', $data);
    }

    public function activatePost($id): ResponseInterface
    {
        $post = $this->instagramPostModel->find($id);
        if ($post) {
            $this->instagramPostModel->update($id, ['is_active' => 1]);
            return redirect()->back()->with('success', 'Instagram post activated successfully.');
        }
        return redirect()->back()->with('error', 'Instagram post not found.');
    }

    public function deactivatePost($id): ResponseInterface
    {
        $post = $this->instagramPostModel->find($id);
        if ($post) {
            $this->instagramPostModel->update($id, ['is_active' => 0]);
            return redirect()->back()->with('success', 'Instagram post deactivated successfully.');
        }
        return redirect()->back()->with('error', 'Instagram post not found.');
    }

    public function store()
    {
        // validasi input 
        $validation = \Config\Services::validation();
        $validation->setRules([
            // accept http/https, optional www, /reel/ or /reels/, allow slug and optional query
            'post_url' => 'required|valid_url|regex_match[/^https?:\/\/(www\.)?instagram\.com\/(reel|reels)\/[^\/\s]+(?:\/)?(?:\?.*)?$/i]'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }
        $postUrl = $this->request->getPost('post_url');
        $this->instagramPostModel->insert([
            'post_url' => $postUrl,
            'is_active' => 0,
            'created_at' => date('Y-m-d H:i:s')
        ]);
        return redirect()->back()->with('success', 'Instagram post added successfully.');
    }

    public function update($id)
    {
        // validasi input 
        $validation = \Config\Services::validation();
        $validation->setRules([
            'post_url' => 'required|valid_url|regex_match[/^https?:\/\/(www\.)?instagram\.com\/(reel|reels)\/[^\/\s]+(?:\/)?(?:\?.*)?$/i]'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }
        $postUrl = $this->request->getPost('post_url');
        $this->instagramPostModel->update($id, [
            'post_url' => $postUrl
        ]);
        return redirect()->back()->with('success', 'Instagram post updated successfully.');
    }

    public function delete($id)
    {
        $post = $this->instagramPostModel->find($id);
        if ($post) {
            $this->instagramPostModel->delete($id);
            return redirect()->back()->with('success', 'Instagram post deleted successfully.');
        }
        return redirect()->back()->with('error', 'Instagram post not found.');
    }

}