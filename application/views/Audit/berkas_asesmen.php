<head>
    <title>Berkas Asesmen</title>
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
<center><h1 class="text-center text-primary"><b>Berkas Asesmen</b></h1></center>
    <div class="row shadow mb-4">
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
        </div><br/>
            <!-- Data Rekomendasi Asesor -->
            <div class="text-center col-md-12">
                <?php
                    if(!empty($get_bukti_dokumentasi_asesmen->file)){
                ?>
                    <a href="<?= base_url('uploads/file_asesmen/bukti_dokumentasi_asesmen/').$get_bukti_dokumentasi_asesmen->file;?>" class="btn btn-primary" target="_blank">Preview Dokumentasi Asesmen</a>
                <?php }else{
                    echo "<center><button class='btn btn-danger'>Belum Upload Bukti Dokumentasi Asesmen</button></center>";
                }?>
            </div>
                <?php
                    foreach($get_data_rekomendasi_asesor as $data_rekomendasi_asesor){
                ?>
                    <div class="col-sm-3"></div>
                    <div class="col-sm-6 card"><br/>
                        <h6 class="text-center">Asesor ( <?= $data_rekomendasi_asesor['nama'];?> - <?= $data_rekomendasi_asesor['id_asesor'];?>)</h6><hr/>
                        
                        <!-- File-file Form Hasil Asesmen -->
                        <b class="text-center">File Hasil Asesmen</b>
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead class="bg-primary text-dark">
                                <tr class="text-center">
                                    <th>Form</th>
                                    <th>Print Out BNSP</th>
                                </tr>
                            </thead>
                            <?php
                                foreach($get_data_hasil_asesmen as $hasil_asesmen){
                            ?>
                            <tbody>
                                <tr>
                                    <th class="text-center"><?= $hasil_asesmen['nama_form']?></th>
                                    <td class="text-center">
                                        <a href="<?= base_url('cetak_form_asesmen/'.$hasil_asesmen['kode_form'].'/'.base64_encode($id_izin));?>" target="_blank"><i class="fas fa-fw fa-eye"></i> View File</a></a>
                                    </td>
                                </tr>
                            </tbody>
                            <?php 
                                }
                            ?>
                            <tfoot class="bg-primary text-light">
                                <th colspan="2" class="text-center">
                                   <h6>Rekomendasi Asesor :</h6> 
                                    <?php 
                                        if($data_rekomendasi_asesor['rekomendasi_asesor'] == 'Kompeten'){
                                            echo '<p class="btn btn-success" style="font-weight:bold;">Kompeten</p>';
                                        }elseif($data_rekomendasi_asesor['rekomendasi_asesor'] == 'Belum Kompeten'){
                                            echo '<p class="btn btn-danger" style="font-weight:bold;">Belum Kompeten</p>';
                                        }
                                    ?>
                                    <h6>Catatan :</h6>
                                    <?= $data_rekomendasi_asesor['catatan'];?>
                                </th>
                            </tfoot>
                        </table>
                    </div>
                    <div class="col-sm-3"></div>
                <?php
                    }
                ?>
            <!-- Data Rekomendasi Asesor -->
    </div>
</body>