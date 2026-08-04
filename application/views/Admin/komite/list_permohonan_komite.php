<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penunjukan Komite Teknis</title>

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
                <i class="fas fa-users-cog"></i> Penunjukan Komite Teknis
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover table-sm table-compact w-100"
                    id="dataTable" cellspacing="0">
                    <thead class="text-center">
                        <tr class="text-center">
                            <th width="5%">No</th>
                            <th width="25%">Id Izin</th>
                            <th width="25%">Nama</th>
                            <th width="20%">Status Permohonan</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        if (!empty($list_permohonan)):
                            foreach ($list_permohonan as $row):
                                ?>
                                <tr>
                                    <td class="text-center">
                                        <?= $no++; ?>
                                    </td>
                                    <td>
                                        <?= $row['id_izin']; ?>
                                    </td>
                                    <td>
                                        <?= $row['nama']; ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if (isset($row['kode_status'])): ?>
                                            <span class="badge badge-info p-2">Kode Status:
                                                <?= $row['kode_status']; ?>
                                            </span>
                                        <?php else: ?>
                                            <span class="badge badge-secondary p-2">Belum ada status</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center">
                                        <a href="<?= base_url('Admin/form_komite_teknis/' . base64_encode($row['id_izin'])); ?>"
                                            class="btn btn-primary btn-sm shadow-sm">
                                            Kelola Komite
                                        </a>
                                    </td>
                                </tr>
                                <?php
                            endforeach;
                        else:
                            ?>
                            <tr>
                                <td colspan="4" class="text-center">Belum ada data permohonan.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Inisialisasi DataTables jika belum ada di template bawaan -->
    <script>
        $(document).ready(function () {
            $('#dataTable').DataTable();
        });
    </script>