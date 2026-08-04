<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Asesmen</title>

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
                    <i class="fas fa-plus"></i> Tambah Jadwal Asesmen
                </h6>
            </div><br />
            <div class="container">
                <form action="<?= base_url('admin/buat_jadwal_asesmen/') ?>" method="POST" enctype="multipart/form-data"
                    onsubmit="return confirm('Konfirmasi Menambahkan Jadwal Asesmen')">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="font-weight-bold">Pilih TUK :</label>
                                <select name="TUK" class="form-control input-sm">
                                    <?php
                                    foreach ($get_master_tuk as $data_tuk) {
                                        ?>
                                        <option value="<?= $data_tuk['id']; ?>">
                                            <?= $data_tuk['nama_tuk'] . " - " . $data_tuk['alamat'] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="font-weight-bold"> Jenis Jadwal :</label>
                                <select name="jenis_jadwal" class="form-control input-sm">
                                    <?php
                                    foreach ($get_master_jenis_jadwal as $data_jenis_jadwal) {
                                        ?>
                                        <option value="<?= $data_jenis_jadwal['id']; ?>">
                                            <?= $data_jenis_jadwal['deskripsi']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="font-weight-bold"> Jenis Anggaran :</label>
                                <select name="jenis_anggaran" class="form-control input-sm">
                                    <?php
                                    foreach ($get_master_jenis_anggaran as $data_jenis_anggaran) {
                                        ?>
                                        <option value="<?= $data_jenis_anggaran['id']; ?>">
                                            <?= $data_jenis_anggaran['deskripsi']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="font-weight-bold"> Nama Jadwal :</label>
                                <input type="text" class="form-control input-sm" name="nama_jadwal" required>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="font-weight-bold"> Tanggal Mulai :</label>
                                <input type="date" class="form-control input-sm" name="tanggal_mulai" required>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <label class="font-weight-bold"> Tanggal Selesai :</label>
                                <input type="date" class="form-control input-sm" name="tanggal_selesai" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="font-weight-bold"> Skema </label>
                                <select class="form-control" name="skema" id="theSelect">
                                    <?php
                                    foreach ($get_master_jabatan_kerja as $master_jabker) {
                                        ?>
                                        <option value="<?= $master_jabker['id_data_skema_bnsp'] ?>">
                                            <?= $master_jabker['subklasifikasi'] . " - " . $master_jabker['jabatan_kerja'] ?>
                                        </option>;
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <textarea name="keterangan" class="form-control" placeholder="Keterangan.."></textarea>
                            </div>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-primary" style="float:right;" value="+ Tambah" />
                </form>
            </div>
            <br /><br />


            <!-- List Jadwal Asesmen -->
            <div class="container-fluid mt-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 card-header-custom">
                        <h6 class="m-0 font-weight-bold text-white">
                            <i class="fas fa-list"></i> List Tempat Uji Kompetensi
                        </h6><a href="<?= base_url('admin/update_jadwal_asesmen'); ?>" class="btn btn-success"
                            style="float:right; font-size:12px;">Update Data Jadwal Asesmen / Sync Data dengan BNSP</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover table-sm table-compact w-100"
                                id="dataTable" cellspacing="0">
                                <thead class="text-center">
                                    <tr class="text-center">
                                        <th class="col-sm-1 text-center">Id</th>
                                        <th class="col-sm-1 text-center">Kode Jadwal</th>
                                        <th class="col-sm-1 text-center">Nama Jadwal</th>
                                        <th class="col-sm-1 text-center">Tanggal Asesmen</th>
                                        <th class="col-sm-1 text-center">Klasifikasi</th>
                                        <th class="col-sm-1 text-center">Subklasifikasi</th>
                                        <th class="col-sm-1 text-center">Status</th>
                                        <th class="col-sm-2 text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($get_data_jadwal_asesmen as $data) {
                                        ?>
                                        <tr>
                                            <td class="text-center"><?= $data['id']; ?></td>
                                            <td class="text-center"><?= $data['kode_jadwal']; ?></td>
                                            <td><?= $data['nama_jadwal']; ?></td>
                                            <td class="text-center">
                                                <?= $data['tanggal_mulai'] . " s/d " . $data['tanggal_selesai']; ?>
                                            </td>
                                            <td class="text-center"><?= $data['id_klasifikasi']; ?></td>
                                            <td class="text-center"><?= $data['id_subklasifikasi']; ?></td>
                                            <td class="text-center"><?= $data['deskripsi'] ?></td>
                                            <td class="text-center">
                                                <?php
                                                if ($data['status_jadwal'] == '451') {
                                                    ?>
                                                    <a href="<?= base_url("admin/konfirm_jadwal/") . $data['id']; ?>"
                                                        class="btn btn-success"
                                                        onclick="return confirm('Konfirmasi Jadwal - <?= $data['kode_jadwal'] ?>?')"
                                                        style="font-size:12px;">Konfirm Jadwal</a>
                                                    <?php
                                                } elseif ($data['status_jadwal'] == '456') {
                                                    ?>
                                                    <a href="<?= base_url("admin/konfirm_terima_blanko/") . $data['id']; ?>"
                                                        class="btn btn-primary"
                                                        onclick="return confirm('Konfirmasi Blanko sudah Diterima - <?= $data['kode_jadwal'] ?>?')"
                                                        style="font-size:12px;">Konfirm Terima Blanko</a>
                                                <?php } ?>
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