<?php
$data['title']='';
$data['meta_title']='';
$data['meta_description']='';
$this->load->view('common/header', $data); ?>
    <section id="page-title" class="page-title-center">

        <div class="container clearfix">
            <h1 style="color: #444">Page Not Found</h1>
        </div>

    </section>
    <!-- Content -->
    <section class="section nomargin nopadding">

        <div class="content-wrap">

            <div class="container clearfix">

                <div class="col_full nobottommargin">
                    <div class="error404 center">404</div>
                </div>

                <div class="col_full text-center nobottommargin col_last">

                    <div class="heading-block nobottomborder">
                        <h4>Ooopps.! The Page you were looking for, <br> couldn't be found.</h4>
                    </div>

                </div>

            </div>

        </div>

    </section>
    <!-- #content end -->
<?php $this->load->view('common/footer'); ?>