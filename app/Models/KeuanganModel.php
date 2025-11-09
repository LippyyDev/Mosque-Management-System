<?php

namespace App\Models;

use CodeIgniter\Model;

class KeuanganModel extends Model
{
    protected $table = 'keuangan';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'tanggal_transaksi',
        'jenis',
        'kategori',
        'nominal',
        'keterangan',
        'bukti_transaksi',
        'created_by',
        'created_at',
        'updated_at'
    ];
    
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    public function getKeuanganWithFilters($filters = [], $countOnly = false, $limit = null, $offset = null)
    {
        $builder = $this->builder();
        
        if (!empty($filters['jenis'])) {
            $builder->where('jenis', $filters['jenis']);
        }
        
        if (!empty($filters['kategori'])) {
            $builder->where('kategori', $filters['kategori']);
        }
        
        if (!empty($filters['tanggal_dari'])) {
            $builder->where('tanggal_transaksi >=', $filters['tanggal_dari']);
        }
        
        if (!empty($filters['tanggal_sampai'])) {
            $builder->where('tanggal_transaksi <=', $filters['tanggal_sampai']);
        }
        
        if ($countOnly) {
            return $builder->countAllResults();
        }
        
        $builder->orderBy('tanggal_transaksi', 'DESC');
        
        if ($limit !== null) {
            $builder->limit($limit);
        }
        
        if ($offset !== null) {
            $builder->offset($offset);
        }
        
        return $builder->get()->getResultArray();
    }

    public function getTotalPemasukan($filters = [])
    {
        $builder = $this->builder();
        $builder->selectSum('nominal');
        $builder->where('jenis', 'Pemasukan');
        
        if (!empty($filters['tanggal_dari'])) {
            $builder->where('tanggal_transaksi >=', $filters['tanggal_dari']);
        }
        
        if (!empty($filters['tanggal_sampai'])) {
            $builder->where('tanggal_transaksi <=', $filters['tanggal_sampai']);
        }
        
        $result = $builder->get()->getRowArray();
        return $result['nominal'] ?? 0;
    }

    public function getTotalPengeluaran($filters = [])
    {
        $builder = $this->builder();
        $builder->selectSum('nominal');
        $builder->where('jenis', 'Pengeluaran');
        
        if (!empty($filters['tanggal_dari'])) {
            $builder->where('tanggal_transaksi >=', $filters['tanggal_dari']);
        }
        
        if (!empty($filters['tanggal_sampai'])) {
            $builder->where('tanggal_transaksi <=', $filters['tanggal_sampai']);
        }
        
        $result = $builder->get()->getRowArray();
        return $result['nominal'] ?? 0;
    }

    public function getSaldo($filters = [])
    {
        $pemasukan = $this->getTotalPemasukan($filters);
        $pengeluaran = $this->getTotalPengeluaran($filters);
        return $pemasukan - $pengeluaran;
    }

    public function getKategoriList()
    {
        return [
            'Pemasukan' => [
                'Donasi',
                'Infaq',
                'Zakat',
                'Sewa Tempat',
                'Bantuan',
                'Lainnya'
            ],
            'Pengeluaran' => [
                'Listrik',
                'Air',
                'Kebersihan',
                'Pemeliharaan',
                'Kegiatan',
                'Operasional',
                'Lainnya'
            ]
        ];
    }
}

