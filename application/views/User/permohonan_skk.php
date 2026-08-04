<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permohonan SKK Konstruksi</title>

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

        .alert-info-custom {
            background-color: #e0f2fe;
            border-left: 4px solid #0ea5e9;
            color: #0284c7;
            border-radius: 6px;
            font-size: 14px;
        }
    </style>

</head>

<body>
    <div class="col-sm-12">
        <div class="card shadow mb-4" style="margin-top:30px;">
            <br />
            <h2 class="m-0 font-weight-bold text-dark text-center">Permohonan SKK</h2>
            <div class="container">
                <div class="alert alert-info-custom mt-4 mb-0 p-3"> <b>Catatan:</b><br>
                    Pastikan Sebelum <b>Kirim Pra-Asesment</b> Lengkapi Terlebih dahulu <b>Form APL 01 dan APL
                        02</b><br>
                    Kirim Pra-Asesmen dapat dikirim ketika pada kolom Status sudah dinyatakan (Berkas Permohonan
                    Memenuhi)
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover table-sm table-compact w-100"
                        id="dataTable" cellspacing="0">
                        <thead class="text-center">
                            <tr class="text-center">
                                <th class="col-sm-0 text-center align-middle">No</th>
                                <th class="col-sm-2 text-center align-middle">Id Izin</th>
                                <th class="col-sm-1 text-center align-middle">Kualifikasi</th>
                                <th class="col-sm-1 text-center align-middle">Jabatan Kerja</th>
                                <th class="col-sm-3 text-center align-middle">Keperluan Sertifikasi<br />(Form APL01 &
                                    APL02)</th>
                                <th class="col-sm-2 text-center align-middle">Aksi</th>
                                <th class="col-sm-2 text-center align-middle">Status Permohonan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($get_data_permohonan as $data) {
                                ?>
                                <tr>
                                    <td class="text-center"><?= $no++ ?></td>
                                    <td class="text-center"><?= $data['id_izin']; ?></td>
                                    <td class="text-center"><?= $data['kualifikasi'] ?></td>
                                    <td class="text-center"><?= $data['jabatan_kerja'] ?></td>
                                    <td class="text-center">
                                        <div class="dropdown mb-4">
                                            <a href="<?= base_url('user/formulir_apl01/') . base64_encode($data['id_izin']); ?>"
                                                class="btn btn-primary" style="font-size:10px;"><b>Lengkapi Form APL
                                                    01</b></a><br><br>
                                            <a href="<?= base_url('user/formulir_apl02/') . base64_encode($data['id_izin']); ?>"
                                                class="btn btn-primary" style="font-size:10px;"><b>Lengkapi Form APL
                                                    02</b></a>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <!-- Kirim Pra Asesment jika status 10 / Berkas Memenuhi -->
                                        <?php
                                        if ($data['kode_status'] == '10') {
                                            ?>
                                            <a href="<?= base_url('user/kirim_pra_asesment/') . base64_encode($data['id_izin']); ?>"
                                                class="btn btn-success text-center" style="font-size:12px;"
                                                onclick="return confirm('Pastikan Anda Sudah Melengkapi Form APl-01 dan APL-02, Jika Sudah silahkan klik OK untuk proses ke tahap Pra-Asesment.')"><b>Kirim
                                                    Pra-Asesment</b></a>
                                            <?php
                                        } elseif ($data['kode_status'] == '11') {
                                            ?>
                                            <a href="<?= base_url() ?>" class="btn btn-warning text-center"
                                                style="font-size:12px;"><b>Perbaikan Data Permohonan</b></a>
                                            <?php
                                        } else {
                                            echo '';
                                        }
                                        ?>
                                    </td>
                                    <td class="text-center"><b>
                                            <?php
                                            if ($data['kode_status'] == '20') {
                                                echo 'Validasi (Tinjau Permohonan)';
                                            } elseif ($data['kode_status'] == '10') {
                                                echo 'Berkas Permohonan Memenuhi';
                                            } elseif ($data['kode_status'] == '11') {
                                                echo 'Silahkan Perbaiki Data Permohonan di field Action';
                                            } elseif ($data['kode_status'] == '12') {
                                                echo 'Pra-Asesment';
                                            } elseif ($data['kode_status'] == '30') {
                                                echo 'Silahkan Selesaikan Pembayaran';
                                            } elseif ($data['kode_status'] == '31') {
                                                echo 'Pembayaran sudah Dibayarkan';
                                            } else {
                                                echo '';
                                            }
                                            ?>
                                        </b>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
</body>

</html>