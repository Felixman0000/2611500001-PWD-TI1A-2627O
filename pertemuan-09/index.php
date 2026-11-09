<?php
session_start();
include 'fungsi.php';

if (
	$_SERVER["REQUEST_METHOD"] === "POST" &&
	($_POST["form_type"] ?? "") === "activity"
) {
	$namaKegiatan = trim((string) ($_POST["nama_kegiatan"] ?? ""));
	$kategoriKegiatan = trim((string) ($_POST["kategori_kegiatan"] ?? ""));
	$tanggalPelaksanaan = trim((string) ($_POST["tanggal_pelaksanaan"] ?? ""));
	$lokasiKegiatan = trim((string) ($_POST["lokasi_kegiatan"] ?? ""));
	$deskripsiKegiatan = trim((string) ($_POST["deskripsi_kegiatan"] ?? ""));

	$activityData = [
		"nama_kegiatan" => $namaKegiatan,
		"kategori_kegiatan" => $kategoriKegiatan,
		"tanggal_pelaksanaan" => $tanggalPelaksanaan,
		"lokasi_kegiatan" => $lokasiKegiatan,
		"deskripsi_kegiatan" => $deskripsiKegiatan,
	];
	$activityErrors = [];
	$allowedCategories = ["akademik", "organisasi", "sosial", "olahraga", "lainnya"];

	if ($namaKegiatan === "" || mb_strlen($namaKegiatan) > 100) {
		$activityErrors["nama_kegiatan"] = "Nama kegiatan wajib diisi dan maksimal 100 karakter.";
	}
	if (!in_array($kategoriKegiatan, $allowedCategories, true)) {
		$activityErrors["kategori_kegiatan"] = "Pilih kategori kegiatan yang tersedia.";
	}
	$date = preg_match('/\A\d{4}-\d{2}-\d{2}\z/', $tanggalPelaksanaan)
		? DateTimeImmutable::createFromFormat("!Y-m-d", $tanggalPelaksanaan)
		: false;
	if (!$date || $date->format("Y-m-d") !== $tanggalPelaksanaan) {
		$activityErrors["tanggal_pelaksanaan"] = "Masukkan tanggal pelaksanaan yang valid.";
	}
	if ($lokasiKegiatan === "" || mb_strlen($lokasiKegiatan) > 150) {
		$activityErrors["lokasi_kegiatan"] = "Lokasi wajib diisi dan maksimal 150 karakter.";
	}
	if ($deskripsiKegiatan === "" || mb_strlen($deskripsiKegiatan) > 1000) {
		$activityErrors["deskripsi_kegiatan"] = "Deskripsi wajib diisi dan maksimal 1000 karakter.";
	}

	if ($activityErrors === []) {
		$_SESSION["nama_kegiatan"] = $namaKegiatan;
		$_SESSION["kategori_kegiatan"] = $kategoriKegiatan;
		$_SESSION["tanggal_pelaksanaan"] = $tanggalPelaksanaan;
		$_SESSION["lokasi_kegiatan"] = $lokasiKegiatan;
		$_SESSION["deskripsi_kegiatan"] = $deskripsiKegiatan;
		unset(
			$_SESSION["rencana_kegiatan"],
			$_SESSION["rencana_kegiatan_errors"],
			$_SESSION["rencana_kegiatan_old"]
		);
	} else {
		$_SESSION["rencana_kegiatan_errors"] = $activityErrors;
		$_SESSION["rencana_kegiatan_old"] = $activityData;
		unset(
			$_SESSION["nama_kegiatan"],
			$_SESSION["kategori_kegiatan"],
			$_SESSION["tanggal_pelaksanaan"],
			$_SESSION["lokasi_kegiatan"],
			$_SESSION["deskripsi_kegiatan"],
			$_SESSION["rencana_kegiatan"]
		);
	}

	header("Location: index.php#rencana-kegiatan");
	exit;
}

// P7: Memproses data formulir dan menyimpannya ke dalam session.
if ($_SERVER["REQUEST_METHOD"] === "POST") {
	$nama = trim((string) ($_POST["nama"] ?? ""));
	$email = trim((string) ($_POST["email"] ?? ""));
	$semesterForm = trim((string) ($_POST["semester"] ?? ""));
	$tanggal = trim((string) ($_POST["tanggal"] ?? ""));
	$jenisPesan = trim((string) ($_POST["jenis_pesan"] ?? ""));
	$minat = $_POST["minat"] ?? [];
	$prodi = trim((string) ($_POST["prodi"] ?? ""));
	$pesan = trim((string) ($_POST["pesan"] ?? ""));

	// Checkbox dapat mengirimkan lebih dari satu nilai.
	if (!is_array($minat)) {
		$minat = [];
	}

	$_SESSION["form_data"] = [
		"nama" => $nama,
		"email" => $email,
		"semester" => $semesterForm,
		"tanggal" => $tanggal,
		"jenis_pesan" => $jenisPesan,
		"minat" => $minat,
		"prodi" => $prodi,
		"pesan" => $pesan,
	];
	unset(
		$_SESSION["nama"],
		$_SESSION["email"],
		$_SESSION["semester"],
		$_SESSION["tanggal"],
		$_SESSION["jenis_pesan"],
		$_SESSION["minat"],
		$_SESSION["prodi"],
		$_SESSION["pesan"]
	);

	// PRG: mencegah pengiriman POST berulang ketika halaman dimuat ulang.
	header("Location: index.php#contact");
	exit;
}

$activityErrors = $_SESSION["rencana_kegiatan_errors"] ?? [];
$activityOld = $_SESSION["rencana_kegiatan_old"] ?? [];
$contactData = $_SESSION["form_data"] ?? [];
$contactLabels = [
	"nama" => "Nama Lengkap",
	"email" => "Email",
	"semester" => "Semester",
	"tanggal" => "Tanggal Kunjungan",
	"jenis_pesan" => "Jenis Pesan",
	"minat" => "Topik yang Diminati",
	"prodi" => "Program Studi",
	"pesan" => "Pesan",
];
if (!is_array($contactData)) {
	$contactData = [];
}
$activityResult = isset($_SESSION["nama_kegiatan"])
	? [
		"nama_kegiatan" => $_SESSION["nama_kegiatan"],
		"kategori_kegiatan" => $_SESSION["kategori_kegiatan"] ?? "",
		"tanggal_pelaksanaan" => $_SESSION["tanggal_pelaksanaan"] ?? "",
		"lokasi_kegiatan" => $_SESSION["lokasi_kegiatan"] ?? "",
		"deskripsi_kegiatan" => $_SESSION["deskripsi_kegiatan"] ?? "",
	]
	: null;
unset($_SESSION["rencana_kegiatan_errors"], $_SESSION["rencana_kegiatan_old"]);

// Mengamankan data sebelum ditampilkan kembali ke halaman HTML.
// P6: PHP dasar dan pemrograman sisi peladen
// Bagian 1: Variabel dan konstanta
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

// Bagian 2: Operator
$batasSemester = 8;
$sisaSemester = $batasSemester - $semester;
$semesterValid = $semester >= 1 && $semester <= $batasSemester;
$statusSemester = ($semesterValid && $statusAktif) ? "Sesuai rentang" : "Perlu diperiksa";

// Bagian 3: Percabangan if-elseif-else
if ($semester < 3) {
	$keteranganSemester = "Semester awal";
} elseif ($semester <= 6) {
	$keteranganSemester = "Semester menengah";
} else {
	$keteranganSemester = "Semester akhir";
}

$namaProdi = ($programStudi == "SI") ? "Sistem Informasi" : (($programStudi == "TI") ? "Teknik Informatika" : "Lainnya");

// Bagian 4: Percabangan switch-case-default
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
				<li><a href="#rencana-kegiatan">Rencana Kegiatan</a></li>
			</ul>
		</nav>
	</header>

	<main>
		<section id="home">
			<h2>Selamat Datang</h2>
			<p>Halo, saya <strong><?php echo $namaMahasiswa; ?></strong>. Saya sedang mempelajari matakuliah <strong><?php print NAMA_MATA_KULIAH; ?></strong> pada tahun akademik <?php echo $tahunAkademik; ?>.</p>

			<img src="img/foto-profil.jpg" alt="Foto profil Nama Mahasiswa" />
		</section>

		<section id="about">
			<h2>Tentang Saya</h2>

			<article>
				<h3>Profil Singkat</h3>
				<p>Program Studi: <?php echo $namaProdi . " (" . $programStudi . ")"; ?></p>
				<p>Fokus program studi: <?php echo $fokusProgramStudi; ?></p>
				<p>Status mahasiswa: <?php echo $statusAktif ? "Aktif" : "Tidak aktif"; ?></p>
				<p>Semester: <?php echo $semester . " (" . $keteranganSemester . ")"; ?></p>
				<p>Sisa semester hingga batas: <?php echo $sisaSemester; ?></p>
				<p>Pemeriksaan rentang semester: <?php echo $statusSemester; ?></p>
				<p>IPK: <?php echo number_format($ipk, 2, ',', '.'); ?></p>
				<p>Catatan tambahan: <?php echo $catatanTambahan === null ? "Belum ada" : $catatanTambahan; ?></p>

				<h3>Target Belajar (Perulangan for)</h3>
				<ol>
					<?php
					// Perulangan for tanpa array; materi larik dibahas pada P9.
					for ($i = 1; $i <= 5; $i++) {
						echo "<li>Target belajar ke-" . $i . ": ";
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
						echo "</li>";
					}
					?>
				</ol>

				<h3>Semester (Perulangan while):</h3>
				<ol>
					<?php
					$nomorSemester = 1;
					while ($nomorSemester <= 3) {
						echo "<li>Semester " . $nomorSemester . "</li>";
						$nomorSemester++; // operator penugasan
					}
					?>
				</ol>
			</article>
		</section>

		<section id="contact">
			<h2>Kontak</h2>

			<p>
				Kunjungi
				<a target="_blank" href="https://github.com/<?= PROFIL_GITHUB ?>">profil GitHub saya</a>.
			</p>

			<form id="contactForm" class="js-contact-form" data-validation="contact" action="index.php" method="post" novalidate>
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
						required />
				</div>

				<div class="form-group">
					<label for="email">Email</label><br />

					<input class="input-form" type="email" id="email" name="email" placeholder="nama@email.com" required />
				</div>

				<div class="form-group">
					<label for="semester">Semester</label><br />

					<input class="input-form" type="number" id="semester" name="semester" min="1" max="14" required />
				</div>

				<div class="form-group">
					<label for="tanggal">Tanggal Kunjungan</label><br />

					<input class="input-form" type="date" id="tanggal" name="tanggal" required />
				</div>

				<div class="form-group">
					<p>Jenis Pesan</p>

					<input type="radio" id="pertanyaan" name="jenis_pesan" value="pertanyaan" required />
					<label for="pertanyaan">Pertanyaan</label>

					<input type="radio" id="saran" name="jenis_pesan" value="saran" />
					<label for="saran">Saran</label>
				</div>

				<div class="form-group">
					<p>Topik yang Diminati</p>

					<input type="checkbox" id="minat-html" name="minat[]" value="HTML" />
					<label for="minat-html">HTML</label>

					<input type="checkbox" id="minat-css" name="minat[]" value="CSS" />
					<label for="minat-css">CSS</label>
				</div>

				<div class="form-group">
					<label for="prodi">Program Studi</label><br />

					<select class="input-form" id="prodi" name="prodi" required>
						<option value="">-- Pilih Program Studi --</option>
						<option value="SI">Sistem Informasi</option>
						<option value="TI">Teknik Informatika</option>
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
						required></textarea>
				</div>

				<button type="submit">Kirim</button>
				<button type="reset">Batal</button>
				<p class="form-feedback" data-form-feedback aria-live="polite"></p>
			</form>

			<?php if ($contactData !== []): ?>
				<article id="hasilKontak" class="submission-result" aria-live="polite">
					<h3>Data Formulir yang Dikirim</h3>
					<?php foreach ($contactLabels as $key => $label): ?>
						<?php
						$value = $contactData[$key] ?? "";
						if ($key === "minat" && is_array($value)) {
							$value = implode(", ", $value);
						}
						$displayValue = bersihkan((string) $value);
						if ($key === "pesan") {
							$displayValue = nl2br($displayValue);
						}
						?>
						<p><strong><?= bersihkan($label) ?>:</strong> <?= $displayValue ?></p>
					<?php endforeach; ?>
				</article>
			<?php endif; ?>
		</section>

		<section id="rencana-kegiatan">
			<h2>Rencana Kegiatan Mahasiswa</h2>

			<form id="activityForm" data-validation="activity" action="index.php#rencana-kegiatan" method="post" novalidate>
				<input type="hidden" name="form_type" value="activity" />

				<div class="form-group">
					<label for="nama-kegiatan">Nama Kegiatan</label><br />

					<input
						class="input-form"
						type="text"
						id="nama-kegiatan"
						name="nama_kegiatan"
						placeholder="Masukkan nama kegiatan"
						minlength="1"
						maxlength="100"
						value="<?= bersihkan($activityOld["nama_kegiatan"] ?? "") ?>"
						required />

					<?php if (isset($activityErrors["nama_kegiatan"])): ?>
						<p class="form-feedback-error" role="alert"><?= bersihkan($activityErrors["nama_kegiatan"]) ?></p>
					<?php endif; ?>
				</div>

				<div class="form-group">
					<label for="kategori-kegiatan">Kategori Kegiatan</label><br />

					<select class="input-form" id="kategori-kegiatan" name="kategori_kegiatan" required>
						<option value="">-- Pilih Kategori --</option>
						<option value="akademik" <?= ($activityOld["kategori_kegiatan"] ?? "") === "akademik" ? "selected" : "" ?>>Akademik</option>
						<option value="organisasi" <?= ($activityOld["kategori_kegiatan"] ?? "") === "organisasi" ? "selected" : "" ?>>Organisasi</option>
						<option value="sosial" <?= ($activityOld["kategori_kegiatan"] ?? "") === "sosial" ? "selected" : "" ?>>Sosial</option>
						<option value="olahraga" <?= ($activityOld["kategori_kegiatan"] ?? "") === "olahraga" ? "selected" : "" ?>>Olahraga</option>
						<option value="lainnya" <?= ($activityOld["kategori_kegiatan"] ?? "") === "lainnya" ? "selected" : "" ?>>Lainnya</option>
					</select>

					<?php if (isset($activityErrors["kategori_kegiatan"])): ?>
						<p class="form-feedback-error" role="alert"><?= bersihkan($activityErrors["kategori_kegiatan"]) ?></p>
					<?php endif; ?>
				</div>

				<div class="form-group">
					<label for="tanggal-pelaksanaan">Tanggal Pelaksanaan</label><br />

					<input class="input-form" type="date" id="tanggal-pelaksanaan" name="tanggal_pelaksanaan" value="<?= bersihkan($activityOld["tanggal_pelaksanaan"] ?? "") ?>" required />

					<?php if (isset($activityErrors["tanggal_pelaksanaan"])): ?>
						<p class="form-feedback-error" role="alert"><?= bersihkan($activityErrors["tanggal_pelaksanaan"]) ?></p>
					<?php endif; ?>
				</div>

				<div class="form-group">
					<label for="lokasi-kegiatan">Lokasi Kegiatan</label><br />

					<input class="input-form" type="text" id="lokasi-kegiatan" name="lokasi_kegiatan" placeholder="Masukkan lokasi kegiatan" maxlength="150" value="<?= bersihkan($activityOld["lokasi_kegiatan"] ?? "") ?>" required />

					<?php if (isset($activityErrors["lokasi_kegiatan"])): ?>
						<p class="form-feedback-error" role="alert"><?= bersihkan($activityErrors["lokasi_kegiatan"]) ?></p>
					<?php endif; ?>
				</div>

				<div class="form-group">
					<label for="deskripsi-kegiatan">Deskripsi Kegiatan</label><br />

					<textarea
						class="input-form"
						id="deskripsi-kegiatan"
						name="deskripsi_kegiatan"
						rows="5"
						maxlength="1000"
						placeholder="Tulis deskripsi kegiatan Anda"
						required><?= bersihkan($activityOld["deskripsi_kegiatan"] ?? "") ?></textarea>

					<?php if (isset($activityErrors["deskripsi_kegiatan"])): ?>
						<p class="form-feedback-error" role="alert"><?= bersihkan($activityErrors["deskripsi_kegiatan"]) ?></p>
					<?php endif; ?>
				</div>

				<button type="submit">Kirim</button>
				<button type="reset">Batal</button>
				<p class="form-feedback" data-form-feedback aria-live="polite"></p>
			</form>

			<?php if (is_array($activityResult)): ?>
				<p class="form-feedback-success" role="status">Form Berhasil Dikirm</p>
				<article class="submission-result" aria-live="polite">
					<h3>Rencana Kegiatan yang Dikirim</h3>
					<p><strong>Nama Kegiatan:</strong> <?= bersihkan($activityResult["nama_kegiatan"]) ?></p>
					<p><strong>Kategori Kegiatan:</strong> <?= bersihkan($activityResult["kategori_kegiatan"]) ?></p>
					<p><strong>Tanggal Pelaksanaan:</strong> <?= bersihkan($activityResult["tanggal_pelaksanaan"]) ?></p>
					<p><strong>Lokasi Kegiatan:</strong> <?= bersihkan($activityResult["lokasi_kegiatan"]) ?></p>
					<p><strong>Deskripsi Kegiatan:</strong>
						<?= nl2br(bersihkan($activityResult["deskripsi_kegiatan"])) ?>
					</p>
				</article>
			<?php endif; ?>
		</section>
	</main>

	<footer>
		<p>&copy; <?= date("Y") ?> <?php echo $namaMahasiswa; ?> [<?= $nim ?>]</p>
	</footer>
	<script src="script.js"></script>
</body>

</html>