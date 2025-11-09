<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('sidebar') ?>
    <?= $this->include('components/sidebar_user') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2 class="page-title">Daftar Persuratan</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('user/dashboard') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Persuratan</li>
                </ol>
            </nav>
        </div>
        <a href="<?= base_url('user/persuratan/create') ?>" class="btn btn-dark"><i class="fas fa-plus me-2"></i>Tambah Surat</a>
        <a href="<?= base_url('user/persuratan/download-template-word') ?>" class="btn btn-info ms-2"><i class="fas fa-file-word me-2"></i>Download Template Surat</a>
    </div>
</div>
<div class="card mt-4">
    <div class="card-header">
        <h5 class="card-title mb-0">Daftar Surat</h5>
    </div>
    <div class="card-body">
        <?php if (session('success')): ?>
            <div class="alert alert-success d-none"> <?= session('success') ?> </div>
        <?php endif; ?>
        <?php if (session('error')): ?>
            <div class="alert alert-danger d-none"> <?= session('error') ?> </div>
        <?php endif; ?>
        <div class="table-responsive">
            <table class="table table-hover mb-0 table-responsive-stack">
                <thead>
                    <tr>
                        <th class="ps-3">No</th>
                        <th>Nomor Surat</th>
                        <th>Perihal</th>
                        <th>Tujuan</th>
                        <th>Tanggal</th>
                        <th class="text-end pe-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($persuratan)): ?>
                        <tr><td colspan="6" class="text-center">Belum ada surat.</td></tr>
                    <?php else: ?>
                        <?php $no=1; foreach ($persuratan as $s): ?>
                        <tr>
                            <td data-label="No" class="ps-3"><?= $no++ ?></td>
                            <td data-label="Nomor Surat"><?= esc($s['nomor']) ?></td>
                            <td data-label="Perihal"><?= esc($s['perihal']) ?></td>
                            <td data-label="Tujuan"><?= esc($s['tujuan']) ?></td>
                            <td data-label="Tanggal"><?= date('d-m-Y', strtotime($s['tanggal'])) ?></td>
                            <td data-label="Aksi" class="text-end pe-3 actions-cell">
                                <a href="<?= base_url('user/persuratan/show/'.$s['id']) ?>" class="btn btn-light btn-sm" title="Lihat"><i class="fas fa-eye"></i></a>
                                <a href="<?= base_url('user/persuratan/preview-a4/'.$s['id']) ?>" target="_blank" class="btn btn-light btn-sm" title="Preview A4"><i class="fas fa-file-alt"></i></a>
                                <a href="<?= base_url('user/persuratan/edit/'.$s['id']) ?>" class="btn btn-light btn-sm" title="Edit"><i class="fas fa-edit"></i></a>
                                <a href="<?= base_url('user/persuratan/delete/'.$s['id']) ?>" class="btn btn-light btn-sm text-danger" title="Hapus" onclick="return confirm('Yakin hapus surat ini?')"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php if (session('success')): ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    <?php if (stripos(session('success'), 'hapus') !== false || stripos(session('success'), 'dihapus') !== false): ?>
    // Tampilkan sebagai toast di pojok kanan atas
    Swal.fire({
        toast: true,
        position: 'top-end',
        icon: 'success',
        title: '<?= session('success') ?>',
        showConfirmButton: false,
        timer: 2000,
        timerProgressBar: true,
        customClass: { popup: 'swal2-toast' }
    });
    <?php else: ?>
    // Tampilkan modal tengah (default)
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '<?= session('success') ?>',
        showConfirmButton: false,
        timer: 1800
    });
    <?php endif; ?>
</script>
<?php endif; ?>
<?php if (session('error')): ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    Swal.fire({
        icon: 'error',
        title: 'Gagal!',
        text: '<?= session('error') ?>',
        showConfirmButton: false,
        timer: 2000
    });
</script>
<?php endif; ?>
<?= $this->endSection() ?> 