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
                <h2>Tasks</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="<?php echo admin_url(); ?>">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">
                        <strong>Tasks</strong>
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
                                    <form role="form" class="form" id="filter_tasks" method="GET" action="<?php echo admin_url(); ?>tasks/search_task">
                                        <div class="row">
                                            <div class="col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <select class="form-control search-status" name="task_status">
                                                        <option selected value="">Task Status</option>
                                                        <option value="1" <?php if(@$param['task_status']){ if ($param['task_status']==1){ ?> selected <?php } } ?>>New</option>
                                                        <option value="2" <?php if(@$param['task_status']){ if ($param['task_status']==2){ ?> selected <?php } } ?>>Closed</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <?php if (get_session('admin_type') == 1){ ?>
                                                <div class="col-md-4 col-sm-12">
                                                    <div class="form-group">
                                                        <select class="form-control search-assigned" name="task_person">
                                                            <option selected value="">Show</option>
                                                            <?php foreach (get_data('','admins',array('type!='=>1),array('id','FirstName','LastName')) as $salesperson){ ?>
                                                                <option value="<?php echo $salesperson['id']; ?>" <?php if(@$param['task_person']){ if ($param['task_person']==$salesperson['id']){ ?> selected <?php } } ?>><?php echo $salesperson['FirstName'].' '.$salesperson['LastName']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <div class="col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <select class="form-control" name="task_dept">
                                                            <option selected disabled>Select Department</option>
                                                            <option>Department 1</option>
                                                            <option>Department 2</option>
                                                            <option>Department 3</option>
                                                        </select>
                                                        <span class="input-group-append">
                                                                <button type="submit" class="btn btn btn-primary"> <i class="fa fa-search"></i> Search</button>
                                                            </span>
                                                    </div>
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
                        <div class="ibox ">
                            <div class="ibox-title custom_padd">
                                <div class="update_task">
                                    <form role="form" class="form" id="update_task">
                                        <div class="row">
                                            <div class="col-md-2 col-sm-12">
                                                <div class="form-group">
                                                    <div class="i-checks ml-3"><label> <input type="checkbox" value="" id="check-all"> <i class="mr-2"></i> <span>Select/Deselect </span></label></div>
                                                </div>
                                            </div>
                                            <?php if (get_session('admin_type') == 1 || (get_session('admin_type') == 2 && get_session('admin_permissions')['miscellaneous'] != 'N/A' && isset(get_session('admin_permissions')['miscellaneous']->status))) { ?>
                                                <div class="col-md-3 col-sm-12">
                                                    <div class="form-group">
                                                        <select class="form-control update-status" name="task_status">
                                                            <option selected value="">Status</option>
                                                            <option value="1">New</option>
                                                            <option value="2">Closed</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            <?php }else{ ?>
                                                <div class="col-md-3 col-sm-12">
                                                    <div class="form-group">
                                                        <select class="form-control update-status" name="task_status" disabled = disabled>
                                                            <option selected value="">Status</option>
                                                            <option value="1">New</option>
                                                            <option value="2">Closed</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                            <div class="col-md-3 col-sm-12">
                                                <div class="form-group">
                                                    <?php if (get_session('admin_type') == 1 || (get_session('admin_type') == 2 && get_session('admin_permissions')['miscellaneous'] != 'N/A' && isset(get_session('admin_permissions')['miscellaneous']->forward_task))) { ?>
                                                        <select class="form-control update-assigned" name="task_person">
                                                            <option selected value="">Assign to Rep</option>
                                                            <?php foreach (get_data('','admins',array('type!='=>1),array('id','FirstName','LastName')) as $salesperson){ ?>
                                                                <option value="<?php echo $salesperson['id']; ?>"><?php echo $salesperson['FirstName'].' '.$salesperson['LastName']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    <?php }else{ ?>
                                                        <select class="form-control update-assigned" name="task_person" disabled="disabled">
                                                            <option selected value="">Assign to Rep</option>
                                                            <?php foreach (get_data('','admins',array('type!='=>1),array('id','FirstName','LastName')) as $salesperson){ ?>
                                                                <option value="<?php echo $salesperson['id']; ?>"><?php echo $salesperson['FirstName'].' '.$salesperson['LastName']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <select class="form-control" name="task_dept">
                                                            <option selected disabled>Assign to Department</option>
                                                            <option>Department 1</option>
                                                            <option>Department 2</option>
                                                            <option>Department 3</option>
                                                        </select>
                                                        <span class="input-group-append">
                                                                <button type="button" class="btn btn btn-primary update-multi"> <i class="fa fa-refresh"></i> Update</button>
                                                            </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="ibox-content">
                                <div class="table-responsive">
                                    <table id="tasks_table" class="table table-striped table-bordered table-hover dataTables-example tbl tbl_tasks">
                                        <thead>
                                        <tr>
                                            <th>&nbsp;</th>
                                            <th>Name</th>
                                            <th width="32%">Notes</th>
                                            <th>Posted By</th>
                                            <th>Date/Time</th>
                                            <th>Assigned To</th>
                                            <?php if (get_session('admin_type') == 1 || (get_session('admin_type') == 2 && get_session('admin_permissions')['miscellaneous'] != 'N/A' && isset(get_session('admin_permissions')['miscellaneous']->status))) { ?>
                                                <th>Status</th>
                                            <?php } ?>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($tasks as $task){ ?>
                                            <tr>
                                                <td>
                                                    <div class="i-checks"><label> <input type="checkbox" value="<?php echo $task['id'] ?>" class="check" name="task_check"> <i></i> </label></div>
                                                </td>
                                                  <?php
                                                    if($task['customer']!=""){
                                                        $customer_detail = get_customers($task['customer']); 
                                                    }
                                                    elseif($task['vendor']!=""){
                                                        $vendor_detail = get_vendors($task['vendor']);
                                                    }
                                                  
                                                ?>
                                                <?php if($task['customer']!=""){?>
                                                <td><a href="<?php echo admin_url(); ?>customers/edit/<?php echo $customer_detail['id']; ?>" class="insert_log" id="<?php echo $customer_detail['id']; ?>">
                                                    <?php echo $customer_detail['first_name'].' '.$customer_detail['last_name']; ?></a></td>
                                                <?php }else{ ?>  
                                                    <td><a href="<?php echo admin_url(); ?>vendors/edit/<?php echo $vendor_detail['id']; ?>" class="insert_log" id="<?php echo $vendor_detail['id']; ?>">
                                                    <?php echo $vendor_detail['company'] ?></a></td>
                                                <?php } ?>
                                                
                                                
                                                <td><?php echo $task['details']; ?></td>
                                                <td><?php $assign_by = get_staff_name($task['assign_by']); echo $assign_by['FirstName'].' '.$assign_by['LastName']; ?></td>
                                                <td><?php echo date('d.M.Y - h:i a', strtotime($task['created_at'])); ?></td>
                                                <td>
                                                    <div class="form-group">
                                                        <?php if (get_session('admin_type') == 1 || (get_session('admin_type') == 2 && get_session('admin_permissions')['miscellaneous'] != 'N/A' && isset(get_session('admin_permissions')['miscellaneous']->forward_task))) { ?>
                                                            <select class="form-control assign-to" name="assign_to">
                                                                <?php foreach (get_data('','admins',array('type!='=>1),array('id','FirstName','LastName')) as $salesperson){ ?>
                                                                    <option value="<?php echo $salesperson['id']; ?>" <?php if ($salesperson['id']==$task['assign_to']){ ?> selected <?php } ?>><?php echo $salesperson['FirstName'].' '.$salesperson['LastName']; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        <?php }else{ ?>
                                                            <select class="form-control assign-to" name="assign_to" disabled="disabled">
                                                                <?php foreach (get_data('','admins',array('type!='=>1),array('id','FirstName','LastName')) as $salesperson){ ?>
                                                                    <option value="<?php echo $salesperson['id']; ?>" <?php if ($salesperson['id']==$task['assign_to']){ ?> selected <?php } ?>><?php echo $salesperson['FirstName'].' '.$salesperson['LastName']; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        <?php } ?>
                                                    </div>
                                                </td>
                                                <?php if (get_session('admin_type') == 1 || (get_session('admin_type') == 2 && get_session('admin_permissions')['miscellaneous'] != 'N/A' && isset(get_session('admin_permissions')['miscellaneous']->status))) { ?>
                                                    <td>
                                                        <select class="form-control task-status-new" name="indv_task_status" id="row_<?php echo $task['id']; ?>">
                                                            <option value="1" <?php if ($task['status']==1){ ?> selected <?php } ?>>New</option>
                                                            <option value="2" <?php if ($task['status']==2){ ?> selected <?php } ?>>Closed</option>
                                                        </select>
                                                    </td>
                                                <?php } ?>
                                                <td>
                                                    <section class="progress-demo"><button class="ladda-button btn btn-success update-task" data-val="<?php echo $task['id']; ?>" data-style="expand-right">Update</button></section>
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


</body>
</html>

<script>
    $('#tasks_table').dataTable({
        "paging": true,
        "searching": true,
    });


    $('.update-task').on('click', function () {
        var btn = $(this).ladda();
        btn.ladda('start');
        var _this = $(this);
        var task = _this.attr('data-val');
        var assign_to = _this.closest('tr').children().find('.assign-to').val();
        var task_status = $('#row_'+task).val();
        $.ajax({
            url:admin_url+'tasks/update',
            type: 'POST',
            data: { task : task, assign_to: assign_to, task_status: task_status},
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

    $('.update-multi').on('click', function () {
        var btn = $(this).ladda();
        btn.ladda('start');
        var status = $('.update-status').val();
        var assign_to = $('.update-assigned').val();
        var i=0;
        var update=[];
        $('input[name="task_check"]:checked').each(function() {
            update.push(this.value);
            i++;
        });
        if (i==0){
            toastr.error('Select atleast one task to update');
            btn.ladda('stop');
        }else if (status=="" && assign_to==""){
            toastr.error('Select atleast one action to perform');
            btn.ladda('stop');
        }else {
            $.ajax({
                url:admin_url+'tasks/update_multiple',
                type: 'POST',
                data: { update : update, status: status, assign_to: assign_to},
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

</script>
