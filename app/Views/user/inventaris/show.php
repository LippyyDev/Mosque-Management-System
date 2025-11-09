<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('sidebar') ?>
    <?= $this->include('components/sidebar_user') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2 class="page-title">Detail Inventaris</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('user/dashboard') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('user/inventaris') ?>">Inventaris</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Detail</li>
                </ol>
            </nav>
        </div>
        <div>
             <a href="<?= base_url('user/inventaris') ?>" class="btn btn-light">
                <i class="fas fa-arrow-left me-2"></i>Kembali
            </a>
        </div>
    </div>
</div>

<div class="card mt-4">
    <div class="card-header">
        <h5 class="card-title mb-0">Detail Barang: <?= esc($inventaris['nama_barang']) ?></h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <?php if (!empty($inventaris['foto_barang'])): ?>
                    <a href="<?= base_url('uploads/inventaris/' . $inventaris['foto_barang']) ?>" target="_blank">
                        <img src="<?= base_url('uploads/inventaris/' . $inventaris['foto_barang']) ?>" alt="<?= esc($inventaris['nama_barang']) ?>" class="img-fluid rounded" style="width: 100%; height: 300px; object-fit: cover;">
                    </a>
                <?php else: ?>
                    <img src="https://via.placeholder.com/400x300" alt="Tidak ada gambar" class="img-fluid rounded" style="width: 100%; height: 300px; object-fit: cover;">
                <?php endif; ?>
            </div>
            <div class="col-md-8">
                <table class="table table-borderless">
                    <tbody>
                        <tr>
                            <td style="width: 200px;"><strong>Nama Barang</strong></td>
                            <td>: <?= esc($inventaris['nama_barang']) ?></td>
                        </tr>
                        <tr>
                            <td><strong>Kategori</strong></td>
                            <td>: <?= esc($inventaris['kategori']) ?></td>
                        </tr>
                        <tr>
                            <td><strong>Jumlah</strong></td>
                            <td>: <?= esc($inventaris['jumlah']) ?></td>
                        </tr>
                        <tr>
                            <td><strong>Kondisi</strong></td>
                            <td>: <span class="status-badge <?= esc($inventaris['kondisi']) ?>"><?= esc($inventaris['kondisi']) ?></span></td>
                        </tr>
                        <tr>
                            <td><strong>Tanggal Pembelian</strong></td>
                            <td>: <?= date('d F Y', strtotime($inventaris['tanggal_pembelian'])) ?></td>
                        </tr>
                        <tr>
                            <td><strong>Deskripsi</strong></td>
                            <td>: <?= !empty($inventaris['deskripsi']) ? esc($inventaris['deskripsi']) : '-' ?></td>
                        </tr>
                    </tbody>
                </table>
                 <div class="d-flex justify-content-end mt-4">
                    <a href="<?= base_url('user/inventaris/edit/' . $inventaris['id']) ?>" class="btn btn-dark me-2">
                        <i class="fas fa-edit me-2"></i>Edit
                    </a>
                    <button class="btn btn-danger" onclick="deleteInventaris(<?= $inventaris['id'] ?>)">
                        <i class="fas fa-trash me-2"></i>Hapus
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function deleteInventaris(id) {
    Swal.fire({
        title: 'Anda yakin?',
        text: "Data barang inventaris ini akan dihapus permanen.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#343a40',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = `<?= base_url('user/inventaris/delete/') ?>${id}`;
        }
    })
}
</script>
<?= $this->endSection() ?> 