<?php
	foreach($amenity_data as $row){
?>
    <div>
        <?php
			echo form_open(base_url() . 'admin/makes/update/' . $row['id'], array(
				'class' => 'form-horizontal',
				'method' => 'post',
				'id' => 'makes_edit',
				'enctype' => 'multipart/form-data'
			));
		?>
            <div class="panel-body">

                <div class="form-group">
                    <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('makes_name');?></label>
                    <div class="col-sm-6">
                        <input type="text" value="<?php echo $row['name'];?>" 
                        	name="name" id="demo-hor-1" class="form-control required">
                    </div>
                </div>

                
            </div>
        </form>
    </div>

<?php
	}
?>

<script src="<?php echo base_url(); ?>template/back/js/custom/amenity_form.js"></script>


