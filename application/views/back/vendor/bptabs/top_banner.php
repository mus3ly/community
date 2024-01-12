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
<div class="col-md-6">
        <div class="col-md-12">
            <div class="form-group">
                <label> <?php echo translate('Ad Tags');?> </label>
                <input type="text" name="tag" value="
						<?= (isset($row->tag)?$row->tag:''); ?>" data-role="tagsinput" placeholder="
						<?php echo translate('enter comma (,) to add more');?>" class="form-control">
            </div>
        </div> <?php
                            if(isset($mod) && $mod->is_address)
                            {
                            ?> <div class="form-group btm_border">
            <label class="col-sm-4 control-label" for="demo-hor-6"> <?php echo translate('address');?> </label>
            <div class="col-sm-4">
                <select class="form-control required" name="warehouse"> <?php
                                        foreach($warehouse as $k => $v){
                                        ?> <option value="
								<?= $v['address_id'];?>"> <?= $v['title'];?> </option> <?php
                                        }
                                        ?> </select>
                <p>You can add new warehouses by <a href="
								<?= base_url('/vendor/address'); ?>">Clicking here </a>
                </p>
            </div>
        </div> <?php
                            }
                            ?> 
    </div>
</div>