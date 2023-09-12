<div>
	<?php
        echo form_open(base_url() . 'admin/amenity/do_add/', array(
            'class' => 'form-horizontal',
            'method' => 'post',
            'id' => 'amenity_add',
            'enctype' => 'multipart/form-data'
        ));
    ?>
        <div class="panel-body">

            <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('amenity_name');?></label>
                <div class="col-sm-6">
                    <input type="text" name="name" id="demo-hor-1" 
                    	placeholder="<?php echo translate('amenity_name'); ?>" class="form-control required">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('category');?></label>
                <div class="col-sm-6">
                    <select name="cat" id="demo-hor-2" class="form-control required">
                        <option value="0" selected>Select Category</option>
			            <?php
			             $categories =json_decode($this->db->get_where('ui_settings',array('ui_settings_id' => 35))->row()->value,true);
			            foreach($categories as $k => $v){
			                $cat = $this->db->get_where('category', array('category_id' => $v))->result_array();
			                foreach($cat as $key => $value){
			                   ?>
			                   <option value="<?= $value['category_id']; ?>"><?= $value['category_name']; ?></option>
			                   <?php
			                }
                        }
			            ?>
                        </select>
                </div>
            </div>

          
        </div>
	</form>
</div>
<script src="<?php echo base_url(); ?>template/back/js/custom/amenity_form.js"></script>

