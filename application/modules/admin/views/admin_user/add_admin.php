<!DOCTYPE html>
<html>

<head>
    <?php $this->load->view('common/admin_header'); ?>

    <link href="<?php echo base_url(); ?>assets/admin_assets/css/datatable/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/admin_assets/css/datatable/responsive.bootstrap4.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/select2/css/select2.min.css" rel="stylesheet">
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
                <h2>Admins</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="<?php echo admin_url(); ?>">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">
                        <strong>Add Admin</strong>
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
                                        <div class="left_section">
                                            <form method="post" id="add-admin">
                                                <div class="form_section">
                                                    <h2 class="mb-4">Admin Details</h2>
                                                    <div class="row">
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>First Name</label>
                                                                <input type="text" name="firstname" id="firstname" placeholder="" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Last Name</label>
                                                                <input type="text" name="lastname" id="lastname" placeholder="" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Email</label>
                                                                <input type="email" name="email" id="email" placeholder="" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Password</label>
                                                                <input id="password" type="password" required="" name="password" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group" id="data_8">
                                                                <label>Phone</label>
                                                                <input type="number" name="phone" placeholder="" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>City</label>
                                                                <input type="text" name="city" placeholder="" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Address</label>
                                                                <input type="text" name="address" placeholder="" class="form-control">
                                                            </div>
                                                        </div>  
                                                       <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Department</label>
                                                                <select class="form-control" name="department">
                                                                    <option value="0">select department</option>
                                                                    <?php foreach($department as $val){?>
                                                                    <option value="<?php echo $val->department ?>"><?php echo $val->department ?></option>
                                                                <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>  
                                                          <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>EXT</label>
                                                                <input type="text" name="ext" placeholder="" class="form-control">
                                                            </div>
                                                        </div>                                                    
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Status</label>
                                                                <select class="form-control" name="status">
                                                                    <option value="1">Active</option>
                                                                    <option value="0">Inactive</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="hr-line-dashed"></div>
                                                    <div class="form-group row">
                                                        <div class="col-12">
                                                            <div class="table-responsive">
                                                                <table class="table table-bordered text-center my-5">
                                                                    <tr>
                                                                        <th rowspan="2" class="align-middle">Module</th>
                                                                        <th colspan="5">Permissions</th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>View</th>
                                                                        <th>Add</th>
                                                                        <th>Edit</th>
                                                                        <th>Delete</th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th class="w-25">Dashboard Access</th>
                                                                        <td>
                                                                            <label class="checkbox-inline i-checks p-0">
                                                                                <input type="checkbox" class="check_dashboard_view" name="permissions[dashboard][view]"><i></i>
                                                                            </label>
                                                                        </td>
                                                                        <td>
                                                                            <label class="checkbox-inline i-checks p-0">
                                                                                <input type="checkbox" class="check_dashboard_btn" name="permissions[dashboard][add]"><i></i>
                                                                            </label>
                                                                        </td>
                                                                        <td>
                                                                            <label class="checkbox-inline i-checks p-0">
                                                                                <input type="checkbox" name="permissions[dashboard][edit]" class="check_dashboard_btn"><i></i>
                                                                            </label>
                                                                        </td>
                                                                        <td>
                                                                            <label class="checkbox-inline i-checks p-0">
                                                                                <input type="checkbox" name="permissions[dashboard][delete]" class="check_dashboard_btn"><i></i>
                                                                            </label>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th class="w-25">Claims Access</th>
                                                                        <td>
                                                                            <label class="checkbox-inline i-checks p-0">
                                                                                <input type="checkbox" class="check_claims_view" name="permissions[claims][view]"><i></i>
                                                                            </label>
                                                                        </td>
                                                                        <td>
                                                                            <label class="checkbox-inline i-checks p-0">
                                                                                <input type="checkbox" class="check_claims_btn" name="permissions[claims][add]"><i></i>
                                                                            </label>
                                                                        </td>
                                                                        <td>
                                                                            <label class="checkbox-inline i-checks p-0">
                                                                                <input type="checkbox" name="permissions[claims][edit]" class="check_claims_btn"><i></i>
                                                                            </label>
                                                                        </td>
                                                                        <td>
                                                                            <label class="checkbox-inline i-checks p-0">
                                                                                <input type="checkbox" name="permissions[claims][delete]" class="check_claims_btn"><i></i>
                                                                            </label>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th class="w-25">Vendors Access</th>
                                                                        <td>
                                                                            <label class="checkbox-inline i-checks p-0">
                                                                                <input type="checkbox" class="check_vendors_view" name="permissions[vendors][view]"><i></i>
                                                                            </label>
                                                                        </td>
                                                                        <td>
                                                                            <label class="checkbox-inline i-checks p-0">
                                                                                <input type="checkbox" class="check_vendors_btn" name="permissions[vendors][add]"><i></i>
                                                                            </label>
                                                                        </td>
                                                                        <td>
                                                                            <label class="checkbox-inline i-checks p-0">
                                                                                <input type="checkbox" name="permissions[vendors][edit]" class="check_vendors_btn"><i></i>
                                                                            </label>
                                                                        </td>
                                                                        <td>
                                                                            <label class="checkbox-inline i-checks p-0">
                                                                                <input type="checkbox" name="permissions[vendors][delete]" class="check_vendors_btn"><i></i>
                                                                            </label>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th class="w-25">Invoice Access</th>
                                                                        <td>
                                                                            <label class="checkbox-inline i-checks p-0">
                                                                                <input type="checkbox" class="check_invoice_view" name="permissions[invoice][view]"><i></i>
                                                                            </label>
                                                                        </td>
                                                                        <td>
                                                                            <label class="checkbox-inline i-checks p-0">
                                                                                <input type="checkbox" class="check_invoice_btn" name="permissions[invoice][add]"><i></i>
                                                                            </label>
                                                                        </td>
                                                                        <td>
                                                                            <label class="checkbox-inline i-checks p-0">
                                                                                <input type="checkbox" name="permissions[invoice][edit]" class="check_invoice_btn"><i></i>
                                                                            </label>
                                                                        </td>
                                                                        <td>
                                                                            <label class="checkbox-inline i-checks p-0">
                                                                                <input type="checkbox" name="permissions[invoice][delete]" class="check_invoice_btn"><i></i>
                                                                            </label>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th class="w-25">Scoreboard Access</th>
                                                                        <td>
                                                                            <label class="checkbox-inline i-checks p-0">
                                                                                <input type="checkbox" class="check_scoreboard_view" name="permissions[scoreboard][view]"><i></i>
                                                                            </label>
                                                                        </td>
                                                                        <td>
                                                                            <label class="checkbox-inline i-checks p-0">
                                                                                <input type="checkbox" class="check_scoreboard_btn" name="permissions[scoreboard][add]"><i></i>
                                                                            </label>
                                                                        </td>
                                                                        <td>
                                                                            <label class="checkbox-inline i-checks p-0">
                                                                                <input type="checkbox" name="permissions[scoreboard][edit]" class="check_scoreboard_btn"><i></i>
                                                                            </label>
                                                                        </td>
                                                                        <td>
                                                                            <label class="checkbox-inline i-checks p-0">
                                                                                <input type="checkbox" name="permissions[scoreboard][delete]" class="check_scoreboard_btn"><i></i>
                                                                            </label>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th class="w-25">Admin Access</th>
                                                                        <td>
                                                                            <label class="checkbox-inline i-checks p-0">
                                                                                <input type="checkbox" class="check_admin_view" name="permissions[admin][view]"><i></i>
                                                                            </label>
                                                                        </td>
                                                                        <td>
                                                                            <label class="checkbox-inline i-checks p-0">
                                                                                <input type="checkbox" class="check_admin_btn" name="permissions[admin][add]"><i></i>
                                                                            </label>
                                                                        </td>
                                                                        <td>
                                                                            <label class="checkbox-inline i-checks p-0">
                                                                                <input type="checkbox" name="permissions[admin][edit]" class="check_admin_btn"><i></i>
                                                                            </label>
                                                                        </td>
                                                                        <td>
                                                                            <label class="checkbox-inline i-checks p-0">
                                                                                <input type="checkbox" name="permissions[admin][delete]" class="check_admin_btn"><i></i>
                                                                            </label>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th class="w-25">Payments Access</th>
                                                                        <td>
                                                                            <label class="checkbox-inline i-checks p-0">
                                                                                <input type="checkbox" class="check_payment_view" name="permissions[payment][view]"><i></i>
                                                                            </label>
                                                                        </td>
                                                                        <td>
                                                                            <label class="checkbox-inline i-checks p-0">
                                                                                <input type="checkbox" class="check_payment_btn" name="permissions[payment][add]"><i></i>
                                                                            </label>
                                                                        </td>
                                                                        <td>
                                                                            <label class="checkbox-inline i-checks p-0">
                                                                                <input type="checkbox" name="permissions[payment][edit]" class="check_payment_btn"><i></i>
                                                                            </label>
                                                                        </td>
                                                                        <td>
                                                                            <label class="checkbox-inline i-checks p-0">
                                                                                <input type="checkbox" name="permissions[payment][delete]" class="check_payment_btn"><i></i>
                                                                            </label>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th class="w-25">Reporting Access</th>
                                                                        <td>
                                                                            <label class="checkbox-inline i-checks p-0">
                                                                                <input type="checkbox" class="check_reporting_view" name="permissions[reporting][view]"><i></i>
                                                                            </label>
                                                                        </td>
                                                                        <td>
                                                                            <label class="checkbox-inline i-checks p-0">
                                                                                <input type="checkbox" class="check_reporting_btn" name="permissions[reporting][add]"><i></i>
                                                                            </label>
                                                                        </td>
                                                                        <td>
                                                                            <label class="checkbox-inline i-checks p-0">
                                                                                <input type="checkbox" name="permissions[reporting][edit]" class="check_reporting_btn"><i></i>
                                                                            </label>
                                                                        </td>
                                                                        <td>
                                                                            <label class="checkbox-inline i-checks p-0">
                                                                                <input type="checkbox" name="permissions[reporting][delete]" class="check_reporting_btn"><i></i>
                                                                            </label>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th class="w-25">Lead Source Access</th>
                                                                        <td>
                                                                            <label class="checkbox-inline i-checks p-0">
                                                                                <input type="checkbox" class="check_leadsource_view" name="permissions[leadsource][view]"><i></i>
                                                                            </label>
                                                                        </td>
                                                                        <td>
                                                                            <label class="checkbox-inline i-checks p-0">
                                                                                <input type="checkbox" class="check_leadsource_btn" name="permissions[leadsource][add]"><i></i>
                                                                            </label>
                                                                        </td>
                                                                        <td>
                                                                            <label class="checkbox-inline i-checks p-0">
                                                                                <input type="checkbox" name="permissions[leadsource][edit]" class="check_leadsource_btn"><i></i>
                                                                            </label>
                                                                        </td>
                                                                        <td>
                                                                            <label class="checkbox-inline i-checks p-0">
                                                                                <input type="checkbox" name="permissions[leadsource][delete]" class="check_leadsource_btn"><i></i>
                                                                            </label>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th class="w-25 bold_heading">Other</th>
                                                                        <td colspan="4">
                                                                            <label class="checkbox-inline i-checks col-sm-3">
                                                                                <input type="checkbox" name="permissions[other][charge_card]" class="check_petty_btn"><i></i>
                                                                                Charge Card
                                                                            </label>
                                                                            <label class="checkbox-inline i-checks col-sm-3">
                                                                                <input type="checkbox" class="check_petty_btn" name="permissions[other][add_coverage]"><i></i>
                                                                                Add Coverage
                                                                            </label>
                                                                            <label class="checkbox-inline i-checks col-sm-3">
                                                                                <input type="checkbox" name="permissions[other][status]" class="check_petty_btn"><i></i>
                                                                                Status
                                                                            </label>
                                                                            <label class="checkbox-inline i-checks col-sm-3">
                                                                                <input type="checkbox" name="permissions[other][customer_claims]" class="check_petty_btn"><i></i>
                                                                                Customer Claims
                                                                            </label>
                                                                            <label class="checkbox-inline i-checks col-sm-3">
                                                                                <input type="checkbox" name="permissions[other][add_customer]" class="check_petty_btn"><i></i>
                                                                                Add customer
                                                                            </label>
                                                                            <label class="checkbox-inline i-checks col-sm-3">
                                                                                <input type="checkbox" name="permissions[other][nsla_calender]" class="check_petty_btn"><i></i>
                                                                                NSLA Calender
                                                                            </label>
                                                                            <label class="checkbox-inline i-checks col-sm-3">
                                                                                <input type="checkbox" name="permissions[other][forward_task]" class="check_petty_btn"><i></i>
                                                                                Ability to forward tasks
                                                                            </label>
																			<label class="checkbox-inline i-checks col-sm-3">
                                                                                <input type="checkbox" name="permissions[other][scoreboard_appear]" class="check_petty_btn"><i></i>
                                                                                Appear on Scoreboard
                                                                            </label>
                                                                            <label class="checkbox-inline i-checks col-sm-3">
                                                                                <input type="checkbox" name="permissions[other][setting_menu]" class="check_petty_btn" ><i></i>
                                                                                Access Setting Menu
                                                                            </label>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form_section">
                                                    <div class="row">
                                                        <div class="btn_submit text-center pull-right col">
                                                            <button class="btn btn-primary btn-lg m-t-n-xs float-right save-admin" type="button"><strong>Submit</strong></button>
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
        <?php $this->load->view('common/admin_footer'); ?>
    </div>
</div>
<?php $this->load->view('common/admin_scripts'); ?>

<!-- data tables  -->
<script src="<?php echo base_url(); ?>assets/admin_assets/js/datatable/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin_assets/js/datatable/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin_assets/js/datatable/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin_assets/js/datatable/responsive.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/select2/js/select2.full.min.js"></script>
<script src="<?php echo base_url(); ?>assets/select2/js/select2.min.js"></script>


<script>
    $(document).ready(function () {
        $(document).on("click" , ".save-admin" , function() {
            var btn = $('.save-admin').ladda();
            btn.ladda('start');
            var value = new FormData( $("#add-admin")[0] );

            $.ajax({
                url:admin_url+'save_admin',
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
                            $(location).attr('href', admin_url+"admin_users");
                        }, 2000);
                    }
                    else if(status.msg == 'error'){
                        btn.ladda('stop');
                        toastr.error(status.response, 'Error');
                    }
                }
            });
        });


        $('.check_dashboard_btn').on('ifChecked', function(event){
            $('.check_dashboard_view').parent('.icheckbox_square-green').addClass('checked');
            $('.check_dashboard_view').prop('checked', true);
        });

        $('.check_dashboard_view').on('ifUnchecked', function(event){
            $('.check_dashboard_btn').parent('.icheckbox_square-green').removeClass('checked');
            $('.check_dashboard_btn').prop('checked', false);
        });

        $('.check_claims_btn').on('ifChecked', function(event){
            $('.check_claims_view').parent('.icheckbox_square-green').addClass('checked');
            $('.check_claims_view').prop('checked', true);
        });

        $('.check_claims_view').on('ifUnchecked', function(event){
            $('.check_claims_btn').parent('.icheckbox_square-green').removeClass('checked');
            $('.check_claims_btn').prop('checked', false);
        });

        $('.check_vendors_btn').on('ifChecked', function(event){
            $('.check_vendors_view').parent('.icheckbox_square-green').addClass('checked');
            $('.check_vendors_view').prop('checked', true);
        });

        $('.check_vendors_view').on('ifUnchecked', function(event){
            $('.check_vendors_btn').parent('.icheckbox_square-green').removeClass('checked');
            $('.check_vendors_btn').prop('checked', false);
        });

        $('.check_invoice_btn').on('ifChecked', function(event){
            $('.check_invoice_view').parent('.icheckbox_square-green').addClass('checked');
            $('.check_invoice_view').prop('checked', true);
        });

        $('.check_invoice_view').on('ifUnchecked', function(event){
            $('.check_invoice_btn').parent('.icheckbox_square-green').removeClass('checked');
            $('.check_invoice_btn').prop('checked', false);
        });

        $('.check_scoreboard_btn').on('ifChecked', function(event){
            $('.check_scoreboard_view').parent('.icheckbox_square-green').addClass('checked');
            $('.check_scoreboard_view').prop('checked', true);
        });

        $('.check_scoreboard_view').on('ifUnchecked', function(event){
            $('.check_scoreboard_btn').parent('.icheckbox_square-green').removeClass('checked');
            $('.check_scoreboard_btn').prop('checked', false);
        });

        $('.check_admin_btn').on('ifChecked', function(event){
            $('.check_admin_view').parent('.icheckbox_square-green').addClass('checked');
            $('.check_admin_view').prop('checked', true);
        });

        $('.check_admin_view').on('ifUnchecked', function(event){
            $('.check_admin_btn').parent('.icheckbox_square-green').removeClass('checked');
            $('.check_admin_btn').prop('checked', false);
        });

        $('.check_payment_btn').on('ifChecked', function(event){
            $('.check_payment_view').parent('.icheckbox_square-green').addClass('checked');
            $('.check_payment_view').prop('checked', true);
        });

        $('.check_payment_view').on('ifUnchecked', function(event){
            $('.check_payment_btn').parent('.icheckbox_square-green').removeClass('checked');
            $('.check_payment_btn').prop('checked', false);
        });

        $('.check_reporting_btn').on('ifChecked', function(event){
            $('.check_reporting_view').parent('.icheckbox_square-green').addClass('checked');
            $('.check_reporting_view').prop('checked', true);
        });

        $('.check_reporting_view').on('ifUnchecked', function(event){
            $('.check_reporting_btn').parent('.icheckbox_square-green').removeClass('checked');
            $('.check_reporting_btn').prop('checked', false);
        });

        $('.check_leadsource_btn').on('ifChecked', function(event){
            $('.check_leadsource_view').parent('.icheckbox_square-green').addClass('checked');
            $('.check_leadsource_view').prop('checked', true);
        });

        $('.check_leadsource_view').on('ifUnchecked', function(event){
            $('.check_leadsource_btn').parent('.icheckbox_square-green').removeClass('checked');
            $('.check_leadsource_btn').prop('checked', false);
        });

    });
</script>

</body>
</html>