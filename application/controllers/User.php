<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url', 'html', 'file', 'form', 'security'));
        $this->load->library(array('form_validation', 'pdfgenerator', 'system'));
        ## GET Model Admin Model
        $this->load->model('pemohon_model');
        $this->load->model('admin_model');
        $this->load->model('master_model');
        $this->load->model('api_model');
        ## GET Model Admin Model
        date_default_timezone_set('Asia/Jakarta');
    }
    public function index()
    {
        ##/Cek Session Login##
        if (!$this->ion_auth->ceklogin()) {
            redirect('login', 'refresh');
        } else if ($this->session->userdata('level') !== 'User') {
            redirect('login/keluar', 'refresh');
        }
        ##/Cek Session Login##

        $this->data = array(
            'username' => $this->session->userdata('username'),
            'level' => $this->session->userdata('level'),
        );
        $this->template->load('menu', 'User/dashboard', $this->data);
    }

    public function permohonan_skk()
    {
        ##/Cek Session Login##
        if (!$this->ion_auth->ceklogin()) {
            redirect('login', 'refresh');
        } else if ($this->session->userdata('level') !== 'User') {
            redirect('login/keluar', 'refresh');
        }
        ##/Cek Session Login##
        $get_data_permohonan = $this->pemohon_model->list_permohonan_skk($this->session->userdata('nik'));

        $this->data = array(
            'username' => $this->session->userdata('username'),
            'level' => $this->session->userdata('level'),
            'get_data_permohonan' => $get_data_permohonan,
        );
        $this->template->load('menu', 'User/permohonan_skk', $this->data);
    }

    ######################## APL 01 ######################################
    ## View APL 01
    public function formulir_apl01($id_izin)
    {
        ##/Cek Session Login##
        if (!$this->ion_auth->ceklogin()) {
            redirect('login', 'refresh');
        } else if ($this->session->userdata('level') !== 'User') {
            redirect('login/keluar', 'refresh');
        }
        ##/Cek Session Login##
        $id_izin = base64_decode($id_izin);
        $nik_login = $this->session->userdata('nik');

        $cek_personal = $this->pemohon_model->get_data_personal_permohonan($id_izin);

        if (!$cek_personal || $cek_personal->nik !== $nik_login) {
            show_error('Anda tidak memiliki izin untuk melihat halaman ini.', 403, 'Akses Ditolak');
            return;
        }

        $get_data_apl01 = $this->pemohon_model->get_data_apl01($id_izin);
        $get_master_pekerjaan = $this->master_model->get_master_pekerjaan();

        $this->data = array(
            'username' => $this->session->userdata('username'),
            'level' => $this->session->userdata('level'),
            'get_data_apl01' => $get_data_apl01,
            'get_master_pekerjaan' => $get_master_pekerjaan,
        );
        $this->template->load('menu', 'User/apl/apl01', $this->data);
    }

    # Insert Data Pekerjaan Sekarang APL01
    public function insert_pekerjaan_sekarang_apl01($id_izin)
    {
        if (!$this->ion_auth->ceklogin()) {
            redirect('login', 'refresh');
        } else if ($this->session->userdata('level') !== 'User') {
            redirect('login/keluar', 'refresh');
        }
        ##/Cek Session Login##
        $id_izin = base64_decode($id_izin);
        $nik_login = $this->session->userdata('nik');

        $cek_personal = $this->pemohon_model->get_data_personal_permohonan($id_izin);
        if (!$cek_personal || $cek_personal->nik !== $nik_login) {
            show_error('Anda tidak memiliki akses untuk mengubah data ini.', 403, 'Akses Ditolak');
            return;
        }

        #Get Data Apl
        $get_data_apl01 = $this->pemohon_model->get_data_apl01($id_izin);

        $data = array(
            'id_izin' => $id_izin,
            'pekerjaan_sekarang_perusahaan' => str_replace(['"', '<', '>'], '', strip_tags($this->input->post('perusahaan', FALSE))),
            'pekerjaan_sekarang_jabatan' => str_replace(['"', '<', '>'], '', strip_tags($this->input->post('jabatan', FALSE))),
            'id_pekerjaan' => str_replace(['"', '<', '>'], '', strip_tags($this->input->post('id_pekerjaan', FALSE))),
            'pekerjaan_sekarang_alamat_kantor' => str_replace(['"', '<', '>'], '', strip_tags($this->input->post('alamat_kantor', FALSE))),
            'pekerjaan_sekarang_kodepos_kantor' => str_replace(['"', '<', '>'], '', strip_tags($this->input->post('kodepos_kantor', FALSE))),
            'pekerjaan_sekarang_notlp_kantor' => str_replace(['"', '<', '>'], '', strip_tags($this->input->post('telepon_kantor', FALSE))),
            'pekerjaan_sekarang_fax_kantor' => str_replace(['"', '<', '>'], '', strip_tags($this->input->post('fax_kantor', FALSE))),
            'pekerjaan_sekarang_email_kantor' => str_replace(['"', '<', '>'], '', strip_tags($this->input->post('email_kantor', FALSE))),
        );

        $where = array(
            'id_izin' => $id_izin
        );

        $this->pemohon_model->update_data($where, $data, 'data_apl01_permohonan');
        redirect("User/formulir_apl01/" . base64_encode($id_izin), "refresh");
        redirect("User/formulir_apl01/" . base64_encode($id_izin));
    }

    public function insert_signature_apl01($id_izin)
    {

        $id_izin = base64_decode($id_izin);
        $img_post = $this->input->post('image', FALSE);

        if (empty($img_post)) {
            echo json_encode(['status' => false, 'message' => 'Goresan tanda tangan kosong!']);
            return;
        }

        $image_parts = explode(";base64,", $img_post);
        if (count($image_parts) != 2) {
            echo json_encode(['status' => false, 'message' => 'Format gambar tanda tangan tidak valid!']);
            return;
        }

        $image_base64 = base64_decode($image_parts[1]);

        $filename = 'ttd_apl01_apl02_' . md5($id_izin) . '_' . time() . '.png';
        $file_path = './uploads/file_permohonan/ttd_pemohon_apl01_apl02/' . $filename;

        $simpan_file = file_put_contents($file_path, $image_base64);

        if ($simpan_file) {
            $update_data = array(
                'ttd_pemohon' => $filename,
                'tanggal_ttd_pemohon' => date("Y-m-d H:i:s")
            );

            $where = array(
                'id_izin' => $id_izin
            );

            $this->pemohon_model->update_data($where, $update_data, 'data_apl01_permohonan');

            echo json_encode(['status' => true, 'message' => 'Tanda tangan berhasil disimpan!']);
        } else {
            echo json_encode(['status' => false, 'message' => 'Gagal menyimpan file ke direktori server.']);
        }
        redirect("User/formulir_apl01/" . base64_encode($id_izin), "refresh");
        redirect("User/formulir_apl01/" . base64_encode($id_izin));
    }

    public function print_apl01($id_izin)
    {
        if (!$this->ion_auth->ceklogin()) {
            redirect('login', 'refresh');
        } else if ($this->session->userdata('level') !== 'User') {
            redirect('login/keluar', 'refresh');
        }
        ##/Cek Session Login##
        $id_izin = base64_decode($id_izin);
        $nik_login = $this->session->userdata('nik');

        $cek_personal = $this->pemohon_model->get_data_personal_permohonan($id_izin);
        if (!$cek_personal || $cek_personal->nik !== $nik_login) {
            show_error('Anda tidak memiliki akses untuk mengubah data ini.', 403, 'Akses Ditolak');
            return;
        }

        $get_data_apl01 = $this->pemohon_model->get_data_apl01($id_izin);
        $get_data_personal_permohonan = $this->pemohon_model->get_data_personal_permohonan($id_izin);
        $get_data_pendidikan_permohonan = $this->pemohon_model->get_data_pendidikan_permohonan($id_izin);
        $data_pendidikan_yang_sudah_dipilih = $this->pemohon_model->data_pendidikan_yang_sudah_dipilih($id_izin);
        $get_data_unit_kompetensi = $this->pemohon_model->get_data_unit_kompetensi($id_izin);
        $get_data_klasifikasi_kualifikasi = $this->pemohon_model->get_data_klasifikasi_kualifikasi($id_izin);

        #Get Data Apl
        $get_data_pendidikan_yang_sesuai = $this->pemohon_model->get_data_pendidikan_yang_sesuai($id_izin);

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
            'data_pendidikan_yang_sudah_dipilih' => $data_pendidikan_yang_sudah_dipilih,
        );

        $file_pdf = 'Formulir Apl.01';
        $paper = 'A4';
        $orientation = "potrait";
        $page = 'user/apl/cetak_apl01';

        // $this->load->view($page, $data);
        $html = $this->load->view($page, $data, true);
        $this->pdfgenerator->generate($html, $file_pdf, $paper, $orientation);
    }

    ######################## /APL 01 ######################################
######################## APL 02 ######################################

    ## View APL 02
    public function formulir_apl02($id_izin)
    {
        ##/Cek Session Login##
        if (!$this->ion_auth->ceklogin()) {
            redirect('login', 'refresh');
        } else if ($this->session->userdata('level') !== 'User') {
            redirect('login/keluar', 'refresh');
        }
        ##/Cek Session Login##
        $id_izin = base64_decode($id_izin);
        $nik_login = $this->session->userdata('nik');

        $cek_personal = $this->pemohon_model->get_data_personal_permohonan($id_izin);
        if (!$cek_personal || $cek_personal->nik !== $nik_login) {
            show_error('Anda tidak memiliki akses untuk mengubah data ini.', 403, 'Akses Ditolak');
            return;
        }

        # Get Data Master Model
        $get_master_unit_kompetensi = $this->master_model->get_master_unit_kompetensi();
        $get_master_elemen_kompetensi = $this->master_model->get_master_elemen_kompetensi();
        $get_master_kriteria_unjuk_kerja = $this->master_model->get_master_kriteria_unjuk_kerja();

        # Get Data Kualifikasi Klasifikasi / Permohonan
        $get_data_klasifikasi_kualifikasi = $this->pemohon_model->get_data_klasifikasi_kualifikasi($id_izin);

        # Get Data Apl-02
        $get_data_apl02 = $this->pemohon_model->get_data_apl02($id_izin);
        $get_bukti_relavan_apl02 = $this->pemohon_model->get_bukti_relavan_apl02($id_izin);

        $this->data = array(
            'username' => $this->session->userdata('username'),
            'level' => $this->session->userdata('level'),
            'id_izin' => $id_izin,
            'get_data_klasifikasi_kualifikasi' => $get_data_klasifikasi_kualifikasi,
            'get_master_unit_kompetensi' => $get_master_unit_kompetensi,
            'get_master_elemen_kompetensi' => $get_master_elemen_kompetensi,
            'get_master_kriteria_unjuk_kerja' => $get_master_kriteria_unjuk_kerja,
            'get_data_apl02' => $get_data_apl02,
            'get_bukti_relavan_apl02' => $get_bukti_relavan_apl02,
        );
        $this->template->load('menu', 'User/apl/apl02', $this->data);
    }

    public function save_data_apl02($id_izin)
    {
        ##/Cek Session Login##
        if (!$this->ion_auth->ceklogin()) {
            redirect('login', 'refresh');
        } else if ($this->session->userdata('level') !== 'User') {
            redirect('login/keluar', 'refresh');
        }
        ##/Cek Session Login##
        $id_izin = base64_decode($id_izin);
        $nik_login = $this->session->userdata('nik');

        $cek_personal = $this->pemohon_model->get_data_personal_permohonan($id_izin);
        if (!$cek_personal || $cek_personal->nik !== $nik_login) {
            show_error('Anda tidak memiliki akses untuk mengubah data ini.', 403, 'Akses Ditolak');
            return;
        }
        $log = date("Y-m-d H:i:s");

        # Get Data Master Model
        $get_master_unit_kompetensi = $this->master_model->get_master_unit_kompetensi();
        $get_master_elemen_kompetensi = $this->master_model->get_master_elemen_kompetensi();
        $get_master_kriteria_unjuk_kerja = $this->master_model->get_master_kriteria_unjuk_kerja();

        # Get Data Kualifikasi Klasifikasi / Permohonan
        $get_data_klasifikasi_kualifikasi = $this->pemohon_model->get_data_klasifikasi_kualifikasi($id_izin);

        foreach ($get_master_unit_kompetensi as $master_unit_kompetensi) {
            if ($master_unit_kompetensi['kode_jabker'] == $get_data_klasifikasi_kualifikasi->jabatan_kerja) {

                foreach ($get_master_elemen_kompetensi as $master_elemen_kompetensi) {
                    if ($master_elemen_kompetensi['kode_unit_kompetensi'] == $master_unit_kompetensi['kode_unit_kompetensi']) {

                        foreach ($get_master_kriteria_unjuk_kerja as $master_kriteria_unjuk_kerja) {
                            if ($master_kriteria_unjuk_kerja['kode_elemen_kompetensi'] == $master_elemen_kompetensi['kode_elemen_kompetensi']) {

                                #Clear Data agar bisa di jadikan name untuk parameter
                                $kode_kuk_clear = str_replace(".", "", $master_kriteria_unjuk_kerja['kode_kuk']);

                                if ($this->input->post('status_' . $kode_kuk_clear) == 1) {
                                    $status_kuk = '1';
                                } else {
                                    $status_kuk = '0';
                                }

                                $data_pekerjaan_sekarang = array(
                                    'id_izin' => $id_izin,
                                    'kode_kuk' => $master_kriteria_unjuk_kerja['kode_kuk'],
                                    'status' => $status_kuk,
                                    'bukti_relavan' => $this->input->post('bukti_relavan_' . $kode_kuk_clear),
                                    'log' => $log,
                                );
                                $this->db->replace('data_apl02_permohonan', $data_pekerjaan_sekarang);

                                // Sweet Alert
                                $this->session->set_flashdata('success', 'Save Apl 02');
                            }
                        }

                    }
                }

            }
        }

        redirect("User/formulir_apl02/" . base64_encode($id_izin), "refresh");
        redirect("User/formulir_apl02/" . base64_encode($id_izin));
    }

    public function bukti_relavan_apl02($id_izin)
    {
        ##/Cek Session Login##
        if (!$this->ion_auth->ceklogin()) {
            redirect('login', 'refresh');
        } else if ($this->session->userdata('level') !== 'User') {
            redirect('login/keluar', 'refresh');
        }
        ##/Cek Session Login##
        $id_izin = base64_decode($id_izin);
        $nik_login = $this->session->userdata('nik');

        $cek_personal = $this->pemohon_model->get_data_personal_permohonan($id_izin);

        if (!$cek_personal || $cek_personal->nik !== $nik_login) {
            show_error('Anda tidak memiliki izin untuk melihat halaman ini.', 403, 'Akses Ditolak');
            return;
        }

        #Get Data APl02
        $get_bukti_relavan_apl02 = $this->pemohon_model->get_bukti_relavan_apl02($id_izin);

        $this->data = array(
            'username' => $this->session->userdata('username'),
            'level' => $this->session->userdata('level'),
            'id_izin' => $id_izin,
            'get_bukti_relavan_apl02' => $get_bukti_relavan_apl02,
        );
        $this->template->load('menu', 'User/apl/bukti_relavan_apl02', $this->data);
    }

    public function save_bukti_relavan_apl02($id_izin)
    {
        ##/Cek Session Login##
        if (!$this->ion_auth->ceklogin()) {
            redirect('login', 'refresh');
        } else if ($this->session->userdata('level') !== 'User') {
            redirect('login/keluar', 'refresh');
        }
        ##/Cek Session Login##
        $id_izin = base64_decode($id_izin);
        $nik_login = $this->session->userdata('nik');
        $log = date("Y-m-d H:i:s");

        $cek_personal = $this->pemohon_model->get_data_personal_permohonan($id_izin);
        if (!$cek_personal || $cek_personal->nik !== $nik_login) {
            show_error('Anda tidak memiliki akses untuk mengubah data ini.', 403, 'Akses Ditolak');
            return;
        }

        $nama_bukti = str_replace(['"', '<', '>'], '', strip_tags($this->input->post('nama_bukti', FALSE)));

        //config upload
        $comb = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $shfl = str_shuffle($comb);
        $filename_unik_karakter = SUBSTR($shfl, 0, 10);

        $file_name = "bukti_relavan_" . $nama_bukti . "_" . md5($nama_bukti . "_" . $id_izin . $filename_unik_karakter) . "_" . date("Y-m-d");
        $config['upload_path'] = FCPATH . 'uploads/file_permohonan/bukti_apl02/';
        $config['allowed_types'] = 'jpg|jpeg|png|pdf';
        $config['file_name'] = $file_name;
        $config['overwrite'] = true;
        $config['max_size'] = 10240; // 10MB

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if ($this->upload->do_upload("file_bukti")) {
            $file_bukti = $this->upload->data();
            $filename_bukti = $file_bukti['file_name'];

            // Insert Data Bukti Relavan
            $data_bukti_relavan['id_izin'] = $id_izin;
            $data_bukti_relavan['nama_bukti'] = $nama_bukti;
            $data_bukti_relavan['file_bukti'] = $filename_bukti;
            $data_bukti_relavan['log'] = $log;
            $this->db->insert('bukti_relavan_apl02_permohonan', $data_bukti_relavan);

            $this->session->set_flashdata('success', 'Berhasil Menambahkan');

        } else {
            $this->session->set_flashdata('gagal', 'Gagal Upload File Size Terlalu Besar dari 10 Mb');
        }

        redirect("User/bukti_relavan_apl02/" . base64_encode($id_izin), "refresh");
    }

    public function delete_bukti_relavan_apl02($id_bukti, $id_izin)
    {
        ##/Cek Session Login##
        if (!$this->ion_auth->ceklogin()) {
            redirect('login', 'refresh');
        } else if ($this->session->userdata('level') !== 'User') {
            redirect('login/keluar', 'refresh');
        }
        ##/Cek Session Login##
        $id_izin = base64_decode($id_izin);
        $id_izin = base64_decode($id_izin);
        $nik_login = $this->session->userdata('nik');

        $cek_personal = $this->pemohon_model->get_data_personal_permohonan($id_izin);
        if (!$cek_personal || $cek_personal->nik !== $nik_login) {
            show_error('Anda tidak memiliki akses untuk mengubah data ini.', 403, 'Akses Ditolak');
            return;
        }

        #Get Data Bukti Relavan
        $get_bukti_relavan_apl02 = $this->pemohon_model->get_bukti_relavan_apl02($id_izin);

        #Delete Data Bukti Relavan
        $this->db->delete('bukti_relavan_apl02_permohonan', array('id' => $id_bukti));

        foreach ($get_bukti_relavan_apl02 as $bukti_relavan_apl02) {
            if ($bukti_relavan_apl02['id'] == $id_bukti) {
                #Delete File Bukti Relavan
                unlink('./uploads/file_permohonan/bukti_apl02/' . $bukti_relavan_apl02['file_bukti']);
            } else {
                echo '';
            }
        }

        redirect("User/bukti_relavan_apl02/" . base64_encode($id_izin), "refresh");

    }

    // public function update_bukti_relavan_apl02($id_bukti,$id_izin){
    //     ##/Cek Session Login##
    //     if (!$this->ion_auth->ceklogin()){
    //         redirect('login','refresh');
    //     }else if($this->session->userdata('level') !== 'User'){
    //         redirect('login/keluar','refresh');
    //     }
    //     ##/Cek Session Login##
    //     $id_izin = base64_decode($id_izin);
    // }

    ######################## / APL 02 ######################################
####################### Pra-Asesment ###################################

    public function kirim_pra_asesment($id_izin)
    {
        $id_izin = base64_decode($id_izin);

        // Insert Log History Kirim Pra-Asesment
        $penunjukan_asesor['id_izin'] = $id_izin;
        $penunjukan_asesor['kode_status'] = "12";
        $penunjukan_asesor['log'] = date("Y-m-d H:i:s");
        $penunjukan_asesor['username'] = $this->session->userdata('username');
        $this->pemohon_model->insert_log_history_permohonan($penunjukan_asesor);

        redirect("User/permohonan_skk/", "refresh");
    }

    ##################### /Pra-Asesment #################################

    public function perbaikan_data_pendidikan_permohonan()
    {
        ##/Cek Session Login##
        if (!$this->ion_auth->ceklogin()) {
            redirect('login', 'refresh');
        } else if ($this->session->userdata('level') !== 'User') {
            redirect('login/keluar', 'refresh');
        }
        ##/Cek Session Login##

        $this->data = array(
            'username' => $this->session->userdata('username'),
            'level' => $this->session->userdata('level'),
        );
    }
}