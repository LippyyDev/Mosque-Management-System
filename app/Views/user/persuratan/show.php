<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('sidebar') ?>
    <?= $this->include('components/sidebar_user') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2 class="page-title">Detail Surat</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('user/dashboard') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('user/persuratan') ?>">Persuratan</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail Surat</li>
                </ol>
            </nav>
        </div>
        <div>
            <a href="<?= base_url('user/persuratan/preview-a4/'.$surat['id']) ?>" class="btn btn-secondary"><i class="fas fa-file-alt me-2"></i>Preview A4</a>
            <a href="<?= base_url('user/persuratan/export-word/'.$surat['id']) ?>" class="btn btn-info"><i class="fas fa-file-word me-2"></i>Export Word</a>
        </div>
    </div>
</div>
<div class="card mt-4">
    <div class="card-header">
        <h5 class="card-title mb-0">Informasi Surat</h5>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <tr><th>Lokasi</th><td><?= esc($surat['lokasi']) ?></td></tr>
            <tr><th>Tanggal</th><td><?= date('d-m-Y', strtotime($surat['tanggal'])) ?></td></tr>
            <tr><th>Nomor Surat</th><td><?= esc($surat['nomor']) ?></td></tr>
            <tr><th>Lampiran</th><td><?= esc($surat['lampiran']) ?></td></tr>
            <tr><th>Perihal</th><td><?= esc($surat['perihal']) ?></td></tr>
            <tr><th>Isi Surat</th><td style="white-space:pre-line;"><?= esc($surat['isi_surat']) ?></td></tr>
            <tr><th>Nama Penandatangan</th><td><?= esc($surat['nama_penandatangan']) ?></td></tr>
            <tr><th>Jabatan Penandatangan</th><td><?= esc($surat['jabatan_penandatangan']) ?></td></tr>
            <tr><th>Tujuan</th><td><?= esc($surat['tujuan']) ?></td></tr>
        </table>
        <a href="<?= base_url('user/persuratan') ?>" class="btn btn-secondary">Kembali</a>
    </div>
</div>
<?= $this->endSection() ?> 