<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir AK 01</title>

    <!-- Sweet Alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

	<script src="<?php echo base_url();?>assets/js/jquery-2.1.3.min.js"></script> 
	<script src="<?php echo base_url();?>assets/js/bootstrap.min.js" ></script> 
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/signature-pad.js"></script> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <style>
        form {
            font-size:12px;
        }
    </style>
</head>
<body>
<div class="col-lg-12">
    <div class="card shadow mb-4">
        <br/>
        <h4 class="m-0 font-weight-bold text-primary text-center">Form AK 01</h4><br/>
        <div class="col-sm-12"><br/>
            <i>Silahkan Lengkapi Data dibawah ini untuk keperluan Form AK 01 <br/>untuk permohonan id izin (<?=$id_izin?>)</i><hr/>
        </div><br/>

        <!-- form -->
        <div class="col-sm-12">
            <h5 class="text-center text-primary"><b><u>FORMULIR PERSETUJUAN ASESMEN DAN KERAHASIAAN</u></b></h5>
        </div><br/>
        <form action="<?php echo base_url('Asesor/insert_data_ak01/').base64_encode($id_izin)?>" method="POST">
            <div class="container">
                <div class="row">
                    
                </div>
            </div>
        </form>
        <!-- /form -->
    </div>
</div>


</body>
</html>
<script>
    $('#modal-dialog').on('show', function() {
        var link = $(this).data('link'),
            confirmBtn = $(this).find('.confirm');
    })

    $('#btnYes').click(function() {
        // handle form processing here
    //  	alert('submit form');
        $('form').submit();
    });
</script>


<!-- Alert Sweet Alert Mapa 01 -->
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