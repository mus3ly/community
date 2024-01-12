<div class="col-md-12">
                                <div class="form-group">
                                    <?php
                                    $comp_cover =  (isset($row['firstImg']
)&& $row['firstImg']
)?$row['firstImg']
:0;
                                    $this->crud_model->img_field(2,$comp_cover);
                                    ?>
                                </div>
                            </div>
   <div class="col-md-12">
                                <div class="form-group btm_border">
                                    <label class="control-label" for="demo-hor-1"><?php echo translate('Business Descriptive Title');?></label>
                                   
                                        <input type="text" name="main_heading" id="demo-hor-1" value="<?php echo $row['main_heading']; ?>" placeholder="<?php echo translate('main_heading');?>" class="form-control ">
                                  
                                </div>
                                </div>
   <div class="col-md-12">
                                <div class="form-group btm_border">
                                    <label class="control-label" for="demo-hor-1"><?php echo translate('Business Descriptive Slogan');?></label>
                                   
                                        <input type="text" name="disc_slogan" id="demo-hor-1" value="<?php echo $row['disc_slogan']; ?>" placeholder="<?php echo translate('slogan');?>" class="form-control ">
                                  
                                </div>
                                </div>
                                    <div class="col-md-12">
<textarea name="description" id="description" class=" tiny">
  <?php echo $row['description']; ?></textarea>
        </div>
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
    ' index="<?= count($feature)-1; ?>">Add Bullet Point</button>
</div>
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
    ' index="<?= count($feature)-1; ?>">Add Buttons</button>
</div>