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
if($type == 'select')
{
    $tbl = 'makes';
    $all = $this->db->where('status',1)->get($tbl)->result_array();
    
    ?>
                            <select id="<?= $name ?>" type="<?= $type ?>" name="ad_field_values[]" 
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
                                    <option value="<?= $v ?>" <?= ($val == $v)?"selected":"" ?>><?= $v ?></option>
                                    <?php
                                }
                                ?>
                            </select>
    <?php
}
elseif($type == 'weblink')
{
    if($val)
    $exp = explode('-',$val);


    ?>
<div class="form-group">   
                                <div class="row">
                                    <div class ="col-sm-6" style="padding:0px">
                                        <input type="text" class="form-control" onkeyup="create_link('<?= $name ?>')" id="<?= $name ?>_text" placeholder="Text" value="<?= (isset($exp[0])?$exp[0]:'') ?>" name="">
                                    </div>
                                    <div class ="col-sm-6"  style="padding:0px">
                                        <input type="text" value="<?= (isset($exp[1])?$exp[1]:'') ?>" class="form-control" onkeyup="create_link('<?= $name ?>')" name="" placeholder="Link" id="<?= $name ?>_link">
                                    </div>
                                </div>

                            <input type="hidden" id="<?= $name ?>" value="<?= $val ?>" col="<?= $tbl_col ?>" rows="9" 
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
                             class="form-control <?= $cls ?>"placeholder="<?= $placeholder ?>" data-height="100" name="ad_field_values[]"> 
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
                            <select id="<?= $name ?>" type="<?= $type ?>"name="ad_field_values[]" 
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
                                    <option value="<?= $v['name'] ?>" <?= ($val == $v['name'])?"selected":"" ?> ><?= $v['name'] ?></option>
                                    <?php
                                }
                                ?>
                                
                                <option value="other">Other</option>
                            </select>
    <?php
}
elseif($type == 'text')
{
    ?> 
                            <input type="text" id="<?= $name ?>"  value="<?= $val ?>" name="ad_field_values[]" rows="9" 
                            <?php
                            if($is_filter)
                            {
                                ?>
                                onkeyup="update_filter('<?= $name ?>','<?= $tbl_col ?>')"
                                <?php
                            }
                            ?>
                             class="form-control <?= $cls ?>"placeholder="<?= $placeholder ?>" data-height="100" name="ad_field_values[]">    
                            <?php
}
else
{
    ?>    
                            <input type="<?= $type ?>" value="<?= $val ?>" id="<?= $name ?>" name="ad_field_values[]" rows="9" 
                            <?php
                            if($is_filter)
                            {
                                ?>
                                onkeyup="update_filter('<?= $name ?>','<?= $tbl_col ?>')"
                                onchange="update_filter('<?= $name ?>','<?= $tbl_col ?>')"
                                <?php
                            }
                            ?>
                             class="form-control <?= $cls ?>"placeholder="<?= $placeholder ?>" data-height="100" name="ad_field_values[]">   
                            <?php
}


?>