<?php
$url = base_url('html/');
$viewtype = 'list';
if (isset($_GET['view']))
    $viewtype = $_GET['view'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>Community Hubland</title>
    <!-- meta tag -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta http-equiv="Content-Language" content="en-us"/>
    <meta name="description" content=""/>
    <meta name="keywords" content=""/>
    <meta name="distribution" content="global"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://fonts.googleapis.com/css2?family=Catamaran:wght@300;400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap"
          rel="stylesheet">
    <link id="favicon" rel="icon" type="images/favicon.png" href="images/favicon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<!--    <link rel="stylesheet" href="--><?//= $url ?><!--css/bootstrap.min.css">-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link type="text/css" rel="stylesheet" href="<?= $url ?>css/style.css"/>
    <link type="text/css" rel="stylesheet" href="<?= $url ?>css/owl.carousel.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/styles/metro/notify-metro.css" integrity="sha512-CJ6VRGlIRSV07FmulP+EcCkzFxoJKQuECGbXNjMMkqu7v3QYj37Cklva0Q0D/23zGwjdvoM4Oy+fIIKhcQPZ9Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .list_rate{
            position: absolute;
        }
        .navbar_box_items .padd_right{
            padding-left:8px !important;;
        }
        .add_bg_in .active {
            color: red;
        }
        .add_bg_in{

            box-shadow:0 0 5px #ddd;

            background: #fff;

            border-top: 1px solid #f26122;

            margin-bottom: 11px;

            margin-top: 10px;

            display: block;

            border-radius: 5px;

            padding: 8px 10px 8px 60px;

        }
        .radio_listing ul {
            justify-content: space-evenly;
            align-items: center;
            display: inline-flex;
            font-size: 11px;
            width: 95%;
            /* padding-right: 30px; */
            flex-wrap: wrap;
        }
        #sorter_search {
            cursor: pointer;
            background: #f26122;
            position: absolute;
            z-index: 99999999999;
            width: 128px;
            padding: 10px 0px !important;
            border-radius: 5px;
            right: 0;
        }
        .marg_add{margin-right: 5px;color: #f26122;}
        .set-list-more-icon ul li a {
            text-transform: uppercase;
            font-size: 11px;
            font-weight: 600;
        }
        .shop-categories li .angle_rightdown {
            vertical-align: middle;
            margin: 3px 0 0;
            border: 1px solid #f26122;
            padding: 1px 3px 0;
            display: inline-block;
            float:right;
            top: 4px;
            border: none !important;
            color: #f26122 !important;
        }
        .fa-times{
            display:none;
        }
    </style>
    <style>
        /*.img_hover_icons.left{*/
        /*    position: absolute;*/
        /*    z-index: 99;*/
        /*    left: 31px;*/
        /*    top: 15px;*/
        /*    width: 120px;*/
        /*}*/
        #list__viewss .image_delay {
            width: 100%;
            height: 350px;
        }
        .product-price {
            font-size: 19px;
            font-weight: bold;
            color: #f26122;
            padding: 0 0 7px;
        }
        .product-single .buttons .btn-add-to.cart {
            border: 1px solid #f26122;
            background: #f26122;
            color: #ffffff;
        }
        #list__viewss .icon-view i {
            background: #f26122;
            color: #fff;
            border-radius: 100%;
            width: 26px;
            height: 26px;
            text-align: center;
            padding: 7px 0px 0;
            font-size: 12px;
            margin: 0 4px 0 0;
        }
        .left_fields {
            padding: 0 !important;
        }
        .right_fields {
            text-align: right;
        }
        .right_fields_inner .list_attributes {
               font-weight: 300;
    font-size: 12px;
    line-height: 15px;
    letter-spacing: -.333333px;
    color: #33334c;
    /*margin-bottom: 19px;*/
        }
        .last_desc {
            display: inline-block;
            margin-top: 16px;
            margin-bottom: 0px;
        }
        #result .share_iconss {
            border-radius: 0;
            position: absolute;
            border-top: 1px solid #f2612280;
        }
        .affliate {
            float: left;
            margin-left: 10px;
            position: absolute;
            color: #f26122;
        }
        .share_iconss a i {
            background: #f26122;
            color: #fff;
            border-radius: 100%;
            width: 26px;
            height: 26px;
            text-align: center;
            padding: 7px 0px 0;
            font-size: 12px;
            margin: 0 4px 0 0;
        }
        .other_list div#add_height_in {
            /*border: 1px solid #cccccc8a;*/
            padding: 2px 0px;
        }
        .share_iconss {
                padding: 4px 0;
    text-align: center;
    background: #f5f5f5;
    width: 100%;
    position: absolute;
    bottom: 0;
    border-top: 1px solid #f2612280;
    left: 0;
        }
    </style>
</head>
<body id="page-name">
<div class="dotted_lines">
    <img src="<?= $url ?>images/doted-lines.png" alt="">
</div>
<div class="ellipse">
    <img src="<?= $url ?>images/Ellipse.png" width="845px" height="665px" alt="">
</div>
<div class="lines_shape">
    <img src="<?= $url ?>images/lines-shape.png" alt="">
</div>
<div class="rounded_box">
    <img src="<?= $url ?>images/rounded.png" alt="">
</div>
<!-- Popup: Shopping cart items -->
<?php
//include 'components/cart_modal.php';
?>
<?php
include 'header.php';
?>


<div class="main_warp p-0">
    <div class="container">
        <?php
        if ($this->session->flashdata('message')) {
            ?>
            <div class="alert alert-success" id="success-alert">
                <button type="button" class="close" data-dismiss="alert">x</button>
                <?= $this->session->flashdata('message');
                unset($_SESSION['message'])
                ?>
            </div>
            <?php
        }
        ?>
        <div class="row">
            <div class="row align-items-center div_center w-100">
                <div class="col-sm-12 radio_listing set-list-more-icon add_bg_in ">
                    <?php
                    ?>

                    <ul>
                        <li class="">
                            <span class="marg_add"><i class="fa-solid fa-folder"></i></span><a
                                    href="<?= base_url('directory'); ?>"
                                    class=" <?= ((isset($cur_slug) && $cur_slug == 'directory_listing') || !(isset($cur_slug))) ? "active" : "" ?>"><?php echo translate('directory'); ?></a>
                        </li>
                        <li>
                            <span class="marg_add"><i class="fa-solid fa-business-time"></i></span><a
                                    href="<?= base_url('directory/business'); ?>"
                                    class=" <?= (isset($cur_slug) && $cur_slug == 'business') ? "active" : "" ?>"><?php echo translate('business'); ?></a>
                        </li>
                        <li>
                            <span class="marg_add"><i class="fab fa-affiliatetheme"></i></span><a
                                    href="<?= base_url('directory/affiliate-business'); ?>"
                                    class=" <?= (isset($cur_slug) && $cur_slug == 'affiliate-business') ? "active" : "" ?>"><?php echo translate('affiliate'); ?></a>
                        </li>
                        <li>
                            <span class="marg_add"><i class="fa-solid fa-shop"></i></span> <a
                                    href="<?= base_url('directory/shop'); ?>"
                                    class=" <?= (isset($cur_slug) && $cur_slug == 'shop') ? "active" : "" ?>"><?php echo translate('shop'); ?></a>
                        </li>
                        <li>
                            <span class="marg_add"><i class="fa-solid fa-blog"></i></span> <a
                                    href="<?= base_url('directory/blogs'); ?>"
                                    class=" <?= (isset($cur_slug) && $cur_slug == 'blogs') ? "active" : "" ?>"><?php echo translate('Blogs'); ?></a>
                        </li>
                        <li>
                            <span class="marg_add"><i class="fa-solid fa-calendar-days"></i></span><a
                                    href="<?= base_url('directory/things-to-do-events'); ?>"
                                    class=" <?= (isset($cur_slug) && $cur_slug == 'things-to-do-events') ? "active" : "" ?>"><?php echo translate('events'); ?></a>
                        </li>
                        <li>
                            <span class="marg_add"><i class="fa-solid fa-briefcase"></i></span><a
                                    href="<?= base_url('directory/jobs'); ?>"
                                    class=" <?= (isset($cur_slug) && $cur_slug == 'jobs') ? "active" : "" ?>"><?php echo translate('jobs'); ?></a>
                        </li>
                        <li>
                            <span class="marg_add"><i class="fa-solid fa-location-dot"></i></span><a
                                    href="<?= base_url('directory/places'); ?>"
                                    class=" <?= (isset($cur_slug) && $cur_slug == 'places') ? "active" : "" ?>"><?php echo translate('places'); ?></a>
                        </li>
                        <li>
                            <span class="marg_add"><i class="fa-solid fa-car"></i></span><a
                                    href="<?= base_url('directory/vehicles-cars'); ?>"
                                    class=" <?= (isset($cur_slug) && ($cur_slug == 'vehicles-cars' || $cur_slug == 'vehicles-used-cars')) ? "active" : "" ?>"><?php echo translate('cars'); ?></a>
                        </li>
                        <li>
                            <span class="marg_add"><i class="fa-solid fa-building"></i></span><a
                                    href="<?= base_url('directory/properties'); ?>"
                                    class=" <?= (isset($cur_slug) && $cur_slug == 'properties') ? "active" : "" ?>"><?php echo translate('Property'); ?></a>
                        </li>
                        <li>
                            <span class="marg_add"><i class="fa-solid fa-hand-holding-heart"></i></span><a
                                    href="<?= base_url('directory/charities'); ?>"
                                    class=" <?= (isset($cur_slug) && $cur_slug == 'charities') ? "active" : "" ?>"><?php echo translate('charity'); ?></a>
                        </li>
                        <li>
                            <span class="marg_add"><i class="fa-solid fa-newspaper"></i></span><a
                                    href="<?= base_url('directory/publishing-news'); ?>"
                                    class=" <?= (isset($cur_slug) && $cur_slug == 'publishing-news') ? "active" : "" ?>"><?php echo translate('news'); ?></a>
                        </li>
                    </ul>
                   
                    
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <?php
                include "sidebar.php";
                ?>
            </div>
            <div class="col-md-9">
                <div class="row">
                <div class="col-md-12 pading_rmove">
                    <div class="left_form">
                <form name="dir_form" class="dir_form_css" action="<?php echo parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH); ?>">
                    <input type="text" name="q" value="<?= (isset($_GET['q'])?$_GET['q']:'') ?>" placeholder="Search" class="search_dir"/>
                    <input type="hidden" name="view" id="view" value="<?= $viewtype ?>"  placeholder="View type grid/list"/>
                    <input type="hidden" name="page" id="page" value="<?= (isset($_GET['page'])?$_GET['page']:1) ?>"  placeholder="page"/>
                      <a href="#" class="btn btn-theme-transparent on_position dropdown-toggle p-0" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <img src="<?php echo base_url(); ?>/sort12.png" alt="" width="20px;"/>
                    </a>
                    
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="#" value="rating_num"><?php echo translate('top_rated'); ?></a>
                        <a class="dropdown-item" href="#" value="distance"><?php echo translate('near_by'); ?></a>
                        <a class="dropdown-item" href="#" value="rating_num"><?php echo translate('popularity'); ?></a>
                        <a class="dropdown-item" href="#" value="condition_old"><?php echo translate('oldest'); ?></a>
                        <a class="dropdown-item" href="#" value="condition_new"><?php echo translate('newest'); ?></a>
                        <a class="dropdown-item" href="#" value="most_viewed"><?php echo translate('most_viewed'); ?></a>
                    </div>
                    <span class="hide_on_desktop btn"><i class="fa-solid fa-magnifying-glass"></i></span>
                    <input type="submit" value="Search" class="submit_search"/>
                    
                </form>
                </div>
                <div class="right_buttons">
                 <div class="col-md-2 d_flex "> 
                    <div class="icons_view">
                       
                        <button onclick="set_value('view','list');" class="<?= ($viewtype == 'list')?"active":""; ?>"> <i class="fa-solid fa-list "></i> </button>
                        <button  onclick="set_value('view','grid');" class="<?= ($viewtype == 'grid')?"active":""; ?>"><i class="fa-solid fa-table-cells-large"></i></button>
                </div>
                </div>     
                </div>
                </div>
               
                </div>
                <div class="main_listing" id="">
                    <div class="row products <?php echo $viewtype; ?> flex-gutters-10">
                        <?php

                        if ($viewtype == 'list') {
                            $col_md = 12;
                            $col_sm = 12;
                            $col_xs = 12;
                        } elseif ($viewtype == 'grid') {
                            $col_md = 4;
                            $col_sm = 6;
                            $col_xs = 6;
                        }

                        if ($tot) {
                            foreach ($all_products->result_array() as $row) {
                                $f = 6;
                                $type = 'blog';
                                        if ($viewtype == 'grid') {
                                    $type = 'blog';
                        }
                                if ($row['is_product']) {
                                    $type = 'product';
                                }
                                if($viewtype == 'grid')
                                {
                                    ?>
                                    <div class="col-md-6">
                                    <?php
                                }
                                ?>
                                
                                 <?php echo $this->html_model->product_box1($row, $type . '_' . $viewtype); ?>
                                 <?php
                                 if($viewtype == 'grid')
                                {
                                    ?>
                                    </div>
                                    <?php
                                }
                            }
                        }
                        else
                        {
                            ?>
                            <div>No result found!</div>
                            <?php
                        }

                        ?>
                    </div>

                </div>
                <ul class="pagination mt-2">

                    <?php
                    if ($tot) {
                    if ($cpage > 1) {
                        $pre = $cpage - 1;
                        ?>
                        <li onclick="set_value('page','1')" ><a ><<</a></li>
                        <li onclick="set_value('page','<?= $pre ?>')" ><a><</a></a></li>
                        <?php
                    }
                    $st = $cpage - 2;
                    if (!$st) {
                        $st = 1;
                    }
                    $en = $cpage + 2;
                    if ($en > $tpage) {
                        $en = $tpage;
                    }
                    for ($i = 1; $i <= $tpage; $i++) {
                        if ($i >= $st && $i <= $en) {

                            ?>
                            <li  onclick="set_value('page','<?= $i ?>')" class="<?= ($i == $cpage) ? "active" : " "; ?>"><a
                                        ><?= $i ?></a></li>
                            <?php
                        }
                    }
                    if ($cpage != $tpage) {
                        $nxt = $cpage + 1;
                        ?>
                        <li  onclick="set_value('page','<?= $nxt ?>')"><a>></a></li>
                        <li  onclick="set_value('page','<?= $tpage ?>')"><a>>></a></li>

                        <?php
                    }
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<?php
    include "footer.php";
?>
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://unpkg.com/default-passive-events"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js" integrity="sha512-efUTj3HdSPwWJ9gjfGR71X9cvsrthIA78/Fvd/IN+fttQVy7XWkOAXb295j8B3cmm/kFKVxjiNYzKw9IQJHIuQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script><?php
include 'script_texts.php';
?>
<script type="text/javascript">
function set_value(id, val)
{
    document.getElementById(id).value = val; 

    document.forms["dir_form"].submit(); 

}
    
    
</script>
</body>
</html>
