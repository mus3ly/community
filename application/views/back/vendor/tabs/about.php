<div id="about" class="tab-pane fade ">
                             <div class="form-group btm_border" style="padding-top:30px;">
                                <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('check_this_to_show_on_front');?></label>
                                <div class="col-sm-6">
                                  <input type="checkbox" id="demoCheckbox" name="checks[]" value="about" class="checkbox_class" <?= (in_array('about',$checks))?"checked":""; ?>/>
                                </div>
                            </div>
                        <div class="form-group btm_border">
                                <div class="col-sm-4"></div>
                                <div class="col-sm-8"></div>
                                <label class="col-sm-4 control-label" for="">
                                    <?php echo translate('Title');?>
                                </label>
                                <div class="col-sm-6">
                                    <input type="text" name="about_title" value="<?php echo $row['about_title'];?>"
                                           placeholder="<?php echo translate('About us')?>"
                                           class="form-control ">
                                </div>
                                <div class="col-sm-2"></div>
                            </div>
                            <div class="form-group btm_border">
                                <div class="col-sm-4"></div>
                                <div class="col-sm-8"></div>
                                <label class="col-sm-4 control-label" for="">
                                    <?php echo translate(' More Info');?>
                                </label>
                                <div class="col-sm-6">
                                        <textarea  
                                                  class="form-control" name="about_description" rows='4' ><?php echo $row['about_desc']; ?></textarea>
                                </div> 
                                <div class="col-sm-2"></div>
                            </div>
                             <div class="form-group btm_border">
                                <label class="col-sm-4 control-label" for="demo-hor-11"><?php echo translate('Categories');?></label>
                                <div class="col-sm-6">
                                    <input type="text" name="cats" value="<?= $row['cats']; ?>" data-role="tagsinput" placeholder="<?php echo translate('enter comma (,) to add more');?>" class="form-control">
                                </div>
                            </div>
                            <div class="form-group btm_border">
                                <div class="col-sm-4"></div>
                                <div class="col-sm-8"></div>
                                <label class="col-sm-4 control-label" for="">
                                    <?php echo translate(' Address');?>
                                </label>
                                <div class="col-sm-6">
                                        <textarea name="about_address"  placeholder="<?php echo translate('Ex. New Yamaha Sports bike in 2020 from Japan')?>"
                                                  class="form-control" rows='4' ><?php echo $row['about_address']; ?></textarea>
                                </div>
                                <div class="col-sm-2"></div>
                            </div>
                             
                            <div class="form-group btm_border">
                                <label class="col-sm-4 control-label" for="demo-hor-11"><?php echo translate('Opening Time');?></label>
                                <div class="col-sm-6">
                                    <input type="time" name="openig_time" value="<?= date("h:i:s", strtotime( $row['openig_time'])); ?>"  placeholder="<?php echo translate('opening');?>" class="form-control">
                                </div>
                            </div>
                            <div class="form-group btm_border">
                                <label class="col-sm-4 control-label" for="demo-hor-11"><?php echo translate('Closing Time');?></label>
                                <div class="col-sm-6">
                                    <input type="time" name="closing_time" value="<?= date("h:i:s", strtotime( $row['closing_time'])); ?>" placeholder="<?php echo translate('closing');?>" class="form-control">
                                </div>
                            </div>
             <div class="form-group btm_border ">
                            <?php
                            $old = $row['social_media'];
                            $old = json_decode($old,true);
                            // var_dump($social_media);
                            $img ='';
                            foreach($social_media as $k => $v){
                                $id = $v['id'];
                                // var_dump( $id);
                                // var_dump( $old);
                                
                            if($v['img']){
                               $img = $this->crud_model->get_img($v['img'])->secure_url;
                             } 

                            ?>
                            <div class="row">
                                <div class="col-sm-4 control-label social_image" for="">
                                    <img src="<?= $img?>" >
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" name="social[<?php echo $v['id']; ?>]" value="<?= isset($old[$v['id']])?$old[$v['id']]:''; ?>" placeholder="<?php echo $v['name']; ?>"
                                           class="form-control " readonly>
                                </div>
                                <div class="col-sm-2"></div>
                                </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>