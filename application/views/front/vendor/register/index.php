<style type="text/css">
    .get_into .logo_top{
        display: none;
    }
    .get_into .title{
        width: 100%;
        margin-bottom: 20px;
    }
    .form-login .row div[class*="col-"], .form-login .row aside[class*="col-"] {
    margin-top: 0;
    margin: 0 0 17px;
}
.logup_btn{
        background: #f2651f;
        width: auto;
        border-radius: 4px;
    }
</style>

<link href="<?= base_url() ?>/template/back/plugins/chosen/chosen.min.css" rel="stylesheet">
<section class="page-section color get_into">
    
    <div class="container">
        
        <div class="row margin-top-0">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="logo_top">
                    <a href="<?php echo base_url()?>">
                        <img class="img-responsive" src="<?php echo $this->crud_model->logo('home_bottom_logo'); ?>" alt="Shop" style="z-index:200">
                    </a>
                </div>
                <?php
                        if(!isset($_GET['pack']))
                        {
                            include 'pac.php';
                        }
                        else
                        {
                            ?>
                <?php
                    echo form_open(base_url() . 'home/vendor_logup/add_info/', array(
                        'class' => 'form-login',
                        'method' => 'post',
                        'id' => 'sign_form'
                    ));
                ?>
                <input type="hidden" name="pack" value="<?= $_GET['pack'] ?>">
                    <div class="row box_shape">
                        <div class="title">
                            <?php echo translate('vendor_registration');?>
                            <div class="option">
                                <?php echo translate('already_a_vendor_?_click_to_');?>
                                <a href="<?php echo base_url(); ?>vendor" target="_blank" class="vendor_login_btn"> 
                                    <?php echo translate('login');?> <?php echo translate('as_vendor');?>
                                </a>!
                                <?php echo translate('not_a_member_yet_?_click_to_');?>
                                <a href="<?php echo base_url(); ?>login_set/registration"> 
                                    <?php echo translate('sign_up');?> <?php echo translate('as_customer');?>
                                </a>!
                            </div>
                        </div>
                        <hr>
                        
                        <div class="col-md-4">
                            <div class="form-group">
                                <input class="form-control required" name="name" type="text" placeholder="<?php echo translate('first_name');?>" data-toggle="tooltip" title="<?php echo translate('first_name');?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input class="form-control required" name="middle_name" type="text" placeholder="<?php echo translate('middle_name');?>" data-toggle="tooltip" title="<?php echo translate('middle_name');?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <input class="form-control required" name="last_name" type="text" placeholder="<?php echo translate('last_name');?>" data-toggle="tooltip" title="<?php echo translate('last_name');?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input class="form-control required" name="company" type="text" placeholder="<?php echo translate('business_name');?>" data-toggle="tooltip" title="<?php echo translate('business_name');?>">
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
                                <input class="form-control pass1 required" type="password" id="password" onkeyup="checkPasswordStrength();" name="password1" placeholder="<?php echo translate('password');?>" data-toggle="tooltip" title="<?php echo translate('password');?>">
                                <small id="password-strength-status" style="color:red;"></small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input class="form-control pass2 required" type="password" name="password2" placeholder="<?php echo translate('confirm_password');?>" data-toggle="tooltip" title="<?php echo translate('confirm_password');?>">
                            </div>
                            <div id='pass_note'></div> 
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input class="form-control" name="phone" type="text" placeholder="<?php echo translate('phone');?>" data-toggle="tooltip" title="<?php  echo translate('phone');?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <input class="form-control" name="wphone" type="text" placeholder="<?php echo translate('whatsapp_(optional)');?>" data-toggle="tooltip" title="<?php  echo translate('whatsapp');?>">
                            </div>
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
                        
                        <div class="col-md-4">
                                <label class="control-label" for="demo-hor-2"><?php echo translate('bussniss_type');?></label>
                                <div>
                                    <?php echo $this->crud_model->select_html('category','buss_type','category_name','signup_cat','demo-chosen-select required','','digital',NULL,''); ?>
                                </div>
                            </div>
                
                        <div class="col-md-4">
                                <label class="control-label" for="demo-hor-2"><?php echo translate('main_Business_Category');?></label>
                                <div>
                                    <?php echo $this->crud_model->select_html('category','sub_category','category_name','signup_main_cat','demo-chosen-select required','','digital',NULL); ?>
                                </div>
                            </div>
                        
                            <div class="col-md-4">
                                <label class="control-label" for="demo-hor-2"><?php echo translate('industry_category');?></label>
                                <div>
                                    <?php echo $this->crud_model->select_html('category','sub3_category','category_name','ind_main_cat','demo-chosen-select required','','digital',NULL); ?>
                                </div>
                            </div>
                           
                        <!--    <div class="col-md-6" id="scat" style="display: none;">-->
                        <!--    <div class="form-group">-->
                        <!--        <label><?php // echo translate('sub-category');?></label>-->
                        <!--        <span id="sub_cat" class="col-md-12">-->
                        <!--        <input type="text" name="state" class="form-control" />-->
                        <!--        </span>-->
                        <!--    </div>-->
                        <!--</div>-->
                        <!--    <div class="col-md-6" id="s3cat" style="display: none;">-->
                        <!--    <div class="form-group">-->
                        <!--        <label><?php // echo translate('level3-category');?></label>-->
                        <!--        <span id="sub3_cat" class="col-md-12">-->
                        <!--        <input type="text" name="state" class="form-control" />-->
                        <!--        </span>-->
                        <!--    </div>-->
                        <!--</div>-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Country</label>
                                <?php echo $this->crud_model->select_html('countries','country','name','edit','form-control demo-chosen-select required select_country','','',NULL,'select_country'); ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Region</label>
                                <div id="stats_select"></div>
                                
                            </div>
                        </div>
                        <div class="col-md-12">
                        <div class="col-md-6" style="padding-left: 0;">
                            <div class="form-group">
                                <label>City</label>
                                <div id="city_select"></div>
                            </div>
                        </div>
                        <div class="col-md-6" style="margin-top:0px">
                            <div class="form-group">
                                <label>Post Code</label>
                                <input class="form-control required" name="zip" type="text" placeholder="<?php echo translate('zip');?>" data-toggle="tooltip" title="<?php echo translate('zip');?>">
                            </div>
                        </div>
                        </div>
                        <div class="col-md-12 terms">
                            <input  name="affiliate" type="checkbox" value="yes" id="affiliates"> 
                            <?php  echo translate('join_affiliates');?>
                        </div>
                        <div class="col-md-12 terms" style="display:none;"  id="affiliate_terms_check" >
                          <input  name="affiliate_terms_check" type="checkbox" value="ok">
                          <?php echo translate('i_agree_with');?>
                          <a href="<?php echo base_url();?>home/page/Affiliates_Terms_Of_Use" target="_blank">
                              <?php echo translate('Affiliates_terms_of_use');?>
                          </a>
                      </div>
                        <div class="col-md-12 terms">
                            <input  name="terms_check" type="checkbox" value="ok" > 
                            <?php echo translate('i_agree_with');?>
                            <a href="<?php echo base_url();?>home/legal/terms_conditions" target="_blank">
                                <?php echo translate('terms_&_conditions');?>
                            </a>
                        </div>
                        <?php
                            if($this->crud_model->get_settings_value('general_settings','captcha_status','value') == 'ok'){
                        ?>
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
                            <span class="btn btn-theme-sm btn-block btn-theme-dark pull-right logup_btn" id="registerbtn" data-ing='<?php echo translate('registering..'); ?>' data-msg="">
                                <?php echo translate('register');?>
                            </span>
                        </div>
                    </div>
                </form>
                <?php
                        }
                            ?>
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
    function get_cat(id,now){
        $('#scat').show('slow');
        ajax_load(base_url+'home/vendor_logup/sub_by_cat/'+id,'sub_cat','other');
    }
    function get_brnd(id){
        // alert('OK');
        $('#s3cat').hide('slow');
        ajax_load(base_url+'home/vendor_logup/sub3_by_cat/'+id,'sub3_cat','other');
        $('#s3cat').show('slow');
    }
        $('#affiliates').on('change',function(){
        // alert();
        if($('#affiliates').is(':checked')){
          $('#affiliate_terms_check').show();
        }
        else{
         $('#affiliate_terms_check').hide();
        }
    });
    // $('#password').each(function(){
     function checkPasswordStrength() {
	var number = /([0-9])/;
	var alphabets = /([a-zA-Z])/;
	var special_characters = /([~,!,@,#,$,%,^,&,*,-,_,+,=,?,>,<])/;
	var password = $('#password').val().trim();
	if (password.length < 8) {
		$('#password-strength-status').removeClass();
		$('#password-strength-status').addClass('weak-password');
		$('#password-strength-status').html("Weak (should be atleast 8 characters.)");
		$('#registerbtn').css({'display':'none'});
	} else {
		if (password.match(number) && password.match(alphabets) && password.match(special_characters)) {
			$('#password-strength-status').css({'display':'none'});
			$('#registerbtn').css({'display':'block'});
		}
		else {
			$('#password-strength-status').removeClass();
			$('#password-strength-status').addClass('medium-password');
			$('#password-strength-status').html("Medium (should include alphabets, numbers and special characters.)");
			$('#registerbtn').css({'display':'none'});
		}
	}
}
    // });
</script>