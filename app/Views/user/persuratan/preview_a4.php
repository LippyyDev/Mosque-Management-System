<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('sidebar') ?>
    <?= $this->include('components/sidebar_user') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<style>
.a4-preview {
    width: 210mm;
    min-height: 297mm;
    margin: 0 auto;
    background: #fff;
    color: #000;
    box-shadow: 0 0 10px rgba(0,0,0,0.15);
    padding: 30px 40px;
    font-family: 'Times New Roman', Times, serif;
}
.a4-header {
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: flex-start;
    border-bottom: none;
    padding-bottom: 10px;
    margin-bottom: 10px;
    position: relative;
}
.a4-header img {
    height: 70px;
    margin-right: 20px;
    flex-shrink: 0;
}
.a4-header .title {
    font-size: 1.3rem;
    font-weight: bold;
    text-align: center;
    line-height: 1.2;
    margin: 0 auto;
    width: 100%;
    display: block;
}
.a4-separator {
    border-top: 3px solid #000;
    margin: 0 0 20px 0;
}
.a4-info-table td {
    padding: 2px 8px 2px 0;
    font-size: 1rem;
}
</style>
<div class="a4-preview">
    <div class="a4-header">
        <img src="<?= base_url('public/logo.png') ?>" alt="Logo Masjid">
        <div class="title">
            MASJID NURUL FALAH<br>
            KECAMATAN DONRI DONRI KABUPATEN SOPPENG<br>
            PROVINSI SULAWESI SELATAN<br>
            <span style="font-size:0.95rem;font-weight:normal;">Alamat: Leworeng, Kec. Donri Donri, Kab. Soppeng, Sulsel 90853</span>
        </div>
    </div>
    <div class="a4-separator"></div>
    <table class="a4-info-table" style="width:100%; margin-bottom: 20px;">
        <tr>
            <td style="width:90px;">Nomor</td>
            <td style="width:10px;">:</td>
            <td><?= esc($surat['nomor']) ?></td>
        </tr>
        <tr>
            <td>Lampiran</td>
            <td>:</td>
            <td><?= esc($surat['lampiran']) ?></td>
        </tr>
        <tr>
            <td>Perihal</td>
            <td>:</td>
            <td><b><?= esc($surat['perihal']) ?></b></td>
        </tr>
    </table>
    <div style="margin-bottom: 20px;">
        <div style="margin-bottom: 0.5rem;">Kepada Yth.</div>
        <div style="margin-bottom: 0.5rem; font-weight: bold;"> <?= esc($surat['tujuan']) ?> </div>
        <div style="margin-bottom: 0.5rem;">di-</div>
        <div style="font-weight: bold; letter-spacing: 2px;">T E M P A T</div>
    </div>
    <div style="margin-bottom:20px;white-space:pre-line;">
        <?= esc($surat['isi_surat']) ?>
    </div>
    <div style="margin-top:40px;">
        <div style="float:right;text-align:center;">
            <?= esc($surat['lokasi']) ?>, <?= date('d F Y', strtotime($surat['tanggal'])) ?><br>
            <b><?= esc($surat['jabatan_penandatangan']) ?></b><br><br><br><br>
            <u><?= esc($surat['nama_penandatangan']) ?></u>
        </div>
        <div style="clear:both;"></div>
    </div>
    <div class="mt-4">
        <a href="<?= base_url('user/persuratan/export-word/'.$surat['id']) ?>" class="btn btn-info"><i class="fas fa-file-word me-2"></i>Export ke Word</a>
        <a href="<?= base_url('user/persuratan') ?>" class="btn btn-secondary">Kembali</a>
    </div>
</div>
<?= $this->endSection() ?> 