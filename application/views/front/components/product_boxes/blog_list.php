<style>
    .widget-search input {
        border: none !important;
    }

    #result .pagination li {
        padding: 0;
        border-bottom: none;
        font-size: 13px;
        cursor: pointer;
    }

    .logo_withname {
        border-width: 1px !important;
    }

    #result .pagination {
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

    .row_height_new {
              border-radius: 0px 10px 10px 0;
    box-shadow: 0 0 8px rgba(0, 0, 0, .1);
    margin: 0 0 25px 0;
    background: #fff;
    padding: 0px;
    border: 1px solid #f4ded2;
    }

    .desc_col_in {
        padding: 5px 10px 0px 10px !important;
    }

    .logo_round {
        position: absolute;
        width: 50px;
        height: 50px;
        border: 1px solid #f26122 !important;
        border-radius: 50%;
        /*background: #000;*/
        bottom: 10px;
        overflow: hidden;
        left: 10px;
    }

    .logo_round img {
        width: 100%;
        height: 100%;
        object-fit: contain;

    }


    .dec_wrappper p {
        color: #7a7a7a;
    }

    .itemimg {
        position: relative;
        height: 100%;
        max-height: 200px;
        min-height: 200px;
        width: 100%;
        background-size: cover;
        background-position: center;
    }

    .img_col {
        padding: 0;
    }

    .desc_col {
        padding: 20px 10px 0 10px;
    }

    .img_hover_icons.right {
        position: absolute;
        z-index: 99;
        right: 19px;
        top: 11px;
        left: unset;
    }

    .flex {
        display: flex;
        justify-content: space-between;
    }

    .center {
        text-align: center;
    }
</style>

<?php

$vendor_id = json_decode($added_by);
$id = $vendor_id->id;
$vendor = $this->db->where('vendor_id', $id)->get('vendor')->row_array();
// get product
$n = $this->db->where('product_id', $vendor['bpage'])->where('is_bpage', 1)->get('product')->row_array();

$time1 = date("H:i:s", strtotime($create_at));
$date = date('Y-m-d', strtotime($time1));
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
<div class="sidegap_product item white_shadow__box width_set"
     onmouseover="open_marker(<?= $lat ?>, <?= $lng ?>)"
     data-lat="<?= $lat; ?>" data-lng="<?= $lng; ?>" rate="<?= ($rating_num) ? $rating_num : 0; ?>">
    <div class="img_hover_icons left">
        <?php
//        echo $this->crud_model->rate_html($rating_num);
        ?>
    </div>

    <div class="row row_height_new" id="row_hieght">
        <div class="col-sm-4 col-12 img_col">
            <!--<div class="itemimg" style="background-image:url('https://imageio.forbes.com/specials-images/imageserve/5d35eacaf1176b0008974b54/0x0.jpg?format=jpg&crop=4560,2565,x790,y784,safe&width=1200')"></div>-->
            <?php
            if ($is_blog == 1){
            ?>
            <div onclick="location.href='<?= $this->crud_model->product_link($product_id); ?>'" class="itemimg 185"
                 style="background-image:url('<?= $logo; ?>')">
                <?php
                }else{
                ?>
                <div onclick="location.href='<?= $this->crud_model->product_link($product_id); ?>'" class="itemimg  190"
                     style="background-image:url('<?= $img; ?>')">
                    <?php
                    }
                    ?>
                    <!--agr is_blog 1 ho ga to $logo ko $img se replace krna h -->
                    <div class="logo_withname">
                        <!--<img src="https://static.cargurus.com/images/forsale/2023/02/26/09/26/2020_chevrolet_corvette-pic-2662332189977326050-1024x768.jpeg" alt="">-->
<!--                        <img src="--><?//= $vendorlogo; ?><!--" alt=""/>-->
                        <?php

                        $time = date('H:i:s', time());
                        if ($time >= $vendor['openig_time'] && $time <= $vendor['closing_time']) {
                            ?>
                            <a href="#" class="online_box_wrapper"><span class="online_box2"></span></a>
                            <?php
                        }
                        ?>
                        <div class="logo_round">
                            <img src="<?= $vendorlogo; ?>" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <?php
            $cls = '';
            if (!$is_bpage && !$is_blog) {
                $cls = 'other_list';
            }
            ?>

            <div class="col-sm-8 col-12 desc_col desc_col_in <?= $cls ?>">
                <!--work here-->
                <div class="row" id="add_height_in">
                    <?php
                    if ($is_bpage) {
                        ?>

                        <h1><?= $title; ?>
                            <span class="rate2" style="float:right; color : black;">
                                <?php
                                echo $this->crud_model->rate_html($rating_num);
                                ?>
                            </span>
                        </h1>
                        <?php

                        if ($slog) {
                            ?>
                            <h4>
                                <?= $slog ?>
                            </h4>
                            <?php
                        }
                        ?>

                        <div class="last_desc last_d2 col-md-12">
                            <div class="col-md-12 dec_wrappper p-0">

                                <p>
                                    <?= strWordCut($description, 180); ?>
                                </p>
                            </div>
                        </div>
                        <div class="share_iconss icon_shares">
                            <div class="affliate">
                                <?php
                                $user = true;//$this->session->userdata('user_id');
                                if ($is_affiliate && $user) {
                                    $vid = 0;
                                    $added_by = json_decode($added_by, true);
                                    if (isset($added_by['type']) && $added_by['type'] == 'vendor') {
                                        $vid = $added_by['id'];
                                    }

                                    $wish = $this->crud_model->is_aff($product_id);
                                    ?>
                                    Affiliate
                                    <?php
                                }
                                ?>
                            </div>
                            <!--<a href="#"><i class="fa fa-share"></i></a>-->
                            <?php
                            if ($lat && $lng) {
                                ?>
                                <a href="https://maps.google.com/?q=<?= $lat;?>,<?= $lng;?>"><i class="fa fa-map-marker-alt"></i></a>
                                <?php
                            }
                            ?>
                            <a href="#"><i class="fa fa-share"></i></a>
                            <a href="<?php base_url()?>/home/wishlist/add/<?=$product_id?>" ><i class="fa fa-heart"></i></a>
                            <a href="mailto: <?= $bussniuss_email; ?>"><i class="fa fa-envelope"></i></a>
                            <a href="tel:<?= $bussniuss_phone; ?>"><i class="fa fa-phone"></i></a>
                            <a href="tel:<?= $bussniuss_phone; ?>"><i class="fa-brands fa-whatsapp"></i></a>

                        <?php
                    } elseif ($is_blog) {
                        ?>
                        <div class="col-md-12 p-0">
                            <div class="blogs_titlee"><h1><?= $title ?></h1></div>
                            <div class="meddle_cont">
                                <div class="meddle_cont_left">
                                    <?php
                                    if ($author_name) {
                                        ?>
                                        <h4><?= $author_name; ?></h4>
                                        <?php
                                    }
                                    ?>
                                    <?php

                                    if ($slog) {
                                        ?>
                                        <h4><?= $slog ?></h4>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <div class="meddle_cont_right">
                                    <h4>Posted On <?= date("d-m-Y", strtotime($create_at)); ?></h4>
                                    <?php
                                    if (!empty($posted_date)) {
                                        ?>
                                        <h4>Updated On <?= date("d-m-Y", strtotime($posted_date)); ?></h4>
                                        <?php
                                    }
                                    $cat = $this->db->where('category_id', $category)->get('category')->row_array();
                                    // var_dump($c)
                                    ?>
                                    <h4><?= $cat['category_name']; ?></h4>
                                </div>
                            </div>
                            <div class="last_desc">
                                <div class="col-md-12 dec_wrappper p-0">
                                    <h2>Details</h2>
                                    <p>
                                        <?= strWordCut($description, 150); ?>
                                    </p>
                                </div>
                            </div>
                            <div class="share_iconss">
                                <div class="affliate">
                                    <?php
                                    $user = true;//$this->session->userdata('user_id');
                                    if ($is_affiliate && $user) {
                                        $vid = 0;
                                        $added_by = json_decode($added_by, true);
                                        if (isset($added_by['type']) && $added_by['type'] == 'vendor') {
                                            $vid = $added_by['id'];
                                        }

                                        $wish = $this->crud_model->is_aff($product_id);
                                        ?>
                                        Affiliate
                                        <?php
                                    }
                                    ?>
                                </div>
                                <!--<a href="#"><i class="fa fa-share"></i></a>-->
                                <?php
                                if ($lat && $lng) {
                                    ?>
                                    <a onclick="open_marker(<?= $lat ?>, <?= $lng ?>);"><i
                                                class="fa fa-map-marker-alt"></i></a>
                                    <?php
                                }
                                ?>
                                <a href="#"><i class="fa fa-share"></i></a>
                                <a onclick="to_wishlist(<?php echo $product_id; ?>,event)"><i
                                            class="fa fa-heart"></i></a>
                                <a href="mailto: <?= $bussniuss_email; ?>"><i class="fa fa-envelope"></i></a>
                                <a href="tel:<?= $bussniuss_phone; ?>"><i class="fa fa-phone"></i></a>
                            </div>
                        </div>


                        <?php

                    } else {
                        ?>
                         <h1><?= $title; ?></h1>
                        <div class="col-md-8 left_fields special_cls car_out">
                           
                            <?php
                            if ($slog) {
                                ?>
                                <h2><?= $slog ?></h2>
                                <?php
                            }
                            ?>
                            <div class="list_attributes list3">
                                <?= get_fields_line($product_id, 3); ?>
                            </div>
                            <div class="list_attributes list5">
                                <?= get_fields_line($product_id, 5); ?>
                            </div>
                        </div>
                        <div class="col-md-4 right_fields special_cls">
                            <div class="right_fields_inner">
                                <div class="list_attributes list2">
                                    <?= get_fields_line($product_id, 1); ?> , <?= $city ?>
                                </div>
                                <div class="list_attributes list2">
                                    <?= get_fields_line($product_id, 2); ?>
                                </div>
                                <div class="list_attributes list4">
                                    <?= get_fields_line($product_id, 4); ?>
                                </div>
                                <div class="list_attributes list6">
                                    <?= get_fields_line($product_id, 6); ?>
                                </div>
                            </div>

                        </div>
                        <?php
                        if ($description) {
                            ?>
                            <div class="last_desc">
                                <div class="col-md-12 dec_wrappper p-0">
                                    <h2 class="catch_phrase">Details</h2>
                                    <p class="para_text">
                                        <?= strWordCut($description, 150); ?>
                                    </p>
                                </div>
                            </div>
                            <div class="share_iconss icon_shares">
                                <div class="affliate">
                                    <?php
                                    $user = true;//$this->session->userdata('user_id');
                                    if ($is_affiliate && $user) {
                                        $vid = 0;
                                        $added_by = json_decode($added_by, true);
                                        if (isset($added_by['type']) && $added_by['type'] == 'vendor') {
                                            $vid = $added_by['id'];
                                        }

                                        $wish = $this->crud_model->is_aff($product_id);
                                        ?>
                                        Affiliate
                                        <?php
                                    }
                                    ?>
                                </div>
                                <!--<a href="#"><i class="fa fa-share"></i></a>-->
                                <?php
                                if ($lat && $lng) {
                                    ?>
                                    <a onclick="open_marker(<?= $lat ?>, <?= $lng ?>);"><i
                                                class="fa fa-map-marker-alt"></i></a>
                                    <?php
                                }
                                ?>
                                <a href="#"><i class="fa fa-share"></i></a>
                                <a onclick="to_wishlist(<?php echo $product_id; ?>,event)"><i
                                            class="fa fa-heart"></i></a>
                                <a href="mailto: <?= $bussniuss_email; ?>"><i class="fa fa-envelope"></i></a>
                                <a href="tel:<?= $bussniuss_phone; ?>"><i class="fa fa-phone"></i></a>
                                <a href="tel:<?= $bussniuss_phone; ?>"><i class="fa-brands fa-whatsapp"></i></a>
                            </div>
                            <?php
                        }
                        ?>

                        <?php
                    }

                    ?>
                </div>


            </div>
        </div>
    </div>
</div>

