<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Penetapan</title>

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
                <i class="fas fa-file-signature"></i> List Penetapan
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
                            <th>Jabatan Kerja</th>
                            <th>Nama TUK</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($get_list_penetapan as $list_penetapan) {
                            ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $list_penetapan['nama']; ?></td>
                                <td><?= $list_penetapan['id_izin']; ?></td>
                                <td><?= $list_penetapan['jabatan_kerja']; ?></td>
                                <td><?= $list_penetapan['nama_tuk']; ?></td>
                                <td>
                                    <a href="<?= base_url('Komite/penetapan/') . base64_encode($list_penetapan['id_izin']); ?>"
                                        class="btn btn-success" style="font-size:12px;">Mulai Penetapan</a>
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