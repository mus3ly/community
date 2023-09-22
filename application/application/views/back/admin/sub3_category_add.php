<div>
    <?php
		echo form_open(base_url() . 'admin/sub3_category/do_add/', array(
			'class' => 'form-horizontal',
			'method' => 'post',
			'id' => 'sub_category_add',
			'enctype' => 'multipart/form-data'
		));
	?>
        <div class="panel-body">
            <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-1">
                	<?php echo translate('category_name');?>
                    	</label>
                <div class="col-sm-6">
                    <input type="text" name="category_name" placeholder="<?php echo translate('sub-category_name'); ?>" class="form-control required">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label"><?php echo translate('category');?></label>
                <div class="col-sm-6">
                    <?php echo $this->crud_model->select_html('sub_category','category','sub_category_name','edit','demo-chosen-select required',$scat,'digital',NULL); ?>
                </div>
            </div>
        </div>
	</form>
</div>



<script>
	$(document).ready(function() {
		$('.demo-chosen-select').chosen();
		$('.demo-cs-multiselect').chosen({width:'100%'});

        var affiliation_check = document.querySelector('.affiliation-check');
        var affiliation_switch = new Switchery(affiliation_check);
	});
	
	$(document).ready(function() {
		$("form").submit(function(e){
			event.preventDefault();
		});
	});
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
	
			reader.onload = function(e) {
				$('#wrap').hide('fast');
				$('#blah').attr('src', e.target.result);
				$('#wrap').show('fast');
			}
			reader.readAsDataURL(input.files[0]);
		}
	}
	
	$("#imgInp").change(function() {
		readURL(this);
	});
</script>


