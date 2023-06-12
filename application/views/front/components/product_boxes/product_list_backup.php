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
<div class="col-sm-12">
    <div class="card card-body mt-3">
        <div class="media align-items-center align-items-lg-start text-center text-lg-left flex-column flex-lg-row">
            <div class="mr-2 mb-3 mb-lg-0">
                <img src="<?php echo  $img; ?>" width="150" height="150" alt="">
            </div>

            <div class="media-body">
                <h6 class="media-title font-weight-semibold">
                    <a href="<?php echo $this->crud_model->product_link($product_id); ?>" data-abc="true">
                        <?php echo ucwords($title); ?>
                    </a>
                </h6>

                <ul class="list-inline list-inline-dotted mb-3 mb-lg-2">
                    <li class="list-inline-item">
                        <a href="javascript:;" class="text-muted" data-abc="true">
                            <?php echo $this->crud_model->get_type_name_by_id('category',$category,'category_name');?>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a class="text-muted" href="<?php echo base_url(); ?>home/category/<?php echo $category; ?>/<?php echo $sub_category; ?>">
                            <?php echo $this->crud_model->get_type_name_by_id('sub_category',$sub_category,'sub_category_name');?>
                        </a>
                    </li>
                    <li class="list-inline-item" itemtype="http://schema.org/Brand">
                        <a class="text-muted" itemprop="url" href="<?php echo base_url(); ?>home/category/<?php echo $category; ?>/<?php echo $sub_category; ?>-<?php echo $brand; ?>">
                            <span itemprop="name"><?php echo $this->crud_model->get_type_name_by_id('brand',$brand,'name');?></span>
                        </a>
                    </li>
                </ul>
                <p class="mb-3">

                </p>
                <ul class="list-inline list-inline-dotted mb-0">
                    <li class="list-inline-item" itemscope itemtype="http://schema.org/Store" >
                        <?php echo translate('sold_by_:');?>  <?php echo $n['title'];?>

                    </li>
                    <li class="list-inline-item">Add to <a href="#" data-abc="true">wishlist</a></li>
                </ul>
            </div>

            <div class="mt-3 mt-lg-0 ml-lg-3 text-center">
                <h3 class="mb-0 font-weight-semibold">
                    <?php if($discount > 0){
                        echo currency($this->crud_model->get_product_price($product_id));
                        echo ' /'.$unit;
                        ?>
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
                        <?php echo currency($sale_price); ?>
                        <?php echo ' /'.$unit;?>
                    <?php }?>
                </h3>

                <div>
                    <!--                    <i class="fa fa-star"></i>-->
                    <!--                    <i class="fa fa-star"></i>-->
                    <!--                    <i class="fa fa-star"></i>-->
                    <!--                    <i class="fa fa-star"></i>-->
                    <!--                    <i class="fa fa-star"></i>-->

                </div>

                <div class="text-muted">
                    <?php
                    if($current_stock > 0){
                        echo $current_stock.' '.$unit.translate('_available');
                    }else{
                        echo translate('out_of_stock');
                    }
                    ?>

                </div>
                <button type="button" class="btn btn-warning mt-4 text-white"><i class="icon-cart-add mr-2"></i> Add to cart</button>
            </div>
        </div>
    </div>
</div>

<!--old-->
<div class="thumbnail list_box_style1" itemscope itemtype="http://schema.org/Product" id="list__viewss">
    <div class="row product-single">

        <div class="col-md-8 col-sm-8 col-xs-12 padding-l-0-md">
            <div class="caption">


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
                        <form action ="<?= base_url('home/cart/add/'.$product_id.'/pp'); ?>" method="post">
                            <input type="hidden" name="qty" value="1">
                            <input type="hidden" value="product" name="type">
                            <button style="background-color:#0e004a" type="submit" class="primary-btn">ADD TO CART</button>

                        </form>
                        <?php /*?><span class="btn btn-add-to cart" onclick="to_cart(<?php echo $product_id; ?>,event)">
                        <i class="fa fa-shopping-cart"></i>
                        <?php if($this->crud_model->is_added_to_cart($product_id)){
                            echo translate('added_to_cart');
                            } else {
                            echo translate('add_to_cart');
                            }
                        ?>
                    </span><?php */?>
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
