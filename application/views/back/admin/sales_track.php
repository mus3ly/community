<style>
    @import url("https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600&display=swap");


    .root {
        padding: 3rem 1.5rem;
        border-radius: 5px;
        box-shadow: 0 2rem 6rem rgba(0, 0, 0, 0.3);
    }

    figure {
        display: flex;
    }
    figure img {
        width: 8rem;
        height: 8rem;
        border-radius: 50%;
        border: 1px solid #f05a00;
        margin-right: 1.5rem;
    }
    figure figcaption {
        display: flex;
        flex-direction: column;
        justify-content: space-evenly;
    }
    figure figcaption h4 {
        font-size: 1.4rem;
        font-weight: 500;
    }
    figure figcaption h6 {
        font-size: 1rem;
        font-weight: 300;
    }
    figure figcaption h2 {
        font-size: 1.6rem;
        font-weight: 500;
    }

    .order-track {
        margin-top: 2rem;
        padding: 0 1rem;
        border-top: 1px dashed #2c3e50;
        padding-top: 2.5rem;
        display: flex;
        flex-direction: column;
    }
    .order-track-step {
        display: flex;
        height: 7rem;
    }
    .order-track-step:last-child {
        overflow: hidden;
        height: 4rem;
    }
    .order-track-step:last-child .order-track-status span:last-of-type {
        display: none;
    }
    .order-track-status {
        margin-right: 1.5rem;
        position: relative;
    }
    .order-track-status-dot {
        display: block;
        width: 2.2rem;
        height: 2.2rem;
        border-radius: 50%;
        background: #f05a00;
    }
    .order-track-status-line {
        display: block;
        margin: 0 auto;
        width: 2px;
        height: 7rem;
        background: #f05a00;
    }
    .order-track-text-stat {
        font-size: 1.3rem;
        font-weight: 500;
        margin-bottom: 3px;
    }
    .order-track-text-sub {
        font-size: 1rem;
        font-weight: 300;
    }

    .order-track {
        transition: all 0.3s height 0.3s;
        transform-origin: top center;
    }
</style>
<div class="panel-heading">
    <div class="panel-control" style="float: left;">
        <ul class="nav nav-tabs">
            <li class="active">
                <a data-toggle="tab" href="#full">Tracking Information</a>
            </li>
            <?php
                if($this->crud_model->is_admin_in_sale($sale[0]['sale_id'])){
            ?>
            <li>
                <a data-toggle="tab" href="#quart"><?php echo translate('invoice_for'); ?>: <?php echo translate('admin'); ?></a>
            </li>
            <?php
                }
            ?>
            <?php
                $vendors = $this->crud_model->vendors_in_sale($sale[0]['sale_id']);
                foreach ($vendors as $ven) {
            ?>
            <li>
                <a data-toggle="tab" href="#half_<?php echo $ven; ?>"><?php echo translate('invoice_for'); ?>: <?php echo $this->crud_model->get_type_name_by_id('vendor', $ven, 'display_name'); ?> (<?php echo translate('vendor'); ?>)</a>
            </li>
            <?php
                }
            ?>
        </ul>
    </div>
</div>

<div class="panel-body ">
    <div class="tab-base">
        <?php
        	foreach($sale as $row){
                $info = json_decode($row['shipping_address'],true);
                //invoice and map
        ?>

        <div class="col-md-2"></div>
        <div class="col-md-8 bordered print">
            <div class="tab-content">
                <div id="full" class="tab-pane fade active in">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="col-lg-6 col-md-6 col-sm-6 pad-all">
                                <img class="img-responsive logo" src="<?php echo $this->crud_model->logo('home_top_logo'); ?>" alt="Active Super Shop" width="55%"><br><br>
                                <?php if($row['buyer'] == 'guest'){?>
                                <b class="pull-left">
                                    <?php echo translate('invoice_link:');?> <?php echo base_url() ?>home/guest_invoice/<?php echo $row['guest_id']; ?>
                                </b>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 pad-all">
                                <?php if($row['buyer'] == 'guest'){?>
                                <b class="pull-right">
                                    <?php echo translate('guest_id:');?> :<?php echo $row['guest_id']; ?>
                                </b>
                                <br>
                                <?php }?>
                                <b class="pull-right">
                                    <?php echo translate('invoice_no:');?> :<?php echo $row['sale_code']; ?>
                                </b>
                                <br>
                                <?php }?>
                                <b class="pull-right">
                                    <?php echo translate('date_:');?> <?php echo date('d M, Y',$row['sale_datetime'] );?>
                                </b>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12 pad-top">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                            <!--Panel heading-->
                                <div class="panel panel-bordered-grey shadow-none">
                                    <div class="panel-heading">
                                        <h1 class="panel-title"><?php echo translate('client_information');?></h1>
                                    </div>
                                    <!--List group-->
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td><b><?php echo translate('first_name');?></b></td>
                                                <td><?php echo $info['firstname']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><b><?php echo translate('last_name');?></b></td>
                                                <td><?php echo $info['lastname']; ?></td>
                                            </tr>
                                            <tr>
                                                <td><b><?php echo translate('phone');?></b></td>
                                                <td><?php echo $info['phone']; ?>  </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                            <!--Panel heading-->
                                <div class="panel panel-bordered-grey shadow-none">
                                    <div class="panel-heading">
                                        <h1 class="panel-title"><?php echo translate('payment_detail');?></h1>
                                    </div>
                                    <!--List group-->
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td><b><?php echo translate('payment_status');?></b></td>
                                                <td><i><?php echo translate($this->crud_model->sale_payment_status($row['sale_id'])); ?></i></td>
                                            </tr>
                                            <tr>
                                                <td><b><?php echo translate('payment_method');?></b></td>
                                                <td>
                                                    <?php if($info['payment_type'] == 'c2'){
                                                        echo 'TwoCheckout';
                                                    }
                                                    else{
                                                        echo ucfirst(str_replace('_', ' ', $info['payment_type']));
                                                    } ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><b><?php echo translate('payment_date');?></b></td>
                                                <td><?php echo date('d M, Y',$row['sale_datetime'] );?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                       </div>
                    </div>

                    <div class="panel-body" id="demo_s">
                        <div class="fff panel panel-bordered panel-dark shadow-none">
                            <div class="panel-heading">
                                <h1 class="panel-title">Tracking Details</h1>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <section class="root">
                                        <figure>
                                            <figcaption>
                                                <h4>Tracking Number: <?php echo $tracking['tracking_number']; ?></h4>
                                                <p>Carrier: <?php echo $tracking['carrier']; ?></p>
                                                <p>Mail service: <?php echo $tracking['servicelevel']['name']; ?></p>
                                            </figcaption>
                                        </figure>
                                        <div class="order-track">
<!--                                            <div class="order-track-step">-->
<!--                                                <div class="order-track-status">-->
<!--                                                    <span class="order-track-status-dot"></span>-->
<!--                                                    <span class="order-track-status-line"></span>-->
<!--                                                </div>-->
<!--                                                <div class="order-track-text">-->
<!--                                                    <p class="order-track-text-stat">--><?php //echo $tracking['tracking_status']['status_details']; ?><!--</p>-->
<!--                                                    <span class="order-track-text-sub">--><?php //echo
//                                                        date('d M Y', strtotime($tracking['tracking_status']['status_date']));
//                                                    ?><!--</span>-->
<!--                                                </div>-->
<!--                                            </div>-->
                                            <?php foreach(array_reverse($tracking['tracking_history'], true) as $th){?>
                                            <div class="order-track-step">
                                                <div class="order-track-status">
                                                    <span class="order-track-status-dot"></span>
                                                    <span class="order-track-status-line"></span>
                                                </div>
                                                <div class="order-track-text">
                                                    <p class="order-track-text-stat"><?php echo  $th['status_details']; ?></p>
                                                    <span class="order-track-text-sub">
                                                        <?php
                                                         echo  date('d M Y', strtotime($th['status_date']));
                                                        ?>
                                                    </span>
                                                </div>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
<!--End Invoice Footer-->
<?php
    $position = explode(',',str_replace('(', '', str_replace(')', '',$info['langlat'])));
?>

<script>
	$.getScript("http://maps.google.com/maps/api/js?v=3.exp&signed_in=true&callback=MapApiLoaded&key=<?php echo $this->db->get_where('general_settings',array('type' => 'api_key'))->row()->value; ?>", function () {});
	function MapApiLoaded() {
		var map;
		function initialize() {
		  var mapOptions = {
			zoom: 16,
			center: {lat: <?php echo $position[0]; ?>, lng: <?php echo $position[1]; ?>}
		  };
		  map = new google.maps.Map(document.getElementById('mapa'),
			  mapOptions);

		  var marker = new google.maps.Marker({
			position: {lat: <?php echo $position[0]; ?>, lng: <?php echo $position[1]; ?>},
			map: map
		  });

		  var infowindow = new google.maps.InfoWindow({
			content: '<p><?php echo translate('marker_location'); ?>:</p><p><?php echo $info['address1']; ?> </p><p><?php echo $info['address2']; ?> </p><p><?php echo translate('city'); ?>: <?php echo $info['city']; ?> </p><p><?php echo translate('ZIP'); ?>: <?php echo $info['zip']; ?> </p>'
		  });
		  google.maps.event.addListener(marker, 'click', function() {
			infowindow.open(map, marker);
		  });
		}
		initialize();
	}
</script>

<?php
	}
?>
<style>
@media print {
	.print_btn{
		display:none;
	}
    #navbar-container{
        display: none;
    }
    #page-title{
        display: none;
    }
	#mapa{
		display: none;
	}
	.panel-heading{
		display: none;
	}
    .print{
        width: 100%;
    }
    .col-md-6{
        width: 50%;
        float: left;
    }
}
</style>
