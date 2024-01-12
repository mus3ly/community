<div class="col-md-12">
    <div class="buttons_bulet">
        <?php
        if($row['buttons'])
                                        {
                                            $feature  = json_decode($row['buttons'],true);
                                            // var_dump($feature);
                                            foreach ($feature as $key => $value) {
                                                if($value)
                                                {
                                                    ?>
                                                    <div class="h-100 row border">
                        <button type="button" class="pull-right mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger remove-parent" parent=".row">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Text</label>
                                                            
                                                            <input type="text" class="form-control required"  name="buttons[<?= $key ?>][txt]" value="<?php
                                                            echo ($value['txt']?$value['txt']:'');
                                                            ?>" placeholder=" ">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Url</label>
                                                            
                                                            <input type="text" class="form-control required"  name="buttons[<?= $key ?>][url]" value="<?php
                                                            echo (isset($value['url'])?$value['url']:'');
                                                            ?>" placeholder=" ">
                                                        </div>
                                                    </div>
                                                    </div>
                                                    
                                              
                                                    <?php
                                                }
                                            }
                                        }
        ?>
    </div>
    
    <button target=".buttons_bulet" class=" ad_more_btn btn btn-primary" content='
    <div class="h-100 row border">
                        <button type="button" class="pull-right mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger remove-parent" parent=".row">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                        <div class="col-md-12">
                        <div class="form-group">
                            <label>Text</label>
                            <input type="text" class="form-control required" value="" name="buttons[index][txt]" placeholder=" ">
                        </div>
                    </div>
                        <div class="col-md-12">
                        <div class="form-group">
                            <label>Url</label>
                            <input type="text" class="form-control required" value="" name="buttons[index][url]" placeholder=" ">
                        </div>
                    </div>
    </div>
    ' index="-1">Add item</button>
</div>