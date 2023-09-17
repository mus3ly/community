<?php


$url = base_url('updated/');
 include "header_new.php";
?>
<main>
    <section class="pricing-offer">
      <div class="container">
          <?php
                $error = $this->session->flashdata('error');
                if($error)
                {
                    // 
                    ?>
                    <div class="alert alert-danger" role="alert">
  <?= $error; ?>
</div>
                    <?php
                }

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
                    $this->db->order_by("sort", "asc");

                      $pkg = $this->db->where('mcat', $v['id'])->get('membership')->result_array();
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
                          ?>
                <div class="col-md-4 col-sm-6">
                  <div class="pricingTable <?= $cls ?>" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                      <div class="discount-badge">
                      <div class="badge-circle">
                        <p>Save <span class="discount"><?= $v['discount']; ?></span></p>
                      </div>
                    </div>
                    <div class="pricingTable-header">
                      <i class="fa fa-adjust"></i>
                      <div class="price-value"> £<?= $v['price'] ?>  </div>
                    </div>
                    <h3 class="heading"><?= $v['title'] ?></h3>
                    <div class="pricing-content">
                      <ul>
                        <li>Dynamic Business Page</li>
                        <li>Shopping Cart</li>
                        <li><b><?= $v['product_limit'] ?></b>Advertisement Pages</li>
                        <li>Directory Listings</li>
                      </ul>
                    </div>
                    <div class="pricingTable-signup">
                      <a href="<?= base_url('vendor_logup/registration'); ?>?pack=<?= $v['membership_id'] ?>">sign up</a>
                    </div>
                  </div>
                </div>
                <?php
                
                        }
                ?>
              </div>
            </div>
          </div>
                      <?php
                        }
                      ?>
        </div>
        <div class="coupon-wrap">
          <div class="row align-items-center">
            <div class="col-md-6">
              <div class="form-side">
                <form action="<?=base_url()?>home/vendor_signup_promo" method="POST">
                  <div class="form-group">
                    <div class="input-group">
                      <input type="text" class="form-control" placeholder="Add Promo Code"  name="promo_code" aria-label="Add Promo Code"
                        aria-describedby="button-addon2">
                      <button class="btn btn-outline-secondary" type="button" id="button-addon2">Add Coupon</button>
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
                      <button class="btn btn-outline-secondary" type="button" id="button-addon2">Add Code</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <div class="col-md-6">
              <div class="skip-btn">
                <a href="#" class="skip primary-btn">Skip And Continue</a>
              </div>
            </div>
          </div>
        </div>
      </div>

    </section>
  </main>
<?php
 include "footer_new.php";
?>
