
<div id="content-container">
	<div id="page-title">
	    <?php
	    $txt = 'manage_listing';
	    $list_type = '';
	    //is_job
	    
	    if(isset($_GET['is_job']) || isset($_GET['is_event']) || isset($_GET['is_product']) || isset($_GET['is_blog']))
        {
            $txt = (isset($_GET['is_job'])?"manage_job":"manage_event");
            if(isset($_GET['is_product']))
            $txt = "manage_products";
            $list_type = (isset($_GET['is_job'])?"is_job":"is_event");
            if(isset($_GET['is_product']))
            {
            $list_type = "is_product";
            }
            if(isset($_GET['is_blog']))
            {
                $txt = 'manage_blog';
            $list_type = "is_blog";
            }
        }
	    ?>
		<h1 class="page-header text-overflow"><?php echo translate($txt);?></h1>
	</div>
        <div class="tab-base">
            <div class="panel">
                <div class="panel-body">
                    <div class="tab-content">
                        <div class="col-md-12" style="border-bottom: 1px solid #ebebeb;padding: 5px;">
                            <a class="btn btn-primary btn-labeled fa fa-plus-circle add_pro_btn pull-right" href="<?= base_url('vendor/product/add'); ?><?= ($list_type)?"?".$list_type."=1":''; ?>"><?php echo translate('create_listings');?>
                            </a>
                            <button class="btn btn-info btn-labeled fa fa-step-backward pull-right pro_list_btn" 
                                style="display:none;"  onclick="ajax_set_list();  proceed('to_add');"><?php echo translate('here');?>
                            </button>
                        </div>
                    <!-- LIST -->
                    <div class="tab-pane fade active in" id="list" style="border:1px solid #ebebeb; border-radius:4px;">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<span id="prod" style="display:none;"></span>
<script>

	var base_url = '<?php echo base_url(); ?>';
	var timer = '<?php $this->benchmark->mark_time(); ?>';
	var user_type = 'vendor';
	var module = 'product';
	var list_cont_func = 'list';
	var dlt_cont_func = 'delete';
	<?php
	if($list_type)
	{
	    ?>
	    list_cont_func = 'list?<?= $list_type ?>=1';
	    <?php
	}
	?>
	
	function proceed(type){
	   // alert(type);
		if(type == 'to_list'){
			$(".pro_list_btn").show();
			$(".add_pro_btn").hide();
		} else if(type == 'to_add'){
			$(".add_pro_btn").show();
			$(".pro_list_btn").hide();
		}
	}
</script>

