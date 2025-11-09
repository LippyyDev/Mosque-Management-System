<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class AdminUsers extends BaseController
{
    protected $userModel;
    protected $session;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->session = session();
        
        // Check if user is logged in and is admin
        if (!$this->session->get('logged_in') || $this->session->get('role') !== 'Admin') {
            redirect()->to('/auth/login')->send();
            exit;
        }
    }

    public function index()
    {
        $data = [
            'title' => 'Kelola Akun',
            'user' => $this->session->get('user_data'),
            'users' => $this->userModel->findAll()
        ];

        return view('admin/users/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Akun Baru',
            'user' => $this->session->get('user_data')
        ];

        return view('admin/users/create', $data);
    }

    public function store()
    {
        $validation = \Config\Services::validation();
        
        $rules = [
            'username' => 'required|min_length[3]|max_length[50]|is_unique[users.username]',
            'password' => 'required|min_length[6]',
            'nama_lengkap' => 'required|min_length[3]|max_length[100]',
            'role' => 'required|in_list[Admin,User]',
            'foto_profil' => 'permit_empty|uploaded[foto_profil]|max_size[foto_profil,2048]|is_image[foto_profil]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $data = [
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'role' => $this->request->getPost('role'),
            'created_at' => date('Y-m-d H:i:s')
        ];

        // Handle file upload
        $file = $this->request->getFile('foto_profil');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $uploadPath = FCPATH . 'uploads/profiles/';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }
            $newName = $file->getRandomName();
            $file->move($uploadPath, $newName);
            $data['foto_profil'] = $newName;
        }

        if ($this->userModel->insert($data)) {
            return redirect()->to('/admin/users')->with('success', 'Akun berhasil ditambahkan');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan akun');
        }
    }

    public function edit($id)
    {
        $userData = $this->userModel->find($id);
        
        if (!$userData) {
            return redirect()->to('/admin/users')->with('error', 'Akun tidak ditemukan');
        }

        $data = [
            'title' => 'Edit Akun',
            'user' => $this->session->get('user_data'),
            'userData' => $userData
        ];

        return view('admin/users/edit', $data);
    }

    public function update($id)
    {
        $userData = $this->userModel->find($id);
        
        if (!$userData) {
            return redirect()->to('/admin/users')->with('error', 'Akun tidak ditemukan');
        }

        $validation = \Config\Services::validation();
        
        $rules = [
            'username' => "required|min_length[3]|max_length[50]|is_unique[users.username,id,{$id}]",
            'nama_lengkap' => 'required|min_length[3]|max_length[100]',
            'role' => 'required|in_list[Admin,User]',
            'foto_profil' => 'permit_empty|uploaded[foto_profil]|max_size[foto_profil,2048]|is_image[foto_profil]'
        ];

        // Only validate password if it's provided
        if ($this->request->getPost('password')) {
            $rules['password'] = 'min_length[6]';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $data = [
            'username' => $this->request->getPost('username'),
            'nama_lengkap' => $this->request->getPost('nama_lengkap'),
            'role' => $this->request->getPost('role'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        // Update password only if provided
        if ($this->request->getPost('password')) {
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }

        // Handle file upload
        $file = $this->request->getFile('foto_profil');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            // Delete old file if exists
            $uploadPath = FCPATH . 'uploads/profiles/';
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0777, true);
            }
            if ($userData['foto_profil'] && file_exists($uploadPath . $userData['foto_profil'])) {
                unlink($uploadPath . $userData['foto_profil']);
            }
            $newName = $file->getRandomName();
            $file->move($uploadPath, $newName);
            $data['foto_profil'] = $newName;
        }

        if ($this->userModel->update($id, $data)) {
            // Jika user yang diedit adalah user yang sedang login, update session
            if ($id == $this->session->get('user_id')) {
                $userBaru = $this->userModel->find($id);
                $this->session->set([
                    'nama_lengkap' => $userBaru['nama_lengkap'],
                    'role' => $userBaru['role'],
                    'foto_profil' => $userBaru['foto_profil'] ?? null,
                    'user_data' => [
                        'id' => $userBaru['id'],
                        'username' => $userBaru['username'],
                        'nama_lengkap' => $userBaru['nama_lengkap'],
                        'role' => $userBaru['role'],
                        'foto_profil' => $userBaru['foto_profil'] ?? null
                    ]
                ]);
            }
            return redirect()->to('/admin/users')->with('success', 'Akun berhasil diperbarui');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui akun');
        }
    }

    public function delete($id)
    {
        $userData = $this->userModel->find($id);
        
        if (!$userData) {
            return redirect()->to('/admin/users')->with('error', 'Akun tidak ditemukan');
        }

        // Prevent deleting own account
        if ($id == $this->session->get('user_id')) {
            return redirect()->to('/admin/users')->with('error', 'Tidak dapat menghapus akun sendiri');
        }

        // Delete profile photo if exists
        $uploadPath = FCPATH . 'uploads/profiles/';
        if ($userData['foto_profil'] && file_exists($uploadPath . $userData['foto_profil'])) {
            unlink($uploadPath . $userData['foto_profil']);
        }

        if ($this->userModel->delete($id)) {
            return redirect()->to('/admin/users')->with('success', 'Akun berhasil dihapus');
        } else {
            return redirect()->to('/admin/users')->with('error', 'Gagal menghapus akun');
        }
    }
}

