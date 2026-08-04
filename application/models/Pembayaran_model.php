<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pembayaran_model extends CI_Model
{
    public function get_data_pembayaran($id_izin)
    {
        $sql = "SELECT a.nama,a.email,a.telepon, b.jabatan_kerja,e.jabatan_kerja AS deskripsi_jabatan_kerja, c.kualifikasi, 
                        f.klasifikasi, g.subklasifikasi, d.deskripsi AS jenis_permohonan, b.jenjang, h.biaya
                FROM data_personal_permohonan a 
                JOIN data_klasifikasi_kualifikasi_permohonan b ON a.id_izin = b.id_izin
                JOIN master_kualifikasi c ON c.id = b.kualifikasi
                JOIN master_jenis_permohonan d ON d.id = b.jenis_permohonan
                JOIN master_jabatan_kerja e ON e.id_jabatan_kerja = b.jabatan_kerja
                JOIN master_klasifikasi f ON f.id_klasifikasi = b.klasifikasi
                JOIN master_subklasifikasi g ON g.kode_subklasifikasi = b.subklasifikasi
                JOIN master_biaya_permohonan h ON h.jenjang = b.jenjang
                WHERE a.id_izin = ? AND h.jenis_permohonan = 'Baru'";

        $query = $this->db->query($sql, array($id_izin));
        return $query->row();
    }
    public function get_status_pembayaran($id_izin)
    {
        $this->db->select('*');
        $this->db->from('data_pembayaran_permohonan');
        $this->db->where('id_izin', $id_izin);

        $query = $this->db->get();
        return $query->row();
    }

    // Keperluan Update Status 
    public function insert_log_history_permohonan($data = array())
    {
        $insert = $this->db->replace('history_permohonan', $data);
        return true;
    }

    public function get_data_pembayran_by_orderid($order_id)
    {
        $this->db->select('*');
        $this->db->from('data_pembayaran_permohonan');
        $this->db->where('order_id', $order_id);

        $query = $this->db->get();
        return $query->row();
    }

    public function get_data_surat_perjanjian_sertifikat($id_izin)
    {
        $this->db->select('*');
        $this->db->from('data_surat_perjanjian_sertifikat');
        $this->db->where('id_izin', $id_izin);

        $query = $this->db->get();
        return $query->row();
    }
}
?>