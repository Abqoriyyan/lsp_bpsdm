<?php
function tanggal_indo($tanggal)
{
    $bulan = array(
        1 => 'Januari',
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
    return $split[2] . ' ' . $bulan[(int) $split[1]] . ' ' . $split[0];
}

function tanggal_en($tanggal_en)
{
    /** ARRAY HARI DAN BULAN**/
    $bulan_en = array(
        1 => 'January',
        'February',
        'March',
        'April',
        'May',
        'June',
        'July',
        'August',
        'September',
        'October',
        'November',
        'December'
    );
    $split_en = explode('-', $tanggal_en);
    return $bulan_en[(int) $split_en[1]] . ' ' . $split_en[2] . ', ' . $split_en[0];
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SKKK
        <?= $get_data_pencatatan->nama ?>
    </title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;

        }

        page {
            position: relative;
            background: white;
            display: block;
            margin: 0 auto;
            margin-bottom: 0.5cm;
            box-shadow: 0 0 0.5cm rgba(0, 0, 0, 0.5);

        }

        page[size="A4"] {
            width: 21cm;
            height: 29.7cm;
        }

        .page_1 {
            background-image: url("../assets/sertifikat/dpnbnsp.png");
            background-size: cover;
            background-repeat: no-repeat;
            box-sizing: border-box;
        }

        .page_2 {
            background-image: url('../assets/sertifikat/blkgbnsp2.png');
            background-size: cover;
            background-repeat: no-repeat;
            box-sizing: border-box;
        }

        .srtf-body {
            position: relative;
            top: 7cm;
            height: 700px;
            width: 15cm;
            margin-left: 3.3cm;
            margin-right: 3cm;
            z-index: 2;
            box-sizing: border-box;
        }

        .srtf-body2 {
            position: relative;
            top: 6cm;
            margin-left: 2.3cm;
            margin-right: 2cm;
            z-index: 2;
            box-sizing: border-box;
        }

        .unit-kompetensi {
            position: relative;
            top: 2.5cm;
            width: 95%;
            box-sizing: border-box;
            z-index: 2;
        }

        .watermark {
            color: lightgrey;
            font-size: 120pt;
            /* -webkit-transform: rotate(-45deg);
            -moz-transform: rotate(-45deg); */
            position: absolute;
            margin-top: 200px;
            margin-left: -50px;
            z-index: -1;
        }

        .tanda-tangan {
            margin-top: 0.5cm;

            box-sizing: border-box;
            z-index: 2;
        }

        table {
            table-layout: fixed;
            border-collapse: collapse;
            border: 0;
        }

        td {
            padding: 0 1px;
        }

        th {
            padding: 2px;
        }

        header,
        footer {
            position: absolute;
            left: 0;
            right: 0;
            padding-right: 1.5cm;
            padding-left: 1.5cm;
        }

        header:after {
            content: "";
        }

        footer:after {
            content: "";
        }

        header {
            top: 0;
            padding-top: 10mm;
            padding-bottom: 3mm;
        }

        .no_blanko {
            position: absolute;
            margin-left: 0.5cm;
            margin-top: 0.5cm;
        }

        footer {
            bottom: 0.5cm;
            color: #000;
            padding-top: 3mm;
            padding-bottom: 5mm;
        }

        @media print {

            body,
            page {
                margin: 0;
                box-shadow: 0;
            }
        }
    </style>
</head>

<body data-new-gr-c-s-check-loaded="14.1065.0" data-gr-ext-installed="">
    <page class="page_1" size="A4">
        <div align="center">
            <div class="no_blanko">
                <h2><?= $get_data_pencatatan->nomor_blangko_bnsp ?></h2>
            </div>
            <div align="center" class="srtf-body">
                <p style="text-align:center; margin-top:0; padding-top:10px; font-weight:bold; font-size:18px">
                    Nomor Sertifikat / <i>Certificate Number</i><br>
                    <?= $get_data_pencatatan->nomor_sertifikat_lengkap; ?>
                </p>
                <p style="text-align:center; font-size:18px">
                    Dengan ini menyatakan bahwa,<br>
                    <i>This is to certify that,</i>
                </p>
                <p style="text-align:center; font-weight:bold; font-size:20px;">
                    <?= $get_data_pencatatan->nama ?>
                </p>
                <p style="text-align:center; font-weight:bold; font-size:18px;">
                    No. Reg. <?= $get_data_pencatatan->nomor_registrasi_lpjk ?>
                </p>
                <p style="text-align:center; font-size:18px">
                    Telah Kompeten pada bidang:<br>
                    <i>Is competent in the area of:</i>
                </p>
                <p style="text-align:center; font-weight:bold; font-size: 20px; margin-top:10px;">
                    Jasa Konstruksi<br>
                    <span style="font-size:20px; "><i>Construction Services</i></span>
                </p>
                <p style="text-align:center; font-size:18px;">
                    Dengan Kualifikasi / Kompetensi:<br>
                    <i>With Qualification / Competency:</i>
                </p>
                <p style="text-align:center; font-weight:bold; font-size:22px;">
                    <?= $get_data_pencatatan->jabatan_kerja ?><br>
                    <i><?= $get_data_pencatatan->jabatan_kerja_en ?></i>
                </p>
                <p style="text-align:center; margin-top:-5px">
                    Sertifikat ini berlaku untuk 5 (lima) tahun<br>
                    <i>This certificate is valid for 5 (five) years</i>
                </p>
                <p style="text-align:center; font-size:18px">
                    Atas nama Badan Nasional Sertifikasi Profesi<br>
                    <i>On Behalf of Indonesia Professional Certification Authority</i><br>
                </p>
                <p style="text-align:center; font-size:18px">
                    <b>Lembaga Sertifikasi Profesi <?= $data_lsp->username; ?></b><br>
                    <i><?= $data_lsp->username; ?> Professional Certification Agency</i>
                </p>
                <p style="text-align:center;">

                    <?php
                    $data = base_url('/sertifikat/validasi_signature/') . base64_encode($id_izin);
                    $path = "https://quickchart.io/chart?cht=qr&chl=" . $data . "&chs=120x120&choe=UTF-8&chld=L|2";
                    $type = pathinfo($path, PATHINFO_EXTENSION);
                    $arrContextOptions = array(
                        "ssl" => array(
                            "verify_peer" => false,
                            "verify_peer_name" => false,
                        ),
                    );
                    $data = file_get_contents($path, false, stream_context_create($arrContextOptions));
                    $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                    echo '<img src="' . $base64 . '" width="70px" style="text-align:center; margin-left: -9px; margin-top: -6px; border:0px solid #fff;">';
                    ?>
                    <br>
                    <b style="text-align:center;"><?= $get_data_pencatatan->ketua_pelaksana; ?></b><br>
                </p>

                <p style="text-align:center;margin-top:-15px">
                    <span style="font-size:15px; "><b>Ketua LSP</b><br></span>
                    <span style="font-size:13px; "><i>Chairman PCA</i></span>
                </p>
            </div>
        </div>
    </page>
    <pagebreak>
        <page class="page_2" size="A4">
            <header>
                <p style="text-align:center">
                    <img src="<?= base_url('assets/sertifikat/pupr.png') ?>" width="70px">
                </p>
                <p style="text-align:center; margin-top:0px; font-weight:bold; font-size:20px; padding-top:-10px; ">
                    LEMBAGA PENGEMBANGAN<br>
                    JASA KONSTRUKSI<br>
                    <i>CONSTRUCTION SERVICES<br>
                        DEVELOPMENT BOARD</i>
                </p>
            </header>
            <div align="center" class="srtf-body2">
                <h3 style="text-align:center; font-weight:bold; padding-top:40px;">
                    Daftar Unit Kompetensi:<br>
                    <i style="font-size: 15px">List of Unit(s) of Competency:</i>
                </h3>
                <table border="0" width="100%" cellspacing="0" cellpadding="0">
                    <tbody>
                        <tr>
                            <td colspan=" 5" style="font-size:20px;">Klasifikasi</td>
                            <td colspan=" 1" style="font-size:20px;">:</td>
                            <td colspan="14" style="font-size:20px;"><?= $get_data_pencatatan->klasifikasi ?></td>
                        </tr>
                        <tr>
                            <td colspan=" 5" style="font-size:20px; padding-bottom:10px;"><i>Classification</i></td>
                            <td colspan=" 1" style="font-size:20px; padding-bottom:10px;"><i>:</i></td>
                            <td colspan="14" style="font-size:20px; padding-bottom:10px;">
                                <i><?= $get_data_pencatatan->klasifikasi_en ?></i>
                            </td>
                        </tr>
                        <tr>
                            <td colspan=" 5" style="font-size:20px;">Subklasifikasi</td>
                            <td colspan=" 1" style="font-size:20px;">:</td>
                            <td colspan="14" style="font-size:20px;"><?= $get_data_pencatatan->subklasifikasi ?></td>
                        </tr>
                        <tr>
                            <td colspan=" 5" style="font-size:20px; padding-bottom:10px;"><i>Subclassification</i></td>
                            <td colspan=" 1" style="font-size:20px; padding-bottom:10px;"><i>:</i></td>
                            <td colspan="14" style="font-size:20px; padding-bottom:10px;">
                                <i><?= $get_data_pencatatan->subklasifikasi_en ?></i>
                            </td>
                        </tr>
                        <tr>
                            <td colspan=" 5" style="font-size:20px;">Kualifikasi</td>
                            <td colspan=" 1" style="font-size:20px;">:</td>
                            <td colspan="14" style="font-size:20px;"><?= $get_data_pencatatan->kualifikasi ?></td>
                        </tr>
                        <tr>
                            <td colspan=" 5" style="font-size:20px; padding-bottom:10px;"><i>Qualification</i></td>
                            <td colspan=" 1" style="font-size:20px; padding-bottom:10px;"><i>:</i></td>
                            <td colspan="14" style="font-size:20px; padding-bottom:10px;">
                                <i><?= $get_data_pencatatan->kualifikasi_en ?></i>
                            </td>
                        </tr>
                        <tr>
                            <td colspan=" 5" style="font-size:20px;">Jenjang</td>
                            <td colspan=" 1" style="font-size:20px;">:</td>
                            <td colspan="14" style="font-size:20px;">
                                <?= $get_data_pencatatan->jenjang . ' ' . $get_data_pencatatan->deskripsi_jenjang ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan=" 5" style="font-size:20px; padding-bottom:10px;"><i>Level</i></td>
                            <td colspan=" 1" style="font-size:20px; padding-bottom:10px;"><i>:</i></td>
                            <td colspan="14" style="font-size:20px; padding-bottom:10px;">
                                <i><?= $get_data_pencatatan->jenjang . ' ' . $get_data_pencatatan->deskripsi_jenjang_en ?></i>
                            </td>
                        </tr>
                        <tr>
                            <td colspan=" 5" style="font-size:20px;">Okupasi</td>
                            <td colspan=" 1" style="font-size:20px;">:</td>
                            <td colspan="14" style="font-size:20px;"><?= $get_data_pencatatan->jabatan_kerja ?></td>
                        </tr>
                        <tr>
                            <td colspan=" 5" style="font-size:20px; padding-bottom:10px;"><i>Occupation</i></td>
                            <td colspan=" 1" style="font-size:20px; padding-bottom:10px;"><i>:</i></td>
                            <td colspan="14" style="font-size:20px; padding-bottom:10px;">
                                <i><?= $get_data_pencatatan->jabatan_kerja_en ?></i>
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>
            <footer>
                <div class="tanda-tangan">
                    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-size:14px;">
                        <tbody>
                            <tr>
                                <td colspan="7" style="width:35%; text-align:center;">
                                </td>
                                <td colspan="4" style="width:20%;"></td>
                                <td colspan="9" style="width:45%;text-align:center;">
                                    Ditetapkan di Jakarta, <?= tanggal_indo($get_data_pencatatan->tanggal_ditetapkan) ?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="7" style="width:35%; text-align:center;">
                                </td>
                                <td colspan="4" style="width:20%;"></td>
                                <td colspan="9" style="width:45%;text-align:center;padding-bottom:10px;">
                                    <i>Enacted in Jakarta,
                                        <?= tanggal_en($get_data_pencatatan->tanggal_ditetapkan) ?></i>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="7" style="width:35%; text-align:center; vertical-align:top;">
                                    <!-- <img src="https://lpjk.pu.go.id/dev-sertifikat/assets/sertifikat/pas_foto.jpg" width="100px"> -->
                                    <img src="<?= $get_data_personal_permohonan->pas_foto; ?>" width="100px">
                                    <figcaption style="font-size:16px; padding-top:5px;">
                                        <?= $get_data_pencatatan->nama; ?>
                                    </figcaption>
                                </td>
                                <td colspan="4" style="width:20%;"></td>
                                <td colspan="9" style="width:45%; text-align:center; vertical-align:top; ">
                                    <img src="data:image/png;base64,<?= $get_data_pencatatan->qr; ?>" width="60%">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <p style="text-align:justify; font-size:12px;">
                        Keterangan / <i>Remarks</i> :<br>
                    </p>
                    <ol style="margin-left:-0.7cm; font-size:12px;">
                        <li style="text-align:justify; line-height:120%">
                            Sertifikat ini sah berlaku setelah tercatat yang dibuktikan dengan nomor registrasi
                            Sertifikat Kompetensi Kerja Konstruksi. /<br>
                            <i>This certificate is valid upon being registered as evidenced by registration number of
                                Certificate of Competency of Contruction Works.</i>
                        </li>
                        <li style="text-align:justify; line-height:120%">
                            QR Code dan Data yang tertera dalam sertifikat ini dapat diverifikasi melalui sistem
                            informasi jasa konstruksi terintegrasi. /<br>
                            <i>QR Code and Data contained herein may be verified through an integrated information
                                system of construction service.</i>
                        </li>
                    </ol>
                    <p></p>
                </div>
            </footer>
        </page>
    </pagebreak>
</body>
<grammarly-desktop-integration data-grammarly-shadow-root="true"></grammarly-desktop-integration>

</html>