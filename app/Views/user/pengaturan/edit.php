<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('sidebar') ?>
<?= $this->include('components/sidebar_user') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2 class="page-title">Edit Pengaturan Masjid</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('user/dashboard') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('user/pengaturan') ?>">Pengaturan</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<?php if (session()->getFlashdata('validation')): ?>
    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
        <?= session('validation')->listErrors() ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>
<div class="card mt-4">
    <div class="card-header">
        <h5 class="card-title mb-0">Form Edit Pengaturan</h5>
    </div>
    <div class="card-body">
        <form action="<?= base_url('user/pengaturan/update') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label for="nama_masjid" class="form-label">Nama Masjid</label>
                <input type="text" name="nama_masjid" id="nama_masjid" class="form-control" value="<?= set_value('nama_masjid', $pengaturan['nama_masjid'] ?? '') ?>" required>
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea name="alamat" id="alamat" class="form-control" required><?= set_value('alamat', $pengaturan['alamat'] ?? '') ?></textarea>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="nomor_hp" class="form-label">No. HP</label>
                        <input type="text" name="nomor_hp" id="nomor_hp" class="form-control" value="<?= set_value('nomor_hp', $pengaturan['nomor_hp'] ?? '') ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" class="form-control" value="<?= set_value('email', $pengaturan['email'] ?? '') ?>">
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="rekening_bank" class="form-label">Rekening Bank</label>
                <textarea name="rekening_bank" id="rekening_bank" class="form-control"><?= set_value('rekening_bank', $pengaturan['rekening_bank'] ?? '') ?></textarea>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="foto_qris" class="form-label">QRIS (Upload Baru)</label>
                        <input type="file" name="foto_qris" id="foto_qris" class="form-control">
                        <?php if (!empty($pengaturan['foto_qris']) && file_exists(FCPATH . 'uploads/qris/' . $pengaturan['foto_qris'])): ?>
                            <div class="mt-2">
                                <small>QRIS Saat Ini:</small><br>
                                <img src="<?= base_url('uploads/qris/' . $pengaturan['foto_qris']) ?>" alt="QRIS" style="max-width:100px; max-height:100px;" class="img-fluid">
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">Tampilkan QRIS di Beranda</label>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="qris_visible" value="1" id="qrisSwitch" <?= set_checkbox('qris_visible', '1', !empty($pengaturan['qris_visible']) && $pengaturan['qris_visible']) ?>>
                            <label class="form-check-label" for="qrisSwitch">Ya, tampilkan</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="tahun_berdiri" class="form-label">Tahun Berdiri</label>
                        <input type="number" name="tahun_berdiri" id="tahun_berdiri" class="form-control" value="<?= set_value('tahun_berdiri', $pengaturan['tahun_berdiri'] ?? '') ?>">
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="sejarah" class="form-label">Sejarah</label>
                <textarea name="sejarah" id="sejarah" class="form-control" rows="4"><?= set_value('sejarah', $pengaturan['sejarah'] ?? '') ?></textarea>
            </div>
            <div class="mb-3">
                <label for="visi" class="form-label">Visi</label>
                <textarea name="visi" id="visi" class="form-control" rows="3"><?= set_value('visi', $pengaturan['visi'] ?? '') ?></textarea>
            </div>
            <div class="mb-3">
                <label for="misi" class="form-label">Misi</label>
                <textarea name="misi" id="misi" class="form-control" rows="4"><?= set_value('misi', $pengaturan['misi'] ?? '') ?></textarea>
            </div>
            <div class="d-flex justify-content-end gap-2 mt-4">
                <a href="<?= base_url('user/pengaturan') ?>" class="btn btn-outline-secondary">
                    <i class="fas fa-arrow-left me-1"></i>Batal
                </a>
                <button type="submit" class="btn btn-dark">
                    <i class="fas fa-save me-1"></i>Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?> 