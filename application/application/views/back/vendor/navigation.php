<?php
$physical_check = $this->crud_model->get_type_name_by_id('general_settings','68','value');
$digital_check = $this->crud_model->get_type_name_by_id('general_settings','69','value');
?>
<nav id="mainnav-container">
    <div id="mainnav">
        <!--Menu-->
        <div id="mainnav-menu-wrap">
            <div class="nano">
                <div class="nano-content">
                    <ul id="mainnav-menu" class="list-group">
                        <!--Category name-->
                        <li class="list-header"></li>

                        <!--Menu list item-->
                        <li <?php if($page_name=="dashboard"){?> class="active-link" <?php } ?>
                        	style="border-top:1px solid rgba(69, 74, 84, 0.7);">
                            <a href="<?php echo base_url(); ?>vendor/">
                                <i class="fa fa-dashboard"></i>
                                <span class="menu-title">
									<?php echo translate('dashboard');?>
                                </span>
                            </a>
                        </li>
                        <li 
                        	style="border-top:1px solid rgba(69, 74, 84, 0.7);">
                            <a target="_blank" href="<?php echo base_url(); ?>home/affiliate">
                                <i class="fa fa-dashboard"></i>
                                <span class="menu-title">
									<?php echo translate('affiliate_panel');?>
                                </span>
                            </a>
                        </li>

            			<?php
						if($physical_check == 'ok' && $digital_check == 'ok'){
                        	if(  $this->crud_model->vendor_permission('product') ||
                                    	$this->crud_model->vendor_permission('stock') ||
                                       		$this->crud_model->vendor_permission('digital')){
						?>
                        <!--Menu list item-->
                        <li <?php if($page_name=="product" ||
                                         	$page_name=="stock" ||
													$page_name=="digital" ){?>
                                                     			class="active-sub"
                                                       				<?php } ?> >
                            <a href="#">
                                <i class="fa fa-shopping-cart"></i>
                                    <span class="menu-title">
                                        <?php echo translate('listings');?>
                                    </span>
                                	<i class="fa arrow"></i>
                            </a>

                            <!--PRODUCT------------------>
                            <ul class="collapse <?php if($page_name=="product" ||
															$page_name=="stock" ||
                                            					$page_name=="digital" ){?>
                                                                             		in
                                                                                		<?php } ?> >" >
							<?php
                                if( $this->crud_model->vendor_permission('product') ||
                                    	$this->crud_model->vendor_permission('stock') ){
                            ?>
                            <!--Menu list item-->
                                <li <?php if($page_name=="product" ||
                                            	$page_name=="stock" ){?>
                                                             class="active-sub"
                                                                <?php } ?> >
                                    <a href="#">
                                        <i class="fa fa-list"></i>
                                            <span class="menu-title">
                                                <?php echo translate('listings');?>
                                            </span>
                                            <i class="fa arrow"></i>
                                    </a>

                                    <!--PRODUCT------------------>
                                    <ul class="collapse <?php if($page_name=="product" ||
																	$page_name=="stock" ){?>
                                                                		in
                                                                     		<?php } ?> " >

                                        <?php if($this->crud_model->vendor_permission('product')){
                                        ?>
                                            <li <?php if($page_name=="product"){?> class="active-link" <?php } ?> >
                                                <a href="<?php echo base_url(); ?>vendor/product">
                                                    <i class="fa fa-circle fs_i"></i>
                                                        <?php echo translate('all_listings');?> 
                                                </a>
                                            </li>
                                            <li <?php if($page_name=="product" && isset($_GET['is_blog'])){?> class="active-link" <?php } ?> >
                                                <a href="<?php echo base_url(); ?>vendor/product?is_blog=1">
                                                    <i class="fa fa-circle fs_i"></i>
                                                        <?php echo translate('blog_listings');?>
                                                </a>
                                            </li>
                                            <li <?php if($page_name=="product" && isset($_GET['is_product'])){?> class="active-link" <?php } ?> >
                                                <a href="<?php echo base_url(); ?>vendor/product?is_product=1">
                                                    <i class="fa fa-circle fs_i"></i>
                                                        <?php echo translate('product_listings');?>
                                                </a>
                                            </li>
                                        <?php
                                            } if($this->crud_model->vendor_permission('product')) {
                                            ?>
                                            <li <?php if($page_name == "product_bulk_upload"){?> class="active-link" <?php } ?> >
                                                <a href="<?php echo base_url(); ?>vendor/product_bulk_upload">
                                                    <i class="fa fa-circle fs_i"></i>
                                                    <?php echo translate('Product bulk upload');?>
                                                </a>
                                            </li>
                                        <?php
                                            } if($this->crud_model->vendor_permission('stock')){
                                        ?>
                                        <?php
                                            }
                                        ?>
                                    </ul>
                                </li>

                            <?php
                                }
                            ?>

                            <?php
                                if($this->crud_model->vendor_permission('digital') ){
                            ?>
                            <!--Menu list item-->
                                <li <?php if($page_name=="digital"){?> class="active-link" <?php } ?> >
                                    <a href="<?php echo base_url(); ?>vendor/digital">
                                        <i class="fa fa-list"></i>
                                            <?php echo translate('digital_products');?>
                                    </a>
                                </li>

                            <?php
                                }
                            ?>
                            </ul>
                        </li>
            			<?php
								}
							}
						?>
                        <?php
						if($physical_check == 'ok' && $digital_check !== 'ok'){
                        	if( $this->crud_model->vendor_permission('product') ||
                           			$this->crud_model->vendor_permission('stock') ){
						?>
						<!--Menu list item-->
							<li <?php if($page_name=="product" ||
											$page_name=="stock" ){?>
														 class="active-sub"
															<?php } ?> >
								<a href="#">
									<i class="fa fa-list"></i>
										<span class="menu-title">
											<?php echo translate('listings');?>
										</span>
										<i class="fa arrow"></i>
								</a>

								<!--PRODUCT------------------>
								<ul class="collapse <?php if($page_name=="product" ||
																$page_name=="stock" ){?>
																	in
																		<?php } ?> " >

									<?php if($this->crud_model->vendor_permission('product')) {
                                        ?>
                                        <li <?php if ($page_name == "product" && !isset($_GET['is_event']) && !isset($_GET['is_job']) && !isset($_GET['is_product'])) { ?> class="active-link" <?php } ?> >
                                            <a href="<?php echo base_url(); ?>vendor/product">
                                                <i class="fa fa-circle fs_i"></i>
                                                <?php echo translate('all_listings'); ?>
                                            </a>
                                        </li>
                                             <li <?php if($page_name=="product" && isset($_GET['is_blog'])){?> class="active-link" <?php } ?> >
                                                <a href="<?php echo base_url(); ?>vendor/product?is_blog=1">
                                                    <i class="fa fa-circle fs_i"></i>
                                                        <?php echo translate('blog_listings');?>
                                                </a>
                                            </li>
                                            <li <?php if($page_name=="product" && isset($_GET['is_product'])){?> class="active-link" <?php } ?> >
                                                <a href="<?php echo base_url(); ?>vendor/product?is_product=1">
                                                    <i class="fa fa-circle fs_i"></i>
                                                        <?php echo translate('product_listings');?>
                                                </a>
                                            </li>
									<?php
										}
									?>
								</ul>
							</li>
						<?php
							}
						}
						?>
                        <?php
						if($physical_check !== 'ok' && $digital_check == 'ok'){
							if($this->crud_model->vendor_permission('digital') ){
                            ?>
                            <!--Menu list item-->
                            <li <?php if($page_name=="digital"){?> class="active-link" <?php } ?> >
                                <a href="<?php echo base_url(); ?>vendor/digital">
                                    <i class="fa fa-list"></i>
                                        <?php echo translate('products');?>
                                </a>
                            </li>
						<?php
							}
						}
						?>
                        <!--SALE-------------------->
						<?php
							if($this->crud_model->vendor_permission('sale')){
						?>
                        <!--Menu list item-->
                        <li <?php if($page_name=="sales"){?> class="active-link" <?php } ?>>
                            <a href="<?php echo base_url(); ?>vendor/sales/">
                                <i class="fa fa-usd"></i>
                                    <span class="menu-title">
                                		<?php echo translate('sale');?>
                                    </span>
                            </a>
                        </li>
                        <?php
							}
						?>
                        <!----------------Blog-------------->
                    	<?php /*
							if($this->crud_model->vendor_permission('sale')){
						?>
                        <!--Menu list item-->
                        <li <?php if($page_name=="Blog"){?> class="active-link" <?php } ?>>
                            <a href="<?php echo base_url(); ?>vendor/blog/">
                                <i class="fa fa-usd"></i>
                                    <span class="menu-title">
                                		<?php echo translate('Blog');?>
                                    </span>
                            </a>
                        </li>
                        <?php 
							}
						*/	
						?>

                        <!--  Payment from Admin -->
						<?php
							if($this->crud_model->vendor_permission('pay_to_vendor')){
						?>
                        <!--Menu list item-->
                        <li <?php if($page_name=="admin_payments"){?> class="active-link" <?php } ?>>
                            <a href="<?php echo base_url(); ?>vendor/admin_payments/">
                                <i class="fa fa-usd"></i>
                                <span class="menu-title">
                                    <?php echo translate('payment_from_admin');?>
                                </span>
                            </a>
                        </li>
                        <?php
							}
						?>

                        <!--  Package Upgrade History -->
						<?php
							if($this->crud_model->vendor_permission('business_settings')){
                                if ($this->db->get_where('business_settings',array('type' => 'commission_set'))->row()->value == 'no') {
						?>
                        <!--Menu list item-->
                        <?php
							    }
                            }
						?>

                        <?php
                            if($this->crud_model->vendor_permission('coupon')){
                        ?>
                        <!--Menu list item-->
                        <!--Menu list item-->
                        <?php
                            }
                        ?>

                        <?php
							if($this->crud_model->vendor_permission('report')){
						?>
                        <!--Menu list item-->
                        <?php
							}
						?>
                        <?php
                            if($this->crud_model->vendor_permission('site_settings')){
                        ?>
                        <!--Menu list item-->
                        <li <?php if($page_name=="site_settings"){?> class="active-link" <?php } 

                        ?> >
                        <?php
                        $vend = $this->db->where('vendor_id',$this->session->userdata('vendor_id'))->get('vendor')->row();
                        ?>
                            <a href="<?php echo base_url(); ?>vendor/product/edit/<?= $vend->bpage; ?>">
                                <i class="fa fa-wrench"></i>
                                    <span class="menu-title">
                                        <?php echo translate('business_page');?>
                                    </span>
                            </a>
                        </li>
                        <!--Menu list item-->
                        <?php
                            }
                        ?>
                        <?php
                            if($this->crud_model->vendor_permission('site_settings')){
                        ?>
                        <!--Menu list item-->
                        <li <?php if($page_name=="site_settings"){?> class="active-link" <?php } 

                        ?> >
                        <?php
                        $vend = $this->db->where('vendor_id',$this->session->userdata('vendor_id'))->get('vendor')->row();
                        ?>
                            <a href="<?php echo $this->crud_model->product_link($vend->bpage); ?>?edit=1" target="_blank">
                                <i class="fa fa-wrench"></i>
                                    <span class="menu-title">
                                        <?php echo translate('business_page_live_edit');?>
                                    </span>
                            </a>
                        </li>
                        <li <?php if($page_name=="site_settings"){?> class="active-link" <?php } 

                        ?> >
                        
                            <a href="<?php echo base_url('vendor/brand');?>" target="_blank">
                                <i class="fa fa-wrench"></i>
                                    <span class="menu-title">
                                        <?php echo translate('text_gallery');?>
                                    </span>
                            </a>
                        </li>
                        <!--Menu list item-->
                        <?php
                            }
                        ?>

                        <?php
                            if($this->crud_model->vendor_permission('business_settings')){
                        ?>
                        <?php
                            }
                        ?>

                        <?php
                            if($this->crud_model->vendor_permission('business_settings')){
                                if ($this->db->get_where('business_settings',array('type' => 'commission_set'))->row()->value == 'no') {
                        ?>
                        <?php
                                }
                            }
                        ?>

                        <li <?php if($page_name=="manage_vendor"){?> class="active-link" <?php } ?> >
                            <a href="<?php echo base_url(); ?>vendor/manage_vendor/">
                                <i class="fa fa-lock"></i>
                                <span class="menu-title">
                                	<?php echo translate('manage_profile');?>
                                </span>
                            </a>
                        </li>
                        <li><a href="<?php echo base_url(); ?>vendor/affiliate/">
                             <i class="fa fa-lock"></i>
                                <span class="menu-title">
                                	<?php echo translate('Affiliates');?>
                                </span>
                        </a></li>
                </div>
            </div>
        </div>
    </div>
</nav>

<style>
	ul ul ul li a{
		padding-left:80px !important;
	}
	ul ul ul li a:hover{
		background:#2f343b !important;
	}
</style>