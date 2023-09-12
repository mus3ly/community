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
    <!--NEW-->
    <div class="agent-inner">
                    <div class="agent-title">
                      <div class="agent-photo">
                        <a href="#"><img src="<?= $vendorlogo?>" alt=""></a>
                      </div>
                      <div class="agent-details">
                        <h3><a href="#"><?= $vendor['title']; ?></a></h3>
                        <div class="join-at">
                          <i class="fa fa-clock"></i>June-11-2023
                        </div>
                      </div>
                    </div>
            <?php
            if(isset($vendor['email']) && $vendor['email'])
            {
                ?>
                <div class="contact-box">
                      <i class="fa fa-envelope"></i><a href="#"><?= $vendor['email']; ?></a>
                    </div>
            <?php
            }
            ?>
            <?php
            if(isset($vendor['address1']) && $vendor['address1'])
            {
                ?>
            <div class="contact-box">
                      <i class="fa fa-location-dot"></i><a href="#"><?= $vendor['address1']; ?></a>
                    </div>
            <?php
            }
            ?>
                    <a href="#" class="contact-agent">Contact</a>
                  </div>