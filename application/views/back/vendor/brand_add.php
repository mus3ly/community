<div>
	<?php
        echo form_open(base_url() . 'vendor/brand/do_add/', array(
            'class' => 'form-horizontal',
            'method' => 'post',
            'id' => 'brand_add', 
            'enctype' => 'multipart/form-data'
        ));
    ?>
        <div class="panel-body">

            <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('title');?></label>
                <div class="col-sm-6">
                    <input type="text" name="name" id="demo-hor-1" 
                    	placeholder="<?php echo translate('title'); ?>" class="form-control required">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('fa_icon');?></label>
                <div class="col-sm-6">
                    <input type="text" name="fa_icon" id="demo-hor-1" 
                        placeholder="<?php echo translate('fontawsome_icon'); ?>" class="form-control required">
                        <div>
                        <span><a href="https://fontawesome.com/v4/icons/" target="_blank">Click here</a> to find icon code</span>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-2"><?php echo translate('select_image');?></label>
                <div class="col-sm-6">
                    <span class="pull-left btn btn-default btn-file">
                        <?php echo translate('select_image');?>
                        <input type="file" name="img" id='imgInp' accept="image">
                    </span>
                    <br><br>
                    <span id='wrap' class="pull-left" >
                        <img src="<?php echo base_url(); ?>uploads/brand_image/default.jpg" 
                        	width="48.5%" id='blah' > 
                    </span>
                    <br><br>
                    </div>
                    <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-2"><?php echo translate('section details');?></label>
                <div class="col-sm-8">
                    <textarea rows="9" name="description"  class="summernotes" data-height="200" data-name="description"><?php echo $row['description']; ?></textarea>
                </div>
            </div>
        </div>
        <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-2"><?php echo translate('sort');?></label>
                <div class="col-sm-8">
                    <input type="text" name="sort"  class="form-control required" placeholder="<?php echo translate('sort');  ?>">
                </div>
            </div>
	</form>
</div>
<script src="<?php echo base_url(); ?>template/back/js/custom/brand_form.js"></script>
<script>
    $('.summernotes').each(function() {
            var now = $(this);
            var h = now.data('height');
            var n = now.data('name');
            if(now.closest('div').find('.val').length == 0){
                now.closest('div').append('<input type="hidden" class="val" name="'+n+'">');
            }
            now.summernote({
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['view', ['codeview', 'help']],
                ],
                height: h,
                onChange: function() {
                    now.closest('div').find('.val').val(now.code());
                }
            });
            now.closest('div').find('.val').val(now.code());
        });
</script>

