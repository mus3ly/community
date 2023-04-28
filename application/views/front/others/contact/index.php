
 <div class="navbar_wrapper">
 <div class="container">
 <div class="row">
  <div class="col-md-12 p-0 top_nav_bar">
   <div class="nav_Bar">
       <ul>
           <a href="https://markethubland.com/login_set/login"><li>Customer Login</li></a>    
           <a href="https://markethubland.com/home/login_set/registration"><li>Customer Sign-up</li></a>    
           <a href="https://markethubland.com/vendor"><li>Vendor Login</li></a>    
           <a href="https://markethubland.com/vendor_logup/registration"><li>Vender Sign-up</li></a>    
       </ul>  
   </div>  
</div>
</div>
</div>
</div>
<div class="container">
<div class="row">
    <div class="col-md-2 hide_on_mobile">
</div>
    <div class="col-md-8">
        <div class="form_wrapeer_contacts">
            <div class="add_text_in">
                <div class="alert alert-success d-none" id="success" role="alert">
                  Email Send Successfully!
                </div>
                <div class="alert alert-danger d-none" id="danger" role="alert">
                  Please Try Again!
                </div>
                <h2>Get in tocuh</h2>
<!--                <p class="text_color_contact">Business!-->
<!--Please include the texts also to help user understand how to navigate this section: Join Community HubLand or Login to your account as a Business or as a Customer. With a Business Account… more ( when more is clicked, it should show the rest of the texts which are: you can access all tools to list your ads,read more</p>-->
                </div>
            <form>
                <div class="col-md-6 padder form-group">
                    <input type="text" class="form-control" id="fname__" placeholder="First name">
                </div>
                <div class="col-md-6 p-0 form-group">
                    <input type="text" class="form-control" id="lname" placeholder="last name">
                </div>
                <div class=" form-group">
                    <input type="text" class="form-control" id="bname" placeholder="Business name">
                </div>
                <div class="form-group">
                    <input type="Email" class="form-control" id="email__" placeholder="Email">
                </div>
                <div class="form-group">
                    <input type="number" class="form-control" id="phone" placeholder="Phone number">
                </div>
                <div class="form-group">
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
                <div class="form-group">
                    <input type="text" class="form-control" id="sub" placeholder="Subject">
                </div>
                <div class="form-group">
                   <textarea class="form-control" id="message__" rows="3"></textarea>
                </div>
            </form>
            <div class="buttoN_wraper">
                <button class="btn " id="send">Submit <i id="spin"  ></i></button>
        </div>   
        </div>   
        
    </div>
    <div class="col-md-2 hide_on_mobile">
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