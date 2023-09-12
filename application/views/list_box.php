<?php
$url = base_url('updated/');
$description = strtolower($description);
$vendor_id = json_decode($added_by);
$id = $vendor_id->id;
$vendor = $this->db->where('vendor_id', $id)->get('vendor')->row_array();

// get product
$n = $this->db->where('product_id', $vendor['bpage'])->where('is_bpage', 1)->get('product')->row_array();
$time1 = formate_date($create_at);
$date = formate_date($time1);
$time = time();
if ($time >= $openig_time && $time <= $closing_time) {
    $x = 'Opened';
} else {
    $x = 'Closed';
}
$this->db->where('added_by', $added_by);
$this->db->where('is_bpage', 1);
$vendor = $this->db->get('product')->row_array();
$vendorlogo = '';
$img = '';
$logo = '';
// var_dump($added_by);
// $is_event=1;

if ($comp_cover) {
    $img = $this->crud_model->get_img($comp_cover);
    if (isset($img->webp_url) && $img->webp_url) {
        $img = base_url().$img->webp_url;
    }
    else
    {
        $img = base_url().$img->path;
    }

} else {
    $img = $this->crud_model->file_view('product', $product_id, '', '', 'thumb', 'src', 'multi', 'one');

}
if ($n['comp_logo']) {
    $vendorlogo = $this->crud_model->get_img($n['comp_logo']);
    if (isset($vendorlogo->secure_url)) {
        $vendorlogo = $vendorlogo->secure_url;
    }

} else {
    $vendorlogo = $this->crud_model->file_view('product', $product_id, '', '', 'thumb', 'src', 'multi', 'one');

}

if ($comp_logo) {
    $logo = $this->crud_model->get_img($comp_logo);

    if (isset($logo->webp_url) && $logo->webp_url) {
        // $logo = base_url('/').$logo->path;
        $logo = base_url().$logo->webp_url;
    }
    else
    {
        $logo = base_url().$logo->path;
    }
    

} else {
    $logo = $this->crud_model->file_view('product', $product_id, '', '', 'thumb', 'src', 'multi', 'one');

}


?>
<div class="change-item col-lg-12">
                      <div class="sidegap_product item white_shadow__box width_set job_list bpaeg_list "
                        data-lat="31.5203696" data-lng="74.35874729999999" rate="3">
                        <div class="row row_height_new" id="row_hieght">
                          <div class="col-sm-4 col-12 img_col">
                            <div class="itemimg-wrap  190">
                              <a href="<?= base_url($slug); ?>"><img src="<?= $img; ?>"
                                  class="img-fluid item-img" alt=""></a>
                              <div class="logo_withname">
                                <div class="logo_round">
                                  <img src="<?= $vendorlogo; ?>"
                                    alt="">
                                  <span class="status active"></span>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="col-sm-8 col-12 desc_col desc_col_in ">
                            <div class="row" id="add_height_in">

                              <div class="col-8">
                                <h1 class="p_me"><a href="<?= base_url($slug); ?>"><?= ceil($distance); ?><?= $title; ?></a>
                                </h1>
                              </div>
                              <div class="col-4">
                                <div class="rate2 p_me">
                                    <?php 
                                    echo $this->crud_model->rate_html($n['rating_num']);
                                    ?>
                                </div>
                              </div>
                              <div class="col-md-6 left_fields special_cls car_out">
                                <div class="meta meta-left">
                                  <span><a href="#"><?= ($col1)?$col1:get_fields_line($product_id, 1); ?></a></span>
                                </div>
                                <div class="meta meta-left">
                                  <span><?= ($col2)?$col2:get_fields_line($product_id, 2); ?></span>
                                </div>
                                <div class="meta meta-left">
                                  <span><?= ($col3)?$col3:get_fields_line($product_id, 3); ?></span>
                                </div>
                              </div>
                              <div class="col-md-6 right_fields special_cls car_out">
                                <div class="meta meta-right">
                                  <span><?= ($col4)?$col4:get_fields_line($product_id, 4); ?></span>
                                </div>
                                <div class="meta meta-right">
                                  <span><?= ($col5)?$col5:get_fields_line($product_id, 5); ?></span>
                                </div>
                                <div class="meta meta-right">
                                  <span><?= ($col6)?$col6:get_fields_line($product_id, 6); ?></span>
                                </div>
                              </div>
                              <h2 class="p_me catch_phrase spacing_catch_p"><?= strWordCut($slog, 50); ?> </h2>


                              <div class="last_desc last_d2 col-md-12 p_me">
                                <div class="col-md-12 dec_wrappper p-0">

                                  <p class="para_text"><?=strWordCut($description, 280);?> </p>
                                </div>
                              </div>
                              <div class="share_iconss icon_shares">
                                <div class="affliate">
                                </div>
                                <!--<a href="#"><i class="fa fa-share"></i></a>-->
                                <a href="https://maps.google.com/?q=<?= $lat;?>,<?= $lng;?>"><i
                                    class="fa fa-map-marker-alt"></i></a>
                                <a href="#"><i class="fa fa-share"></i></a>
                                <a href="<?php base_url()?>/home/wishlist/add/<?=$product_id?>"><i class="fa fa-heart"></i></a>
                                <a href="mailto: <?= $bussniuss_email; ?>"><i class="fa fa-envelope"></i></a>
                                <a href="tel:<?= $bussniuss_phone; ?>"><i class="fa fa-phone"></i></a>
                                <a href="tel:<?= $bussniuss_phone; ?>"><i class="fa-brands fa-whatsapp"></i></a>

                              </div>


                            </div>
                          </div>
                        </div>
                      </div>
                    </div>