<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('sidebar') ?>
<?= $this->include('components/sidebar_user') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<div class="header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h2 class="page-title">Pengaturan Masjid</h2>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?= base_url('user/dashboard') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Pengaturan</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="card mt-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Informasi Masjid</h5>
        <a href="<?= base_url('user/pengaturan/edit') ?>" class="btn btn-dark btn-sm">
            <i class="fas fa-edit me-1"></i>Edit Pengaturan
        </a>
    </div>
    <div class="card-body p-0">
        <table class="table table-hover table-striped mb-0">
            <tbody>
                <tr>
                    <th style="width: 25%;">Nama Masjid</th>
                    <td><?= esc($pengaturan['nama_masjid'] ?? '-') ?></td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td><?= esc($pengaturan['alamat'] ?? '-') ?></td>
                </tr>
                <tr>
                    <th>No. HP</th>
                    <td><?= esc($pengaturan['nomor_hp'] ?? '-') ?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?= esc($pengaturan['email'] ?? '-') ?></td>
                </tr>
                <tr>
                    <th>Rekening Bank</th>
                    <td><?= esc($pengaturan['rekening_bank'] ?? '-') ?></td>
                </tr>
                <tr>
                    <th>QRIS</th>
                    <td>
                        <?php if (!empty($pengaturan['foto_qris']) && file_exists(FCPATH . 'uploads/qris/' . $pengaturan['foto_qris'])): ?>
                            <img src="<?= base_url('uploads/qris/' . $pengaturan['foto_qris']) ?>" alt="QRIS" style="max-width:120px; max-height:120px;" class="img-fluid">
                        <?php else: ?>
                            -
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <th>Tampilkan QRIS di Beranda</th>
                    <td><?= !empty($pengaturan['qris_visible']) && $pengaturan['qris_visible'] ? 'Ya' : 'Tidak' ?></td>
                </tr>
                <tr>
                    <th>Sejarah</th>
                    <td><?= nl2br(esc($pengaturan['sejarah'] ?? '-')) ?></td>
                </tr>
                <tr>
                    <th>Visi</th>
                    <td><?= nl2br(esc($pengaturan['visi'] ?? '-')) ?></td>
                </tr>
                <tr>
                    <th>Misi</th>
                    <td><?= nl2br(esc($pengaturan['misi'] ?? '-')) ?></td>
                </tr>
                <tr>
                    <th>Tahun Berdiri</th>
                    <td><?= esc($pengaturan['tahun_berdiri'] ?? '-') ?></td>
                </tr>
                <tr>
                    <th>Update Terakhir</th>
                    <td><?= esc($pengaturan['updated_at'] ?? '-') ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?> 