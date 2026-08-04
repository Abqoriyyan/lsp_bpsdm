<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pra Asesmen</title>

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
    <div class="container-fluid mt-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3 card-header-custom">
                <h6 class="m-0 font-weight-bold text-white">
                    <i class="fas fa-file-signature"></i> Pra Asesmen
                </h6>
            </div>
            <div class="container">
                <b>Catatan:</b> Pastikan Semua Data / Form Pra-Asesmen Telah dilengkapi sebelum lanjut ke tahap
                asesmen<br />
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6 text-center">
                            <a href="<?= base_url('asesor/form_apl01/') . base64_encode($id_izin); ?>"
                                class="btn btn-success" target="_blank">Form APL 01</a>
                        </div>
                        <div class="col-sm-6 text-center">
                            <a href="<?= base_url('asesor/form_apl02/') . base64_encode($id_izin); ?>"
                                class="btn btn-success" target="_blank">Form APL 02</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>