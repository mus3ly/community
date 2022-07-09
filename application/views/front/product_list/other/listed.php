<div class="pagination-wrapper top">
    <?php echo $this->ajax_pagination->create_links(); ?>
</div>
<div class="row products <?php echo $viewtype; ?> flex-gutters-10">
    <?php
    if(!$viewtype)
    {
    	$viewtype = 'grid';
    }
		if($viewtype == 'list'){
			$col_md = 12;
			$col_sm = 12;
			$col_xs = 12;
		} elseif($viewtype == 'grid'){
			$col_md = 3;
			$col_sm = 6;
			$col_xs = 6;
		}
        foreach ($all_products as $row) {
    ?>
    <div class="col-md-<?php echo $col_md; ?> col-sm-<?php echo $col_sm; ?> col-xs-<?php echo $col_xs; ?> mb-4">
        <?php echo $this->html_model->product_box($row, $viewtype, '6'); ?>
    </div>
    <?php
        }
    ?>
</div>
<div class="pagination-wrapper bottom">
    <?php echo $this->ajax_pagination->create_links(); ?>
</div>
<!-- /Pagination -->
<script>
$(document).ready(function(){
	set_product_box_height();
	$('[data-toggle="tooltip"]').tooltip();
});

function set_product_box_height(){
	var max_img = 0;
	$('.products .media img').each(function(){
        var current_height= parseInt($(this).css('height'));
		if(current_height >= max_img){
			max_img = current_height;
		}
    });
	$('.products .media img').css('height',max_img);
	
	var max_title=0;
	$('.products .caption-title').each(function(){
        var current_height= parseInt($(this).css('height'));
		if(current_height >= max_title){
			max_title = current_height;
		}
    });
	$('.products .caption-title').css('height',max_title);
}
</script>