<?php
	foreach($brand_data as $row){
?>
    <div>
        <?php
			echo form_open(base_url() . 'vendor/brand/update/' . $row['textg_id'], array(
				'class' => 'form-horizontal',
				'method' => 'post',
				'id' => 'brand_edit',
				'enctype' => 'multipart/form-data'
			));
		?>
            <div class="panel-body">

                <div class="form-group">
                    <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('brand_name');?></label>
                    <div class="col-sm-6">
                        <input type="text" value="<?php echo $row['title'];?>" 
                        	name="name" id="demo-hor-1" class="form-control required">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('fa_icon');?></label>
                    <div class="col-sm-6">
                        <input type="text" value="<?php echo $row['icon'];?>" 
                            name="fa_icon" id="demo-hor-1" class="form-control required">
                    </div>
                    <br>
                    <span><a href="https://fontawesome.com/v4/icons/" target="_blank">Click here</a> to find icon code</span>
                </div>
                <div class="form-group">
                    <label class="col-sm-4 control-label" for="demo-hor-2"><?php echo translate('brand_logo');?></label>
                    <div class="col-sm-6">
                        <span class="pull-left btn btn-default btn-file">
                            <?php echo translate('select_brand_logo');?>
                            <input type="file" name="img" id='imgInp' accept="image">
                        </span>
                        <br><br>
                        <span id='wrap' class="pull-left" >
                                  <?php
                                                if($row['img'])
                                                {
                                                    $img = $this->crud_model->size_img($row['img'],100,100);
                                                    ?>
                                                    <img class="img-responsive" width="100" src="<?= $img;?>" data-id="_paris/uploads/product" alt="Feature Image"><?php
                                                }?>
                        </span>
                    </div>
                </div>
                 <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-2"><?php echo translate('section details');?></label>
                <div class="col-sm-8">
                    <textarea rows="9" name="description"  class="summernotes" data-height="200" data-name="description"><?php echo $row['detail']; ?></textarea>
                </div>
            </div>
                     <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-2"><?php echo translate('sort');?></label>
                <div class="col-sm-8">
                    <input type="text" name="sort" value="<?= $row['sort']; ?>" class="form-control required" placeholder="<?php echo translate('sort');  ?>">
                </div>
            </div>
            </div>
        </form>
    </div>

<?php
	}
?>

<script src="<?php echo base_url(); ?>template/back/js/custom/brand_form.js"></script>


