<?php


$url = base_url('updated/');
 include "header_new.php";
?>
<main>
    <section class="signup-form-wrapper">
      <div class="container">
        <div class="page-links">
          <a href="<?=base_url('login_set/login')?>" class="active">Customer Login</a>
          <span class="text-divider"></span>
          <a href="<?=base_url('home/login_set/registration')?>" >Customer Registration</a>
          <span class="text-divider"></span>
          <a href="<?=base_url('vendor')?>">Vendor Login</a>
          <span class="text-divider"></span>
          <a href="<?=base_url('vendor_logup/registration')?>">Vendor Registration</a>
        </div>
        <div class="forms">
          <!-- Customer login form -->
          <h2 class="form-title">Customer Login</h2>
          <p class="form-subtitle">If you are not yet an affiliate marketer for Community HubLand,you can join from your backend after login to start earning up to 30% commisions on sign-up's and sales. <a href="#">read more</a></p>
                    <div class="flash">
          <?php
          $reg_user = array();
          if(isset($_SESSION['login_user']))
          {
              $reg_user = $_SESSION['login_user'];
          }
          include "flash.php";
          ?>
          </div>
          <form action="<?= base_url('home/login/do_login'); ?>" id="login_form" method="post" style="display:<?= isset($_SESSION['forget_error'])?'none':'block'; ?>">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group mb-3">
                  <input type="email" name="email" class="form-control" placeholder="Your Email">
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group mb-3">
                  <input type="password" name="password" class="form-control" placeholder="*****">
                  <div class="additional-item"><a href="#" onClick="set_html('login_form','forget_form')">Forgot Password?</a></div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group mb-3">
                <button type="submit" class="primary-btn signup_btn" loading='<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>
Submiting ...' id="registerbtn">Login</button>
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
          <form action="<?= base_url('home/login/forget'); ?>" id="forget_form" method="post" style="display:<?= isset($_SESSION['forget_error'])?'block':'none'; ?>">
              <?php
              if(isset($_SESSION['forget_error']))
              {
                  unset($_SESSION['forget_error']);
              }
              ?>
                <div class="row box_shape">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <input class="form-control" type="email" name="email" placeholder="<?php echo translate('email_address');?>">
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right">
                            <span class="forgot-password pull-left" style="cursor:pointer;" onClick="set_html('forget_form','login_form')">
                                <?php echo translate('login');?>
                            </span>
                        <button type="submit" class="primary-btn signup_btn" loading='<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>
Submiting ...' id="registerbtn">
                                <?php echo translate('submit');?>
                            </button>
                    </div>
                </div>
                </form>
        </div>
      </div>
    </section>
  </main>
  <script>
    function set_html(hide,show){
        $('#'+show).show('fast');
        $('#'+hide).hide('fast');
    }
</script>
<?php
 include "footer_new.php";
?>
