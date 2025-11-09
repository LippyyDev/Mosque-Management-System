<?php
namespace App\Models;

use CodeIgniter\Model;

class GaleriGambarModel extends Model
{
    protected $table = 'galeri_gambar';
    protected $primaryKey = 'id';
    protected $allowedFields = ['galeri_id', 'gambar', 'created_at'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = '';
} 