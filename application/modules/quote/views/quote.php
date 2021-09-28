<?php $this->load->view('common/header'); ?>
<section id="page-title" class="dark home_owner_banner">

    <div class="container clearfix">
        <div class="breadcrumb_text text-center">
            <h1 class="text-light">Quote</h1>
        </div>
    </div>
</section>
<section class="content_section quotebg">
    <div class="content-wrap">
        <div class="container clearfix">
            <div class="row nomargin">
                <div class="col-lg-4 col-md-4 col-sm-12 col nopadding">
                    <div class="quotereviews">
                        <div class="skew_bg"></div>
                        <h3>1 MONTH FREE!<sup>*</sup></h3>
                        <div class="review_wrap">
                            <div class="skew_bg"></div>
                            <img alt="" src="<?php echo base_url(); ?>assets/front/images/melissa.jpg">
                            <div class="r_testimonilas">
                                <h4>What Our Customers <span>are</span> Saying...</h4>
                                <h5>Austin,<span>Mexico</span></h5>
                                <p>
                                    "Found these guys through compare the market. Very straightforward to work with and the policy covers us in all the areas we needed. Not needed to make a claim thankfully but hope the support will be there should we need it"
                                </p>
                            </div>
                        </div>
                        <div class="logos">
                            <img alt="" src="<?php echo base_url(); ?>assets/front/images/30_days_guarantee.png">
                            <img alt="" src="<?php echo base_url(); ?>assets/front/images/google_rating.png">
                        </div>
                    </div>

                </div>
                <div class="col-lg-8 col-md-8 col-sm-12 col nopadding quote_from_right">
                    <div class="quote_from cus_section">
                        <h2>JUST <span> 1 STEP </span> AWAY FROM YOUR INSTANT QUOTE!</h2>
                        <section class="first_step">
                            <h2>Let's start with your information: </h2>
                            <form id="form-step1" method="post">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control form_focus required" name="FirstName" id="FirstName" value="<?php echo @$fname; ?>" placeholder="First Name" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control form_focus required" name="LastName" id="LastName" value="<?php echo @$lname; ?>" placeholder="Last Name"  required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control form_focus required email" name="email" id="email" value="<?php echo @$email; ?>" placeholder="Email Address"  required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <input type="tel" class="form-control form_focus required" name="HomePhone" id="HomePhone" value="<?php echo @$phone; ?>" placeholder="Home Phone"  required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <input type="tel" class="form-control form_focus" name="CellPhone" id="CellPhone" value="<?php echo @$cphone; ?>" placeholder="Cell Phone">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <input type="number" class="form-control form_focus required" name="zipcode" id="HomeZipCode" value="<?php echo @$zip; ?>" placeholder="Home Zip Code"  required>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <input type="tel" class="form-control form_focus" name="address" id="Address" value="<?php echo @$address; ?>" placeholder="Address">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control form_focus" name="city" id="City" value="<?php echo @$city; ?>" placeholder="City">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="form-group">
                                            <select id="state" name="state" class="form-control form_focus required" required>
                                                <option value="" disabled="" selected="">Select Your State</option>
                                                <option value="Alabama" <?php if (@$state=="Alabama"){ ?> selected <?php } ?>>Alabama</option>
                                                <option value="Alaska" <?php if (@$state=="Alaska"){ ?> selected <?php } ?>>Alaska</option>
                                                <option value="Arkansas" <?php if (@$state=="Arkansas"){ ?> selected <?php } ?>>Arkansas</option>
                                                <option value="Arizona" <?php if (@$state=="Arizona"){ ?> selected <?php } ?>>Arizona</option>
                                                <option value="California" disabled="disabled" <?php if (@$state=="California"){ ?> selected <?php } ?>>California</option>
                                                <option value="Colorado" <?php if (@$state=="Colorado"){ ?> selected <?php } ?>>Colorado</option>
                                                <option value="Connecticut" <?php if (@$state=="Connecticut"){ ?> selected <?php } ?>>Connecticut</option>
                                                <option value="Columbia" <?php if (@$state=="Columbia"){ ?> selected <?php } ?>>District of Columbia</option>
                                                <option value="Delaware" <?php if (@$state=="Delaware"){ ?> selected <?php } ?>>Delaware</option>
                                                <option value="Florida" <?php if (@$state=="Florida"){ ?> selected <?php } ?>>Florida</option>
                                                <option value="Georgia" <?php if (@$state=="Georgia"){ ?> selected <?php } ?>>Georgia</option>
                                                <option value="Hawaii" <?php if (@$state=="Hawaii"){ ?> selected <?php } ?>>Hawaii</option>
                                                <option value="Idaho" <?php if (@$state=="Idaho"){ ?> selected <?php } ?>>Idaho</option>
                                                <option value="Illinois" <?php if (@$state=="Illinois"){ ?> selected <?php } ?>>Illinois</option>
                                                <option value="Indiana" <?php if (@$state=="Indiana"){ ?> selected <?php } ?>>Indiana</option>
                                                <option value="Iowa" disabled="disabled" <?php if (@$state=="Iowa"){ ?> selected <?php } ?>>Iowa</option>
                                                <option value="Kansas" <?php if (@$state=="Kansas"){ ?> selected <?php } ?>>Kansas</option>
                                                <option value="Kentucky" <?php if (@$state=="Kentucky"){ ?> selected <?php } ?>>Kentucky</option>
                                                <option value="Louisiana" <?php if (@$state=="Louisiana"){ ?> selected <?php } ?>>Louisiana</option>
                                                <option value="Maine" <?php if (@$state=="Maine"){ ?> selected <?php } ?>>Maine</option>
                                                <option value="Maryland" <?php if (@$state=="Maryland"){ ?> selected <?php } ?>>Maryland</option>
                                                <option value="Massachusetts" <?php if (@$state=="Massachusetts"){ ?> selected <?php } ?>>Massachusetts</option>
                                                <option value="Michigan" <?php if (@$state=="Michigan"){ ?> selected <?php } ?>>Michigan</option>
                                                <option value="Minnesota" <?php if (@$state=="Minnesota"){ ?> selected <?php } ?>>Minnesota</option>
                                                <option value="Mississippi" <?php if (@$state=="Mississippi"){ ?> selected <?php } ?>>Mississippi</option>
                                                <option value="Missouri" <?php if (@$state=="Missouri"){ ?> selected <?php } ?>>Missouri</option>
                                                <option value="Montana" <?php if (@$state=="Montana"){ ?> selected <?php } ?>>Montana</option>
                                                <option value="Nebraska" <?php if (@$state=="Nebraska"){ ?> selected <?php } ?>>Nebraska</option>
                                                <option value="Nevada" disabled="disabled" <?php if (@$state=="Nevada"){ ?> selected <?php } ?>>Nevada</option>
                                                <option value="New Hampshire" <?php if (@$state=="New Hampshire"){ ?> selected <?php } ?>>New Hampshire</option>
                                                <option value="New Jersey" <?php if (@$state=="New Jersey"){ ?> selected <?php } ?>>New Jersey</option>
                                                <option value="New Mexico" <?php if (@$state=="New Mexico"){ ?> selected <?php } ?>>New Mexico</option>
                                                <option value="New York" disabled="disabled" <?php if (@$state=="New York"){ ?> selected <?php } ?>>New York</option>
                                                <option value="North Carolina" <?php if (@$state=="North Carolina"){ ?> selected <?php } ?>>North Carolina</option>
                                                <option value="North Dakota" <?php if (@$state=="North Dakota"){ ?> selected <?php } ?>>North Dakota</option>
                                                <option value="Ohio" <?php if (@$state=="Ohio"){ ?> selected <?php } ?>>Ohio</option>
                                                <option value="Oklahoma" <?php if (@$state=="Oklahoma"){ ?> selected <?php } ?>>Oklahoma</option>
                                                <option value="Oregon" <?php if (@$state=="Oregon"){ ?> selected <?php } ?>>Oregon</option>
                                                <option value="Pennsylvania" <?php if (@$state=="Pennsylvania"){ ?> selected <?php } ?>>Pennsylvania</option>
                                                <option value="Rhode Island" <?php if (@$state=="Rhode Island"){ ?> selected <?php } ?>>Rhode Island</option>
                                                <option value="South Carolina" <?php if (@$state=="South Carolina"){ ?> selected <?php } ?>>South Carolina</option>
                                                <option value="South Dakota" <?php if (@$state=="South Dakota"){ ?> selected <?php } ?>>South Dakota</option>
                                                <option value="Tennessee" <?php if (@$state=="Tennessee"){ ?> selected <?php } ?>>Tennessee</option>
                                                <option value="Texas" <?php if (@$state=="Texas"){ ?> selected <?php } ?>>Texas</option>
                                                <option value="Utah" <?php if (@$state=="Utah"){ ?> selected <?php } ?>>Utah</option>
                                                <option value="Vermont" <?php if (@$state=="Vermont"){ ?> selected <?php } ?>>Vermont</option>
                                                <option value="Virginia" <?php if (@$state=="Virginia"){ ?> selected <?php } ?>>Virginia</option>
                                                <option value="Washington" <?php if (@$state=="Washington"){ ?> selected <?php } ?>>Washington</option>
                                                <option value="West Virginia" <?php if (@$state=="West Virginia"){ ?> selected <?php } ?>>West Virginia</option>
                                                <option value="Wisconsin" <?php if (@$state=="Wisconsin"){ ?> selected <?php } ?>>Wisconsin</option>
                                                <option value="Wyoming" <?php if (@$state=="Wyoming"){ ?> selected <?php } ?>>Wyoming</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <select id="propertyType" name="propertyType" class="form-control form_focus required"  required>
                                                <?php foreach (get_setting('property_type','',1) as $property){ ?>
                                                    <option value="<?php echo $property['meta_key']; ?>" data-val="<?php echo $property['meta_value']; ?>" <?php if (@$propertyType==$property['meta_key']){ ?> selected <?php } ?>><?php echo $property['meta_content']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6">
                                                    <div>
                                                        <input id="less-than-5k" class="radio-style" name="propertySize" value="1" type="radio" checked>
                                                        <label for="less-than-5k" class="radio-style-2-label"> Less than 5,000 sq ft.</label>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6">
                                                    <div>
                                                        <input id="above-5k" class="radio-style"name="propertySize" value="2" type="radio" <?php if (@$propertySize==2){ ?> checked <?php } ?>>
                                                        <label for="above-5k" class="radio-style-2-label"> Above 5,000 sq ft.</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12">
                                        <div class="quote_btn">
                                            <button type="submit" class="submit form-submit"><span>Next</span></button>
                                        </div>
                                    </div>

                                </div>
                            </form>
                            <!--  ...........row.........end............. -->
                        </section>
                        <!--  ..........section........end............. -->
                    </div>
                    <!--  .........quote_from.......end............. -->


                    <div class="logos">
                        <p>As Seen on...</p>
                        <img alt="" src="<?php echo base_url(); ?>assets/front/images/logos/espn.png">
                        <img alt="" src="<?php echo base_url(); ?>assets/front/images/logos/fox-news.png">
                        <img alt="" src="<?php echo base_url(); ?>assets/front/images/logos/hgtv.png">
                        <img alt="" src="<?php echo base_url(); ?>assets/front/images/logos/tlc.png">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $this->load->view('common/footer'); ?>
<script>
    $('#form-step1').submit(function (e) {
        e.preventDefault();
        $('.form-submit').attr('disabled', true).css('opacity', '0.5').css('cursor', 'wait');
        var value = new FormData( $("#form-step1")[0] );
        $.ajax({
            url:base_url+'quote/save_first',
            type:'post',
            data:value,
            dataType:'json',
            processData: false,
            contentType: false,
            success:function(status){
                if(status.msg=='success'){
                    $('.form-submit').removeAttr('disabled').css('opacity', '1').css('cursor', 'initial');
                    $(location).attr('href', base_url+"quote/steptwo");
                }
                else if(status.msg == 'error'){
                    $('.form-submit').removeAttr('disabled').css('opacity', '1').css('cursor', 'initial');
                    toastr.error(status.response, 'Error');
                }
            }
        });
    });
</script>
