<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Pernyataan Pemegang Sertifikat</title>

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
                <i class="fas fa-file-signature"></i> List Pernyataan Asesi
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover table-sm table-compact w-100"
                    id="dataTable" cellspacing="0">
                    <thead class="text-center">
                        <tr class="text-center">
                            <th width="5%">No</th>
                            <th width="30%">Id Izin Permohonan</th>
                            <th width="45%">Nama Lengkap Asesi</th>
                            <th width="20%">Dokumen</th>
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
                                    <td><strong>
                                            <?= $row['id_izin']; ?>
                                        </strong></td>
                                    <td>
                                        <?= isset($row['nama_asesi']) ? $row['nama_asesi'] : 'Data Asesi'; ?>
                                    </td>
                                    <td class="text-center">
                                        <a href="<?= base_url('Admin/cetak_pernyataan_asesi/' . base64_encode($row['id_izin'])); ?>"
                                            target="_blank" class="btn btn-success btn-sm shadow-sm">
                                            <i class="fas fa-file-pdf mr-1"></i> Cetak Pernyataan
                                        </a>
                                    </td>
                                </tr>
                                <?php
                            endforeach;
                        else:
                            ?>
                            <tr>
                                <td colspan="4" class="text-center">Tidak ada data permohonan ditemukan.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<script>
    $(document).ready(function () {
        $('#dataTable').DataTable();
    });
</script>