<?php
$pro = array();
if(isset($product_data[0]))
{ 
    $pro = $product_data[0];

    
}

$pros = $this->db->where('added_by',$pro['added_by'])->get('product')->result_array();

//galary
$imgs = $this->db->where('pid',$pro['product_id'])->get('product_to_images')->result_array();
$nimgs = array();
if(isset($pro['comp_cover']) && $pro['comp_cover'])
{
$nimgs[]['img'] = $pro['comp_cover'];
}
foreach($imgs as $k=> $v)
{
    $nimgs[] = $v;
}
$imgs = $nimgs;
$fimg = '';
if(isset($imgs[0]))
{
    $fimg = $this->crud_model->size_img($imgs[0]['img'],500,500);
}
$logo = '';
$cat = '';
if($pro['category'])
{
    $c = $this->db->where('category_id',$pro['category'])->get('category')->row();
    if(isset($c->category_name))
    {
        $cat = $c->category_name;
    }
}
    $address = '';
    if($pro['lat'] && $pro['lng'])
    {
        $lat = $pro['lat'];
        $long = $pro['lng'];
        $url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=$lat,$long&sensor=false&key=".$this->config->item('map_key');
;
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_ENCODING, "");
$curlData = curl_exec($curl);
curl_close($curl);

$data = json_decode($curlData);
if(isset($data->results[0]->formatted_address))
{
    $address = $data->results[0]->formatted_address;
}


    }
if(true)
                                            {
                                                $logo = $this->crud_model->size_img($pro['comp_logo'],100,100);
                                            }
?>
<?php
// get vendor details

$vendor_id =json_decode( $pro['added_by']);
$id = $vendor_id->id;
$vendor = $this->db->where('vendor_id', $id)->get('vendor')->row_array();
$t = $vendor['create_timestamp'];
// echo date('Y',strtotime($t));
?>
<?php
if(isset($_GET['test']))
{
    include "index_new.php";
    die();
}
?>

<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Community Hubland</title>
    <!-- meta tag -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta http-equiv="Content-Language" content="en-us"/>
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>
    <meta name="distribution" content="global"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://fonts.googleapis.com/css2?family=Catamaran:wght@300;400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link id="favicon" rel="icon"  type="<?= base_url(); ?>template/front/images/favicon.png" href="<?= base_url(); ?>template/front/images/favicon.png">
    <link type="text/css" rel="stylesheet" href="<?= base_url(); ?>template/front/css-files/font-awesome.min.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>template/front/css-files/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="<?= base_url(); ?>template/front/css-files/style.css" />
<style type="text/css">

	.ellipse,.rounded_box,.lines_shape{display: none;}
    .owl-carousel .owl-item img {
    width: 100%;
    padding: 0 7px;
}
.review-btn{
    background-color:white;
    border:none;
    color:black !important;
}
.review-btn i{
    color:grey !important;
    padding-right: 5px;
}
.big_imgmove img {
    width: 100% !important;
    padding: 0 7px;
    height: 500px;
    object-fit: cover;
    border-radius: 16px;
    margin-bottom: 10px;
}
.owl-carousel .owl-item img {
    height: 196px;
    object-fit: cover;

}
.owl-nav button span{
    display: block;
    color: transparent;
}
.owl-nav button:before,.owl-nav button:after{
    display: none;
}
.share_save_btns li{
    list-style:none;
}
.gray{
    color:gray !important;
}
.rating{
    direction:ltr !important;
}
</style>
</head>
<body id="page-name">
<div class="lines_shape">
    <img src="<?= base_url(); ?>template/front/images/lines-shape.png" alt="">
</div>





<div class="gallery_wrap">
    <div class="container">
        <div id="wrap" >
            <div class="top_social">
                    <a href="mailto:<?= $pro['bussniuss_email']?>"><img src="<?= base_url(); ?>template/front/images/envelope-orange.png" alt=""></a>
                    <a href="https://api.whatsapp.com/send?phone=<?php echo $pro['whatsapp_number'];?>"  target="_blank"><img src="<?= base_url(); ?>template/front/images/whats-app.png" alt=""></a>
                    <a href="tel:<?= $pro['bussniuss_phone']?>"><img src="<?= base_url(); ?>template/front/images/phone-white4.png" alt=""></a>
                     <!--<a href="#"><i class="fa fa-map-marker"></i></a>-->
            </div>
            
            <!--<div class="top_social_right">-->
            <!--    <a href="#"><img src="https://www.communityhubland.com/template/front/images/icon6.png" alt=""/></a>-->
            <!--    <a href="#"><img src="https://www.communityhubland.com/template/front/images/icon7.png" alt=""/></a>-->
            <!--</div>-->
            
            
<!-- big img -->
                <div class="big_imgmove" >
                    <?php
                    if($imgs)
                    {
                    
                    ?>
                    <img src="<?= $fimg; ?>" class="d-block w-100" alt="...">
                    
                     <div class="user_socials_login">
                        <a href="#"><img src="https://www.communityhubland.com/template/front/images/Group-39634_03.png" alt=""/></a>
                <a href="#"><img src="https://www.communityhubland.com/template/front/images/Group-39634_06.png" alt=""/></a>
                    </div>
                    
                    
                    <div class="share_save_btns">
                            <?php
                            
                    if ($this->session->userdata('user_login') == "yes") {
                        
                        $user_id = $this->session->userdata('user_id');
                    ?>
                        <li><a href="<?php echo $this->crud_model->product_link($pro['product_id']); ?>?rate=1"><i class="review_btnnn fa-solid fa-star"></i> Write a review</a></li>
                        <span class="btn" onclick="to_wishlist(<?= $pro['product_id']?>,event)" data-toggle="tooltip" data-placement="right" data-original-title="Add To Wishlist">
                        <i class="fa fa-heart"></i>
                    </span>
                        <?php
                    }
                    else
                    {
                        ?>
                        <li><a href="<?php echo base_url('home/login_set/login'); ?>"><i class="fa-solid fa-star"></i> Write a review</a></li>
                        <?php
                    }
                    }
                        ?>
                   
                    </div>
                    
                </div>
                <?php
                if(!$pro['is_job'])
                {
                ?>
            <div id="small-categories" class="<?= $pro['is_job']?"job_gall":""; ?>owl-carousel owl-carousel-icons1 owl-loaded owl-drag">
                


                <!-- small img -->
                  <div class="owl-stage-outer">
                     <div class="owl-stage" style="transform: translate3d(-3002px, 0px, 0px); transition: all 0.25s ease 0s; width: 4804px;">
                        
                            <?php
                            
                         if(count($imgs))   
                         {
                             
                foreach ($imgs as $key => $value) {
                    $img = $this->crud_model->size_img($value['img'],500,500);
                    ?> 
                    <div class="owl-item " >
                   <div class="item">
                              <div class="cat-img"> <img src="<?= $img; ?>" alt="img"> </div>
                           </div>
                    </div>
                    <?php
                }
                         }
                ?>
                           
                        
                     </div>
                  </div>
                  <div class="owl-nav">
                     <button type="button" role="presentation" class="owl-prev"><span aria-label="Previous"><img src="<?= base_url(); ?>template/front/images/left-arrow--1.png"></span></button>
                     <button type="button" role="presentation" class="owl-next"><span aria-label="Next"><img src="<?= base_url(); ?>template/front/images/right-arrow--1.png"></span>
                     </button>
                  </div>

                  
                

                  <div class="owl-dots disabled"></div>
               </div>
               <?php
                }
               ?>
    
            <!-- Carousel -->
            <!-- <div id="carousel" class="carousel slide gallery" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item" data-slide-number="1" data-toggle="lightbox" data-gallery="gallery" data-remote="images/big-img.png">
                        <img src="<?= base_url(); ?>template/front/images/big-img.png" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item" data-slide-number="2" data-toggle="lightbox" data-gallery="gallery" data-remote="images/big-img.png">
                        <img src="<?= base_url(); ?>template/front/images/big-img.png" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item" data-slide-number="3" data-toggle="lightbox" data-gallery="gallery" data-remote="images/big-img.png">
                        <img src="<?= base_url(); ?>template/front/images/big-img.png" class="d-block w-100" alt="...">
                    </div>
                    
                    <div class="carousel-item" data-slide-number="4" data-toggle="lightbox" data-gallery="gallery" data-remote="images/big-img.png">
                        <img src="<?= base_url(); ?>template/front/images/big-img.png" class="d-block w-100" alt="...">
                    </div>

                    <div class="carousel-item" data-slide-number="5" data-toggle="lightbox" data-gallery="gallery" data-remote="images/big-img.png">
                        <img src="<?= base_url(); ?>template/front/images/big-img.png" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item" data-slide-number="6" data-toggle="lightbox" data-gallery="gallery" data-remote="images/big-img.png">
                        <img src="<?= base_url(); ?>template/front/images/big-img.png" class="d-block w-100" alt="...">
                    </div>
                    
                    <div class="carousel-item" data-slide-number="7" data-toggle="lightbox" data-gallery="gallery" data-remote="images/big-img.png">
                        <img src="<?= base_url(); ?>template/front/images/big-img.png" class="d-block w-100" alt="...">
                    </div>
                </div>
                
            </div> -->

            <!-- Carousel Navigatiom -->
            <!-- <div id="carousel-thumbs" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active" data-slide-number="0">
                        <div class="row mx-0">
                            <div id="carousel-selector-0" class="thumb col-3 px-1 py-2 selected" data-target="#carousel" data-slide-to="0">
                                <img src="<?= base_url(); ?>template/front/images/big-img.png" class="img-fluid" alt="...">
                            </div>
                            <div id="carousel-selector-1" class="thumb col-3 px-1 py-2" data-target="#carousel" data-slide-to="1">
                                <img src="<?= base_url(); ?>template/front/images/Rectangle 4489.png" class="img-fluid" alt="...">
                            </div>
                            <div id="carousel-selector-2" class="thumb col-3 px-1 py-2" data-target="#carousel" data-slide-to="2">
                                <img src="<?= base_url(); ?>template/front/images/Rectangle 4490.png" class="img-fluid" alt="...">
                            </div>
                            <div id="carousel-selector-3" class="thumb col-3 px-1 py-2" data-target="#carousel" data-slide-to="3">
                                <img src="<?= base_url(); ?>template/front/images/Rectangle 4491.png" class="img-fluid" alt="...">
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item " data-slide-number="1">
                        <div class="row mx-0">
                            <div id="carousel-selector-4" class="thumb col-3 px-1 py-2" data-target="#carousel" data-slide-to="4">
                                <img src="<?= base_url(); ?>template/front/images/Rectangle 4491.png" class="img-fluid" alt="...">
                            </div>
                            <div id="carousel-selector-5" class="thumb col-3 px-1 py-2" data-target="#carousel" data-slide-to="5">
                                <img src="<?= base_url(); ?>template/front/images/Rectangle 4489.png" class="img-fluid" alt="...">
                            </div>
                            <div id="carousel-selector-6" class="thumb col-3 px-1 py-2" data-target="#carousel" data-slide-to="6">
                                <img src="<?= base_url(); ?>template/front/images/Rectangle 4490.png" class="img-fluid" alt="...">
                            </div>
                            <div id="carousel-selector-7" class="thumb col-3 px-1 py-2" data-target="#carousel" data-slide-to="7">
                                <img src="<?= base_url(); ?>template/front/images/Rectangle 4491.png" class="img-fluid" alt="...">
                            </div>
                        </div>
                    </div>
                    
                </div>
                <a class="carousel-control-prev" href="#carousel-thumbs" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"><img src="<?= base_url(); ?>template/front/images/left-arrow--1.png"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carousel-thumbs" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"><img src="<?= base_url(); ?>template/front/images/right-arrow--1.png"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div> -->
</div>
    </div>
</div>

<div class="container">
    <?php
    $additional_fields = json_decode($pro['additional_fields'], true);
    $names = array();
    $valus = array();
    if(isset($additional_fields['name']) && $additional_fields['name'])
    {
        $names = json_decode($additional_fields['name'],true);
        $valus = json_decode($additional_fields['value'],true);
    }
    if($valus && $names)
    {
        $col1= array();
        $col2= array();
        $i = 1;
        $lim = 30;
        $accor = array();
        foreach($names as $k=> $v)
        {
            if(strlen($valus[$k]) > $lim)
            {
                $accor[$v] = $valus[$k];
            }
            else
            {
            $i++;
            
            if($i%2 == 0)
            {
                if($valus[$k])
                $col1[$v] = $valus[$k];
            }
            else
            {
                if($valus[$k])
                $col2[$v] = $valus[$k];
            }
            }
        }
        
    ?>
<div class="main_wrapper">
    
    <div class="left_sec">
        <div class="main_left_wrapper">
            <div class="left_card">
                <div class="card_title">
                    <span>Features</span>
                </div>
              
                <div class="col-md-6 main_info_wrapper">
                    <div class="info_wrapper new_info_wrapper">
                   <?php
                   foreach($col1 as $k=> $v)
                   {
                       ?>
                
                    <div class="main_info">
                        <span><?= $k ?></span></span>
                        <span><?= $v; ?></span>
                    </div>
                
                <?php
                   }
                   ?> 
                   </div>
                </div>
                <div class="col-md-6 main_info_wrapper">
                    <div class="info_wrapper new_info_wrapper">
                   <?php
                   foreach($col2 as $k=> $v)
                   {
                       ?>
                
                    <div class="main_info">
                        <span><?= $k ?></span></span>
                        <span><?= $v; ?></span>
                    </div>
                
                <?php
                   }
                   ?> 
                   </div>
                </div>
            </div>
        </div>
    </div>
    <?php /*
if($vendor['comp_logo'])
                        {
                            $vendorlogo = $this->crud_model->get_img($vendor['comp_logo']);
                            if(isset($vendorlogo->secure_url))
                            {
                                $vendorlogo = $vendorlogo->secure_url;
                            }

                        }
                        else
                        {
                            $vendorlogo = $this->crud_model->file_view('product',$product_id,'','','thumb','src','multi','one');

                        }    
    ?>
    <div class="right_sec">
        <div class="title_detail">
            <h4 id="user_btn">User Detail</h4>
        </div>
        <div class="middle">
            <div class="img_detaile">
               <img src="<?= $vendorlogo?>" alt="profile image">
            </div>
            <div class="name_section">
               <a href="<?= base_url();?>"> <span id="chang_color"><?= $vendor['company'];?></span></a>
                <div class="Since">
                    
                    <span>Our Member Since 2021 <?php // echo date('Y',strtotime($t));?></span>
                </div>
            </div>
            <div class="img_detaile"></div>
        </div>
        <div class="bottom_section">
            <div class="number_section">
                <span><img src="<?= base_url(); ?>template/front/images/orange-phone.png" alt=""></span><h5><?= $vendor['phone']; ?></h5>
            </div>
            <div class="number_section">
                <span><i class="fa-solid fa-envelope"></i></span><h5><?= $vendor['email']; ?></h5>
            </div>
            <div class="number_section">
                <span><i class="fa-sharp fa-solid fa-location-dot"></i></span><h5><?= $vendor['address1']; ?></h5>
            </div>
        </div>
        <div class="contact_button">
            <button>CONTACT US</button>
        </div>
        <!-- AddToAny BEGIN -->
<div class="a2a_kit a2a_kit_size_32 a2a_default_style">
<a class="a2a_button_facebook"></a>
<a class="a2a_button_twitter"></a>
<a class="a2a_button_pinterest"></a>
<a class="a2a_button_whatsapp"></a>
<a class="a2a_button_linkedin"></a>
</div>
<script async src="https://static.addtoany.com/menu/page.js"></script>
<!-- AddToAny END -->
        
    </div>
  */  ?>
    <?php
   echo $r = $this->load->view('user',array('pro'=>$pro),true);
    ?>
</div>
    <?php
    }
    ?>
</div>
<div class="business_name">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 business_cal">
                <div class="calander_box">
                     <a href="#"><img src="https://www.communityhubland.com/template/front/images/calander_box.png" alt=""/></a>
                    <!--<h4><?= var_dump($pro);?></h4>-->
                    <h4><?= $pro['title'];?></h4>
                    <p><?= $pro['slog'];?></p>
                </div>
            </div>
          
       
            <div class="col-sm-6 date_posted"style="width:250px">
                <div class="inner_date_posted">
                     <a href="#"><i class="fa fa-twitter"></i></a>
                     <a href="#"><i class="fa fa-instagram"></i></a>
                     <a href="#"><i class="fa fa-facebook"></i></a>
                </div>
                <div class="">
                    <table  style="width:100%">
                          <?php
                          if(isset($pro['additional_fields'])){
                        $exp = json_decode($pro['additional_fields']);
                        $ex = json_decode($exp->name);
                        $values = json_decode($exp->value);
                        
                          foreach($ex as $k => $v){
                              $val = $values[$k];
                        $txt = strip_tags($val);
                        $x = explode(' ', $txt);
                        if(count($x) < 2)
                        {
                          ?>
                    <tr> 
                    <th><?= $v;?></th>
                    <td><?= $val ?></td>
                    </tr>
                     <?php
                        }
                          }
                        }
                     ?>
                     </table>
                     <!--<a href="#"><i class="fa fa-check-circle"></i> Time of Event</a>-->
                     <!--<a href="#"><i class="fa fa-check-circle"></i> Duration</a>-->
                     <!--<a href="#"><i class="fa fa-check-circle"></i> Avaible discount</a>-->
                     <!--<a href="#"><i class="fa fa-check-circle"></i> Avaible tickets</a>-->
                </div>
            </div>
        </div>
    </div>
</div>

<div class="info_box_wrap">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 inner_box_info">
     
            <p><?= $pro['description']; ?></p>
        </div>
        </div>
        <div class="extra_attributes">
            <table  style="width:100%">
                          <?php
                          if(isset($pro['additional_fields'])){
                        $exp = json_decode($pro['additional_fields']);
                        $ex = json_decode($exp->name);
                        $values = json_decode($exp->value);
                        
                          foreach($ex as $k => $v){
                              $val = $values[$k];
                        $txt = strip_tags($val);
                        $x = explode(' ', $txt);
                        if(count($x) >= 2)
                        {
                          ?>
                    <tr> 
                    <th><?= $v;?></th>
                    <td><?= $val ?></td>
                    </tr>
                     <?php
                        }
                          }
                        }
                     ?>
                     </table>
        </div>
        <div class="row" id="volume_box">
            <div class="col-sm-6 business_graphic">
                <?php
                        
                        $cover = base_url().'template/front/images/volume.png';
                        if($pro['firstImg'])
                                                                    {
                                                                        $cover = $this->crud_model->size_img($pro['firstImg'],820,312);
                                                                    }
                                                                    ?>
                <img src="<?= $cover; ?>" alt="">
            </div>
            <div class="col-sm-6 communitybox  ">
                <h3><?= $pro['slogan']; ?></h3>
                <p><?= $pro['main_heading']; ?></p>
                <ul>
                    <?php
                    $features = json_decode($pro['feature'], true);
                    foreach($features as $k => $v){
                        if(!empty($v['fdet']))
                        {
                    ?>
                        <li><?= $v['fdet'];?></li>
                    <?php
                        }
                    }
                    ?>
                    </ul>
                <div class="learn_more_btns">
                   <?php
                                $btns  = json_decode($pro['buttons'],true);
                                $i = 0;

                                foreach ($btns as $key => $value) {
                                    $i++;
                                    if(!empty($value['txt']))
                                    {
                                    if($i %2 !=  0)
                                    {
                                        ?>
                                        <a href="<?= $value['url'] ?>" class="our_projects"><?= $value['txt'] ?></a>
                                        <?php
                                    }
                                    else{
                                        ?>
                                        <a href="<?= $value['url'] ?>"><?= $value['txt'] ?></a>
                                        <?php
                                    }
                                    }
                                }
                                ?>
                </div>
            </div>
        </div>

    </div>
</div>                  
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8">
                                <?php
                                $chek = json_decode($pro['checkbox_xtra_fields']);
                                foreach($chek as $k=> $v)
                                {
                                    if(empty($v))
                                    {
                                        unset($chek[$k]);
                                    }
                                }
                                if($chek)
                                {
                                ?>
                        <div class="check_box_wrapper">
                            <div class="inner_box_sec">
                                <div class="box_title">
                                    <h2>FEATURES</h2>
                                    
                                </div>
                                <div class="check_box_content">
                                    <div class="listings">

                                        <ul>
                                            <?php
                                                
                                                 $odd= array();
                                                $even= array();
                                                $i = 1;
                                                $lm = 40;
                                                if($chek)
                                                {
                                                foreach($chek as $k=> $v)
                                                {
                                                    $i++;
                                                    if($i%2 == 0)
                                                    {
                                                        $even[] = $v;
                                                    }
                                                    else
                                                    {
                                                        $odd[] = $v;
                                                    }
                                                }
                                                }
                                            
                                                foreach($even as $k){
                                                    if(strlen($k) < $lm){
                                                ?>
                                            <div class="d-flex gap_inn">   
                                            <li><span><img src="<?= base_url(); ?>/upload/checkk.png" alt=""></span></li>
                                            <li><?= $k;?></li>
                                            </div>
                                            <?php
                                                }}
                                            ?>
                                        </ul>
                                        <ul>
                                            <?php
                                            foreach($odd as $k){
                                                if(strlen($k) < $lm){
                                                ?>
                                            <div class="d-flex gap_inn">
                                            <li><span><img src="<?= base_url(); ?>/upload/checkk.png" alt=""></span></li>
                                            <li><?= $k; ?></li>
                                            </div>
                                            <?php
                                            }}
                                            ?>
                                        </ul>
                                        
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                                }
                        ?>
                        </div>
                        </div>
                        </div>
                                       
                                    


                       <div class="container no_pdgn">
                                <div class="panel-group" id="accordion">
                               
                                   <?php
                                   
                                        $additional_fields_new = json_decode($pro['additional_fields_new'], true);
                                        
                                        
                                        $names = array();
                                        $valus = array();
                                        if(isset($additional_fields_new['name']))
                                        {
                                            $names = $additional_fields_new['name'];
                                            $valus = $additional_fields_new['value'];
                                        }
                                        if($accor)
                                        {
                                            $ii = 99;
                                            foreach($accor as $k=> $v)
                                            {
                                                $ii ++;
                                                ?>
                                               <div class="panel panel-default">
                                                   Test
                                                    <div class="panel-heading add_flexible">
                                                      <h4 class="panel-title add_flexible">
                                                        
                                                            <?= $k; ?>
                                                    
                                                      </h4>
                                                      <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?= $ii; ?>"><i class="clr_chngg fa-solid fa-caret-down"></i></a>
                                                    </div>
                                                    <div id="collapse<?= $ii; ?>" class="panel-collapse collapse">
                                                      <div class="panel-body">  <?= $v; ?></div>
                                                    </div>
                                                  </div>
                                                <?php
                                            }
                                        }
                                        if($valus && $names)
                                        {
                                            foreach($names as $k=> $v)
                                            {
                                                ?>
                                               <div class="panel panel-default">
                                                    <div class="panel-heading add_flexible">
                                                      <h4 class="panel-title add_flexible">
                                                        
                                                            <?= $v; ?>
                                                    
                                                      </h4>
                                                      <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?= $k; ?>"><i class="clr_chngg fa-solid fa-caret-down"></i></a>
                                                    </div>
                                                    <div id="collapse<?= $k; ?>" class="panel-collapse collapse">
                                                      <div class="panel-body">  <?= $valus[$k]; ?></div>
                                                    </div>
                                                  </div>
                                                <?php
                                            } 
                                          }

                                    ?>
                                </div>
                            </div>
                        </div>

                         <div class="orange_pathwrap" id="bpage_form">
                            <div class="container">
                                <div class="iframe_box">
                                <div id="googleMap" style="width:100%;height:550px;"></div>


                                    <div class="getin_touch">
                                        <h3>Get In Touch <img src="<?= base_url(); ?>upload/phone_2.png" alt=""></h3>
                                        <form action="" method="">
                                            <div class="row">
                                                <div class="col-sm-6 form_gapp">
                                                    <div class="form_box">
                                                        <label for="First name">First name</label>
                                                        <input type="text" placeholder="" name="">
                                                        <img src="<?= base_url(); ?>template/front/images/user-icon.png" alt="">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 form_gapp">
                                                    <div class="form_box">
                                                        <label for="Last name">Last name</label>
                                                        <input type="text" placeholder="" name="">
                                                        <img src="<?= base_url(); ?>template/front/images/user-icon.png" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12 form_gapp">
                                                    <div class="form_box">
                                                        <label for="Email">Email</label>
                                                        <input type="email" placeholder="" name="">
                                                        <img src="<?= base_url(); ?>template/front/images/email.png" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12 form_gapp">
                                                    <div class="form_box">
                                                        <label for="Phone number">Phone number</label>
                                                        <input type="number" placeholder="Type phone number" name="">
                                                        <img class="phone_iconn" src="<?= base_url(); ?>upload/phone_icon.png" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12 form_gapp">
                                                    <div class="form_box">
                                                        <label for="Message">Message</label>
                                                        <textarea placeholder="Type Message"></textarea>
                                                        <img class="msg_iconn" src="<?= base_url(); ?>upload/message_1.png" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12 form_gapp">
                                                    <div class="form_box">
                                                        <button type="submit">Send</button>
                                                        <button type="submit">GET DIRECTION</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <div class="container" id="mrg_tp"> 
                                <div class="row">
                                    <?php
                                    $amn = json_decode($pro['listing_amenities']);
                                    if(isset($pro['listing_amenities']) && !empty($pro['listing_amenities']) && $amn){
                                    ?>
                                    <div class="col-md-6">
                                        <div class="tag_sec_wrapper tags_sec">
                                            <div class="head_section">
                                               <h4>Amenities</h4> 
                                            </div>
                                            <div class="inner_sec">
                                                <div class="tag_container">
                                                    <?php
                                                    foreach($amn as $k => $v){
                                                    ?>
                                                    <div class="tags_in">
                                                        <span><img src="<?= base_url(); ?>/upload/checkk.png" alt=""></span>
                                                        <span><?= $v; ?></span>
                                                    </div>
                                                    <?php
                                                    }
                                                    ?>
                                                    </div>
                                                
                                                    
                                                </div>
                                                </div>
                                            </div>
                                                                                    
                                              <?php
                                                    }
                                              if(isset($pro['tag']) && !empty($pro['tag'])){
                                              ?> 
                                          
                                            
                                            <?php
                                            $tags = $pro['tag'];
                                                        $x = (explode(",",$tags));
                                            if($x)
                                            {
                                                ?>
                                        <div class="col-md-6">
                                         <div class="tag_sec_wrapper tags_sec">
                                            <div class="head_section">
                                               <h4>Tags</h4> 
                                            </div>
                                             
                                     
                                            <div class="inner_sec">
                                                <div class="tag_container">
                                                      <?php
                                                        foreach($x as $K => $v){?>
                                                    <div class="tags_in">
                                                        <span><img src="<?= base_url(); ?>/upload/checkk.png" alt=""></span>
                                                        <span><?=  $v;?></span>
                                                    </div>
                                                    <?php
                                                        }
                                                    ?>
                                                    
                                                </div>
                                             </div>        
                                                </div>
                                            </div>
                                            <?php
                                            }
                                            ?>
                                           <?php
                                              }
                                            ?>
                                        
                                    </div>   
                                </div>
                                <?php
                                /*
                                ?>
                    <div class="contact_info new_contact_info">
  
    <div class="container">
          <?php
            if(isset($pro['etra_content']) && !empty($pro['etra_content'])){
                var_dump($pro['etra_content']);
            ?>
        <div class="row">
            <?php
                        //extra_info
                        
                        if($pro['etra_content'])
                        {
                            $content = json_decode($pro['etra_content'],true);
                            $num = $pro['number_of_column'];
                            $class="12";
                            if($num == 1)
                            {
                                $class = 12;
                            }
                            else if($num == 2)
                            {
                                $class = 6;
                            }
                            else if($num == 3)
                            {
                                $class = 4;
                            }
                            ?>
          <div class="pro_business">
                            <h3><?= $pro['extra_section_heading'] ?></h3>
                        </div>
                        <div class="row">
                            <?php
                            for($i= 1; $i<=$num; $i++)
                            {
                                ?>
                                <div class="col-sm-<?= $class ?> webdesign">
                                <div class="inner_box_design">
                                    <?php
                                    $k = $i -1;
                                    echo $content[$k];
                                    ?>
                                </div>
                            </div>
                                <?php
                            }
                            ?>
                        </div>
                        <?php
                        }
                        ?>
        </div>
        <?php
    }
        ?>
        
                            <?php
                                if(isset($pro['additional_fields_new']) && !empty($pro['additional_fields_new'])){
                                    $exp1 = json_decode($pro['additional_fields_new']);
                                    // var_dump($exp1);
                                    $ex1 =$exp1->name;
                                    $values1 = $exp1->value;
                                    foreach($ex1 as $k => $v){
                                        ?>
                                <div class="row">
                                    <div class="col-sm-9 inner_box_info" style="padding: 0 0 21px;">
                                    <h2><?= $v; ?></h2>
                                    <p><?= $values1[$k]; ?>
                                    </p>
                                </div>
                                </div>
                                <?php
                                    }
                                    }?>
     
         <!---->
    </div>
</div>
<?php
*/
?>

<?php
$rating = $this->db->where('product_id', $pro['product_id'])->get('user_rating')->result_array();
if($rating){
?>
        <div class="client_say" id="pt-100">
                <div class="container">
                <div class="clients_box">
                    <h3>Take a look what our client Says</h3>
                    <!--<h4>Reviews</h4>-->
                    <br>
                </div>
                <div class="row">
                    <?php
                    // var_dump($pro);
                    
                    // var_dump($rating);
                    foreach($rating as $k=> $v){
                    ?>
                    <div class="col-sm-4 cilent_gapp">
                        <div class="info_client">
                            <?php
                            
                            $user_id = $v['user_id'];
                            $users = $this->db->where('user_id', $user_id)->get('user')->row();
                            // var_dump($users);
                            ?>
                            <img src="
                            <?php 
                                // $user_id = $v['user_id'];
                                if(file_exists('uploads/user_image/user_'.$user_id.'.jpg')){ 
                                    
                                    echo $this->crud_model->file_view('user',$user_id,'100','100','no','src','','','.jpg').'?t='.time();
                                } else if(empty($row['fb_id']) !== true){ 
                                    echo 'https://graph.facebook.com/'. $row['fb_id'] .'/picture?type=large';
                                } else if(empty($row['g_id']) !== true ){
                                    echo $row['g_photo'];
                                } else {
                                    echo base_url().'uploads/user_image/default.jpg';
                                } 
                            ?>
                            " alt="">
                            <h4><?= $users->username?></h4>
                            <p>“<?= $v['comment'];?>”</p>
                            <div class="rating">
                                <?php
                                for($i =1; $i<=5;$i++)
                                {
                                    if($i<= $v['rating'])
                                    {
                                        ?>
                                        <i class="fa fa-star"></i>
                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                        <i class="fa fa-star gray"></i>
                                        <?php
                                    }
                                }
                                ?>
                            <span><?= $v['rating'];?></span>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
<?php
}
?>

<div class="listing_view_gapp">
    <div class="container">
        <div class="container">
            <div class="verify_head">
                <h3>You May Also be Interested In</h3>
                <p>You can now list your business in less than 5 minutes</p>
            </div>
              <div class="row">
        <?php
                    $box_style =6;//  $this->db->get_where('ui_settings',array('ui_settings_id' => 29))->row()->value;
                    $limit = 3;// $this->db->get_where('ui_settings',array('ui_settings_id' => 20))->row()->value;
                    $featured=$this->crud_model->product_list_set('featured',$limit);
                    foreach($featured as $row){
                            ?>
                            <div class="col-md-4">
                                <?php
                                echo $this->html_model->product_box($row, 'grid', $box_style);
                                ?>
                            </div>
                            <?php
                        
                    }
                ?>
        </div>
            <!--<div class="row">-->
            <!--    <?php /*-->
            <!--    $products1 = $this->db->order_by('number_of_view', 'DESC')->limit('3')->get('product')->result_array();-->
            <!--    foreach($products1 as $k => $v){-->
            <!--        $sub = $v['description'];-->
            <!--        $sub = substr($sub,0,200);-->
            <!--    ?>-->
            <!--                <div class="col-sm-4 bottom_box">-->
            <!--                    <div class="inner_bottombox">-->
            <!--                        <img src="<?= base_url(); ?>template/front/images/img-2.png" alt="">-->
            <!--                        <div class="sidegapp_bottom">-->
            <!--                            <h5><?= $v['number_of_view'];?> views      </h5>-->
            <!--                            <h3><?= $v['title'];?></h3>-->
            <!--                            <p><?= $sub;?></p>-->
            <!--                            <a href="<?= base_url().'home/product_view/'.$v['product_id']; ?>">Read more <img src="<?= base_url(); ?>template/front/images/arrow-right1.png" alt=""></a>-->
            <!--                        </div>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--    <?php-->
            <!--    }-->
                
            <!--    */?>-->
            <!--            </div>-->
                        <div class="disqus_comment" >
                            <div id="disqus_thread"></div>
<script>
    /**
    *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
    *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables    */
    /*
    var disqus_config = function () {
    this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
    this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
    };
    */
    (function() { // DON'T EDIT BELOW THIS LINE
    var d = document, s = d.createElement('script');
    s.src = 'https://coummityhyubland.disqus.com/embed.js';
    s.setAttribute('data-timestamp', +new Date());
    (d.head || d.body).appendChild(s);
    })();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
                        </div>
        </div>
    </div>
</div>



<script type="text/javascript">
    $(document).ready(function(){
    
    $('ul.tabss li').click(function(){
        var tab_id = $(this).attr('data-tab');

        $('ul.tabss li').removeClass('current');
        $('.tab-content').removeClass('current');

        $(this).addClass('current');
        $("#"+tab_id).addClass('current');
    })

})

$(".right_box .locationbox h4").click(function(){
    $(".clock_time").toggle();
});

</script>
<script>
    $('#send').on('click' , function(e){
            e.preventDefault();
            
            var url = '<?php echo base_url('home/contact_us')?>';
            var fname = $('#fname__').val();
            var lname = $('#lname').val();
            var email = $('#email__').val();
            var msg = $('#message__').val();
            var phone = $('#phone').val();
            var pid = $('#pid').val();
               $.ajax({
                url: url,
                type: "get",
                async: true,
                data: {  fname:fname, email:email, message:msg,phone:phone,lname:lname ,pid:pid },
                success: function (data) {
                    const myArr = JSON.parse(JSON.stringify(data));
              if(myArr['email'] > 0){
                        $("#success").attr("class", "alert alert-success d-block");
                      }else{
                          $("#danger").attr("class", "alert alert-danger d-block");
                      }
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


        });
    
</script>
<script>
function myMap() {
var mapProp= {
  center:new google.maps.LatLng(<?= $pro['lat'] ?>,<?= $pro['lng'] ?>),
  zoom:12,
};
var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
        var myLatLng = {lat: <?= $pro['lat'] ?>, lng: <?= $pro['lng'] ?>};

var marker = new google.maps.Marker({
          position: myLatLng,
          map: map,
          title: 'Hello World!'
        });
}
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=<?= $this->config->item('map_key'); ?>&callback=myMap"></script>
<script src="https://ads.strokedev.net/template/front/js-files/custom.js"></script>
<script src="<?= base_url(); ?>template/front/js-files/jquery.js"></script>
<script src="<?= base_url(); ?>template/front/js-files/bootstrap.min.js"></script>
<script src="<?= base_url(); ?>template/front/js-files/owl.carousel.js"></script>
<script src="<?= base_url(); ?>template/front/js-files/custom.js"></script>
<script type="text/javascript">
    
    
    
(function($) {
    
    /*---Owl-carousel----*/

    // ___Owl-carousel-icons
    var owl = $('.owl-carousel-icons1');
    owl.owlCarousel({
        loop: true,
        rewind: false,
        margin: 0,
        animateIn: 'fadeInDowm',
        animateOut: 'fadeOutDown',
        autoplay: false,
        autoplayTimeout: 5000, 
        autoplayHoverPause: true,
        dots: false,
        nav: true,
        autoplay: true,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1,
                nav: true
            },
            600: {
                items: 2,
                nav: true
            },
            1250: {
                items: 4,
                nav: true
            }
        }
    })
 // ___Owl-carousel-icons

})(jQuery);
</script>
</body>
</html>