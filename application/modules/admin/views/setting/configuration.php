<!DOCTYPE html>
<html>
	<head>
		<?php $this->load->view('common/admin_header'); ?>
		<link href="<?php echo base_url(); ?>assets/admin_assets/css/datatable/dataTables.bootstrap4.min.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>assets/admin_assets/css/datatable/responsive.bootstrap4.min.css" rel="stylesheet">
	</head>
	<body>
		<div id="wrapper">
			<?php $this->load->view('common/admin_sidebar'); ?>
			<div id="page-wrapper" class="gray-bg">
				<div class="row border-bottom">
					<?php $this->load->view('common/admin_logoutbar'); ?>
				</div>
				<div class="row wrapper border-bottom white-bg page-heading">
					<div class="col-lg-10">
						<h2>Configuration</h2>
						<ol class="breadcrumb">
							<li class="breadcrumb-item">
								<a href="<?php echo admin_url(); ?>">Dashboard</a>
							</li>
							<li class="breadcrumb-item active">
								<strong>Configuration</strong>
							</li>
						</ol>
					</div>
				</div>
				<div class="wrapper wrapper-content animated fadeInRight pb-0">
					<div class="row">
						<div class="col-lg-12">
							<div class="ibox m-0">
								<div class="ibox-content ibox-content pt-4 pb-2">
									<div class="search_customer">
										<form role="form" class="form"  id="savecallsetting" method="post">
											<div class="row">
												<div class="col-md-6 col-sm-6">
													<label>Show "Call Now" button on website</label>
												</div>
												<div class="col-md-3 col-sm-3">
													<div class="form-group">
														<label class="switch">
														<input type="checkbox" id="meta_value" name="meta_value" value="1" <?= (isset($getsetting['callnow_toggle']) && $getsetting['callnow_toggle'] =='1')? 'checked': '' ?>>
														<span class="slider round"></span>
														</label>
													</div>
													<span id="savecalllog"></span>
												</div>
												<input type="hidden" name="meta_tag" value="configuration">
												<input type="hidden" name="meta_key" value="callnow_toggle">
												<div class="col-md-3 col-sm-12">
													<div class="form-group" style="padding-top: 26px">
													</div>
												</div>
											</div>
										</form>
										<form role="form" class="form"  id="paymentprocessor" method="post">
											<div class="row">
												<div class="col-md-6 col-sm-6">
													<label>Payment Processor</label>
												</div>
												<?php $modes = get_setting('payment_method', $meta_key="", $all = 1) ;
												foreach($modes as $modename){  ?>
													<div class="col-md-2 col-sm-2">
													<?php echo ucwords($modename['meta_value']); ?>
														<div class="form-group">
															<label class="switch">
															<input type="radio" id="meta_value_payment" name="meta_value" class="meta_value" value="<?php echo $modename['meta_value']; ?>" <?= (isset($getsetting['paymentprocessor']) &&  $getsetting['paymentprocessor'] ==$modename['meta_value'])? 'checked': '' ?>>
															<span class="slider round"></span>
															</label>
														</div>
													</div>
												<?php } ?>
												<input type="hidden" name="meta_tag" value="configuration">
												<input type="hidden" name="meta_key" value="paymentprocessor">
												<div class="col-md-3 col-sm-12">
													<div class="form-group" style="padding-top: 26px">
													</div>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php $this->load->view('common/admin_footer'); ?>
			</div>
		</div>
<?php $this->load->view('common/admin_scripts'); ?>
<!-- data tables  -->
<script src="<?php echo base_url(); ?>assets/admin_assets/js/datatable/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin_assets/js/datatable/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin_assets/js/datatable/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin_assets/js/datatable/responsive.bootstrap4.min.js"></script>
<script>
	$(document).on("change", "#meta_value", function () {
		
		var meta_value = $('#meta_value').is(':checked') ;
		var btn = $('#savecalllog').ladda();
		btn.ladda('start');
		var value = new FormData($("#savecallsetting")[0]);
		$.ajax({
			url: admin_url + 'setting/savesetting',
			type: 'post',
			data: value,
			dataType: 'json',
			processData: false,
			contentType: false,
			success: function (status) {
				if (status.msg == 'success') {
					btn.ladda('stop');
					toastr.success(status.response, 'Success');
					setTimeout(function () {
						$(location).attr('href', admin_url + "setting");
					}, 2000);
				} else if (status.msg == 'error') {
					btn.ladda('stop');
					toastr.error(status.response, 'Error');
				}
			}
		});
	});
	
	$(document).on("change", "#paymentprocessor", function () {
		var btn = $('#savecalllog').ladda();
		btn.ladda('start');
		var meta_value = $('#paymentprocessor input[name="meta_value"]:checked').val();
		var meta_key =  $('#paymentprocessor #meta_key').val();
		var meta_tag =  $('#paymentprocessor #meta_tag').val();
		var value = new FormData($("#paymentprocessor")[0]);
		
		$.ajax({
			url: admin_url + 'setting/savesetting',
			type: 'post',
			processData: false,
			contentType: false,
			dataType: 'json',
			data: value, // {meta_value:meta_value,meta_key:meta_key,meta_tag:meta_tag},
			success: function (status) {
				if (status.msg == 'success') {
					btn.ladda('stop');
					toastr.success(status.response, 'Success');
					setTimeout(function () {
						$(location).attr('href', admin_url + "setting");
					}, 2000);
				} else if (status.msg == 'error') {
					btn.ladda('stop');
					toastr.error(status.response, 'Error');
				}
			}
		});
	});
</script>