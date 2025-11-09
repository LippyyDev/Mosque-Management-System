<?php
namespace App\Models;

use CodeIgniter\Model;

class PersuratanModel extends Model
{
    protected $table = 'persuratan';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'lokasi', 'tanggal', 'nomor', 'lampiran', 'perihal', 'isi_surat', 'nama_penandatangan', 'jabatan_penandatangan', 'tujuan', 'created_by', 'created_at', 'updated_at'
    ];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
} 