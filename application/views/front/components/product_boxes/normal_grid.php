<style>
    .widget-search input{
        border:none !important;
    }
    #result .pagination  li {
    padding: 0;
    border-bottom: none;
    font-size: 13px;
    cursor: pointer;
}
   #result .pagination  {
    background: #fff;
    width: 100%;
    right: 0;
    border: none;
    padding: 0;
    box-shadow: none;
}
#result ul li:hover {
    background: none;
    color: #fff;
}
</style>

<?php
$cat = $this->db->where('category_id',$category)->get('category')->row();
// openig_time closing_time 
$time1 = $create_at;
$time1 = date("H:i:s",strtotime($time1));
$date = date('Y-m-d',strtotime($time1));
 $time = time();
 if($time >=$openig_time && $time <=$closing_time){
  $x = 'Opened';  
}
else{
      $x = 'Closed';  
}
$img = '';
                        if($comp_cover)
                        {
                            $img = $this->crud_model->get_img($comp_cover);
                            if(isset($img->secure_url))
                            {
                                $img = $img->secure_url;
                            }

                        }
                        else
                        {
                            $img = $this->crud_model->file_view('product',$product_id,'','','thumb','src','multi','one');

                        }
$logo='';
                            if($comp_logo)
                        {
                            $logo = $this->crud_model->get_img($comp_logo);
                            if(isset($logo->secure_url) && !empty($logo->secure_url))
                            {
                                $logo = base_url('/').$logo->path;
                            }

                        }
                        else
                        {
                            $logo = $this->crud_model->file_view('product',$product_id,'','','thumb','src','multi','one');

                        }
                        ?>
                            
                            
            <div class="sidegap_product item" onmouseover="open_marker(<?= $lat?>, <?=$lng ?>)" data-lat="<?= $lat; ?>" data-lng="<?= $lng; ?>" rate="<?= ($rating_num)?$rating_num:0; ?>">
                <div class="img_hover_icons">
                    <!--<a href="#"><i class="fa fa-star"></i></a>-->
                    <!--<a href="#"><span class="online_box"></span></a>-->
                    <!--<a href="#"><i class="fa fa-share"></i></a>-->
                    <!--<a href="#"><i class="fa fa-heart"></i></a>-->
                </div>
                <div class="imgbox_opacity">
                    <img src="<?= $img ?>" alt="">
                    <div class="logo_withname">
                        <img src="<?= $logo; ?>" alt="">
                        <h4><?= $title ?></h4>
                         <?=
                         $featured=$this->crud_model->rate_html($rating_num);
                         ?>
                    </div>
                      <a href="<?= base_url('home/product_view/').$product_id; ?>" target="_blank"> <div class="overlay_img"></div></a>
                </div>
                <div class="white_shadow__box">
                    <p><?= $slogan; ?>  </p>
                    <?php 
                    if($is_event == '1'){?>
                <span>Date: <?= $date;?></span>
              
               <span>Time: <?= $time1;?></span>
               
                    <p><span> <?= $x;?></span></p>
                      <?php
                }
                ?>
                    <h6><?= substr($description, 0,200); ?> </h6>
                    <div class="share_iconss">
                        <!--<a href="#"><i class="fa fa-share"></i></a>-->
                        <a href="mailto: <?= $bussniuss_email;?>"><i class="fa fa-envelope"></i></a>
                        <a href="tel:<?= $bussniuss_phone;?>"><i class="fa fa-phone"></i></a>
                    </div>
                </div>
            </div>
            
            <!--<div class="col-sm-6 listingbox item" onmouseover="open_marker(<?= $lat?>, <?=$lng ?>)" data-lat="<?= $lat; ?>" data-lng="<?= $lng; ?>">-->
            <!--    <a href="<?php echo $this->crud_model->product_link($product_id); ?>">-->
            <!--        <div class="hover_listingbox">-->
            <!--            <img src="<?= $img; ?>" alt="">-->
            <!--        </div>-->
            <!--        <div class="hover_box_list">-->
            <!--            <h4><?= $title ?></h4>-->
            <!--            <p><?= $slogan; ?></p>-->
            <!--        </div>-->
            <!--    </a>-->
            <!--</div>-->
                      