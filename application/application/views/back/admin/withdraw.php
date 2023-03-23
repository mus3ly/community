<?php
$menus = array();
foreach($all_brands as $k=> $v)
{

    $menus[$v['id']]= $v;
}
?>
	<div class="panel-body" id="demo_s">
		<table id="demo-table" class="table table-striped"  data-pagination="true" data-show-refresh="true" data-ignorecol="0,4" data-show-toggle="true" data-show-columns="false" data-search="true" >

			<thead>
				<tr>
					<th><?php echo translate('no');?></th>
					<th><?php echo translate('Paypal Id');?></th>
					<th><?php echo translate('Total Amount');?></th>
					<th><?php echo translate('Withdraw Request');?></th>
					<th><?php echo translate('Request Created at');?></th>
					<th class="text-right"><?php echo translate('options');?></th>
				</tr>
			</thead>
				
			<tbody >
			<?php
				$i=0;
					foreach($all_brands as $row){
            		$i++;
			?>
                <tr>
                    <td><?php echo $i; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <?php
                    
                    if($row['parent'] == "0"){
                    ?>
                    <td>-</td>
                    <?php
                    }else{
                        // var_dump($menus[$row['parent']]['name']);
                        ?>
                        
                        <td><?php echo $menus[$row['parent']]['name']; ?></td>
                    <?php
                    }
                    ?>
                    <td><?php echo $row['sorting']; ?></td>
                    <td><a target="_blank" href="<?= base_url().$row['slug'];?>"><?php echo $row['slug']; ?></a></td>
                    <td class="text-right">
                        <a class="btn btn-success btn-xs btn-labeled fa fa-wrench" data-toggle="tooltip" 
                            onclick="ajax_modal('edit','<?php echo translate('edit_package'); ?>','<?php echo translate('successfully_edited!'); ?>','brand_edit','<?php echo $row['id']; ?>')" 
                                data-original-title="Edit" 
                                    data-container="body"><?php echo translate('Approve');?>
                        </a>
                        
                        <a onclick="delete_confirm('<?php echo $row['id']; ?>','<?php echo translate('really_want_to_delete_this?'); ?>')" 
                            class="btn btn-danger btn-xs btn-labeled fa fa-trash" 
                                data-toggle="tooltip" data-original-title="Delete" 
                                    data-container="body"><?php echo translate('cancel');?>
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
		<h1 style="display:none;"><?php echo translate('brand'); ?></h1>
		<table id="export-table" data-name='brand' data-orientation='p' style="display:none;">
				<thead>
					<tr>
						<th><?php echo translate('no');?></th>
						<th><?php echo translate('name');?></th>
						<th><?php echo translate('parent');?></th>
					</tr>
				</thead>
					
				<tbody >
				<?php
					$i = 0;
	            	foreach($all_brands as $row){
	            		$i++;
				?>
				<tr>
					<td><?php echo $i; ?></td>
					<td><?php echo $row['name']; ?></td>
					<td>here</td>
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







           