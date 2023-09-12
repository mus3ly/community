
<style>
.span_bullets {
  list-style-type: none
}

.span_bullets_arrows {
  display: grid;
  grid-template-columns: 17px auto;
  justify-content: start;
  align-items: center;
}

.span_bullets_arrows::before {
  content: ">";
  font-size: 10px;
  color: #999;
  margin-bottom: 10px;
}
.span_bullets > a {
  margin-bottom: 12px;
}

.4flex_boxes {
    display: inline-flex:
}

</style>


<footer class="footer_warp">
    <div class="footer_up">
        <!--footer logo start here-->
        <div class="footer_container">
            <div class="row">
                <div class="col-md-12 fotter_logo">
                     <a href="#"><img src="<?= base_url(); ?>//template/front/images/logo.png" alt=""></a>
                </div>
            </div>
        <!--footer logo Ends here-->
        <!--footer subscribe Starts here-->
                <form action="<?= base_url(); ?>/home/subscribe" class="mhl_subscribe_fields subscribe_form" method="post" accept-charset="utf-8">
                    <input type="hidden" name="csrf_test_name" value="e3772bad670a30e81e75db6cb2f37028">                                                                                                                          
            		<div class="form-group row">
                        <div class="col-md-12 col-sm-12 p-0 footer_search">
							<input type="text" class="form-control col-md-12" name="email" id="subscr" placeholder="Enter Your Email Address">
                            <button class="btn btn-subcribe subscriber  enterer center_btn2">Subscribe</button>
                        </div>
					</div>
				</form>
				</div>
		<!--footer subscribe Ends here-->
    <div class="footer_container">
        <div class="flex_boxes_4 col-md-12 p-0">
        <!--meddle section-->
            <div class="row">  <!--margin_in_between
            
                <div class="col-md-4 resposinve_set hide_me">   -->   
                
		  
            <div class="col-md-4 col-sm-6 p-0">
                <div class="space_footer_img">
                    <div class="col-md-12 p-0">
                    
					   <div class="col-md-12 col-sm-12 p-0  fotter_logo2 hide_me">
         
                            <div class="row">
                            <div class="col-sm-3 img_footer" align="left">
                                <img src="https://markethubland.com//template/front/images/footer_btmimg.png" alt="">
                            </div>
                            <div class="col-md-1"></div>
                            <div class=" box_shade"></div>
                            <div class="col-sm-7 pr-0" align="left">
                                <h4 class="about_title">About US</h4>
                                <p style="color:white; ">Hire our experienced team of programmers, digital designers, and marketing professionals.</p>
                            </div>
                    
                            <div class="col-sm-7 right_ftinfo"></div>
                            </div>
                            
            </div>
		  </div>
		  </div>
            </div>
            <div class="col-sm-6 col-md-3 widget_colum  ">
                <div class="sec_column"> 
                    <h4 class="add_margin_left">Community Pegs</h4>
                    <div class="align_footer" style="display:flex;gap: 7px; ">
                    
                    <ul class="span_bullets" style="margin-right: 30px;">
                                                   
                                <li class="span_bullets_arrows"><a href="<?= base_url(); ?>/home/category/78">Jobs</a></li>
                              
                                <li class="span_bullets_arrows"><a href="<?= base_url(); ?>/home/category/134"> Charities</a></li>
                              
                                <li class="span_bullets_arrows"><a href="<?= base_url(); ?>/home/category/305">Education</a></li>
                              
                                <li class="span_bullets_arrows"><a href="<?= base_url(); ?>/home/category/351">Worship</a></li>
                              
                                <li class="span_bullets_arrows"><a href="<?= base_url(); ?>/home/category/369"> Blogs</a></li>
                              
                                <li class="span_bullets_arrows"><a href="<?= base_url(); ?>/home/category/386">Markets</a></li>
                              </ul><ul>
                                <li class="span_bullets_arrows"><a href="<?= base_url(); ?>/home/category/431">Short Stays</a></li>
                              
                                <li class="span_bullets_arrows"><a href="<?= base_url(); ?>/home/category/429">Activities</a></li>
                              
                                <li class="span_bullets_arrows"><a href="<?= base_url(); ?>/home/category/1102">Other</a></li>
                              
                                <li class="span_bullets_arrows"i><a href="<?= base_url(); ?>/home/category/853">Networking</a></li>
                              
                                <li class="span_bullets_arrows"><a href="<?= base_url(); ?>/home/category/646">Stores</a></li>
                              
                                <li class="span_bullets_arrows"><a href="<?= base_url(); ?>/home/category/872">Services</a></li>
                                                              </ul>
                                </div>
                <!--<ul>-->
                                    <!--</ul>-->
            </div>
            </div>
            <div class="col-sm-6 col-md-3 widget_colum  for_mobile_left">
                
                <div class="third_column">
                <h4>Company Info</h4>
                <ul>
                    <li><a href="<?= base_url(); ?>/home/page/Disclaimer">Disclaimer</a></li>
                    <li><a href="<?= base_url(); ?>/home/page/Privacy_Notice"> Privacy Policy</a></li>
                    <li><a href="<?= base_url(); ?>/home/page/Cookie_Policy"> Cookie Policy</a></li>
                    <li><a href="<?= base_url(); ?>/home/page/Terms_Of_Use">Terms of Use</a></li>
                    <li><a href="<?= base_url(); ?>/home/page/affiliate_terms_of_use">Affiliate Terms of Use</a></li>
                    <li><a href="<?= base_url(); ?>/home/page/shop_terms_of_use">Shop Terms of Use</a></li>
                      </ul>
                     </div>
                    
            
                <!--<ul>-->
                                <!--</ul>-->
            </div>
            <div class="col-sm-6 col-md-2 widget_colum  for_mobile_right">
                
                 <div class="forth_column">
                      <h4>Discovery</h4>
                  <ul>
                    <li><a href="<?= base_url(); ?>/home/page/About_Us"> About Us</a></li>
                    <li><a href="<?= base_url(); ?>/home/page/Services">Services</a></li>
                    <li><a href="<?= base_url(); ?>/home/page/career">Career</a></li>
                    <li><a href="<?= base_url(); ?>/home/blog">Articles</a></li>

                </ul>
                </div>
                    
            
                <!--<ul>-->
                                <!--</ul>-->
            </div>
    <!--        <div class="col-sm-6 col-md-3 widget_colum">-->
    <!--            <div class="row low_footer_img">-->
    <!--            <div class="col-md-12 p-0">-->
                    
    <!--                <form action="<?= base_url(); ?>/home/subscribe" class="mhl_subscribe_fields" method="post" accept-charset="utf-8">-->
    <!--                    <input type="hidden" name="csrf_test_name" value="e3772bad670a30e81e75db6cb2f37028">                                                                                                                          -->
    <!--        							<div class="form-group row">-->
    <!--                        	<div class="col-md-12 col-sm-12 p-0 footer_search">-->
				<!--					<input type="text" class="form-control col-md-12" name="email" id="subscr" placeholder="Enter Your Email Address">-->
    <!--                            	<button class="btn btn-subcribe subscriber  enterer center_btn2">Subscribe</button>-->
    <!--                            </div>-->
				<!--			</div>-->
				<!--	   </form>-->
				<!--	   <div class="col-md-12 col-sm-12 p-0 footer_image fotter_logo2 hide_me">-->
         
    <!--            <div class="row">-->
    <!--                <div class="col-sm-3 img_footer " align="left">-->
    <!--                    <img src="https://markethubland.com//template/front/images/footer_btmimg.png" alt="">-->
    <!--                </div>-->
    <!--                <div class="col-sm-9 " align="left">-->
    <!--                    <h4 class="about_title">About US</h4>-->
    <!--                    <p style="color:white; ">Hire our experienced team of programmers, digital designers, and marketing professionals, who know how to deliver results.</p>-->
    <!--                </div>-->
                    
    <!--                <div class="col-sm-7 right_ftinfo">-->

    <!--                </div>-->
    <!--            </div>-->
                            
    <!--        </div>-->
		  <!--</div>-->
		  <!--</div>-->
                <!--<ul>-->
                                    <!--</ul>-->
    <!--        </div>-->
            
         
                <div class="row hide_it">
                    <div class="col-sm-3  about_img_responsive " align="left">
                        <img src="https://markethubland.com//template/front/images/footer_btmimg.png" alt="">
                    </div>
                   
                            <div class=" box_shade"></div>
                    <div class="col-sm-9 about_text_responsive " align="left">
                        <h4 class="about_title">About US</h4>
                        <p style="color:white; ">Hire our experienced team of programmers, digital designers, and marketing professionals, who know how to deliver results.</p>
                    </div>
                    
                </div>
            </div>                
        </div>
        
    </div>
    </div>
    <div class="footer_container">
    <div class="footerbtn">
             <a href="<?= base_url(); ?>/vendor_logup/registration"><button class="btn_anim from-top">SIGN-UP to Add a Listing</button></a>
             <a href="<?= base_url(); ?>/directory"><button class="btn_anim from-top">Visit Directory</button></a>
             <a href="<?= base_url(); ?>/home/login_set/registration"><button class="btn_anim from-top">Join Our Affiliate Marketing</button></a>
            </div> 
    </div>  
    </div>  
    <!--meddle section-->
   
    <div class="mhl_copyright_footer">
        <div class="copyright_container">
        <div class="left_copyright">
        <span>Copyright @ 2023 </span>
        </div>
        <div class="right_copyright">
            <span>Community HubLand Ltd</span>
        </div>
    </div>
    </div>
</footer>
<script>
    <?php
    if(isset($directory) && $directory)
    {
        ?>
        var directory = 1;
        <?php
    }
    ?>
</script>
<?php
include 'script_texts.php';
?>