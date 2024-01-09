<style>
    .add_text_in h2{
            font-size: 25px;
    margin-bottom: 10px;
    }
    .page-links{
            display: flex;
    align-items: center;
    gap: 20px;
    justify-content: center;
    padding: 30px;
    background: #F26122;
    border-radius: 10px;
    
    }
    .forms{
            max-width: 80%;
    margin: 40px auto;
    padding: 50px;
    box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
    border-radius: 5px;
    }
    .nav_Bar ul{
            display: flex;
    align-items: center;
    gap: 20px;
    justify-content: center;
    border-radius: 10px;
    }
    .nav_Bar ul a{
        color:white !important;
    }
    .text-divider::before{
            content: "~";
    margin: 0px 5px;
    font-size: 30px;
    position: absolute;
    top: -8px;
    left: 5px;
    transform: translateX(-50%);
    }
    .text-divider{
            position: relative;
    width: 20px;
        line-height: 25px;
    color: white;
    height: 10px;
    text-align: center;
    }
    
</style>
 <div class="navbar_wrapper">
 <div class="container">
 <div class="row">
  <div class="col-md-12 p-0 top_nav_bar">
      <div class="page-links">
   <div class="nav_Bar">
       <ul>
           <a href="https://markethubland.com/login_set/login"><li>Customer Login</li></a> 
           <div class="text-divider"></div>
           <a href="https://markethubland.com/home/login_set/registration"><li>Customer Sign-up</li></a>   
           <div class="text-divider"></div>
           <a href="https://markethubland.com/vendor"><li>Vendor Login</li></a>    
           <div class="text-divider"></div>
           <a href="https://markethubland.com/vendor_logup/registration"><li>Vender Sign-up</li></a>    
       </ul>  
   </div>  
   </div>
</div>
</div>
</div>
</div>
<div class="container">
<div class="row">
    
<div class="forms vendor-form">
    <div class="col-md-10 mx-auto">
        <div class="form_wrapeer_contacts">
            <div class="add_text_in">
                <div class="alert alert-success d-none" id="success" role="alert">
                  Email Send Successfully!
                </div>
                <div class="alert alert-danger d-none" id="danger" role="alert">
                  Please Try Again!
                </div>
                <h2>Get in tocuh</h2>
                <p class="mb-2">Feel free to reach out to us by filling out the form below. We value your input and look forward to connecting with you. Your inquiries and feedback are important to us!</p>
<!--                <p class="text_color_contact">Business!-->
<!--Please include the texts also to help user understand how to navigate this section: Join Community HubLand or Login to your account as a Business or as a Customer. With a Business Account… more ( when more is clicked, it should show the rest of the texts which are: you can access all tools to list your ads,read more</p>-->
                </div>
            <form>
                <div class="row">
                <div class="col-md-4 mb-3 padder form-group">
                    <input type="text" class="form-control" id="fname__" placeholder="First name" >
                </div>
                <div class="col-md-4 mb-3 form-group">
                    <input type="text" class="form-control" id="lname" placeholder="Last name"  >
                </div>
                <div class="col-md-4 form-group mb-3">
                    <input type="text" class="form-control" id="bname" placeholder="Business name">
                </div>
                <div class="col-md-6 form-group mb-3">
                    <input type="Email" class="form-control" id="email__" placeholder="Email">
                </div>
                <div class="col-md-6 form-group mb-3">
                    <input type="number" class="form-control" id="phone" placeholder="Phone number">
                </div>
                <div class="col-md-6 form-group mb-3">
                   <select class="form-select sect_form_box" id="submail">
                       <?php 
                       $pro = $this->db->get('subject')->result_array();
                       foreach($pro as $v){
                       ?>
                      <option value="<?=$v['email'];?>"><?=$v['subject']; ?></option>
                      <?php }?>
                      <!--<option>2</option>-->
                      <!--<option>3</option>-->
                      <!--<option>4</option>-->
                    </select>
                </div>
                <div class="col-md-6 form-group mb-3">
                    <input type="text" class="form-control" id="sub" placeholder="Subject">
                </div>
                <div class="form-group mb-3">
                   <textarea class="form-control" id="message__" rows="3"></textarea>
                </div>
                 </div>
            </form>
            <div class="buttoN_wraper" >
                <button class="btn w-100 mt-2" style="background: #f26122;
    color: #fff;
    border: 1px solid #f26122;
    display: inline-block;
    font-size: 14px;
    border-radius: 5px;
    padding: 9px 16px;" id="send">Submit <i id="spin"  ></i></button>
        </div>   
        </div>   
        
    </div>
    </div>
    
</div>
</div>
<script>
        $('#send').on('click' , function(e){
            e.preventDefault();
            $('#spin').attr('class', 'fa fa-spinner fa-spin');
            var url = '<?php echo base_url('home/contact_us')?>';
            var fname = $('#fname__').val();
            var lname = $('#lname').val();
            var email = $('#email__').val();
            var msg = $('#message__').val();
            var phone = $('#phone').val();
            var bname = $('#bname').val();
            var submail = $('#submail').val();
            var sub = $('#sub').val();
               $.ajax({
                url: url,
                type: "get",
                async: true,
                
                data: {  fname:fname, email:email, message:msg,phone:phone,lname:lname,bname:bname,submail:submail,sub:sub },
                success: function (data) {
                    // const myArr = JSON.parse(JSON.stringify(data));
              if(data == 1){
                        $("#success").attr("class", "alert alert-success d-block");
                        $('#spin').attr('class', ' d-none');
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


        });
    </script>