 
<?php
    $username   = "";
    $surname    = "";
    $email      = "";
    $phone      = "";
    $address1   = "";
    $address2   = "";
    $langlat    = "";
    $address    = "";
    $zip        = "";
    $city        = "";
    $country        = "";
if($this->session->userdata('user_login')== "yes"){
    $user       = $this->session->userdata('user_id'); 
    $user_data  = $this->db->get_where('user',array('user_id'=>$user))->row(); 
    $username   = $user_data->username;
    $surname    = $user_data->surname;  
    $email      = $user_data->email; 
    $phone      = $user_data->phone; 
    $address1   = $user_data->address1; 
    $address2   = $user_data->address2; 
    $langlat    = $user_data->langlat; 
    $address    = $address1.$address2;
    $zip        = $user_data->zip; 
    $city        = $user_data->city; 
    $country        = $user_data->country; 
  } 
?>

<div class="row ">
    <div class="col-md-6">
        <div class="form-group">
            <input class="form-control required" value="<?php echo $username ;?>" name="firstname" type="text" placeholder="<?php echo translate('first_name');?>">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <input class="form-control required" value="<?php echo $surname ;?>" name="lastname" type="text" placeholder="<?php echo translate('last_name');?>">
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <input class="form-control required address" name="address1" value="<?php echo $address1; ?>" type="text" placeholder="<?php echo translate('address_line_1');?>">
        </div>
    </div>
    <div class="col-md-12" style="padding:0;">
        <div class="form-group">
            <div class="col-md-3" >
                <?php echo $this->crud_model->select_html('countries','country','name','edit','form-control demo-chosen-select required select_country',$country,'',NULL,'select_country','single','one'); ?>
                
            </div>
            <div class="col-md-3" id="stats_select">
                <input type="text" name="state" placeholder="State" />
                
            </div>
            <div class="col-md-3" id="city_select">
                <input type="text" name="city" placeholder="City" />
                
            </div>
            <div class="col-md-3">
        <div class="form-group">
            <input class="form-control required"  name="zip" type="text" value="<?php echo $zip; ?>" placeholder="<?php echo translate('postcode/ZIP');?>">
        </div>
    </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <input class="form-control required" value="<?php echo $email ;?>" name="email" type="text" placeholder="<?php echo translate('email');?>">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <input class="form-control required" value="<?php echo $phone ;?>" name="phone" type="text" placeholder="<?php echo translate('phone_number');?>">
        </div>
    </div>

    <div class="col-sm-12" id="lnlat" style="display:none;">
        <div class="form-group">
            <div class="col-sm-12">
                <input id="langlat" value="" type="text" placeholder="langitude - latitude" name="langlat" class="form-control" readonly>
            </div>
        </div>
    </div>

    <div class="col-md-12" style="display:none;">
        <div class="checkbox">
            <label>
                <input type="checkbox"> 
                <?php echo translate('ship_to_different_address_for_invoice');?>
            </label>
        </div>
    </div>


    <div class="col-md-12">
        <span class="btn btn-theme-dark" onclick="load_smethods();">
            <?php echo translate('next');?>
        </span>
    </div>

</div>


<input type="hidden" id="first" value="yes"/>

<script type="text/javascript">
function other(){
        console.log("other called");
        $('.demo-chosen-select').chosen();
        $('.chosen-with-drop').css({width:'100%'});
    }
    function select_country(id)
    {
        $('#stats_select').hide('slow');
        ajax_load(base_url+'vendor/get_state/'+id,'stats_select','other');

        setInterval(function (){

  other();

}, 1000); // How long do you want the delay to be (in milliseconds)?
        
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
                setInterval(function (){

  other();

}, 1000); // How long do you want the delay to be (in milliseconds)?
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