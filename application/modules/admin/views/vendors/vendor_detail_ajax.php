<div class="form_section">
    <div class="table-responsive">
        <table class="table">
            <tr>
                <td><strong>Company</strong></td>
                <td class="text-navy"><?php echo $vendor['company']; ?></td>
                <td><strong>Name</strong></td>
                <td><?php echo $vendor['name']; ?></td>
            </tr>
            <tr>
                <td><strong>Email</strong></td>
                <td><?php echo $vendor['email']; ?></td>
                <td><strong>Phone/Fax</strong></td>
                <td><?php echo $vendor['phone']; ?><span class="font-bold">/</span><?php echo $vendor['fax']; ?></td>
            </tr>

            <tr>
                <?php if (get_session('admin_type') == 1 || (get_session('admin_type') == 2 && get_session('admin_permissions')['miscellaneous'] != 'N/A' && isset(get_session('admin_permissions')['miscellaneous']->status))) { ?>
                <td><strong>Status</strong></td>
                <td><?php if($vendor['status'] == 1){
                    $label_class = 'primary';
                    $label = 'Active';
                }else{
                    $label_class = 'danger';
                    $label = 'InActive';
                } ?>
                <span class="label label-<?php echo $label_class; ?>"><?php echo $label; ?></span></td>
                <?php } ?>
                <td><strong>Join Date</strong></td>
                <td><?php echo date('F jS, Y - h:i a' ,strtotime($vendor['created_at'])); ?></td>
            </tr>
            <tr>
                <td><strong>Address</strong></td>
                <td colspan="3"><?php echo $vendor['street_address'].' '.$vendor['city'].', '.$vendor['state']; ?></td>
            </tr>
            <tr>
                <td><strong>Services</strong></td>
                <td width="35%">
                    <?php
                    $services = get_data('','vendor_services',array('vendor'=>$vendor['id']),'service');
                    foreach ($services as $service){ ?>
                        <span class="vendor-services"><?php echo vendor_services($service['service']); ?></span>
                    <?php } ?>
                </td>
                <td><strong>Zip Code</strong></td>
                <td><?php echo $vendor['zip_code']; ?></td>
            </tr>
            <tr>
                <td><strong>Zip Codes Serviced</strong></td>
                <td colspan="3">
                    <?php $zip_codes = get_zip_codes($vendor['id']);
                    foreach ($zip_codes as $zip_code){ ?>
                        <span class="vendor-services">
                            <?php echo $zip_code['meta_value']; ?>
                       </span>
                    <?php } ?>
                </td>
            </tr>
        </table>
    </div>
    <div class="hr-line-dashed"></div>
</div>
