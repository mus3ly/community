<style>
    .ellipse{display:none;}
</style>
<link href="<?= base_url() ?>/template/back/plugins/chosen/chosen.min.css" rel="stylesheet">
<div class="menulogin">
<ul>
    <li><a href="<?php echo base_url('login_set/login');?>">Customer Login</a></li>
    <li><a href="<?php echo base_url('home/login_set/registration');?>">Customer Sign-up</a></li>
    <li><a href="<?php echo base_url('vendor');?>">Vendor Login </a></li>
    <li><a href="<?php echo base_url('/vendor_logup/registration');?>">Vender Sign-up</a></li>

</ul>
</div>
<section class="page-section color get_into mgn_top_rmv">
    <div class="container">
        <?php
	    if($this->session->flashdata('message'))
	    {
	    ?>
	    <div class="alert alert-success" id="success-alert">
               <button type="button" class="close" data-dismiss="alert">x</button>
               <?= $this->session->flashdata('message');
               unset($_SESSION['message'])
               ?>
            </div>
            <?php
	    }
            ?>
        <div class="row">
            <div class="middleboxregister">
            
				        <?php
                    echo form_open(base_url() . 'home/registration/add_info/', array(
                        'class' => 'form-login',
                        'method' => 'post',
                        'id' => 'sign_form'
                    ));
                    $fb_login_set = $this->crud_model->get_type_name_by_id('general_settings','51','value');
                    $g_login_set = $this->crud_model->get_type_name_by_id('general_settings','52','value');
                ?>
                <div class="row box_shape">
                 <div class="col-md-12 title_header">
                        <?php echo translate('customer_registration');?>
                 </div>
                      <hr>
                      <div class="col-md-6">
                          <div class="form-group">
                              <input class="form-control required" name="username" type="text" placeholder="<?php echo translate('first_name');?>" data-toggle="tooltip" title="<?php echo translate('first_name');?>">
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                              <input class="form-control required" name="surname" type="text" placeholder="<?php echo translate('last_name');?>" data-toggle="tooltip" title="<?php echo translate('last_name');?>">
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                              <input class="form-control emails required" name="email" type="email" placeholder="<?php echo translate('email');?>" data-toggle="tooltip" title="<?php echo translate('email');?>">
                          </div>
                          <div id='email_note'></div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                              <input class="form-control" name="phone" type="text" placeholder="<?php echo translate('phone');?>" data-toggle="tooltip" title="<?php echo translate('phone');?>">
                          </div>
                      </div>

                      <div class="col-md-6">
                          <div class="form-group">
                              <input class="form-control pass1 required" type="password" name="password1" placeholder="<?php echo translate('password');?>" data-toggle="tooltip" title="<?php echo translate('password');?>">
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                              <input class="form-control pass2 required" type="password" name="password2" placeholder="<?php echo translate('confirm_password');?>" data-toggle="tooltip" title="<?php echo translate('confirm_password');?>">
                          </div>
                          <div id='pass_note'></div>
                      </div>
                      <div class="col-md-12">
                          <div class="form-group">
                              <input class="form-control required" name="address1" type="text" placeholder="<?php echo translate('address_line_1');?>" data-toggle="tooltip" title="<?php echo translate('address_line_1');?>">
                          </div>
                      </div>
                      <div class="col-md-12">
                          <div class="form-group">
                              <input class="form-control required" name="address2" type="text" placeholder="<?php echo translate('address_line_2');?>" data-toggle="tooltip" title="<?php echo translate('address_line_2');?>">
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                              <input class="form-control required" type="text" name="city" placeholder="<?php echo translate('city');?>" data-toggle="tooltip" title="<?php echo translate('city');?>">
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                              <input class="form-control required" type="text" name="state" placeholder="<?php echo translate('state');?>" data-toggle="tooltip" title="<?php echo translate('state');?>">
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="form-group">
                              <input class="form-control required" type="text" name="country" placeholder="<?php echo translate('country');?>" data-toggle="tooltip" title="<?php echo translate('country');?>">
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="">
                              <input class="form-control required" name="zip" type="text" placeholder="<?php echo translate('zip');?>" data-toggle="tooltip" title="<?php echo translate('zip');?>">
                          </div>
                      </div>
                      <div class="col-md-12 terms">
                         <input  name="affiliate" type="checkbox" value="yes" id="affiliates">
                          <?php echo translate('Join Affiliates');?>
                          </a>
                      </div>
                      <div class="col-md-12 terms" style="display:none;"  id="affiliate_terms_check" >
                          <input  name="affiliate_terms_check" type="checkbox" value="ok">
                          <?php echo translate('i_agree_with');?>
                          <a href="<?php echo base_url();?>home/page/Affiliates_Terms_Of_Use" target="_blank">
                              <?php echo translate('Affiliates_terms_of_use');?>
                          </a>
                      </div>
                      <div class="col-md-12 terms new_terms">
                          <input  name="terms_check" type="checkbox" value="ok" >
                          <?php echo translate('i_agree_with');?>
                          <a href="<?php echo base_url();?>home/legal/terms_conditions" target="_blank">
                              <?php echo translate('terms_&_conditions');?>
                          </a>
                      </div>
                      <?php
          							if($this->crud_model->get_settings_value('general_settings','captcha_status','value') == 'ok'){ ?>
                          <div class="col-md-12">
                              <div class="outer required">
                                  <div class="form-group">
                                      <?php echo $recaptcha_html; ?>
                                  </div>
                              </div>
                          </div>
                        <?php
							          }
						            ?>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-theme btn-block btn-icon-left facebook">
                                <?php echo translate('register');?>
                            </button>
                        </div>

                        <!--- Facebook and google login -->
                        <?php
                          if($fb_login_set == 'ok' || $g_login_set == 'ok'){ ?>
                            <div class="col-md-12 col-lg-12 login_divider_mrgn">
                                <h2 class="login_divider"><span><?php echo translate('sign_in_with_facebook');?>or</span></h2>
                            </div>
                            <?php if($fb_login_set == 'ok'){ ?>
                                <div class="col-md-12 col-lg-6 <?php if($g_login_set !== 'ok'){ ?>mr_log<?php } ?>">
                                    <?php if (@$user): ?>
                                        <a class="btn btn-theme btn-block btn-icon-left facebook" href="<?= $url ?>">
                                            <i class="fa fa-facebook"></i>
                                            <?php echo translate('sign_in_with_facebook');?>
                                        </a>
                                    <?php else: ?>
                                        <a class="btn btn-theme btn-block btn-icon-left facebook" href="<?= $url ?>">
                                            <i class="fa fa-facebook"></i>
                                            <?php echo translate('sign_in_with_facebook');?>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            <?php }
                            if($g_login_set == 'ok'){ ?>
                                <div class="col-md-12 col-lg-6 <?php if($fb_login_set !== 'ok'){ ?>mr_log<?php } ?>">
                                    <?php if (@$g_user): ?>
                                        <a class="btn btn-theme btn-block btn-icon-left google" style="background:#ce3e26" href="<?= $g_url ?>">
                                            <i class="fa fa-google"></i>
                                            <?php echo translate('sign_in_with_google');?>
                                        </a>
                                   <?php else: ?>
                                        <a class="btn btn-theme btn-block btn-icon-left google" style="background:#ce3e26" href="<?= $g_url ?>">
                                            <i class="fa fa-google"></i>
                                            <?php echo translate('sign_in_with_google');?>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            <?php
                            }
                          }
                        ?>
                         <div class="title title_signup">
                   
                        <div class="option">
                      	<?php echo translate('already_a_member_?_click_to_');?>
                        <?php
			                     if ($this->crud_model->get_type_name_by_id('general_settings','58','value') !== 'ok') { ?>
                              <a href="<?php echo base_url(); ?>home/login_set/login">
                                  <?php echo translate('login');?>!
                              </a>
                        <?php
									         }
                           else { ?>
                                <a href="<?php echo base_url(); ?>home/login_set/login">
                                    <?php echo translate('login');?>! <?php echo translate('as_customer');?>
                                </a>
                              <?php echo translate('_or_');?>
                                <a href="<?php echo base_url(); ?>home/vendor_logup/registration">
                                    <?php echo translate('sign_up');?>! <?php echo translate('as_vendor');?>
                                </a>
                              <?php
          									}
          								?>
                        </div>
                      </div>
                    </div>
            	</form>
            </div>
        </div>
    </div>
</section>
<style>
	.get_into .terms a{
		margin:5px auto;
		font-size: 14px;
		line-height: 24px;
		font-weight: 400;
		color: #00a075;
		cursor:pointer;
		text-decoration:underline;
	}

	.get_into .terms input[type=checkbox] {
		margin:0px;
		width:15px;
		height:15px;
		vertical-align:middle;
	}
</style>
<script type="text/javascript" src="<?= base_url(); ?>/template/back/plugins/chosen/chosen.jquery.min.js" ></script>
<script type="text/javascript">
function other(){
        $('.demo-chosen-select').chosen();
        $('.chosen-with-drop').css({width:'100%'});
    }
    function select_country(id)
    {
        $('#stats_select').hide('slow');
        ajax_load(base_url+'vendor/get_state/'+id,'stats_select','other');
        other();
        // var cont = $('.select_country').val();
        // var mid= '.count_'+cont;
        // $('.states').hide();
        // alert(mid);
        // $(mid).show();
        // $('.demo-chosen-select').chosen();
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
        // $('.demo-chosen-select').chosen();
    }
    $(document ).ready(function() {
        // set_cart_map();
        other();
    });
    $('#affiliates').on('change',function(){
        // alert();
           if($('#affiliates').is(':checked')){
          $('#affiliate_terms_check').show();
        }
        else{
         $('#affiliate_terms_check').hide();
        }
    });
</script>
