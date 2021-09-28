<?php $this->load->view('common/header'); ?>
<section id="page-title" class="dark home_owner_review_banner">
    <div class="container clearfix">
        <div class="breadcrumb_text text-center">
            <h1 class="text-light">HOMEOWNERS</h1>
            <div class="top_button text-center mt-1">
                <a class="button" href="<?php echo base_url(); ?>quote">GET STARTED TODAY!</a>
            </div>
        </div>
    </div>
</section>
<section class="content_section">
    <div class="content-wrap">
        <div class="container clearfix">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-12 col">
                    <div class="plans_menu text-right pr6 pb7 pr0-xs">
                        <div class="plans_menu_title">
                            <h1>
                                HOMEOWNERS
                            </h1>
                        </div>
                        <ul class="plan_menu_list">
                            <li>
                                <a href="<?php echo base_url(); ?>homeowners">What is a Home Warranty?</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url(); ?>buy-seller">Buyers & Sellers</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url(); ?>maintenance">Maintenance Tips</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url(); ?>reviews">Reviews & Ratings</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url(); ?>question">Common Questions</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url(); ?>quote">Get a Quote</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-12 col">
                    <div class="plans_warranty pl2">

                        <div class="all_reviews single_review">
                            <div class="review_team_1">
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 col-sm-12">
                                        <div class="review_img">
                                            <a href="">
                                                <img src="<?php echo base_url(); ?>assets/front/images/male3.jpg">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-9 col-md-8 col-sm-12">
                                        <div class="review_description">
                                            <h1>
                                                Andrew
                                            </h1>
                                            <h5>
                                                Michigan
                                            </h5>
                                            <p>
                                                Service was excellent with no problems on either end. My water heater went out and RHW had a plumber fix it the very same day. If that's not fast ..
                                            </p>
                                        </div>
                                    </div>
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
