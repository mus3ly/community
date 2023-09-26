<?php
function bubbleSort($arr)
{
    $n = sizeof($arr);
  
    // Traverse through all array elements
    for($i = 0; $i < $n; $i++) 
    {
        // Last i elements are already in place
        for ($j = 0; $j < $n - $i - 1; $j++) 
        {
            // traverse the array from 0 to n-i-1
            // Swap if the element found is greater
            // than the next element
            if ($arr[$j]['sort'] > $arr[$j+1]['sort'])
            {
                $t = $arr[$j];
                $arr[$j] = $arr[$j+1];
                $arr[$j+1] = $t;
            }
        }
    }
    return $arr;
}
$row = (array)$product_data;
$all_op = json_decode($row['options'],true);
?>
<style>

#checkbox_information .form-group h5{
    color: white !important;
  
    text-align: center;
    background-color: #f36022;
    margin-left: 20%;
    margin-right: 20%;
    padding: 7px !important;
    border-radius: 10px;
}

.sec-heading{
    margin-left: 20%;
    margin-top: 30px;
    margin-right: 20%;
}

.sec-heading label{
    margin-bottom:10px;
    font-weight:bold;
}

.breaddcum{
    display:flex !important;
    justify-content:center !important;
}

#checkbox_information .col-sm-9{
        margin-left: 20%;
    padding: 0px;
    width:60%;

}

#checkbox_information .form-control{
    height:40px;
}


#checkbox_information .btn-labeled:not(.btn-block):not(.form-icon){
    padding-right:22px;
}

#checkbox_information .col-sm-12 {
        display: flex;
    justify-content: center;
    align-items: center;
}
 .pull-center {
  text-align: center !important;
    font-size: 15px;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
}

.pull-center i{
    margin-left: 14%;
}


@media(max-width:991px){
    #checkbox_information .form-group h5{

    margin-left: 00%;
    margin-right: 0%;
   
}

.sec-heading{
    margin-left: 0%;
    margin-top: 20px;
    margin-right: 0%;
}


.pull-center i{
    margin-left: 0%;
}
#checkbox_information .col-sm-9{
        margin-left: 10%;
    padding: 0px;
    width:90%;

}



}



 #select_amn2{
    display: flex;
}
#select_amn2 p{
 background-color: #F26122;
    padding: 9px;
    width: auto;
    margin: 2px;
    color: white;

}
    #mainnav-container{
        left :0px !important;
    }ima
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
  .error{
        border-color: red !important;

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
    #add_amn{
    max-height: 150px;
    min-width: 0px;
    overflow-y: scroll;
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

<div class="row">
    <div class="col-md-12 top_head">
                            <button class="btn btn-primary btn-labeled fa fa-plus-circle add_pro_btn pull-right" onclick="ajax_set_full('add','Add Product','Successfully Added!','product_add',''); " style="display: none;">Create Listings</button>
                            <?php
                            if(isset($mod_cat))
                            {
                                ?>
                                <a href="<?= base_url('/vendor/product'); ?>?module=<?= $mod->id ?>" class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn" style="" onclick="ajax_set_list();">Back To <?= $mod_cat->category_name  ?> List                            </a>
                            </a>
                                <?php
                            }
                            else
                            {
                                ?>
                                <a href="<?= base_url('/vendor/product'); ?>" class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn" style="" onclick="ajax_set_list();">Back To Product List                            </a>
                                <?php
                            }
                            ?>
                        </div>
    <div class="col-md-12 newsidebar">
        <?php
            echo form_open(base_url() . 'vendor/product/update/'.$row['product_id'], array(
                'class' => 'form-horizontal',
                'method' => 'post',
                'id' => 'product_add',
                'enctype' => 'multipart/form-data'
            ));
            $this->db->where_in('category',explode(',',$row['category']));
            $fil_col = $this->db->where('is_filter',1)->get('list_fields')->result_array();
            $rid = $row['product_id'];
            // var_dump($fil_col);
            foreach($fil_col as $k=> $v)
            {
                $dvalue = (isset($row[$v['tbl_col']])?$row[$v['tbl_col']]:$v['dvalue']) ;
                if($dvalue == 'cdate')
{
    $dvalue= formate_date(date('Y-m-d'));
}
                $col = $v['tbl_col'];
                ?>
                <input type="hidden" value="<?= $dvalue?>" name="<?= $v['tbl_col'] ?>" placeholder="<?= $v['label'] ?>" id="<?= $v['tbl_col'] ?>_col" />
                <?php
                
            }
        ?>
            <!--Panel heading-->
            <div class="row">
                <div class="col-sm-2 sidebar">
                    <div class="panel-heading">
                <div class="panel-control1">
                    <ul class="nav nav-tabs">
                       <?php
                        $this->db->order_by("sort", "asc");
                        $active_tab = 'customer_choice_options';

                        $tabs = $this->db->get('listing_tabs')->result_array();
                        if(isset($mod))
                        {
                            $tab = json_decode($mod->tabs,true);
                            $label = $tab['label'];
                            $sort = $tab['sort'];
                            foreach($tabs as $k=> $v)
                            {
                                $id = $v['id'];
                                if($sort[$id] == 0)
                                {
                                    unset($tabs[$k]);
                                }
                                $tabs[$k]['label'] = $label[$id];
                                $tabs[$k]['sort'] = $sort[$id];
                            }
                            
                        }
                        $ntabs = array();
                        
                        foreach($tabs as $k=> $v)
                        {
                            if($v['sort'])
                            {
                                $ntabs[]= $v;
                            }
                        }
                        $tabs = $ntabs;
                        $tabs = bubbleSort($tabs);
                        
                        if(isset($tabs[0]['key']))
                        {
                            $active_tab = $tabs[0]['key'];
                        }
                        foreach($tabs as $k=> $v)
                        {
                            if($v['sort'] != 0)
                            {
                            ?>
                            <li class="<?= (!$k)?"active":""; ?>"  onclick="go_tab('<?= $v['key'] ?>')">
                                <a data-toggle="tab" href="#<?= $v['key']; ?>"><?php echo $v['label']; ?></a>
                            </li>
                            <?php
                            }
                        }
                        ?>
                        
                    </ul>
                </div>
            </div>
                </div>

                <div class="col-sm-10 right_content_box">
                    <div class="panel-body">
                <div class="tab-base">
                    <!--Tabs Content-->                    
                    <div class="tab-content">
                       <div id="product_option" class="tab-pane fade <?= ($active_tab == 'product_option')?"active in":''; ?>">
                            
                            <div class="form-group btm_border">'
                                <label class="col-sm-2 control-label" for="demo-hor-15">
                                    <?php echo translate('product_color_options');?>
                                        </label>
                                    <div class="col-sm-6"  id="more_colors">
                                        <?php 
                                            if($all_c){
                                                foreach($all_c as $p){
                                        ?>
                                            <div class="col-md-12" style="margin-bottom:8px;">
                                                <div class="col-md-8">
                                                    <div class="input-group demo2">
                                                        <input type="text" value="<?php echo $p; ?>" name="color[]" class="form-control" />
                                                        <span class="input-group-addon"><i></i></span>
                                                    </div>
                                                </div>
                                                <span class="col-md-4">
                                                    <span class="remove_it_v rmc btn btn-danger btn-icon btn-circle icon-lg fa fa-times" ></span>
                                                </span>
                                            </div>
                                        <?php 
                                                }
                                            } 
                                        ?>
                                    </div>
                            </div>
                            
                            <div class="form-group btm_border">
                                <label class="col-sm-2 control-label" for="demo-hor-16"></label>
                                <div class="col-sm-6">
                                        <div id="more_color_btn" class="btn btn-primary btn-labeled fa fa-plus pull-right">
                                            <?php echo translate('add_colors');?></div>
                                </div>
                            </div>
                            <div id="more_additional_options">
                            <?php
                                $r = 0;
                                if(!empty($all_op)){
                                    foreach($all_op as $i=>$row1){
                                        $r = 1;
                            ?> 
                                <div class="form-group" data-no="<?php echo $row1['no']; ?>">
                                    <div class="col-sm-2">
                                        <input type="text" name="op_title[]" value="<?php echo $row1['title']; ?>" class="form-control required"  placeholder="<?php echo translate('customer_input_title'); ?>">
                                    </div>
                                    <div class="col-sm-5">
                                        <select class="demo-chosen-select op_type required" name="op_type[]" >
                                            <option value="" <?php if($row1['type'] == ''){ echo 'selected'; } ?> >(none)</option>
                                            <option value="text" <?php if($row1['type'] == 'text'){ echo 'selected'; } ?> >Text Input</option>
                                            <option value="single_select" <?php if($row1['type'] == 'single_select'){ echo 'selected'; } ?> >Dropdown Single Select</option>
                                            <option value="radio" <?php if($row1['type'] == 'radio'){ echo 'selected'; } ?> >Radio</option>
                                        </select>
                                        <div class="col-sm-12 options">
                                        <?php
                                            if($row1['type'] == 'text' || $row1['type'] == ''){
                                        ?>
                                            <input type="hidden" name="op_set<?php echo $row1['no']; ?>[]" value="none" >
                                        <?php
                                            } else {
                                        ?>
                                            <div class="col-sm-12">
                                                <div class="col-sm-12 options margin-bottom-10">
                                                <?php foreach ($row1['option'] as $key => $row2) { ?>
                                                    <div>
                                                        <div class="col-sm-10">
                                                          <input type="text" name="op_set<?php echo $row1['no']; ?>[]" value="<?php echo $row2; ?>" class="form-control required"  placeholder="<?php echo translate('option_name'); ?>">
                                                        </div>
                                                        <div class="col-sm-2">
                                                          <span class="remove_it_n rmon btn btn-danger btn-icon btn-circle icon-sm fa fa-times" onclick="delete_row(this)"></span>
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                                </div>
                                                <br>
                                                <div class="btn btn-mint btn-labeled fa fa-plus pull-right add_op">
                                                <?php echo translate('add_options_for_choice');?></div>
                                            </div>

                                        <?php
                                            }
                                        ?>
                                        </div>
                                    </div>
                                    <input type="hidden" name="op_no[]" value="<?php echo $row1['no']; ?>" >
                                    <div class="col-sm-2">
                                        <span class="remove_it_o rmo btn btn-danger btn-icon btn-circle icon-lg fa fa-times" onclick="delete_row(this)"></span>
                                    </div>
                                </div>
                            <?php
                                    }
                                }
                            ?> 
                            </div>
                            <div class="form-group btm_border">
                                <label class="col-sm-2 control-label" for="demo-hor-inputpass"></label>
                                <div class="col-sm-6">
                                    <h4 class="pull-left">
                                        <i><?php echo translate('if_you_need_more_choice_options_for_customers_of_this_product_,please_click_here.');?></i>
                                    </h4>
                                    <div id="more_option_btn" class="btn btn-mint btn-labeled fa fa-plus pull-right">
                                    <?php echo translate('add_customer_input_options');?></div>
                                </div>
                            </div>

                        </div>
                   <div id="customer_choice_options" class="tab-pane fade <?= ($active_tab == 'customer_choice_options')?"active in":''; ?>">
                        <input type="hidden" id="category" value="<?= ($row['category'])?$row['category']:""; ?>" name="category"/>
                           <div class="row" id="cat_res">
                                  <div class="breaddcum">
                    <ul>
                        <?php
                         $carr = explode(',',$row['category']);
                         $para2 = $carr[count($carr)-1];
                         $sing = $this->db->where('category_id',$para2)->get('category')->row();
                          $level = $sing->level;
       
            $breed = array();
            
            $cid = $para2;
            for ($i=1; $i <= $level; $i++) { 
             
                 $srow = $this->db->where('category_id',$cid)->get('category')->row_array();
               if(isset($srow) && !empty($srow)){
                   $breed[] = $cid;
                 $cid = $srow['pcat'];
                //  var_dump($cid);
               }
            }
            if($breed)
            {
                ?>
                <div class="breaddcum">
                    <ul>
                        <?php
                        $cat = array();
                        foreach(array_reverse($breed) as $k=> $v)
                        {
                            $cat[] = $v;
                            $crow = $this->db->where('category_id',$v)->get('category')->row();
                            ?>
                            <li><?= $crow->category_name;?></li>
                            <?php
                        }
                        ?>


                    </ul>
                </div>
                <?php
            }
            
            ?>
            


                    </ul>
                </div> 
                <span class="error">To change category of your ad, please delete current ad and recreate ad with new category listing



</span>
                                <div class="col-md-4 col-sm-12 col-xs-12"></div>
                                <div class="col-md-4 col-sm-12 col-xs-12"></div>
                            </div>
                        </div>
                        <div id="top_banner" class="tab-pane fade <?= ($active_tab == 'top_banner')?"active in":''; ?>">
                            <h4 class="text-thin text-center"><?php echo translate('top_banner'); ?></h4> 
                            <div class="form-group btm_border">
                            <div class="form-group btm_border">
                                <label class="col-sm-4 control-label" for="listing_title"><?php echo translate('listing_title');?></label>
                                <div class="col-sm-6">
                                    <input type="text" name="title" id="listing_title" value="<?php echo $row['title']; ?>" placeholder="<?php echo translate('listing_title');?>" class="form-control required">
                                </div>
                            </div>
                            <div class="form-group btm_border">
                                <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('catchphrase_or_slogan');?></label>
                                <div class="col-sm-6">
                                    <input type="text" name="slog" id="demo-hor-1" value="<?php echo $row['slog']; ?>" placeholder="<?php echo translate('catchphrase_or_slogan');?>" class="form-control required">
                                </div>
                            </div>
                            <div class="form-group btm_border">
                                <label class="col-sm-4 control-label" for="demo-hor-13"><?php echo translate('listing_detail'); ?></label>
                                <div class="col-sm-6">
                                    <textarea rows="9" name="description"   id="editor1" height="200" >
                                        <?php echo $row['description']; ?></textarea>
                                    <!--<textarea rows="9" name="description"  class="summernotes" id="summernotes" data-height="200" data-name="description"><?php echo $row['description']; ?></textarea>-->
                                </div>
                                </div>
                                <?php
                                if(isset($mod->store_check) && $mod->store_check)
                                {
                                    ?>

                            <div class="form-group btm_border">
                                <label class="col-sm-4 control-label" for="demo-hor-13"><?php echo translate('Specification'); ?></label>
                                <div class="col-sm-6">
                                    <textarea rows="9" class="form-control" name="specification"   id="editor2" height="200" ><?php echo $row['specification']; ?></textarea>
                                    <!--<textarea rows="9" name="description"  class="summernotes" id="summernotes" data-height="200" data-name="description"><?php echo $row['description']; ?></textarea>-->
                                </div>
                                </div>

                            <div class="form-group btm_border">
                                <label class="col-sm-4 control-label" for="demo-hor-13"><?php echo translate('Warranty_info'); ?></label>
                                <div class="col-sm-6">
                                    <textarea rows="9" class="form-control" name="warranty_info"   id="editor3" height="200" ><?php echo $row['warranty_info']; ?></textarea>
                                    <!--<textarea rows="9" name="description"  class="summernotes" id="summernotes" data-height="200" data-name="description"><?php echo $row['description']; ?></textarea>-->
                                </div>
                                </div>

                            <div class="form-group btm_border">
                                <label class="col-sm-4 control-label" for="demo-hor-13"><?php echo translate('Shipping_info'); ?></label>
                                <div class="col-sm-6">
                                    <textarea rows="9" class="form-control" name="shipping_info"   id="editor4" height="200" ><?php echo $row['shipping_info']; ?></textarea>
                                    <!--<textarea rows="9" name="description"  class="summernotes" id="summernotes" data-height="200" data-name="description"><?php echo $row['description']; ?></textarea>-->
                                </div>
                                </div>

                            <div class="form-group btm_border">
                                <label class="col-sm-4 control-label" for="demo-hor-13"><?php echo translate('seller_profile'); ?></label>
                                <div class="col-sm-6">
                                    <textarea rows="9" class="form-control" name="seller_profile"   id="editor5" height="200" ><?php echo $row['seller_profile']; ?></textarea>
                                    <!--<textarea rows="9" name="description"  class="summernotes" id="summernotes" data-height="200" data-name="description"><?php echo $row['description']; ?></textarea>-->
                                </div>
                                </div>

                                    <?php
                                }

                                ?>
                                <div class="form-group btm_border">
                                <label class="col-sm-4 control-label" for="demo-hor-11"><?php echo translate('eller_profile');?></label>
                                <div class="col-sm-6">
                                    <input type="text" name="tag" value="<?= $row['tag']; ?>" data-role="tagsinput" placeholder="<?php echo translate('enter comma (,) to add more');?>" class="form-control">
                                </div>
                            </div>
                            <?php
                            if(isset($mod) && $mod->is_address)
                            {
                            ?>
                            <div class="form-group btm_border">
                                <label class="col-sm-4 control-label" for="demo-hor-6"><?php echo translate('address');?></label>
                                <div class="col-sm-4">
                                    <select class="form-control required" name= "warehouse">
                                        <?php
                                        foreach($warehouse as $k => $v){
                                        ?>
                                        <option value="<?= $v['address_id'];?>"><?= $v['title'];?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <p>You can add new warehouses by <a href="<?= base_url('/vendor/address'); ?>">Clicking here</a></p>
                                </div>
                            </div>
                            
                            <?php
                            }
                            ?>
                            <?php
                            if(isset($mod) && !$mod->hide_bus)
                            {
                            ?>
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
                              <div class="form-group btm_border">
                                <label class="col-sm-4 control-label" for="demo-hor-6"><?php echo translate('city');?></label>
                                <div class="col-sm-4">
                                    <input type="text" name="city" id="demo-hor-6" min='0' step='.01' placeholder="<?php echo translate('city');?>" value="<?= $row['city'] ?>" class="form-control required">
                                </div>
                            </div>
                            <div class="form-group btm_border">
                                <label class="col-sm-4 control-label" for="demo-hor-6"><?php echo translate('address');?></label>
                                <div class="col-sm-4">
                                    <select class="form-control" name= "warehouse">
                                        <?php
                                        foreach($warehouse as $k => $v){
                                        ?>
                                        <option value="<?= $v['address_id'];?>"><?= $v['title'];?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <?php
                            }//hide bus details
                            ?>
                            
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
                            
                            <?php
                            if(isset($mod)&& $mod->img_detail)
                            {
                                ?>
                             <div class="form-group btm_border">
                                <label class="col-sm-4 control-label" for="demo-hor-6"><?php echo translate('uper_text');?></label>
                                <div class="col-sm-4">
                                    <input class="form-control"  value="<?= $row['uper_text'] ?>" name= "uper_text" />
                                </div>
                            </div>
                            <?php
                            }
                            ?>
                                <div class="form-group btm_border">
                                    <label class="col-sm-4 control-label" for="demo-hor-12">Cover Image</label>
                                    <div class="col-sm-6">
                                        <span class="pull-left btn btn-default btn-file"> <?php echo translate('choose_file');?>
                                            <input type="file" name="sideimg" onchange="preview2(this);" id="demo-hor-inputpass" class="form-control <?= (empty($row['comp_cover']))?"required":""; ?>">
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
                                        <?php
                            if(isset($mod)&& $mod->img_detail)
                            {
                                ?>
                             <div class="form-group btm_border">
                                <label class="col-sm-4 control-label" for="demo-hor-6"><?php echo translate('down_text');?></label>
                                <div class="col-sm-4">
                                    <input class="form-control" value="<?= $row['down_text'] ?>" name= "down_text" />
                                </div>
                            </div>
                            <?php
                            }
                            ?>
                        
                        </div>
                        <div id="first_section" class="tab-pane fade <?= ($active_tab == 'first_section')?"active in":''; ?>">
                                
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
                                        <input type="text" name="discip_heading" id="demo-hor-1" value="<?php echo $row['discip_heading']; ?>" placeholder="<?php echo translate('discip_heading');?>" class="form-control">
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
                        <div id="text_gallary" class="tab-pane fade <?= ($active_tab == 'text_gallary')?"active in":''; ?>">
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
                   <div id="custom_attributes_0" class="tab-pane fade <?= ($active_tab == 'custom_attributes_0')?"active in":''; ?>">
                        <div class="form-group btn_border">
                            <h5 style="color: red;padding: 0 89px;">If more than 30 characters, it will be added to the accordion section</h5>
                        </div>
                      <div class="form-group btm_border">
                          <?php
                          if(isset($row['additional_fields'])){
                        //   $attr = $row['additional_fields'];
                        //   $exp = (explode(",",$attr));
                        //   var_dump($exp);
                        $exp = json_decode($row['additional_fields']);
                        $ex = json_decode($exp->name);
                        $values = json_decode($exp->value);
                        
                          foreach($ex as $k => $v){
                              
                          ?>
                                              <div class="form-group">
                                 <div class="col-sm-4">
                                 <input type="text" name="ad_field_names[]" class="form-control required" readonly="true" value="<?= $v?>"  placeholder="<?php echo translate('field_name'); ?>">
                                 </div>
                                 <div class="col-sm-5">
                                 <?php
                                 $s = $this->db->where('label',trim($v))->get('list_fields')->row();
                                 if($s)
                                 {
                                     $s->val = $values[$k];
                                 $this->load->view('vedit_f',$s);
                                 }
                                 else
                                 {
                                     ?>
                                 <input type="text" rows="9"  class="form-control" data-height="100" name="ad_field_values[]" value="<?= $values[$k]; ?>">
                                 <?php
                                 }
                                 ?>
                                </div>
                                <?php
                                if(!empty($s) && $s->is_required == NULL)
                                {
                                ?>
                                <div class="col-sm-2">
                                <span class="remove_it_v rms btn btn-danger btn-icon btn-circle icon-lg fa fa-times" onclick="delete_row(this)"></span>
                                </div>
                                <?php
                                }
                                ?>
                                </div>
                                <?php
                                              }
                                              }
                                ?>
                                <div id="more_additional_fields"></div>
                                <div class="col-sm-12">
                                    <h4 class="pull-left">
                                        <i><?php echo translate('if_you_need_more_field_for_your_product_,_please_click_here_for_more...');?></i>
                                    </h4>
                                       <div id="more_btn" class="btn btn-mint btn-labeled fa fa-plus pull-right">
                                    <?php echo translate('add_more_fields');?></div>
                                </div>
                                 
                            </div>
                             
                        </div>
                           <div id="checkbox_information" class="tab-pane fade <?= ($active_tab == 'checkbox_information')?"active in":''; ?>">
                                 <div class="form-group btn_border">
                            <h5 style="color: red;padding: 0 89px;">Do not exceed more than 30 characters per entry</h5>
                            <div class="sec-heading">
                                <label>Section Heading</label>  
                                <input class="form-control" name="checkbox_h" value="<?= $row['checkbox_h'] ?>" />
                            </div>
                        </div>
                      <div class="form-group btm_border">
                          <?php
                          if(isset($row['checkbox_xtra_fields']) && !empty($row['checkbox_xtra_fields'])){
                            $x = json_decode($row['checkbox_xtra_fields']);
                            // var_dump($x);
                            foreach( $x as $k => $v){
                          ?>
                          <div class="form-group"> 
                           
                          <div class="col-sm-9 more-data-field">
                            <input type="text" name="checkboxinfo[]" class="moredata form-control" value="<?= $v; ?>" placeholder="Field Name">  
                            </div>
                            
                            <div class="col-sm-2">  
                            <span class="remove_it_v rms btn btn-danger btn-icon btn-circle icon-lg fa fa-times" onclick="delete_row(this)"></span>
                            </div>
                            </div>
                            <?php
                            }
                          }else{
                            ?>
                            <div class="form-group"> 
                          <div class="col-sm-9">    
                            <input type="text" name="checkboxinfo[]" class=" moredata form-control " placeholder="Field Name">    
                            </div>   
                            <div class="col-sm-2">  
                            </div>
                            </div>
                            <?php
                                 }
                            ?>
                         <div id="more_checkbox_fields"></div>                                
                                <div class="col-sm-12">
                                    <h4 class="pull-left pull-center">
                                        <i><?php echo translate('if_you_need_more_field_for_your_product_,_please_click_here_for_more...');?></i>
                                    </h4>
                                    <div id="more_field_btn" class="moredata btn btn-mint btn-labeled fa fa-plus pull-right">
                                    <?php echo translate('add_more_fields');?></div>
                                </div>
                            </div>
                            
                        </div>
                        <div id="amenitys" class="tab-pane fade <?= ($active_tab == 'amenitys')?"active in":''; ?>">
                              <div class="form-group btm_border" >
                                <label class="col-sm-4 control-label" for="demo-hor-11"><?php echo translate('Add_Amenities');?></label>
                                <div class="col-sm-6 adding_position">
                                    <input type="checkbox" name="checkamenities" value="yes" class="" id="amen_check" <?= isset($row['amen_check']) && 
                                    $row['amen_check'] == 'yes' ?'checked':'';
                                    ?>>
                                </div>
                     <div class="form-group btm_border">
                                    <label class="col-sm-4 control-label" for="demo-hor-1">Select Amenities</label>
                                    <div class="col-sm-6">
                                     <div class="row">                                           
                                     <div class="col-md-10 padding_none">                                           
                             <input type="text" class="amnty form-control" id="amnty">
                             </div>
                               <div class="col-md-2 padding_none">                                           
                             <button type="button" class="btn btn-primary" id="amn_btn">Add</button>
                             </div>
                             </div>
                            <div id="add_amn">
                                
                            </div>
                            <hr>
                          
                            <div id="select_amn2">
                                
                        </div>
                               
                            <div class="select_amn" style="display: none;">
                                <?php $exp =  explode(',',$row['amenities']); 
                                foreach($exp as $k=> $v)
                                {
                                    ?>
                                <input type="text"  id="amv_<?= $k ?>" name="amenities[]" value="<?= $v ?>">
                                <?php
                                }
                                
                                ?>
                                
                            </div>
                             
                          </div>
                                </div>
                            </div>
                        </div>
                        <div id="custom_attributes_1" class="tab-pane fade <?= ($active_tab == 'custom_attributes_1')?"active in":''; ?>">
                            <div>
                                <labe>Section Heading</label>
                                <input class="form-control" name="accor_h"  value="<?= $row['accor_h'] ?>" />
                            </div>
                            <?php
                            $acc = $this->db->where('pid',$row['product_id'])->get('product_to_accordion')->result_array();
                                if($acc){
                                    foreach($acc as $k => $v){
                                        ?>
                                    <div class="form-group">
                                        <div class="col-sm-4">
                                            <input type="text" name="ad_field_names_custom[]" class="form-control required"  placeholder="<?php echo translate('field_name'); ?>" value="<?= $v['title']?>">
                                        </div>
                                        <div class="col-sm-5">
                                            <textarea rows="9"  class="summernotes" data-height="100" data-name="ad_field_values_custom[]"><?= $v['detail']; ?></textarea>
                                        </div>
                                
                                    </div>
                                <?php
                                    }
                                    }else{
                                ?>
                        <div class="form-group">
                         <div class="col-sm-4">
                        <input type="text" name="ad_field_names_custom[]" class="form-control required"  placeholder="<?php echo translate('field_name'); ?>" value="<?php echo translate('requirements'); ?>">
                        </div>
                        <div class="col-sm-5">
                         <textarea rows="9"  class="summernotes" data-height="100" data-name="ad_field_values_custom[]" ></textarea>
                            </div>
                    
                        </div>
                        <div class="form-group">
                         <div class="col-sm-4">
                        <input type="text" name="ad_field_names_custom[]" class="form-control required"  placeholder="<?php echo translate('field_name'); ?>" value="<?php echo translate('benefits'); ?>">
                        </div>
                        <div class="col-sm-5">
                         <textarea rows="9"  class="summernotes" data-height="100" data-name="ad_field_values_custom[]" ></textarea>
                            </div>
                    
                        </div>
                        <?php
                                    }
                        ?>
                        <div id="more_fields"></div>
                         <div id="more_btn_attr" class="btn btn-mint btn-labeled fa fa-plus pull-right">
                                    <?php echo translate('add_more_fields');?>
                        </div>    
                        </div>
                             
                        <div id="seo_section" class="tab-pane fade <?= ($active_tab == 'seo_section')?"active in":''; ?>">
                            <div class="form-group btm_border">
                                <div class="col-sm-4"></div>
                                <div class="col-sm-8"></div>
                                <label class="col-sm-4 control-label" for="">
                                    <?php echo translate('slug');?>
                                </label>
                                <div class="col-sm-6">
                                    <input type="text" id="slug" name="slug" value="<?php echo $row['slug']; ?>"
                                           placeholder="<?php echo translate('productslug')?>"
                                           class="form-control required">
                                           <small id="slug_error_msg" style="display:none;color:red">Slug already exists, choose the new and unique one..</small>
                                </div>
                                <div class="col-sm-2"></div>
                            </div>
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
                        <div id="location" class="tab-pane fade <?= ($active_tab == 'location')?"active in":''; ?>">
                        <input  style="width: 186px;
    padding: 0 16px;
    height: 34px;
    border: 2px solid #ccc;
    margin: 0 0 13px;"  id="searchTextField" type="text" size="50" placeholder="Enter a location" autocomplete="on" runat="server" />
                            
                            <div id="googleMap" style="margin:0 0 20px;width:95%;height:400px;"></div>
                                                        
                                Or Enter Cordinates
                                        <div>
                                    <label  style="margin:15px 0 0;display:block;">Latitude</label>
                                    <input style="    width: 186px;
    padding: 0 16px;
    height: 34px;
    border: 2px solid #ccc;
    margin: 0 0 13px;" type="text" id="cityLat" value="<?= $row['lat']; ?>" name="lat" />
                             </div>
                            <div>
                                <label  style="margin:0 0 0;display:block;">Longitude</label>
                                <input style="    width: 186px;
    padding: 0 16px;
    height: 34px;
    border: 2px solid #ccc;
    margin: 0 0 13px;" type="text" id="cityLng" value="<?= $row['lng']; ?>" name="lng" />
                            </div>
                        </div>
                        <div id="event_images" class="tab-pane fade <?= ($active_tab == 'event_images')?"active in":''; ?>">
                        <div class="form-group btm_border">
                                <h4 class="text-thin text-center"><?php echo translate('gallary_images'); ?></h4>                            
                            </div>
                            <div class="form-group btm_border">
                                <label class="col-sm-4 control-label" for="demo-hor-12"><?php echo translate('images');?></label>
                                <div class="col-sm-6">
                                    <span class="pull-left btn btn-default btn-file"> <?php echo translate('choose_file');?>
                                        <input type="file" multiple name="images[]" onchange="preview(this);" id="demo-hor-inputpass" class="form-control">
                                    </span>
                                    <img id="show_hide_loader" style="display:none;" src="<?=base_url()?>map-loader.gif">
                                    <style>
                                        #show_hide_loader{
                                                width: 45px;
                                                position: absolute;
                                                top: -15px;
                                                left:100px;
                                            }
                                    </style>
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
                        <div id="event_images" class="tab-pane fade <?= ($active_tab == 'event_images')?"active in":''; ?>">
        
                            

                            <div class="form-group btm_border">
                                <label class="col-sm-4 control-label" for="demo-hor-13"></label>
                                <div class="col-sm-6">
                                    <?php 
                                        $images = $this->crud_model->file_view('product',$row['product_id'],'','','thumb','src','multi','all');
                                        // var_dump();
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
                        <span class="btn btn-success btn-md btn-labeled fa fa-upload pull-right enterer" id="registerbutton" onclick="textarea();validate_listing();" ><?php echo translate('upload');?></span>
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
            // This sample still does not showcase all CKEditor 5 features (!)
            // Visit https://ckeditor.com/docs/ckeditor5/latest/features/index.html to browse all the features.
            var editor1;
            CKEDITOR.ClassicEditor.create(document.getElementById("editor1"), {
                // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
                toolbar: {
                    items: [
                        'exportPDF','exportWord', '|',
                        'findAndReplace', 'selectAll', '|',
                        'heading', '|',
                        'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript', 'removeFormat', '|',
                        'bulletedList', 'numberedList', 'todoList', '|',
                        'outdent', 'indent', '|',
                        'undo', 'redo',
                        '-',
                        'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                        'alignment', '|',
                        'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', 'htmlEmbed', '|',
                        'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                        'textPartLanguage', '|',
                        'sourceEditing'
                    ],
                    shouldNotGroupWhenFull: true
                },
                // Changing the language of the interface requires loading the language file using the <script> tag.
                // language: 'es',
                list: {
                    properties: {
                        styles: true,
                        startIndex: true,
                        reversed: true
                    }
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
                heading: {
                    options: [
                        { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                        { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                        { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                        { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                        { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                        { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                        { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
                    ]
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
                placeholder: 'Welcome to CKEditor 5!',
                name:'short_description',
                // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-family-feature
                fontFamily: {
                    options: [
                        'default',
                        'Arial, Helvetica, sans-serif',
                        'Courier New, Courier, monospace',
                        'Georgia, serif',
                        'Lucida Sans Unicode, Lucida Grande, sans-serif',
                        'Tahoma, Geneva, sans-serif',
                        'Times New Roman, Times, serif',
                        'Trebuchet MS, Helvetica, sans-serif',
                        'Verdana, Geneva, sans-serif'
                    ],
                    supportAllValues: true
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
                fontSize: {
                    options: [ 10, 12, 14, 'default', 18, 20, 22 ],
                    supportAllValues: true
                },
                // Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
                // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
                htmlSupport: {
                    allow: [
                        {
                            name: /.*/,
                            attributes: true,
                            classes: true,
                            styles: true
                        }
                    ]
                },
                // Be careful with enabling previews
                // https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
                htmlEmbed: {
                    showPreviews: true
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
                link: {
                    decorators: {
                        addTargetToExternalLinks: true,
                        defaultProtocol: 'https://',
                        toggleDownloadable: {
                            mode: 'manual',
                            label: 'Downloadable',
                            attributes: {
                                download: 'file'
                            }
                        }
                    }
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html#configuration
                mention: {
                    feeds: [
                        {
                            marker: '@',
                            feed: [
                                '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes', '@chocolate', '@cookie', '@cotton', '@cream',
                                '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread', '@gummi', '@ice', '@jelly-o',
                                '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding', '@sesame', '@snaps', '@soufflé',
                                '@sugar', '@sweet', '@topping', '@wafer'
                            ],
                            minimumCharacters: 1
                        }
                    ]
                },
                // The "super-build" contains more premium features that require additional configuration, disable them below.
                // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
                removePlugins: [
                    // These two are commercial, but you can try them out without registering to a trial.
                    // 'ExportPdf',
                    // 'ExportWord',
                    'CKBox',
                    'CKFinder',
                    'EasyImage',
                    // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
                    // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
                    // Storing images as Base64 is usually a very bad idea.
                    // Replace it on production website with other solutions:
                    // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
                    // 'Base64UploadAdapter',
                    'RealTimeCollaborativeComments',
                    'RealTimeCollaborativeTrackChanges',
                    'RealTimeCollaborativeRevisionHistory',
                    'PresenceList',
                    'Comments',
                    'TrackChanges',
                    'TrackChangesData',
                    'RevisionHistory',
                    'Pagination',
                    'WProofreader',
                    // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
                    // from a local file system (file://) - load this site via HTTP server if you enable MathType
                    'MathType'
                ]
            }).then( newEditor => {
        editor1 = newEditor;
    } )
    .catch( error => {
        console.error( error );
    } );
            function textarea(){
                $('#editor1').val(editor1.getData());
                
            }
        </script>

<script>
function activaTab(tab){
    $('.nav-tabs a[href="#' + tab + '"]').tab('show');
};
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
    
    function upload_img(img){
        var old_txt = $('#gimgs_txt').text();
        $('#show_hide_loader').show();
        // $('#gimgs_txt').text('Uploading ...');
        var settings = {
  "url": "<?= base_url(); ?>/vendor/gupload",
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
    // alert(response);
    // $('#gimgs_txt').text(old_txt);
    $('.gallary_images').load(imgUrl);
    $('#show_hide_loader').hide();
//   console.log(response);
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
            +'        <input type="text" rows="9"  class="form-control" data-height="100" name="ad_field_values[]">'
            +'    </div>'
            +'    <div class="col-sm-2">'
            +'        <span class="remove_it_v rms btn btn-danger btn-icon btn-circle icon-lg fa fa-times" onclick="delete_row(this)"></span>'
            +'    </div>'
            +'</div>'
        );
        set_summer();
    });
    $("#more_btn_attr").click(function(){
        $("#more_fields").append(''
            +'<div class="form-group">'
            +'    <div class="col-sm-4">'
            +'        <input type="text" name="ad_field_names_custom[]" class="form-control required"  placeholder="<?php echo translate('field_name'); ?>">'
            +'    </div>'
            +'    <div class="col-sm-5">'
            +'        <textarea rows="9"  class="summernotes" data-height="100" data-name="ad_field_values_custom[]"></textarea>'
            +'    </div>'
            +'    <div class="col-sm-2">'
            +'        <span class="remove_it_v rms btn btn-danger btn-icon btn-circle icon-lg fa fa-times" onclick="delete_row(this)"></span>'
            +'    </div>'
            +'</div>'
        );
        set_summer();
    });
     var tabs = [
        'customer_choice_options',
        'top_banner',
        'event_images',
        'custom_attributes_0',
        'checkbox_information',
        'amenitys',
        'first_section',
        'custom_attributes_1',
        'location',
        'seo_section',
        'customer_choice_options1',
        
    ];
    function go_tab(ctab1 = ''){
        ctab = ctab1;
        if(ctab)
        {
            $('.nav-tabs li').each(function( index ) {
                var loop_name = $( this ).children('a').attr('href');
                console.log(loop_name+' == '+ctab );
                if(loop_name == ctab)
                {
                    $(this).addClass('active');
                    $(loop_name).addClass('active');
                    $(loop_name).addClass('in');
                    // alert(loop_name);
                }
                else
                {
                    $(this).removeClass('active');
                    $(loop_name).removeClass('active');
                    $(loop_name).removeClass('in');
                }
            });
        }
        
    }
    var ctab = 'customer_choice_options';
    function next_tab(){
        
        //find next here
        var cindex  = tabs.indexOf(ctab); 
        var nindex = cindex+1;
        ctab = tabs[nindex];
        go_tab(ctab);     
    }
   function previous_tab(){
        var cindex  = tabs.indexOf(ctab); // 0
        // alert(cindex+ctab);
        var nindex = cindex-1;
        ctab = tabs[nindex];
        // alert(ctab);
        go_tab(ctab);
        return ctab;
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
   $(document).ready(function(){
       show_rel_fields();
   });
    function show_rel_fields()
{
    
    var property_cat = '<?= $this->config->item('property_cat') ?>';
    var car_cat = '<?= $this->config->item('car_cat') ?>';
    var event_cat = '<?= $this->config->item('event_cat') ?>';
    var job_cat = '<?= $this->config->item('job_cat') ?>';
    var cats = $('#category').val();
    // alert(cats);
    
    const myArray = cats.split(",");
    // alert(myArray.indexOf(car_cat));
    if(myArray.indexOf(car_cat) != -1)
{  
    tabs = [
        'customer_choice_options',
        'top_banner',
        'event_images',
        'custom_attributes_0',
        'checkbox_information',
        'amenitys',
        'first_section',
        'custom_attributes_1',
        'location',
        'seo_section',
        
    ];
    ctab = 'customer_choice_options';
   $('#car_show').css({'display':'block'});
}
else
{
   $('#car_show').css({'display':'none'});
}
    if(myArray.indexOf(property_cat) != -1)
{ tabs = [
        'customer_choice_options',
        'top_banner',
        'event_images',
        'custom_attributes_0',
        'checkbox_information',
        'amenitys',
        'first_section',
        'custom_attributes_1',
        'location',
        'seo_section',
        
    ];
    ctab = 'customer_choice_options';
    
   $('#property_show').css({'display':'block'});
}
else
{
   $('#property_show').css({'display':'none'});
}
if(myArray.indexOf(event_cat) != -1)
{  
    tabs = [
        'customer_choice_options',
        'top_banner',
        'event_images',
        'custom_attributes_0',
        'checkbox_information',
        'amenitys',
        'first_section',
        'custom_attributes_1',
        'location',
        'seo_section',
        
    ];
    ctab = 'customer_choice_options';
   $('#event_show').css({'display':'block'});
}
else
{
    $('#event_show').css({'display':'none'});
}
if(myArray.indexOf(job_cat) != -1)
{  tabs = [
        'customer_choice_options',
        'top_banner',
        'event_images',
        'custom_attributes_0',
        'checkbox_information',
        'amenitys',
        'first_section',
        'custom_attributes_1',
        'location',
        'seo_section',
        
    ];
    ctab = 'customer_choice_options';
   $('#job_show').css({'display':'block'});
}
else
{
    $('#job_show').css({'display':'none'});
}
}
   $(document).ready(function(){
       show_rel_fields();
   });
let file;
var filename;
function selecttype(id,nid= 0,type = 0)
{
    // alert(nid);
    if(type)
    {
        $('#category').val(id);
    }
    else
    {
        if($('#category').val() && id)
        {
            
            var pre = $('#category').val()+','+id;
            // alert(pre);
            $('#category').val(pre);
        }
        else{
            $('#category').val(id);
        }
    }
    alert($('#category').val());
    show_rel_fields();
    if(nid)
    {
        id=nid;
    }
    // alert(id);

    var url  = base_url+'vendor/product/sub_by_cat/'+id;
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
/*if(true)
{
    if($('#category').val() && id )
    {
        var pre = $('#category').val()+','+id;
        // alert(pre);
        $('#category').val(pre);
    }
    else{
        $('#category').val(id);
    }
    show_rel_fields();
    var url  = base_url+'vendor/product/sub_by_cat/'+id;
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
}*/


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
    </script>
    <script>
         function validate_listing(){
        var property_cat = '<?= $this->config->item('property_cat') ?>';
        var plainText = $("#editor1").code();
        console.log(plainText);
          if(plainText.length < 300)
            {
                alert('Please add minimum 300 character in description');
                return 0;
            }
        
    var car_cat = '<?= $this->config->item('car_cat') ?>';
    var event_cat = '<?= $this->config->item('event_cat') ?>';
    var job_cat = '<?= $this->config->item('job_cat') ?>';
    var cats = $('#category').val();
    if(!cats)
    {
        alert("Please select atleast 1 category");
        return 0;
    }
    const myArray = cats.split(",");
    if(myArray.indexOf(car_cat) != -1)
{  
    car_cat = 1;
}
else
{
   car_cat = 0;
}
    if(myArray.indexOf(property_cat) != -1)
{ 
    
   property_cat = 1;
}
else
{
   property_cat = 0;
}
if(myArray.indexOf(event_cat) != -1)
{  
   event_cat = 1;
}
else
{
    event_cat = 0
}
if(myArray.indexOf(job_cat) != -1)
{  
   job_cat = 1;
}
else
{
    job_cat = 0;
}
                    var car_error = 0;
                    var property_error = 0;
                    var event_error = 0;
                    var job_error = 0;
        if(car_cat == 1)
        {
            var focus = '';
            $('.required1').each(function(i, obj) {
                if(!$(this).val() || $(this).val() == 0)
                {
                    car_error = 1;
                    
                    $(this).addClass('error');
                    // console.log($(this).attr('class'));
                }
                else
                {
                    $(this).removeClass('error');                    
                }
                console.log($(this).attr('name'));
            });
            if(car_error == 1)
            {
                var fdone = 0;
                $('.required1').each(function(i, obj) {
                if(!$(this).val() && fdone == 0)
                {
                    fdone = 1;
                    $(this).focus();
                }
                console.log($(this).attr('name'));
            });
                alert("Please fill required field");
                $('.tab-pane').each(function(i, obj) {
                    $(this).removeClass('active');
                    $(this).removeClass('in');
                
                });
                $('#xtra_info').addClass("active in");
                $('#car_show').addClass("active");
            }
            else
            {
                form_submit('product_add','<?php echo translate('product_has_been_uploaded!'); ?>');
            }
        }
        else if(property_cat == 1)
        {
            var focus = '';
            $('.required2').each(function(i, obj) {
                if(!$(this).val() || $(this).val() == 0)
                {
                    property_error = 1;
                    
                    $(this).addClass('error');
                    // console.log($(this).attr('class'));
                }
                else
                {
                    $(this).removeClass('error');                    
                }
                console.log($(this).attr('name'));
            });
            if(property_error == 1)
            {
                var fdone = 0;
                $('.required2').each(function(i, obj) {
                if(!$(this).val() && fdone == 0)
                {
                    fdone = 1;
                    $(this).focus();
                }
                console.log($(this).attr('name'));
            });
                alert("Please fill required field");
                $('.tab-pane').each(function(i, obj) {
                    $(this).removeClass('active');
                    $(this).removeClass('in');
                
                });
                $('#xtra_property_info').addClass("active in");
                $('#property_show').addClass("active");
            }
            else
            {
                form_submit('product_add','<?php echo translate('product_has_been_uploaded!'); ?>');
            }
        }
        else if(event_cat == 1)
        {
            var focus = '';
            $('.required3').each(function(i, obj) {
                if(!$(this).val() || $(this).val() == 0)
                {
                    event_error = 1;
                    
                    $(this).addClass('error');
                    // console.log($(this).attr('class'));
                }
                else
                {
                    $(this).removeClass('error');                    
                }
                console.log($(this).attr('name'));
            });
            // alert(event_error);
            if(event_error == 1)
            {
                var fdone = 0;
                $('.required3').each(function(i, obj) {
                if(!$(this).val() && fdone == 0)
                {
                    fdone = 1;
                    $(this).focus();
                }
                console.log($(this).attr('name'));
            });
                alert("Please fill required field");
                $('.tab-pane').each(function(i, obj) {
                    $(this).removeClass('active');
                    $(this).removeClass('in');
                
                });
                $('#xtra_event_info').addClass("active in");
                $('#event_show').addClass("active");
            }
            else
            {
                form_submit('product_add','<?php echo translate('product_has_been_uploaded!'); ?>');
            }
        }
        else if(job_cat == 1)
        {
            var focus = '';
            $('.required4').each(function(i, obj) {
                if(!$(this).val() || $(this).val() == 0)
                {
                    job_error = 1;
                    
                    $(this).addClass('error');
                    // console.log($(this).attr('class'));
                }
                else
                {
                    $(this).removeClass('error');                    
                }
                console.log($(this).attr('name'));
            });
            if(job_error == 1)
            {
                var fdone = 0;
                $('.required4').each(function(i, obj) {
                if(!$(this).val() && fdone == 0)
                {
                    fdone = 1;
                    $(this).focus();
                }
                console.log($(this).attr('name'));
            });
                alert("Please fill required field");
                $('.tab-pane').each(function(i, obj) {
                    $(this).removeClass('active');
                    $(this).removeClass('in');
                
                });
                $('#xtra_job_info').addClass("active in");
                $('#job_show').addClass("active");
            }
            else
            {
                form_submit('product_add','<?php echo translate('product_has_been_uploaded!'); ?>');
            }
        }
        else
        {
            form_submit('product_add','<?php echo translate('product_has_been_uploaded!'); ?>');
        }
        return 0;
        // 
    }
    </script>
    <script>
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
    
$(document).ready(function(){

    var num = parseInt( $('.exra_chnge').val());
    for(var i = 1;i <=3 ;i++)
    {
        var mid = "#col"+i+"_div";
        if(i<= num)
        {
        $(mid).show();
        }
        else
        {
            $(mid).hide();
        }
    }
});
$('.exra_chnge').change(function(){
    var num = parseInt( $(this).val());
    for(var i = 1;i <=3 ;i++)
    {
        var mid = "#col"+i+"_div";
        if(i<= num)
        {
        $(mid).show();
        }
        else
        {
            $(mid).hide();
        }
    }
});
    </script>
<script type="text/javascript">
    $(document).ready(function() {
    $(".js-example-basic-single").select2();
    });
    
     $("#more_field_btn").click(function(){
        
        $("#more_checkbox_fields").append(''
            +'<div class="form-group">'
            +'    <div class="col-sm-9">'
            +'        <input type="text" name="checkboxinfo[]" class="moredata form-control"  placeholder="<?php echo translate('field_name'); ?>">'
            +'    </div>'
            +'    <div class="col-sm-2">'
            +'        <span class="remove_it_v rms btn btn-danger btn-icon btn-circle icon-lg fa fa-times" onclick="delete_row(this)"></span>'
            +'    </div>'
            +'</div>'
        );
        set_summer();
    });
    
</script>
<!--amenities script-->
<script type="text/javascript">
$(document).ready(function(){
    getamn('<?= $rid ?>');
});
        function update_filter(id,col)
        {
            
            var input = document.getElementById(id);
            var value = input.value;
            alert(value);
            if(value == 'other' && input.getAttribute('type') == 'model')
            {
                var outer = id+'_outer';  
             var html = '<input type="text" id="'+input.getAttribute('id')+'" col="'+input.getAttribute('col')+'" rows="9" onkeyup="'+input.getAttribute('onchange')+'" class="form-control required" placeholder="'+input.getAttribute('placeholder')+'" data-height="100" name="ad_field_values[]">';
             document.getElementById(outer).innerHTML = html;
            }
            else
            {
            document.getElementById(col).value = value; 
            }

        }
        function capital_val(id)
        {
            var val = $('#'+id).val();
            val = val.charAt(0).toUpperCase() + val.slice(1);
            $('#'+id).val(val);
        }
        
$('#amen_check').on('change',function(){
    $('#amenities').toggle();
})
$('#amnty').on('keyup', function(){
        var url = '<?= base_url('vendor/getAmenties')?>';
        var value = $(this).val();
        var cats = $('#category').val();
        if(cats)
        {
          $.ajax({
        url: url,
        type: "Post",
        async: true,
        data: {add:1,value:value,cats:cats },
        success: function (data) {
           $('#add_amn').html(data);
        },
        error: function (xhr, exception) {
           
        }
    });  
        }
    });
    $('#amn_btn').on('click', function(){
        var url = '<?= base_url('vendor/getAmenties')?>';
        var value = $('#amnty').val();
        var cats = $('#category').val();
        if(cats)
        {

          $.ajax({
        url: url,
        type: "Post",
        async: true,
        data: {add_to_table:1,value:value,cats:cats,pid:<?= $rid ?> },
        success: function (data) {
            if(data)
        {
            getamn();
        }
        
        },
        error: function (xhr, exception) {
           
        }
    });  
        }
        else
        {
            alert("PLease select Ad type first ");
            go_tab('customer_choice_options')
        }
    });
    function delete_ament(val)
    {
        var url = '<?= base_url('vendor/getAmenties');?>';
      $.ajax({
        url: url,
        type: "Post",
        async: true,
        data: { del:1,am_id:val,pid:'<?= $rid ?>'},
        success: function (data) {
        if(data)
        {
            getamn();
        }
       
        },
    });
    }
     
    function getamn(id){
         var url = '<?= base_url('vendor/getAmenties');?>';
      $.ajax({
        url: url,
        type: "Post",
        async: true,
        data: { get:1,pid:'<?= $rid ?>'},
        success: function (data) {
        $('#select_amn2').html(data);
       
        },
    });
    }
     
    function selectamn(id){
         var url = '<?= base_url('vendor/getAmenties');?>';
      $.ajax({
        url: url,
        type: "Post",
        async: true,
        data: { select:1,sid:id,pid:'<?= $rid ?>'},
        success: function (data) {
        if(data)
        {
            getamn();
        }
       
        },
    });
    }
    </script>
<!--amenities script-->
    <script>
        $('#slug').on('keyup',function(){
            $('#registerbutton').attr("disabled", false);
            $('#slug').removeClass('error');
            $('#slug_error_msg').css({'display':'none'});
            var val = $(this).val();
            var url='<?= base_url('vendor/productslug') ?>';
              if(val){
              $.ajax({
        url: url,
        type: "Post",
        async: true,
        data: { value:val},
        success: function (data) {
           if(data == 'error'){
               $('#slug').addClass('error');
               $('#slug_error_msg').css({'display':'block'});
               $('#registerbutton').attr("disabled", true);
               
           }
        },
    });
        }
        });
        
    </script>
    <script>
        $("#listing_title").keyup(function() {
          var Text = $(this).val();
          Text = Text.toLowerCase();
          Text = Text.replace(/[^a-zA-Z0-9]+/g,'-');
          $("#slug").val(Text);    
          $('#slug').keyup();
        });
    </script>
    
    <script type="text/javascript">
        function update_filter(id,col)
        {
            
            var input = document.getElementById(id);
            var value = input.value;
            if(value == 'other' && input.getAttribute('type') == 'model')
            {
                var outer = id+'_outer';  
             var html = '<input type="text" id="'+input.getAttribute('id')+'" col="'+input.getAttribute('col')+'" rows="9" onkeyup="'+input.getAttribute('onchange')+'" class="form-control required" placeholder="'+input.getAttribute('placeholder')+'" data-height="100" name="ad_field_values[]">';
             document.getElementById(outer).innerHTML = html;
            }
            else
            {
            document.getElementById(col+'_col').value = value; 
            }

        }
        /*--extra option---*/
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
    /*--extra option---*/
    </script>
<style>
    .btm_border{
        border-bottom: 1px solid #ebebeb;
        padding-bottom: 15px;   
    }
</style>


<!--Bootstrap Tags Input [ OPTIONAL ]-->

