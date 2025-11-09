<?php

namespace App\Controllers;

use App\Models\GaleriModel;
use App\Models\GaleriGambarModel;
use App\Models\PengaturanModel;

class Galeri extends BaseController
{
    protected $galeriModel;
    protected $galeriGambarModel;
    protected $pengaturanModel;

    public function __construct()
    {
        $this->galeriModel = new GaleriModel();
        $this->galeriGambarModel = new GaleriGambarModel();
        $this->pengaturanModel = new PengaturanModel();
    }

    public function index()
    {
        $data = [
            'galeri' => $this->galeriModel->getLatestWithCover(12), // Ambil lebih banyak untuk halaman indeks
            'pengaturan' => $this->pengaturanModel->first() ?? [],
            'title' => 'Galeri'
        ];
        return view('galeri/index', $data);
    }

    public function show($id)
    {
        $item = $this->galeriModel->find($id);
        if (!$item) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Galeri tidak ditemukan');
        }

        $gambar = $this->galeriGambarModel->where('galeri_id', $id)->orderBy('id', 'ASC')->findAll();

        $data = [
            'item' => $item,
            'gambar' => $gambar,
            'pengaturan' => $this->pengaturanModel->first() ?? [],
            'title' => esc($item['judul'])
        ];

        return view('galeri/show', $data);
    }
} 