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
                            <input type="text" name="ad_field_names[]" class="form-control " readonly="true" value=" <?php echo $label;?>" placeholder="Field Name">    
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
                                    <option value="<?= $v ?>" <?= (isset($val) && $val == $v)?'selected':''; ?> ><?= $v ?></option>
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
                            <input type="text" name="ad_field_names[]" class="form-control " readonly="true" value=" <?php echo $label;?>" placeholder="Field Name">    
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
                                <option value="0">Select <?php echo $label;?></option>
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
                            <input type="text"  name="ad_field_names[]" class="form-control " readonly="true" value=" <?php echo $label;?>" placeholder="Field Name">    
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
                             class="form-control <?= $cls ?>" readonly="true" placeholder="<?= $placeholder ?>" value="<?php echo ($val)?$val:$dvalue;?>" data-height="100" name="ad_field_values[]">    </div>   
                            <div class="col-sm-2">  
                            </div>
                            </div>
                            <?php
}
elseif($type == 'textarea')
{
    ?>
<div class="form-group"> 
                          <div class="col-sm-4">    
                            <input type="text" name="ad_field_names[]" class="form-control " readonly="true" value=" <?php echo $label;?>" placeholder="Field Name">    
                            </div>   
                            <div class="col-sm-5">   
                            <textarea id="<?= $name ?>" col="<?= $tbl_col ?>" rows="9" 
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
                             class="form-control <?= $cls ?>"placeholder="<?= $placeholder ?>" value="<?= (isset($val)?$val:'') ?>" data-height="100" name="ad_field_values[]"><?= (isset($val)?$val:'') ?></textarea></div>   
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
                            <input type="text" name="ad_field_names[]" class="form-control " readonly="true" value=" <?php echo ($dvalue)?$dvalue:$label;?>" placeholder="Field Name">    
                            </div>   
                            <div class="col-sm-5">    
                            <input type="text" id="<?= $name ?>" value="<?= $val ?>" col="<?= $tbl_col ?>" rows="9" 
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
                             class="form-control <?= $cls ?>"placeholder="<?= $placeholder ?>" value="<?= (isset($val)?$val:'') ?>" data-height="100" name="ad_field_values[]">    </div>   
                            <div class="col-sm-2">  
                            </div>
                            </div>
                            <?php
}
elseif($type == 'weblink')
{
    $text = '';
    $link = '';
    if(isset($val))
    {
        $ex = explode('-',$val);
        if(isset($ex[0]))
        {
            $text = $ex[0];
        }
        if(isset($ex[1]))
        {
            $link = $ex[1];
        }
    }
    ?>
<div class="form-group"> 
                          <div class="col-sm-4">    
                            <input type="text" name="ad_field_names[]" class="form-control " readonly="true" value=" <?php echo ($dvalue)?$dvalue:$label;?>" placeholder="Field Name">    
                            </div>   
                            <div class="col-sm-5">    
                                <div class="row">
                                    <div class ="col-sm-6" style="padding:0px">
                                        <input type="text" class="form-control" onkeyup="create_link('<?= $name ?>')" id="<?= $name ?>_text" value="<?= $text ?>" placeholder="Text" name="">
                                    </div>
                                    <div class ="col-sm-6"  style="padding:0px">
                                        <input type="text" class="form-control" onkeyup="create_link('<?= $name ?>')" name="" value="<?= $link ?>" placeholder="Link" id="<?= $name ?>_link">
                                    </div>
                                </div>

                            <input type="hidden" id="<?= $name ?>" col="<?= $tbl_col ?>" rows="9" 
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
                            <input type="text" name="ad_field_names[]" class="form-control " readonly="true" value=" <?php echo $label;?>" placeholder="Field Name">    
                            
                            </div>   
                            <div class="col-sm-5">    
                            <input type="<?= $type ?>"  name="ad_field_values[]" id="<?= $name ?>" col="<?= $tbl_col ?>" <?php
                            if($is_filter)
                            {
                                ?>
                                onkeyup="update_filter('<?= $name ?>','<?= $tbl_col ?>')"
                                onchange="update_filter('<?= $name ?>','<?= $tbl_col ?>')"
                                <?php
                            }
                            ?>
                            class="form-control <?= $cls ?>"placeholder="<?= $placeholder ?>" data-height="100" name="ad_field_values[]" value="<?= (isset($val)?$val:'') ?>"></div>   
                            <div class="col-sm-2">  
                            </div>
                            </div>
                            <?php
}


?>