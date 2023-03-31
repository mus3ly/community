<?php
$address = '';
$lat = $this->config->item('lat');
$lng = $this->config->item('lng');
        if(isset($_GET['place_id']) && isset($_GET['place_id']))
        {
            //place_id
            $det = place_details($_GET['place_id']);
            if(isset($det['result']))
            {
            if(isset($det['result']['formatted_address']))
            {
                $address = $det['result']['formatted_address'];
            }
            if(isset($det['result']['geometry']))
            {
                $address = $det['result']['geometry'];
                if(isset($address['location']['lat']))
                {
                    $lat = $address['location']['lat'];
                }
                if(isset($address['location']['lng']))
                {
                    $lng = $address['location']['lng'];
                }
                
            }
            }

        }
?>
<style>
.shop-sorting .btn-theme-sm {
    padding:6px 4px 0 !important;
}

.sort-item .widget-search button {
    line-height: 26px;
    background: #f26122;
    color: #fff;
    border: none;
    padding: 5px 9px;
    display: inline-block;
    vertical-align: middle;
    position: absolute;
    right: 32px;
}
    .ellipse{
        display:none;
    }
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
    .gm-style-iw img{.gm-style .gm-style-iw-c
        width: 50px;height: 50px;
    }
    .gm-style-iw {
  background-color: rgb(237, 28, 36);
    border: 1px solid rgba(72, 181, 233, 0.6);
    border-radius: 10px;
    box-shadow: 0 1px 6px rgba(178, 178, 178, 0.6);
    color: rgb(255, 255, 255) !important;
    font-family: gothambook;
    text-align: center;
    top: 15px !important;
    width: 150px !important;
}
.gm-style .gm-style-iw-c {
    position: absolute;
    box-sizing: border-box;
    overflow: hidden;
    top: 0;
    left: 0;
    transform: translate3d(-50%,-100%,0);
    background-color: white;
    border-radius: 8px;
    padding: 12px;
    box-shadow: 0 2px 7px 1px rgb(0 0 0 / 30%);
    width: 256px !important;
    max-width: initial !important;
}
.white_map_dot img{
        width: 100%;
    height: 190px;
}
.white_map_dot h4{
    color: #000;
    padding: 12px 0 0;
}
.rating_boxes {
    padding: 9px 0 9px 27px;
    text-align: center;
}
.rating_boxes i {
    color: #fff;
    background: #f26122;
    border-radius: 2px;
    width: 20px;
    height: 20px;
    padding: 5px 0 0;
    font-size: 11px;
    cursor: pointer;
    margin: 0 1px 0 5px;
}

    @media(max-width: 991px) {
        .sidebar.open{
            opacity:1;
            position: fixed;
            z-index: 9999;
            top: 0px;
            background: #f5f5f5;
            height: 100vh;
            overflow-y: auto;
            padding-top: 50px;
            left:0px;
        }
        .sidebar.close_now{
            position: fixed;
            left:-550px;
            opacity:1;
        }
        .view_select_btn{
            margin-top: 10px !important;
        }
        #map_div{flex: 0 0 33.333333%;
    max-width: 33.333333%;}
    
    .sidebar{-webkit-transition: all 0.5s ease;
    -moz-transition: all 0.2s ease;
    -o-transition: all 0.2s ease;
    transition: all 0.2s cubic-bezier(0.25, 0.1, 0.22, 0.51);
    top: 0;
    padding-top: 50px;width: 300px;}
    
    }
</style>
<section class="banner_listing">
    <div class="menu_items align" id="menuitems">
        <div class="container menu_list_bg">
            <div class="menulist_bar">
                <h3>Have a Look at what’s happening in your community</h3>
            </div>
            <ul class="menu_list">
                <?php
                $brands = $this->db->get('category')->result_array();
                ?><?php
                $categories =json_decode($this->db->get_where('ui_settings',array('ui_settings_id' => 86))->row()->value,true);
                                            $result=array();
                                            foreach($categories as $row){
                                                if($this->crud_model->if_publishable_category($row)){
                                                    $result[]=$row;
                                                } 
                                            }

                    foreach ($brands as $key => $value) {
                        if(in_array($value['category_id'], $result))
                        {
                        ?>
                        <li>
                    <a href="<?= base_url('home/category/'.$value['category_id']); ?>">
                        <i class="fa <?= ($value['fa_icon'])?$value['fa_icon']:'fa-file-image-o'; ?>"></i>
                        <?= $value['category_name'] ?>
                    </a>
                </li>

                        <?php
                    }
                    }
                ?>
            </ul>
            <div class="product_para">
                <p>Joining Community HubLand gives you the opportunity to post advertisements on you business page, which you can use as your community marketing homepage, and on Community HubLand directory site. Enjoy great marketing features only a few clicks away at a very low subscription fee.</p>
                </div>
            </div>
        </div>
</section>
<section class="container">
    <div class="row">
        
        <div class="col-md-10 add_center_div ">
            <!-- shop-sorting -->
                        <div class="shop-sorting">
                            <div class="row">
                                    <div class="col-sm-12 p-0">
                                            <div class="" id="location_search">
                                            <div class="widget-search search_bar">
                                                <img style="width:22px;" src="<?= base_url('/search_icon_bar.png'); ?>" alt="Search">
                                                <input class="form-control set-shadow-none" style="border-right: 1px solid #f26122 !important;border-radius:0;" type="text" id="texted" value="<?php echo make_proper($text); ?>" placeholder="SEARCH">
                                                <img style="width:17px;" src="<?= base_url('/template/front/images/Location.png'); ?>" alt="Search">
                                                <input type="text" value="<?php echo make_proper($address); ?>" id="loc_box"  onkeyup="search_location()"  placeholder="LOCATION" name="" alt="">
                                                <button onclick="do_product_search('0')" class="on_click_search txt_src_btn">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            <div id="map_search" style="
                                        z-index: 9999999999999999;
                                        position: absolute;
                                    ">
                                                             <img id="loader" style="display:none" src="<?= base_url('/map-loader.gif'); ?>" />
                                                             <div id="result_loc"></div>
                                                         </div>
                                            </div>
                                        </div>
                                        </div>
                                     
                                     
                                    </div>
                            <div class="row" id="width-100">
                                <div class="col-md-12 col-sm-12 col-xs-12 sort-item">
                                    
                                    <div class="row align-items-center">
                                        <div class="col-sm-12 radio_listing set-list-more-icon add_bg_in">
                                            <?php
                                            ?>
                                        
                                                <ul>
                                                    <li>
                                                    <span  class="marg_add"><i class="fa-solid fa-folder"></i></span><a  href="<?= base_url('directory?is_listing=directory_listing'); ?>" class=" <?= ((isset($_GET['is_listing']) && $_GET['is_listing'] == 'directory_listing') || !(isset($_GET['is_listing'])) )?"active":"" ?>"><?php echo translate('directory'); ?></a>
                                                    </li>
                                                    <li>
                                                        <span  class="marg_add"><i class="fa-solid fa-business-time"></i></span><a href="<?= base_url('directory?is_listing=buss_listing'); ?>" class=" <?= (isset($_GET['is_listing']) && $_GET['is_listing'] == 'buss_listing')?"active":"" ?>"><?php echo translate('business'); ?></a>
                                                     </li>
                                                    <li>
                                                        <span  class="marg_add"><i class="fab fa-affiliatetheme"></i></span><a href="<?= base_url('directory?is_listing=affliate_listing'); ?>" class=" <?= (isset($_GET['is_listing']) && $_GET['is_listing'] == 'affliate_listing')?"active":"" ?>"><?php echo translate('affiliate'); ?></a>
                                                     </li>
                                                     <li>
                                                       <span  class="marg_add"><i class="fa-solid fa-shop"></i></span> <a href="<?= base_url('directory/76?is_listing=shop_listing'); ?>" class=" <?= (isset($_GET['is_listing']) && $_GET['is_listing'] == 'shop_listing')?"active":"" ?>"><?php echo translate('shop'); ?></a>
                                                     </li>
                                                     <li>
                                                       <span  class="marg_add"><i class="fa-solid fa-blog"></i></span> <a href="<?= base_url('directory/353?is_listing=blog_listing'); ?>" class=" <?= (isset($_GET['is_listing']) && $_GET['is_listing'] == 'blog_listing')?"active":"" ?>"><?php echo translate('Blogs'); ?></a>
                                                     </li>
                                                     <li>
                                                        <span  class="marg_add"><i class="fa-solid fa-calendar-days"></i></span><a href="<?= base_url('directory/1069?is_listing=event_listing'); ?>" class=" <?= (isset($_GET['is_listing']) && $_GET['is_listing'] == 'event_listing')?"active":"" ?>"><?php echo translate('events'); ?></a>
                                                     </li>
                                                      <li>
                                                        <span  class="marg_add"><i class="fa-solid fa-briefcase"></i></span><a href="<?= base_url('directory/82?is_listing=jobs_listing'); ?>" class=" <?= (isset($_GET['is_listing']) && $_GET['is_listing'] == 'jobs_listing')?"active":"" ?>"><?php echo translate('jobs'); ?></a>
                                                     </li>
                                                      <li>
                                                        <span  class="marg_add"><i class="fa-solid fa-location-dot"></i></span><a href="<?= base_url('directory/87?is_listing=places_listing'); ?>" class=" <?= (isset($_GET['is_listing']) && $_GET['is_listing'] == 'places_listing')?"active":"" ?>"><?php echo translate('places'); ?></a>
                                                     </li>
                                                      <li>
                                                        <span  class="marg_add"><i class="fa-solid fa-car"></i></span><a href="<?= base_url('directory/80?is_listing=car_listing'); ?>" class=" <?= (isset($_GET['is_listing']) && $_GET['is_listing'] == 'car_listing')?"active":"" ?>"><?php echo translate('cars'); ?></a>
                                                     </li>
                                                      <li>
                                                        <span  class="marg_add"><i class="fa-solid fa-building"></i></span><a href="<?= base_url('directory/808?is_listing=property_listing'); ?>" class=" <?= (isset($_GET['is_listing']) && $_GET['is_listing'] == 'property_listing')?"active":"" ?>"><?php echo translate('Property'); ?></a>
                                                     </li>
                                                      <li>
                                                        <span  class="marg_add"><i class="fa-solid fa-hand-holding-heart"></i></span><a href="<?= base_url('directory/134?is_listing=charity_listing'); ?>" class=" <?= (isset($_GET['is_listing']) && $_GET['is_listing'] == 'charity_listing')?"active":"" ?>"><?php echo translate('charity'); ?></a>
                                                     </li>
                                                     <li>
                                                        <span class="marg_add"><i class="fa-solid fa-newspaper"></i></span><a href="<?= base_url('directory/353?is_listing=news_listing'); ?>" class=" <?= (isset($_GET['is_listing']) && $_GET['is_listing'] == 'news_listing')?"active":"" ?>"><?php echo translate('news'); ?></a>
                                                     </li>
                                                </ul>
                                                <a class="btn btn-theme-transparent btn-sort"  id="btn__sort"><img src="<?php echo base_url(); ?>/sort12.png" alt="" width="20px;"/></a>
                                                <ul class="selectpicker input-price sorter_search" data-live-search="true" data-width="100%"
                                                                                       data-toggle="tooltip" title="Select" onClick="delayed_search()" id="sorter_search">
                                                    <li value="rating_num"><?php echo translate('top_rated'); ?></li>
                                                    <li value="distance"><?php echo translate('near_by'); ?></li>
                                                    <li value="rating_num"><?php echo translate('popularity'); ?></li>
                                                    <li value="condition_old"><?php echo translate('oldest'); ?></li>
                                                    <li value="condition_new"><?php echo translate('newest'); ?></li>
                                                    <li value="most_viewed"><?php echo translate('most_viewed'); ?></li>
                                                </ul>
                                                <!--<input type="radio" value="directory_listing" name="group1" id="val2" ><label for="val2"></label>-->
                                                <!--<input type="radio" value="affliate_listing" name="group1" id="val3" <?= (isset($_GET['is_listing']) && $_GET['is_listing'] == 'affliate_listing')?"checked":"" ?>><label for="val3"><?php echo translate('affliate_listing'); ?></label>-->
                                                <!--<input type="radio" value="shop_listing" name="group1" id="val4" <?= (isset($_GET['is_listing']) && $_GET['is_listing'] == 'shop_listing')?"checked":"" ?>><label for="val4"><?php echo translate('shop_listing'); ?></label>-->
                                                <!--<input type="radio" value="blog" name="group1" id="val5" url="<?= base_url('home/blog'); ?>"><label for="val5" <?= (isset($_GET['is_listing']) && $_GET['is_listing'] == 'blog')?"checked":"" ?>><?php echo translate('Blogs'); ?></label>-->
                                        </div>
                                    </div>
                                </div>
                                <!--<div class="col-md-2 col-sm-12 col-xs-12 text-right view_select_btn">-->
                                <!--    <span class="btn btn-theme-transparent pull-left hidden-lg hidden-md" onClick="open_sidebar();">-->
                                <!--        <i class="fa fa-bars"></i>-->
                                <!--    </span>-->
                                <!--    <a class="btn btn-theme-transparent btn-sort" href="#"><img src="<?php echo base_url(); ?>template/front/img/sort.png" alt=""width="20px;"/></a>-->
                                <!--    <a class="btn btn-theme-transparent btn-theme-sm grid" onClick="set_view('grid')" href="#"><img src="<?php echo base_url(); ?>template/front/img/icon-grid.png" alt=""/></a>-->
                                <!--    <a class="btn btn-theme-transparent btn-theme-sm list" onClick="set_view('list')" href="#"><img src="<?php echo base_url(); ?>template/front/img/icon-list.png" alt=""/></a>-->
                                <!--</div>-->
                            </div>
                        </div>
                        <!-- /shop-sorting -->
        </div>
        
    </div>
    
</section>



 <!-- PAGE WITH SIDEBAR -->
 
<section class="page-section with-sidebar">
    <div class="container_side section_bg">
        <div class="container listAndProducts">
            <!--id="top_fixedc"-->
        <div class="row" >
            <!-- SIDEBAR -->
            <?php 
                include 'sidebar.php';
            ?>
            <!-- /SIDEBAR -->
            <!-- CONTENT -->
                    <div class="col-md-8 col-sm-12 col-xs-12 content" id="content">
                        
                        
                        <div id="result" style="min-height:300px;">
                        
                        </div>

                    </div>
                <div class="col-sm-2" id="map_div" style="padding:0;"> <div id="map" style="    width: 100%;
    height: 800px;" class="map_style "></div></div>

            <!-- /CONTENT -->
        </div>
        </div>
    </div>
   
</section>
<!-- /PAGE WITH SIDEBAR -->


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
    
    
    
$(window).on('scroll', function() { 
	var scrollTop = $(window).scrollTop(); 
	if(scrollTop > 300) { 
		$('#top_fixedc').css('position', 'fixed');
		$('#top_fixedc').css('z-index', '999999');
		$('#top_fixedc').css('top', '0');
		$('#top_fixedc').css('left', '0');
		$('#top_fixedc').css('right', '0');
		
		$('#top_fixedc').css('padding', '30px 67px');
		$('#top_fixedc .products.list,#top_fixedc .products.grid').css('height', '400px');
		$('#top_fixedc .products.list,#top_fixedc .products.grid').css('overflow-y', 'auto');
		$('#top_fixedc').css('background', '#fff');
	}
	else { 
		$('#top_fixedc').css('position', 'static'); 
		$('#top_fixedc').css('padding', '0');
			$('#top_fixedc .products.list,#top_fixedc .products.grid,#sidebar').css('height', 'auto');
} })



</script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.5/d3.min.js"></script>
 
<script>
function rate_html(rate)
    {
        rate = Math.ceil(rate);
        var tot = 5;
        var html = '';
        for(i= 1; i<=tot;i++)
        {
            if(i <= rate)
            {
                html += '<i class="fa fa-star"></i>';
            }
            else
            {
                html += '<i class="fa fa-star-o" ></i>';
            }
        }
        return html;
    }
    var markers = [];
    var  map = '';
function initMap() {
  const uluru = { lat: <?= $lat; ?>, lng: <?= $lng; ?> };
   map = new google.maps.Map(document.getElementById("map"), {
    zoom: 12,
    center: uluru,
  });
  console.log(markers);
    for (var i = 0; i < markers.length; i++) {
        // console.log('336');
        // console.log(markers[i]['title']);
        if(markers[i].lat)
        {
            console.log(markers[i].rate);
        var num = i+1;
        var contentString =
    '<div id="content'+i+'">' +
    '<div id="siteNotice">' +
    "</div>";
    contentString = '<div class="white_map_dot">';
   contentString += '<img src="'+markers[i]['img']+'" alt="">';
   contentString += '<h4> '+markers[i]['title']+'</h4>';
   contentString += '<div class="rating_boxes">'+rate_html(markers[i].rate);
      contentString += '<span>1701</span>';
   contentString += '</div>';
   contentString += '<p>Bakeries, Patisserie/Cake Shop, Coffee & Tea</p>';
contentString += '</div>';
    
    contentString+= "</div>" +
    "</div>";
    var icon_lat = markers[i].lat;
    var icon_lng = markers[i].lng;
    num = markers[i].id;
         generateIcon(num, function(src) {
            // alert(icon_lat);
        var uluru = { lat: parseFloat(icon_lat), lng: parseFloat(icon_lng) };
    const marker = new google.maps.Marker({
    position: uluru,
    map,
    icon: src,
    title: markers[i]['title'],
  });

  marker.addListener("click", () => {
    infowindow.open({
      anchor: marker,
      map,
      shouldFocus: false,

    });
  });
  marker.addListener('mouseover', function() {
    // infowindow.open(map, this);
});

// assuming you also want to hide the infowindow when user mouses-out
marker.addListener('mouseout', function() {
    // infowindow.close();
});
// Zoom to 9 when clicking on marker
google.maps.event.addListener(marker,'click',function() {
  map.setZoom(9);
  infowindow.open(map, this);
  map.setCenter(marker.getPosition());
});
    });
    const infowindow = new google.maps.InfoWindow({
    content: contentString,
  });
}//if checkes
}
   
  
  
}

window.initMap = initMap;

var generateIconCache = {};

function generateIcon(number, callback) {
  if (generateIconCache[number] !== undefined) {
    callback(generateIconCache[number]);
  }

  var fontSize = 16,
    imageWidth = imageHeight = 35;

  if (number >= 1000) {
    fontSize = 10;
    imageWidth = imageHeight = 55;
  } else if (number < 1000 && number > 100) {
    fontSize = 14;
    imageWidth = imageHeight = 45;
  }

  var svg = d3.select(document.createElement('div')).append('svg')
    .attr('viewBox', '0 0 54.4 54.4')
    .append('g')

  var circles = svg.append('circle')
    .attr('cx', '27.2')
    .attr('cy', '27.2')
    .attr('r', '21.2')
    .style('fill', '#ff5722');

  var path = svg.append('path')
    .attr('d', 'M27.2,0C12.2,0,0,12.2,0,27.2s12.2,27.2,27.2,27.2s27.2-12.2,27.2-27.2S42.2,0,27.2,0z M6,27.2 C6,15.5,15.5,6,27.2,6s21.2,9.5,21.2,21.2c0,11.7-9.5,21.2-21.2,21.2S6,38.9,6,27.2z')
    .attr('fill', '#FFFFFF');

  var text = svg.append('text')
    .attr('dx', 27)
    .attr('dy', 32)
    .attr('text-anchor', 'middle')
    .attr('style', 'font-size:' + fontSize + 'px; fill: #FFFFFF; font-family: Arial, Verdana; font-weight: bold')
    .text(number);

  var svgNode = svg.node().parentNode.cloneNode(true),
    image = new Image();

  d3.select(svgNode).select('clippath').remove();

  var xmlSource = (new XMLSerializer()).serializeToString(svgNode);

  image.onload = (function(imageWidth, imageHeight) {
    var canvas = document.createElement('canvas'),
      context = canvas.getContext('2d'),
      dataURL;

    d3.select(canvas)
      .attr('width', imageWidth)
      .attr('height', imageHeight);

    context.drawImage(image, 0, 0, imageWidth, imageHeight);

    dataURL = canvas.toDataURL();
    generateIconCache[number] = dataURL;

    callback(dataURL);
  }).bind(this, imageWidth, imageHeight);

  image.src = 'data:image/svg+xml;base64,' + btoa(encodeURIComponent(xmlSource).replace(/%([0-9A-F]{2})/g, function(match, p1) {
    return String.fromCharCode('0x' + p1);
  }));
}
</script>

 <script
      src="https://maps.googleapis.com/maps/api/js?key=<?= $this->config->item('map_key'); ?>&callback=initMap&v=weekly"
      defer
    ></script>

<link rel="stylesheet" href="directoryPage.css">