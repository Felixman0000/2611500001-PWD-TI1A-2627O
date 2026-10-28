# P7 - Pemrosesan Formulir dengan PHP

## Ringkasan

P7 melanjutkan halaman profil mahasiswa dari P6 dengan mempelajari pengiriman dan pemrosesan data formulir menggunakan PHP. Halaman utama menampilkan profil secara dinamis dan menyediakan formulir kontak untuk mengirim data ke server.

## Aktivitas yang Dipelajari

- Mengirim data formulir dengan metode `GET` dan membaca nilai dari `$_GET` melalui contoh di `indexGet.php`.
- Mengirim data formulir utama dengan metode `POST` dan membaca nilai dari `$_POST`.
- Memeriksa metode permintaan menggunakan `$_SERVER['REQUEST_METHOD']`.
- Memvalidasi data di JavaScript sebelum formulir dikirim dan memvalidasi ulang di PHP pada server.
- Memeriksa nama, email, semester, tanggal kunjungan, jenis pesan, program studi, topik minat, dan isi pesan.
- Menggunakan session untuk menyimpan sementara data formulir yang valid atau pesan kesalahan setelah pengalihan halaman.
- Mengisi kembali formulir dengan data sebelumnya jika validasi gagal, lalu menampilkan data yang diterima server jika validasi berhasil.
- Mengamankan keluaran data pengguna menggunakan `htmlspecialchars()` dan menampilkan baris baru pada pesan menggunakan `nl2br()`.
- Melanjutkan latihan PHP dasar dari P6: variabel, konstanta, operator, percabangan, `switch`, perulangan, `number_format()`, nilai `null`, `date()`, dan sintaks singkat `<?= ... ?>`.

## Isi Halaman

- **Beranda** menampilkan pengenalan mahasiswa dan mata kuliah.
- **Tentang Saya** menampilkan program studi, status, informasi semester, IPK, target belajar, dan contoh perulangan.
- **Kontak** menyediakan formulir dengan metode `POST`. Data wajib diisi sesuai aturan validasi sebelum ditampilkan kembali.
- Navigasi dapat dibuka dan ditutup pada tampilan yang lebih kecil menggunakan JavaScript.

## Struktur File

- `index.php` - halaman profil, formulir `POST`, validasi server, dan tampilan hasil.
- `indexGet.php` - contoh formulir dan pembacaan data dengan metode `GET`.
- `script.js` - validasi awal formulir dan kontrol navigasi.
- `style.css` - tata letak dan tampilan halaman.
- `img/` - aset gambar profil.

## Menjalankan

1. Pastikan Laragon atau server web lokal dengan PHP aktif.
2. Buka alamat utama proyek melalui browser:

   `http://localhost/PWD/2627o/ti1a/2611500001-PWD-TI1A-2627O/pertemuan-07/`

3. Untuk mencoba contoh `GET`, buka `indexGet.php` pada folder yang sama. Nilai yang dikirim dengan metode `GET` akan menjadi bagian dari URL.
4. Untuk mencoba form utama, kirim formulir pada halaman `index.php`. Coba kirim data kosong atau tidak sesuai untuk melihat validasi, lalu lengkapi data untuk melihat hasil yang diterima server.
