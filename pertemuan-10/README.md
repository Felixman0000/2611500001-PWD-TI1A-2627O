# P10 - Analisis Kebutuhan Data dan Dasar MySQL

## Ringkasan

## C.2 - Menentukan Data yang Akan Disimpan ke Basis Data

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

Informasi profil seperti NIM (`$nim`), nama mahasiswa (`$namaMahasiswa`), dan program studi profil (`$programStudi`) tidak dikirim dari form Kontak, sehingga tidak termasuk data formulir yang dianalisis untuk disimpan. Field Program Studi pada tabel adalah nilai pilihan `prodi` yang dikirim secara terpisah dari form Kontak. Penentuan nama kolom, tipe data basis data, dan kunci utama dibahas pada Bagian D.
