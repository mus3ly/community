
<?php
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
                                        <div class="row sidegapp_bottom_2 ">
                                            <div class="col-md-6 pdg_rmv"><h5><?= get_fields_line($product_id, 1); ?></h5></div>
                                            <div class="col-md-6 pdg_rmv text_right"><h5><?= get_fields_line($product_id, 2); ?></h5></div>
                                            <div class="col-md-6 pdg_rmv"><h5><?= get_fields_line($product_id, 3); ?></h5></div>
                                            <div class="col-md-6 pdg_rmv text_right"><h5><?= get_fields_line($product_id, 4); ?></h5></div>
                                        </div>
                                        <div class="">
                                        <h3 class="color_chnage"><?= $title; ?></h3> 
                                        <p><?= strWordCut($description,100); ?></p>
                                        <a href="<?= $this->crud_model->product_link($product_id); ?>" class="color_chnage">Read more ......<img src="images/arrow-right1.png" alt=""></a>
                                    </div>
                                    </div>
                                </div>
                            </div>