<?php
$url = base_url('updated/');
 include "header_new.php";
?>
<div class="wrapper_thanks">
    <div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="thanks_img">
                <img src="<?=$url.'/assets/images/thanks_img.png'?>">
            </div>
          <div class="thanks_wrapper">
              <div class="check_icon"><i class="fa-solid fa-circle-check"></i></div>
              <h1>Thank's For your Purchase!</h1> 
              <p>You should recieve an order conformation email shortly.</p>
              <div class="go_home">
                  <span><h2>What you have purchased!</h2></span>
                  
</div>
                <div class="sub_total_wrapper">
                    
                    <div class="sub_total">
                          <span><h3>Subtotal:</h3></span>
                  <span><h3>$<?= $amount ?></h3></span>
                    </div>
                    <div class="sub_total">
                          <span><h3>Total:</h3></span>
                  <span><h3>$<?= $amount ?></h3></span>
                    </div>
</div>
</div>
</div>
</div>
</div>
</div>
<?php
 include "footer_new.php";
?>
