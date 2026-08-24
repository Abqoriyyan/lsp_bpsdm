<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    ## GET List Permohonan ##
    public function get_list_permohonan()
    {

        $sql = "SELECT a.*,b.kode_status FROM list_permohonan a 
                LEFT JOIN (SELECT * FROM history_permohonan WHERE LOG IN (SELECT MAX(LOG) FROM history_permohonan GROUP BY id_izin)) b ON b.id_izin = a.id_izin 
                WHERE b.id_izin IS NULL OR b.kode_status = '11'";

        $query = $this->db->query($sql);
        return $query->result_array();
    }

    ## Log History Permohonan Status
    public function insert_log_history_permohonan($data = array())
    {
        $insert = $this->db->replace('history_permohonan', $data);
        return true;
    }

    #Get Log History Permohonan
    public function get_log_history_permohonan($id_izin)
    {
        $this->db->select('*');
        $this->db->from('history_permohonan');
        $query = $this->db->get();
        return $query->result_array();
    }

    ## GET List Tinjau Permohonan ##
    public function get_list_tinjau_permohonan()
    {
        $sql = "SELECT a.id_izin, a.nama, d.kualifikasi, c.created, c.klasifikasi, c.subklasifikasi, c.jabatan_kerja, c.asosiasi, c.jenis_permohonan, b.kode_status
                FROM data_personal_permohonan a 
                JOIN ( 
                    SELECT * FROM history_permohonan 
                    WHERE LOG IN (SELECT MAX(LOG) FROM history_permohonan GROUP BY id_izin)
                ) b ON b.id_izin = a.id_izin 
                JOIN data_klasifikasi_kualifikasi_permohonan c ON c.id_izin = a.id_izin 
                JOIN master_kualifikasi d ON c.kualifikasi = d.id 
                WHERE b.kode_status = '20' 
                GROUP BY a.id_izin, a.nama, d.kualifikasi, c.created, c.klasifikasi, c.subklasifikasi, c.jabatan_kerja, c.asosiasi, c.jenis_permohonan, b.kode_status";

        $query = $this->db->query($sql);
        return $query->result_array();
    }

    ## Get data_personal_permohonan / administrasi
    public function get_data_personal_permohonan($id_izin)
    {
        $this->db->select('a.*,b.nama as deskripsi_propinsi,c.nama_kabupaten_dagri as deskripsi_kabupaten, a.email');
        $this->db->from('data_personal_permohonan a');
        $this->db->join('master_propinsi b', 'a.propinsi = b.id_propinsi_dagri');
        $this->db->join('master_kabupaten c', 'a.kabupaten = c.kode_kabupaten_dagri');
        $this->db->where('a.id_izin', $id_izin);
        $query = $this->db->get();
        return $query->result_array();
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

    ## Get data_studi_kasus_permohonan
    public function get_data_studi_kasus_permohonan($id_izin)
    {
        $this->db->select('*');
        $this->db->from('data_studi_kasus_permohonan');
        $this->db->where('id_izin', $id_izin);
        $query = $this->db->get();
        return $query->result_array();
    }

    ## Get data_sertifikat_surat_keterangan_permohonan
    public function get_data_sertifikat_surat_keterangan_permohonan($id_izin)
    {
        $this->db->select('*');
        $this->db->from('data_sertifikat_surat_keterangan_permohonan');
        $this->db->where('id_izin', $id_izin);
        $query = $this->db->get();
        return $query->result_array();
    }

    ## Get data_klasifikasi_kualifikasi_permohonan
    public function get_data_klasifikasi_kualifikasi_permohonan($id_izin)
    {
        $this->db->select('a.*,b.kualifikasi as deskripsi_kualifikasi,c.klasifikasi as deskripsi_klasifikasi,d.subklasifikasi as deskripsi_subklasifikasi,e.jabatan_kerja as deskripsi_jabatan_kerja,f.deskripsi as deskripsi_jenis_permohonan');
        $this->db->from('data_klasifikasi_kualifikasi_permohonan a');
        $this->db->where('a.id_izin', $id_izin);
        $this->db->join('master_kualifikasi b', 'b.id = a.kualifikasi');
        $this->db->join('master_klasifikasi c', 'c.id_klasifikasi = a.klasifikasi');
        $this->db->join('master_subklasifikasi d', 'd.kode_subklasifikasi = a.subklasifikasi');
        $this->db->join('master_jabatan_kerja e', 'e.id_jabatan_kerja = a.jabatan_kerja');
        $this->db->join('master_jenis_permohonan f', 'f.id = a.jenis_permohonan');
        $query = $this->db->get();
        return $query->result_array();
    }

    ## Get Data Tinjau Permohonan untuk Hasil Tinjau Permohonan ##
    public function get_data_tinjau_permohonan($id_izin)
    {
        $this->db->select('*');
        $this->db->from('tinjau_permohonan');
        $this->db->where('id_izin', $id_izin);
        $query = $this->db->get();
        return $query->result_array();
    }

    ## Cek User Pemohon untuk membuat User
    public function cek_user_pemohon($nik)
    {
        $this->db->select('*');
        $this->db->from('user_login');
        $multiClause = array('nik' => $nik, 'user_level' => 'User');
        $this->db->where($multiClause);
        $query = $this->db->get();
        return $query->row();
    }

    ## Get Data Apl01
    public function get_data_apl01($id_izin)
    {
        $this->db->select('*');
        $this->db->from('data_apl01_permohonan');
        $this->db->where('id_izin', $id_izin);
        $query = $this->db->get();
        return $query->row();
    }

    #Info Data Permohonan
    public function info_data_permohonan($id_izin)
    {
        $this->db->select('a.jabatan_kerja, a.kualifikasi, b.kualifikasi AS deskripsi_kualifikasi,a.subklasifikasi, e.subklasifikasi as deskripsi_subklasifikasi,a.jenjang, a.jabatan_kerja,f.kode_tuk,f.nama_tuk,c.jabatan_kerja AS deskripsi_jabatan_kerja, a.jenjang,d.deskripsi as deskripsi_jenis_permohonan');
        $this->db->from('data_klasifikasi_kualifikasi_permohonan a');
        $this->db->join('master_kualifikasi b', 'a.kualifikasi = b.id');
        $this->db->join('master_jabatan_kerja c', 'a.jabatan_kerja = c.id_jabatan_kerja');
        $this->db->join('master_jenis_permohonan d', 'a.jenis_permohonan = d.id');
        $this->db->join('master_subklasifikasi e', 'a.subklasifikasi = e.kode_subklasifikasi');
        $this->db->join('master_tuk_siki f', 'f.id = a.tuk', 'LEFT');
        $this->db->where('id_izin', $id_izin);
        $query = $this->db->get();
        return $query->row();
    }

    #Select Persyaratan Kompetensi untuk APl 01
    public function option_persyaratan_kompetensi_apl01($id_izin)
    {
        $this->db->select('a.id AS id_persyaratan_kompeten, a.persyaratan_pendidikan, a.persyaratan_pengalaman_proyek');
        $this->db->from('master_persyaratan_kompeten a');
        $this->db->join('data_klasifikasi_kualifikasi_permohonan b', 'b.kualifikasi = a.id_kualifikasi AND b.jenjang = a.jenjang_permohonan');
        $this->db->where('b.id_izin', $id_izin);

        $query = $this->db->get();
        return $query->result_array();
    }

    ## Get Data Tinjau Permohonan untuk Hasil Tinjau Permohonan ##
    public function get_data_tinjau_permohonan_untuk_hasil_tinjau($id_izin)
    {
        $this->db->select('a.*,b.deskripsi as deskripsi_item_tinjau_permohonan');
        $this->db->from('tinjau_permohonan a');
        $this->db->join('master_item_tinjau_permohonan b', 'b.kode_item = a.item_tinjau_permohonan');
        $this->db->where('a.id_izin', $id_izin);
        $query = $this->db->get();
        return $query->result_array();
    }

    #Function Update Data
    public function update_data($where, $data, $table)
    {
        $this->db->where($where);
        $this->db->update($table, $data);
    }

    #Function Reset Data untuk Perbaikan Permohonan
    function reset_data($id_izin)
    {
        $this->db->where('id_izin', $id_izin);
        $this->db->delete(array('data_apl01_permohonan', 'data_pelatihan_permohonan', 'data_pendidikan_permohonan', 'data_personal_permohonan', 'data_proyek_permohonan', 'data_studi_kasus_permohonan', 'data_klasifikasi_kualifikasi_permohonan', 'tinjau_permohonan'));
    }

    #################### Pembayaran #####################
    public function get_list_tagihan_pembayaran()
    {
        $sql = "SELECT a.id_izin, a.nama, d.kualifikasi, c.created, c.klasifikasi, c.subklasifikasi, c.jenjang,
                       c.jabatan_kerja, f.deskripsi as jenis_permohonan, c.asosiasi, b.kode_status, 
                       g.status_code, g.bukti_pembayaran, g.payment_type
                FROM data_personal_permohonan a 
                JOIN ( 
                    SELECT * FROM history_permohonan 
                    WHERE LOG IN (SELECT MAX(LOG) FROM history_permohonan GROUP BY id_izin)
                ) b ON b.id_izin = a.id_izin 
                JOIN data_klasifikasi_kualifikasi_permohonan c ON c.id_izin = a.id_izin 
                JOIN master_kualifikasi d ON c.kualifikasi = d.id 
                JOIN master_jenis_permohonan f ON f.id = c.jenis_permohonan
                LEFT JOIN data_pembayaran_permohonan g ON g.id_izin = a.id_izin
                WHERE b.kode_status IN ('12','30','31','50') 
                GROUP BY a.id_izin, a.nama, d.kualifikasi, c.created, c.klasifikasi, c.subklasifikasi, c.jenjang,
                         c.jabatan_kerja, f.deskripsi, c.asosiasi, b.kode_status, 
                         g.status_code, g.bukti_pembayaran, g.payment_type";

        $query = $this->db->query($sql);
        return $query->result_array();
    }
    #################### /Pembayaran #####################

    #################### Penunjukkan Asesor #####################
    public function get_list_penunjukan_asesor()
    {
        $sql = "SELECT a.id_izin, a.nama, d.kualifikasi, c.created, c.klasifikasi, c.subklasifikasi, 
                       i.jabatan_kerja, c.asosiasi, b.kode_status, 
                       e.id_asesor, f.nama as nama_asesor, e.kode_jadwal_asesmen, h.nama_tuk
                FROM data_personal_permohonan a 
                JOIN ( 
                    SELECT * FROM history_permohonan 
                    WHERE LOG IN (SELECT MAX(LOG) FROM history_permohonan GROUP BY id_izin)
                ) b ON b.id_izin = a.id_izin 
                JOIN data_klasifikasi_kualifikasi_permohonan c ON c.id_izin = a.id_izin 
                JOIN master_kualifikasi d ON c.kualifikasi = d.id 
                LEFT JOIN data_penunjukan_asesor e ON e.id_izin = a.id_izin
                LEFT JOIN master_asesor f ON f.id_asesor = e.id_asesor
                LEFT JOIN data_jadwal_asesmen g ON g.kode_jadwal = e.kode_jadwal_asesmen
                LEFT JOIN master_tuk h ON h.id = g.id_tuk
                LEFT JOIN master_jabatan_kerja i ON i.id_jabatan_kerja = c.jabatan_kerja
                WHERE b.kode_status = '31' 
                GROUP BY a.id_izin, a.nama, d.kualifikasi, c.created, c.klasifikasi, c.subklasifikasi, 
                         i.jabatan_kerja, c.asosiasi, b.kode_status, 
                         e.id_asesor, f.nama, e.kode_jadwal_asesmen, h.nama_tuk";

        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function get_data_bast_terakhir()
    {
        $sql = "SELECT MAX(no_surat_tugas) AS no_surat_tugas FROM data_penunjukan_asesor;";

        $query = $this->db->query($sql);
        return $query->row();
    }

    public function get_master_tuk()
    {
        $sql = "SELECT * FROM master_tuk WHERE masa_berlaku_tuk >= NOW()";

        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function get_list_asesor($subklasifikasi, $jenjang)
    {
        $this->db->select('*');
        $this->db->from('master_asesor');
        $this->db->where('subklasifikasi', $subklasifikasi);
        $this->db->where('jenjang >=', $jenjang);
        $this->db->where('id_asesor_bnsp IS NOT NULL', null, false);

        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_data_asesor($id_asesor)
    {
        $this->db->select('*');
        $this->db->from('master_asesor');
        $this->db->where('id_asesor', $id_asesor);

        $query = $this->db->get();
        return $query->row();
    }

    public function get_data_penunjukan_asesor($id_izin)
    {
        $this->db->select('a.*, b.*, c.*');
        $this->db->from('data_penunjukan_asesor a');
        $this->db->join('data_jadwal_asesmen b', 'b.kode_jadwal = a.kode_jadwal_asesmen');
        $this->db->join('master_tuk c', 'c.id = b.id_tuk');
        $this->db->where('a.id_izin', $id_izin);

        $query = $this->db->get();
        return $query->row();
    }

    public function get_data_jadwal_asesmen()
    {
        $sql = "SELECT a.*,b.nama_tuk,CONCAT(a.id_klasifikasi,a.id_subklasifikasi) AS subklasifikasi
        FROM data_jadwal_asesmen a 
        JOIN master_tuk b ON b.id = a.id_tuk
        WHERE a.tanggal_selesai >= NOW() AND a.deleted_at IS NULL";

        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function get_data_pemohon_peserta_dalam_jadwal_asesmen($id_izin)
    {
        $sql = "SELECT a.nik,a.nama,a.tempat_lahir,a.tanggal_lahir,a.jenis_kelamin,a.alamat,a.kabupaten,m.id_bnsp AS negara,a.negara AS kode_negara,b.id_propinsi_dagri AS id_propinsi_bnsp,
                    c.kode_kabupaten_dagri AS id_kabupaten_bnsp,a.telepon,a.email,d.jenis_permohonan,e.id_data_skema_bnsp AS skema_id,e.jabatan_kerja AS keterangan_skema,
                    h.id_jenjang_bnsp AS jenjang_id, g.program_studi, g.no_ijazah, g.tahun_lulus, i.id_propinsi_dagri AS id_propinsi_bnsp_sekolah,
                    CASE WHEN g.kabupaten = '9999' THEN '1010' ELSE j.kode_kabupaten_dagri END AS id_kabupaten_bnsp_sekolah, l.id_bnsp AS negara_sekolah, g.negara AS kode_negara_sekolah, g.nama_sekolah_perguruan_tinggi, k.id_pekerjaan,
                    k.pekerjaan_sekarang_perusahaan, k.pekerjaan_sekarang_jabatan,a.pas_foto,a.ktp,g.scan_ijazah_legalisir
                FROM data_personal_permohonan a 
                    JOIN master_propinsi b ON b.id_propinsi_dagri = a.propinsi
                    JOIN master_kabupaten c ON c.kode_kabupaten_dagri = a.kabupaten
                    JOIN data_klasifikasi_kualifikasi_permohonan d ON d.id_izin = a.id_izin
                    JOIN master_jabatan_kerja e ON e.id_jabatan_kerja = d.jabatan_kerja
                    JOIN (SELECT jenjang_yang_sesuai,id_izin FROM tinjau_permohonan WHERE item_tinjau_permohonan = '2') f ON f.id_izin = a.id_izin
                    JOIN data_pendidikan_permohonan g ON g.id = f.jenjang_yang_sesuai
                    JOIN master_jenjang_pendidikan h ON h.id_jenjang = g.jenjang
                    JOIN master_propinsi i ON i.id_propinsi_dagri = g.propinsi
                    LEFT JOIN master_kabupaten j ON j.kode_kabupaten_dagri = g.kabupaten
                    JOIN negara l ON l.id_negara = g.negara
                    JOIN negara m ON m.id_negara = a.negara
                    JOIN data_apl01_permohonan k ON k.id_izin = a.id_izin
                WHERE a.id_izin = ?";

        $query = $this->db->query($sql, array($id_izin));
        return $query->row();
    }

    // public function get_detail_jadwal_asesmen($kode_jadwal_asesmen)
    // {
    //     $this->db->select('*');
    //     $this->db->from('data_jadwal_asesmen');
    //     $this->db->where('kode_jadwal', $kode_jadwal_asesmen);

    //     $query = $this->db->get();
    //     return $query->row();
    // }

    #################### /Penunjukkan Asesor ####################

    #################### Keperluan Email ########################
    public function get_data_personal($id_izin)
    {
        $this->db->select('*');
        $this->db->from('data_personal_permohonan');
        $this->db->where('id_izin', $id_izin);

        $query = $this->db->get();
        return $query->row();
    }

    public function get_data_perbaikan($id_izin)
    {
        $this->db->select('a.*,b.deskripsi');
        $this->db->from('tinjau_permohonan a');
        $this->db->join('master_item_tinjau_permohonan b', 'b.kode_item = a.item_tinjau_permohonan');
        $multiClause = array('a.id_izin' => $id_izin, 'a.status' => '0');
        $this->db->where($multiClause);

        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_data_rekomendasi_asesor_lpjk($id_izin)
    {
        $sql = "SELECT a.id_izin,b.no_reg_bnsp AS id_asesor,c.rekomendasi_asesor,c.catatan,DATE(a.log) AS tgl_surat_tugas, a.no_surat_tugas ,e.kode AS kode_tuk,e.nama_tuk,d.tanggal_mulai AS tgl_uji, d.tanggal_selesai AS tgl_uji_selesai,c.metode_uji,'' AS penyelenggaraan_uji
        FROM data_penunjukan_asesor a 
        JOIN master_asesor b ON b.id_asesor = a.id_asesor
        JOIN data_rekomendasi_asesor c ON c.id_izin = a.id_izin
        JOIN data_jadwal_asesmen d ON d.kode_jadwal = a.kode_jadwal_asesmen
        JOIN master_tuk e ON e.id = d.id_tuk
        WHERE a.id_izin = ?;";

        $query = $this->db->query($sql, array($id_izin));
        return $query->row();
    }

    public function get_data_penetapan_komite_lpjk($id_izin)
    {
        $sql = "SELECT a.id_izin, b.nama AS nama_komite_teknis, b.no_reg, b.jabatan_komite_teknis, 
                   a.hasil_penetapan, a.catatan, DATE(c.log) AS tgl_surat_tugas, 
                   c.no_surat_tugas, DATE(a.log) AS tgl_penetapan, e.jabatan_kerja AS skema
            FROM data_hasil_penetapan_komite_teknis a
            JOIN master_komite b ON b.user_komite = a.user_penetap
            JOIN data_penunjukan_asesor c ON c.id_izin = a.id_izin
            JOIN data_klasifikasi_kualifikasi_permohonan d ON d.id_izin = a.id_izin
            JOIN master_jabatan_kerja e ON e.id_jabatan_kerja = d.jabatan_kerja
            WHERE a.id_izin = ?;";

        $query = $this->db->query($sql, array($id_izin));

        // Gunakan result_array() jika penetapan komite bisa lebih dari 1 orang
        return $query->result_array();
    }

    #################### /Keperluan Email ########################

    ####### Keperluan Pelaporan Asesor ke LPJK ##############
    public function get_data_pelaporan_asesor($id_izin)
    {
        $sql = "SELECT a.id_izin,DATE(b.log) AS tgl_verifikasi_apl01,(d.tanggal_mulai  - INTERVAL 1 DAY) AS tgl_verifikasi_apl02
                FROM list_permohonan a
                LEFT JOIN (SELECT * FROM history_permohonan WHERE kode_status = '10' AND id_izin = ? ORDER BY LOG DESC LIMIT 1) b ON b.id_izin = a.id_izin
                JOIN (SELECT * FROM data_penunjukan_asesor) c ON c.id_izin = a.id_izin
                JOIN data_jadwal_asesmen d ON d.kode_jadwal = c.kode_jadwal_asesmen
                WHERE a.id_izin = ?;";

        $query = $this->db->query($sql, array($id_izin, $id_izin));
        return $query->row();
    }

    ################### Selesai Penetapan Komite Teknis ############################
    public function get_data_selesai_penetapan()
    {
        $sql = "SELECT main.*, e.id AS id_jadwal_asesmen, b.username, b.log, b.kode_status
                FROM data_pencatatan_sertifikasi main
                JOIN (
                    SELECT id_izin, MAX(kode_status) AS kode_status, MAX(username) as username, MAX(log) as log
                    FROM history_permohonan
                    WHERE LOG IN (SELECT MAX(LOG) FROM history_permohonan GROUP BY id_izin)
                    GROUP BY id_izin
                    HAVING kode_status = '31'
                ) b ON b.id_izin = main.id_izin
                JOIN data_hasil_penetapan_komite_teknis c ON c.id_izin = main.id_izin
                JOIN data_penunjukan_asesor d ON d.id_izin = main.id_izin
                JOIN data_jadwal_asesmen e ON e.kode_jadwal = d.kode_jadwal_asesmen
                WHERE c.hasil_penetapan = 'Kompeten'";

        $query = $this->db->query($sql);
        return $query->result_array();
    }
    public function get_data_terbit_sertifikat()
    {
        $sql = "SELECT a.*, 
                       b.id_izin, 
                       b.kode_status, 
                       MAX(b.username) as username, 
                       MAX(b.log) as log
                FROM data_pencatatan_sertifikasi a 
                JOIN ( 
                    SELECT * FROM history_permohonan 
                    WHERE LOG IN (SELECT MAX(LOG) FROM history_permohonan GROUP BY id_izin)
                ) b ON b.id_izin = a.id_izin 
                WHERE b.kode_status = '50' 
                GROUP BY a.id_izin";

        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function get_detail_jadwal_asesmen_per_permohonan($id_izin)
    {
        $this->db->select('a.*,b.id as id_jadwal_asesmen');
        $this->db->from('data_penunjukan_asesor a');
        $this->db->join('data_jadwal_asesmen b', 'b.kode_jadwal = a.kode_jadwal_asesmen');
        $this->db->where('a.id_izin', $id_izin);

        $query = $this->db->get();
        return $query->row();
    }

    public function get_data_pencatatan($id_izin)
    {
        $this->db->select('*');
        $this->db->from('data_pencatatan_sertifikasi');
        $this->db->where('id_izin', $id_izin);

        $query = $this->db->get();
        return $query->row();
    }
    ################### /Selesai Penetapan Komite Teknis ###########################

    // =======================================================================
    // --- KOMITE TEKNIS ---
    // =======================================================================

    public function get_permohonan_komite()
    {
        $sql = "SELECT a.*, b.kode_status, c.nama AS nama
                FROM list_permohonan a 
                LEFT JOIN (SELECT * FROM history_permohonan WHERE LOG IN (SELECT MAX(LOG) FROM history_permohonan GROUP BY id_izin)) b ON b.id_izin = a.id_izin
                LEFT JOIN data_personal_permohonan c ON a.id_izin = c.id_izin";

        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function simpan_penunjukan_komite($data)
    {
        $this->db->where('id_izin', $data['id_izin']);
        $cek = $this->db->get('data_penunjukan_komite')->num_rows();

        if ($cek > 0) {
            $this->db->where('id_izin', $data['id_izin']);
            return $this->db->update('data_penunjukan_komite', $data);
        } else {
            return $this->db->insert('data_penunjukan_komite', $data);
        }
    }

    public function get_penunjukan_komite($id_izin)
    {
        $this->db->where('id_izin', $id_izin);
        return $this->db->get('data_penunjukan_komite')->row();
    }

    public function simpan_absensi_komite($data_batch, $id_izin)
    {
        $this->db->where('id_izin', $id_izin);
        $this->db->delete('data_absensi_komite');
        return $this->db->insert_batch('data_absensi_komite', $data_batch);
    }

    public function get_absensi_komite($id_izin)
    {
        $this->db->where('id_izin', $id_izin);
        return $this->db->get('data_absensi_komite')->result_array();
    }
    public function get_master_komite()
    {
        // Mengambil semua data personil dari tabel master_komite
        return $this->db->get('master_komite')->result_array();
    }

    // =======================================================================
    // --- VERIFIKASI TUK ---
    // =======================================================================

    public function get_list_jadwal_asesmen()
    {
        $this->db->select('a.*, b.nama_tuk, b.alamat');
        $this->db->from('data_jadwal_asesmen a');
        $this->db->join('master_tuk b', 'a.id_tuk = b.id', 'left');
        return $this->db->get()->result_array();
    }

    public function get_detail_jadwal_asesmen($kode_jadwal)
    {
        $this->db->select('a.*, b.nama_tuk, b.alamat');
        $this->db->from('data_jadwal_asesmen a');
        $this->db->join('master_tuk b', 'a.id_tuk = b.id', 'left');
        $this->db->where('a.kode_jadwal', $kode_jadwal);
        return $this->db->get()->row();
    }

    public function simpan_verifikasi_tuk($data)
    {
        $this->db->where('kode_jadwal', $data['kode_jadwal']);
        $cek = $this->db->get('data_verifikasi_tuk')->num_rows();

        if ($cek > 0) {
            $this->db->where('kode_jadwal', $data['kode_jadwal']);
            return $this->db->update('data_verifikasi_tuk', $data);
        } else {
            return $this->db->insert('data_verifikasi_tuk', $data);
        }
    }

    public function get_verifikasi_tuk($kode_jadwal)
    {
        $this->db->where('kode_jadwal', $kode_jadwal);
        return $this->db->get('data_verifikasi_tuk')->row();
    }

    public function get_list_pernyataan_terbit()
    {
        $sql = "SELECT a.*, MAX(b.nama) AS nama_asesi 
                FROM data_pencatatan_sertifikasi a
                LEFT JOIN data_personal_permohonan b ON a.id_izin = b.id_izin
                GROUP BY a.id_izin";

        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function simpan_absensi_pra_asesmen($data)
    {
        $this->db->where('kode_jadwal', $data['kode_jadwal']);
        $cek = $this->db->get('data_absensi_pra_asesmen')->num_rows();

        if ($cek > 0) {
            $this->db->where('kode_jadwal', $data['kode_jadwal']);
            return $this->db->update('data_absensi_pra_asesmen', $data);
        } else {
            return $this->db->insert('data_absensi_pra_asesmen', $data);
        }
    }

    public function get_absensi_pra_asesmen($kode_jadwal)
    {
        $this->db->where('kode_jadwal', $kode_jadwal);
        return $this->db->get('data_absensi_pra_asesmen')->result_array();
    }

    public function simpan_absensi_asesmen($data)
    {
        $this->db->where('kode_jadwal', $data['kode_jadwal']);
        $cek = $this->db->get('data_absensi_asesmen')->num_rows();

        if ($cek > 0) {
            $this->db->where('kode_jadwal', $data['kode_jadwal']);
            return $this->db->update('data_absensi_asesmen', $data);
        } else {
            return $this->db->insert('data_absensi_asesmen', $data);
        }
    }

    public function get_absensi_asesmen($kode_jadwal)
    {
        $this->db->where('kode_jadwal', $kode_jadwal);
        return $this->db->get('data_absensi_asesmen')->result_array();
    }
}