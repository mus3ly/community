 <?php
$rid = time();
?>
<div class=" newsidebar" style="margin-top:70px;">
    <div class="row">
         <?php
            echo form_open(base_url() . 'vendor/product/do_add/', array(
                'class' => 'form-horizontal',
                'method' => 'post',
                'id' => 'product_add',
                'enctype' => 'multipart/form-data'
            ));
        ?>
        <input type="hidden" name="is_product" value="1" />
        <input type="hidden" name="rand_id" value="<?= $rid ?>" />
        <div class="col-sm-2 sidebar">
            <div class="panel-heading">
                <div class="panel-control1">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a data-toggle="tab" href="#product_details"><?php echo translate('product_details'); ?></a>
                        </li>
                        <li >
                            <a data-toggle="tab" href="#event_images"><?php echo translate('images_gallary'); ?></a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#business_details"><?php echo translate('business_details'); ?></a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#customer_choice_options"><?php echo translate('customer_choice_options'); ?></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-sm-10 right_content_box">
            <div class="tab-base">
                    <!--Tabs Content-->
                    <div class="tab-content">
                        <div id="product_details" class="tab-pane fade active in">

                            <div class="form-group ">
                                <h4 class=""><?php echo translate('product_details'); ?></h4>
                            </div>
                            <div class="row">
                                <div class="col-sm-3 sidegap_box">
                                    <div class="form-group ">
                                        <label class="control-label" for="demo-hor-6"><?php echo translate('product_title');?></label>
                                        <input type="text" name="title" id="demo-hor-1" placeholder="<?php echo translate('product_title');?>" class="form-control required">
                                    </div>
                                </div>

                                <div class="col-sm-3 sidegap_box">
                                    <div class="form-group ">
                                        <label class="control-label" for="demo-hor-6"><?php echo translate('category');?></label>
                                        <?php echo $this->crud_model->select_html('category','category','category_name','add','demo-chosen-select required','','digital',NULL,'get_cat'); ?>
                                    </div>
                                </div>
                                <div class="col-sm-3 sidegap_box">
                                    <div class="form-group " id="sub" style="display:none;">
                                        <label class="control-label" for="demo-hor-6"><?php echo translate('sub-category');?></label>
                                        <div id="sub_cat"> </div>
                                    </div>
                                </div>

                                <div class="col-sm-3 sidegap_box">
                                    <div class="form-group " id="brn" style="display:none;">
                                        <label class="control-label" for="demo-hor-6"><?php echo translate('brand');?></label>
                                        <div id="brand"></div>
                                    </div>
                                </div>
                                <div class="col-sm-3 sidegap_box">
                                    <div class="form-group " >
                                        <label class="control-label" for="demo-hor-6"><?php echo translate('unit');?></label>
                                         <input type="text" name="unit" id="demo-hor-5" placeholder="<?php echo translate('unit_(e.g._kg,_pc_etc.)'); ?>" class="form-control unit required">
                                    </div>
                                </div>
                                <div class="col-sm-3 sidegap_box">
                                    <div class="form-group " >
                                        <label class="control-label" for="demo-hor-6"><?php echo translate('tags');?></label>
                                         <input type="text" name="tag" data-role="tagsinput" placeholder="<?php echo translate('tags');?>" class="form-control">
                                    </div>
                                </div>

                                <div class="col-sm-12 sidegap_box">
                                    <label class="col-sm-4 control-label" for="demo-hor-12">Feature image</label>
                                        <span class="pull-left btn btn-default btn-file"> <?php echo translate('choose_file');?>
                                            <input type="file" value="<?= ($row['sideimg'])?$row['sideimg']:""; ?>" name="sideimg" onchange="preview1(this);" id="demo-hor-inputpass" class="form-control required">
                                        </span>
                                        <br><br>
                                        <span id="previewImg1" >

                                            <?php
                                                if($row['comp_logo'])
                                                {
                                                    $img = $this->crud_model->size_img($row['comp_logo'],100,100);
                                                    ?>
                                                    <img class="img-responsive" width="100" src="<?= $img;?>" data-id="_paris/uploads/product" alt="Feature Image"><?php
                                                }
                                            ?>
                                        </span>
                                    </div>
                                <div class="col-sm-12 sidegap_box">
                                    <div class="form-group " >
                                        <label class="control-label" for="demo-hor-6"><?php echo translate('description'); ?></label>
                                         <textarea rows="9"  class="summernotes" data-height="200" data-name="description"></textarea>
                                        </div>
                                </div>
                                <div class="col-sm-12 sidegap_box">
                                    <div class="form-group " id="sub" style="display:none;">
                                        *<?php echo translate('Write an seo friendly title within 60 characters')?>
                                    </div>
                                </div>
                                <div class="col-sm-12 sidegap_box">
                                    <div class="form-group " >
                                        <label class="control-label" for="demo-hor-6">Product link</label>
                                         <input type="text" name="product_link"
                                           placeholder="<?php echo translate('Your online store product link')?>"
                                           class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-3 sidegap_box">
                                    <div class="form-group " >
                                        <label class="control-label" for="demo-hor-6">Seo Friendly Title</label>
                                         <input type="text" name="seo_title"
                                           placeholder="<?php echo translate('Ex. Yamaha RT - Model 2020')?>"
                                           class="form-control required">
                                    </div>
                                </div>
                                <div class="col-sm-12 sidegap_box">
                                    <div class="form-group " >
                                        *<?php echo translate('Write an seo friendly description within 160 characters')?>
                                    </div>
                                </div>
                                <div class="col-sm-12 sidegap_box">
                                    <div class="form-group " >
                                        <label class="control-label" for="demo-hor-6"><?php echo translate('Seo Friendly Description');?></label>
                                         <textarea name="seo_description"
                                                  placeholder="<?php echo translate('Ex. New Yamaha Sports bike in 2020 from Japan')?>"
                                                  class="form-control required" rows='4' ></textarea>
                                    </div>
                                </div>
                            <!--    <div id="more_additional_fields"></div>-->
                            <!--<div class="form-group btm_border">-->
                            <!--    <label class="col-sm-4 control-label" for="demo-hor-inputpass"></label>-->
                            <!--    <div class="col-sm-6">-->
                            <!--        <h4 class="pull-left">-->
                            <!--            <i><?php echo translate('if_you_need_more_field_for_your_product_,_please_click_here_for_more...');?></i>-->
                            <!--        </h4>-->
                            <!--        <div id="more_btn" class="btn btn-mint btn-labeled fa fa-plus pull-right">-->
                            <!--        <?php echo translate('add_more_fields');?></div>-->
                            <!--    </div>-->
                            <!--</div>-->
                            </div>


                        </div>
                        <div id="event_images" class="tab-pane fade ">
                        <div class="form-group btm_border">
                                <h4 class="text-thin text-center"><?php echo translate('gallary_images'); ?></h4>
                            </div>
                            <div class="form-group btm_border">
                                <label class="col-sm-4 control-label" for="demo-hor-12"><?php echo translate('images');?></label>
                                <div class="col-sm-6">
                                    <span class="pull-left btn btn-default btn-file"> <?php echo translate('choose_file');?>
                                        <input type="file" multiple name="images[]" onchange="preview(this);" id="demo-hor-inputpass" class="form-control">
                                    </span>
                                    <br><br>
                                    <span id="previewImg" ></span>
                                    <br><br>
                                    <div class="gallary_images">
                                        <ul>
                                        <?php
                                        $imgs = $this->db->where('pid',$row['product_id'])->get('product_to_images')->result_array();
                                        foreach ($imgs as $key => $value) {
                                            $img = $this->crud_model->size_img($value['img'],100,100);
                                            ?>
                                            <li id="gimg_<?= $value['id']; ?>">
                                                <div onclick="delimg('<?= $value['id']; ?>')" class="del_icon"><i class="fa fa-trash-o" aria-hidden="true"></i>
</div>

                                                <img src="<?= $img ?>"/></li>

                                            <?php
                                        }
                                        ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div id="business_details" class="tab-pane fade">
                            <div class="form-group ">
                                <h4 class=""><?php echo translate('business_details'); ?></h4>
                            </div>
                            <div class="row">
                                <div class="col-sm-3 sidegap_box">
                                    <div class="form-group ">
                                        <label class="control-label" for="demo-hor-6"><?php echo translate('current_stock');?></label>
                                        <input type="number" name="current_stock" id="demo-hor-6" min='0' step='.01' placeholder="<?php echo translate('current_stock');?>" class="form-control required">
                                        <span class="btn"><?php echo currency('','def'); ?> / </span>
                                        <span class="btn unit_set"></span>
                                    </div>
                                </div>
  <div class="col-sm-3 sidegap_box">
                                    <div class="form-group ">
                                        <label class="control-label" for="demo-hor-6"><?php echo translate('sale_price');?></label>
                                        <input type="number" name="sale_price" id="demo-hor-6" min='0' step='.01' placeholder="<?php echo translate('sale_price');?>" class="form-control required">
                                        <span class="btn"><?php echo currency('','def'); ?> / </span>
                                        <span class="btn unit_set"></span>
                                    </div>
                                </div>

                                <div class="col-sm-3 sidegap_box">
                                    <div class="form-group ">
                                        <label class="control-label" for="demo-hor-6"><?php echo translate('purchase_price');?></label>
                                         <input type="number" name="purchase_price" id="demo-hor-7" min='0' step='.01' placeholder="<?php echo translate('purchase_price');?>" class="form-control required">
                                         <span class="btn"><?php echo currency('','def'); ?> / </span>
                                            <span class="btn unit_set"></span>
                                    </div>
                                </div>
                                <div class="col-sm-3 sidegap_box">
                                    <div class="form-group ">
                                        <label class="control-label" for="demo-hor-6">Shippo Price</label>
                                        <input type="number" name="shippo_price" id="demo-hor-8" min='1' step='.01' placeholder="Shippo Price" class="form-control required" value="1">
                                        <span class="btn"><?php echo currency('','def'); ?> 1 will allow buyer to trace their shipment 3 times. </span>
                                        <span class="btn unit_set"></span>
                                    </div>
                                </div>

                                <div class="col-sm-3 sidegap_box">
                                    <div class="form-group ">
                                        <label class="control-label" for="demo-hor-6"><?php echo translate('shipping_cost');?></label>
                                         <input type="number" name="shipping_cost" id="demo-hor-8" min='0' step='.01' placeholder="<?php echo translate('shipping_cost');?>" class="form-control">
                                          <span class="btn"><?php echo currency('','def'); ?> / </span>
                                <span class="btn unit_set"></span>
                                    </div>
                                </div>
                                <div class="col-sm-3 sidegap_box">
                                    <div class="form-group ">
                                       <label>Product Tax</label>
                                        <input type="number" name="tax" id="demo-hor-9" min='0' step='.01' placeholder="<?php echo translate('product_tax');?>" class="form-control">
                                        <select class="demo-chosen-select" name="tax_type">
                                        <option value="percent">%</option>
                                        <option value="amount"><?php echo currency('','def'); ?></option>
                                    </select>
                                     <span class="btn unit_set"></span>
                                    </div>
                                </div>

                                <div class="col-sm-3 sidegap_box">
                                    <div class="form-group ">
                                       <label>Product Discount</label>
                                         <input type="number" name="discount" id="demo-hor-10" min='0' step='.01' placeholder="<?php echo translate('product_discount');?>" class="form-control">
                                         <select class="demo-chosen-select" name="discount_type">
                                        <option value="percent">%</option>
                                        <option value="amount"><?php echo currency('','def'); ?></option>
                                    </select>
                                    <span class="btn unit_set"></span>
                                    </div>
                                </div>

                            </div>

                        </div>



                        <div id="customer_choice_options" class="tab-pane fade">
                            <div class="form-group ">
                                <h4 class=""><?php echo translate('customer_choice_options'); ?></h4>
                            </div>
                            <div class="form-group ">
                                <label class="col-sm-2 control-label" for="demo-hor-14"><?php echo translate('color'); ?></label>
                                <div class="col-sm-4"  id="more_colors">
                                  <div class="col-md-12" style="margin-bottom:8px;">
                                      <div class="col-md-10">
                                          <div class="input-group demo2">
                                               <input type="text" value="#ccc" name="color[]" class="form-control" />
                                               <span class="input-group-addon"><i></i></span>
                                            </div>
                                      </div>
                                      <span class="col-md-2">
                                          <span class="remove_it_v rmc btn btn-danger btn-icon icon-lg fa fa-trash" ></span>
                                      </span>
                                  </div>
                                </div>
                                <div class="col-sm-2">
                                    <div id="more_color_btn" class="btn btn-primary btn-labeled fa fa-plus">
                                        <?php echo translate('add_more_colors');?>
                                    </div>
                                </div>
                            </div>

                            <div id="more_additional_options"></div>
                            <div class="form-group ">
                                <label class="col-sm-12 control-label" for="demo-hor-inputpass"></label>
                                <div class="col-sm-12">
                                    <h4 class="pull-left">
                                        <i><?php echo translate('if_you_need_more_choice_options_for_customers_of_this_product_,please_click_here.');?></i>
                                    </h4>
                                    <div id="more_option_btn" class="btn btn-mint btn-labeled fa fa-plus pull-right">
                                    <?php echo translate('add_customer_input_options');?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
    <div class="row">
    <div class="col-md-12">

            <!--Panel heading-->
            <div class="panel-heading">
                <div class="panel-control" style="float: left;">

                </div>
            </div>
            <div class="panel-body">


                <span class="btn btn-purple btn-labeled fa fa-hand-o-right pull-right" onclick="next_tab()"><?php echo translate('next'); ?></span>
                <span class="btn btn-purple btn-labeled fa fa-hand-o-left pull-right" onclick="previous_tab()"><?php echo translate('previous'); ?></span>

            </div>

            <div class="panel-footer">
                <div class="row">
                    <div class="col-md-11">
                        <span class="btn btn-purple btn-labeled fa fa-refresh pro_list_btn pull-right"
                            onclick="ajax_set_full('add','<?php echo translate('add_product'); ?>','<?php echo translate('successfully_added!'); ?>','product_add',''); "><?php echo translate('reset');?>
                        </span>
                    </div>

                    <div class="col-md-1">
                        <span class="btn btn-success btn-md btn-labeled fa fa-upload pull-right enterer" onclick="form_submit('product_add','<?php echo translate('product_has_been_uploaded!'); ?>');proceed('to_add');" ><?php echo translate('upload');?></span>
                    </div>

                </div>
            </div>

        </form>
    </div>
</div>

<script src="<?php $this->benchmark->mark_time(); echo base_url(); ?>template/back/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js">
</script>

<script>
    window.preview = function (input) {
        if (input.files && input.files[0]) {
            $("#previewImg").html('');

            $(input.files).each(function () {
                var reader = new FileReader();
                reader.readAsDataURL(this);
                reader.onload = function (e) {
                    console.log(e.target.result);
                    upload_img(e.target.result);
                    // $("#previewImg").append("<div style='float:left;border:4px solid #303641;padding:5px;margin:5px;'><img height='80' src='" + e.target.result + "'></div>");
                }
            });


        }
    }
    function upload_img(img){
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
    "pid": "<?= $rid ?>"
  }
};
var imgUrl = '<?= base_url(); ?>/vendor/product/rimg/<?= $rid ?>';

$.ajax(settings).done(function (response) {
    // alert(response);
    // $('#gimgs_txt').text(old_txt);
    $('.gallary_images').load(imgUrl);
  console.log(response);
});

    }
    function delimg(id){
        var mid = '#gimg_'+id;
        var url = base_url+'vendor/product/delimg/'+id+'?pid=<?= $rid ?>';
        $.ajax({
        url: url,
        type: "get",
        async: true,
        data: { },
        success: function (data) {
            $('.gallary_images').html(data);

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

        $(mid).remove();
    }

    function other_forms(){}

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

    function option_count(type){
        var count = $('#option_count').val();
        if(type == 'add'){
            count++;
        }
        if(type == 'reduce'){
            count--;
        }
        $('#option_count').val(count);
    }

    function set_select(){
        $('.demo-chosen-select').chosen();
        $('.demo-cs-multiselect').chosen({width:'100%'});
    }

    $(document).ready(function() {
        set_select();
        set_summer();
        createColorpickers();
    });

    function other(){
        set_select();
        $('#sub').show('slow');
    }
    function get_cat(id,now){
        $('#sub').hide('slow');
        ajax_load(base_url+'vendor/product/sub_by_cat1/'+id,'sub_cat','other');
    }
    function get_brnd(id){

    }
    function get_sub_res(id){}

    $(".unit").on('keyup',function(){
        $(".unit_set").html($(".unit").val());
    });

    function createColorpickers() {

        $('.demo2').colorpicker({
            format: 'rgba'
        });

    }
        $("#more_option_btn").click(function(){
        option_count('add');
        var co = $('#option_count').val();
        $("#more_additional_options").append(''
            +'<div class="form-group" data-no="'+co+'">'
            +'    <div class="col-sm-4">'
            +'        <input type="text" name="op_title[]" class="form-control required"  placeholder="<?php echo translate('customer_input_title'); ?>">'
            +'    </div>'
            +'    <div class="col-sm-5">'
            +'        <select class="demo-chosen-select op_type required" name="op_type[]" >'
            +'            <option value="">(none)</option>'
            +'            <option value="text">Text Input</option>'
            +'            <option value="single_select">Dropdown Single Select</option>'
            +'            <option value="radio">Radio</option>'
            +'        </select>'
            +'        <div class="col-sm-12 options">'
            +'          <input type="hidden" name="op_set'+co+'[]" value="none" >'
            +'        </div>'
            +'    </div>'
            +'    <input type="hidden" name="op_no[]" value="'+co+'" >'
            +'    <div class="col-sm-2">'
            +'        <span class="remove_it_o rmo btn btn-danger btn-icon btn-circle icon-lg fa fa-times" onclick="delete_row(this)"></span>'
            +'    </div>'
            +'</div>'
        );
        set_select();
    });

    $("#more_btn").click(function(){
        $("#more_additional_fields").append(''
            +'<div class="form-group">'
            +'    <div class="col-sm-4">'
            +'        <input type="text" name="ad_field_names[]" class="form-control required"  placeholder="<?php echo translate('field_name'); ?>">'
            +'    </div>'
            +'    <div class="col-sm-5">'
            +'        <textarea rows="9"  class="summernotes" data-height="100" data-name="ad_field_values[]"></textarea>'
            +'    </div>'
            +'    <div class="col-sm-2">'
            +'        <span class="remove_it_v rms btn btn-danger btn-icon btn-circle icon-lg fa fa-times" onclick="delete_row(this)"></span>'
            +'    </div>'
            +'</div>'
        );
        set_summer();
    });

    function next_tab(){
        $('.nav-tabs li.active').next().find('a').click();
    }
    function previous_tab(){
        $('.nav-tabs li.active').prev().find('a').click();
    }

    $('body').on('click', '.rmo', function(){
        $(this).parent().parent().remove();
    });

    $('body').on('click', '.rmon', function(){
        var co = $(this).closest('.form-group').data('no');
        $(this).parent().parent().remove();
        if($(this).parent().parent().parent().html() == ''){
            $(this).parent().parent().parent().html(''
                +'   <input type="hidden" name="op_set'+co+'[]" value="none" >'
            );
        }
    });

    $('body').on('click', '.rms', function(){
        $(this).parent().parent().remove();
    });

    $("#more_color_btn").click(function(){
        $("#more_colors").append(''
            +'      <div class="col-md-12" style="margin-bottom:8px;">'
            +'          <div class="col-md-10">'
            +'              <div class="input-group demo2">'
            +'                 <input type="text" value="#ccc" name="color[]" class="form-control" />'
            +'                 <span class="input-group-addon"><i></i></span>'
            +'              </div>'
            +'          </div>'
            +'          <span class="col-md-2">'
            +'              <span class="remove_it_v rmc btn btn-danger btn-icon icon-lg fa fa-trash" ></span>'
            +'          </span>'
            +'      </div>'
        );
        createColorpickers();
    });

    $('body').on('click', '.rmc', function(){
        $(this).parent().parent().remove();
    });


    $(document).ready(function() {
        $("form").submit(function(e){
            event.preventDefault();
        });
    });


    const dropArea = document.querySelector(".drop_box"),
  button = dropArea.querySelector("button"),
  dragText = dropArea.querySelector("header"),
  input = dropArea.querySelector("input");
let file;
var filename;

button.onclick = () => {
  input.click();
};

input.addEventListener("change", function (e) {
  var fileName = e.target.files[0].name;
  let filedata = `
    <form action="" method="post">
    <div class="form">
    <h4>${fileName}</h4>
    <button class="btn">Upload</button>
    </div>
    </form>`;
  dropArea.innerHTML = filedata;
});



function myMap() {
var mapProp= {
  center:new google.maps.LatLng(51.508742,-0.120850),
  zoom:12,
};
var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
}
function selecttype(id)
{
    if($('#category').val())
    {
        var pre = $('#category').val()+','+id;
        // alert(pre);
        $('#category').val(pre);

    }
    else{
        $('#category').val(id);
    }
    var url  = base_url+'vendor/product/sub_by_cat1/'+id;
        // alert(url);
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
function preview2(input) {
        // alert('preview2');
        if (input.files && input.files[0]) {
            $("#previewImg2").html('');
            $(input.files).each(function () {
                var reader = new FileReader();
                reader.readAsDataURL(this);
                reader.onload = function (e) {
                    $("#previewImg2").append("<div style='float:left;border:4px solid #303641;padding:5px;margin:5px;'><img height='80' src='" + e.target.result + "'></div>");
                }
            });
        }
    }

    function preview1(input) {
        // alert('preview2');
        if (input.files && input.files[0]) {
            $("#previewImg1").html('');
            $(input.files).each(function () {
                var reader = new FileReader();
                reader.readAsDataURL(this);
                reader.onload = function (e) {
                    $("#previewImg1").append("<div style='float:left;border:4px solid #303641;padding:5px;margin:5px;'><img height='80' src='" + e.target.result + "'></div>");
                }
            });
        }
    }
    function preview3(input) {
        if (input.files && input.files[0]) {
            $("#previewImg3").html('');
            $(input.files).each(function () {
                var reader = new FileReader();
                reader.readAsDataURL(this);
                reader.onload = function (e) {
                    $("#previewImg2").append("<div style='float:left;border:4px solid #303641;padding:5px;margin:5px;'><img height='80' src='" + e.target.result + "'></div>");
                }
            });
        }
    }
</script>



<!--Bootstrap Tags Input [ OPTIONAL ]-->


</div>
