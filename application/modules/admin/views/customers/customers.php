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
                <h2>Customers</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="<?php echo admin_url(); ?>">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">
                        <strong>Customers</strong>
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
                                <form role="form" class="form" id="search_customer" method="GET" action="<?php echo admin_url(); ?>customers/search_customer">
                                    <div class="row">
                                        <div class="col-md-3 col-sm-12">
                                            <div class="form-group"> <input type="text" placeholder="First Name" name="fname" value="<?php echo @$param['fname']; ?>" class="form-control"></div>
                                        </div>
                                        <div class="col-md-3 col-sm-12">
                                            <div class="form-group"> <input type="text" placeholder="Last Name" name="lname" value="<?php echo @$param['lname']; ?>" class="form-control"></div>
                                        </div>
                                        <div class="col-md-3 col-sm-12">
                                            <div class="form-group"> <input type="text" name="number" placeholder="Phone Number" value="<?php echo @$param['number']; ?>" class="form-control"></div>
                                        </div>
                                        <div class="col-md-3 col-sm-12">
                                            <div class="form-group">
                                                <select class="form-control" name="status">
                                                    <option selected value="">Status</option>
                                                    <option value="1" <?php if(@$param['status']){ if ($param['status']==1){ ?> selected <?php } } ?>>New</option>
                                                    <option value="2" <?php if(@$param['status']){ if ($param['status']==2){ ?> selected <?php } } ?>>Active</option>
                                                    <option value="3" <?php if(@$param['status']){ if ($param['status']==3){ ?> selected <?php } } ?>>InActive</option>
                                                    <option value="4" <?php if(@$param['status']){ if ($param['status']==4){ ?> selected <?php } } ?>>Past Due</option>
                                                    <option value="5" <?php if(@$param['status']){ if ($param['status']==5){ ?> selected <?php } } ?>>Cancelled</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-12">
                                            <div class="form-group"><input type="email" placeholder="Enter email" value="<?php echo @$param['email']; ?>" class="form-control" name="email"></div>
                                        </div>
                                        <div class="col-md-3 col-sm-12">
                                            <div class="form-group"><input type="text" placeholder="Address" value="<?php echo @$param['address']; ?>" class="form-control" name="address"></div>
                                        </div>
                                        <div class="col-md-3 col-sm-12">
                                            <div class="form-group"><input type="text" placeholder="ZIP" value="<?php echo @$param['zip']; ?>" class="form-control" name="zip"></div>
                                        </div>
                                        <div class="col-md-3 col-sm-12">
                                            <div class="form-group">
                                                <select class="form-control" name="representative">
                                                    <option selected value="">Sales Rep</option>
                                                    <?php foreach (get_sales_representative() as $repres){ ?>
                                                        <option value="<?php echo $repres['id']; ?>" <?php if(@$param['representative']){ if ($param['representative']==$repres['id']){ ?> selected <?php } } ?>><?php echo $repres['FirstName'].' '.$repres['LastName']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-12">
                                            <div class="form-group">
                                                <select class="form-control" name="source">
                                                    <option selected value="">Lead Source</option>
                                                    <?php foreach (get_leadsource() as $source){ ?>
                                                        <option value="<?php echo $source['id']; ?>" <?php if(@$param['source']){ if ($param['source']==$source['id']){ ?> selected <?php } } ?>><?php echo $source['name']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-12">
                                            <div class="form-group"><input type="text" placeholder="Policy #" value="<?php echo @$param['policyno']; ?>" class="form-control" name="policyno"></div>
                                        </div>
                                        <div class="col-md-3 col-sm-12">
                                            <div class="form-group"><input type="text" placeholder="Claim #" value="<?php echo @$param['claimno']; ?>" class="form-control" name="claimno"></div>
                                        </div>
                                        <div class="col-md-3 col-sm-12">
                                            <div class="form-group">
                                                <input type="text" placeholder="CC" value="<?php echo @$param['cc']; ?>" class="input form-control" name="cc">
                                            </div>
                                        </div>

                                        <div class="col-md-3 col-sm-12">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-block btn btn-primary"> <i class="fa fa-search"></i> Search</button>
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

        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Customers</h5>
                            <?php if (get_session('admin_type') == 1 || (get_session('admin_type') == 2 && get_session('admin_permissions')['miscellaneous'] != 'N/A' && isset(get_session('admin_permissions')['miscellaneous']->add_customer))) { ?>
                                <a href="<?php echo admin_url(); ?>customers/add" class="btn btn-primary pull-right t_m_25 customer-btn"><i class='fa fa-plus'></i> Add Customer</a>
                            <?php } ?>
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table id="customers_table" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Sale By</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>State</th>
                                        <th>Plan Name</th>
                                        <th>Date</th>
                                        <?php if (get_session('admin_type') == 1 || (get_session('admin_type') == 2 && get_session('admin_permissions')['miscellaneous'] != 'N/A' && isset(get_session('admin_permissions')['miscellaneous']->status))) { ?>
                                            <th>Status</th>
                                        <?php } ?>
                                        <th>Plan Total</th>
                                         <?php if (get_session('admin_type') == 1 ) { ?>        
                                            <th>Action</th>
                                        <?php } ?>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach ($customers as $customer) { ?>
                                        <tr class="gradeX">
                                            <td>
                                                <a href="<?php echo admin_url(); ?>customers/edit/<?php echo $customer['id']; ?>"  id="<?php echo $customer['id']; ?>" class="insert_log"><?php echo $customer['first_name'].' '.$customer['last_name']; ?></a>
                                            </td>
                                            <td>
                                                <?php
                                                $sales_person=get_staff_name($customer['salesperson']);
                                                echo $sales_person['FirstName'].' '.$sales_person['LastName'];
                                                ?>
                                            </td>
                                            <td>
                                                <?php echo $customer['email']; ?>
                                            </td>
                                            <td>
                                                <?php echo $customer['home_phone']; ?>
                                            </td>
                                            <td>
                                                <?php echo $customer['state']; ?>
                                            </td>
                                            <td>
                                                <?php
                                                $customers_policy = get_customer_policy($customer['policy_num']);
                                                $plan_value = get_plan_name('plan', $customers_policy['plan']);
                                                ?>
                                                <?php echo $plan_value['meta_content']; ?>
                                            </td>
                                            <td>
                                                <?php echo date('F jS, Y - h:i a', strtotime($customers_policy['created_at'])); ?>
                                            </td>
                                            <?php if (get_session('admin_type') == 1 || (get_session('admin_type') == 2 && get_session('admin_permissions')['miscellaneous'] != 'N/A' && isset(get_session('admin_permissions')['miscellaneous']->status))) { ?>
                                                <td>
                                                    <?php
                                                    $label_class = 'primary';
                                                    $label = 'New';
                                                    if($customer['policy_status'] == 1){
                                                        $label_class = 'primary';
                                                        $label = 'New';
                                                    }elseif($customer['policy_status'] == 2){
                                                        $label_class = 'success';
                                                        $label = 'Active';
                                                    }elseif($customer['policy_status'] == 3){
                                                        $label_class = 'danger';
                                                        $label = 'InActive';
                                                    }elseif($customer['policy_status'] == 4){
                                                        $label_class = 'warning';
                                                        $label = 'Past Due';
                                                    }elseif($customer['policy_status'] == 5){
                                                        $label_class = 'default';
                                                        $label = 'Cancelled';
                                                    }elseif($customer['policy_status'] == 6){
                                                        $label_class = 'default';
                                                        $label = 'Expired';
                                                    } ?>
                                                    <span class="label label-<?php echo $label_class; ?>"><?php echo $label; ?></span>
                                                </td>
                                            <?php } ?>
                                            <td>
                                                <?php echo '$'.$customers_policy['net_total']; ?>
                                            </td>
                                            <?php if (get_session('admin_type') == 1 ) { ?>     
                                            <td>
                                                <section class="progress-demo"><button class="ladda-button btn btn-danger delete-btn" data-id="<?php echo $customer['id']; ?>" data-style="expand-right"><i class="fa fa-trash"></i> Delete</button></section>
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
    $('#customers_table').dataTable({
        "paging": true,
        "searching": true,
        "responsive": true,
        "aaSorting": [], 
        "columnDefs": [
            { "responsivePriority": 1, "targets": 0 },
            { "responsivePriority": 2, "targets": -1 }
        ]
    });

    $(document).on('click', '.delete-btn', function (event) {

        var customer = $(this).attr('data-id');
        swal({
                title: "Are you sure?",
                text: "You want to delete this Customer!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, please!",
                cancelButtonText: "No, cancel please!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm) {
                var btn = $('.confirm').ladda();
                btn.ladda('start');
                if (isConfirm) {
                    $.ajax({
                        url:admin_url+'customers/delete_customer',
                        type:'post',
                        data:{ customer : customer },
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
                    btn.ladda('stop');
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