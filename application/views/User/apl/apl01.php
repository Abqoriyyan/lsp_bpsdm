<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir APL 01</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        }

        .card {
            border: none;
            border-radius: 12px;
        }

        .form-label {
            font-weight: 600;
            color: #495057;
        }

        .form-control,
        .form-select {
            border-radius: 8px;
            padding: 0.6rem 0.75rem;
            border: 1px solid #ced4da;
        }

        .form-control:focus,
        .form-select:focus {
            box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.15);
        }

        .signature-container {
            border: 2px dashed #ced4da;
            border-radius: 8px;
            background-color: #ffffff;
            position: relative;
            overflow: hidden;
        }

        canvas {
            display: block;
            width: 100%;
            height: 200px;
            cursor: crosshair;
        }

        .img-preview-ttd {
            max-width: 100%;
            height: 200px;
            object-fit: contain;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            background-color: #fff;
            padding: 10px;
        }
    </style>
</head>

<body>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12">

                <div class="card shadow-sm p-4 p-md-5 mb-4 bg-white">
                    <div class="text-center mb-4">
                        <h3 class="m-0 font-weight-bold text-dark text-center">Formulir APL 01</h3>
                        <p class="text-muted col-md-8 mx-auto">
                            Lengkapi data di bawah ini untuk keperluan kelengkapan dokumen Formulir APL 01 pada
                            permohonan Id Izin:
                            <span
                                class="badge bg-primary fs-6"><?= !empty($get_data_apl01->id_izin) ? $get_data_apl01->id_izin : '-' ?></span>
                        </p>
                    </div>

                    <form
                        action="<?php echo base_url('User/insert_pekerjaan_sekarang_apl01/') . base64_encode($get_data_apl01->id_izin) ?>"
                        method="POST" onsubmit="return confirm('Konfirmasi Simpan Data Form APL-01?')">
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                            value="<?= $this->security->get_csrf_hash(); ?>" />

                        <div class="alert alert-light border-start border-primary border-3 mb-4" role="alert">
                            <h6 class="m-0 fw-bold text-primary"><i class="fa-solid fa-briefcase me-2"></i>Data
                                Pekerjaan Sekarang</h6>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Unit Kerja</label>
                                    <input type="text" class="form-control" name="perusahaan"
                                        value="<?php echo html_escape($get_data_apl01->pekerjaan_sekarang_perusahaan); ?>"
                                        placeholder="Unit Kerja">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Alamat Kantor</label>
                                    <input type="text" class="form-control" name="alamat_kantor"
                                        value="<?php echo html_escape($get_data_apl01->pekerjaan_sekarang_alamat_kantor); ?>"
                                        placeholder="Alamat">
                                </div>
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Kode Pos</label>
                                        <input type="number" class="form-control" name="kodepos_kantor"
                                            value="<?php echo html_escape($get_data_apl01->pekerjaan_sekarang_kodepos_kantor); ?>"
                                            placeholder="Contoh: 54321">
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Telepon Kantor</label>
                                        <input type="text" class="form-control" name="telepon_kantor"
                                            value="<?php echo html_escape($get_data_apl01->pekerjaan_sekarang_notlp_kantor); ?>"
                                            placeholder="Nomor Telepon">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Jabatan</label>
                                    <input type="text" class="form-control" name="jabatan"
                                        value="<?php echo html_escape($get_data_apl01->pekerjaan_sekarang_jabatan); ?>"
                                        placeholder="Jabatan">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Jenis Pekerjaan</label>
                                    <select name="id_pekerjaan" class="form-select">
                                        <option value="">-- Pilih Jenis Pekerjaan --</option>
                                        <?php foreach ($get_master_pekerjaan as $master_pekerjaan) { ?>
                                            <option value="<?= $master_pekerjaan['id'] ?>"
                                                <?= (!empty($get_data_apl01->id_pekerjaan) && $get_data_apl01->id_pekerjaan == $master_pekerjaan['id']) ? 'selected' : '' ?>>
                                                <?= $master_pekerjaan['deskripsi'] ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Fax Kantor</label>
                                        <input type="text" class="form-control" name="fax_kantor"
                                            value="<?php echo html_escape($get_data_apl01->pekerjaan_sekarang_fax_kantor); ?>"
                                            placeholder="Nomor Fax">
                                    </div>
                                    <div class="col-6 mb-3">
                                        <label class="form-label">Email Kantor</label>
                                        <input type="email" class="form-control" name="email_kantor"
                                            value="<?php echo html_escape($get_data_apl01->pekerjaan_sekarang_email_kantor); ?>"
                                            placeholder="email@kantor.com">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-center mb-4">
                            <button type="submit" class="btn btn-primary px-5 py-2 btn-md shadow-sm">
                                <i class="fa fa-save me-2"></i> Simpan Data Utama
                            </button>
                        </div>
                    </form>

                    <hr class="my-5 text-muted">

                    <div id="signature-section">
                        <div class="alert alert-light border-start border-warning border-3 mb-3" role="alert">
                            <h6 class="m-0 fw-bold text-dark"><i class="fa-solid fa-pen-nib text-warning me-2"></i>Tanda
                                Tangan</h6>
                        </div>
                        <p class="text-muted small mb-4">
                            <i class="fa-solid fa-circle-info me-1"></i> Tanda tangan di bawah ini akan digunakan secara
                            otomatis untuk keperluan berkas pada Dokumen Form APL 01 dan APL 02.
                        </p>

                        <div class="row g-4">
                            <div class="col-md-6" id="signature-pad-wrapper">
                                <label class="form-label d-block text-center fw-bold text-secondary mb-2">Goreskan Tanda
                                    Tangan Anda Disini</label>
                                <div class="signature-container shadow-sm mb-3">
                                    <canvas id="signature-canvas"></canvas>
                                </div>
                                <input type="hidden" value="<?php echo rand(); ?>" id="rowno">

                                <div class="d-flex justify-content-center gap-2">
                                    <button type="button" id="btn-save-signature"
                                        class="btn btn-success px-4 shadow-sm">
                                        <i class="fa fa-check me-2"></i>Simpan TTD
                                    </button>
                                    <button type="button" id="btn-clear-signature" class="btn btn-outline-danger px-4">
                                        <i class="fa fa-trash-can me-2"></i>Clear
                                    </button>
                                </div>
                            </div>

                            <div class="col-md-6 text-center">
                                <label class="form-label d-block fw-bold text-secondary mb-2">Tanda Tangan Aktif Saat
                                    Ini</label>
                                <div class="d-flex align-items-center justify-content-center h-75">
                                    <?php if (empty($get_data_apl01->ttd_pemohon)) { ?>
                                        <div class="alert alert-danger w-100 py-4 m-0 border-0 shadow-sm" role="alert">
                                            <i class="fa-solid fa-triangle-exclamation fa-2x mb-2 text-danger"></i>
                                            <p class="m-0 small fw-bold">Belum di Tanda Tangani untuk Keperluan
                                                APL-01.<br>Silahkan lakukan tanda tangan di area pad kiri.</p>
                                        </div>
                                    <?php } else { ?>
                                        <img class="img-preview-ttd shadow-sm"
                                            src="<?= base_url('uploads/file_permohonan/ttd_pemohon_apl01_apl02/') . $get_data_apl01->ttd_pemohon ?>"
                                            alt="Tanda Tangan Pemohon" />
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/signature-pad.js"></script>

    <script>
        // Inisialisasi Signature Pad
        var wrapper = document.getElementById("signature-pad-wrapper"),
            clearButton = document.getElementById("btn-clear-signature"),
            saveButton = document.getElementById("btn-save-signature"),
            canvas = document.getElementById("signature-canvas"),
            signaturePad;

        function resizeCanvas() {
            var ratio = Math.max(window.devicePixelRatio || 1, 1);
            canvas.width = canvas.offsetWidth * ratio;
            canvas.height = canvas.offsetHeight * ratio;
            canvas.getContext("2d").scale(ratio, ratio);
            signaturePad.clear(); // Bersihkan setelah resize agar grid pas
        }

        signaturePad = new SignaturePad(canvas, {
            backgroundColor: 'rgba(255, 255, 255, 0)', // Transparan agar tersimpan murni bentuk PNG coretan
            penColor: 'rgb(0, 0, 0)'
        });

        // Jalankan resize saat pertama kali dibuka
        window.onresize = resizeCanvas;
        resizeCanvas();

        clearButton.addEventListener("click", function (event) {
            signaturePad.clear();
        });

        saveButton.addEventListener("click", function (event) {
            if (signaturePad.isEmpty()) {
                alert('Silahkan goreskan tanda tangan Anda terlebih dahulu pada area pad.');
                return false;
            }

            if (confirm('Apakah Anda yakin ingin menyimpan perubahan Tanda Tangan / TTD ini?')) {
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url(); ?>User/insert_signature_apl01/<?= base64_encode($get_data_apl01->id_izin) ?>",
                    data: {
                        'image': signaturePad.toDataURL('image/png'),
                        'rowno': $('#rowno').val()
                    },
                    dataType: "JSON",
                    success: function (response) {
                        top.location.href = "<?= base_url('User/formulir_apl01/') . base64_encode($get_data_apl01->id_izin) ?>";
                    },
                    error: function () {
                        top.location.href = "<?= base_url('User/formulir_apl01/') . base64_encode($get_data_apl01->id_izin) ?>";
                    }
                });
            }
        }); 
    </script>
</body>

</html>