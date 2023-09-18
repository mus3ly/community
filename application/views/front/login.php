<?php


$url = base_url('updated/');
 include "header_new.php";
?>
<main>
    <section class="signup-form-wrapper">
      <div class="container">
        <div class="page-links">
          <a href="#" class="active">Customer Login</a>
          <span class="text-divider"></span>
          <a href="#">Customer Registration</a>
          <span class="text-divider"></span>
          <a href="#">Vendor Login</a>
          <span class="text-divider"></span>
          <a href="#">Vendor Registration</a>
        </div>
        <div class="forms">
          <!-- Customer login form -->
          <h2 class="form-title">Customer Login</h2>
          <p class="form-subtitle">If you are not yet an affiliate marketer for Community HubLand,you can join from your backend after login to start earning up to 30% commisions on sign-up's and sales. <a href="#">read more</a></p>
          <form action="<?= base_url('home/login/do_login'); ?>" method="post">
            <div class="row">
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
              <div class="col-md-12">
                <div class="form-group mb-3">
                  <input type="email" name="email" class="form-control" placeholder="Your Email">
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group mb-3">
                  <input type="password" name="password" class="form-control" placeholder="*****">
                  <div class="additional-item"><a href="#">Forgot Password?</a></div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group mb-3">
                  <input type="submit" class="primary-btn" value="Login">
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
