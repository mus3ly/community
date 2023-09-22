<?php

$pro = array();
if(isset($product_data[0]))
{
    $pro = $product_data[0];

    
}
$pros = $this->db->where('added_by',$pro['added_by'])->get('product')->result_array();

//galary
$imgs = $this->db->where('pid',$pro['product_id'])->get('product_to_images')->result_array();

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
                        <li><a href="<?php echo $this->crud_model->product_link($pro['product_id']); ?>?rate=1"><i class="fa-solid fa-star"></i> Write a review</a></li>
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
            <div id="small-categories" class="owl-carousel owl-carousel-icons1 owl-loaded owl-drag">
                


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
    
            <!-- Carousel -->
            <!-- <div id="carousel" class="carousel slide gallery" data-ride="carousel">
                <div class="carousel-inner">
                <?php
                        $i = 0;
                foreach ($imgs as $key => $value) {
                    $i++;
                    $img = $this->crud_model->size_img($value['img'],271,181);
                    ?>
                    <div class="carousel-item active" data-slide-number="0" data-toggle="lightbox" data-gallery="gallery" data-remote="images/big-img.png">
                        <img src="<?= $img; ?>" class="d-block w-100" alt="...">
                    </div>
                    <?php
                    }
                    ?>
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
            <h2>Information</h2>
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
                    ?>
                        <li><?= $v['fdet'];?></li>
                    <?php
                        }
                    ?>
                    </ul>
                <div class="learn_more_btns">
                   <?php
                                $btns  = json_decode($pro['buttons'],true);
                                $i = 0;

                                foreach ($btns as $key => $value) {
                                    $i++;
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
                                ?>
                </div>
            </div>
        </div>

      <?php
      if($pro['tag']){
      ?> 
      <div class="inner_box_info" style="    padding: 0 0 30px;">
            <h2>Tags</h2>
            <p>You can now list your</p>
        </div>
    
        <div class="tags_box">
            <ul>
                <?php
                $tags = $pro['tag'];
                $x = (explode(",",$tags));
                foreach($x as $K => $v){
                ?>
                <li><a href="#"><img src="#" alt=""> <?=  $v;?></a></li>
                <?php
                }
                ?>
               </ul>
        </div>
<?php
      }
    ?>
    </div>
</div>


<div class="contact_info">
    <div class="container">
        <div class="row">
            <?php
                        //extra_info
                        
                        if(true)
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
        
        
                       