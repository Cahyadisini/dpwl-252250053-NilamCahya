
<?php
$e = static function ($value): string {
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
};

$pembayaran = $pembayaran ?? [];
$flash = $flash ?? null;

require __DIR__ . '/../katalog/header.php';
require __DIR__ . '/../katalog/navbar.php';
?>

<!-- Judul Halaman -->
<section class="bg-success py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="h2 text-white mt-3">Pembayaran</h1>
                <p class="text-white">
                    Lihat daftar pembayaran transaksi penyewaan kendaraan Anda.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Daftar Pembayaran -->
<section class="container py-5">
    <div class="row">
        <div class="col-12">

            <div class="card shadow-sm">
                <div class="card-body p-4">

                    <h2 class="h4 text-success mb-4">
                        Daftar Pembayaran
                    </h2>

                    <?php if (!empty($flash)): ?>
                        <div class="alert alert-<?= $e($flash['type'] ?? 'info') ?>" role="alert">
                            <?= $e($flash['message'] ?? '') ?>
                        </div>
                    <?php endif; ?>

                    <?php if (empty($pembayaran)): ?>
                        <div class="alert alert-info">
                            Belum ada data pembayaran.
                        </div>
                    <?php else: ?>

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped align-middle">
                                <thead class="table-success">
                                    <tr>
                                        <th>No.</th>
                                        <th>Kode Pembayaran</th>
                                        <th>Kode Sewa</th>
                                        <th>Tanggal Pembayaran</th>
                                        <th>Nominal</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php foreach ($pembayaran as $i => $item): ?>
                                        <tr>
                                            <td><?= $i + 1 ?></td>

                                            <td>
                                                <?= $e($item['kode_bayar']) ?>
                                            </td>

                                            <td>
                                                <?= $e($item['kode_sewa']) ?>
                                            </td>

                                            <td>
                                                <?= $e($item['tgl_wkt_byr'] ?? '-') ?>
                                            </td>

                                            <td>
                                                Rp <?= number_format(
                                                    (float) $item['nominal'],
                                                    0,
                                                    ',',
                                                    '.'
                                                ) ?>
                                            </td>

                                            <td>
                                                <?php
                                                $status = strtolower(
                                                    (string) $item['sttus_byr']
                                                );

                                                $warna = match ($status) {
                                                    'valid' => 'success',
                                                    'invalid' => 'danger',
                                                    default => 'warning'
                                                };
                                                ?>

                                                <span class="badge bg-<?= $warna ?>">
                                                    <?= $e(ucfirst($status)) ?>
                                                </span>
                                            </td>

                                            <td>
                                                <a
    href="<?= $e(site_url(
        'pembayaran/detail/' .
        rawurlencode(str_replace('/', '-', $item['kode_bayar']))
    )) ?>"
    class="btn btn-sm btn-success">
    Detail
</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>

                    <?php endif; ?>

                    <a
                        href="<?= $e(site_url('katalog')) ?>"
                        class="btn btn-outline-secondary mt-3">
                        Kembali ke Katalog
                    </a>

                </div>
            </div>

        </div>
    </div>
</section>

<?php require __DIR__ . '/../katalog/footer.php'; ?>
