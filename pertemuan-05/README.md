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



