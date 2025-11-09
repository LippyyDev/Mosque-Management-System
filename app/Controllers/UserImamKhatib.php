<?php
namespace App\Controllers;

use App\Models\ImamKhatibModel;
use App\Models\ImamMuadzinHarianModel;

class UserImamKhatib extends BaseController
{
    protected $imamKhatibModel;
    protected $imamMuadzinHarianModel;

    public function __construct()
    {
        $this->imamKhatibModel = new ImamKhatibModel();
        $this->imamMuadzinHarianModel = new ImamMuadzinHarianModel();
    }

    public function index()
    {
        $data['imamkhatib'] = $this->imamKhatibModel->orderBy('tanggal', 'DESC')->findAll();
        $data['imam_muadzin_harian'] = $this->imamMuadzinHarianModel->orderBy('tanggal', 'DESC')->findAll();
        $data['user'] = session('user_data');
        return view('user/imamkhatib/index', $data);
    }

    public function create()
    {
        $data['user'] = session('user_data');
        return view('user/imamkhatib/create', $data);
    }

    public function store()
    {
        $validation =  \Config\Services::validation();
        $rules = [
            'nama_imam' => 'required|max_length[100]',
            'nama_khatib' => 'required|max_length[100]',
            'tanggal' => 'required|valid_date',
            'jenis' => 'required|in_list[Shalat Jumat,Tarawih,Idul Fitri,Idul Adha]',
            'keterangan' => 'permit_empty',
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }
        $model = new ImamKhatibModel();
        $model->insert([
            'nama_imam' => $this->request->getPost('nama_imam'),
            'nama_khatib' => $this->request->getPost('nama_khatib'),
            'tanggal' => $this->request->getPost('tanggal'),
            'jenis' => $this->request->getPost('jenis'),
            'keterangan' => $this->request->getPost('keterangan'),
        ]);
        return redirect()->to('/user/imamkhatib')->with('success', 'Data berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $model = new ImamKhatibModel();
        $data['item'] = $model->find($id);
        if (!$data['item']) {
            return redirect()->to('/user/imamkhatib')->with('error', 'Data tidak ditemukan.');
        }
        $data['user'] = session('user_data');
        return view('user/imamkhatib/edit', $data);
    }

    public function update($id)
    {
        $validation =  \Config\Services::validation();
        $rules = [
            'nama_imam' => 'required|max_length[100]',
            'nama_khatib' => 'required|max_length[100]',
            'tanggal' => 'required|valid_date',
            'jenis' => 'required|in_list[Shalat Jumat,Tarawih,Idul Fitri,Idul Adha]',
            'keterangan' => 'permit_empty',
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }
        $model = new ImamKhatibModel();
        $model->update($id, [
            'nama_imam' => $this->request->getPost('nama_imam'),
            'nama_khatib' => $this->request->getPost('nama_khatib'),
            'tanggal' => $this->request->getPost('tanggal'),
            'jenis' => $this->request->getPost('jenis'),
            'keterangan' => $this->request->getPost('keterangan'),
        ]);
        return redirect()->to('/user/imamkhatib')->with('success', 'Data berhasil diupdate.');
    }

    public function delete($id)
    {
        $this->imamKhatibModel->delete($id);
        return redirect()->to('/user/imamkhatib')->with('success', 'Data Kegiatan berhasil dihapus.');
    }

    // --- CRUD for Imam Muadzin Harian ---

    public function create_harian()
    {
        $data['user'] = session('user_data');
        return view('user/imamkhatib/create_harian', $data);
    }

    public function store_harian()
    {
        $validation =  \Config\Services::validation();
        $rules = [
            'nama_imam_harian' => 'required|max_length[100]',
            'nama_muadzin' => 'required|max_length[100]',
            'tanggal' => 'permit_empty|valid_date',
            'keterangan' => 'permit_empty',
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $tanggal = $this->request->getPost('tanggal');
        if (empty($tanggal)) {
            $tanggal = null;
        }

        $this->imamMuadzinHarianModel->insert([
            'nama_imam_harian' => $this->request->getPost('nama_imam_harian'),
            'nama_muadzin' => $this->request->getPost('nama_muadzin'),
            'tanggal' => $tanggal,
            'keterangan' => $this->request->getPost('keterangan'),
        ]);

        return redirect()->to('/user/imamkhatib')->with('success', 'Data Imam & Muadzin Harian berhasil ditambahkan.');
    }

    public function edit_harian($id)
    {
        $data['item'] = $this->imamMuadzinHarianModel->find($id);
        if (!$data['item']) {
            return redirect()->to('/user/imamkhatib')->with('error', 'Data tidak ditemukan.');
        }
        $data['user'] = session('user_data');
        return view('user/imamkhatib/edit_harian', $data);
    }

    public function update_harian($id)
    {
        $validation =  \Config\Services::validation();
        $rules = [
            'nama_imam_harian' => 'required|max_length[100]',
            'nama_muadzin' => 'required|max_length[100]',
            'tanggal' => 'permit_empty|valid_date',
            'keterangan' => 'permit_empty',
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $tanggal = $this->request->getPost('tanggal');
        if (empty($tanggal)) {
            $tanggal = null;
        }

        $this->imamMuadzinHarianModel->update($id, [
            'nama_imam_harian' => $this->request->getPost('nama_imam_harian'),
            'nama_muadzin' => $this->request->getPost('nama_muadzin'),
            'tanggal' => $tanggal,
            'keterangan' => $this->request->getPost('keterangan'),
        ]);

        return redirect()->to('/user/imamkhatib')->with('success', 'Data Imam & Muadzin Harian berhasil diupdate.');
    }

    public function delete_harian($id)
    {
        $this->imamMuadzinHarianModel->delete($id);
        return redirect()->to('/user/imamkhatib')->with('success', 'Data Imam & Muadzin Harian berhasil dihapus.');
    }
} 