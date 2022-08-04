<?php
function get_cat_level($id)
{
	$l = 1;
	$ci =& get_instance();

	$row1 = $ci->db->where('category_id', $id)->get('category')->row();
	$parent = $row1->pcat;
	while ($parent) {
		$l++;
		$row1 = $ci->db->where('category_id', $parent)->get('category')->row();
	$parent = $row1->pcat;
	}
return $l;
}

?>
	<div class="panel-body" id="demo_s">
		<?php
		$tlevel = 5;
		?>
		<select onchange="slevel()" id="cat_level">
			<option value="0">Select Level</option>
			<?php
			for($i = 1; $i<=$tlevel;$i++)
			{
				?>
					<option value="<?= $i ?>"><?= $i ?> Level</option>
				<?php

			}
			?>
		</select>
		<table id="demo-table" class="table table-striped"  data-pagination="true" data-show-refresh="true" data-ignorecol="0,2" data-show-toggle="true" data-show-columns="false" data-search="true" >

			<thead>
				<tr>
					<th><?php echo translate('no');?></th>
					<th><?php echo translate('level');?></th>
					<th><?php echo translate('name');?></th>
					<th><?php echo translate('parent_category');?></th>
                    <th><?php echo translate('fontawsome_icon');?></th>
                    
                    <th><?php echo translate('business_type');?></th>
                    <th><?php echo translate('signup_main_category');?></th>
                    <th><?php echo translate('main_category');?></th>
                    <th><?php echo translate('innner_categories');?></th>
					<th class="text-right"><?php echo translate('options');?></th>
				</tr>
			</thead>
				
			<tbody >
			<?php
			$categories =json_decode($this->db->get_where('ui_settings',array('ui_settings_id' => 71))->row()->value,true);
                                            $result=array();
                                            foreach($categories as $row){
                                                if($this->crud_model->if_publishable_category($row)){
                                                    $result[]=$row;
                                                }
                                            }
			$categories =json_decode($this->db->get_where('ui_settings',array('ui_settings_id' => 35))->row()->value,true);
                                            $result1=array();
                                            foreach($categories as $row){
                                                if($this->crud_model->if_publishable_category($row)){
                                                    $result1[]=$row;
                                                }
                                            }
			$categories =json_decode($this->db->get_where('ui_settings',array('ui_settings_id' => 72))->row()->value,true);
                                            $result2=array();
                                            foreach($categories as $row){
                                                if($this->crud_model->if_publishable_category($row)){
                                                    $result2[]=$row;
                                                }
                                            }
				$i = 0;
            	foreach($all_categories as $row){
            		$i++;
					if(isset($_GET['level']) && $_GET['level'] == get_cat_level($row['category_id']))
					{
			?>
			<tr>
				<td><?php echo $i; ?></td>
				<td><?php echo get_cat_level($row['category_id']); ?></td>
                <td><?php echo $row['category_name']; ?></td>
                <td>
               		<?php
               		if($row['pcat'])
               		{
               			$row1 = $this->db->where('category_id', $row['pcat'])->get('category')->row();
               			if($row1)
               			{
               				echo $row1->category_name; 
               			}

               		}

               		?>
               	</td>
               	<td><i class="fa <?= $row['fa_icon'] ?>" style="    font-size: 50px;" aria-hidden="true"></i></td>
               	
               	<td><input type="checkbox" name="" class="signup_cat" onclick="signup_cat('<?= $row['category_id'] ?>');" value="<?= $row['category_id'] ?>" <?= in_array($row['category_id'], $result)?"checked":""; ?>></td>
               	<td><input type="checkbox" name="" class="signup_main_cat" onclick="signup_main_cat('<?= $row['category_id'] ?>');" value="<?= $row['category_id'] ?>" <?= in_array($row['category_id'], $result2)?"checked":""; ?>></td>
               	<td><input type="checkbox" name="" class="main_cat" onclick="main_cat('<?= $row['category_id'] ?>');" value="<?= $row['category_id'] ?>" <?= in_array($row['category_id'], $result1)?"checked":""; ?>></td>
               	<?php
            	$brands=$this->db->where('pcat',$row['category_id'])->get('category')->result_array();
			?>
			<td>
             <?php 
                        if($brands)
                        {
    					foreach($brands as $row1){
    				?>
                        <span class="label label-info" style="margin-right: 5px;">
                            <?php echo $row1['category_name'];?>
                        </span>
                   	<?php 
    					}
                        } 
    				?>
    			</td>
				<td class="text-right">
					<a class="btn btn-success btn-xs btn-labeled fa fa-wrench" data-toggle="tooltip" 
                    	onclick="ajax_modal('edit','<?php echo translate('edit_category_(_physical_product_)'); ?>','<?php echo translate('successfully_edited!'); ?>','category_edit','<?php echo $row['category_id']; ?>')" 
                        	data-original-title="Edit" data-container="body">
                            	<?php echo translate('edit');?>
                    </a>
					<a onclick="delete_confirm('<?php echo $row['category_id']; ?>','<?php echo translate('really_want_to_delete_this?'); ?>')" class="btn btn-danger btn-xs btn-labeled fa fa-trash" data-toggle="tooltip" 
                    	data-original-title="Delete" data-container="body">
                        	<?php echo translate('delete');?>
                    </a>
				</td>
			</tr>
            <?php
					}
            	}
			?>
			</tbody>
		</table>
	</div>
           
	<div id='export-div'>
		<h1 style="display:none;"><?php echo translate('category'); ?></h1>
		<table id="export-table" data-name='category' data-orientation='p' style="display:none;">
				<thead>
					<tr>
						<th><?php echo translate('no');?></th>
						<th><?php echo translate('name');?></th>
					</tr>
				</thead>
					
				<tbody >
				<?php
					$i = 0;
	            	foreach($all_categories as $row){
	            		$i++;
						
				?>
				<tr>
					<td><?php echo $i; ?></td>
					<td><?php echo $row['category_name']; ?></td>
				</tr>
	            <?php
	            	}
				?>
				</tbody>
		</table>
	</div>

<script>
function slevel()
{
	ajax_set_list('level');
}
</script>