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
						<h2>Policy Details</h2>
						<ol class="breadcrumb">
							<li class="breadcrumb-item">
								<a href="<?php echo base_url(); ?>">Dashboard</a>
							</li>
							<li class="breadcrumb-item active">
								<strong>Policy Details</strong>
							</li>
						</ol>
					</div>
				</div>
				<?php //print_r($profile_data);
					$latest_policy = get_customer_policy($profile_data[0]['policy_num']);
					$property_type =get_setting('property_type',$profile_data[0]['property_type'],1) ;
					$property_type =$property_type[0];              ?>
				<div class="wrapper wrapper-content animated fadeInRight pb-0">
					<div class="row">
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
							<div class="wrapper wrapper-content animated fadeInRight">
								<div class="row">
									<div class="col-md-12 col-sm-12">
										<div class="ibox m-0">
											<div class="ibox-content ibox-content pt-4 pb-2">
												<div class="left_section">
													<form method="post" id="save-claim">
														<input type="hidden" name="customer" class="form-control select-customer" value="37"> 
														<div class="form_section">
															<div class="row " style="align-items: center;">
                                                    <div class="col-md-6">
                                                    <h3 class="txt-h-hd">Policy Details</h3>
                                                  </div>
                                                    <div class="col-md-6 text-right">
                                                      <a class="plc-bt-a" href="<?php echo base_url().'customers/claims'; ?>">Make New Claim</a>
                                                    
                                                  </div>
                                                  </div>
															<!-- <h2 class="mb-4">Policy Details</h2> -->
															<div class="row">
																<div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
																	<div class="form-group">
																		<label>Customer Name</label>
																		<label class="form-control-plaintext cst_detail_fnt"><?php echo  $profile_data[0]['first_name']; ?> <?php echo $profile_data[0]['last_name']; ?></label>
																	</div>
																</div>
																<div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
																	<div class="form-group">
																		<label>Covered Property</label>
																		<label class="form-control-plaintext cst_detail_fnt"><?php echo $profile_data[0]['street_address']; ?></label>
																	</div>
																</div>
																<div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
																	<div class="form-group" >
																		<label>Property Type</label>
																		<label class="form-control-plaintext cst_detail_fnt"><?php echo $property_type['meta_content']; ?></label>
																	</div>
																</div>
																<div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
																	<div class="form-group">
																		<label>Contract Term</label>
																		<label class="form-control-plaintext cst_detail_fnt"><?php echo date('Y-m-d', strtotime($profile_data[0]['plan_start'])); ?> - <?php echo date('Y-m-d', strtotime($profile_data[0]['plan_end'])); ?></label>
																	</div>
																</div>
																<div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
																	<div class="form-group">
																		<label>Contract Status</label>
																		<label class="form-control-plaintext cst_detail_fnt red-in-dng"><?php $sstatus = array('1'=>'New','2'=>'Active','3'=>'Inactive','4'=> 'Past Due','5'=> 'Cancelled','6'=> 'Expired' );
																			echo $sstatus[$profile_data[0]['status']]; ?></label>
																	</div>
																</div>
																<div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
																	<div class="form-group">
																		<label>Coverage Plan</label>
																		<label class="form-control-plaintext cst_detail_fnt "><?php $plan_value = get_plan_name('plan', $profile_data[0]['plan']);?>
																		<?php echo $plan_value['meta_content']; ?></label>
																	</div>
																</div>
																<div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
																	<div class="form-group">
																		<label>Plan Cost</label>
																		<label class="form-control-plaintext cst_detail_fnt ">$<?php echo number_format((float)$plan_value['meta_value'], 2, '.', ''); ?></label>
																	</div>
																</div>
																<div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
																	<div class="form-group">
																		<label>Plan Term</label>
																		<label class="form-control-plaintext cst_detail_fnt "><?php 
																		if($profile_data[0]['plan_initial'] =='1'){ echo "Year";}else{
																		echo "Montly"; }
																		?></label>
																	</div>
																</div>
																<div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
																	<div class="form-group">
																		<label>Amount </label>
																		<label class="form-control-plaintext cst_detail_fnt ">$<?php echo $profile_data[0]['plan_initial']; ?></label>
																	</div>
																</div>
															</div>
															<!-- <div class="hr-line-dashed"></div> -->
															<!--    <h2 class="mb-4">Plan Coverage</h2> -->
														</div>
													</form>
												</div>
												<div class="row">
													<div class="col-md-6 col-sm-6" >
														<div class="left_section">
															<form method="post" id="save-claim">
																<input type="hidden" name="customer" class="form-control select-customer" value="37"> 
																<div class="form_section">
																	<h2 class="mb-4">Plan Coverage</h2>
																	<div class="row">
																		<div class="col-12 dv-ln">
																			<table class="table table-striped bg-strp">
																				<tbody>
																			<?php  $plan = get_setting($plan_value['meta_content'],"", 1, $meta_value="");
																				$i = 1;
																				foreach ($plan as $plan_cober){   ?>
																			<tr>
																				<th scope="row"><?php echo $i; ?></th>
																				<td><?php echo $plan_cober['meta_content'];  ?></td>
																				<td><img src="<?php echo base_url().'/assets/images/yes_green.png'; ?>"></td>
																			</tr>
																			<?php $i++;}
																				?>
																				</tbody>
																			</table>
																		</div>
																	</div>
																</div>
															</form>
														</div>
														
														<div class="left_section">
															<form method="post" id="save-claim">
																<input type="hidden" name="customer" class="form-control select-customer" value="37"> 
																<div class="form_section">
																	<h2 class="mb-4">Optional Coverage</h2>
																	<div class="row">
																		<div class="col-12 ">
																			<table class="table table-striped bg-strp">
																				<tbody>
																					<?php  $ii= 1; 
																					$cov = get_coverage($idx, $renewal_id) ;
																					if(isset($cov)&& !empty(($cov))){
																					foreach ($cov as $cov_id){
																						$selected = get_setting('opt_coverage',$cov_id['coverage'],1);
																						$years = $profile_data[0]['plan_year'];
																						$year_months = $years;
																						$months = $profile_data[0]['free_month'];
																						$total_months = $year_months;
																						?>
																					<tr>
																						<th scope="row"><?php echo $ii; ?></th>
																						<td><?php echo $selected[0]['meta_content'];  ?></td>
																						<td><img src="<?php echo base_url().'/assets/images/yes_green.png'; ?>"></td>
																					</tr>
																					</tr>
																					<?php  $ii++ ;} }else{
																						echo "No data found";
																						
																					}?>
																				</tbody>
																			</table>
																		</div>
																	</div>
																</div>
															</form>
														</div>
													</div>
													<div class="col-md-6 col-sm-6" >


														<div class="left_section">
															
																<input type="hidden" name="customer" class="form-control select-customer" value="37"> 
																<div class="form_section">
																	<h2 class="mb-4">Claim Status</h2>
																	<div class="row dv-scrl-up">
																		<div class="col-md-12 col-sm-12">
																			<div class="left_section">
																	
																		   <?php $claims = get_data('','claims',array('customer'=>$idx),$select = '', $limit = '','id', $order = "", $joins = '', $group_by = "");
                                            
											  if (empty($claims)){
                                                    echo 'No Records Found';
                                                }else{ ?>	<?php foreach ($claims as $data){  ?>
																		 <div class="form_section claim_box">
																			<div class="row " style="align-items: center;">
																			<div class="col-md-6">
																			<h3 class="txt-h-hd">Claim ID: #<?php echo $data['claim_num']; ?></h3>
																		  </div>
																			<div class="col-md-6 text-right">
																			  <a class="plc-bt-a" href="<?php echo base_url().'customers/claims/view_claim_details/'.$data['id']; ?>">View Details</a>
																			
																		  </div>
																		  </div>
																			<div class="row">
																			  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
																					<div class="form-group">
																						<label>Claim Date</label>
																					   <label class="form-control-plaintext cst_detail_fnt"><?php echo $data['created_at']; ?></label>
																					</div>
																				</div>
																				<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
																					<div class="form-group">
																						<label>Appliance</label>
																						 <?php
                                                                $str =  $data['item'];
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
																				<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
																					<div class="form-group">
																						<label>Brand</label>
																						 <label class="form-control-plaintext cst_detail_fnt"><?php echo $data['make']; ?></label>
																					</div>
																				</div>
																				<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
																					<div class="form-group">
																						<label>Issue</label>
																						 <label class="form-control-plaintext cst_detail_fnt"><?php echo $data['problem']; ?></label>
																					</div>
																				</div>
																				<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
																					<div class="form-group">
																						<label>Last Time Working</label>
																						 <label class="form-control-plaintext cst_detail_fnt"><?php echo $data['last_working']; ?></label>
																					</div>
																				</div>
																				<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
																					<div class="form-group">
																						<label>Description</label>
																						 <label class="form-control-plaintext cst_detail_fnt"><?php echo $data['description']; ?></label>
																					</div>
																				</div>
																			</div>
																		  </div>
												<?php }  }?>	
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
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php $this->load->view('common/admin_scripts'); ?>
		<script src="<?php echo base_url(); ?>assets/admin_assets/js/datatable/jquery.dataTables.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/admin_assets/js/datatable/dataTables.bootstrap4.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/admin_assets/js/datatable/dataTables.responsive.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/admin_assets/js/datatable/responsive.bootstrap4.min.js"></script>
	</body>
</html>
<Script>
	var date = '12-05-2021';
	  
	   var year  = new Date(date).getFullYear();
	   var month = new Date(date).getMonth();
	   var day   = new Date(date).getDate();
	   var date  = new Date(year + 3, month, day);
	  console.log(date);
</script>