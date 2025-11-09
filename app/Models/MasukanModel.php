<?php
namespace App\Models;

use CodeIgniter\Model;

class MasukanModel extends Model
{
    protected $table = 'masukan';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'kontak', 'isi_masukan', 'status', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
} 