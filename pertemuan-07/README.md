## Tahap A — Memastikan Artefak P6 Siap Digunakan

### Pemeriksaan
- Workspace P6: `dpwl-2522500053/`
- Aplikasi dijalankan melalui Laragon dan localhost.
- Koneksi database: [Berhasil ]
- Login admin: [Berhasil ]
- Login penyewa: [Berhasil ]
- Katalog kendaraan: [Berhasil ]
- Detail kendaraan: [Berhasil ]
- Pengelolaan kendaraan dan foto: [Berhasil ]
- Profil penyewa: [Berhasil ]

## Tahap B.2 — Membuat Controller Transaksi

### Perubahan
Membuat file `application/controllers/Transaksi_controller.php`.

Controller berfungsi menerima permintaan penambahan kendaraan ke keranjang, memeriksa login penyewa, memvalidasi metode POST, dan menampilkan pesan hasil proses.

### Pengujian
- File Controller berhasil dibuat: [Ya ]

## Tahap B.2 — Membuat Controller Transaksi

### Perubahan
Membuat file `application/controllers/Transaksi_controller.php`.

Controller berfungsi menerima permintaan penambahan kendaraan ke keranjang, memeriksa login penyewa, memvalidasi metode POST, dan menampilkan pesan hasil proses.

### Pengujian
- File Controller berhasil dibuat: [Ya ]

## Tahap B.3 — Menambahkan Route Transaksi

### Perubahan
Memperbarui `application/config/routes.php` dengan menambahkan route `transaksi/tambah`.
Route tersebut menghubungkan URL transaksi/tambah dengan method tambah() pada Transaksi_controller.

### Pengujian
- Route berhasil ditambahkan: [Ya ]

## Tahap C.1 — Integrasi Tombol pada Detail Kendaraan

### Perubahan
Mengubah bagian formulir Add To Cart pada `application/views/katalog/detail.php`.
Tombol disesuaikan berdasarkan status kendaraan dan status login penyewa.

## Tahap C.2 — Integrasi Tombol pada Halaman Katalog

### Perubahan
Mengubah blok tombol Tambah ke Keranjang pada `application/views/katalog/index.php`.
Tombol disesuaikan dengan status kendaraan dan status login penyewa.

## Tahap D.1 — Menyesuaikan Navbar

### Perubahan
Mengubah `application/views/katalog/navbar.php`.
Perubahan meliputi penambahan notifikasi transaksi, tautan menuju halaman keranjang, dan tampilan jumlah kendaraan dalam keranjang.

## Tahap D.2 — Mengirim Jumlah Keranjang ke Halaman

### Perubahan File
1. `application/models/Transaksi_model.php`
2. `application/controllers/Katalog_controller.php`

Menambahkan method untuk menghitung jumlah kendaraan dalam keranjang dan mengirimkan hasilnya ke halaman katalog serta detail kendaraan melalui data `jumlahKeranjang`.


## Tahap D.3

- `application/controllers/Penyewa_controller.php`


**Perubahan yang dilakukan:**

1. Menambahkan pemanggilan `Transaksi_model.php` pada bagian atas `Penyewa_controller.php`.
2. Menambahkan properti `$transaksiModel` di dalam class `Penyewa_controller`.
3. Menginisialisasi `Transaksi_model` pada method `__construct()`.
4. Menambahkan perhitungan `$jumlahKeranjang` pada halaman profil penyewa.
5. Mengirimkan data `jumlahKeranjang` ke View `penyewa/profil` ketika halaman profil dibuka.
6. Menambahkan data `jumlahKeranjang` ketika validasi formulir gagal.
7. Memperbarui method `renderProfilError()` agar jumlah keranjang tetap dikirim ke halaman profil ketika terjadi kesalahan.

## Tahap E.1 — Mengintegrasikan Proses Tambah ke Keranjang

### Perubahan
Memperbarui `application/models/Transaksi_model.php` dengan menambahkan helper pengelolaan keranjang, validasi kendaraan, perhitungan durasi sewa, dan method tambahKeKeranjang().

Proses penyimpanan transaksi menggunakan pola Header-Detail:
- Tabel `t_sewa` menyimpan informasi utama transaksi.
- Tabel `t_pilih` menyimpan kendaraan yang dipilih.

