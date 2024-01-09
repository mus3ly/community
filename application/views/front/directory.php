<?php
$url = base_url('html/');
$viewtype = 'list';
if (isset($_GET['view']))
    $viewtype = $_GET['view'];
?>
<?php
$url = base_url('html/');
include "header.php";
$det = place_details($_GET['place_id']);
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
                        <?php
                        $mod = $this->db->where('dir_check',1)->get('modules')->result_array();
                        foreach($mod as $k=> $v)
                        {
                            ?>
                            <li>
                            <span class="marg_add"><i class="fa-solid <?= $v['dir_icon'] ?>"></i></span><a
                                    href="<?= base_url('directory'); ?>/<?= $v['dir_slug'] ?>"
                                    class="<?= (isset($car_mod) && $car_mod == $v['id']) ? "active" : "" ?>"><?php echo translate($v['dir_text']); ?></a>
                        </li>
                            <?php
                        }
                        ?>
                        
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
                <div class="col-sm-9 col-md-9 width_on_mobile pading_rmove">
                    <div class="left_form">
                <form name="dir_form" class="dir_form_css" action="<?php echo parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH); ?>">
                    <input type="hidden" name="max_price" value="<?= isset($_GET['max_price'])?$_GET['max_price']:'' ?>" id="max_price" />
                    <input type="hidden" name="dis_range" value="<?= isset($_GET['dis_range'])?$_GET['dis_range']:'' ?>" id="dis_range" />
                    
        <?php
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
if(isset($car_mod))
{
    $mod = $this->db->where('id',$car_mod)->get('modules')->row();
    if(isset($mod->filter_file) && trim($mod->filter_file))
    $this->load->view('front/filters/'.$mod->filter_file,array('type'=>'top'));
}
?>
                    <input type="hidden" name="sale_price" value="<?= (isset($_GET['sale_price'])?$_GET['sale_price']:'') ?>" placeholder="Search" id="sale_price" class="search_dir"/>
                    <input type="text" name="q" value="<?= (isset($_GET['q'])?$_GET['q']:'') ?>" placeholder="Search" id="left_form_1" class="search_dir"/>
                    <input type="text" placeholder="City or Postcode" id="right_box" value="<?= (isset($det['result']['formatted_address'])?$det['result']['formatted_address']:'') ?>" onkeyup="search_location()" class="search_dir"/>
                    <span onclick="submit_dform()" class="hide_on_desktop btn"><i class="fa-solid fa-magnifying-glass"></i></span>
                    <input type="hidden" id="place_id" value="<?= (isset($_GET['place_id'])?$_GET['place_id']:'') ?>" name="place_id">
                    <input type="hidden" name="view" id="view" value="<?= $viewtype ?>"  placeholder="View type grid/list"/>
                    <input type="hidden" name="amenity" id="amenity" value="<?= (isset($_GET['amenity'])?$_GET['amenity']:"") ?>"  placeholder="Amenity"/>
                    <input type="hidden" name="page" id="page" value="<?= (isset($_GET['page'])?$_GET['page']:1) ?>"  placeholder="page"/>
                      
                   
                        
                        
                    
                    
                    <input type="submit" value="Search" class="submit_search"/>
                     <div id="map_search" style="
    z-index: 9999999999999999;
    position: absolute;
<!--">                          
                        
                         <div id="result" class="directory_result"></div>
                         <div class="loader_container">    
                         <img id="loader" style="display:none" src="<?= base_url(); ?>/map-loader.gif">
                         </div>
                     </div>
                </form>
                </div>
                </div>
                <div class="col-md-3 col-sm-3 width_on_mobile_2 p-0">
                    <div class="right_directory_menu">
                    <div class="select_tops">
                        <select class="btn btn-theme-transparent on_position dropdown-toggle p-0" type="button" id="" onchange="submit_dform()" name="sort" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <option class="on_position_drop dropdown-item bg-white" href="#" value="rating_num">Select Sort</option>
                        <option class="on_position_drop dropdown-item bg-white" href="#" value="rating_num" <?= (isset($_GET['sort']) && $_GET['sort'] == 'rating_num')?"selected":""; ?> ><?php echo translate('top_rated'); ?></option>
                        <option class="on_position_drop dropdown-item bg-white" href="#" value="distance" <?= (isset($_GET['sort']) && $_GET['sort'] == 'distance')?"selected":""; ?>><?php echo translate('near_by'); ?></option>
                        <option class="on_position_drop dropdown-item bg-white" href="#" value="rating_num" <?= (isset($_GET['sort']) && $_GET['sort'] == 'rating_num')?"selected":""; ?>><?php echo translate('popularity'); ?></option>
                        <option class="on_position_drop dropdown-item bg-white" href="#" value="condition_old" <?= (isset($_GET['sort']) && $_GET['sort'] == 'condition_old')?"selected":""; ?>><?php echo translate('oldest'); ?></option>
                        <option class="on_position_drop dropdown-item bg-white" href="#" value="condition_new" <?= (isset($_GET['sort']) && $_GET['sort'] == 'condition_new')?"selected":""; ?>><?php echo translate('newest'); ?></option>
                        <option class="on_position_drop dropdown-item bg-white" href="#" value="most_viewed" <?= (isset($_GET['sort']) && $_GET['sort'] == 'most_viewed')?"selected":""; ?>><?php echo translate('most_viewed'); ?></option>
                    </select>
                    </div>
                 <div class="right_buttons">
                 
                    <div class="icons_view">
                       
                        <button onclick="set_value('view','list');" class="<?= ($viewtype == 'list')?"active":""; ?>"> <i class="fa-solid fa-list "></i> </button>
                        <button  onclick="set_value('view','grid');" class="<?= ($viewtype == 'grid')?"active":""; ?>"><i class="fa-solid fa-table-cells-large"></i></button>
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
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<?php
$directory = 1;
    include "footer.php";
?>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://unpkg.com/default-passive-events"></script><?php
// include 'script_texts.php';
?>
<script type="text/javascript">
function set_value(id, val)
{
    document.getElementById(id).value = val; 
    submit_dform();

    

}
function submit_dform()
{
    var dis_range = document.getElementById("dis_range_input").value; 
    
    if(dis_range)
    {
        document.getElementById('dis_range').value = '1'+'-'+dis_range;
        //dis_range
    }
    document.forms["dir_form"].submit(); 
}
function change_make()
{
    var dis_range_select = document.getElementById("select_make").value;
    set_value('make_input',dis_range_select);
}
function propert_filter()
{
    var select_condition = document.getElementById("dis_range").value;
    var select_condition = document.getElementById("myRange").value;
    document.getElementById('max_price').value = select_condition;
    var select_condition = document.getElementById("listing_type_select").value;
    document.getElementById('listing_type').value = select_condition;
    var select_condition = document.getElementById("bedrooms_input").value;
    document.getElementById('bedroom').value = select_condition;
    submit_dform();
}
function job_filter()
{
    /*var select_condition = document.getElementById("myRange").value;
    document.getElementById('max_price').value = select_condition;/*/
    var select_condition = document.getElementById("select_job_type").value;
    document.getElementById('job_type').value = select_condition;
    var select_condition = document.getElementById("select_job_hours").value;
    document.getElementById('job_hours').value = select_condition;
    submit_dform();
}
function car_filter()
{
    var dis_range_select = document.getElementById("select_make").value;
    document.getElementById('make_input').value = dis_range_select;
    var modelf_input = document.getElementById("modelf_input").value;
    document.getElementById('modelf').value = modelf_input;
    var modelt_input = document.getElementById("modelt_input").value;
    document.getElementById('modelt').value = modelt_input;
    var seats_input = document.getElementById("seats_input").value;
    document.getElementById('seats').value = seats_input;
    var select_condition = document.getElementById("select_condition").value;
    document.getElementById('condition_input').value = select_condition;
    var select_condition = document.getElementById("myRange").value;
    document.getElementById('max_price').value = select_condition;
    var select_condition = document.getElementById("listing_type_select").value;
    document.getElementById('listing_type').value = select_condition;
    submit_dform();
}
function custom_filter(cat)
{
    <?php
               $max = $max_price;
               $this->db->where_in('category',$cat_path);
               $sale_check = $this->db->where('is_filter',1)->where('tbl_col','sale_price')->get('list_fields')->row();
            if($sale_check || (isset($is_listing) && $is_listing == 'shop_listing')){
                    ?>
                    var select_condition = document.getElementById("myRange").value;
    document.getElementById('sale_price').value = select_condition;
                    
                    <?php
            }
                    ?>
    /*if(cat == '807')
    {
    var select_condition = document.getElementById("myRange").value;
    document.getElementById('max_price').value = select_condition;
    var select_condition = document.getElementById("type_vehicle_filter").value;
    document.getElementById('listing_type').value = select_condition;
    var seats_input = document.getElementById("vehicle_Seats_filter").value;
    document.getElementById('seats').value = seats_input;
    var select_condition = document.getElementById("car_condition_filter").value;
    document.getElementById('condition_input').value = select_condition;
    var select_condition = document.getElementById("car_condition_filter").value;
    document.getElementById('condition_input').value = select_condition;
    var dis_range_select = document.getElementById("modal_filter").value;
    document.getElementById('make_input').value = dis_range_select;
    var dis_range_select = document.getElementById("make_filter").value;
    document.getElementById('make_input').value = dis_range_select;
    */
    submit_dform();
}

         <?php
               $max = $max_price;
               $sale_check =0;
               if($cat_path)
               {
               $this->db->where_in('category',$cat_path);
               $sale_check = $this->db->where('is_filter',1)->where('tbl_col','sale_price')->get('list_fields')->row();
               }
            if($sale_check || (isset($is_listing) && $is_listing == 'shop_listing')){
                    ?>
    var slider = document.getElementById("myRange"); 
var output = document.getElementById("demo");
output.innerHTML = slider.value; // Display the default slider value

slider.oninput = function() {
  output.innerHTML = this.value;
}
<?php
}
?>
    var slider1 = document.getElementById("dis_range_input");
var output1 = document.getElementById("demo1");
output1.innerHTML = slider1.value; // Display the default slider value

// Update the current slider value (each time you drag the slider handle)

slider1.oninput = function() {
  output1.innerHTML = this.value;
}
function update_filter(id,col)
        {
            var input = document.getElementById(id+'_filter');
            var value = input.value;
            if(value == 'other' && input.getAttribute('type') == 'model')
            {
                var outer = id+'_outer';  
             var html = '<input type="text" id="'+input.getAttribute('id')+'" col="'+input.getAttribute('col')+'" rows="9" onkeyup="'+input.getAttribute('onchange')+'" class="form-control required" placeholder="'+input.getAttribute('placeholder')+'" data-height="100" name="ad_field_values[]">';
             document.getElementById(outer).innerHTML = html;
            }
            else
            {
            document.getElementById(col).value = value; 
            }

        }
    
</script>
<?php
if(isset($car_mod))
{
    $mod = $this->db->where('id',$car_mod)->get('modules')->row();
    if(isset($mod->filter_file) && trim($mod->filter_file))
    $this->load->view('front/filters/'.$mod->filter_file,array('type'=>'js'));
}
?>
</body>
</html>
