<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($berita['judul']) ?> - <?= esc($pengaturan['nama_masjid'] ?? 'Masjid Nurul Falah') ?></title>
    <link rel="shortcut icon" href="<?= base_url('favicon.ico') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    <style>
        .berita-cover {
            display: block;
            margin-left: auto;
            margin-right: auto;
            border-radius: 1rem;
            box-shadow: 0 2px 16px rgba(0,0,0,0.07);
            margin-bottom: 2rem;
            max-width: 600px;
            max-height: 480px;
            width: auto;
            height: auto;
            object-fit: contain;
        }
        .berita-meta {
            font-size: 0.95rem;
            color: #888;
        }
        .berita-kategori {
            font-size: 0.95rem;
            font-weight: 500;
            color: #fff;
            background: #222;
            border-radius: 0.5rem;
            padding: 0.2rem 0.7rem;
            margin-right: 0.5rem;
        }
        .berita-lokasi {
            font-size: 0.95rem;
            color: #444;
            margin-right: 0.5rem;
        }
        .berita-updated {
            font-size: 0.92rem;
            color: #aaa;
        }
        .berita-isi {
            font-size: 1.13rem;
            color: #222;
            line-height: 1.7;
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
                <div class="container" style="max-width: 820px;">
                    <div class="mb-4 text-center">
                        <h1 class="fw-bold mb-3"><?= esc($berita['judul']) ?></h1>
                        <div class="berita-meta mb-2">
                            <span class="berita-kategori"><i class="bi bi-tag"></i> <?= esc($berita['kategori']) ?></span>
                            <?php if (!empty($berita['lokasi'])): ?>
                                <span class="berita-lokasi"><i class="bi bi-geo-alt"></i> <?= esc($berita['lokasi']) ?></span>
                            <?php endif; ?>
                            <span><i class="bi bi-calendar"></i> <?= date('d F Y, H:i', strtotime($berita['tanggal_publish'])) ?></span>
                        </div>
                        <div class="berita-updated mb-2">
                            Diperbarui: <?= date('d F Y, H:i', strtotime($berita['updated_at'])) ?>
                        </div>
                    </div>
                    <?php if (!empty($berita['gambar_list'])): ?>
                        <div class="row g-3 justify-content-center mb-4">
                            <?php foreach ($berita['gambar_list'] as $g): ?>
                                <div class="col-12">
                                    <img src="<?= base_url('public/uploads/berita/' . esc($g['gambar'])) ?>" alt="Gambar Berita" class="berita-cover mx-auto d-block">
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($berita['video_youtube'])): ?>
                        <?php
                            $video = $berita['video_youtube'];
                            $embedUrl = '';
                            if (preg_match('/(youtu.be\\/|youtube.com.*[?&]v=)([\\w-]+)/i', $video, $ytMatch)) {
                                $videoId = end($ytMatch);
                                $embedUrl = 'https://www.youtube.com/embed/' . htmlspecialchars($videoId);
                            } elseif (preg_match('/drive.google.com\\/file\\/d\\/([\\w-]+)/i', $video, $gdMatch)) {
                                $videoId = $gdMatch[1];
                                $embedUrl = 'https://drive.google.com/file/d/' . htmlspecialchars($videoId) . '/preview';
                            }
                        ?>
                        <?php if ($embedUrl): ?>
                            <div class="ratio ratio-16x9 mb-4">
                                <iframe src="<?= $embedUrl ?>" allowfullscreen></iframe>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                    <div class="berita-isi mt-4">
                        <?= nl2br(esc($berita['isi'])) ?>
                    </div>
                </div>
            </section>
        </main>
        <?= $this->include('components/footer_public') ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 