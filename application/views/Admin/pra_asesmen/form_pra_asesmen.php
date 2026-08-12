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

<div class="container-fluid mt-4">
    <div class="card shadow mb-4">
        <div class="card-header py-3 card-header-custom">
            <h6 class="m-0 font-weight-bold text-white">
                <i class="fas fa-file-upload mr-2"></i>Absensi Pra Asesmen
            </h6>
        </div>
        <div class="card-body">

            <form action="<?= base_url('Admin/simpan_absensi_pra_asesmen'); ?>" method="POST"
                enctype="multipart/form-data">

                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                    value="<?= $this->security->get_csrf_hash(); ?>" />
                <input type="hidden" name="kode_jadwal" value="<?= $kode_jadwal; ?>">

                <div class="form-group border rounded p-3 bg-light">
                    <label class="font-weight-bold text-gray-800">
                        <i class="fas fa-paperclip mr-1 text-secondary"></i> Pilih File Absen (PDF/JPG/PNG)
                    </label>
                    <input type="file" name="file_absen" class="form-control-file mt-2 mb-3"
                        accept=".pdf,.jpg,.jpeg,.png" required>
                    <button type="submit" class="btn btn-success px-4">
                        <i class="fas fa-upload mr-1"></i> Upload File
                    </button>
                </div>
            </form>

            <hr class="my-4">

            <?php if (!empty($get_absen_terakhir)): ?>
                <div class="p-3 border-left-info rounded bg-white shadow-sm border"
                    style="border-left-width: 4px !important;">
                    <h6 class="font-weight-bold text-info mb-3">
                        <i class="fas fa-file-alt mr-1"></i> Dokumen Sudah Diunggah
                    </h6>
                    <a href="<?= base_url('uploads/absensi_pra_asesmen/' . $get_absen_terakhir->file_absen); ?>"
                        target="_blank" class="btn btn-outline-info btn-block">
                        <i class="fas fa-external-link-alt mr-1"></i> Buka/Lihat Dokumen di Tab Baru
                    </a>
                </div>
            <?php else: ?>
                <div class="alert alert-warning border-left-warning shadow-sm d-flex align-items-center"
                    style="border-left-width: 4px !important;">
                    <i class="fas fa-info-circle fa-2x mr-3"></i>
                    <div>
                        <h6 class="mb-0 font-weight-bold">Belum ada dokumen</h6>
                        <small>Silakan upload file absensi di atas.</small>
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php if ($this->session->flashdata('success')): ?>
    <script>
        Swal.fire({
            title: "Berhasil!",
            text: "File berhasil diunggah",
            icon: "success",
            iconColor: "#00db62",
            showConfirmButton: false,
            timer: 3000
        });
    </script>
<?php endif; ?>

<?php if ($this->session->flashdata('error')): ?>
    <script>
        Swal.fire({
            title: "Gagal!",
            text: "File gagal diunggah",
            icon: "error",
            iconColor: "#db0000",
            showConfirmButton: false,
            timer: 3000
        });
    </script>
<?php endif; ?>