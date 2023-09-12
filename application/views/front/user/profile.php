<style>
    .terms_and_conditions{
         margin-bottom:10px;
    } 
    .terms_and_conditions label{
        padding-right:100px;
       
    }
</style>
<?php
// die('nimra');
	foreach($user_info as $row)
	{
	    $profile_image="";
        if(file_exists('uploads/user_image/user_'.$row['user_id'].'.jpg')){ 
            $profile_image =  $this->crud_model->file_view('user',$row['user_id'],'100','100','no','src','','','.jpg').'?t='.time();
        } else if(empty($row['fb_id']) !== true){ 
            $profile_image =  'https://graph.facebook.com/'. $row['fb_id'] .'/picture?type=large';
        } else if(empty($row['g_id']) !== true ){
            $profile_image =  $row['g_photo'];
        } else {
            $profile_image =  base_url().'uploads/user_image/default.jpg';
        }
    ?>
        <div class="row mb-2 bg-white rounded py-3">
            <div class="col-12">
                <div class="information-title" style="margin-bottom: 0px; p-3"><h1><?php echo translate('profile_information');?></h1></div>
            </div>
            <div class="col-md-12" style="background:#fff;padding:10px;">
                <div class="recent-post" style="background: #fff;border: 1px solid #e0e0e0;">
                    <div class="media">
                        <div class="text-center">
                            <div class="shadow-lg mx-auto mt-2 mb-4 border border-2" style="width: 100px; height: 124px;">
                        <a class="pull-left media-link" href="#" style="height: 124px;">
                            <div class="media-object img-bg" id="blah" style="background-image: url(<?= $profile_image; ?>); background-size: cover;background-position-x: center; background-position-y: top; width: 100px; height: 124px;"></div>
                            <?php
                                echo form_open(base_url() . 'home/registration/change_picture/'.$row['user_id'], array(
                                    'class' => '',
                                    'method' => 'post',
                                    'id' => 'fff',
                                    'enctype' => 'multipart/form-data'
                                ));
                            ?>
                                <span id="inppic" class="set_image">
                                    <label class="" for="imgInp">
                                        <span><i class="fa fa-pencil" style="cursor: pointer;"></i></span>
                                    </label>
                                    <input type="file" style="display:none;" id="imgInp" name="img" />
                                </span>
                                <span id="savepic" style="display:none;">
                                    <span class="signup_btn" onclick="abnv('inppic'); change_state('normal');"  data-ing="<?php echo translate('saving');?>..." data-success="<?php echo translate('profile_picture_saved_successfully!'); ?>" data-unsuccessful="<?php echo translate('edit_failed!'); ?> <?php echo translate('try_again!'); ?>" data-reload="no" >
                                        <span><i class="fa fa-save" style="cursor: pointer;"></i></span>
                                    </span>
                                </span>
                            </form>
                        </a>
                        </div>
                        </div>
                        <div class="media-body" style="padding-right: 20px">
                            <table class="table table-condensed" style="font-size: 14px; margin-bottom: 0px">
                                <tr>
                                    <td><b><?php echo translate('first_name');?></b></td>
                                    <td align="left"><?php echo $row['username'];?></td>
                                    <td><b><?php echo translate('last_name');?></b></td>
                                    <td><?php echo $row['surname'];?></td>
                                </tr>
                                <tr>
                                    <td><b><?php echo translate('email');?></b></td>
                                    <td><?php echo $row['email'];?></td>
                                    <td><b><?php echo translate('contact_no');?></b></td>
                                    <td><?php echo $row['phone'];?></td>
                                </tr>
                                <tr>
                                    <td><b><?php echo translate('address');?></b></td>
                                    <td><?php echo $row['address1'];?> <?php echo $row['address2'];?></td>
                                    <td><b><?php echo translate('country');?></b></td>
                                    <td><?php echo $row['country'];?></td>
                                </tr>
                                <tr>
                                    <td><b><?php echo translate('state');?></b></td>
                                    <td><?php echo $row['state'];?></td>
                                    <td><b><?php echo translate('city');?></b></td>
                                    <td><?php echo $row['city'];?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="row terms_and_conditions p-4">
                    <?php 
                    if(isset($row['TOC']) && $row['TOC'] == 'ok'){
                    ?>
                    <input type="checkbox" value="" checked disabled><label>Terms & Conditions</label>
                    <?php
                    }if(isset($row['add_affilite']) && $row['add_affilite'] == 'yes'){
                    ?>
                    <input type="checkbox" disabled value="" checked><label>Join Affiliates</label>
                    <?php
                    }if(isset($row['aff_TOC']) && $row['aff_TOC'] == 'ok'){
                    ?>
                    <input type="checkbox" disabled value="" checked><label>Affiliates Terms Of Use</label>
                    <?php 
                    }
                    ?>
                </div>
            </div>
            <div class="row">
                <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia,
                    molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum
                    numquam blanditiis harum quisquam eius sed odit fugiat iusto fuga praesentium
                    optio, eaque rerum! Provident similique accusantium nemo autem.
                </p>
            </div>
            <div class="col-md-12">
                <div class="row p-2">
                    <div class="col-md-4 mt-2">
                        
                        <div class="card shadow-sm">
                          <div class="card-header" style="background-color:var(--primary-color);color:white;">
                            <?php echo translate('purchase_summary');?>
                          </div>
                          <div class="card-body">
                            <ul class="profile_ul">
                                <li><span><?php echo translate('total_purchase');?>:</span> <span class="text-left float-end"><?php echo currency($this->crud_model->user_total(0)); ?></span></li>
                                <li><span><?php echo translate('last_7_days');?>:</span> <span class="text-left float-end"><?php echo currency($this->crud_model->user_total(7)); ?></span></a></li>
                                <li><span><?php echo translate('last_30_days');?>:</span> <span class="text-left float-end"><?php echo currency($this->crud_model->user_total(30)); ?></span></a></li>
                            </ul>
                          </div>
                        </div>

                    </div>
                    <div class="col-md-4 mt-2">
                        
                        <div class="card shadow-sm">
                          <div class="card-header" style="background-color:var(--primary-color);color:white;">
                            <?php echo translate('others_info');?>
                          </div>
                          <div class="card-body">
                            <ul class="profile_ul">
                                <li><span><?php echo translate('wished_products');?>:</span> <span class="text-left float-end"><?php echo $this->crud_model->user_wished(); ?></span></li>
                                <li><span><?php echo translate('user_since');?>:</span> <span class="text-left float-end"><?php echo date('d M, Y',$row['creation_date']); ?></span></li>
                                <li><span><?php echo translate('last_login');?>:</span> <span class="text-left float-end"><?php echo date('d M, Y',$row['last_login']); ?></span></li>
                            </ul>
                          </div>
                        </div>
                    </div>
                    <?php if($this->crud_model->get_type_name_by_id('general_settings','83','value') == 'ok'){ ?>
                        <div class="col-md-4">
                            
                            <div class="card shadow-sm">
                          <div class="card-header" style="background-color:var(--primary-color);color:white;">
                           <?php echo translate('package_info');?>
                          </div>
                          <div class="card-body">
                            <div class="widget widget-categories" style="padding-bottom:25px">
                                <ul class="profile_ul">
                                    <li><span><?php echo translate('remaining_upload_amount');?>: </span> <span class="text-left float-end"><?php echo $this->db->get_where('user', array('user_id' => $this->session->userdata('user_id')))->row()->product_upload; ?><span></li>
                                    <?php 
                                        $package_info = json_decode($row['package_info'], true);
                                    ?>
                                    <li>
                                        <span>
                                            <?php echo translate('current_package');?>: </span> <span class="text-left float-end"><?php if ($row['package_info'] == "[]" || $row['package_info'] == "") { echo translate('default'); } else { echo $package_info[0]['current_package'];}?></span>
                                    </li>
                                    <li>
                                        <span>
                                            <?php echo translate('payment_type');?>: </span> <span class="text-left float-end"><?php if ($row['package_info'] == "[]" || $row['package_info'] == "") { echo translate('none'); } else { echo $package_info[0]['payment_type'];}?></span>
                                    </li>
                                </ul>
                            </div>
                          </div>
                        </div>
                        
                        
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    <?php
	}
?> 
<script type="text/javascript">
	function abnv(thiss){
		$('#savepic').hide();
		$('#inppic').hide();
		$('#'+thiss).show();
	}
	function change_state(va){
		$('#state').val(va);
	}

	$('.user-profile-img').on('mouseenter',function(){
		//$('.pic_changer').show('fast');
	});

	//$('.set_image').on('click',function(){
	//    $('#imgInp').click();
	//});

	$('.user-profile-img').on('mouseleave',function(){
		if($('#state').val() == 'normal'){
			//$('.pic_changer').hide('fast');
		}
	});
	function readURL(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function(e) {
				$('#blah').css('backgroundImage', "url('"+e.target.result+"')");
				$('#blah').css('backgroundSize', "cover");
			}
			reader.readAsDataURL(input.files[0]);
			abnv('savepic');
			change_state('saving');
		}
	}

	$("#imgInp").change(function() {
		readURL(this);
	});
	
	
	window.addEventListener("keydown", checkKeyPressed, false);
	 
	function checkKeyPressed(e) {
		if (e.keyCode == "13") {
			$(":focus").closest('form').find('.submit_button').click();
		}
	}
</script>