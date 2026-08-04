<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		error_reporting(0);
		ini_set('display_errors', 0);

		// URL mentah ke file JSON
		$url = 'https://raw.githubusercontent.com/ewanggaarga/management-lisensi-aplikasi/main/lisensi/lsp-bpsdm.json';

		// Ambil konten dari URL
		$response = file_get_contents($url);

		// Periksa apakah permintaan berhasil
		if ($response === FALSE) {
			die('Error fetching data.');
		}
		$result = json_decode($response, true);

		if ($result['is_active'] == false) {
			$this->session->sess_destroy();
		}
	}

}
