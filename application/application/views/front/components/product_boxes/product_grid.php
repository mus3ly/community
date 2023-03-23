<?php
// die('ok');
$img = '';
$this->db->where('added_by',$added_by);
$this->db->where('is_bpage',1);
$vendor = $this->db->get('product')->row_array();
$img = '';
$logo=''; 
$vendorlogo= '';
  if($vendor['comp_logo']) 
                        {
                            $vendorlogo = $this->crud_model->get_img($vendor['comp_logo']);
                            if(isset($vendorlogo->secure_url))
                            {
                                $vendorlogo = $vendorlogo->secure_url;
                            }

                        }
                        else
                        {
                            $vendorlogo = $this->crud_model->file_view('product',$product_id,'','','thumb','src','multi','one');

                        }

                        if($comp_logo)
                        {
                            $img = $this->crud_model->get_img($comp_logo);
                            if(isset($img->secure_url))
                            {
                                $img = $img->secure_url;
                            }

                        }
                        else
                        {
                            $img = $this->crud_model->file_view('product',$product_id,'','','thumb','src','multi','one');

                        }
                        ?>
<div class="thumbnail box-style-1 no-padding ad_padi" itemscope itemtype="http://schema.org/Product" id="list__viewss">
    <div class="media">
        <div class="cover"></div>
        <div class="media-link image_delay" data-src="<?php echo $img; ?>" style="width: 100%;height: 200px;background-image:url('<?php echo $img; ?>');background-size:cover;">
            <div class="img_hover_icons left">
                   <?php
                   echo $this->crud_model->rate_html($rating_num);
                   ?>
                   <!--<a href="#"><i class="fa fa-heart"></i></a>-->
                </div>
             <div class="logo_withname">
                        <img src="<?= $vendorlogo; ?>" alt="">
                         <?php
                         $time = date('H:i:s', time());
                         $time = time();
                         if($time >=$openig_time && $time <=$closing_time){
                          ?>
                          <a href="#" class="online_box_wrapper"><span class="online_box2"></span></a>
                          <?php  
                        }
                        ?>
                        
                        
                        
                    </div>
            <?php
                if($this->crud_model->get_type_name_by_id('product',$product_id,'current_stock') <=0 && !$this->crud_model->is_digital($product_id)){ 
            ?>
                <div class="sticker red">
                    <?php echo translate('out_of_stock'); ?>
                </div>
            <?php
                }
            ?>
            <?php 
                $discount= $this->db->get_where('product',array('product_id'=>$product_id))->row()->discount ;           
                if($discount > 0){ 
            ?>
            <div class="sticker green">
                <?php echo translate('discount');?> 
                <?php 
                     $type = $this->db->get_where('product',array('product_id'=>$product_id))->row()->discount_type ; 
                     if($type =='amount'){
                          echo currency($discount); 
                          } else if($type == 'percent'){
                               echo $discount; 
                ?> 
                    % 
                <?php 
                    }
                ?>
            </div>
            <?php } ?>
            
        </div>
    </div>
    <div class="caption text-center add_clas">
        <h4 itemprop="name" class="caption-title">
            <a itemprop="url" href="<?php echo $this->crud_model->product_link($product_id); ?>">
                <span itemprop="name" class="add_colore"><?php echo $title; ?></span>
            </a>
            
        </h4>
        
        <?php $rating = $this->crud_model->rating($product_id); ?>
        <?php $rating_count = $this->crud_model->rating_count($product_id); ?>
        <span style="display: none" itemprop="ratingValue"><?= $rating?></span>
        <span style="display: none" itemprop="reviewCount"><?= $rating_count?></span>
        
        <div class="price">
            <?php if($this->crud_model->get_type_name_by_id('product',$product_id,'discount') > 0){ ?> 
                <ins><?php echo currency($this->crud_model->get_product_price($product_id)); ?> </ins> 
                <del itemprop="price"><?php echo currency($sale_price); ?></del>
            <?php } else { ?>
                <ins itemprop="price"><?php echo currency($sale_price); ?></ins>
            <?php }?>
        </div>
        <?php if ($this->db->get_where('general_settings', array('general_settings_id' => '58'))->row()->value == 'ok' and $this->db->get_where('general_settings', array('general_settings_id' => '81'))->row()->value == 'ok'): ?>
        <div class="vendor">
            <?php echo $this->crud_model->product_by($product_id,'with_link'); ?>
        </div>
        <?php endif ?>
       
    </div>
    <div class="deiscription">
        <span>Detail</span>
        <div class="desc"><?= excerpt($description,150); ?></div>
    </div>
     <div class="button icon_buton">
            <div class="quick-view-sm hidden-xs hidden-sm">
                <span onclick="quick_view('<?php echo $this->crud_model->product_link($product_id,'quick'); ?>')">
                    <span class="icon-view" data-toggle="tooltip" data-original-title="<?php  echo translate('quick_view'); ?>">
                        <strong><i class="fa fa-eye"></i></strong>
                    </span>
                </span>
            </div>
            <span class="icon-view left" onclick="do_compare(<?php echo $product_id; ?>,event)" data-toggle="tooltip" 
                data-original-title="<?php if($this->crud_model->is_compared($product_id)=="yes"){ echo translate('compared'); } else { echo translate('compare'); } ?>">
                <strong><i class="fa fa-exchange"></i></strong>
            </span>
            <span class="icon-view middle more_midle" onclick="to_wishlist(<?php echo $product_id; ?>,event)" data-toggle="tooltip" 
                data-original-title="<?php if($this->crud_model->is_wished($product_id)=="yes"){ echo translate('added_to_wishlist'); } else { echo translate('add_to_wishlist'); } ?>">
                <strong><i class="fa fa-heart"></i></strong>
            </span>
            <span class="icon-view right " onclick="to_cart(<?php echo $product_id; ?>,event)" data-toggle="tooltip" 
                data-original-title="<?php if($this->crud_model->is_added_to_cart($product_id)){ echo translate('added_to_cart'); } else { echo translate('add_to_cart'); } ?>">
                <strong><i class="fa fa-shopping-cart"></i></strong>
            </span>
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
        </div>
</div>