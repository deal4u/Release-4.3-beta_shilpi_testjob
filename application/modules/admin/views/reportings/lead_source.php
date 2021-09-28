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
                <h2>Reportings</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="<?php echo admin_url(); ?>">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">
                        <strong>Reportings</strong>
                    </li>
                </ol>
            </div>
        </div>
        <?php if (get_session('admin_type') == 1 || (get_session('admin_type') == 2 && get_session('admin_permissions')['miscellaneous'] != 'N/A' && isset(get_session('admin_permissions')['miscellaneous']->nsla_calender))) { ?>
            <div class="wrapper wrapper-content animated fadeInRight pb-0">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox m-0">
                            <div class="ibox-content ibox-content pt-4 pb-2">
                                <div class="search_customer">
                                    <form role="form" class="form" id="search_customer" method="GET" action="<?php echo admin_url(); ?>reportings/search_customer">
                                        <div class="row">
                                            <div class="col-md-3 col-sm-12">
                                                <div class="form-group">
                                                    <label>Select Source</label>
                                                    <select class="form-control" name="source">
                                                        <option selected value="">Lead Source</option>
                                                        <?php foreach (get_leadsource() as $source){ ?>
                                                            <option value="<?php echo $source['id']; ?>" <?php if(@$param['source']){ if ($param['source']==$source['id']){ ?> selected <?php } } ?>><?php echo $source['name']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-12">
                                                <div class="form-group">
                                                    <label>Start Date</label>
                                                    <input class="form-control" type="text" placehoder="Start Date" name="startdate" id="startdate" <?php if(@$param['startdate']) { ?> value="<?php echo $param['startdate']; ?>" <?php } ?> />
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-12">
                                                <div class="form-group">
                                                    <label>End Date</label>
                                                    <input class="form-control" type="text" placehoder="End Date" name="enddate" id="enddate" <?php if(@$param['enddate']) { ?> value="<?php echo $param['enddate']; ?>" <?php } ?> />
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-12">
                                                <div class="form-group" style="padding-top: 26px">
                                                    <button type="submit" class="btn btn-block btn btn-primary"> <i class="fa fa-search"></i> Search</button>
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
        <?php } ?>

        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Reportings</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table id="customers_table" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>Referrer</th>
                                        <th>Leads</th>
                                        <th>Sales</th>
                                        <th>Average Sale (All)</th>
                                        <th>Total Gross</th>
                                        <th>Cost per lead</th>
                                        <th>Total lead Cost</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $leads = 0;
                                    $sales = 0;
                                    $total_sales = 0;
                                    foreach ($sources as $source) { ?>
                                        <tr class="gradeX">
                                            <td>
                                                <?php echo $source['source']['name']; ?>
                                            </td>
                                            <td>
                                                <?php
                                                if (isset($source['customer_count'])){
                                                    echo $source['customer_count'];
                                                    $leads = $leads + $source['customer_count'];
                                                } ?>
                                            </td>
                                            <td>
                                                <?php
                                                if (isset($source['total'])){
                                                    echo '$'.$source['total'];
                                                    $sales = $sales + $source['total'];
                                                } ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($source['customer_count'] > 0){
                                                echo round($source['total']/$source['customer_count'],2);
                                                } ?>
                                            </td>
                                            <td>
                                                <?php
                                                echo '$'.$source['net_total'];
                                                $total_sales = $total_sales + $source['net_total'];
                                                ?>
                                            </td>
                                            <td>
                                                <?php echo '$'.$source['source']['cost']; ?>
                                            </td>
                                            <td>
                                                <?php
                                                echo '$'.$source['source']['cost']*$source['customer_count']; ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <p><strong>Leads Total:</strong> <span><?php echo $leads; ?></span></p>
                                    <p><strong>Sales from Leads Total:</strong> <span><?php echo '$'.$sales; ?></span></p>
                                    <p><strong>All Gross:</strong> <span><?php echo '$'.$total_sales; ?></span></p>
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
    $('#customers_table').dataTable({
        "paging": true,
        "searching": true,
        "responsive": true,
        "columnDefs": [
            { "responsivePriority": 1, "targets": 0 },
            { "responsivePriority": 2, "targets": -1 }
        ]
    });


    $("#startdate").datepicker({
        todayBtn:  1,
        autoclose: true,
    }).on('changeDate', function (selected) {
        var minDate = new Date(selected.date.valueOf());
        $('#enddate').datepicker('setStartDate', minDate);
    });

    $("#enddate").datepicker()
        .on('changeDate', function (selected) {
            var maxDate = new Date(selected.date.valueOf());
            $('#startdate').datepicker('setEndDate', maxDate);
        });
</script>
