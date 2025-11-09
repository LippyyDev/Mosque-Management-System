<?= $this->extend('layouts/dashboard') ?>
<?= $this->section('sidebar') ?>
    <?= $this->include('components/sidebar_user') ?>
<?= $this->endSection() ?>
<?= $this->section('content') ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<div class="header">
    <h2 class="page-title">Edit Jadwal Imam & Khatib</h2>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('user/dashboard') ?>">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('user/imamkhatib') ?>">Imam & Khatib</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Data</li>
        </ol>
    </nav>
</div>

<div class="card">
    <div class="card-body">
        <form action="<?= base_url('user/imamkhatib/update/' . $item['id']) ?>" method="post">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label for="nama_imam" class="form-label">Nama Imam</label>
                <input type="text" class="form-control" id="nama_imam" name="nama_imam" value="<?= old('nama_imam', $item['nama_imam']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="nama_khatib" class="form-label">Nama Khatib</label>
                <input type="text" class="form-control" id="nama_khatib" name="nama_khatib" value="<?= old('nama_khatib', $item['nama_khatib']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="jenis" class="form-label">Jenis Kegiatan</label>
                <select class="form-select" id="jenis" name="jenis" required>
                    <option value="">-- Pilih Jenis --</option>
                    <option value="Shalat Jumat" <?= old('jenis', $item['jenis']) == 'Shalat Jumat' ? 'selected' : '' ?>>Shalat Jumat</option>
                    <option value="Tarawih" <?= old('jenis', $item['jenis']) == 'Tarawih' ? 'selected' : '' ?>>Tarawih</option>
                    <option value="Idul Fitri" <?= old('jenis', $item['jenis']) == 'Idul Fitri' ? 'selected' : '' ?>>Idul Fitri</option>
                    <option value="Idul Adha" <?= old('jenis', $item['jenis']) == 'Idul Adha' ? 'selected' : '' ?>>Idul Adha</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="text" class="form-control" id="tanggal" name="tanggal" value="<?= old('tanggal', $item['tanggal']) ?>" required placeholder="Pilih tanggal...">
            </div>
            <div class="mb-3">
                <label for="keterangan" class="form-label">Keterangan</label>
                <textarea class="form-control" id="keterangan" name="keterangan" rows="3"><?= old('keterangan', $item['keterangan']) ?></textarea>
            </div>
            <button type="submit" class="btn btn-dark">Update</button>
            <a href="<?= base_url('user/imamkhatib') ?>" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('scripts') ?>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const jenisSelect = document.getElementById('jenis');
    const tanggalInput = document.getElementById('tanggal');
    let fp; // flatpickr instance

    function initDatepicker(disableNonFridays) {
        const config = {
            dateFormat: "Y-m-d",
            defaultDate: tanggalInput.value, // Pre-select the existing date
        };
        if (disableNonFridays) {
            config.disable = [
                function(date) {
                    // return true to disable days that are not Friday (day 5)
                    return date.getDay() !== 5;
                }
            ];
        }
        
        if (fp) {
            fp.destroy();
        }
        fp = flatpickr(tanggalInput, config);
    }

    jenisSelect.addEventListener('change', (event) => {
        initDatepicker(event.target.value === 'Shalat Jumat');
    });

    // Initial check on page load
    initDatepicker(jenisSelect.value === 'Shalat Jumat');
});
</script>
<?= $this->endSection() ?> 