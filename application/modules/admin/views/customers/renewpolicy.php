<!DOCTYPE html>
<html>

<head>
    <?php $this->load->view('common/admin_header'); ?>

    <link href="<?php echo base_url(); ?>assets/admin_assets/css/datatable/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/admin_assets/css/datatable/responsive.bootstrap4.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/admin_assets/css/plugins/switchery/switchery.css" rel="stylesheet">
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
                        <strong>Renew Customer</strong>
                    </li>
                </ol>
            </div>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight pb-0">
            <form method="post" id="save-customer">
                <input type="hidden" class="form-control" name="id" value="<?php echo @$details['id']; ?>">
                <input type="hidden" class="form-control" name="policy_num" value="<?php echo @$details['policy_num']; ?>">
                <div class="row">
                    <div class="col-xl-8 col-lg-12 col-md-12 col-sm-12">
                        <div class="wrapper wrapper-content animated fadeInRight">
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="ibox m-0">
                                        <div class="ibox-content ibox-content pt-4 pb-2">
                                            <div class="row">
												
                                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                    <div class="form-group">
                                                        <label>Sales Person</label>
                                                        <select class="form-control" name="salesperson">
                                                            <option value="" selected>Select Saleperson</option>
                                                             <?php
															
															$saleperson = get_salesperson();
                                                            foreach ($saleperson as $sales){ ?>
															 <?php $permissions  =get_admin_permissions($sales['id'],'other');
														
																$miscellaneous = json_decode($permissions['miscellaneous']);
																if(!empty($permissions) && $miscellaneous->scoreboard_appear == 'on'){
																?>
                                                                <option value="<?php echo $sales['id']; ?>" <?php if (@$details['salesperson']==$sales['id']){ ?> selected <?php } ?>>
                                                                    <?php echo $sales['FirstName'].' '.$sales['LastName']; ?>
                                                                </option>
                                                            <?php }  } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12 pull-right">
                                                    <div class="form-group">
                                                        <label>Lead Source</label>
                                                        <select class="form-control" name="lead_source">
                                                            <option value="" selected>Select Leadsource</option>
                                                            <?php $leadsource = get_leadsource();
                                                            foreach ($leadsource as $source){ ?>
                                                                <option value="<?php echo $source['id']; ?>" <?php if (@$details['leadsource']==$source['id']){ ?> selected <?php } ?>>
                                                                    <?php echo $source['name']; ?>
                                                                </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="left_section">
                                                <div class="form_section">
                                                    <h2 class="mb-4">General Contact Person</h2>
                                                    <div class="row">
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>First Name</label>
                                                                <input type="text" placeholder="First Name" class="form-control c_fname" name="c_fname" value="<?php echo @$details['first_name']; ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Last Name</label>
                                                                <input type="text" placeholder="Last Name" class="form-control c_lname" name="c_lname" value="<?php echo @$details['last_name'];?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Home Phone</label>
                                                                <input type="text" class="form-control c_home_phn" name="c_home_phn" value="<?php echo @$details['home_phone'];?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Work Phone</label>
                                                                <input type="text" class="form-control c_work_phn" name="c_work_phn" value="<?php echo @$details['work_phone'];?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Email</label>
                                                                <input type="email" placeholder="email" class="form-control c_email" name="c_email" value="<?php echo @$details['email'];?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="checkbox m-r-xs" style="margin-top: 33px">
                                                                <input type="checkbox" name="not_mail" id="checkbox1" <?php if (@$details['send_mail']== '0'){ ?> checked <?php } ?> >
                                                                <label for="checkbox1">
                                                                    DO NOT EMAIL
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="hr-line-dashed"></div>
                                                </div>
                                                <div class="form_section">
                                                    <h2 class="mb-4 float-left">Primary Contact Person</h2>
                                                    <div class="checkbox float-right mt-3" style="margin-top: 33px">
                                                        <input type="checkbox" id="gen-copy" name="c_general">
                                                        <label for="gen-copy">
                                                            Save as General Contact
                                                        </label>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <div class="row">
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>First Name</label>
                                                                <input type="text" placeholder="First Name" class="form-control p_fname" name="p_fname" value="<?php echo @$details['p_firstname'];?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Last Name</label>
                                                                <input type="text" placeholder="Last Name" class="form-control p_lname" name="p_lname" value="<?php echo @$details['p_lastname'];?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Home Phone</label>
                                                                <input type="text" placeholder="Phone" class="form-control p_phn" name="p_phn" value="<?php echo @$details['p_phone'];?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Work Phone</label>
                                                                <input type="text" class="form-control p_work_phn" name="p_work_phn" value="<?php echo @$details['p_work_phone'];?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Email</label>
                                                                <input type="email" class="form-control p_email" name="p_email" value="<?php echo @$details['p_email'];?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="hr-line-dashed"></div>
                                                </div>
                                                <div class="form_section">
                                                    <h2 class="mb-4">Property Information</h2>
                                                    <div class="row">
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Address</label>
                                                                <input type="text" class="form-control c_address" name="c_address" value="<?php echo @$details['street_address'];?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>City</label>
                                                                <input type="text" class="form-control c_city" name="c_city" value="<?php echo @$details['city'];?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>State</label>
                                                                <input type="text" class="form-control c_state" name="c_state" value="<?php echo @$details['state'];?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Zip</label>
                                                                <input type="text" class="form-control c_zip" name="c_zip" value="<?php echo @$details['zip_code'];?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Property Type</label>
                                                                <select class="form-control c_p_type" name="c_p_type">
                                                                    <?php foreach (get_setting('property_type','',1) as $property){ ?>
                                                                        <option value="<?php echo $property['meta_key']; ?>" data-val="<?php echo $property['meta_value']; ?>"><?php echo $property['meta_content']; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Size</label>
                                                                <select class="form-control c_size" name="c_size">
                                                                    <?php foreach (get_setting('property_size','',1) as $size){ ?>
                                                                        <option value="<?php echo $size['meta_key']; ?>" data-val="<?php echo $size['meta_value']; ?>"><?php echo $size['meta_content']; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="hr-line-dashed"></div>
                                                </div>

                                                <div class="form_section">
                                                    <h2 class="mb-4 float-left">Billing Address</h2>

                                                    <div class="checkbox float-right mt-3" style="margin-top: 33px">
                                                        <input type="checkbox" id="gen-property" name="c_property">
                                                        <label for="gen-property">
                                                            Same as Property Address
                                                        </label>
                                                    </div>
                                                    <div class="clearfix"></div>

                                                    <div class="row">
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Address</label>
                                                                <input type="text" class="form-control b_address" value="<?php echo @$details['bill_address'];?>" name="b_address">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>City</label>
                                                                <input type="text" class="form-control b_city" value="<?php echo @$details['bill_city'];?>" name="b_city">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>State</label>
                                                                <input type="text" class="form-control b_state" value="<?php echo @$details['bill_state'];?>" name="b_state">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Zip</label>
                                                                <input type="text" class="form-control b_zip" value="<?php echo @$details['bill_zipcode'];?>" name="b_zip">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Name on Card</label>
                                                                <input type="text" class="form-control" value="<?php echo @$details['bill_cardname'];?>" name="b_name_on_card">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="hr-line-dashed"></div>
                                                </div>
                                                <div class="form_section">
                                                    <h2 class="mb-4 float-left">Mailing Address</h2>

                                                    <div class="checkbox float-right mt-3" style="margin-top: 33px">
                                                        <input type="checkbox" id="gen_copy_billing" name="c_billing">
                                                        <label for="gen_copy_billing">
                                                            Same as Billing Address
                                                        </label>
                                                    </div>
                                                    <div class="clearfix"></div>

                                                    <div class="row">
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Address</label>
                                                                <input type="text" class="form-control m_address" value="<?php echo @$details['mail_address'];?>" name="m_address">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>City</label>
                                                                <input type="text" class="form-control m_city" value="<?php echo @$details['mail_city'];?>" name="m_city">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>State</label>
                                                                <input type="text" class="form-control m_state" value="<?php echo @$details['mail_state'];?>" name="m_state">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Zip</label>
                                                                <input type="text" class="form-control m_zip" value="<?php echo @$details['mail_zipcode'];?>" name="m_zip">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="hr-line-dashed"></div>
                                                </div>
                                                <?php if (get_session('admin_type') == 1 || (get_session('admin_type') == 2 && get_session('admin_permissions')['miscellaneous'] != 'N/A' && isset(get_session('admin_permissions')['miscellaneous']->add_coverage))) { ?>
                                                    <div class="form_section">
                                                        <h2 class="mb-4">Select Optional Coverage</h2>
                                                        <div class="row">
                                                            <?php foreach (get_setting('opt_coverage','',1) as $coverage){ ?>
                                                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                                    <div class="form-group">
                                                                        <div class="i-checks ml-3">
                                                                            <label>
                                                                                <input type="checkbox" class="opt-coverage" value="<?php echo $coverage['meta_key']; ?>" data-val="<?php echo $coverage['meta_value']; ?>" data-id="<?php echo $coverage['meta_content']; ?>" name="opt_coverage">
                                                                                <i class="mr-2"></i>
                                                                                <span><?php echo $coverage['meta_content']; ?></span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-12 col-md-12 col-sm-12">
                        <div class="wrapper wrapper-content animated fadeInRight">
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="ibox m-0">
                                        <div class="ibox-content ibox-content pt-4 pb-2">
                                            <div class="right_section">
                                                <div class="form_section">
                                                    <h2 class="mb-4">Payment Schedule</h2>
                                                    <div class="row">
                                                        <div class="col-xl 6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Plan Type</label>
                                                                <select class="form-control c_plan_type" name="c_plan_type">
                                                                    <?php foreach (get_setting('plan','',1) as $plan){ ?>
                                                                        <option value="<?php echo $plan['meta_key']; ?>" data-val="<?php echo $plan['meta_value']; ?>"><?php echo $plan['meta_content']; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl 6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                            <label>Plan</label>
                                                            <select class="form-control c_plan" name="c_plan">
                                                                <option value="1">1 Year</option>
                                                                <option value="2">2 Year</option>
                                                                <option value="3">3 Year</option>
                                                                <option value="5">5 Year</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-xl 6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="field">
                                                                <div class="form-group">
                                                                    <label>SCF</label>
                                                                    <select class="form-control c_scf" name="c_scf">
                                                                        <option value="" data-val="0">Select SCF</option>
                                                                        <?php foreach (get_setting('scf','',1) as $scf){ ?>
                                                                            <option value="<?php echo $scf['meta_key'] ?>" data-val="<?php echo $scf['meta_value']; ?>">$<?php echo $scf['meta_value']; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl 6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="field">
                                                                <div class="form-group">
                                                                    <label>Payments</label>
                                                                    <select class="form-control c_payment" name="c_payment">
                                                                        <option value="1">1</option>
                                                                        <option value="2">2</option>
                                                                        <option value="3">3</option>
                                                                        <option value="4" class="hide payment_show1">4</option>
                                                                        <option value="5" class="hide payment_show2">5</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-xl 6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="field">
                                                                <div class="form-group">
                                                                    <label>Months</label>
                                                                    <select class="form-control c_month" name="c_month">
                                                                        <option value="">Select Months</option>
                                                                        <option value="1">1 Month</option>
                                                                        <option value="2">2 Month</option>
                                                                        <option value="3" class="hide plan_year1">3 Month</option>
                                                                        <option value="4" class="hide plan_year1">4 Month</option>
                                                                        <option value="5" class="hide plan_year2">5 Month</option>
                                                                        <option value="6" class="hide plan_year2">6 Month</option>
                                                                        <option value="7" class="hide plan_year3">7 Month</option>
                                                                        <option value="8" class="hide plan_year3">8 Month</option>
                                                                        <option value="9" class="hide plan_year3">9 Month</option>
                                                                        <option value="10" class="hide plan_year3">10 Month</option>
                                                                        <option value="11" class="hide plan_year3">11 Month</option>
                                                                        <option value="12" class="hide plan_year3">12 Month</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl 6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="field">
                                                                <div class="form-group">
                                                                    <label>Discount</label>
                                                                    <select class="form-control c_discount" name="c_discount">
                                                                        <option value="" data-val="0">Select Discount</option>
                                                                        <?php foreach (get_setting('discount','',1) as $discount){
                                                                            if ($discount['meta_key']==9 || $discount['meta_key']==10 || $discount['meta_key']==11){ ?>
                                                                                <option class="small-discount" value="<?php echo $discount['meta_key']; ?>" data-val="<?php echo $discount['meta_value']; ?>"><?php echo $discount['meta_value']; ?></option>
                                                                            <?php }else{ ?>
                                                                                <option <?php if ($discount['meta_key']==8){ ?> class="hide big-discount" <?php } ?> value="<?php echo $discount['meta_key']; ?>" data-val="<?php echo $discount['meta_value']; ?>"><?php echo $discount['meta_value']; ?>%</option>
                                                                            <?php } } ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-xl 6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="field">
                                                                <div class="form-group">
                                                                    <label>Miscellaneous Charge</label>
                                                                    <input type="text" placeholder="" value="0" class="form-control m_charge" name="m_charge">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl 6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="field">
                                                                <div class="form-group">
                                                                    <label>Free SCF</label>
                                                                    <input type="text" class="form-control free_scf" name="free_scf" min="1" max="2" maxlength="1">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
												
                                                <div class="hr-line-dashed"></div>
                                                <div class="row coverage_plan">
                                                    <div class="col">
                                                        <table class="table table-borderless opt-table">
                                                            <tr>
                                                                <td colspan="2">
                                                                    <h2 class="m-0">COVERAGE</h2>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td id="plan-name">
                                                                    Platinum Plan
                                                                </td>
                                                                <td>
                                                                    <span class="pull-right">$<i class="plan-amount">499.99</i></span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2">
                                                                    <h2 class="m-0"> EXTRAS </h2>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2">
                                                                    <table class="table table-borderless extra-coverage"></table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="hr-line-dashed"></div>
                                                <div class="row monthlycheck">
                                                    <div class="col-md-12">
                                                        <div class="checkbox float-right mt-3">
                                                            Monthly Payments
                                                            <input type="checkbox" class="payment_as" id="payment_as" name="payment_as">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="lbl">
                                                            <h3 class="text-danger">
                                                                <strong>Discount</strong>
                                                                <span id="ini-payment">$<i class="discount-total">27.2</i> OFF</span>
                                                            </h3>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="lbl">
                                                            <h2>
                                                                <strong>Total</strong>
                                                                <span id="total-payment" data-val="516.8">$<i class="plan-total" >516.8</i></span>
                                                            </h2>
                                                            <p>(Split Payment of <span class="p_split">3</span>)</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="hr-line-dashed"></div>
                                                <div class="form_section">
                                                    <h2 class="mb-4">Payment Method</h2>
                                                    <h4 class="mb-4">Credit Card</h4>
                                                    <div class="row">
                                                        <div class="col-xl 12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Card Number</label>
                                                                <input type="text" placeholder="" class="form-control card_num" maxlength="16" name="card_num" value="<?php echo @$details['card_num']; ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-xl 12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label>CVV</label>
                                                                <input type="text" placeholder="" class="form-control" name="card_pin" value="<?php echo @$details['card_pin']; ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-xl 6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                            <label>Exp Month</label>
                                                            <select class="form-control" name="card_month">
                                                                <option value="1" <?php if (@$details['card_exp_month']==1){ ?> selected <?php } ?> >1</option>
                                                                <option value="2" <?php if (@$details['card_exp_month']==2){ ?> selected <?php } ?> >2</option>
                                                                <option value="3" <?php if (@$details['card_exp_month']==3){ ?> selected <?php } ?> >3</option>
                                                                <option value="4" <?php if (@$details['card_exp_month']==4){ ?> selected <?php } ?> >4</option>
                                                                <option value="5" <?php if (@$details['card_exp_month']==5){ ?> selected <?php } ?> >5</option>
                                                                <option value="6" <?php if (@$details['card_exp_month']==6){ ?> selected <?php } ?> >6</option>
                                                                <option value="7" <?php if (@$details['card_exp_month']==7){ ?> selected <?php } ?> >7</option>
                                                                <option value="8" <?php if (@$details['card_exp_month']==8){ ?> selected <?php } ?> >8</option>
                                                                <option value="9" <?php if (@$details['card_exp_month']==9){ ?> selected <?php } ?> >9</option>
                                                                <option value="10" <?php if (@$details['card_exp_month']==10){ ?> selected <?php } ?> >10</option>
                                                                <option value="11" <?php if (@$details['card_exp_month']==11){ ?> selected <?php } ?> >11</option>
                                                                <option value="12" <?php if (@$details['card_exp_month']==12){ ?> selected <?php } ?> >12</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-xl 6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Year</label>
                                                                <select class="form-control card-year" name="card_year">
                                                                    <?php $cur_year = date("Y");
                                                                    for ($x = $cur_year; $x <= $cur_year+10; $x++){ ?>
                                                                        <option value="<?php echo $x; ?>" <?php if (@$details['card_exp_year']== $x){ ?> selected <?php } ?> ><?php echo $x; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-xl 12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <div class="field">
                                                                <div class="form-group">
                                                                    <label>Payment Type</label>
                                                                    <select class="form-control c_charge" name="c_charge">
                                                                        <?php if (get_session('admin_type') == 1 || (get_session('admin_type') == 2 && get_session('admin_permissions')['miscellaneous'] != 'N/A' && isset(get_session('admin_permissions')['miscellaneous']->charge_card))) { ?>
                                                                            <option value="1">Live Charge</option>
                                                                        <?php } ?>
                                                                        <option value="2">Do not charge now</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="hr-line-dashed"></div>
                                            </div>
                                            <div class="btn_submit text-center">
                                                <button class="btn btn-primary btn-block btn-lg m-t-n-xs submit-customer" type="submit"><strong>Save</strong></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
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
<script src="<?php echo base_url(); ?>assets/admin_assets/js/plugins/switchery/switchery.js"></script>


<script>
    $(document).ready(function () {
        var elem = document.querySelector('.payment_as');
        var switchery = new Switchery(elem, { color: '#1AB394' });

        var init_total = calculate_plan(1);

        $('#total-payment').attr('data-val',init_total);
        $('.plan-total').html(init_total);
        var payments = $('.c_payment').val();
        $('.p_split').html(payments);
        var discount = $('.c_discount option:selected').attr('data-val');
        var total = calculate_plan(2);
        $('.discount-total').html(calculate_discount(discount,total));
        var plan = $('.c_plan_type option:selected');
        $('#plan-name').html(plan.html());
        var plan_value = plan.attr('data-val');
        $('.plan-amount').html(parseFloat(plan_value).toFixed(2));

        $('#gen-copy').on('change', function () {
            if ($('#gen-copy:checkbox:checked').length > 0) {
                var fname = $('.c_fname').val();
                $('.p_fname').val(fname);
                var lname = $('.c_lname').val();
                $('.p_lname').val(lname);
                var hphone = $('.c_home_phn').val();
                $('.p_phn').val(hphone);
                var wphone = $('.c_work_phn').val();
                $('.p_work_phn').val(wphone);
                var cemail = $('.c_email').val();
                $('.p_email').val(cemail);
            }else {
                $('.p_fname').val('');
                $('.p_lname').val('');
                $('.p_phn').val('');
                $('.p_work_phn').val('');
                $('.p_email').val('');
            }
        });

        $('#gen-property').on('change', function () {
            if ($('#gen-property:checkbox:checked').length > 0) {
                var address = $('.c_address').val();
                $('.b_address').val(address);
                var c_city = $('.c_city').val();
                $('.b_city').val(c_city);
                var c_state = $('.c_state').val();
                $('.b_state').val(c_state);
                var c_zip = $('.c_zip').val();
                $('.b_zip').val(c_zip);
            }else {
                $('.b_address').val('');
                $('.b_city').val('');
                $('.b_state').val('');
                $('.b_zip').val('');
            }
        });

        $('#gen_copy_billing').on('change', function () {
            if ($('#gen_copy_billing:checkbox:checked').length > 0) {
                var b_address = $('.b_address').val();
                $('.m_address').val(b_address);
                var b_city = $('.b_city').val();
                $('.m_city').val(b_city);
                var b_state = $('.b_state').val();
                $('.m_state').val(b_state);
                var b_zip = $('.b_zip').val();
                $('.m_zip').val(b_zip);
            }else {
                $('.m_address').val('');
                $('.m_city').val('');
                $('.m_state').val('');
                $('.m_zip').val('');
            }
        });

        $('#payment_as').on('change', function () {
            if ($('#payment_as:checkbox:checked').length > 0) {
                var p_year = $('.c_plan').val();
                var split = parseFloat(p_year * 12);
                $('.p_split').html(split);
                $('.c_payment').attr("readonly", true);
                var plan_amount = calculate_plan(1);
                var round_amount = plan_amount;
                $('.plan-total').attr('data-val',plan_amount);
                $('.plan-total').html(round_amount);
            }else {
                $('.c_payment').attr("readonly", false);
                var plan_amount = calculate_plan(1);
                $('.plan-total').html(plan_amount);
                var split = $('.c_payment').val();
                $('.p_split').html(split);
            }
        });

        $('.c_size, .c_p_type').on('change', function () {
            var plan_amount = calculate_plan(1);
            $('.plan-total').html(plan_amount);
            var total = calculate_plan(2);
            var discount = $('.c_discount option:selected').attr('data-val');
            if (discount.indexOf("$") >= 0){
                discount = discount.replace('$', '');
                $('.discount-total').html(discount);
            }else {
                $('.discount-total').html(calculate_discount(discount,total));
            }
        });

        $('.c_month').on('change', function () {
            var plan_amount = calculate_plan(1);
            // $('.plan-total').html(plan_amount);
            if (document.getElementById('payment_as').checked){
                var round_amount = plan_amount;
                $('.plan-total').html(round_amount);
                $('.plan-total').attr('data-val',plan_amount);
            }else{
                $('.plan-total').html(plan_amount);
            }

            var total = calculate_plan(2);
            var discount = $('.c_discount option:selected').attr('data-val');
            if (discount.indexOf("$") >= 0){
                discount = discount.replace('$', '');
                $('.discount-total').html(discount);
            }else {
                $('.discount-total').html(calculate_discount(discount,total));
            }
            extra_options();
        });

        $('.c_plan_type').on('change', function () {
            var _this = $('.c_plan_type option:selected');
            $('#plan-name').html(_this.html());
            var plan_value = _this.attr('data-val');
            $('.plan-amount').html(parseFloat(plan_value).toFixed(2));
            var plan_amount = calculate_plan(1);
            $('.plan-total').html(plan_amount);
            var total = calculate_plan(2);
            var discount = $('.c_discount option:selected').attr('data-val');
            if (discount.indexOf("$") >= 0){
                discount = discount.replace('$', '');
                $('.discount-total').html(discount);
            }else {
                $('.discount-total').html(calculate_discount(discount,total));
            }
        });

        $('input[name="opt_coverage"]').on('ifChanged', function () {
            var plan_amount = calculate_plan(1);
            // $('.plan-total').html(plan_amount);

            if (document.getElementById('payment_as').checked){
                var round_amount = plan_amount;
                $('.plan-total').html(round_amount);
                $('.plan-total').attr('data-val',plan_amount);
            }else{
                $('.plan-total').html(plan_amount);
            }


            var total = calculate_plan(2);
            var discount = $('.c_discount option:selected').attr('data-val');
            if (discount.indexOf("$") >= 0){
                discount = discount.replace('$', '');
                $('.discount-total').html(discount);
            }else {
                $('.discount-total').html(calculate_discount(discount,total));
            }
            extra_options();
        });

        $('.c_payment').on('change', function () {
            if (document.getElementById('payment_as').checked){
                return true;
            }else{
                var split = $(this).val();
                $('.p_split').html(split);
                var plan_amount = calculate_plan(1);
                $('.plan-total').html(plan_amount);
            }
        });

        $('.m_charge').on('keyup', function () {
            var plan_amount = calculate_plan(1);
            // $('.plan-total').html(plan_amount);
            if (document.getElementById('payment_as').checked){
                var round_amount = plan_amount;
                $('.plan-total').html(round_amount);
                $('.plan-total').attr('data-val',plan_amount);
            }else{
                $('.plan-total').html(plan_amount);
            }

            var total = calculate_plan(2);
            var discount = $('.c_discount option:selected').attr('data-val');
            if (discount.indexOf("$") >= 0){
                discount = discount.replace('$', '');
                $('.discount-total').html(discount);
            }else {
                $('.discount-total').html(calculate_discount(discount,total));
            }
        });

        $('.c_plan').on('change', function () {
            $('.c_payment').prop('selectedIndex', 0);
            $('.c_month').prop('selectedIndex', 0);
            $('.c_discount').prop('selectedIndex', 0);

            var plan_length = $(this).val();
            if (plan_length >= 1 && plan_length <= 2){
                $('.payment_show1').addClass('hide');
                $('.payment_show2').addClass('hide');
            }else if(plan_length >= 3 && plan_length < 5){
                $('.payment_show1').removeClass('hide');
                $('.payment_show2').addClass('hide');
            }else{
                $('.payment_show1').removeClass('hide');
                $('.payment_show2').removeClass('hide');
            }

            if (plan_length == 1){
                $('.plan_year1').addClass('hide');
                $('.plan_year2').addClass('hide');
                $('.plan_year3').addClass('hide');
            }else if(plan_length == 2){
                $('.plan_year1').removeClass('hide');
                $('.plan_year2').addClass('hide');
                $('.plan_year3').addClass('hide');
            }else if(plan_length == 3){
                $('.plan_year1').removeClass('hide');
                $('.plan_year2').removeClass('hide');
                $('.plan_year3').addClass('hide');
            }else{
                $('.plan_year1').removeClass('hide');
                $('.plan_year2').removeClass('hide');
                $('.plan_year3').removeClass('hide');
            }

            if (plan_length >= 3 && plan_length <= 5){
                $('.small-discount').addClass('hide');
                $('.big-discount').removeClass('hide');
            }else {
                $('.small-discount').removeClass('hide');
                $('.big-discount').addClass('hide');
            }

            var plan_amount = calculate_plan(1);
            // $('.plan-total').html(plan_amount);

            if (document.getElementById('payment_as').checked){
                var round_amount = plan_amount;
                $('.plan-total').html(round_amount);
                $('.plan-total').attr('data-val',plan_amount);
                var split = parseFloat(plan_length * 12);
                $('.p_split').html(split);
            }else{
                $('.plan-total').html(plan_amount);
                var split = $('.c_payment').val();
                $('.p_split').html(split);

            }

            var total = calculate_plan(2);
            var discount = $('.c_discount option:selected').attr('data-val');
            if (discount.indexOf("$") >= 0){
                discount = discount.replace('$', '');
                $('.discount-total').html(discount);
            }else {
                $('.discount-total').html(calculate_discount(discount,total));
            }
            extra_options();
        });

        $('.c_discount').on('change', function () {
            var plan_amount = calculate_plan(1);
            // $('.plan-total').html(plan_amount);
            if (document.getElementById('payment_as').checked){
                var round_amount = plan_amount;
                $('.plan-total').html(round_amount);
                $('.plan-total').attr('data-val',plan_amount);
            }else{
                $('.plan-total').html(plan_amount);
            }

            var total = calculate_plan(2);
            var discount = $('.c_discount option:selected').attr('data-val');
            if (discount.indexOf("$") >= 0){
                discount = discount.replace('$', '');
                $('.discount-total').html(discount);
            }else {
                $('.discount-total').html(calculate_discount(discount,total));
            }
        });

        $('#save-customer').submit(function (e) {
            e.preventDefault();
            var coverage = [];
            $('input[name="opt_coverage"]:checked').each(function() {
                coverage.push($(this).val());
            });
            var btn = $('.submit-customer').ladda();
            btn.ladda('start');
            var value = new FormData( $("#save-customer")[0] );
            value.append("coverage", coverage);

            $.ajax({
                url:admin_url+'customers/renew_policy',
                type:'post',
                data:value,
                dataType:'json',
                processData: false,
                contentType: false,
                success:function(status){
                    if(status.msg=='success'){
                        btn.ladda('stop');
                        toastr.success(status.response, 'Success');
                        if(status.charge_status != ''){
                            if(status.charge_status == 1){
                                toastr.success('Payment succesfully approved', 'Success');
                            }else{
                                toastr.error('Payment declined', 'Error');
                            }
                        }
                        setTimeout(function () {
                            $(location).attr('href', admin_url+"customers");
                        }, 2000);
                    }
                    else if(status.msg == 'error'){
                        btn.ladda('stop');
                        if(status.customer_id!="" && status.customer_id != 'undefined' ){
                            toastr.error(status.response, 'Error');
							setTimeout(function () {
								$(location).attr('href', admin_url+"customers/edit/"+status.customer_id+"/0/tab-2");
							}, 2000); 
                        }else if(status.charge_status != ''){
                            toastr.error(status.response, 'Error');
                        }else{
                            toastr.error(status.response, 'Error');
                        }
                    }
                }
            });
        });
    });


    function calculate_plan(cal_discount) {
        var property = $('.c_p_type option:selected').attr('data-val');
        var size = $('.c_size option:selected').attr('data-val');
        var optional_coverage = coverage();
        var plan = $('.c_plan_type option:selected').attr('data-val');
        var year = $('.c_plan').val();
        var splits = $('.c_payment').val();
        var discount = $('.c_discount option:selected').attr('data-val');
        var after_discount = 0;
        if (discount==''){
            discount=0;
        }
        var m_charge = $('.m_charge').val();
        var sign = '';
        if (m_charge.indexOf('-') == -1) {
            sign='';
        }else {
            sign = '-';
        }
        m_charge = m_charge.replace ( /[^\d.]/g, '' );
        if (m_charge==''){
            m_charge=0;
        }
        m_charge = sign + m_charge;
        var plan_total = parseInt(plan) * year;
        var total = parseFloat(property) + parseFloat(size) + parseFloat(optional_coverage) + parseFloat(plan_total) + parseFloat(m_charge);
        if (cal_discount==1){
            if (discount.indexOf("$") >= 0){
                discount = discount.replace('$', '');
                after_discount = total - discount;
            }else {
                after_discount = total - calculate_discount(discount,total);
            }
            if (document.getElementById('payment_as').checked){
                var after_split = after_discount/(year * 12);
            }else{
                var after_split = after_discount/splits;
            }
            return (after_split).toFixed(2);
        }else {
            return total;
        }
    }

    function calculate_discount(discount,total) {
        discount = parseInt(discount);
        var total_discount = total/100*discount;
        return (total_discount).toFixed(2);
    }

    function coverage() {
        var total=0;
        var year = $('.c_plan').val();
        // var months = $('.c_month').val();
        var year_month = parseInt(year);
        var total_months = 12;
        // if (months != ''){
        //     total_months = parseInt(year_month) + parseFloat(months / total_months);
        // } else {
        total_months = parseInt(year_month);
        // }
        $('input[name="opt_coverage"]:checked').each(function() {
            var month_price = parseFloat($(this).attr('data-val')) * total_months;
            total = total + month_price;
        });
        return total;
    }

    function extra_options() {
        $('.extra-coverage').html('');
        $('input[name="opt_coverage"]:checked').each(function() {
            var name = $(this).attr('data-id');
            var value = $(this).attr('data-val');

            var year = $('.c_plan').val();
            // var months = $('.c_month').val();
            var year_month = parseInt(year);
            var total_months = 12;
            // if (months != ''){
            //     total_months = parseInt(year_month) + parseFloat(months / total_months);
            // } else {
            total_months = parseInt(year_month);
            // }

            var total_amount = parseFloat(value) * total_months;

            $('.extra-coverage').append("<tr>\n" +
                "<td>"+name+"</td>\n" +
                "<td><span>$"+(total_amount).toFixed(2)+"</span></td>\n" +
                "</tr>")
        });
    }
</script>

<script>
    var inputQuantity = [];
    $(function() {
        $(".free_scf").each(function(i) {
            inputQuantity[i]=this.defaultValue;
            $(this).data("idx",i);
        });
        $(".free_scf").on("keyup", function (e) {
            var $field = $(this),
                val=this.value,
                $thisIndex=parseInt($field.data("idx"),10);
            if (this.validity && this.validity.badInput || isNaN(val) || $field.is(":invalid") ) {
                this.value = inputQuantity[$thisIndex];
                return;
            }
            if (val.length > Number($field.attr("maxlength"))) {
                val=val.slice(0, 5);
                $field.val(val);
            }
            inputQuantity[$thisIndex]=val;
        });
    });
$('.card_num').on('keyup keypress blur click', function(e) {
		if(e.keyCode == 32)
		return false;
		this.value = this.value.replace(/[^0-9+\.]/g,''); 
	});
</script>
</body>
</html>
