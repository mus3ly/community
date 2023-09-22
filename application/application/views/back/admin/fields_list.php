	<div class="panel-body" id="demo_s">
	    <?php
	    
	    $categories =json_decode($this->db->get_where('ui_settings',array('ui_settings_id' => 35))->row()->value,true);
                                            $result1=array();
                                            foreach($categories as $row){
                                                if($this->crud_model->if_publishable_category($row)){
                                                    $result1[]=$row;
                                                }
                                            }
	    
	    ?>

	    <!--<select onchange="slevel()" id="cat_level">-->
	    <form>
	    <select id="cat_level" name="category">
			            <option value="">Select Category</option>
			            <?php
			            foreach($result1 as $k=> $v)
            			 {
            			     $row1 = $this->db->where('category_id', $v)->get('category')->row();
                           			if($row1)
                           			{
                           			    ?>
                           			    <option value="<?= $v ?>" <?= (isset($_GET['category']) && $_GET['category'] == $v)?"selected":""; ?>><?= $row1->category_name; ?></option>
                           			    <?php
                           			}
            			 }
			 
			            
			            ?>
		
		</select>
                    <select name="sort" >
                        <option value="0">Choose Sort</option>
                        <?php
                        for($i = 1; $i<=6;$i++)
                        {
                            ?>
                            <option value="<?= $i ?>"  <?= (isset($_GET['sort']) && $_GET['sort'] == $i)?"selected":""; ?>><?= $i ?></option>
                            <?php
                        }
                        ?>
                        </select>
            
                    <select name="filter">
                        <option value="0">Has Filter</option>
                        <option value="1" <?= (isset($_GET['filter']) && $_GET['filter'] == 1)?"selected":""; ?> >Yes</option>
                        <option value="2" <?= (isset($_GET['position']) && $_GET['position'] == 2)?"selected":""; ?>>No</option>
                        </select>
            
                    <select name="position">
                        <option value="0">Choose Position</option>
                        <option value="1" <?= (isset($_GET['position']) && $_GET['position'] == 1)?"selected":""; ?> >1</option>
                        <option value="2" <?= (isset($_GET['position']) && $_GET['position'] == 2)?"selected":""; ?>>2</option>
                        <option value="3" <?= (isset($_GET['position']) && $_GET['position'] == 3)?"selected":""; ?>>3</option>
                        </select>
                        <button id="search">Search</button>
	    </form>
		<table id="demo-table" class="table table-striped"  data-pagination="true" data-show-refresh="true" data-ignorecol="0,4" data-show-toggle="true" data-show-columns="false" data-search="true" >

			<thead>
				<tr>
					<th><?php echo translate('no');?></th>
					<th><?php echo translate('name');?></th>
					<th><?php echo translate('Category');?></th>
					<th><?php echo translate('type');?></th>
					<th><?php echo translate('sort');?></th>
					<th><?php echo translate('position');?></th>
					<th><?php echo translate('filter_information');?></th>
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
                    <td><?php echo $row['type']; ?></td>
                    <td><?php echo $row['sort']; ?></td>
                    <td><?php echo $row['position']; ?></td>
                    <td>
                        <?php
                        if($row['is_filter'])
                        {
                            echo $row['filter_sort'].'-'.$row['tbl_col'];
                        }
                        ?>
                    </td>
                    
                    <td class="text-right">
                        <a class="btn btn-success btn-xs btn-labeled fa fa-wrench" data-toggle="tooltip" 
                            onclick="ajax_modal('edit','<?php echo translate('edit_field'); ?>','<?php echo translate('successfully_edited!'); ?>','fields_edit','<?php echo $row['id']; ?>')" 
                                data-original-title="Edit" 
                                    data-container="body"><?php echo translate('edit');?>
                        </a>
                        
                        <a onclick="delete_confirm('<?php echo $row['id']; ?>','<?php echo translate('really_want_to_delete_this?'); ?>')" 
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
$('#search').on('click', function(e){
    e.preventDefault();
      var x = $("form").serialize();
      console.log(x);
      $.ajax({
        url: '<?= base_url('admin/list_fields/list'); ?>?'+x,
        type: "Post",
        async: true,
        success: function (data) {
           $('#demo_s').html(data);
        },
        error: function (xhr, exception) {
            
           
        }
    });
});
</script>
           