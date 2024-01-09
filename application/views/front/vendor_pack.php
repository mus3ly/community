<?php


$url = base_url('updated/');
 include "header_new.php";
?>
<main>
    <section class="pricing-offer">
      <div class="container">
          <?php
                include 'flash.php';

                ?>
        <ul class="nav nav-pills mb-3" id="pricing-table" role="tablist" data-aos="fade-up" data-aos-duration="1000"
          data-aos-delay="0">
              <?php
                        /*foreach($cat as $k => $v){
                            $nav = str_replace(' ','', $v['name']);
                        ?>
                      <a class="nav-item nav-link <?= (!$k)?"active":"";?>" id="<?= $v['id']; ?>" data-toggle="tab" href="#tab<?= $k; ?>" role="tab" aria-controls="nav-<?php echo $nav; ?>" aria-selected="true"><?php echo $v['name']; ?></a>
                      <?php
                        }*/
                      ?>
                        <?php
                        foreach($cat as $k => $v){
                            $nav = str_replace(' ','', $v['name']);
                        ?>
                        <li class="nav-item" role="presentation">
            <button class="nav-link <?= (!$k)?"active":"";?>" id="tab<?= $k; ?>-tab" data-bs-toggle="pill" data-bs-target="#tab<?= $k; ?>"
              type="button" role="tab" aria-controls="tab<?= $k; ?>" aria-selected="true"><?php echo $v['name']; ?></button>
          </li>
                      <?php
                        }
                      ?>
        </ul>
          <div class="coupon-wrap">
              <div class="row align-items-center">
                  <div class="col-md-6">
                      <div class="form-side">
                          <form action="<?=base_url()?>home/vendor_signup_promo" method="POST">
                              <div class="form-group">
                                  <div class="input-group">
                                      <input type="text" class="form-control" placeholder="Add Promo Code"  name="promo_code" aria-label="Add Promo Code"
                                             aria-describedby="button-addon2">
                                      <button class="btn btn-outline-secondary" type="submit" id="button-addon3">Add Promo Code</button>
                                  </div>
                              </div>
                          </form>
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="form-side">
                          <form action="<?=base_url()?>/vendor_logup/registration" method="GET">
                              <div class="form-group">
                                  <div class="input-group">
                                      <input type="text" class="form-control" placeholder="Add Referal Code"  name="ref_code" aria-label="Add Referal Code"
                                             aria-describedby="button-addon2">
                                      <button class="btn btn-outline-secondary" type="submit" id="button-addon4">Add Referal Code</button>
                                  </div>
                              </div>
                          </form>
                      </div>
                  </div>

              </div>
          </div>
          <div class="coupon-wrap">We are in <b>beta phase</b>. Sign-up at these low fees and become <b>Community HubLand’s First-time Settlers</b>. The first 1000 sign-ups gets to <b>keep these low fees forever!</b></div>
        <div class="tab-content" id="pricing-tableContent">
            <?php
                        foreach($cat as $k => $v){
                            $nav = str_replace(' ','', $v['name']);
                        ?>
          <div class="tab-pane fade show <?= (!$k)?"active":"";?>" id="tab<?= $k; ?>" role="tabpanel" aria-labelledby="tab<?= $k; ?>-tab"
            tabindex="<?= $k; ?>">
            <div class="price-boxes-wrap">
              <div class="row">
                  <?php
                       if($_GET['ref_code'] == '1stCHL')
                {
                    $admin_special = 1;
                }
                    $this->db->order_by("sort", "asc");
                    
                        $this->db->where('admin_special',0);
                      $pkg = $this->db->where('promo_check',0)->where('mcat', $v['id'])->get('membership')->result_array();
                      if(isset($ref) && $ref)
                      {
                          if(isset($admin_special))
                            {
                                $this->db->where('admin_special',1);
                            }
                          $pkg = $this->db->where('promo_check',1)->where('mcat', $v['id'])->get('membership')->result_array();
                      }
                 
                        foreach ($pkg as $k => $v) {
                            $cls = '';
                            if($k == 1)
                            {
                                $cls = 'green';
                            }
                            elseif($k == 2)
                            {
                                $cls = 'blue';
                            }
                            elseif($k == 3)
                            {
                                $cls = 'yellow';
                            }
                            if(!isset($admin_special) && !$v['admin_special'])
                            {
                          ?>
                <div class="col-md-3 col-sm-6">
                  <div class="pricingTable <?= $cls ?>" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                      <?php
                      if($v['discount'] > 0)
                          {
                              ?>
                      <div class="discount-badge">
                      <div class="badge-circle">
                        <p>Save <span class="discount"><?= $v['discount']; ?></span></p>
                      </div>
                    </div>
                              <?php
                          }
                      ?>
                    <div class="pricingTable-header">
                      <i class="fa fa-adjust"></i>
                      <div class="price-value"> £<?= $v['price'] ?>  </div>
                    </div>
                    <h3 class="heading"><?= $v['title'] ?></h3>
                    <div class="pricing-content">
                      <ul>
                        <li><b>1</b> Business Hub-site</li>
                        <li>Shopping Display & Cart (Beta)</li>
                        <li><b><?= $v['product_limit'] ?></b> Ad Web Pages</li>
                        <li>Automatic Directory Listings</li>
                      </ul>
                    </div>
                    <div class="pricingTable-signup">
                      <a href="<?= base_url('vendor_logup/registration'); ?>?pack=<?= $v['membership_id'] ?><?= (isset($_GET['ref_code']) && $_GET['ref_code'])?'&ref_code='.$_GET['ref_code']:''; ?>">sign up</a>
                    </div>
                  </div>
                </div>
                <?php
                
                        }
                        elseif(isset($admin_special) &&  $v['admin_special'])
                        {
                            ?>
                            <div class="col-md-3 col-sm-6">
                  <div class="pricingTable <?= $cls ?>" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                      <?php
                      if($v['discount'] > 0)
                          {
                              ?>
                      <div class="discount-badge">
                      <div class="badge-circle">
                        <p>Save <span class="discount"><?= $v['discount']; ?></span></p>
                      </div>
                    </div>
                              <?php
                          }
                      ?>
                    <div class="pricingTable-header">
                      <i class="fa fa-adjust"></i>
                      <div class="price-value"> £<?= $v['price'] ?>  </div>
                    </div>
                    <h3 class="heading"><?= $v['title'] ?></h3>
                    <div class="pricing-content">
                      <ul>
                        <li><b>1</b> Business Hub-site</li>
                        <li>Shopping Display & Cart (Beta)</li>
                        <li><b><?= $v['product_limit'] ?></b> Ad Web Pages</li>
                        <li>Automatic Directory Listings</li>
                      </ul>
                    </div>
                    <div class="pricingTable-signup">
                      <a href="<?= base_url('vendor_logup/registration'); ?>?pack=<?= $v['membership_id'] ?><?= (isset($_GET['ref_code']) && $_GET['ref_code'])?'&ref_code='.$_GET['ref_code']:''; ?>">sign up</a>
                    </div>
                  </div>
                </div>
                            <?php
                        }
                        }
                ?>
              </div>
            </div>
          </div>
                      <?php
                        }
                      ?>
        </div>

      </div>

    </section>
  </main>
<?php
 include "footer_new.php";
?>
