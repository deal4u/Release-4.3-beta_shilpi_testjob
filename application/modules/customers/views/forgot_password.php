<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Forgot Password | Regal Home Warranty</title>
		<link rel="shortcut icon" href="<?php echo base_url(); ?>assets/favicon.png">
		<link href="<?php echo base_url(); ?>assets/admin_assets/css/bootstrap.min.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>assets/admin_assets/font-awesome/css/font-awesome.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>assets/admin_assets/css/animate.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>assets/admin_assets/css/style.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>assets/admin_assets/css/custom.css" rel="stylesheet">
		<!-- Ladda style -->
		<link href="<?php echo base_url(); ?>assets/admin_assets/css/plugins/ladda/ladda-themeless.min.css" rel="stylesheet">
	</head>
	<body class="gray-bg">
		<div class="middle-box text-center loginscreen animated fadeInDown">
			<div>
				<div>
					<img src="<?php echo base_url(); ?>assets/logo.png" class="logo">
				</div>
				<h2 class="font-bold">Forgot password</h2>
				<p>
					Enter your email address and your password will be reset and emailed to you.
				</p>
				<div class="alert alert-danger forgot-error" id="error_msg" style="display: none;">
				</div>
				<div class="alert alert-success" id="success_msg" style="display: none;">
				</div>
				<form class="m-t" role="form" id="forgot_form">
					<div class="form-group">
						<input type="email" class="form-control" name="email" id="email" placeholder="Email address" required="">
					</div>
					<button type="button" class="ladda-button btn btn-primary block btn-login full-width m-b" id="forgot_btn">Send new password</button>
				</form>
				<p class="text-inverse b-b-default text-right">Back to <a href="<?php echo base_url(); ?>customers/login">Login.</a></p>
				<p class="m-t"> <small>All rights reserved Regal Home Warranty &copy; <?php echo date("Y"); ?></small> </p>
			</div>
		</div>
		<!-- Mainly scripts -->
		<script src="<?php echo base_url(); ?>assets/admin_assets/js/jquery-3.1.1.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/admin_assets/js/popper.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/admin_assets/js/bootstrap.js"></script>
		<script src="<?php echo base_url(); ?>assets/admin_assets/js/plugins/ladda/spin.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/admin_assets/js/plugins/ladda/ladda.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/admin_assets/js/plugins/ladda/ladda.jquery.min.js"></script>
	</body>
</html>
<script>
$('#forgot_btn').click(function () {
	if ($("#email").val() == '') {
		$('#error_msg').text("Email field is required.").show();
		return false;
	} else {
		$('#error').hide();
	}
	var btn = $(this).ladda();;
	btn.ladda('start');
	var value = $("#forgot_form").serialize();
	$.ajax({
		url: '<?php echo base_url(); ?>customers/forgot_password/retrieve_password',
		type: 'post',
		data: value,
		dataType: 'json',
		success: function (status) {
			btn.ladda('stop');
			if (status.msg == 'success') {
				$('#error_msg').hide();
				$('#success_msg').text(status.response).show();
			} else if (status.msg == 'error') {
				$('#error_msg').html(status.response).show();
			}
		}
	});
});
</script>