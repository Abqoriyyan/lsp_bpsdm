<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Tuk extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url','html','file','form','security'));
		$this->load->library(array('form_validation'));
		## GET Model Admin Model
		$this->load->model('master_model');
		## GET Model Admin Model
	}
	
	public function index()
	{
		##/Cek Session Login##
		if (!$this->ion_auth->ceklogin()){
			redirect('login','refresh');
		}else if($this->session->userdata('level') !== 'Tuk'){
			redirect('login/keluar','refresh');
		}
		##/Cek Session Login##


		$this->data=array(
			'username'=>$this->session->userdata('username'),
			'level'=>$this->session->userdata('level'),
		);
		$this->template->load('menu','Tuk/dashboard', $this->data);
	}

	public function materi_uji_skema(){
		##/Cek Session Login##
		if (!$this->ion_auth->ceklogin()){
			redirect('login','refresh');
		}else if($this->session->userdata('level') !== 'Tuk'){
			redirect('login/keluar','refresh');
		}
		##/Cek Session Login##
		$get_master_jabatan_kerja = $this->master_model->get_master_jabatan_kerja();

		$this->data=array(
			'username'=>$this->session->userdata('username'),
			'level'=>$this->session->userdata('level'),
			'get_master_jabatan_kerja'=>$get_master_jabatan_kerja,
		);
		$this->template->load('menu','Tuk/materi_uji_skema', $this->data);
	}

}