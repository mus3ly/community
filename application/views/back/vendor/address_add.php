<div>
	<?php
        echo form_open(base_url() . 'vendor/address/do_add/', array(
            'class' => 'form-horizontal',
            'method' => 'post',
            'id' => 'address_add', 
            'enctype' => 'multipart/form-data'
        ));
    ?>
        <div class="panel-body">

            <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('title');?></label>
                <div class="col-sm-6">
                    <input type="text" name="title" id="demo-hor-1" 
                    	placeholder="<?php echo translate('title'); ?>" class="form-control required">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('name');?></label>
                <div class="col-sm-6">
                    <input type="text" name="name" id="demo-hor-1" 
                    	placeholder="<?php echo translate('name'); ?>" class="form-control required">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('company');?></label>
                <div class="col-sm-6">
                    <input type="text" name="company" id="demo-hor-1" 
                        placeholder="<?php echo translate('company'); ?>" class="form-control required">
                        <div>
                    </div>
                </div>
            </div>
               <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('street');?></label>
                <div class="col-sm-6">
                    <input type="text" name="street1" id="demo-hor-1" 
                        placeholder="<?php echo translate('street'); ?>" class="form-control required">
                        <div>
                    </div>
                </div>
            </div>
            
           
        <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-2"><?php echo translate('city');?></label>
                <div class="col-sm-8">
                    <input type="text" name="city"  class="form-control required" placeholder="<?php echo translate('city');  ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-2"><?php echo translate('state');?></label>
                <div class="col-sm-8">
                    <input type="text" name="state"  class="form-control required" placeholder="<?php echo translate('state');  ?>">
                </div>
            </div> 
           
            <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-2"><?php echo translate('zip');?></label>
                <div class="col-sm-8">
                    <input type="text" name="zip"  class="form-control required" placeholder="<?php echo translate('zip');  ?>">
                </div>
            </div>
             <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-2"><?php echo translate('country');?></label>
                <div class="col-sm-8">
                    <input type="text" name="country"  class="form-control required" placeholder="<?php echo translate('country');  ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-2"><?php echo translate('email');?></label>
                <div class="col-sm-8">
                    <input type="text" name="email"  class="form-control required" placeholder="<?php echo translate('email');  ?>">
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

