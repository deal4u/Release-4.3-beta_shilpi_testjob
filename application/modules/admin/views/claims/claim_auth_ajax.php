
<div class="table-responsive">
    <table id="revoke_table_ajax" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
        <thead>
            <tr>
                <th>Authorization No</th>
                <th>Customer/Vendor</th>
                <th>Type</th>
                <th>Amount</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>


            <?php foreach ($claim_auth as $claim) {

                ?>
                <tr class="gradeX" id="claim_<?php echo $claim['id']; ?>">
                 <td><?php   $get_claim_data = get_claim_data($claim['claim']);
                 echo $claim['auth_num']; ?></td>
                 <td>
                  <?php if ($claim['auth_for']==1){

                    $customer = get_customers($get_claim_data['customer']);
                    echo $customer['first_name'].' '.$customer['last_name'];
                }else{
                    $vendor = get_vendors($get_claim_data['vendor']);
                    echo $vendor['name'];
                } ?>
            </td>
            <td><?php echo get_invoice_type($claim['type']); ?></td>
            <td>
                <?php echo '$'.number_format((float)$claim['amount'], 2, '.', ''); ?>
            </td>
            <td>
                <button class="btn btn-danger remove_auth btn-sm" data-id="<?php echo $claim['id']; ?>" >Remove Authorization</button>

            </td>

        </tr>

    <?php  } ?>

</tbody>

</table>
