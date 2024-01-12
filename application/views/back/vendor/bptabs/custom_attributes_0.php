<div id="custom_attributes_0" class="tab-pane fade <?= ($active_tab == 'custom_attributes_0')?"active in":''; ?>">
                        <div class="form-group btn_border">
                            <h5 style="color: red;padding: 0 89px;">If more than 30 characters, it will be added to the accordion section</h5>
                        </div>
                      <div class="form-group btm_border">
                          <?php
                          if(isset($row['additional_fields'])){
                        //   $attr = $row['additional_fields'];
                        //   $exp = (explode(",",$attr));
                        //   var_dump($exp);
                        $exp = json_decode($row['additional_fields']);
                        $ex = json_decode($exp->name);
                        $values = json_decode($exp->value);
                        
                          foreach($ex as $k => $v){
                              
                          ?>
                                              <div class="form-group">
                                 <div class="col-sm-4">
                                 <input type="text" name="ad_field_names[]" class="form-control required" readonly="true" value="<?= $v?>"  placeholder="<?php echo translate('field_name'); ?>">
                                 </div>
                                 <div class="col-sm-5">
                                 <?php
                                 $s = $this->db->where('label',trim($v))->get('list_fields')->row();
                                 if($s)
                                 {
                                     $s->val = $values[$k];
                                 $this->load->view('vedit_f',$s);
                                 }
                                 else
                                 {
                                     ?>
                                 <input type="text" rows="9"  class="form-control" data-height="100" name="ad_field_values[]" value="<?= $values[$k]; ?>">
                                 <?php
                                 }
                                 ?>
                                </div>
                                <?php
                                if(!empty($s) && $s->is_required == NULL)
                                {
                                ?>
                                <div class="col-sm-2">
                                <span class="remove_it_v rms btn btn-danger btn-icon btn-circle icon-lg fa fa-times" onclick="delete_row(this)"></span>
                                </div>
                                <?php
                                }
                                ?>
                                </div>
                                <?php
                                              }
                                              }
                                ?>
                                <div id="more_additional_fields"></div>
                                <div class="col-sm-12">
                                    <h4 class="pull-left">
                                        <i><?php echo translate('if_you_need_more_field_for_your_product_,_please_click_here_for_more...');?></i>
                                    </h4>
                                       <div id="more_btn" class="btn btn-mint btn-labeled fa fa-plus pull-right">
                                    <?php echo translate('add_more_fields');?></div>
                                </div>
                                 
                            </div>
                             
                        </div>