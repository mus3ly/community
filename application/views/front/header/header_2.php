<div class="dotted_lines">
    <img src="<?= base_url(); ?>template/front/images/doted-lines.png" alt="">
</div>
<div class="ellipse">
    <img src="<?= base_url(); ?>template/front/images/Ellipse.png" alt="">
</div>
<div class="lines_shape">
    <img src="<?= base_url(); ?>template/front/images/lines-shape.png" alt="">
</div>


<header class="header_wrap">
    <div class="container">
        <div class="row">
            <div class="col-sm-3 logobox">
                <a href="<?= base_url(); ?>"><img src="<?= base_url(); ?>template/front/images/logo.png" alt=""></a>
            </div>
            <div class="menubtn">
                <i class="fa fa-bars"></i>
            </div>
            <div class="col-sm-9 navbar_box_items">
                <div class="close_icon">
                    <i class="fa fa-close"></i>
                </div>
                <ul>
                    <?php
                    $login = 'guest';
                    
                   
                    if(isset($_SESSION['vendor_id'])){
                        $login = 'vendor';
                    }
                    else if(isset($_SESSION['user_id']))
                    {
                        $login = 'customer';
                    }
                    else{
                        $login = 'guest';
                    }   
                    $menu = $this->db->where('parent', '0')->order_by('sorting', 'asc')->get('menu')->result_array();
                    
                     foreach($menu as $k => $v){
                        $perm = $v['permission']; 
                        $p = explode(",", $perm);
                        if(in_array($login, $p))
                        {
                          $menu1 = $this->db->where('parent', $v['id'])->order_by('sorting', 'asc')->get('menu')->result_array(); 
                          ?>
                          <li><a href="<?= base_url().$v['slug']; ?>"><b><?= $v['name']?></b> 
                          <?php
                          if(count($menu1) || $v['id'] == 12)
                          {
                          ?>
                            <i class="fa fa-angle-down"></i></a>
                          <?php    
                          }
                          ?>
                          
                            <?php
                            if($menu1){
                                // if($v['id'] == 12)
                                // {
                                //  var_dump($menu1);
                                //  die();
                                // }
                            ?>
                            <div class="dropdown_box dropdowon_color">
                            <ul>
                                <?php
                                foreach($menu1 as $k => $v){
                                    $perm = $v['permission']; 
                                    $p = explode(",", $perm);
                                    if(in_array($login, $p))
                                    {
                                ?>
                                <li><a href="<?= base_url().$v['slug']; ?>"><?= $v['name']?></a></li>
                                <?php
                                }
                                }
                                ?>
                            </ul>
                        </div>
                        <?php
                         }
                        ?>
                    </li>
                    <?php
                        }
                     }
                        ?>
                    
                    <?php
                    if(!($_SESSION['vendor_id'])){
                    ?>   
                <li><a href="<?= base_url('vendor_logup/registration'); ?>" class="add_listing">Add Listing <img src="<?= base_url(); ?>template/front/images/plus-icon.png" alt=""></a></li>
                <?php
                }?>
            <?php
                    if ($this->session->userdata('user_login') == "yes") {
                        
                        $user_id = $this->session->userdata('user_id');
                    ?>
                    <li class="padd_right"><a href="<?= base_url('/home/profile'); ?>"><img class="avatar_img" src="
                    <?php
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
         " alt=""></a>
         <div class="dropdown_box" id="user_dropdonw">
                            <ul>
                                <li><a href="<?= base_url('/home/affliate'); ?>">Affliate</a></li>
                                <li><a href="<?= base_url('/home/profile'); ?>">Settings</a></li>
                                <li><a class="active" href="<?= base_url('/home/profile'); ?>">Profile</a></li>
                                <li><a href="<?= base_url('/home/Logout'); ?>">Logout</a></li>
                            </ul>
                        </div>
                    </li>
                    <?php
                    }
                    else
                    {
                    ?>
                    <li class="padd_right"><a href="#"><img class="avatar_img" src="<?= base_url(); ?>template/front/images/login.png" alt=""></a>
                    <div class="dropdown_box dropdowon_color">
                            <ul>
                                <li><a href="<?= base_url('login_set/login');?>"> Customer Login</a></li>
                                <li><a href="<?= base_url('home/login_set/registration');?>"> Customer Sign-up</a></li>
                                <li><a href="<?= base_url('vendor');?>"> Vendor Login</a></li>
                                <li><a href="<?= base_url('vendor_logup/registration');?>"> Vender Sign-up</a></li>
                                <li><a href="<?= base_url();?>"> Create Affiliate Marketing</a></li>
                                <li><a href="<?= base_url();?>"> Join Affiliate Marketing</a></li>
                                <li><a href="<?= base_url();?>"> Login to Affiliate Marketing</a></li>
                                <li><a href="<?= base_url('home/login_set/login');?>">Join Community HubLand</a></li>
                                
                            </ul>
                        </div>
                    </li>
                    <?php
                    }
                    ?>
                   
                </ul>
            </div>
        </div>
    </div>
</header>
