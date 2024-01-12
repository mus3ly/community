                           <div class="col-md-12">
                          
                            <div class="form-group btm_border">
                                <label class="control-label" for="demo-hor-12"><?php echo translate('Title');?></label>
                               
                                    <input type="text" name="gtitle" id="demo-hor-1" value="<?php echo  $row['gallery_lable'];?>" placeholder="Gallery Title" class="form-control " >
                                  
                                   
                               
                            </div>
                            </div>
                             <div class="col-md-12">
                            <div class="form-group btm_border">
                                <label class="control-label" for="demo-hor-12"><?php echo translate('Description');?></label>
                               
                                    <input type="text" name="gdesc" id="demo-hor-1" value="<?php echo  $row['gallery_text'];?>" placeholder="Gallery Description" class="form-control " >
                                  
                                   
                              
                            </div>
                            </div>
                             <div class="col-md-12">
                            <div class="form-group btm_border">
                                <label class="control-label" for="demo-hor-12"><?php echo translate('gallery_images');?></label>
                                <br>
                                    <span class="pull-left btn btn-default btn-file" id="gimgs_txt"> <?php echo translate('choose_image');?>
                                        <input type="file" name="gimgs" onchange="preview(this);" id="gimgs" class="form-control">
                                    </span>
                                    <br><br>
                                    </div>
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
                        