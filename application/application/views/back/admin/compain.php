<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow"><?php echo translate('manage_compain');?></h1>
	</div>
	<div class="tab-base">
		<div class="panel">
			<div class="panel-body">
				<div class="tab-content">
					<div class="col-md-12" style="border-bottom: 1px solid #ebebeb;padding:10px;">
						<button class="btn btn-primary btn-labeled fa fa-plus-circle add_pro_btn pull-right" 
                                onclick="ajax_set_full('compain_add','<?php echo translate('add_blog'); ?>','<?php echo translate('successfully_added!'); ?>','blog_add',''); proceed('to_list');"><?php echo translate('create_compain');?>
                            </button>
					</div>
					<div class="tab-pane fade active in" id="list" 
                    	style="border:1px solid #ebebeb; 
                        	border-radius:4px;">
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	var base_url = '<?php echo base_url(); ?>'
	var user_type = 'admin';
	var module = 'affliate';
	var list_cont_func = 'list';
	var dlt_cont_func = 'delete';
</script>

