# P9 - Pengolahan Data Formulir dengan PHP

## Ringkasan

P9 melanjutkan artefak profil mahasiswa dari P8. Halaman menggunakan PHP untuk menampilkan informasi profil, memproses formulir kontak, dan menerima rencana kegiatan mahasiswa. Data formulir kegiatan divalidasi di server, disimpan sementara menggunakan session, lalu ditampilkan kembali pada halaman.

## Langkah 1 - Baseline

Bahan awal P9 menggunakan `img`, `index.php`, `script.js`, dan `style.css` dari P8. README dan file khusus P9 tidak disalin sebagai bagian dari bahan baseline. Pada tahap ini, `index.php` masih menggunakan pemanggilan `htmlspecialchars()` langsung; fungsi custom belum ditambahkan.

### Pengujian

P8 dan P9 berhasil dibuka melalui localhost Laragon. Konten profil, navigasi, formulir, dan bagian halaman pada tampilan awal P9 sama dengan P8.

## Langkah 2 - Fungsi `bersihkan()`

Fungsi custom `bersihkan($teks)` ditambahkan ke `index.php`. Fungsi mengembalikan `htmlspecialchars($teks, ENT_QUOTES, 'UTF-8')`. Pemanggilan `htmlspecialchars()` langsung pada output halaman diganti dengan `bersihkan()`; pemanggilan di dalam fungsi adalah satu-satunya yang dipertahankan.

### Pengujian

Uji lokal memakai `<h1>Judul uji</h1><script>alert('hi')</script>`. Tanpa `bersihkan()`, browser menampilkan judul sebagai heading dan menjalankan alert. Dengan `bersihkan()`, seluruh markup tampil sebagai teks dan tidak dijalankan. File uji sementara sudah dihapus setelah pengujian. Halaman utama P9 dimuat kembali tanpa error.
