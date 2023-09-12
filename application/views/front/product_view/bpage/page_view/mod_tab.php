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
                <ul class="pagination mt-2">

                  <li onclick="set_value('page','1')" class="active"><a>1</a></li>
                  <li onclick="set_value('page','2')" class=" "><a>2</a></li>
                  <li onclick="set_value('page','3')" class=" "><a>3</a></li>
                  <li onclick="set_value('page','2')"><a>></a></li>
                  <li onclick="set_value('page','5')"><a>>></a></li>

                </ul>
              </div>
            </div>