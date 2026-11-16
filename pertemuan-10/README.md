# P10 - Analisis Kebutuhan Data dan Dasar MySQL

Pada pertemuan 10, kebutuhan data untuk basis data ditentukan berdasarkan delapan field formulir Kontak P9, tanpa memasukkan informasi profil mahasiswa. NIM yang digunakan adalah `2611500001`, sesuai nilai NIM pada `index.php`. Dengan pola penamaan `db_pwd_<NIM>` untuk basis data dan `tbl_kontak_<NIM>` untuk tabel, basis data yang digunakan bernama `db_pwd_2611500001` dan tabelnya bernama `tbl_kontak_2611500001`. Rancangan tabel terdiri atas sembilan atribut, yaitu delapan data dari formulir dan kolom `id` sebagai `INT PRIMARY KEY AUTO_INCREMENT`.

Delapan data formulir yang direncanakan untuk disimpan adalah nama lengkap, email, semester, tanggal kunjungan, jenis pesan, topik yang diminati, program studi, dan pesan. Pada `index.php`, nama lengkap dikirim melalui input teks dengan atribut `name="nama"`, email menggunakan `name="email"` pada input bertipe email, semester menggunakan `name="semester"` pada input angka, dan tanggal kunjungan menggunakan `name="tanggal"` pada input tanggal. Jenis pesan dikirim melalui dua pilihan radio dengan atribut `name="jenis_pesan"`, sedangkan topik yang diminati dipilih melalui checkbox `name="minat[]"`. Program studi dipilih melalui elemen `<select>` bernama `prodi`, sementara isi pesan dikirim melalui elemen `<textarea>` bernama `pesan`. Delapan nama data tersebut sesuai dengan key yang dibaca PHP untuk `$_SESSION["form_data"]`. Informasi profil seperti NIM (`$nim`), nama mahasiswa (`$namaMahasiswa`), dan program studi profil (`$programStudi`) tidak dikirim melalui form Kontak sehingga tidak termasuk ke dalam data formulir.

Delapan atribut yang berasal dari form Kontak adalah:

- `nama`: nama lengkap pengguna.
- `email`: alamat email pengguna.
- `semester`: nomor semester.
- `tanggal`: tanggal kunjungan.
- `jenis_pesan`: pilihan pertanyaan atau saran.
- `minat`: pilihan HTML, CSS, atau kombinasi keduanya.
- `prodi`: kode program studi SI atau TI.
- `pesan`: teks pesan pengguna.

Checkbox minat menyediakan pilihan HTML dengan nilai `HTML` dan CSS dengan nilai `CSS`. Tanda kurung siku pada `minat[]` membuat PHP menerima pilihan sebagai larik, misalnya `["HTML", "CSS"]` ketika keduanya dipilih. Untuk kebutuhan latihan P10, nilai larik tersebut direpresentasikan sebagai teks di satu kolom `minat`, dengan pilihan dipisahkan koma. Karena itu, satu pilihan HTML tersimpan sebagai `HTML`, satu pilihan CSS tersimpan sebagai `CSS`, dan kedua pilihan tersimpan sebagai `HTML, CSS`. Penyimpanan beberapa pilihan dalam satu kolom digunakan untuk menyederhanakan praktik ini, walaupun bukan bentuk normalisasi basis data yang ideal.

Pada tahap pemeriksaan rancangan struktur tabel, tabel `tbl_kontak_2611500001` ditetapkan memiliki sembilan atribut. Kolom `id` bertipe `INT`, berfungsi sebagai `PRIMARY KEY`, dan menggunakan `AUTO_INCREMENT` agar setiap baris mendapat identitas unik secara otomatis. Kolom `nama` memakai `VARCHAR(50)` untuk nama hingga 50 karakter, sedangkan `email` memakai `VARCHAR(255)`. Kolom `semester` memakai `TINYINT` untuk nomor semester dalam rentang 1 sampai 14, sementara `tanggal` memakai tipe `DATE`. Kolom `jenis_pesan` memakai `VARCHAR(20)` untuk pilihan `pertanyaan` atau `saran`, `minat` memakai `VARCHAR(50)` untuk menyimpan satu atau beberapa topik sebagai teks, `prodi` memakai `VARCHAR(2)` untuk kode `SI` atau `TI`, dan `pesan` memakai `VARCHAR(300)` untuk teks pesan hingga 300 karakter. Secara umum, `VARCHAR(n)` menyimpan teks sampai dengan panjang `n`, `TINYINT` menyimpan bilangan bulat berukuran kecil, dan `DATE` menyimpan nilai tanggal. Nama kolom mengikuti atribut `name` pada formulir; khusus `minat[]`, tanda kurung siku menunjukkan bahwa nilai masukan berupa larik, sedangkan nama kolomnya tetap `minat`.

Rancangan sembilan atribut tabel dapat diringkas sebagai berikut:

- `id`: `INT PRIMARY KEY AUTO_INCREMENT` sebagai identitas unik yang dibuat MySQL.
- `nama`: `VARCHAR(50)` untuk nama lengkap.
- `email`: `VARCHAR(255)` untuk alamat email.
- `semester`: `TINYINT` untuk nomor semester 1 sampai 14.
- `tanggal`: `DATE` untuk tanggal kunjungan.
- `jenis_pesan`: `VARCHAR(20)` untuk `pertanyaan` atau `saran`.
- `minat`: `VARCHAR(50)` untuk pilihan topik dalam bentuk teks.
- `prodi`: `VARCHAR(2)` untuk kode `SI` atau `TI`.
- `pesan`: `VARCHAR(300)` untuk teks pesan.

Hasil pemeriksaan rancangan menunjukkan bahwa batas panjang nama dan pesan sesuai dengan atribut `maxlength` pada form, dan rentang semester dapat disimpan dengan `TINYINT`. Pilihan jenis pesan, gabungan topik minat, dan kode program studi juga muat pada panjang `VARCHAR` yang ditentukan. Input email belum memiliki `maxlength`, sehingga `VARCHAR(255)` merupakan kapasitas kolom yang dipilih dan validasi panjang aplikasi tetap perlu diterapkan saat penyimpanan ke basis data dilakukan. Kolom `id` bukan data yang dikirim dari formulir; primary key membedakan setiap baris, sedangkan `AUTO_INCREMENT` membuat MySQL memberikan nilai berikutnya secara otomatis, misalnya `1`, `2`, dan `3`, termasuk saat beberapa baris memiliki nama yang sama.

Pemeriksaan awal melalui phpMyAdmin pada basis data `db_pwd_2611500001`, sebelum uji `INSERT`, menunjukkan satu record di tabel `tbl_kontak_2611500001`. Record dengan `id=1` berisi nama `Ghanwen`, email `Jancok@gmail.com`, semester `2`, tanggal `2026-11-27`, jenis pesan `ntalah`, minat `HTML`, program studi `Ti`, dan pesan `pele`. Seluruh kolom telah terisi, tanggal tersimpan dalam bentuk tanggal, semester berupa angka, dan teks berada dalam kapasitas kolom. Akan tetapi, `jenis_pesan` seharusnya bernilai `pertanyaan` atau `saran`, sedangkan `prodi` seharusnya bernilai `SI` atau `TI` dengan kapitalisasi yang sesuai. Struktur tabel tidak memiliki batasan `CHECK`, sehingga MySQL menerima nilai teks yang tidak sesuai pilihan tersebut. Pada saat pemeriksaan kode, submit form Kontak di `index.php` masih menyimpan nilai ke `$_SESSION["form_data"]` dan belum menjalankan `INSERT` ke MySQL; dengan demikian, record awal tersebut tercatat di tabel tetapi bukan hasil penyimpanan otomatis dari submit form itu.

Sebelum diperbaiki, nilai record awal adalah:

- `id`: `1`
- `nama`: `Ghanwen`
- `email`: `Jancok@gmail.com`
- `semester`: `2`
- `tanggal`: `2026-11-27`
- `jenis_pesan`: `ntalah` (tidak sesuai pilihan form)
- `minat`: `HTML`
- `prodi`: `Ti` (kapitalisasi tidak sesuai kode form)
- `pesan`: `pele`

Pada bagian E, penambahan data diuji dengan menjalankan perintah `INSERT INTO tbl_kontak_2611500001 (nama, email, semester, tanggal, jenis_pesan, minat, prodi, pesan) VALUES ('Uji INSERT P10', 'uji.insert@example.com', 1, '2026-11-16', 'pertanyaan', 'HTML, CSS', 'TI', 'Pengujian perintah INSERT');` pada basis data `db_pwd_2611500001`. Nama tabel sesuai dengan tabel yang dibuat, dan daftar delapan atribut cocok dengan delapan nilai yang diberikan dalam urutan nama, email, semester, tanggal, jenis pesan, minat, program studi, lalu pesan. Kolom `id` sengaja tidak disertakan karena nilainya dibuat otomatis oleh `AUTO_INCREMENT`. MySQL mengonfirmasi bahwa satu baris berhasil ditambahkan dengan `id=2`. Record baru berisi nama `Uji INSERT P10`, email `uji.insert@example.com`, semester `1`, tanggal `2026-11-16`, jenis pesan `pertanyaan`, minat `HTML, CSS`, program studi `TI`, dan pesan `Pengujian perintah INSERT`.

Nilai yang dimasukkan untuk pengujian `INSERT` adalah:

- `nama`: `Uji INSERT P10`
- `email`: `uji.insert@example.com`
- `semester`: `1`
- `tanggal`: `2026-11-16`
- `jenis_pesan`: `pertanyaan`
- `minat`: `HTML, CSS`
- `prodi`: `TI`
- `pesan`: `Pengujian perintah INSERT`

Pada pemeriksaan F.3, tabel `tbl_kontak_2611500001` dibuka melalui tab **Browse** di phpMyAdmin. Setelah uji `INSERT`, Browse menampilkan dua baris dengan sembilan atribut, yaitu kolom `id` dan delapan kolom data. Record uji dengan `id=2` terlihat lengkap sesuai nilai yang dimasukkan, termasuk kolom `minat` yang ditampilkan sebagai teks `HTML, CSS`, bukan sebagai larik atau nilai yang terpisah. Pemeriksaan tersebut memastikan data berhasil disimpan dan dapat dibaca kembali melalui phpMyAdmin.

Pemeriksaan kesesuaian lanjutan pada Browse menemukan bahwa dua nilai pada record `id=1` belum sesuai dengan ketentuan form P9. Melalui fasilitas **Edit** phpMyAdmin, `jenis_pesan` diubah dari `ntalah` menjadi `pertanyaan` dan `prodi` diubah dari `Ti` menjadi `TI`. PhpMyAdmin mengonfirmasi `1 row affected`, dengan pembaruan hanya pada dua kolom tersebut sehingga kolom lainnya pada record itu tidak berubah.

Setelah perbaikan, Browse menampilkan record pertama dengan `id=1`, nama `Ghanwen`, email `Jancok@gmail.com`, semester `2`, tanggal `2026-11-27`, jenis pesan `pertanyaan`, minat `HTML`, program studi `TI`, dan pesan `pele`. Record kedua tetap memiliki `id=2`, nama `Uji INSERT P10`, email `uji.insert@example.com`, semester `1`, tanggal `2026-11-16`, jenis pesan `pertanyaan`, minat `HTML, CSS`, program studi `TI`, dan pesan `Pengujian perintah INSERT`. Hasil pemeriksaan akhir menunjukkan bahwa kedua record tampil lengkap tanpa nilai yang hilang. Nama dan email terisi, kedua semester berada dalam rentang 1 sampai 14, tanggal menggunakan nilai tanggal yang valid, jenis pesan dan kode program studi sesuai dengan pilihan form, serta nilai minat berupa `HTML` atau gabungan `HTML, CSS` dalam bentuk teks. Kedua pesan tidak kosong dan panjangnya tidak melebihi batas 300 karakter. Nilai `id` tetap unik, dan `id=2` terbentuk otomatis saat perintah `INSERT` dijalankan.

Kriteria yang diperiksa pada kedua record meliputi:

- Nama terisi sebagai nama pengguna.
- Email berisi alamat email.
- Semester berupa nomor dalam rentang 1 sampai 14.
- Tanggal merupakan nilai tanggal yang valid.
- `jenis_pesan` bernilai `pertanyaan` atau `saran`.
- `minat` berisi `HTML`, `CSS`, atau kombinasi keduanya sebagai teks.
- `prodi` menggunakan kode `SI` atau `TI`.
- Pesan tidak kosong dan tidak melebihi 300 karakter.
- `id` unik dan dibuat otomatis.
