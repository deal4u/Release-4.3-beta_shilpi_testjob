<div class="form_section">
    <h2 class="mb-4">Diagnose Details</h2>
    <form method="post" id="update-diagnose">
        <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label>Contractor</label>
                    <input type="hidden" name="id" value="<?php echo $claim['id']; ?>">
                    <input type="text" class="form-control" required="required" name="contractor" value="<?php echo $claim['contractor']; ?>">
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label>Tech Name</label>
                    <input type="text" class="form-control" required="required" name="tech" value="<?php echo $claim['tech_name']; ?>">
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label>Called In By</label>
                    <input type="text"  class="form-control" required="required" name="call_by" value="<?php echo $claim['called_by']; ?>">
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    <label>Tech At Home</label>
                    <input type="text" class="form-control" required="required" name="tech_home" value="<?php echo $claim['tech_home']; ?>">
                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="form-group" id="data_9">
                    <label>There When</label>
                    <div class="input-group date">
                     <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" required="required" name="there_when" value="<?php echo $claim['there_when']; ?>" placeholder="dd-mm-yyyy">
                 </div>
             </div>
         </div>
         <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label>Type</label>
                <input type="text" class="form-control" required="required" name="type" value="<?php echo $claim['type']; ?>">
            </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label>Age</label>
                <input type="number" class="form-control" required="required" name="age" value="<?php echo $claim['age']; ?>">
            </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label>Size</label>
                <input type="text" class="form-control" required="required" name="size" value="<?php echo $claim['size']; ?>">
            </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label>Property Installed</label>
                <input type="text" class="form-control" required="required" name="p_installed" value="<?php echo $claim['p_installed']; ?>">
            </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label>Rust Or Corrosion</label>
                <input type="text" class="form-control" required="required" name="rust" value="<?php echo $claim['rust']; ?>">
            </div>
        </div>
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label>Cause of Failure</label>
                <input type="text" class="form-control" required="required" name="cause_failure" value="<?php echo $claim['failure_cause']; ?>">
            </div>
        </div>
        <div class="col-xl-12 col-lg-12 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label>DIAGONSIS</label>
                <textarea class="form-control" required="required" name="diagnose"><?php echo $claim['diagnosis']; ?></textarea>
            </div>
        </div>
    </div>
    <div class="hr-line-dashed"></div>
    <div class="row">
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label>Part Number</label>
                <input type="text" class="form-control" required="required" name="p_number" value="<?php echo $claim['p_number']; ?>">
            </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label>Part Number Price</label>
                <div class="input-group mb-3 ">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">$</span>
                    </div>
                    <input type="text" class="form-control" required="required" name="p_price" value="<?php echo $claim['p_price']; ?>">
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label>Service Call Fee</label>
                <div class="input-group mb-3 ">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">$</span>
                    </div>
                    <input type="text" class="form-control" required="required" name="service_fee" value="<?php echo $claim['service_fee']; ?>">
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label>Paid By</label>
                <input type="text" class="form-control" required="required" name="paid_by" value="<?php echo $claim['paid_by']; ?>">
            </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label>Overall Unit Condition</label>
                <input type="text" class="form-control" required="required" name="condition" value="<?php echo $claim['condition']; ?>">
            </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label>Leaks</label>
                <input type="text" class="form-control" required="required" name="leak" value="<?php echo $claim['leaks']; ?>">
            </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label>Leak Size</label>
                <input type="text" class="form-control" required="required" name="leak_size" value="<?php echo $claim['leak_size']; ?>">
            </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label>Make</label>
                <input type="text" class="form-control" required="required" name="make" value="<?php echo $claim['p_make']; ?>">
            </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label>Model</label>
                <input type="text" class="form-control" required="required" name="model" value="<?php echo $claim['p_model']; ?>">
            </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label>Number of Units</label>
                <input type="number" class="form-control" required="required" name="units" value="<?php echo $claim['p_units']; ?>">
            </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label>Property Maintained</label>
                <input type="text" class="form-control" required="required" name="p_maintained" value="<?php echo $claim['p_maintained']; ?>">
            </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label>Overloaded</label>
                <input type="text" class="form-control" required="required" name="overloaded" value="<?php echo $claim['overloaded']; ?>">
            </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 col-xs-12">
            <div class="form-group">
                <label>Total</label>

                <div class="input-group mb-3 ">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">$</span>
                    </div>
                    <input type="text" class="form-control" required="required" name="total" value="<?php echo $claim['total']; ?>">
                </div>
            </div>
        </div>
    </div>
    <div class="hr-line-dashed"></div>
    <div class="btn_submit text-center">
        <button class="btn btn-primary btn-lg m-t-n-xs submit-diagnose" type="submit"><strong>Submit</strong></button>
    </div>
</form>
</div>