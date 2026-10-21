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

