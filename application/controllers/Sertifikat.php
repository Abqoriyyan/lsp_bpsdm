<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Sertifikat extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url', 'html', 'file', 'form', 'security'));
		$this->load->library(array('form_validation', 'email', 'pdfgenerator', 'system'));
		$this->load->config('email');


		// $this->load->library('../controllers/mail','mail');
		## GET Model Admin Model
		$this->load->model('master_model');
		$this->load->model('asesor_model');
		$this->load->model('api_model');
		$this->load->model('komite_model');
		$this->load->model('admin_model');
		$this->load->model('sertifikat_model');
		## GET Model Admin Model
		date_default_timezone_set('Asia/Jakarta');
	}

	/**
	 * Decode the legacy public certificate identifier safely.
	 *
	 * Base64 is only an encoding. Security is provided here by strict,
	 * canonical decoding and validation of the actual id_izin format.
	 * Invalid input is rejected instead of being cleaned or interpolated.
	 *
	 * @param mixed $encoded_id_izin
	 * @return string
	 */
	private function decode_id_izin_or_404($encoded_id_izin)
	{
		// Existing id_izin values are exactly: I- followed by 19 digits.
		// Their canonical Base64 representation is 28 alphanumeric bytes.
		if (
			!is_string($encoded_id_izin)
			|| strlen($encoded_id_izin) !== 28
			|| preg_match('/\A[A-Za-z0-9]{28}\z/D', $encoded_id_izin) !== 1
		) {
			show_404('', FALSE);
		}

		$id_izin = base64_decode($encoded_id_izin, TRUE);

		if (
			$id_izin === FALSE
			|| base64_encode($id_izin) !== $encoded_id_izin
			|| preg_match('/\AI-[0-9]{19}\z/D', $id_izin) !== 1
		) {
			show_404('', FALSE);
		}

		return $id_izin;
	}

	public function file_sertifikat($encoded_id_izin = NULL)
	{
		$id_izin = $this->decode_id_izin_or_404($encoded_id_izin);

		// These model calls use CodeIgniter Query Builder, which escapes
		// the value as data instead of concatenating it into SQL.
		$get_data_pencatatan = $this->sertifikat_model->get_data_pencatatan($id_izin);
		$get_data_personal_permohonan = $this->sertifikat_model->get_data_personal_permohonan($id_izin);

		if ($get_data_pencatatan === NULL || $get_data_personal_permohonan === NULL) {
			show_404('', FALSE);
		}

		$data_lsp = $this->api_model->get_token();

		$data = array(
			'get_data_pencatatan' => $get_data_pencatatan,
			'get_data_personal_permohonan' => $get_data_personal_permohonan,
			'data_lsp' => $data_lsp,
			'id_izin' => $id_izin,
		);

		$this->load->view('Sertifikat/cetak_sertifikat', $data);
	}

	public function validasi_signature($encoded_id_izin = NULL)
	{
		$id_izin = $this->decode_id_izin_or_404($encoded_id_izin);
		$get_data_pencatatan = $this->sertifikat_model->get_data_pencatatan($id_izin);

		if ($get_data_pencatatan === NULL) {
			show_404('', FALSE);
		}

		$data_lsp = $this->api_model->get_token();

		$data = array(
			'data_lsp' => $data_lsp,
			'get_data_pencatatan' => $get_data_pencatatan,
		);

		$this->load->view('Sertifikat/validasi_signature', $data);
	}
}