<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form APL 02</title>
    <script src="<?php echo base_url();?>assets/js/jquery-2.1.3.min.js"></script> 
	<script src="<?php echo base_url();?>assets/js/bootstrap.min.js" ></script> 
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/signature-pad.js"></script> 
</head>
<body>
<script>
    $(document).ready(function() {
    $('#dataTable').DataTable();
} );
</script>
<!-- DataTales Example -->
<a href="<?= base_url('asesor/pra_asesmen/').base64_encode($id_izin);?>" class="btn btn-primary">Kembali ke Pra-Asesmen</a><br/><br/>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-center text-primary">Data Form APL 02</h6>
    </div>
    <div class="container">

    <!-- Signature -->
    <div class="container">
        <iframe src="<?= base_url('asesor/cetak_form_apl02/').base64_encode($id_izin);?>" frameborder="0" width="100%" height="600px"></iframe>
        <b>Catatan : <i>Signature / TTD di bawah ini akan digunakan untuk keperluan Tanda Tangan pada Form APL 02</i></b><br/><br/>
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
                                    <center><button type="button"  id="save2" data-action="save" onclick="return confirm('Simpan Signature / TTD ?')" class="btn btn-primary"><i class="fa fa-check"></i> Save</button>
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
                    if($get_ttd_asesor->ttd_asesor == NULL){
                         echo "<center style='color:red;'>Belum di Tanda Tangani untuk Keperluan Apl-02, Silahkan Tanda Tangani terlebih dahulu !</center>";
                    }else{
                         echo "<img src='".base_url('uploads/file_permohonan/ttd_asesor_apl02/').$get_ttd_asesor->ttd_asesor."'/>";
                    }
                ?>
            </div>
        </div>
    </div>
    <!-- / Signature -->
    </div>
</div>
</body>
</html>

<!-- Signature / TTD -->
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
        url: "<?php echo base_url();?>asesor/insert_signature_asesor_apl02/<?= base64_encode($id_izin)?>",
        data: {'image': signaturePad.toDataURL(),'rowno':$('#rowno').val()},
        success: function(datas1)
        {            
            // signaturePad.clear();
            // $('.previewsign').html(datas1);
            top.location.href="<?= base_url('asesor/form_apl02/').base64_encode($id_izin)?>";
        }
        });
    }
    }); 
</script>
<!-- Signature / TTD -->