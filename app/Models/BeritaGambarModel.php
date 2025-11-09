<?php
namespace App\Models;

use CodeIgniter\Model;

class BeritaGambarModel extends Model
{
    protected $table = 'berita_gambar';
    protected $primaryKey = 'id';
    protected $allowedFields = ['berita_id', 'gambar', 'created_at'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = '';
} 