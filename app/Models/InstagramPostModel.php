<?php

namespace App\Models;

use CodeIgniter\Model;

class InstagramPostModel extends Model
{
    protected $table = 'instagram_posts';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['post_url', 'is_active', 'created_at'];


}
