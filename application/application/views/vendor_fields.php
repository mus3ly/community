<?php
$cls = '';
if($is_required)
{
    if($category ==  807)
    {
        $cls = 'required1';
    }
    elseif($category ==  808)
    {
        $cls = 'required2';
    }
    elseif($category ==  78)
    {
        $cls = 'required4';
    }
    elseif($category ==  917)
    {
        $cls = 'required3';
    }
}
if($options)
{
    $options = json_decode($options);
} 
?>
<div class="form-group btm_border">
                                <label class="col-sm-4 control-label" for="">
                                    <?php echo translate($label);?>
                                </label>
                                <div class="col-sm-6">
                                    <?php 
                                        if($type == 'text'){
                                    ?>
                                    <input type="text" name="fields[<?= $name ?>]" value="<?= get_product_meta($pid,$name) ?>" placeholder="<?php echo translate($placeholder)?>"
                                           class="form-control <?= $cls ?>">
                                           <?php
                                        }elseif($type == 'textarea'){
                                            ?>
                                            <textarea name="fields[<?= $name ?>]" class="form-control <?= $cls ?>" placeholder="<?php echo translate($placeholder)?>"><?= get_product_meta($pid,$name) ?></textarea>
                                            <?php
                                        }elseif($type == 'select'){
                                            ?>
                                            <select name="fields[<?= $name ?>]"
                                           class="form-control  <?= $cls ?>">
                                        <option value="0">Select <?php echo translate($label);?></option>
                                        <?php
                                        foreach($options as $k => $v){
                                        ?>
                                        <option value="<?= $v;?>" <?= (get_product_meta($pid,$name) == $v)?"selected":""; ?>><?= $v;?></option>
                                        <?php
                                        }
                                        ?>
                                        
                                    </select>
                                        <p><?php echo translate($placeholder)?></p>
                                            <?php
                                        }
                                           ?>
                                </div>
                                <div class="col-sm-2"></div>
                            </div>