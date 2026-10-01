<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['sso_secret'] = getenv('JWT_SECRET_KEY');

$config['ehrm_auth_url'] = 'https://apigw.pu.go.id/user/login';
$config['ehrm_data_url'] = 'https://apigw.pu.go.id/v1/ehrm/data-peg';
$config['ehrm_username'] = getenv('EHRM_USERNAME');
$config['ehrm_password'] = getenv('EHRM_PASSWORD');