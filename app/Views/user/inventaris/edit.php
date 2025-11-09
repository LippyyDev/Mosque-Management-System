<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('sidebar') ?>
    <?= $this->include('components/sidebar_user') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2 class="page-title">Edit Inventaris</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('user/dashboard') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('user/inventaris') ?>">Inventaris</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </nav>
        </div>
        <div>
             <a href="<?= base_url('user/inventaris') ?>" class="btn btn-light">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
        </div>
    </div>
</div>

<div class="card mt-4">
    <div class="card-header">
        <h5 class="card-title mb-0">Form Edit Barang: <?= esc($inventaris['nama_barang']) ?></h5>
    </div>
    <div class="card-body">
        <form action="<?= base_url('user/inventaris/update/' . $inventaris['id']) ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <input type="hidden" name="old_foto_barang" value="<?= esc($inventaris['foto_barang']) ?>">
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="nama_barang" class="form-label">Nama Barang</label>
                        <input type="text" class="form-control <?= (validation_show_error('nama_barang')) ? 'is-invalid' : '' ?>" id="nama_barang" name="nama_barang" value="<?= old('nama_barang', $inventaris['nama_barang']) ?>">
                        <div class="invalid-feedback">
                            <?= validation_show_error('nama_barang') ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="kategori" class="form-label">Kategori</label>
                            <input type="text" class="form-control <?= (validation_show_error('kategori')) ? 'is-invalid' : '' ?>" id="kategori" name="kategori" value="<?= old('kategori', $inventaris['kategori']) ?>" placeholder="cth: Elektronik, Perabotan, dll.">
                            <div class="invalid-feedback">
                                <?= validation_show_error('kategori') ?>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="jumlah" class="form-label">Jumlah</label>
                            <input type="number" class="form-control <?= (validation_show_error('jumlah')) ? 'is-invalid' : '' ?>" id="jumlah" name="jumlah" value="<?= old('jumlah', $inventaris['jumlah']) ?>">
                            <div class="invalid-feedback">
                                <?= validation_show_error('jumlah') ?>
                            </div>
                        </div>
                    </div>
                     <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="tanggal_pembelian" class="form-label">Tanggal Pembelian</label>
                            <input type="date" class="form-control <?= (validation_show_error('tanggal_pembelian')) ? 'is-invalid' : '' ?>" id="tanggal_pembelian" name="tanggal_pembelian" value="<?= old('tanggal_pembelian', $inventaris['tanggal_pembelian']) ?>">
                             <div class="invalid-feedback">
                                <?= validation_show_error('tanggal_pembelian') ?>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                           <label for="kondisi" class="form-label">Kondisi</label>
                            <select class="form-select <?= (validation_show_error('kondisi')) ? 'is-invalid' : '' ?>" id="kondisi" name="kondisi">
                                <option value="Baik" <?= (old('kondisi', $inventaris['kondisi']) == 'Baik') ? 'selected' : '' ?>>Baik</option>
                                <option value="Rusak" <?= (old('kondisi', $inventaris['kondisi']) == 'Rusak') ? 'selected' : '' ?>>Rusak</option>
                                <option value="Diperbaiki" <?= (old('kondisi', $inventaris['kondisi']) == 'Diperbaiki') ? 'selected' : '' ?>>Diperbaiki</date_format>
                            </select>
                             <div class="invalid-feedback">
                                <?= validation_show_error('kondisi') ?>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3"><?= old('deskripsi', $inventaris['deskripsi'] ?? '') ?></textarea>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="foto_barang" class="form-label">Ganti Foto Barang (Opsional)</label>
                        <input type="file" class="form-control <?= (validation_show_error('foto_barang')) ? 'is-invalid' : '' ?>" id="foto_barang" name="foto_barang" onchange="previewImage()">
                        <div class="invalid-feedback">
                            <?= validation_show_error('foto_barang') ?>
                        </div>
                        
                        <label class="mt-3">Foto Saat Ini:</label>
                        <img id="image-preview" src="<?= !empty($inventaris['foto_barang']) ? base_url('uploads/inventaris/' . $inventaris['foto_barang']) : 'https://via.placeholder.com/300' ?>" class="mt-1 img-thumbnail" style="max-height: 265px; object-fit: cover; width: 100%;">
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end mt-3">
                 <button type="submit" class="btn btn-dark">
                    <i class="fas fa-save me-2"></i>Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function previewImage() {
    const fileInput = document.getElementById('foto_barang');
    const imagePreview = document.getElementById('image-preview');
    
    if (fileInput.files && fileInput.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            imagePreview.src = e.target.result;
        }
        
        reader.readAsDataURL(fileInput.files[0]);
    }
}
</script>

<?= $this->endSection() ?> 