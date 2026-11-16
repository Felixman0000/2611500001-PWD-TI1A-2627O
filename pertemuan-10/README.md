# P10 - Analisis Kebutuhan Data dan Dasar MySQL

## Ringkasan

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

## C.3 - Menangani Field `minat` dengan Beberapa Pilihan

**Hasil pemeriksaan:** kedua checkbox topik pada form Kontak di `index.php` menggunakan atribut `name="minat[]"`. Checkbox HTML memiliki `value="HTML"`, sedangkan checkbox CSS memiliki `value="CSS"`. Tanda kurung siku pada atribut `name` membuat pilihan yang dikirim PHP diterima sebagai larik, misalnya `["HTML", "CSS"]` saat kedua topik dipilih.

Untuk rancangan P10 yang menggunakan satu tabel, nilai larik `minat` direpresentasikan sebagai teks dengan pilihan dipisahkan koma dalam satu kolom:

| Pilihan pengguna | Nilai pada kolom `minat` |
| ---------------- | ------------------------ |
| HTML             | `HTML`                   |
| CSS              | `CSS`                    |
| HTML dan CSS     | `HTML, CSS`              |

Representasi satu kolom ini menyederhanakan praktik penyimpanan sesuai ruang lingkup P10. Menyimpan beberapa pilihan dalam satu kolom bukan normalisasi basis data yang ideal; pendekatan ini digunakan untuk kebutuhan pembelajaran.
