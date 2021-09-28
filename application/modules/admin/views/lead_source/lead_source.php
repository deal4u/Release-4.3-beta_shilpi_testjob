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
                <h2>Lead Source</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="<?php echo admin_url(); ?>">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">
                        <strong>Lead Source</strong>
                    </li>
                </ol>
            </div>
        </div>
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Lead Source</h5>
                            <button type="button" class="btn btn-primary pull-right t_m_25 customer-btn" data-toggle="modal" data-target="#add_lead_modal">
                                <i class='fa fa-plus'></i> Add New
                            </button>
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table id="leads_table" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Source</th>
                                        <th>Lead Cost</th>
                                        <th>Phone Number</th>
                                        <th>Show on Portal</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i=1; foreach ($source as $value) { ?>
                                        <tr class="gradeX">
                                            <td>
                                                <?php echo $i; ?>
                                            </td>
                                            <td>
                                                <?php echo $value['name']; ?>
                                            </td>
                                            <td>
                                                <?php if (!empty($value['cost'])){ echo '$'.$value['cost']; } ?>
                                            </td>
                                            <td>
                                                <?php if (!empty($value['sales_phone_no'])){ echo $value['sales_phone_no']; } ?>
                                            </td>
                                            <td>
                                                <?php  if($value['show_portal']==1){ echo "Yes"; }else{ echo "No"; }  ?>
                                            </td>
                                            <td>
                                                <?php echo date('F jS, Y - h:i a' ,strtotime($value['created_at'])); ?>
                                            </td>
                                            <td>
                                                <?php if($value['status'] == 1){
                                                    $label_class = 'primary';
                                                    $label = 'Active';
                                                }else{
                                                    $label_class = 'danger';
                                                    $label = 'InActive';
                                                } ?>
                                                <span class="label label-<?php echo $label_class; ?>"><?php echo $label; ?></span>
                                            </td>
                                            <td>
                                                <section class="progress-demo"><button class="ladda-button btn btn-success update-source" data-id="<?php echo $value['id']; ?>" data-style="expand-right">Edit</button></section>
                                            </td>
                                        </tr>
                                        <?php $i++; } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal inmodal" id="add_lead_modal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content animated flipInY">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h5 class="modal-title">Add Lead Source</h5>
                    </div>
                    <form method="post" id="add_lead_form">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" name="name" placeholder="" class="form-control">
                                    </div>
                                </div>
								<div class="col-8">
                                    <div class="form-group">
                                        <label>Phone Number</label>
                                        <input type="text" name="sales_phone_no" placeholder="" class="form-control">
                                    </div>
                                </div>
								<div class="col-4">
									<label>Show on portal</label>
									<div class="form-group">
										<div class="form-check-inline">
										  <label class="form-check-label">
											<input type="radio" id="Yes" value="1" class="form-check-input" name="show_portal">Yes
										  </label>
										</div>
										<div class="form-check-inline">
										  <label class="form-check-label">
											<input type="radio" id="No" value="0" class="form-check-input" name="show_portal">No
										  </label>
										</div>
									</div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Lead Cost</label>
                                        <input type="text" name="cost" placeholder="" class="form-control">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="status" class="form-control">
                                            <option value="1">Active</option>
                                            <option value="0">InActive</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                            <button type="button" class="ladda-button btn btn-primary" id="submit_lead" data-style="expand-right">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="source_edit_modal" tabindex="-1" role="dialog" aria-labelledby="LeadSourceDetails" aria-hidden="true">
            <div class="modal-dialog modal-md" id="source_edit_body">

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
    $('#leads_table').dataTable({
        "paging": true,
        "searching": true,
        "responsive": true,
        "columnDefs": [
            { "responsivePriority": 1, "targets": 0 },
            { "responsivePriority": 2, "targets": -1 }
        ]
    });

    $(document).on("click" , ".update-source" , function() {
        var id = $(this).attr('data-id');
        $.ajax({
            url: admin_url+'lead_source/edit_source',
            type: 'POST',
            data: { id : id},
            dataType:'json',
            success:function(status){
                if(status.msg=='success'){
                    $('#source_edit_body').html(status.response);
                    $('#source_edit_modal').modal('show');
                }
                else if(status.msg == 'error'){
                    toastr.error(status.response);
                }
            }
        });
    });

    $(document).on("click" , "#submit_lead" , function() {
        var btn = $(this).ladda();
        btn.ladda('start');
        var formData = $("#add_lead_form").serialize();
        $.ajax({
            url: admin_url+'lead_source/save_lead',
            type: 'POST',
            data: formData,
            dataType:'json',
            success:function(status){
                btn.ladda('stop');
                if(status.msg=='success') {
                    $('#add_lead_form')[0].reset();
                    toastr.success(status.response);
                    $('#add_lead_modal').modal('hide');
                    setTimeout(function(){ location.reload(); }, 2000);
                } else if(status.msg == 'error') {
                    toastr.error(status.response);
                }
            }
        });
    });
</script>
