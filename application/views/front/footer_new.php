
<?php
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

                  <input type="text" class="form-control" id="email_send" placeholder="Your Email">

                  <button class="btn send-btn" type="button" id="button-addon2">Subscribe</button>
                    
                </div>
                <div class="success_msg">
                    <p id="msg_email"></p>
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

                    <div class="col-4">

                      <img src="<?= $url ?>assets/images/volume.png" alt="">

                    </div>

                    <div class="col-8">

                      <div class="about-us mt-0">

                        <h6 class="about_title text-white">Digital Tools To Build Your Virtual Empire</h6>

                        <p>Hire for digital and marketing solutions through us, or sign-up and use our simplified set of digital tools to build your empire</p>

                      </div>

                    </div>

                  </div>

                </div>
                <div class="about-full-wrap">

                <div class="row">

                  <div class="col-4">

                    <img src="<?= $url ?>assets/images/green.jpeg" alt="">

                  </div>

                  <div class="col-8">

                    <div class="about-us mt-0">

                      <h6 class="about_title text-white">Business in Focus Green Goal Award Winner</h6>

                     
                      <p>On Community HubLand, you keep your carbon footprints at a barest minimum</p>
                      

                    </div>

                  </div>

                </div>

                </div>
                
                <div class="about-full-wrap">

                  <div class="row">

                    <div class="col-4">

                      <img src="<?= $url ?>assets/images/volume.png" alt="">

                    </div>

                    <div class="col-8">

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
                        <li><a href="<?= base_url('home/page/'.$row->parmalink); ?>"><?= $row->page_name ?></li></a>
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
                        <li><a href="<?= base_url('home/page/'.$row->parmalink); ?>"><?= $row->page_name ?></li></a>
                        <?php
                        }
                    }
                    ?>

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



  <!-- Vendor JS Files -->

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.2/jquery.min.js'></script>

  <script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.js'></script>

  <script src='https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js'></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://unpkg.com/aos@next/dist/aos.js"></script>

  <script src="<?= $url ?>/assets/js/custom-select.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js" integrity="sha512-efUTj3HdSPwWJ9gjfGR71X9cvsrthIA78/Fvd/IN+fttQVy7XWkOAXb295j8B3cmm/kFKVxjiNYzKw9IQJHIuQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <?php

  if(isset($directory))

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

      <script type="text/javascript">
      function ch_price()
      {
          var sort = document.getElementById("myRange").value;
    $('#sale_price').val(sort);
    $('#max_price').text(sort);
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
    submit_dform();
    
});

function submit_dform()
{
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

            if(value == 'other' && input.getAttribute('type') == 'model')

            {

                var outer = id+'_outer';  

             var html = '<input type="text" id="'+input.getAttribute('id')+'" col="'+input.getAttribute('col')+'" rows="9" onkeyup="'+input.getAttribute('onchange')+'" class="form-control required" placeholder="'+input.getAttribute('placeholder')+'" data-height="100" name="ad_field_values[]">';

             document.getElementById(outer).innerHTML = html;

            }

            else

            {

            document.getElementById(col).value = value; 

            }



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
              notify(wishlist_add,'info','bottom','right');
            } else {
              notify(wishlist_already,'warning','bottom','right');
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
  <script>
  function notify(message,type,from,align){ 
      $.notify(message, type);
    
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
              notify(wishlist_add,'info','bottom','right');
            } else {
              notify(wishlist_already,'warning','bottom','right');
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
      $.getJSON(base_url+"home/cart/whole_list", function(result){
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
    alert('OK');
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
      url     : base_url+'home/cart/add/'+product+'/'+type,
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
  
  <script src="<?= $url ?>/assets/js/main.js"></script>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    // Find all slider elements with the class "slider-range"
    var sliders = $('.slider-range');

    sliders.each(function() {
      // Get min and max values from data attributes for each slider
      var slider = $(this);
      var dynamicMin = slider.data('min');
      var dynamicMax = slider.data('max');
      
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
          
          $('#'+dynamicId).val( ui.values[0] + " - " + ui.values[1])
        }
      });
      
      // Find the corresponding input element for each slider and set initial value
      var amountInput = slider.siblings('.amount');
      amountInput.val("₹" + dynamicMin + " - ₹" + dynamicMax);
    });
  } );
  </script>
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
</body>



</html>