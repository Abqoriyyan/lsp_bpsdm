<?php defined('BASEPATH') OR exit('No direct script access allowed');
$config = array(
    'protocol' => 'smtp',
    'smtp_host' => getenv('SMTP_HOST'),
    'smtp_port' => getenv('SMTP_PORT'),
    'smtp_user' => getenv('SMTP_USER'),
    'smtp_pass' => getenv('SMTP_PASS'),
    'smtp_crypto' => getenv('SMTP_CRYPTO'),
    'mailtype' => 'html',
    'smtp_timeout' => '10',
    'charset' => 'utf-8',
    //'newline' => '\r\n',
    'wordwrap' => TRUE
);