<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Dashboard' ?> - Masjid Nurul Falah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        :root {
            --bg-light: #f8f9fa;
            --bg-white: #ffffff;
            --text-dark: #212529;
            --text-muted: #6c757d;
            --border-color: #dee2e6;
            --primary: #212529;
            --primary-hover: #000000;
            --hover-bg: #e9ecef;
        }
        
        .wrapper {
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        body {
            background-color: var(--bg-light);
            color: var(--text-dark);
            font-family: "Inter", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            margin: 0;
        }
        
        .sidebar {
            background-color: var(--bg-white);
            border-right: 1px solid var(--border-color);
            width: 260px;
            flex-shrink: 0;
            overflow-y: auto;
            transition: all 0.3s ease;
        }
        
        .sidebar .nav-link {
            color: var(--text-muted);
            font-weight: 500;
            padding: 10px 25px;
            margin: 2px 0;
            border-radius: 6px;
            display: flex;
            align-items: center;
        }
        
        .sidebar .nav-link:hover {
            background-color: var(--hover-bg);
            color: var(--text-dark);
        }

        .sidebar .nav-link.active {
            background-color: var(--primary);
            color: var(--bg-white);
        }
        
        .sidebar .nav-link i.fa-fw {
            width: 20px;
            margin-right: 15px;
            text-align: center;
        }
        
        .sidebar-brand {
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--text-dark);
            padding: 1.5rem 1.5rem;
        }
        
        .top-navbar {
            background-color: var(--bg-white);
            border-bottom: 1px solid var(--border-color);
            padding: 0.75rem 1.5rem;
        }
        
        .main-container {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }
        
        .main-content {
            padding: 2rem;
            flex-grow: 1;
            overflow-y: auto;
        }
        
        .card {
            border: 1px solid var(--border-color);
            border-radius: 0.5rem;
            box-shadow: none;
        }
        
        .card-header {
            background-color: var(--bg-white);
            border-bottom: 1px solid var(--border-color);
            font-weight: 600;
            padding: 1rem 1.25rem;
        }

        .card-body {
            padding: 1.25rem;
        }
        
        .table {
            border-color: var(--border-color);
        }
        
        .table thead th {
            background-color: var(--bg-light);
            border-bottom-width: 1px;
            font-weight: 600;
        }
        
        .btn {
            border-radius: 6px;
            font-weight: 500;
        }

        .btn-dark {
            background-color: var(--primary);
            border-color: var(--primary);
            color: var(--bg-white);
        }
        .btn-dark:hover {
            background-color: var(--primary-hover);
            border-color: var(--primary-hover);
        }
        .btn-light {
            background-color: var(--bg-white);
            border-color: var(--border-color);
            color: var(--text-dark);
        }
        .btn-light:hover {
            background-color: var(--hover-bg);
        }
        
        .user-avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            object-fit: cover;
        }

        .page-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0;
        }

        .breadcrumb {
            background-color: transparent;
            padding: 0;
            font-size: 0.875rem;
        }
        
        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                left: -260px;
                top: 0;
                bottom: 0;
                z-index: 1030;
            }
            .sidebar.show {
                left: 0;
            }
            .main-content {
                padding: 1rem;
            }

            .table-responsive-stack {
                display: block;
                width: 100%;
            }
            .table-responsive-stack thead {
                display: none;
            }
            .table-responsive-stack tbody,
            .table-responsive-stack tr {
                display: block;
                width: 100%;
            }
            .table-responsive-stack tr {
                margin-bottom: 1rem;
                border: 1px solid var(--border-color);
                border-radius: .5rem;
                overflow: hidden;
                box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            }
            .table-responsive-stack td {
                display: block;
                width: 100%;
                text-align: right !important;
                padding: 0.75rem 1rem;
                border: none;
                border-bottom: 1px solid var(--border-color);
                min-height: 48px;
            }
            .table-responsive-stack tr td:last-child {
                border-bottom: none;
            }
            .table-responsive-stack td::before {
                content: attr(data-label);
                float: left;
                font-weight: 600;
                text-align: left;
                padding-right: 1rem;
                color: var(--text-dark);
            }
            .table-responsive-stack .actions-cell {
                text-align: right;
            }
            .table-responsive-stack .actions-cell .btn,
            .table-responsive-stack .actions-cell form {
                display: inline-block;
                margin-left: 5px;
            }
        }

        .status-badge {
            display: inline-block;
            padding: 0.4em 0.65em;
            font-size: .8em;
            font-weight: 700;
            line-height: 1;
            color: var(--text-dark);
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: 9999px;
            background-color: var(--hover-bg);
            border: 1px solid var(--border-color);
        }
        .status-badge.Baik {
            border-color: #28a745;
        }
        .status-badge.Rusak {
            border-color: #dc3545;
        }
        .status-badge.Diperbaiki {
            border-color: #ffc107;
        }
        .status-badge.Pemasukan {
            border-color: #28a745;
        }
        .status-badge.Pengeluaran {
            border-color: #dc3545;
        }

        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            z-index: 1029;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <nav class="sidebar" id="sidebar">
            <div class="position-sticky">
                 <div class="sidebar-brand">
                    <i class="fas fa-mosque me-2"></i>
                    <span>MasjidNurul Falah</span>
                </div>
                <ul class="nav flex-column px-3">
                    <?= $this->renderSection('sidebar') ?>
                </ul>
            </div>
        </nav>

        <div class="main-container">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg top-navbar">
                <div class="container-fluid">
                    <button class="btn btn-light d-md-none me-2" type="button" onclick="toggleSidebar()">
                        <i class="fas fa-bars"></i>
                    </button>
                    
                    <div class="collapse navbar-collapse"></div>
                    
                    <div class="navbar-nav ms-auto">
                        <div class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                                <?php if (!empty($user) && !empty($user['foto_profil'])): ?>
                                    <img src="<?= base_url('uploads/profiles/' . $user['foto_profil']) ?>" alt="Profile" class="user-avatar me-2">
                                <?php else: ?>
                                    <div class="user-avatar bg-dark d-flex align-items-center justify-content-center me-2 text-white">
                                        <i class="fas fa-user"></i>
                                    </div>
                                <?php endif; ?>
                                <div class="d-none d-sm-block">
                                    <div class="fw-bold"><?= !empty($user) && isset($user['nama_lengkap']) ? $user['nama_lengkap'] : 'Guest' ?></div>
                                    <small class="text-muted"><?= !empty($user) && isset($user['role']) ? $user['role'] : '' ?></small>
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <?php if (!empty($user) && $user['role'] === 'Admin'): ?>
                                    <li><a class="dropdown-item" href="<?= base_url('admin/users/edit/' . $user['id']) ?>"><i class="fas fa-user-edit fa-fw me-2 text-muted"></i>Edit Profil</a></li>
                                <?php else: ?>
                                    <li><a class="dropdown-item" href="<?= base_url('user/edit-profile') ?>"><i class="fas fa-user fa-fw me-2 text-muted"></i>Profil</a></li>
                                    <li><a class="dropdown-item" href="<?= base_url('user/pengaturan') ?>"><i class="fas fa-cog fa-fw me-2 text-muted"></i>Pengaturan</a></li>
                                <?php endif; ?>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-danger" href="<?= base_url('/auth/logout') ?>"><i class="fas fa-sign-out-alt fa-fw me-2"></i>Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Main content -->
            <main class="main-content">
                <?php if (session()->getFlashdata('success')): ?>
                    <script>
                        const Toast = Swal.mixin({ toast: true, position: 'top-end', showConfirmButton: false, timer: 3000, timerProgressBar: true });
                        Toast.fire({ icon: 'success', title: '<?= session()->getFlashdata('success') ?>' });
                    </script>
                <?php endif; ?>

                <?php if (session()->getFlashdata('error')): ?>
                     <script>
                        const Toast = Swal.mixin({ toast: true, position: 'top-end', showConfirmButton: false, timer: 3000, timerProgressBar: true });
                        Toast.fire({ icon: 'error', title: '<?= session()->getFlashdata('error') ?>' });
                    </script>
                <?php endif; ?>

                <?= $this->renderSection('content') ?>
            </main>
        </div>
    </div>

    <div class="sidebar-overlay d-none" id="sidebar-overlay" onclick="toggleSidebar()"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('show');
            document.getElementById('sidebar-overlay').classList.toggle('d-none');
        }
    </script>
    <?= $this->renderSection('scripts') ?>
</body>
</html>

