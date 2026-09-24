<?php

function getRomawi($bln)
{
    $romawi = [
        1 => 'I',
        'II',
        'III',
        'IV',
        'V',
        'VI',
        'VII',
        'VIII',
        'IX',
        'X',
        'XI',
        'XII'
    ];
    return $romawi[(int) $bln];
}

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

function getBase64Image($path)
{
    $relative_path = str_replace(base_url(), '', $path);
    $physical_path = FCPATH . ltrim($relative_path, '/');

    if (empty($relative_path) || !file_exists($physical_path)) {
        return 'data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7';
    }

    $type = pathinfo($physical_path, PATHINFO_EXTENSION);
    $arrContextOptions = array(
        "ssl" => array(
            "verify_peer" => false,
            "verify_peer_name" => false,
        ),
    );
    $data = file_get_contents($physical_path, false, stream_context_create($arrContextOptions));
    return 'data:image/' . $type . ';base64,' . base64_encode($data);
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
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SK Komite <?= $id_izin ?></title>

    <style>
        @page {
            size: A4;
            margin: 15mm 20mm 15mm 25mm;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: "Bookman Old Style", Georgia, serif;
            font-size: 13pt;
            line-height: 1.5;
            color: #000;
            padding: 0;
            margin: 0;
        }

        .text-center {
            text-align: center;
        }

        .text-justify {
            text-align: justify;
        }

        .font-bold {
            font-weight: bold;
        }

        .mt-4 {
            margin-top: 2rem;
        }

        .mb-4 {
            margin-bottom: 2rem;
        }

        .page-break {
            page-break-after: always;
        }

        .document-container {
            width: 100%;
        }

        .kop-surat {
            width: 100%;
            margin-bottom: 10px;
        }

        .kop-surat img {
            width: 110%;
            height: auto;
            max-height: none;
        }

        .judul-surat {
            margin: 5px 0;
        }

        .judul-surat h4 {
            font-size: 13pt;
            font-weight: normal;
            margin: 0 0 3px 0;
            line-height: 1.3;
        }

        .judul-surat h5 {
            font-size: 13pt;
            margin: 0;
            font-weight: normal;
        }

        .layout-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        .layout-table td {
            vertical-align: top;
            padding: 4px 0;
        }

        .col-label {
            width: 18%;
            font-weight: normal;
        }

        .col-titik {
            width: 3%;
            text-align: center;
        }

        .col-content {
            width: 79%;
            text-align: justify;
        }

        .list-aturan {
            margin: 0;
            padding-left: 20px;
        }

        .list-aturan li {
            margin-bottom: 5px;
        }

        .signature-wrapper {
            width: 100%;
            margin-top: 30px;
        }

        .signature-table {
            width: 100%;
            border-collapse: collapse;
        }

        .signature-table td {
            vertical-align: top;
        }

        .nama-ketua {
            position: relative;
            z-index: 2;
            margin-top: 0;
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

        .signature-box {
            width: 40%;
            text-align: center;
        }

        .lampiran {
            margin: 20px;
            margin-bottom: 5px;
        }

        .lampiran h4 {
            text-align: left;
        }

        .lampiran table {
            width: 100%;
            border-collapse: collapse;
        }

        .lampiran th,
        .lampiran td {
            border: 1px solid;
            padding: 5px;
            text-align: center;
        }

        .lampiran td.text-left {
            text-align: left;
        }

        .page-break {
            page-break-after: always;
        }

        thead {
            display: table-header-group;
        }
    </style>
</head>

<body>
    <div class="document-container">

        <div class="kop-surat text-center">
            <img src="<?= getBase64Image(base_url('assets/lsp/kop-lsp.png')); ?>" alt="Kop Surat LSP">
        </div>
        <div class="judul-surat text-center">
            <h4>
                KEPUTUSAN KETUA LEMBAGA SERTIFIKASI PROFESI<br>
                BADAN PENGEMBANGAN SUMBER DAYA MANUSIA<br>
                KEMENTERIAN PEKERJAAN UMUM
            </h4>
            <h5>
                NOMOR:
                LSP/KPTS/<?= getRomawi(date('n', strtotime($get_data_pencatatan->tanggal_ditetapkan))) ?>/<?= substr($get_data_pencatatan->nomor_registrasi_lsp, -4); ?>/<?= $get_data_pencatatan->nomor_sertifikasi; ?>
            </h5>
        </div>

        <div class="judul-surat text-center mt-4">
            <h4>
                TENTANG<br>
                HASIL UJI KOMPETENSI SKEMA SERTIFIKASI<br>
                <?= strtoupper($get_data_pencatatan->jabatan_kerja); ?>
            </h4>
        </div>

        <div class="mb-4">
            <p class="text-center">
                KETUA LEMBAGA SERTIFIKASI PROFESI,
            </p>
        </div>

        <table class="layout-table">
            <tr>
                <td class="col-label">Menimbang</td>
                <td class="col-titik">:</td>
                <td class="col-content">
                    <ol class="list-aturan" type="a">
                        <li>Bahwa dalam rangka menetapkan hasil uji kompetensi skema
                            <?= $get_data_pencatatan->jabatan_kerja; ?> yang ditetapkan dalam pleno oleh Komite
                            Teknis Hasil Uji Kompetensi sebagai Tim Pengambil Keputusan Sertifikasi yang dikeluarkan
                            oleh Lembaga Sertifikasi Profesi <?= $token->username; ?>;
                        </li>
                        <li>Bahwa hasil dari keputusan pleno Komite Teknis Hasil Uji Kompetensi skema
                            <?= $get_data_pencatatan->jabatan_kerja; ?> perlu ditetapkan dalam surat keputusan.
                        </li>
                    </ol>
                </td>
            </tr>
            <tr>
                <td class="col-label">Mengingat</td>
                <td class="col-titik">:</td>
                <td class="col-content">
                    <ol class="list-aturan" type="a">
                        <li>Undang-Undang Nomor 20 Tahun 2023 tentang Aparatur Sipil Negara;</li>
                        <li>Undang-Undang Nomor 2 Tahun 2017 tentang Jasa Konstruksi;</li>
                        <li>Peraturan Pemerintah Nomor 14 Tahun 2021 tentang Perubahan Atas PP Nomor 22 Tahun 2020
                            Tentang Peraturan Pelaksanaan UU Nomor 2 Tahun 2017 tentang Jasa Konstruksi;</li>
                        <li>Peraturan Pemerintah Nomor 17 Tahun 2020 tentang Perubahan atas Peraturan Pemerintah
                            Nomor 11 Tahun 2017 tentang Manajemen Pegawai Negeri Sipil;</li>
                        <li>Pedoman Badan Nasional Sertifikasi Profesi (BNSP) 301 Nomor: 09/BNSP.301/XI/2013 tentang
                            Pedoman Pelaksanaan Uji Kompetensi;</li>
                        <li>Standar Operasional Prosedur (SOP) Lembaga Sertifikasi Profesi BPSDM Kementerian PU tentang
                            Sertifikasi Kompetensi.</li>
                    </ol>
                </td>
            </tr>
        </table>
    </div>

    <div class="page-break"></div>

    <div class="document-container">
        <h4 class="text-center mb-4">MEMUTUSKAN</h4>

        <table class="layout-table">
            <tr>
                <td class="col-label">Menetapkan</td>
                <td class="col-titik">:</td>
                <td class="col-content" style="text-transform:uppercase;">KEPUTUSAN KETUA LEMBAGA SERTIFIKASI
                    PROFESI BADAN PENGEMBANGAN SUMBER DAYA MANUSIA KEMENTERIAN PEKERJAAN UMUM
                    TENTANG HASIL UJI KOMPETENSI SKEMA
                    <?= $get_data_pencatatan->jabatan_kerja ?>
                </td>
            </tr>
            <tr>
                <td class="col-label font-bold">Pertama</td>
                <td class="col-titik">:</td>
                <td class="col-content">
                    Hasil Uji Kompetensi skema <?= $get_data_pencatatan->jabatan_kerja; ?> di LSP
                    <?= $token->username; ?> pada tanggal <?= tanggal_indo($get_data_pencatatan->tanggal_mulai); ?>
                    s/d <?= tanggal_indo($get_data_pencatatan->tanggal_selesai); ?> sebagaimana tercantum dalam
                    lampiran yang tidak terpisahkan dari Surat Keputusan Ketua LSP <?= $token->username; ?>.
                </td>
            </tr>
            <tr>
                <td class="col-label font-bold">Kedua</td>
                <td class="col-titik">:</td>
                <td class="col-content">
                    Menetapkan Kompeten atau Belum Kompeten terhadap nama-nama peserta uji kompetensi sebagaimana
                    tercantum dalam lampiran surat keputusan ini.
                </td>
            </tr>
            <tr>
                <td class="col-label font-bold">Ketiga</td>
                <td class="col-titik">:</td>
                <td class="col-content">
                    Keputusan ini mulai berlaku pada tanggal ditetapkan.
                </td>
            </tr>
        </table>

        <div class="signature-wrapper">
            <table class="signature-table">
                <tr>
                    <td width="50%" class="text-center">
                        <div style="text-align: center; display: inline-block; padding-left: 10px;">
                            ditetapkan di Bandung<br>
                            pada tanggal <?= tanggal_indo($get_data_pencatatan->tanggal_ditetapkan); ?>
                        </div>
                        <br><br>

                        Ketua LSP <?= $token->username; ?><br>
                        <div class="signature-space">

                            <?php
                            $filename = $get_data_pencatatan->ttd_ketua_pelaksana;
                            $filepath = FCPATH . 'assets/lsp/ttd_ketua_pelaksana/' . $filename;

                            if (!empty($filename) && file_exists($filepath)) {
                                $type = pathinfo($filepath, PATHINFO_EXTENSION);
                                $data = file_get_contents($filepath);
                                $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

                                echo '<center><img src="' . $base64 . '" style="max-height: 190px; max-width: 120px;"></center>';
                            } else {
                                echo '<p style="color: red; font-size: 11px;">[Tanda Tangan Tidak Ditemukan]</p>';
                            }
                            ?>

                            <?php if ($base64_stamp): ?>
                                <img src="<?= $base64_stamp ?>" class="stamp-img" alt="Stempel">
                            <?php endif; ?>
                        </div>

                        <div class="nama-ketua">
                            <?= $get_data_pencatatan->nama_ketua_pelaksana; ?><br>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class="page-break"></div>

    <div class="lampiran">
        <h4>LAMPIRAN I</h4>
        <table>
            <thead>
                <tr>
                    <th width="5%">No.</th>
                    <th width="35%">Nama</th>
                    <th width="30%">Id Izin</th>
                    <th width="20%">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($get_data_hasil_penetapan_komite_teknis as $data): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td class="text-left"><?= !empty($data['nama']) ? $data['nama'] : '-' ?></td>
                        <td><?= !empty($data['id_izin']) ? $data['id_izin'] : '-' ?></td>
                        <td>
                            <?= (isset($data['hasil_penetapan_komite']) && $data['hasil_penetapan_komite'] == "Kompeten") ? "K" : "BK" ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</body>

</html>