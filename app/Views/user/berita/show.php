<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('sidebar') ?>
    <?= $this->include('components/sidebar_user') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2 class="page-title">Detail Berita</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('user/dashboard') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('user/berita') ?>">Berita</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail</li>
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
        <h5 class="card-title mb-0">Detail Berita: <?= esc($berita['judul']) ?></h5>
    </div>
    <div class="card-body">
        <?php if (!empty($gambar)): ?>
        <div class="mb-4">
            <label class="form-label">Galeri Gambar:</label>
            <div class="row g-2">
                <?php foreach ($gambar as $g): ?>
                    <div class="col-4 col-md-3">
                        <div class="position-relative border rounded bg-light p-1">
                            <img src="<?= base_url('public/uploads/berita/' . $g['gambar']) ?>" class="img-fluid rounded" style="object-fit:cover; width:100%; height:120px;">
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
        <table class="table table-borderless">
            <tbody>
                <tr>
                    <td style="width: 200px;"><strong>Judul</strong></td>
                    <td>: <?= esc($berita['judul']) ?></td>
                </tr>
                <tr>
                    <td><strong>Kategori</strong></td>
                    <td>: <span class="badge bg-dark text-white"><?= esc($berita['kategori']) ?></span></td>
                </tr>
                <tr>
                    <td><strong>Tanggal Publish</strong></td>
                    <td>: <?= date('d F Y, H:i', strtotime($berita['tanggal_publish'])) ?></td>
                </tr>
                <tr>
                    <td><strong>Lokasi</strong></td>
                    <td>: <?= esc($berita['lokasi']) ?></td>
                </tr>
                <tr>
                    <td><strong>Isi Berita</strong></td>
                    <td>: <div class="border rounded p-3 bg-light text-dark" style="white-space: pre-line;"> <?= esc($berita['isi']) ?> </div></td>
                </tr>
                <tr>
                    <td><strong>Video Youtube</strong></td>
                    <td>:
                        <?php if (!empty($berita['video_youtube'])): ?>
                            <div class="ratio ratio-16x9 mt-2">
                                <iframe src="https://www.youtube.com/embed/<?= htmlspecialchars(preg_replace('/.*v=([\w-]+).*/', '$1', $berita['video_youtube'])) ?>" allowfullscreen></iframe>
                            </div>
                        <?php else: ?>
                            <span class="text-muted">-</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <td><strong>Dibuat Pada</strong></td>
                    <td>: <?= date('d F Y, H:i', strtotime($berita['created_at'])) ?></td>
                </tr>
                <tr>
                    <td><strong>Diperbarui Pada</strong></td>
                    <td>: <?= date('d F Y, H:i', strtotime($berita['updated_at'])) ?></td>
                </tr>
            </tbody>
        </table>
        <div class="d-flex justify-content-end mt-4">
            <a href="<?= base_url('user/berita/edit/' . $berita['id']) ?>" class="btn btn-dark me-2">
                <i class="fas fa-edit me-2"></i>Edit
            </a>
            <button class="btn btn-danger" onclick="deleteBerita(<?= $berita['id'] ?>)">
                <i class="fas fa-trash me-2"></i>Hapus
            </button>
        </div>
    </div>
</div>
<script>
function deleteBerita(id) {
    Swal.fire({
        title: 'Anda yakin?',
        text: "Data berita ini akan dihapus permanen.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#343a40',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = `<?= base_url('user/berita/delete/') ?>${id}`;
        }
    })
}
</script>
<?= $this->endSection() ?> 