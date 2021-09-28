<div class="form_section">
    <div class="row align-items-end">
        <div class="col-8">
            <div class="form-group">
                <label>Vendors</label>
                <input type="hidden" class="vendor-claim" name="claim" value="<?php echo $claim; ?>">
                <input type="hidden" class="customer-claim" name="customer" value="<?php echo $customer; ?>">
                <select class="form-control vendor" name="vendor">
                    <option selected value="">Select Vendor</option>
                    <?php foreach ($vendors as $vendor){ ?>
                        <option value="<?php echo $vendor['id']; ?>" <?php if (!empty($old_vendor)){
                            if ($old_vendor==$vendor['id']){ ?> selected <?php }
                        } ?>><?php echo $vendor['company']; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="col-4">
            <div class="btn_submit text-center">
                <button class="btn btn-primary btn-lg m-t-n-xs select-vendor mb-3 btn-block" type="submit"><strong>Select</strong></button>
            </div>
        </div>
    </div>
    <div class="vendor-detail"></div>
</div>
<script>
    $('.vendor').on('change', function () {
        var _this=$(this);
        var id = _this.val();
        if (id!=''){
            $.ajax({
                url:admin_url+'claims/vendor_details',
                type: 'POST',
                data: { id : id},
                dataType:'json',
                success:function(status){
                    if(status.msg=='success'){
                        $('.vendor-detail').html(status.response);
                    }
                    else if(status.msg == 'error'){
                        toastr.error(status.response);
                    }
                }
            });
        } else {
            $('.vendor-detail').html('');
        }
    });

    $('.select-vendor').on('click', function () {
        var vendor = $('.vendor').val();
        var claim = $('.vendor-claim').val();
        var customer = $('.customer-claim').val();
        if (vendor==''){
            toastr.error("Select vendor from list");
        } else {
            var btn = $('.select-vendor').ladda();
            btn.ladda('start');
            $.ajax({
                url:admin_url+'claims/update_vendor',
                type: 'POST',
                data: { vendor : vendor, claim: claim, customer : customer},
                dataType:'json',
                success:function(status){
                    if(status.msg=='success'){
                        btn.ladda('stop');
                        toastr.success(status.response, 'Success');
                        setTimeout(function () {
                            window.location.replace(admin_url+"customers/edit/"+customer+"/"+claim);
                        }, 2000);
                    }
                    else if(status.msg == 'error'){
                        toastr.error(status.response);
                    }
                }
            });
        }
    });
</script>
