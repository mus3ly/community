
                                 <div class="form-group btm_border" style="padding-top:30px;">
                                <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('check_this_to_show_on_front');?></label>
                                <div class="col-sm-6">
                                  <input type="checkbox" id="demoCheckbox" name="checks[]" value="service_description" class="checkbox_class" <?= (in_array('service_description',$checks))?"checked":""; ?>/>
                                </div>
                            </div>
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <?php
                                    $comp_cover =  (isset($row->firstImg
)&& $row->firstImg
)?$row->firstImg
:0;
                                    $this->crud_model->img_field(2,$comp_cover);
                                    ?>
                                </div>
                            </div>

                                <div class="form-group btm_border">
                                    <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('Business Descriptive Title');?></label>
                                    <div class="col-sm-6">
                                        <input type="text" name="main_heading" id="demo-hor-1" value="<?php echo $row['main_heading']; ?>" placeholder="<?php echo translate('main_heading');?>" class="form-control ">
                                    </div>
                                </div>
                                