<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PengurusModel;

class UserPengurus extends BaseController
{
    protected $pengurusModel;

    public function __construct()
    {
        $this->pengurusModel = new PengurusModel();
    }

    public function index()
    {
        $filters = [
            'jabatan' => $this->request->getGet('jabatan'),
            'nama' => $this->request->getGet('nama')
        ];

        $data = [
            'title' => 'Kelola Pengurus',
            'pengurus' => $this->pengurusModel->getPengurusWithFilters($filters),
            'total_pengurus' => $this->pengurusModel->getTotalPengurus($filters),
            'filters' => $filters,
            'user' => session()->get('user_data')
        ];

        return view('user/pengurus/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Pengurus',
            'user' => session()->get('user_data')
        ];

        return view('user/pengurus/create', $data);
    }

    public function store()
    {
        $rules = [
            'nama' => 'required|min_length[3]|max_length[100]',
            'jabatan' => 'required|min_length[3]|max_length[50]',
            'foto' => 'permit_empty|uploaded[foto]|max_size[foto,2048]|is_image[foto]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'nama' => $this->request->getPost('nama'),
            'jabatan' => $this->request->getPost('jabatan')
        ];

        // Handle file upload
        $foto = $this->request->getFile('foto');
        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            $newName = $foto->getRandomName();
            $foto->move(FCPATH . 'uploads/pengurus', $newName);
            $data['foto'] = $newName;
        }

        if ($this->pengurusModel->insert($data)) {
            return redirect()->to('/user/pengurus')->with('success', 'Pengurus berhasil ditambahkan.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan pengurus.');
        }
    }

    public function show($id)
    {
        $data = [
            'title' => 'Detail Pengurus',
            'pengurus' => $this->pengurusModel->find($id),
            'user' => session()->get('user_data')
        ];

        if (empty($data['pengurus'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Pengurus ' . $id . ' tidak ditemukan.');
        }

        return view('user/pengurus/show', $data);
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Edit Pengurus',
            'pengurus' => $this->pengurusModel->find($id),
            'user' => session()->get('user_data')
        ];

        if (empty($data['pengurus'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Pengurus ' . $id . ' tidak ditemukan.');
        }

        return view('user/pengurus/edit', $data);
    }

    public function update($id)
    {
        $pengurus = $this->pengurusModel->find($id);
        if (empty($pengurus)) {
            return redirect()->back()->with('error', 'Pengurus tidak ditemukan.');
        }

        $rules = [
            'nama' => 'required|min_length[3]|max_length[100]',
            'jabatan' => 'required|min_length[3]|max_length[50]',
            'foto' => 'permit_empty|uploaded[foto]|max_size[foto,2048]|is_image[foto]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'nama' => $this->request->getPost('nama'),
            'jabatan' => $this->request->getPost('jabatan')
        ];

        // Handle file upload
        $foto = $this->request->getFile('foto');
        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            // Delete old photo if exists
            if (!empty($pengurus['foto']) && file_exists(FCPATH . 'uploads/pengurus/' . $pengurus['foto'])) {
                unlink(FCPATH . 'uploads/pengurus/' . $pengurus['foto']);
            }
            
            $newName = $foto->getRandomName();
            $foto->move(FCPATH . 'uploads/pengurus', $newName);
            $data['foto'] = $newName;
        }

        if ($this->pengurusModel->update($id, $data)) {
            return redirect()->to('/user/pengurus')->with('success', 'Pengurus berhasil diperbarui.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui pengurus.');
        }
    }

    public function delete($id)
    {
        $pengurus = $this->pengurusModel->find($id);
        if (empty($pengurus)) {
            return redirect()->back()->with('error', 'Pengurus tidak ditemukan.');
        }

        // Delete photo if exists
        if (!empty($pengurus['foto']) && file_exists(FCPATH . 'uploads/pengurus/' . $pengurus['foto'])) {
            unlink(FCPATH . 'uploads/pengurus/' . $pengurus['foto']);
        }

        if ($this->pengurusModel->delete($id)) {
            return redirect()->to('/user/pengurus')->with('success', 'Pengurus berhasil dihapus.');
        } else {
            return redirect()->back()->with('error', 'Gagal menghapus pengurus.');
        }
    }
}

