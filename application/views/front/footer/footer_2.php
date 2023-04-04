<?php
$footer_text =  $this->db->get_where('general_settings',array('type' => 'footer_text'))->row()->value;
$footer_category =  $this->db->get_where('general_settings',array('type' => 'footer_category'))->row()->value;
$footer_page =  $this->db->get_where('general_settings',array('type' => 'footer_page'))->row()->value;
$footer_disc =  $this->db->get_where('general_settings',array('type' => 'footer_disc'))->row()->value;
?>
<style type="text/css">

.footer_warp {
    background-color: url(../images/footrer-bg.png), linear-gradient(190deg, #7c22989e, #1b198357);
}
.flgicon i {
    color: #f26122;
    border-radius: 100%;
    width: 50px;
    height: 50px;
    padding: 0;
    font-size: 42px;
    text-align: center;
}
.flgicon {
    text-align: right;
    padding: 0 64px 0 0;
}
.widget_colum h4{margin-top:10px;}
</style>


<footer class="footer_warp">
    <div class="container">
        <div class="row">
            <div class="col-sm-5 col-12 fotter_logo">
                <a href="#"><img src="<?= base_url(); ?>/template/front/images/logo.png" alt=""></a>
                
                <div class="footer_search">
                    <input type="input" placeholder="Enter Your Mail" name="">
                    <button type="button">Contact us</button>
                </div>
                <div class="row">
                    <div class="col-sm-5 left_ftbaner">
                        <img src="https://markethubland.com//template/front/images/footer_btmimg.png" alt="">
                    </div>
                    <div class="col-sm-7 right_ftinfo">
                   <p> <?= $footer_text ?></p>
                    </div>
                </div>
            </div>
            <div class="col-sm-7 col-12">
                <div class="row">  
            <div class="col-sm-5 widget_colum">
                <h4>Community Pegs</h4>
                <div style="display:flex;">
                <ul style="
    margin-right: 30px;
">
                                                   <?php
                        // die('come');
                        $x=0;
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
                            $x++;
                        if($x==7){
                            echo '</ul><ul>';
                        }    
                            //  echo $value['category_id'];
                        ?>

                                <li><a href="<?= base_url('home/category/'.$value['category_id']); ?>"><?= $value['category_name'] ?></a></li>
                              <?php
                        }
                    }
                              ?> 
                                </ul>
                                </div>
                <!--<ul>-->
                    <?php /*
                    $categories=json_decode($footer_category);
                    foreach ($categories as $key => $value) {
                        $row = $this->db->where('category_id',$value)->get('category')->row();
                        
                        if($row)
                        {
                        ?>
                        <li><a href="<?= base_url('home/category/'.$value); ?>"><?= $row->category_name ?></li></a>
                        
                        <?php
                        }
                    }*/
                    ?>
                <!--</ul>-->
            </div>
            <div class="col-sm-4 widget_colum">
                <h4>Company Info</h4>
                <ul>
                    <li><a href="<?= base_url('home/page/Disclaimer'); ?>">Disclaimer</a></li>
                    <li><a href="<?= base_url('home/page/Privacy_Notice'); ?>"> Privacy Policy</a></li>
                    <li><a href="<?= base_url('home/page/Cookie_Policy'); ?>"> Cookie Policy</a></li>
                    <li><a href="<?= base_url('home/page/Terms_Of_Use'); ?>">Terms of Use</a></li>
                    <li><a href="<?= base_url('home/page/affiliate_terms_of_use'); ?>">Affiliate Terms of Use</a></li>
                    <li><a href="<?= base_url('home/page/shop_terms_of_use'); ?>">Shop Terms of Use</a></li>
                      </ul>
                <!--<ul>-->
                <?php /*
                    $categories=json_decode($footer_page);
                    foreach ($categories as $key => $value) {
                        $row = $this->db->where('page_id',$value)->get('page')->row();
                        if($row)
                        {
                        ?>
                        <li><a href="<?= base_url('home/page/'.$row->parmalink); ?>"><?= $row->page_name ?></li></a>
                        <?php
                        }
                    } */
                    ?>
                <!--</ul>-->
            </div>
            <div class="col-sm-3 widget_colum">
                <h4>Discovery</h4>
                  <ul>
                    <li><a href="<?= base_url('home/page/About_Us'); ?>"> About Us</a></li>
                    <li><a href="<?= base_url('home/page/Services'); ?>">Services</a></li>
                    <li><a href="<?= base_url('home/page/career'); ?>">Career</a></li>
                    <li><a href="<?= base_url('home/page/Articles'); ?>">Articles</a></li>
                    
                </ul>
                <!--<ul>-->
                    <?php /*
                    $categories=json_decode($footer_disc);
                    foreach ($categories as $key => $value) {
                        $row = $this->db->where('page_id',$value)->get('page')->row();
                        if($row)
                        {
                        ?>
                        <li><a href="<?= base_url('home/page/'.$row->parmalink); ?>"><?= $row->page_name ?></li></a>
                        <?php
                        }
                    }*/
                    ?>
                <!--</ul>-->
            </div>
            <div class="footerbtn">
             <a href="<?= base_url('vendor_logup/registration'); ?>"><button>SIGN-UP to Add a Listing</button></a>
             <a href="<?= base_url('directory'); ?>"><button>Visit Directory</button></a>
             <a href="<?= base_url('home/login_set/registration'); ?>"><button>Join Our Affiliate Marketing</button></a>
            </div>
            </div>
        </div>
    </div>
    </div>
</footer>

<script>
    $(".flgicon i").click(function(){
        $(".overlaypopup,.popup_box").fadeIn();
    });
    
     $(".close_btn,.overlaypopup").click(function(){
        $(".overlaypopup,.popup_box").fadeOut();
    });

     $("#shareit").click(function(){
        $(".social_mediabox").toggle(500);
    });
</script>

 