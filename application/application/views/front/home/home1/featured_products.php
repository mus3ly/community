<!-- PAGE -->
<div id="small-categories" class="owl-carousel owl-carousel-icons owl-loaded owl-drag">
                  <div class="owl-stage-outer">
                     <div class="owl-stage" style="transform: translate3d(-3002px, 0px, 0px); transition: all 0.25s ease 0s; width: 4804px;">
                      <?php

          $box_style =  6;//$this->db->get_where('ui_settings',array('ui_settings_id' => 29))->row()->value;

          $limit =  20;

                    $featured = $featured = $this->db->where('featured','ok')->get('product')->result_array();

                    foreach($featured as $k => $row){
                        if($k < 20)
                        {
                          echo ' <div class="owl-item ">';
                    echo $this->html_model->product_box($row, 'grid', $box_style);
                    echo "</div>";
                  }

          }

                ?>
                        
                        
                        
                        
                        
                        
                        
                     </div>
                  </div>
                  <div class="owl-nav">
                     <button type="button" role="presentation" class="owl-prev"><span aria-label="Previous"></span></button>
                     <button type="button" role="presentation" class="owl-next"><span aria-label="Next"></span>
                     </button>
                  </div>
                  <div class="owl-dots disabled"></div>
               </div>
<!-- /PAGE -->