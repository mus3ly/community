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
    <link type="text/css" rel="stylesheet" href="<?= base_url(); ?>template/front/css-files/owl.carousel.css" />

</head>
<body id="page-name">



<div class="main_warp">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 graphic_img">

<?php
                                            $top_banner     =  $this->db->get_where('ui_settings',array('ui_settings_id' => '62'))->row();
                                            if($top_banner)
                                            {
                                             $img = $this->crud_model->get_img($top_banner->value)->secure_url;
                                         }

                                        ?>
                <img src="<?= $img ?>" alt="">
            </div>
            <div class="col-sm-6 perfect_place">
                <h5>Amet consectetur adipisicing New</h5>
                <h3>Find Your <b>Perfect Place.</b></h3>
                <div class="search_bar">
                <form action="<?= base_url('/home/text_search'); ?>"  onkeyup="submitForm(event)" id="srch_form" method="post">
                    <img src="<?= base_url(); ?>template/front/images/Location.png" alt="Search">
                    <input type="text" placeholder="Find Your  Place"  name="query" alt="" onkeyup="submitForm(event)">
                    <button type="submit">Search</button>
                </form>
                </div>


                <div id="small-categories" class="owl-carousel owl-carousel-icons owl-loaded owl-drag">
                  <div class="owl-stage-outer">
                     <div class="owl-stage" style="transform: translate3d(-3002px, 0px, 0px); transition: all 0.25s ease 0s; width: 4804px;">
                        
                        <?php
                $categories =json_decode($this->db->get_where('ui_settings',array('ui_settings_id' => 35))->row()->value,true);
                                            $result=array();
                                            foreach($categories as $row){
                                                if($this->crud_model->if_publishable_category($row)){
                                                    $result[]=$row;
                                                }
                                            }
                                            // var_dump($brands);
                                            // die('OK');

                    foreach ($brands as $key => $value) {
                        if(in_array($value['category_id'], $result))
                        {
                            // echo $value['category_id'];
                        ?>
                            <div class="owl-item " >
                           <div class="item">
                              <div class="slider_box_icons">
                                <ul>
                                    <li ><a href="<?= base_url('home/category/'.$value['category_id']); ?>"><i class="fa <?= ($value['fa_icon'])?$value['fa_icon']:'fa-file-image-o'; ?>"></i>  <?= $value['category_name'] ?></a></li>
                                </ul>
                            </div>
                           </div>
                        </div>
                        <?php
                        }
                    }
                ?>
                        
                        
                        
                     </div>
                  </div>
                  <div class="owl-nav">
                     <button type="button" role="presentation" class="owl-prev"><i class="fa fa-angle-left"></i></button>
                     <button type="button" role="presentation" class="owl-next"><i class="fa fa-angle-right"></i> </button>
                  </div>
                  <div class="owl-dots disabled"></div>
               </div>

                
                
            </div>
        </div>
    </div>
</div>
<div class="right_dotted">
    <img src="<?= base_url(); ?>template/front/images/doted-lines-right.png" alt="">
</div>


<div class="list_business">
    <div class="container">
        <div class="plus_dot">
            <div class="right_plus">
                <img src="<?= base_url(); ?>template/front/images/plus-gray.png" alt="">
            </div>
            <h4><?php echo $this->crud_model->get_type_name_by_id('ui_settings','63','value'); ?></h4>
            <p><?php echo $this->crud_model->get_type_name_by_id('ui_settings','64','value'); ?></p>
            <div class="orange_plus">
                <img src="<?= base_url(); ?>template/front/images/orange-plus.png" alt="">
            </div>
        </div>
    </div>
</div>


<div class="icon_box_wrap">
    <div class="container">
        
        <div class="row">

        <?php
                $cboxes = unserialize($this->crud_model->get_type_name_by_id('ui_settings','65','value'));
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
                    <i class="fa <?= (isset($cboxes[$i]['icon'])?$cboxes[$i]['icon']:''); ?>" aria-hidden="true"></i>
                        <!-- <img src="<?= base_url(); ?>template/front/images/business-icon.png" alt=""> -->
                    </div>
                    <b><?= (isset($cboxes[$i]['heading'])?$cboxes[$i]['heading']:''); ?></b>
                    <ul>
                    <?= (isset($cboxes[$i]['detail'])?$cboxes[$i]['detail']:''); ?>
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
</div>

<div class="community_wrap">
    <div class="container">
        <div class="clipart">
            <img src="<?= base_url(); ?>template/front/images/business_graphic-clipart.png" alt="">
        </div>
        <div class="row">
            <div class="col-sm-6 communitybox every_business">
                <h3>Every Business has something to <span>offer their community</span></h3>
                <p>On Community HubLand, you list your Events, Jobs, Blogs, Properties, and more. All the basics your business needs for success</p>
                <ul>
                    <li><img src="<?= base_url(); ?>template/front/images/Tick-Square.png" alt=""> Own a business website</li>
                    <li><img src="<?= base_url(); ?>template/front/images/Tick-Square.png" alt=""> Access to your business affiliate marketing platform</li>
                    <li><img src="<?= base_url(); ?>template/front/images/Tick-Square.png" alt=""> Post products in shops and receive payments</li>
                    <li><img src="<?= base_url(); ?>template/front/images/Tick-Square.png" alt=""> Blog away with your audience</li>
                    <li><img src="<?= base_url(); ?>template/front/images/Tick-Square.png" alt=""> Post ads in any category</li>
                </ul>
                <b>Price?</b>
                <h5>Less than a the cost of a breakfast a month</h5>
            </div>
            <div class="col-sm-6 business_graphic">
                <?php
                                    $img = '';
                                            $top_banner     =  $this->db->get_where('ui_settings',array('ui_settings_id' => '66'))->row();
                                            if($top_banner)
                                            {
                                             $img = $this->crud_model->get_img($top_banner->value)->secure_url;
                                         }

                                        ?>
                <img src="<?= $img ?>" alt="">
                <div class="circle_clipart">
                    <img src="<?= base_url(); ?>template/front/images/circle-clipart.png" alt="">
                </div>
            </div>
        </div>
        <div class="dotted_lines_clipart">
            <img src="<?= base_url(); ?>template/front/images/dotted_lines_clipart.png" alt="">
        </div>
    </div>
</div>

<div class="orange_card">
    <div class="container">
        <div class="orange_card_box">
            <div class="full_circle">
                <img src="<?= base_url(); ?>template/front/images/business-card-right.png" alt="">
            </div>
            <p>COMMUNITY HUBLAND DIGITAL SERVICES</p>
            <h4>Professional Business Solutions <span>Designed For You</span></h4>
            <p class="hire_para">Hire our experienced team of programmers, digital designers, and marketing professionals, who <span>know how to deliver results. With your requirements, we will help you identify your needs to</span> reach solutions</p>
            <div class="row">
                <div class="col-sm-6 checkbox_tick">
                    <img src="<?= base_url(); ?>template/front/images/Tick-Square.png" alt="">
                    <h4>WEB & ENTERPRISE PORTALS</h4>
                    <p>Incredible UX and compelling functionality under the hood</p>
                </div>
                <div class="col-sm-6 checkbox_tick">
                    <img src="<?= base_url(); ?>template/front/images/Tick-Square.png" alt="">
                    <h4>ECOMMERCE DEVELOPMENT </h4>
                    <p>Fully customized eCommerce solution for your online store</p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 checkbox_tick">
                    <img src="<?= base_url(); ?>template/front/images/Tick-Square.png" alt="">
                    <h4>GRAPHICS ANALYSIS</h4>
                    <p>Solutions empowered with computer Graphic Designing</p>
                </div>
            </div>
            <div class="learn_more_btns">
                <a href="#" class="our_projects">OUR PROJECTS</a>
                <a href="#" class="learn_more">LEARN MORE</a>
            </div>
            <div class="bottom_circled">
                <img src="<?= base_url(); ?>template/front/images/bottom-circled.png" alt="">
            </div>
        </div>
    </div>
</div>


<div class="advertise_wrap">
    <div class="purple_line">
        <img src="<?= base_url(); ?>template/front/images/base-icon.png" alt="">
    </div>
    <div class="container">
        <div class="row" id="advertise_info">
            <div class="col-sm-6 business_graphic">
            <?php
                                    $img = '';
                                            $top_banner     =  $this->db->get_where('ui_settings',array('ui_settings_id' => '70'))->row();
                                            if($top_banner)
                                            {
                                             $img = $this->crud_model->get_img($top_banner->value)->secure_url;
                                         }

                                        ?>
                <img src="<?= $img ?>" alt="">
                <div class="purple_dot" style="top: auto;bottom: -61px;">
                        <img src="<?= base_url(); ?>template/front/images/purple.png" alt="">
                    </div>
            </div>
            <div class="col-sm-6 communitybox">
                <b>ADVERTISE ON COMMUNITY HUBLAND DIRECTORY SITE</b>
                <h3>Advertise your professional business on Community HubLand directory site</h3>
                <p>Reach larger interested audience with a digital presence that manage, monitor and consolidate all your business in one place. Get started with us and receive:</p>
                <ul>
                    <li>
                        <img src="<?= base_url(); ?>template/front/images/Tick-Square.png" alt="">
                         ADVERTISEMENT SPOT
                         <p>Get listed on main directory site under your industry</p>
                    </li>
                    <li>
                        <img src="<?= base_url(); ?>template/front/images/Tick-Square.png" alt="">
                         WEB PAGE
                         <p>You will be provided a web page where you can list more information about your business</p>
                    </li>
                    <li>
                        <img src="<?= base_url(); ?>template/front/images/Tick-Square.png" alt="">
                         AFFILIATE 
                         <p>Become an affiliate and earn great rewards Advertise with Us</p>
                    </li>
                </ul>
                <div class="learn_more_btns">
                <a href="#" class="our_projects">Advertise  With Us</a>
                    <div class="purple_dot">
                        <img src="<?= base_url(); ?>template/front/images/purple.png" alt="">
                    </div>
                </div>
                
            </div>
            
        </div>
    </div>
    <div class="upper_line_dot">
        <img src="<?= base_url(); ?>template/front/images/doted-lines-right.png" alt="">
    </div>
</div>
<?php
include "featured_products.php";
?>
<div class="container">
  <div class="row">
    <div class="col-lg-12">
      <center><a href="#"><button class="btn-lg" style="background-color:#F26122; color:white; border:none; margin-bottom:120px; font-family:Dosis!important; font-weight:200;">Join Community HubLand Affiliate Marketing</button></a></center>
    </div>
  </div>
</div>

<script src="https://ads.strokedev.net/template/front/js-files/jquery-3.2.1.min.js"></script>
<script src="https://ads.strokedev.net/template/front/js-files/owl.carousel.js"></script>
<script src="https://ads.strokedev.net/template/front/js-files/custom.js"></script>
          <script type="text/javascript">
              (function($) {
    
    /*---Owl-carousel----*/

    // ___Owl-carousel-icons
    var owl = $('.owl-carousel-icons');
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
                items: 8,
                nav: true
            }
        }
    })
 // ___Owl-carousel-icons

})(jQuery);
          </script>


