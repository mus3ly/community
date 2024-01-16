<?php


$url = base_url('updated/');
 include "header_new.php";
?>
 <style>
    .error {
      color: #F26122;
    }
  </style>
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
          <div class="flash">
          <?php
          $reg_user = array();
          if(isset($_SESSION['reg_user']))
          {
              $reg_user = $_SESSION['reg_user'];
          }
          include "flash.php";
          ?>
          </div>
          <form action="<?= base_url('home/registration/add_info');?>" method="POST" id="sign_form" class="form-login">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group mb-3">
                  <input type="text" class="form-control" placeholder="First Name" value="<?= (isset($reg_user['username'])?$reg_user['username']:null) ?>" name="username">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-3">
                  <input type="text" class="form-control" placeholder="Last Name" value="<?= (isset($reg_user['surname'])?$reg_user['surname']:null) ?>"  name="surname">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-3">
                  <input type="email" class="form-control" placeholder="Email"  value="<?= (isset($reg_user['email'])?$reg_user['email']:null) ?>" name="email">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-3">
                  <input type="text" class="form-control" placeholder="Phone"  value="<?= (isset($reg_user['phone'])?$reg_user['phone']:null) ?>" name="phone">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-3">
                  <input type="password" class="form-control" placeholder="Password"  value="<?= (isset($reg_user['password1'])?$reg_user['password1']:null) ?>" name="password1" id="password">
                   <small id="passwordError" class="error"></small>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-3">
                  <input type="password" class="form-control" placeholder="Confirm Password"  value="<?= (isset($reg_user['password2'])?$reg_user['password2']:null) ?>" name="password2"  id="confirmPassword">
                   <small id="confirmPasswordError" class="error"></small>
                </div>
              </div>
              
              <div class="col-md-12">
                <div class="form-group mb-3">
                  <?php echo $this->crud_model->select_html('countries','country','name','edit','demo-chosen-select form-control  select_country',$reg_user['country'],'',NULL,'select_country'); ?>
                                        <input type="text" name="country-old" value="<?php echo 
                                        $row['country']; ?>" id="demo-hor-4" class="form-control address d-none hidden" onblur="set_cart_map('iio');">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-3"  id="stats_select1">
                  <input type="text" placeholder="<?= translate('state'); ?>" class="form-control"  value="<?= (isset($reg_user['state'])?$reg_user['state']:null) ?>" name="state">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-3" id="city_select1">
                  <input type="text" class="form-control" placeholder="<?= translate('city'); ?>"  value="<?= (isset($reg_user['city'])?$reg_user['city']:null) ?>" name="city">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-3">
                  <input type="text" class="form-control" placeholder="Zip Code"  value="<?= (isset($reg_user['zip'])?$reg_user['zip']:null) ?>" name="zip">
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group mb-3">
                  <input type="text" class="form-control" placeholder="Address"  value="<?= (isset($reg_user['address1'])?$reg_user['address1']:null) ?>" name="address1">
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
                  <button type="submit" class="primary-btn signup_btn" loading='<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>
Submiting ...' id="registerbtn">Register</button>
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
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  <script type="text/javascript">
  function other(){
        $('.demo-chosen-select').select2({
  selectOnClose: true
});
        $('.chosen-with-drop').css({width:'100%'});
    }
      function select_country1(id,state)
    {
        
        $('#stats_select').hide('slow');
        ajax_load(base_url+'vendor/get_state/'+id+'/'+state,'stats_select','other');
        // other();
        // var cont = $('.select_country').val();
        // var mid= '.count_'+cont;
        // $('.states').hide();
        // alert(mid);
        // $(mid).show();
        //$('.demo-chosen-select').select2();
    }
      function select_country(id)
    {
        
        $('#stats_select').hide('slow');
        ajax_load(base_url+'vendor/get_state/'+id,'stats_select','other');
        // other();
        // var cont = $('.select_country').val();
        // var mid= '.count_'+cont;
        // $('.states').hide();
        // alert(mid);
        // $(mid).show();
        //$('.demo-chosen-select').select2();
    }
    function select_state(id)
    {
        $('#city_select').hide('slow');
        ajax_load(base_url+'vendor/get_city/'+id,'city_select','other');
        // var cont = $('.select_country').val();
        // var mid= '.count_'+cont;
        // $('.states').hide();
        // alert(mid);
        // $(mid).show();
        // $('.demo-chosen-select').select2();
    }
    function select_state1(id,val)
    {
        $('#city_select').hide('slow');
        ajax_load(base_url+'vendor/get_city/'+id+'/'+val,'city_select','other');
        // var cont = $('.select_country').val();
        // var mid= '.count_'+cont;
        // $('.states').hide();
        // alert(mid);
        // $(mid).show();
        // $('.demo-chosen-select').select2();
    }
    $(document).ready(function(){
        // other();
        // $('.demo-chosen-select').select2();
        <?php
        if(isset($reg_user['country']) && $reg_user['country'])
        {
        ?>
        select_country1('<?= $reg_user['country'] ?>','<?= (isset($reg_user['state'])?$reg_user['state']:0) ?>');
        <?php
        }
        if(isset($reg_user['state']) && $reg_user['state'])
        {
        ?>
        select_state1('<?= $reg_user['state'] ?>','<?= (isset($reg_user['city'])?$reg_user['city']:0) ?>');
        <?php
        }
        ?>
    });
  </script>
<?php
 include "footer_new.php";
?>
 