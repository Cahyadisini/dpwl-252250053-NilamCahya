
<?php

class Pembayaran_model
{
    private mysqli $db;

    public function __construct()
    {
        global $db;
        $this->db = $db;
    }

    // Mengambil seluruh pembayaran DP milik penyewa.
    public function getPembayaranPenyewa(string $userPlg): array
    {
        $userPlg = trim($userPlg);

        $stmt = $this->db->prepare(
            "SELECT
                b.kode_bayar,
                b.tgl_wkt_byr,
                b.ft_byr,
                b.mtode_byr,
                b.jns_byr,
                b.nominal,
                b.sttus_byr,
                b.tgl_wkt_ver,
                b.kode_sewa,
                s.tgl_mulai,
                s.tgl_selesai,
                s.wkt_ambil,
                s.status_sewa
            FROM t_bayar b
            INNER JOIN t_sewa s ON s.kode_sewa = b.kode_sewa
            WHERE s.user_plg = ?
              AND b.jns_byr = 'dp'
            ORDER BY b.tgl_wkt_byr DESC"
        );

        if (!$stmt) {
            throw new RuntimeException(
                'Data pembayaran gagal disiapkan.'
            );
        }

        $stmt->bind_param('s', $userPlg);

        if (!$stmt->execute()) {
            $stmt->close();
            throw new RuntimeException(
                'Data pembayaran gagal diambil.'
            );
        }

        $hasil = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt->close();

        return $hasil;
    }

    // Mengambil detail pembayaran milik penyewa tertentu.
    public function getPembayaranPenyewaByKode(
        string $kodeBayar,
        string $userPlg
    ): ?array {
        $stmt = $this->db->prepare(
            "SELECT
                b.*,
                s.tgl_mulai,
                s.tgl_selesai,
                s.wkt_ambil,
                s.status_sewa
            FROM t_bayar b
            INNER JOIN t_sewa s ON s.kode_sewa = b.kode_sewa
            WHERE b.kode_bayar = ?
              AND s.user_plg = ?
              AND b.jns_byr = 'dp'
            LIMIT 1"
        );

        if (!$stmt) {
            throw new RuntimeException(
                'Detail pembayaran gagal disiapkan.'
            );
        }

        $stmt->bind_param('ss', $kodeBayar, $userPlg);

        if (!$stmt->execute()) {
            $stmt->close();
            throw new RuntimeException(
                'Detail pembayaran gagal diambil.'
            );
        }

        $hasil = $stmt->get_result()->fetch_assoc();
        $stmt->close();

        return $hasil ?: null;
    }

    // Menyimpan bukti pembayaran yang diunggah penyewa.
    public function simpanBuktiPembayaran(
        string $kodeBayar,
        string $userPlg,
        string $namaFile
    ): bool {
        $this->db->begin_transaction();

        try {
            $stmt = $this->db->prepare(
                "SELECT b.kode_bayar, b.sttus_byr
                FROM t_bayar b
                INNER JOIN t_sewa s ON s.kode_sewa = b.kode_sewa
                WHERE b.kode_bayar = ?
                  AND s.user_plg = ?
                  AND b.jns_byr = 'dp'
                LIMIT 1
                FOR UPDATE"
            );

            if (!$stmt) {
                throw new RuntimeException(
                    'Pemeriksaan pembayaran gagal disiapkan.'
                );
            }

            $stmt->bind_param('ss', $kodeBayar, $userPlg);

            if (!$stmt->execute()) {
                $stmt->close();
                throw new RuntimeException(
                    'Pemeriksaan pembayaran gagal dijalankan.'
                );
            }

            $pembayaran = $stmt->get_result()->fetch_assoc();
            $stmt->close();

            if ($pembayaran === null) {
                throw new RuntimeException(
                    'Pembayaran tidak ditemukan.'
                );
            }

            if ($pembayaran['sttus_byr'] !== 'pending') {
                throw new RuntimeException(
                    'Pembayaran sudah diproses dan tidak dapat diubah.'
                );
            }

            if ($namaFile === '') {
                throw new InvalidArgumentException(
                    'Nama file bukti pembayaran wajib diisi.'
                );
            }

            $stmt = $this->db->prepare(
                "UPDATE t_bayar
                SET ft_byr = ?, tgl_wkt_byr = NOW()
                WHERE kode_bayar = ?
                  AND sttus_byr = 'pending'"
            );

            if (!$stmt) {
                throw new RuntimeException(
                    'Penyimpanan bukti pembayaran gagal disiapkan.'
                );
            }

            $stmt->bind_param('ss', $namaFile, $kodeBayar);

            if (!$stmt->execute()) {
                $stmt->close();
                throw new RuntimeException(
                    'Bukti pembayaran gagal disimpan.'
                );
            }

            $berhasil = $stmt->affected_rows === 1;
            $stmt->close();

            if (!$berhasil) {
                throw new RuntimeException(
                    'Bukti pembayaran tidak berhasil diperbarui.'
                );
            }

            $this->db->commit();

            return true;

        } catch (Throwable $e) {
            $this->db->rollback();
            throw $e;
        }
    }

    // Mengambil daftar pembayaran untuk pemeriksaan admin.
    public function getDaftarVerifikasi(): array
    {
        $stmt = $this->db->prepare(
            "SELECT
                b.kode_bayar,
                b.tgl_wkt_byr,
                b.ft_byr,
                b.jns_byr,
                b.nominal,
                b.sttus_byr,
                b.kode_sewa,
                s.tgl_mulai,
                s.tgl_selesai,
                p.user_plg,
                p.nm_lngkp,
                p.no_hp
            FROM t_bayar b
            INNER JOIN t_sewa s ON s.kode_sewa = b.kode_sewa
            INNER JOIN t_penyewa p ON p.user_plg = s.user_plg
            WHERE b.sttus_byr = 'pending'
              AND b.jns_byr = 'dp'
            ORDER BY b.tgl_wkt_byr ASC"
        );

        if (!$stmt) {
            throw new RuntimeException(
                'Daftar verifikasi gagal disiapkan.'
            );
        }

        if (!$stmt->execute()) {
            $stmt->close();
            throw new RuntimeException(
                'Daftar verifikasi gagal diambil.'
            );
        }

        $hasil = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        $stmt->close();

        return $hasil;
    }

    // Mengambil detail pembayaran untuk admin.
    public function getDetailVerifikasi(string $kodeBayar): ?array
    {
        $stmt = $this->db->prepare(
            "SELECT
                b.*,
                s.tgl_mulai,
                s.tgl_selesai,
                s.wkt_ambil,
                s.status_sewa,
                p.user_plg,
                p.nm_lngkp,
                p.no_hp,
                p.nik
            FROM t_bayar b
            INNER JOIN t_sewa s ON s.kode_sewa = b.kode_sewa
            INNER JOIN t_penyewa p ON p.user_plg = s.user_plg
            WHERE b.kode_bayar = ?
              AND b.jns_byr = 'dp'
            LIMIT 1"
        );

        if (!$stmt) {
            throw new RuntimeException(
                'Detail verifikasi gagal disiapkan.'
            );
        }

        $stmt->bind_param('s', $kodeBayar);

        if (!$stmt->execute()) {
            $stmt->close();
            throw new RuntimeException(
                'Detail verifikasi gagal diambil.'
            );
        }

        $hasil = $stmt->get_result()->fetch_assoc();
        $stmt->close();

        return $hasil ?: null;
    }

    // Memproses persetujuan atau penolakan pembayaran oleh admin.
    public function verifikasiPembayaran(
        string $kodeBayar,
        string $keputusan
    ): bool {
        $keputusan = strtolower(trim($keputusan));

        if (!in_array($keputusan, ['valid', 'invalid'], true)) {
            throw new InvalidArgumentException(
                'Keputusan verifikasi tidak valid.'
            );
        }

        $statusSewa = $keputusan === 'valid'
            ? 'disetujui'
            : 'ditolak';

        $this->db->begin_transaction();

        try {
            $stmt = $this->db->prepare(
                "SELECT
                    b.kode_bayar,
                    b.kode_sewa,
                    b.ft_byr,
                    b.sttus_byr,
                    s.status_sewa
                FROM t_bayar b
                INNER JOIN t_sewa s ON s.kode_sewa = b.kode_sewa
                WHERE b.kode_bayar = ?
                  AND b.jns_byr = 'dp'
                LIMIT 1
                FOR UPDATE"
            );

            if (!$stmt) {
                throw new RuntimeException(
                    'Pemeriksaan verifikasi gagal disiapkan.'
                );
            }

            $stmt->bind_param('s', $kodeBayar);

            if (!$stmt->execute()) {
                $stmt->close();
                throw new RuntimeException(
                    'Pemeriksaan verifikasi gagal dijalankan.'
                );
            }

            $pembayaran = $stmt->get_result()->fetch_assoc();
            $stmt->close();

            if ($pembayaran === null) {
                throw new RuntimeException(
                    'Data pembayaran tidak ditemukan.'
                );
            }

            if ($pembayaran['sttus_byr'] !== 'pending') {
                throw new RuntimeException(
                    'Pembayaran sudah pernah diverifikasi.'
                );
            }

            if (empty($pembayaran['ft_byr'])) {
                throw new RuntimeException(
                    'Bukti pembayaran belum diunggah.'
                );
            }

            if ($pembayaran['status_sewa'] !== 'diajukan') {
                throw new RuntimeException(
                    'Status transaksi tidak dapat diverifikasi.'
                );
            }

            $kodeSewa = $pembayaran['kode_sewa'];

            $stmt = $this->db->prepare(
                "UPDATE t_bayar
                SET sttus_byr = ?, tgl_wkt_ver = NOW()
                WHERE kode_bayar = ?
                  AND sttus_byr = 'pending'"
            );

            if (!$stmt) {
                throw new RuntimeException(
                    'Pembaruan status pembayaran gagal disiapkan.'
                );
            }

            $stmt->bind_param('ss', $keputusan, $kodeBayar);

            if (!$stmt->execute()) {
                $stmt->close();
                throw new RuntimeException(
                    'Status pembayaran gagal diperbarui.'
                );
            }

            $berhasil = $stmt->affected_rows === 1;
            $stmt->close();

            if (!$berhasil) {
                throw new RuntimeException(
                    'Status pembayaran tidak berhasil diperbarui.'
                );
            }

            $stmt = $this->db->prepare(
                "UPDATE t_sewa
                SET status_sewa = ?
                WHERE kode_sewa = ?
                  AND status_sewa = 'diajukan'"
            );

            if (!$stmt) {
                throw new RuntimeException(
                    'Pembaruan status transaksi gagal disiapkan.'
                );
            }

            $stmt->bind_param('ss', $statusSewa, $kodeSewa);

            if (!$stmt->execute()) {
                $stmt->close();
                throw new RuntimeException(
                    'Status transaksi gagal diperbarui.'
                );
            }

            $berhasil = $stmt->affected_rows === 1;
            $stmt->close();

            if (!$berhasil) {
                throw new RuntimeException(
                    'Status transaksi tidak berhasil diperbarui.'
                );
            }

            $this->db->commit();

            return true;

        } catch (Throwable $e) {
            $this->db->rollback();
            throw $e;
        }
    }
}
