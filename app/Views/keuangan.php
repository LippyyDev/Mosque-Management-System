<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Laporan Keuangan') . ' - ' . esc($pengaturan['nama_masjid'] ?? 'Sistem Informasi Masjid') ?></title>
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
                    <p class="section-subtitle">Transparansi keuangan untuk kemaslahatan umat.</p>
                    
                    <!-- Filter Form -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <form action="<?= base_url('keuangan') ?>" method="get">
                                <div class="row g-3 align-items-end">
                                    <div class="col-md-3">
                                        <label for="jenis" class="form-label">Jenis</label>
                                        <select class="form-select" id="jenis" name="jenis">
                                            <option value="">Semua</option>
                                            <option value="Pemasukan" <?= ($filters['jenis'] ?? '') == 'Pemasukan' ? 'selected' : '' ?>>Pemasukan</option>
                                            <option value="Pengeluaran" <?= ($filters['jenis'] ?? '') == 'Pengeluaran' ? 'selected' : '' ?>>Pengeluaran</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="kategori" class="form-label">Kategori</label>
                                        <select class="form-select" id="kategori" name="kategori">
                                            <option value="">Semua</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="tanggal_dari" class="form-label">Dari</label>
                                        <input type="date" class="form-control" name="tanggal_dari" value="<?= esc($filters['tanggal_dari'] ?? '') ?>">
                                    </div>
                                    <div class="col-md-2">
                                        <label for="tanggal_sampai" class="form-label">Sampai</label>
                                        <input type="date" class="form-control" name="tanggal_sampai" value="<?= esc($filters['tanggal_sampai'] ?? '') ?>">
                                    </div>
                                    <div class="col-md-3 d-flex gap-2">
                                        <button type="submit" class="btn btn-dark w-100">Filter</button>
                                        <a href="<?= base_url('keuangan') ?>" class="btn btn-outline-secondary w-100">Reset</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Summary Cards -->
                    <div class="row g-4 mb-4">
                        <div class="col-md-4"><div class="stat-card">
                                <div class="stat-value text-success">Rp <?= number_format($total_pemasukan, 0, ',', '.') ?></div>
                                <div class="stat-label">Total Pemasukan</div>
                        </div></div>
                        <div class="col-md-4"><div class="stat-card">
                                <div class="stat-value text-danger">Rp <?= number_format($total_pengeluaran, 0, ',', '.') ?></div>
                                <div class="stat-label">Total Pengeluaran</div>
                        </div></div>
                        <div class="col-md-4"><div class="stat-card">
                                <div class="stat-value">Rp <?= number_format($saldo, 0, ',', '.') ?></div>
                                <div class="stat-label">Saldo Akhir</div>
                        </div></div>
                    </div>
                    
                    <!-- Table -->
                    <div class="card shadow-sm">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <div>
                                <h5 class="mb-0">Detail Transaksi</h5>
                                <?php if ($pagination['total_records'] > 0): ?>
                                    <small class="text-muted">
                                        Halaman <?= $pagination['current_page'] ?> dari <?= $pagination['total_pages'] ?> 
                                        (Total: <?= $pagination['total_records'] ?> transaksi)
                                    </small>
                                <?php endif; ?>
                            </div>
                            <a href="<?= site_url('keuangan/export-pdf?' . http_build_query($filters)) ?>" class="btn btn-outline-danger btn-sm">
                                <i class="bi bi-file-earmark-pdf"></i> Export PDF
                            </a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Jenis</th>
                                            <th>Kategori</th>
                                            <th>Keterangan</th>
                                            <th class="text-end">Nominal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($keuangan)): $no = 1; ?>
                                            <?php foreach ($keuangan as $item): ?>
                                                <tr>
                                                    <td><?= $no++ ?></td>
                                                    <td><?= \CodeIgniter\I18n\Time::parse($item['tanggal_transaksi'])->toLocalizedString('d MMMM yyyy') ?></td>
                                                    <td>
                                                        <span class="badge bg-<?= $item['jenis'] == 'Pemasukan' ? 'success' : 'danger' ?>"><?= $item['jenis'] ?></span>
                                                    </td>
                                                    <td><?= esc($item['kategori']) ?></td>
                                                    <td><?= esc($item['keterangan']) ?></td>
                                                    <td class="text-end fw-bold">Rp <?= number_format($item['nominal'], 0, ',', '.') ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr><td colspan="6" class="text-center py-5"><p class="text-muted">Tidak ada data untuk filter yang dipilih.</p></td></tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Pagination -->
                    <?php if ($pagination['total_pages'] > 1): ?>
                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <div class="text-muted">
                            Menampilkan <?= (($pagination['current_page'] - 1) * $pagination['per_page']) + 1 ?> - 
                            <?= min($pagination['current_page'] * $pagination['per_page'], $pagination['total_records']) ?> 
                            dari <?= $pagination['total_records'] ?> transaksi
                        </div>
                        <nav aria-label="Pagination">
                            <ul class="pagination mb-0">
                                <!-- Previous Button -->
                                <?php if ($pagination['current_page'] > 1): ?>
                                    <li class="page-item">
                                        <a class="page-link" href="<?= base_url('keuangan?' . http_build_query(array_merge($filters, ['page' => $pagination['current_page'] - 1]))) ?>">
                                            <i class="bi bi-chevron-left"></i> Sebelumnya
                                        </a>
                                    </li>
                                <?php else: ?>
                                    <li class="page-item disabled">
                                        <span class="page-link">
                                            <i class="bi bi-chevron-left"></i> Sebelumnya
                                        </span>
                                    </li>
                                <?php endif; ?>
                                
                                <!-- Page Numbers -->
                                <?php
                                $start = max(1, $pagination['current_page'] - 2);
                                $end = min($pagination['total_pages'], $pagination['current_page'] + 2);
                                
                                if ($start > 1): ?>
                                    <li class="page-item">
                                        <a class="page-link" href="<?= base_url('keuangan?' . http_build_query(array_merge($filters, ['page' => 1]))) ?>">1</a>
                                    </li>
                                    <?php if ($start > 2): ?>
                                        <li class="page-item disabled">
                                            <span class="page-link">...</span>
                                        </li>
                                    <?php endif; ?>
                                <?php endif; ?>
                                
                                <?php for ($i = $start; $i <= $end; $i++): ?>
                                    <li class="page-item <?= $i == $pagination['current_page'] ? 'active' : '' ?>">
                                        <a class="page-link" href="<?= base_url('keuangan?' . http_build_query(array_merge($filters, ['page' => $i]))) ?>"><?= $i ?></a>
                                    </li>
                                <?php endfor; ?>
                                
                                <?php if ($end < $pagination['total_pages']): ?>
                                    <?php if ($end < $pagination['total_pages'] - 1): ?>
                                        <li class="page-item disabled">
                                            <span class="page-link">...</span>
                                        </li>
                                    <?php endif; ?>
                                    <li class="page-item">
                                        <a class="page-link" href="<?= base_url('keuangan?' . http_build_query(array_merge($filters, ['page' => $pagination['total_pages']]))) ?>"><?= $pagination['total_pages'] ?></a>
                                    </li>
                                <?php endif; ?>
                                
                                <!-- Next Button -->
                                <?php if ($pagination['current_page'] < $pagination['total_pages']): ?>
                                    <li class="page-item">
                                        <a class="page-link" href="<?= base_url('keuangan?' . http_build_query(array_merge($filters, ['page' => $pagination['current_page'] + 1]))) ?>">
                                            Selanjutnya <i class="bi bi-chevron-right"></i>
                                        </a>
                                    </li>
                                <?php else: ?>
                                    <li class="page-item disabled">
                                        <span class="page-link">
                                            Selanjutnya <i class="bi bi-chevron-right"></i>
                                        </span>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </nav>
                    </div>
                    <?php endif; ?>
                </div>
            </section>
        </main>
        <?= $this->include('components/footer_public') ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const kategoriList = <?= json_encode($kategori_list) ?>;
            const jenisSelect = document.getElementById('jenis');
            const kategoriSelect = document.getElementById('kategori');
            const selectedKategori = '<?= esc($filters['kategori'] ?? '') ?>';

            function populateKategori(jenis) {
                // Clear current options
                kategoriSelect.innerHTML = '<option value="">Semua Kategori</option>';

                if (jenis && kategoriList[jenis]) {
                    // If a specific type is selected (Pemasukan/Pengeluaran)
                    kategoriList[jenis].forEach(function(kategori) {
                        const option = new Option(kategori, kategori);
                        kategoriSelect.add(option);
                    });
                } else if (!jenis) {
                    // If "Semua" is selected for jenis, show all categories with optgroup
                    for (const groupLabel in kategoriList) {
                        const optgroup = document.createElement('optgroup');
                        optgroup.label = groupLabel;
                        kategoriList[groupLabel].forEach(function(kategori) {
                            const option = new Option(kategori, kategori);
                            optgroup.appendChild(option);
                        });
                        kategoriSelect.appendChild(optgroup);
                    }
                }
                 // Reselect the previously selected category if it exists
                kategoriSelect.value = selectedKategori;
            }

            // Initial population
            populateKategori(jenisSelect.value);

            // Add event listener for changes
            jenisSelect.addEventListener('change', function() {
                // When "Jenis" changes, reset "Kategori" to "Semua" before repopulating
                kategoriSelect.value = "";
                populateKategori(this.value);
            });
        });
    </script>
</body>
</html> 