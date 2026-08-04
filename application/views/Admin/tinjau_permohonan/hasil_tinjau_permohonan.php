<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Tinjau Permohonan</title>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>

<body>
    <!-- Overflow Hidden -->
    <div class="card mb-4">
        <div class="card-header py-3">
            <a href="<?= base_url('admin/tinjau_permohonan/') . base64_encode($id_izin); ?>"
                class="btn btn-primary">Kembali ke Tinjau Permohonan</a>
            <h5 class="m-0 font-weight-bold text-center text-primary">Hasil Tinjau Permohonan</h5>
        </div>
        <div class="card-body">
            <table class="text" width="100%" border="0" cellspacing="0" cellpadding="3">
                <?php
                $no = 1;
                foreach ($get_data_personal_permohonan as $data_personal_permohonan) {
                    ?>
                    <tr>
                        <td width="20%" valign="top">Nama</td>
                        <td width="2%" valign="top" align="center">:</td>
                        <td width="78%" valign="top"><?php echo $data_personal_permohonan['nama'] ?></td>
                    </tr>
                    <tr>
                        <td width="20%" valign="top">NIK</td>
                        <td width="2%" valign="top" align="center">:</td>
                        <td width="78%" valign="top"><?php echo $data_personal_permohonan['nik'] ?></td>
                    </tr>
                    <tr>
                        <td width="20%" valign="top">Email</td>
                        <td width="2%" valign="top" align="center">:</td>
                        <td width="78%" valign="top"><?php echo $data_personal_permohonan['email'] ?></td>
                    </tr>
                    <tr>
                        <td width="20%" valign="top">Telepon</td>
                        <td width="2%" valign="top" align="center">:</td>
                        <td width="78%" valign="top"><?php echo $data_personal_permohonan['telepon'] ?></td>
                    </tr>
                    <tr>
                        <td width="20%" valign="top">Alamat</td>
                        <td width="2%" valign="top" align="center">:</td>
                        <td width="78%" valign="top"><?php echo $data_personal_permohonan['alamat'] ?></td>
                    </tr>
                    <?php
                }
                ?>
            </table>

            <div class="col-md-12 card mb-4 py-3 border-bottom-info">
                <div class='card-body'>
                    <small>
                        <?php
                        echo 'Kualifikasi : ' . $info_data_permohonan->kualifikasi . ' (' . $info_data_permohonan->deskripsi_kualifikasi . ')<br/>';
                        echo 'Jabatan Kerja : ' . $info_data_permohonan->jabatan_kerja . ' (' . $info_data_permohonan->deskripsi_jabatan_kerja . ')<br/>';
                        echo 'Jenjang : ' . $info_data_permohonan->jenjang . '<br/>';
                        ?>
                    </small>
                </div>
            </div>


            <hr />
            <h5 class="text-center" style="color:#111;">Data Hasil Tinjau Permohonan</h5>
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="col-sm-1 text-center">No</th>
                        <th class="col-sm-4 text-center">Item</th>
                        <th class="col-sm-2 text-center">Status</th>
                        <th class="col-sm-5 text-center">Catatan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($get_data_tinjau_permohonan as $data_tinjau_permohonan) { ?>
                        <?php if (($data_tinjau_permohonan['item_tinjau_permohonan'] == '1') || ($data_tinjau_permohonan['item_tinjau_permohonan'] == '2') || ($data_tinjau_permohonan['item_tinjau_permohonan'] == '3') || ($data_tinjau_permohonan['item_tinjau_permohonan'] == '4') || ($data_tinjau_permohonan['item_tinjau_permohonan'] == '5')) {
                            echo "<tr class='bg-gradient-dark text-light'>";
                        } else {
                            echo "<tr>";
                        }
                        ?>
                        <td class="text-center"><?= $data_tinjau_permohonan['item_tinjau_permohonan']; ?></td>
                        <td><?= $data_tinjau_permohonan['deskripsi_item_tinjau_permohonan']; ?></td>
                        <td class="text-center">
                            <?php
                            if (($data_tinjau_permohonan['item_tinjau_permohonan'] == '1') || ($data_tinjau_permohonan['item_tinjau_permohonan'] == '2') || ($data_tinjau_permohonan['item_tinjau_permohonan'] == '3') || ($data_tinjau_permohonan['item_tinjau_permohonan'] == '4') || ($data_tinjau_permohonan['item_tinjau_permohonan'] == '5')) {
                                if ($data_tinjau_permohonan['status'] == '1') {
                                    echo "Lengkap";
                                } else {
                                    echo "Tidak Lengkap";
                                }
                            } else {
                                if ($data_tinjau_permohonan['status'] == '1') {
                                    echo "Ada";
                                } else {
                                    echo "Tidak Ada";
                                }
                            }
                            ?>
                        </td>
                        <td><?= $data_tinjau_permohonan["catatan"]; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <br />
            <hr />
            <h5 class="text-center" style="color:#111;">Data Keperluan APl-01</h5>
            <table class="text" width="100%" border="0" cellspacing="0" cellpadding="3">
                <?php
                $no = 1;
                foreach ($get_data_personal_permohonan as $data_personal_permohonan) {
                    ?>
                    <tr>
                        <td width="20%" valign="top">Tujuan Asesment</td>
                        <td width="2%" valign="top" align="center">:</td>
                        <td width="78%" valign="top"><?= $get_data_apl01->tujuan_asesment ?></td>
                    </tr>
                    <tr>
                        <td width="20%" valign="top">Persyaratan Kompetensi</td>
                        <td width="2%" valign="top" align="center">:</td>
                        <td width="78%" valign="top"><?= $get_data_apl01->status_persyaratan_kompeten ?></td>
                    </tr>
                    <tr>
                        <td width="20%" valign="top">File KTP</td>
                        <td width="2%" valign="top" align="center">:</td>
                        <td width="78%" valign="top"><?= $get_data_apl01->status_ktp ?></td>
                    </tr>
                    <tr>
                        <td width="20%" valign="top">Pas Foto</td>
                        <td width="2%" valign="top" align="center">:</td>
                        <td width="78%" valign="top"><?= $get_data_apl01->status_pas_foto ?></td>
                    </tr>
                    <?php
                }
                ?>
            </table>



            <br /><br />
            <div class="text-center">
                <form action="<?= base_url('admin/insert_hasil_tinjau_permohonan/') . base64_encode($id_izin); ?>"
                    onsubmit="return confirm('Apakah sudah yakin untuk Hasil Tinjau Permohonannya ?');" method="POST">
                    <label>Pemutusan Hasil Tinjau Permohonan</label><br />
                    <select name="hasil_tinjau_permohonan" class="select text-center">
                        <option value="10">Memenuhi</option>
                        <option value="11">Kembalikan untuk Perbaikan Data</option>
                        <option value="90">Tolak Permohonan</option>
                    </select><br /><br />
                    <label>Catatan Jika Ditolak</label><br />
                    <textarea name="catatan"></textarea>
                    <br /><br />
                    <input type="submit" class="btn btn-primary" value="Submit" />
                </form>
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
            button: false,
            timer: 12000,
        });
    </script>
<?php endif; ?>