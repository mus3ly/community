<?php
$pros = $this->db->where('added_by',$pro['added_by'])->get('product')->result_array();

//galary
$imgs = $this->db->where('pid',$pro['product_id'])->get('product_to_images')->result_array();
$nimgs = array();
if(isset($pro['comp_cover']) && $pro['comp_cover'])
{
$nimgs[] = $this->crud_model->size_img($pro['comp_cover'],500,500);
}
foreach($imgs as $k=> $v)
{
    $nimgs[] = $this->crud_model->size_img($v['img'],500,500);
}
$imgs = $nimgs;
?>
<div class="carousel-outer" >
                <div id="sync1" class="owl-carousel owl-theme">
                    <?php
                    foreach($imgs as $k=> $v)
                    {
                        ?>
                  <div class="item">
                      <a href="<?= $v; ?>" class="lightbox-image" data-fancybox="images" data-caption="">
                        <img src="<?= $v; ?>" alt="">
                      </a>
                  </div>
                  <?php
                    }
                    ?>
                </div>
                
                <div id="sync2"  class="owl-carousel owl-theme">
                    <?php
                    foreach($imgs as $k=> $v)
                    {
                        ?>
                  <div class="item">
                      <img src="<?= $v; ?>" alt="">
                  </div>
                  <?php
                    }
                    ?>
                </div>
              </div>