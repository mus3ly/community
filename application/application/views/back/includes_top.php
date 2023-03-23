<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $system_title;?></title>


	<!--STYLESHEET-->
	<!--=================================================-->

	<!--Roboto Font [ OPTIONAL ]-->


	<!--Bootstrap Stylesheet [ REQUIRED ]-->
	<link href="<?php echo base_url(); ?>template/back/css/bootstrap.min.css" rel="stylesheet">


	<!--Activeit Stylesheet [ REQUIRED ]-->
	<link href="<?php echo base_url(); ?>template/back/css/activeit.min.css" rel="stylesheet">

	
	<!--Font Awesome [ OPTIONAL ]-->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />



	<!--Animate.css [ OPTIONAL ]-->
	<link href="<?php echo base_url(); ?>template/back/plugins/animate-css/animate.min.css" rel="stylesheet">


	<!--Morris.js [ OPTIONAL ]-->
	<link href="<?php echo base_url(); ?>template/back/plugins/morris-js/morris.min.css" rel="stylesheet">


	<!--Switchery [ OPTIONAL ]-->
	<link href="<?php echo base_url(); ?>template/back/plugins/switchery/switchery.min.css" rel="stylesheet">

	<!--Bootstrap Table [ OPTIONAL ]-->
	<link href="<?php echo base_url(); ?>template/back/plugins/bootstrap-table/bootstrap-table.min.css" rel="stylesheet">


	<!--Bootstrap Select [ OPTIONAL ]-->
	<link href="<?php echo base_url(); ?>template/back/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet">
    <!--select2-->
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!--select2-->
	<!--Summernote [ OPTIONAL ]-->
	<link href="<?php echo base_url(); ?>template/back/plugins/summernote/summernote.min.css" rel="stylesheet">

	<!--Bootstrap Tags Input [ OPTIONAL ]-->
	<link href="<?php echo base_url(); ?>template/back/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet">


	<!--Chosen [ OPTIONAL ]-->
	<link href="<?php echo base_url(); ?>template/back/plugins/chosen/chosen.min.css" rel="stylesheet">



	<!--noUiSlider [ OPTIONAL ]-->
	<link href="<?php echo base_url(); ?>template/back/plugins/noUiSlider/jquery.nouislider.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>template/back/plugins/noUiSlider/jquery.nouislider.pips.min.css" rel="stylesheet">



	<!--Bootstrap Timepicker [ OPTIONAL ]-->
	<link href="<?php echo base_url(); ?>template/back/plugins/Bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet">


	<!--Bootstrap Validator [ OPTIONAL ]-->
	<link href="<?php echo base_url(); ?>template/back/plugins/Bootstrap-validator/bootstrapValidator.min.css" rel="stylesheet">

    
	<!--Dropzone [ OPTIONAL ]-->
	<link href="<?php echo base_url(); ?>template/back/plugins/dropzone/dropzone.css" rel="stylesheet">

	<!--Demo script [ DEMONSTRATION ]-->
	<link href="<?php echo base_url(); ?>template/back/css/demo/activeit-demo.min.css" rel="stylesheet">
	
    <!--Countdown [ REQUIRED ]-->
	<link href="<?php echo base_url(); ?>template/back/css/countdown.css" rel="stylesheet">



	<!--SCRIPT-->
	<!--=================================================-->

	<!--jQuery [ REQUIRED ]-->
	<script src="<?php echo base_url(); ?>template/back/js/jquery-2.1.1.min.js"></script>

		<!--BootstrapJS [ RECOMMENDED ]-->
	<script src="<?php echo base_url(); ?>template/back/js/bootstrap.min.js"></script>

    <link href="<?php echo base_url(); ?>template/back/colorpicker/dist/css/bootstrap-colorpicker.min.css" rel="stylesheet">
	<!--Page Load Progress Bar [ OPTIONAL ]-->
    
    <script src="<?php echo base_url(); ?>template/back/colorpicker/dist/js/bootstrap-colorpicker.js"></script>
	
	<?php $ext =  $this->db->get_where('ui_settings',array('type' => 'fav_ext'))->row()->value;?>
	<link rel="shortcut icon" href="<?php echo base_url(); ?>uploads/others/favicon.<?php echo $ext; ?>">
	<style>
	    .child_cat_row .col-sm-2{
	            margin: 10px 0;
    margin-right: 5px;
    background: #f4f4f4;
    width: 102px;
    display: flex;
    justify-content: space-between;
    padding: 10px;
	    } 
	    .child_cat_row{
	            display: flex;

	    }
	    .modal-dialog-centered{
	        position:relative;
	        top:-19%;
	    }
	    .child_cat_row .cat_del_btn{
	            color:red;
	            cursor:pointer;

	    }
	</style>
	<script>
	<?php
		$volume = $this->crud_model->get_type_name_by_id('general_settings','46','value');
        if($this->crud_model->get_type_name_by_id('general_settings','45','value') == 'ok'){
    ?>
        function sound(type){
            document.getElementById(type).volume = <?php if($volume == '10'){ echo 1 ; }else{echo '0.'.round($volume); } ?>;
            document.getElementById(type).play();
        }
    <?php 
        } else {
    ?>
        function sound(type){}
    <?php
        }
    ?>
	</script>
</head>
