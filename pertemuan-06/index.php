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
        <button id="navToggle" class="menu-toggle" type="button" aria-label="Buka navigasi" aria-expanded="false" aria-controls="navMenu">☰</button>

        <nav id="navMenu">
            <ul>
                <li><a href="#home">Beranda</a></li>
                <li><a href="#about">Tentang</a></li>
                <li><a href="#contact">Kontak</a></li>
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
        <section id="contact">
            <h2>Form</h2>
            <form id="contactForm" method="POST" action="proses.php" novalidate>
                <label for="name">Nama :</label>
                <input type="text" id="name" name="name" placeholder="Masukkan Nama" minlength="3" maxlength="50" required autocomplete="name">

                <label for="email">Email :</label>
                <input type="email" id="email" name="email" placeholder="Masukkan Email" maxlength="100" required autocomplete="email">

                <label for="phone">Nomor Telepon :</label>
                <input type="tel" id="phone" name="phone" placeholder="Masukkan Nomor Telepon" minlength="8" maxlength="20" required autocomplete="tel">

                <label for="tanggal-lahir">Tanggal Lahir :</label>
                <input type="date" id="tanggal-lahir" name="tanggal_lahir" required autocomplete="bday" max="2026-09-28">

                <fieldset class="radio-group">
                    <legend>Silahkan Pilih Program Studi yang Menurut Anda Paling Menarik!</legend>
                    <div class="radio-options">
                        <label><input type="checkbox" id="prodi-pti" name="prodi[]" value="pti"> PTI</label>
                        <label><input type="checkbox" id="prodi-ti" name="prodi[]" value="ti"> TI</label>
                        <label><input type="checkbox" id="prodi-si" name="prodi[]" value="si"> SI</label>
                        <label><input type="checkbox" id="prodi-bd" name="prodi[]" value="bd"> BD</label>
                    </div>
                </fieldset>

                <fieldset class="radio-group">
                    <legend>Menurut Anda, apa yang akan terjadi dalam 5-10 tahun ke depan?</legend>
                    <div class="radio-options">
                        <label><input type="radio" id="prediksi-china" name="prediksi" value="china" required> China Menjadi Negara Adidaya Baru</label>
                        <label><input type="radio" id="prediksi-ww3" name="prediksi" value="ww3"> WW3 (China vs Amerika)</label>
                        <label><input type="radio" id="prediksi-agi" name="prediksi" value="agi"> AGI Menguasai Seluruh Dunia</label>
                        <label><input type="radio" id="prediksi-depresi" name="prediksi" value="depresi"> Terjadinya The Great Depression</label>
                    </div>
                </fieldset>

                <button type="submit">Kirim</button>
                <button type="reset">Batal</button>
                <p id="form-feedback" class="form-feedback" role="status" aria-live="polite" hidden></p>
            </form>
        </section>
    </main>
    <footer>
        <p>&copy; <?= date('Y') ?> <?= htmlspecialchars($namaMahasiswa, ENT_QUOTES, 'UTF-8') ?> [<?= htmlspecialchars($nimMahasiswa, ENT_QUOTES, 'UTF-8') ?>].</p>
        <p><a href="<?= htmlspecialchars($urlGithub, ENT_QUOTES, 'UTF-8') ?>">GitHub Saya (<?= htmlspecialchars($namaGithub, ENT_QUOTES, 'UTF-8') ?>)</a></p>
    </footer>
    <script src="script.js"></script>
</body>
</html>