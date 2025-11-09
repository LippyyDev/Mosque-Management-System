<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('sidebar') ?>
    <?= $this->include('components/sidebar_user') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2 class="page-title">Detail Galeri</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('user/dashboard') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('user/galeri') ?>">Galeri</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail</li>
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
        <h5 class="card-title mb-0">Detail Galeri: <?= esc($item['judul']) ?></h5>
    </div>
    <div class="card-body">
        <table class="table table-borderless">
            <tbody>
                <tr>
                    <td style="width: 200px;"><strong>Judul</strong></td>
                    <td>: <?= esc($item['judul']) ?></td>
                </tr>
                <tr>
                    <td><strong>Tanggal</strong></td>
                    <td>: <?= date('d F Y', strtotime($item['tanggal'])) ?></td>
                </tr>
                <tr>
                    <td><strong>Foto</strong></td>
                    <td>:
                        <?php if (!empty($item['foto'])): ?>
                            <img src="<?= base_url('public/uploads/galeri/' . $item['foto']) ?>" class="img-thumbnail" style="max-width: 350px; max-height: 250px; object-fit:cover;">
                        <?php else: ?>
                            <span class="text-muted">-</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <td><strong>Video Youtube</strong></td>
                    <td>:
                        <?php if (!empty($item['video_youtube'])): ?>
                            <div class="ratio ratio-16x9 mt-2">
                                <iframe src="https://www.youtube.com/embed/<?= htmlspecialchars(preg_replace('/.*v=([\w-]+).*/', '$1', $item['video_youtube'])) ?>" allowfullscreen></iframe>
                            </div>
                        <?php else: ?>
                            <span class="text-muted">-</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <td><strong>Dibuat Pada</strong></td>
                    <td>: <?= date('d F Y, H:i', strtotime($item['created_at'])) ?></td>
                </tr>
                <tr>
                    <td><strong>Diperbarui Pada</strong></td>
                    <td>: <?= date('d F Y, H:i', strtotime($item['updated_at'])) ?></td>
                </tr>
            </tbody>
        </table>
        <div class="d-flex justify-content-end mt-4">
            <a href="<?= base_url('user/galeri/edit/' . $item['id']) ?>" class="btn btn-dark me-2">
                <i class="fas fa-edit me-2"></i>Edit
            </a>
            <button class="btn btn-danger" onclick="deleteGaleri(<?= $item['id'] ?>)">
                <i class="fas fa-trash me-2"></i>Hapus
            </button>
        </div>
    </div>
</div>
<?php if (!empty($gambar)): ?>
<div class="mb-4">
    <label class="form-label">Galeri Gambar:</label>
    <div class="row g-2">
        <?php foreach ($gambar as $g): ?>
            <div class="col-4 col-md-3">
                <div class="position-relative border rounded bg-light p-1">
                    <img src="<?= base_url('public/uploads/galeri/' . $g['gambar']) ?>" class="img-fluid rounded" style="object-fit:cover; width:100%; height:120px;">
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php endif; ?>
<script>
function deleteGaleri(id) {
    Swal.fire({
        title: 'Anda yakin?',
        text: "Data galeri ini akan dihapus permanen.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#343a40',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = `<?= base_url('user/galeri/delete/') ?>${id}`;
        }
    })
}
</script>
<?= $this->endSection() ?> 