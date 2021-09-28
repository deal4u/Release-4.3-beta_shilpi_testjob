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
                            <strong>Payment Method</strong>
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
									<h3><span class="changetext">Add</span> Payment Method</h3>					
									<form role="form" class="form"  id="add-offer" method="post">
										<div class="row">
											<div class="col-md-3 col-sm-12">
												<div class="form-group">
													<label>Bank Name</label>
													<input class="form-control" type="text" name="meta_value" id="meta_value"  />
													<input class="form-control" type="hidden" name="meta_key" value="payment_mode"  />
													<input class="form-control" type="hidden" name="meta_tag" value="payment_method"  />
													<input class="form-control" type="hidden" name="id" id="id" value=""  />
												</div>
											</div>
											<div class="col-md-3 col-sm-12">
												<div class="form-group">
													<label>Merchant ID</label>
													<input class="form-control" type="text" name="meta_contents[merchant_id]" id="merchant_id"  />
												</div>
											</div>
											<div class="col-md-3 col-sm-12">
												<div class="form-group">
													<label>Merchant Security Key</label>
													<input class="form-control" type="text" name="meta_contents[merchant_security]" id="merchant_security"  />
												</div>
											</div>
											
											<div class="col-md-3 col-sm-12">
                                                <div class="form-group" style="padding-top: 26px">
                                                    <button type="submit" id="savemode" class="btn btn-block btn btn-primary">  Submit</button>
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
            <div class="tasks">
                <div class="wrapper wrapper-content animated fadeInRight">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="ibox ">
								<div class="ibox-title">
									<h5>List Payment Modes</h5>
								</div>
                                <div class="ibox-content">
                                    <div class="mt-5"></div>
                                    <div class="table-responsive">
                                        <table class="table score-board-table">
                                            <thead>
                                                <tr>
                                                    <th>Sr No</th>
                                                    <th>Payment Mode</th>
                                                    <th>Added On</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
												<?php $modes = get_setting('configuration', $meta_key="paymentprocessor") ; ?>
                                                <?php $counter = 1; 
												if(isset($getsetting)){
													foreach($getsetting as $list) { 
													$content = json_decode($list['meta_content']);
													?>
													<input type="hidden" name="id" value="<?php echo $list['id']; ?>" class="id<?php echo $counter; ?>">
													<input type="hidden" name="merchant_id" value="<?php echo $content->merchant_id; ?>" class="merchant_id<?php echo $counter; ?>">
													<input type="hidden" name="merchant_security" value="<?php echo $content->merchant_security; ?>" class="merchant_security<?php echo $counter; ?>">	
                                                    <tr>
                                                        <td><?php echo $counter; ?></td>
                                                        <td class="meta_value<?php echo $counter; ?>"><?php echo $list['meta_value']; ?></td>
                                                        <td><?php echo $list['created_at']; ?></td>
														<?php
															if($modes == $list['meta_value']){
																$label_class = 'success';
																$status = 'Active';
															}else{
																$label_class = 'danger';
																$status = 'Inactive';
															}?>
                                                    
                                                        <td><span class="label label-<?php echo $label_class; ?>"><?php echo $status; ?></span></td>
                                                        <td><a id="<?php echo $counter; ?>" class="editmode">Edit</a></td>
                                                    </tr>
                                                <?php
													$counter++;
                                                }
												}
												?>
                                            </tbody>
                                        </table>
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

    <!-- data tables  -->
    <script src="<?php echo base_url(); ?>assets/admin_assets/js/datatable/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/admin_assets/js/datatable/dataTables.bootstrap4.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/admin_assets/js/datatable/dataTables.responsive.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/admin_assets/js/datatable/responsive.bootstrap4.min.js"></script>
	
<script>
	$(document).on("click" , ".editmode" , function() {
		$('.changetext').text('Edit');
		var id = $(this).attr('id');
		var meta_value = $('.meta_value'+id).text();
		var merchant_id = $('.merchant_id'+id).val();
		var merchant_security = $('.merchant_security'+id).val();
		var id = $('.id'+id).val();
		$('#meta_value').val(meta_value);
		$('#merchant_id').val(merchant_id);
		$('#merchant_security').val(merchant_security);
		$('#id').val(id);
	});
	$(document).on("click" , "#savemode" , function() {
		var btn = $('#savemode').ladda();
		btn.ladda('start');
		var value = new FormData( $("#add-offer")[0] );

		$.ajax({
			url:admin_url+'setting/addmultiplesetting',
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
						$(location).attr('href', admin_url+"setting/add_payment_method");
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