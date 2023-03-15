<style>
    .widget-search input{
        border:none !important;
    }
    #result .pagination  li {
    padding: 0;
    border-bottom: none;
    font-size: 13px;
    cursor: pointer;
}
   #result .pagination  {
    background: #fff;
    width: 100%;
    right: 0;
    border: none;
    padding: 0;
    box-shadow: none;
}
#result ul li:hover {
    background: none;
    color: #fff;
}
</style>
 

<?php 
$cat = $this->db->where('category_id',$category)->get('category')->row();
$time1 = $create_at;
$time1 = date("H:i:s",strtotime($time1));
$date = date('Y-m-d',strtotime($time1));
 $time = time();
 if($time >=$openig_time && $time <=$closing_time){
  $x = 'Opened';  
}
else{
      $x = 'Closed';  
}
$img = '';
                        if($comp_cover)
                        {
                            $img = $this->crud_model->get_img($comp_cover);
                            if(isset($img->secure_url))
                            {
                                $img = $img->secure_url;
                            }

                        }
                        else
                        {
                            $img = $this->crud_model->file_view('product',$product_id,'','','thumb','src','multi','one');

                        }
$logo='';
                            if($comp_logo)
                        {
                            $logo = $this->crud_model->get_img($comp_logo);
                            if(isset($logo->secure_url))
                            {
                                $logo = base_url('/').$logo->path;
                            }

                        }
                        else
                        {
                            $logo = $this->crud_model->file_view('product',$product_id,'','','thumb','src','multi','one');

                        }                        ?>
                        <div class="thumbnail list_box_style1 item" data-id="<?= $product_id;?>" onmouseover="open_marker(<?= $lat?>, <?=$lng ?>)"  rate="<?= ($rating_num)?$rating_num:0; ?>"  data-lat="<?= $lat; ?>" title="<?php echo $title; ?>" img-src="<?php echo $img; ?>" data-lng="<?= $lng; ?>"  itemscope itemtype="http://schema.org/Product">
                            
<div class="sidegap_product" id="product_listing_bg">
    <div class="row">
        <div class="col-sm-4 leftboxes-">
            
            <div class="img_hover_icons">
                
                <!--<a href="#"><i class="fa fa-star"></i></a>-->
                <!--<a href="#"><span class="online_box"></span></a>-->
                <!--<a href="#"><i class="fa fa-share"></i></a>-->
                <!--<a href="#"><i class="fa fa-heart"></i></a>-->
            </div>
            <div class="imgbox_opacity">
              <img src="<?= $img; ?>" alt="">
                <div class="logo_withname">
                    <img src="<?= $logo; ?>" alt="">
                    <h4><?= $product_id;?> -<?= $title ?></h4>
                    
                    <?=
                         $featured=$this->crud_model->rate_html($rating_num);
                         ?>
                </div>
                 <a href="<?= base_url('home/product_view/').$product_id; ?>" target="_blank"> <div class="overlay_img"></div></a>
            </div>
        </div>
        <div class="col-sm-8 rightboxes-">
             <div class="white_shadow__box">
                <p><?=
                // var_dump($is_event);
                $slogan; ?> </p>
                <?php if($is_event == '1'){?>
                <span>Date: <?= $date;?></span>
              
               <span>Time: <?= $time1;?></span>
              
                <p><span> <?= $x;?></span></p>
                   <?php
                }
                ?>
                <h6><?= substr($description, 0,200); ?></h6>
                
                <div class="share_iconss">
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
                    <!--<a href="#"><i class="fa fa-share"></i></a>-->
                    <a href="mailto: <?= $bussniuss_email;?>"><i class="fa fa-envelope"></i></a>
                    <a href="tel:<?= $bussniuss_phone;?>"><i class="fa fa-phone"></i></a>
                </div>
            </div>
        </div>
    </div>
   
</div>

                            
    <div class="row product-single" style="display: none;">
        <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="media">
            	<div class="cover"></div>                
        		<div class="media-link image_delay"  style="background-image:url('<?php echo $img; ?>');background-size:cover; background-position:center;">
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
                    </p>
                    ||
                    <p>
                        <a href="<?php echo base_url(); ?>home/category/<?php echo $category; ?>/<?php echo $sub_category; ?>">
                            <?php echo $this->crud_model->get_type_name_by_id('sub_category',$sub_category,'sub_category_name');?>
                        </a>
                    </p>
                    ||
                    <p itemscope itemtype="http://schema.org/Brand">
                        <a itemprop="url" href="<?php echo base_url(); ?>home/category/<?php echo $category; ?>/<?php echo $sub_category; ?>-<?php echo $brand; ?>">
                         <span itemprop="name"><?php echo $this->crud_model->get_type_name_by_id('brand',$brand,'name');?></span>
                        </a>
                    </p>
                </div>
                <?php if ($this->db->get_where('general_settings', array('general_settings_id' => '58'))->row()->value == 'ok'): ?>
                <div class="added_by" itemscope itemtype="http://schema.org/Store">
                    <?php echo translate('sold_by_:');?>
                    <p itemprop="name">
                        <?php echo $this->crud_model->product_by($product_id,'with_link');?>
                    </p>
                </div>
                <?php endif ?>
                <hr class="page-divider"/>
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
                <?php
                    }else{
                ?>
                <div class="out_of_stock">
                    <?php echo translate('out_of_stock');?>
                </div>
                <?php
                    }
                ?>
                <hr class="page-divider"/>
                <div class="buttons">
                    <?php/*?>
                    <span class="btn btn-add-to cart" onclick="to_cart(<?php echo $product_id; ?>,event)">
                        <i class="fa fa-shopping-cart"></i>
                        <?php if($this->crud_model->is_added_to_cart($product_id)){ 
                            echo translate('added_to_cart');  
                            } else { 
                            echo translate('add_to_cart');  
                            } 
                        ?>
                    </span>
                    <?php
                    */
                    ?>
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
                    <span class="btn btn-add-to compare btn_compare" onclick="do_compare(<?php echo $product_id; ?>,event)">
                        <i class="fa fa-exchange"></i>
                        <span class="hidden-sm hidden-xs">
							<?php if($compare == 'yes'){ 
                                echo translate('_compared'); 
                                } else { 
                                echo translate('_compare');
                                } 
                            ?>
                        </span>
                    </span>
                    
                    <?php
                                if($lat && $lng)
                                {
                                ?>
                                    

                                 
                    <span class="btn btn-add-to" onclick="open_marker(<?= $lat?>, <?=$lng ?>)">
                    

                    <i onclick="" class="fa-solid fa-location-dot"></i>
                        <span class="hidden-sm hidden-xs">
							
                                Map 
                            
                        </span>
                    </span>
                    <?php
                                }
                                ?>
                </div>
            </div>
        </div>
    </div>
</div>