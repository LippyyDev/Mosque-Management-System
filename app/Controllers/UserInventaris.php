<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\InventarisModel;

class UserInventaris extends BaseController
{
    protected $inventarisModel;
    protected $helpers = ['form'];

    public function __construct()
    {
        $this->inventarisModel = new InventarisModel();
    }

    /**
     * Display a list of inventaris items.
     */
    public function index()
    {
        $filters = [
            'nama'     => $this->request->getGet('nama'),
            'kategori' => $this->request->getGet('kategori'),
            'kondisi'  => $this->request->getGet('kondisi'),
        ];

        // Ensure the upload directory exists
        if (!is_dir(FCPATH . 'uploads/inventaris')) {
            mkdir(FCPATH . 'uploads/inventaris', 0777, true);
        }

        $data = [
            'title'          => 'Kelola Inventaris',
            'user'           => session()->get('user_data'),
            'inventarisData' => $this->inventarisModel->getInventarisWithFilters($filters),
            'totalInventaris'=> $this->inventarisModel->getTotalInventaris($filters),
            'kategoriList'   => $this->inventarisModel->getDistinctKategori(),
            'filters'        => $filters,
        ];

        return view('user/inventaris/index', $data);
    }

    /**
     * Show the form for creating a new inventaris item.
     */
    public function create()
    {
        $data = [
            'title' => 'Tambah Barang Inventaris',
            'user'  => session()->get('user_data'),
            'validation' => \Config\Services::validation()
        ];
        return view('user/inventaris/create', $data);
    }

    /**
     * Store a newly created inventaris item in storage.
     */
    public function store()
    {
        $rules = [
            'nama_barang'       => 'required|min_length[3]|max_length[100]',
            'kategori'          => 'required|min_length[3]|max_length[50]',
            'tanggal_pembelian' => 'required|valid_date',
            'jumlah'            => 'required|integer|greater_than[0]',
            'kondisi'           => 'required|in_list[Baik,Rusak,Diperbaiki]',
            'foto_barang'       => 'permit_empty|uploaded[foto_barang]|max_size[foto_barang,2048]|is_image[foto_barang]|mime_in[foto_barang,image/jpg,image/jpeg,image/png,image/webp]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'nama_barang'       => $this->request->getPost('nama_barang'),
            'kategori'          => $this->request->getPost('kategori'),
            'tanggal_pembelian' => $this->request->getPost('tanggal_pembelian'),
            'jumlah'            => $this->request->getPost('jumlah'),
            'kondisi'           => $this->request->getPost('kondisi'),
        ];

        // Handle file upload
        $foto = $this->request->getFile('foto_barang');
        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            $newName = $foto->getRandomName();
            if ($foto->move(FCPATH . 'uploads/inventaris', $newName)) {
                $data['foto_barang'] = $newName;
            } else {
                return redirect()->back()->withInput()->with('error', 'Gagal mengupload foto.');
            }
        }

        if ($this->inventarisModel->insert($data)) {
            return redirect()->to('/user/inventaris')->with('success', 'Barang inventaris berhasil ditambahkan.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan barang inventaris.');
        }
    }

    /**
     * Display the specified inventaris item.
     */
    public function show($id)
    {
        $inventaris = $this->inventarisModel->find($id);
        if (!$inventaris) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Barang inventaris tidak ditemukan.');
        }

        $data = [
            'title'      => 'Detail Barang Inventaris',
            'user'       => session()->get('user_data'),
            'inventaris' => $inventaris,
        ];

        return view('user/inventaris/show', $data);
    }

    /**
     * Show the form for editing the specified inventaris item.
     */
    public function edit($id)
    {
        $inventaris = $this->inventarisModel->find($id);
        if (!$inventaris) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Barang inventaris tidak ditemukan.');
        }

        $data = [
            'title'      => 'Edit Barang Inventaris',
            'user'       => session()->get('user_data'),
            'inventaris' => $inventaris,
            'validation' => \Config\Services::validation()
        ];

        return view('user/inventaris/edit', $data);
    }

    /**
     * Update the specified inventaris item in storage.
     */
    public function update($id)
    {
        $inventaris = $this->inventarisModel->find($id);
        if (!$inventaris) {
            return redirect()->back()->with('error', 'Barang inventaris tidak ditemukan.');
        }

        $rules = [
            'nama_barang'       => 'required|min_length[3]|max_length[100]',
            'kategori'          => 'required|min_length[3]|max_length[50]',
            'tanggal_pembelian' => 'required|valid_date',
            'jumlah'            => 'required|integer|greater_than[0]',
            'kondisi'           => 'required|in_list[Baik,Rusak,Diperbaiki]',
            'foto_barang'       => 'permit_empty|uploaded[foto_barang]|max_size[foto_barang,2048]|is_image[foto_barang]|mime_in[foto_barang,image/jpg,image/jpeg,image/png,image/webp]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'nama_barang'       => $this->request->getPost('nama_barang'),
            'kategori'          => $this->request->getPost('kategori'),
            'tanggal_pembelian' => $this->request->getPost('tanggal_pembelian'),
            'jumlah'            => $this->request->getPost('jumlah'),
            'kondisi'           => $this->request->getPost('kondisi'),
        ];

        // Handle file upload
        $foto = $this->request->getFile('foto_barang');
        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            // Delete old photo if exists
            if (!empty($inventaris['foto_barang']) && file_exists(FCPATH . 'uploads/inventaris/' . $inventaris['foto_barang'])) {
                unlink(FCPATH . 'uploads/inventaris/' . $inventaris['foto_barang']);
            }
            
            $newName = $foto->getRandomName();
            if ($foto->move(FCPATH . 'uploads/inventaris', $newName)) {
                $data['foto_barang'] = $newName;
            } else {
                return redirect()->back()->withInput()->with('error', 'Gagal mengupload foto.');
            }
        }
        
        if ($this->inventarisModel->update($id, $data)) {
            return redirect()->to('/user/inventaris')->with('success', 'Barang inventaris berhasil diperbarui.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui barang inventaris.');
        }
    }

    /**
     * Remove the specified inventaris item from storage.
     */
    public function delete($id)
    {
        $inventaris = $this->inventarisModel->find($id);
        if (!$inventaris) {
            return redirect()->to('/user/inventaris')->with('error', 'Barang inventaris tidak ditemukan.');
        }

        // Delete photo if exists
        if (!empty($inventaris['foto_barang']) && file_exists(FCPATH . 'uploads/inventaris/' . $inventaris['foto_barang'])) {
            unlink(FCPATH . 'uploads/inventaris/' . $inventaris['foto_barang']);
        }

        if ($this->inventarisModel->delete($id)) {
            return redirect()->to('/user/inventaris')->with('success', 'Barang inventaris berhasil dihapus.');
        } else {
            return redirect()->to('/user/inventaris')->with('error', 'Gagal menghapus barang inventaris.');
        }
    }
} 