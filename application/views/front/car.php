<?php


$url = base_url('updated/');
 include "header_new.php";
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
$nimgs = array();
if(isset($pro['comp_cover']) && $pro['comp_cover'])
{
$nimgs[] = $this->crud_model->size_img($pro['comp_cover'],500,500);
}
foreach($imgs as $k=> $v)
{
    $nimgs[] = $this->crud_model->size_img($v['img'],500,500);
}
$imgs = $nimgs;
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
// get vendor details

$vendor_id =json_decode( $pro['added_by']);
$id = $vendor_id->id;
$vendor = $this->db->where('vendor_id', $id)->get('vendor')->row_array();
$t = $vendor['create_timestamp'];
// echo date('Y',strtotime($t));
?>
<?php
if(isset($_GET['test']))
{
    include "index_new.php";
    die();
}
?>
<?php
    $additional_fields = json_decode($pro['additional_fields'], true);
    $names = array();
    $valus = array();
    if(isset($additional_fields['name']) && $additional_fields['name'])
    {
        $names = json_decode($additional_fields['name'],true);
        $valus = json_decode($additional_fields['value'],true);
    }
    if($valus && $names)
    {
        $col1= array();
        $col2= array();
        $i = 1;
        $lim = 30;
        $accor = array();
        foreach($names as $k=> $v)
        {
            if(strlen($valus[$k]) > $lim)
            {
                $accor[$v] = $valus[$k];
            }
            else
            {
            $i++;
            
            if($i%2 == 0)
            {
                if($valus[$k])
                $col1[$v] = $valus[$k];
            }
            else
            {
                if($valus[$k])
                $col2[$v] = $valus[$k];
            }
            }
        }
    }
        
    ?>
  <main>
    <div class="ads-details">
      <div class="container">
        <div class="row">
          <div class="col-lg-9 col-md-12 order-lg-1">
            <div class="ads-single-wrapper">
              <div class="carousel-outer" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="0">
                <div id="sync1" class="owl-carousel owl-theme">
                    <?php
                    foreach($imgs as $k=> $v)
                    {
                        ?>
                  <div class="item">
                      <a href="<?=$v?>" class="lightbox-image" data-fancybox="images" data-caption="">
                        <img src="<?=$v?>" alt="">
                      </a>
                  </div>
                  <?php
                    }
                    ?>
                </div>
                
                <div id="sync2"  class="owl-carousel owl-theme">
                    <?php
                    foreach($imgs as $k=> $v)
                    {
                        ?>
                  <div class="item">
                      <img src="<?= $v?>" alt="">
                  </div>
                  <?php
                    }
                    ?>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-12 order-lg-3">
            
            <div class="ad-info-wrapper" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
              <div class="info-header">
                  
                <?php
                if(isset($pro['slog']) && $pro['slog'])
                {
                    ?>
                <h2><?= $pro['slog'];?></h2>
                <?php
                }
                ?>
              </div>
              <hr>
              
            <?php
                if(isset($pro['description']) && $pro['description'])
                {
                    ?>
              <div class="product-details">
                <h3>Description</h3>
                <p><?= $pro['description']; ?></p> <br>
                <?php
                }
                ?>

                <div class="specification">
                  <h3>Specification</h3>
                  <ul>
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
                    <div class="row">
                      <div class="col-lg-6 col-md-6">
                        <li>
                          <i class="fa fa-check-square"></i>
                          <div class="texts">
                            <p class="title"><?= $v;?></p>
                            <p class="value"><?= $val ?></p>
                          </div>
                        </li>
                      </div>
                      
                    </div>
                    <?php
                        }
                          }
                        }
                     ?>
                  </ul>
                  <h3>Seller Comment</h3>
                  <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur Excepteur sint occaecat cupidatat non proident, sunt in culpa</p>
                </div>
                <div class="specification features">
                  <h3>Features</h3>
                  
                  <ul>
                    <div class="row">
                      <div class="col-lg-6 col-md-6">
                        <li>
                          <i class="fa fa-check-square"></i>
                          <div class="texts">
                            <p class="title">consectetur adipiscing elit</p>
                          </div>
                        </li>
                      </div>
                      <div class="col-lg-6 col-md-6">
                        <li>
                          <i class="fa fa-check-square"></i>
                          <div class="texts">
                            <p class="title">consectetur adipiscing elit</p>
                          </div>
                        </li>
                      </div>
                      <div class="col-lg-6 col-md-6">
                        <li>
                          <i class="fa fa-check-square"></i>
                          <div class="texts">
                            <p class="title">consectetur adipiscing elit</p>
                          </div>
                        </li>
                      </div>
                      <div class="col-lg-6 col-md-6">
                        <li>
                          <i class="fa fa-check-square"></i>
                          <div class="texts">
                            <p class="title">consectetur adipiscing elit</p>
                          </div>
                        </li>
                      </div>
                      <div class="col-lg-6 col-md-6">
                        <li>
                          <i class="fa fa-check-square"></i>
                          <div class="texts">
                            <p class="title">consectetur adipiscing elit</p>
                          </div>
                        </li>
                      </div>
                      <div class="col-lg-6 col-md-6">
                        <li>
                          <i class="fa fa-check-square"></i>
                          <div class="texts">
                            <p class="title">consectetur adipiscing elit</p>
                          </div>
                        </li>
                      </div>
                      <div class="col-lg-6 col-md-6">
                        <li>
                          <i class="fa fa-check-square"></i>
                          <div class="texts">
                            <p class="title">consectetur adipiscing elit</p>
                          </div>
                        </li>
                      </div>
                      <div class="col-lg-6 col-md-6">
                        <li>
                          <i class="fa fa-check-square"></i>
                          <div class="texts">
                            <p class="title">consectetur adipiscing elit</p>
                          </div>
                        </li>
                      </div>
                      <div class="col-lg-6 col-md-6">
                        <li>
                          <i class="fa fa-check-square"></i>
                          <div class="texts">
                            <p class="title">consectetur adipiscing elit</p>
                          </div>
                        </li>
                      </div>
                      <div class="col-lg-6 col-md-6">
                        <li>
                          <i class="fa fa-check-square"></i>
                          <div class="texts">
                            <p class="title">consectetur adipiscing elit</p>
                          </div>
                        </li>
                      </div>
                      <div class="col-lg-6 col-md-6">
                        <li>
                          <i class="fa fa-check-square"></i>
                          <div class="texts">
                            <p class="title">consectetur adipiscing elit</p>
                          </div>
                        </li>
                      </div>
                    </div>
                  </ul>
                </div>
                <div class="extra-desc">
                  <div class="row">
                    <div class="col-lg-5 order-lg-2">
                        <?php
                        
                        $cover = base_url().'template/front/images/volume.png';
                        if($pro['firstImg'])
                                                                    {
                                                                        $cover = $this->crud_model->size_img($pro['firstImg'],820,312);
                                                                    }
                                                                    ?>
                      <img src="<?= $cover; ?>" alt="" class="img-fluid">
                    </div>
                    <div class="col-lg-7 order-lg-1">
                            
            <?php
            if(isset($pro['discip_heading']) && $pro['discip_heading'])
            {
                ?>
                <h3><?= $pro['discip_heading']; ?></h3>
                <?php
            }
            ?>
                      <?php
            if(isset($pro['main_heading']) && $pro['main_heading'])
            {
                ?>
                <p><?= $pro['main_heading']; ?></p>
                <?php
            }
            ?>
                       <ul>
                    <?php
                    $features = json_decode($pro['feature'], true);
                    foreach($features as $k => $v){
                        if(!empty($v['fdet']))
                        {
                    ?>
                        <li><?= $v['fdet'];?></li>
                    <?php
                        }
                    }
                    ?>
                    </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php
                $acc = $this->db->where('pid',$pro['product_id'])->get('product_to_accordion')->result_array();
                                        if($acc)
                                        {
                                            ?>
            <div class="ad-info-wrapper">
              <h2 class="mb-3"><?= $pro['accor_h']; ?></h2>
              <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Culpa porro hic officiis sit dolores quidem mollitia ut excepturi dicta architecto tempora laudantium debitis aspernatur omnis placeat, odit autem velit eveniet veritatis commodi facere repudiandae voluptatum? Rem hic harum molestias eaque beatae quos maxime, magnam mollitia perspiciatis!</p>
              <div class="product-faq">
                <div class="accordion accordion-flush" id="product-accr">
                    <?php
                    if($accor)
                                        {
                                            
                                            $ii = 99;
                                            foreach($accor as $k=> $v)
                                            {
                                                $ii ++;
                                                ?>
                                                <div class="accordion-item">
                    <h2 class="accordion-header" id="accr-<?= $ii ?>">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                        <?= $k; ?>
                      </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="accr-<?= $ii ?>" data-bs-parent="#product-accr">
                      <div class="accordion-body">
                        <p><?= $v; ?></p>
                      </div>
                    </div>
                  </div>
                                                <?php
                                            }
                                        }
                                        if($acc)
                                        {
                                            foreach($acc as $k=> $v)
                                            {
                                                $ii++;
                                                ?>
                                                <div class="accordion-item">
                    <h2 class="accordion-header" id="accr-<?= $ii ?>">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                        <?= $v['title']; ?>
                      </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="accr-<?= $ii ?>" data-bs-parent="#product-accr">
                      <div class="accordion-body">
                        <p><?= $v['detail']; ?></p>
                      </div>
                    </div>
                  </div>
                                                <?php
                                            } 
                                          }
                    ?>
                
                </div>
              </div>
              <?php
              $amn = 0;
                                    if($pro['amenities'])
                                    {
                                    $amn = explode(',',$pro['amenities']);
                                    }
                                    if(isset($pro['amenities']) && !empty($pro['amenities']) && $amn){
                                    ?>
              <div class="category">
                <div class="cat-box">
                  <div class="tag_sec_wrapper">

                    <div class="head_section">

                      <h4>Amenities</h4>

                    </div>

                    <div class="inner_sec">

                      <div class="tag_container">


                        
                            <?php
                                                    foreach($amn as $k => $v){
                                                    ?>
                                                    <div class="tags_in">
                          <i class="fa fa-check-square"></i>

                          <span><?= $v ?></span>

                        </div>
                        <?php
                                                    }
                        ?>


                      </div>

                    </div>

                  </div>
                </div>
                <div class="cat-box">
                  <div class="tag_sec_wrapper">

                    <div class="head_section">

                      <h4>Tags</h4>

                    </div>
            <?php
                                                    }
                                              if(isset($pro['tag']) && !empty($pro['tag'])){
                                                  
                                            $tags = $pro['tag'];
                                                        $x = (explode(",",$tags));
                                                  ?>
                    <div class="inner_sec">

                      <div class="tag_container">
                            <?php
                                                        foreach($x as $K => $v){?>
                                                        <div class="tags_in">

                          <i class="fa fa-check-square"></i>

                          <span><?=  $v;?></span>

                        </div>>
                                                    <?php
                                                        }
                                                    ?>


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
              <hr>
              <div class="share">
                <div class="report">
                  <a href="#"><i class="fa fa-flag"></i><span>Report</span></a>
                </div>
                <div class="share">
                  <a href="#"><i class="fab fa-facebook-f"></i></a>
                  <a href="#"><i class="fab fa-twitter"></i></a>
                  <a href="#"><i class="fab fa-instagram"></i></a>
                  <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-12 order-lg-2">
            <div class="seller-info-wrapper">
              <aside class="details-sidebar">
                <div class="widget" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="0">
                  <h4 class="widget-title">Ad Posted By</h4>
                  <?php
   echo $r = $this->load->view('user',array('pro'=>$pro),true);
    ?>
                  
                </div>
    
                <div class="widget" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
                  <h4 class="widget-title">Our Location</h4>
                  <div class="map-wrapper">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d387190.279909073!2d-74.25987368715491!3d40.69767006458873!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c24fa5d33f083b%3A0xc80b8f06e177fe62!2sNew%20York%2C%20NY%2C%20USA!5e0!3m2!1sen!2sbd!4v1608297882359!5m2!1sen!2sbd" width="100%" height="250" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                  </div>
                </div>
  
              </aside>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="orange_pathwrap" id="bpage_form" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
        <div class="iframe_box">
          <div class="getin_touch">
            <div class="row">
              <div class="col-md-12 col-lg-6 order-lg-2">
                <div class="map-side">
                  <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d124900.03392454954!2d92.90706196707936!3d11.965773023985834!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3088d3d85e0fe039%3A0x25c8aaaa513ef4bf!2sSwaraj%20Dweep!5e0!3m2!1sen!2sbd!4v1691688082664!5m2!1sen!2sbd"
                    width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
              </div>
              <div class="col-md-12 col-lg-6 order-lg-1">
                <div class="form-side">
                  <h3>Get In Touch</h3>
                  <form action="#" method="">
  
                    <input type="hidden" name="pid" id="pid1" value="1">
  
                    <div class="row">
  
                      <div class="col-sm-6 form_gapp">
                        <div class="form_box">
                          <div class="input-group mb-3">
                            <span class="input-group-text">
                              <i class="fa fa-user"></i>
                            </span>
                            <input type="text" class="form-control" id="input1" placeholder="First Name">
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-6 form_gapp">
                        <div class="form_box">
                          <div class="input-group mb-3">
                            <span class="input-group-text">
                              <i class="fa fa-user"></i>
                            </span>
                            <input type="text" class="form-control" id="input1" placeholder="Last Name">
                          </div>
                        </div>
                      </div>
  
                      <div class="col-sm-6 form_gapp">
                        <div class="form_box">
                          <div class="input-group mb-3">
                            <span class="input-group-text">
                              <i class="fa fa-envelope"></i>
                            </span>
                            <input type="email" class="form-control" id="input1" placeholder="Your email">
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-6 form_gapp">
                        <div class="form_box">
                          <div class="input-group mb-3">
                            <span class="input-group-text">
                              <i class="fa fa-phone"></i>
                            </span>
                            <input type="text" class="form-control" id="input1" placeholder="Phone">
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-12 form_gapp">
                        <div class="form_box">
                          <div class="input-group align-items-start mb-3">
                            <span class="input-group-text pt-3">
                              <i class="fa fa-message"></i>
                            </span>
                            <textarea class="form-control" placeholder="Leave a comment here"
                              style="height: 100px"></textarea>
                          </div>
                        </div>
                      </div>
  
                    </div>
  
                    <div class="row">
  
                      <div class="col-sm-12 form_gapp">
  
                        <div class="form_box form-btns">
  
                          <button class="form-btn" type="button" id="send">Send</button>
  
                          <a href="https://maps.google.com/?q=31.5203696,74.35874729999999" class="form-btn">
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
  
        </div>
  
      </div>
    </div>
  </main>

<?php
 include "footer_new.php";
?>
