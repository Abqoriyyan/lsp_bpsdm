<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Manajemen Token API BNSP</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Generate Token API BNSP</h5>
                    </div>
                    <div class="card-body">
                        <div id="alert-message"></div>

                        <div class="form-group">
                            <label class="font-weight-bold">Status Token Saat Ini:</label>
                            <?php
                            $is_expired = empty($token_data->expire_date)
                                ?>
                            <div id="status-badge">
                                <?php if ($is_expired): ?>
                                    <span class="badge badge-danger p-2">Kadaluarsa/Tidak Aktif</span>
                                <?php else: ?>
                                    <span class="badge badge-success p-2">Aktif</span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold">Tanggal Kadaluarsa:</label>
                            <p id="expire-display" class="form-control-plaintext border-bottom">
                                <?= !empty($token_data->expire_date) ? date('d M Y H:i:s', strtotime($token_data->expire_date)) : '-' ?>
                            </p>
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold">Token Authorization:</label>
                            <textarea id="token-display" class="form-control" rows="3"
                                readonly><?= !empty($token_data->x_authorization) ? $token_data->x_authorization : '' ?></textarea>
                        </div>

                        <button id="btn-generate" class="btn btn-primary btn-block">
                            <span id="btn-text">Generate Token Baru</span>
                            <span id="btn-spinner" class="spinner-border spinner-border-sm d-none" role="status"></span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#btn-generate').on('click', function () {
                var $btn = $(this);
                $btn.prop('disabled', true); $('#btn-text').text('Memproses...');
                $('#btn-spinner').removeClass('d-none');
                $('#alert-message').html('');

                $.ajax({
                    url: "<?= site_url('admin/bnsp_token/generate') ?>",
                    type: "POST",
                    dataType: "JSON",
                    success: function (response) {
                        if (response.status) {
                            $('#alert-message').html('<div class="alert alert-success">' + response.message + '</div>');
                            $('#token-display').val(response.token);
                            $('#expire-display').text(response.expire_date);
                            $('#status-badge').html('<span class="badge badge-success p-2">Aktif</span>');
                        } else {
                            $('#alert-message').html('<div class="alert alert-danger">' + response.message + '</div>');
                        }
                    },
                    error: function () {
                        $('#alert-message').html('<div class="alert alert-danger">Terjadi kesalahan koneksi ke server.</div>');
                    },
                    complete: function () {
                        $btn.prop('disabled', false); $('#btn-text').text('Generate Token Baru');
                        $('#btn-spinner').addClass('d-none');
                    }
                });
            });
        });
    </script>
</body>

</html>