# pertemuan-06

Tahap A: Pemeriksaan Aset Template Zay Shop
1. Tujuan Pemeriksaan
Pemeriksaan ini dilakukan untuk memastikan ketersediaan aset template Zay Shop dan kesiapan integrasinya ke dalam aplikasi DPWL menggunakan arsitektur MVC. Pemeriksaan juga bertujuan untuk mengetahui jalur aset yang perlu disesuaikan saat template diterapkan ke View.
2. Hasil Pemeriksaan Aktual
Berdasarkan pemeriksaan awal pada workspace DPWL, ditemukan beberapa folder aset template Zay Shop berikut:
assets/zay/css/
assets/zay/img/
assets/zay/js/
assets/zay/webfonts/

Tahap B:  Mengimplementasikan Katalog Kendaraan Berbasis MVC

- Model: Method `getKatalog()` telah ditambahkan pada `Mobil_model.php`.
- Controller: Berkas `Katalog_controller.php` telah dibuat.
- Route: Route `katalog` telah ditambahkan pada `routes.php`.
- View: Berkas `header.php`, `navbar.php`, `footer.php`, dan `index.php` telah disiapkan pada folder `application/views/katalog/`.
- URL pengujian: `http://localhost/dpwl-2522500053/index.php/katalog`
- Hasil pengujian: Halaman katalog kendaraan berhasil diakses melalui URL pengujian. Data kendaraan beserta informasi nama, jenis, tahun, dan transmisi tampil pada halaman katalog. Tombol **Lihat Kendaraan** juga ditampilkan pada kartu kendaraan. Namun, beberapa foto kendaraan belum tersedia sehingga halaman menampilkan pesan *“Foto kendaraan belum tersedia”*.

Tahap C – Detail Kendaraan Berbasis MVC

- Route: Route katalog/detail/(:any) telah ditambahkan pada routes.php untuk mengakses halaman detail kendaraan berdasarkan nomor plat.
- Controller: Method detail() telah ditambahkan pada Katalog_controller.php untuk mengambil data kendaraan berdasarkan nomor plat dan menampilkan halaman detail.
- Model: Method findByNoPlat() digunakan untuk mencari data kendaraan berdasarkan nomor plat.
- View: Berkas detail.php telah dibuat pada folder application/views/katalog/ untuk menampilkan informasi detail kendaraan.

URL pengujian: Halaman detail kendaraan diakses melalui tombol Lihat Kendaraan pada halaman katalog.