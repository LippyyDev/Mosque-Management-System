<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DonasiModel;
use App\Models\KeuanganModel;

class UserDonasi extends BaseController
{
    protected $donasiModel;
    protected $keuanganModel;

    public function __construct()
    {
        $this->donasiModel = new DonasiModel();
        $this->keuanganModel = new KeuanganModel();
    }

    public function index()
    {
        $filters = [
            'status' => $this->request->getGet('status'),
            'tanggal_dari' => $this->request->getGet('tanggal_dari'),
            'tanggal_sampai' => $this->request->getGet('tanggal_sampai')
        ];

        $result = $this->donasiModel->getDonasiWithFilters($filters, 10); // 10 per halaman
        $data = [
            'title' => 'Kelola Donasi',
            'donasi' => $result['donasi'],
            'pager' => $result['pager'],
            'total_donasi' => $this->donasiModel->getTotalDonasi($filters),
            'filters' => $filters,
            'user' => session()->get('user_data')
        ];

        return view('user/donasi/index', $data);
    }

    public function show($id)
    {
        $data = [
            'title' => 'Detail Donasi',
            'donasi' => $this->donasiModel->find($id),
            'user' => session()->get('user_data')
        ];

        if (empty($data['donasi'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Donasi ' . $id . ' tidak ditemukan.');
        }

        return view('user/donasi/show', $data);
    }

    public function accept($id)
    {
        $donasi = $this->donasiModel->find($id);

        if (empty($donasi)) {
            return redirect()->back()->with('error', 'Donasi tidak ditemukan.');
        }

        if ($donasi['status'] !== 'Pending') {
            return redirect()->back()->with('error', 'Donasi sudah diverifikasi atau ditolak sebelumnya.');
        }

        // Update status donasi
        $this->donasiModel->update($id, ['status' => 'Verified']);

        // Masukkan ke laporan keuangan
        $dataKeuangan = [
            'tanggal_transaksi' => date('Y-m-d'),
            'jenis' => 'Pemasukan',
            'kategori' => 'Donasi',
            'nominal' => $donasi['nominal'],
            'keterangan' => 'Donasi dari ' . $donasi['nama'],
            'created_by' => session()->get('user_id')
        ];
        $this->keuanganModel->insert($dataKeuangan);

        return redirect()->back()->with('success', 'Donasi berhasil diverifikasi dan ditambahkan ke laporan keuangan.');
    }

    public function reject($id)
    {
        $donasi = $this->donasiModel->find($id);

        if (empty($donasi)) {
            return redirect()->back()->with('error', 'Donasi tidak ditemukan.');
        }

        if ($donasi['status'] !== 'Pending') {
            return redirect()->back()->with('error', 'Donasi sudah diverifikasi atau ditolak sebelumnya.');
        }

        // Update status donasi
        $this->donasiModel->update($id, ['status' => 'Rejected']);

        return redirect()->back()->with('success', 'Donasi berhasil ditolak.');
    }

    public function delete($id)
    {
        $donasi = $this->donasiModel->find($id);
        if (!$donasi) {
            return redirect()->back()->with('error', 'Donasi tidak ditemukan.');
        }
        // Hapus file bukti jika ada
        if (!empty($donasi['bukti_pembayaran'])) {
            $filePath = FCPATH . 'uploads/donasi/' . $donasi['bukti_pembayaran'];
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
        $this->donasiModel->delete($id);
        return redirect()->back()->with('success', 'Donasi berhasil dihapus.');
    }
}


