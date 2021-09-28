<?php if(get_session('admin_type') == 'customer'){ ?>
<nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
    </div>
    <ul class="nav navbar-top-links navbar-right">
        <li style="padding: 20px">
            <span class="m-r-sm text-muted welcome-message">Welcome <?php echo get_session('admin_username'); ?></span>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>customers/change_password">
                <i class="fa fa-key"></i> Change Password
            </a>
        </li>
        <li>
            <a href="<?php echo base_url(); ?>customers/logout">
                <i class="fa fa-sign-out"></i> Log out
            </a>
        </li>
    </ul>
</nav>
<?php }else{ ?>
<nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
    </div>
    <ul class="nav navbar-top-links navbar-right">
        <li style="padding: 20px">
            <span class="m-r-sm text-muted welcome-message">Welcome <?php echo get_session('admin_username'); ?></span>
        </li>
        <li>
            <a href="<?php echo admin_url(); ?>change_password">
                <i class="fa fa-key"></i> Change Password
            </a>
        </li>
        <li>
            <a href="<?php echo admin_url(); ?>logout">
                <i class="fa fa-sign-out"></i> Log out
            </a>
        </li>
    </ul>
</nav>
<?php } ?>