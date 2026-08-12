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

    <style>
        .table-valign-middle td,
        .table-valign-middle th {
            vertical-align: middle !important;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container-fluid py-4">
        <h3 class="m-0 font-weight-bold text-dark">Tinjau Permohonan</h3>
        <div class="row mb-4">
            <div class="col-12">
                <div class="mt-5 border rounded p-4 bg-white shadow-sm">
                    <h6 class="font-weight-bold text-primary border-bottom pb-2 mb-3">
                        <i class="fas fa-address-card text-primary mr-2"></i> Info Data Permohonan
                    </h6>
                    <table class="table table-sm table-borderless m-0">
                        <tr>
                            <td width="15%" class="font-weight-bold p-1">Nama</td>
                            <td width="2%" class="p-1">:</td>
                            <td class="p-1"><?= $get_data_personal_permohonan[0]['nama']; ?></td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold p-1">NIK</td>
                            <td class="p-1">:</td>
                            <td class="p-1"><?= $get_data_personal_permohonan[0]['nik']; ?></td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold p-1">Kualifikasi</td>
                            <td class="p-1">:</td>
                            <td class="p-1">
                                <?= $info_data_permohonan->kualifikasi . ' (' . $info_data_permohonan->deskripsi_kualifikasi . ')'; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold p-1">Jabatan Kerja</td>
                            <td class="p-1">:</td>
                            <td class="p-1">
                                <?= $info_data_permohonan->jabatan_kerja . ' (' . $info_data_permohonan->deskripsi_jabatan_kerja . ')'; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold p-1">Jenjang</td>
                            <td class="p-1">:</td>
                            <td class="p-1"><?= $info_data_permohonan->jenjang; ?></td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold p-1">Jenis Permohonan</td>
                            <td class="p-1">:</td>
                            <td class="p-1"><?= $info_data_permohonan->deskripsi_jenis_permohonan; ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="card card-nav-tabs header-primary shadow-sm mb-4 border-0">
        <div class="card-header card-header-hitam">
            <div class="nav-tabs-navigation">
                <div class="nav-tabs-wrapper">
                    <ul class="nav nav-tabs" data-tabs="tabs">
                        <li class="nav-item">
                            <a class="nav-link active font-weight-bold" href="#administrasi" data-toggle="tab">
                                <i class="material-icons">face</i> Administrasi
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link font-weight-bold" href="#pendidikan" data-toggle="tab">
                                <i class="material-icons">school</i> Pendidikan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link font-weight-bold" href="#proyek" data-toggle="tab">
                                <i class="material-icons">work</i> Proyek
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link font-weight-bold" href="#pelatihan" data-toggle="tab">
                                <i class="material-icons">model_training</i> Pelatihan
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link font-weight-bold" href="#apl01" data-toggle="tab">
                                <i class="material-icons">description</i> Apl 01
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link font-weight-bold" href="#klasifikasi_kualifikasi" data-toggle="tab">
                                <i class="material-icons">build</i> Klasifikasi & Kualifikasi
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="card-body bg-white p-4">
            <div class="tab-content">

                <div class="tab-pane active container-fluid px-0" id="administrasi">
                    <h5 class="font-weight-bold text-primary border-bottom pb-2 mb-3">Tinjauan Administrasi
                        Personal
                    </h5>
                    <form
                        action="<?= base_url('Admin/insert_administrasi_tinjau_permohonan/') . base64_encode($id_izin); ?>"
                        method="POST">
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                            value="<?= $this->security->get_csrf_hash(); ?>" />

                        <div class="table-responsive">
                            <table class="table table-hover table-valign-middle text-dark w-100">
                                <thead class="bg-light text-secondary">
                                    <tr>
                                        <th width="5%" class="text-center">#</th>
                                        <th width="30%">Nama Dokumen</th>
                                        <th width="15%" class="text-center">Tidak/Ada</th>
                                        <th width="15%" class="text-center">File</th>
                                        <th width="35%">Catatan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center font-weight-bold">1</td>
                                        <td>File KTP</td>
                                        <td class="text-center">
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
                                        <td class="text-center">
                                            <a href="<?php echo (!empty($get_data_personal_permohonan[0]['ktp'])) ? $get_data_personal_permohonan[0]['ktp'] : base_url('errors/not_upload'); ?>"
                                                target="_blank" class="btn btn-outline-info btn-sm shadow-sm">
                                                <i class="fas fa-fw fa-eye"></i> View
                                            </a>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="catatan_ktp"
                                                placeholder="Tambahkan catatan..." <?php foreach ($get_data_tinjau_permohonan as $data_tinjau_permohonan) {
                                                    if ($data_tinjau_permohonan['item_tinjau_permohonan'] == '1a') {
                                                        echo 'value="' . $data_tinjau_permohonan['catatan'] . '"';
                                                    }
                                                } ?>>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center font-weight-bold">2</td>
                                        <td>Surat Pernyataan Kebenaran Data</td>
                                        <td class="text-center">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" value="1" id="1b"
                                                    name="pernyataan_kebenaran_data" <?php foreach ($get_data_tinjau_permohonan as $data_tinjau_permohonan) {
                                                        if ($data_tinjau_permohonan['item_tinjau_permohonan'] == '1b' && $data_tinjau_permohonan['status'] == '1') {
                                                            echo 'checked';
                                                        }
                                                    } ?>>
                                                <label class="custom-control-label" for="1b"></label>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <a href="<?php echo (!empty($get_data_personal_permohonan[0]['surat_pernyataan_kebenaran_data'])) ? $get_data_personal_permohonan[0]['surat_pernyataan_kebenaran_data'] : base_url('errors/not_upload'); ?>"
                                                target="_blank" class="btn btn-outline-info btn-sm shadow-sm">
                                                <i class="fas fa-fw fa-eye"></i> View
                                            </a>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control"
                                                name="catatan_pernyataan_kebenaran_data"
                                                placeholder="Tambahkan catatan..." <?php foreach ($get_data_tinjau_permohonan as $data_tinjau_permohonan) {
                                                    if ($data_tinjau_permohonan['item_tinjau_permohonan'] == '1b') {
                                                        echo 'value="' . $data_tinjau_permohonan['catatan'] . '"';
                                                    }
                                                } ?>>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center font-weight-bold">3</td>
                                        <td>File NPWP</td>
                                        <td class="text-center">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" value="1" id="1c"
                                                    name="npwp" <?php foreach ($get_data_tinjau_permohonan as $data_tinjau_permohonan) {
                                                        if ($data_tinjau_permohonan['item_tinjau_permohonan'] == '1c' && $data_tinjau_permohonan['status'] == '1') {
                                                            echo 'checked';
                                                        }
                                                    } ?>>
                                                <label class="custom-control-label" for="1c"></label>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <a href="<?php echo (!empty($get_data_personal_permohonan[0]['file_npwp'])) ? $get_data_personal_permohonan[0]['file_npwp'] : base_url('errors/not_upload'); ?>"
                                                target="_blank" class="btn btn-outline-info btn-sm shadow-sm">
                                                <i class="fas fa-fw fa-eye"></i> View
                                            </a>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="catatan_npwp"
                                                placeholder="Tambahkan catatan..." <?php foreach ($get_data_tinjau_permohonan as $data_tinjau_permohonan) {
                                                    if ($data_tinjau_permohonan['item_tinjau_permohonan'] == '1c') {
                                                        echo 'value="' . $data_tinjau_permohonan['catatan'] . '"';
                                                    }
                                                } ?>>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom border-dark">
                                        <td class="text-center font-weight-bold">4</td>
                                        <td>Pas Foto</td>
                                        <td class="text-center">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" value="1" id="1d"
                                                    name="pas_foto" <?php foreach ($get_data_tinjau_permohonan as $data_tinjau_permohonan) {
                                                        if ($data_tinjau_permohonan['item_tinjau_permohonan'] == '1d' && $data_tinjau_permohonan['status'] == '1') {
                                                            echo 'checked';
                                                        }
                                                    } ?>>
                                                <label class="custom-control-label" for="1d"></label>
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <a href="<?php echo (!empty($get_data_personal_permohonan[0]['pas_foto'])) ? $get_data_personal_permohonan[0]['pas_foto'] : base_url('errors/not_upload'); ?>"
                                                target="_blank" class="btn btn-outline-info btn-sm shadow-sm">
                                                <i class="fas fa-fw fa-eye"></i> View
                                            </a>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="catatan_pas_foto"
                                                placeholder="Tambahkan catatan..." <?php foreach ($get_data_tinjau_permohonan as $data_tinjau_permohonan) {
                                                    if ($data_tinjau_permohonan['item_tinjau_permohonan'] == '1d') {
                                                        echo 'value="' . $data_tinjau_permohonan['catatan'] . '"';
                                                    }
                                                } ?>>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="table-responsive mt-3">
                            <table class="table table-borderless table-valign-middle w-100 bg-light rounded p-3">
                                <tr>
                                    <td width="5%" class="text-center font-weight-bold text-success"><i
                                            class="fas fa-check-square fa-lg"></i></td>
                                    <td width="30%" class="font-weight-bold text-uppercase">Ceklis Administrasi
                                    </td>
                                    <td width="15%" class="text-center">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" value="1" id="1"
                                                name="ceklis_administrasi" <?php foreach ($get_data_tinjau_permohonan as $data_tinjau_permohonan) {
                                                    if ($data_tinjau_permohonan['item_tinjau_permohonan'] == '1' && $data_tinjau_permohonan['status'] == '1') {
                                                        echo 'checked';
                                                    }
                                                } ?>>
                                            <label class="custom-control-label font-weight-bold" for="1">Lengkap</label>
                                        </div>
                                    </td>
                                    <td width="50%">
                                        <input type="text" class="form-control" name="catatan_ceklis_administrasi"
                                            placeholder="Catatan Kesimpulan Administrasi..." <?php foreach ($get_data_tinjau_permohonan as $data_tinjau_permohonan) {
                                                if ($data_tinjau_permohonan['item_tinjau_permohonan'] == '1') {
                                                    echo 'value="' . $data_tinjau_permohonan['catatan'] . '"';
                                                }
                                            } ?>>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div class="mt-5 border rounded p-4 bg-white shadow-sm">
                            <h6 class="font-weight-bold text-dark border-bottom pb-2 mb-3"><i
                                    class="fas fa-address-card text-secondary mr-2"></i>Detail Data Administrasi
                                Pemohon</h6>
                            <table class="table table-striped table-sm text-dark m-0 w-100">
                                <tr>
                                    <td width="25%" class="font-weight-bold">Nama</td>
                                    <td width="2%">:</td>
                                    <td><?php echo $get_data_personal_permohonan[0]['nama'] ?></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">NIK</td>
                                    <td>:</td>
                                    <td><?php echo $get_data_personal_permohonan[0]['nik'] ?></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Email</td>
                                    <td>:</td>
                                    <td><?php echo $get_data_personal_permohonan[0]['email'] ?></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Telepon</td>
                                    <td>:</td>
                                    <td><?php echo $get_data_personal_permohonan[0]['telepon'] ?></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Alamat</td>
                                    <td>:</td>
                                    <td><?php echo $get_data_personal_permohonan[0]['alamat'] ?></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Propinsi</td>
                                    <td>:</td>
                                    <td><?= $get_data_personal_permohonan[0]['deskripsi_propinsi']; ?></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Kota/Kabupaten</td>
                                    <td>:</td>
                                    <td><?= $get_data_personal_permohonan[0]['deskripsi_kabupaten']; ?></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Kode Pos</td>
                                    <td>:</td>
                                    <td><?php echo $get_data_personal_permohonan[0]['kodepos'] ?></td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Tempat, Tanggal Lahir</td>
                                    <td>:</td>
                                    <td><?php echo $get_data_personal_permohonan[0]['tempat_lahir'] . ', ' . $get_data_personal_permohonan[0]['tanggal_lahir'] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Jenis Kelamin</td>
                                    <td>:</td>
                                    <td><?php echo $get_data_personal_permohonan[0]['jenis_kelamin'] ?></td>
                                </tr>
                            </table>
                        </div>

                        <div class="mt-4 text-right">
                            <input type="submit" value="Simpan Administrasi" class="btn btn-primary px-4 shadow-sm" />
                        </div>
                    </form>
                </div>

                <div class="tab-pane container-fluid px-0" id="pendidikan">
                    <h5 class="font-weight-bold text-primary border-bottom pb-2 mb-3">Tinjauan Pendidikan</h5>
                    <div class="table-responsive mb-4">
                        <table class="table table-bordered table-hover text-dark w-100 table-valign-middle">
                            <thead class="bg-light text-center">
                                <tr>
                                    <th width="10%">Jenjang</th>
                                    <th width="20%">Nama Perguruan</th>
                                    <th width="20%">Program Studi</th>
                                    <th width="10%">Tahun Lulus</th>
                                    <th width="20%">Scan Ijazah</th>
                                    <th width="20%">Surat Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($get_data_pendidikan_permohonan as $data_pendidikan) { ?>
                                    <tr>
                                        <td class="text-center font-weight-bold">
                                            <?= $data_pendidikan['deskripsi_jenjang']; ?>
                                        </td>
                                        <td><?php echo $data_pendidikan['nama_sekolah_perguruan_tinggi']; ?></td>
                                        <td class="text-center"><?php echo $data_pendidikan['program_studi']; ?>
                                        </td>
                                        <td class="text-center"><?php echo $data_pendidikan['tahun_lulus']; ?></td>
                                        <td class="text-center">
                                            <a href="<?php echo (!empty($data_pendidikan['scan_ijazah_legalisir'])) ? $data_pendidikan['scan_ijazah_legalisir'] : base_url('errors/not_upload'); ?>"
                                                target="_blank" class="btn btn-outline-info btn-sm shadow-sm">
                                                <i class="fas fa-fw fa-eye"></i> View File
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <a href="<?php echo (!empty($data_pendidikan['scan_surat_keterangan'])) ? $data_pendidikan['scan_surat_keterangan'] : base_url('errors/not_upload'); ?>"
                                                target="_blank" class="btn btn-outline-info btn-sm shadow-sm">
                                                <i class="fas fa-fw fa-eye"></i> View File
                                            </a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                    <hr class="my-4" />

                    <form
                        action="<?= base_url('Admin/insert_pendidikan_tinjau_permohonan/') . base64_encode($id_izin); ?>"
                        method="POST">
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                            value="<?= $this->security->get_csrf_hash(); ?>" />

                        <div class="form-group mb-4 bg-light p-3 border rounded">
                            <label class="font-weight-bold text-dark"><i
                                    class="fas fa-check-circle text-success mr-1"></i> Pilih Jenjang Pendidikan
                                Terakhir yang Sesuai dengan Kompetensi Permohonan</label>
                            <select class="custom-select border-primary" name="jenjang_yang_sesuai" required>
                                <option value=''>-- Pilih Jenjang --</option>
                                <?php foreach ($get_data_pendidikan_permohonan as $data_pendidikan) { ?>
                                    <option value="<?= $data_pendidikan['id'] ?>" <?php if (!empty($data_pendidikan_yang_sudah_dipilih->jenjang_yang_sesuai) && $data_pendidikan_yang_sudah_dipilih->jenjang_yang_sesuai == $data_pendidikan['id']) {
                                          echo 'selected';
                                      } ?>>
                                        <?= $data_pendidikan['deskripsi_jenjang'] . ' (' . $data_pendidikan['nama_sekolah_perguruan_tinggi'] . ' - ' . $data_pendidikan['program_studi'] . ")" ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover table-valign-middle text-dark w-100">
                                <thead class="bg-light text-secondary">
                                    <tr>
                                        <th width="5%" class="text-center">#</th>
                                        <th width="30%">Nama Dokumen</th>
                                        <th width="15%" class="text-center">Tidak/Ada</th>
                                        <th width="50%">Catatan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center font-weight-bold">1</td>
                                        <td>Scan Ijazah Legalisir</td>
                                        <td class="text-center">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" value="1" id="2a"
                                                    name="scan_ijazah_legalisir" <?php foreach ($get_data_tinjau_permohonan as $data_tinjau_permohonan) {
                                                        if ($data_tinjau_permohonan['item_tinjau_permohonan'] == '2a' && $data_tinjau_permohonan['status'] == '1') {
                                                            echo 'checked';
                                                        }
                                                    } ?>>
                                                <label class="custom-control-label" for="2a"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="catatan_scan_ijazah_legalisir"
                                                placeholder="Tambahkan catatan..." <?php foreach ($get_data_tinjau_permohonan as $data_tinjau_permohonan) {
                                                    if ($data_tinjau_permohonan['item_tinjau_permohonan'] == '2a') {
                                                        echo 'value="' . $data_tinjau_permohonan['catatan'] . '"';
                                                    }
                                                } ?>>
                                        </td>
                                    </tr>
                                    <tr class="border-bottom border-dark">
                                        <td class="text-center font-weight-bold">2</td>
                                        <td>Scan Surat Keterangan</td>
                                        <td class="text-center">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" value="1" id="2b"
                                                    name="scan_surat_keterangan_pendidikan" <?php foreach ($get_data_tinjau_permohonan as $data_tinjau_permohonan) {
                                                        if ($data_tinjau_permohonan['item_tinjau_permohonan'] == '2b' && $data_tinjau_permohonan['status'] == '1') {
                                                            echo 'checked';
                                                        }
                                                    } ?>>
                                                <label class="custom-control-label" for="2b"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control"
                                                name="catatan_scan_surat_keterangan_pendidikan"
                                                placeholder="Tambahkan catatan...">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="table-responsive mt-3">
                            <table class="table table-borderless table-valign-middle w-100 bg-light rounded p-3">
                                <tr>
                                    <td width="5%" class="text-center font-weight-bold text-success"><i
                                            class="fas fa-check-square fa-lg"></i></td>
                                    <td width="30%" class="font-weight-bold text-uppercase">Ceklis Pendidikan
                                    </td>
                                    <td width="15%" class="text-center">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" value="1" id="2"
                                                name="ceklis_pendidikan" <?php foreach ($get_data_tinjau_permohonan as $data_tinjau_permohonan) {
                                                    if ($data_tinjau_permohonan['item_tinjau_permohonan'] == '2' && $data_tinjau_permohonan['status'] == '1') {
                                                        echo 'checked';
                                                    }
                                                } ?>>
                                            <label class="custom-control-label font-weight-bold" for="2">Lengkap</label>
                                        </div>
                                    </td>
                                    <td width="50%">
                                        <input type="text" class="form-control" name="catatan_ceklis_pendidikan"
                                            placeholder="Catatan Kesimpulan Pendidikan..." <?php foreach ($get_data_tinjau_permohonan as $data_tinjau_permohonan) {
                                                if ($data_tinjau_permohonan['item_tinjau_permohonan'] == '2') {
                                                    echo 'value="' . $data_tinjau_permohonan['catatan'] . '"';
                                                }
                                            } ?>>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div class="mt-4 text-right">
                            <input type="submit" value="Simpan Pendidikan" class="btn btn-primary px-4 shadow-sm" />
                        </div>
                    </form>
                </div>

                <div class="tab-pane container-fluid px-0" id="proyek">
                    <h5 class="font-weight-bold text-primary border-bottom pb-2 mb-3">Tinjauan Proyek</h5>
                    <form action="<?= base_url('Admin/insert_proyek_tinjau_permohonan/') . base64_encode($id_izin); ?>"
                        method="POST">
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                            value="<?= $this->security->get_csrf_hash(); ?>" />
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover text-dark w-100 table-valign-middle">
                                <thead class="bg-light text-center">
                                    <tr>
                                        <th width="3%">No</th>
                                        <th width="15%">Nama Proyek</th>
                                        <th width="10%">Jabatan</th>
                                        <th width="12%">Nilai Proyek</th>
                                        <th width="15%">Lama Proyek</th>
                                        <th width="15%">Surat Referensi</th>
                                        <th width="15%">Catatan</th>
                                        <th width="15%">Jenis Pengalaman</th>
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
                                            <td class="font-weight-bold text-primary">
                                                <?php echo $data_proyek['nama_proyek']; ?>
                                            </td>
                                            <td class="text-center"><?php echo $data_proyek['jabatan']; ?></td>
                                            <td class="text-right text-success font-weight-bold">
                                                <?= (!empty($data_proyek['nilai_proyek'])) ? 'Rp ' . number_format($data_proyek['nilai_proyek'], 0, ',', '.') : '0'; ?>
                                            </td>
                                            <td class="text-center">
                                                <?= $hari->format("%a") . ' hari<br><small class="text-muted">( ' . $bulan . ' bulan )</small>'; ?>
                                            </td>
                                            <td class="text-center">
                                                <a href="<?php echo (!empty($data_proyek['surat_referensi'])) ? $data_proyek['surat_referensi'] : base_url('errors/not_upload'); ?>"
                                                    target="_blank"
                                                    class="btn btn-outline-info btn-sm mb-2 shadow-sm d-block">
                                                    <i class="fas fa-fw fa-eye"></i> View
                                                </a>
                                                <div class="custom-control custom-switch d-inline-block">
                                                    <input type="checkbox" class="custom-control-input" value="1"
                                                        id="3a<?= $i; ?>" name="surat_referensi_proyek[<?= $i; ?>]" <?php foreach ($get_data_tinjau_permohonan as $data_tinjau_permohonan) {
                                                                if ($data_tinjau_permohonan['item_tinjau_permohonan'] == '3a' . $i && $data_tinjau_permohonan['status'] == '1') {
                                                                    echo 'checked';
                                                                }
                                                            } ?>>
                                                    <label class="custom-control-label" for="3a<?= $i; ?>"></label>
                                                </div>
                                                <input type="hidden" name="kode_item[<?= $i; ?>]" value="3a<?= $i; ?>" />
                                                <input type="hidden" name="id_proyek[<?= $i; ?>]"
                                                    value="<?= $data_proyek['id']; ?>" />
                                            </td>
                                            <td>
                                                <textarea rows="2" class="form-control"
                                                    name="catatan_surat_referensi_proyek[<?= $i; ?>]"
                                                    placeholder="Catatan..."><?php foreach ($get_data_tinjau_permohonan as $data_tinjau_permohonan) {
                                                        if ($data_tinjau_permohonan['item_tinjau_permohonan'] == '3a' . $i) {
                                                            echo $data_tinjau_permohonan['catatan'];
                                                        }
                                                    } ?></textarea>
                                            </td>
                                            <td class="text-center"><span
                                                    class="badge badge-secondary p-2"><?php echo $data_proyek['jenis_pengalaman']; ?></span>
                                            </td>
                                        </tr>
                                        <?php $i++;
                                    } ?>
                                    <input type="hidden" name="count" value="<?php echo $i; ?>" />

                                    <tr class="bg-light">
                                        <td class="text-right text-uppercase font-weight-bold" colspan="3">Total
                                        </td>
                                        <td class="text-right text-success font-weight-bold">
                                            <?php
                                            $sum_nilai_proyek = 0;
                                            foreach ($get_data_proyek_permohonan as $data_proyek) {
                                                $sum_nilai_proyek += (!empty($data_proyek['nilai_proyek'])) ? $data_proyek['nilai_proyek'] : 0;
                                            }
                                            echo 'Rp ' . number_format($sum_nilai_proyek, 0, ',', '.');
                                            ?>
                                        </td>
                                        <td class="text-center font-weight-bold text-info">
                                            <?php
                                            $sum_hari = 0;
                                            foreach ($get_data_proyek_permohonan as $data_proyek) {
                                                $d = (new DateTime($data_proyek['tanggal_akhir']))->diff(new DateTime($data_proyek['tanggal_awal']));
                                                $sum_hari += $d->format("%a");
                                            }
                                            echo $sum_hari . ' hari<br><small class="text-dark">( ' . floor($sum_hari / 30) . ' bulan )</small>';
                                            ?>
                                        </td>
                                        <td colspan="3"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="table-responsive mt-3">
                            <table class="table table-borderless table-valign-middle w-100 bg-light rounded p-3">
                                <tr>
                                    <td width="5%" class="text-center font-weight-bold text-success"><i
                                            class="fas fa-check-square fa-lg"></i></td>
                                    <td width="30%" class="font-weight-bold text-uppercase">Ceklis Proyek</td>
                                    <td width="15%" class="text-center">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" value="1" id="3"
                                                name="ceklis_proyek" <?php foreach ($get_data_tinjau_permohonan as $data_tinjau_permohonan) {
                                                    if ($data_tinjau_permohonan['item_tinjau_permohonan'] == '3' && $data_tinjau_permohonan['status'] == '1') {
                                                        echo 'checked';
                                                    }
                                                } ?>>
                                            <label class="custom-control-label font-weight-bold" for="3">Lengkap</label>
                                        </div>
                                    </td>
                                    <td width="50%">
                                        <input type="text" class="form-control" name="catatan_ceklis_proyek"
                                            placeholder="Catatan Kesimpulan Proyek..." <?php foreach ($get_data_tinjau_permohonan as $data_tinjau_permohonan) {
                                                if ($data_tinjau_permohonan['item_tinjau_permohonan'] == '3') {
                                                    echo 'value="' . $data_tinjau_permohonan['catatan'] . '"';
                                                }
                                            } ?>>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div class="mt-4 text-right">
                            <input type="submit" name="submit" value="Simpan Proyek"
                                class="btn btn-primary px-4 shadow-sm" />
                        </div>
                    </form>

                    <hr class="my-5 border-secondary" />

                    <div class="row bg-white border rounded shadow-sm p-4 mx-1">
                        <div class="col-md-6 border-right">
                            <h6 class="font-weight-bold text-dark"><i class="fas fa-signature mr-2"></i>Area
                                Tanda
                                Tangan Peninjau</h6>
                            <p class="text-muted small">Catatan: Signature / TTD di bawah ini akan digunakan
                                untuk keperluan Tanda Tangan pada Form Apl 01 dan Apl 02.
                            </p>

                            <div class="boxarea mt-3">
                                <div class="signature-pad" id="signature-pad">
                                    <div class="m-signature-pad border rounded bg-light"
                                        style="border: 2px dashed #ccc !important;">
                                        <div class="m-signature-pad-body text-center">
                                            <canvas id="signature-canvas" width="450" height="200"
                                                style="touch-action: none; cursor: crosshair;"></canvas>
                                        </div>
                                    </div>
                                    <div class="m-signature-pad-footer mt-3 text-right">
                                        <button type="button" data-action="clear"
                                            class="btn btn-outline-danger btn-sm shadow-sm mr-2">
                                            <i class="fa fa-trash-o"></i> Clear
                                        </button>
                                        <button type="button" id="save2" data-action="save"
                                            class="btn btn-success btn-sm shadow-sm">
                                            <i class="fa fa-check"></i> Save TTD
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" value="<?php echo rand(); ?>" id="rowno">
                        </div>
                        <div class="col-md-6 d-flex align-items-center justify-content-center flex-column">
                            <h6 class="font-weight-bold text-dark mb-3">Preview TTD Saat Ini:</h6>
                            <?php if ($get_data_apl01->ttd_peninjau == NULL) {
                                echo "<div class='alert alert-warning text-center w-100'><i class='fas fa-exclamation-triangle mr-2'></i>Belum di Tanda Tangani untuk Keperluan Apl-01, Silahkan Tanda Tangani terlebih dahulu!</div>";
                            } else {
                                echo "<img class='img-fluid border rounded shadow-sm' src='" . base_url('uploads/file_permohonan/ttd_admin_apl01/') . $get_data_apl01->ttd_peninjau . "' style='max-height: 180px;'/>";
                            } ?>
                        </div>
                    </div>
                </div>

                <div class="tab-pane container-fluid px-0" id="pelatihan">
                    <h5 class="font-weight-bold text-primary border-bottom pb-2 mb-3">Tinjauan Pelatihan</h5>
                    <form
                        action="<?= base_url('Admin/insert_pelatihan_tinjau_permohonan/') . base64_encode($id_izin); ?>"
                        method="POST">
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                            value="<?= $this->security->get_csrf_hash(); ?>" />

                        <div class="table-responsive mb-4">
                            <table class="table table-borderless table-valign-middle w-100 bg-light rounded p-3">
                                <tr>
                                    <td width="5%" class="text-center font-weight-bold text-success"><i
                                            class="fas fa-check-square fa-lg"></i></td>
                                    <td width="30%" class="font-weight-bold text-uppercase">Ceklis Pelatihan
                                    </td>
                                    <td width="15%" class="text-center">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" value="1" id="4"
                                                name="ceklis_pelatihan" <?php foreach ($get_data_tinjau_permohonan as $data_tinjau_permohonan) {
                                                    if ($data_tinjau_permohonan['item_tinjau_permohonan'] == '4' && $data_tinjau_permohonan['status'] == '1') {
                                                        echo 'checked';
                                                    }
                                                } ?>>
                                            <label class="custom-control-label font-weight-bold" for="4">Lengkap</label>
                                        </div>
                                    </td>
                                    <td width="50%">
                                        <input type="text" class="form-control" name="catatan_ceklis_pelatihan"
                                            placeholder="Catatan Kesimpulan Pelatihan..." <?php foreach ($get_data_tinjau_permohonan as $data_tinjau_permohonan) {
                                                if ($data_tinjau_permohonan['item_tinjau_permohonan'] == '4') {
                                                    echo 'value="' . $data_tinjau_permohonan['catatan'] . '"';
                                                }
                                            } ?>>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <p class="text-muted"><i class="fas fa-user mr-1"></i> Data Pelatihan
                            <strong><?php echo $get_data_personal_permohonan[0]['nama'] ?></strong>
                        </p>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover text-dark w-100 table-valign-middle">
                                <thead class="bg-light text-center">
                                    <tr>
                                        <th width="5%">No</th>
                                        <th width="25%">Penyelenggara</th>
                                        <th width="30%">Nama Pelatihan</th>
                                        <th width="10%">Jumlah JP</th>
                                        <th width="15%">Lama Pelatihan</th>
                                        <th width="15%">File Sertifikat</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($get_data_pelatihan_permohonan as $data_pelatihan) { ?>
                                        <tr>
                                            <td class="text-center"><?php echo $no++; ?></td>
                                            <td><?php echo $data_pelatihan['penyelenggara']; ?></td>
                                            <td class="font-weight-bold text-primary">
                                                <?php echo $data_pelatihan['nama_pelatihan']; ?>
                                            </td>
                                            <td class="text-center"><span
                                                    class="badge badge-info p-2"><?php echo $data_pelatihan['jumlah_jp']; ?>
                                                    JP</span></td>
                                            <td class="text-center">
                                                <?php echo $data_pelatihan['jumlah_hari'] . ' Hari'; ?>
                                            </td>
                                            <td class="text-center">
                                                <a href="<?php echo (!empty($data_pelatihan['file_sertifikat'])) ? $data_pelatihan['file_sertifikat'] : base_url('errors/not_upload'); ?>"
                                                    target="_blank" class="btn btn-outline-info btn-sm shadow-sm">
                                                    <i class="fas fa-fw fa-eye"></i> View File
                                                </a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4 text-right">
                            <input type="submit" value="Simpan Pelatihan" class="btn btn-primary px-4 shadow-sm" />
                        </div>
                    </form>
                </div>

                <div class="tab-pane container-fluid px-0" id="apl01">
                    <h5 class="font-weight-bold text-primary border-bottom pb-2 mb-3">Keperluan Form APL 01</h5>
                    <form action="<?= base_url('Admin/insert_apl01_tinjau_permohonan/') . base64_encode($id_izin) ?>"
                        method="POST">
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                            value="<?= $this->security->get_csrf_hash(); ?>" />

                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="card shadow-sm h-100">
                                    <div class="card-body">
                                        <h6 class="font-weight-bold"><span class="badge badge-primary mr-2">1</span>
                                            Tujuan Asesmen</h6>
                                        <hr>
                                        <div class="form-group mb-0">
                                            <label class="text-muted">Pilih Tujuan:</label>
                                            <select class="custom-select" name="tujuan_asesment">
                                                <option <?php if ($get_data_apl01->tujuan_asesment == 'Sertifikasi') {
                                                    echo 'selected';
                                                } ?>>Sertifikasi</option>
                                                <option <?php if ($get_data_apl01->tujuan_asesment == 'Sertifikasi Ulang') {
                                                    echo 'selected';
                                                } ?>>Sertifikasi Ulang</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="card shadow-sm h-100">
                                    <div class="card-body">
                                        <h6 class="font-weight-bold"><span class="badge badge-primary mr-2">2</span>
                                            Persyaratan Kompetensi</h6>
                                        <hr>
                                        <div class="form-group mb-3">
                                            <label class="text-muted">Bukti Kelengkapan Pemohon:</label>
                                            <select class="custom-select" name="id_persyaratan_kompeten" required>
                                                <?php foreach ($option_persyaratan_kompetensi_apl01 as $option_persyaratan_kompetensi) { ?>
                                                    <option
                                                        value="<?php echo $option_persyaratan_kompetensi['id_persyaratan_kompeten']; ?>"
                                                        <?php if ($option_persyaratan_kompetensi['id_persyaratan_kompeten'] == $get_data_apl01->id_persyaratan_kompeten) {
                                                            echo 'selected';
                                                        } ?>>
                                                        <?php echo $option_persyaratan_kompetensi['persyaratan_pendidikan'] . ' (Pengalaman ' . $option_persyaratan_kompetensi['persyaratan_pengalaman_proyek'] . ')'; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group mb-0">
                                            <label class="text-muted">Nilai Persyaratan:</label>
                                            <select class="custom-select" name="status_persyaratan_kompeten" required>
                                                <option value="">-- Pilih Pernyataan --</option>
                                                <option <?php if ($get_data_apl01->status_persyaratan_kompeten == 'Ada (Memenuhi Syarat)') {
                                                    echo 'selected';
                                                } ?>>Ada (Memenuhi
                                                    Syarat)</option>
                                                <option <?php if ($get_data_apl01->status_persyaratan_kompeten == 'Ada (Tidak Memenuhi Syarat)') {
                                                    echo 'selected';
                                                } ?>>Ada (Tidak
                                                    Memenuhi Syarat)</option>
                                                <option <?php if ($get_data_apl01->status_persyaratan_kompeten == 'Tidak Ada') {
                                                    echo 'selected';
                                                } ?>> Tidak Ada</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card shadow-sm mb-4">
                            <div class="card-body">
                                <h6 class="font-weight-bold"><span class="badge badge-primary mr-2">3 & 4</span>
                                    Bukti Kelengkapan Dasar</h6>
                                <hr>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-valign-middle text-dark w-100">
                                        <thead class="bg-light">
                                            <tr>
                                                <th width="30%">Dokumen Dasar</th>
                                                <th width="20%" class="text-center">File</th>
                                                <th width="50%">Kesimpulan Kelengkapan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="font-weight-bold">File KTP</td>
                                                <td class="text-center">
                                                    <a href="<?php echo (!empty($get_data_personal_permohonan[0]['ktp'])) ? $get_data_personal_permohonan[0]['ktp'] : base_url('errors/not_upload'); ?>"
                                                        target="_blank" class="btn btn-outline-info btn-sm shadow-sm">
                                                        <i class="fas fa-fw fa-eye"></i> View File
                                                    </a>
                                                </td>
                                                <td>
                                                    <select class="custom-select custom-select-sm" name="status_ktp"
                                                        required>
                                                        <option value="">-- Pilih Pernyataan --</option>
                                                        <option <?php if ($get_data_apl01->status_ktp == 'Ada (Memenuhi Syarat)') {
                                                            echo 'selected';
                                                        } ?>>Ada
                                                            (Memenuhi Syarat)</option>
                                                        <option <?php if ($get_data_apl01->status_ktp == 'Ada (Tidak Memenuhi Syarat)') {
                                                            echo 'selected';
                                                        } ?>>
                                                            Ada (Tidak
                                                            Memenuhi Syarat)</option>
                                                        <option <?php if ($get_data_apl01->status_ktp == 'Tidak Ada') {
                                                            echo 'selected';
                                                        } ?>>Tidak Ada</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="font-weight-bold">Pas Foto</td>
                                                <td class="text-center">
                                                    <a href="<?php echo (!empty($get_data_personal_permohonan[0]['pas_foto'])) ? $get_data_personal_permohonan[0]['pas_foto'] : base_url('errors/not_upload'); ?>"
                                                        target="_blank" class="btn btn-outline-info btn-sm shadow-sm">
                                                        <i class="fas fa-fw fa-eye"></i> View File
                                                    </a>
                                                </td>
                                                <td>
                                                    <select class="custom-select custom-select-sm"
                                                        name="status_pas_foto" required>
                                                        <option value="">-- Pilih Pernyataan --</option>
                                                        <option <?php if ($get_data_apl01->status_pas_foto == 'Ada (Memenuhi Syarat)') {
                                                            echo 'selected';
                                                        } ?>>Ada
                                                            (Memenuhi Syarat)</option>
                                                        <option <?php if ($get_data_apl01->status_pas_foto == 'Ada (Tidak Memenuhi Syarat)') {
                                                            echo 'selected';
                                                        } ?>>
                                                            Ada
                                                            (Tidak Memenuhi Syarat)</option>
                                                        <option <?php if ($get_data_apl01->status_pas_foto == 'Tidak Ada') {
                                                            echo 'selected';
                                                        } ?>>Tidak Ada</option>
                                                    </select>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="text-right">
                            <input type="submit" value="Simpan APL 01" class="btn btn-primary px-4 shadow-sm" />
                        </div>
                    </form>
                </div>

                <div class="tab-pane container-fluid px-0" id="klasifikasi_kualifikasi">
                    <h5 class="font-weight-bold text-primary border-bottom pb-2 mb-3">Tinjauan Klasifikasi &
                        Kualifikasi</h5>
                    <form
                        action="<?= base_url('Admin/insert_klasifikasi_kualifikasi_tinjau_permohonan/') . base64_encode($id_izin); ?>"
                        method="POST">
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                            value="<?= $this->security->get_csrf_hash(); ?>" />

                        <div class="table-responsive">
                            <table class="table table-hover table-valign-middle text-dark w-100 border-bottom">
                                <thead class="bg-light text-secondary">
                                    <tr>
                                        <th width="5%" class="text-center">#</th>
                                        <th width="30%">Nama Dokumen</th>
                                        <th width="15%" class="text-center">Tidak/Ada</th>
                                        <th width="50%">Catatan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center font-weight-bold">1</td>
                                        <td>Berita Acara VV</td>
                                        <td class="text-center">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" value="1" id="5a"
                                                    name="berita_acara_vv" <?php foreach ($get_data_tinjau_permohonan as $data_tinjau_permohonan) {
                                                        if ($data_tinjau_permohonan['item_tinjau_permohonan'] == '5a' && $data_tinjau_permohonan['status'] == '1') {
                                                            echo 'checked';
                                                        }
                                                    } ?>>
                                                <label class="custom-control-label" for="5a"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="catatan_berita_acara_vv"
                                                placeholder="Tambahkan catatan..." <?php foreach ($get_data_tinjau_permohonan as $data_tinjau_permohonan) {
                                                    if ($data_tinjau_permohonan['item_tinjau_permohonan'] == '5a') {
                                                        echo 'value="' . $data_tinjau_permohonan['catatan'] . '"';
                                                    }
                                                } ?>>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center font-weight-bold">2</td>
                                        <td>Surat Permohonan</td>
                                        <td class="text-center">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" value="1" id="5b"
                                                    name="surat_permohonan" <?php foreach ($get_data_tinjau_permohonan as $data_tinjau_permohonan) {
                                                        if ($data_tinjau_permohonan['item_tinjau_permohonan'] == '5b' && $data_tinjau_permohonan['status'] == '1') {
                                                            echo 'checked';
                                                        }
                                                    } ?>>
                                                <label class="custom-control-label" for="5b"></label>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" name="catatan_surat_permohonan"
                                                placeholder="Tambahkan catatan..." <?php foreach ($get_data_tinjau_permohonan as $data_tinjau_permohonan) {
                                                    if ($data_tinjau_permohonan['item_tinjau_permohonan'] == '5b') {
                                                        echo 'value="' . $data_tinjau_permohonan['catatan'] . '"';
                                                    }
                                                } ?>>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="table-responsive mt-4">
                            <table class="table table-borderless table-valign-middle w-100 bg-light rounded p-3">
                                <tr>
                                    <td width="5%" class="text-center font-weight-bold text-success"><i
                                            class="fas fa-check-square fa-lg"></i></td>
                                    <td width="30%" class="font-weight-bold text-uppercase">Ceklis Klasifikasi &
                                        Kualifikasi</td>
                                    <td width="15%" class="text-center">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" value="1" id="5"
                                                name="ceklis_klasifikasi_kualifikasi" <?php foreach ($get_data_tinjau_permohonan as $data_tinjau_permohonan) {
                                                    if ($data_tinjau_permohonan['item_tinjau_permohonan'] == '5' && $data_tinjau_permohonan['status'] == '1') {
                                                        echo 'checked';
                                                    }
                                                } ?>>
                                            <label class="custom-control-label font-weight-bold" for="5">Lengkap</label>
                                        </div>
                                    </td>
                                    <td width="50%">
                                        <input type="text" class="form-control"
                                            name="catatan_ceklis_klasifikasi_kualifikasi"
                                            placeholder="Catatan Kesimpulan Klasifikasi & Kualifikasi..." <?php foreach ($get_data_tinjau_permohonan as $data_tinjau_permohonan) {
                                                if ($data_tinjau_permohonan['item_tinjau_permohonan'] == '5') {
                                                    echo 'value="' . $data_tinjau_permohonan['catatan'] . '"';
                                                }
                                            } ?>>
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div class="mt-5 border rounded p-4 bg-white shadow-sm">
                            <h6 class="font-weight-bold text-dark border-bottom pb-2 mb-3"><i
                                    class="fas fa-layer-group text-secondary mr-2"></i>Detail Data Klasifikasi &
                                Kualifikasi Permohonan</h6>
                            <table class="table table-striped table-sm text-dark m-0 w-100">
                                <?php foreach ($get_data_klasifikasi_kualifikasi_permohonan as $data_kk) { ?>
                                    <tr>
                                        <td width="25%" class="font-weight-bold">Kualifikasi</td>
                                        <td width="2%">:</td>
                                        <td><?php echo $data_kk['deskripsi_kualifikasi'] ?></td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Klasifikasi</td>
                                        <td>:</td>
                                        <td><?php echo $data_kk['klasifikasi'] . " (" . $data_kk['deskripsi_klasifikasi'] . ")" ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Subklasifikasi</td>
                                        <td>:</td>
                                        <td><?php echo $data_kk['subklasifikasi'] . " (" . $data_kk['deskripsi_subklasifikasi'] . ")" ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Jabatan Kerja</td>
                                        <td>:</td>
                                        <td><span
                                                class="text-primary font-weight-bold"><?php echo $data_kk['jabatan_kerja'] . " (" . $data_kk['deskripsi_jabatan_kerja'] . ")" ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Jenis Permohonan</td>
                                        <td>:</td>
                                        <td><span
                                                class="badge badge-info p-2"><?php echo $data_kk['deskripsi_jenis_permohonan'] ?></span>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </table>
                        </div>

                        <div class="mt-4 text-right">
                            <input type="submit" value="Simpan Kualifikasi" class="btn btn-primary px-4 shadow-sm" />
                        </div>
                    </form>

                    <div class="clearfix"></div>

                    <div class="text-center mt-5 p-4 bg-light rounded border border-success">
                        <h5 class="font-weight-bold mb-3 text-dark">Lanjutkan ke Tahap Kesimpulan Akhir</h5>
                        <a href="<?= base_url('admin/hasil_tinjau_permohonan/') . base64_encode($id_izin) ?>"
                            class="btn btn-primary btn-lg shadow px-5 rounded">
                            <i class="fas fa-check-double mr-2"></i> Hasil Tinjau Permohonan
                        </a>
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

        // window.addEventListener("resize", resizeCanvas);
        // resizeCanvas();

        signaturePad = new SignaturePad(canvas);

        clearButton.addEventListener("click", function (event) {
            signaturePad.clear();
        });

        saveButton.addEventListener("click", function (event) {
            if (signaturePad.isEmpty()) {
                alert('Tanda tangan masih kosong!');
                return;
            }

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
                        alert("Gagal menyimpan TTD. Status: " + xhr.status);
                        console.error(xhr.responseText);
                    }
                });
            }
        }); 
    </script>
</body>

</html>