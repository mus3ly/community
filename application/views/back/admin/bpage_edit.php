
<style>
    .fa-brands{color: white;font-size: 12px;border-radius: 70%;padding: 10px;margin-top: -8px;}
    .fa-facebook-f{padding: 10px 12px;background-color:#3b5998;}
	.fa-twitter{background-color:#55acee;}
	.fa-google{background-color:#dc4e41}
	.fa-linkedin-in{background-color:#0C63BC;}
    #mainnav-container{
        left :0px !important;
    }
    .gallary_images{}
    .gallary_images ul{
        list-style: none;
        display: inline-block;
    }
    .gallary_images ul li{
        display: inline-block;
    }
  .feature_single{
    width: 100%;
    overflow:hidden;
  }
    .del_icon
    {
    position: absolute;
    font-size: large;
    color: red
    }
    .del_icon i{
        float: right;
    }
    .gallary_images ul li img{}
.btn1{
    
    outline: 0!important;
    border: none;
    background: transparent;
}
btn1 .fa{
    font-size: 25px;
    color: #cecece;
}
.form h4{
    font-size:14px;
}
.form .btn{
    background-color: white;
    border: 1px dashed #cecece;
}
.drop_box {
  margin: 10px 0;
  padding: 30px;
  display: flex;
  background-color: #ededed;
  align-items: center;
  justify-content: center;
  flex-direction: column;
  border: 2px dashed #cecece;
  border-radius: 5px;
  width:150px;
}
.flip-card > .active, .flip-card-front:hover,.flip-card-front:focus{
    background-color:#fecb00;
}
.flip-card-inner .active{
        background-color:#fecb00;
}
.form input {
  margin: 10px 0;
  width: 100%;
  background-color: #e2e2e2;
  border: none;
  outline: none;
  padding: 12px 20px;
  border-radius: 4px;
}
.flip-card {
  background-color: transparent;
  width: 300px;
    height: 110px;
        margin: 10px 0;
  perspective: 1000px;
}

.flip-card-inner {
  position: relative;
  width: 100%;
  height: 100%;
  text-align: center;
  transition: transform 0.6s;
  transform-style: preserve-3d;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
}

.flip-card:hover .flip-card-inner {
  transform: rotateX(180deg);
}

.flip-card-front, .flip-card-back {
  position: absolute;
  width: 100%;
  height: 100%;
  -webkit-backface-visibility: hidden;
  backface-visibility: hidden;
}
.flip-card-back p{
      padding: 50px 0 50px;
}
.flip-card-front i{
    font-size: 25px;
    padding: 8px 9px;
    margin-top: 25px;
    border-radius: 40px;
}

.flip-card-back {
  background-color: black;
  color: white;
  transform: rotateX(180deg);
}
</style>

<div class="row" style="margin-right:20px;">
    <div class="col-md-12" style="border-bottom: 1px solid #ebebeb;padding: 5px;     margin-top:64px;">
                            <button class="btn btn-primary btn-labeled fa fa-plus-circle add_pro_btn pull-right" onclick="ajax_set_full('add','Add Product','Successfully Added!','product_add',''); proceed('to_list');" style="display: none;">Create Product                            </button>
                            <a href="<?= base_url('/vendor/product'); ?>" class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn" style="" onclick="ajax_set_list();  proceed('to_add');">Back To Product List                            </a>
                        </div>
    <div class="col-md-10"  style="margin-top: 52px;    margin-left: 244px;
">

        <?php
            echo form_open(base_url() . 'vendor/product/update/'.$row['product_id'], array(
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
                            <a data-toggle="tab" href="#top_banner"><?php echo translate('top_bannner'); ?></a>
                        </li>

                        <li >
                            <a data-toggle="tab" href="#first_section"><?php echo translate('Desciptive_section'); ?></a>
                        </li>

                        <li >
                            <a data-toggle="tab" href="#event_images"><?php echo translate('images_gallary'); ?></a>
                        </li>
                        </li>

                        <li >
                            <a data-toggle="tab" href="#text_gallary"><?php echo translate('text_gallary'); ?></a>
                        </li>
<!-- 
                        <li >
                            <a data-toggle="tab" href="#general"><?php echo translate('general'); ?></a>
                        </li> -->
                        <li >
                            <a data-toggle="tab" href="#location"><?php echo translate('contact'); ?></a>
                        </li>
                        <li >
                            <a data-toggle="tab" href="#info_section"><?php echo translate('More_Info'); ?></a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#seo_section"><?php echo translate('SEO'); ?></a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#social_media"><?php echo translate('Social_media_Links'); ?></a>
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
                            foreach($brands as $k=>$v){
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
                                <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('business_title');?></label>
                                <div class="col-sm-6">
                                    <input type="text" name="title" id="demo-hor-1" value="<?php echo $row['title']; ?>" placeholder="<?php echo translate('business_title');?>" class="form-control required">
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
                                            <input type="file" name="sideimg" id="gimgs" onchange="preview2(this);" id="demo-hor-inputpass" class="form-control">
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
                                    <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('slogan');?></label>
                                    <div class="col-sm-6">
                                        <input type="text" name="slogan" id="demo-hor-1" value="<?php echo $row['slogan']; ?>" placeholder="<?php echo translate('slogan');?>" class="form-control ">
                                    </div>
                                </div>

                                <div class="form-group btm_border">
                                    <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('main_heading');?></label>
                                    <div class="col-sm-6">
                                        <input type="text" name="main_heading" id="demo-hor-1" value="<?php echo $row['main_heading']; ?>" placeholder="<?php echo translate('main_heading');?>" class="form-control required">
                                    </div>
                                </div>
                                <div class="form-group btm_border">
                                <label class="col-sm-4 control-label" for="demo-hor-13"><?php echo translate('description'); ?></label>
                                <div class="col-sm-6">
                                    <textarea rows="9" name="description"  class="summernotes" data-height="200" data-name="description"><?php echo $row['description']; ?></textarea>
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
                                                        <input type="text" class="form-control" value="<?= $value['fhead'] ?>" name="feature[0][fhead]" style="width:45%;float:left;" placeholder="Heading" />
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
                                                        <button style="width:4px;" class="btn btn-success" onclick="add_btn()" >+</button>
                                                    </div>
                                                    <?php
                                                }
                                                else{
                                                    ?>
                                                    <div class="feature_single"  id="bid_<?= $key ?>">
                                                        <input type="text" class="form-control" value="<?= $value['txt'] ?>" name="buttons[<?= $key ?>][txt]" style="width:45%;float:left;" placeholder="Heading" />
                                                        <input type="text" class="form-control" value="<?= $value['url'] ?>" name="buttons[<?= $key ?>][url]" style="width:45%;float:left;" placeholder="Url" />     
                                                        <button style="width:4px;" class="btn btn-danger" onclick="remove_btn('<?= $key; ?>')" >-</button>
                                                    </div>
                                              
                                                    <?php
                                                }
                                            }
                                        }
                                        else
                                        {?>
                                        <div class="feature_single" >
                                            <input type="text" class="form-control" name="feature[0][txt]" style="width:45%;float:left;" placeholder="Text" />
                                            <input type="text" class="form-control" name="feature[0][url]" style="width:45%;float:left;" placeholder="Url" />
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
                        <div id="social_media" class="tab-pane fade ">
                        <div class="form-group btm_border">
                                <div class="col-sm-4"></div>
                                <div class="col-sm-8"><small>*<?php echo translate('Enter link of your Facebook page')?></small></div>
                                <div class="col-sm-4 control-label" for="">
                                    <i class="fa-brands fa-facebook-f"></i>
                                    </div>
                                <div class="col-sm-6">
                                    <input type="text" name="facebook" value="<?php echo $row['facbook']; ?>"
                                           class="form-control ">
                                </div>
                                <div class="col-sm-2"></div>
                            </div>
                            <div class="form-group btm_border">
                                <div class="col-sm-4"></div>
                                <div class="col-sm-8"><small>*<?php echo translate('Enter link of your Twitter page')?></small></div>
                                <div class="col-sm-4 control-label" for="">
                                    <i class="fa-brands fa-twitter"></i>
                                    </div>
                                <div class="col-sm-6">
                                    <input type="text" name="twitter" value="<?php echo $row['twitter']; ?>"
                                           class="form-control ">
                                </div>
                                <div class="col-sm-2"></div>
                            </div>
                            <div class="form-group btm_border">
                                <div class="col-sm-4"></div>
                                <div class="col-sm-8"><small>*<?php echo translate('Enter link of your Google')?></small></div>
                                <div class="col-sm-4 control-label" for="">
                                    <i class="fa-brands fa-google"></i>
                                    </div>
                                <div class="col-sm-6">
                                    <input type="text" name="google" value="<?php echo $row['google']; ?>"
                                           class="form-control ">
                                </div>
                                <div class="col-sm-2"></div>
                            </div>
                            <div class="form-group btm_border">
                                <div class="col-sm-4"></div>
                                <div class="col-sm-8"><small>*<?php echo translate('Enter link of your LinkedIn')?></small></div>
                                <div class="col-sm-4 control-label" for="">
                                    <i class="fa-brands fa-linkedin-in"></i>
                                    </div>
                                <div class="col-sm-6">
                                    <input type="text" name="linkedin" value="<?php echo $row['linkedin']; ?>"
                                           class="form-control ">
                                </div>
                                <div class="col-sm-2"></div>
                            </div>

                        </div>
                        <div id="info_section" class="tab-pane fade ">
                        <div class="form-group btm_border">
                                    <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('info_heading');?></label>
                                    <div class="col-sm-6">
                                        <input type="text" name="info_head" id="demo-hor-1" value="<?php echo $row['info_head']; ?>" placeholder="<?php echo translate('main_heading');?>" class="form-control required">
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
                        <div id="location" class="tab-pane fade ">
                        <input id="searchTextField" type="text" size="50" placeholder="Enter a location" autocomplete="on" runat="server" / style="height: 40px;margin-bottom: 10px;border: 1px solid;border-radius: 7px;padding: 10px;">
                            
                            <div id="googleMap" style="width:100%;height:400px;"></div>
                                                        
                                <div class="row" style="font-size: 16px;margin-top: 22px;">
                                     <div class="col-md-4"><p>Or Enter Cordinates</p></div>
                                     <div class="col-md-4"><label>Latitude:</label>
                                    <input type="text" id="cityLat" value="<?= $row['lat']; ?>" name="lat" / style="border: 1px solid;border-radius: 7px;padding: 5px;"></div>
                                     <div class="col-md-4">
                                          <label>Longitude:</label>
                                <input type="text" id="cityLng" value="<?= $row['lng']; ?>" name="lng" / style="border: 1px solid;border-radius: 7px;padding: 5px;">
                                     </div>
                                 </div>
                        </div>
                        <div id="event_images" class="tab-pane fade ">
                        <div class="form-group btm_border">
                                <h4 class="text-thin text-center"><?php echo translate('gallary_images'); ?></h4>                            
                            </div>
                            <div class="form-group btm_border">
                                <label class="col-sm-4 control-label" for="demo-hor-12"><?php echo translate('images');?></label>
                                <div class="col-sm-6">
                                    <span class="pull-left btn btn-default btn-file" id="gimgs_txt"> <?php echo translate('choose_file');?>
                                        <input type="file" name="images[]" onchange="preview(this);" id="gimgs" class="form-control">
                                    </span>
                                    <br><br>
                                    <span id="previewImg" ></span>
                                    <br><br>
                                    <div class="gallary_images">
                                        <ul>
                                        <?php
                                        $this->db->order_by("id", "desc");
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
                        </div>
                        <div id="text_gallary" class="tab-pane fade ">text_gallary</div>
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
                    </div>
                </div>
        
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
                    console.log(e.target.result);
                    upload_img(e.target.result);
                    // $("#previewImg").append("<div style='float:left;border:4px solid #303641;padding:5px;margin:5px;'><img height='80' src='" + e.target.result + "'></div>");
                }
            });
            
            
        }
    }
    function setCookie(name,value,days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days*24*60*60*1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "")  + expires + "; path=/";
}
function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}


// var userEmail=getCookie("user_email");//"bobthegreat@gmail.com"

    function upload_img(img){
        var old_txt = $('#gimgs_txt').text();

        // $('#gimgs_txt').text('Uploading ...');
        var settings = {
  "url": "https://ads.strokedev.net/vendor/gupload",
  "method": "POST",
  "timeout": 0,
  "headers": {
    "Content-Type": "application/x-www-form-urlencoded"
  },
  "data": {
    "img": img,
    "pid": "<?= $row['product_id'] ?>"
  }
};
var imgUrl = '<?= base_url(); ?>/vendor/product/rimg/<?= $row['product_id'] ?>';

$.ajax(settings).done(function (response) {
    // $('#gimgs_txt').text(old_txt);
    $('.gallary_images').load(imgUrl);
  console.log(response);
});

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
        
        // ajax_load(base_url+'vendor/product/sub_by_cat/'+id,'sub_cat','other');
    }
    function delimg(id){
        var mid = '#gimg_'+id;
        var url = base_url+'vendor/product/delimg/'+id+'?pid=<?= $row['product_id'] ?>';
        $.ajax({
        url: url,
        type: "get",
        async: true,
        data: { },
        success: function (data) {
            $('.gallary_images').html(data);
           
        },
        error: function (xhr, exception) {
            var msg = "";
            if (xhr.status === 0) {
                msg = "Not connect.\n Verify Network." + xhr.responseText;
            } else if (xhr.status == 404) {
                msg = "Requested page not found. [404]" + xhr.responseText;
            } else if (xhr.status == 500) {
                msg = "Internal Server Error [500]." +  xhr.responseText;
            } else if (exception === "parsererror") {
                msg = "Requested JSON parse failed.";
            } else if (exception === "timeout") {
                msg = "Time out error." + xhr.responseText;
            } else if (exception === "abort") {
                msg = "Ajax request aborted.";
            } else {
                msg = "Error:" + xhr.status + " " + xhr.responseText;
            }
           
        }
    }); 

        $(mid).remove();
    }
    function get_sub_res(id){}

    $(".unit").on('keyup',function(){
        $(".unit_set").html($(".unit").val());
    });

    function createColorpickers() {
    
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
        $('.nav-tabs li.active').next().find('a').click();                    
    }
    function previous_tab(){
        $('.nav-tabs li.active').prev().find('a').click();                     
    }
    
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
            +'                 <input type="text" value="#ccc" name="color[]" class="form-control" />'
            +'                 <span class="input-group-addon"><i></i></span>'
            +'              </div>'
            +'          </div>'
            +'          <span class="col-md-2">'
            +'              <span class="remove_it_v rmc btn btn-danger btn-icon icon-lg fa fa-trash" ></span>'
            +'          </span>'
            +'      </div>'
        );
        createColorpickers();
    });                

    $('body').on('click', '.rmc', function(){
        $(this).parent().parent().remove();
    });
    function load_map()
    {
            $('#googleMap').on('click',myMap);
    }


    $(document).ready(function() {

        $("form").submit(function(e){
            event.preventDefault();
        });
    });
    
    
  
let file;
var filename;
function selecttype(id)
{
    if($('#category').val())
    {
        var pre = $('#category').val()+','+id;
        // alert(pre);
        $('#category').val(pre);

    }
    else{
        $('#category').val(id);
    }
    var url  = base_url+'vendor/product/sub_by_cat/'+id;
        // alert(url);
    $.ajax({
  url: url,
  cache: false,
  success: function(html){
    if(html == '0')
    {
        next_tab();

    }
    else
    {
    $("#cat_res").html(html);
    }
  }
});

    // get_cat(id,this);
}


    function preview2(input) {
        // alert('preview2');
        if (input.files && input.files[0]) {
            $("#previewImg2").html('');
            $(input.files).each(function () {
                var reader = new FileReader();
                reader.readAsDataURL(this);
                reader.onload = function (e) {
                    $("#previewImg2").append("<div style='float:left;border:4px solid #303641;padding:5px;margin:5px;'><img width='500' src='" + e.target.result + "'></div>");
                }
            });
        }
    }

    function preview1(input) {
        // alert('preview2');
        if (input.files && input.files[0]) {
            $("#previewImg1").html('');
            $(input.files).each(function () {
                var reader = new FileReader();
                reader.readAsDataURL(this);
                reader.onload = function (e) {
                    $("#previewImg1").append("<div style='float:left;border:4px solid #303641;padding:5px;margin:5px;'><img height='80' src='" + e.target.result + "'></div>");
                }
            });
        }
    }
    function preview3(input) {
        if (input.files && input.files[0]) {
            $("#previewImg3").html('');
            $(input.files).each(function () {
                var reader = new FileReader();
                reader.readAsDataURL(this);
                reader.onload = function (e) {
                    $("#previewImg3").append("<div style='float:left;border:4px solid #303641;padding:5px;margin:5px;'><img height='80' src='" + e.target.result + "'></div>");
                }
            });
        }
    }
</script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=<?= $this->config->item('map_key'); ?>&libraries=places"></script>
    <script>
        var mylat = '';
        var marker;
        var map;
       function initialize() {
        var lat = '51.508742';
        var lng = '-0.120850';
        <?php
            if(!$row['lat'] || !$row['lng'])
            {
                ?>
                getLocation();
                <?php
            }
            else
            {
                ?>
                lat = '<?= $row['lat']; ?>';
        lng = '<?= $row['lng']; ?>';
                <?php
            }
        ?>
        
            var mapProp= {
  center:new google.maps.LatLng(lat,lng),
  zoom:12,
};
map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
          var input = document.getElementById('searchTextField');
          var autocomplete = new google.maps.places.Autocomplete(input);
            google.maps.event.addListener(autocomplete, 'place_changed', function () {
                var place = autocomplete.getPlace();
                // alert(place.name);
                document.getElementById('cityLat').value = place.geometry.location.lat();
                document.getElementById('cityLng').value = place.geometry.location.lng();
                    var latlng = new google.maps.LatLng(place.geometry.location.lat(), place.geometry.location.lng());
                    map.setCenter({lat:place.geometry.location.lat(), lng:place.geometry.location.lng()});


                marker.setPosition(latlng);
            });
               var myLatlng = new google.maps.LatLng(parseFloat(lat),parseFloat(lng));
        marker = new google.maps.Marker({
            position: myLatlng,
            map: map,
            title: 'Your position',
            draggable:true,
        });
  google.maps.event.addListener(marker, 'dragend', function() {
    var lat = marker.getPosition().lat(); 
          var lng = marker.getPosition().lng();
            jQuery('#cityLat').val(lat);
        jQuery('#cityLng').val(lng);
            // get_address(lat, lng);
  });
        }
        function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else { 
    alert("No location");
  }
}

function showPosition(position) {
    var latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
    map.setCenter({lat: position.coords.latitude, lng:position.coords.longitude});
    $('#cityLat').val(position.coords.latitude);
    $('#cityLng').val(position.coords.longitude);

                marker.setPosition(latlng);
}
        google.maps.event.addDomListener(window, 'load', initialize);
        var user_type = 'vendor';
    var module = 'product';
    var list_cont_func = 'list';
    var dlt_cont_func = 'delete';
    var feature = 0;
    <?php
    if($feature)
    {
        ?>
        feature = <?= count($feature) -1; ?>;
        <?php
    }
    ?>
    function remove_feature(item)
    {
        feature--;
        var mid =  '#fid_'+item;
        $(mid).remove();
    }
    function add_feature()
    {
        if(feature >= 4)
        {
            alert('You can add maximum 5 features');
        }
        else
        {

        feature = feature +1;
        var html = '<div class="feature_single" id="fid_'+ feature+'">';
        html += '<input type="text" class="form-control" name="feature['+feature+'][fhead]" style="width:45%;float:left;" placeholder="Heading" />';
        html += '<textarea class="form-control"  name="feature['+feature+'][fdet]" style="width:45%;float:left;" placeholder="Details"></textarea>';
        html += '<button style="width:4px;" class="btn btn-danger" onclick="remove_feature('+feature+')" >-</buuton>';
                                       html+= '</div>';
                                       $('#feature_div').append(html);
        }
    }
    var txt = 0;
    function remove_text(item)
    {
        txt--;
        var mid =  '#tid_'+item;
        $(mid).remove();
    }
    function add_text()
    {
        if(txt >= 7)
        {
            alert('You can add maximum 7 items');
        }
        else
        {

            txt = txt +1;
        var html = '<div class="feature_single" id="tid_'+ txt+'">';
        html += '<input type="text" class="form-control" name="text['+txt+'][fhead]" style="width:45%;float:left;" placeholder="Heading" />';
        html += '<textarea class="form-control"  name="text['+txt+'][fdet]" style="width:45%;float:left;" placeholder="Details"></textarea>';
        html += '<button style="width:4px;" class="btn btn-danger" onclick="remove_text('+txt+')" >-</buuton>';
                                       html+= '</div>';
                                       $('#text_div').append(html);
        }
    }
    var button = 0;
    <?php
    if($btns)
    {
        ?>
        button = <?= count($btns) -1; ?>;
        <?php
    }
    ?>
    function remove_btn(item)
    {
        button--;
        var mid =  '#bid_'+item;
        $(mid).remove();
    }
    function add_btn()
    {
        if(button >= 2)
        {
            alert('You can add maximum 3 buttons');
        }
        else
        {

            button = button +1;
        var html = '<div class="feature_single" id="bid_'+ button+'">';
        html += '<input type="text" class="form-control" name="buttons['+button+'][txt]" style="width:45%;float:left;" placeholder="Text" />';
        html += '<input type="text" class="form-control" name="buttons['+button+'][url]" style="width:45%;float:left;" placeholder="Url" />';
        html += '<button style="width:4px;" class="btn btn-danger" onclick="remove_btn('+button+')" >-</buuton>';
                                       html+= '</div>';
                                       $('#button_div').append(html);
        }
    }
    </script>


<style>
    .btm_border{
        border-bottom: 1px solid #ebebeb;
        padding-bottom: 15px;   
    }
</style>


<!--Bootstrap Tags Input [ OPTIONAL ]-->


