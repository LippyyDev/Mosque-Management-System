<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('sidebar') ?>
    <?= $this->include('components/sidebar_user') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Masukan</h1>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Informasi Masukan</h6>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>Nama</th>
                    <td><?= esc($masukan['nama']) ?></td>
                </tr>
                <tr>
                    <th>Kontak</th>
                    <td><?= esc($masukan['kontak']) ?></td>
                </tr>
                <tr>
                    <th>Isi Masukan</th>
                    <td><?= esc($masukan['isi_masukan']) ?></td>
                </tr>
                <tr>
                    <th>Tanggal</th>
                    <td><?= date('d/m/Y H:i', strtotime($masukan['created_at'])) ?></td>
                </tr>
            </table>
            <a href="<?= base_url('user/masukan') ?>" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>
<?= $this->endSection() ?> 