<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title) ?> - Galeri - <?= esc($pengaturan['nama_masjid'] ?? 'Masjid Nurul Falah') ?></title>
    <link rel="shortcut icon" href="<?= base_url('favicon.ico') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    <style>
        .gallery-photo {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border-radius: 0.5rem;
            cursor: pointer;
            transition: opacity 0.3s;
        }
        .gallery-photo:hover {
            opacity: 0.8;
        }
        #lightbox {
            position: fixed;
            z-index: 10000;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            display: none;
            align-items: center;
            justify-content: center;
        }
        #lightbox img {
            max-width: 90%;
            max-height: 80%;
            border-radius: 5px;
        }
        #lightbox-close {
            position: absolute;
            top: 20px;
            right: 30px;
            font-size: 3rem;
            color: white;
            cursor: pointer;
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
                    <h2 class="fw-bold mb-2 text-center"><?= esc($item['judul']) ?></h2>
                    <p class="text-muted text-center mb-5">Album dipublikasikan pada <?= date('d F Y', strtotime($item['tanggal'])) ?></p>

                    <?php if (!empty($item['video_youtube'])): ?>
                        <?php
                            $video = $item['video_youtube'];
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

                    <?php if (empty($gambar)): ?>
                        <div class="alert alert-warning text-center">Tidak ada gambar dalam album ini.</div>
                    <?php else: ?>
                        <div class="row g-4">
                            <?php foreach ($gambar as $g): ?>
                                <div class="col-md-4 col-sm-6">
                                    <img src="<?= base_url('public/uploads/galeri/' . $g['gambar']) ?>" class="gallery-photo" alt="Gambar Galeri">
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                     <div class="text-center mt-5">
                        <a href="<?= base_url('galeri') ?>" class="btn btn-outline-dark"><i class="bi bi-arrow-left"></i> Kembali ke Galeri</a>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <div id="lightbox">
        <span id="lightbox-close">&times;</span>
        <img id="lightbox-image" src="" alt="Gambar Diperbesar">
    </div>

    <?= $this->include('components/footer_public') ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const lightbox = document.getElementById('lightbox');
            const lightboxImage = document.getElementById('lightbox-image');
            const lightboxClose = document.getElementById('lightbox-close');
            const galleryPhotos = document.querySelectorAll('.gallery-photo');

            galleryPhotos.forEach(photo => {
                photo.addEventListener('click', function () {
                    const imageUrl = this.src;
                    lightboxImage.src = imageUrl;
                    lightbox.style.display = 'flex';
                });
            });

            function closeLightbox() {
                lightbox.style.display = 'none';
            }

            lightboxClose.addEventListener('click', closeLightbox);
            lightbox.addEventListener('click', function(e) {
                if (e.target === this) {
                    closeLightbox();
                }
            });
        });
    </script>
</body>
</html> 