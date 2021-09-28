<!DOCTYPE html>
<html>
	<head>
		<?php $this->load->view('common/admin_header'); ?>
		<link href="<?php echo base_url(); ?>assets/admin_assets/css/datatable/dataTables.bootstrap4.min.css" rel="stylesheet">
		<link href="<?php echo base_url(); ?>assets/admin_assets/css/datatable/responsive.bootstrap4.min.css" rel="stylesheet">
	</head>
	<style>
	span.current {
    float: right;
    margin: -15px;
    background: #6060ff;
    padding: 3px;
    color: white;
}
	</style>
	<body>
		<div id="wrapper">
			<?php $this->load->view('common/customer_sidebar'); ?>
			<div id="page-wrapper" class="gray-bg">
				<div class="row border-bottom">
					<?php $this->load->view('common/admin_logoutbar'); ?>
				</div>
				<div class="dashbard-1 dashboard-grid wrapper wrapper-content animated fadeInRight">
					<div class="claims_list">
						<div class="table-responsive">
							<table id="claims_table" class="table table-bordered dt-responsive nowrap" style="width:100%;     margin-bottom: 0px;">
								<thead class="thead-custom">
									<tr>
										<th class="cch-color-01">My Policies <span class="label label-primary d-block text-center mt-2"></span></th>
									</tr>
								</thead>
							</table>
						</div>
					</div>
				</div>
				<div class="row dashbard-1 dashboard-grid wrapper wrapper-content animated fadeInRight" style="    padding-top: 0px;">
					<?php 
						//print_r( $customers);
						$i = 1;
						foreach( $customers as $customer){ }?>
					<?php 
						$latest_policy = get_customer_policies($customer['policy_num']);
						foreach( array_reverse($latest_policy) as $latest_policy){
							$property_type =get_setting('property_type',$latest_policy['property_type'],1) ;
							$property_type =$property_type[0]; 
							//print_r($latest_policy);
						?>
					<div class="col-md-3 col-lg-3">
						<div class="plc-md-dv">
						<?php 	$curdate=time();
							$plan_start=strtotime($latest_policy['plan_start']);
							$plan_end=strtotime($latest_policy['plan_end']);

							if(($plan_start < $curdate) &&  ($curdate < $plan_end))
							{
							  echo  $status = '<span class="current">Active</span>';
							} ?>
						
							<div>
								<p >Policy Number <?php echo $i; ?></p>
							</div>
							<div>
								<h2><?php echo $customer['policy_num']; ?></h2>
							</div>
							<div>
								<label style="color: #333333;">Term: </label> 
							</div>
							<div>
								<label style="color: #333333;"><span style="font-weight: 700"><?php echo date('Y-m-d', strtotime($latest_policy['plan_start'])); ?></span> to <span style="font-weight: 700"><?php echo date('Y-m-d', strtotime($latest_policy['plan_end'])); ?></span></label> 
							</div>
							<div>
								<label style="color: #333333;">Property Address: </label> 
							</div>
							<div>
								<label style="color: #333333;"><span style="font-weight: 700"><?php echo $customer['street_address']; ?><?php if(isset($customer['city'])){ echo ','.$customer['state']; }  ?><?php if(isset($customer['state'])){ echo ','.$customer['state']; }  ?><?php if(isset($customer['country'])){ echo ','.$customer['country']; }  ?></span></label> 
							</div>
							<div class="row">
								<div class="col-md-12 col-lg-12" style="display: flex;">
									<div class="col-md-6 col-lg-6">
										<div style="margin-top:10px;">
											<a class="plc-bt-a" target="_blank"href="<?php echo base_url(); ?>policy_pdf/get/<?php echo $latest_policy['pdf_randomid']; ?>">View Contract</a>
										</div>
									</div>
									<div class="col-md-6 col-lg-6">
										<div style="margin-top:10px;">
											<a class="plc-bt-a" href="<?php echo base_url(); ?>customers/dashboard/<?php echo $customer['policy_renewal_id']; ?>">View Details</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php $i++; } ?>
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