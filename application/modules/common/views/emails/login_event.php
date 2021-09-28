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

<p>&nbsp;</p>
    <table align="center" border="0" cellpadding="0" cellspacing="0" width="443">
        <tbody>
            <tr>
                <td align="right" colspan="4"><br></td>
            </tr>
            <tr>
                <td>
                    <?php if($type=="valid"){?>
                        <p>New login has been recorded.</p>
                    <?php }else{ ?> 
                        <p>Invalid login.</p>
                    <?php } ?>   
                    <p><b>Email:</b><?php echo $email;?></p>
                        <p><b>IP:</b><?php echo $ip;?></p>
                </td>
            </tr>
          
        </tbody>
    </table>

</body>

</html>