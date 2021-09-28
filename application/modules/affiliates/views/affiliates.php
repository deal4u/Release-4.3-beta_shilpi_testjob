<?php $this->load->view('common/header'); ?>
<section id="page-title" class="dark affili_banner">
    <div class="container clearfix">
        <div class="breadcrumb_text text-center">
            <h1 class="text-light">AFFILIATES</h1>
            <div class="top_button text-center mt-1">

            </div>
        </div>
    </div>
</section>
<section class="content_section">
    <div class="content-wrap">
        <div class="container clearfix">
            <div class="row">
                <div class="col-lg-3 col-md-3">
                    <div class="plans_menu text-right pr6 pb7 pr0-xs">
                        <div class="plans_menu_title">
                            <h1>
                                CAREERS
                            </h1>
                        </div>
                        <ul class="plan_menu_list">
                            <li>
                                <a class="active_page" href="<?php echo base_url(); ?>affiliates">Affiliates</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url(); ?>careers">Careers</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12 col">
                    <div class="plans_warranty pl2">
                        <div class="plans_warranty_text text-left left-title">
                            <h1>
                                Affiliate Program
                            </h1>
                            <p>Looking to convert your website traffic into commission? If so please complete the registration form below to join our team of affiliate marketers.</p>
                            <!--  -->
                            <div class="contact_area">
                                <div class="contact nomargin">
                                    <div class="form_title">
                                        <h3>
                                            Application
                                        </h3>
                                    </div>
                                    <form id="application_form">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 pr1 pr_l0-xs-2 pr_l0-sm-2">
                                                <input type="text" class="form-control form_focus" name="first_name" id="first_name" placeholder="First Name">
                                            </div>
                                            <div class="col-lg-6 col-md-6 pl1 pr_l0-xs-2 pr_l0-sm-2">
                                                <input type="text" class="form-control form_focus" name="last_name" id="last_name" placeholder="Last Name">
                                            </div>
                                            <div class="col-lg-6 col-md-6 pr1 pr_l0-xs-2 pr_l0-sm-2">
                                                <input type="text" class="form-control form_focus" name="company" id="company" placeholder="Company Name">
                                            </div>
                                            <div class="col-lg-6 col-md-6 pl1 pr_l0-xs-2 pr_l0-sm-2">
                                                <input type="email" class="form-control form_focus" name="email" id="email" placeholder="Email Address">
                                            </div>
                                            <div class="col-lg-6 col-md-6 pr1 pr_l0-xs-2 pr_l0-sm-2">
                                                <input type="number" min="0" class="form-control form_focus" name="phone" id="phone" placeholder="Phone Number">
                                            </div>
                                            <div class="col-lg-6 col-md-6 pl1 pr_l0-xs-2 pr_l0-sm-2">
                                                <input type="number" min="0" class="form-control form_focus" name="fax" id="fax" placeholder="Fax Number">
                                            </div>
                                            <div class="col-lg-6 col-md-6 pr1 pr_l0-xs-2 pr_l0-sm-2">
                                                <input type="text" maxlength="255" class="form-control form_focus" name="address" id="address" placeholder="Street Address">
                                            </div>
                                            <div class="col-lg-6 col-md-6 pl1 pr_l0-xs-2 pr_l0-sm-2">
                                                <input type="text" maxlength="255" class="form-control form_focus" name="city" id="city" placeholder="City">
                                            </div>
                                            <div class="col-lg-6 col-md-6 pr1 pr_l0-xs-2 pr_l0-sm-2">
                                                <input type="text" maxlength="2" class="form-control form_focus" name="state" id="state" placeholder="State">
                                            </div>
                                            <div class="col-lg-6 col-md-6 pl1 pr_l0-xs-2 pr_l0-sm-2">
                                                <input type="number" min="0" maxlength="255" class="form-control form_focus" name="zip_code" id="zip_code" placeholder="Zipcode">
                                            </div>
                                            <div class="col-lg-12 col-md-12 pt4 pr_l0-xs-2 pr_l0-sm-2">
<!--                                                <input type="button" name="signup" class="button btn_blue submit_btn" value="SUBMIT APPLICATION">-->
                                                <button type="button" name="signup" class="button btn_blue submit_btn">SUBMIT APPLICATION</button>
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
</section>
<?php $this->load->view('common/footer'); ?>

<script type="text/javascript">
    $(document).on('click', '.submit_btn', function () {
        $('.submit_btn').html('SUBMIT APPLICATION <i class="icon-line-loader icon-spin nomargin"></i>').attr('disabled', true).css('opacity', '0.5');
        var value = new FormData( $("#application_form")[0] );
        $.ajax({
            url:base_url+'affiliates/add_affiliate',
            type:'post',
            data:value,
            processData: false,
            contentType: false,
            dataType:'json',
            success:function(status){
                if(status.msg=='success'){
                    toastr.success(status.response, 'Success');
                    $('#application_form')[0].reset();
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                }
                else if(status.msg == 'error'){
                    $('.submit_btn').html('SUBMIT APPLICATION').removeAttr('disabled').css('opacity', '1');
                    toastr.error(status.response, 'Error');
                }
            }
        });
    });

</script>
