<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\PengurusModel;
use App\Models\InventarisModel;
use App\Models\BeritaModel;
use App\Models\DonasiModel;
use App\Models\PersuratanModel;
use CodeIgniter\Controller;

class Admin extends Controller
{
    protected $userModel;
    protected $session;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->session = session();
        helper(['form', 'url']);
    }

    public function dashboard()
    {
        $userModel = new UserModel();
        $pengurusModel = new PengurusModel();
        $inventarisModel = new InventarisModel();
        $beritaModel = new BeritaModel();
        $donasiModel = new DonasiModel();
        $persuratanModel = new PersuratanModel();

        $totalUser = $userModel->countAllResults();
        $totalPengurus = $pengurusModel->getTotalPengurus();
        $totalInventaris = $inventarisModel->getTotalInventaris();
        $totalBerita = $beritaModel->countAllResults();
        $totalDonasi = $donasiModel->countAllResults();
        $totalSurat = $persuratanModel->countAllResults();

        // Grafik line: user per bulan (6 bulan terakhir)
        $bulan = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'];
        $userPerBulan = [];
        foreach ($bulan as $i => $b) {
            $userPerBulan[] = $userModel->where('MONTH(created_at)', $i+1)->countAllResults();
        }

        // Grafik bar: jumlah data tiap entitas
        $barLabels = ['User', 'Pengurus', 'Inventaris', 'Berita', 'Donasi', 'Surat'];
        $barData = [
            $totalUser,
            $totalPengurus,
            $totalInventaris,
            $totalBerita,
            $totalDonasi,
            $totalSurat
        ];

        $data = [
            'title' => 'Dashboard Admin',
            'user' => $this->session->get('user_data'),
            'totalUser' => $totalUser,
            'totalPengurus' => $totalPengurus,
            'totalInventaris' => $totalInventaris,
            'totalBerita' => $totalBerita,
            'totalDonasi' => $totalDonasi,
            'totalSurat' => $totalSurat,
            'lineLabels' => $bulan,
            'lineData' => $userPerBulan,
            'barLabels' => $barLabels,
            'barData' => $barData
        ];
        return view('admin/dashboard', $data);
    }

    public function kelola_akun()
    {
        $data = [
            'title' => 'Kelola Akun',
            'users' => $this->userModel->getAllUsers()
        ];

        return view('admin/kelola_akun', $data);
    }

    public function tambah_akun()
    {
        $data = [
            'title' => 'Tambah Akun',
            'user' => $this->session->get('user_data')
        ];

        if ($this->request->getMethod() == 'POST') {
            $rules = [
                'username' => 'required|is_unique[users.username]',
                'password' => 'required|min_length[6]',
                'nama_lengkap' => 'required',
                'role' => 'required|in_list[Admin,User]'
            ];

            if ($this->validate($rules)) {
                $userData = [
                    'username' => $this->request->getPost('username'),
                    'password' => $this->request->getPost('password'),
                    'nama_lengkap' => $this->request->getPost('nama_lengkap'),
                    'role' => $this->request->getPost('role')
                ];

                // Handle foto profil upload
                $foto = $this->request->getFile('foto_profil');
                if ($foto && $foto->isValid() && !$foto->hasMoved()) {
                    $newName = $foto->getRandomName();
                    $foto->move(WRITEPATH . 'uploads/profiles/', $newName);
                    $userData['foto_profil'] = $newName;
                }

                if ($this->userModel->insert($userData)) {
                    session()->setFlashdata('success', 'Akun berhasil ditambahkan');
                    return redirect()->to('/admin/kelola-akun');
                } else {
                    $data['error'] = 'Gagal menambahkan akun';
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }

        return view('admin/tambah_akun', $data);
    }

    public function edit_akun($id)
    {
        $user = $this->userModel->find($id);
        if (!$user) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('User tidak ditemukan');
        }

        $data = [
            'title' => 'Edit Akun',
            'user' => $user,
            'current_user' => $this->session->get('user_data')
        ];

        if ($this->request->getMethod() == 'POST') {
            $rules = [
                'username' => "required|is_unique[users.username,id,$id]",
                'nama_lengkap' => 'required',
                'role' => 'required|in_list[Admin,User]'
            ];

            // Jika password diisi, tambahkan validasi
            if ($this->request->getPost('password')) {
                $rules['password'] = 'min_length[6]';
            }

            if ($this->validate($rules)) {
                $userData = [
                    'username' => $this->request->getPost('username'),
                    'nama_lengkap' => $this->request->getPost('nama_lengkap'),
                    'role' => $this->request->getPost('role')
                ];

                // Jika password diisi, update password
                if ($this->request->getPost('password')) {
                    $userData['password'] = $this->request->getPost('password');
                }

                // Handle foto profil upload
                $foto = $this->request->getFile('foto_profil');
                if ($foto && $foto->isValid() && !$foto->hasMoved()) {
                    $newName = $foto->getRandomName();
                    $foto->move(WRITEPATH . 'uploads/profiles/', $newName);
                    $userData['foto_profil'] = $newName;
                }

                if ($this->userModel->update($id, $userData)) {
                    session()->setFlashdata('success', 'Akun berhasil diupdate');
                    return redirect()->to('/admin/kelola-akun');
                } else {
                    $data['error'] = 'Gagal mengupdate akun';
                }
            } else {
                $data['validation'] = $this->validator;
            }
        }

        return view('admin/edit_akun', $data);
    }

    public function hapus_akun($id)
    {
        // Tidak bisa menghapus akun sendiri
        if ($id == $this->session->get('user_id')) {
            session()->setFlashdata('error', 'Tidak dapat menghapus akun sendiri');
            return redirect()->to('/admin/kelola-akun');
        }

        if ($this->userModel->delete($id)) {
            session()->setFlashdata('success', 'Akun berhasil dihapus');
        } else {
            session()->setFlashdata('error', 'Gagal menghapus akun');
        }

        return redirect()->to('/admin/kelola-akun');
    }
}

