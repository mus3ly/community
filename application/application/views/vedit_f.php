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