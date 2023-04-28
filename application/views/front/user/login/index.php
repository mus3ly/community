
<style>
    .ellipse{display:none;}
</style>

<div class="menulogin">
<ul>
    <li><a href="<?php echo base_url('login_set/login');?>">Customer Login</a></li>
    <li><a href="<?php echo base_url('home/login_set/registration');?>">Customer Sign-up</a></li>
    <li><a href="<?php echo base_url('vendor');?>">Vendor Login </a></li>
    <li><a href="<?php echo base_url('/vendor_logup/registration');?>">Vender Sign-up</a></li>

</ul>
</div>

<section class="page-section color get_into">
    <div class="container" id="login">
        <div class="row margin-top-0">
            <div class="middleboxlogin">
              
                <?php
                    echo form_open(base_url() . 'home/login/do_login/', array(
                        'class' => 'form-login',
                        'method' => 'post',
                        'id' => ''
                    ));
                    $fb_login_set = $this->crud_model->get_type_name_by_id('general_settings','51','value');
                    $g_login_set = $this->crud_model->get_type_name_by_id('general_settings','52','value'); ?>

                    <div class="row box_shape">
                        <div class="title" style="width: 100%;">
                            <?php echo translate('sign_in');?>
                            <div class="option">
                            	<?php echo translate('not_a_member_yet_?');?>
                                <a href="<?php echo base_url(); ?>home/login_set/registration">
                                    <?php echo translate('Sign_up_as_customer!');?>
                                    
                                </a>
                                OR
                                <a href="<?php echo base_url(); ?>vendor_logup/registration">
                                    <?php echo translate('Sign_up_for_business!');?>
                                    
                                </a>
                                <div class="login_info">
                                    <p>Are you a guest? Join Community HubLand as a customer, or login to leave reviews and  add to wish list. Join Community HubLand affiliate marketing to earn passively <a href="#">read more</a> </p>
                                    <div class="hovertext"><p>  create your own affiliate marketing portal to encourage affiliate marketers to market your business, bookmark your favourite listings, comment and more) With a Customer account… more (on click: you can bookmark your favourite businesses, comment in discussions and leave reviews) … - When they click Business Login or Business Sign-up, the text for business above should be on top of the form - When they click Customer Login or Customer Sign-up, the text for customer above should be on top of the form - Either form should have the other login and signup options available for them to change their mind and select another option ….. When the click on either of the affiliate logins or sign-ups the same follows and the texts are: - A Marketing Affiliate Account to will provide you options to earn as you share businesses on your social media accounts. Anyone joining Community HubLand or purchasing from businesses on Community HubLand via your shared links will provide you respective commissions from Community HubLand and/or the business purchase - A Business Affiliate Account will provide you a platform to host your marketing materials that affiliate marketers can access to share on the social media platforms. You can determine how much commission your affiliate marketers will earn.</p></div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <input class="form-control email" type="email" name="email" <?php if(demo()) { ?> value="customer@shop.com" <?php } ?>  placeholder="<?php echo translate('email');?>">
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <input class="form-control" type="password" name="password" <?php if(demo()) { ?> value="1234" <?php } ?>  placeholder="<?php echo translate('password');?>">
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="forgot-password" style="cursor:pointer;" onClick="set_html('login','forget')">
                                <?php echo translate('forget_your_password_?');?>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <span class="btn btn-theme-sm btn-block btn-theme-dark pull-right login_btn enterer">
                                <?php echo translate('login');?>
                            </span>
                        </div>
                        <?php if($fb_login_set == 'ok' || $g_login_set == 'ok'){ ?>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <h2 class="login_divider"><span>or</span></h2>
                            </div>
                        <?php
                          if($fb_login_set == 'ok'){ ?>
                              <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 <?php if($g_login_set !== 'ok'){ ?>mr_log<?php } ?>">
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
                              <?php
                            }
                            if($g_login_set == 'ok'){ ?>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 <?php if($fb_login_set !== 'ok'){ ?>mr_log<?php } ?>">
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
                        <!--<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">-->
                        <!--        <h2 class="login_divider"><span>or</span></h2>-->
                        <!--    </div>-->
                        <!--<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">-->
                                  
                        <!--              <a class="btn btn-theme btn-block btn-icon-left facebook" href="<?= $url ?>">-->
                        <!--                  <i class="fa fa-facebook"></i>-->
                        <!--                  <?php echo translate('sign_in_with_facebook');?>-->
                        <!--              </a>-->
                                  
                        <!--      </div>-->
                        <!-- <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 ">-->
                                    
                        <!--                <a class="btn btn-theme btn-block btn-icon-left google" style="background:#ce3e26" href="<?= $g_url ?>">-->
                        <!--                    <i class="fa fa-google"></i>-->
                        <!--                    <?php echo translate('sign_in_with_google');?>-->
                        <!--                </a>-->
                                   
                                        
                                    
                        <!--        </div>-->
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="container" id="forget" style="display:none">
        <div class="row margin-top-0">
            <div class="col-lg-6 col-lg-offset-3 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-12">
                <?php
                    echo form_open(base_url() . 'home/login/forget/', array(
                        'class' => 'form-login',
                        'method' => 'post',
                        'id' => 'forget_form'
                    ));
                ?>
                    <div class="row box_shape">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <input class="form-control" type="email" name="email" placeholder="<?php echo translate('email_address');?>">
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-right">
                            <span class="forgot-password pull-left" style="cursor:pointer;" onClick="set_html('forget','login')">
                                <?php echo translate('login');?>
                            </span>
                            <span class="btn btn-primary btn-sm forget_btn enterer">
                                <?php echo translate('submit');?>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

</section>
<script>
function set_html(hide,show){
	$('#'+show).show('fast');
	$('#'+hide).hide('fast');
}
</script>
<style>
.g-icon-bg {
background: #ce3e26;
}
.g-bg {
background: #de4c34;
height: 37px;
margin-left: 41px;
width: 166px;
}
</style>
