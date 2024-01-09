<?php

$pro = array();



if(isset($product_data[0]))
{

    $pro = $product_data[0];

}
$vid = 0;

                            $added_by = json_decode($pro['added_by'], true);

                            if(isset($added_by['type']) && $added_by['type'] == 'vendor')
                            {

                                $vid = $added_by['id'];

                            }
?>
<?php
$othen = array();
                    $this->db->order_by("bpage_sort", "asc");

                    $mods = $this->db->get('modules')->result_array();
                    $ptabs = ($pro['tabs'])?json_decode($pro['tabs'],true):array();
                    foreach($mods as $k=> $v)
                    {
                        if(in_array($v['id'],$ptabs))
                        $othen[] = $v['id'];
                    }
                    
                    ?>
<main class="directory-main">
    <?php
    include "flash.php";
    // die('OKK');
    include "business_card.php";
    ?>
    
    <div class="business-tabs">
      <div class="container">
        <div class="inner_tabs">
          <div class="tabs__box">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link active" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane"
                  type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="true">Profile</button>
              </li>
              <?php
                    $lmod = array();
                    
                    foreach($mods as $k=> $v)
                    {
                        if(in_array($v['id'],$ptabs))
                        {
                        $lmod[] = $v['id'];
                        ?>
                        <li class="nav-item" role="presentation">
                <button class="nav-link" id="tab_m<?= $v['id'] ?>" data-bs-toggle="tab" data-bs-target="#tab_m<?= $v['id'] ?>-pane"
                  type="button" role="tab" aria-controls="tab_m<?= $v['id'] ?>-pane" aria-selected="false"><?= ($v['bpage_text'])?$v['bpage_text']:$v['label']; ?></button>
              </li>
                        <?php
                        }
                    }
                    ?>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="store-tab" data-bs-toggle="tab" data-bs-target="#store-tab-pane"
                  type="button" role="tab" aria-controls="store-tab-pane" aria-selected="false">Store</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews-tab-pane"
                  type="button" role="tab" aria-controls="reviews-tab-pane" aria-selected="false">Reviews</button>
              </li>
            </ul>
          </div>
        </div>
        <div class="tab-content" id="myTabContent">
            <?php
    include "profile_tab.php";
    ?>
        <?php
                    $lmod = array();
                    
                    foreach($mods as $k=> $v)
                    {
                        
                        if(in_array($v['id'],$ptabs))
                        {
                        $lmod[] = $mod_id= $nod_i= $v['id'];
                        ?>
                        <div class="tab-pane fade" id="tab_m<?= $v['id'] ?>-pane" role="tabpanel" aria-labelledby="tab_m<?= $v['id'] ?>" tabindex="0">
                            
            <?php
            include "mod_tab.php";
            ?>
          </div>
                        <?php
                        }
                    }
                    ?>
          <div class="tab-pane fade" id="store-tab-pane" role="tabpanel" aria-labelledby="store-tab" tabindex="0">
            <div class="filter-listings">
              <div class="filter-btns">
                <ul class="filter-tabs">
                  <li>
                    <button class="inner-filter-btn active" data-filter="stab">All Listing</button>
                  </li>
                  <li>
                    <button class="inner-filter-btn" data-filter="directory-filter">Directory</button>
                  </li>
                  <li>
                    <button class="inner-filter-btn" data-filter="shop-filter">Shop</button>
                  </li>
                </ul>
              </div>

              <div class="filter-content">
                <div class="filter-pane active">
                  <div class="listings shop-product">
                    <div class="main_listing" id="list-grid">
                      <div class="row products filter-list list flex-gutters-10">
                          <?php
        //$vid
    $pros = $this->db->get('product')->result_array();
        ?>

        <div class="container ">
            <div class="row">
            <?php
            
            foreach($pros as $sing)

            {
                $arr = json_decode($sing['added_by'],true);
                if(isset($arr['type']) && $arr['type'] == 'vendor' && $arr['id'] == $vid && !in_array($sing['module'],$othen) && !$sing['is_bpage'])
                {
                ?>
                        <?php
                        $mod = $this->db->where('id',$sing['module'])->get('modules')->row();
                        $shop_cls = '';
                        if(isset($mod->store_check) && $mod->store_check)
                        {
                            $shop_cls = 'stab shop-filter';
                        }
                        else
                        {
                            $shop_cls = 'stab directory-filter';
                        }
                        $sing['shop_cls'] = $shop_cls;

                        $this->load->view( 'grid_box', $sing);

                        ?>
                    <?php
                }

            }
            
            ?>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
          
        </div>
      </div>
      <div class="tab-pane fade" id="reviews-tab-pane" role="tabpanel" aria-labelledby="reviews-tab" tabindex="0">
            <div id="reviews" class="reviews-wrapper tab-content__box">

              <div class="container ">

                <div class="clients_box">

                  <h3>Take a look what other clients say</h3>

                  <h4>Would you like to review this business page?</h4>



                </div>
                <div class="add__new_review" id="review_coment">

                  <h3>Add new Review</h3>

                  <form class="" action="<?= base_url('home/add_rate') ?>" id="rform">

                    <input type="hidden" value="<?= $pro['product_id'] ?>" name="pid" id="pid" />

                    <div class='rating-stars'>
                      <ul id='stars'>
                          <?php
                                            $tot = 5;
                                            for($i = 1 ; $i<=$tot;$i++)
                                            {
                                                ?>
                                                <li class='star' title='Poor' data-value='<?= $i ?>' onclick="select_rate(<?= $i ?>)">
                          <i class='fa fa-star fa-fw'></i>
                        </li>
                                                <?php
                                            }
                                            ?>
                      </ul>
                    </div>
                    <input type="hidden" value="0" name="rating" id="rate" />

                    <div class="form-group mb-3">
                      <textarea name="comment" class="form-control" id="" cols="30" rows="5"></textarea>
                    </div>
                    <?php

                    $user = $this->session->userdata('user_id');

                    if($user){

                        ?>

                        <div class=" margin-t4__09f24__G0VVf padding-b6__09f24__hfdiP border-color--default__09f24__NPAKY" style="max-width:100%;text-align:center; width:100%;"><button type="button" class=" css-hv9ohz" onclick="send_rate()" data-activated="false" data-testid="post-button" value="submit" data-button="true"><span class="css-1enow5j" data-font-weight="semibold">Post Review</span></button></div>
                        

                        <?php

                    }else{

                        ?>

                        <div class=" margin-t4__09f24__G0VVf padding-b6__09f24__hfdiP border-color--default__09f24__NPAKY" style="max-width:100%;text-align:center; width:100%;"><a href="<?= base_url('/login_set/login'); ?>"><button type="button"   class=" css-hv9ohz" data-activated="false" data-testid="post-button" value="submit" data-button="true"><span class="css-1enow5j" data-font-weight="semibold">Post Review</span></button></a></div>



                        <?php

                    }

                    ?>
                  </form>

                </div>
                <div class="reviews-grid">
                  <div class="row make_display_block">
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

                                    echo $this->crud_model->rate_html($v['rating']);

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
              </div>
            </div>
          </div>
    </div>
  </main>
  <?php
  $bpage = 1;
  ?>