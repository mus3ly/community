<div>
    <?php
		echo form_open(base_url() . 'admin/category/do_add/', array(
			'class' => 'form-horizontal',
			'method' => 'post',
			'id' => 'category_add',
			'enctype' => 'multipart/form-data'
		));
	?>
        <div class="panel-body">
            <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-1">
                	<?php echo translate('category_name');?>
                </label>
                <div class="col-sm-6">
                    <input type="text" name="category_name" id="demo-hor-1" 
                    	class="form-control required" placeholder="<?php echo translate('category_name');?>" >
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('fa_icon');?></label>
                <div class="col-sm-6">
                    <input type="text" name="fa_icon" id="demo-hor-1" 
                        placeholder="<?php echo translate('fontawsome_icon'); ?>" class="form-control required">
                        <div>
                        <span><a href="https://fontawesome.com/icons">Click here</a> to find icon code</span>
                    </div>
                </div>
            </div>
        </div>
	</form>
</div>

<script>
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
	$("#iconInp").change(function() {
		readURL1(this);
	});
	function readURL1(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#blah1')
                    .attr('src', e.target.result)
                    .width(150)
                    .height(200);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
Li
</script>