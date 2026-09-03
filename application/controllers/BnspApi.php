<?php
if (count(get_included_files()) == 1)
	exit("Direct access tidak diijinkan.");
class BnspApi
{
	protected $_phpsess = "/tmp/phpsess";
	protected $_urlbnspapi = "https://konstruksi.bnsp.go.id/api/v1/";
	protected $_urlbnsp = "https://konstruksi.bnsp.go.id/";
	protected $_publiktoken = null;
	protected $_privatetoken = null;
	protected $_jenisapi = 1;

	protected static $_instance = null;
	protected function __construct()
	{
		$this->_publiktoken = getenv('BNSP_PUBLIC_TOKEN');
		$this->_privatetoken = getenv('BNSP_PRIVATE_TOKEN');

		if (!$this->_publiktoken || !$this->_privatetoken) {
			log_message('error', 'BNSP API Tokens are missing in .env file.');
		}
	}

	public static function getInstance()
	{
		if (null === self::$_instance) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function curl($lib, $post = array())
	{
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_COOKIEJAR, $this->_phpsess);
		curl_setopt($ch, CURLOPT_COOKIEFILE, $this->_phpsess);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/114.0.0.0 Safari/537.36');
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
		curl_setopt($ch, CURLOPT_CAINFO, APPPATH . 'libraries/cacert.pem');

		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL, $this->_urlbnspapi . $lib);

		if (!empty($post)) {
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
		}

		$hasilurl = curl_exec($ch);

		if (curl_errno($ch)) {
			$error_msg = curl_error($ch);
			log_message('error', 'CURL Error: ' . $error_msg);
			$hasilurl = json_encode(['error' => true, 'message' => 'Koneksi ke API gagal.']);
		}

		curl_close($ch);
		return $hasilurl;
	}

	public function auth()
	{

		if ($this->_jenisapi == 1) {
			$data = array(
				"jenis" => $this->_jenisapi,
				"token" => $this->_publiktoken
			);

			$hasil = $this->curl("reqauth", $data);
			return $hasil;
		}
	}

	public function postapi($lib, $data = array())
	{
		$hasil = $this->curl($lib, $data);

		$datareturn = json_encode(array("status" => 99, "pesan" => "Terjadi kesalahan"), true);
		$ulang = TRUE;
		$jumlahcoba = 0;
		while ($ulang) {
			$arrdata = json_decode($hasil, true);
			if ($jumlahcoba > 5) {
				$datareturn = json_encode(array("status" => 98, "pesan" => "Time out"), true);
				$ulang = FALSE;
			}

			if (isset($arrdata['status'])) {
				if ($arrdata['status'] == 100) {
					$hasil = $this->auth();
				}

				if ($arrdata['status'] == 0) {
					$datareturn = json_encode($hasil, true);
					$ulang = FALSE;
				}

				if ($arrdata['status'] == 1) {
					$hasil = $this->curl($lib, $data);
				}

				if ($arrdata['status'] == 2) {
					$datareturn = json_encode($arrdata['data']);
					$ulang = FALSE;
				}

				if ($arrdata['status'] > 90) {
					$datareturn = json_encode($hasil, true);
					$ulang = FALSE;
				}
			}
			$jumlahcoba++;
		}
		return $datareturn;
	}
}
