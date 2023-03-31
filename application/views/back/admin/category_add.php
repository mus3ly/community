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
                <label class="col-sm-4 control-label"><?php echo translate('category');?></label>
                <div class="col-sm-6">
                    <?php echo $this->crud_model->select_html('category','pcat','category_name','add','demo-chosen-select form-control ','','digital',NULL); ?>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('fa_icon');?></label>
                <div class="col-sm-6">
                    <input type="text" name="fa_icon" id="demo-hor-1" 
                        placeholder="<?php echo translate('fontawsome_icon'); ?>" class="form-control">
                        <div>
                        <span><a href="https://fontawesome.com/icons">Click here</a> to find icon code</span>
                    </div>
                </div>
            </div>
            <!--<div class="form-group">-->
            <!--    <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('slug');?></label>-->
            <!--    <div class="col-sm-6">-->
            <!--        <input type="text" name="slug" id="slug" placeholder="<?php echo translate('slug'); ?>" class="form-control">-->
            <!--        <small class="slug_error" style="display:none;">Slug already exist</small>-->
                       
            <!--    </div>-->
            <!--</div>-->
        </div>
	</form>
</div>

<script>
	$(document).ready(function() {
		$("form").submit(function(e){
			event.preventDefault();
		});
	});
	$('#slug').on('keyup', function(){
	    $('.slug_error').css({'display':'none'});
	    $(".enterer").prop('disabled', false);

	    var val = $(this).val();
	    if(val){
	    $.ajax({
        url: '<?= base_url('Admin/cat_slug'); ?>',
        type: "Post",
        async: true,
        data: { val:val },
        success: function (data) {
           if(data == 'error'){
               $(".enterer").prop('disabled', true);
               $('.slug_error').css({'display':'block'});
               $('.slug_error').css({'color':'red'});
           }
        },
        error: function (xhr, exception) {
         
           
        }
    }); 
	    }
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
$(document).ready(function(){
        $('.demo-chosen-select').chosen();
        $('.demo-cs-multiselect').chosen({width:'100%'});
    });
</script>