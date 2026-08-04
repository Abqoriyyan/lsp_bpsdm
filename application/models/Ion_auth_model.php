<?php if (!defined('BASEPATH'))
	exit('No direct script access allowed');
/**
 * Name:  Ion Auth Model (Patched)
 *
 * Patch:  Use Argon2id for all new hashes; verify legacy (bcrypt/sha1) and auto-upgrade on login
 * Author:  Ben Edmunds (original), patched for Argon2id by your team
 *
 * Location: http://github.com/benedmunds/CodeIgniter-Ion-Auth
 *
 * Description:  Modified auth system based on redux_auth with extensive customization.
 *
 * Requirements: PHP 7.3+ (for PASSWORD_ARGON2ID)
 */
class Ion_auth_model extends CI_Model
{
	/**
	 * Holds an array of tables used
	 *
	 * @var array
	 **/
	public $tables = array();

	/**
	 * activation code
	 *
	 * @var string
	 **/
	public $activation_code;

	/**
	 * forgotten password key
	 *
	 * @var string
	 **/
	public $forgotten_password_code;

	/**
	 * new password
	 *
	 * @var string
	 **/
	public $new_password;

	/**
	 * Identity
	 *
	 * @var string
	 **/
	public $identity;

	/**
	 * Where
	 *
	 * @var array
	 **/
	public $_ion_where = array();

	/**
	 * Select
	 *
	 * @var array
	 **/
	public $_ion_select = array();

	/**
	 * Like
	 *
	 * @var array
	 **/
	public $_ion_like = array();

	/**
	 * Limit
	 *
	 * @var string
	 **/
	public $_ion_limit = NULL;

	/**
	 * Offset
	 *
	 * @var string
	 **/
	public $_ion_offset = NULL;

	/**
	 * Order By
	 *
	 * @var string
	 **/
	public $_ion_order_by = NULL;

	/**
	 * Order
	 *
	 * @var string
	 **/
	public $_ion_order = NULL;

	/**
	 * Hooks
	 *
	 * @var object
	 **/
	protected $_ion_hooks;

	/**
	 * Response
	 *
	 * @var string
	 **/
	protected $response = NULL;

	/**
	 * message (uses lang file)
	 *
	 * @var string
	 **/
	protected $messages;

	/**
	 * error message (uses lang file)
	 *
	 * @var string
	 **/
	protected $errors;

	/**
	 * error start delimiter
	 *
	 * @var string
	 **/
	protected $error_start_delimiter;

	/**
	 * error end delimiter
	 *
	 * @var string
	 **/
	protected $error_end_delimiter;

	/**
	 * caching of users and their groups
	 *
	 * @var array
	 **/
	public $_cache_user_in_group = array();

	/**
	 * caching of groups
	 *
	 * @var array
	 **/
	protected $_cache_groups = array();

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->config->load('ion_auth', TRUE);
		$this->load->helper('cookie');
		$this->load->helper('date');
		$this->lang->load('ion_auth');

		// initialize db tables data
		$this->tables = $this->config->item('tables', 'ion_auth');

		//initialize data
		$this->identity_column = $this->config->item('identity', 'ion_auth');
		$this->store_salt = $this->config->item('store_salt', 'ion_auth');
		$this->salt_length = $this->config->item('salt_length', 'ion_auth');
		$this->join = $this->config->item('join', 'ion_auth');

		// initialize hash method options (Bcrypt)
		$this->hash_method = $this->config->item('hash_method', 'ion_auth');
		$this->default_rounds = $this->config->item('default_rounds', 'ion_auth');
		$this->random_rounds = $this->config->item('random_rounds', 'ion_auth');
		$this->min_rounds = $this->config->item('min_rounds', 'ion_auth');
		$this->max_rounds = $this->config->item('max_rounds', 'ion_auth');

		// initialize messages and error
		$this->messages = array();
		$this->errors = array();
		$delimiters_source = $this->config->item('delimiters_source', 'ion_auth');

		// load the error delimeters either from the config file or use what's been supplied to form validation
		if ($delimiters_source === 'form_validation') {
			// load in delimiters from form_validation
			// to keep this simple we'll load the value using reflection since these properties are protected
			$this->load->library('form_validation');
			$form_validation_class = new ReflectionClass("CI_Form_validation");

			$error_prefix = $form_validation_class->getProperty("_error_prefix");
			$error_prefix->setAccessible(TRUE);
			$this->error_start_delimiter = $error_prefix->getValue($this->form_validation);
			$this->message_start_delimiter = $this->error_start_delimiter;

			$error_suffix = $form_validation_class->getProperty("_error_suffix");
			$error_suffix->setAccessible(TRUE);
			$this->error_end_delimiter = $error_suffix->getValue($this->form_validation);
			$this->message_end_delimiter = $this->error_end_delimiter;
		} else {
			// use delimiters from config
			$this->message_start_delimiter = $this->config->item('message_start_delimiter', 'ion_auth');
			$this->message_end_delimiter = $this->config->item('message_end_delimiter', 'ion_auth');
			$this->error_start_delimiter = $this->config->item('error_start_delimiter', 'ion_auth');
			$this->error_end_delimiter = $this->config->item('error_end_delimiter', 'ion_auth');
		}

		// initialize our hooks object
		$this->_ion_hooks = new stdClass;

		// load the bcrypt class if needed
		if ($this->hash_method == 'bcrypt') {
			if ($this->random_rounds) {
				$rand = rand($this->min_rounds, $this->max_rounds);
				$params = array('rounds' => $rand);
			} else {
				$params = array('rounds' => $this->default_rounds);
			}

			$params['salt_prefix'] = $this->config->item('salt_prefix', 'ion_auth');
			$this->load->library('bcrypt', $params);
		}

		$this->trigger_events('model_constructor');
		$this->message_end_delimiter = $this->config->item('message_end_delimiter', 'ion_auth');
	}

	/* =========================
	 * Argon2id helpers (NEW)
	 * ========================= */
	private function _argon_options()
	{
		return [
			'memory_cost' => 1 << 17, // 131072 KiB ≈ 128 MB
			'time_cost' => 3,
			'threads' => 2
		];
	}
	private function _is_argon($hash)
	{
		return is_string($hash) && strpos($hash, '$argon2') === 0;
	}
	private function _is_bcrypt($hash)
	{
		return is_string($hash) && (strpos($hash, '$2y$') === 0 || strpos($hash, '$2a$') === 0);
	}

	/**
	 * Misc functions
	 *
	 * Hash password : Hashes the password to be stored in the database.
	 * Hash password db : This function takes a password and validates it
	 * against an entry in the users table.
	 * Salt : Generates a random salt value.
	 */

	/**
	 * Hashes the password to be stored in the database.
	 *
	 * @return string|bool
	 **/
	public function hash_password($password, $salt = false, $use_sha1_override = FALSE)
	{
		if (empty($password))
			return FALSE;
		// ALWAYS use Argon2id for new hashes (PHC format)
		return password_hash($password, PASSWORD_ARGON2ID, $this->_argon_options());
	}

	/**
	 * This function takes a password and validates it
	 * against an entry in the users table. Also auto-upgrades legacy hashes.
	 *
	 * @return bool
	 **/
	public function hash_password_db($id, $password, $use_sha1_override = FALSE)
	{
		if (empty($id) || empty($password)) {
			return FALSE;
		}

		$this->trigger_events('extra_where');

		$query = $this->db->select('password, salt')
			->where('id', $id)
			->limit(1)
			->order_by('id', 'desc')
			->get($this->tables['users']);

		if ($query->num_rows() !== 1) {
			return FALSE;
		}

		$row = $query->row();
		$stored = $row->password;

		// CASE 1: Argon2 → verify + optional rehash
		if ($this->_is_argon($stored)) {
			$ok = password_verify($password, $stored);
			if ($ok && password_needs_rehash($stored, PASSWORD_ARGON2ID, $this->_argon_options())) {
				$new = password_hash($password, PASSWORD_ARGON2ID, $this->_argon_options());
				$this->db->update($this->tables['users'], array('password' => $new), array('id' => $id));
			}
			return $ok;
		}

		// CASE 2: Legacy bcrypt → verify via bcrypt lib, then upgrade
		if ($this->_is_bcrypt($stored) && isset($this->bcrypt)) {
			if ($this->bcrypt->verify($password, $stored)) {
				$new = password_hash($password, PASSWORD_ARGON2ID, $this->_argon_options());
				$this->db->update($this->tables['users'], array('password' => $new), array('id' => $id));
				return TRUE;
			}
			return FALSE;
		}

		// CASE 3: Legacy sha1 (+/- salt) → reproduce then upgrade
		if ($this->store_salt && !empty($row->salt)) {
			$legacy = sha1($password . $row->salt);
		} else {
			$salt = substr($stored, 0, $this->salt_length);
			$legacy = $salt . substr(sha1($salt . $password), 0, -$this->salt_length);
		}

		if (function_exists('hash_equals') ? hash_equals($stored, $legacy) : ($stored === $legacy)) {
			$new = password_hash($password, PASSWORD_ARGON2ID, $this->_argon_options());
			$this->db->update($this->tables['users'], array('password' => $new /*, 'salt' => NULL*/), array('id' => $id));
			return TRUE;
		}

		return FALSE;
	}

	/**
	 * Generates a random salt value for forgotten passwords or any other keys. Uses SHA1.
	 * (Kept for compatibility with legacy code paths)
	 */
	public function hash_code($password)
	{
		return $this->hash_password($password, FALSE, TRUE);
	}

	/**
	 * Generates a random salt value. (legacy)
	 */
	public function salt()
	{
		$raw_salt_len = 16;

		$buffer = '';
		$buffer_valid = false;

		if (function_exists('random_bytes')) {
			$buffer = random_bytes($raw_salt_len);
			if ($buffer) {
				$buffer_valid = true;
			}
		}

		if (!$buffer_valid && function_exists('mcrypt_create_iv') && !defined('PHALANGER')) {
			$buffer = mcrypt_create_iv($raw_salt_len, MCRYPT_DEV_URANDOM);
			if ($buffer) {
				$buffer_valid = true;
			}
		}

		if (!$buffer_valid && function_exists('openssl_random_pseudo_bytes')) {
			$buffer = openssl_random_pseudo_bytes($raw_salt_len);
			if ($buffer) {
				$buffer_valid = true;
			}
		}

		if (!$buffer_valid && @is_readable('/dev/urandom')) {
			$f = fopen('/dev/urandom', 'r');
			$read = strlen($buffer);
			while ($read < $raw_salt_len) {
				$buffer .= fread($f, $raw_salt_len - $read);
				$read = strlen($buffer);
			}
			fclose($f);
			if ($read >= $raw_salt_len) {
				$buffer_valid = true;
			}
		}

		if (!$buffer_valid || strlen($buffer) < $raw_salt_len) {
			$bl = strlen($buffer);
			for ($i = 0; $i < $raw_salt_len; $i++) {
				if ($i < $bl) {
					$buffer[$i] = $buffer[$i] ^ chr(mt_rand(0, 255));
				} else {
					$buffer .= chr(mt_rand(0, 255));
				}
			}
		}

		$salt = $buffer;

		// encode string with the Base64 variant used by crypt
		$base64_digits = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/';
		$bcrypt64_digits = './ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
		$base64_string = base64_encode($salt);
		$salt = strtr(rtrim($base64_string, '='), $base64_digits, $bcrypt64_digits);

		$salt = substr($salt, 0, $this->salt_length);

		return $salt;
	}

	/**
	 * Activation functions
	 */
	public function activate($id, $code = false)
	{
		$this->trigger_events('pre_activate');

		if ($code !== FALSE) {
			$query = $this->db->select($this->identity_column)
				->where('activation_code', $code)
				->where('id', $id)
				->limit(1)
				->order_by('id', 'desc')
				->get($this->tables['users']);

			$result = $query->row();

			if ($query->num_rows() !== 1) {
				$this->trigger_events(array('post_activate', 'post_activate_unsuccessful'));
				$this->set_error('activate_unsuccessful');
				return FALSE;
			}

			$data = array(
				'activation_code' => NULL,
				'active' => 1
			);

			$this->trigger_events('extra_where');
			$this->db->update($this->tables['users'], $data, array('id' => $id));
		} else {
			$data = array(
				'activation_code' => NULL,
				'active' => 1
			);

			$this->trigger_events('extra_where');
			$this->db->update($this->tables['users'], $data, array('id' => $id));
		}

		$return = $this->db->affected_rows() == 1;
		if ($return) {
			$this->trigger_events(array('post_activate', 'post_activate_successful'));
			$this->set_message('activate_successful');
		} else {
			$this->trigger_events(array('post_activate', 'post_activate_unsuccessful'));
			$this->set_error('activate_unsuccessful');
		}

		return $return;
	}

	public function deactivate($id = NULL)
	{
		$this->trigger_events('deactivate');

		if (!isset($id)) {
			$this->set_error('deactivate_unsuccessful');
			return FALSE;
		} elseif ($this->ion_auth->logged_in() && $this->user()->row()->id == $id) {
			$this->set_error('deactivate_current_user_unsuccessful');
			return FALSE;
		}

		$activation_code = sha1(md5(microtime()));
		$this->activation_code = $activation_code;

		$data = array(
			'activation_code' => $activation_code,
			'active' => 0
		);

		$this->trigger_events('extra_where');
		$this->db->update($this->tables['users'], $data, array('id' => $id));

		$return = $this->db->affected_rows() == 1;
		if ($return)
			$this->set_message('deactivate_successful');
		else
			$this->set_error('deactivate_unsuccessful');

		return $return;
	}

	public function clear_forgotten_password_code($code)
	{

		if (empty($code)) {
			return FALSE;
		}

		$this->db->where('forgotten_password_code', $code);

		if ($this->db->count_all_results($this->tables['users']) > 0) {
			$data = array(
				'forgotten_password_code' => NULL,
				'forgotten_password_time' => NULL
			);

			$this->db->update($this->tables['users'], $data, array('forgotten_password_code' => $code));

			return TRUE;
		}

		return FALSE;
	}

	public function reset_password($identity, $new)
	{
		$this->trigger_events('pre_change_password');

		if (!$this->identity_check($identity)) {
			$this->trigger_events(array('post_change_password', 'post_change_password_unsuccessful'));
			return FALSE;
		}

		$this->trigger_events('extra_where');

		$query = $this->db->select('id, password, salt')
			->where($this->identity_column, $identity)
			->limit(1)
			->order_by('id', 'desc')
			->get($this->tables['users']);

		if ($query->num_rows() !== 1) {
			$this->trigger_events(array('post_change_password', 'post_change_password_unsuccessful'));
			$this->set_error('password_change_unsuccessful');
			return FALSE;
		}

		$result = $query->row();

		$new = $this->hash_password($new); // Argon2id

		$data = array(
			'password' => $new,
			'remember_code' => NULL,
			'forgotten_password_code' => NULL,
			'forgotten_password_time' => NULL,
		);

		$this->trigger_events('extra_where');
		$this->db->update($this->tables['users'], $data, array($this->identity_column => $identity));

		$return = $this->db->affected_rows() == 1;
		if ($return) {
			$this->trigger_events(array('post_change_password', 'post_change_password_successful'));
			$this->set_message('password_change_successful');
		} else {
			$this->trigger_events(array('post_change_password', 'post_change_password_unsuccessful'));
			$this->set_error('password_change_unsuccessful');
		}

		return $return;
	}

	public function amount_user()
	{
		return $this->db
			->from('users')
			->count_all_results();
	}

	public function selectemail($email)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('email', $email);
		$query = $this->db->get();
		foreach ($query->result() as $data) {
			return $data;
		}
	}

	public function selectid($email)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('email', $email);
		$query = $this->db->get();
		foreach ($query->result() as $data) {
			return $data->id;
		}
	}

	public function change_password($identity, $old, $new)
	{
		$this->trigger_events('pre_change_password');

		$this->trigger_events('extra_where');

		$query = $this->db->select('id, password, salt')
			->where($this->identity_column, $identity)
			->limit(1)
			->order_by('id', 'desc')
			->get($this->tables['users']);

		if ($query->num_rows() !== 1) {
			$this->trigger_events(array('post_change_password', 'post_change_password_unsuccessful'));
			$this->set_error('password_change_unsuccessful');
			return FALSE;
		}

		$user = $query->row();

		$old_password_matches = $this->hash_password_db($user->id, $old);

		if ($old_password_matches === TRUE) {
			$hashed_new_password = $this->hash_password($new); // Argon2id
			$data = array(
				'password' => $hashed_new_password,
				'remember_code' => NULL,
			);

			$this->trigger_events('extra_where');

			$successfully_changed_password_in_db = $this->db->update($this->tables['users'], $data, array($this->identity_column => $identity));
			if ($successfully_changed_password_in_db) {
				$this->trigger_events(array('post_change_password', 'post_change_password_successful'));
				$this->set_message('password_change_successful');
			} else {
				$this->trigger_events(array('post_change_password', 'post_change_password_unsuccessful'));
				$this->set_error('password_change_unsuccessful');
			}

			return $successfully_changed_password_in_db;
		}

		$this->set_error('password_change_unsuccessful');
		return FALSE;
	}

	public function username_check($username = '')
	{
		$this->trigger_events('username_check');

		if (empty($username)) {
			return FALSE;
		}

		$this->trigger_events('extra_where');

		return $this->db->where('username', $username)
			->group_by("id")
			->order_by("id", "ASC")
			->limit(1)
			->count_all_results($this->tables['users']) > 0;
	}

	public function email_check($email = '')
	{
		$this->trigger_events('email_check');

		if (empty($email)) {
			return FALSE;
		}

		$this->trigger_events('extra_where');

		return $this->db->where('email', $email)
			->group_by("id")
			->order_by("id", "ASC")
			->limit(1)
			->count_all_results($this->tables['users']) > 0;
	}

	public function identity_check($identity = '')
	{
		$this->trigger_events('identity_check');

		if (empty($identity)) {
			return FALSE;
		}

		return $this->db->where($this->identity_column, $identity)
			->count_all_results($this->tables['users']) > 0;
	}

	public function forgotten_password($identity)
	{
		if (empty($identity)) {
			$this->trigger_events(array('post_forgotten_password', 'post_forgotten_password_unsuccessful'));
			return FALSE;
		}

		$activation_code_part = "";
		if (function_exists("openssl_random_pseudo_bytes")) {
			$activation_code_part = openssl_random_pseudo_bytes(128);
		}

		for ($i = 0; $i < 1024; $i++) {
			$activation_code_part = sha1($activation_code_part . mt_rand() . microtime());
		}

		$key = $this->hash_code($activation_code_part . $identity);

		if ($key != '' && $this->config->item('permitted_uri_chars') != '' && $this->config->item('enable_query_strings') == FALSE) {
			if (!preg_match("|^[" . str_replace(array('\\-', '\-'), '-', preg_quote($this->config->item('permitted_uri_chars'), '-')) . "]+$|i", $key)) {
				$key = preg_replace("/[^" . $this->config->item('permitted_uri_chars') . "]+/i", "-", $key);
			}
		}

		$this->forgotten_password_code = substr($key, 0, 40);

		$this->trigger_events('extra_where');

		$update = array(
			'forgotten_password_code' => $key,
			'forgotten_password_time' => time()
		);

		$this->db->update($this->tables['users'], $update, array($this->identity_column => $identity));

		$return = $this->db->affected_rows() == 1;

		if ($return)
			$this->trigger_events(array('post_forgotten_password', 'post_forgotten_password_successful'));
		else
			$this->trigger_events(array('post_forgotten_password', 'post_forgotten_password_unsuccessful'));

		return $return;
	}

	public function forgotten_password_complete($code, $salt = FALSE)
	{
		$this->trigger_events('pre_forgotten_password_complete');

		if (empty($code)) {
			$this->trigger_events(array('post_forgotten_password_complete', 'post_forgotten_password_complete_unsuccessful'));
			return FALSE;
		}

		$profile = $this->where('forgotten_password_code', $code)->users()->row();

		if ($profile) {

			if ($this->config->item('forgot_password_expiration', 'ion_auth') > 0) {
				$expiration = $this->config->item('forgot_password_expiration', 'ion_auth');
				if (time() - $profile->forgotten_password_time > $expiration) {
					$this->set_error('forgot_password_expired');
					$this->trigger_events(array('post_forgotten_password_complete', 'post_forgotten_password_complete_unsuccessful'));
					return FALSE;
				}
			}

			$password = $this->salt();

			$data = array(
				'password' => $this->hash_password($password),
				'forgotten_password_code' => NULL,
				'active' => 1,
			);

			$this->db->update($this->tables['users'], $data, array('forgotten_password_code' => $code));

			$this->trigger_events(array('post_forgotten_password_complete', 'post_forgotten_password_complete_successful'));
			return $password;
		}

		$this->trigger_events(array('post_forgotten_password_complete', 'post_forgotten_password_complete_unsuccessful'));
		return FALSE;
	}

	public function register($identity, $password, $email, $additional_data = array(), $groups = array())
	{
		$this->trigger_events('pre_register');

		$manual_activation = $this->config->item('manual_activation', 'ion_auth');

		if ($this->identity_check($identity)) {
			$this->set_error('account_creation_duplicate_identity');
			return FALSE;
		} elseif (!$this->config->item('default_group', 'ion_auth') && empty($groups)) {
			$this->set_error('account_creation_missing_default_group');
			return FALSE;
		}

		$query = $this->db->get_where($this->tables['groups'], array('name' => $this->config->item('default_group', 'ion_auth')), 1)->row();
		if (!isset($query->id) && empty($groups)) {
			$this->set_error('account_creation_invalid_default_group');
			return FALSE;
		}

		$default_group = $query;

		$ip_address = $this->_prepare_ip($this->input->ip_address());
		$password = $this->hash_password($password); // Argon2id

		$data = array(
			$this->identity_column => $identity,
			'username' => $identity,
			'password' => $password,
			'email' => $email,
			'ip_address' => $ip_address,
			'created_on' => time(),
			'active' => ($manual_activation === false ? 1 : 0)
		);

		// DO NOT store per-user salt for Argon2id

		$user_data = array_merge($this->_filter_data($this->tables['users'], $additional_data), $data);

		$this->trigger_events('extra_set');

		$this->db->insert($this->tables['users'], $user_data);

		$id = $this->db->insert_id($this->tables['users'] . '_id_seq');

		if (isset($default_group->id) && empty($groups)) {
			$groups[] = $default_group->id;
		}

		if (!empty($groups)) {
			foreach ($groups as $group) {
				$this->add_to_group($group, $id);
			}
		}

		$this->trigger_events('post_register');

		return (isset($id)) ? $id : FALSE;
	}

	public function login($identity, $password, $remember = FALSE)
	{
		$this->trigger_events('pre_login');

		if (empty($identity) || empty($password)) {
			$this->set_error('login_unsuccessful');
			return FALSE;
		}

		$this->trigger_events('extra_where');

		$query = $this->db->select($this->identity_column . ', email, id, password, active, last_login')
			->where($this->identity_column, $identity)
			->limit(1)
			->order_by('id', 'desc')
			->get($this->tables['users']);

		if ($this->is_max_login_attempts_exceeded($identity)) {
			$this->hash_password($password);

			$this->trigger_events('post_login_unsuccessful');
			$this->set_error('login_timeout');

			return FALSE;
		}

		if ($query->num_rows() === 1) {
			$user = $query->row();

			$password_ok = $this->hash_password_db($user->id, $password);

			if ($password_ok === TRUE) {
				if ($user->active == 0) {
					$this->trigger_events('post_login_unsuccessful');
					$this->set_error('login_unsuccessful_not_active');
					return FALSE;
				}

				$this->set_session($user);
				$this->update_last_login($user->id);
				$this->clear_login_attempts($identity);

				if ($remember && $this->config->item('remember_users', 'ion_auth')) {
					$this->remember_user($user->id);
				}

				$this->trigger_events(array('post_login', 'post_login_successful'));
				$this->set_message('login_successful');

				return TRUE;
			}
		}

		$this->hash_password($password);

		$this->increase_login_attempts($identity);

		$this->trigger_events('post_login_unsuccessful');
		$this->set_error('login_unsuccessful');

		return FALSE;
	}

	public function recheck_session()
	{
		$recheck = (null !== $this->config->item('recheck_timer', 'ion_auth')) ? $this->config->item('recheck_timer', 'ion_auth') : 0;

		if ($recheck !== 0) {
			$last_login = $this->session->userdata('last_check');
			if ($last_login + $recheck < time()) {
				$query = $this->db->select('id')
					->where(array($this->identity_column => $this->session->userdata('identity'), 'active' => '1'))
					->limit(1)
					->order_by('id', 'desc')
					->get($this->tables['users']);
				if ($query->num_rows() === 1) {
					$this->session->set_userdata('last_check', time());
				} else {
					$this->trigger_events('logout');

					$identity = $this->config->item('identity', 'ion_auth');

					if (substr(CI_VERSION, 0, 1) == '2') {
						$this->session->unset_userdata(array($identity => '', 'id' => '', 'user_id' => ''));
					} else {
						$this->session->unset_userdata(array($identity, 'id', 'user_id'));
					}
					return false;
				}
			}
		}

		return (bool) $this->session->userdata('identity');
	}

	public function is_max_login_attempts_exceeded($identity, $ip_address = NULL)
	{
		if ($this->config->item('track_login_attempts', 'ion_auth')) {
			$max_attempts = $this->config->item('maximum_login_attempts', 'ion_auth');
			if ($max_attempts > 0) {
				$attempts = $this->get_attempts_num($identity, $ip_address);
				return $attempts >= $max_attempts;
			}
		}
		return FALSE;
	}

	public function get_attempts_num($identity, $ip_address = NULL)
	{
		if ($this->config->item('track_login_attempts', 'ion_auth')) {
			$this->db->select('1', FALSE);
			$this->db->where('login', $identity);
			if ($this->config->item('track_login_ip_address', 'ion_auth')) {
				if (!isset($ip_address)) {
					$ip_address = $this->_prepare_ip($this->input->ip_address());
				}
				$this->db->where('ip_address', $ip_address);
			}
			$this->db->where('time >', time() - $this->config->item('lockout_time', 'ion_auth'), FALSE);
			$qres = $this->db->get($this->tables['login_attempts']);
			return $qres->num_rows();
		}
		return 0;
	}

	public function is_time_locked_out($identity, $ip_address = NULL)
	{
		return $this->is_max_login_attempts_exceeded($identity, $ip_address);
	}

	public function get_last_attempt_time($identity, $ip_address = NULL)
	{
		if ($this->config->item('track_login_attempts', 'ion_auth')) {
			$this->db->select('time');
			$this->db->where('login', $identity);
			if ($this->config->item('track_login_ip_address', 'ion_auth')) {
				if (!isset($ip_address)) {
					$ip_address = $this->_prepare_ip($this->input->ip_address());
				}
				$this->db->where('ip_address', $ip_address);
			}
			$this->db->order_by('id', 'desc');
			$qres = $this->db->get($this->tables['login_attempts'], 1);

			if ($qres->num_rows() > 0) {
				return $qres->row()->time;
			}
		}

		return 0;
	}

	public function get_last_attempt_ip($identity)
	{
		if ($this->config->item('track_login_attempts', 'ion_auth') && $this->config->item('track_login_ip_address', 'ion_auth')) {
			$this->db->select('ip_address');
			$this->db->where('login', $identity);
			$this->db->order_by('id', 'desc');
			$qres = $this->db->get($this->tables['login_attempts'], 1);

			if ($qres->num_rows() > 0) {
				return $qres->row()->ip_address;
			}
		}

		return '';
	}

	public function increase_login_attempts($identity)
	{
		if ($this->config->item('track_login_attempts', 'ion_auth')) {
			$data = array('ip_address' => '', 'login' => $identity, 'time' => time());
			if ($this->config->item('track_login_ip_address', 'ion_auth')) {
				$data['ip_address'] = $this->_prepare_ip($this->input->ip_address());
			}
			return $this->db->insert($this->tables['login_attempts'], $data);
		}
		return FALSE;
	}

	public function clear_login_attempts($identity, $old_attempts_expire_period = 86400, $ip_address = NULL)
	{
		if ($this->config->item('track_login_attempts', 'ion_auth')) {
			$old_attempts_expire_period = max($old_attempts_expire_period, $this->config->item('lockout_time', 'ion_auth'));

			$this->db->where('login', $identity);
			if ($this->config->item('track_login_ip_address', 'ion_auth')) {
				if (!isset($ip_address)) {
					$ip_address = $this->_prepare_ip($this->input->ip_address());
				}
				$this->db->where('ip_address', $ip_address);
			}
			$this->db->or_where('time <', time() - $old_attempts_expire_period, FALSE);

			return $this->db->delete($this->tables['login_attempts']);
		}
		return FALSE;
	}

	public function limit($limit)
	{
		$this->trigger_events('limit');
		$this->_ion_limit = $limit;

		return $this;
	}

	public function offset($offset)
	{
		$this->trigger_events('offset');
		$this->_ion_offset = $offset;

		return $this;
	}

	public function where($where, $value = NULL)
	{
		$this->trigger_events('where');

		if (!is_array($where)) {
			$where = array($where => $value);
		}

		array_push($this->_ion_where, $where);

		return $this;
	}

	public function like($like, $value = NULL, $position = 'both')
	{
		$this->trigger_events('like');

		array_push($this->_ion_like, array(
			'like' => $like,
			'value' => $value,
			'position' => $position
		));

		return $this;
	}

	public function select($select)
	{
		$this->trigger_events('select');

		$this->_ion_select[] = $select;

		return $this;
	}

	public function order_by($by, $order = 'desc')
	{
		$this->trigger_events('order_by');

		$this->_ion_order_by = $by;
		$this->_ion_order = $order;

		return $this;
	}

	public function row()
	{
		$this->trigger_events('row');

		$row = $this->response->row();

		return $row;
	}

	public function row_array()
	{
		$this->trigger_events(array('row', 'row_array'));

		$row = $this->response->row_array();

		return $row;
	}

	public function result()
	{
		$this->trigger_events('result');

		$result = $this->response->result();

		return $result;
	}

	public function result_array()
	{
		$this->trigger_events(array('result', 'result_array'));

		$result = $this->response->result_array();

		return $result;
	}

	public function num_rows()
	{
		$this->trigger_events(array('num_rows'));

		$result = $this->response->num_rows();

		return $result;
	}

	public function users($groups = NULL)
	{
		$this->trigger_events('users');

		if (isset($this->_ion_select) && !empty($this->_ion_select)) {
			foreach ($this->_ion_select as $select) {
				$this->db->select($select);
			}

			$this->_ion_select = array();
		} else {
			$this->db->select(array(
				$this->tables['users'] . '.*',
				$this->tables['users'] . '.id as id',
				$this->tables['users'] . '.id as user_id'
			));
		}

		if (isset($groups)) {
			if (!is_array($groups)) {
				$groups = array($groups);
			}

			if (isset($groups) && !empty($groups)) {
				$this->db->distinct();
				$this->db->join(
					$this->tables['users_groups'],
					$this->tables['users_groups'] . '.' . $this->join['users'] . '=' . $this->tables['users'] . '.id',
					'inner'
				);
			}

			$group_ids = array();
			$group_names = array();
			foreach ($groups as $group) {
				if (is_numeric($group))
					$group_ids[] = $group;
				else
					$group_names[] = $group;
			}
			$or_where_in = (!empty($group_ids) && !empty($group_names)) ? 'or_where_in' : 'where_in';
			if (!empty($group_names)) {
				$this->db->join($this->tables['groups'], $this->tables['users_groups'] . '.' . $this->join['groups'] . ' = ' . $this->tables['groups'] . '.id', 'inner');
				$this->db->where_in($this->tables['groups'] . '.name', $group_names);
			}
			if (!empty($group_ids)) {
				$this->db->{$or_where_in}($this->tables['users_groups'] . '.' . $this->join['groups'], $group_ids);
			}
		}

		$this->trigger_events('extra_where');

		if (isset($this->_ion_where) && !empty($this->_ion_where)) {
			foreach ($this->_ion_where as $where) {
				$this->db->where($where);
			}

			$this->_ion_where = array();
		}

		if (isset($this->_ion_like) && !empty($this->_ion_like)) {
			foreach ($this->_ion_like as $like) {
				$this->db->or_like($like['like'], $like['value'], $like['position']);
			}

			$this->_ion_like = array();
		}

		if (isset($this->_ion_limit) && isset($this->_ion_offset)) {
			$this->db->limit($this->_ion_limit, $this->_ion_offset);

			$this->_ion_limit = NULL;
			$this->_ion_offset = NULL;
		} else if (isset($this->_ion_limit)) {
			$this->db->limit($this->_ion_limit);

			$this->_ion_limit = NULL;
		}

		if (isset($this->_ion_order_by) && isset($this->_ion_order)) {
			$this->db->order_by($this->_ion_order_by, $this->_ion_order);

			$this->_ion_order = NULL;
			$this->_ion_order_by = NULL;
		}

		$this->response = $this->db->get($this->tables['users']);

		return $this;
	}

	public function user($id = NULL)
	{
		$this->trigger_events('user');

		$id = isset($id) ? $id : $this->session->userdata('user_id');

		$this->limit(1);
		$this->order_by($this->tables['users'] . '.id', 'desc');
		$this->where($this->tables['users'] . '.id', $id);

		$this->users();

		return $this;
	}

	public function get_users_groups($id = FALSE)
	{
		$this->trigger_events('get_users_group');

		$id || $id = $this->session->userdata('user_id');

		return $this->db->select($this->tables['users_groups'] . '.' . $this->join['groups'] . ' as id, ' . $this->tables['groups'] . '.name, ' . $this->tables['groups'] . '.description')
			->where($this->tables['users_groups'] . '.' . $this->join['users'], $id)
			->join($this->tables['groups'], $this->tables['users_groups'] . '.' . $this->join['groups'] . '=' . $this->tables['groups'] . '.id')
			->get($this->tables['users_groups']);
	}

	public function add_to_group($group_ids, $user_id = false)
	{
		$this->trigger_events('add_to_group');

		$user_id || $user_id = $this->session->userdata('user_id');

		if (!is_array($group_ids)) {
			$group_ids = array($group_ids);
		}

		$return = 0;

		foreach ($group_ids as $group_id) {
			if ($this->db->insert($this->tables['users_groups'], array($this->join['groups'] => (float) $group_id, $this->join['users'] => (float) $user_id))) {
				if (isset($this->_cache_groups[$group_id])) {
					$group_name = $this->_cache_groups[$group_id];
				} else {
					$group = $this->group($group_id)->result();
					$group_name = $group[0]->name;
					$this->_cache_groups[$group_id] = $group_name;
				}
				$this->_cache_user_in_group[$user_id][$group_id] = $group_name;

				$return += 1;
			}
		}

		return $return;
	}

	public function remove_from_group($group_ids = false, $user_id = false)
	{
		$this->trigger_events('remove_from_group');

		if (empty($user_id)) {
			return FALSE;
		}

		if (!empty($group_ids)) {
			if (!is_array($group_ids)) {
				$group_ids = array($group_ids);
			}

			foreach ($group_ids as $group_id) {
				$this->db->delete($this->tables['users_groups'], array($this->join['groups'] => (float) $group_id, $this->join['users'] => (float) $user_id));
				if (isset($this->_cache_user_in_group[$user_id]) && isset($this->_cache_user_in_group[$user_id][$group_id])) {
					unset($this->_cache_user_in_group[$user_id][$group_id]);
				}
			}

			$return = TRUE;
		} else {
			if ($return = $this->db->delete($this->tables['users_groups'], array($this->join['users'] => (float) $user_id))) {
				$this->_cache_user_in_group[$user_id] = array();
			}
		}
		return $return;
	}

	public function groups()
	{
		$this->trigger_events('groups');

		if (isset($this->_ion_where) && !empty($this->_ion_where)) {
			foreach ($this->_ion_where as $where) {
				$this->db->where($where);
			}
			$this->_ion_where = array();
		}

		if (isset($this->_ion_limit) && isset($this->_ion_offset)) {
			$this->db->limit($this->_ion_limit, $this->_ion_offset);

			$this->_ion_limit = NULL;
			$this->_ion_offset = NULL;
		} else if (isset($this->_ion_limit)) {
			$this->db->limit($this->_ion_limit);

			$this->_ion_limit = NULL;
		}

		if (isset($this->_ion_order_by) && isset($this->_ion_order)) {
			$this->db->order_by($this->_ion_order_by, $this->_ion_order);
		}

		$this->response = $this->db->get($this->tables['groups']);

		return $this;
	}

	public function group($id = NULL)
	{
		$this->trigger_events('group');

		if (isset($id)) {
			$this->where($this->tables['groups'] . '.id', $id);
		}

		$this->limit(1);
		$this->order_by('id', 'desc');

		return $this->groups();
	}

	public function update($id, array $data)
	{
		$this->trigger_events('pre_update_user');

		$user = $this->user($id)->row();

		$this->db->trans_begin();

		if (array_key_exists($this->identity_column, $data) && $this->identity_check($data[$this->identity_column]) && $user->{$this->identity_column} !== $data[$this->identity_column]) {
			$this->db->trans_rollback();
			$this->set_error('account_creation_duplicate_identity');

			$this->trigger_events(array('post_update_user', 'post_update_user_unsuccessful'));
			$this->set_error('update_unsuccessful');

			return FALSE;
		}

		$data = $this->_filter_data($this->tables['users'], $data);

		if (array_key_exists($this->identity_column, $data) || array_key_exists('password', $data) || array_key_exists('email', $data)) {
			if (array_key_exists('password', $data)) {
				if (!empty($data['password'])) {
					$data['password'] = $this->hash_password($data['password']); // Argon2id
				} else {
					unset($data['password']);
				}
			}
		}

		$this->trigger_events('extra_where');
		$this->db->update($this->tables['users'], $data, array('id' => $user->id));

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();

			$this->trigger_events(array('post_update_user', 'post_update_user_unsuccessful'));
			$this->set_error('update_unsuccessful');
			return FALSE;
		}

		$this->db->trans_commit();

		$this->trigger_events(array('post_update_user', 'post_update_user_successful'));
		$this->set_message('update_successful');
		return TRUE;
	}

	public function delete_user($id)
	{
		$this->trigger_events('pre_delete_user');

		$this->db->trans_begin();

		$this->remove_from_group(NULL, $id);

		$this->db->delete($this->tables['users'], array('id' => $id));

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$this->trigger_events(array('post_delete_user', 'post_delete_user_unsuccessful'));
			$this->set_error('delete_unsuccessful');
			return FALSE;
		}

		$this->db->trans_commit();

		$this->trigger_events(array('post_delete_user', 'post_delete_user_successful'));
		$this->set_message('delete_successful');
		return TRUE;
	}

	public function update_last_login($id)
	{
		$this->trigger_events('update_last_login');

		$this->load->helper('date');

		$this->trigger_events('extra_where');

		$this->db->update($this->tables['users'], array('last_login' => time()), array('id' => $id));

		return $this->db->affected_rows() == 1;
	}

	public function set_lang($lang = 'en')
	{
		$this->trigger_events('set_lang');

		if ($this->config->item('user_expire', 'ion_auth') === 0) {
			$expire = (60 * 60 * 24 * 365 * 2);
		} else {
			$expire = $this->config->item('user_expire', 'ion_auth');
		}

		set_cookie(array(
			'name' => 'lang_code',
			'value' => $lang,
			'expire' => $expire
		));

		return TRUE;
	}

	public function set_session($user)
	{
		$this->trigger_events('pre_set_session');

		$session_data = array(
			'identity' => $user->{$this->identity_column},
			$this->identity_column => $user->{$this->identity_column},
			'email' => $user->email,
			'user_id' => $user->id,
			'old_last_login' => $user->last_login,
			'last_check' => time(),
		);

		$this->session->set_userdata($session_data);

		$this->trigger_events('post_set_session');

		return TRUE;
	}

	public function remember_user($id)
	{
		$this->trigger_events('pre_remember_user');

		if (!$id) {
			return FALSE;
		}

		$user = $this->user($id)->row();

		$salt = $this->salt();

		$this->db->update($this->tables['users'], array('remember_code' => $salt), array('id' => $id));

		if ($this->db->affected_rows() > -1) {
			if ($this->config->item('user_expire', 'ion_auth') === 0) {
				$expire = (60 * 60 * 24 * 365 * 2);
			} else {
				$expire = $this->config->item('user_expire', 'ion_auth');
			}

			set_cookie(array(
				'name' => $this->config->item('identity_cookie_name', 'ion_auth'),
				'value' => $user->{$this->identity_column},
				'expire' => $expire
			));

			set_cookie(array(
				'name' => $this->config->item('remember_cookie_name', 'ion_auth'),
				'value' => $salt,
				'expire' => $expire
			));

			$this->trigger_events(array('post_remember_user', 'remember_user_successful'));
			return TRUE;
		}

		$this->trigger_events(array('post_remember_user', 'remember_user_unsuccessful'));
		return FALSE;
	}

	public function login_remembered_user()
	{
		$this->trigger_events('pre_login_remembered_user');

		if (
			!get_cookie($this->config->item('identity_cookie_name', 'ion_auth'))
			|| !get_cookie($this->config->item('remember_cookie_name', 'ion_auth'))
			|| !$this->identity_check(get_cookie($this->config->item('identity_cookie_name', 'ion_auth')))
		) {
			$this->trigger_events(array('post_login_remembered_user', 'post_login_remembered_user_unsuccessful'));
			return FALSE;
		}

		$this->trigger_events('extra_where');
		$query = $this->db->select($this->identity_column . ', id, email, last_login')
			->where($this->identity_column, urldecode(get_cookie($this->config->item('identity_cookie_name', 'ion_auth'))))
			->where('remember_code', get_cookie($this->config->item('remember_cookie_name', 'ion_auth')))
			->where('active', 1)
			->limit(1)
			->order_by('id', 'desc')
			->get($this->tables['users']);

		if ($query->num_rows() == 1) {
			$user = $query->row();

			$this->update_last_login($user->id);
			$this->set_session($user);

			if ($this->config->item('user_extend_on_login', 'ion_auth')) {
				$this->remember_user($user->id);
			}

			$this->trigger_events(array('post_login_remembered_user', 'post_login_remembered_user_successful'));
			return TRUE;
		}

		$this->trigger_events(array('post_login_remembered_user', 'post_login_remembered_user_unsuccessful'));
		return FALSE;
	}

	public function create_group($group_name = FALSE, $group_description = '', $additional_data = array())
	{
		if (!$group_name) {
			$this->set_error('group_name_required');
			return FALSE;
		}

		$existing_group = $this->db->get_where($this->tables['groups'], array('name' => $group_name))->num_rows();
		if ($existing_group !== 0) {
			$this->set_error('group_already_exists');
			return FALSE;
		}

		$data = array('name' => $group_name, 'description' => $group_description);

		if (!empty($additional_data))
			$data = array_merge($this->_filter_data($this->tables['groups'], $additional_data), $data);

		$this->trigger_events('extra_group_set');

		$this->db->insert($this->tables['groups'], $data);
		$group_id = $this->db->insert_id($this->tables['groups'] . '_id_seq');

		$this->set_message('group_creation_successful');
		return $group_id;
	}

	public function update_group($group_id = FALSE, $group_name = FALSE, $additional_data = array())
	{
		if (empty($group_id))
			return FALSE;

		$data = array();

		if (!empty($group_name)) {
			$existing_group = $this->db->get_where($this->tables['groups'], array('name' => $group_name))->row();
			if (isset($existing_group->id) && $existing_group->id != $group_id) {
				$this->set_error('group_already_exists');
				return FALSE;
			}

			$data['name'] = $group_name;
		}

		$group = $this->db->get_where($this->tables['groups'], array('id' => $group_id))->row();
		if ($this->config->item('admin_group', 'ion_auth') === $group->name && $group_name !== $group->name) {
			$this->set_error('group_name_admin_not_alter');
			return FALSE;
		}

		if (is_string($additional_data))
			$additional_data = array('description' => $additional_data);

		if (!empty($additional_data))
			$data = array_merge($this->_filter_data($this->tables['groups'], $additional_data), $data);

		$this->db->update($this->tables['groups'], $data, array('id' => $group_id));

		$this->set_message('group_update_successful');

		return TRUE;
	}

	public function delete_group($group_id = FALSE)
	{
		if (!$group_id || empty($group_id)) {
			return FALSE;
		}
		$group = $this->group($group_id)->row();
		if ($group->name == $this->config->item('admin_group', 'ion_auth')) {
			$this->trigger_events(array('post_delete_group', 'post_delete_group_notallowed'));
			$this->set_error('group_delete_notallowed');
			return FALSE;
		}

		$this->trigger_events('pre_delete_group');

		$this->db->trans_begin();

		$this->db->delete($this->tables['users_groups'], array($this->join['groups'] => $group_id));
		$this->db->delete($this->tables['groups'], array('id' => $group_id));

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$this->trigger_events(array('post_delete_group', 'post_delete_group_unsuccessful'));
			$this->set_error('group_delete_unsuccessful');
			return FALSE;
		}

		$this->db->trans_commit();

		$this->trigger_events(array('post_delete_group', 'post_delete_group_successful'));
		$this->set_message('group_delete_successful');
		return TRUE;
	}

	public function set_hook($event, $name, $class, $method, $arguments)
	{
		$this->_ion_hooks->{$event}[$name] = new stdClass;
		$this->_ion_hooks->{$event}[$name]->class = $class;
		$this->_ion_hooks->{$event}[$name]->method = $method;
		$this->_ion_hooks->{$event}[$name]->arguments = $arguments;
	}

	public function remove_hook($event, $name)
	{
		if (isset($this->_ion_hooks->{$event}[$name])) {
			unset($this->_ion_hooks->{$event}[$name]);
		}
	}

	public function remove_hooks($event)
	{
		if (isset($this->_ion_hooks->$event)) {
			unset($this->_ion_hooks->$event);
		}
	}

	protected function _call_hook($event, $name)
	{
		if (isset($this->_ion_hooks->{$event}[$name]) && method_exists($this->_ion_hooks->{$event}[$name]->class, $this->_ion_hooks->{$event}[$name]->method)) {
			$hook = $this->_ion_hooks->{$event}[$name];

			return call_user_func_array(array($hook->class, $hook->method), $hook->arguments);
		}

		return FALSE;
	}

	public function trigger_events($events)
	{
		if (is_array($events) && !empty($events)) {
			foreach ($events as $event) {
				$this->trigger_events($event);
			}
		} else {
			if (isset($this->_ion_hooks->$events) && !empty($this->_ion_hooks->$events)) {
				foreach ($this->_ion_hooks->$events as $name => $hook) {
					$this->_call_hook($events, $name);
				}
			}
		}
	}

	public function set_message_delimiters($start_delimiter, $end_delimiter)
	{
		$this->message_start_delimiter = $start_delimiter;
		$this->message_end_delimiter = $end_delimiter;

		return TRUE;
	}

	public function set_error_delimiters($start_delimiter, $end_delimiter)
	{
		$this->error_start_delimiter = $start_delimiter;
		$this->error_end_delimiter = $end_delimiter;

		return TRUE;
	}

	public function set_message($message)
	{
		$this->messages[] = $message;

		return $message;
	}

	public function messages()
	{
		$_output = '';
		foreach ($this->messages as $message) {
			$messageLang = $this->lang->line($message) ? $this->lang->line($message) : '##' . $message . '##';
			$_output .= $this->message_start_delimiter . $messageLang . $this->message_end_delimiter;
		}

		return $_output;
	}

	public function messages_array($langify = TRUE)
	{
		if ($langify) {
			$_output = array();
			foreach ($this->messages as $message) {
				$messageLang = $this->lang->line($message) ? $this->lang->line($message) : '##' . $message . '##';
				$_output[] = $this->message_start_delimiter . $messageLang . $this->message_end_delimiter;
			}
			return $_output;
		} else {
			return $this->messages;
		}
	}

	public function clear_messages()
	{
		$this->messages = array();

		return TRUE;
	}

	public function set_error($error)
	{
		$this->errors[] = $error;

		return $error;
	}

	public function errors()
	{
		$_output = '';
		foreach ($this->errors as $error) {
			$errorLang = $this->lang->line($error) ? $this->lang->line($error) : '##' . $error . '##';
			$_output .= $this->error_start_delimiter . $errorLang . $this->error_end_delimiter;
		}

		return $_output;
	}

	public function errors_array($langify = TRUE)
	{
		if ($langify) {
			$_output = array();
			foreach ($this->errors as $error) {
				$errorLang = $this->lang->line($error) ? $this->lang->line($error) : '##' . $error . '##';
				$_output[] = $this->error_start_delimiter . $errorLang . $this->error_end_delimiter;
			}
			return $_output;
		} else {
			return $this->errors;
		}
	}

	public function clear_errors()
	{
		$this->errors = array();

		return TRUE;
	}

	protected function _filter_data($table, $data)
	{
		$filtered_data = array();
		$columns = $this->db->list_fields($table);

		if (is_array($data)) {
			foreach ($columns as $column) {
				if (array_key_exists($column, $data))
					$filtered_data[$column] = $data[$column];
			}
		}

		return $filtered_data;
	}

	protected function _prepare_ip($ip_address)
	{
		return $ip_address;
	}
}
