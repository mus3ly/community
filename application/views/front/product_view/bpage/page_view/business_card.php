<?php

if($pro['comp_logo'])

{

    $logo = $this->crud_model->get_img($pro['comp_logo']);

    if(isset($logo->path))

    {

        $logo = base_url().$logo->path;

    }

}

$cover = '';

if(true)

{

    $cover = $this->crud_model->size_img($pro['comp_cover'],820,312);

}
?>
<div class="business_card">
      <div class="container  ">
        <div class="business_banner"
          style="background: url('<?= $cover ?>');background-position:center;background-size:cover;">

          <div class="overlay_banner__box"></div>

          <div class="whatsapp_new">

            <a target = "_blank" href="mailto:<?= $pro['bussniuss_email'];?> "><i class="fa fa-envelope"></i></a>

            <a href="https://api.whatsapp.com/send?phone=<?= $pro['whatsapp_number']; ?>&text=Hello this is the starting message"  target = "_blank"><i class="fab fa-whatsapp"></i></a>

            <a  target = "_blank" href="tel:<?= $pro['bussniuss_phone'];?>"><i class="fa fa-phone"></i></a>

          </div>

          <div class="share_icon share_icon_right">

            <ul> 

              <li><a href="#" id="shareit">
                  <i class="bi bi-share"></i>
                </a>

                <div class="social_mediabox">

                  <ul>
                    <?php   ?>

                    <?php

           $img='';

                    $all = $this->db->get('bpkg')->result_array();
                    foreach ($all as $k=> $v) {

                                 if($v['share_link'])
                                 {
                                  $url = base_url($pro['slug']);
                                  $link = str_replace('link',$url, $v['share_link']);


                ?>

                <li><a href="<?= $link ?>"><i class="bi <?= $v['icon'] ?>"></i></a></li>

                <?php

                                 }

               }

                ?>

                <?php ?>

                  </ul>

                </div>

              </li>

              <li><a href="#"><i class="bi bi-heart"></i></a></li>

              <!--<div class="sharethis-inline-share-buttons" style="display:none;"></div>-->

            </ul>

          </div>

          <div class="row profile_box">

            <div class="col-lg-1 col-sm-2 profile_box_img">

              <a href="#"><img src="<?= $logo; ?>" alt=""></a>

            </div>

            <div class="col-lg-11 col-sm-10 right_profilebox">

              <h3><?= $pro['title'] ?> <a href="#"><img src="<?= $url; ?>assets/images/Combined-Shape.png" alt=""></a></h3>

              <p><?= $pro['slog'] ;?></p>

              <?php

                        echo $this->crud_model->rate_html($pro['rating_num']);

                        ?>
            </div>
          </div>
        </div>
      </div>
    </div>