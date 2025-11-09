<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('sidebar') ?>
    <?= $this->include('components/sidebar_user') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2 class="page-title">Galeri</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('user/dashboard') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Galeri</li>
                </ol>
            </nav>
        </div>
        <div>
            <a href="<?= base_url('user/galeri/create') ?>" class="btn btn-dark">
                <i class="fas fa-plus me-2"></i>Tambah Galeri
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
<div class="row mt-4">
    <?php if (empty($galeri)): ?>
        <div class="col-12 text-center py-5">
            <i class="fas fa-images fa-3x text-muted mb-3"></i>
            <h5 class="text-muted">Belum ada galeri</h5>
            <p class="text-muted">Mulai tambahkan foto atau video galeri masjid</p>
            <a href="<?= base_url('user/galeri/create') ?>" class="btn btn-dark">
                <i class="fas fa-plus me-2"></i>Tambah Galeri Pertama
            </a>
        </div>
    <?php else: ?>
        <?php foreach ($galeri as $item): ?>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                <div class="card h-100 border-0 shadow-sm">
                    <?php if (!empty($item['cover'])): ?>
                        <img src="<?= base_url('public/uploads/galeri/' . $item['cover']) ?>" class="card-img-top" style="object-fit:cover; height:180px;">
                    <?php elseif (!empty($item['video_youtube'])): ?>
                        <div class="ratio ratio-16x9">
                            <iframe src="https://www.youtube.com/embed/<?= htmlspecialchars(preg_replace('/.*v=([\w-]+).*/', '$1', $item['video_youtube'])) ?>" allowfullscreen></iframe>
                        </div>
                    <?php else: ?>
                        <div class="bg-light d-flex align-items-center justify-content-center" style="height:180px;">
                            <i class="fas fa-image fa-2x text-muted"></i>
                        </div>
                    <?php endif; ?>
                    <div class="card-body">
                        <h6 class="card-title mb-1 fw-bold text-dark"><?= esc($item['judul']) ?></h6>
                        <div class="text-muted small mb-2"><i class="fas fa-calendar-alt me-1"></i><?= date('d/m/Y', strtotime($item['tanggal'])) ?></div>
                        <div class="d-flex justify-content-end gap-1">
                            <a href="<?= base_url('user/galeri/show/' . $item['id']) ?>" class="btn btn-light btn-sm"><i class="fas fa-eye"></i></a>
                            <a href="<?= base_url('user/galeri/edit/' . $item['id']) ?>" class="btn btn-light btn-sm"><i class="fas fa-edit"></i></a>
                            <button class="btn btn-light btn-sm text-danger" onclick="deleteGaleri(<?= $item['id'] ?>)"><i class="fas fa-trash"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
<script>
function deleteGaleri(id) {
    Swal.fire({
        title: 'Anda yakin?',
        text: "Data galeri ini akan dihapus permanen.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#343a40',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = `<?= base_url('user/galeri/delete/') ?>${id}`;
        }
    })
}
</script>
<?= $this->endSection() ?> 