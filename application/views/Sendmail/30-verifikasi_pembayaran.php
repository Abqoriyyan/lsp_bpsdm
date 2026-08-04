<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran dan Surat Perjanjian Sertifikasi</title>
</head>
<body>
    <h1 style='text-align:center; color:grape;'>Notification !</h1><br/>
    Kepada Yth <br/>
    Bapak/Ibu <?=$nama?><br/><br/>

    Terima Kasih atas kepercayaan melakukan Permohonan Sertifikasi SKK di LSP <?= $get_data_lsp->username;?><br/><br/>
    
    Anda bisa menuju proses selanjutnya yaitu Proses Upload Pembayaran & Perjanjian sertifikasi Untuk Permohonan Sertifikasi SKK anda <br/>
    Dengan ID Izin (<b><?=$id_izin?></b>)<br/><br/>

    Informasi invoice, perjanjian sertifikasi, dan halaman upload Pembayaran & Perjanjian sertifikasi bisa di akses melalui:<br/>
    <a href="<?= base_url('pembayaran/checkout/').base64_encode($id_izin);?>"><button style="border:none; padding:10px 30px; background-color:#3234fb; color:#fff; border-radius:10%;">Klik Disini !</button></a><br/><br/>

    Silahkan Klik Tombol dibawah ini untuk ke bagian halaman Login<br/>

    Terima Kasih.  <br/><br/>  
    <center><img src='<?= base_url('assets/lsp/logo-lsp.png')?>' alt='Permohonan sedang di Proses'/></center>
</body>
</html>