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
