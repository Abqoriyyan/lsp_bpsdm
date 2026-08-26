<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Asesor extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url', 'html', 'file', 'form', 'security'));
        $this->load->library(array('form_validation', 'email', 'pdfgenerator', 'system'));
        $this->load->config('email');

        // $this->load->library('../controllers/mail','mail');
        ## GET Model Admin Model
        $this->load->model('asesor_model');
        $this->load->model('master_model');
        $this->load->model('pemohon_model');
        $this->load->model('api_model');
        $this->load->model('admin_model');
        ## GET Model Admin Model
        date_default_timezone_set('Asia/Jakarta');
    }
    public function index()
    {
        ##/Cek Session Login##
        if (!$this->ion_auth->ceklogin()) {
            redirect('login', 'refresh');
        } else if ($this->session->userdata('level') !== 'Asesor') {
            redirect('login/keluar', 'refresh');
        }
        ##/Cek Session Login##

        $this->data = array(
            'username' => $this->session->userdata('username'),
            'level' => $this->session->userdata('level'),
        );
        $this->template->load('menu', 'Asesor/dashboard', $this->data);
    }
    public function list_tugas_asesmen()
    {
        ##/Cek Session Login##
        if (!$this->ion_auth->ceklogin()) {
            redirect('login', 'refresh');
        } else if ($this->session->userdata('level') !== 'Asesor') {
            redirect('login/keluar', 'refresh');
        }
        ##/Cek Session Login##

        $id_asesor = $this->session->userdata('username');
        $get_list_tugas_asesmen = $this->asesor_model->get_list_tugas_asesmen($id_asesor);

        $this->data = array(
            'username' => $this->session->userdata('username'),
            'level' => $this->session->userdata('level'),
            'get_list_tugas_asesmen' => $get_list_tugas_asesmen,
        );
        $this->template->load('menu', 'Asesor/list_tugas_asesmen', $this->data);
    }

    public function cetak_surat_tugas($id_izin)
    {
        // ##/Cek Session Login##
        if (!$this->ion_auth->ceklogin()) {
            redirect('login', 'refresh');
        } else if ($this->session->userdata('level') !== 'Asesor') {
            redirect('login/keluar', 'refresh');
        }
        // ##/Cek Session Login##
        $id_izin = base64_decode($id_izin);
        $username_login = $this->session->userdata('username');
        $cek_tugas = $this->asesor_model->cek_tugas_asesor($id_izin, $username_login);

        if (!$cek_tugas) {
            show_error('Akses Ditolak. Anda tidak ditugaskan untuk manguji peserta ini.', 403, 'Forbidden');
            return;
        }

        $token = $this->api_model->get_token();
        $get_data_ketua_pelaksana = $this->asesor_model->get_data_ketua_pelaksana();

        $file_pdf = 'Surat Tugas Permohonan ID-Izin' . $id_izin;
        $paper = 'A4';
        $orientation = "potrait";
        $page = 'Asesor/cetak_surat_tugas';

        #Get Data Surat Tugas
        $get_data_surat_tugas = $this->asesor_model->get_data_surat_tugas($id_izin);

        $data = array(
            'id_izin' => $id_izin,
            'get_data_surat_tugas' => $get_data_surat_tugas,
            'token' => $token,
            'get_data_ketua_pelaksana' => $get_data_ketua_pelaksana,
        );

        // $this->load->view($page, $data);
        $html = $this->load->view($page, $data, true);
        ob_clean();
        error_reporting(0);
        $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }

    /////////////////////////////////// Pra Asesmen ////////////////////////////////////////////
    public function pra_asesmen($id_izin)
    {
        ##/Cek Session Login##
        if (!$this->ion_auth->ceklogin()) {
            redirect('login', 'refresh');
        } else if ($this->session->userdata('level') !== 'Asesor') {
            redirect('login/keluar', 'refresh');
        }
        ##/Cek Session Login##
        $id_izin = base64_decode($id_izin);
        $username_login = $this->session->userdata('username');
        $cek_tugas = $this->asesor_model->cek_tugas_asesor($id_izin, $username_login);

        if (!$cek_tugas) {
            show_error('Akses Ditolak. Anda tidak ditugaskan untuk manguji peserta ini.', 403, 'Forbidden');
            return;
        }

        $this->data = array(
            'username' => $this->session->userdata('username'),
            'level' => $this->session->userdata('level'),
            'id_izin' => $id_izin,
        );
        $this->template->load('menu', 'Asesor/pra_asesmen', $this->data);
    }

    public function form_apl01($id_izin)
    {
        ##/Cek Session Login##
        if (!$this->ion_auth->ceklogin()) {
            redirect('login', 'refresh');
        } else if ($this->session->userdata('level') !== 'Asesor') {
            redirect('login/keluar', 'refresh');
        }
        ##/Cek Session Login##
        $id_izin = base64_decode($id_izin);

        $this->data = array(
            'username' => $this->session->userdata('username'),
            'level' => $this->session->userdata('level'),
            'id_izin' => $id_izin,
        );
        $this->template->load('menu', 'Asesor/pra-asesmen/apl/apl01', $this->data);
    }

    public function cetak_form_apl01($id_izin)
    {
        if (!$this->ion_auth->ceklogin()) {
            redirect('login', 'refresh');
        } else if ($this->session->userdata('level') !== 'Asesor') {
            redirect('login/keluar', 'refresh');
        }

        $id_izin = base64_decode($id_izin);
        $username_login = $this->session->userdata('username');
        $cek_tugas = $this->asesor_model->cek_tugas_asesor($id_izin, $username_login);

        if (!$cek_tugas) {
            show_error('Akses Ditolak. Anda tidak ditugaskan untuk manguji peserta ini.', 403, 'Forbidden');
            return;
        }
        $token = $this->api_model->get_token();

        $get_data_apl01 = $this->asesor_model->get_data_apl01($id_izin);
        $get_data_personal_permohonan = $this->asesor_model->get_data_personal_permohonan($id_izin);
        $get_data_pendidikan_permohonan = $this->asesor_model->get_data_pendidikan_permohonan($id_izin);
        $get_data_unit_kompetensi = $this->asesor_model->get_data_unit_kompetensi($id_izin);
        $get_data_klasifikasi_kualifikasi = $this->asesor_model->get_data_klasifikasi_kualifikasi($id_izin);

        #Get Data Apl
        $get_data_pendidikan_yang_sesuai = $this->asesor_model->get_data_pendidikan_yang_sesuai($id_izin);
        $get_nama_peninjau_apl01 = $this->asesor_model->get_nama_peninjau_apl01($id_izin);

        #Get Master Pendidikan
        $get_master_jenjang_pendidikan = $this->master_model->get_master_jenjang_pendidikan();
        $get_master_persyaratan_kompeten = $this->master_model->get_master_persyaratan_kompeten();
        $get_master_jabatan_kerja = $this->master_model->get_master_jabatan_kerja();

        $data = array(
            'id_izin' => $id_izin,
            'get_data_personal_permohonan' => $get_data_personal_permohonan,
            'get_data_pendidikan_permohonan' => $get_data_pendidikan_permohonan,
            'get_data_apl01' => $get_data_apl01,
            'get_data_unit_kompetensi' => $get_data_unit_kompetensi,
            'get_data_pendidikan_yang_sesuai' => $get_data_pendidikan_yang_sesuai,
            'get_data_klasifikasi_kualifikasi' => $get_data_klasifikasi_kualifikasi,
            'get_master_jenjang_pendidikan' => $get_master_jenjang_pendidikan,
            'get_master_persyaratan_kompeten' => $get_master_persyaratan_kompeten,
            'get_master_jabatan_kerja' => $get_master_jabatan_kerja,
            'get_nama_peninjau_apl01' => $get_nama_peninjau_apl01,
            'token' => $token
        );

        $file_pdf = 'Formulir Apl 01';
        $paper = 'A4';
        $orientation = "potrait";
        $page = 'Asesor/pra-asesmen/apl/cetak_apl01';

        // $this->load->view($page, $data);
        $html = $this->load->view($page, $data, true);
        ob_clean();
        error_reporting(0);
        $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }

    public function form_apl02($id_izin)
    {
        if (!$this->ion_auth->ceklogin()) {
            redirect('login', 'refresh');
        } else if ($this->session->userdata('level') !== 'Asesor') {
            redirect('login/keluar', 'refresh');
        }
        $id_izin = base64_decode($id_izin);
        $username_login = $this->session->userdata('username');
        $cek_tugas = $this->asesor_model->cek_tugas_asesor($id_izin, $username_login);

        if (!$cek_tugas) {
            show_error('Akses Ditolak. Anda tidak ditugaskan untuk manguji peserta ini.', 403, 'Forbidden');
            return;
        }
        $get_data_apl01 = $this->asesor_model->get_data_apl01($id_izin);
        $get_ttd_asesor = $this->asesor_model->get_ttd_asesor($id_izin, $this->session->userdata('username'));

        $this->data = array(
            'username' => $this->session->userdata('username'),
            'level' => $this->session->userdata('level'),
            'id_izin' => $id_izin,
            'get_data_apl01' => $get_data_apl01,
            'get_ttd_asesor' => $get_ttd_asesor,
        );
        $this->template->load('menu', 'Asesor/pra-asesmen/apl/apl02', $this->data);
    }

    public function insert_signature_asesor_apl02($id_izin)
    {
        if (!$this->ion_auth->ceklogin() || $this->session->userdata('level') !== 'Asesor') {
            header('HTTP/1.1 403 Forbidden');
            echo "Sesi telah habis atau akses ditolak, silakan login ulang.";
            exit;
        }

        $id_izin_raw = base64_decode($id_izin);
        $id_izin_clean = $this->security->xss_clean($id_izin_raw);
        $id_izin_asli = preg_replace('/[^a-zA-Z0-9-]/', '', $id_izin_clean);

        $log = date("Y-m-d H:i:s");

        $img = $this->input->post('image', FALSE);
        $img = str_replace('data:image/png;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);

        $file_name = 'ttd_asesor_apl02-' . $this->session->userdata('username') . "-" . base64_encode($id_izin_asli) . '.png';
        $folder_path = FCPATH . 'uploads/file_permohonan/ttd_asesor_apl02/';
        $file_path = $folder_path . $file_name;

        if (!is_dir($folder_path)) {
            mkdir($folder_path, 0775, true);
        }

        if (!file_put_contents($file_path, $data)) {
            header('HTTP/1.1 500 Internal Server Error');
            echo "Gagal menyimpan file gambar ke direktori server.";
            exit;
        }

        $data_update = array(
            'ttd_asesor' => $file_name,
            'tanggal_ttd' => $log,
        );

        $where = array(
            'id_izin' => $id_izin_asli,
            'id_asesor' => $this->session->userdata('username'),
        );

        $this->asesor_model->update_data($where, $data_update, 'data_penunjukan_asesor');

        echo "Tanda Tangan Berhasil Disimpan";
    }

    public function cetak_form_apl02($id_izin)
    {
        ##/Cek Session Login##
        if (!$this->ion_auth->ceklogin()) {
            redirect('login', 'refresh');
        } else if ($this->session->userdata('level') !== 'Asesor') {
            redirect('login/keluar', 'refresh');
        }
        ##/Cek Session Login##
        $id_izin = base64_decode($id_izin);
        $username_login = $this->session->userdata('username');
        $cek_tugas = $this->asesor_model->cek_tugas_asesor($id_izin, $username_login);

        if (!$cek_tugas) {
            show_error('Akses Ditolak. Anda tidak ditugaskan untuk manguji peserta ini.', 403, 'Forbidden');
            return;
        }
        $token = $this->api_model->get_token();

        # Get Data Master Model
        $get_master_unit_kompetensi = $this->master_model->get_master_unit_kompetensi();
        $get_master_elemen_kompetensi = $this->master_model->get_master_elemen_kompetensi();
        $get_master_kriteria_unjuk_kerja = $this->master_model->get_master_kriteria_unjuk_kerja();

        # Get Data Permohonan
        $get_data_klasifikasi_kualifikasi = $this->asesor_model->get_data_klasifikasi_kualifikasi($id_izin);
        $get_data_apl01 = $this->asesor_model->get_data_apl01($id_izin);
        $get_data_personal_permohonan = $this->asesor_model->get_data_personal_permohonan($id_izin);

        # Get Data Apl-02
        $get_data_apl02 = $this->asesor_model->get_data_apl02($id_izin);
        $get_bukti_relavan_apl02 = $this->asesor_model->get_bukti_relavan_apl02($id_izin);
        $get_asesor_1 = $this->asesor_model->get_data_asesor_by_role($id_izin, '1');
        $get_asesor_2 = $this->asesor_model->get_data_asesor_by_role($id_izin, '2');

        $data = array(
            'id_izin' => $id_izin,
            'get_data_klasifikasi_kualifikasi' => $get_data_klasifikasi_kualifikasi,
            'get_master_unit_kompetensi' => $get_master_unit_kompetensi,
            'get_master_elemen_kompetensi' => $get_master_elemen_kompetensi,
            'get_master_kriteria_unjuk_kerja' => $get_master_kriteria_unjuk_kerja,
            'get_data_apl02' => $get_data_apl02,
            'get_bukti_relavan_apl02' => $get_bukti_relavan_apl02,
            'get_data_apl01' => $get_data_apl01,
            'get_data_personal_permohonan' => $get_data_personal_permohonan,
            // Masukkan variabel baru ke dalam array:
            'get_asesor_1' => $get_asesor_1,
            'get_asesor_2' => $get_asesor_2,
            'token' => $token
        );

        $file_pdf = 'Formulir Apl.02';
        $paper = 'A4';
        $orientation = "potrait";
        $page = 'Asesor/pra-asesmen/apl/cetak_apl02';

        // $this->load->view($page, $data);
        $html = $this->load->view($page, $data, true);
        ob_clean();
        error_reporting(0);
        $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }
    /////////////////////////////////// /Pra Asesmen ////////////////////////////////////////////

    /////////////////////////////////// Asesmen ////////////////////////////////////////////
    public function asesmen($id_izin)
    {
        ##/Cek Session Login##
        if (!$this->ion_auth->ceklogin()) {
            redirect('login', 'refresh');
        } else if ($this->session->userdata('level') !== 'Asesor') {
            redirect('login/keluar', 'refresh');
        }
        ##/Cek Session Login##
        $id_izin = base64_decode($id_izin);
        $username_login = $this->session->userdata('username');
        $cek_tugas = $this->asesor_model->cek_tugas_asesor($id_izin, $username_login);

        if (!$cek_tugas) {
            show_error('Akses Ditolak. Anda tidak ditugaskan untuk manguji peserta ini.', 403, 'Forbidden');
            return;
        }

        # Get Data Permohonan
        $get_data_klasifikasi_kualifikasi = $this->asesor_model->get_data_klasifikasi_kualifikasi($id_izin);
        $get_data_file_asesmen = $this->asesor_model->get_data_file_asesmen($id_izin, $get_data_klasifikasi_kualifikasi->kualifikasi);
        $get_data_proyek_permohonan = $this->asesor_model->get_data_proyek_permohonan($id_izin);
        $get_data_pendidikan_yang_sesuai = $this->asesor_model->get_data_pendidikan_yang_sesuai($id_izin);
        $get_bukti_dokumentasi_asesmen = $this->asesor_model->get_bukti_dokumentasi_asesmen($id_izin);


        # Get Master
        $get_maping_asesmen = $this->asesor_model->get_maping_asesmen($id_izin, $get_data_klasifikasi_kualifikasi->kualifikasi);

        $this->data = array(
            'username' => $this->session->userdata('username'),
            'level' => $this->session->userdata('level'),
            'id_izin' => $id_izin,
            'get_maping_asesmen' => $get_maping_asesmen,
            'get_data_file_asesmen' => $get_data_file_asesmen,
            'get_data_proyek_permohonan' => $get_data_proyek_permohonan,
            'get_data_pendidikan_yang_sesuai' => $get_data_pendidikan_yang_sesuai,
            'get_bukti_dokumentasi_asesmen' => $get_bukti_dokumentasi_asesmen,
        );
        $this->template->load('menu', 'Asesor/asesmen', $this->data);
    }

    // Upload File Asesmen Hybrid //
    public function upload_file_asesmen($id_izin)
    {
        ##/Cek Session Login##
        if (!$this->ion_auth->ceklogin()) {
            redirect('login', 'refresh');
        } else if ($this->session->userdata('level') !== 'Asesor') {
            redirect('login/keluar', 'refresh');
        }
        ##/Cek Session Login##
        $id_izin = base64_decode($id_izin);
        $username_login = $this->session->userdata('username');
        $cek_tugas = $this->asesor_model->cek_tugas_asesor($id_izin, $username_login);

        if (!$cek_tugas) {
            show_error('Akses Ditolak. Anda tidak ditugaskan untuk manguji peserta ini.', 403, 'Forbidden');
            return;
        }
        $log = date("Y-m-d H:i:s");

        # Get Data Permohonan
        $get_data_klasifikasi_kualifikasi = $this->asesor_model->get_data_klasifikasi_kualifikasi($id_izin);

        //config upload file Asesmen
        $comb = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $shfl = str_shuffle($comb);
        $filename_unik_karakter = SUBSTR($shfl, 0, 10);

        $file_name = "file-" . $this->input->post('form') . "-" . md5($filename_unik_karakter) . "_" . date("Y-m-d");
        $config['upload_path'] = FCPATH . 'uploads/file_asesmen/' . $this->input->post('form');
        $config['allowed_types'] = 'pdf';
        $config['file_name'] = $file_name;
        $config['overwrite'] = true;
        $config['max_size'] = 102400; // 10MB

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if ($this->upload->do_upload('file_asesmen')) {
            $file_asesmen = $this->upload->data();
            $filename_asesmen = $file_asesmen['file_name'];

            $this->session->set_flashdata('success', 'Berhasil Menambahkan');
        } else {
            $this->session->set_flashdata('gagal', 'Gagal Upload File Size Terlalu Besar dari 10 Mb');
            redirect("asesor/asesmen/" . base64_encode($id_izin), "refresh");
        }

        // Insert Data File Asesmen
        $data_file_asesmen['id_izin'] = $id_izin;
        $data_file_asesmen['kode_form'] = $this->input->post('form');
        $data_file_asesmen['file'] = $filename_asesmen;
        $data_file_asesmen['user_pengunggah'] = $this->session->userdata('username');
        $data_file_asesmen['log'] = $log;
        $this->db->insert('data_file_asesmen', $data_file_asesmen);

        redirect("asesor/asesmen/" . base64_encode($id_izin), "refresh");
    }
    // /Upload File Asesmen Hybrid //

    // Delete File Asesmen Hybrid //
    public function delete_file_asesmen($id_izin, $kode_form)
    {
        ##/Cek Session Login##
        if (!$this->ion_auth->ceklogin()) {
            redirect('login', 'refresh');
        } else if ($this->session->userdata('level') !== 'Asesor') {
            redirect('login/keluar', 'refresh');
        }
        ##/Cek Session Login##
        $id_izin = base64_decode($id_izin);
        $username_login = $this->session->userdata('username');
        $cek_tugas = $this->asesor_model->cek_tugas_asesor($id_izin, $username_login);

        if (!$cek_tugas) {
            show_error('Akses Ditolak. Anda tidak ditugaskan untuk manguji peserta ini.', 403, 'Forbidden');
            return;
        }
        $log = date("Y-m-d H:i:s");

        // Get File Lama
        $get_file_lama = $this->asesor_model->get_file_lama($id_izin, $kode_form);

        // Delete File Lama
        $path = './uploads/file_asesmen/' . $kode_form . '/' . $get_file_lama->file;
        unlink($path);

        $this->db->delete('data_file_asesmen', array('id_izin' => $id_izin, 'kode_form' => $kode_form));

        $this->session->set_flashdata('deleted_file_asesmen', 'Berhasil Menghapus File Asesmen');

        redirect("asesor/asesmen/" . base64_encode($id_izin), "refresh");
    }
    // /Delete File Asesmen Hybrid //

    public function upload_bukti_dokumentasi_asesmen($id_izin)
    {
        ##/Cek Session Login##
        if (!$this->ion_auth->ceklogin()) {
            redirect('login', 'refresh');
        } else if ($this->session->userdata('level') !== 'Asesor') {
            redirect('login/keluar', 'refresh');
        }
        ##/Cek Session Login##
        $id_izin = base64_decode($id_izin);
        $username_login = $this->session->userdata('username');
        $cek_tugas = $this->asesor_model->cek_tugas_asesor($id_izin, $username_login);

        if (!$cek_tugas) {
            show_error('Akses Ditolak. Anda tidak ditugaskan untuk manguji peserta ini.', 403, 'Forbidden');
            return;
        }
        $log = date("Y-m-d H:i:s");

        //config upload file Asesmen
        $comb = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $shfl = str_shuffle($comb);
        $filename_unik_karakter = SUBSTR($shfl, 0, 10);

        $file_name = "bukti_dokumentasi_asesmen-" . md5($filename_unik_karakter) . "_" . date("Y-m-d");
        $config['upload_path'] = FCPATH . 'uploads/file_asesmen/bukti_dokumentasi_asesmen';
        $config['allowed_types'] = 'pdf|jpg|jpeg|png|JPG|JPEG|PNG|PDF';
        $config['file_name'] = $file_name;
        $config['overwrite'] = true;
        $config['max_size'] = 15360; // 10MB

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if ($this->upload->do_upload('file_bukti_dokumentasi_asesmen')) {
            $file_bukti_asesmen = $this->upload->data();
            $filename_bukti_asesmen = $file_bukti_asesmen['file_name'];

            $this->session->set_flashdata('success-upload-bukti', 'Berhasil Menambahkan');
        } else {
            $this->session->set_flashdata('gagal-upload-bukti', 'Gagal Upload File Size Terlalu Besar dari 10 Mb');
            redirect("asesor/asesmen/" . base64_encode($id_izin), "refresh");
        }

        // Insert Data File Asesmen
        $data_bukti_dokumentasi_asesmen['id_izin'] = $id_izin;
        $data_bukti_dokumentasi_asesmen['file'] = $filename_bukti_asesmen;
        $data_bukti_dokumentasi_asesmen['username'] = $this->session->userdata('username');
        $data_bukti_dokumentasi_asesmen['log'] = $log;
        $this->db->insert('data_bukti_dokumentasi_asesmen', $data_bukti_dokumentasi_asesmen);

        redirect("asesor/asesmen/" . base64_encode($id_izin), "refresh");
    }

    public function reset_bukti_dokumentasi_asesmen($id_izin)
    {
        ##/Cek Session Login##
        if (!$this->ion_auth->ceklogin()) {
            redirect('login', 'refresh');
        } else if ($this->session->userdata('level') !== 'Asesor') {
            redirect('login/keluar', 'refresh');
        }

        $id_izin_asli = base64_decode($id_izin);
        $username_login = $this->session->userdata('username');
        $cek_tugas = $this->asesor_model->cek_tugas_asesor($id_izin_asli, $username_login);

        if (!$cek_tugas) {
            show_error('Akses Ditolak. Anda tidak ditugaskan untuk menguji peserta ini.', 403, 'Forbidden');
            return;
        }

        $this->db->where('id_izin', $id_izin_asli);
        $get_files = $this->db->get('data_bukti_dokumentasi_asesmen')->result();

        foreach ($get_files as $file_data) {
            $nama_file = $file_data->file;

            if (!empty($nama_file)) {
                $file_path = FCPATH . 'uploads/file_asesmen/bukti_dokumentasi_asesmen/' . $nama_file;

                if (file_exists($file_path) && !is_dir($file_path)) {
                    unlink($file_path);
                }
            }
        }

        $this->db->where('id_izin', $id_izin_asli);
        $this->db->delete('data_bukti_dokumentasi_asesmen');

        $this->session->set_flashdata('success-reset-bukti', 'Berhasil Reset Bukti Dokumentasi Asesmen beserta Filenya');

        redirect("asesor/asesmen/" . base64_encode($id_izin_asli), "refresh");
    }

    public function rekomendasi_hasil_asesmen($id_izin)
    {
        ##/Cek Session Login##
        if (!$this->ion_auth->ceklogin()) {
            redirect('login', 'refresh');
        } else if ($this->session->userdata('level') !== 'Asesor') {
            redirect('login/keluar', 'refresh');
        }
        ##/Cek Session Login##
        $id_izin = base64_decode($id_izin);
        $username_login = $this->session->userdata('username');
        $cek_tugas = $this->asesor_model->cek_tugas_asesor($id_izin, $username_login);

        if (!$cek_tugas) {
            show_error('Akses Ditolak. Anda tidak ditugaskan untuk manguji peserta ini.', 403, 'Forbidden');
            return;
        }
        $log = date("Y-m-d H:i:s");

        $rekomendasi_hasil_asesmen = array(
            'id_izin' => $id_izin,
            'rekomendasi_asesor' => $this->input->post('rekomendasi_asesor'),
            'catatan' => $this->input->post('catatan_rekomendasi_asesor'),
            'metode_uji' => $this->input->post('metode_uji'),
            'user_pemberi_rekomendasi' => $this->session->userdata('username'),
            'log' => $log,
        );
        $this->db->replace('data_rekomendasi_asesor', $rekomendasi_hasil_asesmen);


        /////////////// Rekomendasi Asesor ke BNSP ///////////////
        $token_bnsp = $this->api_model->get_token_bnsp();
        $get_detail_jadwal_asesmen = $this->asesor_model->get_detail_jadwal_asesmen($id_izin);
        $get_data_personal_pemohon = $this->asesor_model->get_data_personal_pemohon($id_izin);
        $get_ttd_asesor = $this->asesor_model->get_ttd_asesor($id_izin, $this->session->userdata('username'));
        $get_data_rekomendasi_asesor_lpjk = $this->admin_model->get_data_rekomendasi_asesor_lpjk($id_izin);
        $get_bukti_dokumentasi_asesmen = $this->asesor_model->get_bukti_dokumentasi_asesmen($id_izin);

        if ($get_data_rekomendasi_asesor_lpjk->metode_uji == "1") {
            $metode_uji = 'observasi';
            $uji_praktek_atau_observasi_lapangan = '1';
            $uji_tulis = '1';
            $uji_lisan = '0';
            $wawancara = '0';
        } elseif ($get_data_rekomendasi_asesor_lpjk->metode_uji == "2") {
            $metode_uji = 'observasi';
            $uji_praktek_atau_observasi_lapangan = '1';
            $uji_tulis = '1';
            $uji_lisan = '0';
            $wawancara = '0';
        } elseif ($get_data_rekomendasi_asesor_lpjk->metode_uji == "3") {
            $metode_uji = 'portofolio';
            $uji_praktek_atau_observasi_lapangan = '0';
            $uji_tulis = '0';
            $uji_lisan = '0';
            $wawancara = '1';
        }

        if ($get_ttd_asesor->asesor == '1') {
            //API Url
            $url = $token_bnsp->host . "jadwal/peserta/hasil-uji";

            //Initiate cURL.
            $ch = curl_init($url);

            if ($this->input->post('rekomendasi_asesor') == "Kompeten") {
                $rekomendasi_asesor = "1";
            } elseif ($this->input->post('rekomendasi_asesor') == "Belum Kompeten") {
                $rekomendasi_asesor = "2";
            }

            //The JSON data.
            $jsonData = array(
                "jadwal_id" => $get_detail_jadwal_asesmen->id_jadwal_asesmen,
                "nik_peserta" => $get_data_personal_pemohon->nik,
                "kompeten" => $rekomendasi_asesor,
                "metode_uji" => $metode_uji,
                "uji_praktek_atau_observasi_lapangan" => $uji_praktek_atau_observasi_lapangan,
                "uji_tulis" => $uji_tulis,
                "uji_lisan" => $uji_lisan,
                "wawancara" => $wawancara,
                "penyelenggara" => 1,
                "apl_01" => base_url("cetak_form_asesmen/apl01/") . base64_encode($id_izin),
                "apl_02" => base_url("cetak_form_asesmen/apl02/") . base64_encode($id_izin),
                "url_dokumentasi_asesmen" => base_url("uploads/file_asesmen/bukti_dokumentasi_asesmen/") . $get_bukti_dokumentasi_asesmen->file
            );

            //Encode the array into JSON.
            $jsonDataEncoded = json_encode($jsonData);

            //Tell cURL that we want to send a POST request.
            curl_setopt($ch, CURLOPT_POST, 1);

            //Attach our encoded JSON string to the POST fields.
            curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonDataEncoded);

            //Set the content type to application/json
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'x-authorization:' . $token_bnsp->x_authorization,
                'token:' . $token_bnsp->x_authorization
            ));

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

            //Execute the request
            $result = curl_exec($ch);
            ///////////// / Rekomendasi Asesor ke BNSP ////////////
            // print_r($result);
        }

        redirect("asesor/list_tugas_asesmen", "refresh");
    }

    public function cetak_berita_acara_rekomendasi_asesor($id_izin)
    {
        ##/Cek Session Login##
        if (!$this->ion_auth->ceklogin()) {
            redirect('login', 'refresh');
        } else if ($this->session->userdata('level') !== 'Asesor') {
            redirect('login/keluar', 'refresh');
        }
        ##/Cek Session Login##
        $id_izin = base64_decode($id_izin);
        $username_login = $this->session->userdata('username');
        $cek_tugas = $this->asesor_model->cek_tugas_asesor($id_izin, $username_login);

        if (!$cek_tugas) {
            show_error('Akses Ditolak. Anda tidak ditugaskan untuk manguji peserta ini.', 403, 'Forbidden');
            return;
        }
        $token = $this->api_model->get_token();

        $file_pdf = 'Berita Acara Rekomendasi Aseesor - ' . $id_izin;
        $paper = 'A4';
        $orientation = "potrait";
        $page = 'Asesor/cetak_berita_acara_rekomendasi_asesor';

        #Get Data Surat Tugas
        $get_data_rekomendasi_asesor = $this->asesor_model->get_data_rekomendasi_asesor($id_izin);
        $get_data_jadwal_asesmen = $this->asesor_model->get_detail_jadwal_asesmen($id_izin);

        $data = array(
            'id_izin' => $id_izin,
            'get_data_rekomendasi_asesor' => $get_data_rekomendasi_asesor,
            'get_data_jadwal_asesmen' => $get_data_jadwal_asesmen,
            'token' => $token,
        );

        // $this->load->view($page, $data);
        $html = $this->load->view($page, $data, true);
        $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }

    ########### Mapa 01 #################
    public function form_mapa01($id_izin)
    {
        ##/Cek Session Login##
        if (!$this->ion_auth->ceklogin()) {
            redirect('login', 'refresh');
        } else if ($this->session->userdata('level') !== 'Asesor') {
            redirect('login/keluar', 'refresh');
        }
        ##/Cek Session Login##
        $id_izin = base64_decode($id_izin);
        $username_login = $this->session->userdata('username');
        $cek_tugas = $this->asesor_model->cek_tugas_asesor($id_izin, $username_login);

        if (!$cek_tugas) {
            show_error('Akses Ditolak. Anda tidak ditugaskan untuk manguji peserta ini.', 403, 'Forbidden');
            return;
        }

        # Get Data Master Model
        $get_master_unit_kompetensi = $this->master_model->get_master_unit_kompetensi();
        $get_master_elemen_kompetensi = $this->master_model->get_master_elemen_kompetensi();
        $get_master_kriteria_unjuk_kerja = $this->master_model->get_master_kriteria_unjuk_kerja();

        # Get Data
        $get_data_klasifikasi_kualifikasi = $this->asesor_model->get_data_klasifikasi_kualifikasi($id_izin);
        $get_data_mapa01 = $this->asesor_model->get_data_mapa01($id_izin);
        $get_ceklis_mapa01 = $this->asesor_model->get_ceklis_mapa01($id_izin);


        $this->data = array(
            'username' => $this->session->userdata('username'),
            'level' => $this->session->userdata('level'),
            'id_izin' => $id_izin,
            'get_master_unit_kompetensi' => $get_master_unit_kompetensi,
            'get_master_elemen_kompetensi' => $get_master_elemen_kompetensi,
            'get_master_kriteria_unjuk_kerja' => $get_master_kriteria_unjuk_kerja,
            'get_data_klasifikasi_kualifikasi' => $get_data_klasifikasi_kualifikasi,
            'get_data_mapa01' => $get_data_mapa01,
            'get_ceklis_mapa01' => $get_ceklis_mapa01,
        );
        $this->template->load('menu', 'Asesor/asesmen/mapa01', $this->data);
    }

    public function insert_data_mapa01($id_izin)
    {
        ##/Cek Session Login##
        if (!$this->ion_auth->ceklogin()) {
            redirect('login', 'refresh');
        } else if ($this->session->userdata('level') !== 'Asesor') {
            redirect('login/keluar', 'refresh');
        }
        ##/Cek Session Login##
        $id_izin = base64_decode($id_izin);
        $username_login = $this->session->userdata('username');
        $cek_tugas = $this->asesor_model->cek_tugas_asesor($id_izin, $username_login);

        if (!$cek_tugas) {
            show_error('Akses Ditolak. Anda tidak ditugaskan untuk manguji peserta ini.', 403, 'Forbidden');
            return;
        }
        $log = date("Y-m-d H:i:s");


        //////////////////// Insert Data Mapa 01 /////////////////////////////
        # Switch input
        if ($this->input->post('bukti_untuk_mendukung_asesmen') == '1') {
            $bukti_untuk_mendukung_asesmen = '1';
        } else {
            $bukti_untuk_mendukung_asesmen = '0';
        }

        if ($this->input->post('aktivitas_kerja_ditempat_kerja_asesi') == '1') {
            $aktivitas_kerja_ditempat_kerja_asesi = '1';
        } else {
            $aktivitas_kerja_ditempat_kerja_asesi = '0';
        }

        if ($this->input->post('kegiatan_pembelajaran') == '1') {
            $kegiatan_pembelajaran = '1';
        } else {
            $kegiatan_pembelajaran = '0';
        }

        if ($this->input->post('konfirmasi_manajer_sertifikasi_lsp') == '1') {
            $konfirmasi_manajer_sertifikasi_lsp = '1';
        } else {
            $konfirmasi_manajer_sertifikasi_lsp = '0';
        }

        if ($this->input->post('konfirmasi_master_asesor_kompetensi') == '1') {
            $konfirmasi_master_asesor_kompetensi = '1';
        } else {
            $konfirmasi_master_asesor_kompetensi = '0';
        }

        if ($this->input->post('konfirmasi_manajer_pelatihan_lembaga_training_terakreditas') == '1') {
            $konfirmasi_manajer_pelatihan_lembaga_training_terakreditas = '1';
        } else {
            $konfirmasi_manajer_pelatihan_lembaga_training_terakreditas = '0';
        }
        # /Switch input


        $data_mapa01 = array(
            'id_izin' => $id_izin,
            'kandidat' => $this->input->post('kandidat'),
            'tujuan_asesmen' => $this->input->post('tujuan_asesmen'),
            'lingkungan' => $this->input->post('lingkungan'),
            'peluang_untuk_mengumpulkan_bukti' => $this->input->post('peluang_untuk_mengumpulkan_bukti'),
            'siapa_yang_melakukan_asesmen' => $this->input->post('siapa_yang_melakukan_asesmen'),
            'tolak_ukur_asesmen' => $this->input->post('tolak_ukur_asesmen'),
            'bukti_untuk_mendukung_asesmen' => $bukti_untuk_mendukung_asesmen,
            'aktivitas_kerja_ditempat_kerja_asesi' => $aktivitas_kerja_ditempat_kerja_asesi,
            'kegiatan_pembelajaran' => $kegiatan_pembelajaran,
            'konfirmasi_manajer_sertifikasi_lsp' => $konfirmasi_manajer_sertifikasi_lsp,
            'konfirmasi_master_asesor_kompetensi' => $konfirmasi_master_asesor_kompetensi,
            'konfirmasi_manajer_pelatihan_lembaga_training_terakreditas' => $konfirmasi_manajer_pelatihan_lembaga_training_terakreditas,
            'asesor_penilai' => $this->session->userdata('username'),
            'log' => $log,
        );
        $this->db->replace('data_mapa01', $data_mapa01);
        //////////////////// / Insert Data Mapa 01 /////////////////////////////

        //////////////////// Insert Ceklis Mapa 01 /////////////////////////////
        # Get Data Master Model
        $get_master_unit_kompetensi = $this->master_model->get_master_unit_kompetensi();
        $get_master_elemen_kompetensi = $this->master_model->get_master_elemen_kompetensi();
        $get_master_kriteria_unjuk_kerja = $this->master_model->get_master_kriteria_unjuk_kerja();

        # Get Data Kualifikasi Klasifikasi / Permohonan
        $get_data_klasifikasi_kualifikasi = $this->asesor_model->get_data_klasifikasi_kualifikasi($id_izin);

        foreach ($get_master_unit_kompetensi as $master_unit_kompetensi) {
            if ($master_unit_kompetensi['kode_jabker'] == $get_data_klasifikasi_kualifikasi->jabatan_kerja) {

                foreach ($get_master_elemen_kompetensi as $master_elemen_kompetensi) {
                    if ($master_elemen_kompetensi['kode_unit_kompetensi'] == $master_unit_kompetensi['kode_unit_kompetensi']) {

                        foreach ($get_master_kriteria_unjuk_kerja as $master_kriteria_unjuk_kerja) {
                            if ($master_kriteria_unjuk_kerja['kode_elemen_kompetensi'] == $master_elemen_kompetensi['kode_elemen_kompetensi']) {

                                #Clear Data agar bisa di jadikan name untuk parameter
                                $kode_kuk_clear = str_replace(".", "", $master_kriteria_unjuk_kerja['kode_kuk']);

                                $ceklis_mapa01 = array(
                                    'id_izin' => $id_izin,
                                    'kode_kuk' => $master_kriteria_unjuk_kerja['kode_kuk'],
                                    'bukti_bukti_mapa01' => $this->input->post('bukti_bukti_mapa01-' . $kode_kuk_clear),
                                    'jenis_bukti' => $this->input->post('jenis_bukti-' . $kode_kuk_clear),
                                    'observasi_langsung' => $this->input->post('observasi_langsung-' . $kode_kuk_clear),
                                    'kegiatan_terstruktur' => $this->input->post('kegiatan_terstruktur-' . $kode_kuk_clear),
                                    'tanya_jawab' => $this->input->post('tanya_jawab-' . $kode_kuk_clear),
                                    'verifikasi_portofolio' => $this->input->post('verifikasi_portofolio-' . $kode_kuk_clear),
                                    'review_produk' => $this->input->post('review_produk-' . $kode_kuk_clear),
                                    'log' => $log,
                                );
                                $this->db->replace('ceklis_mapa01', $ceklis_mapa01);
                            }
                        }

                    }
                }

            }
        }

        //////////////////// /Insert Ceklis Mapa 01 /////////////////////////////
        // Sweet Alert
        $this->session->set_flashdata('success', 'Save Mapa 02');
        redirect("asesor/form_mapa01/" . base64_encode($id_izin), "refresh");
    }
    ########### / Mapa 01 #################
    ########### / Mapa 02 #################
    public function form_mapa02($id_izin)
    {
        ##/Cek Session Login##
        if (!$this->ion_auth->ceklogin()) {
            redirect('login', 'refresh');
        } else if ($this->session->userdata('level') !== 'Asesor') {
            redirect('login/keluar', 'refresh');
        }
        ##/Cek Session Login##
        $id_izin = base64_decode($id_izin);
        $username_login = $this->session->userdata('username');
        $cek_tugas = $this->asesor_model->cek_tugas_asesor($id_izin, $username_login);

        if (!$cek_tugas) {
            show_error('Akses Ditolak. Anda tidak ditugaskan untuk manguji peserta ini.', 403, 'Forbidden');
            return;
        }

        # Get Data Master Model
        $get_master_unit_kompetensi = $this->master_model->get_master_unit_kompetensi();
        $get_master_muk = $this->master_model->get_master_muk();

        # Get Data
        $get_data_klasifikasi_kualifikasi = $this->asesor_model->get_data_klasifikasi_kualifikasi($id_izin);
        $get_data_mapa02 = $this->asesor_model->get_data_mapa02($id_izin);

        $this->data = array(
            'username' => $this->session->userdata('username'),
            'level' => $this->session->userdata('level'),
            'id_izin' => $id_izin,
            'get_master_unit_kompetensi' => $get_master_unit_kompetensi,
            'get_master_muk' => $get_master_muk,
            'get_data_klasifikasi_kualifikasi' => $get_data_klasifikasi_kualifikasi,
            'get_data_mapa02' => $get_data_mapa02,
        );
        $this->template->load('menu', 'Asesor/asesmen/mapa02', $this->data);
    }

    public function insert_data_mapa02($id_izin)
    {
        ##/Cek Session Login##
        if (!$this->ion_auth->ceklogin()) {
            redirect('login', 'refresh');
        } else if ($this->session->userdata('level') !== 'Asesor') {
            redirect('login/keluar', 'refresh');
        }
        ##/Cek Session Login##
        $id_izin = base64_decode($id_izin);
        $username_login = $this->session->userdata('username');
        $cek_tugas = $this->asesor_model->cek_tugas_asesor($id_izin, $username_login);

        if (!$cek_tugas) {
            show_error('Akses Ditolak. Anda tidak ditugaskan untuk manguji peserta ini.', 403, 'Forbidden');
            return;
        }
        $log = date("Y-m-d H:i:s");

        # Get Data Master Model
        $get_master_unit_kompetensi = $this->master_model->get_master_unit_kompetensi();
        $get_master_muk = $this->master_model->get_master_muk();

        # Get Data Kualifikasi Klasifikasi / Permohonan
        $get_data_klasifikasi_kualifikasi = $this->asesor_model->get_data_klasifikasi_kualifikasi($id_izin);

        foreach ($get_master_unit_kompetensi as $master_unit_kompetensi) {
            if ($master_unit_kompetensi['kode_jabker'] == $get_data_klasifikasi_kualifikasi->jabatan_kerja) {

                foreach ($get_master_muk as $master_muk) {
                    if ($master_muk['kode_unit_kompetensi'] == $master_unit_kompetensi['kode_unit_kompetensi']) {

                        // Membersihkan untuk variabel input
                        $kode_muk_clear = str_replace(".", "", $master_muk['kode_muk']);

                        $ceklis_mapa01 = array(
                            'id_izin' => $id_izin,
                            'kode_muk' => $master_muk['kode_muk'],
                            'potensi' => $this->input->post('potensi-' . $kode_muk_clear),
                            'user_penilai' => $this->session->userdata('username'),
                            'log' => $log,
                        );
                        $this->db->replace('ceklis_mapa02', $ceklis_mapa01);

                    }
                }
            }
        }

        // Sweet Alert
        $this->session->set_flashdata('success', 'Save Mapa 02');
        redirect("asesor/form_mapa02/" . base64_encode($id_izin), "refresh");
    }
    ########### / Mapa 02 #################

    ########### / FR AK 01 #################
    public function form_ak01($id_izin)
    {
        ##/Cek Session Login##
        if (!$this->ion_auth->ceklogin()) {
            redirect('login', 'refresh');
        } else if ($this->session->userdata('level') !== 'Asesor') {
            redirect('login/keluar', 'refresh');
        }
        ##/Cek Session Login##
        $id_izin = base64_decode($id_izin);
        $username_login = $this->session->userdata('username');
        $cek_tugas = $this->asesor_model->cek_tugas_asesor($id_izin, $username_login);

        if (!$cek_tugas) {
            show_error('Akses Ditolak. Anda tidak ditugaskan untuk manguji peserta ini.', 403, 'Forbidden');
            return;
        }

        # Get Data Master Model
        $get_master_unit_kompetensi = $this->master_model->get_master_unit_kompetensi();
        $get_master_muk = $this->master_model->get_master_muk();

        # Get Data
        $get_data_klasifikasi_kualifikasi = $this->asesor_model->get_data_klasifikasi_kualifikasi($id_izin);
        $get_data_mapa02 = $this->asesor_model->get_data_mapa02($id_izin);

        $this->data = array(
            'username' => $this->session->userdata('username'),
            'level' => $this->session->userdata('level'),
            'id_izin' => $id_izin,
            'get_master_unit_kompetensi' => $get_master_unit_kompetensi,
            'get_master_muk' => $get_master_muk,
            'get_data_klasifikasi_kualifikasi' => $get_data_klasifikasi_kualifikasi,
            'get_data_mapa02' => $get_data_mapa02,
        );
        $this->template->load('menu', 'Asesor/asesmen/ak01', $this->data);
    }
    ########### / FR AK 01 #################
}