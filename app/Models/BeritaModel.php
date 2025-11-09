<?php
namespace App\Models;

use CodeIgniter\Model;

class BeritaModel extends Model
{
    protected $table = 'berita';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'judul', 'isi', 'kategori', 'tanggal_publish', 'lokasi', 'video_youtube', 'created_by', 'created_at', 'updated_at'
    ];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    protected $validationRules = [
        'judul' => 'required|max_length[200]',
        'isi' => 'required',
        'kategori' => 'required|in_list[Pengumuman,Kegiatan,Informasi,Dakwah/Kajian]',
        'tanggal_publish' => 'required|valid_date[Y-m-d H:i:s]',
        'lokasi' => 'permit_empty|max_length[100]',
        'video_youtube' => 'permit_empty|max_length[255]',
    ];

    protected $validationMessages = [
        'judul' => [
            'required' => 'Judul wajib diisi.',
            'max_length' => 'Judul maksimal 200 karakter.'
        ],
        'isi' => [
            'required' => 'Isi berita wajib diisi.'
        ],
        'kategori' => [
            'required' => 'Kategori wajib dipilih.',
            'in_list' => 'Kategori tidak valid.'
        ],
        'tanggal_publish' => [
            'required' => 'Tanggal publish wajib diisi.',
            'valid_date' => 'Format tanggal tidak valid.'
        ],
        'lokasi' => [
            'max_length' => 'Lokasi maksimal 100 karakter.'
        ],
        'video_youtube' => [
            'max_length' => 'Link video maksimal 255 karakter.'
        ]
    ];

    public function getLatestWithCover($limit = 3)
    {
        // Subquery to get the first image for each news
        $subquery = "(SELECT bg.gambar FROM berita_gambar bg WHERE bg.berita_id = berita.id ORDER BY bg.id ASC LIMIT 1)";

        return $this->select("berita.*, ($subquery) as gambar")
                    ->orderBy('berita.tanggal_publish', 'DESC')
                    ->limit($limit)
                    ->get()
                    ->getResultArray();
    }
} 