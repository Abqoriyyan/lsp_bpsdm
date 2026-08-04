<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sertifikat_model extends CI_Model
{
    private function is_valid_id_izin($id_izin)
    {
        return is_string($id_izin)
            && preg_match('/\AI-[0-9]{19}\z/D', $id_izin) === 1;
    }

    public function get_data_pencatatan($id_izin)
    {
        if (!$this->is_valid_id_izin($id_izin)) {
            return NULL;
        }

        $this->db->select('a.*, b.nama AS nama_komite, c.deskripsi as deskripsi_jenjang, c.deskripsi_en AS deskripsi_jenjang_en, d.kbli, d.kbji');
        $this->db->from('data_pencatatan_sertifikasi a');
        $this->db->join('master_komite b', 'b.user_komite = a.user_penetap', 'left');
        $this->db->join('master_jenjang_permohonan c', 'c.jenjang = a.jenjang', 'left');
        $this->db->join('master_jabatan_kerja d', 'd.id_jabatan_kerja = a.id_jabatan_kerja', 'left');
        $this->db->where('a.id_izin', $id_izin);
        $this->db->limit(1);

        return $this->db->get()->row();
    }

    public function get_data_personal_permohonan($id_izin)
    {
        if (!$this->is_valid_id_izin($id_izin)) {
            return NULL;
        }

        $this->db->select('*');
        $this->db->from('data_personal_permohonan');
        $this->db->where('id_izin', $id_izin);
        $this->db->limit(1);

        return $this->db->get()->row();
    }
}