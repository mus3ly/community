<div id="customer_choice_options" `style="overflow:hidden">
                        <input type="hidden" id="category" value="<?= ($row['category'])?$row['category']:""; ?>" name="category"/>
                           <div class="row" id="cat_res">
                                  <div class="breaddcum">
                    <ul>
                        <?php
                         $carr = explode(',',$row['category']);
                         $para2 = $carr[count($carr)-1];
                         $sing = $this->db->where('category_id',$para2)->get('category')->row();
                          $level = $sing->level;
       
            $breed = array();
            
            $cid = $para2;
            for ($i=1; $i <= $level; $i++) { 
             
                 $srow = $this->db->where('category_id',$cid)->get('category')->row_array();
               if(isset($srow) && !empty($srow)){
                   $breed[] = $cid;
                 $cid = $srow['pcat'];
                //  var_dump($cid);
               }
            }
            if($breed)
            {
                ?>
                <div class="breaddcum">
                    <ul>
                        <?php
                        $cat = array();
                        foreach(array_reverse($breed) as $k=> $v)
                        {
                            $cat[] = $v;
                            $crow = $this->db->where('category_id',$v)->get('category')->row();
                            ?>
                            <li><?= $crow->category_name;?></li>
                            <?php
                        }
                        ?>


                    </ul>
                </div>
                <?php
            }
            
            ?>
            


                    </ul>
                </div> 
                <span class="error">To change category of your ad, please delete current ad and recreate ad with new category listing



</span>
                                <div class="col-md-4 col-sm-12 col-xs-12"></div>
                                <div class="col-md-4 col-sm-12 col-xs-12"></div>
                            </div>
                        </div>