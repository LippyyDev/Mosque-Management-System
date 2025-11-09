<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('sidebar') ?>
<?= $this->include('components/sidebar_user') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">
        <i class="fas fa-tachometer-alt me-2 text-dark"></i>
        Dashboard User
    </h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group me-2">
            <button type="button" class="btn btn-sm btn-outline-dark">
                <i class="fas fa-calendar me-1"></i>
                <?= date('d F Y') ?>
            </button>
        </div>
    </div>
</div>

<!-- Statistik Numerik -->
<div class="row mb-3 g-3">
    <div class="col-6 col-md-2">
        <div class="card border-dark text-center">
            <div class="card-body py-3">
                <div class="fw-bold fs-4 text-dark">Rp <?= number_format($saldoKeuangan, 0, ',', '.') ?></div>
                <div class="text-muted small">Total Keuangan</div>
                    </div>
                </div>
            </div>
    <div class="col-6 col-md-2">
        <div class="card border-dark text-center">
            <div class="card-body py-3">
                <div class="fw-bold fs-4 text-dark"><?= $totalDonasi ?></div>
                <div class="text-muted small">Donasi</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-2">
        <div class="card border-dark text-center">
            <div class="card-body py-3">
                <div class="fw-bold fs-4 text-dark"><?= $totalPengurus ?></div>
                <div class="text-muted small">Pengurus</div>
                    </div>
                </div>
            </div>
    <div class="col-6 col-md-2">
        <div class="card border-dark text-center">
            <div class="card-body py-3">
                <div class="fw-bold fs-4 text-dark"><?= $totalInventaris ?></div>
                <div class="text-muted small">Inventaris</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-2">
        <div class="card border-dark text-center">
            <div class="card-body py-3">
                <div class="fw-bold fs-4 text-dark"><?= $totalBerita ?></div>
                <div class="text-muted small">Berita</div>
                    </div>
                </div>
            </div>
    <div class="col-6 col-md-2">
        <div class="card border-dark text-center">
            <div class="card-body py-3">
                <div class="fw-bold fs-4 text-dark"><?= $totalSurat ?></div>
                <div class="text-muted small">Surat</div>
            </div>
            </div>
        </div>
    </div>

<!-- Grafik Section (lebih kecil) -->
<div class="row mb-4 g-3">
    <div class="col-md-6 mb-2">
        <div class="card border-dark h-100">
            <div class="card-header bg-white border-bottom border-dark py-2">
                <h6 class="mb-0 text-dark"><i class="fas fa-chart-line me-2"></i>Grafik Keuangan (Line)</h6>
            </div>
            <div class="card-body p-2">
                <canvas id="lineChart" height="160"></canvas>
                    </div>
                    </div>
                </div>
    <div class="col-md-6 mb-2">
        <div class="card border-dark h-100">
            <div class="card-header bg-white border-bottom border-dark py-2">
                <h6 class="mb-0 text-dark"><i class="fas fa-chart-column me-2"></i>Jumlah Data (Column)</h6>
            </div>
            <div class="card-body p-2">
                <canvas id="barChart" height="160"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Menu Section Monokrom -->
<div class="row g-3 mb-4">
    <div class="col-md-2 col-6">
        <div class="card border-dark text-center h-100">
            <div class="card-body py-4">
                <i class="fas fa-money-bill-wave fa-2x mb-2 text-dark"></i>
                <h6 class="fw-bold text-dark">Keuangan</h6>
                <a href="<?= base_url('/user/kelola-keuangan') ?>" class="btn btn-dark btn-sm w-100 mt-2">Kelola</a>
            </div>
                        </div>
                    </div>
    <div class="col-md-2 col-6">
        <div class="card border-dark text-center h-100">
            <div class="card-body py-4">
                <i class="fas fa-newspaper fa-2x mb-2 text-dark"></i>
                <h6 class="fw-bold text-dark">Berita</h6>
                <a href="<?= base_url('/user/kelola-berita') ?>" class="btn btn-dark btn-sm w-100 mt-2">Kelola</a>
                        </div>
                    </div>
                </div>
    <div class="col-md-2 col-6">
        <div class="card border-dark text-center h-100">
            <div class="card-body py-4">
                <i class="fas fa-users-cog fa-2x mb-2 text-dark"></i>
                <h6 class="fw-bold text-dark">Pengurus</h6>
                <a href="<?= base_url('/user/kelola-pengurus') ?>" class="btn btn-dark btn-sm w-100 mt-2">Kelola</a>
            </div>
        </div>
    </div>
    <div class="col-md-2 col-6">
        <div class="card border-dark text-center h-100">
            <div class="card-body py-4">
                <i class="fas fa-boxes fa-2x mb-2 text-dark"></i>
                <h6 class="fw-bold text-dark">Inventaris</h6>
                <a href="<?= base_url('/user/kelola-inventaris') ?>" class="btn btn-dark btn-sm w-100 mt-2">Kelola</a>
            </div>
                    </div>
                </div>
    <div class="col-md-2 col-6">
        <div class="card border-dark text-center h-100">
            <div class="card-body py-4">
                <i class="fas fa-images fa-2x mb-2 text-dark"></i>
                <h6 class="fw-bold text-dark">Galeri</h6>
                <a href="<?= base_url('/user/kelola-galeri') ?>" class="btn btn-dark btn-sm w-100 mt-2">Kelola</a>
            </div>
        </div>
            </div>
    <div class="col-md-2 col-6">
        <div class="card border-dark text-center h-100">
            <div class="card-body py-4">
                <i class="fas fa-file-alt fa-2x mb-2 text-dark"></i>
                <h6 class="fw-bold text-dark">Persuratan</h6>
                <a href="<?= base_url('/user/kelola-persuratan') ?>" class="btn btn-dark btn-sm w-100 mt-2">Kelola</a>
            </div>
        </div>
    </div>
</div>

<!-- Panduan & Profil tetap, style monokrom -->
<div class="row mt-4">
    <div class="col-md-8 mb-3">
        <div class="card border-dark">
            <div class="card-header bg-white border-bottom border-dark">
                <h5 class="mb-0 text-dark">
                    <i class="fas fa-info-circle me-2"></i>
                    Panduan Penggunaan
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <h6 class="text-dark">Kelola Data:</h6>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-check text-dark me-2"></i>Keuangan Masjid</li>
                            <li><i class="fas fa-check text-dark me-2"></i>Data Pengurus</li>
                            <li><i class="fas fa-check text-dark me-2"></i>Inventaris & Aset</li>
                            <li><i class="fas fa-check text-dark me-2"></i>Berita & Informasi</li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h6 class="text-dark">Monitor:</h6>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-check text-dark me-2"></i>Donasi Jamaah</li>
                            <li><i class="fas fa-check text-dark me-2"></i>Kritik & Saran</li>
                            <li><i class="fas fa-check text-dark me-2"></i>Jadwal Imam & Khatib</li>
                            <li><i class="fas fa-check text-dark me-2"></i>Galeri Kegiatan</li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h6 class="text-dark">Administrasi:</h6>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-check text-dark me-2"></i>Persuratan</li>
                            <li><i class="fas fa-check text-dark me-2"></i>Pengaturan Masjid</li>
                            <li><i class="fas fa-check text-dark me-2"></i>Laporan & Dokumentasi</li>
                            <li><i class="fas fa-check text-dark me-2"></i>Backup Data</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <div class="card border-dark">
            <div class="card-header bg-white border-bottom border-dark">
                <h5 class="mb-0 text-dark">
                    <i class="fas fa-user me-2"></i>
                    Profil User
                </h5>
            </div>
            <div class="card-body text-center">
                <?php if (!empty($user['foto_profil'])): ?>
                    <img src="<?= base_url('uploads/profiles/' . $user['foto_profil']) ?>" alt="Profile" class="rounded-circle mb-3" style="width: 80px; height: 80px; object-fit: cover;">
                <?php else: ?>
                    <div class="bg-dark rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                        <i class="fas fa-user fa-2x text-white"></i>
                    </div>
                <?php endif; ?>
                <h6 class="mb-1 text-dark"><?= $user['nama_lengkap'] ?></h6>
                <span class="badge bg-dark mb-3"><?= $user['role'] ?></span>
                <p class="text-muted small mb-3">Pengurus masjid dengan akses untuk mengelola data dan informasi masjid.</p>
                <div class="d-grid">
                    <button class="btn btn-outline-dark btn-sm">
                        <i class="fas fa-edit me-1"></i>Edit Profil
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js CDN & Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Data dari PHP
const lineData = {
    labels: <?= json_encode($lineLabels) ?>,
    datasets: [{
        label: 'Saldo Keuangan',
        data: <?= json_encode($lineData) ?>,
        borderColor: '#212529',
        backgroundColor: 'rgba(33,37,41,0.1)',
        tension: 0.4,
        fill: true
    }]
};
const barData = {
    labels: <?= json_encode($barLabels) ?>,
    datasets: [{
        label: 'Jumlah Data',
        data: <?= json_encode($barData) ?>,
        backgroundColor: '#212529',
        borderRadius: 6
    }]
};
new Chart(document.getElementById('lineChart'), { type: 'line', data: lineData, options: { plugins: { legend: { display: false } } } });
new Chart(document.getElementById('barChart'), { type: 'bar', data: barData, options: { plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true } } } });
</script>
<?= $this->endSection() ?>

