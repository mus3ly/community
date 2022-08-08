<?php
$footer_text =  $this->db->get_where('general_settings',array('type' => 'footer_text'))->row()->value;
$footer_category =  $this->db->get_where('general_settings',array('type' => 'footer_category'))->row()->value;
$footer_page =  $this->db->get_where('general_settings',array('type' => 'footer_page'))->row()->value;
$footer_disc =  $this->db->get_where('general_settings',array('type' => 'footer_disc'))->row()->value;
?>
<footer class="footer_warp">
    <div class="container">
        <div class="row">
            <div class="col-sm-4 fotter_logo">
                <a href="#"><img src="<?= base_url(); ?>/template/front/images/logo.png" alt=""></a>
                <p>
                    <?= $footer_text ?>
                </p>
                <div class="footer_search">
                    <input type="input" placeholder="Enter Your Mail" name="">
                    <button type="button">Subscribe</button>
                </div>
            </div>
            <div class="col-sm-3 widget_colum">
                <h4>Community Pegs</h4>
                <ul>
                    <?php
                    $categories=json_decode($footer_category);
                    foreach ($categories as $key => $value) {
                        $row = $this->db->where('category_id',$value)->get('category')->row();
                        
                        if($row)
                        {
                        ?>
                        <li><a href="<?= base_url('home/category/'.$value); ?>"><?= $row->category_name ?></li></a>
                        
                        <?php
                        }
                    }
                    ?>
                </ul>
            </div>
            <div class="col-sm-2 widget_colum">
                <h4>Company Info</h4>
                <ul>
                <?php
                    $categories=json_decode($footer_page);
                    foreach ($categories as $key => $value) {
                        $row = $this->db->where('page_id',$value)->get('page')->row();
                        if($row)
                        {
                        ?>
                        <li><a href="<?= base_url('home/page/'.$value->parmalink); ?>"><?= $row->page_name ?></li></a>
                        <?php
                        }
                    }
                    ?>
                </ul>
            </div>
            <div class="col-sm-2 widget_colum">
                <h4>Discovery</h4>
                <ul>
                    <?php
                    $categories=json_decode($footer_disc);
                    foreach ($categories as $key => $value) {
                        $row = $this->db->where('page_id',$value)->get('page')->row();
                        if($row)
                        {
                        ?>
                        <li><a href="<?= base_url('home/page/'.$value->parmalink); ?>"><?= $row->page_name ?></li></a>
                        <?php
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</footer>