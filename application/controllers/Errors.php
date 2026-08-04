<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Errors extends MY_Controller
{
	public function index(){
        $this->load->view('errors/index');
    }
    public function not_upload(){
        $this->load->view('errors/custom/file_not_upload');
    }

}