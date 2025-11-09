<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('sidebar') ?>
<?= $this->include('components/sidebar_user') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2 class="page-title">Edit Transaksi</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('user/dashboard') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('user/keuangan') ?>">Keuangan</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
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
                <h5 class="card-title mb-0">Form Edit Transaksi: <?= esc($keuanganData['keterangan']) ?></h5>
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

                <form action="<?= base_url('/user/keuangan/update/' . $keuanganData['id']) ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <input type="hidden" name="old_bukti" value="<?= esc($keuanganData['bukti_transaksi']) ?>">
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="tanggal_transaksi" class="form-label">Tanggal Transaksi</label>
                                <input type="date" class="form-control <?= (validation_show_error('tanggal_transaksi')) ? 'is-invalid' : '' ?>" id="tanggal_transaksi" name="tanggal_transaksi" 
                                       value="<?= old('tanggal_transaksi', $keuanganData['tanggal_transaksi']) ?>">
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
                                    <option value="Pemasukan" <?= old('jenis', $keuanganData['jenis']) === 'Pemasukan' ? 'selected' : '' ?>>Pemasukan</option>
                                    <option value="Pengeluaran" <?= old('jenis', $keuanganData['jenis']) === 'Pengeluaran' ? 'selected' : '' ?>>Pengeluaran</option>
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
                                <div class="invalid-feedback">
                                    <?= validation_show_error('kategori') ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nominal" class="form-label">Nominal</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" class="form-control <?= (validation_show_error('nominal')) ? 'is-invalid' : '' ?>" id="nominal" name="nominal" 
                                           value="<?= old('nominal', $keuanganData['nominal']) ?>" min="1" step="1">
                                </div>
                                <div class="invalid-feedback">
                                    <?= validation_show_error('nominal') ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="keterangan" class="form-label">Keterangan</label>
                        <textarea class="form-control <?= (validation_show_error('keterangan')) ? 'is-invalid' : '' ?>" id="keterangan" name="keterangan" rows="3"><?= old('keterangan', $keuanganData['keterangan']) ?></textarea>
                        <div class="invalid-feedback">
                            <?= validation_show_error('keterangan') ?>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="bukti_transaksi" class="form-label">Ganti Bukti Transaksi (Opsional)</label>
                        <?php if (!empty($keuanganData['bukti_transaksi'])): ?>
                            <div class="mb-2">
                                <label class="form-label">Bukti Saat Ini:</label>
                                <img src="<?= base_url('uploads/keuangan/' . $keuanganData['bukti_transaksi']) ?>" 
                                     alt="Current Bukti" class="img-thumbnail" style="max-height: 150px; object-fit: cover;">
                            </div>
                        <?php endif; ?>
                        <input type="file" class="form-control <?= (validation_show_error('bukti_transaksi')) ? 'is-invalid' : '' ?>" id="bukti_transaksi" name="bukti_transaksi" accept="image/*" onchange="previewImage()">
                        <div class="invalid-feedback">
                            <?= validation_show_error('bukti_transaksi') ?>
                        </div>
                        <div class="form-text">Maksimal 2MB. Format: JPG, PNG, GIF. Kosongkan jika tidak ingin mengubah bukti.</div>
                        <img id="image-preview" src="https://via.placeholder.com/300" class="mt-2 img-thumbnail" style="max-height: 200px; object-fit: cover; width: 100%; display: none;">
                    </div>

                    <div class="d-flex justify-content-end mt-3">
                        <button type="submit" class="btn btn-dark">
                            <i class="fas fa-save me-2"></i>Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title mb-0">Informasi Transaksi</h6>
            </div>
            <div class="card-body">
                <div class="text-center mb-3">
                    <span class="badge bg-<?= $keuanganData['jenis'] === 'Pemasukan' ? 'dark' : 'light' ?> text-<?= $keuanganData['jenis'] === 'Pemasukan' ? 'white' : 'dark' ?> fs-6">
                        <?= $keuanganData['jenis'] ?>
                    </span>
                    <h5 class="mt-2">
                        Rp <?= number_format($keuanganData['nominal'], 0, ',', '.') ?>
                    </h5>
                </div>
                
                <hr>
                
                <div class="small">
                    <div class="row mb-2">
                        <div class="col-5 text-muted">Tanggal:</div>
                        <div class="col-7"><?= date('d/m/Y', strtotime($keuanganData['tanggal_transaksi'])) ?></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-5 text-muted">Kategori:</div>
                        <div class="col-7"><?= esc($keuanganData['kategori']) ?></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-5 text-muted">Dibuat:</div>
                        <div class="col-7"><?= date('d/m/Y H:i', strtotime($keuanganData['created_at'])) ?></div>
                    </div>
                    <?php if (!empty($keuanganData['updated_at'])): ?>
                        <div class="row mb-2">
                            <div class="col-5 text-muted">Diperbarui:</div>
                            <div class="col-7"><?= date('d/m/Y H:i', strtotime($keuanganData['updated_at'])) ?></div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">
                <h6 class="card-title mb-0">Informasi Kategori</h6>
            </div>
            <div class="card-body">
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

function previewImage() {
    const fileInput = document.getElementById('bukti_transaksi');
    const imagePreview = document.getElementById('image-preview');
    
    if (fileInput.files && fileInput.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            imagePreview.src = e.target.result;
            imagePreview.style.display = 'block';
        }
        
        reader.readAsDataURL(fileInput.files[0]);
    } else {
        imagePreview.style.display = 'none';
    }
}

// Initialize kategori on page load
document.addEventListener('DOMContentLoaded', function() {
    updateKategori();
    
    // Set current kategori value
    const currentKategori = '<?= old('kategori', $keuanganData['kategori']) ?>';
    if (currentKategori) {
        document.getElementById('kategori').value = currentKategori;
    }
});
</script>

<?= $this->endSection() ?>

