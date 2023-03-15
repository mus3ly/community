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
            <div onclick="location.href='<?= $this->crud_model->product_link($product_id); ?>'"  class="sidegap_product item white_shadow__box" onmouseover="open_marker(<?= $lat  ?>, <?=$lng ?>)" data-lat="<?= $lat; ?>" data-lng="<?= $lng; ?>" rate="<?= ($rating_num)?$rating_num:0; ?>">
              <div class="img_hover_icons left">
                <?php
                   echo $this->crud_model->rate_html(3);
                   ?>
                 
                </div>
              <div class="img_hover_icons right">
                   <a href="#"><i class="fa fa-heart"></i></a>
                </div>
              
             <div class="row">  
             <div class="col-sm-4 col-12 img_col">
             <!--<div class="itemimg" style="background-image:url('https://imageio.forbes.com/specials-images/imageserve/5d35eacaf1176b0008974b54/0x0.jpg?format=jpg&crop=4560,2565,x790,y784,safe&width=1200')"></div>-->
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
            
            <div class="col-sm-8 col-12 desc_col">
                <div class="flex">
                <div>    
                        <h1><?= $product_id; ?>-<?= $title; ?></h1>
                    <?php
                    if($is_car)    
                    {
                        ?>
                        <h4><?= get_product_meta($product_id,'car_condition') ?>,<?= get_product_meta($product_id,'type_fuel') ?>,<?= get_product_meta($product_id,'Seats') ?> Seater</h4>
                    <h4><?= $sale_price ?>0</h4>
                        <?php
                    }
                    elseif($is_job)    
                    {
                        ?>
                        <h4>Posted on : <?= date("jS F Y", strtotime($create_at)); ?>/<?= get_product_meta($product_id,'recureter_name') ?></h4>
                    <h4><?= get_product_meta($product_id,'Salary') ?>/<?= get_product_meta($product_id,'Hours') ?></h4>
                        <?php
                    }
                    elseif($is_event)    
                    {
                        ?>
          
                    <p><?= get_product_meta($product_id,'event_catchphrase') ?></p>
                    <p>Posted By:<?= get_product_meta($product_id,'name_of_person') ?>/Ticket Price: <?= get_product_meta($product_id,'price') ?>	</p>
                 
                        <?php
                    }
                    
                    
                    ?>
                </div>
                <div>  
                    <?php 
                   
                if($is_car == 1){?>
                       <div><?= get_product_meta($product_id,'modal') ?></div>
                       <div><?= get_product_meta($product_id,'mileage') ?></div>
                       <div><?= get_product_meta($product_id,'transmission') ?></div>
               
                <?php
                    
                }if($is_blog == 1){
                 ?>   
                 <p><?= date('Y-m-d H:i:s',strtotime($posted_date));?></p>
              
               <div><?= $author_name;?></div>
               <?php
                }if($is_event == 1){
               ?>
                  <p><?= get_product_meta($product_id,'date') ?>/<?= get_product_meta($product_id,'time') ?>	</p>
                    <p><?= get_product_meta($product_id,'type') ?>/<?= get_product_meta($product_id,'age_restriction') ?>	</p>
                    <p><?= get_product_meta($product_id,'location') ?>/<?= get_product_meta($product_id,'city_event') ?>	</p>
               <?php
                }if($is_job == 1){
                 ?><p><?= get_product_meta($product_id,'job_city') ?>,<?= get_product_meta($product_id,'sarting_date') ?></p>   
                 <p><?= get_product_meta($product_id,'job_nature') ?>,<?= get_product_meta($product_id,'Employment') ?></p>
              
               <p><?= $author_name;?><?= get_product_meta($product_id,'Deadline') ?></p>
               <?php
                }

                ?>
            </div>
                </div>
                      <?php
                      if($is_car)
                      {
                          ?>
                          <b>Details</b>
                           <div class="desc"><?= excerpt($description,100); ?></div>
                          <?php
                      }
                      else
                      {
                      ?>
                      <div class="desc"><?= excerpt($description,100); ?></div>
                   <?php
                      }
                    if($is_car == 1){
                        ?>
                        <?php
                    }elseif($is_property == 1){?>
                       <div class="center"> No Of Bedrooms: (<?= $no_of_bedroom; ?>)</div> 
                   <?php
                   }else{
                    
                    ?>
                    <div class="center"></div> 
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
                    Affliate
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
                   <a href="#"><i class="fa fa-heart"></i></a>
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
                      