# P5 - JavaScript Dasar, DOM, Event, dan Validasi Sisi Klien

Dokumentasi pengembangan halaman web P5 yang membahas JavaScript dasar, manipulasi DOM, event listener, navigasi, dan validasi formulir sisi klien.

## Fitur dan Pengembangan

- Menu navigasi dengan event listener: `script.js` mencoba memasang event `click` pada tombol menu dan mengubah class `active` pada elemen navigasi. Saat ini tombol di `index.html` hanya memiliki class `menu-toggle`, sedangkan JavaScript mencari elemen dengan ID `menu-toggle`; akibatnya event listener tidak terpasang.
- Navigasi antarbagian halaman: Halaman menyediakan bagian Beranda, Tentang, dan Kontak. Tautan navigasi saat ini menggunakan alamat relatif `home`, `about`, dan `contact`, bukan referensi ID bagian (`#home`, `#about`, `#contact`), sehingga belum mengarah ke bagian yang dimaksud.
- Validasi formulir sisi klien: Formulir menggunakan validasi bawaan browser melalui tipe input dan atribut seperti `required`, `minlength`, `maxlength`, `autocomplete`, serta batas tanggal lahir. Pilihan prediksi wajib diisi, sedangkan pilihan program studi bersifat opsional.

## Pengujian

- Event menu dan manipulasi DOM: Pemeriksaan kode menunjukkan JavaScript mencari `#menu-toggle`, tetapi tombol tidak memiliki ID tersebut. Karena itu, event klik tidak dapat dipasang dan menu belum dapat diuji sebagai interaksi yang berfungsi.
- Navigasi halaman: Pemeriksaan tautan menunjukkan nilai `href` tidak menggunakan ID bagian. Navigasi ke bagian Beranda, Tentang, dan Kontak belum sesuai tujuan.
- Validasi formulir: Pemeriksaan atribut HTML mengonfirmasi aturan wajib isi, tipe email, panjang nama dan nomor telepon, serta batas tanggal lahir. Pengujian pengiriman formulir langsung di browser belum dilakukan; formulir mengirim data ke `proses.php`.

## Riwayat Pengembangan

- Dari P4, saya mencommit perubahan pada style.css dan index.html. Artefak P4 yang saya pindahkan ke P5 saya tambahkan dengan tombol hamburger sesuai dengan yang diminta di PWD.
