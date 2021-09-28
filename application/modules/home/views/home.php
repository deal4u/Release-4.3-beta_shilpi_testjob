<?php $this->load->view('common/header'); ?>
<section id="slider" class="dark">
    <img class="banner-img" style="width: 100%;" src="<?php echo base_url(); ?>assets/front/images/landing/landing2.jpg">
    <div class="slider-caption custom-caption" style="">
        <img src="<?php echo base_url(); ?>assets/front/images/slider-rib.png">
    </div>
    <div class="contact-widget" data-loader="button">
        <div class="contact-form-result"></div>
        <form id="quote-form" method="post" class="landing-wide-form  clearfix banner-form-main">
            <div class="heading-block nobottommargin nobottomborder">
                <h2>Free Quote</h2>
                <br>
            </div>
            <div class="col_full">
                <input type="text" name="name" class="form-control required input-lg not-dark" value="<?php echo @$name; ?>" placeholder="First Name" required="required">
            </div>
            <div class="col_full">
                <input type="email" name="email" class="form-control required input-lg not-dark" value="<?php echo @$email; ?>" placeholder="Email Address" required="required">
            </div>
            <div class="col_full">
                <input type="number" name="phone" class="form-control required input-lg not-dark" value="<?php echo @$phone; ?>" placeholder="Home Phone" required="required">
            </div>
            <div class="col_full nobottommargin">
                <button class="button" id="submit-quote" value="submit" type="submit" style="">Get Your Free Quote</button>
            </div>
        </form>
    </div>
</section>
<section class="offer-section clearfix">
    <div class="col-lg-5 nopadding shield-main">
        <a href="<?php echo base_url(); ?>plans" class="shields-link">
            <h1 class="black-heading">1 Month Free!</h1>
            <span class="heading-subtext">with purchase of any single payment plan</span>
            <ul class="shield-images">
                <li><img src="<?php echo base_url(); ?>assets/front/images/system.png"/></li>
                <li><img src="<?php echo base_url(); ?>assets/front/images/combo-shield.png"/></li>
                <li><img src="<?php echo base_url(); ?>assets/front/images/platinum-shield.png"/></li>
            </ul>
            <a href="<?php echo base_url(); ?>plans" class="button blue-btn">Choose Your Plan!</a>
        </a>
    </div>
    <div class="col-lg-7 half-yellow nopadding offer-section-main">
        <span class="small-heading">Limited Time Offer</span>
        <h1 class="big-heading">$99 off</h1>
        <p class="heading-lower-text">All Home Warranty Plans</p>
        <span class="v-small-text">*Discount not available in all states. Offer applies to annual plans only.</span>
        <div class="button-div">
            <a href="<?php echo base_url(); ?>quote" target="_blank" class="button blue-btn">Get Free Quote!</a>
        </div>
    </div>
</section>
<section class="how_it_works how_it_works_img_section nopadding">
    <div class="container-fluid nopadding">
        <div class="row nomargin">
            <div class="col-lg-6 col-md-6 col-sm-12 nopadding">
                <div class="img_left">
                    <img src="<?php echo base_url(); ?>assets/front/images/amazon.png" width="100%"/>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 nopadding">
                <div class="how_it_works_text">
                    <div class="line1">WELCOME TO </div>
                    <div class="line2">Regal Home Warranty</div>
                    <p>Regal Home Warranty has been providing excellence in service to our home warranty, customers for nearly a decade wall an amazing staff and a strong management team combining for over 50 years of collective industry experience. Regal Home Warranty has the highest customer satisfaction ratings in the home warranty business. </p>
                    <p>We offer different types of home warranty packages including a basic appliance home warranty plan that covers your home's most common appliances. Our home warranty plan coverage options also includes the major systems within your home such as your air conditioners, heating systems, plumbing, and electrical systems among many other options customers can choose from.  </p>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="reviews">
    <!-- End of Section Two -->
    <div class="section testimonials">
        <div class="section-heading">Hear From Our Very Satisfied Clients</div>
        <div class="section-subheading">We have helped thousands just like you!</div>
        <span class="slider-prev">&nbsp;</span>
        <span class="slider-next">&nbsp;</span>
        <div id="slider-container">
            <ul class="slider">
                <li>
                    <a href="reviews-single.php">
                        <div class="t-image"><img src="<?php echo base_url(); ?>assets/front/images/team/15.jpg" alt="Article Image" /></div>
                        <div class="t-info">
                            <div class="t-name">Andrew</div>
                            <div class="t-location">Michigan</div>
                            <div class="t-testimonial">
                                Service was excellent with no problems on either end. My water heater went out and RHW had a plumber fix it the very same day. If that's not fast ..</div>
                            <div class="button">View More Details</div>
                        </div>
                    </a>
                </li><li>
                    <a href="reviews-single.php">
                        <div class="t-image"><img src="<?php echo base_url(); ?>assets/front/images/team/1.jpg" alt="Article Image" /></div>
                        <div class="t-info">
                            <div class="t-name">Christine</div>
                            <div class="t-location">Georgia</div>
                            <div class="t-testimonial">
                                I was very pleased with the service I received. I called the warranty company late in the evening and they had a repair person at my home first th..</div>
                            <div class="button">View More Details</div>
                        </div>
                    </a>
                </li><li>
                    <a href="reviews-single.php">
                        <div class="t-image"><img src="<?php echo base_url(); ?>assets/front/images/team/2.jpg" alt="Article Image" /></div>
                        <div class="t-info">
                            <div class="t-name">Gerry</div>
                            <div class="t-location">Kansas</div>
                            <div class="t-testimonial">
                                RHW uses wonderful contractors. The HVAC contractor was knowledgeable and friend. They also showed us some much needed maintenance tips. Customer ..</div>
                            <div class="button">View More Details</div>
                        </div>
                    </a>
                </li><li>
                    <a href="reviews-single.php">
                        <div class="t-image"><img src="<?php echo base_url(); ?>assets/front/images/team/3.jpg" alt="Article Image" /></div>
                        <div class="t-info">
                            <div class="t-name">Hector</div>
                            <div class="t-location">Master Plumbers</div>
                            <div class="t-testimonial">
                                Regal Home Warranty offers a fantastic program for small business owners. We don’t have the marketing dollars to spend on trying to get new busi..</div>
                            <div class="button">View More Details</div>
                        </div>
                    </a>
                </li><li>
                    <a href="reviews-single.php">
                        <div class="t-image"><img src="<?php echo base_url(); ?>assets/front/images/team/4.jpg" alt="Article Image" /></div>
                        <div class="t-info">
                            <div class="t-name">Herb</div>
                            <div class="t-location">Herb's Appliance Repair</div>
                            <div class="t-testimonial">
                                If you haven’t already done so...sign up to be a vendor. This warranty company sends you business for free! They take really good care of their pe..</div>
                            <div class="button">View More Details</div>
                        </div>
                    </a>
                </li><li>
                    <a href="reviews-single.php">
                        <div class="t-image"><img src="<?php echo base_url(); ?>assets/front/images/team/5.jpg" alt="Article Image" /></div>
                        <div class="t-info">
                            <div class="t-name">Joe</div>
                            <div class="t-location">JT's Heating &amp; Cooling</div>
                            <div class="t-testimonial">
                                I’ve been in the service business for nearly 8 years now. RHW has helped grow my client base tenfold. The repeat business and referrals I have rec..</div>
                            <div class="button">View More Details</div>
                        </div>
                    </a>
                </li><li>
                    <a href="reviews-single.php">
                        <div class="t-image"><img src="<?php echo base_url(); ?>assets/front/images/team/6.jpg" alt="Article Image" /></div>
                        <div class="t-info">
                            <div class="t-name">Juliette</div>
                            <div class="t-location">Indiana</div>
                            <div class="t-testimonial">
                                The contractor called soon after we placed the service request and scheduled a convenient appointment to check out our stopped up commode. The con..</div>
                            <div class="button">View More Details</div>
                        </div>
                    </a>
                </li><li>
                    <a href="reviews-single.php">
                        <div class="t-image"><img src="<?php echo base_url(); ?>assets/front/images/team/7.jpg" alt="Article Image" /></div>
                        <div class="t-info">
                            <div class="t-name">Lester</div>
                            <div class="t-location">Pennsylvania</div>
                            <div class="t-testimonial">
                                Heater failed this winter. Regal Home Warranty sent a vendor the very next day and fixed the unit no questions asked. It was refreshing to get h..</div>
                            <div class="button">View More Details</div>
                        </div>
                    </a>
                </li><li>
                    <a href="reviews-single.php">
                        <div class="t-image"><img src="<?php echo base_url(); ?>assets/front/images/team/8.jpg" alt="Article Image" /></div>
                        <div class="t-info">
                            <div class="t-name">Michael</div>
                            <div class="t-location">Southern Service Professionals</div>
                            <div class="t-testimonial">
                                Total HomeProtection allows my business to grow by providing direct to consumer work rather than spend time selling and searching for new business..</div>
                            <div class="button">View More Details</div>
                        </div>
                    </a>
                </li><li>
                    <a href="reviews-single.php">
                        <div class="t-image"><img src="<?php echo base_url(); ?>assets/front/images/team/9.jpg" alt="Article Image" /></div>
                        <div class="t-info">
                            <div class="t-name">Patricia</div>
                            <div class="t-location">Tennessee</div>
                            <div class="t-testimonial">
                                I give this service 5 stars for the simple reason that they provided the service that we agreed on and I paid for. The service was prompt, efficie..</div>
                            <div class="button">View More Details</div>
                        </div>
                    </a>
                </li><li>
                    <a href="reviews-single.php">
                        <div class="t-image"><img src="<?php echo base_url(); ?>assets/front/images/team/10.jpg" alt="Article Image" /></div>
                        <div class="t-info">
                            <div class="t-name">Robin</div>
                            <div class="t-location">Colorado</div>
                            <div class="t-testimonial">
                                I&rsquo;d like to thank the warranty company for doing everything they promised. Most companies out there tell you if they can't fix something tha..</div>
                            <div class="button">View More Details</div>
                        </div>
                    </a>
                </li><li>
                    <a href="reviews-single.php">
                        <div class="t-image"><img src="<?php echo base_url(); ?>assets/front/images/team/11.jpg" alt="Article Image" /></div>
                        <div class="t-info">
                            <div class="t-name">Roger</div>
                            <div class="t-location">All-American Appliance Repair</div>
                            <div class="t-testimonial">
                                Regal Home Warranty was instrumental is getting my new business off the ground. They provide me with a steady amount of work so I don’t have to ..</div>
                            <div class="button">View More Details</div>
                        </div>
                    </a>
                </li><li>
                    <a href="reviews-single.php">
                        <div class="t-image"><img src="<?php echo base_url(); ?>assets/front/images/team/12.jpg" alt="Article Image" /></div>
                        <div class="t-info">
                            <div class="t-name">Sean</div>
                            <div class="t-location">Delaware</div>
                            <div class="t-testimonial">
                                Fantastic service! I received a call 30 minutes after I submitted my claim online and was told a plumber was on the way. In two hours my problem w..</div>
                            <div class="button">View More Details</div>
                        </div>
                    </a>
                </li><li>
                    <a href="reviews-single.php">
                        <div class="t-image"><img src="<?php echo base_url(); ?>assets/front/images/team/13.jpg" alt="Article Image" /></div>
                        <div class="t-info">
                            <div class="t-name">Thomas</div>
                            <div class="t-location">North Carolina</div>
                            <div class="t-testimonial">
                                I am very impressed with the customer service department at Regal Home Warranty. I had my air conditioner repaired a week ago and they just call..</div>
                            <div class="button">View More Details</div>
                        </div>
                    </a>
                </li><li>
                    <a href="reviews-single.php">
                        <div class="t-image"><img src="<?php echo base_url(); ?>assets/front/images/team/14.jpg" alt="Article Image" /></div>
                        <div class="t-info">
                            <div class="t-name">Tina</div>
                            <div class="t-location">Ohio</div>
                            <div class="t-testimonial">
                                Excellent customer service! The repair men were punctual, but and took their time fixing the refrigerator. Overall, I&rsquo;m a happy customer...</div>
                            <div class="button">View More Details</div>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <!-- End of Section Testimonials -->
</section>
<?php $this->load->view('common/footer'); ?>
<script>
    $(document).ready(function () {
        $('#quote-form').submit(function (e) {
            e.preventDefault();
            var value = new FormData( $("#quote-form")[0] );
            $.ajax({
                url:base_url+'home/get_quote',
                type:'post',
                data:value,
                dataType:'json',
                processData: false,
                contentType: false,
                success:function(status){
                    if(status.msg=='success'){
                        $(location).attr('href', base_url+"quote");
                    }
                    else if(status.msg == 'error'){
                        $('#submit-quote').html('Get Your Free Quote');
                        toastr.error(status.response, 'Error');
                    }
                }
            });
        });
    });
</script>
