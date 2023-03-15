<div>
	<?php
        echo form_open(base_url() . 'admin/makes/do_add/', array(
            'class' => 'form-horizontal',
            'method' => 'post',
            'id' => 'makes_add',
            'enctype' => 'multipart/form-data'
        ));
    ?>
        <div class="panel-body">

            <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('makes_name');?></label>
                <div class="col-sm-6">
                    <input type="text" name="name" id="demo-hor-1" 
                    	placeholder="<?php echo translate('makes_name'); ?>" class="form-control required">
                </div>
            </div>
     

          
        </div>
	</form>
</div>
<script src="<?php echo base_url(); ?>template/back/js/custom/amenity_form.js"></script>

