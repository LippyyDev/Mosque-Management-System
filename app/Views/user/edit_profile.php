<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('sidebar') ?>
    <?= $this->include('components/sidebar_user') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2 class="page-title">Edit Profil</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('user/dashboard') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Profil</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
        <?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>
<?php if (session()->getFlashdata('validation')): ?>
    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
        <?= session('validation')->listErrors() ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>
<div class="card mt-4">
    <div class="card-header">
        <h5 class="card-title mb-0">Form Edit Profil</h5>
    </div>
    <div class="card-body">
        <form action="<?= base_url('user/update-profile') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?= old('username', $user['username']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" value="<?= old('nama_lengkap', $user['nama_lengkap']) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password Baru (Opsional)</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah password">
                        <div class="form-text">Minimal 6 karakter. Kosongkan jika tidak ingin mengubah password.</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="foto_profil" class="form-label">Foto Profil</label>
                        <input type="file" class="form-control" id="foto_profil" name="foto_profil" accept="image/*" onchange="previewImage()">
                        <div class="form-text">Format: JPG, PNG, GIF. Maksimal 2MB.</div>
                        <label class="mt-3">Foto Saat Ini:</label>
                        <div class="d-flex justify-content-center">
                            <img id="image-preview" src="<?= !empty($user['foto_profil']) ? base_url('uploads/profiles/' . $user['foto_profil']) : 'https://via.placeholder.com/150' ?>" class="mt-1" style="border-radius: 50%; width: 150px; height: 150px; object-fit: cover;">
                        </div>
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
    const fileInput = document.getElementById('foto_profil');
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