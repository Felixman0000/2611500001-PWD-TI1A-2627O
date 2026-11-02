# P8 - UTS

## Ringkasan

P8 melanjutkan halaman profil mahasiswa dari P6 dan berlatih pemrosesan formulir menggunakan PHP. Halaman utama memiliki formulir Kontak dan formulir Rencana Kegiatan Mahasiswa. Contoh formulir `GET` tersedia terpisah di `indexGet.php`.

## Fitur dan Materi

- Formulir Kontak dikirim dengan metode `POST`. JavaScript memeriksa nama, email, semester, tanggal kunjungan, jenis pesan, minimal satu topik minat, program studi, dan pesan.
- Data Kontak disimpan pada session PHP dan ditampilkan kembali setelah redirect ke `#contact`.
- Formulir Rencana Kegiatan Mahasiswa menyediakan nama kegiatan, kategori, tanggal pelaksanaan, lokasi, dan deskripsi.
- Formulir kegiatan divalidasi di JavaScript dan divalidasi ulang di PHP. Batasnya adalah nama 100 karakter, lokasi 150 karakter, deskripsi 1000 karakter, kategori yang tersedia, serta tanggal kalender yang valid.
- Formulir kegiatan menggunakan pola Post-Redirect-Get (PRG). Data yang valid disimpan per field pada session dan ditampilkan setelah redirect ke `#rencana-kegiatan`.
- Jika validasi kegiatan gagal, pesan kesalahan dan nilai isian disimpan sementara di session; nilai isian ditampilkan kembali setelah redirect.
- Output yang berasal dari pengguna di-escape dengan `htmlspecialchars()`. Deskripsi kegiatan ditampilkan dengan `nl2br()` agar baris baru tetap terlihat.
- `indexGet.php` menunjukkan pembacaan nilai query menggunakan `$_GET`.
- Navigasi responsif menggunakan JavaScript untuk membuka dan menutup menu pada layar kecil.
- Materi PHP dari P6 tetap ditampilkan: variabel, konstanta, operator, percabangan, `switch`, perulangan, `number_format()`, `null`, `date()`, dan sintaks `<?= ... ?>`.

## Bagian Halaman

- **Beranda** menampilkan pengenalan mahasiswa dan mata kuliah.
- **Tentang Saya** menampilkan profil, status mahasiswa, informasi semester, IPK, target belajar, dan contoh perulangan.
- **Kontak** menampilkan form dan hasil data Kontak yang dikirim.
- **Rencana Kegiatan Mahasiswa** berada setelah Kontak dan menampilkan form, pesan validasi, serta hasil kegiatan yang dikirim.

## Hasil Pengujian

Pengujian manual dilakukan melalui halaman lokal Laragon di browser. Halaman profil, bagian Beranda dan Tentang Saya berhasil dimuat. Tautan menu Kontak dan Rencana Kegiatan juga mengarahkan pengguna ke section yang sesuai.

Pada formulir Rencana Kegiatan, pengiriman dalam keadaan kosong menampilkan validasi JavaScript. Data yang valid berhasil dikirim menggunakan POST, diproses, lalu ditampilkan setelah redirect PRG. Validasi sisi server turut diuji dengan mengirim data kategori dan tanggal yang tidak valid tanpa melewati JavaScript; PHP menolak data tersebut, menampilkan pesan kesalahan, dan mempertahankan nilai isian lainnya. Teks masukan yang berisi markup HTML tampil sebagai teks biasa, bukan dieksekusi. Setelah halaman dimuat ulang, hasil tetap tampil tanpa mengirim ulang POST.

Formulir Kontak juga menolak pengiriman kosong dan berhasil memproses serta menampilkan data yang valid setelah redirect. Hasil Kontak tetap tersedia saat hasil Rencana Kegiatan disimpan. Contoh GET di `indexGet.php` menerima dan menampilkan parameter uji. Tidak ditemukan JavaScript runtime error pada halaman utama.

Pemeriksaan lint PHP melalui terminal belum dapat dikonfirmasi pada sesi ini karena terminal tidak menampilkan hasil perintah. Pengujian browser memastikan halaman PHP berhasil dirender dan alur formulir berjalan.

Pemeriksaan lint PHP melalui terminal belum dapat dikonfirmasi pada sesi ini karena terminal tidak menampilkan hasil perintah. Pengujian browser memastikan halaman PHP berhasil dirender dan alur formulir berjalan.
