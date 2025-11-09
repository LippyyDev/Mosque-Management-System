<?php

namespace App\Controllers;

use App\Models\PengaturanModel;
use App\Models\BeritaModel;
use App\Models\BeritaGambarModel;
use App\Models\GaleriModel;
use App\Models\KeuanganModel;
use App\Models\DonasiModel;
use App\Models\PengurusModel;
use App\Models\InventarisModel;
use App\Models\ImamKhatibModel;
use App\Models\ImamMuadzinHarianModel;
use CodeIgniter\I18n\Time;

class Home extends BaseController
{
    public function index()
    {
        $pengaturanModel = new PengaturanModel();
        $beritaModel = new BeritaModel();
        $beritaGambarModel = new BeritaGambarModel();
        $galeriModel = new GaleriModel();
        $keuanganModel = new KeuanganModel();
        $donasiModel = new DonasiModel();
        $pengurusModel = new PengurusModel();
        $imamKhatibModel = new ImamKhatibModel();
        $imamMuadzinHarianModel = new ImamMuadzinHarianModel();
        $inventarisModel = new InventarisModel();

        // Fetch Prayer Times with Caching
        $cache = \Config\Services::cache();
        $today = Time::now('Asia/Makassar');
        $cacheKey = 'prayer_times_' . $today->toDateString(); // Unique key for today's schedule

        if (!$prayerData = $cache->get($cacheKey)) {
            // Data not in cache, so we fetch from API
            try {
                $url = "https://api.myquran.com/v2/sholat/jadwal/2617/{$today->getYear()}/{$today->getMonth()}/{$today->getDay()}";
                $context = stream_context_create(["ssl" => ["verify_peer" => false, "verify_peer_name" => false]]);
                $response = @file_get_contents($url, false, $context);

                if ($response !== false) {
                    $apiResult = json_decode($response, true);
                    if (isset($apiResult['status']) && $apiResult['status'] === true) {
                        $prayerData = $apiResult['data']['jadwal'];
                        // Save to cache for 6 hours (21600 seconds)
                        $cache->save($cacheKey, $prayerData, 21600);
                    }
                }
            } catch (\Exception $e) {
                log_message('error', '[PrayerAPI] ' . $e->getMessage());
                $prayerData = null;
            }
        }
        
        // Statistik
        $totalKeuangan = $keuanganModel->getSaldo();
        $totalDonasi = $donasiModel->selectSum('nominal')->get()->getRow()->nominal ?? 0;
        $totalPengurus = $pengurusModel->countAllResults();
        $totalInventaris = $inventarisModel->getTotalInventaris();

        $berita = $beritaModel->getLatestWithCover(3);
        $galeri = $galeriModel->getLatestWithCover(6);
        $imamKhatibSchedule = $imamKhatibModel->getUpcomingSchedule();
        $jadwal_harian = $imamMuadzinHarianModel->orderBy('tanggal', 'ASC')->findAll();

        $data = [
            'pengaturan' => $pengaturanModel->first() ?? [],
            'berita' => $berita,
            'galeri' => $galeri,
            'total_keuangan' => $totalKeuangan,
            'total_donasi' => $totalDonasi,
            'total_pengurus' => $totalPengurus,
            'total_inventaris' => $totalInventaris,
            'prayer_times' => $prayerData,
            'imam_khatib' => $imamKhatibSchedule,
            'jadwal_harian' => $jadwal_harian,
        ];

        return view('welcome_message', $data);
    }

    public function sejarah()
    {
        $pengaturanModel = new PengaturanModel();
        $data = [
            'title' => 'Sejarah Masjid',
            'pengaturan' => $pengaturanModel->first() ?? []
        ];
        return view('sejarah', $data);
    }

    public function visimisi()
    {
        $pengaturanModel = new PengaturanModel();
        $data = [
            'title' => 'Visi & Misi Masjid',
            'pengaturan' => $pengaturanModel->first() ?? []
        ];
        return view('visimisi', $data);
    }

    public function tentang()
    {
        $pengaturanModel = new PengaturanModel();
        $data = [
            'title' => 'Tentang Kami',
            'pengaturan' => $pengaturanModel->first() ?? []
        ];
        return view('tentang', $data);
    }

    public function imamKhatib()
    {
        $imamKhatibModel = new \App\Models\ImamKhatibModel();
        $pengaturanModel = new \App\Models\PengaturanModel();

        $data = [
            'title' => 'Jadwal Imam & Khatib',
            'jadwal' => $imamKhatibModel->getAllUpcoming(),
            'pengaturan' => $pengaturanModel->first() ?? []
        ];

        return view('imam_khatib', $data);
    }

    public function keuangan()
    {
        $keuanganModel = new \App\Models\KeuanganModel();
        $pengaturanModel = new \App\Models\PengaturanModel();

        $filters = [
            'jenis' => $this->request->getGet('jenis'),
            'kategori' => $this->request->getGet('kategori'),
            'tanggal_dari' => $this->request->getGet('tanggal_dari'),
            'tanggal_sampai' => $this->request->getGet('tanggal_sampai')
        ];

        // Pagination
        $page = $this->request->getGet('page') ?? 1;
        $perPage = 10;
        $offset = ($page - 1) * $perPage;

        // Get total records for pagination
        $totalRecords = $keuanganModel->getKeuanganWithFilters($filters, true);
        $totalPages = ceil($totalRecords / $perPage);

        // Get paginated data
        $keuangan = $keuanganModel->getKeuanganWithFilters($filters, false, $perPage, $offset);

        $data = [
            'title' => 'Laporan Keuangan',
            'keuangan' => $keuangan,
            'total_pemasukan' => $keuanganModel->getTotalPemasukan($filters),
            'total_pengeluaran' => $keuanganModel->getTotalPengeluaran($filters),
            'saldo' => $keuanganModel->getSaldo($filters),
            'kategori_list' => $keuanganModel->getKategoriList(),
            'filters' => $filters,
            'pengaturan' => $pengaturanModel->first() ?? [],
            'pagination' => [
                'current_page' => $page,
                'total_pages' => $totalPages,
                'per_page' => $perPage,
                'total_records' => $totalRecords
            ]
        ];

        return view('keuangan', $data);
    }

    public function exportKeuanganPdf()
    {
        $keuanganModel = new \App\Models\KeuanganModel();

        $filters = [
            'jenis' => $this->request->getGet('jenis'),
            'kategori' => $this->request->getGet('kategori'),
            'tanggal_dari' => $this->request->getGet('tanggal_dari'),
            'tanggal_sampai' => $this->request->getGet('tanggal_sampai')
        ];

        $keuangan = $keuanganModel->getKeuanganWithFilters($filters);
        $total_pemasukan = $keuanganModel->getTotalPemasukan($filters);
        $total_pengeluaran = $keuanganModel->getTotalPengeluaran($filters);
        $saldo = $keuanganModel->getSaldo($filters);

        $pdf = new \TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetCreator('Masjid Nurul Falah');
        $pdf->SetAuthor('Sistem Informasi Masjid');
        $pdf->SetTitle('Laporan Keuangan Masjid');
        $pdf->SetHeaderData('', 0, 'MASJID NURUL FALAH', 'Laporan Keuangan Masjid' . "\n" . 'Desa Leworeng, Kab. Soppeng, Sulsel');
        $pdf->setHeaderFont([PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN]);
        $pdf->setFooterFont([PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA]);
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        $pdf->AddPage();
        $pdf->SetFont('helvetica', '', 10);

        $filterInfo = '';
        if (!empty($filters['jenis'])) $filterInfo .= 'Jenis: ' . $filters['jenis'] . ' | ';
        if (!empty($filters['kategori'])) $filterInfo .= 'Kategori: ' . $filters['kategori'] . ' | ';
        if (!empty($filters['tanggal_dari'])) $filterInfo .= 'Dari: ' . date('d/m/Y', strtotime($filters['tanggal_dari'])) . ' | ';
        if (!empty($filters['tanggal_sampai'])) $filterInfo .= 'Sampai: ' . date('d/m/Y', strtotime($filters['tanggal_sampai'])) . ' | ';
        
        if (!empty($filterInfo)) {
            $pdf->Cell(0, 10, 'Filter: ' . rtrim($filterInfo, ' | '), 0, 1, 'L');
            $pdf->Ln(5);
        }

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
        $pdf->SetFont('helvetica', 'B', 12);
        $pdf->Cell(0, 10, 'DETAIL TRANSAKSI', 0, 1, 'C');
        $pdf->Ln(5);
        $pdf->SetFont('helvetica', 'B', 9);
        $pdf->Cell(15, 8, 'No', 1, 0, 'C');
        $pdf->Cell(30, 8, 'Tanggal', 1, 0, 'C');
        $pdf->Cell(30, 8, 'Jenis', 1, 0, 'C');
        $pdf->Cell(35, 8, 'Kategori', 1, 0, 'C');
        $pdf->Cell(40, 8, 'Nominal', 1, 0, 'C');
        $pdf->Cell(40, 8, 'Keterangan', 1, 1, 'C');
        $pdf->SetFont('helvetica', '', 8);
        $no = 1;
        foreach ($keuangan as $item) {
            $pdf->Cell(15, 6, $no++, 1, 0, 'C');
            $pdf->Cell(30, 6, date('d/m/Y', strtotime($item['tanggal_transaksi'])), 1, 0, 'C');
            $pdf->Cell(30, 6, $item['jenis'], 1, 0, 'L');
            $pdf->Cell(35, 6, $item['kategori'], 1, 0, 'L');
            $pdf->Cell(40, 6, 'Rp ' . number_format($item['nominal'], 0, ',', '.'), 1, 0, 'R');
            $pdf->Cell(40, 6, substr($item['keterangan'], 0, 25) . (strlen($item['keterangan']) > 25 ? '...' : ''), 1, 1, 'L');
        }
        if (empty($keuangan)) {
            $pdf->Cell(0, 10, 'Tidak ada data transaksi', 1, 1, 'C');
        }
        $filename = 'Laporan_Keuangan_' . date('Y-m-d_H-i-s') . '.pdf';
        $this->response->setHeader('Content-Type', 'application/pdf');
        $pdf->Output($filename, 'D');
    }

    public function inventaris()
    {
        $inventarisModel = new \App\Models\InventarisModel();
        $pengaturanModel = new \App\Models\PengaturanModel();

        $filters = [
            'nama' => $this->request->getGet('nama'),
            'kategori' => $this->request->getGet('kategori'),
            'kondisi' => $this->request->getGet('kondisi')
        ];

        // Get paginated data using CodeIgniter 4's built-in pagination
        $inventarisData = $inventarisModel->getInventarisWithFilters($filters, 10);
        $inventaris = $inventarisData['inventaris'];
        $pager = $inventarisData['pager'];

        $data = [
            'title' => 'Inventaris Masjid',
            'inventaris' => $inventaris,
            'kategori_list' => $inventarisModel->getDistinctKategori(),
            'filters' => $filters,
            'pengaturan' => $pengaturanModel->first() ?? [],
            'pager' => $pager,
            'pagination' => [
                'current_page' => $pager->getCurrentPage(),
                'total_pages' => $pager->getPageCount(),
                'per_page' => $pager->getPerPage(),
                'total_records' => $pager->getTotal()
            ]
        ];

        return view('inventaris', $data);
    }

    public function store_masukan()
    {
        // ... existing code ...
    }

    public function donasi()
    {
        $pengaturanModel = new \App\Models\PengaturanModel();
        $data = [
            'title' => 'Form Donasi',
            'pengaturan' => $pengaturanModel->first() ?? [],
            'validation' => \Config\Services::validation(),
        ];
        return view('donasi', $data);
    }

    public function submitDonasi()
    {
        $validation = \Config\Services::validation();
        $donasiModel = new \App\Models\DonasiModel();
        $pengaturanModel = new \App\Models\PengaturanModel();

        $rules = [
            'nama' => 'required|min_length[3]',
            'nominal' => 'required|numeric',
            'bukti_pembayaran' => 'uploaded[bukti_pembayaran]|max_size[bukti_pembayaran,2048]|is_image[bukti_pembayaran]|mime_in[bukti_pembayaran,image/jpg,image/jpeg,image/png,image/webp]'
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }

        $bukti = $this->request->getFile('bukti_pembayaran');
        $buktiName = null;
        if ($bukti && $bukti->isValid() && !$bukti->hasMoved()) {
            $buktiName = $bukti->getRandomName();
            $bukti->move(FCPATH . 'uploads/donasi', $buktiName);
        }

        $data = [
            'nama' => $this->request->getPost('nama'),
            'nominal' => $this->request->getPost('nominal'),
            'bukti_pembayaran' => $buktiName,
            'catatan' => $this->request->getPost('catatan'),
            'status' => 'Pending',
        ];

        $donasiModel->insert($data);
        return redirect()->to('/donasi')->with('success', 'Donasi berhasil dikirim! Terima kasih atas partisipasi Anda.');
    }

    public function feedback()
    {
        $pengaturanModel = new \App\Models\PengaturanModel();
        $data = [
            'title' => 'Kirim Masukan',
            'pengaturan' => $pengaturanModel->first() ?? [],
            'validation' => \Config\Services::validation(),
        ];
        return view('feedback', $data);
    }

    public function submitFeedback()
    {
        $validation = \Config\Services::validation();
        $masukanModel = new \App\Models\MasukanModel();
        $rules = [
            'nama' => 'required|min_length[3]',
            'kontak' => 'permit_empty',
            'isi_masukan' => 'required|min_length[5]'
        ];
        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $validation->getErrors());
        }
        $data = [
            'nama' => $this->request->getPost('nama'),
            'kontak' => $this->request->getPost('kontak'),
            'isi_masukan' => $this->request->getPost('isi_masukan'),
        ];
        $masukanModel->insert($data);
        return redirect()->to('/feedback')->with('success', 'Masukan berhasil dikirim! Terima kasih atas partisipasi Anda.');
    }
}
