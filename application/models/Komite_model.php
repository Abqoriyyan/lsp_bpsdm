<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Komite_model extends CI_Model
{
    ## GET List Permohonan ##
    public function get_list_penetapan()
    {
        $this->db->query("SET sql_mode = (SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''))");

        $sql = "SELECT g.id as id_jadwal_asesmen,h.nama_tuk,h.alamat AS alamat_tuk,a.*,b.*,c.*,d.kualifikasi AS deskripsi_kualifikasi
    FROM data_personal_permohonan a
    JOIN data_klasifikasi_kualifikasi_permohonan b ON b.id_izin = a.id_izin 
    JOIN data_rekomendasi_asesor c ON c.id_izin = a.id_izin 
    JOIN master_kualifikasi d ON d.id = b.kualifikasi
    LEFT JOIN data_pencatatan_sertifikasi e ON e.id_izin = a.id_izin
    JOIN data_penunjukan_asesor f ON f.id_izin = a.id_izin
    JOIN data_jadwal_asesmen g ON g.kode_jadwal = f.kode_jadwal_asesmen
    JOIN master_tuk h ON h.id = g.id_tuk
    LEFT JOIN data_hasil_penetapan_komite_teknis i ON i.id_izin = a.id_izin
    WHERE e.id_izin IS NULL AND i.id_izin IS NULL
    GROUP BY c.id_izin";

        $query = $this->db->query($sql);
        return $query->result_array();
    }

    #Info Data Permohonan
    public function info_data_permohonan($id_izin)
    {
        $this->db->select('a.jabatan_kerja, a.kualifikasi, b.kualifikasi AS deskripsi_kualifikasi,a.subklasifikasi, e.subklasifikasi as deskripsi_subklasifikasi,a.jenjang, a.jabatan_kerja,c.jabatan_kerja AS deskripsi_jabatan_kerja, a.jenjang,d.deskripsi as deskripsi_jenis_permohonan');
        $this->db->from('data_klasifikasi_kualifikasi_permohonan a');
        $this->db->join('master_kualifikasi b', 'a.kualifikasi = b.id');
        $this->db->join('master_jabatan_kerja c', 'a.jabatan_kerja = c.id_jabatan_kerja');
        $this->db->join('master_jenis_permohonan d', 'a.jenis_permohonan = d.id');
        $this->db->join('master_subklasifikasi e', 'a.subklasifikasi = e.kode_subklasifikasi');
        $this->db->where('id_izin', $id_izin);
        $query = $this->db->get();
        return $query->row();
    }

    # Get Data Personal Permohonan
    public function get_data_personal_permohonan($id_izin)
    {
        $this->db->select('a.*,b.nama as deskripsi_propinsi,c.nama_kabupaten_dagri as deskripsi_kabupaten, a.email');
        $this->db->from('data_personal_permohonan a');
        $this->db->join('master_propinsi b', 'a.propinsi = b.id_propinsi_dagri');
        $this->db->join('master_kabupaten c', 'a.kabupaten = c.kode_kabupaten_dagri');

        $this->db->where('a.id_izin', $id_izin);
        $query = $this->db->get();
        return $query->row();
    }

    # Get Data Pendidikan Permohonan
    public function get_data_pendidikan_permohonan($id_izin)
    {
        $this->db->select('b.deskripsi AS deskripsi_jenjang, a.*');
        $this->db->from('data_pendidikan_permohonan a');
        $this->db->join('master_jenjang_pendidikan b', 'a.jenjang = b.id_jenjang');
        $this->db->join('tinjau_permohonan c', 'c.id_izin = a.id_izin');
        $this->db->where('a.id_izin', $id_izin);
        $this->db->where('c.item_tinjau_permohonan', '2');
        $this->db->where('c.jenjang_yang_sesuai = a.id', null, false);

        $query = $this->db->get();
        return $query->row();
    }

    ## Get data_proyek_permohonan
    public function get_data_proyek_permohonan($id_izin)
    {
        $this->db->select('*');
        $this->db->from('data_proyek_permohonan');
        $this->db->where('id_izin', $id_izin);
        $query = $this->db->get();
        return $query->result_array();
    }

    ## Get data_pelatihan_permohonan
    public function get_data_pelatihan_permohonan($id_izin)
    {
        $this->db->select('*');
        $this->db->from('data_pelatihan_permohonan');
        $this->db->where('id_izin', $id_izin);
        $query = $this->db->get();
        return $query->result_array();
    }

    ## Get data_klasifikasi_kualifikasi_permohonan
    public function get_data_klasifikasi_kualifikasi_permohonan($id_izin)
    {
        $this->db->select('a.*,b.kualifikasi as deskripsi_kualifikasi, b.kualifikasi_en, c.klasifikasi as deskripsi_klasifikasi, c.klasifikasi_en, d.subklasifikasi as deskripsi_subklasifikasi, d.subklasifikasi_en, e.jabatan_kerja as deskripsi_jabatan_kerja, e.work_position, f.deskripsi as deskripsi_jenis_permohonan');
        $this->db->from('data_klasifikasi_kualifikasi_permohonan a');
        $this->db->where('a.id_izin', $id_izin);
        $this->db->join('master_kualifikasi b', 'b.id = a.kualifikasi');
        $this->db->join('master_klasifikasi c', 'c.id_klasifikasi = a.klasifikasi');
        $this->db->join('master_subklasifikasi d', 'd.kode_subklasifikasi = a.subklasifikasi');
        $this->db->join('master_jabatan_kerja e', 'e.id_jabatan_kerja = a.jabatan_kerja');
        $this->db->join('master_jenis_permohonan f', 'f.id = a.jenis_permohonan');
        $query = $this->db->get();
        return $query->row();
    }

    ## Get Data Rekomendasi Asesor
    public function get_data_rekomendasi_asesor($id_izin)
    {
        // $this->db->select('');
        // $this->db->from('data_rekomendasi_asesor a');
        // $this->db->join('master_asesor b','b.id_asesor = a.user_pemberi_rekomendasi');
        // $this->db->join('data_penunjukan_asesor c','c.id_izin = $id_izin');
        // $this->db->where('id_izin',$id_izin);

        $sql = "SELECT a.*,b.*,c.asesor AS asesor_ke
                FROM data_rekomendasi_asesor a
                JOIN master_asesor b ON b.id_asesor = a.user_pemberi_rekomendasi 
                JOIN data_penunjukan_asesor c ON c.id_izin = a.id_izin AND c.id_asesor = b.id_asesor WHERE a.id_izin = ? ORDER BY asesor_ke ASC
        ";

        $query = $this->db->query($sql, array($id_izin));
        return $query->result_array();

    }

    # Get Data File Hasil Asesmen Rekomendasi Asesor
    public function get_data_file_asesmen($id_izin, $kualifikasi)
    {
        $this->db->select('b.deskripsi AS nama_form,a.*');
        $this->db->from('data_file_asesmen a');
        $this->db->join('master_maping_asesmen b', 'b.kode_form = a.kode_form');
        $multiClause = array('a.id_izin' => $id_izin, 'b.kualifikasi' => $kualifikasi);
        $this->db->where($multiClause);

        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_nomor_sertifikat_terakhir()
    {
        // $this->db->select('MAX(nomor_sertifikasi) AS nomor_sertifikasi');
        // $this->db->from('data_pencatatan_sertifikasi');
        // $this->db->where('');

        // $query = $this->db->get();
        // return $query->row();

        $sql = "SELECT MAX(nomor_sertifikasi) AS nomor_sertifikasi
                FROM data_pencatatan_sertifikasi
                WHERE YEAR(tanggal_ditetapkan) = YEAR(NOW())
        ";

        $query = $this->db->query($sql);
        return $query->row();
    }

    public function get_list_selesai_penetapan()
    {
        $this->db->query("SET sql_mode = (SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''))");

        $sql = "SELECT e.*
    FROM data_personal_permohonan a
    JOIN data_klasifikasi_kualifikasi_permohonan b ON b.id_izin = a.id_izin 
    JOIN data_rekomendasi_asesor c ON c.id_izin = a.id_izin 
    JOIN master_kualifikasi d ON d.id = b.kualifikasi
    JOIN data_pencatatan_sertifikasi e ON e.id_izin = a.id_izin
    GROUP BY c.id_izin";

        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function get_detail_jadwal_asesmen($id_izin)
    {
        $this->db->select('a.*,b.id as id_jadwal_asesmen');
        $this->db->from('data_penunjukan_asesor a');
        $this->db->join('data_jadwal_asesmen b', 'b.kode_jadwal = a.kode_jadwal_asesmen');
        $this->db->where('a.id_izin', $id_izin);

        $query = $this->db->get();
        return $query->row();
    }

    public function keperluan_nomor_sertifikat_lengkap($id_izin)
    {
        $this->db->select('b.*');
        $this->db->from('data_klasifikasi_kualifikasi_permohonan a');
        $this->db->join('master_jabatan_kerja b', 'b.id_jabatan_kerja = a.jabatan_kerja');
        $this->db->where('a.id_izin', $id_izin);

        $query = $this->db->get();
        return $query->row();
    }

    ## Get Data Pencatatan / Hasil Penetapan yang sudah status 50
    public function get_data_pencatatan($id_izin)
    {
        $this->db->select('
            a.*, 
            a.ketua_pelaksana as nama_ketua_pelaksana, 
            a.ttd_ketua_pelaksana, 
            b.nama as nama_komite, 
            b.file_ttd as ttd_komite, 
            c.kode_jadwal_asesmen, 
            d.*, 
            f.*
        ');
        $this->db->from('data_pencatatan_sertifikasi a');

        $this->db->join('master_komite b', 'b.user_komite = a.user_penetap', 'left');
        $this->db->join('data_penunjukan_asesor c', 'c.id_izin = a.id_izin', 'left');
        $this->db->join('data_jadwal_asesmen d', 'd.kode_jadwal = c.kode_jadwal_asesmen', 'left');
        $this->db->join('master_tuk f', 'f.id = d.id_tuk', 'left');

        $this->db->where('a.id_izin', $id_izin);

        $query = $this->db->get();
        return $query->row();
    }

    public function get_data_hasil_penetapan_komite_teknis($id_izin)
    {
        $this->db->query("SET sql_mode = (SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''))");

        $this->db->select('e.*, a.log AS tanggal_penetapan, f.nama AS nama_komite, f.file_ttd, g.*, h.jenjang, i.jabatan_kerja');
        $this->db->from('data_hasil_penetapan_komite_teknis a');
        $this->db->join('data_penunjukan_asesor b', 'b.id_izin = a.id_izin', 'left');
        $this->db->join('data_jadwal_asesmen c', 'c.kode_jadwal = b.kode_jadwal_asesmen', 'left');
        $this->db->join('data_penunjukan_asesor d', 'd.kode_jadwal_asesmen = c.kode_jadwal', 'left');
        $this->db->join('data_hasil_penetapan_komite_teknis e', 'e.id_izin = d.id_izin', 'left');
        $this->db->join('master_komite f', 'f.user_komite = e.user_penetap', 'left');
        $this->db->join('data_personal_permohonan g', 'g.id_izin = e.id_izin', 'left');
        $this->db->join('data_klasifikasi_kualifikasi_permohonan h', 'h.id_izin = e.id_izin', 'left');
        $this->db->join('master_jabatan_kerja i', 'i.id_jabatan_kerja = h.jabatan_kerja', 'left');

        $this->db->where('a.id_izin', $id_izin);
        $this->db->group_by('d.id_izin');

        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_data_ketua_pelaksana()
    {
        $sql = "SELECT * FROM master_ketua_pelaksana WHERE id = (SELECT MAX(id) FROM master_ketua_pelaksana)";

        $query = $this->db->query($sql);
        return $query->row();
    }

    public function get_data_komite_teknis()
    {
        $this->db->select('*');
        $this->db->from('master_komite');

        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_data_penetapan_perorangan($id_izin)
    {
        $this->db->query("SET sql_mode = (SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''))");

        $this->db->select('a.*, a.log AS tanggal_penetapan, f.nama AS nama_komite, f.file_ttd, g.*, h.jenjang, i.jabatan_kerja');
        $this->db->from('data_hasil_penetapan_komite_teknis a');
        $this->db->join('master_komite f', 'f.user_komite = a.user_penetap', 'left');
        $this->db->join('data_personal_permohonan g', 'g.id_izin = a.id_izin', 'left');
        $this->db->join('data_klasifikasi_kualifikasi_permohonan h', 'h.id_izin = a.id_izin', 'left');
        $this->db->join('master_jabatan_kerja i', 'i.id_jabatan_kerja = h.jabatan_kerja', 'left');

        $this->db->where('a.id_izin', $id_izin);

        $query = $this->db->get();
        return $query->row_array();
    }
}