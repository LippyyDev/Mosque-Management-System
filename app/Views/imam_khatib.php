<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Jadwal Imam & Khatib') . ' - ' . esc($pengaturan['nama_masjid'] ?? 'Sistem Informasi Masjid') ?></title>
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
                    <p class="section-subtitle">Berikut adalah jadwal petugas Imam dan Khatib untuk kegiatan ibadah mendatang.</p>

                    <div class="card shadow-sm">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Hari</th>
                                            <th>Jenis Kegiatan</th>
                                            <th>Imam</th>
                                            <th>Khatib</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($jadwal)): ?>
                                            <?php $no = 1; foreach ($jadwal as $item): ?>
                                                <tr>
                                                    <td><?= $no++ ?></td>
                                                    <td><?= \CodeIgniter\I18n\Time::parse($item['tanggal'])->toLocalizedString('d MMMM yyyy') ?></td>
                                                    <td><?= \CodeIgniter\I18n\Time::parse($item['tanggal'])->toLocalizedString('EEEE') ?></td>
                                                    <td><?= esc($item['jenis']) ?></td>
                                                    <td><?= esc($item['nama_imam']) ?></td>
                                                    <td><?= esc($item['nama_khatib']) ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="6" class="text-center py-5">
                                                    <p class="mb-0 text-muted">Belum ada jadwal yang akan datang.</p>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
        <?= $this->include('components/footer_public') ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 