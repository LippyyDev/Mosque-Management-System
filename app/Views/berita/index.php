<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Semua Berita - <?= esc($pengaturan['nama_masjid'] ?? 'Masjid Nurul Falah') ?></title>
    <link rel="shortcut icon" href="<?= base_url('favicon.ico') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    <style>
        .berita-list-card {
            border-radius: 1rem;
            box-shadow: 0 2px 16px rgba(0,0,0,0.07);
            background: #fff;
            margin-bottom: 2rem;
            transition: box-shadow .2s;
            overflow: hidden;
        }
        .berita-list-card:hover {
            box-shadow: 0 4px 24px rgba(0,0,0,0.13);
        }
        .berita-list-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .berita-list-body {
            padding: 1.5rem;
        }
        .berita-list-title {
            font-size: 1.2rem;
            font-weight: 700;
            color: #222;
        }
        .berita-list-meta {
            font-size: 0.95rem;
            color: #888;
        }
        .pagination {
            justify-content: center;
        }
        @media (min-width: 768px) {
            .berita-list-img {
                height: 100%;
                border-radius: 1rem 0 0 1rem;
            }
            .berita-list-card .row > [class^="col-"] {
                padding-right: 0;
            }
             .berita-list-card .row > [class^="col-"]:last-child {
                padding-left: 0;
            }
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
                <div class="container" style="max-width: 900px;">
                    <h2 class="fw-bold mb-4 text-center">Kumpulan Berita</h2>
                    <!-- Search Bar -->
                    <form class="mb-4" method="get" action="<?= base_url('berita') ?>">
                        <div class="input-group input-group-lg">
                            <input type="text" class="form-control" name="q" placeholder="Cari judul atau isi berita..." value="<?= esc($_GET['q'] ?? '') ?>">
                            <button class="btn btn-dark" type="submit"><i class="bi bi-search"></i> Cari</button>
                        </div>
                    </form>
                    <?php if (empty($beritaList)): ?>
                        <div class="alert alert-warning text-center">Belum ada berita.</div>
                    <?php else: ?>
                        <?php foreach ($beritaList as $item): ?>
                            <div class="berita-list-card">
                                <div class="row g-0">
                                    <div class="col-md-4">
                                        <img src="<?= !empty($item['gambar']) ? base_url('public/uploads/berita/' . esc($item['gambar'])) : 'https://images.unsplash.com/photo-1504711434969-e33886168f5c?q=80&w=2070&auto=format&fit=crop' ?>"
                                            class="berita-list-img"
                                            alt="<?= esc($item['judul']) ?>">
                                    </div>
                                    <div class="col-md-8">
                                        <div class="berita-list-body d-flex flex-column justify-content-between h-100">
                                            <div>
                                                <div class="berita-list-meta mb-1">
                                                    <span class="badge bg-dark me-2"><?= esc($item['kategori']) ?></span>
                                                    <i class="bi bi-calendar me-1"></i> <?= date('d F Y, H:i', strtotime($item['tanggal_publish'])) ?>
                                                </div>
                                                <div class="berita-list-title mb-2">
                                                    <a href="<?= base_url('berita/show/' . $item['id']) ?>" class="text-decoration-none text-dark">
                                                        <?= esc($item['judul']) ?>
                                                    </a>
                                                </div>
                                                <div class="text-secondary mb-3" style="font-size:1rem;">
                                                    <?= esc(mb_strimwidth(strip_tags($item['isi']), 0, 150, '...')) ?>
                                                </div>
                                            </div>
                                            <div class="mt-auto">
                                                <a href="<?= base_url('berita/show/' . $item['id']) ?>" class="btn btn-outline-dark btn-sm">Lihat Detail</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <!-- Pagination -->
                        <?php
                            $totalPages = ceil($total / $perPage);
                            $currentPage = $page;
                        ?>
                        <?php if ($totalPages > 1): ?>
                            <nav aria-label="Page navigation">
                                <ul class="pagination">
                                    <li class="page-item<?= $currentPage == 1 ? ' disabled' : '' ?>">
                                        <a class="page-link" href="<?= base_url('berita?page=' . ($currentPage - 1)) ?>">Sebelumnya</a>
                                    </li>
                                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                        <li class="page-item<?= $i == $currentPage ? ' active' : '' ?>">
                                            <a class="page-link" href="<?= base_url('berita?page=' . $i) ?>"><?= $i ?></a>
                                        </li>
                                    <?php endfor; ?>
                                    <li class="page-item<?= $currentPage == $totalPages ? ' disabled' : '' ?>">
                                        <a class="page-link" href="<?= base_url('berita?page=' . ($currentPage + 1)) ?>">Selanjutnya</a>
                                    </li>
                                </ul>
                            </nav>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </section>
        </main>
        <?= $this->include('components/footer_public') ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 