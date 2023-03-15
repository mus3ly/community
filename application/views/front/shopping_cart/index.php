
	<!--Chosen [ OPTIONAL ]-->
	<link href="<?= base_url() ?>/template/back/plugins/chosen/chosen.min.css" rel="stylesheet">
<style>
    #order_place_btn{
        position: absolute;
    }
    .ellipse{display: none;}
    #new_checkout .col-md-8{padding: 0;}
    #new_checkout .col-md-12{padding: 0 0 12px;}
#new_checkout .btn-theme-dark{
    background: #f26122;
    margin: 0 9px 0 0;
}
</style>
<?php
echo form_open(base_url() . 'home/cart_finish/go', array(
            'method' => 'post',
            'enctype' => 'multipart/form-data',
            'id' => 'cart_form'
        )
    );
?>
<script src="https://checkout.stripe.com/checkout.js"></script>
<!-- PAGE -->
<section class="page-section color" id="new_checkout">>
    <input type="hidden" name="r_id" id="r_id" />
    <div class="container box_shadow" >
        <h3 class="block-title alt">
            <i style=" padding: 1px 5px;" class="fa fa-angle-down"></i>
            <?php echo translate('1');?>.
            <?php echo translate('customer_information');?>
        </h3>
        <div action="#" class="form-delivery delivery_address">
        </div
        <h3 class="block-title alt">
            <i class="fa fa-angle-down" style=" padding: 1px 5px;"></i>
            <?php echo translate('2');?>.
            <?php echo translate('orders');?>
        </h3>
        <div class="row orders" id="cart_checkout">

        </div>

        

        <h3 class="block-title alt">
            <i style=" padding: 1px 5px;" class="fa fa-angle-down"></i>
            <?php echo translate('3');?>.
            <?php echo translate('payments_options');?>
        </h3>
        <div class="panel-group payments-options" id="accordion" role="tablist" aria-multiselectable="true">
        </div>
        <div class="overflowed">
            <a class="btn btn-theme-dark" href="<?php echo base_url(); ?>home/cancel_order">
                <?php echo translate('cancel_order');?>
            </a>
            <span class="btn btn-theme pull-right disabled" id="order_place_btn" onclick="cart_submission(this);">
                <?php echo translate('place_order');?>
            </span>
        </div>
    </div>
</section>
<!-- /PAGE -->
<?php echo form_close()?>
<script type="text/javascript" src="<?= base_url(); ?>/template/back/plugins/chosen/chosen.jquery.min.js" ></script>
<script>
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
    $(document).ready(function(){
		var top = Number(200);
// 		alert("Here84");
		$('.orders').hide();
// 		$('.delivery_address').html(' ');
        var state = check_login_stat('state');
        state.success(function (data) {
            load_address_form();
            
            // load_payments();
            // return false;
            // if(data == 'hypass'){
            //     load_address_form();
            // } else {
            //     signin('guest_checkout');
            // }
        });
    });
    function load_smethods(){
        
        if(true)
        {
        $('.orders').show();
        $('.orders').html('<div style="text-align:center;width:100%;height:'+(top*2)+'px; position:relative;top:'+top+'px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');
        var param = {
          'firstname'  : jQuery( "[name='firstname']" ).val(),
          'lastname'  : jQuery( "[name='lastname']" ).val(),
          'address1'  : jQuery( "[name='address1']" ).val(),
          'email'  : jQuery( "[name='email']" ).val(),
          'country'  : jQuery( "[name='country']" ).val(),
          'state'  : jQuery( "[name='state']" ).val(),
          'city'  : jQuery( "[name='city']" ).val(),
          'zip'  : jQuery( "[name='zip']" ).val(),
          'phone'  : jQuery( "[name='phone']" ).val(), 
        };
        console.log(param);
        $.get('<?php echo base_url(); ?>home/cart_checkout/cal_shipping',param,
  function(data, status){
      $('#r_id').val(data);
    load_orders();
  });
        }
    }

    function load_orders(){
        var find = 0;
        if(find == 0)
        {
        $('.orders').show();
        $('.orders').html('<div style="text-align:center;width:100%;height:'+(top*2)+'px; position:relative;top:'+top+'px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');
        var param = {
          'smethod'  : jQuery( "[name='shipping_type']:checked" ).val(),
          'r_id'  : jQuery( "[name='r_id']" ).val()
        };
        
        console.log(param);
        $.get('<?php echo base_url(); ?>home/cart_checkout/orders',param,
  function(data, status){
    $('.shipping_methods').hide();
    $('.orders').html(data);
    $('.orders').show();
  });
        }
        
        
		
        // $('.orders').load('<?php echo base_url(); ?>home/cart_checkout/orders');
    }

    function load_address_form(){
		var top = Number(200);
		$('.delivery_address').html('<div style="text-align:center;width:100%;height:'+(top*2)+'px; position:relative;top:'+top+'px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');

        $('.delivery_address').load('<?php echo base_url(); ?>home/cart_checkout/delivery_address',
            function(){
                other();
                var top_off = $('.header').height();
                $('.selectpicker').selectpicker();
                $('html, body').animate({
                    scrollTop: $(".delivery_address").offset().top-(2*top_off)
                }, 1000);
            }
        );
    }

    function load_payments(){
        $('.require_alert').remove();
        var find = 0;
        var mid = '.delivery_address .required';
        $(mid).each(function(){
            var here = $(this);
            if(here.val() == ''){
                find = 1;
                if(true){
                    find = 1;
                    here.css({borderColor: 'red'});
                    if(here.attr('type') == 'number'){
                        txt = '*'+mbn;
                    }
                    
                    if(here.closest('div').find('.require_alert').length){

                    } else {
                        find = 1;
                        var take = '';
                        var txt = 'Required';
                        here.closest('div').append(''
                            +'  <span id="'+take+'" class="label label-danger require_alert" >'
                            +'      '+txt
                            +'  </span>'
                        );
                    }
                }
            }//if empty
        });
        if(find == 0)
        {
		$('#order_place_btn').removeClass('disabled')
        var okay = 'yes';
        var sel = 'no';
        $('.delivery_address').find('.required').each(function(){
            if($(this).is('select') || $(this).is('input')){
                //alert($(this).val());
                if($(this).val() == ''){
                    okay = 'no';
                    if($(this).is('select')){
                        $(this).closest('.form-group').find('.selectpicker').focus();
                    } else {
                        if(sel == 'no'){
                            $(this).focus();
                        }
                    }

                    //alert(okay);
                    //$(this).css('background','red');
                }
            }
        });
        if(okay == 'yes'){
			var top = Number(200);
			$('.payments-options').html('<div style="text-align:center;width:100%;height:'+(top*2)+'px; position:relative;top:'+top+'px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');
            $('.payments-options').load('<?php echo base_url(); ?>home/cart_checkout/payments_options',
                function(){
                    var top_off = $('.header').height();
                    $('html, body').animate({
                        scrollTop: $(".payments-options").offset().top-(2*top_off)
                    }, 1000);
                }
            );
        } else {
            var top_off = $('.header').height();
            $('html, body').animate({
                scrollTop: $(".delivery_address").offset().top-(2*top_off)
            }, 1000);
        }
    }//if no error
    }

    function radio_check(id){
        $( "#visa" ).prop( "checked", false );
        $( "#mastercardd" ).prop( "checked", false );
        $( "#mastercard" ).prop( "checked", false );
        $( "#bitcoin" ).prop( "checked", false );
        $( "#"+id ).prop( "checked", true );
    }

    function ship_check(id){
        alert(id);
        $('.smclass').each(function(){
           $(this).prop( "checked", false ); 
        });
        $( "#"+id ).prop( "checked", true );
        jQuery( "[name='shipping_type']" ).val(id);
        load_orders();
    }
</script>
