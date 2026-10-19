# P6 - PHP Dasar

## Ringkasan

P6 mengembangkan salinan proyek P5 menjadi halaman profil mahasiswa yang dirender secara dinamis dengan PHP.

Pemrosesan formulir tidak disertakan karena menjadi materi P7.

## Pengujian

- `php -l pertemuan-06/index.php` : lulus, tidak ada galat sintaks.
- `http://127.0.0.1:8000/pertemuan-06/` : HTTP 200; 16 pemeriksaan isi profil dan keluaran PHP cocok.
- Perulangan `for` menghasilkan 5 target, sedangkan `while` menghasilkan 3 semester.
- Matriks semester `-1`, `0`, dan `1–9` : seluruh 11 pengujian lulus. Ini mencakup hasil `if-elseif-else` di bawah, dalam, dan di atas rentang; semua kelompok `switch` (semester awal, menengah, dan akhir); serta keluaran kedua perulangan.

## Proses Dokumentasi

Dokumentasi dapat dicatat pada commit terpisah setelah README diperiksa:

git add pertemuan-06/README.md
git commit -m "mendokumentasikan pengujian P6"
git push origin main
