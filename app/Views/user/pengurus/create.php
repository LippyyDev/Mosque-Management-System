<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('sidebar') ?>
<?= $this->include('components/sidebar_user') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2 class="page-title">Tambah Pengurus Baru</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('user/dashboard') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('user/pengurus') ?>">Pengurus</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah Baru</li>
                </ol>
            </nav>
        </div>
        <div>
             <a href="<?= base_url('user/pengurus') ?>" class="btn btn-light">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
        </div>
    </div>
</div>

<div class="card mt-4">
    <div class="card-header">
        <h5 class="card-title mb-0">Form Tambah Pengurus</h5>
    </div>
    <div class="card-body">
        <?php if (session()->getFlashdata('errors')) : ?>
            <div class="alert alert-danger">
                <ul class="mb-0">
                    <?php foreach (session()->getFlashdata('errors') as $error) : ?>
                        <li><?= esc($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')) : ?>
            <div class="alert alert-danger">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <form action="<?= base_url('user/pengurus/store') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control <?= (session('errors.nama')) ? 'is-invalid' : '' ?>" id="nama" name="nama" value="<?= old('nama') ?>" placeholder="Masukkan nama lengkap pengurus">
                        <div class="invalid-feedback">
                            <?= session('errors.nama') ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="jabatan" class="form-label">Jabatan</label>
                        <input type="text" class="form-control <?= (session('errors.jabatan')) ? 'is-invalid' : '' ?>" id="jabatan" name="jabatan" value="<?= old('jabatan') ?>" placeholder="cth: Ketua, Sekretaris, Bendahara, dll.">
                        <div class="invalid-feedback">
                            <?= session('errors.jabatan') ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto Pengurus</label>
                        <input type="file" class="form-control <?= (session('errors.foto')) ? 'is-invalid' : '' ?>" id="foto" name="foto" onchange="previewImage()">
                        <div class="invalid-feedback">
                            <?= session('errors.foto') ?>
                        </div>
                        <img id="image-preview" src="https://via.placeholder.com/300" class="mt-2 img-thumbnail" style="max-height: 300px; object-fit: cover; width: 100%;">
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-end mt-3">
                 <button type="submit" class="btn btn-dark">
                    <i class="fas fa-save me-2"></i>Simpan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function previewImage() {
    const fileInput = document.getElementById('foto');
    const imagePreview = document.getElementById('image-preview');
    
    if (fileInput.files && fileInput.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            imagePreview.src = e.target.result;
        }
        
        reader.readAsDataURL(fileInput.files[0]);
    } else {
        imagePreview.src = 'https://via.placeholder.com/300';
    }
}
</script>

<?= $this->endSection() ?>

