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
                <h2>Vendors</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="<?php echo admin_url(); ?>">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">
                        <strong>Add Vendor</strong>
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
                                            <form method="post" id="add-vendor">
                                                <div class="form_section">
                                                    <h2 class="mb-4">Vendor Details</h2>
                                                    <div class="row">
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Comapny Name</label>
                                                                <input type="text" placeholder="Name" class="form-control" name="company" required="true">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Contact Name</label>
                                                                <input type="text" placeholder="Name" class="form-control" name="name" required="true">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Email</label>
                                                                <input type="email" placeholder="Email" class="form-control" name="email">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group" id="data_8">
                                                                <label>Phone</label>
                                                                <input type="number" placeholder="Phone" class="form-control" name="phone" required="true">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Fax</label>
                                                                <input type="number" class="form-control" name="fax" required="true">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Address</label>
                                                                <input type="text" class="form-control" name="address" required="true">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>City</label>
                                                                <input type="text" class="form-control" name="city" required="true">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>State</label>
                                                                <input type="text" class="form-control" name="state" required="true">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Zip Code</label>
                                                                <input type="number" class="form-control" name="zip_code" required="true">
                                                            </div>
                                                        </div>
														 <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Travel to Miles</label>
                                                                <input type="number" class="form-control" name="travel_miles" value="" required="true">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Diagnosis Fee</label>
                                                                <input type="number" class="form-control" name="diagosis_fee" value="" required="true">
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
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Zip Codes Serviced</label>
<!--                                                                <select class="form-control" multiple="multiple" name="zip_codes_serviced[]" id="tag_select"></select>-->
                                                                <textarea class="form-control" name="zip_codes_serviced"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="hr-line-dashed"></div>
                                                </div>
                                                <div class="form_section">
                                                    <h2 class="mb-4">Vendor Services</h2>
                                                    <div class="row">
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <div class="i-checks ml-3">
                                                                    <label>
                                                                        <input type="checkbox" value="1" name="opt_service[]">
                                                                        <i class="mr-2"></i>
                                                                        <span>HVAC </span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="i-checks ml-3">
                                                                    <label>
                                                                        <input type="checkbox" value="2" name="opt_service[]">
                                                                        <i class="mr-2"></i>
                                                                        <span>Appliances</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="i-checks ml-3">
                                                                    <label>
                                                                        <input type="checkbox" value="3" name="opt_service[]">
                                                                        <i class="mr-2"></i>
                                                                        <span>Plumbing</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="i-checks ml-3">
                                                                    <label>
                                                                        <input type="checkbox" value="4" name="opt_service[]">
                                                                        <i class="mr-2"></i>
                                                                        <span>Electrical</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="i-checks ml-3">
                                                                    <label>
                                                                        <input type="checkbox" value="5" name="opt_service[]">
                                                                        <i class="mr-2"></i>
                                                                        <span>Garage Door Openers </span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <div class="i-checks ml-3">
                                                                    <label>
                                                                        <input type="checkbox" value="6" name="opt_service[]">
                                                                        <i class="mr-2"></i>
                                                                        <span>Pool & Spa </span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="i-checks ml-3">
                                                                    <label>
                                                                        <input type="checkbox" value="7" name="opt_service[]">
                                                                        <i class="mr-2"></i>
                                                                        <span>Roofing</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="i-checks ml-3">
                                                                    <label>
                                                                        <input type="checkbox" value="8" name="opt_service[]">
                                                                        <i class="mr-2"></i>
                                                                        <span>Central Vacuum Systems </span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="i-checks ml-3">
                                                                    <label>
                                                                        <input type="checkbox" value="9" name="opt_service[]">
                                                                        <i class="mr-2"></i>
                                                                        <span>Well Pumps </span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="i-checks ml-3">
                                                                    <label>
                                                                        <input type="checkbox" value="10" name="opt_service[]">
                                                                        <i class="mr-2"></i>
                                                                        <span>Septic System & Pumping </span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <div class="i-checks ml-3">
                                                                    <label>
                                                                        <input type="checkbox" value="11" name="opt_service[]">
                                                                        <i class="mr-2"></i>
                                                                        <span>Sprinkler System </span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="i-checks ml-3">
                                                                    <label>
                                                                        <input type="checkbox" value="12" name="opt_service[]">
                                                                        <i class="mr-2"></i>
                                                                        <span>Drywall</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="i-checks ml-3">
                                                                    <label>
                                                                        <input type="checkbox" value="13" name="opt_service[]">
                                                                        <i class="mr-2"></i>
                                                                        <span>Garbage Disposal</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form_section">
                                                    <div class="row">
                                                        <div class="btn_submit text-center pull-right col">
                                                            <button class="btn btn-primary btn-lg m-t-n-xs float-right save-vendor" type="button"><strong>Submit</strong></button>
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
        $(document).on("click" , ".save-vendor" , function() {
            if ($("#add-vendor input:checkbox:checked").length > 0)
            {
                var btn = $('.save-vendor').ladda();
                btn.ladda('start');
                var value = new FormData( $("#add-vendor")[0] );

                $.ajax({
                    url:admin_url+'vendors/save',
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
                                $(location).attr('href', admin_url+"vendors");
                            }, 2000);
                        }
                        else if(status.msg == 'error'){
                            btn.ladda('stop');
                            toastr.error(status.response, 'Error');
                        }
                    }
                });
            }
            else
            {
                toastr.error('Vendor services must not be empty', 'Error');
            }
        });
    });

    $(document).ready(function () {
        $("#tag_select").select2({
            tags: true,
            tokenSeparators: [',', ' ']
        });
    });
</script>

</body>
</html>
