<?php defined('BASEPATH') OR exit('No direct script access allowed');
$config = array(
    'protocol' => 'smtp', // 'mail', 'sendmail', or 'smtp'
    'smtp_host' => 'smtp.googlemail.com', 
    'smtp_port' => 465,
    'smtp_user' => 'dokumenlsppupr@gmail.com',
    'smtp_pass' => 'kqhyyqccbthoksbq',
    'smtp_crypto' => 'ssl', //can be 'ssl' or 'tls' for example
    'mailtype' => 'html', //plaintext 'text' mails or 'html'
    'smtp_timeout' => '10', //in seconds
    'charset' => 'utf-8',
    //'newline' => '\r\n',
    'wordwrap' => TRUE
);
// $config = array(
//     'protocol' => 'smtp', // 'mail', 'sendmail', or 'smtp'
//     'smtp_host' => 'asbsi.notadevs.com', 
//     'smtp_port' => 465,
//     'smtp_user' => 'info@asbsi.notadevs.com',
//     'smtp_pass' => 'Tawayangindah07!',
//     'smtp_crypto' => 'ssl', //can be 'ssl' or 'tls' for example
//     'mailtype' => 'html', //plaintext 'text' mails or 'html'
//     'smtp_timeout' => '10', //in seconds
//     'charset' => 'iso-8859-1',
//     'wordwrap' => TRUE
// );