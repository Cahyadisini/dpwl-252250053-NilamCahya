# pertemuan-10
## Pelunasan dan Dokumen Transaksi
- Menyiapkan artefak P9 sebagai dasar pengembangan P10.
- Memeriksa enum status transaksi
- Menambahkan enum lunas pada t_sewa.status_sewa
- Menambahkan method getDaftarPelunasan() pada berkas application\models\Pembayaran_model.php
- Menambahkan method getDetailPelunasan(string $kodeSewa) pada berkas
application\models\Pembayaran_model.php
- Menambahkan method internal buatKodeBayarPelunasan(string $tanggalKode) pada berkas
application\models\Pembayaran_model.php
- Menambahkan method simpanPelunasan(string $kodeSewa, string $metodeBayar, ?string $namaFileBukti =
null) pada berkas application\models\Pembayaran_model.php
- Menambahkan Method pelunasanIndex() digunakan untuk menampilkan daftar transaksi yang belum lunas
- Menambahkan Method pelunasanDetail(string $kodeSewa) digunakan untuk menampilkan detail transaksi, riwayat
pembayaran, dan sisa kewajiban
- Menambahkan Method prosesPelunasan(string $kodeSewa) digunakan untuk mencatat pembayaran pelunasan yang diterima
langsung oleh admin
- Menambahkan Method dokumenTransaksi(string $kodeSewa) digunakan untuk menampilkan dokumen transaksi yang siap
dicetak
- Memeriksa kembali fungsi pembayaran P9 setelah penambahan fitur pelunasan P10.
- Memastikan penyewa tetap dapat melihat detail pembayaran dan mengunggah bukti pembayaran.
- Memastikan admin tetap dapat melakukan verifikasi pembayaran.
- Memastikan proses verifikasi dan perubahan status transaksi tetap berjalan sesuai fungsi sebelumnya.
- Menambahkan route Method pelunasanIndex()
- Menambahkan route Method prosesPelunasan(string $kodeSewa)
- Menambahkan route Method pelunasanDetail(string $kodeSewa)
- Menambahkan route Method dokumenTransaksi(string $kodeSewa)
- Menambahkan menu Pelunasan pada bagian navigasi admin.
- Memastikan seluruh method pelunasan dan dokumen transaksi dilindungi oleh require_admin_login().
- Mempertahankan route pembayaran P9 yang sudah tersedia.
- Melakukan pemeriksaan awal kesesuaian route dengan method Controller.
