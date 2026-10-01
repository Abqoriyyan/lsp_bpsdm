<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ehrm_service
{

    protected $CI;

    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->config('sso');
    }

    /**
     * Mengambil session token dari API Gateway PU
     */
    // private function get_apigw_token()
    // {
    //     $url = $this->CI->config->item('ehrm_auth_url');
    //     $payload = json_encode([
    //         'username' => $this->CI->config->item('ehrm_username'),
    //         'password' => $this->CI->config->item('ehrm_password')
    //     ]);

    //     $ch = curl_init($url);
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //     curl_setopt($ch, CURLOPT_POST, true);
    //     curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    //     curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    //     curl_setopt($ch, CURLOPT_TIMEOUT, 10);

    //     $response = curl_exec($ch);
    //     curl_close($ch);

    //     $data = json_decode($response, true);
    //     return isset($data['token']) ? $data['token'] : null;
    // }

    /**
     * Mengambil data pegawai berdasarkan NIP dari EHRM
     */
    public function get_data_pegawai($nip)
    {
        $username = $this->CI->config->item('ehrm_username');

        // IF MOCK MODE: Jika username API GW belum diisi/masih default, kembalikan data dummy lokal
        if (empty($username) || $username === 'your_apigw_username') {
            log_message('debug', '[SSO MOCK] Menggunakan data dummy EHRM untuk NIP: ' . $nip);

            return [
                'nip' => $nip,
                'nama' => 'Pegawai Test SSO (' . $nip . ')',
                'email' => 'pegawai.' . $nip . '@pu.go.id',
                'id_satminkal' => 'BPSDM-01'
            ];
        }

        // --- KODE ASLI INTEGRASI API GW (Akan berjalan saat kredensial sudah diisi) ---
        $token = $this->get_apigw_token();
        if (!$token)
            return null;

        $url = $this->CI->config->item('ehrm_data_url') . '?nip=' . urlencode($nip);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $token,
            'Content-Type: application/json'
        ]);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);

        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);
    }

    private function get_apigw_token()
    {
        // (Logika asli cURL ke https://apigw.pu.go.id/user/login tetap di sini)
        $url = $this->CI->config->item('ehrm_auth_url');
        $payload = json_encode([
            'username' => $this->CI->config->item('ehrm_username'),
            'password' => $this->CI->config->item('ehrm_password')
        ]);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);

        $response = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($response, true);
        return isset($data['token']) ? $data['token'] : null;
    }
}