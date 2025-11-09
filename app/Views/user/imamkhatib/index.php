<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('sidebar') ?>
    <?= $this->include('components/sidebar_user') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2 class="page-title">Jadwal Imam, Khatib & Muadzin</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('user/dashboard') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Jadwal Imam, Khatib & Muadzin</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<?php if (session('success')): ?>
    <div class="alert alert-success"> <?= session('success') ?> </div>
<?php endif; ?>
<?php if (session('error')): ?>
    <div class="alert alert-danger"> <?= session('error') ?> </div>
<?php endif; ?>

<!-- Tabel Imam & Khatib Kegiatan -->
<div class="card mt-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Daftar Imam & Khatib Kegiatan</h5>
        <a href="<?= base_url('user/imamkhatib/create') ?>" class="btn btn-dark">
            <i class="fas fa-plus me-2"></i>Tambah Data Kegiatan
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover mb-0 table-responsive-stack">
                <thead>
                    <tr>
                        <th class="ps-3">No</th>
                        <th>Tanggal</th>
                        <th>Petugas</th>
                        <th>Jenis Kegiatan</th>
                        <th>Keterangan</th>
                        <th class="text-end pe-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($imamkhatib)): ?>
                        <tr><td colspan="6" class="text-center">Belum ada data kegiatan.</td></tr>
                    <?php else: ?>
                        <?php $i = 1; ?>
                        <?php foreach ($imamkhatib as $item): ?>
                        <tr>
                            <td data-label="No" class="ps-3"><?= $i++ ?></td>
                            <td data-label="Tanggal"><?= date('d F Y', strtotime($item['tanggal'])) ?></td>
                            <td data-label="Petugas">
                                <div><strong>Imam:</strong> <?= esc($item['nama_imam']) ?></div>
                                <div><strong>Khatib:</strong> <?= esc($item['nama_khatib']) ?></div>
                            </td>
                            <td data-label="Jenis Kegiatan"><?= esc($item['jenis']) ?></td>
                            <td data-label="Keterangan"><?= esc($item['keterangan']) ?></td>
                            <td data-label="Aksi" class="text-end pe-3">
                                <a href="<?= base_url('user/imamkhatib/edit/' . $item['id']) ?>" class="btn btn-sm btn-light"><i class="fas fa-edit"></i></a>
                                <form action="<?= base_url('user/imamkhatib/delete/' . $item['id']) ?>" method="post" class="d-inline form-delete" data-id="<?= $item['id'] ?>">
                                    <?= csrf_field() ?>
                                    <button type="button" class="btn btn-sm btn-light text-danger btn-delete"><i class="fas fa-trash-alt"></i></button>
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

<!-- Tabel Imam & Muadzin Harian -->
<div class="card mt-5">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Daftar Imam & Muadzin Harian</h5>
        <a href="<?= base_url('user/imamkhatib/harian/create') ?>" class="btn btn-dark">
            <i class="fas fa-plus me-2"></i>Tambah Data Harian
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover mb-0 table-responsive-stack">
                <thead>
                    <tr>
                        <th class="ps-3">No</th>
                        <th>Tanggal</th>
                        <th>Imam Harian</th>
                        <th>Muadzin</th>
                        <th>Keterangan</th>
                        <th class="text-end pe-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($imam_muadzin_harian)): ?>
                        <tr><td colspan="6" class="text-center">Belum ada data harian.</td></tr>
                    <?php else: ?>
                        <?php $i = 1; ?>
                        <?php foreach ($imam_muadzin_harian as $item): ?>
                        <tr>
                            <td data-label="No" class="ps-3"><?= $i++ ?></td>
                            <td data-label="Tanggal">
                                <?php if (!empty($item['tanggal'])): ?>
                                    <?= date('d F Y', strtotime($item['tanggal'])) ?>
                                <?php else: ?>
                                    <span class="badge bg-dark">Fleksibel</span>
                                <?php endif; ?>
                            </td>
                            <td data-label="Imam Harian"><?= esc($item['nama_imam_harian']) ?></td>
                            <td data-label="Muadzin"><?= esc($item['nama_muadzin']) ?></td>
                            <td data-label="Keterangan"><?= esc($item['keterangan']) ?></td>
                            <td data-label="Aksi" class="text-end pe-3">
                                <a href="<?= base_url('user/imamkhatib/harian/edit/' . $item['id']) ?>" class="btn btn-sm btn-light"><i class="fas fa-edit"></i></a>
                                <form action="<?= base_url('user/imamkhatib/harian/delete/' . $item['id']) ?>" method="post" class="d-inline form-delete" data-id="<?= $item['id'] ?>">
                                    <?= csrf_field() ?>
                                    <button type="button" class="btn btn-sm btn-light text-danger btn-delete"><i class="fas fa-trash-alt"></i></button>
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

<!-- Modal Konfirmasi Hapus -->
<div class="modal fade" id="modalHapus" tabindex="-1" aria-labelledby="modalHapusLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content bg-white text-dark">
      <div class="modal-header border-0">
        <h5 class="modal-title" id="modalHapusLabel">Konfirmasi Hapus Data</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Apakah Anda yakin ingin menghapus data ini?
      </div>
      <div class="modal-footer border-0">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <form id="delete-form" method="post" action="">
            <?= csrf_field() ?>
            <button type="submit" class="btn btn-danger">Hapus</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const myModal = new bootstrap.Modal(document.getElementById('modalHapus'));
    const deleteForm = document.getElementById('delete-form');
    
    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const form = this.closest('.form-delete');
            const action = form.getAttribute('action');
            deleteForm.setAttribute('action', action);
            myModal.show();
        });
    });
});
</script>
<?= $this->endSection() ?> 