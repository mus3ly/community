<div class="row">
    <div class="col-md-12">
		<?php
            echo form_open(base_url() . 'admin/product/do_add/', array(
                'class' => 'form-horizontal',
                'method' => 'post',
                'id' => 'product_add',
				'enctype' => 'multipart/form-data'
            ));
        ?>
            <!--Panel heading-->
                       <div class="panel-heading">
                <div class="panel-control" style="float: left;">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a data-toggle="tab" href="#customer_choice_options"><?php echo translate('business_type'); ?></a>
                        </li>
                        
                        <li >
                            <a data-toggle="tab" href="#top_banner"><?php echo translate('general'); ?></a>
                        </li>
                        
                        <li >
                            <a data-toggle="tab" href="#event_images"><?php echo translate('images_gallary'); ?></a>
                        </li>

                        <li >
                            <a data-toggle="tab" href="#first_section"><?php echo translate('Desciptive_section'); ?></a>
                        </li>

                        
                        </li>
                        <li>
                            <a data-toggle="tab" href="#location"><?php echo translate('location'); ?></a>
                        </li>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#seo_section"><?php echo translate('seo_section'); ?></a>
                        </li>
                        
                    </ul>
                </div>
            </div>
            <div class="panel-body">
                <div class="tab-base">
                    <!--Tabs Content-->                    
                    <div class="tab-content">
                    <div id="customer_choice_options" class="tab-pane fade active in">
                        <input type="hidden" id="category" name="category"/>
                           <div class="row" id="cat_res">
                                
                                 <?php
                            foreach($brands as $k => $v){
                                if(get_cat_level($v['category_id']) == 1)
                                {
                            ?>
                                <div class="col-md-4 col-sm-12 col-xs-12 <?= ($product_data->category == $v['category_id'])?"active":"" ?>" onclick="selecttype('<?= $v['category_id'];?>')" >
                                    <a href="#"><div class="flip-card ">
                                  <div class="flip-card-inner">
                                    <div class="flip-card-front <?= ($product_data->category == $v['category_id'])?"active":"" ?>">
                                        <i class="fa <?= $v['fa_icon'];?>" aria-hidden="true"></i>
                                        <br>
                                        <p><?= $v['category_name'];?></p>
                                    </div>
                                    <div class="flip-card-back"><p><?= $v['category_name'];?> </p></div>
                                  </div>
                                </div>
                                </a>
                                </div>
                                <?php 
                                }
                            }
                            ?>
                                <div class="col-md-4 col-sm-12 col-xs-12"></div>
                                <div class="col-md-4 col-sm-12 col-xs-12"></div>
                            </div>
                        </div>
                        <div id="top_banner" class="tab-pane fade ">
                            <h4 class="text-thin text-center"><?php echo translate('top_banner'); ?></h4> 
                            <div class="form-group btm_border">
                            <div class="form-group btm_border">
                                <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('listing_title');?></label>
                                <div class="col-sm-6">
                                    <input type="text" name="title" id="demo-hor-1" value="<?php echo $row['title']; ?>" placeholder="<?php echo translate('listing_title');?>" class="form-control required">
                                </div>
                            </div>
                            <div class="form-group btm_border">
                                <label class="col-sm-4 control-label" for="demo-hor-13"><?php echo translate('listing_detail'); ?></label>
                                <div class="col-sm-6">
                                    <textarea rows="9" name="description"  class="summernotes" data-height="200" data-name="description"><?php echo $row['description']; ?></textarea>
                                </div>
                                </div>
                                <div class="form-group btm_border">
                                <label class="col-sm-4 control-label" for="demo-hor-11"><?php echo translate('tags');?></label>
                                <div class="col-sm-6">
                                    <input type="text" name="tag" value="<?= $row['tag']; ?>" data-role="tagsinput" placeholder="<?php echo translate('tags');?>" class="form-control">
                                </div>
                            </div>
                            <div class="form-group btm_border">
                                <label class="col-sm-4 control-label" for="demo-hor-6"><?php echo translate('whatsapp_number');?></label>
                                <div class="col-sm-4">
                                    <input type="number" name="whatsapp_number" id="demo-hor-6" min='0' step='.01' placeholder="<?php echo translate('whatsapp_number');?>" value="<?= $row['whatsapp_number'] ?>" class="form-control ">
                                </div>
                            </div>
                            <div class="form-group btm_border">
                                <label class="col-sm-4 control-label" for="demo-hor-6"><?php echo translate('business_email');?></label>
                                <div class="col-sm-4">
                                    <input type="email" name="bussniuss_email" id="demo-hor-6" min='0' step='.01' placeholder="<?php echo translate('business_email');?>" value="<?= $row['bussniuss_email'] ?>" class="form-control ">
                                </div>
                            </div>
                            <div class="form-group btm_border">
                                <label class="col-sm-4 control-label" for="demo-hor-6"><?php echo translate('business_phone');?></label>
                                <div class="col-sm-4">
                                    <input type="number" name="bussniuss_phone" id="demo-hor-6" min='0' step='.01' placeholder="<?php echo translate('business_phone');?>" value="<?= $row['bussniuss_phone'] ?>" class="form-control ">
                                </div>
                            </div>
                                    <label class="col-sm-4 control-label" for="demo-hor-12">Feature image</label>
                                    <div class="col-sm-6">
                                        <span class="pull-left btn btn-default btn-file"> <?php echo translate('choose_file');?>
                                            <input type="file" value="<?= ($row['sneakerimg'])?$row['sneakerimg']:""; ?>" name="sneakerimg" onchange="preview1(this);" id="demo-hor-inputpass" class="form-control">
                                        </span>
                                        <br><br>
                                        <span id="previewImg1" >
                                            
                                            <?php
                                                if($row['comp_logo'])
                                                {
                                                    $img = $this->crud_model->size_img($row['comp_logo'],100,100);
                                                    ?>
                                                    <img class="img-responsive" width="100" src="<?= $img;?>" data-id="_paris/uploads/product" alt="Feature Image"><?php
                                                }
                                            ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group btm_border">
                                    <label class="col-sm-4 control-label" for="demo-hor-12">Cover Image</label>
                                    <div class="col-sm-6">
                                        <span class="pull-left btn btn-default btn-file"> <?php echo translate('choose_file');?>
                                            <input type="file" name="sideimg" onchange="preview2(this);" id="demo-hor-inputpass" class="form-control">
                                        </span>
                                        <br><br>
                                        <span id="previewImg2" >
                                            <?php
                                                if($row['comp_cover'])
                                                {
                                                    $img = $this->crud_model->size_img($row['comp_cover'],100,100);
                                                    ?>
                                                    <img class="img-responsive" width="500" src="<?= $img?>" data-id="_paris/uploads/product" alt="User_Image"><?php
                                                }
                                            ?>
                                        </span>
                                    </div>
                                </div>
                        
                        </div>
                        <div id="first_section" class="tab-pane fade ">
                                
                                <div class="form-group btm_border">
                                    <label class="col-sm-4 control-label" for="demo-hor-12">section Image</label>
                                    <div class="col-sm-6">
                                        <span class="pull-left btn btn-default btn-file"> <?php echo translate('choose_file');?>
                                            <input type="file" name="firstImg" onchange="preview3(this);" id="demo-hor-inputpass" class="form-control">
                                        </span>
                                        <br><br>
                                        <span id="previewImg3">
                                            <?php
                                                if($row['firstImg'])
                                                {
                                                    $img = $this->crud_model->size_img($row['firstImg'],80,80);
                                                    ?>
                                                    <div  style="float:left;border:4px solid #303641;padding:5px;margin:5px;">
                                                    <img class="img-responsive" height="80" src="<?= $img?>" data-id="_paris/uploads/product" alt="User_Image"></div><?php
                                                }
                                            ?>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group btm_border">
                                    <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('main_heading');?></label>
                                    <div class="col-sm-6">
                                        <input type="text" name="slogan" id="demo-hor-1" value="<?php echo $row['slogan']; ?>" placeholder="<?php echo translate('main_heading');?>" class="form-control ">
                                    </div>
                                </div>
                                <div class="form-group btm_border">
                                <label class="col-sm-4 control-label" for="demo-hor-13"><?php echo translate('description'); ?></label>
                                <div class="col-sm-6">
                                    <textarea rows="9" name="main_heading"  class="summernotes" data-height="200" data-name="main_heading"><?php echo $row['main_heading']; ?></textarea>
                                </div>
                                </div>
                                <div class="form-group btm_border">
                                <label class="col-sm-4 control-label" for="demo-hor-13"><?php echo translate('features_bullet'); ?></label>
                                <div class="col-sm-6">
                                    <div id="feature_div" >
                                    <?php
                                        if($row['feature'])
                                        {
                                            $feature  = json_decode($row['feature'],true);
                                            foreach ($feature as $key => $value) {
                                                if($key == 0)
                                                {
                                                    ?>
                                                    <div class="feature_single" >
                                                        <textarea class="form-control" name="feature[0][fdet]" style="width:45%;float:left;" placeholder="Details"><?= $value['fdet'] ?></textarea>
                                                        <button style="width:4px;" class="btn btn-success" onclick="add_feature()" >+</buuton>
                                                    </div>
                                                    <?php
                                                }
                                                else{
                                                    ?>
                                                    <div class="feature_single"  id="fid_<?= $key ?>">
                                                        <input type="text" class="form-control" value="<?= $value['fhead'] ?>" name="feature[<?= $key ?>][fhead]" style="width:45%;float:left;" placeholder="Heading" />
                                                        <textarea class="form-control" name="feature[<?= $key ?>][fdet]" style="width:45%;float:left;" placeholder="Details"><?= $value['fdet'] ?></textarea>
                                                        <button style="width:4px;" class="btn btn-danger" onclick="remove_feature('<?= $key; ?>')" >-</buuton>
                                                    </div>
                                              
                                                    <?php
                                                }
                                            }
                                        }
                                        else
                                        {?>
                                        
                                        <div class="feature_single" >
                                            <input type="text" class="form-control" name="feature[0][fhead]" style="width:45%;float:left;" placeholder="Heading" />
                                            <textarea class="form-control" name="feature[0][fdet]" style="width:45%;float:left;" placeholder="Details"></textarea>
                                            <button style="width:4px;" class="btn btn-success" onclick="add_feature()" >+</buuton>
                                        </div>
                                        <?php  
                                        }
                                        ?>
                                        

                                    </div>
                                   </div>
                                </div>
                                <div class="form-group btm_border">
                                <label class="col-sm-4 control-label" for="demo-hor-13"><?php echo translate('section_buttons'); ?></label>
                                <div class="col-sm-6">
                                    <div id="button_div" >
                                    <?php
                                        if($row['buttons'])
                                        {
                                            $btns  = json_decode($row['buttons'],true);
                                            foreach ($btns as $key => $value) {
                                                if($key == 0)
                                                {
                                                    ?>
                                                    <div class="feature_single" >
                                                        <input type="text" class="form-control" value="<?= $value['txt'] ?>" name="buttons[0][txt]" style="width:45%;float:left;" placeholder="Text" />
                                                        <input type="text" class="form-control" value="<?= $value['url'] ?>" name="buttons[0][url]" style="width:45%;float:left;" placeholder="Url" />     
                                                        <button style="width:4px;" class="btn btn-success" onclick="add_btn()" >+</buuton>
                                                    </div>
                                                    <?php
                                                }
                                                else{
                                                    ?>
                                                    <div class="feature_single"  id="bid_<?= $key ?>">
                                                        <input type="text" class="form-control" value="<?= $value['txt'] ?>" name="buttons[<?= $key ?>][txt]" style="width:45%;float:left;" placeholder="Heading" />
                                                        <input type="text" class="form-control" value="<?= $value['url'] ?>" name="buttons[<?= $key ?>][url]" style="width:45%;float:left;" placeholder="Url" />     
                                                        <button style="width:4px;" class="btn btn-danger" onclick="remove_btn('<?= $key; ?>')" >-</buuton>
                                                    </div>
                                              
                                                    <?php
                                                }
                                            }
                                        }
                                        else
                                        {?>
                                        <div class="feature_single" >
                                            <input type="text" class="form-control" name="buttons[0][txt]" style="width:45%;float:left;" placeholder="Text" />
                                            <input type="text" class="form-control" name="buttons[0][url]" style="width:45%;float:left;" placeholder="Url" />
                                            <button style="width:4px;" class="btn btn-success" onclick="add_btn()" >+</button>
                                        </div>
                                        <?php  
                                        }
                                        ?>
                                        

                                    </div>
                                </div>
                            </div>

                        </div>
                        <div id="text_gallary" class="tab-pane fade ">
                        <div class="col-md-12">
                                    <div id="text_div" >
                                    <?php
                                        if($row['text'])
                                        {
                                            $feature  = json_decode($row['text'],true);
                                            foreach ($feature as $key => $value) {
                                                if($key == 0)
                                                {
                                                    ?>
                                                    <div class="feature_single" >
                                                        <input type="text" class="form-control" value="<?= $value['fhead'] ?>" name="text[0][fhead]" style="width:45%;float:left;" placeholder="Heading" />
                                                        <textarea class="form-control" name="text[0][fdet]" style="width:45%;float:left;" placeholder="Details"><?= $value['fdet'] ?></textarea>
                                                        <button style="width:4px;" class="btn btn-success" onclick="add_text()" >+</buuton>
                                                    </div>
                                                    <?php
                                                }
                                                else{
                                                    ?>
                                                    <div class="feature_single"  id="fid_<?= $key ?>">
                                                        <input type="text" class="form-control" value="<?= $value['fhead'] ?>" name="text[<?= $key ?>][fhead]" style="width:45%;float:left;" placeholder="Heading" />
                                                        <textarea class="form-control" name="text[<?= $key ?>][fdet]" style="width:45%;float:left;" placeholder="Details"><?= $value['fdet'] ?></textarea>
                                                        <button style="width:4px;" class="btn btn-danger" onclick="remove_text('<?= $key; ?>')" >-</buuton>
                                                    </div>
                                              
                                                    <?php
                                                }
                                            }
                                        }
                                        else
                                        {?>
                                        
                                        <div class="feature_single" >
                                            <input type="text" class="form-control" name="text[0][fhead]" style="width:45%;float:left;" placeholder="Heading" />
                                            <textarea class="form-control" name="text[0][fdet]" style="width:45%;float:left;" placeholder="Details"></textarea>
                                            <button style="width:4px;" class="btn btn-success" onclick="add_text()" >+</buuton>
                                        </div>
                                        <?php  
                                        }
                                        ?>
                                        

                                    </div>
                                    </div>
                        </div>
                        <div id="seo_section" class="tab-pane fade ">
                        <div class="form-group btm_border">
                                <div class="col-sm-4"></div>
                                <div class="col-sm-8"><small>*<?php echo translate('Write an seo friendly title within 60 characters')?></small></div>
                                <label class="col-sm-4 control-label" for="">
                                    <?php echo translate('Seo Friendly Title');?>
                                </label>
                                <div class="col-sm-6">
                                    <input type="text" name="seo_title" value="<?php echo $row['seo_title']; ?>"
                                           placeholder="<?php echo translate('Ex. Yamaha RT - Model 2020')?>"
                                           class="form-control required">
                                </div>
                                <div class="col-sm-2"></div>
                            </div>
                            <div class="form-group btm_border">
                                <div class="col-sm-4"></div>
                                <div class="col-sm-8"><small>*<?php echo translate('Write an seo friendly description within 160 characters')?></small></div>
                                <label class="col-sm-4 control-label" for="">
                                    <?php echo translate('Seo Friendly Description');?>
                                </label>
                                <div class="col-sm-6">
                                        <textarea name="seo_description"
                                                  placeholder="<?php echo translate('Ex. New Yamaha Sports bike in 2020 from Japan')?>"
                                                  class="form-control required" rows='4' ><?php echo $row['seo_description']; ?></textarea>
                                </div>
                                <div class="col-sm-2"></div>
                            </div>

                        </div>
                        <div id="location" class="tab-pane fade ">
                        <input id="searchTextField" type="text" size="50" placeholder="Enter a location" autocomplete="on" runat="server" />
                            
                            <div id="googleMap" style="width:100%;height:400px;"></div>
                                                        
                                Or Enter Cordinates
                                        <div>
                                    <label>Latitude</label>
                                    <input type="text" id="cityLat" value="<?= $row['lat']; ?>" name="lat" />
                             </div>
                            <div>
                                <label>Longitude</label>
                                <input type="text" id="cityLng" value="<?= $row['lng']; ?>" name="lng" />
                            </div>
                        </div>
                        <div id="event_images" class="tab-pane fade ">
                        <div class="form-group btm_border">
                                <h4 class="text-thin text-center"><?php echo translate('gallary_images'); ?></h4>                            
                            </div>
                            <div class="form-group btm_border">
                                <label class="col-sm-4 control-label" for="demo-hor-12"><?php echo translate('images');?></label>
                                <div class="col-sm-6">
                                    <span class="pull-left btn btn-default btn-file"> <?php echo translate('choose_file');?>
                                        <input type="file" multiple name="images[]" onchange="preview(this);" id="demo-hor-inputpass" class="form-control">
                                    </span>
                                    <br><br>
                                    <span id="previewImg" ></span>
                                    <br><br>
                                    <div class="gallary_images">
                                        <ul>
                                        <?php
                                        $imgs = $this->db->where('pid',$row['product_id'])->get('product_to_images')->result_array();
                                        foreach ($imgs as $key => $value) {
                                            $img = $this->crud_model->size_img($value['img'],100,100);
                                            ?>
                                            <li id="gimg_<?= $value['id']; ?>">
                                                <div onclick="delimg('<?= $value['id']; ?>')" class="del_icon"><i class="fa fa-trash-o" aria-hidden="true"></i>
</div>

                                                <img src="<?= $img ?>"/></li>

                                            <?php
                                        }
                                        ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="text_gallary" class="tab-pane fade ">text_gallery</div>
                        <!--<div id="general" class="tab-pane fade ">
                        <div class="form-group btm_border">
                                <label class="col-sm-4 control-label" for="demo-hor-11"><?php echo translate('tags');?></label>
                                <div class="col-sm-6">
                                    <input type="text" name="tag" data-role="tagsinput" placeholder="<?php echo translate('tags');?>" value="<?php echo $row['tag']; ?>" class="form-control">
                                </div>
                            </div>
                            
                            <div class="form-group btm_border">
                                <label class="col-sm-4 control-label" for="demo-hor-13"><?php echo translate('description'); ?></label>
                                <div class="col-sm-6">
                                    <textarea rows="9" name="description"  class="summernotes" data-height="200" data-name="description"><?php echo $row['description']; ?></textarea>
                                </div>
                            </div>

                            <div class="form-group btm_border">
                                <div class="col-sm-4"></div>
                                <div class="col-sm-8"><small>*<?php echo translate('Write an seo friendly title within 60 characters')?></small></div>
                                <label class="col-sm-4 control-label" for="">
                                    <?php echo translate('Seo Friendly Title');?>
                                </label>
                                
                            
                            <div id="more_additional_fields"></div>
                            <div class="form-group btm_border">
                                <label class="col-sm-4 control-label" for="demo-hor-inputpass"></label>
                                            <span class="btn btn-purple btn-labeled fa fa-hand-o-right pull-right" onclick="next_tab()"><?php echo translate('next'); ?></span>
                <span class="btn btn-purple btn-labeled fa fa-hand-o-left pull-right" onclick="previous_tab()"><?php echo translate('previous'); ?></span>
                            </div>
                            

                        </div>-->
                        <div id="event_images" class="tab-pane fade ">
        
                            

                            <div class="form-group btm_border">
                                <label class="col-sm-4 control-label" for="demo-hor-13"></label>
                                <div class="col-sm-6">
                                    <?php 
                                        $images = $this->crud_model->file_view('product',$row['product_id'],'','','thumb','src','multi','all');
                                        var_dump();
                                        if($images && $num_of_imgs){
                                            foreach ($images as $row1){
                                                $a = explode('.', $row1);
                                                $a = $a[(count($a)-2)];
                                                $a = explode('_', $a);
                                                $p = $a[(count($a)-2)];
                                                $i = $a[(count($a)-3)];
                                    ?>
                                        <div class="delete-div-wrap">
                                            <span class="close">&times;</span>
                                            <div class="inner-div">
                                                <img class="img-responsive" width="100" src="<?php echo $row1; ?>" data-id="<?php echo $i.'_'.$p; ?>" alt="User_Image" >
                                            </div>
                                        </div>
                                    <?php 
                                            }
                                        } 
                                    ?>
                                </div>
                            </div>

                        </div>
                            </div>
                        </div>
                        
                            <span class="btn btn-purple btn-labeled fa fa-hand-o-right pull-right" onclick="next_tab()"><?php echo translate('next'); ?></span>
                <span class="btn btn-purple btn-labeled fa fa-hand-o-left pull-right" onclick="previous_tab()"><?php echo translate('previous'); ?></span>
                            
                        </div>    
               <div class="panel-footer">
                <div class="row">
                    <div class="col-md-11">
                        <span class="btn btn-purple btn-labeled fa fa-refresh pro_list_btn pull-right" 
                            onclick="ajax_set_full('add','<?php echo translate('add_product'); ?>','<?php echo translate('successfully_added!'); ?>','product_add',''); "><?php echo translate('reset');?>
                        </span>
                    </div>
                    
                    <div class="col-md-1">
                        <span class="btn btn-success btn-md btn-labeled fa fa-upload pull-right enterer" onclick="form_submit('product_add','<?php echo translate('product_has_been_uploaded!'); ?>');proceed('to_add');" ><?php echo translate('upload');?></span>
                    </div>
                    
                </div>
            </div>
    
        </form>
    </div>
</div>

<script src="<?php $this->benchmark->mark_time(); echo base_url(); ?>template/back/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js">
</script>

<input type="hidden" id="option_count" value="-1">

<script>
    window.preview = function (input) {
        if (input.files && input.files[0]) {
            $("#previewImg").html('');
            $(input.files).each(function () {
                var reader = new FileReader();
                reader.readAsDataURL(this);
                reader.onload = function (e) {
                    $("#previewImg").append("<div style='float:left;border:4px solid #303641;padding:5px;margin:5px;'><img height='80' src='" + e.target.result + "'></div>");
                }
            });
        }
    }

    function other_forms(){}
	
	function set_summer(){
        $('.summernotes').each(function() {
            var now = $(this);
            var h = now.data('height');
            var n = now.data('name');
			if(now.closest('div').find('.val').length == 0){
            	now.closest('div').append('<input type="hidden" class="val" name="'+n+'">');
			}
            now.summernote({
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['view', ['codeview', 'help']],
                ],
                height: h,
                onChange: function() {
                    now.closest('div').find('.val').val(now.code());
                }
            });
            now.closest('div').find('.val').val(now.code());
        });
	}

    function option_count(type){
        var count = $('#option_count').val();
        if(type == 'add'){
            count++;
        }
        if(type == 'reduce'){
            count--;
        }
        $('#option_count').val(count);
    }

    function set_select(){
        $('.demo-chosen-select').chosen();
        $('.demo-cs-multiselect').chosen({width:'100%'});
    }
	
    $(document).ready(function() {
        set_select();
		set_summer();
		createColorpickers();
    });

    function other(){
        set_select();
        $('#sub').show('slow');
    }
    function get_cat(id,now){
        $('#sub').hide('slow');
        ajax_load(base_url+'admin/product/sub_by_cat/'+id,'sub_cat','other');
    }
	function get_brnd(id){
        $('#brn').hide('slow');
        ajax_load(base_url+'admin/product/brand_by_sub/'+id,'brand','other');
        $('#brn').show('slow');
    }
    function get_sub_res(id){}

    $(".unit").on('keyup',function(){
        $(".unit_set").html($(".unit").val());
    });

	function createColorpickers() {
	return false
		$('.demo2').colorpicker({
			format: 'rgba'
		});
		
	}
    
    $("#more_btn").click(function(){
        $("#more_additional_fields").append(''
            +'<div class="form-group">'
            +'    <div class="col-sm-4">'
            +'        <input type="text" name="ad_field_names[]" class="form-control required"  placeholder="<?php echo translate('field_name'); ?>">'
            +'    </div>'
            +'    <div class="col-sm-5">'
            +'        <textarea rows="9"  class="summernotes" data-height="100" data-name="ad_field_values[]"></textarea>'
            +'    </div>'
            +'    <div class="col-sm-2">'
            +'        <span class="remove_it_v rms btn btn-danger btn-icon btn-circle icon-lg fa fa-times" onclick="delete_row(this)"></span>'
            +'    </div>'
            +'</div>'
        );
        set_summer();
    });
    
    function next_tab(){
        var mid = $('.nav-tabs li.active').find('a').attr('href')+' .required';
        var find = 0;
        var size_option = $('#size_type').val();
        if($('.nav-tabs li.active').find('a').attr('href') == '#product_details')
        {
        }
        else
        {
            form_submit('product_add','<?php echo translate('product_has_been_uploaded!'); ?>');proceed('to_add');
            return 0;
        }
        $(mid).each(function(){
            var here = $(this);
            if(here.val() == ''){
                console.log(here.attr('name'));
                find = 1;
                if(true){
                    find = 1;
                    here.css({borderColor: 'red'});
                    if(here.attr('type') == 'number'){
                        txt = '*'+mbn;
                    }
                    
                    if(here.closest('div').find('.require_alert').length){

                    } else {
                        sound('form_submit_problem');
                        find = 1;
                        var take = '';
                        var txt = 'Required';
                        here.closest('div').append(''
                            +'  <span id="'+take+'" class="label label-danger require_alert" >'
                            +'      '+txt
                            +'  </span>'
                        );
                    }
                }
            }//if empty
        });
        if(find == 0)
        {
            if($('.nav-tabs li.active').find('a').attr('href') == '#product_details')
        {
            
                     $('.sizes').each(function(i, obj) {
                console.log($(this).attr('class'));
    if($(this).hasClass('size_'+size_option))
    {
        
    }
    else
    {
        $(this).remove();
    }
});
        }
            $('#next_btn').text('upload');
            $('#next_btn').addClass('btn-success');
            $('#next_btn').addClass('enterer');
            $('#next_btn').removeClass('btn-purple');
        $('.nav-tabs li.active').next().find('a').click();                    
        }
        else
        {
            alert("Please fill required field");
            return  0;
        }
    }
    function previous_tab(){
        $('.nav-tabs li.active').prev().find('a').click();                     
    }
    
    $("#more_option_btn").click(function(){
        option_count('add');
        var co = $('#option_count').val();
        $("#more_additional_options").append(''
            +'<div class="form-group" data-no="'+co+'">'
            +'    <div class="col-sm-4">'
            +'        <input type="text" name="op_title[]" class="form-control required"  placeholder="<?php echo translate('customer_input_title'); ?>">'
            +'    </div>'
            +'    <div class="col-sm-5">'
            +'        <select class="demo-chosen-select op_type required" name="op_type[]" >'
            +'            <option value="">(none)</option>'
            +'            <option value="text">Text Input</option>'
            +'            <option value="single_select">Dropdown Single Select</option>'
            +'            <option value="radio">Radio</option>'
            +'        </select>'
            +'        <div class="col-sm-12 options">'
            +'          <input type="hidden" name="op_set'+co+'[]" value="none" >'
            +'        </div>'
            +'    </div>'
            +'    <input type="hidden" name="op_no[]" value="'+co+'" >'
            +'    <div class="col-sm-2">'
            +'        <span class="remove_it_o rmo btn btn-danger btn-icon btn-circle icon-lg fa fa-times" onclick="delete_row(this)"></span>'
            +'    </div>'
            +'</div>'
        );
        set_select();
    });
    
    $("#more_additional_options").on('change','.op_type',function(){
        var co = $(this).closest('.form-group').data('no');
        if($(this).val() !== 'text' && $(this).val() !== ''){
            $(this).closest('div').find(".options").html(''
                +'    <div class="col-sm-12">'
                +'        <div class="col-sm-12 options margin-bottom-10"></div><br>'
                +'        <div class="btn btn-mint btn-labeled fa fa-plus pull-right add_op">'
                +'        <?php echo translate('add_options_for_choice');?></div>'
                +'    </div>'
            );
        } else if ($(this).val() == 'text' || $(this).val() == ''){
            $(this).closest('div').find(".options").html(''
                +'    <input type="hidden" name="op_set'+co+'[]" value="none" >'
            );
        }
    });
    
    $("#more_additional_options").on('click','.add_op',function(){
        var co = $(this).closest('.form-group').data('no');
        $(this).closest('.col-sm-12').find(".options").append(''
            +'    <div>'
            +'        <div class="col-sm-10">'
            +'          <input type="text" name="op_set'+co+'[]" class="form-control required"  placeholder="<?php echo translate('option_name'); ?>">'
            +'        </div>'
            +'        <div class="col-sm-2">'
            +'          <span class="remove_it_n rmon btn btn-danger btn-icon btn-circle icon-sm fa fa-times" onclick="delete_row(this)"></span>'
            +'        </div>'
            +'    </div>'
        );
    });
    
    $('body').on('click', '.rmo', function(){
        $(this).parent().parent().remove();
    });

    $('body').on('click', '.rmon', function(){
        var co = $(this).closest('.form-group').data('no');
        $(this).parent().parent().remove();
        if($(this).parent().parent().parent().html() == ''){
            $(this).parent().parent().parent().html(''
                +'   <input type="hidden" name="op_set'+co+'[]" value="none" >'
            );
        }
    });

    $('body').on('click', '.rms', function(){
        $(this).parent().parent().remove();
    });

    $("#more_color_btn").click(function(){
        $("#more_colors").append(''
            +'      <div class="col-md-12" style="margin-bottom:8px;">'
            +'          <div class="col-md-10">'
            +'              <div class="input-group demo2">'
			+'		     	   <input type="text" value="" name="color[]" class="form-control" />'
			+'		        </div>'
            +'          </div>'
            +'          <span class="col-md-2">'
            +'              <span class="remove_it_v rmc btn btn-danger btn-icon icon-lg fa fa-trash" ></span>'
            +'          </span>'
            +'      </div>'
  		);
// 		createColorpickers();
    });		           

    $('body').on('click', '.rmc', function(){
        $(this).parent().parent().remove();
    });


	$(document).ready(function() {
		$("form").submit(function(e){
			event.preventDefault();
		});
	});
</script>

<style>
	.btm_border{
		border-bottom: 1px solid #ebebeb;
		padding-bottom: 15px;	
	}
</style>


<!--Bootstrap Tags Input [ OPTIONAL ]-->

