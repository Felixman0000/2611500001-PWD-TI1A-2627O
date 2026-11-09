# P9 - Pengolahan Data Formulir dengan PHP

## Ringkasan

P9 melanjutkan artefak profil mahasiswa dari P8. Halaman menggunakan PHP untuk menampilkan informasi profil, memproses formulir kontak, dan menerima rencana kegiatan mahasiswa. Data formulir kegiatan divalidasi di server, disimpan sementara menggunakan session, lalu ditampilkan kembali pada halaman.

## Langkah 1 - Baseline

Bahan awal P9 menggunakan `img`, `index.php`, `script.js`, dan `style.css` dari P8. README dan file khusus P9 tidak disalin sebagai bagian dari bahan baseline. Pada tahap ini, `index.php` masih menggunakan pemanggilan `htmlspecialchars()` langsung; fungsi custom belum ditambahkan.

### Pengujian

Pengujian tampilan di localhost belum dapat dikonfirmasi karena halaman P9 belum berhasil dimuat melalui `http://localhost/`. Ulangi pemeriksaan saat Laragon berjalan dan pastikan halaman P9 tampil sama seperti P8 sebelum langkah ini di-commit dan di-push.
