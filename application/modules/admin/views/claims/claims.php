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
                <h2>Claims</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="<?php echo admin_url(); ?>">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">
                        <strong>Claims</strong>
                    </li>
                </ol>
            </div>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Claims</h5>
                            <?php if (get_session('admin_type') == 2 && get_session('admin_permissions')['claims'] != 'N/A' && get_session('admin_permissions')['claims']['add'] == 1){ ?>
                                <a href="<?php echo admin_url(); ?>claims/add" class="btn btn-primary pull-right t_m_25 customer-btn"><i class='fa fa-plus'></i> Add Claim</a>
                            <?php }elseif (get_session('admin_type') == 1){ ?>
                                <a href="<?php echo admin_url(); ?>claims/add" class="btn btn-primary pull-right t_m_25 customer-btn"><i class='fa fa-plus'></i> Add Claim</a>
                            <?php } ?>
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table id="claims_table" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>Claim#</th>
                                        <th>Customer</th>
                                        <th>Representative</th>
                                        <th>Diagnose By</th>
                                        <th>Vendor</th>
                                        <th>Item</th>
                                        <th>Problem</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <?php if (get_session('admin_type') == 1 || (get_session('admin_type') == 2 && get_session('admin_permissions')['claims'] != 'N/A' && get_session('admin_permissions')['claims']['delete'] == 1)) { ?>
                                        <th>Action</th>
                                        <?php } ?>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($claims as $claim) { ?>
                                        <tr class="gradeX">
                                            <td>
                                                <a href="<?php echo admin_url(); ?>customers/edit/<?php echo $claim['customer']; ?>/<?php echo $claim['claim_num']; ?>" class="insert_log" id="<?php echo $claim['customer']; ?>"><?php echo $claim['claim_num']; ?></a>
                                            </td>
                                            <td>
                                                <?php $customer=get_customers($claim['customer']); ?>
                                                <a href="<?php echo admin_url(); ?>customers/edit/<?php echo $claim['customer']; ?>" class="insert_log" id="<?php echo $claim['customer']; ?>"><?php echo $customer['first_name'].' '.$customer['last_name']; ?></a>
                                            </td>
                                            <td>
                                                <?php
                                                $sales_person=get_staff_name($claim['representative']);
                                                echo $sales_person['FirstName'].' '.$sales_person['LastName'];
                                                ?>
                                            </td>
                                            <td>
                                                <?php if (!empty($claim['diagnose_by'])){
                                                    $diagnoser=get_staff_name($claim['diagnose_by']);
                                                    echo $diagnoser['FirstName'].' '.$diagnoser['LastName'];
                                                }else{ echo '-'; } ?>
                                            </td>
                                            <td>
                                                <?php if (!empty($claim['vendor'])){
                                                    $vendor = get_vendors($claim['vendor']);
                                                    echo $vendor['company'];
                                                }else{ echo '-'; } ?>
                                            </td>
                                            <td>
                                                <?php

                                                $str = $claim['item'];
                                                $str_meta_key = explode("-", $str);

                                                if ($str_meta_key[0] == 's') {
                                                    $meta_tag = 'systems';
                                                } elseif ($str_meta_key[0] == 'a') {
                                                    $meta_tag = 'appliance';
                                                } elseif ($str_meta_key[0] == 'c') {
                                                    $meta_tag = 'combo';
                                                } else {
                                                    $meta_tag = 'opt_coverage';
                                                }

                                                $get_meta_content = get_claim_value($meta_tag, $str_meta_key[1]);
                                                echo $get_meta_content['meta_content'];
                                                ?>
                                            </td>
                                            <td>
                                                <?php echo ucfirst($claim['problem']); ?>
                                            </td>
                                            <td>
                                                <?php echo date('F jS, Y - h:i a' ,strtotime($claim['created_at'])); ?>
                                            </td>
                                            <td>
                                                <span class="label label-primary"><?php echo claim_status($claim['status']); ?></span>
                                            </td>
                                            <?php if (get_session('admin_type') == 1 || (get_session('admin_type') == 2 && get_session('admin_permissions')['claims'] != 'N/A' && get_session('admin_permissions')['claims']['delete'] == 1)) { ?>
                                            <td>
                                                <section class="progress-demo"><button class="ladda-button btn btn-danger delete-btn" data-id="<?php echo $claim['id']; ?>" data-style="expand-right"><i class="fa fa-trash"></i> Delete</button></section>
                                            </td>
                                            <?php } ?>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
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


</body>
</html>

<script>
    $('#claims_table').dataTable({
        "paging": true,
        "searching": true,
        "responsive": true,
        "columnDefs": [
            { "responsivePriority": 1, "targets": 0 },
            { "responsivePriority": 2, "targets": -1 }
        ]
    });

    $(document).on('click', '.delete-btn', function (event) {

        var claim_id = $(this).attr('data-id');

        swal({
                title: "Are you sure?",
                text: "You want to delete this Claim!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, please!",
                cancelButtonText: "No, cancel please!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm) {
                if (isConfirm) {
                    var btn = $('.confirm').ladda();
                    btn.ladda('start');
                    $.ajax({
                        url:admin_url+'claims/delete_claim',
                        type:'post',
                        data:{ claim : claim_id },
                        dataType:'json',
                        success:function(status){

                            if(status.msg=='success'){
                                btn.ladda('stop');
                                swal({title: "Success!", text: status.response, type: "success"},
                                    function(){
                                        location.reload();
                                    });
                            } else if(status.msg=='error'){
                                btn.ladda('stop');
                                swal("Error", status.response, "error");
                            }
                        }
                    });
                } else {
                    swal("Cancelled", "", "error");
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
</script>
