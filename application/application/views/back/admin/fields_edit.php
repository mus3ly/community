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
     <?php
	    
	    $categories =json_decode($this->db->get_where('ui_settings',array('ui_settings_id' => 35))->row()->value,true);
                                            $result1=array();
                                            foreach($categories as $row){
                                                if($this->crud_model->if_publishable_category($row)){
                                                    $result1[]=$row;
                                                }
                                            }
	    
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
                        <?php
			            foreach($result1 as $k=> $v)
            			 {
            			     $row1 = $this->db->where('category_id', $v)->get('category')->row();
                           			if($row1)
                           			{
                           			    ?>
                           			    <option value="<?= $v ?>" <?php if($amenity_data['category'] == $v){echo 'selected';} ?> ><?= $row1->category_name; ?></option>
                           			    <?php
                           			}
            			 }
			 
			            
			            ?>
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
                    	placeholder="<?php echo translate('option'); ?>" value="<?= implode(',',json_decode($amenity_data['options'],true));?>" class="form-control">
                    		<p>use comma to seperate</p>
                </div>
            </div>
              <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('Sort');?></label>
                <div class="col-sm-6">
                    <select name="sort" class="form-control required">
                        <option value="0">Choose Option</option>
                        <option value="1"  <?php if($amenity_data['sort'] == '1'){echo 'selected';} ?>>1</option>
                        <option value="2" <?php if($amenity_data['sort'] == '2'){echo 'selected';} ?>>2</option>
                        <option value="3" <?php if($amenity_data['sort'] == '3'){echo 'selected';} ?>>3</option>
                        <option value="4" <?php if($amenity_data['sort'] == '4'){echo 'selected';} ?>>4</option>
                        <option value="5" <?php if($amenity_data['sort'] == '5'){echo 'selected';} ?>>5</option>
                        <option value="6" <?php if($amenity_data['sort'] == '6'){echo 'selected';} ?>>6</option>
                        </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('position');?></label>
                <div class="col-sm-6">
                    <select name="position" class="form-control required">
                        <option value="0">Choose Position</option>
                        <option value="1" <?php if($amenity_data['position'] == '1'){echo 'selected';} ?>>1</option>
                        <option value="2" <?php if($amenity_data['position'] == '2'){echo 'selected';} ?>>2</option>
                        <option value="3" <?php if($amenity_data['position'] == '3'){echo 'selected';} ?>>3</option>
                        </select>
                </div>
            </div>
     <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('prefix');?></label>
                <div class="col-sm-6">
                <input type="text" name="prefix" class="form-control" value="<?= $amenity_data['prefix']?>">
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
