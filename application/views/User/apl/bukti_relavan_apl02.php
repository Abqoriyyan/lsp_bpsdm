<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Relevan APL 02</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

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

        .form-upload-container {
            background-color: #f8fbfd;
            border: 1px dashed #ced4da;
            border-radius: 12px;
            padding: 25px;
        }

        .form-label {
            font-weight: 500;
            color: #495057;
            font-size: 0.95rem;
        }

        .form-control {
            border-radius: 8px;
            padding: 0.6rem 1rem;
            font-size: 0.95rem;
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
        }

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

        .btn-modern {
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s;
        }

        .btn-modern:hover {
            transform: translateY(-2px);
        }

        .alert-info-custom {
            background-color: #e0f2fe;
            border-left: 4px solid #0ea5e9;
            color: #0284c7;
            border-radius: 6px;
            font-size: 13px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">

                <div class="card card-modern p-4 p-md-5 mb-4">

                    <div class="d-flex mb-4">
                        <a href="<?= base_url("user/formulir_apl02/") . base64_encode($id_izin); ?>"
                            class="btn btn-outline-secondary btn-sm rounded-pill px-4 btn-modern">
                            <i class="fa-solid fa-arrow-left me-2"></i> Kembali ke Form APL 02
                        </a>
                    </div>

                    <div class="text-center mb-5">
                        <h3 class="fw-bold text-dark m-0">Bukti Relevan</h3>
                        <h6 class="text-secondary mt-2">Keperluan Formulir APL 02</h6>
                        <p class="text-muted mt-3 mb-0">
                            Silahkan tambah atau upload bukti relevan sebagai acuan kompetensi Anda <br>
                            untuk permohonan Id Izin: <span
                                class="badge bg-primary px-3 py-2 fs-6 rounded-pill"><?= $id_izin; ?></span>
                        </p>
                    </div>

                    <div class="form-upload-container mb-5 shadow-sm">
                        <form action="<?= base_url('user/save_bukti_relavan_apl02/') . base64_encode($id_izin); ?>"
                            method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                                value="<?= $this->security->get_csrf_hash(); ?>" />

                            <h5 class="fw-bold text-primary mb-4">
                                <i class="fa-solid fa-cloud-arrow-up me-2"></i> Upload Bukti Baru
                            </h5>

                            <div class="row g-4 align-items-end">
                                <div class="col-md-5">
                                    <label class="form-label">Nama Bukti</label>
                                    <input type="text" class="form-control" name="nama_bukti"
                                        placeholder="Contoh: Ijazah/Sertifikat Pelatihan" required>
                                </div>
                                <div class="col-md-5">
                                    <label class="form-label">Pilih File Bukti</label>
                                    <input type="file" class="form-control" name="file_bukti" required>
                                </div>
                                <div class="col-md-2 text-md-end text-center mt-4 mt-md-0">
                                    <button type="submit" class="btn btn-primary btn-modern w-100 px-3">
                                        <i class="fa-solid fa-cloud-arrow-up me-2"></i> Upload
                                    </button>
                                </div>
                            </div>

                            <div class="alert alert-info-custom mt-4 mb-0 p-3">
                                <i class="fa-solid fa-circle-info me-2"></i> <strong>Catatan:</strong> File yang
                                diizinkan memiliki ukuran maksimal <strong>10 MB</strong> dengan ekstensi <strong>.jpg |
                                    .jpeg | .png | .pdf</strong>
                            </div>

                        </form>
                    </div>

                    <div class="d-flex align-items-center mb-3">
                        <i class="fa-solid fa-list-check fs-4 text-primary me-2"></i>
                        <h4 class="m-0 fw-bold text-dark">Daftar Bukti Tersimpan</h4>
                    </div>

                    <div class="card-body table-responsive">
                        <table class="table table-bordered table-striped table-hover table-sm table-compact w-100"
                            id="dataTable" cellspacing="0">
                            <thead class="text-center">
                                <tr class="text-center">
                                    <th class="text-center" style="width: 5%;">No</th>
                                    <th style="width: 50%;">Nama Bukti</th>
                                    <th class="text-center" style="width: 25%;">Lihat Dokumen</th>
                                    <th class="text-center" style="width: 20%;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                if (empty($get_bukti_relavan_apl02)) {
                                    echo '<tr><td colspan="4" class="text-center py-4 text-muted">Belum ada bukti relevan yang ditambahkan.</td></tr>';
                                } else {
                                    foreach ($get_bukti_relavan_apl02 as $bukti_relavan_apl02) {
                                        ?>
                                        <tr>
                                            <td class="text-center fw-bold text-secondary"><?= $no++ ?></td>
                                            <td>
                                                <span
                                                    class="fw-medium text-dark"><?= html_escape($bukti_relavan_apl02['nama_bukti']) ?></span>
                                            </td>
                                            <td class="text-center">
                                                <a href="<?= base_url('uploads/file_permohonan/bukti_apl02/') . $bukti_relavan_apl02['file_bukti'] ?>"
                                                    target="_blank"
                                                    class="btn btn-sm btn-info text-white rounded-pill px-3 shadow-sm btn-modern">
                                                    <i class="fa-regular fa-eye sm-1"></i> View File
                                                </a>
                                            </td>
                                            <td class="text-center">
                                                <a href="<?= base_url('user/delete_bukti_relavan_apl02/') . $bukti_relavan_apl02['id'] . "/" . base64_encode($id_izin); ?>"
                                                    class="btn btn-sm btn-danger rounded-pill px-3 shadow-sm btn-modern"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus Bukti Relevan (<?= $bukti_relavan_apl02['nama_bukti'] ?>)?');">
                                                    <i class="fa-regular fa-trash-can sm-1"></i> Hapus
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
        crossorigin="anonymous"></script>

</body>

</html>

<?php if ($this->session->flashdata('success')): ?>
    <script>
        swal({
            title: "Berhasil",
            text: "Bukti Relevan untuk Form APL 02 Berhasil Ditambahkan",
            icon: "<?= base_url('assets/img/success.png') ?>",
            button: false,
            timer: 5000,
        });
    </script>
<?php endif; ?>

<?php if ($this->session->flashdata('gagal')): ?>
    <script>
        swal({
            title: "Gagal",
            text: "Bukti Gagal Ditambahkan. Pastikan ukuran file tidak lebih dari 10 MB dan berekstensi .jpg, .jpeg, .png, atau .pdf",
            icon: "<?= base_url('assets/img/failed.png') ?>",
            button: false,
            timer: 5000,
        });
    </script>
<?php endif; ?>