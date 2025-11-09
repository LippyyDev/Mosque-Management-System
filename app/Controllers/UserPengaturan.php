<?php
namespace App\Controllers;

use App\Models\PengaturanModel;
use CodeIgniter\Controller;

class UserPengaturan extends Controller
{
    protected $session;
    protected $pengaturanModel;

    public function __construct()
    {
        $this->session = session();
        $this->pengaturanModel = new PengaturanModel();
        helper(['form', 'url']);
    }

    public function index()
    {
        $pengaturan = $this->pengaturanModel->find(1);
        $data = [
            'title' => 'Pengaturan Masjid',
            'user' => $this->session->get('user_data'),
            'pengaturan' => $pengaturan
        ];
        return view('user/pengaturan/index', $data);
    }

    public function edit()
    {
        $pengaturan = $this->pengaturanModel->find(1);
        $data = [
            'title' => 'Edit Pengaturan Masjid',
            'user' => $this->session->get('user_data'),
            'pengaturan' => $pengaturan,
            'validation' => \Config\Services::validation()
        ];
        return view('user/pengaturan/edit', $data);
    }

    public function update()
    {
        $id = 1;
        $rules = [
            'nama_masjid' => 'required',
            'alamat' => 'required',
            'nomor_hp' => 'permit_empty',
            'email' => 'permit_empty|valid_email',
            'rekening_bank' => 'permit_empty',
            'qris_visible' => 'permit_empty|in_list[0,1]',
            'sejarah' => 'permit_empty',
            'visi' => 'permit_empty',
            'misi' => 'permit_empty',
            'tahun_berdiri' => 'permit_empty|numeric',
        ];
        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }
        $data = $this->request->getPost();
        // Handle upload QRIS
        $file = $this->request->getFile('foto_qris');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move('uploads/qris', $newName);
            $data['foto_qris'] = $newName;
        } else {
            unset($data['foto_qris']);
        }
        $this->pengaturanModel->update($id, $data);
        return redirect()->to('/user/pengaturan')->with('success', 'Pengaturan berhasil diperbarui.');
    }
} 