<?php
date_default_timezone_set('Asia/Jakarta');

function loadEnv($path)
{
    if (!file_exists($path)) {
        die("Error: File .env tidak ditemukan di " . $path);
    }

    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0)
            continue;

        list($name, $value) = explode('=', $line, 2);
        $name = trim($name);
        $value = trim($value);

        $value = trim($value, '"\'');

        putenv(sprintf('%s=%s', $name, $value));
        $_ENV[$name] = $value;
    }
}

loadEnv(__DIR__ . '/.env');

$servername = getenv('DB_HOST');
$username = getenv('DB_USER');
$password = getenv('DB_PASS');
$database = getenv('DB_NAME');
$db_koneksi = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$db_koneksi) {
    die("Connection failed: " . mysqli_connect_error());
}

$cek_token_lokal = mysqli_query($db_koneksi, "SELECT * FROM master_api_bnsp");
$data_lokal = mysqli_fetch_assoc($cek_token_lokal);
$bnspUser = getenv('BNSP_API_USER');
$bnspKey = getenv('BNSP_API_KEY');
if (!$bnspUser || !$bnspKey) {
    error_log('BNSP API credentials are not set in .env');
}

if ($data_lokal['expire_date'] < date("Y-m-d H:i:s")) {
    // API Url
    $url = "https://konstruksi.bnsp.go.id/api/v1/";

    // Initiate cURL.
    $ch = curl_init($url);

    // Tell cURL that we want to send a POST request.
    curl_setopt($ch, CURLOPT_POST, 1);

    // Attach our encoded JSON string to the POST fields.
    curl_setopt($ch, CURLOPT_POSTFIELDS, '');
    // Set the content type to application/json
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'x-bnsp-user: ' . $bnspUser,
        'x-bnsp-key: ' . $bnspKey
    ));

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

    $result = curl_exec($ch);
    $array = json_decode($result, true);

    $token_bnsp = isset($array['data']['token']) ? $array['data']['token'] : '';
    $expire_date_bnsp = isset($array['data']['expire_date']) ? $array['data']['expire_date'] : '';

    if (!empty($token_bnsp) && !empty($expire_date_bnsp)) {

        $query = "UPDATE master_api_bnsp SET x_authorization = ?, expire_date = ?";
        $stmt = mysqli_prepare($db_koneksi, $query);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ss", $token_bnsp, $expire_date_bnsp);
            $execute_result = mysqli_stmt_execute($stmt);

            if (!$execute_result) {
                error_log("Gagal eksekusi update token BNSP: " . mysqli_stmt_error($stmt));
            }
            mysqli_stmt_close($stmt);

        } else {
            error_log("Gagal prepare statement BNSP: " . mysqli_error($db_koneksi));
        }
    } else {
        error_log("Gagal mendapatkan token atau expire date yang valid dari API BNSP.");
    }

} else {
    echo 'masih aktif';
}
