<!DOCTYPE html>
<html lang="en">
<head>
    <?php


    $home_style = $this->db->get_where('ui_settings', array('type' => 'home_page_style'))->row()->value;
    $vendor_system   =  $this->crud_model->get_settings_value('general_settings','vendor_system');
    $physical_system =  $this->crud_model->get_settings_value('general_settings','physical_product_activation');
    $digital_system  =  $this->crud_model->get_settings_value('general_settings','digital_product_activation');
    $description     =  $this->crud_model->get_settings_value('general_settings','meta_description');
    $keywords        =  $this->crud_model->get_settings_value('general_settings','meta_keywords');
    $author          =  $this->crud_model->get_settings_value('general_settings','meta_author');
    $system_name     =  $this->crud_model->get_settings_value('general_settings','system_name');
    $system_title    =  $this->crud_model->get_settings_value('general_settings','system_title');
    $map_api_key     =  $this->crud_model->get_settings_value('general_settings','api_key');
    $revisit_after   =  $this->crud_model->get_settings_value('general_settings','revisit_after');

    $page_title      =  ucfirst(str_replace('_',' ',$page_title));
    // $this->crud_model->check_vendor_mambership();

    if($this->router->fetch_method() == 'product_view' || $this->router->fetch_method() == 'customer_product_view'){
        $keywords    = $product_tags;
        $description = $page_description;
    }

    if($this->router->fetch_method() == 'vendor_profile' || $this->router->fetch_method() == 'vendor'){
        $keywords    = $vendor_tags;
        $description = $page_description;
    }
    ?>
    <title><?php echo $page_title; ?> | <?php echo $system_title; ?></title>
    <?php
    include 'includes/top/index_new.php';
    ?>
    <link type="text/css" rel="stylesheet" href="<?= base_url('html/') ?>css/style.css" />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <!-- includes summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

</head>

<body id="page-name">
<div class="dotted_lines">
    <img src="<?= base_url('html/') ?>images/doted-lines.png" alt="">
</div>
<div class="ellipse">
    <img src="<?= base_url('html/') ?>images/Ellipse.png" width="845px" height="665px" alt="">
</div>
<div class="lines_shape">
    <img src="<?= base_url('html/') ?>images/lines-shape.png" alt="">
</div>
<div class="rounded_box">
    <img src="<?= base_url('html/') ?>images/rounded.png" alt="">
</div>
        <header class="header_wrap">
        
    <div class="container">
        <div class="row">
            <div class="col-sm-2 logobox">
                <a href="<?= base_url(); ?>"><img src="<?= base_url(); ?>template/front/images/logo.webp" aria-label="logo" alt="markethubland" width="100px" height="58px" ></a>
            </div>
            <div class="menubtn" onclick="open_sidebar();">
                <i class="fa fa-bars"></i>
            </div>
            <div class="col-sm-10 navbar_box_items">
                <div class="close_icon">
                    <i class="fa fa-close"></i>
                </div>
                 <?php
                    include FCPATH.'topbar.php';
                ?>
                            <?php
                    if(true){
                        if($_SESSION['vendor_id'])
                        {
                        $link = base_url('vendor/product');
                        }
                        else
                        {
                            $link = base_url('vendor_logup/registration');
                        }
                // <img src="<?= base_url(); template/front/images/plus-icon.png" alt="">        
                    ?>   
                <li><a href="<?= $link; ?>" class="add_listing">Add Listing <i class="fa fa-plus"></i></a></li>
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
         <div class="dropdown_box drodwn3" id="user_dropdonw">
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
                    <li class="padd_right set-pad-tb"><a href="#" class="this-padding"><img class="avatar_img" src="<?= base_url(); ?>template/front/images/login.png" alt=""></a>
                    <div class="dropdown_box dropdowon_color drodwn4">
                            <ul>
                                <li><a href="<?= base_url('login_set/login');?>"> Customer Login</a></li>
                                <li><a href="<?= base_url('home/login_set/registration');?>"> Customer Sign-up</a></li>
                                <li><a href="<?= base_url('vendor');?>"> Vendor Login</a></li>
                                <li><a href="<?= base_url('vendor_logup/registration');?>"> Vendor Sign-up</a></li>
                               
                                
                            </ul>
                        </div>
                        
                    </li>
                         <?php
                    }
                    ?>
                    <li>
                        <div class="flex-col-6 flex-col-lg-auto text-left">
                    <!-- Header shopping cart -->
                    <div class="header-cart" id="cart_modelbox">
                        <div class="cart-wrapper ">
                            <a href="#" class="btn btn-theme-transparent" data-toggle="modal" data-target="#popup-cart">
                                <i class="fa fa-shopping-cart"></i> 
                                <span class="hidden-xs"> 
                                    <span class="cart_num"></span> 
                                    <?php echo translate('item(s)'); ?>
                                
                                </span>  
                                <i class="fa fa-angle-down"></i>
                            </a>
                        </div>
                    </div>
                    <!-- Header shopping cart -->
                </div>
                    </li>
               
                   
                </ul>
               <?php /*?> <ul  class="make_it_left">
                       <li class="padd_right set-pad-tb"><a href="#" class="this-padding">Community Pegs</a>
                    <div class="dropdown_box dropdowon_color drodwn1">
           
                            <ul>
                                                   <?php
                        // die('come');
                        $brands = $this->db->get('category')->result_array();
                $categories =json_decode($this->db->get_where('ui_settings',array('ui_settings_id' => 86))->row()->value,true);
                                            $result=array();
                                            foreach($categories as $row){
                                                if($this->crud_model->if_publishable_category($row)){
                                                    $result[]=$row;
                                                }
                                            }
                                            
                    foreach ($brands as $key => $value) {
                        if(in_array($value['category_id'], $result))
                        {
                            //  echo $value['category_id'];
                        ?>

                                <li><a href="<?= base_url('directory/'.$value['slug']); ?>"><?= $value['category_name'] ?></a></li>
                              <?php
                        }
                    }
                              ?> 
                                
                            </ul>
                        </div>
                        
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
                          $link_class = ( $v['name'] == 'Account' && $login == 'guest' ) ? ' disabled' : '';
                          ?>
                          <li class="set-pad-tb">
                              <a href="<?= base_url().$v['slug']; ?>" class="this-padding<?php echo $link_class; ?>"><b><?= $v['name']?></b>
                          <?php
                          if( count($menu1) || $v['id'] == 12 )
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
                            <div class="dropdown_box dropdowon_color drodwn2 d<?=$v['id']?>">
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
                    if(true){
                        if($_SESSION['vendor_id'])
                        {
                        $link = base_url('vendor/product');
                        }
                        else
                        {
                            $link = base_url('vendor_logup/registration');
                        }
                // <img src="<?= base_url(); template/front/images/plus-icon.png" alt="">        
                    ?>   
                <li><a href="<?= $link; ?>" class="add_listing">Add Listing <i class="fa fa-plus"></i></a></li>
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
         <div class="dropdown_box drodwn3" id="user_dropdonw">
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
                    <li class="padd_right set-pad-tb"><a href="#" class="this-padding"><img class="avatar_img" src="<?= base_url(); ?>template/front/images/login.png" alt=""></a>
                    <div class="dropdown_box dropdowon_color drodwn4">
                            <ul>
                                <li><a href="<?= base_url('login_set/login');?>"> Customer Login</a></li>
                                <li><a href="<?= base_url('home/login_set/registration');?>"> Customer Sign-up</a></li>
                                <li><a href="<?= base_url('vendor');?>"> Vendor Login</a></li>
                                <li><a href="<?= base_url('vendor_logup/registration');?>"> Vendor Sign-up</a></li>
                               
                                
                            </ul>
                        </div>
                        
                    </li>
                         <?php
                    }
                    ?>
                    <li>
                        <div class="flex-col-6 flex-col-lg-auto text-left">
                    <!-- Header shopping cart -->
                    <div class="header-cart" id="cart_modelbox">
                        <div class="cart-wrapper ">
                            <a href="#" class="btn btn-theme-transparent" data-toggle="modal" data-target="#popup-cart">
                                <i class="fa fa-shopping-cart"></i> 
                                <span class="hidden-xs"> 
                                    <span class="cart_num"></span> 
                                    <?php echo translate('item(s)'); ?>
                                
                                </span>  
                                <i class="fa fa-angle-down"></i>
                            </a>
                        </div>
                    </div>
                    <!-- Header shopping cart -->
                </div>
                    </li>
               
                   
                </ul><?php */?>
            </div>



            <div id="mobile_layout " class="hide_on_desk">
                <ul>
                   
                    <li>
                        <div class="flex-col-6 flex-col-lg-auto text-right">
                    <!-- Header shopping cart -->
                    <div class="header-cart" id="cart_modelbox">
                        <div class="cart-wrapper">
                            <a href="#" class="btn btn-theme-transparent" data-toggle="modal" data-target="#popup-cart">
                                <i class="fa fa-shopping-cart"></i> 
                                <span class="hidden-xs"> 
                                    <span class="cart_num"></span> 
                                    <?php echo translate('item(s)'); ?>
                                
                                </span>  
                                <i class="fa fa-angle-down"></i>
                            </a>
                        </div>
                    </div>
                    </div>
                    </li>
               
                   
                </ul>
            </div>
            
        </div>
    </div>
</header>

    <!-- CONTENT AREA -->
    <?php
    // die($page_name);
    ?>
    <div class="content-area" page_name="<?= $page_name?>">
        <?php
        include $page_name.'/index.php';
        ?>
    </div>
    <!-- /CONTENT AREA -->
<!-- /WRAPPER -->

<?php
    include "footer.php";
?>
</div>
<script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://unpkg.com/default-passive-events"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js" integrity="sha512-efUTj3HdSPwWJ9gjfGR71X9cvsrthIA78/Fvd/IN+fttQVy7XWkOAXb295j8B3cmm/kFKVxjiNYzKw9IQJHIuQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.js" integrity="sha512-uE2UhqPZkcKyOjeXjPCmYsW9Sudy5Vbv0XwAVnKBamQeasAVAmH6HR9j5Qpy6Itk1cxk+ypFRPeAZwNnEwNuzQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.4.2/chosen.jquery.min.js" ></script>
<script type="text/javascript">
    
</script>
<?php
include 'script_texts.php';
?>
</body>
</html>
