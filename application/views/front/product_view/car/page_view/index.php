<?php
$url = base_url('updated/');
$pro = array();
if(isset($product_data[0]))
{ 
    $pro = $product_data[0];

    
}

?>
<?php
    $additional_fields = json_decode($pro['additional_fields'], true);
    $vid = 0;
    $add_ar = $rr = json_decode($pro['added_by'],true);
    if($rr['type'] == 'vendor')
    {
      $vid = $rr['id'];
    }
    $vendor = $this->db->where('vendor_id',$vid)->get('vendor')->row();

    $names = array();
    $valus = array();
    if(isset($additional_fields['name']) && $additional_fields['name'])
    {
        $names = json_decode($additional_fields['name'],true);
        $valus = json_decode($additional_fields['value'],true);
    }
    if($valus && $names)
    {
        $col1= array();
        $col2= array();
        $i = 1;
        $lim = 30;
        $accor = array();
        foreach($names as $k=> $v)
        {
            if(strlen($valus[$k]) > $lim)
            {
                $accor[$v] = $valus[$k];
            }
            else
            {
            $i++;
            
            if($i%2 == 0)
            {
                if($valus[$k])
                $col1[$v] = $valus[$k];
            }
            else
            {
                if($valus[$k])
                $col2[$v] = $valus[$k];
            }
            }
        }
    }
        
    ?>
<main>
    <div class="ads-details">
      <div class="container">
        <div class="row">
          <div class="col-lg-9 col-md-12 order-lg-1">
              <?php
              echo $this->load->view('front/flash',array(),true);
              ?>
            <div class="ads-single-wrapper">
              <?php
              include "slider.php";
              ?>
            </div>
          </div>
          <div class="col-lg-3 col-md-12 order-lg-2">
             
            <div class="seller-info-wrapper">
              <aside class="details-sidebar">
                <div class="widget" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="0">
                  <h4 class="widget-title">Ad Posted By
                   <a class="wishlist heart_icon" style="float:right;" href="<?= base_url('home/wishlist/add/'.$pro['product_id']) ?>"><i class="bi bi-heart"></i></a>
                   <span class="" onclick="share_icon(<?=$pro['product_id']?>)"><i class="fas fa-share"></i></span>
                  </h4>
                 
                  <?php
                  $this->load->view('user',array('pro'=>$pro));
                  ?>
                </div>
    
                <div class="widget" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
                  <h4 class="widget-title">Our Location</h4>
                  <div class="map-wrapper">
                    <iframe src="https://www.google.com/maps/embed/v1/view?key=<?= $this->config->item('map_key'); ?>&center=<?= $pro['lat'] ?>,<?= $pro['lng'] ?>&zoom=12" width="100%" height="250" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                  </div>
                </div>
  
              </aside>
            </div>
          </div>
          
          <?php
         
          include 'order3.php';
          ?>
          
      </div>
    </div>
    <?php
        include "form_and_map.php";
    ?>
  </main>