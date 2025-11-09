<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('sidebar') ?>
    <?= $this->include('components/sidebar_user') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2 class="page-title">Berita Saya</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('user/dashboard') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Berita</li>
                </ol>
            </nav>
        </div>
        <div>
            <a href="<?= base_url('user/berita/create') ?>" class="btn btn-dark">
                <i class="fas fa-plus me-2"></i>Tambah Berita
            </a>
        </div>
    </div>
</div>
<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
        <?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>
<!-- Search & Filter -->
<div class="card mt-4">
    <div class="card-header">
        <h5 class="card-title mb-0">Pencarian & Filter</h5>
    </div>
    <div class="card-body">
        <form class="row g-3" method="get" action="<?= base_url('user/berita') ?>">
            <div class="col-md-4">
                <label class="form-label mb-1">Judul / Isi Berita</label>
                <input type="text" class="form-control" name="q" placeholder="Cari judul atau isi..." value="<?= esc($filters['q']) ?>">
            </div>
            <div class="col-md-3">
                <label class="form-label mb-1">Kategori</label>
                <select class="form-select" name="kategori">
                    <option value="">Semua Kategori</option>
                    <?php foreach ($kategori_list as $kat): ?>
                        <option value="<?= $kat ?>" <?= $filters['kategori'] === $kat ? 'selected' : '' ?>><?= $kat ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label mb-1">Tanggal dari</label>
                <input type="date" class="form-control" name="tanggal_dari" value="<?= esc($filters['tanggal_dari']) ?>">
            </div>
            <div class="col-md-2">
                <label class="form-label mb-1">Tanggal sampai</label>
                <input type="date" class="form-control" name="tanggal_sampai" value="<?= esc($filters['tanggal_sampai']) ?>">
            </div>
            <div class="col-md-1 d-grid gap-2">
                <label class="form-label mb-1 d-none d-md-block">&nbsp;</label>
                <button type="submit" class="btn btn-dark"><i class="fas fa-search me-2"></i>Cari</button>
                <a href="<?= base_url('user/berita') ?>" class="btn btn-light">Reset</a>
            </div>
        </form>
    </div>
</div>
<div class="card mt-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Daftar Berita</h5>
        <span class="text-muted">Total: <?= count($berita) ?> Berita</span>
    </div>
    <div class="card-body p-0">
        <?php if (empty($berita)): ?>
            <div class="text-center py-5">
                <i class="fas fa-newspaper fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">Belum ada berita</h5>
                <p class="text-muted">Mulai tambahkan berita masjid</p>
                <a href="<?= base_url('user/berita/create') ?>" class="btn btn-dark">
                    <i class="fas fa-plus me-2"></i>Tambah Berita Pertama
                </a>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover mb-0 table-responsive-stack">
                    <thead>
                        <tr>
                            <th class="ps-3">No</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Tanggal Publish</th>
                            <th>Lokasi</th>
                            <th class="text-end pe-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($berita as $index => $item): ?>
                            <tr>
                                <td data-label="No" class="ps-3"><?= $index + 1 ?></td>
                                <td data-label="Judul" class="fw-bold"><?= esc($item['judul']) ?></td>
                                <td data-label="Kategori"><span class="badge bg-dark text-white"><?= esc($item['kategori']) ?></span></td>
                                <td data-label="Tanggal"><?= date('d/m/Y H:i', strtotime($item['tanggal_publish'])) ?></td>
                                <td data-label="Lokasi"><?= esc($item['lokasi']) ?></td>
                                <td data-label="Aksi" class="text-end pe-3 actions-cell">
                                    <a href="<?= base_url('user/berita/show/' . $item['id']) ?>" class="btn btn-light btn-sm"><i class="fas fa-eye"></i></a>
                                    <a href="<?= base_url('user/berita/edit/' . $item['id']) ?>" class="btn btn-light btn-sm"><i class="fas fa-edit"></i></a>
                                    <button class="btn btn-light btn-sm text-danger" onclick="deleteBerita(<?= $item['id'] ?>)"><i class="fas fa-trash"></i></button>
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
function deleteBerita(id) {
    Swal.fire({
        title: 'Anda yakin?',
        text: "Data berita ini akan dihapus permanen.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#343a40',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = `<?= base_url('user/berita/delete/') ?>${id}`;
        }
    })
}
</script>
<?= $this->endSection() ?> 