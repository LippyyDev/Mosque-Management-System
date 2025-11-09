<?= $this->extend('layouts/dashboard') ?>

<?= $this->section('sidebar') ?>
    <?= $this->include('components/sidebar_user') ?>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Detail Donasi</h1>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Informasi Donasi</h6>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr>
                    <th>Nama Donatur</th>
                    <td><?= esc($donasi['nama']) ?></td>
                </tr>
                <tr>
                    <th>Nominal</th>
                    <td>Rp <?= number_format(esc($donasi['nominal']), 0, ",", ".") ?></td>
                </tr>
                <tr>
                    <th>Bukti Pembayaran</th>
                    <td>
                        <?php if (!empty($donasi['bukti_pembayaran'])) : ?>
                            <a href="<?= base_url('uploads/donasi/' . esc($donasi['bukti_pembayaran'])) ?>" target="_blank">Lihat Bukti</a>
                        <?php else : ?>
                            Tidak ada
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <th>Catatan</th>
                    <td><?= esc($donasi['catatan']) ?></td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td><?= esc($donasi['status']) ?></td>
                </tr>
                <tr>
                    <th>Tanggal</th>
                    <td><?= date("d/m/Y H:i", strtotime(esc($donasi['created_at']))) ?></td>
                </tr>
            </table>
            <a href="<?= base_url('user/donasi') ?>" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>
<?= $this->endSection() ?>