<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Tambah Donasi</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Form Tambah Donasi</h6>
        </div>
        <div class="card-body">
            <form action="<?= base_url('user/donasi/store') ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field() ?>
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Donatur <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="nama" name="nama" value="<?= old('nama') ?>" required>
                    <?php if (session('errors.nama')) : ?>
                        <div class="text-danger mt-2"><?= session('errors.nama') ?></div>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="nominal" class="form-label">Nominal (Rp) <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" id="nominal" name="nominal" value="<?= old('nominal') ?>" required>
                    <?php if (session('errors.nominal')) : ?>
                        <div class="text-danger mt-2"><?= session('errors.nominal') ?></div>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="bukti_pembayaran" class="form-label">Bukti Pembayaran (opsional)</label>
                    <input type="file" class="form-control" id="bukti_pembayaran" name="bukti_pembayaran" accept="image/*">
                    <?php if (session('errors.bukti_pembayaran')) : ?>
                        <div class="text-danger mt-2"><?= session('errors.bukti_pembayaran') ?></div>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="catatan" class="form-label">Catatan (opsional)</label>
                    <textarea class="form-control" id="catatan" name="catatan" rows="3"><?= old('catatan') ?></textarea>
                    <?php if (session('errors.catatan')) : ?>
                        <div class="text-danger mt-2"><?= session('errors.catatan') ?></div>
                    <?php endif; ?>
                </div>
                <button type="submit" class="btn btn-primary">Simpan Donasi</button>
                <a href="<?= base_url('user/donasi') ?>" class="btn btn-secondary">Batal</a>
            </form> 
        </div>
    </div>
</div>
<?= $this->endSection() ?>