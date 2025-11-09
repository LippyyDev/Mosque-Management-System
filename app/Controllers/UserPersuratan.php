<?php
namespace App\Controllers;

use App\Models\PersuratanModel;

class UserPersuratan extends BaseController
{
    protected $persuratanModel;
    public function __construct()
    {
        $this->persuratanModel = new PersuratanModel();
    }

    public function index()
    {
        $persuratan = $this->persuratanModel->orderBy('tanggal', 'DESC')->findAll();
        $user = session()->get('user_data');
        return view('user/persuratan/index', [
            'persuratan' => $persuratan,
            'user' => $user
        ]);
    }

    public function create()
    {
        $user = session()->get('user_data');
        return view('user/persuratan/create', ['user' => $user]);
    }

    public function store()
    {
        $data = $this->request->getPost();
        $user = session()->get('user_data');
        $data['created_by'] = $user['id'] ?? null;
        $this->persuratanModel->save($data);
        return redirect()->to(base_url('user/persuratan'))->with('success', 'Surat berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $surat = $this->persuratanModel->find($id);
        $user = session()->get('user_data');
        return view('user/persuratan/edit', ['surat' => $surat, 'user' => $user]);
    }

    public function update($id)
    {
        $data = $this->request->getPost();
        $data['id'] = $id;
        $this->persuratanModel->save($data);
        return redirect()->to(base_url('user/persuratan'))->with('success', 'Surat berhasil diupdate.');
    }

    public function delete($id)
    {
        $this->persuratanModel->delete($id);
        return redirect()->to(base_url('user/persuratan'))->with('success', 'Surat berhasil dihapus.');
    }

    public function show($id)
    {
        $surat = $this->persuratanModel->find($id);
        $user = session()->get('user_data');
        return view('user/persuratan/show', ['surat' => $surat, 'user' => $user]);
    }

    public function previewA4($id)
    {
        $surat = $this->persuratanModel->find($id);
        $user = session()->get('user_data');
        return view('user/persuratan/preview_a4', ['surat' => $surat, 'user' => $user]);
    }

    public function exportWord($id)
    {
        $surat = $this->persuratanModel->find($id);
        if (!$surat) {
            return redirect()->back()->with('error', 'Surat tidak ditemukan.');
        }

        // Load PHPWord
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $section = $phpWord->addSection([
            'marginTop' => 600,
            'marginLeft' => 800,
            'marginRight' => 800,
            'marginBottom' => 600,
        ]);

        // Set default font ke Times New Roman
        $phpWord->setDefaultFontName('Times New Roman');
        $phpWord->setDefaultFontSize(12);

        // HEADER: Tabel 2 kolom (logo & judul)
        $headerTable = $section->addTable(['alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER, 'width' => 12000]);
        $headerTable->addRow();
        $logoPath = FCPATH . 'public/logo.png';
        if (file_exists($logoPath)) {
            $headerTable->addCell(1800, ['valign' => 'center'])->addImage($logoPath, [
                'width' => 60,
                'height' => 60,
                'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::LEFT,
                'wrappingStyle' => 'inline',
                'marginRight' => 10,
            ]);
        } else {
            $headerTable->addCell(1800, ['valign' => 'center']);
        }
        $cell = $headerTable->addCell(10200, ['valign' => 'center']);
        $cell->addText('MASJID NURUL FALAH', ['bold' => true, 'size' => 16], ['align' => 'center', 'spaceAfter' => 2]);
        $cell->addText('KECAMATAN DONRI DONRI KABUPATEN SOPPENG', ['bold' => true, 'size' => 14], ['align' => 'center', 'spaceAfter' => 2]);
        $cell->addText('PROVINSI SULAWESI SELATAN', ['bold' => true, 'size' => 14], ['align' => 'center', 'spaceAfter' => 2]);
        $cell->addText('Alamat: Leworeng, Kec. Donri Donri, Kab. Soppeng, Sulsel 90853', ['size' => 10], ['align' => 'center', 'spaceAfter' => 2]);

        // Garis tebal (panjang proporsional)
        $section->addTextBreak(0.2);
        $lineTable = $section->addTable(['width' => 12000, 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER]);
        $lineTable->addRow();
        $lineTable->addCell(12000, [
            'borderTopSize' => 12, 'borderTopColor' => '000000',
        ]);
        $section->addTextBreak(0.5);

        // Data surat
        $infoTable = $section->addTable([
            'width' => 100 * 50,
            'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::START,
            'cellMarginBottom' => 0
        ]);
        $infoTable->addRow();
        $infoTable->addCell(1500, ['vAlign' => 'center'])->addText('Nomor', [], ['spaceAfter' => 0]);
        $infoTable->addCell(200, ['vAlign' => 'center'])->addText(':', [], ['spaceAfter' => 0]);
        $infoTable->addCell(6000, ['vAlign' => 'center'])->addText($surat['nomor'], ['bold' => true], ['spaceAfter' => 0]);
        $infoTable->addRow();
        $infoTable->addCell(1500, ['vAlign' => 'center'])->addText('Lampiran', [], ['spaceAfter' => 0]);
        $infoTable->addCell(200, ['vAlign' => 'center'])->addText(':', [], ['spaceAfter' => 0]);
        $infoTable->addCell(6000, ['vAlign' => 'center'])->addText($surat['lampiran'], ['bold' => true], ['spaceAfter' => 0]);
        $infoTable->addRow();
        $infoTable->addCell(1500, ['vAlign' => 'center'])->addText('Perihal', [], ['spaceAfter' => 0]);
        $infoTable->addCell(200, ['vAlign' => 'center'])->addText(':', [], ['spaceAfter' => 0]);
        $infoTable->addCell(6000, ['vAlign' => 'center'])->addText($surat['perihal'], ['bold' => true], ['spaceAfter' => 0]);
        $section->addTextBreak(1);

        // Tujuan
        $section->addTextBreak(0.5);
        $section->addText('Kepada Yth.', [], ['spaceAfter' => 0]);
        $section->addText($surat['tujuan'], ['bold' => true], ['spaceAfter' => 0]);
        $section->addText('di-', [], ['spaceAfter' => 0]);
        $section->addText('T E M P A T', ['bold' => true], ['spaceAfter' => 0]);
        $section->addTextBreak(1);

        // Isi surat
        $isi = str_replace(["\r\n", "\r"], "\n", $surat['isi_surat']);
        foreach (explode("\n", $isi) as $baris) {
            if (trim($baris) !== '') {
                $section->addText(strip_tags($baris), [], ['spaceAfter' => 0, 'spaceBefore' => 0, 'lineHeight' => 1.15]);
            } else {
                $section->addTextBreak(1); // Baris kosong = spasi antar paragraf, sedikit lebih lebar
            }
        }
        $section->addText('ISI SURAT DISINI...', [], ['spaceAfter' => 0]);
        $section->addTextBreak(2);

        // Tanggal & tanda tangan (rata kanan)
        $section->addText(($surat['lokasi'] ? $surat['lokasi'] . ', ' : '') . date('d F Y', strtotime($surat['tanggal'])), null, ['align' => 'right']);
        $section->addText($surat['jabatan_penandatangan'] ?? 'Pengurus Masjid', ['bold' => true], ['align' => 'right']);
        $section->addTextBreak(3);
        $section->addText('(Nama Pengurus)', ['underline' => 'single'], ['align' => 'right']);

        // Output file
        $filename = 'Surat_' . $surat['nomor'] . '.docx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save('php://output');
        exit;
    }

    public function downloadTemplateWord()
    {
        // Load PHPWord
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $section = $phpWord->addSection([
            'marginTop' => 600,
            'marginLeft' => 800,
            'marginRight' => 800,
            'marginBottom' => 600,
        ]);
        $phpWord->setDefaultFontName('Times New Roman');
        $phpWord->setDefaultFontSize(12);

        // HEADER: Tabel 2 kolom (logo & judul)
        $headerTable = $section->addTable(['alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER, 'width' => 12000]);
        $headerTable->addRow();
        $logoPath = FCPATH . 'public/logo.png';
        if (file_exists($logoPath)) {
            $headerTable->addCell(1800, ['valign' => 'center'])->addImage($logoPath, [
                'width' => 60,
                'height' => 60,
                'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::LEFT,
                'wrappingStyle' => 'inline',
                'marginRight' => 10,
            ]);
        } else {
            $headerTable->addCell(1800, ['valign' => 'center']);
        }
        $cell = $headerTable->addCell(10200, ['valign' => 'center']);
        $cell->addText('MASJID NURUL FALAH', ['bold' => true, 'size' => 16], ['align' => 'center', 'spaceAfter' => 2]);
        $cell->addText('KECAMATAN DONRI DONRI KABUPATEN SOPPENG', ['bold' => true, 'size' => 14], ['align' => 'center', 'spaceAfter' => 2]);
        $cell->addText('PROVINSI SULAWESI SELATAN', ['bold' => true, 'size' => 14], ['align' => 'center', 'spaceAfter' => 2]);
        $cell->addText('Alamat: Leworeng, Kec. Donri Donri, Kab. Soppeng, Sulsel 90853', ['size' => 10], ['align' => 'center', 'spaceAfter' => 2]);

        // Garis tebal (panjang proporsional)
        $section->addTextBreak(0.2);
        $lineTable = $section->addTable(['width' => 12000, 'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::CENTER]);
        $lineTable->addRow();
        $lineTable->addCell(12000, [
            'borderTopSize' => 12, 'borderTopColor' => '000000',
        ]);
        $section->addTextBreak(0.5);

        // Data surat kosong
        $infoTable = $section->addTable([
            'width' => 100 * 50,
            'alignment' => \PhpOffice\PhpWord\SimpleType\JcTable::START,
            'cellMarginBottom' => 0
        ]);
        $infoTable->addRow();
        $infoTable->addCell(1500, ['vAlign' => 'center'])->addText('Nomor', [], ['spaceAfter' => 0]);
        $infoTable->addCell(200, ['vAlign' => 'center'])->addText(':', [], ['spaceAfter' => 0]);
        $infoTable->addCell(6000, ['vAlign' => 'center'])->addText('', ['bold' => true], ['spaceAfter' => 0]);
        $infoTable->addRow();
        $infoTable->addCell(1500, ['vAlign' => 'center'])->addText('Lampiran', [], ['spaceAfter' => 0]);
        $infoTable->addCell(200, ['vAlign' => 'center'])->addText(':', [], ['spaceAfter' => 0]);
        $infoTable->addCell(6000, ['vAlign' => 'center'])->addText('', ['bold' => true], ['spaceAfter' => 0]);
        $infoTable->addRow();
        $infoTable->addCell(1500, ['vAlign' => 'center'])->addText('Perihal', [], ['spaceAfter' => 0]);
        $infoTable->addCell(200, ['vAlign' => 'center'])->addText(':', [], ['spaceAfter' => 0]);
        $infoTable->addCell(6000, ['vAlign' => 'center'])->addText('', ['bold' => true], ['spaceAfter' => 0]);
        $section->addTextBreak(0.2);

        // Tujuan
        $section->addTextBreak(0.5);
        $section->addText('Kepada Yth.', [], ['spaceAfter' => 0]);
        $section->addText('di-', [], ['spaceAfter' => 0]);
        $section->addText('T E M P A T', ['bold' => true], ['spaceAfter' => 0]);
        $section->addTextBreak(1);

        // Isi surat dikosongkan
        $section->addText('ISI SURAT DISINI...', [], ['spaceAfter' => 0]);
        $section->addTextBreak(2);

        // Tanggal & tanda tangan (rata kanan)
        $section->addText('Leworeng, ' . date('d F Y'), null, ['align' => 'right']);
        $section->addText('Pengurus Masjid', ['bold' => true], ['align' => 'right']);
        $section->addTextBreak(3);
        $section->addText('(Nama Pengurus)', ['underline' => 'single'], ['align' => 'right']);

        // Output file
        $filename = 'Template_Surat_Masjid_Nurul_Falah.docx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save('php://output');
        exit;
    }
} 