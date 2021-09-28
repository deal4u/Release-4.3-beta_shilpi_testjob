<script src="<?php echo base_url(); ?>assets/admin_assets/js/jquery-2.1.1.js"></script>
<script src="<?php echo base_url(); ?>assets/admin_assets/js/popper.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin_assets/js/bootstrap.js"></script>
<script src="<?php echo base_url(); ?>assets/admin_assets/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="<?php echo base_url(); ?>assets/admin_assets/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- Flot -->
<script src="<?php echo base_url(); ?>assets/admin_assets/js/plugins/flot/jquery.flot.js"></script>
<script src="<?php echo base_url(); ?>assets/admin_assets/js/plugins/flot/jquery.flot.tooltip.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin_assets/js/plugins/flot/jquery.flot.spline.js"></script>
<script src="<?php echo base_url(); ?>assets/admin_assets/js/plugins/flot/jquery.flot.resize.js"></script>
<script src="<?php echo base_url(); ?>assets/admin_assets/js/plugins/flot/jquery.flot.pie.js"></script>

<!-- Peity -->
<script src="<?php echo base_url(); ?>assets/admin_assets/js/plugins/peity/jquery.peity.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin_assets/js/demo/peity-demo.js"></script>

<!-- Ladda -->
<script src="<?php echo base_url(); ?>assets/admin_assets/js/plugins/ladda/spin.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin_assets/js/plugins/ladda/ladda.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin_assets/js/plugins/ladda/ladda.jquery.min.js"></script>

<!--<script src="--><?php //echo base_url(); ?><!--assets/admin_assets/js/plugins/dataTables/datatables.min.js"></script>-->
<!--<script src="--><?php //echo base_url(); ?><!--assets/admin_assets/js/plugins/dataTables/dataTables.bootstrap4.min.js"></script>-->

<!-- ChartJS-->
<script src="<?php echo base_url(); ?>assets/admin_assets/js/plugins/chartJs/Chart.min.js"></script>

<!-- Toastr -->
<script src="<?php echo base_url(); ?>assets/admin_assets/js/plugins/toastr/toastr.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin_assets/js/plugins/select2/select2.full.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin_assets/js/plugins/sweetalert/sweetalert.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin_assets/js/select2.min.js"></script>

<!-- Masonary -->
<script src="<?php echo base_url(); ?>assets/admin_assets/js/plugins/masonary/masonry.pkgd.min.js"></script>

<!-- Jquery Validate -->
<script src="<?php echo base_url(); ?>assets/admin_assets/js/plugins/validate/jquery.validate.min.js"></script>
<!-- Data picker -->
<script src="<?php echo base_url(); ?>assets/admin_assets/js/plugins/datapicker/bootstrap-datepicker.js"></script>

<!-- Custom and plugin javascript -->
<script src="<?php echo base_url(); ?>assets/admin_assets/js/inspinia.js"></script>
<script src="<?php echo base_url(); ?>assets/admin_assets/js/plugins/pace/pace.min.js"></script>

<script>
    $(document).ready(function() {

        var data1 = [
            [0,4],[1,8],[2,5],[3,10],[4,4],[5,16],[6,5],[7,11],[8,6],[9,11],[10,30],[11,10],[12,13],[13,4],[14,3],[15,3],[16,6]
        ];
        var data2 = [
            [0,1],[1,0],[2,2],[3,0],[4,1],[5,3],[6,1],[7,5],[8,2],[9,3],[10,2],[11,1],[12,0],[13,2],[14,8],[15,0],[16,0]
        ];
        $("#flot-dashboard-chart").length && $.plot($("#flot-dashboard-chart"), [
                data1, data2
            ],
            {
                series: {
                    lines: {
                        show: false,
                        fill: true
                    },
                    splines: {
                        show: true,
                        tension: 0.4,
                        lineWidth: 1,
                        fill: 0.4
                    },
                    points: {
                        radius: 0,
                        show: true
                    },
                    shadowSize: 2
                },
                grid: {
                    hoverable: true,
                    clickable: true,
                    tickColor: "#d5d5d5",
                    borderWidth: 1,
                    color: '#d5d5d5'
                },
                colors: ["#1ab394", "#1C84C6"],
                xaxis:{
                },
                yaxis: {
                    ticks: 4
                },
                tooltip: false
            }
        );

    });
</script>

<script>
    $(window).load(function() {

        $('.grid').masonry({
            // options
            itemSelector: '.grid-item',
            columnWidth: '.grid-sizer',
            gutter: 25
        });

    });
</script>
<!-- iCheck -->
<script src="<?php echo base_url(); ?>assets/admin_assets/js/plugins/iCheck/icheck.min.js"></script>
<script>
    $(document).ready(function () {
        var triggeredByChild = false;

        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });


        $('#check-all').on('ifChecked', function (event) {
            $('.check').iCheck('check');
            triggeredByChild = false;
        });

        $('#check-all').on('ifUnchecked', function (event) {
            if (!triggeredByChild) {
                $('.check').iCheck('uncheck');
            }
            triggeredByChild = false;
        });
        // Removed the checked state from "All" if any checkbox is unchecked
        $('.check').on('ifUnchecked', function (event) {
            triggeredByChild = true;
            $('#check-all').iCheck('uncheck');
        });

        $('.check').on('ifChecked', function (event) {
            if ($('.check').filter(':checked').length == $('.check').length) {
                $('#check-all').iCheck('check');
            }
        });

    });
</script>
<!-- SUMMERNOTE -->
<script src="<?php echo base_url(); ?>assets/admin_assets/js/plugins/summernote/summernote-bs4.js"></script>
<script type="text/javascript">
    $('a[href^="#"]').on('click', function(event) {
        var target = $(this.getAttribute('href'));
        if( target.length ) {
            event.preventDefault();
            $('html, body').stop().animate({
                scrollTop: target.offset().top,
            }, 500);
            target.siblings().removeClass("focused");
            target.addClass("focused");
        }
    });
</script>


