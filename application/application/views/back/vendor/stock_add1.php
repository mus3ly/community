<div>
    <?php
		echo form_open(base_url() . 'vendor/stock/get_var/', array(
			'class' => 'form-horizontal', 
			'method' => 'get',
			'id' => 'get_var',
			'enctype' => 'multipart/form-data'
		));
	?>
        <div class="panel-body">
            <div class="form-group">
                <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('product');?></label>
                <div class="col-sm-6">
                    <?php echo $this->crud_model->select_html_vendor('product','parent_product','title','add','demo-chosen-select required','','parent_id',0,''); ?>
                </div>
            </div>
            <span class="btn btn-success btn-md btn-labeled fa fa-upload pull-right enterer" onclick="form_submit('get_var','<?php echo translate('product_has_been_uploaded!'); ?>');proceed('to_add');" ><?php echo translate('next');?></span>
        </div>
	</form>
</div>
<script type="text/javascript">

    $(document).ready(function() {
        $('.demo-chosen-select').chosen();
        $('.demo-cs-multiselect').chosen({width:'100%'});
    });

    function other(){
        $('.demo-chosen-select').chosen();
        $('.demo-cs-multiselect').chosen({width:'100%'});
        $('#reserve').hide();
        $('#rate').val($('#reserve').html());
        total();
    }
    function get_cat(id){
        $('#sub').hide('slow');
		$('#pro').hide('slow');
        ajax_load(base_url+'admin/stock/sub_by_cat/'+id,'sub_cat','other');
        $('#sub').show('slow');
        total();
    }
	function get_product(id){
        $('#pro').hide('slow');
        ajax_load(base_url+'admin/stock/pro_by_sub/'+id,'product','other');
        $('#pro').show('slow');
        total();
    }
    
    function get_pro_res(id){
        ajax_load(base_url+'admin/product/pur_by_pro/'+id,'reserve','other');
    }
    function total(){
        var total = Number($('#quantity').val())*Number($('#rate').val());
        $('#total').val(total);
    }
    $(".totals").change(function(){
        total();
    });


	$(document).ready(function() {
		$("form").submit(function(e){
			event.preventDefault();
		});
	});
</script>
<div id="reserve"></div>

