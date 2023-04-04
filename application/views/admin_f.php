<?php
$cls = '';
if($is_required)
{
    $cls = 'required';
}
if($options)
{
    $options = json_decode($options);
} 
?>
<div class="form-group"> 
                          <div class="col-sm-4">    
                            <input type="text" name="ad_field_names[]" class="form-control " readonly="true" value=" <?php echo translate($label);?>" placeholder="Field Name">    
                            </div>   
                            <div class="col-sm-5">    
                            <input type="text" rows="9" class="form-control <?= $cls ?>"placeholder="<?= $placeholder ?>" data-height="100" name="ad_field_values[]">    </div>   
                            <div class="col-sm-2">  
                            </div>
                            </div>