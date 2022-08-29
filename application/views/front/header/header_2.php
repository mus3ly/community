<div class="dotted_lines">
    <img src="<?= base_url(); ?>template/front/images/doted-lines.png" alt="">
</div>
<div class="ellipse">
    <img src="<?= base_url(); ?>template/front/images/Ellipse.png" alt="">
</div>
<div class="lines_shape">
    <img src="<?= base_url(); ?>template/front/images/lines-shape.png" alt="">
</div>
<div class="rounded_box">
    <img src="<?= base_url(); ?>template/front/images/rounded.png" alt="">
</div>
<style>.arrow-down:before, .arrow-down:after{
   border-right: 2px solid;
    content: '';
    display: block;
    height: 10px;
    margin-top: 5px;
    position: absolute;
    transform: rotate(45deg);
    left: 622px;
    top: 17%;
    width: 0;
    color: #4D4D61;
    font-weight: 300;
}
.arrow-down:after {
    margin: 5px 0px 0px -6px;
    transform: rotate(140deg);
}</style>
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
                    <li><a href="<?= base_url('/directory'); ?>"><b>Directory</b></a></li>
                    <li><a href="#">CHL</a></li>
                    <li>
                        <a href="#" class="arrow-down">Account</a>
                        <div class="dropdown_box">
                            <ul>
                                <li><a href="#">Education</a></li>
                                <li><a class="active" href="#">Travel</a></li>
                                <li><a href="#">Technology</a></li>
                                <li><a href="#">Banking</a></li>
                                <li><a href="#">Pharma</a></li>
                            </ul>
                        </div>
                    </li>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="<?= base_url('vendor_logup/registration'); ?>" class="add_listing">Add Listing <img src="<?= base_url(); ?>template/front/images/plus-icon.png" alt=""></a></li>
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
                                <li><a href="<?= base_url('/home/Logout'); ?>">Settings</a></li>
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
                        <li class="padd_right"><a href="<?= base_url('home/login_set/login'); ?>"><img class="avatar_img" src="<?= base_url(); ?>template/front/images/login.png" alt=""></a>
                        <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</header>