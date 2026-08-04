<?php
date_default_timezone_set('Asia/Jakarta');
     
$servername = "10.130.12.176";
$database = "sis_bpsdm";
$username = "lsp";
$password = "lspbpsdm1!";
$db_koneksi = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$db_koneksi) {
    die("Connection failed: " . mysqli_connect_error());
}

$cek_token_lokal = mysqli_query($db_koneksi, "SELECT * FROM master_api_bnsp");
$data_lokal = mysqli_fetch_assoc($cek_token_lokal);

    if($data_lokal['expire_date'] < date("Y-m-d H:i:s")){
        // API Url
        $url = "https://konstruksi.bnsp.go.id/api/v1/";
                    
        // Initiate cURL.
        $ch = curl_init($url);

        // Tell cURL that we want to send a POST request.
        curl_setopt($ch, CURLOPT_POST, 1);

        // Attach our encoded JSON string to the POST fields.
        curl_setopt($ch, CURLOPT_POSTFIELDS,'');
        // Set the content type to application/json
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'x-bnsp-user: l5p-bPsdmpupr',
            'x-bnsp-key: l5pBP5DMPUPR2023@@'
        ));

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

        // Execute the request
        $result = curl_exec($ch);
        $array = json_decode($result,true);
//        print_r($result);

        $token_bnsp = $array['data']['token'];
        $expire_date_bnsp = $array['data']['expire_date'];

        mysqli_query($db_koneksi,"UPDATE master_api_bnsp SET x_authorization = '$token_bnsp', expire_date = '$expire_date_bnsp'");

        }else{
            echo 'masih aktif';
        }

?>
