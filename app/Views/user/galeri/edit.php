<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('sidebar') ?>
    <?= $this->include('components/sidebar_user') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2 class="page-title">Edit Galeri</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('user/dashboard') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('user/galeri') ?>">Galeri</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </nav>
        </div>
        <div>
            <a href="<?= base_url('user/galeri') ?>" class="btn btn-light">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
        </div>
    </div>
</div>
<div class="card mt-4">
    <div class="card-header">
        <h5 class="card-title mb-0">Form Edit Galeri</h5>
    </div>
    <div class="card-body">
        <form action="<?= base_url('user/galeri/update/' . $item['id']) ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label for="judul" class="form-label">Judul</label>
                <input type="text" class="form-control <?= (session('errors.judul')) ? 'is-invalid' : '' ?>" id="judul" name="judul" value="<?= old('judul', $item['judul']) ?>">
                <div class="invalid-feedback">
                    <?= session('errors.judul') ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" class="form-control <?= (session('errors.tanggal')) ? 'is-invalid' : '' ?>" id="tanggal" name="tanggal" value="<?= old('tanggal', $item['tanggal']) ?>">
                <div class="invalid-feedback">
                    <?= session('errors.tanggal') ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="video_youtube" class="form-label">Link Video Google Drive atau Youtube (opsional)</label>
                <input type="text" class="form-control <?= (session('errors.video_youtube')) ? 'is-invalid' : '' ?>" id="video_youtube" name="video_youtube" value="<?= old('video_youtube', $item['video_youtube']) ?>">
                <div class="invalid-feedback">
                    <?= session('errors.video_youtube') ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="gambar" class="form-label">Tambah Gambar Baru (bisa lebih dari satu)</label>
                <input type="file" class="form-control <?= (session('errors.gambar')) ? 'is-invalid' : '' ?>" id="gambar" name="gambar[]" multiple accept="image/*" onchange="previewGaleriGambar(this)">
                <div class="invalid-feedback">
                    <?= session('errors.gambar') ?>
                </div>
                <div class="form-text">Format: JPG, PNG, GIF. Maksimal 2MB per gambar.</div>
                <div id="preview-galeri-gambar" class="row g-2 mt-2"></div>
            </div>
            <?php if (!empty($gambar)): ?>
            <div class="mb-3">
                <label class="form-label">Galeri Gambar Saat Ini:</label>
                <div class="row g-2">
                    <?php foreach ($gambar as $g): ?>
                        <div class="col-4 col-md-3">
                            <div class="position-relative border rounded bg-light p-1">
                                <img src="<?= base_url('public/uploads/galeri/' . $g['gambar']) ?>" class="img-fluid rounded" style="object-fit:cover; width:100%; height:120px;">
                                <a href="#" data-hapus-url="<?= base_url('user/galeri/delete-gambar/' . $g['id']) ?>" class="btn btn-sm btn-danger position-absolute top-0 end-0 m-1 btn-hapus-gambar" title="Hapus gambar">
                                    <i class="fas fa-times"></i>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
            <div class="d-flex justify-content-end mt-3">
                <button type="submit" class="btn btn-dark">
                    <i class="fas fa-save me-2"></i>Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
<!-- Modal Konfirmasi Hapus Gambar -->
<div class="modal fade" id="modalHapusGambar" tabindex="-1" aria-labelledby="modalHapusGambarLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content bg-white text-dark">
      <div class="modal-header border-0">
        <h5 class="modal-title" id="modalHapusGambarLabel">Konfirmasi Hapus Gambar</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Apakah Anda yakin ingin menghapus gambar ini?
      </div>
      <div class="modal-footer border-0">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-danger" id="btnKonfirmasiHapusGambar">Hapus</button>
      </div>
    </div>
  </div>
</div>
<script>
let galeriFiles = [];
function previewGaleriGambar(input) {
    const preview = document.getElementById('preview-galeri-gambar');
    preview.innerHTML = '';
    galeriFiles = Array.from(input.files);
    galeriFiles.forEach((file, idx) => {
        const reader = new FileReader();
        reader.onload = function(e) {
            const col = document.createElement('div');
            col.className = 'col-4 col-md-3 position-relative';
            col.innerHTML = `
                <div class='border rounded bg-light p-1 position-relative'>
                    <img src='${e.target.result}' class='img-fluid rounded' style='object-fit:cover; width:100%; height:120px;'>
                    <button type='button' class='btn btn-sm btn-danger position-absolute top-0 end-0 m-1' onclick='removePreviewGaleriGambar(${idx})' title='Hapus gambar'><i class="fas fa-times"></i></button>
                </div>
            `;
            preview.appendChild(col);
        };
        reader.readAsDataURL(file);
    });
}
function removePreviewGaleriGambar(idx) {
    galeriFiles.splice(idx, 1);
    // Buat ulang FileList virtual
    const dt = new DataTransfer();
    galeriFiles.forEach(f => dt.items.add(f));
    document.getElementById('gambar').files = dt.files;
    previewGaleriGambar(document.getElementById('gambar'));
}
// Modal konfirmasi hapus gambar lama
document.addEventListener('DOMContentLoaded', function() {
    let hapusUrl = '';
    document.querySelectorAll('.btn-hapus-gambar').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            hapusUrl = this.getAttribute('data-hapus-url');
            var modal = new bootstrap.Modal(document.getElementById('modalHapusGambar'));
            modal.show();
        });
    });
    document.getElementById('btnKonfirmasiHapusGambar').addEventListener('click', function() {
        if (hapusUrl) {
            window.location.href = hapusUrl;
        }
    });
});
</script>
<?= $this->endSection() ?> 