<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('sidebar') ?>
<?= $this->include('components/sidebar_admin') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="header">
    <div class="d-flex justify-content-between align-items-center">
    <div>
            <h2 class="page-title">Kelola Akun</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('admin/dashboard') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Kelola Akun</li>
                </ol>
            </nav>
        </div>
        <a href="<?= base_url('/admin/users/create') ?>" class="btn btn-dark"><i class="fas fa-plus me-2"></i>Tambah Akun</a>
    </div>
</div>
<!-- Card Filter (dummy, bisa diisi filter user jika mau) -->
<div class="card mt-4">
    <div class="card-header">
        <h5 class="card-title mb-0">Filter Akun</h5>
    </div>
    <div class="card-body">
        <form class="row g-2 mb-0" method="get" action="">
            <div class="col-md-4">
                <label class="form-label mb-1">Nama / Username</label>
                <input type="text" name="q" class="form-control" placeholder="Cari nama atau username..." value="<?= esc($q ?? '') ?>">
            </div>
            <div class="col-md-3">
                <label class="form-label mb-1">Role</label>
                <select name="role" class="form-select">
                    <option value="">Semua</option>
                    <option value="Admin" <?= ($role ?? '')=='Admin'?'selected':'' ?>>Admin</option>
                    <option value="User" <?= ($role ?? '')=='User'?'selected':'' ?>>User</option>
                </select>
            </div>
            <div class="col-md-3 d-flex gap-2 align-items-end">
                <button type="submit" class="btn btn-dark"><i class="fas fa-search me-1"></i> Cari</button>
                <a href="<?= base_url('admin/users') ?>" class="btn btn-outline-secondary">Reset</a>
            </div>
        </form>
    </div>
</div>
<!-- Card Tabel Akun -->
<div class="card mt-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Daftar Akun Pengguna</h5>
        <span class="text-muted">Total: <?= count($users) ?> Akun</span>
    </div>
    <div class="card-body p-0">
            <div class="table-responsive">
            <table class="table table-hover mb-0 table-responsive-stack">
                    <thead>
                        <tr>
                        <th class="ps-3">No</th>
                        <th>Foto</th>
                        <th>Username</th>
                        <th>Nama Lengkap</th>
                        <th>Role</th>
                        <th>Dibuat</th>
                        <th class="text-end pe-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($users)) : ?>
                        <tr>
                            <td colspan="7" class="text-center">Tidak ada data akun.</td>
                        </tr>
                    <?php else : ?>
                        <?php $no = 1; ?>
                        <?php foreach ($users as $userData) : ?>
                            <tr>
                                <td data-label="No" class="ps-3"><?= $no++ ?></td>
                                <td data-label="Foto">
                                    <?php if (!empty($userData['foto_profil'])): ?>
                                        <img src="<?= base_url('uploads/profiles/' . $userData['foto_profil']) ?>" alt="Profile" class="rounded-circle" width="40" height="40" style="object-fit: cover;">
                                    <?php else: ?>
                                        <div class="bg-dark rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                            <i class="fas fa-user text-white"></i>
                                        </div>
                                    <?php endif; ?>
                                </td>
                                <td data-label="Username"><strong><?= esc($userData['username']) ?></strong></td>
                                <td data-label="Nama Lengkap"><?= esc($userData['nama_lengkap']) ?></td>
                                <td data-label="Role"><span class="badge bg-dark"><?= esc($userData['role']) ?></span></td>
                                <td data-label="Dibuat"><small class="text-muted"><?= date('d/m/Y H:i', strtotime($userData['created_at'])) ?></small></td>
                                <td data-label="Aksi" class="text-end pe-3 actions-cell">
                                    <a href="<?= base_url('/admin/users/edit/' . $userData['id']) ?>" class="btn btn-light btn-sm" title="Edit"><i class="fas fa-edit"></i></a>
                                    <?php if ($userData['id'] != session()->get('user_id')): ?>
                                        <button type="button" class="btn btn-light btn-sm text-danger" onclick="confirmDelete(<?= $userData['id'] ?>, '<?= esc($userData['nama_lengkap']) ?>')" title="Hapus"><i class="fas fa-trash"></i></button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function confirmDelete(id, name) {
    Swal.fire({
        title: 'Konfirmasi Hapus',
        text: `Apakah Anda yakin ingin menghapus akun "${name}"?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = `<?= base_url('/admin/users/delete/') ?>${id}`;
        }
    });
}
</script>
<?= $this->endSection() ?>

