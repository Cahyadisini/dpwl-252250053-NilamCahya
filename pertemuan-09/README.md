# pertemuan-09
## Tahap 1 — Membuat halaman pembayaran penyewa P9

### Perubahan
Menambahkan file `application/models/Pembayaran_model.php` untuk mengelola data pembayaran. Model ini menggunakan prepared statement untuk mengambil data pembayaran penyewa, menyimpan bukti pembayaran, menampilkan daftar verifikasi admin, serta memperbarui status pembayaran dan penyewaan.

Proses verifikasi dilakukan dalam transaksi database agar perubahan status pembayaran dan status penyewaan tersimpan secara bersamaan.

## Tahap 2 — Menambahkan fitur upload bukti pembayaran P9

### Perubahan
1. Membuat `application/controllers/Pembayaran_controller.php` untuk menangani halaman pembayaran penyewa, unggah bukti pembayaran, dan verifikasi pembayaran oleh admin.
2. Menambahkan route pada `config/routes.php`:
   - `pembayaran` untuk halaman pembayaran penyewa.
   - `pembayaran/unggah-bukti` untuk proses unggah bukti pembayaran.
   - `admin/pembayaran` untuk halaman verifikasi pembayaran.
   - `admin/pembayaran/proses` untuk memproses verifikasi pembayaran.

## Tahap 3  — Verifikasi Pembayaran Admin

### Tujuan
Membuat fitur bagi admin untuk memeriksa bukti pembayaran DP yang telah diunggah oleh penyewa, kemudian menyetujui atau menolak pembayaran tersebut.

### Perubahan

1. **Menambahkan Menu Verifikasi Pembayaran**
   - Menambahkan menu Verifikasi Pembayaran pada sidebar admin.
   - Menu diarahkan ke halaman `admin/pembayaran`.

2. **Membuat Halaman Daftar Verifikasi**
   - Menampilkan daftar pembayaran DP yang berstatus pending.
   - Menampilkan informasi pembayaran dan penyewa.
   - Menggunakan template AdminLTE agar tampilan mengikuti halaman admin lainnya.

3. **Membuat Halaman Detail Verifikasi**
   - Menampilkan detail pembayaran dan informasi penyewa.
   - Menampilkan bukti pembayaran yang telah diunggah.
   - Menyediakan tombol untuk menyetujui atau menolak pembayaran.

4. **Membuat Proses Verifikasi**
   - Admin dapat memilih keputusan valid atau invalid.
   - Jika pembayaran disetujui, status pembayaran berubah menjadi `valid` dan status transaksi menjadi `disetujui`.
   - Jika pembayaran ditolak, status pembayaran berubah menjadi `invalid` dan status transaksi menjadi `ditolak`.

### File yang Digunakan

- `application/controllers/Pembayaran_controller.php`
- `application/models/Pembayaran_model.php`
- `application/views/templates/sidebar.php`
- `application/views/admin/verifikasi_pembayaran.php`
- `application/views/admin/verifikasi_pembayaran_detail.php`
- `config/routes.php`

### Hasil Akhir
Fitur Verifikasi Pembayaran Admin berhasil ditambahkan. Admin dapat melihat daftar pembayaran DP, memeriksa bukti pembayaran, serta memberikan keputusan persetujuan atau penolakan terhadap pembayaran penyewa.

## Tahap 4 — Menguji dan Memperbaiki Proses Pembayaran

### Tujuan
Memastikan seluruh proses pembayaran berjalan dengan baik, mulai dari penyewa melihat tagihan, mengunggah bukti pembayaran, hingga admin melakukan verifikasi.

### Pengujian

1. **Pengujian dari Sisi Penyewa**
   - Memastikan daftar pembayaran dapat ditampilkan.
   - Memastikan detail pembayaran dapat dibuka.
   - Menguji unggah bukti pembayaran.
   - Memastikan format file dan ukuran file divalidasi.
   - Memastikan notifikasi berhasil atau gagal tampil.

2. **Pengujian dari Sisi Admin**
   - Memastikan daftar pembayaran pending ditampilkan.
   - Memastikan detail dan bukti pembayaran dapat dilihat.
   - Menguji proses persetujuan pembayaran.
   - Menguji proses penolakan pembayaran.

3. **Pengujian Perubahan Status**
   - Memastikan status pembayaran berubah menjadi `valid` atau `invalid`.
   - Memastikan status transaksi berubah menjadi `disetujui` atau `ditolak`.
   - Memastikan pembayaran yang sudah diverifikasi tidak dapat diproses kembali.

### Perbaikan
- Memperbaiki pemanggilan template AdminLTE pada halaman verifikasi pembayaran.
- Menyesuaikan tampilan halaman daftar dan detail verifikasi agar menggunakan CSS dan sidebar admin.
- Memperbaiki pemanggilan halaman detail pembayaran dan penanganan kode pembayaran pada URL.

### Hasil Akhir
Pengujian dan perbaikan dilakukan untuk memastikan proses pembayaran P9 berjalan sesuai alur yang ditentukan, mulai dari pengunggahan bukti pembayaran oleh penyewa hingga verifikasi pembayaran oleh admin.