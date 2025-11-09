<nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top shadow-sm rounded-3">
    <div class="container-fluid">
        <a class="navbar-brand d-flex align-items-center" href="<?= base_url('/') ?>">
            <img src="<?= !empty($pengaturan['logo']) ? base_url('uploads/pengaturan/' . esc($pengaturan['logo'])) : base_url('public/logo.png') ?>" alt="Logo" style="height: 32px;" class="me-2">
            <span class="ms-2 fw-bold"><?= esc($pengaturan['nama_masjid'] ?? 'Masjid Nurul Falah') ?></span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('/') ?>">Beranda</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownProfil" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Profil
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownProfil">
                        <li><a class="dropdown-item" href="<?= base_url('sejarah') ?>">Sejarah</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('visimisi') ?>">Visi & Misi</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('tentang') ?>">Tentang Kami</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownInformasi" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Informasi
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownInformasi">
                        <li><a class="dropdown-item" href="<?= base_url('berita') ?>">Berita</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('imam-khatib') ?>">Jadwal Imam & Khatib</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('keuangan') ?>">Keuangan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('inventaris') ?>">Inventaris</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('donasi') ?>">Donasi</a>
                </li>
                 <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('feedback') ?>">Feedback</a>
                </li>
            </ul>
            <a href="<?= base_url('auth/login') ?>" class="btn btn-dark rounded-pill px-4">Login</a>
        </div>
    </div>
</nav> 