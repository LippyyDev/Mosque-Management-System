<?php

namespace App\Models;

use CodeIgniter\Model;

class DonasiModel extends Model
{
    protected $table      = 'donasi';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ["nama", "nominal", "bukti_pembayaran", "catatan", "status"];

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules = [
        'nama'    => 'required|min_length[3]',
        'nominal' => 'required|numeric',
    ];
    protected $validationMessages = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getDonasiWithFilters($filters, $perPage = null)
    {
        $this->select('*');
        if (!empty($filters['status'])) {
            $this->where('status', $filters['status']);
        }
        if (!empty($filters['tanggal_dari'])) {
            $this->where('created_at >=', $filters['tanggal_dari'] . ' 00:00:00');
        }
        if (!empty($filters['tanggal_sampai'])) {
            $this->where('created_at <=', $filters['tanggal_sampai'] . ' 23:59:59');
        }
        $this->orderBy('created_at', 'DESC');
        if ($perPage) {
            return [
                'donasi' => $this->paginate($perPage),
                'pager' => $this->pager
            ];
        }
        return [
            'donasi' => $this->findAll(),
            'pager' => null
        ];
    }

    public function getTotalDonasi($filters)
    {
        $builder = $this->builder();

        if (!empty($filters['status'])) {
            $builder->where('status', $filters['status']);
        }
        if (!empty($filters['tanggal_dari'])) {
            $builder->where('created_at >=', $filters['tanggal_dari'] . ' 00:00:00');
        }
        if (!empty($filters['tanggal_sampai'])) {
            $builder->where('created_at <=', $filters['tanggal_sampai'] . ' 23:59:59');
        }

        return $builder->selectSum('nominal')->get()->getRowArray()['nominal'];
    }
}

