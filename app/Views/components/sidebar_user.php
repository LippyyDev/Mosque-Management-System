<!-- Sidebar User -->
<li class="nav-item">
    <a class="nav-link <?= (current_url() == base_url('/user/dashboard')) ? 'active' : '' ?>" href="<?= base_url('/user/dashboard') ?>">
        <i class="fas fa-tachometer-alt fa-fw"></i>
        <span>Dashboard</span>
    </a>
</li>

<li class="nav-item mt-3">
    <h6 class="sidebar-heading px-3 mt-4 mb-1 text-muted text-uppercase">
        <span>Kelola Data</span>
    </h6>
</li>

<li class="nav-item">
    <a class="nav-link <?= (strpos(current_url(), '/user/keuangan') !== false) ? 'active' : '' ?>" href="<?= base_url('/user/keuangan') ?>">
        <i class="fas fa-money-bill-wave fa-fw"></i>
        <span>Keuangan</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link <?= (strpos(current_url(), '/user/donasi') !== false) ? 'active' : '' ?>" href="<?= base_url('/user/donasi') ?>">
        <i class="fas fa-hand-holding-heart fa-fw"></i>
        <span>Donasi</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link <?= (strpos(current_url(), '/user/pengurus') !== false) ? 'active' : '' ?>" href="<?= base_url('/user/pengurus') ?>">
        <i class="fas fa-users-cog fa-fw"></i>
        <span>Pengurus</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link <?= (strpos(current_url(), '/user/inventaris') !== false) ? 'active' : '' ?>" href="<?= base_url('/user/inventaris') ?>">
        <i class="fas fa-boxes fa-fw"></i>
        <span>Inventaris</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link <?= (strpos(current_url(), '/user/berita') !== false) ? 'active' : '' ?>" href="<?= base_url('/user/berita') ?>">
        <i class="fas fa-newspaper fa-fw"></i>
        <span>Berita</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link <?= (strpos(current_url(), '/user/galeri') !== false) ? 'active' : '' ?>" href="<?= base_url('/user/galeri') ?>">
        <i class="fas fa-images fa-fw"></i>
        <span>Galeri</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link <?= (strpos(current_url(), '/user/masukan') !== false) ? 'active' : '' ?>" href="<?= base_url('/user/masukan') ?>">
        <i class="fas fa-comments fa-fw"></i>
        <span>Masukan</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link <?= (strpos(current_url(), '/user/imamkhatib') !== false) ? 'active' : '' ?>" href="<?= base_url('/user/imamkhatib') ?>">
        <i class="fas fa-user-tie fa-fw"></i>
        <span>Imam & Khatib</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link <?= (strpos(current_url(), '/user/persuratan') !== false) ? 'active' : '' ?>" href="<?= base_url('/user/persuratan') ?>">
        <i class="fas fa-file-alt fa-fw"></i>
        <span>Persuratan</span>
    </a>
</li>

<li class="nav-item mt-3">
    <h6 class="sidebar-heading px-3 mt-4 mb-1 text-muted text-uppercase">
        <span>Pengaturan</span>
    </h6>
</li>

<li class="nav-item">
    <a class="nav-link <?= (strpos(current_url(), '/user/pengaturan') !== false) ? 'active' : '' ?>" href="<?= base_url('/user/pengaturan') ?>">
        <i class="fas fa-cogs fa-fw"></i>
        <span>Pengaturan</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link" href="<?= base_url('/') ?>" target="_blank">
        <i class="fas fa-external-link-alt fa-fw"></i>
        <span>Beranda Website</span>
    </a>
</li>

<li class="nav-item mt-3">
    <h6 class="sidebar-heading px-3 mt-4 mb-1 text-muted text-uppercase">
        <span>Akun</span>
    </h6>
</li>
<li class="nav-item">
    <a class="nav-link <?= (strpos(current_url(), '/user/edit-profile') !== false) ? 'active' : '' ?>" href="<?= base_url('/user/edit-profile') ?>">
        <i class="fas fa-user fa-fw"></i>
        <span>Profil</span>
    </a>
</li>

