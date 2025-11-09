<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('sidebar') ?>
<?= $this->include('components/sidebar_admin') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="mb-0"><i class="fas fa-user-edit text-primary me-2"></i>Edit Akun</h2>
        <p class="text-muted mb-0">Perbarui informasi akun pengguna</p>
    </div>
    <a href="<?= base_url('/admin/users') ?>" class="btn btn-outline-dark">
        <i class="fas fa-arrow-left me-2"></i>Kembali
    </a>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card border-dark">
            <div class="card-header bg-white border-bottom border-dark">
                <h5 class="mb-0 text-dark"><i class="fas fa-user-edit me-2 text-dark"></i>Form Edit Akun</h5>
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

                <form action="<?= base_url('/admin/users/update/' . $userData['id']) ?>" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
                                <input type="text" class="form-control border-dark" id="username" name="username" 
                                       value="<?= old('username', $userData['username']) ?>" required>
                                <div class="form-text">Minimal 3 karakter, maksimal 50 karakter</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="password" class="form-label">Password Baru</label>
                                <input type="password" class="form-control border-dark" id="password" name="password">
                                <div class="form-text">Kosongkan jika tidak ingin mengubah password</div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="nama_lengkap" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" class="form-control border-dark" id="nama_lengkap" name="nama_lengkap" 
                               value="<?= old('nama_lengkap', $userData['nama_lengkap']) ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="role" class="form-label">Role <span class="text-danger">*</span></label>
                        <select class="form-select border-dark" id="role" name="role" required>
                            <option value="">Pilih Role</option>
                            <option value="Admin" <?= old('role', $userData['role']) === 'Admin' ? 'selected' : '' ?>>Admin</option>
                            <option value="User" <?= old('role', $userData['role']) === 'User' ? 'selected' : '' ?>>User</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="foto_profil" class="form-label">Foto Profil</label>
                        <?php if (!empty($userData['foto_profil'])): ?>
                            <div class="mb-2">
                                <img src="<?= base_url('uploads/profiles/' . $userData['foto_profil']) ?>" 
                                     alt="Current Profile" class="rounded" width="100" height="100" style="object-fit: cover;">
                                <div class="form-text">Foto profil saat ini</div>
                            </div>
                        <?php endif; ?>
                        <input type="file" class="form-control border-dark" id="foto_profil" name="foto_profil" accept="image/*">
                        <div class="form-text">Opsional. Maksimal 2MB. Format: JPG, PNG, GIF. Kosongkan jika tidak ingin mengubah foto.</div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="<?= base_url('/admin/users') ?>" class="btn btn-outline-dark me-md-2">
                            <i class="fas fa-times me-2"></i>Batal
                        </a>
                        <button type="submit" class="btn btn-dark">
                            <i class="fas fa-save me-2"></i>Perbarui Akun
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0"><i class="fas fa-user me-2"></i>Informasi Akun</h6>
            </div>
            <div class="card-body">
                <div class="text-center mb-3">
                    <?php if (!empty($userData['foto_profil'])): ?>
                        <img src="<?= base_url('uploads/profiles/' . $userData['foto_profil']) ?>" 
                             alt="Profile" class="rounded-circle mb-2" width="80" height="80" style="object-fit: cover;">
                    <?php else: ?>
                        <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center mx-auto mb-2" 
                             style="width: 80px; height: 80px;">
                            <i class="fas fa-user text-white fa-2x"></i>
                        </div>
                    <?php endif; ?>
                    <h6><?= esc($userData['nama_lengkap']) ?></h6>
                    <span class="badge bg-dark">
                        <?= esc($userData['role']) ?>
                    </span>
                </div>
                
                <hr>
                
                <div class="small">
                    <div class="row mb-2">
                        <div class="col-5 text-muted">Username:</div>
                        <div class="col-7"><?= esc($userData['username']) ?></div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-5 text-muted">Dibuat:</div>
                        <div class="col-7"><?= date('d/m/Y H:i', strtotime($userData['created_at'])) ?></div>
                    </div>
                    <?php if (!empty($userData['updated_at'])): ?>
                        <div class="row mb-2">
                            <div class="col-5 text-muted">Diperbarui:</div>
                            <div class="col-7"><?= date('d/m/Y H:i', strtotime($userData['updated_at'])) ?></div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

