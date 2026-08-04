<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Permohonan</title>

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
                <i class="fas fa-list"></i> List Permohonan Asesmen<a
                    href="<?= base_url('admin/get_data_list_permohonan') ?>" class="btn btn-success"
                    style="float:right; font-size:12px;">Update Data Permohonan</a>
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover table-sm table-compact w-100"
                    id="dataTable" cellspacing="0">
                    <thead class="text-center">
                        <tr class="text-center">
                            <th width="5%">No</th>
                            <th width="15%">NIK</th>
                            <th width="15%">Id Izin</th>
                            <th width="15%">Dibuat pada</th>
                            <th width="15%">Update pada</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tfoot class="thead-light">
                        <tr class="text-center">
                            <th width="5%">No</th>
                            <th width="15%">NIK</th>
                            <th width="15%">Id Izin</th>
                            <th width="15%">Create At</th>
                            <th width="15%">Update At</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($list_permohonan as $data_list_permohonan) {
                            ?>
                            <tr>
                                <td class="text-center"><?php echo $no++; ?></td>
                                <td><?php if ($data_list_permohonan['kode_status'] == '11') {
                                    echo $data_list_permohonan['nik'] . ' - Perbaikan';
                                } else {
                                    echo $data_list_permohonan['nik'];
                                } ?>
                                </td>
                                <td class="text-center"><?php echo $data_list_permohonan['id_izin']; ?></td>
                                <td class="text-center"><?php echo $data_list_permohonan['created_at']; ?></td>
                                <td class="text-center"><?php echo $data_list_permohonan['updated_at']; ?></td>
                                <td class="text-center">
                                    <?php if ($data_list_permohonan['kode_status'] == '11') { ?>
                                        <a href="<?= base_url('admin/cek_status_perbaikan/') . base64_encode($data_list_permohonan['id_izin']); ?>"
                                            onclick="return confirm('Cek Status Perbaikan')" class="btn btn-warning"
                                            style="font-size:10px;">Cek Status Perbaikan</a>
                                    <?php } else { ?>
                                        <a href="<?= base_url('admin/entry_data_permohonan/') . base64_encode($data_list_permohonan['id_izin']); ?>"
                                            onclick="return confirm('Mulai Tinjau Permohonan')" class="btn btn-primary"
                                            style="font-size:10px;">Mulai Tinjau Permohonan</a>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </body>

</html>