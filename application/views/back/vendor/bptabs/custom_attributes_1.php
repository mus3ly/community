<div id="custom_attributes_1" class="tab-pane fade <?= ($active_tab == 'custom_attributes_1')?"active in":''; ?>">
                            <div>
                                <labe>Section Heading</label>
                                <input class="form-control" name="accor_h"  value="<?= $row['accor_h'] ?>" />
                            </div>
                            <?php
                            $acc = $this->db->where('pid',$row['product_id'])->get('product_to_accordion')->result_array();
                                if($acc){
                                    foreach($acc as $k => $v){
                                        ?>
                                    <div class="form-group">
                                        <div class="col-sm-4">
                                            <input type="text" name="ad_field_names_custom[]" class="form-control required"  placeholder="<?php echo translate('field_name'); ?>" value="<?= $v['title']?>">
                                        </div>
                                        <div class="col-sm-5">
                                            <textarea rows="9"  class="summernotes" data-height="100" data-name="ad_field_values_custom[]"><?= $v['detail']; ?></textarea>
                                        </div>
                                
                                    </div>
                                <?php
                                    }
                                    }else{
                                ?>
                        <div class="form-group">
                         <div class="col-sm-4">
                        <input type="text" name="ad_field_names_custom[]" class="form-control required"  placeholder="<?php echo translate('field_name'); ?>" value="<?php echo translate('requirements'); ?>">
                        </div>
                        <div class="col-sm-5">
                         <textarea rows="9"  class="summernotes" data-height="100" data-name="ad_field_values_custom[]" ></textarea>
                            </div>
                    
                        </div>
                        <div class="form-group">
                         <div class="col-sm-4">
                        <input type="text" name="ad_field_names_custom[]" class="form-control required"  placeholder="<?php echo translate('field_name'); ?>" value="<?php echo translate('benefits'); ?>">
                        </div>
                        <div class="col-sm-5">
                         <textarea rows="9"  class="summernotes" data-height="100" data-name="ad_field_values_custom[]" ></textarea>
                            </div>
                    
                        </div>
                        <?php
                                    }
                        ?>
                        <div id="more_fields"></div>
                         <div id="more_btn_attr" class="btn btn-mint btn-labeled fa fa-plus pull-right">
                                    <?php echo translate('add_more_fields');?>
                        </div>    
                        </div>