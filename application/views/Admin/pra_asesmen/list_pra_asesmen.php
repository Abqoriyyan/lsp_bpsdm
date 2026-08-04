<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Absensi Pra Asesmen</title>

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
                <i class="fas fa-file"></i> Absensi Pra Asesmen
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover table-sm table-compact w-100"
                    id="dataTable" cellspacing="0">
                    <thead class="text-center">
                        <tr class="text-center">
                            <th width="5%">No</th>
                            <th width="15%">Kode Jadwal</th>
                            <th width="35%">Nama Jadwal</th>
                            <th width="20%">Tanggal</th>
                            <th width="25%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        if (!empty($list_jadwal)):
                            foreach ($list_jadwal as $row):
                                ?>
                                <tr>
                                    <td class="text-center"><?= $no++; ?></td>
                                    <td class="text-center"><?= $row['kode_jadwal']; ?></td>
                                    <td><?= $row['nama_jadwal']; ?></td>
                                    <td class="text-center"><?= date('d M Y', strtotime($row['tanggal_mulai'])); ?></td>
                                    <td class="text-center">
                                        <a href="<?= base_url('Admin/form_pra_asesmen/' . base64_encode($row['kode_jadwal'])); ?>"
                                            class="btn btn-success btn-sm">
                                            Kelola Absensi
                                        </a>
                                    </td>
                                </tr>
                                <?php
                            endforeach;
                        else:
                            ?>
                            <tr>
                                <td colspan="5" class="text-center">Belum ada jadwal asesmen yang terdaftar.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#dataTable').DataTable();
        });
    </script>