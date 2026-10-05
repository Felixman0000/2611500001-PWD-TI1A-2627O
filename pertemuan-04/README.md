# Pertemuan 04 - Responsive Layout dan CSS Modern

## 1. Ringkasan pengembangan

Pada pertemuan ini, halaman profil dibuat dengan struktur HTML yang terpisah dari file CSS. File utama tampilan berada di `index.html`, sementara styling diletakkan di `style.css` sesuai dengan apa yang diminta.

Proses pengembangan fokus pada:

- penerapan CSS Box Model pada elemen utama;
- penggunaan Flexbox untuk navigasi header;
- penggunaan CSS Grid untuk tata letak halaman utama;
- desain responsif dengan pendekatan mobile-first;
- pengecekan layout pada viewport mobile dan desktop;
- perbaikan galat CSS dan dokumentasi hasil pengujian.

## 2. Galat yang ditemukan dan perbaikan

Saat awal pengecekan, terdapat beberapa masalah pada file CSS:

- `header li a:active` memiliki typo pada deklarasi warna:
  `background-color: #3b9089;s`
  Kesalahan ini menyebabkan deklarasi tidak valid dan efek hover/active tidak bekerja dengan baik.
- Blok `@media` tidak valid karena bentuknya `@media (max-width: 600px) { ... }.` yang mengandung titik dan placeholder yang tidak lengkap.
- Navigasi `header ul` dideklarasikan dua kali dengan aturan yang berbeda, sehingga alur layout mobile/desktop menjadi tidak konsisten.
- Layout utama belum mengikuti pola mobile-first dan belum menggunakan CSS Grid secara optimal.

Perbaikan yang dilakukan:

- menghapus typo CSS invalid;
- mengubah media query menjadi struktur yang valid dan mobile-first;
- memindahkan pengaturan nav ke layout mobile pertama, lalu mengubah ke arah horizontal di desktop;
- mengatur `main` menggunakan CSS Grid untuk memisahkan section `home`, `about`, dan `contact` pada desktop;
- menambahkan spacing, border radius, dan konsistensi box model agar lebih rapi.

## 3. Hasil pengujian tampilan

(< 768px)
Pengujian dilakukan pada ukuran sekitar 375 x 812.

Hasil:

- navigasi berubah menjadi stacked/vertikal;
- lebar konten mengikuti viewport dengan ruang yang cukup;
- tombol dan input form tetap rapi;
- layout tidak mengalami overflow yang signifikan.

Catatan bukti dari DevTools:

- `header nav ul` memiliki `flex-direction: column`;
- `main` tetap satu kolom dengan lebar sekitar 410px pada viewport mobile;
- form tetap berada dalam ruang yang sama tanpa melampaui layar.

(>= 768px)
Pengujian dilakukan pada ukuran sekitar 1280 x 800.

Hasil:

- navigasi berubah menjadi horizontal dengan `flex-direction: row`;
- `main` menggunakan layout dua kolom di desktop; `home` dan `about` berdampingan;
- section `contact` ditampilkan pada baris penuh di bawah area utama;
- ruang antar elemen lebih lega dan lebih cocok untuk layar lebar.

Catatan bukti dari DevTools:

- `header nav ul` memiliki `flex-direction: row`;
- `main` memiliki `grid-template-columns: 431.876px 648.008px` pada layout desktop;
- `#home` dan `#about` tampil berdampingan dengan posisi yang sesuai.

## 4. Hasil Validasi CSS

Pemeriksaan file CSS menggunakan editor dan browser DevTools menunjukkan tidak ada error sintaks yang terdeteksi untuk `style.css` dan `index.html`.

Upaya validasi formal melalui layanan W3C CSS Validation Service juga dilakukan, namun pada lingkungan sandbox saat ini terjadi pembatasan akses dari Cloudflare (HTTP 403), sehingga validasi otomatis melalui server pihak ketiga tidak dapat dijalankan sepenuhnya dari sini. Karena itu, validasi yang bisa dibuktikan secara langsung di lingkungan ini adalah:

- pemeriksaan editor: tidak ada error pada file CSS/HTML;
- pengecekan layout di browser DevTools;
- perbaikan galat syntax yang ditemukan pada CSS.
