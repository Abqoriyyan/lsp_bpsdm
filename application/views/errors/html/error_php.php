<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>PHP Error Encountered</title>
	<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
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
			min-height: 100vh;
			display: flex;
			align-items: center;
			justify-content: center;
			padding: 30px 15px;
		}

		.error-wrapper {
			background: #ffffff;
			max-width: 850px;
			width: 100%;
			border-radius: 16px;
			box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
			overflow: hidden;
			border: 1px solid #e3e6f0;
		}

		.error-header {
			background-color: #2c395c;
			padding: 24px 30px;
			color: #ffffff;
			position: relative;
		}

		.error-header::after {
			content: '';
			display: block;
			width: 60px;
			height: 4px;
			background: #EAB360;
			margin-top: 12px;
			border-radius: 2px;
		}

		.error-badge {
			display: inline-flex;
			align-items: center;
			gap: 6px;
			background-color: rgba(234, 179, 96, 0.2);
			color: #EAB360;
			font-size: 0.75rem;
			font-weight: 800;
			text-transform: uppercase;
			padding: 4px 12px;
			border-radius: 20px;
			letter-spacing: 0.5px;
			margin-bottom: 10px;
		}

		.error-title {
			font-size: 1.35rem;
			font-weight: 800;
			color: #ffffff;
		}

		.error-body {
			padding: 30px;
		}

		.error-message-box {
			background-color: #f1f3f9;
			border-left: 4px solid #EAB360;
			padding: 16px 20px;
			border-radius: 6px;
			margin-bottom: 24px;
		}

		.error-message-title {
			font-size: 0.8rem;
			font-weight: 800;
			text-transform: uppercase;
			color: #6e707e;
			margin-bottom: 4px;
		}

		.error-message-text {
			font-size: 1rem;
			font-weight: 700;
			color: #2c395c;
			word-break: break-word;
			line-height: 1.5;
		}

		.info-grid {
			display: grid;
			grid-template-columns: 130px 1fr;
			gap: 10px 16px;
			background-color: #ffffff;
			border: 1px solid #e3e6f0;
			padding: 16px 20px;
			border-radius: 10px;
			margin-bottom: 24px;
			font-size: 0.9rem;
		}

		.info-label {
			font-weight: 700;
			color: #6e707e;
		}

		.info-value {
			color: #2c395c;
			font-weight: 600;
			font-family: SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
			word-break: break-all;
		}

		.backtrace-heading {
			font-size: 1.05rem;
			font-weight: 800;
			color: #2c395c;
			margin-bottom: 16px;
			display: flex;
			align-items: center;
			gap: 8px;
		}

		.trace-item {
			border: 1px solid #e3e6f0;
			border-radius: 8px;
			margin-bottom: 10px;
			overflow: hidden;
		}

		.trace-header {
			background-color: #f8f9fc;
			padding: 10px 16px;
			display: flex;
			justify-content: space-between;
			align-items: center;
			font-size: 0.85rem;
			border-bottom: 1px solid #e3e6f0;
		}

		.trace-file {
			font-family: SFMono-Regular, Menlo, Monaco, Consolas, monospace;
			color: #374774;
			font-weight: 700;
			word-break: break-all;
		}

		.trace-line {
			background: #2c395c;
			color: #EAB360;
			padding: 2px 8px;
			border-radius: 4px;
			font-weight: 700;
			font-size: 0.75rem;
			white-space: nowrap;
		}

		.trace-function {
			padding: 10px 16px;
			background-color: #ffffff;
			color: #3a3b45;
			font-family: SFMono-Regular, Menlo, Monaco, Consolas, monospace;
			font-size: 0.85rem;
			font-weight: 600;
		}

		@media (max-width: 600px) {
			.error-body {
				padding: 20px;
			}

			.info-grid {
				grid-template-columns: 1fr;
				gap: 4px;
			}

			.trace-header {
				flex-direction: column;
				align-items: flex-start;
				gap: 6px;
			}
		}
	</style>
</head>

<body>

	<div class="error-wrapper">
		<!-- Header -->
		<div class="error-header">
			<div class="error-badge">
				<i class="fas fa-exclamation-triangle"></i> PHP Error Encountered
			</div>
			<h1 class="error-title">A PHP Error Was Encountered</h1>
		</div>

		<!-- Body Content -->
		<div class="error-body">
			<!-- Message Box -->
			<div class="error-message-box">
				<div class="error-message-title">Error Message</div>
				<div class="error-message-text"><?php echo $message; ?></div>
			</div>

			<!-- Meta Details -->
			<div class="info-grid">
				<div class="info-label">Severity:</div>
				<div class="info-value"><?php echo $severity; ?></div>

				<div class="info-label">Filename:</div>
				<div class="info-value"><?php echo $filepath; ?></div>

				<div class="info-label">Line Number:</div>
				<div class="info-value"><?php echo $line; ?></div>
			</div>

			<!-- Stack Backtrace -->
			<?php if (defined('SHOW_DEBUG_BACKTRACE') && SHOW_DEBUG_BACKTRACE === TRUE): ?>
				<div class="backtrace-heading">
					<i class="fas fa-code-branch" style="color: #EAB360;"></i> Stack Backtrace
				</div>

				<?php foreach (debug_backtrace() as $error): ?>
					<?php if (isset($error['file']) && strpos($error['file'], realpath(BASEPATH)) !== 0): ?>
						<div class="trace-item">
							<div class="trace-header">
								<span class="trace-file"><?php echo $error['file']; ?></span>
								<span class="trace-line">Line <?php echo $error['line']; ?></span>
							</div>
							<?php if (isset($error['function'])): ?>
								<div class="trace-function">
									&rarr;
									<?php echo (isset($error['class']) ? $error['class'] . $error['type'] : '') . $error['function']; ?>()
								</div>
							<?php endif; ?>
						</div>
					<?php endif ?>
				<?php endforeach ?>
			<?php endif ?>
		</div>
	</div>

</body>

</html>