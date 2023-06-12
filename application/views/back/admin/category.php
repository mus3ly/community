<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow" ><?php echo translate('manage_categories');?></h1>
	</div>
	<div class="tab-base">
		<div class="panel">
			<div class="panel-body">
				<div class="tab-content">
					<div style="border-bottom: 1px solid #ebebeb;padding: 25px 5px 5px 5px;"
                    	class="col-md-12" >
						<button id="up_pth" class="btn btn-primary btn-labeled fa-person-walking-arrow-loop-left pull-right mar-rgt" 
                        	onclick="update_path()">
								<?php echo translate('update_path');?>
                                	</button>
						<button id="up_slug" class="btn btn-primary btn-labeled fa-person-walking-arrow-loop-left pull-right mar-rgt" 
                        	onclick="update_all_slug()">
								<?php echo translate('update_slug');?>
                                	</button>
						<button id="up_btn" class="btn btn-primary btn-labeled fa-person-walking-arrow-loop-left pull-right mar-rgt" 
                        	onclick="update_all_db(1)">
								<?php echo translate('update_database');?>
                                	</button>
                        <button id="up_home" class="btn btn-primary btn-labeled fa-person-walking-arrow-loop-left pull-right mar-rgt" 
                        	onclick="update_home()">
								<?php echo translate('update_home');?>
                                	</button>
						<button class="btn btn-primary btn-labeled fa fa-plus-circle pull-right mar-rgt" 
                        	onclick="ajax_modal('add','<?php echo translate('add_category'); ?>','<?php echo translate('successfully_added!'); ?>','category_add','')">
								<?php echo translate('create_category');?>
                                	</button>
					</div>
					<br>
                    <div class="tab-pane fade active in" 
                    	id="list" style="border:1px solid #ebebeb; border-radius:4px;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         
         <form method="post" action="<?= base_url('admin/cat_child');?>" >
              <input type="hidden" name='id' value='' class="form-control" id="cid" value="">
              <input type="text" name='cat_name' value='' class="form-control" id="tagss">
              <!--<input type="text" name='list_itemss' value='' class="form-control" id="list_itemss">-->
                <div id="list_itemss">
                    
                </div>
              <button type="button" class="btn btn-primary" id="cat_childs"  >Add</button>
          </from>
          <div id="cat_child">
              
          </div>
          </div>
      </div>
      
    </div>
  </div>

<script>
	var base_url = '<?php echo base_url(); ?>'
	var user_type = 'admin';
	var module = 'category';
	var list_cont_func = 'list';
	var dlt_cont_func = 'delete';
</script>
<script type="text/javascript">
	$('.signup_cat').click(function(){
		alert();
	});
	function signup_cat(id){
		var url = base_url+'admin/category/signup_cat/'+id
		ajax_load(url,id,'signup_cat');
	}
	function main_cat(id){
		var url = base_url+'admin/category/main_cat/'+id
		ajax_load(url,id,'signup_cat');
	}
	function pegs(id){
		var url = base_url+'admin/category/pegs/'+id
		ajax_load(url,id,'signup_cat');
	}
	function shop(id){
		var url = base_url+'admin/category/shop/'+id
		ajax_load(url,id,'signup_cat');
	}
	function signup_main_cat(id){
		var url = base_url+'admin/category/signup_main_cat/'+id
		ajax_load(url,id,'signup_cat');
	}
	function update_path()
	{
	    $('#up_pth').text('processing');
	    $('#up_pth').attr("disabled", true);
	    $.ajax({
        url: base_url+'home/update_cats',
        type: "Get",
        async: true,
        data: { },
        success: function (data) {
            // alert(data);
            if(data != 0)
            {
                update_path();
            }
            else
            {
                $('#up_pth').text("<?php echo translate('update_slug');?>");
	    $('#up_pth').attr("disabled", false);
	     ajax_set_list();
            }
           
        },
        error: function (xhr, exception) {
            var msg = "";
            if (xhr.status === 0) {
                msg = "Not connect.\n Verify Network." + xhr.responseText;
            } else if (xhr.status == 404) {
                msg = "Requested page not found. [404]" + xhr.responseText;
            } else if (xhr.status == 500) {
                msg = "Internal Server Error [500]." +  xhr.responseText;
            } else if (exception === "parsererror") {
                msg = "Requested JSON parse failed.";
            } else if (exception === "timeout") {
                msg = "Time out error." + xhr.responseText;
            } else if (exception === "abort") {
                msg = "Ajax request aborted.";
            } else {
                msg = "Error:" + xhr.status + " " + xhr.responseText;
            }
           
        }
    }); 
	}
	function update_all_slug()
	{
	    $('#up_slug').text('processing');
	    $('#up_slug').attr("disabled", true);
	    $.ajax({
        url: base_url+'home/update_slug_cat',
        type: "Get",
        async: true,
        data: { },
        success: function (data) {
            // alert(data);
            if(data != 0)
            {
                update_all_slug();
            }
            else
            {
                $('#up_slug').text("<?php echo translate('update_slug');?>");
	    $('#up_slug').attr("disabled", false);
	     ajax_set_list();
            }
           
        },
    }); 
	}
	function update_home()
	{
	    $('#up_home').text('processing');
	    $('#up_home').attr("disabled", true);
	    $.ajax({
        url: base_url+'home/home_file',
        type: "Get",
        async: true,
        data: { },
        success: function (data) {
            if(data = '1')
            {
                update_menu();
            }
           
        },
    }); 
	}
	function update_menu()
	{
	    $.ajax({
        url: base_url+'home/menu_file',
        type: "Get",
        async: true,
        data: { },
        success: function (data) {
            if(data = '1')
            {
               featured_products();
            }
           
        },
    }); 
	}
	function featured_products()
	{
	    $.ajax({
        url: base_url+'home/feature_products',
        type: "Get",
        async: true,
        data: { },
        success: function (data) {
            if(data = '1')
            {
                $('#up_home').text("<?php echo translate('update_home');?>");
                $('#up_home').attr("disabled", false);
                ajax_set_list();
            }
           
        },
    }); 
	}
	function update_all_db(page = 0)
	{
	    $('#up_btn').text('processing');
	    $('#up_btn').attr("disabled", true);
	    $.ajax({
        url: base_url+'admin/category/ulevel/'+page,
        type: "Get",
        async: true,
        data: { },
        success: function (data) {
            // alert(data);
            if(data > 0)
            {
                update_all_db(data);
            }
            else
            {
                $('#up_btn').text("<?php echo translate('update_database');?>");
	    $('#up_btn').attr("disabled", false);
	     ajax_set_list();
            }
           
        },
    }); 
	}
</script>
