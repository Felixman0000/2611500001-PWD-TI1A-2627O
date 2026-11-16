# P10 - Analisis Kebutuhan Data dan Dasar MySQL

## Ringkasan

Pada P10, kebutuhan data untuk basis data ditentukan berdasarkan delapan field formulir Kontak P9, tanpa memasukkan informasi profil mahasiswa. Basis data dan tabel menggunakan NIM sebagai pembeda, yaitu `db_pwd_2611500001` dan `tbl_kontak_2611500001`. Rancangan tabel terdiri atas sembilan atribut: delapan data formulir dan `id` sebagai `INT PRIMARY KEY AUTO_INCREMENT`. Field `minat[]` disimpan sebagai teks dalam satu kolom dengan pilihan dipisahkan koma, sesuai ruang lingkup latihan.

## Menentukan Nama Basis Data dan Tabel

NIM mahasiswa yang digunakan pada P10 adalah `2611500001`, sesuai nilai NIM pada `index.php`. Dengan pola penamaan `db_pwd_<NIM>` untuk basis data dan `tbl_kontak_<NIM>` untuk tabel, basis data yang digunakan bernama `db_pwd_2611500001`, sedangkan tabelnya bernama `tbl_kontak_2611500001`.

## Menentukan Data yang Akan Disimpan ke Basis Data

Data yang direncanakan untuk disimpan ke basis data dibatasi pada delapan nilai yang dikirim melalui form Kontak di `index.php`, yaitu nama lengkap, email, semester, tanggal kunjungan, jenis pesan, topik yang diminati, program studi, dan pesan. Pada formulir tersebut, nama lengkap dikirim dengan atribut `name="nama"` melalui input teks, email menggunakan `name="email"` dan input bertipe email, sedangkan semester memakai `name="semester"` dengan input angka. Tanggal kunjungan menggunakan `name="tanggal"` pada input tanggal.

Jenis pesan dikirim melalui dua pilihan radio yang sama-sama menggunakan atribut `name="jenis_pesan"`. Topik yang diminati memakai checkbox bernama `minat[]`, sehingga pengguna dapat memilih lebih dari satu topik dan PHP menerimanya sebagai array. Program studi dipilih melalui elemen `<select>` dengan atribut `name="prodi"`, sementara pesan dikirim melalui elemen `<textarea>` bernama `pesan`.

**Hasil pengujian:** kedelapan data tersebut cocok dengan elemen form Kontak dan key yang dibaca PHP untuk `$_SESSION["form_data"]`. Tanda kurung siku pada `minat[]` digunakan agar beberapa pilihan checkbox dikirim sebagai array.

Informasi profil seperti NIM (`$nim`), nama mahasiswa (`$namaMahasiswa`), dan program studi profil (`$programStudi`) tidak dikirim dari form Kontak, sehingga tidak termasuk data formulir yang dianalisis untuk disimpan. Field Program Studi pada tabel adalah nilai pilihan `prodi` yang dikirim secara terpisah dari form Kontak.

## Menangani Field `minat` dengan Beberapa Pilihan

**Hasil pemeriksaan:** kedua checkbox topik pada form Kontak di `index.php` menggunakan atribut `name="minat[]"`. Checkbox HTML memiliki `value="HTML"`, sedangkan checkbox CSS memiliki `value="CSS"`. Tanda kurung siku pada atribut `name` membuat pilihan yang dikirim PHP diterima sebagai larik, misalnya `["HTML", "CSS"]` saat kedua topik dipilih.

Untuk rancangan P10 yang menggunakan satu tabel, nilai larik `minat` disimpan sebagai teks dalam satu kolom dengan pilihan dipisahkan koma. Jika pengguna hanya memilih HTML, nilai yang disimpan adalah `HTML`; jika hanya memilih CSS, nilainya adalah `CSS`; sedangkan jika keduanya dipilih, nilai kolom menjadi `HTML, CSS`.

Representasi satu kolom ini menyederhanakan praktik penyimpanan sesuai ruang lingkup P10. Menyimpan beberapa pilihan dalam satu kolom bukan normalisasi basis data yang ideal; pendekatan ini digunakan untuk kebutuhan pembelajaran.

## D.4 - Memeriksa Rancangan Struktur Tabel

Berdasarkan hasil perancangan sebelumnya, struktur akhir tabel `tbl_kontak_2611500001` terdiri atas sembilan atribut. Atribut pertama adalah `id` bertipe `INT` yang ditetapkan sebagai `PRIMARY KEY` dan menggunakan `AUTO_INCREMENT` untuk membentuk identitas unik setiap data secara otomatis. Atribut `nama` menggunakan `VARCHAR(50)` untuk menyimpan nama lengkap hingga 50 karakter, sedangkan `email` menggunakan `VARCHAR(255)` untuk menyimpan alamat email.

Atribut `semester` menggunakan `TINYINT` karena menyimpan nomor semester dalam rentang 1 sampai 14, dan `tanggal` menggunakan tipe `DATE` untuk menyimpan tanggal kunjungan. Atribut `jenis_pesan` bertipe `VARCHAR(20)` untuk menyimpan pilihan `pertanyaan` atau `saran`. Atribut `minat` menggunakan `VARCHAR(50)` agar satu atau beberapa topik dapat disimpan sebagai teks, misalnya `HTML, CSS`. Selanjutnya, `prodi` menggunakan `VARCHAR(2)` untuk menyimpan kode `SI` atau `TI`, sedangkan `pesan` menggunakan `VARCHAR(300)` untuk menyimpan isi pesan hingga 300 karakter.

`VARCHAR(n)` digunakan untuk teks dengan panjang maksimal `n` karakter, `TINYINT` untuk bilangan bulat berukuran kecil, dan `DATE` untuk nilai tanggal. Nama kolom mengikuti atribut `name` pada form; khusus `minat[]`, tanda kurung siku menandakan nilai masukan berupa larik, sedangkan nama kolom penyimpanannya adalah `minat`.

**Hasil pemeriksaan:** ukuran `nama` dan `pesan` sesuai dengan `maxlength` pada form. Rentang semester 1–14 dapat disimpan dengan `TINYINT`; pilihan `jenis_pesan`, gabungan topik `minat`, dan kode `prodi` juga muat pada panjang `VARCHAR` yang ditentukan. Input email saat ini belum menetapkan `maxlength`; `VARCHAR(255)` adalah kapasitas kolom yang dipilih untuk rancangan P10, sehingga validasi panjang aplikasi perlu ditambahkan saat penyimpanan ke basis data diterapkan.

**Hasil pemeriksaan akhir:** tabel berisi sembilan atribut. Delapan atribut formulir (`nama`, `email`, `semester`, `tanggal`, `jenis_pesan`, `minat`, `prodi`, dan `pesan`) sudah terwakili dengan tipe data sesuai karakteristik nilainya. Hanya `id` yang ditetapkan sebagai `PRIMARY KEY` dan `AUTO_INCREMENT`; `id` bukan data yang dikirim dari formulir.

## Menentukan Primary Key dan `AUTO_INCREMENT`

Kolom `id` bertipe `INT` ditetapkan sebagai `PRIMARY KEY` dan menggunakan `AUTO_INCREMENT`. Primary key membedakan setiap baris, sedangkan `AUTO_INCREMENT` membuat MySQL memberikan nilai id berikutnya secara otomatis ketika record baru ditambahkan. Kolom ini merupakan identitas data dan tidak berasal dari salah satu field formulir Kontak. Contoh nilai berurutan adalah `1`, `2`, dan `3`; id tetap membedakan record meskipun beberapa record memiliki nama yang sama.

## Hasil Pengujian Data pada Tabel

Pemeriksaan awal melalui phpMyAdmin pada basis data `db_pwd_2611500001`, sebelum uji `INSERT`, menunjukkan satu record di tabel `tbl_kontak_2611500001`. Data yang terbaca adalah sebagai berikut:

| Kolom         | Nilai              |
| ------------- | ------------------ |
| `id`          | `1`                |
| `nama`        | `Ghanwen`          |
| `email`       | `Jancok@gmail.com` |
| `semester`    | `2`                |
| `tanggal`     | `2026-11-27`       |
| `jenis_pesan` | `ntalah`           |
| `minat`       | `HTML`             |
| `prodi`       | `Ti`               |
| `pesan`       | `pele`             |

**Hasil pemeriksaan awal:** satu baris terbaca dan seluruh sembilan kolom memiliki nilai. `id` terisi otomatis dengan nilai `1`; nilai tanggal tersimpan dalam format `DATE`, semester berupa angka, dan nilai teks masih berada dalam kapasitas kolom masing-masing. Namun, `jenis_pesan` bernilai `ntalah`, bukan pilihan form `pertanyaan` atau `saran`; `prodi` bernilai `Ti`, bukan kode pilihan `SI` atau `TI` dengan kapitalisasi yang sesuai. Struktur tabel belum memiliki batasan `CHECK`, sehingga MySQL tetap menerima nilai teks tersebut. Data awal ini tidak diubah oleh uji `INSERT`.

Pemeriksaan kode `index.php` juga menunjukkan bahwa submit form Kontak saat ini menyimpan nilai ke `$_SESSION["form_data"]` dan belum menjalankan perintah `INSERT` ke MySQL. Karena itu, keberadaan record di tabel ini membuktikan data telah tercatat di tabel, tetapi belum membuktikan bahwa submit form otomatis menyimpannya ke basis data.

## E. Perintah `INSERT` dan Hasil Pengujian

Untuk menguji penambahan data, perintah berikut dijalankan pada basis data `db_pwd_2611500001`:

```sql
INSERT INTO `tbl_kontak_2611500001` (`nama`, `email`, `semester`, `tanggal`, `jenis_pesan`, `minat`, `prodi`, `pesan`)
VALUES ('Uji INSERT P10', 'uji.insert@example.com', 1, '2026-11-16', 'pertanyaan', 'HTML, CSS', 'TI', 'Pengujian perintah INSERT');
```

Nama tabel sesuai dengan tabel yang dibuat. Daftar atribut berisi delapan kolom data selain `id`, yang diisi otomatis oleh `AUTO_INCREMENT`. Klausa `VALUES` menyediakan delapan nilai dengan urutan yang sama seperti daftar kolom: nama, email, semester, tanggal, jenis pesan, minat, program studi, dan pesan.

**Hasil pengujian:** MySQL mengonfirmasi `1 row inserted` dengan `Inserted row id: 2`. Setelah itu, pemeriksaan `SELECT * FROM tbl_kontak_2611500001` menunjukkan dua baris total dan record baru berisi `Uji INSERT P10`, `uji.insert@example.com`, semester `1`, tanggal `2026-11-16`, jenis pesan `pertanyaan`, minat `HTML, CSS`, prodi `TI`, dan pesan `Pengujian perintah INSERT`. Hasil ini memastikan tabel, jumlah kolom dan nilai, urutan data, serta pembuatan `id` otomatis sesuai.
