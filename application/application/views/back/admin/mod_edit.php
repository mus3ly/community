<div>
	<?php
	if(isset($amenity_data[0]))
        $amenity_data = $amenity_data[0];
        echo form_open(base_url() . 'admin/module_sys/update/'.$amenity_data['id'], array(
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
                <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('label');?></label>
                <div class="col-sm-6">
                    <input type="text" name="label" id="demo-hor-1" 
                    	placeholder="<?php echo translate('label'); ?>"  value="<?= $amenity_data['label']; ?>" value="1" class="form-control required">
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
                <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('sub_category');?></label>
                <div class="col-sm-6">
                    <input type="text" name="sub_category" id="demo-hor-1" 
                    	placeholder="<?php echo translate('sub_category'); ?>"  value="<?= $amenity_data['sub_category']; ?>"  class="form-control ">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('front_view');?></label>
                <div class="col-sm-6">
                    <input type="text" name="front_view" id="demo-hor-1" 
                    	placeholder="<?php echo translate('front_view'); ?>"  value="<?= $amenity_data['front_view']; ?>"  class="form-control ">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('filter_file');?></label>
                <div class="col-sm-6">
                    <input type="text" name="filter_file" id="demo-hor-1" 
                    	placeholder="<?php echo translate('filter_file'); ?>"  value="<?= $amenity_data['filter_file']; ?>"  class="form-control ">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('business_page_text');?></label>
                <div class="col-sm-6">
                    <input type="text" name="bpage_text" id="demo-hor-1" 
                    	placeholder="<?php echo translate('business_page_text'); ?>"  value="<?= $amenity_data['bpage_text']; ?>"  class="form-control ">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('dir_text');?></label>
                <div class="col-sm-6">
                    <input type="text" name="dir_text" id="demo-hor-1" 
                    	placeholder="<?php echo translate('dir_text'); ?>"  value="<?= $amenity_data['dir_text']; ?>"  class="form-control ">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('dir_slug');?></label>
                <div class="col-sm-6">
                    <input type="text" name="dir_slug" id="demo-hor-1" 
                    	placeholder="<?php echo translate('dir_slug'); ?>"  value="<?= $amenity_data['dir_slug']; ?>" value="1" class="form-control required">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('dir_icon');?></label>
                <div class="col-sm-6">
                    <input type="text" name="dir_icon" id="demo-hor-1" 
                    	placeholder="<?php echo translate('dir_icon'); ?>"  value="<?= $amenity_data['dir_icon']; ?>" value="1" class="form-control ">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('dir_check');?></label>
                <div class="col-sm-6">
                    <input type="checkbox" name="dir_check" id="demo-hor-1" 
                    	  value="1" <?php if($amenity_data['dir_check'] == '1' ){echo 'checked';} ?> >
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('bpage_check');?></label>
                <div class="col-sm-6">
                    <input type="checkbox" name="bpage_check" id="demo-hor-1" 
                    	  value="1" <?php if($amenity_data['bpage_check'] == '1' ){echo 'checked';} ?> >
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('hide_business');?></label>
                <div class="col-sm-6">
                    <input type="checkbox" name="hide_business" id="demo-hor-1" 
                    	  value="1" <?php if($amenity_data['hide_bus'] == '1' ){echo 'checked';} ?> >
                </div>
            </div>
            <div>
                <table style="width:100%">
  <tr>
    <th>Tab</th>
    <th>Text</th>
    <th>Position</th>
  </tr>
  <?php
  $tabs = json_decode($amenity_data['tabs'],true);
  $label = (isset($tabs['label'])?$tabs['label']:array());
  $sort = (isset($tabs['sort'])?$tabs['sort']:array());
  $this->db->order_by("sort", "asc");

                        $tabs = $this->db->get('listing_tabs')->result_array();
                        foreach($tabs as $k=> $v)
                        {
                            ?>
                                <tr>
    <td><?= $v['label']; ?></td>
    <td>
        <input type="hidden"value="<?= $v['key']; ?>" name="key[<?= $v['id'] ?>]" />
        <input type="text"value="<?= isset($label[$v['id']])?$label[$v['id']]:$v['name']; ?>" name="name[<?= $v['id'] ?>]" />
    </td>
    <td><input type="number" value="<?= isset($sort[$v['id']])?$sort[$v['id']]:$v['sort']; ?>" name="sort[<?= $v['id'] ?>]" /></td>
  </tr>                     
                            <?php
                        }
  ?>
</table>
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
