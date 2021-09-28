<?php $this->load->view('common/header'); ?>
<section id="page-title" class="dark contact_banner">

    <div class="container clearfix">
        <div class="breadcrumb_text text-center">
            <h1 class="text-light">CONTACT US</h1>
            <div class="top_button text-center mt-1">
                <a class="button" href="<?php echo base_url(); ?>quote" target="_blank">GET A QUOTE</a>
            </div>
        </div>
    </div>

</section>

<section class="content_section contact_us_page">
    <div class="content-wrap">
        <div class="container clearfix">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="plans_warranty_text text-left left-title contact_title pr6 pr0-xs pr0-sm">
                        <h1>
                            Have Questions? We Have Answers!
                        </h1>
                        <p>
                            Thanks for your interest in Regal Home Warranty . Our friendly team of Client Care Specialists is standing by to answer your questions and guide you every step of the way. To get in touch, just fill out the form below.
                        </p>
                    </div>
                </div>
                <div class="col-md-12 contact_area">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-12 col">
                            <div class="contact mr0-sm">
                                <div class="form_title">
                                    <h3>
                                        CONTACT US FORM
                                    </h3>
                                </div>
                                <form id="contactus_form">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 pr1 pr_l0-xs-2 pr_l0-sm-2">

                                            <input type="text" class="form-control form_focus" name="full_name" id="full_name" placeholder="Full Name">

                                        </div>
                                        <div class="col-lg-6 col-md-6 pl1 pr_l0-xs-2 pr_l0-sm-2">

                                            <input type="text" class="form-control form_focus" name="company" id="company" placeholder="Company">

                                        </div>
                                        <div class="col-lg-6 col-md-6 pr1 pr_l0-xs-2 pr_l0-sm-2">

                                            <input type="number" min="0" class="form-control form_focus" name="phone_no" id="phone_no" placeholder="Cell Phone">

                                        </div>
                                        <div class="col-lg-6 col-md-6 pl1 pr_l0-xs-2 pr_l0-sm-2">

                                            <input type="email" class="form-control form_focus" name="email_address" id="email_address" placeholder="Email Address">

                                        </div>
                                        <div class="col-lg-6 col-md-6 pr1 pr_l0-xs-2 pr_l0-sm-2">

                                            <input type="text" maxlength="255" class="form-control form_focus" name="home_address" id="home_address" placeholder="Street Address">

                                        </div>
                                        <div class="col-lg-6 col-md-6 pl1 pr_l0-xs-2 pr_l0-sm-2">

                                            <input type="text" maxlength="255" class="form-control form_focus" name="home_city" id="home_city" placeholder="City">

                                        </div>
                                        <div class="col-lg-6 col-md-6 pr1 pr_l0-xs-2 pr_l0-sm-2">

                                            <input type="text" maxlength="2" class="form-control form_focus" name="home_state" id="home_state" placeholder="State">

                                        </div>
                                        <div class="col-lg-6 col-md-6 pl1 pr_l0-xs-2 pr_l0-sm-2">

                                            <input type="number" min="0" maxlength="255" class="form-control form_focus" name="home_zip" id="home_zip" placeholder="Zipcode">

                                        </div>
                                        <div class="col-lg-12 col-md-12 pr_l0-xs-2 pr_l0-sm-2">
                                            <div class="form_text_area">
                                                <textarea class="form-control form_focus" name="comment" id="comment" placeholder="Comments"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 pt4 pr_l0-xs-2 pr_l0-sm-2">
                                            <button type="button" name="signup" class="button btn_blue btn_contact_us">SUBMIT INQUIRY</button>
<!--                                            <input type="button" name="signup" class="button btn_blue btn_contact_us" value="SUBMIT INQUIRY">-->
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-12 col">
                            <div class="contact_address pl0-sm">
                                <div class="address_logo">
                                    &nbsp
                                </div>
                                <div class="address_title">
                                    <h2>
                                        CONTACT INFO
                                    </h2>
                                </div>
                                <div class="address_text">
                                    <h4>
                                        Toll Free:
                                    </h4>
                                    <p class="toll_text">
                                        <a href="tel:1-860-777-0204">
                                            1-860-777-0204
                                        </a>
                                    </p>
                                    <h4>
                                        General Inquiries:
                                    </h4>
                                    <p>
                                        info (at) <a href="<?php echo base_url(); ?>">regalhomewarranty.com</a>
                                    </p>
                                    <h4>
                                        Contractor Relations:
                                    </h4>
                                    <p>
                                        vendors (at) <a href="<?php echo base_url(); ?>">regalhomewarranty.com</a>
                                    </p>
                                    <h4>
                                        Sales Department:
                                    </h4>
                                    <p>
                                        sales (at) <a href="<?php echo base_url(); ?>">regalhomewarranty.com</a>
                                    </p>
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
    $(document).on('click', '.btn_contact_us', function () {
        $('.btn_contact_us').html('SUBMIT INQUIRY <i class="icon-line-loader icon-spin nomargin"></i>').attr('disabled', true).css('opacity', '0.5');
        var value = new FormData( $("#contactus_form")[0] );
        $.ajax({
            url:base_url+'contactus/contact_us',
            type:'post',
            data:value,
            processData: false,
            contentType: false,
            dataType:'json',
            success:function(status){
                if(status.msg=='success'){
                    toastr.success(status.response, 'Success');
                    $('#contactus_form')[0].reset();
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                }
                else if(status.msg == 'error'){
                    $('.btn_contact_us').html('SUBMIT INQUIRY').removeAttr('disabled').css('opacity', '1');
                    toastr.error(status.response, 'Error');
                }
            }
        });
    });

</script>
