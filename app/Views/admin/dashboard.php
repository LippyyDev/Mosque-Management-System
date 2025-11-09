<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('sidebar') ?>
<?= $this->include('components/sidebar_admin') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">
        <i class="fas fa-tachometer-alt me-2 text-dark"></i>
        Dashboard Admin
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
    <div class="col-6 col-md-3">
        <div class="card border-dark text-center">
            <div class="card-body py-3">
                <div class="fw-bold fs-4 text-dark"><?= $totalUser ?></div>
                <div class="text-muted small">Total Akun</div>
                    </div>
                </div>
            </div>
    <div class="col-6 col-md-3">
        <div class="card border-dark text-center">
            <div class="card-body py-3">
                <div class="fw-bold fs-4 text-dark"><?= $totalPengurus ?></div>
                <div class="text-muted small">Pengurus</div>
            </div>
        </div>
    </div>
    <div class="col-6 col-md-3">
        <div class="card border-dark text-center">
            <div class="card-body py-3">
                <div class="fw-bold fs-4 text-dark"><?= $totalInventaris ?></div>
                <div class="text-muted small">Inventaris</div>
                    </div>
                </div>
            </div>
    <div class="col-6 col-md-3">
        <div class="card border-dark text-center">
            <div class="card-body py-3">
                <div class="fw-bold fs-4 text-dark"><?= $totalBerita ?></div>
                <div class="text-muted small">Berita</div>
            </div>
        </div>
    </div>
                    </div>

<!-- Grafik Section (dummy, bisa diisi data real jika ada) -->
<div class="row mb-4 g-3">
    <div class="col-md-6 mb-2">
        <div class="card border-dark h-100">
            <div class="card-header bg-white border-bottom border-dark py-2">
                <h6 class="mb-0 text-dark"><i class="fas fa-chart-line me-2"></i>Grafik Aktivitas (Line)</h6>
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

<!-- Menu Section Monokrom (contoh menu admin) -->
<div class="row g-3 mb-4">
    <div class="col-md-3 col-6">
        <div class="card border-dark text-center h-100">
            <div class="card-body py-4">
                <i class="fas fa-users fa-2x mb-2 text-dark"></i>
                <h6 class="fw-bold text-dark">Kelola Akun</h6>
                <a href="<?= base_url('/admin/users') ?>" class="btn btn-dark btn-sm w-100 mt-2">Kelola</a>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-6">
        <div class="card border-dark text-center h-100">
            <div class="card-body py-4">
                <i class="fas fa-database fa-2x mb-2 text-dark"></i>
                <h6 class="fw-bold text-dark">Backup Data</h6>
                <a href="#" class="btn btn-dark btn-sm w-100 mt-2">Backup</a>
            </div>
        </div>
                    </div>
    <div class="col-md-3 col-6">
        <div class="card border-dark text-center h-100">
            <div class="card-body py-4">
                <i class="fas fa-cogs fa-2x mb-2 text-dark"></i>
                <h6 class="fw-bold text-dark">Pengaturan</h6>
                <a href="#" class="btn btn-dark btn-sm w-100 mt-2">Pengaturan</a>
                        </div>
                    </div>
    </div>
    <div class="col-md-3 col-6">
        <div class="card border-dark text-center h-100">
            <div class="card-body py-4">
                <i class="fas fa-globe fa-2x mb-2 text-dark"></i>
                <h6 class="fw-bold text-dark">Lihat Website</h6>
                <a href="<?= base_url('/') ?>" class="btn btn-dark btn-sm w-100 mt-2">Lihat</a>
                </div>
            </div>
        </div>
    </div>

<!-- Profil Admin -->
<div class="row mt-4">
    <div class="col-md-4 mb-3">
        <div class="card border-dark">
            <div class="card-header bg-white border-bottom border-dark">
                <h5 class="mb-0 text-dark">
                    <i class="fas fa-user-shield me-2"></i>
                    Profil Admin
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
                <h6 class="mb-1 text-dark"><?= $user['nama_lengkap'] ?? '-' ?></h6>
                <span class="badge bg-dark mb-3"><?= $user['role'] ?? 'Admin' ?></span>
                <p class="text-muted small mb-3">Administrator sistem dengan akses penuh untuk mengelola pengguna dan pengaturan sistem.</p>
                <div class="d-grid">
                    <button class="btn btn-outline-dark btn-sm">
                        <i class="fas fa-edit me-1"></i>Edit Profil
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8 mb-3">
        <div class="card border-dark">
            <div class="card-header bg-white border-bottom border-dark">
                <h5 class="mb-0 text-dark">
                    <i class="fas fa-info-circle me-2"></i>
                    Informasi Sistem
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="text-dark">Fitur Admin:</h6>
                        <ul class="list-unstyled">
                            <li><i class="fas fa-check text-dark me-2"></i>Kelola Akun Pengguna</li>
                            <li><i class="fas fa-check text-dark me-2"></i>Manajemen Role & Permission</li>
                            <li><i class="fas fa-check text-dark me-2"></i>Monitor Aktivitas Sistem</li>
                            <li><i class="fas fa-check text-dark me-2"></i>Backup & Restore Data</li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h6 class="text-dark">Akses Cepat:</h6>
                        <div class="d-grid gap-2">
                            <a href="<?= base_url('/admin/users') ?>" class="btn btn-outline-dark btn-sm">
                                <i class="fas fa-users me-1"></i>Kelola Akun
                            </a>
                            <a href="#" class="btn btn-outline-dark btn-sm">
                                <i class="fas fa-database me-1"></i>Backup Data
                            </a>
                            <a href="#" class="btn btn-outline-dark btn-sm">
                                <i class="fas fa-cogs me-1"></i>Pengaturan
                            </a>
                            <a href="<?= base_url('/') ?>" class="btn btn-outline-dark btn-sm">
                                <i class="fas fa-globe me-1"></i>Lihat Website
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js CDN & Script (dummy data, bisa diisi data real) -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const lineData = {
    labels: <?= json_encode($lineLabels) ?>,
    datasets: [{
        label: 'User Baru',
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

