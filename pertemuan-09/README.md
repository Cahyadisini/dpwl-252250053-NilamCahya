# pertemuan-09
## Tahap 1 — Model Pembayaran

### Perubahan
Menambahkan file `application/models/Pembayaran_model.php` untuk mengelola data pembayaran. Model ini menggunakan prepared statement untuk mengambil data pembayaran penyewa, menyimpan bukti pembayaran, menampilkan daftar verifikasi admin, serta memperbarui status pembayaran dan penyewaan.

Proses verifikasi dilakukan dalam transaksi database agar perubahan status pembayaran dan status penyewaan tersimpan secara bersamaan.

## Tahap 2 — Pembayaran Controller dan Routes

### Perubahan
1. Membuat `application/controllers/Pembayaran_controller.php` untuk menangani halaman pembayaran penyewa, unggah bukti pembayaran, dan verifikasi pembayaran oleh admin.
2. Menambahkan route pada `config/routes.php`:
   - `pembayaran` untuk halaman pembayaran penyewa.
   - `pembayaran/unggah-bukti` untuk proses unggah bukti pembayaran.
   - `admin/pembayaran` untuk halaman verifikasi pembayaran.
   - `admin/pembayaran/proses` untuk memproses verifikasi pembayaran.

