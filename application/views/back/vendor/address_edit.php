<?php
	foreach($brand_data as $row){
?>
    <div>
        <?php
			echo form_open(base_url() . 'vendor/address/update/' . $row['address_id'], array(
				'class' => 'form-horizontal',
				'method' => 'post',
				'id' => 'address_edit',
				'enctype' => 'multipart/form-data'
			));
		?>
		 <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('title');?></label>
                <div class="col-sm-6">
                    <input type="text" name="title" id="demo-hor-1" value="<?= $row['title']; ?>"
                    	placeholder="<?php echo translate('title'); ?>" class="form-control required">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('name');?></label>
                <div class="col-sm-6">
                    <input type="text" name="name" id="demo-hor-1" value="<?= $row['name']; ?>"
                    	placeholder="<?php echo translate('name'); ?>" class="form-control required">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('company');?></label>
                <div class="col-sm-6">
                    <input type="text" name="company" id="demo-hor-1" value="<?= $row['company']; ?>"
                        placeholder="<?php echo translate('company'); ?>" class="form-control required">
                        <div>
                    </div>
                </div>
            </div>
               <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('street');?></label>
                <div class="col-sm-6">
                    <input type="text" name="street1" id="demo-hor-1"  value="<?= $row['street1']; ?>"
                        placeholder="<?php echo translate('street'); ?>" class="form-control required">
                        <div>
                    </div>
                </div>
            </div>
            
           
        <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-2"><?php echo translate('city');?></label>
                <div class="col-sm-8">
                    <input type="text" name="city"  class="form-control required"  value="<?= $row['city']; ?>" placeholder="<?php echo translate('city');  ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-2"><?php echo translate('state');?></label>
                <div class="col-sm-8">
                    <input type="text" name="state"  class="form-control required"  value="<?= $row['state']; ?>" placeholder="<?php echo translate('state');  ?>">
                </div>
            </div> 
           
            <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-2"><?php echo translate('zip');?></label>
                <div class="col-sm-8">
                    <input type="text" name="zip"  class="form-control required"  value="<?= $row['zip']; ?>" placeholder="<?php echo translate('zip');  ?>">
                </div>
            </div>
             <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-2"><?php echo translate('country');?></label>
                <div class="col-sm-8">
                    <input type="text" name="country"  class="form-control required"  value="<?= $row['country']; ?>" placeholder="<?php echo translate('country');  ?>">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-2"><?php echo translate('email');?></label>
                <div class="col-sm-8">
                    <input type="text" name="email"  class="form-control required"  value="<?= $row['email']; ?>" placeholder="<?php echo translate('email');  ?>">
                </div>
            </div>
        </form>
    </div>

<?php
	}
?>

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


