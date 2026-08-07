<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Asesor_model extends CI_Model
{

    public function get_list_tugas_asesmen($id_asesor)
    {
        $this->db->select('b.user_pemberi_rekomendasi, a.*, b.*, c.*, d.*, e.*');
        $this->db->from('data_penunjukan_asesor a');
        $this->db->join('data_rekomendasi_asesor b', 'b.id_izin = a.id_izin', 'left');
        $this->db->join('data_klasifikasi_kualifikasi_permohonan c', 'c.id_izin = a.id_izin');
        $this->db->join('master_kualifikasi d', 'c.kualifikasi = d.id');
        $this->db->join('data_personal_permohonan e', 'e.id_izin = a.id_izin');

        // Parameter di-bind secara otomatis dengan aman oleh CI3
        $this->db->where('a.id_asesor', $id_asesor);
        $this->db->where('b.user_pemberi_rekomendasi IS NULL', null, false);

        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_data_ketua_pelaksana()
    {
        $sql = "SELECT * FROM master_ketua_pelaksana WHERE id = (SELECT MAX(id) FROM master_ketua_pelaksana)";

        $query = $this->db->query($sql);
        return $query->row();
    }

    public function get_data_surat_tugas($id_izin)
    {
        $this->db->select('a.*, f.nama AS nama_asesi, j.pekerjaan_sekarang_perusahaan AS perusahaan_asesi, b.nama AS nama_asesor, b.no_reg_bnsp AS no_reg_bnsp_asesor, d.jenis_permohonan, i.id_jabatan_kerja, i.jabatan_kerja, d.jenjang, h.nama_tuk, h.alamat, g.tanggal_mulai, g.tanggal_selesai');
        $this->db->from('data_penunjukan_asesor a');
        $this->db->join('master_asesor b', 'a.id_asesor = b.id_asesor', 'left');
        $this->db->join('data_klasifikasi_kualifikasi_permohonan d', 'a.id_izin = d.id_izin', 'left');
        $this->db->join('data_personal_permohonan f', 'a.id_izin = f.id_izin', 'left');
        $this->db->join('data_apl01_permohonan j', 'a.id_izin = j.id_izin', 'left');
        $this->db->join('data_jadwal_asesmen g', 'g.kode_jadwal = a.kode_jadwal_asesmen');
        $this->db->join('master_tuk h', 'h.id = g.id_tuk');
        $this->db->join('master_jabatan_kerja i', 'i.id_jabatan_kerja = d.jabatan_kerja');

        // Celah SQL Injection ditutup di sini
        $this->db->where('a.id_izin', $id_izin);

        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_bukti_dokumentasi_asesmen($id_izin)
    {
        $this->db->select('a.*');
        $this->db->from('data_bukti_dokumentasi_asesmen a');
        $this->db->where('a.id_izin', $id_izin);

        $query = $this->db->get();
        return $query->row();
    }

    public function get_data_rekomendasi_asesor($id_izin)
    {
        $this->db->select('a.*,c.*,d.*,f.jabatan_kerja,g.nama as nama_asesor, g.no_reg_bnsp,h.nama, i.ttd_asesor_apl02 as ttd_asesor');
        $this->db->from('data_rekomendasi_asesor a');
        $this->db->join('data_penunjukan_asesor b', 'b.id_izin = a.id_izin');
        $this->db->join('data_jadwal_asesmen c', 'c.kode_jadwal = b.kode_jadwal_asesmen');
        $this->db->join('master_tuk d', 'd.id = c.id_tuk');
        $this->db->join('data_klasifikasi_kualifikasi_permohonan e', 'e.id_izin = a.id_izin');
        $this->db->join('master_jabatan_kerja f', 'f.id_jabatan_kerja = e.jabatan_kerja');
        $this->db->join('master_asesor g', 'g.id_asesor = b.id_asesor');
        $this->db->join('data_personal_permohonan h', 'h.id_izin = a.id_izin');
        $this->db->join('data_apl01_permohonan i', 'i.id_izin = a.id_izin');
        $this->db->where('a.id_izin', $id_izin);

        $query = $this->db->get();
        return $query->row();
    }

    public function get_id_rekomendasi_terakhir()
    {
        $this->db->select('MAX(id_rekomendasi) AS id_rekomendasi');
        $this->db->from('data_rekomendasi_asesor');

        $query = $this->db->get();
        return $query->row();
    }

    public function get_detail_jadwal_asesmen($id_izin)
    {
        $this->db->select('a.*,b.id as id_jadwal_asesmen,b.tanggal_selesai,c.*,d.nama_kabupaten_dagri as nama_kota_tuk');
        $this->db->from('data_penunjukan_asesor a');
        $this->db->join('data_jadwal_asesmen b', 'b.kode_jadwal = a.kode_jadwal_asesmen');
        $this->db->join('master_tuk c', 'c.id = b.id_tuk');
        $this->db->join('master_kabupaten d', 'd.kode_kabupaten_dagri = c.id_kota');
        $this->db->where('a.id_izin', $id_izin);

        $query = $this->db->get();
        return $query->row();

        $query = $this->db->get();
        return $query->row();
    }

    public function get_data_asesor($id_asesor)
    {
        $this->db->select('*');
        $this->db->from('master_asesor');
        $this->db->where('id_asesor', $id_asesor);

        $query = $this->db->get();
        return $query->row();
    }

    public function get_data_personal_pemohon($id_izin)
    {
        $this->db->select('*');
        $this->db->from('data_personal_permohonan');
        $this->db->where('id_izin', $id_izin);

        $query = $this->db->get();
        return $query->row();
    }

    public function get_nama_peninjau_apl01($id_izin)
    {
        $this->db->select('a.*,c.nama as nama_peninjau');
        $this->db->from('data_apl01_permohonan a');
        $this->db->join('user_login b', 'b.username = a.user_peninjau');
        $this->db->join('master_admin c', 'c.username = b.username');
        $this->db->where('a.id_izin', $id_izin);

        $query = $this->db->get();
        return $query->row();
    }

    public function get_ttd_asesor($id_izin, $user_asesor)
    {
        $this->db->select('a.*');
        $this->db->from('data_penunjukan_asesor a');
        $this->db->where('a.id_izin', $id_izin);
        $this->db->where('a.id_asesor', $user_asesor);

        $query = $this->db->get();
        return $query->row();
    }

    public function get_ttd_lead_asesor($id_izin)
    {
        $this->db->select('a.*');
        $this->db->from('data_penunjukan_asesor a');
        $this->db->where('a.id_izin', $id_izin);
        $this->db->where('a.asesor', '1');

        $query = $this->db->get();
        return $query->row();
    }

    #Function Update Data
    public function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }
    ## Get Hasil Tinjau Permohonan ##
    public function get_data_apl01($id_izin)
    {
        $this->db->select('a.*,b.nama as nama_asesor_ttd_apl02');
        $this->db->from('data_apl01_permohonan a');
        $this->db->join('master_asesor b', 'b.id_asesor = a.user_asesor_ttd_apl02', 'left');
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
        return $query->row();
    }

    # Get Data Pengalaman Proyek
    public function get_data_proyek_permohonan($id_izin)
    {
        $this->db->select('*');
        $this->db->from('data_proyek_permohonan');
        $this->db->where('id_izin', $id_izin);
        $query = $this->db->get();
        return $query->result_array();
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

    #Get Data Pendidikan Yang Sesuai
    public function get_data_pendidikan_yang_sesuai($id_izin)
    {
        $this->db->select('a.*,b.*,c.*');
        $this->db->from('data_apl01_permohonan a');
        $this->db->join('tinjau_permohonan b', 'b.id_izin = a.id_izin');
        $this->db->join('data_pendidikan_permohonan c', 'c.id = b.jenjang_yang_sesuai');
        $multiClause = array('a.id_izin' => $id_izin, 'b.item_tinjau_permohonan' => '2');
        $this->db->where($multiClause);

        $query = $this->db->get();
        return $query->row();
    }

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
        $query = $this->db->get();
        return $query->result_array();
    }
    ####################### /Model APL 02 #######################

    ###################### Model Mapa01 #########################
    public function get_data_mapa01($id_izin)
    {
        $this->db->select("*");
        $this->db->from('data_mapa01');
        $this->db->where('id_izin', $id_izin);

        $query = $this->db->get();
        return $query->row();
    }

    public function get_ceklis_mapa01($id_izin)
    {
        $this->db->select("*");
        $this->db->from('ceklis_mapa01');
        $this->db->where('id_izin', $id_izin);

        $query = $this->db->get();
        return $query->result_array();
    }
    ###################### /Model Mapa01 #########################
    ###################### Model Mapa02 #########################
    public function get_data_mapa02($id_izin)
    {
        $this->db->select("*");
        $this->db->from('ceklis_mapa02');
        $this->db->where('id_izin', $id_izin);

        $query = $this->db->get();
        return $query->result_array();
    }
    ###################### /Model Mapa02 #########################

    ###################### Asesmen Model #########################
    public function get_maping_asesmen($id_izin, $kualifikasi)
    {
        $user_asesor = $this->session->userdata('username');

        $sql = "SELECT a.* FROM master_maping_asesmen a 
                LEFT JOIN (SELECT * FROM data_file_asesmen WHERE id_izin = ? AND user_pengunggah = ?) b ON b.kode_form = a.kode_form
                WHERE a.kualifikasi = ? AND b.file IS NULL";

        $query = $this->db->query($sql, array($id_izin, $user_asesor, $kualifikasi));
        return $query->result_array();
    }

    public function get_data_file_asesmen($id_izin, $kualifikasi)
    {
        $this->db->select("a.*,b.deskripsi as deskripsi_form");
        $this->db->from('data_file_asesmen a');
        $this->db->join('master_maping_asesmen b', 'b.kode_form = a.kode_form');
        $multiClause = array('a.id_izin' => $id_izin, 'a.user_pengunggah' => $this->session->userdata('username'), 'b.kualifikasi' => $kualifikasi);
        $this->db->where($multiClause);

        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_file_lama($id_izin, $kode_form)
    {
        $this->db->select("*");
        $this->db->from('data_file_asesmen');
        $multiClause = array('id_izin' => $id_izin, 'kode_form' => $kode_form);
        $this->db->where($multiClause);

        $query = $this->db->get();
        return $query->row();
    }
    ###################### / Asesmen Model #########################

    public function get_data_asesor_by_role($id_izin, $role)
    {
        $this->db->select('a.*, b.nama as nama_asesor');
        $this->db->from('data_penunjukan_asesor a');
        $this->db->join('master_asesor b', 'b.id_asesor = a.id_asesor', 'left');
        $this->db->where('a.id_izin', $id_izin);
        $this->db->where('a.asesor', $role); // '1' untuk Asesor 1, '2' untuk Asesor 2

        $query = $this->db->get();
        return $query->row();
    }

    public function cek_tugas_asesor($id_izin, $username_login)
    {
        $this->db->select('id_izin');
        $this->db->from('data_penunjukan_asesor');
        $this->db->where('id_izin', $id_izin);
        $this->db->where('id_asesor', $username_login);

        $query = $this->db->get();
        return $query->row();
    }

}