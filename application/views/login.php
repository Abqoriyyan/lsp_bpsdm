<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Login - LSP BPSDM Kementerian PU</title>

	<link rel='shortcut icon' type='image/png' href='<?= base_url("assets/lsp/logo-lsp.png"); ?>'>

	<link href="<?= base_url('assets/vendor/fontawesome-free/css/all.min.css'); ?>" rel="stylesheet" type="text/css">
	<link
		href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
		rel="stylesheet">

	<link href="<?= base_url('assets/css/sb-admin-2.min.css'); ?>" rel="stylesheet">

	<script src="https://www.google.com/recaptcha/api.js" async defer></script>

	<style>
		body {
			background: radial-gradient(ellipse at bottom, #EAB360 0%, #374774 100%);
			min-height: 100vh;
			display: flex;
			align-items: center;
			justify-content: center;
			font-family: 'Myriad Pro', sans-serif;
			margin: 0;
		}

		.glass-card {
			background-color: rgba(255, 255, 255, 0.65);
			backdrop-filter: blur(15px);
			-webkit-backdrop-filter: blur(15px);
			border: 1px solid rgba(255, 255, 255, 0.4);
			border-radius: 8px;
			box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
			padding: 40px 30px;
			width: 100%;
			max-width: 420px;
			margin: 20px;
		}

		.login-header h4 {
			color: #2c395c;
			font-weight: 800;
			margin-top: 15px;
			margin-bottom: 25px;
			font-size: 21px;
			line-height: 1.2;
		}

		.login-header img {
			width: 80px;
			height: auto;
			filter: drop-shadow(0px 4px 6px rgba(0, 0, 0, 0.1));
		}

		.modern-input {
			background-color: rgba(255, 255, 255, 0.6);
			border: 1px solid rgba(255, 255, 255, 0.8);
			border-radius: 8px;
			padding: 12px 20px;
			height: auto;
			font-size: 0.95rem;
			color: #333;
			transition: all 0.3s ease;
		}

		.modern-input:focus {
			background-color: rgba(255, 255, 255, 0.9);
			border-color: #374774;
			box-shadow: 0 0 15px rgba(255, 255, 255, 0.5);
			outline: none;
		}

		.input-group-text.modern-icon {
			background-color: transparent;
			border: none;
			position: absolute;
			right: 15px;
			top: 50%;
			transform: translateY(-50%);
			z-index: 10;
			color: #6c757d;
		}

		/* Tombol Login */
		.modern-btn {
			background-color: #374774;
			border: none;
			border-radius: 8px;
			padding: 12px;
			font-size: 1rem;
			font-weight: 700;
			letter-spacing: 0.5px;
			transition: all 0.3s ease;
			box-shadow: 0 4px 15px rgba(55, 71, 116, 0.4);
		}

		.modern-btn:hover {
			background-color: #283559;
			transform: translateY(-2px);
			box-shadow: 0 6px 20px rgba(55, 71, 116, 0.6);
		}

		.recaptcha-wrapper {
			display: flex;
			justify-content: center;
			margin-bottom: 20px;
			transform: scale(0.9);
			transform-origin: center;
		}

		.modern-btn-sso {
			background-color: #EAB630;
			color: #ffffff;
			font-weight: 600;
			padding: 12px;
			border-radius: 8px;
			transition: all 0.3s ease;
			box-shadow: 0 4px 10px rgba(0, 75, 135, 0.25);
			text-decoration: none;
			display: block;
		}

		.modern-btn-sso:hover {
			background-color: #eeaf10;
			color: #ffffff;
			box-shadow: 0 6px 15px rgba(0, 75, 135, 0.4);
			transform: translateY(-1px);
			text-decoration: none;
		}

		.login-divider {
			display: flex;
			align-items: center;
			text-align: center;
			color: #888888;
			font-size: 12px;
		}

		.login-divider::before,
		.login-divider::after {
			content: '';
			flex: 1;
			border-bottom: 1px solid #e0e0e0;
		}

		.login-divider span {
			padding: 0 10px;
		}
	</style>
</head>

<body>

	<div class="glass-card">

		<div class="text-center login-header">
			<img src="<?= base_url('assets/lsp/logo-lsp.png') ?>" alt="Logo LSP">
			<h4>LSP BPSDM<br>Kementerian Pekerjaan Umum</h4>
		</div>

		<!-- Notification Flashdata -->
		<?php if ($this->session->flashdata('error')): ?>
			<div class="alert alert-danger text-center font-weight-bold" style="font-size: 13px; padding: 8px;">
				<?= $this->session->flashdata('error'); ?>
			</div>
		<?php endif; ?>


		<?= form_open_multipart('Login', array('id' => 'demo-form')); ?>

		<div class="form-group position-relative">
			<input type="text" name="username" class="form-control text-center modern-input" placeholder="Username/NIP"
				required autofocus>
		</div>

		<div class="form-group position-relative">
			<input type="password" name="password" class="form-control text-center modern-input" placeholder="Password"
				required>
		</div>

		<div class="recaptcha-wrapper">
			<div class="g-recaptcha" data-sitekey="<?php echo $recaptcha_site_key; ?>"></div>
		</div>

		<button type="submit" class="btn btn-secondary btn-block modern-btn">
			Login
		</button>

		<div class="d-flex align-items-center my-3 text-muted">
			<hr class="flex-grow-1 my-0">
			<span class="px-2 small text-uppercase font-weight-bold" style="font-size: 11px;">atau Login via
				SSO</span>
			<hr class="flex-grow-1 my-0">
		</div>

		<div class="sso-wrapper mb-3">
			<button type="button" onclick="openSsoPopup()" class="btn btn-block modern-btn-sso" font-weight: 600;
				border-radius: 8px; padding: 10px; display: flex; align-items: center; justify-content: center; gap:
				8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
				<i class="fas fa-key"></i> Login via SSO
			</button>
		</div>

		<?php echo form_close(); ?>
	</div>

	<script src="<?= base_url('assets/vendor/jquery/jquery.min.js'); ?>"></script>
	<script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
	<script src="<?= base_url('assets/vendor/jquery-easing/jquery.easing.min.js'); ?>"></script>
	<script src="<?= base_url('assets/js/sb-admin-2.min.js'); ?>"></script>

	<script>
		function onSubmit(token) {
			document.getElementById("demo-form").submit();
		}

		// FUNGSI POP-UP LOGIN DWARADAYA
		function openSsoPopup() {
			var callbackUrl = "<?= base_url('sso/login'); ?>";

			// TESTING LOKAL:
			// callbackUrl = "https://plot-surprise-stinger.ngrok-free.dev/sso/login";

			var encodedCallback = encodeURIComponent(callbackUrl);
			var ssoUrl = "https://superapps.bpsdm.pu.go.id/login?callbackUrl=" + encodedCallback;
			var width = 600;
			var height = 700;
			var left = (screen.width / 2) - (width / 2);
			var top = (screen.height / 2) - (height / 2);
			var popupWindow = window.open(
				ssoUrl,
				"SSO_Dwaradaya_Login",
				"width=" + width + ",height=" + height + ",top=" + top + ",left=" + left + ",resizable=yes,scrollbars=yes,status=yes"
			);
			var checkPopupTimer = setInterval(function () {
				if (!popupWindow || popupWindow.closed) {
					clearInterval(checkPopupTimer);
					window.location.href = "<?= base_url('User'); ?>";
				}
			}, 1000);
		}
	</script>

</body>

</html>