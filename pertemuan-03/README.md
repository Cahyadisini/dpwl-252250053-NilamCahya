# pertemuan-03
Nama: Nilam Cahya
NIM: 2522500053
Kelompok: SI3A

# Penerapan Post-Redirect-Get (PRG)
Pada tahap ini dilakukan penelusuran dan pengujian pola
Post-Redirect-Get (PRG) pada proses autentikasi.
Penerapan PRG:
- Login berhasil menggunakan POST, lalu redirect ke /admin dan dilanjutkan GET.
- Logout menggunakan POST, lalu redirect ke /auth/login dan dilanjutkan GET.
- Login gagal tidak redirect, tetapi controller mengembalikan view login + pesan         kesalahan pada request tersebut.

# Pengujian aktual dilakukan terhadap:
| No. | Skenario Pengujian | Hasil Aktual | Status |
| --: | ----------------------------------- | ---------------- | ----------------------- |
| 1 | Login dengan kredensial valid | `[ Login berhasil dan diarahkan ke halaman /admin]` | `[Sesuai]` |
| 2 | Login dengan kredensial tidak valid | `[ogin gagal dan pesan kesalahan ditampilkan pada halaman login]` | `[Sesuai]` |
| 3 | Logout melalui halaman administrasi | `[Logout berhasil, session berakhir, kemudian diarahkan ke /auth/login ]` | `[Sesuai]` |
| 4 | Akses halaman admin setelah logout | `[Akses ke halaman admin ditolak dan diarahkan ke halaman login]` | `[Sesuai]` |

### Perbaikan
| Masalah yang Ditemukan | Perbaikan yang Dilakukan | Hasil Setelah Perbaikan |
| ---------------------- | ------------------------ | ----------------------- |
| `Tulisan username masih menggunakan nama bawaan AdminLTE, yaitu Alexander Pierce, sehingga tidak sesuai dengan akun admin yang sedang login.` | `Mengganti tulisan Alexander Pierce dengan variabel $username agar nama yang ditampilkan mengikuti username admin yang sedang login.` | `Username yang tampil pada halaman admin sesuai dengan akun yang sedang login.` |
| ---------------------- | ------------------------ | ----------------------- |
| `Lokasi tiga gambar profil masih menggunakan alamat relatif dist/img/avatar2.png, sehingga gambar tidak mengarah ke folder template AdminLTE dengan benar.` | `Memperbaiki alamat src pada tiga gambar dengan menggunakan variabel $adminlte_url yang mengarah ke folder template AdminLTE.` | `Ketiga gambar profil dapat mengambil gambar dari folder template AdminLTE sesuai dengan lokasi yang ditentukan` |

