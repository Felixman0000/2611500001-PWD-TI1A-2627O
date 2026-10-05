# Pertemuan 4 - CSS3 Layout dan Responsive Web Design

## Pengembangan

- Perubahan yang dilakukan: membuat halaman profil dengan layout yang terpisah dari HTML ke file CSS, menerapkan CSS Box Model, Flexbox untuk navigasi, CSS Grid untuk tata letak utama, serta responsive design mobile-first agar tampil baik pada layar kecil dan desktop.
- Commit dan push GitHub: proses commit/push selalu saya lakukan ketika sudah selesai mengerjakan?memodif web.

## Pengujian

- Perangkat bergerak: viewport (< 768px). Hasil pengujian menunjukkan navigasi tampil vertikal (`flex-direction: column`), layout utama menjadi satu kolom, konten tetap terbaca, dan tidak terjadi overflow yang signifikan. Lebar konten sekitar 418px tetap sesuai dengan viewport mobile.
- Desktop: viewport (>= 768px). Hasil pengujian menunjukkan navigasi berubah menjadi horizontal (`flex-direction: row`), layout utama terbentuk dua kolom, dan section `contact` berada di bawah area utama dengan tata letak yang rapi.
- Galat dan perbaikan: terdapat beberapa galat pada CSS awal, seperti typo `background-color: #3b9089;s`, media query yang tidak valid, dan deklarasi navigasi yang tumpang tindih. Galat tersebut diperbaiki dengan membenarkan syntax CSS, menata aturan responsif secara benar, dan mengatur layout mobile-first agar konsisten di semua ukuran layar.
- Validasi CSS: pemeriksaan editor dan browser DevTools menunjukkan tidak ada error pada file `style.css` dan `index.html`. Upaya validasi formal ke W3C CSS Validation Service juga dilakukan, namun dibatasi oleh Cloudflare 403 di lingkungan saat ini, sehingga validasi otomatis pihak ketiga tidak bisa dijalankan sepenuhnya. Dengan demikian, validasi yang dapat dibuktikan secara langsung di sini adalah hasil pemeriksaan file dan pengujian layout di browser.
