<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mail extends MY_Controller {

    public function __construct() {
        parent:: __construct();
        $this->load->helper('url');
        $this->load->config('email');
        $this->load->library(array('email','ciqrcode','system'));
		$this->load->model('admin_model');
		$this->load->model('komite_model');
		$this->load->model('report_model');
		$this->load->model('api_model');

    }

	public function test_susulan_asesor(){
		$id_izin = array(
'I-2023030613492535542',
'I-2023030714511072496',
'I-2023031212344743701',
'I-2023031215055616725',
'I-2023031216163647007',
'I-2023071511023842690',
'I-2023071812200223798',
'I-2023071915480714542',
'I-2023072014080629464',
'I-2023072021191849067',
'I-2023072100171323305',
'I-2023072109125389590',
'I-2023072116571264028',
'I-2023072116580143232',
'I-2023072412252815002',
'I-2023072414532710214',
'I-2023072511081824050',
'I-2023072818471930262',
'I-2023080421401539540',
'I-2023091020041848938',
'I-2023091209080570369',
'I-2023091512374317794',
'I-2023091909000466224',
'I-2023091917551669944',
'I-2023091922125763683',
'I-2023092013035052130',
'I-2023092013451866588',
'I-2023092015494958975',
'I-2023092110491889807',
'I-2023092112200821650',
'I-2023092114512753008',
'I-2023092215351597467',
'I-2023092218381276339',
'I-2023092510563040822',
'I-2023092511380464282',
'I-2023092613310517666',
'I-2023092621085771072',
'I-2023093016494961307',
'I-2023100223210896729',
'I-2023100315111562179',
'I-2023100411364033211',
'I-2023100414432193004',
'I-2023100614240315892',
'I-2023100620050917803',
'I-2023100713504732108',
'I-2023100921052871921',
'I-2023101715264896188',
'I-2023101807291714697',
'I-2023101820062798050',
'I-2023101916212846320',
'I-2023102309295815044',
'I-2023102412192850928',
'I-2023103014301253356',
'I-2023103016311919331',
'I-2023103111354956977',
'I-2023110209242261820',
'I-2023110616241560403',
'I-2023110620420079432',
'I-2023110810342489326',
'I-2023110811041643707',
'I-2023110811424195916',
'I-2023110813362489487',
'I-2023110820471358027',
'I-2023110823361071917',
'I-2023110922370685285',
'I-2023111420252495178',
'I-2023111423345117587'
		);

		foreach($id_izin as $id_izins){
			// // // Pelaporan Asesor ke LPJK jika BK pemohonnya // //
			$curl = curl_init();
			$get_data_rekomendasi_asesor_lpjk = $this->admin_model->get_data_rekomendasi_asesor_lpjk($id_izins);
			$get_bukti_dokumentasi_asesmen = $this->asesor_model->get_bukti_dokumentasi_asesmen($id_izins);
			$token = $this->api_model->get_token();

			$curl = curl_init();

			if($get_data_rekomendasi_asesor_lpjk->rekomendasi_asesor == "Kompeten"){
				$rekomendasi = "K";
			}elseif($get_data_rekomendasi_asesor_lpjk->rekomendasi_asesor == "Belum Kompeten"){
				$rekomendasi = "BK";
			}
			if(empty($get_data_rekomendasi_asesor_lpjk->catatan)){
				$catatan_rekomendasi = $get_data_rekomendasi_asesor_lpjk->rekomendasi_asesor;
			}else{
				$catatan_rekomendasi = $get_data_rekomendasi_asesor_lpjk->catatan;
			}

			// Metode Uji
			if($get_data_rekomendasi_asesor_lpjk->metode_uji == "1"){
				$metode_uji = 'observasi';
				$uji_praktek_atau_observasi_lapangan = '1';
				$uji_tulis = '1';
				$uji_lisan = '0';
				$wawancara = '0';
			}elseif($get_data_rekomendasi_asesor_lpjk->metode_uji == "2"){
				$metode_uji = 'observasi';
				$uji_praktek_atau_observasi_lapangan = '1';
				$uji_tulis = '1';
				$uji_lisan = '0';
				$wawancara = '0';
			}elseif($get_data_rekomendasi_asesor_lpjk->metode_uji == "3"){
				$metode_uji = 'portofolio';
				$uji_praktek_atau_observasi_lapangan = '0';
				$uji_tulis = '0';
				$uji_lisan = '0';
				$wawancara = '1';
			}

			$jsonData_rekom_asesor = array(
				"id_asesor" => $get_data_rekomendasi_asesor_lpjk->id_asesor,
				"rekomendasi" => $rekomendasi,
				"catatan" => $catatan_rekomendasi,
				"tgl_surat_tugas" => $get_data_rekomendasi_asesor_lpjk->tgl_surat_tugas,
				"no_surat_tugas" => $get_data_rekomendasi_asesor_lpjk->no_surat_tugas,
				"kode_tuk" => $get_data_rekomendasi_asesor_lpjk->kode_tuk,
				"nama_tuk" => $get_data_rekomendasi_asesor_lpjk->nama_tuk,
				"tgl_uji" => $get_data_rekomendasi_asesor_lpjk->tgl_uji,
				"tgl_selesai_uji" => $get_data_rekomendasi_asesor_lpjk->tgl_uji_selesai,
				"metode_uji" => $metode_uji,
				"uji_praktek_atau_observasi_lapangan" => $uji_praktek_atau_observasi_lapangan,
				"uji_tulis" => $uji_tulis,
				"uji_lisan" => $uji_lisan,
				"wawancara" => $wawancara,
				"penyelenggaraan_uji" => '1',
				"url_surat_tugas" => base_url("berkas/surat_tugas_asesor/").base64_encode($id_izins),
				"url_surat_rekomendasi_akhir" => base_url("berkas/ba_rekomendasi_asesor/").base64_encode($id_izins),
				"url_apl01" => base_url("cetak_form_asesmen/apl01/").base64_encode($id_izins),
				"url_apl02" => base_url("cetak_form_asesmen/apl02/").base64_encode($id_izins),
				"url_dokumentasi_asesmen" => base_url("uploads/file_asesmen/bukti_dokumentasi_asesmen/").$get_bukti_dokumentasi_asesmen->file
			);

			$jsonData_rekom_asesor_encode = json_encode($jsonData_rekom_asesor);

			curl_setopt_array($curl, array(
			CURLOPT_URL => $token->host.'/siki-api/v2/asesor-lsp-penugasan-susulan/'.$id_izins,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'POST',
			CURLOPT_POSTFIELDS => $jsonData_rekom_asesor_encode,
			CURLOPT_HTTPHEADER => array(
				'token: ' .$token->token,
				'Content-Type: application/json'
			),
			));
			$arr = json_decode(curl_exec($curl), true);
			$responseInfo = curl_getinfo($curl);
			curl_close($curl);
			if ($responseInfo["http_code"]!=200 && $responseInfo["http_code"]!=201) {
				echo print_r($arr);
				echo "<br/><br/><br/>";
			}else{
				// Pemenuhan Penetapana Komite ke LPJK
							
				$get_data_penetapan_komite_lpjk = $this->admin_model->get_data_penetapan_komite_lpjk($id_izins);
				$curl = curl_init();

				if($get_data_penetapan_komite_lpjk->hasil_penetapan == "Kompeten"){
					$hasil_penetapan = "K";
				}elseif($get_data_penetapan_komite_lpjk->hasil_penetapan == "Belum Kompeten"){
					$hasil_penetapan = "BK";
				}
	
				if(empty($get_data_penetapan_komite_lpjk->catatan)){
					$catatan_penetapan = $get_data_penetapan_komite_lpjk->hasil_penetapan;
				}else{
					$catatan_penetapan = $get_data_penetapan_komite_lpjk->catatan;
				}
	
				$jsonData_penetapan_komite = array(
					"nama_komite_teknis" => $get_data_penetapan_komite_lpjk->nama_komite_teknis,
					"jabatan_komite_teknis" => $get_data_penetapan_komite_lpjk->jabatan_komite_teknis,
					"hasil_penetapan" => $hasil_penetapan,
					"catatan" => $catatan_penetapan,
					"tgl_surat_tugas" => $get_data_penetapan_komite_lpjk->tgl_surat_tugas,
					"no_surat_tugas" => $get_data_penetapan_komite_lpjk->no_surat_tugas,
					"tgl_penetapan" => $get_data_penetapan_komite_lpjk->tgl_penetapan,
					"url_surat_tugas" => base_url("berkas/surat_tugas_komite_teknis/").base64_encode($id_izins),
					"url_ba_penetapan" => base_url("berkas/ba_pleno_komite_teknis/").base64_encode($id_izins),
				);

				$jsonData_penetapan_komite_encode = json_encode($jsonData_penetapan_komite);

				curl_setopt_array($curl, array(
				CURLOPT_URL => $token->host.'/siki-api/v1/komtek-lsp-penugasan-susulan/'.$id_izins,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => '',
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 0,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => 'POST',
				CURLOPT_POSTFIELDS => $jsonData_penetapan_komite_encode,
				CURLOPT_HTTPHEADER => array(
					'token: ' .$token->token,
					'Content-Type: application/json'
				),
				));
				$response = curl_exec($curl);
				// Tracking Error
				print_r($response);
				echo "<br/><br/><br/>";
				curl_close($curl);
			}
		}
	// // Pelaporan Asesor ke LPJK jika BK pemohonnya // //
	}

	public function pindah_ttd(){
		$get_ttd = $this->report_model->data_apl01_permohonan();

		foreach($get_ttd as $ttd){
			// Update Data No Rg
			$data = array(
				'asesor' => "1",
				'ttd_asesor' => $ttd['ttd_asesor_apl02'],
				'tanggal_ttd' => $ttd['tanggal_ttd_asesor_apl02'],
			);
			$where = array(
				'id_izin' => $ttd['id_izin']
			);
			$this->report_model->update_data($where,$data,'data_penunjukan_asesor');

		}
	}

	public function insert_peserta(){
		##/Cek Session Login##
		$id_izin = 'I-2022090223015570775';

		// // // Insert Peserta ke Jadwal BNSP // // //
		$get_data_pemohon_peserta_dalam_jadwal_asesmen = $this->admin_model->get_data_pemohon_peserta_dalam_jadwal_asesmen($id_izin);
		$get_detail_jadwal_asesmen = $this->admin_model->get_detail_jadwal_asesmen($this->security->xss_clean('BNSP.UJKK.202209277909'));
		$get_data_asesor = $this->admin_model->get_data_asesor($this->security->xss_clean('at200272'));
		$token_bnsp = $this->api_model->get_token_bnsp();
		
		//API Url
		$url = $token_bnsp->host."jadwal/peserta";
		
		//Initiate cURL.
		$ch = curl_init($url);

		// kode master
		if($get_data_pemohon_peserta_dalam_jadwal_asesmen->negara == 'ID'){
			$negara_id = 1;
		}
		if($get_data_pemohon_peserta_dalam_jadwal_asesmen->negara_sekolah == 'ID'){
			$negara_sekolah = 1;
		}
		if($get_data_pemohon_peserta_dalam_jadwal_asesmen->jenis_kelamin == 'Pria'){
			$jenis_kelamin = 1;
		}else{
			$jenis_kelamin = 2;
		}

		//The JSON data.
		$jsonData = array(
			"jadwal_id" => $get_detail_jadwal_asesmen->id,
			"tuk_id" => $get_detail_jadwal_asesmen->id_tuk,
			"asesor_id" => $get_data_asesor->id_asesor_bnsp_penunjukan,
			"nik" => $get_data_pemohon_peserta_dalam_jadwal_asesmen->nik,
			"nib" => null,
			"nama" => $get_data_pemohon_peserta_dalam_jadwal_asesmen->nama,
			"tempat_lahir" => $get_data_pemohon_peserta_dalam_jadwal_asesmen->tempat_lahir,
			"tanggal_lahir" => $get_data_pemohon_peserta_dalam_jadwal_asesmen->tanggal_lahir,
			"jenis_kelamin" => $jenis_kelamin,
			"alamat" => $get_data_pemohon_peserta_dalam_jadwal_asesmen->alamat,
			"kota_id" => $get_data_pemohon_peserta_dalam_jadwal_asesmen->id_kabupaten_bnsp,
			"provinsi_id" => $get_data_pemohon_peserta_dalam_jadwal_asesmen->id_propinsi_bnsp,
			"negara_id" => $negara_id,
			"telepon" => $get_data_pemohon_peserta_dalam_jadwal_asesmen->telepon,
			"email" => $get_data_pemohon_peserta_dalam_jadwal_asesmen->email,
			"jenis_mohon" => $get_data_pemohon_peserta_dalam_jadwal_asesmen->jenis_permohonan,
			"skema_id" => $get_data_pemohon_peserta_dalam_jadwal_asesmen->skema_id,
			"keterangan" => $get_data_pemohon_peserta_dalam_jadwal_asesmen->keterangan_skema,
			"jenjang_id" => $get_data_pemohon_peserta_dalam_jadwal_asesmen->jenjang_id,
			"prodi" => $get_data_pemohon_peserta_dalam_jadwal_asesmen->program_studi,
			"no_ijasah" => $get_data_pemohon_peserta_dalam_jadwal_asesmen->no_ijazah,
			"tanggal_ijazah" => null,
			"tahun_lulus" => $get_data_pemohon_peserta_dalam_jadwal_asesmen->tahun_lulus,
			"kota_sekolah" => $get_data_pemohon_peserta_dalam_jadwal_asesmen->id_kabupaten_bnsp_sekolah,
			"prov_sekolah" => $get_data_pemohon_peserta_dalam_jadwal_asesmen->id_propinsi_bnsp_sekolah,
			"negara_sekolah" => $negara_sekolah,
			"nama_sekolah" => $get_data_pemohon_peserta_dalam_jadwal_asesmen->nama_sekolah_perguruan_tinggi,
			"pekerjaan" => $get_data_pemohon_peserta_dalam_jadwal_asesmen->id_pekerjaan,
			"instansi_pekerjaan" => $get_data_pemohon_peserta_dalam_jadwal_asesmen->pekerjaan_sekarang_perusahaan,
			"jabatan_pekerjaan" => $get_data_pemohon_peserta_dalam_jadwal_asesmen->pekerjaan_sekarang_jabatan,
			"file_foto" => $get_data_pemohon_peserta_dalam_jadwal_asesmen->pas_foto,
			"file_ktp" => $get_data_pemohon_peserta_dalam_jadwal_asesmen->ktp,
			"file_nib" => null,
			"file_ijazah" => $get_data_pemohon_peserta_dalam_jadwal_asesmen->scan_ijazah_legalisir
		);

		//Encode the array into JSON.
		$jsonDataEncoded = json_encode($jsonData);

		//Tell cURL that we want to send a POST request.
		curl_setopt($ch, CURLOPT_POST, 1);

		//Attach our encoded JSON string to the POST fields.
		curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);

		//Set the content type to application/json
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'x-authorization:'.$token_bnsp->x_authorization,
			'token:'.$token_bnsp->x_authorization
		));

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		$responseBody = json_decode(curl_exec($ch), true);

		print_r($responseBody);
	}


    public function create_blanko(){
         ///////////// Create Blanko ke BNSP  /////////////////
                $id_izin = 'I-2022071323490793174';
			    $get_data_personal_permohonan = $this->komite_model->get_data_personal_permohonan($id_izin);
				$token_bnsp = $this->api_model->get_token_bnsp();
				$get_detail_jadwal_asesmen = $this->komite_model->get_detail_jadwal_asesmen($id_izin);
			    $get_nomor_sertifikat_terakhir = $this->komite_model->get_nomor_sertifikat_terakhir();

				//API Url
				$url = $token_bnsp->host."jadwal/blanko";
				
				//Initiate cURL.
				$ch = curl_init($url);

				$data_pemohon = array(
					"jadwal_id" => $get_detail_jadwal_asesmen->id_jadwal_asesmen,
					"form_id" => 1,
					"nama" => $get_data_personal_permohonan->nama,
					"nomor" => 00001,
					"tanggal" => date("Y-m-d"),
					"file_dokumen" => base_url('berkas/ba_rekomendasi_asesor/').base64_encode($id_izin)
				);
				
				$data_ba_pleno = array(
					"jadwal_id" => $get_detail_jadwal_asesmen->id_jadwal_asesmen,
					"form_id" => 2,
					"nama" => "Berita Acara Pleno Komite Teknis",
					"nomor" => 00001,
					"tanggal" => date("Y-m-d"),
					"file_dokumen" => base_url('berkas/ba_pleno_komite_teknis/').base64_encode($id_izin)
				);
				
				$data_sk_hasil_sertifikasi = array(
					"jadwal_id" => $get_detail_jadwal_asesmen->id_jadwal_asesmen,
					"form_id" => 3,
					"nama" => "SK Hasil Sertifikasi Kompetensi",
					"nomor" => 00001,
					"tanggal" => date("Y-m-d"),
					"file_dokumen" => base_url('berkas/sk_komite_teknis/').base64_encode($id_izin) 
				);

				//The JSON data.
				$jsonData = [$data_pemohon,$data_ba_pleno,$data_sk_hasil_sertifikasi];

				//Encode the array into JSON.
				$jsonDataEncoded = json_encode($jsonData);

				//Tell cURL that we want to send a POST request.
				curl_setopt($ch, CURLOPT_POST, 1);

				//Attach our encoded JSON string to the POST fields.
				curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);

				//Set the content type to application/json
				curl_setopt($ch, CURLOPT_HTTPHEADER, array(
					'Content-Type: application/json',
					'x-authorization:'.$token_bnsp->x_authorization,
					'token:'.$token_bnsp->x_authorization
				));

				curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

				//Execute the request
				$result = curl_exec($ch);

                echo base_url('berkas/ba_rekomendasi_asesor/').base64_encode($id_izin);
                print_r($result);
		///////////// / Create Blanko ke BNSP /////////////////
    }

    public function bnsp_test(){
        include('BnspApi.php');

        $api=BnspApi::getInstance();
        
        $datafilter=array(
            "idlsp" => "3913"
         );
         
        $test = $api->postapi("gettuk",$datafilter);
        
        echo $test;
        // echo $test1['status'];

        // $token_bnsp = $this->api_model->get_token_bnsp();
		// ## Set Configuration Header.
		// $headers = array(
		// 	'Content-Type: application/json',
		// 	'x-authorization:'.$token_bnsp->x_authorization
		// );
		// ## Set Variable From POST Kategori

		// ## Set URL Source Data ##
		// $baseUrl = $token_bnsp->host."master/negara";

		// //Set the headers that we want our cURL client to use.
		// $ch = curl_init();
		// //Set the headers that we want our cURL client to use.
		// curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		// curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// curl_setopt($ch, CURLOPT_URL, "$baseUrl");

		// $responseBody = curl_exec($ch);
		// $responseInfo = curl_getinfo($ch);
		// curl_close($ch);

		// echo $responseBody;

    }

    function test_qrcode(){
        $id_izin = 'I-2022062411374372146';
        //Generate QR CODE untuk Signature
				$config['cacheable']    = true; //boolean, the default is true
				$config['cachedir']     = './uploads/qrcode_signature/'; //string, the default is application/cache/
				$config['errorlog']     = './uploads/qrcode_signature/'; //string, the default is application/logs/
				$config['imagedir']     = './uploads/qrcode_signature/'; //direktori penyimpanan qr code
				$config['quality']      = true; //boolean, the default is true
				$config['size']         = '1024'; //interger, the default is 1024
				$config['black']        = array(224,255,255); // array, default is array(255,255,255)
				$config['white']        = array(70,130,180); // array, default is array(0,0,0)
				$this->ciqrcode->initialize($config);


				$image_name = 'qr_signature-'. base64_encode($id_izin) .'.png'; //buat name dari qr code sesuai dengan nim
				$params['data'] = base_url('/sertifikat/validasi_signature/').base64_encode($id_izin); //data yang akan di jadikan QR CODE
				$params['level'] = 'H'; //H=High
				$params['size'] = 10;
				$params['savename'] = $config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
				$this->ciqrcode->generate($params); 
    }

    public function test_mail(){
        $id_izin = 'I-2022070409104277122';
		/// Send Mail ke User //
		$get_data_personal_permohonan = $this->admin_model->get_data_personal_permohonan($id_izin);
		$get_data_penunjukan_asesor = $this->admin_model->get_data_penunjukan_asesor($id_izin);
		

		$from = $this->config->item('smtp_user');
		$to = 'faishal15@gmail.com';
		$subject = 'Pemberitahuan Permohonan SKK';

		$data = array(
			"id_izin" => $id_izin,
			"get_data_personal_permohonan" => $get_data_personal_permohonan,
			"get_data_penunjukan_asesor" => $get_data_penunjukan_asesor,
		);
		$message = $this->load->view('Sendmail/10-dokumen_lengkap_tinjau_permohonan',$data,true);;

		$this->email->set_newline("\r\n");
		$this->email->from($from);
		$this->email->to($to);
		$this->email->subject($subject);
		$this->email->message($message);

		if ($this->email->send()) {
			echo '';
		} else {
			show_error($this->email->print_debugger());
		}
		/// /Send Mail ke User //
    }

    public function upload(){
        $folderPath = "uploads/";
  
        $image_parts = explode(";base64,", $_POST['signed']);
            
        $image_type_aux = explode("image/", $image_parts[0]);
          
        $image_type = $image_type_aux[1];
          
        $image_base64 = base64_decode($image_parts[1]);
          
        $file = $folderPath . uniqid() . '.'.$image_type;
          
        file_put_contents($file, $image_base64);
        echo "Signature Uploaded Successfully.";
    }
    
    function test() {
        $from = $this->config->item('smtp_user');
        // $to = $this->input->post('to');
        $to = 'ewanggaarga07@gmail.com';
		$get_data_lsp = $this->api_model->get_token();
		
        // $subject = $this->input->post('subject');
        $subject = 'test';
        $message = '<h1>Ewangga</h1>';

        $this->email->set_newline("\r\n");
        $this->email->from($from);
        $this->email->to($to);
		$this->email->cc($get_data_lsp->cc_email);
        $this->email->subject($subject);
        $this->email->message($message);

        if ($this->email->send()) {
            echo 'berhasil';
        } else {
            show_error($this->email->print_debugger());
        }
    }

    function testmail(){
        $from = $this->config->item('smtp_user');
        // $from = 'PTUK';
        // $to = $this->input->post('to');
        $to = 'ewanggaarga07@gmail.com';
        // $subject = $this->input->post('subject');
        $subject = 'Pemberitahuan Permohonan SKK';
        $message = "<h1 style='text-align:center; color:grape;'>Notification !</h1><br/>
                    <img src='https://siki.pu.go.id/permohonan_sertifikasi_diproses.jpg' alt='Permohonan sedang di Proses'/><br/>
                    Kepada Yth <br/>
                    Bapak/Ibu <br/><br/>

                    Terima Kasih atas kepercayaan melakukan Permohonan Sertifikasi SKK di PTUK<br/><br/>
                    Untuk Saat ini permohonan Sertifikasi SKK anda dengan Jabatan Kerja -  sedang di Proses Verifikasi dan Validasi<br/><br/>

                    Terima Kasih.                    
                    ";

        $this->email->set_newline("\r\n");
        $this->email->from($from);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);

        if ($this->email->send()) {
            return true;
        } else {
            show_error($this->email->print_debugger());
        }
    }
}