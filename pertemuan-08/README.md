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