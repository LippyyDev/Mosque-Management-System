<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('sidebar') ?>
    <?= $this->include('components/sidebar_user') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2 class="page-title">Daftar Masukan</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('user/dashboard') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Masukan</li>
                </ol>
            </nav>
        </div>
    </div>
</div>
<!-- Card Filter Masukan -->
<div class="card mt-4">
    <div class="card-header">
        <h5 class="card-title mb-0">Filter Masukan</h5>
    </div>
    <div class="card-body">
        <form class="row g-2 mb-0" method="get" action="">
            <div class="col-md-4">
                <label class="form-label mb-1">Nama / Kontak</label>
                <input type="text" name="q" class="form-control" placeholder="Cari nama, kontak, atau isi masukan..." value="<?= esc($q ?? '') ?>">
            </div>
            <div class="col-md-3">
                <label class="form-label mb-1">Tanggal Masukan</label>
                <input type="date" name="tanggal" class="form-control" value="<?= esc($tanggal ?? '') ?>">
            </div>
            <div class="col-md-3 d-flex gap-2 align-items-end">
                <button type="submit" class="btn btn-dark"><i class="fas fa-search me-1"></i> Cari</button>
                <a href="<?= base_url('user/masukan') ?>" class="btn btn-outline-secondary">Reset</a>
            </div>
        </form>
    </div>
</div>
<!-- Card Tabel Masukan -->
<div class="card mt-4">
    <div class="card-header">
        <h5 class="card-title mb-0">Daftar Masukan</h5>
    </div>
    <div class="card-body">
        <?php if (session('success')): ?>
            <div class="alert alert-success"> <?= session('success') ?> </div>
        <?php endif; ?>
        <?php if (session('error')): ?>
            <div class="alert alert-danger"> <?= session('error') ?> </div>
        <?php endif; ?>
        <div class="table-responsive">
            <table class="table table-hover mb-0 table-responsive-stack">
                <thead>
                    <tr>
                        <th class="ps-3">No</th>
                        <th>Nama</th>
                        <th>Kontak</th>
                        <th>Isi Masukan</th>
                        <th>Tanggal</th>
                        <th class="text-end pe-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($masukan)): ?>
                        <tr><td colspan="6" class="text-center">Belum ada masukan.</td></tr>
                    <?php else: ?>
                        <?php $no=1; foreach ($masukan as $m): ?>
                        <tr>
                            <td data-label="No" class="ps-3"><?= $no++ ?></td>
                            <td data-label="Nama"><?= esc($m['nama']) ?></td>
                            <td data-label="Kontak"><?= esc($m['kontak']) ?></td>
                            <td data-label="Isi Masukan" class="text-start" style="white-space:pre-line; word-break:break-word;"> <?= esc($m['isi_masukan']) ?> </td>
                            <td data-label="Tanggal"><?= date('d-m-Y H:i', strtotime($m['created_at'])) ?></td>
                            <td data-label="Aksi" class="text-end pe-3 actions-cell">
                                <a href="<?= base_url('user/masukan/show/' . esc($m['id'])) ?>" class="btn btn-light btn-sm" title="Detail"><i class="fas fa-eye"></i></a>
                                <form action="<?= base_url('user/masukan/delete/' . esc($m['id'])) ?>" method="post" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data masukan ini?');">
                                    <?= csrf_field() ?>
                                    <button type="submit" class="btn btn-light btn-sm text-danger" title="Hapus"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Modal Konfirmasi Hapus Masukan -->
<div class="modal fade" id="modalHapusMasukan" tabindex="-1" aria-labelledby="modalHapusMasukanLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content bg-white text-dark">
      <div class="modal-header border-0">
        <h5 class="modal-title" id="modalHapusMasukanLabel">Konfirmasi Hapus Masukan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Apakah Anda yakin ingin menghapus masukan ini?
      </div>
      <div class="modal-footer border-0">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-danger" id="btnKonfirmasiHapusMasukan">Hapus</button>
      </div>
    </div>
  </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    let hapusUrl = '';
    document.querySelectorAll('.btn-hapus-masukan').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            hapusUrl = this.getAttribute('data-hapus-url');
            var modal = new bootstrap.Modal(document.getElementById('modalHapusMasukan'));
            modal.show();
        });
    });
    document.getElementById('btnKonfirmasiHapusMasukan').addEventListener('click', function() {
        if (hapusUrl) {
            window.location.href = hapusUrl;
        }
    });
});
</script>
<?= $this->endSection() ?> 