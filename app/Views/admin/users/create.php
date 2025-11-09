<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('sidebar') ?>
<?= $this->include('components/sidebar_admin') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-0"><i class="fas fa-user-plus text-dark me-2"></i>Tambah Akun Baru</h2>
        <p class="text-muted mb-0">Buat akun pengguna baru untuk sistem</p>
    </div>
    <a href="<?= base_url('/admin/users') ?>" class="btn btn-outline-dark">
        <i class="fas fa-arrow-left me-2"></i>Kembali
    </a>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card border-dark">
            <div class="card-header bg-white border-bottom border-dark">
                <h5 class="mb-0 text-dark"><i class="fas fa-user-plus me-2 text-dark"></i>Form Tambah Akun</h5>
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

                <form action="<?= base_url('/admin/users/store') ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                                <input type="text" class="form-control border-dark" id="username" name="username" 
                                       value="<?= old('username') ?>" required>
                                <div class="form-text">Minimal 3 karakter, maksimal 50 karakter</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control border-dark" id="password" name="password" required>
                                <div class="form-text">Minimal 6 karakter</div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="nama_lengkap" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" class="form-control border-dark" id="nama_lengkap" name="nama_lengkap" 
                               value="<?= old('nama_lengkap') ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="role" class="form-label">Role <span class="text-danger">*</span></label>
                        <select class="form-select border-dark" id="role" name="role" required>
                            <option value="">Pilih Role</option>
                            <option value="Admin" <?= old('role') === 'Admin' ? 'selected' : '' ?>>Admin</option>
                            <option value="User" <?= old('role') === 'User' ? 'selected' : '' ?>>User</option>
                        </select>
                        <div class="form-text">
                            <strong>Admin:</strong> Akses penuh ke semua fitur<br>
                            <strong>User:</strong> Akses terbatas untuk pengurus masjid
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="foto_profil" class="form-label">Foto Profil</label>
                        <input type="file" class="form-control border-dark" id="foto_profil" name="foto_profil" accept="image/*">
                        <div class="form-text">Opsional. Maksimal 2MB. Format: JPG, PNG, GIF</div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="<?= base_url('/admin/users') ?>" class="btn btn-outline-dark me-md-2">
                            <i class="fas fa-times me-2"></i>Batal
                        </a>
                        <button type="submit" class="btn btn-dark">
                            <i class="fas fa-save me-2"></i>Simpan Akun
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="card border-dark">
            <div class="card-header bg-white border-bottom border-dark">
                <h6 class="mb-0 text-dark"><i class="fas fa-info-circle me-2 text-dark"></i>Informasi</h6>
            </div>
            <div class="card-body">
                <h6 class="text-dark">Perbedaan Role:</h6>
                <div class="mb-3">
                    <strong class="text-dark">Admin</strong>
                    <ul class="small text-muted mt-1">
                        <li>Kelola semua akun pengguna</li>
                        <li>Akses ke semua fitur sistem</li>
                        <li>Pengaturan sistem</li>
                    </ul>
                </div>
                <div>
                    <strong class="text-dark">User</strong>
                    <ul class="small text-muted mt-1">
                        <li>Kelola data masjid</li>
                        <li>Input keuangan & donasi</li>
                        <li>Kelola berita & galeri</li>
                        <li>Tidak bisa kelola akun</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

