<?php

$pro = array();



if(isset($product_data[0]))
{

    $pro = $product_data[0];

}
$vid = 0;

                            $added_by = json_decode($pro['added_by'], true);

                            if(isset($added_by['type']) && $added_by['type'] == 'vendor')
                            {

                                $vid = $added_by['id'];

                            }
?>
<?php
$othen = array();
                    $this->db->order_by("bpage_sort", "asc");

                    $mods = $this->db->where('bpage_check',1)->get('modules')->result_array();
                    foreach($mods as $k=> $v)
                    {
                        $othen[] = $v['id'];
                    }
                    
                    ?>
<main class="directory-main">
    <?php
    include "business_card.php";
    ?>
    
    <div class="business-tabs">
      <div class="container">
        <div class="inner_tabs">
          <div class="tabs__box">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane"
                  type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="true">Profile</button>
              </li>
              <?php
                    $lmod = array();
                    
                    foreach($mods as $k=> $v)
                    {
                        $lmod[] = $v['id'];
                        ?>
                        <li class="nav-item" role="presentation">
                <button class="nav-link" id="tab_m<?= $v['id'] ?>" data-bs-toggle="tab" data-bs-target="#tab_m<?= $v['id'] ?>-pane"
                  type="button" role="tab" aria-controls="tab_m<?= $v['id'] ?>-pane" aria-selected="false"><?= $v['bpage_text']; ?></button>
              </li>
                        <?php
                    }
                    ?>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="store-tab" data-bs-toggle="tab" data-bs-target="#store-tab-pane"
                  type="button" role="tab" aria-controls="store-tab-pane" aria-selected="false">Store</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews-tab-pane"
                  type="button" role="tab" aria-controls="reviews-tab-pane" aria-selected="false">Reviews</button>
              </li>
            </ul>
          </div>
        </div>
        <div class="tab-content" id="myTabContent">
            <?php
    include "profile_tab.php";
    ?>
        <?php
                    $lmod = array();
                    
                    foreach($mods as $k=> $v)
                    {
                        
                        
                        $lmod[] = $mod_id= $nod_i= $v['id'];
                        ?>
                        <div class="tab-pane fade" id="tab_m<?= $v['id'] ?>-pane" role="tabpanel" aria-labelledby="tab_m<?= $v['id'] ?>" tabindex="0">
                            
            <?php
            include "mod_tab.php";
            ?>
          </div>
                        <?php
                    }
                    ?>
          <div class="tab-pane fade" id="store-tab-pane" role="tabpanel" aria-labelledby="store-tab" tabindex="0">
            <div class="filter-listings">
              <div class="filter-btns">
                <ul class="filter-tabs">
                  <li>
                    <button class="inner-filter-btn active">All Listing</button>
                  </li>
                  <li>
                    <button class="inner-filter-btn" data-filter=".directory-filter">Directory</button>
                  </li>
                  <li>
                    <button class="inner-filter-btn" data-filter=".shop-filter">Shop</button>
                  </li>
                </ul>
              </div>

              <div class="filter-content">
                <div class="filter-pane active">
                  <div class="listings shop-product">
                    <div class="main_listing" id="list-grid">
                      <div class="row products filter-list list flex-gutters-10">
                          <?php
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
                        <?php
                        $shop_cls = '';
                        if($sing['is_product'] == 1)
                        {
                            $shop_cls = 'shop-filter';
                        }
                        else
                        {
                            $shop_cls = 'directory-filter';
                        }
                        $sing['shop_cls'] = $shop_cls;

                        $this->load->view( 'grid_box', $sing);

                        ?>
                    <?php
                }

            }
            
            ?>
                        
                        <div class="change-item grid-style directory-filter col-lg-4">
                          <div class="sidegap_product item white_shadow__box width_set job_list bpaeg_list "
                            data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200" data-lat="31.5203696"
                            data-lng="74.35874729999999" rate="3">
                            <div class="row row_height_new" id="row_hieght">
                              <div class="col-sm-4 col-12 img_col">
                                <div class="itemimg-wrap  190">
                                  <img src="assets/images/listing-2.png" class="img-fluid item-img" alt="">
                                  <div class="logo_withname">
                                    <div class="logo_round">
                                      <img
                                        src="https://communityhubland.com/uploads/product_image/product_1686489729.webp"
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
                                      <span>Category 1</span><span class="divider"></span><span>Category 2</span><span
                                        class="divider"></span>
                                    </div>
                                    <div class="meta meta-left">
                                      <span>Category 1</span><span class="divider"></span><span>Category 2</span><span
                                        class="divider"></span>
                                    </div>
                                    <div class="meta meta-left">
                                      <span>Category 1</span><span class="divider"></span><span>Category 2</span><span
                                        class="divider"></span>
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
                                    <a href="mailto: shaheerumer5668704@gmail.com"><i class="fa fa-envelope"></i></a>
                                    <a href="tel:"><i class="fa fa-phone"></i></a>
                                    <a href="tel:"><i class="fa-brands fa-whatsapp"></i></a>

                                  </div>


                                </div>
                              </div>
                            </div>

                          </div>
                        </div>
                        <div class="change-item grid-style directory-filter col-lg-4">
                          <div class="sidegap_product item white_shadow__box width_set job_list bpaeg_list "
                            data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300" data-lat="31.5203696"
                            data-lng="74.35874729999999" rate="3">
                            <div class="row row_height_new" id="row_hieght">
                              <div class="col-sm-4 col-12 img_col">
                                <div class="itemimg-wrap  190">
                                  <img src="assets/images/listing-1.png" class="img-fluid item-img" alt="">
                                  <div class="logo_withname">
                                    <div class="logo_round">
                                      <img
                                        src="https://communityhubland.com/uploads/product_image/product_1686489729.webp"
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
                                      <span>Category 1</span><span class="divider"></span><span>Category 2</span><span
                                        class="divider"></span>
                                    </div>
                                    <div class="meta meta-left">
                                      <span>Category 1</span><span class="divider"></span><span>Category 2</span><span
                                        class="divider"></span>
                                    </div>
                                    <div class="meta meta-left">
                                      <span>Category 1</span><span class="divider"></span><span>Category 2</span><span
                                        class="divider"></span>
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
                                    <a href="mailto: shaheerumer5668704@gmail.com"><i class="fa fa-envelope"></i></a>
                                    <a href="tel:"><i class="fa fa-phone"></i></a>
                                    <a href="tel:"><i class="fa-brands fa-whatsapp"></i></a>

                                  </div>


                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="change-item grid-style shop-filter col-lg-4">
                          <div class="sidegap_product item white_shadow__box width_set job_list bpaeg_list "
                            data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100" data-lat="31.5203696"
                            data-lng="74.35874729999999" rate="3">
                            <div class="row row_height_new" id="row_hieght">
                              <div class="col-sm-4 col-12 img_col">
                                <div class="itemimg-wrap  190">
                                  <img src="assets/images/listing-1.png" class="img-fluid item-img" alt="">
                                  <div class="logo_withname">
                                    <div class="logo_round">
                                      <img
                                        src="https://communityhubland.com/uploads/product_image/product_1686489729.webp"
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
                                      <span>Category 1</span><span class="divider"></span><span>Category 2</span><span
                                        class="divider"></span>
                                    </div>
                                    <div class="meta meta-left">
                                      <span class="productPrice">500</span><span class="divider"></span><span>Category 1</span><span class="divider"></span>
                                    </div>
                                    <div class="meta meta-left">
                                      <span>Category 1</span><span class="divider"></span><span>Category 2</span><span
                                        class="divider"></span>
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
                                  <div class="buy-btn">
                                    <a href="#">Add to cart</a>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="change-item grid-style shop-filter col-lg-4">
                          <div class="sidegap_product item white_shadow__box width_set job_list bpaeg_list "
                            data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200" data-lat="31.5203696"
                            data-lng="74.35874729999999" rate="3">
                            <div class="row row_height_new" id="row_hieght">
                              <div class="col-sm-4 col-12 img_col">
                                <div class="itemimg-wrap  190">
                                  <img src="assets/images/listing-2.png" class="img-fluid item-img" alt="">
                                  <div class="logo_withname">
                                    <div class="logo_round">
                                      <img
                                        src="https://communityhubland.com/uploads/product_image/product_1686489729.webp"
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
                                      <span>Category 1</span><span class="divider"></span><span>Category 2</span><span
                                        class="divider"></span>
                                    </div>
                                    <div class="meta meta-left">
                                      <span class="productPrice">500</span><span class="divider"></span><span>Category 1</span><span class="divider"></span>
                                    </div>
                                    <div class="meta meta-left">
                                      <span>Category 1</span><span class="divider"></span><span>Category 2</span><span
                                        class="divider"></span>
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
                                  <div class="buy-btn">
                                    <a href="#">Add to cart</a>
                                  </div>


                                </div>
                              </div>
                            </div>

                          </div>
                        </div>
                        <div class="change-item grid-style shop-filter col-lg-4">
                          <div class="sidegap_product item white_shadow__box width_set job_list bpaeg_list "
                            data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300" data-lat="31.5203696"
                            data-lng="74.35874729999999" rate="3">
                            <div class="row row_height_new" id="row_hieght">
                              <div class="col-sm-4 col-12 img_col">
                                <div class="itemimg-wrap  190">
                                  <img src="assets/images/listing-1.png" class="img-fluid item-img" alt="">
                                  <div class="logo_withname">
                                    <div class="logo_round">
                                      <img
                                        src="https://communityhubland.com/uploads/product_image/product_1686489729.webp"
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
                                      <span>Category 1</span><span class="divider"></span><span>Category 2</span><span
                                        class="divider"></span>
                                    </div>
                                    <div class="meta meta-left">
                                      <span class="productPrice">500</span><span class="divider"></span><span>Category 1</span><span class="divider"></span>
                                    </div>
                                    <div class="meta meta-left">
                                      <span>Category 1</span><span class="divider"></span><span>Category 2</span><span
                                        class="divider"></span>
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
                                  <div class="buy-btn">
                                    <a href="#">Add to cart</a>
                                  </div>


                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <ul class="pagination mt-2">

                        <li onclick="set_value('page','1')" class="active"><a>1</a></li>
                        <li onclick="set_value('page','2')" class=" "><a>2</a></li>
                        <li onclick="set_value('page','3')" class=" "><a>3</a></li>
                        <li onclick="set_value('page','2')"><a>></a></li>
                        <li onclick="set_value('page','5')"><a>>></a></li>

                      </ul>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="reviews-tab-pane" role="tabpanel" aria-labelledby="reviews-tab" tabindex="0">
            <div id="reviews" class="reviews-wrapper tab-content__box">

              <div class="container ">

                <div class="clients_box">

                  <h3>Take a look what other clients say</h3>

                  <h4>Would you like to review this business page?</h4>



                </div>
                <div class="add__new_review" id="review_coment">

                  <h3>Add new Review</h3>

                  <form class="" action="https://dev.communityhubland.com/home/add_rate" id="rform">

                    <div class='rating-stars'>
                      <ul id='stars'>
                        <li class='star' title='Poor' data-value='1'>
                          <i class='fa fa-star fa-fw'></i>
                        </li>
                        <li class='star' title='Fair' data-value='2'>
                          <i class='fa fa-star fa-fw'></i>
                        </li>
                        <li class='star' title='Good' data-value='3'>
                          <i class='fa fa-star fa-fw'></i>
                        </li>
                        <li class='star' title='Excellent' data-value='4'>
                          <i class='fa fa-star fa-fw'></i>
                        </li>
                        <li class='star' title='WOW!!!' data-value='5'>
                          <i class='fa fa-star fa-fw'></i>
                        </li>
                      </ul>
                    </div>
                    <input type="hidden" value="0" name="rating" id="rate" />

                    <input type="hidden" value="1" name="pid" id="pid" />

                    <div class="form-group mb-3">
                      <textarea name="" class="form-control" id="" cols="30" rows="3"></textarea>
                    </div>
                    <div
                      class="review-btn text-center margin-t4__09f24__G0VVf padding-b6__09f24__hfdiP border-color--default__09f24__NPAKY">
                      <a href="login_set/login.html">
                        <button type="button" class="css-hv9ohz" data-activated="false" data-testid="post-button"
                          value="submit" data-button="true">Post Review</button>
                      </a>
                    </div>
                  </form>

                </div>
                <div class="reviews-grid">
                  <div class="row make_display_block">
                    <div class="col-sm-4 cilent_gapp">

                      <div class="info_client">

                        <img src="assets/images/img_avatar.png" alt="">

                        <h4>Raheel</h4>

                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt praesentium exercitationem
                          eveniet suscipit temporibus est.</p>

                        <div class="rating">
                          <i class="fa fa-star rated"></i>
                          <i class="fa fa-star rated"></i>
                          <i class="fa fa-star rated"></i>
                          <i class="fa fa-star rated"></i>
                          <i class="fa fa-star"></i>
                        </div>

                      </div>

                    </div>
                    <div class="col-sm-4 cilent_gapp">

                      <div class="info_client">

                        <img src="assets/images/img_avatar.png" alt="">

                        <h4>Raheel</h4>

                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt praesentium exercitationem
                          eveniet suscipit temporibus est.</p>

                        <div class="rating">
                          <i class="fa fa-star rated"></i>
                          <i class="fa fa-star rated"></i>
                          <i class="fa fa-star rated"></i>
                          <i class="fa fa-star rated"></i>
                          <i class="fa fa-star"></i>
                        </div>

                      </div>

                    </div>
                    <div class="col-sm-4 cilent_gapp">

                      <div class="info_client">

                        <img src="assets/images/img_avatar.png" alt="">

                        <h4>Raheel</h4>

                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt praesentium exercitationem
                          eveniet suscipit temporibus est.</p>

                        <div class="rating">
                          <i class="fa fa-star rated"></i>
                          <i class="fa fa-star rated"></i>
                          <i class="fa fa-star rated"></i>
                          <i class="fa fa-star rated"></i>
                          <i class="fa fa-star"></i>
                        </div>

                      </div>

                    </div>
                    <div class="col-sm-4 cilent_gapp">

                      <div class="info_client">

                        <img src="assets/images/img_avatar.png" alt="">

                        <h4>Raheel</h4>

                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt praesentium exercitationem
                          eveniet suscipit temporibus est.</p>

                        <div class="rating">
                          <i class="fa fa-star rated"></i>
                          <i class="fa fa-star rated"></i>
                          <i class="fa fa-star rated"></i>
                          <i class="fa fa-star rated"></i>
                          <i class="fa fa-star"></i>
                        </div>

                      </div>

                    </div>
                    <div class="col-sm-4 cilent_gapp">

                      <div class="info_client">

                        <img src="assets/images/img_avatar.png" alt="">

                        <h4>Raheel</h4>

                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt praesentium exercitationem
                          eveniet suscipit temporibus est.</p>

                        <div class="rating">
                          <i class="fa fa-star rated"></i>
                          <i class="fa fa-star rated"></i>
                          <i class="fa fa-star rated"></i>
                          <i class="fa fa-star rated"></i>
                          <i class="fa fa-star"></i>
                        </div>

                      </div>

                    </div>
                    <div class="col-sm-4 cilent_gapp">

                      <div class="info_client">

                        <img src="assets/images/img_avatar.png" alt="">

                        <h4>Raheel</h4>

                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt praesentium exercitationem
                          eveniet suscipit temporibus est.</p>

                        <div class="rating">
                          <i class="fa fa-star rated"></i>
                          <i class="fa fa-star rated"></i>
                          <i class="fa fa-star rated"></i>
                          <i class="fa fa-star rated"></i>
                          <i class="fa fa-star"></i>
                        </div>

                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>