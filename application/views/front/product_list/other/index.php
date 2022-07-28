<section class="banner_listing">
    <div class="menu_items" id="menuitems">
            <ul>
                <?php
                $brands = $this->db->get('category')->result_array();
                ?><?php
                $categories =json_decode($this->db->get_where('ui_settings',array('ui_settings_id' => 35))->row()->value,true);
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
        </div>
</section>
<style type="text/css">
.content-area{
    background: #fff;
}
</style>
 <!-- PAGE WITH SIDEBAR -->
<section class="page-section with-sidebar">
    <div class="container_side">
        <div class="row">
            <!-- SIDEBAR -->
            <?php 
                include 'sidebar.php';
            ?>
            <!-- /SIDEBAR -->
            <!-- CONTENT -->
                    <div class="col-md-6 col-sm-12 col-xs-12 content" id="content">
                        <!-- shop-sorting -->
                        <div class="shop-sorting">
                            <div class="row">
                                <div class="col-md-10 col-sm-12 col-xs-12 sort-item">
                                    <div class="form-inline">
                                        <div class="form-group selectpicker-wrapper">
                                            <select class="selectpicker input-price sorter_search" data-live-search="true" data-width="100%"
                                                data-toggle="tooltip" title="Select" onChange="delayed_search()">                                  
                                                    <option value=""><?php echo translate('sort_by'); ?></option>
                                                    <option value="price_low"><?php echo translate('price_low_to_high'); ?></option>
                                                    <option value="price_high"><?php echo translate('price_high_to_low'); ?></option>
                                                    <option value="condition_old"><?php echo translate('oldest'); ?></option>
                                                    <option value="condition_new"><?php echo translate('newest'); ?></option>
                                                    <option value="most_viewed"><?php echo translate('most_viewed'); ?></option>
                                            </select>
                                        </div>
                                        <?php
                                        if ($this->crud_model->get_type_name_by_id('general_settings','68','value') == 'ok') {
                                        ?>
                                        <div class="form-group selectpicker-wrapper set_brand" style="display:none;">
                                        </div>
                                        <?php
                                        }
                                        ?>
                                        <?php
                                        if ($this->crud_model->get_type_name_by_id('general_settings','58','value') == 'ok') {
                                        ?>
                                        <div class="form-group selectpicker-wrapper set_vendor" style="display:none;">
                                        </div>
                                        <?php
                                        }
                                        ?>
                                        <div class="form-group widget hidden-xs">
                                            <div class="widget-search">
                                                <input class="form-control" type="text" id="texted" value="<?php echo make_proper($text); ?>" placeholder="<?php echo translate('search'); ?>">
                                                <button class="on_click_search txt_src_btn">
                                                    <i class="fa fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-12 col-xs-12 text-right view_select_btn">
                                    <span class="btn btn-theme-transparent pull-left hidden-lg hidden-md" onClick="open_sidebar();">
                                        <i class="fa fa-bars"></i>
                                    </span>
                                    <a class="btn btn-theme-transparent btn-theme-sm grid" onClick="set_view('grid')" href="#"><img src="<?php echo base_url(); ?>template/front/img/icon-grid.png" alt=""/></a>
                                    <a class="btn btn-theme-transparent btn-theme-sm list" onClick="set_view('list')" href="#"><img src="<?php echo base_url(); ?>template/front/img/icon-list.png" alt=""/></a>
                                </div>
                            </div>
                        </div>
                        <!-- /shop-sorting -->
                        <div id="result" style="min-height:300px;">
                        
                        </div>

                    </div>
                <div id="map" style="width:25%;height:800px;"></div>

            <!-- /CONTENT -->
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
    .gm-style-iw img{
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.5/d3.min.js"></script>
 
<script>
    var markers = [];
function initMap() {
  const uluru = { lat: <?= $this->config->item('lat'); ?>, lng: <?= $this->config->item('lng'); ?> };
  const map = new google.maps.Map(document.getElementById("map"), {
    zoom: 4,
    center: uluru,
  });
    for (var i = 0; i < markers.length; i++) {
        console.log(markers[i]);
        var num = i+1;
        var contentString =
    '<div id="content">' +
    '<div id="siteNotice">' +
    "</div>" +
    '<h1 id="firstHeading" class="firstHeading">'+markers[i]['title']+'</h1>' +
    '<div id="bodyContent"><img src="'+markers[i]['img']+'" />' +
    "<p><b>Uluru</b>, also referred to as <b>Ayers Rock</b>, is a large " +
    "sandstone rock formation in the southern part of the " +
    "Northern Territory, central Australia. It lies 335&#160;km (208&#160;mi) " +
    "south west of the nearest large town, Alice Springs; 450&#160;km " +
    "(280&#160;mi) by road. Kata Tjuta and Uluru are the two major " +
    "features of the Uluru - Kata Tjuta National Park. Uluru is " +
    "sacred to the Pitjantjatjara and Yankunytjatjara, the " +
    "Aboriginal people of the area. It has many springs, waterholes, " +
    "rock caves and ancient paintings. Uluru is listed as a World " +
    "Heritage Site.</p>" +
    '<p>Attribution: Uluru, <a href="https://en.wikipedia.org/w/index.php?title=Uluru&oldid=297882194">' +
    "https://en.wikipedia.org/w/index.php?title=Uluru</a> " +
    "(last visited June 22, 2009).</p>" +
    "</div>" +
    "</div>";
         generateIcon(num, function(src) {
        var uluru = { lat: parseFloat(markers[i]['lat']), lng: parseFloat(markers[i]['lng']) };
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
    });
    }
   
  const infowindow = new google.maps.InfoWindow({
    content: contentString,
  });
  
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