<?php

namespace App\Models;

use CodeIgniter\Model;

class MediaFilesModel extends Model
{
    protected $table = 'media_files';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['media_id', 'filename', 'filepath', 'mime', 'size', 'is_cover', 'order', 'created_at'];


}
