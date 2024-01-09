<div class="listings">
              <div class="main_listing" id="list-grid">
                <div class="row products list flex-gutters-10">
                    <?php
        $mid = $v['id'];
        //$vid
    $pros = $this->db->where('module',$mid)->get('product')->result_array();
        ?>
        <?php

            foreach($pros as $sing)

            {
                $arr = json_decode($sing['added_by'],true);
                if(isset($arr['type']) && $arr['type'] == 'vendor' && $arr['id'] == $vid)
                {
                ?>

                        <?php

                        echo $this->load->view( 'grid_box', $sing,true);
                        

                        ?>
                    <?php
                }

            }

            ?>
        
                </div>
              </div>
            </div>