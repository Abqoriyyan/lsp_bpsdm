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
    // return $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
    return $split[0] . ' ' . $bulan[(int) $split[1]];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BA Rekomendasi Asesor - <?= $id_izin ?></title>
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
    <img src="<?= $base64; ?>" style="margin-top:25px; margin-left:50px; max-height:400px; max-width:700px;">
    <!-- /KOP Surat -->
    <div style="margin:30px;">
        <h4 style="text-align:center;"><b>BERITA ACARA<br />
                PELAKSANAAN SERTIFIKASI<br />
    </div><br /><br />
    <div style="margin:80px; margin-top:-50px;">
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
        $hr = date('w', strtotime($get_data_jadwal_asesmen->tanggal_selesai));
        $hari = $hari_array[$hr];
        ?>
        <p style="text-align:justify;">Pada hari ini <?= $hari; ?> tanggal
            <?= tanggal_indo(date('d-m-Y', strtotime($get_data_jadwal_asesmen->tanggal_selesai))) ?> Tahun
            <?= date('Y', strtotime($get_data_jadwal_asesmen->tanggal_selesai)) ?>,
            bertempat di Tempat Uji Kompetensi (TUK) <?= $get_data_rekomendasi_asesor->nama_tuk ?>
            (<?= $get_data_rekomendasi_asesor->alamat ?>) telah dilakukan
            Uji Kompetensi Skema <?= $get_data_rekomendasi_asesor->jabatan_kerja; ?>, dengan penjelasan sebagai
            berikut:
        </p>
        <table style="width:100%; text-align:justify; font-size:16px; border:none; border-spacing: 0 15px;">
            <tr style="border:none;">
                <td style="width:20%; vertical-align: baseline; border:none;">Asesor</td>
                <td style="width:5%; vertical-align: baseline; border:none; "> : </td>
                <td style="width:75%; vertical-align: baseline; border:none;">
                    <?= $get_data_rekomendasi_asesor->nama_asesor; ?>
                </td>
            </tr>
            <tr style="border:none;">
                <td style="width:20%; vertical-align: baseline; border:none;">No Registrasi</td>
                <td style="width:5%; vertical-align: baseline; border:none; "> : </td>
                <td style="width:75%; vertical-align: baseline; border:none;">
                    <?= $get_data_rekomendasi_asesor->no_reg_bnsp; ?>
                </td>
            </tr>
        </table>
        <p style="text-align:justify;">Berdasarkan hasil penilaian Asesor, dengan ini menetapkan hasil uji kompetensi
            terhadap peserta dengan keterangan sebagai berikut:</p>

        <p>
        <table style="width:100%; text-align:justify; font-size:16px; border:none; border-spacing: 0 15px;">
            <tr style="border:none;">
                <td style="width:20%; vertical-align: baseline; border:none;">Nama</td>
                <td style="width:5%; vertical-align: baseline; border:none; "> : </td>
                <td style="width:75%; vertical-align: baseline; border:none;">
                    <?= $get_data_rekomendasi_asesor->nama; ?>
                </td>
            </tr>
            <tr style="border:none;">
                <td style="width:20%; vertical-align: baseline; border:none;">Rekomendasi</td>
                <td style="width:5%; vertical-align: baseline; border:none; "> : </td>
                <td style="width:75%; vertical-align: baseline; border:none;">
                    <?php
                    if ($get_data_rekomendasi_asesor->rekomendasi_asesor == "Kompeten") {
                        ?>
                        Kompeten
                        <?php
                    } elseif ($get_data_rekomendasi_asesor->rekomendasi_asesor == "Belum Kompeten") {
                        ?>
                        Belum Kompeten
                        <?php
                    }
                    ?>
                </td>
            </tr>
        </table>
        </p>

        <p style="text-align:justify;">Demikian berita acara asesmen dibuat sebagai pengambil keputusan oleh tim Asesor
            LSP. <?= $token->username; ?> </p><br /><br />
        <p style="text-align:center;"><?= $get_data_jadwal_asesmen->nama_kota_tuk ?>,
            <?= tanggal_indo(date('d-m-Y', strtotime($get_data_jadwal_asesmen->tanggal_selesai))); ?>
            <?= date('Y', strtotime($get_data_jadwal_asesmen->tanggal_selesai)); ?>
        </p>
        <p style="text-align:center;">
            <!-- TTD Komite -->
            <?php
            $path = "https://quickchart.io/chart?cht=qr&chl=" . urlencode($id_izin) . "&chs=120x120&choe=UTF-8&chld=L|2";
            // $path = base_url('uploads/file_permohonan/ttd_asesor_apl02/').$get_data_rekomendasi_asesor->ttd_asesor;
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
            <img src="<?= $base64; ?>" width="100px" height="100px" style="margin:0;"><br />
            <!-- /TTD Komite -->
            <?= $get_data_rekomendasi_asesor->nama_asesor ?>
        </p>
    </div>
</body>

</html>