<div class="col-md-12">
    <div class="feature_bulet">
        <?php
        if($row['feature'])
                                        {
                                            $feature  = json_decode($row['feature'],true);
                                            // var_dump($feature);
                                            foreach ($feature as $key => $value) {
                                                if(true)
                                                {
                                                    ?>
                                                    <div class="h-100 row border">
                        <button type="button" class="pull-right mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger remove-parent" parent=".row">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Heading</label>
                                                            
                                                            <input type="text" class="form-control required"  name="feature[<?= $key ?>][fhead]" value="<?php
                                                            echo ($value['fhead']?$value['fhead']:'');
                                                            ?>" placeholder=" ">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Detail</label>
                                                            
                                                            <textarea type="text" class="form-control required" rows="5"  name="feature[<?= $key ?>][fdet]" ><?php
                                                            echo (isset($value['fdet'])?$value['fdet']:'');
                                                            ?></textarea>
                                                        </div>
                                                    </div>
                                                    </div>
                                                    
                                              
                                                    <?php
                                                }
                                            }
                                        }
        ?>
    </div>
    
    <button target=".feature_bulet" class=" ad_more_btn btn btn-primary" content='
    <div class="h-100 row border">
                        <button type="button" class="pull-right mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger remove-parent" parent=".row">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                        <div class="col-md-12">
                        <div class="form-group">
                            <label>Heading</label>
                            <input type="text" class="form-control required" value="" name="feature[index][fhead]" placeholder=" ">
                        </div>
                    </div>
                        <div class="col-md-12">
                        <div class="form-group">
                            <label>Detail</label>
                            <textarea class="form-control required" value="" name="feature[index][fdet]" rows="5"></textarea>
                        </div>
                    </div>
    </div>
    ' index="-1">Add item</button>
</div>