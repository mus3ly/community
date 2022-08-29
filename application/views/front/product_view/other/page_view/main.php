<?php
$pro = array();
if(isset($product_data[0]))
{
    $pro = $product_data[0];
}
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
</style>
</head>
<body id="page-name">
<div class="lines_shape">
    <img src="<?= base_url(); ?>template/front/images/lines-shape.png" alt="">
</div>





<div class="gallery_wrap">
    <div class="container">
        <div id="wrap" >
<!-- big img -->
                <div class="big_imgmove" >
                    <?php
                    
                    ?>
                    <img src="<?= $fimg; ?>" class="d-block w-100" alt="...">
                    <div class="share_save_btns">
                         <?php
                    if ($this->session->userdata('user_login') == "yes") {
                        
                        $user_id = $this->session->userdata('user_id');
                    ?>
                        <a href="#" class="review-btn"><i class="fa-solid fa-star"></i>Write a review</a>
                        <a href="#" class="orange_btn_save">SAVE</a>
                        <a href="#" class="share_btns">SHARE</a>
                    <?php
                    }
                    ?>
                   
                    </div>
                </div>
            <div id="small-categories" class="owl-carousel owl-carousel-icons1 owl-loaded owl-drag">
                


                <!-- small img -->
                  <div class="owl-stage-outer">
                     <div class="owl-stage" style="transform: translate3d(-3002px, 0px, 0px); transition: all 0.25s ease 0s; width: 4804px;">
                        
                            <?php
                            
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


<div class="info_box_wrap">
    <div class="container">
        <div class="inner_box_info">
            <h2>Information</h2>
            <p><?= $pro['description']; ?></p>
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

    </div>
</div>

<div class="orange_pathwrap" style="margin-top: 0;">
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


        <div class="client_say">
            <div class="container">
                <div class="clients_box">
                    <h3>Take a look what our client Says</h3>
                    <h4>Reviews</h4>
                </div>
                <div class="row">
                    <div class="col-sm-4 cilent_gapp">
                        <div class="info_client">
                            <img src="<?= base_url(); ?>template/front/images/Group 19.png" alt="">
                            <h4>Boby Gusmon</h4>
                            <h6>Euismod ipsum</h6>
                            <p>“In purus at morbi magna in in maecenas. Nunc nulla magna elit, varius phasellus blandit convallis.”</p>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-half-star"></i>
                            <span>4,5</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 cilent_gapp">
                        <div class="info_client">
                            <img src="<?= base_url(); ?>template/front/images/Group 19.png" alt="">
                            <h4>Boby Gusmon</h4>
                            <h6>Euismod ipsum</h6>
                            <p>“In purus at morbi magna in in maecenas. Nunc nulla magna elit, varius phasellus blandit convallis.”</p>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-half-star"></i>
                            <span>4,5</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 cilent_gapp">
                        <div class="info_client">
                            <img src="<?= base_url(); ?>template/front/images/Group 19.png" alt="">
                            <h4>Boby Gusmon</h4>
                            <h6>Euismod ipsum</h6>
                            <p>“In purus at morbi magna in in maecenas. Nunc nulla magna elit, varius phasellus blandit convallis.”</p>
                            <div class="rating">
                                <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-half-star"></i>
                            <span>4,5</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


<div class="listing_view_gapp">
    <div class="container">
        <div class="container">
            <div class="verify_head">
                <h3>You May Also be Interested In</h3>
                <p>You can now list your business in less than 5 minutes</p>
            </div>
            <div class="row">
                            <div class="col-sm-4 bottom_box">
                                <div class="inner_bottombox">
                                    <img src="<?= base_url(); ?>template/front/images/img-2.png" alt="">
                                    <div class="sidegapp_bottom">
                                        <h5>Jan 21, 2019      45 Comments       10 Share</h5>
                                        <h3>Shrimp and Avocado Salad with Miso Dressing</h3>
                                        <p>This Shrimp and Avocado Salad is topped with spicy shrimp, crisp cucumbers, spinach, creamy avocado, and a generous drizzle of miso dressing. The happiest green salad ever!</p>
                                        <a href="#">Read more <img src="<?= base_url(); ?>template/front/images/arrow-right1.png" alt=""></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 bottom_box">
                                <div class="inner_bottombox">
                                    <img src="<?= base_url(); ?>template/front/images/img-2.png" alt="">
                                    <div class="sidegapp_bottom">
                                        <h5>Jan 21, 2019      45 Comments       10 Share</h5>
                                        <h3>Shrimp and Avocado Salad with Miso Dressing</h3>
                                        <p>This Shrimp and Avocado Salad is topped with spicy shrimp, crisp cucumbers, spinach, creamy avocado, and a generous drizzle of miso dressing. The happiest green salad ever!</p>
                                        <a href="#">Read more <img src="<?= base_url(); ?>template/front/images/arrow-right1.png" alt=""></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4 bottom_box">
                                <div class="inner_bottombox">
                                    <img src="<?= base_url(); ?>template/front/images/img-3.png" alt="">
                                    <div class="sidegapp_bottom">
                                        <h5>Jan 21, 2019      45 Comments       10 Share</h5>
                                        <h3>Shrimp and Avocado Salad with Miso Dressing</h3>
                                        <p>This Shrimp and Avocado Salad is topped with spicy shrimp, crisp cucumbers, spinach, creamy avocado, and a generous drizzle of miso dressing. The happiest green salad ever!</p>
                                        <a href="#">Read more <img src="<?= base_url(); ?>template/front/images/arrow-right1.png" alt=""></a>
                                    </div>
                                </div>
                            </div>
                        </div>
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