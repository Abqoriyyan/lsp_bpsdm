<head>
    <title>Tinjau Permohonan</title>
<!-- Tab Content -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">
    <link rel="stylesheet" href="https://unpkg.com/bootstrap-material-design@4.1.1/dist/css/bootstrap-material-design.min.css" integrity="sha384-wXznGJNEXNG1NFsbm0ugrLFMQPWswR3lds2VeinahP8N0zJw9VWSopbjv2x7WCvX" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/tab-content.css');?>">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/popper.js@1.12.6/dist/umd/popper.js" integrity="sha384-fA23ZRQ3G/J53mElWqVJEGJzU0sTs+SvzG8fXVWP+kJQ1lwFAOkcUOysnlKJC33U" crossorigin="anonymous"></script>
<!-- /Tab Content -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<!-- Signature -->
    <script src="<?= base_url('assets/js/jquery-2.1.3.min.js');?>"></script> 
	<script src="<?= base_url('assets/js/bootstrap.min.js');?>" ></script> 
	<script type="text/javascript" src="<?= base_url('assets/js/signature-pad.js');?>"></script> 
<!-- Signature -->

</head>
<body>
<script>
    $(document).ready(function() {
    $('#dataTable').DataTable();
} );
</script>
    <div class="title">
        <h3>Tinjau Permohonan</h3>
    </div>
    <div class="row shadow mb-4">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12 card mb-6 py-3 border-bottom-info">
                    <div class='card-body'>
                        <h5><b>Info Data Permohonan adalah</b></h5><br/>
                            <?php
                                echo 'Nama                  : ' . $get_data_personal_permohonan[0]['nama'].'<br/>';
                                echo 'NIK                   : ' . $get_data_personal_permohonan[0]['nik'].'<br/>';
                                echo 'Kualifikasi           : ' . $info_data_permohonan->kualifikasi.' ('.$info_data_permohonan->deskripsi_kualifikasi.')<br/>';
                                echo 'Jabatan Kerja         : ' . $info_data_permohonan->jabatan_kerja.' ('.$info_data_permohonan->deskripsi_jabatan_kerja.')<br/>';
                                echo 'Jenjang               : ' . $info_data_permohonan->jenjang.'<br/>';
                                echo 'Jenis Permohonan      : ' . $info_data_permohonan->deskripsi_jenis_permohonan.'<br/>';
                            ?>
                        <h6>
                    </div>
                </div>
            </div>
            </div>
            <br/>
            <!-- Tabs with icons on Card -->
            <div class="card card-nav-tabs header-primary">
                <div class="card-header card-header-hitam">
                    <!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
                    <div class="nav-tabs-navigation">
                        <div class="nav-tabs-wrapper">
                            <ul class="nav nav-tabs" data-tabs="tabs">
                                <li class="nav-item">
                                    <a class="nav-link active" href="#administrasi" data-toggle="tab">
                                        <i class="material-icons">face</i>
                                        Administrasi
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#pendidikan" data-toggle="tab">
                                        <i class="material-icons">school</i>
                                        Pendidikan
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#proyek" data-toggle="tab">
                                        <i class="material-icons">history</i>
                                        Proyek
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#pelatihan" data-toggle="tab">
                                        <i class="material-icons">history</i>
                                        Pelatihan
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#apl01" data-toggle="tab">
                                        <i class="material-icons">history</i>
                                        Apl 01
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#klasifikasi_kualifikasi" data-toggle="tab">
                                        <i class="material-icons">build</i>
                                        Klasifikasi Kualifikasi
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body ">
                    <div class="tab-content">
                        <!------------------------ Tinjau Administrasi ------------------------------>
                        <div class="tab-pane active container" id="administrasi">
                            <h5>Personal</h5>
                            <form action="<?= base_url('Admin/insert_administrasi_tinjau_permohonan/').base64_encode($id_izin);?>" method="POST">
                                <?php
                                    foreach($get_data_personal_permohonan as $data_personal){
                                ?>
                                <table class="text" width="100%" border="0" cellspacing="0" cellpadding="3">
                                    <!-- KTP -->
                                    <tr>
                                        <td width="15%"><h5>#1</h5></td>
                                        <td width="20%" class="text-center"><br/>Tidak/Ada</td>
                                    </tr>   
                                    <tr>
                                        <td width="25%" valign="top">File KTP</td>
                                        <td width="20%" valign="top" class="text-center">
                                            <div class="custom-control custom-switch custom-switch">
                                                
                                                <input type="checkbox" class="custom-control-input" value="1" id="1a" name="ktp"
                                                <?php 
                                                    foreach($get_data_tinjau_permohonan as $data_tinjau_permohonan){
                                                        if($data_tinjau_permohonan['item_tinjau_permohonan'] == '1a' && $data_tinjau_permohonan['status'] == '1'){
                                                            echo 'checked';
                                                        }
                                                    }
                                                ?>
                                                >
                                                <label class="custom-control-label" for="1a"></label>
                                            </div>
                                        </td>
                                        <td width="15%" valign="top">
                                            <a href="<?php if(!empty($data_personal['ktp'])){
                                                    echo $data_personal['ktp'];
                                                }else{
                                                    echo base_url('errors/not_upload').'" target="_blank"';
                                                }
                                            ?>">
                                            <i class="fas fa-fw fa-eye"></i> View File</a>
                                        </td>
                                        <td width="50%" valign="top">
                                            <input type="text" class="form-control form-control-sm" name="catatan_ktp" placeholder="Catatan..."
                                            <?php 
                                                foreach($get_data_tinjau_permohonan as $data_tinjau_permohonan){
                                                    if($data_tinjau_permohonan['item_tinjau_permohonan'] == '1a'){
                                                        echo 'value="'.$data_tinjau_permohonan['catatan'].'"';
                                                    }
                                                }
                                            ?>
                                            >
                                        </td>
                                    </tr>
                                
                                    <!-- pernyataan_kebenaran_data -->
                                    <tr>
                                        <td width="15%"><h5>#2</h5></td>
                                        <td width="20%" class="text-center"><br/>Tidak/Ada</td>
                                    </tr>   
                                    <tr>
                                        <td width="25%" valign="top">Surat Pernyataan Kebenaran Data</td>
                                        <td width="20%" valign="top" class="text-center">
                                            <div class="custom-control custom-switch custom-switch">
                                                <input type="checkbox" class="custom-control-input" value="1" id="1b" name="pernyataan_kebenaran_data"
                                                <?php 
                                                    foreach($get_data_tinjau_permohonan as $data_tinjau_permohonan){
                                                        if($data_tinjau_permohonan['item_tinjau_permohonan'] == '1b' && $data_tinjau_permohonan['status'] == '1'){
                                                            echo 'checked';
                                                        }
                                                    }
                                                ?>
                                                >
                                                <label class="custom-control-label" for="1b"></label>
                                            </div>
                                        </td>
                                        <td width="15%" valign="top">
                                            <a href="<?php
                                                if(!empty($data_personal['surat_pernyataan_kebenaran_data'])){
                                                    echo $data_personal['surat_pernyataan_kebenaran_data'];
                                                }else{
                                                    echo base_url('errors/not_upload').'" target="_blank"';
                                                }
                                            ?>">
                                            <i class="fas fa-fw fa-eye"></i> View File</a>
                                        </td>
                                        <td width="50%" valign="top">
                                            <input type="text" class="form-control form-control-sm" name="catatan_pernyataan_kebenaran_data" placeholder="Catatan..."
                                            <?php 
                                                foreach($get_data_tinjau_permohonan as $data_tinjau_permohonan){
                                                    if($data_tinjau_permohonan['item_tinjau_permohonan'] == '1b'){
                                                        echo 'value="'.$data_tinjau_permohonan['catatan'].'"';
                                                    }
                                                }
                                            ?>
                                            >
                                        </td>
                                    </tr>

                                    <!-- npwp -->
                                    <tr>
                                        <td width="15%"><h5>#3</h5></td>
                                        <td width="20%" class="text-center"><br/>Tidak/Ada</td>
                                    </tr>   
                                    <tr>
                                        <td width="25%" valign="top">File NPWP</td>
                                        <td width="20%" valign="top" class="text-center">
                                            <div class="custom-control custom-switch custom-switch">
                                                <input type="checkbox" class="custom-control-input" value="1" id="1c" name="npwp"
                                                <?php 
                                                    foreach($get_data_tinjau_permohonan as $data_tinjau_permohonan){
                                                        if($data_tinjau_permohonan['item_tinjau_permohonan'] == '1c' && $data_tinjau_permohonan['status'] == '1'){
                                                            echo 'checked';
                                                        }
                                                    }
                                                ?>
                                                >
                                                <label class="custom-control-label" for="1c"></label>
                                            </div>
                                        </td>
                                        <td width="15%" valign="top">
                                            <a href="<?php 
                                                if(!empty($data_personal['file_npwp'])){
                                                    echo $data_personal['file_npwp'].'" target="_blank"';
                                                }else{
                                                    echo base_url('errors/not_upload').'" target="_blank"';
                                                }
                                            ?>">
                                            <i class="fas fa-fw fa-eye"></i> View File</a>
                                        </td>
                                        <td width="50%" valign="top">
                                            <input type="text" class="form-control form-control-sm" name="catatan_npwp" placeholder="Catatan..."
                                            <?php 
                                                foreach($get_data_tinjau_permohonan as $data_tinjau_permohonan){
                                                    if($data_tinjau_permohonan['item_tinjau_permohonan'] == '1c'){
                                                        echo 'value="'.$data_tinjau_permohonan['catatan'].'"';
                                                    }
                                                }
                                            ?>
                                            >
                                        </td>
                                    </tr>

                                    <!-- Pas Foto -->
                                    <tr>
                                        <td width="15%"><h5>#4</h5></td>
                                        <td width="20%" class="text-center"><br/>Tidak/Ada</td>
                                    </tr>   
                                    <tr style="border-bottom:3px solid #111;">
                                        <td width="25%" valign="top">Pas Foto</td>
                                        <td width="20%" valign="top" class="text-center">
                                            <div class="custom-control custom-switch custom-switch">
                                                <input type="checkbox" class="custom-control-input" value="1" id="1d" name="pas_foto"
                                                <?php 
                                                    foreach($get_data_tinjau_permohonan as $data_tinjau_permohonan){
                                                        if($data_tinjau_permohonan['item_tinjau_permohonan'] == '1d' && $data_tinjau_permohonan['status'] == '1'){
                                                            echo 'checked';
                                                        }
                                                    }
                                                ?>
                                                >
                                                <label class="custom-control-label" for="1d"></label>
                                            </div>
                                        </td>
                                        <td width="15%" valign="top">
                                            <a href="<?php
                                                if(!empty($data_personal['pas_foto'])){
                                                    echo $data_personal['pas_foto'].'" target="_blank"';
                                                }else{
                                                    echo base_url('errors/not_upload').'" target="_blank"';
                                                }
                                            ?>">
                                            <i class="fas fa-fw fa-eye"></i> View File</a>
                                        </td>
                                        <td width="50%" valign="top">
                                            <input type="text" class="form-control form-control-sm" name="catatan_pas_foto" placeholder="Catatan..."
                                            <?php 
                                                foreach($get_data_tinjau_permohonan as $data_tinjau_permohonan){
                                                    if($data_tinjau_permohonan['item_tinjau_permohonan'] == '1d'){
                                                        echo 'value="'.$data_tinjau_permohonan['catatan'].'"';
                                                    }
                                                }
                                            ?>
                                            >
                                            <br/>
                                        </td>
                                    </tr>
                                    <?php 
                                        }
                                    ?>
                                </table>
                                <!-- Ceklis Administrasi -->
                                <table class="text" width="100%" border="0" cellspacing="0" cellpadding="3">
                                    <tr>
                                        <td width="15%"><br/><h5>#CEKLIS</h5></td>
                                        <td width="20%" class="text-center"><br/><br/>Tidak/Lengkap</td>
                                    </tr>   
                                    <tr style="border-bottom:3px solid #111;">
                                        <td width="20%" valign="top">Administrasi</td>
                                        <td width="20%" valign="top" class="text-center">
                                            <div class="custom-control custom-switch custom-switch">
                                                <input type="checkbox" class="custom-control-input" value="1" id="1" name="ceklis_administrasi"
                                                <?php 
                                                    foreach($get_data_tinjau_permohonan as $data_tinjau_permohonan){
                                                        if($data_tinjau_permohonan['item_tinjau_permohonan'] == '1' && $data_tinjau_permohonan['status'] == '1'){
                                                            echo 'checked';
                                                        }
                                                    }
                                                ?>
                                                >
                                                <label class="custom-control-label" for="1"></label>
                                            </div>
                                        </td>
                                        <td width="55%" valign="top">
                                            <input type="text" class="form-control form-control-sm" name="catatan_ceklis_administrasi" placeholder="Catatan..."
                                            <?php 
                                                foreach($get_data_tinjau_permohonan as $data_tinjau_permohonan){
                                                    if($data_tinjau_permohonan['item_tinjau_permohonan'] == '1'){
                                                        echo 'value="'.$data_tinjau_permohonan['catatan'].'"';
                                                    }
                                                }
                                            ?>
                                            >
                                            <br/>
                                        </td>
                                    </tr>
                                </table>

                            <div><br/>
                                <h5>Data Administrasi Pemohon</h5>
                                <table class="text" width="100%" border="0" cellspacing="0" cellpadding="3">
                                    <?php
                                        $no = 1;
                                        foreach ($get_data_personal_permohonan as $data_personal_permohonan){
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
                                        <td width="78%" valign="top"><?php echo $data_personal_permohonan['alamat']?></td>
                                    </tr>
                                    <tr>
                                        <td width="20%" valign="top">Propinsi</td>
                                        <td width="2%" valign="top" align="center">:</td>
                                        <td width="78%" valign="top"><?= $data_personal_permohonan['deskripsi_propinsi'];?></td>
                                    </tr>
                                    <tr>
                                        <td width="20%" valign="top">Kota/Kabupaten</td>
                                        <td width="2%" valign="top" align="center">:</td>
                                        <td width="78%" valign="top"><?= $data_personal_permohonan['deskripsi_kabupaten'];?></td>
                                    </tr>
                                    <tr>
                                        <td width="20%" valign="top">Kode Pos</td>
                                        <td width="2%" valign="top" align="center">:</td>
                                        <td width="78%" valign="top"><?php echo $data_personal_permohonan['kodepos']?></td>
                                    </tr>
                                    <tr>
                                        <td width="20%" valign="top">Tempat, Tanggal Lahir</td>
                                        <td width="2%" valign="top" align="center">:</td>
                                        <td width="78%" valign="top"><?php echo $data_personal_permohonan['tempat_lahir'].', '.$data_personal_permohonan['tanggal_lahir'] ?></td>
                                    </tr>
                                    <tr>
                                        <td width="20%" valign="top">Jenis Kelamin</td>
                                        <td width="2%" valign="top" align="center">:</td>
                                        <td width="78%" valign="top"><?php echo $data_personal_permohonan['jenis_kelamin']?></td>
                                    </tr>
                                    <?php
                                        }
                                    ?>
                                </table>
                                <input type="submit" value="Simpan" class="btn btn-default" style="float:right; background-color:#0295da; color:#fff;"/>
                                </form>
                            </div>
                        </div>
                        <!------------------------ /Tinjau Administrasi ------------------------------>


                        <!------------------------ Tinjau Pendidikan ------------------------------>
                        <div class="tab-pane" id="pendidikan">
                        <h5>Pendidikan</h5>
                        <p>Data Pendidikan <?php echo $data_personal_permohonan['nama'] ?></p>
                        <table class="table-responsive table table-bordered" id="dataTable" width="100%" border="1" cellspacing="0" cellpadding="3">
                            <tr>
                                <td width="5%" class="text-center"><b>Jenjang</b></td>
                                <td width="20%" class="text-center"><b>Nama Perguruan</b></td>
                                <td width="20%" class="text-center"><b>Program Studi</b></td>
                                <td width="10%" class="text-center"><b>Tahun Lulusan</b></td>
                                <td width="20%" class="text-center"><b>Scan Ijazah Legalisir</b></td>
                                <td width="20%" class="text-center"><b>Scan Surat Keterangan</b></td>
                            </tr>   
                            <?php
                                $no = 1;
                                foreach ($get_data_pendidikan_permohonan as $data_pendidikan){
                            ?>
                            <tr>
                                <td class="text-center"><?= $data_pendidikan['deskripsi_jenjang'];?> 
                                </td>
                                <td><?php echo $data_pendidikan['nama_sekolah_perguruan_tinggi'];?></td>
                                <td class="text-center"><?php echo $data_pendidikan['program_studi'];?></td>
                                <td class="text-center"><?php echo $data_pendidikan['tahun_lulus'];?></td>
                                <td class="text-center">
                                    <a href="<?php
                                        if(!empty($data_pendidikan['scan_ijazah_legalisir'])){
                                            echo $data_pendidikan['scan_ijazah_legalisir'].'" target="_blank"';
                                        }else{
                                            echo base_url('errors/not_upload').'" target="_blank"';
                                        }
                                        ?>">
                                    <i class="fas fa-fw fa-eye"></i> View File</a>
                                </td>
                                <td class="text-center">
                                    <a href="<?php
                                        if(!empty($data_pendidikan['scan_surat_keterangan'])){
                                            echo $data_pendidikan['scan_surat_keterangan'].'" target="_blank"';
                                        }else{
                                            echo base_url('errors/not_upload').'" target="_blank"';
                                        }
                                        ?>">
                                    <i class="fas fa-fw fa-eye"></i> View File</a>
                                </td>
                            </tr>
                            <?php
                                }
                            ?>
                        </table>
                        <hr style="border-bottom:3px solid #111;"/>
                        <br/>
                            <form action="<?= base_url('Admin/insert_pendidikan_tinjau_permohonan/').base64_encode($id_izin);?>" method="POST">
                                <div class="col-sm-12">
                                <div class="input-group mb-3">
                                    <!-- Pilih Jenjang yang Sesuai dengan kompetensi -->
                                    <div class="input-group-prepend">
                                        <label class="input-group-text"><b>Pilih Jenjang Pendidikan Terakhir yang Sesuai dengan Kompetensi Permohonan</b> &nbsp;&nbsp;&nbsp;</label>
                                    </div>
                                    <select class="custom-select" name="jenjang_yang_sesuai" value="4" required>
                                        <option value=''>Pilih Jenjang...</option>
                                        <?php
                                            foreach($get_data_pendidikan_permohonan as $data_pendidikan){
                                        ?>
                                            <option value="<?=$data_pendidikan['id']?>"
                                                <?php
                                                    if(!empty($data_pendidikan_yang_sudah_dipilih->jenjang_yang_sesuai) && $data_pendidikan_yang_sudah_dipilih->jenjang_yang_sesuai == $data_pendidikan['id']){
                                                        echo 'selected';
                                                    }else{
                                                        echo '';
                                                    }
                                                ?>
                                            ><?=$data_pendidikan['deskripsi_jenjang'].' ('.$data_pendidikan['nama_sekolah_perguruan_tinggi'].' - '.$data_pendidikan['program_studi'].")"?></option>';
                                        <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                            
                                
                                    
                                    <table class="text" width="100%" border="0" cellspacing="0" cellpadding="3">
                                        <!-- Scan Ijazah -->
                                        <tr>
                                            <td width="15%"><h5>#1</h5></td>
                                            <td width="20%" class="text-center"><br/>Tidak/Ada</td>
                                        </tr>   
                                        <tr>
                                            <td width="20%" valign="top">Scan Ijazah Legalisir</td>
                                            <td width="20%" valign="top" class="text-center">
                                                <div class="custom-control custom-switch custom-switch">
                                                    <input type="checkbox" class="custom-control-input" value="1" id="2a" name="scan_ijazah_legalisir"
                                                    <?php 
                                                    foreach($get_data_tinjau_permohonan as $data_tinjau_permohonan){
                                                        if($data_tinjau_permohonan['item_tinjau_permohonan'] == '2a' && $data_tinjau_permohonan['status'] == '1'){
                                                            echo 'checked';
                                                        }
                                                    }
                                                    ?>
                                                    >
                                                    <label class="custom-control-label" for="2a"></label>
                                                </div>
                                            </td>
                                            <td width="55%" valign="top">
                                                <input type="text" class="form-control form-control-sm" name="catatan_scan_ijazah_legalisir" placeholder="Catatan..."
                                                <?php 
                                                foreach($get_data_tinjau_permohonan as $data_tinjau_permohonan){
                                                    if($data_tinjau_permohonan['item_tinjau_permohonan'] == '2a'){
                                                        echo 'value="'.$data_tinjau_permohonan['catatan'].'"';
                                                    }
                                                }
                                                ?>
                                                >
                                            </td>
                                        </tr>

                                        <!-- Scan Surat Keterangan Pendidikan -->
                                        <tr>
                                            <td width="15%"><h5>#2</h5></td>
                                            <td width="20%" class="text-center"><br/>Tidak/Ada</td>
                                        </tr>   
                                        <tr style="border-bottom:3px solid #111;">
                                            <td width="20%" valign="top">Scan Surat Keterangan</td>
                                            <td width="20%" valign="top" class="text-center">
                                                <div class="custom-control custom-switch custom-switch">
                                                    <input type="checkbox" class="custom-control-input" value="1" id="2b" name="scan_surat_keterangan_pendidikan"
                                                    <?php 
                                                    foreach($get_data_tinjau_permohonan as $data_tinjau_permohonan){
                                                        if($data_tinjau_permohonan['item_tinjau_permohonan'] == '2b' && $data_tinjau_permohonan['status'] == '1'){
                                                            echo 'checked';
                                                        }
                                                    }
                                                    ?>
                                                    >
                                                    <label class="custom-control-label" for="2b"></label>
                                                </div>
                                            </td>
                                            <td width="55%" valign="top">
                                                <input type="text" class="form-control form-control-sm" name="catatan_scan_surat_keterangan_pendidikan" placeholder="Catatan..."
                                                <?php 
                                                foreach($get_data_tinjau_permohonan as $data_tinjau_permohonan){
                                                    if($data_tinjau_permohonan['item_tinjau_permohonan'] == '2b'){
                                                        echo 'value="'.$data_tinjau_permohonan['catatan'].'"';
                                                    }
                                                }
                                                ?>
                                                >
                                                <br/>
                                            </td>
                                        </tr>
                                    </table>
                                    <!-- Ceklis Pendidikan -->
                                    <table class="text" width="100%" border="0" cellspacing="0" cellpadding="3">
                                        <tr>
                                            <td width="15%"><br/><h5>#CEKLIS</h5></td>
                                            <td width="20%" class="text-center"><br/><br/>Tidak/Lengkap</td>
                                        </tr>   
                                        <tr>
                                            <td width="20%" valign="top">Pendidikan</td>
                                            <td width="20%" valign="top" class="text-center">
                                                <div class="custom-control custom-switch custom-switch">
                                                    <input type="checkbox" class="custom-control-input" value="1" id="2" name="ceklis_pendidikan"
                                                    <?php 
                                                    foreach($get_data_tinjau_permohonan as $data_tinjau_permohonan){
                                                        if($data_tinjau_permohonan['item_tinjau_permohonan'] == '2' && $data_tinjau_permohonan['status'] == '1'){
                                                            echo 'checked';
                                                        }
                                                    }
                                                    ?>
                                                    >
                                                    <label class="custom-control-label" for="2"></label>
                                                </div>
                                            </td>
                                            <td width="55%" valign="top">
                                                <input type="text" class="form-control form-control-sm" name="catatan_ceklis_pendidikan" placeholder="Catatan..."
                                                <?php 
                                                foreach($get_data_tinjau_permohonan as $data_tinjau_permohonan){
                                                    if($data_tinjau_permohonan['item_tinjau_permohonan'] == '2'){
                                                        echo 'value="'.$data_tinjau_permohonan['catatan'].'"';
                                                    }
                                                }
                                                ?>
                                                >
                                                <br/>
                                            </td>
                                        </tr>
                                    </table>
                                    <br/>
                                    <input type="submit" value="Simpan" class="btn btn-default" style="float:right; background-color:#0295da; color:#fff;"/>
                                </div>
                            </form>
                        </div>
                        <!------------------------ /Tinjau Pendidikan ------------------------------>
              
                        <!------------------------ Tinjau Proyek ------------------------------>
                        <div class="tab-pane" id="proyek">
                        <h5>Proyek</h5>
                            <form action="<?= base_url('Admin/insert_proyek_tinjau_permohonan/').base64_encode($id_izin);?>" method="POST">
                                <div class="col-sm-12">
                                    <!-- Data Proyek / Pengalaman -->
                                    <p>Data Proyek <?= $data_personal_permohonan['nama'] ?></p>
                                    <table class="table-responsive table table-bordered" id="dataTable" width="100%" border="1" cellspacing="0" cellpadding="3">
                                        <tr>
                                            <td width="2%" class="text-center"><b>No</b></td>
                                            <td width="13%" class="text-center"><b>Nama Proyek</b></td>
                                            <td width="5%" class="text-center"><b>Jabatan</b></td>
                                            <td width="10%" class="text-center"><b>Nilai Proyek</b></td>
                                            <td width="10%" class="text-center"><b>Lama Proyek</b></td>
                                            <td width="20%" class="text-center"><b>Surat Referensi</b></td>
                                            <td width="10%" class="text-center"><b>Input Catatan</b></td>
                                            <td width="10%" class="text-center"><b>Jenis Pengalaman</b></td>
                                        </tr> 
                                        <?php
                                        
                                        // Keperluan No urut agar input data proyek dynamic
                                            $i = 1;
                                            $no = 1;

                                        foreach($get_data_proyek_permohonan as $data_proyek){
                                        ?>
                                        <tr>
                                            <td class="text-center"><?php echo $no++; ?></td>
                                            <td><?php echo $data_proyek['nama_proyek'];?></td>
                                            <td class="text-center"><?php echo $data_proyek['jabatan'];?></td>
                                            <td class="text-center">
                                                <?php 
                                                    if(!empty($data_proyek['nilai_proyek'])){
                                                        echo 'Rp. '.number_format($data_proyek['nilai_proyek'],0,',','.');
                                                    }else{
                                                        echo '0';
                                                    }
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <?php

                                                ## Berapa lama proyek ke Bulan
                                                $ts1 = strtotime($data_proyek['tanggal_awal']);
                                                $ts2 = strtotime($data_proyek['tanggal_akhir']);

                                                $year1 = date('Y', $ts1);
                                                $year2 = date('Y', $ts2);

                                                $month1 = date('m', $ts1);
                                                $month2 = date('m', $ts2);

                                                $bulan = (($year2 - $year1) * 12) + ($month2 - $month1);
                                               
                                                ## Berapa lama proyek ke Hari
                                                $startDate = new DateTime($data_proyek['tanggal_awal']);
                                                $endDate = new DateTime($data_proyek['tanggal_akhir']);

                                                $hari = $endDate->diff($startDate);
                                                
                                                #Output
                                                echo $hari->format("%a").' hari ( '.$bulan.' bulan )';
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <a href="<?php 
                                                    if(!empty($data_proyek['surat_referensi'])){
                                                        echo $data_proyek['surat_referensi'].'" target="_blank"';
                                                    }else{
                                                        echo base_url('errors/not_upload').'" target="_blank"';
                                                    }
                                                    ?>">
                                                <i class="fas fa-fw fa-eye"></i> View File</a>
                                                <center>
                                                <div class="custom-control custom-switch custom-switch">
                                                    <input type="checkbox" class="custom-control-input" value="1" id="3a<?= $i;?>" name="surat_referensi_proyek[<?php echo $i;?>]"
                                                    <?php 
                                                    foreach($get_data_tinjau_permohonan as $data_tinjau_permohonan){
                                                        if($data_tinjau_permohonan['item_tinjau_permohonan'] == '3a'.$i && $data_tinjau_permohonan['status'] == '1'){
                                                            echo 'checked';
                                                        }
                                                    }
                                                    ?>
                                                    >
                                                    <label class="custom-control-label" for="3a<?php echo $i;?>">Tidak/Ada</label>
                                                    <br/>       
                                                </div>
                                                </center>
                                                <input type="hidden" name="kode_item[<?php echo $i;?>]" value="3a<?php echo $i;?>" />
                                                <input type="hidden" name="id_proyek[<?php echo $i;?>]" value="<?php echo $data_proyek['id'];?>" />
                                            </td>
                                            <td>
                                                <input type="text" class="form-control form-control-sm"  name="catatan_surat_referensi_proyek[<?= $i;?>]" placeholder="Catatan..."
                                                <?php 
                                                foreach($get_data_tinjau_permohonan as $data_tinjau_permohonan){
                                                    if($data_tinjau_permohonan['item_tinjau_permohonan'] == '3a'.$i){
                                                        echo 'value="'.$data_tinjau_permohonan['catatan'].'"';
                                                    }
                                                }
                                                ?>
                                                >
                                            </td>
                                            <td class="text-center"><?php echo $data_proyek['jenis_pengalaman'];?></td>
                                        </tr>
                                        <?php
                                            $i++;
                                            }
                                        ?>
                                        <input type="hidden" name="count" value="<?php echo $i; ?>" />

                                        <!-- Total -->
                                        <tr>
                                            <td class="text-center" colspan="3"><b>Total</b></td>
                                            <td class="text-center"  style="font-weight:bold;">
                                                <?php
                                                    $sum_nilai_proyek = 0;
                                                    foreach($get_data_proyek_permohonan as $data_proyek){
                                                        if(empty($data_proyek['nilai_proyek'])){
                                                           $data_proyek['nilai_proyek'] = 0; 
                                                        }
                                                        $sum_nilai_proyek+= $data_proyek['nilai_proyek'];
                                                    }
                                                    echo 'Rp. '.number_format($sum_nilai_proyek,0,',','.');
                                                ?>
                                            </td>
                                            <td class="text-center" style="font-weight:bold;">
                                                <?php
                                                    $sum_hari = 0;
                                                    foreach($get_data_proyek_permohonan as $data_proyek){
                                                        ## Berapa lama proyek ke Hari
                                                        $startDate = new DateTime($data_proyek['tanggal_awal']);
                                                        $endDate = new DateTime($data_proyek['tanggal_akhir']);

                                                        $difference = $endDate->diff($startDate);
                                                        $sum_hari+= $difference->format("%a");
                                                    }
                                                    #Output
                                                    echo $sum_hari.' hari '.'( '. Floor($sum_hari / 30) .' bulan )';
                                                ?>
                                            </td>
                                        </tr>
                                    </table>

                                    <br/><hr style="border-bottom:3px solid #111;"/>
                                    <!-- Ceklis Proyek -->
                                    <table class="text" width="100%" border="0" cellspacing="0" cellpadding="3">
                                        <tr>
                                            <td width="15%"><br/><h5>#CEKLIS</h5></td>
                                            <td width="20%" class="text-center"><br/><br/>Tidak/Lengkap</td>
                                        </tr>   
                                        <tr style="border-bottom:3px solid #111;">
                                            <td width="20%" valign="top">Proyek</td>
                                            <td width="20%" valign="top" class="text-center">
                                                <div class="custom-control custom-switch custom-switch">
                                                    <input type="checkbox" class="custom-control-input" value="1" id="3" name="ceklis_proyek"
                                                    <?php 
                                                    foreach($get_data_tinjau_permohonan as $data_tinjau_permohonan){
                                                        if($data_tinjau_permohonan['item_tinjau_permohonan'] == '3' && $data_tinjau_permohonan['status'] == '1'){
                                                            echo 'checked';
                                                        }
                                                    }
                                                    ?>
                                                    >
                                                    <label class="custom-control-label" for="3"></label>
                                                </div>
                                            </td>
                                            <td width="55%" valign="top">
                                                <input type="text" class="form-control form-control-sm" name="catatan_ceklis_proyek" placeholder="Catatan..."
                                                <?php 
                                                foreach($get_data_tinjau_permohonan as $data_tinjau_permohonan){
                                                    if($data_tinjau_permohonan['item_tinjau_permohonan'] == '3'){
                                                        echo 'value="'.$data_tinjau_permohonan['catatan'].'"';
                                                    }
                                                }
                                                ?>
                                                >
                                                <br/>
                                            </td>
                                        </tr>
                                    </table>
                                    <br/>
                                    <input type="submit" name="submit" value="Simpan" class="btn btn-default" style="float:right; background-color:#0295da; color:#fff;"/>
                                </div>
                            </form>
                        </div>
                        <!------------------------/ Tinjau Proyek ------------------------------>

                        <!------------------------ Tinjau Pelatihan ------------------------------>
                        <div class="tab-pane" id="pelatihan">
                        <h5>Pelatihan</h5>
                            <form action="<?= base_url('Admin/insert_pelatihan_tinjau_permohonan/').base64_encode($id_izin);?>" method="POST">
                                <div class="col-sm-12">
                                    <!-- Ceklis Pelatihan -->
                                    <table class="text" width="100%" border="0" cellspacing="0" cellpadding="3">
                                        <tr>
                                            <td width="15%"><br/><h5>#CEKLIS</h5></td>
                                            <td width="20%" class="text-center"><br/><br/>Tidak/Lengkap</td>
                                        </tr>   
                                        <tr style="border-bottom:3px solid #111;">
                                            <td width="20%" valign="top">Pelatihan</td>
                                            <td width="20%" valign="top" class="text-center">
                                                <div class="custom-control custom-switch custom-switch">
                                                    <input type="checkbox" class="custom-control-input" value="1" id="4" name="ceklis_pelatihan"
                                                    <?php 
                                                    foreach($get_data_tinjau_permohonan as $data_tinjau_permohonan){
                                                        if($data_tinjau_permohonan['item_tinjau_permohonan'] == '4' && $data_tinjau_permohonan['status'] == '1'){
                                                            echo 'checked';
                                                        }
                                                    }
                                                    ?>
                                                    >
                                                    <label class="custom-control-label" for="4"></label>
                                                </div>
                                            </td>
                                            <td width="55%" valign="top">
                                                <input type="text" class="form-control form-control-sm" name="catatan_ceklis_pelatihan" placeholder="Catatan..."
                                                <?php 
                                                foreach($get_data_tinjau_permohonan as $data_tinjau_permohonan){
                                                    if($data_tinjau_permohonan['item_tinjau_permohonan'] == '4'){
                                                        echo 'value="'.$data_tinjau_permohonan['catatan'].'"';
                                                    }
                                                }
                                                ?>
                                                >
                                                <br/>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <br/>
                                <p>Data Pelatihan <?php echo $data_personal_permohonan['nama'] ?></p>
                                    <table class="table-responsive table table-bordered" id="dataTable" width="100%" border="1" cellspacing="0" cellpadding="3">
                                        <tr>
                                            <td class="text-center col-sm-1"><b>No</b></td>
                                            <td class="text-center col-sm-3"><b>Penyelenggara</b></td>
                                            <td class="text-center col-sm-3"><b>Nama Pelatihan</b></td>
                                            <td class="text-center col-sm-1"><b>Jumlah JP</b></td>
                                            <td class="text-center col-sm-1"><b>Lama Pelatihan</b></td>
                                            <td class="text-center col-sm-3"><b>File Sertifikat</b></td>
                                        </tr> 
                                        <?php
                                            $no = 1;
                                            foreach($get_data_pelatihan_permohonan as $data_pelatihan){
                                        ?>      
                                        <tr>
                                            <td width="2%" class="text-center"><?php echo $no++;?></td>
                                            <td width="15%" class="text-center"><?php echo $data_pelatihan['penyelenggara'];?></td>
                                            <td width="33%" class="text-center"><?php echo $data_pelatihan['nama_pelatihan'];?></td>
                                            <td width="10%" class="text-center"><?php echo $data_pelatihan['jumlah_jp'];?></td>
                                            <td width="10%" class="text-center"><?php echo $data_pelatihan['jumlah_hari'].' Hari';?></td>
                                            <td width="30%"  class="text-center">
                                                <a href="<?php
                                                    if(!empty($data_pelatihan['file_sertifikat'])){
                                                        echo $data_pelatihan['file_sertifikat'].'" target="_blank"';
                                                    }else{
                                                        echo base_url('errors/not_upload').'" target="_blank"';
                                                    }
                                                ?>">
                                                <i class="fas fa-fw fa-eye"></i> View File</a>
                                            </td>
                                        </tr>
                                        <?php
                                            }
                                        ?>
                                    </table>
                                    <br/>
                                <input type="submit" value="Simpan" class="btn btn-default" style="float:right; background-color:#0295da; color:#fff;"/>
                            </form>
                        </div>
                        <!------------------------ /Tinjau Pelatihan ------------------------------>

                        <!------------------------ Tinjau APl ------------------------------>
                        <div class="tab-pane" id="apl01">
                        <h5>Keperluan Form APL 01</h5>
                            <form action="<?= base_url('Admin/insert_apl01_tinjau_permohonan/').base64_encode($id_izin)?>" method="POST">
                                <div class="col-sm-12">

                                    <table class="text" width="100%" border="0" cellspacing="0" cellpadding="3">
                                    <!-- Tujuan Asesment APL 01 -->
                                        <tr>
                                            <td width="15%"><br/><h5>#1</h5></td>
                                        </tr>   
                                        <tr>
                                            <td width="20%" valign="top">Tujuan Asesmen</td>
                                            <td width="30%" valign="top" class="text-center">
                                                <div class="form-group">
                                                    <select class="form-control" name="tujuan_asesment">
                                                        <option <?php if($get_data_apl01->tujuan_asesment == 'Sertifikasi'){echo 'selected';}?>>Sertifikasi</option>
                                                        <option <?php if($get_data_apl01->tujuan_asesment == 'Sertifikasi Ulang'){echo 'selected';}?>>Sertifikasi Ulang</option>
                                                    </select>
                                                </div>
                                            </td>
                                            <td width="35%"> </td>
                                        </tr>
                                    <!-- Persyaratan Kompetensi APL 01 -->
                                        <tr>
                                            <td width="15%"><br/><h5>#2</h5></td>
                                            <td width="50%"><br/>Persyaratan Kompetensi yang dipilih</td>
                                            <td width="15%"><br/>Nilai Persyaratan Kompetensi</td>
                                        </tr>   
                                        <tr style="border-bottom:3px solid #111;">
                                            <td width="20%" valign="top">Bukti Kelengkapan Pemohon - Persyaratan Dasar</td>
                                            <td width="50%" valign="top" class="text-center">
                                                <div class="form-group">
                                                    <select class="form-control" name="id_persyaratan_kompeten" required>
                                                    <?php 
                                                        foreach($option_persyaratan_kompetensi_apl01 as $option_persyaratan_kompetensi){
                                                            echo $option_persyaratan_kompetensi['persyaratan_pendidikan'];
                                                    ?>
                                                        <option value="<?php echo $option_persyaratan_kompetensi['id_persyaratan_kompeten'];?>"
                                                            <?php
                                                                if($option_persyaratan_kompetensi['id_persyaratan_kompeten'] == $get_data_apl01->id_persyaratan_kompeten){
                                                                    echo 'selected';
                                                                }
                                                            ?>
                                                        ><?php echo $option_persyaratan_kompetensi['persyaratan_pendidikan'] .' ( Pengalaman '. $option_persyaratan_kompetensi['persyaratan_pengalaman_proyek'] .' )';?></option>
                                                    <?php 
                                                        }
                                                    ?>
                                                    </select>
                                                </div>
                                            </td>
                                            <td width="15%">
                                                <div class="form-group">
                                                    <select class="form-control" name="status_persyaratan_kompeten" required>
                                                        <option value="">Pilih Pernyataan</option>
                                                        <option <?php if($get_data_apl01->status_persyaratan_kompeten == 'Ada (Memenuhi Syarat)'){echo 'selected';}?>>Ada (Memenuhi Syarat)</option>
                                                        <option <?php if($get_data_apl01->status_persyaratan_kompeten == 'Ada (Tidak Memenuhi Syarat)'){echo 'selected';}?>>Ada (Tidak Memenuhi Syarat)</option>
                                                        <option <?php if($get_data_apl01->status_persyaratan_kompeten == 'Tidak Ada'){echo 'selected';}?>>Tidak Ada</option>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- KTP Apl 01 -->
                                        <tr>
                                            <td width="15%"><br/><h5>#3</h5></td>
                                            <td width="50%"><br/></td>
                                            <td width="15%"><br/>Bukti Kelengkapan</td>
                                        </tr>   
                                        <tr style="border-bottom:3px solid #111;">
                                            <td width="20%" valign="top">KTP</td>
                                            <td width="50%" valign="top">
                                                <div class="form-group">
                                                    <a href="<?php if(!empty($data_personal['ktp'])){
                                                            echo $data_personal['ktp'];
                                                        }else{
                                                            echo base_url('errors/not_upload').'" target="_blank"';
                                                        }
                                                    ?>">
                                                    <i class="fas fa-fw fa-eye"></i> View File</a>
                                                </div>
                                            </td>
                                            <td width="15%">
                                                <div class="form-group">
                                                    <select class="form-control" name="status_ktp" required>
                                                        <option value="">Pilih Pernyataan</option>
                                                        <option <?php if($get_data_apl01->status_ktp == 'Ada (Memenuhi Syarat)'){echo 'selected';}?>>Ada (Memenuhi Syarat)</option>
                                                        <option <?php if($get_data_apl01->status_ktp == 'Ada (Tidak Memenuhi Syarat)'){echo 'selected';}?>>Ada (Tidak Memenuhi Syarat)</option>
                                                        <option <?php if($get_data_apl01->status_ktp == 'Tidak Ada'){echo 'selected';}?>>Tidak Ada</option>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        <!-- Pas Foto Apl 01 -->
                                        <tr>
                                            <td width="15%"><br/><h5>#4</h5></td>
                                            <td width="50%"><br/></td>
                                            <td width="15%"><br/>Bukti Kelengkapan</td>
                                        </tr>   
                                        <tr style="border-bottom:3px solid #111;">
                                            <td width="20%" valign="top">Pas Foto</td>
                                            <td width="50%" valign="top">
                                                <div class="form-group">
                                                    <a href="<?php
                                                    if(!empty($data_personal['pas_foto'])){
                                                        echo $data_personal['pas_foto'].'" target="_blank"';
                                                    }else{
                                                        echo base_url('errors/not_upload').'" target="_blank"';
                                                    }
                                                    ?>">
                                                <i class="fas fa-fw fa-eye"></i> View File</a>
                                                </div>
                                            </td>
                                            <td width="15%">
                                                <div class="form-group">
                                                    <select class="form-control" name="status_pas_foto" required>
                                                        <option value="">Pilih Pernyataan</option>
                                                        <option <?php if($get_data_apl01->status_pas_foto == 'Ada (Memenuhi Syarat)'){echo 'selected';}?>>Ada (Memenuhi Syarat)</option>
                                                        <option <?php if($get_data_apl01->status_pas_foto == 'Ada (Tidak Memenuhi Syarat)'){echo 'selected';}?>>Ada (Tidak Memenuhi Syarat)</option>
                                                        <option <?php if($get_data_apl01->status_pas_foto == 'Tidak Ada'){echo 'selected';}?>>Tidak Ada</option>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <br/>
                                <h5> Referensi Pendidikan dan Pengalaman Proyek</h5>
                                <br/>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <p style="font-weight:bold;">Data Pendidikan</p>
                                        <table class="table-responsive table table-bordered" id="dataTable" width="100%" border="1" cellspacing="0" cellpadding="3">
                                            <tr>
                                                <td width="5%" class="text-center"><b>Jenjang</b></td>
                                                <td width="20%" class="text-center"><b>Nama Perguruan</b></td>
                                                <td width="20%" class="text-center"><b>Program Studi</b></td>
                                                <td width="10%" class="text-center"><b>Tahun Lulusan</b></td>
                                                <td width="20%" class="text-center"><b>Scan Ijazah Legalisir</b></td>
                                                <td width="20%" class="text-center"><b>Scan Surat Keterangan</b></td>
                                            </tr>   
                                            <?php
                                                $no = 1;
                                                foreach ($get_data_pendidikan_permohonan as $data_pendidikan){
                                            ?>
                                            <tr>
                                                <td class="text-center"><?= $data_pendidikan['deskripsi_jenjang']?></td>
                                                <td><?php echo $data_pendidikan['nama_sekolah_perguruan_tinggi'];?></td>
                                                <td class="text-center"><?php echo $data_pendidikan['program_studi'];?></td>
                                                <td class="text-center"><?php echo $data_pendidikan['tahun_lulus'];?></td>
                                                <td class="text-center">
                                                    <a href="<?php
                                                        if(!empty($data_pendidikan['scan_ijazah_legalisir'])){
                                                            echo $data_pendidikan['scan_ijazah_legalisir'].'" target="_blank"';
                                                        }else{
                                                            echo base_url('errors/not_upload').'" target="_blank"';
                                                        }
                                                        ?>">
                                                    <i class="fas fa-fw fa-eye"></i> View File</a>
                                                </td>
                                                <td class="text-center">
                                                    <a href="<?php
                                                        if(!empty($data_pendidikan['scan_surat_keterangan'])){
                                                            echo $data_pendidikan['scan_surat_keterangan'].'" target="_blank"';
                                                        }else{
                                                            echo base_url('errors/not_upload').'" target="_blank"';
                                                        }
                                                        ?>">
                                                    <i class="fas fa-fw fa-eye"></i> View File</a>
                                                </td>
                                            </tr>
                                            <?php
                                                }
                                            ?>
                                        </table>  
                                    </div>
                                    <div class="col-sm-6">
                                        <p style="font-weight:bold;">Data Proyek</p>
                                        <table class="table-responsive table table-bordered" id="dataTable" width="100%" border="1" cellspacing="0" cellpadding="3">
                                            <tr>
                                                <td width="2%" class="text-center"><b>No</b></td>
                                                <td width="13%" class="text-center"><b>Nama Proyek</b></td>
                                                <td width="5%" class="text-center"><b>Jabatan</b></td>
                                                <td width="10%" class="text-center"><b>Nilai Proyek</b></td>
                                                <td width="10%" class="text-center"><b>Lama Proyek</b></td>
                                                <td width="20%" class="text-center"><b>Referensi</b></td>
                                                <td width="10%" class="text-center"><b>Jenis Pengalaman</b></td>
                                            </tr> 
                                            <?php
                                            
                                            // Keperluan No urut agar input data proyek dynamic
                                                $i = 1;
                                                $no = 1;

                                            foreach($get_data_proyek_permohonan as $data_proyek){
                                            ?>
                                            <tr>
                                                <td class="text-center"><?php echo $no++; ?></td>
                                                <td><?php echo $data_proyek['nama_proyek'];?></td>
                                                <td class="text-center"><?php echo $data_proyek['jabatan'];?></td>
                                                <td class="text-center">
                                                    <?php 
                                                        if(!empty($data_proyek['nilai_proyek'])){
                                                            echo 'Rp. '.number_format($data_proyek['nilai_proyek'],0,',','.');
                                                        }else{
                                                            echo '0';
                                                        }
                                                    ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php

                                                    ## Berapa lama proyek ke Bulan
                                                    $ts1 = strtotime($data_proyek['tanggal_awal']);
                                                    $ts2 = strtotime($data_proyek['tanggal_akhir']);

                                                    $year1 = date('Y', $ts1);
                                                    $year2 = date('Y', $ts2);

                                                    $month1 = date('m', $ts1);
                                                    $month2 = date('m', $ts2);

                                                    $bulan = (($year2 - $year1) * 12) + ($month2 - $month1);
                                                
                                                    ## Berapa lama proyek ke Hari
                                                    $startDate = new DateTime($data_proyek['tanggal_awal']);
                                                    $endDate = new DateTime($data_proyek['tanggal_akhir']);

                                                    $hari = $endDate->diff($startDate);
                                                    
                                                    #Output
                                                    echo $hari->format("%a").' hari ( '.$bulan.' bulan )';
                                                    ?>
                                                </td>
                                                <td class="text-center">
                                                    <a href="<?php 
                                                        if(!empty($data_proyek['surat_referensi'])){
                                                            echo $data_proyek['surat_referensi'].'" target="_blank"';
                                                        }else{
                                                            echo base_url('errors/not_upload').'" target="_blank"';
                                                        }
                                                        ?>">
                                                    <i class="fas fa-fw fa-eye"></i> View File</a>
                                                </td>
                                                <td class="text-center"><?php echo $data_proyek['jenis_pengalaman'];?></td>
                                            </tr>
                                            <?php
                                                $i++;
                                                }
                                            ?>
                                            <input type="hidden" name="count" value="<?php echo $i; ?>" />

                                            <!-- Total -->
                                            <tr>
                                                <td class="text-center" colspan="3"><b>Total</b></td>
                                                <td class="text-center"  style="font-weight:bold;">
                                                    <?php
                                                        $sum_nilai_proyek = 0;
                                                        foreach($get_data_proyek_permohonan as $data_proyek){
                                                            if(empty($data_proyek['nilai_proyek'])){
                                                            $data_proyek['nilai_proyek'] = 0; 
                                                            }
                                                            $sum_nilai_proyek+= $data_proyek['nilai_proyek'];
                                                        }
                                                        echo 'Rp. '.number_format($sum_nilai_proyek,0,',','.');
                                                    ?>
                                                </td>
                                                <td class="text-center" style="font-weight:bold;">
                                                    <?php
                                                        $sum_hari = 0;
                                                        foreach($get_data_proyek_permohonan as $data_proyek){
                                                            ## Berapa lama proyek ke Hari
                                                            $startDate = new DateTime($data_proyek['tanggal_awal']);
                                                            $endDate = new DateTime($data_proyek['tanggal_akhir']);

                                                            $difference = $endDate->diff($startDate);
                                                            $sum_hari+= $difference->format("%a");
                                                        }
                                                        #Output
                                                        echo $sum_hari.' hari '.'( '. Floor($sum_hari / 30) .' bulan )';
                                                    ?>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                    <br/>
                                <center><input type="submit" value="Simpan" class="btn btn-default" style="background-color:#0295da; color:#fff;"/></center>
                            </form><hr style="border:2px solid #999; background-color:#999;"/>

                            <!-- Signature Admin -->
                            <div class="container">
                                <b>Catatan : <i>Signature / TTD di bawah ini akan digunakan untuk keperluan Tanda Tangan pada Form Apl 01 dan Apl 02</i></b><br/><br/>
                                <div class="row">
                                    <div class="col-md-6">
                                        <section>
                                            <div class="container">
                                                <div class="boxarea">
                                                    <div class="signature-pad" id="signature-pad">
                                                        <div class="m-signature-pad" style="border:1px solid #111;">
                                                            <div class="m-signature-pad-body">
                                                            <canvas id="signature-pad" width="530" height="200"></canvas>
                                                            </div>
                                                        </div>
                                                        <div class="m-signature-pad-footer" style="margin-top:3px;">
                                                            <center><button type="button"  id="save2" data-action="save" onclick="confirm('Simpan Signature / TTD ?')" class="btn btn-primary"><i class="fa fa-check"></i> Save</button>
                                                            <button type="button" data-action="clear"  class="btn btn-danger"><i class="fa fa-trash-o"></i> Clear</button></center>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" value="<?php echo rand();?>" id="rowno">
                                        </section><br/>
                                    </div>
                                    <div class="col-md-6">
                                        <?php
                                            if($get_data_apl01->ttd_peninjau == NULL){
                                                echo "<center style='color:red;'>Belum di Tanda Tangani untuk Keperluan Apl-01, Silahkan Tanda Tangani terlebih dahulu !</center>";
                                            }else{
                                                echo "<img src='".base_url('uploads/file_permohonan/ttd_admin_apl01/').$get_data_apl01->ttd_peninjau."'/>";
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <!-- / Signature Admin -->
                        </div>
                        <!------------------------ /Keperluan Apl01 ------------------------------>     

                        <!------------------------ Tinjau Klasifikasi Kualifikasi ------------------------------>
                        <div class="tab-pane" id="klasifikasi_kualifikasi">
                        <h5>Klasifikasi & Kualifikasi</h5>
                            <form action="<?= base_url('Admin/insert_klasifikasi_kualifikasi_tinjau_permohonan/').base64_encode($id_izin);?>" method="POST">
                                <div class="col-sm-12">
                                    <table class="text" width="100%" border="0" cellspacing="0" cellpadding="3">
                                        <!-- Berita Acara VV -->
                                        <tr>
                                            <td width="15%"><h5>#1</h5></td>
                                            <td width="20%" class="text-center"><br/>Tidak/Ada</td>
                                        </tr>   
                                        <tr>
                                            <td width="25%" valign="top">Berita Acara VV</td>
                                            <td width="20%" valign="top" class="text-center">
                                                <div class="custom-control custom-switch custom-switch">
                                                    <input type="checkbox" class="custom-control-input" value="1" id="5a" name="berita_acara_vv"
                                                    <?php 
                                                    foreach($get_data_tinjau_permohonan as $data_tinjau_permohonan){
                                                        if($data_tinjau_permohonan['item_tinjau_permohonan'] == '5a' && $data_tinjau_permohonan['status'] == '1'){
                                                            echo 'checked';
                                                        }
                                                    }
                                                    ?>
                                                    >
                                                    <label class="custom-control-label" for="5a"></label>
                                                </div>
                                            </td>
                                            <td width="15%" valign="top">
                                                <a href="<?php if(!empty($data_klasifikasi_kualifikasi_permohonan['berita_acara_vv'])){
                                                        echo $data_klasifikasi_kualifikasi_permohonan['berita_acara_vv'];
                                                    }else{
                                                        echo base_url('errors/not_upload').'" target="_blank"';
                                                    }
                                                ?>">
                                                <i class="fas fa-fw fa-eye"></i> View File</a>
                                            </td>
                                            <td width="50%" valign="top">
                                                <input type="text" class="form-control form-control-sm" name="catatan_berita_acara_vv" placeholder="Catatan..."
                                                <?php 
                                                foreach($get_data_tinjau_permohonan as $data_tinjau_permohonan){
                                                    if($data_tinjau_permohonan['item_tinjau_permohonan'] == '5a'){
                                                        echo 'value="'.$data_tinjau_permohonan['catatan'].'"';
                                                    }
                                                }
                                                ?>
                                                >
                                            </td>
                                        </tr>

                                        <!-- Surat Permohonan-->
                                        <tr>
                                            <td width="15%"><h5>#2</h5></td>
                                            <td width="20%" class="text-center"><br/>Tidak/Ada</td>
                                        </tr>   
                                        <tr>
                                            <td width="25%" valign="top">Surat Permohonan</td>
                                            <td width="20%" valign="top" class="text-center">
                                                <div class="custom-control custom-switch custom-switch">
                                                    <input type="checkbox" class="custom-control-input" value="1" id="5b" name="surat_permohonan"
                                                    <?php 
                                                    foreach($get_data_tinjau_permohonan as $data_tinjau_permohonan){
                                                        if($data_tinjau_permohonan['item_tinjau_permohonan'] == '5b' && $data_tinjau_permohonan['status'] == '1'){
                                                            echo 'checked';
                                                        }
                                                    }
                                                    ?>
                                                    >
                                                    <label class="custom-control-label" for="5b"></label>
                                                </div>
                                            </td>
                                            <td width="15%" valign="top">
                                                <a href="<?php if(!empty($data_klasifikasi_kualifikasi_permohonan['surat_permohonan'])){
                                                        echo $data_klasifikasi_kualifikasi_permohonan['surat_permohonan'];
                                                    }else{
                                                        echo base_url('errors/not_upload').'" target="_blank"';
                                                    }
                                                ?>">
                                                <i class="fas fa-fw fa-eye"></i> View File</a>
                                            </td>
                                            <td width="50%" valign="top">
                                                <input type="text" class="form-control form-control-sm" name="catatan_surat_permohonan" placeholder="Catatan..."
                                                <?php 
                                                foreach($get_data_tinjau_permohonan as $data_tinjau_permohonan){
                                                    if($data_tinjau_permohonan['item_tinjau_permohonan'] == '5b'){
                                                        echo 'value="'.$data_tinjau_permohonan['catatan'].'"';
                                                    }
                                                }
                                                ?>
                                                >
                                            </td>
                                        </tr>

                                        <!-- Surat Pengantar Permohonan Asosiasi-->
                                        <tr>
                                            <td width="15%"><h5>#3</h5></td>
                                            <td width="20%" class="text-center"><br/>Tidak/Ada</td>
                                        </tr>   
                                        <tr>
                                            <td width="25%" valign="top">Surat Pengantar Permohonan Asosiasi</td>
                                            <td width="20%" valign="top" class="text-center">
                                                <div class="custom-control custom-switch custom-switch">
                                                    <input type="checkbox" class="custom-control-input" value="1" id="5c" name="surat_pengantar_permohonan_asosiasi"
                                                    <?php 
                                                    foreach($get_data_tinjau_permohonan as $data_tinjau_permohonan){
                                                        if($data_tinjau_permohonan['item_tinjau_permohonan'] == '5c' && $data_tinjau_permohonan['status'] == '1'){
                                                            echo 'checked';
                                                        }
                                                    }
                                                    ?>
                                                    >
                                                    <label class="custom-control-label" for="5c"></label>
                                                </div>
                                            </td>
                                            <td width="15%" valign="top">
                                                <a href="<?php if(!empty($data_klasifikasi_kualifikasi_permohonan['surat_pengantar_permohonan_asosiasi'])){
                                                        echo $data_klasifikasi_kualifikasi_permohonan['surat_pengantar_permohonan_asosiasi'];
                                                    }else{
                                                        echo base_url('errors/not_upload').'" target="_blank"';
                                                    }
                                                ?>">
                                                <i class="fas fa-fw fa-eye"></i> View File</a>
                                            </td>
                                            <td width="50%" valign="top">
                                                <input type="text" class="form-control form-control-sm" name="catatan_surat_pengantar_permohonan_asosiasi" placeholder="Catatan..."
                                                <?php 
                                                foreach($get_data_tinjau_permohonan as $data_tinjau_permohonan){
                                                    if($data_tinjau_permohonan['item_tinjau_permohonan'] == '5c'){
                                                        echo 'value="'.$data_tinjau_permohonan['catatan'].'"';
                                                    }
                                                }
                                                ?>
                                                >
                                            </td>
                                        </tr>

                                        <!-- Sertifikat SKK -->
                                        <tr>
                                            <td width="15%"><h5>#4</h5></td>
                                            <td width="20%" class="text-center"><br/>Tidak/Ada</td>
                                        </tr>   
                                        <tr>
                                            <td width="25%" valign="top">Sertifikat SKK</td>
                                            <td width="20%" valign="top" class="text-center">
                                                <div class="custom-control custom-switch custom-switch">
                                                    <input type="checkbox" class="custom-control-input" value="1" id="5d" name="sertifikat_skk"
                                                    <?php 
                                                    foreach($get_data_tinjau_permohonan as $data_tinjau_permohonan){
                                                        if($data_tinjau_permohonan['item_tinjau_permohonan'] == '5d' && $data_tinjau_permohonan['status'] == '1'){
                                                            echo 'checked';
                                                        }
                                                    }
                                                    ?>
                                                    >
                                                    <label class="custom-control-label" for="5d"></label>
                                                </div>
                                            </td>
                                            <td width="15%" valign="top">
                                                <a href="<?php if(!empty($data_klasifikasi_kualifikasi_permohonan['sertifikat_skk'])){
                                                        echo $data_klasifikasi_kualifikasi_permohonan['sertifikat_skk'];
                                                    }else{
                                                        echo base_url('errors/not_upload').'" target="_blank"';
                                                    }
                                                ?>">
                                                <i class="fas fa-fw fa-eye"></i> View File</a>
                                            </td>
                                            <td width="50%" valign="top">
                                                <input type="text" class="form-control form-control-sm" name="catatan_sertifikat_skk" placeholder="Catatan..."
                                                <?php 
                                                foreach($get_data_tinjau_permohonan as $data_tinjau_permohonan){
                                                    if($data_tinjau_permohonan['item_tinjau_permohonan'] == '5d'){
                                                        echo 'value="'.$data_tinjau_permohonan['catatan'].'"';
                                                    }
                                                }
                                                ?>
                                                >
                                            </td>
                                        </tr>
                                    </table>

                                    <!-- Ceklis Klasifikasi Kualifikasi -->
                                    <table class="text" width="100%" border="0" cellspacing="0" cellpadding="3">
                                        <tr>
                                            <td width="15%"><br/><h5>#CEKLIS</h5></td>
                                            <td width="20%" class="text-center"><br/><br/>Tidak/Lengkap</td>
                                        </tr>   
                                        <tr style="border-bottom:3px solid #111;">
                                            <td width="20%" valign="top">Klasifikasi & Kualifikasi</td>
                                            <td width="20%" valign="top" class="text-center">
                                                <div class="custom-control custom-switch custom-switch">
                                                    <input type="checkbox" class="custom-control-input" value="1" id="5" name="ceklis_klasifikasi_kualifikasi"
                                                    <?php 
                                                    foreach($get_data_tinjau_permohonan as $data_tinjau_permohonan){
                                                        if($data_tinjau_permohonan['item_tinjau_permohonan'] == '5' && $data_tinjau_permohonan['status'] == '1'){
                                                            echo 'checked';
                                                        }
                                                    }
                                                    ?>
                                                    >
                                                    <label class="custom-control-label" for="5"></label>
                                                </div>
                                            </td>
                                            <td width="55%" valign="top">
                                                <input type="text" class="form-control form-control-sm" name="catatan_ceklis_klasifikasi_kualifikasi" placeholder="Catatan..."
                                                <?php 
                                                foreach($get_data_tinjau_permohonan as $data_tinjau_permohonan){
                                                    if($data_tinjau_permohonan['item_tinjau_permohonan'] == '5'){
                                                        echo 'value="'.$data_tinjau_permohonan['catatan'].'"';
                                                    }
                                                }
                                                ?>
                                                >
                                                <br/>
                                            </td>
                                        </tr>
                                    </table>

                                    <br/>
                                    <h5>Data Klasifikasi & Kualifikasi</h5>
                                    <table class="text" width="100%" border="0" cellspacing="0" cellpadding="3">
                                        <?php
                                            $no = 1;
                                            foreach ($get_data_klasifikasi_kualifikasi_permohonan as $data_klasifikasi_kualifikasi_permohonan){
                                        ?>
                                        <tr>
                                            <td width="20%" valign="top">Kualifikasi</td>
                                            <td width="2%" valign="top" align="center">:</td>
                                            <td width="78%" valign="top"><?php echo $data_klasifikasi_kualifikasi_permohonan['deskripsi_kualifikasi'] ?></td>
                                        </tr>
                                        <tr>
                                            <td width="20%" valign="top">Klasifikasi</td>
                                            <td width="2%" valign="top" align="center">:</td>
                                            <td width="78%" valign="top"><?php echo $data_klasifikasi_kualifikasi_permohonan['klasifikasi']." (".$data_klasifikasi_kualifikasi_permohonan['deskripsi_klasifikasi'].")" ?></td>
                                        </tr>
                                        <tr>
                                            <td width="20%" valign="top">Subklasifikasi</td>
                                            <td width="2%" valign="top" align="center">:</td>
                                            <td width="78%" valign="top"><?php echo $data_klasifikasi_kualifikasi_permohonan['subklasifikasi']." (".$data_klasifikasi_kualifikasi_permohonan['deskripsi_subklasifikasi'].")" ?></td>
                                        </tr>
                                        <tr>
                                            <td width="20%" valign="top">Jabatan Kera</td>
                                            <td width="2%" valign="top" align="center">:</td>
                                            <td width="78%" valign="top"><?php echo $data_klasifikasi_kualifikasi_permohonan['jabatan_kerja']." (".$data_klasifikasi_kualifikasi_permohonan['deskripsi_jabatan_kerja'].")"  ?></td>
                                        </tr>
                                        <tr>
                                            <td width="20%" valign="top">Jenis Permohonan</td>
                                            <td width="2%" valign="top" align="center">:</td>
                                            <td width="78%" valign="top"><?php echo $data_klasifikasi_kualifikasi_permohonan['deskripsi_jenis_permohonan'] ?></td>
                                        </tr>
                                        <?php
                                            }
                                        ?>
                                    </table>
                                </div>
                                <br/>
                                <input type="submit" value="Simpan" class="btn btn-default" style="float:right; background-color:#0295da; color:#fff;"/>
                            </form>
                            <br/>
                            <br/>
                            <br/>
                            <center><a href="<?= base_url('admin/hasil_tinjau_permohonan/').base64_encode($id_izin)?>" class="btn btn-default" style="background-color:green; color:#fff;">Hasil Tinjau Permohonan</a></center>
                        </div>
                        <!------------------------ /Tinjau Klasifikasi Kualifikasi ------------------------------>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php if ($this->session->flashdata('success')): ?>
<script>
swal({
  title: "Berhasil",
  text: "Data Berhasil di Simpan",
  icon: "<?= base_url('assets/img/success.png')?>",
  button: false,
  timer: 5000,
});
</script>
<?php endif; ?>

<!-- / Signature / TTD Admin -->
<script>
    var wrapper = document.getElementById("signature-pad"),
    clearButton = wrapper.querySelector("[data-action=clear]"),
    saveButton = wrapper.querySelector("[data-action=save]"),
    canvas = wrapper.querySelector("canvas"),
    signaturePad;


    function resizeCanvas() {

    var ratio =  window.devicePixelRatio || 1;
    canvas.width = canvas.offsetWidth * ratio;
    canvas.height = canvas.offsetHeight * ratio;
    canvas.getContext("2d").scale(ratio, ratio);
    }
    signaturePad = new SignaturePad(canvas);

    clearButton.addEventListener("click", function (event) {
    signaturePad.clear();
    });
    saveButton.addEventListener("click", function (event) {
    
    if (signaturePad.isEmpty()) {
        $('#myModal').modal('show');
    }

    else {
    
        $.ajax({
        type: "POST",
        url: "<?= base_url();?>admin/insert_signature_peninjau_apl01/<?= base64_encode($get_data_apl01->id_izin)?>",
        data: {'image': signaturePad.toDataURL(),'rowno':$('#rowno').val()},
        success: function(datas1)
        {            
            // signaturePad.clear();
            // $('.previewsign').html(datas1);
            top.location.href="<?= base_url('admin/tinjau_permohonan/').base64_encode($get_data_apl01->id_izin)?>";
        }
        });
    }
    }); 
</script>
<!-- Signature / TTD Admin -->