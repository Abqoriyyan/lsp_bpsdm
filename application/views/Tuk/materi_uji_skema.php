<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Tempat Uji Kompetensi</title>

<style>
    th {
        font-size:12px;
    }
    td {
        font-size:12px;
    }
</style>

<script>
    $(document).ready(function() {
    $('#dataTable').DataTable();
} );
</script>
</head>

<body>
<div class="card shadow mb-4">
    <div class="card-header py-3 bg-gradient-dark">
        <h6 class="m-0 font-weight-bold text-light">List Tempat Uji Kompetensi</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped text-dark" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="col-sm-1 text-center">No</th>
                        <th class="col-sm-2 text-center">ID Jabatan Kerja</th>
                        <th class="col-sm-7 text-center">Jabatan Kerja</th>
                        <th class="col-sm-1 text-center">MUK</th>
                        <th class="col-sm-1 text-center">Skema</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                        foreach($get_master_jabatan_kerja as $data){
                    ?>
                    <tr>
                        <td class="text-center"><?=$no++?></td>
                        <td class="text-center"><?= $data['id_jabatan_kerja']?></td>
                        <td><?= $data['jabatan_kerja']?></td>
                        <td>
                            <a href="<?= base_url('assets/lsp/muk/').$data['muk']?>" class="btn btn-dark" style="font-size:10px;" target="_blank">Download</a>
                        </td>
                        <td>
                            <a href="<?= base_url('assets/lsp/skema/').$data['skema']?>" class="btn btn-dark" style="font-size:10px;" target="_blank">Download</a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>