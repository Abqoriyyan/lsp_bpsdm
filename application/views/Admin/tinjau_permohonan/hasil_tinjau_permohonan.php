<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Tinjau Permohonan</title>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>
    <a href="<?= base_url('admin/tinjau_permohonan/') . base64_encode($id_izin); ?>"
        class="btn btn-outline-secondary btn-sm mb-2 mb-md-0 shadow-sm">
        <i class="fas fa-arrow-left mr-1"></i> Kembali ke Tinjau Permohonan
    </a>
    <div class="container-fluid py-4">
        <div class="card shadow-sm border-0 mb-4">
            <div
                class="card-header bg-white py-3 d-flex flex-column flex-md-row align-items-center justify-content-between">
                <h5 class="m-0 font-weight-bold text-primary">
                    Hasil Tinjau Permohonan
                </h5>
                <div></div>
            </div>

            <div class="card-body">

                <div class="row mb-4">
                    <div class="col-md-12">
                        <div class="p-3 bg-light rounded border">
                            <h6 class="font-weight-bold text-dark mb-3">
                                Data Personal Pemohon
                            </h6>
                            <div class="table-responsive">
                                <table class="table table-sm table-borderless m-0 text-dark">
                                    <?php foreach ($get_data_personal_permohonan as $data_personal_permohonan) { ?>
                                        <tr>
                                            <td width="10%">Nama</td>
                                            <td width="2%" class="text-center">:</td>
                                            <td width="88%"><?= $data_personal_permohonan['nama']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>NIK</td>
                                            <td class="text-center">:</td>
                                            <td><?= $data_personal_permohonan['nik']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td class="text-center">:</td>
                                            <td><?= $data_personal_permohonan['email']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Telepon</td>
                                            <td class="text-center">:</td>
                                            <td><?= $data_personal_permohonan['telepon']; ?></td>
                                        </tr>
                                        <tr>
                                            <td>Alamat</td>
                                            <td class="text-center">:</td>
                                            <td><?= $data_personal_permohonan['alamat']; ?></td>
                                        </tr>
                                    <?php } ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="p-3 bg-light rounded border">
                    <h6 class="font-weight-bold text-dark mb-3">
                        Data Permohonan Sertifikasi
                    </h6>
                    <div class="table-responsive">
                        <table class="table table-sm table-borderless m-0 text-dark">
                            <tr>
                                <td width="10%">Kualifikasi</td>
                                <td width="2%" class="text-center">:</td>
                                <td width="88%">
                                    <?= $info_data_permohonan->kualifikasi . ' (' . $info_data_permohonan->deskripsi_kualifikasi . ')'; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Jabatan Kerja</td>
                                <td class="text-center">:</td>
                                <td>
                                    <?= $info_data_permohonan->jabatan_kerja . ' (' . $info_data_permohonan->deskripsi_jabatan_kerja . ')'; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Jenjang</td>
                                <td class="text-center">:</td>
                                <td>
                                    <?= $info_data_permohonan->jenjang; ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>

                <hr class="my-4" />
                <h5 class="text-center text-dark font-weight-bold mb-3">Data Hasil Tinjau Permohonan</h5>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover w-100" cellspacing="0">
                        <thead class="bg-primary text-white text-center">
                            <tr>
                                <th width="10%">No</th>
                                <th width="35%">Item</th>
                                <th width="20%">Status</th>
                                <th width="35%">Catatan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($get_data_tinjau_permohonan as $data_tinjau_permohonan) {
                                $is_highlight = in_array($data_tinjau_permohonan['item_tinjau_permohonan'], ['1', '2', '3', '4', '5']);
                                ?>
                                <tr class="<?= $is_highlight ? 'bg-secondary text-white font-weight-bold' : ''; ?>">
                                    <td class="text-center align-middle">
                                        <?= $data_tinjau_permohonan['item_tinjau_permohonan']; ?>
                                    </td>
                                    <td class="align-middle">
                                        <?= $data_tinjau_permohonan['deskripsi_item_tinjau_permohonan']; ?>
                                    </td>
                                    <td class="text-center align-middle">
                                        <?php
                                        if ($is_highlight) {
                                            echo ($data_tinjau_permohonan['status'] == '1') ? '<span class="badge badge-success px-2 py-1">Lengkap</span>' : '<span class="badge badge-danger px-2 py-1">Tidak Lengkap</span>';
                                        } else {
                                            echo ($data_tinjau_permohonan['status'] == '1') ? '<span class="badge badge-info px-2 py-1">Ada</span>' : '<span class="badge badge-warning px-2 py-1">Tidak Ada</span>';
                                        }
                                        ?>
                                    </td>
                                    <td class="align-middle"><?= $data_tinjau_permohonan["catatan"]; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

                <div class="row justify-content-center mt-5">
                    <div class="col-md-8">
                        <div class="card shadow-sm border-0 bg-white p-4">
                            <form
                                action="<?= base_url('admin/insert_hasil_tinjau_permohonan/') . base64_encode($id_izin); ?>"
                                onsubmit="return confirm('Apakah sudah yakin untuk Hasil Tinjau Permohonannya ?');"
                                method="POST">

                                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                                    value="<?= $this->security->get_csrf_hash(); ?>" />

                                <div class="form-group text-center">
                                    <label class="font-weight-bold text-dark mb-2">Keputusan Hasil Tinjau
                                        Permohonan</label>
                                    <select name="hasil_tinjau_permohonan"
                                        class="form-control form-control-sm text-center shadow-sm" required>
                                        <option value="10">Memenuhi</option>
                                        <option value="11">Kembalikan untuk Perbaikan Data</option>
                                        <option value="90">Tolak Permohonan</option>
                                    </select>
                                </div>

                                <div class="form-group text-center mt-3">
                                    <label class="font-weight-bold text-dark mb-2">Catatan Jika Ditolak /
                                        Perbaikan</label>
                                    <textarea name="catatan" class="form-control shadow-sm" rows="4"
                                        placeholder="Tulis catatan di sini (opsional)..."></textarea>
                                </div>

                                <div class="form-group text-center mt-4 mb-0">
                                    <button type="submit" class="btn btn-success btn-md px-5 shadow-sm">
                                        <i class="fas fa-save mr-1"></i> Submit Hasil Tinjau
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>

</html>

<?php if ($this->session->flashdata('message_hasil_pemeriksaan')): ?>
    <script>
        swal({
            title: "Warning",
            text: "<?= str_replace("\n", "", $this->session->flashdata('message_hasil_pemeriksaan')); ?>",
            icon: "<?= base_url('assets/img/failed.png') ?>",
            button: "OK",
            timer: 12000,
        });
    </script>
<?php endif; ?>