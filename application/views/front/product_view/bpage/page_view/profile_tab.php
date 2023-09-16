<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<?php
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
$imgs[] = $pimg;
$imgs[] = $pimg;
?>
<div class="tab-pane fade show active" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab"
            tabindex="0">
            <div id="tab_1" class="tab-content__box current">
              <div class="">

                <div class="clipart">

                </div>

                <div class="tab-content-inner">


                  <div class="row section_spacing_bottom" id="advertise_info">
                      <?php
                      $cls = 'col-md-12';
                      if($pimg)
                      {
                          $cls = 'col-md-8';
                          ?>

                    <div class="col-sm-4 business_graphic " id="business__graphic">



                      <img src="<?= $pimg ?>" alt="">

                    </div>
                    <?php
                      }
                      ?>

                    <div class="<?= $cls ?> communitybox">

                      <b><?= $pro['slogan'] ?></b>

                            <h3><?= $pro['main_heading'] ?></h3>

                      <div class="scroll" id="scrol_9sec">

                        <div class="desc">
                          <p ><?= nl2br($pro['description']) ?></p>
                        </div>

                        <ul class="listing_none">

                                    <?php

                                    $feature  = json_decode($pro['feature'],true);

                                    foreach ($feature as $key => $value) {

                                        if($value['fhead'])

                                        {

                                            ?>

                                            <li>

                                                <img src="<?= base_url(); ?>template/front/images/Tick-Square.png" alt="">

                                                <?= $value['fhead'] ?>

                                                <p>- <?= $value['fdet'] ?></p>

                                            </li>

                                            <?php

                                        }

                                    }

                                    ?>

                                </ul>

                      </div>

                      <div id="equal_btnw1">

                        <div class="learn_more_btn_bp" style="padding:0px;">

                                    <?php

                                    if(isset($pro['buttons']) && !empty($pro['buttons'])){

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

                                    }

                                    ?>

                                </div>

                      </div>



                    </div>

                  </div>

                  <div class="sec_div_wrap section_spacing_top section_spacing_bottom">

                <?php

                //extra_info



                if(true)

                {

                    $content = json_decode($pro['etra_content'],true);

                    $num = $pro['number_of_column'];

                    $class="12";

                    if($num == 1)

                    {

                        $class = 12;

                    }

                    else if($num == 2)

                    {

                        $class = 6;

                    }

                    else if($num == 3)

                    {

                        $class = 4;

                    }

                    ?>

                    <div class="pro_business" id="boxes___3">

                        <h3><?= $pro['extra_section_heading'] ?></h3>

                    </div>

                    <div class="row" id="left_gp">

                        <?php

                        for($i= 1; $i<=$num; $i++)
                        {
                            if(!$content[$k]['data']) {
                                unset($content[$k]);
                            }
                        }
                        for($i= 1; $i<=$num; $i++)

                        {
                            $k = $i -1;
                            
                            if($content[$k]['data']) {
                                ?>

                                <div class="col-sm-<?= $class ?> webdesign">

                                    <div class="inner_box_design height_auto scroll"
                                         style="overflow-y: scroll;height:324px;min-height: 324px;max-height: 324px;">

                                        <p class="box_with_img">
                                            <?php 
                                            if($content[$k]['type'] == 'img' && $content[$k]['data'])
                                            {
                                                ?>
                                                <img src="<?= base_url().$content[$k]['data'] ?>" class="extra_img" />
                                                <?php
                                            }
                                            else
                                            {
                                                echo $content[$k]['data'];
                                            }
                                            ?>
                                        </p>

                                    </div>

                                </div>

                                <?php


                            }
                        }

                        ?>

                    </div>

                    <?php

                }

                ?>
</div>


                  <div class="dec_div_wrap">
                    <div class="verify_head section_spacing_top" id="left_gp">

                      <h3>Ralph Lauren clothes</h3>

                      <p>Unfortunately, Ralph Lauren has long since outsourced its production. A large part of the polo
                        shirt</p>

                    </div>



                  </div>


                  <div class="slider_gallery__box">
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

                  <div class="third_sec_wrap section_spacing_top section_spacing_bottom">
                    <div class="verify_head">

                      <h3><?= $pro['gtitle'] ?></h3>

                    <p><?= $pro['gdesc'] ?></p>

                    </div>

                    <div class="inner_content_tabs">

                      <!--</select>-->

                      <ul class="nav nav-tabs" id="myTab2" role="tablist">
                          <?php

                            $vid = 0;

                            $added_by = json_decode($pro['added_by'], true);

                            if(isset($added_by['type']) && $added_by['type'] == 'vendor')
                            {

                                $vid = $added_by['id'];

                            }

                            $feature  = $this->db->where('vid',$vid)->get('textg')->result_array();
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
                            
                              <div class="col-sm-4 business_graphic" id="leftboxx">

                                <img src=" <?= base_url($path); ?>" alt="">

                              </div>

                              <div class="col-sm-8 communitybox no_box_bd inner_box_design" id="equal_btnw">

                                <h3> <?= $value['title'] ?></h3>

                                                <div class="desc">

                                                    <p> <?= $value['detail'] ?></p>

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

                                                    <p> <?= $value['detail'] ?></p>

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
                  <!--about-->


                  <div class="main_wrp section_spacing_bottom section_spacing_top">

                    <div class="verify_head ">

                      <h3><?= $pro['about_title']; ?></h3>
                      <p><?= $pro['about_desc']; ?></p>

                    </div>

                    <div class="row">
                      <div class="col-lg-8">

                        <?php
                                                $cat = explode(',',$pro['amenities']);
                                            if($cat){

                                                ?>
                        <div class="no_pdding" id="add_rigth">

                          <div class="tag_sec_wrapper">

                            <div class="head_section">

                              <h4>Amenities</h4>

                            </div>

                            <div class="inner_sec">

                              <div class="tag_container">
                                  <?php

                                                                

                                                                foreach($cat as $kk=>$k){

                                                                    ?>
                                                                    <div class="tags_in">

                                  <i class="fa fa-check-square"></i>

                                  <span><?= $k; ?></span>

                                </div>

                                                                    <?php

                                                                }

                                                                ?>


                                <div class="tags_in">

                                  <i class="fa fa-check-square"></i>

                                  <span>Leather seats</span>

                                </div>


                              </div>

                            </div>

                          </div>
                        </div>
                        <?php
                                            }
                        ?>

                        <?php

                                                            $cats = explode(',',$pro['cats']);

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



                        <?php if(isset($pro['about_address']) && !empty($pro['about_address'])){

                                            ?>

                                            <div class="margin-bottom"><i class="fa fa-map-marker"></i> <?= $pro['about_address'];?></div>

                                            <?php

                                        }if(isset($pro['bussniuss_phone']) && !empty($pro['bussniuss_phone'])){



                                            ?>

                                            <div class="margin-bottom"><i class="fa fa-phone"></i> <?= $pro['bussniuss_phone'];?></div>

                                            <?php

                                        }if(isset($pro['whatsapp_number']) && !empty($pro['whatsapp_number'])){



                                            ?>

                                            <div class="margin-bottom"><i class="fa fa-whatsapp"></i> <?= $pro['whatsapp_number'];?></div>

                                            <?php

                                        }if(isset($pro['bussniuss_email']) && !empty($pro['bussniuss_email'])){



                                            ?>

                                            <div class="margin-bottom"><i class="fa fa-envelope"></i> <?= $pro['bussniuss_email'];?></div>

                                            <?php

                                        }if(isset($pro['openig_time']) && !empty($pro['openig_time'])){



                                            ?>

                                            <div  class="margin-bottom"><i class="fa fa-clock"></i> <?= date("g:ia", strtotime( $pro['openig_time'])) .' - '.date("g:ia", strtotime( $pro['closing_time'])) ;?></div>

                                            <?php

                                        }

                                        ?>


                          <div class="social-icons">


                            <a href="facebook.html" target="_blank"><i class="fab fa-facebook-f"></i></a>


                            <a href="twitter.html" target="_blank"><i class="fab fa-twitter"></i></a>


                            <a href="instagram.html" target="_blank"><i class="fab fa-instagram"></i></a>

                            <a href="instagram.html" target="_blank"><i class="fab fa-dribbble"></i></a>
                            <a href="instagram.html" target="_blank"><i class="fab fa-youtube"></i></a>
                            <a href="instagram.html" target="_blank"><i class="fab fa-google"></i></a>

                          </div>
                        </div>

                      </div>
                    </div>
                  </div>
                  <div class="mixcher_orange" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="0">

                    <div class="shape_doted_mix">

                      <img src="assets/images/mixcher-orange.png" alt="">

                    </div>
                    <h4><?= $pro['info_head']; ?></h4>

                    <p><?= $pro['info_desc']; ?></p>

                    <?php

                    if(isset($pro['info_button']) && !empty($pro['info_button']) && isset($pro['button_url']) &&!empty($pro['button_url'])){

                        ?><a href="<?= $pro['button_url']; ?>"><?= $pro['info_button']; ?></a>

                        <?php

                    }

                    ?>
                  </div>

                </div>
                <div class="orange_pathwrap" id="bpage_form">
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
                <div class="tags-wrap">
                  <div class="tag_sec_wrapper" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">

                    <div class="head_section">

                      <h4>Tags</h4>

                    </div>

                    <div class="inner_sec">

                      <div class="tag_container">


                        <div class="tags_in">

                          <i class="fa fa-check-square"></i>

                          <span>clothes</span>

                        </div>
                        <div class="tags_in">

                          <i class="fa fa-check-square"></i>

                          <span>pants</span>

                        </div>
                        <div class="tags_in">

                          <i class="fa fa-check-square"></i>

                          <span>belt</span>

                        </div>
                        <div class="tags_in">

                          <i class="fa fa-check-square"></i>

                          <span>brand</span>

                        </div>
                        <div class="tags_in">

                          <i class="fa fa-check-square"></i>

                          <span>guccie</span>

                        </div>

                        <div class="tags_in">

                          <i class="fa fa-check-square"></i>

                          <span>versacce</span>

                        </div>
                      </div>

                    </div>

                  </div>
                </div>
                <div class="verify_head section_spacing_top" data-aos="fade-up" data-aos-duration="1000"
                  data-aos-delay="200">

                  <h3>You May Also be Interested In</h3>

                  <p>You can now list your business in less than 5 minutes</p>

                </div>
              </div>
              <div class="report">
                <a href="#"><i class="fa fa-flag"></i><span>Report</span></a>
              </div>
            </div>
          </div>
          <script>

    $('#send').on('click' , function(e){

        e.preventDefault();



        var url = '<?php echo base_url('home/contact_us')?>';

        var fname = $('#fname__').val();

        var lname = $('#lname').val();

        var email = $('#email__').val();

        var msg = $('#message__').val();

        var phone = $('#phone').val();

        var pid = $('#pid1').val();

        $.ajax({

            url: url,

            type: "get",

            async: true,



            data: {  fname:fname, email:email, message:msg,phone:phone,lname:lname,pid:pid },

            success: function (data) {

                // const myArr = JSON.parse(JSON.stringify(data));

                if(data == 1){

                    $("#success").attr("class", "alert alert-success d-block");

                }else{

                    $("#danger").attr("class", "alert alert-danger d-block");

                }

            },

            error: function (xhr, exception) {

                var msg = "";

                if (xhr.status === 0) {

                    msg = "Not connect.\n Verify Network." + xhr.responseText;

                } else if (xhr.status == 404) {

                    msg = "Requested page not found. [404]" + xhr.responseText;

                } else if (xhr.status == 500) {

                    msg = "Internal Server Error [500]." +  xhr.responseText;

                } else if (exception === "parsererror") {

                    msg = "Requested JSON parse failed.";

                } else if (exception === "timeout") {

                    msg = "Time out error." + xhr.responseText;

                } else if (exception === "abort") {

                    msg = "Ajax request aborted.";

                } else {

                    msg = "Error:" + xhr.status + " " + xhr.responseText;

                }



            }

        });





    });

</script>