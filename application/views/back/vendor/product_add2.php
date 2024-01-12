  <?php
$rid = time();
function bubbleSort($arr)
{
    $n = sizeof($arr);
  
    // Traverse through all array elements
    for($i = 0; $i < $n; $i++) 
    {
        // Last i elements are already in place
        for ($j = 0; $j < $n - $i - 1; $j++) 
        {
            // traverse the array from 0 to n-i-1
            // Swap if the element found is greater
            // than the next element
            if ($arr[$j]['sort'] > $arr[$j+1]['sort'])
            {
                $t = $arr[$j];
                $arr[$j] = $arr[$j+1];
                $arr[$j+1] = $t;
            }
        }
    }
    return $arr;
}
$tabs = array();
$tbl = 'listing_tabs';
if($row->is_bpage)
{
    $tbl = 'bpage_tabs1';
    if(isset($_GET['old']))
    {
        $tbl = 'bpage_tabs';
    }

$tabs = $this->db->get($tbl)->result_array();
}


if(isset($row->module) && $row->module)
{
$mod = $this->db->where('id',$row->module)->get('modules')->row();
$this->db->order_by("sort", "asc");
                        $active_tab = 'customer_choice_options';
                        $tabs = $this->db->get($tbl)->result_array();
                        if(isset($mod))
                        {
                            $tab = json_decode($mod->tabs,true);
                            $label = $tab['label'];
                            $sort = $tab['sort'];
                            foreach($tabs as $k=> $v)
                            {
                                $id = $v['id'];
                                if($sort[$id] == 0)
                                {
                                    unset($tabs[$k]);
                                }
                                $tabs[$k]['label'] = $label[$id];
                                $tabs[$k]['sort'] = $sort[$id];
                            }
                            
                        }
                        $ntabs = array();
                        
                        foreach($tabs as $k=> $v)
                        {
                            if($v['sort'])
                            {
                                $ntabs[]= $v;
                            }
                        }
                        $tabs = $ntabs;
                        
                        
                        if(isset($tabs[0]['key']))
                        {
                            $active_tab = $tabs[0]['key'];
                        }
}
$tabs = bubbleSort($tabs);
?>
<div class="container-fluid mobile_res" style="margin-top:70px;margin-left: 150px;">
    <div class="row">
         <?php
        
            $pid = (isset($row->product_id)?$row->product_id:0);
            $row_array = (array)$row;
            $url = base_url() . 'vendor/save_product';
        
            $pid = (isset($row->product_id)?$row->product_id:0);
            if($pid)
            {
                $url = base_url() . 'vendor/save_product/'.$pid;
            }
            echo form_open($url, array(
                'class' => 'form-horizontal position_alert',
                'method' => 'post',
                'id' => 'product_add4',
                'enctype' => 'multipart/form-data'
            ));
            $this->db->where_in('category',explode(',',$row_array['category']));
            $fil_col = $this->db->where('is_filter',1)->get('list_fields')->result_array();
            $rid = $row_array['product_id'];
            // var_dump($fil_col);
            foreach($fil_col as $k=> $v)
            {
                $dvalue = (isset($row_array[$v['tbl_col']])?$row_array[$v['tbl_col']]:$v['dvalue']) ;
                if($dvalue == 'cdate')
{
    $dvalue= formate_date(date('Y-m-d'));
}
                $col = $v['tbl_col'];
                ?>
                <input type="hidden" value="<?= $dvalue?>" name="<?= $v['tbl_col'] ?>" placeholder="<?= $v['label'] ?>" id="<?= $v['tbl_col'] ?>_col" />
                <?php
                
            }
        ?>
        <div class="alert alert-danger alert_red" role="alert" id="product_add4_error" style="display:none;" >
  Please Fill required fields!
</div>
        <input type="hidden" name="rand_id" value="<?= $rid ?>" />
        <div class="row margin-left-50 margin_sm_0">
            <div class="col-md-6 mb-3">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="mb-0 h6">Basic Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <?php
                            if(isset($modules))
                            {
                                ?>
                            
                            <div class="form-group btm_border">
                                <label><?php echo translate('module');?></label>
                                <div class="col-sm-12">
                                    <?php 
                                    echo $this->crud_model->select_html('modules','module','label','add','demo-chosen-select required',(isset($row->module)?$row->module:''),NULL,NULL,NULL); ?>
                                </div>
                            </div>
                            <?php
                            }
                            ?>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Title</label> 
                                    <input type="text" id="title" onkeyup="create_slug('<?= (isset($row->product_id)&& $row->product_id)?$row->product_id:0 ?>')"  class="form-control  required" value="<?= (isset($row->product_id)&& $row->title)?$row->title:'' ?>"
                                        name="title" placeholder=" ">
                                        
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Slug</label>
                                    <input type="text" class="form-control required" id="slug" readonly="true" value="<?= (isset($row->slug)&& $row->slug)?$row->slug:'' ?>" name="slug"
                                        placeholder=" ">
                                        <span>Auto genrate from title</span>
                                </div>
                            </div>

                            <div class="col-md-12"> 
                                <div class="form-group">
                                    <label>Slogan</label>
                                    <input type="text" class="form-control  required" value="<?= (isset($row->slog)&& $row->slug)?$row->slog:'' ?>"
                                        name="slog" placeholder=" ">
                                </div>
                            </div>

                            <div class="col-md-12"> 
                                <div class="form-group">
                                    <label>About Listing</label>
                                    <textarea name="summery" id="summery" class="form-control  required" rows="4" cols="50"><?= (isset($row->summery)&& $row->summery)?$row->summery:'' ?></textarea>
                                </div>
                            </div>
                            <?php
                            if(isset($row->is_bpage) && $row->is_bpage)
                            {
                                ?>
                                <div class="col-md-12">
                                <div class="form-group">
                                    <?php
                                    $comp_cover =  (isset($row->comp_logo
)&& $row->comp_logo
)?$row->comp_logo
:0;
                                    $this->crud_model->img_field(3,$comp_cover);
                                    ?>
                                </div>
                            </div>
                                <?php
                            }
                            ?>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <?php
                                    $comp_cover =  (isset($row->comp_cover
)&& $row->comp_cover
)?$row->comp_cover
:0;
                                    $this->crud_model->img_field(1,$comp_cover);
                                    ?>
                                </div>
                            </div>
                            
                            

                        </div>
                    </div>
                </div>
                <?php
                if(isset($row->is_bpage) && $row->is_bpage)
                {
                ?>
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="mb-0 h6">SEO Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Meta Title</label>
                                    <input type="text" name="seo_title" class="form-control" id="seo_title" value="<?= (isset($row->seo_title)&& $row->seo_title)?$row->seo_title:'' ?>"
                                        name="meta_title" placeholder=" ">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Meta Description</label>
                                    <textarea type="text" class="resize-off form-control" name="seo_description" placeholder=" "><?= (isset($row->seo_description)&& $row->seo_description)?$row->seo_description:'' ?></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label> <?php echo translate('Ad Tags');?> </label>
                                    <input type="text" name="tag" value="
                    						<?= (isset($row->tag)?$row->tag:''); ?>" data-role="tagsinput" placeholder="<?php echo translate('enter comma (,) to add more');?>" class="form-control">
                                </div>
                            </div>
                            

                        </div>
                    </div>


                </div>
                <?php
                }
                ?>
            </div>
            <?php
                $is_bpage = '';
                if($row->is_bpage)
                {
                    $is_bpage = 'uploads/pages/bpage.png';
                }
                if((isset($mod->preview) && $mod->preview) || $is_bpage)
                {
                    $img = $mod->preview;
                    if($is_bpage)
                    {
                        $img = $is_bpage;
                        // var_dump($img);
                    }
                    if($img)
                    {
                        ?>

            <div class="col-md-6  mb-3">
                
                    <div class="card h-100">
                    <div class="card-header">
                        <h5 class="mb-0 h6">Preview</h5>
                    </div>
                    <div class="card-body scroll_img">
                    
                            <img src="<?= base_url($img); ?>">
                    
                    </div>


                </div>
                    
                    <?php
                }
                ?>
                
            </div>
            <?php
                    }
                    else
                    {
                        ?>
                        <div class="col-md-6  mb-3">
                            <div class="card h-100">
                    <div class="card-header">
                        <h5 class="mb-0 h6">SEO Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Meta Title</label>
                                    <input type="text" name="seo_title" class="form-control" id="seo_title" value="<?= (isset($row->seo_title)&& $row->seo_title)?$row->seo_title:'' ?>"
                                        name="meta_title" placeholder=" ">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Meta Description</label>
                                    <textarea type="text" class="resize-off form-control" name="seo_description" placeholder=" "><?= (isset($row->seo_description)&& $row->seo_description)?$row->seo_description:'' ?></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label> <?php echo translate('Ad Tags');?> </label>
                                    <input type="text" name="tag" value="
                    						<?= (isset($row->tag)?$row->tag:''); ?>" data-role="tagsinput" placeholder="
                    						<?php echo translate('enter comma (,) to add more');?>" class="form-control">
                                </div>
                            </div>
                            

                        </div>
                    </div>


                </div>
                            
                        </div>
                        
                        <?php
                    }
                    ?>
        </div>
        <div class="row margin-left-50 sections">
            
            <?php
$row = (array)$row;
            if($tabs)
            {
                ?>
                <h1>Sections</h1>
                <?php
            }
            // var_dump($tabs);
            foreach($tabs as $k=> $v)
            {
                if($v['label'])
                {
                $img_key = $mod->front_view;
                $img = $v['img'];
                $folder = 'tabs';
                        if(isset($row['is_bpage']) && $row['is_bpage'])
                        {
                            $folder = 'bptabs';
                        }
                        $row = (array)$row;
                        $checks = array();
if($row['enable_checks'])
{
$checks = json_decode($row['enable_checks']);
}
                        $filename = dirname(__FILE__).'/'.$folder.'/'.$v['key'].'.php';
                        
                            if (file_exists($filename)) {
                ?>
                <div class="col-md-12 mb-3" id="<?= $v['key'] ?>">
                <div class="card h-100">
                    <div class="card-header" style="display:block;  overflow:hidden;">
                        <div class="col-md-6">
                        <h5 class="mb-0 h6">
                            <?= (isset($v['label'])?$v['label']:'') ?>
                        </h5>
                        <?php
                            if(isset($v['checkb']) && $v['checkb'])
                            {
                                ?>
                                
                            <input type="checkbox" id="" class="tick_check" name="enable_checks[]" onclick='handleClick(this);' value="<?= $v['key'] ?>" class="" <?= (in_array($v['key'],$checks))?"checked":""; ?>/>
                            <span id="<?= $v['key'] ?>_txt">
                            <?= (in_array($v['key'],$checks))?"Untick to show":"Tick to hide"; ?>
                            </span>
                            <?php
                            }
                            ?>
                            </div>
                            <div class="col-md-6" style="text-align: right;">
                            <?php
                            if(isset($v['section_text']) && $v['section_text'])
                            {
                                ?>
                                <h6><?= $v['section_text'] ?></h6>
                                <?php
                            }
                            elseif ($img )
                            {
                                ?>
                                <a href="<?= base_url($img); ?>" target="_blank"><img src="<?= base_url($img); ?>" height="50" weight="50" /></a>
                                <?php
                            }
                            ?>
                            </div>
                    </div>
                    <div class="card-body" id="<?= $v['key'] ?>_section" style="display:<?= (in_array($v['key'],$checks))?"none":"block"; ?>">
                        <?php
                        include $filename;
    
                        ?>
                    </div>
                </div>
            </div>
                <?php
                }
                else
                {
                    var_dump($filename);
                }
            }
            }
            ?>
            
        </div>
    </div>
    <div class="row">
    <div class="col-md-9">

            <div class="panel-footer">
                <div class="row">
                    <div class="col-md-9">
                    </div>
                    <div class="col-md-3 footer_btns">
                        <?php
                        $del = 1;
                    if(isset($row['is_bpage']) && $row['is_bpage'])
                    {
                        $del = 0;
                    }
                    if(isset($row['product_id']))
                    {
                        ?>
                        <a class="btn btn-info btn-md btn-labeled fa fa-upload pull-right" href="<?= base_url($row['slug']); ?>" target="_blank" ><?php echo translate('preview');?></a>
                    <?php
                    }
                    
                    $text = 'save';
                    if(isset($row['status']) && $row['status'] == 'ok')
                    $text = 'update';
                    else if(isset($row['status']) && $row['status'] == 'draft')
                    $text = 'publish';
                    ?>
                    

                        <span class="btn btn-success btn-md btn-labeled fa fa-upload pull-right enterer" onclick="form_submit('product_add4','<?php echo translate('page_has_been_uploaded!'); ?>');" ><?php echo translate($text);?></span>
                    <?php
                    if(isset($row['product_id']) && $del)
                    {
                        ?>
                        <span class="btn btn-danger btn-md btn-labeled fa fa-upload pull-right" onclick="delete_confirm('<?= $row['product_id'] ?>','<?= translate('really_want_to_delete_this?'); ?>');" ><?php echo translate('delete');?></span>
                    <?php
                    }
                    ?>
                    </div>

                </div>
            </div>

        </form>
    </div>
</div>

<script src="<?php $this->benchmark->mark_time(); echo base_url(); ?>template/back/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js">
</script>

<script>
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
        $("#more_additional_options").on('change','.op_type',function(){
        var co = $(this).closest('.form-group').data('no');
        
        if($(this).val() !== 'text' && $(this).val() !== ''){
            $(this).closest('div').find(".options").html(''
                +'    <div class="col-sm-12">'
                +'        <div class="col-sm-12 options margin-bottom-10"></div><br>'
                +'        <div class="btn btn-mint btn-labeled fa fa-plus pull-right add_op">'
                +'        <?php echo translate('add_options_for_choice');?></div>'
                +'    </div>'
            );
        } else if ($(this).val() == 'text' || $(this).val() == ''){
            $(this).closest('div').find(".options").html(''
                +'    <input type="hidden" name="op_set'+co+'[]" value="none" >'
            );
        }
    });
    
    $("#more_additional_options").on('click','.add_op',function(){
        var co = $(this).closest('.form-group').data('no');
        $(this).closest('.col-sm-12').find(".options").append(''
            +'    <div>'
            +'        <div class="col-sm-10">'
            +'          <input type="text" name="op_set'+co+'[]" class="form-control required"  placeholder="<?php echo translate('option_name'); ?>">'
            +'        </div>'
            +'        <div class="col-sm-2">'
            +'          <span class="remove_it_n rmon btn btn-danger btn-icon btn-circle icon-sm fa fa-times" onclick="delete_row(this)"></span>'
            +'        </div>'
            +'    </div>'
        );
    });
    
    $('body').on('click', '.rmo', function(){
        $(this).parent().parent().remove();
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
    var base_url= '<?= base_url(); ?>';
    var user_type= 'vendor';
    var module = 'product';
    var list_cont_func = ' ';
</script>
<script>
            // This sample still does not showcase all CKEditor 5 features (!)
            // Visit https://ckeditor.com/docs/ckeditor5/latest/features/index.html to browse all the features.
            var editor1;
            CKEDITOR.ClassicEditor.create(document.getElementById("editor1"), {
                // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
                toolbar: {
                    items: [
                        'exportPDF','exportWord', '|',
                        'findAndReplace', 'selectAll', '|',
                        'heading', '|',
                        'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript', 'removeFormat', '|',
                        'bulletedList', 'numberedList', 'todoList', '|',
                        'outdent', 'indent', '|',
                        'undo', 'redo',
                        '-',
                        'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                        'alignment', '|',
                        'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', 'htmlEmbed', '|',
                        'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                        'textPartLanguage', '|',
                        'sourceEditing'
                    ],
                    shouldNotGroupWhenFull: true
                },
                // Changing the language of the interface requires loading the language file using the <script> tag.
                // language: 'es',
                list: {
                    properties: {
                        styles: true,
                        startIndex: true,
                        reversed: true
                    }
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
                heading: {
                    options: [
                        { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                        { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                        { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                        { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                        { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                        { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                        { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
                    ]
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
                placeholder: 'Welcome to CKEditor 5!',
                name:'short_description',
                // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-family-feature
                fontFamily: {
                    options: [
                        'default',
                        'Arial, Helvetica, sans-serif',
                        'Courier New, Courier, monospace',
                        'Georgia, serif',
                        'Lucida Sans Unicode, Lucida Grande, sans-serif',
                        'Tahoma, Geneva, sans-serif',
                        'Times New Roman, Times, serif',
                        'Trebuchet MS, Helvetica, sans-serif',
                        'Verdana, Geneva, sans-serif'
                    ],
                    supportAllValues: true
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
                fontSize: {
                    options: [ 10, 12, 14, 'default', 18, 20, 22 ],
                    supportAllValues: true
                },
                // Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
                // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
                htmlSupport: {
                    allow: [
                        {
                            name: /.*/,
                            attributes: true,
                            classes: true,
                            styles: true
                        }
                    ]
                },
                // Be careful with enabling previews
                // https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
                htmlEmbed: {
                    showPreviews: true
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
                link: {
                    decorators: {
                        addTargetToExternalLinks: true,
                        defaultProtocol: 'https://',
                        toggleDownloadable: {
                            mode: 'manual',
                            label: 'Downloadable',
                            attributes: {
                                download: 'file'
                            }
                        }
                    }
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html#configuration
                mention: {
                    feeds: [
                        {
                            marker: '@',
                            feed: [
                                '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes', '@chocolate', '@cookie', '@cotton', '@cream',
                                '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread', '@gummi', '@ice', '@jelly-o',
                                '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding', '@sesame', '@snaps', '@soufflé',
                                '@sugar', '@sweet', '@topping', '@wafer'
                            ],
                            minimumCharacters: 1
                        }
                    ]
                },
                // The "super-build" contains more premium features that require additional configuration, disable them below.
                // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
                removePlugins: [
                    // These two are commercial, but you can try them out without registering to a trial.
                    // 'ExportPdf',
                    // 'ExportWord',
                    'CKBox',
                    'CKFinder',
                    'EasyImage',
                    // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
                    // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
                    // Storing images as Base64 is usually a very bad idea.
                    // Replace it on production website with other solutions:
                    // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
                    // 'Base64UploadAdapter',
                    'RealTimeCollaborativeComments',
                    'RealTimeCollaborativeTrackChanges',
                    'RealTimeCollaborativeRevisionHistory',
                    'PresenceList',
                    'Comments',
                    'TrackChanges',
                    'TrackChangesData',
                    'RevisionHistory',
                    'Pagination',
                    'WProofreader',
                    // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
                    // from a local file system (file://) - load this site via HTTP server if you enable MathType
                    'MathType'
                ]
            }).then( newEditor => {
        editor1 = newEditor;
    } )
    .catch( error => {
        console.error( error );
    } );
            function textarea(){
                $('#editor1').val(editor1.getData());
                
            }
        </script>.



<!--Bootstrap Tags Input [ OPTIONAL ]-->


</div>
