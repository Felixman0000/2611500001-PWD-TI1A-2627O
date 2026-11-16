# P10 - Analisis Kebutuhan Data dan Dasar MySQL

## Ringkasan

## Menentukan Nama Basis Data dan Tabel

NIM mahasiswa yang digunakan pada P10 adalah `2611500001`, sesuai nilai NIM pada `index.php`. Dengan pola penamaan `db_pwd_<NIM>` untuk basis data dan `tbl_kontak_<NIM>` untuk tabel, nama yang digunakan adalah:

- Nama basis data: `db_pwd_2611500001`
- Nama tabel: `tbl_kontak_2611500001`

## Menentukan Data yang Akan Disimpan ke Basis Data

Data yang direncanakan untuk disimpan ke basis data dibatasi pada delapan nilai yang dikirim melalui form Kontak di `index.php`: nama lengkap, email, semester, tanggal kunjungan, jenis pesan, topik yang diminati, program studi, dan pesan. Pemeriksaan menunjukkan setiap data sesuai dengan atribut `name` dan elemen formulir berikut:

| Data                | Atribut `name` | Jenis input/elemen                                            |
| ------------------- | -------------- | ------------------------------------------------------------- |
| Nama Lengkap        | `nama`         | `input type="text"`                                           |
| Email               | `email`        | `input type="email"`                                          |
| Semester            | `semester`     | `input type="number"`                                         |
| Tanggal Kunjungan   | `tanggal`      | `input type="date"`                                           |
| Jenis Pesan         | `jenis_pesan`  | `input type="radio"` (pilihan Pertanyaan atau Saran)          |
| Topik yang Diminati | `minat[]`      | `input type="checkbox"` (dapat memilih lebih dari satu topik) |
| Program Studi       | `prodi`        | elemen `<select>`                                             |
| Pesan               | `pesan`        | elemen `<textarea>`                                           |

**Hasil pengujian:** kedelapan data pada tabel cocok dengan elemen form Kontak dan key yang dibaca PHP untuk `$_SESSION["form_data"]`. `minat[]` sengaja memakai tanda kurung siku agar beberapa pilihan checkbox dikirim sebagai array.

Informasi profil seperti NIM (`$nim`), nama mahasiswa (`$namaMahasiswa`), dan program studi profil (`$programStudi`) tidak dikirim dari form Kontak, sehingga tidak termasuk data formulir yang dianalisis untuk disimpan. Field Program Studi pada tabel adalah nilai pilihan `prodi` yang dikirim secara terpisah dari form Kontak.

## Menangani Field `minat` dengan Beberapa Pilihan

**Hasil pemeriksaan:** kedua checkbox topik pada form Kontak di `index.php` menggunakan atribut `name="minat[]"`. Checkbox HTML memiliki `value="HTML"`, sedangkan checkbox CSS memiliki `value="CSS"`. Tanda kurung siku pada atribut `name` membuat pilihan yang dikirim PHP diterima sebagai larik, misalnya `["HTML", "CSS"]` saat kedua topik dipilih.

Untuk rancangan P10 yang menggunakan satu tabel, nilai larik `minat` direpresentasikan sebagai teks dengan pilihan dipisahkan koma dalam satu kolom:

| Pilihan pengguna | Nilai pada kolom `minat` |
| ---------------- | ------------------------ |
| HTML             | `HTML`                   |
| CSS              | `CSS`                    |
| HTML dan CSS     | `HTML, CSS`              |

Representasi satu kolom ini menyederhanakan praktik penyimpanan sesuai ruang lingkup P10. Menyimpan beberapa pilihan dalam satu kolom bukan normalisasi basis data yang ideal; pendekatan ini digunakan untuk kebutuhan pembelajaran.

## Menentukan Atribut dan Tipe Data

Berdasarkan delapan data formulir Kontak dan satu kolom identitas otomatis, rancangan kolom untuk tabel `tbl_kontak_2611500001` adalah sebagai berikut:

| No. | Atribut       | Tipe data      | Ketentuan                       | Keterangan                                                                              |
| --- | ------------- | -------------- | ------------------------------- | --------------------------------------------------------------------------------------- |
| 1   | `id`          | `INT`          | `PRIMARY KEY`, `AUTO_INCREMENT` | Identitas unik setiap data kontak, dibuat otomatis.                                     |
| 2   | `nama`        | `VARCHAR(50)`  |                                 | Menyimpan nama lengkap, maksimal 50 karakter sesuai batas formulir.                     |
| 3   | `email`       | `VARCHAR(255)` |                                 | Menyimpan alamat email. Input menggunakan `type="email"` untuk memeriksa format alamat. |
| 4   | `semester`    | `TINYINT`      |                                 | Menyimpan nomor semester 1 sampai 14.                                                   |
| 5   | `tanggal`     | `DATE`         |                                 | Menyimpan tanggal kunjungan.                                                            |
| 6   | `jenis_pesan` | `VARCHAR(20)`  |                                 | Menyimpan pilihan jenis pesan, yaitu `pertanyaan` atau `saran`.                         |
| 7   | `minat`       | `VARCHAR(50)`  |                                 | Menyimpan satu atau beberapa pilihan minat sebagai teks, misalnya `HTML, CSS`.          |
| 8   | `prodi`       | `VARCHAR(2)`   |                                 | Menyimpan kode program studi, yaitu `SI` atau `TI`.                                     |
| 9   | `pesan`       | `VARCHAR(300)` |                                 | Menyimpan isi pesan, maksimal 300 karakter sesuai batas formulir.                       |

`VARCHAR(n)` digunakan untuk teks dengan panjang maksimal `n` karakter, `TINYINT` untuk bilangan bulat berukuran kecil, dan `DATE` untuk nilai tanggal. Nama kolom mengikuti atribut `name` pada form; khusus `minat[]`, tanda kurung siku menandakan nilai masukan berupa larik, sedangkan nama kolom penyimpanannya adalah `minat`.

**Hasil pemeriksaan:** ukuran `nama` dan `pesan` sesuai dengan `maxlength` pada form. Rentang semester 1–14 dapat disimpan dengan `TINYINT`; pilihan `jenis_pesan`, gabungan topik `minat`, dan kode `prodi` juga muat pada panjang `VARCHAR` yang ditentukan. Input email saat ini belum menetapkan `maxlength`; `VARCHAR(255)` adalah kapasitas kolom yang dipilih untuk rancangan P10, sehingga validasi panjang aplikasi perlu ditambahkan saat penyimpanan ke basis data diterapkan.

## Menentukan Primary Key dan `AUTO_INCREMENT`

Kolom `id` bertipe `INT` ditetapkan sebagai `PRIMARY KEY` dan menggunakan `AUTO_INCREMENT`. Primary key membedakan setiap baris, sedangkan `AUTO_INCREMENT` membuat MySQL memberikan nilai id berikutnya secara otomatis ketika record baru ditambahkan. Kolom ini merupakan identitas data dan tidak berasal dari salah satu field formulir Kontak. Contoh nilai berurutan adalah `1`, `2`, dan `3`; id tetap membedakan record meskipun beberapa record memiliki nama yang sama.
