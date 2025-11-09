<footer class="footer bg-dark text-white pt-5 pb-3 position-relative" style="overflow:hidden;">
    <!-- Motif SVG abstrak -->
    <svg class="position-absolute top-0 start-0 w-100 h-100" style="opacity:0.10; z-index:0; pointer-events:none;" preserveAspectRatio="none" viewBox="0 0 1920 300">
        <defs>
            <linearGradient id="footerGrad" x1="0" y1="0" x2="1" y2="1">
                <stop offset="0%" stop-color="#fff" stop-opacity="0.18"/>
                <stop offset="100%" stop-color="#fff" stop-opacity="0.05"/>
            </linearGradient>
        </defs>
        <g>
            <path d="M0,220 Q480,300 960,220 T1920,220 V300 H0 Z" fill="url(#footerGrad)"/>
        </g>
        <g>
            <circle cx="300" cy="60" r="90" fill="#fff" fill-opacity="0.07"/>
        </g>
        <g>
            <rect x="1500" y="180" width="220" height="60" rx="30" fill="#fff" fill-opacity="0.06"/>
        </g>
    </svg>
    <div class="container position-relative" style="z-index:1;">
        <div class="row gy-4 footer-desktop">
            <div class="col-lg-4">
                <h5 class="footer-brand text-white mb-2"><?= esc($pengaturan['nama_masjid'] ?? 'Masjid Nurul Falah') ?></h5>
                <p class="text-secondary text-white-50 mb-3">Masjid Nurul Falah didirikan sebagai pusat ibadah dan kegiatan keagamaan masyarakat Desa Leworeng.</p>
                <div class="social-links mt-3">
                    <a href="#" class="me-2 text-white-50" style="font-size:1.3rem;"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="me-2 text-white-50" style="font-size:1.3rem;"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="me-2 text-white-50" style="font-size:1.3rem;"><i class="bi bi-youtube"></i></a>
                </div>
            </div>
            <div class="col-lg-2 offset-lg-1">
                <h5 class="fw-bold mb-3 text-white">Tautan</h5>
                <ul class="list-unstyled footer-links">
                    <li><a href="<?= base_url('/') ?>" class="text-white-50 text-decoration-none footer-link">Beranda</a></li>
                    <li><a href="<?= base_url('sejarah') ?>" class="text-white-50 text-decoration-none footer-link">Sejarah</a></li>
                    <li><a href="<?= base_url('visimisi') ?>" class="text-white-50 text-decoration-none footer-link">Visi Misi</a></li>
                    <li><a href="<?= base_url('tentang') ?>" class="text-white-50 text-decoration-none footer-link">Tentang</a></li>
                </ul>
            </div>
            <div class="col-lg-2">
                <h5 class="fw-bold mb-3 text-white">Informasi</h5>
                <ul class="list-unstyled footer-links">
                    <li><a href="<?= base_url('keuangan') ?>" class="text-white-50 text-decoration-none footer-link">Keuangan</a></li>
                    <li><a href="<?= base_url('inventaris') ?>" class="text-white-50 text-decoration-none footer-link">Inventaris</a></li>
                    <li><a href="<?= base_url('donasi') ?>" class="text-white-50 text-decoration-none footer-link">Donasi</a></li>
                    <li><a href="<?= base_url('feedback') ?>" class="text-white-50 text-decoration-none footer-link">Feedback</a></li>
                </ul>
            </div>
            <div class="col-lg-3">
                <h5 class="fw-bold mb-3 text-white">Kontak Kami</h5>
                <ul class="list-unstyled footer-links">
                    <li class="d-flex align-items-start mb-2">
                        <i class="bi bi-geo-alt me-2 text-white-50"></i>
                        <span class="text-white-50"><?= esc($pengaturan['alamat'] ?? 'Alamat belum diatur.') ?></span>
                    </li>
                    <li class="d-flex align-items-start mb-2">
                        <i class="bi bi-telephone me-2 text-white-50"></i>
                        <span class="text-white-50"><?= esc($pengaturan['nomor_hp'] ?? 'Telepon belum diatur.') ?></span>
                    </li>
                    <li class="d-flex align-items-start">
                        <i class="bi bi-envelope me-2 text-white-50"></i>
                        <span class="text-white-50"><?= esc($pengaturan['email'] ?? 'Email belum diatur.') ?></span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="footer-desktop">
            <hr class="my-4 border-secondary">
            <div class="text-center text-secondary text-white-50">
                &copy; Copyright <strong><span><?= esc($pengaturan['nama_masjid'] ?? 'Masjid Nurul Falah') ?></span></strong>. All Rights Reserved
            </div>
        </div>
        <!-- Footer versi mobile ringkas -->
        <div class="footer-mobile d-block d-lg-none text-center py-2" style="display:none;">
            <div class="text-center text-secondary text-white-50" style="font-size:0.92rem;">
                &copy; Copyright <strong><span><?= esc($pengaturan['nama_masjid'] ?? 'Masjid Nurul Falah') ?></span></strong>. All Rights Reserved
            </div>
        </div>
    </div>
    <style>
        .footer {
            background: #181a1b !important;
        }
        .footer-link:hover, .footer a:hover, .footer .social-links a:hover {
            color: #fff !important;
            text-decoration: underline;
        }
        .footer .social-links a {
            transition: color 0.2s;
        }
        .footer svg {
            position: absolute;
            left: 0; top: 0;
            width: 100%; height: 100%;
            pointer-events: none;
        }
        @media (max-width: 576px) {
            .footer-desktop { display: none !important; }
            .footer-mobile { display: block !important; }
            .footer { padding-top: 2.2rem !important; padding-bottom: 1.2rem !important; }
            .footer .footer-brand { font-size: 1.2rem; }
            .footer-desktop hr, .footer-desktop .text-center { display: none !important; }
        }
    </style>
</footer> 