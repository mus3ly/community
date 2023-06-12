<style>
    #sidebar ul li a{
        color:#000;
    }
    .sidebar_background{
       background: #fff;
    box-shadow: 0px 0px 10px #ddd;
    padding: 0 15px;
    line-height: 1;
}
.listing_items_styling > li{
    font-size:15px;
    font-weight:300;
    padding: 5px 0;
}
.listing_items_styling > li:hover{
        border-bottom: 1px solid #ddd;
        scale:1;


}
#add_height_in h1{
        width: 100%;
    color: #f26122;
    font-size: 18px;
    text-transform: capitalize;
    font-weight: 500 !important;
    margin-bottom: 5px;
}
.add_height_in h4{
    margin-bottom:5px;
}
.search_cat{
    color:#fff !important;
}

.side_bar_title,.amenities_title_side{
            color: #fff;
    padding: 10px;
    background: #f26122;
    border-radius: 10px 10px 0 0;

}
.side_bar_amenities{
            overflow: auto;
    background: #fff;
    box-shadow: 0px 0px 10px #ddd;
    padding: 15px;
    HEIGHT: 400px;
    line-height: 1.5;
}
.side_bar_amenities ul li label{
        font-size: 14px;
    font-weight: 300;

}
.side_bar_amenities ul li{
    display:flex;
    gap:10px;
    width:100%;
    align-items:center;
}
.itemimg{
       height: 100% !important;
    overflow: hidden;
    min-height:100%;

}
.logo_withname img{
      width: 100%;
    height: 100%;
    object-fit: contain;
}
.logo_withname{
    height:100%;
    border: none;
    position:relative;
}
#row-hight{

}

</style>
<aside class="col-md-12 sidebar new_sidebar" id="sidebar">
    <!-- widget shop categories -->
    <!-- widget price filter -->
               <?php
            /*if(isset($is_listing) && ($is_listing == 'shop_listing' || $is_listing == 'car_listing')){
                    ?>
            <div class="widget widget-filter-price">
                <div class="Amenities1">
                    <div class="left_filter to_left_f">
                     <h3>Filter Your Search</h3>
                </div>

                 <div class="push_left">
           <!-- <span class="btn btn-theme-transparent pull-left hidden-lg hidden-md" onClick="open_sidebar();">
                <i class="fa fa-bars"></i>
            </span>-->
            <a class="btn-theme-light make_it_flexi" onClick="set_view('grid')" href="#"><img src="<?php echo base_url(); ?>/white_grid.png" alt=""/></a>
            <a class="btn btn-theme-light make_it_flexi" onClick="set_view('list')" href="#"><img src="<?php echo base_url(); ?>/white_icon.png" alt=""/></a>
        </div>
                </div>
                <div class="range_slider new_rang">
                    <div class="row">
                        <div class="col-sm-12">
                          <div id="slider-range"></div>
                        </div>
                    </div>
                    <div class="row slider-labels">
                        <div class="col-xs-6 p-0 caption">
                          <strong>Min:</strong> <span id="slider-range-value1"></span>
                        </div>
                        <div class="col-xs-6 p-0 text-right caption">
                          <strong>Max:</strong> <span id="slider-range-value2"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                        </div>
                    </div>
                </div>
            </div>

            <?php
            }
            else
            {
                ?>

            <?php
            }
            ?>
    <?php
            if(isset($is_listing) && $is_listing == 'car_listing'){
                $all_makes =  $this->db->get('makes')->result_array();

                    ?>
                    <select name="select_make" onchange="do_product_search('0')" id="select_make" class="form-control">
                        <option value="0">Make</option>
                        <?php
                        foreach($all_makes as $k => $v){
                        ?>
                        <option value="<?= $v['id']?>"><?= $v['name']?></option>
                        <?php
                        }
                        ?>
                    </select>
                    <div class="from_group">
                        <!--<label>Model from</label>-->
                        <input id="modelf_input" class="form-control"  onchange="do_product_search('0')" type="text" placeholder="Model From" />
                    </div>
                    <div class="from_group1">
                        <!--<label>Model to</label>-->
                        <input id="modelt_input" class="form-control" onchange="do_product_search('0')" type="text" placeholder="Model To" />
                    </div>
                    <div class="from_group1">
                        <!--<label>No of seats</label>-->
                    <input type="number" id="seats_input" onkeyup="do_product_search('0')" placeholder="No: of Seats" name="seats"  class="form-control">
                    </div>
                    <?php
                }
                ?>
                <?php
            if(isset($is_listing) && $is_listing == 'property_listing'){
                    ?>


                    <input type="number" placeholder="No: of Bedrooms" onkeyup="do_product_search('0')" id="bedrooms_input"  class="margin_added form-control">
                       <select name="select_property_type" onchange="do_product_search('0')" id="select_property_type" class="margin_added form-control">
                       <option value="" >Type</option>
                        <option value="detached">Detached </option>
                        <option value="apartment ">Apartment </option>
                        <option value="house">House</option>
                        <option value="rent">Rent</option>
                        <option value="sale">Sale</option>
                        <option value="furnished">Furnished</option>
                        <option value="unfurnished">Unfurnished</option>

                    </select>
                    <?php
                }
                ?>
                <?php
            if(isset($is_listing) && $is_listing == 'jobs_listing'){
                    ?>


                        <select name="select_job_hours" onchange="do_product_search('0')"  id="select_job_hours" class="margin_added form-control">
                                <option value="">select job hours</option>
                                <option value="fulltime">Full Time</option>
                                <option value="parttime ">Part Time</option>
                                <option value="rotation ">Rotation</option>
                                <option value="two_years ">Two Years</option>

                            </select>
                      <select name="select_job_type" onchange="do_product_search('0')"  id="select_job_type" class="margin_added form-control">
                                    <option value="">select job type</option>
                                    <option value="paermanent">Permanent</option>
                                    <option value="temporary">Temporary</option>
                                    <option value="contract">Contract</option>
                                    <option value="volunteer">Volunteer</option>
                                    <option value="apprenticeship ">Apprenticeship</option>
                                    <option value="internship ">Internship</option>

                                </select>
                    <?php
                }
                ?>       <?php
            if(isset($is_listing) && $is_listing == 'event_listing'){
                    ?>

                        <input type="date" id="event_date_input" onchange="do_product_search('0')" class="add_padding form-control">
                        <select id="event_type_input"class="form-control add_padding" onchange=" do_product_search('0')">
                            <option value="">Event type</option>
                            <option value="wedding">Wedding</option>
                            <option value="festival">Festival</option>
                            <option value="concert">Concert</option>
                            <option value="party">Party</option>
                            <option value="get_to_gether">Get To Gether</option>
                            <option value="music">Music</option>
                        </select>
                       <select id="age_restriction_input" class="form-control add_padding" onchange=" do_product_search('0')">
                                   <option value="">Age Restrictions</option>
                                    <option value="family">Family Friendly</option>
                                    <option value="kids">Kids Friendly</option>
                                    <option value="18+">18+</option>
                                    <option value="12+">12+</option>
                                    <option value="all_ages">All Ages</option>

                                </select>

                    <?php
                }*/
                ?>
    <!-- /widget price filter -->
    <span class="btn btn-theme-transparent pull-left hidden-lg hidden-md" onClick="close_sidebar();" style="border-radius:50%; position: absolute; top:0;right:10px;color:white;">
        <i class="fa fa-times"></i>
    </span>
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
                if(isset($is_listing) && $is_listing == 'shop_listing'){
                        $all_category =json_decode($this->db->get_where('ui_settings',array('ui_settings_id' => 87))->row()->value,true);

                        foreach($all_category as $k=> $v)
                        {
                            $sing = $this->db->where('category_id',$v)->get('category')->row_array();
                            $all_category[$k] = $sing;
                        }
                        $result=array();

                   }
                else{

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
    $id = '0';
      if(isset($_GET['is_listing']) && $_GET['is_listing'] == 'car_listing'){
      $id = '807';
      }
      if(isset($_GET['is_listing']) && $_GET['is_listing'] == 'property_listing'){
          $id = '808';
      }
      if(isset($_GET['is_listing']) && $_GET['is_listing'] == 'event_listing'){
           $id = '917';
      }
      if(isset($_GET['is_listing']) && $_GET['is_listing'] == 'jobs_listing'){
           $id = '78';
      }

     $all_amenity = $this->db->where('status', 1)->where('catid',$id)->get('amenity')->result_array();
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
                <li><a href="#"><label style="color:#000;"><?= $v['name']; ?></label></a></li>
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

<input type="hidden" id="univ_max" value="<?php echo $this->crud_model->get_range_lvl('product_id !=', '', "max"); ?>">
<input type="hidden" id="cur_cat" value="0">
<?php include 'search_script.php'; ?>
