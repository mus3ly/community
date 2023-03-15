    <?php
$vendor_id =json_decode( $pro['added_by']);
$id = $vendor_id->id;
$vendor = $this->db->where('vendor_id', $id)->get('vendor')->row_array();

// get product
$n = $this->db->where('product_id',$vendor['bpage'])->where('is_bpage',1)->get('product')->row_array();
// get product
$t = $vendor['create_timestamp'];
$date = date('F-d-Y', $t);
// var_dump();
if($n['comp_logo'])
                        {
                            $vendorlogo = $this->crud_model->get_img($n['comp_logo']);
                            if(isset($vendorlogo->secure_url))
                            {
                                $vendorlogo = $vendorlogo->secure_url;
                            }

                        }
                        else
                        {
                            $vendorlogo = $this->crud_model->file_view('product',$product_id,'','','thumb','src','multi','one');

                        }    
    ?>
    <div class="right_sec">
        <div class="title_detail">
            <h4 id="user_btn">User Detail</h4>
        </div>
        <div class="middle">
            <div class="img_detaile">
               <img src="<?= $vendorlogo?>" alt="profile image">
            </div>
            <div class="name_section">
                <?php
                echo $vendor['slug'];
                ?>
               <a href="<?= base_url().$n['slug'];?>"> <span id="chang_color"><?= $vendor['company'];?></span></a>
                <div class="Since">
                    
                    <span>Member Since <?php  echo $date;?></span>
                </div>
            </div>
            <div class="img_detaile"></div>
        </div>
        <div class="bottom_section">
            <div class="number_section">
                <span><img src="<?= base_url(); ?>template/front/images/orange-phone.png" alt=""></span><h5><?= $vendor['phone']; ?></h5>
            </div>
            <div class="number_section">
                <span><i class="fa-solid fa-envelope"></i></span><h5><?= $vendor['email']; ?></h5>
            </div>
            <div class="number_section">
                <span><i class="fa-sharp fa-solid fa-location-dot"></i></span><h5><?= $vendor['address1']; ?></h5>
            </div>
        </div>
        <div class="contact_button">
            <button>CONTACT US</button>
        </div>
        <!-- AddToAny BEGIN -->
<div class="a2a_kit a2a_kit_size_32 a2a_default_style">
<a class="a2a_button_facebook"></a>
<a class="a2a_button_twitter"></a>
<a class="a2a_button_pinterest"></a>
<a class="a2a_button_whatsapp"></a>
<a class="a2a_button_linkedin"></a>
</div>
<script async src="https://static.addtoany.com/menu/page.js"></script>
<!-- AddToAny END -->
        
    </div>