<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Galeri - <?= esc($pengaturan['nama_masjid'] ?? 'Masjid Nurul Falah') ?></title>
    <link rel="shortcut icon" href="<?= base_url('favicon.ico') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    <style>
        .gallery-card {
            margin-bottom: 2rem;
        }
    </style>
</head>
<body style="min-height:100vh; display:flex; flex-direction:column;">
    <div class="navbar-container container">
        <?= $this->include('components/navbar_public') ?>
    </div>
    <div class="page-wrapper d-flex flex-column" style="min-height:100vh;">
        <main style="flex:1 0 auto;">
            <section class="py-5 bg-light">
                <div class="container" style="max-width: 1200px;">
                    <h2 class="fw-bold mb-4 text-center">Galeri Kegiatan</h2>
                    
                    <?php if (empty($galeri)): ?>
                        <div class="alert alert-warning text-center">Belum ada galeri yang dipublikasikan.</div>
                    <?php else: ?>
                        <div class="row g-4">
                            <?php foreach ($galeri as $item): ?>
                                <div class="col-md-6 col-lg-4" data-aos="fade-up">
                                    <div class="gallery-card">
                                        <a href="<?= base_url('galeri/show/' . $item['id']) ?>" class="gallery-img-container">
                                            <img src="<?= !empty($item['cover']) ? base_url('public/uploads/galeri/' . $item['cover']) : 'https://images.unsplash.com/photo-1529156069898-49953e39b3ac?q=80&w=1932&auto=format&fit=crop' ?>" alt="<?= esc($item['judul']) ?>">
                                            <div class="gallery-overlay">
                                                <i class="bi bi-eye"></i>
                                            </div>
                                        </a>
                                        <div class="gallery-card-body">
                                            <a href="<?= base_url('galeri/show/' . $item['id']) ?>" class="gallery-title mt-2 d-block"><?= esc($item['judul']) ?></a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
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