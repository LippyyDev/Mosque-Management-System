<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('sidebar') ?>
<?= $this->include('components/sidebar_user') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2 class="page-title">Tambah Transaksi Baru</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('user/dashboard') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('user/keuangan') ?>">Keuangan</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah Baru</li>
                </ol>
            </nav>
        </div>
        <div>
            <a href="<?= base_url('/user/keuangan') ?>" class="btn btn-light">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Form Tambah Transaksi</h5>
            </div>
            <div class="card-body">
                <?php if (session()->getFlashdata('errors')): ?>
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('/user/keuangan/store') ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="tanggal_transaksi" class="form-label">Tanggal Transaksi</label>
                                <input type="date" class="form-control <?= (validation_show_error('tanggal_transaksi')) ? 'is-invalid' : '' ?>" id="tanggal_transaksi" name="tanggal_transaksi" 
                                       value="<?= old('tanggal_transaksi', date('Y-m-d')) ?>">
                                <div class="invalid-feedback">
                                    <?= validation_show_error('tanggal_transaksi') ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="jenis" class="form-label">Jenis Transaksi</label>
                                <select class="form-select <?= (validation_show_error('jenis')) ? 'is-invalid' : '' ?>" id="jenis" name="jenis" onchange="updateKategori()">
                                    <option value="">Pilih Jenis</option>
                                    <option value="Pemasukan" <?= old('jenis') === 'Pemasukan' ? 'selected' : '' ?>>Pemasukan</option>
                                    <option value="Pengeluaran" <?= old('jenis') === 'Pengeluaran' ? 'selected' : '' ?>>Pengeluaran</option>
                                </select>
                                <div class="invalid-feedback">
                                    <?= validation_show_error('jenis') ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="kategori" class="form-label">Kategori</label>
                                <select class="form-select <?= (validation_show_error('kategori')) ? 'is-invalid' : '' ?>" id="kategori" name="kategori">
                                    <option value="">Pilih Kategori</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nominal" class="form-label">Nominal <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" class="form-control" id="nominal" name="nominal" 
                                           value="<?= old('nominal') ?>" min="1" step="1" required>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea class="form-control" id="keterangan" name="keterangan" rows="3"><?= old('keterangan') ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="bukti_transaksi" class="form-label">Bukti Transaksi</label>
                        <input type="file" class="form-control" id="bukti_transaksi" name="bukti_transaksi" accept="image/*">
                        <div class="form-text">Opsional. Maksimal 2MB. Format: JPG, PNG, GIF</div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="<?= base_url('/user/keuangan') ?>" class="btn btn-secondary me-md-2">
                            <i class="fas fa-times me-2"></i>Batal
                        </a>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save me-2"></i>Simpan Transaksi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0"><i class="fas fa-info-circle me-2"></i>Informasi</h6>
            </div>
            <div class="card-body">
                <h6>Jenis Transaksi:</h6>
                <ul class="list-unstyled">
                    <li><span class="badge bg-success me-2">Pemasukan</span> Uang masuk ke kas masjid</li>
                    <li><span class="badge bg-danger me-2">Pengeluaran</span> Uang keluar dari kas masjid</li>
                </ul>
                
                <hr>
                
                <h6>Kategori Pemasukan:</h6>
                <ul class="small">
                    <?php foreach ($kategori_list['Pemasukan'] as $kat): ?>
                        <li><?= $kat ?></li>
                    <?php endforeach; ?>
                </ul>
                
                <h6>Kategori Pengeluaran:</h6>
                <ul class="small">
                    <?php foreach ($kategori_list['Pengeluaran'] as $kat): ?>
                        <li><?= $kat ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
const kategoriList = <?= json_encode($kategori_list) ?>;

function updateKategori() {
    const jenisSelect = document.getElementById('jenis');
    const kategoriSelect = document.getElementById('kategori');
    const selectedJenis = jenisSelect.value;
    
    // Clear existing options
    kategoriSelect.innerHTML = '<option value="">Pilih Kategori</option>';
    
    if (selectedJenis && kategoriList[selectedJenis]) {
        kategoriList[selectedJenis].forEach(function(kategori) {
            const option = document.createElement('option');
            option.value = kategori;
            option.textContent = kategori;
            kategoriSelect.appendChild(option);
        });
    }
}

// Initialize kategori on page load if jenis is already selected
document.addEventListener('DOMContentLoaded', function() {
    updateKategori();
    
    // Set old kategori value if exists
    const oldKategori = '<?= old('kategori') ?>';
    if (oldKategori) {
        document.getElementById('kategori').value = oldKategori;
    }
});
</script>
<?= $this->endSection() ?>

