<?php
namespace App\Models;

use CodeIgniter\Model;

class PengaturanModel extends Model
{
    protected $table = 'pengaturan';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nama_masjid', 'alamat', 'nomor_hp', 'email', 'rekening_bank', 'foto_qris', 'qris_visible', 'sejarah', 'visi', 'misi', 'tahun_berdiri', 'updated_at'
    ];
    protected $useTimestamps = false;
    protected $updatedField = 'updated_at';
} 