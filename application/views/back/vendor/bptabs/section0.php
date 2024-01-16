<p>
                            <i class="fa-solid fa-children"></i>    Select to see inner categories<br>
                            <i class="fa-solid fa-check-to-slot"></i>    Select to add this category to your selection<br>      </p>
<div id="customer_choice_options" `style="overflow:hidden">
    
    <div id="bpage_cats" style="width:90%;">
        <?php
        $breed = explode(',',$row['category']);
        
        ?>
                
    </div>
    <div>
       <i onclick="bpage_cat('<?= $row['product_id'] ?>','child','0');" class="fa-solid fa-arrows-rotate"></i> <span>Go Back</span>
    </div>
    <div id="cat_selection" style="width:100%;"></div>
                        </div>