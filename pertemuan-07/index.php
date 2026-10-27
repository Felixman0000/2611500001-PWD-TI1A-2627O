<?php
session_start();
$pesanKesalahan = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$nama = trim((string) ($_POST['nama'] ?? ''));
	$email = trim((string) ($_POST['email'] ?? ''));
	$semesterForm = trim((string) ($_POST['semester'] ?? ''));
	$tanggal = trim((string) ($_POST['tanggal'] ?? ''));
	$jenisPesan = trim((string) ($_POST['jenis_pesan'] ?? ''));
	$prodi = trim((string) ($_POST['prodi'] ?? ''));
	$pesan = trim((string) ($_POST['pesan'] ?? ''));
	$minat = $_POST['minat'] ?? [];

	if ($nama === '') {
		$pesanKesalahan .= 'Nama lengkap wajib diisi. ';
	} elseif (strlen($nama) < 3 || strlen($nama) > 50) {
		$pesanKesalahan .= 'Nama lengkap harus berisi 3 sampai 50 karakter. ';
	}

	if ($email === '') {
		$pesanKesalahan .= 'Email wajib diisi. ';
	} elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
		$pesanKesalahan .= 'Format email tidak valid. ';
	}

	if ($semesterForm === '') {
		$pesanKesalahan .= 'Semester wajib diisi. ';
	} else {
		$semesterValid = filter_var($semesterForm, FILTER_VALIDATE_INT);
		if ($semesterValid === false || $semesterValid < 1 || $semesterValid > 14) {
			$pesanKesalahan .= 'Semester harus berupa bilangan bulat antara 1 dan 14. ';
		}
	}

	if ($tanggal === '') {
		$pesanKesalahan .= 'Tanggal kunjungan wajib diisi. ';
	}
	if (!in_array($jenisPesan, ['pertanyaan', 'saran'], true)) {
		$pesanKesalahan .= 'Jenis pesan tidak valid. ';
	}
	if (!in_array($prodi, ['SI', 'TI'], true)) {
		$pesanKesalahan .= 'Program studi tidak valid. ';
	}
	if ($pesan === '') {
		$pesanKesalahan .= 'Pesan wajib diisi. ';
	} elseif (strlen($pesan) > 300) {
		$pesanKesalahan .= 'Pesan maksimal 300 karakter. ';
	}

	if (!is_array($minat)) {
		$pesanKesalahan .= 'Format pilihan topik tidak valid. ';
		$minat = [];
	} elseif (empty($minat)) {
		$pesanKesalahan .= 'Minat wajib dipilih minimal satu. ';
	} else {
		$minatDiizinkan = ['HTML', 'CSS'];
		foreach ($minat as $topik) {
			if (!in_array($topik, $minatDiizinkan, true)) {
				$pesanKesalahan .= 'Pilihan topik tidak valid. ';
				break;
			}
		}
	}

	$formData = [
		'nama' => $nama,
		'email' => $email,
		'semester' => $semesterForm,
		'tanggal' => $tanggal,
		'jenis_pesan' => $jenisPesan,
		'prodi' => $prodi,
		'minat' => $minat,
		'pesan' => $pesan,
	];

	if ($pesanKesalahan !== '') {
		$_SESSION['pesanKesalahan'] = $pesanKesalahan;
		$_SESSION['formData'] = $formData;
		unset($_SESSION['dataDiterima']);
	} else {
		$_SESSION['dataDiterima'] = $formData;
		unset($_SESSION['pesanKesalahan'], $_SESSION['formData']);
	}

	header('Location: index.php');
	exit;
}

$nim = "2611500001";
$namaMahasiswa = "Felix Sebastian";
$programStudi = "TI";
$tahunAkademik = "2026/2027";
$semester = 1;
$ipk = 0.00;
$statusAktif = true;
$catatanTambahan = null;
const NAMA_MATA_KULIAH = "Pemrograman Web Dasar";
const PROFIL_GITHUB = "Felixman0000";
$batasSemester = 8;
$sisaSemester = $batasSemester - $semester;
$semesterValid = $semester >= 1 && $semester <= $batasSemester;
$statusSemester = ($semesterValid && $statusAktif) ? "Sesuai rentang" : "Perlu diperiksa";

if ($semester < 3) {
	$keteranganSemester = "Semester awal";
} elseif ($semester <= 6) {
	$keteranganSemester = "Semester menengah";
} else {
	$keteranganSemester = "Semester akhir";
}

$namaProdi = ($programStudi === "SI") ? "Sistem Informasi" : (($programStudi === "TI") ? "Teknik Informatika" : "Lainnya");

switch ($programStudi) {
	case "SI":
		$fokusProgramStudi = "Sistem informasi dan proses bisnis";
		break;
	case "TI":
		$fokusProgramStudi = "Komputasi dan pengembangan perangkat lunak";
		break;
	default:
		$fokusProgramStudi = "Belum ditentukan";
}

$pesanKesalahan = $_SESSION['pesanKesalahan'] ?? '';
$formData = $_SESSION['formData'] ?? [];
$dataDiterima = $_SESSION['dataDiterima'] ?? null;
unset($_SESSION['pesanKesalahan'], $_SESSION['formData'], $_SESSION['dataDiterima']);

$nama = $formData['nama'] ?? '';
$email = $formData['email'] ?? '';
$semesterForm = $formData['semester'] ?? '';
$tanggal = $formData['tanggal'] ?? '';
$jenisPesan = $formData['jenis_pesan'] ?? '';
$prodi = $formData['prodi'] ?? '';
$minat = $formData['minat'] ?? [];
$pesan = $formData['pesan'] ?? '';
?>
<!doctype html>
<html lang="id">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Profil Mahasiswa</title>
	<link rel="stylesheet" href="style.css" />
</head>

<body>
	<header>
		<div class="header-top">
			<h1>Profil Mahasiswa</h1>
			<button
				class="nav-toggle"
				id="navToggle"
				type="button"
				aria-label="Buka navigasi"
				aria-controls="navMenu"
				aria-expanded="false">
				&#9776;
			</button>
		</div>
		<nav>
			<ul id="navMenu">
				<li><a href="#home">Beranda</a></li>
				<li><a href="#about">Tentang</a></li>
				<li><a href="#contact">Kontak</a></li>
			</ul>
		</nav>
	</header>

	<main>
		<section id="home">
			<h2>Selamat Datang</h2>
			<p>
				Halo, saya <strong><?= htmlspecialchars($namaMahasiswa, ENT_QUOTES, 'UTF-8') ?></strong>.
				Saya sedang mempelajari matakuliah <strong><?= NAMA_MATA_KULIAH ?></strong>
				pada tahun akademik <?= htmlspecialchars($tahunAkademik, ENT_QUOTES, 'UTF-8') ?>.
			</p>
			<img src="img/foto-profil.jpg" alt="Foto profil Nama Mahasiswa" />
		</section>

		<section id="about">
			<h2>Tentang Saya</h2>
			<article>
				<h3>Profil Singkat</h3>
				<p>
					Program Studi:
					<?= htmlspecialchars($namaProdi . " (" . $programStudi . ")", ENT_QUOTES, 'UTF-8') ?>
				</p>
				<p>
					Fokus program studi: <?= htmlspecialchars($fokusProgramStudi, ENT_QUOTES, 'UTF-8') ?>
				</p>
				<p>Status mahasiswa: <?= $statusAktif ? "Aktif" : "Tidak aktif" ?></p>
				<p>Semester: <?= $semester . " (" . $keteranganSemester . ")" ?></p>
				<p>Sisa semester hingga batas: <?= $sisaSemester ?></p>
				<p>Pemeriksaan rentang semester: <?= $statusSemester ?></p>
				<p>IPK: <?= number_format($ipk, 2, ',', '.') ?></p>
				<p>
					Catatan tambahan:
					<?= $catatanTambahan === null ? "Belum ada" : htmlspecialchars($catatanTambahan, ENT_QUOTES, 'UTF-8') ?>
				</p>

				<h3>Target Belajar (Perulangan for)</h3>
				<ol>
					<?php for ($i = 1; $i <= 5; $i++): ?>
						<li>
							Target belajar ke-<?= $i ?>:
							<?php
							switch ($i) {
								case 1:
									echo "Memahami sintaks dasar PHP.";
									break;
								case 2:
									echo "Menggunakan variabel dan konstanta.";
									break;
								case 3:
									echo "Menerapkan operator dan percabangan.";
									break;
								case 4:
									echo "Menggunakan perulangan for dan while.";
									break;
								default:
									echo "Belum dipetakan";
									break;
							}
							?>
						</li>
					<?php endfor; ?>
				</ol>

				<h3>Semester (Perulangan while)</h3>
				<ol>
					<?php
					$nomorSemester = 1;
					while ($nomorSemester <= 3):
					?>
						<li>Semester <?= $nomorSemester ?></li>
						<?php $nomorSemester++; ?>
					<?php endwhile; ?>
				</ol>
			</article>
		</section>

		<section id="contact">
			<h2>Kontak</h2>
			<?php if ($pesanKesalahan !== ''): ?>
				<p class="form-feedback-error">
					<?= htmlspecialchars($pesanKesalahan, ENT_QUOTES, 'UTF-8') ?>
				</p>
			<?php endif; ?>

			<p>
				Kunjungi
				<a target="_blank" rel="noopener noreferrer" href="https://github.com/<?= PROFIL_GITHUB ?>">profil GitHub saya</a>.
			</p>

			<form id="contactForm" action="index.php" method="post" novalidate>
				<div class="form-group">
					<label for="nama">Nama Lengkap</label><br />
					<input
						class="input-form"
						type="text"
						id="nama"
						name="nama"
						placeholder="Masukkan nama lengkap"
						minlength="3"
						maxlength="50"
						value="<?= htmlspecialchars($nama, ENT_QUOTES, 'UTF-8') ?>"
						required />
				</div>

				<div class="form-group">
					<label for="email">Email</label><br />
					<input
						class="input-form"
						type="email"
						id="email"
						name="email"
						placeholder="nama@email.com"
						value="<?= htmlspecialchars($email, ENT_QUOTES, 'UTF-8') ?>"
						required />
				</div>

				<div class="form-group">
					<label for="semester">Semester</label><br />
					<input
						class="input-form"
						type="number"
						id="semester"
						name="semester"
						min="1"
						max="14"
						value="<?= htmlspecialchars($semesterForm, ENT_QUOTES, 'UTF-8') ?>"
						required />
				</div>

				<div class="form-group">
					<label for="tanggal">Tanggal Kunjungan</label><br />
					<input
						class="input-form"
						type="date"
						id="tanggal"
						name="tanggal"
						value="<?= htmlspecialchars($tanggal, ENT_QUOTES, 'UTF-8') ?>"
						required />
				</div>

				<div class="form-group">
					<p>Jenis Pesan</p>
					<input
						type="radio"
						id="pertanyaan"
						name="jenis_pesan"
						value="pertanyaan"
						<?= $jenisPesan === 'pertanyaan' ? 'checked' : '' ?>
						required />
					<label for="pertanyaan">Pertanyaan</label>
					<input
						type="radio"
						id="saran"
						name="jenis_pesan"
						value="saran"
						<?= $jenisPesan === 'saran' ? 'checked' : '' ?> />
					<label for="saran">Saran</label>
				</div>

				<div class="form-group">
					<p>Topik yang Diminati</p>
					<input
						type="checkbox"
						id="minat-html"
						name="minat[]"
						value="HTML"
						<?= in_array('HTML', $minat, true) ? 'checked' : '' ?> />
					<label for="minat-html">HTML</label>
					<input
						type="checkbox"
						id="minat-css"
						name="minat[]"
						value="CSS"
						<?= in_array('CSS', $minat, true) ? 'checked' : '' ?> />
					<label for="minat-css">CSS</label>
				</div>

				<div class="form-group">
					<label for="prodi">Program Studi</label><br />
					<select class="input-form" id="prodi" name="prodi" required>
						<option value="">-- Pilih Program Studi --</option>
						<option value="SI" <?= $prodi === 'SI' ? 'selected' : '' ?>>
							Sistem Informasi
						</option>
						<option value="TI" <?= $prodi === 'TI' ? 'selected' : '' ?>>
							Teknik Informatika
						</option>
					</select>
				</div>

				<div class="form-group">
					<label for="pesan">Pesan</label><br />
					<textarea
						class="input-form"
						id="pesan"
						name="pesan"
						maxlength="300"
						placeholder="Tulis pesan Anda"
						required><?= htmlspecialchars($pesan, ENT_QUOTES, 'UTF-8') ?></textarea>
				</div>

				<button type="submit">Kirim</button>
				<button type="reset">Batal</button>
				<p id="formFeedback"></p>
			</form>

			<?php if ($dataDiterima !== null): ?>
				<h3>Data yang Diterima Peladen</h3>
				<p>Nama: <?= htmlspecialchars($dataDiterima['nama'], ENT_QUOTES, 'UTF-8') ?></p>
				<p>Email: <?= htmlspecialchars($dataDiterima['email'], ENT_QUOTES, 'UTF-8') ?></p>
				<p>Semester: <?= htmlspecialchars($dataDiterima['semester'], ENT_QUOTES, 'UTF-8') ?></p>
				<p>
					Tanggal kunjungan:
					<?= htmlspecialchars($dataDiterima['tanggal'], ENT_QUOTES, 'UTF-8') ?>
				</p>
				<p>Jenis pesan: <?= htmlspecialchars($dataDiterima['jenis_pesan'], ENT_QUOTES, 'UTF-8') ?></p>
				<p>Program studi: <?= htmlspecialchars($dataDiterima['prodi'], ENT_QUOTES, 'UTF-8') ?></p>
				<p>Minat:</p>
				<?php if (!empty($dataDiterima['minat'])): ?>
					<ul>
						<?php foreach ($dataDiterima['minat'] as $topik): ?>
							<li>
								<?= htmlspecialchars((string) $topik, ENT_QUOTES, 'UTF-8') ?>
							</li>
						<?php endforeach; ?>
					</ul>
				<?php else: ?>
					<p>Tidak ada minat yang dipilih.</p>
				<?php endif; ?>
				<p>Pesan:</p>
				<p><?= nl2br(htmlspecialchars($dataDiterima['pesan'], ENT_QUOTES, 'UTF-8')) ?></p>
			<?php endif; ?>
		</section>
	</main>

	<footer>
		<p>
			&copy; <?= date("Y") ?>
			<?= htmlspecialchars($namaMahasiswa, ENT_QUOTES, 'UTF-8') ?> [<?= $nim ?>]
		</p>
	</footer>
	<script src="script.js"></script>
</body>
</html>