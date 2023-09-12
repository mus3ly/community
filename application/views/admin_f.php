<?php
$cls = '';
if($dvalue == 'cdate')
{
    $dvalue= formate_date(date('Y-m-d'));
}
if($is_required)
{
    $cls = 'required';
}
if($options)
{
    $options = json_decode($options);
}
if($type == 'select')
{
    $tbl = 'makes';
    $all = $this->db->where('status',1)->get($tbl)->result_array();
    
    ?>
    
<div class="form-group"> 
                          <div class="col-sm-4">    
                            <input type="text" name="ad_field_names[]" class="form-control " readonly="true" value=" <?php echo translate($label);?>" placeholder="Field Name">    
                            </div>   
                            <div class="col-sm-5"  id="<?= $name ?>_outer" >  
                            <select id="<?= $name ?>" type="<?= $type ?>" col="<?= $tbl_col ?>" name="ad_field_values[]" 
                            <?php
                            if($is_filter)
                            {
                                ?>
                                onchange="update_filter('<?= $name ?>','<?= $tbl_col ?>')"
                                <?php
                            }
                            ?>
                            class="form-control <?= $cls ?> js-example-basic-single1" placeholder="<?= $placeholder ?>"  >
                                <option value="0">Select <?php echo translate($label);?></option>
                                <?php
                                foreach($options as $k => $v)
                                {
                                    ?>
                                    <option value="<?= $v ?>"><?= $v ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            </div>   
                            <div class="col-sm-2">  
                            </div>
                            </div>
    <?php
}
elseif($type == 'model')
{
    $tbl = 'makes';
    $all = $this->db->where('status',1)->get($tbl)->result_array();
    
    ?>
    
<div class="form-group"> 
                          <div class="col-sm-4">    
                            <input type="text" name="ad_field_names[]" class="form-control " readonly="true" value=" <?php echo translate($label);?>" placeholder="Field Name">    
                            </div>   
                            <div class="col-sm-5"  id="<?= $name ?>_outer" >  
                            <select id="<?= $name ?>" type="<?= $type ?>" col="<?= $tbl_col ?>" name="ad_field_names[]" 
                            <?php
                            if($is_filter)
                            {
                                ?>
                                onchange="update_filter('<?= $name ?>','<?= $tbl_col ?>')"
                                <?php
                            }
                            ?>
                            class="form-control <?= $cls ?> js-example-basic-single1" placeholder="<?= $placeholder ?>" >
                                <option value="0">Select <?php echo translate($label);?></option>
                                <?php
                                foreach($all as $k => $v)
                                {
                                    ?>
                                    <option value="<?= $v['name'] ?>"><?= $v['name'] ?></option>
                                    <?php
                                }
                                ?>
                                
                                <option value="other">Other</option>
                            </select>
                            </div>   
                            <div class="col-sm-2">  
                            </div>
                            </div>
    <?php
}
elseif($type == 'readonly')
{
    ?>
<div class="form-group"> 
                          <div class="col-sm-4">    
                            <input type="text"  name="ad_field_names[]" class="form-control " readonly="true" value=" <?php echo translate($label);?>" placeholder="Field Name">    
                            </div>   
                            <div class="col-sm-5"> 
                            <input type="text" id="<?= $name ?>" col="<?= $tbl_col ?>" rows="9" 
                            <?php
                            if($is_filter)
                            {
                                ?>
                                onkeyup="update_filter('<?= $name ?>','<?= $tbl_col ?>')"
                                <?php
                            }
                            ?>
                             class="form-control <?= $cls ?>" readonly="true" placeholder="<?= $placeholder ?>" value="<?php echo ($dvalue)?$dvalue:'';?>" data-height="100" name="ad_field_values[]">    </div>   
                            <div class="col-sm-2">  
                            </div>
                            </div>
                            <?php
}
elseif($type == 'text')
{
    ?>
<div class="form-group"> 
                          <div class="col-sm-4">    
                            <input type="text" name="ad_field_names[]" class="form-control " readonly="true" value=" <?php echo ($dvalue)?$dvalue:translate($label);?>" placeholder="Field Name">    
                            </div>   
                            <div class="col-sm-5">    
                            <input type="text" id="<?= $name ?>" col="<?= $tbl_col ?>" rows="9" 
                            <?php
                            if($is_filter && $capital_val)
                            {
                                ?>
                                onkeyup="update_filter('<?= $name ?>','<?= $tbl_col ?>');
                                <?php
                                if($capital_val)
                                {
                                    ?>
                                    capital_val('<?= $name ?>');
                                    <?php
                                }
                                ?>
                                "
                                <?php
                            }
                            elseif($is_filter && !$capital_val)
                            {
                                ?>
                                onkeyup="update_filter('<?= $name ?>','<?= $tbl_col ?>')"
                                <?php
                            }
                            elseif(!$is_filter && $capital_val)
                            {
                                ?>
                                onkeyup="capital_val('<?= $name ?>');"
                                <?php
                            }
                            
                            ?>
                             class="form-control <?= $cls ?>"placeholder="<?= $placeholder ?>" data-height="100" name="ad_field_values[]">    </div>   
                            <div class="col-sm-2">  
                            </div>
                            </div>
                            <?php
}
else
{
    ?>
<div class="form-group"> 
                          <div class="col-sm-4">    
                            <input type="text" name="ad_field_names[]" class="form-control " readonly="true" value=" <?php echo translate($label);?>" placeholder="Field Name">    
                            </div>   
                            <div class="col-sm-5">    
                            <input type="<?= $type ?>" name="ad_field_values[]" id="<?= $name ?>" col="<?= $tbl_col ?>"
                            <?php
                            if($is_filter)
                            {
                                ?>
                                onkeyup="update_filter('<?= $name ?>','<?= $tbl_col ?>')"
                                onchange="update_filter('<?= $name ?>','<?= $tbl_col ?>')"
                                <?php
                            }
                            ?>
                             class="form-control <?= $cls ?>"placeholder="<?= $placeholder ?>" data-height="100" name="ad_field_values[]">    </div>   
                            <div class="col-sm-2">  
                            </div>
                            </div>
                            <?php
}


?>