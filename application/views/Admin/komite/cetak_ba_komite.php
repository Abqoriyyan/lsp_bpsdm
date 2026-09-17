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
    return $split[0] . ' ' . $bulan[(int) $split[1]];
}

function tanggal_indo_full($tanggal)
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

// -------------------------------------------------------------
// EXTRACT VARIABEL DENGAN SAFE-CHECK (BISA OBJECT / ARRAY)
// -------------------------------------------------------------

// 1. Data Personal / Pemohon
$nama_peserta = '-';
$nik_peserta = '-';
if (!empty($get_data_personal)) {
    if (is_object($get_data_personal)) {
        $nama_peserta = $get_data_personal->nama ?? '-';
        $nik_peserta = $get_data_personal->nik ?? '-';
    } elseif (is_array($get_data_personal)) {
        $nama_peserta = $get_data_personal['nama'] ?? '-';
        $nik_peserta = $get_data_personal['nik'] ?? '-';
    }
}

// 2. Data Klasifikasi (Menggunakan deskripsi_jabatan_kerja dari JOIN master)
$jabatan_kerja = '-';
if (!empty($get_data_klasifikasi)) {
    if (is_object($get_data_klasifikasi)) {
        $jabatan_kerja = $get_data_klasifikasi->deskripsi_jabatan_kerja
            ?? $get_data_klasifikasi->jabatan_kerja
            ?? '-';
    } elseif (is_array($get_data_klasifikasi)) {
        $jabatan_kerja = $get_data_klasifikasi['deskripsi_jabatan_kerja']
            ?? $get_data_klasifikasi['jabatan_kerja']
            ?? '-';
    }
}

// 3. Data BA Pleno
$tgl_pleno = date('Y-m-d');
$hasil_rekomendasi = '-';
$catatan_pleno = '-';
if (!empty($get_ba)) {
    if (is_object($get_ba)) {
        $tgl_pleno = !empty($get_ba->tgl_pleno) ? $get_ba->tgl_pleno : date('Y-m-d');
        $hasil_rekomendasi = $get_ba->hasil_rekomendasi ?? '-';
        $catatan_pleno = $get_ba->catatan ?? '-';
    } elseif (is_array($get_ba)) {
        $tgl_pleno = !empty($get_ba['tgl_pleno']) ? $get_ba['tgl_pleno'] : date('Y-m-d');
        $hasil_rekomendasi = $get_ba['hasil_rekomendasi'] ?? '-';
        $catatan_pleno = $get_ba['catatan'] ?? '-';
    }
}

// 4. Data Penunjukan Komite
$ketua_komite = '-';
$anggota_1 = '-';
$anggota_2 = '-';
$no_surat = '-';
if (!empty($get_penunjukan)) {
    if (is_object($get_penunjukan)) {
        $ketua_komite = $get_penunjukan->ketua_komite ?? '-';
        $anggota_1 = $get_penunjukan->anggota_1 ?? '-';
        $anggota_2 = $get_penunjukan->anggota_2 ?? '-';
        $no_surat = $get_penunjukan->no_surat ?? '-';
    } elseif (is_array($get_penunjukan)) {
        $ketua_komite = $get_penunjukan['ketua_komite'] ?? '-';
        $anggota_1 = $get_penunjukan['anggota_1'] ?? '-';
        $anggota_2 = $get_penunjukan['anggota_2'] ?? '-';
        $no_surat = $get_penunjukan['no_surat'] ?? '-';
    }
}

// -------------------------------------------------------------
// LOGIKA CARI BASE64 TTD (MENGGUNAKAN METODE PERSIS SEPERTI ABSENSI)
// -------------------------------------------------------------
$base64_ttd_ketua = '';
$base64_ttd_anggota1 = '';
$base64_ttd_anggota2 = '';

if (!empty($get_master_komite)) {
    foreach ($get_master_komite as $komite) {
        // Ambil nama & file_ttd (kompatibel Object & Array)
        $nama_m = is_array($komite) ? ($komite['nama'] ?? $komite['nama_komite'] ?? '') : ($komite->nama ?? $komite->nama_komite ?? '');
        $file_m = is_array($komite) ? ($komite['file_ttd'] ?? '') : ($komite->file_ttd ?? '');

        if (!empty($file_m)) {
            $path_ttd = FCPATH . 'assets/lsp/ttd_komite/' . $file_m;

            if (file_exists($path_ttd)) {
                $type_ttd = pathinfo($path_ttd, PATHINFO_EXTENSION);
                $data_ttd = file_get_contents($path_ttd);
                $img_base64 = 'data:image/' . $type_ttd . ';base64,' . base64_encode($data_ttd);

                // Cocokkan dengan Ketua
                if ($ketua_komite != '-' && trim($ketua_komite) == trim($nama_m)) {
                    $base64_ttd_ketua = $img_base64;
                }
                // Cocokkan dengan Anggota 1
                if ($anggota_1 != '-' && trim($anggota_1) == trim($nama_m)) {
                    $base64_ttd_anggota1 = $img_base64;
                }
                // Cocokkan dengan Anggota 2
                if ($anggota_2 != '-' && trim($anggota_2) == trim($nama_m)) {
                    $base64_ttd_anggota2 = $img_base64;
                }
            }
        }
    }
}

?>

<?php
// Load KOP Surat
$path = base_url('assets/lsp/kop-lsp.png');
$type = pathinfo($path, PATHINFO_EXTENSION);
$arrContextOptions = array(
    "ssl" => array(
        "verify_peer" => false,
        "verify_peer_name" => false,
    ),
);
$data_kop = @file_get_contents($path, false, stream_context_create($arrContextOptions));
$base64 = $data_kop ? 'data:image/' . $type . ';base64,' . base64_encode($data_kop) : '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BA Komtek <?= $nama_peserta; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<style>
    * {
        padding: 0;
        margin: 0;
        font-family: Arial, Helvetica, sans-serif;
    }

    body {
        padding: 0;
        margin: 0;
        font-style: normal;
        font-variant: normal;
    }

    table,
    td,
    th {
        border: 1px solid;
        padding: 5px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }
</style>

<body>
    <!-- KOP Surat -->
    <?php if ($base64): ?>
        <img src="<?= $base64; ?>" style="margin-top:25px; margin-left:50px; max-height:400px; max-width:700px;">
    <?php endif; ?>
    <!-- /KOP Surat -->

    <div style="margin:30px;">
        <h4 style="text-align:center;"><b>BERITA ACARA</b><br />
            PLENO HASIL SERTIFIKASI KOMPETENSI<br /><br>
    </div>
    <div style="margin:80px; margin-top:-20px;">
        <?php
        $hari_array = array(
            'Minggu',
            'Senin',
            'Selasa',
            'Rabu',
            'Kamis',
            "Jum'at",
            'Sabtu'
        );
        $hr = date('w', strtotime($tgl_pleno));
        $hari = $hari_array[$hr];
        ?>
        <p style="text-align:justify;">Pada hari ini, <?= $hari; ?> tanggal
            <?= tanggal_indo(date('d-m-Y', strtotime($tgl_pleno))); ?>
            Tahun <?= date('Y', strtotime($tgl_pleno)); ?>,
            bertempat di Gedung LSP BPSDM Kementerian PU telah dilaksanakan sidang pleno hasil uji kompetensi
            berdasarkan Surat Tugas Penunjukan Nomor: <?= $no_surat; ?> dengan anggota sidang sebagai berikut:
        </p><br>

        <!-- TABEL TIM KOMITE TEKNIS -->
        <table width="100%" border="1" cellpadding="5" cellspacing="0">
            <thead>
                <tr>
                    <th width="5%" style="text-align:center;">No.</th>
                    <th width="50%">Nama</th>
                    <th width="45%">Jabatan Tim Komite</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="text-align:center;">1</td>
                    <td><?= $ketua_komite; ?></td>
                    <td>Ketua Komite Teknis</td>
                </tr>
                <tr>
                    <td style="text-align:center;">2</td>
                    <td><?= $anggota_1; ?></td>
                    <td>Anggota Komite Teknis 1</td>
                </tr>
                <tr>
                    <td style="text-align:center;">3</td>
                    <td><?= $anggota_2; ?></td>
                    <td>Anggota Komite Teknis 2</td>
                </tr>
            </tbody>
        </table><br>

        <p style="text-align:justify;">Adapun hasil dari sidang pleno adalah kepada peserta uji kompetensi dengan data
            sebagai berikut:
        </p>

        <!-- TABEL DATA PESERTA & HASIL REKOMENDASI -->
        <table style="width:100%; text-align:justify; font-size:16px; border:none; border-spacing: 0 15px;">
            <tr style="border:none;">
                <td style="width:20%; vertical-align: baseline; border:none;">Nama</td>
                <td style="width:5%; vertical-align: baseline; border:none;"> : </td>
                <td style="width:75%; vertical-align: baseline; border:none;">
                    <?= $nama_peserta; ?>
                </td>
            </tr>
            <tr style="border:none;">
                <td style="width:20%; vertical-align: baseline; border:none;">Jabatan Kerja</td>
                <td style="width:5%; vertical-align: baseline; border:none;"> : </td>
                <td style="width:75%; vertical-align: baseline; border:none;">
                    <?= $jabatan_kerja; ?>
                </td>
            </tr>
            <tr style="border:none;">
                <td style="width:20%; vertical-align: baseline; border:none;">NIK</td>
                <td style="width:5%; vertical-align: baseline; border:none;"> : </td>
                <td style="width:75%; vertical-align: baseline; border:none;">
                    <?= $nik_peserta; ?>
                </td>
            </tr>
            <tr style="border:none;">
                <td style="width:20%; vertical-align: baseline; border:none;">Rekomendasi</td>
                <td style="width:5%; vertical-align: baseline; border:none;"> : </td>
                <td style="width:75%; vertical-align: baseline; border:none;">
                    <b><?= $hasil_rekomendasi; ?></b>
                </td>
            </tr>
        </table>

        <p style="text-align:justify; margin-top: 15px;">
            Demikian berita acara ini dibuat dengan sebenar-benarnya untuk dapat dipergunakan sebagaimana
            mestinya.<br />
        </p><br />

        <p style="text-align:center;">
            Bandung,
            <?= tanggal_indo_full(date("Y-m-d", strtotime($tgl_pleno))); ?><br />
        </p>
        <br>

        <!-- TABEL 3 TANDA TANGAN KOMITE TEKNIS -->
        <table width="100%" cellpadding="5" cellspacing="0"
            style="text-align: center; border: none; border-collapse: collapse;">
            <thead style="border: none;">
                <tr style="border: none;">
                    <td style="border: none; width: 33%;">Ketua Komite Teknis</td>
                    <td style="border: none; width: 33%;">Anggota Komite 1</td>
                    <td style="border: none; width: 33%;">Anggota Komite 2</td>
                </tr>
            </thead>
            <tbody style="border: none;">
                <tr style="height: 90px; border: none;">
                    <!-- Ketua Komite -->
                    <td style="border: none; vertical-align: bottom; text-align: center;">
                        <?php if (!empty($base64_ttd_ketua)): ?>
                            <img src="<?= $base64_ttd_ketua; ?>" alt="TTD Ketua"
                                style="height: 85px; width: auto; display: inline-block;">
                        <?php else: ?>
                            <br><br><br>
                        <?php endif; ?>
                    </td>

                    <!-- Anggota Komite 1 -->
                    <td style="border: none; vertical-align: bottom; text-align: center;">
                        <?php if (!empty($base64_ttd_anggota1)): ?>
                            <img src="<?= $base64_ttd_anggota1; ?>" alt="TTD Anggota 1"
                                style="height: 85px; width: auto; display: inline-block;">
                        <?php else: ?>
                            <br><br><br>
                        <?php endif; ?>
                    </td>

                    <!-- Anggota Komite 2 -->
                    <td style="border: none; vertical-align: bottom; text-align: center;">
                        <?php if (!empty($base64_ttd_anggota2)): ?>
                            <img src="<?= $base64_ttd_anggota2; ?>" alt="TTD Anggota 2"
                                style="height: 85px; width: auto; display: inline-block;">
                        <?php else: ?>
                            <br><br><br>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr style="border: none;">
                    <td style="border: none;"><b><?= $ketua_komite; ?></b></td>
                    <td style="border: none;"><b><?= $anggota_1; ?></b></td>
                    <td style="border: none;"><b><?= $anggota_2; ?></b></td>
                </tr>
            </tbody>
        </table>
    </div>

</body>

</html>