# pertemuan-05

# Tahap A - Persiapan Menu Manajemen kendaraan

# Perubahan yang Dilakukan
- Menambahkan atau menyesuaikan menu Manajemen Kendaraan pada sidebar.
- Menyesuaikan konfigurasi routing untuk akses halaman kendaraan.

# Berkas yang Terdampak
- `application/views/templates/sidebar.php`
- `application/config/routes.php`

# Hasil Pengujian
- Perubahan menu dan konfigurasi routing telah disiapkan.
- Halaman kendaraan belum dapat ditampilkan karena Controller kendaraan belum dibuat.

# Tahap B - Menambahkan Route Manajemen Kendaraan

# 1. Perubahan yang Dilakukan
Pada tahap ini dilakukan penambahan konfigurasi route untuk mendukung akses ke fitur pengelolaan data kendaraan. Route yang ditambahkan adalah:
- Route tambah kendaraan melalui `admin/mobil/tambah`.
- Route ubah kendaraan melalui `admin/mobil/ubah/(:any)`.
- Route hapus kendaraan melalui `admin/mobil/hapus/(:any)`.

Route tersebut disiapkan untuk menghubungkan URL dengan method yang sesuai pada `Mobil_controller`.

# 2. Berkas yang Terdampak
- `application/config/routes.php`

# 3. Hasil Pengujian
- Route tambah, ubah, dan hapus kendaraan telah disiapkan.
- Saat URL kendaraan diakses, pesan "Controller tidak ditemukan." masih dapat muncul karena `Mobil_controller.php` belum dibuat.
- Pengujian fungsi setiap route akan dilanjutkan setelah Controller tersedia pada tahap berikutnya.

# Tahap C - Menambahkan Route Manajemen Kendaraan

# Tahap Pengerjaan
Implementasi fitur READ data kendaraan menggunakan pola homemade MVC sesuai Modul Praktikum P5.

# Berkas yang Dikerjakan
- `application/config/routes.php` — pengaturan route halaman kendaraan.
- `application/models/Mobil_model.php` — pengambilan data kendaraan dari tabel `t_mobil`.
- `application/controllers/Mobil_controller.php` — controller untuk mengatur proses penampilan data mobil.
- `application/views/admin/mobil_view.php` — tampilan tabel data kendaraan.
- `application/views/templates/header.php` — template bagian atas halaman.
- `application/views/templates/footer.php` — template bagian bawah halaman dan pemanggilan JavaScript.

# Alur READ
1. Pengguna membuka halaman manajemen kendaraan.
2. Router mengarahkan permintaan ke `Mobil_controller::index()`.
3. Controller memeriksa autentikasi admin.
4. Controller meminta data kendaraan melalui `Mobil_model::getAll()`.
5. Model mengambil data dari tabel `t_mobil`.
6. Controller mengirimkan data ke view `admin/mobil_view`.
7. View menampilkan data kendaraan dalam bentuk tabel.

# Pemeriksaan Kode
- Memeriksa route menuju halaman manajemen kendaraan.
- Memeriksa pemanggilan model dan view pada controller.
- Memeriksa struktur tabel dan pemanggilan file template.
- Memeriksa pemuatan JavaScript untuk fitur DataTables.

# Kendala yang Ditemui
1. Terjadi error karena file `header.php` tidak ditemukan pada path `application/views/admin/header.php`. Pemanggilan template perlu disesuaikan dengan struktur folder `application/views/templates/`.
2. Ikon panah sorting tabel belum muncul. Bagian pemuatan CSS, JavaScript, dan inisialisasi DataTables perlu diperiksa.

## Tahap D – Implementasi INSERT Data Kendaraan

# 1. Perubahan yang Dilakukan

Pada tahap ini, dikembangkan fitur INSERT untuk menambahkan data kendaraan baru ke dalam sistem pengelolaan mobil berbasis PHP MVC.

Perubahan dilakukan pada berkas berikut:

- `application/models/Mobil_model.php`
  - Menggunakan method `create()` untuk menyimpan data kendaraan baru ke tabel `t_mobil`.
  - Menggunakan prepared statement untuk menjalankan query INSERT.

- `application/controllers/Mobil_controller.php`
  - Menangani proses penambahan data kendaraan.
  - Mengambil data yang dikirim melalui form.
  - Melakukan validasi input sebelum data disimpan.
  - Menangani proses unggah foto kendaraan.
  - Menampilkan pesan hasil proses dan mengarahkan pengguna kembali ke halaman daftar kendaraan.

- `application/views/admin/mobil_view.php`
  - Menambahkan form untuk memasukkan data kendaraan.
  - Menyediakan input nomor plat, nama mobil, jumlah kursi, jumlah bagasi, jenis mobil, transmisi, tahun pembuatan, harga sewa per hari, catatan unit, dan status kendaraan.
  - Menyediakan input foto depan, foto belakang, dan foto interior.
  - Menambahkan pratinjau foto yang dipilih.
  - Mempertahankan tampilan AdminLTE dan tabel daftar kendaraan.

# 2. Validasi Input

Validasi dilakukan untuk memastikan data yang dimasukkan sesuai dengan ketentuan aplikasi, meliputi:

- Nomor plat dan nama mobil.
- Jumlah kursi dan jumlah bagasi.
- Jenis mobil dan transmisi.
- Tahun pembuatan.
- Harga sewa per hari.
- Catatan unit dan status kendaraan.
- Jenis file dan ukuran foto yang diunggah.

Data yang tidak memenuhi ketentuan harus ditolak sebelum proses penyimpanan dilakukan.

# 3. Fitur Unggah Foto

Fitur unggah foto digunakan untuk menyimpan foto depan, belakang, dan interior kendaraan. Sistem memeriksa jenis file serta ukuran foto sebelum file dipindahkan ke folder penyimpanan.

Pratinjau foto ditampilkan agar admin dapat melihat foto yang dipilih sebelum mengirimkan form.

# 4. Alur Proses INSERT

1. Admin membuka halaman tambah kendaraan.
2. Admin mengisi data kendaraan dan memilih foto.
3. Controller menerima dan memvalidasi input.
4. Controller memproses unggah foto.
5. Model menyimpan data kendaraan ke tabel `t_mobil`.
6. Aplikasi menampilkan pesan hasil proses dan mengarahkan pengguna ke halaman daftar kendaraan.

# 5. Hasil Pemeriksaan dan Pengujian

**Pemeriksaan kode:**
- Memeriksa kesesuaian nama input pada view dengan data yang diproses controller.
- Memeriksa proses validasi input dan unggah foto.
- Memeriksa method penyimpanan data pada model.
- Memeriksa kesesuaian query INSERT dengan kolom tabel `t_mobil`.

**Pengujian aplikasi:**
- Hasil penambahan data kendaraan: [isi sesuai hasil aktual].
- Hasil validasi input: [isi sesuai hasil aktual].
- Hasil unggah foto: [isi sesuai hasil aktual].
- Hasil tampilan pesan proses: [isi sesuai hasil aktual].

## Tahap E – Mengimplementasikan UPDATE Data Kendaraan dengan MVC

### 1. Implementasi UPDATE

Pada tahap ini, dikembangkan fitur untuk memperbarui data kendaraan yang sudah tersimpan di dalam database. Admin dapat memilih kendaraan dari halaman daftar, membuka form ubah, memperbarui informasi kendaraan, kemudian menyimpan perubahan.

# 2. Perubahan Berkas

- `application/models/Mobil_model.php`
  - Menambahkan atau menyesuaikan method `update()` untuk memperbarui data kendaraan pada tabel `t_mobil`.
  - Memastikan data diperbarui berdasarkan nomor plat kendaraan yang dipilih.

- `application/controllers/Mobil_controller.php`
  - Menangani permintaan untuk membuka form ubah kendaraan.
  - Mengambil data kendaraan berdasarkan nomor plat.
  - Memvalidasi input sebelum menyimpan perubahan.
  - Menangani unggah foto baru jika foto kendaraan diganti.
  - Menampilkan pesan hasil proses dan mengarahkan pengguna kembali ke daftar kendaraan.

- `application/views/admin/mobil_view.php`
  - Menampilkan form ubah dengan data kendaraan sebelumnya.
  - Memungkinkan admin mengubah informasi kendaraan.
  - Menampilkan foto yang sudah tersimpan dan menyediakan pilihan untuk menggantinya.
  - Mempertahankan tampilan AdminLTE dan tabel daftar kendaraan.

# 3. Alur Proses UPDATE

1. Admin memilih kendaraan yang akan diubah.
2. Sistem mengambil data kendaraan berdasarkan nomor plat.
3. Form ubah ditampilkan dengan data yang sudah tersimpan.
4. Admin mengubah data yang diperlukan.
5. Controller memvalidasi input dan memproses foto baru jika ada.
6. Model menjalankan proses UPDATE pada database.
7. Aplikasi menampilkan pesan hasil proses dan mengarahkan pengguna kembali ke daftar kendaraan.

