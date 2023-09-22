<?php
$othen = array();
                    $this->db->order_by("bpage_sort", "asc");

                    $mods = $this->db->where('bpage_check',1)->get('modules')->result_array();
                    foreach($mods as $k=> $v)
                    {
                        $othen[] = $v['id'];
                    }
                    
                    ?>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Catamaran:wght@100;200;300;400;500;600&display=swap');

    body{
        font-family: 'Catamaran', sans-serif !important;
    }
    .height_auto{
        height:auto !important;
        overflow: auto !important;;
    }
#rateYo > .checked {
  color: orange;
}
</style>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<?php
if(isset($_GET['test'])) {
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

$checks = array();

if($pro['enable_checks'])

{
    if(!is_array($pro['enable_checks'])){
        $checks = json_decode($pro['enable_checks']);
    } else {
        $checks = $pro['enable_checks'];
    }

}



$vid = 0;

$ad = json_decode($pro['added_by'],true);

if(isset($ad['id']))

{

    $vid = $ad['id'];

}

$pros = $this->db->where("`added_by` LIKE '%".$vid."%' AND `added_by` LIKE '%vendor%'")->get('product')->result_array();



//galary

$imgs = $this->db->where('pid',$pro['product_id'])->get('product_to_images')->result_array();

$logo = base_url('img_avatar.png');

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

if($pro['comp_logo'])

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





// function getConfig($key){

//     $key = $this->db->select('value')->where('key', $key)->get('default_business')->row_array();

//     return $key;

// }

// var_dump(getConfig('title'));

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

    <link rel="stylesheet" href="<?= base_url(); ?>template/front/css-files/bootstrap.min.css">

    <link type="text/css" rel="stylesheet" href="<?= base_url(); ?>template/front/css-files/style.css" />

    <style type="text/css">

        .gray{color:gray!important;}

        .ellipse,.rounded_box{display: none;}

        .fa-brands{font-size: 35px; padding: 17px;}

        .fa-facebook-f{color:#3b5998;}

        .fa-twitter{color:  #55acee;}

        .fa-google{color:#dc4e41}

        .fa-linkedin-in{color:#0C63BC;}

        .social_media{margin-left: 40%;}

        .social_media img{    width: 50px;

            height: 50px;}

        .rating {direction: ltr!important;}

        .scroll::-webkit-scrollbar {

            display: none;

        }

    </style>

</head>

<body id="page-name">





<div class="lines_shape">

    <img src="<?= base_url(); ?>template/front/images/lines-shape.png" alt="">

</div>









<div class="business_card">

    <div class="container  ">

        <?php
        if(!is_array($pro['enable_checks'])){
            $checks = explode(',', $pro['enable_checks']);
        } else {
            $checks = $pro['enable_checks'];
        }
        if(in_array('banner_section', $checks) || true)

        {

            ?>

            <div class="business_banner"  style="background: url('<?= $cover ?>');background-position:center;background-size:cover;">

                <div class="overlay_banner__box"></div>

                <?php  /* ?>

         <div class="social_links_box">

                    <?php

           $img='';

           $social_image = json_decode($pro['social_media']);

                foreach($social_image as $k =>$v){

                    // var_dump($k);

                    $row = $this->db->where('id', $k)->get('bpkg')->row();

                    if($row->img){

                    $img = $this->crud_model->get_img($row->img)->secure_url;

                                 }

                                 if($v)

                                 {

                ?>

                <a href="<?= $v; ?>" target="_blank"><img style="width:25px;" src="<?= $img; ?>"></a>

                <?php

                                 }

               }

                ?>

                </div>

                <?php */?>

                <div class="whatsapp_new">

                    <a href="mailto:<?= $pro['bussniuss_email']?>"><img src="<?= base_url(); ?>template/front/images/envelope-orange.png" alt=""></a>

                    <a href="https://api.whatsapp.com/send?phone=<?php echo $pro['whatsapp_number'];?>"  target="_blank"><img src="<?= base_url(); ?>template/front/images/whats-app.png" alt=""></a>

                    <a href="tel:<?= $pro['bussniuss_phone']?>"><img src="<?= base_url(); ?>template/front/images/phone-white4.png" alt="" id="left_align"></a>

                    <!--<a href="#"><i class="fa fa-map-marker"></i></a>-->

                </div>

                <div class="share_icon share_icon_right">

                    <ul>



                        <li><a href="#" id="shareit"><img src="<?= base_url(); ?>template/front/images/share.png" alt=""></a>

                            <div class="social_mediabox">

                                <ul>

                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>

                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>

                                    <li><a href="#"><i class="fa fa-instagram"></i></a></li>

                                    <li><a href="#"><i class="fa fa-pinterest"></i></a></li>

                                </ul>

                            </div>

                        </li>

                        <li><a href="#"><img src="<?= base_url(); ?>template/front/images/heart.png" alt=""></a></li>

                        <!--<div class="sharethis-inline-share-buttons" style="display:none;"></div>-->

                    </ul>

                </div>

                <div class="row profile_box">

                    <div class="col-sm-2 profile_box_img">

                        <a href="#"><img src="<?= $logo; ?>" alt=""></a>

                    </div>

                    <div class="col-sm-10 right_profilebox">

                        <h3><?= $pro['title'] ?> <a href="#"><img src="<?= base_url(); ?>template/front/images/Combined-Shape.png" alt=""></a></h3>

                        <p><?= $pro['slog'] ;?>



                        </p>
                        
                        <?php

                        echo $this->crud_model->rate_html($pro['rating_num']);

                        ?>
                        


                        <ul style="display:none">

                            <li><a href="https://api.whatsapp.com/send?phone=<?= $pro['whatsapp_number']; ?>&text=Hello this is the starting message"  target = "_blank"><img src="<?= base_url(); ?>template/front/images/Chat-1.png" alt=""> </a></li>

                            <li><a target = "_blank" href="tel:<?= $pro['bussniuss_phone'];?>"><img src="<?= base_url(); ?>template/front/images/Call1.png" alt=""></a></li>

                            <li><a target = "_blank" href="mailto:<?= $pro['bussniuss_email'];?> " class="active"><img src="<?= base_url(); ?>template/front/images/envelope-new.png" alt=""></a></li>

                            <li><a target = "_blank" href="https://www.google.com/maps/?q=<?= $pro['lat'];?>,<?= $pro['lng'];?>"><img src="<?= base_url(); ?>template/front/images/maplocation-s.png" alt="" ></a></li>

                            <?php

                            if ($this->session->userdata('user_login') == "yes") {



                                $user_id = $this->session->userdata('user_id');

                                ?>

                                Here

                                <li><a target = "_blank" href="<?php echo $this->crud_model->product_link($pro['product_id']); ?>?rate=1"><i class="fa-solid fa-star"></i></a></li>

                                <li><span class="btn" onclick="to_wishlist(<?= $pro['product_id']?>,event)" data-toggle="tooltip" data-placement="right" data-original-title="Add To Wishlist">

                            <i class="fa fa-heart"></i>

                        </span></li>

                                <?php

                            }

                            else

                            {

                                ?>

                                <li><a target = "_blank" href="<?php echo base_url('home/login_set/login'); ?>"><i class="fa-solid fa-star"></i> </a></li>

                                <?php

                            }

                            ?>



                        </ul>

                    </div>

                </div>

            </div>

            <?php

        }

        ?>



    </div>

</div>







<div class="tabs_wrap">

    <div class="container  ">

        <div class="inner_tabs">

            <ul class="tabs__box">

                <?php

                if($pro['default_tab'] == 'tab_3'){?>

                    <li class="tab-link__box <?= isset($pro['default_tab']) && $pro['default_tab'] == 'tab_3' ?"current":""; ?>" data-tab="tab_3">Blogs</li>
                    

                    <li class="tab-link__box" data-tab="tab_1">Profile</li>
                    
                    <?php
                    $lmod = array();
                    
                    foreach($mods as $k=> $v)
                    {
                        $lmod[] = $v['id'];
                        ?>
                        <li class="tab-link__box" data-tab="tab_m<?= $v['id'] ?>"><?= $v['bpage_text']; ?></li>
                        <?php
                    }
                    ?>

                    <li class="tab-link__box " data-tab="tab_5">Store
                     
                        <ul class="bp_hover_box">
                            <li><a href="">All listing</a></li>
                            <li><a href=""></a>Directory</li>
                            <li><a href=""></a>Shop</li>
                        </ul>
                    
                    </li>

                    <li class="tab-link__box" data-tab="tab_6">Reviews</li>

                    <?php

                }else{



                    ?>

                    <li class="tab-link__box <?= isset($pro['default_tab']) && $pro['default_tab'] == 'tab_1' ?"current":""; ?>" data-tab="tab_1">Profile</li>

                    <?php
                    $lmod = array();
                    
                    foreach($mods as $k=> $v)
                    {
                        $lmod[] = $v['id'];
                        ?>
                        <li class="tab-link__box" data-tab="tab_m<?= $v['id'] ?>"><?= $v['bpage_text']; ?></li>
                        <?php
                    }
                    ?>

                    <li class="tab-link__box bp_hover_box_parent" data-tab="tab_5">Store
                    
                        <ul class="bp_hover_box">
                            <li><a href="">All listing</a></li>
                            <li><a href=""></a>Blogs</li>
                            <li><a href=""></a>Products</li>
                        </ul>
                        </li>

                    <li class="tab-link__box" data-tab="tab_6">Reviews</li>

                    <?php

                }

                ?>

            </ul>





        </div>

    </div>
    <div id="tab_5" class="tab-content__box">
        ><?php
        //$vid
    $pros = $this->db->get('product')->result_array();
        ?>

        <div class="container ">
            <div class="row">
            <?php

            foreach($pros as $sing)

            {
                $arr = json_decode($sing['added_by'],true);
                if(isset($arr['type']) && $arr['type'] == 'vendor' && $arr['id'] == $vid && !in_array($sing['module'],$othen))
                {
                ?>



                <div class="col-md-4">

                        <?php

                        echo $this->html_model->product_box($sing, 'grid', 1);

                        ?>

                    </div>
                    <?php
                }

            }

            ?>
            </div>



        </div>

    </div>
    
    <?php

foreach($mods as $k=> $v)
{
    
    
    ?>
    <div id="tab_m<?= $v['id'] ?>" class="tab-content__box">
        ><?php
        $mid = $v['id'];
        //$vid
    $pros = $this->db->where('module',$mid)->get('product')->result_array();
        ?>

        <div class="container ">
            <div class="row">
            <?php

            foreach($pros as $sing)

            {
                $arr = json_decode($sing['added_by'],true);
                if(isset($arr['type']) && $arr['type'] == 'vendor' && $arr['id'] == $vid)
                {
                ?>



                <div class="col-md-4">

                        <?php

                        echo $this->html_model->product_box($sing, 'grid', 1);

                        ?>

                    </div>
                    <?php
                }

            }

            ?>
            </div>



        </div>

    </div>
    <?php
}
?>

    <div id="tab_1" class="tab-content__box <?= isset($pro['default_tab']) && $pro['default_tab'] == 'tab_1' ?"current":""; ?>">
        <div class="advertise_wrap" style="padding-bottom: 0;">

            <div class="clipart">

                <?php



                // $cover = base_url().'template/front/images/info-graphic.png';

                if($pro['firstImg']) {

                    $cover = $this->crud_model->size_img($pro['firstImg'],820,312);

                }

                ?>

                <!--<img src="<?= base_url(); ?>template/front/images/business_graphic-clipart.png" alt="">-->

            </div>

            <div class="container  ">

                <?php

                if(in_array('service_description',$checks) || true)

                {

                    ?>

                    <div class="row section_spacing_bottom" id="advertise_info">

                        <div class="col-sm-4 business_graphic " id="business__graphic">



                            <img src="<?= $cover; ?>" alt="">

                        </div>

                        <div class="col-sm-8 communitybox"  >

                            <b><?= $pro['slogan'] ?></b>

                            <h3><?= $pro['main_heading'] ?></h3>

                            <div class="scroll" id="scrol_9sec" >

                                <div class="desc">
                                    <p ><?= nl2br($pro['description']) ?></p>
                                </div>

                                <ul class="listing_none">

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

                            </div>

                            <div id="equal_btnw1" style="    margin-bottom: 15px;">

                                <div class="learn_more_btn_bp" style="padding:0px;">

                                    <?php

                                    if(isset($pro['buttons']) && !empty($pro['buttons'])){

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

                                    }

                                    ?>

                                </div>

                            </div>



                        </div>

                    </div>

                    <?php

                }

                ?>
                <div class="sec_div_wrap section_spacing_top section_spacing_bottom">

                <?php

                //extra_info



                if(in_array('extra_info',$checks) || true)

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

                    <div class="pro_business" id="boxes___3">

                        <h3><?= $pro['extra_section_heading'] ?></h3>

                    </div>

                    <div class="row" id="left_gp">

                        <?php

                        for($i= 1; $i<=$num; $i++)
                        {
                            if(!$content[$k]['data']) {
                                unset($content[$k]);
                            }
                        }
                        for($i= 1; $i<=$num; $i++)

                        {
                            $k = $i -1;
                            if(strip_tags($content[0]) != "" && strip_tags($content[1]) != "" && strip_tags($content[2]) != ""){
                                $class = 4;
                            } elseif(strip_tags($content[0]) != "" && strip_tags($content[1]) != "" && strip_tags($content[2]) == ""){
                                $class = 6;
                            } elseif(strip_tags($content[0]) != "" && strip_tags($content[1]) == "" && strip_tags($content[2]) == ""){
                                $class = 12;
                            }
                            if($content[$k]['data']) {
                                ?>

                                <div class="col-sm-<?= $class ?> webdesign">

                                    <div class="inner_box_design height_auto scroll"
                                         style="overflow-y: scroll;height:324px;min-height: 324px;max-height: 324px;">

                                        <p class="box_with_img">
                                            <?php 
                                            if($content[$k]['type'] == 'img' && $content[$k]['data'])
                                            {
                                                ?>
                                                <img src="<?= base_url().$content[$k]['data'] ?>" class="extra_img" />
                                                <?php
                                            }
                                            else
                                            {
                                                echo $content[$k]['data'];
                                            }
                                            ?>
                                        </p>

                                    </div>

                                </div>

                                <?php


                            }
                        }

                        ?>

                    </div>

                    <?php

                }

                ?>
</div>
                <?php

                // if(in_array('event_images',$checks) && )
                if($imgs)

                {

                    ?>


                    <div class="dec_div_wrap">
                    <div class="verify_head section_spacing_top" id="left_gp">

                        <h3><?= $pro['gallery_lable']; ?></h3>

                        <p><?= $pro['gallery_text']; ?></p>

                    </div>

                    <?php

                }

                ?>


            </div>

            <?php

            if(true){

            ?>



        <?php

        if($imgs)

        {

            $first = '';

            if(isset($imgs[0]))

            {

                $first =  $this->crud_model->size_img($imgs[0]['img'],500,500);

            }

            $scd = '';

            if(isset($imgs[1]))

            {

                $scd =  $this->crud_model->size_img($imgs[1]['img'],500,500);

            }

            $thrd = '';

            if(isset($imgs[2]))

            {

                $thrd =  $this->crud_model->size_img($imgs[2]['img'],500,500);

            }

            ?>

            <div class="container  ">



                <!-- new slider -->



                <div class="slider_gallery__box">

                    <div class="row">

                        <div class="col-sm-9 left__slidebos">

                            <div class="large_sliderbox">

                                <img src="<?= $first ?>" data-src="<?= $first ?>" id="large_img" cur="0" ondblclick="opengal('0')" class="galimg" index="0" alt="">

                            </div>

                            <div class="arrow__left">

                                <a href="javascript:void(0)" onclick="gopre()"><i class="fa fa-angle-left"></i></a>

                            </div>

                            <div class="arrow__right">

                                <a href="javascript:void(0)"  onclick="gonext()"><i class="fa fa-angle-right"></i></a>

                            </div>

                        </div>



                        <div class="col-sm-3 right__boxlighbox" id="right_slider">



                            <a>

                                <img src="<?= $scd ?>" class="galimg thumb" onclick="selImg(1)"  ondblclick="opengal('1')" index="1">

                            </a>

                            <!-- first image box webdevtrick.com -->

                            <a >

                                <img  style="margin-bottom: 13px;" src="<?= $thrd ?>"  onclick="selImg(2)" class="galimg thumb" index="2"  ondblclick="opengal('2')">

                            </a>

                            <!-- second image box webdevtrick.com -->



                        </div>



                        <div class="col-sm-12 right__boxlighbox responisve_slider_img">

                            <?php

                            $i = 0;
                            if(count($imgs) >3 ) {
                                foreach ($imgs as $k => $v) {

                                    $i = $i + 1;

                                    if ($k > 2 && $k <= 6) {


                                        $img = $this->crud_model->size_img($v['img'], 500, 500);

                                        ?>

                                        <a href="#img<?= $k ?>">

                                            <img src="<?= $img ?>" class="galimg thumb" index="<?= $k ?>"
                                                 onclick="selImg(<?= $k ?>)" ondblclick="opengal('0')"/>

                                        </a>

                                        <!-- first image box webdevtrick.com -->


                                        <?php

                                    } elseif ($k > 6) {

                                        $img = $this->crud_model->size_img($v['img'], 500, 500);

                                        ?>

                                        <input type="hidden" class="galimg" src="<?= $img ?>"
                                               index="<?= $k; ?>"/>

                                        <?php

                                    }

                                }
                            }
                            ?>





                        </div>



                        <!-- popup -->

                        <div class="lightbox" id="popup_lightbox">

                            <a onclick="gopre(1)" class="light-btn btn-prev"><i class="fa fa-angle-left"></i></a>

                            <a   class="btn-close"><i class="fa fa-close"></i></a>

                            <img src="<?= $first ?>" id="glarge" style="opacity:1;" cur= "0">

                            <a href="" onclick="gonext(1)" class="light-btn btn-next"><i class="fa fa-angle-right"></i></a>

                        </div>

                    </div>

                </div>





                <div class="gallerybox" style="display: none;">

                    <div class="row">

                        <div class="col-sm-8 left_box">

                            <div class="bigbox_gallery inner_gallery">

                                <img src="<?= $first; ?>" alt="">

                                <div class="overlay_box">

                                    <!--<h4>Marketing Strategy</h4>-->

                                    <!--<h2>Digital Agency Template</h2>-->

                                    <!--<p>-->

                                    <!--    <img src="<?= base_url(); ?>template/front/images/girl.png" alt=""> -->

                                    <!--    <span class="name_avatar">Tamim Islam</span> -->

                                    <!--    <span class="star_box">-->

                                    <!--        <img src="<?= base_url(); ?>template/front/images/Star.png">-->

                                    <!--        <img src="<?= base_url(); ?>template/front/images/Star.png">-->

                                    <!--        <img src="<?= base_url(); ?>template/front/images/Star.png">-->

                                    <!--        <img src="<?= base_url(); ?>template/front/images/Star.png">-->

                                    <!--        <img src="<?= base_url(); ?>template/front/images/Star.png">-->

                                    <!--    </span>-->

                                    <!--</p>-->

                                </div>

                            </div>

                        </div>

                        <div class="col-sm-4 right_box">

                            <div class="small_box_gallery inner_gallery">

                                <img src="<?= $scd; ?>" alt="">

                                <div class="overlay_box">

                                    <!--<h4>Marketing Strategy 2nd</h4>-->

                                    <!--<h2>Digital Agency Template</h2>-->

                                    <!--<p>-->

                                    <!--    <img src="<?= base_url(); ?>template/front/images/girl.png" alt=""> -->

                                    <!--    <span class="name_avatar">Tamim Islam</span> -->

                                    <!--    <span class="star_box">-->

                                    <!--        <img src="<?= base_url(); ?>template/front/images/Star.png">-->

                                    <!--        <img src="<?= base_url(); ?>template/front/images/Star.png">-->

                                    <!--        <img src="<?= base_url(); ?>template/front/images/Star.png">-->

                                    <!--        <img src="<?= base_url(); ?>template/front/images/Star.png">-->

                                    <!--        <img src="<?= base_url(); ?>template/front/images/Star.png">-->

                                    <!--    </span>-->

                                    <!--</p>-->

                                </div>

                            </div>

                            <div class="small_box_gallery inner_gallery">

                                <img src="<?= $thrd; ?>" alt="">

                                <div class="overlay_box">

                                    <!--<h4>Marketing Strategy 3rd</h4>-->

                                    <!--<h2>Digital Agency Template</h2>-->

                                    <!--<p>-->

                                    <!--    <img src="<?= base_url(); ?>template/front/images/girl.png" alt=""> -->

                                    <!--    <span class="name_avatar">Tamim Islam</span> -->

                                    <!--    <span class="star_box">-->

                                    <!--        <img src="<?= base_url(); ?>template/front/images/Star.png">-->

                                    <!--        <img src="<?= base_url(); ?>template/front/images/Star.png">-->

                                    <!--        <img src="<?= base_url(); ?>template/front/images/Star.png">-->

                                    <!--        <img src="<?= base_url(); ?>template/front/images/Star.png">-->

                                    <!--        <img src="<?= base_url(); ?>template/front/images/Star.png">-->

                                    <!--    </span>-->

                                    <!--</p>-->

                                </div>

                            </div>

                        </div>

                    </div>



                    <div class="row">

                        <?php

                        $i = 0;

                        foreach ($imgs as $key => $value) {

                            $i++;

                            $img = $this->crud_model->size_img($value['img'],500,500);

                            if($key > 2)

                            {

                                ?>

                                <div class="col-sm-4 right_box">

                                    <div class="small_box_gallery inner_gallery">

                                        <img src="<?= $img; ?>" alt="">

                                        <div class="overlay_box"></div>

                                    </div>



                                </div>

                                <?php

                            }

                        }

                        ?>

                    </div>

                </div>

            </div>

            <?php

        }

        ?>











        <?php

        if(in_array('text_gallery',$checks) || true)

        {

        ?>

            <div class="container">
            <div class="third_sec_wrap section_spacing_top section_spacing_bottom">
                <div class="verify_head ">

                    <h3><?= $pro['gtitle'] ?></h3>

                    <p><?= $pro['gdesc'] ?></p>

                </div>

                <div class="inner_content_tabs">

                    <!--</select>-->

                    <div class="row" id="left_gp">

                    </div>

                    <div class="row" id="left_gp">

                        <ul class="tabs__ gtxt">

                            <?php

                            $vid = 0;

                            $added_by = json_decode($pro['added_by'], true);

                            if(isset($added_by['type']) && $added_by['type'] == 'vendor')
                            {

                                $vid = $added_by['id'];

                            }

                            $feature  = $this->db->where('vid',$vid)->get('textg')->result_array();

                            $count = count($feature);

                            echo $count;

                            if($feature && $count == 1)
                            {

                                $i = 0;

                                foreach($feature as $k=> $value)

                                {

                                    $value['ficon'] = $value['icon'];

                                    // var_dump($value);

                                    $i++;

                                    $tab = 'tab-'.$i.'__';

                                    ?>



                                    <?php

                                }

                            }  elseif($feature && $count == '2' )

                            {

                                $i = 0;

                                foreach($feature as $k=> $value)

                                {

                                    $value['ficon'] = $value['icon'];

                                    // var_dump($value);

                                    $i++;

                                    $tab = 'tab-'.$i.'__';

                                    ?>

                                    <li class="tab-link__ <?= ($i == 1)?"current__":""; ?>" data-tab="<?= $tab ?>"  style="width:47%;"><b><i class="fa-solid <?=$value['ficon'] ?>"></i></b> <p><?=$value['title'] ?></p></li>

                                    <?php

                                }

                            } elseif($feature && $count == '3' )

                            {

                                $i = 0;

                                foreach($feature as $k=> $value)

                                {

                                    $value['ficon'] = $value['icon'];

                                    // var_dump($value);

                                    $i++;

                                    $tab = 'tab-'.$i.'__';

                                    ?>

                                    <li class="tab-link__ <?= ($i == 1)?"current__":""; ?>" data-tab="<?= $tab ?>"  style="width:31%;"><b><i class="fa-solid <?=$value['ficon'] ?>"></i></b> <p><?=$value['title'] ?></p></li>

                                    <?php

                                }

                            }elseif($feature && $count == '4' )

                            {

                                $i = 0;

                                foreach($feature as $k=> $value)

                                {

                                    $value['ficon'] = $value['icon'];

                                    // var_dump($value);

                                    $i++;

                                    $tab = 'tab-'.$i.'__';

                                    ?>

                                    <li class="tab-link__ <?= ($i == 1)?"current__":""; ?>" data-tab="<?= $tab ?>"  style="width:23%;"><b><i class="fa-solid <?=$value['ficon'] ?>"></i></b> <p><?=$value['title'] ?></p></li>

                                    <?php

                                }

                            }elseif($feature && $count == '5' )

                            {

                                $i = 0;

                                foreach($feature as $k=> $value)

                                {

                                    $value['ficon'] = $value['icon'];

                                    // var_dump($value);

                                    $i++;

                                    $tab = 'tab-'.$i.'__';

                                    ?>

                                    <li class="tab-link__ <?= ($i == 1)?"current__":""; ?>" data-tab="<?= $tab ?>"  style="width:18%;"><b><i class="fa-solid <?=$value['ficon'] ?>"></i></b> <p><?=$value['title'] ?></p></li>

                                    <?php

                                }

                            }elseif($feature && $count == '6' )

                            {

                                $i = 0;

                                foreach($feature as $k=> $value)

                                {

                                    $value['ficon'] = $value['icon'];

                                    // var_dump($value);

                                    $i++;

                                    $tab = 'tab-'.$i.'__';

                                    ?>

                                    <li class="tab-link__ <?= ($i == 1)?"current__":""; ?>" data-tab="<?= $tab ?>"  style="width:14%;"><b><i class="fa-solid <?=$value['ficon'] ?>"></i></b> <p><?=$value['title'] ?></p></li>

                                    <?php

                                }

                            }elseif($feature)
                            {

                                $i = 0;

                                foreach($feature as $k=> $value)

                                {

                                    $value['ficon'] = $value['icon'];

                                    // var_dump($value);

                                    $i++;

                                    $tab = 'tab-'.$i.'__';

                                    ?>

                                    <li class="tab-link__ <?= ($i == 1)?"current__":""; ?>" data-tab="<?= $tab ?>"><b><i class="fa-solid <?=$value['ficon'] ?>"></i></b> <p><?=$value['title'] ?></p></li>

                                    <?php

                                }

                            }

                            ?>



                        </ul>

                        <?php

                        if($feature)

                        {

                            $i = 0;

                            foreach($feature as $k=> $value)

                            {

                                $value['ficon'] = $value['icon'];
                                $media = $value['img'];

                                $value['img'] = $this->crud_model->get_img($value['img'])->secure_url;
                                $path = $this->crud_model->get_img($media)->path;

                                $i++;

                                $tab = 'tab-'.$i.'__';

                                ?>

                                <div id="<?= $tab ?>" class="tab-content__ <?= ($i == 1)?"current__":""; ?>">

                                    <?php
                                    if(!$value['img'] || !file_exists($path)){

                                        ?>

                                        <div class="row" id="advertise_info" style="">



                                            <div class="col-sm-12 communitybox " id="community">

                                                <h3> <?= $value['title'] ?></h3>

                                                <div class="desc">

                                                    <p> <?= $value['detail'] ?></p>

                                                </div>

                                            </div>

                                        </div>

                                        <?php

                                    }else{

                                        ?>

                                        <div class="row fix_height" id="advertise_info" style="padding-top:16px;">

                                            <div class="col-sm-4 business_graphic" id="leftboxx">

                                                <img src=" <?= $value['img'] ?>" alt="">

                                            </div>

                                            <div class="col-sm-8 communitybox no_box_bd inner_box_design" id="equal_btnw">

                                                <h3> <?= $value['title'] ?></h3>

                                                <div class="desc">

                                                    <p> <?= $value['detail'] ?></p>

                                                </div>

                                            </div>

                                        </div>

                                        <?php

                                    }

                                    ?>



                                </div>

                                <?php

                            }

                        }

                        ?>



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



            <!--about-->

            <?php

            if(in_array('about',$checks) || true)

            {

                ?>

                <div class="container ">
                    <div class="main_wrp section_spacing_bottom section_spacing_top">



                        

                        <div class="row">
                           

                            <?php
                            

                            if(trim($pro['about_desc']))

                            {  // var_dump($pro['about_desc']);

                                ?>

                                <div class="col-sm-8 left_9bx">
                 <div class="verify_head ">

                            <h3><?= $pro['about_title']; ?></h3>

                        </div>
                        
                                    <div class="shadow_9" id="__space">
                                
                                        <div style="padding-bottom:10px;"> <p><?= $pro['about_desc']; ?></p></div>



                                        <!--nimra code-->

                                        <div class="learn_more_btns" style="text-align: center;">

                                            <?php

                                            $user = $this->session->userdata('user_id');

                                            if($pro['is_affiliate'] = '1' && $user)

                                            {

                                                $vid = 0;

                                                $added_by = json_decode($pro['added_by'], true);

                                                if(isset($added_by['type']) && $added_by['type'] == 'vendor')

                                                {

                                                    $vid = $added_by['id'];

                                                }



                                                $wish = $this->crud_model->is_aff($pro['id']);

                                                ?>

                                                <button class="btn btn-add-to <?php if($wish == 'yes'){ echo 'wished';} else{ echo 'wishlist';} ?>" onclick="to_affliate(<?php echo $vid; ?>,event)" style="background: #f26922;color: #fff;">

                                                    <i class="fa fa-heart"></i>

                                                    <span class="hidden-sm hidden-xs">

							<?php if($wish == 'yes'){

                                echo translate('_added_to_affliate');

                            } else {

                                echo translate('_add_to_affliate');

                            }

                            ?>



                        </span>

                                                </button>

                                                <?php

                                            }

                                            ?>



                                        </div>

                                        <!--nimra code-->

                                        <!--<div class="learn_more_btns" style="text-align: center;">-->

                                        <!--    <a href="#" class="our_projects" style="">Add to Affiliates</a>-->

                                        <!--</div>-->

                                        <!--<h4>Company Introduction</h4>-->

                                        <!--<p>Hire our experienced team of programmers, digital designers, and marketing professionals, who know how to deliver results. With your requirements, we will help you identify your needs to reach solutions</p>-->

                                    </div>
                                </div>
                                    <div class="container ">

                                        <div class="row">
                                            <div class="col-md-8">

                                            <?php
                                                $cat = explode(',',$pro['amenities']);
                                            if($cat){

                                                ?>

                                                <div class="no_pdding" id="add_rigth">

                                                    <div class="tag_sec_wrapper">

                                                        <div class="head_section">

                                                            <h4>Amenities</h4>

                                                        </div>

                                                        <div class="inner_sec">

                                                            <div class="ammen_container" style="height:auto; overflow: hidden;">

                                                                <?php

                                                                

                                                                foreach($cat as $kk=>$k){

                                                                    ?>

                                                                    <div class="tags_in">

                                                                        <span><img src="<?= base_url(); ?>/upload/checkk.png" alt=""></span>

                                                                        <span><?= $k; ?></span>

                                                                    </div>

                                                                    <?php

                                                                }

                                                                ?>

                                                            </div>
<?php
if(count($cat))
{
?>
                                                            <div class="amen_more more-link" align="center" style="    width: 100%;
    border-top: 1px solid rgb(233 158 20 / 36%);
    background: #fdfbfb;
    padding: 10px;
    cursor: pointer;
    font-size: 12px;
    color: #f16622;">View More</div>
<?php
}
?>

                                                        </div>

                                                    </div>



                                                </div>

                                                <?php

                                            }

                                            ?>

                                            <div class="no_pdding">

                                                <div class="tag_sec_wrapper">

                                                    <div class="head_section">

                                                        <h4>CATEGORIES</h4>

                                                    </div>

                                                    <div class="inner_sec">

                                                        <div class="tag_container " style="height:auto;overflow:hidden">

                                                            <?php

                                                            $cat = explode(',',$pro['cats']);

                                                            foreach($cat as $k){

                                                                ?>

                                                                <div class="tags_in">

                                                                    <span><img src="<?= base_url(); ?>/upload/checkk.png" alt=""></span>

                                                                    <span><?= $k; ?></span>

                                                                </div>

                                                                <?php

                                                            }

                                                            ?>



                                                        </div>
                                                                                                                    <?php
if(count($cat))
{
?>
                                                            <div class="tag_more" align="center" style="    width: 100%;
    border-top: 1px solid rgb(233 158 20 / 36%);
    background: #fdfbfb;
    padding: 10px;
    cursor: pointer;
    font-size: 12px;
    color: #f16622;">View More</div>
<?php
}
?>

                                                    </div>

                                                </div>

                                            </div>
                                            </div>
                                                <?php

                            }

                            if(trim($pro['about_address']))

                            {

                                ?>

                                <div class="col-md-4 left_9bx" id="right___gap">

                                    <div class="shadow_9 icons_links" id="bg__social">



                                        <?php if(isset($pro['about_address']) && !empty($pro['about_address'])){

                                            ?>

                                            <div class="margin-bottom"><i class="fa fa-map-marker"></i> <?= $pro['about_address'];?></div>

                                            <?php

                                        }if(isset($pro['bussniuss_phone']) && !empty($pro['bussniuss_phone'])){



                                            ?>

                                            <div class="margin-bottom"><i class="fa fa-phone"></i> <?= $pro['bussniuss_phone'];?></div>

                                            <?php

                                        }if(isset($pro['whatsapp_number']) && !empty($pro['whatsapp_number'])){



                                            ?>

                                            <div class="margin-bottom"><i class="fa fa-whatsapp"></i> <?= $pro['whatsapp_number'];?></div>

                                            <?php

                                        }if(isset($pro['bussniuss_email']) && !empty($pro['bussniuss_email'])){



                                            ?>

                                            <div class="margin-bottom"><i class="fa fa-envelope"></i> <?= $pro['bussniuss_email'];?></div>

                                            <?php

                                        }if(isset($pro['openig_time']) && !empty($pro['openig_time'])){



                                            ?>

                                            <div  class="margin-bottom"><i class="fa fa-clock"></i> <?= date("g:ia", strtotime( $pro['openig_time'])) .' - '.date("g:ia", strtotime( $pro['closing_time'])) ;?></div>

                                            <?php

                                        }

                                        ?>

                                        <div class="" style="margin-top: 10px;">

                                            <?php

                                            $img='';

                                            $social_image = json_decode($pro['social_media']);

                                            foreach($social_image as $k =>$v){

                                                // var_dump($k);

                                                $row = $this->db->where('id', $k)->get('bpkg')->row();

                                                if($row->img){

                                                    $img = $this->crud_model->get_img($row->img)->secure_url;

                                                }

                                                if($v)

                                                {

                                                    ?>

                                                    <a href="<?= $v; ?>" target="_blank"><img style="width:25px;background: #fff; padding: 3px;margin-top: 10px;border-radius: 0px;" src="<?= $img; ?>"></a>

                                                    <?php

                                                }

                                            }

                                            ?>

                                        </div>

                                        <!--<h4>Address</h4>-->

                                        <!--<p>Hire our experienced team of programmers, digital designers, and marketing professionals</p>-->

                                    </div>

                                </div>

                                <?php

                            }

                            ?>



                                        </div>

                                    </div>



                                </div>

                                

                        </div>

                    </div>

                <?php

            }

            ?>



            <!--<div class="container  ">-->

            <!--         <div class="inner_box_info" style="    padding: 10px 16px;">-->

            <!--         <h2>Tags</h2>-->

            <!--         <p>You can now list your</p>-->

            <!--     </div>-->



            <!--</div>-->



          

            <div class="container " style="display:<?= ($pro['info_desc'])?"block":"none" ?>">

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
            


           

        </div>
         <div class="orange_pathwrap" id="bpage_form">

                <div class="container ">

                    <div class="iframe_box">

                        <div id="googleMap" style="width:100%;height:550px;"></div>





                        <div class="getin_touch">
 
                            

  
  

                            <h3>Get In Touch <img src="<?= base_url(); ?>upload/phone_2.png" alt=""></h3>

                            <form action="" method="">

                                <input type="hidden" name="pid" id="pid1" value="<?= $pro['product_id']?>">

                                <div class="row">

                                    <div class="col-sm-6 form_gapp">

                                        <div class="form_box">

                                            <label for="First name">First name</label>

                                            <input type="text" placeholder="Type Your First Name" name="" id="fname__">

                                            <img src="<?= base_url(); ?>template/front/images/user-icon.png" alt="">

                                        </div>

                                    </div>

                                    <div class="col-sm-6 form_gapp">

                                        <div class="form_box">

                                            <label for="Last name">Last name</label>

                                            <input type="text" placeholder="Type Your Last Name" name="" id="lname">

                                            <img src="<?= base_url(); ?>template/front/images/user-icon.png" alt="">

                                        </div>

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-sm-12 form_gapp">

                                        <div class="form_box">

                                            <label for="Email">Email</label>

                                            <input type="email" placeholder="Type Your Email" name="" id="email__">

                                            <img src="<?= base_url(); ?>template/front/images/email.png" alt="">

                                        </div>

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-sm-12 form_gapp">

                                        <div class="form_box">

                                            <label for="Phone number">Phone number</label>

                                            <input type="number" placeholder="Type phone number" name="" id="phone">

                                            <img class="phone_iconn" src="<?= base_url(); ?>upload/phone_icon.png" alt="">

                                        </div>

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-sm-12 form_gapp">

                                        <div class="form_box">

                                            <label for="Message">Message</label>

                                            <textarea placeholder="Type Message" id="message__"></textarea>

                                            <img class="msg_iconn" src="<?= base_url(); ?>upload/message_1.png" alt="">

                                        </div>

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-sm-12 form_gapp">

                                        <div class="form_box">

                                            <button type="button" id="send">Send</button>

                                            <a style="    background: #F26122;
    border-radius: 4.28081px;
    Padding: 6px 83px;
    border: none;
    color: #fff;
    text-transform: uppercase;
    outline: 0;" href="https://maps.google.com/?q=<?= $pro['lat'] ?>,<?= $pro['lng'] ?>">
                                                GET DIRECTION
                                            </a>

                                        </div>

                                    </div>

                                </div>

                            </form>

                        </div>

                    </div>

                </div>

            </div>
            <div class="row">
                <div class="container ">
                <div class="col-md-12">
                    <?php
            if($pro['tag']){
        ?>
   <div class="tags_box box_icons">
       <h3>TAGS</h3>

                <div class="tags_out">

                    <?php

            $tags = $pro['tag'];

            $x = (explode(",",$tags));

            foreach($x as $K => $v){

                ?> 
                    <div class="tags_in tags_in_2" style="position:relative;">
                    <span><img src="<?= base_url(); ?>/upload/checkk.png" alt=""></span><span><?=  $v;?></span>
                    </div>
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
            </div>
             <div class="container " style="padding-top: 165px ;">

                <div class="container ">

                    <div class="verify_head section_spacing_top" style="    padding: 0 23px 0;">

                        <h3>You May Also be Interested In</h3>

                        <p>You can now list your business in less than 5 minutes</p>

                    </div>

                </div>

                <div class="row" id="rowmarign">
                    <?php
        include "feature_products.php";
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
        <div class="container ">

            <div class="row">

                <?php

                foreach($pros as $sing)

                {



                    $cats = explode(',', $sing['category']);

                    if (in_array(78, $cats) && $sing['is_bpage'] == 0)

                    {

                        ?>

                        <div class="col-md-4">

                            <?php

                            echo $this->html_model->product_box($sing, 'grid', 1);

                            ?>

                        </div>

                        <?php

                    }



                }

                ?>

            </div>



        </div>



    </div>
    <div id="tab_6" class="tab-content__box">

        <div class="container ">

            <div class="clients_box">

                <h3>Take a look what other clients say</h3>

                <h4>Would you like to review this business page?</h4>



            </div>

            <div class="col-sm-12 left__review">

                <div class="row make_display_block">
                    <div class="col-md-6">
                    <?php

                    // var_dump($pro);

                    $rating = $this->db->where('product_id', $pro['product_id'])->get('user_rating')->result_array();

                    foreach($rating as $k=> $v){

                        ?>

                        <div class="col-sm-12 cilent_gapp">

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

                                    echo $this->crud_model->rate_html($v['rating_num']);

                                    ?>

                                    <span><?= $v['rating'];?></span>

                                </div>

                            </div>

                        </div>

                        <?php

                    }

                    ?>

                </div>
                <div class="col-md-6">
                    <div class="col-sm-12 add__new_review" id="review_coment">

                <label> add new reviews</label>

                <form class="" action="<?= base_url('home/add_rate') ?>" id="rform" >

                    <div class=" border-color--default__09f24__NPAKY">

                        <div class=" css-14s1wf padding-t3__09f24__TMrIW padding-r3__09f24__eaF7p padding-b3__09f24__S8R2d padding-l3__09f24__IOjKY border-color--default__09f24__NPAKY" role="presentation">

                            <div class=" css-10687n6 margin-b3__09f24__l9v5d border-color--default__09f24__NPAKY" gap="1">

                                <div class=" css-1r871ch border-color--default__09f24__NPAKY">

                                    <fieldset class=" rating-selector__09f24__LNhhs">

                                        <div id="rateYo">
                                            <?php
                                            $tot = 5;
                                            for($i = 1 ; $i<=$tot;$i++)
                                            {
                                                ?>
                                                <span id="star<?= $i ?>" onclick="select_rate(<?= $i ?>)" class="fa fa-star"></span>
                                                <?php
                                            }
                                            ?>
 
                                        </div>

                                        <input type="hidden" value="0" name="rating" id="rate" />

                                        <input type="hidden" value="<?= $pro['product_id'] ?>" name="pid" id="pid" />

                                        <div class=" description__09f24__qRKe3 border-color--default__09f24__NPAKY" aria-hidden="true">

                                            <p class="description-text--non-zero__09f24__Ln52s css-qgunke"></p>

                                        </div>

                                    </fieldset>

                                </div>

                                <div class=" css-aurft1 border-color--default__09f24__NPAKY nowrap__09f24__lBkC2"></div>

                            </div>

                            <div class=" css-1bqnmih border-color--default__09f24__NPAKY">

                                <!-- <div class="css-1sdb4og" contenteditable="true" spellcheck="true" data-lexical-editor="true" style="user-select: text; white-space: pre-wrap; word-break: break-word;" role="textbox">

                                   <p><br></p>

                                </div> -->

                                <textarea name="comment" class="summernote" placeholder="Add comment here"></textarea>

                            </div>

                            <div class=" css-c7yo1x margin-t3__09f24__riq4X border-color--default__09f24__NPAKY background-color--white__09f24__ulvSM"></div>

                        </div>

                    </div>

                    <?php

                    $user = $this->session->userdata('user_id');

                    if($user){

                        ?>

                        <div class=" margin-t4__09f24__G0VVf padding-b6__09f24__hfdiP border-color--default__09f24__NPAKY" style="max-width:200px;"><button type="button" class=" css-hv9ohz" onclick="send_rate()" data-activated="false" data-testid="post-button" value="submit" data-button="true"><span class="css-1enow5j" data-font-weight="semibold">Post Review</span></button></div>

                        <?php

                    }else{

                        ?>

                        <div class=" margin-t4__09f24__G0VVf padding-b6__09f24__hfdiP border-color--default__09f24__NPAKY" style="max-width:100%;text-align:center;"><a href="<?= base_url('/login_set/login'); ?>"><button type="button"   class=" css-hv9ohz" data-activated="false" data-testid="post-button" value="submit" data-button="true"><span class="css-1enow5j" data-font-weight="semibold">Post Review</span></button></a></div>



                        <?php

                    }

                    ?>

                </form>

            </div>
                </div>
                </div>

            </div>

            

        </div>



    </div>



<div class="overlaypopup"></div>

<div class="popup_box">



    <div class="innerbox">



        <div class="alert alert-success d-none" id="success" role="alert">

            Reported Successfully!

        </div>

        <div class="alert alert-danger d-none" id="danger" role="alert">

            Please Try Again!

        </div>

        <div class="logo1">

            <h3>We'd Love to Hear From You</h3>

            <p>An individual wanting to get in touch or a home based business or large enterprise we welcome all!</p>

        </div>

        <form class="formbox" action="" method="">

            <input type="hidden" name="pid" id="pid" value="<?= $pro['product_id']?>">

            <div class="row">

                <div class="col-sm-12 sidegapp">

                    <div class="forminput">

                        <label>Name</label>

                        <input type="text" name="full_name" id="name" required>

                    </div>

                </div>

                <div class="col-sm-12 sidegapp">

                    <div class="forminput">

                        <label>Email</label>

                        <input type="email" name="email" id="email" required>

                    </div>

                </div>

                <div class="col-sm-12 sidegapp">

                    <div class="forminput">

                        <label>Message</label>

                        <textarea name="msg" id="msg" required></textarea>

                    </div>

                </div>

            </div>

            <div class="row">

                <div class="col-sm-12 sidegapp">

                    <div class="forminput ">

                        <!--<input type="button" class="submit" id="submit" value="Submit">-->

                        <button class="submit" name="report" id="report_submit" type="button">Submit</button>

                        <button type="button" class="close_btn">Close</button>

                    </div>

                </div>

            </div>

        </form>

    </div>

</div>



<div class="container  ">



    <div class="disqus_comment" >

        <div id="disqus_thread"></div></div>

</div>

<div class="flgicon">

    <a href="#" title="Report Site!"><i class="fa fa-flag"></i></a>

</div>
<script>
    $(".more-link").click(function () {
        var moreAndLess = $(this).html() == 'View More' ? 'View Less' : 'View More';
        $(this).text(moreAndLess);
        if($(".ammen_container  ").hasClass('height_auto')){
            $(".ammen_container  ").removeClass('height_auto');
        } else {
            $(".ammen_container  ").addClass('height_auto');
        }
    });
    $(".tag_more").click(function () {
        var moreAndLess = $(this).html() == 'View More' ? 'View Less' : 'View More';
        $(this).text(moreAndLess);
        if($(".tag_container  ").hasClass('height_auto')){
            $(".tag_container  ").removeClass('height_auto');
        } else {
            $(".tag_container  ").addClass('height_auto');
        }
    });
</script>
<script>

    $('#report_submit'). on ('click', function(e){





        $('.error').text('');

        var fname = $('#name').val();

        var email = $('#email').val();

        var msg = $('#msg').val();

        var pid = $('#pid').val();

        // alert(x);

        var url = "<?php echo base_url('home/report');?>"



        $.ajax({

            url: url,

            type: "get",

            async: true,

            data: {  fname:fname, email:email, message:msg,pid:pid },



            success: function (data) {



                if(data == 1){

                    alert('Email Sent');

                    $("#success").attr("class", "alert alert-success d-block");

                }else{

                    $("#danger").attr("class", "alert alert-danger d-block");

                }



            }



        });

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

        var pid = $('#pid1').val();

        $.ajax({

            url: url,

            type: "get",

            async: true,



            data: {  fname:fname, email:email, message:msg,phone:phone,lname:lname,pid:pid },

            success: function (data) {

                // const myArr = JSON.parse(JSON.stringify(data));

                if(data == 1){

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
        divElement = document.querySelector(".ammen_container");
 
        elemHeight = divElement.offsetHeight;
        if(elemHeight >=45)
        {
            var r = $('.ammen_container').css('height','45px');
            
            $('.amen_more').show();
        }
        else
        {
            $('.amen_more').hide();
        }
        divElement = document.querySelector(".tag_container");
 
        elemHeight = divElement.offsetHeight;
        if(elemHeight >=45)
        {
            var r = $('.tag_container').css('height','45px');
            
            $('. ').show();
        }
        else
        {
            $('.tag_more').hide();
        }
        



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

<!--slider-->

<script>

    function find_pre(cur)

    {

        cur = parseInt(cur);

        cur = cur -1;

        //      var is_find = 0;

        //      var ocur = cur

        //     $('.galimg').each(function(i, obj) {

        //         var num = parseInt($(this).attr('index'));

        //         console.log(num+' test '+cur);

        // if(num < cur)

        // {

        //     cur = num;

        //     is_find = 1;

        // }



// });

        if(cur < 0)

        {

            cur = $('.galimg').size() -1;

        }

        return cur;

    }

    function opengal(next)

    {

        $("#popup_lightbox").show();

        $("#popup_lightbox").css("opacity","1");

        $("#popup_lightbox").css("display","block");

        $("#popup_lightbox").css("width","100%");

        $("#popup_lightbox").css("height","100vh");

        var src = show_img(next);

        $('#glarge').attr('src',src);

        $('#glarge').attr('cur',next);

    }

    function find_next(cur)

    {

        cur = parseInt(cur);

        var is_find = 0;

        $('.galimg').each(function(i, obj) {

            var num = parseInt($(this).attr('index'));

            console.log(num);

            if(is_find == 0 && num > cur)

            {

                cur = num;

                is_find = 1;

            }



        });

        if(is_find == 0)

        {

            cur = 0;

        }

        return cur;

    }

    function show_img(ind)

    {



        ind = parseInt(ind);

        var src = '';



        $('.galimg').each(function(i, obj) {

            var num = parseInt($(this).attr('index'));

            // console.log(num+' test '+ ind);

            if(num == ind)

            {

                if(!ind)

                {

                    src = $(this).attr('data-src');

                }

                else

                {

                    src = $(this).attr('src');

                }

                // is_find = 1;

            }



        });

        return src;

    }



    function selImg(next)

    {

        var src = show_img(next);

        $('#large_img').attr('src',src);

        $('#large_img').attr('cur',next);



    }

    function gopre(type = 0)

    {

        var cur = $('#large_img').attr('cur');

        if(type)

        {

            cur = $('#glarge').attr('cur');

        }

        var next = find_pre(cur);

        var src = show_img(next);

        if(type)

        {

            $('#glarge').attr('src',src);

            $('#glarge').attr('cur',next);

        }

        else

        {

            $('#large_img').attr('src',src);

            $('#large_img').attr('cur',next);

        }



    }

    function gonext(type = 0)

    {

        var cur = $('#large_img').attr('cur');

        if(type)

        {

            cur = $('#glarge').attr('cur');

        }

        var next = find_next(cur);

        var src = show_img(next);

        if(type)

        {

            $('#glarge').attr('src',src);

            $('#glarge').attr('cur',next);

        }

        else

        {

            $('#large_img').attr('src',src);

            $('#large_img').attr('cur',next);

        }





    }

    $(document).ready(function(){

        $('.summernote').summernote();

    });

</script>

<script type="text/javascript">

    $(".btn-close").click(function(){

        $("#popup_lightbox").hide();

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
    function select_rate(r)
    {
        $('#rate').val(r);
        var tot = '<?= $tot ?>';
        for(var i=1;i<=tot;i++)
        {
            var mid = '#star'+i;
            if(i<= r)
            {
                $(mid).addClass('checked');
            }
            else
            {
                $(mid).removeClass('checked');
            }
        }
    }

    function send_rate(){
        var form = $('#rform');

        var here = $(this);

        $.ajax({

            url: form.attr('action')+'?'+form.serialize(), // form action url

            type: 'POST', // form submit method get/post

            dataType: 'html', // request type html/json/xml

            data: form.serialize(), // serialize form data

            cache       : false,

            contentType : false,

            processData : false,

            beforeSend: function() {

                here.addClass('disabled');

                here.html('submitting'); // change submit button text

            },

            success: function(data) {

                here.fadeIn();

                here.html('Post Review');

                here.removeClass('disabled');

                if(data == '1'){

                    notify('Review add successfully!','success','bottom','right');

                    window.location.replace("<?php echo $this->crud_model->product_link($pro['product_id']); ?>");



                }else {

                    notify(data,'warning','bottom','right');

                }

            },

            error: function(e) {

                console.log(e)

            }

        });

    }

</script>



<script src="https://maps.googleapis.com/maps/api/js?key=<?= $this->config->item('map_key'); ?>&callback=myMap"></script>

<script src="<?= base_url();?>template/front/js-files/custom.js"></script>

<script>

    $('#shareit').click(function(){

        // alert();

        // sharethis-inline-share-buttons

        $('.sharethis-inline-share-buttons').show();

    })

</script>



















<script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=63788bcc6611ec0019d8d89c&product=inline-share-buttons&source=platform" async="async"></script>
