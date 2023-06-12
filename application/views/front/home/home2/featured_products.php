<div class="verifed_listings">
    <div class="vertical_dot">
        <img src="<?= base_url(); ?>template/front/images/vertical.webp" width="52px" height="97px" alt="">
    </div>
    <div class="container">
        <div class="verify_head">
            <h3>Verified Listings</h3>
            <p>Explore and contact businesses directly with no obligation</p>
            <div class="listing_lines">
                <img src="<?= base_url(); ?>template/front/images/Group.webp" alt="">
            </div>
        </div>
        <div class="row" id="home_p">
        <?php
                    $box_style =6;//  $this->db->get_where('ui_settings',array('ui_settings_id' => 29))->row()->value;
                    $limit = 4;// $this->db->get_where('ui_settings',array('ui_settings_id' => 20))->row()->value;
                    $featured=$this->crud_model->product_list_set('featured',$limit);
                    foreach($featured as $k=> $row){
                        
                        if($k <= 2)
                        {
                        ?>
                        <div class="col-sm-4 fullwidth">
                        <?php
                        
                        echo $this->html_model->product_box($row, 'grid', $box_style);
                        
                        
                        ?>
                        </div>
                        <?php
                        }
                    }
                ?>
        </div>
        <div class="orange_purple">
            <img src="<?= base_url(); ?>template/front/images/arrow-purple.webp" alt="">
        </div>
    </div>
</div>