<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Tempat Uji Kompetensi</title>

    <style>
        .table-compact th,
        .table-compact td {
            vertical-align: middle !important;
            font-size: 14px;
        }

        .table-compact thead {
            background-color: #374774 !important;
            color: #ffffff !important;
        }

        .card-header-custom {
            background-color: #EAB630 !important;
        }

        .btn-xs {
            padding: 0.25rem 0.4rem;
            font-size: 11px;
            line-height: 1.5;
            border-radius: 0.2rem;
        }

        .text-nowrap-custom {
            white-space: nowrap;
        }
    </style>
</head>

<body>
    <!-- <div class="card shadow mb-4"> -->
    <!-- Tambah TUK -->
    <!-- <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tambah Tempat Uji Kompetensi</h6>
        </div><br />
        <div class="container">
            <form action="<?#= base_url('admin/tambah_tuk/') ?>" method="POST" enctype="multipart/form-data"
                onsubmit="return confirm('Konfirmasi Menambahkan TUK')">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="font-weight-bold"> Nama TUK :</label>
                            <input type="text" placeholder="Balai Contoh / USTKM Provinsi / DPP Asosiasi"
                                class="form-control" name="nama_tuk" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="font-weight-bold"> Alamat TUK :</label>
                            <textarea
                                placeholder="Jl. Raya Contoh, Rt.001/Rw.002, Kec.Contoh, Kota/Kab.Contoh, Kode Pos 1945"
                                class="form-control" name="alamat" required></textarea>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="font-weight-bold"> Upload File Ijin TUK :</label>
                            <input type="file" class="form-control" name="file_ijin_tuk" required>
                            <i style="font-size:12px;">Catatan : File Uploadan yang di Ijinkan (File Size < 5 Mb dan
                                    Ekstensi File jpg | jpeg | png | pdf)</i>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="font-weight-bold"> Masa Berlaku TUK Sampai Dengan :</label>
                            <input type="date" class="form-control" name="masa_berlaku_tuk" required>
                        </div>
                    </div>
                </div>
                <input type="submit" class="btn btn-primary" style="float:right;" value="+ Tambah" />
            </form>
        </div> -->
    <!-- List TUK -->
    <div class="container-fluid mt-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3 card-header-custom">
                <h6 class="m-0 font-weight-bold text-white">
                    <h6 class="m-0 font-weight-bold text-white">
                        <i class="fas fa-home"></i> List Tempat Uji Kompetensi
                    </h6>
                    <a href="<?= base_url('admin/update_data_tuk_bnsp'); ?>" class="btn btn-success"
                        style="float:right; font-size:12px;">Sync Data TUK BNSP</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover table-sm table-compact w-100"
                        id="dataTable" cellspacing="0">
                        <thead class="text-center">
                            <tr class="text-center">
                                <th class="col-sm-1 text-center">Kode TUK</th>
                                <!-- <th class="col-sm-1 text-center">Action</th> -->
                                <th class="col-sm-1 text-center">Nama TUK</th>
                                <th class="col-sm-5 text-center">Alamat</th>
                                <!-- <th class="col-sm-3 text-center">File Izin TUK</th> -->
                                <!-- <th class="col-sm-5 text-center">Masa Berlaku TUK</th> -->
                                <th class="col-sm-1 text-center">Jenis TUK</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($get_master_tuk as $data) {
                                ?>
                                <tr>
                                    <td class="text-center"><?= $data['kode']; ?></td>
                                    <!-- <td class="text-center">
                            <?php
                            #if(!empty($data['id_tuk']) || $data['jenis_tuk'] == '1'){
                            #    echo '';
                            #}else{ 
                            ?>
                                <a href="<?#= base_url('admin/delete_tuk/').$data['id']; ?>" class="btn btn-danger" style="font-size:10px;" onclick="return confirm('Apakah Benar akan menghapus TUK (<?#=$data['nama_tuk'] ?>)')">X</a>
                            <?php #} ?>
                        </td> -->
                                    <td class="text-center"><?= $data['nama_tuk'] ?></td>
                                    <td><?= $data['alamat'] ?></a></td>
                                    <!-- <td class="text-center">
                            <?php
                            #if($data['jenis_tuk'] == '1'){
                            #    echo '';
                            #}else{
                            #    echo '<a href="'.base_url('uploads/master/tuk/').$data['file_izin_tuk'].'" target="_blank" class="btn btn-primary" style="font-size:12px;">View File</a>';
                            #}
                            ?>
                        </td> -->
                                    <!-- <td class="text-center">
                            <?php
                            #if($data['jenis_tuk'] == 1){
                            #    echo 'Tak Terbatas';
                            #}else{
                            #    echo $data['masa_berlaku_tuk'];
                            #}
                            ?>
                        </td> -->
                                    <td class="text-center">
                                        <?php
                                        if ($data['jenis_tuk'] == '1') {
                                            echo 'Tetap';
                                        } else {
                                            echo 'Sewaktu';
                                        }
                                        ?>
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