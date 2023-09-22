<div class="loader_img">
    <img width="50px" src="<?=base_url('/upload/map-loader.gif')?>">   
</div>  
<div class="wrapper d-flex align-items-stretch addd_butn" id="addd_butn">
    <nav id="sidebar">
				<div class="custom-menu">
					<button type="button" id="sidebarCollapse" class="btn btn-primary">
	          <i class="ICON_BTN fas fa-cog fa-lg"></i>
	          <span class="sr-only">Toggle Menu</span>
	        </button>
        </div>
				<div class="p-4 pt-5">
		  		<h1><a href="index.html" class="logo">Splash</a></h1>
	        <ul class="list-unstyled components mb-5">
	          <li class="active">
	            <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Home</a>
	            <ul class="collapse list-unstyled" id="homeSubmenu">
                <li>
                    <a href="#">Home 1</a>
                </li>
                <li>
                    <a href="#">Home 2</a>
                </li>
                <li>
                    <a href="#">Home 3</a>
                </li>
	            </ul>
	          </li>
	          <li>
	              <a href="#">About</a>
	          </li>
	          <li>
              <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Pages</a>
              <ul class="collapse list-unstyled" id="pageSubmenu">
                <li>
                    <a href="#">Page 1</a>
                </li>
                <li>
                    <a href="#">Page 2</a>
                </li>
                <li>
                    <a href="#">Page 3</a>
                </li>
              </ul>
	          </li>
	          <li>
              <a href="#">Portfolio</a>
	          </li>
	          <li>
              <a href="#">Contact</a>
	          </li>
	        </ul>

	    <!--    <div class="mb-5">-->
					<!--	<h3 class="h6">Subscribe for newsletter</h3>-->
					<!--	<form action="#" class="colorlib-subscribe-form">-->
	    <!--        <div class="form-group d-flex">-->
	    <!--        	<div class="icon"><span class="icon-paper-plane"></span></div>-->
	    <!--          <input type="text" class="form-control" placeholder="Enter Email Address">-->
	    <!--        </div>-->
	    <!--      </form>-->
					<!--</div>-->

	        

	      </div>
    	</nav>

    
</div>
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
    <?php
    if(isset($_GET['test']))
    {
        include "index_new.php";
        die();
    }
    ?>
    <?php
    $pro = array();
 
    if(isset($product_data[0]))
    {
        $pro = $product_data[0];
    }
    $checks = array();
        if($pro['enable_checks'])
        {
            $checks = json_decode($pro['enable_checks']);
        }
        

    $pros = $this->db->where('added_by',$pro['added_by'])->get('product')->result_array();
    // var_dump($pro['added_by']);
    //galary
    $imgs = $this->db->where('pid',$pro['product_id'])->get('product_to_images')->result_array();
    $logo = '';
    $cat = '';
    if($pro['category'])
    {
        $c = $this->db->where('category_id',$pro['category'])->get('category')->row();
        if(isset($c->category_name))
        {
            $cat = $c->category_name;
        }
    }
        $address = '';
        if($pro['lat'] && $pro['lng'])
        {
            $lat = $pro['lat'];
            $long = $pro['lng'];
            $url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=$lat,$long&sensor=false&key=".$this->config->item('map_key');
    ;
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_ENCODING, "");
    $curlData = curl_exec($curl);
    curl_close($curl);

    $data = json_decode($curlData);
    if(isset($data->results[0]->formatted_address))
    {
        $address = $data->results[0]->formatted_address;
    }


        }
    if(true)
                                                {
                                                    $logo = $this->crud_model->get_img($pro['comp_logo']);
                                                    if(isset($logo->path))
                                                    {
                                                        $logo = base_url().$logo->path;
                                                    }
                                                }
                                                $cover = '';
    if(true)
                                                {
                                                    $cover = $this->crud_model->size_img($pro['comp_cover'],820,312);
                                                }
    ?>
    <?php
    // var_dump($pro);
    // die();
    ?>
    <!DOCTYPE html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Community Hubland</title>
        <!-- meta tag -->
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta http-equiv="Content-Language" content="en-us"/>
        <meta name="description" content=""/>
        <meta name="keywords" content=""/>
        <meta name="distribution" content="global"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link href="https://fonts.googleapis.com/css2?family=Catamaran:wght@300;400;500;600;700&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link id="favicon" rel="icon"  type="<?= base_url(); ?>template/front/images/favicon.png" href="<?= base_url(); ?>template/front/images/favicon.png">
        <link type="text/css" rel="stylesheet" href="<?= base_url(); ?>template/front/css-files/font-awesome.min.css" />
        <link rel="stylesheet" href="<?= base_url(); ?>template/front/css-files/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ng-tags-input/3.2.0/ng-tags-input.min.css" />
        <link type="text/css" rel="stylesheet" href="<?= base_url(); ?>template/front/css-files/style.css" />
            <script src="https://cdnjs.cloudflare.com/ajax/libs/ng-tags-input/3.2.0/ng-tags-input.min.js"></script>

    <style type="text/css">
        .gray{color:gray!important;}
        .ellipse,.rounded_box{display: none;}
        .fa-brands{font-size: 35px; padding: 17px;}
        .fa-facebook-f{color:#3b5998;}
        .fa-twitter{color:  #55acee;}
        .fa-google{color:#dc4e41}
        .fa-linkedin-in{color:#0C63BC;}
        .social_media{margin-left: 40%;}
        .social_media img{    width: 50px;
        height: 50px;}
        .rating {direction: ltr!important;}
        .scroll::-webkit-scrollbar {
            display: none;
        }
#customize_div {
     height: 100vh;
    
    background: #dcdcde;
    z-index: 9999999999;
    width: 100%;

    max-height: 100vh;
    max-width: 307px;
  position: fixed;
 
  top: 0;
  left: 0;
  
  overflow-x: hidden;
  transition: 0.5s;
  padding-top: 60px;
  
}
.collapse li{
    margin-top:10px;
}
#customize_div a {
  /*padding: 8px 8px 8px 32px;*/
  text-decoration: none;
  /*font-size: 25px;*/
  /*color: #818181;*/
  display: block;
  transition: 0.3s;
}
.collapse input{
        width: 100%;
    box-shadow: 0 0 0 transparent;
    border-radius: 4px;
    border: 1px solid #8c8f94;
    background-color: #dcdcde;
    padding: 0 8px;
    line-height: 2;
    min-height: 30px;
    color: #2c3338;
}
.panel-group .border__ {
       padding: 8px 10px;
    color: #50575e;
    font-weight: 300;
    background-color: #fff;
    border-bottom: 1px solid #dcdcde;
    border-left: 4px solid #fff;
    transition: .15s color ease-in-out,.15s background-color ease-in-out,.15s border-color ease-in-out;
    /* box-shadow: 2px 2px 2px 1px rgb(0 0 0 / 20%); */
}
.panel-group .border__:hover{
        color: #2271b1;
    background: #f6f7f7;
    border-left-color: #2271b1;
}
.panel-group{
        background: #ffff;
    width: 100%;
    left: 0;
    top: 171px;
    position: absolute;

    left: 0;
    position: absolute;
}
#customize_div a:hover {
  color: #F26922;
}
.panel-collapse {
    /*margin:15px;*/
}
#customize_div .closebtn {
  position: absolute;
  top: 0;
  right: 25px;
  font-size: 36px;
  margin-left: 50px;
}
.fa-angle-right{
    float:right;
}

.openbtn {
    display:none !important;
  font-size: inherit;
  cursor: pointer;
  background-color: #111;
  color: white;
    position: relative;
    overflow: overlay;
    z-index: 99999;
    display: inline-block;
    margin-left: 65px;
    margin-bottom: 10px;
}

.openbtn:hover {
  background-color: #444;
}

.data_div {
  transition: margin-left .5s;
}
.customizer {
  transition: margin-left .5s;
  padding: 16px;
}

/* On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) */
@media screen and (max-height: 450px) {
  .customizer {padding-top: 15px;}
  .customizer a {font-size: 18px;}
}
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.0/angular-sanitize.js"></script>
    <script src="//cdn.ckeditor.com/4.20.1/standard/ckeditor.js"></script>

    <script>
var app = angular.module('myApp', ['ngSanitize']);
app.controller('myCtrl', function($scope, $http) {
    $scope.update_btn = 'Update Page';
    $scope.detail = {};
    $scope.del_gallery = function(id)
    {
        alert(id);
        // $scope.onload() after deletion perform this
    };
    $scope.update_product = function()
    {
        $scope.update_btn = 'Processing';
        // Simple Post request example:

var url = "<?= base_url('/home/update_product'); ?>",config='contenttype';

$http.post(url, $scope.detail, config).then(function (response) {
    if(response.data)
    {
        $scope.update_btn = 'Update';
    }
    else
    {
        alert("Something working wrong !");
    }
// This function handles success

}, function (response) {

// this function handles error

});
    };
    $scope.onload= function(){
        $http.get("<?= base_url('/home/product_data/'.$pro['product_id']); ?>")
  .then(function(response) {
    $scope.detail = response.data;
    $scope.detail.feature = JSON.parse($scope.detail.feature);
    $scope.detail.etra_content = JSON.parse($scope.detail.etra_content);
alert($scope.detail.etra_content.length);
    if(!$scope.detail.etra_content)
        {
            $scope.detail.etra_content = [];
            for(var i = 0;i < 3;i++)
        {
            $scope.detail.etra_content.push(' ');
        }
        }
            //  $feature  = json_decode($pro['text'],true);
    $scope.detail.text = JSON.parse($scope.detail.text);
     if(!$scope.detail.text)
        {
            $scope.detail.text = [];
            for(var i = 0;i < 7;i++)
        {
            $scope.detail.text.push(' ');
        }
        }
    console.log("detail.text");
    console.log("detail.etra_content");
    console.log($scope.detail.etra_content);
    $scope.add_feature = function(){
        var obj = {
            'fhead':'',
            'fdet':'',
            'edit':'1',
            
        };
        $scope.detail.feature.push(obj); 
    };
    console.log($scope.detail.feature);
    // $('.business_banner').css("background-image", "url('"+$scope.detail.comp_logo+"')");
    // $('.profile_box_img').css("background-image","url('"+$scope.detail.comp_cover+"')");
    console.log(response);
    $('#data_div').show();
  });
    };
    $scope.edit_col= 0;
    $scope.update_col = function()
    {
        alert($scope.detail.number_of_column);
        for(var i = 0;i < $scope.detail.number_of_column;i++)
        {
            if($scope.detail.etra_content[i])
            {
                $scope.detail.etra_content.push(i);
            }
        }
        console.log($scope.detail.etra_content);
    }
   
    $scope.update_edit_col = function(i,ind = 0)
    {
        if(ind)
        {
            var mid = '#extra'+ind;
            $scope.detail.etra_content[ind] = $(mid).val();
        }
        $scope.edit_col = i+1;
    };
    $scope.extra_col = function()
    {
        var clss="col-md-12";
        if($scope.detail.number_of_column == 1)
        {
            clss="col-md-12";
        }
        else if($scope.detail.number_of_column == 2)
        {
            clss="col-md-6";
        }
        else if($scope.detail.number_of_column == 3)
        {
            clss="col-md-4";
        }
        return clss;
    }
     $scope.update_tab = function()
    {
        
        for(var i = 0;i < $scope.detail.number_of_tabs;i++)
        {
            if($scope.detail.etra_tab[i])
            {
                $scope.detail.etra_tab.push(i);
            }
        }
        console.log($scope.detail.etra_tab);
    }
       
    $scope.update_edit_tab = function(i,ind = 0)
    {
        if(ind)
        {
            var mid = '#new'+ind;
            $scope.detail.etra_tab[ind] = $(mid).val();
        }
        $scope.edit_tab = i+1;
    };
    $scope.extra_tab = function()
    {
        var style="width:13%";
        if($scope.detail.number_of_tab == 1)
        {
            style="width:100%";
        }
        else if($scope.detail.number_of_tab == 2)
        {
            style="width:48%";
        }
        else if($scope.detail.number_of_tab == 3)
        {
            style="width:30%";
        }
        else if($scope.detail.number_of_tab == 4)
        {
            style="width:23%";
        }
        else if($scope.detail.number_of_tab == 5)
        {
            style="width:18%";
        }
        else if($scope.detail.number_of_tab == 6)
        {
            style="width:14%";
        }
        return style;
    }
    $scope.upload_file = function(file_id)
    {
        var fd = new FormData();
        var files = $('#'+file_id)[0].files[0];
        fd.append('file',files);
        fd.append('column',file_id);
        fd.append('product',"<?= $pro['product_id']; ?>");

        $.ajax({
            url: '<?= base_url('/home/upload_bpage'); ?>',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function(response){
                // alrert(response);
                if(response){
                    $scope.onload();
                }
            },
        });
    }
    
    $scope.tags = [
    { text: 'Tag1' },
    { text: 'Tag2' },
    { text: 'Tag3' }
  ];
   
  $scope.loadTags = function(query) {
    return $http.get('tags.json');
  };
    $scope.ckchange = function(file_id)
    {
        alert();
    }
    $scope.getBase64 = function(file_id ,file) {
   var reader = new FileReader();
   reader.readAsDataURL(file);
   reader.onload = function () {
     console.log(reader.result);
     if(file_id == 'comp_cover')
     {
         $scope.detail.comp_cover = reader.result;
     $('.business_banner').css("background-image", "url('"+reader.result+"')");
     }
     if(file_id == 'comp_logo')
     {
         $scope.detail.logo = reader.result;
     $('.profile_box_img').attr('src','+reader.result+');
     }
     if(file_id == 'firstImg')
     {
         $scope.detail.firstImg = reader.result;
     $('.profile_box_img').attr('src','+reader.result+');
     }
     $scope.upload_file(file_id);
   };
   reader.onerror = function (error) {
     console.log('Error: ', error);
   };
};
    $scope.fileNameChanged = function(file_id) {
        var file = document.querySelector('#'+file_id).files[0];
$scope.getBase64(file_id, file);
//   alert("select file");
};
    $scope.onload();
});
</script>
    </head>
    <body id="page-name"  ng-app="myApp" ng-controller="myCtrl">
        <div class="container">
        <div class="update_btn">
        <button class="btn btn-primary" ng-click="update_product()">{{update_btn}}</button>
        </div>
        </div>
    <div class="customizer" id="customize_div" style="display:none;">
       
          <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
   
        <div class="upper_case">
            <span>You are customizing</span>
            <h2><strong style="    font-weight: 600;
">Website Name</strong></h2>
        </div>
        <style>
            .upper_case{
                    padding: 30px 10px;
    background: #fff;
    color: #50575e;
    border-left: none;
    border-right: none;
    border-bottom: none;
    cursor: default;
    position: absolute;
    top: 51px;
    left: 0;
    right: 0;
            }
        </style>
        <ul class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <li role="tab" id="headingOne" class="border__">  <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                     <b> Top Banner</b><i class="fa fa-angle-right" aria-hidden="true"></i>
                    </a>
                     <ul id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                <li>
                    <label>Bussniuss title</label>
                    <input type="text" ng-model="detail.title" />
                </li>
                <li>
                    <label>Bussniuss Slogan</label>
                    <input type="text" ng-model="detail.slog" />
                </li>
                <li>
                    <label >Email</label>
                    <input type="text" ng-model="detail.bussniuss_email" />
                </li>
                <li>
                    <label >Whatsapp Number</label>
                    <input type="text" ng-model="detail.whatsapp_number" />
                </li>
                <li>
                    <label >Phone Number</label>
                    <input type="text" ng-model="detail.bussniuss_phone" />
                </li>
                <li>
                    <label>Cover Image</label>
             <input type="file" 
                id="comp_cover" name='file' onchange="angular.element(this).scope().fileNameChanged('comp_cover')" />
                </li>
                <li>
                    <label>Gallery Image</label>
             <input type="file" 
                id="gallery" name='file' onchange="angular.element(this).scope().fileNameChanged('gallery')" />
                </li>
                <li>
                    <label>Logo Image</label>
             <input type="file" 
                id="comp_logo" name='file' onchange="angular.element(this).scope().fileNameChanged('comp_logo')" />
                </li>
            </ul>
            </li>
            <li role="tab" id="headingtwo" class="border__">  <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsetwo" aria-expanded="true" aria-controls="collapsetwo">
                     <b>Info section</b><i class="fa fa-angle-right" aria-hidden="true"></i>
                    </a>
                     <ul id="collapsetwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingtwo">
                <li>
                    <label>Title</label>
                    <input type="text" ng-model="detail.main_heading" />
                </li>
                <li>
                    <label>Slogan</label>
                    <input type="text" ng-model="detail.slogan" />
                </li>
                <li>
                    <label >Detail</label>
                   	<textarea name="ckeditor" class="ckeditor" keyup="angular.element(this).scope().ckchange('description')" ng-model="detail.description">{{detail.description}}</textarea>
                   	<text_s=
                </li>
                <li>
                    <label >Button text1</label>
                    <input type="text" ng-model="detail.whatsapp_number" />
                </li>
                <li>
                    <label >Button url</label>
                    <input type="text" ng-model="detail.bussniuss_phone" />
                </li>
                <li>
                    <label>Button text2</label>
             <input type="text" ng-model="detail.bussniuss_phone" />
                </li>
                <li>
                    <label>Button url</label>
             <input type="text" ng-model="detail.bussniuss_phone" />
                </li>
                 <li>
                    <label>Logo Image</label>
             <input type="file" 
                id="comp_logo" name='file' onchange="angular.element(this).scope().fileNameChanged('comp_logo')" />
                </li>
            </ul>
            </li>
            <li role="tab" id="headingthree" class="border__">  <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsethree" aria-expanded="true" aria-controls="collapsethree">
                     <b>More Detail</b><i class="fa fa-angle-right" aria-hidden="true"></i>
                    </a>
                     <ul id="collapsethree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingthree">
                <li>
                    <label>Title</label>
                    <input type="text" ng-model="detail.extra_section_heading" />
                </li>
                
            </ul>
            </li>
            <li role="tab" id="headingfour" class="border__">  <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsefour" aria-expanded="true" aria-controls="collapsefour">
                     <b>Image Gallery</b><i class="fa fa-angle-right" aria-hidden="true"></i>
                    </a>
                     <ul id="collapsefour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingfour">
                <li>
                    <label>Title</label>
                    <input type="text" ng-model="detail.gallery_lable" />
                </li>
                <li>
                    <label>Description</label>
                    <input type="text" ng-model="detail.gallery_text" />
                </li>
                
            </ul>
            </li>
            <li role="tab" id="headingfive" class="border__">  <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsefive" aria-expanded="true" aria-controls="collapsefive">
                     <b>Text Gallery</b><i class="fa fa-angle-right" aria-hidden="true"></i>
                    </a>
                     <ul id="collapsefive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingfive">
                <li>
                    <label>Title</label>
                    <input type="text" ng-model="detail.gtitle" />
                </li>
                <li>
                    <label>Description</label>
                    <input type="text" ng-model="detail.gdesc" />
                </li>
                
            </ul>
            </li>
            <li role="tab" id="headingsix" class="border__">  <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapsesix" aria-expanded="true" aria-controls="collapsesix">
                     <b>About Us</b><i class="fa fa-angle-right" aria-hidden="true"></i>
                    </a>
                     <ul id="collapsesix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingsix">
                <li>
                    <label>Title</label>
                    <input type="text" ng-model="detail.about_title" />
                </li>
                <li>
                    <label>Description</label>
                    <input type="text" ng-model="detail.about_desc" />
                </li>
                <li>
                    <label>Address</label>
                    <input type="text" ng-model="detail.about_address" />
                </li>
                <li>
                    <label>Categories</label>
                     <tags-input ng-model="tags" add-on-paste="true"><auto-complete source="loadTags($query)"></auto-complete></tags-input>
                </li>
                <li>
                    <label>Opening Time</label>
                     <input type="time" ng-model="detail.openig_time" />
                </li>
                <li>
                    <label>Closing Time</label>
                     <input type="time" ng-model="detail.closing_time" />
                </li>
                
            </ul>
            </li>
            <li role="tab" id="heading7" class="border__">  <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse7" aria-expanded="true" aria-controls="collapse7">
                     <b>More Info</b><i class="fa fa-angle-right" aria-hidden="true"></i>
                    </a>
                     <ul id="collapse7" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading7">
                <li>
                    <label>Title</label>
                    <input type="text" ng-model="detail.info_head" />
                </li>
                <li>
                    <label>Description</label>
                    <input type="text" ng-model="detail.info_desc" />
                </li>
                <li>
                    <label>Button Name</label>
                    <input type="text" ng-model="detail.info_button" />
                </li>
                <li>
                    <label>Button Url</label>
                    <input type="text" ng-model="detail.button_url" />
                </li>
                
                
            </ul>
            </li>
        </ul>
    </div>
    

    <div class="lines_shape">
        <img src="<?= base_url(); ?>template/front/images/lines-shape.png" alt="">
    </div>
    



<div id="data_div" style="display:none;">
    <button class="openbtn" onclick="openNav()">☰ </button> 
    <div class="business_card">
        <div class="container">
            <?php
            if(true)
            {
                ?>
            <div class="business_banner"  style="background: url('{{detail.comp_cover}}');background-position:center;background-size:100% 100%;">
                <div class="overlay_banner__box">
                    <div class="btn_container">
                    <a href="#"><span class="img_container"><img onclick="click_id('comp_cover');" width="50px" src="<?=base_url('/upload/logo.png')?>"></span></a>
                     </div>
                    <!--<button >change cover image</button>-->
               
         <?php  /* ?>
         <div class="social_links_box">
                    <?php
           $img='';
           $social_image = json_decode($pro['social_media']);
                foreach($social_image as $k =>$v){
                    // var_dump($k);
                    $row = $this->db->where('id', $k)->get('bpkg')->row();
                    if($row->img){
                    $img = $this->crud_model->get_img($row->img)->secure_url;
                                 } 
                                 if($v)
                                 {
                ?>
                <a href="<?= $v; ?>" target="_blank"><img style="width:25px;" src="<?= $img; ?>"></a>
                <?php
                                 }
               }
                ?>
                </div>
                <?php */?>
                <div class="whatsapp_new">
                    <a href="mailto:{{detail.bussniuss_email}}"><img src="<?= base_url(); ?>template/front/images/envelope-orange.png" alt=""></a>
                    <a href="https://api.whatsapp.com/send?phone={{detail.whatsapp_number}}"  target="_blank"><img src="<?= base_url(); ?>template/front/images/whats-app.png" alt=""></a>
                    <a href={{'tel:'+detail.bussniuss_phone}}><img src="<?= base_url(); ?>template/front/images/phone-white4.png" alt=""></a>
                </div>
                <div class="share_icon share_icon_right">
                    <ul>
                        
                        <li><a href="#" id="shareit"><img src="<?= base_url(); ?>template/front/images/share.png" alt=""></a>
                        <div class="social_mediabox">
                            <ul>
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                            </ul>
                        </div>
                        </li>
                        <li><a href="#"><img src="<?= base_url(); ?>template/front/images/heart.png" alt=""></a></li>
                    </ul>
                </div>
                <div class="row profile_box">
                    
                    
                    <div class="col-sm-2 profile_box_img">
                        <span class="img_container1"><img width="50px" src="<?=base_url('/upload/logo.png')?>"  onclick="click_id('comp_logo');"></span>
                        <a href="#"><img src="{{detail.comp_logo}}" alt=""></a>
                    </div>
                    <h1 style="color:#fff;">{{detail.title_edit}}</h1>
                    <div class="col-sm-10 right_profilebox">
                        
                        <h3>
                        <span ng-click="detail.title_edit = 1"  ng-if="!detail.title_edit">{{ detail.title }}</span>
                        <form  ng-if="detail.title_edit == 1" class="sub_form">
                            <input class="form-control" class="submit_it"  type="text" ng-model="detail.title" />
                            <button ng-click="detail.title_edit = 0" type="button" class="btn btn-primary">Save</button>
                        </form>
                        <a href="#"><img src="<?= base_url(); ?>template/front/images/Combined-Shape.png" alt=""></a></h3>
                        <p> 
                            <span ng-click="detail.slog_edit = 1" ng-if="!detail.slog_edit">{{ detail.slog }}</span>
                        <form ng-if="detail.slog_edit" style="" class="Submit_1">
">
                            <input type="text" class="form-control" ng-model="detail.slog" />
                            <button ng-click="detail.slog_edit = 0"  type="button" class="btn btn-primary">Save</button>
                        </form>
                        
                        </p>
                        <?php
                                    echo $this->crud_model->rate_html($pro['rating_num']);
                                    ?>

                        <ul style="display:none">
                            <li><a href="https://api.whatsapp.com/send?phone=<?= $pro['whatsapp_number']; ?>&text=Hello this is the starting message"  target = "_blank"><img src="<?= base_url(); ?>template/front/images/Chat-1.png" alt=""> </a></li>
                            <li><a target = "_blank" href="tel:<?= $pro['bussniuss_phone'];?>"><img src="<?= base_url(); ?>template/front/images/Call1.png" alt=""></a></li>
                            <li><a target = "_blank" href="mailto:<?= $pro['bussniuss_email'];?> " class="active"><img src="<?= base_url(); ?>template/front/images/envelope-new.png" alt=""></a></li>
                            <li><a target = "_blank" href="https://www.google.com/maps/?q=<?= $pro['lat'];?>,<?= $pro['lng'];?>"><img src="<?= base_url(); ?>template/front/images/maplocation-s.png" alt="" ></a></li>
                                <?php
                        if ($this->session->userdata('user_login') == "yes") {
                            
                            $user_id = $this->session->userdata('user_id');
                        ?>
                            <li><a target = "_blank" href="<?php echo $this->crud_model->product_link($pro['product_id']); ?>?rate=1"><i class="fa-solid fa-star"></i></a></li>
                            <li><span class="btn" onclick="to_wishlist(<?= $pro['product_id']?>,event)" data-toggle="tooltip" data-placement="right" data-original-title="Add To Wishlist">
                            <i class="fa fa-heart"></i>
                        </span></li>
                            <?php
                        }
                        else
                        {
                            ?>
                            <li><a target = "_blank" href="<?php echo base_url('home/login_set/login'); ?>"><i class="fa-solid fa-star"></i> </a></li>
                            <?php
                        }
                            ?>
                            
                        </ul>
                    </div>
                </div>
            </div>
            <?php
            }
            ?>
            
        </div>
    </div>



    <div class="tabs_wrap">
        <div class="container">
            <div class="inner_tabs">
                <ul class="tabs__box">
                    <?php
                        if($pro['default_tab'] == 'tab_3'){?>
                <li class="tab-link__box <?= isset($pro['default_tab']) && $pro['default_tab'] == 'tab_3' ?"current":""; ?>" data-tab="tab_3">Blogs</li>
                <li class="tab-link__box" data-tab="tab_1">Profile</li>
                <li class="tab-link__box" data-tab="tab_2">Events</li>
                <li class="tab-link__box" data-tab="tab_4">Jobs</li>
                <li class="tab-link__box" data-tab="tab_5">Store</li>
                <li class="tab-link__box" data-tab="tab_6">Reviews</li>
                    <?php
                        }else{
                    
                    ?>
                    <li class="tab-link__box <?= isset($pro['default_tab']) && $pro['default_tab'] == 'tab_1' ?"current":""; ?>" data-tab="tab_1">Profile</li>
                    <li class="tab-link__box" data-tab="tab_3">Blogs</li>
                    <li class="tab-link__box" data-tab="tab_2">Events</li>
                    
                    <li class="tab-link__box" data-tab="tab_4">Jobs</li>
                    <li class="tab-link__box" data-tab="tab_5">Store</li>
                    <li class="tab-link__box" data-tab="tab_6">Reviews</li>
                    <?php
                        }
                    ?>
                </ul>

                
            </div>
        </div>
        <div id="tab_1" class="tab-content__box <?= isset($pro['default_tab']) && $pro['default_tab'] == 'tab_1' ?"current":""; ?>">


                    <div class="advertise_wrap" style="padding-bottom: 0;">
                        <div class="clipart">
                            <?php
                            
                            // $cover = base_url().'template/front/images/info-graphic.png';
                            if($pro['firstImg']) {
                                $cover = $this->crud_model->size_img($pro['firstImg'],820,312);
                            }
                            ?>
                            <!--<img src="<?= base_url(); ?>template/front/images/business_graphic-clipart.png" alt="">-->
                        </div>
                        <div class="container">
                            <?php
            if(true)
            {
                ?>
                            <div class="row" id="advertise_info">
                            <div class="col-sm-4 business_graphic" id="business__graphic">
                                
                                <a href="#" onclick="click_id('firstImg');"><img src="{{detail.firstImg}}" alt=""></a>
                            </div>
                            <div class="col-sm-8 communitybox"  >
                                <b ng-click="detail.slogan_edit = 1" ng-if="!detail.slogan_edit">{{ detail.slogan}}</b>
                                    <form ng-if="detail.slogan_edit" class="sub_form" style="position: relative;">
                                        <input type="text" class="form-control" ng-model="detail.slogan" />
                                        <button  type="button" class="btn btn-primary" ng-click="detail.slogan_edit = 0">Save</button>
                                    </form>
                                    <!--{{ detail.main_heading}}-->
                                    <br>
                                    <h3 ng-click="detail.main_heading_edit = 1" ng-if="!detail.main_heading_edit">{{ detail.main_heading}}</h3>
                                    <form ng-if="detail.main_heading_edit" class="sub_form" style="position: relative;">
                                        <input type="text" class="form-control" ng-model="detail.main_heading" />
                                        <button  type="button" class="btn btn-primary" ng-click="detail.main_heading_edit = 0">Save</button>
                                    </form>
                                <!--<h3>{{detail.main_heading}}</h3>-->
                                <div class="scroll" id="scrol_9sec" >
                                <div class="desc">
                                    <p ng-click="detail.description_edit = 1" ng-if="!detail.description_edit">{{ detail.description}}</p>
                                    <form ng-if="detail.description_edit" class="sub_form2" style="position: relative;">
                                        <textarea name="ckeditor" ng-model="detail.description" class="form-control" style="width:100%;"></textarea>
                                        <button  type="button" class="btn btn-primary" ng-click="detail.description_edit = 0">Save</button>
                                    </form>

                                </div>
                                <ul class="listing_none">
                                        <li ng-repeat="x in detail.feature" ng-if="!x.status">
                                        <div ng-if="!x.edit">
                                        <img src="<?= base_url(); ?>template/front/images/Tick-Square.png" alt="">
                                         {{x.fhead}}
                                         <p>- {{x.fdet}}</p>
                                         </div>
                                         <form ng-if="x.edit" class="sub_form1">
                                             <input class="form-control" type="text" ng-model="x.fhead" placeholder="Heading" />
                                             <br>
                                             <textarea class="form-control" ng-model="x.fdet" >{{x.fdet}}</textarea>
                                             <button ng-click="x.edit = 0" class="btn btn-primary">save</button>
                                             
                                         </form>
                                         <button  type="button" class="btn btn-danger" ng-click="x.status = 1;"><i class="fa-solid fa-trash"></i></button>
                                         <button  type="button" class="btn btn-info" ng-click="x.edit = 1;"><i class="fa-solid fa-pen-to-square"></i></button>
                                    </li>
                                    <button class="btn btn-primary" ng-click="add_feature()">Add new feature item</button>
                                    </ul>
                                </div>
                                <div id="equal_btnw1" style="    margin-bottom: 15px;">
                                    <div class="learn_more_btns">
                                    <?php
                                    if(isset($pro['buttons']) && !empty($pro['buttons'])){
                                    $btns  = json_decode($pro['buttons'],true);
                                    $i = 0;

                                    foreach ($btns as $key => $value) {
                                        $i++;
                                        if($i %2 !=  0)
                                        {
                                            ?>
                                            <a href="<?= $value['url'] ?>" class="our_projects"><?= $value['txt'] ?></a>
                                            <?php
                                        }
                                        else{
                                            ?>
                                            <a href="<?= $value['url'] ?>"><?= $value['txt'] ?></a>
                                            <?php
                                        }
                                    }
                                    }
                                    ?>
                                </div>
                                </div>
                                
                            </div>
                        </div>
                        <?php
            }
                        ?>
                        <?php
                        //extra_info
                        
                        if(true)
                        {
                            $content = json_decode($pro['etra_content'],true);
                            $num = $pro['number_of_column'];
                            $class="12";
                            if($num == 1)
                            {
                                $class = 12;
                            }
                            else if($num == 2)
                            {
                                $class = 6;
                            }
                            else if($num == 3)
                            {
                                $class = 4;
                            }
                            ?>
                        <div class="pro_business" id="boxes___3">
                                <h3 ng-click="detail.extra_section_heading_edit = 1" ng-if="!detail.extra_section_heading_edit">{{ detail.extra_section_heading}}</h3>
                                    <form ng-if="detail.extra_section_heading_edit" class="sub_form" style="position: relative;">
                                        <input type="text" class="form-control" ng-model="detail.extra_section_heading" />
                                        <button  type="button" class="btn btn-primary" ng-click="detail.extra_section_heading_edit = 0">Save</button>
                                    </form>
                        </div>
                        <label>Number of colums</label>
                        {{detail.number_of_column}}
                        <select ng-model="detail.number_of_column" ng-change="update_col()">
                            <option value="1">1</option>
                            <option  value="2">2</option>
                            <option  value="3">3</option>
                        </select>
                        <div class="row" id="left_gp">
                        Test
                        <div ng-repeat="x in detail.etra_content">Test</div
                                <div class=" webdesign" ng-repeat="x in detail.etra_content"  ng-class="extra_col()">
                                    <button class="btn btn-info" ng-click="update_edit_col($index);">Edit it</button>
                                <div class="inner_box_design height_auto scroll" style="overflow-y: scroll;height:324px;min-height: 324px;max-height: 324px;" ng-bind-html="x" ng-if="edit_col != ($index+1)">
                                </div>
                                <dform ng-if="edit_col == ($index+1)">
                                    <textarea style="width:100%; height:500px" id="extra{{$index}}">{{x}}</textarea>
                                    <button class="btn btn-primary" ng-click="update_edit_col(-1, $index)">Save</button>
                                </form>
                            </div>
                            <?php
                            /*for($i= 1; $i<=$num; $i++)
                            {
                                ?>
                                <div class="col-sm-<?= $class ?> webdesign">
                                <div class="inner_box_design height_auto scroll" style="overflow-y: scroll;height:324px;min-height: 324px;max-height: 324px;">
                                    <?php
                                    $k = $i -1;
                                    echo $content[$k];
                                    ?>
                                </div>
                            </div>
                                <?php
                            }*/
                            ?>
                        </div>
                        <?php
                        }
                        ?>
                        <?php
                        if(true)
                        {
                            ?>
                        <div class="verify_head" id="left_gp">
                              <h3 ng-click="detail.gallery_lable_edit = 1" ng-if="!detail.gallery_lable_edit">{{ detail.gallery_lable}}</h3>
                                    <form ng-if="detail.gallery_lable_edit" class="sub_form" style="position: relative;">
                                        <input type="text" class="form-control" ng-model="detail.gallery_lable" />
                                        <button  type="button" class="btn btn-primary" ng-click="detail.gallery_lable_edit = 0">Save</button>
                                    </form>
                            <p ng-click="detail.gallery_text_edit = 1" ng-if="!detail.gallery_text_edit">{{ detail.gallery_text}}</p>
                                    <form ng-if="detail.gallery_text_edit" class="sub_form" style="position: relative;">
                                        <input type="text" class="form-control" ng-model="detail.gallery_text" />
                                        <button  type="button" class="btn btn-primary" ng-click="detail.gallery_text_edit = 0">Save</button>
                                    </form>
                        </div>
                        <?php
                        }
                        ?>
                        <!-- <div class="container">
                            <div class="verify_head " style="    padding: 10px 16px;">
                                  <h3><?= $pro['gallery_lable']; ?></h3>
                            <p><?= $pro['gallery_text']; ?></p>
                        </div>
                        </div> -->
                        <!-- <div class="gallerybox">
                            <div class="row">
                            <?php
                            $i = 0;
                    foreach ($imgs as $key => $value) {
                        $i++;
                        $img = $this->crud_model->size_img($value['img'],500,500);
                        if($i % 2 != 0)
                        {
                            ?>
                            <div class="col-sm-8 left_box">
                                    <div class="bigbox_gallery inner_gallery">
                                        <img src="<?= $img; ?>" alt="">
                                        <div class="overlay_box">
                                            <h4>Marketing Strategy</h4>
                                            <h2>Digital Agency Template</h2>
                                            <p>
                                                <img src="<?= base_url(); ?>template/front/images/girl.png" alt=""> 
                                                <span class="name_avatar">Tamim Islam</span> 
                                                <span class="star_box">
                                                    <img src="<?= base_url(); ?>template/front/images/Star.png">
                                                    <img src="<?= base_url(); ?>template/front/images/Star.png">
                                                    <img src="<?= base_url(); ?>template/front/images/Star.png">
                                                    <img src="<?= base_url(); ?>template/front/images/Star.png">
                                                    <img src="<?= base_url(); ?>template/front/images/Star.png">
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                            <?php

                        }
                        else{
                            ?>
                            <div class="col-sm-4 right_box">
                                    <div class="small_box_gallery inner_gallery">
                                        <img src="<?= base_url(); ?>template/front/images/gallery_2.png" alt="">
                                        <div class="overlay_box">
                                            <h4>Marketing Strategy</h4>
                                            <h2>Digital Agency Template</h2>
                                            <p>
                                                <img src="<?= base_url(); ?>template/front/images/girl.png" alt=""> 
                                                <span class="name_avatar">Tamim Islam</span> 
                                                <span class="star_box">
                                                    <img src="<?= base_url(); ?>template/front/images/Star.png">
                                                    <img src="<?= base_url(); ?>template/front/images/Star.png">
                                                    <img src="<?= base_url(); ?>template/front/images/Star.png">
                                                    <img src="<?= base_url(); ?>template/front/images/Star.png">
                                                    <img src="<?= base_url(); ?>template/front/images/Star.png">
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            <?php

                        }
                        ?>
                                
                                <?php
                                    }
                                ?>
                                
                                </div>
                        </div> -->
                        </div>
                <?php
                        if(true){
                        ?>
                        
                        <?php
                        if(true)
                        {
                            $first = '';
                            if(isset($imgs[0]))
                            {
                                $first =  $this->crud_model->size_img($imgs[0]['img'],500,500);
                            }
                            $scd = '';
                            if(isset($imgs[1]))
                            {
                                $scd =  $this->crud_model->size_img($imgs[1]['img'],500,500);
                            }
                            $thrd = '';
                            if(isset($imgs[2]))
                            {
                                $thrd =  $this->crud_model->size_img($imgs[2]['img'],500,500);
                            }
                            ?>
                        <div class="container gallery_div">
                            <div class="flex_ittt">
                            <ul>
                                <li ng-repeat="x in detail.gallary" class="icon_flex"><img  src="{{x.img}}" /><a href="#" ng-click="del_gallery(x.id)" class="cross_icon"><i class="fa-solid fa-trash-can"></i></a></li> 
                                <li  onclick="click_id('gallery')"><button class="add_buton"><i class="fa-solid fa-plus icon_button"></i></button></li>
                            </ul>
                        </div>
                        </div>
                        <div class="container d-none">

                            <!-- new slider -->

                            <div class="slider_gallery__box">
                                 <span ng-click="detail.title_edit = 1"  ng-if="!detail.title_edit">Choose gallery Imae</span>
                        <form  ng-if="detail.title_edit == 1" class="sub_form">
                            <input type="file" ng-model="detail.title" />
                            <button ng-click="detail.title_edit = 0" type="button" class="btn btn-primary">Save</button>
                        </form>
                                <div class="row">
                                    <div class="col-sm-9 left__slidebos">
                                        <div class="large_sliderbox">
                                            <img src="<?= $first ?>" data-src="<?= $first ?>" id="large_img" cur="0" ondblclick="opengal('0')" class="galimg" index="0" alt="">
                                        </div>
                                        <div class="arrow__left">
                                            <a href="#" onclick="gopre()"><i class="fa fa-angle-left"></i></a>
                                        </div>
                                        <div class="arrow__right">
                                            <a href="#"  onclick="gonext()"><i class="fa fa-angle-right"></i></a>
                                        </div>
                                    </div>

                                    <div class="col-sm-3 right__boxlighbox" id="right_slider">
                                        
                                    <a>
                                      <img src="<?= $scd ?>" class="galimg thumb" onclick="selImg(1)"  ondblclick="opengal('1')" index="1">
                                    </a>
                                    <!-- first image box webdevtrick.com -->
                                    <a >
                                      <img  style="margin-bottom: 13px;" src="<?= $thrd ?>"  onclick="selImg(2)" class="galimg thumb" index="2"  ondblclick="opengal('2')">
                                    </a>
                                    <!-- second image box webdevtrick.com -->
                                    
                                    </div>
                                    
                                    <div class="col-sm-12 right__boxlighbox">
                                    <?php
                                    $i = 0;
                                    foreach($imgs as $k=> $v)
                                    {
                                        $i = $i+1;
                                        if($k > 2 && $k <= 6)
                                        {
                                            
                                            $img =  $this->crud_model->size_img($v['img'],500,500);
                                            ?>
                                            <a href="#img<?= $k ?>">
                                      <img src="<?= $img ?>" class="galimg thumb" index="<?= $k ?>" onclick="selImg(<?= $k ?>)" ondblclick="opengal('0')" />
                                    </a>        
                                    <!-- first image box webdevtrick.com -->
                                    
                                            <?php
                                        }
                                        elseif($k > 6)
                                        {
                                            $img =  $this->crud_model->size_img($v['img'],500,500);
                                            ?>
                                            <input type="hidden" class="galimg" src="<?= $img ?>" index="<?= $k; ?>"  />
                                            <?php
                                        }
                                    }
                                    ?>
                                    

                                    </div>

                                    <!-- popup -->
                                    <div class="lightbox" id="popup_lightbox">
                                      <a onclick="gopre(1)" class="light-btn btn-prev"><i class="fa fa-angle-left"></i></a>
                                      <a   class="btn-close"><i class="fa fa-close"></i></a>
                                      <img src="<?= $first ?>" id="glarge" style="opacity:1;" cur= "0">
                                      <a href="" onclick="gonext(1)" class="light-btn btn-next"><i class="fa fa-angle-right"></i></a>
                                    </div>
                                </div>
                            </div>


                            <div class="gallerybox" style="display: none;">
                            <div class="row">
                             <div class="col-sm-8 left_box">
                                    <div class="bigbox_gallery inner_gallery">
                                        <img src="<?= $first; ?>" alt="">
                                        <div class="overlay_box">
                                            <!--<h4>Marketing Strategy</h4>-->
                                            <!--<h2>Digital Agency Template</h2>-->
                                            <!--<p>-->
                                            <!--    <img src="<?= base_url(); ?>template/front/images/girl.png" alt=""> -->
                                            <!--    <span class="name_avatar">Tamim Islam</span> -->
                                            <!--    <span class="star_box">-->
                                            <!--        <img src="<?= base_url(); ?>template/front/images/Star.png">-->
                                            <!--        <img src="<?= base_url(); ?>template/front/images/Star.png">-->
                                            <!--        <img src="<?= base_url(); ?>template/front/images/Star.png">-->
                                            <!--        <img src="<?= base_url(); ?>template/front/images/Star.png">-->
                                            <!--        <img src="<?= base_url(); ?>template/front/images/Star.png">-->
                                            <!--    </span>-->
                                            <!--</p>-->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4 right_box">
                                    <div class="small_box_gallery inner_gallery">
                                        <img src="<?= $scd; ?>" alt="">
                                        <div class="overlay_box">
                                            <!--<h4>Marketing Strategy 2nd</h4>-->
                                            <!--<h2>Digital Agency Template</h2>-->
                                            <!--<p>-->
                                            <!--    <img src="<?= base_url(); ?>template/front/images/girl.png" alt=""> -->
                                            <!--    <span class="name_avatar">Tamim Islam</span> -->
                                            <!--    <span class="star_box">-->
                                            <!--        <img src="<?= base_url(); ?>template/front/images/Star.png">-->
                                            <!--        <img src="<?= base_url(); ?>template/front/images/Star.png">-->
                                            <!--        <img src="<?= base_url(); ?>template/front/images/Star.png">-->
                                            <!--        <img src="<?= base_url(); ?>template/front/images/Star.png">-->
                                            <!--        <img src="<?= base_url(); ?>template/front/images/Star.png">-->
                                            <!--    </span>-->
                                            <!--</p>-->
                                        </div>
                                    </div>
                                    <div class="small_box_gallery inner_gallery">
                                        <img src="<?= $thrd; ?>" alt="">
                                        <div class="overlay_box">
                                            <!--<h4>Marketing Strategy 3rd</h4>-->
                                            <!--<h2>Digital Agency Template</h2>-->
                                            <!--<p>-->
                                            <!--    <img src="<?= base_url(); ?>template/front/images/girl.png" alt=""> -->
                                            <!--    <span class="name_avatar">Tamim Islam</span> -->
                                            <!--    <span class="star_box">-->
                                            <!--        <img src="<?= base_url(); ?>template/front/images/Star.png">-->
                                            <!--        <img src="<?= base_url(); ?>template/front/images/Star.png">-->
                                            <!--        <img src="<?= base_url(); ?>template/front/images/Star.png">-->
                                            <!--        <img src="<?= base_url(); ?>template/front/images/Star.png">-->
                                            <!--        <img src="<?= base_url(); ?>template/front/images/Star.png">-->
                                            <!--    </span>-->
                                            <!--</p>-->
                                        </div>
                                    </div>
                                </div>
                        </div>
                        
                        <div class="row">
                            <?php
                            $i = 0;
                    foreach ($imgs as $key => $value) {
                        $i++;
                        $img = $this->crud_model->size_img($value['img'],500,500);
                        if($key > 2)
                        {
                        ?>
                            <div class="col-sm-4 right_box">
                                    <div class="small_box_gallery inner_gallery">
                                        <img src="<?= $img; ?>" alt="">
                                        <div class="overlay_box"></div>
                                    </div>
                                    
                                </div>
                                <?php
                    }
                    }
                                ?>
                        </div>
                        </div>
                        </div>
                        <?php
                        }
                        ?>
                        




<?php
                        if(true)
                        {
                            $feature  = json_decode($pro['text'],true);
                            ?>
                        <div class="container">
                            <div class="verify_head" style="    padding: 10px 42px;">
                                         <h3 ng-click="detail.gtitle_edit = 1" ng-if="!detail.gtitle_edit">{{detail.gtitle}}</h3>
                                    <form ng-if="detail.gtitle_edit" class="sub_form" style="position: relative;">
                                        <input type="text" class="form-control"  ng-model="detail.gtitle" />
                                        <button  type="button" class="btn btn-primary" ng-click="detail.gtitle_edit = 0">Save</button>
                                    </form>
                                    <p ng-click="detail.gdesc_edit = 1" ng-if="!detail.gdesc_edit">{{detail.gdesc}}</p>
                                    <form ng-if="detail.gdesc_edit" class="sub_form" style="position: relative;">
                                        <input type="text" class="form-control"  ng-model="detail.gdesc" />
                                        <button  type="button" class="btn btn-primary" ng-click="detail.gdesc_edit = 0">Save</button>
                                    </form>
                        </div>

                        <div class="inner_content_tabs">
                                <label>Number of Tabs</label>
                        {{detail.number_of_tabs}}
                        <select ng-model="detail.number_of_tabs" ng-change="update_tab()">
                            <option value="1">1</option>
                            <option  value="2">2</option>
                            <option  value="3">3</option>
                            <option  value="4">4</option>
                            <option  value="5">5</option>
                            <option  value="6">6</option>
                            <option  value="7">7</option>
                        </select>
                         <div class="row" id="left_gp">
                         <ul class="tabs__" ng-repeat="x in detail.etra_tab" ng-if="($index+1) <= detail.number_of_tab" ng-style="extra_tab()">
                                    <button class="btn btn-info" ng-click="update_edit_tab($index);">Edit it</button>
                                <div class="inner_box_design height_auto scroll" style="overflow-y: scroll;height:324px;min-height: 324px;max-height: 324px;" ng-bind-html="x" ng-if="edit_col != ($index+1)">
                                </div>
                                <dform ng-if="edit_col == ($index+1)">
                                    <textarea style="width:100%; height:500px" id="new{{$index}}">{{x}}</textarea>
                                    <button ng-click="update_edit_tab(-1, $index)">Save</button>
                                </form>
                            </div>
                             <div class="row" id="left_gp">
                            <ul class="tabs__ new_tab">
                                <?php
                                $count = count($feature);
                                // echo $count;
                                if($feature && $count == '1' )
                                {
                                    $i = 0;
                                    foreach($feature as $k=> $value)
                                    {
                                        // var_dump($value);
                                        $i++;
                                        $tab = 'tab-'.$i.'__';
                                    ?>
                                    <li class="tab-link__ <?= ($i == 1)?"current__":""; ?>" data-tab="<?= $tab ?>"  style="width:100%;"><b><i class="fa-solid <?=$value['ficon'] ?>"></i></b> <p><?=$value['fhead'] ?></p></li>
                                    <?php
                                    }
                                }  elseif($feature && $count == '2' )
                                {
                                    $i = 0;
                                    foreach($feature as $k=> $value)
                                    {
                                        // var_dump($value);
                                        $i++;
                                        $tab = 'tab-'.$i.'__';
                                    ?>
                                    <li class="tab-link__ <?= ($i == 1)?"current__":""; ?>" data-tab="<?= $tab ?>"  style="width:47%;"><b><i class="fa-solid <?=$value['ficon'] ?>"></i></b> <p><?=$value['fhead'] ?></p></li>
                                    <?php
                                    }
                                } elseif($feature && $count == '3' )
                                {
                                    $i = 0;
                                    foreach($feature as $k=> $value)
                                    {
                                        // var_dump($value);
                                        $i++;
                                        $tab = 'tab-'.$i.'__';
                                    ?>
                                    <li class="tab-link__ <?= ($i == 1)?"current__":""; ?>" data-tab="<?= $tab ?>"  style="width:31%;"><b><i class="fa-solid <?=$value['ficon'] ?>"></i></b> <p><?=$value['fhead'] ?></p></li>
                                    <?php
                                    }
                                }elseif($feature && $count == '4' )
                                {
                                    $i = 0;
                                    foreach($feature as $k=> $value)
                                    {
                                        // var_dump($value);
                                        $i++;
                                        $tab = 'tab-'.$i.'__';
                                    ?>
                                    <li class="tab-link__ <?= ($i == 1)?"current__":""; ?>" data-tab="<?= $tab ?>"  style="width:23%;"><b><i class="fa-solid <?=$value['ficon'] ?>"></i></b> <p><?=$value['fhead'] ?></p></li>
                                    <?php
                                    }
                                }elseif($feature && $count == '5' )
                                {
                                    $i = 0;
                                    foreach($feature as $k=> $value)
                                    {
                                        // var_dump($value);
                                        $i++;
                                        $tab = 'tab-'.$i.'__';
                                    ?>
                                    <li class="tab-link__ <?= ($i == 1)?"current__":""; ?>" data-tab="<?= $tab ?>"  style="width:18%;"><b><i class="fa-solid <?=$value['ficon'] ?>"></i></b> <p><?=$value['fhead'] ?></p></li>
                                    <?php
                                    }
                                }elseif($feature && $count == '6' )
                                {
                                    $i = 0;
                                    foreach($feature as $k=> $value)
                                    {
                                        // var_dump($value);
                                        $i++;
                                        $tab = 'tab-'.$i.'__';
                                    ?>
                                    <li class="tab-link__ <?= ($i == 1)?"current__":""; ?>" data-tab="<?= $tab ?>"  style="width:14%;"><b><i class="fa-solid <?=$value['ficon'] ?>"></i></b> <p><?=$value['fhead'] ?></p></li>
                                    <?php
                                    }
                                }elseif($feature && $count == '7' )
                                {
                                    $i = 0;
                                    foreach($feature as $k=> $value)
                                    {
                                        // var_dump($value);
                                        $i++;
                                        $tab = 'tab-'.$i.'__';
                                    ?>
                                    <li class="tab-link__ <?= ($i == 1)?"current__":""; ?>" data-tab="<?= $tab ?>"><b><i class="fa-solid <?=$value['ficon'] ?>"></i></b> <p><?=$value['fhead'] ?></p></li>
                                    <?php
                                    }
                                }
                                ?>
                                
                            </ul>
                            <?php
                                if($feature)
                                {
                                    $i = 0;
                                    foreach($feature as $k=> $value)
                                    {
                                        $i++;
                                        $tab = 'tab-'.$i.'__';
                                    ?>
                            <div id="<?= $tab ?>" class="tab-content__ <?= ($i == 1)?"current__":""; ?>">
                                <?php
                                if(!$value['url']){
                                    ?>
                                    <div class="row" id="advertise_info" style="padding-top:16px;">
                    
                                 <div class="col-sm-12 communitybox " id="community">
                                     <h3> <?= $value['phead'] ?></h3>
                                     <div class="desc">
                                       <p> <?= $value['fdet'] ?></p>
                                     </div>
                                    </div>
                                   </div>
                                    <?php
                                }else{
                                ?>
                <div class="row" id="advertise_info" style="padding-top:16px;">
                    <div class="col-sm-4 business_graphic" id="leftboxx">
                     <img src=" <?= $value['url'] ?>" alt="">
                    </div>
                 <div class="col-sm-8 communitybox" id="equal_btnw">
                     <h3> <?= $value['phead'] ?></h3>
                     <div class="desc">
                       <p> <?= $value['fdet'] ?></p>
                     </div>
                    </div>
                </div>
                <?php
                                }
                ?>
                              
                            </div>
                              <?php
                                    }
                                }
                                ?>

                        </div>
                        </div>
                        <?php
                        }
                        ?>
        <?php
        }
        ?>
    </div>

        <!--about-->
        <?php
                        if(true)
                        {
                            ?>
    <div class="container">
        <div class="verify_head" style="    padding: 10px 37px;">
                <h3 ng-click="detail.about_title_edit = 1" ng-if="!detail.about_title_edit">{{detail.about_title}}</h3>
                                    <form ng-if="detail.about_title_edit" class="sub_form" style="position: relative;">
                                        <input type="text" class="form-control" ng-model="detail.about_title" />
                                        <button  type="button" class="btn btn-primary" ng-click="detail.about_title_edit = 0">Save</button>
                                    </form>
        </div>
        <div class="row">
            <?php
            if(trim($pro['about_desc']))
            {  // var_dump($pro['about_desc']);
                ?>
            <div class="col-sm-8 left_9bx">
                <div class="shadow_9" id="__space">
                   <!--<>{{detail.about_desc}}</>-->
                    <div style="padding-bottom:10px;" ng-click="detail.about_desc_edit = 1" ng-if="!detail.about_desc_edit">{{detail.about_desc}}</div>
                                    <form ng-if="detail.about_desc_edit" class="sub_form" style="position: relative;">
                                        <input type="text" class="form-control" ng-model="detail.about_desc" />
                                        <button  type="button" class="btn btn-primary" ng-click="detail.about_desc_edit = 0">Save</button>
                                    </form>
                   <div class="row">
                   <div class="col-sm-6">
                   <p><b>Categories</b></p>
                   <div class="row">
                   <?php
                   $categories =  $pro['cats']; 
                   $cat = explode(",",$categories);
                //   var_dump($cat);
                   foreach($cat as $k =>$v){
                   ?>
                       <!--<div class="equal"><?php // $v; ?></div>-->
                       <div class="col-sm-6">
                   <ul>
                    <li ><i class="fa fa-circle"></i><?= $v; ?></li>
                    </ul>
                    </div>
                    <?php
                   }?>
                   </div>
                   </div>
                   <div class="col-sm-6">
                   <?php
                    if(isset($pro['amen_check']) && $pro['amen_check'] == 'yes'){
                        $amen = $pro['amenities']; 
                    $amenities = explode(',',$amen);
                     ?>
                     <p><b>Ameneties</b></p>
                     <div class="row">
                     <?php
                    foreach($amenities as $k => $v){
                    ?>
                     
                    <!--<div class="equal"><?php // $v; ?></div>-->
                    <div class="col-sm-6">
                     <ul>
                    <li><i class="fa fa-circle"></i><?= $v; ?></li>
                    </ul>
                    </div>
                    <?php
                    }
                    }
                    ?>
                    </div>
                    </div>
                    </div>
                 <!--nimra code-->
                    <div class="learn_more_btns" style="text-align: center;">
                    <?php 
                    $user = $this->session->userdata('user_id');
                    if($pro['is_affiliate'] = '1' && $user)
                    {
                        $vid = 0;
                        $added_by = json_decode($pro['added_by'], true);
                        if(isset($added_by['type']) && $added_by['type'] == 'vendor')
                        {
                            $vid = $added_by['id'];
                        }
                        
                        $wish = $this->crud_model->is_aff($pro['id']); 
                    ?>
                    <button class="btn btn-add-to <?php if($wish == 'yes'){ echo 'wished';} else{ echo 'wishlist';} ?>" onclick="to_affliate(<?php echo $vid; ?>,event)" style="background: #f26922;color: #fff;">
                        <i class="fa fa-heart"></i>
                        <span class="hidden-sm hidden-xs">
							<?php if($wish == 'yes'){ 
                                echo translate('_added_to_affliate'); 
                                } else { 
                                echo translate('_add_to_affliate');
                                } 
                            ?>
                        
                        </span>
                    </button>
                    <?php
                    }
                    ?>
        
                </div>
                 <!--nimra code-->
                    <!--<div class="learn_more_btns" style="text-align: center;">-->
                    <!--    <a href="#" class="our_projects" style="">Add to Affiliates</a>-->
                    <!--</div>-->
                    <!--<h4>Company Introduction</h4>-->
                    <!--<p>Hire our experienced team of programmers, digital designers, and marketing professionals, who know how to deliver results. With your requirements, we will help you identify your needs to reach solutions</p>-->
                </div>
            </div>
            <?php
                        }
            if(trim($pro['about_address']))
            {
                ?>
            <div class="col-sm-4 left_9bx" id="right___gap">
                <div class="shadow_9 icons_links" id="bg__social">
                    
                   <?php if(isset($pro['about_address']) && !empty($pro['about_address'])){ 
                   ?>
                   <div ng-click="detail.about_address_edit = 1" ng-if="!detail.about_address_edit" class="margin-bottom">
                       <i class="fa fa-map-marker"></i> {{detail.about_address}}</div>
                        <form ng-if="detail.about_address_edit" class="sub_form" style="    position: relative;">
                            <input type="text" class="form-control" ng-model="detail.about_address" />
                            <button ng-click="detail.about_address_edit = 0"  type="button" class="btn btn-primary">Save</button>
                        </form>
                        
                   <?php
                       }if(isset($pro['bussniuss_phone']) && !empty($pro['bussniuss_phone'])){
                       
                   ?>
                   <!--<div class="margin-bottom"><i class="fa fa-phone"></i>{{detail.bussniuss_phone}}</div>-->
                    <div ng-click="detail.bussniuss_phone_edit = 1" ng-if="!detail.bussniuss_phone_edit" class="margin-bottom">
                       <i class="fa fa-phone"></i> {{detail.bussniuss_phone}}</div>
                        <form ng-if="detail.bussniuss_phone_edit" class="sub_form" style="    position: relative;">
                            <input type="text" class="form-control" ng-model="detail.bussniuss_phone" />
                            <button ng-click="detail.bussniuss_phone_edit = 0"  type="button" class="btn btn-primary">Save</button>
                        </form>
                   <?php
                       }if(isset($pro['whatsapp_number']) && !empty($pro['whatsapp_number'])){

                   ?>
                    <div ng-click="detail.whatsapp_number_edit = 1" ng-if="!detail.whatsapp_number_edit" class="margin-bottom">
                       <i class="fa fa-whatsapp"></i> {{detail.whatsapp_number}}</div>
                        <form ng-if="detail.whatsapp_number_edit" class="sub_form" style="    position: relative;">
                            <input type="text" class="form-control" ng-model="detail.whatsapp_number" />
                            <button ng-click="detail.whatsapp_number_edit = 0"  type="button" class="btn btn-primary">Save</button>
                        </form>
                    <?php
                       }if(isset($pro['bussniuss_email']) && !empty($pro['bussniuss_email'])){

                   ?>
                   <div ng-click="detail.bussniuss_email_edit = 1" ng-if="!detail.bussniuss_email_edit" class="margin-bottom">
                       <i class="fa fa-envelope"></i>  {{detail.bussniuss_email}}</div>
                        <form ng-if="detail.bussniuss_email_edit" class="sub_form" style="    position: relative;">
                            <input type="text" class="form-control" ng-model="detail.bussniuss_email" />
                            <button ng-click="detail.bussniuss_email_edit = 0"  type="button" class="btn btn-primary">Save</button>
                        </form>
                   <?php
                       }if(isset($pro['openig_time']) && !empty($pro['openig_time'])){

                   ?>
                    
                   <div  class="margin-bottom"><?= date("h:ia", strtotime( $pro['openig_time'])) .'-'.date("h:ia", strtotime( $pro['closing_time'])) ;?></div>
                      <?php
                       }
                      ?>
                      <div class="" style="margin-top: 10px;">
                    <?php
           $img='';
           $social_image = json_decode($pro['social_media']);
                foreach($social_image as $k =>$v){
                    // var_dump($k);
                    $row = $this->db->where('id', $k)->get('bpkg')->row();
                    if($row->img){
                    $img = $this->crud_model->get_img($row->img)->secure_url;
                                 } 
                                 if($v)
                                 {
                ?>
                <a href="<?= $v; ?>" target="_blank"><img style="width:25px;background: #fff; padding: 3px;margin-top: 10px;border-radius: 0px;" src="<?= $img; ?>"></a>
                <?php
                                 }
               }
                ?>
                </div>
                    <!--<h4>Address</h4>-->
                    <!--<p>Hire our experienced team of programmers, digital designers, and marketing professionals</p>-->
                </div>
            </div>
            <?php
            }
            ?>
        </div>
    </div>
<?php
                        }
                            ?>

       <!--<div class="container">-->
       <!--         <div class="inner_box_info" style="    padding: 10px 16px;">-->
       <!--         <h2>Tags</h2>-->
       <!--         <p>You can now list your</p>-->
       <!--     </div>-->

       <!--</div>-->
     
            <!-- <div class="tags_box">
                <ul>
                    <?php
                    $tags = $pro['tag'];
                    $x = (explode(",",$tags));
                    foreach($x as $K => $v){
                    ?>
                    <li><a href="#"><img src="#" alt=""> <?=  $v;?></a></li>
                    <?php
                    }
                    
                    ?>
                   </ul>
            </div> -->
                         <div class="container">
                            <div class="mixcher_orange">
                                <div class="shape_doted_mix">
                                    <img src="<?= base_url(); ?>template/front/images/mixcher-orange.png" alt="">
                                </div>
                                <h4 ng-click="detail.info_head_edit = 1" ng-if="!detail.info_head_edit">{{detail.info_head}}</h4>
                                    <form ng-if="detail.info_head_edit" class="sub_form" style="    position: relative;">
                                        <input type="text" class="form-control" ng-model="detail.info_head" />
                                        <button ng-click="detail.info_head_edit = 0"  type="button" class="btn btn-primary">Save</button>
                                    </form>
                                    <p ng-click="detail.info_desc_edit = 1" ng-if="!detail.info_desc_edit">{{detail.info_desc}}</p>
                                    <form ng-if="detail.info_desc_edit" class="sub_form" style="    position: relative;">
                                        <textarea name="ckeditor" ng-model="detail.info_desc" class="form-control" style="width:100%;"></textarea>
                                        <button ng-click="detail.info_desc_edit = 0"  type="button" class="btn btn-primary">Save</button>
                                    </form>
                             <!--<p>{{detail.info_desc}}</p>-->
                                <?php
                                if(isset($pro['info_button']) && !empty($pro['info_button']) && isset($pro['button_url']) &&!empty($pro['button_url'])){
                                ?>
                                <!--<a href="#">{{detail.info_button}}</a>-->
                                      <a href="{{detail.button_url}}" ng-click="detail.info_button_edit = 1" ng-if="!detail.info_button_edit">{{detail.info_button}}</a>
                                    <form ng-if="detail.info_button_edit" class="sub_form" style="    position: relative;">
                                        <input type="text" class="form-control" ng-model="detail.info_button" />
                                        <input type="text" class="form-control" ng-model="detail.button_url" />
                                        <button ng-click="detail.info_button_edit = 0"  type="button" class="btn btn-primary">Save</button>
                                    </form>
                                <?php
                                }
                                ?>
                            </div>
                            <!--{{detail.button_url}}-->
                        </div>
                        <div class="orange_pathwrap" id="bpage_form">
                            <div class="container">
                                <div class="iframe_box">
                                <div id="googleMap" style="width:100%;height:550px;"></div>


                                    <div class="getin_touch">
                                        <h3>Get In Touch <img src="<?= base_url(); ?>template/front/images/orange-phone.png" alt=""></h3>
                                        <form action="" method="">
                                            <div class="row">
                                                <div class="col-sm-6 form_gapp">
                                                    <div class="form_box">
                                                        <label for="First name">First name</label>
                                                        <input type="text" placeholder="Tamim" name="">
                                                        <img src="<?= base_url(); ?>template/front/images/user-icon.png" alt="">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 form_gapp">
                                                    <div class="form_box">
                                                        <label for="Last name">Last name</label>
                                                        <input type="text" placeholder="Islam" name="">
                                                        <img src="<?= base_url(); ?>template/front/images/user-icon.png" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12 form_gapp">
                                                    <div class="form_box">
                                                        <label for="Email">Email</label>
                                                        <input type="email" placeholder="Email" name="">
                                                        <img src="<?= base_url(); ?>template/front/images/email.png" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12 form_gapp">
                                                    <div class="form_box">
                                                        <label for="Phone number">Phone number</label>
                                                        <input type="number" placeholder="Type phone number" name="">
                                                        <img src="<?= base_url(); ?>template/front/images/email.png" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12 form_gapp">
                                                    <div class="form_box">
                                                        <label for="Message">Message</label>
                                                        <textarea placeholder="Type Message"></textarea>
                                                        <img src="<?= base_url(); ?>template/front/images/email.png" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12 form_gapp">
                                                    <div class="form_box">
                                                        <button type="submit">Send</button>
                                                        <button type="submit">GET DIRECTION</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

           
                        <div class="purple_line" id="intrested">
                            <img src="<?= base_url(); ?>template/front/images/base-icon.png" alt="">
                        </div>
                     
                        <div class="container" style="padding-top: 165px ;">
                            <div class="container">
                            <div class="verify_head" style="    padding: 0 23px 0;">
                                <h3>You May Also be Interested In</h3>
                                <p>You can now list your business in less than 5 minutes</p>
                            </div>
                        </div>
                                    <div class="row" id="rowmarign">
            <?php
                        $box_style =6;//  $this->db->get_where('ui_settings',array('ui_settings_id' => 29))->row()->value;
                        $limit = 3;// $this->db->get_where('ui_settings',array('ui_settings_id' => 20))->row()->value;
                        $featured=$this->crud_model->product_list_set('featured',$limit);
                        foreach($featured as $row){
                            echo $this->html_model->product_box($row, 'grid', $box_style);
                        }
                    ?>
            </div>

                            <!--<div class="row">-->
                            <!--    <div class="col-sm-4 bottom_box">-->
                            <!--        <div class="inner_bottombox">-->
                            <!--            <img src="<?= base_url(); ?>template/front/images/img-2.png" alt="">-->
                            <!--            <div class="sidegapp_bottom">-->
                            <!--                <h5>Jan 21, 2019      45 Comments       10 Share</h5>-->
                            <!--                <h3>Shrimp and Avocado Salad with Miso Dressing</h3>-->
                            <!--                <p>This Shrimp and Avocado Salad is topped with spicy shrimp, crisp cucumbers, spinach, creamy avocado, and a generous drizzle of miso dressing. The happiest green salad ever!</p>-->
                            <!--                <a href="#">Read more <img src="<?= base_url(); ?>template/front/images/arrow-right1.png" alt=""></a>-->
                            <!--            </div>-->
                            <!--        </div>-->
                            <!--    </div>-->
                            <!--    <div class="col-sm-4 bottom_box">-->
                            <!--        <div class="inner_bottombox">-->
                            <!--            <img src="<?= base_url(); ?>template/front/images/img-2.png" alt="">-->
                            <!--            <div class="sidegapp_bottom">-->
                            <!--                <h5>Jan 21, 2019      45 Comments       10 Share</h5>-->
                            <!--                <h3>Shrimp and Avocado Salad with Miso Dressing</h3>-->
                            <!--                <p>This Shrimp and Avocado Salad is topped with spicy shrimp, crisp cucumbers, spinach, creamy avocado, and a generous drizzle of miso dressing. The happiest green salad ever!</p>-->
                            <!--                <a href="#">Read more <img src="<?= base_url(); ?>template/front/images/arrow-right1.png" alt=""></a>-->
                            <!--            </div>-->
                            <!--        </div>-->
                            <!--    </div>-->
                            <!--    <div class="col-sm-4 bottom_box">-->
                            <!--        <div class="inner_bottombox">-->
                            <!--            <img src="<?= base_url(); ?>template/front/images/img-3.png" alt="">-->
                            <!--            <div class="sidegapp_bottom">-->
                            <!--                <h5>Jan 21, 2019      45 Comments       10 Share</h5>-->
                            <!--                <h3>Shrimp and Avocado Salad with Miso Dressing</h3>-->
                            <!--                <p>This Shrimp and Avocado Salad is topped with spicy shrimp, crisp cucumbers, spinach, creamy avocado, and a generous drizzle of miso dressing. The happiest green salad ever!</p>-->
                            <!--                <a href="#">Read more <img src="<?= base_url(); ?>template/front/images/arrow-right1.png" alt=""></a>-->
                            <!--            </div>-->
                            <!--        </div>-->
                            <!--    </div>-->
                            <!--</div>-->
                            <div class="info_tooltip">
                                <a href="#"><img src="<?= base_url(); ?>template/front/images/info-orange.png" alt=""></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="tab_2" class="tab-content__box">
                    <div class="container">
                        <?php
                                foreach($pros as $sing)
                                {
                                
                                if ($sing['is_event'] == 1)
                                  {
                                      echo $this->html_model->product_box($sing, 'grid', 6);
                                  }
                                }
                                  ?>
                       
                    </div>
                </div>
                <div id="tab_3" class="tab-content__box <?= isset($pro['default_tab']) && $pro['default_tab'] == 'tab_3' ?"current":""; ?>">
                                        <div class="container">
                            <div class="row">
                                <?php
                                $blog = $this->db->where('added_by',$pro['added_by'])->get('blog')->result_array();
                                // var_dump($blog);
                                foreach($blog as $k => $v){
                                ?>
                                <div class="col-sm-3 bottom_box">
                                    <div class="inner_bottombox">
                                        <a href="<?= base_url('home/blog_view/'.$v['blog_id']);?>" target="_blank"><img src="<?php echo $this->crud_model->file_view('blog',$v['blog_id'],'','','thumb','src','',''); ?>" alt=""></a>
                                        <div class="sidegapp_bottom">
                                            <h5><?= $v['date'];?></h5>
                                            <h3><?= $v['title'];?></h3>
                                            <p><b><?= substr(strip_tags($v['summery']),0, 200);?>  .....</b></p>
                                            <a href="<?= base_url('home/blog_view/'.$v['blog_id']);?>" target="_blank">Read more <img src="<?= base_url(); ?>template/front/images/arrow-right1.png" alt=""></a>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="info_tooltip">
                                <a href="#"><img src="<?= base_url(); ?>template/front/images/info-orange.png" alt=""></a>
                            </div>
                        </div>

                    
                </div>
                <div id="tab_4" class="tab-content__box">
                    <div class="container">
                       <div class="row">
                               <?php
                                foreach($pros as $sing)
                                {
                                    
                                $cats = explode(',', $sing['category']);
                                if (in_array(78, $cats) && $sing['is_bpage'] == 0)
                                  {
                                      ?>
                                
                    
                                <?php
                                      echo $this->html_model->product_box($sing, 'grid', 1);
                                      ?>
                             <?php
                                  }
                                  
                             }
                                  ?>
                       </div>
                       
                    </div>
                    
                </div>
                <div id="tab_5" class="tab-content__box">
                    <div class="container">
                       <div class="row">
                               <?php
                                foreach($pros as $sing)
                                {
                                    
                                if ( $sing['is_bpage'] == 0 && $sing['is_blog'] == 0 && $sing['is_event'] == 0 && $sing['is_job'] == 0)
                                  {
                                      ?>
                                
                    
                                <?php
                                      echo $this->html_model->product_box($sing, 'grid', 1);
                                      ?>
                             <?php
                                  }
                                  
                             }
                                  ?>
                       </div>
                       
                    </div>
                </div>
                <div id="tab_6" class="tab-content__box">
                    <div class="container">
                    <div class="clients_box">
                        <h3>Take a look what our client Says</h3>
                        <h4>Reviews</h4>
                        
                    </div>
                    <div class="col-sm-8 left__review">
                        <div class="row">
                        <?php
                        // var_dump($pro);
                        $rating = $this->db->where('product_id', $pro['product_id'])->get('user_rating')->result_array();
                        foreach($rating as $k=> $v){
                        ?>
                        <div class="col-sm-4 cilent_gapp">
                            <div class="info_client">
                                <?php
                                
                                $user_id = $v['user_id'];
                                $users = $this->db->where('user_id', $user_id)->get('user')->row();
                                // var_dump($users);
                                ?>
                                <img src="
                                <?php 
                                    // $user_id = $v['user_id'];
                                    if(file_exists('uploads/user_image/user_'.$user_id.'.jpg')){ 
                                        
                                        echo $this->crud_model->file_view('user',$user_id,'100','100','no','src','','','.jpg').'?t='.time();
                                    } else if(empty($row['fb_id']) !== true){ 
                                        echo 'https://graph.facebook.com/'. $row['fb_id'] .'/picture?type=large';
                                    } else if(empty($row['g_id']) !== true ){
                                        echo $row['g_photo'];
                                    } else {
                                        echo base_url().'uploads/user_image/default.jpg';
                                    } 
                                ?>
                                " alt="">
                                <h4><?= $users->username?></h4>
                                <p>“<?= $v['comment'];?>”</p>
                                <div class="rating">
                                    <?php
                                    for($i =1; $i<=5;$i++)
                                    {
                                        if($i<= $v['rating'])
                                        {
                                            ?>
                                            <i class="fa fa-star"></i>
                                            <?php
                                        }
                                        else
                                        {
                                            ?>
                                            <i class="fa fa-star gray"></i>
                                            <?php
                                        }
                                    }
                                    ?>
                                <span><?= $v['rating'];?></span>
                                </div>
                            </div>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                    </div>
                    <div class="col-sm-4 add__new_review" id="review_coment">
                        <label> add new reviews</label>
                        <form class="" action="<?= base_url('home/add_rate') ?>" id="rform" >
                     <div class=" border-color--default__09f24__NPAKY">
                        <div class=" css-14s1wf padding-t3__09f24__TMrIW padding-r3__09f24__eaF7p padding-b3__09f24__S8R2d padding-l3__09f24__IOjKY border-color--default__09f24__NPAKY" role="presentation">
                           <div class=" css-10687n6 margin-b3__09f24__l9v5d border-color--default__09f24__NPAKY" gap="1">
                              <div class=" css-1r871ch border-color--default__09f24__NPAKY">
                                 <fieldset class=" rating-selector__09f24__LNhhs">
                                    <div id="rateYo"></div>
                                    <input type="hidden" value="0" name="rating" id="rate" />
                                    <input type="hidden" value="<?= $pro['product_id'] ?>" name="pid" id="pid" />
                                    <div class=" description__09f24__qRKe3 border-color--default__09f24__NPAKY" aria-hidden="true">
                                       <p class="description-text--non-zero__09f24__Ln52s css-qgunke"></p>
                                    </div>
                                 </fieldset>
                              </div>
                              <div class=" css-aurft1 border-color--default__09f24__NPAKY nowrap__09f24__lBkC2"></div>
                           </div>
                           <div class=" css-1bqnmih border-color--default__09f24__NPAKY">
                              <!-- <div class="css-1sdb4og" contenteditable="true" spellcheck="true" data-lexical-editor="true" style="user-select: text; white-space: pre-wrap; word-break: break-word;" role="textbox">
                                 <p><br></p>
                              </div> -->
                              <textarea name="comment" class="summernote" placeholder="Add comment here"></textarea>
                           </div>
                           <div class=" css-c7yo1x margin-t3__09f24__riq4X border-color--default__09f24__NPAKY background-color--white__09f24__ulvSM"></div>
                        </div>
                     </div>
                     <?php
                        $user = $this->session->userdata('user_id');
                        if($user){
                     ?>
                     <div class=" margin-t4__09f24__G0VVf padding-b6__09f24__hfdiP border-color--default__09f24__NPAKY" style="max-width:200px"><button type="button"  id="rate_form" class=" css-hv9ohz" data-activated="false" data-testid="post-button" value="submit" data-button="true"><span class="css-1enow5j" data-font-weight="semibold">Post Review</span></button></div>
                    <?php
                    }else{
                    ?>
                   <div class=" margin-t4__09f24__G0VVf padding-b6__09f24__hfdiP border-color--default__09f24__NPAKY" style="max-width:200px"><a href="<?= base_url('/login_set/login'); ?>"><button type="button"  id="rate_form" class=" css-hv9ohz" data-activated="false" data-testid="post-button" value="submit" data-button="true"><span class="css-1enow5j" data-font-weight="semibold">Post Review</span></button></a></div>

                    <?php
                    }
                    ?>
                  </form>
                    </div>
                </div>
                    
                </div>

<div class="overlaypopup"></div>
<div class="popup_box">
   
    <div class="innerbox">
        <div class="logo1">
            <h3>We'd Love to Hear From You</h3>
            <p>An individual wanting to get in touch or a home based business or large enterprise we welcome all!</p>
        </div>
        <form class="formbox">
            
            <div class="row">
                <div class="col-sm-12 sidegapp">
                    <div class="forminput">
                        <label>Name</label>
                        <input type="text" name="full_name">
                    </div>
                </div>
                <div class="col-sm-12 sidegapp">
                    <div class="forminput">
                        <label>Email</label>
                        <input type="email" name="email">
                    </div>
                </div>
                <div class="col-sm-12 sidegapp">
                    <div class="forminput">
                        <label>Message</label>
                        <textarea name="msg"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 sidegapp">
                    <div class="forminput ">
                           <button type="submit">Submit</button>
                           <button type="button" class="close_btn">Close</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

    <div class="container">
        
        <div class="disqus_comment" >
                                <div id="disqus_thread"></div></div>
    </div>
    <div class="flgicon">
    <a href="#"><i class="fa fa-flag"></i></a>
</div>
</div><!--data div end-->
<script>
function openNav() {
  document.getElementById("customize_div").style.width = "100%";
  document.getElementById("data_div").style.marginLeft = "250px";
      $('#customize_div').show();
      $('.openbtn').hide();
}

function closeNav() {
  document.getElementById("customize_div").style.width = "0";
  document.getElementById("data_div").style.marginLeft= "0";
$('#customize_div').hide();
$('.openbtn').show();
}
</script>
    <script>
    </script>
    <script>
        /**
        *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
        *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables    */
        /*
        var disqus_config = function () {
        this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
        this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
        };
        */
        (function() { // DON'T EDIT BELOW THIS LINE
        var d = document, s = d.createElement('script');
        s.src = 'https://coummityhyubland.disqus.com/embed.js';
        s.setAttribute('data-timestamp', +new Date());
        (d.head || d.body).appendChild(s);
        })();
    </script>
    <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
                            </div>
    <script type="text/javascript">
        $(document).ready(function(){
        
        $('ul.tabss li').click(function(){
            var tab_id = $(this).attr('data-tab');

            $('ul.tabss li').removeClass('current');
            $('.tab-content').removeClass('current');

            $(this).addClass('current');
            $("#"+tab_id).addClass('current');
        })

    })

    $(".right_box .locationbox h4").click(function(){
        $(".clock_time").toggle();
    });

    </script>
    <!--slider-->
    <script>
    function find_pre(cur)
    {
        cur = parseInt(cur);
        cur = cur -1;
    //      var is_find = 0;
    //      var ocur = cur
    //     $('.galimg').each(function(i, obj) {
    //         var num = parseInt($(this).attr('index'));
    //         console.log(num+' test '+cur);
    // if(num < cur)
    // {
    //     cur = num;
    //     is_find = 1;
    // }
    
// });
if(cur < 0)
{
    cur = $('.galimg').size() -1;
}
return cur;
    }
    function opengal(next)
    {
    $("#popup_lightbox").show();
    $("#popup_lightbox").css("opacity","1");
    $("#popup_lightbox").css("display","block");
    $("#popup_lightbox").css("width","100%");
    $("#popup_lightbox").css("height","100vh");
    var src = show_img(next);
        $('#glarge').attr('src',src);
        $('#glarge').attr('cur',next);
    }
    function find_next(cur)
    {
        cur = parseInt(cur);
         var is_find = 0;
        $('.galimg').each(function(i, obj) {
            var num = parseInt($(this).attr('index'));
            console.log(num);
    if(is_find == 0 && num > cur)
    {
        cur = num;
        is_find = 1;
    }
    
});
if(is_find == 0)
{
    cur = 0;
}
return cur;
    }
    function show_img(ind)
    {
        
        ind = parseInt(ind);
        var src = '';
        
        $('.galimg').each(function(i, obj) {
            var num = parseInt($(this).attr('index'));
            // console.log(num+' test '+ ind);
    if(num == ind)
    {
        if(!ind)
        {
            src = $(this).attr('data-src');
        }
        else
        {
            src = $(this).attr('src');
        }
        // is_find = 1;
    }
    
});
return src;
    }
    
    function selImg(next)
    {
        var src = show_img(next);
        $('#large_img').attr('src',src);
        $('#large_img').attr('cur',next);
     
    }
    function gopre(type = 0)
    {
        var cur = $('#large_img').attr('cur');
        if(type)
        {
            cur = $('#glarge').attr('cur');
        }
         var next = find_pre(cur);
        var src = show_img(next);
        if(type)
        {
            $('#glarge').attr('src',src);
        $('#glarge').attr('cur',next);
        }
        else
        {
        $('#large_img').attr('src',src);
        $('#large_img').attr('cur',next);
        }
        
    }
    function gonext(type = 0)
    {
        var cur = $('#large_img').attr('cur');
        if(type)
        {
            cur = $('#glarge').attr('cur');
        }
         var next = find_next(cur);
        var src = show_img(next);
        if(type)
        {
            $('#glarge').attr('src',src);
        $('#glarge').attr('cur',next);
        }
        else
        {
        $('#large_img').attr('src',src);
        $('#large_img').attr('cur',next);
        }
        
        
    }
    $(document).ready(function(){
        $('.summernote').summernote();
    });
    </script>
    <script type="text/javascript">
    $(document).ready(function(){
       $('#sidebarCollapse').click(function(){
           $('#addd_butn').toggleClass('sidebar_open');
       });
    });
    </script>    
    <script type="text/javascript">
        $(".btn-close").click(function(){
            $("#popup_lightbox").hide();
        });
    </script>
    <?php
    if($pro['lat'] &&$pro['lng'])
    {
        ?>
    <script>
    function myMap() {
    var mapProp= {
      center:new google.maps.LatLng(<?= $pro['lat'] ?>,<?= $pro['lng'] ?>),
      zoom:12,
    };
    var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
            var myLatLng = {lat: <?= $pro['lat'] ?>, lng: <?= $pro['lng'] ?>};

    var marker = new google.maps.Marker({
              position: myLatLng,
              map: map,
              title: 'Hello World!'
            });
    }
     $(function () {
 
  $("#rateYo").rateYo({
    starWidth: "40px",
    fullStar: true,
    onSet: function (rating, rateYoInstance) {
        $('#rate').val(rating);
    }
  });
 
});
    $('#rate_form').click(function(){
    var form = $('#rform');
    var here = $(this);
    alert(form.attr('action'));
    $.ajax({
				url: form.attr('action')+'?'+form.serialize(), // form action url
				type: 'POST', // form submit method get/post
				dataType: 'html', // request type html/json/xml
				data: form.serialize(), // serialize form data 
				cache       : false,
				contentType : false,
				processData : false,
				beforeSend: function() {
					here.addClass('disabled');
					here.html('submitting'); // change submit button text
				},
				success: function(data) {
					here.fadeIn();
					here.html('Post Review');
					here.removeClass('disabled');
					if(data == '1'){
						notify('Review add successfully!','success','bottom','right');
						window.location.replace("<?php echo $this->crud_model->product_link($pro['product_id']); ?>");

					}else {
						notify(data,'warning','bottom','right');
					}
				},
				error: function(e) {
					console.log(e)
				}
			});
});
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key=<?= $this->config->item('map_key'); ?>&callback=myMap"></script>
    <?php
    }
    ?>
    <script src="<?= base_url();?>template/front/js-files/custom.js"></script>
    <script>
    function click_id(id)
    {
        alert(id);
        var mid="#"+id;
        $(mid).click();
    }
        $('#shareit').click(function(){
            // alert();
            // sharethis-inline-share-buttons
            $('.sharethis-inline-share-buttons').show();
        })
    </script>
<script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=63788bcc6611ec0019d8d89c&product=inline-share-buttons&source=platform" async="async"></script>


