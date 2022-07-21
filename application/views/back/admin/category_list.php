	<div class="panel-body" id="demo_s">
		<table id="demo-table" class="table table-striped"  data-pagination="true" data-show-refresh="true" data-ignorecol="0,2" data-show-toggle="true" data-show-columns="false" data-search="true" >

			<thead>
				<tr>
					<th><?php echo translate('no');?></th>
					<th><?php echo translate('name');?></th>
                    <th><?php echo translate('fontawsome_icon');?></th>
                    <th><?php echo translate('business_type');?></th>
                    <th><?php echo translate('signup_main_category');?></th>
                    <th><?php echo translate('main_category');?></th>
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
			?>
			<tr>
				<td><?php echo $i; ?></td>
                <td><?php echo $row['category_name']; ?></td>
               	<td><i class="fa <?= $row['fa_icon'] ?>" style="    font-size: 50px;" aria-hidden="true"></i></td>
               	<td><input type="checkbox" name="" class="signup_cat" onclick="signup_cat('<?= $row['category_id'] ?>');" value="<?= $row['category_id'] ?>" <?= in_array($row['category_id'], $result)?"checked":""; ?>></td>
               	<td><input type="checkbox" name="" class="signup_main_cat" onclick="signup_main_cat('<?= $row['category_id'] ?>');" value="<?= $row['category_id'] ?>" <?= in_array($row['category_id'], $result2)?"checked":""; ?>></td>
               	<td><input type="checkbox" name="" class="main_cat" onclick="main_cat('<?= $row['category_id'] ?>');" value="<?= $row['category_id'] ?>" <?= in_array($row['category_id'], $result1)?"checked":""; ?>></td>
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

