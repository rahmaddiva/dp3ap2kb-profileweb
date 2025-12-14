<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\BeritaModel;

class BeritaController extends BaseController
{
    protected $beritaModel;
    
    public function __construct()
    {
        $this->beritaModel = new BeritaModel();
    }
    
    public function index()
    {
        $title = [
            "data" => "Berita",
            "berita" => $this->beritaModel->findAll()
        ];
        return view("berita/index", $title);
    }
    
    
}
