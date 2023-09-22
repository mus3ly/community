<?php
	foreach($amenity_data as $row){
?>
    <div>
        <?php
			echo form_open(base_url() . 'admin/amenity/update/' . $row['amenity_id'], array(
				'class' => 'form-horizontal',
				'method' => 'post',
				'id' => 'amenity_edit',
				'enctype' => 'multipart/form-data'
			));
		?>
            <div class="panel-body">

                <div class="form-group">
                    <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('amenity_name');?></label>
                    <div class="col-sm-6">
                        <input type="text" value="<?php echo $row['name'];?>" 
                        	name="name" id="demo-hor-1" class="form-control required">
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
			                   <option value="<?= $value['category_id']; ?>" <?= isset($row['catid']) && $row['catid'] == $value['category_id']?'selected':'' ?>><?= $value['category_name']; ?></option>
			                   <?php
			                }
                        }
			            ?>
                        </select>
                </div>
            </div>
                <!--<div class="form-group">-->
                <!--    <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('fa_icon');?></label>-->
                <!--    <div class="col-sm-6">-->
                <!--        <input type="text" value="<?php // echo $row['fa_icon'];?>" -->
                <!--            name="fa_icon" id="demo-hor-1" class="form-control required">-->
                <!--    </div>-->
                <!--    <br>-->
                <!--    <span><a href="https://fontawesome.com/v4/icons/">Click here</a> to find icon code</span>-->
                <!--</div>-->
                
            </div>
        </form>
    </div>

<?php
	}
?>

<script src="<?php echo base_url(); ?>template/back/js/custom/amenity_form.js"></script>


