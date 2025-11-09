<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($pengaturan['nama_masjid'] ?? 'Selamat Datang') . ' - ' . esc($pengaturan['deskripsi_masjid'] ?? 'Sistem Informasi Masjid') ?></title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= base_url('favicon.ico') ?>">

    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- AOS CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">

    <!-- Satisfy Font -->
    <link href="https://fonts.googleapis.com/css2?family=Satisfy&display=swap" rel="stylesheet">

</head>

<body style="min-height:100vh; display:flex; flex-direction:column;">
    <div class="navbar-container container">
        <?= $this->include('components/navbar_public') ?>
    </div>
    <div class="page-wrapper d-flex flex-column" style="min-height:100vh;">
        <main style="flex:1 0 auto;">
    <!-- Hero Section -->
            <section id="hero">
                <div class="hero-background">
                     <img src="<?= !empty($pengaturan['background_image']) ? base_url('uploads/pengaturan/' . esc($pengaturan['background_image'])) : base_url('public/background.png') ?>" alt="Foto Masjid Nurul Falah">
                </div>
                <div class="hero-overlay"></div>
                <div class="container hero-content" data-aos="fade-up">
            <div class="row justify-content-center">
                        <div class="col-lg-10 text-center">
                            <h2 class="hero-subtitle mb-3">Selamat Datang di Website Resmi</h2>
                            <h1><span id="typed-title" class="hero-handwriting"></span></h1>
                            <p class="mt-3 mx-auto"><?= esc($pengaturan['deskripsi_masjid'] ?? 'Pusat Ibadah dan Ukhuwah Islamiyah di Leworeng.') ?></p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Date & Time Bar -->
            <div id="time-bar">
                <div class="row align-items-center gy-3">
                    <div class="col-lg-5 text-center text-lg-start">
                        <div id="gregorian-date" class="fw-bold"></div>
                        <div id="hijri-date" class="small"></div>
                    </div>
                    <div class="col-lg-7">
                        <div class="d-flex justify-content-center justify-content-lg-end align-items-center">
                            <div class="time-zone">
                                <span class="tz-label">WIB</span>
                                <span class="tz-time" id="wib-time">00:00:00</span>
                            </div>
                            <div class="time-zone">
                                <span class="tz-label">WITA</span>
                                <span class="tz-time" id="wita-time">00:00:00</span>
                            </div>
                            <div class="time-zone">
                                <span class="tz-label">WIT</span>
                                <span class="tz-time" id="wit-time">00:00:00</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Info Cepat Section -->
            <section id="info-cepat" class="section" style="padding: 4rem 0;">
                <div class="container">
                    <div class="row g-4 justify-content-center">
                        <!-- Jadwal Shalat -->
                        <div class="col-12" data-aos="fade-up">
                            <div class="info-card h-100">
                                <h4 class="info-card-title">Jadwal Shalat Hari Ini</h4>
                                <p class="info-card-subtitle">Untuk wilayah Kab. Soppeng dan sekitarnya.</p>
                                <?php if (!empty($prayer_times)): ?>
                                    <div class="prayer-times-grid">
                                        <?php 
                                            $prayer_schedule = [
                                                'Imsak' => ['time' => $prayer_times['imsak'], 'icon' => 'bi-brightness-alt-high'],
                                                'Subuh' => ['time' => $prayer_times['subuh'], 'icon' => 'bi-sunrise'],
                                                'Dzuhur' => ['time' => $prayer_times['dzuhur'], 'icon' => 'bi-sun'],
                                                'Ashar' => ['time' => $prayer_times['ashar'], 'icon' => 'bi-brightness-high'],
                                                'Maghrib' => ['time' => $prayer_times['maghrib'], 'icon' => 'bi-sunset'],
                                                'Isya' => ['time' => $prayer_times['isya'], 'icon' => 'bi-moon-stars'],
                                            ];
                                        ?>
                                        <?php foreach ($prayer_schedule as $name => $details): ?>
                                            <div class="prayer-time-item">
                                                <i class="bi <?= $details['icon'] ?> prayer-icon"></i>
                                                <div class="prayer-details">
                                                    <span class="prayer-name"><?= $name ?></span>
                                                    <span class="prayer-time"><?= $details['time'] ?></span>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php else: ?>
                                    <div class="text-center py-5">
                                        <p class="text-muted">Gagal memuat jadwal shalat. Silakan coba lagi nanti.</p>
                                    </div>
                                <?php endif; ?>
        </div>
    </div>

                        <!-- Imam & Khatib + Imam & Muadzin Harian dalam satu row -->
                        <div class="row g-4 justify-content-center">
                            <!-- Petugas Jumat -->
                            <div class="col-12 col-lg-6" data-aos="fade-up">
                                <div class="info-card info-card-dark h-100">
                                    <?php if (!empty($imam_khatib) && $imam_khatib['tanggal']): ?>
                                        <div class="text-center text-lg-start">
                                            <h4 class="info-card-title mb-1">Petugas Jumat</h4>
                                            <p class="info-card-subtitle mb-3"><?= \CodeIgniter\I18n\Time::parse($imam_khatib['tanggal'])->toLocalizedString('EEEE, d MMMM yyyy') ?></p>
                                            <div class="d-flex align-items-center mb-2 justify-content-center justify-content-lg-start">
                                                <span class="me-2"><i class="bi bi-mic-fill fs-4"></i></span>
                                                <span class="officer-role">Khatib</span>
                                                <span class="fw-bold ms-2 officer-name"><?= esc($imam_khatib['nama_khatib'] ?? 'Belum diatur') ?></span>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-center justify-content-lg-start">
                                                <span class="me-2"><i class="bi bi-person-standing fs-4"></i></span>
                                                <span class="officer-role">Imam</span>
                                                <span class="fw-bold ms-2 officer-name"><?= esc($imam_khatib['nama_imam'] ?? 'Belum diatur') ?></span>
                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <div class="text-center py-4">
                                            <h4 class="info-card-title mb-1">Petugas Jumat</h4>
                                            <p class="text-muted-dark mt-2 mb-0">Jadwal untuk Jumat mendatang belum diatur.</p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <!-- Imam & Muadzin Harian -->
                            <div class="col-12 col-lg-6" data-aos="fade-up" data-aos-delay="100">
                                <div class="info-card info-card-dark h-100">
                                    <h4 class="info-card-title mb-1">Imam & Muadzin Harian</h4>
                                    <div id="imam-muadzin-harian-tanggal" class="info-card-subtitle mb-3 text-start"></div>
                                    <div id="imam-muadzin-harian" class="d-flex flex-column align-items-start" style="min-height:40px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Tentang Section -->
            <section id="tentang" class="section position-relative" style="background-color: #181a1b; overflow: hidden;">
                <!-- Motif SVG abstrak animasi -->
                <svg class="position-absolute top-0 start-0 w-100 h-100 abstrak-anim" style="opacity:0.13; z-index:0; pointer-events:none;" preserveAspectRatio="none" viewBox="0 0 1920 400">
                    <defs>
                        <linearGradient id="grad1" x1="0" y1="0" x2="1" y2="1">
                            <stop offset="0%" stop-color="#fff" stop-opacity="0.2"/>
                            <stop offset="100%" stop-color="#fff" stop-opacity="0.05"/>
                        </linearGradient>
                    </defs>
                    <g class="gelombang-move">
                        <path d="M0,100 Q480,200 960,100 T1920,100 V400 H0 Z" fill="url(#grad1)"/>
                    </g>
                    <g class="circle1-move">
                        <circle cx="300" cy="80" r="120" fill="#fff" fill-opacity="0.08"/>
                    </g>
                    <g class="circle2-move">
                        <circle cx="1700" cy="60" r="90" fill="#fff" fill-opacity="0.07"/>
                    </g>
                    <g class="rect-move">
                        <rect x="1200" y="250" width="300" height="80" rx="40" fill="#fff" fill-opacity="0.06"/>
                    </g>
                </svg>
                <div class="container position-relative" style="z-index:1;">
                    <div class="row align-items-center gx-5">
                        <div class="col-lg-6" data-aos="fade-right">
                            <h2 class="section-title text-start mb-3 text-white">Tentang Masjid Nurul Falah</h2>
                            <p class="text-secondary text-white-50"><?= nl2br(esc($pengaturan['sejarah'] ?? 'Sejarah singkat masjid belum diatur. Silakan tambahkan melalui panel admin.')) ?></p>
                            <div class="row mt-4 gy-4">
                                <div class="col-md-6 d-flex align-items-start">
                                    <i class="bi bi-calendar-check fs-2 text-white me-3"></i>
                                    <div>
                                        <p class="mb-1 text-white-50">Tahun Berdiri</p>
                                        <h5 class="fw-bold text-white"><?= esc($pengaturan['tahun_berdiri'] ?? '-') ?></h5>
                                    </div>
                                </div>
                                <div class="col-md-6 d-flex align-items-start">
                                    <i class="bi bi-geo-alt fs-2 text-white me-3"></i>
                                    <div>
                                        <p class="mb-1 text-white-50">Lokasi</p>
                                        <h5 class="fw-bold text-white"><?= esc($pengaturan['alamat'] ?? '-') ?></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 mt-5 mt-lg-0" data-aos="fade-left" data-aos-delay="100">
                            <div class="ratio ratio-16x9 rounded-3 shadow-sm overflow-hidden">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1156.6522259581693!2d119.90749964437086!3d-4.243476191178392!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2d95ee23ffffffff%3A0xef20822f37270a18!2sMasjid%20Nurul%20Falah!5e0!3m2!1sid!2sid!4v1750507286192!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                </div>
            </div>
                </div>
            </section>

            <!-- Section Fasilitas dan Layanan Kami dipindah ke bawah Tentang Masjid -->
            <section id="layanan" class="section position-relative" style="background:#fff; overflow:hidden;">
                <!-- Background image dengan opacity lebih tinggi -->
                <div style="position:absolute; inset:0; z-index:0;">
                    <img src="<?= base_url('public/section1.jpg') ?>" alt="Motif Abstrak" style="width:100%; height:100%; object-fit:cover; opacity:0.28;">
                    <div style="position:absolute; inset:0; background:rgba(255,255,255,0.90);"></div>
                </div>
                <div class="container position-relative" style="z-index:1;">
                    <h2 class="section-title text-center mb-4">Fasilitas dan Layanan Kami</h2>
                    <p class="mb-5 text-center">Kami menyediakan berbagai fasilitas dan layanan untuk mendukung kegiatan ibadah dan sosial masyarakat.</p>
                    <div class="row justify-content-center g-4">
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="feature-card text-center p-4 h-100 bg-white rounded-4 shadow-sm">
                                <div class="icon mb-3" style="font-size:2.5rem; color:#23272f;">🕌</div>
                                <h5 class="mb-2">Tempat Ibadah</h5>
                                <p class="text-secondary small mb-0">Area sholat yang luas, bersih, dan nyaman untuk pria dan wanita.</p>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="feature-card text-center p-4 h-100 bg-white rounded-4 shadow-sm">
                                <div class="icon mb-3" style="font-size:2.5rem; color:#23272f;">📚</div>
                                <h5 class="mb-2">Taman Pendidikan Al-Qur'an</h5>
                                <p class="text-secondary small mb-0">Program belajar membaca dan menghafal Al-Qur'an untuk segala usia.</p>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="feature-card text-center p-4 h-100 bg-white rounded-4 shadow-sm">
                                <div class="icon mb-3" style="font-size:2.5rem; color:#23272f;">🤝</div>
                                <h5 class="mb-2">Layanan ZIS</h5>
                                <p class="text-secondary small mb-0">Penerimaan dan penyaluran Zakat, Infaq, Shadaqah secara profesional.</p>
                            </div>
                        </div>
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                            <div class="feature-card text-center p-4 h-100 bg-white rounded-4 shadow-sm">
                                <div class="icon mb-3" style="font-size:2.5rem; color:#23272f;">📖</div>
                                <h5 class="mb-2">Perpustakaan</h5>
                                <p class="text-secondary small mb-0">Koleksi buku-buku Islam dan ruang baca nyaman untuk jamaah.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <style>
                    #layanan {
                        padding-top: 4rem;
                        padding-bottom: 4rem;
                    }
                    .feature-card {
                        transition: box-shadow 0.2s, transform 0.2s;
                    }
                    .feature-card:hover {
                        box-shadow: 0 8px 32px rgba(35,39,47,0.10);
                        transform: translateY(-4px) scale(1.03);
                    }
                    @media (max-width: 767px) {
                        #layanan { padding-top: 2.5rem; padding-bottom: 2.5rem; }
                        .feature-card { padding: 1.5rem 1rem; }
                    }
                </style>
            </section>

            <!-- Section Informasi Terkini dipindah ke sini -->
            <section id="stats" class="section position-relative" style="background:#fff; overflow:hidden;">
                <!-- Background image dengan opacity rendah -->
                <div style="position:absolute; inset:0; z-index:0;">
                    <img src="<?= base_url('public/section1.jpg') ?>" alt="Motif Abstrak" style="width:100%; height:100%; object-fit:cover; opacity:0.18;">
                    <div style="position:absolute; inset:0; background:rgba(255,255,255,0.82);"></div>
                </div>
                <div class="container position-relative" style="z-index:1;">
                    <div class="row justify-content-center mb-4">
                        <div class="col-12 col-lg-8 text-center">
                            <h2 class="section-title mb-2">Informasi Terkini</h2>
                            <p class="section-subtitle mb-0">Data dan statistik terbaru yang dikelola secara transparan oleh pengurus masjid untuk kemaslahatan umat.</p>
                        </div>
                    </div>
                    <div class="row justify-content-center g-4">
                        <div class="col-12 col-md-4">
                            <div class="stat-card-custom w-100 shadow-sm gradient-dark">
                                <div class="stat-icon mb-2 bg-white text-dark">
                                    <i class="bi bi-cash-coin"></i>
                                </div>
                                <div class="stat-value-custom countup" data-count="<?= $total_keuangan ?>">0</div>
                                <div class="stat-label-custom">Total Saldo Kas Masjid</div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="stat-card-custom w-100 shadow-sm gradient-gray">
                                <div class="stat-icon mb-2 bg-white text-dark">
                                    <i class="bi bi-box-seam"></i>
                                </div>
                                <div class="stat-value-custom countup" data-count="<?= $total_inventaris ?>">0</div>
                                <div class="stat-label-custom">Total Inventaris</div>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="stat-card-custom w-100 shadow-sm gradient-light">
                                <div class="stat-icon mb-2 bg-white text-dark">
                                    <i class="bi bi-people-fill"></i>
                                </div>
                                <div class="stat-value-custom countup" data-count="<?= $total_pengurus ?>">0</div>
                                <div class="stat-label-custom">Jumlah Pengurus Aktif</div>
                            </div>
                        </div>
                    </div>
                </div>
                <style>
                    #stats {
                        padding-top: 4rem;
                        padding-bottom: 4rem;
                    }
                    #stats .stat-card-custom {
                        border-radius: 18px;
                        min-height: 170px;
                    }
                    @media (max-width: 991px) {
                        #stats .stat-card-custom { min-height: 140px; }
                    }
                    @media (max-width: 767px) {
                        #stats .stat-card-custom { min-height: 120px; }
                    }
                </style>
            </section>

            <!-- Section Donasi dipindah ke bawah Informasi Terkini dan background hitam -->
            <section id="donasi" class="section" style="background:#181a1b; color:#fff;">
                <div class="container">
                    <div class="row align-items-center gx-5">
                        <div class="col-lg-6" data-aos="fade-right">
                            <h2 class="section-title text-start mb-3 text-white">Salurkan Infaq & Shadaqah Anda</h2>
                            <p class="text-secondary mb-4" style="color:#e9ecef!important;">Setiap kontribusi Anda sangat berarti untuk mendukung operasional, pemeliharaan, dan program-program dakwah di Masjid Nurul Falah. Mari bersama kita raih pahala jariyah.</p>
                            <?php if (!empty($pengaturan['rekening_bank'])): ?>
                                <div class="mb-4 mt-4">
                                    <h5 class="fw-bold text-white">Transfer Bank</h5>
                                    <p class="mb-1" style="color:#e9ecef;">Anda dapat menyalurkan donasi melalui rekening berikut:</p>
                                    <div class="d-flex align-items-center p-3 rounded-3 bg-light border">
                                        <i class="bi bi-bank fs-2 me-3" style="color:#23272f;"></i>
                                        <div>
                                            <span class="d-block small" style="color:#23272f;">Nomor Rekening</span>
                                            <strong class="fs-5 text-dark"><?= nl2br(esc($pengaturan['rekening_bank'])) ?></strong>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <a href="<?= base_url('donasi') ?>" class="btn btn-outline-light btn-lg mt-3 btn-donasi-zoom" style="background:transparent; color:#fff; border:2px solid #fff; font-weight:600;">Mari Berdonasi Sekarang</a>
                        </div>
                        <div class="col-lg-6 mt-5 mt-lg-0 text-center" data-aos="fade-left" data-aos-delay="100">
                            <?php if (!empty($pengaturan['qris_visible']) && !empty($pengaturan['foto_qris'])): ?>
                                <h5 class="fw-bold mb-3 text-white">Pindai QRIS</h5>
                                <img src="<?= base_url('uploads/qris/' . esc($pengaturan['foto_qris'])) ?>" alt="QRIS Donasi Masjid" class="img-fluid rounded-3 shadow" style="max-width: 350px;">
                            <?php else: ?>
                                <div class="p-5 bg-light rounded-3 border text-center">
                                    <i class="bi bi-qr-code-scan fs-1 mb-3"></i>
                                    <p class="text-secondary">Scan QRIS untuk berdonasi dengan mudah. Saat ini belum tersedia.</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Berita Section -->
            <section id="berita" class="section">
                <div class="container">
                    <h2 class="section-title">Berita Terbaru</h2>
                    <p class="section-subtitle">Ikuti perkembangan terbaru dari berbagai kegiatan, kajian, dan acara yang diselenggarakan di Masjid Nurul Falah.</p>
                    <div class="row g-4">
                        <?php if (!empty($berita)) : ?>
                            <?php foreach ($berita as $item) : ?>
                                <div class="col-6 col-md-4" data-aos="fade-up">
                                    <div class="news-card">
                                        <a href="<?= base_url('berita/show/' . $item['id']) ?>">
                                            <img src="<?= !empty($item['gambar']) ? base_url('public/uploads/berita/' . esc($item['gambar'])) : 'https://images.unsplash.com/photo-1504711434969-e33886168f5c?q=80&w=2070&auto=format&fit=crop' ?>" alt="<?= esc($item['judul']) ?>">
                                        </a>
                                        <div class="news-card-body">
                                            <div class="news-date d-flex align-items-center">
                                                <i class="bi bi-clock me-2"></i>
                                                <span><?= \CodeIgniter\I18n\Time::parse($item['created_at'])->toLocalizedString('d MMMM yyyy, HH:mm') ?></span>
                                            </div>
                                            <a href="<?= base_url('berita/show/' . $item['id']) ?>" class="news-title mt-2 d-block"><?= esc($item['judul']) ?></a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <p class="text-center">Belum ada berita yang dipublikasikan.</p>
                        <?php endif; ?>
                    </div>
                    <div class="text-center mt-5">
                         <a href="<?= base_url('berita') ?>" class="btn btn-outline-custom">Lihat Semua Berita</a>
            </div>
                </div>
            </section>

            <!-- Galeri Section -->
            <section id="galeri" class="section bg-light">
                <div class="container">
                    <h2 class="section-title">Galeri Kegiatan</h2>
                    <p class="section-subtitle">Dokumentasi visual dari berbagai momen dan acara penting yang telah kami selenggarakan.</p>
                    <div class="row g-4">
                        <?php if (!empty($galeri)): ?>
                            <?php foreach ($galeri as $item): ?>
                                <div class="col-6 col-md-4" data-aos="fade-up">
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
                        <?php else: ?>
                            <p class="text-center">Belum ada galeri yang dipublikasikan.</p>
                        <?php endif; ?>
                    </div>
                    <div class="text-center mt-5">
                        <a href="<?= base_url('galeri') ?>" class="btn btn-outline-custom">Lihat Semua Galeri</a>
                    </div>
                </div>
            </section>

            <!-- FAQ Section -->
            <section id="faq" class="section bg-light">
                <div class="container">
                    <h2 class="section-title">Pertanyaan Umum</h2>
                    <p class="section-subtitle">Jawaban atas beberapa pertanyaan yang paling sering diajukan kepada kami.</p>
                    <div class="accordion mx-auto" id="faqAccordion" style="max-width: 800px;">
                        <div class="accordion-item mb-3" data-aos="fade-up">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne">
                                    Bagaimana cara menyalurkan donasi?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Anda dapat menyalurkan donasi melalui transfer bank ke rekening resmi masjid yang tertera, atau datang langsung ke sekretariat kami. Klik tombol "Salurkan Donasi" di bawah untuk info lebih lanjut.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item mb-3" data-aos="fade-up" data-aos-delay="100">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo">
                                    Apa saja jadwal kajian rutin di masjid?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Jadwal kajian rutin kami meliputi kajian Subuh setiap hari Ahad, kajian Tafsir Al-Qur'an setiap Rabu malam, dan kajian fiqh setiap Jumat sore. Informasi detail mengenai pemateri dan tema akan diumumkan melalui media sosial dan mading masjid.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item" data-aos="fade-up" data-aos-delay="200">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree">
                                    Apakah bisa menggunakan fasilitas masjid untuk acara pribadi?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Untuk acara seperti akad nikah atau majelis taklim keluarga, fasilitas masjid dapat digunakan dengan beberapa syarat dan ketentuan. Silakan hubungi sekretariat kami untuk mendiskusikan ketersediaan dan prosedur lebih lanjut.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- CTA Section -->
            <section id="cta" class="section">
                <div class="container text-center text-white p-5" data-aos="fade-up">
                    <h2>Tingkatkan Amal Jariyah Anda</h2>
                    <p class="lead my-4">Dukung program dan kegiatan dakwah di Masjid Nurul Falah. Setiap kontribusi Anda sangat berarti untuk kemajuan umat.</p>
                    <form action="<?= base_url('home/store_masukan') ?>" method="post">
                        <?= csrf_field() ?>
                        <input type="hidden" name="jenis" value="donasi">
                        <div class="row justify-content-center">
                            <div class="col-md-4 mb-3">
                                 <input type="text" name="nama" class="form-control form-control-lg" placeholder="Nama Anda" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                 <input type="email" name="email" class="form-control form-control-lg" placeholder="Email Anda" required>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                             <div class="col-md-8 mb-3">
                                  <textarea name="pesan" class="form-control form-control-lg" rows="3" placeholder="Tuliskan niat atau pesan Anda (opsional)"></textarea>
</div>
        </div>
                        <button type="submit" class="btn btn-light btn-lg mt-3">Kirim Konfirmasi Donasi</button>
                    </form>
                     <p class="mt-4 small">Setelah mengisi, Anda akan diarahkan ke halaman informasi rekening.</p>
                </div>
            </section>

        </main>

    <!-- Footer -->
    <?= $this->include('components/footer_public') ?>
    </div>

    <!-- Bootstrap & AOS Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Initialize AOS
            AOS.init({
                duration: 800,
                once: true,
                offset: 50,
            });

            // Initialize Typed.js
            const typed = new Typed('#typed-title', {
                strings: ["<?= esc($pengaturan['nama_masjid'] ?? 'Masjid Nurul Falah') ?>"],
                typeSpeed: 70,
                backSpeed: 30,
                startDelay: 500,
                loop: false,
                showCursor: false,
            });

            // Live Clock & Date
            const wibTimeEl = document.getElementById('wib-time');
            const witaTimeEl = document.getElementById('wita-time');
            const witTimeEl = document.getElementById('wit-time');
            const gregorianDateEl = document.getElementById('gregorian-date');
            const hijriDateEl = document.getElementById('hijri-date');

            function updateClocks() {
                const now = new Date();
                if (wibTimeEl) {
                    wibTimeEl.textContent = now.toLocaleTimeString('id-ID', { timeZone: 'Asia/Jakarta', hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false }).replace(/\./g, ':');
                }
                if (witaTimeEl) {
                    witaTimeEl.textContent = now.toLocaleTimeString('id-ID', { timeZone: 'Asia/Makassar', hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false }).replace(/\./g, ':');
                }
                if (witTimeEl) {
                    witTimeEl.textContent = now.toLocaleTimeString('id-ID', { timeZone: 'Asia/Jayapura', hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false }).replace(/\./g, ':');
                }
            }

            if (wibTimeEl && witaTimeEl && witTimeEl) {
                setInterval(updateClocks, 1000);
                updateClocks(); // initial call
            }

            if (gregorianDateEl) {
                gregorianDateEl.textContent = new Date().toLocaleDateString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
            }

            if (hijriDateEl) {
                try {
                    hijriDateEl.textContent = new Intl.DateTimeFormat('id-ID-u-ca-islamic', {day: 'numeric', month: 'long', year: 'numeric'}).format(new Date());
                } catch (e) {
                    hijriDateEl.textContent = 'Gagal memuat tanggal Hijriyah';
                    console.error("Hijri date formatting failed:", e);
                }
            }

            // Imam & Muadzin Harian Loop
            const jadwal = <?= json_encode($jadwal_harian ?? []) ?>;
            let index = 0;
            let mode = 'imam';
            const el = document.getElementById('imam-muadzin-harian');
            const elTanggal = document.getElementById('imam-muadzin-harian-tanggal');
            function tampilkanPetugas(anim = true) {
                if (!el) return;
                if (jadwal.length === 0) {
                    el.innerHTML = '<span class="text-muted">Belum ada data jadwal harian.</span>';
                    elTanggal.innerHTML = '';
                    return;
                }
                const data = jadwal[index];
                // Tanggal di bawah judul
                elTanggal.innerHTML = data.tanggal ? (new Date(data.tanggal)).toLocaleDateString('id-ID', {weekday:'long', year:'numeric', month:'long', day:'numeric'}) : 'Fleksibel';
                let html = '';
                if (mode === 'imam') {
                    html = `<div class='fade text-start'>
                        <div class='petugas-label'><i class='bi bi-person-standing me-2'></i>Imam Harian</div>
                        <div class='petugas-nama'>${data.nama_imam_harian}</div>
                    </div>`;
                    mode = 'muadzin';
                } else {
                    html = `<div class='fade text-start'>
                        <div class='petugas-label'><i class='bi bi-megaphone me-2'></i>Muadzin Harian</div>
                        <div class='petugas-nama'>${data.nama_muadzin}</div>
                    </div>`;
                    mode = 'imam';
                    index = (index + 1) % jadwal.length;
                }
                el.innerHTML = html;
                setTimeout(() => {
                    const box = el.querySelector('.fade');
                    if (box) box.classList.add('show');
                }, anim ? 50 : 0);
            }
            tampilkanPetugas(false);
            setInterval(() => {
                const box = el.querySelector('.fade');
                if (box) box.classList.remove('show');
                setTimeout(() => tampilkanPetugas(true), 400);
            }, 3500);
        });
    </script>
    <style>
    #imam-muadzin-harian .fade {
        opacity: 0;
        transition: opacity 0.5s;
    }
    #imam-muadzin-harian .show {
        opacity: 1;
        transition: opacity 0.5s;
    }
    #imam-muadzin-harian .petugas-label {
        font-size: 1.1rem;
        font-weight: 600;
        letter-spacing: 0.5px;
    }
    #imam-muadzin-harian .petugas-nama {
        font-size: 1.7rem;
        font-weight: 700;
        margin-bottom: 0.25rem;
    }
    @media (max-width: 576px) {
        #imam-muadzin-harian .petugas-label {
            font-size: 0.95rem;
        }
        #imam-muadzin-harian .petugas-nama {
            font-size: 1.15rem;
        }
        #imam-muadzin-harian-tanggal {
            font-size: 0.95rem;
        }
    }
    .stat-card-custom {
        background: #f8f9fa;
        border-radius: 20px;
        padding: 2rem 1.5rem 1.5rem 1.5rem;
        transition: box-shadow 0.2s, transform 0.2s;
        position: relative;
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
    }
    .stat-card-custom:hover {
        box-shadow: 0 8px 32px rgba(0,0,0,0.10);
        transform: translateY(-4px) scale(1.02);
    }
    .gradient-dark {
        background: linear-gradient(135deg, #23272f 0%, #444950 100%);
        color: #fff;
    }
    .gradient-gray {
        background: linear-gradient(135deg, #e9ecef 0%, #f8f9fa 100%);
        color: #23272f;
    }
    .gradient-light {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        color: #23272f;
    }
    .stat-icon {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        border-radius: 50%;
        margin-bottom: 0.5rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.07);
    }
    .stat-value-custom {
        font-size: 2.2rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }
    .gradient-dark .stat-value-custom,
    .gradient-dark .stat-label-custom {
        color: #fff;
    }
    .stat-label-custom {
        font-size: 1.1rem;
        color: #6c757d;
    }
    .gradient-dark .stat-label-custom {
        color: #e9ecef;
    }
    @media (max-width: 768px) {
        .stat-card-custom {
            margin-bottom: 1.5rem;
        }
        .stat-value-custom {
            font-size: 1.5rem;
        }
        .stat-label-custom {
            font-size: 1rem;
        }
    }
    .abstrak-anim .gelombang-move {
        animation: gelombangAnim 12s linear infinite alternate;
    }
    @keyframes gelombangAnim {
        0% { transform: translateY(0); }
        100% { transform: translateY(18px); }
    }
    .abstrak-anim .circle1-move {
        animation: circle1Anim 10s ease-in-out infinite alternate;
    }
    @keyframes circle1Anim {
        0% { transform: translateX(0); }
        100% { transform: translateX(40px); }
    }
    .abstrak-anim .circle2-move {
        animation: circle2Anim 14s ease-in-out infinite alternate;
    }
    @keyframes circle2Anim {
        0% { transform: translateY(0); }
        100% { transform: translateY(30px); }
    }
    .abstrak-anim .rect-move {
        animation: rectAnim 16s ease-in-out infinite alternate;
    }
    @keyframes rectAnim {
        0% { transform: translateX(0) scale(1); }
        100% { transform: translateX(-30px) scale(1.07); }
    }
    </style>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.countup').forEach(function(el) {
            const target = parseInt(el.getAttribute('data-count'));
            let current = 0;
            const isRupiah = el.parentElement.querySelector('i.bi-cash-coin') !== null;
            const duration = 1200;
            const step = Math.ceil(target / (duration / 16));
            function update() {
                current += step;
                if (current >= target) current = target;
                el.textContent = isRupiah ? 'Rp ' + current.toLocaleString('id-ID') : current.toLocaleString('id-ID');
                if (current < target) requestAnimationFrame(update);
            }
            update();
        });
    });
    </script>
    <style>
    /* Animasi hover tombol: putih jadi hitam, hitam jadi putih, teks ikut berubah */
    .btn,
    .btn-lg,
    .btn-custom,
    .btn-outline-custom,
    .btn-outline-light,
    .btn-custom-primary,
    .btn-anim {
        transition: background 0.18s, color 0.18s, border 0.18s, transform 0.18s;
        will-change: transform, background, color, border;
    }
    /* Tombol putih (background putih, teks hitam) */
    .btn.btn-white,
    .btn-outline-light,
    .btn-outline-custom {
        background: #fff;
        color: #181a1b;
        border: 2px solid #fff;
    }
    .btn.btn-white:hover,
    .btn-outline-light:hover,
    .btn-outline-custom:hover {
        background: #181a1b !important;
        color: #fff !important;
        border-color: #181a1b !important;
        transform: scale(1.07);
    }
    /* Tombol hitam (background hitam, teks putih) */
    .btn.btn-dark,
    .btn-custom-primary {
        background: #181a1b;
        color: #fff;
        border: 2px solid #181a1b;
    }
    .btn.btn-dark:hover,
    .btn-custom-primary:hover {
        background: #fff !important;
        color: #181a1b !important;
        border-color: #fff !important;
        transform: scale(1.07);
    }
    /* Kecualikan tombol login di navbar dari animasi hover */
    .btn-login,
    .btn-login:hover {
        transition: none !important;
        transform: none !important;
        background: #fff !important;
        color: #181a1b !important;
        border: none !important;
    }
    .btn-donasi-zoom {
        transition: transform 0.18s;
        will-change: transform;
    }
    .btn-donasi-zoom:hover {
        transform: scale(1.07);
        background: transparent !important;
        color: #fff !important;
        border-color: #fff !important;
    }
    </style>
    <style>
    .hero-handwriting {
        font-family: 'Satisfy', cursive !important;
        font-size: 5.5rem;
        font-weight: 400;
        color: #fff;
        letter-spacing: 1.5px;
        font-style: italic;
        position: relative;
        display: inline-block;
        text-shadow: 0 2px 16px rgba(0,0,0,0.13);
    }
    @media (max-width: 576px) {
        .hero-handwriting { font-size: 3.5rem; }
    }
    </style>
</body>

</html>
