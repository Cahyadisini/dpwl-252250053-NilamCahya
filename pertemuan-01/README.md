1. kesinambungan PWD–DPW–DPWL;
jawaban:
Pemrograman Web Dasar (PWD) berfokus pada komponen sisi pengguna. di sini kita belajar cara membuat tampilan dan antarmuka website menggunakan HTML dan CSS, serta menambahkan fungsi sederhana dengan JavaScript.
Desain dan Pemrograman Web (DPW) mulai belajar cara membuat website yang bisa mengolah dan mengambil data dari database menggunakan PHP dasar.
Desain dan Pemrograman Web Lanjutan (DPWL) mulai mempelajari cara menyusun program agar lebih rapi dan teratur. Pada tahap ini, kita menggunakan pola MVC dan framework supaya aplikasi lebih aman, mudah dikembangkan, dan mudah diperbaiki

2. perbedaan PHP terstruktur dan MVC;
jawaban:
PHP terstruktur merupakan tahap pengembangan aplikasi dengan kode yang disusun secara berurutan dan terorganisir. 
Sedangkan MVC merupakan pola pengembangan yang membagi aplikasi menjadi Model, View, dan Controller sehingga pengelolaan data, tampilan, dan proses program menjadi lebih terpisah dan mudah dikelola.

3. fungsi Model, View, dan Controller;
jawaban:
Model bertugas mengatur dan mengelola data yang ada di database, create, read, update, dan delete 
View bertugas menampilkan data kepada pengguna dalam bentuk tampilan yang bisa dilihat dan digunakan.
Controller bertugas mengatur proses aplikasi dan menghubungkan Model dengan View agar aplikasi dapat berjalan dengan baik.

4. alur request–response MVC;
jawaban:
1.Pengguna mengirim request
Pengguna membuka halaman login sistem rental, kemudian memasukkan username dan password lalu menekan tombol “Login”.
2.Request diterima oleh Controller
Controller menerima data login dari pengguna dan menentukan bahwa data tersebut perlu diperiksa.
3.Controller meminta Model
Controller meminta Model untuk memeriksa username dan password pengguna.
4.Model mengakses Database
Model mencari data pengguna di database dan mencocokkan username serta password yang dimasukkan.
5.Data dikembalikan ke Controller
Setelah diperiksa, Model mengirimkan hasilnya kepada Controller, apakah data login benar atau tidak.
6.Controller mengirim data ke View
Jika login berhasil, Controller mengarahkan pengguna ke View halaman utama sistem rental. Jika gagal, Controller mengarahkan kembali ke halaman login dengan pesan kesalahan.
7.View menampilkan hasil
View menampilkan halaman yang sesuai. Jika berhasil, misalnya muncul halaman utama yang berisi daftar kendaraan yang tersedia untuk disewa.
8.Response diterima pengguna
Pengguna menerima hasil dari proses login. Jika username dan password benar, pengguna berhasil masuk ke sistem rental dan dapat menggunakan fitur yang tersedia.

5. pemetaan satu atau beberapa bagian/fitur aplikasi DPW ke Model, Controller, dan View disertai alasan; dan
jawaban:
Pada aplikasi DPW, beberapa fitur dapat dipetakan ke dalam Model, Controller, dan View. contohnya pada fitur login. model berfungsi untuk memeriksa data username dan password pada database, controller mengatur proses login dan menentukan apakah login berhasil atau gagal, sedangkan view menampilkan halaman login serta hasil dari proses tersebut.
Pada fitur data mahasiswa, model bertugas mengelola data mahasiswa di database, controller mengatur proses tambah, ubah, hapus, dan tampil data, sedangkan view menampilkan data mahasiswa dalam bentuk tabel atau form.
Pada fitur jadwal sidang, model mengelola data jadwal sidang, controller mengatur proses pengambilan dan pengelolaan jadwal, sedangkan view menampilkan jadwal sidang kepada pengguna.
Pemetaan tersebut dilakukan karena setiap bagian memiliki tugas yang berbeda, yaitu model untuk mengelola data, controller untuk mengatur proses, dan miew untuk menampilkan data kepada pengguna.

6. kesimpulan P1.
jawaban:
Dari materi P1 ini dapat disimpulkan kalau penerapan arsitektur MVC di DPWL sangat membantu merapikan struktur pemrogramannya. Dibandingkan PHP terstruktur yang kodenya sering menyatu di satu file, MVC bikin aplikasi lebih teratur, aman, dan mempermudah kita kalau nanti mau ngembangin aplikasi skala besar secara berkelanjutan atau kerja kelompok

