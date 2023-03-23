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
                        <option value="808">Property</option>
                        <option value="807">Cars</option>
                        <option value="917">Events</option>
                        <option value="856">Hotels</option>
                        <option value="78">Jobs</option>
                        <option value="321">Restaurants</option>
                        <option value="77">Fashion</option>
                        </select>
                </div>
            </div>

          
        </div>
	</form>
</div>
<script src="<?php echo base_url(); ?>template/back/js/custom/amenity_form.js"></script>

