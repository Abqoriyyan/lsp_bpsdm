<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('verify_dwaradaya_token')) {
    function verify_dwaradaya_token($jwt)
    {
        $CI =& get_instance();
        $CI->load->config('sso');
        $secret = $CI->config->item('sso_secret');

        if (empty($jwt) || empty($secret)) {
            return false;
        }

        $tokenParts = explode('.', $jwt);
        if (count($tokenParts) !== 3) {
            return false;
        }

        $header = $tokenParts[0];
        $payload = $tokenParts[1];
        $signatureProvided = $tokenParts[2];
        $base64UrlHeader = $header;
        $base64UrlPayload = $payload;
        $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, $secret, true);
        $base64UrlSignature = base64url_encode($signature);

        if ($base64UrlSignature !== $signatureProvided) {
            log_message('error', '[SSO JWT Error]: Invalid Signature');
            return false;
        }

        $payloadData = json_decode(base64url_decode($payload));

        if (!$payloadData) {
            return false;
        }

        if (isset($payloadData->exp) && ($payloadData->exp < time())) {
            log_message('error', '[SSO JWT Error]: Token Expired');
            return false;
        }

        if (empty($payloadData->user) && empty($payloadData->email)) {
            return false;
        }

        return $payloadData;
    }
}

if (!function_exists('base64url_encode')) {
    function base64url_encode($data)
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }
}

if (!function_exists('base64url_decode')) {
    function base64url_decode($data)
    {
        return base64_decode(strtr($data, '-_', '+/'));
    }
}