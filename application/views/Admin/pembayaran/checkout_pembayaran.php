<html>
<title>Checkout</title>
  <head>
    <script type="text/javascript"
            src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="SB-Mid-client-Mz287gLg7-JONmy9"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

    <!-- Sweet Alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- Boostrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  </head>
  <body>

    <form id="payment-form" method="post" action="<?=base_url('pembayaran/finish/').base64_encode($id_izin)?>">
      <input type="hidden" name="result_type" id="result-type" value="">
      <input type="hidden" name="result_data" id="result-data" value="">
      <input type="hidden" name="nama" id="nama" value="<?= $data_pembayaran_permohonan->nama?>">
      <input type="hidden" name="email" id="email" value="<?= $data_pembayaran_permohonan->email?>">
      <input type="hidden" name="telepon" id="telepon" value="<?= $data_pembayaran_permohonan->telepon?>">
      <input type="hidden" name="biaya" id="biaya" value="<?= $data_pembayaran_permohonan->biaya?>">
      <input type="hidden" name="kualifiaksi" id="kualifikasi" value="<?= $data_pembayaran_permohonan->kualifikasi?>">
      <input type="hidden" name="deskripsi_jabatan_kerja" id="deskripsi_jabatan_kerja" value="<?= $data_pembayaran_permohonan->deskripsi_jabatan_kerja?>">
      <input type="hidden" name="jabatan_kerja" id="jabatan_kerja" value="<?= $data_pembayaran_permohonan->jabatan_kerja?>">
    </form>
<center>
<div class="col-md-6" style="margin-top:50px;">
    <div class="card">
      <div class=" p-3">
        <h4>Pembayaran dan Upload Surat Perjanjian Sertifikasi SKKK</h4>
      </div>
      <hr class="mt-0 line">

      Pembayaran Atas :
      <div class="p-3">
        <div class="d-flex justify-content-between mb-2">
          <span>Nama Pemohon</span>
          <span><?=$data_pembayaran_permohonan->nama;?></span>
        </div>
        <div class="d-flex justify-content-between mb-2">
          <span>Email</span>
          <span><?=$data_pembayaran_permohonan->email;?></span>
        </div>
        <div class="d-flex justify-content-between mb-2">
          <span>Telepon</span>
          <span><?=$data_pembayaran_permohonan->telepon;?></span>
        </div>
      </div>
      <hr class="mt-0 line">

      Pembayaran dan Upload Surat Perjanjian Sertifikasi SKKK :
      <div class="p-3">
        <div class="d-flex justify-content-between mb-2">
          <span>ID-Izin</span>
          <span><?= $id_izin;?></span>
        </div>
        <div class="d-flex justify-content-between mb-2">
          <span>Kualifikasi</span>
          <span><?= $data_pembayaran_permohonan->kualifikasi;?></span>
        </div>
        <div class="d-flex justify-content-between mb-2">
          <span>Klasifikasi</span>
          <span><?= $data_pembayaran_permohonan->klasifikasi;?></span>
        </div>
        <div class="d-flex justify-content-between mb-2">
          <span>Subklasifikasi</span>
          <span><?= $data_pembayaran_permohonan->subklasifikasi;?></span>
        </div>
        <div class="d-flex justify-content-between mb-2">
          <span>Jenjang</span>
          <span><?= $data_pembayaran_permohonan->jenjang;?></span>
        </div>
        <div class="d-flex justify-content-between mb-2">
          <span>Jabatan Kerja</span>
          <span><?= $data_pembayaran_permohonan->jabatan_kerja;?>( <?= $data_pembayaran_permohonan->deskripsi_jabatan_kerja;?> )</span>
        </div>
      </div>
   
      <hr class="mt-0 line">

      <div class="p-3 d-flex justify-content-between">
        <div class="d-flex flex-column">
          <span>Biaya Sertifikasi</span>
        </div>
        <span>Rp. <?= number_format($data_pembayaran_permohonan->biaya,0,',','.');?></span>
      </div>
      <div class="p-3">

      <!-- Disclaimer -->
      <div style="text-align:left; font-size:13px;">
        Catatan :<br/>
        - Biaya pembayaran sertifikasi di LSP BPSDM Kementerian PUPR adalah gratis, klik tombol "Konfirmasi Bebas Biaya Sertifikasi" dibawah ini.<br/>
        - Download format surat perjanjian sertifikasi dibawah ini untuk pengisian surat perjanjian sertifikasi.<br/>
        - Upload surat perjanjian sertifikasi yang sudah diisi ke dalam kolom upload dibawah ini.<br/>
      </div>


      <!-- Metode Pembayaran -->
      <?php
        // Payment Gateway
        if($metode_pembayaran == 'Payment Gateway'){
      ?>
          <?php
            // Keterangan
            // empty = Belum proses checkout Pembayaran Tagihan
            // 200 = Tagihan Sudah Dibayarkan
            // 201 = Pending / Proses Pembayaran
            // 202 = Denied

              if(empty($get_status_pembayaran->status_code)){
                echo "<button class='btn btn-primary btn-block free-button' id='pay-button'>Bayar Sekarang</button>"; 
              }elseif($get_status_pembayaran->status_code == 200){
                echo "<a href='#' class='btn btn-success'>Biaya Sudah Dibayarkan</a>";
              }elseif($get_status_pembayaran->status_code == 201){
                echo 'Pending - Silahkan Selesaikan Pembayaran';
              }elseif($get_status_pembayaran->status_code == 202){
                echo 'Denied';
              }
            ?>
            <?php
                if(empty($get_status_pembayaran->status_code)){
                  echo '';
                }elseif($get_status_pembayaran->status_code == 201){
              ?>
                <table class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Order ID</th>
                      <th>Jenis Pembayaran</th>
                      <?php
                        if($get_status_pembayaran->bank == NULL){
                          echo "<th>Bill Key</th>
                                <th>Biller Code</th>";
                        }else{
                          echo "<th>Bank</th>
                                <th>VA Number</th>";
                        }
                      ?>
                      <th>Batas Akhir Pembayaran</th>
                      <th>Payment Step-by-step</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><?= $get_status_pembayaran->order_id?></td>
                      <td><?= $get_status_pembayaran->payment_type?></td>
                      <?php
                        if($get_status_pembayaran->bank == NULL){
                          echo "<td>".$get_status_pembayaran->bill_key."</td>";
                          echo "<td>".$get_status_pembayaran->biller_code."</td>";
                        }else{
                          echo "<td>". $get_status_pembayaran->bank."</td>";
                          echo "<td>".$get_status_pembayaran->va_number."</td>";
                        }
                      ?>
              
                      <td>
                        <?php
                          $expire_transaction = strtotime($get_status_pembayaran->transaction_time);
                          $expire_transaction = strtotime("+9 day", $expire_transaction);
                          echo date('M d, Y - H:i:s', $expire_transaction);
                        ?>
                      </td>
                      <td><a href='<?=$get_status_pembayaran->pdf_url?>' class='btn btn-primary' style='font-size:12px;' target='_blank'>View</a></td>
                    </tr>
                  </tbody>
                </table>
              <?php
                }
              ?>
        <?php
        // Upload
        }elseif($metode_pembayaran == 'Upload'){
        ?>
          <?php if(empty($get_status_pembayaran->status_code) || $get_status_pembayaran->status_code == '201'){?>
            <form action="<?= base_url('pembayaran/upload_bukti_pembayaran/').base64_encode($id_izin);?>" method="POST" enctype="multipart/form-data">
              <div class="container">
                <div class="row">
                    <!-- <div class="col-md-10"> -->
                      <input class="form-control text-dark" type="file" name="bukti_pembayaran" hidden/><br/>
                      <input type="hidden" name="biaya" id="biaya" value="<?= $data_pembayaran_permohonan->biaya?>">
                    <!-- </div> -->
                    <div class="col-md-4 offset-md-4">
                        <input type="submit" value="Konfirmasi Bebas Biaya Sertifikasi" class="text-center btn btn-primary"/>
                    </div>
                </div>
              </div>
            </form>
          <?php } ?>
          

          <!-- <?php# if(!empty($get_status_pembayaran->bukti_pembayaran)){?>
            <p>Catatan : Silahkan Upload Ulang Jika Anda salah Melampirkan Bukti Pembayaran Biaya Sertifikasi</p>
            <a href="<?#= base_url('uploads/file_permohonan/bukti_pembayaran_biaya_sertifikasi/').$get_status_pembayaran->bukti_pembayaran;?>" target="_blank" class="btn btn-success">Bukti Bayar yang telah di Upload</a>
          <?php #}?> -->
        
        <?php }?>
      <!-- Metode Pembayaran -->

  </div>
  <br/><hr/>
  <form action="<?= base_url('pembayaran/upload_surat_perjanjian_sertifikasi/').base64_encode($id_izin);?>" method="POST" enctype="multipart/form-data">
    <h4>Upload File Surat Perjanjian Sertifikasi</h4>
    <?php if(empty($get_data_surat_perjanjian_sertifikat->file)){ ?>
      <a href="<?= base_url('assets/draf_dokumen/Surat Perjanjian Sertifikasi.docx')?>" class="btn btn-warning" style="font-size:12px;">Download Draf Surat Perjanjian Sertifikasi Disini</a><br/><br/>

      <input type="file" class="form-control" name="surat_perjanjian_sertifikasi" style="width:70%;"/>
      <input type="submit" value="Upload" class="btn btn-primary"/>
    <?php }else{ ?>
      <a href="<?= base_url('uploads/file_permohonan/surat_perjanjian_sertifikat/').$get_data_surat_perjanjian_sertifikat->file;?>" class="btn btn-success" target="_blank">Surat Perjanjian Sertifikat yang Sudah Diupload</a>
    <?php } ?>
  </form>
    
</div>
</div>
<br/><br/>
</center>


<!-- Midtrans -->
<script type="text/javascript">
    $('#pay-button').click(function (event) {
      event.preventDefault();
      $(this).attr("disabled", "disabled");
    
    // Variabel inputan dari form 
    var nama = $("#nama").val();
    var email = $("#email").val();
    var telepon = $("#telepon").val();
    var biaya = $("#biaya").val();
    var kualifikasi = $("#kualifikasi").val();
    var deskripsi_jabatan_kerja = $("#deskripsi_jabatan_kerja").val();
    var jabatan_kerja = $("#jabatan_kerja").val();

    $.ajax({
      type : 'POST',
      url: '<?=site_url()?>pembayaran/token',
      data: {
        nama : nama,
        email : email,
        telepon : telepon,
        biaya : biaya,
        kualifikasi : kualifikasi,
        deskripsi_jabatan_kerja : deskripsi_jabatan_kerja,
        jabatan_kerja : jabatan_kerja,
      },
      cache: false,

      success: function(data) {
        //location = data;

        console.log('token = '+data);
        
        var resultType = document.getElementById('result-type');
        var resultData = document.getElementById('result-data');

        function changeResult(type,data){
          $("#result-type").val(type);
          $("#result-data").val(JSON.stringify(data));
          //resultType.innerHTML = type;
          //resultData.innerHTML = JSON.stringify(data);
        }

        snap.pay(data, {
          onSuccess: function(result){
            changeResult('success', result);
            console.log(result.status_message);
            console.log(result);
            $("#payment-form").submit();
          },
          onPending: function(result){
            changeResult('pending', result);
            console.log(result.status_message);
            $("#payment-form").submit();
          },
          onError: function(result){
            changeResult('error', result);
            console.log(result.status_message);
            $("#payment-form").submit();
          }
        });
      }
    });
  });
</script>
<!-- / Midtrans -->
</body>
</html>


<!-- Alert Sweet Alert APL 02 -->
<?php if ($this->session->flashdata('success')): ?>
<script>
swal({
  title: "Berhasil",
  text: "Surat Perjanjian Sertifikasi Berhasil di Upload",
  icon: "<?= base_url('assets/img/success.png')?>",
  button: false,
  timer: 5000,
});
</script>
<?php endif; ?>

<?php if ($this->session->flashdata('gagal')): ?>
<script>
swal({
  title: "Gagal",
  text: "Surat Perjanjian Sertifikasi Gagal di Upload pastikan Ukuran File Tidak lebih dari 10 MB dan Ekstension File pdf",
  icon: "<?= base_url('assets/img/failed.png')?>",
  button: false,
  timer: 5000,
});
</script>
<?php endif; ?>

<?php if ($this->session->flashdata('success_bukti_pembayaran')): ?>
<script>
swal({
  title: "Berhasil",
  text: "Biaya Sertifikasi Berhasil di Simpan",
  icon: "<?= base_url('assets/img/success.png')?>",
  button: false,
  timer: 5000,
});
</script>
<?php endif; ?>

<?php if ($this->session->flashdata('gagal_bukti_pembayaran')): ?>
<script>
swal({
  title: "Gagal",
  text: "Bukti Pembayaran Biaya Sertifikasi Gagal di Upload pastikan Ukuran File Tidak lebih dari 10 MB dan Ekstension File pdf | png | jpg | JPEG",
  icon: "<?= base_url('assets/img/failed.png')?>",
  button: false,
  timer: 5000,
});
</script>
<?php endif; ?>



<style>
  tr {
    font-size:12px;
    text-align:center;
  }
</style>