<?php


$menu[]= array('title'=> 'Profile','icon'=> 'bi bi-people','key'=> 'info');
$menu[] = array('title'=> 'Wishlist','icon'=> 'bi bi-box-seam','key'=> 'wishlist');

$menu[] = array('title'=> 'Order History','icon'=> 'bi bi-clock-history','key'=> 'order_history');
$menu[] = array('title'=> 'Affiliate Members','icon'=> 'bi bi-box-seam','key'=> 'rpoints');
$menu[] = array('title'=> 'Edit Profile','icon'=> 'bi bi-people','key'=> 'update_profile');


$url = base_url('updated/');
 include "header_new.php";
?>
<main>
    <section class="dashboard-container">
      <div class="container">
        <div class="row">
          <div class="col-lg-10 col-md-12 order-lg-2">
            <div class="main-wrapper" id="result">
            </div>
          </div>
          <div class="col-lg-2 col-md-12 order-lg-1">
            <div class="user-side">
              <div id="sidebar-wrapper">
                <div class="user-box">
                    <?php
                    $row = $this->db->get_where('user', array('user_id' => $this->session->userdata('user_id')))->row_array();
                    ?>
                  <div class="user-img">
                    <img src="<?php 
                                if(file_exists('uploads/user_image/user_'.$row['user_id'].'.jpg')){ 
                                    echo $this->crud_model->file_view('user',$row['user_id'],'100','100','no','src','','','.jpg').'?t='.time();
                                } else if(empty($row['fb_id']) !== true){ 
                                    echo 'https://graph.facebook.com/'. $row['fb_id'] .'/picture?type=large';
                                } else if(empty($row['g_id']) !== true ){
                                    echo $row['g_photo'];
                                } else {
                                    echo base_url().'uploads/user_image/default.jpg';
                                } 
                            ?>" class="img-fluid" alt="">
                  </div>
                  <div class="texts">
                    <h4 class="user-name"><?php echo $row['username'];?> <?php echo $row['surname'];?></h4>
                    <h5 class="user-title">Member</h5>
                    <a href="<?= base_url('home/logout'); ?>" class="logout">Log Out</a>
                  </div>
                </div>
                <?php
                
                foreach($menu as $k=> $v){
                    ?>
                    <div class="options-box" onclick="load_section('<?= $v['key']; ?>');" id="<?= $v['key']; ?>_item">
                  <div class="options-title <?= (!$k?'active':'') ?>">
                    <i class="<?=$v['icon']?>"></i>
                    <a href="#"><?= $v['title']; ?></a>
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
    </section>

  </main>
<?php
$profile = 1;
 include "footer_new.php";
?>
