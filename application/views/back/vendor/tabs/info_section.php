<div id="info_section" class="tab-pane fade ">
                             <div class="form-group btm_border" style="padding-top:30px;">
                                <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('check_this_to_show_on_front');?></label>
                                <div class="col-sm-6">
                                  <input type="checkbox" id="demoCheckbox" name="checks[]" value="more_info" class="checkbox_class" <?= (in_array('more_info',$checks))?"checked":""; ?>/>
                                </div>
                            </div>
                        <div class="form-group btm_border">
                                    <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('info_heading');?></label>
                                    <div class="col-sm-6">
                                        <input type="text" name="info_head" id="demo-hor-1" value="<?php echo $row['info_head']; ?>" placeholder="<?php echo translate('main_heading');?>" class="form-control ">
                                    </div>
                                </div>
                                 <div class="form-group btm_border">
                                <label class="col-sm-4 control-label" for="demo-hor-13"><?php echo translate('description'); ?></label>
                                <div class="col-sm-6">
                                    <textarea rows="9" name="info_desc"  class="summernotes" data-height="200" data-name="info_desc"><?php echo $row['info_desc']; ?></textarea>
                                </div>
                                </div>
                               
                                <div class="form-group btm_border">
                                    <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('Button_text');?></label>
                                <div class="col-sm-6">
                                        <input type="text" class="form-control" value="<?= $row['info_button'] ?>" name="button_txt" style="width:45%;float:left;" placeholder="Heading" />
                                </div>
                                 <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('Button_URL');?></label>
                                 <div class="col-sm-6">
                                        <input type="text" class="form-control" value="<?= $row['button_url'] ?>" name="button_url" style="width:45%;float:left;" placeholder="Url" />     
                                    </div>
                                    </div>
                          
                        </div>