<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property CI_DB_query_builder $db
 */

class Komite extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url', 'html', 'file', 'form', 'security'));
		$this->load->library(array('form_validation', 'email', 'pdfgenerator', 'ciqrcode', 'system'));
		$this->load->config('email');

		// $this->load->library('../controllers/mail','mail');
		## GET Model Admin Model
		$this->load->model('master_model');
		$this->load->model('asesor_model');
		$this->load->model('api_model');
		$this->load->model('komite_model');
		$this->load->model('Admin_model');
		## GET Model Admin Model
		date_default_timezone_set('Asia/Jakarta');
	}

	public function index()
	{
		##/Cek Session Login##
		if (!$this->ion_auth->ceklogin()) {
			redirect('login', 'refresh');
		} else if ($this->session->userdata('level') !== 'Komite') {
			redirect('login/keluar', 'refresh');
		}
		##/Cek Session Login##

		$this->data = array(
			'username' => $this->session->userdata('username'),
			'level' => $this->session->userdata('level'),
		);
		$this->template->load('menu', 'Komite/dashboard', $this->data);
	}

	public function list_penetapan()
	{
		##/Cek Session Login##
		if (!$this->ion_auth->ceklogin()) {
			redirect('login', 'refresh');
		} else if ($this->session->userdata('level') !== 'Komite') {
			redirect('login/keluar', 'refresh');
		}
		##/Cek Session Login##

		# Get Data
		$get_list_penetapan = $this->komite_model->get_list_penetapan();

		$this->data = array(
			'username' => $this->session->userdata('username'),
			'level' => $this->session->userdata('level'),
			'get_list_penetapan' => $get_list_penetapan,
		);
		$this->template->load('menu', 'Komite/penetapan/list_penetapan', $this->data);
	}

	public function penetapan($id_izin)
	{
		##/Cek Session Login##
		if (!$this->ion_auth->ceklogin()) {
			redirect('login', 'refresh');
		} else if ($this->session->userdata('level') !== 'Komite') {
			redirect('login/keluar', 'refresh');
		}
		##/Cek Session Login##
		$id_izin = base64_decode($id_izin);

		# Get Data Detail Pemohon
		$get_list_penetapan = $this->komite_model->get_list_penetapan();
		$info_data_permohonan = $this->Admin_model->info_data_permohonan($id_izin);
		$get_data_personal_permohonan = $this->komite_model->get_data_personal_permohonan($id_izin);
		$get_data_pendidikan_permohonan = $this->komite_model->get_data_pendidikan_permohonan($id_izin);
		$get_data_proyek_permohonan = $this->komite_model->get_data_proyek_permohonan($id_izin);
		$get_data_pelatihan_permohonan = $this->komite_model->get_data_pelatihan_permohonan($id_izin);
		$get_data_klasifikasi_kualifikasi_permohonan = $this->komite_model->get_data_klasifikasi_kualifikasi_permohonan($id_izin);

		#Get Data Rekomendasi Asesor
		$get_data_rekomendasi_asesor = $this->komite_model->get_data_rekomendasi_asesor($id_izin);
		$get_data_file_asesmen = $this->komite_model->get_data_file_asesmen($id_izin, $get_data_klasifikasi_kualifikasi_permohonan->kualifikasi);

		$this->data = array(
			'username' => $this->session->userdata('username'),
			'level' => $this->session->userdata('level'),
			'id_izin' => $id_izin,
			'info_data_permohonan' => $info_data_permohonan,
			'get_data_personal_permohonan' => $get_data_personal_permohonan,
			'get_data_pendidikan_permohonan' => $get_data_pendidikan_permohonan,
			'get_data_proyek_permohonan' => $get_data_proyek_permohonan,
			'get_data_pelatihan_permohonan' => $get_data_pelatihan_permohonan,
			'get_data_klasifikasi_kualifikasi_permohonan' => $get_data_klasifikasi_kualifikasi_permohonan,
			'get_data_rekomendasi_asesor' => $get_data_rekomendasi_asesor,
			'get_data_file_asesmen' => $get_data_file_asesmen,
		);
		$this->template->load('menu', 'Komite/penetapan/penetapan', $this->data);
	}

	public function insert_penetapan($id_izin)
	{
		## Cek Session Login ##
		if (!$this->ion_auth->ceklogin()) {
			redirect('login', 'refresh');
		} else if ($this->session->userdata('level') !== 'Komite') {
			redirect('login/keluar', 'refresh');
		}

		$id_izin = base64_decode($id_izin);
		$log = date("Y-m-d H:i:s");
		$get_data_ketua_pelaksana = $this->komite_model->get_data_ketua_pelaksana();

		$to_scalar = function ($value) {
			if (is_array($value) || is_object($value)) {
				return json_encode($value);
			}
			return (string) $value;
		};

		if ($this->input->post('penetapan') == 'Kompeten') {
			$token = $this->api_model->get_token();

			# Get Data Pemohon
			$get_data_personal_permohonan = $this->komite_model->get_data_personal_permohonan($id_izin);
			$get_data_klasifikasi_kualifikasi_permohonan = $this->komite_model->get_data_klasifikasi_kualifikasi_permohonan($id_izin);
			$get_nomor_sertifikat_terakhir = $this->komite_model->get_nomor_sertifikat_terakhir();

			// Get Data Nomor Sertifikat Terakhir
			$nomor_sertifikat_terakhir = (!empty($get_nomor_sertifikat_terakhir->nomor_sertifikasi))
				? (int) substr($get_nomor_sertifikat_terakhir->nomor_sertifikasi, 1, 5)
				: 0;

			$nomor_sertifikat_terakhir += 1;
			$nomor_sertifikat = sprintf("%05s", $nomor_sertifikat_terakhir);

			// Generate QR CODE untuk Signature
			$config['cacheable'] = true;
			$config['cachedir'] = '';
			$config['errorlog'] = '';
			$config['imagedir'] = './uploads/qrcode_signature/';
			$config['quality'] = true;
			$config['size'] = '1024';
			$config['black'] = array(224, 255, 255);
			$config['white'] = array(70, 130, 180);
			$this->ciqrcode->initialize($config);

			$image_name = 'qr_signature-' . base64_encode($id_izin) . '.png';
			$params['data'] = base_url('/sertifikat/validasi_signature/') . base64_encode($id_izin);
			$params['level'] = 'H';
			$params['size'] = 10;
			$params['savename'] = $config['imagedir'] . $image_name;
			$this->ciqrcode->generate($params);

			///////////// Create Blanko ke BNSP /////////////////
			$token_bnsp = $this->api_model->get_token_bnsp();
			$get_detail_jadwal_asesmen = $this->komite_model->get_detail_jadwal_asesmen($id_izin);

			if (!empty($token_bnsp->host)) {
				$url = $token_bnsp->host . "jadwal/blanko";
				$ch = curl_init($url);

				$data_pemohon = array(
					"jadwal_id" => isset($get_detail_jadwal_asesmen->id_jadwal_asesmen) ? $get_detail_jadwal_asesmen->id_jadwal_asesmen : "",
					"form_id" => 1,
					"nama" => "Nomor Permohonan",
					"nomor" => "",
					"tanggal" => date("Y-m-d"),
					"file_dokumen" => base_url('asesor/cetak_berita_acara_rekomendasi_asesor/') . base64_encode($id_izin)
				);

				$data_ba_pleno = array(
					"jadwal_id" => isset($get_detail_jadwal_asesmen->id_jadwal_asesmen) ? $get_detail_jadwal_asesmen->id_jadwal_asesmen : "",
					"form_id" => 2,
					"nama" => "Berita Acara Pleno Komite Teknis",
					"nomor" => $nomor_sertifikat,
					"tanggal" => date("Y-m-d"),
					"file_dokumen" => base_url('komite/cetak_berita_acara_pleno_komite/') . base64_encode($id_izin)
				);

				$data_sk_hasil_sertifikasi = array(
					"jadwal_id" => isset($get_detail_jadwal_asesmen->id_jadwal_asesmen) ? $get_detail_jadwal_asesmen->id_jadwal_asesmen : "",
					"form_id" => 3,
					"nama" => "SK Hasil Sertifikasi Kompetensi",
					"nomor" => $nomor_sertifikat,
					"tanggal" => date("Y-m-d"),
					"file_dokumen" => base_url('komite/cetak_surat_keputusan_komite/') . base64_encode($id_izin)
				);

				$jsonDataEncoded = json_encode([$data_pemohon, $data_ba_pleno, $data_sk_hasil_sertifikasi]);

				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
				curl_setopt($ch, CURLOPT_HTTPHEADER, array(
					'Content-Type: application/json',
					'x-authorization:' . (isset($token_bnsp->x_authorization) ? $token_bnsp->x_authorization : ''),
					'token:' . (isset($token_bnsp->x_authorization) ? $token_bnsp->x_authorization : '')
				));
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

				$responseRaw = curl_exec($ch);
				curl_close($ch);

				$responseBody = json_decode($responseRaw, true);

				if (isset($responseBody["code"]) && $responseBody["code"] == "ERR") {
					$this->session->set_flashdata('error_bnsp', 'Gagal Kirim 3 File Permohonan Blanko ke BNSP');
				}
			}

			///// Generate Nomor Registrasi ////
			$nomor_registrasi_lsp = 'F ' . (isset($token->no_lisensi) ? $token->no_lisensi : '') . ' ' . $nomor_sertifikat . ' ' . date("Y");
			$nomor_sertifikat_lengkap = $this->komite_model->keperluan_nomor_sertifikat_lengkap($id_izin);

			$rekomendasi_hasil_asesmen = array(
				'nomor_sertifikasi' => $nomor_sertifikat,
				'id_izin' => $id_izin,
				'nik' => isset($get_data_personal_permohonan->nik) ? $get_data_personal_permohonan->nik : '',
				'nama' => isset($get_data_personal_permohonan->nama) ? $get_data_personal_permohonan->nama : '',
				'id_propinsi' => isset($get_data_personal_permohonan->propinsi) ? $get_data_personal_permohonan->propinsi : '',
				'propinsi' => isset($get_data_personal_permohonan->deskripsi_propinsi) ? $get_data_personal_permohonan->deskripsi_propinsi : '',
				'id_kabupaten' => isset($get_data_personal_permohonan->kabupaten) ? $get_data_personal_permohonan->kabupaten : '',
				'kabupaten' => isset($get_data_personal_permohonan->deskripsi_kabupaten) ? $get_data_personal_permohonan->deskripsi_kabupaten : '',
				'id_kualifikasi' => isset($get_data_klasifikasi_kualifikasi_permohonan->kualifikasi) ? $get_data_klasifikasi_kualifikasi_permohonan->kualifikasi : '',
				'kualifikasi' => isset($get_data_klasifikasi_kualifikasi_permohonan->deskripsi_kualifikasi) ? $get_data_klasifikasi_kualifikasi_permohonan->deskripsi_kualifikasi : '',
				'kualifikasi_en' => isset($get_data_klasifikasi_kualifikasi_permohonan->kualifikasi_en) ? $get_data_klasifikasi_kualifikasi_permohonan->kualifikasi_en : '',
				'id_klasifikasi' => isset($get_data_klasifikasi_kualifikasi_permohonan->klasifikasi) ? $get_data_klasifikasi_kualifikasi_permohonan->klasifikasi : '',
				'klasifikasi' => isset($get_data_klasifikasi_kualifikasi_permohonan->deskripsi_klasifikasi) ? $get_data_klasifikasi_kualifikasi_permohonan->deskripsi_klasifikasi : '',
				'klasifikasi_en' => isset($get_data_klasifikasi_kualifikasi_permohonan->klasifikasi_en) ? $get_data_klasifikasi_kualifikasi_permohonan->klasifikasi_en : '',
				'id_subklasifikasi' => isset($get_data_klasifikasi_kualifikasi_permohonan->subklasifikasi) ? $get_data_klasifikasi_kualifikasi_permohonan->subklasifikasi : '',
				'subklasifikasi' => isset($get_data_klasifikasi_kualifikasi_permohonan->deskripsi_subklasifikasi) ? $get_data_klasifikasi_kualifikasi_permohonan->deskripsi_subklasifikasi : '',
				'subklasifikasi_en' => isset($get_data_klasifikasi_kualifikasi_permohonan->subklasifikasi_en) ? $get_data_klasifikasi_kualifikasi_permohonan->subklasifikasi_en : '',
				'id_jabatan_kerja' => isset($get_data_klasifikasi_kualifikasi_permohonan->jabatan_kerja) ? $get_data_klasifikasi_kualifikasi_permohonan->jabatan_kerja : '',
				'jabatan_kerja' => isset($get_data_klasifikasi_kualifikasi_permohonan->deskripsi_jabatan_kerja) ? $get_data_klasifikasi_kualifikasi_permohonan->deskripsi_jabatan_kerja : '',
				'jabatan_kerja_en' => isset($get_data_klasifikasi_kualifikasi_permohonan->work_position) ? $get_data_klasifikasi_kualifikasi_permohonan->work_position : '',
				'jenjang' => isset($get_data_klasifikasi_kualifikasi_permohonan->jenjang) ? $get_data_klasifikasi_kualifikasi_permohonan->jenjang : '',
				'nomor_sertifikat_lengkap' => (isset($nomor_sertifikat_lengkap->kbli) ? $nomor_sertifikat_lengkap->kbli : '') . " " . (isset($nomor_sertifikat_lengkap->kbji) ? $nomor_sertifikat_lengkap->kbji : '') . " " . (isset($get_data_klasifikasi_kualifikasi_permohonan->jenjang) ? $get_data_klasifikasi_kualifikasi_permohonan->jenjang : '') . " " . sprintf("%08s", (int) $nomor_sertifikat) . " " . date('Y'),
				'nomor_registrasi_lsp' => $nomor_registrasi_lsp,
				'nomor_registrasi_lpjk' => 'Menunggu Approve BNSP',
				'nomor_blangko_bnsp' => 'Menunggu Approve BNSP',
				'tanggal_ditetapkan' => date("Y-m-d", strtotime($log)),
				'tanggal_masa_berlaku' => date('Y-m-d', strtotime('+5 years')),
				'jenis_permohonan' => isset($get_data_klasifikasi_kualifikasi_permohonan->jenis_permohonan) ? $get_data_klasifikasi_kualifikasi_permohonan->jenis_permohonan : '',
				'qr' => 'Menunggu Approve BNSP',
				'qr_signature' => $image_name,
				'link_e_sertifikat' => base_url('sertifikat/') . base64_encode($id_izin),
				'catatan' => $this->input->post('catatan'),
				'user_penetap' => $this->session->userdata('username'),
				'ketua_pelaksana' => isset($get_data_ketua_pelaksana->nama) ? $get_data_ketua_pelaksana->nama : '',
				'ttd_ketua_pelaksana' => isset($get_data_ketua_pelaksana->file_ttd) ? $get_data_ketua_pelaksana->file_ttd : '',
				'log' => $log,
			);

			$this->db->replace('data_pencatatan_sertifikasi', array_map($to_scalar, $rekomendasi_hasil_asesmen));
			$this->session->set_flashdata('message', 'Data Permohonan Berhasil Ditetapkan (Kompeten)');

		} elseif ($this->input->post('penetapan') == 'Belum Kompeten') {

			///////////// Pemenuhan Rekomendasi Asesor ke LPJK V2
			$get_data_rekomendasi_asesor_lpjk = $this->Admin_model->get_data_rekomendasi_asesor_lpjk($id_izin);
			$get_bukti_dokumentasi_asesmen = $this->asesor_model->get_bukti_dokumentasi_asesmen($id_izin);
			$get_data_pelaporan_asesor = $this->Admin_model->get_data_pelaporan_asesor($id_izin);
			$detail_jadwal = $this->Admin_model->get_detail_jadwal_asesmen_per_permohonan($id_izin);
			$kode_jadwal = isset($detail_jadwal->kode_jadwal) ? $detail_jadwal->kode_jadwal : (isset($detail_jadwal->id_jadwal_asesmen) ? $detail_jadwal->id_jadwal_asesmen : '');
			$get_verifikasi_tuk = $this->Admin_model->get_verifikasi_tuk($kode_jadwal);
			$get_absensi_pra_asesmen = $this->Admin_model->get_absensi_pra_asesmen($kode_jadwal);
			$get_absensi_asesmen = $this->Admin_model->get_absensi_asesmen($kode_jadwal);
			$token = $this->api_model->get_token();

			$rekomendasi = (isset($get_data_rekomendasi_asesor_lpjk->rekomendasi_asesor) && $get_data_rekomendasi_asesor_lpjk->rekomendasi_asesor == "Kompeten") ? "K" : "BK";

			$metode_uji = 'observasi';
			$uji_praktek_atau_observasi_lapangan = '0';
			$uji_tulis = '0';
			$uji_lisan = '0';
			$wawancara = '0';

			if (isset($get_data_rekomendasi_asesor_lpjk->metode_uji)) {
				if ($get_data_rekomendasi_asesor_lpjk->metode_uji == "1") {
					$metode_uji = 'observasi';
					$uji_praktek_atau_observasi_lapangan = '1';
					$uji_tulis = '1';
				} elseif ($get_data_rekomendasi_asesor_lpjk->metode_uji == "2") {
					$metode_uji = 'observasi';
					$uji_praktek_atau_observasi_lapangan = '1';
					$uji_tulis = '1';
					$uji_lisan = '1';
				} elseif ($get_data_rekomendasi_asesor_lpjk->metode_uji == "3") {
					$metode_uji = 'portofolio';
					$wawancara = '1';
				}
			}

			$tgl_uji = isset($get_data_rekomendasi_asesor_lpjk->tgl_uji) ? $get_data_rekomendasi_asesor_lpjk->tgl_uji : '';

			$url_form_uji_tulis = ($uji_tulis == "1") ? base_url("berkas/asesmen/") . base64_encode($id_izin) : "";
			$tgl_pelaksaaan_form_uji_tulis = ($uji_tulis == "1") ? $tgl_uji : "";

			$url_form_uji_lisan = ($uji_lisan == "1") ? base_url("berkas/asesmen/") . base64_encode($id_izin) : "";
			$tgl_pelaksaaan_form_uji_lisan = ($uji_lisan == "1") ? $tgl_uji : "";

			$url_form_wawancara = ($wawancara == "1") ? base_url("berkas/asesmen/") . base64_encode($id_izin) : "";
			$tgl_pelaksaaan_form_wawancara = ($wawancara == "1") ? $tgl_uji : "";

			$url_form_uji_praktek_atau_observasi_lapangan = ($uji_lisan == "1" || $uji_tulis == "1") ? base_url("berkas/asesmen/") . base64_encode($id_izin) : "";
			$tgl_pelaksaaan_form_uji_praktek_atau_observasi_lapangan = ($uji_lisan == "1" || $uji_tulis == "1") ? $tgl_uji : "";

			$jsonData_rekom_asesor = array(
				"id_asesor" => isset($get_data_rekomendasi_asesor_lpjk->id_asesor) ? $get_data_rekomendasi_asesor_lpjk->id_asesor : "",
				"id_asesor_2" => !empty($get_data_rekomendasi_asesor_lpjk->id_asesor_2) ? $get_data_rekomendasi_asesor_lpjk->id_asesor_2 : "",
				"rekomendasi" => $rekomendasi,
				"catatan" => isset($get_data_rekomendasi_asesor_lpjk->catatan) ? $get_data_rekomendasi_asesor_lpjk->catatan : "",
				"tgl_surat_tugas" => isset($get_data_rekomendasi_asesor_lpjk->tgl_surat_tugas) ? $get_data_rekomendasi_asesor_lpjk->tgl_surat_tugas : "",
				"no_surat_tugas" => isset($get_data_rekomendasi_asesor_lpjk->no_surat_tugas) ? $get_data_rekomendasi_asesor_lpjk->no_surat_tugas : "",
				"kode_tuk" => isset($get_data_rekomendasi_asesor_lpjk->kode_tuk) ? $get_data_rekomendasi_asesor_lpjk->kode_tuk : "",
				"nama_tuk" => isset($get_data_rekomendasi_asesor_lpjk->nama_tuk) ? $get_data_rekomendasi_asesor_lpjk->nama_tuk : "",
				"tgl_uji" => $tgl_uji,
				"tgl_selesai_uji" => isset($get_data_rekomendasi_asesor_lpjk->tgl_uji_selesai) ? $get_data_rekomendasi_asesor_lpjk->tgl_uji_selesai : "",
				"metode_uji" => $metode_uji,
				"uji_praktek_atau_observasi_lapangan" => $uji_praktek_atau_observasi_lapangan,
				"uji_tulis" => $uji_tulis,
				"uji_lisan" => $uji_lisan,
				"wawancara" => $wawancara,
				"penyelenggaraan_uji" => '1',
				"url_surat_tugas" => base_url("asesor/cetak_surat_tugas/") . base64_encode($id_izin),
				"url_surat_rekomendasi_akhir" => base_url("asesor/cetak_berita_acara_rekomendasi_asesor/") . base64_encode($id_izin),
				"url_apl01" => base_url("asesor/form_apl01/") . base64_encode($id_izin),
				"url_apl02" => base_url("asesor/form_apl02/") . base64_encode($id_izin),
				"url_dokumentasi_asesmen" => !empty($get_bukti_dokumentasi_asesmen->file) ? base_url("uploads/file_asesmen/bukti_dokumentasi_asesmen/") . $get_bukti_dokumentasi_asesmen->file : "",
				"url_form_uji_tulis" => $url_form_uji_tulis,
				"tgl_pelaksaaan_form_uji_tulis" => $tgl_pelaksaaan_form_uji_tulis,
				"url_form_uji_lisan" => $url_form_uji_lisan,
				"tgl_pelaksaaan_form_uji_lisan" => $tgl_pelaksaaan_form_uji_lisan,
				"url_form_wawancara" => $url_form_wawancara,
				"tgl_pelaksaaan_form_wawancara" => $tgl_pelaksaaan_form_wawancara,
				"tgl_verifikasi_apl01" => isset($get_data_pelaporan_asesor->tgl_verifikasi_apl01) ? $get_data_pelaporan_asesor->tgl_verifikasi_apl01 : "",
				"tgl_verifikasi_apl02" => isset($get_data_pelaporan_asesor->tgl_verifikasi_apl02) ? $get_data_pelaporan_asesor->tgl_verifikasi_apl02 : "",
				"tgl_dokumentasi" => $tgl_uji,
				"url_form_uji_praktek_atau_observasi_lapangan" => $url_form_uji_praktek_atau_observasi_lapangan,
				"tgl_pelaksaaan_form_uji_praktek_atau_observasi_lapangan" => $tgl_pelaksaaan_form_uji_praktek_atau_observasi_lapangan,

				"nama_admin_lsp" => isset($get_data_pelaporan_asesor->user_penunjuk) ? $get_data_pelaporan_asesor->user_penunjuk : "",
				"tgl_periksa_admin_lsp" => isset($get_data_pelaporan_asesor->log) ? date('Y-m-d', strtotime($get_data_pelaporan_asesor->log)) : "",
				"url_surat_verifikasi_tuk" => !empty($get_verifikasi_tuk->file_verifikasi) ? base_url("uploads/file_verifikasi/" . $get_verifikasi_tuk->file_verifikasi) : "",
				"tgl_kegiatan_pra_asesmen" => isset($get_absensi_pra_asesmen->log) ? date('Y-m-d', strtotime($get_absensi_pra_asesmen->log)) : "",
				"url_absensi_kegiatan_pra_asesmen" => !empty($get_absensi_pra_asesmen->file_absen) ? base_url("uploads/absensi_pra_asesmen/" . $get_absensi_pra_asesmen->file_absen) : "",
				"url_absensi_kegiatan_asesmen" => !empty($get_absensi_asesmen->file_absen) ? base_url("uploads/absensi_asesmen/" . $get_absensi_asesmen->file_absen) : "",

				"url_mapa01" => base_url("uploads/file_asesmen/mapa01/") . base64_encode($id_izin),
				"url_mapa02" => base_url("uploads/file_asesmen/mapa02/") . base64_encode($id_izin),
				"url_ak01" => base_url("uploads/file_asesmen/fr-ak01/") . base64_encode($id_izin),
				"url_ak02" => base_url("uploads/file_asesmen/fr-ak02/") . base64_encode($id_izin),
				"url_ak03" => base_url("uploads/file_asesmen/fr-ak03/") . base64_encode($id_izin),
				"url_ak04" => base_url("uploads/file_asesmen/fr-ak04/") . base64_encode($id_izin),
				"url_ak05" => base_url("uploads/file_asesmen/fr-ak05/") . base64_encode($id_izin),
				"url_ak06" => base_url("uploads/file_asesmen/fr-ak06/") . base64_encode($id_izin),
				"url_ak07" => base_url("uploads/file_asesmen/fr-ak07/") . base64_encode($id_izin),

				"url_ia01" => base_url("uploads/file_asesmen/fr-ia01/") . base64_encode($id_izin),
				"url_ia02" => base_url("uploads/file_asesmen/fr-ia02/") . base64_encode($id_izin),
				"url_ia03" => base_url("uploads/file_asesmen/fr-ia03/") . base64_encode($id_izin),
				"url_ia04a" => base_url("uploads/file_asesmen/fr-ia04a/") . base64_encode($id_izin),
				"url_ia04b" => base_url("uploads/file_asesmen/fr-ia04b/") . base64_encode($id_izin),
				"url_ia05" => base_url("uploads/file_asesmen/fr-ia05/") . base64_encode($id_izin),
				"url_ia06" => base_url("uploads/file_asesmen/fr-ia06/") . base64_encode($id_izin),
				"url_ia07" => base_url("uploads/file_asesmen/fr-ia07/") . base64_encode($id_izin),
				"url_ia08" => base_url("uploads/file_asesmen/fr-ia08/") . base64_encode($id_izin),
				"url_ia09" => base_url("uploads/file_asesmen/fr-ia09/") . base64_encode($id_izin),
				"url_ia10" => base_url("uploads/file_asesmen/fr-ia10/") . base64_encode($id_izin),
				"url_ia11" => base_url("uploads/file_asesmen/fr-ia11/") . base64_encode($id_izin),

				"nama_ttd_surat_verifikasi_tuk" => isset($get_verifikasi_tuk->nama_verifikator) ? $get_verifikasi_tuk->nama_verifikator : "",
				"tgl_ttd_surat_verifikasi_tuk" => isset($get_verifikasi_tuk->log) ? date('Y-m-d', strtotime($get_verifikasi_tuk->log)) : "",
				"url_absensi_asesor_kegiatan_pra_asesmen" => !empty($get_absensi_pra_asesmen->file_absen) ? base_url("uploads/absensi_pra_asesmen/" . $get_absensi_pra_asesmen->file_absen) : "",
				"url_absensi_asesi_kegiatan_pra_asesmen" => !empty($get_absensi_pra_asesmen->file_absen) ? base_url("uploads/absensi_pra_asesmen/" . $get_absensi_pra_asesmen->file_absen) : "",
				"url_absensi_asesor_kegiatan_asesmen" => !empty($get_absensi_asesmen->file_absen) ? base_url("uploads/absensi_asesmen/" . $get_absensi_asesmen->file_absen) : "",
				"url_absensi_asesi_kegiatan_asesmen" => !empty($get_absensi_asesmen->file_absen) ? base_url("uploads/absensi_asesmen/" . $get_absensi_asesmen->file_absen) : "",
			);

			$curl = curl_init();
			curl_setopt_array($curl, array(
				CURLOPT_URL => (isset($token->host) ? $token->host : '') . '/siki-api/v2/asesor-lsp-penugasan/' . $id_izin,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_SSL_VERIFYPEER => false,
				CURLOPT_CUSTOMREQUEST => 'POST',
				CURLOPT_POSTFIELDS => json_encode($jsonData_rekom_asesor),
				CURLOPT_HTTPHEADER => array(
					'token: ' . (isset($token->token) ? $token->token : ''),
					'Content-Type: application/json'
				),
			));

			$resAsesorRaw = curl_exec($curl);
			curl_close($curl);
			$arrAsesor = json_decode($resAsesorRaw, true);

			## Cek Asesor jika tidak terdaftar
			if (is_array($arrAsesor) && isset($arrAsesor['message']) && substr($arrAsesor['message'], -15) == 'tidak terdaftar') {
				$this->session->set_flashdata('message_pelaporan_asesor', $arrAsesor['message'] . ' Pastikan Asesor tersebut telah tercatat di Lisensi LPJK');
				redirect('komite/penetapan/' . base64_encode($id_izin), 'refresh');
			}

			$get_data_penetapan_komite_lpjk = $this->Admin_model->get_data_penetapan_komite_lpjk($id_izin);

			$hasil_penetapan = (isset($get_data_penetapan_komite_lpjk->hasil_penetapan) && $get_data_penetapan_komite_lpjk->hasil_penetapan == "Kompeten") ? "K" : "BK";
			$catatan_penetapan = !empty($get_data_penetapan_komite_lpjk->catatan) ? $get_data_penetapan_komite_lpjk->catatan : (isset($get_data_penetapan_komite_lpjk->hasil_penetapan) ? $get_data_penetapan_komite_lpjk->hasil_penetapan : "");

			$jsonData_penetapan_komite = array(
				"nama_komite_teknis" => isset($get_data_penetapan_komite_lpjk->nama_komite_teknis) ? $get_data_penetapan_komite_lpjk->nama_komite_teknis : "",
				"jabatan_komite_teknis" => isset($get_data_penetapan_komite_lpjk->jabatan_komite_teknis) ? $get_data_penetapan_komite_lpjk->jabatan_komite_teknis : "",
				"hasil_penetapan" => $hasil_penetapan,
				"catatan" => $catatan_penetapan,
				"tgl_surat_tugas" => isset($get_data_penetapan_komite_lpjk->tgl_surat_tugas) ? $get_data_penetapan_komite_lpjk->tgl_surat_tugas : "",
				"no_surat_tugas" => isset($get_data_penetapan_komite_lpjk->no_surat_tugas) ? $get_data_penetapan_komite_lpjk->no_surat_tugas : "",
				"tgl_penetapan" => isset($get_data_penetapan_komite_lpjk->tgl_penetapan) ? $get_data_penetapan_komite_lpjk->tgl_penetapan : "",
				"url_surat_tugas" => base_url("Admin/cetak_st_komite/") . base64_encode($id_izin),
				"url_ba_penetapan" => base_url("komite/cetak_berita_acara_pleno_komite/") . base64_encode($id_izin),
				"met_komtek_1" => isset($get_data_penetapan_komite_lpjk->no_reg) ? $get_data_penetapan_komite_lpjk->no_reg : "",
				"met_komtek_2" => "",
				"met_komtek_3" => "",
				"url_absensi_tim_komtek" => base_url("Admin/cetak_absensi_komite/") . base64_encode($id_izin),
			);

			$curl = curl_init();
			curl_setopt_array($curl, array(
				CURLOPT_URL => (isset($token->host) ? $token->host : '') . '/siki-api/v1/komtek-lsp-penugasan/' . $id_izin,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_SSL_VERIFYPEER => false,
				CURLOPT_CUSTOMREQUEST => 'POST',
				CURLOPT_POSTFIELDS => json_encode($jsonData_penetapan_komite),
				CURLOPT_HTTPHEADER => array(
					'token: ' . (isset($token->token) ? $token->token : ''),
					'Content-Type: application/json'
				),
			));
			curl_exec($curl);
			curl_close($curl);

			// Insert Log History Permohonan
			$data_tinjau['id_izin'] = $id_izin;
			$data_tinjau['kode_status'] = "90";
			$data_tinjau['log'] = date("Y-m-d H:i:s");
			$data_tinjau['username'] = $this->session->userdata('username');

			$this->Admin_model->insert_log_history_permohonan(array_map($to_scalar, $data_tinjau));

			// API Status 90 Belum Kompeten
			if (isset($token->host)) {
				$ch = curl_init($token->host . '/siki-api/v1/permohonan-skk/' . $id_izin);
				$jsonData = array(
					'kd_status' => '90',
					'keterangan' => "Belum Kompeten",
				);

				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($jsonData));
				curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'token: ' . $token->token));
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

				$resStatusRaw = curl_exec($ch);
				curl_close($ch);

				$arrStatus = json_decode($resStatusRaw, true);

				$status_res = isset($arrStatus["status"]) ? $arrStatus["status"] : "failed";
				$message_res = isset($arrStatus["message"]) ? $arrStatus["message"] : "Gagal Hit API SIKI";

				if ($status_res == "success") {
					$this->session->set_flashdata('message', 'Penetapan Berhasil (Belum Kompeten)');
				} else {
					$this->session->set_flashdata('error_siki', 'Gagal Kirim Status 90 ke SIKI');
				}

				$log_hit_status_siki_portal['id_izin'] = $id_izin;
				$log_hit_status_siki_portal['status'] = $status_res;
				$log_hit_status_siki_portal['message'] = $message_res;
				$log_hit_status_siki_portal['log'] = $log;

				$this->db->insert('log_hit_status_permohonan_siki_portal', array_map($to_scalar, $log_hit_status_siki_portal));
			}
		}

		$data_penetapan = array(
			'id_izin' => $id_izin,
			'hasil_penetapan' => $this->input->post('penetapan'),
			'catatan' => $this->input->post('catatan'),
			'user_penetap' => $this->session->userdata('username'),
			'ketua_pelaksana' => isset($get_data_ketua_pelaksana->nama) ? $get_data_ketua_pelaksana->nama : '',
			'ttd_ketua_pelaksana' => isset($get_data_ketua_pelaksana->file_ttd) ? $get_data_ketua_pelaksana->file_ttd : '',
			'log' => date("Y-m-d H:i:s")
		);

		$this->db->replace('data_hasil_penetapan_komite_teknis', array_map($to_scalar, $data_penetapan));

		redirect("Komite/list_penetapan", "refresh");
	}

	public function cetak_form_apl01($id_izin)
	{
		##/Cek Session Login##
		if (!$this->ion_auth->ceklogin()) {
			redirect('login', 'refresh');
		} else if ($this->session->userdata('level') !== 'Komite') {
			redirect('login/keluar', 'refresh');
		}
		##/Cek Session Login##
		$id_izin = base64_decode($id_izin);

		$get_data_apl01 = $this->asesor_model->get_data_apl01($id_izin);
		$get_data_personal_permohonan = $this->asesor_model->get_data_personal_permohonan($id_izin);
		$get_data_pendidikan_permohonan = $this->asesor_model->get_data_pendidikan_permohonan($id_izin);
		$get_data_unit_kompetensi = $this->asesor_model->get_data_unit_kompetensi($id_izin);
		$get_data_klasifikasi_kualifikasi = $this->asesor_model->get_data_klasifikasi_kualifikasi($id_izin);
		$token = $this->api_model->get_token();

		#Get Data Apl
		$get_data_pendidikan_yang_sesuai = $this->asesor_model->get_data_pendidikan_yang_sesuai($id_izin);
		$get_nama_peninjau_apl01 = $this->asesor_model->get_nama_peninjau_apl01($id_izin);

		#Get Master Pendidikan
		$get_master_jenjang_pendidikan = $this->master_model->get_master_jenjang_pendidikan();
		$get_master_persyaratan_kompeten = $this->master_model->get_master_persyaratan_kompeten();
		$get_master_jabatan_kerja = $this->master_model->get_master_jabatan_kerja();

		$data = array(
			'id_izin' => $id_izin,
			'get_data_personal_permohonan' => $get_data_personal_permohonan,
			'get_data_pendidikan_permohonan' => $get_data_pendidikan_permohonan,
			'get_data_apl01' => $get_data_apl01,
			'get_data_unit_kompetensi' => $get_data_unit_kompetensi,
			'get_data_pendidikan_yang_sesuai' => $get_data_pendidikan_yang_sesuai,
			'get_data_klasifikasi_kualifikasi' => $get_data_klasifikasi_kualifikasi,
			'get_master_jenjang_pendidikan' => $get_master_jenjang_pendidikan,
			'get_master_persyaratan_kompeten' => $get_master_persyaratan_kompeten,
			'get_master_jabatan_kerja' => $get_master_jabatan_kerja,
			'get_nama_peninjau_apl01' => $get_nama_peninjau_apl01,
			'token' => $token,
		);

		$file_pdf = 'Formulir Apl-01';
		$paper = 'A4';
		$orientation = "potrait";
		$page = 'Asesor/pra-asesmen/apl/cetak_apl01';

		// $this->load->view($page, $data);
		$html = $this->load->view($page, $data, true);
		ob_clean();
		error_reporting(0);
		$this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
	}

	public function cetak_form_apl02($id_izin)
	{
		##/Cek Session Login##
		if (!$this->ion_auth->ceklogin()) {
			redirect('login', 'refresh');
		} else if ($this->session->userdata('level') !== 'Komite') {
			redirect('login/keluar', 'refresh');
		}
		##/Cek Session Login##
		$id_izin = base64_decode($id_izin);

		# Get Data Master Model
		$get_master_unit_kompetensi = $this->master_model->get_master_unit_kompetensi();
		$get_master_elemen_kompetensi = $this->master_model->get_master_elemen_kompetensi();
		$get_master_kriteria_unjuk_kerja = $this->master_model->get_master_kriteria_unjuk_kerja();
		$token = $this->api_model->get_token();

		# Get Data Permohonan
		$get_data_klasifikasi_kualifikasi = $this->asesor_model->get_data_klasifikasi_kualifikasi($id_izin);
		$get_data_apl01 = $this->asesor_model->get_data_apl01($id_izin);
		$get_data_personal_permohonan = $this->asesor_model->get_data_personal_permohonan($id_izin);

		# Get Data Apl-02
		$get_data_apl02 = $this->asesor_model->get_data_apl02($id_izin);
		$get_bukti_relavan_apl02 = $this->asesor_model->get_bukti_relavan_apl02($id_izin);


		$data = array(
			'id_izin' => $id_izin,
			'get_data_klasifikasi_kualifikasi' => $get_data_klasifikasi_kualifikasi,
			'get_master_unit_kompetensi' => $get_master_unit_kompetensi,
			'get_master_elemen_kompetensi' => $get_master_elemen_kompetensi,
			'get_master_kriteria_unjuk_kerja' => $get_master_kriteria_unjuk_kerja,
			'get_data_apl02' => $get_data_apl02,
			'get_bukti_relavan_apl02' => $get_bukti_relavan_apl02,
			'get_data_apl01' => $get_data_apl01,
			'get_data_personal_permohonan' => $get_data_personal_permohonan,
			'token' => $token,
		);

		$file_pdf = 'Formulir Apl.02';
		$paper = 'A4';
		$orientation = "potrait";
		$page = 'Asesor/pra-asesmen/apl/cetak_apl02';

		// $this->load->view($page, $data);
		$html = $this->load->view($page, $data, true);
		ob_clean();
		error_reporting(0);
		$this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
	}

	public function selesai_penetapan()
	{
		##/Cek Session Login##
		if (!$this->ion_auth->ceklogin()) {
			redirect('login', 'refresh');
		} else if ($this->session->userdata('level') !== 'Komite') {
			redirect('login/keluar', 'refresh');
		}
		##/Cek Session Login##

		# Get Data
		$get_list_selesai_penetapan = $this->komite_model->get_list_selesai_penetapan();

		$this->data = array(
			'username' => $this->session->userdata('username'),
			'level' => $this->session->userdata('level'),
			'get_list_selesai_penetapan' => $get_list_selesai_penetapan,
		);
		$this->template->load('menu', 'Komite/penetapan/list_selesai_penetapan', $this->data);
	}

	public function cetak_surat_tugas_komite($id_izin)
	{
		$id_izin = base64_decode($id_izin);
		$get_data_hasil_penetapan_komite_teknis = $this->komite_model->get_data_hasil_penetapan_komite_teknis($id_izin);
		$get_data_pencatatan = $this->komite_model->get_data_pencatatan($id_izin);
		$get_data_penetapan_komite_lpjk = $this->Admin_model->get_data_penetapan_komite_lpjk($id_izin);
		$get_data_lsp = $this->api_model->get_token();

		$data = array(
			'id_izin' => $id_izin,
			'get_data_hasil_penetapan_komite_teknis' => $get_data_hasil_penetapan_komite_teknis,
			'get_data_pencatatan' => $get_data_pencatatan,
			'get_data_penetapan_komite_lpjk' => $get_data_penetapan_komite_lpjk,
			'get_data_lsp' => $get_data_lsp,
		);

		$file_pdf = 'ST Komite (' . $id_izin . ')';
		$paper = 'A4';
		$orientation = "potrait";
		$page = 'Komite/penetapan/cetak_surat_tugas_komite';

		// $this->load->view($page, $data);
		$html = $this->load->view($page, $data, true);
		ob_clean();
		error_reporting(0);
		$this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
	}

	public function cetak_surat_keputusan_komite($id_izin)
	{
		$id_izin = base64_decode($id_izin);

		$token = $this->api_model->get_token();
		$get_data_pencatatan = $this->komite_model->get_data_pencatatan($id_izin);
		$get_data_hasil_penetapan_komite_teknis = $this->komite_model->get_data_hasil_penetapan_komite_teknis($id_izin);

		$data = array(
			'id_izin' => $id_izin,
			'get_data_pencatatan' => $get_data_pencatatan,
			'get_data_hasil_penetapan_komite_teknis' => $get_data_hasil_penetapan_komite_teknis,
			'token' => $token,
		);

		$file_pdf = 'SK Komite (' . $id_izin . ')';
		$paper = 'A4';
		$orientation = "potrait";
		$page = 'Komite/penetapan/cetak_surat_keputusan_komite';

		// $this->load->view($page, $data);
		$html = $this->load->view($page, $data, true);
		ob_clean();
		error_reporting(0);
		$this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
	}

	public function cetak_berita_acara_pleno_komite($id_izin)
	{
		$id_izin = base64_decode($id_izin);

		$get_penunjukan = $this->Admin_model->get_penunjukan_komite($id_izin);
		$get_master_komite = $this->Admin_model->get_master_komite();
		$get_data_pencatatan = $this->komite_model->get_data_pencatatan($id_izin);
		$get_data_hasil_penetapan_komite_teknis = $this->komite_model->get_data_hasil_penetapan_komite_teknis($id_izin);
		$get_data_komite_teknis = $this->komite_model->get_data_komite_teknis();

		$data = array(
			'id_izin' => $id_izin,
			'get_data_pencatatan' => $get_data_pencatatan,
			'get_data_hasil_penetapan_komite_teknis' => $get_data_hasil_penetapan_komite_teknis,
			'get_data_komite_teknis' => $get_data_komite_teknis,
			'get_penunjukan' => $get_penunjukan,
			'get_master_komite' => $get_master_komite,
		);

		$file_pdf = 'BA Komtek (' . $id_izin . ')';
		$paper = 'A4';
		$orientation = "potrait";
		$page = 'Komite/penetapan/cetak_berita_acara_pleno_komite';

		// $this->load->view($page, $data);
		$html = $this->load->view($page, $data, true);
		$this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
	}

}