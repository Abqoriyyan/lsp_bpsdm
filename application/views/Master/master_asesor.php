<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Asesor</title>

    <style>
        .table-compact th,
        .table-compact td {
            vertical-align: middle !important;
            font-size: 14px;
        }

        .table-compact thead {
            background-color: #374774 !important;
            color: #ffffff !important;
        }

        .card-header-custom {
            background-color: #EAB630 !important;
        }

        .btn-xs {
            padding: 0.25rem 0.4rem;
            font-size: 11px;
            line-height: 1.5;
            border-radius: 0.2rem;
        }

        .text-nowrap-custom {
            white-space: nowrap;
        }
    </style>
</head>

<body>
    <div class="container-fluid mt-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3 card-header-custom">
                <h6 class="m-0 font-weight-bold text-white">
                    <i class="fas fa-plus"></i> Tambah Asesor
                </h6>
            </div><br />
            <div class="container">
                <form action="<?= base_url('admin/tambah_asesor/') ?>" method="POST" enctype="multipart/form-data"
                    onsubmit="return confirm('Konfirmasi Menambahkan Asesor')">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                        value="<?= $this->security->get_csrf_hash(); ?>" />
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="font-weight-bold"> Nama Asesor :</label>
                                <input type="text" class="form-control" name="nama_asesor" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="font-weight-bold"> NIK :</label>
                                <input type="number" class="form-control" name="nik" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="font-weight-bold"> No Telepon / Wa Asesor :</label>
                                <input type="number" class="form-control" name="no_telepon" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="font-weight-bold"> Email :</label>
                                <input type="email" class="form-control" name="email" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="font-weight-bold"> ID Asesor :</label>
                                <input type="text" class="form-control" name="id_asesor" required>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="font-weight-bold"> Subklasifikasi :</label>
                                <select class="form-select" id="select_box" name="subklasifikasi" required>
                                    <option value="">Pilih Subklasifikasi</option>
                                    <?php
                                    foreach ($get_master_subklasifikasi as $master_subklasifikasi) {
                                        echo "<option value='" . $master_subklasifikasi['kode_subklasifikasi'] . "'>" . $master_subklasifikasi['kode_subklasifikasi'] . " (" . $master_subklasifikasi['subklasifikasi'] . ")</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="font-weight-bold"> Jenjang:</label>
                                <select class="form-select" name="jenjang" required>
                                    <option value="">Pilih Jenjang</option>
                                    <option value="9">9</option>
                                    <option value="8">8</option>
                                    <option value="7">7</option>
                                    <option value="6">6</option>
                                    <option value="5">5</option>
                                    <option value="4">4</option>
                                    <option value="3">3</option>
                                    <option value="2">2</option>
                                    <option value="1">1</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="font-weight-bold"> No Reg BNSP:</label>
                                <input type="text" class="form-control" name="no_reg_bnsp" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="font-weight-bold"> Masa Berlaku Sertifikat sampai dengan:</label>
                                <input type="date" class="form-control" name="masa_berlaku_sertifikat" required>
                            </div>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-primary" style="float:right;" value="+ Tambah" />
                </form>
            </div>
            <br /><br />


            <!-- List TUK -->
            <div class="container-fluid mt-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 card-header-custom">
                        <h6 class="m-0 font-weight-bold text-white">
                            <i class="fas fa-list"></i> List Asesor
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover table-sm table-compact w-100"
                                id="dataTable" cellspacing="0">
                                <thead class="text-center">
                                    <tr class="text-center">
                                        <th class="text-center">No</th>
                                        <th class="text-center">Nama</th>
                                        <th class="text-center">Id Asesor</th>
                                        <th class="text-center">Subklasifkasi</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">No Telepon</th>
                                        <th class="text-center">Masa Berlaku Sertifikat</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($get_master_asesor as $data) {
                                        ?>
                                        <tr>
                                            <td class="text-center"><?= $no++ ?></td>
                                            <td><?= $data['nama'] ?></td>
                                            <td class="text-center"><?= $data['id_asesor'] ?></a></td>
                                            <td class="text-center"><?= $data['subklasifikasi'] ?></a></td>
                                            <td class="text-center"><?= $data['email'] ?></td>
                                            <td class="text-center"><?= $data['no_hp'] ?></td>
                                            <td class="text-center"><?= $data['masa_berlaku_sertifikat'] ?></td>
                                            <td class="text-center">
                                                <?php
                                                if (!empty($data['id_asesor_bnsp'])) {
                                                    echo 'Asesor Dapat Digunakan';
                                                } else {
                                                    echo '<a href="' . base_url('admin/aktivasi_asesor/') . $data['no_reg_bnsp'] . '" class="btn btn-success" style="font-size:10px;">Aktivasi Asesor</a>';
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>