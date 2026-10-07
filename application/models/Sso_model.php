<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_sso_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function find_by_identifier($identifier)
    {
        if (empty($identifier)) {
            return false;
        }

        $this->db->group_start();
        $this->db->where('nip', $identifier);
        $this->db->or_where('nik', $identifier);
        $this->db->or_where('email', $identifier);
        $this->db->or_where('username', $identifier);
        $this->db->group_end();

        $query = $this->db->get('user_login');

        if ($query && $query->num_rows() > 0) {
            return $query->row_array();
        }

        return false;
    }

    public function sync_from_ehrm($ehrm_data, $nip)
    {
        if (empty($nip)) {
            return false;
        }

        $data_insert = [
            'nip' => $nip,
            'nik' => !empty($ehrm_data['nik']) ? $ehrm_data['nik'] : $nip,
            'username' => !empty($ehrm_data['username']) ? $ehrm_data['username'] : $nip,
            'email' => !empty($ehrm_data['email']) ? $ehrm_data['email'] : $nip . '@pu.go.id',
            'password' => password_hash('SSO_DEFAULT_PWD_' . rand(1000, 9999), PASSWORD_BCRYPT),
            'user_level' => 'User',
            'status' => '1',
            'sso_registered_at' => date('Y-m-d H:i:s')
        ];

        $insert = $this->db->insert('user_login', $data_insert);

        if ($insert) {
            return $this->find_by_identifier($nip);
        }

        log_message('error', '[SSO Sync Error]: Gagal insert user baru dengan NIP ' . $nip);
        return false;
    }

    public function get_or_bind_user($nip, $email)
    {
        if (!empty($nip)) {
            $user = $this->db->get_where('user_login', ['nip' => $nip])->row_array();
            if ($user) {
                return $user;
            }
        }

        if (!empty($email)) {
            $user_by_email = $this->db->get_where('user_login', ['email' => $email])->row_array();

            if ($user_by_email) {
                if (!empty($nip)) {
                    $this->db->where('id', $user_by_email['id']);
                    $this->db->update('user_login', [
                        'nip' => $nip
                    ]);
                    $user_by_email['nip'] = $nip;
                }
                return $user_by_email;
            }
        }

        return null;
    }
}