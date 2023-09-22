<!--[if lt IE 9]>

<script

 src="<?php echo base_url(); ?>template/front/layerslider/assets/js/html5.js"></script>

<![endif]-->



<!-- LayerSlider stylesheet -->

<link rel="stylesheet" href="<?php echo base_url(); ?>template/front/layerslider/css/layerslider.css" type="text/css">

<script src="<?php echo base_url(); ?>template/front/layerslider/js/greensock.js"></script>

<script src="<?php echo base_url(); ?>template/front/layerslider/js/layerslider.transitions.js"></script>

<script src="<?php echo base_url(); ?>template/front/layerslider/js/layerslider.kreaturamedia.jquery.js"></script>



<style>

	#layerslider * {

		font-family: Lato, 'Open Sans', sans-serif;

	}



</style>



	<div id="full-slider-wrapper" style="margin-bottom:30px;">

		<div id="layerslider" style="width:100%;height:500px;">



		<?php

			$this->db->where('status','ok');

			$this->db->order_by('serial','desc');

			$this->db->order_by('slider_id','desc');

			$sliders = $this->db->get('slider')->result_array();

			$h = count($sliders);

			$n = 0;

			foreach ($sliders as $row1) {

				$elements = json_decode($row1['elements'],true);

				$oimgs 	= $elements['images'];

				$txts 	= $elements['texts'];

				$style = json_decode($this->db->get_where('slider_style',array('slider_style_id'=>$row1['style']))->row()->value,true);

				$n++;

			?>

			

            <div class="ls-slide" <?php echo $style['full_slide_style']; ?> >
            	<!-- Header search --> 

                    <div class="header-search mt-4 mt-lg-0 px-xl-5">                            

                        <?php

                            echo form_open(base_url() . 'home/text_search/', array(

                                'method' => 'post',

                                'accept-charset' => "UTF-8"

                            ));

                        ?>

                            <div class="d-flex position-relative">

                                <div class="flex-grow-1 forsearch">
                                    <button class="shrc_btn"><i class="fa fa-search"></i></button>
                                    <input class="form-control" type="text" name="query"  accept-charset="utf-8" placeholder="Search"/>

                                </div>

                                <div>

                                </div>

                                <div>

                                    <?php

                                        if ($this->crud_model->get_type_name_by_id('general_settings','58','value') == 'ok') {

                                    ?>

                                    <select

                                        class="selectpicker header-search-select d-none" data-live-search="true" name="type" onchange="header_search_set(this.value);"

                                        data-toggle="tooltip" title="<?php echo translate('select');?>">

                                        <option value="product"><?php echo translate('product');?></option>

                                        <option value="vendor"><?php echo translate('vendor');?></option>                    

                                    </select>

                                </div>

                                <?php

                                    }

                                ?>

                                

                            </div>

                        </form>

                    </div>

                    <!-- /Header search -->
                <!--BACKGROUND-->

				<?php if(file_exists('uploads/slider_image/background_'.$row1['slider_id'].'.jpg')){ ?>

					<img src="<?php echo base_url(); ?>uploads/slider_image/background_<?php echo $row1['slider_id']; ?>.jpg" class="ls-bg" alt="Slide background"/>	

				<?php } else { ?>

					<img src="<?php echo base_url(); ?>uploads/others/slider default.jpg" class="ls-bg" alt="Slide background"/>

				<?php } ?>

                

                <?php 

                	foreach($style['images'] as $image){ 

                		if(in_array($image['name'], $oimgs)){

                ?>

                    <img class="ls-l" src="<?php echo base_url(); ?>uploads/slider_image/<?php echo $row1['slider_id']; ?>_<?php echo $image['name']; ?>.png"   style="<?php echo $image['style']; ?>" data-ls="<?php echo $image['data_ls']; ?>" >

                <?php

                		}

                	}

                ?>

                <?php 

                	foreach($style['texts'] as $text){

                		$txt = ''; $color = ''; $background = '';

                		foreach ($txts as $a) {

            				if($a['name'] == $text['name']){

            					$txt = $a['text'];

            					$color = $a['color']; 

            					$background = $a['background'];

                			}

                		}

                		if($txt !== ''){

                ?>

                    <<?php echo $text['element']; ?> class="ls-l" style="<?php echo $text['style']; ?> color:<?php echo $color; ?>; background:<?php echo $background; ?>" data-ls="<?php echo $text['data_ls']; ?>" >

                        <?php echo $txt; ?>

                    </<?php echo $text['element']; ?>>

                <?php 

                		}

                	}

                ?>

				<!--LEFT RIGHT WING-->

				<img class="ls-l ls-linkto-<?php if($n == 1){ echo $h;} else {echo $n-1; } ?>" style="top:460px;left:48%;white-space: nowrap;" data-ls="offsetxin:-50;delayin:1000;rotatein:-40;offsetxout:-50;rotateout:-40;"

					 src="<?php echo base_url(); ?>uploads/slider_image/defaults/left.png" alt="">

				<img class="ls-l ls-linkto-<?php if($n == $h){ echo 1;} else {echo $n+1; } ?>" style="top:460px;left:52%;white-space: nowrap;" data-ls="offsetxin:50;delayin:1000;offsetxout:50;"

					 src="<?php echo base_url(); ?>uploads/slider_image/defaults/right.png" alt="">

			</div>

		<?php

			}

		?>

		</div>

	</div>





	<!-- Initializing the slider -->

	<script>

		function start_slider(){

			jQuery("#layerslider").layerSlider({

				responsive: true,

				responsiveUnder: 1280,

				layersContainer: 1280,

				skin: 'noskin',

				hoverPrevNext: false,

				skinsPath: '<?php echo base_url(); ?>template/front/layerslider/skins/'

			});

		}

		

		$(document).ready(function(e) {

            setTimeout(function(){ start_slider(); }, 500);

        });

		

	</script>

    

