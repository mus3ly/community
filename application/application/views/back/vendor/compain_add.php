
<style type="text/css">
   .tp_bar {
            background-color: #fff;
    box-shadow: 0 2px 0 rgb(0 0 0 / 5%);
    border-bottom-left-radius: 2px;
    border-bottom-right-radius: 2px;
    padding: 0;
    border: 1px solid #ccc;
    margin: 17px 17px 0 0 !important;
    }
</style>
<div id="container">
   <div id="content-container">
       <div class="tp_bar">
            <div class="row ">
   
    <div class="col-md-12" style="padding: 0;">
        <?php
            echo form_open(base_url() . 'vendor/affliate/compain_do_add/', array(
                'class' => 'form-horizontal',
                'method' => 'post',
                'id' => 'bpkg_add',
                'enctype' => 'multipart/form-data'
            ));
        ?>
        
            <!--Panel heading-->

            <div class="panel-body">
                    
                <div class="tab-base">
        
        
                    <!--Tabs Content-->                    
                    <div class="tab-content">

                        <div id="bpkg_details" class="tab-pane fade active in">
        
                          
                          <!--<div class="form-group btm_border">
                                <h4 class="text-thin text-center"><?php echo translate('packge_details'); ?></h4>                            
                            </div>-->
                            <div class="row">
                                <input type="hidden" name="pro_id" value="<?= $_GET['pid'];?>">
                                <div class="col-sm-3 sidegap_box">
                                    <div class="form-group">
                                    <label class="control-label" for="demo-hor-1"><?php echo translate('campaign_title');?></label>
                                    <?php
                                    if(isset($_GET['pid']))
                                    {
                                        $pid = $_GET['pid'];
                                        $title = $this->crud_model->get_type_name_by_id('product', $pid, 'title');
                                    }
                                    ?>
                                        <input type="text" name="title" id="demo-hor-1" value="<?= isset($title)?$title:""; ?>" placeholder="<?php echo translate('campaign_title');?>" class="form-control required">
                                    </div>
                                </div>

                                <div class="col-sm-3 sidegap_box">
                                    <div class="form-group">
                                    <label class="control-label" for="demo-hor-1"><?php echo translate('target_link');?></label>
                                        <input type="text" name="link" id="demo-hor-1" value="<?= isset($pid)?$this->crud_model->product_link($pid):" "; ?>" placeholder="<?php echo translate('target_link');?>" class="form-control required" <?= (isset($pid)?'readonly="true"':''); ?>>
                                    </div>
                                </div>
                                <div class="col-sm-3 sidegap_box">
                                    <div class="form-group">
                                    <label class="control-label" for="demo-hor-1"><?php echo translate('earning_percentage');?></label>
                                         <input type="text" name="percentage" id="demo-hor-1" placeholder="<?php echo translate('earning_percentage');?>" class="form-control required">
                                    </div>
                                </div>
                                <div class="col-sm-3 sidegap_box">
                                    <div class="form-group">
                                    <label class="control-label" for="demo-hor-1"><?php echo translate('campaign_type');?></label>
                                        <select class="form-control" name="compain_type" id="comp_type" onchange="select_type()" required>
                                        <option value="0">Select campaign type</option>
                                        <option value="banner_compain">Banner Campaign</option>
                                        <option value="text_compain">Text Campaign</option>
                                        <option value="video_compain">Video Campaign</option>
                                    </select>
                                    </div>
                                </div> 
                                
                            </div>

                            
                            
                            
                            <div class="row">
                                

                                <div class="comp_details" id="text_compain" style="display:none">
                                    <div class="col-sm-12 sidegap_box">
                                    <div class="form-group">
                                    <label class="control-label" for="demo-hor-1" ><?php echo translate('content');?></label>
                                         <textarea  name="content" class="form-control" placeholder="<?php echo translate('content');?>"></textarea>
                                    </div>
                                </div>
                            
                                    
                                </div>
                                <div class="comp_details" id="video_compain" style="display:none">
                                    <div class="col-sm-12 sidegap_box">
                                    <div class="form-group">
                                    <label class="control-label" for="demo-hor-1">Video link</label>
                                          <textarea  name="video_link" class="form-control" placeholder="<?php echo translate('video_link');?>"></textarea>
                                    </div>
                                </div>

                                    
                                    
                                </div>
                                <div class="comp_details" id="banner_compain" style="display:none">
                                    <div class="col-sm-12 sidegap_box">
                                    <div class="form-group">
                                    <label class="control-label" style="margin-left:10px;" for="demo-hor-1">Banner Image</label>
                                          
                                        <span class="pull-left btn btn-default btn-file"> <?php echo translate('choose_file');?>
                                            <input type="file" name="banner_img" onchange="preview2(this);" id="demo-hor-inputpass" class="form-control">
                                        </span>
                                        <br><br>
                                        <span id="previewImg" >
                                        </span>
                                    
                                    </div>
                                </div>

                                    
                                    
                                </div>
                                
                            </div>
                            
                        </div>
                    </div>
                </div>

               
            </div>
    
            <div class="panel-footer">
                <div class="row">
                    <div class="col-md-12">
                        <span class="btn btn-purple btn-labeled fa fa-refresh pro_list_btn pull-right" 
                            onclick="ajax_set_full('add','<?php echo translate('add_package'); ?>','<?php echo translate('successfully_added!'); ?>','blog_add',''); "><?php echo translate('reset');?>
                        </span>
                        <span class="btn btn-success btn-md btn-labeled fa fa-upload pull-right enterer" onclick="form_submit('bpkg_add','<?php echo translate('compain_has_been_uploaded!'); ?>');proceed('to_add');" ><?php echo translate('upload');?></span>
                    </div>
                    
                    
                    
                </div>
            </div>
    
        </form>
    </div>
</div>

<script src="<?php echo base_url(); ?>template/back/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js">
</script>

<input type="hidden" id="option_count" value="-1">
<script type="text/javascript">
    window.preview = function (input) {
        if (input.files && input.files[0]) {
            $("#previewImg").html('');
            $(input.files).each(function () {
                var reader = new FileReader();
                reader.readAsDataURL(this);
                reader.onload = function (e) {
                    $("#previewImg").append("<div style='float:left;border:4px solid #303641;padding:5px;margin:5px;'><img height='80' src='" + e.target.result + "'></div>");
                }
            });
        }
    }

     $('.delete-div-wrap .close').on('click', function() { 
        var pid = $(this).closest('.delete-div-wrap').find('img').data('id'); 
        var here = $(this); 
        msg = 'Really want to delete this Image?'; 
        bootbox.confirm(msg, function(result) {
            if (result) { 
                 $.ajax({ 
                    url: base_url+''+user_type+'/'+module+'/dlt_img/'+pid, 
                    cache: false, 
                    success: function(data) { 
                        $.activeitNoty({ 
                            type: 'success', 
                            icon : 'fa fa-check', 
                            message : 'Deleted Successfully', 
                            container : 'floating', 
                            timer : 3000 
                        }); 
                        here.closest('.delete-div-wrap').remove(); 
                    } 
                }); 
            }else{ 
                $.activeitNoty({ 
                    type: 'danger', 
                    icon : 'fa fa-minus', 
                    message : 'Cancelled', 
                    container : 'floating', 
                    timer : 3000 
                }); 
            }; 
          }); 
        });

    function other_forms(){}
    
    function set_summer(){
        $('.summernotes').each(function() {
            var now = $(this);
            var h = now.data('height');
            var n = now.data('name');
            now.closest('div').append('<input type="hidden" class="val" name="'+n+'">');
            now.summernote({
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['view', ['codeview', 'help']],
                ],
                height: 500,
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
        $('.demo-chosen-select').chosen();
        $('.demo-cs-multiselect').chosen({width:'100%'});
        $('#sub').show('slow');
        $('#brn').show('slow');
    }
    function get_cat(id){
        $('#brand').html('');
        $('#sub').hide('slow');
        $('#brn').hide('slow');
        ajax_load(base_url+'admin/blog/sub_by_cat/'+id,'sub_cat','other');
        ajax_load(base_url+'admin/blog/brand_by_cat/'+id,'brand','other');
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
    
    
    $("#more_btn").click(function(){
        $("#more_additional_fields").append(''
            +'<div class="form-group">'
            +'    <div class="col-sm-4">'
            +'        <input type="text" name="ad_field_names[]" class="form-control"  placeholder="<?php echo translate('field_name'); ?>">'
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
            +'            <option value="multi_select">Dropdown Multi Select</option>'
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

    function next_tab(){
        $('.nav-tabs li.active').next().find('a').click();                    
    }
    function previous_tab(){
        $('.nav-tabs li.active').prev().find('a').click();                     
    }
    
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
            +'          <div class="col-md-8">'
            +'              <div class="input-group demo2">'
            +'                 <input type="text" value="#ccc" name="color[]" class="form-control" />'
            +'                 <span class="input-group-addon"><i></i></span>'
            +'              </div>'
            +'          </div>'
            +'          <span class="col-md-4">'
            +'              <span class="remove_it_v rmc btn btn-danger btn-icon btn-circle icon-lg fa fa-times" ></span>'
            +'          </span>'
            +'      </div>'
        );
        createColorpickers();
    });                

    $('body').on('click', '.rmc', function(){
        $(this).parent().parent().remove();
    });

    
    function delete_row(e)
    {
        e.parentNode.parentNode.parentNode.removeChild(e.parentNode.parentNode);
    }    
    
    
    $(document).ready(function() {
        $("form").submit(function(e){
            return false;
        });
    });
    window.preview2 = function (input) {
        if (input.files && input.files[0]) {
            $("#previewImg").html('');
            $(input.files).each(function () {
                var reader = new FileReader();
                reader.readAsDataURL(this);
                reader.onload = function (e) {
                    $("#previewImg").append("<div style='float:left;border:4px solid #303641;padding:5px;margin:5px;'><img height='80' src='" + e.target.result + "'></div>");
                }
            });
        }
    }
    function select_type()
    {
        var val = $('#comp_type').val();
        var mid = '#'+val;
        $('.comp_details').each(function(i, obj) {
    $(this).hide();
});
        $(mid).show();
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
    set_summer();
</script>
<style>
    .btm_border{
        border-bottom: 1px solid #ebebeb;
        padding-bottom: 15px;   
    }
</style>

<!--Bootstrap Tags Input [ OPTIONAL ]-->


       </div>
   </div>
</div>