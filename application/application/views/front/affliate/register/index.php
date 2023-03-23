<style>
    .ellipse{display:none;}
</style>


<link href="<?= base_url() ?>/template/back/plugins/chosen/chosen.min.css" rel="stylesheet">
<div class="menulogin">
<ul>
    <li><a href="#">Customer Login</a></li>
    <li><a href="#">Customer Sign-up</a></li>
    <li><a href="#">Vendor Login </a></li>
    <li><a href="#">Vender Sign-up</a></li>
    <li><a href="#">Affiliate Marketer Login</a></li>
    <li><a href="#">Affiliate Marketer Signup</a></li>
    <li><a href="#">Affiliate Vendor Login</a></li>
    <li><a href="#">Affiliate Vendor Signup </a></li>
</ul>
<</div>
<section class="page-section color get_into">
    <div class="container">
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
                  <div class="title"  style="width: 100%;">
                      <?php echo translate('customer_registration');?>
                  <!--      <div class="option">-->
                  <!--    	<?php echo translate('already_a_member_?_click_to_');?>-->
                  <!--      <?php-->
			               <!--      if ($this->crud_model->get_type_name_by_id('general_settings','58','value') !== 'ok') { ?>-->
                  <!--            <a href="<?php echo base_url(); ?>login_set/login">-->
                  <!--                <?php echo translate('login');?>!-->
                  <!--            </a>-->
                  <!--      <?php-->
									         <!--}-->
                  <!--         else { ?>-->
                  <!--              <a href="<?php echo base_url(); ?>login_set/login">-->
                  <!--                  <?php echo translate('login');?>! <?php echo translate('as_customer');?>-->
                  <!--              </a>-->
                  <!--            <?php echo translate('_or_');?>-->
                  <!--              <a href="<?php echo base_url(); ?>vendor_logup/registration">-->
                  <!--                  <?php echo translate('sign_up');?>! <?php echo translate('as_vendor');?>-->
                  <!--              </a>-->
                  <!--            <?php-->
          								<!--	}-->
          								<!--?>-->
                  <!--      </div>-->
                  <div class="login_info">
                                    <p>Please include the texts also to help user understand how to navigate this section: Join Community HubLand or Login to your account as a Business or as a Customer. With a Business Account… more ( when more is clicked, it should show the rest of the texts which are: you can access all tools to list your ads,<a href="#">read more</a> </p>
                                    <div class="hovertext"><p>  create your own affiliate marketing portal to encourage affiliate marketers to market your business, bookmark your favourite listings, comment and more) With a Customer account… more (on click: you can bookmark your favourite businesses, comment in discussions and leave reviews) … - When they click Business Login or Business Sign-up, the text for business above should be on top of the form - When they click Customer Login or Customer Sign-up, the text for customer above should be on top of the form - Either form should have the other login and signup options available for them to change their mind and select another option ….. When the click on either of the affiliate logins or sign-ups the same follows and the texts are: - A Marketing Affiliate Account to will provide you options to earn as you share businesses on your social media accounts. Anyone joining Community HubLand or purchasing from businesses on Community HubLand via your shared links will provide you respective commissions from Community HubLand and/or the business purchase - A Business Affiliate Account will provide you a platform to host your marketing materials that affiliate marketers can access to share on the social media platforms. You can determine how much commission your affiliate marketers will earn.</p></div>
                                </div>
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
                                <label>Country</label>
                                <?php echo $this->crud_model->select_html('countries','country','name','edit','form-control demo-chosen-select required select_country',$country,'',NULL,'select_country'); ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>State</label>
                                <span id="stats_select" class="col-md-12">
                                <input type="text" class="form-control required" name="state" />
                                </span>
                            </div>
                        </div>
                        <div class="col-md-12">
                        <div class="col-md-6" style="padding-left:0;">
                            <div class="form-group">
                                <label>City</label>
                                <input class="form-control required" name="city" type="text" placeholder="<?php echo translate('city');?>" data-toggle="tooltip" title="<?php echo translate('city');?>">
                            </div>
                        </div>
                        <div class="col-md-6" style="margin-top:0px">
                            <div class="form-group">
                                <label>Zip code</label>
                                <input class="form-control required" name="zip" type="text" placeholder="<?php echo translate('zip');?>" data-toggle="tooltip" title="<?php echo translate('zip');?>">
                            </div>
                        </div>
                        </div>
                      <div class="col-md-12 terms">
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
                            <span class="btn btn-theme-sm btn-block btn-theme-dark pull-right logup_btn" data-ing='<?php echo translate('registering..'); ?>' data-msg="">
                                <?php echo translate('register');?>
                            </span>
                        </div>

                        <!--- Facebook and google login -->
                        <?php
                          if($fb_login_set == 'ok' || $g_login_set == 'ok'){ ?>
                            <div class="col-md-12 col-lg-12">
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
</script>
