<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Master_model extends CI_Model
{
    public function get_data_tinjau_permohonan($id_izin)
    {
        $this->db->select('*');
        $this->db->from('tinjau_permohonan');
        $this->db->where('id_izin', $id_izin);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_master_propinsi()
    {
        $this->db->select('*');
        $this->db->from('master_propinsi');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_master_kabupaten()
    {
        $this->db->select('*');
        $this->db->from('master_kabupaten');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_master_klasifikasi()
    {
        $this->db->select('*');
        $this->db->from('master_klasifikasi');

        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_master_subklasifikasi()
    {
        $this->db->select('*');
        $this->db->from('master_subklasifikasi');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_master_jenjang_pendidikan()
    {
        $this->db->select('*');
        $this->db->from('master_jenjang_pendidikan');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_master_jenis_permohonan()
    {
        $this->db->select('*');
        $this->db->from('master_jenis_permohonan');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_master_persyaratan_kompeten()
    {
        $this->db->select('*');
        $this->db->from('master_persyaratan_kompeten');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_master_jabatan_kerja()
    {
        $this->db->select('*');
        $this->db->from('master_jabatan_kerja');
        $this->db->where('active', '1');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_master_unit_kompetensi()
    {
        $this->db->select('*');
        $this->db->from('master_unit_kompetensi');
        $this->db->order_by('kode_unit_kompetensi', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_master_elemen_kompetensi()
    {
        $this->db->select('*');
        $this->db->from('master_elemen_kompetensi');
        $this->db->order_by('kode_elemen_kompetensi', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_master_kriteria_unjuk_kerja()
    {
        $this->db->select('*');
        $this->db->from('master_kriteria_unjuk_kerja');
        $this->db->order_by('kode_kuk', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_master_asesor()
    {
        $this->db->select('*');
        $this->db->from('master_asesor');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_master_tuk()
    {
        $this->db->select('*');
        $this->db->from('master_tuk');

        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_master_muk()
    {
        $this->db->select('*');
        $this->db->from('master_muk');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_data_jadwal_asesmen()
    {
        $this->db->select('a.*,b.deskripsi');
        $this->db->from('data_jadwal_asesmen a');
        $this->db->join('master_status_bnsp b', 'b.id = a.status_jadwal');
        $this->db->order_by('a.tanggal_selesai', 'desc');
        $this->db->where('a.deleted_at', NULL);

        $query = $this->db->get();
        return $query->result_array();
    }

    public function master_bnsp_jenis_jadwal()
    {
        $this->db->select('*');
        $this->db->from('master_bnsp_jenis_jadwal');

        $query = $this->db->get();
        return $query->result_array();
    }

    public function master_bnsp_jenis_anggaran()
    {
        $this->db->select('*');
        $this->db->from('master_bnsp_jenis_anggaran');

        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_data_detail_jabker($id_data_skema_bnsp)
    {
        $this->db->select('*');
        $this->db->from('master_jabatan_kerja');
        $this->db->where('id_data_skema_bnsp', $id_data_skema_bnsp);

        $query = $this->db->get();
        return $query->row();
    }

    public function get_master_pekerjaan()
    {
        $this->db->select('*');
        $this->db->from('master_pekerjaan');

        $query = $this->db->get();
        return $query->result_array();
    }


    ####### Master JSON untuk AJAX ###########
    public function get_master_subklasifikasi_json()
    {
        $this->db->select("*");
        $this->db->from("master_subklasifikasi");

        $query = $this->db->get();
        return $query;
    }

    public function get_data_ketua_pelaksana()
    {
        $sql = "SELECT * FROM master_ketua_pelaksana
                WHERE id = (SELECT MAX(id) FROM master_ketua_pelaksana)
        ";

        $query = $this->db->query($sql);
        return $query->row();
    }


    public function get_status_terkahir($id_izin)
    {
        $sql = "SELECT * FROM history_permohonan 
        WHERE id_izin = ? 
        AND LOG = (SELECT MAX(LOG) FROM history_permohonan WHERE id_izin = ?);
    ";

        $query = $this->db->query($sql, array($id_izin, $id_izin));
        return $query->row();
    }
}