<div id="info_section">
                            
                        <div class="form-group btm_border">
                                    <label class="control-label" for="demo-hor-1"><?php echo translate('info_heading');?></label>
                      
                                        <input type="text" name="info_head" id="demo-hor-1" value="<?php echo $row['info_head']; ?>" placeholder="<?php echo translate('main_heading');?>" class="form-control ">
                             
                                </div>
                                 <div class="form-group btm_border">
                                <label class="control-label" for="demo-hor-13"><?php echo translate('description'); ?></label>
                    
                                    <textarea rows="9" name="info_desc"  class="form-control" data-height="200" data-name="info_desc"><?php echo $row['info_desc']; ?></textarea>
                             
                                </div>
                                                 <div class="col-md-12">
    <div class="about_feature_bulet">
        <?php
        if($row['about_feature'])
                                        {
                                            $feature  = json_decode($row['about_feature'],true);
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
                                                            
                                                            <input type="text" class="form-control required"  name="about_feature[<?= $key ?>][fhead]" value="<?php
                                                            echo ($value['fhead']?$value['fhead']:'');
                                                            ?>" placeholder=" ">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Detail</label>
                                                            
                                                            <textarea type="text" class="form-control required" rows="5"  name="about_feature[<?= $key ?>][fdet]" ><?php
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
    
    <button target=".about_feature_bulet" class=" ad_more_btn btn btn-primary" content='
    <div class="h-100 row border">
                        <button type="button" class="pull-right mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger remove-parent" parent=".row">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                        <div class="col-md-12">
                        <div class="form-group">
                            <label>Heading</label>
                            <input type="text" class="form-control required" value="" name="about_feature[index][fhead]" placeholder=" ">
                        </div>
                    </div>
                        <div class="col-md-12">
                        <div class="form-group">
                            <label>Detail</label>
                            <textarea class="form-control required" value="" name="about_feature[index][fdet]" rows="5"></textarea>
                        </div>
                    </div>
    </div>
    ' index="<?= count($feature)-1; ?>">Add Bullet Point</button>
</div>
<div class="col-md-12">
    <div class="about_buttons_bulet">
        <?php
        if($row['about_buttons'])
                                        {
                                            $feature  = json_decode($row['about_buttons'],true);
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
                                                            
                                                            <input type="text" class="form-control required"  name="about_buttons[<?= $key ?>][txt]" value="<?php
                                                            echo ($value['txt']?$value['txt']:'');
                                                            ?>" placeholder=" ">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Url</label>
                                                            
                                                            <input type="text" class="form-control required"  name="about_buttons[<?= $key ?>][url]" value="<?php
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
    
    <button target=".about_buttons_bulet" class=" ad_more_btn btn btn-primary" content='
    <div class="h-100 row border">
                        <button type="button" class="pull-right mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger remove-parent" parent=".row">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                        <div class="col-md-12">
                        <div class="form-group">
                            <label>Text</label>
                            <input type="text" class="form-control required" value="" name="about_buttons[index][txt]" placeholder=" ">
                        </div>
                    </div>
                        <div class="col-md-12">
                        <div class="form-group">
                            <label>Url</label>
                            <input type="text" class="form-control required" value="" name="about_buttons[index][url]" placeholder=" ">
                        </div>
                    </div>
    </div>
    ' index="<?= count($feature)-1; ?>">Add Buttons</button>
</div>
                               
                                <div class="form-group btm_border">
                                     <div class="col-sm-5" style="padding-left:0!important; padding-right:0!important;">
                                    <label class="control-label" for="demo-hor-1"><?php echo translate('Button_text');?></label><br>
                               
                                        <input type="text" class="form-control" value="<?= $row['info_button'] ?>" name="info_button" placeholder="Heading" />
                                </div>
                                <div class="col-sm-1"></div>
                                  <div class="col-sm-5" style="padding-left:0!important; padding-right:0!important;">
                                 <label class="control-label" for="demo-hor-1"><?php echo translate('Button_URL');?></label><br>
                               
                                        <input type="text" class="form-control" value="<?= $row['button_url'] ?>" name="button_url" style="float:left;" placeholder="Url" />     
                                    </div>
                                    </div>
                          
                        </div>