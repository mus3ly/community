<style>

    .srch_list{

        

    }

    .srch_list ul{}

    .srch_list ul li{}

    .img_div{

            width: 10%;

    float: left;

    }

    .img_div img{

        width:100%;

    }

    .det_div{

            width: 90%;

    float: right;

    }
    #srch_input {
    margin: 0 0 15px;
    height: 45px;
}
.srch_list ul {
    padding: 0;
    list-style: none;
    max-height: 800px;
    overflow-y: scroll;
}
.srch_list ul li {
    display: block;
    margin: 0;
    position: relative;
    overflow: hidden;
    border-bottom: 1px solid #dfdfdf;
    cursor: pointer;
}
.srch_list ul li:hover {
    background: #f0f0f0;
    transition: all 0.5s ease 0s;
}
.srch_list ul li .img_div {
    width: 8%;
    float: left;
    margin: 10px 0 0 0;
}
.srch_list ul li h1 {
    font-size: 18px;
}
.btn.btn-success.btn-md.btn-labeled.fa.fa-upload.pull-right.enterer{
    margin: 25px 0 0 0;
}
.text-thin {
    font-weight: bold;
    margin: 58px 0 15px;
    display: block;
     color: #000;
}
.text-thin span{
    font-size: 16px;
    font-weight: normal;
}
.srch_list ul li p {
    color: #848080;
}
.form-group.btm_border {
    width: 70%;
    margin: 0 auto;
}
</style>

<div class="form-group btm_border">

                                

                                <h4 class="text-thin text-center">Choose a Product<br>
                                <span>Find the product you are looking for to continue.</span> </h4>                            

                            </div>

                            <?php

            echo form_open(base_url() . 'vendor/product/add1/', array(

                'class' => 'form-horizontal',

                'method' => 'post',

                'id' => 'product_addstep1', 

				'enctype' => 'multipart/form-data'

            ));

        ?>

        <input id="parent_product" type="hidden" name="parent_product" />

                            <div class="form-group btm_border">

                                <div class="col-sm-12">

                                    <div class="col-sm-12">

                                    <input type="text" id="srch_input" class="form-control required" />

                                    <div class="srch_list" >

                                        <ul>

                                        </ul>

                                    </div>

                                </div>

                                </div>

                            </div>

                            </form>

                            <div class="col-md-1">

                        <span class="btn btn-success btn-md btn-labeled fa fa-upload pull-right enterer" onclick="form_submit('product_addstep1','<?php echo translate('product_has_been_uploaded!'); ?>');proceed('to_add');" ><?php echo translate('upload');?></span>

                    </div>

                    <script type="text/javascript">

                            $(document).ready(function() {

        other();

    });

var page = 0;
$('.load_more').click(function(){
    alert("Here");
});
function load_more(txt,url)
{
    alert(txt);
    /*page = url;
    if(txt)
    {
        
        var old_html = $('.srch_list ul').html();

      $('.srch_list ul ').html('Loading...');

      var url = '<?= base_url('vendor/product/srch/'); ?>';

      console.log(url);

     $.get(url,{srh:txt,page:page}, function(data, status){
var new_html = old_html+data;
    $('.srch_list ul').html(old_html);

  });

    //   alert(url);

  }*/
}
    function other(){

        $('.demo-chosen-select').chosen();

        $('.chosen-with-drop').css({width:'100%'});

        // alert();

    }

    $("#srch_input").keyup(function(){

  var txt = $(this).val();

  if(txt.length > 2)

  {

      $('.srch_list ul ').html('Loading...');

      var url = '<?= base_url('vendor/product/srch/'); ?>';

      console.log(url);

     $.get(url,{srh:txt,page:page}, function(data, status){

    $('.srch_list ul').html(data);

  });

    //   alert(url);

  }

});

function select_product(id)

{

    $('#parent_product').val(id);

    form_submit('product_addstep1','<?php echo translate('product_has_been_uploaded!'); ?>');

}



                    </script>