<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Asosiasi_bu extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url','html','file','form','security'));
		$this->load->library(array('form_validation','system'));
		## GET Model Admin Model
		$this->load->model('asosiasi_model');
		## GET Model Admin Model
	}
	public function index()
	{
        if (!$this->ion_auth->ceklogin()){
			redirect('login','refresh');
		 }

		// $username=$this->session->userdata('username');
		// $password='admin';
		 
		$this->data=array(
			'username'=>$this->session->userdata('username'),
			'level'=>$this->session->userdata('level'),
			'gettasks'=>$data['gettasks']=$this->asosiasi_model->get_task(),
		);
		$this->template->load('menu','BU/Asosiasi/dashboard', $this->data);
	}
}