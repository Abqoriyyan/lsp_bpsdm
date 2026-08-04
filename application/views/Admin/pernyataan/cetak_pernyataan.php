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

// 1. Ambil Base64 KOP Surat
$path_kop = FCPATH . 'assets/lsp/kop-lsp.png';
$base64_kop = '';
if (file_exists($path_kop)) {
    $type = pathinfo($path_kop, PATHINFO_EXTENSION);
    $data = file_get_contents($path_kop);
    $base64_kop = 'data:image/' . $type . ';base64,' . base64_encode($data);
}

// 2. Ambil Base64 Tanda Tangan Asesi dari form APL 01 secara Dinamis
$file_ttd_asesi = isset($get_data_apl01->ttd_pemohon) ? $get_data_apl01->ttd_pemohon : '';

$base64_ttd_asesi = '';

if (!empty($file_ttd_asesi)) {
    $folder_ttd = 'uploads/file_permohonan/ttd_pemohon_apl01_apl02/';
    $path_ttd = FCPATH . $folder_ttd . $file_ttd_asesi;

    if (file_exists($path_ttd)) {
        $type_ttd = pathinfo($path_ttd, PATHINFO_EXTENSION);
        $data_ttd = file_get_contents($path_ttd);
        $base64_ttd_asesi = 'data:image/' . $type_ttd . ';base64,' . base64_encode($data_ttd);
    } else {
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Surat Pernyataan Pemegang Sertifikat</title>
    <style>
        @page {
            margin: 60px 70px;
        }

        * {
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            margin: 0;
            padding: 0;
            font-size: 11pt;
            line-height: 1.6;
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
            margin-bottom: 30px;
        }

        .judul-surat h4 {
            margin: 0;
            font-size: 12pt;
            font-weight: bold;
            letter-spacing: 0.5px;
        }

        p {
            margin-top: 0;
            margin-bottom: 12px;
            text-align: justify;
            text-indent: 30px;
        }

        .no-indent {
            text-indent: 0px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
        }

        .table-info td {
            padding: 4px 0;
            vertical-align: top;
            font-size: 11pt;
        }

        .td-label {
            width: 30%;
        }

        .td-colon {
            width: 4%;
        }

        .td-value {
            width: 66%;
        }

        ol {
            margin-top: 5px;
            padding-left: 20px;
        }

        ol li {
            text-align: justify;
            padding-bottom: 5px;
        }

        /* Bagian Blok Tanda Tangan Kanan Bawah */
        .signature-section {
            margin-top: 40px;
            width: 100%;
            page-break-inside: avoid;
        }

        .signature-box-right {
            float: right;
            width: 260px;
            text-align: left;
        }

        .signature-space {
            position: relative;
            height: 85px;
            margin: 5px 0;
            width: 100%;
        }

        .signature-img {
            max-height: 75px;
            max-width: 150px;
            position: absolute;
            z-index: 1;
            top: 5px;
            left: 10px;
        }

        .name-under-signature {
            margin-top: 5px;
            display: block;
            font-size: 11pt;
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
        <h4>SURAT PERNYATAAN</h4>
        <h4>PEMEGANG SERTIFIKAT KOMPETENSI</h4>
    </div>

    <p class="no-indent">Yang bertanda tangan di bawah ini:</p>

    <table class="table-info" style="margin-left: 30px;">
        <tr>
            <td class="td-label">Nama Lengkap</td>
            <td class="td-colon">:</td>
            <td class="td-value"><strong>
                    <?= isset($get_data_personal->nama) ? $get_data_personal->nama : '-'; ?>
                </strong></td>
        </tr>
        <tr>
            <td class="td-label">ID Permohonan</td>
            <td class="td-colon">:</td>
            <td class="td-value">
                <?= $id_izin; ?>
            </td>
        </tr>
        <tr>
            <td class="td-label">Skema Sertifikasi</td>
            <td class="td-colon">:</td>
            <td class="td-value">
                <?php
                // Cek apakah data ada di objek atau array
                if (isset($get_data_klasifikasi)) {
                    // Biasanya berupa objek jika dipanggil via row()
                    echo isset($get_data_klasifikasi->deskripsi_jabatan_kerja) ? $get_data_klasifikasi->deskripsi_jabatan_kerja : 'Skema tidak ditemukan';
                } else {
                    echo '-';
                }
                ?>
            </td>
        </tr>
    </table>

    <p>Dengan ini menyatakan kesanggupan dan mengikatkan diri untuk mematuhi ketentuan pemegang sertifikat kompetensi
        kerja pada Lembaga Sertifikasi Profesi (LSP) sesuai aturan Badan Nasional Sertifikasi Profesi (BNSP), sebagai
        berikut:</p>

    <ol>
        <li>Mematuhi dan melaksanakan seluruh ketentuan kode etik profesi secara konsisten dan penuh tanggung jawab.
        </li>
        <li>Menggunakan sertifikat kompetensi secara sah sesuai dengan ruang lingkup dan jabatan kerja yang ditetapkan.
        </li>
        <li>Tidak akan menyalahgunakan sertifikat kompetensi yang dapat merugikan reputasi profesi maupun institusi LSP.
        </li>
        <li>Bersedia menghentikan penggunaan sertifikat kompetensi apabila masa berlaku sertifikat telah habis atau
            dicabut oleh pihak lembaga penjamin mutu.</li>
    </ol>

    <p>Demikian surat pernyataan ini saya buat dengan sadar, jujur, dan tanpa ada paksaan dari pihak manapun untuk
        dipergunakan sebagaimana mestinya.</p>

    <div class="signature-section">
        <div class="signature-box-right">
            <p>
                Bandung,
                <?php
                if (!empty($get_data_sertifikat->tanggal_ditetapkan)) {
                    echo tanggal_indo($get_data_sertifikat->tanggal_ditetapkan);
                } else {
                    echo tanggal_indo(date('Y-m-d'));
                }
                ?>
            </p>
            <p style="margin-top: 5px;">Yang menyatakan pernyataan,</p>

            <div class="signature-space">
                <?php if ($base64_ttd_asesi != ''): ?>
                    <img src="<?= $base64_ttd_asesi ?>" class="signature-img" alt="TTD Asesi">
                <?php else: ?>
                    <br><br>
                <?php endif; ?>
            </div>

            <span class="name-under-signature">
                <strong><u>
                        <?= isset($get_data_personal->nama) ? $get_data_personal->nama : '-'; ?>
                    </u></strong>
            </span>
        </div>
    </div>

</body>

</html>