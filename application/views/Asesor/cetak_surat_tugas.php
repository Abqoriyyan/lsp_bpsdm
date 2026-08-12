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

$path_kop = FCPATH . 'assets/lsp/kop-lsp.png';
$base64_kop = '';
if (file_exists($path_kop)) {
    $type = pathinfo($path_kop, PATHINFO_EXTENSION);
    $data = file_get_contents($path_kop);
    $base64_kop = 'data:image/' . $type . ';base64,' . base64_encode($data);
}

$base64_ketua = '';
if (!empty($get_data_ketua_pelaksana->file_ttd)) {
    $path_ketua = FCPATH . 'assets/lsp/ttd_ketua_pelaksana/' . $get_data_ketua_pelaksana->file_ttd;
    if (file_exists($path_ketua)) {
        $type = pathinfo($path_ketua, PATHINFO_EXTENSION);
        $data = file_get_contents($path_ketua);
        $base64_ketua = 'data:image/' . $type . ';base64,' . base64_encode($data);
    }
}

$stamp_path = FCPATH . 'assets/lsp/cap.png';
$base64_stamp = '';
if (file_exists($stamp_path)) {
    $type = pathinfo($stamp_path, PATHINFO_EXTENSION);
    $stamp_data = file_get_contents($stamp_path);
    $base64_stamp = 'data:image/' . $type . ';base64,' . base64_encode($stamp_data);
}

// Ambil data utama dari baris pertama array untuk info surat
$surat_info = isset($get_data_surat_tugas[0]) ? $get_data_surat_tugas[0] : $get_data_surat_tugas;
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>ST Asesor - <?= !empty($surat_info['nama_asesi']) ? $surat_info['nama_asesi'] : ''; ?></title>
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
            width: 105%;
            max-height: 110px;
            object-fit: contain;
        }

        .judul-surat {
            text-align: center;
            margin-bottom: 20px;
        }

        .judul-surat h4 {
            margin: 0;
            font-size: 12pt;
            text-decoration: underline;
            font-weight: bold;
        }

        .judul-surat p {
            margin: 0;
            font-size: 11pt;
            text-align: center;
        }

        p {
            margin-top: 0;
            margin-bottom: 10px;
            text-align: justify;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #000;
            padding: 6px 10px;
            vertical-align: middle;
            font-size: 11pt;
        }

        .table-bordered th {
            background-color: #f0f0f0;
            font-weight: bold;
            text-align: center;
        }

        .table-noborder td {
            padding: 3px 0;
            vertical-align: top;
            font-size: 11pt;
        }

        .td-label {
            width: 25%;
        }

        .td-colon {
            width: 3%;
        }

        .td-value {
            width: 72%;
        }

        .signature-section {
            margin-top: 35px;
            width: 100%;
            page-break-inside: avoid;
            text-align: center;
        }

        .signature-container-center {
            width: 100%;
            text-align: center;
        }

        .signature-container-center p {
            text-align: center;
        }

        .signature-space {
            position: relative;
            height: 75px;
            margin: 5px 0;
            width: 100%;
        }

        .signature-img {
            width: 180px;
            height: auto;
            position: absolute;
            z-index: 1;
            top: -25px;
            left: 50%;
            margin-left: -90px;
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

        .tembusan {
            margin-top: 40px;
            clear: both;
            page-break-inside: avoid;
        }

        .tembusan p {
            margin: 0;
        }

        .list-section {
            margin-bottom: 15px;
        }

        .list-title {
            font-weight: bold;
            margin-bottom: 8px;
        }

        .center {
            text-align: center;
        }
    </style>
</head>

<body>

    <!-- KOP Surat -->
    <div class="kop-container">
        <?php if ($base64_kop != ''): ?>
            <img src="<?= $base64_kop ?>" alt="Kop Surat LSP">
        <?php else: ?>
            <h2 style="color:red; font-size:14pt;">[KOP SURAT TIDAK DITEMUKAN]</h2>
        <?php endif; ?>
    </div>

    <!-- Judul Surat -->
    <div class="judul-surat">
        <h4>SURAT TUGAS</h4>
        <p>Nomor:
            <?= isset($surat_info['no_surat_tugas']) ? $surat_info['no_surat_tugas'] : '-'; ?>/ST/LSP/<?= isset($surat_info['tanggal_mulai']) ? date('Y', strtotime($surat_info['tanggal_mulai'])) : '-'; ?>
        </p>
    </div>

    <!-- Paragraf Pembuka -->
    <p>Yang bertanda tangan di bawah ini, atas nama Ketua Lembaga Sertifikasi Profesi Badan Pengembangan Sumber Daya
        Manusia Kementerian Pekerjaan Umum (LSP
        <?= isset($token->username) ? $token->username : ''; ?>):
    </p>

    <!-- Poin Kesatu -->
    <div class="list-section">
        <div class="list-title">KESATU: Memerintahkan kepada Asesor Kompetensi LSP
            <?= isset($token->username) ? $token->username : ''; ?> berikut:
        </div>

        <table class="table-bordered">
            <thead>
                <tr>
                    <th width="5%">No.</th>
                    <th width="50%">Nama</th>
                    <th width="45%">No. Registrasi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($get_data_surat_tugas as $asesor): ?>
                    <tr>
                        <td class="center"><?= $no++; ?></td>
                        <td><?= isset($asesor['nama_asesor']) ? $asesor['nama_asesor'] : '-'; ?></td>
                        <td class="center">
                            <?= isset($asesor['no_reg_bnsp_asesor']) ? $asesor['no_reg_bnsp_asesor'] : '-'; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <p style="margin-top:15px; margin-bottom:5px;">Untuk melaksanakan kegiatan asesmen untuk Skema
            <strong><?= isset($surat_info['jabatan_kerja']) ? $surat_info['jabatan_kerja'] : '-'; ?></strong> pada:
        </p>

        <table class="table-noborder" style="margin-left: 15px; width: 95%;">
            <tr>
                <td class="td-label">Nama TUK</td>
                <td class="td-colon">:</td>
                <td class="td-value">
                    <strong><?= isset($surat_info['nama_tuk']) ? $surat_info['nama_tuk'] : '-'; ?></strong>
                </td>
            </tr>
            <tr>
                <td class="td-label">Alamat</td>
                <td class="td-colon">:</td>
                <td class="td-value"><?= isset($surat_info['alamat']) ? $surat_info['alamat'] : '-'; ?></td>
            </tr>
            <tr>
                <td class="td-label">Tanggal</td>
                <td class="td-colon">:</td>
                <td class="td-value">
                    <?= isset($surat_info['tanggal_mulai']) ? tanggal_indo(date('Y-m-d', strtotime($surat_info['tanggal_mulai']))) : '-'; ?>
                    s/d
                    <?= isset($surat_info['tanggal_selesai']) ? tanggal_indo(date('Y-m-d', strtotime($surat_info['tanggal_selesai']))) : '-'; ?>
                </td>
            </tr>
        </table>

        <p style="margin-top:15px; margin-bottom:5px;">Dengan data asesi sebagai berikut:</p>
        <table class="table-noborder" style="margin-left: 15px; width: 95%;">
            <tr>
                <td class="td-label">Nama Asesi</td>
                <td class="td-colon">:</td>
                <td class="td-value">
                    <strong><?= isset($surat_info['nama_asesi']) ? $surat_info['nama_asesi'] : '-'; ?></strong>
                </td>
            </tr>
            <tr>
                <td class="td-label">Unit Kerja</td>
                <td class="td-colon">:</td>
                <td class="td-value">
                    <?= isset($surat_info['perusahaan_asesi']) ? $surat_info['perusahaan_asesi'] : '-'; ?>
                </td>
            </tr>
            <tr>
                <td class="td-label">Jenis Permohonan</td>
                <td class="td-colon">:</td>
                <td class="td-value">
                    <?php
                    if (isset($surat_info['jenis_permohonan'])) {
                        if ($surat_info['jenis_permohonan'] == 1) {
                            echo 'Baru';
                        } elseif ($surat_info['jenis_permohonan'] == 2) {
                            echo 'Perpanjangan';
                        } else {
                            echo '-';
                        }
                    } else {
                        echo '-';
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td class="td-label">Jenjang</td>
                <td class="td-colon">:</td>
                <td class="td-value"><?= isset($surat_info['jenjang']) ? $surat_info['jenjang'] : '-'; ?></td>
            </tr>
        </table>
    </div>

    <!-- Poin Kedua -->
    <div class="list-section" style="margin-top: 25px;">
        <div class="list-title">KEDUA: Melaksanakan tugas dengan penuh tanggung jawab dan independen serta melaporkan
            hasil asesmen segera setelah kegiatan pelaksanaan asesmen selesai.</div>
        <p>Demikian surat tugas ini dibuat untuk dapat dilaksanakan sebagaimana mestinya.</p>
    </div>

    <!-- REFIXTURE: Struktur Tanda Tangan Tengah Bawah & Overlap Teks Nama -->
    <div class="signature-section">
        <div class="signature-container-center">
            <p style="margin-bottom: 0px;">Bandung,
                <?= isset($surat_info['log']) ? tanggal_indo(date('Y-m-d', strtotime($surat_info['log']))) : tanggal_indo(date('Y-m-d')); ?>
            </p>

            <p style="margin-bottom: 0px;">Ketua LSP
                <?= isset($token->username) ? $token->username : ''; ?>
            </p>

            <div class="signature-space">
                <?php if ($base64_ketua != ''): ?>
                    <img src="<?= $base64_ketua ?>" class="signature-img" alt="TTD Ketua Pelaksana">
                <?php endif; ?>

                <?php if ($base64_stamp): ?>
                    <img src="<?= $base64_stamp ?>" class="stamp-img" alt="Stempel Resmi">
                <?php endif; ?>
            </div>

            <span class="name-under-signature">
                <strong><u><?= isset($get_data_ketua_pelaksana->nama) ? $get_data_ketua_pelaksana->nama : '-'; ?></u></strong><br>
            </span>
        </div>
    </div>

    <!-- Tembusan -->
    <div class="tembusan">
        <p>Tembusan:</p>
        <p>1. Yang bersangkutan;<br>
            2. Arsip.</p>
    </div>

</body>

</html>