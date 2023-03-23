<!-- PAGE -->

<?php 

    $contact_address =  $this->db->get_where('general_settings',array('type' => 'contact_address'))->row()->value;

    $contact_phone =  $this->db->get_where('general_settings',array('type' => 'contact_phone'))->row()->value;

    $contact_email =  $this->db->get_where('general_settings',array('type' => 'contact_email'))->row()->value;

    $contact_website =  $this->db->get_where('general_settings',array('type' => 'contact_website'))->row()->value;

    $contact_about =  $this->db->get_where('general_settings',array('type' => 'contact_about'))->row()->value;

?>

<section class="contactUs">
  <div class="headoffice">
    <div class="headofficeImg">
      <img src="https://socialmedia9.com/hypeplug/images/slider12.jpg">
    </div>
    <div class="headofficeaddress">
      <p>get in touch</p>
      <h2>HypePlug Paris HQ</h2>
      <strong>Head Office</strong>
      <ul class="elementor-icon-list-items">
          <li class="elementor-icon-list-item">
              <span class="elementor-icon-list-icon">
                <i class="fa fa-map" aria-hidden="true"></i>           
              </span>
              <span class="elementor-icon-list-text">68 Rue du Faubourg Saint-Honoré, Paris 75008</span>
          </li>
          <li class="elementor-icon-list-item">
              <span class="elementor-icon-list-icon">
                <i class="fa fa-envelope" aria-hidden="true"></i>            
              </span>
              <span class="elementor-icon-list-text">contact@hypeplug.paris</span>
          </li>
          <li class="elementor-icon-list-item">
            <span class="elementor-icon-list-icon">
              <i class="fa fa-phone" aria-hidden="true"></i>           
            </span>
            <span class="elementor-icon-list-text">+844 123 456 78</span>
          </li>
          <li class="elementor-icon-list-item">
            <span class="elementor-icon-list-icon">
              <span class="glyphicon glyphicon-time"></span>
            </span>
            <span class="elementor-icon-list-text">Monday to Saturday: 9.00am to 16.pm</span>
          </li>
      </ul>
    </div>
  </div>
  <div class="container">
      <div class="teamAddress">
        <div class="row">
          <div class="col-md-3 col-sm-3">
            <div class="addBox">
              <strong>Zaki Islam</strong>
              <p>Operations</p>
              <p>Email: zaki@hypeplug.paris</p>
            </div>
          </div>
          <div class="col-md-3 col-sm-3">
            <div class="addBox">
              <strong>Marco Tacchini</strong>
              <p>Collaborations</p>
              <p>Email: marco@hypeplug.paris</p>
            </div>
          </div>
          <div class="col-md-3 col-sm-3">
            <div class="addBox">
              <strong>Marijose Gonzalez-Masis</strong>
              <p>Content</p>
              <p>Email:marijose@hypeplug.paris</p>
            </div>
          </div>
          <div class="col-md-3 col-sm-3">
            <div class="addBox">
              <strong>Patrick Nizio</strong>
              <p>Numbers</p>
              <p>Email: patrick@hypeplug.paris</p>
            </div>
          </div>
        </div>
      </div>
      <div class="googleMap">
        <iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?q=68%20Rue%20du%20Faubourg%20Saint-Honor%C3%A9&amp;t=m&amp;z=15&amp;output=embed&amp;iwloc=near" title="68 Rue du Faubourg Saint-Honoré" aria-label="68 Rue du Faubourg Saint-Honoré"></iframe>
      </div>
      
  </div>
  <div class="maping" >
    <div class="container">
      <div class="row middle_form">
         <div class="col-md-5 col-sm-5 login_right_bg">
            <div class="details_info">
              <p>leave a message</p>
               <h3>For any queries please get in touch.</h3>
            </div>
         </div>
         <div class="col-md-7 col-sm-7 sign_up_left">
            
            <form action="" class="sign_up_form">
               <input type="text" placeholder="Your Name (required)">
               <input type="text" placeholder="Your Email (required)">
               <input type="text" placeholder="Subject">
               <textarea type="text" placeholder="Your Message" rows="5"></textarea> 
               <div class="login_form">
                  <button type="submit">SEND</button>
               </div>
            </form>
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