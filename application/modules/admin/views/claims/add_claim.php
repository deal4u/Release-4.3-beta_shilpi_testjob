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
                    <h2>Claims</h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?php echo admin_url(); ?>">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <strong>Add Claim</strong>
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
                                                <form method="post" id="save-claim">
                                                 <!--  <input type="text" name="customer_id" class="form-control" value="<?php// echo @$id; ?>"> -->
                                                 <div class="form_section">
                                                    <h2 class="mb-4">Claim Details</h2>
                                                    <div class="row">
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Customer</label>
                                                                <select data-placeholder="Choose a Country..." class="select-customer form-control"  tabindex="2" name="customer">
                                                                    <?php foreach (get_customers() as $customer){ ?>
                                                                        <option value="<?php echo $customer['id']; ?>"<?php if(@$id==$customer['id']){ ?> selected <?php } ?>><?php echo $customer['first_name'].' '.$customer['last_name']; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Item</label>
                                                                <select class="form-control" name="item" id="item_wrap">
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Problem</label>
                                                                <input type="text" placeholder="Problem" class="form-control" name="problem" required="true">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group" id="data_8">
                                                                <label>Last working time</label>
                                                                <div class="input-group date">
                                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="last_working" class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Make/Model/Serial</label>
                                                                <input type="text" class="form-control" name="make" required="true">
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                            <div class="form-group" id="data_9">
                                                                <label>Last Time Serviced</label>
                                                                <div class="input-group date">
                                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" name="last_serviced" class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label>Description</label>
                                                                <textarea class="form-control" name="description"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="hr-line-dashed"></div>
                                                </div>
                                                <div class="form_section">
                                                    <div class="row">
                                                        <div class="btn_submit text-center pull-right col">
                                                            <button class="btn btn-primary btn-lg m-t-n-xs float-right submit-claim" type="submit"><strong>Save</strong></button>
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
    $(document).ready(function () {
        $('.select-customer').select2();

        var cur_date = new Date();
        $('#data_8 .input-group.date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true,
            format: 'yyyy-mm-dd',
            defaultDate: '2019-07-02'
        });

        $('#data_8 .input-group.date').datepicker('setDate', cur_date );

        $('#data_9 .input-group.date').datepicker({
            todayBtn: "linked",
            keyboardNavigation: false,
            forceParse: false,
            calendarWeeks: true,
            autoclose: true,
            format: 'yyyy-mm-dd'
        });

        $('#data_9 .input-group.date').datepicker('setDate', cur_date );

        $('#save-claim').submit(function (e) {
            e.preventDefault();
            var btn = $('.submit-claim').ladda();
            btn.ladda('start');
            var value = new FormData( $("#save-claim")[0] );
            var customer = $('.select-customer').val();

            $.ajax({
                url:admin_url+'claims/save',
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
                            $(location).attr('href', admin_url+"claims");
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
    });
</script>

<script>
    $(document).on("change" , ".select-customer" , function() {
        $("#item_wrap").attr('disabled',true);
        var id = $(this).val();
        $.ajax({
            url: admin_url+'claims/get_claim_item_covered',
            type: 'POST',
            data: {id : id},
            dataType:'json',
            cache: false,
            success:function(response){
                var plan_name = response.plan_name.length;
                var coverages = response.opt_coverages.length;
                var plan = response.opt;
                $("#item_wrap").empty();
                $('select#item_wrap').append('<option value=""> Select Item </option>');
                for( var i = 0; i<plan_name; i++){
                    var meta_key = response.plan_name[i]['meta_key'];
                    var meta_content = response.plan_name[i]['meta_content'];
                    $("#item_wrap").append("<option value='"+plan+'-'+meta_key+"'>"+meta_content+"</option>");
                }

                for( var k = 0; k<coverages; k++){
                    var meta_key = response.opt_coverages[k]['meta_key'];
                    var meta_content = response.opt_coverages[k]['meta_content'];
                    $("#item_wrap").append("<option value='o-"+meta_key+"'>"+meta_content+"</option>");
                }
                $("#item_wrap").attr('disabled',false);
            },
        });
    });

    $(document).ready(function () {
        $("#item_wrap").attr('disabled',true);
        var id = $('.select-customer').val();
        $.ajax({
            url: admin_url+'claims/get_claim_item_covered',
            type: 'POST',
            data: {id : id},
            dataType:'json',
            cache: false,
            success:function(response){
                var plan_name = response.plan_name.length;
                var coverages = response.opt_coverages.length;
                var plan = response.opt;
                $("#item_wrap").empty();
                $('select#item_wrap').append('<option value=""> Select Item </option>');
                for( var i = 0; i<plan_name; i++){
                    var meta_key = response.plan_name[i]['meta_key'];
                    var meta_content = response.plan_name[i]['meta_content'];
                    $("#item_wrap").append("<option value='"+plan+'-'+meta_key+"'>"+meta_content+"</option>");
                }

                for( var k = 0; k<coverages; k++){
                    var meta_key = response.opt_coverages[k]['meta_key'];
                    var meta_content = response.opt_coverages[k]['meta_content'];
                    $("#item_wrap").append("<option value='o-"+meta_key+"'>"+meta_content+"</option>");
                }
                $("#item_wrap").attr('disabled',false);
            },
        });
    });
</script>

</body>
</html>
