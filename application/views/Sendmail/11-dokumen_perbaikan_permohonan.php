<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perbaikan Permohonan - Tinjau Permohonan</title>
</head>
<body>
    <h1 style='text-align:center; color:grape;'>Notification !</h1><br/>
    Kepada Yth <br/>
    Bapak/Ibu <br/><br/>

    Permohonan Sertifikasi SKK di LSP <?= $get_data_lsp->username;?> dengan id-izin (<?=$id_izin?>) Saat ini<br/><br/>
    
    Persyaratan Permohonan Sertifikasi belum melengkapi,
    Silahkan lakukan perbaikan di Portal Perizinan <br/>
    Dengan catatan :<br/>
    <?php
        foreach($get_data_perbaikan as $data_perbaikan){
            echo "- ".$data_perbaikan['deskripsi'];
        }
    ?>
    <br/><br/>


    Terima Kasih.<br/><br/>  
    <center><img src='<?= base_url('assets/lsp/logo-lsp.png')?>' alt='Permohonan sedang di Proses'/></center>
    
</body>
</html>