<?php
$url = base_url('updated/');
 include "header_new.php";
 $viewtype = 'list';
if (isset($_GET['view']))
$viewtype = $_GET['view'];
    $ip_loc = '';
    
    if(isset($_GET['place_id']) && $_GET['place_id'])
    {
        $det = place_details($_GET['place_id']);
    }
    else
    {
        if(isset($_SESSION['ip_info']))
        {
        
        }
    }
    
?>
<!-- CSS -->
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/chosen/1.1.0/chosen.min.css">

<!-- JS -->
<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/chosen/1.1.0/chosen.jquery.min.js"></script>
  <!-- Directory Menu -->
  <div class="directory-menu">
    <div class="container">
      <div class="directory-menu-inner">
        <div class="row align-items-center div_center">
          <div class="col-sm-12 radio_listing set-list-more-icon add_bg_in ">

            <ul>
                        <li class="">
                            <span class="marg_add"><i class="fa-solid fa-folder"></i></span><a
                                    href="#" onclick="ch_url('/')"
                                    class=" <?= ((isset($cur_slug) && $cur_slug == 'directory_listing') || !(isset($cur_slug))) ? "active" : "" ?>"><?php echo translate('directory'); ?></a>
                        </li>
                        <li>
                            <span class="marg_add"><i class="fa-solid fa-business-time"></i></span><a
                                    href="#" onclick="ch_url('business')"
                                    class=" <?= (isset($cur_slug) && $cur_slug == 'business') ? "active" : "" ?>"><?php echo translate('business'); ?></a>
                        </li>
                        <li>
                            <span class="marg_add"><i class="fab fa-affiliatetheme"></i></span><a
                                    href="#" onclick="ch_url('affiliate-business')"
                                    class=" <?= (isset($cur_slug) && $cur_slug == 'affiliate-business') ? "active" : "" ?>"><?php echo translate('affiliate'); ?></a>
                        </li>
                        <?php
                        $mod = $this->db->where('dir_check',1)->get('modules')->result_array();
                        foreach($mod as $k=> $v)
                        {
                            ?>
                            <li>
                            <span class="marg_add <?= (isset($car_mod) && $car_mod == $v['id']) ? "active" : "" ?>"><i class="fa-solid <?= $v['dir_icon'] ?>"></i></span><a
                                    href="#"
                                    onclick="ch_url('<?= $v['dir_slug'] ?>')"class=" <?= (isset($car_mod) && $car_mod == $v['id']) ? "active" : "" ?>"><?php echo translate($v['dir_text']); ?></a>
                        </li>
                            <?php
                        }
                        ?>
                        
                    </ul>


          </div>
        </div>
      </div>
    </div>
  </div>
  <main class="directory-main">
    <div class="ads-listing">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-8 col-md-12 order-lg-2">
            <div class="listings-wrapper">
              <div class="custom-result">
                <div class="row align-items-center">
                  <div class="col-sm-12 col-lg-2 col-md-2">
                    <div class="select_tops hide_on_mobile">
                      <div class="custom-select-box">
                        <select onchange="submit_dform()" id="select_sort" name="sort">
                          <option  value="" <?= !isset($_GET['sort'])?"selected":""?>)?>Sort By</option>
                          <option  value="" <?= !isset($_GET['sort'])?"selected":"" ?>>Sort By</option>
                        <option value="rating_num" <?= (isset($_GET['sort']) && $_GET['sort'] == 'rating_num')?"selected":""; ?> ><?php echo translate('top_rated'); ?></option>
                        <!--<option value="distance" <?= (isset($_GET['distance']) && $_GET['distance'] == 'distance')?"selected":""; ?>><?php echo translate('near_by'); ?></option>-->
                        <option value="condition_old" <?= (isset($_GET['sort']) && $_GET['sort'] == 'condition_old')?"selected":""; ?>><?php echo translate('oldest'); ?></option>
                        <option value="condition_new" <?= (isset($_GET['sort']) && $_GET['sort'] == 'condition_new')?"selected":""; ?>><?php echo translate('newest'); ?></option>
                        <option value="most_viewed" <?= (isset($_GET['sort']) && $_GET['sort'] == 'most_viewed')?"selected":""; ?>><?php echo translate('most_viewed'); ?></option>
                        <option value="tlsale" <?= (isset($_GET['sort']) && $_GET['sort'] == 'tlsale')?"selected":""; ?>><?php echo translate('low_to_top_price'); ?></option>
                        <option value="ltsale" <?= (isset($_GET['sort']) && $_GET['sort'] == 'ltsale')?"selected":""; ?>><?php echo translate('top_to_low_price'); ?></option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-12 col-lg-8 col-md-8 width_on_mobile ">
                    <div class="left_form">
                        <form name="dir_form" id="dir_form" class="dir_form_css" action="<?php echo parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH); ?>"> 
                        <input type="hidden" name="sort" value="" id="form_sort" />
                        <input type="hidden" name="country" value="<?= (isset($_GET['country'])?$_GET['country']:0) ?>" id="form_country" />
                        <input type="hidden" name="dis_range" value="<?= (isset($_GET['dis_range'])?$_GET['dis_range']:500) ?>" id="dis_range_input" />
                        <input type="hidden" id ="sale_price" name ="sale_price" value="<?= (isset($_GET['sale_price'])?$_GET['sale_price']:$max_price) ?>" />
                        <?php
                        if($cat_path)
                        {
                            $this->db->where_in('category',$cat_path);
                            $arr = $this->db->where('is_filter',1)->where('hide_filter',0)->get('list_fields')->result_array();
                            foreach($arr as $k=> $v)
                            {
                                if($v['tbl_col'] != 'sale_price')
                                {
                                ?>
                                <input type="hidden" id ="<?= $v['tbl_col'] ?>" name ="<?= $v['tbl_col'] ?>" value="<?= (isset($_GET[$v['tbl_col']])?$_GET[$v['tbl_col']]:'') ?>" />
                                <?php
                                }
                            
                            }
                        }

                if(isset($car_mod))
                {
                    $mod = $this->db->where('id',$car_mod)->get('modules')->row();
                    if(isset($mod->filter_file) && trim($mod->filter_file))
                    $this->load->view('front/filters/'.$mod->filter_file,array('type'=>'top'));
                }
                        ?>
                        <input type="text" name="q" value="<?= (isset($_GET['q'])?$_GET['q']:'') ?>" placeholder="Search" id="left_form_1" class="search_dir"/>
                        <input type="text" placeholder="City or Postcode" id="right_box" value="<?= (isset($det['result']['formatted_address'])?$det['result']['formatted_address']:$ip_loc) ?>"
                          onkeyup="search_location()" class="search_dir" />
                        <input type="hidden" id="place_id" value="<?= (isset($_GET['place_id'])?$_GET['place_id']:'') ?>" name="place_id">
                        <input type="hidden" name="view" id="view" value="list" placeholder="View type grid/list" />
                        <input type="hidden" name="amenity" id="amenity" value="" placeholder="Amenity" />
                        <input type="hidden" name="page" id="page" value="1" placeholder="page" />
                        <span onclick="submit_dform()" class="search-icon hide_on_desktop btn"><i
                            class="fa-solid fa-magnifying-glass"></i></span>

                        <!-- <input type="submit" value="Search" class="submit_search" /> -->
                        <div id="map_search">

                          <div id="result" class="directory_result"></div>
                          <div class="loader_container">
                            <img id="loader" style="display:none" src="#">
                          </div>
                        </div>
                      </form>
                      <div id="location-result" class="dropdown-box1" style="display:none">
                            <ul>
                            </ul>
                          </div>
                    </div>
                  </div>
                  <div class="col-md-2 col-lg-2 col-sm-12 width_on_mobile_2">
                    <div class="right_directory_menu">
                      <div class="select_tops hide_on_desktop">
                        <div class="custom-select-box">
                          <select>
                            <option value="">Short By</option>
                            <option value="">Short By</option>
                            <option value="">Date</option>
                            <option value="">Price</option>
                            <option value="">A to Z</option>
                          </select>
                        </div>
                      </div>
                      <div class="right_buttons">

                        <div class="icons_view">

                          <button onclick="set_value('view','list');" class="<?= ($viewtype == 'list')?"active":""; ?>"> <i class="fa-solid fa-list "></i> </button>
                        <button  onclick="set_value('view','grid');" class="<?= ($viewtype == 'grid')?"active":""; ?>"><i class="fa-solid fa-table-cells-large"></i></button>
                          <button id="map" class=""><i class="fa-solid fa-map-location-dot"></i></button>
                        </div>

                      </div>

                    </div>
                  </div>
                </div>
              </div>
              <div class="listings">
                <div class="main_listing" id="list-grid">
                    <?php
                        include 'flash.php';
                        ?>
                  <div class="row products list flex-gutters-10">
                    <div class="col-lg-12 col-md-12 map-wrapper mb-4">
                        
                      <iframe
                        src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d14607.599897020727!2d90.38425379716999!3d23.750946087681623!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sRestaurants!5e0!3m2!1sen!2sbd!4v1609477869360!5m2!1sen!2sbd"
                        width="100%" height="100%" frameborder="0" style="border:0;" allowfullscreen=""
                        aria-hidden="false" tabindex="0"></iframe>
                        
                    </div>
                    <?php

                        if ($viewtype == 'list') {
                            $col_md = 12;
                            $col_sm = 12;
                            $col_xs = 12;
                        } elseif ($viewtype == 'grid') {
                            $col_md = 6;
                            $col_sm = 6;
                            $col_xs = 6;
                        }

                        if ($tot) {
                            foreach ($all_products as $row) {
                                $f = 6;
                                $type = 'blog';
                                        if ($viewtype == 'grid') {
                                    $type = 'blog';
                        }
                                if ($row['is_product']) {
                                    $type = 'product';
                                }
                                
                                if($row['comp_cover'])
                                {
                                    if($viewtype == 'list')
                                    {
                                        $this->load->view('list_box',$row);
                                    }
                                    else
                                {
                                    $this->load->view('grid_box',$row);
                                }
                                
                                
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
          <div class="col-lg-2 col-md-12 order-lg-1">
                <?php
                
                include "sidebar_new.php";
                ?>
          </div>
          
          <div class="col-md-12 col-lg-2 order-lg-3">
            <div class="ads-sidebar1">
              <div class="ads-box1">
                <a href="https://penpath.com/?utm_medium=affiliate&utm_source=com-hubland&utm_campaign=Banner_community-hubland_sept-23&utm_term=pr_banner_affiliate&utm_content=banner-1"  target="_blank">
                <img src="<?= base_url('ad1.png'); ?>" class="img-fluid" alt="">
            </a>
              </div>
              <div class="ads-box1">
                <a href="https://theeliteva.co.uk/" target="_blank">
                <img src="<?= base_url('ad2.png') ?>" class="img-fluid" alt="">
            </a>
              </div>
              <div class="ads-box1">
                <a href="https://www.discovercars.com/?a_aid=Hubland&amp;a_aid=Hubland&amp;a_bid=61a4ac81" target="_blank">
                <img src="https://www.discovercars.com/assets/common/img/discovercars-thumbnail.jpg?v=1.0.1868" class="img-fluid" alt="">
            </a>
              </div>
            </div>
          </div>          
        </div>
      </div>
    </div>
  </main>
  

  
<?php
    $directory = 1;
  include "footer_new.php";
?>
