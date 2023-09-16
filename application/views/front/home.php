<?php

$url = base_url('updated/');

include "header_new.php";

?>
<style>
    #location-result ul li{
        cursor:pointer;
    }
</style>

<main>

    <!-- Hero Section -->

    <section class="hero main_warp section_spacing_bottom first_section_space">

      <div class="container">

        <div class="first_wrap " data-aos="fade-up" data-aos-duration="1000">

          <div class="row align-items-end">



            <div class="col-lg-8 perfect_place">

              <div class="hero-contents-wrap">

                <h5>Community HubLand - Your Community Marketing Site

                </h5>

                <h3>Search Your

                  <b>Communities</b>

                </h3>

                <div class="search_bar border_iner">

                  <form action="https://dev.communityhubland.com/" method="get">

                    <div class="form-inner-wrap">

                      <div class="form-group left-box">

                        <img class="first_img" style="width:22px;" src="<?= $url ?>assets/images/search_icon_bar.png" width="22px"

                          height="22px" alt="Search">

                        <input type="text" class="form-control" placeholder="TACOS, CHEAP DINNER, MAX’S" id="left_box"

                          name="q">
                          <div id="address-result" class="dropdown-box  rounded-0 rounded-bottom">
                            <ul>
                              <li onclick=""><a href="#">Option one</a></li>
                              <li><a href="#">Option two</a></li>
                              <li><a href="#">Option three</a></li>
                            </ul>
                          </div>

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
                        <ul>
                          <li><a href="#">Option one</a></li>
                          <li><a href="#">Option two</a></li>
                          <li><a href="#">Option three</a></li>
                        </ul>
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

    </section>

    <section class="video_warp section_spacing_bottom section_spacing_top">

      <div class="container">

        <div class="row">

          <div class="col-lg-6 business_graphic">

            <video autoplay="" loop="" muted="">

              <source src="https://gold-blu.gamedayspuds.com/wp-content/uploads/2022/12/glam-product.mp4"

                type="video/mp4">

            </video>

          </div>

          <div class="col-lg-6 communitybox every_business hide_on_desk_h">



            <p class="color_orange leading_texts fw_500 fs_15">Your Community HubLand marketing platform</p>

            <h4 class="h_title">Testimonies from Clients & Associates</h4>



            <p class="">Listen to our Community HubLand pioneers</p>

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

          </div>

        </div>

      </div>

    </section>

    <section class="community_wrap">

      <div class="graphic-shape">

        <img src="<?= $url ?>assets/images/business_graphic-clipart.png" alt="">

      </div>

      <div class="container">

        <div class="row align-items-center">

          <div class="col-lg-6 order-lg-2 business_graphic text-center">

            <img src="<?= $url ?>assets/images/business_graphic.png" alt="" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">

            <div class="circle_clipart">

              <img src="<?= $url ?>assets/images/circle-clipart.png" alt="">

            </div>

          </div>

          <div class="col-lg-6 order-lg-1 communitybox pt_19">



            <p class="color_orange leading_texts fw_500 fs_15" data-aos="fade-down" data-aos-duration="1000" data-aos-delay="00">Look no further for a website, a community marketing

              platform</p>



            <h4 class="h_title m_27" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">Every Business has something to offer their community</h4>



            <p data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300" class="color_orange leading_texts fw_400 fs_13 add_comma">EVENTS<span

                class="text-divider color_white "></span>JOBS<span class="text-divider color_white"></span>BLOGS<span

                class="text-divider color_white"></span>ROOMS FOR RENT<span

                class="text-divider color_white"></span>HANDY SERVICES<span

                class="text-divider color_white"></span>STORE ITEMS</p>

            <p data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400" class="m_27 ls_1">Easy-to-use, straight-forward access</p>

            <ul class="ls_7" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="500">

              <li><img src="<?= $url ?>assets/images/Tick-Square.png">List multiple products and services</li>

              <li><img src="<?= $url ?>assets/images/Tick-Square.png">Market each ad on its own webpage

              </li>

              <li><img src="<?= $url ?>assets/images/Tick-Square.png">Contact forms

                <span class="text-divider color_white "></span>Shopping cart

                <span class="text-divider color_white "></span>Instant WhatsApp connection</li>

              <li><img src="<?= $url ?>assets/images/Tick-Square.png">Automatated posts to directory Listings, your socials

                included

              </li>

              <li><img src="<?= $url ?>assets/images/Tick-Square.png">Easy blogging, integrated as your perfect marketing tool</li>

              <li><img src="<?= $url ?>assets/images/Tick-Square.png">One-click access to affiliate marketing</li>

              <li><img src="<?= $url ?>assets/images/Tick-Square.png">Got nothing to sell? Then join and earn from affiliate

                marketing</li>

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

          <p>COMMUNITY HUBLAND DIGITAL SERVICES</p>

          <h4 class="l_height_1">Professional Business Solutions

            <span>Customised And Designed To Meet Your Needs</span></h4>

          <p class="hire_para">Hire Professionals -- See Results</p>

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

                      <h4>CALL CENTRE SERVICES</h4>

                      <p>A myriad of low cost, highly efficient customer services from technical to

                        telemarketing and help desk support</p>

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

            <p class="sub-heading" data-aos="fade-down" data-aos-duration="1000" data-aos-delay="00">ADVERTISE YOUR BUSINESS AND IDEAS ON COMMUNITY HUBLAND</p>

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

                        <p>to manage and consolidate all your business interests in one place</p>

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

          

          <div class="change-item grid-style col-lg-4">

            <div class="sidegap_product item white_shadow__box width_set job_list bpaeg_list " data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100" data-lat="31.5203696"

                data-lng="74.35874729999999" rate="3">

                <div class="row row_height_new" id="row_hieght">

                    <div class="col-sm-4 col-12 img_col">

                        <div class="itemimg-wrap  190">

                          <img src="<?= $url ?>assets/images/listing-1.png" class="img-fluid item-img" alt="">

                            <div class="logo_withname">

                                <div class="logo_round">

                                    <img src="https://communityhubland.com/uploads/product_image/product_1686489729.webp"

                                        alt="">

                                    <span class="status active"></span>

                                </div>

                            </div>

                        </div>

                    </div>



                    <div class="col-sm-8 col-12 desc_col desc_col_in ">

                        <div class="row" id="add_height_in">



                            <div class="col-8">

                                <h1 class="p_me"><a href="#"></a>Ralph Lauren</a>

                                              </h1>

                            </div>

                            <div class="col-4">

                                <div class="rate2 p_me">

                                    <i class="fa fa-star rated"></i>

                                    <i class="fa fa-star rated"></i>

                                    <i class="fa fa-star rated"></i>

                                    <i class="fa fa-star rated"></i>

                                    <i class="fa fa-star"></i>

                                </div>

                            </div>

                              <div class="col-md-6 left_fields special_cls car_out">

                                <div class="meta meta-left">

                                  <span>Category 1</span><span class="divider"></span><span>Category 2</span><span class="divider"></span>

                                </div>

                                <div class="meta meta-left">

                                  <span>Category 1</span><span class="divider"></span><span>Category 2</span><span class="divider"></span>

                                </div>

                                <div class="meta meta-left">

                                  <span>Category 1</span><span class="divider"></span><span>Category 2</span><span class="divider"></span>

                                </div>

                              </div>

                              <div class="col-md-6 right_fields special_cls car_out">

                                <div class="meta meta-right">

                                  <span class="divider"></span><span class="divider"></span>

                                  <span>Lahore</span>

                                </div>

                              </div>

                            <h2 class="p_me catch_phrase spacing_catch_p">Made to be Worn </h2>





                            <div class="last_desc last_d2 col-md-12 p_me">

                                <div class="col-md-12 dec_wrappper p-0">



                                    <p class="para_text">

                                        ralph lauren corporation is a global leader in the design,

                                        marketing, and distribution of premium lifestyle products,

                                        including apparel, accessories, home furnishings, and other

                                        licenced product categories. </p>

                                </div>

                            </div>

                            <div class="share_iconss icon_shares">

                                <div class="affliate">

                                </div>

                                <!--<a href="#"><i class="fa fa-share"></i></a>-->

                                <a href="https://maps.google.com/?q=31.5203696,74.35874729999999"><i

                                        class="fa fa-map-marker-alt"></i></a>

                                <a href="#"><i class="fa fa-share"></i></a>

                                <a href="home/wishlist/add/1.html"><i class="fa fa-heart"></i></a>

                                <a href="mailto: shaheerumer5668704@gmail.com"><i

                                        class="fa fa-envelope"></i></a>

                                <a href="tel:"><i class="fa fa-phone"></i></a>

                                <a href="tel:"><i class="fa-brands fa-whatsapp"></i></a>



                            </div>





                        </div>

                    </div>

                </div>

            </div>

          </div>

          <div class="change-item grid-style col-lg-4">

            <div class="sidegap_product item white_shadow__box width_set job_list bpaeg_list " data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200" data-lat="31.5203696"

                data-lng="74.35874729999999" rate="3">

                <div class="row row_height_new" id="row_hieght">

                    <div class="col-sm-4 col-12 img_col">

                        <div class="itemimg-wrap  190">

                          <img src="<?= $url ?>assets/images/listing-2.png" class="img-fluid item-img" alt="">

                            <div class="logo_withname">

                                <div class="logo_round">

                                    <img src="https://communityhubland.com/uploads/product_image/product_1686489729.webp"

                                        alt="">

                                    <span class="status"></span>

                                </div>

                            </div>

                        </div>

                    </div>



                    <div class="col-sm-8 col-12 desc_col desc_col_in ">

                        <div class="row" id="add_height_in">



                            <div class="col-8">

                                <h1 class="p_me"><a href="#">Ralph Lauren</a>

                                              </h1>

                            </div>

                            <div class="col-4">

                                <div class="rate2 p_me">

                                    <i class="fa fa-star rated"></i>

                                    <i class="fa fa-star rated"></i>

                                    <i class="fa fa-star rated"></i>

                                    <i class="fa fa-star rated"></i>

                                    <i class="fa fa-star"></i>

                                </div>

                            </div>

                            <div class="col-md-6 left_fields special_cls car_out">

                              <div class="meta meta-left">

                                <span>Category 1</span><span class="divider"></span><span>Category 2</span><span class="divider"></span>

                              </div>

                              <div class="meta meta-left">

                                <span>Category 1</span><span class="divider"></span><span>Category 2</span><span class="divider"></span>

                              </div>

                              <div class="meta meta-left">

                                <span>Category 1</span><span class="divider"></span><span>Category 2</span><span class="divider"></span>

                              </div>

                            </div>

                            <div class="col-md-6 right_fields special_cls car_out">

                              <div class="meta meta-right">

                                <span class="divider"></span><span class="divider"></span>

                                <span>Lahore</span>

                              </div>

                            </div>

                            <h2 class="p_me catch_phrase spacing_catch_p">Made to be Worn </h2>





                            <div class="last_desc last_d2 col-md-12 p_me">

                                <div class="col-md-12 dec_wrappper p-0">



                                    <p class="para_text">

                                        ralph lauren corporation is a global leader in the design,

                                        marketing, and distribution of premium lifestyle products,

                                        including apparel, accessories, home furnishings, and other

                                        licenced product categories. </p>

                                </div>

                            </div>

                            <div class="share_iconss icon_shares">

                                <div class="affliate">

                                </div>

                                <!--<a href="#"><i class="fa fa-share"></i></a>-->

                                <a href="https://maps.google.com/?q=31.5203696,74.35874729999999"><i

                                        class="fa fa-map-marker-alt"></i></a>

                                <a href="#"><i class="fa fa-share"></i></a>

                                <a href="home/wishlist/add/1.html"><i class="fa fa-heart"></i></a>

                                <a href="mailto: shaheerumer5668704@gmail.com"><i

                                        class="fa fa-envelope"></i></a>

                                <a href="tel:"><i class="fa fa-phone"></i></a>

                                <a href="tel:"><i class="fa-brands fa-whatsapp"></i></a>



                            </div>





                        </div>

                    </div>

                </div>



            </div>

          </div>

          <div class="change-item grid-style col-lg-4">

            <div class="sidegap_product item white_shadow__box width_set job_list bpaeg_list " data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300"data-lat="31.5203696"

                data-lng="74.35874729999999" rate="3">

                <div class="row row_height_new" id="row_hieght">

                    <div class="col-sm-4 col-12 img_col">

                        <div class="itemimg-wrap  190">

                          <img src="<?= $url ?>assets/images/listing-1.png" class="img-fluid item-img" alt="">

                            <div class="logo_withname">

                                <div class="logo_round">

                                    <img src="https://communityhubland.com/uploads/product_image/product_1686489729.webp"

                                        alt="">

                                    <span class="status active"></span>

                                </div>

                            </div>

                        </div>

                    </div>



                    <div class="col-sm-8 col-12 desc_col desc_col_in ">

                        <div class="row" id="add_height_in">



                            <div class="col-8">

                                <h1 class="p_me"><a href="#">Ralph Lauren</a>

                                              </h1>

                            </div>

                            <div class="col-4">

                                <div class="rate2 p_me">

                                    <i class="fa fa-star rated"></i>

                                    <i class="fa fa-star rated"></i>

                                    <i class="fa fa-star rated"></i>

                                    <i class="fa fa-star rated"></i>

                                    <i class="fa fa-star"></i>

                                </div>

                            </div>

                              <div class="col-md-6 left_fields special_cls car_out">

                                <div class="meta meta-left">

                                  <span>Category 1</span><span class="divider"></span><span>Category 2</span><span class="divider"></span>

                                </div>

                                <div class="meta meta-left">

                                  <span>Category 1</span><span class="divider"></span><span>Category 2</span><span class="divider"></span>

                                </div>

                                <div class="meta meta-left">

                                  <span>Category 1</span><span class="divider"></span><span>Category 2</span><span class="divider"></span>

                                </div>

                              </div>

                              <div class="col-md-6 right_fields special_cls car_out">

                                <div class="meta meta-right">

                                  <span class="divider"></span><span class="divider"></span>

                                  <span>Lahore</span>

                                </div>

                              </div>

                            <h2 class="p_me catch_phrase spacing_catch_p">Made to be Worn </h2>





                            <div class="last_desc last_d2 col-md-12 p_me">

                                <div class="col-md-12 dec_wrappper p-0">



                                    <p class="para_text">

                                        ralph lauren corporation is a global leader in the design,

                                        marketing, and distribution of premium lifestyle products,

                                        including apparel, accessories, home furnishings, and other

                                        licenced product categories. </p>

                                </div>

                            </div>

                            <div class="share_iconss icon_shares">

                                <div class="affliate">

                                </div>

                                <!--<a href="#"><i class="fa fa-share"></i></a>-->

                                <a href="https://maps.google.com/?q=31.5203696,74.35874729999999"><i

                                        class="fa fa-map-marker-alt"></i></a>

                                <a href="#"><i class="fa fa-share"></i></a>

                                <a href="home/wishlist/add/1.html"><i class="fa fa-heart"></i></a>

                                <a href="mailto: shaheerumer5668704@gmail.com"><i

                                        class="fa fa-envelope"></i></a>

                                <a href="tel:"><i class="fa fa-phone"></i></a>

                                <a href="tel:"><i class="fa-brands fa-whatsapp"></i></a>



                            </div>





                        </div>

                    </div>

                </div>

            </div>

          </div>

        </div>

        <div class="orange_purple">

          <img src="<?= $url ?>assets/images/arrow-purple.png" alt="">

        </div>

      </div>

    </section>
    <section class="orange_card section_spacing_top" data-aos="fade-up" data-aos-duration="1000">

      <div class="container">

        <div class="orange_card_box">

          <div class="full_circle"></div>

          <h4 class="l_height_1">Success isn't just about tools <br>

            <span>It's about working together</span></h4>

          <p class="hire_para">That's why we've made a place where small business owners, vendors, bloggers, and others can come together to help their communities and reach more people. Hence, don't let the challenges of community management hold you back. Join us at Community HubLand and unlock the full potential of your online community today.</p>
          <a href="#" class="secondary-btn white mt-4">SIGN-UP NOW!</a>
          <div class="bottom_circled">

            <img src="<?= $url ?>assets/images/bottom-circled.png" alt="">

          </div>

        </div>

      </div>

    </section>
  </main>

<?php
$home = 1;
include "footer_new.php";

?>