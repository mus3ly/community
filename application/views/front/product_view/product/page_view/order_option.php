<style type="text/css">
    .buttons .options:nth-child(2) .title{
        display: inline;
    }
</style>
<?php
$row = $pro;
    echo form_open('', array(
        'method' => 'post',
        'class' => 'sky-form',
    ));
?>
    <div class="order">
        
        <div class="buttons">
            <?php
                $all_op = json_decode($row['options'],true);
                if(!empty($all_op)){
                    foreach($all_op as $i=>$row1){
                        $type = $row1['type'];
                        $name = $row1['name'];
                        $title = $row1['title'];
                        $option = $row1['option'];
            ?>
            <div class="row">
                    <dt class="col-3"><?php echo $title.' :';?></dt>
                    <dd class="col-9">
                <?php
                    if($type == 'radio'){
                ?>
                    <div class="custom_radio">
                    <?php
                        $i=1;
                        foreach ($option as $op) {
                    ?>
                      <input type="radio" class="optional" name="<?php echo $name;?>" value="<?php echo $op;?>" <?php if($this->crud_model->is_added_to_cart($row['product_id'], 'option', $name) == $op){ echo 'checked'; } ?> id="<?php echo 'red_'.$i; ?>">
                      <label class="radio circle" for="<?php echo 'red_'.$i; ?>">
                        <span class="big">
                          <span class="small"></span>
                        </span>
                        <?php echo $op;?>
                      </label>
                    <?php
                        $i++;
                        }
                    ?>
                    </div>
                <?php
                    } else if($type == 'text'){
                ?>
                    <label class="textarea">
                        <textarea class="optional" rows="5" cols="30" name="<?php echo $name;?>"><?php echo $this->crud_model->is_added_to_cart($row['product_id'], 'option', $name); ?></textarea>
                    </label>
                <?php
                    } else if($type == 'single_select'){
                ?>
                    <label class="select" >
                        <select name="<?php echo $name; ?>" class="optional selectpicker input-price" data-live-search="true" >
                            <option value=""><?php echo translate('choose_one'); ?></option>
                            <?php
                                foreach ($option as $op) {
                            ?>
                            <option value="<?php echo $op; ?>" <?php if($this->crud_model->is_added_to_cart($row['product_id'], 'option', $name) == $op){ echo 'selected'; } ?> ><?php echo $op; ?></option>
                            <?php
                                }
                            ?>
                        </select>
                        <i></i>
                    </label>
                    <?php
                        } else if($type == 'multi_select') {
                    ?>
                    <div class="checkbox">
                    <?php
                        $j=1;
                        foreach ($option as $op){
                    ?>
                    <label for="<?php echo 'check_'.$j; ?>" onClick="check(this)" >
                        <input type="checkbox" id="<?php echo 'check_'.$j; ?>" class="optional" name="<?php echo $name;?>[]" value="<?php echo $op;?>" <?php if(!is_array($chk = $this->crud_model->is_added_to_cart($row['product_id'], 'option', $name))){ $chk = array(); } if(in_array($op, $chk)){ echo 'checked'; } ?>>
                        <span class="cr"><i class="cr-icon glyphicon glyphicon-ok"></i></span>
                        <?php echo $op;?>
                    </label>
                    <?php
                        $j++;
                        }
                    ?>
                    </div>
                <?php
                    }
                ?>
                </dd>
            </div>
            <?php
                    }
                }
            ?>
            <div class="item_count">
                <?php 
            $pro = $this->db->get_where('product', array('product_id' => $row['product_id']))->row();
            if($pro->product_link){?>
            
                
            <?php }else{?>
                <div class="quantity product-quantity">
                    <span class="btn" name='subtract' onclick='decrease_val();'>
                        <i class="fa fa-minus"></i>
                    </span>
                    <input  type="number" class="form-control qty quantity-field cart_quantity" min="1" max="<?php echo $row['current_stock']; ?>" name='qty' value="<?php if($a = $this->crud_model->is_added_to_cart($row['product_id'],'qty')){echo $a;} else {echo '1';} ?>" id='qty'/>
                    <span class="btn" name='add' onclick='increase_val();'>
                        <i class="fa fa-plus">
                    </i></span>
                </div>
                <?php }?>
                <?php
                    if($row['current_stock'] > 0){
                ?>
                <div class="stock" itemprop="availability" href="http://schema.org/InStock">
                    <?php echo $row['current_stock'].' '.$row['unit'].translate('_available');?>
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
            </div>
        </div>
    </div>
    <div class="buttons" style="display:inline-flex;">
        <?php 
            $pro = $this->db->get_where('product', array('product_id' => $row['product_id']))->row();
            if($pro->product_link){?>
            
                <a href="<?= $pro->product_link?>" target="_blank" class="btn btn-add-to cart"> Go To Shop</a>
            <?php }else{?>
        <span class="btn btn-add-to cart" onclick="to_cart(<?php echo $row['product_id']; ?>,event)">
            <i class="fa fa-shopping-cart"></i>
            <?php if($this->crud_model->is_added_to_cart($row['product_id'])=="yes"){
                echo translate('added_to_cart');
                } else {
                echo translate('add_to_cart');
                }
            ?>
        </span>
        <?php }?>
        <?php
            $wish = $this->crud_model->is_wished($row['product_id']);
        ?>
        <a href="<?= base_url(); ?>/home/wishlist/add/<?= $row['product_id'] ?>">
        <span class="btn btn-add-to <?php if($wish == 'yes'){ echo 'wished';} else{ echo 'wishlist';} ?>" onclick="to_wishlist(<?php echo $row['product_id']; ?>,event)">
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
        </a>
        <?php if($this->crud_model->is_product_affiliation_on($row['product_id']) && $this->session->userdata('user_login') == "yes" && $this->crud_model->get_settings_value('general_settings', 'product_affiliation_set', 'value') == 'ok') { ?>
        <span class="btn btn-add-to btn-warning"
              data-toggle="collapse" data-target="#affiliate_share_collapse" aria-controls="affiliate_share_collapse" role="button" aria-expanded="false">
            <i class="fa fa-share"></i>
            <span class="hidden-sm hidden-xs">
                <?php
                    echo translate('affiliate');
                ?>
            </span>
        </span>
        <?php } ?>
                <?php
                    
                    if(isset($bpage_slug) && $bpage_slug)
                    {
                ?>
                <a href="<?php echo base_url(); ?><?php echo base_url($bpage_slug); ?>#bpage_form" class="btn btn-add-to btn-primary"  role="button" aria-expanded="false">
            <i class="fa fa-paper-plane"></i>
            <span class="hidden-sm hidden-xs">
                                <?php echo translate('contact_with')." ".$product_added_by; ?>
            </span>
        </a>
        <?php
                    }
        ?>
        
    </div>
    <span class="share_icons">
                        <!-- 
<div class="a2a_kit a2a_kit_size_32 a2a_default_style mt-3">
<a class="a2a_dd" href="https://www.addtoany.com/share"></a>
<a class="a2a_button_facebook"></a>
<a class="a2a_button_whatsapp"></a>
<a class="a2a_button_twitter"></a>

</div>
<script async src="https://static.addtoany.com/menu/page.js"></script>
<!-- AddToAny END -->
<?php
$all = $this->db->get('bpkg')->result_array();
                    foreach ($all as $k=> $v) {

                                 if($v['share_link'])
                                 {
                                     if($aff_code)
                                  $url = base_url($row['slug']).'?aff='.$aff_code;
                                  else
                                  $url = base_url($row['slug']);
                                  $link = str_replace('link',$url, $v['share_link']);


                ?>

                <li><a href="<?= $link ?>"><i class="bi <?= $v['icon'] ?>"></i></a></li>

                <?php

                                 }

               }
               ?>
                    </span>
    <?php if($this->crud_model->is_product_affiliation_on($row['product_id']) && $this->session->userdata('user_login') == "yes" && $this->crud_model->get_settings_value('general_settings', 'product_affiliation_set', 'value') == 'ok') { ?>
    <div class="collapse pt-5" id="affiliate_share_collapse">
        <div class="panel panel-bordered">
            <div class="panel-body">
                <div class="input-group form-group ">
                    <input readonly type="text" class="form-control" id="affiliation_link_text"
                           placeholder="Click to get shareable link" value="<?= $this->crud_model->get_affiliation_link($row['product_id'], $this->session->userdata('user_id'))?>" aria-label="" aria-describedby="">
                    <div class="input-group-btn">
                        <?php if(empty($this->crud_model->get_affiliation_link($row['product_id'], $this->session->userdata('user_id')))) { ?>
                        <button class="btn btn-primary form_btn" type="button"
                                onclick="affiliate_share(<?php echo $row['product_id']; ?>,event,'affiliation_link_text','<?= translate('getting link') ?>')">
                            <?= translate("Get Link") ?>
                        </button>
                        <?php } ?>
                        <button class="btn btn-outline-secondary form_btn" type="button"
                                onclick="copyText('affiliation_link_text',this,event,'<?= translate('copied') ?>')">
                            <?= translate("copy") ?>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</form>
<div id="pnopoi"></div>
<div class="buttons">
    <div id="share"></div>
</div>
<hr class="page-divider small"/>
<script>
$(document).ready(function() {
	$('#share').share({
		urlToShare: '<?php echo $this->crud_model->product_link($row['product_id']); ?>',
		networks: ['facebook','googleplus','twitter','linkedin','tumblr','in1','stumbleupon','digg'],
		theme: 'square'
	});
});
function check_checkbox(){
	$('.checkbox input[type="checkbox"]').each(function(){
        if($(this).prop('checked') == true){
			$(this).closest('label').find('.cr-icon').addClass('add');
		}else{
			$(this).closest('label').find('.cr-icon').addClass('remove');
		}
    });
}
function check(now){
	if($(now).find('input[type="checkbox"]').prop('checked') == true){
		$(now).find('.cr-icon').removeClass('remove');
		$(now).find('.cr-icon').addClass('add');
	}else{
		$(now).find('.cr-icon').removeClass('add');
		$(now).find('.cr-icon').addClass('remove');
	}
}
function decrease_val(){
	var value=$('.quantity-field').val();
	if(value > 1){
		var value=--value;
	}
	$('.quantity-field').val(value);
}
function increase_val(){
	var value=$('.quantity-field').val();
	var max_val =parseInt($('.quantity-field').attr('max'));
	if(value < max_val){
		var value=++value;
	}
	$('.quantity-field').val(value);
}
</script>
