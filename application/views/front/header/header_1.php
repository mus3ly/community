
<!-- Header top bar -->



<!-- /Header top bar -->



<!-- HEADER -->

<header class="header header-logo-left">

    <div class="header-wrapper">

        <div class="container">

            <div class="flex-row">

                

                <div class="col-sm-2 left_logo">
                    <div class="logo">

                        <?php

                            $home_top_logo = $this->db->get_where('ui_settings',array('type' => 'home_top_logo'))->row()->value;

                        ?>

                        <a href="<?= base_url() ?>">

                            <img src="<?php echo base_url(); ?>uploads/logo_image/logo_<?php echo $home_top_logo; ?>.png" alt="SuperShop"/>

                        </a>

                    </div>
                    

                </div>
                
                <div class="col-sm-6">
                    <div class="navbar-toggle" data-toggle="collapse" data-target="#navbar-menu">

                                <i class="fa fa-bars"></i>

                              </div>
                    <div class="collapse navbar-collapse" id="navbar-menu">
                        <div class="col-lg-12 col-md-12 col-sm-12 menu_bar">

                            <nav class="navbar_items">

                              
                              <?php
                              if($this->session->userdata('user_login') == "yes")
                              {
                                  ?>
                                  <ul class="nav navbar-nav-items">

                                    <li ><a href="<?= base_url('/directory/') ?>">Directory </a></li>
                                    <li><a href="#">CHL</a></li>
                                    <li class="dropdown currency ">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                        Account<i class="fa fa-angle-down"></i>
                                        </a>
                                        <ul role="menu" class="dropdown-menu">
                                            <li><a href="#">Dashboard</a></li>
                                            <li><a href="#">My Business </a></li>
                                            <li class="">
                                                <a href="<?= base_url('profile'); ?>">My Orders 
                                                </a>
                                            </li>
                                            <li><a href="#">My Blog </a></li>
                                            <li><a href="#">My Affiliate </a></li>
                                            <li><a href="#">My Favourites</a></li>
                                            <li class="">
                                                <a href="<?= base_url('profile'); ?>">My Account 
                                                </a>
                                            </li>
                                            
                                            <li class="">
                                                <a href="#">Support 
                                                </a>
                                            </li>
                                            <li class="">
                                                <a href="<?= base_url('/login_set/registration'); ?>">Sign Up 
                                                </a>
                                            </li>
                                            <li class="">
                                                <a href="<?= base_url('/login_set/login'); ?>">Sign-in 
                                                </a>
                                            </li>
                                        </ul>
                                        
                                    </li>
                                    <li><a href="https://hypeplug.paris/">FAQ</a></li>
                                    
                                        <!--<div class="drop1down">

                                      <a class="drop1btn">Sneaker Resources<i class="fa fa-angle-down" aria-hidden="true"></i></a>

                                      <div class="drop1down-content">

                                        <a href="#">Retail Sneaker Raffles</a>

                                        <a href="#">*HypePlug Membership*</a>

                                        <div class="drop1down1">

                                          <a class="drop1btn1">Nike Shoe Size Conversion<i class="fa fa-angle-right" aria-hidden="true"></i></a>

                                          <div class="drop1down1-content">

                                            <a href="#">Nike Men’s Shoe Size Chart</a>

                                            <a href="#">Nike Women’s Shoe Size Chart</a>

                                            

                                          </div>

                                        </div>

                                        <div class="drop1down11">

                                          <a class="drop1btn11">Adidas Shoe Size Conversion<i class="fa fa-angle-right" aria-hidden="true"></i></a>

                                          <div class="drop1down11-content">

                                            <a href="#">Adidas Men’s Shoe Size Chart</a>

                                            <a href="#">Adidas Women’s Shoe Size Chart</a>

                                            

                                          </div>

                                        </div>

                                        

                                      </div>

                                    </div>-->

                                

                                  
                                    

                                </ul>
                                  <?php
                              }
                              else
                              {
                                  ?>
                                  <ul class="nav navbar-nav-items">
                                    <li ><a href="<?= base_url('sneaker/') ?>">Directory </a></li>
                                    <li><a href="https://hypeplug.paris/">CHL</a></li>
                                    <li class="dropdown currency ">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                        Account<i class="fa fa-angle-down"></i>
                                        </a>
                                        <ul role="menu" class="dropdown-menu">
                                            <li><a href="#">Dashboard</a></li>
                                            <li><a href="#">My Business </a></li>
                                            <li class="">
                                                <a href="<?= base_url('profile'); ?>">My Orders 
                                                </a>
                                            </li>
                                            <li><a href="#">My Blog </a></li>
                                            <li><a href="#">My Affiliate </a></li>
                                            <li><a href="#">My Favourites</a></li>
                                            <li class="">
                                                <a href="<?= base_url('profile'); ?>">My Account 
                                                </a>
                                            </li>
                                            
                                            <li class="">
                                                <a href="#">Support 
                                                </a>
                                            </li>
                                            <li class="">
                                                <a href="<?= base_url('/login_set/registration'); ?>">Sign Up 
                                                </a>
                                            </li>
                                            <li class="">
                                                <a href="<?= base_url('/login_set/login'); ?>">Sign-in 
                                                </a>
                                            </li>
                                        </ul>
                                        
                                    </li>
                                    <li><a href="https://hypeplug.paris/">FAQ</a></li>
                                    
                                        <!--<div class="drop1down">

                                      <a class="drop1btn">Sneaker Resources<i class="fa fa-angle-down" aria-hidden="true"></i></a>

                                      <div class="drop1down-content">

                                        <a href="#">Retail Sneaker Raffles</a>

                                        <a href="#">*HypePlug Membership*</a>

                                        <div class="drop1down1">

                                          <a class="drop1btn1">Nike Shoe Size Conversion<i class="fa fa-angle-right" aria-hidden="true"></i></a>

                                          <div class="drop1down1-content">

                                            <a href="#">Nike Men’s Shoe Size Chart</a>

                                            <a href="#">Nike Women’s Shoe Size Chart</a>

                                            

                                          </div>

                                        </div>

                                        <div class="drop1down11">

                                          <a class="drop1btn11">Adidas Shoe Size Conversion<i class="fa fa-angle-right" aria-hidden="true"></i></a>

                                          <div class="drop1down11-content">

                                            <a href="#">Adidas Men’s Shoe Size Chart</a>

                                            <a href="#">Adidas Women’s Shoe Size Chart</a>

                                            

                                          </div>

                                        </div>

                                        

                                      </div>

                                    </div>-->

                                

                                  
                                    

                                </ul>
                                  <?php
                              }
                              ?>
                                
                            </nav>

                        </div>
                      </div>
                </div>

                <div class="col-sm-4 add_listing">
                    <ul>
                        <!-- <li>
                            <div class="cart-wrapper">
                                            
                                            <a href="#" class="btn btn-theme-transparent" data-toggle="modal" data-target="#popup-cart">

                                                
                                                <span class="hidden-xs"> 

                                                    <span class="cart_num"></span> 

                                                    <?php echo translate('item(s)'); ?>

                                                

                                                </span>  

                                                <i class="fa fa-angle-down"></i>

                                            </a>


                                            <a href="#" class="menu-toggle btn btn-theme-transparent"></a>


                                        </div>
                        </li> -->
                        <li>
                            <a href="#" class="add_listing_btn">Add Listing <i class="fa fa-plus"></i></a>
                        </li>
                        <li>
                            <a href="#" class="user_info"> <i class="fa fa-user"></i></a>
                        </li>

                    </ul>
                </div>
               <!-- <div class="flex-col-6 flex-col-lg-auto text-right">

                     <!--Header shopping cart 

                    <div class="header-cart">

                        <div class="cart-wrapper">

                            <a href="<?php echo base_url(); ?>home/compare" class="btn btn-theme-transparent" id="compare_tooltip" data-toggle="tooltip" data-original-title="<?php echo $this->crud_model->compared_num(); ?>" data-placement="right" >

                                <i class="fa fa-exchange"></i>

                                <span class="hidden-md hidden-sm hidden-xs"><?php echo translate('compare'); ?></span>

                                (

                                <span id="compare_num">

                                    <?php echo $this->crud_model->compared_num(); ?>

                                </span>

                                )

                            </a>

                            <a href="#" class="btn btn-theme-transparent" data-toggle="modal" data-target="#popup-cart">

                                <i class="fa fa-shopping-cart"></i> 

                                <span class="hidden-xs"> 

                                    <span class="cart_num"></span> 

                                    <?php echo translate('item(s)'); ?>

                                

                                </span>  

                                <i class="fa fa-angle-down"></i>

                            </a>

                            <!-- Mobile menu toggle button 

                            <a href="#" class="menu-toggle btn btn-theme-transparent"><i class="fa fa-bars"></i></a>

                            <!-- /Mobile menu toggle button 

                        </div>

                    </div>

                    <!-- Header shopping cart

                </div>
                -->
            </div>

        </div>

    </div>

    <!--<div class="navigation-wrapper">

        <div class="container">

            <?php

            	$others_list=$this->uri->segment(3);

			?>

            <nav class="navigation closed clearfix">

                <a href="#" class="menu-toggle-close btn"><i class="fa fa-times"></i></a>

                <ul class="nav sf-menu">

                    <?php if($this->db->get_where('ui_settings',array('type'=>'header_homepage_status'))->row()->value == 'yes'){?>

                    <li <?php if($asset_page=='home'){ ?>class="active"<?php } ?>>

                        <a href="<?php echo base_url(); ?>home">

                            <?php echo translate('homepage');?>

                        </a>

                    </li>

                    <?php } if($this->db->get_where('ui_settings',array('type'=>'header_all_categories_status'))->row()->value == 'yes'){?>

                    <li class="hidden-sm hidden-xs <?php if($asset_page=='all_category'){ echo 'active'; } ?>">

                        <a href="<?php echo base_url(); ?>home/all_category">

							<?php echo translate('all_categories');?>

                        </a>

                        <ul>

                        	<?php

								$all_category = $this->db->get('category')->result_array();

								foreach($all_category as $row)

								{

									if($this->crud_model->if_publishable_category($row['category_id'])){

							?>

                            <li>

                                <a href="<?php echo base_url(); ?>home/category/<?php echo $row['category_id']; ?>">

                                    <?php echo $row['category_name']; ?>

                                </a>

                            </li>

                            <?php

									}

								}

							?>

                        </ul>

                    </li>

                    <?php } ?>

                    <li class="hidden-lg hidden-md <?php if($asset_page=='all_category'){ echo 'active'; } ?>">

                        <a href="#">

							<?php echo translate('all_categories');?>

                        </a>

                        <ul>

                        	<?php

								$all_category = $this->db->get('category')->result_array();

								foreach($all_category as $row)

								{

									if($this->crud_model->if_publishable_category($row['category_id'])){

							?>

                            <li>

                                <a href="<?php echo base_url(); ?>home/category/<?php echo $row['category_id']; ?>">

                                    <?php echo $row['category_name']; ?>

                                </a>

                            </li>

                            <?php

									}

								}

							?>

                        </ul>

                    </li>

                    <li class="hidden-lg hidden-md <?php if($asset_page=='all_category'){ echo 'active'; } ?>">

                        <a href="<?php echo base_url(); ?>home/all_category">

                            <?php echo translate('all_sub_categories');?>

                        </a>

                    </li>

                    <?php if($this->db->get_where('ui_settings',array('type'=>'header_featured_products_status'))->row()->value == 'yes'){?>

                    <li class="<?php if($others_list=='featured'){ echo 'active'; } ?>">

                        <a href="<?php echo base_url(); ?>home/others_product/featured">

                            <?php echo translate('featured_products');?>

                        </a>

                    </li>

                    <?php } if($this->db->get_where('ui_settings',array('type'=>'header_todays_deal_status'))->row()->value == 'yes'){?>

                    <li class="<?php if($others_list=='todays_deal'){ echo 'active'; } ?>">

                        <a href="<?php echo base_url(); ?>home/others_product/todays_deal">

                            <?php echo translate('todays_deal');?>

                        </a>

                    </li>

                    <?php }?>

                    <?php if($this->crud_model->get_type_name_by_id('general_settings','82','value') == 'ok'){

                            if($this->db->get_where('ui_settings',array('type'=>'header_bundled_product_status'))->row()->value == 'yes'){ ?>

                    <li <?php if($page_name=='bundled_product'){ ?>class="active"<?php } ?>>

                        <a href="<?php echo base_url(); ?>home/bundled_product">

                            <?php echo translate('bundled_product');?>

                        </a>

                    </li>

                     <?php } }?>

                    <?php if(0){

                            if(1){ ?>

                    <li <?php if($page_name=='customer_product_bulk_upload'){ ?>class="active"<?php } ?>>

                        <a href="<?php echo base_url(); ?>home/customer_product_bulk_upload">

                            <?php echo translate('Bulk upload');?>

                        </a>

                    </li>

                    <?php }} if($this->crud_model->get_type_name_by_id('general_settings','83','value') == 'ok'){

                                if($this->db->get_where('ui_settings',array('type'=>'header_classifieds_status'))->row()->value == 'yes'){?>

                    <li <?php if($page_name=='customer_products'){ ?>class="active"<?php } ?>>

                        <a href="<?php echo base_url(); ?>home/customer_products">

                            <?php echo translate('classifieds');?>

                        </a>

                    </li>

                    <?php }} if ($this->crud_model->get_type_name_by_id('general_settings','58','value') !== 'ok') {

                                if($this->db->get_where('ui_settings',array('type'=>'header_latest_products_status'))->row()->value == 'yes'){

					?>

                    <li class="<?php if($others_list=='latest'){ echo 'active'; } ?>">

                        <a href="<?php echo base_url(); ?>home/others_product/latest">

                            <?php echo translate('latest_products');?>

                        </a>

                    </li>

                    <?php

						}}

					?>

                    <?php

                    	if ($this->crud_model->get_type_name_by_id('general_settings','68','value') == 'ok') {

                            if($this->db->get_where('ui_settings',array('type'=>'header_all_brands_status'))->row()->value == 'yes') {

					?>

                    <li <?php if($asset_page=='all_brands'){ ?>class="active"<?php } ?>>

                        <a href="<?php echo base_url(); ?>home/all_brands">

                            <?php echo translate('all_brands');?>

                        </a>

                    </li>

                    <?php

						}

                    }

					?>

                    <?php

                    	if ($this->crud_model->get_type_name_by_id('general_settings','58','value') == 'ok') {

                            if ($this->crud_model->get_type_name_by_id('general_settings','81','value') == 'ok'){

                                if($this->db->get_where('ui_settings',array('type'=>'header_all_vendors_status'))->row()->value == 'yes') {

					?>

                    <li <?php if($asset_page=='all_vendor'){ ?>class="active"<?php } ?>>

                        <a href="<?php echo base_url(); ?>home/all_vendor/">

                            <?php echo translate('all_vendors');?>

                        </a>

                    </li>

                    <?php

                                }

						    } 

                        }

					?>

                    <?php if($this->db->get_where('ui_settings',array('type'=>'header_blogs_status'))->row()->value == 'yes') {?>

                    <li class="hidden-sm hidden-xs <?php if($asset_page=='blog'){ echo 'active'; } ?>">

                        <a href="<?php echo base_url(); ?>home/blog">

                            <?php echo translate('blogs');?>

                        </a>

                        <ul>

                        	<?php

								$blogs=$this->db->get('blog_category')->result_array();

								foreach($blogs as $row){

							?>

                            <li>

                                <a href="<?php echo base_url(); ?>home/blog/<?php echo $row['blog_category_id']; ?>">

                                    <?php echo $row['name']; ?>

                                </a>

                            </li>

                            <?php

								}

							?>

                        </ul>

                    </li>

                    <?php }?>

                    <li class="hidden-lg hidden-md <?php if($asset_page=='blog'){ echo 'active'; } ?>">

                        <a href="#">

                            <?php echo translate('blogs');?>

                        </a>

                        <ul>

                        	<?php

								$blogs=$this->db->get('blog_category')->result_array();

								foreach($blogs as $row){

							?>

                            <li>

                                <a href="<?php echo base_url(); ?>home/blog/<?php echo $row['blog_category_id']; ?>">

                                    <?php echo $row['name']; ?>

                                </a>

                            </li>

                            <?php

								}

							?>

                        </ul>

                    </li>

                    <?php

                    	if ($this->crud_model->get_type_name_by_id('general_settings','58','value') == 'ok' && $this->crud_model->get_type_name_by_id('general_settings','81','value') == 'ok') {

                            if($this->db->get_where('ui_settings',array('type'=>'header_store_locator_status'))->row()->value == 'yes') {

					?>

                    <li <?php if($asset_page=='store_locator'){ ?>class="active"<?php } ?>>

                        <a href="<?php echo base_url(); ?>home/store_locator">

                            <?php echo translate('store_locator');?>

                        </a>

                    </li>

                    <?php

                            }

						}

					?>

                    <?php if($this->db->get_where('ui_settings',array('type'=>'header_contact_status'))->row()->value == 'yes') {?>

                    <li <?php if($asset_page=='contact'){ ?>class="active"<?php } ?>>

                        <a href="<?php echo base_url(); ?>home/contact">

                            <?php echo translate('contact');?>

                        </a>

                    </li>

                    <?php } if($this->db->get_where('ui_settings',array('type'=>'header_more_status'))->row()->value == 'yes') {?>

                    <li>

                        <a href="#">

							<?php echo translate('more');?>

                        </a>

                        <ul>

                            <?php

								if ($this->crud_model->get_type_name_by_id('general_settings','58','value') == 'ok') {

							?>

							<li class="<?php if($others_list=='latest'){ echo 'active'; } ?>">

								<a href="<?php echo base_url(); ?>home/others_product/latest">

									<?php echo translate('latest_products');?>

								</a>

							</li>

							<?php

								}

							?>

                            <?php

							$this->db->where('status','ok');

                            $all_page = $this->db->get('page')->result_array();

							foreach($all_page as $row2){

							?>

                            <li>

                                <a href="<?php echo base_url(); ?>home/page/<?php echo $row2['parmalink']; ?>">

                                    <?php echo $row2['page_name']; ?>

                                </a>

                            </li>

                            <?php

							}

							?>

                        </ul>

                    </li>

                    <?php }?>

                </ul>

            </nav>
        </div>

    </div>-->

</header>

<!-- /HEADER -->

<script type="text/javascript">

    $(document).ready(function(){

        $('.set_langs').on('click',function(){

            var lang_url = $(this).data('href');                                    

            $.ajax({url: lang_url, success: function(result){

                location.reload();

            }});

        });

        $('.top-bar-right').load('<?php echo base_url(); ?>home/top_bar_right');

    });

</script>

<?php

if ($this->crud_model->get_type_name_by_id('general_settings','58','value') !== 'ok') {

?>

<style>

.header.header-logo-left .header-search .header-search-select .dropdown-toggle {

    right: 40px !important;

}

</style>
                    
<?php

}

?>