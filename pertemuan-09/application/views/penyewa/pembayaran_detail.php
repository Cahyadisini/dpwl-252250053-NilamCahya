
<?php
$e = static function ($value): string {
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
};

$detail = $detail ?? [];

$folderBukti = 'uploads/bayar/';
$namaBukti = basename((string) ($detail['ft_byr'] ?? ''));

require __DIR__ . '/../katalog/header.php';
require __DIR__ . '/../katalog/navbar.php';

$status = strtolower((string) ($detail['sttus_byr'] ?? 'pending'));
$warna = match ($status) {
    'valid' => 'success',
    'invalid' => 'danger',
    default => 'warning'
};
?>

<!-- Judul Halaman -->
<section class="bg-success py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="h2 text-white mt-3">Detail Pembayaran</h1>
                <p class="text-white">
                    Informasi pembayaran transaksi penyewaan Anda.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Detail Pembayaran -->
<section class="container py-5">
    <div class="row">
        <div class="col-lg-8 m-auto">
            <div class="card shadow-sm">
                <div class="card-body p-4 p-lg-5">

                    <h2 class="h4 text-success mb-4">
                        Informasi Pembayaran
                    </h2>

                    <table class="table table-bordered">
                        <tr>
                            <th>Kode Pembayaran</th>
                            <td><?= $e($detail['kode_bayar'] ?? '-') ?></td>
                        </tr>
                        <tr>
                            <th>Kode Sewa</th>
                            <td><?= $e($detail['kode_sewa'] ?? '-') ?></td>
                        </tr>
                        <tr>
                            <th>Jenis Pembayaran</th>
                            <td><?= $e(strtoupper($detail['jns_byr'] ?? '-')) ?></td>
                        </tr>
                        <tr>
                            <th>Metode Pembayaran</th>
                            <td><?= $e($detail['mtode_byr'] ?? '-') ?></td>
                        </tr>
                        <tr>
                            <th>Nominal</th>
                            <td>
                                Rp <?= number_format(
                                    (float) ($detail['nominal'] ?? 0),
                                    0,
                                    ',',
                                    '.'
                                ) ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Tanggal Pembayaran</th>
                            <td><?= $e($detail['tgl_wkt_byr'] ?? '-') ?></td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <span class="badge bg-<?= $warna ?>">
                                    <?= $e(ucfirst($status)) ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Tanggal Verifikasi</th>
                            <td><?= $e($detail['tgl_wkt_ver'] ?? '-') ?></td>
                        </tr>
                    </table>

                    <hr class="my-4">

                    <h3 class="h5 text-success mb-3">
                        Bukti Pembayaran
                    </h3>

                    <?php if ($namaBukti !== ''): ?>
                        <div class="mb-4">
                            <a
                                href="<?= $e(base_url($folderBukti . rawurlencode($namaBukti))) ?>"
                                target="_blank"
                                rel="noopener noreferrer">
                                <img
                                    src="<?= $e(base_url($folderBukti . rawurlencode($namaBukti))) ?>"
                                    alt="Bukti pembayaran"
                                    class="img-thumbnail"
                                    style="max-width: 350px; max-height: 300px;">
                            </a>
                        </div>
                    <?php else: ?>
                        <p class="text-muted">
                            Belum ada bukti pembayaran yang diunggah.
                        </p>
                    <?php endif; ?>

                    <?php if ($status === 'pending'): ?>
                        <form
                            action="<?= $e(site_url('pembayaran/unggah-bukti')) ?>"
                            method="post"
                            enctype="multipart/form-data">

                            <input
                                type="hidden"
                                name="kode_bayar"
                                value="<?= $e($detail['kode_bayar'] ?? '') ?>">

                            <div class="mb-3">
                                <label for="ft_byr" class="form-label">
                                    Unggah Bukti Pembayaran
                                </label>

                                <input
                                    type="file"
                                    class="form-control"
                                    id="ft_byr"
                                    name="ft_byr"
                                    accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                                    required>

                                <small class="form-text text-muted">
                                    Format JPEG, PNG, atau WEBP. Maksimal 5 MB.
                                </small>
                            </div>

                            <button type="submit" class="btn btn-success">
                                Unggah Bukti
                            </button>
                        </form>
                    <?php endif; ?>

                    <a
                        href="<?= $e(site_url('pembayaran')) ?>"
                        class="btn btn-outline-secondary mt-3">
                        Kembali ke Pembayaran
                    </a>

                </div>
            </div>
        </div>
    </div>
</section>

<?php require __DIR__ . '/../katalog/footer.php'; ?>
