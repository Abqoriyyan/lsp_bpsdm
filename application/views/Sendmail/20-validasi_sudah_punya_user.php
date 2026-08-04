<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permohonan Sedang Diproses Validasi</title>
</head>
<body>
    <h1 style='text-align:center; color:grape;'>Notification !</h1><br/>
    Kepada Yth <br/>
    Bapak/Ibu <?=$nama?><br/><br/>

    Terima Kasih atas kepercayaan melakukan Permohonan Sertifikasi SKK di LSP <?= $get_data_lsp->username;?><br/><br/>
    Untuk Saat ini permohonan Sertifikasi SKK anda dengan ID Jabatan Kerja - <?=$jabker?> sedang Proses Verifikasi dan Validasi<br/><br/>

    Silahkan Klik Tombol dibawah ini untuk ke bagian halaman Login<br/>
    <a href="<?= base_url();?>"><button style="border:none; padding:10px 30px; background-color:#3234fb; color:#fff; border-radius:10%;">Login</button></a></center><br/><br/>

    Terima Kasih. <br/><br/>  
    <center><img src='<?= base_url('assets/lsp/logo-lsp.png')?>' alt='Permohonan sedang di Proses'/></center>
</body>
</html>