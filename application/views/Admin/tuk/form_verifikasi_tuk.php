<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Form Surat Verifikasi TUK</h1>
        <a href="<?= base_url('Admin/list_verifikasi_tuk'); ?>" class="btn btn-secondary btn-sm"><i
                class="fas fa-arrow-left"></i> Kembali</a>
    </div>

    <?= $this->session->flashdata('pesan'); ?>

    <div class="row">
        <!-- Informasi Jadwal (Readonly) -->
        <div class="col-xl-4 col-md-12 mb-4">
            <div class="card shadow h-100">
                <div class="card-header py-3 bg-info">
                    <h6 class="m-0 font-weight-bold text-white"><i class="fas fa-calendar-alt"></i> Informasi Jadwal
                        Asesmen</h6>
                </div>
                <div class="card-body">
                    <table class="table table-borderless table-sm">
                        <tr>
                            <td width="35%" class="font-weight-bold">Kode Jadwal</td>
                            <td width="5%">:</td>
                            <td><?= isset($get_jadwal->kode_jadwal) ? $get_jadwal->kode_jadwal : '-'; ?></td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Nama Jadwal</td>
                            <td>:</td>
                            <td><?= isset($get_jadwal->nama_jadwal) ? $get_jadwal->nama_jadwal : '-'; ?></td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Tempat Uji (TUK)</td>
                            <td>:</td>
                            <td><strong><?= isset($get_jadwal->nama_tuk) ? $get_jadwal->nama_tuk : '-'; ?></strong></td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Alamat TUK</td>
                            <td>:</td>
                            <td><?= isset($get_jadwal->alamat) ? $get_jadwal->alamat : '-'; ?></td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Tanggal Asesmen</td>
                            <td>:</td>
                            <td>
                                <span class="badge badge-primary p-2">
                                    <?= isset($get_jadwal->tanggal_mulai) ? date('d M Y', strtotime($get_jadwal->tanggal_mulai)) : '-'; ?>
                                    s/d
                                    <?= isset($get_jadwal->tanggal_selesai) ? date('d M Y', strtotime($get_jadwal->tanggal_selesai)) : '-'; ?>
                                </span>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <!-- Form Input Surat Verifikasi & Upload -->
        <div class="col-xl-8 col-md-12 mb-4">
            <div class="card shadow h-100">
                <div class="card-header py-3 bg-primary">
                    <h6 class="m-0 font-weight-bold text-white"><i class="fas fa-file-signature"></i> Data & File Surat
                        Verifikasi</h6>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('Admin/simpan_verifikasi_tuk'); ?>" method="POST"
                        enctype="multipart/form-data">

                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                            value="<?= $this->security->get_csrf_hash(); ?>" />

                        <input type="hidden" name="kode_jadwal" value="<?= $kode_jadwal; ?>">

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="font-weight-bold">Nomor Surat Verifikasi</label>
                                    <input type="text" class="form-control" name="no_surat"
                                        placeholder="Contoh: 010/LSP/SV/2026"
                                        value="<?= isset($get_verifikasi->no_surat) ? $get_verifikasi->no_surat : ''; ?>"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Jenis TUK</label>
                                    <select class="form-control" name="jenis_tuk" required>
                                        <option value="">-- Pilih Jenis TUK --</option>
                                        <option value="Sewaktu" <?= (isset($get_verifikasi->jenis_tuk) && $get_verifikasi->jenis_tuk == 'Sewaktu') ? 'selected' : ''; ?>>TUK Sewaktu
                                        </option>
                                        <option value="Mandiri" <?= (isset($get_verifikasi->jenis_tuk) && $get_verifikasi->jenis_tuk == 'Mandiri') ? 'selected' : ''; ?>>TUK Mandiri
                                        </option>
                                        <option value="Tempat Kerja" <?= (isset($get_verifikasi->jenis_tuk) && $get_verifikasi->jenis_tuk == 'Tempat Kerja') ? 'selected' : ''; ?>>TUK Tempat
                                            Kerja</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Nama Verifikator</label>
                                    <select class="form-control" name="nama_verifikator" required>
                                        <option value="">-- Pilih Verifikator --</option>
                                        <?php if (!empty($get_master_verifikator)):
                                            foreach ($get_master_verifikator as $verifikator): ?>
                                                <option value="<?= $verifikator['nama']; ?>"
                                                    <?= (isset($get_verifikasi->nama_verifikator) && $get_verifikasi->nama_verifikator == $verifikator['nama']) ? 'selected' : ''; ?>>
                                                    <?= $verifikator['nama']; ?>
                                                </option>
                                            <?php endforeach; endif; ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-2">
                            <label class="font-weight-bold">Upload Dokumen Hasil Verifikasi (PDF/Image)</label>
                            <input type="file" class="form-control-file" name="file_verifikasi"
                                accept=".pdf, .jpg, .jpeg, .png">
                            <small class="text-muted">*Maksimal 5MB. Abaikan jika tidak ingin mengubah file yang sudah
                                ada.</small>
                        </div>

                        <div class="mt-4 border-top pt-3">
                            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Simpan Data &
                                File</button>
                        </div>
                    </form>

                    <!-- BLOK PRATINJAU FILE (DIUBAH MENJADI TOMBOL) -->
                    <?php if (isset($get_verifikasi->file_verifikasi) && !empty($get_verifikasi->file_verifikasi)): ?>
                        <div class="mt-4 p-3 bg-light border rounded">
                            <h6 class="font-weight-bold m-0"><i class="fas fa-file-alt"></i> Dokumen Verifikasi Terlampir:
                            </h6>
                            <?php $file_url = base_url('uploads/file_verifikasi/' . $get_verifikasi->file_verifikasi); ?>

                            <a href="<?= $file_url; ?>" target="_blank" class="btn btn-info mt-3">
                                <i class="fas fa-external-link-alt mr-1"></i> Lihat Dokumen Verifikasi
                            </a>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>

</div>