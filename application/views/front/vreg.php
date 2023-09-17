<?php


$url = base_url('updated/');
 include "header_new.php";
?>
<main>
    <section class="signup-form-wrapper">
      <div class="container">
        <div class="page-links">
          <a href="#">Customer Login</a>
          <span class="text-divider"></span>
          <a href="#">Customer Registration</a>
          <span class="text-divider"></span>
          <a href="#">Vendor Login</a>
          <span class="text-divider"></span>
          <a href="#" class="active">Vendor Registration</a>
        </div>
        <div class="forms vendor-form">
          <?php
            include "flash.php";
          ?>
          <!-- Customer login form -->
          <h2 class="form-title">Vendor Registration</h2>
          <p class="form-subtitle">Are you a Business? Got an idea to share with your community? Join Community HubLand
            as a vendor, or login to leave own a business page and post ads to different categories. Join Community
            HubLand affiliate marketing to advertise your own marketing campaings.</p>
          <form action="<?= base_url( 'home/vendor_logup/add_info/')?>" method="POST" class="form-login" id="sign_form" >
              <input type="hidden" name="pack" value="<?= $_GET['pack'] ?>">
              <input type="hidden" name="ref_code" value="<?= $_GET['ref_code'] ?>">
            <div class="row">
              <div class="col-md-6 col-lg-4">
                <div class="form-group mb-3">
                  <input type="text" class="form-control" placeholder="First Name" name="name">
                </div>
              </div>
              <div class="col-md-6 col-lg-4">
                <div class="form-group mb-3">
                  <input type="text" class="form-control" placeholder="Middle Name" name="middle_name" >
                </div>
              </div>
              <div class="col-md-6 col-lg-4">
                <div class="form-group mb-3">
                  <input type="text" class="form-control" placeholder="Last Name" name="last_name">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-3">
                  <input type="text" class="form-control" placeholder="Business Name" name="company">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-3">
                  <input type="email" class="form-control" placeholder="Email" name="email">
                </div>
              </div>
              <div class="col-md-6 col-lg-4">
                <div class="form-group mb-3">
                  <input type="text" class="form-control" placeholder="Phone" name="phone">
                </div>
              </div>
              <div class="col-md-6 col-lg-4">
                <div class="form-group mb-3">
                  <input type="password" class="form-control" placeholder="Password" name="password1">
                </div>
              </div>
              <div class="col-md-6 col-lg-4">
                <div class="form-group mb-3">
                  <input type="password" class="form-control" placeholder="Confirm Password" name="password2">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-3">
                  <input type="text" class="form-control" placeholder="Address 1" name="address1">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-3">
                  <input type="text" class="form-control" placeholder="Address 2" name="address2">
                </div>
              </div>
              <div class="col-md-6 col-lg-4">
                <div class="form-group mb-3">
                  <div class="custom-select-box">
                    <select>
                      <option value="">Select option</option>
                      <option value="">Select option</option>
                      <option value="1">One</option>
                      <option value="2">Two</option>
                      <option value="3">Three</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-lg-4">
                <div class="form-group mb-3">
                  <div class="custom-select-box">
                    <select>
                      <option value="">Select option</option>
                      <option value="">Select option</option>
                      <option value="1">One</option>
                      <option value="2">Two</option>
                      <option value="3">Three</option>
                      <option value="4">One</option>
                      <option value="5">Two</option>
                      <option value="6">Three</option>
                      <option value="7">One</option>
                      <option value="8">Two</option>
                      <option value="9">Three</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-lg-4">
                <div class="form-group mb-3">
                  <div class="custom-select-box">
                    <select>
                      <option value="">Select option</option>
                      <option value="">Select option</option>
                      <option value="1">One</option>
                      <option value="2">Two</option>
                      <option value="3">Three</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-3">
                  <input type="text" class="form-control" placeholder="City" name="city" >
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-3">
                  <input type="text" class="form-control" placeholder="State" name="state">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-3">
                  <div class="custom-select-box">
                    <select>
                      <option value="">Select option</option>
                      <option value="">Select option</option>
                      <option value="1">One</option>
                      <option value="2">Two</option>
                      <option value="3">Three</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-3">
                  <input type="text" class="form-control" placeholder="Zip Code" name="zip" >
                </div>
              </div>
              <div class="col-md-12 col-lg-6">
                <div class="form-group mb-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="yes" id="flexCheckDefault" name="affiliate">
                    <label class="form-check-label" for="flexCheckDefault">
                      Join Affiliates
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="ok" id="flexCheckChecked" checked name="terms_check">
                    <label class="form-check-label" for="flexCheckChecked">
                      I Agree With <a href="#">Terms & Conditions</a>
                    </label>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group mb-3">
                  <input type="submit" class="primary-btn" value="Register" id="registerbtn" data-ing='<?php echo translate('registering..'); ?>' data-msg="">
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
