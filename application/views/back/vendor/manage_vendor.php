<style type="text/css">
	form{
		padding: 0 16px;
	}
	    .terms_and_conditions{
         margin-bottom:10px;
    } 
    .terms_and_conditions label{
        padding-right:100px;
       
    }
</style>

<div id="content-container">
    <div id="page-title">
        <h1 class="page-header text-overflow"><?php echo translate('manage_profile');?></h1>
    </div>
    <div class="tab-base">
        <div class="panel">
            <div class="panel-body">
                <div class="tab-content">
                    <div class="tab-pane fade active in" id="" style="border:1px solid #ebebeb; border-radius:4px;">
                        <?php
							$vendor_data = $this->db->get_where('vendor', array(
								'vendor_id' => $this->session->userdata('vendor_id')
							))->result_array();
							foreach ($vendor_data as $row) {
							 //   var_dump($row);
							 //   die('nimra');
						?>
                        <div class="panel-heading">
                            <h3 class="panel-title"><?php echo translate('manage_details');?></h3>
                        </div>
						<?php
                            echo form_open(base_url() . 'vendor/manage_vendor/update_profile/', array(
                                'class' => 'form-horizontal',
                                'method' => 'post'
                            ));
                        ?>

                        	<div class="row">
                        		<div class="col-sm-3 sidegap_box">
                        			<div class="form-group">
                                    <label class="control-label" for="demo-hor-1">
                                    	<?php echo translate('first_name');?>
                                    	</label>
                                    	<input type="text" name="name" value="<?php echo $row['name']; ?>" id="demo-hor-1" class="form-control ">
	                                </div>
                        		</div>
                        			<div class="col-sm-3 sidegap_box">
                        			<div class="form-group">
                                    <label class="control-label" for="demo-hor-1">
                                    	<?php echo translate('middle_name');?>
                                        	</label>
	                                        <input type="text" name="display_name" value="<?php echo $row['middle_name']; ?>" id="demo-hor-1" class="form-control ">
	                                    
	                                </div>
                        		</div>
                        		<div class="col-sm-3 sidegap_box">
                        			<div class="form-group">
                                    <label class="control-label" for="demo-horSouthern Nation-1">
                                    	<?php echo translate('last_name');?>
                                        	</label>
	                                        <input type="text" name="l_name" value="<?php echo $row['last_name']; ?>" id="demo-hor-1" class="form-control ">
	                                    
	                                </div>
                        		</div>
                        		<div class="col-sm-3 sidegap_box">
                        			<div class="form-group">
                                    <label class="control-label" for="demo-hor-1">
                                    	<?php echo translate('company');?>
                                        </label>
	                                      <input type="text" name="company" value="<?php echo $row['company']; ?>" id="demo-hor-1" class="form-control ">
	                                </div>
                        		</div>
                        	
                        		
                        	</div>
                        	<div class="row">
                                <div class="col-sm-3 sidegap_box">
                                    <div class="form-group" style="padding-top: 7px">
                                       <label> <?php echo translate('email');?>
                                            </label>
                                            <input type="email" name="email" value="<?php echo $row['email']; ?>" id="demo-hor-2" class="form-control " readonly>
                                        
                                    </div>
                                </div>
                                
                        		<div class="col-sm-3 sidegap_box">
                        			<div class="form-group">
                                    <label class="control-label" for="demo-hor-3">
										<?php echo translate('phone');?>
	                                        	</label>
	                                        <input type="text" name="phone" value="<?php echo $row['phone']; ?>" id="demo-hor-3" class="form-control">
	                                    
	                                </div>
                        		</div>
                        		<div class="col-sm-3 sidegap_box">
                        			<div class="form-group">
                                    <label class="control-label" for="demo-hor-4">
										<?php echo translate('address_line_1');?>
                                        	</label>
	                                        <input type="text" name="address1" value="<?php echo $row['address1']; ?>" id="demo-hor-4" class="form-control address" onblur="set_cart_map('iio');">
	                                    
	                                </div>
                        		</div>
                        		<div class="col-sm-3 sidegap_box">
                        			<div class="form-group">
                                    <label class="control-label" for="demo-hor-4">
										<?php echo translate('address_line_2');?>
                                        	</label>
                                        <input type="text" name="address2" value="<?php echo $row['address2']; ?>" id="demo-hor-4" class="form-control address" onblur="set_cart_map('iio');">
                                    
                                </div>
                        		</div>
                        		
                        		
                        	</div>
                        	<div class="row">
                                <div class="col-sm-3 sidegap_box">
                                    <div class="form-group">
                                    <label class="control-label" for="demo-hor-4">
                                        <?php 
                                        echo translate('country');?>
                                            </label>
                                        <?php echo $this->crud_model->select_html('countries','country','name','edit','demo-chosen-select  select_country',$row['country'],'',NULL,'select_country'); ?>
                                        <input type="text" name="country-old" value="<?php echo 
                                        $row['country']; ?>" id="demo-hor-4" class="form-control address d-none hidden" onblur="set_cart_map('iio');">
                                    
                                </div>
                                </div>
                        		<div class="col-sm-3 sidegap_box">
                        			<div class="form-group" 
                        			id="stats">
                                    <label class="control-label" for="demo-hor-4">
										<?php 
										 
										echo translate('state');?>
                                        	</label>
                                    <div  id="stats_select">
                                        <?php echo $this->crud_model->select_html('states','state','name','edit','select_state demo-chosen-select ',$row['state'],'',NULL,'select_state'); ?>
                                    </div>
                                </div>
                                <!--city_select-->
                        		</div>
                        		<div class="col-sm-3 sidegap_box">
                        			<div class="form-group">
                                    <label class="control-label" for="demo-hor-4">
										<?php echo translate('city');?>
                                    </label>
                                 <div  id="city_select1">
                                     <input type="text" name="city" value="<?= $row['city'] ?>" placeholder="City (please spell correctly)" />
                                        <?php  //echo $this->crud_model->select_html('cities','city','name','edit','select_city demo-chosen-select' ,'','',$row['city'],'',NULL,'select_city'); ?>
                                    </div>
                                </div>
                        		</div>
                        		<div class="col-sm-3 sidegap_box">
                        			<div class="form-group">
                                    <label class="control-label" for="demo-hor-4">
										<?php echo translate('zip');?>
                                        	</label>
                                        <input type="text" name="zip" value="<?php echo $row['zip']; ?>" id="demo-hor-4" class="form-control ">
                                    
                                </div>
                        		</div>
                        		             
                        	
                        
                        	</div>
                        	<div class="row">
                                <div class="col-sm-3 sidegap_box">
                            <?php
                            // var_dump($row);
                            ?>
                                <label class="control-label" for="demo-hor-2"><?php echo translate('bussniss_type');?></label>
                                <div>
                                    <?php echo $this->crud_model->select_html('category','buss_type','category_name','signup_cat','demo-chosen-select',$row['cat1'],'digital',NULL,''); ?>
                                </div>
                            </div>
                                <div class="col-sm-3 sidegap_box">
                                <label class="control-label" for="demo-hor-2"><?php echo translate('main_Business_Category');?></label>
                                <div>
                                    <?php echo $this->crud_model->select_html('category','sub_category','category_name','signup_main_cat','demo-chosen-select',$row['cat2'],'digital',NULL); ?>
                                </div>
                            </div>
                                <div class="col-sm-3 sidegap_box">
                                <label class="control-label" for="demo-hor-2"><?php echo translate('industry_category');?></label>
                                <div>
                                    <?php echo $this->crud_model->select_html('category','sub3_category','category_name','ind_main_cat','demo-chosen-select',$row['cat3'],'digital',NULL); ?>
                                </div>
                            </div>
                              <div class="col-md-12">
                <div class="row terms_and_conditions">
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
                            </div>
                
                            <div class="panel-body" style="display:none;">

                                
                                <section class="col-md-8" id="lnlat" style="display:none;">
                                    <label class="input">
                                        <i class="icon-append fa fa-home"></i>   
                                        <input id="langlat" type="text" placeholder="langitude - latitude" name="lat_lang" value="<?php echo $row['lat_lang']; ?>" class="form-control" readonly>
                                    </label>
                                </section>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label" for="demo-hor-4"></label>
                                    <div class="col-sm-6">
                                        <div class="" id="maps" style="height:400px;" >
                                            <div id="map-canvas" style="height:400px;"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" style="display:none;">
                                    <label class="col-sm-3 control-label" for="demo-hor-4">
										<?php echo translate('about');?>
                                        	</label>
                                    <div class="col-sm-6">
                                        <textarea name="details" rows="10" class="form-control"><?php echo $row['details']; ?></textarea>
                                    </div>
                                </div>
                                <div class="form-group" style="display:none;">
                                    <label class="col-sm-3 control-label" for="demo-hor-inputemail">
                                        <?php echo translate('description'); ?>
                                    </label>
                                    <div class="col-sm-6">
                                            <textarea name="description" class="form-control " rows='8' ><?php echo $row['description']; ?></textarea>
                                    </div>
                                </div>

                            </div>
                            <div class="panel-footer text-right">
                                <span class="btn btn-info submitter enterer" data-ing='<?php echo translate('updating..'); ?>' data-msg='<?php echo translate('profile_updated!'); ?>'>
									<?php echo translate('update_profile');?>
                                    	</span>
                            </div>
                        </form>

                        <div class="panel-heading">
                            <h3 class="panel-title"><?php echo translate('change_password');?></h3>
                        </div>
							<?php
                                echo form_open(base_url() . 'vendor/manage_vendor/update_password/', array(
                                    'class' => 'form-horizontal',
                                    'method' => 'post'
                                ));
                            ?>
                                <div class="panel-body">
                                    <div class="row">
                                <div class="col-sm-3 sidegap_box">
                            <?php
                            // var_dump($row);
                            ?>
                                <label class="control-label" for="demo-hor-2">
                                            <?php echo translate('current_password');?>
                                                </label>
                                <input type="password" name="password" value="" id="demo-hor-5" class="form-control ">
                            </div>
                                <div class="col-sm-3 sidegap_box">
                                <label class="control-label" for="demo-hor-2">
                                            <?php echo translate('new_password*');?>
                                                </label>
                                 <input type="password" name="password1" value="" id="demo-hor-6" class="form-control pass pass1 ">
                            </div>
                                <div class="col-sm-3 sidegap_box">
                                <label class="control-label" for="demo-hor-2"><?php echo translate('confirm_password');?></label>
                                 <input type="password" name="password2" value="" id="demo-hor-7" class="form-control pass pass2 ">
                            </div>
                            <div class="col-sm-3 sidegap_box" style="margin:30px 0 30px;">
                              <span class="btn btn-info pass_chng disabled enterer" disabled='disabled' data-ing='<?php echo translate('updating..'); ?>' data-msg='<?php echo translate('password_updated!'); ?>'>
                                        <?php echo translate('update_password');?>
                                            </span>
                            </div>
                              
                            </div>

                                    
                                    
                                    
                                </div>
                                
                        	</form>
                        <?php
                            }
                            
                        ?>
                    </div>
                </div>
            </div>
        <!--Panel body-->
        </div>
    </div>
</div>

<script type="text/javascript">
	$(".pass").blur(function() {
		var pass1 = $(".pass1").val();
		var pass2 = $(".pass2").val();
		if (pass1 !== pass2) {
			$("#pass_note").html('' + '  <span class="require_alert" >' + '      <?php echo translate('password_mismatched'); ?>' + '  </span>');
			$(".pass_chng").attr("disabled", "disabled");
			$(".pass_chng").addClass("disabled");
		} else if (pass1 == pass2) {
			$("#pass_note").html('');
			$(".pass_chng").removeAttr("disabled");
			$(".pass_chng").removeClass("disabled");
		}
	});
	
	$('.pass_chng').on('click', function() {
	
// 		alert('vdv');
		var here = $(this); // alert div for show alert message
		var form = here.closest('form');
		var can = '';
		var ing = here.data('ing');
		var msg = here.data('msg');
		var prv = here.html();
	
		//var form = $(this);
		var formdata = false;
		if (window.FormData) {
			formdata = new FormData(form[0]);
		}
	
		var a = 0;
		var take = '';
		form.find(".required").each(function() {
			var txt = '*<?php echo translate(''); ?>';
			a++;
			if (a == 1) {
				take = 'scroll';
			}
			var here = $(this);
			if (here.val() == '') {
				if (!here.is('select')) {
					here.css({
						borderColor: 'red'
					});
	
					if (here.closest('div').find('.require_alert').length) {
	
					} else {
						sound('form_submit_problem');
						here.closest('div').append('' + '  <span id="' + take + '" class="label label-danger require_alert" >' + '      ' + txt + '  </span>');
					}
				}
				var topp = 100;
	
				$('html, body').animate({
					scrollTop: $("#scroll").offset().top - topp
				}, 500);
				can = 'no';
			}
	
			take = '';
		});
	        $(document).ready(function(){
	            $('.demo-chosen-select').chosen();
	        });
		if (can !== 'no') {
			$.ajax({
				url: form.attr('action'), // form action url
				type: 'POST', // form submit method get/post
				dataType: 'html', // request type html/json/xml
				data: formdata ? formdata : form.serialize(), // serialize form data 
				cache: false,
				contentType: false,
				processData: false,
				beforeSend: function() {
					here.html(ing); // change submit button text
				},
				success: function(data) {
				    // alert(data);
					here.fadeIn();
					here.html(prv);
					if (data == 'updated') {
						$.activeitNoty({
							type: 'success',
							icon: 'fa fa-check',
							message: msg,
							container: 'floating',
							timer: 3000
						});
					} else if (data == 'pass_prb') {
						$.activeitNoty({
							type: 'danger',
							icon: 'fa fa-check',
							message: '<?php echo translate('incorrect_password!'); ?>',
							container: 'floating',
							timer: 3000
						});
					}
				},
				error: function(e) {
				    // alert('ok');
					console.log(e)
				}
			});
		} else {
			sound('form_submit_problem');
			return false;
		}
	});

	var base_url = '<?php echo base_url(); ?>';
	var user_type = 'vendor';
	var module = 'manage_admin';
	var list_cont_func = '';
	var dlt_cont_func = '';

</script>

<script>
    
    $(document).ready(function(){
        // set_cart_map();
    });

    function set_cart_map(tty){
        //$('#maps').animate({ height: '400px' }, 'easeInOutCubic', function(){});
        var map = initialize();
        var address = [];
        //$('#pos').show('fast');
        //$('#lnlat').show('fast');
        $('.address').each(function(index, value){
            if(this.value !== ''){
                address.push(this.value);
            }
        });
        address = address.toString();
        deleteMarkers();
        geocoder.geocode( { 'address': address}, function(results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                if($('#langlat').val().indexOf(',')  == -1 || $('#first').val() == 'no' || tty == 'iio'){
                    deleteMarkers();
                    var location = results[0].geometry.location; 
                    var marker = addMarker(location);
                    map.setCenter(location);
                    $('#langlat').val(location);
                } else if($('#langlat').val().indexOf(',')  >= 0){
                    deleteMarkers();
                    var loca = $('#langlat').val();
                    loca = loca.split(',');
                    var lat = loca[0].replace('(','');
                    var lon = loca[1].replace(')','');
                    var marker = addMarker(new google.maps.LatLng(lat, lon));
                    map.setCenter(new google.maps.LatLng(lat, lon));
                }
                if($('#first').val() == 'yes'){
                    $('#first').val('no');
                }
                // Add dragging event listeners.
                google.maps.event.addListener(marker, 'drag', function() {
                    $('#langlat').val(marker.getPosition());
                });
            }
        }); 
    }

        var geocoder;
        var map;
        var markers = [];
        function initialize() {
            // return 0;
            geocoder = new google.maps.Geocoder();
            var latlng = new google.maps.LatLng(-34.397, 150.644);
            var mapOptions = {
                zoom: 14,
                center: latlng
            }
            map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
            google.maps.event.addListener(map, 'click', function(event) {
                deleteMarkers();
                var marker = addMarker(event.latLng,map);
                $('#langlat').val(event.latLng);    
                // Add dragging event listeners.
                google.maps.event.addListener(marker, 'drag', function() {
                    $('#langlat').val(marker.getPosition());
                });
                
            });

            return map;
        }
        

    /*
        var address = [];
        $('#maps').show('fast');
        $('#pos').show('fast');
        $('#lnlat').show('fast');
        $(".address").each(
        address.push(this.value);
        );
    */

        $('.address').on('blur', function(){
			$('#langlat').val('');
            set_cart_map();
        });

        // Add a marker to the map and push to the array.
        function addMarker(location,map) {
            var image = {
                url: base_url+'uploads/others/marker.png',
                size: new google.maps.Size(40, 60),
                origin: new google.maps.Point(0,0),
                anchor: new google.maps.Point(20, 62)
            };

            var shape = {
                coords: [1, 5, 15, 62, 62, 62, 15 , 5, 1],
                type: 'poly'
            };

            var marker = new google.maps.Marker({
                position: location,
                map: map,
                draggable:true,
                icon: image,
                shape: shape,
                animation: google.maps.Animation.DROP
            });
            markers.push(marker);
            return marker;
        }

        // Deletes all markers in the array by removing references to them.
        function deleteMarkers() {
            clearMarkers();
            markers = [];
        }

        // Sets the map on all markers in the array.
        function setAllMap(map) {
            for (var i = 0; i < markers.length; i++) {
                markers[i].setMap(map);
            }
        }

        // Removes the markers from the map, but keeps them in the array.
        function clearMarkers() {
            setAllMap(null);
        }
        //google.maps.event.addDomListener(window, 'load', initialize);
        $(document).ready(function() {
        other();
    });

    function other(){
        $('.demo-chosen-select').chosen();
        $('.chosen-with-drop').css({width:'100%'});
        //  alert();
    }
    function select_country(id)
    {
        $('#stats_select').hide('slow');
        $('#sub').hide('slow');
        ajax_load(base_url+'vendor/get_state/'+id,'stats_select','other');
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
</script>


