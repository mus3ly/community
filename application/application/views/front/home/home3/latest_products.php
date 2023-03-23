<!-- PAGE -->

<!-- /PAGE -->
<link rel="stylesheet" type="text/css" href="https://owlcarousel2.github.io/OwlCarousel2/assets/owlcarousel/assets/owl.carousel.min.css">
<link rel="stylesheet" type="text/css" href="https://owlcarousel2.github.io/OwlCarousel2/assets/owlcarousel/assets/owl.theme.default.min.css">
<div class="container ">
<section id="">
  <h2 style="margin-left: -14px !important; margin-bottom: 20px !important;">Latest Release Products</h2>
  
</section> 
</div>
<div class="container ">
  
	<div class="products" id="latest_products">

	    <?php

					$box_style =  5;//$this->db->get_where('ui_settings',array('ui_settings_id' => 29))->row()->value;

					$limit =  8;
                               $this->db->limit($limit, 0);

                    $featured=$this->db->order_by("product_id", "desc")->where('parent_id',0)->get('product')->result();


                    foreach($featured as $row){

                		echo $this->html_model->product_box($row, 'grid', $box_style);

					}

                ?>

	</div>
	<form id="latest_load" action="https://marketplace.hypeplug.paris/home/sneaker/" method="GET">
	    <input id="cpage" name="cpage" value="2" type="hidden"  />
	    <a href="https://marketplace.hypeplug.paris/home/sneaker/"class="goat-button" type="button"  value="Shop New Release"> <span>Shop New Release</span></a>
	</form>
	
</div>
<div class="container ">
    <?php
    include 'featured_products.php';
    ?>
    </div>
<div class="container ">
  <section id="latestRelease" class="topbrands">
    <h2  style="margin-bottom: 20px !important;">Top Products From Brands </h2>
    
    <?php
    //get brands
    $brands =$this->db->get('brand')->result();
    ?>
    <div class="owl-carousel owl-carousel1 owl-theme owl-loaded owl-drag products topProductsBAnner">
        <div class="owl-stage-outer">
          <div class="owl-stage " >
              <?php
              foreach($brands as $bk=> $bv)
              {
                  $pro = $this->db->where('brand',$bv->brand_id)->get('product')->result();
                  $i = 0;
                  foreach($pro as $row){
                      $i++;
                      if($i <= 4)
                      {
                        ?>
                        <div class="owl-item active" >
                  <div class="item">
                    <?php
                    echo $this->html_model->product_box($row, 'home_brand', 1);
                    ?>
                  </div>
              </div>
                        <?php
                      }
              }
              }//brands
              ?>
          </div>
        </div>
    </div>
  </section> 
</div>
<div id="servicecmsblock">

<!--<div id="servicecmsinfo_block1" class="container">

  <div class="box-content-cms">

    <div class="inner-cms">

      <div class="box-cms-content">

        <div class="first-content-one">

          <div class="inner-content">

            <div class="service-content">

              <div class="icon-left1"><i class="fa fa-truck hvr-wobble-vertical" aria-hidden="true"></i></div>

              <div class="service-right">

                <div class="title">Free Delivery</div>

                <div class="desc">Orders Over Rs.1000</div>

              </div>

            </div>

          </div>

        </div>

        <div class="second-content-two">

          <div class="inner-content">

            <div class="service-content">

              <div class="icon-left2"><i class="fa fa-money hvr-wobble-vertical" aria-hidden="true"></i></div>

              <div class="service-right">

                <div class="title">Money Back Guarantee</div>

                <div class="desc">with a 30 day</div>

              </div>

            </div>

          </div>

        </div>

        <div class="third-content-three">

          <div class="inner-content">

            <div class="service-content">

              <div class="icon-left3"><i class="fa fa-headphones hvr-wobble-vertical" aria-hidden="true"></i></div>

              <div class="service-right">

                <div class="title">Best Online support</div>

                <div class="desc">Hours: 8AM -11PM</div>

              </div>

            </div>

          </div>

        </div>

        <div class="Fourth-content-four">

          <div class="inner-content">

            <div class="service-content">

              <div class="icon-left4"><i class="fa fa-university hvr-wobble-vertical" aria-hidden="true"></i></div>

              <div class="service-right">

                <div class="title">Win Rs.1000 To Shop</div>

                <div class="desc">Enter Now</div>

              </div>

            </div>

          </div>

        </div>

      </div>

    </div>

  </div>

</div>-->

</div>
</div>
<script type="text/javascript" src="https://owlcarousel2.github.io/OwlCarousel2/assets/owlcarousel/owl.carousel.js"></script>
<script type="text/javascript">
  $('.owl-carousel1').owlCarousel({
    loop:true,
    margin:30,
    responsiveClass:true,
    responsive:{
        0:{
            items:1,
            nav:true
        },
        600:{
            items:3,
            nav:false
        },
        1000:{
            items:4,
            nav:true,
            loop:false
        }
    }
})
</script>