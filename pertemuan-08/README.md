# P8 - UTS

## Ringkasan

P8 melanjutkan halaman profil mahasiswa dari P6 dengan mempelajari pengiriman dan pemrosesan data formulir menggunakan PHP. Halaman utama menampilkan profil secara dinamis dan menyediakan formulir kontak untuk mengirim data ke server.

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
