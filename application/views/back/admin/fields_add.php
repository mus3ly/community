<div>
	<?php
        echo form_open(base_url() . 'admin/list_fields/do_add/', array(
            'class' => 'form-horizontal',
            'method' => 'post',
            'id' => 'amenity_add',
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
                         <option value="">Select Category</option>
			            <?php
			            foreach($result1 as $k=> $v)
            			 {
            			     $row1 = $this->db->where('category_id', $v)->get('category')->row();
                           			if($row1)
                           			{
                           			    ?>
                           			    <option value="<?= $v ?>" ><?= $row1->category_name; ?></option>
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
                    <select name="sort" class="form-control required">
                        <option value="0">Choose Option</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('position');?></label>
                <div class="col-sm-6">
                    <select name="position" class="form-control required">
                        <option value="0">Choose Position</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        </select>
                </div>
            </div>
     <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('prefix');?></label>
                <div class="col-sm-6">
                <input type="text" name="prefix" class="form-control">
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
