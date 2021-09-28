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
                    <h2>Score Board</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?php echo admin_url(); ?>">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <strong>Score Board</strong>
                        </li>
                    </ol>
                </div>
            </div>
			<?php if(isset($activeoffer)){
                $current = date('Y-m-d', time());
                foreach($activeoffer as $offer){
                    if($offer['status'] == 1 && ($current >= $offer['offer_startdate'] && $current <= $offer['offer_enddate'])){ ?>
			<div class="wrapper wrapper-content animated fadeInRight pb-0">
				<div class="row">
					<div class="col-lg-12">
						<div class="ibox m-0">
							<div class="ibox-content ibox-content pt-4 pb-2">
								<div class="search_customer text-center" style="font-size: 30px; color: #26c0da;">
									<?php
										
									echo '<strong>'.$offer['offer_text'].'</strong>'; 
									 ?>									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php 
                    }
                }   
            } ?>
            <div class="tasks">
                <div class="wrapper wrapper-content animated fadeInRight">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="ibox ">
								<div class="ibox-title">
									<h5>Scoreboard</h5>
								</div>
                                <div class="ibox-content">
                                    <div class="mt-5"></div>
                                    <div class="table-responsive">
                                        <table class="table score-board-table">
                                            <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Score Board</th>
                                                    <th>Today</th>
                                                    <th>Weekly</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $counter =$i =  0; 
												 $CII = & get_instance();
												 ?>
                                                <?php foreach(get_salesperson() as $salesperson) {  
                                                    $permissions  =$CII->get_salesperson_scoreboard($salesperson['id']);
                                                    if(count($permissions)>0){
                                                    ?>
                                                    <tr>
                                                        <?php 
                                                        $miscellaneous = json_decode($permissions[0]['miscellaneous']);
                                                        if(!empty($permissions) && isset($miscellaneous->scoreboard_appear) && $miscellaneous->scoreboard_appear == 'on'){
														?>
                                                        <?php $counter  = count_today_score($salesperson['id']); ?>
                                                        <td>
                                                            <?php echo $salesperson['FirstName'].' '.$salesperson['LastName']; ?> 
                                                            (<?php print_r(count_all_score($salesperson['id'])); ?>)
                                                        </td>
                                                        <td>
                                                            <?php if($counter != 0) {
                                                                $floor_counter=floor($counter/5)+1;
                                                                for($i= 1; $i <= $floor_counter; $i++){  
                                                                    if($i==$floor_counter){
                                                                        $new_count=$floor_counter-1;
                                                                        $total=$new_count*5;
                                                                        $cur_count=$counter-$total;
                                                                    }   else {
                                                                        $cur_count=5;
                                                                    }
                                                                    echo '<span class="count-box">';
                                                                    for($j=1; $j <= $cur_count;  $j++) { 
                                                                        if($j==5){
                                                                            echo '<span class="cross-line"></span>';
                                                                        }
                                                                        else {
                                                                            echo '<span></span>';
                                                                        } 
                                                                    } 
                                                                    echo '</span>';
                                                                }
                                                            } ?>
                                                            
                                                        </td>
                                                        <td><?php echo $counter; ?></td>
                                                        <td><?php echo count_weekly_score($salesperson['id']); ?></td>
                                                       
                                                        
                                                    </tr>

                                                    <?php
                                                    }
													}
                                                } ?>
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
