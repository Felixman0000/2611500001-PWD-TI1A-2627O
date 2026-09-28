<?php
declare(strict_types=1);

function escape(string $value): string
{
    return htmlspecialchars($value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    header('Allow: POST');
    $errors = ['Halaman ini hanya menerima pengiriman formulir.'];
} else {
    $getString = static function (string $key): string {
        $value = $_POST[$key] ?? '';
        return is_string($value) ? trim($value) : '';
    };

    $name = $getString('name');
    $email = $getString('email');
    $phone = $getString('phone');
    $birthDate = $getString('tanggal_lahir');
    $prediction = $getString('prediksi');

    $programOptions = [
        'pti' => 'PTI',
        'ti' => 'TI',
        'si' => 'SI',
        'bd' => 'BD',
    ];
    $predictionOptions = [
        'china' => 'China Menjadi Negara Adidaya Baru',
        'ww3' => 'WW3 (China vs Amerika)',
        'agi' => 'AGI Menguasai Seluruh Dunia',
        'depresi' => 'Terjadinya The Great Depression',
    ];

    $submittedPrograms = $_POST['prodi'] ?? [];
    $programs = [];
    if (is_array($submittedPrograms)) {
        foreach ($submittedPrograms as $program) {
            if (is_string($program) && isset($programOptions[$program])) {
                $programs[] = $programOptions[$program];
            }
        }
    }

    $errors = [];
    $nameLength = function_exists('mb_strlen') ? mb_strlen($name, 'UTF-8') : strlen($name);
    if ($nameLength < 3 || $nameLength > 50) {
        $errors[] = 'Nama harus terdiri dari 3 sampai 50 karakter.';
    }
    if (strlen($email) > 100 || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Masukkan alamat email yang valid (maksimal 100 karakter).';
    }
    if (!preg_match('/^[0-9+() .-]{8,15}$/', $phone) || strlen(preg_replace('/\D/', '', $phone)) < 8) {
        $errors[] = 'Nomor telepon harus berisi 8 sampai 15 digit.';
    }

    $parsedBirthDate = DateTimeImmutable::createFromFormat('!Y-m-d', $birthDate);
    $dateErrors = DateTimeImmutable::getLastErrors();
    if (
        $parsedBirthDate === false
        || ($dateErrors !== false && ($dateErrors['warning_count'] > 0 || $dateErrors['error_count'] > 0))
        || $parsedBirthDate->format('Y-m-d') !== $birthDate
        || $parsedBirthDate > new DateTimeImmutable('today')
    ) {
        $errors[] = 'Masukkan tanggal lahir yang valid dan tidak melewati hari ini.';
    }
    if (!isset($predictionOptions[$prediction])) {
        $errors[] = 'Pilih salah satu jawaban pertanyaan.';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Pengiriman Form</title>
    <style>
        body { max-width: 720px; margin: 40px auto; padding: 0 20px; font-family: Arial, sans-serif; line-height: 1.6; color: #183326; }
        h1 { color: #1e5e39; }
        dt { margin-top: 12px; font-weight: bold; }
        dd { margin-left: 0; }
        a { color: #1e5e39; }
    </style>
</head>
<body>
    <?php if ($errors !== []): ?>
        <h1>Form belum bisa diproses</h1>
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?= escape($error) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <h1>Form berhasil dikirim</h1>
        <dl>
            <dt>Nama</dt>
            <dd><?= escape($name) ?></dd>
            <dt>Email</dt>
            <dd><?= escape($email) ?></dd>
            <dt>Nomor telepon</dt>
            <dd><?= escape($phone) ?></dd>
            <dt>Tanggal lahir</dt>
            <dd><?= escape($birthDate) ?></dd>
            <dt>Prodi yang dipilih</dt>
            <dd><?= $programs === [] ? 'Tidak ada' : escape(implode(', ', $programs)) ?></dd>
            <dt>Jawaban</dt>
            <dd><?= escape($predictionOptions[$prediction]) ?></dd>
        </dl>
    <?php endif; ?>
    <p><a href="index.html#contact">Kembali ke formulir</a></p>
</body>
</html>