<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Sertifikat Terbit</title>

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
                <i class="fas fa-file"></i> List Sertifikat Terbit
            </h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover table-sm table-compact w-100"
                    id="dataTable" cellspacing="0">
                    <thead class="text-center">
                        <tr>
                            <th width="3%">No</th>
                            <th width="20%">Detail Pemohon</th>
                            <th width="20%">Skema Sertifikasi</th>
                            <th width="15%">Dokumen Validasi</th>
                            <th width="10%">Sertifikat</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($get_data_terbit_sertifikat as $data_terbit_sertifikat) {
                            ?>
                            <tr>
                                <td class="text-center"><?= $no++ ?></td>

                                <td>
                                    <strong>
                                        <?= $data_terbit_sertifikat['nama'] ?>
                                    </strong><br>
                                    <span class="text-muted">Id Izin:
                                        <?= $data_terbit_sertifikat['id_izin'] ?>
                                    </span>
                                </td>
                                <td>
                                    <?= $data_terbit_sertifikat['jabatan_kerja'] ?>
                                    <br>
                                    <span class="badge badge-info">
                                        <?= $data_terbit_sertifikat['subklasifikasi'] ?>
                                    </span>
                                </td>
                                <td class="text-center text-nowrap-custom">
                                    <div class="btn-group" role="group">
                                        <a href="<?= base_url('asesor/cetak_berita_acara_rekomendasi_asesor/') . base64_encode($data_terbit_sertifikat['id_izin']); ?>"
                                            class="btn btn-outline-success btn-xs" target="_blank"
                                            title="BA Rekomendasi Asesor">BA Rek</a>
                                        <a href="<?= base_url('komite/cetak_berita_acara_pleno_komite/') . base64_encode($data_terbit_sertifikat['id_izin']); ?>"
                                            class="btn btn-outline-success btn-xs" target="_blank"
                                            title="BA Pleno Komite">Pleno</a>
                                        <a href="<?= base_url('komite/cetak_surat_keputusan_komite/') . base64_encode($data_terbit_sertifikat['id_izin']); ?>"
                                            class="btn btn-outline-success btn-xs" target="_blank"
                                            title="SK Komite Teknis">SK Komite</a>
                                    </div>
                                </td>

                                <td class="text-center"><a
                                        href="<?= base_url('sertifikat/') . base64_encode($data_terbit_sertifikat['id_izin']); ?>"
                                        class="btn btn-success" target="_blank" style="font-size:12px;">Preview
                                        Sertifikat</a></td>
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