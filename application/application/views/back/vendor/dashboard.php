<link rel="stylesheet" href="<?php echo base_url(); ?>template/back//amcharts/style.css" type="text/css">
<script src="<?php echo base_url(); ?>template/back/amcharts/amcharts.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>template/back/amcharts/serial.js" type="text/javascript"></script>
<script type="text/javascript" src="http://google-maps-utility-library-v3.googlecode.com/svn/tags/markerclusterer/1.0/src/markerclusterer.js"></script>
<script src="<?php echo base_url(); ?>template/back/plugins/gauge-js/gauge.min.js"></script>

<div id="content-container">	
    <div id="page-title">
        <!--here---->
        <h1 class="page-header text-overflow"><?php echo translate('dashboard');?></h1>
    </div>
    
    <div id="page-content">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <?php if ($this->db->get_where('business_settings',array('type' => 'commission_set'))->row()->value == 'no') {?>
                
                <div class="col-md-12 col-lg-12">
                    <div class="panel panel-bordered panel-grad" style="height:auto !important;">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                            	<?php echo translate('vendorship_details');?>
                            </h3>
                        </div>
                        <div class="panel-body">
                            <div class="text-center">

                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <tr>
                                        	<td><?php echo translate('display_name'); ?> </td>
                                            <td><?php
                                            echo $vend->display_name; ?></td>
                                        </tr>
                                        <tr>
                                        	<td><?php echo translate('email'); ?> </td>
                                            <td><?php
                                            echo $vend->email; ?></td>
                                        </tr>
                                        <tr>
                                        	<td><?php echo translate('company'); ?> </td>
                                            <td><?php
                                            echo $vend->company; ?></td>
                                        </tr>
                                        <tr>
                                            <td><?php echo translate('total_products'); ?> </td>
                                            <td><?php echo $this->db->get_where('product',array('added_by'=>'{"type":"vendor","id":"'.$this->session->userdata('vendor_id').'"}'))->num_rows(); ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="col-md-4 col-lg-4">
                    <div class="panel panel-bordered panel-purple">
                        <div class="panel-heading">
                            <h3 class="panel-title"><?php echo translate('total_sold');?></h3>
                        </div>
                        <div class="panel-body">
                            <div class="text-center">
                                <canvas id="gauge1" height="70" class="canvas-responsive"></canvas>
                                <p class="h4">
                                    <span class="label label-purple"><?php echo currency('','def');?></span>
                                    <span id="gauge1-txt" class="label label-purple">0</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4 col-lg-4">
                    <div class="panel panel-bordered panel-success">
                        <div class="panel-heading">
                            <h3 class="panel-title"><?php echo translate('paid_by_customers');?></h3>
                        </div>
                        <div class="panel-body">
                            <div class="text-center">
                                <canvas id="gauge2" height="70" class="canvas-responsive"></canvas>
                                <p class="h4">
                                    <span class="label label-success"><?php echo currency('','def');?></span>
                                    <span id="gauge2-txt" class="label label-success">0</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4 col-lg-4">
                    <div class="panel panel-bordered panel-black">
                        <div class="panel-heading">
                            <h3 class="panel-title"><?php echo translate('due_from_admin');?></h3>
                        </div>
                        <div class="panel-body">
                            <div class="text-center">
                                <canvas id="gauge3" height="70" class="canvas-responsive"></canvas>
                                <p class="h4">
                                    <span class="label label-black"><?php echo currency('','def');?></span>
                                    <span id="gauge3-txt" class="label label-black">0</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if ($this->db->get_where('business_settings',array('type' => 'commission_set'))->row()->value == 'yes') {?>
                <div class="col-md-4 col-lg-4">
                    <div class="panel panel-bordered panel-grad" style="height:140px !important;">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <?php echo translate('vendor_commission');?>
                            </h3>
                        </div>
                        <div class="panel-body">
                            <div class="text-center">

                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <tr>
                                            <td><?php echo translate('commission_amount'); ?> </td>
                                            <td><?php echo $this->db->get_where('business_settings',array('type' => 'commission_amount'))->row()->value; ?> %</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>


<?php
	$vendor_id = $this->session->userdata('vendor_id');
	$cod_paid = $this->crud_model->vendor_share_total($vendor_id,'paid','cash_on_delivery');
	$stock = $this->crud_model->vendor_share_total($vendor_id);
	$stock = $stock['total'];
	$sale = $this->crud_model->vendor_share_total($vendor_id,'paid');
	$sale = $sale['total'];
	$already_paid = $this->crud_model->paid_to_vendor($vendor_id);
	$destroy = $sale-$already_paid-$cod_paid['total'];
    /*echo  "vendor graph gg:";
    echo "<pre>";
    echo "cod paid :". print_r($cod_paid);echo "|||";
    echo "stock :$stock";echo "|||";
    echo "sale :$sale";echo "|||";
    echo "already paid :$already_paid";echo "|||";
    echo "destroy :$destroy";echo "|||";
    echo "</pre>";*/

?>


<script>
	var base_url = '<?php echo base_url(); ?>';
	var stock = <?php if($stock == 0){echo .1;} else {echo $stock;} ?>;
	var stock_max = <?php echo ($stock*3.5/3+100); ?>;
	var destroy = <?php if($destroy == 0){echo .1;} else {echo $destroy;} ?>;
	var destroy_max = <?php echo ($destroy*3.5/3+100); ?>;
	var sale = <?php if($sale == 0){echo .1;} else {echo $sale;} ?>;
	var sale_max = <?php echo ($sale*3.5/3+100); ?>;
	var currency = '<?php echo currency('','def'); ?>';
	var cost_txt = '<?php echo translate('cost'); ?>(<?php echo currency('','def'); ?>)';
	var value_txt = '<?php echo translate('value'); ?>(<?php echo currency('','def'); ?>)';
	var loss_txt = '<?php echo translate('loss'); ?>(<?php echo currency('','def'); ?>)';
	var pl_txt = '<?php echo translate('profit'); ?>/<?php echo translate('loss'); ?>(<?php echo currency('','def'); ?>)';

	var sale_details = [];
	
	var sale_details1 = [];

	var chartData1 = [];

	var chartData2 = [];

	var chartData3 = [];

	var chartData4 = [
		<?php
			$categories = $this->db->get('category')->result_array();
			foreach($categories as $row) {
				if($this->crud_model->is_category_of_vendor($row['category_id'],$vendor_id)){
					$fin = ($this->crud_model->month_total('sale', 'category', $row['category_id'])) - ($this->crud_model->month_total('stock', 'category', $row['category_id'], 'type', 'add'));
			?>
			{
				"country": "<?php echo $row['category_name']; ?>",
				"visits": <?php echo $fin; ?> ,
				"color": "#458fd2"
			},
		<?php
				}
			}
		?>
	];

	var chartData5 = [];
</script>
<script src="<?php echo base_url(); ?>template/back/js/custom/dashboard.js"></script>
<style>
	  #map-container {
		padding: 6px;
		border-width: 1px;
		border-style: solid;
		border-color: #ccc #ccc #999 #ccc;
		-webkit-box-shadow: rgba(64, 64, 64, 0.5) 0 2px 5px;
		-moz-box-shadow: rgba(64, 64, 64, 0.5) 0 2px 5px;
		box-shadow: rgba(64, 64, 64, 0.1) 0 2px 5px;
		width: 100%;
	  }
	  #map {
		width: 100%;
		height: 400px;
	  }
	  #map1 {
		width: 100%;
		height: 400px;
	  }
	  #actions {
		list-style: none;
		padding: 0;
	  }
	  #inline-actions {
		padding-top: 10px;
	  }
	  .item {
		margin-left: 20px;
	  }
</style>