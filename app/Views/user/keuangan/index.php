<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('sidebar') ?>
<?= $this->include('components/sidebar_user') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="header">
    <div class="d-flex justify-content-between align-items-center">
    <div>
            <h2 class="page-title">Kelola Keuangan</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('user/dashboard') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Keuangan</li>
                </ol>
            </nav>
    </div>
    <div>
            <a href="<?= base_url('/user/keuangan/create') ?>" class="btn btn-dark me-2">
            <i class="fas fa-plus me-2"></i>Tambah Transaksi
        </a>
            <button type="button" class="btn btn-light" onclick="exportPdf()">
            <i class="fas fa-file-pdf me-2"></i>Export PDF
        </button>
        </div>
    </div>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('error') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<!-- Summary Cards -->
<div class="row mt-4">
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="card-title text-muted">Total Pemasukan</h6>
                        <h4 class="mb-0 fw-bold">Rp <?= number_format($total_pemasukan, 0, ',', '.') ?></h4>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-arrow-up fa-2x text-muted"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="card-title text-muted">Total Pengeluaran</h6>
                        <h4 class="mb-0 fw-bold">Rp <?= number_format($total_pengeluaran, 0, ',', '.') ?></h4>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-arrow-down fa-2x text-muted"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="card-title text-muted">Saldo</h6>
                        <h4 class="mb-0 fw-bold">Rp <?= number_format($saldo, 0, ',', '.') ?></h4>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-wallet fa-2x text-muted"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="card-title text-muted">Total Transaksi</h6>
                        <h4 class="mb-0 fw-bold"><?= count($keuangan) ?></h4>
                    </div>
                    <div class="align-self-center">
                        <i class="fas fa-list fa-2x text-muted"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Filter Section -->
<div class="card mt-4">
    <div class="card-header">
        <h5 class="card-title mb-0">Filter Transaksi</h5>
    </div>
    <div class="card-body">
        <form method="GET" action="<?= base_url('/user/keuangan') ?>" class="row g-3">
                <div class="col-md-3">
                    <label for="jenis" class="form-label">Jenis Transaksi</label>
                    <select class="form-select" id="jenis" name="jenis">
                        <option value="">Semua Jenis</option>
                        <option value="Pemasukan" <?= $filters['jenis'] === 'Pemasukan' ? 'selected' : '' ?>>Pemasukan</option>
                        <option value="Pengeluaran" <?= $filters['jenis'] === 'Pengeluaran' ? 'selected' : '' ?>>Pengeluaran</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="kategori" class="form-label">Kategori</label>
                    <select class="form-select" id="kategori" name="kategori">
                        <option value="">Semua Kategori</option>
                    <?php if (is_array($kategori_list)): ?>
                        <?php foreach ($kategori_list as $jenis => $kategoris): ?>
                            <optgroup label="<?= $jenis ?>">
                                <?php foreach ($kategoris as $kategori): ?>
                                    <option value="<?= esc($kategori) ?>" <?= $filters['kategori'] === $kategori ? 'selected' : '' ?>><?= esc($kategori) ?></option>
                                <?php endforeach; ?>
                            </optgroup>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="tanggal_dari" class="form-label">Tanggal Dari</label>
                    <input type="date" class="form-control" id="tanggal_dari" name="tanggal_dari" value="<?= $filters['tanggal_dari'] ?>">
                </div>
                <div class="col-md-2">
                    <label for="tanggal_sampai" class="form-label">Tanggal Sampai</label>
                    <input type="date" class="form-control" id="tanggal_sampai" name="tanggal_sampai" value="<?= $filters['tanggal_sampai'] ?>">
                </div>
            <div class="col-md-2 d-flex align-items-end">
                <div class="d-grid gap-2 w-100">
                    <button type="submit" class="btn btn-dark">
                            <i class="fas fa-search me-2"></i>Filter
                        </button>
                    <a href="<?= base_url('/user/keuangan') ?>" class="btn btn-light">
                            <i class="fas fa-refresh me-2"></i>Reset
                        </a>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Transactions Table -->
<div class="card mt-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Daftar Transaksi</h5>
        <span class="text-muted">Total: <?= count($keuangan) ?> Transaksi</span>
    </div>
    <div class="card-body p-0">
        <?php if (empty($keuangan)): ?>
            <div class="text-center py-5">
                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">Belum ada transaksi</h5>
                <p class="text-muted">Mulai tambahkan transaksi keuangan masjid</p>
                <a href="<?= base_url('/user/keuangan/create') ?>" class="btn btn-dark">
                    <i class="fas fa-plus me-2"></i>Tambah Transaksi Pertama
                </a>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-hover mb-0 table-responsive-stack">
                    <thead>
                        <tr>
                            <th class="ps-3">No</th>
                            <th>Tanggal</th>
                            <th>Jenis</th>
                            <th>Kategori</th>
                            <th>Nominal</th>
                            <th>Keterangan</th>
                            <th>Bukti</th>
                            <th class="text-end pe-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($keuangan as $index => $item): ?>
                            <tr>
                                <td data-label="No" class="ps-3"><?= $index + 1 ?></td>
                                <td data-label="Tanggal"><?= date('d/m/Y', strtotime($item['tanggal_transaksi'])) ?></td>
                                <td data-label="Jenis">
                                    <span class="status-badge <?= esc($item['jenis']) ?>"><?= esc($item['jenis']) ?></span>
                                </td>
                                <td data-label="Kategori"><?= esc($item['kategori']) ?></td>
                                <td data-label="Nominal" class="fw-bold">Rp <?= number_format($item['nominal'], 0, ',', '.') ?></td>
                                <td data-label="Keterangan"><?= esc($item['keterangan']) ?></td>
                                <td data-label="Bukti">
                                    <?php if (!empty($item['bukti'])): ?>
                                        <a href="<?= base_url('uploads/keuangan/' . $item['bukti']) ?>" target="_blank" class="btn btn-light btn-sm">
                                            <i class="fas fa-file-image"></i>
                                        </a>
                                    <?php else: ?>
                                        <span class="text-muted">-</span>
                                    <?php endif; ?>
                                </td>
                                <td data-label="Aksi" class="text-end pe-3 actions-cell">
                                    <a href="<?= base_url('user/keuangan/show/' . $item['id']) ?>" class="btn btn-light btn-sm"><i class="fas fa-eye"></i></a>
                                    <a href="<?= base_url('user/keuangan/edit/' . $item['id']) ?>" class="btn btn-light btn-sm"><i class="fas fa-edit"></i></a>
                                    <button class="btn btn-light btn-sm text-danger" onclick="deleteKeuangan(<?= $item['id'] ?>)"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</div>

<script>
// SweetAlert2 CDN
if (!window.Swal) {
    const script = document.createElement('script');
    script.src = 'https://cdn.jsdelivr.net/npm/sweetalert2@11';
    document.head.appendChild(script);
}

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

function exportPdf() {
    const form = document.querySelector('form[action="<?= base_url('/user/keuangan') ?>"]');
    const formData = new FormData(form);
    const params = new URLSearchParams(formData).toString();
    window.open(`<?= base_url('user/keuangan/exportPdf') ?>?${params}`, '_blank');
}

document.addEventListener('DOMContentLoaded', function() {
    const kategoriList = <?= json_encode($kategori_list) ?>;
    const jenisSelect = document.getElementById('jenis');
    const kategoriSelect = document.getElementById('kategori');
    const selectedKategori = '<?= esc($filters['kategori'] ?? '') ?>';

    function populateKategori(jenis) {
        kategoriSelect.innerHTML = '<option value="">Semua Kategori</option>';

        if (jenis && kategoriList[jenis]) {
            kategoriList[jenis].forEach(function(kategori) {
                const option = new Option(kategori, kategori);
                kategoriSelect.add(option);
            });
        } else if (!jenis || jenis === "") {
            for (const groupLabel in kategoriList) {
                const optgroup = document.createElement('optgroup');
                optgroup.label = groupLabel;
                kategoriList[groupLabel].forEach(function(kategori) {
                    const option = new Option(kategori, kategori);
                    optgroup.appendChild(option);
                });
                kategoriSelect.appendChild(optgroup);
            }
        }
        kategoriSelect.value = selectedKategori;
    }

    populateKategori(jenisSelect.value);

    jenisSelect.addEventListener('change', function() {
        populateKategori(this.value);
    });
});
</script>

<style>
.status-badge {
    padding: 0.25rem 0.5rem;
    border-radius: 0.25rem;
    font-size: 0.75rem;
    font-weight: 500;
}

.status-badge.Pemasukan {
    background-color: #343a40;
    color: white;
}

.status-badge.Pengeluaran {
    background-color: #f8f9fa;
    color: #343a40;
    border: 1px solid #dee2e6;
}
</style>

<?= $this->endSection() ?>

