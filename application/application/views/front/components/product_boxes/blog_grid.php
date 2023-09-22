
<?php
$description = strtolower($description);
// var_dump($is_event);
$time1 = date("H:i:s",strtotime($time1));
$date = date('Y-m-d',strtotime($time1));
 $time = time();
 if($time >=$openig_time && $time <=$closing_time){
  $x = 'Opened';
}
else{
      $x = 'Closed';
}
$ven = array();
$city = '';
$cats = explode(',',$cats);
foreach($cats as $k=> $v)
{
    if(!$v)
    {
        unset($cats[$k]);
    }
}
if($is_bpage)
{
    $arr = json_decode($added_by,true);
    if($arr['type'] == 'vendor')
    {
        $ven = $this->db->where('vendor_id',$arr['id'])->get('vendor')->row_array();
        if(isset($ven['city']) && $ven['city'])
        {
            $c = $this->db->where('cities_id',$ven['city'])->get('cities')->row_array();

            if(isset($c['name'])&& $c['name'])
            {
            $city = $c['name'];
            }
            else
            {
            $city = $ven['city'];
            }
        }
    }
}
$vendor_id =json_decode($added_by);
$id = $vendor_id->id;
$vendor = $this->db->where('vendor_id', $id)->get('vendor')->row_array();
$this->db->where('added_by',$added_by);
$this->db->where('is_bpage',1);
$vendor1 = $this->db->get('product')->row_array();
// get product
$n = $this->db->where('product_id',$vendor['bpage'])->where('is_bpage',1)->get('product')->row_array();
$img = '';
$logo='';
$vendorlogo= '';
// $is_event=1;

                        if($comp_cover)
                        {
                            $img = $this->crud_model->get_img($comp_cover);
                            if(file_exists($img->path))
                            {
                                $img = base_url().$img->path;
                            }
                            else
                            {
                                $img = base_url('default.webp');
                            }

                        }
                        else
                        {
                            $img = base_url('default.webp');

                        }

                          if($n['comp_logo'])
                        {
                            $vendorlogo = $this->crud_model->get_img($n['comp_logo']);
                            if(file_exists($vendorlogo->path))
                            {
                                $vendorlogo = base_url().$vendorlogo->path;
                            }
                            else
                            {
                                $vendorlogo = base_url('default.webp');
                            }

                        }
                        else
                        {
                            $vendorlogo = base_url('default.webp');

                        }


                            if($comp_logo)
                        {
                            $logo = $this->crud_model->get_img($comp_logo);
                            if(file_exists($logo->path))
                            {
                                $logo = base_url().$logo->path;
                            }
                            else
                            {
                                $logo = base_url('default.webp');
                            }

                        }
                        else
                        {
                            $logo = base_url('default.webp');

                        }
     ?>
<div class="col-sm-12 bottom_box">
                                <div class="inner_bottombox">
                                    <div class="top_img">
                                        <div class="rate">
                                            <?php
                   echo $this->crud_model->rate_html($rating_num);
                   ?>
                                        </div>
                                    <img src="<?= $img ?>" alt="">
                                    
                                    </div>
                                    
                                    <div class="sidegapp_bottom">
                                        <!--New code here-->
                                        <h3 class="color_chnage"><?= $title; ?></h3> 
                                        
                                        <?php 
                                        if($is_bpage)
                                        {
                                            ?>
                                            <div class="row">
                                        <div class="col-md-6  pl-0 special_cls car_out">
                                            <div class="list_attributes "><?= get_fields_line($product_id, 1); ?>Cloths</div>
                                            <div class="list_attributes "><?= get_fields_line($product_id, 2); ?>Lahore</div>
                                            </div>
                                            <div class="col-md-6 text-right pr-0 special_cls">
                                            <div class="grid_attributes "><?= get_fields_line($product_id, 3); ?>$400</div>
                                            <div class="grid_attributes "><?= get_fields_line($product_id, 4); ?>Ralph lauren</div>
                                        </div>
                                        </div>
                                            <?php
                                        }
                                        else
                                        { 
                                            ?>
                                            <div class="row">
                                        <div class="col-md-6  pl-0 special_cls car_out">
                                            <div class="grid_attributes "><?= get_fields_line($product_id, 1); ?></div>
                                            <div class="grid_attributes "><?= get_fields_line($product_id, 2); ?></div>
                                            </div>
                                            <div class="col-md-6 text-right pr-0 special_cls">
                                            <div class="grid_attributes "><?= get_fields_line($product_id, 3); ?></div>
                                            <div class="grid_attributes "><?= get_fields_line($product_id, 4); ?></div>
                                        </div>
                                        </div>
                                    <?php
                                        }
                                        ?>
                                        <div class="col-md-12 dec_wrappper p-0">
                                        
                                        <?php

                        if ($slog) {
                            ?>
                            <h2 class=" catch_phrase spacing_catch_p add_mrgn_in"><?= strWordCut($slog, 50); ?> </h2>
                            <?php
                        }
                        ?>
                                        <p><?= strWordCut($description,150); ?></p>
                                        <a href="<?= $this->crud_model->product_link($product_id); ?>" class="color_chnage">Read more ......<img src="images/arrow-right1.png" alt=""></a>
                                    </div>
                                    </div>
                                </div>
                            </div>