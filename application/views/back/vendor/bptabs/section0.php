<div id="customer_choice_options" `style="overflow:hidden">
    <div id="bpage_cats" style="width:90%;">
        <?php
        $breed = explode(',',$row['category']);
        
        ?>
                
    </div>
    <div>
       <i onclick="bpage_cat('<?= $row['product_id'] ?>','child','0');" class="fa-solid fa-arrows-rotate"></i>
    </div>
    <div id="cat_selection" style="width:100%;"></div>
                        </div>