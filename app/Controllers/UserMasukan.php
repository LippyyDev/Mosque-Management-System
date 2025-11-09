<?php
namespace App\Controllers;

use App\Models\MasukanModel;
use CodeIgniter\Controller;

class UserMasukan extends BaseController
{
    public function index()
    {
        $masukanModel = new MasukanModel();
        $q = $this->request->getGet('q');
        $tanggal = $this->request->getGet('tanggal');
        $builder = $masukanModel;
        if ($q) {
            $builder = $builder->groupStart()
                ->like('nama', $q)
                ->orLike('kontak', $q)
                ->orLike('isi_masukan', $q)
                ->groupEnd();
        }
        if ($tanggal) {
            $builder = $builder->where('DATE(created_at)', $tanggal);
        }
        $data['masukan'] = $builder->orderBy('created_at', 'DESC')->findAll();
        $data['user'] = session('user_data');
        $data['q'] = $q;
        $data['tanggal'] = $tanggal;
        return view('user/masukan/index', $data);
    }

    public function delete($id)
    {
        $masukanModel = new MasukanModel();
        $masukan = $masukanModel->find($id);
        if (!$masukan) {
            return redirect()->back()->with('error', 'Data masukan tidak ditemukan.');
        }
        $masukanModel->delete($id);
        return redirect()->to('/user/masukan')->with('success', 'Data masukan berhasil dihapus.');
    }

    public function show($id)
    {
        $masukanModel = new \App\Models\MasukanModel();
        $masukan = $masukanModel->find($id);
        if (!$masukan) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data masukan tidak ditemukan.');
        }
        $data = [
            'title' => 'Detail Masukan',
            'masukan' => $masukan,
            'user' => session('user_data')
        ];
        return view('user/masukan/show', $data);
    }
} 