<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Adm extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url','html','file','form','security'));
		$this->load->library(array('form_validation','system'));
		## GET Model Admin Model
		$this->load->model('admin_model');
		$this->load->model('kas');
		$this->load->model('produk');
		## GET Model Admin Model
	}
	public function index()
	{
		##/Cek Session Login##
		if (!$this->ion_auth->ceklogin()){
			redirect('login','refresh');
		}else if($this->session->userdata('level') !== 'Admin'){
			redirect('login/keluar','refresh');
		}
		##/Cek Session Login##

		$this->data=array(
			'username'=>$this->session->userdata('username'),
			'level'=>$this->session->userdata('level'),
		);
		$this->template->load('menu','Admin/dashboard', $this->data);
	}
#--------------------------------------------------------------------------------
# Produk Management
#--------------------------------------------------------------------------------
	public function produk()
	{
		##/Cek Session Login##
		if (!$this->ion_auth->ceklogin()){
			redirect('login','refresh');
		}else if($this->session->userdata('level') !== 'Admin'){
			redirect('login/keluar','refresh');
		}
		##/Cek Session Login##	
		
		$this->data=array(
			'username'=>$this->session->userdata('username'),
			'level'=>$this->session->userdata('level'),
			'produk'=>$this->produk->select_produk(),
			// 'record'=>$this->User_model->select($username,$password)
		);
		$this->template->load('menu','Admin/produk', $this->data);
	}

	public function input_produk()
	{
		##/Cek Session Login##
		if (!$this->ion_auth->ceklogin()){
			redirect('login','refresh');
		}else if($this->session->userdata('level') !== 'Admin'){
			redirect('login/keluar','refresh');
		}
		##/Cek Session Login##	

		$this->data=array(
			'username'=>$this->session->userdata('username'),
			'level'=>$this->session->userdata('level'),
			);
		$this->template->load('menu','Admin/input_produk', $this->data);
	}

	public function add_produk()
	{
		##/Cek Session Login##
		if (!$this->ion_auth->ceklogin()){
			redirect('login','refresh');
		}else if($this->session->userdata('level') !== 'Admin'){
			redirect('login/keluar','refresh');
		}
		##/Cek Session Login##	

		$nama_produk = $this->input->post('nama_produk');
		$hpp = $this->input->post('hpp');
		$this->data=array(
			// 'username'=>$this->session->userdata('username'),
			// 'level'=>$this->session->userdata('level'),
			'nama_produk'=>$nama_produk,
			'hpp'=>$hpp,
			);
		$this->session->set_flashdata('entry_success', 'Task Berhasil Di Bentuk.');
		$this->produk->add_produk($data,'produk');
	}

#-------------------------------------------------------------------------------
# / Produk Management
#-------------------------------------------------------------------------------
#################################### Kas ###############################################
	## Redirect Page Dashboard Kas ##	
	public function kas()
	{
		##/Cek Session Login##
		if (!$this->ion_auth->ceklogin()){
			redirect('login','refresh');
		}else if($this->session->userdata('level') !== 'Admin'){
			redirect('login/keluar','refresh');
		}
		##/Cek Session Login##

		// $username=$this->session->userdata('username');
		// $password='admin';
		
		$this->data=array(
			'username'=>$this->session->userdata('username'),
			'level'=>$this->session->userdata('level'),
			'pemasukkan'=>$this->kas->pemasukkan(),
			'pengeluaran'=>$this->kas->pengeluaran(),
			'data_kas'=>$this->kas->data_kas(),
			'coa'=>$this->kas->coa(),
			// 'record'=>$this->User_model->select($username,$password)
		);
		$this->template->load('menu','Admin/kas', $this->data);
	}
	## /Redirect Page Dashboard Kas ##
	## Redirect Page Entry Kas ##
	public function page_entry_kas()
	{
			##/Cek Session Login##
			if (!$this->ion_auth->ceklogin()){
				redirect('login','refresh');
			}else if($this->session->userdata('level') !== 'Admin'){
				redirect('login/keluar','refresh');
			}
			##/Cek Session Login##


			$this->data=array(
				'username'=>$this->session->userdata('username'),
				'level'=>$this->session->userdata('level'),
				'coa'=>$this->kas->coa(),
				);
			$this->template->load('menu','Admin/page_entry_kas', $this->data);
	}
	## /Redirect Page Entry Kas ##
	## Proses Entry Kas ##
	public function entry_kas()
	{
			##/Cek Session Login##
			if (!$this->ion_auth->ceklogin()){
				redirect('login','refresh');
			}else if($this->session->userdata('level') !== 'Admin'){
				redirect('login/keluar','refresh');
			}
			##/Cek Session Login##

			$deskripsi = $this->input->post('deskripsi');
			$nominal = $this->input->post('nominal');
			$coa = $this->input->post('coa');
			$code_transaksi = $this->input->post('code_transaksi');
			$entry_at = date("Y-m-d H:i:s");

			$data = array(
				'deskripsi' => $deskripsi,
				'nominal' => $nominal,
				'code_account' => $coa,
				'code_transaksi' => $code_transaksi,
				'entry_at' => $entry_at
				);
				
			$this->session->set_flashdata('add_produk_success', 'Task Berhasil Di Bentuk.');
			$this->kas->entry_kas($data);
			redirect('adm/page_entry_kas');
	}
	## /Proses Entry Kas ##

	## Delete Data Kas ##
	public function delete_datakas($id)
	{
		##/Cek Session Login##
		if (!$this->ion_auth->ceklogin()){
			redirect('login','refresh');
		}else if($this->session->userdata('level') !== 'Admin'){
			redirect('login/keluar','refresh');
		}
		##/Cek Session Login##
		
		$id = $this->kas->delete_data_kas($id);
		redirect("adm/kas");
	}
	## /Delete Data Kas ##

	## Update Data Kas ##
	public function edit_datakas()
	{
		
	}
	## /Update Data Kas ##
#################################### /Kas ###############################################

#################################### Report ##############################################
	public function report_kas(){
		##/Cek Session Login##
		if (!$this->ion_auth->ceklogin()){
			redirect('login','refresh');
		}else if($this->session->userdata('level') !== 'Admin'){
			redirect('login/keluar','refresh');
		}
		##/Cek Session Login##
		
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');

		$this->data=array(
			'username' => $this->session->userdata('username'),
			'level' => $this->session->userdata('level'),
			'start_date' => $start_date,
			'end_date' => $end_date
			);


		$this->template->load('menu','Admin/report_kas', $this->data);


	}
#################################### /Report ############################################# 

}