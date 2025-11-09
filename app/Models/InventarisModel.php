<?php

namespace App\Models;

use CodeIgniter\Model;

class InventarisModel extends Model
{
    protected $table            = 'inventaris';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nama_barang',
        'kategori',
        'tanggal_pembelian',
        'jumlah',
        'kondisi',
        'foto_barang'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Get inventaris with filters and pagination.
     *
     * @param array $filters
     * @return array
     */
    public function getInventarisWithFilters(array $filters = [], int $perPage = 10)
    {
        $builder = $this->table('inventaris');

        if (!empty($filters['nama'])) {
            $builder->like('nama_barang', $filters['nama']);
        }

        if (!empty($filters['kategori'])) {
            $builder->where('kategori', $filters['kategori']);
        }

        if (!empty($filters['kondisi'])) {
            $builder->where('kondisi', $filters['kondisi']);
        }

        return [
            'inventaris' => $builder->orderBy('tanggal_pembelian', 'DESC')->paginate($perPage),
            'pager'      => $this->pager,
        ];
    }

    /**
     * Get total count of inventaris based on filters.
     *
     * @param array $filters
     * @return integer
     */
    public function getTotalInventaris(array $filters = [])
    {
        $builder = $this->table('inventaris');

        if (!empty($filters['nama'])) {
            $builder->like('nama_barang', $filters['nama']);
        }

        if (!empty($filters['kategori'])) {
            $builder->where('kategori', $filters['kategori']);
        }

        if (!empty($filters['kondisi'])) {
            $builder->where('kondisi', $filters['kondisi']);
        }

        return $builder->countAllResults();
    }

    /**
     * Get all distinct categories.
     *
     * @return array
     */
    public function getDistinctKategori()
    {
        return $this->distinct()->findColumn('kategori') ?? [];
    }
} 