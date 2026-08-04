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

// 1. Base64 KOP Surat
$path_kop = FCPATH . 'assets/lsp/kop-lsp.png';
$base64_kop = '';
if (file_exists($path_kop)) {
    $type = pathinfo($path_kop, PATHINFO_EXTENSION);
    $data = file_get_contents($path_kop);
    $base64_kop = 'data:image/' . $type . ';base64,' . base64_encode($data);
}

// 2. Base64 TTD Ketua Pelaksana
$base64_ketua = '';
if (!empty($get_data_ketua_pelaksana->file_ttd)) {
    $path_ketua = FCPATH . 'assets/lsp/ttd_ketua_pelaksana/' . $get_data_ketua_pelaksana->file_ttd;
    if (file_exists($path_ketua)) {
        $type = pathinfo($path_ketua, PATHINFO_EXTENSION);
        $data = file_get_contents($path_ketua);
        $base64_ketua = 'data:image/' . $type . ';base64,' . base64_encode($data);
    }
}

// 3. Base64 Cap/Stempel
$stamp_path = FCPATH . 'assets/lsp/cap.png';
$base64_stamp = '';
if (file_exists($stamp_path)) {
    $type = pathinfo($stamp_path, PATHINFO_EXTENSION);
    $stamp_data = file_get_contents($stamp_path);
    $base64_stamp = 'data:image/' . $type . ';base64,' . base64_encode($stamp_data);
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Surat Penunjukan Komite Teknis</title>
    <style>
        @page {
            margin: 50px 70px;
        }

        * {
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            margin: 0;
            padding: 0;
            font-size: 11pt;
            line-height: 1.5;
            color: #000;
        }

        .kop-container {
            width: 100%;
            text-align: center;
            margin-bottom: 20px;
        }

        .kop-container img {
            width: 100%;
            max-height: 110px;
            object-fit: contain;
        }

        .judul-surat {
            text-align: center;
            margin-bottom: 25px;
        }

        .judul-surat h4 {
            margin: 0;
            font-size: 11pt;
            text-decoration: underline;
            font-weight: bold;
        }

        .judul-surat p {
            margin: 0;
            font-size: 11pt;
        }

        p {
            margin-top: 0;
            margin-bottom: 10px;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        .isi p {
            margin: 0;
            font-size: 11pt;
            margin-top: 0;
            margin-bottom: 10px;
            text-align: justify;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #000;
            padding: 8px 12px;
            font-size: 11pt;
        }

        .table-bordered th {
            background-color: #f0f0f0;
            font-weight: bold;
            text-align: center;
        }

        .table-noborder td {
            padding: 4px 0;
            vertical-align: top;
            font-size: 11pt;
        }

        .td-label {
            width: 30%;
        }

        .td-colon {
            width: 3%;
        }

        .td-value {
            width: 67%;
        }

        .signature-section {
            margin-top: 35px;
            width: 100%;
            page-break-inside: avoid;
        }

        .signature-container-center {
            margin: 0 auto;
            width: 300px;
            text-align: center;
        }

        .signature-container-center p {
            text-align: center;
            margin: 0;
        }

        .signature-space {
            position: relative;
            height: 90px;
            margin: 5px auto;
            width: 100%;
        }

        .signature-img {
            width: 180px;
            height: auto;
            position: absolute;
            z-index: 1;
            top: -25px;
            left: 50%;
            transform: translateX(-50%);
        }

        .stamp-img {
            width: 145px;
            height: auto;
            position: absolute;
            z-index: 3;
            top: -25px;
            left: 50%;
            margin-left: -140px;
            opacity: 0.90;
            transform: rotate(-8deg);
        }

        .name-under-signature {
            position: relative;
            z-index: 2;
            display: block;
            text-align: center;
        }

        .center {
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="kop-container">
        <?php if ($base64_kop != ''): ?>
            <img src="<?= $base64_kop ?>" alt="Kop Surat LSP">
        <?php else: ?>
            <h2 style="color:red; font-size:14pt;">[KOP SURAT TIDAK DITEMUKAN]</h2>
        <?php endif; ?>
    </div>

    <div class="judul-surat">
        <h4>SURAT PENUNJUKAN KOMITE TEKNIS</h4>
        <p>No:
            <?= isset($get_penunjukan->no_surat) ? $get_penunjukan->no_surat : '-'; ?>
        </p>
    </div>

    <div class="isi">
        <p>Membaca permohonan sertifikasi kompetensi kerja dan meninjau pemenuhan tahapan penjaminan mutu skema
            sertifikasi
            pada sistem LSP
            <?= isset($token->username) ? $token->username : ''; ?>, dengan ini menyatakan dan memutuskan menetapkan Tim
            Komite Teknis untuk melakukan verifikasi hasil asesmen terhadap:
        </p>
    </div>

    <table class="table-noborder" style="margin-bottom: 20px;">
        <tr>
            <td class="td-label">Nama Asesi</td>
            <td class="td-colon">:</td>
            <td class="td-value"><strong>
                    <?= isset($get_data_personal_permohonan->nama) ? $get_data_personal_permohonan->nama : '-'; ?>
                </strong></td>
        </tr>
        <tr>
            <td class="td-label">Skema Sertifikasi</td>
            <td class="td-colon">:</td>
            <td class="td-value">
                <?= isset($get_data_klasifikasi_kualifikasi->deskripsi_jabatan_kerja) ? $get_data_klasifikasi_kualifikasi->deskripsi_jabatan_kerja : '-'; ?>
            </td>
        </tr>
    </table>

    <div class="isi">
        <p>Adapun susunan Anggota Tim Komite Teknis yang ditunjuk bertugas adalah sebagai berikut:</p>
    </div>

    <?php
    $no_reg_ketua = '-';
    $no_reg_anggota1 = '-';
    $no_reg_anggota2 = '-';

    if (isset($get_master_komite)) {
        foreach ($get_master_komite as $komite) {
            // CATATAN: Ubah ['no_reg'] di bawah ini menyesuaikan dengan nama kolom nomor registrasi di tabel master_komite milikmu (misal: no_reg_bnsp, no_registrasi, atau nik)
    
            if (isset($get_penunjukan->ketua_komite) && $get_penunjukan->ketua_komite == $komite['nama']) {
                $no_reg_ketua = isset($komite['no_reg']) ? $komite['no_reg'] : '-';
            }
            if (isset($get_penunjukan->anggota_1) && $get_penunjukan->anggota_1 == $komite['nama']) {
                $no_reg_anggota1 = isset($komite['no_reg']) ? $komite['no_reg'] : '-';
            }
            if (isset($get_penunjukan->anggota_2) && $get_penunjukan->anggota_2 == $komite['nama']) {
                $no_reg_anggota2 = isset($komite['no_reg']) ? $komite['no_reg'] : '-';
            }
        }
    }
    ?>

    <table class="table-bordered">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="35%">Nama Personil Komite</th>
                <th width="30%">No. Registrasi</th>
                <th width="30%">Jabatan Dalam Tim</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="center">1</td>
                <td><?= isset($get_penunjukan->ketua_komite) ? $get_penunjukan->ketua_komite : '-'; ?></td>
                <td class="center"><?= $no_reg_ketua; ?></td>
                <td>Ketua Komite Teknis</td>
            </tr>
            <tr>
                <td class="center">2</td>
                <td><?= isset($get_penunjukan->anggota_1) ? $get_penunjukan->anggota_1 : '-'; ?></td>
                <td class="center"><?= $no_reg_anggota1; ?></td>
                <td>Anggota</td>
            </tr>
            <tr>
                <td class="center">3</td>
                <td><?= isset($get_penunjukan->anggota_2) ? $get_penunjukan->anggota_2 : '-'; ?></td>
                <td class="center"><?= $no_reg_anggota2; ?></td>
                <td>Anggota</td>
            </tr>
        </tbody>
    </table>

    <div class="isi">
        <p style="margin-top: 20px;">Tim Komite Teknis yang ditunjuk berkewajiban menjaga kerahasiaan, bertindak
            independen, serta memberikan rekomendasi hasil kelayakan sertifikasi kepada Ketua LSP untuk
            diteruskan ke Badan Nasional Sertifikasi Profesi (BNSP).
        </p>
    </div>

    <div class="signature-section">
        <div class="signature-container-center">
            <p>Ditetapkan di: Bandung</p>
            <p style="margin-bottom:10px;">Pada tanggal:
                <?= isset($get_penunjukan->log) ? tanggal_indo(date('Y-m-d', strtotime($get_penunjukan->log))) : tanggal_indo(date('Y-m-d')); ?>
            </p>
            <p>Ketua LSP
                <?= isset($token->username) ? $token->username : ''; ?>,
            </p>

            <div class="signature-space">
                <?php if ($base64_ketua != ''): ?>
                    <img src="<?= $base64_ketua ?>" class="signature-img" alt="TTD Ketua">
                <?php endif; ?>

                <?php if ($base64_stamp): ?>
                    <img src="<?= $base64_stamp ?>" class="stamp-img" alt="Stempel">
                <?php endif; ?>
            </div>

            <span class="name-under-signature">
                <strong><u>
                        <?= isset($get_data_ketua_pelaksana->nama) ? $get_data_ketua_pelaksana->nama : '-'; ?>
                    </u></strong>
            </span>
        </div>
    </div>

</body>

</html>