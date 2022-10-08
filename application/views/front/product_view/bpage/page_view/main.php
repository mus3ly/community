<?php
if(isset($_GET['test']))
{
    include "index_new.php";
    die();
}
?>
<?php
$pro = array();

if(isset($product_data[0]))
{
    $pro = $product_data[0];
}

$pros = $this->db->where('added_by',$pro['added_by'])->get('product')->result_array();
//galary
$imgs = $this->db->where('pid',$pro['product_id'])->get('product_to_images')->result_array();
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
                                                $logo = $this->crud_model->get_img($pro['comp_logo']);
                                                if(isset($logo->path))
                                                {
                                                    $logo = base_url().$logo->path;
                                                }
                                            }
                                            $cover = '';
if(true)
                                            {
                                                $cover = $this->crud_model->size_img($pro['comp_cover'],820,312);
                                            }
?>
<?php
// var_dump($pro);
// die();
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
    .gray{color:gray!important;}
	.ellipse,.rounded_box{display: none;}
	.fa-brands{font-size: 35px; padding: 17px;}
	.fa-facebook-f{color:#3b5998;}
	.fa-twitter{color:	#55acee;}
	.fa-google{color:#dc4e41}
	.fa-linkedin-in{color:#0C63BC;}
	.social_media{margin-left: 40%;}
	.social_media img{    width: 50px;
    height: 50px;}
	.rating {direction: ltr!important;}
</style>
</head>
<body id="page-name">


<div class="lines_shape">
    <img src="<?= base_url(); ?>template/front/images/lines-shape.png" alt="">
</div>




<div class="business_card">
    <div class="container">
        <div class="business_banner"  style="background: url('<?= $cover ?>');">
            <div class="share_icon">
                <ul>
                    
                    <li><a href="#"><img src="<?= base_url(); ?>template/front/images/share.png" alt=""></a></li>
                    <li><a href="#"><img src="<?= base_url(); ?>template/front/images/heart.png" alt=""></a></li>
                </ul>
            </div>
            <div class="row profile_box">
                <div class="col-sm-2 profile_box_img">
                    <a href="#"><img src="<?= $logo; ?>" alt=""></a>
                </div>
                <div class="col-sm-10 right_profilebox">
                    <h3><?= $pro['title'] ?> <a href="#"><img src="<?= base_url(); ?>template/front/images/Combined-Shape.png" alt=""></a></h3>
                    <p><?= $pro['slogan'] ;?>
                    
                    </p>

                    <ul>
                        <li><a href="https://api.whatsapp.com/send?phone=<?= $pro['whatsapp_number']; ?>&text=Hello this is the starting message"  target = "_blank"><img src="<?= base_url(); ?>template/front/images/Chat.png" alt=""> Direct message</a></li>
                        <li><a target = "_blank" href="tel:<?= $pro['bussniuss_phone'];?>"><img src="<?= base_url(); ?>template/front/images/Call.png" alt=""> Call now</a></li>
                        <li><a target = "_blank" href="mailto:<?= $pro['bussniuss_email'];?> " class="active"><img src="<?= base_url(); ?>template/front/images/message.png" alt=""> Send an email</a></li>
                        <li><a target = "_blank" href="https://www.google.com/maps/?q=<?= $pro['lat'];?>,<?= $pro['lng'];?>"><img src="<?= base_url(); ?>template/front/images/Location-1.png" alt="" > Get directions</a></li>
                            <?php
                    if ($this->session->userdata('user_login') == "yes") {
                        
                        $user_id = $this->session->userdata('user_id');
                    ?>
                        <li><a target = "_blank" href="<?php echo $this->crud_model->product_link($pro['product_id']); ?>?rate=1"><i class="fa-solid fa-star"></i> Write a review</a></li>
                        <li><span class="btn" onclick="to_wishlist(<?= $pro['product_id']?>,event)" data-toggle="tooltip" data-placement="right" data-original-title="Add To Wishlist">
                        <i class="fa fa-heart"></i>
                    </span></li>
                        <?php
                    }
                    else
                    {
                        ?>
                        <li><a target = "_blank" href="<?php echo base_url('home/login_set/login'); ?>"><i class="fa-solid fa-star"></i> Write a review</a></li>
                        <?php
                    }
                        ?>
                        
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="tabs_wrap">
    <div class="container">
        <div class="inner_tabs">
            <ul class="tabs__box">
                <li class="tab-link__box current" data-tab="tab_1">Profile</li>
                <li class="tab-link__box" data-tab="tab_2">Events</li>
                <li class="tab-link__box" data-tab="tab_3">Blogs</li>
                <li class="tab-link__box" data-tab="tab_4">Jobs</li>
                <li class="tab-link__box" data-tab="tab_5">Store</li>
                <li class="tab-link__box" data-tab="tab_6">Reviews</li>
            </ul>

            
        </div>
    </div>
    <div id="tab_1" class="tab-content__box current">
                <div class="advertise_wrap" style="padding-bottom: 0;">
                    <div class="clipart">
                        <?php
                        
                        $cover = base_url().'template/front/images/info-graphic.png';
                        if($pro['firstImg'])
                                                                    {
                                                                        $cover = $this->crud_model->size_img($pro['firstImg'],820,312);
                                                                    }
                        ?>
                        <img src="<?= base_url(); ?>template/front/images/business_graphic-clipart.png" alt="">
                    </div>
                    <div class="container">
                        <div class="row" id="advertise_info">
                        <div class="col-sm-6 business_graphic">
                            <img src="<?= $cover; ?>" alt="">
                        </div>
                        <div class="col-sm-6 communitybox">
                            <b><?= $pro['slogan'] ?></b>
                            <h3><?= $pro['main_heading'] ?></h3>
                            <p><?= $pro['description'] ?></p>
                            <ul>
                                <?php
                                $feature  = json_decode($pro['feature'],true);
                                foreach ($feature as $key => $value) {
                                    if($value['fhead'])
                                    {
                                        ?>
                                         <li>
                                    <img src="<?= base_url(); ?>template/front/images/Tick-Square.png" alt="">
                                     <?= $value['fhead'] ?>
                                     <p>- <?= $value['fdet'] ?></p>
                                </li>
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



                    <div class="container">
                        <div class="verify_head " style="    padding: 10px 16px;">
                        <h3>Image Gallery</h3>
                        <p>You can now list your business in less than 5 minutes</p>
                    </div>
                    </div>
                    <div class="gallerybox">
                        <div class="row">
                        <?php
                        $i = 0;
                foreach ($imgs as $key => $value) {
                    $i++;
                    $img = $this->crud_model->size_img($value['img'],500,500);
                    if($i % 2 != 0)
                    {
                        ?>
                        <div class="col-sm-8 left_box">
                                <div class="bigbox_gallery inner_gallery">
                                    <img src="<?= $img; ?>" alt="">
                                    <div class="overlay_box">
                                        <h4>Marketing Strategy</h4>
                                        <h2>Digital Agency Template</h2>
                                        <p>
                                            <img src="<?= base_url(); ?>template/front/images/girl.png" alt=""> 
                                            <span class="name_avatar">Tamim Islam</span> 
                                            <span class="star_box">
                                                <img src="<?= base_url(); ?>template/front/images/Star.png">
                                                <img src="<?= base_url(); ?>template/front/images/Star.png">
                                                <img src="<?= base_url(); ?>template/front/images/Star.png">
                                                <img src="<?= base_url(); ?>template/front/images/Star.png">
                                                <img src="<?= base_url(); ?>template/front/images/Star.png">
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php

                    }
                    else{
                        ?>
                        <div class="col-sm-4 right_box">
                                <div class="small_box_gallery inner_gallery">
                                    <img src="<?= base_url(); ?>template/front/images/gallery_2.png" alt="">
                                    <div class="overlay_box">
                                        <h4>Marketing Strategy</h4>
                                        <h2>Digital Agency Template</h2>
                                        <p>
                                            <img src="<?= base_url(); ?>template/front/images/girl.png" alt=""> 
                                            <span class="name_avatar">Tamim Islam</span> 
                                            <span class="star_box">
                                                <img src="<?= base_url(); ?>template/front/images/Star.png">
                                                <img src="<?= base_url(); ?>template/front/images/Star.png">
                                                <img src="<?= base_url(); ?>template/front/images/Star.png">
                                                <img src="<?= base_url(); ?>template/front/images/Star.png">
                                                <img src="<?= base_url(); ?>template/front/images/Star.png">
                                            </span>
                                        </p>
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
                    </div>
            <?php
                    if($pro['text']){
                    ?>
                    <div class="container">
                        <div class="verify_head" style="    padding: 10px 16px;">
                        <h3>Text Gallery</h3>
                        <p>You can now list your business in less than 5 minutes</p>
                    </div>
                    </div>
                    <div class="icon_box_wrap">
    <div class="container">
        
        <div class="row">

        <?php
                $cboxes = json_decode($pro['text'],true);
                                    $boxes = 3;
                                    if($cboxes)
                                    {
                                        // $cboxes = unserialize($cboxes);

                                        // var_dump($cboxes);
                                        $boxes = count($cboxes);
                                    }

                                    for ($i=0; $i < $boxes; $i++) { 
                                        ?>
            <div class="col-sm-4 sidegapp">
                <div class="info_box_shadow">
                    <div class="shadow_icon">
                         <img src="<?= base_url(); ?>template/front/images/business-icon.png" alt=""> 
                    </div>
                    <b><?= (isset($cboxes[$i]['fhead'])?$cboxes[$i][' fhead']:''); ?> </b>
                    <ul>
                        <?php
                        $ex = explode(',',$cboxes[$i]['fdet']);
                        if(count($ex) > 1)
                        {
                            foreach($ex as $k=> $v)
                            {
                            ?>
                            <li><?= $v; ?></li>
                            <?php
                            }
                        }
                        else
                        {
                            echo $cboxes[$i]['fdet'];
                        }
                        ?>
                    </ul>
                    <div class="bottom_path active_path">
                        <img src="<?= base_url(); ?>template/front/images/rectangle.png" alt="">
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
</div>

<div class="social_media">
    <div class="container">
       <?php
       $img='';
       $social_image = json_decode($pro['social_media']);
            foreach($social_image as $k =>$v){
                // var_dump($k);
                $row = $this->db->where('id', $k)->get('bpkg')->row();
                if($row->img){
				$img = $this->crud_model->get_img($row->img)->secure_url;
			                 } 
            ?>
            <a href="<?= $v; ?>" target="_blank"><img src="<?= $img; ?>"></a>
            <?php
           }
            ?>
    </div>
</div>
 <?php
                if($tags){?>
   <div class="container">
            <div class="inner_box_info" style="    padding: 10px 16px;">
            <h2>Tags</h2>
            <p>You can now list your</p>
        </div>

   </div>
   <?php
                }
   ?>
        <div class="tags_box">
            <ul>
                <?php
                if($tags){
                $tags = $pro['tag'];
                $x = (explode(",",$tags));
                foreach($x as $K => $v){
                ?>
                <li><a href="#"><img src="#" alt=""> <?=  $v;?></a></li>
                <?php
                }
                }
                ?>
               </ul>
        </div>
                    <div class="orange_pathwrap">
                        <div class="container">
                            <div class="iframe_box">
                            <div id="googleMap" style="width:100%;height:550px;"></div>


                                <div class="getin_touch">
                                    <h3>Get In Touch</h3>
                                    <form action="" method="">
                                        <div class="row">
                                            <div class="col-sm-6 form_gapp">
                                                <div class="form_box">
                                                    <label for="First name">First name</label>
                                                    <input type="text" placeholder="Tamim" name="">
                                                    <img src="<?= base_url(); ?>template/front/images/user-icon.png" alt="">
                                                </div>
                                            </div>
                                            <div class="col-sm-6 form_gapp">
                                                <div class="form_box">
                                                    <label for="Last name">Last name</label>
                                                    <input type="text" placeholder="Islam" name="">
                                                    <img src="<?= base_url(); ?>template/front/images/user-icon.png" alt="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 form_gapp">
                                                <div class="form_box">
                                                    <label for="Email">Email</label>
                                                    <input type="email" placeholder="Email" name="">
                                                    <img src="<?= base_url(); ?>template/front/images/email.png" alt="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 form_gapp">
                                                <div class="form_box">
                                                    <label for="Phone number">Phone number</label>
                                                    <input type="number" placeholder="Type phone number" name="">
                                                    <img src="<?= base_url(); ?>template/front/images/email.png" alt="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 form_gapp">
                                                <div class="form_box">
                                                    <label for="Message">Message</label>
                                                    <textarea placeholder="Type Message"></textarea>
                                                    <img src="<?= base_url(); ?>template/front/images/email.png" alt="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 form_gapp">
                                                <div class="form_box">
                                                    <button type="submit">Send</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container">
                        <div class="mixcher_orange">
                            <div class="shape_doted_mix">
                                <img src="<?= base_url(); ?>template/front/images/mixcher-orange.png" alt="">
                            </div>
                            
                            <h4><?= $pro['info_head']; ?></h4>
                            <p><?= $pro['info_desc']; ?></p>
                            <?php
                            if(isset($pro['info_button']) && !empty($pro['info_button']) && isset($pro['button_url']) &&!empty($pro['button_url'])){
                            ?><a href="<?= $pro['button_url']; ?>"><?= $pro['info_button']; ?></a>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="purple_line" id="intrested">
                        <img src="<?= base_url(); ?>template/front/images/base-icon.png" alt="">
                    </div>
                    <div class="container">
                        <div class="verify_head">
                            <h3>You May Also be Interested In</h3>
                            <p>You can now list your business in less than 5 minutes</p>
                        </div>
                    </div>
                    <div class="container">
                                <div class="row">
        <?php
                    $box_style =6;//  $this->db->get_where('ui_settings',array('ui_settings_id' => 29))->row()->value;
                    $limit = 3;// $this->db->get_where('ui_settings',array('ui_settings_id' => 20))->row()->value;
                    $featured=$this->crud_model->product_list_set('featured',$limit);
                    foreach($featured as $row){
                        echo $this->html_model->product_box($row, 'grid', $box_style);
                    }
                ?>
        </div>

                        <!--<div class="row">-->
                        <!--    <div class="col-sm-4 bottom_box">-->
                        <!--        <div class="inner_bottombox">-->
                        <!--            <img src="<?= base_url(); ?>template/front/images/img-2.png" alt="">-->
                        <!--            <div class="sidegapp_bottom">-->
                        <!--                <h5>Jan 21, 2019      45 Comments       10 Share</h5>-->
                        <!--                <h3>Shrimp and Avocado Salad with Miso Dressing</h3>-->
                        <!--                <p>This Shrimp and Avocado Salad is topped with spicy shrimp, crisp cucumbers, spinach, creamy avocado, and a generous drizzle of miso dressing. The happiest green salad ever!</p>-->
                        <!--                <a href="#">Read more <img src="<?= base_url(); ?>template/front/images/arrow-right1.png" alt=""></a>-->
                        <!--            </div>-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--    <div class="col-sm-4 bottom_box">-->
                        <!--        <div class="inner_bottombox">-->
                        <!--            <img src="<?= base_url(); ?>template/front/images/img-2.png" alt="">-->
                        <!--            <div class="sidegapp_bottom">-->
                        <!--                <h5>Jan 21, 2019      45 Comments       10 Share</h5>-->
                        <!--                <h3>Shrimp and Avocado Salad with Miso Dressing</h3>-->
                        <!--                <p>This Shrimp and Avocado Salad is topped with spicy shrimp, crisp cucumbers, spinach, creamy avocado, and a generous drizzle of miso dressing. The happiest green salad ever!</p>-->
                        <!--                <a href="#">Read more <img src="<?= base_url(); ?>template/front/images/arrow-right1.png" alt=""></a>-->
                        <!--            </div>-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--    <div class="col-sm-4 bottom_box">-->
                        <!--        <div class="inner_bottombox">-->
                        <!--            <img src="<?= base_url(); ?>template/front/images/img-3.png" alt="">-->
                        <!--            <div class="sidegapp_bottom">-->
                        <!--                <h5>Jan 21, 2019      45 Comments       10 Share</h5>-->
                        <!--                <h3>Shrimp and Avocado Salad with Miso Dressing</h3>-->
                        <!--                <p>This Shrimp and Avocado Salad is topped with spicy shrimp, crisp cucumbers, spinach, creamy avocado, and a generous drizzle of miso dressing. The happiest green salad ever!</p>-->
                        <!--                <a href="#">Read more <img src="<?= base_url(); ?>template/front/images/arrow-right1.png" alt=""></a>-->
                        <!--            </div>-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</div>-->
                        <div class="info_tooltip">
                            <a href="#"><img src="<?= base_url(); ?>template/front/images/info-orange.png" alt=""></a>
                        </div>
                    </div>
                </div>
            </div>
            <div id="tab_2" class="tab-content__box">
                <div class="container">
                    <?php
                            foreach($pros as $sing)
                            {
                            
                            $cats = explode(',', $sing['category']);
                            if (in_array(407, $cats) && $sing['is_bpage'] == 0)
                              {
                                  echo $this->html_model->product_box($sing, 'grid', 6);
                              }
                            }
                              ?>
                   
                </div>
            </div>
            <div id="tab_3" class="tab-content__box">
                                    <div class="container">
                        <div class="row">
                            <?php
                            $blog = $this->db->where('added_by',$pro['added_by'])->get('blog')->result_array();
                            // var_dump($blog);
                            foreach($blog as $k => $v){
                            ?>
                            <div class="col-sm-4 bottom_box">
                                <div class="inner_bottombox">
                                    <a href="<?= base_url('home/blog_view/'.$v['blog_id']);?>" target="_blank"><img src="<?php echo $this->crud_model->file_view('blog',$v['blog_id'],'','','thumb','src','',''); ?>" alt=""></a>
                                    <div class="sidegapp_bottom">
                                        <h5><?= $v['date'];?></h5>
                                        <h3><?= $v['title'];?></h3>
                                        <p><b><?= substr(strip_tags($v['summery']),0, 200);?>  .....</b></p>
                                        <a href="<?= base_url('home/blog_view/'.$v['blog_id']);?>" target="_blank">Read more <img src="<?= base_url(); ?>template/front/images/arrow-right1.png" alt=""></a>
                                    </div>
                                </div>
                            </div>
                            <?php
                            }
                            ?>
                        </div>
                        <div class="info_tooltip">
                            <a href="#"><img src="<?= base_url(); ?>template/front/images/info-orange.png" alt=""></a>
                        </div>
                    </div>

                
            </div>
            <div id="tab_4" class="tab-content__box">
                <div class="container">
                    <?php
                            foreach($pros as $sing)
                            {
                            
                            $cats = explode(',', $sing['category']);
                            if (in_array(78, $cats) && $sing['is_bpage'] == 0)
                              {
                                  echo $this->html_model->product_box($sing, 'grid', 6);
                              }
                            }
                              ?>
                   
                </div>
                
            </div>
            <div id="tab_5" class="tab-content__box">
                <div class="container">
                    <div class="emptyspace">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                    tempor incididunt ut labt in voluptate velit esse
                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                </div>
                </div>
                
            </div>
            <div id="tab_6" class="tab-content__box">
                <div class="container">
                <div class="clients_box">
                    <h3>Take a look what our client Says</h3>
                    <h4>Reviews</h4>
                    
                </div>
                <div class="row">
                    <?php
                    // var_dump($pro);
                    $rating = $this->db->where('product_id', $pro['product_id'])->get('user_rating')->result_array();
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
</div>
<div class="container">
    
    <div class="disqus_comment" >
                            <div id="disqus_thread"></div></div>
</div>
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
<script src="<?= base_url();?>template/front/js-files/custom.js"></script>



