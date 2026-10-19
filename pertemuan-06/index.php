<?php
date_default_timezone_set('Asia/Jakarta');

const NAMA_MAHASISWA = 'Felix Sebastian';
const NIM_MAHASISWA = '2611500001';
const PROFIL_GITHUB = 'Felixman0000';

$namaMahasiswa = NAMA_MAHASISWA;
$nimMahasiswa = NIM_MAHASISWA;
$namaGithub = PROFIL_GITHUB;
$urlGithub = 'https://github.com/' . rawurlencode($namaGithub);
$tahunAkademik = '2026/2027';
$programStudi = 'Teknik Informatika (TI)';
$fokusProgram = 'Pemrograman Web Dasar';
$statusMahasiswa = 'Aktif';
$semesterSaatIni = 1;
$batasSemester = 8;
$sisaSemester = $batasSemester - $semesterSaatIni;
if ($semesterSaatIni < 1) {
    $pemeriksaanSemester = 'Di bawah rentang';
} elseif ($semesterSaatIni <= $batasSemester) {
    $pemeriksaanSemester = 'Sesuai rentang';
} else {
    $pemeriksaanSemester = 'Melebihi rentang';
}

switch ($semesterSaatIni) {
    case 1:
    case 2:
        $keteranganSemester = 'Semester awal';
        break;
    case 3:
    case 4:
    case 5:
    case 6:
        $keteranganSemester = 'Semester menengah';
        break;
    default:
        $keteranganSemester = 'Semester akhir';
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Saya | Felix Sebastian</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Tentang Saya</h1>
        <button id="navToggle" class="menu-toggle" type="button" aria-label="Buka navigasi" aria-expanded="false">☰</button>

        <nav id="navMenu">
            <ul>
                <li><a href="#home">Beranda</a></li>
                <li><a href="#about">Tentang</a></li>
                <li><a href="#php">Target </a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section id="home">
            <div class="welcome-heading">
                <img class="profile-photo" src="img/Foto-Profil.jpg" alt="Foto profil Felix Sebastian">
                <h2>Selamat Datang</h2>
            </div>
            <p>Nama saya <?= htmlspecialchars($namaMahasiswa, ENT_QUOTES, 'UTF-8') ?>. Saya sedang mempelajari mata kuliah <strong>Pemrograman Web Dasar</strong> pada tahun akademik <?= htmlspecialchars($tahunAkademik, ENT_QUOTES, 'UTF-8') ?>.</p>
        </section>
        <section id="about">
            <h2>Tentang Saya</h2>
            <h3>Profil Singkat</h3>
            <p><strong><span>Program Studi</span><span>:</span></strong> <?= htmlspecialchars($programStudi, ENT_QUOTES, 'UTF-8') ?></p>
            <p><strong><span>Fokus program studi</span><span>:</span></strong> <?= htmlspecialchars($fokusProgram, ENT_QUOTES, 'UTF-8') ?></p>
            <p><strong><span>Status mahasiswa</span><span>:</span></strong> <?= htmlspecialchars($statusMahasiswa, ENT_QUOTES, 'UTF-8') ?></p>
            <p><strong><span>Semester</span><span>:</span></strong> <?= $semesterSaatIni ?> (<?= htmlspecialchars($keteranganSemester, ENT_QUOTES, 'UTF-8') ?>)</p>
            <p><strong><span>Sisa semester hingga batas</span><span>:</span></strong> <?= $sisaSemester ?></p>
            <p><strong><span>Pemeriksaan rentang semester</span><span>:</span></strong> <?= htmlspecialchars($pemeriksaanSemester, ENT_QUOTES, 'UTF-8') ?></p>
            <p><strong><span>NIM</span><span>:</span></strong> <?= htmlspecialchars($nimMahasiswa, ENT_QUOTES, 'UTF-8') ?></p>
        </section>
        <section id="php">
            <h2>Target Belajar</h2>
            <ol>
                <?php
                for ($nomorTarget = 1; $nomorTarget <= 5; $nomorTarget++) {
                    echo '<li>Target belajar ke-' . $nomorTarget . ': ';
                    switch ($nomorTarget) {
                        case 1:
                            echo 'Memahami sintaks dasar PHP.';
                            break;
                        case 2:
                            echo 'Menggunakan variabel dan konstanta.';
                            break;
                        case 3:
                            echo 'Menerapkan operator dan percabangan.';
                            break;
                        case 4:
                            echo 'Menggunakan perulangan for dan while.';
                            break;
                        default:
                            echo 'Belum dipetakan';
                            break;
                    }
                    echo '</li>';
                }
                ?>
            </ol>

            <h3>Semester (Perulangan while)</h3>
            <ul>
                <?php $nomorSemester = 1; ?>
                <?php while ($nomorSemester <= 3): ?>
                    <li>Semester <?= $nomorSemester ?></li>
                    <?php $nomorSemester++; ?>
                <?php endwhile; ?>
            </ul>
        </section>
    </main>
    <footer>
        <p>&copy; <?= date('Y') ?> <?= htmlspecialchars($namaMahasiswa, ENT_QUOTES, 'UTF-8') ?> [<?= htmlspecialchars($nimMahasiswa, ENT_QUOTES, 'UTF-8') ?>].</p>
        <p><a href="<?= htmlspecialchars($urlGithub, ENT_QUOTES, 'UTF-8') ?>">GitHub Saya (<?= htmlspecialchars($namaGithub, ENT_QUOTES, 'UTF-8') ?>)</a></p>
    </footer>
    <script src="script.js"></script>
</body>
</html>