	<div class="panel-body" id="demo_s">

	    <select onchange="slevel()" id="amn" name="level">
			            <option value="0" selected>Select Category</option>
                        <option value="0" <?= (isset($_GET['level']) && $_GET['level'] == '0')?"selected":""; ?>>General</option>
                        <option value="808" <?= (isset($_GET['level']) && $_GET['level'] == '808')?"selected":""; ?>>Property</option>
                        <option value="807" <?= (isset($_GET['level']) && $_GET['level'] == '807')?"selected":""; ?>>Cars</option>
                        <option value="917" <?= (isset($_GET['level']) && $_GET['level'] == '917')?"selected":""; ?>>Events</option>
                        <option value="856" <?= (isset($_GET['level']) && $_GET['level'] == '856')?"selected":""; ?>>Hotels</option>
                        <option value="78" <?= (isset($_GET['level']) && $_GET['level'] == '78')?"selected":""; ?>>Jobs</option>
                        <option value="321" <?= (isset($_GET['level']) && $_GET['level'] == '321')?"selected":""; ?>>Restaurants</option>
                        <option value="77" <?= (isset($_GET['level']) && $_GET['level'] == '77')?"selected":""; ?>>Fashion</option>
			<?php /*
			for($i = 1; $i<=$tlevel;$i++)
			{
				?>
					<option value="<?= $i ?>" <?= (isset($_GET['level']) && $_GET['level'] == $i)?"selected":""; ?>><?= $i ?> Level</option>
				<?php

			} */
			?>
		</select>
	    
		<table id="demo-table" class="table table-striped"  data-pagination="true" data-show-refresh="true" data-ignorecol="0,4" data-show-toggle="true" data-show-columns="false" data-search="true" >

			<thead>
				<tr>
					<th><?php echo translate('no');?></th>
					<th><?php echo translate('name');?></th>
					<th><?php echo translate('Category');?></th>
					<th class="text-right"><?php echo translate('options');?></th>
				</tr>
			</thead>
				
			<tbody >
			<?php
				$i=0;
            	foreach($all_amenitys as $row){
            		$i++;
			?>
                <tr>
                    <td><?php echo $i; ?></td>
                    
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['category_name']; ?></td>
                    <td class="text-right">
                        <a class="btn btn-success btn-xs btn-labeled fa fa-wrench" data-toggle="tooltip" 
                            onclick="ajax_modal('edit','<?php echo translate('edit_amenity_(_physical_product_)'); ?>','<?php echo translate('successfully_edited!'); ?>','amenity_edit','<?php echo $row['amenity_id']; ?>')" 
                                data-original-title="Edit" 
                                    data-container="body"><?php echo translate('edit');?>
                        </a>
                        
                        <a onclick="delete_confirm('<?php echo $row['amenity_id']; ?>','<?php echo translate('really_want_to_delete_this?'); ?>')" 
                            class="btn btn-danger btn-xs btn-labeled fa fa-trash" 
                                data-toggle="tooltip" data-original-title="Delete" 
                                    data-container="body"><?php echo translate('delete');?>
                        </a>
                        
                    </td>
                </tr>
            <?php
            	}
			?>
			</tbody>
		</table>
	</div>
           
	<div id='export-div'>
		<h1 style="display:none;"><?php echo translate('amenity'); ?></h1>
		<table id="export-table" data-name='amenity' data-orientation='p' style="display:none;">
				<thead>
					<tr>
						<th><?php echo translate('no');?></th>
						<th><?php echo translate('name');?></th>
						<th><?php echo translate('category');?></th>
					</tr>
				</thead>
					
				<tbody >
				<?php
					$i = 0;
	            	foreach($all_amenitys as $row){
	            		$i++;
				?>
				<tr>
					<td><?php echo $i; ?></td>
					<td><?php echo $row['name']; ?></td>
					<td><?php echo $this->crud_model->get_type_name_by_id('category',$row['category'],'category_name'); ?></td>
				</tr>
	            <?php
	            	}
				?>
				</tbody>
		</table>
	</div>

<style>
	.highlight{
		background-color: #E7F4FA;
	}
</style>




<script>
    $(document).ready(function() {
            console.log( "ready!" );
     
        var val = $('#amn').val();
        $.ajax({
        url: '<?= base_url('admin/amenity/list'); ?>',
        type: "Post",
        async: true,
        data: { val:val},
        success: function (data) {
        //   alert(data);
        },
        error: function (xhr, exception) {
           
        }
    }); 
    
});
</script>
<script>
    $('#amn').on('change', function(){
        var val = $(this).val();
        $.ajax({
        url: '<?= base_url('admin/amenity/list'); ?>',
        type: "Post",
        async: true,
        data: { val:val},
        success: function (data) {
        //   alert(data);
        },
        error: function (xhr, exception) {
           
           
        }
    }); 
    })
</script>
<script>
    function slevel()
{
	ajax_set_list('level','amn');
}
</script>