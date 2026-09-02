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
?>

<?php
$path = base_url('assets/lsp/kop-lsp.png');
$type = pathinfo($path, PATHINFO_EXTENSION);
$arrContextOptions = array(
    "ssl" => array(
        "verify_peer" => false,
        "verify_peer_name" => false,
    ),
);
$data = file_get_contents($path, false, stream_context_create($arrContextOptions));
$base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
?>

<?php
if (!function_exists('gambar_ke_base64')) {
    function gambar_ke_base64($path_file)
    {
        if (file_exists($path_file) && !is_dir($path_file)) {
            $tipe = pathinfo($path_file, PATHINFO_EXTENSION);
            $data = file_get_contents($path_file);
            return 'data:image/' . $tipe . ';base64,' . base64_encode($data);
        }
        return false;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BA Komtek <?= $get_data_hasil_penetapan_komite_teknis['nama']; ?></title>
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
    <img src="<?= $base64; ?>" style="margin-top:25px; margin-left:50px; max-height:400px; max-width:700px;">
    <!-- /KOP Surat -->

    <div style="margin:30px; ">
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
        $hr = date('w', strtotime($get_data_hasil_penetapan_komite_teknis['tanggal_penetapan']));
        $hari = $hari_array[$hr];
        ?>
        <p style="text-align:justify;">Pada hari ini, <?= $hari; ?> tanggal
            <?= tanggal_indo(date('d-m-Y', strtotime($get_data_hasil_penetapan_komite_teknis['tanggal_penetapan']))); ?>
            tahun <?= date('Y', strtotime($get_data_hasil_penetapan_komite_teknis['tanggal_penetapan'])); ?>,
            bertempat di Gedung LSP BPSDM Kementerian PU telah dilaksanakan sidang pleno hasil uji kompetensi dengan
            anggota sidang sebagai berikut:
        </p><br>

        <table width="100%" border="1" cellpadding="5" cellspacing="0">
            <thead>
                <tr>
                    <th width="5%" style="text-align:center;">No.</th>
                    <th width="50%">Nama</th>
                    <th width="45%">No Reg</th>
                    <!-- <th width="30%">Jabatan</th> -->
                </tr>
            </thead>
            <tbody>
                <?php foreach ($get_data_komite_teknis as $no => $data): ?>
                    <tr>
                        <td style="text-align:center;">
                            <?= $no + 1 ?>
                        </td>
                        <td>
                            <?= $data['nama'] ?>
                        </td>
                        <td style="text-align:center;">
                            <?= $data['no_reg'] ?>
                        </td>
                        <!-- <td class="text-center">
                            <?= isset($data['jabatan_komite_teknis']) ? $data['jabatan_komite_teknis'] : '-' ?>
                        </td> -->
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table><br>

        <p style="text-align:justify;">Adapun hasil dari sidang pleno adalah kepada peserta uji kompetensi dengan data
            sebagai berikut:
        </p>

        <table style="width:100%; text-align:justify; font-size:16px; border:none; border-spacing: 0 15px;">
            <tr style="border:none;">
                <td style="width:20%; vertical-align: baseline; border:none;">Nama</td>
                <td style="width:5%; vertical-align: baseline; border:none;"> : </td>
                <td style="width:75%; vertical-align: baseline; border:none;">
                    <?= $get_data_hasil_penetapan_komite_teknis['nama']; ?>
                </td>
            </tr>
            <tr style="border:none;">
                <td style="width:20%; vertical-align: baseline; border:none;">Jabatan Kerja</td>
                <td style="width:5%; vertical-align: baseline; border:none;"> : </td>
                <td style="width:75%; vertical-align: baseline; border:none;">
                    <?= $get_data_hasil_penetapan_komite_teknis['jabatan_kerja']; ?>
                </td>
            </tr>
            <tr style="border:none;">
                <td style="width:20%; vertical-align: baseline; border:none;">NIK</td>
                <td style="width:5%; vertical-align: baseline; border:none;"> : </td>
                <td style="width:75%; vertical-align: baseline; border:none;">
                    <?= isset($get_data_hasil_penetapan_komite_teknis['nik']) ? $get_data_hasil_penetapan_komite_teknis['nik'] : '-'; ?>
                </td>
            </tr>
            <tr style="border:none;">
                <td style="width:20%; vertical-align: baseline; border:none;">Rekomendasi</td>
                <td style="width:5%; vertical-align: baseline; border:none;"> : </td>
                <td style="width:75%; vertical-align: baseline; border:none;">
                    <?php
                    if (isset($get_data_hasil_penetapan_komite_teknis['hasil_penetapan'])) {
                        if ($get_data_hasil_penetapan_komite_teknis['hasil_penetapan'] == "Kompeten") {
                            echo "Kompeten";
                        } elseif ($get_data_hasil_penetapan_komite_teknis['hasil_penetapan'] == "Belum Kompeten") {
                            echo "Belum Kompeten";
                        }
                    }
                    ?>
                </td>
            </tr>
        </table>

        <p style="text-align:justify;">
            Demikian berita acara ini dibuat dengan sebenar-benarnya untuk dapat dipergunakan sebagaimana
            mestinya.<br />
        </p><br />

        <p style="text-align:center;">
            Bandung,
            <?= Tanggal_indo_full(date("Y-m-d", strtotime($get_data_hasil_penetapan_komite_teknis['tanggal_penetapan']))) ?><br />
        </p>
        <br>

        <table width="100%" cellpadding="5" cellspacing="0"
            style="text-align: center; border: none; border-collapse: collapse;">
            <thead style="border: none;">
                <tr style="border: none;">
                    <th style="border: none; width: 33%;">Komite Teknis 1</th>
                    <th style="border: none; width: 33%;">Komite Teknis 2</th>
                    <th style="border: none; width: 33%;">Komite Teknis 3</th>
                </tr>
            </thead>
            <tbody style="border: none;">
                <tr style="height: 90px; border: none;">
                    <!-- Komite 1 -->
                    <td style="border: none; vertical-align: bottom; text-align: center;">
                        <?php
                        $path0 = FCPATH . 'assets/lsp/ttd_komite/' . trim($get_data_komite_teknis[0]['file_ttd']);
                        $base64_0 = gambar_ke_base64($path0);
                        if ($base64_0):
                            ?>
                            <img src="<?= $base64_0 ?>" alt="TTD 1"
                                style="height: 85px; width: auto; display: inline-block;">
                        <?php endif; ?>
                    </td>

                    <!-- Komite 2 -->
                    <td style="border: none; vertical-align: bottom; text-align: center;">
                        <?php
                        $path1 = FCPATH . 'assets/lsp/ttd_komite/' . trim($get_data_komite_teknis[1]['file_ttd']);
                        $base64_1 = gambar_ke_base64($path1);
                        if ($base64_1):
                            ?>
                            <img src="<?= $base64_1 ?>" alt="TTD 2"
                                style="height: 85px; width: auto; display: inline-block;">
                        <?php endif; ?>
                    </td>

                    <!-- Komite 3 -->
                    <td style="border: none; vertical-align: bottom; text-align: center;">
                        <?php
                        $path2 = FCPATH . 'assets/lsp/ttd_komite/' . trim($get_data_komite_teknis[2]['file_ttd']);
                        $base64_2 = gambar_ke_base64($path2);
                        if ($base64_2):
                            ?>
                            <img src="<?= $base64_2 ?>" alt="TTD 3"
                                style="height: 85px; width: auto; display: inline-block;">
                        <?php endif; ?>
                    </td>
                </tr>
                <tr style="border: none;">
                    <td style="border: none;"><?= $get_data_komite_teknis[0]['nama'] ?? '' ?></td>
                    <td style="border: none;"><?= $get_data_komite_teknis[1]['nama'] ?? '' ?></td>
                    <td style="border: none;"><?= $get_data_komite_teknis[2]['nama'] ?? '' ?></td>
                </tr>
            </tbody>
        </table>
    </div>

</body>

</html>