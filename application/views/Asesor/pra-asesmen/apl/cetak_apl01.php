<?php
function tanggal_indo($tanggal)
{
    $bulan = array(1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
    $split = explode('-', $tanggal);
    return $split[2] . ' ' . $bulan[(int) $split[1]] . ' ' . $split[0];
}

// Persiapkan Base64 Image untuk Header KOP Surat
$path_kop = FCPATH . 'assets/lsp/kop-lsp.png';
$base64_kop = '';
if (file_exists($path_kop)) {
    $type = pathinfo($path_kop, PATHINFO_EXTENSION);
    $data = file_get_contents($path_kop);
    $base64_kop = 'data:image/' . $type . ';base64,' . base64_encode($data);
}

// Persiapkan Base64 TTD Pemohon
$path_ttd_pemohon = FCPATH . 'uploads/file_permohonan/ttd_pemohon_apl01_apl02/' . $get_data_apl01->ttd_pemohon;
$base64_pemohon = '';
if (!empty($get_data_apl01->ttd_pemohon) && file_exists($path_ttd_pemohon)) {
    $type = pathinfo($path_ttd_pemohon, PATHINFO_EXTENSION);
    $data = file_get_contents($path_ttd_pemohon);
    $base64_pemohon = 'data:image/' . $type . ';base64,' . base64_encode($data);
}

// Persiapkan Base64 TTD Admin
$path_ttd_admin = FCPATH . 'uploads/file_permohonan/ttd_admin_apl01/' . $get_data_apl01->ttd_peninjau;
$base64_admin = '';
if (!empty($get_data_apl01->ttd_peninjau) && file_exists($path_ttd_admin)) {
    $type = pathinfo($path_ttd_admin, PATHINFO_EXTENSION);
    $data = file_get_contents($path_ttd_admin);
    $base64_admin = 'data:image/' . $type . ';base64,' . base64_encode($data);
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Formulir APL 01 - <?= $get_data_personal_permohonan->nama; ?></title>
    <style>
        /* Margin seragam untuk seluruh halaman karena KOP tidak lagi bersifat fixed */
        @page {
            margin: 70px;
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
        h4 {
            font-size: 12pt;
            font-weight: bold;
            margin-bottom: 5px;
            margin-top: 0;
        }

        p {
            margin-top: 0;
            margin-bottom: 8px;
        }

        .section-title {
            margin-top: 15px;
            font-weight: bold;
        }

        /* Desain Tabel Umum */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        /* Tabel Tanpa Border (Data Diri) */
        .table-noborder td {
            padding: 4px 0;
            vertical-align: top;
        }

        /* Tabel Dengan Border (Data Skema & Persyaratan) */
        .table-bordered th,
        .table-bordered td {
            border: 1px solid #333;
            padding: 6px 8px;
            vertical-align: middle;
        }

        .table-bordered th {
            background-color: #f0f0f0;
            /* Warna latar elegan pengganti oren cerah */
            font-weight: bold;
            text-align: center;
        }

        /* Penyesuaian Halaman */
        .page-break {
            page-break-after: always;
        }

        .center {
            text-align: center;
        }

        /* Box Tanda Tangan */
        .sign-box img {
            max-height: 80px;
            max-width: 100px;
        }

        .sign-placeholder {
            height: 80px;
        }
    </style>
</head>

<body>

    <!-- KOP Surat (Hanya di Halaman Pertama karena ditaruh di dalam alur body normal) -->
    <div class="kop-container">
        <?php if ($base64_kop != ''): ?>
            <img src="<?= $base64_kop ?>" alt="Kop Surat LSP">
        <?php else: ?>
            <h2 style="color:red; font-size:14pt;">[KOP SURAT TIDAK DITEMUKAN / PASTIKAN PATH NYA BENAR]</h2>
        <?php endif; ?>
    </div>

    <!-- BAGIAN 1 -->
    <main>
        <h4>Bagian 1: Rincian Data Pemohon Sertifikasi</h4>
        <p>Pada bagian ini, cantumkan data pribadi, data pendidikan formal serta data pekerjaan Anda pada saat ini.</p>

        <p class="section-title">a. Data Pribadi</p>
        <table class="table-noborder" style="margin-left: 15px; width: 95%;">
            <tr>
                <td width="30%">Nama Lengkap</td>
                <td width="2%">:</td>
                <td width="68%"><strong><?= $get_data_personal_permohonan->nama; ?></strong></td>
            </tr>
            <tr>
                <td>No. KTP/NIK/Paspor</td>
                <td>:</td>
                <td><?= $get_data_personal_permohonan->nik; ?></td>
            </tr>
            <tr>
                <td>Tempat / Tgl. Lahir</td>
                <td>:</td>
                <td><?= $get_data_personal_permohonan->tempat_lahir . ' / ' . tanggal_indo($get_data_personal_permohonan->tanggal_lahir); ?>
                </td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td>:</td>
                <td><?= $get_data_personal_permohonan->jenis_kelamin; ?></td>
            </tr>
            <tr>
                <td>Kebangsaan</td>
                <td>:</td>
                <td><?= $get_data_personal_permohonan->negara == "ID" ? "Indonesia" : $get_data_personal_permohonan->negara ?>
                </td>
            </tr>
            <tr>
                <td>Alamat Rumah</td>
                <td>:</td>
                <td><?= $get_data_personal_permohonan->alamat; ?></td>
            </tr>
            <tr>
                <td>Kode Pos</td>
                <td>:</td>
                <td><?= $get_data_personal_permohonan->kodepos; ?></td>
            </tr>
            <tr>
                <td>No. Telepon</td>
                <td>:</td>
                <td><?= $get_data_personal_permohonan->telepon; ?></td>
            </tr>
            <tr>
                <td>Email</td>
                <td>:</td>
                <td>
                    <?= $get_data_personal_permohonan->email; ?>
                </td>
            </tr>
            <tr>
                <td>Pendidikan</td>
                <td>:</td>
                <td><?= $get_data_pendidikan_yang_sesuai->nama_sekolah_perguruan_tinggi . " - " . $get_data_pendidikan_yang_sesuai->program_studi; ?>
                </td>
            </tr>
        </table>

        <p class="section-title" style="margin-top:20px;">b. Data Pekerjaan Sekarang</p>
        <table class="table-noborder" style="margin-left: 15px; width: 95%;">
            <tr>
                <td width="30%">Nama Institusi / Perusahaan</td>
                <td width="2%">:</td>
                <td width="68%"><strong><?= $get_data_apl01->pekerjaan_sekarang_perusahaan; ?></strong></td>
            </tr>
            <tr>
                <td>Jabatan</td>
                <td>:</td>
                <td><?= $get_data_apl01->pekerjaan_sekarang_jabatan; ?></td>
            </tr>
            <tr>
                <td>Alamat Kantor</td>
                <td>:</td>
                <td><?= $get_data_apl01->pekerjaan_sekarang_alamat_kantor; ?></td>
            </tr>
            <tr>
                <td>No. Telepon</td>
                <td>:</td>
                <td><?= $get_data_apl01->pekerjaan_sekarang_notlp_kantor; ?></td>
            </tr>
            <tr>
                <td>Fax</td>
                <td>:</td>
                <td><?= $get_data_apl01->pekerjaan_sekarang_fax_kantor; ?></td>
            </tr>
            <tr>
                <td>Email Kantor</td>
                <td>:</td>
                <td><?= $get_data_apl01->pekerjaan_sekarang_email_kantor; ?></td>
            </tr>
        </table>

        <div class="page-break"></div>

        <!-- BAGIAN 2 -->
        <h4>Bagian 2: Data Sertifikasi</h4>
        <p>Tuliskan Judul dan Nomor Skema Sertifikasi yang Anda ajukan berikut Daftar Unit Kompetensi sesuai kemasan
            pada skema sertifikasi untuk mendapatkan pengakuan sesuai dengan latar belakang pendidikan, pelatihan serta
            pengalaman kerja yang Anda miliki.</p>

        <table class="table-bordered">
            <tr>
                <td rowspan="2" width="45%" style="font-weight:bold;">Skema Sertifikasi<br>(KKNI/Okupasi/Klaster)</td>
                <td width="10%">Judul</td>
                <td width="2%">:</td>
                <td width="43%"><strong><?= $get_data_klasifikasi_kualifikasi->deskripsi_jabatan_kerja; ?></strong></td>
            </tr>
            <tr>
                <td>Nomor</td>
                <td>:</td>
                <td><?= $get_data_klasifikasi_kualifikasi->acuan; ?></td>
            </tr>
            <tr>
                <td colspan="2" rowspan="2" style="font-weight:bold;">Tujuan Asesmen</td>
                <td class="center"><?= ($get_data_apl01->tujuan_asesment == 'Sertifikasi') ? 'V' : ''; ?></td>
                <td>Sertifikasi</td>
            </tr>
            <tr>
                <td class="center"><?= ($get_data_apl01->tujuan_asesment == 'Sertifikasi Ulang') ? 'V' : ''; ?>
                </td>
                <td>Sertifikasi Ulang</td>
            </tr>
        </table>

        <p class="section-title">Daftar Unit Kompetensi Sesuai Kemasan:</p>
        <table class="table-bordered">
            <thead>
                <tr>
                    <th width="5%">No.</th>
                    <th width="25%">Kode Unit</th>
                    <th width="45%">Judul Unit</th>
                    <th width="25%">Acuan</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($get_data_unit_kompetensi as $data_unit_kompetensi): ?>
                    <tr>
                        <td class="center"><?= $no++; ?></td>
                        <td class="center"><?= $data_unit_kompetensi['kode_unit_kompetensi']; ?></td>
                        <td><?= $data_unit_kompetensi['judul_unit_kompetensi']; ?></td>
                        <td class="center"><?= $data_unit_kompetensi['skkni']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="page-break"></div>

        <!-- BAGIAN 3 -->
        <h4>Bagian 3: Bukti Kelengkapan Pemohon</h4>
        <p>Bukti Persyaratan Dasar Pemohon</p>
        <table class="table-bordered">
            <thead>
                <tr>
                    <th rowspan="2" width="55%">Bukti Persyaratan Dasar</th>
                    <th colspan="2" width="30%">Ada</th>
                    <th rowspan="2" width="15%">Tidak Ada</th>
                </tr>
                <tr>
                    <th>Memenuhi<br>Syarat</th>
                    <th>Tidak Memenuhi<br>Syarat</th>
                </tr>
            </thead>
            <tbody>
                <!-- Persyaratan Kompetensi -->
                <tr>
                    <td>
                        <?php
                        foreach ($get_master_persyaratan_kompeten as $master_persyaratan_kompeten_apl) {
                            if ($master_persyaratan_kompeten_apl['id'] == $get_data_apl01->id_persyaratan_kompeten) {
                                echo $master_persyaratan_kompeten_apl['persyaratan_pendidikan'] . ' (Pengalaman: ' . $master_persyaratan_kompeten_apl['persyaratan_pengalaman_proyek'] . ")";
                            }
                        }
                        ?>
                    </td>
                    <td class="center">
                        <?= ($get_data_apl01->status_persyaratan_kompeten == 'Ada (Memenuhi Syarat)') ? 'V' : ''; ?>
                    </td>
                    <td class="center">
                        <?= ($get_data_apl01->status_persyaratan_kompeten == 'Ada (Tidak Memenuhi Syarat)') ? 'V' : ''; ?>
                    </td>
                    <td class="center">
                        <?= ($get_data_apl01->status_persyaratan_kompeten == 'Tidak Ada') ? 'V' : ''; ?>
                    </td>
                </tr>
                <!-- File KTP -->
                <tr>
                    <td>File KTP</td>
                    <td class="center">
                        <?= ($get_data_apl01->status_ktp == 'Ada (Memenuhi Syarat)') ? 'V' : ''; ?>
                    </td>
                    <td class="center">
                        <?= ($get_data_apl01->status_ktp == 'Ada (Tidak Memenuhi Syarat)') ? 'V' : ''; ?>
                    </td>
                    <td class="center"><?= ($get_data_apl01->status_ktp == 'Tidak Ada') ? 'V' : ''; ?></td>
                </tr>
                <!-- File Pas Foto -->
                <tr>
                    <td>Pas Foto</td>
                    <td class="center">
                        <?= ($get_data_apl01->status_pas_foto == 'Ada (Memenuhi Syarat)') ? 'V' : ''; ?>
                    </td>
                    <td class="center">
                        <?= ($get_data_apl01->status_pas_foto == 'Ada (Tidak Memenuhi Syarat)') ? 'V' : ''; ?>
                    </td>
                    <td class="center"><?= ($get_data_apl01->status_pas_foto == 'Tidak Ada') ? 'V' : ''; ?></td>
                </tr>
            </tbody>
        </table>

        <!-- Box Tanda Tangan -->
        <table class="table-bordered" style="margin-top: 30px;">
            <tr>
                <td rowspan="3" width="60%" style="vertical-align: top; padding: 15px;">
                    <p><strong>Rekomendasi (Diisi oleh LSP):</strong></p>
                    <p>Berdasarkan ketentuan persyaratan dasar, maka pemohon:</p>
                    <p style="margin-top: 10px;">
                        <strong>Diterima /
                            <?php if (!empty($get_data_apl01->tanggal_ttd_peninjau)) {
                                echo "<del>Tidak diterima</del>";
                            } else {
                                echo "Tidak diterima";
                            } ?>
                            *</strong> sebagai peserta sertifikasi.
                    </p>
                    <p><small>* coret yang tidak sesuai</small></p>
                </td>
                <td colspan="2" class="center" style="background-color: #f0f0f0;"><strong>Pemohon / Kandidat</strong>
                </td>
            </tr>
            <tr>
                <td width="15%">Nama</td>
                <td width="25%"><strong><?= $get_data_personal_permohonan->nama; ?></strong></td>
            </tr>
            <tr>
                <td>Tanda Tangan</td>
                <td class="center sign-box">
                    <?php if ($base64_pemohon != ''): ?>
                        <img src="<?= $base64_pemohon ?>" alt="TTD Pemohon">
                    <?php else: ?>
                        <div class="sign-placeholder"></div>
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <td rowspan="3" style="vertical-align: top; padding: 15px;">
                    <p><strong>Catatan Tambahan:</strong></p>
                </td>
                <td colspan="2" class="center" style="background-color: #f0f0f0;"><strong>Admin LSP</strong></td>
            </tr>
            <tr>
                <td>Nama</td>
                <td><strong><?= !empty($get_nama_peninjau_apl01->nama_peninjau) ? $get_nama_peninjau_apl01->nama_peninjau : '-'; ?></strong>
                </td>
            </tr>
            <tr>
                <td>Tanda Tangan & Tanggal</td>
                <td class="center sign-box">
                    <?php if ($base64_admin != ''): ?>
                        <img src="<?= $base64_admin ?>" alt="TTD Admin"><br>
                        <small><?= tanggal_indo(date('Y-m-d', strtotime($get_data_apl01->tanggal_ttd_peninjau))); ?></small>
                    <?php else: ?>
                        <div class="sign-placeholder"></div>
                    <?php endif; ?>
                </td>
            </tr>
        </table>
    </main>
</body>

</html>