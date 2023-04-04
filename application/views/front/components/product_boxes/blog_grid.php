<style>
    .widget-search input{
        border:none !important;
    }
    #result .pagination  li {
    padding: 0;
    border-bottom: none;
    font-size: 13px;
    cursor: pointer;
}
   #result .pagination  {
    background: #fff;
    width: 100%;
    right: 0;
    border: none;
    padding: 0;
    box-shadow: none;
}
#result ul li:hover {
    background: none;
    color: #fff;
}

.itemimg{  
    /*height: 100%;*/
    min-height: 200px;
    width: 100%;
    background-size: cover;
    background-position: center;}
.img_col{padding:0;}   
.desc_col{
    padding:0 !important;
    
}
.img_hover_icons.right{
    position: absolute;
    z-index: 99;
    right: 19px;
    top: 11px;
    left:unset;
}
.flex{display:flex;justify-content: space-between;}
.center{text-align:center;}
</style>

<?php
// var_dump($is_event);
$time1 = date("H:i:s",strtotime($time1));
$date = date('Y-m-d',strtotime($time1));
 $time = time();
 if($time >=$openig_time && $time <=$closing_time){
  $x = 'Opened';  
}
else{
      $x = 'Closed';  
}
$ven = array();
$city = '';
$cats = explode(',',$cats);
foreach($cats as $k=> $v)
{
    if(!$v)
    {
        unset($cats[$k]);
    }
}
if($is_bpage)
{
    $arr = json_decode($added_by,true);
    if($arr['type'] == 'vendor')
    {
        $ven = $this->db->where('vendor_id',$arr['id'])->get('vendor')->row_array();
        if(isset($ven['city']) && $ven['city'])
        {
            $c = $this->db->where('cities_id',$ven['city'])->get('cities')->row_array();
            
            if(isset($c['name'])&& $c['name'])
            {
            $city = $c['name'];
            }
            else
            {
            $city = $ven['city'];
            }
        }
    }
}
$vendor_id =json_decode($added_by);
$id = $vendor_id->id;
$vendor = $this->db->where('vendor_id', $id)->get('vendor')->row_array();
$this->db->where('added_by',$added_by);
$this->db->where('is_bpage',1);
$vendor1 = $this->db->get('product')->row_array();
// get product
$n = $this->db->where('product_id',$vendor['bpage'])->where('is_bpage',1)->get('product')->row_array();
$img = '';
$logo=''; 
$vendorlogo= '';
// $is_event=1;

                        if($comp_cover)
                        {
                            $img = $this->crud_model->get_img($comp_cover);
                            if(isset($img->secure_url))
                            {
                                $img = $img->secure_url;
                            }

                        }
                        else
                        {
                            $img = $this->crud_model->file_view('product',$product_id,'','','thumb','src','multi','one');

                        }
                        
                          if($n['comp_logo'])
                        {
                            $vendorlogo = $this->crud_model->get_img($n['comp_logo']);
                            if(isset($vendorlogo->secure_url))
                            {
                                $vendorlogo = $vendorlogo->secure_url;
                            }

                        }
                        else
                        {
                            $vendorlogo = $this->crud_model->file_view('product',$product_id,'','','thumb','src','multi','one');

                        }


                            if($comp_logo)
                        {
                            $logo = $this->crud_model->get_img($comp_logo);
                            if(isset($logo->secure_url) && !empty($logo->secure_url))
                            {
                                $logo = $logo->secure_url;
                            }

                        }
                        else
                        {
                            $logo = $this->crud_model->file_view('product',$product_id,'','','thumb','src','multi','one');

                        }
     ?>
            <div  class="sidegap_product item white_shadow__box rmv_pdg" data-lat="<?= $lat; ?>" data-lng="<?= $lng; ?>" rate="<?= ($rating_num)?$rating_num:0; ?>">
              <div class="img_hover_icons left">
                   <?php
                   echo $this->crud_model->rate_html($rating_num);
                   ?>
                   <!--<a href="#"><i class="fa fa-heart"></i></a>-->
                </div>
              <div class="img_hover_icons right">
                   <!--<a href="#"><i class="fa fa-heart"></i></a>-->
                </div>
              
             <div class="row">  
             <div class=" col-12 img_col" onclick="location.href='<?= $this->crud_model->product_link($product_id); ?>'">
             <?php
             if($is_blog == 1){?>
                 <div class="itemimg" style="background-image:url('<?= $logo; ?>')"></div>   
             <?php
                 
             }else{
             ?>
             <div class="itemimg" style="background-image:url('<?= $img; ?>')"></div>
            <?php
             }
            ?>
                  <div class="logo_withname">
                        <img src="<?= $vendorlogo; ?>" alt="">
                        <?php
                       
                         $time = date('H:i:s', time());
                         
                         if($time >=$vendor1['openig_time'] && $time <=$vendor1['closing_time']){
                          ?>
                          <a href="#" class="online_box_wrapper"><span class="online_box2"></span></a>
                          <?php  
                        }
                        ?>
                      
                        
                        
                    </div>
                    <?php
                        if($is_bpage)
                        {
                    ?>
                    
                    <h1><?= $title; ?></h1>
                      <?php
                    
                    if($slog)
                    {
                    ?>
                        <h4><?= $slog ?></h4>
                        <?php
                    }
                        ?>
                    
                        <div class="last_desc last_d2">
                            <div class="col-md-12 dec_wrappper p-0">
                    <h2>Details</h2>
                    <p>
                    <?= strWordCut($description,250); ?>
                    </p>
                </div>
                        </div>
                        <div class="share_iconss icon_shares">
                        <div class="affliate">
                            <?php 
                    $user = true;//$this->session->userdata('user_id');
                    if($is_affiliate && $user)
                    {
                        $vid = 0;
                        $added_by = json_decode($added_by, true);
                        if(isset($added_by['type']) && $added_by['type'] == 'vendor')
                        {
                            $vid = $added_by['id'];
                        }
                        
                        $wish = $this->crud_model->is_aff($product_id); 
                    ?>
                    Affiliate
                    <?php
                    }
                    ?>
                        </div>
                        <!--<a href="#"><i class="fa fa-share"></i></a>-->
                        <?php
                        if($lat && $lng)
                        {
                        ?>
                             <a  onclick="open_marker(<?= $lat?>, <?=$lng ?>);" ><i class="fa fa-map-marker-alt"></i></a>
                             <?php
                        }
                             ?>
                        <a href="#"><i class="fa fa-share"></i></a>
                   <a onclick="to_wishlist(<?php echo $product_id; ?>,event)"><i class="fa fa-heart"></i></a>
                        <a href="mailto: <?= $bussniuss_email;?>"><i class="fa fa-envelope"></i></a>
                        <a href="tel:<?= $bussniuss_phone;?>"><i class="fa fa-phone"></i></a>
                    </div>
                    <?php
                }
                        elseif($is_blog)
                        {
                    ?>
                        <div class="col-md-12 p-0">
                        <div class="blogs_titlee"><h1><?= $title ?></h1></div>
                        <div class="meddle_cont">
                            <div class="meddle_cont_left">
                                <?php
                                if($author_name)
                                {
                                ?>
                            <h4><?= $author_name; ?></h4>
                            <?php
                                }
                            ?>
                            <?php
                    
                    if($slog)
                    {
                    ?>
                        <h4><?= $slog ?></h4>
                        <?php
                    }
                        ?>
                            </div>
                            <div class="meddle_cont_right">
                            <h4>Posted On <?= date("d-m-Y",strtotime($create_at)); ?></h4>
                            <?php 
                                if(!empty($posted_date)){
                            ?>
                            <h4>Updated On <?= date("d-m-Y",strtotime($posted_date)); ?></h4>
                            <?php 
                                }
                            $cat = $this->db->where('category_id' , $category)->get('category')->row_array();
                            // var_dump($c)
                            ?>
                            <h4><?= $cat['category_name']; ?></h4>
                            </div>
                        </div>
                        <div class="last_desc">
                            <div class="col-md-12 dec_wrappper p-0">
                    <h2>Details</h2>
                    <p>
                    <?= strWordCut($description,250); ?>
                    </p>
                </div>
                        </div>
                        <div class="share_iconss">
                        <div class="affliate">
                            <?php 
                    $user = true;//$this->session->userdata('user_id');
                    if($is_affiliate && $user)
                    {
                        $vid = 0;
                        $added_by = json_decode($added_by, true);
                        if(isset($added_by['type']) && $added_by['type'] == 'vendor')
                        {
                            $vid = $added_by['id'];
                        }
                        
                        $wish = $this->crud_model->is_aff($product_id); 
                    ?>
                    Affiliate
                    <?php
                    }
                    ?>
                        </div>
                        <!--<a href="#"><i class="fa fa-share"></i></a>-->
                        <?php
                        if($lat && $lng)
                        {
                        ?>
                             <a  onclick="open_marker(<?= $lat?>, <?=$lng ?>);" ><i class="fa fa-map-marker-alt"></i></a>
                             <?php
                        }
                             ?>
                        <a href="#"><i class="fa fa-share"></i></a>
                   <a onclick="to_wishlist(<?php echo $product_id; ?>,event)"><i class="fa fa-heart"></i></a>
                        <a href="mailto: <?= $bussniuss_email;?>"><i class="fa fa-envelope"></i></a>
                        <a href="tel:<?= $bussniuss_phone;?>"><i class="fa fa-phone"></i></a>
                    </div>
                        </div>
                        
                        
                    <?php
                    
                }
                        else
                        {
                    ?>
                    
                    <div class="col-md-8 left_fields" >
                        <h1><?= $title; ?></h1>
                        <?php
                        if($slog)
                        {
                        ?>
                        <h2><?= $slog ?></h2>
                        <?php
                        }
                        ?>
                        <div class="list_attributes list3">
                            <?= get_fields_line($product_id, 3); ?>
                        </div>
                        <div class="list_attributes list5">
                            <?= get_fields_line($product_id, 5); ?>
                        </div>
                    </div>
                    <div class="col-md-4 right_fields" >
                    <div class="right_fields_inner" >
                        <div class="list_attributes list2">
                            <?= get_fields_line($product_id, 1); ?>
                        </div>
                        <div class="list_attributes list2">
                            <?= get_fields_line($product_id, 2); ?>
                        </div>
                        <div class="list_attributes list4">
                            <?= get_fields_line($product_id, 4); ?>
                        </div>
                        <div class="list_attributes list6">
                            <?= get_fields_line($product_id, 6); ?>
                        </div>
                        </div>
                        
                    </div>
                    <?php
                if($description)
                {
                ?>
                <div class="last_desc1">
                            <div class="col-md-12 dec_wrappper p-0">
                    <h2>Details</h2>
                    <p>
                    <?= strWordCut($description,200); ?>
                    </p>
                </div>
                        </div>
                        <div class="share_iconss">
                        <div class="affliate">
                            <?php 
                    $user = true;//$this->session->userdata('user_id');
                    if($is_affiliate && $user)
                    {
                        $vid = 0;
                        $added_by = json_decode($added_by, true);
                        if(isset($added_by['type']) && $added_by['type'] == 'vendor')
                        {
                            $vid = $added_by['id'];
                        }
                        
                        $wish = $this->crud_model->is_aff($product_id); 
                    ?>
                    Affiliate
                    <?php
                    }
                    ?>
                        </div>
                        <!--<a href="#"><i class="fa fa-share"></i></a>-->
                        <?php
                        if($lat && $lng)
                        {
                        ?>
                             <a  onclick="open_marker(<?= $lat?>, <?=$lng ?>);" ><i class="fa fa-map-marker-alt"></i></a>
                             <?php
                        }
                             ?>
                        <a href="#"><i class="fa fa-share"></i></a>
                   <a onclick="to_wishlist(<?php echo $product_id; ?>,event)"><i class="fa fa-heart"></i></a>
                        <a href="mailto: <?= $bussniuss_email;?>"><i class="fa fa-envelope"></i></a>
                        <a href="tel:<?= $bussniuss_phone;?>"><i class="fa fa-phone"></i></a>
                    </div>
                <?php
                }
                ?>
                
                    <?php
                }
                        
                        ?>
            </div> 
            
            </div>
            </div>    
                      