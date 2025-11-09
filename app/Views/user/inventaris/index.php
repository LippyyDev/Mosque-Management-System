<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('sidebar') ?>
    <?= $this->include('components/sidebar_user') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2 class="page-title">Kelola Inventaris</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('user/dashboard') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Inventaris</li>
                </ol>
            </nav>
        </div>
        <div>
            <a href="<?= base_url('user/inventaris/create') ?>" class="btn btn-dark">
                <i class="fas fa-plus me-2"></i>Tambah Barang
            </a>
        </div>
    </div>
</div>

<!-- Filter Section -->
<div class="card mt-4">
    <div class="card-header">
        <h5 class="card-title mb-0">Filter Inventaris</h5>
    </div>
    <div class="card-body">
        <form action="<?= base_url('user/inventaris') ?>" method="get" class="row g-3">
            <div class="col-md-4">
                <label for="nama" class="form-label">Nama Barang</label>
                <input type="text" class="form-control" name="nama" id="nama" value="<?= esc($filters['nama']) ?>" placeholder="Cari nama barang...">
            </div>
            <div class="col-md-3">
                <label for="kategori" class="form-label">Kategori</label>
                <select name="kategori" id="kategori" class="form-select">
                    <option value="">Semua</option>
                    <?php foreach($kategoriList as $kategori): ?>
                        <option value="<?= esc($kategori) ?>" <?= ($filters['kategori'] == $kategori) ? 'selected' : '' ?>><?= esc($kategori) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-3">
                 <label for="kondisi" class="form-label">Kondisi</label>
                <select name="kondisi" id="kondisi" class="form-select">
                    <option value="">Semua</option>
                    <option value="Baik" <?= ($filters['kondisi'] == 'Baik') ? 'selected' : '' ?>>Baik</option>
                    <option value="Rusak" <?= ($filters['kondisi'] == 'Rusak') ? 'selected' : '' ?>>Rusak</option>
                    <option value="Diperbaiki" <?= ($filters['kondisi'] == 'Diperbaiki') ? 'selected' : '' ?>>Diperbaiki</option>
                </select>
            </div>
            <div class="col-md-2 d-flex align-items-end">
                 <button type="submit" class="btn btn-dark w-100">Filter</button>
            </div>
        </form>
    </div>
</div>

<!-- Table Section -->
<div class="card mt-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Daftar Barang Inventaris</h5>
        <span class="text-muted">Total: <?= $totalInventaris ?> Barang</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0 table-responsive-stack">
                <thead>
                    <tr>
                        <th class="ps-3">No</th>
                        <th>Foto</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Tgl Pembelian</th>
                        <th>Jumlah</th>
                        <th>Kondisi</th>
                        <th class="text-end pe-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($inventarisData['inventaris'])): ?>
                        <tr>
                            <td colspan="8" class="text-center py-4">Tidak ada data inventaris.</td>
                        </tr>
                    <?php else: ?>
                        <?php $no = $inventarisData['pager']->getCurrentPage() > 1 ? ($inventarisData['pager']->getPerPage() * ($inventarisData['pager']->getCurrentPage() - 1)) + 1 : 1; ?>
                        <?php foreach ($inventarisData['inventaris'] as $item): ?>
                            <tr>
                                <td data-label="No" class="ps-3"><?= $no++ ?></td>
                                <td data-label="Foto">
                                    <a href="<?= !empty($item['foto_barang']) ? base_url('uploads/inventaris/' . $item['foto_barang']) : '#' ?>" target="_blank">
                                        <img src="<?= !empty($item['foto_barang']) ? base_url('uploads/inventaris/' . $item['foto_barang']) : 'https://via.placeholder.com/60' ?>" alt="<?= esc($item['nama_barang']) ?>" class="rounded" width="60" height="60" style="object-fit: cover;">
                                    </a>
                                </td>
                                <td data-label="Nama Barang" class="fw-bold"><?= esc($item['nama_barang']) ?></td>
                                <td data-label="Kategori"><?= esc($item['kategori']) ?></td>
                                <td data-label="Tgl Pembelian"><?= date('d M Y', strtotime($item['tanggal_pembelian'])) ?></td>
                                <td data-label="Jumlah"><?= esc($item['jumlah']) ?></td>
                                <td data-label="Kondisi">
                                    <span class="status-badge <?= esc($item['kondisi']) ?>"><?= esc($item['kondisi']) ?></span>
                                </td>
                                <td data-label="Aksi" class="text-end pe-3 actions-cell">
                                    <a href="<?= base_url('user/inventaris/show/' . $item['id']) ?>" class="btn btn-light btn-sm"><i class="fas fa-eye"></i></a>
                                    <a href="<?= base_url('user/inventaris/edit/' . $item['id']) ?>" class="btn btn-light btn-sm"><i class="fas fa-edit"></i></a>
                                    <button class="btn btn-light btn-sm text-danger" onclick="deleteInventaris(<?= $item['id'] ?>)"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php if ($inventarisData['pager']->getPageCount() > 1): ?>
        <div class="card-footer">
            <?= $inventarisData['pager']->links('default', 'bootstrap_full') ?>
        </div>
    <?php endif; ?>
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