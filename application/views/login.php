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
			font-family: 'Nunito', sans-serif;
			margin: 0;
		}

		.glass-card {
			background-color: rgba(255, 255, 255, 0.65);
			backdrop-filter: blur(15px);
			-webkit-backdrop-filter: blur(15px);
			border: 1px solid rgba(255, 255, 255, 0.4);
			border-radius: 20px;
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
			font-size: 1.2rem;
			line-height: 1.5;
		}

		.login-header img {
			width: 80px;
			height: auto;
			filter: drop-shadow(0px 4px 6px rgba(0, 0, 0, 0.1));
		}

		/* Input Fields yang Modern */
		.modern-input {
			background-color: rgba(255, 255, 255, 0.6);
			border: 1px solid rgba(255, 255, 255, 0.8);
			border-radius: 50px;
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
			border-radius: 50px;
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
	</style>
</head>

<body>

	<div class="glass-card">
		<?= form_open_multipart('Login', array('id' => 'demo-form')); ?>

		<div class="text-center login-header">
			<img src="<?= base_url('assets/lsp/logo-lsp.png') ?>" alt="Logo LSP">
			<h4>LSP BPSDM<br>Kementerian Pekerjaan Umum</h4>
		</div>

		<div class="form-group position-relative">
			<input type="text" name="username" class="form-control text-center modern-input" placeholder="Username"
				required autofocus>
		</div>

		<div class="form-group position-relative">
			<input type="password" name="password" class="form-control text-center modern-input" placeholder="Password"
				required>
		</div>

		<div class="recaptcha-wrapper">
			<div class="g-recaptcha" data-sitekey="<?php echo $recaptcha_site_key; ?>"></div>
		</div>

		<button type="submit" class="btn btn-primary btn-block modern-btn">
			Log In
		</button>

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
	</script>

</body>

</html>