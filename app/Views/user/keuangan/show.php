<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('sidebar') ?>
    <?= $this->include('components/sidebar_user') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2 class="page-title">Detail Transaksi</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('user/dashboard') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('user/keuangan') ?>">Keuangan</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail</li>
                </ol>
            </nav>
        </div>
        <div>
             <a href="<?= base_url('user/keuangan') ?>" class="btn btn-light">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
        </div>
    </div>
</div>

<div class="card mt-4">
    <div class="card-header">
        <h5 class="card-title mb-0">Detail Transaksi: <?= esc($keuanganData['jenis']) ?> - <?= esc($keuanganData['kategori']) ?></h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-8">
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <td style="width: 200px;"><strong>Tanggal Transaksi</strong></td>
                            <td>: <?= date('d F Y', strtotime($keuanganData['tanggal_transaksi'])) ?></td>
                        </tr>
                        <tr>
                            <td><strong>Jenis Transaksi</strong></td>
                            <td>: <span class="badge bg-<?= $keuanganData['jenis'] === 'Pemasukan' ? 'dark' : 'light' ?> text-<?= $keuanganData['jenis'] === 'Pemasukan' ? 'white' : 'dark' ?>"><?= esc($keuanganData['jenis']) ?></span></td>
                        </tr>
                        <tr>
                            <td><strong>Kategori</strong></td>
                            <td>: <?= esc($keuanganData['kategori']) ?></td>
                        </tr>
                        <tr>
                            <td><strong>Nominal</strong></td>
                            <td>: <span class="fw-bold">Rp <?= number_format($keuanganData['nominal'], 0, ',', '.') ?></span></td>
                        </tr>
                        <tr>
                            <td><strong>Keterangan</strong></td>
                            <td>: <?= !empty($keuanganData['keterangan']) ? esc($keuanganData['keterangan']) : '-' ?></td>
                        </tr>
                        <tr>
                            <td><strong>Dibuat Pada</strong></td>
                            <td>: <?= date('d F Y, H:i', strtotime($keuanganData['created_at'])) ?></td>
                        </tr>
                        <tr>
                            <td><strong>Diperbarui Pada</strong></td>
                            <td>: <?= date('d F Y, H:i', strtotime($keuanganData['updated_at'])) ?></td>
                        </tr>
                    </tbody>
                </table>
                 <div class="d-flex justify-content-end mt-4">
                    <a href="<?= base_url('user/keuangan/edit/' . $keuanganData['id']) ?>" class="btn btn-dark me-2">
                        <i class="fas fa-edit me-2"></i>Edit
                    </a>
                    <button class="btn btn-danger" onclick="deleteKeuangan(<?= $keuanganData['id'] ?>)">
                        <i class="fas fa-trash me-2"></i>Hapus
                    </button>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mb-3">
                    <label class="form-label"><strong>Bukti Transaksi</strong></label>
                    <?php if (!empty($keuanganData['bukti_transaksi'])): ?>
                        <a href="<?= base_url('uploads/keuangan/' . $keuanganData['bukti_transaksi']) ?>" target="_blank">
                            <img src="<?= base_url('uploads/keuangan/' . $keuanganData['bukti_transaksi']) ?>" alt="Bukti Transaksi" class="img-fluid rounded" style="width: 100%; height: 300px; object-fit: cover;">
                        </a>
                    <?php else: ?>
                        <div class="text-center py-5 bg-light rounded">
                            <i class="fas fa-image fa-3x text-muted mb-3"></i>
                            <p class="text-muted">Tidak ada bukti transaksi</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function deleteKeuangan(id) {
    Swal.fire({
        title: 'Anda yakin?',
        text: "Data transaksi ini akan dihapus permanen.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#343a40',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = `<?= base_url('user/keuangan/delete/') ?>${id}`;
        }
    })
}
</script>

<?= $this->endSection() ?> 