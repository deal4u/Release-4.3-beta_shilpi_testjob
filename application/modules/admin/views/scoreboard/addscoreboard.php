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
			<div class="wrapper wrapper-content animated fadeInRight pb-0">
				<div class="row">
					<div class="col-lg-12">
						<div class="ibox m-0">
							<div class="ibox-content ibox-content pt-4 pb-2">
								<div class="search_customer">
									<form role="form" class="form"  id="add-offer" method="post">
										<div class="row">
											<div class="col-md-12 col-sm-12">
												<div class="form-group">
													<label>Offer Text</label>
													<textarea class="form-control" name="offer_text" id="offer_text"></textarea>
												</div>
											</div>
											<div class="col-md-3 col-sm-12">
												<div class="form-group">
													<label>Validity</label>
													<input class="form-control" type="number" name="validity_days" id="validity_days"  />
												</div>
											</div>
											<div class="col-md-3 col-sm-12">
												<div class="form-group" id="data_8">
													<label>Start Date</label>
													<div class="input-group date">
														<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="offer_startdate" class="form-control">
													</div>
												</div>
											</div>
											<div class="col-md-3 col-sm-12">
												<div class="form-group" id="data_9">
													<label>End Date</label>
													 <div class="input-group date">
														<span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="offer_enddate" class="form-control">
													</div>
												</div>
											</div>
											<div class="col-md-3 col-sm-12">
                                                <div class="form-group" style="padding-top: 26px">
                                                    <button type="submit" id="addoffer" class="btn btn-block btn btn-primary">  Submit</button>
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
									<h5>Scoreboard</h5>
								</div>
                                <div class="ibox-content">
                                    <div class="mt-5"></div>
                                    <div class="table-responsive">
                                        <table class="table score-board-table">
                                            <thead>
                                                <tr>
                                                    <th>Sr No</th>
                                                    <th>Offer Text</th>
                                                    <th>Offer Start Date</th>
                                                    <th>Offer End Date</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $counter = 1; 
												foreach($offerlist as $offer) { ?>
                                                    <tr>
                                                        <td><?php echo $counter; ?></td>
                                                        <td><?php echo $offer['offer_text']; ?></td>
                                                        <td><?php echo $offer['offer_startdate']; ?></td>
                                                        <td><?php echo $offer['offer_enddate']; ?></td>
														<?php if($offer['status'] == 1){
															$label_class = 'primary';
															$label = 'Active';
														}else{
															$label_class = 'danger';
															$label = 'InActive';
														} ?>
                                                        <td><span class="label label-<?php echo $label_class; ?>"><?php echo $label; ?></span></td>
                                                    </tr>
                                                <?php
													$counter++;
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
	
	<script>
       $(document).ready(function () {
        $('.select-customer').select2();

        var cur_date = new Date();
        $('#data_8 .input-group.date').datepicker({
            todayBtn: "linked",
			minDate: cur_date,
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true,
            format: 'yyyy-mm-dd',
            defaultDate: '2021-01-01',
			
        });

        $('#data_8 .input-group.date').datepicker('setDate', cur_date );

        $('#data_9 .input-group.date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true,
            format: 'yyyy-mm-dd'
        });

        $('#data_9 .input-group.date').datepicker('setDate', cur_date );
		
        $(document).on("click" , "#addoffer" , function() {
            var btn = $('#addoffer').ladda();
            btn.ladda('start');
            var value = new FormData( $("#add-offer")[0] );

            $.ajax({
                url:admin_url+'scoreboard/add_scoreboardoffer',
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
                            $(location).attr('href', admin_url+"scoreboard/add_scoreboard_offer");
                        }, 2000);
                    }
                    else if(status.msg == 'error'){
                        btn.ladda('stop');
                        toastr.error(status.response, 'Error');
                    }
                }
            });
        });
        });

</script>