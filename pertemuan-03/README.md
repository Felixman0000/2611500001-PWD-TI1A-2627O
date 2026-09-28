# Pertemuan 3 - Formulir HTML dan CSS Dasar

## Baseline

- Menggunakan hasil P2 sebagai dasar pengembangan P3.
- Menyalin `index.html` dan `img/foto-profil.jpg` ke `pertemuan-03/`.

## Implementasi Formulir

- Elemen form yang digunakan: `form`, `label`, `input`, `fieldset`, 'legend' dan ''button'
- Tipe input yang digunakan: `text`, `email`, `tel`, `date`, `checkbox`, `radio`
- Atribut validasi yang digunakan: `required`, `minlength`, `maxlength`, `autocomplete`, `max`

## Pengujian GET dan POST

- Hasil pengujian GET: Request GET ditolak oleh server karena file `proses.php` hanya menerima metode `POST` dan mengembalikan respons `405 Method Not Allowed`.
- Contoh URL encoding yang ditemukan: `name=Felix+Sebastian&email=felix%40example.com&phone=081234567890&tanggal_lahir=2008-01-07&prodi%5B%5D=pti&prodi%5B%5D=ti&prediksi=china`
- Hasil pengujian POST: Data formulir berhasil diproses jika dikirim dengan method `POST` ke `proses.php`, lalu ditampilkan pada halaman hasil pengiriman dengan validasi nama, email, telepon, tanggal lahir, dan pilihan jawaban.

## CSS Dasar

- Selector elemen: `body`, `h1`, `h2`, `footer`
- Selector class: `.profile-photo`, `.radio-group`, `.radio-options`, `.welcome-heading`
- Selector ID: `#home`, `#about`, `#contact`, `#name`, `#email`, `#phone`, `#tanggal-lahir`
- Properti CSS dasar yang digunakan: `color`, `background-color`, `font-family`, `margin`, `padding`, `border`, `width`, `height`, `display`, `box-sizing`, `text-align`, `hover` untuk interaksi tombol

## Pengujian dan Perbaikan

- Galat yang ditemukan: Formulir dikirim dengan metode default GET, bukan POST.
- Penyebab galat: Tag `form` tidak memiliki atribut `method="POST"` dan `action="proses.php"`.
- Perbaikan yang dilakukan: Menambahkan `method="POST"` dan `action="proses.php"` pada elemen `form` agar data diproses oleh `proses.php`.
- Hasil pengujian ulang: Setelah perbaikan, request dapat diproses dengan POST dan validasi server berjalan sesuai aturan.

## GitHub Pages

URL: https://felixman0000.github.io/2611500001-PWD-TI1A-2627O/pertemuan-03/
