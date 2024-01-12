<div class="row">
    
    <div class="col-md-6">
<div class="col-md-12">
        <?php
                            if(isset($mod) && !$mod->hide_bus)
                            {
                            ?> <div class="form-group btm_border">
            <label class="col-sm-4 control-label" for="demo-hor-6"> <?php echo translate('whatsapp_number');?> </label>
            <div class="col-md-12 col-sm-12">
                <input type="number" name="whatsapp_number" id="demo-hor-6" min='0' step='.01' placeholder="
							<?php echo translate('whatsapp_number');?>" value="
							<?= $row['whatsapp_number'] ?>" class="form-control ">
            </div>
        </div>
        <div class="form-group btm_border">
            <label class="col-sm-4 control-label" for="demo-hor-6"> <?php echo translate('business_email');?> </label>
            <div class="col-md-12 col-sm-12">
                <input type="email" name="bussniuss_email" id="demo-hor-6" min='0' step='.01' placeholder="
								<?php echo translate('business_email');?>" value="
								<?= $row['bussniuss_email'] ?>" class="form-control ">
            </div>
        </div>
        <div class="form-group btm_border">
            <label class="col-sm-4 control-label" for="demo-hor-6"> <?php echo translate('business_phone');?> </label>
            <div class="col-md-12 col-sm-12">
                <input type="number" name="bussniuss_phone" id="demo-hor-6" min='0' step='.01' placeholder="
									<?php echo translate('business_phone');?>" value="
									<?= $row['bussniuss_phone'] ?>" class="form-control ">
            </div>
        </div>
        <div class="form-group btm_border">
            <label class="col-sm-4 control-label" for="demo-hor-6"> <?php echo translate('city');?> </label>
            <div class="col-md-12 col-sm-12">
                <input type="text" name="city" id="demo-hor-6" min='0' step='.01' placeholder="
										<?php echo translate('city');?>" value="
										<?= $row['city'] ?>" class="form-control required">
            </div>
        </div> <?php
                            }//hide bus details
                            ?>
    </div>
</div>
</div>