<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Generate_apibnsp extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url','html','file','form','security'));
		$this->load->library(array('form_validation','email'));
		$this->load->config('email');

		// $this->load->library('../controllers/mail','mail');
		## GET Model Admin Model
		$this->load->model('api_model');
		## GET Model Admin Model
		date_default_timezone_set('Asia/Jakarta');
		$this->load->model('api_model');

	}
	public function index()
	{
        $get_data_expired = $this->api_model->get_token_bnsp();

		if($get_data_expired->expire_date <= date("Y-m-d H:i:s")){
				$token_bnsp = $this->api_model->get_token_bnsp();
			
				// API Url
				$url = $token_bnsp->host."auth";
				
				// Initiate cURL.
				$ch = curl_init($url);


				// Tell cURL that we want to send a POST request.
				curl_setopt($ch, CURLOPT_POST, 1);


				// Attach our encoded JSON string to the POST fields.
				curl_setopt($ch, CURLOPT_POSTFIELDS,'');
				// Set the content type to application/json
				curl_setopt($ch, CURLOPT_HTTPHEADER, array(
					'Content-Type: application/json',
					'x-bnsp-user: l5p-bPsdmpupr' ,
					'x-bnsp-key: l5pBP5DMPUPR2023@@'
				));

				curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

				// Execute the request
				$result = curl_exec($ch);
				$array = json_decode($result,true);
				echo $array['data']['token'];


			// Update untuk mencatatkan ke Database
			$data = array(
				'expire_date' => $array['data']['expire_date'],
				'x_authorization' => $array['data']['token']
			);
	
			$this->api_model->update_data($data,'master_api_bnsp');
		}else{
			echo 'masih aktif';
		}
	}
}
