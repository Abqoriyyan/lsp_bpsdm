<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir MAPA 01</title>

    <!-- Sweet Alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

	<script src="<?php echo base_url();?>assets/js/jquery-2.1.3.min.js"></script> 
	<script src="<?php echo base_url();?>assets/js/bootstrap.min.js" ></script> 
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/signature-pad.js"></script> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <style>
        form {
            font-size:12px;
        }
    </style>
</head>
<body>
<div class="col-lg-12">
    <div class="card shadow mb-4">
        <br/>
        <h4 class="m-0 font-weight-bold text-primary text-center">Form MAPA 01</h4><br/>
        <div class="col-sm-12"><br/>
            <i>Silahkan Lengkapi Data dibawah ini untuk keperluan Form MAPA 01 <br/>untuk permohonan id izin (<?=$id_izin?>)</i><hr/>
        </div><br/>

        <!-- form -->
        <div class="col-sm-12">
            <h5 class="text-center text-primary"><b><u>Menentukkan Pendekatan Asesmen</u></b></h5>
        </div><br/>
        <form action="<?php echo base_url('Asesor/insert_data_mapa01/').base64_encode($id_izin)?>" method="POST">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label> Kandidat :</label>
                            <select name="kandidat" class="form-select form-control" style="font-size:12px;" required>
                                <option value="">Pilih...</option>
                                <option value="Hasil pelatihan dan / atau pendidikan" <?php if(!empty($get_data_mapa01->kandidat) && $get_data_mapa01->kandidat == 'Hasil pelatihan dan / atau pendidikan'){echo "selected";}?>>Hasil pelatihan dan / atau pendidikan</option>
                                <option value="Pekerja berpengalaman" <?php if(!empty($get_data_mapa01->kandidat) && $get_data_mapa01->kandidat == 'Pekerja berpengalaman'){echo "selected";}?>>Pekerja berpengalaman</option>
                                <option value="Pelatihan / belajar mandiri" <?php if(!empty($get_data_mapa01->kandidat) && $get_data_mapa01->kandidat == 'Pelatihan / belajar mandiri'){echo "selected";}?>>Pelatihan / belajar mandiri</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label> Tujuan Asesmen :</label>
                            <select name="tujuan_asesmen" class="form-select form-control" style="font-size:12px;" required>
                                <option value="">Pilih...</option>
                                <option value="Sertifikasi" <?php if(!empty($get_data_mapa01->tujuan_asesmen) && $get_data_mapa01->tujuan_asesmen == 'Sertifikasi'){echo "selected";}?>>Sertifikasi</option>
                                <option value="Sertifikasi Ulang" <?php if(!empty($get_data_mapa01->tujuan_asesmen) && $get_data_mapa01->tujuan_asesmen == 'Sertifikasi Ulang'){echo "selected";}?>>Sertifikasi Ulang</option>
                                <option value="Pengakuan Kompetensi Terkini (PKT)" <?php if(!empty($get_data_mapa01->tujuan_asesmen) && $get_data_mapa01->tujuan_asesmen == 'Pengakuan Kompetensi Terkini (PKT)'){echo "selected";}?>>Pengakuan Kompetensi Terkini (PKT)</option>
                            </select>
                        </div>
                    </div><br/>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Konteks Asesmen - Lingkungan </label>
                            <select name="lingkungan" class="form-select form-control" style="font-size:12px;" required>
                                <option value="">Pilih...</option>
                                <option value="Tempat kerja nyata" <?php if(!empty($get_data_mapa01->lingkungan) && $get_data_mapa01->lingkungan == 'Tempat kerja nyata'){echo "selected";}?>>Tempat kerja nyata</option>
                                <option value="Tempat kerja simulasi" <?php if(!empty($get_data_mapa01->lingkungan) && $get_data_mapa01->lingkungan == 'Tempat kerja simulasi'){echo "selected";}?>>Tempat kerja simulasi</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Konteks Asesmen - Peluang untuk mengumpulkan bukti dalam sejumlah situasi </label>
                            <select name="peluang_untuk_mengumpulkan_bukti" class="form-select form-control" style="font-size:12px;" required>
                                <option value="">Pilih...</option>
                                <option value="Tersedia" <?php if(!empty($get_data_mapa01->peluang_untuk_mengumpulkan_bukti) && $get_data_mapa01->peluang_untuk_mengumpulkan_bukti == 'Tersedia'){echo "selected";}?>>Tersedia</option>
                                <option value="Terbatas" <?php if(!empty($get_data_mapa01->peluang_untuk_mengumpulkan_bukti) && $get_data_mapa01->peluang_untuk_mengumpulkan_bukti == 'Terbatas'){echo "selected";}?>>Terbatas</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Konteks Asesmen - Siapa yang melakukan asesmen / RPL </label>
                            <select name="siapa_yang_melakukan_asesmen" class="form-select form-control" style="font-size:12px;" required>
                                <option value="">Pilih...</option>
                                <option value="Lembaga Sertifikasi" <?php if(!empty($get_data_mapa01->siapa_yang_melakukan_asesmen) && $get_data_mapa01->siapa_yang_melakukan_asesmen == 'Lembaga Sertifikasi'){echo "selected";}?>>Lembaga Sertifikasi</option>
                                <option value="Organisasi Pelatihan" <?php if(!empty($get_data_mapa01->siapa_yang_melakukan_asesmen) && $get_data_mapa01->siapa_yang_melakukan_asesmen == 'Organisasi Pelatihan'){echo "selected";}?>>Organisasi Pelatihan</option>
                                <option value="Asesor Perusahaan" <?php if(!empty($get_data_mapa01->siapa_yang_melakukan_asesmen) && $get_data_mapa01->siapa_yang_melakukan_asesmen == 'Asesor Perusahaan'){echo "selected";}?>>Asesor Perusahaan</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label>Tolak Ukur Asesmen </label>
                            <select name="tolak_ukur_asesmen" class="form-select form-control" style="font-size:12px;" required>
                                <option value="">Pilih...</option>
                                <option value="SKKNI" <?php if(!empty($get_data_mapa01->tolak_ukur_asesmen) && $get_data_mapa01->tolak_ukur_asesmen == 'SKKNI'){echo "selected";}?>>Standar Kompetensi - SKKNI</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label><h6>Konteks Asesmen - Hubungan Antara Standar Kompetensi</h6></label>
                            <br/>Tidak / Ada
                            <div class="form-check form-switch">
                                <input class="form-check-input" name="bukti_untuk_mendukung_asesmen" value="1" type="checkbox" id="bukti_untuk_mendukung_asesmen"
                                    <?php if(!empty($get_data_mapa01->bukti_untuk_mendukung_asesmen) && $get_data_mapa01->bukti_untuk_mendukung_asesmen == '1'){echo "checked";}?>
                                >
                                <label class="form-check-label" for="bukti_untuk_mendukung_asesmen">Bukti untuk mendukung asesmen / RPL</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" name="aktivitas_kerja_ditempat_kerja_asesi" value="1" type="checkbox" id="aktivitas_kerja_ditempat_kerja_asesi"
                                    <?php if(!empty($get_data_mapa01->aktivitas_kerja_ditempat_kerja_asesi) && $get_data_mapa01->aktivitas_kerja_ditempat_kerja_asesi == '1'){echo "checked";}?>
                                >
                                <label class="form-check-label" for="aktivitas_kerja_ditempat_kerja_asesi">Aktivitas kerja di tempat kerja Asesi</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" name="kegiatan_pembelajaran" value="1" type="checkbox" id="kegiatan_pembelajaran"
                                    <?php if(!empty($get_data_mapa01->kegiatan_pembelajaran) && $get_data_mapa01->kegiatan_pembelajaran == '1'){echo "checked";}?>
                                >
                                <label class="form-check-label" for="kegiatan_pembelajaran">Kegiatan Pembelajaran</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label><h6>Konfirmasi dengan orang yang relevan</h6></label>
                            <br/>Tidak / Ada
                            <div class="form-check form-switch">
                                <input class="form-check-input" name="konfirmasi_manajer_sertifikasi_lsp" value="1" type="checkbox" id="bukti_untuk_mendukung_asesmen"
                                    <?php if(!empty($get_data_mapa01->konfirmasi_manajer_sertifikasi_lsp) && $get_data_mapa01->konfirmasi_manajer_sertifikasi_lsp == '1'){echo "checked";}?>
                                >
                                <label class="form-check-label" for="konfirmasi_manajer_sertifikasi_lsp">Manajer Sertifikasi LSP</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" name="konfirmasi_master_asesor_kompetensi" value="1" type="checkbox" id="bukti_untuk_mendukung_asesmen"
                                    <?php if(!empty($get_data_mapa01->konfirmasi_master_asesor_kompetensi) && $get_data_mapa01->konfirmasi_master_asesor_kompetensi == '1'){echo "checked";}?>
                                >
                                <label class="form-check-label" for="konfirmasi_master_asesor_kompetensi">Master Asesor / Master Trainer / Asesor Utama Kompetensi</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" name="konfirmasi_manajer_pelatihan_lembaga_training_terakreditas" value="1" type="checkbox" id="bukti_untuk_mendukung_asesmen"
                                    <?php if(!empty($get_data_mapa01->konfirmasi_manajer_pelatihan_lembaga_training_terakreditas) && $get_data_mapa01->konfirmasi_manajer_pelatihan_lembaga_training_terakreditas == '1'){echo "checked";}?>
                                >
                                <label class="form-check-label" for="konfirmasi_manajer_pelatihan_lembaga_training_terakreditas">Manajer Pelatihan Lembaga Training terakreditasi / Lembaga Training terdaftar</label>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div class="row">
                    <div class="container">
                        <!-- Skema Sertifikasi -->
                        <div class="col-sm-12">
                            <table class="table table-primary" width="100%">
                                <thead>
                                    <tr class="tr_bagian2">
                                        <td rowspan="2" class="td_bagian2" width="20%">Skema Sertifikasi (KKNI/Okupasi/Klaster)</td>
                                        <td class="td_bagian2" width="10%">Judul</td>
                                        <td class="td_bagian2" width="3%">:</td>
                                        <td class="td_bagian2" width="37%"><?= $get_data_klasifikasi_kualifikasi->deskripsi_jabatan_kerja;?></td>
                                    </tr>
                                    <tr class="tr_bagian2">
                                        <td class="td_bagian2">Nomor</td>
                                        <td class="td_bagian2">:</td>
                                        <td class="td_bagian2"><?= $get_data_klasifikasi_kualifikasi->acuan;?></td>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        
                        <!-- For Data KUK -->
                        <?php
                            foreach($get_master_unit_kompetensi as $master_unit_kompetensi){
                                if($master_unit_kompetensi['kode_jabker'] == $get_data_klasifikasi_kualifikasi->jabatan_kerja){
                        ?>
                        <div class="col-sm-12">
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <thead style="border:1px solid #111;" class="table table-primary">
                                    <tr>
                                        <th colspan="1">Unit Kompetensi</th>
                                        <th colspan="7" style="text-align:left;"><?= $master_unit_kompetensi['kode_unit_kompetensi']?> (<?= $master_unit_kompetensi['deskripsi']?>)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        foreach($get_master_elemen_kompetensi as $master_elemen_kompetensi){
                                            if($master_elemen_kompetensi['kode_unit_kompetensi'] == $master_unit_kompetensi['kode_unit_kompetensi']){
                                    ?>
                                    <tr>
                                        <th width="15%" class="text-center align-middle" rowspan="2">
                                            Kriteria Unjuk Kerja
                                        </th>
                                        <th width="15%" class="text-center align-middle" rowspan="2">
                                            Bukti-Bukti (Kinerja, Produk, Portofolio, dan / atau Hafalan) diidentifikasi berdasarkan Kriteria Unjuk Kerja dan Pendekatan Asesmen
                                        </th>
                                        <th width="10%" class="text-center align-middle"> 
                                            Jenis Bukti
                                        </th>
                                        <th class="text-center align-middle" colspan="5"> 
                                            Metode dan Perangkat Asesmen CL (Ceklis Observasi/ Lembar Periksa), DIT (Daftar Instruksi Terstruktur), DPL (Daftar Pertanyaan Lisan), DPT (Daftar Pertanyaan Tertulis), VP (Verifikasi Portofolio), CUP (Ceklis Ulasan Produk), PW (Pertanyaan Wawancara)
                                        </th>
                                    </tr>
                                    <tr>
                                        <th class="col-sm-1 text-center align-middle"> 
                                            L(Langsung) / TL(Tidak Langsung) / T(Tambahan)
                                        </th>
                                        <td class="col-sm-1 text-center" style="font-size:10px;">
                                            <b>Observasi Langsung</b><br/>(kerja nyata/aktivitas waktu nyata ditempat kerja di lingkungan tempat kerja yang disimulasikan)
                                        </td>
                                        <td class="col-sm-1 text-center" style="font-size:10px;">
                                            <b>Kegiatan Terstruktur</b><br/>(latihan simulasi dan bermain peran, proyek, presentasi, lembar kegiatan)
                                        </td>
                                        <td class="col-sm-1 text-center" style="font-size:10px;">
                                            <b>Tanya Jawab</b><br/>(pertanyaan tertulis, wawancara, asesmen diri, tanya jawab lisan, angket, ujian lisan atau tertulis)
                                        </td>
                                        <td class="col-sm-1 text-center" style="font-size:10px;">
                                            <b>Verifikasi Portofolio</b><br/>(sampel pekerjaan yang disusun oleh Asesi, produk dengan dokumentasi pendukung, bukti sejarah, jurnal atau buku catatan, informasi tentang pengalaman hidup)
                                        </td>
                                        <td class="col-sm-1 text-center" style="font-size:10px;">
                                            <b>Review Produk</b><br/>(testimoni dan laporan dari atasan, bukti pelatihan, otentikasi pencapaian sebelumnya, wawancara dengan atasan, atau rekan kerja)
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td class="col-sm-12 table-active" colspan="10">
                                            <b>Elemen <?= $master_elemen_kompetensi['no_urut_elemen_kompetensi']?></b> : <?= $master_elemen_kompetensi['deskripsi']?><br/><br/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <!-- KUK-->
                                        <?php
                                            foreach($get_master_kriteria_unjuk_kerja as $master_kriteria_unjuk_kerja){
                                                if($master_kriteria_unjuk_kerja['kode_elemen_kompetensi'] == $master_elemen_kompetensi['kode_elemen_kompetensi']){
                                        ?>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <?= $master_elemen_kompetensi['no_urut_elemen_kompetensi'].'.'.$master_kriteria_unjuk_kerja['no_urut_kuk']?> <?= $master_kriteria_unjuk_kerja['deskripsi']?><br/>
                                                    </td>
                                                    <?php
                                                        $kode_kuk_clear = str_replace(".", "", $master_kriteria_unjuk_kerja['kode_kuk']);
                                                    ?>
                                                    <td style="text-align:left;">
                                                        <div class="form-group">
                                                            <?php
                                                                foreach($get_ceklis_mapa01 as $ceklis_mapa01){
                                                                    if($master_kriteria_unjuk_kerja['kode_kuk'] == $ceklis_mapa01['kode_kuk']){
                                                                        $bukti_bukti_mapa01 = $ceklis_mapa01['bukti_bukti_mapa01'];
                                                                    }
                                                                }
                                                            ?>
                                                            <textarea type="massage" class="form-control" name="bukti_bukti_mapa01-<?= $kode_kuk_clear;?>" style="font-size:12px;"><?php if(!empty($bukti_bukti_mapa01)){ echo $bukti_bukti_mapa01;}?></textarea>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="form-group">
                                                            <select class="form-control" style="font-size:12px;" name="jenis_bukti-<?= $kode_kuk_clear;?>">
                                                                <option>Pilih...</option>
                                                                <option value="L">L (Langsung)</option>
                                                                <option value="TL">TL (Tidak Langsung)</option>
                                                                <option value="T">T (Tambahan)</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <select class="form-control" style="font-size:12px;" name="observasi_langsung-<?= $kode_kuk_clear;?>">
                                                                <option>Pilih...</option>
                                                                <option value="CL">CL (Ceklis Observasi/ Lembar Periksa)</option>
                                                                <option value="DIT">DIT (Daftar Instruksi Terstruktur)</option>
                                                                <option value="DPL">DPL (Daftar Pertanyaan Lisan)</option>
                                                                <option value="DPT">DPT (Daftar Pertanyaan Tertulis)</option>
                                                                <option value="VP">VP (Verifikasi Portofolio)</option>
                                                                <option value="CUP">CUP (Ceklis Ulasan Produk)</option>
                                                                <option value="PW">PW (Pertanyaan Wawancara)</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <select class="form-control" style="font-size:12px;" name="kegiatan_terstruktur-<?= $kode_kuk_clear;?>">
                                                                <option>Pilih...</option>
                                                                <option value="CL">CL (Ceklis Observasi/ Lembar Periksa)</option>
                                                                <option value="DIT">DIT (Daftar Instruksi Terstruktur)</option>
                                                                <option value="DPL">DPL (Daftar Pertanyaan Lisan)</option>
                                                                <option value="DPT">DPT (Daftar Pertanyaan Tertulis)</option>
                                                                <option value="VP">VP (Verifikasi Portofolio)</option>
                                                                <option value="CUP">CUP (Ceklis Ulasan Produk)</option>
                                                                <option value="PW">PW (Pertanyaan Wawancara)</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <select class="form-control" style="font-size:12px;" name="tanya_jawab-<?= $kode_kuk_clear;?>">
                                                                <option>Pilih...</option>
                                                                <option value="CL">CL (Ceklis Observasi/ Lembar Periksa)</option>
                                                                <option value="DIT">DIT (Daftar Instruksi Terstruktur)</option>
                                                                <option value="DPL">DPL (Daftar Pertanyaan Lisan)</option>
                                                                <option value="DPT">DPT (Daftar Pertanyaan Tertulis)</option>
                                                                <option value="VP">VP (Verifikasi Portofolio)</option>
                                                                <option value="CUP">CUP (Ceklis Ulasan Produk)</option>
                                                                <option value="PW">PW (Pertanyaan Wawancara)</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <select class="form-control" style="font-size:12px;" name="verifikasi_portofolio-<?= $kode_kuk_clear;?>">
                                                                <option>Pilih...</option>
                                                                <option value="CL">CL (Ceklis Observasi/ Lembar Periksa)</option>
                                                                <option value="DIT">DIT (Daftar Instruksi Terstruktur)</option>
                                                                <option value="DPL">DPL (Daftar Pertanyaan Lisan)</option>
                                                                <option value="DPT">DPT (Daftar Pertanyaan Tertulis)</option>
                                                                <option value="VP">VP (Verifikasi Portofolio)</option>
                                                                <option value="CUP">CUP (Ceklis Ulasan Produk)</option>
                                                                <option value="PW">PW (Pertanyaan Wawancara)</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <select class="form-control" style="font-size:12px;" name="review_produk-<?= $kode_kuk_clear;?>">
                                                                <option>Pilih...</option>
                                                                <option value="CL">CL (Ceklis Observasi/ Lembar Periksa)</option>
                                                                <option value="DIT">DIT (Daftar Instruksi Terstruktur)</option>
                                                                <option value="DPL">DPL (Daftar Pertanyaan Lisan)</option>
                                                                <option value="DPT">DPT (Daftar Pertanyaan Tertulis)</option>
                                                                <option value="VP">VP (Verifikasi Portofolio)</option>
                                                                <option value="CUP">CUP (Ceklis Ulasan Produk)</option>
                                                                <option value="PW">PW (Pertanyaan Wawancara)</option>
                                                            </select>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        <?php
                                                }
                                            }
                                        ?>
                                    </tr>
                                    <?php
                                            }
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <?php
                                }
                            }
                        ?>
                        <center><input type="submit" value="Simpan" class="btn btn-primary"/></center>
                    </div>
                </div>
            </div>
        </form>
        <!-- /form -->
    </div>
</div>


</body>
</html>
<script>
    $('#modal-dialog').on('show', function() {
        var link = $(this).data('link'),
            confirmBtn = $(this).find('.confirm');
    })

    $('#btnYes').click(function() {
        // handle form processing here
    //  	alert('submit form');
        $('form').submit();
    });
</script>


<!-- Alert Sweet Alert Mapa 01 -->
<?php if ($this->session->flashdata('success')): ?>
<script>
swal({
  title: "Berhasil",
  text: "Data Berhasil di Simpan",
  icon: "<?= base_url('assets/img/success.png')?>",
  button: false,
  timer: 5000,
});
</script>
<?php endif; ?>