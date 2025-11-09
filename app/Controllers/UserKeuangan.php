<?php

namespace App\Controllers;

use App\Models\KeuanganModel;
use CodeIgniter\Controller;

class UserKeuangan extends BaseController
{
    protected $keuanganModel;
    protected $helpers = ['form'];

    public function __construct()
    {
        $this->keuanganModel = new KeuanganModel();
    }

    public function index()
    {
        $filters = [
            'jenis' => $this->request->getGet('jenis'),
            'kategori' => $this->request->getGet('kategori'),
            'tanggal_dari' => $this->request->getGet('tanggal_dari'),
            'tanggal_sampai' => $this->request->getGet('tanggal_sampai')
        ];

        $data = [
            'title' => 'Kelola Keuangan',
            'user' => session()->get('user_data'),
            'keuangan' => $this->keuanganModel->getKeuanganWithFilters($filters),
            'total_pemasukan' => $this->keuanganModel->getTotalPemasukan($filters),
            'total_pengeluaran' => $this->keuanganModel->getTotalPengeluaran($filters),
            'saldo' => $this->keuanganModel->getSaldo($filters),
            'kategori_list' => $this->keuanganModel->getKategoriList(),
            'filters' => $filters
        ];

        return view('user/keuangan/index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Transaksi',
            'user' => session()->get('user_data'),
            'kategori_list' => $this->keuanganModel->getKategoriList()
        ];

        return view('user/keuangan/create', $data);
    }

    public function store()
    {
        $validation = \Config\Services::validation();
        
        $user_data = session()->get('user_data');
        if (!is_array($user_data) || !isset($user_data['id'])) {
            session()->destroy();
            return redirect()->to('/auth/login')->with('error', 'Sesi Anda tidak valid. Silakan login ulang.');
        }
        $rules = [
            'tanggal_transaksi' => 'required|valid_date',
            'jenis' => 'required|in_list[Pemasukan,Pengeluaran]',
            'kategori' => 'required|min_length[3]|max_length[50]',
            'nominal' => 'required|numeric|greater_than[0]',
            'keterangan' => 'permit_empty|max_length[500]',
            'bukti_transaksi' => 'permit_empty|uploaded[bukti_transaksi]|max_size[bukti_transaksi,2048]|is_image[bukti_transaksi]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $data = [
            'tanggal_transaksi' => $this->request->getPost('tanggal_transaksi'),
            'jenis' => $this->request->getPost('jenis'),
            'kategori' => $this->request->getPost('kategori'),
            'nominal' => $this->request->getPost('nominal'),
            'keterangan' => $this->request->getPost('keterangan'),
            'created_by' => $user_data['id']
        ];

        // Handle file upload
        $file = $this->request->getFile('bukti_transaksi');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'uploads/keuangan', $newName);
            $data['bukti_transaksi'] = $newName;
        }

        if ($this->keuanganModel->insert($data)) {
            return redirect()->to('/user/keuangan')->with('success', 'Transaksi berhasil ditambahkan');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan transaksi');
        }
    }

    public function edit($id)
    {
        $keuanganData = $this->keuanganModel->find($id);
        
        if (!$keuanganData) {
            return redirect()->to('/user/keuangan')->with('error', 'Transaksi tidak ditemukan');
        }

        $data = [
            'title' => 'Edit Transaksi',
            'user' => session()->get('user_data'),
            'keuanganData' => $keuanganData,
            'kategori_list' => $this->keuanganModel->getKategoriList()
        ];

        return view('user/keuangan/edit', $data);
    }

    public function update($id)
    {
        $keuanganData = $this->keuanganModel->find($id);
        
        if (!$keuanganData) {
            return redirect()->to('/user/keuangan')->with('error', 'Transaksi tidak ditemukan');
        }

        $validation = \Config\Services::validation();
        
        $rules = [
            'tanggal_transaksi' => 'required|valid_date',
            'jenis' => 'required|in_list[Pemasukan,Pengeluaran]',
            'kategori' => 'required|min_length[3]|max_length[50]',
            'nominal' => 'required|numeric|greater_than[0]',
            'keterangan' => 'permit_empty|max_length[500]',
            'bukti_transaksi' => 'permit_empty|uploaded[bukti_transaksi]|max_size[bukti_transaksi,2048]|is_image[bukti_transaksi]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $data = [
            'tanggal_transaksi' => $this->request->getPost('tanggal_transaksi'),
            'jenis' => $this->request->getPost('jenis'),
            'kategori' => $this->request->getPost('kategori'),
            'nominal' => $this->request->getPost('nominal'),
            'keterangan' => $this->request->getPost('keterangan')
        ];

        // Handle file upload
        $file = $this->request->getFile('bukti_transaksi');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            // Delete old file if exists
            if ($keuanganData['bukti_transaksi'] && file_exists(FCPATH . 'uploads/keuangan/' . $keuanganData['bukti_transaksi'])) {
                unlink(FCPATH . 'uploads/keuangan/' . $keuanganData['bukti_transaksi']);
            }
            
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'uploads/keuangan', $newName);
            $data['bukti_transaksi'] = $newName;
        }

        if ($this->keuanganModel->update($id, $data)) {
            return redirect()->to('/user/keuangan')->with('success', 'Transaksi berhasil diperbarui');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui transaksi');
        }
    }

    public function delete($id)
    {
        $keuanganData = $this->keuanganModel->find($id);
        
        if (!$keuanganData) {
            return redirect()->to('/user/keuangan')->with('error', 'Transaksi tidak ditemukan');
        }

        // Delete file if exists
        if ($keuanganData['bukti_transaksi'] && file_exists(FCPATH . 'uploads/keuangan/' . $keuanganData['bukti_transaksi'])) {
            unlink(FCPATH . 'uploads/keuangan/' . $keuanganData['bukti_transaksi']);
        }

        if ($this->keuanganModel->delete($id)) {
            return redirect()->to('/user/keuangan')->with('success', 'Transaksi berhasil dihapus');
        } else {
            return redirect()->to('/user/keuangan')->with('error', 'Gagal menghapus transaksi');
        }
    }

    public function show($id)
    {
        $keuanganData = $this->keuanganModel->find($id);
        
        if (!$keuanganData) {
            return redirect()->to('/user/keuangan')->with('error', 'Transaksi tidak ditemukan');
        }

        $data = [
            'title' => 'Detail Transaksi',
            'user' => session()->get('user_data'),
            'keuanganData' => $keuanganData
        ];

        return view('user/keuangan/show', $data);
    }

    public function exportPdf()
    {
        $filters = [
            'jenis' => $this->request->getGet('jenis'),
            'kategori' => $this->request->getGet('kategori'),
            'tanggal_dari' => $this->request->getGet('tanggal_dari'),
            'tanggal_sampai' => $this->request->getGet('tanggal_sampai')
        ];

        $keuangan = $this->keuanganModel->getKeuanganWithFilters($filters);
        $total_pemasukan = $this->keuanganModel->getTotalPemasukan($filters);
        $total_pengeluaran = $this->keuanganModel->getTotalPengeluaran($filters);
        $saldo = $this->keuanganModel->getSaldo($filters);

        // Create new PDF document
        $pdf = new \TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // Set document information
        $pdf->SetCreator('Masjid Nurul Falah');
        $pdf->SetAuthor('Sistem Informasi Masjid');
        $pdf->SetTitle('Laporan Keuangan Masjid');
        $pdf->SetSubject('Laporan Keuangan');

        // Set default header data
        $pdf->SetHeaderData('', 0, 'MASJID NURUL FALAH', 'Laporan Keuangan Masjid' . "\n" . 'Desa Leworeng, Kab. Soppeng, Sulsel');

        // Set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // Set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // Set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // Set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // Set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // Add a page
        $pdf->AddPage();

        // Set font
        $pdf->SetFont('helvetica', '', 10);

        // Filter information
        $filterInfo = '';
        if (!empty($filters['jenis'])) {
            $filterInfo .= 'Jenis: ' . $filters['jenis'] . ' | ';
        }
        if (!empty($filters['kategori'])) {
            $filterInfo .= 'Kategori: ' . $filters['kategori'] . ' | ';
        }
        if (!empty($filters['tanggal_dari'])) {
            $filterInfo .= 'Dari: ' . date('d/m/Y', strtotime($filters['tanggal_dari'])) . ' | ';
        }
        if (!empty($filters['tanggal_sampai'])) {
            $filterInfo .= 'Sampai: ' . date('d/m/Y', strtotime($filters['tanggal_sampai'])) . ' | ';
        }
        $filterInfo = rtrim($filterInfo, ' | ');
        
        if (!empty($filterInfo)) {
            $pdf->Cell(0, 10, 'Filter: ' . $filterInfo, 0, 1, 'L');
            $pdf->Ln(5);
        }

        // Summary
        $pdf->SetFont('helvetica', 'B', 12);
        $pdf->Cell(0, 10, 'RINGKASAN KEUANGAN', 0, 1, 'C');
        $pdf->Ln(5);

        $pdf->SetFont('helvetica', '', 10);
        $pdf->Cell(60, 8, 'Total Pemasukan:', 1, 0, 'L');
        $pdf->Cell(60, 8, 'Rp ' . number_format($total_pemasukan, 0, ',', '.'), 1, 1, 'R');
        
        $pdf->Cell(60, 8, 'Total Pengeluaran:', 1, 0, 'L');
        $pdf->Cell(60, 8, 'Rp ' . number_format($total_pengeluaran, 0, ',', '.'), 1, 1, 'R');
        
        $pdf->SetFont('helvetica', 'B', 10);
        $pdf->Cell(60, 8, 'Saldo:', 1, 0, 'L');
        $pdf->Cell(60, 8, 'Rp ' . number_format($saldo, 0, ',', '.'), 1, 1, 'R');
        
        $pdf->Ln(10);

        // Transaction table
        $pdf->SetFont('helvetica', 'B', 12);
        $pdf->Cell(0, 10, 'DETAIL TRANSAKSI', 0, 1, 'C');
        $pdf->Ln(5);

        // Table header
        $pdf->SetFont('helvetica', 'B', 9);
        $pdf->Cell(20, 8, 'No', 1, 0, 'C');
        $pdf->Cell(25, 8, 'Tanggal', 1, 0, 'C');
        $pdf->Cell(25, 8, 'Jenis', 1, 0, 'C');
        $pdf->Cell(30, 8, 'Kategori', 1, 0, 'C');
        $pdf->Cell(35, 8, 'Nominal', 1, 0, 'C');
        $pdf->Cell(45, 8, 'Keterangan', 1, 1, 'C');

        // Table data
        $pdf->SetFont('helvetica', '', 8);
        $no = 1;
        foreach ($keuangan as $item) {
            $pdf->Cell(20, 6, $no++, 1, 0, 'C');
            $pdf->Cell(25, 6, date('d/m/Y', strtotime($item['tanggal_transaksi'])), 1, 0, 'C');
            $pdf->Cell(25, 6, $item['jenis'], 1, 0, 'C');
            $pdf->Cell(30, 6, $item['kategori'], 1, 0, 'L');
            $pdf->Cell(35, 6, 'Rp ' . number_format($item['nominal'], 0, ',', '.'), 1, 0, 'R');
            $pdf->Cell(45, 6, substr($item['keterangan'], 0, 30) . (strlen($item['keterangan']) > 30 ? '...' : ''), 1, 1, 'L');
        }

        if (empty($keuangan)) {
            $pdf->Cell(0, 10, 'Tidak ada data transaksi', 1, 1, 'C');
        }

        // Output PDF
        $filename = 'Laporan_Keuangan_' . date('Y-m-d_H-i-s') . '.pdf';
        $pdf->Output($filename, 'D');
    }
}

