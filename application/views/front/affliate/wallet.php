<style>
    #form-withdraw{
        display:none;
    }
</style>

<div class="row profile">
    <div class="col-lg-3 col-md-3 col-sm-4">
        <div class="col-md-12">
            <div class="row">
                <div class="thumbnail no-border no-padding thumbnail-banner size-1x3" style="height:auto;">
                    <div class="media">
                        <div class="media-link">
                            <div class="caption">
                                <div class="caption-wrapper div-table">
                                    <div class="caption-inner div-cell">
                                        <h1 style="text-align: center; color: white;">
                                            <?php echo currency($blc); ?>
                                        </h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" >
            <?php
            if($blc > 5)
            {
            ?>
            <div class="col-md-12" style="margin-top:2px;" >
                <div class="btn btn-theme btn-theme-sm btn-block" id="withdraw" onclick="wallet('<?php echo base_url(); ?>home/affliate/wallet/add_view')">
                    <?php echo translate('withdarw'); ?>
                </div>
            </div>
            <?php
            }else{
              ?>
               <div class="col-md-12" style="margin-top:2px;" >
                <div type="button" disabled class="btn btn-theme btn-theme-sm btn-block" style="cursor:not-allowed;">
                    <?php echo translate('withdarw'); ?>
                </div>
            </div>
              <?php
              
            }
            ?>
        </div>
        <input type="hidden" id="state" value="normal" />
    </div>
    
    <div class="col-lg-9 col-md-9 col-sm-8">
      
        <div class="information-title">
            <?php echo translate('your_withdraw_requests');?></div>
              <form id="form-withdraw">
            <div class="form-group btm_border">
                <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('Enter Amount');?></label>
                <div class="col-sm-6">
                    <input type="number" name="amount" id="amount" value="" min="5" max="100" class="form-control required">
                </div>
            </div>
            <div class="form-group btm_border">
                <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('Enter_Paypal_Email_:');?></label>
                <div class="col-sm-6">
                    <input type="email" name="email" id="email" value="" class="form-control required">
                </div>
            </div>
            <div class="form-group btm_border">
              <div class="btn btn-primary col-sm-3" id="withdraw" onclick="withdraw_request('<?php echo base_url(); ?>home/affliate/wallet/withdraw_request')" style="background-color:#f26122; border:none;">
                    <?php echo translate('Submit'); ?>
                </div>
            </div> <br><br><br><br><br><br>
        </form>
       
        <div class="wallet">
            <table class="table" style="background: #fff;">
                <thead>
                    <tr>
                        <th>#</th>
                        <th><?php echo translate('amount');?></th>
                        <th><?php echo translate('time');?></th>
                        <th><?php echo translate('Paypal id');?></th>
                    </tr>
                </thead>
                <tbody id="result6">
                  
                </tbody>
            </table>
        </div>

        <input type="hidden" id="page_num6" value="0" />

        <div class="pagination_box">
        </div>

        <script>                                                                    
            function wallet_listed(page){
                
                if(page == 'no'){
                    page = $('#page_num6').val();  
                    
                } else {
                 $('#page_num6').val(page);
                    // alert( $('#page_num6').val(page));
                }
                var alerta = $('#result6');
                alert('ok');
                alerta.html('<td><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></td>');
                alerta.load('<?php echo base_url();?>home/wallet_listed/'+page,
                    function(){
                        //set_switchery();
                    }
                );   
            }
            $(document).ready(function() {
                wallet_listed('0');
            });

        </script>
        <script>
            $( "#withdraw" ).click(function() {
              $( "#form-withdraw" ).show();
            });
        </script>
        <script>
            function withdraw_request(page){
               var str = $( "#form-withdraw" ).serialize(); 
            //   alert(str);
                $.ajax({
                    url: page,
                    type: "GET",
                    data:  str,
                    
                    success: function (data) {
                        
                        alert('Request Submitted');
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
    </div>
</div>