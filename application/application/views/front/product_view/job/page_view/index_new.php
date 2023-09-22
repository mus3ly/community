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
?>
<style type="text/css">
.header .header-wrapper {
    padding: 15px 0 20px 0 !important;
    background: #000 !important;
}
.item a {
    padding: 0 !important;
}

</style>

<head>
   <link rel="stylesheet" type="text/css" href="https://ads.strokedev.net/template/front/js/owl.carousel.css">
</head>

<div class="slider_imgbox">
    <div class="container">
        <div id="image-gallery">
            <h3 style="font-weight: 600 !important;margin: 0 0 2px 0;">Photos</h3>
        </div>
         
        <div id="small-categories" class="owl-carousel owl-carousel-icons owl-loaded owl-drag">
                  <div class="owl-stage-outer">
                     <div class="owl-stage" style="transform: translate3d(-3002px, 0px, 0px); transition: all 0.25s ease 0s; width: 4804px;">
                        <div class="owl-item">
                           <div class="item">
                              <div class="image">
                                  <div class="img-wrapper">
                                    <a href="https://res.cloudinary.com/community-hubland-ltd/image/upload/c_scale,h_500,q_500/pngn3f7khnjr39wymtna.jpg"><img src="https://res.cloudinary.com/community-hubland-ltd/image/upload/c_scale,h_500,q_500/pngn3f7khnjr39wymtna.jpg" class="img-responsive"></a>
                                    <div class="img-overlay" style="opacity: 0;">
                                      <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                    </div>
                                  </div>
                                </div>
                           </div>
                        </div>
                        <div class="owl-item">
                           <div class="item">
                              <div class="image">
                                  <div class="img-wrapper">
                                    <a href="https://res.cloudinary.com/community-hubland-ltd/image/upload/c_scale,h_500,q_500/pngn3f7khnjr39wymtna.jpg"><img src="https://res.cloudinary.com/community-hubland-ltd/image/upload/c_scale,h_500,q_500/pngn3f7khnjr39wymtna.jpg" class="img-responsive"></a>
                                    <div class="img-overlay" style="opacity: 0;">
                                      <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                    </div>
                                  </div>
                                </div>
                           </div>
                        </div>
                        <div class="owl-item">
                           <div class="item">
                              <div class="image">
                                  <div class="img-wrapper">
                                    <a href="https://res.cloudinary.com/community-hubland-ltd/image/upload/c_scale,h_500,q_500/pngn3f7khnjr39wymtna.jpg"><img src="https://res.cloudinary.com/community-hubland-ltd/image/upload/c_scale,h_500,q_500/pngn3f7khnjr39wymtna.jpg" class="img-responsive"></a>
                                    <div class="img-overlay" style="opacity: 0;">
                                      <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                    </div>
                                  </div>
                                </div>
                           </div>
                        </div>
                        <div class="owl-item">
                           <div class="item">
                              <div class="image">
                                  <div class="img-wrapper">
                                    <a href="https://res.cloudinary.com/community-hubland-ltd/image/upload/c_scale,h_500,q_500/pngn3f7khnjr39wymtna.jpg"><img src="https://res.cloudinary.com/community-hubland-ltd/image/upload/c_scale,h_500,q_500/pngn3f7khnjr39wymtna.jpg" class="img-responsive"></a>
                                    <div class="img-overlay" style="opacity: 0;">
                                      <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                    </div>
                                  </div>
                                </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="owl-nav">
                     <button type="button" role="presentation" class="owl-prev"><span aria-label="Previous">‹</span></button>
                     <button type="button" role="presentation" class="owl-next"><span aria-label="Next">›</span>
                     </button>
                  </div>
                  <div class="owl-dots disabled"></div>
               </div>



        <!-- <section id="gallery">
          <div id="image-gallery">
           
              <div class="row">
                <?php
                foreach ($imgs as $key => $value) {
                    $img = $this->crud_model->size_img($value['img'],500,500);
                    ?>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 image">
                  <div class="img-wrapper">
                    <a href="<?= $img; ?>"><img src="<?= $img; ?>" class="img-responsive"></a>
                    <div class="img-overlay">
                      <i class="fa fa-plus-circle" aria-hidden="true"></i>
                    </div>
                  </div>
                </div>

                    <?php
                }
                ?>
                
              </div>
            </div>
        </section> -->
        
    </div>
</div>

<div class="hotel_london">
    <div class="container">
        <div class="row white__box">
            <div class="col-sm-2 building_bx">
                <img src="<?= $logo ?>" alt="">
            </div>
            <div class="col-sm-8 london_info">
                <h3><?= $pro['title'] ?></h3>
                <p><?= $cat; ?></p>
                <p><?= $address; ?></p>
            </div>
            <div class="col-sm-2 save_share">
                <a href="#">Save</a>
                <a href="#">Share</a>
            </div>
        </div>
    </div>
</div>


<div id="tabs__box">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 sideleft">
                <div class="radius_bg">
                    <?= $pro['description']; ?>
                </div>


                <div class="account_box">
                    <img src="https://ads.strokedev.net/uploads/slider_image/upsell_bgcircle_f-b8512198dd547659d7a12a2344a22b0c.png">
                    <h4>See what your friends are saying about The W14 Hotel Kensington London.</h4>
                    <p>By creating an account you are able to follow friends and experts you trust and see the places they’ve recommended.</p>
                    <a href="#" class="facebookbtn"><i class="fa fa-facebook"></i> Sign up with Facebook</a>
                    <span>Or</span>
                    <a href="#" class="signupbtn"> Sign up with email</a>
                </div>

                <div class="tips_review">
                    <h4>19 Tips and reviews</h4>
                </div>
            </div>
            <div class="col-sm-4 sideright">
                <div class="mapinfobox">
                    <div id="googleMap" style="width:100%;height:400px;"></div>

                    <h4><?= $address; ?></h4>
                    <p>16-22 Gunterstone Road (Kensington) London Greater London W14 9BU United Kingdom</p>
                </div>

                <div class="might_box">
                    <b>You might also like</b>
                    <div class="might_innerbox">
                        <div class="resturant">
                            <a href="#">
                                <img src="https://ads.strokedev.net/uploads/slider_image/slider3.jpg" alt="">
                                <span>8.2</span>
                                <h5>St Paul's Hotel</h5>
                                <p>Hotel</p>
                                <p>253 Hammersmith Rd</p>
                            </a>
                        </div>
                        <div class="bottominfo">
                            <p>"Nice bar for a quiet drink. Lovely building."</p>
                            <h6><img src="https://ads.strokedev.net/uploads/slider_image/7202359-QVF4QGBODVBQP2EY.jpg" alt=""> Johanna English</h6>
                        </div>
                    </div>

                    <div class="might_innerbox">
                        <div class="resturant">
                            <a href="#">
                                <img src="https://ads.strokedev.net/uploads/slider_image/slider4.jpg" alt="">
                                <span>8.2</span>
                                <h5>The Ampersand Hotel</h5>
                                <p>Hotel</p>
                                <p>253 Hammersmith Rd</p>
                            </a>
                        </div>
                        <div class="bottominfo">
                            <p>"Nice bar for a quiet drink. Lovely building."</p>
                            <h6><img src="https://ads.strokedev.net/uploads/slider_image/7202359-QVF4QGBODVBQP2EY.jpg" alt=""> Johanna English</h6>
                        </div>
                    </div>

                    <div class="might_innerbox">
                        <div class="resturant">
                            <a href="#">
                                <img src="https://ads.strokedev.net/uploads/slider_image/slider3.jpg" alt="">
                                <span>8.2</span>
                                <h5>Premier Inn</h5>
                                <p>Hotel</p>
                                <p>253 Hammersmith Rd</p>
                            </a>
                        </div>
                        <div class="bottominfo">
                            <p>"Nice bar for a quiet drink. Lovely building."</p>
                            <h6><img src="https://ads.strokedev.net/uploads/slider_image/7202359-QVF4QGBODVBQP2EY.jpg" alt=""> Johanna English</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://ads.strokedev.net/template/front/js/jquery-3.2.1.min.js"></script>
<script src="https://ads.strokedev.net/template/front/js/owl.carousel.js"></script>
<script src="https://ads.strokedev.net/template/front/js/custom.js"></script>
<!-- <script src="https://ads.strokedev.net/template/front/js/custom.js"></script> -->
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

