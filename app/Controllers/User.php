<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\KeuanganModel;
use App\Models\DonasiModel;
use App\Models\PengurusModel;
use App\Models\InventarisModel;
use App\Models\BeritaModel;
use App\Models\PersuratanModel;

class User extends Controller
{
    protected $session;

    public function __construct()
    {
        $this->session = session();
        helper(['form', 'url']);
    }

    public function dashboard()
    {
        $keuanganModel = new KeuanganModel();
        $donasiModel = new DonasiModel();
        $pengurusModel = new PengurusModel();
        $inventarisModel = new InventarisModel();
        $beritaModel = new BeritaModel();
        $persuratanModel = new PersuratanModel();

        // Statistik numerik
        $saldoKeuangan = $keuanganModel->getSaldo();
        $totalDonasi = $donasiModel->countAllResults();
        $totalPengurus = $pengurusModel->getTotalPengurus();
        $totalInventaris = $inventarisModel->getTotalInventaris();
        $totalBerita = $beritaModel->countAllResults();
        $totalSurat = $persuratanModel->countAllResults();

        // Grafik line: saldo per bulan (dummy jika belum ada data per bulan)
        $bulan = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'];
        $saldoPerBulan = [];
        foreach ($bulan as $b) {
            $saldoPerBulan[] = $keuanganModel->getSaldo([ // filter bulan
                'tanggal_dari' => date('Y-') . sprintf('%02d', array_search($b, $bulan) + 1) . '-01',
                'tanggal_sampai' => date('Y-') . sprintf('%02d', array_search($b, $bulan) + 1) . '-31',
            ]);
        }

        // Grafik pie: distribusi donasi (dummy, bisa diisi dari kategori donasi jika ada)
        $pieLabels = ['Donasi', 'Infaq', 'Lainnya'];
        $pieData = [
            $donasiModel->where('catatan', 'Donasi')->countAllResults(),
            $donasiModel->where('catatan', 'Infaq')->countAllResults(),
            $donasiModel->where('catatan !=', 'Donasi')->where('catatan !=', 'Infaq')->countAllResults(),
        ];

        // Grafik bar: jumlah data tiap entitas
        $barLabels = ['Keuangan', 'Donasi', 'Pengurus', 'Inventaris', 'Berita', 'Surat'];
        $barData = [
            $keuanganModel->countAllResults(),
            $totalDonasi,
            $totalPengurus,
            $totalInventaris,
            $totalBerita,
            $totalSurat
        ];

        $data = [
            'title' => 'Dashboard User',
            'user' => $this->session->get('user_data'),
            'saldoKeuangan' => $saldoKeuangan,
            'totalDonasi' => $totalDonasi,
            'totalPengurus' => $totalPengurus,
            'totalInventaris' => $totalInventaris,
            'totalBerita' => $totalBerita,
            'totalSurat' => $totalSurat,
            'lineLabels' => $bulan,
            'lineData' => $saldoPerBulan,
            'pieLabels' => $pieLabels,
            'pieData' => $pieData,
            'barLabels' => $barLabels,
            'barData' => $barData
        ];

        return view('user/dashboard', $data);
    }

    // Placeholder methods untuk fitur-fitur user yang akan diimplementasi di fase selanjutnya
    public function kelola_keuangan()
    {
        $data = [
            'title' => 'Kelola Keuangan',
            'user' => $this->session->get('user_data')
        ];
        return view('user/kelola_keuangan', $data);
    }

    public function kelola_donasi()
    {
        $data = [
            'title' => 'Kelola Donasi',
            'user' => $this->session->get('user_data')
        ];
        return view('user/kelola_donasi', $data);
    }

    public function kelola_pengurus()
    {
        $data = [
            'title' => 'Kelola Pengurus',
            'user' => $this->session->get('user_data')
        ];
        return view('user/kelola_pengurus', $data);
    }

    public function kelola_inventaris()
    {
        $data = [
            'title' => 'Kelola Inventaris',
            'user' => $this->session->get('user_data')
        ];
        return view('user/kelola_inventaris', $data);
    }

    public function kelola_berita()
    {
        $data = [
            'title' => 'Kelola Berita',
            'user' => $this->session->get('user_data')
        ];
        return view('user/kelola_berita', $data);
    }

    public function kelola_galeri()
    {
        $data = [
            'title' => 'Kelola Galeri',
            'user' => $this->session->get('user_data')
        ];
        return view('user/kelola_galeri', $data);
    }

    public function kelola_masukan()
    {
        $data = [
            'title' => 'Kelola Masukan',
            'user' => $this->session->get('user_data')
        ];
        return view('user/kelola_masukan', $data);
    }

    public function kelola_imam_khatib()
    {
        $data = [
            'title' => 'Kelola Imam & Khatib',
            'user' => $this->session->get('user_data')
        ];
        return view('user/kelola_imam_khatib', $data);
    }

    public function kelola_persuratan()
    {
        $data = [
            'title' => 'Kelola Persuratan',
            'user' => $this->session->get('user_data')
        ];
        return view('user/kelola_persuratan', $data);
    }

    public function edit_profile()
    {
        $user = $this->session->get('user_data');
        if (!$user) {
            return redirect()->to('/auth/login');
        }
        $data = [
            'title' => 'Edit Profil',
            'user' => $user,
            'validation' => \Config\Services::validation()
        ];
        return view('user/edit_profile', $data);
    }

    public function update_profile()
    {
        $user = $this->session->get('user_data');
        if (!$user) {
            return redirect()->to('/auth/login');
        }
        $validation = \Config\Services::validation();
        $rules = [
            'username' => 'required|min_length[3]|max_length[50]|is_unique[users.username,id,' . $user['id'] . ']',
            'nama_lengkap' => 'required|min_length[3]|max_length[100]',
            'password' => 'permit_empty|min_length[6]',
            'foto_profil' => 'permit_empty|is_image[foto_profil]|max_size[foto_profil,2048]'
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $validation);
        }
        $userModel = new \App\Models\UserModel();
        $dataUpdate = [
            'username' => $this->request->getPost('username'),
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
        ];
        if ($this->request->getPost('password')) {
            $dataUpdate['password'] = $this->request->getPost('password');
        }
        $file = $this->request->getFile('foto_profil');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $uploadPath = FCPATH . 'uploads/profiles/';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }
            // Hapus foto lama jika ada
            if (!empty($user['foto_profil']) && file_exists($uploadPath . $user['foto_profil'])) {
                unlink($uploadPath . $user['foto_profil']);
            }
            $newName = $file->getRandomName();
            $file->move($uploadPath, $newName);
            $dataUpdate['foto_profil'] = $newName;
        }
        $userModel->update($user['id'], $dataUpdate);
        // Ambil data user terbaru
        $userBaru = $userModel->find($user['id']);
        $this->session->set([
            'user_data' => [
                'id' => $userBaru['id'],
                'username' => $userBaru['username'],
                'nama_lengkap' => $userBaru['nama_lengkap'],
                'role' => $userBaru['role'],
                'foto_profil' => $userBaru['foto_profil'] ?? null
            ]
        ]);
        return redirect()->to('/user/edit-profile')->with('success', 'Profil berhasil diperbarui.');
    }
}

