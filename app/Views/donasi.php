<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'Form Donasi') . ' - ' . esc($pengaturan['nama_masjid'] ?? 'Sistem Informasi Masjid') ?></title>
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
                    <h1 class="section-title">Form Donasi</h1>
                    <p class="section-subtitle">Silakan isi form berikut untuk melakukan donasi ke masjid.</p>

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
                            <form action="<?= base_url('donasi') ?>" method="post" enctype="multipart/form-data">
                                <?= csrf_field() ?>
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="nama" name="nama" value="<?= old('nama') ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="nominal" class="form-label">Nominal Donasi <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="nominal" name="nominal" min="1000" value="<?= old('nominal') ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="bukti_pembayaran" class="form-label">Bukti Pembayaran <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" id="bukti_pembayaran" name="bukti_pembayaran" accept="image/*" required>
                                    <div class="form-text">Format: JPG, JPEG, PNG, WEBP. Maksimal 2MB.</div>
                                </div>
                                <div class="mb-3">
                                    <label for="catatan" class="form-label">Catatan (Opsional)</label>
                                    <textarea class="form-control" id="catatan" name="catatan" rows="2"><?= old('catatan') ?></textarea>
                                </div>
                                <button type="submit" class="btn btn-dark w-100">Kirim Donasi</button>
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