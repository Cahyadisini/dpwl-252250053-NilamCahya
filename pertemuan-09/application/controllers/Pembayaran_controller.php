
<?php

require_once APPPATH . 'models/Pembayaran_model.php';

class Pembayaran_controller extends Controller
{
    private Pembayaran_model $pembayaranModel;

    public function __construct()
    {
        $this->pembayaranModel = new Pembayaran_model();
    }

    // Halaman daftar pembayaran milik penyewa.
    public function index(): void
    {
        $userPlg = $this->wajibLoginPenyewa();
        $this->wajibMetode('GET');

        try {
            $pembayaran = $this->pembayaranModel
                ->getPembayaranPenyewa($userPlg);

            $flash = $_SESSION['flash_pembayaran'] ?? null;
            unset($_SESSION['flash_pembayaran']);

            $this->view('penyewa/pembayaran', [
                'pembayaran' => $pembayaran,
                'flash' => $flash
            ]);
        } catch (Throwable $e) {
            error_log(
                'Tampilan pembayaran penyewa gagal: ' . $e->getMessage()
            );

            http_response_code(500);
            exit('Data pembayaran belum dapat ditampilkan.');
        }
    }

    // Halaman detail pembayaran milik penyewa.
    public function detail(string $kodeBayar): void
    {
        $userPlg = $this->wajibLoginPenyewa();
        $this->wajibMetode('GET');

        $kodeBayar = str_replace('-', '/', $kodeBayar);

        try {
            $detail = $this->pembayaranModel
                ->getPembayaranPenyewaByKode($kodeBayar, $userPlg);

            if ($detail === null) {
                http_response_code(404);
                exit('Data pembayaran tidak ditemukan.');
            }

            $this->view('penyewa/pembayaran_detail', [
                'detail' => $detail
            ]);
        } catch (Throwable $e) {
            error_log(
                'Detail pembayaran penyewa gagal: ' . $e->getMessage()
            );

            http_response_code(500);
            exit('Detail pembayaran belum dapat ditampilkan.');
        }
    }

    // Memproses upload bukti pembayaran.
    public function unggahBukti(): void
    {
        $userPlg = $this->wajibLoginPenyewa();
        $this->wajibMetode('POST');

        $kodeBayar = trim(
            (string) ($_POST['kode_bayar'] ?? '')
        );

        if ($kodeBayar === '') {
            $this->redirectDenganPesan(
                'pembayaran',
                'error',
                'Kode pembayaran wajib diisi.'
            );
        }

        $namaFileBaru = null;
        $lokasiFileBaru = null;

        try {
            $pembayaran = $this->pembayaranModel
                ->getPembayaranPenyewaByKode(
                    $kodeBayar,
                    $userPlg
                );

            if ($pembayaran === null) {
                http_response_code(404);
                exit('Pembayaran tidak ditemukan atau bukan milik akun ini.');
            }

            if ($pembayaran['sttus_byr'] !== 'pending') {
                $this->redirectDenganPesan(
                    'pembayaran',
                    'error',
                    'Bukti hanya dapat diunggah untuk pembayaran yang masih pending.'
                );
            }

            if (
                !isset($_FILES['ft_byr']) ||
                !is_array($_FILES['ft_byr'])
            ) {
                throw new RuntimeException('Bukti pembayaran wajib dipilih.');
            }

            $file = $_FILES['ft_byr'];

            if ($file['error'] !== UPLOAD_ERR_OK) {
                throw new RuntimeException(
                    'Upload bukti pembayaran gagal. Silakan pilih ulang file.'
                );
            }

            $batasUkuran = 5 * 1024 * 1024;

            if ($file['size'] <= 0 || $file['size'] > $batasUkuran) {
                throw new RuntimeException(
                    'Ukuran bukti pembayaran maksimal 5 MB.'
                );
            }

            $finfo = new finfo(FILEINFO_MIME_TYPE);
            $mime = $finfo->file($file['tmp_name']);

            $daftarTipe = [
                'image/jpeg' => 'jpg',
                'image/png' => 'png',
                'image/webp' => 'webp'
            ];

            if (!isset($daftarTipe[$mime])) {
                throw new RuntimeException(
                    'Format bukti harus JPG, PNG, atau WEBP.'
                );
            }

            $folderUpload = dirname(APPPATH)
                . DIRECTORY_SEPARATOR . 'uploads'
                . DIRECTORY_SEPARATOR . 'bayar';

            if (
                !is_dir($folderUpload) &&
                !mkdir($folderUpload, 0755, true) &&
                !is_dir($folderUpload)
            ) {
                throw new RuntimeException(
                    'Folder penyimpanan bukti pembayaran gagal dibuat.'
                );
            }

            $namaFileBaru = bin2hex(random_bytes(16))
                . '.' . $daftarTipe[$mime];

            $lokasiFileBaru = $folderUpload
                . DIRECTORY_SEPARATOR . $namaFileBaru;

            if (!move_uploaded_file(
                $file['tmp_name'],
                $lokasiFileBaru
            )) {
                throw new RuntimeException(
                    'Bukti pembayaran gagal disimpan.'
                );
            }

            $berhasil = $this->pembayaranModel
                ->simpanBuktiPembayaran(
                    $kodeBayar,
                    $userPlg,
                    $namaFileBaru
                );

            if (!$berhasil) {
                throw new RuntimeException(
                    'Bukti pembayaran belum berhasil dicatat.'
                );
            }

            // Hapus file bukti lama setelah file baru berhasil dicatat.
            $fileLama = basename(
                (string) ($pembayaran['ft_byr'] ?? '')
            );

            if ($fileLama !== '') {
                $lokasiFileLama = $folderUpload
                    . DIRECTORY_SEPARATOR . $fileLama;

                if (
                    is_file($lokasiFileLama) &&
                    $fileLama !== $namaFileBaru
                ) {
                    unlink($lokasiFileLama);
                }
            }

            $this->redirectDenganPesan(
                'pembayaran',
                'success',
                'Bukti pembayaran berhasil diunggah.'
            );
        } catch (InvalidArgumentException | RuntimeException $e) {
            if (
                $lokasiFileBaru !== null &&
                is_file($lokasiFileBaru)
            ) {
                unlink($lokasiFileBaru);
            }

            $this->redirectDenganPesan(
                'pembayaran',
                'error',
                $e->getMessage()
            );
        } catch (Throwable $e) {
            if (
                $lokasiFileBaru !== null &&
                is_file($lokasiFileBaru)
            ) {
                unlink($lokasiFileBaru);
            }

            error_log(
                'Upload bukti pembayaran gagal: ' . $e->getMessage()
            );

            $this->redirectDenganPesan(
                'pembayaran',
                'error',
                'Bukti pembayaran belum berhasil diunggah. Silakan coba kembali.'
            );
        }
    }

    
    // Halaman daftar pembayaran yang perlu diverifikasi admin.
    public function verifikasi(): void
    {
        require_once APPPATH . 'helpers/auth_helper.php';
        require_admin_login();

        $this->wajibMetode('GET');

        try {
            $pembayaran = $this->pembayaranModel
                ->getDaftarVerifikasi();

            $flash = $_SESSION['flash_pembayaran'] ?? null;
            unset($_SESSION['flash_pembayaran']);

            $username = $_SESSION['admin_username'];

            ob_start();

            require APPPATH . 'views/templates/header.php';
            require APPPATH . 'views/templates/sidebar.php';
            require APPPATH . 'views/admin/verifikasi_pembayaran.php';
            require APPPATH . 'views/templates/footer.php';

            $html = ob_get_clean();

            echo $html;

        } catch (Throwable $e) {
            error_log(
                'Daftar verifikasi pembayaran gagal: ' . $e->getMessage()
            );

            http_response_code(500);
            exit('Daftar pembayaran belum dapat ditampilkan.');
        }
    }


    // Halaman detail verifikasi pembayaran admin.
    public function detailVerifikasi(string $kodeBayar): void
    {
        require_once APPPATH . 'helpers/auth_helper.php';
        require_admin_login();

        $this->wajibMetode('GET');

        $kodeBayar = str_replace('-', '/', $kodeBayar);

        try {
            $detail = $this->pembayaranModel
                ->getDetailVerifikasi($kodeBayar);

            if ($detail === null) {
                http_response_code(404);
                exit('Data pembayaran tidak ditemukan.');
            }

            $username = $_SESSION['admin_username'];

            ob_start();

            require APPPATH . 'views/templates/header.php';
            require APPPATH . 'views/templates/sidebar.php';

            require APPPATH . 'views/admin/verifikasi_pembayaran_detail.php';

            require APPPATH . 'views/templates/footer.php';

            $html = ob_get_clean();

            echo $html;
        } catch (Throwable $e) {
            error_log(
                'Detail verifikasi pembayaran gagal: ' . $e->getMessage()
            );

            http_response_code(500);
            exit('Detail pembayaran belum dapat ditampilkan.');
        }
    }

    // Memproses persetujuan atau penolakan pembayaran oleh admin.
    public function prosesVerifikasi(): void
    {
        require_once APPPATH . 'helpers/auth_helper.php';
        require_admin_login();

        $this->wajibMetode('POST');

        $kodeBayar = trim(
            (string) ($_POST['kode_bayar'] ?? '')
        );

        $keputusan = trim(
            (string) ($_POST['keputusan'] ?? '')
        );

        if ($kodeBayar === '') {
            $this->redirectDenganPesan(
                'admin/pembayaran',
                'error',
                'Kode pembayaran wajib diisi.'
            );
        }

        if (!in_array($keputusan, ['valid', 'invalid'], true)) {
            $this->redirectDenganPesan(
                'admin/pembayaran',
                'error',
                'Keputusan verifikasi tidak valid.'
            );
        }

        try {
            $berhasil = $this->pembayaranModel
                ->verifikasiPembayaran(
                    $kodeBayar,
                    $keputusan
                );

            if (!$berhasil) {
                $this->redirectDenganPesan(
                    'admin/pembayaran',
                    'error',
                    'Pembayaran belum berhasil diverifikasi.'
                );
            }

            $pesan = $keputusan === 'valid'
                ? 'Pembayaran berhasil disetujui.'
                : 'Pembayaran berhasil ditolak.';

            $this->redirectDenganPesan(
                'admin/pembayaran',
                'success',
                $pesan
            );
        } catch (Throwable $e) {
            error_log(
                'Verifikasi pembayaran gagal: ' . $e->getMessage()
            );

            $this->redirectDenganPesan(
                'admin/pembayaran',
                'error',
                'Verifikasi belum berhasil. Periksa kembali data pembayaran.'
            );
        }
    }

    private function wajibLoginPenyewa(): string
    {
        $userPlg = trim(
            (string) ($_SESSION['penyewa_user_plg'] ?? '')
        );

        if ($userPlg === '') {
            $_SESSION['flash_penyewa_nav'] =
                'Silakan login terlebih dahulu untuk mengakses pembayaran.';

            header('Location: ' . site_url('auth/login-penyewa'));
            exit;
        }

        return $userPlg;
    }

    private function wajibMetode(string $metodeDiizinkan): void
    {
        $metodeAktif = strtoupper(
            (string) ($_SERVER['REQUEST_METHOD'] ?? 'GET')
        );

        if ($metodeAktif !== $metodeDiizinkan) {
            http_response_code(405);
            header('Allow: ' . $metodeDiizinkan);
            exit('Method Not Allowed');
        }
    }

    private function redirectDenganPesan(
        string $uri,
        string $jenis,
        string $pesan
    ): never {
        $_SESSION['flash_pembayaran'] = [
            'type' => $jenis,
            'message' => $pesan
        ];

        header('Location: ' . site_url($uri));
        exit;
    }
}
