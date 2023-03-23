
<?php
$pro = array();
if(isset($product_data[0]))
{
    $pro = $product_data[0];
}
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
                                                $logo = $this->crud_model->size_img($pro['comp_logo'],100,100);
                                            }
                                            $cover = '';
if(true)
                                            {
                                                $cover = $this->crud_model->size_img($pro['comp_cover'],820,312);
                                            }
?>
<div class="banner_rating" style="background: url('<?= $cover ?>');">
    <div class="container">
        <div class="listing_inner">
                <ul>
                    <li><a href="#"><i class="fa fa-whatsapp"></i> Direct Message</a></li>
                    <li><a href="#"><i class="fa fa-phone"></i> Call Now</a></li>
                    <li><a href="#"><i class="fa fa-link"></i> Website</a></li>
                    <li><a href="#"><i class="fa fa-envelope"></i> Send an Email</a></li>
                    <li><a href="#"><i class="fa fa-heart"></i> Bookmark</a></li>
                    <li><a href="#"><i class="fa fa-share"></i> Share</a></li>
                    <li><a href="#"><i class="fa fa-map-marker"></i> Get Directions</a></li>
                    <li><a href="#"><i class="fa fa-info"></i> Report</a></li>
                </ul>
            </div>
        <div class="row">
            <div class="col-sm-8 rating_box">
                <div class="rating_info">
                    <img src="<?= $logo; ?>">
                    <h3><?= $pro['title'] ?> <img src="https://ads.strokedev.net/uploads/slider_image/tick.svg"></h3>
                    <p>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        Innovative cooking, paired with fine wines
                    </p>
                </div>
            </div>
            <div class="col-sm-4 price_range">
                <ul>
                    <li>
                        <h4>Price range</h4>
                        <b>$$</b>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-phone"></i> Call now</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="tabs_wrap">

    <ul class="tabss">
        <li class="tab-link current" data-tab="tab-1">Profile</li>
        <li class="tab-link" data-tab="tab-2">Events</li>
        <li class="tab-link" data-tab="tab-3">Blogs</li>
        <li class="tab-link" data-tab="tab-4">Jobs</li>
        <li class="tab-link" data-tab="tab-5">Store</li>
        <li class="tab-link" data-tab="tab-6">Reviews</li>
    </ul>

    <div class=" tabs_content">
        <div id="tab-1" class=" tab-content current">
            
            <div class="container">
                <div class="row">
                <div class="col-sm-6 cashon_delivery">
                    <!--<h4>COMMUNITY HUBLAND DIGITAL SERVICES</h4>
                    <h3>Professional Business Solutions Designed For You</h3>
                    <p>Hire our experienced team of programmers, digital designers, and marketing professionals, who know how to deliver results. With your requirements, we will help you identify your needs to reach solutions</p>
                    <ul>
                        <li><i class="fa fa-check"></i> WEB &amp; ENTERPRISE PORTALS - Incredible UX and compelling functionality under the hood</li>
                        <li><i class="fa fa-check"></i> ECOMMERCE DEVELOPMENT - Fully customized eCommerce solution for your online store</li>
                        <li><i class="fa fa-check"></i> GRAPHICS ANALYSIS - Solutions empowered with computer Graphic Designing</li>
                    </ul>
                    <a href="#">Our Projects</a>-->
                    <?= $pro['description']; ?>
                </div>
                <div class="col-sm-6 delivery_img">
                    <img src="https://ads.strokedev.net/uploads/slider_image/Graphic-laps-Community-Hubland-min.png" alt="">
                </div>
            </div>
            </div>


            <div class="full_bg">
                <div class="container">
                    <div class="row">
                        
                        <div  class="col-sm-6 sidegapp_contact">
                            <div class="locationbox smedesign" id="formbox_contact">
                                <h4><i class="fa fa-envelope"></i> Contact business</h4>
                                <form action="" method="">
                                    <div class="formbox_inner">
                                        <label>Your Name</label>
                                        <input type="text" required="" name="">
                                    </div>
                                    <div class="formbox_inner">
                                        <label>Your Email</label>
                                        <input type="email" required="" name="">
                                    </div>
                                    <div class="formbox_inner">
                                        <label>Subject</label>
                                        <input type="text" required="" name="">
                                    </div>
                                    <div class="formbox_inner">
                                        <label>Your message (optional)</label>
                                        <textarea></textarea>
                                    </div>
                                    <div class="formbox_inner">
                                        <button type="button">SUBMIT</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-sm-6 cashon_delivery">
                            <h4>COMMUNITY HUBLAND DIGITAL SERVICES</h4>
                            <h3>Professional Business Solutions Designed For You</h3>
                            <p>Hire our experienced team of programmers, digital designers, and marketing professionals, who know how to deliver results. With your requirements, we will help you identify your needs to reach solutions</p>
                            <ul>
                                <li><i class="fa fa-check"></i> WEB &amp; ENTERPRISE PORTALS - Incredible UX and compelling functionality under the hood</li>
                                <li><i class="fa fa-check"></i> ECOMMERCE DEVELOPMENT - Fully customized eCommerce solution for your online store</li>
                                <li><i class="fa fa-check"></i> GRAPHICS ANALYSIS - Solutions empowered with computer Graphic Designing</li>
                            </ul>
                            <a href="#">Our Projects</a>
                        </div>
                    </div>
                </div>
            </div>


            <div class="container">
                <div class="description smedesign gallery_box">
                        <h4><i class="fa fa-photo"></i> Gallery</h4>
                        <ul><?php
                foreach ($imgs as $key => $value) {
                    $img = $this->crud_model->size_img($value['img'],500,500);
                    ?>

                            <li>
                                <img src="<?= $img ?>">
                            </li>
                            <?php
                                }
                            ?>
                            
                        </ul>
                    </div>
            </div>



            <div class="container">
                <div class="locationbox smedesign">
                        <h4><i class="fa fa-map-marker"></i> Location</h4>
                        <div id="googleMap" style="width:100%;height:400px;"></div>
                        <p><?= $address; ?> <a href="#">Get Direction</a></p>
                    </div>
            </div>


            <!-- <div class="row">
                <div class="col-sm-6 left_box">
                    <div class="description smedesign">
                        <h4><i class="fa fa-bars"></i> Description</h4>
                        <p>The Liman Restaurant means port in the Turkish language, however the restaurant opens its doors to all aspects of the Mediterranean kitchen. The kitchen will be mostly focused on Mediterranean food; the owners of the restaurant are young professional chefs who can bring new, exciting tastes to Angel, Islington which will show through in the quality of food they prepare</p>
                    </div>
                    <div class="locationbox smedesign">
                        <h4><i class="fa fa-map-marker"></i> Location</h4>
                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d4963.790223305652!2d-0.11564147180218141!3d51.53348361855762!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2s!4v1656262755680!5m2!1sen!2s" width="100%" height="250px" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        <p>60 Penton Street, Barnsbury, London, N1 9PX, United Kingdom <a href="#">Get Direction</a></p>
                    </div>
                    <div class="locationbox smedesign">
                        <h4><i class="fa fa-tags"></i> Tags</h4>
                        <ul>
                            <li>
                                <a href="#">
                                    <i class="fa fa-credit-card"></i> Accepts Credit Cards
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-credit-card"></i> Bike Parking
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-credit-card"></i> Coupons
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-credit-card"></i> Parking Street
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-credit-card"></i> Wireless Internet
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="locationbox smedesign">
                        <h4><i class="fa fa-tags"></i> Follow us</h4>
                        <ul>
                            <li>
                                <a href="#">
                                    <i class="fa fa-facebook"></i> Facebook
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-twitter"></i> Twitter
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-instagram"></i> Instagram
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-youtube"></i> YouTube
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-reddit"></i> Reddit
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="locationbox smedesign">
                        <h4><i class="fa fa-tags"></i> Region</h4>
                        <ul>
                            <li>
                                <a href="#">
                                    <i class="fa fa-map-marker"></i> Location
                                </a>
                            </li>
                            
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6 right_box">
                    <div class="locationbox smedesign">
                        <h4><i class="fa fa-clock-o"></i> Open <span>Open hours today: 12:00 am - 6:30 pm <i class="fa fa-angle-down"></i></span></h4>
                        <div class="clock_time">
                            <p>Monday <span>12:00 am - 11:00 pm</span></p>
                            <p>Tuesday <span>12:00 am - 11:00 pm</span></p>
                            <p>Wednesday <span>12:00 am - 11:00 pm</span></p>
                            <p>Thursday <span>12:00 am - 11:00 pm</span></p>
                            <p>Friday <span>12:00 am - 11:00 pm</span></p>
                            <p>Saturday <span>12:00 am - 11:00 pm</span></p>
                            <p>Sunday <span>12:00 am - 11:00 pm</span></p>
                            <p style="border-bottom: none;">June 18, 2022 9:40 am local time</p>
                        </div>
                    </div>

                    <div class="description smedesign gallery_box">
                        <h4><i class="fa fa-photo"></i> Gallery</h4>
                        <ul>
                            <li>
                                <img src="https://ads.strokedev.net/uploads/slider_image/1fd48709ffaba7.jpg">
                            </li>
                            <li>
                                <img src="https://ads.strokedev.net/uploads/slider_image/dfae4cd5ce3c54.jpg">
                            </li>
                            <li>
                                <img src="https://ads.strokedev.net/uploads/slider_image/da15b63c3a0f6b.jpg">
                            </li>
                            <li>
                                <img src="https://ads.strokedev.net/uploads/slider_image/66d256832b1ace.jpg">
                            </li>
                            <li>
                                <img src="https://ads.strokedev.net/uploads/slider_image/f9f41271978a3d.jpg">
                            </li>
                            <li>
                                <img src="https://ads.strokedev.net/uploads/slider_image/1fd48709ffaba7.jpg">
                            </li>
                        </ul>
                    </div>

                    <div class="locationbox smedesign">
                        <h4><i class="fa fa-tags"></i> Categories</h4>
                        <ul>
                            <li>
                                <a href="#">
                                    <i class="fa fa-cutlery"></i> Restaurants
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-glass"></i> Nightlife
                                </a>
                            </li>
                        </ul>
                    </div>

                    <div class="locationbox smedesign">
                        <h4><i class="fa fa-envelope"></i> Contact business</h4>
                        <form action="" method="">
                            <div class="formbox_inner">
                                <label>Your Name</label>
                                <input type="text" required=""  name="">
                            </div>
                            <div class="formbox_inner">
                                <label>Your Email</label>
                                <input type="email" required=""  name="">
                            </div>
                            <div class="formbox_inner">
                                <label>Subject</label>
                                <input type="text" required=""  name="">
                            </div>
                            <div class="formbox_inner">
                                <label>Your message (optional)</label>
                                <textarea></textarea>
                            </div>
                            <div class="formbox_inner">
                                <button type="button">SUBMIT</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div> -->
        </div>

            <div id="tab-2" class="tab-content eventsbox">
                
                <div class="row">
            <div class="col-sm-4 sidegapp_pro">
                <div class="item">
                   <div class="lf-item-container listing-preview type-place lf-type-2 post-157 job_listing type-job_listing status-publish hentry job_listing_category-nightlife job_listing_category-restaurants region-london case27_job_listing_tags-accepts-credit-cards case27_job_listing_tags-bike-parking case27_job_listing_tags-coupons case27_job_listing_tags-parking-street case27_job_listing_tags-wireless-internet job_position_featured c27-verified has-logo has-tagline has-info-fields level-promoted priority-2">
                      <div class="lf-item lf-item-alternate" data-template="alternate">
                         <a href="#">
                            <div class="overlay" style="
                               background-color: #242429;
                               opacity: 0.4;
                               "></div>
                            <div class="lf-background" style="background-image: url('https://ads.strokedev.net/uploads/slider_image/da15b63c3a0f6b-768x512.jpg');"></div>
                            <div class="lf-item-info-2">
                               <div class="lf-avatar" style="background-image: url('https://ads.strokedev.net/uploads/slider_image/2625af16c063a7-150x150.png')"></div>
                               <h4 class="case27-primary-text listing-preview-title">
                                  Liman Restaurant  <img class="verified-listing" src="https://ads.strokedev.net/uploads/slider_image/tick.svg">
                               </h4>
                               <h6>Innovative cooking, paired with fine wines</h6>
                               <ul class="lf-contact">
                                  <li>
                                     <i class="icon-phone-outgoing sm-icon"></i>
                                     +44 20 1324 21            
                                  </li>
                                  <li>
                                     <i class="icon-location-pin-add-2 sm-icon"></i>
                                     60 Penton Street            
                                  </li>
                               </ul>
                            </div>
                            <div class="lf-head level-promoted">
                               <div class="lf-head-btn ad-badge" data-toggle="tooltip" data-placement="bottom" data-original-title="Promoted">
                                  <span><i class="icon-flash"></i></span>
                               </div>
                               <div class="lf-head-btn ">
                                  $$                
                               </div>
                               <div class="lf-head-btn  listing-rating rating-preview-card">
                                  <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>                
                               </div>
                               <div class="lf-head-btn  open-status listing-status-open">
                                  OPEN                
                               </div>
                            </div>
                         </a>
                      </div>
                      <div class="listing-details c27-footer-section">
                         <ul class="c27-listing-preview-category-list">
                            <li>
                               <a href="#">
                               <span class="cat-icon" style="background-color: #ff6600;">
                               <i class="fa fa-cutlery" style="color: #fff; "></i>
                               </span>
                               <span class="category-name">Restaurants</span>
                               </a>
                            </li>
                            
                         </ul>
                         <div class="ld-info">
                            <ul>
                               <li class="item-preview" data-toggle="tooltip" data-placement="top" data-original-title="Quick view">
                                  <a href="#" type="button" class="c27-toggle-quick-view-modal" data-id="157">
                                  <i class="fa fa-search-plus"></i>
                                  </a>
                               </li>
                               <li data-toggle="tooltip" data-placement="top" title="" data-original-title="Bookmark">
                                  <a class="c27-bookmark-button " data-listing-id="157" onclick="MyListing.Handlers.Bookmark_Button(event, this)">
                                  <i class="fa fa-heart"></i>
                                  </a>
                               </li>
                            </ul>
                         </div>
                      </div>
                   </div>
                </div>
            </div>
            <div class="col-sm-4 sidegapp_pro">
                <div class="item">
                   <div class="lf-item-container listing-preview type-place lf-type-2 post-157 job_listing type-job_listing status-publish hentry job_listing_category-nightlife job_listing_category-restaurants region-london case27_job_listing_tags-accepts-credit-cards case27_job_listing_tags-bike-parking case27_job_listing_tags-coupons case27_job_listing_tags-parking-street case27_job_listing_tags-wireless-internet job_position_featured c27-verified has-logo has-tagline has-info-fields level-promoted priority-2">
                      <div class="lf-item lf-item-alternate" data-template="alternate">
                         <a href="#">
                            <div class="overlay" style="
                               background-color: #242429;
                               opacity: 0.4;
                               "></div>
                            <div class="lf-background" style="background-image: url('https://ads.strokedev.net/uploads/slider_image/da15b63c3a0f6b-768x512.jpg');"></div>
                            <div class="lf-item-info-2">
                               <div class="lf-avatar" style="background-image: url('https://ads.strokedev.net/uploads/slider_image/2625af16c063a7-150x150.png')"></div>
                               <h4 class="case27-primary-text listing-preview-title">
                                  Liman Restaurant  <img class="verified-listing" src="https://ads.strokedev.net/uploads/slider_image/tick.svg">
                               </h4>
                               <h6>Innovative cooking, paired with fine wines</h6>
                               <ul class="lf-contact">
                                  <li>
                                     <i class="icon-phone-outgoing sm-icon"></i>
                                     +44 20 1324 21            
                                  </li>
                                  <li>
                                     <i class="icon-location-pin-add-2 sm-icon"></i>
                                     60 Penton Street            
                                  </li>
                               </ul>
                            </div>
                            <div class="lf-head level-promoted">
                               <div class="lf-head-btn ad-badge" data-toggle="tooltip" data-placement="bottom" data-original-title="Promoted">
                                  <span><i class="icon-flash"></i></span>
                               </div>
                               <div class="lf-head-btn ">
                                  $$                
                               </div>
                               <div class="lf-head-btn  listing-rating rating-preview-card">
                                  <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>                
                               </div>
                               <div class="lf-head-btn  open-status listing-status-open">
                                  OPEN                
                               </div>
                            </div>
                         </a>
                      </div>
                      <div class="listing-details c27-footer-section">
                         <ul class="c27-listing-preview-category-list">
                            <li>
                               <a href="#">
                               <span class="cat-icon" style="background-color: #ff6600;">
                               <i class="fa fa-cutlery" style="color: #fff; "></i>
                               </span>
                               <span class="category-name">Restaurants</span>
                               </a>
                            </li>
                            
                         </ul>
                         <div class="ld-info">
                            <ul>
                               <li class="item-preview" data-toggle="tooltip" data-placement="top" data-original-title="Quick view">
                                  <a href="#" type="button" class="c27-toggle-quick-view-modal" data-id="157">
                                  <i class="fa fa-search-plus"></i>
                                  </a>
                               </li>
                               <li data-toggle="tooltip" data-placement="top" title="" data-original-title="Bookmark">
                                  <a class="c27-bookmark-button " data-listing-id="157" onclick="MyListing.Handlers.Bookmark_Button(event, this)">
                                  <i class="fa fa-heart"></i>
                                  </a>
                               </li>
                            </ul>
                         </div>
                      </div>
                   </div>
                </div>
            </div>
            
            </div>  
            </div>


            <div id="tab-3" class="tab-content eventsbox">
                
                <div class="row">
            <div class="col-sm-4 sidegapp_pro">
                <div class="item">
                   <div class="lf-item-container listing-preview type-place lf-type-2 post-157 job_listing type-job_listing status-publish hentry job_listing_category-nightlife job_listing_category-restaurants region-london case27_job_listing_tags-accepts-credit-cards case27_job_listing_tags-bike-parking case27_job_listing_tags-coupons case27_job_listing_tags-parking-street case27_job_listing_tags-wireless-internet job_position_featured c27-verified has-logo has-tagline has-info-fields level-promoted priority-2">
                      <div class="lf-item lf-item-alternate" data-template="alternate">
                         <a href="#">
                            <div class="overlay" style="
                               background-color: #242429;
                               opacity: 0.4;
                               "></div>
                            <div class="lf-background" style="background-image: url('https://ads.strokedev.net/uploads/slider_image/da15b63c3a0f6b-768x512.jpg');"></div>
                            <div class="lf-item-info-2">
                               <div class="lf-avatar" style="background-image: url('https://ads.strokedev.net/uploads/slider_image/2625af16c063a7-150x150.png')"></div>
                               <h4 class="case27-primary-text listing-preview-title">
                                  Liman Restaurant  <img class="verified-listing" src="https://ads.strokedev.net/uploads/slider_image/tick.svg">
                               </h4>
                               <h6>Innovative cooking, paired with fine wines</h6>
                               <ul class="lf-contact">
                                  <li>
                                     <i class="icon-phone-outgoing sm-icon"></i>
                                     +44 20 1324 21            
                                  </li>
                                  <li>
                                     <i class="icon-location-pin-add-2 sm-icon"></i>
                                     60 Penton Street            
                                  </li>
                               </ul>
                            </div>
                            <div class="lf-head level-promoted">
                               <div class="lf-head-btn ad-badge" data-toggle="tooltip" data-placement="bottom" data-original-title="Promoted">
                                  <span><i class="icon-flash"></i></span>
                               </div>
                               <div class="lf-head-btn ">
                                  $$                
                               </div>
                               <div class="lf-head-btn  listing-rating rating-preview-card">
                                  <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>                
                               </div>
                               <div class="lf-head-btn  open-status listing-status-open">
                                  OPEN                
                               </div>
                            </div>
                         </a>
                      </div>
                      
                   </div>
                </div>
            </div>
            <div class="col-sm-4 sidegapp_pro">
                <div class="item">
                   <div class="lf-item-container listing-preview type-place lf-type-2 post-157 job_listing type-job_listing status-publish hentry job_listing_category-nightlife job_listing_category-restaurants region-london case27_job_listing_tags-accepts-credit-cards case27_job_listing_tags-bike-parking case27_job_listing_tags-coupons case27_job_listing_tags-parking-street case27_job_listing_tags-wireless-internet job_position_featured c27-verified has-logo has-tagline has-info-fields level-promoted priority-2">
                      <div class="lf-item lf-item-alternate" data-template="alternate">
                         <a href="#">
                            <div class="overlay" style="
                               background-color: #242429;
                               opacity: 0.4;
                               "></div>
                            <div class="lf-background" style="background-image: url('https://ads.strokedev.net/uploads/slider_image/da15b63c3a0f6b-768x512.jpg');"></div>
                            <div class="lf-item-info-2">
                               <div class="lf-avatar" style="background-image: url('https://ads.strokedev.net/uploads/slider_image/2625af16c063a7-150x150.png')"></div>
                               <h4 class="case27-primary-text listing-preview-title">
                                  Liman Restaurant  <img class="verified-listing" src="https://ads.strokedev.net/uploads/slider_image/tick.svg">
                               </h4>
                               <h6>Innovative cooking, paired with fine wines</h6>
                               <ul class="lf-contact">
                                  <li>
                                     <i class="icon-phone-outgoing sm-icon"></i>
                                     +44 20 1324 21            
                                  </li>
                                  <li>
                                     <i class="icon-location-pin-add-2 sm-icon"></i>
                                     60 Penton Street            
                                  </li>
                               </ul>
                            </div>
                            <div class="lf-head level-promoted">
                               <div class="lf-head-btn ad-badge" data-toggle="tooltip" data-placement="bottom" data-original-title="Promoted">
                                  <span><i class="icon-flash"></i></span>
                               </div>
                               <div class="lf-head-btn ">
                                  $$                
                               </div>
                               <div class="lf-head-btn  listing-rating rating-preview-card">
                                  <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>                
                               </div>
                               <div class="lf-head-btn  open-status listing-status-open">
                                  OPEN                
                               </div>
                            </div>
                         </a>
                      </div>
                      
                   </div>
                </div>
            </div>
            
            </div>  
            </div>




            <div id="tab-4" class="tab-content eventsbox">
                
                <div class="row">
                    <div class="col-sm-4">
                        <div class="item">
                   <div class="lf-item-container listing-preview type-place lf-type-2 post-157 job_listing type-job_listing status-publish hentry job_listing_category-nightlife job_listing_category-restaurants region-london case27_job_listing_tags-accepts-credit-cards case27_job_listing_tags-bike-parking case27_job_listing_tags-coupons case27_job_listing_tags-parking-street case27_job_listing_tags-wireless-internet job_position_featured c27-verified has-logo has-tagline has-info-fields level-promoted priority-2">
                      <div class="lf-item lf-item-alternate" data-template="alternate" style="
    height: 154px !important;
">
                         <a href="#">
                            
                            
                            <div class="lf-item-info-2">
                               <div class="lf-avatar" style="background-image: url('https://ads.strokedev.net/uploads/slider_image/2625af16c063a7-150x150.png')"></div>
                               <h4 class="case27-primary-text listing-preview-title">
                                  Liman Restaurant  <img class="verified-listing" src="https://ads.strokedev.net/uploads/slider_image/tick.svg">
                               </h4>
                               <h6>Innovative cooking, paired with fine wines</h6>
                               <ul class="lf-contact">
                                  <li>
                                     <i class="icon-phone-outgoing sm-icon"></i>
                                     +44 20 1324 21            
                                  </li>
                                  <li>
                                     <i class="icon-location-pin-add-2 sm-icon"></i>
                                     60 Penton Street            
                                  </li>
                               </ul>
                            </div>
                            
                         </a>
                      </div>
                      <div class="listing-details c27-footer-section">
                         <ul class="c27-listing-preview-category-list">
                            <li>
                               <a href="#">
                               <span class="cat-icon" style="background-color: #ff6600;">
                               <i class="fa fa-cutlery" style="color: #fff; "></i>
                               </span>
                               <span class="category-name">Restaurants</span>
                               </a>
                            </li>
                            
                         </ul>
                         <div class="ld-info">
                            <ul>
                               <li class="item-preview" data-toggle="tooltip" data-placement="top" data-original-title="Quick view">
                                  <a href="#" type="button" class="c27-toggle-quick-view-modal" data-id="157">
                                  <i class="fa fa-search-plus"></i>
                                  </a>
                               </li>
                               <li data-toggle="tooltip" data-placement="top" title="" data-original-title="Bookmark">
                                  <a class="c27-bookmark-button " data-listing-id="157" onclick="MyListing.Handlers.Bookmark_Button(event, this)">
                                  <i class="fa fa-heart"></i>
                                  </a>
                               </li>
                            </ul>
                         </div>
                      </div>
                   </div>
                </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="item">
                   <div class="lf-item-container listing-preview type-place lf-type-2 post-157 job_listing type-job_listing status-publish hentry job_listing_category-nightlife job_listing_category-restaurants region-london case27_job_listing_tags-accepts-credit-cards case27_job_listing_tags-bike-parking case27_job_listing_tags-coupons case27_job_listing_tags-parking-street case27_job_listing_tags-wireless-internet job_position_featured c27-verified has-logo has-tagline has-info-fields level-promoted priority-2">
                      <div class="lf-item lf-item-alternate" data-template="alternate" style="
    height: 154px !important;
">
                         <a href="#">
                            
                            
                            <div class="lf-item-info-2">
                               <div class="lf-avatar" style="background-image: url('https://ads.strokedev.net/uploads/slider_image/2625af16c063a7-150x150.png')"></div>
                               <h4 class="case27-primary-text listing-preview-title">
                                  Liman Restaurant  <img class="verified-listing" src="https://ads.strokedev.net/uploads/slider_image/tick.svg">
                               </h4>
                               <h6>Innovative cooking, paired with fine wines</h6>
                               <ul class="lf-contact">
                                  <li>
                                     <i class="icon-phone-outgoing sm-icon"></i>
                                     +44 20 1324 21            
                                  </li>
                                  <li>
                                     <i class="icon-location-pin-add-2 sm-icon"></i>
                                     60 Penton Street            
                                  </li>
                               </ul>
                            </div>
                            
                         </a>
                      </div>
                      <div class="listing-details c27-footer-section">
                         <ul class="c27-listing-preview-category-list">
                            <li>
                               <a href="#">
                               <span class="cat-icon" style="background-color: #ff6600;">
                               <i class="fa fa-cutlery" style="color: #fff; "></i>
                               </span>
                               <span class="category-name">Restaurants</span>
                               </a>
                            </li>
                            
                         </ul>
                         <div class="ld-info">
                            <ul>
                               <li class="item-preview" data-toggle="tooltip" data-placement="top" data-original-title="Quick view">
                                  <a href="#" type="button" class="c27-toggle-quick-view-modal" data-id="157">
                                  <i class="fa fa-search-plus"></i>
                                  </a>
                               </li>
                               <li data-toggle="tooltip" data-placement="top" title="" data-original-title="Bookmark">
                                  <a class="c27-bookmark-button " data-listing-id="157" onclick="MyListing.Handlers.Bookmark_Button(event, this)">
                                  <i class="fa fa-heart"></i>
                                  </a>
                               </li>
                            </ul>
                         </div>
                      </div>
                   </div>
                </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="item">
                   <div class="lf-item-container listing-preview type-place lf-type-2 post-157 job_listing type-job_listing status-publish hentry job_listing_category-nightlife job_listing_category-restaurants region-london case27_job_listing_tags-accepts-credit-cards case27_job_listing_tags-bike-parking case27_job_listing_tags-coupons case27_job_listing_tags-parking-street case27_job_listing_tags-wireless-internet job_position_featured c27-verified has-logo has-tagline has-info-fields level-promoted priority-2">
                      <div class="lf-item lf-item-alternate" data-template="alternate" style="
    height: 154px !important;
">
                         <a href="#">
                            
                            
                            <div class="lf-item-info-2">
                               <div class="lf-avatar" style="background-image: url('https://ads.strokedev.net/uploads/slider_image/2625af16c063a7-150x150.png')"></div>
                               <h4 class="case27-primary-text listing-preview-title">
                                  Liman Restaurant  <img class="verified-listing" src="https://ads.strokedev.net/uploads/slider_image/tick.svg">
                               </h4>
                               <h6>Innovative cooking, paired with fine wines</h6>
                               <ul class="lf-contact">
                                  <li>
                                     <i class="icon-phone-outgoing sm-icon"></i>
                                     +44 20 1324 21            
                                  </li>
                                  <li>
                                     <i class="icon-location-pin-add-2 sm-icon"></i>
                                     60 Penton Street            
                                  </li>
                               </ul>
                            </div>
                            
                         </a>
                      </div>
                      <div class="listing-details c27-footer-section">
                         <ul class="c27-listing-preview-category-list">
                            <li>
                               <a href="#">
                               <span class="cat-icon" style="background-color: #ff6600;">
                               <i class="fa fa-cutlery" style="color: #fff; "></i>
                               </span>
                               <span class="category-name">Restaurants</span>
                               </a>
                            </li>
                            
                         </ul>
                         <div class="ld-info">
                            <ul>
                               <li class="item-preview" data-toggle="tooltip" data-placement="top" data-original-title="Quick view">
                                  <a href="#" type="button" class="c27-toggle-quick-view-modal" data-id="157">
                                  <i class="fa fa-search-plus"></i>
                                  </a>
                               </li>
                               <li data-toggle="tooltip" data-placement="top" title="" data-original-title="Bookmark">
                                  <a class="c27-bookmark-button " data-listing-id="157" onclick="MyListing.Handlers.Bookmark_Button(event, this)">
                                  <i class="fa fa-heart"></i>
                                  </a>
                               </li>
                            </ul>
                         </div>
                      </div>
                   </div>
                </div>
                    </div>
            
            
            </div>  
            </div>


              <div id="tab-5" class="tab-content eventsbox">
                <div class="listing_inner">
                        <ul>
                            <li><a href="#"><i class="fa fa-whatsapp"></i> Direct Message</a></li>
                            <li><a href="#"><i class="fa fa-phone"></i> Call Now</a></li>
                            <li><a href="#"><i class="fa fa-link"></i> Website</a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i> Send an Email</a></li>
                            <li><a href="#"><i class="fa fa-heart"></i> Bookmark</a></li>
                            <li><a href="#"><i class="fa fa-share"></i> Share</a></li>
                            <li><a href="#"><i class="fa fa-map-marker"></i> Get Directions</a></li>
                            <li><a href="#"><i class="fa fa-info"></i> Report</a></li>
                        </ul>
                    </div>
                  <div class="listing_info nostore">
                    <h4>There are no listings matching your search.</h4>
                </div>
              </div>


              
              <div id="tab-6" class="tab-content eventsbox">
                
                  <div class="row">
                    <div class="col-sm-6">
                          <div class="description smedesign reviewbox">
                                <div class="reviesbox">
                                    <img src="https://ads.strokedev.net/uploads/slider_image/2625af16c063a7.png">
                                    <h4>CommunityHL@_Admin0M87612</h4>
                                    <p>April 1, 2022 at 1:14 am</p>
                                    <h6>Great service. Highly recommended!</h6>
                                    <h5>Overall Rating</h5>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                            </div>
                      </div>
                      <div class="col-sm-6">
                          <div class="description smedesign">
                                <h4><i class="fa fa-envelope"></i> Add a review</h4>
                                <p>You must be <a href="#">logged in</a> to post a comment.</p>
                            </div>
                      </div>
                  </div>
              </div>
    </div>
</div>


<div class="related_box">
    <div class="container">
        <div class="listing_info">
            <h4>You May Also Be Interested In</h4>
            <p>Explore and contact businesses directly with no obligation</p>
        </div>
        <div class="row">
            <div class="col-sm-4 sidegapp_pro">
                <div class="item">
                   <div class="lf-item-container listing-preview type-place lf-type-2 post-157 job_listing type-job_listing status-publish hentry job_listing_category-nightlife job_listing_category-restaurants region-london case27_job_listing_tags-accepts-credit-cards case27_job_listing_tags-bike-parking case27_job_listing_tags-coupons case27_job_listing_tags-parking-street case27_job_listing_tags-wireless-internet job_position_featured c27-verified has-logo has-tagline has-info-fields level-promoted priority-2">
                      <div class="lf-item lf-item-alternate" data-template="alternate">
                         <a href="#">
                            <div class="overlay" style="
                               background-color: #242429;
                               opacity: 0.4;
                               "></div>
                            <div class="lf-background" style="background-image: url('https://ads.strokedev.net/uploads/slider_image/da15b63c3a0f6b-768x512.jpg');"></div>
                            <div class="lf-item-info-2">
                               <div class="lf-avatar" style="background-image: url('https://ads.strokedev.net/uploads/slider_image/2625af16c063a7-150x150.png')"></div>
                               <h4 class="case27-primary-text listing-preview-title">
                                  Liman Restaurant  <img class="verified-listing" src="https://ads.strokedev.net/uploads/slider_image/tick.svg">
                               </h4>
                               <h6>Innovative cooking, paired with fine wines</h6>
                               <ul class="lf-contact">
                                  <li>
                                     <i class="icon-phone-outgoing sm-icon"></i>
                                     +44 20 1324 21            
                                  </li>
                                  <li>
                                     <i class="icon-location-pin-add-2 sm-icon"></i>
                                     60 Penton Street            
                                  </li>
                               </ul>
                            </div>
                            <div class="lf-head level-promoted">
                               <div class="lf-head-btn ad-badge" data-toggle="tooltip" data-placement="bottom" data-original-title="Promoted">
                                  <span><i class="icon-flash"></i></span>
                               </div>
                               <div class="lf-head-btn ">
                                  $$                
                               </div>
                               <div class="lf-head-btn  listing-rating rating-preview-card">
                                  <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>                
                               </div>
                               <div class="lf-head-btn  open-status listing-status-open">
                                  OPEN                
                               </div>
                            </div>
                         </a>
                      </div>
                      <div class="listing-details c27-footer-section">
                         <ul class="c27-listing-preview-category-list">
                            <li>
                               <a href="#">
                               <span class="cat-icon" style="background-color: #ff6600;">
                               <i class="fa fa-cutlery" style="color: #fff; "></i>
                               </span>
                               <span class="category-name">Restaurants</span>
                               </a>
                            </li>
                            
                         </ul>
                         <div class="ld-info">
                            <ul>
                               <li class="item-preview" data-toggle="tooltip" data-placement="top" data-original-title="Quick view">
                                  <a href="#" type="button" class="c27-toggle-quick-view-modal" data-id="157">
                                  <i class="fa fa-search-plus"></i>
                                  </a>
                               </li>
                               <li data-toggle="tooltip" data-placement="top" title="" data-original-title="Bookmark">
                                  <a class="c27-bookmark-button " data-listing-id="157" onclick="MyListing.Handlers.Bookmark_Button(event, this)">
                                  <i class="fa fa-heart"></i>
                                  </a>
                               </li>
                            </ul>
                         </div>
                      </div>
                   </div>
                </div>
            </div>
            <div class="col-sm-4 sidegapp_pro">
                <div class="item">
                   <div class="lf-item-container listing-preview type-place lf-type-2 post-157 job_listing type-job_listing status-publish hentry job_listing_category-nightlife job_listing_category-restaurants region-london case27_job_listing_tags-accepts-credit-cards case27_job_listing_tags-bike-parking case27_job_listing_tags-coupons case27_job_listing_tags-parking-street case27_job_listing_tags-wireless-internet job_position_featured c27-verified has-logo has-tagline has-info-fields level-promoted priority-2">
                      <div class="lf-item lf-item-alternate" data-template="alternate">
                         <a href="#">
                            <div class="overlay" style="
                               background-color: #242429;
                               opacity: 0.4;
                               "></div>
                            <div class="lf-background" style="background-image: url('https://ads.strokedev.net/uploads/slider_image/da15b63c3a0f6b-768x512.jpg');"></div>
                            <div class="lf-item-info-2">
                               <div class="lf-avatar" style="background-image: url('https://ads.strokedev.net/uploads/slider_image/2625af16c063a7-150x150.png')"></div>
                               <h4 class="case27-primary-text listing-preview-title">
                                  Liman Restaurant  <img class="verified-listing" src="https://ads.strokedev.net/uploads/slider_image/tick.svg">
                               </h4>
                               <h6>Innovative cooking, paired with fine wines</h6>
                               <ul class="lf-contact">
                                  <li>
                                     <i class="icon-phone-outgoing sm-icon"></i>
                                     +44 20 1324 21            
                                  </li>
                                  <li>
                                     <i class="icon-location-pin-add-2 sm-icon"></i>
                                     60 Penton Street            
                                  </li>
                               </ul>
                            </div>
                            <div class="lf-head level-promoted">
                               <div class="lf-head-btn ad-badge" data-toggle="tooltip" data-placement="bottom" data-original-title="Promoted">
                                  <span><i class="icon-flash"></i></span>
                               </div>
                               <div class="lf-head-btn ">
                                  $$                
                               </div>
                               <div class="lf-head-btn  listing-rating rating-preview-card">
                                  <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>                
                               </div>
                               <div class="lf-head-btn  open-status listing-status-open">
                                  OPEN                
                               </div>
                            </div>
                         </a>
                      </div>
                      <div class="listing-details c27-footer-section">
                         <ul class="c27-listing-preview-category-list">
                            <li>
                               <a href="#">
                               <span class="cat-icon" style="background-color: #ff6600;">
                               <i class="fa fa-cutlery" style="color: #fff; "></i>
                               </span>
                               <span class="category-name">Restaurants</span>
                               </a>
                            </li>
                            
                         </ul>
                         <div class="ld-info">
                            <ul>
                               <li class="item-preview" data-toggle="tooltip" data-placement="top" data-original-title="Quick view">
                                  <a href="#" type="button" class="c27-toggle-quick-view-modal" data-id="157">
                                  <i class="fa fa-search-plus"></i>
                                  </a>
                               </li>
                               <li data-toggle="tooltip" data-placement="top" title="" data-original-title="Bookmark">
                                  <a class="c27-bookmark-button " data-listing-id="157" onclick="MyListing.Handlers.Bookmark_Button(event, this)">
                                  <i class="fa fa-heart"></i>
                                  </a>
                               </li>
                            </ul>
                         </div>
                      </div>
                   </div>
                </div>
            </div>
            <div class="col-sm-4 sidegapp_pro">
                <div class="item">
                   <div class="lf-item-container listing-preview type-place lf-type-2 post-157 job_listing type-job_listing status-publish hentry job_listing_category-nightlife job_listing_category-restaurants region-london case27_job_listing_tags-accepts-credit-cards case27_job_listing_tags-bike-parking case27_job_listing_tags-coupons case27_job_listing_tags-parking-street case27_job_listing_tags-wireless-internet job_position_featured c27-verified has-logo has-tagline has-info-fields level-promoted priority-2">
                      <div class="lf-item lf-item-alternate" data-template="alternate">
                         <a href="#">
                            <div class="overlay" style="
                               background-color: #242429;
                               opacity: 0.4;
                               "></div>
                            <div class="lf-background" style="background-image: url('https://ads.strokedev.net/uploads/slider_image/da15b63c3a0f6b-768x512.jpg');"></div>
                            <div class="lf-item-info-2">
                               <div class="lf-avatar" style="background-image: url('https://ads.strokedev.net/uploads/slider_image/2625af16c063a7-150x150.png')"></div>
                               <h4 class="case27-primary-text listing-preview-title">
                                  Liman Restaurant  <img class="verified-listing" src="https://ads.strokedev.net/uploads/slider_image/tick.svg">
                               </h4>
                               <h6>Innovative cooking, paired with fine wines</h6>
                               <ul class="lf-contact">
                                  <li>
                                     <i class="icon-phone-outgoing sm-icon"></i>
                                     +44 20 1324 21            
                                  </li>
                                  <li>
                                     <i class="icon-location-pin-add-2 sm-icon"></i>
                                     60 Penton Street            
                                  </li>
                               </ul>
                            </div>
                            <div class="lf-head level-promoted">
                               <div class="lf-head-btn ad-badge" data-toggle="tooltip" data-placement="bottom" data-original-title="Promoted">
                                  <span><i class="icon-flash"></i></span>
                               </div>
                               <div class="lf-head-btn ">
                                  $$                
                               </div>
                               <div class="lf-head-btn  listing-rating rating-preview-card">
                                  <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>                
                               </div>
                               <div class="lf-head-btn  open-status listing-status-open">
                                  OPEN                
                               </div>
                            </div>
                         </a>
                      </div>
                      <div class="listing-details c27-footer-section">
                         <ul class="c27-listing-preview-category-list">
                            <li>
                               <a href="#">
                               <span class="cat-icon" style="background-color: #ff6600;">
                               <i class="fa fa-cutlery" style="color: #fff; "></i>
                               </span>
                               <span class="category-name">Restaurants</span>
                               </a>
                            </li>
                            
                         </ul>
                         <div class="ld-info">
                            <ul>
                               <li class="item-preview" data-toggle="tooltip" data-placement="top" data-original-title="Quick view">
                                  <a href="#" type="button" class="c27-toggle-quick-view-modal" data-id="157">
                                  <i class="fa fa-search-plus"></i>
                                  </a>
                               </li>
                               <li data-toggle="tooltip" data-placement="top" title="" data-original-title="Bookmark">
                                  <a class="c27-bookmark-button " data-listing-id="157" onclick="MyListing.Handlers.Bookmark_Button(event, this)">
                                  <i class="fa fa-heart"></i>
                                  </a>
                               </li>
                            </ul>
                         </div>
                      </div>
                   </div>
                </div>
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