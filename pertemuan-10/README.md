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

## Langkah 3 - Modularisasi Fungsi

Fungsi `bersihkan()` dipindahkan ke `fungsi.php`, yang diawali dengan `<?php`. `index.php` memuatnya menggunakan `include 'fungsi.php';`.

### Pengujian

Halaman utama P9 berhasil dimuat setelah pemindahan. Uji dari file terpisah juga berhasil meng-include `fungsi.php` dan memanggil `bersihkan()`; markup uji tampil sebagai teks, bukan sebagai elemen HTML. File pengujian sementara sudah dihapus.

## Langkah 4 - Session Formulir sebagai Array

Data formulir Kontak disimpan dalam satu `$_SESSION["form_data"]` yang berisi array asosiatif. Key mengikuti atribut `name` pada form: `nama`, `email`, `semester`, `tanggal`, `jenis_pesan`, `minat`, `prodi`, dan `pesan`. Hasilnya ditampilkan dengan `foreach` dan array label. Data session lama yang masih terpisah dibersihkan ketika form Kontak dikirim.

### Pengujian

Form Kontak berhasil dikirim dan hasil delapan field tampil. Checkbox `minat[]` ditampilkan sebagai daftar yang dipisahkan koma, dan baris baru pada pesan tetap ditampilkan. Halaman menggunakan pola Post-Redirect-Get.

## Konsep yang Dipraktikkan

- Array terindeks menggunakan nomor urut seperti `[0]` dan `[1]`; `count()` dapat menghitung jumlah elemennya.
- Array asosiatif menggunakan key bernama seperti `['nama']`. Array multidimensi menyimpan array lain sebagai elemen, sehingga dapat digunakan untuk mengelompokkan beberapa struktur data.
- Fungsi custom didefinisikan dengan `function`, menerima parameter di dalam tanda kurung, dan menggunakan `return` untuk mengembalikan nilai. Hindari nama yang sudah dipakai fungsi bawaan PHP.
- `include` menampilkan warning bila file tidak ditemukan tetapi eksekusi berlanjut. `require` menghentikan eksekusi jika file tidak ditemukan.

## Demo Opsional: Fungsi `tebal()`

Fungsi `tebal($teks)` pada `fungsi.php` mengembalikan teks di dalam elemen `<strong>`. Fungsi ini digunakan untuk menampilkan label hasil Kontak dengan huruf tebal. Teks label tetap dilewatkan ke `bersihkan()` sebelum dibungkus HTML.

### Pengujian

Setelah halaman P9 dimuat ulang, label pada hasil Kontak tetap tampil tebal dan nilai formulir tetap tampil normal.
