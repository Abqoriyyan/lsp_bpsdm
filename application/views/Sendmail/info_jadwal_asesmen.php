<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Jadwal Asesmen - Permohonan Sertifikasi</title>
</head>
<body>
    <h1 style='text-align:center; color:grape;'>Notification !</h1><br/>
    Kepada Yth <br/>
    Bapak/Ibu <?= $get_data_personal_permohonan[0]['nama']?> <br/><br/>

    Permohonan Sertifikasi Anda dengan permohonan ID-Izin ( <?= $id_izin;?>  ) - Info Jadwal Asesmen,<br/><br/>
    
    Nama TUK : <?= $get_data_penunjukan_asesor->nama_tuk; ?><br/>
    Alamat : <?= $get_data_penunjukan_asesor->alamat; ?><br/>
    Jadwal : <?= $get_data_penunjukan_asesor->tanggal_mulai; ?> s/d <?= $get_data_penunjukan_asesor->tanggal_mulai; ?><br/>
    
    <br/>

    Mohon untuk datang ke Alamat TUK sesuai jadwal yang sudah di tentukan. 
    <br/><br/>

    Terima Kasih.   <br/><br/>  
    <center><img src='<?= base_url('assets/lsp/logo-lsp.png')?>' alt='Permohonan sedang di Proses'/></center>
</body>
</html>