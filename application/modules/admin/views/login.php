<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login | Regal Home Warranty</title>

    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/favicon.png">
    <link href="<?php echo base_url(); ?>assets/admin_assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/admin_assets/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="<?php echo base_url(); ?>assets/admin_assets/css/animate.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/admin_assets/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/admin_assets/css/custom.css" rel="stylesheet">

</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>
                <img src="<?php echo base_url(); ?>assets/logo.png" class="logo">
            </div>
            
            <h3 class="admin_login_st">Administrator Login</h3>
            <?php if($this->session->flashdata('login_error')) { ?>
            <div class="alert alert-danger">
                <?php echo $this->session->flashdata('login_error'); ?>
            </div>
            <?php } ?>

            <form class="m-t" role="form" method="post" action="<?php echo admin_url(); ?>login/login_verify">
                <div class="form-group">
                    <input type="email" class="form-control" placeholder="Email" name="email" value="<?php echo $this->session->flashdata('email');?>">
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-primary btn-login block full-width m-b">Login</button>

                <a href="<?php echo admin_url(); ?>forgot_password"><small>Forgot password?</small></a>
                
            </form>
            <p class="m-t"> <small>All rights reserved Regal Home Warranty &copy; <?php echo date("Y"); ?></small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="<?php echo base_url(); ?>assets/admin_assets/js/jquery-3.1.1.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/admin_assets/js/popper.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/admin_assets/js/bootstrap.js"></script>

</body>

</html>
