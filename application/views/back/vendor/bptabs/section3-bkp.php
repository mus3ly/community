<div id="info_section1">
    <span id="bullet_html" style="display:none" content='
    <div class="h-100 row border">
                        <button type="button" class="pull-right mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger remove-parent" parent=".row">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                        <div class="col-md-12">
                        <div class="form-group">
                            <label>Heading</label>
                            <input type="text" class="form-control required" value="" name="etra_content[oindex][feature][index][fhead]" placeholder=" ">
                        </div>
                    </div>
                        <div class="col-md-12">
                        <div class="form-group">
                            <label>Detail</label>
                            <textarea class="form-control required" value="" name="etra_content[oindex][feature][index][fdet]" rows="5"></textarea>
                        </div>
                    </div>
    </div>
    ' >Add Bullet Point</span>
    <div class="row">
    <p>Please add a max of 3 items</p>

    <div class="col-md-12">
        <label class="control-label" for="demo-hor-1"><?php echo translate('section_heading');?></label>
        
            <input type="text" name="extra_section_heading" id="demo-hor-1" value="<?php echo $row['extra_section_heading']; ?>" placeholder="<?php echo translate('extra_section_heading');?>" class="form-control ">
       
    </div>
    <div class="col-md-12">
        <label class="control-label" for="demo-hor-1"><?php echo translate('section_detail');?></label>
     
            <input type="text" name="col3desc" id="demo-hor-1" value="<?php echo $row['col3desc']; ?>" placeholder="<?php echo translate('section_detail');?>" class="form-control ">
       
    </div>
    </div>
            <div class="row">
    <div class="col3_bulet col-md-12" style="
    gap: 20px;
    display: grid;
">
        <?php
        $mkey = 0;
        if(true)
                                        {
                                            $feature = array(array('type'=>''));
                                            if($row['etra_content'])
                                            $feature  = json_decode($row['etra_content'],true);
                                            
                                            foreach ($feature as $key => $value) {
                                                if($key > $mkey)
                                                $mkey = $key;
                                                if(true)
                                                {
                                                    ?>
                                                    <div class="h-100 row border">
                        <button type="button" class="pull-right mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger remove-parent" parent2=".col3_bulet" parent=".row">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                        <div class="col-md-12">
                        <div class="form-group">
                            <label>Section title</label>
                            <input type="text" value="<?= $value['title'] ?>" class="form-control"name="etra_content[<?= $key ?>][title]" />
                        </div>
                        <div class="col-md-12">
                        <div class="form-group">
                            <label>Select Text or Image Type for Column</label>
                            <select type="text" id="type_<?= $key ?>" onchange="chcol(<?= $key ?>)" class="form-control required" name="etra_content[<?= $key ?>][type]" placeholder=" ">
                            <option value="0">Select Column Type</option>
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
    <div class="col-md-12">
    <div class="c13tesfeature_bulet<?= $key ?>" >
        <?php
        if($row['feature'])
                                        {
                                            $tgfeature  = $value['feature'];
                                            // var_dump($tgfeature);
                                            foreach ($tgfeature as $fkey => $tgvalue) {
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
                                                            
                                                            <input type="text" class="form-control required"  name="etra_content[<?= $key ?>][feature][<?= $fkey ?>][fhead]" value="<?php
                                                            echo ($tgvalue['fhead']?$tgvalue['fhead']:'');
                                                            ?>" placeholder=" ">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Detail</label>
                                                            
                                                            <textarea type="text" class="form-control required" rows="5"  name="etra_content[<?= $key ?>][feature][<?= $fkey ?>][fdet]" ><?php
                                                            echo (isset($tgvalue['fdet'])?$tgvalue['fdet']:'');
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
    <div class="col-md-12"><h5>Add Bullet Point</h5></div>
    <button target=".c13tesfeature_bulet<?= $key ?>" outer="<?= $key ?>"  index="<?= count($tgfeature)-1; ?>"  load="bullet_html" load-url="<?= base_url('vendor/section/tg_bullet') ?>" content="Test <?= $key ?>" class="ad_more_btn btn btn-primary">Add Bullet Point</button>
    
     
</div>
    
                                                    <?php
                                                }
                                            }
                                        }
        ?>
        <button target=".col3_bulet"  class="col3_bulet_btn ad_more_btn btn btn-primary pull-right" content='
    <div class="h-100 row border">
                        <button type="button" class="pull-right mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger remove-parent"  parent2=".col3_bulet" parent=".row">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                        <div class="form-group">
                            <label>Section title</label>
                            <input type="text" value="" class="form-control" name="etra_content[index][title]" />
                        </div>
                        <div class="col-md-12">
                        <div class="form-group">
                            <label>Select Text or Image Type for Column</label>
                            <select type="text" id="type_index" onchange="chcol(index)" class="form-control required"name="etra_content[index][type]" placeholder=" ">
                            <option value="0">Select Column Type</option>
                            <option value="img">Image</option>tesf
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
                    <div id="sec3bull_index" style="display:none;" >
                        <div class="col-md-12"><h5>Add Bullet Point</h5></div>
                    <div class="col-md-12 cindex3testfeature_buletindex"></div>
                    <button target=".cindex3testfeature_buletindex" outer="index"  load="bullet_html" load-url="<?= base_url('vendor/section/tg_bullet') ?>" content="Test index" class="ad_more_btn btn btn-primary">Add Feture bullet</button>
                    </div>
    </div>
    ' index="<?= $mkey ?>" limit="3" rtime="25">Add Column</button>
    </div>
    </div>
    
    
</div>
</div>