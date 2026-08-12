<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir APL 02</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <style>
        body {
            background-color: #f4f7f6;
            font-family: 'Poppins', sans-serif;
            color: #2b3445;
        }

        .card-modern {
            border: none;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            background-color: #ffffff;
        }

        .alert-instruksi {
            background-color: #f8f9fa;
            border-left: 5px solid #0d6efd;
            border-radius: 8px;
        }

        .table-custom {
            font-size: 13px;
            border-collapse: separate;
            border-spacing: 0;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid #e9ecef;
        }

        .table-custom thead th {
            background-color: #eef2f7;
            color: #313a46;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.5px;
            vertical-align: middle;
            border-bottom: 2px solid #dee2e6;
        }

        .table-custom th, .table-custom td {
            padding: 12px 15px;
            vertical-align: middle;
        }

        .bg-elemen {
            background-color: #fdfbf7;
            color: #111;
            font-weight: 500;
        }

        .form-switch .form-check-input {
            width: 2.5em;
            height: 1.25em;
            cursor: pointer;
        }

        .form-switch .form-check-input:checked {
            background-color: #198754;
            border-color: #198754;
        }

        .btn-modern {
            border-radius: 8px;
            font-weight: 500;
            padding: 8px 20px;
            transition: all 0.3s;
        }

        .btn-modern:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(13, 110, 253, 0.2);
        }

        .form-select-sm {
            border-radius: 6px;
            font-size: 12px;
            box-shadow: none;
        }
    </style>
</head>
<body class="pb-5">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-12">
            
            <div class="card card-modern p-4 p-md-5 mb-4">
                
                <div class="text-center mb-5">
                    <h3 class="m-0 font-weight-bold text-dark text-center">Formulir APL 02</h3>
                    <h5 class="text-secondary mt-2">Self Assessment (Pra-Assessment)</h5>
                    <p class="text-muted mt-3">
                        untuk permohonan Id Izin: <span class="badge bg-primary px-3 py-2 fs-6 rounded-pill"><?= $id_izin; ?></span>
                    </p>
                </div>

                <div class="alert alert-instruksi shadow-sm p-4 mb-4">
                    <h6 class="fw-bold text-primary mb-3">
                        <i class="fa-solid fa-circle-info me-2"></i> Panduan Asesmen Mandiri
                    </h6>
                    <div class="row">
                        <div class="col-md-9">
                            <ul class="mb-0 text-muted" style="font-size: 14px; line-height: 1.8;">
                                <li>Baca setiap pertanyaan di kolom sebelah kiri.</li>
                                <li>Geser tombol (switch) pada kotak jika Anda yakin dapat melakukan tugas yang dijelaskan.</li>
                                <li>Silahkan tambahkan terlebih dahulu bukti-bukti untuk lampiran pilihan pada kolom <b>Bukti yang Relevan</b> menggunakan tombol di sebelah kanan.</li>
                                <li>Pilih <i>dropdown</i> di sebelah kanan sesuai bukti yang Anda miliki untuk menunjukkan bahwa Anda melakukan tugas-tugas ini.</li>
                            </ul>
                        </div>
                        <div class="col-md-3 border-start mt-3 mt-md-0">
                            <strong class="text-dark" style="font-size: 14px;">Keterangan Status:</strong>
                            <ul class="list-unstyled mt-2 text-muted" style="font-size: 13px;">
                                <li class="mb-1"><span class="badge bg-success" style="width: 35px;">K</span> = Kompeten</li>
                                <li><span class="badge bg-secondary" style="width: 35px;">BK</span> = Belum Kompeten</li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <div class="d-flex justify-content-end mb-4">
                    <a href="<?= base_url("user/bukti_relavan_apl02/").base64_encode($id_izin); ?>" class="btn btn-primary btn-modern btn-sm">
                        <i class="fa-solid fa-plus me-1"></i> Tambah Bukti Relevan
                    </a>
                </div>
                
                <form action="<?= base_url('user/save_data_apl02/').base64_encode($id_izin); ?>" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                            value="<?= $this->security->get_csrf_hash(); ?>" />                
                <?php
                    foreach($get_master_unit_kompetensi as $master_unit_kompetensi){
                        if($master_unit_kompetensi['kode_jabker'] == $get_data_klasifikasi_kualifikasi->jabatan_kerja){
                ?>
                    <div class="table-responsive mb-5 shadow-sm rounded-3">
                        <table class="table table-custom table-hover mb-0" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="text-center bg-primary text-white border-end border-light" style="width: 15%;" rowspan="2">
                                        <i class="fa-solid fa-layer-group mb-1 fs-5 d-block"></i> Unit Kompetensi
                                    </th>
                                    <th class="bg-primary text-white fw-bold" colspan="3" style="font-size: 14px;">
                                        <?= $master_unit_kompetensi['kode_unit_kompetensi']?> - <?= $master_unit_kompetensi['deskripsi']?>
                                    </th>
                                </tr>
                                <tr class="text-center">
                                    <th style="width: 55%; border-bottom: none;">Dapatkah Saya ............... ?</th>
                                    <th style="width: 10%; border-bottom: none;">BK / K</th>
                                    <th style="width: 20%; border-bottom: none;">Bukti yang Relevan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach($get_master_elemen_kompetensi as $master_elemen_kompetensi){
                                        if($master_elemen_kompetensi['kode_unit_kompetensi'] == $master_unit_kompetensi['kode_unit_kompetensi']){
                                ?>
                                <tr class="bg-elemen">
                                    <td colspan="4" class="py-3 px-4 border-bottom border-light">
                                        <span class="badge bg-warning text-dark me-2">Elemen <?= $master_elemen_kompetensi['no_urut_elemen_kompetensi']?></span> 
                                        <strong><?= $master_elemen_kompetensi['deskripsi']?></strong>
                                    </td>
                                </tr>

                                <?php
                                    foreach($get_master_kriteria_unjuk_kerja as $master_kriteria_unjuk_kerja){
                                        if($master_kriteria_unjuk_kerja['kode_elemen_kompetensi'] == $master_elemen_kompetensi['kode_elemen_kompetensi']){
                                ?>
                                <tr>
                                    <td colspan="2" class="px-4 text-muted">
                                        <span class="fw-bold text-dark me-1"><?= $master_elemen_kompetensi['no_urut_elemen_kompetensi'].'.'.$master_kriteria_unjuk_kerja['no_urut_kuk']?></span> 
                                        <?= $master_kriteria_unjuk_kerja['deskripsi']?>
                                    </td>
                                    
                                    <td class="text-center border-start">
                                        <div class="form-check form-switch d-flex justify-content-center m-0">
                                            <?php $kode_kuk_clear = str_replace(".", "", $master_kriteria_unjuk_kerja['kode_kuk']); ?>
                                            <input class="form-check-input shadow-sm" type="checkbox" role="switch" value="1" id="<?=$kode_kuk_clear?>" name="<?='status_'.$kode_kuk_clear?>"
                                                <?php
                                                    foreach($get_data_apl02 as $data_apl02){
                                                        if(($data_apl02['kode_kuk'] == $master_kriteria_unjuk_kerja['kode_kuk']) && ($data_apl02['status'] == '1')){
                                                            echo 'checked ';
                                                        }
                                                    }
                                                    if(empty($get_data_apl02)){
                                                        echo 'checked';
                                                    }
                                                ?>
                                            >
                                        </div>
                                    </td>

                                    <td class="border-start">
                                        <select name="<?='bukti_relavan_'.$kode_kuk_clear?>" class="form-select form-select-sm" required>
                                            <option value="">-- Pilih Bukti --</option>
                                            <?php foreach($get_bukti_relavan_apl02 as $bukti_relavan_apl02){?>
                                                <option value="<?= $bukti_relavan_apl02['file_bukti']?>"
                                                    <?php
                                                        //Cek File Bukti APl 02 di Database
                                                        foreach($get_data_apl02 as $data_apl02){
                                                            if(($data_apl02['kode_kuk'] == $master_kriteria_unjuk_kerja['kode_kuk']) && ($data_apl02['bukti_relavan'] == $bukti_relavan_apl02['file_bukti'])){
                                                                echo 'selected ';
                                                            }
                                                        }
                                                    ?>
                                                ><?= $bukti_relavan_apl02['nama_bukti']?></option>
                                            <?php }?>
                                        </select>
                                    </td>
                                </tr>
                                <?php
                                        }
                                    }
                                ?>
                                <?php
                                        }
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                <?php
                        }
                    }
                ?>
                    
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-modern btn-md px-5 shadow-sm">
                            <i class="fa-solid fa-floppy-disk me-2"></i> Simpan Data Asesmen
                        </button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

<?php if ($this->session->flashdata('success')): ?>
<script>
    swal({
        title: "Berhasil!",
        text: "Data Asesmen Mandiri Berhasil Disimpan.",
        icon: "success", /* Mengubah menjadi icon default SweetAlert yang jauh lebih rapi */
        button: "Tutup",
        timer: 5000,
    });
</script>
<?php endif; ?>

</body>
</html>