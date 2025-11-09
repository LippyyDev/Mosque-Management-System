<?php
namespace App\Controllers;

use App\Models\GaleriModel;
use App\Models\GaleriGambarModel;
use CodeIgniter\Controller;

class UserGaleri extends BaseController
{
    protected $galeriModel;
    protected $galeriGambarModel;
    protected $session;

    public function __construct()
    {
        $this->galeriModel = new GaleriModel();
        $this->galeriGambarModel = new GaleriGambarModel();
        $this->session = session();
    }

    public function index()
    {
        $user = $this->session->get('user_data');
        $galeri = $this->galeriModel->orderBy('tanggal', 'DESC')->findAll();
        $galeriGambarModel = new \App\Models\GaleriGambarModel();
        foreach ($galeri as &$item) {
            $cover = $galeriGambarModel->where('galeri_id', $item['id'])->orderBy('id', 'ASC')->first();
            $item['cover'] = $cover ? $cover['gambar'] : null;
        }
        return view('user/galeri/index', [
            'galeri' => $galeri,
            'user' => $user
        ]);
    }

    public function create()
    {
        $user = $this->session->get('user_data');
        return view('user/galeri/create', [
            'validation' => \Config\Services::validation(),
            'user' => $user
        ]);
    }

    public function store()
    {
        $data = [
            'judul' => $this->request->getPost('judul'),
            'tanggal' => $this->request->getPost('tanggal'),
            'foto' => null, // tidak dipakai lagi, hanya untuk kompatibilitas
            'video_youtube' => $this->request->getPost('video_youtube'),
        ];
        if (!$this->galeriModel->insert($data)) {
            return redirect()->back()->withInput()->with('errors', $this->galeriModel->errors());
        }
        $galeriId = $this->galeriModel->getInsertID();
        // Handle multiple images
        $files = $this->request->getFileMultiple('gambar');
        if ($files) {
            foreach ($files as $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $newName = $file->getRandomName();
                    $file->move('public/uploads/galeri', $newName);
                    $this->galeriGambarModel->insert([
                        'galeri_id' => $galeriId,
                        'gambar' => $newName
                    ]);
                }
            }
        }
        return redirect()->to('/user/galeri')->with('success', 'Galeri berhasil ditambahkan.');
    }

    public function show($id)
    {
        $user = $this->session->get('user_data');
        $item = $this->galeriModel->find($id);
        if (!$item) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Galeri tidak ditemukan');
        }
        $gambar = $this->galeriGambarModel->where('galeri_id', $id)->findAll();
        return view('user/galeri/show', [
            'item' => $item,
            'gambar' => $gambar,
            'user' => $user
        ]);
    }

    public function edit($id)
    {
        $user = $this->session->get('user_data');
        $item = $this->galeriModel->find($id);
        if (!$item) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Galeri tidak ditemukan');
        }
        $gambar = $this->galeriGambarModel->where('galeri_id', $id)->findAll();
        return view('user/galeri/edit', [
            'item' => $item,
            'gambar' => $gambar,
            'validation' => \Config\Services::validation(),
            'user' => $user
        ]);
    }

    public function update($id)
    {
        $item = $this->galeriModel->find($id);
        if (!$item) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Galeri tidak ditemukan');
        }
        $data = [
            'judul' => $this->request->getPost('judul'),
            'tanggal' => $this->request->getPost('tanggal'),
            'foto' => null, // tidak dipakai lagi
            'video_youtube' => $this->request->getPost('video_youtube'),
        ];
        if (!$this->galeriModel->update($id, $data)) {
            return redirect()->back()->withInput()->with('errors', $this->galeriModel->errors());
        }
        // Handle new images
        $files = $this->request->getFileMultiple('gambar');
        if ($files) {
            foreach ($files as $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $newName = $file->getRandomName();
                    $file->move('public/uploads/galeri', $newName);
                    $this->galeriGambarModel->insert([
                        'galeri_id' => $id,
                        'gambar' => $newName
                    ]);
                }
            }
        }
        return redirect()->to('/user/galeri')->with('success', 'Galeri berhasil diperbarui.');
    }

    public function delete($id)
    {
        $item = $this->galeriModel->find($id);
        if (!$item) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Galeri tidak ditemukan');
        }
        // Hapus semua gambar fisik
        $gambar = $this->galeriGambarModel->where('galeri_id', $id)->findAll();
        foreach ($gambar as $g) {
            $path = FCPATH . 'public/uploads/galeri/' . $g['gambar'];
            if (is_file($path)) {
                @unlink($path);
            }
        }
        $this->galeriGambarModel->where('galeri_id', $id)->delete();
        $this->galeriModel->delete($id);
        return redirect()->to('/user/galeri')->with('success', 'Galeri berhasil dihapus.');
    }

    public function deleteGambar($id)
    {
        $gambarModel = new \App\Models\GaleriGambarModel();
        $gambar = $gambarModel->find($id);
        if (!$gambar) {
            return redirect()->back()->with('error', 'Gambar tidak ditemukan.');
        }
        $galeri_id = $gambar['galeri_id'];
        $path = FCPATH . 'public/uploads/galeri/' . $gambar['gambar'];
        if (is_file($path)) {
            @unlink($path);
        }
        $gambarModel->delete($id);
        return redirect()->to('/user/galeri/edit/' . $galeri_id)->with('success', 'Gambar berhasil dihapus.');
    }
} 