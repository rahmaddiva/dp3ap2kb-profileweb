<?php

namespace App\Models;

use CodeIgniter\Model;

class BeritaModel extends Model
{
    protected $table = 'berita';
    protected $primaryKey = 'id_berita';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'title',
        'slug',
        'excerpt',
        'content',
        'image',
        'source',
        'author',
        'status',
        'tanggal',
        'published_at',
        'created_at',
        'updated_at',
    ];


    public function getBeritaTerbaru($limit = 5)
    {
        return $this->where('status', 'published')
            ->orderBy('created_at', 'DESC')
            ->findAll($limit);
    }

    public function getLatestBeritas($limit = 10)
    {
        return $this->where('status', 'published')
            ->orderBy('created_at', 'DESC')
            ->findAll($limit);
    }






}
