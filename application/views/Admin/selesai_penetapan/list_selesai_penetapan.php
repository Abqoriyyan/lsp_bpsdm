<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quality Check - Hasil Penetapan Komite Teknis</title>

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
                <i class="fas fa-file-signature"></i> Quality Check - Hasil Penetapan Komite Teknis
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
                            <th width="10%">Jadwal Asesmen</th>
                            <th width="15%">Dokumen Validasi</th>
                            <th width="12%">Status Blanko</th>
                            <th width="10%">Sertifikat</th>
                            <th width="10%">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($get_data_selesai_penetapan as $data_selesai_penetapan) {
                            ?>
                            <tr>
                                <td class="text-center"><?= $no++ ?></td>

                                <td>
                                    <strong><?= $data_selesai_penetapan['nama'] ?></strong><br>
                                    <span class="text-muted">Id Izin: <?= $data_selesai_penetapan['id_izin'] ?></span>
                                </td>

                                <td>
                                    <?= $data_selesai_penetapan['jabatan_kerja'] ?>
                                    <br>
                                    <span class="badge badge-info"><?= $data_selesai_penetapan['subklasifikasi'] ?></span>
                                </td>

                                <td class="text-center"><?= $data_selesai_penetapan['id_jadwal_asesmen'] ?></td>

                                <td class="text-center text-nowrap-custom">
                                    <div class="btn-group" role="group">
                                        <a href="<?= base_url('asesor/cetak_berita_acara_rekomendasi_asesor/') . base64_encode($data_selesai_penetapan['id_izin']); ?>"
                                            class="btn btn-outline-primary btn-xs" target="_blank"
                                            title="BA Rekomendasi Asesor">BA Rek</a>
                                        <a href="<?= base_url('komite/cetak_berita_acara_pleno_komite/') . base64_encode($data_selesai_penetapan['id_izin']); ?>"
                                            class="btn btn-outline-primary btn-xs" target="_blank"
                                            title="BA Pleno Komite">Pleno</a>
                                        <a href="<?= base_url('komite/cetak_surat_keputusan_komite/') . base64_encode($data_selesai_penetapan['id_izin']); ?>"
                                            class="btn btn-outline-primary btn-xs" target="_blank"
                                            title="SK Komite Teknis">SK Komite</a>
                                    </div>
                                </td>

                                <td class="text-center">
                                    <?php
                                    if ($data_selesai_penetapan['nomor_blangko_bnsp'] !== "Menunggu Approve BNSP") {
                                        echo "<span class='badge badge-success mb-1'>" . $data_selesai_penetapan['nomor_blangko_bnsp'] . "</span><br>";

                                        if ($data_selesai_penetapan['nomor_registrasi_lpjk'] == "Menunggu Approve BNSP" || $data_selesai_penetapan['nomor_registrasi_lpjk'] == NULL) {
                                            ?>
                                            <a href="<?= base_url('admin/get_blanko_bnsp/') . base64_encode($data_selesai_penetapan['id_izin']); ?>"
                                                class='btn btn-info btn-xs text-nowrap-custom'><i class="fas fa-sync-alt"></i>
                                                Get Ulang</a>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <a href="<?= base_url('admin/get_blanko_bnsp/') . base64_encode($data_selesai_penetapan['id_izin']); ?>"
                                            class='btn btn-warning btn-xs text-nowrap-custom'><i class="fas fa-download"></i>
                                            Get Blanko</a>
                                        <?php
                                    }
                                    ?>
                                </td>

                                <td class="text-center">
                                    <a href="<?= base_url('sertifikat/') . base64_encode($data_selesai_penetapan['id_izin']); ?>"
                                        class="btn btn-primary btn-xs text-nowrap-custom" target="_blank">
                                        <i class="fas fa-eye"></i> Preview
                                    </a>
                                </td>

                                <?php
                                if ($data_selesai_penetapan['nomor_blangko_bnsp'] == "Menunggu Approve BNSP" || $data_selesai_penetapan['nomor_registrasi_lpjk'] == "Menunggu Approve BNSP" || $data_selesai_penetapan['nomor_registrasi_lpjk'] == NULL) {
                                    echo "<td class='text-center'><button class='btn btn-secondary btn-xs text-nowrap-custom' disabled><i class='fas fa-clock'></i> Menunggu</button></td>";
                                } else {
                                    ?>
                                    <td class="text-center">
                                        <a href="<?= base_url('admin/izin_final_siki_portal/') . base64_encode($data_selesai_penetapan['id_izin']); ?>"
                                            class="btn btn-success btn-xs text-nowrap-custom"
                                            onclick="return confirm('QC Sudah Lengkap - Permohonan Sertifikasi dan Sertifikat Sudah Sesuai ?')">
                                            <i class="fas fa-check"></i> Final
                                        </a>
                                    </td>
                                    <?php
                                }
                                ?>
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

<?php if ($this->session->flashdata('message_pencatatan_siki')): ?>
    <script>
        swal({
            title: "Warning",
            text: "<?= $this->session->flashdata('message_pencatatan_siki') ?>",
            icon: "<?= base_url('assets/img/failed.png') ?>",
            button: false,
            timer: 12000,
        });
    </script>
<?php endif; ?>

<?php if ($this->session->flashdata('message_pelaporan_asesor')): ?>
    <script>
        swal({
            title: "Warning",
            text: "<?= $this->session->flashdata('message_pelaporan_asesor') ?>",
            icon: "<?= base_url('assets/img/failed.png') ?>",
            button: false,
            timer: 10000,
        });
    </script>
<?php endif; ?>

</html>