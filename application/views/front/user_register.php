<?php


$url = base_url('updated/');
 include "header_new.php";
?>
<main>
    <section class="signup-form-wrapper">
      <div class="container">
        <div class="page-links">
          <a href="<?=base_url('login_set/login')?>">Customer Login</a>
          <span class="text-divider"></span>
          <a href="<?=base_url('home/login_set/registration')?>" class="active">Customer Registration</a>
          <span class="text-divider"></span>
          <a href="<?=base_url('vendor')?>">Vendor Login</a>
          <span class="text-divider"></span>
          <a href="<?=base_url('vendor_logup/registration')?>">Vendor Registration</a>
        </div>
        <div class="forms">
          <!-- Customer login form -->
          <h2 class="form-title">Customer Registration</h2>
          <p class="form-subtitle">Already A Member ? Click To <a href="#">Login! As Customer</a> Or <a href="#">Sign Up! As Vendor</a></p>
          <?php
          include "flash.php";
          ?>
          <form action="<?= base_url('home/registration/add_info');?>" method="POST" id="sign_form" class="form-login">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group mb-3">
                  <input type="text" class="form-control" placeholder="First Name" name="username">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-3">
                  <input type="text" class="form-control" placeholder="Last Name"  name="surname">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-3">
                  <input type="email" class="form-control" placeholder="Email" name="email">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-3">
                  <input type="text" class="form-control" placeholder="Phone" name="phone">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-3">
                  <input type="password" class="form-control" placeholder="Password" name="password1">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-3">
                  <input type="password" class="form-control" placeholder="Confirm Password" name="password2">
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group mb-3">
                  <input type="text" class="form-control" placeholder="Address" name="address1">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-3">
                  <input type="text" class="form-control" placeholder="City" name="city">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-3">
                  <input type="text" class="form-control" placeholder="State" name="state">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-3">
                  <input type="text" class="form-control" placeholder="Country" name="country">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-3">
                  <input type="text" class="form-control" placeholder="Zip Code" name="zip">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="yes" id="affiliates">
                    <label class="form-check-label" for="affiliates">
                      Join Affiliates
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="ok" id="flexCheckChecked" checked>
                    <label class="form-check-label" for="flexCheckChecked">
                      I Agree With <a href="<?php echo base_url();?>home/legal/terms_conditions" target="_blank">Terms & Conditions</a>
                    </label>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group mb-3">
                  <input type="submit" class="primary-btn" value="Register">
                </div>
              </div>
              <div class="col-md-12">
                <p class="text-center">Or</p>
                <div class="other-btns">
                  <a href="#" class="other-login-btn"><i class="fab fa-facebook"></i> Facebook</a>
                  <a href="#" class="other-login-btn"><i class="fab fa-google"></i> Google</a>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </section>
  </main>
<?php
 include "footer_new.php";
?>
