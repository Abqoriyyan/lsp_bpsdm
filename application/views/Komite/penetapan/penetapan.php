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
<script>
    $(document).ready(function() {
    $('#dataTableAsesmen').DataTable();
} );
</script>
<center><h4 class="text-center"><b>Penetapan Komite Teknis Permohonan Sertifikasi</b></h4></center>
    <div class="row shadow mb-4">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12 card mb-6 py-3 border-bottom-info">
                    <div class='card-body'>
                        <h5><b>Info Permohonan Sertifikasi</b></h5><br/>
                            <?php
                                echo 'Nama                  : ' . $get_data_personal_permohonan->nama.'<br/>';
                                echo 'NIK                   : ' . $get_data_personal_permohonan->nik.'<br/>';
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
            <div class="text-center col-md-12">
                <h3><b>Data Detail Pemohon</b></h3>
            </div>
            <!-- Data Detail Pemohon -->
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
                                    <a class="nav-link" href="#apl02" data-toggle="tab">
                                        <i class="material-icons">history</i>
                                        Apl 02
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
                            <h5 class="text-center">Data Administrasi</h5><hr/>
                            <table class="text" width="100%" border="0" cellspacing="0" cellpadding="3">
                               <tr>
                                    <th width="20%">Nama</th>
                                    <th width="2%">:</th>
                                    <th width="78%"><?= $get_data_personal_permohonan->nama;?></th>
                               </tr>
                               <tr>
                                    <th width="20%">NIK</th>
                                    <th width="2%">:</th>
                                    <th width="78%"><?= $get_data_personal_permohonan->nik?></th>
                               </tr>
                               <tr>
                                    <th width="20%">Tempat, Tanggal Lahir</th>
                                    <th width="2%">:</th>
                                    <th width="78%"><?= $get_data_personal_permohonan->tempat_lahir . ', ' . $get_data_personal_permohonan->tanggal_lahir?></th>
                               </tr>
                               <tr>
                                    <th width="20%">Email</th>
                                    <th width="2%">:</th>
                                    <th width="78%"><?= $get_data_personal_permohonan->email?></th>
                               </tr>
                               <tr>
                                    <th width="20%">Telepon</th>
                                    <th width="2%">:</th>
                                    <th width="78%"><?= $get_data_personal_permohonan->telepon?></th>
                               </tr>
                               <tr>
                                    <th width="20%">NPWP</th>
                                    <th width="2%">:</th>
                                    <th width="78%"><?= $get_data_personal_permohonan->npwp?></th>
                               </tr>
                               <tr>
                                    <th width="20%">Jenis Kelamin</th>
                                    <th width="2%">:</th>
                                    <th width="78%"><?= $get_data_personal_permohonan->jenis_kelamin?></th>
                               </tr>
                               <tr>
                                    <th width="20%">Alamat</th>
                                    <th width="2%">:</th>
                                    <th width="78%"><?= $get_data_personal_permohonan->alamat?></th>
                               </tr>
                               <tr>
                                    <th width="20%">File KTP</th>
                                    <th width="2%">:</th>
                                    <th width="78%">
                                        <a href="<?php if(!empty($get_data_personal_permohonan->ktp)){
                                                echo $get_data_personal_permohonan->ktp;
                                            }else{
                                                echo base_url('errors/not_upload').'" target="_blank"';
                                            }
                                        ?>" target="_blank">
                                        <i class="fas fa-fw fa-eye"></i> View File</a>
                                    </th>
                               </tr>
                               <tr>
                                    <th width="20%">Surat Pernyataan Kebenaran Data</th>
                                    <th width="2%">:</th>
                                    <th width="78%">
                                        <a href="<?php if(!empty($get_data_personal_permohonan->surat_pernyataan_kebenaran_data)){
                                                echo $get_data_personal_permohonan->surat_pernyataan_kebenaran_data;
                                            }else{
                                                echo base_url('errors/not_upload').'" target="_blank"';
                                            }
                                        ?>" target="_blank">
                                        <i class="fas fa-fw fa-eye"></i> View File</a>
                                    </th>
                               </tr>
                               <tr>
                                    <th width="20%">File NPWP</th>
                                    <th width="2%">:</th>
                                    <th width="78%">
                                        <a href="<?php if(!empty($get_data_personal_permohonan->file_npwp)){
                                                echo $get_data_personal_permohonan->file_npwp;
                                            }else{
                                                echo base_url('errors/not_upload').'" target="_blank"';
                                            }
                                        ?>" target="_blank">
                                        <i class="fas fa-fw fa-eye"></i> View File</a>
                                    </th>
                               </tr>
                               <tr>
                                    <th width="20%">Pas Foto</th>
                                    <th width="2%">:</th>
                                    <th width="78%">
                                        <a href="<?php if(!empty($get_data_personal_permohonan->pas_foto)){
                                                echo $get_data_personal_permohonan->pas_foto;
                                            }else{
                                                echo base_url('errors/not_upload').'" target="_blank"';
                                            }
                                        ?>" target="_blank">
                                        <i class="fas fa-fw fa-eye"></i> View File</a>
                                    </th>
                               </tr>
                            </table>
                        </div>
                        <!------------------------ /Tinjau Administrasi ------------------------------>

                        <!------------------------ Tinjau Pendidikan ------------------------------>
                        <div class="tab-pane" id="pendidikan">
                        <h5 class="text-center">Pendidikan Yang dipilih sesuai Dengan Kompetensi Permohonan</h5><hr/>
                            <table class="table-responsive table table-bordered" id="dataTable" width="100%" border="1" cellspacing="0" cellpadding="3">
                                <tr>
                                    <td width="5%" class="text-center"><b>Jenjang</b></td>
                                    <td width="20%" class="text-center"><b>Nama Perguruan</b></td>
                                    <td width="20%" class="text-center"><b>Program Studi</b></td>
                                    <td width="10%" class="text-center"><b>Tahun Lulusan</b></td>
                                    <td width="20%" class="text-center"><b>Scan Ijazah Legalisir</b></td>
                                    <td width="20%" class="text-center"><b>Scan Surat Keterangan</b></td>
                                </tr>   
                              
                                <tr>
                                    <td class="text-center"><?= $get_data_pendidikan_permohonan->deskripsi_jenjang;?> 
                                    </td>
                                    <td><?php echo $get_data_pendidikan_permohonan->nama_sekolah_perguruan_tinggi;?></td>
                                    <td class="text-center"><?php echo $get_data_pendidikan_permohonan->program_studi;?></td>
                                    <td class="text-center"><?php echo $get_data_pendidikan_permohonan->tahun_lulus;?></td>
                                    <td class="text-center">
                                        <a href="<?php
                                            if(!empty($get_data_pendidikan_permohonan->scan_ijazah_legalisir)){
                                                echo $get_data_pendidikan_permohonan->scan_ijazah_legalisir.'" target="_blank"';
                                            }else{
                                                echo base_url('errors/not_upload').'" target="_blank"';
                                            }
                                            ?>">
                                        <i class="fas fa-fw fa-eye"></i> View File</a>
                                    </td>
                                    <td class="text-center">
                                        <a href="<?php
                                            if(!empty($get_data_pendidikan_permohonan->scan_surat_keterangan)){
                                                echo $get_data_pendidikan_permohonan->scan_surat_keterangan.'" target="_blank"';
                                            }else{
                                                echo base_url('errors/not_upload').'" target="_blank"';
                                            }
                                            ?>">
                                        <i class="fas fa-fw fa-eye"></i> View File</a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <!------------------------ /Tinjau Pendidikan ------------------------------>
              
                        <!------------------------ Tinjau Proyek ------------------------------>
                        <div class="tab-pane" id="proyek">
                        <h5 class="text-center">Data Proyek Pemohon</h5>
                            <table class="table-responsive table table-bordered" id="dataTable" width="100%" border="1" cellspacing="0" cellpadding="3">
                                <tr>
                                    <td width="2%" class="text-center"><b>No</b></td>
                                    <td width="13%" class="text-center"><b>Nama Proyek</b></td>
                                    <td width="5%" class="text-center"><b>Jabatan</b></td>
                                    <td width="10%" class="text-center"><b>Nilai Proyek</b></td>
                                    <td width="10%" class="text-center"><b>Lama Proyek</b></td>
                                    <td width="20%" class="text-center"><b>Surat Referensi</b></td>
                                    <td width="10%" class="text-center"><b>Jenis Pengalaman</b></td>
                                </tr> 
                                <?php
                                
                                // Keperluan No urut agar input data proyek dynamic
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
                                    <td class="text-center"><?= $data_proyek['jenis_pengalaman'];?></td>
                                </tr>
                                <?php
                                    }
                                ?>
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
                        <!------------------------/ Tinjau Proyek ------------------------------>

                        <!------------------------ Tinjau Pelatihan ------------------------------>
                        <div class="tab-pane" id="pelatihan">
                        <h5 class="text-center">Data Pelatihan Pemohon</h5>
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
                        </div>
                        <!------------------------ /Tinjau Pelatihan ------------------------------>

                        <!------------------------ APl01 ------------------------------>
                        <div class="tab-pane" id="apl01">
                        <h5 class="text-center">Form APL 01</h5>
                            <div class="container">
                                <iframe src="<?= base_url('komite/cetak_form_apl01/').base64_encode($id_izin);?>" frameborder="0" width="100%" height="600px"></iframe>
                            </div>
                        </div>
                        <!------------------------ / Apl01 ------------------------------>     
                        
                        <!------------------------ APl02 ------------------------------>
                        <div class="tab-pane" id="apl02">
                        <h5 class="text-center">Form APL 02</h5>
                            <div class="container">
                                <iframe src="<?= base_url('komite/cetak_form_apl02/').base64_encode($id_izin);?>" frameborder="0" width="100%" height="600px"></iframe>
                            </div>
                        </div>
                        <!------------------------ / Apl02 ------------------------------>     

                        <!------------------------ Tinjau Klasifikasi Kualifikasi ------------------------------>
                        <div class="tab-pane" id="klasifikasi_kualifikasi">
                        <h5 class="text-center">Klasifikasi & Kualifikasi</h5>
                            <table class="text" width="100%" border="0" cellspacing="0" cellpadding="3">
                                <tr>
                                    <th width="20%">Kualifikasi</th>
                                    <th width="2%">:</th>
                                    <th width="78%"><?= $info_data_permohonan->kualifikasi.' ('.$info_data_permohonan->deskripsi_kualifikasi.')'?></th>
                                </tr>
                                <tr>
                                    <th width="20%">Jabatan Kerja</th>
                                    <th width="2%">:</th>
                                    <th width="78%"><?= $info_data_permohonan->jabatan_kerja.' ('.$info_data_permohonan->deskripsi_jabatan_kerja.')'?></th>
                                </tr>
                                <tr>
                                    <th width="20%">Jenjang</th>
                                    <th width="2%">:</th>
                                    <th width="78%"><?= $info_data_permohonan->jenjang?></th>
                                </tr>
                                <tr>
                                    <th width="20%">Jenis Permohonan </th>
                                    <th width="2%">:</th>
                                    <th width="78%"><?= $info_data_permohonan->deskripsi_jenis_permohonan?></th>
                                </tr>
                                <tr>
                                    <th width="20%">Berita Acara VV</th>
                                    <th width="2%">:</th>
                                    <th width="78%">
                                        <a href="<?php if(!empty($get_data_klasifikasi_kualifikasi_permohonan->berita_acara_vv)){
                                                echo $get_data_klasifikasi_kualifikasi_permohonan->berita_acara_vv;
                                            }else{
                                                echo base_url('errors/not_upload').'" target="_blank"';
                                            }
                                        ?>" target="_blank">
                                        <i class="fas fa-fw fa-eye"></i> View File</a>
                                    </th>
                                </tr>
                                <tr>
                                    <th width="20%">Surat Permohonan</th>
                                    <th width="2%">:</th>
                                    <th width="78%">
                                        <a href="<?php if(!empty($get_data_klasifikasi_kualifikasi_permohonan->surat_permohonan)){
                                                echo $get_data_klasifikasi_kualifikasi_permohonan->surat_permohonan;
                                            }else{
                                                echo base_url('errors/not_upload').'" target="_blank"';
                                            }
                                        ?>" target="_blank">
                                        <i class="fas fa-fw fa-eye"></i> View File</a>
                                    </th>
                                </tr>
                                <tr>
                                    <th width="20%">Surat Pengantar Permohonan Asosiasi</th>
                                    <th width="2%">:</th>
                                    <th width="78%">
                                        <a href="<?php if(!empty($get_data_klasifikasi_kualifikasi_permohonan->surat_pengantar_permohonan_asosiasi)){
                                                echo $get_data_klasifikasi_kualifikasi_permohonan->surat_pengantar_permohonan_asosiasi;
                                            }else{
                                                echo base_url('errors/not_upload').'" target="_blank"';
                                            }
                                        ?>" target="_blank">
                                        <i class="fas fa-fw fa-eye"></i> View File</a>
                                    </th>
                                </tr>
                                <tr>
                                    <th width="20%">Sertifikat SKK</th>
                                    <th width="2%">:</th>
                                    <th width="78%">
                                        <a href="<?php if(!empty($get_data_klasifikasi_kualifikasi_permohonan->sertifikat_skk)){
                                                echo $get_data_klasifikasi_kualifikasi_permohonan->sertifikat_skk;
                                            }else{
                                                echo base_url('errors/not_upload').'" target="_blank"';
                                            }
                                        ?>" target="_blank">
                                        <i class="fas fa-fw fa-eye"></i> View File</a>
                                    </th>
                                </tr>
                            </table>
                        </div>
                        <!------------------------ /Tinjau Klasifikasi Kualifikasi ------------------------------>
                    </div>
                </div>
            </div>


            <!-- Data Rekomendasi Asesor -->
            <div class="text-center col-md-12">
                <h3><b>Data Rekomendasi Asesor</b></h3>
            </div>
                <?php
                    foreach($get_data_rekomendasi_asesor as $data_rekomendasi_asesor){
                ?>
                    <?php 
                        if($get_data_klasifikasi_kualifikasi_permohonan->jenjang <= '3'){
                            echo '<div class="col-sm-3"></div>';
                        }elseif($get_data_klasifikasi_kualifikasi_permohonan->jenjang >= '4'){
                            echo '';
                        }
                    ?>
                    <div class="col-sm-6 card"><br/>
                        <h6 class="text-center">Asesor ke-<?= $data_rekomendasi_asesor['asesor_ke']?> ( <?= $data_rekomendasi_asesor['nama'];?> - <?= $data_rekomendasi_asesor['id_asesor'];?>)</h6><hr/>
                        
                        <!-- File-file Form Hasil Asesmen -->
                        <b class="text-center">File Hasil Asesmen</b>
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr class="card-header-danger text-center">
                                    <th style="color:#fff;">Form</th>
                                    <th style="color:#fff;">File</th>
                                </tr>
                            </thead>
                            <?php
                                foreach($get_data_file_asesmen as $data_file_asesmen){
                                    if($data_file_asesmen['user_pengunggah'] == $data_rekomendasi_asesor['id_asesor']){
                            ?>
                            <tbody>
                                <tr>
                                    <th class="text-center"><?= $data_file_asesmen['nama_form']?></th>
                                    <td class="text-center">
                                        <a href="<?= base_url('uploads/file_asesmen/').$data_file_asesmen['kode_form'].'/'.$data_file_asesmen['file']?>" target="_blank"><i class="fas fa-fw fa-eye"></i> View File</a></a>
                                    </td>
                                </tr>
                            </tbody>
                            <?php 
                                    }
                                }
                            ?>
                            <tfoot>
                                <th colspan="2" class="text-center">
                                   <h6>Rekomendasi Asesor :</h6> 
                                    <?php 
                                        if($data_rekomendasi_asesor['rekomendasi_asesor'] == 'Kompeten'){
                                            echo '<p class="text-primary" style="font-weight:bold;">Kompeten</p>';
                                        }elseif($data_rekomendasi_asesor['rekomendasi_asesor'] == 'Belum Kompeten'){
                                            echo '<p class="text-danger" style="font-weight:bold;">Belum Kompeten</p>';
                                        }
                                    ?>
                                    <h6>Catatan :</h6>
                                    <?= $data_rekomendasi_asesor['catatan'];?>
                                </th>
                            </tfoot>
                        </table>
                    </div>
                    <?php 
                        if($get_data_klasifikasi_kualifikasi_permohonan->jenjang <= '3'){
                            echo '<div class="col-sm-3"></div>';
                        }elseif($get_data_klasifikasi_kualifikasi_permohonan->jenjang >= '4'){
                            echo '';
                        }
                    ?>
                <?php
                    }
                ?>
            <!-- Data Rekomendasi Asesor -->


            <!-- Penetapan Komite -->
            <div class="col-md-12">
            <center>
                <form action="<?= base_url("Komite/insert_penetapan/").base64_encode($id_izin);?>" method="POST" enctype="multipart/form-data">
                    <div class="col-sm-4 text-center">
                        <h3><b>Penetapan Komite Teknis</b></h3>
                        <select class="form-control text-center" style="border:1px solid #111; box-shadow: 2px 4px #9999;" name="penetapan" required>
                            <option value="Kompeten">Kompeten - Cetak Sertifikat</option>
                            <option value="Belum Kompeten">Belum Kompeten - Tolak Permohonan</option>
                        </select>
                    </div><br/>
                    <div class="col-sm-4">
                        <textarea name="catatan" class="form-control" placeholder="Catatan..." style="border:1px solid #111; box-shadow: 2px 4px #9999; text-align:center;"></textarea>
                    </div><br/>
                    <div class="col-sm-12 text-center"><br/>
                        <input type="submit" value="Tetapkan Hasil Sertifikasi" class="btn btn-default" style="background-color:#0295da; color:#fff;" onclick="return confirm('Pastikan Rekomendasi Asesmen sudah benar!')"/>
                    </div><br/>
                </form>
            </center>
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


<?php if ($this->session->flashdata('gagal-upload')): ?>
<script>
swal({
  title: "Berhasil",
  text: "File SK Gagal di Upload ekstension bukan .pdf dan > dari 10 MB",
  icon: "<?= base_url('assets/img/failed.png')?>",
  button: false,
  timer: 5000,
});
</script>
<?php endif; ?>


<?php if ($this->session->flashdata('message_pelaporan_asesor')): ?>
<script>
swal({
  title: "Warning",
  text: "<?= $this->session->flashdata('message_pelaporan_asesor')?>",
  icon: "<?= base_url('assets/img/failed.png')?>",
  button: false,
  timer: 10000,
});
</script>
<?php endif; ?> 