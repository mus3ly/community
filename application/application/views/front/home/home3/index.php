
<style type="text/css">
	
</style>
<div class="arrowbox">
        <img class="textbox" src="https://ads.strokedev.net/uploads/logo_image/h1-slider-img-1.png" alt="">
        <img class="arrow_box" src="https://ads.strokedev.net/uploads/logo_image/h1-slider-img-2.png" alt="">
    </div>
<div class="bannerSearch">
    
    <!-- <h1>Buy & Sell <br><span>What's Now & Next</span></h1> -->
    <div class="brands">
    	<ul>
    <?php
    foreach ($brands as $key => $value) {
        if($key <=5)
        {
    	?>
    	<li>
    	<a href="<?= base_url('/home/text_search'); ?>?list_type=<?= $value['brand_id'] ?>">
    	<i class="fa <?= $value['fa_icon'] ?>" aria-hidden="true"></i>
    	<h4><?= $value['name'] ?></h4>
    </a>
    </li>

    	<?php
    }
    }
    ?>
</ul>
</div>
    <form action="<?= base_url('/home/text_search'); ?>" id="srch_form" onkeyup="submitForm(event)" oninput="submitForm(event)" method="post">
        <input type="search" id="home-search" name="query" placeholder="Search..." value="" class="searchbox" autocomplete="off" spellcheck="false" autocorrect="off" autocapitalize="off" aria-label="Search">
        <svg viewBox="0 0 512 512" focusable="false" class="chakra-icon css-17jqirj" aria-hidden="true"><path fill="#fff" d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z"></path></svg>
    </form>
       <div class="searchplace">
            <button type="button">Search places <i class="fa fa-angle-right"></i> </button>
       </div>
</div>











<?php 
	if($this->crud_model->get_type_name_by_id('general_settings','62','value') == 'ok'){

 		include 'category_menu.php';

	}

?>
<div class="menuwrap">
    <div class="container">
        <div class="row">
            <div class="col-sm-3 bakeries" id="firstrow">
                <div class="img_box">
                    <img src="https://ads.strokedev.net/uploads/logo_image/h1-listing-img-1.jpg">
                    <div class="inner_bakeries">
                    <a href="#">
                        <img src="https://ads.strokedev.net/uploads/logo_image/listing-category-img-4.png" alt="">
                        <h4>Bakeries </h4>
                        <p>Check out selection</p>
                    </a>
                </div>
                </div>
                
            </div>
            <div class="col-sm-3 bakeries" id="secondrow">
                <div class="img_box samllboxes">
                    <img src="https://ads.strokedev.net/uploads/logo_image/h1-listing-img-2.jpg">
                    <div class="inner_bakeries">
                    <a href="#">
                        <img src="https://ads.strokedev.net/uploads/logo_image/listing-category-img-4.png" alt="">
                        <h4>Apartments </h4>
                        <p>Check out selection</p>
                    </a>
                </div>
                </div>
                
                <div class="img_box">
                    <img src="https://ads.strokedev.net/uploads/logo_image/h1-listing-img-3.jpg">
                    <div class="inner_bakeries">
                    <a href="#">
                        <img src="https://ads.strokedev.net/uploads/logo_image/listing-category-img-4.png" alt="">
                        <h4>Galleries</h4>
                        <p>Check out selection</p>
                    </a>
                </div>
                </div>
                
            </div>
            <div class="col-sm-6 bakeries">
                <div class="img_box" id="big_box">
                    <img src="https://ads.strokedev.net/uploads/logo_image/h1-listing-img-4.jpg">
                    <div class="inner_bakeries">
                    <a href="#">
                        <img src="https://ads.strokedev.net/uploads/logo_image/listing-category-img-4.png" alt="">
                        <h4>Asian </h4>
                        <p>Check out our latest selection of creative job positions</p>
                    </a>
                </div>
                </div>
                
            </div>
            
        </div>
    </div>
</div>


<div class="parallexeffect">
    <div class="container">
        <div class="middlebox_content">
            <h3>Visit the Best Restaurants</h3>
            <p>Sheepish yet the slapped adventurously sincere less dalmatian assentingly wherever left ethereal yet the slapped adventurously sincere less dalmatian assentingly wherever left ethereal</p>
            <a href="#">Add Listing </a>
        </div>
    </div>
</div>

<?php 
	include 'top_banner.php';
	//include 'categories.php';
	include 'latest_products.php';
	
	

?>



<?php

	if($this->crud_model->get_type_name_by_id('ui_settings','24','value') == 'ok'){

// 		include 'featured_products.php';

	}

?>



