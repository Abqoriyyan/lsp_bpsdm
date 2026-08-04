<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Report_model extends CI_Model
{
    ###################### Admin ########################
    public function info_data_permohonan($id_izin){
        $this->db->select('f.*, a.jabatan_kerja, a.kualifikasi, b.kualifikasi AS deskripsi_kualifikasi,a.subklasifikasi, e.subklasifikasi as deskripsi_subklasifikasi,a.jenjang, a.jabatan_kerja,c.jabatan_kerja AS deskripsi_jabatan_kerja, a.jenjang,d.deskripsi as deskripsi_jenis_permohonan');
        $this->db->from('data_klasifikasi_kualifikasi_permohonan a');
        $this->db->join('master_kualifikasi b', 'a.kualifikasi = b.id');
        $this->db->join('master_jabatan_kerja c', 'a.jabatan_kerja = c.id_jabatan_kerja');
        $this->db->join('master_jenis_permohonan d', 'a.jenis_permohonan = d.id');
        $this->db->join('master_subklasifikasi e', 'a.subklasifikasi = e.kode_subklasifikasi');
        $this->db->join('data_personal_permohonan f', 'f.id_izin = a.id_izin');
        $this->db->where('a.id_izin',$id_izin);
        $query = $this->db->get();
        return $query->row();
    }

    # Dashboard Admin
    public function report_dashboard_admin(){
        $sql="SELECT 
            (SELECT COUNT(*) FROM history_permohonan WHERE LOG IN (SELECT MAX(LOG) FROM history_permohonan GROUP BY id_izin) AND kode_status = '20') AS tinjau_permohonan,
            (SELECT COUNT(*) FROM history_permohonan WHERE LOG IN (SELECT MAX(LOG) FROM history_permohonan GROUP BY id_izin) AND kode_status = '30') AS invoice_ditagihkan,
            (SELECT COUNT(*) FROM history_permohonan a LEFT JOIN data_penunjukan_asesor b ON b.id_izin = a.id_izin WHERE a.LOG IN (SELECT MAX(LOG) FROM history_permohonan GROUP BY id_izin) AND kode_status = '31' AND b.id_izin IS NULL) AS belum_penunjukan_asesor,
            (SELECT COUNT(a.id_izin) FROM (SELECT a.id_izin,MAX(a.kode_status) AS kode_status FROM (SELECT id_izin,MAX(kode_status)AS kode_status FROM history_permohonan GROUP BY id_izin HAVING kode_status = '31') a JOIN (SELECT * FROM data_penunjukan_asesor)b ON b.id_izin = a.id_izin GROUP BY a.id_izin) a) AS asesmen,
            (SELECT COUNT(*) FROM history_permohonan a LEFT JOIN data_hasil_penetapan_komite_teknis b ON b.id_izin = a.id_izin JOIN data_rekomendasi_asesor c ON c.id_izin = a.id_izin WHERE a.LOG IN (SELECT MAX(LOG) FROM history_permohonan GROUP BY id_izin) AND kode_status = '31' AND b.id_izin IS NULL) AS penetapan_komite,
            (SELECT COUNT(a.id_izin) FROM history_permohonan a JOIN data_hasil_penetapan_komite_teknis b ON b.id_izin = a.id_izin LEFT JOIN data_pencatatan_sertifikasi c ON c.id_izin = a.id_izin WHERE a.LOG IN (SELECT MAX(LOG) FROM history_permohonan a GROUP BY a.id_izin ) AND kode_status = '31' AND qr = 'Menunggu Approve BNSP') AS quality_check,
            (SELECT COUNT(*) FROM history_permohonan WHERE LOG IN (SELECT MAX(LOG) FROM history_permohonan GROUP BY id_izin) AND kode_status = '50') AS sertifikat_terbit";    
            
        $query = $this->db->query($sql);
        return $query->row();
    }

    ###################### Admin ########################

    public function data_apl01_permohonan(){
        $this->db->select('*');
        $this->db->from('data_apl01_permohonan');

        $query = $this->db->get();
        return $query->result_array();
    }

    #Function Update Data
    public function update_data($where,$data,$table){
        $this->db->where($where);
        $this->db->update($table,$data);
    }
}