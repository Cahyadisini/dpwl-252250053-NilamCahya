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
- File `penyewa_view.php`: tidak terdapat kesalahan sintaks.
- File `Penyewa_controller.php`: tidak terdapat kesalahan sintaks.