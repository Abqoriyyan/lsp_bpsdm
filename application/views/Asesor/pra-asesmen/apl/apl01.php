<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form APL-01</title>
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
        <h6 class="m-0 font-weight-bold text-center text-primary">Data Form APL 01</h6>
    </div>
    <div class="container">
        <iframe src="<?= base_url('asesor/cetak_form_apl01/').base64_encode($id_izin);?>" frameborder="0" width="100%" height="600px"></iframe>
    </div>
</div>
</body>
</html>