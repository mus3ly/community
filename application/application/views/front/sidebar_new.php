<style>
    input[type="range"]::-webkit-slider-thumb {
  -webkit-appearance: none;
  height: 20px;
  width: 20px;
  border-radius: 50%;
  background: #ff4500;
  box-shadow: 0 0 2px 0 #555;
  transition: background .3s ease-in-out;
}
.slider{
    height: 5px;
}

    .custom-slider .ui-slider-range {
      background: #FF5733; /* Change the range color */
    }
    
    .custom-slider .ui-slider-handle {
      background: #FF5733; /* Change the handle color */
      border: 2px solid #E61E00; /* Change the handle border color */
      width: 20px; /* Change the handle width */
      height: 20px; /* Change the handle height */
    }
    
    .custom-slider .ui-slider-handle:hover {
      background: #E61E00; /* Change the handle color on hover */
    }
    
    .ads-listing .form-group {
    margin: 0px!important;
}
    
</style>
            <div class="sidebar mb-4">
              <div id="filter-wrapper" > 
                <form action="#" method="">
                  <div class="form-group">
                    <div class="range-slider-one clearfix">
                      <h4>Distance Range</h4>
                      <div class="area-range-slider"></div>
                      <div class="input"><input type="text" class="property-amount" name="price" readonly></div>
                    </div>
                  </div>
                  <?php
                  if(true)
                  {
                      $max_dist = 500;
                      ?>
                  <div class="form-group">
                    <div class="range-slider-one clearfix">
                        <p>Distance slider:</p>
  <input type="range" class="slider rounded" min="1" style="background-color:var(--primary-color);"
  max="<?= $max_dist ?>"
  step="1" value="<?= (isset($_GET['sale_price']) && $_GET['dis_range'])?$_GET['dis_range']:$max_dist ?>"  oninput="ch_dist()" id="mydRange">
  <div class="row">
      <div class="col-md-6" id="min_price" style="text-align:left">1</div>
      <div class="col-md-6" id="dis_price" style="text-align:right"><?= (isset($_GET['sale_price']) && $_GET['dis_range'])?$_GET['dis_range']:$max_dist ?></div>
  </div>
                    </div>
                  </div>
                  <?php
                  }
                  ?>
                  <?php
                  if(isset($max_price) && $max_price)
                  {
                    //   var_dump($max_price);
                      ?>
                  <div class="form-group">
                    <div class="range-slider-one clearfix">
                        <p>Custom range slider:</p>
  <input type="range" class="slider rounded" min="1" style="background-color:var(--primary-color);"
  max="<?= $max_price ?>"
  step="1" value="<?= (isset($_GET['sale_price']) && $_GET['sale_price'])?$_GET['sale_price']:$max_price ?>"  oninput="ch_price()" id="myRange">
  <div class="row">
      <div class="col-md-6" id="min_price" style="text-align:left">1</div>
      <div class="col-md-6" id="max_price" style="text-align:right"><?= (isset($_GET['sale_price']) && $_GET['sale_price'] > 0 )?$_GET['sale_price']:$max_price; ?></div>
  </div>
                    </div>
                  </div>
                  <?php
                  }
                  ?>
                  
                  <div class="row">
                      <div class="form-group">
                        <div class="range-slider-one clearfix">
                            <p><b>Price Range:</b><span class="float-end text-right"><input type="text" name="amount" class="amount" id="inputId" readonly style="border:0; color:#f6931f; font-weight:bold; max-width: 5rem; text-align: right;"></span></p>
                        <div class="custom-slider slider-range" data-min="1" data-max="<?= $max_dist ?>"  data-id="inputId" data-default-min="1" data-default-max="<?= (isset($_GET['sale_price']) && $_GET['dis_range'])?$_GET['dis_range']:$max_dist ?>"></div>
                        
                        </div>
                    </div>

                  </div>
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
    if($v['tbl_col'] != 'sale_price')
    {
    $this->load->view('filter_f',$v);
    }
}
?>
                  <div class="form-group">
                    <button type="button" onclick="submit_dform()" class="btn filter-btn">Apply Filter</button>
                  </div>
                </form>
              </div>
              <div class="listing-list sidebar-widget">
                <h4>All Listing</h4>
                <div class="accordion accordion-flush main-list-accr" id="accordionOne">
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
                        if($open)
                        {
                            $sub_cats =  $this->db->where_in('pcat',$row['category_id'])->get('category')->result_array();
                            ?>
                            <div class="accordion-item">
                    <h2 class="accordion-header" id="item1">
                      <button class="accordion-button accordion-button-sidebar collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#item-accr1" aria-expanded="true" aria-controls="item-accr1" style="color:white; background-color:var(--primary-color);">
                        <a class="text-white" href="<?= base_url('/directory'); ?>/<?= $row['slug'] ?>"><?php echo $row['category_name']; ?></a>
                      </button>
                    </h2>
                    <div id="item-accr1" class="accordion-collapse collapse" aria-labelledby="item1"
                      data-bs-parent="#accordionOne">
                      <div class="accordion-body">
                        <ul>
                            <?php
                            $sub_cats =  $this->db->where_in('pcat',$row['category_id'])->get('category')->result_array();
                            foreach($sub_cats as $k=> $row1)
                            {
                                       $open2 = false;
                                        if(in_array($row1['category_id'],$cat_path))
                                        {
                                            $open2 = true;
                                        }
                                        if($open2)
                                    {
                                        ?>
                                        <li>
                            <div class="accordion accordion-flush sub-sub-accordion" id="sub-list-accordion-1">
                              <div  class="accordion-item">
                                <h2 class="accordion-header" id="sub-list-1-heading">
                                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSub-1" aria-expanded="true" aria-controls="flush-collapseSub-1">
                                    <?php echo $row1['category_name']; ?>
                                  </button>
                                </h2>
                                <div id="flush-collapseSub-1" class="accordion-collapse" aria-labelledby="sub-list-1-heading" data-bs-parent="#sub-list-accordion-1">
                                  <div class="accordion-body">
                                    <ul>
                                      <?php
                            $sub_cats =  $this->db->where_in('pcat',$row1['category_id'])->get('category')->result_array();
                            foreach($sub_cats as $k=> $row2)
                            {
                                       $open2 = false;
                                        if(in_array($row2['category_id'],$cat_path))
                                        {
                                            $open2 = true;
                                        }
                                        if($open2)
                                    {
                                        ?>
                                        <li>
                            <div class="accordion accordion-flush sub-sub-accordion" id="sub-list-accordion-1">
                              <div  class="accordion-item">
                                <h2 class="accordion-header" id="sub-list-1-heading">
                                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSub-1" aria-expanded="true" aria-controls="flush-collapseSub-1">
                                    <?php echo $row2['category_name']; ?>
                                  </button>
                                </h2>
                                <div id="flush-collapseSub-1" class="accordion-collapse" aria-labelledby="sub-list-1-heading" data-bs-parent="#sub-list-accordion-1">
                                  <div class="accordion-body">
                                    <ul>
                                      <?php
                            $sub_cats =  $this->db->where_in('pcat',$row2['category_id'])->get('category')->result_array();
                            foreach($sub_cats as $k=> $row3)
                            {
                                       $open2 = false;
                                        if(in_array($row3['category_id'],$cat_path))
                                        {
                                            $open2 = true;
                                        }
                                        if($open2)
                                    {
                                        ?>
                                        <li>
                            <div class="accordion accordion-flush sub-sub-accordion" id="sub-list-accordion-1">
                              <div  class="accordion-item">
                                <h2 class="accordion-header" id="sub-list-1-heading">
                                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSub-1" aria-expanded="true" aria-controls="flush-collapseSub-1">
                                    <?php echo $row3['category_name']; ?>
                                  </button>
                                </h2>
                                <div id="flush-collapseSub-1" class="accordion-collapse" aria-labelledby="sub-list-1-heading" data-bs-parent="#sub-list-accordion-1">
                                  <div class="accordion-body">
                                    <ul>
                                      <li><a href="#">Sub List</a></li>
                                      <li><a href="#">Sub List</a></li>
                                    </ul>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </li>
                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                        <li  onclick="ch_url('<?= $row3['slug'] ?>')" ><a href="#"><?php echo $row3['category_name']; ?></a></li>
                                        <?php
                                    }
                        
                            
                                ?>
                                
                                <?php
                            }
                            ?>
                                    </ul>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </li>
                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                        <li  onclick="ch_url('<?= $row2['slug'] ?>')" ><a href="#"><?php echo $row2['category_name']; ?></a></li>
                                        <?php
                                    }
                        
                            
                                ?>
                                
                                <?php
                            }
                            ?>
                                    </ul>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </li>
                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                        <li  onclick="ch_url('<?= $row1['slug'] ?>')" ><a href="#"><?php echo $row1['category_name']; ?></a></li>
                                        <?php
                                    }
                        
                            
                                ?>
                                
                                <?php
                            }
                            ?>
                          
                          
                        </ul>
                      </div>
                    </div>
                  </div>
                            <?php
                        }
                        else
                        {
                            ?>
                            <div onclick="ch_url('<?= $row['slug'] ?>')" class="accordion-item no-sublist">
                    <h2 class="accordion-header" id="item6">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#item-accr6" aria-expanded="false" aria-controls="item-accr6">
                        <a href="<?= base_url('/directory'); ?>/<?= $row['slug'] ?>"><?php echo $row['category_name']; ?></a>
                      </button>
                    </h2>
                  </div>
                            <?php
                        }
                ?>
                  
                  <?php
                    }
                  ?>
                </div>
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
    <div class="sidebar-widget">
        <h4>AMENITIES</h4>
        <div class="scroll-list">
          <ul>
            <?php
            foreach($all_amenity as $k=> $v)
            {
                ?>
                <li class="<?= (isset($_GET['amenity']) && $_GET['amenity']== $v['name'])?"active":""; ?>" ><a onclick="set_value('amenity','<?= $v['name']; ?>')"><label style="color:#000;"><?= $v['name']; ?></label></a></li>
                <?php
            }
            ?>
          </ul>
        </div>
      </div>
    <?php
    }
    ?>
    </div>

                  </div>