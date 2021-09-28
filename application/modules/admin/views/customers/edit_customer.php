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
                                                                <input type="text" class="form-control" name="c_home_phn" value="<?php echo $details['home_phone']; ?>" >
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Work Phone</label>
                                                                <input type="text" class="form-control" name="c_work_phn" value="<?php echo $details['work_phone']; ?>" >
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
                                                                <input type="text" placeholder="Phone" class="form-control" value="<?php echo $details['p_phone']; ?>" name="p_phn">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Work Phone</label>
                                                                <input type="text" class="form-control p_work_phn" value="<?php echo $details['p_work_phone']; ?>" name="p_work_phn" >
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
                                                $latest_policy = get_customer_policy($details['policy_num']); ?>
                                                
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
                                                                <input type="text" class="form-control" value="<?php echo $details['zip_code']; ?>" name="c_zip">
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
                                                                <input type="text" class="form-control" value="<?php echo $details['bill_zipcode']; ?>" name="b_zip">
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
                                                                <input type="text" class="form-control" value="<?php echo $details['mail_zipcode']; ?>" name="m_zip">
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
                                                        <?php //if ($latest_policy['status'] == '6' || db_date($latest_policy['plan_end']) <= date('Y-m-d')) { ?>
                                                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="txt text-xl-right">
                                                                    <a href="<?php echo admin_url(); ?>customers/add/<?php echo $details['id'];?>" class="btn btn-primary btn-sm my-2 my-xl-0 customer-btn"><strong>Renew Plan</strong></a>
                                                                </div>
                                                            </div>
                                                        <?php //} ?>
                                                    </div>
                                                    <div class="hr-line-dashed"></div>


                                                    <div class="row hide show_plan">
														<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
                                                            <label>Plan</label>
                                                            <select class="form-control c_plan" name="c_plan">
                                                                <option value="1" <?php if ($latest_policy['plan_year']==1){ ?> selected <?php } ?>>1 Year</option>
                                                                <option value="2" <?php if ($latest_policy['plan_year']==2){ ?> selected <?php } ?>>2 Year</option>
                                                                <option value="3" <?php if ($latest_policy['plan_year']==3){ ?> selected <?php } ?>>3 Year</option>
                                                                <option value="4" <?php if ($latest_policy['plan_year']==4){ ?> selected <?php } ?>>4 Year</option>
                                                                <option value="5" <?php if ($latest_policy['plan_year']==5){ ?> selected <?php } ?>>5 Year</option>
                                                            </select>
                                                        </div>
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
                                                                    <input type="text" value="<?php echo $latest_policy['free_scf']; ?>" class="form-control free_scf" name="free_scf" min="1" max="2" maxlength = "1">
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
																		<?php $policyies = get_customer_policies($details['policy_num']); 
																		$policycount = count($policyies);
                                                                        $start = '';
                                                                        $diff = 0;
																		if($policycount > 1){
																			$oldend = strtotime($policyies[$policycount-1]['plan_end']);
																			$newstart = strtotime($policyies[0]['plan_start']);

																			$datediff = $newstart - $oldend;

																			$diff =  round($datediff / (60 * 60 * 24));
																	    }
                                                                        
                                                                        if($diff != 0){
                                                                            $start =  $policyies[$policycount-1]['plan_start'];
                                                                        }else{
                                                                            $start =  $policyies[0]['plan_start'];
                                                                        } 
                                                                        
																		?>
                                                                        <input type="text" id="plan-start" required="true" class="form-control-sm form-control" value="<?php echo date('Y-m-d', strtotime($start)); ?>" name="start" disabled="true" />
                                                                        <input type="hidden" name="plan_start" value="<?php echo date('Y-m-d', strtotime($start)); ?>">
                                                                        <span class="input-group-addon">to</span>
                                                                        <input type="text" id="plan-end" class="form-control-sm form-control" value="<?php echo date('Y-m-d', strtotime($policyies[0]['plan_end'])); ?>" name="end" required="true" disabled="true" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php if (get_session('admin_type') == 1 || (get_session('admin_type') == 2 && get_session('admin_permissions')['miscellaneous'] != 'N/A' && isset(get_session('admin_permissions')['miscellaneous']->status))) { ?>
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
                                                    <?php } ?>
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
                                                                            $<i class="plan-total"><?php echo $latest_policy['plan_initial']; ?></i>
                                                                        <?php }else{ ?>
                                                                            $<i class="plan-total"><?php echo $latest_policy['plan_initial']; ?></i>
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
                                                                <input type="text" name="plan_total" value="<?php echo $latest_policy['plan_initial']; ?>" class="form-control input-sm">
                                                            <?php }else{ ?>
                                                                <input type="text" name="plan_total" value="<?php echo $latest_policy['plan_initial']; ?>" class="form-control input-sm">
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
                                                            <strong><span id="net-payment">$<?php echo $latest_policy['net_total']; ?></span>
                                                                <span class="edit_price"><a href="javascript:void(0);"class="btn_net_total">edit</a></span>
                                                            </strong>

                                                        </div>
                                                    </div>
                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12 hide show_net_total">
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text input-sm" id="basic-addon1">$</span>
                                                            </div>
                                                            <input type="text" name="net_total" value="<?php echo $latest_policy['net_total']; ?>" class="form-control input-sm">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="hr-line-dashed"></div>
                                                <div class="form_section">

                                                    <div class="row hide">
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
//                                                                            if ($months != ''){
//                                                                                $total_months = $year_months + ($months / 12);
//                                                                            }else{
                                                                            $total_months = $year_months;
//                                                                            }
                                                                            if($selected[0]['meta_content'] == 'Other'){
                                                                                $other_coverage = explode(',',$cov_id['comments']);
                                                                            }              

                                                                            if($selected[0]['meta_content'] == 'Other'){
                                                                                foreach($other_coverage as $o){
                                                                                    ?>
                                                                                    <tr>
                                                                                        <td><?php echo $o; ?></td>
                                                                                        <td><span>--</span></td>
                                                                                    </tr>
                                                                                    <?php 
                                                                                 }
                                                                            } 
                                                                            else{ ?>
                                                                                <tr>
                                                                                    <td><?php echo $selected[0]['meta_content']; ?></td>
                                                                                    <td><span><?php echo '$'.number_format((float)$selected[0]['meta_value']*$total_months, 2, '.', ''); ?></span></td>
                                                                                </tr>
                                                                            <?php 
                                                                            }
                                                                        } ?>
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
                                                                        <a href="<?php echo admin_url().'customers/edit/'.$account['id']; ?>" target="_blank"><?php echo $account['first_name'].' '.$account['last_name']; ?></a>
                                                                    <?php } ?>
                                                                </div>
                                                            <?php } ?>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6 col-sm-6">
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
                                                        <div class="col-md-6 col-sm-6">
                                                            <div class="field">
                                                                <div class="form-group m-0">
                                                                    <label>Lead Source</label>
                                                                    <select class="form-control" name="lead_source">
                                                                        <option value="">Select leadsource</option>
                                                                        <?php foreach (get_leadsource() as $leadsource){ ?>
                                                                            <option value="<?php echo $leadsource['id']; ?>" <?php if ($details['leadsource']==$leadsource['id']){ ?> selected <?php } ?>><?php echo $leadsource['name']; ?></option>
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
                                <?php if (get_session('admin_type') == 1 || (get_session('admin_type') == 2 && get_session('admin_permissions')['miscellaneous'] != 'N/A' && isset(get_session('admin_permissions')['miscellaneous']->charge_card))) { ?>
                                <li><a class="nav-link" data-toggle="tab" href="#tab-2">Billing</a></li>
                                <?php } ?>
                                <li><a class="nav-link" data-toggle="tab" href="#tab10">Orders</a></li>
                                <li><a class="nav-link claim-tab" data-toggle="tab" href="#tab-3">Claims</a></li>
                                <li><a class="nav-link" data-toggle="tab" href="#tab-5">Files</a></li>
                                <li><a class="nav-link" data-toggle="tab" href="#tab-6">PDF ePolicy</a></li>
                                <li><a class="nav-link" data-toggle="tab" href="#tab-7">Letters</a></li>
                                <?php if (get_session('admin_type') == 1 || (get_session('admin_type') == 2 && get_session('admin_permissions')['miscellaneous'] != 'N/A' && isset(get_session('admin_permissions')['miscellaneous']->add_coverage))) { ?>
                                    <li><a class="nav-link" data-toggle="tab" href="#tab-8">Coverage</a></li>
                                <?php } ?>
                                <?php if (get_session('admin_type') == 1 || (get_session('admin_type') == 2 && get_session('admin_permissions')['miscellaneous'] != 'N/A' && isset(get_session('admin_permissions')['miscellaneous']->status))) { ?>
                                    <li><a class="nav-link" data-toggle="tab" href="#tab-9">Status</a></li>
                                <?php } ?>
								<li><a class="nav-link" data-toggle="tab" href="#tab11">Password Reset</a></li>
								<li><a class="nav-link" data-toggle="tab" href="#tab12">Logs</a></li>
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
                                                    <div class="feed-element p-2" <?php if ($note['type'] == 1 && $note['status'] == 1){ ?> style="background-color: #b7f6b7" <?php } ?>>
                                                        <div class="media-body">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <p class="m-0">
                                                                        <strong>Note Added</strong>
                                                                        <span class="text-muted"> <?php echo date('d.M.Y - h:i a', strtotime($note['created_at'])); ?> </span> <?php if ($note['type'] == 1){ ?>  |
                                                                            <strong>Tasked To</strong>
                                                                            <span><?php $salesperson = get_staff_name($note['assign_to']); echo $salesperson['FirstName'].' '.$salesperson['LastName']; ?></span>
                                                                        <?php } ?>
                                                                    </p>
                                                                    <p class="m-0">
                                                                        <strong>Description: </strong><span><?php echo $note['details']; ?></span>
                                                                    </p>
                                                                </div>
                                                                <div class="col-md-6 text-right">
                                                                    <p>
                                                                        <strong>Added By:</strong> &nbsp;
                                                                        <span><?php 
                                                                            // echo "==>". $note['assign_by'];
                                                                            if($note['assign_by']==''){
                                                                                echo "System";
                                                                            }   
                                                                            else{         
                                                                                $salesperson = get_staff_name($note['assign_by']); 
                                                                                echo $salesperson['FirstName'].' '.$salesperson['LastName']; 
                                                                            }
                                                                            ?></span>
                                                                    </p>
                                                                    <p>
                                                                        <span>
                                                                            <?php if ($note['type'] == 1){ ?>
                                                                                <?php if (get_session('admin_type') == 1 || (get_session('admin_type') == 2 && get_session('admin_permissions')['miscellaneous'] != 'N/A' && isset(get_session('admin_permissions')['miscellaneous']->forward_task))) { ?>
                                                                                    <select class="form-control task-status ml-auto" data-id="<?php echo $note['id'] ?>" data-type="main" style="width: 130px" name="task_status">
                                                                                    <option value="1" <?php if ($note['status']==1){ ?> selected <?php } ?>>New</option>
                                                                                    <option value="2" <?php if ($note['status']==2){ ?> selected <?php } ?>>Closed</option>
                                                                                </select>
                                                                                <?php } } ?>
                                                                        </span>
                                                                    </p>
                                                                    <?php if ($note['type'] == 1 && $note['status'] == 2 && $note['close_date'] != ''){ ?>
                                                                        <p>
                                                                            <strong>Closed at:</strong>
                                                                            <span>
                                                                            <?php echo date('d.M.Y - h:i a', strtotime($note['close_date'])); ?>
                                                                        </span>
                                                                        </p>
                                                                    <?php } ?>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <?php if (get_session('admin_type') == 1 || (get_session('admin_type') == 2 && get_session('admin_permissions')['miscellaneous'] != 'N/A' && isset(get_session('admin_permissions')['miscellaneous']->charge_card))) { ?>
                                <div role="tabpanel" id="tab-2" class="tab-pane">
                                    <div class="panel-body">
                                        <div class="form_section">
                                            
                                                <form class="charge_customer">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <h2 class="mb-4 mt-0">Payment Method</h2>
                                                        </div>
                                                        <div class="col-6 text-right"></div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <h4 class="mb-4">Charge Customer</h4>
                                                        </div>
                                                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Amount to charge</label>
                                                                <input type="text" class="form-control" name="amount_to_charge">
                                                                <input type="hidden" name="customer_id" value="<?php echo $details['id'] ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                            <a href="#" class="btn btn-primary charge-payment">Charge Now</a>
                                                        </div>
                                                    </div>
                                                </form>
                                                <div class="hr-line-dashed"></div>
                                            
                                            <form class="policy_charge">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="col-6 float-left arb-section">
                                                            <h4 class="mb-4">Credit/Debit Card ARB</h4>
                                                        </div>
                                                        <div class="col-6 float-left">
														<?php $arb = getARBProfile($details['id']) ;
																if(!empty($arb) && is_numeric($arb[0]['subscription_id']) && $arb[0]['subscription_id']!=0){
														?>
															<a href=" javascript:void(0) " data-id="<?php echo $details['id']; ?>" data-value="<?= $arb[0]['subscription_id'] ?>" class="btn btn-primary float-right cancelSubscription"><i class="fa fa-refresh"></i> Cancel Subscription</a>
														<?php } ?>
                                                            <a href="#" class="btn btn-primary float-right update-date"><i class="fa fa-refresh"></i> Update ARB profile</a>
                                                        </div>
                                                    </div>
													 <input type="hidden" value="<?php echo $details['id']; ?>" name="customer_id">
                                                    <?php if ($latest_policy['charge_round'] == 0 && $latest_policy['charge_update'] == 0){ ?>
                                                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Next bill date</label>
                                                                <input type="text" class="form-control" id="next_bill_date" placehoder="Bill Date" name="bill_date">
                                                                <input type="hidden" name="policy_id" value="<?php echo $latest_policy['id'] ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Payment</label>
                                                                <input type="text" class="form-control" name="charge_payment">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Number of charges</label>
                                                                <input type="text" class="form-control" name="amount_to_charge">
                                                            </div>
                                                        </div>
                                                    <?php }else{ ?>
                                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label>Next bill date</label>
                                                            <input type="text" class="form-control" id="next_bill_date" placehoder="Bill Date" name="bill_date" value="<?php if (!empty($latest_policy['next_bill_date'])){ echo $latest_policy['next_bill_date']; } ?>">
                                                            <input type="hidden" name="policy_id" value="<?php echo $latest_policy['id'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label>Payment</label>
                                                                <input type="text" class="form-control" name="charge_payment" value="<?php if ($latest_policy['charge_update'] == 0){ echo $latest_policy['plan_total']; }else{ echo $latest_policy['next_payment']; } ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label>Number of charges</label>
                                                            <input type="text" class="form-control" name="amount_to_charge" value="<?php echo $latest_policy['charge_round']; ?>">
                                                        </div>
                                                    </div>
                                                    <?php } ?>
                                                </div>
                                            </form>
                                            <div class="hr-line-dashed"></div>
                                            <?php $payment_details = get_customer_card($details['id'],'',1); ?>
                                            <form class="payment_update">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <h4 class="mb-4">Credit Card</h4>
                                                    </div>
                                                    <div class="col-6 text-right">
															<input type="checkbox"  name="arb_profile" id="arb_profile">
															<label for="arb_profile">Update ARB profile also</label>
															 <a href="#" class="btn btn-primary mt-2 update-payment"><i class="fa fa-refresh"></i>Update</a>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label>Card Number</label>
                                                            <input type="text" placeholder="" value="<?php echo maskCard($payment_details['card_num']); ?>" minlength="13"  maxlength="16" class="form-control card_num_show" name="card_num_show">
                                                            <input type="hidden" class="card_num" value="<?php echo $payment_details['card_num']; ?>" name="card_num">
                                                            <input type="hidden" value="<?php echo $payment_details['id']; ?>" name="card_id">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label>CVV</label>
                                                            <input type="text" placeholder="" value="<?php echo $payment_details['card_pin']; ?>" class="form-control" name="card_pin">
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                                        <label>Exp Month</label>
                                                        <select class="form-control" name="card_month">
                                                            <option value="1" <?php if ($payment_details['card_exp_month']==1){ ?> selected <?php } ?>>1</option>
                                                            <option value="2" <?php if ($payment_details['card_exp_month']==2){ ?> selected <?php } ?>>2</option>
                                                            <option value="3" <?php if ($payment_details['card_exp_month']==3){ ?> selected <?php } ?>>3</option>
                                                            <option value="4" <?php if ($payment_details['card_exp_month']==4){ ?> selected <?php } ?>>4</option>
                                                            <option value="5" <?php if ($payment_details['card_exp_month']==5){ ?> selected <?php } ?>>5</option>
                                                            <option value="6" <?php if ($payment_details['card_exp_month']==6){ ?> selected <?php } ?>>6</option>
                                                            <option value="7" <?php if ($payment_details['card_exp_month']==7){ ?> selected <?php } ?>>7</option>
                                                            <option value="8" <?php if ($payment_details['card_exp_month']==8){ ?> selected <?php } ?>>8</option>
                                                            <option value="9" <?php if ($payment_details['card_exp_month']==9){ ?> selected <?php } ?>>9</option>
                                                            <option value="10" <?php if ($payment_details['card_exp_month']==10){ ?> selected <?php } ?>>10</option>
                                                            <option value="11" <?php if ($payment_details['card_exp_month']==11){ ?> selected <?php } ?>>11</option>
                                                            <option value="12" <?php if ($payment_details['card_exp_month']==12){ ?> selected <?php } ?>>12</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                                        <div class="form-group">
                                                            <label>Year</label>
                                                            <select class="form-control card-year" name="card_year">
                                                                <?php $cur_year = date("Y");
                                                                for ($x = $cur_year; $x <= $cur_year+10; $x++){ ?>
                                                                    <option value="<?php echo $x; ?>" <?php if ($payment_details['card_exp_year']==$x){ ?> selected <?php } ?>><?php echo $x; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="hidden" value="<?php echo $details['id']; ?>" name="customer_id">
                                            </form>
                                            <div class="hr-line-dashed"></div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <h4 class="mb-4">Other Cards</h4>
                                                </div>
                                            </div>
                                            <div class="ibox-content">
                                                <div class="table-responsive">
                                                    <table id="cards_table" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                                                        <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Card Number</th>
                                                            <th>CVV</th>
                                                            <th>Exp Month</th>
                                                            <th>Year</th>
                                                            <th>Status</th>
                                                            <th>Created at</th>
                                                            <th>Action</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $serial = 1 ;?>
                                                        <?php foreach (get_all_cards($details['id'],0) as $value) { ?>
                                                            <tr class="gradeX">
                                                                <td> <?php echo $serial; ?></td>
                                                                <td>
                                                                    <?php   $card = $value['card_num'];
												  if(strlen($card) > 2){
																		echo maskCard($card);
												  }else{
													  echo $card;
												  }
													
                                                 ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo $value['card_pin']; ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo $value['card_exp_month']; ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo $value['card_exp_year']; ?>
                                                                </td>
                                                                <td>
                                                                    <?php if ($value['status'] == 1){
                                                                        echo 'Active';
                                                                    }elseif ($value['status'] == 0){
                                                                        echo 'InActive';
                                                                    } ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo date('F jS, Y' ,strtotime($value['created_at'])); ?>
                                                                </td>
                                                                <td>
                                                                    <select class="form-control card_change" name="customer_card" data-id="<?php echo $value['customer_id']; ?>" data-val="<?php echo $value['id']; ?>">
                                                                        <option value="1" <?php if ($value['status'] == 1) { ?>
                                                                            selected
                                                                        <?php } ?>>Active</option>
                                                                        <option value="0" <?php if ($value['status'] == 0) { ?>
                                                                            selected
                                                                        <?php } ?>>InActive</option>
                                                                    </select>
                                                                </td>
                                                            </tr>

                                                            <?php  $serial++; } ?>

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="hr-line-dashed"></div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <h4 class="mb-4">Transactions</h4>
                                                </div>
                                            </div>
                                            <div class="ibox-content">
                                                <div class="table-responsive">
                                                    <table id="transaction_table" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                                                        <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Charge Date</th>
                                                            <th>REP</th>
															 <th>Payment Mode</th>
                                                            <th>Transaction ID</th>
                                                            <th>Card #</th>
                                                            <th>Amount</th>
                                                            <th>Response</th>
                                                            <th>Type</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $serial = 1 ;?>
                                                        <?php foreach (get_customer_payments($details['id'],0) as $payment) { ?>
                                                            <tr class="gradeX">
                                                                <td> <?php echo $serial; ?></td>
                                                                <td>
                                                                    <?php echo date('F jS, Y - h:i a' ,strtotime($payment['created_at'])); ?>
                                                                </td>
                                                                <td>
                                                                    <?php if ($payment['rep'] == 0){ ?>
                                                                        System
                                                                    <?php }else{
                                                                        $staff = get_staff_name($payment['rep']);
                                                                        if (!empty($staff)){
                                                                            echo $staff['FirstName'].' '.$staff['LastName'];
                                                                        }
                                                                    } ?>
                                                                </td>
																 <td>
                                                                    <?php echo $payment['payment_mode']; ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo $payment['transaction_id']; ?>
                                                                </td>
                                                                <td>
                                                                     <?php if (!empty($payment['card_id'])){
                                                                        $payment_card = get_customer_card($details['id'], array('id'=>$payment['card_id']));
                                                                        $variable = $payment_card['card_num'];
												  if(strlen($variable) > 8){
													echo maskCard($variable);
                                                
																	 } } ?>
                                                                </td>
                                                                <td>
                                                                    <?php
                                                                    if (empty($payment['amount_approved'])){
                                                                        echo $payment['amount_approved'];
                                                                    }else{
                                                                        echo '$'.$payment['amount_approved'];
                                                                    } ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo $payment['message']; ?>
                                                                </td>
                                                                <td>
                                                                    <?php if ($payment['type'] == 1){ ?>
                                                                        Payment
                                                                    <?php }elseif ($payment['type'] == 2){ ?>
                                                                        Refund
                                                                    <?php }elseif ($payment['type'] == 3){ ?>
                                                                        Void
                                                                    <?php } ?>
                                                                </td>
                                                                <td>
                                                                    <?php if($payment['status'] == 1){
                                                                        $label_class = 'primary';
                                                                        $label = 'Approved';
                                                                    }elseif($payment['status'] == 2){
                                                                        $label_class = 'warning';
                                                                        $label = 'Declined';
                                                                    }elseif ($payment['status'] == 3){
                                                                        $label_class = 'danger';
                                                                        $label = 'Error';
                                                                    }elseif ($payment['status'] == 4){
                                                                        $label_class = 'warning';
                                                                        $label = 'Declined';
                                                                    } ?>
                                                                    <span class="label label-<?php echo $label_class; ?>"><?php echo $label; ?></span>
                                                                </td>
                                                                <td>
                                                                    <section class="progress-demo">
                                                                        <?php if ($payment['type'] == 1 && $payment['status'] == 1){ ?>
                                                                            <button class="ladda-button btn btn-primary refund_payment" data-type="<?php echo $payment['payment_mode']; ?>"data-id="<?php echo $payment['id']; ?>"> Refund</button>
                                                                            <button class="ladda-button btn btn-primary void_payment" data-type="<?php echo $payment['payment_mode']; ?>" data-style="expand-right" data-id="<?php echo $payment['id']; ?>"> Void</button>
                                                                        <?php } ?>
                                                                    </section>
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
                                <?php } ?>
                                <div role="tabpanel" id="tab-3" class="tab-pane">
                                    <div class="panel-body">
                                        <div class="feed-activity-list">
                                            <div class="feed-element p-0 mb-3">
                                                <?php if (get_session('admin_type') == 2 && get_session('admin_permissions')['claims'] != 'N/A' && get_session('admin_permissions')['claims']['add'] == 1){ ?>
                                                    <a href="<?php echo admin_url(); ?>claims/add/<?php echo $details['id'];?>" class="btn btn-primary mb-2 "><i class="fa fa-plus"></i> Add Claim</a>
                                                <?php }elseif (get_session('admin_type') == 1){ ?>
                                                    <a href="<?php echo admin_url(); ?>claims/add/<?php echo $details['id'];?>" class="btn btn-primary mb-2 "><i class="fa fa-plus"></i> Add Claim</a>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="feed-activity-list">
                                            <?php if (get_session('admin_type') == 1 || (get_session('admin_type') == 2 && get_session('admin_permissions')['miscellaneous'] != 'N/A' && isset(get_session('admin_permissions')['miscellaneous']->customer_claims))) {
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
                                                                    <?php if (get_session('admin_type') == 1 || (get_session('admin_type') == 2 && get_session('admin_permissions')['miscellaneous'] != 'N/A' && isset(get_session('admin_permissions')['miscellaneous']->status))) { ?>
                                                                        <strong>Claim Status </strong><span><?php echo claim_status($data['status']); ?></span>  |
                                                                    <?php } ?>
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
                                                    <?php } } } ?>
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
                                <?php if (get_session('admin_type') == 1 || (get_session('admin_type') == 2 && get_session('admin_permissions')['miscellaneous'] != 'N/A' && isset(get_session('admin_permissions')['miscellaneous']->add_coverage))) { ?>
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
                                                                    <input type="checkbox" class="opt-coverage" value="<?php echo $coverage['meta_key']; ?>" 
                                                                        <?php if($coverage['meta_key'] == '25')
                                                                            {
                                                                                echo 'id = "id_other_coverage"';
                                                                            } ?>

                                                                        <?php foreach (get_coverage($details['id'], $latest_policy['id']) as $cov_id){ 
                                                                            if ($coverage['meta_key']==$cov_id['coverage']){ 
                                                                                if($coverage['meta_content']=='Other')
                                                                                {
                                                                                    $other_selected = 1;
                                                                                    $other_coverage_value = $cov_id['comments'];
                                                                                }
                                                                                ?> checked <?php } 
                                                                        } ?> 
                                                                        data-val="<?php echo $coverage['meta_value']; ?>" 
                                                                        data-id="<?php echo $coverage['meta_content']; ?>" name="opt_coverage">
                                                                        <span><?php echo $coverage['meta_content']; ?></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php } ?>
                                                    </div>                        
                                                <?php 
                                                $other_checkbox_display = 'none';
                                                if(isset($other_selected) && $other_selected=='1'){ 
                                                    $other_checkbox_display = 'block';
                                                }?>
                                                <div class="row" id="other_coverage_text" style="display:<?php echo $other_checkbox_display; ?>">
                                                    <div class="col-sm-5">
                                                        <input type="text" class="form-control" name="other_coverage" id="other_coverage" placeholder="Other Coverage" maxlength="500" required="true" value="<?php echo  isset($other_coverage_value)?$other_coverage_value:'' ?>">
                                                    </div>                               
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                <?php if (get_session('admin_type') == 1 || (get_session('admin_type') == 2 && get_session('admin_permissions')['miscellaneous'] != 'N/A' && isset(get_session('admin_permissions')['miscellaneous']->status))) { ?>
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
                                <?php } ?>
								
                                <div role="tabpanel" id="tab10" class="tab-pane">
                                    <div class="panel-body">
                                        <div class="row">
                                                <div class="col-6">
                                                    <h4 class="mb-4">Transactions</h4>
                                                </div>
                                            </div>
                                            <div class="ibox-content">
                                                <div class="table-responsive">
                                                    <table id="transaction_table" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                                                        <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Plan Year</th>
                                                            <th>Plan Initial</th>
															<th>Plan Total</th>
                                                            <th>Plan Start</th>
                                                            <th>Plan End</th>
                                                            <th>Is Expired</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $serial = 1 ;
														$plan_start = $plan_end =$status ='';
														?>
                                                        <?php foreach (get_customer_policies($details['policy_num']) as $payment) { ?>
                                                            <tr class="gradeX">
                                                                <td> <?php echo $serial; ?></td>
                                                                <td>
																	<?php 
                                                                        echo $payment['plan_year'];
                                                                    ?>
                                                                </td>
                                                                <td>
                                                                    <?php 
                                                                        echo $payment['plan_initial'];
                                                                    ?>
                                                                </td>
																 <td>
                                                                    <?php echo $payment['plan_total']; ?>
                                                                </td>
                                                                <td>
                                                                    <?php echo $payment['plan_start']; ?>
                                                                </td>
                                                                <td>
                                                                     <?php echo $payment['plan_end']; ?>
                                                                </td>
															<?php 	$curdate=time();
																$plan_start=strtotime($payment['plan_start']);
																$plan_end=strtotime($payment['plan_end']);

																if(($plan_start < $curdate) &&  ($curdate < $plan_end))
																{
																   $status = 'Current';
																}else{
																	$status = 'New';
																} ?>
																<td>
																	<?php $sstatus = array('1'=>'New','2'=>'Active','3'=>'Inactive','4'=> 'Past Due','5'=> 'Cancelled','6'=> 'Expired'	);
                                                                    echo $status; ?>
                                                                </td>
                                                            </tr>
                                                            <?php  $serial++; } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                       
                                    </div>
                                </div>
								<div role="tabpanel" id="tab11" class="tab-pane">
                                    <div class="panel-body">
												<div class="row">
													<div class="col-12">
														<h4 class="mb-4">Reset Customer Password</h4>
													</div>
										</div>
											<div class="form_section">
												<form role="form" id="change_password_form" >
												<div class="row">
													<div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-12">
														<div class="form-group">
															<label>New Password</label>
															<input type="password" class="form-control" name="new_password" id="new_password">
															
														</div>
													</div>
													<div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-xs-12">
														<div class="form-group">
															<label>Conifrm New Password</label>
															<input type="password" class="form-control" name="c_password">
															<input type="hidden" name="customer_id" value="<?php echo $details['id'] ?>">
														</div>
													</div>
													<div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
														<div class="form-group">
															<label></label>
														<button type="button" id="submit" class="btn btn-primary btn-login block full-width m-b">Change</button>
													</div>
												</div>
												</div>
											</form>
											<div class="hr-line-dashed"></div>
										</div>
									</div>
								</div>
								<div role="tabpanel" id="tab12" class="tab-pane">
                                    <div class="panel-body">
                                        <div class="feed-activity-list">
											<div class="form_section">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <h2 class="mb-4 mt-0">Logs</h2>
                                                    </div>                                                    
                                                </div>
                                            </div>
                                            <?php
                                            $notes = get_notes_type($details['id'],'');
                                            if (empty($notes)){
                                                echo 'No Records Found';
                                            }else{ ?>
                                                <?php foreach ($notes as $note){ ?>
                                                    <div class="feed-element p-2" <?php if ($note['type'] == 1 && $note['status'] == 1){ ?> style="background-color: #b7f6b7" <?php } ?>>
                                                        <div class="media-body">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <p class="m-0">
                                                                        <strong>Note Added</strong>
                                                                        <span class="text-muted"> <?php echo date('d.M.Y - h:i a', strtotime($note['created_at'])); ?> </span> <?php if ($note['type'] == 1){ ?>  |
                                                                            <strong>Tasked To</strong>
                                                                            <span><?php $salesperson = get_staff_name($note['assign_to']);
																			if($salesperson['FirstName']!="") { echo $salesperson['FirstName'].' '.$salesperson['LastName']; }else{ echo "System";} ?></span>
                                                                        <?php } ?>
                                                                    </p>
                                                                    <p class="m-0">
                                                                        <strong>Description: </strong><span><?php echo $note['details']; ?></span>
                                                                    </p>
                                                                </div>
                                                                <div class="col-md-6 text-right">
                                                                    <p>
                                                                        <strong>Added By:</strong> &nbsp;
                                                                        <span><?php $salesperson = get_staff_name($note['assign_by']); if($salesperson['FirstName']!="") { echo $salesperson['FirstName'].' '.$salesperson['LastName']; }else{ echo "System";} ?></span>
                                                                    </p>
                                                                    <p>
                                                                        <span>
                                                                            <?php if ($note['type'] == 1){ ?>
                                                                                <?php if (get_session('admin_type') == 1 || (get_session('admin_type') == 2 && get_session('admin_permissions')['miscellaneous'] != 'N/A' && isset(get_session('admin_permissions')['miscellaneous']->forward_task))) { ?>
                                                                                    <select class="form-control task-status ml-auto" data-id="<?php echo $note['id'] ?>" data-type="main" style="width: 130px" name="task_status">
                                                                                    <option value="1" <?php if ($note['status']==1){ ?> selected <?php } ?>>New</option>
                                                                                    <option value="2" <?php if ($note['status']==2){ ?> selected <?php } ?>>Closed</option>
                                                                                </select>
                                                                                <?php } } ?>
                                                                        </span>
                                                                    </p>
                                                                    <?php if ($note['type'] == 1 && $note['status'] == 2 && $note['close_date'] != ''){ ?>
                                                                        <p>
                                                                            <strong>Closed at:</strong>
                                                                            <span>
                                                                            <?php echo date('d.M.Y - h:i a', strtotime($note['close_date'])); ?>
                                                                        </span>
                                                                        </p>
                                                                    <?php } ?>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            <?php } ?>
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

        <div class="modal fade" id="refund_modal" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Refund Transaction</h5>
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <input type="text" class="form-control refund_amount" name="refund" placeholder="Type Amount" required="true">
                                    <input type="hidden" class="payment_id" name="payment_id">
									 <input type="hidden" class="payment_type" name="payment_type">
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <button type="button" class="btn btn-primary send_refund"> Refund</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">

                    </div>
                </div>
            </div>
        </div>

        <div id="claim_num" class="hide"><?php echo $claim_id; ?></div>
        <div id="customer_tab_id" class="hide"><?php echo $bottom_tab; ?></div>
        <div id="claim_customer_id" class="hide"><?php echo $details['id']; ?></div>
        <?php $this->load->view('common/admin_footer'); ?>
    </div>
</div>
<?php $this->load->view('common/admin_scripts'); ?>

<!-- data tables  -->
<script src="<?php echo base_url(); ?>assets/admin_assets/js/datatable/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin_assets/js/datatable/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin_assets/js/datatable/dataTables.responsive.min.js"></script>


<script>
    $(document).ready(function () {

        $('#data_5 .input-daterange').datepicker({
            keyboardNavigation: false,
            forceParse: false,
            format: 'yyyy-mm-dd',
            autoclose: true,
        });

        $("#next_bill_date").datepicker({
            todayBtn:  1,
            autoclose: true,
            format: 'yyyy-mm-dd',
			startDate: '+0d'
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
        $('#transaction_table').DataTable();
        $('#cards_table').DataTable({
            "bPaginate": false,
            "bFilter": false,
            "bInfo": false,
        });
        claim_files();

        var claim = $('#claim_num').html();
        var claim_customer_id = $('#claim_customer_id').html();

        if (claim!='' && claim!='unknown'){

            show_claim(claim, claim_customer_id);
        }

        var active_tab = $('#customer_tab_id').html();

        if (active_tab!='' && active_tab!='unknown'){
            $('.tab-pane').removeClass('active');
            $('.nav-link').removeClass('active');
            $('#'+active_tab).addClass('active');
            $('a[href*=#'+active_tab+']').addClass('active');
            $("html, body").animate({ scrollTop:$(".nav-tabs").offset().top},1000);
            // $('.claim-tab').addClass('active');
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
            var customer = $('#claim_customer_id').html();
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
                            var claim = status.claim;
                            window.location.replace(admin_url+"customers/edit/"+customer+"/"+claim);
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
            var customer = $('#claim_customer_id').html();
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
                window.location.replace(admin_url+"customers/edit/"+customer+"/0/tab-6");
            }, 2000);
        });

        $('#id_other_coverage').on('ifChanged', function(event){
            var value = $('#id_other_coverage').iCheck('update')[0].checked;
            // console.log('value == '+value);

            if(value == true) {
                $('#other_coverage_text').show();
            }else{
                $('#other_coverage_text').hide();
            }
        });

        $('#update-customer').submit(function (e) {
            e.preventDefault();
            var coverage = [];
            $('input[name="opt_coverage"]:checked').each(function() {
                coverage.push($(this).val());
            });
            var customer = $('#claim_customer_id').html();
            var btn = $('.submit-customer').ladda();
            btn.ladda('start');
            var value = new FormData( $("#update-customer")[0] );
            value.append("coverage", coverage);
            value.append("other_coverage", $('#other_coverage').val());

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
                            // location.reload();
                            window.location.replace(admin_url+"customers/edit/"+customer);
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
        var customer = $('#claim_customer_id').html();
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
                        window.location.replace(admin_url+"customers/edit/"+customer+"/"+claim);
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
        var customer = $('#claim_customer_id').html();
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
                        window.location.replace(admin_url+"customers/edit/"+customer+"/"+claim);
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
		var show_portal = $('input[name="show_portal"]:checked').val();
		if (typeof show_portal === "undefined") {
			var show_portal = '0';
		}
		
		
        if ($.trim(text_validation) == '') {
            toastr.error('Please provide complete details');
            btn.ladda('stop');
        } else {
            $.ajax({
                url: admin_url + 'tasks/add',
                type: 'POST',
                data: {customer: customer, text: text, type: type, assign_to: assign_to, claim: claim, show_portal: show_portal},
                dataType: 'json',
                success: function (status) {
                    if (status.msg == 'success') {
                        btn.ladda('stop');
                        toastr.success(status.response, 'Success');
                        var claim_num = status.claim;
                        setTimeout(function () {
                            window.location.replace(admin_url+"customers/edit/"+customer+"/"+claim_num);
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
        var data_profile = $(this).attr('data-profile');
        $.ajax({
            url:admin_url+'claims/assign_vendor',
            type: 'POST',
            data: { customer : customer, claim: claim,data_profile:data_profile},
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

    $(document).on('click', '.refund_payment', function () {
        var payment = $(this).attr('data-id');
        var payment_type = $(this).attr('data-type');
        $('.payment_id').val(payment);
        $('.payment_type').val(payment_type);
        $('.refund_amount').val('');
        $('#refund_modal').modal('show');
    });

    $(document).on('click', '.send_refund', function () {
        var btn = $('.send_refund').ladda();
        btn.ladda('start');
        var amount = $('.refund_amount').val();
        var customer = $('#claim_customer_id').html();
        var payment_type = $('#refund_modal .payment_type').val();
        var id = $('.payment_id').val();
        if (amount == ''){
            btn.ladda('stop');
            toastr.error('Amount must not be empty');
        } else {
            $.ajax({
                url:admin_url+'payments/refund',
                type: 'POST',
                data: {id: id, amount: amount, payment_type: payment_type},
                dataType:'json',
                success:function(status){
                    if(status.msg=='success'){
                        btn.ladda('stop');
                        if (status.response != 1){
                            toastr.error("Request declined", 'Error');
                        } else {
	                        toastr.success("Successful", 'Success');
	                        setTimeout(function () {
	                            window.location.replace(admin_url+"customers/edit/"+customer+"/0/tab-2");
	                        },2000);
                        }
                    }
                    else if(status.msg == 'error'){
                        btn.ladda('stop');
                        toastr.error(status.response);
                    }
                }
            });
        }
    });

    $(document).on('click', '.void_payment', function () {
        var payment = $(this).attr('data-id');
        var payment_mode = $(this).attr('data-type');
        var customer = $('#claim_customer_id').html();
        swal({
                title: "Are you sure?",
                text: "You want to void this Payment!",
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
                        url:admin_url+'payments/void',
                        type:'post',
                        data:{ id : payment, payment_mode:payment_mode },
                        dataType:'json',
                        success:function(status){

                            if(status.msg=='success'){
                                btn.ladda('stop');
                                if (status.response != 1){
                                    swal("Error", "Request Declined", "error");
                                } else {
                                    swal({title: "Success!", text: "Successful", type: "success"},
                                        function(){
                                            window.location.replace(admin_url+"customers/edit/"+customer+"/0/tab-2");
                                        });
                                }
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

    $(document).on('click', '.add-diagnosis', function () {
        var claim = $(this).attr('data-id');
        var status_up = $('.statusclaimid').val();
        $.ajax({
            url:admin_url+'claims/open_diagnose',
            type: 'POST',
            data: {claim: claim},
            dataType:'json',
            success:function(status){
                if(status.msg=='success'){
                    $('#diagnose_body').html(status.response);
					if(status_up =="2" || status_up=="7" || status_up=="9"){
						$('#diagnosis_modal').modal('show');
					}else{
						toastr.error('Either vendor not assigned yet or diagonsis form is unavailable');
					}	
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
        var claimnum = $(this).attr('data-claimnum');
        $('#enter_amount').val("");
        $.ajax({
            url:admin_url+'claims/check_authorize',
            type: 'POST',
            data: {claim: claim,claimnum: claimnum},
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
        var customer = $('#claim_customer_id').html();
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
                        window.location.replace(admin_url+"customers/edit/"+customer+"/"+status.claim);
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
                                        window.location.replace(admin_url+"customers/edit/"+customer+"/"+claim);
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
                    $('.tab-pane').removeClass('active');
                    $('.nav-link').removeClass('active');
                    $('#tab-3').addClass('active');
                    $('.claim-tab').addClass('active');
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

    function calculate_term() {
        var months = $('.c_month').val();
        var years = $('.c_plan').val();
        var years_month = parseInt(years);
        var total_months = 12;
        // if (months != ''){
        //     var total_months = years_month + parseFloat(months / total_months);
        // }else {
        var total_months = years_month;
        // }
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
            var customer = $('#claim_customer_id').html();
            var data = $(".payment_update").serialize();
            var btn = $('.update-payment').ladda();
            let carDis = $(".card_num_show").val();
            btn.ladda('start');
			if(carDis.length >= 13 && carDis.length <= 16 ){
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
                            // location.reload();
                            window.location.replace(admin_url+"customers/edit/"+customer+"/0/tab-2");
                        }, 2000);
                    }
                    else if(status.msg == 'error'){
                        btn.ladda('stop');
                        toastr.error(status.response);
                    }
                }
            });
			}else{
				btn.ladda('stop');
				toastr.error('Please enter valid card');
			}
        });

        $(document).on('click', '.update-date', function (e) {
            e.preventDefault();
            var customer = $('#claim_customer_id').html();
            var data = $(".policy_charge").serialize();
            var btn = $('.update-date').ladda();
            btn.ladda('start');
            $.ajax({
                url:admin_url+'customers/update_bill_date',
                type: 'POST',
                data:  data,
                dataType:'json',
                success:function(status){
                    if(status.msg=='success'){
                        btn.ladda('stop');
                        toastr.success(status.response, 'Success');
                        setTimeout(function () {
                            // location.reload();
                            window.location.replace(admin_url+"customers/edit/"+customer+"/0/tab-2");
                        }, 2000);
                    }
                    else if(status.msg == 'error'){
                        btn.ladda('stop');
                        toastr.error(status.response);
                    }
                }
            });
        });

        $(document).on('click', '.charge-payment', function (e) {
            e.preventDefault();
            var data = $(".charge_customer").serialize();
            var btn = $('.charge-payment').ladda();
            var customer = $('#claim_customer_id').html();
            btn.ladda('start');
            $.ajax({
                url:admin_url+'customers/charge_payment',
                type: 'POST',
                data:  data,
                dataType:'json',
                success:function(status){
                    if(status.msg=='success'){
                        btn.ladda('stop');
                        if(status.response != ''){
                            if(status.response == 1){
                                toastr.success('Payment succesfully approved', 'Success');
                                setTimeout(function () {
                                    window.location.replace(admin_url+"customers/edit/"+customer+"/0/tab-2");
                                }, 1000);
                            }else{
                                toastr.error('Payment declined', 'Error');
                            }
                        }
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

        if ($.trim(text_validation) == '') {
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
                        window.location.replace(admin_url+"customers/edit/"+customer+"/0/tab-1");
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
        var customer = $('#claim_customer_id').html();
        var id = _this.attr('data-id');
        var type = _this.attr('data-type');
        $.ajax({
            url:admin_url+'tasks/update_task',
            type: 'POST',
            data: { status: status, id: id},
            dataType:'json',
            success:function(status){
                if(status.msg=='success'){
                    toastr.success(status.response, 'Success');
                    setTimeout(function () {
                        if (type == 'claim'){
                            var claim_num = status.claim;
                            window.location.replace(admin_url+"customers/edit/"+customer+"/"+claim_num);
                        } else {
                            window.location.replace(admin_url+"customers/edit/"+customer+"/0/tab-1");
                        }
                    }, 2000);
                }
                else if(status.msg == 'error'){
                    toastr.error(status.response);
                }
            }
        });
    });

    $(document).on('change','.card_change', function () {
        var _this = $(this);
        var status = _this.val();
        var customer = _this.attr('data-id');
        var id = _this.attr('data-val');
        $.ajax({
            url:admin_url+'customers/update_card_status',
            type: 'POST',
            data: { status: status, id: id, customer: customer},
            dataType:'json',
            success:function(status){
                if(status.msg=='success'){
                    toastr.success(status.response, 'Success');
                    setTimeout(function () {
                        window.location.replace(admin_url+"customers/edit/"+customer+"/0/tab-2");
                    }, 2000);
                }
                else if(status.msg == 'error'){
                    toastr.error(status.response);
                }
            }
        });
    });



    $(document).on('click','.cancelSubscription', function () {
		var _this = $(this);
		var customer = _this.attr('data-id');
		var id = _this.attr('data-value');
        swal({
                title: "Are you sure?",
                text: "Are you sure you want to cancel this subscription?",
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
						url:admin_url+'customers/cancelSubscription',
						type: 'post',
						data: {id: id, customer: customer},
						dataType:'json',
						success:function(status){
							if(status.msg=='success'){
								btn.ladda('stop');
								swal({title: "Success!", text: status.response, type: "success"},
								function(){
									location.reload();
								});
								/* setTimeout(function () {
									window.location.replace(admin_url+"customers/edit/"+customer+"/0/tab-2");
								}, 2000); */
							}
							else if(status.msg == 'error'){
								 btn.ladda('stop');
                                swal("Error", status.response, "error");
							}
						}
					})
                } else {
                    swal("Cancelled", "", "error");
                }
            });
    });
	
    $('#change_password_form').validate({
        errorElement: 'span',
        errorClass: 'text-danger',
        focusInvalid: true,
        ignore: "",
        rules: {
            new_password: {
                required: true,
                minlength: 6
            },
            c_password: {
                required: true,
                equalTo:"#new_password"
            },
        },
        messages: {
            new_password: {
                required : "Please enter new password",
                minlength : "Password must be greater than 6 digits.",
            },
            c_password:{
                required : "Please enter confirm password.",
                equalTo : "Confirm password does not match.",
            },
        },
        highlight: function (e) {
            $(e).closest('.form-group').removeClass('has-info').addClass('has-error');
        },
        success: function (e) {
            $(e).closest('.form-group').removeClass('has-error');
            $(e).remove();
        },
        errorPlacement: function (error, element) {
            if(element.is('input[type=checkbox]') || element.is('input[type=radio]')) {
                var controls = element.closest('div[class*="col-"]');
                if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
                else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
            }
            else if(element.is('.select2')) {
                error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
            }
            else if(element.is('.chosen-select')) {
                error.insertAfter(element.siblings('[class*="chosen-container"]:eq(0)'));
            }
            else error.insertAfter(element);
        },
        submitHandler: function (form) {

        },
        invalidHandler: function (form) {

        }
    });

    $('#submit').click(function(e){

        if($("#change_password_form").valid()){

            var btn = $(this).ladda();
            btn.ladda('start');

            var value = $("#change_password_form").serialize();
            $.ajax({
                url:'<?php echo admin_url(); ?>customers/update_password',
                type:'post',
                data:value,
                dataType:'json',
                success:function(status){
                    btn.ladda('stop');
                    if(status.msg=='success'){
                        $('#change_password_form')[0].reset();
                        toastr.success(status.response,"Success");
                    }
                    else if(status.msg == 'error'){
                        toastr.error(status.response,"Error");
                    }
                }
            });
        }
    });
	$(".card_num_show").keyup(function(){
		let showcardis = $(".card_num_show").val();
		$(".card_num").val(showcardis);
	});
</script>
</body>
</html>
