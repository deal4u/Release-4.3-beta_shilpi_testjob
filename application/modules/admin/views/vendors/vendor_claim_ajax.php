<div class="modal-dialog modal-lg">
    <div class="modal-content" >
        <div class="modal-header">
            <h5 class="modal-title">Vendor Claims</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <div class="modal-body" >
            <div class="table-responsive">
                <table id="claims_tableee" style="width:100%;" class="table table-striped table-bordered dt-responsive nowrap">
                    <thead>
                        <tr>
                            <th>Claim#</th>
                            <th>Customer</th>
                            <th>Representative</th>
                            <th>Diagnose By</th>
                            <th>Vendor</th>
                            <th>Item</th>
                            <th>Problem</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($claim_auth as $claim) { ?>
                            <tr class="gradeX" id="claim_<?php echo $claim['id']; ?>">
                                <td>
                                    <a href="<?php echo admin_url(); ?>customers/edit/<?php echo $claim['customer']; ?>/<?php echo $claim['claim_num']; ?>" class="insert_log" id="<?php echo $claim['customer']; ?>"><?php echo $claim['claim_num']; ?></a>
                                </td>
                                <td>
                                    <?php $customer=get_customers($claim['customer']); ?>
                                    <a href="<?php echo admin_url(); ?>customers/edit/<?php echo $claim['customer']; ?>" class="insert_log" id="<?php echo $claim['customer']; ?>"><?php echo $customer['first_name'].' '.$customer['last_name']; ?></a>
                                </td>
                                <td>
                                    <?php
                                    $sales_person=get_staff_name($claim['representative']);
                                    echo $sales_person['FirstName'].' '.$sales_person['LastName'];
                                    ?>
                                </td>
                                <td>
                                    <?php if (!empty($claim['diagnose_by'])){
                                        $diagnoser=get_staff_name($claim['diagnose_by']);
                                        echo $diagnoser['FirstName'].' '.$diagnoser['LastName'];
                                    }else{ echo '-'; } ?>
                                </td>
                                <td>
                                    <?php if (!empty($claim['vendor'])){
                                        $vendor = get_vendors($claim['vendor']);
                                        echo $vendor['company'];
                                    }else{ echo '-'; } ?>
                                </td>
                                <td>
                                    <?php

                                    $str = $claim['item'];
                                    $str_meta_key = explode("-", $str);

                                    if ($str_meta_key[0] == 's') {
                                        $meta_tag = 'systems';
                                    } elseif ($str_meta_key[0] == 'a') {
                                        $meta_tag = 'appliance';
                                    } elseif ($str_meta_key[0] == 'c') {
                                        $meta_tag = 'combo';
                                    } else {
                                        $meta_tag = 'opt_coverage';
                                    }

                                    $get_meta_content = get_claim_value($meta_tag, $str_meta_key[1]);
                                    echo $get_meta_content['meta_content'];
                                    ?>
                                </td>
                                <td>
                                    <?php echo ucfirst($claim['problem']); ?>
                                </td>
                                <td>
                                    <?php echo date('F jS, Y - h:i a' ,strtotime($claim['created_at'])); ?>
                                </td>
                            </tr>
                        <?php  } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!--    <script>
    function fns() {
    $('#claims_tableee').dataTable({
        "paging": true,
        "searching": true,
        "responsive": true,
        "columnDefs": [
        { "responsivePriority": 0, "targets": 0 },
        { "responsivePriority": 2, "targets": -1 }
        ]
        
    });
    }

    
</script> -->