
                              <div class="form-group btm_border" >
                     <div class="form-group btm_border">
                                    <div class="col-sm-6">
                                     <div class="row">                                           
                                     <div class="col-md-10 padding_none">                                           
                             <input type="text" class="amnty form-control" id="amnty">
                             </div>
                               <div class="col-md-2 padding_none">                                           
                             <button type="button" class="btn btn-primary" id="amn_btn">Add</button>
                             </div>
                             </div>
                            <div id="add_amn">
                                
                            </div>
                            <hr>
                          
                            <div id="select_amn2">
                                
                        </div>
                               
                            <div class="select_amn" style="display: none;">
                                <?php $exp =  explode(',',$row['amenities']); 
                                foreach($exp as $k=> $v)
                                {
                                    ?>
                                <input type="text"  id="amv_<?= $k ?>" name="amenities[]" value="<?= $v ?>">
                                <?php
                                }
                                
                                ?>
                                
                            </div>
                             
                          </div>
                                </div>
                            </div>
                        