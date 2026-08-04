<?php
function tanggal_indo($tanggal)
{
    $bulan = array(1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
    $split = explode('-', $tanggal);
    return $split[2] . ' ' . $bulan[(int) $split[1]] . ' ' . $split[0];
}

// 1. Persiapkan Base64 Image untuk KOP Surat
$path_kop = FCPATH . 'assets/lsp/kop-lsp.png';
$base64_kop = '';
if (file_exists($path_kop)) {
    $type = pathinfo($path_kop, PATHINFO_EXTENSION);
    $data = file_get_contents($path_kop);
    $base64_kop = 'data:image/' . $type . ';base64,' . base64_encode($data);
}

// 2. Persiapkan Base64 TTD Pemohon
$base64_pemohon = '';
if (!empty($get_data_apl01->ttd_pemohon)) {
    $path_ttd_pemohon = FCPATH . 'uploads/file_permohonan/ttd_pemohon_apl01_apl02/' . $get_data_apl01->ttd_pemohon;
    if (file_exists($path_ttd_pemohon)) {
        $type = pathinfo($path_ttd_pemohon, PATHINFO_EXTENSION);
        $data = file_get_contents($path_ttd_pemohon);
        $base64_pemohon = 'data:image/' . $type . ';base64,' . base64_encode($data);
    }
}

// 3. Persiapkan Base64 TTD Asesor 1
$base64_asesor = '';
if (!empty($get_ttd_lead_asesor->ttd_asesor)) {
    $path_ttd_asesor = FCPATH . 'uploads/file_permohonan/ttd_asesor_apl02/' . $get_ttd_lead_asesor->ttd_asesor;
    if (file_exists($path_ttd_asesor)) {
        $type = pathinfo($path_ttd_asesor, PATHINFO_EXTENSION);
        $data = file_get_contents($path_ttd_asesor);
        $base64_asesor = 'data:image/' . $type . ';base64,' . base64_encode($data);
    }
}

// 4. Persiapkan Base64 TTD Asesor 2
$base64_asesor2 = '';
// Variabel di bawah ini ($get_ttd_asesor_2) silakan disesuaikan dengan 
// variabel yang dilempar dari controller untuk data Asesor 2
if (!empty($get_ttd_asesor_2->ttd_asesor)) {
    $path_ttd_asesor2 = FCPATH . 'uploads/file_permohonan/ttd_asesor_apl02/' . $get_ttd_asesor_2->ttd_asesor;
    if (file_exists($path_ttd_asesor2)) {
        $type = pathinfo($path_ttd_asesor2, PATHINFO_EXTENSION);
        $data = file_get_contents($path_ttd_asesor2);
        $base64_asesor2 = 'data:image/' . $type . ';base64,' . base64_encode($data);
    }
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Formulir APL 02 - <?= $get_data_personal_permohonan->nama; ?></title>
    <style>
        /* Pengaturan Margin Kertas */
        @page {
            margin: 60px;
        }

        * {
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            margin: 0;
            padding: 0;
            font-size: 11pt;
            line-height: 1.4;
            color: #000;
        }

        /* Kontainer KOP Surat */
        .kop-container {
            width: 100%;
            text-align: center;
            margin-bottom: 25px;
        }

        .kop-container img {
            width: 105%;
            max-height: 100px;
            object-fit: contain;
        }

        /* Tipografi */
        h3 {
            font-size: 12pt;
            font-weight: bold;
            margin-bottom: 15px;
            text-align: left;
        }

        p {
            margin-top: 0;
            margin-bottom: 8px;
        }

        /* Desain Tabel Umum */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        /* Tabel Skema */
        .table-skema td {
            border: 1px solid #333;
            padding: 8px 10px;
            vertical-align: middle;
        }

        /* Tabel Panduan */
        .table-panduan td,
        .table-panduan th {
            border: 1px solid #333;
            padding: 10px;
            vertical-align: top;
        }

        .table-panduan th {
            background-color: #f0f0f0;
            text-align: left;
            font-size: 11pt;
        }

        /* Tabel Data APL 02 */
        .table-apl02 {
            /* Dihapus page-break-inside: avoid; dari tabel agar tidak lompat halaman per tabel */
            width: 100%;
        }

        /* Solusi agar tidak misah di tengah KUK: pakaikan page-break-inside pada TR */
        .table-apl02 tr {
            page-break-inside: avoid;
        }

        .table-apl02 th,
        .table-apl02 td {
            border: 1px solid #333;
            padding: 6px 8px;
            vertical-align: middle;
        }

        .table-apl02 thead th {
            background-color: #f0f0f0;
            font-weight: bold;
            text-align: left;
        }

        .table-apl02 .center {
            text-align: center;
        }

        .table-apl02 .elemen-row {
            background-color: #f9f9f9;
            font-weight: bold;
        }

        .table-apl02 .kuk-row td {
            vertical-align: top;
        }

        /* Box Tanda Tangan */
        .table-ttd {
            page-break-inside: avoid;
            margin-top: 30px;
        }

        .table-ttd th,
        .table-ttd td {
            border: 1px solid #333;
            padding: 10px;
            vertical-align: top;
        }

        .table-ttd th {
            background-color: #f0f0f0;
            text-align: center;
        }

        .sign-box {
            text-align: center;
            min-height: 120px;
        }

        .sign-box img {
            max-height: 90px;
            max-width: 120px;
            margin: 10px 0;
        }

        .sign-placeholder {
            height: 90px;
            margin: 10px 0;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>

<body>

    <!-- KOP Surat -->
    <div class="kop-container">
        <?php if ($base64_kop != ''): ?>
            <img src="<?= $base64_kop ?>" alt="Kop Surat LSP">
        <?php else: ?>
            <h2 style="color:red; font-size:14pt;">[KOP SURAT TIDAK DITEMUKAN / PASTIKAN PATH NYA BENAR]</h2>
        <?php endif; ?>
    </div>

    <!-- Judul Dokumen -->
    <h3>FR.APL.02. Asesmen Mandiri</h3>

    <!-- Data Skema Sertifikasi -->
    <table class="table-skema">
        <tr>
            <td rowspan="2" width="25%" style="font-weight:bold;">Skema Sertifikasi<br>(KKNI/Okupasi/Klaster)</td>
            <td width="10%">Judul</td>
            <td width="2%">:</td>
            <td width="63%"><strong><?= $get_data_klasifikasi_kualifikasi->deskripsi_jabatan_kerja; ?></strong></td>
        </tr>
        <tr>
            <td>Nomor</td>
            <td>:</td>
            <td><?= $get_data_klasifikasi_kualifikasi->acuan; ?></td>
        </tr>
    </table>

    <!-- Panduan Asesmen -->
    <table class="table-panduan">
        <thead>
            <tr>
                <th>Panduan Asesmen Mandiri <i>(Self Assessment)</i></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <p><strong>Instruksi :</strong></p>
                    <ul style="margin-top:5px; margin-bottom:15px; padding-left:20px;">
                        <li>Baca setiap pertanyaan di kolom sebelah kiri.</li>
                        <li>Beri tanda centang (V) pada kotak jika Anda yakin dapat melakukan tugas yang
                            dijelaskan.</li>
                        <li>Isi kolom di sebelah kanan dengan mendaftar bukti yang Anda miliki untuk menunjukkan bahwa
                            Anda melakukan tugas-tugas ini.</li>
                    </ul>
                    <p><strong>Catatan :</strong><br>
                        <strong>K</strong> = Kompeten<br>
                        <strong>BK</strong> = Belum Kompeten
                    </p>
                </td>
            </tr>
        </tbody>
    </table>

    <!-- Data APL 02 (Unit Kompetensi) -->
    <?php foreach ($get_master_unit_kompetensi as $master_unit_kompetensi): ?>
        <?php if ($master_unit_kompetensi['kode_jabker'] == $get_data_klasifikasi_kualifikasi->jabatan_kerja): ?>

            <table class="table-apl02">
                <thead>
                    <tr>
                        <th width="15%">Unit Kompetensi</th>
                        <th colspan="3"><?= $master_unit_kompetensi['kode_unit_kompetensi'] ?>
                            (<?= $master_unit_kompetensi['deskripsi'] ?>)</th>
                    </tr>
                    <tr>
                        <th width="50%">Dapatkah Saya ............. ?</th>
                        <th width="8%" class="center">K</th>
                        <th width="8%" class="center">BK</th>
                        <th width="34%" class="center">Bukti Relevan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($get_master_elemen_kompetensi as $master_elemen_kompetensi): ?>
                        <?php if ($master_elemen_kompetensi['kode_unit_kompetensi'] == $master_unit_kompetensi['kode_unit_kompetensi']): ?>

                            <!-- Header Elemen -->
                            <tr class="elemen-row">
                                <td colspan="4">
                                    Elemen <?= $master_elemen_kompetensi['no_urut_elemen_kompetensi'] ?> :
                                    <?= $master_elemen_kompetensi['deskripsi'] ?>
                                </td>
                            </tr>
                            <tr class="elemen-row" style="background-color: #fff;">
                                <td colspan="4">Kriteria Unjuk Kerja :</td>
                            </tr>

                            <!-- Looping KUK -->
                            <?php foreach ($get_master_kriteria_unjuk_kerja as $master_kriteria_unjuk_kerja): ?>
                                <?php if ($master_kriteria_unjuk_kerja['kode_elemen_kompetensi'] == $master_elemen_kompetensi['kode_elemen_kompetensi']): ?>
                                    <tr class="kuk-row">
                                        <!-- Deskripsi KUK -->
                                        <td><?= $master_elemen_kompetensi['no_urut_elemen_kompetensi'] . '.' . $master_kriteria_unjuk_kerja['no_urut_kuk'] ?>
                                            <?= $master_kriteria_unjuk_kerja['deskripsi'] ?>
                                        </td>

                                        <!-- Kolom K (Kompeten) -->
                                        <td class="center">
                                            <?php
                                            foreach ($get_data_apl02 as $data_apl02) {
                                                if (($data_apl02['kode_kuk'] == $master_kriteria_unjuk_kerja['kode_kuk']) && ($data_apl02['status'] == '1')) {
                                                    echo 'V';
                                                }
                                            }
                                            ?>
                                        </td>

                                        <!-- Kolom BK (Belum Kompeten) -->
                                        <td class="center">
                                            <?php
                                            foreach ($get_data_apl02 as $data_apl02) {
                                                if (($data_apl02['kode_kuk'] == $master_kriteria_unjuk_kerja['kode_kuk']) && ($data_apl02['status'] == '0')) {
                                                    echo 'V';
                                                }
                                            }
                                            ?>
                                        </td>

                                        <!-- Kolom Bukti Relevan -->
                                        <td>
                                            <?php
                                            foreach ($get_bukti_relavan_apl02 as $bukti_relavan_apl02) {
                                                foreach ($get_data_apl02 as $data_apl02) {
                                                    if (($data_apl02['kode_kuk'] == $master_kriteria_unjuk_kerja['kode_kuk']) && ($data_apl02['bukti_relavan'] == $bukti_relavan_apl02['file_bukti'])) {
                                                        echo "• " . $bukti_relavan_apl02['nama_bukti'] . "<br>";
                                                    }
                                                }
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endforeach; ?> <!-- End KUK -->

                        <?php endif; ?>
                    <?php endforeach; ?> <!-- End Elemen -->
                </tbody>
            </table>

        <?php endif; ?>
    <?php endforeach; ?> <!-- End Unit Kompetensi -->

    <!-- Tanda Tangan Block (3 Kolom: Asesi, Asesor 1, Asesor 2) -->
    <table class="table-ttd">
        <thead>
            <tr>
                <th colspan="3">Ditinjau oleh Asesor :</th>
            </tr>
            <tr>
                <th width="33%">Nama Pemohon / Asesi</th>
                <th width="33%">Nama Asesor 1</th>
                <th width="34%">Nama Asesor 2</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <!-- TTD Asesi -->
                <td class="sign-box">
                    <strong><?= $get_data_personal_permohonan->nama; ?></strong><br>
                    <?php if ($base64_pemohon != ''): ?>
                        <img src="<?= $base64_pemohon ?>" alt="TTD Pemohon"><br>
                    <?php else: ?>
                        <div class="sign-placeholder"></div>
                    <?php endif; ?>
                    <small>Tanggal:
                        <?= !empty($get_data_apl01->tanggal_ttd_pemohon) ? tanggal_indo(date('Y-m-d', strtotime($get_data_apl01->tanggal_ttd_pemohon))) : '-'; ?></small>
                </td>
                <?php
                $base64_asesor1 = '';
                if (!empty($get_asesor_1->ttd_asesor)) {
                    $path_ttd_asesor1 = FCPATH . 'uploads/file_permohonan/ttd_asesor_apl02/' . $get_asesor_1->ttd_asesor;
                    if (file_exists($path_ttd_asesor1)) {
                        $type = pathinfo($path_ttd_asesor1, PATHINFO_EXTENSION);
                        $data = file_get_contents($path_ttd_asesor1);
                        $base64_asesor1 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                    }
                }

                // 4. Persiapkan Base64 TTD Asesor 2
                $base64_asesor2 = '';
                if (!empty($get_asesor_2->ttd_asesor)) {
                    $path_ttd_asesor2 = FCPATH . 'uploads/file_permohonan/ttd_asesor_apl02/' . $get_asesor_2->ttd_asesor;
                    if (file_exists($path_ttd_asesor2)) {
                        $type = pathinfo($path_ttd_asesor2, PATHINFO_EXTENSION);
                        $data = file_get_contents($path_ttd_asesor2);
                        $base64_asesor2 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                    }
                }
                ?>
                <td class="sign-box">
                    <strong><?= !empty($get_asesor_1->nama_asesor) ? $get_asesor_1->nama_asesor : '-'; ?></strong><br>
                    <small><i>Rekomendasi: Asesmen dapat Dilanjutkan</i></small><br>
                    <?php if ($base64_asesor1 != ''): ?>
                        <img src="<?= $base64_asesor1 ?>" alt="TTD Asesor 1"><br>
                    <?php else: ?>
                        <div class="sign-placeholder"></div>
                    <?php endif; ?>
                    <small>Tanggal:
                        <?= !empty($get_asesor_1->tanggal_ttd) ? tanggal_indo(date('Y-m-d', strtotime($get_asesor_1->tanggal_ttd))) : '-'; ?></small>
                </td>

                <td class="sign-box">
                    <strong><?= !empty($get_asesor_2->nama_asesor) ? $get_asesor_2->nama_asesor : '-'; ?></strong><br>
                    <small><i>Rekomendasi: Asesmen dapat Dilanjutkan</i></small><br>
                    <?php if ($base64_asesor2 != ''): ?>
                        <img src="<?= $base64_asesor2 ?>" alt="TTD Asesor 2"><br>
                    <?php else: ?>
                        <div class="sign-placeholder"></div>
                    <?php endif; ?>
                    <small>Tanggal:
                        <?= !empty($get_asesor_2->tanggal_ttd) ? tanggal_indo(date('Y-m-d', strtotime($get_asesor_2->tanggal_ttd))) : '-'; ?></small>
                </td>
            </tr>
        </tbody>
    </table>

</body>

</html>