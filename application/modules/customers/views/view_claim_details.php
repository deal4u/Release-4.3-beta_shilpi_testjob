<!DOCTYPE html>
<html>
	<head>
		<?php $this->load->view('common/admin_header'); ?>
		<link href="<?php echo base_url(); ?>assets/admin_assets/css/datatable/dataTables.bootstrap4.min.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>assets/admin_assets/css/datatable/responsive.bootstrap4.min.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>assets/admin_assets/css/plugins/ladda/ladda-themeless.min.css" rel="stylesheet">
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
						<h2>Claim Status</h2>
						<ol class="breadcrumb">
							<li class="breadcrumb-item">
								<a href="<?php echo base_url(); ?>">Dashboard</a>
							</li>
							<li class="breadcrumb-item active">
								<strong>Claim Status</strong>
							</li>
							<li class="breadcrumb-item active">
								<strong>Claim ID #<?php echo $claims[0]['claim_num']; ?></strong>
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
												<div class="row">
													<div class="col-md-12 col-sm-12">
														<div class="left_section">
															
																<input type="hidden" name="customer" class="form-control select-customer" value="37"> 
																<div class="form_section">
																	<div class="row " style="align-items: center;">
																		<div class="col-md-6">
																			<h2 class="mb-4">Claim: #<?php echo $claims[0]['claim_num']; ?></h2>
																		</div>
																		<!-- <div class="col-md-6 text-right">
																			<a class="plc-bt-a" href="#">View Details</a>
																			
																			</div> -->
																	</div>
																	<div class="row">
																		<div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
																			<div class="form-group">
																				<label>Claim Date</label>
																				<label class="form-control-plaintext cst_detail_fnt"><?php echo $claims[0]['created_at']; ?></label>
																			</div>
																		</div>
																		<div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
																			<div class="form-group">
																				<label>Appliance</label>
																				<?php
																					$str =  $claims[0]['item'];
																					$str_meta_key = explode("-", $str);
																					if ($str_meta_key[0] == 's') {
																					    $meta_tag = 'systems';
																					}elseif ($str_meta_key[0] == 'a') {
																					    $meta_tag = 'appliance';
																					}elseif ($str_meta_key[0] == 'c') {
																					    $meta_tag = 'combo';
																					}else{
																					    $meta_tag = 'opt_coverage';
																					}
																					$get_meta_content = get_claim_value($meta_tag, $str_meta_key[1]);
																					?>
																				<label class="form-control-plaintext cst_detail_fnt"><?php echo $get_meta_content['meta_content']; ?></label>
																			</div>
																		</div>
																		<div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
																			<div class="form-group">
																				<label>Brand</label>
																				<label class="form-control-plaintext cst_detail_fnt"><?php echo $claims[0]['make']; ?></label>
																			</div>
																		</div>
																		<div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
																			<div class="form-group">
																				<label>Issue</label>
																				<label class="form-control-plaintext cst_detail_fnt"><?php echo $claims[0]['problem']; ?></label>
																			</div>
																		</div>
																		<div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
																			<div class="form-group">
																				<label>Last Time Working</label>
																				<label class="form-control-plaintext cst_detail_fnt"><?php echo $claims[0]['last_working']; ?></label>
																			</div>
																		</div>
																		<div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
																			<div class="form-group">
																				<label>Description</label>
																				<label class="form-control-plaintext cst_detail_fnt"><?php echo $claims[0]['description']; ?></label>
																			</div>
																		</div>
																	</div>
																	<div class="row " style="align-items: center;">
																		<div class="col-md-12">
																			<h2 class="mb-4">Claim Updates</h2>
																		</div>
																	</div>
																	<div class="row">
																		<?php
																			$notes = get_claim_notes_tasks($id, $claims[0]['id']);
																			if (empty($notes)){
																			    echo 'No Records Found';
																			}else{ ?>
																		<?php foreach ($notes as $note){  if($note['show_portal']=='1'){ ?>
																		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
																			<div class="graybox" id="cm-">
																				<h5><?php if($note['assign_by']==NULL || $note['assign_by']==""){
																					echo  'You:';
																					}else
																					{  echo 'System'; }?>:</h5>
																				<div class="answer">
																					(<?php echo date('d.M.Y - h:i a', strtotime($note['created_at'])); ?> ): <?php echo $note['details']; ?>
																				</div>
																			</div>
																		</div>
																		<?php }  }?>
																		<?php } ?>
																	</div>
																	<div class="row " style="align-items: center;">
																		<div class="col-md-12 mg-tp-dv">
																			<h2 class="mb-4 ">Post a Question or Reply</h2>
																		</div>
																	</div>
<form method="post" id="add-task" data-val="<?php echo $id; ?>" data-val-claim="<?php echo $claim_id; ?>" >
																	<div class="row">
																		
																		<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
																			<div class="form-group">
																				<label>Your Reply</label>
																				<textarea style="min-height: 100px;" class="form-control summernote" name="summernote"></textarea>
																			</div>
																			<div class="form_section">
																				<div class="row">
																					<div class="btn_submit text-center pull-right col">
																						<button class="btn btn-primary btn-lg m-t-n-xs float-right add-task" type="submit"><strong>Reply</strong></button>
																					</div>
																				</div>
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
		<script src="<?php echo base_url(); ?>assets/admin_assets/js/plugins/ladda/ladda.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/admin_assets/js/plugins/ladda/ladda.jquery.min.js"></script>
	</body>
</html>
<script>
	$('.claim-view').on('click', function () {
	          var _this = $(this);
	          var claim = _this.attr('data-val');
	          var claim_customer_id = _this.attr('data-type');
	          show_claim(claim, claim_customer_id);
	          $("html, body").animate({ scrollTop:$("#claim-detail").offset().top},1000);
	      });
		function show_claim(claim, claim_customer_id) {
	      $.ajax({
	          url:base_url+'customers/claims/claim_details',
	          type: 'POST',
	          data: { id : claim, claim_customer_id : claim_customer_id},
	          dataType:'json',
	          success:function(status){
	              if(status.msg=='success'){
	                  $('#claim-detail').html(status.response);
	                  $('#claim-detail').addClass('claim_exist');
	                  $('.tab-pane').removeClass('active');
	                  $('.nav-link').removeClass('active');
	                  $('#tab-3').addClass('active');
	                  $('.claim-tab').addClass('active');
	              }
	              else if(status.msg == 'error'){
	                  toastr.error(status.response);
	              }
	          }
	      });
		}
/* add nootes */
	$('#add-task').submit(function (e) {
		e.preventDefault();
        var btn = $('.add-task').ladda();
        btn.ladda('start');
        var text = $(".summernote").val();
        var type = '2';
        var assign_to = 0;
        var customer = $(this).attr('data-val');
        var claimvalue = $(this).attr('data-val-claim');
       
        if (text == '') {
            toastr.error('Please provide complete details');
            btn.ladda('stop');
        } else {
            $.ajax({
                url: base_url + 'customers/claims/add_note',
                type: 'POST',
                data: {customer: customer, text: text, type: type, assign_to: assign_to, claim: claimvalue},
                dataType: 'json',
                success: function (status) {
                    if (status.msg == 'success') {
                        btn.ladda('stop');
                        toastr.success(status.response, 'Success');
                        var claim_num = status.claim;
                        setTimeout(function () {
                            window.location.replace(base_url+"customers/claims/view_claim_details/"+claimvalue);
                        }, 2000);
                    } else if (status.msg == 'error') {
                        btn.ladda('stop');
                        toastr.error(status.response);
                    }
                }
            });
        }
    });
</script>