<div class="form_section">
    <div class="table-responsive">
        <table class="table">
            <tr>
                <td><strong>Company</strong></td>
                <td><?php echo $vendor['company']; ?></td>
            </tr>
            <tr>
                <td><strong>Email</strong></td>
                <td><?php echo $vendor['email']; ?></td>
            </tr>
            <tr>
                <td><strong>Phone/Fax</strong></td>
                <td><?php echo $vendor['phone']; ?>/<?php echo $vendor['fax']; ?></td>
            </tr>
            <tr>
                <td><strong>Address</strong></td>
                <td><?php echo $vendor['street_address'].' '.$vendor['city'].', '.$vendor['zip_code']; ?></td>
            </tr>
            <tr>
                <td><strong>Services</strong></td>
                <td>
                    <?php foreach ($services as $service){ ?>
                        <span class="vendor-services mb-1"><?php echo vendor_services($service['service']); ?></span>
                    <?php } ?>
                </td>
            </tr>
        </table>
    </div>
    <div class="hr-line-dashed"></div>
</div>
