<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Tinjau Permohonan</title>

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
                <i class="fas fa-calendar-check mr-1"></i> List Tinjau Permohonan
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
                            <th>Klasifikasi</th>
                            <th>Subklasifikasi</th>
                            <th>Kualifikasi</th>
                            <th>Tgl Permohonan</th>
                            <th>Jenis Permohonan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Id Izin</th>
                            <th>Klasifikasi</th>
                            <th>Subklasifikasi</th>
                            <th>Kualifikasi</th>
                            <th>Tgl Permohoan</th>
                            <th>Jenis Permohonan</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($list_tinjau_permohonan as $data_list_permohonan) {
                            ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $data_list_permohonan['nama']; ?></td>
                                <td><?php echo $data_list_permohonan['id_izin']; ?></td>
                                <td><?php echo $data_list_permohonan['klasifikasi']; ?></td>
                                <td><?php echo $data_list_permohonan['subklasifikasi']; ?></td>
                                <td><?php echo $data_list_permohonan['kualifikasi']; ?></td>
                                <td><?php echo date("Y-M-d", strtotime($data_list_permohonan['created'])); ?></td>
                                <td>
                                    <?php

                                    foreach ($get_master_jenis_permohonan as $master_jenis_permohonan) {
                                        if ($master_jenis_permohonan['id'] == $data_list_permohonan['jenis_permohonan']) {
                                            echo $master_jenis_permohonan['deskripsi'];
                                        }
                                    }
                                    ?>
                                </td>
                                <td>
                                    <div class="dropdown mb-4">
                                        <button class="btn btn-primary dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                        </button>
                                        <div class="dropdown-menu animated--fade-in" aria-labelledby="dropdownMenuButton">
                                            <a href="<?php echo base_url('admin/tinjau_permohonan/') . base64_encode($data_list_permohonan['id_izin']); ?>"
                                                class="dropdown-item">Tinjau Permohonan</a>
                                        </div>
                                    </div>
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
    <?php if ($this->session->flashdata('success-tinjau-permohonan')): ?>
        <script>
            swal({
                title: "Berhasil",
                text: "Tinjau Permohonan Telah Selesai",
                icon: "<?= base_url('assets/img/success.png') ?>",
                button: false,
                timer: 5000,
            });
        </script>
    <?php endif; ?>

</html>