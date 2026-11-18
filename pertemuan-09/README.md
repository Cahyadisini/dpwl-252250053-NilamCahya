# pertemuan-09
## Tahap 1 — Model Pembayaran

### Perubahan
Menambahkan file `application/models/Pembayaran_model.php` untuk mengelola data pembayaran. Model ini menggunakan prepared statement untuk mengambil data pembayaran penyewa, menyimpan bukti pembayaran, menampilkan daftar verifikasi admin, serta memperbarui status pembayaran dan penyewaan.

Proses verifikasi dilakukan dalam transaksi database agar perubahan status pembayaran dan status penyewaan tersimpan secara bersamaan.
