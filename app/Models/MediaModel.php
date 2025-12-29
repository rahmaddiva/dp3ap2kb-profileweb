<?php

namespace App\Models;

use CodeIgniter\Model;

class MediaModel extends Model
{
    protected $table = 'media';
    protected $primaryKey = 'id_media';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'title',
        'slug',
        'content',
        'author',
        'tanggal',
        'kategori',
        'source',
        'status',
        'created_at',
        'updated_at'
    ];

    public function getKategoriFoto()
    {
        $builder = $this->db->table($this->table)
            ->select('kategori')
            ->distinct()
            ->where('kategori', 'foto');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getKategoriInfografis()
    {
        $builder = $this->db->table($this->table)
            ->select('kategori')
            ->distinct()
            ->where('kategori', 'infografis');
        $query = $builder->get();
        return $query->getResultArray();
    }

    public function getKategoriVideo()
    {
        $builder = $this->db->table($this->table)
            ->select('kategori')
            ->distinct()
            ->where('kategori', 'video');
        $query = $builder->get();
        return $query->getResultArray();
    }

}
