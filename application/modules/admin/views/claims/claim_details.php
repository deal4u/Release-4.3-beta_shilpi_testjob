<style type="text/css">

    .dyn-height {
        width:100px;
        max-height:250px;
        overflow-y:auto;
    }
</style>
<div class="profile">
    <div class="ibox m-0">
        <div class="ibox-content claim-info-sec pb-2">
            <div class="row">
                <div class="col-sm-6 mb-4">
                    <div class="form-group">
                        <p class="section-id">Claim #: <span><?php echo $claim['claim_num']; ?></span></p>
                    </div>
                </div>
                <div class="col-sm-6 mb-4">
                    <?php if (get_session('admin_type') == 1 || (get_session('admin_type') == 2 && get_session('admin_permissions')['miscellaneous'] != 'N/A' && isset(get_session('admin_permissions')['miscellaneous']->status))) { ?>
                        <div cla="row">
                            <label for="" class="status-label">Status</label>
                            <div class="col-md-10 float-right" >
                                <div class="input-group">
                                    <select class="form-control claim-status" data-val="<?php echo $claim['claim_num']; ?>">
										
                                        <?php foreach (claim_status() as $index=>$status){ ?>
                                            <option value="<?php echo $index; ?>" <?php if ($claim['status']==$index){ ?> selected <?php } ?>><?php echo $status; ?></option>
                                        <?php } ?>
                                    </select>
									<input type="hidden" class="statusclaimid" value="<?php echo $claim['status']; ?>">
                                    <span class="input-group-append">
                                    <button type="submit" class="btn btn btn-primary update-status"> <i class="fa fa-wrench"></i> Update</button>
                                </span>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Rep</label>
                        <p>
                            <?php
                            $representative = get_staff_name($claim['representative']);
                            echo $representative['FirstName'].' '.$representative['LastName'];
                            ?>
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Date and Time</label>
                        <p><?php echo date('d.M.Y - h:i a', strtotime($claim['created_at'])); ?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Claim By</label>
                        <?php $customer = get_customers($claim['customer']); ?>
                        <p><span><?php echo $customer['first_name'].' '.$customer['last_name']; ?></span><span> - <?php echo $customer['home_phone']; ?></span> <span><?php echo $customer['email']; ?></span></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Claim Started For</label>
                        <p><?php
                            $str = $claim['item'];
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
                            ?> - <?php echo $claim['problem']; ?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Last Time Working</label>
                        <p><?php echo $claim['last_working']; ?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Make/Modal/Serial</label>
                        <p><?php echo $claim['make']; ?></p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Last Time Serviced</label>
                        <p><?php echo $claim['last_serviced']; ?></p>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="form-group">
                        <label>Description</label>
                        <p><?php echo $claim['description']; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-12">
            </div>
        </div>
    </div>
    <div class="row m-t-lg"></div>
    <div class="row">
        <div class="col-md-6">
            <div class="wrapper wrapper-content animated fadeInRight pb-0">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="ibox m-0">
                            <div class="ibox-content ibox-content pb-2">
                                <div class="profile_btns">
                                    <button class="mb-2 btn btn-warning assign-vendor" data-val="<?php echo $claim['customer']; ?>" data-id="<?php echo $claim['claim_num']; ?>" data-profile="<?php echo  $str_meta_key[1]; ?>">Assign Vendor</button>
                                    <button class="mb-2 btn btn-danger claim-assignment" cus_id="<?php echo $claim['customer']; ?>" data-id="<?php echo $claim['claim_num']; ?>" data-val="resend-swo">Resend SWO</button>
                                    <button class="mb-2 btn btn-success btn-purple add-diagnosis" vendor_id="<?= $claim['vendor'];?>" cus_id="<?php echo $claim['customer']; ?>" data-id="<?php echo $claim['id']; ?>">Diagnosis</button>
                                    <button class="mb-2 btn btn-primary claim-assignment" cus_id="<?php echo $claim['customer']; ?>" data-id="<?php echo $claim['claim_num']; ?>" data-val="reimbursement">Send Claim Reimbursement From</button>
                                    <button class="mb-2 btn btn-danger claim-assignment" cus_id="<?php echo $claim['customer']; ?>" data-id="<?php echo $claim['claim_num']; ?>" data-val="reassign-vendor">Reassign Vendor</button>
                                    <button class="mb-2 btn btn-warning claim-assignment" cus_id="<?php echo $claim['customer']; ?>" data-id="<?php echo $claim['claim_num']; ?>" data-val="recall">Recall</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="wrapper wrapper-content animated fadeInRight pb-0">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="ibox">
                            <div class="ibox-title">
                                <h5>Add Reply</h5>
                            </div>
                            <div class="ibox-content ibox-content no-padding">
                                <div class="summernote noborder"></div>
                                <div class="p-3">
                                    <div class="row">
                                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <select class="form-control task-type">
                                                    <option value="2">Add Note</option>
                                                    <option value="1">Post Admin Comment</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <select class="form-control task-person hide">
                                                        <?php foreach (get_data('','admins',array('type!='=>1),array('id','FirstName','LastName')) as $salesperson){ ?>
                                                            <option value="<?php echo $salesperson['id']; ?>"><?php echo $salesperson['FirstName'].' '.$salesperson['LastName']; ?></option>
                                                        <?php } ?>
                                                    </select>
													
												</div>			
											</div>			
										</div>	
										<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <div class="input-group">
														<label>
															<input type="checkbox" class="show_portal" value="1"  name="show_portal">
															<i class="mr-2"></i>
															<span>Show To Customer</span>
														</label>
													
                                                </div>
                                            </div>
                                        </div>
										<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
											
											<span class="input-group-append pull-right"><button type="submit" class="btn btn btn-primary add-task" data-val-claim="<?php echo $claim['id']; ?>" data-val="<?php echo $claim['customer']; ?>"> <i class="fa fa-reply"></i> Reply</button></span>
										</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="wrapper wrapper-content animated fadeInRight pb-0">
                <div class="row">
                    <div class="col-md-12 col-sm-12">

                        <div class="ibox">
                            <div class="ibox-title">
                                <h5>Notes</h5>
                            </div>
                            <div class="ibox-content">
                                <div class="scroll_content">
                                    <div class="feed-activity-list">
                                        <?php
                                        $notes = get_claim_notes_tasks($claim['customer'], $claim['id']);
                                        if (empty($notes)){
                                            echo 'No Records Found';
                                        }else{ ?>
                                            <?php foreach ($notes as $note){ ?>
                                                <div class="feed-element p-2" <?php if ($note['type'] == 1 && $note['status'] == 1){ ?> style="background-color: #b7f6b7" <?php } ?>>
                                                    <div class="media-body ">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <p class="m-0">
                                                                    <strong>Note Added</strong>
                                                                    <span class="text-muted"> <?php echo date('d.M.Y - h:i a', strtotime($note['created_at'])); ?> </span>
                                                                    <?php if ($note['type'] == 1){ ?>  |
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
                                                                    <span><?php if($note['assign_by']==NULL || $note['assign_by']==""){
																					echo  'Customer:';
																					}else
																					{ $salesperson = get_staff_name($note['assign_by']); echo $salesperson['FirstName'].' '.$salesperson['LastName'];?></span>
                                                                    <?php } ?></span>
                                                                </p>
																
																<?php if( $note['show_portal'] =='1'){
																	?>
																	<span class="label label-success">Visible to customer</span>
																	<?php
																} ?>
                                                                <p class="m-0">
                                                                    <span>
                                                                        <?php if ($note['type'] == 1){ ?>
                                                                            <?php if (get_session('admin_type') == 1 || (get_session('admin_type') == 2 && get_session('admin_permissions')['miscellaneous'] != 'N/A' && isset(get_session('admin_permissions')['miscellaneous']->forward_task))) { ?>
                                                                                <select class="form-control task-status ml-auto" data-id="<?php echo $note['id'] ?>" data-type="claim" style="width: 130px" name="task_status">
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
        <div class="col-md-6">
            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="ibox">
                            <div class="ibox-title p-3">
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12 form-group m-0"><h4 class="mt-2 m-0">Customers Satisfaction</h4></div>
                                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12 form-group m-0">
                                        <div class="input-group">
                                            <select class="form-control s_status" data-val="<?php echo $claim['claim_num']; ?>">
                                                <option value="1" <?php if ($claim['customer_satisfaction']==1){ ?> selected <?php } ?>>Good</option>
                                                <option value="0" <?php if ($claim['customer_satisfaction']==0){ ?> selected <?php } ?>>Unknown</option>
                                            </select>
                                            <span class="input-group-append"><button type="submit" class="btn btn btn-primary c_satisfaction"> <i class="fa fa-wrench"></i> Update</button></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="ibox-content ibox-content">
                                <div class="form_section">
                                    <h2 class="mb-4">Diagnosis Information</h2>
                                    <div class="table-responsive">
                                        <table class="table">
                                            
                                            <?php if(!is_reimbursement_claimed($claim['claim_num'])){ ?>                        
                                            <tr>
                                                <td><strong>Diagnosis Taken By</strong></td>
                                                <td><strong><?php $diagnoser = get_staff_name($claim['diagnose_by']); echo $diagnoser['FirstName'].' '.$diagnoser['LastName']; ?></strong> </td>
                                            </tr>
                                            <tr>
                                              <td><strong><a href="<?php  if(!empty($claim['vendor'])) { echo  base_url();?>admin/vendors/edit/<?php echo $claim['vendor']; }else { echo 'javascript:void(0);'; }?>" class="text-uppercase"><?php if (!empty($claim['vendor'])){ $company = get_data($claim['vendor'],'vendors','','company'); echo $company[0]['company']; } ?></a></strong></td>
                                                <td><strong><a href="javascript:void(0);">View Price Guide</a></strong></td>
                                            </tr>
                                            <?php }else{ ?>
                                            <tr>
                                                <td><strong>Diagnosis Taken By</strong></td>
                                                <td><strong>Reimbursement Claimed</strong> </td>
                                            </tr>
                                             
                                            <?php } ?>   

                                            <tr>
                                                <td><strong>Date Vendor Assigned</strong></td>
                                                <td><?php if (!empty($claim['vendor_assign'])){ echo date('d.M.Y - h:i a', strtotime($claim['vendor_assign'])); } ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Date Diagnosis Added</strong></td>
                                                <td><?php if (!empty($claim['diagnose_added'])){ echo date('d.M.Y - h:i a', strtotime($claim['diagnose_added'])); } ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Contractor</strong></td>
                                                <td class="text-uppercase"><?php echo $claim['contractor']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Tech Name</strong></td>
                                                <td class="text-uppercase"><?php echo $claim['tech_name']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Called In By</strong></td>
                                                <td><?php echo $claim['called_by']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Tech At Home</strong></td>
                                                <td><?php echo $claim['tech_home']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>There When</strong></td>
                                                <td><?php if (!empty($claim['there_when'])){ echo date('d.M.Y', strtotime($claim['there_when'])); } ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Type</strong></td>
                                                <td><?php echo $claim['type']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Age</strong></td>
                                                <td><?php echo $claim['age']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Size</strong></td>
                                                <td><?php echo $claim['size']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Property Installed</strong></td>
                                                <td><?php echo $claim['p_installed']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Rust Or Corrosion</strong></td>
                                                <td><?php echo $claim['rust']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Cause of Failure</strong></td>
                                                <td><?php echo $claim['failure_cause']; ?></td>
                                            </tr>
                                            <tr>
                                                <td class="text-uppercase" colspan="2">
                                                    <strong>Diagonsis</strong><br /><?php echo $claim['diagnosis']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Part Number</strong></td>
                                                <td class="text-uppercase"><?php echo $claim['p_number']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Part Number Price</strong></td>
                                                <td><?php echo '$'.number_format((float)$claim['p_price'], 2, '.', ''); ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Service Call Fee</strong></td>
                                                <td><?php echo '$'.number_format((float)$claim['service_fee'], 2, '.', ''); ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Paid By</strong></td>
                                                <td><?php echo $claim['paid_by']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Overall Unit Condition</strong></td>
                                                <td><?php echo $claim['condition']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Leaks</strong></td>
                                                <td><?php echo $claim['leaks']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Leak Size</strong></td>
                                                <td><?php echo $claim['leak_size']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Make</strong></td>
                                                <td class="text-uppercase"><?php echo $claim['p_make']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Modal</strong></td>
                                                <td><?php echo $claim['p_model']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Number of Units</strong></td>
                                                <td><?php echo $claim['p_units']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Property Maintained</strong></td>
                                                <td class="text-uppercase"><?php echo $claim['p_maintained']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Overloaded</strong></td>
                                                <td><?php echo $claim['overloaded']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Total</strong></td>
                                                <td><strong><?php if (empty($claim['total'])){ echo '$0.00'; }else{ echo '$'.number_format((float)$claim['total'], 2, '.', ''); } ?></strong></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="hr-line-dashed"></div>
                                    <div class="profile_btns">
                                        <button class="mb-2 btn btn-primary btn-lg auth-claim" data-id="<?php echo $claim['id']; ?>" data-claimnum="<?php echo $claim['claim_num']; ?>" data-val="1">Authorize Claim</button>
                                        <button class="mb-2 btn btn-primary btn-lg auth-claim" data-id="<?php echo $claim['id']; ?>"  data-claimnum="<?php echo $claim['claim_num']; ?>" data-val="2">Authorize Goodwill</button>
                                        <button class="mb-2 btn btn-primary btn-lg auth-claim" data-claimnum="<?php echo $claim['claim_num']; ?>" data-id="<?php echo $claim['id']; ?>" data-val="3">Authorize Buyout</button>
                                        <button class="mb-2 btn btn-primary btn-lg auth-claim" data-claimnum="<?php echo $claim['claim_num']; ?>" data-id="<?php echo $claim['id']; ?>" data-val="4">Authorize Reimbursement</button>
                                        <button class="mb-2 btn btn-danger btn-lg revoke-auth" data-claimnum="<?php echo $claim['claim_num']; ?>" data-id="<?php echo $claim['id']; ?>">Revoke Authorization</button>
                                    </div>
                                    <?php $authorizations = get_authorization($claim['id']);
                                    foreach ($authorizations as $authorization){ ?>
                                        <div class="hr-line-dashed"></div>
                                        <div class="authorize_info">
                                            <p><strong>Authorization Rep: </strong><?php $salesperson = get_staff_name($authorization['auth_by']); echo $salesperson['FirstName'].' '.$salesperson['LastName']; ?> </p>
                                            <p><strong><a href="javascript:void(0);">Standard Authorization </a>$<?php echo  number_format((float)$authorization['amount'], 2, '.', ''); ?> </strong>  for <strong class="text-uppercase">
                                                    <?php if ($authorization['auth_for']==1){
                                                        $customer = get_customers($claim['customer']);
                                                        echo $customer['first_name'].' '.$customer['last_name'];
                                                    }else{
                                                        $vendor = get_vendors($claim['vendor']);
                                                        echo $vendor['company'];
                                                    } ?></strong></p>
                                            <p><strong>Authorization # <?php echo $authorization['auth_num']; ?></strong></p>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<div class="row">
		<div class="col-md-12 col-sm-12">
			<div class="ibox">
				<div class="ibox-title p-3">
				Claim Files
				</div>
				<div class="ibox-content">
					<div class="">
						<form method="post" id="uploadclaim" enctype="multipart/form-data">
							<div class="form-group row">
								<div class="col-sm-5">
									<input id="claim-image" type="file" class="form-control upload-image" data-type="claim-image" name="claimimage" accept=".jpg, .pdf ,.doc ,.docx, .xls">
								</div>
								<div class="col-sm-5">
									<input type="text" class="form-control" name="image_alts" placeholder="File Name" maxlength="15" required="true">
								</div>
								<input type="hidden" name="customer_claimz" value="<?php echo $claim['customer']; ?>" class="customer_claimz">
								<input type="hidden" name="claim_idz" value="<?php echo $claim['id']; ?>" class="claim_idz">
								<div class="col-md-2">
									<button class="btn btn-primary save-claimfile" type="submit">Upload File</button>
								</div>
							</div>
						</form>
					</div>
					<div id="claimimages">

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
    $(document).ready(function(){
        $('.summernote').summernote({
            toolbar: [
                ['font', ['bold']]
            ],
        });
        $('#uploadclaim').on('submit', function (e) {
			e.preventDefault();
			 var i = 0;
			var image = $('#claim-image').val();
			if (image== ''){
				i++;
				toastr.error("Upload related image", 'Error');
			}else {
				var duplicate = $('#claim-image').attr('replace');
				if (duplicate == 1){
					i++;
					toastr.error("File already exist with same name", 'Error');
				}
			}
			if (i==0){
				var btn = $('.save-claimfile').ladda();
				btn.ladda('start');
				var value = new FormData( $("#uploadclaim")[0] );

				$.ajax({
					url:admin_url+'claims/claim_files',
					type:'post',
					data:value,
					dataType:'json',
					processData: false,
					contentType: false,
					success:function(status){
						if(status.msg=='success'){
							btn.ladda('stop');
							toastr.success(status.response, 'Success');
							claim_filesz();
							$('#uploadclaim').trigger("reset");
						}
						else if(status.msg == 'error'){
							btn.ladda('stop');
							toastr.error(status.response, 'Error');
						}
					}
				});
			}
			return false;
		})
		

        $('.task-type').on('change', function () {
            var _this = $(this);
            var value = _this.val();
            if (value==1){
                $('.task-person').removeClass('hide');
            } else {
                $('.task-person').addClass('hide');
            }
        });
        $('.scroll_content').slimscroll({
            height: '600px'
        })
		claim_filesz();
    });
	$(document).on('click', '.remove-claim-related', function () {
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
                                        claim_filesz();
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
function claim_filesz(){
			var claim_id =   $('.claim_idz').val();
			var customer_claim =   $('.customer_claimz').val();
			$.ajax({
				url:admin_url+'customers/get_images',
				type: 'POST',
				data: { customer_claim : customer_claim ,claim_id : claim_id},
				dataType:'json',
				success:function(status){
					if(status.msg=='success'){
						$('#claimimages').html(status.response);
					}
					else if(status.msg == 'error'){
						toastr.error(status.response);
					}
				}
			});
		}
</script>