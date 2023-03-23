<?php
$cats = $this->db->get('category')->result_array();
?>
<div class="container">
	<div class="row newCate">

	      <div class="col-sm-9 padd_none">

	        <div class=" medical_box">

	          

	          <ul class=" all_category_tabs">

	             <li class="tab-link current ">

	                 <i class="fa fa-bars hvr-bounce-in"></i>

	                 <b>Show Filters</b>

	             </li> 
                <?php
                foreach($cats as $k=> $v)
                {
                    if($k <= 4)
                    {
                    
                    $img = base_url('uploads/category_icon_image/').$v['icon'];
                    ?>
                    <li class="tab-link  ">

	                <img class="hvr-bounce-in" src="<?= $img ?>">

	                 <b><?= $v['category_name'] ?></b>

	             </li>
                    <?php
                    }
                }
                ?>



	              </ul>

	              

	           </div>

	      </div>



	      <div class="col-sm-3 padd_none">

	        <div class=" medical_box flash_deals">

	          <ul class="">

	             <li class="tab-link current  " data-tab="tab-1">

	                 <i class="hvr-bounce-in fa fa-bolt"></i>

	                 <b>Flash Sales</b>

	             </li>

	             <li class="tab-link  " data-tab="tab-2">

	                <img class="hvr-bounce-in" src="https://socialmedia9.com/hypeplug/images/full_6.png">

	                 <b>Below Cost Sale 2020</b>

	             </li>

	              </ul>

	           </div>

	      </div>

	</div>
</div>