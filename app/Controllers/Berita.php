<?php
namespace App\Controllers;

use App\Models\BeritaModel;
use App\Models\BeritaGambarModel;
use App\Models\PengaturanModel;

class Berita extends BaseController
{
    public function show($id)
    {
        $beritaModel = new BeritaModel();
        $beritaGambarModel = new BeritaGambarModel();
        $pengaturanModel = new PengaturanModel();

        $berita = $beritaModel->find($id);

        if (!$berita) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Berita tidak ditemukan.');
        }

        // Get all images for the news
        $gambarList = $beritaGambarModel->where('berita_id', $id)->orderBy('id', 'ASC')->findAll();
        $berita['gambar_list'] = $gambarList;
        $berita['gambar'] = $gambarList[0]['gambar'] ?? null;

        $data = [
            'berita' => $berita,
            'pengaturan' => $pengaturanModel->first() ?? []
        ];

        return view('berita/show', $data);
    }

    public function index()
    {
        $beritaModel = new BeritaModel();
        $beritaGambarModel = new BeritaGambarModel();
        $pengaturanModel = new PengaturanModel();

        $perPage = 6;
        $page = (int)($this->request->getGet('page') ?? 1);
        $offset = ($page - 1) * $perPage;

        $total = $beritaModel->countAllResults();
        $beritaList = $beritaModel->orderBy('tanggal_publish', 'DESC')
            ->findAll($perPage, $offset);

        // Ambil gambar pertama untuk setiap berita
        foreach ($beritaList as &$item) {
            $gambar = $beritaGambarModel->where('berita_id', $item['id'])->orderBy('id', 'ASC')->first();
            $item['gambar'] = $gambar['gambar'] ?? null;
        }
        unset($item);

        $data = [
            'beritaList' => $beritaList,
            'total' => $total,
            'perPage' => $perPage,
            'page' => $page,
            'pengaturan' => $pengaturanModel->first() ?? []
        ];
        return view('berita/index', $data);
    }
} 