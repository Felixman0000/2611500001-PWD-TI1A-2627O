<?php
date_default_timezone_set('Asia/Jakarta');

const NAMA_MAHASISWA = 'Felix Sebastian';
const NIM_MAHASISWA = '2611500001';

$namaMahasiswa = NAMA_MAHASISWA;
$nimMahasiswa = NIM_MAHASISWA;
$tahunAkademik = '2026/2027';
$nilaiLatihan = 88;
$nilaiTambahan = 5.5;
$statusAktif = true;
$hobi = ['Trading', 'Belajar Bahasa', 'Olahraga', 'Main Catur', 'Baca Buku'];
$nilaiAkhir = $nilaiLatihan + $nilaiTambahan;
$jumlahPertemuan = 6;
$waktuSekarang = new DateTimeImmutable('now');
$nomorHari = (int) $waktuSekarang->format('N');

if ((int) $waktuSekarang->format('G') < 12) {
    $sapaan = 'Selamat pagi';
} elseif ((int) $waktuSekarang->format('G') < 18) {
    $sapaan = 'Selamat siang';
} else {
    $sapaan = 'Selamat malam';
}

if ($nilaiAkhir >= 90) {
    $predikat = 'Sangat baik';
} elseif ($nilaiAkhir >= 75) {
    $predikat = 'Baik';
} else {
    $predikat = 'Perlu berlatih lagi';
}

switch ($nomorHari) {
    case 1:
        $namaHari = 'Senin';
        break;
    case 2:
        $namaHari = 'Selasa';
        break;
    case 3:
        $namaHari = 'Rabu';
        break;
    case 4:
        $namaHari = 'Kamis';
        break;
    case 5:
        $namaHari = 'Jumat';
        break;
    case 6:
        $namaHari = 'Sabtu';
        break;
    default:
        $namaHari = 'Minggu';
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>P6 - PHP Dasar | Blog Felix Sebastian</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>PHP Dasar - Pertemuan 6</h1>
        <button id="navToggle" class="menu-toggle" type="button" aria-label="Buka navigasi" aria-expanded="false">☰</button>

        <nav id="navMenu">
            <ul>
                <li><a href="#home">Beranda</a></li>
                <li><a href="#about">Tentang</a></li>
                <li><a href="#php">Praktik PHP</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section id="home">
            <div class="welcome-heading">
                <img class="profile-photo" src="img/Foto-Profil.jpg" alt="Foto profil Felix Sebastian">
                <h2><?= htmlspecialchars($sapaan, ENT_QUOTES, 'UTF-8') ?>, <?= htmlspecialchars($namaMahasiswa, ENT_QUOTES, 'UTF-8') ?></h2>
            </div>
            <p>Halaman ini dirender secara dinamis menggunakan PHP.</p>
        </section>
        <section id="about">
            <h2>Tentang Saya</h2>
            <p>Saya adalah seorang pembelajar HTML.</p>
            <p><strong><span>NIM</span><span>:</span></strong> <?= htmlspecialchars($nimMahasiswa, ENT_QUOTES, 'UTF-8') ?></p>
            <p><strong><span>Nama Lengkap</span><span>:</span></strong> <?= htmlspecialchars($namaMahasiswa, ENT_QUOTES, 'UTF-8') ?></p>
            <p><strong><span>Tempat lahir</span><span>:</span></strong> Pangkalpinang</p>
            <p><strong><span>Tanggal lahir</span><span>:</span></strong> 07 Januari 2008</p>
            <p><strong><span>Hobi</span><span>:</span></strong> <?= htmlspecialchars(implode(', ', $hobi), ENT_QUOTES, 'UTF-8') ?></p>
            <p><strong><span>Pasangan</span><span>:</span></strong> BELUM ADA!</p>
            <p><strong><span>Pekerjaan</span><span>:</span></strong> Nganggur</p>
            <p><strong><span>Nama Orang Tua</span><span>:</span></strong> Wanti Dan Awen</p>
            <p><strong><span>Nama Kakak</span><span>:</span></strong> Tidak Ada</p>
            <p><strong><span>Nama Adik</span><span>:</span></strong> Fedric Sebastian</p>
        </section>
        <section id="php">
            <h2>Hasil Praktik PHP</h2>
            <p>Hari ini: <?= htmlspecialchars($namaHari, ENT_QUOTES, 'UTF-8') ?>, <?= htmlspecialchars($waktuSekarang->format('d-m-Y H:i'), ENT_QUOTES, 'UTF-8') ?> WIB</p>
            <p>Tahun akademik: <?= htmlspecialchars($tahunAkademik, ENT_QUOTES, 'UTF-8') ?></p>
            <p>Status belajar: <?= $statusAktif ? 'Aktif' : 'Tidak aktif' ?></p>
            <p>Nilai latihan: <?= $nilaiLatihan ?> + nilai tambahan <?= number_format($nilaiTambahan, 1, ',', '.') ?> = <?= number_format($nilaiAkhir, 1, ',', '.') ?> (<?= htmlspecialchars($predikat, ENT_QUOTES, 'UTF-8') ?>)</p>
            <p>Operator perbandingan menunjukkan nilai akhir <?= $nilaiAkhir >= 75 ? 'lulus batas latihan' : 'belum mencapai batas latihan' ?>.</p>

            <h3>Daftar pertemuan (perulangan for)</h3>
            <ol>
                <?php for ($nomorPertemuan = 1; $nomorPertemuan <= $jumlahPertemuan; $nomorPertemuan++): ?>
                    <li>Pertemuan <?= $nomorPertemuan ?><?= $nomorPertemuan === $jumlahPertemuan ? ' (materi saat ini)' : '' ?></li>
                <?php endfor; ?>
            </ol>

            <h3>Hitung mundur latihan (perulangan while)</h3>
            <ul>
                <?php $sisaLatihan = 3; ?>
                <?php while ($sisaLatihan > 0): ?>
                    <li><?= $sisaLatihan ?> langkah latihan tersisa</li>
                    <?php $sisaLatihan--; ?>
                <?php endwhile; ?>
            </ul>
        </section>
    </main>
    <footer>
        <p>&copy; <?= $waktuSekarang->format('Y') ?> <?= htmlspecialchars($namaMahasiswa, ENT_QUOTES, 'UTF-8') ?> [<?= htmlspecialchars($nimMahasiswa, ENT_QUOTES, 'UTF-8') ?>].</p>
        <p><a href="https://github.com/Felixman0000/2611500001-PWD-TI1A-2627O">GitHub Saya</a></p>
    </footer>
    <script src="script.js"></script>
</body>
</html>