<!DOCTYPE html>
<html>

<head>
    <?php $this->load->view('common/admin_header'); ?>

    <link href="<?php echo base_url(); ?>assets/admin_assets/css/datatable/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/admin_assets/css/datatable/responsive.bootstrap4.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/admin_assets/css/daterangepicker.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css" rel="stylesheet">

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
                <h2>Payments</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="<?php echo admin_url(); ?>">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item active">
                        <strong>Payments</strong>
                    </li>
                </ol>
            </div>
        </div>

        <div class="wrapper wrapper-content animated fadeInRight pb-0">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox m-0">
                        <div class="ibox-content ibox-content pt-4 pb-2">
                            <div class="search_customer">
                                <form role="form" class="form" method="GET" action="<?php echo admin_url(); ?>payments/filter_payments">
                                    <div class="row">
                                        <div class="col-md-3 col-sm-12">
                                            <div class="form-group">
                                                <label>Agents</label>
                                                <select class="form-control" name="agent" id="selected-agent">
                                                    <option selected value="">Select Agent</option>
                                                    <?php foreach (get_agent() as $agent){ ?>
                                                        <option value="<?php echo $agent['id']; ?>" <?php if(@$param['agent']){ if ($param['agent']==$agent['id']){ ?> selected <?php } } ?>><?php echo $agent['FirstName'].' '.$agent['LastName']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-12">
                                            <div class="form-group">
                                                <label>Status</label>
                                                <select class="form-control" name="status" id="selected-status">
                                                    <option selected value="">Select Status</option>
                                                    <option value="1" <?php if(@$param['status']){ if ($param['status'] == 1){ ?> selected <?php } } ?>>Approved</option>
                                                    <option value="2" <?php if(@$param['status']){ if ($param['status'] == 2){ ?> selected <?php } } ?>>Declined</option>
                                                    <option value="3" <?php if(@$param['status']){ if ($param['status'] == 3){ ?> selected <?php } } ?>>Error</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-sm-12">
                                            <div class="form-group">
                                                <label>Date</label>
                                                <input class="form-control" id="demo" type="text" name="daterange" data-start="" data-end="" <?php if(@$param['startdate'] && @$param['startdate'] != '') { ?> value="<?php echo $param['startdate']; ?> - <?php echo $param['enddate']; ?>" <?php } ?> />
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

        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5>Payments</h5>
                        </div>
                        <div class="ibox-content">
                            <div class="table-responsive">
                                <table id="payments_table" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Charge Date</th>
                                        <th>REP</th>
                                        <th>Customer</th>
                                        <th>Card #</th>
                                        <th>Transaction Id</th>
                                        <th>Amount</th>
                                        <th>Response</th>
                                        <th>Type</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $i=1; foreach ($payments as $payment) { ?>
                                        <tr class="gradeX">
                                            <td> <?php echo $i; ?> </td>
                                            <td> <?php echo date('F jS, Y - h:i a' ,strtotime($payment['created_at'])); ?> </td>
                                            <td> <?php if ($payment['rep'] == 0){ ?>
                                                    System
                                                <?php }else{
                                                    $staff = get_staff_name($payment['rep']);
                                                    if (!empty($staff)){
                                                        echo $staff['FirstName'].' '.$staff['LastName'];
                                                    }
                                                } ?>
                                            </td>
                                            <td>
                                                <?php $customer=get_customers($payment['customer_id']); ?>
                                                <a href="<?php echo admin_url(); ?>customers/edit/<?php echo $payment['customer_id']; ?>" class="insert_log" id="<?php echo $payment['customer_id']; ?>"><?php echo $customer['first_name'].' '.$customer['last_name']; ?></a>
                                            </td>
                                            <td>
                                                <?php if (!empty($payment['card_id'])){
                                                    $payment_card = get_customer_card($payment['customer_id'], array('id'=>$payment['card_id']));
                                                    echo maskCard($payment_card['card_num']);
                                                } ?>
                                            </td>
                                            <td>
                                                <?php echo $payment['transaction_id']; ?>
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
                                                }elseif($payment['status'] == 2 || $payment['status'] == 4){
                                                    $label_class = 'warning';
                                                    $label = 'Declined';
                                                }elseif ($payment['status'] == 3){
                                                    $label_class = 'danger';
                                                    $label = 'Error';
                                                }else{
                                                    $label_class = 'warning';
                                                    $label = 'Declined';
                                                } ?>
                                                <span class="label label-<?php echo $label_class; ?>"><?php echo $label; ?></span>
                                            </td>
                                            <td>
                                                <section class="progress-demo">
                                                    <?php if ($payment['type'] == 1 && $payment['status'] == 1){ ?>
                                                        <button class="ladda-button btn btn-primary refund_payment" data-id="<?php echo $payment['id']; ?>"> Refund</button>
                                                        <button class="ladda-button btn btn-primary void_payment" data-style="expand-right" data-id="<?php echo $payment['id']; ?>"> Void</button>
                                                    <?php } ?>
                                                </section>
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
        <?php $this->load->view('common/admin_footer'); ?>
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
    </div>

</div>
<?php $this->load->view('common/admin_scripts'); ?>

<!-- data tables  -->
<script src="<?php echo base_url(); ?>assets/admin_assets/js/datatable/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin_assets/js/datatable/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin_assets/js/datatable/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin_assets/js/datatable/responsive.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin_assets/js/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin_assets/js/daterangepicker.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.print.min.js"></script>

<script>
    $('#payments_table').dataTable({
        "paging": true,
        "searching": true,
        "responsive": true,
        "columnDefs": [
            { "responsivePriority": 1, "targets": 0 },
            { "responsivePriority": 2, "targets": -1 }
        ],
        dom: 'Bfrtip',
        buttons: [
            'copy', 'pdf', 'excel', 'print'
        ]
    });

    $('#demo').daterangepicker({
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        "linkedCalendars": false,
        "alwaysShowCalendars": true,
        "opens": "center"
    }, function(start, end, label) {
        // $('#demo').attr('data-start', start.format('YYYY-MM-DD'));
        // $('#demo').attr('data-end', end.format('YYYY-MM-DD'));
        // var customer = $('#selected-customer').val();
        // var status = $('#selected-status').val();
        // window.location.replace(admin_url + 'payments/filter_payments?startdate='+start.format('YYYY-MM-DD')+'&enddate='+end.format('YYYY-MM-DD')+'&customer='+customer+'&status='+status);
    });

    // $('#selected-agent').on('change',function () {
    //     var customer = $('#selected-agent').val();
    //     var status = $('#selected-status').val();
    //     var startdate = $('#demo').attr('data-start');
    //     if (startdate != ''){
    //         startdate = startdate.format('YYYY-MM-DD');
    //     }
    //     var enddate = $('#demo').attr('data-end');
    //     if (enddate != ''){
    //         enddate = enddate.format('YYYY-MM-DD');
    //     }
    //     window.location.replace(admin_url + 'payments/filter_payments?startdate='+startdate+'&enddate='+enddate+'&customer='+customer+'&status='+status);
    // });
    //
    // $('#selected-status').on('change',function () {
    //     var customer = $('#selected-customer').val();
    //     var status = $('#selected-status').val();
    //     var startdate = $('#demo').attr('data-start');
    //     if (startdate != ''){
    //         startdate = startdate.format('YYYY-MM-DD');
    //     }
    //     var enddate = $('#demo').attr('data-end');
    //     if (enddate != ''){
    //         enddate = enddate.format('YYYY-MM-DD');
    //     }
    //     window.location.replace(admin_url + 'payments/filter_payments?startdate='+startdate+'&enddate='+enddate+'&customer='+customer+'&status='+status);
    // });

    $(document).on('click', '.refund_payment', function () {
        var payment = $(this).attr('data-id');
        $('.payment_id').val(payment);
        $('.refund_amount').val('');
        $('#refund_modal').modal('show');
    });

    $(document).on('click', '.send_refund', function () {
        var btn = $('.send_refund').ladda();
        btn.ladda('start');
        var amount = $('.refund_amount').val();
        var id = $('.payment_id').val();
        if (amount == ''){
            btn.ladda('stop');
            toastr.error('Amount must not be empty');
        } else {
            $.ajax({
                url:admin_url+'payments/refund',
                type: 'POST',
                data: {id: id, amount: amount},
                dataType:'json',
                success:function(status){
                    if(status.msg=='success'){
                        btn.ladda('stop');
                        if (status.response != 1){
                            toastr.error("Request declined", 'Error');
                        } else {
                            toastr.success(status.response, 'Success');
                            setTimeout(function () {
                                location.reload();
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
                        data:{ id : payment },
                        dataType:'json',
                        success:function(status){

                            if(status.msg=='success'){
                                btn.ladda('stop');
                                if (status.response != 1){
                                    swal("Error", "Request Declined", "error");
                                } else {
                                    swal({title: "Success!", text: "Successful", type: "success"},
                                        function(){
                                            location.reload();
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

</script>


</body>
</html>