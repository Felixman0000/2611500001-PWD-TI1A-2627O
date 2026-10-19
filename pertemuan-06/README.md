# P6 - PHP Dasar

## Deskripsi

P6 mengembangkan salinan proyek P5 menjadi halaman PHP dinamis. Fokus latihan ini adalah pemrosesan di sisi server; formulir dan pemrosesan data formulir tidak disertakan karena dibahas pada P7.

## Perubahan

- Menggunakan konstanta dan variabel bertipe string, integer, float, boolean, array, dan objek tanggal/waktu.
- Menggunakan operator aritmetika, perbandingan, kenaikan, penurunan, dan ternary.
- Menggunakan `if-elseif-else` untuk sapaan berdasarkan jam dan predikat nilai.
- Menggunakan `switch` untuk menerjemahkan nomor hari ke nama hari Indonesia.
- Menggunakan perulangan `for` untuk menampilkan enam pertemuan dan `while` untuk hitung mundur latihan.
- Menampilkan hasil PHP pada halaman profil dan mempertahankan navigasi responsif. Validasi form P5 tidak digunakan di P6.

## Cara Menjalankan

Dengan Laragon, nyalakan Apache lalu buka:

`http://localhost/PWD/2627o/ti1a/2611500001-PWD-TI1A-2627O/pertemuan-06/`

Alternatif menggunakan server bawaan PHP dari direktori utama repo:

```powershell
& 'C:\laragon\bin\php\php-8.3.33-Win32-vs16-x64\php.exe' -S 127.0.0.1:8000 -t .
```

Kemudian buka `http://127.0.0.1:8000/pertemuan-06/`. Pemeriksaan sintaks dari direktori utama repo:

```powershell
& 'C:\laragon\bin\php\php-8.3.33-Win32-vs16-x64\php.exe' -l pertemuan-06/index.php
```

## Hasil Pengujian Aktual

Pengujian dijalankan pada 19 Oktober 2026 menggunakan PHP 8.3.33.

- Pemeriksaan `php -l pertemuan-06/index.php`: **lulus**, tidak ditemukan galat sintaks.
- GET `http://127.0.0.1:8000/pertemuan-06/`: **HTTP 200**; halaman berhasil dirender di browser.
- Foto profil salinan lokal P6 identik dengan baseline P5 dan dapat diakses: **HTTP 200**.
- Pemeriksaan keluaran HTTP: **9 pemeriksaan lulus**, termasuk tahun akademik, status belajar, hasil operator/nilai `88 + 5,5 = 93,5`, sapaan pagi, nama hari Senin, enam butir perulangan `for`, dan hitung mundur `while` dari 3 sampai 1.
- Keluaran HTML tidak memuat form P5.

Kondisi yang aktif pada waktu pengujian menghasilkan sapaan pagi dan predikat "Sangat baik". Jalur waktu selain pagi dan predikat nilai lain belum diuji terpisah.

## Pengelolaan Git

Perubahan ditinjau dengan `git status` dan `git diff` sebelum dicatat. Catat tahap implementasi dan dokumentasi dengan pesan commit berbahasa Indonesia setelah pemeriksaan terkait lulus, lalu push branch yang digunakan ke GitHub. Riwayat commit sebaiknya menggambarkan tahap kerja yang benar-benar dilakukan.
