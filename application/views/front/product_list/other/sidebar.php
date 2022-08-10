
<aside class="col-md-3 sidebar" id="sidebar">
    <!-- widget shop categories -->
    <span class="btn btn-theme-transparent pull-left hidden-lg hidden-md" onClick="close_sidebar();" style="border-radius:50%; position: absolute; top:5px;">
        <i class="fa fa-times"></i>
    </span>
    <div class="widget shop-categories">
        <div class="widget-content">
            <ul>   
                <li class="title-for-list">
                    <span class="arrow search_cat search_cat_click all_category_set" style="display:none;" data-cat="0" 
                        data-min="<?php echo floor($this->crud_model->get_range_lvl('product_id !=', '0', "min")); ?>" 
                           data-max="<?php echo ceil($this->crud_model->get_range_lvl('product_id !=', '0', "max")); ?>" 
                            data-brands="<?php echo $this->db->get_where('general_settings',array('type'=>'data_all_brands'))->row()->value; ?>"
                                data-vendors="<?php echo $this->db->get_where('general_settings',array('type'=>'data_all_vendors'))->row()->value; ?>"
                           >
                                    <i class="fa fa-angle-down"></i>
                    </span>
                    <a href="#" class="search_cat" data-cat="0"
                        data-min="<?php echo floor($this->crud_model->get_range_lvl('product_id !=', '0', "min")); ?>" 
                           data-max="<?php echo ceil($this->crud_model->get_range_lvl('product_id !=', '0', "max")); ?>" >
                        <?php echo translate('all_products');?>
                    </a>
                </li>                                                 
                <?php
                    $all_category = $this->db->get('category')->result_array();
                    foreach($all_category as $row)
                    {
						if($this->crud_model->if_publishable_category($row['category_id']) && get_cat_level($row['category_id']) == 1){
                ?>
                <li onclick="load_sub(<?= $row['category_id'] ?>)">
                    <span class="arrow search_cat search_cat_click" data-cat="<?php echo $row['category_id']; ?>" 
                        data-min="<?php echo floor($this->crud_model->get_range_lvl('category', $row['category_id'], "min")); ?>" 
                           data-max="<?php echo ceil($this->crud_model->get_range_lvl('category', $row['category_id'], "max")); ?>" 
                            data-brands="<?php echo $row['data_brands']; ?>"
                                data-vendors="<?php echo $row['data_vendors']; ?>"
                           >
                                    <i id="icon_<?= $row['category_id'] ?>" class="fa fa-angle-up"></i>
                    </span>
                    <a href="#" class="search_cat" data-cat="<?php echo $row['category_id']; ?>"
                        data-min="<?php echo floor($this->crud_model->get_range_lvl('category', $row['category_id'], "min")); ?>" 
                            data-max="<?php echo ceil($this->crud_model->get_range_lvl('category', $row['category_id'], "max")); ?>" >
                        <?php echo $row['category_name']; ?>
                    </a>
                    
                </li>
                <div class="children" id="child_<?= $row['category_id'] ?>">
                        
                        </div>
                <?php  
						}
                    }
                ?>
            </ul>
        </div>
    </div>
    <!-- /widget shop categories -->
    <!-- widget price filter -->
    <div class="widget widget-filter-price">
        <h4 class="widget-title">
            <?php echo translate('price');?>
        </h4>
        <div class="widget-content">
            <div id="slider-range"></div>
            <input type="text" id="amount" style="width:100%;text-align:center;" disabled />
        </div>
    </div>
    <!-- /widget price filter -->
    <br>
    <div class="row hidden-sm hidden-xs">
    <?php
		//echo $this->html_÷model->widget('special_products');
	?>
    </div>
</aside>

<input type="hidden" id="univ_max" value="<?php echo $this->crud_model->get_range_lvl('product_id !=', '', "max"); ?>">
<input type="hidden" id="cur_cat" value="0">
<?php include 'search_script.php'; ?>
