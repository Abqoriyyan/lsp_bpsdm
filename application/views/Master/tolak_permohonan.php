<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tolak Permohonan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* CSS ringan hanya untuk mempercantik form, tidak akan merusak layout utama */
        .form-control-modern {
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            padding: 0.75rem 1rem;
            transition: all 0.2s ease;
        }

        .form-control-modern:focus {
            border-color: #ef4444;
            box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.15);
        }

        .btn-tolak {
            background-color: #ef4444;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            transition: all 0.2s ease;
        }

        .btn-tolak:hover {
            background-color: #dc2626;
            color: white;
            transform: translateY(-1px);
        }
    </style>
</head>

<body>
    <div class="container-fluid mt-4 mb-5">
        <div class="row">
            <div class="col-md-8 offset-md-2 col-lg-6 offset-lg-3">

                <div class="card shadow-sm border-0 rounded-4">
                    <div class="card-body p-4 p-md-5">

                        <div class="text-center mb-4">
                            <h3 class="fw-bold text-dark mb-1">Tolak Permohonan</h3>
                            <p class="text-muted">Silakan masukkan Id Izin dan alasan penolakan</p>
                        </div>

                        <form action="<?= base_url('Admin/insert_tolak_permohonan') ?>" method="POST">

                            <div class="mb-3">
                                <label for="id_izin" class="form-label fw-semibold text-secondary">Id Izin</label>
                                <input type="text" id="id_izin" name="id_izin" placeholder="Contoh: I-2026001XXXXXXXXX"
                                    class="form-control form-control-modern" required>
                            </div>

                            <div class="mb-4">
                                <label for="catatan" class="form-label fw-semibold text-secondary">Catatan</label>
                                <textarea id="catatan" name="catatan" rows="4" class="form-control form-control-modern"
                                    placeholder="Tuliskan catatan penolakan di sini..."></textarea>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-tolak">
                                    Proses Tolak Permohonan
                                </button>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?php if ($this->session->flashdata('success')): ?>
        <script>
            Swal.fire({
                title: "Berhasil!",
                text: "Tolak Permohonan Berhasil diproses.",
                icon: "success",
                iconColor: "#ef4444",
                showConfirmButton: false,
                timer: 3000
            });
        </script>
    <?php endif; ?>

</body>

</html>