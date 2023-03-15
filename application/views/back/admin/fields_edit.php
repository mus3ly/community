<div>
	<?php
	if(isset($amenity_data[0]))
        $amenity_data = $amenity_data[0];
        echo form_open(base_url() . 'admin/list_fields/update/'.$amenity_data['id'], array(
            'class' => 'form-horizontal',
            'method' => 'post',
            'id' => 'fields_edit',
            'enctype' => 'multipart/form-data'
        ));
        
    ?>
        <div class="panel-body">

            <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('name');?></label>
                <div class="col-sm-6">
                    <input type="text" name="name" id="demo-hor-1" 
                    	placeholder="<?php echo translate('name'); ?>" value="<?= $amenity_data['name']; ?>" class="form-control required">
                    	<p>should be small letters with  no space like slug</p>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('label');?></label>
                <div class="col-sm-6">
                    <input type="text" name="label" id="demo-hor-1" 
                    	placeholder="<?php echo translate('label'); ?>"  value="<?= $amenity_data['label']; ?>" value="1" class="form-control required">
                </div>
            </div>
             <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('placeholder');?></label>
                <div class="col-sm-6">
                    <input type="text" name="placeholder" id="demo-hor-1" 
                    	placeholder="<?php echo translate('placeholder'); ?>" value="<?= $amenity_data['placeholder']; ?>" class="form-control required">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('Required');?></label>
                <div class="col-sm-6">
                    <input type="checkbox" name="is_required" id="demo-hor-1" 
                    	placeholder="<?php echo translate('required'); ?>" value="1" class="form-control required"  <?= (isset($amenity_data['is_required'])&& $amenity_data['is_required'])?"checked":"" ?>>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('category');?></label>
                <div class="col-sm-6">
                    <select name="category" id="demo-hor-2" class="form-control required">
                        <option value="808" <?php if($amenity_data['category'] == '808'){echo 'selected';} ?>>Property</option>
                        <option value="807" <?php if($amenity_data['category'] == '807'){echo 'selected';} ?>>Cars</option>
                        <option value="917" <?php if($amenity_data['category'] == '917'){echo 'selected';} ?>>Events</option>
                        <option value="78" <?php if($amenity_data['category'] == '78'){echo 'selected';} ?>>Jobs</option>
                        </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('field_type');?></label>
                <div class="col-sm-6">
                    <select name="type" id="selecttype" class="form-control required">
                        <option value="0">Select Field type</option>
                        <option value="text" <?php if($amenity_data['type'] == 'text'){echo 'selected';} ?>>Text</option>
                        <option value="textarea" <?php if($amenity_data['type'] == 'textarea'){echo 'selected';} ?>>Textarea</option>
                        <option value="select" <?php if($amenity_data['type'] == 'select'){echo 'selected';} ?>>select</option>
                        </select>
                </div>
            </div>
                 <div class="form-group" id="option" style="display:<?= ($amenity_data['type'] == 'select')?"block":"none"; ?>;">
                <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('option');?></label>
                <div class="col-sm-6">
                    <input type="text" name="option" id="demo-hor-1" 
                    	placeholder="<?php echo translate('option'); ?>" value="<?= implode(',',json_decode($amenity_data['options'],true));?>" class="form-control required">
                    		<p>use comma to seperate</p>
                </div>
            </div>
              <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('Sort');?></label>
                <div class="col-sm-6">
                    <input type="number" name="sort" id="demo-hor-1" 
                    	placeholder="<?php echo translate('sort'); ?>" value="<?= $amenity_data['sort'];?>" class="form-control required">
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
