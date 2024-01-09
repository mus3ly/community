<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

<script>

	var base_url = "<?php echo base_url(); ?>"; 
	var dss = "<?php echo translate("deleted_successfully"); ?>";
	var cncle = "<?php echo translate("cancelled"); ?>";
	var cnl = "<?php echo translate("cancel"); ?>";
	var req = "<?php echo translate("required"); ?>";
	var mbn = "<?php echo translate("must_be_a_number"); ?>";
	var mbe = "<?php echo translate("must_be_a_valid_email_address"); ?>";
	var sv = "<?php echo translate("save"); ?>";
	var ppus = "<?php echo translate("product_published!"); ?>";
	var pups = "<?php echo translate("product_unpublished!"); ?>";
	var pfe = "<?php echo translate("product_featured!"); ?>";
	var pufe = "<?php echo translate("product_unfeatured!"); ?>";
	var ptd = "<?php echo translate("product_in_todays_deal!"); ?>";
	var ptnd = "<?php echo translate("product_removed_from_todays_deal!"); ?>";
	var spus = "<?php echo translate("slider_published!"); ?>";
	var supus = "<?php echo translate("slider_unpublished!"); ?>";
	var papus = "<?php echo translate("page_published!"); ?>";
	var paupus = "<?php echo translate("page_unpublished!"); ?>";
	var ntsen = "<?php echo translate("notification_sound_enabled!"); ?>";
	var ntsds = "<?php echo translate("notification_sound_disabled!"); ?>";
	var glen = "<?php echo translate("google_login_enabled!"); ?>";
	var glds = "<?php echo translate("google_login_disabled!"); ?>";
	var flen = "<?php echo translate("facebook_login_enabled!"); ?>";
	var flds = "<?php echo translate("facebook_login_disabled!"); ?>";
	var pplds = "<?php echo translate("paypal_payment_disabled!"); ?>";
	var pplen = "<?php echo translate("paypal_payment_enabled!"); ?>";
	var c2_e ="<?php echo translate("twocheckout_payment_enabled!"); ?>";
	var c2_d ="<?php echo translate("twocheckout_payment_disabled!"); ?>";
	var vp_e ="<?php echo translate("voguePay_payment_enabled!"); ?>";
	var vp_d ="<?php echo translate("voguePay_payment_disabled!"); ?>";
	var s_e = "<?php echo translate("slider_enabled!"); ?>";
	var s_d = "<?php echo translate("slider_disabled!"); ?>";
	var su_e = "<?php echo translate("successfully_enabled!"); ?>";
	var su_d = "<?php echo translate("successfully_disabled!"); ?>";
	var c_e = "<?php echo translate("cash_payment_enabled!"); ?>";
	var c_d = "<?php echo translate("cash_payment_disabled!"); ?>";
	var enb = "<?php echo translate("enabled!"); ?>";
	var dsb = "<?php echo translate("disabled!"); ?>";
	var gae = "<?php echo translate("google_analytics_enabled!"); ?>";
	var gad = "<?php echo translate("google_analytics_disabled!"); ?>";
	var enb_ven = "<?php echo translate("notification_email_sent_to_vendor!"); ?> ";
	var working = "<?php echo translate("working..."); ?> ";
	var loader_img = '<?= base_url('map-loader.gif'); ?>';
	function isMobileDevice() {
  return (typeof window.orientation !== "undefined") || (navigator.userAgent.indexOf('Mobile') !== -1);
}
function setCookie(name,value,days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days*24*60*60*1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "")  + expires + "; path=/";
}
function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}
function set_summer(){
        $('.summernotes').each(function() {
            var now = $(this);
            var h = now.data('height');
            var n = now.data('name');
			if(now.closest('div').find('.val').length == 0){
            	now.closest('div').append('<input type="hidden" class="val" name="'+n+'">');
			}
            now.summernote({
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['view', ['codeview', 'help']],
                ],
                height: h,
                onChange: function() {
                    now.closest('div').find('.val').val(now.code());
                }
            });
            now.closest('div').find('.val').val(now.code());
        });
	}
$(document).ready(function(){
    set_summer();
    var viewportWidth = window.innerWidth || document.documentElement.clientWidth;
var viewportHeight = window.innerHeight || document.documentElement.clientHeight;

// Log the viewport width and height
console.log("Viewport width: " + viewportWidth);
console.log("Viewport height: " + viewportHeight);

// Check if the viewport width is below a certain threshold to identify mobile devices
if (viewportWidth < 768) 
{
        $('#container').attr('class','effect mainnav-sm');
} else {
  $('#container').attr('class','effect mainnav-lg');
}
});
	function handleClick(cb) {
  $('.tick_check').each(function(i, obj) {
      var val = $(this).attr('value');
      if($(this).is(':checked')){
    $('#'+val+'_section').hide();
    $('#'+val+'_txt').text('Untick to show');
    
}
else
{
    $('#'+val+'_section').show();
    $('#'+val+'_txt').text('Tick to hide');
    
}
    //test
});
}
<?php
if(isset($row['is_bpage']) && $row['is_bpage'])
{
?>
function bpage_cat(page,type,cat)
{
    if(type == "get" || type == "select" || type == "remove")
            {
                $('#bpage_cats').html('Loading ....');
            }
            else if(type == "child")
            {
                $('#cat_selection').html('Loading ...');
            }
    var url = '<?= base_url('vendor/bpage_cat') ?>/'+page+'/'+type+'/'+cat;
    $.ajax({
        url: url,
        // dataType: "json",
        type: "GET",
        // async: true,
        data: {},
        success: function (data) {
            if(type == "get"  || type == "select"  || type == "remove")
            {
                $('#bpage_cats').html(data);
            }
            else if(type == "child")
            {
                $('#cat_selection').html(data);
            }
        },
        error: function (xhr, exception) {
            var msg = "";
            if (xhr.status === 0) {
                msg = "Not connect.\n Verify Network." + xhr.responseText;
            } else if (xhr.status == 404) {
                msg = "Requested page not found. [404]" + xhr.responseText;
            } else if (xhr.status == 500) {
                msg = "Internal Server Error [500]." +  xhr.responseText;
            } else if (exception === "parsererror") {
                msg = "Requested JSON parse failed.";
            } else if (exception === "timeout") {
                msg = "Time out error." + xhr.responseText;
            } else if (exception === "abort") {
                msg = "Ajax request aborted.";
            } else {
                msg = "Error:" + xhr.status + " " + xhr.responseText;
            }
           
        }
    }); 
}
$(document).ready(function(){
    bpage_cat('<?= $row['product_id'] ?>','get',0);
    bpage_cat('<?= $row['product_id'] ?>','child',0);
});
<?php
}
?>
	function chcol(i)
	{
	    var type = $('#type_'+i).val();
	    if(type == 'img')
	    {
	        $('#img_'+i).show();
	        $('#colimg_'+i+'_img').addClass('required');
	        $('#textinput_'+i).removeClass('required');
	        $('#text_'+i).hide();
	    }
	    else
	    {
	        $('#img_'+i).hide();
	        $('#textinput_'+i).addClass('required');
	        $('#colimg_'+i+'_img').removeClass('required');
	        $('#text_'+i).show();
	    }
	}
	function del_cat(id , pid,col= 0){
       var url = '<?= base_url('admin/cat_child');?>';
       var cid = id;
       if(col)
       {
           var mid = '#col_'+pid;
           $(mid).html('Loading');
       }
       var dta = { del:1,sid:id, id:cid, col:col};
       console.log(dta);
       
      $.ajax({
        url: url,
        type: "Post",
        async: true,
        data: { del:1,sid:id, id:cid, col:col},
        success: function (data) {
           if(data){
               
               if(col)
               {
                   load_chids(pid,mid);
               }
               else
               {
                    load_chids(pid,0)       
               }
       
            
            //   $("#list_itemss").html(data);

           }
        },
    });
}
function create_slug(pid = 0)
{
    var tit = $('#title').val();
    var meta_title = $('#meta_title').val();
    if(tit.length > 5)
    {
        if(!meta_title)
        {
            $('#meta_title').val(tit);
        }
        
    $('#slug').attr('placeholder','genrating...')
    $.ajax({
        url: '<?= base_url('vendor/create_slug') ?>/'+pid,
        // dataType: "json",
        type: "GET",
        // async: true,
        data: {title:tit },
        success: function (data) {
        //   alert(data);
           $('#slug').val(data);
        },
        error: function (xhr, exception) {
            var msg = "";
            if (xhr.status === 0) {
                msg = "Not connect.\n Verify Network." + xhr.responseText;
            } else if (xhr.status == 404) {
                msg = "Requested page not found. [404]" + xhr.responseText;
            } else if (xhr.status == 500) {
                msg = "Internal Server Error [500]." +  xhr.responseText;
            } else if (exception === "parsererror") {
                msg = "Requested JSON parse failed.";
            } else if (exception === "timeout") {
                msg = "Time out error." + xhr.responseText;
            } else if (exception === "abort") {
                msg = "Ajax request aborted.";
            } else {
                msg = "Error:" + xhr.status + " " + xhr.responseText;
            }
           
        }
    }); 
    }
}
function create_link(id)
{
    var txt = $('#'+id+'_text').val();
    var link = $('#'+id+'_link').val();
    var val = txt+'-'+link;
    $('#'+id).val(val);
}
$(document).on('change', 'input[type="file"]', function() { 

// $('').on('change', function() {
    // alert('OKK');
    var nme = this.id;
    
    var mid = '#'+this.name+'_box'
    if(nme != 'gimgs')
    {
    $(mid).html('');
    }
      var img = this.files[0]; 
 	
      var reader = new FileReader();
 
      reader.onloadend = function() {
          
         if(nme != 'gimgs')
        {
            $(mid).append("<div style='float:left;border:4px solid #303641;padding:5px;margin:5px;'><img height='80' src='" + reader.result + "'></div>");
            upload_img(reader.result,0,nme);
        }
        else
        {
            $(mid+'> ul ').append("<li><img height='80' src='" + reader.result + "'></li>");
            upload_img_gal(reader.result);
        }
          
      }
      reader.readAsDataURL(img);    
    });
    function upload_img_gal(img){
        var old_txt = $('#gimgs_txt').text();

        // $('#gimgs_txt').text('Uploading ...');
        var settings = {
  "url": "<?= base_url(); ?>/vendor/gupload",
  "method": "POST",
  "timeout": 0,
  "headers": {
    "Content-Type": "application/x-www-form-urlencoded"
  },
  "data": {
    "img": img,
    "pid": "<?= $row['product_id'] ?>"
  }
};
var imgUrl = '<?= base_url(); ?>/vendor/product/rimg/<?= $row['product_id'] ?>';

$.ajax(settings).done(function (response) {
    // alert(response);
    // $('#gimgs_txt').text(old_txt);
    $('.gallary_images').load(imgUrl);
  console.log(response);
});

    }
    
    function upload_img(img , gal=0,mid = ''){
        var old_txt = $('#gimgs_txt').text();
        if(gal)
        {
            $('#show_hide_loader').show();
        $('#gimgs_txt').text('Uploading ...');
        }
        else
        {
            //loader_img
            $('#'+mid+'_box').html("Loading wait...");
            
        }
        var settings = {
  "url": "<?= base_url(); ?>/vendor/gupload",
  "method": "POST",
  "timeout": 0,
  "headers": {
    "Content-Type": "application/x-www-form-urlencoded"
  },
  "data": {
    "img": img,
    "pid": "<?= $row->product_id ?>"
  }
};
var imgUrl = '<?= base_url(); ?>/vendor/product/rimg';

$.ajax(settings).done(function (response) {
    response = JSON.parse(response);
    // $('#gimgs_txt').text(old_txt);
    if(response['url'])
    {
        if(mid )
        {
            $('#'+mid+'_box').html("<div style='float:left;border:4px solid #303641;padding:5px;margin:5px;'><img height='80' src='" + response['url']+ "'></div>");
            // alert('#'+mid+'_img');
            $('#'+mid+'_img').val(response['img_id']);
            $('#'+mid).attr('value',response['img_id']);
            $('#'+mid).attr('data-id',response['img_id']);
        }
    }
    
    // $('#show_hide_loader').h/ide();
//   console.log(response);
});

    }
function selecttype(id,nid= 0,type = 0)
{
    // alert(nid);
    if(type)
    {
        $('#category').val(id);
    }
    else
    {
        if($('#category').val() && id)
        {
            
            var pre = $('#category').val()+','+id;
            // alert(pre);
            $('#category').val(pre);
        }
        else{
            $('#category').val(id);
        }
    }
    // show_rel_fields();
    if(nid)
    {
        id=nid;
    }
    for(var i = 1;i<=10;i++)
    {
        id = id.replace(",", "-");  

    }
    // alert(id);

    var url  = base_url+'vendor/product/sub_by_cat/'+id;
    $.ajax({
  url: url,
  cache: false,
  success: function(html){
    if(html == '0')
    {
        next_tab();

    }
    else
    {
    $("#cat_res").html(html);
    }
  }
});


    // get_cat(id,this);
}
function show_rel_fields()
{
    //work here 
    $('#admin_loader').html('Loading ... ');
    var cats = $('#category').val();
    $.ajax({
        url: "<?= base_url('vendor/admin_fields') ?>",
        type: "get",
        async: true,
        data: {cats: cats,pid:'<?= $row['product_id'] ?>' },
        success: function (data) {
        $('#admin_loader').html(data);
        $(".js-example-basic-single").select2();
           
        },
        error: function (xhr, exception) {
            var msg = "";
            if (xhr.status === 0) {
                msg = "Not connect.\n Verify Network." + xhr.responseText;
            } else if (xhr.status == 404) {
                msg = "Requested page not found. [404]" + xhr.responseText;
            } else if (xhr.status == 500) {
                msg = "Internal Server Error [500]." +  xhr.responseText;
            } else if (exception === "parsererror") {
                msg = "Requested JSON parse failed.";
            } else if (exception === "timeout") {
                msg = "Time out error." + xhr.responseText;
            } else if (exception === "abort") {
                msg = "Ajax request aborted.";
            } else {
                msg = "Error:" + xhr.status + " " + xhr.responseText;
            }
           
        }
    });
    
}
$(document).ready(function(){
   getamn(); 

 <?php
 if(isset($row['product_id']) && $row['product_id'])
 {
     ?>
     cats_edit(<?= (isset($row['product_id'])?$row['product_id']:0) ?>,'get',0);
     <?php
 }
 ?>
});
function cats_edit(pid = <?= (isset($row['product_id'])?$row['product_id']:0) ?>,type = 'get',cat=0)
{   
 $.ajax({
        url: '<?= base_url('vendor/cats_edit') ?>/'+pid+'/'+type+'/'+cat,
        type: "Post",
        async: true,
        data: { },
        success: function (data) {
            
           $('#customer_choice_inner').html(data);
           show_rel_fields();
        },
        error: function (xhr, exception) {
            var msg = "";
            if (xhr.status === 0) {
                msg = "Not connect.\n Verify Network." + xhr.responseText;
            } else if (xhr.status == 404) {
                msg = "Requested page not found. [404]" + xhr.responseText;
            } else if (xhr.status == 500) {
                msg = "Internal Server Error [500]." +  xhr.responseText;
            } else if (exception === "parsererror") {
                msg = "Requested JSON parse failed.";
            } else if (exception === "timeout") {
                msg = "Time out error." + xhr.responseText;
            } else if (exception === "abort") {
                msg = "Ajax request aborted.";
            } else {
                msg = "Error:" + xhr.status + " " + xhr.responseText;
            }
           
        }
    }); 
}
   $(document).ready(function(){
       <?php
       if(isset($row['category']))
       {
           ?>
    //   show_rel_fields();
      <?php
       }
       ?>
   });
$(document).ready(function(){
       selecttype('<?= $row['category'] ?>');
   });
   function IsJsonString(str) {
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return true;
}
function validate_listing(){
        var property_cat = '<?= $this->config->item('property_cat') ?>';
        var plainText = $("#editor1").code();
        console.log(plainText);
          if(plainText.length < 300)
            {
                alert('Please add minimum 300 character in description');
                return 0;
            }
        
    var car_cat = '<?= $this->config->item('car_cat') ?>';
    var event_cat = '<?= $this->config->item('event_cat') ?>';
    var job_cat = '<?= $this->config->item('job_cat') ?>';
    var cats = $('#category').val();
    if(!cats)
    {
        alert("Please select atleast 1 category");
        return 0;
    }
    const myArray = cats.split(",");
    if(myArray.indexOf(car_cat) != -1)
{  
    car_cat = 1;
}
else
{
   car_cat = 0;
}
    if(myArray.indexOf(property_cat) != -1)
{ 
    
   property_cat = 1;
}
else
{
   property_cat = 0;
}
if(myArray.indexOf(event_cat) != -1)
{  
   event_cat = 1;
}
else
{
    event_cat = 0
}
if(myArray.indexOf(job_cat) != -1)
{  
   job_cat = 1;
}
else
{
    job_cat = 0;
}
                    var car_error = 0;
                    var property_error = 0;
                    var event_error = 0;
                    var job_error = 0;
        if(car_cat == 1)
        {
            var focus = '';
            $('.required1').each(function(i, obj) {
                if(!$(this).val() || $(this).val() == 0)
                {
                    car_error = 1;
                    
                    $(this).addClass('error');
                    // console.log($(this).attr('class'));
                }
                else
                {
                    $(this).removeClass('error');                    
                }
                console.log($(this).attr('name'));
            });
            if(car_error == 1)
            {
                var fdone = 0;
                $('.required1').each(function(i, obj) {
                if(!$(this).val() && fdone == 0)
                {
                    fdone = 1;
                    $(this).focus();
                }
                console.log($(this).attr('name'));
            });
                alert("Please fill required field");
                $('.tab-pane').each(function(i, obj) {
                    $(this).removeClass('active');
                    $(this).removeClass('in');
                
                });
                $('#xtra_info').addClass("active in");
                $('#car_show').addClass("active");
            }
            else
            {
                form_submit('product_add','<?php echo translate('product_has_been_uploaded!'); ?>');
            }
        }
        else if(property_cat == 1)
        {
            var focus = '';
            $('.required2').each(function(i, obj) {
                if(!$(this).val() || $(this).val() == 0)
                {
                    property_error = 1;
                    
                    $(this).addClass('error');
                    // console.log($(this).attr('class'));
                }
                else
                {
                    $(this).removeClass('error');                    
                }
                console.log($(this).attr('name'));
            });
            if(property_error == 1)
            {
                var fdone = 0;
                $('.required2').each(function(i, obj) {
                if(!$(this).val() && fdone == 0)
                {
                    fdone = 1;
                    $(this).focus();
                }
                console.log($(this).attr('name'));
            });
                alert("Please fill required field");
                $('.tab-pane').each(function(i, obj) {
                    $(this).removeClass('active');
                    $(this).removeClass('in');
                
                });
                $('#xtra_property_info').addClass("active in");
                $('#property_show').addClass("active");
            }
            else
            {
                form_submit('product_add','<?php echo translate('product_has_been_uploaded!'); ?>');
            }
        }
        else if(event_cat == 1)
        {
            var focus = '';
            $('.required3').each(function(i, obj) {
                if(!$(this).val() || $(this).val() == 0)
                {
                    event_error = 1;
                    
                    $(this).addClass('error');
                    // console.log($(this).attr('class'));
                }
                else
                {
                    $(this).removeClass('error');                    
                }
                console.log($(this).attr('name'));
            });
            // alert(event_error);
            if(event_error == 1)
            {
                var fdone = 0;
                $('.required3').each(function(i, obj) {
                if(!$(this).val() && fdone == 0)
                {
                    fdone = 1;
                    $(this).focus();
                }
                console.log($(this).attr('name'));
            });
                alert("Please fill required field");
                $('.tab-pane').each(function(i, obj) {
                    $(this).removeClass('active');
                    $(this).removeClass('in');
                
                });
                $('#xtra_event_info').addClass("active in");
                $('#event_show').addClass("active");
            }
            else
            {
                form_submit('product_add','<?php echo translate('product_has_been_uploaded!'); ?>');
            }
        }
        else if(job_cat == 1)
        {
            var focus = '';
            $('.required4').each(function(i, obj) {
                if(!$(this).val() || $(this).val() == 0)
                {
                    job_error = 1;
                    
                    $(this).addClass('error');
                    // console.log($(this).attr('class'));
                }
                else
                {
                    $(this).removeClass('error');                    
                }
                console.log($(this).attr('name'));
            });
            if(job_error == 1)
            {
                var fdone = 0;
                $('.required4').each(function(i, obj) {
                if(!$(this).val() && fdone == 0)
                {
                    fdone = 1;
                    $(this).focus();
                }
                console.log($(this).attr('name'));
            });
                alert("Please fill required field");
                $('.tab-pane').each(function(i, obj) {
                    $(this).removeClass('active');
                    $(this).removeClass('in');
                
                });
                $('#xtra_job_info').addClass("active in");
                $('#job_show').addClass("active");
            }
            else
            {
                form_submit('product_add','<?php echo translate('product_has_been_uploaded!'); ?>');
            }
        }
        else
        {
            form_submit('product_add','<?php echo translate('product_has_been_uploaded!'); ?>');
        }
        return 0;
        // 
    }
</script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=<?= $this->config->item('map_key'); ?>&libraries=places"></script>
    <script>
        var mylat = '';
        var marker;
        var map;
       function initialize() {
        var lat = '51.508742';
        var lng = '-0.120850';
        <?php
            if(!$row['lat'] || !$row['lng'])
            {
                ?>
                getLocation();
                <?php
            }
            else
            {
                ?>
                lat = '<?= $row['lat']; ?>';
        lng = '<?= $row['lng']; ?>';
                <?php
            }
        ?>
        
            var mapProp= {
  center:new google.maps.LatLng(lat,lng),
  zoom:12,
};
map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
          var input = document.getElementById('searchTextField');
          var autocomplete = new google.maps.places.Autocomplete(input);
            google.maps.event.addListener(autocomplete, 'place_changed', function () {
                var place = autocomplete.getPlace();
                // alert(place.name);
                document.getElementById('cityLat').value = place.geometry.location.lat();
                document.getElementById('cityLng').value = place.geometry.location.lng();
                    var latlng = new google.maps.LatLng(place.geometry.location.lat(), place.geometry.location.lng());
                    map.setCenter({lat:place.geometry.location.lat(), lng:place.geometry.location.lng()});


                marker.setPosition(latlng);
            });
               var myLatlng = new google.maps.LatLng(parseFloat(lat),parseFloat(lng));
        marker = new google.maps.Marker({
            position: myLatlng,
            map: map,
            title: 'Your position',
            draggable:true,
        });
  google.maps.event.addListener(marker, 'dragend', function() {
    var lat = marker.getPosition().lat(); 
          var lng = marker.getPosition().lng();
            jQuery('#cityLat').val(lat);
        jQuery('#cityLng').val(lng);
            // get_address(lat, lng);
  });
        }
        function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else { 
    alert("No location");
  }
}

function showPosition(position) {
    var latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
    map.setCenter({lat: position.coords.latitude, lng:position.coords.longitude});
    $('#cityLat').val(position.coords.latitude);
    $('#cityLng').val(position.coords.longitude);

                marker.setPosition(latlng);
}
        google.maps.event.addDomListener(window, 'load', initialize);
        
    var feature = 0;
    <?php
    if($feature)
    {
        ?>
        feature = <?= count($feature) -1; ?>;
        <?php
    }
    ?>
    function remove_feature(item)
    {
        feature--;
        var mid =  '#fid_'+item;
        $(mid).remove();
    }
    function add_feature()
    {
        if(feature >= 4)
        {
            alert('You can add maximum 5 features');
        }
        else
        {

        feature = feature +1;
        var html = '<div class="feature_single" id="fid_'+ feature+'">';
        html += '<textarea class="form-control"  name="feature['+feature+'][fdet]" style="width:45%;float:left;" placeholder="Details"></textarea>';
        html += '<button style="width:4px;" class="btn btn-danger" onclick="remove_feature('+feature+')" >-</buuton>';
                                       html+= '</div>';
                                       $('#feature_div').append(html);
        }
    }
    var txt = 0;
    function remove_text(item)
    {
        txt--;
        var mid =  '#tid_'+item;
        $(mid).remove();
    }
    function add_text()
    {
        if(txt >= 7)
        {
            alert('You can add maximum 7 items');
        }
        else
        {

            txt = txt +1;
        var html = '<div class="feature_single" id="tid_'+ txt+'">';
        html += '<input type="text" class="form-control" name="text['+txt+'][fhead]" style="width:45%;float:left;" placeholder="Heading" />';
        html += '<textarea class="form-control"  name="text['+txt+'][fdet]" style="width:45%;float:left;" placeholder="Details"></textarea>';
        html += '<button style="width:4px;" class="btn btn-danger" onclick="remove_text('+txt+')" >-</buuton>';
                                       html+= '</div>';
                                       $('#text_div').append(html);
        }
    }
        function update_filter(id,col)
        {
            col = col+'_col';
            var input = document.getElementById(id);
            var value = input.value;
            if(value == 'other' && input.getAttribute('type') == 'model')
            {
                var outer = id+'_outer';  
             var html = '<input type="text" id="'+input.getAttribute('id')+'" col="'+input.getAttribute('col')+'" rows="9" onkeyup="'+input.getAttribute('onchange')+'" class="form-control required" placeholder="'+input.getAttribute('placeholder')+'" data-height="100" name="ad_field_values[]">';
             document.getElementById(outer).innerHTML = html;
            }
            else
            {
            document.getElementById(col).value = value; 
            }

        }
        function capital_val(id)
        {
            var val = $('#'+id).val();
            var mySentence = val;
var words = mySentence.split(" ");

for (let i = 0; i < words.length; i++) {
    words[i] = words[i][0].toUpperCase() + words[i].substr(1);
}

words = words.join(" ");
for(var i = 1; i <=50;i++)
{
words.replace(",", " ");
}
console.log(words);
            $('#'+id).val(words);
        }
        
$('#amen_check').on('change',function(){
    $('#amenities').toggle();
})
$('#amnty').on('keyup', function(){
        var url = '<?= base_url('vendor/getAmenties')?>';
        var value = $(this).val();
        var cats = $('#category').val();
        if(cats)
        {
          $.ajax({
        url: url,
        type: "Post",
        async: true,
        data: {add:1,value:value,cats:cats },
        success: function (data) {
           $('#add_amn').html(data);
        },
        error: function (xhr, exception) {
           
        }
    });  
        }
    });
    $('#amn_btn').on('click', function(){
        var url = '<?= base_url('vendor/getAmenties')?>';
        var value = $('#amnty').val();
        var cats = $('#category').val();
        if(cats)
        {

          $.ajax({
        url: url,
        type: "Post",
        async: true,
        data: {add_to_table:1,value:value,cats:cats,pid:'<?= (isset($rid)?$rid:0) ?>' },
        success: function (data) {
            if(data)
        {
            getamn();
        }
        
        },
        error: function (xhr, exception) {
           
        }
    });  
        }
        else
        {
            alert("PLease select Ad type first ");
            go_tab('customer_choice_options')
        }
    });
    function delete_ament(val)
    {
        var url = '<?= base_url('vendor/getAmenties');?>';
      $.ajax({
        url: url,
        type: "Post",
        async: true,
        data: { del:1,am_id:val,pid:'<?= $rid ?>'},
        success: function (data) {
        if(data)
        {
            getamn();
        }
       
        },
    });
    }
     
    function getamn(id){
         var url = '<?= base_url('vendor/getAmenties');?>';
      $.ajax({
        url: url,
        type: "Post",
        async: true,
        data: { get:1,pid:'<?= $rid ?>'},
        success: function (data) {
        $('#select_amn2').html(data);
       
        },
    });
    }
     
    function selectamn(id){
         var url = '<?= base_url('vendor/getAmenties');?>';
      $.ajax({
        url: url,
        type: "Post",
        async: true,
        data: { select:1,sid:id,pid:'<?= $rid ?>'},
        success: function (data) {
        if(data)
        {
            getamn();
        }
       
        },
    });
    }
    $("#more_btn_attr").click(function(){
        $("#more_fields").append(''
            +'<div class="form-group">'
            +'    <div class="col-sm-4">'
            +'        <input type="text" name="ad_field_names_custom[]" class="form-control required"  placeholder="<?php echo translate('field_name'); ?>">'
            +'    </div>'
            +'    <div class="col-sm-5">'
            +'        <textarea rows="9"  class="summernotes" data-height="100" data-name="ad_field_values_custom[]"></textarea>'
            +'    </div>'
            +'    <div class="col-sm-2">'
            +'        <span class="remove_it_v rms btn btn-danger btn-icon btn-circle icon-lg fa fa-times" onclick="delete_row(this)"></span>'
            +'    </div>'
            +'</div>'
        );
        set_summer();
    });
     $("#more_field_btn").click(function(){
        
        $("#more_checkbox_fields").append(''
            +'<div class="form-group">'
            +'    <div class="col-sm-9">'
            +'        <input type="text" name="checkboxinfo[]" class="moredata form-control"  placeholder="<?php echo translate('field_name'); ?>">'
            +'    </div>'
            +'    <div class="col-sm-2">'
            +'        <span class="remove_it_v rms btn btn-danger btn-icon btn-circle icon-lg fa fa-times" onclick="delete_row(this)"></span>'
            +'    </div>'
            +'</div>'
        );
        set_summer();
    });
    //-----repeater form start
        $(document).on("click",".ad_more_btn", function(){
        
        var target = $(this).attr('target');
        var load = $(this).attr('load');
        var outer = $(this).attr('outer');
        // alert(load);
        
        var limit = parseInt($(this).attr('limit'));
        if(!limit)
        rtime = 0;
        var rtime = parseInt($(this).attr('rtime'));
        if(!rtime)
        rtime = 5;
        var target = $(this).attr('target');
        var ind = parseInt($(this).attr('index'));
        ind++;
        if(ind > limit)
        {
            alert('can not add more then '+limit+' items');
            return 0;
        }
        else
        {
        $(this).attr('index',ind);
        }
        
        
        
        
        var content = $(this).attr('content');
        if(load)
        {
            content = $('#'+load).attr('content');
            for(var i = 1;i <= 10;i++)
        {
            content = content.replace("oindex", outer);
        }
        }
        for(var i = 1;i <= rtime;i++)
        {
            content = content.replace("index", ind);
        }

        $(target).append(content);
    });
    $(document).on('click', '.remove-parent', function() {
                    var $this = $(this);
                    var parent = $this.attr("parent");
                    var parent2 = $this.attr("parent2");
                    if(parent2)
                    {
                        var mid = parent2+'_btn';
                        var ind = $(mid).attr('index');
                        ind--;
                        $(mid).attr('index',ind);
                    }
                    $this.closest(parent).remove();
                });
            //-----repeater form end
    </script>
    <!-- Place the first <script> tag in your HTML's <head> -->
<script src="https://cdn.tiny.cloud/1/q5jg3il4p94h9cs2f2agtr3taurgu1obqf2i5hxlkp35n55t/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

<!-- Place the following <script> and <textarea> tags your HTML's <body> -->
<script>
  tinymce.init({
  selector: '.tiny',
  plugins: ' image code',
  toolbar: 'undo redo | link image | code numlist bullist',
  /* enable title field in the Image dialog*/
  image_title: true,
  /* enable automatic uploads of images represented by blob or data URIs*/
  automatic_uploads: true,
  /*
    URL of our upload handler (for more details check: https://www.tiny.cloud/docs/configure/file-image-upload/#images_upload_url)
    images_upload_url: 'postAcceptor.php',
    here we add custom filepicker only to Image dialog
  */
  file_picker_types: 'image',
  /* and here's our custom image picker*/
  file_picker_callback: function (cb, value, meta) {
    var input = document.createElement('input');
    input.setAttribute('type', 'file');
    input.setAttribute('accept', 'image/*');

    /*
      Note: In modern browsers input[type="file"] is functional without
      even adding it to the DOM, but that might not be the case in some older
      or quirky browsers like IE, so you might want to add it to the DOM
      just in case, and visually hide it. And do not forget do remove it
      once you do not need it anymore.
    */

    input.onchange = function () {
      var file = this.files[0];

      var reader = new FileReader();
      reader.onload = function () {
        /*
          Note: Now we need to register the blob in TinyMCEs image blob
          registry. In the next release this part hopefully won't be
          necessary, as we are looking to handle it internally.
        */
        var id = 'blobid' + (new Date()).getTime();
        var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
        var base64 = reader.result.split(',')[1];
        var blobInfo = blobCache.create(id, file, base64);
        blobCache.add(blobInfo);

        /* call the callback and populate the Title field with the file name */
        cb(blobInfo.blobUri(), { title: file.name });
      };
      reader.readAsDataURL(file);
    };

    input.click();
  },
  content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
});
</script>
<?php
if(isset($row['is_bpage']) && $row['is_bpage'])
{
    ?>
    <script>
        $(document).ready(function(){

    var num = parseInt( $('.exra_chnge').val());
    for(var i = 1;i <=3 ;i++)
    {
        var mid = "#col"+i+"_div";
        if(i<= num)
        {
        $(mid).show();
        }
        else
        {
            $(mid).hide();
        }
    }
});
        function chcont_type(col)
        {
            $('#box'+col).show();
            var type = '#type_'+col;
            var mid = $(type).val();
            if(mid == 'img')
            {
                $('#img_'+col).show();
                $('#text_'+col).hide();
            }
            else
            {
                $('#img_'+col).hide();
                $('#text_'+col).show();
            }
        }
$('.exra_chnge').change(function(){
    var num = parseInt( $(this).val());
    for(var i = 1;i <=3 ;i++)
    {
        var mid = "#col"+i+"_div";
        if(i<= num)
        {
        $(mid).show();
        }
        else
        {
            $(mid).hide();
        }
    }
});
function preview_3(input,i) {
        alert('preview'+i);
        console.log(input.files);
        if (input.files && input.files[0]) {
            $("#colimg_"+i+"_box").html('');
            $(input.files).each(function () {
                var reader = new FileReader();
                
                reader.readAsDataURL(this);
                reader.onload = function (e) {
                    alert(e.target.result);
                    $("#colimg_"+i+"_box").html("<div style='float:left;border:4px solid #303641;padding:5px;margin:5px;'><img width='100' height='100' src='" + e.target.result + "'></div>");
                }
            });
        }
    }
    </script>
    <?php
}
?>
