<?php

$url = base_url('updated/');

include "header_new.php";

?>
<style>


    #location-result ul li{
        cursor:pointer;
    }
    
    .hire_para b{
        font-weight:900;
        color:white;
    }
    .homeaboutimg{max-width:400px;width:100%}
    .homeabout h6{margin: 20px 0 0;}
    .homeabout .container{max-width:900px;}
    .homeabout.community_wrap{background:#fff;padding: 70px 0px 50px;
       
    }
    section.homeabout{
        z-index: 1;
    background: unset!important;
    margin-bottom: -390px;
    
    }
    .community_wrap ul li {
    display: flex;
    align-items: start;
}
@media screen and (max-width: 425px) {
    .container{
    padding:0 30px!important;
}
footer .img-box{
    padding:0!important;
}
.hero-title{
    font-size:30px!important;
}
.hero-title-tags{
    font-size:14px!important;
    line-height: 1.4;
}

.hero-title-s{
        font-size:24px!important;
}
.d-flex-al{
    

    display: flex;
    align-items: start;
}
.d-flex-al span{
    margin-top: 0px!important;
}
}

</style>

<main>

    <!-- Hero Section -->

    <section class="hero main_warp section_spacing_bottom first_section_space">

      <div class="container">

        <div class="first_wrap " data-aos="fade-up" data-aos-duration="1000">

          <div class="row align-items-end">



            <div class="col-lg-12 perfect_place">

              <div class="hero-contents-wrap">

                <h5 style="color:white; margin-bottom: 15px;">COMMUNITY HUBLAND - WHERE OPPORTUNITY MEETS COMMUNITIES

                </h5>
                <h1 class="hero-title" style="color:white; margin-bottom:10px; font-size: 35px">LOCAL BUSINESS COMMUNITY DIRECTORY</h1> 
                <h6 class="hero-title-tags" style="color:white; margin-bottom: 30px;">BUSINESSES<span class="text-divider color_white" style="top:-7px; font-weight: 400; font-size:15px;"></span>
                PRODUCTS<span class="text-divider color_white" style="top:-7px; font-weight: 400;"></span>
                SERVICES<span class="text-divider color_white" style="top:-7px; font-weight: 400;"></span>
                PROGRAMMES<span class="text-divider color_white" style="top:-7px; font-weight: 400;"></span>
                RENTALS<span class="text-divider color_white" style="top:-7px; font-weight: 400;"></span>
                IDEAS<span class="text-divider color_white" style="top:-7px; font-weight: 400;"></span>
                PUBLICATIONS<span class="text-divider color_white" style="top:-7px; font-weight: 400;"></span>
                OPPORTUNITIES</h6>
                
                  <div class="col-lg-8">
                <h3 class="hero-title-s" style="font-size: 39px">Search Your

                  <b>Communities</b>

                </h3>

                <div class="search_bar border_iner">

                  <form action="<?= base_url(); ?>" method="get">

                    <div class="form-inner-wrap">

                      <div class="form-group left-box">

                        <img class="first_img" style="width:22px;" src="<?= $url ?>assets/images/search_icon_bar.png" width="22px"

                          height="22px" alt="Search">

                        <input type="text" class="form-control" placeholder="TACOS, CHEAP DINNER, MAX’S" id="left_box"

                          name="q">
                        <!--  <div id="address-result" class="dropdown-box  rounded-0 rounded-bottom">
                            <ul>
                              <li onclick=""><a href="#">Option one</a></li>
                              <li><a href="#">Option two</a></li>
                              <li><a href="#">Option three</a></li>
                            </ul>
                          </div> -->

                      </div>

                      <div class="form-group right-box">

                        <img class="sec_img" src="<?= $url ?>assets/images/Location.png" width="18px" height="21px" alt="Search">

                        <input type="text" class="form-control" id="right_box" onkeyup="search_location()" placeholder="LOCATION" name="" autocomplete="off" />
                        <div id="location-result" class="dropdown-box rounded-0 rounded-bottom" style="display:block"></div>
                      </div>

                      <div class="form-group">

                        <div id="map_search">

                          <div class="loader_container">

                            <img id="loader" style="display:none" src="<?= $url ?>assets/images/map-loader.gif">

                          </div>

                        </div>

                      </div>

                      <div class="form-group">

                        

                      </div> 
                        <input type="hidden" id="place_id" name="place_id">
                      <button type="submit" class="search-btn">Search</button>

                      <div id="map" class="dropdown-box">
                        <ul></ul>
                      </div>

                    </div>

                  </form>

                </div>
                
                    
                      

                <?php

                include FCPATH."cat_menu.php";

                ?>

              </div>
             </div>
            </div>

          </div>

        </div>

      </div>

    </section>

    <section class="video_warp section_spacing_bottom section_spacing_top">

      <div class="container">

        <div class="row">

        <div class="col-lg-4" >
            
            <img src="<?=base_url()?>updated/assets/images/istockphoto.jpeg" style="margin-top:7px; height:90%; "> 
          
         </div>
<!-- 
          <div class="col-lg-6 business_graphic">

            <video autoplay="" loop="" muted="">

              <source src="https://gold-blu.gamedayspuds.com/wp-content/uploads/2022/12/glam-product.mp4"

                type="video/mp4">

            </video>
          </div>--> 

          <div class="col-lg-8 communitybox every_business hide_on_desk_h">



            <p class="color_orange leading_texts fw_500 fs_15">COMMUNITY HUBLAND - A COMMUNITY MARKETING HUB</p>

            <h4 class="h_title">Your Digital Helper</h4>

<p>Welcome to Community HubLand a local business directory & dedicated online advertising platform. Boost your web presence and enrich your local 
communities with your offers in minutes.</p>
 <ul >

    <li><p class="d-flex-al"><img src="<?= $url ?>assets/images/Tick-Square.png" style="margin-bottom: 2px;"><span style="margin-left: 7px;">Our services offer you a business marketing website, immediately after sign-up</span></p> </li>

    <li><p class="d-flex-al"><img class="m-zero" src="<?= $url ?>assets/images/Tick-Square.png" style="margin-bottom: 49px;"><span style="margin-top: 5px; margin-left: 7px">With only images and some descriptive texts of your business, you can have your <br>
    website up and running, on Community HubLand in less than 30 minutes</span></p> </li>
</ul>

<p>Community HubLand business marketing website, can be easily customised to your business needs and utilised as your business’s virtual hub page.</p> 

<p>See your local business automatically listed on Community HubLand's directory. From sole traders to market stall owners to publishers, realtors and students alike, our local business directory caters to all industry. 
If you dont see your industry, contact us to have it listed!</p>

<p>We enable customers find and share your business at no costs to you!</p> 

<br>
<!--
            <div class="scroll">

              <ul>

                <li><img src="<?= $url ?>assets/images/Tick-Square.png" width="24px" height="25px" alt="">Our Offers</li>

                <li><img src="<?= $url ?>assets/images/Tick-Square.png" width="24px" height="25px" alt="">Top Associates</li>

                <li><img src="<?= $url ?>assets/images/Tick-Square.png" width="24px" height="25px" alt="">From Clients</li>

              </ul>

              <div class="shown-videos">

                <div class="flex_centered video-boxes">

                  <a href="#" class="text_btn fs_12"><i class="fa fa-play"></i> About Us</a>

                  <a href="#" class="text_btn fs_12"><i class="fa fa-play"></i> Offers</a>

                  <a href="#" class="text_btn fs_12"><i class="fa fa-play"></i> Benefits</a>

                  <a href="#" class="text_btn fs_12"><i class="fa fa-play"></i> Communities</a>

                  <a href="#" class="text_btn fs_12"><i class="fa fa-play"></i> Associate 1</a>

                  <a href="#" class="text_btn fs_12"><i class="fa fa-play"></i> Associate 2</a>

                  <a href="#" class="text_btn fs_12"><i class="fa fa-play"></i> Associate 3</a>

                  <a href="#" class="text_btn fs_12"><i class="fa fa-play"></i> Pioneer 1</a>

                  <a href="#" class="text_btn fs_12"><i class="fa fa-play"></i> Pioneer 2</a>

                  <a href="#" class="text_btn fs_12"><i class="fa fa-play"></i> Pioneer 3</a>

                  <a href="#" class="text_btn fs_12"><i class="fa fa-play"></i> Pioneer 4</a>

                  <a href="#" class="text_btn fs_12">Pioneer 5</a>

                  <a href="#" class="text_btn fs_12">Pioneer 6</a>

                  <a href="#" class="text_btn fs_12">Pioneer 7</a>

                  <a href="#" class="text_btn fs_12">Pioneer 8</a>

                  <a href="#" class="text_btn fs_12">Pioneer 9</a>

                </div>

                <div class="gradient-bg"></div>

              </div>

              <p class="watch-more">Watch other videos on

                <a href="#">youtube</a>

                to learn more...</p>

            </div>
            
            -->

          </div>

        </div>

      </div>

    </section>
    
    
    
    
    <section class="homeabout community_wrap">
        <div class="container" style="max-width:90%; ">
        <div class="row">
            <div class="col-md-4">
                <h6 class="color_orange">Expert Assistance</h6>
                <p>Our expert team is available to guide you through the process, optimising your online presence.
                </p>
                
                <h6 class="color_orange">Directory Listing</h6>
                <p>Your page will be featured in our directory, simplifying discovery for
users.</p>
              <h6 class="color_orange">Content Addition</h6>
                <p>Add crucial content like events, job listings, blogs, and ads in any category to engage your audience effectively.</p>
            
            </div>
            <div class="col-md-4">
                <center>
                <img class="homeaboutimg" src="<?=base_url()?>updated/assets/images/homeabout.jpeg">
                <div style="text-align:left">
                <h6 class="color_orange">Page Design</h6>
                <p>Utilise our user-friendly tools to design your marketing business page, showcasing your products, services, events and more.</p>
            </div>
                </center>
            </div>
            <div class="col-md-4">
                  <h6 class="color_orange">Earn Commission Programme</h6>
                <p>Explore opportunities to earn commissions by referring others to Community HubLand using your referral code.</p>
                  <h6 class="color_orange">Registration</h6>
                <p>Create a vendor account for a business hub-site or a customer account to refer and earn, add to wishlist or buy.</p>
                  <h6 class="color_orange">Profile Customisation</h6>
                <p>Personalise your business profile
with your logo, images,
description, social media and a
variety of contact details</p>
                
            </div>
        </div>
        </div>
    </section>

    <section class="community_wrap">

      <div class="graphic-shape">

        <img src="<?= $url ?>assets/images/business_graphic-clipart.png" alt="">

      </div>

      <div class="container">

        <div class="row align-items-center" style="padding-top: 70px;">

          <div class="col-lg-6 order-lg-2 business_graphic text-center">

            <img src="<?= $url ?>assets/images/business_graphic.png" alt="" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">

            <div class="circle_clipart">

              <img src="<?= $url ?>assets/images/circle-clipart.png" alt="">

            </div>

          </div>

          <div class="col-lg-6 order-lg-1 communitybox pt_19">



            <p class="color_orange leading_texts fw_500 fs_15" data-aos="fade-down" data-aos-duration="1000" data-aos-delay="00">
                COMMUNITY MARKETING LOCAL BUSINESS PAGE - YOUR MARKETING HUB
            </p>



            <h4 class="h_title m_27" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">Every Business has something to offer their community</h4>
            
<p>This platform is designed to help businesses anywhere in the world to connect with markets across borders. You can build your advertisement posts in minutes and post it to any 
city in the world; and your ad listings will be displays in that community's feed at no extra cost to you.</p>

<p>Our directory is simple to use, by simply signing up and uploading your images and texts, your advertisements will be automaticatically listed in the area you target. Afetrwhich, potential customers can easily get in touch with you via your contact form, phone, email, WhatsApp messenger or through your linked external sites and social media platforms.</p>


            <p data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300" class="color_orange leading_texts fw_400 fs_13 add_comma">EVENTS<span

                class="text-divider color_white "></span>JOBS<span class="text-divider color_white"></span>BLOGS<span

                class="text-divider color_white"></span>ROOMS FOR RENT<span

                class="text-divider color_white"></span>HANDY SERVICES<span

                class="text-divider color_white"></span>STORE ITEMS</p>

            <p data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400" class="m_27 ls_1">Easy-to-use, straight-forward access</p>

            <ul class="ls_7" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="500">

              <li><img src="<?= $url ?>assets/images/Tick-Square.png"><span>List multiple products and services</span></span></li>

              <li><img src="<?= $url ?>assets/images/Tick-Square.png"><span>Market each advert on its Own Webpage 
              <span class="text-divider color_white "></span> Can Post your Affiliate Links on the Shop

              </span></li>

              <li><img src="<?= $url ?>assets/images/Tick-Square.png"><span>Contact Forms

                <span class="text-divider color_white "></span>Shopping Cart for Direct Sales to Customers
                
                <span class="text-divider color_white "></span>Instant WhatsApp</span></li>

              <li><img src="<?= $url ?>assets/images/Tick-Square.png"><span>Automatated Posts to Directory Listings
              <span class="text-divider color_white "></span> Your Socials included

              </span></li>

              <li><img src="<?= $url ?>assets/images/Tick-Square.png"><span>Easy Blogging, integrated as your Perfect Marketing Tool</span></li>

              <li><img src="<?= $url ?>assets/images/Tick-Square.png"><span>One-click access to Affiliate Marketing</span></li>

              <li><img src="<?= $url ?>assets/images/Tick-Square.png"><span>Got nothing to sell? Join & Earn from our Affiliate Marketing</span></li>

            </ul>

            <b class="fs_11" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">Price?</b>

            <h5 class="ls_7" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">

              All Inclusive business platform - for

              <span class="color_orange">less than</span>

              a cost of a breakfast</h5>

          </div>

        </div>

        <div class="dotted_lines_clipart">

          <img src="<?= $url ?>assets/images/dotted_lines_clipart.png" alt="">

        </div>

      </div>

    </section>

    <section class="orange_card section_spacing_top" data-aos="fade-up" data-aos-duration="1000">

      <div class="container">

        <div class="orange_card_box">

          <div class="full_circle"></div>

          <p>COMMUNITY HUBLAND DIGITAL SERVICES - YOUR OTHER REQUIREMENTS</p>

          <h4 class="l_height_1">Professional Business Solutions <br>Customised And Designed To Meet Bespoke Needs</h4>
          

          <p class="hire_para">Hire Professionals -- See Results!</p>

          <div class="orange_inner_wrapper">

            <div class="right_left_wrapper">

              <div class="row left_orange_box margin_left_cls">

                <div class="col-sm-6 checkbox_tick">

                  <div class="list-with-img">

                    <img src="<?= $url ?>assets/images/Tick-Square.png">

                    <div class="list-texts">

                      <h4>DIGITAL WEB MARKETING</h4>

                      <p>Social media with local influencers and SEO</p>

                    </div>

                  </div>

                </div>

                <div class="col-sm-6 checkbox_tick">

                  <div class="list-with-img">

                    <img src="<?= $url ?>assets/images/Tick-Square.png">

                    <div class="list-texts">

                      <h4>DESIGNS</h4>

                      <p>Bespoke designs for website and web promotion materials</p>

                    </div>

                  </div>

                </div>

                <div class="col-sm-6 checkbox_tick">

                  <div class="list-with-img">

                    <img src="<?= $url ?>assets/images/Tick-Square.png">

                    <div class="list-texts">

                      <h4>WEBSITES</h4>

                      <p>Best developers for your project</p>

                    </div>

                  </div>

                </div>

                <div class="col-sm-6 checkbox_tick">

                  <div class="list-with-img">

                    <img src="<?= $url ?>assets/images/Tick-Square.png">

                    <div class="list-texts">

                      <h4>VIDEOS</h4>

                      <p>2D and 3D videos for any bespoke or marketing idea</p>

                    </div>

                  </div>

                </div>

                <div class="col-sm-12 checkbox_tick">

                  <div class="list-with-img">

                    <img src="<?= $url ?>assets/images/Tick-Square.png">

                    <div class="list-texts">

                      <h4>ACCESS TO WHOLESALE MARKETS</h4>

                      <p>A myriad of low cost, wholesale markets globally. If you are looking for a supplier or buyer, contact us and we may be able to link you up with just the right business you need!</p>

                    </div>

                  </div>

                </div>

              </div>

              

            </div>

          </div>

          <div class="bottom_circled">

            <img src="<?= $url ?>assets/images/bottom-circled.png" alt="">

          </div>

        </div>

      </div>

    </section>

    <section class="advertise_wrap section_spacing_top section_spacing_bottom">

      <div class="purple_line">

        <img src="<?= $url ?>assets/images/base-icon.png" alt="">

      </div>

      <div class="container">

        <div class="row" id="advertise_info">

          <div class="col-lg-5 business_graphic text-center">

            <img src="<?= $url ?>assets/images/info-graphic.png" alt="" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="200">

            <div class="purple_dot_top">

              <img src="<?= $url ?>assets/images/purple.png" alt="">

            </div>

          </div>

          <div class="col-lg-7 communitybox">

            <p class="sub-heading" data-aos="fade-down" data-aos-duration="1000" data-aos-delay="00">
                ADVERTISE YOUR BUSINESS AND IDEAS - GATEWAY TO A THRIVING BUSINESS COMMUNITY
            </p>

            <h3 data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">We Pride Ourselves in Innovative Marketing Strategies</h3>

            <p data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">Offering local businesses and communities web tools to boost their collegial relationship in reaching new

              heights</p>

            <div class="white_inner_wrapper">

              <div class="right_left_wrapper">

                <div class="row left_orange_box margin_left_cls">

                  <div class="col-sm-6 checkbox_tick">

                    <div class="list-with-img" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">

                      <img src="<?= $url ?>assets/images/Tick-Square.png">

                      <div class="list-texts">

                        <h4>BUSINESS PAGE</h4>

                        <p>To manage and consolidate all your business interests in one place</p>

                      </div>

                    </div>

                  </div>

                  <div class="col-sm-6 checkbox_tick">

                    <div class="list-with-img" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">

                      <img src="<?= $url ?>assets/images/Tick-Square.png">

                      <div class="list-texts">

                        <h4>AD LISTINGS</h4>

                        <p>Create as many ads you need and boost your local communities with your ideas,

                          products and services</p>

                      </div>

                    </div>

                  </div>

                  <div class="col-sm-6 checkbox_tick">

                    <div class="list-with-img" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">

                      <img src="<?= $url ?>assets/images/Tick-Square.png">

                      <div class="list-texts">

                        <h4>BLOGGING</h4>

                        <p>Business blogging platform is perfect for bloggers and businesses alike. Your

                          perfect marketing tool! Get posted on both your business website and directory

                          to be found by interested audience</p>

                      </div>

                    </div>

                  </div>

                  <div class="col-sm-6 checkbox_tick">

                    <div class="list-with-img" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400">

                      <img src="<?= $url ?>assets/images/Tick-Square.png">

                      <div class="list-texts">

                        <h4>AFFILIATE MARKETING PROGRAMME</h4>

                        <p>Join as a vendor to market campaigns by simply uploading media info

                          materials. Or as a customer to earn up to 30% commissions by following

                          easy-to-use step by step instructions</p>

                      </div>

                    </div>

                  </div>

                  <div class="col-sm-6 checkbox_tick">

                    <div class="list-with-img" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="500">

                      <img src="<?= $url ?>assets/images/Tick-Square.png">

                      <div class="list-texts">

                        <h4>COMMERCIAL WEBSITE</h4>

                        <p>List your products in Community HubLand shop and use your Business website as

                          your store. Customers can buy from both platforms</p>

                      </div>

                    </div>

                  </div>

                  <div class="col-sm-6 checkbox_tick">

                    <div class="list-with-img" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="600">

                      <img src="<?= $url ?>assets/images/Tick-Square.png">

                      <div class="list-texts">

                        <h4>ADVERTISEMENT SPOT</h4>

                        <p>Get listed on main directory site under your chosen industry. You can market

                          your business, as well as any other random items to any category</p>

                      </div>

                    </div>

                  </div>

                </div>

              </div>

            </div>

            <div class="learn_more_btns" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="600">

              <a href="#" class="primary-btn our_projects">Advertise With Us</a>

              <div class="purple_dot">

                <img src="<?= $url ?>assets/images/purple.png" alt="">

              </div>

            </div>



          </div>



        </div>

      </div>

      <div class="upper_line_dot">

        <img src="images/doted-lines-right.html" alt="">

      </div>

    </section>
    
    
  <section>
    <div class="container">
<div class="extrades">
    <center>
    <h3 class="color_orange lh-sm" style="margin-bottom: 20px;">EARN up to 30% COMMISSIONS</h3>
    </center>
    <div class="row">
        <div class="col-md-3 col-2 dd-none">
            
            <!--<img src="<?=base_url()?>updated/assets/images/istockphoto.jpeg"> -->
          
         </div>
        <div class="col-md-6 col-8 w-full">
            <center>
   <div><p style="margin-bottom: 10px; text-align:left; ">            
Sign-up free for a customer account, and tick the Affiliate checkbox. 

 That's it! You are in business!</p><p style="margin-bottom: 10px; text-align:left; ">Explore opportunities to earn commissions, by referring others to Community HubLand 

  with your referral code.</p>

<h4 class="lh-sm" style="margin-bottom: 10px; text-algn:left;">Can businesses put their business up for affilate marketing too?</h4>

<p style="text-align:left; margin-bottom: 10px;">Yes it comes free with the vendor account. You tick the Affiliate checkbox, and Voila! Login and upload info-media to your affiliate marketing dashboard.</p>

 <p style="text-align:left;">We are in the testing phase, your info-media would appear instantly on the affiliate marketing panel for free! You may also add commissions if you want to attract more affiliate marketers to your business. It is as simple as that!</p>
                
 <br>
   
            <button class="joinbtn primary-btn m-zero mb-1" style="margin-left:20px;">Become an Affiliate Marketer</button><button class="joinbtn primary-btn m-zero" style="margin-left:20px;">Test Vendor Affilate Programme</button>
            <br><br>
            <div>Already a member?</div>
            <a href="https://communityhubland.com/login_set/login" style="margin-left:20px;">Customer Login</a><a href="https://communityhubland.com/vendor" style="margin-left:20px;">Vendor Login</a>
           </div> </center>
        </div>
        <div class="col-md-3 col-2 dd-none">
         <!--   <img src="<?=base_url()?>updated/assets/images/istockphoto.jpeg">-->
           </div>
    
</div>
</div>
  </section>

  
    <section class="orange_card section_spacing_top" data-aos="fade-up" data-aos-duration="1000">

      <div class="container">

        <div class="orange_card_box">

          <div class="full_circle"></div>
<center>
          <h4 class="l_height_1">Success isn't just about tools, <span>it's about working together</span></h4>

          <p class="hire_para"> 
          That's why we've made a place where <br>
small <b>Business Owners, Vendors, Bloggers, and any other business type</b> can come together <br>
on one platform to create a market space, where their communities can reach them more easily.
          </p>
          <br>
            <p class="hire_para"> 
At Community HubLand you have access to a range of platforms <br>
to post products, ads, news articles, blogs, or any other community pegs, to unlock the full potential of your online presense.
          </p>
  </center>      <!--  <a href="<?= base_url('vendor_logup/registration'); ?>" class="secondary-btn white mt-4">SIGN-UP NOW</a> -->
          <div class="bottom_circled">

            <img src="<?= $url ?>assets/images/bottom-circled.png" alt="">

          </div>

        </div>

      </div>

    </section>
      <section class="verifed_listings section_spacing_top section_spacing_bottom">

      <div class="vertical_dot">

        <img src="<?= $url ?>assets/images/vertical.png" alt="">  

      </div>

      <div class="container">

        <div class="verify_head">

          <h4 class="h_title" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="0">Verified Listings</h4>

          <p data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">Explore and contact businesses directly with no obligation</p>

          <div class="listing_lines">

            <img src="<?= $url ?>assets/images/Group.png" alt="">

          </div>

        </div>

        <div class="row" id="home_p">

          <?php
          $list = $this->db->where('featured','ok')->get('product')->result_array();
          foreach ($list as $key => $row) {
                                if($key < 3)

                                $this->load->view('grid_box',$row);
          }

          ?>

        </div>

        <div class="orange_purple">

          <img src="<?= $url ?>assets/images/arrow-purple.png" alt="">

        </div>

      </div>

    </section>
  </main>

<?php
$home = 1;
include "footer_new.php";

?>