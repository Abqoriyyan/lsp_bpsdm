<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Tugas Asesmen</title>

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
                    <i class="fas fa-file-signature"></i> List Tugas Asesmen
                </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover table-sm table-compact w-100"
                        id="dataTable" cellspacing="0">
                        <thead class="text-center">
                            <tr class="text-center">
                                <th>No</th>
                                <th>Id Izin</th>
                                <th>Nama</th>
                                <th>Jabatan Kerja</th>
                                <th>Jenjang</th>
                                <th>Jenis Permohonan</th>
                                <th>Surat Tugas</th>
                                <th>Pra Asesmen</th>
                                <th>Form Asesmen</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <?php
                            $no = 1;
                            foreach ($get_list_tugas_asesmen as $list_tugas_asesmen) {
                                ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $list_tugas_asesmen['id_izin'] ?></td>
                                    <td><?= $list_tugas_asesmen['nama'] ?></td>
                                    <td><?= $list_tugas_asesmen['jabatan_kerja'] ?></td>
                                    <td><?= $list_tugas_asesmen['jenjang'] ?></td>
                                    <td><?= $list_tugas_asesmen['jenis_permohonan'] ?></td>
                                    <td><a href="<?= base_url('asesor/cetak_surat_tugas/') . base64_encode($list_tugas_asesmen['id_izin']) ?>"
                                            class="btn btn-primary" style="font-size:10px;" target="_blank">Detail</a></td>
                                    <td><a href="<?= base_url('asesor/pra_asesmen/') . base64_encode($list_tugas_asesmen['id_izin']) ?>"
                                            class="btn btn-warning" style="font-size:10px;" target="_blank">Detail</a></td>
                                    <td><a href="<?= base_url('asesor/asesmen/') . base64_encode($list_tugas_asesmen['id_izin']) ?>"
                                            class="btn btn-success" style="font-size:10px;" target="_blank">Detail</a></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>