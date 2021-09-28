<!DOCTYPE html>
<html>

<head>
    <?php $this->load->view('common/admin_header'); ?>

    <link href="<?php echo base_url(); ?>assets/admin_assets/css/datatable/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/admin_assets/css/datatable/responsive.bootstrap4.min.css" rel="stylesheet">
    <style type="text/css">
        .note-editable .card-block p{
            margin-top: 40px !important;
        }
    </style>

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
                        <strong>Edit Customers</strong>
                    </li>
                </ol>
            </div>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight pb-0">
            <form method="post" id="update-customer">
                <div class="row">
                    <div class="col-xl-8 col-lg-12 col-md-12 col-sm-12">
                        <div class="wrapper wrapper-content animated fadeInRight">
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="ibox m-0">
                                        <div class="ibox-content ibox-content pt-4 pb-2">
                                            <div class="left_section">
                                                <div class="form_section">
                                                    <h2 class="mb-4">General Contact Person</h2>
                                                    <div class="row">
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>First Name</label>
                                                                <input type="hidden" name="id" value="<?php echo $details['id']; ?>">
                                                                <input type="text" placeholder="First Name" class="form-control" value="<?php echo $details['first_name']; ?>" name="c_fname" >
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Last Name</label>
                                                                <input type="text" placeholder="Last Name" class="form-control" value="<?php echo $details['last_name']; ?>" name="c_lname" >
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Home Phone</label>
                                                                <input type="number" min="0" class="form-control" name="c_home_phn" value="<?php echo $details['home_phone']; ?>" >
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Work Phone</label>
                                                                <input type="number" min="0" class="form-control" name="c_work_phn" value="<?php echo $details['work_phone']; ?>" >
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Email</label>
                                                                <input type="email" placeholder="email" class="form-control" value="<?php echo $details['email']; ?>" name="c_email" >
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="checkbox m-r-xs" style="margin-top: 33px">
                                                                <input type="checkbox" <?php if ($details['send_mail']==0){ ?> checked <?php } ?> name="not_mail" id="checkbox1">
                                                                <label for="checkbox1">
                                                                    DO NOT EMAIL
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="hr-line-dashed"></div>
                                                </div>
                                                <div class="form_section">
                                                    <h2 class="mb-4">Primary Contact Person</h2>
                                                    <div class="row">
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>First Name</label>
                                                                <input type="text" placeholder="First Name" class="form-control" value="<?php echo $details['p_firstname']; ?>" name="p_fname">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Last Name</label>
                                                                <input type="text" placeholder="Last Name" class="form-control" value="<?php echo $details['p_lastname']; ?>" name="p_lname">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Home Phone</label>
                                                                <input type="number" min="0" placeholder="Phone" class="form-control" value="<?php echo $details['p_phone']; ?>" name="p_phn">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Work Phone</label>
                                                                <input type="number" min="0" class="form-control p_work_phn" value="<?php echo $details['p_work_phone']; ?>" name="p_work_phn" >
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Email</label>
                                                                <input type="email" class="form-control" value="<?php echo $details['p_email']; ?>" name="p_email">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="hr-line-dashed"></div>
                                                </div>
                                                <?php
                                                $latest_policy = get_customer_policy($details['policy_num']);
                                                ?>
                                                <div class="form_section">
                                                    <h2 class="mb-4">Property Information</h2>
                                                    <div class="row">
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Address</label>
                                                                <input type="hidden" class="form-control" value="<?php echo $latest_policy['id']; ?>" name="policy_id">
                                                                <input type="hidden" class="form-control" value="<?php echo $latest_policy['policy_num']; ?>" name="plan_id">

                                                                <input type="text" class="form-control" value="<?php echo $details['street_address']; ?>" name="c_address">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>City</label>
                                                                <input type="text" class="form-control" value="<?php echo $details['city']; ?>" name="c_city">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>State</label>
                                                                <input type="text" class="form-control" value="<?php echo $details['state']; ?>" name="c_state">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Zip</label>
                                                                <input type="number" min="0" class="form-control" value="<?php echo $details['zip_code']; ?>" name="c_zip">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Property Type</label>
                                                                <select class="form-control c_p_type" name="c_p_type">
                                                                    <?php foreach (get_setting('property_type','',1) as $property){ ?>
                                                                        <option value="<?php echo $property['meta_key']; ?>" data-val="<?php echo $property['meta_value']; ?>" <?php if($latest_policy['property_type']==$property['meta_key']){ ?> selected <?php } ?>><?php echo $property['meta_content']; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Size</label>
                                                                <select class="form-control c_size" name="c_size">
                                                                    <?php foreach (get_setting('property_size','',1) as $size){ ?>
                                                                        <option value="<?php echo $size['meta_key']; ?>" data-val="<?php echo $size['meta_value']; ?>" <?php if ($latest_policy['size']==$size['meta_key']){ ?> selected <?php } ?>><?php echo $size['meta_content']; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="hr-line-dashed"></div>
                                                </div>

                                                <div class="form_section">
                                                    <h2 class="mb-4">Billing Address</h2>
                                                    <div class="row">
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Address</label>
                                                                <input type="text" class="form-control" value="<?php echo $details['bill_address']; ?>" name="b_address">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>City</label>
                                                                <input type="text" class="form-control" value="<?php echo $details['bill_city']; ?>" name="b_city">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>State</label>
                                                                <input type="text" class="form-control" value="<?php echo $details['bill_state']; ?>" name="b_state">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Zip</label>
                                                                <input type="number" min="0" class="form-control" value="<?php echo $details['bill_zipcode']; ?>" name="b_zip">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Name on Card</label>
                                                                <input type="text" class="form-control" value="<?php echo $details['bill_cardname']; ?>" name="b_name_on_card">
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="form_section">
                                                    <h2 class="mb-4">Mailing Address</h2>
                                                    <div class="row">
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Address</label>
                                                                <input type="text" class="form-control" value="<?php echo $details['mail_address']; ?>" name="m_address">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>City</label>
                                                                <input type="text" class="form-control" value="<?php echo $details['mail_city']; ?>" name="m_city">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>State</label>
                                                                <input type="text" class="form-control" value="<?php echo $details['mail_state']; ?>" name="m_state">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Zip</label>
                                                                <input type="number" min="0" class="form-control" value="<?php echo $details['mail_zipcode']; ?>" name="m_zip">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="hr-line-dashed"></div>
                                                </div>

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

                                                    <h2 class="mb-4">Warranty Information</h2>
                                                    <div class="row">
                                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="lbl">
                                                                Policy #
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="txt">
                                                                <?php echo $latest_policy['policy_num'];?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="plan_name">
                                                        <div class="row">
                                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="lbl">
                                                                    Plan
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="txt">
                                                                    <?php
                                                                    $plan_value = get_plan_name('plan', $latest_policy['plan']);
                                                                    echo $plan_value['meta_content'];
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="lbl">
                                                                    SCF
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="txt">
                                                                    <?php
                                                                    $scf_value = get_plan_name('scf', $latest_policy['scf']);
                                                                    echo '$'.number_format((float)$scf_value['meta_value'], 2, '.', '');
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="lbl">
                                                                    Free SCF
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="txt">
                                                                    <?php
                                                                    if (!empty($latest_policy['free_scf'])) {
                                                                        echo $latest_policy['free_scf'];
                                                                    }else{
                                                                        echo '0';
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row hide show_plan">
                                                        <div class="col-md-12 col-sm-12">
                                                            <div class="field">
                                                                <div class="form-group">
                                                                    <label>Plan Type</label>
                                                                    <select class="form-control input-sm c_plan_type" name="c_plan_type">
                                                                        <?php foreach (get_setting('plan','',1) as $plan){ ?>
                                                                            <option value="<?php echo $plan['meta_key']; ?>" data-val="<?php echo $plan['meta_value']; ?>" <?php if ($latest_policy['plan']==$plan['meta_key']){ ?> selected <?php } ?>><?php echo $plan['meta_content']; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="hr-line-dashed"></div>
                                                    <div class="row">
                                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="txt">
                                                                <a href="javascript:void(0);" class="change_plan">Change Plan</a>
                                                                <a href="javascript:void(0);" class="hide hide_change_plan">Change Plan</a>
                                                            </div>
                                                        </div>
                                                        <?php if ($latest_policy['status'] == '6' || db_date($latest_policy['plan_end']) <= date('Y-m-d')) { ?>
                                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="txt text-xl-right">
                                                                    <a href="<?php echo admin_url(); ?>customers/add/<?php echo $details['id'];?>" class="btn btn-primary btn-sm my-2 my-xl-0 customer-btn"><strong>Re-New Plan</strong></a>
                                                                </div>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="hr-line-dashed"></div>


                                                    <div class="row hide show_plan">
                                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="field">
                                                                <div class="form-group">
                                                                    <label>SCF</label>
                                                                    <select class="form-control c_scf" name="c_scf">
                                                                        <option value="" data-val="0">Select SCF</option>
                                                                        <?php foreach (get_setting('scf','',1) as $scf){ ?>
                                                                            <option value="<?php echo $scf['meta_key']; ?>" <?php if ($latest_policy['scf']==$scf['meta_key']){ ?> selected <?php } ?> data-val="<?php echo $scf['meta_value']; ?>">$<?php echo $scf['meta_value']; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="field">
                                                                <div class="form-group">
                                                                    <label>Free SCF</label>
                                                                    <input type="number" value="<?php echo $latest_policy['free_scf']; ?>" class="form-control free_scf" name="free_scf" min="1" max="2" maxlength = "1">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12 col-sm-12">
                                                            <div class="field">
                                                                <div class="form-group" id="data_5">
                                                                    <label class="font-normal">Term</label>
                                                                    <div class="input-daterange input-group" id="datepicker">
                                                                        <input type="text" id="plan-start" required="true" class="form-control-sm form-control" value="<?php echo date('Y-m-d', strtotime($latest_policy['plan_start'])); ?>" name="start" disabled="true" />
                                                                        <input type="hidden" name="plan_start" value="<?php echo date('Y-m-d', strtotime($latest_policy['plan_start'])); ?>">
                                                                        <span class="input-group-addon">to</span>
                                                                        <input type="text" id="plan-end" class="form-control-sm form-control" value="<?php echo date('Y-m-d', strtotime($latest_policy['plan_end'])); ?>" name="end" required="true" disabled="true" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12 col-sm-12">
                                                            <div class="field">
                                                                <div class="form-group">
                                                                    <label>Status</label>
                                                                    <select class="form-control" name="status">
                                                                        <option value="1" <?php if ($latest_policy['status']==1){ ?> selected <?php } ?>>New</option>
                                                                        <option value="2" <?php if ($latest_policy['status']==2){ ?> selected <?php } ?>>Active</option>
                                                                        <option value="3" <?php if ($latest_policy['status']==3){ ?> selected <?php } ?>>Inactive</option>
                                                                        <option value="4" <?php if ($latest_policy['status']==4){ ?> selected <?php } ?>>Past Due</option>
                                                                        <option value="5" <?php if ($latest_policy['status']==5){ ?> selected <?php } ?>>Cancelled</option>
                                                                        <option value="6" <?php if ($latest_policy['status']==6){ ?> selected <?php } ?>>Expired</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="hr-line-dashed"></div>

                                                <div class="row">
                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <div class="lbl">
                                                            Initial Payment
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12 span_initial_payment">
                                                        <div class="txt">
                                                            <strong>
                                                                    <span data-val="516.8">
                                                                        <?php if ($latest_policy['payment_as'] == '1') { ?>
                                                                            $<i class="plan-total"><?php echo $latest_policy['plan_total']; ?></i>
                                                                        <?php }else{ ?>
                                                                            $<i class="plan-total"><?php echo round($latest_policy['plan_total']); ?></i>
                                                                        <?php } ?>
                                                                    </span>
                                                                <span class="edit_price"><a href="javascript:void(0);"class="btn_initial_payment">edit</a></span>
                                                            </strong>

                                                        </div>
                                                    </div>

                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12 hide show_initial_payment">
                                                        <div class="input-group mb-3 ">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text input-sm" id="basic-addon1">$</span>
                                                            </div>
                                                            <?php if ($latest_policy['payment_as'] == '1') { ?>
                                                                <input type="text" name="plan_total" value="<?php echo $latest_policy['plan_total']; ?>" class="form-control input-sm">
                                                            <?php }else{ ?>
                                                                <input type="text" name="plan_total" value="<?php echo round($latest_policy['plan_total']); ?>" class="form-control input-sm">
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <div class="lbl">
                                                            Plan Total
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12 span_net_total">
                                                        <div class="txt">
                                                            <strong><span id="net-payment">$<?php echo ($latest_policy['net_total']); ?></span>
                                                                <span class="edit_price"><a href="javascript:void(0);"class="btn_net_total">edit</a></span>
                                                            </strong>

                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12 hide show_net_total">
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text input-sm" id="basic-addon1">$</span>
                                                            </div>
                                                            <input type="text" name="net_total" value="<?php echo ($latest_policy['net_total']); ?>" class="form-control input-sm">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="hr-line-dashed"></div>
                                                <div class="form_section">

                                                    <div class="row hide">
                                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12 hide" style="display: none;">
                                                            <label>Plan</label>
                                                            <select class="form-control c_plan" name="c_plan">
                                                                <option value="1" <?php if ($latest_policy['plan_year']==1){ ?> selected <?php } ?>>1 Year</option>
                                                                <option value="2" <?php if ($latest_policy['plan_year']==2){ ?> selected <?php } ?>>2 Year</option>
                                                                <option value="3" <?php if ($latest_policy['plan_year']==3){ ?> selected <?php } ?>>3 Year</option>
                                                                <option value="4" <?php if ($latest_policy['plan_year']==4){ ?> selected <?php } ?>>4 Year</option>
                                                                <option value="5" <?php if ($latest_policy['plan_year']==5){ ?> selected <?php } ?>>5 Year</option>
                                                            </select>
                                                        </div>

                                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12 hide" style="display: none;">
                                                            <div class="field">
                                                                <div class="form-group">
                                                                    <label>Payments</label>
                                                                    <select class="form-control c_payment" name="c_payment">
                                                                        <option value="1" <?php if ($latest_policy['payment_split']==1){ ?> selected <?php } ?>>1</option>
                                                                        <option value="2" <?php if ($latest_policy['payment_split']==2){ ?> selected <?php } ?>>2</option>
                                                                        <option value="3" <?php if ($latest_policy['payment_split']==3){ ?> selected <?php } ?>>3</option>
                                                                        <option value="4" <?php if ($latest_policy['payment_split']==4){ ?> selected <?php } ?>>4</option>
                                                                        <option value="5" <?php if ($latest_policy['payment_split']==5){ ?> selected <?php } ?>>5</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row hide" style="display: none;">
                                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="field">
                                                                <div class="form-group">
                                                                    <label>Months</label>
                                                                    <select class="form-control c_month" name="c_month">
                                                                        <option value="">Select Months</option>
                                                                        <option value="1" <?php if ($latest_policy['free_month']==1){ ?> selected <?php } ?>>1 Month</option>
                                                                        <option value="2" <?php if ($latest_policy['free_month']==2){ ?> selected <?php } ?>>2 Month</option>
                                                                        <option value="3" <?php if ($latest_policy['free_month']==3){ ?> selected <?php } ?>>3 Month</option>
                                                                        <option value="4" <?php if ($latest_policy['free_month']==4){ ?> selected <?php } ?>>4 Month</option>
                                                                        <option value="5" <?php if ($latest_policy['free_month']==5){ ?> selected <?php } ?>>5 Month</option>
                                                                        <option value="6" <?php if ($latest_policy['free_month']==6){ ?> selected <?php } ?>>6 Month</option>
                                                                        <option value="7" <?php if ($latest_policy['free_month']==7){ ?> selected <?php } ?>>7 Month</option>
                                                                        <option value="8" <?php if ($latest_policy['free_month']==8){ ?> selected <?php } ?>>8 Month</option>
                                                                        <option value="9" <?php if ($latest_policy['free_month']==9){ ?> selected <?php } ?>>9 Month</option>
                                                                        <option value="10" <?php if ($latest_policy['free_month']==10){ ?> selected <?php } ?>>10 Month</option>
                                                                        <option value="11" <?php if ($latest_policy['free_month']==11){ ?> selected <?php } ?>>11 Month</option>
                                                                        <option value="12" <?php if ($latest_policy['free_month']==12){ ?> selected <?php } ?>>12 Month</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="field">
                                                                <div class="form-group">
                                                                    <label>Discount</label>
                                                                    <select class="form-control c_discount" name="c_discount">
                                                                        <option value="" data-val="0">Select Discount</option>
                                                                        <?php foreach (get_setting('discount','',1) as $discount){ ?>
                                                                            <option <?php if ($discount['meta_key']==7){ ?> class="hide big-discount" <?php } ?> <?php if ($latest_policy['discount']==$discount['meta_key']){ ?> selected <?php } ?> value="<?php echo $discount['meta_key']; ?>" data-val="<?php echo $discount['meta_value']; ?>"><?php echo $discount['meta_value']; ?>%</option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12 hide" style="display: none;">
                                                            <div class="field">
                                                                <div class="form-group">
                                                                    <label>Miscellaneous Charge</label>
                                                                    <input type="text" placeholder="" value="<?php echo $latest_policy['m_charge']; ?>" class="form-control m_charge" name="m_charge">
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="row coverage_plan">
                                                    <div class="col">
                                                        <table class="table table-borderless opt-table">
                                                            <tr>
                                                                <td colspan="2">
                                                                    <h2 class="m-0">COVERAGE</h2>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <?php $current_plan = get_setting('plan',$latest_policy['plan'],1); ?>
                                                                <td id="plan-name">
                                                                    <?php echo $current_plan[0]['meta_content']; ?>
                                                                </td>
                                                                <td>
                                                                    <span class="pull-right">$<i class="plan-amount"><?php echo number_format((float)$current_plan[0]['meta_value'], 2, '.', ''); ?></i></span>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2">
                                                                    <h2 class="m-0"> EXTRAS</h2>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2">
                                                                    <table class="table table-borderless extra-coverage">
                                                                        <?php foreach (get_coverage($details['id'], $latest_policy['id']) as $cov_id){
                                                                            $selected = get_setting('opt_coverage',$cov_id['coverage'],1);
                                                                            $years = $latest_policy['plan_year'];
                                                                            $year_months = $years;
                                                                            $months = $latest_policy['free_month'];
                                                                            if ($months != ''){
                                                                                $total_months = $year_months + ($months / 12);
                                                                            }else{
                                                                                $total_months = $year_months;
                                                                            }
                                                                            ?>
                                                                            <tr>
                                                                                <td><?php echo $selected[0]['meta_content']; ?></td>
                                                                                <td><span><?php echo '$'.number_format((float)$selected[0]['meta_value']*$total_months, 2, '.', ''); ?></span></td>
                                                                            </tr>
                                                                        <?php } ?>
                                                                    </table>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="hr-line-dashed"></div>


                                                <div class="form_section">
                                                    <h2 class="mb-4"> Order Information</h2>
                                                    <div class="row">
                                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="lbl">
                                                                Order Date
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="txt">
                                                                <span class="order_date"><?php echo date('F jS, Y - h:i a' ,strtotime($details['created_at'])); ?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="lbl">
                                                                IP Address
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="txt">
                                                                <?php if (!empty($details['ip_address'])){ echo $details['ip_address']; }else{ echo '-'; } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="lbl">
                                                                Number of Accounts
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="txt">
                                                                <?php $total_accounts = total_accounts($details['email']);
                                                                echo count($total_accounts); ?>
                                                            </div>
                                                            <?php foreach ($total_accounts as $account){ ?>
                                                                <div class="txt links">
                                                                    <?php if ($account['id'] != $details['id']){ ?>
                                                                        <a href="<?php echo admin_url().'customers/edit/'.$account['id']; ?>"><?php echo $account['first_name'].' '.$account['last_name']; ?></a>
                                                                    <?php } ?>
                                                                </div>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12 col-sm-12">
                                                            <div class="field">
                                                                <div class="form-group m-0">
                                                                    <label>Sales Person</label>
                                                                    <select class="form-control" name="salesperson">
                                                                        <option value="">Select sale person</option>
                                                                        <?php foreach (get_salesperson() as $salesperson){ ?>
                                                                            <option value="<?php echo $salesperson['id']; ?>" <?php if ($details['salesperson']==$salesperson['id']){ ?> selected <?php } ?>><?php echo $salesperson['FirstName'].' '.$salesperson['LastName']; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="hr-line-dashed"></div>
                                                    <div class="row">
                                                        <div class="col-xl-12 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="txt">
                                                                <a href="javascript:void(0);">Login To Customer Portal</a>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-12 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="txt text-xl-right">
                                                                <button class="btn btn-sm btn-danger my-2 my-xl-0" type="button"><strong>Cancelation Requested</strong></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="hr-line-dashed"></div>
                                                </div>
                                                <div class="form_section">
                                                    <h2 class="mb-4"> Claim Information</h2>
                                                    <div class="row">
                                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="lbl">
                                                                # of Claims to Date
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="txt">
                                                                <?php $claim_count = claims_count($details['id']); if (!empty($claim_count)){ echo $claim_count[0]['total']; } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="lbl">
                                                                Paid Claim to Date
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="txt">
                                                                <strong> <?php echo '$'.number_format((float)total_customer_amount($details['id']), 2, '.', ''); ?></strong>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="hr-line-dashed"></div>
                                                    <div class="row">
                                                        <div class="col-md-12 col-sm-12">
                                                            <div class="lbl">
                                                                Potential Refund
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 col-sm-12">
                                                            <div class="txt links">
                                                                <a href="javascript:void(0);" class="potential-refund" data-id="<?php echo $details['id']; ?>" data-val="1">Send Past Due</a>
                                                                <a href="javascript:void(0);" class="potential-refund" data-id="<?php echo $details['id']; ?>" data-val="2">E-Mail Confirmation</a>
                                                                <a href="javascript:void(0);" class="potential-refund" data-id="<?php echo $details['id']; ?>" data-val="3">TXT Confirmation</a>
                                                                <a href="javascript:void(0);" class="potential-refund" data-id="<?php echo $details['id']; ?>" data-val="4">Send Paid Invoice</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="hr-line-dashed"></div>
                                                </div>
                                            </div>
                                            <div class="btn_submit text-center">
                                                <button class="btn btn-primary btn-block btn-lg m-t-n-xs submit-customer" type="submit"><strong>Update</strong></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-md-12">
                        <div class="tabs-container mb-3">
                            <ul class="nav nav-tabs" role="tablist">
                                <li><a class="nav-link active" data-toggle="tab" href="#tab-1"> Notes</a></li>
                                <li><a class="nav-link" data-toggle="tab" href="#tab-2">Billing</a></li>
                                <li><a class="nav-link" data-toggle="tab" href="#tab-3">Claims</a></li>
                                <li><a class="nav-link" data-toggle="tab" href="#tab-5">Files</a></li>
                                <li><a class="nav-link" data-toggle="tab" href="#tab-6">PDF ePolicy</a></li>
                                <li><a class="nav-link" data-toggle="tab" href="#tab-7">Letters</a></li>
                                <li><a class="nav-link" data-toggle="tab" href="#tab-8">Coverage</a></li>
                                <li><a class="nav-link" data-toggle="tab" href="#tab-9">Status</a></li>
                            </ul>
                            <div class="tab-content">
                                <div role="tabpanel" id="tab-1" class="tab-pane active">
                                    <div class="panel-body">
                                        <div class="feed-activity-list">
                                            <div class="form_section">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <h2 class="mb-4 mt-0">Add Notes</h2>
                                                    </div>
                                                    <div class="col-6 text-right">
                                                        <button type="button" class="btn btn-primary add_task" data-toggle="modal" data-target="#add_notes_modal"><i class="fa fa-plus"></i> Add Note</button>
                                                    </div>
                                                </div>
                                            </div>

                                            <?php
                                            $notes = get_notes_tasks($details['id']);
                                            if (empty($notes)){
                                                echo 'No Records Found';
                                            }else{ ?>
                                                <?php foreach ($notes as $note){ ?>
                                                    <div class="feed-element" <?php if ($note['type'] == 1 && $note['status'] == 1){ ?> style="background-color: #b7f6b7" <?php } ?>>
                                                        <div class="media-body">
                                                            <p class="float-right">
                                                                <strong>Added By:</strong> &nbsp;
                                                                <span><?php $salesperson = get_staff_name($note['assign_by']); echo $salesperson['FirstName'].' '.$salesperson['LastName']; ?></span>
                                                            </p>
                                                            <p class="m-0">
                                                                <strong>Note Added</strong>
                                                                <span class="text-muted"> <?php echo date('d.M.Y - h:i a', strtotime($note['created_at'])); ?> </span>
                                                            </p>
                                                            <p class="m-0">
                                                                <strong>Description: </strong><span><?php echo $note['details']; ?></span>
                                                            </p>
                                                            <p class="float-right" style="margin-right: 50px">
                                                                <span>
                                                                    <?php if ($note['type'] == 1 && $note['status'] == 1){ ?>
<!--                                                                        <div class="col-md-3 col-sm-12">-->
<!--                                                                            <div class="form-group">-->
                                                                                <select class="form-control task-status" data-id="<?php echo $note['id'] ?>" style="width: 130px" name="task_status">
                                                                                    <option value="1" <?php if ($note['status']==1){ ?> selected <?php } ?>>New</option>
                                                                                    <option value="2" <?php if ($note['status']==2){ ?> selected <?php } ?>>Closed</option>
                                                                                </select>
<!--                                                                            </div>-->
<!--                                                                        </div>-->
                                                                    <?php } ?>
                                                                </span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" id="tab-2" class="tab-pane">
                                    <div class="panel-body">
                                        <div class="form_section">
                                            <form class="payment_update">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <h2 class="mb-4 mt-0">Payment Method</h2>
                                                        <h4 class="mb-4">Credit Card</h4>
                                                    </div>
                                                    <div class="col-6 text-right">
                                                        <a href="#" class="btn btn-primary mt-2 update-payment">
                                                            <i class="fa fa-refresh"></i>
                                                            Update</a>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label>Card Number</label>
                                                            <input type="number" min="0" placeholder="" value="<?php echo $details['card_num']; ?>" class="form-control card_num" name="card_num">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label>CVV</label>
                                                            <input type="number" min="0" placeholder="" value="<?php echo $details['card_pin']; ?>" class="form-control" name="card_pin">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <label>Exp Month</label>
                                                        <select class="form-control" name="card_month">
                                                            <option value="1" <?php if ($details['card_exp_month']==1){ ?> selected <?php } ?>>1</option>
                                                            <option value="2" <?php if ($details['card_exp_month']==2){ ?> selected <?php } ?>>2</option>
                                                            <option value="3" <?php if ($details['card_exp_month']==3){ ?> selected <?php } ?>>3</option>
                                                            <option value="4" <?php if ($details['card_exp_month']==4){ ?> selected <?php } ?>>4</option>
                                                            <option value="5" <?php if ($details['card_exp_month']==5){ ?> selected <?php } ?>>5</option>
                                                            <option value="6" <?php if ($details['card_exp_month']==6){ ?> selected <?php } ?>>6</option>
                                                            <option value="7" <?php if ($details['card_exp_month']==7){ ?> selected <?php } ?>>7</option>
                                                            <option value="8" <?php if ($details['card_exp_month']==8){ ?> selected <?php } ?>>8</option>
                                                            <option value="9" <?php if ($details['card_exp_month']==9){ ?> selected <?php } ?>>9</option>
                                                            <option value="10" <?php if ($details['card_exp_month']==10){ ?> selected <?php } ?>>10</option>
                                                            <option value="11" <?php if ($details['card_exp_month']==11){ ?> selected <?php } ?>>11</option>
                                                            <option value="12" <?php if ($details['card_exp_month']==12){ ?> selected <?php } ?>>12</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label>Year</label>
                                                            <select class="form-control card-year" name="card_year">
                                                                <?php $cur_year = date("Y");
                                                                for ($x = $cur_year; $x <= $cur_year+10; $x++){ ?>
                                                                    <option value="<?php echo $x; ?>" <?php if ($details['card_exp_year']==$x){ ?> selected <?php } ?>><?php echo $x; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="hidden" value="<?php echo $details['id']; ?>" name="customer_id">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" id="tab-3" class="tab-pane">
                                    <div class="panel-body">
                                        <div class="feed-activity-list">
                                            <div class="feed-element p-0 mb-3">
                                                <a href="<?php echo admin_url(); ?>claims/add/<?php echo $details['id'];?>" class="btn btn-primary mb-2 ">
                                                    <i class="fa fa-plus"></i>
                                                    Add Claim</a>
                                            </div>
                                        </div>
                                        <div class="feed-activity-list">
                                            <?php
                                            $claims = get_data('','claims',array('customer'=>$details['id']));
                                            if (empty($claims)){
                                                echo 'No Records Found';
                                            }else{ ?>
                                                <?php foreach ($claims as $data){ ?>
                                                    <div class="feed-element">
                                                        <div class="media-body ">
                                                            <small class="float-right"><h3 class="m-0">Accounts Payable<br><span class="d-block text-right text-info"><?php
                                                                        $total_claim =  total_claim_amount($data['id']);
                                                                        if ($total_claim['amount'])
                                                                        { echo '$'. number_format((float)$total_claim['amount'], 2, '.', ''); }
                                                                        else{ echo '$0.00'; } ?>
                                                        </span></h3> </small>
                                                            <p class="m-0">
                                                                <strong>Claim # <a href="javascript:void(0);" class="claim-view" data-val="<?php echo $data['claim_num']; ?>"><?php echo $data['claim_num']; ?></a></strong>
                                                                <span class="text-muted"> <?php echo date('d.M.Y - h:i a', strtotime($data['created_at'])); ?> </span>
                                                            </p>
                                                            <p class="m-0">
                                                                <strong>Claim Status </strong><span><?php echo claim_status($data['status']); ?></span> |
                                                                <strong>Claim Item </strong><span>
                                                                <?php
                                                                $str = $data['item'];
                                                                $str_meta_key = explode("-", $str);
                                                                if ($str_meta_key[0] == 's') {
                                                                    $meta_tag = 'systems';
                                                                }elseif ($str_meta_key[0] == 'a') {
                                                                    $meta_tag = 'appliance';
                                                                }elseif ($str_meta_key[0] == 'c') {
                                                                    $meta_tag = 'combo';
                                                                }else{
                                                                    $meta_tag = 'opt_coverage';
                                                                }
                                                                $get_meta_content = get_claim_value($meta_tag, $str_meta_key[1]);
                                                                echo $get_meta_content['meta_content'];
                                                                ?> - <?php echo $data['problem']; ?></span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                <?php } } ?>
                                        </div>
                                        <div id="claim-detail"></div>
                                    </div>
                                </div>
                                <div role="tabpanel" id="tab-5" class="tab-pane">
                                    <div class="panel-body">
                                        <div class="related-images">

                                            <form method="post" id="upload-related" enctype="multipart/form-data">
                                                <div class="form-group row">
                                                    <div class="col-sm-5">
                                                        <input id="related-image" type="file" class="form-control upload-image" data-type="related-image" name="image" accept=".jpg, .pdf">

                                                    </div>
                                                    <div class="col-sm-5">
                                                        <input type="text" class="form-control" name="image_alt" placeholder="File Name" maxlength="15" required="true">
                                                    </div>
                                                    <input type="hidden" name="customer_claim" value="<?php echo $details['id']; ?>" class="customer_claim">
                                                    <div class="col-md-2">
                                                        <button class="btn btn-primary save-related" type="submit">Upload File</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div id="related-images">

                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" id="tab-6" class="tab-pane">
                                    <div class="panel-body">
                                        <strong>PDF ePolicy</strong>
                                        <div class="feed-activity-list">
                                            <div class="feed-element p-0 mb-3">
                                                <a href="javascript:void(0);" data-id="<?php echo $details['id']; ?>" class="btn btn-primary mb-2 float-right send-policy">
                                                    Send PDF ePolicy</a>
                                            </div>
                                        </div>
                                        <div class="feed-activity-list">
                                            <?php $timestamp_details = get_policy_timestamp($latest_policy['id']);
                                            if (!empty($timestamp_details['mail_ip'])){ ?>
                                                <div class="feed-element">
                                                    <div class="media-body">
                                                        <p class="m-0">
                                                            <strong>ePolicy Acceptance Date & Time:</strong> &nbsp;
                                                            <span><?php echo $timestamp_details['mail_timestamp']; ?></span>
                                                        </p>
                                                        <p class="m-0">
                                                            <strong>IP Address for eSignature:</strong> &nbsp;
                                                            <span><?php echo $timestamp_details['mail_ip']; ?></span>
                                                        </p>
                                                        <p class="m-0">
                                                            <strong>eSignature:</strong> &nbsp;
                                                            <span class="signature-text"><?php echo $details['bill_cardname']; ?></span>
                                                        </p>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" id="tab-7" class="tab-pane">
                                    <div class="panel-body">
                                        <strong>Letters</strong>
                                    </div>
                                </div>
                                <div role="tabpanel" id="tab-8" class="tab-pane">
                                    <div class="panel-body">
                                        <div class="form_section">
                                            <h2 class="mb-4 mt-0">Select Optional Coverage</h2>
                                            <div class="row">
                                                <?php foreach (get_setting('opt_coverage','',1) as $coverage){ ?>
                                                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            <div class="i-checks ml-3">
                                                                <label>
                                                                    <input type="checkbox" class="opt-coverage" value="<?php echo $coverage['meta_key']; ?>" <?php foreach (get_coverage($details['id'], $latest_policy['id']) as $cov_id){ if ($coverage['meta_key']==$cov_id['coverage']){ ?> checked <?php } } ?> data-val="<?php echo $coverage['meta_value']; ?>" data-id="<?php echo $coverage['meta_content']; ?>" name="opt_coverage">
                                                                    <i class="mr-2"></i>
                                                                    <span><?php echo $coverage['meta_content']; ?></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div role="tabpanel" id="tab-9" class="tab-pane">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-6">
                                                <h4 class="mb-4">Policy Views</h4>
                                            </div>
                                        </div>
                                        <div class="ibox-content">
                                            <div class="table-responsive">
                                                <table id="customers_table" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                                                    <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Customer</th>
                                                        <th>User</th>
                                                        <th>Date</th>
                                                        <th>Time</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php $serial = 1 ;?>
                                                    <?php foreach (get_policy_logs($details['id']) as $value) {
                                                        ?>
                                                        <tr class="gradeX">
                                                            <td> <?php echo $serial; ?></td>
                                                            <td>
                                                                <?php $customer = get_customers($value['customer']);
                                                                echo $customer['first_name']." ".$customer['last_name'];
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php $user = get_staff_name($value['user']);
                                                                echo $user['FirstName']." ".$user['LastName'];
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php echo date('F jS, Y' ,strtotime($value['created_at'])); ?>
                                                            </td>
                                                            <td>
                                                                <?php echo date('h:i a' ,strtotime($value['created_at'])); ?>
                                                            </td>
                                                        </tr>

                                                        <?php  $serial++; } ?>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="vendor_modal" tabindex="-1" role="dialog" aria-labelledby="VendorList" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Assign Vendor</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="vendor_body">

                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="diagnosis_modal" tabindex="-1" role="dialog" aria-labelledby="DiagnoseList" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Diagnose</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="diagnose_body">

                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="auth_modal" tabindex="-1" role="dialog" aria-labelledby="AuthorizationDetails" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="auth_head">Authorize Claim</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" id="auth-form">
                            <div class="form_section">
                                <div class="row align-items-end">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Authorize Recipient</label>
                                            <select class="form-control" name="auth_for">
                                                <option value="1">Customer</option>
                                                <option value="2">Vendor</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Amount</label>
                                            <div class="input-group mb-3 ">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text input-sm">$</span>
                                                </div>
                                                <input type="text" class="form-control input-sm" name="amount" id="enter_amount">
                                            </div>
                                            <input type="hidden" class="form-control" id="claim-id" name="claim">
                                            <input type="hidden" class="form-control" id="claim-type" name="type">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="btn_submit text-center">
                                            <button class="btn btn-primary btn-lg m-t-n-xs save-auth mb-3 btn-block" type="submit"><strong>Save</strong></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="vendor-detail"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="revoke_auth_modal" tabindex="-1" role="dialog" aria-labelledby="AuthorizationDetails" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="auth_head">List Authorize Claim</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" id="auth-form">
                            <div class="form_section">
                                <div class="row align-items-end">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Authorize Recipient</label>
                                            <select class="form-control" name="auth_for">
                                                <option value="1">Customer</option>
                                                <option value="2">Vendor</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label>Type</label>
                                            <input type="text" class="form-control" name="amount">

                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="btn_submit text-center">
                                            <button class="btn btn-primary btn-lg m-t-n-xs save-auth mb-3 btn-block" type="submit"><strong>Save</strong></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="vendor-detail"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="add_notes_modal" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Note</h5>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 summer_note_wrap">
                                <div class="summer_note noborder"></div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <select class="form-control task_type">
                                        <option value="2">Add Note</option>
                                        <option value="1">Post Admin Comment</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <select class="form-control task_person hide">
                                        <?php foreach (get_data('','admins',array('type!='=>1),array('id','FirstName','LastName')) as $salesperson){ ?>
                                            <option value="<?php echo $salesperson['id']; ?>"><?php echo $salesperson['FirstName'].' '.$salesperson['LastName']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary save_task" data-val="<?php echo $details['id']; ?>"> Save</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="claim_num" class="hide"><?php echo $claim_id; ?></div>
        <div id="claim_customer_id" class="hide"><?php echo $details['id']; ?></div>
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

        $('#data_5 .input-daterange').datepicker({
            keyboardNavigation: false,
            forceParse: false,
            format: 'yyyy-mm-dd',
            autoclose: true,
        });

        $('#plan-start').on("change", function(){
            var startVal = $('#plan-start').val();
            if (startVal == ''){
                $('#plan-end').attr('disabled',true);
            }else {
                $('#plan-end').attr('disabled',false);
            }
            $('#plan-end').data('datepicker').setStartDate(startVal);

        });

        $('#customers_table').DataTable();
        claim_files();

        var claim = $('#claim_num').html();
        var claim_customer_id = $('#claim_customer_id').html();

        if (claim!='' && claim!='unknown'){
            show_claim(claim, claim_customer_id);
        }

        $('.c_plan_type').on('change', function () {
            var _this = $('.c_plan_type option:selected');
            $('#plan-name').html(_this.html());
            var plan_value = _this.attr('data-val');
            $('.plan-amount').html(parseFloat(plan_value).toFixed(2));
        });

        $('input[name="opt_coverage"]').on('ifChanged', function () {
            extra_options();
        });


        $(document).on('submit', '#update-diagnose', function (e) {
            e.preventDefault();
            var btn = $('.submit-diagnose').ladda();
            btn.ladda('start');
            var value = new FormData( $("#update-diagnose")[0] );
            $.ajax({
                url:admin_url+'claims/update_diagnose',
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
                            location.reload();
                        }, 2000);
                    }
                    else if(status.msg == 'error'){
                        btn.ladda('stop');
                        toastr.error(status.response, 'Error');
                    }
                }
            });
        });

        $(document).on('click', '.send-policy', function (e) {
            e.preventDefault();
            var value = $(this).attr('data-id');
            $.ajax({
                url: admin_url+'customers/send_policy_email/'+value,
                type: 'GET',
                dataType: 'json',
                success: function(res) {
                    console.log(res);
                }
            });
            var text = 'ePolicy sent successfully';
            toastr.success(text, 'Success');
            setTimeout(function () {
                location.reload();
            }, 2000);
        });


        $('#update-customer').submit(function (e) {
            e.preventDefault();
            var coverage = [];
            $('input[name="opt_coverage"]:checked').each(function() {
                coverage.push($(this).val());
            });
            var btn = $('.submit-customer').ladda();
            btn.ladda('start');
            var value = new FormData( $("#update-customer")[0] );
            value.append("coverage", coverage);

            $.ajax({
                url:admin_url+'customers/update',
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
                            // $(location).attr('href', admin_url+"customers");
                            location.reload();
                        }, 2000);
                    }
                    else if(status.msg == 'error'){
                        btn.ladda('stop');
                        toastr.error(status.response, 'Error');
                    }
                }
            });
        });


        $('.claim-view').on('click', function () {
            var _this = $(this);
            var claim = _this.attr('data-val');
            show_claim(claim, claim_customer_id);
            $("html, body").animate({ scrollTop:$("#claim-detail").offset().top},1000);
        });

        setTimeout(function () {
            if ($('#claim-detail').hasClass('claim_exist')){
                $("html, body").animate({ scrollTop:$("#claim-detail").offset().top},1000);
            }
        },1000);
    });

    $(document).on('click', '.update-status', function () {
        var btn = $('.update-status').ladda();
        btn.ladda('start');
        var status = $('.claim-status').val();
        var claim = $('.claim-status').attr('data-val');
        $.ajax({
            url:admin_url+'claims/update_status',
            type: 'POST',
            data: { claim : claim, status: status},
            dataType:'json',
            success:function(status){
                if(status.msg=='success'){
                    btn.ladda('stop');
                    toastr.success(status.response, 'Success');
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                }
                else if(status.msg == 'error'){
                    btn.ladda('stop');
                    toastr.error(status.response);
                }
            }
        });
    });

    $(document).on('click', '.c_satisfaction', function () {
        var btn = $('.c_satisfaction').ladda();
        btn.ladda('start');
        var status = $('.s_status').val();
        var claim = $('.s_status').attr('data-val');
        $.ajax({
            url:admin_url+'claims/update_satisfaction',
            type: 'POST',
            data: { claim : claim, status: status},
            dataType:'json',
            success:function(status){
                if(status.msg=='success'){
                    btn.ladda('stop');
                    toastr.success(status.response, 'Success');
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                }
                else if(status.msg == 'error'){
                    btn.ladda('stop');
                    toastr.error(status.response);
                }
            }
        });
    });

    $(document).on('click', '.add-task', function () {
        var btn = $('.add-task').ladda();
        btn.ladda('start');
        var text_validation = $($(".summernote").summernote("code")).text();
        var text = $(".summernote").summernote("code");
        var type = $('.task-type').val();
        var assign_to = 0;
        var customer = $(this).attr('data-val');
        var claim = $(this).attr('data-val-claim');
        if (type == 1) {
            assign_to = $('.task-person').val();
        }
        if (text_validation == '') {
            toastr.error('Please provide complete details');
            btn.ladda('stop');
        } else {
            $.ajax({
                url: admin_url + 'tasks/add',
                type: 'POST',
                data: {customer: customer, text: text, type: type, assign_to: assign_to, claim: claim},
                dataType: 'json',
                success: function (status) {
                    if (status.msg == 'success') {
                        btn.ladda('stop');
                        toastr.success(status.response, 'Success');
                        setTimeout(function () {
                            location.reload();
                        }, 2000);
                    } else if (status.msg == 'error') {
                        btn.ladda('stop');
                        toastr.error(status.response);
                    }
                }
            });
        }
    });

    $(document).on('click', '.assign-vendor', function () {
        var customer = $(this).attr('data-val');
        var claim = $(this).attr('data-id');
        $.ajax({
            url:admin_url+'claims/assign_vendor',
            type: 'POST',
            data: { customer : customer, claim: claim},
            dataType:'json',
            success:function(status){
                if(status.msg=='success'){
                    $('#vendor_body').html(status.response);
                    $('#vendor_modal').modal('show');
                }
                else if(status.msg == 'error'){
                    toastr.error(status.response);
                }
            }
        });
    });

    $(document).on('click', '.add-diagnosis', function () {
        var claim = $(this).attr('data-id');
        $.ajax({
            url:admin_url+'claims/open_diagnose',
            type: 'POST',
            data: {claim: claim},
            dataType:'json',
            success:function(status){
                if(status.msg=='success'){
                    $('#diagnose_body').html(status.response);
                    $('#diagnosis_modal').modal('show');
                }
                else if(status.msg == 'error'){
                    toastr.error(status.response);
                }
            }
        });
    });

    $(document).on('click', '.auth-claim', function () {
        var claim = $(this).attr('data-id');
        var type = $(this).attr('data-val');
        $('#enter_amount').val("");
        $.ajax({
            url:admin_url+'claims/check_authorize',
            type: 'POST',
            data: {claim: claim},
            dataType:'json',
            success:function(status){
                if(status.msg=='success'){
                    $('#claim-id').val(claim);
                    $('#claim-type').val(type);
                    $('#auth_head').html(auth_type(type));
                    $('#auth_modal').modal('show');
                }
                else if(status.msg == 'error'){
                    toastr.error(status.response);
                }
            }
        });
    });

    $("#auth-form").submit('click', function (e) {
        e.preventDefault();
        var btn = $('.save-auth').ladda();
        btn.ladda('start');
        var value = new FormData( $("#auth-form")[0] );

        $.ajax({
            url:admin_url+'claims/update_authorization',
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
                        location.reload();
                    }, 2000);
                }
                else if(status.msg == 'error'){
                    btn.ladda('stop');
                    toastr.error(status.response, 'Error');
                }
            }
        });
    });

    $(document).on('click', '.claim-assignment', function () {
        var claim = $(this).attr('data-id');
        var action = $(this).attr('data-val');
        var customer = $(this).attr('cus_id');

        if (action=="resend-swo"){
            var text = "You want to resend emails to customer and vendor!";
            var link = "resend_swo";
        } else if (action=="reimbursement") {
            var text = "You want to send email to customer!";
            var link = "reimbursement";
        }else if (action=="reassign-vendor"){
            var text = "You want to reassign vendor for this claim!";
            var link = "vendor_reassign";
        } else if (action=="recall"){
            var text = "You want to send emails to customer and vendor!";
            var link = "claim_recall";
        }

        swal({
                title: "Are you sure?",
                text: text,
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
                        url:admin_url+'claims/'+link,
                        type:'post',
                        data:{claim: claim, customer : customer},
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

    $(document).on('click', '.potential-refund', function () {
        var customer = $(this).attr('data-id');
        var action = $(this).attr('data-val');

        if (action==1){
            var text = "You want to send Past Due email to customer!";
        } else if (action==2) {
            var text = "You want to send confirmation email to customer!";
        }else if (action==3){
            var text = "You want to send TXT email to customer!";
        } else if (action==4){
            var text = "You want to send paid invoice email to customer!";
        }

        swal({
                title: "Are you sure?",
                text: text,
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
                    $.ajax({
                        url:admin_url+'claims/send_refund_mail',
                        type:'post',
                        data:{customer: customer, action: action},
                        dataType:'json',
                        success:function(status){
                            if(status.msg=='success'){
                                swal({title: "Success!", text: status.response, type: "success"});
                            } else if(status.msg=='error'){
                                swal("Error", status.response, "error");
                            }
                        }
                    });
                } else {
                    swal("Cancelled", "", "error");
                }
            });
    });

    $('#upload-related').submit(function (e) {
        e.preventDefault();
        var i = 0;
        var image = $('#related-image').val();
        if (image== ''){
            i++;
            toastr.error("Upload related image", 'Error');
        }else {
            var duplicate = $('#related-image').attr('replace');
            if (duplicate == 1){
                i++;
                toastr.error("File already exist with same name", 'Error');
            }
        }

        if (i==0){

            var btn = $('.save-related').ladda();
            btn.ladda('start');
            var value = new FormData( $("#upload-related")[0] );

            $.ajax({
                url:admin_url+'customers/claim_files',
                type:'post',
                data:value,
                dataType:'json',
                processData: false,
                contentType: false,
                success:function(status){
                    if(status.msg=='success'){
                        btn.ladda('stop');
                        toastr.success(status.response, 'Success');
                        claim_files();
                        $('#upload-related').trigger("reset");
                    }
                    else if(status.msg == 'error'){
                        btn.ladda('stop');
                        toastr.error(status.response, 'Error');
                    }
                }
            });
        }
        return false;

    });

    $(document).on('click', '.remove-related', function () {
        var _this = $(this);
        var id = _this.attr('data-id');
        swal({
                title: "Are you sure?",
                text: "You want to delete this File!",
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
                        url:admin_url+'customers/delete_claim_files',
                        type:'post',
                        data:{ id : id },
                        dataType:'json',
                        success:function(status){

                            if(status.msg=='success'){
                                btn.ladda('stop');
                                swal({title: "Success!", text: status.response, type: "success"},
                                    function(){
                                        claim_files();
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


    $(document).on('click', '.revoke-auth', function () {
        var claim = $(this).attr('data-id');
        $.ajax({
            url:admin_url+'claims/get_cliams_authorize',
            type: 'POST',
            data: {claim: claim},
            dataType:'json',
            success:function(status){
                if(status.msg=='success'){

                    console.log(status);

                    $('#revoke_auth_modal .modal-body').html(status.response);
                    $('#revoke_auth_modal').modal('show');
                    $('#revoke_table_ajax').DataTable({searching: false});


                }
                else if(status.msg == 'error'){
                    toastr.error(status.response);
                }
            }
        });
    });

    function show_claim(claim, claim_customer_id) {
        $.ajax({
            url:admin_url+'claims/claim_details',
            type: 'POST',
            data: { id : claim, claim_customer_id : claim_customer_id},
            dataType:'json',
            success:function(status){
                if(status.msg=='success'){
                    $('#claim-detail').html(status.response);
                    $('#claim-detail').addClass('claim_exist');
                }
                else if(status.msg == 'error'){
                    toastr.error(status.response);
                }
            }
        });
    }

    function auth_type(type) {
        var claim;
        switch (parseInt(type)) {
            case 0:
                claim = "Authorize Claim";
                break;
            case 1:
                claim = "Authorize Claim";
                break;
            case 2:
                claim = "Authorize Goodwill";
                break;
            case 3:
                claim = "Authorize Buyout";
                break;
            case 4:
                claim = "Authorize Reimbursement";
                break;
        }
        return claim;
    }
    function claim_files(){
        var customer_claim =   $('.customer_claim').val();
        $.ajax({
            url:admin_url+'customers/get_images',
            type: 'POST',
            data: { customer_claim : customer_claim},
            dataType:'json',
            success:function(status){
                if(status.msg=='success'){
                    $('#related-images').html(status.response);
                }
                else if(status.msg == 'error'){
                    toastr.error(status.response);
                }
            }
        });
    }


    function coverage() {
        var total=0;
        var year = $('.c_plan').val();
        var months = $('.c_month').val();
        var year_month = parseInt(year);
        var total_months = 12;
        if (months != ''){
            total_months = parseInt(year_month) + parseFloat(months / total_months);
        } else {
            total_months = parseInt(year_month);
        }
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
            var months = $('.c_month').val();
            var year_month = parseInt(year);
            var total_months = 12;
            if (months != ''){
                total_months = parseInt(year_month) + parseFloat(months / total_months);
            } else {
                total_months = parseInt(year_month);
            }

            var total_amount = parseFloat(value) * total_months;

            $('.extra-coverage').append("<tr>\n" +
                "<td>"+name+"</td>\n" +
                "<td><span>$"+(total_amount).toFixed(2)+"</span></td>\n" +
                "</tr>")
        });
    }

    function calculate_term() {
        var months = $('.c_month').val();
        var years = $('.c_plan').val();
        var years_month = parseInt(years);
        var total_months = 12;
        if (months != ''){
            var total_months = years_month + parseFloat(months / total_months);
        }else {
            var total_months = years_month;
        }
        var plan_start = $('#plan-start').val();
        var plan_end = new Date(plan_start);
        plan_end.setMonth(plan_end.getMonth() + total_months);
        var date = new Date(plan_end);
        var cur_month = date.getMonth()+1;
        var end_date = date.getFullYear() + '-' + cur_month + '-' + date.getDate();
        $('#plan-end').val(end_date);
    }


    $('.change_plan').on('click', function () {
        $('.show_plan').removeClass('hide');
        $('.hide_change_plan').removeClass('hide');
        $('.change_plan').addClass('hide');
        $('.plan_name').addClass('hide');
        // $('#plan-end').attr('disabled',false);
        $('#plan-start').attr('disabled',false);
    });

    $('.hide_change_plan').on('click', function () {
        $('.change_plan').removeClass('hide');
        $('.plan_name').removeClass('hide');
        $('.show_plan').addClass('hide');
        $('.hide_change_plan').addClass('hide');
        $('#plan-start').attr('disabled',true);
        $('#plan-end').attr('disabled',true);
    });

    $('.btn_initial_payment').on('click', function () {
        $('.show_initial_payment').removeClass('hide');
        $('.span_initial_payment').addClass('hide');
    });

    $('.btn_net_total').on('click', function () {
        $('.show_net_total').removeClass('hide');
        $('.span_net_total').addClass('hide');
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {

        $(document).on('click', '.remove_auth', function () {
            var _this = $(this);
            var claim = _this.attr('data-id');
            swal({
                    title: "Are you sure?",
                    text: "You want to delete this Authorization!",
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
                            url:admin_url+'claims/remove_cliams_authorize',
                            type: 'POST',
                            data: {claim: claim},
                            dataType:'json',
                            success:function(status){
                                if(status.msg=='success'){
                                    btn.ladda('stop');
                                    $('#claim_'+claim).remove();
                                    swal({title: "Success!", text: status.response, type: "success"});
                                }
                                else if(status.msg=='error'){
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
    });
</script>

<script type="text/javascript">
    $(document).ready(function () {

        $(document).on('click', '.update-payment', function (e) {
            e.preventDefault();
            var data = $(".payment_update").serialize();
            var btn = $('.update-payment').ladda();
            btn.ladda('start');
            $.ajax({
                url:admin_url+'customers/update_payment_info',
                type: 'POST',
                data:  data,
                dataType:'json',
                success:function(status){
                    if(status.msg=='success'){
                        btn.ladda('stop');
                        toastr.success(status.response, 'Success');
                        setTimeout(function () {
                            location.reload();
                        }, 2000);
                    }
                    else if(status.msg == 'error'){
                        btn.ladda('stop');
                        toastr.error(status.response);
                    }

                }
            });
        });
    });
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


    $(document).on('click', '.add_task', function () {
        $(".summer_note").summernote("reset");
    });


    $(document).on('click', '.save_task', function () {
        var btn = $('.save_task').ladda();
        btn.ladda('start');
        var text_validation = $($(".summer_note").summernote("code")).text();
        var text = $(".summer_note").summernote("code");
        var customer = $(this).attr('data-val');
        var type = $('.task_type').val();
        var assign_to = 0;
        if (type == 1) {
            assign_to = $('.task_person').val();
        }

        if (text_validation == '') {
            toastr.error('Please provide complete details');
            btn.ladda('stop');
        } else {
            $.ajax({
                url: admin_url + 'tasks/add_notes',
                type: 'POST',
                data: {customer: customer, text: text, type: type, assign_to: assign_to},
                dataType: 'json',
                success: function (status) {
                    if (status.msg == 'success') {
                        btn.ladda('stop');
                        toastr.success(status.response, 'Success');
                        location.reload();
                    } else if (status.msg == 'error') {
                        btn.ladda('stop');
                        toastr.error(status.response);
                    }
                }
            });
        }
    });



    $(document).ready(function(){
        $('.summer_note').summernote({
            toolbar: [
                ['font', ['bold']]
            ],
        });

        $('.task_type').on('change', function () {
            var _this = $(this);
            var value = _this.val();
            if (value==1){
                $('.task_person').removeClass('hide');
            } else {
                $('.task_person').addClass('hide');
            }
        });
    });

    $(document).on('change','.task-status', function () {
       var _this = $(this);
        var status = _this.val();
        var id = _this.attr('data-id');
            $.ajax({
                url:admin_url+'tasks/update_task',
                type: 'POST',
                data: { status: status, id: id},
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
    });
	$('.card_num').on('keyup keypress blur click', function(e) {
		if(e.keyCode == 32)
		return false;
		this.value = this.value.replace(/[^0-9+\.]/g,''); 
	});
</script>
</body>
</html>
