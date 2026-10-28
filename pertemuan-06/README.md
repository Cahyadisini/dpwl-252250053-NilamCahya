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


Tahap D – Registrasi Penyewa

- Controller: Method `register()` telah ditambahkan pada berkas `Auth.php` untuk menangani proses registrasi penyewa. Method ini memproses permintaan yang diterima dari halaman registrasi dan mengatur alur pendaftaran berdasarkan metode HTTP yang digunakan.
- Model: Berkas `Penyewa_model.php` digunakan untuk menangani pengolahan data penyewa yang berkaitan dengan proses registrasi, termasuk penyimpanan data penyewa baru ke database.
- View: Halaman registrasi penyewa telah disiapkan pada folder `application/views/auth/` untuk menampilkan formulir pendaftaran. Formulir digunakan oleh calon penyewa untuk memasukkan informasi yang diperlukan saat membuat akun baru.
- Formulir Registrasi: Formulir registrasi menyediakan kolom input untuk data penyewa sesuai kebutuhan aplikasi. Pengguna mengisi data yang diminta sebelum mengirimkan formulir untuk diproses oleh controller.
- Validasi Data: Proses registrasi dilengkapi dengan pemeriksaan data input untuk memastikan data yang dikirim memenuhi ketentuan yang diterapkan pada aplikasi. Validasi dilakukan sebelum data diproses lebih lanjut agar input yang tidak sesuai dapat ditangani.
- Proses Registrasi: Setelah formulir dikirimkan, data diterima oleh method `register()` pada `Auth.php`. Data tersebut kemudian diproses sesuai alur registrasi dan diteruskan ke model untuk disimpan ke database apabila memenuhi ketentuan yang berlaku.
- URL pengujian:`http://localhost/dpwl-2522500053/index.php/auth/register`
- Hasil pengujian: Halaman registrasi penyewa dapat diakses melalui URL pengujian. Formulir registrasi ditampilkan untuk memungkinkan pengguna memasukkan data penyewa baru. Proses registrasi ditangani oleh controller dan menggunakan model untuk mengelola data penyewa. Validasi input diterapkan sebelum data diproses lebih lanjut sesuai dengan ketentuan pada aplikasi.
- Kesimpulan:Tahap D berfokus pada implementasi fitur registrasi penyewa dengan mengintegrasikan controller, model, dan view. Integrasi tersebut bertujuan agar pengguna dapat melakukan pendaftaran akun melalui formulir yang tersedia. Pengujian dilakukan untuk memeriksa halaman registrasi dan alur pemrosesan data sesuai implementasi aplikasi.

Tahap E – Login, Sesi, dan Logout Penyewa

- Controller: Method `loginPenyewa()` dan `logoutPenyewa()` telah ditambahkan pada berkas `Auth.php` untuk menangani proses login dan logout penyewa.
- Model: Berkas `Penyewa_model.php` digunakan untuk mengambil data penyewa berdasarkan username yang dimasukkan saat login dan memeriksa data akun yang tersimpan di database.
- Route: Route `auth/login-penyewa` dan `auth/logout-penyewa` telah ditambahkan pada `routes.php` untuk mengakses proses login dan logout penyewa.
- View: Halaman login penyewa disiapkan pada folder `application/views/auth/` untuk menampilkan formulir login yang berisi kolom username dan password.
- Proses Login: Pengguna memasukkan username dan password pada formulir login. Data tersebut dikirimkan ke controller untuk diperiksa. Sistem memvalidasi input dan mencocokkan kredensial dengan data penyewa yang tersimpan di database sebelum memberikan akses kepada pengguna.
- Pengelolaan Sesi: Setelah login berhasil, aplikasi membuat sesi penyewa untuk menyimpan informasi akun yang sedang masuk. Sesi digunakan untuk mengenali pengguna selama mengakses halaman yang memerlukan autentikasi.
- Proses Logout: Method `logoutPenyewa()` digunakan untuk mengakhiri sesi penyewa yang sedang aktif sehingga pengguna keluar dari akun dan tidak lagi menggunakan sesi login tersebut.
- Validasi Login: Sistem menangani input login yang tidak sesuai, seperti username atau password yang salah, serta input yang tidak memenuhi ketentuan validasi. Pesan kesalahan ditampilkan agar pengguna mengetahui bahwa proses login belum berhasil.
- Pembatasan Akses: Halaman atau fitur yang memerlukan autentikasi diperiksa berdasarkan status sesi penyewa. Pengguna yang belum login tidak seharusnya dapat mengakses fitur yang dibatasi untuk penyewa yang telah terautentikasi.
- Hasil pengujian: Pengujian Tahap E mencakup akses halaman login, proses login dengan akun penyewa, penanganan login yang gagal, pengelolaan sesi setelah login berhasil, proses logout, serta pembatasan akses halaman yang memerlukan autentikasi. Pengujian ini bertujuan memastikan proses autentikasi penyewa berjalan sesuai implementasi aplikasi.
