<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penunjukan Asesor</title>
</head>
<body>
<div class="row">
    <div class="col-lg-12">
    <div class="card shadow mb-4">
        <br/>
        <h4 class="m-0 font-weight-bold text-primary text-center">Penunjukan Asesor</h4>
        <div class="col-sm-12">
        <hr/>
        <!-- /Info Data Permohonan -->
        <div class="table-responsive card mb-6 py-3 border-bottom-info">
            <div class="card-body">
            <h6 class="m-0 font-weight-bold text-primary text-center">Info Permohonan</h6>
            <table border="0">
                <tbody>
                    <tr>
                        <td width="15%">
                            <h6 class="card-title">Nama</h6>
                        </td>
                        <td width="2%">
                            <h6 class="card-title">:</h6>
                        </td>
                        <td>
                            <h6 class="card-title"> <?= $get_data_personal_permohonan[0]['nama']?></h6>
                        </td>
                    </tr>
                    <tr>
                        <td width="15%">
                            <h6 class="card-title">Kualifikasi</h6>
                        </td>
                        <td width="2%">
                            <h6 class="card-title">:</h6>
                        </td>
                        <td>
                            <h6 class="card-title"> <?= $info_data_permohonan->deskripsi_kualifikasi?></h6>
                        </td>
                    </tr>
                    <tr>
                        <td width="15%">
                            <h6 class="card-title">Subklasifikasi</h6>
                        </td>
                        <td width="2%">
                            <h6 class="card-title">:</h6>
                        </td>
                        <td>
                            <h6 class="card-title"><?= $info_data_permohonan->subklasifikasi?>( <?= $info_data_permohonan->deskripsi_subklasifikasi?> )</h6>
                        </td>
                    </tr>
                    <tr>
                        <td width="15%">
                            <h6 class="card-title">Jenjang</h6>
                        </td>
                        <td width="2%">
                            <h6 class="card-title">:</h6>
                        </td>
                        <td>
                            <h6 class="card-title"><?= $info_data_permohonan->jenjang?></h6>
                        </td>
                    </tr>
                    <tr>
                        <td width="15%">
                            <h6 class="card-title">Jabatan Kerja</h6>
                        </td>
                        <td width="2%">
                            <h6 class="card-title">:</h6>
                        </td>
                        <td>
                            <h6 class="card-title"> <?= $info_data_permohonan->jabatan_kerja?>( <?= $info_data_permohonan->deskripsi_jabatan_kerja?> )</h6>
                        </td>
                    </tr>
                    <tr>
                        <td width="15%">
                            <h6 class="card-title">Jenis Permohonan</h6>
                        </td>
                        <td width="2%">
                            <h6 class="card-title">:</h6>
                        </td>
                        <td>
                            <h6 class="card-title"><?= $info_data_permohonan->deskripsi_jenis_permohonan;?></h6>
                        </td>
                    </tr>
                    <tr>
                        <td width="15%">
                            <h6 class="card-title">TUK</h6>
                        </td>
                        <td width="2%">
                            <h6 class="card-title">:</h6>
                        </td>
                        <td>
                            <h6 class="card-title"><?= $info_data_permohonan->kode_tuk;?> - <?= $info_data_permohonan->nama_tuk;?></h6>
                        </td>
                    </tr>
                </tbody>
            </table>
            </div>
        </div>
        <hr/>
        <!-- /Info Data Permohonan -->
        <div class="table-responsive card mb-6 py-3 border-bottom-info">
        <div class="card-header"><b>Catatan :</b></div>
        <div class="card-header">
            1. Asesor yang muncul merupakan, Asesor yang subklasifikasinya sesuai dengan Kompetensi subklasifikasi yang dimohon<br/>
            2. Asesor yang dimunculkan tidak akan lebih jenjang yang di ampu dari jenjang permohonan<br/>
            3. TUK yang dipilih merupakan TUK yang sudah divalidasi ke BNSP dan masa berlaku TUK masih aktif<br/></div>
        </div><br/>

        <form action="<?= base_url('Admin/insert_penunjukan_asesor/').base64_encode($id_izin);?>" method="POST">
            <div class="row">
                <?php
                    if($info_data_permohonan->jenjang <= '3'){
                ?>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label><b> Asesor :</b></label>
                        <select name="asesor1" id='select_box' class="form-select " style="font-size:12px;" required>
                            <option value="">Pilih Asesor</option>
                            <?php
                                foreach($get_list_asesor as $data_asesor){
                                    echo "<option value='".$data_asesor['id_asesor']."'>".$data_asesor['nama']." - ".$data_asesor['klasifikasi']."</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <?php }elseif($info_data_permohonan->jenjang >= '4'){
                ?>
                <div class="container" style="width:50%">
                    <div class="form-group">
                        <label><b> Lead Asesor :</b></label>
                        <select name="asesor1" id='select_box' class="form-select " style="font-size:12px;" required>
                            <option value="">Pilih Asesor</option>
                            <?php
                                foreach($get_list_asesor as $data_asesor){
                                    echo "<option value='".$data_asesor['id_asesor']."'>".$data_asesor['nama']." - ".$data_asesor['klasifikasi']."</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="container" style="width:50%">
                    <div class="form-group">
                        <label><b> Asesor Anggota :</b></label>
                        <select name="asesor2" id='select_box1' class="form-select " style="font-size:12px;" required>
                            <option value="">Pilih Asesor</option>
                            <?php
                                foreach($get_list_asesor as $data_asesor){
                                    echo "<option value='".$data_asesor['id_asesor']."'>".$data_asesor['nama']." - ".$data_asesor['klasifikasi']."</option>";
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <?php }?>
                <div class="container">
                    <div class="form-group">
                        <label><b> Jadwal Asesmen :</b></label>
                        <select name="kode_jadwal_asesmen" class="form-select " style="font-size:12px;" required>
                            <?php
                                foreach($get_data_jadwal_asesmen as $data_jadwal_asesmen){
                                    if($data_jadwal_asesmen['subklasifikasi'] == $info_data_permohonan->subklasifikasi){
                                        echo "<option value='".$data_jadwal_asesmen['kode_jadwal']."'>".$data_jadwal_asesmen['subklasifikasi'].' | '.$data_jadwal_asesmen['nama_tuk'].' - '.$data_jadwal_asesmen['nama_jadwal']." <b>(".$data_jadwal_asesmen['kode_jadwal'].")</b>"."</option>";
                                    }
                                }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <input type="submit" value="Tunjuk Asesor" class="btn btn-primary" onclick="return confirm('Apakah sudah Benar untuk Data Penunjukan Asesornya?')">
            </div><br/>
        </form>
    </div>
    </div>
</div>
</body>
</html>

<script>
    var select_box_element = document.querySelector('#select_box');
    dselect(select_box_element, {
        search: true
    });
</script>
<script>
    var select_box_element = document.querySelector('#select_box1');
    dselect(select_box_element, {
        search: true
    });
</script>
<script>
    var select_box_element = document.querySelector('#select_box2');
    dselect(select_box_element, {
        search: true
    });
</script>