<!DOCTYPE html>
<html>
<head>
	<title>Complete Care Home Warranty</title>
	<style type="text/css">
		p{
			margin: 0;
		}
	</style>
</head>
<body>

<table border="0" cellpadding="1" cellspacing="1" style="width:600px; margin: 0 auto;">
        <tbody>
            <tr>
                <td>
                	<p>Dear <?php echo $details['first_name']; ?>,</p>
					<br>
					<br>
					<p>Thank you for choosing Complete Care Home Warranty. Our home warranty plans take the unexpected expense out of home repairs. When a covered item breaks, simply submit your claim by calling us 1-860-777-0204. Our Claims Department is available 24-hours a day, 7 days a week.<br>Please review your policy details below and make sure it is accurate:</p>
                    <br>
                    <br>
                    <strong style="margin: 10px 0 0;"><u>Policy Number: </u></strong>  <?php echo $latest_policy['policy_num']; ?>
                    <br>
                    <br>
                    <strong style="margin: 10px 0 0;"><u>Policy Holder: </u></strong>  <?php echo $details['first_name'].' '.$details['last_name']; ?>
                    <br>
                    <br>
                    <strong style="margin: 10px 0 0;"><u>Coverage Address: </u></strong>  <?php echo $details['street_address'].' '.$details['city'].' '.$details['state'].' '.$details['zip_code']; ?>
                    <br>
                    <br>
                    <strong style="margin: 10px 0 0;"><u>Plan: </u></strong>  <?php echo $plan_value; ?>
                    <br>
                    <br>
                    <strong style="margin: 10px 0 0;"><u>Optional Coverage: </u></strong>  <?php if (empty($extra_coverage)){ ?> None <?php }else{ echo $extra_coverage; } ?>
                    <br>
                    <br>
                    <!-- <strong style="margin: 10px 0 0;"><u>Contract Holder Name:</u></strong>  Stu McKnelly  
                    <br>
                    <br>
                    <strong style="margin: 10px 0 0;"><u>Covered Property:</u></strong>  6495 E Happy Canyon RD APT 72 Denver CO 80237 
                    <br>
                    <br>
                    <strong style="margin: 10px 0 0;"><u>Property Type:</u></strong>  Single Family
                    <br>
                    <br>
                    <br> -->
                    <strong style="margin: 10px 0 0;"><u>Term: </u></strong>  <?php echo date('m/d/Y', strtotime($latest_policy['plan_start'])); ?> - <?php echo date('m/d/Y', strtotime($latest_policy['plan_end'])); ?>
                    <br>
                    <br>
                    <strong style="margin: 10px 0 0;"><u>Plan Price: </u></strong> <?php echo '$'.$latest_policy['net_total']; if ($latest_policy['payment_as'] == 2){ ?> per month <?php } ?> (The charge will show up as "Complete Care Home Warranty" on your credit card statement.)
                    <br>
                    <br>
                    <strong style="margin: 10px 0 0;"><u>Service Call Fee: </u></strong>  <?php echo $scf_value; ?>
                    <br>
                    <br>
                    <p>At Complete Care Home Warranty, we strive to constantly offer our customers fast and effective solutions with our network of qualified service contractors. We sincerely thank you for this opportunity to serve you. If you have any questions or concerns, please contact us at 1-860-777-0204.</p>
                    <br>
                    <br>
                    <br>
                    <a style="background: #29C0DA;color: #fff;text-decoration: none;padding: 10px 20px;border-radius: 2px;" href="<?php echo $policy_url; ?>" class="btn btn-primary"> Download Your Policy</a>
                    <br>
                    <br>
                    <br>
                    <p>-- Sincerely,</p>
                    <p>Complete Care Home Warranty</p>
                    <p>Toll Free:(860) 777-0204</p>
                </td>
            </tr>

            
            </tbody>
        </table>

</body>
</html>
