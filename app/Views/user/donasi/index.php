<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('sidebar') ?>
<?= $this->include('components/sidebar_user') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2 class="page-title">Kelola Donasi</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('user/dashboard') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Donasi</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- Card Filter Donasi -->
<div class="card mt-4">
    <div class="card-header">
        <h5 class="card-title mb-0">Filter Donasi</h5>
    </div>
    <div class="card-body">
        <form class="row g-2 mb-0" method="get" action="">
            <div class="col-md-3">
                <label class="form-label mb-1">Nama / Catatan</label>
                <input type="text" name="q" class="form-control" placeholder="Cari nama donatur atau catatan..." value="<?= esc($q ?? '') ?>">
            </div>
            <div class="col-md-2">
                <label class="form-label mb-1">Status</label>
                <select name="status" class="form-select">
                    <option value="">Semua</option>
                    <option value="Pending" <?= ($status ?? '')=='Pending'?'selected':'' ?>>Pending</option>
                    <option value="Diterima" <?= ($status ?? '')=='Diterima'?'selected':'' ?>>Diterima</option>
                    <option value="Ditolak" <?= ($status ?? '')=='Ditolak'?'selected':'' ?>>Ditolak</option>
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label mb-1">Tanggal dari</label>
                <input type="date" name="tanggal_dari" class="form-control" value="<?= esc($tanggal_dari ?? '') ?>">
            </div>
            <div class="col-md-2">
                <label class="form-label mb-1">Tanggal sampai</label>
                <input type="date" name="tanggal_sampai" class="form-control" value="<?= esc($tanggal_sampai ?? '') ?>">
            </div>
            <div class="col-md-3 d-flex gap-2 align-items-end">
                <button type="submit" class="btn btn-dark"><i class="fas fa-search me-1"></i> Cari</button>
                <a href="<?= base_url('user/donasi') ?>" class="btn btn-outline-secondary">Reset</a>
            </div>
        </form>
    </div>
</div>
<!-- Card Tabel Donasi -->
<div class="card mt-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Daftar Donasi</h5>
        <span class="text-muted">Total: <?= count($donasi) ?> Donasi</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <!-- HAPUS DEBUG -->
            <!-- <pre><?php /* debug sementara */ print_r($donasi); ?></pre> -->
            <table class="table table-hover mb-0 table-responsive-stack">
                <thead>
                    <tr>
                        <th class="ps-3">No</th>
                        <th>Nama Donatur</th>
                        <th>Nominal</th>
                        <th>Bukti Pembayaran</th>
                        <th>Catatan</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th class="text-end pe-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($donasi)) : ?>
                        <tr>
                            <td colspan="8" class="text-center">Tidak ada data donasi.</td>
                        </tr>
                    <?php else : ?>
                        <?php $no = isset($pager) && $pager ? 1 + ($pager->getCurrentPage() - 1) * $pager->getPerPage() : 1; ?>
                        <?php foreach ($donasi as $row) : ?>
                            <tr>
                                <td data-label="No" class="ps-3"><?= $no++ ?></td>
                                <td data-label="Nama Donatur"><?= isset($row['nama']) ? esc($row['nama']) : '-' ?></td>
                                <td data-label="Nominal">Rp <?= isset($row['nominal']) ? number_format($row['nominal'], 0, ',', '.') : '-' ?></td>
                                <td data-label="Bukti">
                                    <?php if (!empty($row['bukti_pembayaran'])) : ?>
                                        <a href="<?= base_url('uploads/donasi/' . esc($row['bukti_pembayaran'])) ?>" target="_blank" class="btn btn-light btn-sm">Lihat Bukti</a>
                                    <?php else : ?>
                                        <span class="text-muted">Tidak ada</span>
                                    <?php endif; ?>
                                </td>
                                <td data-label="Catatan"><?= isset($row['catatan']) ? esc($row['catatan']) : '-' ?></td>
                                <td data-label="Status"><?= isset($row['status']) ? esc($row['status']) : '-' ?></td>
                                <td data-label="Tanggal"><?= isset($row['created_at']) ? date('d/m/Y H:i', strtotime($row['created_at'])) : '-' ?></td>
                                <td data-label="Aksi" class="text-end pe-3 actions-cell">
                                    <a href="<?= base_url('user/donasi/show/' . esc($row['id'] ?? '')) ?>" class="btn btn-light btn-sm" title="Detail"><i class="fas fa-eye"></i></a>
                                    <?php if ((isset($row['status']) && $row['status'] === 'Pending')) : ?>
                                        <form action="<?= base_url('user/donasi/accept/' . esc($row['id'] ?? '')) ?>" method="post" class="d-inline">
                                            <?= csrf_field() ?>
                                            <button type="submit" class="btn btn-dark btn-sm" onclick="return confirm('Apakah Anda yakin ingin menerima donasi ini?');" title="Terima"><i class="fas fa-check"></i></button>
                                        </form>
                                        <form action="<?= base_url('user/donasi/reject/' . esc($row['id'] ?? '')) ?>" method="post" class="d-inline">
                                            <?= csrf_field() ?>
                                            <button type="submit" class="btn btn-light btn-sm text-danger" onclick="return confirm('Apakah Anda yakin ingin menolak donasi ini?');" title="Tolak"><i class="fas fa-times"></i></button>
                                        </form>
                                    <?php endif; ?>
                                    <form action="<?= base_url('user/donasi/delete/' . esc($row['id'] ?? '')) ?>" method="post" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus donasi ini?');">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="btn btn-light btn-sm text-danger" title="Hapus"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php if (isset($pager) && $pager->getPageCount() > 1): ?>
    <div class="mt-3">
        <?= $pager->links() ?>
    </div>
<?php endif; ?>
<?= $this->endSection() ?>

