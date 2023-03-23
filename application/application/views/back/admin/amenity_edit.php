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
                        <option>Select Category</option>
                        <option value="808"
                        <?= isset($row['catid']) && $row['catid'] == '808'?'selected':'' ?>>Property</option>
                        <option value="807" <?= isset($row['catid']) && $row['catid'] == '807'?'selected':'' ?>>Cars</option>
                        <option value="917" <?= isset($row['catid']) && $row['catid'] == '917'?'selected':'' ?>>Events</option>
                        <option value="856" <?= isset($row['catid']) && $row['catid'] == '856'?'selected':'' ?>>Hotels</option>
                        <option value="78" <?= isset($row['catid']) && $row['catid'] == '78'?'selected':'' ?>>Jobs</option>
                        <option value="321" <?= isset($row['catid']) && $row['catid'] == '321'?'selected':'' ?>>Restaurants</option>
                        <option value="77" <?= isset($row['catid']) && $row['catid'] == '77'?'selected':'' ?>>Fashion</option>
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


