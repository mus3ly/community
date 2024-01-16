<div>
    <?php
		echo form_open(base_url() . 'vendor/column3/do_add/'.$pid, array(
			'class' => 'form-horizontal',
			'method' => 'post',
			'id' => 'column3_add',
			'enctype' => 'multipart/form-data'
		));
	?>
        <div class="panel-body">
            <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-1">
                	<?php echo translate('column_name');?>
                </label>
                <div class="col-sm-6">
                    <input type="text" name="column_name" id="demo-hor-1" 
                    	class="form-control required" >
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