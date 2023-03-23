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

.itemimg{    height: 100%;
min-height: 200px;
    width: 100%;
    background-size: cover;
    background-position: center;}
.img_col{padding:0;}   
.desc_col{padding: 20px 10px 0 10px;}
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

$vendor_id =json_decode($added_by);
$id = $vendor_id->id;
$vendor = $this->db->where('vendor_id', $id)->get('vendor')->row_array();
// get product
$n = $this->db->where('product_id',$vendor['bpage'])->where('is_bpage',1)->get('product')->row_array();

$time1 = date("H:i:s",strtotime($create_at));
$date = date('Y-m-d',strtotime($time1));
 $time = time();
 if($time >=$openig_time && $time <=$closing_time){
  $x = 'Opened';  
}
else{
      $x = 'Closed';  
}
$this->db->where('added_by',$added_by);
$this->db->where('is_bpage',1);
$vendor = $this->db->get('product')->row_array();
$vendorlogo= '';
$img = '';
$logo=''; 
// var_dump($added_by);
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
                           
                            if(isset($logo->secure_url))
                            {
                                // $logo = base_url('/').$logo->path;
                                $logo = $logo->secure_url;
                            }

                        }
                        else
                        {
                            $logo = $this->crud_model->file_view('product',$product_id,'','','thumb','src','multi','one');

                        }
     
     ?>
            <div class="sidegap_product item white_shadow__box" onmouseover="open_marker(<?= $lat  ?>, <?=$lng ?>)" data-lat="<?= $lat; ?>" data-lng="<?= $lng; ?>" rate="<?= ($rating_num)?$rating_num:0; ?>">
              <div class="img_hover_icons left">
                <?php
                   echo $this->crud_model->rate_html($rating_num);
                   ?>
                 
                </div>
              
             <div class="row">  
             <div class="col-sm-4 col-12 img_col">
             <!--<div class="itemimg" style="background-image:url('https://imageio.forbes.com/specials-images/imageserve/5d35eacaf1176b0008974b54/0x0.jpg?format=jpg&crop=4560,2565,x790,y784,safe&width=1200')"></div>-->
              <?php
             if($is_blog == 1){?>
                 <div onclick="location.href='<?= $this->crud_model->product_link($product_id); ?>'" class="itemimg" style="background-image:url('<?= $logo; ?>')"></div>   
             <?php
                 
             }else{
             ?>
             <div onclick="location.href='<?= $this->crud_model->product_link($product_id); ?>'" class="itemimg" style="background-image:url('<?= $img; ?>')"></div>
            <?php
             }
            ?>
                <!--agr is_blog 1 ho ga to $logo ko $img se replace krna h -->
                  <div class="logo_withname">
                        <!--<img src="https://static.cargurus.com/images/forsale/2023/02/26/09/26/2020_chevrolet_corvette-pic-2662332189977326050-1024x768.jpeg" alt="">-->
                        <img src="<?= $vendorlogo;?>" alt="">
                        <?php
                       
                         $time = date('H:i:s', time());
                         if($time >=$vendor['openig_time'] && $time <=$vendor['closing_time']){
                          ?>
                          <a href="#" class="online_box_wrapper"><span class="online_box2"></span></a>
                          <?php  
                        }
                        ?>
                        
                        
                    </div>
                    </div>
            
            <div class="col-sm-8 col-12 desc_col desc_col_in">
                <!--work here-->
                <div class="row" id="add_height_in">
                    <div class="col-md-6 left_fields" >
                        <h1><?= $title; ?></h1>
                        <h1><?= $slog ?></h1>
                        <div class="list_attributes list3">
                            <?= get_fields_line($product_id, 3); ?>
                        </div>
                        <div class="list_attributes list5">
                            <?= get_fields_line($product_id, 5); ?>
                        </div>
                    </div>
                    <div class="col-md-6 right_fields" >
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
                </div>
                <?php
                if($description)
                {
                ?>
                <div class="row add_hegiht_in">
                    <div class="col-md-12 dec_wrappper">
                    <h2>Details</h2>
                    <p>
                    <?= strWordCut($description,200); ?>
                    </p>
                </div>
                </div>
                <?php
                }
                ?>
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
                </div>
            </div>
            </div>    
            <!--<div class="col-sm-6 listingbox item" onmouseover="open_marker(<?= '$lat'?>, <?='$lng' ?>)" data-lat="<?= '$lat'; ?>" data-lng="<?= '$lng'; ?>">-->
            <!--    <a href="<?php echo '$this->crud_model->product_link($product_id)'; ?>">-->
            <!--        <div class="hover_listingbox">-->
            <!--            <img src="<?= '$img'; ?>" alt="">-->
            <!--        </div>-->
            <!--        <div class="hover_box_list">-->
            <!--            <h4><?= '$title' ?></h4>-->
            <!--            <p><?= '$slogan'; ?></p>-->
            <!--        </div>-->
            <!--    </a>-->
            <!--</div>-->
                      