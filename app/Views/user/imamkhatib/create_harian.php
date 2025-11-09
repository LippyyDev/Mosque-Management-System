<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('sidebar') ?>
    <?= $this->include('components/sidebar_user') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2 class="page-title">Tambah Jadwal Imam & Muadzin Harian</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('user/dashboard') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('user/imamkhatib') ?>">Jadwal Imam, Khatib & Muadzin</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah Data Harian</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<div class="card mt-4">
    <div class="card-header">
        <h5 class="card-title mb-0">Form Tambah Data Harian</h5>
    </div>
    <div class="card-body">
        <?php if (session('errors')): ?>
            <div class="alert alert-danger">
                <?php foreach (session('errors') as $error): ?>
                    <p><?= esc($error) ?></p>
                <?php endforeach ?>
            </div>
        <?php endif; ?>
        <form action="<?= base_url('user/imamkhatib/harian/store') ?>" method="post">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label for="nama_imam_harian" class="form-label">Nama Imam Harian</label>
                <input type="text" class="form-control" id="nama_imam_harian" name="nama_imam_harian" value="<?= old('nama_imam_harian') ?>" required>
            </div>
            <div class="mb-3">
                <label for="nama_muadzin" class="form-label">Nama Muadzin</label>
                <input type="text" class="form-control" id="nama_muadzin" name="nama_muadzin" value="<?= old('nama_muadzin') ?>" required>
            </div>
            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal (Opsional)</label>
                <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?= old('tanggal') ?>" placeholder="Kosongkan untuk status Fleksibel">
                <small class="form-text text-muted">Kosongkan jika jadwal bersifat fleksibel</small>
            </div>
            <div class="mb-3">
                <label for="keterangan" class="form-label">Keterangan</label>
                <textarea class="form-control" id="keterangan" name="keterangan" rows="3"><?= old('keterangan') ?></textarea>
            </div>
            <div class="d-flex justify-content-end">
                <a href="<?= base_url('user/imamkhatib') ?>" class="btn btn-secondary me-2">Batal</a>
                <button type="submit" class="btn btn-dark">Simpan</button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?> 