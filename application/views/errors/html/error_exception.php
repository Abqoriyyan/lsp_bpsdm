<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>An Uncaught Exception Was Encountered</title>
	<style>
		:root {
			--bg-color: #f8fafc;
			--card-bg: #ffffff;
			--text-main: #1e293b;
			--text-muted: #64748b;
			--danger-color: #ef4444;
			--danger-bg: #fef2f2;
			--border-color: #e2e8f0;
			--code-bg: #0f172a;
			--code-text: #38bdf8;
		}

		body {
			background-color: var(--bg-color);
			color: var(--text-main);
			font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
			margin: 0;
			padding: 30px 15px;
			line-height: 1.5;
		}

		.error-wrapper {
			max-width: 1000px;
			margin: 0 auto;
			background: var(--card-bg);
			border-radius: 12px;
			box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.01);
			border: 1px solid var(--border-color);
			overflow: hidden;
		}

		.error-header {
			background-color: var(--danger-bg);
			border-bottom: 1px solid #fee2e2;
			padding: 24px;
		}

		.error-badge {
			display: inline-block;
			background-color: var(--danger-color);
			color: #ffffff;
			font-size: 0.75rem;
			font-weight: 700;
			text-transform: uppercase;
			padding: 4px 10px;
			border-radius: 20px;
			letter-spacing: 0.5px;
			margin-bottom: 12px;
		}

		.error-title {
			margin: 0 0 8px 0;
			font-size: 1.35rem;
			color: #991b1b;
			font-weight: 700;
		}

		.error-message {
			font-size: 1.1rem;
			color: #7f1d1d;
			margin: 0;
			font-weight: 500;
			word-break: break-word;
		}

		.error-body {
			padding: 24px;
		}

		.info-grid {
			display: grid;
			grid-template-columns: 120px 1fr;
			gap: 12px 16px;
			background-color: #f1f5f9;
			padding: 16px;
			border-radius: 8px;
			margin-bottom: 24px;
			font-size: 0.9rem;
		}

		.info-label {
			font-weight: 600;
			color: var(--text-muted);
		}

		.info-value {
			color: var(--text-main);
			font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
			word-break: break-all;
		}

		.backtrace-title {
			font-size: 1rem;
			font-weight: 700;
			margin: 0 0 16px 0;
			color: var(--text-main);
			display: flex;
			align-items: center;
			gap: 8px;
		}

		.trace-item {
			border: 1px solid var(--border-color);
			border-radius: 8px;
			margin-bottom: 12px;
			overflow: hidden;
		}

		.trace-header {
			background-color: #f8fafc;
			padding: 12px 16px;
			display: flex;
			justify-content: space-between;
			align-items: center;
			border-bottom: 1px solid var(--border-color);
			font-size: 0.875rem;
		}

		.trace-file {
			font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
			color: #0369a1;
			font-weight: 600;
			word-break: break-all;
		}

		.trace-line {
			background: #e0f2fe;
			color: #0369a1;
			padding: 2px 8px;
			border-radius: 4px;
			font-weight: 700;
			font-size: 0.8rem;
			white-space: nowrap;
		}

		.trace-function {
			padding: 10px 16px;
			background-color: var(--code-bg);
			color: var(--code-text);
			font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
			font-size: 0.85rem;
		}

		@media (max-width: 640px) {
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
		<!-- Header Exception -->
		<div class="error-header">
			<span class="error-badge">Uncaught Exception</span>
			<h1 class="error-title"><?php echo get_class($exception); ?></h1>
			<p class="error-message"><?php echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?></p>
		</div>

		<!-- Details -->
		<div class="error-body">
			<div class="info-grid">
				<div class="info-label">Filename:</div>
				<div class="info-value"><?php echo $exception->getFile(); ?></div>

				<div class="info-label">Line Number:</div>
				<div class="info-value"><?php echo $exception->getLine(); ?></div>
			</div>

			<!-- Backtrace -->
			<?php if (defined('SHOW_DEBUG_BACKTRACE') && SHOW_DEBUG_BACKTRACE === TRUE): ?>
				<h2 class="backtrace-title">
					<svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"
						xmlns="http://www.w3.org/2000/svg">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
							d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
					</svg>
					Stack Backtrace
				</h2>

				<?php foreach ($exception->getTrace() as $error): ?>
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