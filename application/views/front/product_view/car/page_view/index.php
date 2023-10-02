<?php
$url = base_url('updated/');
$pro = array();
if(isset($product_data[0]))
{ 
    $pro = $product_data[0];

    
}

?>
<?php
    $additional_fields = json_decode($pro['additional_fields'], true);
    $vid = 0;
    $add_ar = $rr = json_decode($pro['added_by'],true);
    if($rr['type'] == 'vendor')
    {
      $vid = $rr['id'];
    }
    $vendor = $this->db->where('vendor_id',$vid)->get('vendor')->row();

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
              <?php
              include "slider.php";
              ?>
            </div>
          </div>
          <div class="col-lg-12 order-lg-3">
            
            <div class="ad-info-wrapper">
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
                <p><?= $pro['description']; ?></p>
                <?php
                }
                ?>

                <div class="specification">
                  <h3>Specification</h3>
                  <ul>
                    <div class="row">
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
                      <div class="col-lg-6 col-md-6">
                        <li>
                          <i class="fa fa-check-square"></i>
                          <div class="texts">
                            <p class="title"><?= $v;?></p>
                            <p class="value"><?= $val ?></p>
                          </div>
                        </li>
                      </div>
                      
                    <?php
                        }
                          }
                        }
                     ?>
                     </div>
                  </ul>
                  <h3>Seller Comment!</h3>
                  <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur Excepteur sint occaecat cupidatat non proident, sunt in culpa</p>
                </div>
                <?php
                                $chek = json_decode($pro['checkbox_xtra_fields']);
                                foreach($chek as $k=> $v)
                                {
                                    if(empty($v))
                                    {
                                        unset($chek[$k]);
                                    }
                                }
                                if($chek)
                                {
                                ?>
                <div class="specification features">
                  <h3><?= $pro['checkbox_h'];?></h3>
                  
                  <ul>
                    <div class="row">
                        <?php
                                                
                                                 $odd= array();
                                                $even= array();
                                                $i = 1;
                                                $lm = 40;
                                                if($chek)
                                                {
                                                foreach($chek as $k=> $v)
                                                {
                                                    $i++;
                                                    if($i%2 == 0)
                                                    {
                                                        $even[] = $v;
                                                    }
                                                    else
                                                    {
                                                        $odd[] = $v;
                                                    }
                                                }
                                                }
                                            
                                                foreach($chek as $k){
                                                    if(strlen($k) < $lm){
                                                ?>
                      <div class="col-lg-6 col-md-6">
                        <li>
                          <i class="fa fa-check-square"></i>
                          <div class="texts">
                            <p class="title"><?= $k;?></p>
                          </div>
                        </li>
                      </div>
                      <?php
                                                    }}
                      ?>
                    </div>
                  </ul>
                </div>
                <?php
                                }
                ?>
                <div class="extra-desc">
                  <div class="row">
                      <div class="col-12">
                          <?php
            if(isset($pro['discip_heading']) && $pro['discip_heading'])
            {
                ?>
                <h3><?= $pro['discip_heading']; ?></h3>
                <?php
            }
            ?>
                      </div>
                    <div class="col-lg-5 order-lg-2">
                        
                        <?php
                        
                        $cover = base_url().'template/front/images/volume.png';
                        if($pro['firstImg'])
                        {
                            $cover = $this->crud_model->size_img($pro['firstImg'],820,312);
                        }
                        ?>
                      <div class="mt-3">
                        <img src="<?= $cover; ?>" alt="" class="img-fluid">
                      </div>
                    </div>
                    <div class="col-lg-7 order-lg-1">
                            
            
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
                    // var_dump($features);
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
            <div class="ad-info-wrapper">
                
            <?php
                $acc = $this->db->where('pid',$pro['product_id'])->get('product_to_accordion')->result_array();
                if($acc)
                {
                    ?>
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
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accr-<?= $ii ?>" aria-expanded="false" aria-controls="flush-collapseOne">
                        <?= $k; ?>
                      </button>
                    </h2>
                    <div id="accr-<?= $ii ?>" class="accordion-collapse collapse" aria-labelledby="accr-<?= $ii ?>" data-bs-parent="#product-accr">
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
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-accr-<?= $ii ?>" aria-expanded="false" aria-controls="flush-collapseOne">
                        <?= $v['title']; ?>
                      </button>
                    </h2>
                    <div id="flush-accr-<?= $ii ?>" class="accordion-collapse collapse" aria-labelledby="accr-<?= $ii ?>" data-bs-parent="#product-accr">
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
                }
              ?>
              
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

                    <div class="inner_sec">

                      <div class="tag_container">


                        <div class="tags_in">

                          <i class="fa fa-check-square"></i>

                          <span>bpage am</span>

                        </div>


                        <div class="tags_in">

                          <i class="fa fa-check-square"></i>

                          <span>Leather seats</span>

                        </div>
                        <div class="tags_in">

                          <i class="fa fa-check-square"></i>

                          <span>bpage am</span>

                        </div>


                        <div class="tags_in">

                          <i class="fa fa-check-square"></i>

                          <span>Leather seats</span>

                        </div>
                        <div class="tags_in">

                          <i class="fa fa-check-square"></i>

                          <span>bpage am</span>

                        </div>


                        <div class="tags_in">

                          <i class="fa fa-check-square"></i>

                          <span>Leather seats</span>

                        </div>


                      </div>

                    </div>

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
                              <?php  

           $img='';
           $bpage = $this->db->where('product_id',$vendor->bpage)->get('product')->row();

           $social_image = array();
           if(isset($bpage->social_media) && $bpage->social_media)
           {
             $social_image = json_decode($bpage->social_media,true);
           }


                    // var_dump($k);

                    $all = $this->db->get('bpkg')->result_array();

                    foreach($all as $k=>$v){
                    

                                 

                                 if(isset($social_image[$v['id']])  && $social_image[$v['id']])

                                 {

                                  // $url = $social_image[$v['id']];
                                    

                ?>

                <a href="<?= $social_image[$v['id']] ?>"><i class="bi <?= $v['icon'] ?>"></i></a>

                <?php

                                 }


                             }

                ?>
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
                  $this->load->view('user',array('pro'=>$pro));
                  ?>
                </div>
    
                <div class="widget" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
                  <h4 class="widget-title">Our Location</h4>
                  <div class="map-wrapper">
                    <iframe src="https://www.google.com/maps/embed/v1/view?key=<?= $this->config->item('map_key'); ?>&center=<?= $pro['lat'] ?>,<?= $pro['lng'] ?>&zoom=12" width="100%" height="250" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                  </div>
                </div>
  
              </aside>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php
        include "form_and_map.php";
    ?>
  </main>