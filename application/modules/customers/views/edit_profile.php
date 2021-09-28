<!DOCTYPE html>
<html>
	<head>
		<?php $this->load->view('common/admin_header'); ?>
		<link href="<?php echo base_url(); ?>assets/admin_assets/css/datatable/dataTables.bootstrap4.min.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>assets/admin_assets/css/datatable/responsive.bootstrap4.min.css" rel="stylesheet">
	</head>
	<body>
		<div id="wrapper">
			<?php $this->load->view('common/customer_sidebar'); ?>
			<div id="page-wrapper" class="gray-bg">
				<div class="row border-bottom">
					<?php $this->load->view('common/admin_logoutbar'); ?>
				</div>
				<div class="row wrapper border-bottom white-bg page-heading">
					<div class="col-lg-10">
						<h2>Edit Profile</h2>
						<ol class="breadcrumb">
							<li class="breadcrumb-item">
								<a href="<?php echo base_url(); ?>">Dashboard</a>
							</li>
							<li class="breadcrumb-item active">
								<strong>Profile Edit</strong>
							</li>
						</ol>
					</div>
				</div>
				<div class="wrapper wrapper-content animated fadeInRight pb-0">
					<div class="row">
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
							<div class="wrapper wrapper-content animated fadeInRight">
								<div class="row">
									<div class="col-md-12 col-sm-12">
										<div class="ibox m-0">
											<div class="ibox-content ibox-content pt-4 pb-2">
												<div class="left_section">
													<form method="post" id="update-customer">
														<input type="hidden" name="id" value="<?php echo $this->session->userdata('id');?>">
														<div class="form_section">
															<h2 class="mb-4">Profile Details</h2>
															<div class="row">
																<div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
																	<div class="form-group">
																		<label>First Name</label>
																		<input type="text" class="form-control" name="first_name" required="true" value="<?php echo $customers[0]['first_name'];?>">
																	</div>
																</div>
																<div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
																	<div class="form-group">
																		<label>Last Name</label>
																		<input type="text" class="form-control" name="last_name" required="true" value="<?php echo $customers[0]['last_name'];?>">
																	</div>
																</div>
																<div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
																	<div class="form-group">
																		<label>Email Address</label>
																		<input type="text" class="form-control" name="email" required="true" value="<?php echo $customers[0]['email'];?>">
																	</div>
																</div>
																<div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
																	<div class="form-group">
																		<label>Home Phone</label>
																		<input type="text" class="form-control" name="home_phone" required="true" value="<?php echo $customers[0]['home_phone'];?>">
																	</div>
																</div>
																<div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
																	<div class="form-group" >
																		<label>Work Phone</label>
																		<input type="text" class="form-control" name="work_phone" required="true" value="<?php echo $customers[0]['work_phone'];?>">
																	</div>
																</div>
																<div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
																	<!-- <div class="form-group">
																		<label>City</label>
																		<input type="text" class="form-control" name="mail_City" required="true" value="<?php echo $customers[0]['mail_City'];?>">
																		</div> -->
																</div>
															</div>
															</div>
															 <div class="form_section">
																<h2 class="mb-4 ">Mailing Address</h2>	
																<div class="row">
																<div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
																	<div class="form-group">
																		<label>City</label>
																		<input type="text" class="form-control" name="mail_city" required="true" value="<?php echo $customers[0]['mail_city'];?>">
																	</div>
																</div>
																<div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
																	<div class="form-group">
																		<label>State</label>
																		<input type="text" class="form-control" name="mail_state" required="true" value="<?php echo $customers[0]['mail_state'];?>">
																	</div>
																</div>
																<div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
																	<div class="form-group">
																		<label>Zip Code</label>
																		<input type="text" class="form-control" name="mail_zipcode" required="true" value="<?php echo $customers[0]['mail_zipcode'];?>">
																	</div>
																</div>
																<div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
																	<div class="form-group">
																		<label>Address</label>
																		<textarea style="min-height: 56px;" class="form-control" name="mail_address"><?php echo $customers[0]['mail_address'];?></textarea>
																	</div>
																</div>
															</div>
															</div>
															
															<div class="hr-line-dashed"></div>
														
														<div class="form_section">
															<div class="row">
																<div class="btn_submit text-center pull-right col">
																	<button class="btn btn-primary btn-lg m-t-n-xs float-right submit-claim" type="submit"><strong>Save</strong></button>
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
						</div>
					</div>
				</div>
				<?php $this->load->view('common/admin_footer'); ?>
			</div>
		</div>
		<?php $this->load->view('common/admin_scripts'); ?>
		<script src="<?php echo base_url(); ?>assets/admin_assets/js/datatable/jquery.dataTables.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/admin_assets/js/datatable/dataTables.bootstrap4.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/admin_assets/js/datatable/dataTables.responsive.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/admin_assets/js/datatable/responsive.bootstrap4.min.js"></script>
	</body>
</html>
<script>
	$('#update-customer').submit(function (e) {
		e.preventDefault();
		var btn = $('.submit-customer').ladda();
		btn.ladda('start');
		var value = new FormData( $("#update-customer")[0] );
		$.ajax({
			url:base_url+'customers/update',
			type:'post',
			data:value,
			dataType:'json',
			processData: false,
			contentType: false,
			success:function(status){
				if(status.msg=='success'){
					btn.ladda('stop');
					toastr.success(status.response, 'Success');
					setTimeout(function () {
						// $(location).attr('href', admin_url+"customers");
						location.reload();
					}, 2000);
				}
				else if(status.msg == 'error'){
					btn.ladda('stop');
					toastr.error(status.response, 'Error');
				}
			}
		});
	});
</script>