<?php
namespace App\Controllers;

use App\Models\BeritaModel;
use App\Models\BeritaGambarModel;
use CodeIgniter\Controller;

class UserBerita extends BaseController
{
    protected $beritaModel;
    protected $beritaGambarModel;
    protected $session;

    public function __construct()
    {
        $this->beritaModel = new BeritaModel();
        $this->beritaGambarModel = new BeritaGambarModel();
        $this->session = session();
    }

    public function index()
    {
        $user = $this->session->get('user_data');
        $q = $this->request->getGet('q');
        $kategori = $this->request->getGet('kategori');
        $tanggal_dari = $this->request->getGet('tanggal_dari');
        $tanggal_sampai = $this->request->getGet('tanggal_sampai');
        $builder = $this->beritaModel->where('created_by', $user['id']);
        if ($q) {
            $builder = $builder->groupStart()
                ->like('judul', $q)
                ->orLike('isi', $q)
                ->groupEnd();
        }
        if ($kategori) {
            $builder = $builder->where('kategori', $kategori);
        }
        if ($tanggal_dari) {
            $builder = $builder->where('tanggal_publish >=', $tanggal_dari . ' 00:00:00');
        }
        if ($tanggal_sampai) {
            $builder = $builder->where('tanggal_publish <=', $tanggal_sampai . ' 23:59:59');
        }
        $berita = $builder->orderBy('tanggal_publish', 'DESC')->findAll();
        return view('user/berita/index', [
            'berita' => $berita,
            'user' => $user,
            'kategori_list' => ['Pengumuman','Kegiatan','Informasi','Dakwah/Kajian'],
            'filters' => [
                'q' => $q,
                'kategori' => $kategori,
                'tanggal_dari' => $tanggal_dari,
                'tanggal_sampai' => $tanggal_sampai
            ]
        ]);
    }

    public function create()
    {
        $user = $this->session->get('user_data');
        return view('user/berita/create', [
            'validation' => \Config\Services::validation(),
            'kategori_list' => ['Pengumuman','Kegiatan','Informasi','Dakwah/Kajian'],
            'user' => $user
        ]);
    }

    public function store()
    {
        $user = $this->session->get('user_data');
        $tanggal_publish = $this->request->getPost('tanggal_publish');
        if ($tanggal_publish) {
            $tanggal_publish = str_replace('T', ' ', $tanggal_publish) . ':00';
        }
        $data = [
            'judul' => $this->request->getPost('judul'),
            'isi' => $this->request->getPost('isi'),
            'kategori' => $this->request->getPost('kategori'),
            'tanggal_publish' => $tanggal_publish,
            'lokasi' => $this->request->getPost('lokasi'),
            'video_youtube' => $this->request->getPost('video_youtube'),
            'created_by' => $user['id'],
        ];
        if (!$this->beritaModel->insert($data)) {
            return redirect()->back()->withInput()->with('errors', $this->beritaModel->errors());
        }
        $beritaId = $this->beritaModel->getInsertID();
        // Handle multiple images
        $files = $this->request->getFileMultiple('gambar');
        if ($files) {
            foreach ($files as $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $newName = $file->getRandomName();
                    $file->move('public/uploads/berita', $newName);
                    $this->beritaGambarModel->insert([
                        'berita_id' => $beritaId,
                        'gambar' => $newName
                    ]);
                }
            }
        }
        return redirect()->to('/user/berita')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function show($id)
    {
        $berita = $this->beritaModel->find($id);
        if (!$berita) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Berita tidak ditemukan');
        }
        $user = $this->session->get('user_data');
        if ($berita['created_by'] != $user['id']) {
            return redirect()->to('/user/berita');
        }
        $gambar = $this->beritaGambarModel->where('berita_id', $id)->findAll();
        return view('user/berita/show', [
            'berita' => $berita,
            'gambar' => $gambar,
            'user' => $user
        ]);
    }

    public function edit($id)
    {
        $berita = $this->beritaModel->find($id);
        if (!$berita) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Berita tidak ditemukan');
        }
        $user = $this->session->get('user_data');
        if ($berita['created_by'] != $user['id']) {
            return redirect()->to('/user/berita');
        }
        $gambar = $this->beritaGambarModel->where('berita_id', $id)->findAll();
        return view('user/berita/edit', [
            'berita' => $berita,
            'gambar' => $gambar,
            'validation' => \Config\Services::validation(),
            'kategori_list' => ['Pengumuman','Kegiatan','Informasi','Dakwah/Kajian'],
            'user' => $user
        ]);
    }

    public function update($id)
    {
        $berita = $this->beritaModel->find($id);
        if (!$berita) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Berita tidak ditemukan');
        }
        $user = $this->session->get('user_data');
        if ($berita['created_by'] != $user['id']) {
            return redirect()->to('/user/berita');
        }
        $tanggal_publish = $this->request->getPost('tanggal_publish');
        if ($tanggal_publish) {
            $tanggal_publish = str_replace('T', ' ', $tanggal_publish) . ':00';
        }
        $data = [
            'judul' => $this->request->getPost('judul'),
            'isi' => $this->request->getPost('isi'),
            'kategori' => $this->request->getPost('kategori'),
            'tanggal_publish' => $tanggal_publish,
            'lokasi' => $this->request->getPost('lokasi'),
            'video_youtube' => $this->request->getPost('video_youtube'),
        ];
        if (!$this->beritaModel->update($id, $data)) {
            return redirect()->back()->withInput()->with('errors', $this->beritaModel->errors());
        }
        // Handle new images
        $files = $this->request->getFileMultiple('gambar');
        if ($files) {
            foreach ($files as $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $newName = $file->getRandomName();
                    $file->move('public/uploads/berita', $newName);
                    $this->beritaGambarModel->insert([
                        'berita_id' => $id,
                        'gambar' => $newName
                    ]);
                }
            }
        }
        return redirect()->to('/user/berita')->with('success', 'Berita berhasil diperbarui.');
    }

    public function delete($id)
    {
        $berita = $this->beritaModel->find($id);
        if (!$berita) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('Berita tidak ditemukan');
        }
        $user = $this->session->get('user_data');
        if ($berita['created_by'] != $user['id']) {
            return redirect()->to('/user/berita');
        }
        // Hapus gambar fisik
        $gambar = $this->beritaGambarModel->where('berita_id', $id)->findAll();
        foreach ($gambar as $g) {
            $path = FCPATH . 'public/uploads/berita/' . $g['gambar'];
            if (is_file($path)) {
                @unlink($path);
            }
        }
        $this->beritaGambarModel->where('berita_id', $id)->delete();
        $this->beritaModel->delete($id);
        return redirect()->to('/user/berita')->with('success', 'Berita berhasil dihapus.');
    }

    public function deleteGambar($id)
    {
        $gambar = $this->beritaGambarModel->find($id);
        if (!$gambar) {
            return redirect()->back()->with('error', 'Gambar tidak ditemukan.');
        }

        // Cek kepemilikan
        $user = $this->session->get('user_data');
        $berita = $this->beritaModel->find($gambar['berita_id']);
        if ($berita['created_by'] != $user['id']) {
            return redirect()->to('/user/berita')->with('error', 'Anda tidak memiliki akses.');
        }
        
        $berita_id = $gambar['berita_id'];
        $path = FCPATH . 'public/uploads/berita/' . $gambar['gambar'];
        if (is_file($path)) {
            @unlink($path);
        }
        $this->beritaGambarModel->delete($id);
        return redirect()->to('/user/berita/edit/' . $berita_id)->with('success', 'Gambar berhasil dihapus.');
    }
} 