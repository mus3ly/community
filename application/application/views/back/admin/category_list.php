<style>
    #list_itemss{
    overflow-y: auto;
    max-height: 140px;
    margin: 12px;
    padding: 10px;
    }
    #list_itemss ul li{
        list-style:none;
        width:20%;
    }
    .form_level{}
    .form_level ul{
        list_style:none;
    }
    .form_level ul li{
        display:inline-block;
    }
</style>
	<div class="panel-body" id="demo_s">
		<?php
		$tlevel = 10;
		$cat_types = array(
		    'signup_cat' => 'Business Type',
		    'signup_main_cat' => 'Signup Main Category',
		    'main_cat' => 'Main Category',
		    'pegs' => 'Pegs',
		    'shop' => 'Shop Category
',
		    );
		?>
		<form>
		<div class="form_level">
		    <label>Category level</label>
		    <ul>
		        <li>
		            <?php $i=0; ?>
		            <input onchange="slevel()" type="radio" id="html" name="level" value="<?= $i ?>" <?= ((isset($_GET['level']) && $_GET['level'] == $i) || !isset($_GET['level']))?"checked":""; ?>>
                    <label for="html">All Level</label>
		        </li>
		        <?php
			for($i = 1; $i<=$tlevel;$i++)
			{
				?>
		        <li>
		            <input onchange="slevel()" type="radio" id="html" name="level" value="<?= $i ?>" <?= (isset($_GET['level']) && $_GET['level'] == $i)?"checked":""; ?>>
                    <label for="html"><?= $i ?> Level</label>
		        </li>
		        <?php

			}
			if(isset($_GET['level']) && $_GET['level'] == 0)
			{
			    unset( $_GET['level']);
			}
			
			?>
		    </ul>
		</div>
		<div class="form_level">
		    <label>Category level</label>
		    <ul>
		        <li>
		            <?php $i=0; ?>
		            <input onchange="slevel()" type="radio" id="all_type" name="type" value="<?= $i ?>" <?= ((isset($_GET['type']) && $_GET['type'] == $i) || !isset($_GET['level']))?"checked":""; ?>>
                    <label for="all_type">All Types</label>
		        </li>
		        <?php
			foreach($cat_types as $i=> $v)
			{
				?>
		        <li>
		            <input onchange="slevel()" type="radio" id="<?= $k ?>" name="type" value="<?= $i ?>" <?= (isset($_GET['type']) && $_GET['type'] == $i)?"checked":""; ?>>
                    <label for="<?= $k ?>"><?= $v ?></label>
		        </li>
		        <?php

			}
			if(isset($_GET['level']) && $_GET['level'] == 0)
			{
			    unset( $_GET['level']);
			}
			
			?>
		    </ul>
		</div>
		</form>
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
                    <th><?php echo translate('pegs');?></th>
                    <th><?php echo translate('shop_category');?></th>
                    <th><?php echo translate('innner_categories');?></th>
                    <th><?php echo translate('child');?></th>
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
			$categories =json_decode($this->db->get_where('ui_settings',array('ui_settings_id' => 86))->row()->value,true);
                                            $result3=array();
                                            foreach($categories as $row){
                                                if($this->crud_model->if_publishable_category($row)){
                                                    $result3[]=$row;
                                                }
                                            }
            $categories =json_decode($this->db->get_where('ui_settings',array('ui_settings_id' => 87))->row()->value,true);
                                            $result4=array();
                                            foreach($categories as $row){
                                                if($this->crud_model->if_publishable_category($row)){
                                                    $result4[]=$row;
                                                }
                                            }
                                            // var_dump($result2);
				$i = 0;
				echo '<div class="cat_view" >';
				if(isset($_GET['type']) && $_GET['type'] == 'signup_cat')
			{
			 foreach($result as $k=> $v)
			 {
			     $row1 = $this->db->where('category_id', $v)->get('category')->row();
               			if($row1)
               			{
               			    ?>
               			    <span class="label label-info" style="margin: 5px;font-size: 13px;"><?= $row1->category_name; ?> <span class="cat_del_btn" style="font-size: 16px;margin: 10px;" onclick="del_cat('.$row1['category_id'].','.$row['pcat'].',1)">x</span></span>
               			    <?php
               			    /*if($k)
               			    {
               				echo ','.$row1->category_name; 
               			    }
               			    else
               			    {
               			        echo $row1->category_name; 
               			    }*/
               			}
			 }
			    $type = false;
			}
			if(isset($_GET['type']) && $_GET['type'] == 'signup_main_cat')
			{
			    foreach($result2 as $k=> $v)
			 {
			     $row1 = $this->db->where('category_id', $v)->get('category')->row();
               			if($row1)
               			{
               			    ?>
               			    <span class="label label-info" style="margin: 5px;font-size: 13px;"><?= $row1->category_name; ?> <span class="cat_del_btn" style="font-size: 16px;margin: 10px;" onclick="del_cat('.$row1['category_id'].','.$row['pcat'].',1)">x</span></span>
               			    <?php
               			    /*if($k)
               			    {
               				echo ','.$row1->category_name; 
               			    }
               			    else
               			    {
               			        echo $row1->category_name; 
               			    }*/
               			}
			 }
			 //   echo $row['category_id'];
			    $type = false;
			}
			if(isset($_GET['type']) && $_GET['type'] == 'main_cat')
			{
			    foreach($result1 as $k=> $v)
			 {
			     $row1 = $this->db->where('category_id', $v)->get('category')->row();
               			if($row1)
               			{
               			    ?>
               			    <span class="label label-info" style="margin: 5px;font-size: 13px;"><?= $row1->category_name; ?> <span class="cat_del_btn" style="font-size: 16px;margin: 10px;" onclick="del_cat('.$row1['category_id'].','.$row['pcat'].',1)">x</span></span>
               			    <?php
               			    /*if($k)
               			    {
               				echo ','.$row1->category_name; 
               			    }
               			    else
               			    {
               			        echo $row1->category_name; 
               			    }*/
               			}
			 }
			 //   echo $row['category_id'];
			    $type = false;
			}
			if(isset($_GET['type']) && $_GET['type'] == 'pegs')
			{
			    foreach($result3 as $k=> $v)
			 {
			     $row1 = $this->db->where('category_id', $v)->get('category')->row();
               			if($row1)
               			{
               			    ?>
               			    <span class="label label-info" style="margin: 5px;font-size: 13px;"><?= $row1->category_name; ?> <span class="cat_del_btn" style="font-size: 16px;margin: 10px;" onclick="del_cat('.$row1['category_id'].','.$row['pcat'].',1)">x</span></span>
               			    <?php
               			    /*if($k)
               			    {
               				echo ','.$row1->category_name; 
               			    }
               			    else
               			    {
               			        echo $row1->category_name; 
               			    }*/
               			}
			 }
			 //   echo $row['category_id'];
			    $type = false;
			}
			if(isset($_GET['type']) && $_GET['type'] == 'shop')
			{
			    foreach($result4 as $k=> $v)
			 {
			     $row1 = $this->db->where('category_id', $v)->get('category')->row();
               			if($row1)
               			{
               			    ?>
               			    <span class="label label-info" style="margin: 5px;font-size: 13px;"><?= $row1->category_name; ?> <span class="cat_del_btn" style="font-size: 16px;margin: 10px;" onclick="del_cat('.$row1['category_id'].','.$row['pcat'].',1)">x</span></span>
               			    <?php
               			    /*if($k)
               			    {
               				echo ','.$row1->category_name; 
               			    }
               			    else
               			    {
               			        echo $row1->category_name; 
               			    }*/
               			}
			 }
			 //   echo $row['category_id'];
			    $type = false;
			}
			echo "</div>";
			$par = array();
			foreach($all_categories as $k=> $v)
			{
			    $par[$v['category_id']] = $v['category_name'];
			}
            	foreach($all_categories as $row){
            		$i++;
            		
			$type = true;
			if(isset($_GET['type']) && $_GET['type'] == 'signup_cat' && !in_array($row['category_id'],$result ) )
			{
			    $type = false;
			}
			if(isset($_GET['type']) && $_GET['type'] == 'signup_main_cat' && !in_array($row['category_id'],$result2 ) )
			{
			 //   echo $row['category_id'];
			    $type = false;
			}
			if(isset($_GET['type']) && $_GET['type'] == 'main_cat' && !in_array($row['category_id'],$result1 ) )
			{
			 //   echo $row['category_id'];
			    $type = false;
			}
			if(isset($_GET['type']) && $_GET['type'] == 'pegs' && !in_array($row['category_id'],$result3 ) )
			{
			 //   echo $row['category_id'];
			    $type = false;
			}
			if(isset($_GET['type']) && $_GET['type'] == 'shop' && !in_array($row['category_id'],$result4 ) )
			{
			 //   echo $row['category_id'];
			    $type = false;
			}
			$type = true;
					if((!$_GET['level'] || $_GET['level'] == $row['level']) && $type)
					{
			?>
			<tr id="trow_<?= $row['category_id']?>">
				<td><?php echo $i; ?></td>
				<td><?php echo $row['level']; ?></td>
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
               	<td><input type="checkbox" name="" class="pegs" onclick="pegs('<?= $row['category_id'] ?>');" value="<?= $row['category_id'] ?>" <?= in_array($row['category_id'], $result3)?"checked":""; ?>></td>
               	<td><input type="checkbox" name="" class="shop" onclick="shop('<?= $row['category_id'] ?>');" value="<?= $row['category_id'] ?>" <?= in_array($row['category_id'], $result4)?"checked":""; ?>></td>
               	<?php
            	$brands=$this->db->where('pcat',$row['category_id'])->get('category')->result_array();
			?>
			<td id="col_<?= $row['category_id'] ?>">
			    <div class="row child_cat_row" style="display:block;">
             <?php 
                        if($brands)
                        {
    					foreach($brands as $row1){
    					    echo '<span class="label label-info" style="margin: 5px;font-size: 13px;">'.$row1['category_name'].'('.$par[$row1['pcat']].')'.'<span class="cat_del_btn" style="font-size: 16px;margin: 10px;" onclick="del_cat('.$row1['category_id'].','.$row['category_id'].',1)">x</span></span>';
    				?>
                   	<?php 
    					}
                        } 
    				?>
    				</div>
    			</td>
    			<td><button type="button" data_id="<?= $row['category_id'] ?>"  onclick="load_chids('<?= $row['category_id'] ?>')" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">Child</button></td>
				<td class="text-right">
					<a class="btn btn-success btn-xs btn-labeled fa fa-wrench" data-toggle="tooltip" 
                    	onclick="ajax_modal('edit','<?php echo translate('edit_category_(_physical_product_)'); ?>','<?php echo translate('successfully_edited!'); ?>','category_edit','<?php echo $row['category_id']; ?>')" 
                        	data-original-title="Edit" data-container="body">
                            	<?php echo translate('edit');?>
                    </a>
					<a onclick="delete_categories('<?php echo $row['category_id']; ?>')" class="btn btn-danger btn-xs btn-labeled fa fa-trash" data-toggle="tooltip" 
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


</div>
<script>
// 
$( document ).ready(function() {
    $('#list_itemss').hide();
});
function slevel()
{
	ajax_set_list('level');
}
$( "#cat_childs" ).on('click' ,function( event ) {
{
    var url = '<?= base_url('admin/cat_child');?>';
    var tags = $('#tagss').val();
    var cid = $('#cid').val();
  $.ajax({
        url: url,
        type: "Post",
        async: true,
        data: { add_child:1,cat_name:tags,id:cid},
        success: function (data) {
           if(data){
               load_chids(cid)
              console.log(data);

           }
        },
    }); 
}

});
function load_chids(id,pid = 0)
{
    $('#cid').val(id);
    var url = '<?= base_url('admin/cat_child');?>';
  $.ajax({
        url: url,
        type: "Post",
        async: true,
        data: { cat_child:1,id:id},
        success: function (data) {
           if(data){
            //   console.log(data);
            if(pid)
            {
             $(pid).html(data);
            }
            else
            {
               $("#cat_child").html(data);
            }

           }
           else
           {
               if(pid)
                {
                 $(pid).html(data);
                }
           }
        },
    }); 
}
$('#tagss').on('keyup',function(){
    // alert();
     var url = '<?= base_url('admin/cat_child');?>';
    var cat_name = $(this).val();
    var cid = $('#cid').val();
      $.ajax({
        url: url,
        type: "Post",
        async: true,
        data: { search:1,cat_name:cat_name,id:cid},
        success: function (data) {
           if(data){
            //   alert(data);
              $("#list_itemss").show();
              $("#list_itemss").html(data);

           }
        },
    });
});

function select(id){
       var url = '<?= base_url('admin/cat_child');?>';
       var cid = $('#cid').val();
       
      $.ajax({
        url: url,
        type: "Post",
        async: true,
        data: { select:1,sid:id, id:cid},
        success: function (data) {
           if(data){
            load_chids(cid)
            //   $("#list_itemss").html(data);

           }
        },
    });
}
	function delete_categories(id){
	    var url = '<?= base_url('admin/category/delete/');?>';
	    var mid = '#trow_'+id;
	  $.ajax({
        url: url,
        type: "Post",
        async: true,
        data: { id:id},
        success: function (data) {
           $.activeitNoty({
					type: 'success',
					icon : 'fa fa-check',
					message : dss,
					container : 'floating',
					timer : 3000
				});
				sound('delete');
				$(mid).remove();
        },
        error: function (xhr, exception) {
         	$.activeitNoty({
					type: 'danger',
					icon : 'fa fa-minus',
					message : cncle,
					container : 'floating',
					timer : 3000
				});
				sound('cancelled');
           
        }
    }); 
	}
</script>