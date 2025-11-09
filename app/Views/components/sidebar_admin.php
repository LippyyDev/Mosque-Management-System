<!-- Sidebar Admin -->
<li class="nav-item">
    <a class="nav-link <?= (current_url() == base_url('/admin/dashboard')) ? 'active' : '' ?>" href="<?= base_url('/admin/dashboard') ?>">
        <i class="fas fa-tachometer-alt fa-fw"></i>
        <span>Dashboard</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link <?= (strpos(current_url(), '/admin/users') !== false) ? 'active' : '' ?>" href="<?= base_url('/admin/users') ?>">
        <i class="fas fa-users fa-fw"></i>
        <span>Kelola Akun</span>
    </a>
</li>

