<div class="listings">
              <div class="main_listing" id="list-grid">
                <div class="row products list flex-gutters-10">
                    <?php
        $mid = $v['id'];
        //$vid
    $pros = $this->db->where('module',$mid)->get('product')->result_array();
        ?>
        <?php
        $there = 0;
            foreach($pros as $sing)

            {
                $arr = json_decode($sing['added_by'],true);
                if(isset($arr['type']) && $arr['type'] == 'vendor' && $arr['id'] == $vid)
                {
                    $there = 1;
                ?>

                        <?php

                        echo $this->load->view( 'grid_box', $sing,true);
                        

                        ?>
                    <?php
                }

            }
            if(!$there)
            {
                ?>
                <h2 class="check-later">Please check back later... <br>We'll post some products and services soon!</h2>
                <?php
            }

            ?>
        
                </div>
              </div>
            </div>