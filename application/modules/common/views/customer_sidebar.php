<?php
$r_class = $this->router->fetch_class();
$r_method = $this->router->fetch_method();
?>

<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <img alt="image" class="rounded-circle" style="width: 50px;" src="<?php echo base_url(); ?>assets/admin_assets/img/profile_small.jpg"/>
                    <span data-toggle="dropdown" class="dropdown-toggle admin-name">
                        <span class="block m-t-xs font-bold"><?php echo get_session('admin_username'); ?></span>
                        
                    </span>
                </div>
                <div class="logo-element">
                    RHW
                </div>
            </li>
		
			<li class="<?php if($r_class == 'customers' && ($r_method == 'index' || $r_method == 'dashboard')) { ?> active <?php } ?>">
				<a href="<?php echo base_url(); ?>customers"><i class="fa fa-dashboard"></i> <span class="nav-label">My Policies</span></a>
			</li>
			<li class="<?php if($r_class == 'customers' &&  $r_method == 'edit_profile') { ?> active <?php } ?>">
				<a href="<?php echo base_url(); ?>customers/edit_profile"><i class="fa fa-dashboard"></i> <span class="nav-label">Edit Profile</span></a>
			</li>
            <!--<li class="">
                <a href="<?php echo base_url(); ?>customers/claims"><i class="fa fa-users"></i> <span class="nav-label">Make New Claim</span></a>
            </li>
            <li class="">
                <a href="<?php echo base_url(); ?>customers/claims/claim_status"><i class="fa fa-users"></i> <span class="nav-label">View Claim Status</span></a>
            </li>-->
        </ul>
    </div>
</nav>