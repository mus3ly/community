<div id="checkbox_information" class="tab-pane fade <?= ($active_tab == 'checkbox_information')?"active in":''; ?>">
                                 <div class="form-group btn_border">
                            <h5 style="color: red;padding: 0 89px;">Do not exceed more than 30 characters per entry</h5>
                            <div class="sec-heading">
                                <label>Section Heading</label>  
                                <input class="form-control" name="checkbox_h" value="<?= $row['checkbox_h'] ?>" />
                            </div>
                        </div>
                      <div class="form-group btm_border">
                          <?php
                          if(isset($row['checkbox_xtra_fields']) && !empty($row['checkbox_xtra_fields'])){
                            $x = json_decode($row['checkbox_xtra_fields']);
                            // var_dump($x);
                            foreach( $x as $k => $v){
                          ?>
                          <div class="form-group"> 
                           
                          <div class="col-sm-9 more-data-field">
                            <input type="text" name="checkboxinfo[]" class="moredata form-control" value="<?= $v; ?>" placeholder="Field Name">  
                            </div>
                            
                            <div class="col-sm-2">  
                            <span class="remove_it_v rms btn btn-danger btn-icon btn-circle icon-lg fa fa-times" onclick="delete_row(this)"></span>
                            </div>
                            </div>
                            <?php
                            }
                          }else{
                            ?>
                            <div class="form-group"> 
                          <div class="col-sm-9">    
                            <input type="text" name="checkboxinfo[]" class=" moredata form-control " placeholder="Field Name">    
                            </div>   
                            <div class="col-sm-2">  
                            </div>
                            </div>
                            <?php
                                 }
                            ?>
                         <div id="more_checkbox_fields"></div>                                
                                <div class="col-sm-12">
                                    <h4 class="pull-left pull-center">
                                        <i><?php echo translate('if_you_need_more_field_for_your_product_,_please_click_here_for_more...');?></i>
                                    </h4>
                                    <div id="more_field_btn" class="moredata btn btn-mint btn-labeled fa fa-plus pull-right">
                                    <?php echo translate('add_more_fields');?></div>
                                </div>
                            </div>
                            
                        </div>