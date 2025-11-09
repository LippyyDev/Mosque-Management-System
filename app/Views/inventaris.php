<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Inventaris Masjid') . ' - ' . esc($pengaturan['nama_masjid'] ?? 'Sistem Informasi Masjid') ?></title>
    <link rel="shortcut icon" href="<?= base_url('favicon.ico') ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>
<body style="min-height:100vh; display:flex; flex-direction:column;">
    <div class="navbar-container container">
        <?= $this->include('components/navbar_public') ?>
    </div>
    <div class="page-wrapper d-flex flex-column" style="min-height:100vh;">
        <main style="flex:1 0 auto;">
            <section class="section">
                <div class="container">
                    <h1 class="section-title"><?= esc($title) ?></h1>
                    <p class="section-subtitle">Daftar lengkap inventaris dan aset masjid untuk transparansi pengelolaan.</p>
                    
                    <!-- Filter Form -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <form action="<?= base_url('inventaris') ?>" method="get">
                                <div class="row g-3 align-items-end">
                                    <div class="col-md-4">
                                        <label for="nama" class="form-label">Nama Barang</label>
                                        <input type="text" class="form-control" name="nama" id="nama" value="<?= esc($filters['nama'] ?? '') ?>" placeholder="Cari nama barang...">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="kategori" class="form-label">Kategori</label>
                                        <select class="form-select" id="kategori" name="kategori">
                                            <option value="">Semua Kategori</option>
                                            <?php foreach($kategori_list as $kategori): ?>
                                                <option value="<?= esc($kategori) ?>" <?= ($filters['kategori'] ?? '') == $kategori ? 'selected' : '' ?>><?= esc($kategori) ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="kondisi" class="form-label">Kondisi</label>
                                        <select class="form-select" id="kondisi" name="kondisi">
                                            <option value="">Semua Kondisi</option>
                                            <option value="Baik" <?= ($filters['kondisi'] ?? '') == 'Baik' ? 'selected' : '' ?>>Baik</option>
                                            <option value="Rusak" <?= ($filters['kondisi'] ?? '') == 'Rusak' ? 'selected' : '' ?>>Rusak</option>
                                            <option value="Diperbaiki" <?= ($filters['kondisi'] ?? '') == 'Diperbaiki' ? 'selected' : '' ?>>Diperbaiki</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2 d-flex gap-2">
                                        <button type="submit" class="btn btn-dark w-100">Filter</button>
                                        <a href="<?= base_url('inventaris') ?>" class="btn btn-outline-secondary w-100">Reset</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Summary Cards -->
                    <div class="row g-4 mb-4">
                        <div class="col-md-4">
                            <div class="stat-card">
                                <div class="stat-value text-success"><?= $pager->getTotal() ?></div>
                                <div class="stat-label">Total Barang</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="stat-card">
                                <div class="stat-value text-primary"><?= count(array_filter($inventaris, function($item) { return $item['kondisi'] == 'Baik'; })) ?></div>
                                <div class="stat-label">Kondisi Baik</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="stat-card">
                                <div class="stat-value text-warning"><?= count(array_filter($inventaris, function($item) { return in_array($item['kondisi'], ['Rusak', 'Diperbaiki']); })) ?></div>
                                <div class="stat-label">Perlu Perbaikan</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Table -->
                    <div class="card shadow-sm">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="mb-0">Daftar Barang Inventaris</h5>
                                <?php if ($pager->getTotal() > 0): ?>
                                    <small class="text-muted">
                                        Halaman <?= $pager->getCurrentPage() ?> dari <?= $pager->getPageCount() ?> 
                                        (Total: <?= $pager->getTotal() ?> barang)
                                    </small>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Foto</th>
                                            <th>Nama Barang</th>
                                            <th>Kategori</th>
                                            <th>Tanggal Pembelian</th>
                                            <th>Jumlah</th>
                                            <th>Kondisi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($inventaris)): $no = (($pager->getCurrentPage() - 1) * $pager->getPerPage()) + 1; ?>
                                            <?php foreach ($inventaris as $item): ?>
                                                <tr>
                                                    <td><?= $no++ ?></td>
                                                    <td>
                                                        <?php if (!empty($item['foto_barang'])): ?>
                                                            <img src="<?= base_url('uploads/inventaris/' . $item['foto_barang']) ?>" 
                                                                 alt="<?= esc($item['nama_barang']) ?>" 
                                                                 class="rounded" 
                                                                 width="60" 
                                                                 height="60" 
                                                                 style="object-fit: cover;">
                                                        <?php else: ?>
                                                            <div class="bg-light rounded d-flex align-items-center justify-content-center" 
                                                                 style="width: 60px; height: 60px;">
                                                                <i class="bi bi-image text-muted"></i>
                                                            </div>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td class="fw-bold"><?= esc($item['nama_barang']) ?></td>
                                                    <td><?= esc($item['kategori']) ?></td>
                                                    <td><?= \CodeIgniter\I18n\Time::parse($item['tanggal_pembelian'])->toLocalizedString('d MMMM yyyy') ?></td>
                                                    <td><?= esc($item['jumlah']) ?></td>
                                                    <td>
                                                        <span class="badge bg-<?= $item['kondisi'] == 'Baik' ? 'success' : ($item['kondisi'] == 'Rusak' ? 'danger' : 'warning') ?>">
                                                            <?= esc($item['kondisi']) ?>
                                                        </span>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr><td colspan="7" class="text-center py-5"><p class="text-muted">Tidak ada data untuk filter yang dipilih.</p></td></tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Pagination -->
                    <?php if ($pager->getPageCount() > 1): ?>
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <div class="text-muted">
                            Menampilkan <?= (($pager->getCurrentPage() - 1) * $pager->getPerPage()) + 1 ?> - 
                            <?= min($pager->getCurrentPage() * $pager->getPerPage(), $pager->getTotal()) ?> 
                            dari <?= $pager->getTotal() ?> barang
                        </div>
                        <?= $pager->links('bootstrap_full') ?>
                    </div>
                    <?php endif; ?>
                </div>
            </section>
        </main>
        <?= $this->include('components/footer_public') ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 