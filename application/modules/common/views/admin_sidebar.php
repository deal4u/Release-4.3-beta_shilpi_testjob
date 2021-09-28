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
                        <span class="text-muted text-xs block">
                            <?php if(get_session('admin_type') == 1) { ?>
                                Super Admin
                            <?php } else { ?>
                                Admin
                            <?php } ?>
                        </span>
                    </span>
                </div>
                <div class="logo-element">
                    RHW
                </div>
            </li>
            <?php if (get_session('admin_type') == 2 && get_session('admin_permissions')['dashboard'] != 'N/A' && get_session('admin_permissions')['dashboard']['view'] == 1){ ?>
                <li class="<?php if($r_class == 'admin' && ($r_method == 'index' || $r_method == 'dashboard')) { ?> active <?php } ?>">
                    <a href="<?php echo admin_url(); ?>"><i class="fa fa-dashboard"></i> <span class="nav-label">Dashboard</span></a>
                </li>
            <?php }elseif(get_session('admin_type') == 1){ ?>
                <li class="<?php if($r_class == 'admin' && ($r_method == 'index' || $r_method == 'dashboard')) { ?> active <?php } ?>">
                    <a href="<?php echo admin_url(); ?>"><i class="fa fa-dashboard"></i> <span class="nav-label">Dashboard</span></a>
                </li>
            <?php } ?>
            <?php if (get_session('admin_type') == 2 && get_session('admin_permissions')['claims'] != 'N/A' && get_session('admin_permissions')['claims']['view'] == 1){ ?>
                <li class="<?php if($r_class == 'claims' && ($r_method == 'index' || $r_method == 'add')) { ?> active <?php } ?>">
                    <a href="<?php echo admin_url(); ?>claims"><i class="fa fa-exclamation-triangle"></i> <span class="nav-label">Claims</span></a>
                </li>
            <?php }elseif(get_session('admin_type') == 1){ ?>
                <li class="<?php if($r_class == 'claims' && ($r_method == 'index' || $r_method == 'add')) { ?> active <?php } ?>">
                    <a href="<?php echo admin_url(); ?>claims"><i class="fa fa-exclamation-triangle"></i> <span class="nav-label">Claims</span></a>
                </li>
            <?php } ?>
            <li class="<?php if($r_class == 'tasks' && ($r_method == 'index' || $r_method == 'search_task')) { ?> active <?php } ?>">
                <a href="<?php echo admin_url(); ?>tasks"><i class="fa fa-tasks"></i> <span class="nav-label">Tasks</span><span class="label label-warning float-right"><?php echo task_count(); ?></span></a>
            </li>
            <li class="<?php if($r_class == 'customers' && ($r_method == 'index' || $r_method == 'add' || $r_method == 'edit' || $r_method == 'search_customer')) { ?> active <?php } ?>">
                <a href="<?php echo admin_url(); ?>customers"><i class="fa fa-users"></i> <span class="nav-label">Customers</span></a>
            </li>
            <?php if (get_session('admin_type') == 2 && get_session('admin_permissions')['vendors'] != 'N/A' && get_session('admin_permissions')['vendors']['view'] == 1){ ?>
                <li class="<?php if($r_class == 'vendors' && ($r_method == 'index' || $r_method == 'add' || $r_method == 'edit')) { ?> active <?php } ?>">
                    <a href="<?php echo admin_url(); ?>vendors"><i class="fa fa-user-o"></i> <span class="nav-label">Vendors</span></a>
                </li>
            <?php }elseif(get_session('admin_type') == 1){ ?>
                <li class="<?php if($r_class == 'vendors' && ($r_method == 'index' || $r_method == 'add' || $r_method == 'edit')) { ?> active <?php } ?>">
                    <a href="<?php echo admin_url(); ?>vendors"><i class="fa fa-user-o"></i> <span class="nav-label">Vendors</span></a>
                </li>
            <?php } ?>
            <?php if (get_session('admin_type') == 2 && get_session('admin_permissions')['payment'] != 'N/A' && get_session('admin_permissions')['payment']['view'] == 1){ ?>
                <li class="<?php if($r_class == 'payments' && ($r_method == 'index' || $r_method == 'filter_payments')) { ?> active <?php } ?>">
                    <a href="<?php echo admin_url(); ?>payments"><i class="fa fa-money"></i> <span class="nav-label">Payments</span></a>
                </li>
            <?php }elseif(get_session('admin_type') == 1){ ?>
                <li class="<?php if($r_class == 'payments' && ($r_method == 'index' || $r_method == 'filter_payments')) { ?> active <?php } ?>">
                    <a href="<?php echo admin_url(); ?>payments"><i class="fa fa-money"></i> <span class="nav-label">Payments</span></a>
                </li>
            <?php } ?>
            <?php if (get_session('admin_type') == 2 && get_session('admin_permissions')['invoice'] != 'N/A' && get_session('admin_permissions')['invoice']['view'] == 1){ ?>
                <li class="<?php if($r_class == 'invoice' && ($r_method == 'vendor' || $r_method == 'customer' || $r_method == 'search_vendor_invoice' || $r_method == 'search_customer_invoice') ) { ?> active <?php } ?>">
                    <a href="#"><i class="fa fa-file-text"></i> <span class="nav-label">Invoice</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li class="<?php if($r_class == 'invoice' && ($r_method == 'customer' || $r_method == 'search_customer_invoice')) { ?> active <?php } ?>"><a href="<?php echo admin_url(); ?>invoice/customer">Customer Invoice</a></li>
                        <li class="<?php if($r_class == 'invoice' && ($r_method == 'vendor' || $r_method == 'search_vendor_invoice')) { ?> active <?php } ?>"><a href="<?php echo admin_url(); ?>invoice/vendor">Vendor Invoice</a></li>
                    </ul>
                </li>
            <?php }elseif(get_session('admin_type') == 1){ ?>
                <li class="<?php if($r_class == 'invoice' && ($r_method == 'vendor' || $r_method == 'customer' || $r_method == 'search_vendor_invoice' || $r_method == 'search_customer_invoice') ) { ?> active <?php } ?>">
                    <a href="#"><i class="fa fa-file-text"></i> <span class="nav-label">Invoice</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li class="<?php if($r_class == 'invoice' && ($r_method == 'customer' || $r_method == 'search_customer_invoice')) { ?> active <?php } ?>"><a href="<?php echo admin_url(); ?>invoice/customer">Customer Invoice</a></li>
                        <li class="<?php if($r_class == 'invoice' && ($r_method == 'vendor' || $r_method == 'search_vendor_invoice')) { ?> active <?php } ?>"><a href="<?php echo admin_url(); ?>invoice/vendor">Vendor Invoice</a></li>
                    </ul>
                </li>
            <?php } ?>
            <?php if (get_session('admin_type') == 2 && get_session('admin_permissions')['scoreboard'] != 'N/A' && get_session('admin_permissions')['scoreboard']['view'] == 1) { ?>
                <li class="<?php if ($r_class == 'scoreboard' && $r_method == 'index') { ?> active <?php } ?>">
                    <a href="<?php echo admin_url(); ?>scoreboard"><i class="fa fa-clipboard"></i> <span class="nav-label">Scoreboard</span></a>
                </li>
            <?php }elseif(get_session('admin_type') == 1){ ?>
                <li class="<?php if ($r_class == 'scoreboard' && $r_method == 'index') { ?> active <?php } ?>">
                    <a href="<?php echo admin_url(); ?>scoreboard"><i class="fa fa-clipboard"></i> <span class="nav-label">Scoreboard</span></a>
                </li>
            <?php } ?>
            <?php if (get_session('admin_type') == 2 && get_session('admin_permissions')['admin_access'] != 'N/A' && get_session('admin_permissions')['admin_access']['view'] == 1){ ?>
                <li class="<?php if($r_class == 'admin' && ($r_method == 'admin_users' || $r_method == 'add' || $r_method == 'edit')) { ?> active <?php } ?>">
                    <a href="<?php echo admin_url(); ?>admin_users"><i class="fa fa-users"></i> <span class="nav-label">Admin Users</span></a>
                </li>
            <?php }elseif(get_session('admin_type') == 1){ ?>
                <li class="<?php if($r_class == 'admin' && ($r_method == 'admin_users' || $r_method == 'add' || $r_method == 'edit')) { ?> active <?php } ?>">
                    <a href="<?php echo admin_url(); ?>admin_users"><i class="fa fa-users"></i> <span class="nav-label">Admin Users</span></a>
                </li>
            <?php } ?>
            <?php if (get_session('admin_type') == 2 && get_session('admin_permissions')['reporting'] != 'N/A' && get_session('admin_permissions')['reporting']['view'] == 1){ ?>
                <li class="<?php if($r_class == 'reportings' && ($r_method == 'lead_source' || $r_method == 'search_customer')) { ?> active <?php } ?>">
                    <a href="<?php echo admin_url(); ?>reportings/lead_source"><i class="fa fa-users"></i> <span class="nav-label">Reporting</span></a>
                </li>
            <?php }elseif(get_session('admin_type') == 1){ ?>
                <li class="<?php if($r_class == 'reportings' && ($r_method == 'lead_source' || $r_method == 'search_customer')) { ?> active <?php } ?>">
                    <a href="<?php echo admin_url(); ?>reportings/lead_source"><i class="fa fa-users"></i> <span class="nav-label">Reporting</span></a>
                </li>
            <?php } ?>
            <?php if (get_session('admin_type') == 2 && get_session('admin_permissions')['leadsource'] != 'N/A' && get_session('admin_permissions')['leadsource']['view'] == 1){ ?>
                <li class="<?php if($r_class == 'lead_source' && $r_method == 'index') { ?> active <?php } ?>">
                    <a href="<?php echo admin_url(); ?>lead_source"><i class="fa fa-wrench"></i> <span class="nav-label">Lead Source</span></a>
                </li>
            <?php }elseif(get_session('admin_type') == 1){ ?>
                <li class="<?php if($r_class == 'lead_source' && $r_method == 'index') { ?> active <?php } ?>">
                    <a href="<?php echo admin_url(); ?>lead_source"><i class="fa fa-wrench"></i> <span class="nav-label">Lead Source</span></a>
                </li>
            <?php } ?>
			
			<li class="<?php if(($r_class == 'login_track' && ($r_method == 'index' ||  $r_method == 'customer' ) )) { ?> active <?php } ?>"> 
				<a href="#"><i class="fa fa-sign-in"></i> <span class="nav-label">Login Track</span><span class="fa arrow"></span></a>
				<ul class="nav nav-second-level collapse">
					<li class="<?php if($r_class == 'login_track' &&  $r_method == 'index' ) { ?> active <?php } ?>"><a href="<?php echo admin_url(); ?>login_track"><span class="nav-label">CRM Login Track</span></a></li>
					<li class="<?php if($r_class == 'login_track' &&  $r_method == 'customer' ) { ?> active <?php } ?>"><a href="<?php echo admin_url(); ?>login_track/customer">Customer Login Track</a></li>
				</ul>
			</li>
			<?php if(get_session('admin_type') == 1 && isset(get_session('admin_permissions')['miscellaneous']->setting_menu) && get_session('admin_permissions')['miscellaneous']->setting_menu=='on'){  ?>
                <li class="<?php if(($r_class == 'scoreboard' &&  $r_method == 'add_scoreboard_offer' ) || ($r_class == 'setting' && ($r_method == 'index' ||  $r_method == 'add_payment_method' ) )) { ?> active <?php } ?>"> 
                    <a href="#"><i class="fa fa-cogs"></i> <span class="nav-label">Setting</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li class="<?php if($r_class == 'scoreboard' &&  $r_method == 'add_scoreboard_offer' ) { ?> active <?php } ?>"><a href="<?php echo admin_url(); ?>scoreboard/add_scoreboard_offer">Create Scoreboard Offer</a></li>
                        <li class="<?php if($r_class == 'setting' &&  $r_method == 'index' ) { ?> active <?php } ?>"><a href="<?php echo admin_url(); ?>setting">Configuration</a></li>
						<li class="<?php if($r_class == 'setting' &&  $r_method == 'add_payment_method' ) { ?> active <?php } ?>"><a href="<?php echo admin_url(); ?>setting/add_payment_method">Add Payment Method</a></li>
                    </ul>
                </li>
            <?php }  ?>
             <li class="<?php if($r_class == 'employee' && ($r_method == 'index')) { ?> active <?php } ?>">
                <a href="<?php echo admin_url(); ?>employee"><i class="fa fa-users"></i> <span class="nav-label">Employees Directory</span></a>
            </li>
        </ul>
    </div>
</nav>