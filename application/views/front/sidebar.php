
<style>
    
</style>
<aside class="col-md-12 sidebar new_sidebar" id="sidebar">
    <div id="adding_mrgn"  style="display:block">
    <!--<label>Distance Range</label>-->
    <?php
    $max_dis = 1000;
    ?>
          <div class="row">
        <div class="col-md-6 pl-0">            
        <p class="margin_bottom_remove">Distance range :</p>
        </div>
        <div class="col-md-6 pr-0">
        <div style="color:#000;" class="ranger">
              
              <span id="demo1"><?= (isset($_GET['dis_range'])?explode('-',$_GET['dis_range'])[1]:$max_dis) ?></span>
        </div>
        </div>
        </div>
    <input type="range" min="1" max="<?= $max_dis ?>" value="<?= (isset($_GET['dis_range'])?explode('-',$_GET['dis_range'])[1]:$max_dis) ?>" class="slider" id="dis_range_input" >
    </div>
    <div class="new_filter">
         <?php
         $is_fil = false;
               $max = $max_price;
               $sale_check =0;
               if($cat_path)
               {
               $this->db->where_in('category',$cat_path);
               $sale_check = $this->db->where('is_filter',1)->where('tbl_col','sale_price')->get('list_fields')->row();
               }
            if($sale_check || (isset($is_listing) && $is_listing == 'shop_listing')){
                $is_fil = true;
                    ?>
                    <div class="row">
        <div class="col-md-6 pl-0">            
        <p class="margin_bottom_remove">Price range :</p>
        </div>
        <div class="col-md-6 pr-0">
        <div style="color:#000;" class="ranger">
              
              <span id="demo"><?= (isset($_GET['sale_price'])?$_GET['sale_price']:$max) ?></span>
        </div>
        </div>
        </div>
  <input type="range" min="1" max="<?= $max ?>" value="<?= (isset($_GET['sale_price'])?$_GET['sale_price']:$max) ?>" class="slider" id="myRange">
  
  

            <?php
            }
            else
            {
                ?>

            <?php
            }
            ?>
            <?php
  /*if(true)
  {
   ?>
   <button class="filter_btn" onclick="custom_filter('<?= $main ?>')">Filter Result</button>
   <?php   
  }*/
  ?>
            <div class="row">
        <?php
        $arr = array();
        if($cat_path)
        {
        $this->db->where_in('category',$cat_path);
        $this->db->order_by("filter_sort", "ASC");
$arr = $this->db->where('is_filter',1)->where('hide_filter',0)->get('list_fields')->result_array();
}
foreach($arr as $k=> $v)
{
    
    $this->load->view('filter_f',$v);
}
?>
</div>
<?php
if(isset($car_mod))
{
    $mod = $this->db->where('id',$car_mod)->get('modules')->row();
    if(isset($mod->filter_file) && trim($mod->filter_file))
    $this->load->view('front/filters/'.$mod->filter_file,array('type'=>'html'));
}
if($arr  || $is_fil || true)
{
    $main = isset($cat_path[0])?$cat_path[0]:0;
    ?>
    <div class="form-group pading_cls col-md-12">
    <button class="filter_btn" onclick="custom_filter('<?= $main ?>')">Filter Result</button>
    </div>
    <?php
}
        ?>
    </div>
    
        <h3 class="title-for-list side_bar_title" >
                    <span class="arrow search_cat search_cat_click all_category_set" style="display:none;" data-cat="0"
                        data-min="<?php echo floor($this->crud_model->get_range_lvl('product_id !=', '0', "min")); ?>"
                           data-max="<?php echo ceil($this->crud_model->get_range_lvl('product_id !=', '0', "max")); ?>"
                            data-brands="<?php echo $this->db->get_where('general_settings',array('type'=>'data_all_brands'))->row()->value; ?>"
                                data-vendors="<?php echo $this->db->get_where('general_settings',array('type'=>'data_all_vendors'))->row()->value; ?>"
                           >
                                    <i class="fa fa-angle-down"></i>
                    </span>
                    <a href="#" class="search_cat transform_t" style="color:#000;" data-cat="0"
                        data-min="<?php echo floor($this->crud_model->get_range_lvl('product_id !=', '0', "min")); ?>"
                           data-max="<?php echo ceil($this->crud_model->get_range_lvl('product_id !=', '0', "max")); ?>" >
                        <?php echo translate('all_listings');?>
                    </a>
                </h3>
    <div class="widget shop-categories sidebar_background">
        <div class="widget-content">

            <ul style="height:auto;overflow-y:auto;" class="listing_items_styling">

                <?php
                $all_category = '' ;
                if(true){

                    // $all_category = $this->db->get('category')->result_array();

                    // NIMRA HERE
                      $categories =json_decode($this->db->get_where('ui_settings',array('ui_settings_id' => 35))->row()->value, true);
                       $result=array();
                                            foreach($categories as $row){
                                                if($this->crud_model->if_publishable_category($row)){
                                                    $result[]=$row;
                                                }
                                            }
                    // var_dump($result);
                    // die();
                   $all_category =  $this->db->where_in('category_id',$result)->get('category')->result_array();

                    // NIMRA HERE

                }
                    foreach($all_category as $key => $row)
                    {
                        if(!$row['category_id'])
                        {
                            continue;
                        }
                        $open = false;
                        if(in_array($row['category_id'],$cat_path))
                        {
                            $open = true;
                        }
                ?>
                <li class="<?= ($open)?"active":""; ?>" cat_id="<?php echo $row['category_id']; ?>" >

                    <a href="<?= base_url('/directory'); ?>/<?= $row['slug'] ?>" for="cat_<?php echo $row['category_id']; ?>"><?php echo $row['category_name']; ?> <i  class="fa fa-angle-down angle_rightdown"></i></a>
                    <?php
                    if($open)
                    {
                        $sub_cats =  $this->db->where_in('pcat',$row['category_id'])->get('category')->result_array();
                        ?>
                        <ul>
                            <?php
                            foreach($sub_cats as $k=> $row1)
                            {
                                
                            }
                            foreach($sub_cats as $k=> $row1)
                            {
                                $open2 = false;
                        if(in_array($row1['category_id'],$cat_path))
                        {
                            $open2 = true;
                        }
                                ?>
                            <li class="<?= ($open2)?"active":""; ?>">
                                <a href="<?= base_url('/directory'); ?>/<?= $row1['slug'] ?>" for="cat_<?php echo $row1['category_id']; ?>"><?php echo  $row1['category_name']; ?> <i  class="fa fa-angle-down angle_rightdown"></i></a>
                                <?php
                                if($open2)
                                {
                                    $sub_cats1 =  $this->db->where_in('pcat',$row1['category_id'])->get('category')->result_array();
                                    foreach($sub_cats1 as $k=> $row2)
                                    {
                                               $open3 = false;
                                                if(in_array($row2['category_id'],$cat_path))
                                                {
                                                    $open3 = true;
                                                }
                                                
                                ?>
                            <li class="<?= ($open3)?"active":""; ?>">
                                <a href="<?= base_url('/directory'); ?>/<?= $row2['slug'] ?>" for="cat_<?php echo $row2['category_id']; ?>"><?php echo  $row2['category_name']; ?> <i  class="fa fa-angle-down angle_rightdown"></i></a>
                                <?php
                                    
                                        
                                    }
                                }
                                ?>
                            </li>
                            <?php
                            }
                            ?>
                        </ul>
                        
                        <?php
                    }
                    ?>
                    <!--<i  class="fa fa-angle-down angle_rightdown"></i>-->
                    <div class="cat_result" id="cat_r<?php echo $row['category_id']; ?>"></div>


                </li>
                <?php
                    }
                ?>
            </ul>
        </div>
    </div>
    <!-- /widget shop categories -->

    <br>
    <div class="row hidden-sm hidden-xs">
    <?php
        //echo $this->html_÷model->widget('special_products');
    ?>
    </div>

    <?php
    if(!$cat_path)
    {
        $cat_path = array('0');
    }

     $all_amenity = $this->db->where('status', 1)->where_in('catid',$cat_path)->get('amenity')->result_array();
    ?>
    <?php
    if(!empty($all_amenity)){
    ?>
    <div class="amenities_title_side">
        <h3 class="transform_t">Amenities</h3>
    </div>
    <div class="Amenities side_bar_amenities">

        <ul>
            <?php
            foreach($all_amenity as $k=> $v)
            {
                ?>
                <li class="<?= (isset($_GET['amenity']) && $_GET['amenity']== $v['name'])?"active":""; ?>" ><a onclick="set_value('amenity','<?= $v['name']; ?>')"><label style="color:#000;"><?= $v['name']; ?></label></a></li>
                <?php
            }
            ?>
            <!--<li><label><input type="checkbox" /> Maintenance Staff</label></li>-->
            <!--<li><label><input type="checkbox" /> Security Staff</label></li>-->
            <!--<li><label><input type="checkbox" /> Cleaning</label></li>-->
            <!--<li><label><input type="checkbox" /> Internet Connection</label></li>-->
            <!--<li><label><input type="checkbox" /> Amenities</label></li>-->
            <!--<li><label><input type="checkbox" /> Maintenance Staff</label></li>-->
            <!--<li><label><input type="checkbox" /> Security Staff</label></li>-->
            <!--<li><label><input type="checkbox" /> Cleaning</label></li>-->
            <!--<li><label><input type="checkbox" /> Internet Connection</label></li>-->

        </ul>
    </div>
    <?php
    }
    ?>

</aside>
