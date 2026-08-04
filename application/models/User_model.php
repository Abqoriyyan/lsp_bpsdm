<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{
    public function login($username,$password){
        $this->db->select('username','level','email');
        $this->db->from('user_login');
        $this->db->where('username',$username);
        $this->db->where('password',$password);

        $query = $this->db->get();
        if($query->num_rows() === 1){
            return TRUE;
        }else{
            return FALSE;
        }

    }

    public function select($username,$password){
        $this->db->select('username,user_level,email,status,nik');
        $this->db->from('user_login');
        $this->db->where('username',$username);
        $this->db->where('password',$password);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_data_user($username){
        $this->db->select('*');
        $this->db->from('user_login');
        $this->db->where('username',$username);
        $query = $this->db->get();
        return $query->row();
    }

    public function update_data($where,$data,$table){
        $this->db->where($where);
        $this->db->update($table,$data);
    }
}
?>