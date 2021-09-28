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
                <h2>Vendors</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="<?php echo admin_url(); ?>">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">
                        <strong>Vendors</strong>
                    </li>
                </ol>
            </div>
        </div>

        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Vendors</h5>
                            <?php if (get_session('admin_type') == 2 && get_session('admin_permissions')['vendors'] != 'N/A' && get_session('admin_permissions')['vendors']['add'] == 1){ ?>
                                <a href="<?php echo admin_url(); ?>vendors/add" class="btn btn-primary pull-right t_m_25 customer-btn"><i class='fa fa-plus'></i> Add Vendor</a>
                            <?php }elseif (get_session('admin_type') == 1){ ?>
                                <a href="<?php echo admin_url(); ?>vendors/add" class="btn btn-primary pull-right t_m_25 customer-btn"><i class='fa fa-plus'></i> Add Vendor</a>
                            <?php } ?>
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table id="vendors_table" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Company</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>City</th>
                                        <th>State</th>
                                        <th>Date</th>
                                        <?php if (get_session('admin_type') == 1 || (get_session('admin_type') == 2 && get_session('admin_permissions')['miscellaneous'] != 'N/A' && isset(get_session('admin_permissions')['miscellaneous']->status))) { ?>
                                            <th>Status</th>
                                        <?php } ?>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i=1; foreach ($vendors as $vendor) { ?>
                                        <tr class="gradeX">
                                            <td> <?php echo $i; ?> </td>
                                            <td>
                                                <a href="<?php echo admin_url(); ?>vendors/edit/<?php echo $vendor['id']; ?>"><?php echo $vendor['company']; ?></a>
                                            </td>
                                            <td>
                                                <?php echo $vendor['name']; ?>
                                            </td>
                                            <td>
                                                <?php echo $vendor['email']; ?>
                                            </td>
                                            <td>
                                                <?php echo $vendor['phone']; ?>
                                            </td>
                                            <td>
                                                <?php echo $vendor['city']; ?>
                                            </td>
                                            <td>
                                                <?php echo $vendor['state']; ?>
                                            </td>
                                            <td>
                                                <?php echo date('F jS, Y - h:i a' ,strtotime($vendor['created_at'])); ?>
                                            </td>
                                            <?php if (get_session('admin_type') == 1 || (get_session('admin_type') == 2 && get_session('admin_permissions')['miscellaneous'] != 'N/A' && isset(get_session('admin_permissions')['miscellaneous']->status))) { ?>
                                                <td>
                                                    <?php if($vendor['status'] == 1){
                                                        $label_class = 'primary';
                                                        $label = 'Active';
                                                    }else{
                                                        $label_class = 'danger';
                                                        $label = 'InActive';
                                                    } ?>
                                                    <span class="label label-<?php echo $label_class; ?>"><?php echo $label; ?></span>
                                                </td>
                                            <?php } ?>
                                            <td>
                                                <button type="button" class="ladda-button btn btn-success vendor-details" data-id="<?php echo $vendor['id']; ?>" data-style="expand-right">Details</button>

                                                <!--                                                        <button type="button" class="btn btn-warning vendor-claims" data-id="--><?php //echo $vendor['id']; ?><!--">Claims</button>-->

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
        <div class="modal fade" id="detail_modal" tabindex="-1" role="dialog" aria-labelledby="VendorDetail" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Vendor Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="detail_body">

                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="claim_modal" tabindex="-1" role="dialog" aria-labelledby="VendorClaim" aria-hidden="true">

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
    $('#vendors_table').dataTable({
        "paging": true,
        "searching": true,
        "responsive": true,
        "columnDefs": [
            { "responsivePriority": 1, "targets": 0 },
            { "responsivePriority": 2, "targets": -1 }
        ]
    });

    $('.vendor-details').on('click', function () {
        var vendor = $(this).attr('data-id');
        $.ajax({
            url:admin_url+'vendors/vendor_details',
            type: 'POST',
            data: {vendor: vendor},
            dataType:'json',
            success:function(status){
                if(status.msg=='success'){
                    $('#detail_body').html(status.response);
                    $('#detail_modal').modal('show');
                }
                else if(status.msg == 'error'){
                    toastr.error(status.response);
                }
            }
        });
    });


    $('.vendor-claims').on('click', function () {

        var vendor = $(this).attr('data-id');
        $.ajax({
            url:admin_url+'vendors/vendor_claims',
            type: 'POST',
            data: {vendor: vendor},
            dataType:'json',
            success:function(status){
                if(status.msg=='success'){
                    $('#claim_modal').html(status.response);
                    $('#claim_modal').modal('show');
                    setTimeout(function(){
                        fns();
                    }, 500);
                }
                else if(status.msg == 'error'){
                    toastr.error(status.response);
                }
            }


        });

    });

    function fns() {
        $('#claims_tableee').dataTable({
            "paging": true,
            "searching": true,
            "responsive": true,
            "columnDefs": [
                { "responsivePriority": 0, "targets": 0 },
                { "responsivePriority": 2, "targets": -1 }
            ]

        });
    }

</script>


</body>
</html>

