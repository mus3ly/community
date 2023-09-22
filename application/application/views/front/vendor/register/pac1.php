<style>
    .tab-content>.tab-pane
    {
        display:none !important;
        width:100%  !important;
    }
    .tab-content>.active
    {
        display:block !important;
    }
    .error{
        color:red;
    }
</style>

                      <div class="container ">
                          <div class="row m-2">
                              <dic class="col-md-6">
                                 <form action="<?=base_url()?>home/vendor_signup_promo" method="POST">
                                     
                                     <label for="promo_code">Add Promo Code</label>
                                     <input type="text" class="form-control" name="promo_code" />
                                     <?php
                                     if(isset($_SESSION['error']))
                                     {
                                         ?>
                                     <div class="error"><?= $_SESSION['error'] ?></div>
                                     <?php
                                         unset($_SESSION['error']);
                                     }
                                     ?>
                                     <button type="submit" name="submit" class="btn btn-warning mt-1" >Submit</button>
                                     
                                 </form>
                              </dic>
                          </div>


                          <!--start-->


                          <div class="">
              <div class="row">
                <div class="col-xs-12 ">
                  <nav>
                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                        <?php
                        foreach($cat as $k => $v){
                            $nav = str_replace(' ','', $v['name']);
                        ?>
                      <a class="nav-item nav-link <?= (!$k)?"active":"";?>" id="<?= $v['id']; ?>" data-toggle="tab" href="#tab<?= $k; ?>" role="tab" aria-controls="nav-<?php echo $nav; ?>" aria-selected="true"><?php echo $v['name']; ?></a>
                      <?php
                        }
                      ?>
                      <!--<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Platinum</a>-->
                      <!--<a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Gold</a>-->
                    </div>
                  </nav>

                  <div class="tab-content" id="nav-tabContent">
                    <?php
                        foreach($cat as $k => $v){
                            $nav = str_replace(' ','', $v['name']);
                        ?>
                    <div class=" row tab-pane fade <?= (!$k)?" active show ":"";?>" id="tab<?= $k; ?>" role="tabpanel" aria-labelledby="tab<?= $k; ?>">
                      
                          <div class="col-md-3"  style="float:left;">
                             <!-- here -->
                              <div id="pricing-table" class="clear">
                                <div class="plan">
                                    <h3><?= $v['title'] ?><span><img width="70" height="70" class="img-md img-circle"
                    src="<?php echo $this->crud_model->file_view('membership',$v['membership_id'],'100','','thumb','src','','','.png') ?>"  /></span></h3>
                                    <a class="signup" href="<?= base_url('vendor_logup/registration'); ?>?pack=<?= $v['membership_id'] ?>">Sign up</a>
                                    <ul>
                                        <li><b><?= $v['product_limit'] ?> </b>  Ads</li>
                                        <li><b><?= $v['timespan'] ?> days </b> </li>
                                        <li><b>£<?= $v['price'] ?>  </b></li>
                                    </ul>
                                </div>
                                </div>

                          </div>
                          <?php
                        }
                        ?>
                    </div>
                   <?php
                        }
                      ?>
                  </div>

                </div>
              </div>


              <div class="skip_box">
                            <a class="pkg_skip" href="<?= base_url('vendor_logup/registration'); ?>?pack=0">Skip and continue</a>
                          </div>
        </div>
      </div>
</div>




                          <!--start-->



                      </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<script>

    $(".nav .nav-link").on("click", function(){
        var hrf = $(this).attr('href');
        hrf = hrf.replaceAll("#", "");

        $(".nav").find(".active").removeClass("active");
        $(this).addClass("active");
        $('.tab-pane').each(function(i, obj) {
            if($(this).attr('id') == hrf)
            {
                $(this).addClass("active");
                $(this).addClass("show");
        console.log($(this).attr('id')+'active');
            }
            else
            {
                $(this).removeClass("active");
                $(this).removeClass("show");
                console.log($(this).attr('id')+'no-active');
            }
});
    });
</script>
