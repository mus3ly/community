                     <div class="row">
                         <span id="tgbullet_html" style="display:none" content='
    <div class="h-100 margin-bttom-15 row border">
                        <button type="button" class="pull-right mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger remove-parent" parent=".row">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                        <div class="col-md-12">
                        <div class="form-group">
                            <label>index: Heading</label>
                            <input type="text" class="form-control required" value="" name="txt_gal[oindex][feature][index][fhead]" placeholder=" ">
                        </div>
                    </div>
                        <div class="col-md-12">
                        <div class="form-group">
                            <label>Detail</label>
                            <textarea class="form-control required" value="" name="txt_gal[oindex][feature][index][fdet]" rows="5"></textarea>
                        </div>
                    </div>
    </div>
    ' >Add Bullet Point</span>
                         <div class="col-md-12">
                         
                            <div class="form-group btm_border">
                                <label class="control-label" for="demo-hor-12"><?php echo translate('Title');?></label>
                               
                                    <input type="text" name="ttitle" id="demo-hor-1" value="<?php echo  $row['ttitle'];?>" placeholder="Gallery Title" class="form-control " >
                                  
                                   
                              
                            </div>
                            <div class="form-group btm_border">
                                <label class="control-label" for="demo-hor-12"><?php echo translate('Description');?></label>
                               
                                    <input type="text" name="tdesc" id="demo-hor-1" value="<?php echo  $row['tdesc'];?>" placeholder="Gallery Description" class="form-control " >
                                  
                                   
                               
                            </div>
                                    <div class="row">
    <div class="text_gal">
        <?php
        $mkey = 0;
        if(true)
                                        {
                                            $feature = array('');
                                            if($row['txt_gal'])
                                            $feature  = json_decode($row['txt_gal'],true);
                                            //$feature = array();
                                            //  var_dump(count($feature));
                                            $kcount = 0;
                                            foreach ($feature as $key => $value) {
                                                if($key > $mkey)
                                                $mkey = $key;
                                                if(true)
                                                {
                                                    $kcount++;
                                                    ?>
                                                    <div class="h-100 margin-bttom-30 row border">
                        <button type="button" class="pull-right mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger remove-parent" parent=".row">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                            <div class="col-md-12" id="text_<?= $key ?>" style="display:block">
                        <div class="form-group">
                            <div style="nargin-bottom:14px;"><b>Item <?= $kcount ?></b></div>
                            <label> Title</label>
                            <input type="text" class="form-control <?= ($value)?'required':'' ?>" value="<?= $value['title']; ?>" name="txt_gal[<?= $key ?>][title]"/>
                        </div>
                    </div>
                    <div class="col-md-12" id="text_index" style="display:block">
                        <div class="form-group">
                            <label>Icon</label>
                            <input type="text" class="form-control" name="txt_gal[<?= $key ?>][icon]"  value="<?= $value['icon']; ?>"/>
                        </div>
                    </div>
                    <div class="col-md-12" id="img_<?= $key ?>" style="display:`block">
                        <div class="form-group">
                          <label>Image</label>
                            <br> <br>
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
                            <textarea id="textinput_<?= $key ?>" class="form-control <?= ($value)?'required':'' ?>" name="txt_gal[<?= $key ?>][txt]"><?= $value['txt'] ?></textarea>
                            <div class="col-md-12">
    <div class="tgfeature_bulet<?= $key ?>">
        <?php
        if($row['feature'])
                                        {
                                            $tgfeature  = $value['feature'];
                                            // var_dump($tgfeature);
                                            $fkcount = 0;
                                            foreach ($tgfeature as $fkey => $tgvalue) {
                                                
                                                if(true)
                                                {
                                                    $fkcount++;
                                                    ?>
                                                    <div class="h-100 margin-bttom-15 row border">
                        <button type="button" class="pull-right mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger remove-parent" parent=".row">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label> <?= $kcount ?>-<?= $fkcount?>: Heading</label>
                                                            
                                                            <input type="text" class="form-control required"  name="txt_gal[<?= $key ?>][feature][<?= $fkey ?>][fhead]" value="<?php
                                                            echo ($tgvalue['fhead']?$tgvalue['fhead']:'');
                                                            ?>" placeholder=" ">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>Detail</label>
                                                            
                                                            <textarea type="text" class="form-control required" rows="5"  name="txt_gal[<?= $key ?>][feature][<?= $fkey ?>][fdet]" ><?php
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
    <button target=".tgfeature_bulet<?= $key ?>" outer="<?= $key ?>"  index="<?= count($tgfeature)-1; ?>"  load="tgbullet_html" load-url="<?= base_url('vendor/section/tg_bullet') ?>" content="Test <?= $key ?>" class="ad_more_btn btn btn-primary">Add Bullet Point</button>
    
     
</div>
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
    
    <button target=".text_gal" class="pull-right ad_more_btn btn btn-primary" content='
    <div class="h-100 margin-bttom-30 row border">
                        <button type="button" class="pull-right mt-1 btn btn-icon btn-circle btn-sm btn-soft-danger remove-parent" parent=".row">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                        <div class="col-md-12" id="text_index" style="display:block">
                        <div class="form-group">
                            <label>index : Title</label>
                            <input type="text" class="form-control required" name="txt_gal[index][title]"/>
                        </div>
                    </div>
                    <div class="col-md-12" id="text_index" style="display:block">
                        <div class="form-group">
                            <label>Icon</label>
                            <input type="text" class="form-control" name="txt_gal[index][icon]"/>
                        </div>
                    </div>
                        <div class="col-md-12" id="img_index" class="form-control required" style="display:block">
                        <div class="form-group">
                            <label>Image</label>
                            <br>
                            <span class="pull-left btn btn-default btn-file"> Choose Image                                            
                            <input data-id="0" type="file" value="742" name="txt_gal_index" id="txt_gal_index" class="form-control" style="border-color: red;">
                                        </span>
                                        <div id="txt_gal_index_box"></div>
                            <input type="hidden"  value="" name="txt_gal[index][img]" class="" id="txt_gal_index_img" placeholder=" ">
                        </div>
                    </div>
                    
                    
                        <div class="col-md-12" id="text_index" style="display:block">
                        <div class="form-group">
                            <label>Detail</label>
                            <textarea id="textinput_index" class="form-control required" name="txt_gal[index][txt]"></textarea>
                        </div>
                    </div>
                    <div class="col-md-12"><h5>Add Bullet Point</h5></div>
                    <div class="col-md-12 tgfeature_buletindex"></div>
                    <button target=".tgfeature_buletindex" outer="index"  load="tgbullet_html" load-url="<?= base_url('vendor/section/tg_bullet') ?>" content="Test index" class="ad_more_btn btn btn-primary">Add Feture bullet</button>
                    
    </div>
    ' index="<?= $mkey ?>" limit="5" rtime="19">Add Gallery Item</button>
    </div>
    
    </div>