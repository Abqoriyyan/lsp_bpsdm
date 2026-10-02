<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Error</title>

	<!-- Google Fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">

	<!-- FontAwesome Icons -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

	<style>
		* {
			box-sizing: border-box;
			margin: 0;
			padding: 0;
		}

		body {
			font-family: 'Nunito', sans-serif;
			background-color: #f8f9fc;
			color: #2c395c;
			height: 100vh;
			display: flex;
			align-items: center;
			justify-content: center;
			padding: 20px;
		}

		.error-container {
			background: #ffffff;
			max-width: 520px;
			width: 100%;
			padding: 40px 30px;
			border-radius: 16px;
			box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
			text-align: center;
		}

		.error-code {
			font-size: 5.5rem;
			font-weight: 800;
			color: #2c395c;
			line-height: 1;
			margin-bottom: 10px;
			letter-spacing: -2px;
			position: relative;
			display: inline-block;
		}

		.error-code::after {
			content: '';
			display: block;
			width: 60px;
			height: 4px;
			background: #EAB360;
			margin: 15px auto 0;
			border-radius: 2px;
		}

		.error-heading {
			font-size: 1.4rem;
			font-weight: 700;
			color: #3a3b45;
			margin-top: 15px;
			margin-bottom: 12px;
		}

		.error-message {
			font-size: 0.95rem;
			color: #6e707e;
			line-height: 1.6;
			margin-bottom: 30px;
		}

		.error-message p {
			margin: 0;
		}

		.btn-home {
			display: inline-flex;
			align-items: center;
			justify-content: center;
			gap: 8px;
			background-color: #2c395c;
			color: #ffffff;
			font-weight: 700;
			font-size: 0.9rem;
			padding: 12px 24px;
			border-radius: 8px;
			text-decoration: none;
			transition: all 0.25s ease;
			box-shadow: 0 4px 12px rgba(44, 57, 92, 0.25);
		}

		.btn-home:hover {
			background-color: #374774;
			color: #EAB360;
			transform: translateY(-2px);
			box-shadow: 0 6px 16px rgba(44, 57, 92, 0.35);
		}

		.icon-box {
			font-size: 3rem;
			color: #EAB360;
			margin-bottom: 10px;
		}

		@media (max-width: 480px) {
			.error-container {
				padding: 30px 20px;
			}

			.error-code {
				font-size: 4rem;
			}

			.error-heading {
				font-size: 1.2rem;
			}
		}
	</style>
</head>

<body>

	<div class="error-container">
		<div class="icon-box">
			<i class="fas fa-exclamation-triangle"></i>
		</div>

		<div class="error-code">Error</div>

		<h1 class="error-heading"><?php echo $heading; ?></h1>

		<div class="error-message">
			<?php echo $message; ?>
		</div>

		<a href="<?php echo config_item('base_url'); ?>" class="btn-home">
			<i class="fas fa-arrow-left"></i> Kembali ke Beranda
		</a>
	</div>

</body>

</html>