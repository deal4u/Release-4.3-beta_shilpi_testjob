<?php $this->load->view('common/header'); ?>
<link href="<?php echo base_url(); ?>assets/select2/css/select2.min.css" rel="stylesheet">
<section id="page-title" class="dark contractors_banner">

    <div class="container clearfix">
        <div class="breadcrumb_text text-center">
            <h1 class="text-light">CONTRACTORS</h1>
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
                                CONTRACTORS
                            </h1>
                        </div>
                        <ul class="plan_menu_list">
                            <li>
                                <a href="<?php echo base_url(); ?>contractors">Why RHW</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url(); ?>servicing">Servicing Guidelines</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url(); ?>service-provider">Service Contractor Reviews</a>
                            </li>
                            <li>
                                <a class="active_page" href="<?php echo base_url(); ?>become-contractor">Become a Service Contractor</a>
                            </li>
                            <li>
                                <a href="<?php echo admin_url(); ?>" target="_blank">Contractor Login</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9 col-md-9">
                    <div class="plans_warranty pl2">
                        <div class="plans_warranty_text text-left left-title contractor_heading">
                            <h1>
                                Become a Service Provider
                            </h1>
                            <h2 class="sub-title">
                                Service Contractor Application
                            </h2>
                            <p>
                                Please complete the registration form below and a Contractor Relations Representative will contact you shortly.
                            </p>
                        </div>
                        <div class="service_contract">
                            <div class="arrow_list_area contact contract_area">
                                <h3 class="arrow_title">
                                    Application
                                </h3>
                                <form id="contractor_form">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 pr1 pr_l0-xs-2 pr_l0-sm-2">

                                            <input type="text" class="form-control form_focus" name="company" id="company" placeholder="Company Name">

                                        </div>
                                        <div class="col-lg-6 col-md-6 pl1 pr_l0-xs-2 pr_l0-sm-2">

                                            <input type="text" class="form-control form_focus" name="name" id="name" placeholder="Contact Name">

                                        </div>
                                        <div class="col-lg-6 col-md-6 pr1 pr_l0-xs-2 pr_l0-sm-2">

                                            <input type="email" class="form-control form_focus" name="email" id="email" placeholder="Email Address">

                                        </div>
                                        <div class="col-lg-6 col-md-6 pl1 pr_l0-xs-2 pr_l0-sm-2">

                                            <input type="number" min="0" class="form-control form_focus" name="phone" id="phone" placeholder="Phone Number">

                                        </div>

                                        <div class="col-lg-6 col-md-6 pr1 pr_l0-xs-2 pr_l0-sm-2">

                                            <input type="number" min="0" class="form-control form_focus" name="fax" id="fax" placeholder="Fax Number">

                                        </div>
                                        <div class="col-lg-6 col-md-6 pl1 pr_l0-xs-2 pr_l0-sm-2">

                                            <input type="text" maxlength="255" class="form-control form_focus" name="address" id="address" placeholder="Street Address">

                                        </div>
                                        <div class="col-lg-6 col-md-6 pr1 pr_l0-xs-2 pr_l0-sm-2">

                                            <input type="text" maxlength="255" class="form-control form_focus" name="city" id="city" placeholder="City">

                                        </div>
                                        <div class="col-lg-6 col-md-6 pl1 pr_l0-xs-2 pr_l0-sm-2">

                                            <input type="text" maxlength="2" class="form-control form_focus" name="state" id="state" placeholder="State">

                                        </div>
                                        <div class="col-lg-6 col-md-6 pr1 pr_l0-xs-2 pr_l0-sm-2">

                                            <input type="number" min="0" maxlength="255" class="form-control form_focus" name="zip_code" id="zip_code" placeholder="Zipcode">

                                        </div>

                                        <div class="col-lg-6 col-md-6 pl1 pr_l0-xs-2 pr_l0-sm-2">

                                            <select class="form-control" multiple="multiple" name="zip_codes_serviced[]" id="tag_select">
                                            </select>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="input_tick">
                                                <span>Trades You Service (check all that apply)</span>
                                                <div class="form-check check_boxes">
                                                    <label class="form-check-label" for="check1">
                                                        <input type="checkbox" class="form-check-input" id="check1" name="opt_service[]" value="1"><span>HVAC</span>
                                                    </label>
                                                </div>
                                                <div class="form-check check_boxes">
                                                    <label class="form-check-label" for="check2">
                                                        <input type="checkbox" class="form-check-input" id="check2" name="opt_service[]" value="2"><span>Appliances</span>
                                                    </label>
                                                </div>
                                                <div class="form-check check_boxes">
                                                    <label class="form-check-label" for="check3">
                                                        <input type="checkbox" class="form-check-input" id="check3" name="opt_service[]" value="3"><span>Plumbing</span>
                                                    </label>
                                                </div>
                                                <div class="form-check check_boxes">
                                                    <label class="form-check-label" for="check4">
                                                        <input type="checkbox" class="form-check-input" id="check4" name="opt_service[]" value="4"><span>Electrical</span>
                                                    </label>
                                                </div>
                                                <div class="form-check check_boxes">
                                                    <label class="form-check-label" for="check5">
                                                        <input type="checkbox" class="form-check-input" id="check5" name="opt_service[]" value="5"><span>Garage Door Openers</span>
                                                    </label>
                                                </div>
                                                <div class="form-check check_boxes">
                                                    <label class="form-check-label" for="check6">
                                                        <input type="checkbox" class="form-check-input" id="check6" name="opt_service[]" value="6"><span>Pool & Spa</span>
                                                    </label>
                                                </div>
                                                <div class="form-check check_boxes">
                                                    <label class="form-check-label" for="check7">
                                                        <input type="checkbox" class="form-check-input" id="check7" name="opt_service[]" value="7"><span>Roofing</span>
                                                    </label>
                                                </div>
                                                <div class="form-check check_boxes">
                                                    <label class="form-check-label" for="check8">
                                                        <input type="checkbox" class="form-check-input" id="check8" name="opt_service[]" value="8"><span>Central Vacuum Systems</span>
                                                    </label>
                                                </div>
                                                <div class="form-check check_boxes">
                                                    <label class="form-check-label" for="check9">
                                                        <input type="checkbox" class="form-check-input" id="check9" name="opt_service[]" value="9"><span>Well Pumps</span>
                                                    </label>
                                                </div>
                                                <div class="form-check check_boxes">
                                                    <label class="form-check-label" for="check10">
                                                        <input type="checkbox" class="form-check-input" id="check10" name="opt_service[]" value="10"><span>Septic System & Pumping</span>
                                                    </label>
                                                </div>
                                                <div class="form-check check_boxes">
                                                    <label class="form-check-label" for="check11">
                                                        <input type="checkbox" class="form-check-input" id="check11" name="opt_service[]" value="11"><span>Sprinkler System</span>
                                                    </label>
                                                </div>
                                                <div class="form-check check_boxes">
                                                    <label class="form-check-label" for="check12">
                                                        <input type="checkbox" class="form-check-input" id="check12" name="opt_service[]" value="12"><span>Drywall</span>
                                                    </label>
                                                </div>
                                                <div class="form-check check_boxes">
                                                    <label class="form-check-label" for="check13">
                                                        <input type="checkbox" class="form-check-input" id="check13" name="opt_service[]" value="13"><span>Garbage Disposal</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 col-md-12 pt4 pr_l0-xs-2">
<!--                                            <input type="button" name="signup" class="button btn_blue submit_btn" value="Submit Application">-->
                                            <button type="button" name="signup" class="button btn_blue submit_btn">Submit Application</button>
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
</section>
<?php $this->load->view('common/footer'); ?>
<script src="<?php echo base_url(); ?>assets/select2/js/select2.full.min.js"></script>
<script src="<?php echo base_url(); ?>assets/select2/js/select2.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#tag_select").select2({
            placeholder: 'Zip Codes Serviced',
            tags: true,
            tokenSeparators: [',', ' ']
        });
    });

    $(document).on('click', '.submit_btn', function () {
        $('.submit_btn').html('Submit Application <i class="icon-line-loader icon-spin nomargin"></i>').attr('disabled', true).css('opacity', '0.5');
        var value = new FormData( $("#contractor_form")[0] );
        $.ajax({
            url:base_url+'become_contractor/add_contractor',
            type:'post',
            data:value,
            processData: false,
            contentType: false,
            dataType:'json',
            success:function(status){
                if(status.msg=='success'){
                    toastr.success(status.response, 'Success');
                    $('#contractor_form')[0].reset();
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                }
                else if(status.msg == 'error'){
                    $('.submit_btn').html('Submit Application').removeAttr('disabled').css('opacity', '1');
                    toastr.error(status.response, 'Error');
                }
            }
        });
    });

</script>
