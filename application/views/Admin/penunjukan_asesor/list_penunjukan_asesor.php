<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penunjukkan Asesor</title>

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

<div class="container-fluid mt-4">
    <div class="card shadow mb-4">
        <div class="card-header py-3 card-header-custom">
            <h6 class="m-0 font-weight-bold text-white">
                <i class="fas fa-file-signature"></i> List Penunjukkan Asesor
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover table-sm table-compact w-100"
                    id="dataTable" cellspacing="0">
                    <thead class="text-center">
                        <tr class="text-center">
                            <th>No</th>
                            <th>Nama</th>
                            <th>Id Izin</th>
                            <th>Skema Sertifikasi</th>
                            <th>Tanggal Permohonan</th>
                            <th>Asesor</th>
                            <th>Nama TUK</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tfoot class="thead-light">
                        <tr class="text-center">
                            <th>No</th>
                            <th>Nama</th>
                            <th>Id Izin</th>
                            <th>Skema Sertifikasi</th>
                            <th>Tanggal Permohonan</th>
                            <th>Asesor</th>
                            <th>Nama TUK</th>
                            <th>Status</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($get_list_penunjukan_asesor as $data) {
                            ?>
                            <tr>
                                <td class="text-center"><?= $no++; ?></td>
                                <td><?= $data['nama']; ?></td>
                                <td><?= $data['id_izin']; ?></td>
                                <td><?= $data['jabatan_kerja']; ?></td>
                                <td><?= date("Y-M-d", strtotime($data['created'])); ?></td>
                                <td>
                                    <?php
                                    if (!empty($data['nama_asesor'])) {
                                        echo $data['nama_asesor'];
                                    } else {
                                        echo 'Belum Penunjukan';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if (!empty($data['nama_tuk'])) {
                                        echo $data['nama_tuk'];
                                    } else {
                                        echo 'Belum Penunjukan';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php if (empty($data['id_asesor'])) {
                                        echo "<a href='" . base_url('admin/penunjukan_asesor/') . base64_encode($data['id_izin']) . "' class='btn btn-primary text-center' style='font-size:12px;'>Mulai Penunjukkan</a>";
                                    } else {
                                        echo "<p class='btn btn-success' style='font-size:12px;'>Sudah Penunjukan</p>";
                                    }
                                    ?>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </body>

</html>