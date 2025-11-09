<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('sidebar') ?>
    <?= $this->include('components/sidebar_user') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2 class="page-title">Tambah Surat</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('user/dashboard') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('user/persuratan') ?>">Persuratan</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah Surat</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="card mt-4">
    <div class="card-header">
        <h5 class="card-title mb-0">Form Tambah Surat</h5>
    </div>
    <div class="card-body">
        <form action="<?= base_url('user/persuratan/store') ?>" method="post">
            <?= csrf_field() ?>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Lokasi</label>
                    <input type="text" name="lokasi" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Nomor Surat</label>
                    <input type="text" name="nomor" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Lampiran</label>
                    <input type="text" name="lampiran" class="form-control">
                </div>
                <div class="col-md-12">
                    <label class="form-label">Perihal</label>
                    <input type="text" name="perihal" class="form-control" required>
                </div>
                <div class="col-md-12">
                    <label class="form-label">Isi Surat</label>
                    <textarea name="isi_surat" class="form-control" rows="6" required></textarea>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Nama Penandatangan</label>
                    <input type="text" name="nama_penandatangan" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Jabatan Penandatangan</label>
                    <input type="text" name="jabatan_penandatangan" class="form-control" required>
                </div>
                <div class="col-md-12">
                    <label class="form-label">Tujuan</label>
                    <input type="text" name="tujuan" class="form-control" required>
                </div>
            </div>
            <div class="d-flex justify-content-end mt-4">
                <button type="submit" class="btn btn-dark"><i class="fas fa-save me-2"></i>Simpan</button>
                <a href="<?= base_url('user/persuratan') ?>" class="btn btn-secondary ms-2">Batal</a>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?> 