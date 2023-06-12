<?php
	    if($this->session->flashdata('message'))
	    {
	    ?>
	    <div class="alert alert-success" id="success-alert">
               <button type="button" class="close" data-dismiss="alert">x</button>
               <?= $this->session->flashdata('message');
               unset($_SESSION['message'])
               ?>
            </div>
            <?php
	    }
            ?>
<div class="row">
	<div class="col-sm-8">
		<div class="pagination-wrapper top">
		    <?php echo $this->ajax_pagination->create_links(); ?>
		</div>
	</div>
</div>

<style type="text/css">
	#result ul li:hover {
    background: none !important;
}
.bootstrap-select.btn-group .btn .caret {
    position: absolute;
    top: 50%;
    right: 9px;
    margin-top: -2px;
    vertical-align: middle;
}
</style>

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
			$col_md = 4;
			$col_sm = 4;
			$col_xs = 4;
		}
        foreach ($all_products as $row) {
            
            //  var_dump($row);
            $f= 6;
            $type = 'blog';
            if($row['is_product'])
            {
                $type = 'product';
            }
            /*if($row['is_product'])
            {
                $type = 'product';
            }
            elseif($row['is_bpage'])
            {
                $type = 'bpage';
            }
            elseif($row['is_job'])
            {
                $type = 'job';
            }
            elseif($row['is_event'])
            {
                $type = 'event';
            }
            elseif($row['is_place'])
            {
                $type = 'place';
            }
            elseif($row['is_charity'])
            {
                $type = 'charity';
            }
            elseif($row['is_car'])
            {
                $type = 'car';
            }
            elseif($row['is_blog'])
            {
                $type = 'blog';
            }
            elseif($row['is_property'])
            {
                $type = 'property';
            }*/
    ?> 
    <div class="marg_mee col-md-<?php echo $col_md; ?> col-sm-<?php echo $col_sm; ?> col-xs-<?php echo $col_xs; ?> mb-6">
        <?php echo $this->html_model->product_box1($row, $type.'_'.$viewtype); ?>
    </div>
    <?php
        }
    ?>
</div>
<!--<div class="pagination-wrapper bottom">-->
<!--    <?php echo $this->ajax_pagination->create_links(); ?>-->
<!--</div>-->
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