<!DOCTYPE html>
<html lang="in">

<head>
    <title>Tinjau Permohonan</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">
    <link rel="stylesheet"
        href="https://unpkg.com/bootstrap-material-design@4.1.1/dist/css/bootstrap-material-design.min.css"
        integrity="sha384-wXznGJNEXNG1NFsbm0ugrLFMQPWswR3lds2VeinahP8N0zJw9VWSopbjv2x7WCvX" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/tab-content.css'); ?>">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://unpkg.com/popper.js@1.12.6/dist/umd/popper.js"
        integrity="sha384-fA23ZRQ3G/J53mElWqVJEGJzU0sTs+SvzG8fXVWP+kJQ1lwFAOkcUOysnlKJC33U"
        crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <script src="<?= base_url('assets/js/jquery-2.1.3.min.js'); ?>"></script>
    <script src="<?= base_url('assets/js/bootstrap.min.js'); ?>"></script>
    <script type="text/javascript" src="<?= base_url('assets/js/signature-pad.js'); ?>"></script>
</head>

<body>
    <div class="container-fluid py-4">
        <div class="title mb-4">
            <h3>Tinjau Permohonan</h3>
        </div>

        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card shadow border-bottom-info mb-4">
                    <div class='card-body'>
                        <h5><b>Info Data Permohonan adalah</b></h5><br />
                        <?php
                        echo 'Nama              : ' . $get_data_personal_permohonan[0]['nama'] . '<br/>';
                        echo 'NIK               : ' . $get_data_personal_permohonan[0]['nik'] . '<br/>';
                        echo 'Kualifikasi       : ' . $info_data_permohonan->kualifikasi . ' (' . $info_data_permohonan->deskripsi_kualifikasi . ')<br/>';
                        echo 'Jabatan Kerja     : ' . $info_data_permohonan->jabatan_kerja . ' (' . $info_data_permohonan->deskripsi_jabatan_kerja . ')<br/>';
                        echo 'Jenjang           : ' . $info_data_permohonan->jenjang . '<br/>';
                        echo 'Jenis Permohonan  : ' . $info_data_permohonan->deskripsi_jenis_permohonan . '<br/>';
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-nav-tabs header-primary shadow mb-4">
            <div class="card-header card-header-hitam">
                <div class="nav-tabs-navigation">
                    <div class="nav-tabs-wrapper">
                        <ul class="nav nav-tabs" data-tabs="tabs">
                            <li class="nav-item">
                                <a class="nav-link active" href="#administrasi" data-toggle="tab">
                                    <i class="material-icons">face</i> Administrasi
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#pendidikan" data-toggle="tab">
                                    <i class="material-icons">school</i> Pendidikan
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#proyek" data-toggle="tab">
                                    <i class="material-icons">history</i> Proyek
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#pelatihan" data-toggle="tab">
                                    <i class="material-icons">history</i> Pelatihan
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#apl01" data-toggle="tab">
                                    <i class="material-icons">history</i> Apl 01
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#klasifikasi_kualifikasi" data-toggle="tab">
                                    <i class="material-icons">build</i> Klasifikasi Kualifikasi
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="tab-content">
                    <div class="tab-pane active container" id="administrasi">
                        <h5>Personal</h5>
                        <form
                            action="<?= base_url('Admin/insert_administrasi_tinjau_permohonan/') . base64_encode($id_izin); ?>"
                            method="POST">
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                                value="<?= $this->security->get_csrf_hash(); ?>" />

                            <table class="table table-borderless text" width="100%">
                                <tr>
                                    <td width="15%">
                                        <h5>#1</h5>
                                    </td>
                                    <td width="20%" class="text-center">Tidak/Ada</td>
                                    <td width="15%"></td>
                                    <td width="50%"></td>
                                </tr>
                                <tr>
                                    <td valign="top">File KTP</td>
                                    <td valign="top" class="text-center">
                                        <div class="custom-control custom-switch">
                                            <?php
                                            $ktp_checked = '';
                                            foreach ($get_data_tinjau_permohonan as $data_tinjau_permohonan) {
                                                if ($data_tinjau_permohonan['item_tinjau_permohonan'] == '1a' && $data_tinjau_permohonan['status'] == '1') {
                                                    $ktp_checked = 'checked';
                                                    break;
                                                }
                                            }
                                            ?>
                                            <input type="checkbox" class="custom-control-input" value="1" id="1a"
                                                name="ktp" <?= $ktp_checked; ?>>
                                            <label class="custom-control-label" for="1a"></label>
                                        </div>
                                    </td>
                                    <td valign="top">
                                        <a href="<?php echo (!empty($get_data_personal_permohonan[0]['ktp'])) ? $get_data_personal_permohonan[0]['ktp'] : base_url('errors/not_upload'); ?>"
                                            target="_blank">
                                            <i class="fas fa-fw fa-eye"></i> View File
                                        </a>
                                    </td>
                                    <td valign="top">
                                        <input type="text" class="form-control form-control-sm" name="catatan_ktp"
                                            placeholder="Catatan..." <?php
                                            foreach ($get_data_tinjau_permohonan as $data_tinjau_permohonan) {
                                                if ($data_tinjau_permohonan['item_tinjau_permohonan'] == '1a') {
                                                    echo 'value="' . $data_tinjau_permohonan['catatan'] . '"';
                                                }
                                            } ?>>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <h5>#2</h5>
                                    </td>
                                    <td class="text-center">Tidak/Ada</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td valign="top">Surat Pernyataan Kebenaran Data</td>
                                    <td valign="top" class="text-center">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" value="1" id="1b"
                                                name="pernyataan_kebenaran_data" <?php
                                                foreach ($get_data_tinjau_permohonan as $data_tinjau_permohonan) {
                                                    if ($data_tinjau_permohonan['item_tinjau_permohonan'] == '1b' && $data_tinjau_permohonan['status'] == '1') {
                                                        echo 'checked';
                                                    }
                                                } ?>>
                                            <label class="custom-control-label" for="1b"></label>
                                        </div>
                                    </td>
                                    <td valign="top">
                                        <a href="<?php echo (!empty($get_data_personal_permohonan[0]['surat_pernyataan_kebenaran_data'])) ? $get_data_personal_permohonan[0]['surat_pernyataan_kebenaran_data'] : base_url('errors/not_upload'); ?>"
                                            target="_blank">
                                            <i class="fas fa-fw fa-eye"></i> View File
                                        </a>
                                    </td>
                                    <td valign="top">
                                        <input type="text" class="form-control form-control-sm"
                                            name="catatan_pernyataan_kebenaran_data" placeholder="Catatan..." <?php
                                            foreach ($get_data_tinjau_permohonan as $data_tinjau_permohonan) {
                                                if ($data_tinjau_permohonan['item_tinjau_permohonan'] == '1b') {
                                                    echo 'value="' . $data_tinjau_permohonan['catatan'] . '"';
                                                }
                                            } ?>>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <h5>#3</h5>
                                    </td>
                                    <td class="text-center">Tidak/Ada</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td valign="top">File NPWP</td>
                                    <td valign="top" class="text-center">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" value="1" id="1c"
                                                name="npwp" <?php
                                                foreach ($get_data_tinjau_permohonan as $data_tinjau_permohonan) {
                                                    if ($data_tinjau_permohonan['item_tinjau_permohonan'] == '1c' && $data_tinjau_permohonan['status'] == '1') {
                                                        echo 'checked';
                                                    }
                                                } ?>>
                                            <label class="custom-control-label" for="1c"></label>
                                        </div>
                                    </td>
                                    <td valign="top">
                                        <a href="<?php echo (!empty($get_data_personal_permohonan[0]['file_npwp'])) ? $get_data_personal_permohonan[0]['file_npwp'] : base_url('errors/not_upload'); ?>"
                                            target="_blank">
                                            <i class="fas fa-fw fa-eye"></i> View File
                                        </a>
                                    </td>
                                    <td valign="top">
                                        <input type="text" class="form-control form-control-sm" name="catatan_npwp"
                                            placeholder="Catatan..." <?php
                                            foreach ($get_data_tinjau_permohonan as $data_tinjau_permohonan) {
                                                if ($data_tinjau_permohonan['item_tinjau_permohonan'] == '1c') {
                                                    echo 'value="' . $data_tinjau_permohonan['catatan'] . '"';
                                                }
                                            } ?>>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <h5>#4</h5>
                                    </td>
                                    <td class="text-center">Tidak/Ada</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr style="border-bottom:3px solid #111;">
                                    <td valign="top">Pas Foto</td>
                                    <td valign="top" class="text-center">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" value="1" id="1d"
                                                name="pas_foto" <?php
                                                foreach ($get_data_tinjau_permohonan as $data_tinjau_permohonan) {
                                                    if ($data_tinjau_permohonan['item_tinjau_permohonan'] == '1d' && $data_tinjau_permohonan['status'] == '1') {
                                                        echo 'checked';
                                                    }
                                                } ?>>
                                            <label class="custom-control-label" for="1d"></label>
                                        </div>
                                    </td>
                                    <td valign="top">
                                        <a href="<?php echo (!empty($get_data_personal_permohonan[0]['pas_foto'])) ? $get_data_personal_permohonan[0]['pas_foto'] : base_url('errors/not_upload'); ?>"
                                            target="_blank">
                                            <i class="fas fa-fw fa-eye"></i> View File
                                        </a>
                                    </td>
                                    <td valign="top">
                                        <input type="text" class="form-control form-control-sm" name="catatan_pas_foto"
                                            placeholder="Catatan..." <?php
                                            foreach ($get_data_tinjau_permohonan as $data_tinjau_permohonan) {
                                                if ($data_tinjau_permohonan['item_tinjau_permohonan'] == '1d') {
                                                    echo 'value="' . $data_tinjau_permohonan['catatan'] . '"';
                                                }
                                            } ?>>
                                    </td>
                                </tr>
                            </table>

                            <table class="table table-borderless text" width="100%">
                                <tr>
                                    <td width="15%">
                                        <h5>#CEKLIS</h5>
                                    </td>
                                    <td width="20%" class="text-center">Tidak/Lengkap</td>
                                    <td width="65%"></td>
                                </tr>
                                <tr style="border-bottom:3px solid #111;">
                                    <td valign="top">Administrasi</td>
                                    <td valign="top" class="text-center">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" value="1" id="1"
                                                name="ceklis_administrasi" <?php
                                                foreach ($get_data_tinjau_permohonan as $data_tinjau_permohonan) {
                                                    if ($data_tinjau_permohonan['item_tinjau_permohonan'] == '1' && $data_tinjau_permohonan['status'] == '1') {
                                                        echo 'checked';
                                                    }
                                                } ?>>
                                            <label class="custom-control-label" for="1"></label>
                                        </div>
                                    </td>
                                    <td valign="top">
                                        <input type="text" class="form-control form-control-sm"
                                            name="catatan_ceklis_administrasi" placeholder="Catatan..." <?php
                                            foreach ($get_data_tinjau_permohonan as $data_tinjau_permohonan) {
                                                if ($data_tinjau_permohonan['item_tinjau_permohonan'] == '1') {
                                                    echo 'value="' . $data_tinjau_permohonan['catatan'] . '"';
                                                }
                                            } ?>>
                                    </td>
                                </tr>
                            </table>

                            <div class="mt-4">
                                <h5>Data Administrasi Pemohon</h5>
                                <table class="table table-striped text" width="100%">
                                    <tr>
                                        <td width="20%" style="font-weight:bold;">Nama</td>
                                        <td width="2%" align="center">:</td>
                                        <td width="78%"><?php echo $get_data_personal_permohonan[0]['nama'] ?></td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight:bold;">NIK</td>
                                        <td align="center">:</td>
                                        <td><?php echo $get_data_personal_permohonan[0]['nik'] ?></td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight:bold;">Email</td>
                                        <td align="center">:</td>
                                        <td><?php echo $get_data_personal_permohonan[0]['email'] ?></td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight:bold;">Telepon</td>
                                        <td align="center">:</td>
                                        <td><?php echo $get_data_personal_permohonan[0]['telepon'] ?></td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight:bold;">Alamat</td>
                                        <td align="center">:</td>
                                        <td><?php echo $get_data_personal_permohonan[0]['alamat'] ?></td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight:bold;">Propinsi</td>
                                        <td align="center">:</td>
                                        <td><?= $get_data_personal_permohonan[0]['deskripsi_propinsi']; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight:bold;">Kota/Kabupaten</td>
                                        <td align="center">:</td>
                                        <td><?= $get_data_personal_permohonan[0]['deskripsi_kabupaten']; ?></td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight:bold;">Kode Pos</td>
                                        <td align="center">:</td>
                                        <td><?php echo $get_data_personal_permohonan[0]['kodepos'] ?></td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight:bold;">Tempat, Tanggal Lahir</td>
                                        <td align="center">:</td>
                                        <td><?php echo $get_data_personal_permohonan[0]['tempat_lahir'] . ', ' . $get_data_personal_permohonan[0]['tanggal_lahir'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight:bold;">Jenis Kelamin</td>
                                        <td align="center">:</td>
                                        <td><?php echo $get_data_personal_permohonan[0]['jenis_kelamin'] ?></td>
                                    </tr>
                                </table>
                                <input type="submit" value="Simpan" class="btn btn-primary mt-3"
                                    style="float:right; background-color:#0295da; color:#fff;" />
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane container" id="pendidikan">
                        <h5>Pendidikan</h5>
                        <p>Data Pendidikan <?php echo $get_data_personal_permohonan[0]['nama'] ?></p>
                        <table class="table table-responsive table-bordered w-100" cellspacing="0" cellpadding="3">
                            <thead>
                                <tr>
                                    <th width="5%" class="text-center"><b>Jenjang</b></th>
                                    <th width="20%" class="text-center"><b>Nama Perguruan</b></th>
                                    <th width="20%" class="text-center"><b>Program Studi</b></th>
                                    <th width="10%" class="text-center"><b>Tahun Lulusan</b></th>
                                    <th width="20%" class="text-center"><b>Scan Ijazah Legalisir</b></th>
                                    <th width="20%" class="text-center"><b>Scan Surat Keterangan</b></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($get_data_pendidikan_permohonan as $data_pendidikan) { ?>
                                    <tr>
                                        <td class="text-center"><?= $data_pendidikan['deskripsi_jenjang']; ?></td>
                                        <td><?php echo $data_pendidikan['nama_sekolah_perguruan_tinggi']; ?></td>
                                        <td class="text-center"><?php echo $data_pendidikan['program_studi']; ?></td>
                                        <td class="text-center"><?php echo $data_pendidikan['tahun_lulus']; ?></td>
                                        <td class="text-center">
                                            <a href="<?php echo (!empty($data_pendidikan['scan_ijazah_legalisir'])) ? $data_pendidikan['scan_ijazah_legalisir'] : base_url('errors/not_upload'); ?>"
                                                target="_blank">
                                                <i class="fas fa-fw fa-eye"></i> View File
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <a href="<?php echo (!empty($data_pendidikan['scan_surat_keterangan'])) ? $data_pendidikan['scan_surat_keterangan'] : base_url('errors/not_upload'); ?>"
                                                target="_blank">
                                                <i class="fas fa-fw fa-eye"></i> View File
                                            </a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>

                        <hr style="border-bottom:3px solid #111;" />

                        <form
                            action="<?= base_url('Admin/insert_pendidikan_tinjau_permohonan/') . base64_encode($id_izin); ?>"
                            method="POST">
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                                value="<?= $this->security->get_csrf_hash(); ?>" />

                            <div class="form-group mb-4">
                                <label class="font-weight-bold">Pilih Jenjang Pendidikan Terakhir yang Sesuai dengan
                                    Kompetensi Permohonan</label>
                                <select class="custom-select" name="jenjang_yang_sesuai" required>
                                    <option value=''>Pilih Jenjang...</option>
                                    <?php foreach ($get_data_pendidikan_permohonan as $data_pendidikan) { ?>
                                        <option value="<?= $data_pendidikan['id'] ?>" <?php if (!empty($data_pendidikan_yang_sudah_dipilih->jenjang_yang_sesuai) && $data_pendidikan_yang_sudah_dipilih->jenjang_yang_sesuai == $data_pendidikan['id']) {
                                              echo 'selected';
                                          } ?>>
                                            <?= $data_pendidikan['deskripsi_jenjang'] . ' (' . $data_pendidikan['nama_sekolah_perguruan_tinggi'] . ' - ' . $data_pendidikan['program_studi'] . ")" ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <table class="table table-borderless text" width="100%">
                                <tr>
                                    <td width="15%">
                                        <h5>#1</h5>
                                    </td>
                                    <td width="20%" class="text-center">Tidak/Ada</td>
                                    <td width="65%"></td>
                                </tr>
                                <tr>
                                    <td valign="top">Scan Ijazah Legalisir</td>
                                    <td valign="top" class="text-center">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" value="1" id="2a"
                                                name="scan_ijazah_legalisir" <?php
                                                foreach ($get_data_tinjau_permohonan as $data_tinjau_permohonan) {
                                                    if ($data_tinjau_permohonan['item_tinjau_permohonan'] == '2a' && $data_tinjau_permohonan['status'] == '1') {
                                                        echo 'checked';
                                                    }
                                                } ?>>
                                            <label class="custom-control-label" for="2a"></label>
                                        </div>
                                    </td>
                                    <td valign="top">
                                        <input type="text" class="form-control form-control-sm"
                                            name="catatan_scan_ijazah_legalisir" placeholder="Catatan..." <?php
                                            foreach ($get_data_tinjau_permohonan as $data_tinjau_permohonan) {
                                                if ($data_tinjau_permohonan['item_tinjau_permohonan'] == '2a') {
                                                    echo 'value="' . $data_tinjau_permohonan['catatan'] . '"';
                                                }
                                            } ?>>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <h5>#2</h5>
                                    </td>
                                    <td class="text-center">Tidak/Ada</td>
                                    <td></td>
                                </tr>
                                <tr style="border-bottom:3px solid #111;">
                                    <td valign="top">Scan Surat Keterangan</td>
                                    <td valign="top" class="text-center">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" value="1" id="2b"
                                                name="scan_surat_keterangan_pendidikan" <?php
                                                foreach ($get_data_tinjau_permohonan as $data_tinjau_permohonan) {
                                                    if ($data_tinjau_permohonan['item_tinjau_permohonan'] == '2b' && $data_tinjau_permohonan['status'] == '1') {
                                                        echo 'checked';
                                                    }
                                                } ?>>
                                            <label class="custom-control-label" for="2b"></label>
                                        </div>
                                    </td>
                                    <td valign="top">
                                        <input type="text" class="form-control form-control-sm"
                                            name="catatan_scan_surat_keterangan_pendidikan" placeholder="Catatan...">
                                    </td>
                                </tr>
                            </table>

                            <table class="table table-borderless text" width="100%">
                                <tr>
                                    <td width="15%">
                                        <h5>#CEKLIS</h5>
                                    </td>
                                    <td width="20%" class="text-center">Tidak/Lengkap</td>
                                    <td width="65%"></td>
                                </tr>
                                <tr>
                                    <td valign="top">Pendidikan</td>
                                    <td valign="top" class="text-center">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" value="1" id="2"
                                                name="ceklis_pendidikan" <?php
                                                foreach ($get_data_tinjau_permohonan as $data_tinjau_permohonan) {
                                                    if ($data_tinjau_permohonan['item_tinjau_permohonan'] == '2' && $data_tinjau_permohonan['status'] == '1') {
                                                        echo 'checked';
                                                    }
                                                } ?>>
                                            <label class="custom-control-label" for="2"></label>
                                        </div>
                                    </td>
                                    <td valign="top">
                                        <input type="text" class="form-control form-control-sm"
                                            name="catatan_ceklis_pendidikan" placeholder="Catatan..." <?php
                                            foreach ($get_data_tinjau_permohonan as $data_tinjau_permohonan) {
                                                if ($data_tinjau_permohonan['item_tinjau_permohonan'] == '2') {
                                                    echo 'value="' . $data_tinjau_permohonan['catatan'] . '"';
                                                }
                                            } ?>>
                                    </td>
                                </tr>
                            </table>
                            <input type="submit" value="Simpan" class="btn btn-primary mt-3"
                                style="float:right; background-color:#0295da; color:#fff;" />
                        </form>
                    </div>
                    <div class="tab-pane container" id="proyek">
                        <h5>Proyek</h5>
                        <form
                            action="<?= base_url('Admin/insert_proyek_tinjau_permohonan/') . base64_encode($id_izin); ?>"
                            method="POST">
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                                value="<?= $this->security->get_csrf_hash(); ?>" />

                            <p>Data Proyek <?= $get_data_personal_permohonan[0]['nama'] ?></p>
                            <table class="table table-responsive table-bordered w-100" cellspacing="0" cellpadding="3">
                                <thead>
                                    <tr>
                                        <th width="2%" class="text-center"><b>No</b></th>
                                        <th width="13%" class="text-center"><b>Nama Proyek</b></th>
                                        <th width="5%" class="text-center"><b>Jabatan</b></th>
                                        <th width="10%" class="text-center"><b>Nilai Proyek</b></th>
                                        <th width="10%" class="text-center"><b>Lama Proyek</b></th>
                                        <th width="20%" class="text-center"><b>Surat Referensi</b></th>
                                        <th width="10%" class="text-center"><b>Input Catatan</b></th>
                                        <th width="10%" class="text-center"><b>Jenis Pengalaman</b></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    $no = 1;
                                    foreach ($get_data_proyek_permohonan as $data_proyek) {
                                        $ts1 = strtotime($data_proyek['tanggal_awal']);
                                        $ts2 = strtotime($data_proyek['tanggal_akhir']);
                                        $bulan = ((date('Y', $ts2) - date('Y', $ts1)) * 12) + (date('m', $ts2) - date('m', $ts1));

                                        $startDate = new DateTime($data_proyek['tanggal_awal']);
                                        $endDate = new DateTime($data_proyek['tanggal_akhir']);
                                        $hari = $endDate->diff($startDate);
                                        ?>
                                        <tr>
                                            <td class="text-center"><?php echo $no++; ?></td>
                                            <td><?php echo $data_proyek['nama_proyek']; ?></td>
                                            <td class="text-center"><?php echo $data_proyek['jabatan']; ?></td>
                                            <td class="text-center">
                                                <?= (!empty($data_proyek['nilai_proyek'])) ? 'Rp. ' . number_format($data_proyek['nilai_proyek'], 0, ',', '.') : '0'; ?>
                                            </td>
                                            <td class="text-center">
                                                <?= $hari->format("%a") . ' hari ( ' . $bulan . ' bulan )'; ?>
                                            </td>
                                            <td class="text-center">
                                                <a href="<?php echo (!empty($data_proyek['surat_referensi'])) ? $data_proyek['surat_referensi'] : base_url('errors/not_upload'); ?>"
                                                    target="_blank"><i class="fas fa-fw fa-eye"></i> View</a>
                                                <div class="custom-control custom-switch mt-2">
                                                    <input type="checkbox" class="custom-control-input" value="1"
                                                        id="3a<?= $i; ?>" name="surat_referensi_proyek[<?= $i; ?>]" <?php
                                                            foreach ($get_data_tinjau_permohonan as $data_tinjau_permohonan) {
                                                                if ($data_tinjau_permohonan['item_tinjau_permohonan'] == '3a' . $i && $data_tinjau_permohonan['status'] == '1') {
                                                                    echo 'checked';
                                                                }
                                                            } ?>>
                                                    <label class="custom-control-label" for="3a<?= $i; ?>">Ada</label>
                                                </div>
                                                <input type="hidden" name="kode_item[<?= $i; ?>]" value="3a<?= $i; ?>" />
                                                <input type="hidden" name="id_proyek[<?= $i; ?>]"
                                                    value="<?= $data_proyek['id']; ?>" />
                                            </td>
                                            <td>
                                                <input type="text" class="form-control form-control-sm"
                                                    name="catatan_surat_referensi_proyek[<?= $i; ?>]"
                                                    placeholder="Catatan..." <?php
                                                    foreach ($get_data_tinjau_permohonan as $data_tinjau_permohonan) {
                                                        if ($data_tinjau_permohonan['item_tinjau_permohonan'] == '3a' . $i) {
                                                            echo 'value="' . $data_tinjau_permohonan['catatan'] . '"';
                                                        }
                                                    } ?>>
                                            </td>
                                            <td class="text-center"><?php echo $data_proyek['jenis_pengalaman']; ?></td>
                                        </tr>
                                        <?php $i++;
                                    } ?>
                                    <input type="hidden" name="count" value="<?php echo $i; ?>" />

                                    <tr>
                                        <td class="text-center" colspan="3"><b>Total</b></td>
                                        <td class="text-center" style="font-weight:bold;">
                                            <?php
                                            $sum_nilai_proyek = 0;
                                            foreach ($get_data_proyek_permohonan as $data_proyek) {
                                                $sum_nilai_proyek += (!empty($data_proyek['nilai_proyek'])) ? $data_proyek['nilai_proyek'] : 0;
                                            }
                                            echo 'Rp. ' . number_format($sum_nilai_proyek, 0, ',', '.');
                                            ?>
                                        </td>
                                        <td class="text-center" style="font-weight:bold;">
                                            <?php
                                            $sum_hari = 0;
                                            foreach ($get_data_proyek_permohonan as $data_proyek) {
                                                $d = (new DateTime($data_proyek['tanggal_akhir']))->diff(new DateTime($data_proyek['tanggal_awal']));
                                                $sum_hari += $d->format("%a");
                                            }
                                            echo $sum_hari . ' hari ( ' . floor($sum_hari / 30) . ' bulan )';
                                            ?>
                                        </td>
                                        <td colspan="3"></td>
                                    </tr>
                                </tbody>
                            </table>

                            <hr style="border-bottom:3px solid #111;" />

                            <table class="table table-borderless text" width="100%">
                                <tr>
                                    <td width="15%">
                                        <h5>#CEKLIS</h5>
                                    </td>
                                    <td width="20%" class="text-center">Tidak/Lengkap</td>
                                    <td width="65%"></td>
                                </tr>
                                <tr style="border-bottom:3px solid #111;">
                                    <td valign="top">Proyek</td>
                                    <td valign="top" class="text-center">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" value="1" id="3"
                                                name="ceklis_proyek" <?php
                                                foreach ($get_data_tinjau_permohonan as $data_tinjau_permohonan) {
                                                    if ($data_tinjau_permohonan['item_tinjau_permohonan'] == '3' && $data_tinjau_permohonan['status'] == '1') {
                                                        echo 'checked';
                                                    }
                                                } ?>>
                                            <label class="custom-control-label" for="3"></label>
                                        </div>
                                    </td>
                                    <td valign="top">
                                        <input type="text" class="form-control form-control-sm"
                                            name="catatan_ceklis_proyek" placeholder="Catatan..." <?php
                                            foreach ($get_data_tinjau_permohonan as $data_tinjau_permohonan) {
                                                if ($data_tinjau_permohonan['item_tinjau_permohonan'] == '3') {
                                                    echo 'value="' . $data_tinjau_permohonan['catatan'] . '"';
                                                }
                                            } ?>>
                                    </td>
                                </tr>
                            </table>
                            <input type="submit" name="submit" value="Simpan" class="btn btn-primary mt-3"
                                style="float:right; background-color:#0295da; color:#fff;" />
                        </form>

                        <div class="clearfix"></div>
                        <hr style="border:2px solid #999; background-color:#999;" class="my-4" />

                        <div class="row">
                            <div class="col-md-6">
                                <b>Catatan : <i>Signature / TTD di bawah ini akan digunakan untuk keperluan Tanda Tangan
                                        pada Form Apl 01 dan Apl 02</i></b><br /><br />
                                <div class="boxarea">
                                    <div class="signature-pad" id="signature-pad">
                                        <div class="m-signature-pad" style="border:1px solid #111;">
                                            <div class="m-signature-pad-body">
                                                <canvas id="signature-canvas" width="530" height="200"></canvas>
                                            </div>
                                        </div>
                                        <div class="m-signature-pad-footer mt-2 text-center">
                                            <button type="button" id="save2" data-action="save"
                                                class="btn btn-primary btn-sm">
                                                <i class="fa fa-check"></i> Save
                                            </button>
                                            <button type="button" data-action="clear" class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash-o"></i> Clear
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" value="<?php echo rand(); ?>" id="rowno">
                            </div>
                            <div class="col-md-6 text-center">
                                <?php
                                if ($get_data_apl01->ttd_peninjau == NULL) {
                                    echo "<p style='color:red;' class='mt-5'>Belum di Tanda Tangani untuk Keperluan Apl-01, Silahkan Tanda Tangani terlebih dahulu !</p>";
                                } else {
                                    echo "<img class='img-fluid border' src='" . base_url('uploads/file_permohonan/ttd_admin_apl01/') . $get_data_apl01->ttd_peninjau . "'/>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane container" id="pelatihan">
                        <h5>Pelatihan</h5>
                        <form
                            action="<?= base_url('Admin/insert_pelatihan_tinjau_permohonan/') . base64_encode($id_izin); ?>"
                            method="POST">
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                                value="<?= $this->security->get_csrf_hash(); ?>" />

                            <table class="table table-borderless text" width="100%">
                                <tr>
                                    <td width="15%">
                                        <h5>#CEKLIS</h5>
                                    </td>
                                    <td width="20%" class="text-center">Tidak/Lengkap</td>
                                    <td width="65%"></td>
                                </tr>
                                <tr style="border-bottom:3px solid #111;">
                                    <td valign="top">Pelatihan</td>
                                    <td valign="top" class="text-center">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" value="1" id="4"
                                                name="ceklis_pelatihan" <?php
                                                foreach ($get_data_tinjau_permohonan as $data_tinjau_permohonan) {
                                                    if ($data_tinjau_permohonan['item_tinjau_permohonan'] == '4' && $data_tinjau_permohonan['status'] == '1') {
                                                        echo 'checked';
                                                    }
                                                } ?>>
                                            <label class="custom-control-label" for="4"></label>
                                        </div>
                                    </td>
                                    <td valign="top">
                                        <input type="text" class="form-control form-control-sm"
                                            name="catatan_ceklis_pelatihan" placeholder="Catatan..." <?php
                                            foreach ($get_data_tinjau_permohonan as $data_tinjau_permohonan) {
                                                if ($data_tinjau_permohonan['item_tinjau_permohonan'] == '4') {
                                                    echo 'value="' . $data_tinjau_permohonan['catatan'] . '"';
                                                }
                                            } ?>>
                                    </td>
                                </tr>
                            </table>

                            <p class="mt-4">Data Pelatihan <?php echo $get_data_personal_permohonan[0]['nama'] ?></p>
                            <table class="table table-bordered w-100" cellspacing="0" cellpadding="3">
                                <thead>
                                    <tr>
                                        <th class="text-center" width="5%"><b>No</b></th>
                                        <th class="text-center" width="25%"><b>Penyelenggara</b></th>
                                        <th class="text-center" width="35%"><b>Nama Pelatihan</b></th>
                                        <th class="text-center" width="10%"><b>Jumlah JP</b></th>
                                        <th class="text-center" width="10%"><b>Lama Pelatihan</b></th>
                                        <th class="text-center" width="15%"><b>File Sertifikat</b></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($get_data_pelatihan_permohonan as $data_pelatihan) {
                                        ?>
                                        <tr>
                                            <td class="text-center"><?php echo $no++; ?></td>
                                            <td><?php echo $data_pelatihan['penyelenggara']; ?></td>
                                            <td><?php echo $data_pelatihan['nama_pelatihan']; ?></td>
                                            <td class="text-center"><?php echo $data_pelatihan['jumlah_jp']; ?></td>
                                            <td class="text-center"><?php echo $data_pelatihan['jumlah_hari'] . ' Hari'; ?>
                                            </td>
                                            <td class="text-center">
                                                <a href="<?php echo (!empty($data_pelatihan['file_sertifikat'])) ? $data_pelatihan['file_sertifikat'] : base_url('errors/not_upload'); ?>"
                                                    target="_blank">
                                                    <i class="fas fa-fw fa-eye"></i> View File
                                                </a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <input type="submit" value="Simpan" class="btn btn-primary mt-3"
                                style="float:right; background-color:#0295da; color:#fff;" />
                        </form>
                    </div>
                    <div class="tab-pane container" id="apl01">
                        <h5>Keperluan Form APL 01</h5>
                        <form
                            action="<?= base_url('Admin/insert_apl01_tinjau_permohonan/') . base64_encode($id_izin) ?>"
                            method="POST">
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                                value="<?= $this->security->get_csrf_hash(); ?>" />

                            <table class="table table-borderless text" width="100%">
                                <tr>
                                    <td width="15%">
                                        <h5>#1</h5>
                                    </td>
                                    <td width="30%"></td>
                                    <td width="55%"></td>
                                </tr>
                                <tr>
                                    <td valign="top">Tujuan Asesmen</td>
                                    <td valign="top">
                                        <div class="form-group">
                                            <select class="form-control" name="tujuan_asesment">
                                                <option <?php if ($get_data_apl01->tujuan_asesment == 'Sertifikasi') {
                                                    echo 'selected';
                                                } ?>>Sertifikasi</option>
                                                <option <?php if ($get_data_apl01->tujuan_asesment == 'Sertifikasi Ulang') {
                                                    echo 'selected';
                                                } ?>>Sertifikasi Ulang</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5>#2</h5>
                                    </td>
                                    <td>Persyaratan Kompetensi</td>
                                    <td>Nilai Persyaratan</td>
                                </tr>
                                <tr style="border-bottom:3px solid #111;">
                                    <td valign="top">Bukti Kelengkapan Pemohon</td>
                                    <td valign="top">
                                        <div class="form-group">
                                            <select class="form-control" name="id_persyaratan_kompeten" required>
                                                <?php foreach ($option_persyaratan_kompetensi_apl01 as $option_persyaratan_kompetensi) { ?>
                                                    <option
                                                        value="<?php echo $option_persyaratan_kompetensi['id_persyaratan_kompeten']; ?>"
                                                        <?php if ($option_persyaratan_kompetensi['id_persyaratan_kompeten'] == $get_data_apl01->id_persyaratan_kompeten) {
                                                            echo 'selected';
                                                        } ?>>
                                                        <?php echo $option_persyaratan_kompetensi['persyaratan_pendidikan'] . ' ( Pengalaman ' . $option_persyaratan_kompetensi['persyaratan_pengalaman_proyek'] . ' )'; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </td>
                                    <td valign="top">
                                        <div class="form-group">
                                            <select class="form-control" name="status_persyaratan_kompeten" required>
                                                <option value="">Pilih Pernyataan</option>
                                                <option <?php if ($get_data_apl01->status_persyaratan_kompeten == 'Ada (Memenuhi Syarat)') {
                                                    echo 'selected';
                                                } ?>>Ada (Memenuhi Syarat)
                                                </option>
                                                <option <?php if ($get_data_apl01->status_persyaratan_kompeten == 'Ada (Tidak Memenuhi Syarat)') {
                                                    echo 'selected';
                                                } ?>>Ada (Tidak
                                                    Memenuhi Syarat)</option>
                                                <option <?php if ($get_data_apl01->status_persyaratan_kompeten == 'Tidak Ada') {
                                                    echo 'selected';
                                                } ?>>Tidak Ada</option>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5>#3</h5>
                                    </td>
                                    <td></td>
                                    <td>Bukti Kelengkapan</td>
                                </tr>
                                <tr style="border-bottom:3px solid #111;">
                                    <td valign="top">KTP</td>
                                    <td valign="top">
                                        <a href="<?php echo (!empty($get_data_personal_permohonan[0]['ktp'])) ? $get_data_personal_permohonan[0]['ktp'] : base_url('errors/not_upload'); ?>"
                                            target="_blank">
                                            <i class="fas fa-fw fa-eye"></i> View File
                                        </a>
                                    </td>
                                    <td valign="top">
                                        <select class="form-control" name="status_ktp" required>
                                            <option value="">Pilih Pernyataan</option>
                                            <option <?php if ($get_data_apl01->status_ktp == 'Ada (Memenuhi Syarat)') {
                                                echo 'selected';
                                            } ?>>Ada (Memenuhi Syarat)</option>
                                            <option <?php if ($get_data_apl01->status_ktp == 'Ada (Tidak Memenuhi Syarat)') {
                                                echo 'selected';
                                            } ?>>Ada (Tidak Memenuhi Syarat)</option>
                                            <option <?php if ($get_data_apl01->status_ktp == 'Tidak Ada') {
                                                echo 'selected';
                                            } ?>>Tidak Ada</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5>#4</h5>
                                    </td>
                                    <td></td>
                                    <td>Bukti Kelengkapan</td>
                                </tr>
                                <tr style="border-bottom:3px solid #111;">
                                    <td valign="top">Pas Foto</td>
                                    <td valign="top">
                                        <a href="<?php echo (!empty($get_data_personal_permohonan[0]['pas_foto'])) ? $get_data_personal_permohonan[0]['pas_foto'] : base_url('errors/not_upload'); ?>"
                                            target="_blank">
                                            <i class="fas fa-fw fa-eye"></i> View File
                                        </a>
                                    </td>
                                    <td valign="top">
                                        <select class="form-control" name="status_pas_foto" required>
                                            <option value="">Pilih Pernyataan</option>
                                            <option <?php if ($get_data_apl01->status_pas_foto == 'Ada (Memenuhi Syarat)') {
                                                echo 'selected';
                                            } ?>>Ada (Memenuhi Syarat)</option>
                                            <option <?php if ($get_data_apl01->status_pas_foto == 'Ada (Tidak Memenuhi Syarat)') {
                                                echo 'selected';
                                            } ?>>Ada (Tidak Memenuhi Syarat)</option>
                                            <option <?php if ($get_data_apl01->status_pas_foto == 'Tidak Ada') {
                                                echo 'selected';
                                            } ?>>Tidak Ada</option>
                                        </select>
                                    </td>
                                </tr>
                            </table>
                            <input type="submit" value="Simpan" class="btn btn-primary mt-3"
                                style="float:right; background-color:#0295da; color:#fff;" />
                        </form>
                    </div>
                    <div class="tab-pane container" id="klasifikasi_kualifikasi">
                        <h5>Klasifikasi & Kualifikasi</h5>
                        <form
                            action="<?= base_url('Admin/insert_klasifikasi_kualifikasi_tinjau_permohonan/') . base64_encode($id_izin); ?>"
                            method="POST">
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                                value="<?= $this->security->get_csrf_hash(); ?>" />

                            <table class="table table-borderless text" width="100%">
                                <tr>
                                    <td width="15%">
                                        <h5>#1</h5>
                                    </td>
                                    <td width="20%" class="text-center">Tidak/Ada</td>
                                    <td width="65%"></td>
                                </tr>
                                <tr>
                                    <td valign="top">Berita Acara VV</td>
                                    <td valign="top" class="text-center">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" value="1" id="5a"
                                                name="berita_acara_vv" <?php
                                                foreach ($get_data_tinjau_permohonan as $data_tinjau_permohonan) {
                                                    if ($data_tinjau_permohonan['item_tinjau_permohonan'] == '5a' && $data_tinjau_permohonan['status'] == '1') {
                                                        echo 'checked';
                                                    }
                                                } ?>>
                                            <label class="custom-control-label" for="5a"></label>
                                        </div>
                                    </td>
                                    <td valign="top">
                                        <input type="text" class="form-control form-control-sm"
                                            name="catatan_berita_acara_vv" placeholder="Catatan..." <?php
                                            foreach ($get_data_tinjau_permohonan as $data_tinjau_permohonan) {
                                                if ($data_tinjau_permohonan['item_tinjau_permohonan'] == '5a') {
                                                    echo 'value="' . $data_tinjau_permohonan['catatan'] . '"';
                                                }
                                            } ?>>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5>#2</h5>
                                    </td>
                                    <td class="text-center">Tidak/Ada</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td valign="top">Surat Permohonan</td>
                                    <td valign="top" class="text-center">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" value="1" id="5b"
                                                name="surat_permohonan" <?php
                                                foreach ($get_data_tinjau_permohonan as $data_tinjau_permohonan) {
                                                    if ($data_tinjau_permohonan['item_tinjau_permohonan'] == '5b' && $data_tinjau_permohonan['status'] == '1') {
                                                        echo 'checked';
                                                    }
                                                } ?>>
                                            <label class="custom-control-label" for="5b"></label>
                                        </div>
                                    </td>
                                    <td valign="top">
                                        <input type="text" class="form-control form-control-sm"
                                            name="catatan_surat_permohonan" placeholder="Catatan..." <?php
                                            foreach ($get_data_tinjau_permohonan as $data_tinjau_permohonan) {
                                                if ($data_tinjau_permohonan['item_tinjau_permohonan'] == '5b') {
                                                    echo 'value="' . $data_tinjau_permohonan['catatan'] . '"';
                                                }
                                            } ?>>
                                    </td>
                                </tr>
                            </table>

                            <table class="table table-borderless text" width="100%">
                                <tr>
                                    <td width="15%">
                                        <h5>#CEKLIS</h5>
                                    </td>
                                    <td width="20%" class="text-center">Tidak/Lengkap</td>
                                    <td width="65%"></td>
                                </tr>
                                <tr style="border-bottom:3px solid #111;">
                                    <td valign="top">Klasifikasi & Kualifikasi</td>
                                    <td valign="top" class="text-center">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" value="1" id="5"
                                                name="ceklis_klasifikasi_kualifikasi" <?php
                                                foreach ($get_data_tinjau_permohonan as $data_tinjau_permohonan) {
                                                    if ($data_tinjau_permohonan['item_tinjau_permohonan'] == '5' && $data_tinjau_permohonan['status'] == '1') {
                                                        echo 'checked';
                                                    }
                                                } ?>>
                                            <label class="custom-control-label" for="5"></label>
                                        </div>
                                    </td>
                                    <td valign="top">
                                        <input type="text" class="form-control form-control-sm"
                                            name="catatan_ceklis_klasifikasi_kualifikasi" placeholder="Catatan..." <?php
                                            foreach ($get_data_tinjau_permohonan as $data_tinjau_permohonan) {
                                                if ($data_tinjau_permohonan['item_tinjau_permohonan'] == '5') {
                                                    echo 'value="' . $data_tinjau_permohonan['catatan'] . '"';
                                                }
                                            } ?>>
                                    </td>
                                </tr>
                            </table>

                            <h5 class="mt-4">Data Klasifikasi & Kualifikasi</h5>
                            <table class="table table-striped text" width="100%">
                                <?php foreach ($get_data_klasifikasi_kualifikasi_permohonan as $data_kk) { ?>
                                    <tr>
                                        <td width="20%" style="font-weight:bold;">Kualifikasi</td>
                                        <td width="2%" align="center">:</td>
                                        <td width="78%"><?php echo $data_kk['deskripsi_kualifikasi'] ?></td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight:bold;">Klasifikasi</td>
                                        <td align="center">:</td>
                                        <td><?php echo $data_kk['klasifikasi'] . " (" . $data_kk['deskripsi_klasifikasi'] . ")" ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight:bold;">Subklasifikasi</td>
                                        <td align="center">:</td>
                                        <td><?php echo $data_kk['subklasifikasi'] . " (" . $data_kk['deskripsi_subklasifikasi'] . ")" ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight:bold;">Jabatan Kerja</td>
                                        <td align="center">:</td>
                                        <td><?php echo $data_kk['jabatan_kerja'] . " (" . $data_kk['deskripsi_jabatan_kerja'] . ")" ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-weight:bold;">Jenis Permohonan</td>
                                        <td align="center">:</td>
                                        <td><?php echo $data_kk['deskripsi_jenis_permohonan'] ?></td>
                                    </tr>
                                <?php } ?>
                            </table>
                            <input type="submit" value="Simpan" class="btn btn-primary mt-3"
                                style="float:right; background-color:#0295da; color:#fff;" />
                        </form>

                        <div class="clearfix"></div>
                        <center class="mt-5">
                            <a href="<?= base_url('admin/hasil_tinjau_permohonan/') . base64_encode($id_izin) ?>"
                                class="btn btn-default" style="background-color:green; color:#fff;">Hasil Tinjau
                                Permohonan</a>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php if ($this->session->flashdata('success')): ?>
        <script>
            swal({
                title: "Berhasil",
                text: "Data Berhasil di Simpan",
                icon: "success",
                button: false,
                timer: 3000,
            });
        </script>
    <?php endif; ?>

    <script>
        var wrapper = document.getElementById("signature-pad"),
            clearButton = wrapper.querySelector("[data-action=clear]"),
            saveButton = wrapper.querySelector("[data-action=save]"),
            canvas = document.getElementById("signature-canvas"),
            signaturePad;

        function resizeCanvas() {
            var ratio = window.devicePixelRatio || 1;
            canvas.width = canvas.offsetWidth * ratio;
            canvas.height = canvas.offsetHeight * ratio;
            canvas.getContext("2d").scale(ratio, ratio);
        }

        // Inisialisasi pad
        signaturePad = new SignaturePad(canvas);

        clearButton.addEventListener("click", function (event) {
            signaturePad.clear();
        });

        saveButton.addEventListener("click", function (event) {
            if (signaturePad.isEmpty()) {
                alert('Tanda tangan masih kosong!');
                return; // Hentikan eksekusi
            }

            // Pindahkan popup confirm ke sini agar AJAX hanya jalan kalau klik OK
            if (confirm('Simpan Signature / TTD ?')) {
                $.ajax({
                    type: "POST",
                    url: "<?= base_url(); ?>admin/insert_signature_peninjau_apl01/<?= base64_encode($get_data_apl01->id_izin) ?>",
                    data: {
                        'image': signaturePad.toDataURL(),
                        'rowno': $('#rowno').val(),
                        '<?= $this->security->get_csrf_token_name(); ?>': '<?= $this->security->get_csrf_hash(); ?>'
                    },
                    success: function (datas1) {
                        top.location.href = "<?= base_url('admin/tinjau_permohonan/') . base64_encode($get_data_apl01->id_izin) ?>";
                    },
                    error: function (xhr, status, error) {
                        // Berfungsi mendeteksi jika ada error 403 (CSRF expired) atau error 500 (Server crash)
                        alert("Gagal menyimpan TTD. Status: " + xhr.status);
                        console.error(xhr.responseText);
                    }
                });
            }
        }); 
    </script>
</body>

</html>