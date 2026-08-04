<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Audit extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url','html','file','form','security'));
		$this->load->library(array('form_validation','email','pdfgenerator','ciqrcode','system'));
		$this->load->config('email');

		// $this->load->library('../controllers/mail','mail');
		## GET Model Admin Model
		$this->load->model('master_model');
		$this->load->model('asesor_model');
		$this->load->model('api_model');
		$this->load->model('komite_model');
		$this->load->model('admin_model');
		## GET Model Admin Model
		date_default_timezone_set('Asia/Jakarta');
	}

    public function index(){
        ##/Cek Session Login##
		if (!$this->ion_auth->ceklogin()){
			redirect('login','refresh');
		}else if($this->session->userdata('level') !== 'Audit'){
			redirect('login/keluar','refresh');
		}
		##/Cek Session Login##

        $this->data=array(
			'username' => $this->session->userdata('username'),
			'level' => $this->session->userdata('level'),
		);
		$this->template->load('menu','Audit/dashboard', $this->data);
    }

    public function berkas_asesmen($id_izin){
        ##/Cek Session Login##
		if (!$this->ion_auth->ceklogin()){
			redirect('login','refresh');
		}else if($this->session->userdata('level') !== 'Audit'){
			redirect('login/keluar','refresh');
		}
		##/Cek Session Login##
		$id_izin = base64_decode($id_izin);

		error_reporting(E_ALL);
ini_set('display_errors', 1);

        # Get Data Detail Pemohon
		$info_data_permohonan = $this->admin_model->info_data_permohonan($id_izin);
		$get_data_personal_permohonan = $this->komite_model->get_data_personal_permohonan($id_izin);
		$get_data_pendidikan_permohonan = $this->komite_model->get_data_pendidikan_permohonan($id_izin);
		$get_data_proyek_permohonan = $this->komite_model->get_data_proyek_permohonan($id_izin);
		$get_data_pelatihan_permohonan = $this->komite_model->get_data_pelatihan_permohonan($id_izin);
		$get_data_klasifikasi_kualifikasi_permohonan = $this->komite_model->get_data_klasifikasi_kualifikasi_permohonan($id_izin);
		$get_bukti_dokumentasi_asesmen = $this->asesor_model->get_bukti_dokumentasi_asesmen($id_izin);


		#Get Data Rekomendasi Asesor
		$get_data_rekomendasi_asesor = $this->komite_model->get_data_rekomendasi_asesor($id_izin);
		$get_data_hasil_asesmen = $this->komite_model->get_data_hasil_asesmen($id_izin);

		$this->data=array(
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
			'get_data_hasil_asesmen' => $get_data_hasil_asesmen,
			'get_bukti_dokumentasi_asesmen' => $get_bukti_dokumentasi_asesmen,
		);
		$this->template->load('menu','Audit/berkas_asesmen', $this->data);

    }
}