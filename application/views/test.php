<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<title>Capture Signature in the webpage with jQuery plugins</title>

</head>
<body>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<link href="<?= base_url('assets/sign/jquery.signature/jquery.signature.css');?>" rel="stylesheet">
<style>
	#signature,#prev{
		width: 300px;
		height: 200px;
	}
</style>
<!--[if IE]>
<script src="excanvas.js"></script>
<![endif]-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="<?= base_url('assets/sign/jquery.signature/jquery.signature.js');?>"></script>
<script src="<?= base_url('assets/sign/jquery.ui.touch-punch.js');?>"></script>
<script>
$(function() {
	// Initalize
	$('#signature').signature();

	// Clear signature area
	$('#clear').click(function() {
		$('#signature').signature('clear');
	});

	// Get JSON response and show preview
	$('#but_prev').click(function() {
		var output = $('#signature').signature('toJSON');
		$('#json_output').val(output);
		$('#prev').signature('draw', output); 
	});
	$('#prev').signature({disabled: true}); 
});
</script>
    <p style='color: red;'>Draw your signature and click the preview button.</p>
<!-- Signature -->
<div id="signature"></div>
<div style="clear: both;"><button id="clear">Clear</button> 
	<button id="but_prev">Preview</button>
</div>
<textarea id='json_output'></textarea><br/>

<!-- Preview -->
<div id='prev'></div>
</body>
</html>
