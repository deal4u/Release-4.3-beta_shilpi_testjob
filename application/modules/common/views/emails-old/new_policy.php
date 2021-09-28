<!DOCTYPE html>
<html>

<head>
    <title>Complete Care Home Warranty</title>
    <style type="text/css">
        p {
            margin: 0;
        }
    </style>
</head>

<body>

<span style="font-size:x-small">To ensure delivery of&nbsp;<span>Complete</span>&nbsp;<span>Care</span>&nbsp;<span>Home</span>&nbsp;<span>Warranty</span>&nbsp;<wbr>emails, please add&nbsp;<a href="mailto:info@completecarehomewarranty.com" target="_blank">Info@completecarehomewarranty.<wbr>com</a>&nbsp;to your address book.</span>

<p>&nbsp;</p>
    <table align="center" border="0" cellpadding="0" cellspacing="0" width="443">
        <tbody>
            <tr>
                <td align="right" colspan="4"><br></td>
            </tr>
            <tr>
                <td colspan="2" style="font-size:14px">
                    <p align="center">
                        <b><span style="font-size:12pt;font-family:Helvetica,sans-serif;color:black"><span>Welcome to Complete Care Home Warranty&nbsp;- We've Got You Covered!</span>
                        </b>
                    </p>

                    <p>
                        <span style="font-size:12pt;font-family:Helvetica,sans-serif;color:black">
                            Dear <?php echo $details['first_name']; ?>,</span>
                            <br>
                            <span style="font-size:12pt;font-family:Helvetica,sans-serif;color:black"><br>Thank you for choosing&nbsp;<span>Complete</span>&nbsp;<span>Care</span>&nbsp;<span>Home Warranty</span><wbr>. Our&nbsp;<span>home</span>&nbsp;warranty plans take the unexpected expense out of&nbsp;<span>home</span>&nbsp;repairs. When a covered item breaks, simply call 1-860-777-0204. Our Claims Department is available 24-hours a day, 7 days a week.&nbsp;</span></p>
                            <br>
                    <p style="margin-bottom:0.0001pt;line-height:normal;background-image:initial;background-position:initial;background-size:initial;background-repeat:initial;background-origin:initial;background-clip:initial"><span style="font-size:12pt;font-family:Helvetica,sans-serif;color:black">Please review your policy details below and make sure it is accurate:</span></p>
                    <br>
                    <p style="margin-bottom:0.0001pt;line-height:normal;background-image:initial;background-position:initial;background-size:initial;background-repeat:initial;background-origin:initial;background-clip:initial">
                    <b><span style="font-size:12pt;font-family:Helvetica,sans-serif;color:black">Policy Number: <?php echo $latest_policy['policy_num']; ?></span></b><br>
                    <b><span style="font-size:12pt;font-family:Helvetica,sans-serif;color:black">Policy Holder: <?php echo $details['first_name'].' '.$details['last_name']; ?><br>
                    Coverage Address: <?php echo $details['street_address'].' '.$details['city'].' '.$details['state'].' '.$details['zip_code']; ?></span></b>
                    
                    <br><b><span style="font-size:12pt;font-family:Helvetica,sans-serif;color:black">
                    Plan: <?php echo $plan_value; ?></span></b><br>
                    
                    <b><span style="font-size:12pt;font-family:Helvetica,sans-serif;color:black">Optional Coverage: <?php if (empty($extra_coverage)){ ?> None <?php }else{ echo $extra_coverage; } ?></span></b><br>
                    
                    <b><span style="font-size:12pt;font-family:Helvetica,sans-serif;color:black">
                    Term:  <?php echo date('m/d/Y', strtotime($latest_policy['plan_start'])); ?> - <?php echo date('m/d/Y', strtotime($latest_policy['plan_end'])); ?></span></b><br>
                    
                    <b><span style="font-size:12pt;font-family:Helvetica,sans-serif;color:black">
                    Plan Price: <?php echo '$'.$latest_policy['net_total']; if ($latest_policy['payment_as'] == 2){ ?> per month <?php } ?> &nbsp;</span></b><i>
                        
                    <span style="font-family:Helvetica,sans-serif">(Payments made to&nbsp;<span style="color:red">"<span>Complete</span>&nbsp;<span>Care&nbsp;Home</span>&nbsp;<span>Warranty</span>"</span>&nbsp;<wbr>will appear on your credit card statement.)</span></i><br><b><span style="font-size:12pt;font-family:Helvetica,sans-serif;color:black">
                    Service Call Fee: <?php echo $scf_value; ?></span></b>
                    
                    <span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><br></span><span style="font-size:12pt;font-family:Arial,sans-serif;color:black">&nbsp;&nbsp;</span><span style="font-size:9pt;font-family:Arial,sans-serif;color:black"><br></span><b><span style="font-size:12pt;font-family:Helvetica,sans-serif;color:black">Your hard copy policy will be mailed to you within 10-15 days. The mailing address on file is <?php echo $details['street_address'].' '.$details['city'].' '.$details['state'].' '.$details['zip_code']; ?> . We appreciate your patience.&nbsp;</span></b></p>

                    <p>&nbsp;</p>

                    <div style="width:443px;text-align:center">
                    <a href="<?php echo $policy_url; ?>" style="background-color:rgb(44,169,240);color:#ffffff;border:none;padding:15px 32px;text-decoration-line:none;display:inline-block;border-radius:5px;margin:20px" >CLICK HERE TO DOWNLOAD YOUR ePOLICY</a></div><span style="font-size:12pt;font-family:Arial,sans-serif;color:black">&nbsp;</span><span style="font-size:12pt;font-family:Helvetica,sans-serif;color:black"></span>
                    <p></p>

                    <p style="margin-bottom:0.0001pt;line-height:normal"><span style="font-size:12pt;font-family:Arial,sans-serif;color:black;background-image:initial;background-position:initial;background-size:initial;background-repeat:initial;background-origin:initial;background-clip:initial">At&nbsp;<span>Complete</span>&nbsp;<span>Care</span>&nbsp;<span>Home</span>&nbsp;<span>Warranty</span>, we strive to constantly offer our customers fast and effective solutions with our network of qualified service contractors. We sincerely thank you for this opportunity to serve you. If you have any questions or concerns, please contact us at&nbsp;1-860-777-0204</span><span style="font-size:12pt;font-family:Helvetica,sans-serif;color:black;background-image:initial;background-position:initial;background-size:initial;background-repeat:initial;background-origin:initial;background-clip:initial">.<br><br>Sincerely,</span></p>

                </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align:center">
                    <div>
                        <div style="text-align:left"><span style="font-size:12pt;font-family:arial,helvetica,sans-serif"><br><span>Complete</span>&nbsp;<span>Care</span>&nbsp;<span>Home</span>&nbsp;<span>Warranty</span><br clear="none">Toll Free:&nbsp;(860) 777-0204<br clear="none">Customer Service Hours: Monday-Friday, 9am-7pm EST<font color="#888888"><br></font></span>
                            <font color="#888888"></font>
                        </div>
                        <font color="#888888">
                            <div style="text-align:left"><span style="font-size:12pt">&nbsp;</span></div>
                            <div style="text-align:left"><span style="font-size:12pt">&nbsp;</span></div>
                            <div style="text-align:left"><span style="font-size:12pt">&nbsp;</span></div>
                        </font>
                    </div>
                    <font color="#888888"><span style="font-family:arial,helvetica,sans-serif;font-size:8pt;color:rgb(128,128,128)"><span>Complete</span>&nbsp;<span>Care</span>&nbsp;<span>Home</span>&nbsp;<span>Warranty</span></span><br>
                
                    <!-- <span style="font-family:arial,helvetica,sans-serif;font-size:8pt;color:rgb(128,128,128)">325 Chestnut Street Philadelphia, Pennsylvania 19106 United States (800) 545-0402</span> -->
                
                </font>
                </td>
            </tr>
        </tbody>
    </table>

</body>

</html>