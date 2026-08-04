<div class="col-xl-7 col-md-12 mb-4">
    <div class="card shadow h-100">
        <div class="card-header bg-primary text-white">Upload & Preview Absensi</div>
        <div class="card-body">
            <form action="<?= base_url('Admin/simpan_absensi_pra_asesmen'); ?>" method="POST"
                enctype="multipart/form-data">

                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                    value="<?= $this->security->get_csrf_hash(); ?>" />

                <input type="hidden" name="kode_jadwal" value="<?= $kode_jadwal; ?>">

                <div class="form-group">
                    <label>Pilih File Absen (PDF/JPG/PNG):</label>
                    <input type="file" name="file_absen" class="form-control-file mb-3" required>
                    <button type="submit" class="btn btn-success"><i class="fas fa-upload mr-1"></i> Upload
                        File</button>
                </div>
            </form>

            <hr>

            <?php if (!empty($get_absen_terakhir)): ?>
                <div class="mt-4 p-3 bg-light border rounded">
                    <h6 class="font-weight-bold text-gray-800 mb-3"><i class="fas fa-file-pdf"></i> Dokumen Sudah Diunggah:
                    </h6>

                    <a href="<?= base_url('uploads/absensi_pra_asesmen/' . $get_absen_terakhir->file_absen); ?>"
                        target="_blank" class="btn btn-info btn-block">
                        <i class="fas fa-external-link-alt mr-1"></i> Buka/Lihat Dokumen di Tab Baru
                    </a>
                </div>
            <?php else: ?>
                <div class="alert alert-warning mt-4">
                    <i class="fas fa-exclamation-circle"></i> Belum ada dokumen absensi yang diunggah.
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>