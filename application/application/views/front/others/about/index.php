<!-- PAGE -->

<?php 

    $contact_address =  $this->db->get_where('general_settings',array('type' => 'contact_address'))->row()->value;

    $contact_phone =  $this->db->get_where('general_settings',array('type' => 'contact_phone'))->row()->value;

    $contact_email =  $this->db->get_where('general_settings',array('type' => 'contact_email'))->row()->value;

    $contact_website =  $this->db->get_where('general_settings',array('type' => 'contact_website'))->row()->value;

    $contact_about =  $this->db->get_where('general_settings',array('type' => 'contact_about'))->row()->value;

?>
<section class="contactUs aboutUs">
  <div class="headoffice">
    <div class="headofficeImg">
      <img src="https://marketplace.hypeplug.paris/uploads/logo_image/contact-us-background-1024x533.jpg">
    </div>
    <div class="headofficeaddress in_aboutheadofficeaddress">
      <h2>About Us</h2>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-md-6 col-sm-6">
        <div class="aboutUsImg">
        <img src="https://marketplace.hypeplug.paris/uploads/logo_image/DSC03957.jpg">
      </div>
      </div>
      <div class="col-md-6 col-sm-6">
        <div class="aboutText">
          <h2>The HypePlug Story</h2>
          <p>Since 2019, <a href="#">HypePlug</a> has acted as a market maker for hundreds of sneaker buyers and sellers. By connecting these actors HypePlug has built one of the most extensive grassroots networks in the European sneaker scene, and have amassed a <a href="#">collection</a> which we are starting to show to the world.</p>
          <p>With our vast experience acting as, and with, buyers and sellers, HypePlug is now curating a rich community of verified vendors and buyers to create the perfect global sneaker ecosystem, with all stakeholders in mind.</p>

          <p>Know that your sneakers have come from an authentic source and important member of the colourful sneaker community. </p>

          <p>Buy, sell, trade and discuss with confidence.</p> 

          <p>The Team: Zaki, Marco, Marijose, and Patrick</p>
        </div>  
      </div>
    </div>
    <div class="whyUs">
      <div class="row">
        <h2>Why Choose Us</h2>
        <div class="col-md-4 col-sm-4">
          <div class="whyUsbox">
            <i class="fa fa-truck"></i>
            <strong>3 Day Processing & Free Delivery </strong> 
            <p>All prices include the final delivery if you are a European shopper. This means ZERO hidden fees. All of our items are also on hand and ready-to-ship, no waiting times before tracking.</p>
          </div>
        </div>
        <div class="col-md-4 col-sm-4">
          <div class="whyUsbox">
            <i class="fa fa-credit-card"></i>
            <strong>Secure Payment</strong>
            <p>Pay securely with your credit card, debit card, or PayPal. We operate with the highest online security standards as set by EU regulations.</p>
          </div>
        </div>
        <div class="col-md-4 col-sm-4">
          <div class="whyUsbox">
            <i class="fa fa-comment-o"></i>
            <strong>24/7 Support</strong>
            <p>Contact our team with multilingual support. We are always in touch with our community and are always available.</p>
          </div>
        </div>
      </div>
    </div> 
      
  </div>
  
</section>  


<!-- /PAGE -->

<script>

    $("body").on('change','.email',function(){

        var value=$(this).val();

        var here=$(this);

        var txt='<?php echo translate('enter_valid_email_address')?>';

        if(isValidEmailAddress(value) !== true){

            here.css({borderColor: 'red'});

            here.closest('div').find('.require_alert').remove();

            here.closest('.form-group').append(''

                +'  <span id="" class="require_alert" >'

                +'      '+txt

                +'  </span>'

            );

        } else{

        }

    });

     $('#contact-form').on('click','.submitter12', function(){

        var herea = $(this); // alert div for show alert message

        var form = herea.closest('form');

        var ing = herea.data('ing');

        var msg = herea.data('msg');

        var prv = herea.html();

        var sent = '<?php echo translate('message_sent_successfully')?>';

        var can = '';

        var captcha_incorrect = '<?php echo translate('please_fill_the_captcha'); ?>'

        var incorrect = '<?php echo translate('incorrect_information').'. '.translate('check_again').'!';?>'

        var l = '';

        var formdata = false;

        if (window.FormData){

            formdata = new FormData(form[0]);

        }

        var email=$('.email').val();

        if(isValidEmailAddress(email)==true){

            can ='yes';

        }else{

            can ='no';

        }

        $('#contact-form .test').each(function() {

            var it=$(this);

            if(it.val()==''){

                it.css({borderColor: 'red'});

                it.closest('div').find('.require_alert').remove();

                it.closest('.form-group').append(''

                    +'  <span id="" class="require_alert" >'

                    +'      <?php echo translate('this_field_is_required!')?>'

                    +'  </span>'

                );

                can ='no';

            }

        });

        

        if(can !== 'no'){

            $.ajax({

                url: form.attr('action'), // form action url

                type: 'POST', // form submit method get/post

                dataType: 'html', // request type html/json/xml

                data: formdata ? formdata : form.serialize(), // serialize form data 

                cache       : false,

                contentType : false,

                processData : false,

                beforeSend: function() {

                    herea.html(ing); // change submit button text

                },

                success: function(data) {

                    herea.fadeIn();

                    herea.html(prv);

                    if(data == 'sent'){

                        //sound('message_sent');

                        notify(sent,'success','bottom','right');

                        setTimeout(

                            function() {

                                location.replace("<?php echo base_url(); ?>home/contact");

                            }, 2000

                        );

                    } else if (data == 'captcha_incorrect'){

                        //sound('captcha_incorrect');

                        $('#recaptcha_reload_btn').click();

                        notify(captcha_incorrect,'warning','bottom','right');

                        

                    }else {

                        notify(data,'warning','bottom','right');

                    }

                },

                error: function(e) {

                    console.log(e)

                }

            });

        }else{

            notify(incorrect,'warning','bottom','right');

        }

    });

    

    $("#contact-form").on('change','.test',function(){

        var here = $(this);

        here.css({borderColor: '#dcdcdc'});

        

        if (here.attr('type') == 'email'){

            if(isValidEmailAddress(here.val())){

                here.closest('div').find('.require_alert').remove();

            }

        } else {

            here.closest('div').find('.require_alert').remove();

        }

        if(here.is('select')){

            here.closest('div').find('.chosen-single').css({borderColor: '#dcdcdc'});

        }

    });

    

    function isValidEmailAddress(emailAddress) {

        var pattern = new RegExp(/^(("[\w-+\s]+")|([\w-+]+(?:\.[\w-+]+)*)|("[\w-+\s]+")([\w-+]+(?:\.[\w-+]+)*))(@((?:[\w-+]+\.)*\w[\w-+]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][\d]\.|1[\d]{2}\.|[\d]{1,2}\.))((25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\.){2}(25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\]?$)/i);

        return pattern.test(emailAddress);

    };

</script>