    <?php
$vendor_id =json_decode( $pro['added_by']);
$id = $vendor_id->id;
$vendor = $this->db->where('vendor_id', $id)->get('vendor')->row_array();
$cat = 0;
$cats = explode(',',$pro['category']);
if(isset($cats[0]))
{
    $cat = $this->db->where('category_id', $cats[0])->get('category')->row_array();
}
// get product
$n = $this->db->where('product_id',$vendor['bpage'])->where('is_bpage',1)->get('product')->row_array();
$slug = '';
if(isset($n['slug']))
{
    $slug = $n['slug'];
}
// get product
$t = $vendor['create_timestamp'];
$date = date('F-d-Y', $t);
// var_dump();
if($n['comp_logo'])
                        {
                            $vendorlogo = $this->crud_model->get_img($n['comp_logo']);
                            if(isset($vendorlogo->secure_url))
                            {
                                $vendorlogo = $vendorlogo->secure_url;
                            }

                        }
                        else
                        {
                            $vendorlogo = $this->crud_model->file_view('product',$product_id,'','','thumb','src','multi','one');

                        }    
    ?>
    <!--NEW-->
    <div class="agent-inner">
                    <div class="agent-title">
                      <div class="agent-photo">
                        <a href="<?= base_url($slug); ?>"><img src="<?= $vendorlogo?>" alt=""></a>
                      </div>
                      <div class="agent-details">
                        <h3><a href="#"><?= $n['title']; ?></a></h3>
                      </div>
                    </div>
            <?php
            if(isset($cat['category_name']) && $cat['category_name'])
            {
                ?>
            <div class="contact-box">
                      <i class="fa-solid fa-check-to-slot"></i><a href="#"><?= $cat['category_name']; ?></a>
                    </div>
            <?php
            }
            ?>
            <?php
            if(isset($vendor['address1']) && $vendor['address1'])
            {
                ?>
            <div class="contact-box">
                      <i class="fa fa-clock"></i><a href="#"><?= date("d-m-Y", strtotime($pro['create_at'])); ?></a>
                    </div>
            <?php
            }
            ?>
            <?php
            if(isset($vendor['address1']) && $vendor['address1'])
            {
                ?>
            <div class="contact-box">
                      <i class="fa fa-location-dot"></i><a href="#"><?= $vendor['address1']; ?></a>
                    </div>
            <?php
            }
            ?>
                    <a href="<?= base_url($slug); ?>#bpage_form" class="contact-agent">Contact</a>
                    <div class="share_icons">
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
                                  $url = base_url($pro['slug']).'?aff='.$aff_code;
                                  else
                                  $url = base_url($pro['slug']);
                                  $link = str_replace('link',$url, $v['share_link']);


                ?>

                <li><a href="<?= $link ?>"><i class="bi <?= $v['icon'] ?>"></i></a></li>

                <?php

                                 }

               }
               ?>
                    </div>
                  </div>