<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('sidebar') ?>
<?= $this->include('components/sidebar_user') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2 class="page-title">Detail Pengurus</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('user/dashboard') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('user/pengurus') ?>">Pengurus</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail</li>
                </ol>
            </nav>
        </div>
        <div>
             <a href="<?= base_url('user/pengurus') ?>" class="btn btn-light">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
        </div>
    </div>
</div>

<div class="card mt-4">
    <div class="card-header">
        <h5 class="card-title mb-0">Detail Pengurus: <?= esc($pengurus['nama']) ?></h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <?php if (!empty($pengurus['foto'])): ?>
                    <img src="<?= base_url('uploads/pengurus/' . $pengurus['foto']) ?>" alt="<?= esc($pengurus['nama']) ?>" class="img-fluid rounded" style="width: 100%; height: 300px; object-fit: cover;">
                <?php else: ?>
                    <div class="text-center py-5 bg-light rounded">
                        <i class="fas fa-user fa-3x text-muted mb-3"></i>
                        <p class="text-muted">Tidak ada foto</p>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-md-8">
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <td style="width: 200px;"><strong>Nama Lengkap</strong></td>
                            <td>: <?= esc($pengurus['nama']) ?></td>
                        </tr>
                        <tr>
                            <td><strong>Jabatan</strong></td>
                            <td>: <?= esc($pengurus['jabatan']) ?></td>
                        </tr>
                        <tr>
                            <td><strong>Ditambahkan Pada</strong></td>
                            <td>: <?= date('d F Y, H:i', strtotime($pengurus['created_at'])) ?></td>
                        </tr>
                        <tr>
                            <td><strong>Diperbarui Pada</strong></td>
                            <td>: <?= date('d F Y, H:i', strtotime($pengurus['updated_at'])) ?></td>
                        </tr>
                    </tbody>
                </table>
                 <div class="d-flex justify-content-end mt-4">
                    <a href="<?= base_url('user/pengurus/edit/' . $pengurus['id']) ?>" class="btn btn-dark me-2">
                        <i class="fas fa-edit me-2"></i>Edit
                    </a>
                    <button class="btn btn-danger" onclick="deletePengurus(<?= $pengurus['id'] ?>)">
                        <i class="fas fa-trash me-2"></i>Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function deletePengurus(id) {
    Swal.fire({
        title: 'Anda yakin?',
        text: "Data pengurus ini akan dihapus permanen.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#343a40',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = `<?= base_url('user/pengurus/delete/') ?>${id}`;
        }
    })
}
</script>
<?= $this->endSection() ?>


