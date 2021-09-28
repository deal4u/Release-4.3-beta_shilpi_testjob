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
                <h2>Employees Directory</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="<?php echo admin_url(); ?>">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">
                        <strong>Employees Directory</strong>
                    </li>
                </ol>
            </div>
        </div>

        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Employees Directory</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table id="admin_table" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Department</th>
                                        <th>EXT</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i=1; foreach ($employee as $admin) { ?>
                                        <tr class="gradeX">
                                            <td> <?php echo $i; ?> </td>
                                            <td>
                                                <a href="<?php echo admin_url(); ?>edit/<?php echo $admin['id']; ?>" data-id="<?php echo $admin['id']; ?>"><?php echo $admin['AdminName']; ?></a>
                                            </td>
                                         
                                            <td>
                                                <?php echo $admin['department']; ?>
                                            </td>
                                            <td>
                                                <?php echo $admin['ext']; ?>
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

        <div class="modal fade" id="admin_edit_modal" tabindex="-1" role="dialog" aria-labelledby="AdminDetails" aria-hidden="true">
            <div class="modal-dialog modal-md" id="admin_edit_body">

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

<script>
    $('#admin_table').dataTable({
        "paging": true,
        "searching": true,
        "responsive": true,
        "columnDefs": [
            { "responsivePriority": 1, "targets": 0 },
            { "responsivePriority": 2, "targets": -1 }
        ]
    });

    $(document).on("click" , ".show_password" , function() {
        $( this ).children('i').toggleClass( "fa-eye-slash" );
        var n = $("#password").val();
        var target = $(this).attr('data-password');
        var control = $('#'+target).attr('type');
        if (control == 'text') {
            $('#'+target).attr('type', 'password');
        } else {
            $('#'+target).attr('type', 'text');
        }
    });

    // $(document).on("click" , "#edit-admin" , function() {
    //
    //     var admin_id = $(this).attr('data-id');
    //     $.ajax({
    //         url: admin_url+'edit_admin',
    //         type: 'POST',
    //         data: { admin_id : admin_id},
    //         dataType:'json',
    //         success:function(status){
    //             if(status.msg=='success'){
    //                 $('#admin_edit_body').html(status.response);
    //                 $('#admin_edit_modal').modal('show');
    //             }
    //             else if(status.msg == 'error'){
    //                 toastr.error(status.response);
    //             }
    //         }
    //     });
    // });

    $(document).on('click', '.delete-btn', function (event) {

        var admin_id = $(this).attr('data-id');

        swal({
                title: "Are you sure?",
                text: "You want to delete this admin!",
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
                        url: admin_url+'delete_admin',
                        type:'post',
                        data:{ admin_id : admin_id },
                        dataType:'json',
                        success:function(status){

                            if(status.msg=='success'){
                                swal({title: "Success!", text: status.response, type: "success"},
                                    function(){
                                        location.reload();
                                    });

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

</script>


</body>
</html>

