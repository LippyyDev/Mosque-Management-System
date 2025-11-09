<?php
namespace App\Models;

use CodeIgniter\Model;

class ImamKhatibModel extends Model
{
    protected $table = 'imam_khatib';
    protected $primaryKey = 'id';
    protected $allowedFields = ['tanggal', 'nama_imam', 'nama_khatib', 'jenis', 'keterangan'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getUpcomingSchedule()
    {
        return $this->where('tanggal >=', date('Y-m-d'))
                    ->where('jenis', 'Shalat Jumat')
                    ->orderBy('tanggal', 'ASC')
                    ->first();
    }

    public function getAllUpcoming()
    {
        return $this->where('tanggal >=', date('Y-m-d'))
                    ->orderBy('tanggal', 'ASC')
                    ->findAll();
    }
} 