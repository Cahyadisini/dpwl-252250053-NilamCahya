# pertemuan-02
Nama: Nilam Cahya
NIM: 2522500053
Kelompok: SI3A

## 1. Tujuan Praktikum 
jawaban: 
Tujuan dari praktikum ini adalah untuk memahami dasar penggunaan arsitektur MVC dengan membuatnya sendiri tanpa menggunakan framework. Selain itu, praktikum ini juga bertujuan untuk mengetahui cara kerja Front Controller dalam mengatur request, cara mengatur URL menggunakan Routing, serta penggunaan Base URL dan Helper. Praktikum ini juga membantu memahami cara memisahkan bagian program seperti Controller, Helper, dan View agar program lebih rapi dan mudah dipahami.

 
## 2. Struktur Direktori 
jawaban:
dpwl-2522500053/
├── application/
│   ├── config/
│   │   ├── config.php     --> Berisi pengaturan dasar aplikasi, seperti base_url
│   │   └── routes.php     --> Mengatur alamat URL yang digunakan dalam aplikasi
│   ├── controllers/
│   │   └── home.php       --> Mengatur proses dan halaman utama aplikasi
│   ├── helpers/
│   │   └── url_helper.php --> Membantu mengatur URL dalam aplikasi
│   └── views/
│       └── home/
│           ├── index.php  --> Menampilkan halaman utama
│           └── info.php   --> Menampilkan halaman informasi
├── assets/
│   └── css/
│       └── app.css        --> Mengatur tampilan halaman website
├── system/
│   └── core/
│       ├── Controller.php --> Class dasar yang digunakan oleh Controller
│       ├── Router.php     --> Mengatur proses pemilihan URL dan Controller
└── index.php              --> Pintu masuk utama untuk menjalankan aplikasi
 
 
## 3. Front controller 
jawaban:
index.php⁠ di folder utama berperan sebagai Front Controller, yaitu satu-satunya pintu masuk aplikasi. Tugas utamanya adalah menyambut request URL dari browser, menyiapkan konfigurasi dan file penting sistem, lalu menyerahkan prosesnya ke class ⁠Router⁠ untuk membuka halaman yang sesuai 
 
## 4. Routing dan Pemetaan URL 
jawaban:
| URL/Route | Controller | Method | Parameter | View |
| :--- | :--- | :--- | :--- | :--- |
| `/` | Home | index | - | `home/index.php` |
| `home/index` | Home | index | - | `home/index.php` |
| `home/info/mvc` | Home | info | mvc | `home/info.php` |
| `info/routing` | Home | info | routing | `home/info.php` |
| `mahasiswa/detail/2522500053` | Home | detail | 2522500053 | `home/detail.php` |
Penjelasan Pemetaan Route Modifikasi
1. URL/Route (mahasiswa/detail/2522500053) adalah alamat yang dimasukkan pengguna pada browser untuk membuka halaman detail mahasiswa.
2. Controller (Home) bertugas menerima URL dari Router dan menjalankan Controller Home.
3. Method (detail) adalah fungsi yang dijalankan oleh Controller untuk menampilkan halaman detail.
4. Parameter (2522500053) merupakan data yang diambil dari URL dan dimasukkan ke dalam method detail($id).
5.  View (home/detail.php) digunakan untuk menampilkan data detail mahasiswa pada halaman browser.
 
## 5. Base URL dan Helper 
jawaban:
-> Fungsi
base_url() digunakan untuk mendapatkan alamat utama aplikasi. Fungsi ini biasanya digunakan untuk memanggil file seperti CSS, JavaScript, gambar, dan file pendukung lainnya.
site_url() digunakan untuk membuat link atau alamat halaman yang ada di dalam aplikasi. Link tersebut akan diproses melalui index.php dan sistem Routing.
-> Contoh Penggunaan pada Implementasi P2
    -> Penggunaan base_url() untuk memanggil file CSS
        <link rel="stylesheet" href="<?= htmlspecialchars(base_url('assets/css/app.css'), ENT_QUOTES, 'UTF-8'); ?>">
    Hasil output URL:
         http://localhost/dpwl-2522500053/assets/css/app.css
    -> Penggunaan site_url() untuk membuat link navigasi atau route aplikasi
        <a href="<?= htmlspecialchars(site_url('info/routing'), ENT_QUOTES, 'UTF-8'); ?>">Uji custom route dan parameter</a>
Hasil output URL:
http://localhost/dpwl-2522500053/index.php/info/routing
 
## 6. Alur Request-response 
jawaban:
1. Alur eksekusi aktual P2: 
Browser → index.php → Router → Controller → View → Response. 
2. Posisi Model dalam arsitektur MVC lengkap: 
Browser → index.php → Router → Controller → Model → basis data/data → Model → Controller → View → 
Response.  
 
## 7. Hasil Pengujian dan Debugging 
ditemukan kesalahan selama implementasi.
Gejala: 
  Pas ngejalanin perintah `php -l index.php` di terminal VS Code, muncul error `php : The term 'php' is not recognized as the name of a cmdlet...` (CommandNotFoundException).
Penyebab: 
  Windows belum kenal sama perintah `php` karena path folder PHP dari Laragon belum didaftarin ke System Environment Variables (PATH).
Perbaikan: 
  Nambahin path folder PHP Laragon (`C:\laragon\bin\php\php-8.1.10-Win32-vs16-x64`) ke PATH Windows, terus restart VS Code supaya jalurnya terbaca.
Hasil Uji Ulang: 
  Perintah `php -l` buat semua berkas berhasil dijalanin dan keluar respon `No syntax errors detected in [nama_file]`. 
 
## 8. Bukti Tangkapan Layar 
Sisipkan gambar yang relevan dari folder dokumentasi/ dengan perintah: 
### Gambar 1. Hasil Pengujian Halaman Utama  
![Gambar 1 - Halaman Utama](dokumentasi/gambar1.jpg)  
### Gambar 2. Hasil Pengujian Custom Route  
![Gambar 2 - Custom Route](dokumentasi/gambar2.jpg) 
 
## 9. Kesimpulan P2 

Di P2 ini, kerangka MVC buatan sendiri udah berhasil dibuat dan bisa jalan sesuai harapan. Kerangka sederhana ini udah bisa ngelakuin beberapa hal:
- Ngatur `index.php` jadi Front Controller, alias satu-satunya pintu masuk buat semua request aplikasi.
- Memproses dan memetakan URL ke Controller, method, sampai parameter pakenya Router dan file `routes.php`.
- Nyiapin Base Controller biar pemanggilan halaman View bisa lebih rapi dan konsisten.
- Punya fungsi Helper (`base_url()` dan `site_url()`) yang bikin pemanggilan file CSS/aset dan navigasi link jadi jauh lebih gampang.
- Mengirim data dari Controller buat ditampilkan ke halaman View
Nah, buat di Pertemuan 03 (P3) nanti, kerangka ini bakal dikembangkan lagi dengan nambahin beberapa fitur baru:
- Bikin folder dan komponen **Model** buat ngurusin data.
- Bikin koneksi ke database MySQL pakenya MySQLi dan prepared statement.
- Nambahin fitur login/logout, ngatur session, dan hak akses pengguna.
- Ngebikin tampilan web jadi lebih keren dengan mengintegrasikan template AdminLTE.