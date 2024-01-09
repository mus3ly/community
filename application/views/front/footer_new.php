<style>
    .modal-header button{
            background: none;
    border: none;
    float: right;
    text-align: right;
    font-size: 20px;
    width: 100%;
    }
    .my_model_body{
            justify-content: center;
    display: flex;
    list-style: none;
    gap: 20px;
    font-size: 25px;
    }
    .my_modal_header{
    padding: 7px 10px;
    justify-content: end;
    }
    .center_my_modal{
        top:35%;
    }
    @media (min-width: 576px){
.modal-sm {
    --bs-modal-width: 390px;
}}
</style>
<?php
$url = base_url('updated/').'/';
$footer_text =  $this->db->get_where('general_settings',array('type' => 'footer_text'))->row()->value;
$footer_category =  $this->db->get_where('general_settings',array('type' => 'footer_category'))->row()->value;
$footer_page =  $this->db->get_where('general_settings',array('type' => 'footer_page'))->row()->value;
$footer_disc =  $this->db->get_where('general_settings',array('type' => 'footer_disc'))->row()->value;
?>
<footer class="footer_warp">

    <div class="container">

      <div class="footer_up">

        <!--footer logo start here-->

        <div class="footer_container first-container">

          <div class="row align-items-center">

            <div class="col-lg-3 col-md-6 footer_logo">

              <a href="#"><img src="<?= $url ?>assets/images/logo.png" class="img-fluid" alt=""></a>

              <form action="https://dev.communityhubland.com//home/subscribe"

                class="mhl_subscribe_fields subscribe_form mt-3" method="post" accept-charset="utf-8">

                <div class="input-group">

                  <input type="text" class="form-control" name="email" placeholder="Your Email">

                  <button class="btn send-btn signup_btn" loading='<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>
Submiting ...' type="button" ing= id="button-addon2">Subscribe</button>

                </div>

              </form>

            </div>

            <div class="col-md-3 offset-md-3">

            </div>

          </div>

          <!--footer logo Ends here-->

          <!--footer subscribe Starts here-->

        </div>

        <!--footer subscribe Ends here-->

        <div class="footer_container">

          <div class="flex_boxes_4 p-0">

            <!--meddle section-->

            <div class="row">

              <!--margin_in_between <div class="col-md-4 resposinve_set hide_me"> -->

              <div class="col-lg-5 col-md-12 col-sm-12">


                        <h4 class="about_title">About US</h4>
                <div class="about-full-wrap">

                  <div class="row">

                    <div class="col-lg-3 col-md-3 col-sm-3 col-3 ">

                     <div class="img-box">
                          <img src="https://studenthubland.com/updated/assets/images/volume.png" alt="">
                     </div>

                    </div>

                    <div class="col-lg-9 col-md-9 col-sm-9 col-9">

                      <div class="about-us mt-0">

                        <h6 class="about_title text-white">Digital Tools To Build Your Virtual Empire</h6>

                        <p>Hire for digital and marketing solutions through us, or sign-up and use our simplified set of digital tools to build your empire</p>

                      </div>

                    </div>

                  </div>

                </div>
                <div class="about-full-wrap">

                <div class="row">

                  <div class="col-lg-3 col-md-3 col-sm-3 col-3 ">

                    <div class="img-box">
                        <img src="https://studenthubland.com/updated/assets/images/green.jpeg" alt="">
                    </div>

                  </div>

                  <div class="col-lg-9 col-md-9 col-sm-9 col-9">

                    <div class="about-us mt-0">

                      <h6 class="about_title text-white">Business in Focus Green Goal Award Winner</h6>

                     
                      <p>On Community HubLand, you keep your carbon footprints at a barest minimum</p>
                      

                    </div>

                  </div>

                </div>

                </div>
                
                <div class="about-full-wrap">

                  <div class="row">

                    <div class="col-lg-3 col-md-3 col-sm-3 col-3">

                     <div class="img-box">
                          <img src="https://studenthubland.com/updated/assets/images/ten.png" alt="ten.png">
                          <div class="back-10"><h3>B<span>ac</span>k</h3></div>
                     </div>
                        
                    </div>

                    <div class="col-lg-9 col-md-9 col-sm-9 col-9">

                      <div class="about-us mt-0">

                        <h6 class="about_title text-white">Together We Build Back Better</h6>

                        <p>10% of our proceeds go back into communities to help build a better future for all</p>

                      </div>

                    </div>

                  </div>

                </div>
              </div>

              <div class="col-lg-3 col-md-5 col-sm-5 widget_column">

                <div class="sec_column">

                  <h4 class="add_margin_left">Community Pegs</h4>

                  <div class="align_footer">

                    <ul class="span_bullets">
                                           <?php
                        // die('come');
                        $x=0;
                        $brands = $this->db->get('category')->result_array();
                $categories =json_decode($this->db->get_where('ui_settings',array('ui_settings_id' => 86))->row()->value,true);
                                            $result=array();
                                            foreach($categories as $row){
                                                if($this->crud_model->if_publishable_category($row)){
                                                    $result[]=$row;
                                                }
                                            }

                    foreach ($brands as $key => $value) {
                        if(in_array($value['category_id'], $result))
                        {
                            $x++;
                            //  echo $value['category_id'];
                        ?>

                                <li class="span_bullets_arrows"><a href="<?= base_url('home/category/'.$value['category_id']); ?>"><?= $value['category_name'] ?></a></li>
                              <?php
                        }
                    }
                              ?>



                      

                    </ul>

                  </div>

                </div>

              </div>

              <div class="col-lg-2 col-md-4 col-sm-4 widget_column  for_mobile_left">



                <div class="third_column">

                  <h4>Company Info</h4>

                  <ul>
                    <?php 
                    $categories=json_decode($footer_page);
                    foreach ($categories as $key => $value) {
                        $row = $this->db->where('page_id',$value)->get('page')->row();
                        if($row)
                        {
                        ?>
                        <li><a href="<?= base_url($row->parmalink); ?>"><?= $row->page_name ?></li></a>
                        <?php
                        }
                    } 
                    ?>
                           </ul>

                </div>



              </div>

              <div class="col-lg-2 col-md-3 col-sm-3 widget_column  for_mobile_right">



                <div class="forth_column">

                  <h4>Discovery</h4>

                  <ul>
                    <?php 
                    $categories=json_decode($footer_disc);
                    foreach ($categories as $key => $value) {
                        $row = $this->db->where('page_id',$value)->get('page')->row();
                        if($row)
                        {
                        ?>
                        <li><a href="<?= base_url($row->parmalink); ?>"><?= $row->page_name ?></li></a>
                        <?php
                        }
                    }
                    ?>
 <li><a href="https://www.facebook.com/communityhubland/" style="padding-left: 0px!important; margin-right:5px;"><img src="<?= base_url(); ?>/uploads/product_image/Facebook_Logo_(2019).png" style="width:23px; "></a><a href="https://www.instagram.com/communityhubland/" style="padding-left: 0px!important; "><img src="<?= base_url(); ?>/uploads/product_image/Instagram-logo-free-download-PNG (1).png" style="width:30px;"></a></li>
                                      
                  </ul>

                </div>



              </div>



            </div>

          </div>

        </div>

      </div>



    </div>

    <div class="footer_container">

      <div class="footerbtn">

        <a href="vendor_logup/registration.html">

          SIGN-UP to Add a Listing

        </a>

        <a href="directory.html">
 
          Visit Directory

        </a>

        <a href="home/login_set/registration.html">

          Join Our Affiliate Marketing

        </a>

      </div>

    </div>

    </div>

    <!--meddle section-->



    <div class="mhl_copyright_footer">

      <div class="copyright_container">

        <p>Copyright &copy; 2023 <span>|</span> Community HubLand Ltd</p>

      </div>

    </div>

  </footer>
  <!-- The modal -->
  <div class="centered-div">
<div class="modal fade center_my_modal" id="shareicon" tabindex="-1" role="dialog" aria-labelledby="modalLabelSmall" aria-hidden="true">
<div class="modal-dialog modal-sm">
<div class="modal-content">

<div class="my_modal_header modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>

</div>

<div class="my_model_body modal-body">

</div>

</div>
</div>
</div>

</div>

  <!-- Vendor JS Files -->

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.2/jquery.min.js'></script>

  <script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.js'></script>

  <script src='https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js'></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.jsdelivr.net/npm/simple-notify@0.5.5/dist/simple-notify.min.js"></script>

  <script>
    function share_icon(id){
        var url = '<?= base_url(''); ?>home/share_icon/'+id;
        $('#shareicon').modal('toggle');
        $('#shareicon .modal-body').load(url);

    }
    var currency = '£';
    function IsJsonString(str) {
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return true;
}
window.onbeforeunload = function () {
  window.scrollTo(0, 0);
}
    $('body').on('click','.signup_btn',function(event){
			event.preventDefault();
			var now = $(this);
			now.attr("disabled", true);
			var btntxt = now.html();
			var form = now.closest('form');  
			var ing = now.attr('loading');
			var success = now.data('success');
			var unsuccessful = now.data('unsuccessful');
			var rld = now.data('reload');
			var callback = now.data('callback');
			var formdata = false;
			if (window.FormData){
				formdata = new FormData(form[0]);
			}
	
			$.ajax({
				url: form.attr('action'), // form action url
				type: 'POST', // form submit method get/post
				dataType: 'html', // request type html/json/xml
				data: formdata ? formdata : form.serialize(), // serialize form data 
				cache       : false,
				contentType : false,
				processData : false,
				beforeSend: function() {
					// now.attr('disabled','disabled');
					$(".btn_dis").attr('disabled','disabled');
					now.html(ing);
				},
				success: function(data) {
				    now.attr("disabled", false);
				    
				    if(parseInt(data.search("already")) >= 0)
				    {
				        // alert(data);
Swal.fire({
  icon: "error",
  title: "Oops...",
  text: "Your email alredy in list",
  footer: ''
});
				        
				    }
				    else if(parseInt(data.search("done")) >= 0)
				    {
				        // alert(data);
				        Swal.fire({
  title: "Yay!",
  text: "Successfully subscribe",
  icon: "success"
});
				        
				    }
				    else if(parseInt(data.search("refresh")) >= 0)
				    {
				        // alert(data);
				        setTimeout(function(){location.reload();}, 1000);
				        
				    }
				    else
				    {
				    
					if(data == 'done' || data.search('done') !== -1){
						notify(success,'success','bottom','right');
						if(rld == 'ok'){
							setTimeout(function(){location.reload();}, 2000);
						}
						if(callback == 'order_tracing'){
							// now.removeAttr('disabled');
							data = data.replace('done','');
        					$('#trace_details').html(data);
						}
						$(".closeModal").click();
					} else {
						$(".btn_dis").removeAttr('disabled');
						var text = '<div>'+unsuccessful+'</div>'+data;
						notify(text,'error','bottom','right','Alert');
					}
					
					now.html(btntxt);
				    }
				},
				error: function(e) {
				    noewattr("disabled", false);
					console.log(e)
				}
			});
		});
    function isEmail(emailAdress){
    let regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

  if (emailAdress.match(regex)) 
    return true; 

   else 
    return false; 
}
    function SEND_CONTACT(pid)
    {



        var url = 'https://communityhubland.com/home/contact_us';

        var fname = $('#fname__').val();

        var lname = $('#lname').val();

        var email = $('#email__').val();
        if(!isEmail(email))
        {
            Swal.fire({
  icon: "error",
  title: "Oops...",
  text: "Check if your email is correctly written, and whether all fields are entered.",
  footer: '<a href="#">Why do I have this issue?</a>'
});
        }

        var msg = $('#message__').val();

        var phone = $('#phone').val();

        $.ajax({

            url: url,

            type: "get",

            async: true,



            data: {  fname:fname, email:email, message:msg,phone:phone,lname:lname,pid:pid },

            success: function (data) {

                // const myArr = JSON.parse(JSON.stringify(data));

                if(data == 1){
                        $('form')[0].reset();


                    Swal.fire({
  title: "Yay!",
  text: "The vendor will be in touch with you, thank you for contacting.",
  icon: "success"
});

                }else{

                    $("#danger").attr("class", "alert alert-danger d-block");

                }

            },

            error: function (xhr, exception) {

                var msg = "";

                if (xhr.status === 0) {

                    msg = "Not connect.\n Verify Network." + xhr.responseText;

                } else if (xhr.status == 404) {

                    msg = "Requested page not found. [404]" + xhr.responseText;

                } else if (xhr.status == 500) {

                    msg = "Internal Server Error [500]." +  xhr.responseText;

                } else if (exception === "parsererror") {

                    msg = "Requested JSON parse failed.";

                } else if (exception === "timeout") {

                    msg = "Time out error." + xhr.responseText;

                } else if (exception === "abort") {

                    msg = "Ajax request aborted.";

                } else {

                    msg = "Error:" + xhr.status + " " + xhr.responseText;

                }



            }

        });





    }
</script>
    <?php
    if(!isset($product))
    {
        ?>
  <script src="<?= $url ?>/assets/js/custom-select.js"></script>
  <?php
    }
    ?>
    <script>
    
  function notify(message,type,from,align,title){ 
      new Notify({
    status: type,
    title: title,
    text: message,
    effect: 'fade',
    speed: 300,
    customClass: null,
    customIcon: null,
    showIcon: true,
    showCloseButton: true,
    autoclose: true,
    autotimeout: 3000,
    gap: 20,
    distance: 20,
    type: 1,
    position: 'right top'
  })
    
  }
  
      function to_wishlist(id,e){ 
    e = e || window.event;
    e = e.target || e.srcElement;
    var state     = check_login_stat('state');
    var product   = id;
    var button    = $(e);
    var alread    = button.html();
    if(button.is("i")){
      var alread_classes = button.attr('class');  
    }   
    state.success(function (data) {
      if(data == 'hypass'){
        $.ajax({
          url: base_url+'home/wishlist/add/'+product,
          beforeSend: function() {
            if(button.is("i")){
              button.attr('class','fa fa-spinner fa-spin fa-fw'); 
            } else {
              button.find('i').attr('class','fa fa-spinner fa-spin fa-fw'); 
            } 
          },
          success: function(data) {
            if(data == ''){
              notify(wishlist_add,'info','bottom','right','Cart successfully added');
            } else {
              notify(wishlist_already,'warning','bottom','right','Cart warning');
            }
            if(button.is("i")){
              button.attr('class',alread_classes);  
            } else {
              button.html(alread);  
            }
          },
          error: function(e) {
            console.log(e)
          }
        });
      } else {
        signin();
      }
    });
  }
  function reload_header_cart(){
      $.getJSON('<?= base_url(); ?>'+"/home/cart/whole_list", function(result){
      var total = 0;
      var whole_list = '';
      var count = Object.keys(result).length;
      $('.cart_num').html(count);
      $('.header__cart__indicator').html(currency+total.toFixed(2));
      $('.shopping-cart__top').html('Your Cart('+count+')');
      $('.top_carted_list').html(whole_list);
      $('.shopping-cart__total').html(currency+total.toFixed(2)); 
      });
  }
  $(document).ready(function(){
            reload_header_cart();
  });
  
  function to_cart(id,e){
    var product = id;   
    e = e || window.event;
    e = e.target || e.srcElement;
    var elm_type = $(e).data('type');
    var button = $(e);
    var alread = button.html();
    if(button.is("i")){
      var alread_classes = button.attr('class');  
    }
    var type = 'pp';
    if(button.closest('.row').find('.cart_quantity').length){
      quantity = button.closest('.margin-bottom-40').find('.cart_quantity').val();
    }
    
    if($('#pnopoi').length){
      type = 'pp';
      var form = button.closest('form');
      var formdata = false;
      if (window.FormData){
        formdata = new FormData(form[0]);
      }
      var option = formdata ? formdata : form.serialize();
    } else {
      type = 'other';
      var form = $('#cart_form_singl');
      var formdata = false;
      if (window.FormData){
        formdata = new FormData(form[0]);
      }
      var option = formdata ? formdata : form.serialize();
    }
    
    $.ajax({
      url     : '<?= base_url(); ?>'+'/home/cart/add/'+product+'/'+type,
      type    : 'POST', // form submit method get/post
      dataType  : 'html', // request type html/json/xml
      data    : option, // serialize form data 
      cache       : false,
      contentType : false,
      processData : false,
      beforeSend: function() {
        if(button.is("i")){
          button.attr('class','fa fa-spinner fa-spin fa-fw'); 
        } else {
          button.find('i').attr('class','fa fa-spinner fa-spin fa-fw'); 
        }     
      },
      success: function(data) {
        $('.ajax-to-cart').removeClass('btn--wait');
        if(data == ' added'){
          reload_header_cart();
          notify('Add to cart successfully!','success','bottom','right');
          
          //sound('successful_cart');
        } else if (data == 'shortage'){
          notify(quantity_exceeds,'warning','bottom','right');
          //sound('cart_shortage');
        } else if (data == 'already'){
          notify(product_already,'warning','bottom','right');
          //sound('already_cart');
        }
        if(button.is("i")){
          button.attr('class',alread_classes);  
        } else {
          button.html(alread);  
        } 
      },
      error: function(e) {
        console.log(e)
      }
    });
  }
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js" integrity="sha512-efUTj3HdSPwWJ9gjfGR71X9cvsrthIA78/Fvd/IN+fttQVy7XWkOAXb295j8B3cmm/kFKVxjiNYzKw9IQJHIuQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <?php

  if(isset($directory))

  {

      ?>
      <script>
  $( function() {
    // Find all slider elements with the class "slider-range"
    var sliders = $('.slider-range');

    sliders.each(function() {
      // Get min and max values from data attributes for each slider
      var slider = $(this);
      var dynamicMin = <?= (isset($_GET['sale_price']) && explode('-',$_GET['sale_price'])[0])?explode('-',$_GET['sale_price'])[0]:1; ?>;
      var dynamicMax = <?= (isset($_GET['sale_price']) && explode('-',$_GET['sale_price'])[1])?explode('-',$_GET['sale_price'])[1]:$max_price; ?>;
      
      // Get default values from data attributes
      var defaultMin = slider.data('default-min');
      var defaultMax = slider.data('default-max');

      var dynamicId = slider.data('id');
      
      
      $('#'+dynamicId).val(defaultMin + " - " + defaultMax)

      slider.slider({
        range: true,
        min: dynamicMin,
        max: dynamicMax,
        values: [defaultMin, defaultMax],
        slide: function( event, ui ) {
          // Find the corresponding input element for each slider
        //   var amountInput = slider.siblings('.amount');
        //   amountInput.val("₹" + ui.values[0] + " - ₹" + ui.values[1]);
        //   console.log(ui.values[0] + " - " + ui.values[1])
          
          $('#'+dynamicId).val( ui.values[0] + " - " + ui.values[1]);
          $('#sale_price').val( ui.values[0] + "-" + ui.values[1]);
        }
      });
      
      // Find the corresponding input element for each slider and set initial value
      var amountInput = slider.siblings('.amount');
      amountInput.val("₹" + dynamicMin + " - ₹" + dynamicMax);
    });
  } );
  </script>
      <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/chosen/1.1.0/chosen.jquery.min.js"></script>
      <script>
      $('.demo-chosen-select').chosen();
      function select_country(id)
    {
        $('#form_country').val(id);
        submit_dform();
    }
        function search_location()
{

    console.log("Here");

    var str = $('#right_box').val();
    //
    console.log();
    if(str.length >= 2 )
    {
        $('#location-result').show();
        $('#location-result').html('Loading ');
        $.ajax({
        url: "<?= base_url('home/srch_loc'); ?>?str="+str,
        type: 'GET',
        // dataType: 'json', // added data type
        success: function(res) {
            $('#location-result').html(res);
            // alert(res);
        }
    });

    }
    else
    {
        $('#map_search #result').hide();
    }
}
function select_place(place,txt)
{
    console.log(place, txt);
    $('#right_box').val(txt);
    $('#place_id').val(place);
    $('#location-result').hide();
    $('#location-result').html('' );
    if(directory)
    {
        submit_dform();
    }

}
</script> 

      <script type="text/javascript">
      function ch_price()
      {
          <?php
         $is_fil = false;
               $max = $max_price;
               $sale_check =0;
               if($cat_path)
               {
               $this->db->where_in('category',$cat_path);
               $sale_check = $this->db->where('is_filter',1)->where('tbl_col','sale_price')->get('list_fields')->row();
               }
            if($sale_check || (isset($is_listing) && $is_listing == 'shop_listing')){
                $is_fil = true;
                    ?>
          var sort = document.getElementById("myRange").value;
          $('#sale_price').val('1-'+sort);
    $('#max_price').text(sort);
          <?php
            }
          ?>
    
      }
      function ch_dist()
      {
          var sort = document.getElementById("mydRange").value;
    // document.getElementById().value = '1'+'-'+sort;
    $('#dis_range_input').val(sort);
    $('#dis_price').text(sort); 
      }

function set_value(id, val)

{

    document.getElementById(id).value = val; 

    submit_dform();



    



}
$('.select-items div').click(function(){
    // submit_dform();
    
});

function submit_dform()
{
         <?php
         $is_fil = false;
               $max = $max_price;
               $sale_check =0;
               if($cat_path)
               {
               $this->db->where_in('category',$cat_path);
               $sale_check = $this->db->where('is_filter',1)->where('tbl_col','sale_price')->get('list_fields')->row();
               }
            if($sale_check || (isset($is_listing) && $is_listing == 'shop_listing')){
                $is_fil = true;
                    ?>
          var sort = document.getElementById("myRange").value;
    $('#sale_price').val('0-'+sort);
          <?php
            }
          ?>
    
    var sort = document.getElementById("select_sort").value;
    $('#form_sort').val(sort);

    document.forms["dir_form"].submit(); 

}

function change_make()

{

    var dis_range_select = document.getElementById("select_make").value;

    set_value('make_input',dis_range_select);

}

function propert_filter()

{

    var select_condition = document.getElementById("dis_range").value;

    var select_condition = document.getElementById("myRange").value;

    document.getElementById('max_price').value = select_condition;

    var select_condition = document.getElementById("listing_type_select").value;

    document.getElementById('listing_type').value = select_condition;

    var select_condition = document.getElementById("bedrooms_input").value;

    document.getElementById('bedroom').value = select_condition;

    submit_dform();

}

function job_filter()

{

    /*var select_condition = document.getElementById("myRange").value;

    document.getElementById('max_price').value = select_condition;/*/

    var select_condition = document.getElementById("select_job_type").value;

    document.getElementById('job_type').value = select_condition;

    var select_condition = document.getElementById("select_job_hours").value;

    document.getElementById('job_hours').value = select_condition;

    submit_dform();

}

function car_filter()

{

    var dis_range_select = document.getElementById("select_make").value;

    document.getElementById('make_input').value = dis_range_select;

    var modelf_input = document.getElementById("modelf_input").value;

    document.getElementById('modelf').value = modelf_input;

    var modelt_input = document.getElementById("modelt_input").value;

    document.getElementById('modelt').value = modelt_input;

    var seats_input = document.getElementById("seats_input").value;

    document.getElementById('seats').value = seats_input;

    var select_condition = document.getElementById("select_condition").value;

    document.getElementById('condition_input').value = select_condition;

    var select_condition = document.getElementById("myRange").value;

    document.getElementById('max_price').value = select_condition;

    var select_condition = document.getElementById("listing_type_select").value;

    document.getElementById('listing_type').value = select_condition;

    submit_dform();

}

function custom_filter(cat)

{

    <?php

    if($cat_path)

    {

       $max = $max_price;

       $this->db->where_in('category',$cat_path);

       $sale_check = $this->db->where('is_filter',1)->where('tbl_col','sale_price')->get('list_fields')->row();

                   

    }

            if($sale_check || (isset($is_listing) && $is_listing == 'shop_listing')){

                    ?>

                    var select_condition = document.getElementById("myRange").value;

    document.getElementById('sale_price').value = select_condition;

                    

                    <?php

            }

                    ?>

    /*if(cat == '807')

    {

    var select_condition = document.getElementById("myRange").value;

    document.getElementById('max_price').value = select_condition;

    var select_condition = document.getElementById("type_vehicle_filter").value;

    document.getElementById('listing_type').value = select_condition;

    var seats_input = document.getElementById("vehicle_Seats_filter").value;

    document.getElementById('seats').value = seats_input;

    var select_condition = document.getElementById("car_condition_filter").value;

    document.getElementById('condition_input').value = select_condition;

    var select_condition = document.getElementById("car_condition_filter").value;

    document.getElementById('condition_input').value = select_condition;

    var dis_range_select = document.getElementById("modal_filter").value;

    document.getElementById('make_input').value = dis_range_select;

    var dis_range_select = document.getElementById("make_filter").value;

    document.getElementById('make_input').value = dis_range_select;

    */

    submit_dform();

}

function update_filter(id,col)
        {
            

            var input = document.getElementById(id+'_filter');

            var value = input.value;
            // alert(value);

            if(value == 'other' && input.getAttribute('type') == 'model')
            {

                var outer = id+'_outer';  
                alert(outer);

             var html = '<input type="text" id="'+input.getAttribute('id')+'" col="'+input.getAttribute('col')+'" rows="9" onkeyup="'+input.getAttribute('onchange')+'" class="form-control required" placeholder="'+input.getAttribute('placeholder')+'" data-height="100" name="ad_field_values[]">';

             document.getElementById(outer).innerHTML = html;

            }
            else
            {

            document.getElementById(col).value = value; 

            }
            submit_dform();
            return 0;



        }

        

        function ch_url(slug)

        {

            //dir_form

            var url = '<?= base_url('/directory'); ?>/'+slug;

            $('#dir_form').attr('action',url);

            

            $('#dir_form').submit();

             submit_dform();

        }
        <?php
        if(isset($max_price))
        {
            ?>
            var max_price = '<?= $max_price ?>';
            <?php
        }
        ?>

        

    

</script>

      <?php

  }
  elseif(isset($bpage))
  {
      ?>
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

      <script>
      function select_rate(r)
    {
        $('#rate').val(r);
        var tot = '<?= $tot ?>';
        for(var i=1;i<=tot;i++)
        {
            var mid = '#star'+i;
            if(i<= r)
            {
                $(mid).addClass('checked');
            }
            else
            {
                $(mid).removeClass('checked');
            }
        }
    }

    function send_rate(){
        Swal.fire({
  title: 'Are you sure?',
  text: "You can post only ONCE! Please ensure your review is your true rating of this business!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, add it!'
}).then((result) => {
  if (result.isConfirmed) {
      var form = $('#rform');

        var here = $(this);

        $.ajax({

            url: form.attr('action')+'?'+form.serialize(), // form action url

            type: 'POST', // form submit method get/post

            dataType: 'html', // request type html/json/xml

            data: form.serialize(), // serialize form data

            cache       : false,

            contentType : false,

            processData : false,

            beforeSend: function() {

                here.addClass('disabled');

                here.html('submitting'); // change submit button text

            },

            success: function(data) {

                here.fadeIn();

                here.html('Post Review');

                here.removeClass('disabled');

                if(data == " ok"){

                    // notify('Review add successfully!','success','bottom','right');
                    Swal.fire(
      'Success!',
      'Review add successfully!',
      'success'
    )

                    // window.location.replace("<?php echo $this->crud_model->product_link($pro['product_id']); ?>");



                }else {
                                    Swal.fire(
      'Oops!',
      data,
      'error'
    )

                    notify(data,'warning','bottom','right');

                }

            },

            error: function(e) {

                console.log(e)

            }

        });
    
  }
})
        

    }
    </script>
      <?php
  }
  elseif(isset($profile))
  {
      ?>
      <script>
      $('body').on('click', '.remove_from_wish', function(){
    var product = $(this).data('pid');
    var button = $(this);
    $.ajax({
      url: base_url+'home/wishlist/remove/'+product,
      beforeSend: function() {
        button.parent().parent().hide('fast');
      },
      success: function(data) {
        ajax_load(base_url+'home/wishlist/num/','wishlist_num');
        button.parent().parent().remove();
        notify(wishlist_remove,'info','bottom','right');
      },
      error: function(e) {
        console.log(e)
      }
    });
    });
      $(document).ready(function(){
          <?php
          if(isset($_GET['page']))
          {
              ?>
              load_section('<?= $_GET['page'] ?>');
              <?php
          }
          else
          {
              ?>
              load_section('info');
              <?php
          }
          ?>
          
      });
          function load_section(sec){
            //   alert(sec);
              $('.options-title').each(function(i, obj) {
    $(this).removeClass('active');
});
              var mid = '#'+sec+'_item > .options-title';
              $(mid).addClass('active');
              $('#result').html('Loading ....');
              $.ajax({
        url: '<?= base_url('/home/profile'); ?>/'+sec,
        type: "get",
        async: true,
        data: { },
        success: function (data) {
           $('#result').html(data);
        },
        error: function (xhr, exception) {
            var msg = "";
            if (xhr.status === 0) {
                msg = "Not connect.\n Verify Network." + xhr.responseText;
            } else if (xhr.status == 404) {
                msg = "Requested page not found. [404]" + xhr.responseText;
            } else if (xhr.status == 500) {
                msg = "Internal Server Error [500]." +  xhr.responseText;
            } else if (exception === "parsererror") {
                msg = "Requested JSON parse failed.";
            } else if (exception === "timeout") {
                msg = "Time out error." + xhr.responseText;
            } else if (exception === "abort") {
                msg = "Ajax request aborted.";
            } else {
                msg = "Error:" + xhr.status + " " + xhr.responseText;
            }
           
        }
    }); 

          }
      </script>
      <?php
  }
  elseif(isset($home))
  {
      ?>
      <script>
        function search_location()
{

    console.log("Here");

    var str = $('#right_box').val();
    //
    console.log();
    if(str.length >= 2 )
    {
        $('#location-result').show();
        $('#location-result').html('Loading ');
        $.ajax({
        url: "<?= base_url('home/srch_loc'); ?>?str="+str,
        type: 'GET',
        // dataType: 'json', // added data type
        success: function(res) {
            $('#location-result').html(res);
            // alert(res);
        }
    });

    }
    else
    {
        $('#map_search #result').hide();
    }
}
function select_place(place,txt)
{
    console.log(place, txt);
    $('#right_box').val(txt);
    $('#place_id').val(place);
    $('#location-result').hide();
    $('#location-result').html('' );
    if(directory)
    {
        submit_dform();
    }

}
</script> 
      <?php
  }

  ?>



  <!-- Template Main JS File -->
  <script>
  base_url = '<?= base_url() ?>';
      function to_wishlist(id,e){ 
    e = e || window.event;
    e = e.target || e.srcElement;
    var state     = check_login_stat('state');
    var product   = id;
    var button    = $(e);
    var alread    = button.html();
    if(button.is("i")){
      var alread_classes = button.attr('class');  
    }   
    state.success(function (data) {
      if(data == 'hypass'){
        $.ajax({
          url: base_url+'home/wishlist/add/'+product,
          beforeSend: function() {
            if(button.is("i")){
              button.attr('class','fa fa-spinner fa-spin fa-fw'); 
            } else {
              button.find('i').attr('class','fa fa-spinner fa-spin fa-fw'); 
            } 
          },
          success: function(data) {
            if(data == ''){
                
              notify(wishlist_add,'info','bottom','right','Wishlist');
            } else {
              notify(wishlist_already,'warning','bottom','right' ,'Wishlist');
            }
            if(button.is("i")){
              button.attr('class',alread_classes);  
            } else {
              button.html(alread);  
            }
          },
          error: function(e) {
            console.log(e)
          }
        });
      } else {
        signin();
      }
    });
  }
  </script>
  
  
  <script src="<?= $url ?>/assets/js/main.js"></script>
  

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  
    <script>
    $('#button-addon2').click(function(){
        var mail = $('#email_send').val();
        $.ajax({
        url: '<?=base_url('home/subscribe')?>',
        type: "Post",
        async: true,
        data: { email : mail },
        success: function (data) {
           if(data == ' done'){
               
                $('#msg_email').text("Subscribed Successfully!");
           }else{
               alert('error');
           }
        },
        error: function (xhr, exception) {
            var msg = "";
            if (xhr.status === 0) {
                msg = "Not connect.\n Verify Network." + xhr.responseText;
            } else if (xhr.status == 404) {
                msg = "Requested page not found. [404]" + xhr.responseText;
            } else if (xhr.status == 500) {
                msg = "Internal Server Error [500]." +  xhr.responseText;
            } else if (exception === "parsererror") {
                msg = "Requested JSON parse failed.";
            } else if (exception === "timeout") {
                msg = "Time out error." + xhr.responseText;
            } else if (exception === "abort") {
                msg = "Ajax request aborted.";
            } else {
                msg = "Error:" + xhr.status + " " + xhr.responseText;
            }
           
        }
    }); 

    })
        
    </script>
    <script type="text/javascript">
      $('#shareit').click(function(){
      $('.social_mediabox').toggle();
      });
    </script>
    
    <!--shaheer work-->
  <script>
     $(document).ready(function(){
    $('.panel-heading a').click(function(){

        var accordionId = $(this).data('accordion-id');

        $('#acordian_open' + accordionId).toggle();
    });
});
function ajax_load(url,id,type){
		var list = $('#'+id);
		$.ajax({
			url: url, // form action url
    		cache: false,
        	dataType: "html",
			beforeSend: function() {
				//list.fadeOut();

				if(type !== 'other'){
					list.html(loading); // change submit button text
				}
			},
			success: function(data) {
				if(data !== ''){
					list.html('');
					list.html(data).fadeIn(); // fade in response data
				}
				if(type == 'first'){
					$('#demo-table').bootstrapTable();
					set_switchery();
					$('#demo-table img').each(function() {
						if($(this).attr('src') !== ''){
							if($(this).data('im') !== 'fb'){
						    	$(this).attr('src', $(this).attr('src')+'?random='+new Date().getTime());
							}
						}
					});
				} else if(type=='form') {
					//reloadStylesheets();
			        $('#demo-tp-textinput').timepicker({
			            minuteStep: 5,
			            showInputs: false,
			            disableFocus: true
			        });
			        
				} else if(type=='delete') {
					ajax_load(base_url+''+user_type+'/'+module+'/'+list_cont_func,'list','first');
					other_delete();
				} else if(type=='other') {
					other();
				} else if(type == 'signup_cat'){
					var noty = 'Category update successfully!';
					$.activeitNoty({
						type: 'success',
						icon : 'fa fa-check',
						message : noty,
						container : 'floating',
						timer : 3000
					});
					
					sound('done');
				// 	ajax_set_list();
				} else if(type == 'pegs'){
					var noty = 'Pegs update successfully!';
					$.activeitNoty({
						type: 'success',
						icon : 'fa fa-check',
						message : noty,
						container : 'floating',
						timer : 3000
					});
					
					sound('done');
				// 	alert();
				//  	ajax_set_list();
				}
			},
			error: function(e) {
				console.log(e)
			}
		});
	}

    </script>
    <!--shaheer work-->
    
    
</body>



</html>