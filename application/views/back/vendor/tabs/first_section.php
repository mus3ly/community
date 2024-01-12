
                            <div class="form-group btm_border">
                                    <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('Business Descriptive Title');?></label>
                                    <div class="col-sm-6">
                                        <input type="text" name="main_heading" id="demo-hor-1" value="<?php echo $row['main_heading']; ?>" placeholder="<?php echo translate('main_heading');?>" class="form-control ">
                                    </div>
                                </div>
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
    <div class="feature_bulet">
        <?php
        if($row['feature'])
                                        {
                                            $feature  = json_decode($row['feature'],true);
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
                                                            <label>Detail</label>
                                                            
                                                            <input type="text" class="form-control required"  name="feature[]" value="<?php
                                                            echo $value;
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
    
    <button target=".feature_bulet" class=" ad_more_btn btn btn-primary" content='
    <div class="h-100 row border">
                        <button type="button" class="pull-right mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger remove-parent" parent=".row">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                        <div class="col-md-12">
                        <div class="form-group">
                            <label>Detail</label>
                            <input type="text" class="form-control required" value="" name="feature[]" placeholder=" ">
                        </div>
                    </div>
    </div>
    '>Add item</button>
</div>