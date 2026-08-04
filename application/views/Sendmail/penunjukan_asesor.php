<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Tugas Asesor</title>
</head>
<body>
    <h1 style='text-align:center; color:grape;'>Notification !</h1><br/>
    Kepada Yth <br/>
    Bapak/Ibu <?= $nama_asesor?> <br/><br/>

    Surat Tugas Asesor LSP <?= $get_data_lsp->username;?>,<br/></br/>
    
    Anda telah ditunjuk sebagai asesor untuk permohonan badan usaha Dengan Dengan ID Izin : <?= $id_izin?><br>
    Mohon untuk segera login kedalam sistem LSP untuk melakukan asesment sesuai jadwal yang tertera di Surat Tugas.<br/>
    <a href="<?= base_url('asesor/cetak_surat_tugas/').base64_encode($id_izin);?>"><button style="border:none; padding:10px 30px; background-color:#3234fb; color:#fff; border-radius:10%;">Surat Tugas Disini</button></a><br/><br/>
    <br/><br/>

    Terima Kasih. <br/><br/>  
    <center><img src='<?= base_url('assets/lsp/logo-lsp.png')?>' alt='Permohonan sedang di Proses'/></center>  
</body>
</html>