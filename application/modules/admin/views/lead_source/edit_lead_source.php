<div class="modal-content animated flipInY">
    <div class="modal-header">
        <h3 class="modal-title">Edit Lead Source</h3>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    </div>
    <form method="post" id="edit_lead_form">
        <input type="hidden" name="id" value="<?php echo $lead['id']; ?>">
        <div class="modal-body">
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" value="<?php echo $lead['name']; ?>" placeholder="" class="form-control">
                    </div>
                </div>
				<div class="col-8">
					<div class="form-group">
						<label>Phone Number</label>
						<input type="text" name="sales_phone_no" placeholder="" value="<?php echo $lead['sales_phone_no']; ?>" class="form-control">
					</div>
				</div>
				
				<div class="col-4">
					<label>Show on portal</label>
					<div class="form-group">
						<div class="form-check-inline">
						  <label class="form-check-label">
							<input type="radio" id="Yes" value="1" <?= ($lead['show_portal']==1) ? 'checked' : ''?> class="form-check-input" name="show_portal">Yes
						  </label>
						</div>
						<div class="form-check-inline">
						  <label class="form-check-label">
							<input type="radio" id="No" value="0" <?= ($lead['show_portal']==0) ? 'checked' : ''?> class="form-check-input" name="show_portal">No
						  </label>
						</div>
					</div>
				</div>
                <div class="col-12">
                    <div class="form-group">
                        <label>Lead Cost</label>
                        <input type="text" name="cost" value="<?php echo $lead['cost']; ?>" placeholder="" class="form-control">
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="0" <?php if ($lead['status']==0){ ?> selected <?php } ?>>InActive</option>
                            <option value="1" <?php if ($lead['status']==1){ ?> selected <?php } ?>>Active</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
            <button type="button" class="ladda-button btn btn-primary" id="update_source" data-style="expand-right">Update</button>
        </div>
    </form>
</div>
<script>

    $(document).on("click" , "#update_source" , function() {

        var btn = $(this).ladda();
        btn.ladda('start');
        var formData = $("#edit_lead_form").serialize();
        $.ajax({
            url: admin_url+'lead_source/update_lead_source',
            type: 'POST',
            data: formData,
            dataType:'json',
            success:function(status){
                btn.ladda('stop');
                if(status.msg=='success') {
                    $('#edit_lead_form')[0].reset();
                    toastr.success(status.response);
                    $('#source_edit_modal').modal('hide');
                    setTimeout(function(){ location.reload(); }, 2000);
                } else if(status.msg == 'error') {
                    toastr.error(status.response);
                }
            }
        });
    });
</script>
