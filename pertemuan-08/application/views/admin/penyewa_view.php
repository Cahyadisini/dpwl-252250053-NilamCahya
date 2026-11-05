
<?php
require APPPATH . '/views/templates/header.php';
require APPPATH . '/views/templates/sidebar.php';

$penyewa = $penyewa ?? [];
$flash = $flash ?? null;
$error = $error ?? null;

$mode = $mode ?? null;
$penyewa_dipilih = $penyewa_dipilih ?? null;

$flashClass = (($flash['type'] ?? '') === 'success')
    ? 'alert-success'
    : 'alert-danger';

$isForm = in_array($mode, ['tambah', 'ubah'], true);
$isEdit = $mode === 'ubah';

$userPlgDipilih = $penyewa_dipilih['user_plg'] ?? '';

$formAction = $isEdit
    ? site_url('admin/penyewa/ubah/' . rawurlencode((string) $userPlgDipilih))
    : site_url('admin/penyewa/tambah');
?>

<div class="content-wrapper">

    <section class="content-header">
        <h1>
            Manajemen Penyewa
            <small>Kelola data penyewa</small>
        </h1>

        <ol class="breadcrumb">
            <li>
                <a href="<?= htmlspecialchars(site_url('admin'), ENT_QUOTES, 'UTF-8') ?>">
                    <i class="fa fa-dashboard"></i> Dashboard
                </a>
            </li>
            <li class="active">Manajemen Penyewa</li>
        </ol>
    </section>

    <section class="content">

        <!-- Flash message -->
        <?php if (!empty($flash)): ?>
            <div class="alert <?= $flashClass ?> alert-dismissible">
                <button type="button" class="close"
                    data-dismiss="alert" aria-hidden="true">&times;</button>

                <i class="fa <?= (($flash['type'] ?? '') === 'success')
                    ? 'fa-check'
                    : 'fa-warning' ?>"></i>

                <?= htmlspecialchars($flash['message'] ?? '', ENT_QUOTES, 'UTF-8') ?>
            </div>
        <?php endif; ?>

        <!-- Pesan error -->
        <?php if ($error !== null): ?>
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close"
                    data-dismiss="alert" aria-hidden="true">&times;</button>

                <i class="fa fa-warning"></i>
                <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
            </div>
        <?php endif; ?>


        <!-- Form Tambah/Ubah Penyewa -->
        <?php if ($isForm): ?>
            <div class="box box-primary">

                <div class="box-header with-border">
                    <h3 class="box-title">
                        <?= $isEdit ? 'Ubah Data Penyewa' : 'Tambah Penyewa' ?>
                    </h3>
                </div>

                <form method="post"
                    enctype="multipart/form-data"
                    action="<?= htmlspecialchars($formAction, ENT_QUOTES, 'UTF-8') ?>">

                    <div class="box-body">

                        <div class="form-group">
                            <label for="user_plg">Username Penyewa</label>
                            <input type="text"
                                class="form-control"
                                id="user_plg"
                                name="user_plg"
                                maxlength="50"
                                value="<?= htmlspecialchars($penyewa_dipilih['user_plg'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                                <?= $isEdit ? 'readonly' : '' ?>
                                required>
                        </div>

                        <div class="form-group">
                            <label for="sandi">Password</label>
                            <input type="password"
                                class="form-control"
                                id="sandi"
                                name="sandi"
                                minlength="8"
                                maxlength="72"
                                <?= $isEdit ? '' : 'required' ?>>

                            <p class="help-block">
                                <?= $isEdit
                                    ? 'Kosongkan jika tidak ingin mengganti password.'
                                    : 'Password minimal 8 karakter.' ?>
                            </p>
                        </div>

                        <div class="form-group">
                            <label for="nik">NIK</label>
                            <input type="text"
                                class="form-control"
                                id="nik"
                                name="nik"
                                maxlength="16"
                                minlength="16"
                                value="<?= htmlspecialchars($penyewa_dipilih['nik'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                                required>
                        </div>

                        <div class="form-group">
                            <label for="nm_lngkp">Nama Lengkap</label>
                            <input type="text"
                                class="form-control"
                                id="nm_lngkp"
                                name="nm_lngkp"
                                maxlength="100"
                                value="<?= htmlspecialchars($penyewa_dipilih['nm_lngkp'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                                required>
                        </div>

                        <div class="form-group">
                            <label for="no_hp">Nomor HP</label>
                            <input type="text"
                                class="form-control"
                                id="no_hp"
                                name="no_hp"
                                maxlength="15"
                                value="<?= htmlspecialchars($penyewa_dipilih['no_hp'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                                required>
                        </div>

                        <div class="form-group">
                            <label for="almt_lngkp">Alamat Lengkap</label>
                            <textarea class="form-control"
                                id="almt_lngkp"
                                name="almt_lngkp"
                                maxlength="300"
                                rows="3"
                                required><?= htmlspecialchars($penyewa_dipilih['almt_lngkp'] ?? '', ENT_QUOTES, 'UTF-8') ?></textarea>
                        </div>

                        <hr>
                        <h4>Dokumen Penyewa</h4>

                        <?php foreach ([
                            'ft_ktp' => 'Foto KTP',
                            'ft_sim_a' => 'Foto SIM A'
                        ] as $field => $label): ?>

                            <div class="form-group">
                                <label for="<?= htmlspecialchars($field, ENT_QUOTES, 'UTF-8') ?>">
                                    <?= htmlspecialchars($label, ENT_QUOTES, 'UTF-8') ?>
                                </label>

                                <input type="file"
                                    class="form-control"
                                    id="<?= htmlspecialchars($field, ENT_QUOTES, 'UTF-8') ?>"
                                    name="<?= htmlspecialchars($field, ENT_QUOTES, 'UTF-8') ?>"
                                    accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp">

                                <p class="help-block">
                                    JPG, JPEG, PNG, atau WEBP; maksimal 5 MB.
                                </p>

                                <?php if (!empty($penyewa_dipilih[$field])): ?>
                                    <p class="help-block">Dokumen saat ini:</p>

                                    <img
                                        src="<?= htmlspecialchars(base_url('uploads/penyewa/' . rawurlencode($penyewa_dipilih[$field])), ENT_QUOTES, 'UTF-8') ?>"
                                        alt="<?= htmlspecialchars($label, ENT_QUOTES, 'UTF-8') ?>"
                                        class="img-thumbnail"
                                        style="width: 180px; height: 120px; object-fit: cover;">

                                    <p class="help-block">
                                        Kosongkan jika tidak ingin menggantinya.
                                    </p>
                                <?php else: ?>
                                    <p class="help-block">Belum ada dokumen tersimpan.</p>
                                <?php endif; ?>
                            </div>

                        <?php endforeach; ?>

                    </div>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-save"></i> Simpan Penyewa
                        </button>

                        <a href="<?= htmlspecialchars(site_url('admin/penyewa'), ENT_QUOTES, 'UTF-8') ?>"
                            class="btn btn-default">
                            <i class="fa fa-times"></i> Batal
                        </a>
                    </div>

                </form>
            </div>
        <?php endif; ?>


        <!-- Tabel Data Penyewa -->
        <div class="box">

            <div class="box-header">
                <h3 class="box-title">Data Penyewa</h3>

                <div class="box-tools">
                    <a href="<?= htmlspecialchars(site_url('admin/penyewa/tambah'), ENT_QUOTES, 'UTF-8') ?>"
                        class="btn btn-primary btn-sm">
                        <i class="fa fa-plus"></i> Tambah Penyewa
                    </a>
                </div>
            </div>

            <div class="box-body">
                <div class="table-responsive">

                    <table class="table table-bordered table-striped js-data-table">

                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Username</th>
                                <th>NIK</th>
                                <th>Nama Lengkap</th>
                                <th>Nomor HP</th>
                                <th>Alamat</th>
                                <th>Foto KTP</th>
                                <th>Foto SIM A</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($penyewa as $no => $item): ?>
                                <tr>
                                    <td><?= (int) $no + 1 ?></td>

                                    <td><?= htmlspecialchars($item['user_plg'], ENT_QUOTES, 'UTF-8') ?></td>

                                    <td><?= htmlspecialchars($item['nik'], ENT_QUOTES, 'UTF-8') ?></td>

                                    <td><?= htmlspecialchars($item['nm_lngkp'], ENT_QUOTES, 'UTF-8') ?></td>

                                    <td><?= htmlspecialchars($item['no_hp'], ENT_QUOTES, 'UTF-8') ?></td>

                                    <td><?= htmlspecialchars($item['almt_lngkp'], ENT_QUOTES, 'UTF-8') ?></td>

                                    <td>
                                        <?php if (!empty($item['ft_ktp'])): ?>
                                            <img
                                                src="<?= htmlspecialchars(base_url('uploads/penyewa/' . rawurlencode($item['ft_ktp'])), ENT_QUOTES, 'UTF-8') ?>"
                                                alt="Foto KTP"
                                                style="width: 80px; height: 55px; object-fit: cover;">
                                        <?php else: ?>
                                            <span class="text-muted">Belum ada foto</span>
                                        <?php endif; ?>
                                    </td>

                                    <td>
                                        <?php if (!empty($item['ft_sim_a'])): ?>
                                            <img
                                                src="<?= htmlspecialchars(base_url('uploads/penyewa/' . rawurlencode($item['ft_sim_a'])), ENT_QUOTES, 'UTF-8') ?>"
                                                alt="Foto SIM A"
                                                style="width: 80px; height: 55px; object-fit: cover;">
                                        <?php else: ?>
                                            <span class="text-muted">Belum ada foto</span>
                                        <?php endif; ?>
                                    </td>

                                    <td>
                                        <a class="btn btn-warning btn-xs"
                                            href="<?= htmlspecialchars(site_url('admin/penyewa/ubah/' . rawurlencode((string) $item['user_plg'])), ENT_QUOTES, 'UTF-8') ?>">
                                            <i class="fa fa-edit"></i> Ubah
                                        </a>

                                        <form method="post"
                                            style="display:inline"
                                            action="<?= htmlspecialchars(site_url('admin/penyewa/hapus/' . rawurlencode((string) $item['user_plg'])), ENT_QUOTES, 'UTF-8') ?>"
                                            onsubmit="return confirm('Hapus data penyewa <?= htmlspecialchars($item['user_plg'], ENT_QUOTES, 'UTF-8') ?>?');">

                                            <button type="submit" class="btn btn-danger btn-xs">
                                                <i class="fa fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                            <?php if (empty($penyewa)): ?>
                                <tr>
                                    <td colspan="9" class="text-center">
                                        Belum ada data penyewa.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>

    </section>
</div>

<?php
require APPPATH . '/views/templates/footer.php';
?>
