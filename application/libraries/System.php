<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class System {
	protected $CI;
	public function __construct() {
		error_reporting(0);
		ini_set('display_errors', 0);
		
		// URL mentah ke file JSON
		$url = 'https://raw.githubusercontent.com/ewanggaarga/management-lisensi-aplikasi/main/lisensi/lsp-bpsdm.json';

		// Ambil konten dari URL
		$response = file_get_contents($url);
		$this->CI =& get_instance();

        // Memuat library sesi jika belum dimuat
        if (!isset($this->CI->session)) {
            $this->CI->load->library('ion_auth');
        }

		// Periksa apakah permintaan berhasil
		if ($response === FALSE) {
			die('Error fetching data.');
		}	
		$result = json_decode($response,true);

		if($result['is_active'] == false){
			$this->CI->session->sess_destroy();
		}
    }
}
