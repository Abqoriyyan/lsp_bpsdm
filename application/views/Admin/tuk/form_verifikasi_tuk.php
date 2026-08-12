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
<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Form Surat Verifikasi TUK
        </h1>
        <a href="<?= base_url('Admin/list_verifikasi_tuk'); ?>" class="btn btn-outline-secondary btn-sm shadow-sm">
            <i class="fas fa-arrow-left mr-1"></i> Kembali
        </a>
    </div>

    <?= $this->session->flashdata('pesan'); ?>

    <div class="row">
        <div class="container-fluid mt-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3 card-header-custom">
                    <h6 class="m-0 font-weight-bold text-white">
                        <i class="fas fa-calendar-alt mr-1"></i> Informasi Jadwal Asesmen
                    </h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-borderless table-sm m-0">
                            <tr>
                                <td width="20%" class="font-weight-bold text-gray-800">Kode Jadwal</td>
                                <td width="2%">:</td>
                                <td>
                                    <?= isset($get_jadwal->kode_jadwal) ? $get_jadwal->kode_jadwal : '-'; ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold text-gray-800">Nama Jadwal</td>
                                <td>:</td>
                                <td><?= isset($get_jadwal->nama_jadwal) ? $get_jadwal->nama_jadwal : '-'; ?></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold text-gray-800">Tempat Uji Kompetensi (TUK)</td>
                                <td>:</td>
                                <td>
                                    <?= isset($get_jadwal->nama_tuk) ? $get_jadwal->nama_tuk : '-'; ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold text-gray-800">Alamat TUK</td>
                                <td>:</td>
                                <td>
                                    <?= isset($get_jadwal->alamat) ? $get_jadwal->alamat : '-'; ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold text-gray-800 align-middle">Tanggal Asesmen</td>
                                <td class="align-middle">:</td>
                                <td>
                                    <?= isset($get_jadwal->tanggal_mulai) ? date('d M Y', strtotime($get_jadwal->tanggal_mulai)) : '-'; ?>
                                    s/d
                                    <?= isset($get_jadwal->tanggal_selesai) ? date('d M Y', strtotime($get_jadwal->tanggal_selesai)) : '-'; ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid mt-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3 card-header-custom">
                    <h6 class="m-0 font-weight-bold text-white">
                        <i class="fas fa-file-signature mr-1"></i> Data & File Surat Verifikasi
                    </h6>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('Admin/simpan_verifikasi_tuk'); ?>" method="POST"
                        enctype="multipart/form-data">

                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                            value="<?= $this->security->get_csrf_hash(); ?>" />
                        <input type="hidden" name="kode_jadwal" value="<?= $kode_jadwal; ?>">

                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label class="font-weight-bold text-gray-800">Nomor Surat Verifikasi</label>
                                <input type="text" class="form-control" name="no_surat"
                                    placeholder="Contoh: 010/LSP/SV/2026"
                                    value="<?= isset($get_verifikasi->no_surat) ? $get_verifikasi->no_surat : ''; ?>"
                                    required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="font-weight-bold text-gray-800">Jenis TUK</label>
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

                            <div class="col-md-6 mb-3">
                                <label class="font-weight-bold text-gray-800">Nama Verifikator</label>
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

                        <div class="form-group mt-3 p-3 bg-light border rounded">
                            <label class="font-weight-bold text-gray-800">
                                <i class="fas fa-paperclip text-secondary mr-1"></i> Upload Dokumen Hasil Verifikasi
                                (PDF/Image)
                            </label>
                            <input type="file" class="form-control-file mt-2" name="file_verifikasi"
                                accept=".pdf, .jpg, .jpeg, .png">
                            <small class="text-muted d-block mt-2">
                                <i class="fas fa-info-circle"></i> Maksimal 5MB. Abaikan jika tidak ingin mengubah file
                                yang sudah ada.
                            </small>
                        </div>

                        <div class="mt-4 pt-3 border-top text-right">
                            <button type="submit" class="btn btn-success px-4 shadow-sm">
                                <i class="fas fa-save mr-1"></i> Simpan
                            </button>
                        </div>
                    </form>

                    <?php if (isset($get_verifikasi->file_verifikasi) && !empty($get_verifikasi->file_verifikasi)): ?>
                        <hr class="my-4">
                        <div class="p-3 border-left-info rounded bg-white shadow-sm border"
                            style="border-left-width: 4px !important;">
                            <h6 class="font-weight-bold text-info mb-3">
                                <i class="fas fa-file-alt mr-1"></i> Dokumen Verifikasi Terlampir
                            </h6>
                            <?php $file_url = base_url('uploads/file_verifikasi/' . $get_verifikasi->file_verifikasi); ?>
                            <a href="<?= $file_url; ?>" target="_blank" class="btn btn-outline-info">
                                <i class="fas fa-external-link-alt mr-1"></i> Buka/Lihat Dokumen di Tab Baru
                            </a>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>

</div>