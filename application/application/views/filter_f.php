<?php
$cls = '';
$view_cls = 'col-md-12';
if($view_type)
{
    $view_cls = 'col-md-6';
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
    /*<div class="<?= $view_cls ?> custom-padding-left">
                        <div class="custom-select-box">
                          <select id="<?= $name ?>_filter" type="<?= $type ?>" col="<?= $tbl_col ?>" name="ad_field_names[]" 
                            <?php
                            if($is_filter)
                            {
                                ?>
                                onchange="update_filter('<?= $name ?>','<?= $tbl_col ?>')"
                                <?php
                            }
                            ?>
                            class="form-control <?= $cls ?> js-example-basic-single" placeholder="<?= $placeholder ?>"  >
                                <option value="0"><?= $placeholder; ?></option>
                                <?php
                                foreach($options as $k => $v)
                                {
                                    ?>
                                    <option value="<?= $v ?>" <?= (isset($_GET[$tbl_col]) && $_GET[$tbl_col] == $v)?'selected':''; ?>><?= $v ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                      </div>*/
    ?>
    
    
    
                    
<div class="form-group <?= $view_cls ?> p-1">   
                            <div class="select_tops">
                            <div class="custom-select-box"  id="<?= $name ?>_outer" >  
                            <!--  styled-select -->
                            <select id="<?= $name ?>_filter" type="<?= $type ?>" col="<?= $tbl_col ?>" class="form-select form-control" name="ad_field_names[]" 
                            <?php
                            if($is_filter)
                            {
                                ?>
                                onchange="update_filter('<?= $name ?>','<?= $tbl_col ?>')"
                                <?php
                            }
                            ?>
                            class="form-control <?= $cls ?> js-example-basic-single" placeholder="<?= $placeholder ?>"  >
                                <option value="0"><?= $placeholder; ?></option>
                                <?php
                                foreach($options as $k => $v)
                                {
                                    ?>
                                    <option value="<?= $v ?>" <?= (isset($_GET[$tbl_col]) && $_GET[$tbl_col] == $v)?'selected':''; ?>><?= $v ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            </div>   
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
    
<div class="form-group <?= $view_cls ?>">  
                            <div class=""  id="<?= $name ?>_outer" >  
                            <select id="<?= $name ?>_filter" type="<?= $type ?>" col="<?= $tbl_col ?>" name="ad_field_names[]" 
                            <?php
                            if($is_filter)
                            {
                                ?>
                                onchange="update_filter('<?= $name ?>','<?= $tbl_col ?>')"
                                <?php
                            }
                            ?>
                            class="form-control <?= $cls ?> js-example-basic-single" placeholder="<?= $placeholder ?>"  >
                                <option value="0">Select Make</option>
                                <?php
                                foreach($all as $k => $v)
                                {
                                    $vl = $v['name'];
                                    ?>
                                    <option value="<?= $vl ?>" <?= (isset($_GET[$tbl_col]) && $_GET[$tbl_col] == $vl)?'selected':''; ?>><?= $vl ?></option>
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
elseif($type == 'text')
{
    ?>
<div class="form-group <?= $view_cls ?>">   
                            <div>    
                            <input type="text" id="<?= $name ?>_filter" col="<?= $tbl_col ?>" rows="9" 
                            <?php
                            if($is_filter)
                            {
                                ?>
                                onkeyup="update_filter('<?= $name ?>','<?= $tbl_col ?>')"
                                <?php
                            }
                            ?>
                             class="form-control <?= $cls ?>"placeholder="<?= $placeholder ?>" value="<?= isset($_GET[$tbl_col])?$_GET[$tbl_col]:'' ?>" data-height="100" name="ad_field_values[]">    </div>   
                            <div class="col-sm-2">  
                            </div>
                            </div>
                            <?php
}
else
{
    ?>
<div class="form-group <?= $name ?>">    
                            <div>    
                            <input type="<?= $type ?>" id="<?= $name ?>_filter" col="<?= $tbl_col ?>" rows="9" 
                            <?php
                            if($is_filter)
                            {
                                ?>
                                onchange="update_filter('<?= $name ?>','<?= $tbl_col ?>')"
                                <?php
                            }
                            ?>
                             class="form-control <?= $cls ?>"placeholder="<?= $placeholder ?>" value="<?= isset($_GET[$tbl_col])?$_GET[$tbl_col]:'' ?>" data-height="100" name="ad_field_values[]">    </div>   
                            <div class="col-sm-2">  
                            </div>
                            </div>
                            <?php
}


?>