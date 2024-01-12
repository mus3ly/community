<div id="xtra_info" class="tab-pane fade ">
                           
  <div class="form-group btm_border" style="padding-top:30px;"> Extra Info
                                <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('check_this_to_show_on_front');?></label>
                            
                            </div>
                        <div class="form-group btm_border">
                                    <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('section_heading');?></label>
                                    <div class="col-sm-6">
                                        <input type="text" name="extra_section_heading" id="demo-hor-1" value="<?php echo $row['extra_section_heading']; ?>" placeholder="<?php echo translate('extra_section_heading');?>" class="form-control">
                                    </div>
                                </div>
                        <div class="form-group btm_border">
                                    <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('number_of_column');?></label>
                                    <div class="col-sm-6">
                                        <select class="form-control exra_chnge"  name="number_of_column">
                                        <?php
                                        for($i = 1;$i<=3;$i++)
                                        {
                                            ?>
                                            <option value="<?= $i; ?>" <?= (isset($row['number_of_column']) && $row['number_of_column'] == $i)?"selected":""; ?> ><?= $i ?><?= ($i== 1)?"column":"columns" ?></option>
                                            <?php
                                        }
                                        ?>    
                                        </select>
                                        
                                </div>
                                </div>
                                <?php
                                $content = json_decode($row['etra_content'],true);
                                // var_dump($content);
                                ?>
                               <div class="form-group btm_border" id="col1_div">
                                <label class="col-sm-4 control-label" for="demo-hor-13"><?php echo translate('colum1_Details'); ?></label>
                                <div class="col-sm-6">
                                    <textarea rows="9" name="info_desc"  class="summernotes" data-height="200" data-name="etra_content[]"><?= (isset($content[0]))?$content[0]:"" ?></textarea>
                                </div>
                                </div>
                                 <div class="form-group btm_border" id="col2_div" style="display:none;">
                                <label class="col-sm-4 control-label" for="demo-hor-13"><?php echo translate('colum2_Details'); ?></label>
                                <div class="col-sm-6">
                                    <textarea rows="9" name="info_desc"  class="summernotes" data-height="200" data-name="etra_content[]"><?= (isset($content[1]))?$content[1]:"" ?></textarea>
                                </div>
                                </div>
                                 <div class="form-group btm_border" id="col3_div" style="display:none;">
                                <label class="col-sm-4 control-label" for="demo-hor-13"><?php echo translate('colum3_Details'); ?></label>
                                <div class="col-sm-6">
                                    <textarea rows="9" name="info_desc"  class="summernotes" data-height="200" data-name="etra_content[]"><?= (isset($content[3]))?$content[3]:"" ?></textarea>
                                </div>
                                </div>
                        </div>