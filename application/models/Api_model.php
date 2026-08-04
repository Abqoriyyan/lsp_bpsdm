<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Api_model extends CI_Model
{   

    public function get_token(){
        $this->db->select('*');
        $this->db->from('master_api');
        $query = $this->db->get();
        return $query->row();
    }

    public function get_token_bnsp(){
        $this->db->select('*');
        $this->db->from('master_api_bnsp');
        $query = $this->db->get();
        return $query->row();
    }

    #Function Update Data
    public function update_data($data,$table){
        $this->db->update($table,$data);
    }
}
?>