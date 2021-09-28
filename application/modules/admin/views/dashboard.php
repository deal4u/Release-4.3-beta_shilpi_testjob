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

            <div class="dashbard-1 dashboard-grid wrapper wrapper-content animated fadeInRight">
                <div class="row d-flex justify-content-end">
                    <div class="col-lg-3 col-sm-12">
                        <form action="">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" placeholder="Claim #" class="input form-control claim-value">
                                    <span class="input-group-append"><button type="button" class="btn btn btn-primary claim-search"> <i class="fa fa-search"></i> Search</button></span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <?php $all_counts=claims_count();
                $claim_details = claims_detail(); ?>
                <div class="claims_list">
                    <div class="table-responsive">
                        <table id="claims_table" class="table table-bordered dt-responsive nowrap" style="width:100%">
                            <thead class="thead-custom">
                                <tr>
                                    <th>New <span class="label label-primary d-block text-center mt-2"><?php echo search_claim_status(1, $all_counts); ?></span></th>
                                    <th>Assigned <span class="label label-primary d-block text-center mt-2 label-coco"><?php echo search_claim_status(2,$all_counts); ?></span></th>
                                    <th>Open Callback <span class="label label-success d-block text-center mt-2"><?php echo search_claim_status(3,$all_counts); ?></span></th>
                                    <th>Suspended <span class="label label-danger d-block text-center mt-2"><?php echo search_claim_status(4,$all_counts); ?></span></th>
                                    <th>Reassign <span class="label label-warning d-block text-center mt-2"><?php echo search_claim_status(5,$all_counts); ?></span></th>
                                    <th>NTIA <span class="label label-primary d-block text-center mt-2 label-brown"><?php echo search_claim_status(6,$all_counts); ?></span></th>
                                    <th>Review <span class="label label-primary d-block text-center mt-2 label-green"><?php echo search_claim_status(7,$all_counts); ?></span></th>
                                    <th>Supervisor Callback <span class="label label-primary d-block text-center mt-2 label-blue"><?php echo search_claim_status(8,$all_counts); ?></span></th>
                                    <th>Vendor Callback <span class="label label-primary d-block text-center mt-2 label-pink"><?php echo search_claim_status(9,$all_counts); ?></span></th>
                                    <th>Closed Approved <span class="label label-primary d-block text-center mt-2 label-bist"><?php echo search_claim_status(10,$all_counts); ?></span></th>
                                    <th>Closed Denied <span class="label label-primary d-block text-center mt-2 label-black"><?php echo search_claim_status(11,$all_counts); ?></span></th>
                                    <th>Closed Buyout <span class="label label-primary d-block text-center mt-2 label-voilet"><?php echo search_claim_status(12,$all_counts); ?></span></th>
                                    <th>Closed Goodwill <span class="label label-primary d-block text-center mt-2 label-blush"><?php echo search_claim_status(13,$all_counts); ?></span></th>
                                    <th>Closed Cap <span class="label label-primary d-block text-center mt-2 label-purple"><?php echo search_claim_status(14,$all_counts); ?></span></th>
                                    <th>Closed <span class="label label-danger d-block text-center mt-2"><?php echo search_claim_status(15,$all_counts); ?></span></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <?php $new_claims = search_claim_details(1,$claim_details);
                                        if (!empty($new_claims)){
                                            foreach ($new_claims as $new){ ?>
                                                <div class="contact-box">
                                                    <div class="row no-gutters">
                                                        <div class="col-12">
                                                            <h1><strong><a href="<?php echo admin_url(); ?>customers/edit/<?php echo $new['customer']; ?>/<?php echo $new['claim_num']; ?>" class="insert_log" id="<?php echo $new['customer']; ?>">#<?php echo $new['claim_num']; ?></a></strong></h1>
                                                            <p class="contact-date text-navy"> <?php echo get_timeago(strtotime($new['created_at'])); ?></p>
                                                            <?php $customer = get_customers($new['customer']); ?>
                                                            <h3> <?php echo $customer['first_name'].' '.$customer['last_name']; ?> </h3>
                                                            <address><?php echo $customer['city'].' '.$customer['state'].', '.$customer['zip_code']; ?> </address>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php }
                                        }else{ ?>
                                            <span class="claim-nofound"><?php echo 'No Records Found'; ?></span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php $assign_claims = search_claim_details(2,$claim_details);
                                        if (!empty($assign_claims)){
                                            foreach ($assign_claims as $assigned){ ?>
                                                <div class="contact-box">
                                                    <div class="row no-gutters">
                                                        <div class="col-12">
                                                            <h1><strong><a href="<?php echo admin_url(); ?>customers/edit/<?php echo $assigned['customer']; ?>/<?php echo $assigned['claim_num']; ?>" class="insert_log" id="<?php echo $assigned['customer']; ?>">#<?php echo $assigned['claim_num']; ?></a></strong></h1>
                                                            <p class="contact-date text-navy"> <?php echo get_timeago(strtotime($assigned['created_at'])); ?></p>
                                                            <?php $customer = get_customers($assigned['customer']); ?>
                                                            <h3> <?php echo $customer['first_name'].' '.$customer['last_name']; ?> </h3>
                                                            <address> <?php echo $customer['city'].' '.$customer['state'].', '.$customer['zip_code']; ?> </address>

                                                        </div>
                                                    </div>
                                                </div>
                                            <?php }
                                        }else{ ?>
                                            <span class="claim-nofound"><?php echo 'No Records Found'; ?></span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php $dispatch_claims = search_claim_details(3,$claim_details);
                                        if (!empty($dispatch_claims)){
                                            foreach ($dispatch_claims as $dispatch){ ?>
                                                <div class="contact-box">
                                                    <div class="row no-gutters">
                                                        <div class="col-12">
                                                            <h1><strong><a href="<?php echo admin_url(); ?>customers/edit/<?php echo $dispatch['customer']; ?>/<?php echo $dispatch['claim_num']; ?>" class="insert_log" id="<?php echo $dispatch['customer']; ?>">#<?php echo $dispatch['claim_num']; ?></a></strong></h1>
                                                            <p class="contact-date text-navy"> <?php echo get_timeago(strtotime($dispatch['created_at'])); ?></p>
                                                            <?php $customer = get_customers($dispatch['customer']); ?>
                                                            <h3> <?php echo $customer['first_name'].' '.$customer['last_name']; ?> </h3>
                                                            <address> <?php echo $customer['city'].' '.$customer['state'].', '.$customer['zip_code']; ?></address>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php }
                                        }else{ ?>
                                            <span class="claim-nofound"><?php echo 'No Records Found'; ?></span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php $suspended_claims = search_claim_details(4,$claim_details);
                                        if (!empty($suspended_claims)){
                                            foreach ($suspended_claims as $suspended){ ?>
                                                <div class="contact-box">
                                                    <div class="row no-gutters">
                                                        <div class="col-12">
                                                            <h1><strong><a href="<?php echo admin_url(); ?>customers/edit/<?php echo $suspended['customer']; ?>/<?php echo $suspended['claim_num']; ?>" class="insert_log" id="<?php echo $suspended['customer']; ?>">#<?php echo $suspended['claim_num']; ?></a></strong></h1>
                                                            <p class="contact-date text-navy"> <?php echo get_timeago(strtotime($suspended['created_at'])); ?></p>
                                                            <?php $customer = get_customers($suspended['customer']); ?>
                                                            <h3> <?php echo $customer['first_name'].' '.$customer['last_name']; ?></h3>
                                                            <address> <?php echo $customer['city'].' '.$customer['state'].', '.$customer['zip_code']; ?></address>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php }
                                        }else{ ?>
                                            <span class="claim-nofound"><?php echo 'No Records Found'; ?></span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php $reassign_claims = search_claim_details(5,$claim_details);
                                        if (!empty($reassign_claims)){
                                            foreach ($reassign_claims as $reassign){ ?>
                                                <div class="contact-box">
                                                    <div class="row no-gutters">
                                                        <div class="col-12">
                                                            <h1><strong><a href="<?php echo admin_url(); ?>customers/edit/<?php echo $reassign['customer']; ?>/<?php echo $reassign['claim_num']; ?>" class="insert_log" id="<?php echo $reassign['customer']; ?>">#<?php echo $reassign['claim_num']; ?></a></strong></h1>
                                                            <p class="contact-date text-navy"> <?php echo get_timeago(strtotime($reassign['created_at'])); ?></p>
                                                            <?php $customer = get_customers($reassign['customer']); ?>
                                                            <h3> <?php echo $customer['first_name'].' '.$customer['last_name']; ?></h3>
                                                            <address> <?php echo $customer['city'].' '.$customer['state'].', '.$customer['zip_code']; ?></address>

                                                        </div>
                                                    </div>
                                                </div>
                                            <?php }
                                        }else{ ?>
                                            <span class="claim-nofound"><?php echo 'No Records Found'; ?></span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php $ntia_claims = search_claim_details(6,$claim_details);
                                        if (!empty($ntia_claims)){
                                            foreach ($ntia_claims as $ntia){ ?>
                                                <div class="contact-box">
                                                    <div class="row no-gutters">
                                                        <div class="col-12">
                                                            <h1><strong><a href="<?php echo admin_url(); ?>customers/edit/<?php echo $ntia['customer']; ?>/<?php echo $ntia['claim_num']; ?>" class="insert_log" id="<?php echo $ntia['customer']; ?>">#<?php echo $ntia['claim_num']; ?></a></strong></h1>
                                                            <p class="contact-date text-navy"> <?php echo get_timeago(strtotime($ntia['created_at'])); ?></p>
                                                            <?php $customer = get_customers($ntia['customer']); ?>
                                                            <h3> <?php echo $customer['first_name'].' '.$customer['last_name']; ?></h3>
                                                            <address> <?php echo $customer['city'].' '.$customer['state'].', '.$customer['zip_code']; ?></address>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php }
                                        }else{ ?>
                                            <span class="claim-nofound"><?php echo 'No Records Found'; ?></span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php $review_claims = search_claim_details(7,$claim_details);
                                        if (!empty($review_claims)){
                                            foreach ($review_claims as $review){ ?>
                                                <div class="contact-box">
                                                    <div class="row no-gutters">
                                                        <div class="col-12">
                                                            <h1><strong><a href="<?php echo admin_url(); ?>customers/edit/<?php echo $review['customer']; ?>/<?php echo $review['claim_num']; ?>" class="insert_log" id="<?php echo $review['customer']; ?>">#<?php echo $review['claim_num']; ?></a></strong></h1>
                                                            <p class="contact-date text-navy"> <?php echo get_timeago(strtotime($review['created_at'])); ?></p>
                                                            <?php $customer = get_customers($review['customer']); ?>
                                                            <h3> <?php echo $customer['first_name'].' '.$customer['last_name']; ?></h3>
                                                            <address> <?php echo $customer['city'].' '.$customer['state'].', '.$customer['zip_code']; ?></address>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php }
                                        }else{ ?>
                                            <span class="claim-nofound"><?php echo 'No Records Found'; ?></span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php $supervisor_claims = search_claim_details(8,$claim_details);
                                        if (!empty($supervisor_claims)){
                                            foreach ($supervisor_claims as $supervisor){ ?>
                                                <div class="contact-box">
                                                    <div class="row no-gutters">
                                                        <div class="col-12">
                                                            <h1><strong><a href="<?php echo admin_url(); ?>customers/edit/<?php echo $supervisor['customer']; ?>/<?php echo $supervisor['claim_num']; ?>" class="insert_log" id="<?php echo $supervisor['customer']; ?>">#<?php echo $supervisor['claim_num']; ?></a></strong></h1>
                                                            <p class="contact-date text-navy"> <?php echo get_timeago(strtotime($supervisor['created_at'])); ?></p>
                                                            <?php $customer = get_customers($supervisor['customer']); ?>
                                                            <h3> <?php echo $customer['first_name'].' '.$customer['last_name']; ?></h3>
                                                            <address> <?php echo $customer['city'].' '.$customer['state'].', '.$customer['zip_code']; ?></address>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php }
                                        }else{ ?>
                                            <span class="claim-nofound"><?php echo 'No Records Found'; ?></span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php $vendor_claims = search_claim_details( 9,$claim_details);
                                        if (!empty($vendor_claims)){
                                            foreach ($vendor_claims as $vendor){ ?>
                                                <div class="contact-box">
                                                    <div class="row no-gutters">
                                                        <div class="col-12">
                                                            <h1><strong><a href="<?php echo admin_url(); ?>customers/edit/<?php echo $vendor['customer']; ?>/<?php echo $vendor['claim_num']; ?>" class="insert_log" id="<?php echo $vendor['customer']; ?>">#<?php echo $vendor['claim_num']; ?></a></strong></h1>
                                                            <p class="contact-date text-navy"> <?php echo get_timeago(strtotime($vendor['created_at'])); ?></p>
                                                            <?php $customer = get_customers($vendor['customer']); ?>
                                                            <h3> <?php echo $customer['first_name'].' '.$customer['last_name']; ?></h3>
                                                            <address> <?php echo $customer['city'].' '.$customer['state'].', '.$customer['zip_code']; ?></address>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php }
                                        }else{ ?>
                                            <span class="claim-nofound"><?php echo 'No Records Found'; ?></span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php $approved_claims = search_claim_details( 10,$claim_details);
                                        if (!empty($approved_claims)){
                                            foreach ($approved_claims as $approved){ ?>
                                                <div class="contact-box">
                                                    <div class="row no-gutters">
                                                        <div class="col-12">
                                                            <h1><strong><a href="<?php echo admin_url(); ?>customers/edit/<?php echo $approved['customer']; ?>/<?php echo $approved['claim_num']; ?>" class="insert_log" id="<?php echo $approved['customer']; ?>">#<?php echo $approved['claim_num']; ?></a></strong></h1>
                                                            <p class="contact-date text-navy"> <?php echo get_timeago(strtotime($approved['created_at'])); ?></p>
                                                            <?php $customer = get_customers($approved['customer']); ?>
                                                            <h3> <?php echo $customer['first_name'].' '.$customer['last_name']; ?></h3>
                                                            <address> <?php echo $customer['city'].' '.$customer['state'].', '.$customer['zip_code']; ?></address>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php }
                                        }else{ ?>
                                            <span class="claim-nofound"><?php echo 'No Records Found'; ?></span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php $denied_claims = search_claim_details( 11,$claim_details);
                                        if (!empty($denied_claims)){
                                            foreach ($denied_claims as $denied){ ?>
                                                <div class="contact-box">
                                                    <div class="row no-gutters">
                                                        <div class="col-12">
                                                            <h1><strong><a href="<?php echo admin_url(); ?>customers/edit/<?php echo $denied['customer']; ?>/<?php echo $denied['claim_num']; ?>" class="insert_log" id="<?php echo $denied['customer']; ?>">#<?php echo $denied['claim_num']; ?></a></strong></h1>
                                                            <p class="contact-date text-navy"> <?php echo get_timeago(strtotime($denied['created_at'])); ?></p>
                                                            <?php $customer = get_customers($denied['customer']); ?>
                                                            <h3> <?php echo $customer['first_name'].' '.$customer['last_name']; ?></h3>
                                                            <address> <?php echo $customer['city'].' '.$customer['state'].', '.$customer['zip_code']; ?></address>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php }
                                        }else{ ?>
                                            <span class="claim-nofound"><?php echo 'No Records Found'; ?></span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php $buyout_claims = search_claim_details( 12,$claim_details);
                                        if (!empty($buyout_claims)){
                                            foreach ($buyout_claims as $buyout){ ?>
                                                <div class="contact-box">
                                                    <div class="row no-gutters">
                                                        <div class="col-12">
                                                            <h1><strong><a href="<?php echo admin_url(); ?>customers/edit/<?php echo $buyout['customer']; ?>/<?php echo $buyout['claim_num']; ?>" class="insert_log" id="<?php echo $buyout['customer']; ?>">#<?php echo $buyout['claim_num']; ?></a></strong></h1>
                                                            <p class="contact-date text-navy"> <?php echo get_timeago(strtotime($buyout['created_at'])); ?></p>
                                                            <?php $customer = get_customers($buyout['customer']); ?>
                                                            <h3> <?php echo $customer['first_name'].' '.$customer['last_name']; ?></h3>
                                                            <address> <?php echo $customer['city'].' '.$customer['state'].', '.$customer['zip_code']; ?></address>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php }
                                        }else{ ?>
                                            <span class="claim-nofound"><?php echo 'No Records Found'; ?></span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php $goodwill_claims = search_claim_details( 13,$claim_details);
                                        if (!empty($goodwill_claims)){
                                            foreach ($goodwill_claims as $goodwill){ ?>
                                                <div class="contact-box">
                                                    <div class="row no-gutters">
                                                        <div class="col-12">
                                                            <h1><strong><a href="<?php echo admin_url(); ?>customers/edit/<?php echo $goodwill['customer']; ?>/<?php echo $goodwill['claim_num']; ?>" class="insert_log" id="<?php echo $goodwill['customer']; ?>">#<?php echo $goodwill['claim_num']; ?></a></strong></h1>
                                                            <p class="contact-date text-navy"> <?php echo get_timeago(strtotime($goodwill['created_at'])); ?></p>
                                                            <?php $customer = get_customers($goodwill['customer']); ?>
                                                            <h3> <?php echo $customer['first_name'].' '.$customer['last_name']; ?></h3>
                                                            <address> <?php echo $customer['city'].' '.$customer['state'].', '.$customer['zip_code']; ?></address>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php }
                                        }else{ ?>
                                            <span class="claim-nofound"><?php echo 'No Records Found'; ?></span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php $cap_claims = search_claim_details( 14,$claim_details);
                                        if (!empty($cap_claims)){
                                            foreach ($cap_claims as $cap){ ?>
                                                <div class="contact-box">
                                                    <div class="row no-gutters">
                                                        <div class="col-12">
                                                            <h1><strong><a href="<?php echo admin_url(); ?>customers/edit/<?php echo $cap['customer']; ?>/<?php echo $cap['claim_num']; ?> " class="insert_log" id="<?php echo $cap['customer']; ?>">#<?php echo $cap['claim_num']; ?></a></strong></h1>
                                                            <p class="contact-date text-navy"> <?php echo get_timeago(strtotime($cap['created_at'])); ?></p>
                                                            <?php $customer = get_customers($cap['customer']); ?>
                                                            <h3> <?php echo $customer['first_name'].' '.$customer['last_name']; ?></h3>
                                                            <address> <?php echo $customer['city'].' '.$customer['state'].', '.$customer['zip_code']; ?></address>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php }
                                        }else{ ?>
                                            <span class="claim-nofound"><?php echo 'No Records Found'; ?></span>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <?php $closed_claims = search_claim_details( 15,$claim_details);
                                        if (!empty($closed_claims)){
                                            foreach ($closed_claims as $closed){ ?>
                                                <div class="contact-box">
                                                    <div class="row no-gutters">
                                                        <div class="col-12">
                                                            <h1><strong><a href="<?php echo admin_url(); ?>customers/edit/<?php echo $closed['customer']; ?>/<?php echo $closed['claim_num']; ?>" class="insert_log" id="<?php echo $closed['customer']; ?>">#<?php echo $closed['claim_num']; ?></a></strong></h1>
                                                            <p class="contact-date text-navy"> <?php echo get_timeago(strtotime($closed['created_at'])); ?></p>
                                                            <?php $customer = get_customers($closed['customer']); ?>
                                                            <h3> <?php echo $customer['first_name'].' '.$customer['last_name']; ?></h3>
                                                            <address> <?php echo $customer['city'].' '.$customer['state'].', '.$customer['zip_code']; ?></address>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php }
                                        }else{ ?>
                                            <span class="claim-nofound"><?php echo 'No Records Found'; ?></span>
                                        <?php } ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
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

    <script>
        $(document).ready(function () {
            setTimeout(function() {
                toastr.options = {
                    closeButton: true,
                    progressBar: true,
                    showMethod: 'slideDown',
                    timeOut: 4000
                };
                toastr.success('Administrative Control', 'Welcome to REGAL HOME WARRANTY');

            }, 1300);

            $('.claim-search').on('click', function () {
                var number = $('.claim-value').val();
                $.ajax({
                    url:admin_url+'claims/get_claim',
                    type: 'POST',
                    data: { id : number},
                    dataType:'json',
                    success:function(status){
                        if(status.msg=='success'){
                             window.location.href = status.response;
                            // $('.claims_list').html(status.response);
                        }
                        else if(status.msg == 'error'){
                            toastr.error(status.response);
                        }
                    }
                });
            });
            $('.insert_log').on('click', function () {
                var customer_id = $(this).attr('id');
                $.ajax({
                   type: "POST",
                   url:admin_url+'customers/insert_policy_log',
                   data: {customer_id: customer_id}, 
                   cache:false,
                   success:function(status){

                }
            });
            });
        });

    </script>

</body>
</html>