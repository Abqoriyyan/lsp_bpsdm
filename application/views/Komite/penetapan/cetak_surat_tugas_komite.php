<?php

function getRomawi($bln){
    switch ($bln){
            case 1: 
                return "I";
                break;
            case 2:
                return "II";
                break;
            case 3:
                return "III";
                break;
            case 4:
                return "IV";
                break;
            case 5:
                return "V";
                break;
            case 6:
                return "VI";
                break;
            case 7:
                return "VII";
                break;
            case 8:
                return "VIII";
                break;
            case 9:
                return "IX";
                break;
            case 10:
                return "X";
                break;
            case 11:
                return "XI";
                break;
            case 12:
                return "XII";
                break;
      }
}


function tanggal_indo($tanggal)
{
	$bulan = array (1 =>   'Januari',
				'Februari',
				'Maret',
				'April',
				'Mei',
				'Juni',
				'Juli',
				'Agustus',
				'September',
				'Oktober',
				'November',
				'Desember'
			);
	$split = explode('-', $tanggal);
	return $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Tugas Komite - Permohona ID-Izin (<?= $id_izin ?>)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<style>
        * {
            padding:0;
            margin:0;
            font-family: Arial, Helvetica, sans-serif; 
        }
        body {
            padding:0;
            margin:0;
            font-style: normal;
            font-variant: normal;
        }
</style>
<body>
    <!-- KOP Surat -->
    <?php
        $path = base_url('assets/lsp/kop-lsp.png');
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $arrContextOptions=array(
        "ssl"=>array(
            "verify_peer"=>false,
            "verify_peer_name"=>false,
        ),
        );
        $data = file_get_contents($path, false, stream_context_create($arrContextOptions));
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
    ?>
    <img src="<?=$base64 ;?>" width="100%" height="250px" style="margin:0;">
    <!-- /KOP Surat -->
    
    <div style="margin:30px; margin-top:-50px;">
        <h4 style="text-align:center;">SURAT PERINTAH TUGAS<br/>
        LEMBAGA SERTIFIKASI PROFESI <?= $get_data_lsp->username;?><br/>
        NOMOR : <?= $get_data_penetapan_komite_lpjk->no_surat_tugas; ?> /SPT/LSP/<?= getRomawi(date('n',strtotime($get_data_pencatatan->tanggal_ditetapkan)))?>/<?= substr($get_data_pencatatan->nomor_registrasi_lsp, -4);?></h4>
    </div>

    <div style="margin:80px; margin-top:40px;">
    Dengan ini Lembaga Sertifikasi Profesi <?= $get_data_lsp->username;?> menugaskan kepada Komite Pengambilan Keputusan (Komite Teknis), sbb : 
        <table style="width:100%; text-align:justify; font-size:15px;   border-spacing: 0 15px;">
            <tr>
                <td style="width:30%; vertical-align: baseline;" >Nama</td>
                <td style="width:5%; vertical-align: baseline;"> : </td>
                <td style="width:65%; vertical-align: baseline;"><?= $get_data_penetapan_komite_lpjk->nama_komite_teknis;?></td>
            </tr>
            <tr>
                <td style="width:30%; vertical-align: baseline;" >Jabatan</td>
                <td style="width:5%; vertical-align: baseline;"> : </td>
                <td style="width:65%; vertical-align: baseline;"><?= $get_data_penetapan_komite_lpjk->jabatan_komite_teknis;?></td>
            </tr>
            <tr>
                <td style="width:30%; vertical-align: baseline;" >Permohonan dengan Id-Izin</td>
                <td style="width:5%; vertical-align: baseline;"> : </td>
                <td style="width:65%; vertical-align: baseline;"><?= $get_data_penetapan_komite_lpjk->id_izin;?></td>
            </tr>
            <tr>
                <td style="width:30%; vertical-align: baseline;" >Skema</td>
                <td style="width:5%; vertical-align: baseline;"> : </td>
                <td style="width:65%; vertical-align: baseline;"><?= $get_data_penetapan_komite_lpjk->skema;?></td>
            </tr>
        </table><br/>
        Demikian disampaikan, harap segera dilaksanakan dan melapor setelah selesai.<br/><br/><br/>
        <p style="text-align:right;">Dikeluarkan pada Tanggal <?= tanggal_indo($get_data_penetapan_komite_lpjk->tgl_surat_tugas);?></p>
        <br/><br/><br/>
        <h4 style="text-align:center;">LEMBAGA SERTIFIKASI PROFESI <?= $get_data_lsp->username;?></h4>
        <br/>
        <!-- KOP Surat -->
        <?php
            $path = base_url('assets/lsp/ttd_ketua_pelaksana/').$get_data_pencatatan->ttd_ketua_pelaksana;
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $arrContextOptions=array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
            );
            $data = file_get_contents($path, false, stream_context_create($arrContextOptions));
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        ?>
        <center><img src="<?=$base64 ;?>" style="max-height: 190px; max-width: 120px;"></center>
        <!-- /KOP Surat -->
        <center><b>(<?= $get_data_pencatatan->ketua_pelaksana;?>)</b><br>Ketua Pelaksana</center>
    </div>
</body>
</html>