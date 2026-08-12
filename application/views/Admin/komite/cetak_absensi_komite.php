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
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Daftar Hadir Komite Teknis</title>
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
            font-size: 12pt;
            line-height: 1.5;
            color: #000;
        }

        .kop-container {
            width: 100%;
            text-align: center;
            margin-bottom: 25px;
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
            font-size: 12pt;
            text-decoration: underline;
            font-weight: bold;
        }

        .table-noborder td {
            padding: 4px 0;
            vertical-align: top;
            font-size: 12pt;
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #000;
            padding: 10px;
            font-size: 12pt;
            vertical-align: middle;
        }

        .table-bordered th {
            background-color: #f0f0f0;
            font-weight: bold;
            text-align: center;
        }

        .ttd-col {
            height: 80px;
            position: relative;
        }

        .ttd-col span {
            position: absolute;
            display: flex;
            align-items: center;
        }

        .ttd {
            top: 10px;
            left: 10px;
        }

        .img-ttd {
            max-height: 60px;
            max-width: 90px;
            margin-left: 25px;
            margin-top: 25px;
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
        <h4>DAFTAR HADIR SIDANG KOMITE TEKNIS</h4>
    </div>

    <table class="table-noborder">
        <tr>
            <td class="td-label">No. Surat Penunjukan</td>
            <td class="td-colon">:</td>
            <td class="td-value"><?= isset($get_penunjukan->no_surat) ? $get_penunjukan->no_surat : '-'; ?></td>
        </tr>
        <tr>
            <td class="td-label">Tanggal Sidang</td>
            <td class="td-colon">:</td>
            <td class="td-value">
                <?= isset($get_absensi[0]['log']) ? tanggal_indo(date('Y-m-d', strtotime($get_absensi[0]['log']))) : tanggal_indo(date('Y-m-d')); ?>
            </td>
        </tr>
        <tr>
            <td class="td-label">Nama Asesi</td>
            <td class="td-colon">:</td>
            <td class="td-value">
                <strong><?= isset($get_data_personal->nama) ? $get_data_personal->nama : '-'; ?></strong>
            </td>
        </tr>
        <tr>
            <td class="td-label">Skema Sertifikasi</td>
            <td class="td-colon">:</td>
            <td class="td-value">
                <?= isset($get_data_klasifikasi->deskripsi_jabatan_kerja) ? $get_data_klasifikasi->deskripsi_jabatan_kerja : '-'; ?>
            </td>
        </tr>
    </table>

    <table class="table-bordered">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="35%">Nama Personil</th>
                <th width="20%">Jabatan</th>
                <th width="15%">Status</th>
                <th width="25%">Tanda Tangan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($get_absensi)):
                $no = 1;
                foreach ($get_absensi as $row):

                    $base64_ttd_personil = '';
                    if (isset($get_master_komite)) {
                        foreach ($get_master_komite as $komite) {
                            if ($row['nama_personil'] == $komite['nama']) {

                                if (!empty($komite['file_ttd'])) {
                                    $path_ttd = FCPATH . 'assets/lsp/ttd_komite/' . $komite['file_ttd'];

                                    if (file_exists($path_ttd)) {
                                        $type_ttd = pathinfo($path_ttd, PATHINFO_EXTENSION);
                                        $data_ttd = file_get_contents($path_ttd);
                                        $base64_ttd_personil = 'data:image/' . $type_ttd . ';base64,' . base64_encode($data_ttd);
                                    }
                                }
                                break;
                            }
                        }
                    }
                    ?>
                    <tr>
                        <td class="center"><?= $no; ?></td>
                        <td><?= $row['nama_personil']; ?></td>
                        <td><?= $row['jabatan_tim']; ?></td>
                        <td class="center"><?= $row['status_kehadiran']; ?></td>

                        <td class="ttd-col">
                            <?php if ($no % 2 != 0): ?>
                                <span class="ttd">
                                    <?php if ($base64_ttd_personil != '' && $row['status_kehadiran'] == 'Hadir'): ?>
                                        <img src="<?= $base64_ttd_personil ?>" class="img-ttd" alt="ttd">
                                    <?php endif; ?>
                                </span>
                            <?php else: ?>
                                <span class="ttd">
                                    <?php if ($base64_ttd_personil != '' && $row['status_kehadiran'] == 'Hadir'): ?>
                                        <img src="<?= $base64_ttd_personil ?>" class="img-ttd" alt="ttd">
                                    <?php endif; ?>
                                </span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php
                    $no++;
                endforeach;
            else:
                ?>
                <tr>
                    <td colspan="5" class="center">Data absensi belum disimpan.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</body>

</html>