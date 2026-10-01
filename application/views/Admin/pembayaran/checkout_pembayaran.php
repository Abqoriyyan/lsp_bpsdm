<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Surat Perjanjian Sertifikasi</title>

  <!-- Google Fonts & FontAwesome Icons -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <!-- Scripts -->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="SB-Mid-client-Mz287gLg7-JONmy9"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background-color: #f4f6f9;
      color: #333;
    }

    .checkout-card {
      border: none;
      border-radius: 16px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
      background: #ffffff;
      overflow: hidden;
    }

    .card-header-custom {
      background: linear-gradient(135deg, #0d6efd, #0a58ca);
      color: #ffffff;
      padding: 24px;
      text-align: center;
    }

    .section-title {
      font-size: 0.95rem;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      color: #0d6efd;
      margin-bottom: 12px;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .info-group {
      background-color: #f8f9fa;
      border-radius: 10px;
      padding: 16px;
      margin-bottom: 20px;
    }

    .info-row {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 8px 0;
      border-bottom: 1px dashed #e9ecef;
    }

    .info-row:last-child {
      border-bottom: none;
    }

    .info-label {
      color: #6c757d;
      font-size: 0.9rem;
    }

    .info-value {
      font-weight: 500;
      font-size: 0.95rem;
      color: #212529;
      text-align: right;
    }

    .instruction-box {
      background-color: #eef5ff;
      border-left: 4px solid #0d6efd;
      border-radius: 6px;
      padding: 14px 16px;
      font-size: 0.875rem;
      color: #495057;
      margin-bottom: 20px;
    }

    .instruction-box ol {
      padding-left: 18px;
      margin-bottom: 0;
    }

    .price-tag {
      font-size: 1.5rem;
      font-weight: 700;
      color: #198754;
    }

    .table-custom {
      font-size: 0.85rem;
    }

    .table-custom th {
      background-color: #f1f3f5;
    }

    .upload-box {
      background: #ffffff;
      border: 2px dashed #ced4da;
      border-radius: 12px;
      padding: 20px;
      text-align: center;
      transition: all 0.3s ease;
    }

    .upload-box:hover {
      border-color: #0d6efd;
    }
  </style>
</head>

<body>

  <!-- Hidden Payment Form -->
  <form id="payment-form" method="post" action="<?= base_url('pembayaran/finish/') . base64_encode($id_izin) ?>">
    <input type="hidden" name="result_type" id="result-type" value="">
    <input type="hidden" name="result_data" id="result-data" value="">
    <input type="hidden" name="nama" id="nama" value="<?= $data_pembayaran_permohonan->nama ?>">
    <input type="hidden" name="email" id="email" value="<?= $data_pembayaran_permohonan->email ?>">
    <input type="hidden" name="telepon" id="telepon" value="<?= $data_pembayaran_permohonan->telepon ?>">
    <input type="hidden" name="biaya" id="biaya" value="<?= $data_pembayaran_permohonan->biaya ?>">
    <input type="hidden" name="kualifiaksi" id="kualifikasi" value="<?= $data_pembayaran_permohonan->kualifikasi ?>">
    <input type="hidden" name="deskripsi_jabatan_kerja" id="deskripsi_jabatan_kerja"
      value="<?= $data_pembayaran_permohonan->deskripsi_jabatan_kerja ?>">
    <input type="hidden" name="jabatan_kerja" id="jabatan_kerja"
      value="<?= $data_pembayaran_permohonan->jabatan_kerja ?>">
  </form>

  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-lg-8 col-md-10">

        <!-- Main Card Container -->
        <div class="card checkout-card">

          <!-- Header -->
          <div class="card-header-custom">
            <h4 class="fw-bold mb-1">Surat Perjanjian Sertifikasi dan Konfirmasi Bebas Biaya</h4>
            <p class="mb-0 text-white-50 fs-6">LSP BPSDM Kementerian PU</p>
          </div>

          <div class="card-body p-4 p-md-5">

            <!-- Section 1: Informasi Pemohon -->
            <div class="section-title">
              <i class="fa-solid fa-user"></i> Data Pemohon
            </div>
            <div class="info-group">
              <div class="info-row">
                <span class="info-label">Nama Pemohon</span>
                <span class="info-value"><?= $data_pembayaran_permohonan->nama; ?></span>
              </div>
              <div class="info-row">
                <span class="info-label">Email</span>
                <span class="info-value"><?= $data_pembayaran_permohonan->email; ?></span>
              </div>
              <div class="info-row">
                <span class="info-label">Telepon</span>
                <span class="info-value"><?= $data_pembayaran_permohonan->telepon; ?></span>
              </div>
            </div>

            <!-- Section 2: Detail Sertifikasi -->
            <div class="section-title">
              <i class="fa-solid fa-certificate"></i> Detail Permohonan Sertifikasi
            </div>
            <div class="info-group">
              <div class="info-row">
                <span class="info-label">ID Izin</span>
                <span class="info-value"><span class="badge bg-primary lg"><?= $id_izin; ?></span></span>
              </div>
              <div class="info-row">
                <span class="info-label">Kualifikasi</span>
                <span class="info-value"><?= $data_pembayaran_permohonan->kualifikasi; ?></span>
              </div>
              <div class="info-row">
                <span class="info-label">Klasifikasi</span>
                <span class="info-value"><?= $data_pembayaran_permohonan->klasifikasi; ?></span>
              </div>
              <div class="info-row">
                <span class="info-label">Subklasifikasi</span>
                <span class="info-value"><?= $data_pembayaran_permohonan->subklasifikasi; ?></span>
              </div>
              <div class="info-row">
                <span class="info-label">Jenjang</span>
                <span class="info-value"><?= $data_pembayaran_permohonan->jenjang; ?></span>
              </div>
              <div class="info-row">
                <span class="info-label">Jabatan Kerja</span>
                <span class="info-value"><?= $data_pembayaran_permohonan->deskripsi_jabatan_kerja; ?>
                  (<?= $data_pembayaran_permohonan->jabatan_kerja; ?>)
                </span>
              </div>
            </div>

            <!-- Section 3: Biaya -->
            <div class="d-flex justify-content-between align-items-center bg-light p-3 rounded-3 mb-4 border">
              <div>
                <span class="fw-bold">Total Biaya Sertifikasi</span>
                <span class="text-muted d-block small">BPSDM Kementerian PU</span>
              </div>
              <div class="price-tag">
                Rp <?= number_format($data_pembayaran_permohonan->biaya, 0, ',', '.'); ?>
              </div>
            </div>

            <!-- Petunjuk / Catatan -->
            <div class="instruction-box">
              <div class="fw-bold mb-1"><i class="fa-solid fa-circle-info me-1"></i> Catatan Penting:</div>
              <ol class="mb-0">
                <li>Biaya sertifikasi di LSP BPSDM Kementerian PU adalah <strong>Gratis</strong>. Silakan klik tombol
                  konfirmasi di bawah ini.</li>
                <li>Unduh format surat perjanjian sertifikasi, isi sesuai instruksi, lalu unggah kembali dokumen
                  tersebut pada kolom yang disediakan.</li>
              </ol>
            </div>

            <!-- Area Metode Pembayaran / Actions -->
            <div class="mb-4 text-center">
              <form action="<?= base_url('pembayaran/upload_bukti_pembayaran/') . base64_encode($id_izin); ?>"
                method="POST" enctype="multipart/form-data">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                  value="<?= $this->security->get_csrf_hash(); ?>" />
                <input class="form-control" type="file" name="bukti_pembayaran" hidden />
                <input type="hidden" name="biaya" id="biaya" value="<?= $data_pembayaran_permohonan->biaya ?>">

                <button type="submit" class="btn btn-success btn-md w-50 shadow-sm">
                  <i class="fa-solid fa-check-circle me-2"></i>Konfirmasi Bebas Biaya Sertifikasi
                </button>
              </form>
            </div>

            <hr class="my-4">

            <!-- Section 4: Upload Surat Perjanjian -->
            <div class="upload-box">
              <h5 class="fw-bold mb-3 text-primary"><i class="fa-solid fa-file-signature text-primary me-2"></i>Surat
                Perjanjian Sertifikasi</h5>
              <form
                action="<?= base_url('pembayaran/upload_surat_perjanjian_sertifikasi/') . base64_encode($id_izin); ?>"
                method="POST" enctype="multipart/form-data">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                  value="<?= $this->security->get_csrf_hash(); ?>" />

                <?php if (empty($get_data_surat_perjanjian_sertifikat->file)): ?>
                  <div class="mb-3">
                    <a href="<?= base_url('assets/draf_dokumen/Surat Perjanjian Sertifikasi.docx') ?>"
                      class="btn btn-outline-warning btn-sm mb-3">
                      <i class="fa-solid fa-download me-1"></i> Download Format Surat Perjanjian (.docx)
                    </a>
                  </div>

                  <div class="row g-2 justify-content-center">
                    <div class="col-md-8">
                      <input type="file" class="form-control" name="surat_perjanjian_sertifikasi" required />
                    </div>
                    <div class="col-md-4">
                      <button type="submit" class="btn btn-primary w-100">
                        <i class="fa-solid fa-upload me-1"></i> Upload
                      </button>
                    </div>
                  </div>
                <?php else: ?>
                  <div class="alert alert-success d-inline-block mb-0" role="alert">
                    <i class="fa-solid fa-file-circle-check me-2 fs-5"></i>
                    Surat Perjanjian Sertifikasi Telah Diunggah.
                    <a href="<?= base_url('uploads/file_permohonan/surat_perjanjian_sertifikat/') . $get_data_surat_perjanjian_sertifikat->file; ?>"
                      class="btn btn-sm btn-success ms-3" target="_blank">
                      <i class="fa-solid fa-eye me-1"></i> Lihat Berkas
                    </a>
                  </div>
                <?php endif; ?>
              </form>
            </div>

          </div> <!-- /Card Body -->
        </div> <!-- /Card -->

      </div>
    </div>
  </div>

  <!-- Midtrans JS Handling -->
  <script type="text/javascript">
    $('#pay-button').click(function (event) {
      event.preventDefault();
      $(this).attr("disabled", "disabled").html('<i class="fa-solid fa-spinner fa-spin me-2"></i>Memproses...');

      var nama = $("#nama").val();
      var email = $("#email").val();
      var telepon = $("#telepon").val();
      var biaya = $("#biaya").val();
      var kualifikasi = $("#kualifikasi").val();
      var deskripsi_jabatan_kerja = $("#deskripsi_jabatan_kerja").val();
      var jabatan_kerja = $("#jabatan_kerja").val();

      $.ajax({
        type: 'POST',
        url: '<?= site_url() ?>pembayaran/token',
        data: {
          nama: nama,
          email: email,
          telepon: telepon,
          biaya: biaya,
          kualifikasi: kualifikasi,
          deskripsi_jabatan_kerja: deskripsi_jabatan_kerja,
          jabatan_kerja: jabatan_kerja,
        },
        cache: false,
        success: function (data) {
          console.log('token = ' + data);

          function changeResult(type, data) {
            $("#result-type").val(type);
            $("#result-data").val(JSON.stringify(data));
          }

          snap.pay(data, {
            onSuccess: function (result) {
              changeResult('success', result);
              $("#payment-form").submit();
            },
            onPending: function (result) {
              changeResult('pending', result);
              $("#payment-form").submit();
            },
            onError: function (result) {
              changeResult('error', result);
              $("#payment-form").submit();
            },
            onClose: function () {
              $('#pay-button').removeAttr("disabled").html('<i class="fa-solid fa-credit-card me-2"></i>Bayar Sekarang');
            }
          });
        },
        error: function () {
          $('#pay-button').removeAttr("disabled").html('<i class="fa-solid fa-credit-card me-2"></i>Bayar Sekarang');
          alert('Terjadi kesalahan koneksi, silakan coba lagi.');
        }
      });
    });
  </script>

  <!-- SweetAlert Flash Messages -->
  <?php if ($this->session->flashdata('success')): ?>
    <script>
      swal({
        title: "Berhasil",
        text: "Surat Perjanjian Sertifikasi Berhasil di Upload",
        icon: "success",
        button: false,
        timer: 4000,
      });
    </script>
  <?php endif; ?>

  <?php if ($this->session->flashdata('gagal')): ?>
    <script>
      swal({
        title: "Gagal",
        text: "Surat Perjanjian Sertifikasi Gagal di Upload. Pastikan Ukuran File Tidak lebih dari 10 MB dan Ekstensi File .pdf",
        icon: "error",
        button: "Tutup",
      });
    </script>
  <?php endif; ?>

  <?php if ($this->session->flashdata('success_bukti_pembayaran')): ?>
    <script>
      swal({
        title: "Berhasil",
        text: "Biaya Sertifikasi Berhasil di Simpan",
        icon: "success",
        button: false,
        timer: 4000,
      });
    </script>
  <?php endif; ?>

  <?php if ($this->session->flashdata('gagal_bukti_pembayaran')): ?>
    <script>
      swal({
        title: "Gagal",
        text: "Bukti Pembayaran Gagal di Upload. Pastikan Ukuran File Tidak lebih dari 10 MB dan Ekstensi File .pdf | .png | .jpg | .jpeg",
        icon: "error",
        button: "Tutup",
      });
    </script>
  <?php endif; ?>

</body>

</html>