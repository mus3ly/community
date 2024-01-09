
<?php
$checks = array();
if($pro['enable_checks'])
{
$checks = json_decode($pro['enable_checks']);
}
$pimg = '';
if($pro['firstImg']) {

                    $pimg = $this->crud_model->size_img($pro['firstImg'],820,312);

                }
                
                
                
$imgs = $this->db->where('pid',$pro['product_id'])->get('product_to_images')->result_array();
$nimgs = array();
foreach($imgs as $k=> $v)
{
    $nimgs[]  = $this->crud_model->size_img($v['img'],500,500);
}
$imgs = $nimgs;
?>
<div class="tab-pane fade show active" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab"
            tabindex="0">
            <div id="tab_1" class="tab-content__box current">
              <div class="">

                <div class="clipart">

                </div>

                <div class="tab-content-inner">
                              <?php
          $checks = array();
if($pro['enable_checks'])
{
$checks = json_decode($pro['enable_checks']);
}
          ?>


                  <div class="row section_spacing_bottom pb-25" id="advertise_info" style="display:<?= (in_array('section2',$checks))?"none":"flex"; ?>">
                      <?php
                      $cls = 'col-md-12';
                      if($pimg)
                      {
                          $cls = 'col-md-7';
                          ?>
          
                    <div class="col-sm-5 business_graphic " id="business__graphic" >



                      <img class="half_img" style="width:100%; object-fit:cover;" src="<?= $pimg ?>" alt="">

                    </div>
                    <?php
                      }
                      ?>

                    <div class="<?= $cls ?> communitybox">

                      <b><?= $pro['disc_slogan']; ?></b>
                            <?php
                            if(trim(strip_tags($pro['main_heading'])))
                            {
                                ?>
                                
                            <h3><?= $pro['main_heading'] ?></h3>
                            <?php
                            }
                            ?>
                        <?php
                        if(trim($pro['description']))
                        {
                        ?>
                      <div class="scroll" id="scrol_9sec">

                        <div class="desc">
                          <p ><?= trim($pro['description']) ?></p>
                        </div>

                        <ul class="listing_none">

                                    <?php

                                    $feature  = json_decode($pro['feature'],true);

                                    foreach ($feature as $key => $value) {

                                        if($value)

                                        {

                                            ?>
                                            <li>

   <img src="<?= base_url(); ?>template/front/images/Tick-Square.png" alt="">


                            <p><strong><?= $value['fhead'];?></strong> <br>
                              - <?= $value['fdet'] ?></p>

                          </li>

                                            <?php

                                        }

                                    }

                                    ?>

                                </ul>

                      </div>
                      <?php
                        }
                      ?>

                      <div id="equal_btnw1">

                        <div class="learn_more_btn_bp" style="padding:0px;">

                                    <?php

                                    if(isset($pro['buttons']) && !empty($pro['buttons'])){

                                        $btns  = json_decode($pro['buttons'],true);
                                        foreach ($btns as $key => $value) {
                                            if(!$value['txt'])
                                            {
                                                unset($btns[$key]);
                                            }
                                        }
                                        

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

                                                <a href="<?= $value['url'] ?>" class="our_projects1"><?= $value['txt'] ?></a>

                                                <?php

                                            }

                                        }

                                    }

                                    ?>

                                </div>

                      </div>



                    </div>

                  </div>
                  <?php
                  $content = json_decode($pro['etra_content'],true);
                  $num = 0;
                  foreach($content as $k=> $v)
                  {
                      if(($v['type'] == 'img') && !empty($v['img']) || ($v['type'] == 'text') && !empty($v['txt']))
                      {
                          $num++;
                      }
                      else
                      {
                          unset($content[$k]);
                      }
                  }
                if($content)
                {
                  ?>

                  <div class="sec_div_wrap section_spacing_top section_spacing_bottom" style="display:<?= (in_array('section3',$checks))?"none":"block"; ?>">
                      

                <?php

                if($content)
                {
                    // var_dump($pro['etra_content']);


                    

                    $class="12";

                    if($num == 1)

                    {

                        $class = 12;

                    }

                    elseif($num == 2)

                    {

                        $class = 6;

                    }
                    else
                    {
                        $class = 4;
                    }

                    ?>

                    <div class="pro_business" id="boxes___3">

                        <h3><?= $pro['extra_section_heading'] ?></h3>
                        <p><?= $pro['col3desc'] ?></p>

                    </div>

                    <div class="row" id="left_gp">

                        <?php
                        

                        if($content)
                        {
                            
                        foreach($content as $k=> $v)

                        {
                            if($k <= 3)
                            {
                            $k = $i -1;
                            
                                ?>

                                <div class="col-sm-<?= $class ?> webdesign">
                                    <?php
                                    if($v['title'])
                                                {
                                                    ?>
                                                    <h3><?= $v['title'] ?></h3>
                                                    <?php
                                                }
                                    ?>

                                    <div class="inner_box_design height_auto scroll"
                                         >

                                        <<?= ($v['type'] == 'img')?'div':'p' ?> class="box_with_img">
                                            <?php 
                                                
                                            if($v['type'] == 'img' && $v['img'])
                                            {
                                                $img = $this->crud_model->size_img($v['img'],100,100);
                                                if($v['title'])
                                                {
                                                    ?>
                                                    
                                                    <?php
                                                }
                                                ?>
                                                <img style="object-fit:cover;" src="<?= $img ?>" class="extra_img" />
                                                <?php
                                            }
                                            else
                                            {
                                                
                                                echo $v['txt'];
                                                ?>
                                                <ul class="listing_none">

                                    <?php

                                    $feature  = $v['feature'];
                                    // var_dump($v);

                                    foreach ($feature as $key => $value) {

                                        if($value)

                                        {

                                            ?>
                                            <li>

   <img src="<?= base_url(); ?>template/front/images/Tick-Square.png" alt="">


                            <p><strong><?= $value['fhead'];?></strong> <br>
                              - <?= $value['fdet'] ?></p>

                          </li>

                                            <?php

                                        }

                                    }

                                    ?>

                                </ul>
                                                <?php
                                            }
                                            ?>
                                        </<?= ($v['type'] == 'img')?'div':'p' ?>>

                                    </div>

                                </div>

                                <?php


                            }//if less then equal to 3
                        }//foreach
                        }
                        }

                        ?>

                    </div>

                    <?php

                }

                ?>
</div>

                    <?php
                    $imgs = array_filter($imgs, 'strlen');
                    if($imgs)
                    {
                        ?>
                  <div class="slider_gallery__box" style="display:<?= (in_array('section4',$checks))?"none":"block"; ?>">
                      <?php
                        if($pro['gtitle'])
                        {
                            ?>
                      <h3><?= $pro['gtitle'] ?></h3>
                      <?php
                        }
                        ?>
                    <?php
                        if(strip_tags($pro['gtitle']))
                        {
                            ?>
                    <p><?= $pro['gdesc'] ?></p>
                    <?php
                        }
                        ?>
                      <div class="verify_head section_spacing_top" id="left_gp">

                      <h3><?= $pro['gal_h'] ?></h3>

                      <p><?= $pro['gal_d'] ?></p>

                    </div>
                    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                      <div class="carousel-inner">
                          <?php
                          
                          foreach($imgs as $k=>$v)
                         {
                             ?>
                        <div class="carousel-item <?= (!$k)?"active":"" ?>">
                          <img src="<?= $v ?>" class="d-block w-100" alt="...">
                        </div>
                        <?php
                         }
                         
                          ?>
                      </div>
                      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true">
                          <i class="fa-solid fa-angle-left"></i>
                        </span>
                        <span class="visually-hidden">Previous</span>
                      </button>
                      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true">
                          <i class="fa-solid fa-angle-right"></i>
                        </span>
                        <span class="visually-hidden">Next</span>
                      </button>
                    </div>
                  </div>
                  <?php
                    }
                    $vid = 0;

                            $added_by = json_decode($pro['added_by'], true);

                            if(isset($added_by['type']) && $added_by['type'] == 'vendor')
                            {

                                $vid = $added_by['id'];

                            }

                            $feature  = json_decode($pro['txt_gal'],true);
                            if($feature)
                            {
                    ?>

                  <div class="third_sec_wrap section_spacing_top section_spacing_bottom" style="display:<?= (in_array('section5',$checks))?"none":"block"; ?>">
                    <div class="verify_head">
                        
                        
                        <?php
                        if($pro['ttitle'])
                        {
                            ?>
                      <h3><?= $pro['ttitle'] ?></h3>
                      <?php
                        }
                        ?>
                    <?php
                        if(strip_tags($pro['tdesc']))
                        {
                            ?>
                    <p><?= $pro['tdesc'] ?></p>
                    
                    <?php
                        }
                        ?>
                    </div>

                    <div class="inner_content_tabs">

                      <!--</select>-->

                      <ul class="nav nav-tabs" id="myTab2" role="tablist">
                          <?php

                            
                            $i = 0;
                            foreach($feature as $k=> $value)
                                {

                                    $value['ficon'] = $value['icon'];

                                    // var_dump($value);

                                    $i++;

                                    $tab = 'tab-'.$i;
                                    if($i <= 4)
                                {

                                    ?>

                                    <li class="nav-item" role="presentation">
                          <button class="nav-link <?= ($i == 1)?"active":""; ?>" id="<?=$tab ?>" data-bs-toggle="tab"
                            data-bs-target="#<?=$tab ?>-pane" type="button" role="tab" aria-controls="<?=$tab ?>-pane"
                            aria-selected="true"><?=$value['title'] ?></button>
                        </li>

                                    <?php
                                    
                                }//4 limit

                                }
                            ?>
                      </ul>
                      <div class="tab-content" id="myTab2Content">
                          <?php
                          $i = 0;
                            foreach($feature as $k=> $value)
                                {

                                    $value['ficon'] = $value['icon'];

                                    // var_dump($value);

                                    $i++;

                                    $tab = 'tab-'.$i;
                                    if($i <= 4)
                                {
                                    $media = $value['img'];

                                $value['img'] = $this->crud_model->get_img($value['img'])->secure_url;
                                $path = $this->crud_model->get_img($media)->path;

                                    ?>

                             <div class="tab-pane fade show <?= ($i == 1)?"active":"" ?>" id="<?= $tab ?>-pane" role="tabpanel"
                          aria-labelledby="<?= $tab ?>" tabindex="<?= $i ?>">
                          <div id="tab-1__" class="tab-content__ ">

                            <?php
                            if($media)
                                {
                                    ?>
                            <div class="row fix_height" id="advertise_info">
                            
                              <div class="col-sm-5 business_graphic" id="leftboxx">

                                <img src=" <?= base_url($path); ?>" alt="">

                              </div>

                              <div class="col-sm-7 communitybox no_box_bd inner_box_design" id="equal_btnw">

                                <h3> <?= $value['title'] ?></h3>

                                                <div class="desc">

                                                    <p> <?= $value['txt'] ?></p>
                                                    <?php
                                                    // var_dump($value);

                                    $feature  = $value['feature'];
                                    if($feature)
                                    {
                                        ?>
                                        <ul class="listing_none">
                                        <?php
                                    }

                                    foreach ($feature as $key => $value1) {

                                        if($value)

                                        {

                                            ?>
                                            <li>

   <img src="<?= base_url(); ?>template/front/images/Tick-Square.png" alt="">


                            <p><strong><?= $value1['fhead'];?></strong> <br>
                              - <?= $value1['fdet'] ?></p>

                          </li>

                                            <?php

                                        }

                                    }
                                    if($feature)
                                    {
                                        ?>
                                        </ul>
                                        <?php
                                    }

                                    ?>

                                                </div>

                              </div>

                            </div>
                            <?php
                                }
                                else
                                {
                                    ?>
                                    <div class="row fix_height" id="advertise_info">
                              <div class="col-sm-12 communitybox no_box_bd inner_box_design" id="equal_btnw">

                                <h3> <?= $value['title'] ?></h3>

                                                <div class="desc">

                                                    <p> <?= $value['txt'] ?></p>

                                                </div>

                              </div>

                            </div>
                                    <?php
                                }
                            ?>




                          </div>
                        </div>

                                    <?php
                                    
                                }//4 limit

                                }
                          ?>
                      </div>

                    </div>
                  </div>
                  <?php
                            }
                  ?>
                  <!--about-->

                <?php
                if(!in_array('section6',$checks) && $pro['about_title'] && $pro['about_desc'] && $pro['cats'])
                {
                ?>
                  <div class="main_wrp section_spacing_bottom section_spacing_top sec_div_wrap">

                    <div class="verify_head ">

                      <h3><?= $pro['about_title']; ?></h3>
                      <p><?= $pro['about_desc']; ?></p>

                    </div>

                    <div class="row">
                      <div class="col-lg-8">

                        <?php
                                                $cats = explode(',',$pro['amenities']);
                                                $cats = array_filter($cats, 'strlen');
                                                
                                               
                                            if($cats  && !in_array('section7',$checks)){

                                                ?>
                        <div class="no_pdding" id="add_rigth">

                          <div class="tag_sec_wrapper">

                            <div class="head_section">

                              <h4>Amenities</h4>

                            </div>

                            <div class="inner_sec">

                              <div class="tag_container">
                                  <?php

                                                                

                                                                foreach($cats as $kk=>$k){

                                                                    ?>
                                                                    <div class="tags_in">

                                  <i class="fa fa-check-square"></i>

                                  <span><?= $k; ?></span>

                                </div>

                                                                    <?php

                                                                }

                                                                ?>


                              </div>

                            </div>

                          </div>
                        </div>
                        <?php
                                            }
                        ?>

                        <?php

                                                            $cats = explode(',',$pro['cats']);
                                                            $cats = array_filter($cats, 'strlen');

                                                            if($cats)
                                                            {
                                                               ?>
                        <div class="no_pdding">

                          <div class="tag_sec_wrapper">

                            <div class="head_section">

                              <h4>CATEGORIES</h4>

                            </div>

                            <div class="inner_sec">

                              <div class="tag_container">
                                  
                                  <?php
                                  foreach($cats as $k){

                                                                ?>
                                                                <div class="tags_in">

                                  <i class="fa fa-check-square"></i>

                                  <span><?= $k; ?></span>

                                </div>

                                                                <?php

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

                      <div class="col-lg-4 left_9bx" id="right___gap" style="overflow-x: hidden;">

                        <div class="shadow_9 icons_links" id="bg__social">



                        <p><?php if(isset($pro['about_address']) && !empty($pro['about_address'])){

                                            ?>

                                            <div class="margin-bottom"><i class="fa fa-map-marker"></i><?= strip_tags($pro['about_address']);?></div>

                                            <?php

                                        }if(isset($pro['ephonen']) && !empty($pro['ephonen'])){



                                            ?>

                                            <div class="margin-bottom"><i class="fa fa-phone"></i> <?= $pro['ephonen'];?></div>

                                            <?php

                                        }if(isset($pro['whatsapp_number']) && !empty($pro['whatsapp_number'])){



                                            ?>

                                            <div class="margin-bottom"><i class="fab fa-whatsapp"></i> <?= $pro['whatsapp_number'];?></div>

                                            <?php

                                        }if(isset($pro['pemail']) && !empty($pro['pemail'])){



                                            ?>

                                            <div class="margin-bottom"><i class="fa fa-envelope"></i> <?= $pro['pemail'];?></div>

                                            <?php

                                        }if(isset($pro['openig_time']) && !empty($pro['openig_time'])){



                                            ?>

                                            <div  class="margin-bottom"><i class="fa fa-clock"></i> <?= date("g:ia", strtotime( $pro['openig_time'])) .' - '.date("g:ia", strtotime( $pro['closing_time'])) ;?></div>

                                            <?php

                                        }

                                        ?>


                          <div class="social-icons">
                            <?php  

           $img='';

           $social_image = json_decode($pro['social_media'],true);


                    // var_dump($k);

                    $all = $this->db->get('bpkg')->result_array();

                    foreach($all as $k=>$v){

                                 

                                 if(isset($social_image[$v['id']])  && $social_image[$v['id']])

                                 {
                                    $url = $social_image[$v['id']];
                                    if  ( $ret = parse_url($url) ) {

                                          if ( !isset($ret["scheme"]) )
                                           {
                                           $url = "http://{$url}";
                                           }
                                    }

                ?>

                <a href="<?= $url ?>"><i class="bi <?= $v['icon'] ?>"></i></a>

                <?php

                                 }


                             }

                ?>

                <?php ?>

                          </div>
                        </div>

                      </div>
                    </div>
                  </div>
                  <?php
                }
                  ?>
                  <?php
                  if($pro['info_head'] && $pro['info_desc'] && !in_array('info_section',$checks))
                  {
                      ?>
                  <div class="mixcher_orange" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="0">

                    <div class="shape_doted_mix">

                      <img src="assets/images/mixcher-orange.png" alt="">

                    </div>
                    <h4><?= $pro['info_head']; ?></h4>

                    <p><?= $pro['info_desc']; ?></p>
                    <?php

                                    $feature  = json_decode($pro['about_feature'],true);
                                    if($feature)
                                    {
                                        ?>
                                        <ul class="listing_none">
                                        <?php
                                    }

                                    foreach ($feature as $key => $value) {

                                        if($value)

                                        {

                                            ?>
                                            <li class="list-with-img">

   <img src="<?= base_url(); ?>updated/assets/images/Tick-Square.png" style="width: 20px;
    background: white;
    border-radius: 4px; vertical-align: top;" alt="">


                            <p><strong><?= $value['fhead'];?></strong> <br>
                              - <?= $value['fdet'] ?></p>

                          </li>

                                            <?php

                                        }

                                    }
                                    if($feature)
                                    {
                                        ?>
                                        </ul>
                                        <?php
                                    }

                                    ?>
                                    <div id="equal_btnw1">

                        <div class="learn_more_btn_bp" style="padding:0px;">

                                    <?php

                                    if(isset($pro['about_buttons']) && !empty($pro['about_buttons'])){

                                        $btns  = json_decode($pro['about_buttons'],true);
                                        foreach ($btns as $key => $value) {
                                            if(!$value['txt'])
                                            {
                                                unset($btns[$key]);
                                            }
                                        }
                                        

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

                                                <a href="<?= $value['url'] ?>" class="our_projects1"><?= $value['txt'] ?></a>

                                                <?php

                                            }

                                        }

                                    }

                                    ?>

                                </div>

                      </div>

                    <?php

                    /*if(isset($pro['info_button']) && !empty($pro['info_button']) && isset($pro['button_url']) &&!empty($pro['button_url'])){

                        ?><a href="<?= $pro['button_url']; ?>"><?= $pro['info_button']; ?></a>

                        <?php

                    }*/

                    ?>
                  </div>
                  <?php
                  }
                  ?>

                </div>
                <div class="orange_pathwrap" id="bpage_form" style="display:<?= !in_array('location',$checks)?'block':'none'; ?>">
                  <div class="iframe_box">
                    <div class="getin_touch">
                      <div class="row">
                        <div class="col-md-12 col-lg-6 order-lg-2">
                          <div class="map-side">
                            <iframe
                              src="https://www.google.com/maps/embed/v1/view?key=AIzaSyB6qgjUyMSzlu08MSAITqcc26OympU03vQ&center=<?= $pro['lat'];?>,<?= $pro['lng'];?>&zoom=12"
                              width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                              referrerpolicy="no-referrer-when-downgrade"></iframe>
                              
                          </div>
                        </div>
                        <div class="col-md-12 col-lg-6 order-lg-1">
                          <div class="form-side">
                            <h3>Get In Touch</h3>
                            <form action="" method="">

                                <input type="hidden" name="pid" id="pid1" value="<?= $pro['product_id']?>">
                              <div class="row">

                                <div class="col-sm-6 form_gapp">
                                  <div class="form_box">
                                    <div class="input-group mb-3">
                                      <span class="input-group-text">
                                        <i class="fa fa-user"></i>
                                      </span>
                                      <input type="text" class="form-control" id="fname__" placeholder="First ">
                                    </div>
                                  </div>
                                </div>
                                <div class="col-sm-6 form_gapp">
                                  <div class="form_box">
                                    <div class="input-group mb-3">
                                      <span class="input-group-text">
                                        <i class="fa fa-user"></i>
                                      </span>
                                      <input type="text" class="form-control" id="lname" placeholder="Last Name">
                                    </div>
                                  </div>
                                </div>

                                <div class="col-sm-6 form_gapp">
                                  <div class="form_box">
                                    <div class="input-group mb-3">
                                      <span class="input-group-text">
                                        <i class="fa fa-envelope"></i>
                                      </span>
                                      <input type="email" class="form-control" id="email__" placeholder="Your email">
                                    </div>
                                  </div>
                                </div>
                                <div class="col-sm-6 form_gapp">
                                  <div class="form_box">
                                    <div class="input-group mb-3">
                                      <span class="input-group-text">
                                        <i class="fa fa-phone"></i>
                                      </span>
                                      <input type="text" class="form-control" id="phone" placeholder="Phone">
                                    </div>
                                  </div>
                                </div>
                                <div class="col-sm-12 form_gapp">
                                  <div class="form_box">
                                    <div class="input-group align-items-start mb-3">
                                      <span class="input-group-text pt-3">
                                        <i class="fa fa-message"></i>
                                      </span>
                                      <textarea class="form-control" id="message__" placeholder="Leave a comment here"
                                        style="height: 100px"></textarea>
                                    </div>
                                  </div>
                                </div>

                              </div>

                              <div class="row">

                                <div class="col-sm-12 form_gapp">

                                  <div class="form_box form-btns">

                                    <button class="form-btn" type="button" onclick="SEND_CONTACT('<?= $pro['product_id'] ?>')">Send</button>

                                    <a href="https://maps.google.com/?q=<?=$pro['lat'] ?>,<?=$pro['lng'] ?>" class="form-btn">
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
                $tag = $chek;
                ?>
                <div class="tags-wrap">
                  <div class="tag_sec_wrapper" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">

                    <div class="head_section">

                      <h4>Tags</h4>

                    </div>

                    <div class="inner_sec">

                      <div class="tag_container">
                          <?php
                          foreach($tag as $k=> $v)
                          {
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
                }
                $list = $this->db->where('featured','ok')->get('product')->result_array();
                if($list)
                {
                ?>
                <div class="verify_head section_spacing_top" data-aos="fade-up" data-aos-duration="1000"
                  data-aos-delay="200">

                  <h3>You May Also be Interested In</h3>

                  <p>You can now list your business in less than 5 minutes</p>
                  <div class="row" id="home_p">

          <?php
          
          foreach ($list as $key => $row) {
                                if($key < 3)

                                $this->load->view('grid_box',$row);
          }

          ?>

        </div>

                </div>
                <?php
                }
                ?>
              </div>
              <div class="report">
                <a href="#"><i class="fa fa-flag"></i><span>Report</span></a>
              </div>
            </div>
          </div>