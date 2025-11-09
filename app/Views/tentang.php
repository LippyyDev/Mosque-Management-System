<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Tentang Kami') . ' - ' . esc($pengaturan['nama_masjid'] ?? 'Sistem Informasi Masjid') ?></title>
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
                    <div class="row justify-content-center">
                        <div class="col-lg-10">
                            <div class="card shadow-sm">
                                <div class="card-body p-5">
                                    <div class="fs-5" style="line-height: 1.8;">
                                        <p>
                                            Selamat datang di Masjid Nurul Falah, sebuah pusat keagamaan dan komunitas yang berlokasi di jantung Leworeng. Didirikan pada tahun <?= esc($pengaturan['tahun_berdiri'] ?? '2000') ?>, masjid kami telah menjadi tempat ibadah, pendidikan, dan kegiatan sosial bagi masyarakat Muslim di sekitarnya. Kami berkomitmen untuk menyebarkan nilai-nilai Islam yang damai, toleran, dan inklusif.
                                        </p>
                                        <p>
                                            Dengan arsitektur yang memadukan desain modern dan tradisional, Masjid Nurul Falah menyediakan lingkungan yang tenang dan nyaman untuk beribadah. Fasilitas kami meliputi ruang shalat utama yang luas untuk pria dan wanita, area wudhu yang bersih, perpustakaan dengan koleksi buku-buku Islam, serta ruang serbaguna yang dapat dimanfaatkan untuk berbagai acara keagamaan seperti kajian rutin, seminar, dan perayaan hari besar Islam.
                                        </p>
                                        <p>
                                            Di luar fungsi utamanya sebagai tempat shalat, kami juga aktif menyelenggarakan berbagai program untuk semua lapisan usia. Mulai dari Taman Pendidikan Al-Qur'an (TPA) untuk anak-anak, kelas tahsin untuk dewasa, hingga kegiatan sosial seperti santunan anak yatim dan pengumpulan donasi untuk kaum dhuafa. Kami percaya bahwa masjid adalah pusat peradaban yang perannya tidak hanya terbatas pada ritual, tetapi juga sebagai motor penggerak kemaslahatan umat.
                                        </p>
                                        <p>
                                            Kami mengundang Anda semua untuk datang, beribadah, dan menjadi bagian dari keluarga besar Masjid Nurul Falah. Mari bersama-sama kita makmurkan rumah Allah dan jalin ukhuwah Islamiyah yang lebih erat.
                                        </p>
                                    </div>
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