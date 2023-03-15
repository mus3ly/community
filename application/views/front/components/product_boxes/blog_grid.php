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
                         $time = time();
                         if($time >=$openig_time && $time <=$closing_time){
                          ?>
                          <a href="#" class="online_box_wrapper"><span class="online_box2"></span></a>
                          <?php  
                        }
                        ?>
                        <h4><?= $name ?></h4>
                        
                        
                    </div>
                    <?php
                        if($is_bpage)
                        {
                            ?>
                            
                            <?php
                        }
                        ?>
            </div> 
            <div class="col-12 desc_col">
                <div class="new_div">
                <div class="flex">
                <div>    
                
                        <h1 onclick="location.href='<?= $this->crud_model->product_link($product_id); ?>'"><?= $product_id; ?>-<?= $title; ?></h1>
                        <h5 class="slogan"><?= $slog; ?></h5>
                        <?php
                        if($is_car)
                        {
                        ?>
                    <p><?= get_product_meta($product_id,'car_condition') ?>,<?= get_product_meta($product_id,'type_fuel') ?>,<?= get_product_meta($product_id,'Seats') ?> Seater</p>
                        <p><?= $sale_price ?></p>
                    <?php
                        }
                        elseif($is_job)    
                    {
                        ?>
                        <h4>Posted on : <?= date("jS F Y", strtotime($create_at)); ?>/<?= get_product_meta($product_id,'recureter_name') ?></h4>
                    <h4><?= get_product_meta($product_id,'Salary') ?>/<?= get_product_meta($product_id,'Hours') ?></h4>
                        <?php
                    }if($is_event == 1){
                 ?>
                  <p><?= get_product_meta($product_id,'event_catchphrase') ?></p>
                  <p>Posted By:<?= get_product_meta($product_id,'name_of_person') ?>/Ticket Price: <?= get_product_meta($product_id,'price') ?>	</p>
                 <?php
                    }
                    ?>
                </div>
                <div>  
                    <?php 
                    if($is_event == 1){?>
                
                   
                    <p><?= get_product_meta($product_id,'date') ?>/<?= get_product_meta($product_id,'time') ?>	</p>
                    <p><?= get_product_meta($product_id,'type') ?>/<?= get_product_meta($product_id,'age_restriction') ?>	</p>
                    <p><?= get_product_meta($product_id,'location') ?>/<?= get_product_meta($product_id,'city_event') ?>	</p>
                        <?php
                }
                if($is_car == 1){?>
                       <div><?= get_product_meta($product_id,'modal') ?></div>
                       <div><?= get_product_meta($product_id,'mileage') ?></div>
                       <div><?= get_product_meta($product_id,'transmission') ?></div>
                <?php
                    
                }
                if($is_bpage == 1){?>
                       <div><?= $city;?></div>
                       <div>
                       <?php
                       if($cats)
                       {
                           $cid = $cats[0];
                           ?>
                           <a href="#"><?= $cid ?></a>
                           <?php
                           if(count($cats) > 1 && $cid)
                           {
                               $pl = count($cats)-1;
                               echo '+'.$pl;
                           }
                       }
                       ?>
                       </div>
                <?php
                    
                }if($is_blog == 1){
                 ?>   
                 <div><?= date('Y-m-d',strtotime($posted_date)).' '.time('H:i',strtotime($openig_time));?></div>
              
               <div> <?= $author_name;?></div>
               <?php
                }
                elseif($is_job == 1){
                 ?><div><?= get_product_meta($product_id,'job_city') ?>,<?= get_product_meta($product_id,'sarting_date') ?></div>   
                 <div><?= get_product_meta($product_id,'job_nature') ?>,<?= get_product_meta($product_id,'Employment') ?></div>
              
               <div><?= $author_name;?><?= get_product_meta($product_id,'Deadline') ?></div>
               <?php
                }

                ?>
            </div>
                 
                </div>
                    <b>Details</b>
                           <div class="desc"><?= excerpt($description,150); ?></div>
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
                    Affliate
                    <?php
                    }
                    ?>
                        </div>
                        <!--<a href="#"><i class="fa fa-share"></i></a>-->
                        
                             <a href="#"><i class="fa fa-share"></i></a>
                   <a href="#"><i class="fa fa-heart"></i></a>
                        <a href="mailto: <?= $bussniuss_email;?>"><i class="fa fa-envelope"></i></a>
                        <a href="tel:<?= $bussniuss_phone;?>"><i class="fa fa-phone"></i></a>
                    </div>
               
                </div>
            </div>
            </div>    
                      