<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('sidebar') ?>
    <?= $this->include('components/sidebar_user') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2 class="page-title">Tambah Berita Baru</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('user/dashboard') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('user/berita') ?>">Berita</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Tambah Baru</li>
                </ol>
            </nav>
        </div>
        <div>
            <a href="<?= base_url('user/berita') ?>" class="btn btn-light">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
        </div>
    </div>
</div>
<div class="card mt-4">
    <div class="card-header">
        <h5 class="card-title mb-0">Form Tambah Berita</h5>
    </div>
    <div class="card-body">
        <form action="<?= base_url('user/berita/store') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label for="judul" class="form-label">Judul</label>
                <input type="text" class="form-control <?= (session('errors.judul')) ? 'is-invalid' : '' ?>" id="judul" name="judul" value="<?= old('judul') ?>">
                <div class="invalid-feedback">
                    <?= session('errors.judul') ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="isi" class="form-label">Isi Berita</label>
                <textarea class="form-control <?= (session('errors.isi')) ? 'is-invalid' : '' ?>" id="isi" name="isi" rows="6"><?= old('isi') ?></textarea>
                <div class="invalid-feedback">
                    <?= session('errors.isi') ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="kategori" class="form-label">Kategori</label>
                <select class="form-select <?= (session('errors.kategori')) ? 'is-invalid' : '' ?>" id="kategori" name="kategori">
                    <option value="">Pilih Kategori</option>
                    <?php foreach ($kategori_list as $kat): ?>
                        <option value="<?= $kat ?>" <?= old('kategori') === $kat ? 'selected' : '' ?>><?= $kat ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="invalid-feedback">
                    <?= session('errors.kategori') ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="tanggal_publish" class="form-label">Tanggal Publish</label>
                <input type="datetime-local" class="form-control <?= (session('errors.tanggal_publish')) ? 'is-invalid' : '' ?>" id="tanggal_publish" name="tanggal_publish" value="<?= old('tanggal_publish') ?>">
                <div class="invalid-feedback">
                    <?= session('errors.tanggal_publish') ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="lokasi" class="form-label">Lokasi</label>
                <input type="text" class="form-control <?= (session('errors.lokasi')) ? 'is-invalid' : '' ?>" id="lokasi" name="lokasi" value="<?= old('lokasi') ?>">
                <div class="invalid-feedback">
                    <?= session('errors.lokasi') ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="video_youtube" class="form-label">Link Video Google Drive atau Youtube (opsional)</label>
                <input type="text" class="form-control <?= (session('errors.video_youtube')) ? 'is-invalid' : '' ?>" id="video_youtube" name="video_youtube" value="<?= old('video_youtube') ?>">
                <div class="invalid-feedback">
                    <?= session('errors.video_youtube') ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="gambar" class="form-label">Gambar Berita (bisa lebih dari satu)</label>
                <input type="file" class="form-control <?= (session('errors.gambar')) ? 'is-invalid' : '' ?>" id="gambar" name="gambar[]" multiple accept="image/*" onchange="previewGambarBerita(this)">
                <div class="invalid-feedback">
                    <?= session('errors.gambar') ?>
                </div>
                <div class="form-text">Format: JPG, PNG, GIF. Maksimal 2MB per gambar.</div>
                <div id="preview-gambar-berita" class="row g-2 mt-2"></div>
            </div>
            <div class="d-flex justify-content-end mt-3">
                <button type="submit" class="btn btn-dark">
                    <i class="fas fa-save me-2"></i>Simpan
                </button>
            </div>
        </form>
    </div>
</div>
<script>
let gambarFiles = [];
function previewGambarBerita(input) {
    const preview = document.getElementById('preview-gambar-berita');
    preview.innerHTML = '';
    gambarFiles = Array.from(input.files);
    gambarFiles.forEach((file, idx) => {
        const reader = new FileReader();
        reader.onload = function(e) {
            const col = document.createElement('div');
            col.className = 'col-4 col-md-3 position-relative';
            col.innerHTML = `
                <div class='border rounded bg-light p-1 position-relative'>
                    <img src='${e.target.result}' class='img-fluid rounded' style='object-fit:cover; width:100%; height:120px;'>
                    <button type='button' class='btn btn-sm btn-danger position-absolute top-0 end-0 m-1' onclick='removePreviewGambar(${idx})' title='Hapus gambar'><i class="fas fa-times"></i></button>
                </div>
            `;
            preview.appendChild(col);
        };
        reader.readAsDataURL(file);
    });
}
function removePreviewGambar(idx) {
    gambarFiles.splice(idx, 1);
    // Buat ulang FileList virtual
    const dt = new DataTransfer();
    gambarFiles.forEach(f => dt.items.add(f));
    document.getElementById('gambar').files = dt.files;
    previewGambarBerita(document.getElementById('gambar'));
}
</script>
<?= $this->endSection() ?> 