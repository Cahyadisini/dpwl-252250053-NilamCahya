# pertemuan-08 
## UTS Nilam Cahya 

### tahap a. Penambahan Menu Manajemen Penyewa
Menambahkan menu Manajemen Penyewa pada sidebar Admin agar Admin dapat mengakses pengelolaan data penyewa.

### Tahap b. Pembuatan Model Manajemen Penyewa
**File:** `application/models/Penyewa_model.php`
**Perubahan:**
- Menambahkan fungsi `getAll()` untuk mengambil seluruh data penyewa.
- Menyesuaikan fungsi `create()` untuk menyimpan data penyewa beserta foto KTP dan SIM A.
- Menambahkan fungsi `update()` untuk mengubah data penyewa.
- Menambahkan fungsi `delete()` untuk menghapus data penyewa.
- Mempertahankan fungsi registrasi, login, dan profil penyewa yang sudah tersedia.
- Menggunakan MySQLi prepared statement untuk proses perubahan dan penghapusan data.

**Hasil Pengujian:**
Belum dilakukan pengujian CRUD. Pengujian akan dilakukan setelah Controller dan View selesai dibuat.

### Tahap c — Formulir dan Tampilan Data Penyewa

**File yang dibuat:**
- `application/views/admin/penyewa_view.php`

**File yang diubah:**
- `config/routes.php`
- `application/controllers/Penyewa_controller.php`

**Perubahan:**
- Membuat halaman Manajemen Penyewa dengan formulir dan tabel data penyewa.
- Menambahkan route untuk halaman Manajemen Penyewa, tambah, ubah, dan hapus.
- Menambahkan fungsi `index()` untuk menampilkan halaman Manajemen Penyewa.
- Menambahkan fungsi `tambah()` untuk memproses penambahan data penyewa.
- Menambahkan validasi input dan fungsi untuk menampilkan kembali halaman ketika terjadi kesalahan.
- Mempertahankan fungsi profil penyewa dan jumlah kendaraan dalam keranjang yang sudah ada.

**Hasil Pemeriksaan:**
- Halaman Manajemen Penyewa berhasil dibuka melalui browser.
- Formulir Manajemen Penyewa berhasil ditampilkan.
- Tabel data penyewa berhasil ditampilkan dan data dari database muncul.
### Tahap d — CRUD Manajemen Data Penyewa

**File yang diubah:**
- `application/controllers/Penyewa_controller.php`
- `application/models/Penyewa_model.php`
- `application/views/admin/penyewa_view.php`

**Perubahan:**
- Menambahkan fungsi untuk menampilkan, menambah, mengubah, dan menghapus data penyewa.
- Menggunakan prepared statement MySQLi untuk proses database.
- Menerapkan validasi data sebelum disimpan.
- Menggunakan `password_hash()` untuk mengenkripsi password.
- Menambahkan fitur upload dan penghapusan foto KTP serta SIM A.
- Menambahkan hak akses agar halaman manajemen penyewa hanya dapat diakses oleh Admin.
- Menggunakan redirect setelah proses CRUD selesai.

**Hasil Pengujian:**
- Halaman Manajemen Penyewa berhasil ditampilkan.
- Data penyewa berhasil ditambahkan.
- Data penyewa berhasil ditampilkan pada tabel.
- Data penyewa berhasil diubah.
- Data penyewa berhasil dihapus.
- Proses CRUD berjalan sesuai fungsinya.