<div class="container-fluid">

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Sidang Komite Teknis</h1>
    </div>

    <!-- Menampilkan pesan flashdata dari controller -->
    <?= $this->session->flashdata('pesan'); ?>

    <div class="row">
        <div class="col-xl-12 col-md-12 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3 bg-primary">
                    <h6 class="m-0 font-weight-bold text-white">Manajemen Tim Komite Teknis</h6>
                </div>
                <div class="card-body">

                    <ul class="nav nav-tabs" id="komiteTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="penunjukan-tab" data-toggle="tab"
                                data-target="#penunjukan" type="button" role="tab">
                                <i class="fas fa-file-alt mr-1"></i> Surat Penunjukan (3 Orang)
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="absensi-tab" data-toggle="tab" data-target="#absensi"
                                type="button" role="tab">
                                <i class="fas fa-user-check mr-1"></i> Absensi Tim
                            </button>
                        </li>
                    </ul>

                    <div class="tab-content pt-4" id="komiteTabContent">

                        <!-- TAB 1: SURAT PENUNJUKAN -->
                        <div class="tab-pane fade show active" id="penunjukan" role="tabpanel">
                            <div class="row">
                                <div class="col-md-6">
                                    <form action="<?= base_url('Admin/simpan_sk_komite'); ?>" method="POST">
                                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                                        <input type="hidden" name="id_izin" value="<?= isset($id_izin) ? $id_izin : ''; ?>">

                                        <div class="form-group">
                                            <label class="font-weight-bold">Nomor Surat Penunjukan</label>
                                            <input type="text" class="form-control" name="no_surat" placeholder="Contoh: 001/LSP-BPSDM/ST-KT/V/2026" value="<?= isset($get_penunjukan->no_surat) ? $get_penunjukan->no_surat : ''; ?>" required>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="font-weight-bold">Anggota Komite Teknis 1 (Ketua)</label>
                                            <select class="form-control" name="ketua_komite" required>
                                                <option value="">-- Pilih Ketua Komite --</option>
                                                <?php if(!empty($get_master_komite)): foreach($get_master_komite as $komite): ?>
                                                    <option value="<?= $komite['nama']; ?>" <?= (isset($get_penunjukan->ketua_komite) && $get_penunjukan->ketua_komite == $komite['nama']) ? 'selected' : ''; ?>>
                                                        <?= $komite['nama']; ?>
                                                    </option>
                                                <?php endforeach; endif; ?>
                                            </select>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="font-weight-bold">Anggota Komite Teknis 2 (Anggota)</label>
                                            <select class="form-control" name="anggota_1" required>
                                                <option value="">-- Pilih Anggota 1 --</option>
                                                <?php if(!empty($get_master_komite)): foreach($get_master_komite as $komite): ?>
                                                    <option value="<?= $komite['nama']; ?>" <?= (isset($get_penunjukan->anggota_1) && $get_penunjukan->anggota_1 == $komite['nama']) ? 'selected' : ''; ?>>
                                                        <?= $komite['nama']; ?>
                                                    </option>
                                                <?php endforeach; endif; ?>
                                            </select>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="font-weight-bold">Anggota Komite Teknis 3 (Anggota)</label>
                                            <select class="form-control" name="anggota_2" required>
                                                <option value="">-- Pilih Anggota 2 --</option>
                                                <?php if(!empty($get_master_komite)): foreach($get_master_komite as $komite): ?>
                                                    <option value="<?= $komite['nama']; ?>" <?= (isset($get_penunjukan->anggota_2) && $get_penunjukan->anggota_2 == $komite['nama']) ? 'selected' : ''; ?>>
                                                        <?= $komite['nama']; ?>
                                                    </option>
                                                <?php endforeach; endif; ?>
                                            </select>
                                        </div>
                                        
                                        <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i> Simpan Penunjukan</button>
                                    </form>
                                </div>

                                <div class="col-md-6 border-left">
                                    <h5 class="font-weight-bold">Status SK Penunjukan</h5>
                                    <?php if(isset($get_penunjukan->no_surat)): ?>
                                        <div class="alert alert-success">
                                            <i class="fas fa-check-circle mr-1"></i> SK Komite Teknis telah diterbitkan dengan nomor: <br>
                                            <strong><?= $get_penunjukan->no_surat; ?></strong>
                                        </div>
                                        <!-- Tombol cetak PDF disiapkan untuk tahap selanjutnya -->
                                        <a href="<?= base_url('Admin/cetak_sk_komite/'.base64_encode($id_izin)); ?>" target="_blank" class="btn btn-info"><i class="fas fa-print mr-1"></i> Cetak SK Penunjukan (PDF)</a>
                                    <?php else: ?>
                                        <div class="alert alert-warning">
                                            <i class="fas fa-exclamation-triangle mr-1"></i> Belum ada SK Penunjukan yang diterbitkan untuk permohonan ini.
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <!-- TAB 2: ABSENSI -->
                        <div class="tab-pane fade" id="absensi" role="tabpanel">
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle mr-1"></i> Absensi ini digunakan sebagai bukti pemenuhan
                                syarat kelengkapan laporan keputusan sidang pleno BNSP.
                            </div>
                            
                            <form action="<?= base_url('Admin/simpan_absensi_komite'); ?>" method="POST">
                                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                                <input type="hidden" name="id_izin" value="<?= isset($id_izin) ? $id_izin : ''; ?>">
                                
                                <table class="table table-bordered">
                                    <thead class="thead-light">
                                        <tr class="text-center">
                                            <th width="5%">No</th>
                                            <th width="45%">Nama Personil Komite</th>
                                            <th width="25%">Jabatan Tim</th>
                                            <th width="25%">Status Kehadiran</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Looping untuk 3 Formasi Absensi Berdasarkan Data Penunjukan -->
                                        <?php 
                                        // Cek apakah formasi sudah diisi di tab 1
                                        $nama_ketua = isset($get_penunjukan->ketua_komite) ? $get_penunjukan->ketua_komite : '';
                                        $nama_anggota1 = isset($get_penunjukan->anggota_1) ? $get_penunjukan->anggota_1 : '';
                                        $nama_anggota2 = isset($get_penunjukan->anggota_2) ? $get_penunjukan->anggota_2 : '';

                                        // Cek data absensi jika sudah pernah disimpan
                                        $hadir_ketua = ''; $absen_ketua = '';
                                        $hadir_anggota1 = ''; $absen_anggota1 = '';
                                        $hadir_anggota2 = ''; $absen_anggota2 = '';

                                        if(!empty($get_absensi)) {
                                            // Asumsi index 0 = Ketua, 1 = Anggota 1, 2 = Anggota 2
                                            if(isset($get_absensi[0])) {
                                                if($get_absensi[0]['status_kehadiran'] == 'Hadir') $hadir_ketua = 'selected';
                                                else $absen_ketua = 'selected';
                                            }
                                            if(isset($get_absensi[1])) {
                                                if($get_absensi[1]['status_kehadiran'] == 'Hadir') $hadir_anggota1 = 'selected';
                                                else $absen_anggota1 = 'selected';
                                            }
                                            if(isset($get_absensi[2])) {
                                                if($get_absensi[2]['status_kehadiran'] == 'Hadir') $hadir_anggota2 = 'selected';
                                                else $absen_anggota2 = 'selected';
                                            }
                                        }
                                        ?>
                                        
                                        <!-- Baris Ketua -->
                                        <tr>
                                            <td class="text-center">1</td>
                                            <td>
                                                <input type="text" class="form-control" name="nama_personil[]" value="<?= $nama_ketua; ?>" required <?= empty($nama_ketua) ? 'placeholder="Isi form penunjukan terlebih dahulu!" readonly' : 'readonly'; ?>>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control border-0 bg-white" name="jabatan_tim[]" value="Ketua Komite Teknis" readonly>
                                            </td>
                                            <td class="text-center">
                                                <select class="form-control form-control-sm" name="status_kehadiran[]" <?= empty($nama_ketua) ? 'disabled' : ''; ?>>
                                                    <option value="Hadir" <?= $hadir_ketua; ?>>Hadir</option>
                                                    <option value="Absen" <?= $absen_ketua; ?>>Absen</option>
                                                </select>
                                            </td>
                                        </tr>

                                        <!-- Baris Anggota 1 -->
                                        <tr>
                                            <td class="text-center">2</td>
                                            <td>
                                                <input type="text" class="form-control" name="nama_personil[]" value="<?= $nama_anggota1; ?>" required <?= empty($nama_anggota1) ? 'readonly' : 'readonly'; ?>>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control border-0 bg-white" name="jabatan_tim[]" value="Anggota" readonly>
                                            </td>
                                            <td class="text-center">
                                                <select class="form-control form-control-sm" name="status_kehadiran[]" <?= empty($nama_anggota1) ? 'disabled' : ''; ?>>
                                                    <option value="Hadir" <?= $hadir_anggota1; ?>>Hadir</option>
                                                    <option value="Absen" <?= $absen_anggota1; ?>>Absen</option>
                                                </select>
                                            </td>
                                        </tr>

                                        <!-- Baris Anggota 2 -->
                                        <tr>
                                            <td class="text-center">3</td>
                                            <td>
                                                <input type="text" class="form-control" name="nama_personil[]" value="<?= $nama_anggota2; ?>" required <?= empty($nama_anggota2) ? 'readonly' : 'readonly'; ?>>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control border-0 bg-white" name="jabatan_tim[]" value="Anggota" readonly>
                                            </td>
                                            <td class="text-center">
                                                <select class="form-control form-control-sm" name="status_kehadiran[]" <?= empty($nama_anggota2) ? 'disabled' : ''; ?>>
                                                    <option value="Hadir" <?= $hadir_anggota2; ?>>Hadir</option>
                                                    <option value="Absen" <?= $absen_anggota2; ?>>Absen</option>
                                                </select>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                
<div class="mt-3">
    <?php if(!empty($nama_ketua)): ?>
        <button type="submit" class="btn btn-success"><i class="fas fa-check-circle mr-1"></i> Simpan Absensi</button>
        
        <?php if(!empty($get_absensi)): ?>
            <a href="<?= base_url('Admin/cetak_absensi_komite/'.base64_encode($id_izin)); ?>" target="_blank" class="btn btn-info ml-2">
                <i class="fas fa-print mr-1"></i> Cetak Daftar Hadir (PDF)
            </a>
        <?php endif; ?>
        
    <?php else: ?>
        <button type="button" class="btn btn-secondary" disabled><i class="fas fa-check-circle mr-1"></i> Lengkapi Tab Surat Penunjukan Dahulu</button>
    <?php endif; ?>
</div>
                            </form>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

</div>