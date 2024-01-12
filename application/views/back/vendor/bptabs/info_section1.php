<div id="info_section1">
    <div class="row">
    <p>Please add max 3 items we will chose first 3 on front page</p>
    <div class="form-group btm_border" style="padding-top:30px;">
        More Details
        <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('check_this_to_show_on_front');?></label>
        <div class="col-sm-6">
            <input type="checkbox" id="demoCheckbox" name="checks[]" value="extra_info" class="checkbox_class" <?= (isset($checks) && in_array('extra_info',$checks))?"checked":""; ?>/>
        </div>
    </div>
    <div class="col-md-12">
        <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('section_heading');?></label>
        <div class="col-sm-6">
            <input type="text" name="extra_section_heading" id="demo-hor-1" value="<?php echo $row['extra_section_heading']; ?>" placeholder="<?php echo translate('extra_section_heading');?>" class="form-control ">
        </div>
    </div>`
    <div class="col-md-12">
        <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('section_detail');?></label>
        <div class="col-sm-6">
            <input type="text" name="col3desc" id="demo-hor-1" value="<?php echo $row['col3desc']; ?>" placeholder="<?php echo translate('section_detail');?>" class="form-control ">
        </div>
    </div>
    </div>
            <div class="row">
    <div class="col3_bulet">
        <?php
        $mkey = 0;
        if($row['etra_content'])
                                        {
                                            $feature  = json_decode($row['etra_content'],true);
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
                        <div class="col-md-12">
                        <div class="form-group">
                            <label>Type</label>
                            <select type="text" id="type_<?= $key ?>" onchange="chcol(<?= $key ?>)" class="form-control required" name="etra_content[<?= $key ?>][type]" placeholder=" ">
                            <option value="0">Select column type</option>
                            <option value="img" <?= (isset($value['type']) && $value['type'] == 'img')?'selected':'' ?>>Image</option>
                            <option value="text" <?= (isset($value['type']) && $value['type'] == 'text')?'selected':'' ?>>Text</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12" id="img_<?= $key ?>" style="display:<?= (isset($value['type']) && $value['type'] == 'img')?'block':'none' ?>">
                        <div class="form-group">
                            <label>Image</label>
                            <span class="pull-left btn btn-default btn-file"> Choose Image                                            
                            <input data-id="<?= $value['img'] ?>" type="file" value="<?= $value['img'] ?>" name="colimg_<?= $key ?>" id="colimg_<?= $key ?>" class="form-control <?= ($value['img'])?'required':'' ?>" style="border-color: red;">
                                        </span>
                                        <div id="colimg_<?= $key ?>_box">
                                            <?php
                                                if($value['img'])
                                                {
                                                    $img = $this->crud_model->size_img($value['img'],100,100);
                                                    ?>
                                                    <div style='float:left;border:4px solid #303641;padding:5px;margin:5px;'><img height='80' src="<?= $img;?>" data-id="_paris/uploads/product" alt="Column<?= $key ?> Image"/></div><?php
                                                }
                                            ?>
                                        </div>
                            <input type="hidden" value="<?= $value['img'] ?>" name="etra_content[<?= $key ?>][img]" class="<?= (isset($value['type']) && $value['type'] == 'img')?'required':' ' ?>" id="colimg_<?= $key ?>_img" placeholder=" ">
                        </div>
                    </div>
                        <div class="col-md-12" id="text_<?= $key ?>" style="display:<?= (isset($value['type']) && $value['type'] == 'text')?'block':'none' ?>">
                        <div class="form-group">
                            <label>Detail</label>
                            <textarea id="textinput_<?= $key ?>" class="form-control <?= (isset($value['type']) && $value['type'] == 'text')?'required':' ' ?>" name="etra_content[<?= $key ?>][txt]"><?= $value['txt'] ?></textarea>
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
    
    <button target=".col3_bulet" class=" ad_more_btn btn btn-primary" content='
    <div class="h-100 row border">
                        <button type="button" class="pull-right mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger remove-parent" parent=".row">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                        <div class="col-md-12">
                        <div class="form-group">
                            <label>Type</label>
                            <select type="text" id="type_index" onchange="chcol(index)" class="form-control required"name="etra_content[index][type]" placeholder=" ">
                            <option value="0">Select column type</option>
                            <option value="img">Image</option>
                            <option value="text">Text</option>
                            </select>
                        </div>
                    </div>
                        <div class="col-md-12" id="img_index" style="display:none">
                        <div class="form-group">
                            <label>Image</label>
                            <span class="pull-left btn btn-default btn-file"> Choose Image                                            
                            <input data-id="0" type="file" value="742" name="colimg_index" id="colimg_index" class="form-control required" style="border-color: red;">
                                        </span>
                                        <div id="colimg_index_box"></div>
                            <input type="hidden"  value="" name="etra_content[index][img]" class="required" id="colimg_index_img" placeholder=" ">
                        </div>
                    </div>
                        <div class="col-md-12" id="text_index" style="display:none">
                        <div class="form-group">
                            <label>Detail</label>
                            <textarea id="textinput_index" class="form-control required" name="etra_content[index][txt]"></textarea>
                        </div>
                    </div>
    </div>
    ' index="<?= $mkey ?>" limit="2" rtime="15">Add item</button>
</div>
