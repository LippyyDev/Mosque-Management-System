<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Visi & Misi') . ' - ' . esc($pengaturan['nama_masjid'] ?? 'Sistem Informasi Masjid') ?></title>
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
                    <div class="row justify-content-center g-5">
                        <!-- Visi -->
                        <div class="col-lg-10">
                             <h2 class="mb-3 text-center">Visi</h2>
                            <div class="card shadow-sm">
                                <div class="card-body p-5">
                                    <?php if (!empty($pengaturan['visi'])): ?>
                                        <div class="fs-5 text-center" style="line-height: 1.8;">
                                            <?= nl2br(esc($pengaturan['visi'])) ?>
                                        </div>
                                    <?php else: ?>
                                        <p class="text-center text-muted">Visi belum diatur. Silakan tambahkan melalui panel admin.</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <!-- Misi -->
                        <div class="col-lg-10">
                            <h2 class="mb-3 text-center">Misi</h2>
                            <div class="card shadow-sm">
                                <div class="card-body p-5">
                                    <?php if (!empty($pengaturan['misi'])): ?>
                                        <div class="fs-5" style="line-height: 1.8;">
                                            <?= nl2br(esc($pengaturan['misi'])) ?>
                                        </div>
                                    <?php else: ?>
                                        <p class="text-center text-muted">Misi belum diatur. Silakan tambahkan melalui panel admin.</p>
                                    <?php endif; ?>
                                </div>
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