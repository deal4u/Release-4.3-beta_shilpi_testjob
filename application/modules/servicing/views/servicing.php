<?php $this->load->view('common/header'); ?>
<section id="page-title" class="dark contractors_banner">

    <div class="container clearfix">
        <div class="breadcrumb_text text-center">
            <h1 class="text-light">CONTRACTORS</h1>
            <div class="top_button text-center mt-1">
                <a class="button" href="<?php echo base_url(); ?>become-contractor">APPLY TODAY!</a>
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
                                <a class="active_page" href="<?php echo base_url(); ?>servicing">Servicing Guidelines</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url(); ?>service-provider">Service Contractor Reviews</a>
                            </li>
                            <li>
                                <a href="<?php echo base_url(); ?>become-contractor">Become a Service Contractor</a>
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
                                Servicing Guidelines
                            </h1>
                            <p>
                                As a RHW Service Contractor, you are required to maintain the highest level of professionalism. Your performance in the field will ultimately determine the volume of jobs you receive from Regal Home Warranty . Our enrollment process is simple, yet thorough.
                            </p>
                        </div>

                        <div class="service_contract">
                            <div class="arrow_list_area">
                                <h3 class="arrow_title">
                                    To be a RHW Service Contractor, you must:
                                </h3>
                                <ul class="enroll_list">
                                    <li>
                                        Be a licensed contractor for the trades you service
                                    </li>
                                    <li>
                                        Carry a minimum of $500,000 in General Liability Insurance, at least $250,000 per occurrence, and provide proof of Workers Compensation Insurance or a waiver if you are self-employed.
                                    </li>
                                    <li>
                                        Have proof of auto insurance with limits of $250,000 per person and $500,000 per occurrence.
                                    </li>
                                </ul>
                            </div>
                            <div class="serving_text">
                                <p>
                                    RHW contract holders will contact us directly to request service. We will then dispatch a service work order to you via fax, email, or telephone.
                                </p>
                                <p>
                                    After receiving a work order, you are required to make every reasonable effort to contact the RHW contract holder within 4 hours for an appointment. If an emergency, you are required to use every effort and all available resources to expedite service. Our Service Contractors are an extension of us.
                                </p>
                                <p>
                                    We select and value our contractors based on promptness, proficiency, and efficiency.
                                </p>
                            </div>
                            <div class="home_btn">
                                <a class="button btn_blue" href="<?php echo base_url(); ?>become-contractor">APPLY TODAY!</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $this->load->view('common/footer'); ?>
