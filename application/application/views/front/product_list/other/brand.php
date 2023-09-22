 <!-- PAGE WITH SIDEBAR -->
<section class="page-section with-sidebar">
    <div class="container">
        <div class="row">
            <!-- SIDEBAR -->
            <?php 
                 include 'sidebar.php';
            ?>
            <!-- /SIDEBAR -->
            <!-- CONTENT -->
            <div class="col-md-9 col-sm-9 col-xs-9 content" id="content">
                <input type="text" id="srch" cclass="shop_srch" value="<?= $text; ?>" />
                <button onclick="do_product_search('0');">Search</button>
                <!-- shop-sorting -->
                <!-- /shop-sorting -->
                <div id="result" style="min-height:300px;" class="products">
                <?php
                // print_r($all_products);
                $box_style = 5;
                foreach($all_products as $row){

                		echo $this->html_model->product_box($row, 'grid', $box_style);

					}
                ?>
                </div>
            </div>
            <!-- /CONTENT -->
            <?php
            if($tpage)
            {
            ?>
            <ul class="pagination pagination-v2">
                <?php
                for($i = 0; $i < $tpage;$i++){
                    ?>
                    <li><a rel="grow" class="btn-u btn-u-sea grow" onclick="do_product_search(<?= $i ?>)"><?= $i+1; ?></a></li>
                    <?php
                }
                ?>
                
                <li><a rel="grow" class="btn-u btn-u-sea grow" onclick="do_product_search('12')">›</a></li>
            </ul>
            <?php
            }
            ?>
        </div>
    </div>
</section>
<!-- /PAGE WITH SIDEBAR -->

<style>
    .widget.shop-categories ul ul.children label {
        margin-right: 0;
    }
    .widget.shop-categories ul label {
        display: block;
        margin-right: 20px;
        color: #232323;
        cursor: pointer;
    }
	.pagination-wrapper.bottom{
		text-align-last:center;
	}
	.sort-item{
		display:table;
	}
	.sort-item .form-inline{
		display:table-row;
	}
	.sort-item .form-group{
		display:table-cell;
	}
	.sort-item .widget-search .form-control{
		height:35px;
		line-height: 35px;
	}
	.sort-item .widget-search button{
		line-height: 26px;
	}
	.sort-item .widget-search button:before{
		height:30px;
	}
	.shop-sorting .btn-theme-sm {
		padding: 5px 7px;
	}
	.sidebar.close_now{
		position: relative;
		left:0px;
		opacity:1;
	}
	@media(max-width: 991px) {
		.sidebar.open{
			opacity:1;
			position: fixed;
			z-index: 9999;
			top: -30px;
			background: #f5f5f5;
			height: 100vh;
			overflow-y: auto;
			padding-top: 50px;
			left:0px;
		}
		.sidebar.close_now{
			position: fixed;
			left:-500px;
			opacity:0;
		}
		.view_select_btn{
			margin-top: 10px !important;
		}
	}
</style>
<script>
	$(document).ready(function(e) {
        close_sidebar();
    });
	function open_sidebar(){
		$('.sidebar').removeClass('close_now');
		$('.sidebar').addClass('open');
	}
	function close_sidebar(){
		$('.sidebar').removeClass('open');
		$('.sidebar').addClass('close_now');
	}
</script>