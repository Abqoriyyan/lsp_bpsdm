<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url', 'html', 'file', 'form', 'security'));
		$this->load->library(array('form_validation', 'system'));
	}

	public function index()
	{
		if ($this->ion_auth->ceklogin()) {
			if ($this->ion_auth->super_admin()) {
				redirect('super_admin');
			} elseif ($this->ion_auth->login_admin()) {
				redirect('admin');
			} elseif ($this->ion_auth->login_user()) {
				redirect('user');
			} elseif ($this->ion_auth->login_asesor()) {
				redirect('asesor');
			} elseif ($this->ion_auth->login_komite()) {
				redirect('komite');
			} elseif ($this->ion_auth->login_tuk()) {
				redirect('tuk');
			} elseif ($this->ion_auth->login_audit()) {
				redirect('audit');
			} else {
				redirect('login/keluar');
			}
		}

		if (isset($_POST) && !empty($_POST)) {
			$username = $this->input->post('username', TRUE);
			$password_input = $this->input->post('password', TRUE);

			$secret_key = "6LfXw2QqAAAAADsUN4qaVFuvWUQST99Pqs5JxriD";
			$recaptcha_response = $this->input->post('g-recaptcha-response');

			$verifikasi = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret_key . '&response=' . $recaptcha_response);
			$response = json_decode($verifikasi);

			if (!$response->success) {
				$this->session->set_flashdata('title', 'Login Gagal');
				$this->session->set_flashdata('text', 'Validasi Captcha gagal! Pastikan Anda mencentang kotak pengaman.');
				$this->session->set_flashdata('class', "bg-danger text-white");
				redirect('login', 'refresh');
				return;
			}

			// 2. CEK DATABASE USER
			$user = $this->User_model->get_data_user($username);

			if ($user) {
				$login_success = false;

				if (strlen($user->password) === 32) {
					if (md5($password_input) === $user->password) {
						$login_success = true;

						$new_hash = password_hash($password_input, PASSWORD_BCRYPT);
						$this->db->where('username', $username);
						$this->db->update('user_login', ['password' => $new_hash]);
					}
				} else {
					if (password_verify($password_input, $user->password)) {
						$login_success = true;
					}
				}

				if ($login_success) {
					if ($user->status == 1) {
						$sessionarray = array(
							'nik' => $user->nik,
							'username' => $user->username,
							'level' => $user->user_level,
							'email' => $user->email,
							'login' => TRUE,
							'id_login' => session_id()
						);
						$this->session->set_userdata($sessionarray);
						$this->session->set_flashdata('title', 'Login Sukses');
						$this->session->set_flashdata('text', 'Selamat Datang ' . $user->username);
						$this->session->set_flashdata('class', "bg-success text-white");
						$this->session->set_userdata('logged_in', TRUE);

						redirect('login', 'refresh');
					} else {
						$this->session->set_flashdata('title', 'Akses Ditolak');
						$this->session->set_flashdata('text', 'Akun Anda sedang tidak aktif. Silakan hubungi admin.');
						$this->session->set_flashdata('class', "bg-warning");
						redirect('login', 'refresh');
					}
				} else {
					$this->session->set_flashdata('title', 'Login Gagal');
					$this->session->set_flashdata('text', 'Username atau Password salah. Silakan coba lagi.');
					$this->session->set_flashdata('class', "bg-danger text-white");
					redirect('login', 'refresh');
				}
			} else {
				$this->session->set_flashdata('title', 'Login Gagal');
				$this->session->set_flashdata('text', 'Username atau Password salah. Silakan coba lagi.');
				$this->session->set_flashdata('class', "bg-danger text-white");
				redirect('login', 'refresh');
			}
		}

		$this->data['title'] = $this->session->flashdata('title');
		$this->data['text'] = $this->session->flashdata('text');
		$this->data['class'] = $this->session->flashdata('class');
		$this->load->view('login', $this->data);
	}

	function keluar()
	{
		$this->session->sess_destroy();
		redirect('login', 'refresh');
	}

	public function profile()
	{
		if (!$this->ion_auth->ceklogin()) {
			redirect('login/keluar');
		}

		$data = array(
			'username' => $this->session->userdata('username'),
			'level' => $this->session->userdata('level'),
		);
		$this->template->load('menu', 'profile', $data);
	}

	public function update_password()
	{
		$get_data_user = $this->User_model->get_data_user($this->session->userdata('username'));

		$current_password = $this->input->post('current_password', TRUE);
		$new_password = $this->input->post('new_password', TRUE);

		if (password_verify($current_password, $get_data_user->password)) {
			$data = array(
				'password' => password_hash($new_password, PASSWORD_BCRYPT),
			);
			$where = array(
				'username' => $this->session->userdata('username'),
			);

			$this->User_model->update_data($where, $data, 'user_login');

			echo '<script language="javascript">';
			echo 'alert("Password Berhasil di Ubah")';
			echo '</script>';
		} else {
			echo '<script language="javascript">';
			echo 'alert("Current Password Salah, atau Tidak sesuai dengan password yang saat ini.")';
			echo '</script>';
		}
		redirect("profile", "refresh");
	}
}