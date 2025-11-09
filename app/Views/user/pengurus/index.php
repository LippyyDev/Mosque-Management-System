<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('sidebar') ?>
<?= $this->include('components/sidebar_user') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2 class="page-title">Kelola Pengurus</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('user/dashboard') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Pengurus</li>
                </ol>
            </nav>
        </div>
        <div>
            <a href="<?= base_url('user/pengurus/create') ?>" class="btn btn-dark">
                <i class="fas fa-plus me-2"></i>Tambah Pengurus
        </a>
        </div>
    </div>
        </div>

<!-- Summary Cards -->
<div class="row mt-4">
    <div class="col-md-4">
        <div class="card">
        <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="card-title text-muted">Total Pengurus</h6>
                        <h4 class="mb-0 fw-bold"><?= count($pengurus) ?></h4>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-users fa-2x text-muted"></i>
                    </div>
                </div>
            </div>
                            </div>
                        </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="card-title text-muted">Ketua</h6>
                        <h4 class="mb-0 fw-bold"><?= count(array_filter($pengurus, function($p) { return strpos(strtolower($p['jabatan']), 'ketua') !== false; })) ?></h4>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-user-tie fa-2x text-muted"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
                <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="card-title text-muted">Sekretaris</h6>
                        <h4 class="mb-0 fw-bold"><?= count(array_filter($pengurus, function($p) { return strpos(strtolower($p['jabatan']), 'sekretaris') !== false; })) ?></h4>
                        </div>
                    <div class="align-self-center">
                        <i class="fas fa-user-edit fa-2x text-muted"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- Pengurus Table -->
<div class="card mt-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Daftar Pengurus</h5>
        <span class="text-muted">Total: <?= count($pengurus) ?> Pengurus</span>
    </div>
    <div class="card-body p-0">
        <?php if (empty($pengurus)): ?>
            <div class="text-center py-5">
                <i class="fas fa-users fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">Belum ada data pengurus</h5>
                <p class="text-muted">Mulai tambahkan data pengurus masjid</p>
                <a href="<?= base_url('user/pengurus/create') ?>" class="btn btn-dark">
                    <i class="fas fa-plus me-2"></i>Tambah Pengurus Pertama
                </a>
        </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover mb-0 table-responsive-stack">
                    <thead>
                        <tr>
                            <th class="ps-3">No</th>
                            <th>Foto</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th class="text-end pe-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pengurus as $index => $item): ?>
                                <tr>
                                <td data-label="No" class="ps-3"><?= $index + 1 ?></td>
                                    <td data-label="Foto">
                                    <?php if (!empty($item['foto'])): ?>
                                        <img src="<?= base_url('uploads/pengurus/' . $item['foto']) ?>" alt="<?= esc($item['nama']) ?>" class="rounded" width="50" height="50" style="object-fit: cover;">
                                    <?php else: ?>
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                            <i class="fas fa-user text-muted"></i>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                <td data-label="Nama" class="fw-bold"><?= esc($item['nama']) ?></td>
                                <td data-label="Jabatan"><?= esc($item['jabatan']) ?></td>
                                <td data-label="Aksi" class="text-end pe-3 actions-cell">
                                    <a href="<?= base_url('user/pengurus/show/' . $item['id']) ?>" class="btn btn-light btn-sm"><i class="fas fa-eye"></i></a>
                                    <a href="<?= base_url('user/pengurus/edit/' . $item['id']) ?>" class="btn btn-light btn-sm"><i class="fas fa-edit"></i></a>
                                    <button class="btn btn-light btn-sm text-danger" onclick="deletePengurus(<?= $item['id'] ?>)"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
function deletePengurus(id) {
    Swal.fire({
        title: 'Anda yakin?',
        text: "Data pengurus ini akan dihapus permanen.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#343a40',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = `<?= base_url('user/pengurus/delete/') ?>${id}`;
        }
    })
}
</script>
<?= $this->endSection() ?>

