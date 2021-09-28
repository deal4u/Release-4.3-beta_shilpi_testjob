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
                <h2>Invoice</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="<?php echo admin_url(); ?>">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">
                        <strong>Vendor Invoice</strong>
                    </li>
                </ol>
            </div>
        </div>
        <div class="tasks">
            <div class="wrapper wrapper-content animated fadeInRight pb-0">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox m-0">
                            <div class="ibox-content ibox-content pt-4 pb-2">
                                <div class="filter_tasks">
                                    <form role="form" class="form" id="filter_tasks"  method="GET" action="<?php echo admin_url(); ?>invoice/search_vendor_invoice">
                                        <div class="row">
                                            <div class="col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <label>Name</label>
                                                    <input type="text" class="form-control" name="name" value="<?php echo @$param['name']; ?>" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <label>Claim #</label>
                                                    <input type="number" min="0" class="form-control" name="claim_num" value="<?php echo @$param['claim_num']; ?>" autocomplete="off">
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <label>Invoice Status</label>
                                                    <select class="form-control" name="invoice_status" >
                                                        <option selected value="">Any</option>
                                                        <option value="1" <?php if(@$param['invoice_status']){ if ($param['invoice_status']==1){ ?> selected <?php } } ?>>New</option>
                                                        <option value="2" <?php if(@$param['invoice_status']){ if ($param['invoice_status']==2){ ?> selected <?php } } ?>>Rejected</option>
                                                        <option value="3" <?php if(@$param['invoice_status']){ if ($param['invoice_status']==3){ ?> selected <?php } } ?>>Approved</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <label>Vendor Status</label>
                                                    <select class="form-control" name="vendor_status">
                                                        <option selected value="">Status</option>
                                                        <option value="1" <?php if(@$param['vendor_status']){ if ($param['vendor_status']==1){ ?> selected <?php } } ?>>Active</option>
                                                        <option value="2" <?php if(@$param['vendor_status']){ if ($param['vendor_status']==2){ ?> selected <?php } } ?>>InActive</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <label>Net Term</label>
                                                    <select class="form-control" name="auth_net">
                                                        <option selected value="">Select</option>
                                                        <option value="1" <?php if(@$param['auth_net']){ if ($param['auth_net']==1){ ?> selected <?php } } ?>>Net 15</option>
                                                        <option value="2" <?php if(@$param['auth_net']){ if ($param['auth_net']==2){ ?> selected <?php } } ?>>Net 30</option>
                                                        <option value="3" <?php if(@$param['auth_net']){ if ($param['auth_net']==3){ ?> selected <?php } } ?>>Net 45</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <label>Invoice Type</label>
                                                    <select class="form-control" name="invoice_type">

                                                        <option selected value="">Select</option>
                                                        <option value="1" <?php if(@$param['invoice_type']){ if ($param['invoice_type']==1){ ?> selected <?php } } ?>>Claim</option>
                                                        <option value="2" <?php if(@$param['invoice_type']){ if ($param['invoice_type']==2){ ?> selected <?php } } ?>>Goodwill</option>
                                                        <option value="3" <?php if(@$param['invoice_type']){ if ($param['invoice_type']==3){ ?> selected <?php } } ?>>Buyout</option>
                                                        <option value="4" <?php if(@$param['invoice_type']){ if ($param['invoice_type']==4){ ?> selected <?php } } ?>>Reimbersment</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <label>Start Date</label>
                                                    <div class="input-group date">
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control s_date" name="start_date" value="<?php echo @$param['start_date']; ?>" autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <label>End Date</label>
                                                    <div class="input-group date">
                                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control e_date" name="end_date" value="<?php echo @$param['end_date']; ?>" autocomplete="off">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-12" style="margin-top: 28px;">
                                                <button type="submit" class="btn btn-block btn btn-primary"> <i class="fa fa-search"></i> Search</button>
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
                        <div class="ibox ">
                            <div class="ibox-title custom_padd">
                                <div class="update_task">
                                    <form role="form" class="form" id="update_task">
                                        <div class="row">
                                            <div class="col-sm-12 col-md-6 align-self-center">
                                                <div class="form-group">
                                                    <div class="i-checks ml-3"><label> <input type="checkbox" value="" id="check-all"> <i class="mr-2"></i> <span>Select/Deselect </span></label></div>
                                                </div>
                                            </div>

                                            <div class="col-sm-12 col-md-6 col-lg-3 offset-lg-3 align-self-center">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <select class="form-control change_all_status" >
                                                            <option selected disabled>Change Status</option>
                                                            <option value="1">New</option>
                                                            <option value="2">Rejected</option>
                                                            <option value="3">Approved</option>
                                                        </select>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="ibox-content">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover dataTables-example tbl tbl_tasks">
                                        <thead>
                                        <tr>
                                            <th>&nbsp;</th>
                                            <th>Date</th>
                                            <th>SWO #</th>
                                            <th>Vendor Name</th>
                                            <th>NET</th>
                                            <th>Invoice Type</th>
                                            <th>Amount</th>
                                            <th>Invoice Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach($invoice_data as $vendor_invoice) {?>
                                            <tr id="<?php echo $vendor_invoice['id']; ?>">
                                                <td>
                                                    <div class="i-checks"><label> <input type="checkbox" class="check" name="claim_status" value="<?php echo $vendor_invoice['id']; ?>"> <i></i> </label></div>
                                                </td>
                                                <td><?php echo db_date($vendor_invoice['created_at']); ?></td>
                                                <td><?php $claim_data = get_claim_data($vendor_invoice['claim']);
                                                    $get_vendor_detail = get_vendors($claim_data['vendor']);
                                                    $get_customer_detail = get_customers($claim_data['customer']);
                                                    if (get_session('admin_type') == 1 || (get_session('admin_type') == 2 && get_session('admin_permissions')['claims'] != 'N/A' && get_session('admin_permissions')['claims']['view'] == 1)) { ?>
                                                        <a href="<?php echo admin_url(); ?>customers/edit/<?php echo $get_customer_detail['id']; ?>/<?php echo $claim_data['claim_num']; ?>" class="insert_log" id="<?php echo $get_customer_detail['id']; ?>">#<?php  echo $claim_data['claim_num']; ?></a>
                                                    <?php }else{ ?>
                                                        <a href="javascript:void(0);" class="insert_log" id="<?php echo $get_customer_detail['id']; ?>">#<?php  echo $claim_data['claim_num']; ?></a>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <?php echo $get_vendor_detail['name']; ?>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <select class="form-control change_auth_net" name="auth_net">
                                                            <option value="1" <?php if ($vendor_invoice['auth_net']==1){ ?> selected <?php } ?>>Net 15</option>
                                                            <option value="2" <?php if ($vendor_invoice['auth_net']==2){ ?> selected <?php } ?>>Net 30</option>
                                                            <option value="3" <?php if ($vendor_invoice['auth_net']==3){ ?> selected <?php } ?>>Net 45</option>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td><?php echo get_invoice_type($vendor_invoice['type']); ?></td>
                                                <td><?php echo '$'.number_format((float)$vendor_invoice['amount'], 2, '.', ''); ?></td>
                                                <td>
                                                    <select class="form-control change_status" name="status">
                                                        <option selected disabled>Status</option>
                                                        <option value="1" <?php if ($vendor_invoice['status']==1){ ?> selected <?php } ?>>New</option>
                                                        <option value="2" <?php if ($vendor_invoice['status']==2){ ?> selected <?php } ?>>Rejected</option>
                                                        <option value="3" <?php if ($vendor_invoice['status']==3){ ?> selected <?php } ?>>Approved</option>
                                                    </select>
                                                </td>
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

<script type="text/javascript">
    $(document).ready( function () {
        $('.dataTables-example').DataTable();
        $('.s_date, .e_date').datepicker({
            format: 'yyyy-mm-dd'
        });
        $('.change_auth_net').on('change',function(){
            var auth_net = $(this).val();
            var id = $(this).closest('tr').attr('id');
            $.ajax({
                type: "POST",
                url:'<?php echo admin_url(); ?>invoice/update_vendor_auth_net',
                dataType: "json",
                data:{auth_net:auth_net,id:id},
                success: function(status){
                    if(status.msg=='success'){
                        toastr.success(status.response, 'Success');
                        setTimeout(function () {
                            location.reload();
                        }, 2000);
                    }
                    else if(status.msg == 'error') {
                        toastr.error(status.response);
                    }
                }
            });
        });
        $('.change_status').on('change',function(){
            var status = $(this).val();
            var id = $(this).closest('tr').attr('id');
            $.ajax({
                type: "POST",
                url:'<?php echo admin_url(); ?>invoice/update_vendor_invoice_status',
                dataType: "json",
                data:{status:status,id:id},
                success: function(status){
                    if(status.msg=='success'){
                        toastr.success(status.response, 'Success');
                        setTimeout(function () {
                            location.reload();
                        }, 2000);
                    }
                    else if(status.msg == 'error') {
                        toastr.error(status.response);
                    }
                }
            });
        });
        $('.change_all_status').on('change',function(){
            var status = $(this).val();
            var assign_to = $('.change_status').val();
            var i=0;
            var update=[];
            $('input[name="claim_status"]:checked').each(function() {
                update.push(this.value);
                i++;
            });
            if (i==0){
                toastr.error('Select atleast one invoice to update');
            } else if (status=="" && assign_to==""){
                toastr.error('Select atleast one action to perform');
            }
            else {
                $.ajax({
                    url:'<?php echo admin_url(); ?>invoice/update_vendor_multipe_invoice',
                    type: 'POST',
                    data: { update : update, status: status, assign_to: assign_to},
                    dataType:'json',
                    success:function(status){
                        if(status.msg=='success'){
                            toastr.success(status.response, 'Success');
                            setTimeout(function () {
                                location.reload();
                            }, 2000);
                        }
                        else if(status.msg == 'error'){
                            toastr.error(status.response);
                        }
                    }
                });
            }
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
