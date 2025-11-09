<?php

namespace App\Models;

use CodeIgniter\Model;

class PengurusModel extends Model
{
    protected $table = 'pengurus';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'jabatan', 'foto'];
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getPengurusWithFilters($filters = [])
    {
        $builder = $this->builder();
        
        if (!empty($filters['jabatan'])) {
            $builder->like('jabatan', $filters['jabatan']);
        }
        
        if (!empty($filters['nama'])) {
            $builder->like('nama', $filters['nama']);
        }
        
        return $builder->orderBy('created_at', 'DESC')->get()->getResultArray();
    }

    public function getTotalPengurus($filters = [])
    {
        $builder = $this->builder();
        
        if (!empty($filters['jabatan'])) {
            $builder->like('jabatan', $filters['jabatan']);
        }
        
        if (!empty($filters['nama'])) {
            $builder->like('nama', $filters['nama']);
        }
        
        return $builder->countAllResults();
    }
}


