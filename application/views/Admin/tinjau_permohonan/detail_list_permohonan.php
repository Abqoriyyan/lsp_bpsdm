<!DOCTYPE html>
<html lang="in">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Permohonan</title>
</head>
<body>

<div class="row">
    <div class="col-lg-12">
        <!-- Personal -->
        <div class="card shadow mb-4">
            <a href="#detail_personal" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true">
                <h6 class="m-0 font-weight-bold text-primary">Data Pemohon</h6>
            </a>
            <div class="collapse show" id="detail_personal">
                <div class="card-body">
                    <?php
                        $no = 1;
                        for ($i = 0; $i < count($array['personal']); $i++){
                    ?>
                    <center><img src="<?php echo $array['personal'][$i]['pas_foto']?>" width="150px" height="150px" style="margin:10px;"/></center>
                    <table class="text" width="100%" border="0" cellspacing="0" cellpadding="3">
                        <tr>
                            <td width="20%" valign="top">Nama</td>
                            <td width="2%" valign="top" align="center">:</td>
                            <td width="78%" valign="top"><?php echo $array['personal'][$i]['nama'] ?></td>
                        </tr>
                        <tr>
                            <td width="20%" valign="top">NIK</td>
                            <td width="2%" valign="top" align="center">:</td>
                            <td width="78%" valign="top"><?php echo $array['personal'][$i]['nik'] ?></td>
                        </tr>
                        <tr>
                            <td width="20%" valign="top">Email</td>
                            <td width="2%" valign="top" align="center">:</td>
                            <td width="78%" valign="top"><?php echo $array['personal'][$i]['email'] ?></td>
                        </tr>
                        <tr>
                            <td width="20%" valign="top">Telepon</td>
                            <td width="2%" valign="top" align="center">:</td>
                            <td width="78%" valign="top"><?php echo $array['personal'][$i]['telepon'] ?></td>
                        </tr>
                        <tr>
                            <td width="20%" valign="top">Jenis Kelamin</td>
                            <td width="2%" valign="top" align="center">:</td>
                            <td width="78%" valign="top"><?php echo $array['personal'][$i]['jenis_kelamin'] ?></td>
                        </tr>
                        <tr>
                            <td width="20%" valign="top">Tempat,Tangal Lahir</td>
                            <td width="2%" valign="top" align="center">:</td>
                            <td width="78%" valign="top"><?php echo $array['personal'][$i]['tempat_lahir'].', '.$array['personal'][$i]['tanggal_lahir'] ?></td>
                        </tr>
                        <tr>
                            <td width="20%" valign="top">Propinsi</td>
                            <td width="2%" valign="top" align="center">:</td>
                            <td width="78%" valign="top"><?php echo $array['personal'][$i]['propinsi']?></td>
                        </tr>
                        <tr>
                            <td width="20%" valign="top">Kabupaten</td>
                            <td width="2%" valign="top" align="center">:</td>
                            <td width="78%" valign="top"><?php echo $array['personal'][$i]['kabupaten']?></td>
                        </tr>
                        <tr>
                            <td width="20%" valign="top">Kode Pos</td>
                            <td width="2%" valign="top" align="center">:</td>
                            <td width="78%" valign="top"><?php echo $array['personal'][$i]['kodepos'] ?></td>
                        </tr>
                        <tr>
                            <td width="20%" valign="top">Alamat</td>
                            <td width="2%" valign="top" align="center">:</td>
                            <td width="78%" valign="top"><?php echo $array['personal'][$i]['alamat'] ?></td>
                        </tr>
                    </table>
                    <br/>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>  
        <!-- Personal -->

      
    </div>

    <div class="col-lg-12">
        <!-- Data Subklasifikasi yangd -->
        <div class="card shadow mb-4">
            <a href="#detail_personal" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true">
                <h6 class="m-0 font-weight-bold text-primary">Permohonan</h6>
            </a>
            <div class="collapse show" id="detail_personal">
                <div class="card-body">
                    <?php
                        $no = 1;
                        for ($i = 0; $i < count($array['klasifikasi_kualifikasi']); $i++){
                    ?>
                    <table class="text" width="100%" border="0" cellspacing="0" cellpadding="3">
                        <tr>
                            <td width="20%" valign="top">Jabatan Kerja</td>
                            <td width="2%" valign="top" align="center">:</td>
                            <td width="78%" valign="top"><?php echo $array['klasifikasi_kualifikasi'][$i]['jabatan_kerja'] ?></td>
                        </tr>
                        <tr>
                            <td width="20%" valign="top">Subklasifikasi</td>
                            <td width="2%" valign="top" align="center">:</td>
                            <td width="78%" valign="top"><?php echo $array['klasifikasi_kualifikasi'][$i]['subklasifikasi'] ?></td>
                        </tr>
                        <tr>
                            <td width="20%" valign="top">Klasifikasi</td>
                            <td width="2%" valign="top" align="center">:</td>
                            <td width="78%" valign="top"><?php echo $array['klasifikasi_kualifikasi'][$i]['klasifikasi'] ?></td>
                        </tr>
                        <tr>
                            <td width="20%" valign="top">Kualifikasi</td>
                            <td width="2%" valign="top" align="center">:</td>
                            <td width="78%" valign="top"><?php echo $array['klasifikasi_kualifikasi'][$i]['kualifikasi'] ?></td>
                        </tr>
                        <tr>
                            <td width="20%" valign="top">Jenjang</td>
                            <td width="2%" valign="top" align="center">:</td>
                            <td width="78%" valign="top"><?php echo $array['klasifikasi_kualifikasi'][$i]['jenjang'] ?></td>
                        </tr>
                        <tr>
                            <td width="20%" valign="top">Tanggal Permohonan</td>
                            <td width="2%" valign="top" align="center">:</td>
                            <td width="78%" valign="top"><?php echo $array['klasifikasi_kualifikasi'][$i]['created'] ?></td>
                        </tr>
                        <tr>
                            <td width="20%" valign="top">Jenis Permohonan</td>
                            <td width="2%" valign="top" align="center">:</td>
                            <td width="78%" valign="top">
                                <?php 
                                    foreach($get_master_jenis_permohonan as $master_jenis_permohonan){
                                        if($master_jenis_permohonan['id'] == $array['klasifikasi_kualifikasi'][$i]['jenis_permohonan']){
                                           echo $master_jenis_permohonan['deskripsi'];
                                        }
                                    }
                                ?>
                            </td>
                        </tr>
                    </table>
                  
                    <br/>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>  
        <!-- Personal -->
    </div>

</div>
<center><a href="#" data-toggle="modal" data-target="#mulai-peninjauan" class="btn btn-primary" >Mulai Peninjauan Permohonan<i class="icon-arrow-right14 position-right"></i></a></center>
<!-- Modal -->
<script>
    $('#mulai-peninjauan').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));

        $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
    });
</script>

<div class="modal fade" id="mulai-peninjauan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header text-center">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"></h4>
            </div>

            <div class="modal-body text-center">
                <h4>Konfirmasi Mulai Tinjau Permohonan</h4><p> <br/>ID Izin ( <?php echo $id_izin;?> )<br/>
                    <?php
                        $no = 1;
                        for ($i = 0; $i < count($array['personal']); $i++){
                    ?>
                    Nama - <?php echo $array['personal'][$i]['nama'] ?><br/>
                    Nik - <?php echo $array['personal'][$i]['nik'] ?>
                <?php
                    }
                ?>
                </p>
            </div>
            
            <div class="modal-footer text-center">
                <center><button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <a class="btn btn-primary btn-ok" href="<?php echo base_url('admin/entry_data_permohonan/').base64_encode($id_izin);?>">Ya, Mulai</a></center>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->

</body>
</html>
