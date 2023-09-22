<!-- PAGE -->

<!-- /PAGE -->

<div class="container ">
<h2  style="margin-bottom: 20px !important;">Top Featured Products </h2>
	<div class="products">

	    <?php

					$box_style =  5;//$this->db->get_where('ui_settings',array('ui_settings_id' => 29))->row()->value;

					$limit =  20;

                    $featured = $featured = $this->db->where('featured','ok')->get('product')->result_array();

                    foreach($featured as $k => $row){
                        if($k < 20)
                		echo $this->html_model->product_box($row, 'grid', $box_style);

					}

                ?>

	</div>
</div>