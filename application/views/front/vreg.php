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
          <a href="<?=base_url('login_set/login')?>" >Customer Login</a>
          <span class="text-divider"></span>
          <a href="<?=base_url('home/login_set/registration')?>" >Customer Registration</a>
          <span class="text-divider"></span>
          <a href="<?=base_url('vendor')?>">Vendor Login</a>
          <span class="text-divider"></span>
          <a href="<?=base_url('vendor_logup/registration')?>" class="active">Vendor Registration</a>
        </div>
        <div class="forms vendor-form">
          
          <!-- Customer login form -->
          <h2 class="form-title">Vendor Registration</h2>
          <p class="form-subtitle">Are you a Business? Got an idea to share with your community? Join Community HubLand
            as a vendor, or login to leave own a business page and post ads to different categories. Join Community
            HubLand affiliate marketing to advertise your own marketing campaings.</p>
              <div class="flash">
          <?php
            include "flash.php";
            $reg_ven = array();
            if(isset($_GET['promo']))
            {
                $promo = $_GET['promo'];
            }
            if(isset($_SESSION['reg_ven']))
            {
                $reg_ven = $_SESSION['reg_ven'];
            }
            // var_dump($re/g_ven);
          ?>
          </div>
          <form action="<?= base_url( 'home/vendor_logup/add_info/')?>" method="POST" class="form-login" id="sign_form" >
              <?php
              if(isset($_GET['pack']))
              {
                  ?>
                  <input type="hidden" name="pack" value="<?= $_GET['pack'] ?>">
                  <?php
              }
              ?>
              <?php
              if(isset($pack))
              {
                  ?>
                  <input type="hidden" name="pack" value="<?= $pack ?>">
                  <?php
              }
              if(isset($reg_ven['pack']))
              {
                  ?>
                  <input type="hidden" name="pack" value="<?= $reg_ven['pack'] ?>">
                  <?php
              }
              ?>
              
              <input type="hidden" name="ref_code" value="<?= $_GET['ref_code'] ?>">
              <?php
              if(isset($reg_ven['ref_code']))
              {
                  ?>
                  <input type="hidden" name="ref_code" value="<?= $reg_ven['ref_code'] ?>">
                  <?php
              }
              ?>
              <input type="hidden" name="promo" value="<?= $promo ?>">
              <?php
              if(isset($reg_ven['promo']) && $reg_ven['promo'])
              {
                  ?>
                  <input type="hidden" name="promo" value="<?= $reg_ven['promo'] ?>">
                  <?php
              }
              ?>
            <div class="row">
              <div class="col-md-6 col-lg-4">
                <div class="form-group mb-3">
                  <input type="text" class="form-control" placeholder="First Name" value="<?= (isset($reg_ven['name'])?$reg_ven['name']:'') ?>" name="name">
                </div>
              </div>
              <div class="col-md-6 col-lg-4">
                <div class="form-group mb-3">
                  <input type="text" class="form-control" placeholder="Middle Name"  value="<?= (isset($reg_ven['middle_name'])?$reg_ven['middle_name']:'') ?>" name="middle_name" >
                </div>
              </div>
              <div class="col-md-6 col-lg-4">
                <div class="form-group mb-3">
                  <input type="text" class="form-control" placeholder="Last Name" value="<?= (isset($reg_ven['last_name'])?$reg_ven['last_name']:'') ?>" name="last_name">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-3">
                  <input type="text" class="form-control" placeholder="Business Name" value="<?= (isset($reg_ven['company'])?$reg_ven['company']:'') ?>" name="company">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-3">
                  <input type="email" class="form-control" placeholder="Email" value="<?= (isset($reg_ven['email'])?$reg_ven['email']:'') ?>" name="email">
                </div>
              </div>
              <div class="col-md-6 col-lg-4">
                <div class="form-group mb-3">
                  <input type="number" class="form-control" placeholder="Phone" value="<?= (isset($reg_ven['phone'])?$reg_ven['phone']:'') ?>" name="phone">
                </div>
              </div>
              <div class="col-md-6 col-lg-4">
                <div class="form-group mb-3">
                  <input type="password" class="form-control" placeholder="Password" name="password1" value="<?= (isset($reg_ven['password1'])?$reg_ven['password1']:'') ?>" id="password">
                   <small id="passwordError" class="error"></small>
                </div>
              </div>
              <div class="col-md-6 col-lg-4">
                <div class="form-group mb-3">
                  <input type="password" class="form-control" placeholder="Confirm Password" value="<?= (isset($reg_ven['password2'])?$reg_ven['password2']:'') ?>" name="password2" id="confirmPassword">
                   <small id="confirmPasswordError" class="error"></small>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-3">
                  <input type="text" class="form-control" placeholder="Address 1" value="<?= (isset($reg_ven['address1'])?$reg_ven['address1']:'') ?>" name="address1">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-3">
                  <input type="text" class="form-control" placeholder="Address 2" value="<?= (isset($reg_ven['address2'])?$reg_ven['address2']:'') ?>" name="address2">
                </div>
              </div>
              <div class="col-md-6 col-lg-4">
                <div class="form-group mb-3">
                  <div class="custom-select-box">
                    <?php echo $this->crud_model->select_html('category','buss_type','category_name','signup_cat','demo-chosen-select form-control required',$reg_ven['buss_type'],NULL,''); ?>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-lg-4">
                <div class="form-group mb-3">
                  <div class="custom-select-box">
                                                        <?php echo $this->crud_model->select_html('category','sub_category','category_name','signup_main_cat','demo-chosen-select form-control required',$reg_ven['sub_category'],NULL,''); ?>

                  </div>
                </div>
              </div>
              <div class="col-md-6 col-lg-4">
                <div class="form-group mb-3">
                  <div class="custom-select-box">
                                                        <?php echo $this->crud_model->select_html('category','sub3_category','category_name','ind_main_cat','demo-chosen-select form-control required',$reg_ven['sub3_category'],NULL,''); ?>

                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group mb-3">
                  <?php echo $this->crud_model->select_html('countries','country','name','edit','demo-chosen-select form-control  select_country',$reg_ven['country'],'',NULL,'select_country'); ?>
                                        <input type="text" name="country-old" value="<?php echo 
                                        $row['country']; ?>" id="demo-hor-4" class="form-control address d-none hidden" onblur="set_cart_map('iio');">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-3"  id="stats_select1">
                    <input type="text" class="form-control" placeholder="<?= translate('state'); ?>" value="<?= (isset($reg_ven['state'])?$reg_ven['state']:null) ?>" name="state" />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-3" id="city_select1">
                    <input type="text" class="form-control" placeholder="<?= translate('city'); ?>" value="<?= (isset($reg_ven['city'])?$reg_ven['city']:null) ?>" name="city" />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group mb-3">
                  <input type="text" class="form-control" placeholder="Zip Code"  value="<?= (isset($reg_ven['zip'])?$reg_ven['zip']:null) ?>" name="zip">
                </div>
              </div>
              <div class="col-md-12 col-lg-12">
                <div class="form-group mb-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="1" id="affiliate" name="affiliate" <?= (isset($reg_ven['affiliate']) && $reg_ven['affiliate'])?'checked':null; ?>>
                    <label class="form-check-label" for="flexCheckDefault">
                      Join Affiliates
                    </label>
                  </div>
                  <div class="form-check" id="aff_term" style="display:<?= (isset($reg_ven['affiliate']) && $reg_ven['affiliate'])?"block":"none" ?>;">
                    <input class="form-check-input" type="checkbox" value="ok" id="flexCheckChecked"  name="affiliate_terms_check" <?= (isset($reg_ven['affiliate_terms_check']) && $reg_ven['affiliate_terms_check'])?'checked':null; ?>>
                    <label class="form-check-label" for="flexCheckChecked">
                      I Agree With  Affiliates<a href="#">Terms & Conditions</a>
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="ok" id="flexCheckChecked" name="terms_check" <?= (isset($reg_ven['affiliate_terms_check']) && $reg_ven['terms_check'])?'checked':null; ?>>
                    <label class="form-check-label" for="flexCheckChecked">
                      I Agree With <a href="#">Terms & Conditions</a>
                    </label>
                  </div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group mb-3">
                  <button type="submit" class="primary-btn signup_btn" loading='<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>
Submiting ...' id="registerbtn">
                                <?php echo translate('submit');?>
                            </button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </section>
  </main>
  <script type="text/javascript">
                    $("#affiliate").change(function() {
                        if(this.checked) {
        $('#aff_term').show();
    }
    else
    {
        $('#aff_term').hide();
    }
                  
});
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
        if(isset($reg_ven['country']) && $reg_ven['country'])
        {
        ?>
        select_country1('<?= $reg_ven['country'] ?>','<?= (isset($reg_ven['state'])?$reg_ven['state']:0) ?>');
        <?php
        }
        if(isset($reg_ven['state']) && $reg_ven['state'])
        {
        ?>
        select_state1('<?= $reg_ven['state'] ?>','<?= (isset($reg_ven['city'])?$reg_ven['city']:0) ?>');
        <?php
        }
        ?>
    });
  </script>
<?php
 include "footer_new.php";
?>
