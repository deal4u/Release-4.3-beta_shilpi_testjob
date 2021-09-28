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
                        <strong>Edit Vendor</strong>
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
                                            <form method="post" id="edit-vendor">
                                                <div class="form_section">
                                                    <h2 class="mb-4">Vendor Details</h2>
                                                    <div class="row">
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Comapny Name</label>
                                                                <input type="text" placeholder="Name" class="form-control" name="company" value="<?php echo $details['company']; ?>" required="true">
                                                                <input type="hidden" name="id" value="<?php echo $details['id']; ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Contact Name</label>
                                                                <input type="text" placeholder="Name" class="form-control" name="name" value="<?php echo $details['name']; ?>" required="true">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Email</label>
                                                                <input type="email" placeholder="Email" class="form-control" name="email" value="<?php echo $details['email']; ?>" required="true">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group" id="data_8">
                                                                <label>Phone</label>
                                                                <input type="number" placeholder="Phone" class="form-control" name="phone" value="<?php echo $details['phone']; ?>" required="true">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Fax</label>
                                                                <input type="number" class="form-control" name="fax" value="<?php echo $details['fax']; ?>" required="true">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Address</label>
                                                                <input type="text" class="form-control" name="address" value="<?php echo $details['street_address']; ?>" required="true">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>City</label>
                                                                <input type="text" class="form-control" name="city" value="<?php echo $details['city']; ?>" required="true">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>State</label>
                                                                <input type="text" class="form-control" name="state" value="<?php echo $details['state']; ?>" required="true">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Zip Code</label>
                                                                <input type="number" class="form-control" name="zip_code" value="<?php echo $details['zip_code']; ?>" required="true">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Travel to Miles</label>
                                                                <input type="number" class="form-control" name="travel_miles" value="<?php echo $details['travel_miles']; ?>" required="true">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Diagnosis Fee</label>
                                                                <input type="number" class="form-control" name="diagosis_fee" value="<?php echo $details['diagosis_fee']; ?>" required="true">
                                                            </div>
                                                        </div>
                                                        <?php if (get_session('admin_type') == 1 || (get_session('admin_type') == 2 && get_session('admin_permissions')['miscellaneous'] != 'N/A' && isset(get_session('admin_permissions')['miscellaneous']->status))) { ?>
                                                            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                                <div class="form-group">
                                                                    <label>Status</label>
                                                                    <select class="form-control" name="status">
                                                                        <option value="1" <?php if ($details['status']==1){ ?> selected <?php } ?>>Active</option>
                                                                        <option value="0" <?php if ($details['status']==0){ ?> selected <?php } ?>>Inactive</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        <?php } ?>
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Zip Codes Serviced</label>
                                                                <textarea class="form-control" name="zip_codes_serviced"><?php $zip_codes = get_zip_codes($details['id']);
                                                                    foreach ($zip_codes as $zip_code){
                                                                        if ($zip_code === end($zip_codes)){
                                                                            echo $zip_code['meta_value'];
                                                                        }else{
                                                                            echo $zip_code['meta_value'].',';
                                                                        }
                                                                    } ?></textarea>

                                                                <!--                                                                <select class="form-control" multiple="multiple" name="zip_codes_serviced[]" id="tag_select">-->
                                                                <!---->
                                                                <!--                                                                    --><?php //$zip_codes = get_zip_codes($details['id']);
                                                                //                                                                    foreach ($zip_codes as $zip_code){ ?>
                                                                <!--                                                                        <option selected>-->
                                                                <!--                                                                            --><?php //echo $zip_code['meta_value']; ?>
                                                                <!--                                                                        </option>-->
                                                                <!--                                                                    --><?php //} ?>
                                                                <!--                                                                </select>-->


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
                                                                        <input type="checkbox" value="1" <?php if (array_search("1",$services)){ ?> checked <?php } ?> name="opt_service[]">
                                                                        <i class="mr-2"></i>
                                                                        <span>HVAC </span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="i-checks ml-3">
                                                                    <label>
                                                                        <input type="checkbox" value="2" <?php if (array_search("2",$services)){ ?> checked <?php } ?> name="opt_service[]">
                                                                        <i class="mr-2"></i>
                                                                        <span>Appliances</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="i-checks ml-3">
                                                                    <label>
                                                                        <input type="checkbox" value="3" <?php if (array_search("3",$services)){ ?> checked <?php } ?> name="opt_service[]">
                                                                        <i class="mr-2"></i>
                                                                        <span>Plumbing</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="i-checks ml-3">
                                                                    <label>
                                                                        <input type="checkbox" value="4" <?php if (array_search("4",$services)){ ?> checked <?php } ?> name="opt_service[]">
                                                                        <i class="mr-2"></i>
                                                                        <span>Electrical</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="i-checks ml-3">
                                                                    <label>
                                                                        <input type="checkbox" value="5" <?php if (array_search("5",$services)){ ?> checked <?php } ?> name="opt_service[]">
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
                                                                        <input type="checkbox" value="6" <?php if (array_search("6",$services)){ ?> checked <?php } ?> name="opt_service[]">
                                                                        <i class="mr-2"></i>
                                                                        <span>Pool & Spa </span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="i-checks ml-3">
                                                                    <label>
                                                                        <input type="checkbox" value="7" <?php if (array_search("7",$services)){ ?> checked <?php } ?> name="opt_service[]">
                                                                        <i class="mr-2"></i>
                                                                        <span>Roofing</span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="i-checks ml-3">
                                                                    <label>
                                                                        <input type="checkbox" value="8" <?php if (array_search("8",$services)){ ?> checked <?php } ?> name="opt_service[]">
                                                                        <i class="mr-2"></i>
                                                                        <span>Central Vacuum Systems </span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="i-checks ml-3">
                                                                    <label>
                                                                        <input type="checkbox" value="9" <?php if (array_search("9",$services)){ ?> checked <?php } ?> name="opt_service[]">
                                                                        <i class="mr-2"></i>
                                                                        <span>Well Pumps </span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="i-checks ml-3">
                                                                    <label>
                                                                        <input type="checkbox" value="10" <?php if (array_search("10",$services)){ ?> checked <?php } ?> name="opt_service[]">
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
                                                                        <input type="checkbox" value="11" <?php if (array_search("11",$services)){ ?> checked <?php } ?> name="opt_service[]">
                                                                        <i class="mr-2"></i>
                                                                        <span>Sprinkler System </span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="i-checks ml-3">
                                                                    <label>
                                                                        <input type="checkbox" value="12" <?php if (array_search("12",$services)){ ?> checked <?php } ?> name="opt_service[]">
                                                                        <i class="mr-2"></i>
                                                                        <span>Drywall </span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <div class="i-checks ml-3">
                                                                    <label>
                                                                        <input type="checkbox" value="13" <?php if (array_search("13",$services)){ ?> checked <?php } ?> name="opt_service[]">
                                                                        <i class="mr-2"></i>
                                                                        <span>Garbage Disposal </span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form_section">
                                                    <div class="row">
                                                        <div class="btn_submit text-center pull-right col">
                                                            <button class="btn btn-primary btn-lg m-t-n-xs float-right update-vendor" type="button"><strong>Update</strong></button>
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
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-md-12">
                        <div class="tabs-container mb-3">
                            <ul class="nav nav-tabs" role="tablist">
                                <li><a class="nav-link active" data-toggle="tab" href="#tab-1"> Notes</a></li>
                                <li><a class="nav-link" data-toggle="tab" href="#tab-5">Files</a></li>
                                <li><a class="nav-link" data-toggle="tab" href="#tab-6">Claims</a></li>
                                <li><a class="nav-link" data-toggle="tab" href="#tab-7">Logs</a></li>
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
                                            $notes = get_notes_tasks_vendors($details['id']);
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
                                                                        <span><?php $salesperson = get_staff_name($note['assign_by']); echo $salesperson['FirstName'].' '.$salesperson['LastName']; ?></span>
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
                                                    <input type="hidden" name="vendor_file" value="<?php echo $details['id']; ?>" class="vendor_claim">
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
										<div class="row">
											<div class="col-6">
												<h4 class="mb-4">Claim Views</h4>
											</div>
										</div>
										<div class="ibox-content">
											<div class="table-responsive">
												<table id="customers_table" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
													<thead>
													<tr>
														<th>#</th>
														<th>Claim ID</th>
														<!--th>Policy number</th>-->
														<th>Customer Name</th>
														<th>Amount</th>
														<th>Assignment Date</th>
														<th>Status</th>
													</tr>
													</thead>
													<tbody>
													<?php $serial = 1 ;?>
													<?php foreach ($claim_auth as $claim) {
														?><?php $customers =  get_customers($claim['customer']);  ?>
														<tr class="gradeX">
															<td> <?php echo $serial; ?></td>
															<td>
																#<a href="<?php echo admin_url(); ?>customers/edit/<?php echo $claim['customer']; ?>/<?php echo $claim['claim_num']; ?>" class="insert_log" id="<?php echo $claim['customer']; ?>"><?php echo $claim['claim_num']; ?></a>
															</td>
															<td>
																
																<a href="<?php echo admin_url(); ?>customers/edit/<?php echo $claim['customer']; ?>" class="insert_log" id="<?php echo $claim['customer']; ?>"><?php echo ucwords($customers['first_name'].' '.$customers['last_name']); ?></a>
															</td>
															<td>
																<?php echo $claim['p_price']; ?>
															</td>
															<td>
															 <?php echo date('F jS, Y - h:i a' ,strtotime($claim['created_at'])); ?>
															</td>
															<td>
															 <?php foreach (claim_status() as $index=>$status){ ?>
																 <?php if ($claim['status']==$index){ ?> <?php echo $status; ?> <?php } ?>
															<?php } ?>
															</td>
														</tr>
														<?php  $serial++; } ?>
													</tbody>
												</table>
											</div>
										</div>
									</div>
                                </div>
								<div role="tabpanel" id="tab-7" class="tab-pane">
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
                                            $notes = get_notes_type('', $details['id']);
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
        <?php $this->load->view('common/admin_footer'); ?>
        <div id="customer_tab_id" class="hide"><?php echo $bottom_tab; ?></div>
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

    var active_tab = $('#customer_tab_id').html();

    if (active_tab!='' && active_tab!='unknown'){
        $('.tab-pane').removeClass('active');
        $('.nav-link').removeClass('active');
        $('#'+active_tab).addClass('active');
        $('a[href*=#'+active_tab+']').addClass('active');
        $("html, body").animate({ scrollTop:$(".nav-tabs").offset().top},1000);
        // $('.claim-tab').addClass('active');
    }

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



    $(document).on('click', '.add_task', function () {
        $(".summer_note").summernote("reset");
    });

    $(document).on('click', '.save_task', function () {
        var btn = $('.save_task').ladda();
        btn.ladda('start');
        var text_validation = $($(".summer_note").summernote("code")).text();
        var text = $(".summer_note").summernote("code");
        var vendor = $(this).attr('data-val');
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
                data: {vendor: vendor, text: text, type: type, assign_to: assign_to},
                dataType: 'json',
                success: function (status) {
                    if (status.msg == 'success') {
                        btn.ladda('stop');
                        toastr.success(status.response, 'Success');
                        window.location.replace(admin_url+"vendors/edit/"+vendor+"/tab-1");
                    } else if (status.msg == 'error') {
                        btn.ladda('stop');
                        toastr.error(status.response);
                    }
                }
            });
        }
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
                url:admin_url+'vendors/claim_files',
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

    claim_files();

    function claim_files(){
        var vendor_file =   $('.vendor_claim').val();
        $.ajax({
            url:admin_url+'vendors/get_images',
            type: 'POST',
            data: { vendor_file : vendor_file},
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
                        url:admin_url+'vendors/delete_claim_files',
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



        $(document).on("click" , ".update-vendor" , function() {
            if ($("#edit-vendor input:checkbox:checked").length > 0)
            {
                var btn = $('.update-vendor').ladda();
                btn.ladda('start');
                var value = new FormData( $("#edit-vendor")[0] );

                $.ajax({
                    url:admin_url+'vendors/update',
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