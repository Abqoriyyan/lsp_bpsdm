<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pemohon_model extends CI_Model
{
    ############## Dashboard ################

    ############## /Dashboard ################


    # List Permohonan SKK
    public function list_permohonan_skk($nik)
    {
        $sql = "SELECT a.id_izin, d.kualifikasi, c.klasifikasi, c.subklasifikasi, c.jabatan_kerja, c.asosiasi, b.kode_status 
        FROM data_personal_permohonan a 
        JOIN ( SELECT * FROM history_permohonan WHERE LOG IN (SELECT MAX(LOG) FROM history_permohonan WHERE kode_status GROUP BY id_izin)) b ON b.id_izin = a.id_izin 
        JOIN data_klasifikasi_kualifikasi_permohonan c ON c.id_izin = a.id_izin 
        JOIN master_kualifikasi d ON c.kualifikasi = d.id 
        WHERE a.nik = ? AND b.kode_status NOT IN ('50','90') 
        GROUP BY a.id_izin, d.kualifikasi, c.klasifikasi, c.subklasifikasi, c.jabatan_kerja, c.asosiasi, b.kode_status";

        $query = $this->db->query($sql, array($nik));
        return $query->result_array();
    }

    ## Get Hasil Tinjau Permohonan ##
    public function get_data_apl01($id_izin)
    {
        $this->db->select('*');
        $this->db->from('data_apl01_permohonan');
        $this->db->where('id_izin', $id_izin);
        $query = $this->db->get();
        return $query->row();
        // return $query->result_array();
    }

    ## Get data_personal_permohonan / administrasi
    public function get_data_personal_permohonan($id_izin)
    {
        $this->db->select('*');
        $this->db->from('data_personal_permohonan');
        $this->db->where('id_izin', $id_izin);
        $query = $this->db->get();
        return $query->row();
    }

    ## Get data_pendidikan_permohonan
    public function get_data_pendidikan_permohonan($id_izin)
    {
        $this->db->select('b.deskripsi AS deskripsi_jenjang, a.*');
        $this->db->from('data_pendidikan_permohonan a');
        $this->db->join('master_jenjang_pendidikan b', 'a.jenjang = b.id_jenjang');
        $this->db->where('a.id_izin', $id_izin);
        $query = $this->db->get();
        return $query->result_array();
    }

    ## Get data_pendidikan_yang_sudah_dipilih
    public function data_pendidikan_yang_sudah_dipilih($id_izin)
    {
        $this->db->select('*');
        $this->db->from('tinjau_permohonan');
        $this->db->where('id_izin', $id_izin);
        $this->db->where('item_tinjau_permohonan', '2');

        $query = $this->db->get();
        return $query->row();
    }

    #Get Data Unit Kompetensi
    public function get_data_unit_kompetensi($id_izin)
    {
        $this->db->select('b.*,c.acuan as skkni,b.deskripsi as judul_unit_kompetensi');
        $this->db->from('data_klasifikasi_kualifikasi_permohonan a');
        $this->db->join('master_unit_kompetensi b', 'a.jabatan_kerja = b.kode_jabker', 'right');
        $this->db->join('master_jabatan_kerja c', 'a.jabatan_kerja = c.id_jabatan_kerja', 'left');
        $this->db->where('id_izin', $id_izin);

        $query = $this->db->get();
        return $query->result_array();
    }

    #Get Data Pendidikan Yang Sesuai
    public function get_data_pendidikan_yang_sesuai($id_izin)
    {
        $this->db->select('jenjang_yang_sesuai');
        $this->db->from('tinjau_permohonan');

        $multiClause = array('id_izin' => $id_izin, 'item_tinjau_permohonan' => '2');
        $this->db->where($multiClause);
        $query = $this->db->get();
        return $query->row();
    }

    #Get Data Klasifikasi Kualifikasi
    public function get_data_klasifikasi_kualifikasi($id_izin)
    {
        $this->db->select('a.*,b.jabatan_kerja as deskripsi_jabatan_kerja,b.acuan');
        $this->db->from('data_klasifikasi_kualifikasi_permohonan a');
        $this->db->where('a.id_izin', $id_izin);
        $this->db->join('master_jabatan_kerja b', 'a.jabatan_kerja = b.id_jabatan_kerja');

        $query = $this->db->get();
        return $query->row();
    }

    #Function Update Data
    public function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
    ####################### Model APL 01 #######################  


    ####################### /Model APL 01 ######################   

    ####################### Model APL 02 #######################
    #Get Data APL 02
    public function get_data_apl02($id_izin)
    {
        $this->db->select('*');
        $this->db->from('data_apl02_permohonan');
        $this->db->where('id_izin', $id_izin);

        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_bukti_relavan_apl02($id_izin)
    {
        $this->db->select("*");
        $this->db->from('bukti_relavan_apl02_permohonan');
        $this->db->where('id_izin', $id_izin);

        $query = $this->db->get();
        return $query->result_array();
    }
    ####################### /Model APL 02 #######################
###################### Pra-Asesment ###############################
    # For Log History Permohonan
    public function insert_log_history_permohonan($data = array())
    {
        $insert = $this->db->insert('history_permohonan', $data);
        return true;
    }
    ###################### /Pra-Asesment ###############################
}
?>