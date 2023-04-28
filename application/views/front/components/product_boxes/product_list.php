<?php
$vendor_id =json_decode( $added_by);
$id = $vendor_id->id;
$vendor = $this->db->where('vendor_id', $id)->get('vendor')->row_array();
$n = $this->db->where('product_id',$vendor['bpage'])->where('is_bpage',1)->get('product')->row_array();
if($comp_logo)
                        {
                            $img = $this->crud_model->get_img($comp_logo);
                            if(isset($img->secure_url))
                            {
                                $img = base_url('/').$img->path;
                            }

                        }
                        else
                        {
                            $img = $this->crud_model->file_view('product',$product_id,'','','thumb','src','multi','one');

                        }
?>
<div class="thumbnail list_box_style1" itemscope itemtype="http://schema.org/Product" id="list__viewss">
    <div class="row product-single">
        <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="media">
            	<div class="cover"></div>                
        		<div class="media-link image_delay" data-src="<?php echo  $img; ?>" style="background-image:url('<?php echo img_loading(); ?>');background-size:cover; background-position:center;height:200px">
                    <span onclick="quick_view('<?php echo $this->crud_model->product_link($product_id,'quick'); ?>')">
                        <span class="icon-view">
                            <strong><i class="fa fa-eye"></i></strong>
                        </span>
                    </span>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-sm-8 col-xs-12 padding-l-0-md">
            <div class="caption">
                <h4 class="caption-title">
                    <a itemprop="url" href="<?php echo $this->crud_model->product_link($product_id); ?>">
                        <span itemprop="name"><?php echo $title; ?></span>
                    </a>
                </h4>
                <div class="product-info">
                    <p>
                        <a href="<?php echo base_url(); ?>home/category/<?php echo $category; ?>">
                            <?php echo $this->crud_model->get_type_name_by_id('category',$category,'category_name');?>
                        </a>
               
                        <a href="<?php echo base_url(); ?>home/category/<?php echo $category; ?>/<?php echo $sub_category; ?>">
                            <?php echo $this->crud_model->get_type_name_by_id('sub_category',$sub_category,'sub_category_name');?>
                        </a>
                    </p>
                    <p itemscope itemtype="http://schema.org/Brand">
                        <a itemprop="url" href="<?php echo base_url(); ?>home/category/<?php echo $category; ?>/<?php echo $sub_category; ?>-<?php echo $brand; ?>">
                         <span itemprop="name"><?php echo $this->crud_model->get_type_name_by_id('brand',$brand,'name');?></span>
                        </a>
                    </p>
                </div>
                <?php if ($this->db->get_where('general_settings', array('general_settings_id' => '58'))->row()->value == 'ok'): ?>
                <div class="added_by" itemscope itemtype="http://schema.org/Store" style="display:flex;">
                    <?php echo translate('sold_by_:');?>
                    <p itemprop="name">
                        <?php echo $n['title'];?>
                    </p>
                </div>
                <?php endif ?>
                <hr class="page-divider" style="margin:0px;"/>
                <div>
                <div class="product-price">
                    <?php echo translate('price_:');?>
                    <?php if($discount > 0){ ?> 
                        <ins>
                            <?php echo currency($this->crud_model->get_product_price($product_id)); ?>
                            <unit><?php echo ' /'.$unit;?></unit>
                        </ins> 
                        <del itemprop="price"><?php echo currency($sale_price); ?></del>
                        <span class="label label-success">
                        <?php 
                            echo translate('discount:_').$discount;
                            if($discount_type =='percent'){
                                echo '%';
                            }
                            else{
                                echo currency();
                            }
                        ?>
                        </span>
                    <?php } else { ?>
                        <ins itemprop="price">
                            <?php echo currency($sale_price); ?>
                            <unit><?php echo ' /'.$unit;?></unit>
                        </ins> 
                    <?php }?>
                </div>
                <?php
                    if($current_stock > 0){
                ?>
                <div class="stock" itemprop="availability" href="http://schema.org/InStock">
                    <?php echo $current_stock.' '.$unit.translate('_available');?>
                </div>
                </div>
                <?php
                    }else{
                ?>
                <div class="out_of_stock">
                    <?php echo translate('out_of_stock');?>
                </div>
                <?php
                    }
                ?>
                <!--<hr class="page-divider"/>-->
                
                <div class="buttons">
                    <?php 
                    $user = $this->session->userdata('user_id');
                    if($is_affiliate && $user)
                    {
                        $vid = 0;
                        $added_by = json_decode($added_by, true);
                        if(isset($added_by['type']) && $added_by['type'] == 'vendor')
                        {
                            $vid = $added_by['id'];
                        }
                        
                        $wish = $this->crud_model->is_aff($product_id); 
                    ?>
                    <button class="btn btn-add-to <?php if($wish == 'yes'){ echo 'wished';} else{ echo 'wishlist';} ?>" onclick="to_affliate(<?php echo $vid; ?>,event)">
                        <i class="fa fa-heart"></i>
                        <span class="hidden-sm hidden-xs">
							<?php if($wish == 'yes'){ 
                                echo translate('_added_to_affliate'); 
                                } else { 
                                echo translate('_add_to_affliate');
                                } 
                            ?>
                        
                        </span>
                    </button>
                    <?php
                    }
                    ?>
                    <?php 
                    $pro = $this->db->get_where('product', array('product_id' => $product_id))->row();
                    if($pro->product_link){?>
                    
                        <a href="<?= $pro->product_link?>" class="btn btn-add-to cart"> Go To Shop</a>
                    <?php }else{?>
                    <span class="btn btn-add-to cart" onclick="to_cart(<?php echo $product_id; ?>,event)">
                        <i class="fa fa-shopping-cart"></i>
                        <?php if($this->crud_model->is_added_to_cart($product_id)){ 
                            echo translate('added_to_cart');  
                            } else { 
                            echo translate('add_to_cart');  
                            } 
                        ?>
                    </span>
                    <?php }?>
                    <?php 
                        $wish = $this->crud_model->is_wished($product_id); 
                    ?>
                    <span class="btn btn-add-to <?php if($wish == 'yes'){ echo 'wished';} else{ echo 'wishlist';} ?>" onclick="to_wishlist(<?php echo $product_id; ?>,event)">
                        <i class="fa fa-heart"></i>
                        <span class="hidden-sm hidden-xs">
							<?php if($wish == 'yes'){ 
                                echo translate('_added_to_wishlist'); 
                                } else { 
                                echo translate('_add_to_wishlist');
                                } 
                            ?>
                        </span>
                    </span>
                    <?php 
                        $compare = $this->crud_model->is_compared($product_id); 
                    ?>
       <!--             <span class="btn btn-add-to compare btn_compare" onclick="do_compare(<?php echo $product_id; ?>,event)">-->
       <!--                 <i class="fa fa-exchange"></i>-->
       <!--                 <span class="hidden-sm hidden-xs">-->
							<?php /* if($compare == 'yes'){ -->
       <!--                         echo translate('_compared'); -->
       <!--                         } else { -->
       <!--                         echo translate('_compare');-->
       <!--                         } -->
       <!--                    */ ?>
       <!--                 </span>-->
       <!--             </span>-->
                </div>
            </div>
        </div>
    </div>
</div>