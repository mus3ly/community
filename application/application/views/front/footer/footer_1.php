<?php 

	$contact_address =  $this->db->get_where('general_settings',array('type' => 'contact_address'))->row()->value;

	$contact_phone =  $this->db->get_where('general_settings',array('type' => 'contact_phone'))->row()->value;

	$contact_email =  $this->db->get_where('general_settings',array('type' => 'contact_email'))->row()->value;

	$contact_website =  $this->db->get_where('general_settings',array('type' => 'contact_website'))->row()->value;

	$contact_about =  $this->db->get_where('general_settings',array('type' => 'contact_about'))->row()->value;

	

	$facebook =  $this->db->get_where('social_links',array('type' => 'facebook'))->row()->value;

	$googleplus =  $this->db->get_where('social_links',array('type' => 'google-plus'))->row()->value;

	$twitter =  $this->db->get_where('social_links',array('type' => 'twitter'))->row()->value;

	$skype =  $this->db->get_where('social_links',array('type' => 'skype'))->row()->value;

	$youtube =  $this->db->get_where('social_links',array('type' => 'youtube'))->row()->value;

	$pinterest =  $this->db->get_where('social_links',array('type' => 'pinterest'))->row()->value;

	

	$footer_text =  $this->db->get_where('general_settings',array('type' => 'footer_text'))->row()->value;

	$footer_category =  json_decode($this->db->get_where('general_settings',array('type' => 'footer_category'))->row()->value);

?>
<!-- footer -->
<footer class="footer_wrap" id="footer_wrapper">

   <div class="container">

      <div class="footer_colums">

      <ul>

         <li>

            <div class="footer_listing">

              

               <div class="elementor-image">

				<img width="275" height="67" src="<?php echo base_url(); ?>uploads/logo_image/logo_<?php echo $home_top_logo; ?>.png" class="attachment-full size-full" alt="" >											

				</div>

               <div>

					<b></b></br>

					<p>68 Rue du Faubourg Saint-Honoré</br>

					75008 Paris</br>

					France</p>
					
			   </div>

               

            </div>

         </li>
         <li> 

            <div class="footer_listing">

				<div class="elementor-widget-container">

					<h2 class="elementor-heading-title elementor-size-default">HyperPlug  Marketplace</h2>

				</div>

					<a href="https://marketplace.hypeplug.paris/home/about">About us </a>
					
                    <a href="https://marketplace.hypeplug.paris/home/about">About</a>
                    <a href="#">Help</a>
                    <a href="https://marketplace.hypeplug.paris/home/vendor_logup/registration">Become A Vendor</a>
					<a href="#">Selling</a>
		            <a href="#">Consignment</a>
		            <a href="#">HypePlug Paris</a>
		            <a href="#">Collaborations & PR</a>

            </div>

         </li>
         <li>

            <div class="footer_listing">
              <div class="elementor-widget-container">

                <h2 class="elementor-heading-title elementor-size-default">Account</h2>

              </div>
					<a href="https://marketplace.hypeplug.paris/home/profile">FOR BUYERS</a>
					<a href="https://marketplace.hypeplug.paris/home/profile">Order History</a><a href="https://marketplace.hypeplug.paris/home/profile">Profile Preferences</a>
					<a href="#">FOR SELLERS</a>
					<a href="https://marketplace.hypeplug.paris/vendor/product">Products</a><a href="#">Seller Preferences</a>
					<a href="#">FOR EVERYONE </a>
					<a href="https://marketplace.hypeplug.paris/home/profile">Track My Order</a>
            </div>

         </li>

         

		 <li> 

            <div class="footer_listing">

				<div class="elementor-widget-container">

					<h2 class="elementor-heading-title elementor-size-default">Support</h2>

				</div>
		            <a href="#">Contact Support</a>
		            <a href="#">FAQ</a>
		            <a href="https://marketplace.hypeplug.paris/home/page/RETURN_POLICY">Shipping & Returns</a>
		            <a href="https://marketplace.hypeplug.paris/home/page/TERMS_OF_USE">Terms of Use</a>
		            <a href="https://marketplace.hypeplug.paris/home/page/PRIVACY_NOTICE">Privacy Policy</a>
		            <a href="https://marketplace.hypeplug.paris/home/page/COOKIE_POLICY">Cookie Settings</a>

            </div>

         </li>

		 <!--<li> 

            <div class="footer_listing">

				<div class="elementor-widget-container">

					<h2 class="elementor-heading-title elementor-size-default">Info</h2>

				</div>

					<a href="https://marketplace.hypeplug.paris/home/about">About us </a>

					<a href="#">FAQ</a>

					<a href="#">Our Blog</a>

					<a href="https://marketplace.hypeplug.paris/home/contact">Contact us</a>

            </div>

         </li>-->



      </ul>

   </div>

   <div class="need_help">

      <div class="row">

         <div class="col-sm-4 need_helping">

            <b>NEED HELP?</b>

            <p>SUPPORT TEAM available Mon - Fri 9am to 5pm support@communityhubland.com</p>

         </div>

         <div class="col-sm-8 subscribe_box">

            <input type="text" placeholder="Enter your email">

            <img src="https://adeeloffical.com/hype-plug/uploads/logo_image/envelope.png" alt="">

            <button type="button">Subscribe</button>

         </div>

      </div>

   </div>

   <div class="row download_info">

      <div class=" download_app">
<!--
         <b>Download Our App On</b>

         <img src="https://adeeloffical.com/hype-plug/uploads/logo_image/app1.png" alt="">

         <img src="https://adeeloffical.com/hype-plug/uploads/logo_image/app2.png" alt="">
-->
      </div>

      <div class="row footer_links">
      	<div class="col-sm-6 leftbox">
      		<p>Copyright © 2021  CommunityHubLand. All Rights Reserved.</p>
      	</div>
      	<div class="col-sm-6 rightbox">
      		<ul>

            <li><a href="https://adeeloffical.com/hype-plug">Home</a></li>

            <li><a href="#">CommunityHubLand Shop</a></li>

            <!--<li><a href="https://marketplace.hypeplug.paris/home/contact">Contact Us</a></li>-->

            <li><a href="https://marketplace.hypeplug.paris/home/about">About Us</a></li>

         </ul>
      	</div>
         

         

      </div>

   </div>

   </div>
</footer>
<!-- footer -->
<!--<footer class="footer1">

	<div class="footer1-widgets">

		<div class="container">

			<div class="row">

				<div class="col-lg-3 col-md-3 col-sm-sm col-xs-12">

					<div class="widget">

						<a href="<?php echo base_url(); ?>">

                          	<img class="img-responsive" src="<?php echo $this->crud_model->logo('home_bottom_logo'); ?>" alt="">

						</a>

						<p><?php echo $footer_text ;?></p>

						<?php

							echo form_open(base_url() . 'home/subscribe', array(

								'class' => '',

								'method' => 'post'

							));

						?>    

							<div class="form-group row">

                            	<div class="col-md-12">

									<input type="text" class="form-control col-md-8" name="email" id="subscr" placeholder="<?php echo translate('email_address'); ?>">

                                	<span class="btn btn-subcribe subscriber enterer"><?php echo translate('subscribe'); ?></span>

                                </div>

							</div>                

					   </form> 

					</div>

				</div>

				<div class="col-md-3 hidden-xs hidden-sm">

					<div class="widget widget-categories">

						<h4 class="widget-title"><?php echo translate('categories');?></h4>

						<ul>

							<?php

								foreach($footer_category as $row){

									if($this->crud_model->if_publishable_category($row)){

							?>

								<li>

									<a href="<?php echo base_url(); ?>home/category/<?php echo $row; ?>">

										<?php

											echo $this->crud_model->get_type_name_by_id('category',$row,'category_name');

										?>

									</a>

								</li>

							<?php

									}

								}

							?>

						</ul>

					</div>

				</div>

				<div class="col-md-3  col-sm-12 hidden-xs">

					<div class="widget widget-categories">

						<h4 class="widget-title"><?php echo translate('useful_links');?></h4>

						<ul>

							<li>

								<a href="<?php echo base_url(); ?>home/"><?php echo translate('home');?>

								</a>

							</li>

							<li>

								<a href="<?php echo base_url(); ?>home/category/0/0-0"><?php echo translate('all_products');?>

								</a>

							</li>

							<li>

								<a href="<?php echo base_url(); ?>home/others_product/featured"><?php echo translate('featured_products');?>

								</a>

							</li>

							<li>

								<a href="<?php echo base_url(); ?>home/contact/"><?php echo translate('contact');?>

								</a>

							</li>

                            <?php

							$this->db->where('status','ok');

                            $all_page = $this->db->get('page')->result_array();

							foreach($all_page as $row){

							?>

                            <li>

                                <a href="<?php echo base_url(); ?>home/page/<?php echo $row['parmalink']; ?>">

                                    <?php echo $row['page_name']; ?>

                                </a>

                            </li>

                            <?php

							}

							?>

						</ul>

					</div>

				</div>

				<div class="col-md-3 hidden-xs hidden-sm">

					<div class="widget contact">

						<h4 class="widget-title"><?php echo translate('contact_us');?></h4>

						<div class="media-list">

							<div class="media">

								<i class="pull-left fa fa-home"></i>

								<div class="media-body">

									<strong><?php echo translate('address');?>:</strong>

                                    <br>

									<?php echo $contact_address;?>

								</div>

							</div>

							<div class="media">

								<i class="pull-left fa fa-phone"></i>

								<div class="media-body">

									<strong><?php echo translate('phone');?>:</strong>

                                    <br>

									<?php echo $contact_phone;?>

								</div>

							</div>

							<div class="media">

								<i class="pull-left fa fa-globe"></i>

								<div class="media-body">

									<strong><?php echo translate('website');?>:</strong>

                                    <br>

									<a href="https://<?php echo $contact_website;?>"><?php echo $contact_website;?></a>

								</div>

							</div>

							<div class="media">

								<i class="pull-left fa fa-envelope-o"></i>

								<div class="media-body">

									<strong><?php echo translate('email');?>:</strong>

                                    <br>

									<a href="mailto:<?php echo $contact_email;?>">

										<?php echo $contact_email;?>

									</a>

								</div>

							</div>

							<ul class="social-nav model-2" style="float: left;margin-top: 10px">

								<?php

								if ($facebook != '') {

								?>

								<li style="border-top: none;"><a href="<?php echo $facebook;?>" class="facebook social_a"><i class="fa fa-facebook"></i></a></li>

								<?php

								} if ($twitter != '') {

								?>

								<li style="border-top: none;"><a href="<?php echo $twitter;?>" class="twitter social_a"><i class="fa fa-twitter"></i></a></li>

								<?php

								} if ($googleplus != '') {

								?>

								<li style="border-top: none;"><a href="<?php echo $googleplus;?>" class="google-plus social_a"><i class="fa fa-google-plus"></i></a></li>

								<?php

								} if ($pinterest != '') {

								?>

								<li style="border-top: none;"><a href="<?php echo $pinterest;?>" class="pinterest social_a"><i class="fa fa-pinterest"></i></a></li>

								<?php

								} if ($youtube != '') {

								?>

								<li style="border-top: none;"><a href="<?php echo $youtube;?>" class="youtube social_a"><i class="fa fa-youtube"></i></a></li>

								<?php

								} if ($skype != '') {

								?>

								<li style="border-top: none;"><a href="<?php echo $skype;?>" class="skype social_a"><i class="fa fa-skype"></i></a></li>

								<?php

								}

								?>

							</ul>

						</div>

					</div>

				</div>



			</div>

		</div>

	</div>

	<div class="footer1-meta">

		<div class="container">

			<div class="row">

				<div class="col-md-8 col-xs-12">

					<div class="copyright" version="Currently <?= demo()?'demo':''?> v<?php echo $this->db->get_where('general_settings',array('type'=>'version'))->row()->value; ?>">

						<?php echo date('Y'); ?> &copy; 

						<?php echo translate('all_rights_reserved'); ?> @ 

						<a href="<?php echo base_url(); ?>">

							<?php echo $system_title; ?>

						</a> 

							| 

						<a href="<?php echo base_url(); ?>home/legal/terms_conditions" class="link">

							<?php echo translate('terms_&_condition'); ?>

						</a> 

							| 

						<a href="<?php echo base_url(); ?>home/legal/privacy_policy" class="link">

							<?php echo translate('privacy_policy'); ?>

						</a>

					</div>

				</div>

				<div class="col-md-4 hidden-xs hidden-sm">

					<div class="payments" style="font-size: 30px;">

						<ul>

							<li><img src="<?php echo base_url(); ?>uploads/others/payment.png"></li>

						</ul>

					</div>

				</div>

			</div>

		</div>

	</div>

</footer>-->

<style>

.link:hover{

	text-decoration:underline;

}

.model-2 a {

	margin: 0px 1px;

	height: 32px;

	width: 32px;

	line-height: 32px;



}

</style>

<script>
$('#latest_load').submit(function(e)
{
    
    e.preventDefault();

});
var load = 0;
    function latest_load()
    {
        if(!load)
        {
            load = 1;
            $('.goat-button span').text('Loading...');
            $(this).prop('disabled', true);
            
                    // alert($('#latest_load').attr('action'));
                    var datastring = $('#latest_load').serialize();
            $.ajax({
                type: $('#latest_load').attr('method'),
                url: $('#latest_load').attr('action'),
                data: datastring,
                success: function(data) {
                    $('.goat-button span').text('See More');
                    load = 0;
                    var obj = jQuery.parseJSON(data);
                    if(obj['next'])
                    $('#cpage').val(obj['next']);
                    if(obj['html'])
                    $('#latest_products').append(obj['html']);
                },
                error: function() {
                    alert('error handling here');
                }
            });
        }
    }
</script>
<script>
var x, i, j, l, ll, selElmnt, a, b, c;
/*look for any elements with the class "custom-select":*/
x = document.getElementsByClassName("custom-select");
l = x.length;
for (i = 0; i < l; i++) {
  selElmnt = x[i].getElementsByTagName("select")[0];
  ll = selElmnt.length;
  /*for each element, create a new DIV that will act as the selected item:*/
  a = document.createElement("DIV");
  a.setAttribute("class", "select-selected");
  a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
  x[i].appendChild(a);
  /*for each element, create a new DIV that will contain the option list:*/
  b = document.createElement("DIV");
  b.setAttribute("class", "select-items select-hide");
  for (j = 1; j < ll; j++) {
    /*for each option in the original select element,
    create a new DIV that will act as an option item:*/
    c = document.createElement("DIV");
    c.innerHTML = selElmnt.options[j].innerHTML;
    c.addEventListener("click", function(e) {
        /*when an item is clicked, update the original select box,
        and the selected item:*/
        var y, i, k, s, h, sl, yl;
        s = this.parentNode.parentNode.getElementsByTagName("select")[0];
        sl = s.length;
        h = this.parentNode.previousSibling;
        for (i = 0; i < sl; i++) {
          if (s.options[i].innerHTML == this.innerHTML) {
            s.selectedIndex = i;
            h.innerHTML = this.innerHTML;
            y = this.parentNode.getElementsByClassName("same-as-selected");
            yl = y.length;
            for (k = 0; k < yl; k++) {
              y[k].removeAttribute("class");
            }
            this.setAttribute("class", "same-as-selected");
            break;
          }
        }
        h.click();
    });
    b.appendChild(c);
  }
  x[i].appendChild(b);
  a.addEventListener("click", function(e) {
      /*when the select box is clicked, close any other select boxes,
      and open/close the current select box:*/
      e.stopPropagation();
      closeAllSelect(this);
      this.nextSibling.classList.toggle("select-hide");
      this.classList.toggle("select-arrow-active");
    });
}
function closeAllSelect(elmnt) {
  /*a function that will close all select boxes in the document,
  except the current select box:*/
  var x, y, i, xl, yl, arrNo = [];
  x = document.getElementsByClassName("select-items");
  y = document.getElementsByClassName("select-selected");
  xl = x.length;
  yl = y.length;
  for (i = 0; i < yl; i++) {
    if (elmnt == y[i]) {
      arrNo.push(i)
    } else {
      y[i].classList.remove("select-arrow-active");
    }
  }
  for (i = 0; i < xl; i++) {
    if (arrNo.indexOf(i)) {
      x[i].classList.add("select-hide");
    }
  }
}
/*if the user clicks anywhere outside the select box,
then close all select boxes:*/
document.addEventListener("click", closeAllSelect);
    jQuery('<div class="quantity-nav"><div class="quantity-button quantity-up">+</div><div class="quantity-button quantity-down">-</div></div>').insertAfter('.quantity input');
    jQuery('.quantity').each(function() {
      var spinner = jQuery(this),
        input = spinner.find('input[type="number"]'),
        btnUp = spinner.find('.quantity-up'),
        btnDown = spinner.find('.quantity-down'),
        min = input.attr('min'),
        max = input.attr('max');

      btnUp.click(function() {
        var oldValue = parseFloat(input.val());
        if (oldValue >= max) {
          var newVal = oldValue;
        } else {
          var newVal = oldValue + 1;
        }
        spinner.find("input").val(newVal);
        spinner.find("input").trigger("change");
      });

      btnDown.click(function() {
        var oldValue = parseFloat(input.val());
        if (oldValue <= min) {
          var newVal = oldValue;
        } else {
          var newVal = oldValue - 1;
        }
        spinner.find("input").val(newVal);
        spinner.find("input").trigger("change");
      });

    });
    $(document).ready(function(){
	 
		//carousel-control
		
		$("#myCarousel").mouseover(function(){
			$("#myCarousel .carousel-control").show();
		});

		$("#myCarousel").mouseleave(function(){
			$("#myCarousel .carousel-control").hide();
		});
		
		//active thumbnail
		
		$("#thumbCarousel .thumb").on("click", function(){
			$(this).addClass("active");
			$(this).siblings().removeClass("active");
		
		});
		
		//carousel slides
		
		$('#myCarousel').on('slid.bs.carousel', function(){
		   var index = $('.carousel-inner .item.active').index();
		   //console.log(index);
		   var thumbnailActive = $('#thumbCarousel .thumb[data-slide-to="'+index+'"]');
		   thumbnailActive.addClass('active');
		   $(thumbnailActive).siblings().removeClass("active");
		   //console.log($(thumbnailActive).siblings()); 
		});
	 });
    
$(window).scroll(function() {    
    var scroll = $(window).scrollTop();

     //>=, not <=
    if (scroll >= 20) {
        //clearHeader, not clearheader - caps H
        $(".header").addClass("stickyheader");
    }
    else {
        //clearHeader, not clearheader - caps H
        $(".header").removeClass("stickyheader");
    }
}); //missing );


</script>
