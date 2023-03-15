<div>
	<?php
        echo form_open(base_url() . 'admin/list_fields/do_add/', array(
            'class' => 'form-horizontal',
            'method' => 'post',
            'id' => 'amenity_add',
            'enctype' => 'multipart/form-data'
        ));
    ?>
        <div class="panel-body">

            <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('name');?></label>
                <div class="col-sm-6">
                    <input type="text" name="name" id="demo-hor-1" 
                    	placeholder="<?php echo translate('name'); ?>" class="form-control required">
                    	<p>should be small letters with  no space like slug</p>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('label');?></label>
                <div class="col-sm-6">
                    <input type="text" name="label" id="demo-hor-1" 
                    	placeholder="<?php echo translate('label'); ?>" class="form-control required">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('placeholder');?></label>
                <div class="col-sm-6">
                    <input type="text" name="placeholder" id="demo-hor-1" 
                    	placeholder="<?php echo translate('placeholder'); ?>" class="form-control required">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('Required');?></label>
                <div class="col-sm-6">
                    <input type="checkbox" name="is_required" id="demo-hor-1" 
                    	placeholder="<?php echo translate('required'); ?>" value="1" class="form-control required">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('category');?></label>
                <div class="col-sm-6">
                    <select name="category" id="demo-hor-2" class="form-control required">
                        <option value="808">Property</option>
                        <option value="807">Cars</option>
                        <option value="917">Events</option>
                        <option value="78">Jobs</option>
                        </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('field_type');?></label>
                <div class="col-sm-6">
                    <select name="type" id="selecttype" class="form-control required">
                        <option value=" ">Select Field type</option>
                        <option value="text">Text</option>
                        <option value="textarea">Textarea</option>
                        <option value="select">Select</option>
                        </select>
                </div>
            </div>
               <div class="form-group" id="option" style="display:none;">
                <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('option');?></label>
                <div class="col-sm-6">
                    <input type="text" name="option" id="demo-hor-1" 
                    	placeholder="<?php echo translate('option'); ?>" value="" class="form-control">
                    		<p>use comma to seperate</p>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('Sort');?></label>
                <div class="col-sm-6">
                    <input type="number" name="sort" id="demo-hor-1" 
                    	placeholder="<?php echo translate('sort'); ?>" value="1" class="form-control required">
                </div>
            </div>

          
        </div>
	</form>
</div>
<script src="<?php echo base_url(); ?>template/back/js/custom/amenity_form.js"></script>
<script>
    $('#selecttype').on('change', function(){
       if($(this).val() == 'select'){
          $('#option').css({'display':'block'});
            
       }else{
            $('#option').css({'display':'none'});
       }
    });
</script>
