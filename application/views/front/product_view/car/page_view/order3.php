<div class="col-lg-12 order-lg-3">
            
            <div class="ad-info-wrapper" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
              
                  
                <?php
                if(isset($pro['title']) && $pro['title'])
                {f
                    ?>
                <div class="info-header">
                <h2><?= $pro['title'];?></h2>
                </div>
                <?php
                }
                ?>
              
              <hr>
              <div class="product-details">
              <?php
                if(isset($pro['description']) && $pro['description'])
                {
                    ?>
              
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
                        $lim = 30;
                        if($val && strlen($val) < $lim)
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
                </div>
                <?php
                if($pro['cust_comhead'])
                {
                ?>
                <h3><?= $pro['cust_comhead']; ?></h3>
                <?= $pro['customer_comment']; ?>
                <?php
                }
                ?>
                <?php
                //checkbox_h
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
                        
                        ?>
                      <div class="mt-3">
                         
                        <img src="<?= $cover; ?>" alt="" class="img-fluid">
                      </div>
                      <?php
                        }
                      ?>
                    </div>
                    <div class="col-lg-7 order-lg-1">
                            
            
                      <?php
            if(isset($pro['main_heading']) && $pro['main_heading'])
            {
                ?>
                <h3><?= $pro['main_heading']; ?></h3>
                <?php
            }
            ?>
                       <ul>
                    <?php
                    $features = json_decode($pro['feature'], true);
                    foreach($features as $k => $v){
                        if(!empty($v))
                        {
                    ?>
                        <li><?= $v;?></li>
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
                foreach($accor as $k=> $v)
                {
                    $acc[] = array('title'=> $k,'detail'=> $v);
                }
                $acc= array_reverse($acc);
                $accor = array();
                if($acc)
                {
                    ?>
              <h2 class="mb-3"><?= $pro['accor_h']; ?></h2>
              <p><?= $pro['accor_p']; ?></p>
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
                        <p><?php $v; ?></p>
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
                    <h2 class="accordion-header" id="accr-<?= $ii ?>2">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-accr-<?= $ii ?>2" aria-expanded="false" aria-controls="flush-collapseOne">
                        <?= $v['title']; ?>
                      </button>
                    </h2>
                    <div id="flush-accr-<?= $ii ?>2" class="accordion-collapse collapse" aria-labelledby="accr-<?= $ii ?>2" data-bs-parent="#product-accr">
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
                <?php
                $chek = array();
                if($pro['tag'])
                $chek = array_filter(explode(',',$pro['tag']));
                foreach($chek as $k=> $v)
                {
                    if(!trim($v))
                    {
                        unset($chek[$k]);
                    }
                }
                if($chek)
                {
                ?>
                <div class="cat-box">
                  <div class="tag_sec_wrapper">

                    <div class="head_section">

                      <h4>Tags</h4>

                    </div>

                    <div class="inner_sec">

                      <div class="tag_container">
                          <?php
                          foreach($chek as $k=> $v)
                          {
                              if($v)
                              {
                              ?>
                              <div class="tags_in">

                          <i class="fa fa-check-square"></i>

                          <span><?= $v; ?></span>

                        </div>
                              
                              <?php
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