<?php
namespace App\Models;

use CodeIgniter\Model;

class GaleriModel extends Model
{
    protected $table = 'galeri';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'judul', 'tanggal', 'foto', 'video_youtube', 'created_at', 'updated_at'
    ];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'judul' => 'required|max_length[100]',
        'tanggal' => 'required|valid_date[Y-m-d]',
        'foto' => 'permit_empty|max_length[255]',
        'video_youtube' => 'permit_empty|max_length[255]',
    ];

    protected $validationMessages = [
        'judul' => [
            'required' => 'Judul wajib diisi.',
            'max_length' => 'Judul maksimal 100 karakter.'
        ],
        'tanggal' => [
            'required' => 'Tanggal wajib diisi.',
            'valid_date' => 'Format tanggal tidak valid.'
        ],
        'foto' => [
            'max_length' => 'Nama file foto maksimal 255 karakter.'
        ],
        'video_youtube' => [
            'max_length' => 'Link video maksimal 255 karakter.'
        ]
    ];

    public function getLatestWithCover($limit = 6)
    {
        // 1. Ambil galeri terbaru
        $galleries = $this->orderBy('tanggal', 'DESC')->findAll($limit);

        if (empty($galleries)) {
            return [];
        }

        $galeriGambarModel = new \App\Models\GaleriGambarModel();

        // 2. Loop melalui setiap galeri untuk melampirkan gambar sampul
        foreach ($galleries as &$gallery) {
            // Temukan gambar pertama untuk galeri ini (dianggap sebagai sampul)
            $coverImage = $galeriGambarModel->where('galeri_id', $gallery['id'])
                                            ->orderBy('id', 'ASC')
                                            ->first();
            
            // Kolom di tabel galeri_gambar adalah 'gambar'
            $gallery['cover'] = $coverImage ? $coverImage['gambar'] : null;
        }

        return $galleries;
    }
} 