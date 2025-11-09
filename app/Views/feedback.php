<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Kirim Masukan') . ' - ' . esc($pengaturan['nama_masjid'] ?? 'Sistem Informasi Masjid') ?></title>
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
                    <h1 class="section-title">Kirim Masukan</h1>
                    <p class="section-subtitle">Sampaikan kritik, saran, atau pesan Anda untuk kemajuan masjid.</p>

                    <?php if (session()->getFlashdata('success')): ?>
                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                        <script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: '<?= esc(session('success')) ?>',
                                showConfirmButton: false,
                                timer: 2000,
                                timerProgressBar: true
                            });
                        </script>
                    <?php endif; ?>
                    <?php if (session()->getFlashdata('errors')): ?>
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                <?php foreach(session('errors') as $err): ?>
                                    <li><?= esc($err) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <div class="card shadow-sm mx-auto" style="max-width: 500px;">
                        <div class="card-body">
                            <form action="<?= base_url('feedback') ?>" method="post">
                                <?= csrf_field() ?>
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="nama" name="nama" value="<?= old('nama') ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="kontak" class="form-label">Kontak <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="kontak" name="kontak" value="<?= old('kontak') ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="isi_masukan" class="form-label">Isi Masukan <span class="text-danger">*</span></label>
                                    <textarea class="form-control" id="isi_masukan" name="isi_masukan" rows="4" required><?= old('isi_masukan') ?></textarea>
                                </div>
                                <button type="submit" class="btn btn-dark w-100">Kirim Masukan</button>
                            </form>
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