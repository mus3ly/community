
                          <div class="form-group btm_border" style="padding-top:30px;">
                                <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('check_this_to_show_on_front');?></label>
                            </div>
                            <div class="form-group btm_border">
                                <label class="col-sm-4 control-label" for="demo-hor-12"><?php echo translate('Title');?></label>
                                <div class="col-sm-6">
                                    <input type="text" name="ttitle" id="demo-hor-1" value="<?php echo  $row['ttitle'];?>" placeholder="Gallery Title" class="form-control " >
                                  
                                   
                                </div>
                            </div>
                            <div class="form-group btm_border">
                                <label class="col-sm-4 control-label" for="demo-hor-12"><?php echo translate('Description');?></label>
                                <div class="col-sm-6">
                                    <input type="text" name="tdesc" id="demo-hor-1" value="<?php echo  $row['tdesc'];?>" placeholder="Gallery Description" class="form-control " >
                                  
                                   
                                </div>
                            </div>
                                    <div class="row">
    <div class="text_gal">
        <?php
        $mkey = 0;
        if($row['txt_gal'])
                                        {
                                            $feature  = json_decode($row['txt_gal'],true);
                                            //$feature = array();
                                            //  var_dump(count($feature));
                                            foreach ($feature as $key => $value) {
                                                if($key > $mkey)
                                                $mkey = $key;
                                                if(true)
                                                {
                                                    ?>
                                                    <div class="h-100 row border">
                        <button type="button" class="pull-right mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger remove-parent" parent=".row">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                            <div class="col-md-12" id="text_<?= $key ?>" style="display:block">
                        <div class="form-group">
                            <label>Tile</label>
                            <input type="text" class="form-control required" value="<?= $value['title']; ?>" name="txt_gal[<?= $key ?>][title]"/>
                        </div>
                    </div>
                    <div class="col-md-12" id="text_index" style="display:block">
                        <div class="form-group">
                            <label>Icon</label>
                            <input type="text" class="form-control required" name="txt_gal[<?= $key ?>][icon]"  value="<?= $value['icon']; ?>"/>
                        </div>
                    </div>
                    <div class="col-md-12" id="img_<?= $key ?>" style="display:`block">
                        <div class="form-group">
                            <label>Image</label>
                            <span class="pull-left btn btn-default btn-file"> Choose Image                                            
                            <input data-id="<?= $value['img'] ?>" type="file" value="<?= $value['img'] ?>" name="colimg_<?= $key ?>" id="txt_gal_<?= $key ?>" class="form-control " style="border-color: red;">
                                        </span>
                                        <div id="txt_gal_<?= $key ?>_box">
                                            <?php
                                                if($value['img'])
                                                {
                                                    $img = $this->crud_model->size_img($value['img'],100,100);
                                                    ?>
                                                    <div style='float:left;border:4px solid #303641;padding:5px;margin:5px;'><img height='80' src="<?= $img;?>" data-id="_paris/uploads/product" alt="Column<?= $key ?> Image"/></div><?php
                                                }
                                            ?>
                                        </div>
                            <input type="hidden" value="<?= $value['img'] ?>" name="txt_gal[<?= $key ?>][img]" class="" id="txt_gal_<?= $key ?>_img" placeholder=" ">
                        </div>
                    </div>
                        <div class="col-md-12" id="text_<?= $key ?>" style="display:block">
                        <div class="form-group">
                            <label>Detail</label>
                            <textarea id="textinput_<?= $key ?>" class="form-control required" name="txt_gal[<?= $key ?>][txt]"><?= $value['txt'] ?></textarea>
                        </div>
                    </div>
    </div>
                                                    <?php
                                                }
                                            }
                                        }
        ?>
    </div>
    </div>
    
    <button target=".text_gal" class=" ad_more_btn btn btn-primary" content='
    <div class="h-100 row border">
                        <button type="button" class="pull-right mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger remove-parent" parent=".row">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                        <div class="col-md-12" id="text_index" style="display:block">
                        <div class="form-group">
                            <label>Tile</label>
                            <input type="text" class="form-control required" name="txt_gal[index][title]"/>
                        </div>
                    </div>
                    <div class="col-md-12" id="text_index" style="display:block">
                        <div class="form-group">
                            <label>Icon</label>
                            <input type="text" class="form-control required" name="txt_gal[index][icon]"/>
                        </div>
                    </div>
                        <div class="col-md-12" id="img_index" class="form-control required" style="display:block">
                        <div class="form-group">
                            <label>Image</label>
                            <span class="pull-left btn btn-default btn-file"> Choose Image                                            
                            <input data-id="0" type="file" value="742" name="txt_gal_index" id="txt_gal_index" class="form-control required" style="border-color: red;">
                                        </span>
                                        <div id="txt_gal_index_box"></div>
                            <input type="hidden"  value="" name="txt_gal[index][img]" class="required" id="txt_gal_index_img" placeholder=" ">
                        </div>
                    </div>
                        <div class="col-md-12" id="text_index" style="display:block">
                        <div class="form-group">
                            <label>Detail</label>
                            <textarea id="textinput_index" class="form-control required" name="txt_gal[index][txt]"></textarea>
                        </div>
                    </div>
    </div>
    ' index="<?= $mkey ?>" limit="2" rtime="15">Add item</button>