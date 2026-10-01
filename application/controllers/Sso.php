<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sso extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->helper(['url', 'jwt']);
        $this->load->model('User_sso_model');

        if (file_exists(APPPATH . 'config/sso.php')) {
            $this->config->load('sso');
        }

        if (!$this->load->is_loaded('session')) {
            $this->load->library('session');
        }

        if (file_exists(APPPATH . 'libraries/Ehrm_service.php')) {
            $this->load->library('ehrm_service');
        } else if (file_exists(APPPATH . 'models/Ehrm_service.php')) {
            $this->load->model('ehrm_service');
        }
    }

    public function login()
    {
        $token = $this->input->get('token', TRUE);
        if (empty($token)) {
            $this->_handle_popup_error('Token SSO tidak ditemukan.');
            return;
        }

        $payload = verify_dwaradaya_token($token);
        if (!$payload) {
            $this->_handle_popup_error('Token SSO tidak valid atau sudah kedaluwarsa.');
            return;
        }

        $nip = !empty($payload->user) ? $payload->user : null;
        $email = !empty($payload->email) ? $payload->email : null;

        if (!$nip && !$email) {
            $this->_handle_popup_error('Data identitas dari SSO tidak lengkap (NIP/Email kosong).');
            return;
        }

        $user = $this->User_sso_model->get_or_bind_user($nip, $email);

        if (!$user) {
            $this->_handle_popup_error('Data permohonan sertifikasi Anda belum terdaftar di aplikasi LSP.');
            return;
        }

        if (isset($user['status']) && $user['status'] != '1') {
            $this->_handle_popup_error('Akun Anda dinonaktifkan.');
            return;
        }

        $session_data = [
            'login' => TRUE,
            'logged_in' => TRUE,
            'identity' => !empty($user['email']) ? $user['email'] : ($user['username'] ?? $nip),
            'username' => isset($user['username']) ? $user['username'] : $nip,
            'email' => isset($user['email']) ? $user['email'] : $email,
            'user_id' => $user['nip'] ?? $nip,
            'id_user' => $user['nip'] ?? $nip,
            'id' => $user['nip'] ?? $nip,
            'nip' => $user['nip'] ?? $nip,
            'nik' => isset($user['nik']) ? $user['nik'] : null,
            'level' => isset($user['user_level']) ? $user['user_level'] : 'peserta',
            'user_level' => isset($user['user_level']) ? $user['user_level'] : 'peserta',
            'old_last_login' => time(),
            'last_check' => time()
        ];

        $this->session->set_userdata($session_data);

        log_message('info', 'SSO Login Success: NIP ' . $nip . ' / Email ' . $email . ' | IP: ' . $this->input->ip_address());

        echo "<script>
        if (window.opener && !window.opener.closed) {
            window.opener.location.href = '" . base_url('User') . "';
            window.close();
        } else {
            window.location.href = '" . base_url('User') . "';
        }
    </script>";
        exit;
    }

    public function check()
    {
        $token = null;
        $authHeader = isset($_SERVER['HTTP_AUTHORIZATION']) ? $_SERVER['HTTP_AUTHORIZATION'] :
            (isset($_SERVER['REDIRECT_HTTP_AUTHORIZATION']) ? $_SERVER['REDIRECT_HTTP_AUTHORIZATION'] :
                $this->input->get_request_header('Authorization', TRUE));

        if (!empty($authHeader) && preg_match('/Bearer\s(\S+)/', $authHeader, $matches)) {
            $token = $matches[1];
        } else {
            $token = $this->input->get('token', TRUE);
        }

        if (empty($token)) {
            return $this->_send_sso_error("Token tidak ditemukan", 401);
        }

        $payload = verify_dwaradaya_token($token);
        if (!$payload) {
            return $this->_send_sso_error("Invalid token atau token kedaluwarsa", 401);
        }

        $identifier = !empty($payload->user) ? $payload->user : (!empty($payload->email) ? $payload->email : null);
        $user = $this->User_sso_model->find_by_identifier($identifier);

        if (!$user || (isset($user['status']) && $user['status'] != '1')) {
            return $this->_send_sso_error("User tidak ditemukan atau tidak aktif", 400);
        }

        return $this->output
            ->set_status_header(200)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode([
                "success" => true,
                "exists" => true
            ]));
    }

    private function _handle_popup_error($message)
    {
        $this->session->set_flashdata('error', $message);
        echo "<script>
            alert('" . addslashes($message) . "');
            if (window.opener && !window.opener.closed) {
                window.opener.location.href = '" . base_url('login') . "';
                window.close();
            } else {
                window.location.href = '" . base_url('login') . "';
            }
        </script>";
        exit;
    }

    private function _send_sso_error($message, $status_code = 400)
    {
        return $this->output
            ->set_status_header($status_code)
            ->set_content_type('application/json', 'utf-8')
            ->set_output(json_encode([
                "error" => $message
            ]));
    }
}