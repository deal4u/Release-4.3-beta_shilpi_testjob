<!-- Footer ============================================= -->
<footer id="footer" class="dark">
    <div class="container">
        <!-- Footer Widgets ============================================= -->
        <div class="footer-widgets-wrap clearfix footer_menus">

            <div class="col_three_fourth">

                <div class="widget clearfix">

                    <div class="row">

                        <div class="col-lg-3 col-md-4 col-xs-6 widget_links">
                            <h4>Regal Home Warranty</h4>
                            <ul>
                                <li><a href="<?php echo base_url(); ?>about-us"> About Us </a></li>
                                <li><a href="<?php echo base_url(); ?>careers">Careers</a></li>
                                <li><a href="<?php echo base_url(); ?>affiliates">Affiliates</a></li>
                                <li><a href="<?php echo base_url(); ?>contactus"> Contact Us</a></li>
                            </ul>
                        </div>

                        <div class="col-lg-3 col-md-4 col-xs-6 widget_links">
                            <h4>RHW Warranty</h4>
                            <ul>
                                <li><a href="<?php echo base_url(); ?>plans"> What's Covered</a></li>
                                <li><a href="<?php echo base_url(); ?>benefits">Warranty Benefits</a></li>
                                <li><a href="<?php echo base_url(); ?>quote"> Get a Quote</a></li>
                            </ul>
                        </div>

                        <div class="col-lg-3 col-md-4 col-xs-6 widget_links">
                            <h4>Contractors</h4>
                            <ul>
                                <li><a href="<?php echo base_url(); ?>servicing"> Servicing Guidelines</a></li>
                                <li><a href="<?php echo base_url(); ?>contractors"> Why Join the Team</a></li>
                                <li><a href="<?php echo base_url(); ?>service-provider"> Testimonials</a></li>
                                <li><a href="<?php echo base_url(); ?>become-contractor"> Become a Service Provider</a></li>
                                <li><a href="<?php echo base_url(); ?>admin" target="_blank"> Vendor Center</a></li>
                            </ul>
                        </div>

                        <div class="col-lg-3 col-md-4 col-xs-6 widget_links">
                            <h4>Resources</h4>
                            <ul>
                                <li><a href="tel:1-860-777-0204">1-860-777-0204</a></li>
                                <li><a href="<?php echo base_url(); ?>faqs">FAQs</a></li>
                                <li><a href="<?php echo base_url(); ?>privacy-policy"> Privacy Policy</a></li>
                                <li><a href="<?php echo base_url(); ?>terms"> Terms & Conditions</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col_one_fourth col_last seals_widget">

                <div class="widget clearfix">

                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="info">
                                <div class="title">Have Questions? Call Us!</div>
                                <div class="sub-title">Our experts are standing by</div>
                                <div class="footer-phone">1-860-777-0204</div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </div><!-- .footer-widgets-wrap end -->

    </div>

    <!-- Copyrights
    ============================================= -->
    <div id="copyrights">

        <div class="container clearfix">

            <div class="col_two_third nobottommargin">
                <p>*By entering my information and submitting for a free quote, I am providing express consent to Regal Home Warranty to be contacted via email, phone, pre-recorded messages, and text, including my wireless phone number, regarding product and servicing information using automated technology, even if it is registered on a federal, state, or corporate Do Not Call list. Message and data rates may apply. I understand that consent is not a condition of purchase or receipt of services. If my area is not covered, I may be referred to an alternate provider.<br /> <a href="<?php echo base_url(); ?>privacy-policy">Click Here </a> to view full Privacy Policy.</p>

                <p>RHW service contracts are not available in California and Iowa. Regal Home Warranty uses stock photos when publishing consumer reviews. It is company policy to use only stock imagery as we can not source the true ownership, or royalty rights, of a photo provided by the consumer.</p>

                <p>**RHW offers service contracts which are not warranties.  A RHW service contract covers the repair or replacement of many system and appliance breakdowns, but not necessarily the entire system or appliance.  Terms and conditions apply.  See contract for limitations and specifics on response times.  Coverage not available in all States.
                    2. RHW reserves the right to offer cash back in lieu of repair or replacement in the amount of our actual cost, which at times may be less than retail, to repair or replace any covered system, component, or appliance.</p>

                &copy; Copyright 2019 - Regal Home Warranty - All Rights Reserved
            </div>
            <div class="col_one_third col_last"></div>
        </div>

    </div><!-- #copyrights end -->

</footer><!-- #footer end -->


</div><!-- #wrapper end -->

<!-- Go To Top
============================================= -->
<div id="gotoTop" class="icon-angle-up"></div>

<!-- External JavaScripts
============================================= -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/front/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/front/js/plugins.js"></script>

<!-- Footer Scripts
============================================= -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/front/js/functions.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/front/js/components/bs-select.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/front/js/components/select-boxes.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/front/js/jquery.bxslider.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/front/js/custom.js"></script>
<!--<script type="text/javascript" src="--><?php //echo base_url(); ?><!--assets/front/js/jquery.validate.js"></script>-->
<script src="<?php echo base_url(); ?>assets/admin_assets/js/plugins/validate/jquery.validate.min.js"></script>
<script>
    $('.selectpicker').selectpicker();
</script>
<script>
    $(document).ready( function()
    {
        $(".tags_select").select2({
            placeholder: "Select Options"
        });
        $(".select-1").bind('change',function()
        {
            var optionObj = $(this).find("option:selected");
            $('#generic_opt').val(	optionObj.text()  );
            recalculate();
        });

    });
</script>
<script type="text/javascript">
    jQuery(document).ready(function($){
        var $faqItems = $('#faqs .faq');
        if( window.location.hash != '' ) {
            var getFaqFilterHash = window.location.hash;
            var hashFaqFilter = getFaqFilterHash.split('#');
            if( $faqItems.hasClass( hashFaqFilter[1] ) ) {
                $('#portfolio-filter li').removeClass('activeFilter');
                $( '[data-filter=".'+ hashFaqFilter[1] +'"]' ).parent('li').addClass('activeFilter');
                var hashFaqSelector = '.' + hashFaqFilter[1];
                $faqItems.css('display', 'none');
                if( hashFaqSelector != 'all' ) {
                    $( hashFaqSelector ).fadeIn(500);
                } else {
                    $faqItems.fadeIn(500);
                }
            }
        }

        $('#portfolio-filter a').click(function(){
            $('#portfolio-filter li').removeClass('activeFilter');
            $(this).parent('li').addClass('activeFilter');
            var faqSelector = $(this).attr('data-filter');
            $faqItems.css('display', 'none');
            if( faqSelector != 'all' ) {
                $( faqSelector ).fadeIn(500);
            } else {
                $faqItems.fadeIn(500);
            }
            return false;
        });
    });
</script>

<script>
    $(document).ready(function(){
        if ($(window).width() < 768) {
            $(".common-height .img_box").css({minHeight: '500px', maxHeight: '500px'});

            $(".common-height .content_box").css({minHeight: 'auto', maxHeight: 'auto', height: 'auto'});
        }


        // custom script added
        $('#forget').hide();

        $('#to-forget').click(function(){
            $(this).parent().parent().parent().hide();
            $('#forget').show();
            $('#login-form-heading').text('Enter your email address');

        });

        $('#back-login').click(function(){
            $(this).parent().parent().parent().hide();
            $('#login').show();
            $('#login-form-heading').text('Login to your Account');

        });
    });
</script>
<script type="text/javascript">

    $(document).ready(function() {
        checkWidth();
    });
    function checkWidth() {
        if ($(window).width() < 767) {

            $(window).scroll(function() {
                var scroll = $(window).scrollTop();
                if (scroll >= 5) {

                    $('#top-bar').hide();
                }
                else
                {
                    $('#top-bar').show();
                }
            });
        }
    }

    $(function() {
        var pgurl = window.location.href.substr(window.location.href.lastIndexOf("/")+1);
        $("#primary-menu ul li").each(function(){
            if($(this).children().attr("href") == pgurl || $(this).attr("href") == '' || $(this).children().attr("href") == 'https://www.explorelogics.com/home-protection' )
            {
                $(this).addClass("current");
            }

        });
    });

</script>
</body>
</html>
