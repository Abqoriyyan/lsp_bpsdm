<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods:GET,OPTIONS");
class Pembayaran extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */


	public function __construct()
    {
        parent::__construct();
        $params = array('server_key' => 'SB-Mid-server-53Lh3rQyQXouQ2D1UK8DUfQ4', 'production' => false);
		$this->load->library(array('form_validation','email','midtrans','system'));
		$this->midtrans->config($params);
		$this->load->helper('url');
        $this->load->model('pembayaran_model');
		$this->load->model('api_model');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function checkout($id_izin)
    {
        $id_izin = base64_decode($id_izin);
        $data_pembayaran_permohonan = $this->pembayaran_model->get_data_pembayaran($id_izin);
		$get_status_pembayaran = $this->pembayaran_model->get_status_pembayaran($id_izin);
		$get_data_surat_perjanjian_sertifikat = $this->pembayaran_model->get_data_surat_perjanjian_sertifikat($id_izin);

		//Get Metode Pembayaran
		$token = $this->api_model->get_token();
		$metode_pembayaran = $token->metode_pembayaran;

        $data = array(
            'id_izin' => $id_izin,
            'data_pembayaran_permohonan' => $data_pembayaran_permohonan,
			'get_status_pembayaran' => $get_status_pembayaran,
			'get_data_surat_perjanjian_sertifikat' => $get_data_surat_perjanjian_sertifikat,
			'metode_pembayaran' => $metode_pembayaran,
        );
    	$this->load->view('Admin/pembayaran/checkout_pembayaran',$data);
    }

	////////////////// Untuk Jenis Pembayaran Manual /////////////////////
	public function upload_bukti_pembayaran($id_izin){
		$id_izin = base64_decode($id_izin);
		$log = date("Y-m-d H:i:s");

		# Upload File Surat Perjanjian Sertifikasi #
		//config upload
		$file_name = "bukti_pembayaran_biaya_sertifikasi-"."_".base64_encode($id_izin)."-". date("Y-m-d");
		$config['upload_path']          = FCPATH.'uploads/file_permohonan/bukti_pembayaran_biaya_sertifikasi/';
		$config['allowed_types']        = 'pdf|png|jpg|jpeg|JPG';
		$config['file_name']            = $file_name;
		$config['overwrite']            = true;
		$config['max_size']             = 10240; // 10MB

		$this->load->library('upload',$config);
		$this->upload->initialize($config);
		// if($this->upload->do_upload("bukti_pembayaran")){
			$file_bukti_pembayaran = $this->upload->data();
			$filename_bukti_pembayaran = $file_bukti_pembayaran['file_name'];

			$data = array(
				'id_izin' => $id_izin,
				'order_id' => NULL,
				'gross_amount' => $this->input->post('biaya'),
				'payment_type' => 'upload',
				'transaction_time' => $log,
				'bank' => NULL,
				'va_number' => NULL,
				'bill_key' => NULL,
				'biller_code' => NULL,
				'pdf_url' => NULL,
				// 'bukti_pembayaran' => $filename_bukti_pembayaran,
				'bukti_pembayaran' => "Gratis",
				'status_code' => '201',
			);
			//Insert Data Pembayaran
			$this->db->replace('data_pembayaran_permohonan',$data);
			$this->session->set_flashdata('success_bukti_pembayaran','Berhasil Mengupload Bukti Pembayaran');
		// }else{
		// 	$this->session->set_flashdata('gagal_bukti_pembayaran','Gagal Upload File Size Terlalu Besar dari 10 Mb');
		// }
		
		header("location:".base_url('pembayaran/checkout/').base64_encode($id_izin));
	}

	public function konfrimasi_pembayaran_manual($id_izin){
		$log = date("Y-m-d H:i:s");

		// Update Data
		$data = [
			'status_code' => '200',
		];

		// Where
		$id_izin = base64_decode($id_izin);
			$this->db->update("data_pembayaran_permohonan",$data,array('id_izin' => $id_izin));

		// Insert Log History Permohonan Status 31 Konfirmasi Pembayaran
		$id_izin = $id_izin;
		$data_tinjau['id_izin'] = $id_izin;
		$data_tinjau['kode_status'] = "31";
		$data_tinjau['log'] = date("Y-m-d H:i:s");
		$data_tinjau['username'] = $this->session->userdata('username');
		$this->pembayaran_model->insert_log_history_permohonan($data_tinjau);

		
		/////////////////////// Hit Status ke API SIKI & PORTAL ///////////////
			//API Url
			$token = $this->api_model->get_token();
			$url = $token->host . '/siki-api/v1/permohonan-skk/'.$id_izin;

			//Initiate cURL.
			$ch = curl_init($url);

			//The JSON data.
			$jsonData = array(
				'kd_status' => '31',
				'keterangan' => 'Konfirmasi Pembayaran'
			);

			//Encode the array into JSON.
			$jsonDataEncoded = json_encode($jsonData);

			//Tell cURL that we want to send a POST request.
			curl_setopt($ch, CURLOPT_POST, 1);
			//Attach our encoded JSON string to the POST fields.
			curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
			//Set the content type to application/json
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','token: '.$token->token));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			//Execute the request to array
			$arr = json_decode(curl_exec($ch), true);

			$log_hit_status_siki_portal['id_izin'] = $id_izin;
			$log_hit_status_siki_portal['status'] = $arr['status'];
			$log_hit_status_siki_portal['message'] = $arr['message'];
			$log_hit_status_siki_portal['log'] = $log;

			$this->db->insert('log_hit_status_permohonan_siki_portal', $log_hit_status_siki_portal);
			///////////////////// / Hit Status ke API SIKI & PORTAL ///////////////	
		
		header("location:".base_url('admin/list_tagihan_pembayaran'));
	}
	////////////////// Untuk Jenis Pembayaran Manual /////////////////////






	public function upload_surat_perjanjian_sertifikasi($id_izin){
		$id_izin = base64_decode($id_izin);
		$log = date("Y-m-d H:i:s");

		# Upload File Surat Perjanjian Sertifikasi #
		//config upload
		$comb = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$shfl = str_shuffle($comb);
		$filename_unik_karakter = SUBSTR($shfl,0,10);

		$file_name = "surat_perjanjian_sertifikasi-".$id_izin."_".md5($id_izin.$filename_unik_karakter)."-". date("Y-m-d");
		$config['upload_path']          = FCPATH.'uploads/file_permohonan/surat_perjanjian_sertifikat/';
		$config['allowed_types']        = 'pdf';
		$config['file_name']            = $file_name;
		$config['overwrite']            = true;
		$config['max_size']             = 5120; // 10MB

		$this->load->library('upload',$config);
		$this->upload->initialize($config);
		if($this->upload->do_upload("surat_perjanjian_sertifikasi")){
			$file_surat_perjanjian = $this->upload->data();
			$filename_surat_perjanjian = $file_surat_perjanjian['file_name'];
			
			// Insert Data Bukti Relavan
			$data_surat_perjanjian['id_izin'] = $id_izin;
			$data_surat_perjanjian['file'] = $filename_surat_perjanjian;
			$data_surat_perjanjian['log'] = $log;
			$this->db->insert('data_surat_perjanjian_sertifikat', $data_surat_perjanjian);

			$this->session->set_flashdata('success','Berhasil Mengupload Surat Perjanjian Sertifikasi');
		}else{
			$this->session->set_flashdata('gagal','Gagal Upload File Size Terlalu Besar dari 10 Mb');
		}
		header("location:".base_url('pembayaran/checkout/').base64_encode($id_izin));
	}

    public function token()
    {

        $biaya = $this->input->post('biaya');

		// Required
		$transaction_details = array(
		  'order_id' => rand().date('dmyhis'),
		  'gross_amount' => $biaya, // no decimal allowed for creditcard
		//   'gross_amount' => '10000', // no decimal allowed for creditcard
		);


        $nama_item = $this->input->post('jabatan_kerja') . ' - ' . $this->input->post('kualifikasi');
		// Optional
		$item1_details = array(
		  'id' => 'SKK-'.$nama_item,
		  'price' => $biaya,
		//   'price' => '10000',
		  'quantity' => 1,
		  'name' => $nama_item
		);

		// // Optional
		// $item2_details = array(
		//   'id' => 'a2',
		//   'price' => 20000,
		//   'quantity' => 2,
		//   'name' => "Orange"
		// );

		// Optional
		// $item_details = array ($item1_details, $item2_details);
		$item_details = array ($item1_details);

		// // Optional
		// $billing_address = array(
		//   'first_name'    => "Andri",
		//   'last_name'     => "Litani",
		//   'address'       => "Mangga 20",
		//   'city'          => "Jakarta",
		//   'postal_code'   => "16602",
		//   'phone'         => "081122334455",
		//   'country_code'  => 'IDN'
		// );

		// // Optional
		// $shipping_address = array(
		//   'first_name'    => "",
		//   'last_name'     => "",
		//   'address'       => "",
		//   'city'          => "",
		//   'postal_code'   => "",
		//   'phone'         => "",
		//   'country_code'  => ''
		// );


        $nama = $this->input->post('nama');
        $email = $this->input->post('email');
        $telepon = $this->input->post('telepon');
		// Optional
		$customer_details = array(
		  'first_name'    => $nama,
		  'email'         => $email,
		  'phone'         => $telepon,
		//   'billing_address'  => $billing_address,
		//   'shipping_address' => $shipping_address
		);

		// Data yang akan dikirim untuk request redirect_url.
        $credit_card['secure'] = true;
        //ser save_card true to enable oneclick or 2click
        //$credit_card['save_card'] = true;

        $time = time();
        $custom_expiry = array(
            'start_time' => date("Y-m-d H:i:s O",$time),
            'unit' => 'day', //day,minute
            'duration'  => 9
        );

        $transaction_data = array(
            'transaction_details'=> $transaction_details,
            'item_details'       => $item_details,
            'customer_details'   => $customer_details,
            'credit_card'        => $credit_card,
            'expiry'             => $custom_expiry
        );

		error_log(json_encode($transaction_data));
		$snapToken = $this->midtrans->getSnapToken($transaction_data);
		error_log($snapToken);
		echo $snapToken;
    }

    public function finish($id_izin)
    {
		$id_izin = base64_decode($id_izin);
    	$result = json_decode($this->input->post('result_data'),true);

		if($result['va_numbers']){
			$vax=$result['va_numbers'];
			$va_bank=$vax[0]['bank'];
			$va_number=$vax[0]['va_number'];
		}else if($result['permata_va_number']){
			$va_bank="permata";
			$va_number=$result['permata_va_number'];
		}else{
			$va_bank=NULL;
			$va_number=NULL;
		}
		if($result['bill_key']){
			$bill_key=$result['bill_key'];
			$biller_code=$result['biller_code'];
		}else{
			$bill_key=NULL;
			$biller_code=NULL;
		}

		$data = array(
			'id_izin' => $id_izin,
			'order_id' => $result['order_id'],
			'gross_amount' => number_format($result['gross_amount'], '0', '', ''),
			'payment_type' => $result['payment_type'],
			'transaction_time' => $result['transaction_time'],
			'bank' => $va_bank,
			'va_number' => $va_number,
			'bill_key' => $bill_key,
			'biller_code' => $biller_code,
			'pdf_url' => $result['pdf_url'],
			'bukti_pembayaran' => NULL,
			'status_code' => $result['status_code'],
		);
		//Insert Data Pembayaran
		$this->db->replace('data_pembayaran_permohonan',$data);

		// echo $this->input->post('result_data');

		header("location:".base_url('pembayaran/checkout/').base64_encode($id_izin));
    }

	public function notification(){
		$json_result = file_get_contents('php://input');
		$result = json_decode($json_result,"true");
		$log = date("Y-m-d H:i:s");

		// Update Data
		$data = [
			'status_code' => $result['status_code'],
		];

		// Where
		$order_id = $result['order_id'];
		if($result['status_code'] == 200){
			$this->db->update("data_pembayaran_permohonan",$data,array('order_id' => $order_id));
		}

		// Insert Log History Permohonan Status 31 Konfirmasi Pembayaran
		$get_data_pembayran_by_orderid = $this->pembayaran_model->get_data_pembayran_by_orderid($order_id);

		$id_izin = $get_data_pembayran_by_orderid->id_izin;
		$data_tinjau['id_izin'] = $id_izin;
		$data_tinjau['kode_status'] = "31";
		$data_tinjau['log'] = date("Y-m-d H:i:s");
		$data_tinjau['username'] =  'midtrans';
		$this->pembayaran_model->insert_log_history_permohonan($data_tinjau);

		
		/////////////////////// Hit Status ke API SIKI & PORTAL ///////////////
			//API Url
			$token = $this->api_model->get_token();
			$url = $token->host . '/siki-api/v1/permohonan-skk/'.$id_izin;

			//Initiate cURL.
			$ch = curl_init($url);

			//The JSON data.
			$jsonData = array(
				'kd_status' => '31',
				'keterangan' => 'Konfirmasi Pembayaran'
			);

			//Encode the array into JSON.
			$jsonDataEncoded = json_encode($jsonData);

			//Tell cURL that we want to send a POST request.
			curl_setopt($ch, CURLOPT_POST, 1);
			//Attach our encoded JSON string to the POST fields.
			curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);
			//Set the content type to application/json
			curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','token: '.$token->token));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
			//Execute the request to array
			$arr = json_decode(curl_exec($ch), true);

			$log_hit_status_siki_portal['id_izin'] = $id_izin;
			$log_hit_status_siki_portal['status'] = $arr['status'];
			$log_hit_status_siki_portal['message'] = $arr['message'];
			$log_hit_status_siki_portal['log'] = $log;

			$this->db->insert('log_hit_status_permohonan_siki_portal', $log_hit_status_siki_portal);
			/////////////////////// / Hit Status ke API SIKI & PORTAL ///////////////	
	}
}
