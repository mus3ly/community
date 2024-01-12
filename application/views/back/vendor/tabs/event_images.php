
                          <div class="form-group btm_border" style="padding-top:30px;">
                                <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('check_this_to_show_on_front');?></label>
                                <div class="col-sm-6">
                                  <input type="checkbox" id="demoCheckbox" name="checks[]" value="event_images" class="checkbox_class" <?= (in_array('event_images',$checks))?"checked":""; ?>/>
                                </div>
                            </div>
                            <div class="form-group btm_border">
                                <label class="col-sm-4 control-label" for="demo-hor-12"><?php echo translate('Title');?></label>
                                <div class="col-sm-6">
                                    <input type="text" name="gtitle" id="demo-hor-1" value="<?php echo  $row['gallery_lable'];?>" placeholder="Gallery Title" class="form-control " >
                                  
                                   
                                </div>
                            </div>
                            <div class="form-group btm_border">
                                <label class="col-sm-4 control-label" for="demo-hor-12"><?php echo translate('Description');?></label>
                                <div class="col-sm-6">
                                    <input type="text" name="gdesc" id="demo-hor-1" value="<?php echo  $row['gallery_text'];?>" placeholder="Gallery Description" class="form-control " >
                                  
                                   
                                </div>
                            </div>
                            <div class="form-group btm_border">
                                <label class="col-sm-4 control-label" for="demo-hor-12"><?php echo translate('galery_imgs');?></label>
                                <div class="col-sm-6">
                                    <span class="pull-left btn btn-default btn-file" id="gimgs_txt"> <?php echo translate('choose_file');?>
                                        <input type="file" name="gimgs" onchange="preview(this);" id="gimgs" class="form-control">
                                    </span>
                                    <br><br>
                                    </div>
                                    <div class="col-md-12">
                                    <span id="previewImg" ></span>
                                    <br><br>
                                    <div class="gallary_images" id="gimgs_box">
                                        <ul>
                                        <?php
                                        $this->db->order_by("id", "asc");
                                        $imgs = $this->db->where('pid',$row['product_id'])->get('product_to_images')->result_array();
                                        foreach ($imgs as $key => $value) {
                                            $img = $this->crud_model->size_img($value['img'],100,100);
                                            ?>
                                            <li id="gimg_<?= $value['id']; ?>">
                                                <div onclick="delimg('<?= $value['id']; ?>')" class="del_icon">
                                                    <i class="fa-solid fa-xmark"></i>
                                                </div>
                                                <img src="<?= $img ?>"/>
                                                </li>
                                                

                                            <?php
                                        }
                                        ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>