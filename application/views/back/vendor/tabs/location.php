
                            <div class="row">
                                <div class="col-sm-3 sidegap_box">
                                <div class="form-group btm_border" style="padding:25px 0 0;">
                                        <label class="control-label" for="demo-hor-1"><?php echo translate('check_this_to_show_on_front');?></label>
                                         <input type="checkbox" id="demoCheckbox" name="checks[]" value="location" class="checkbox_class"  <?= (in_array('location',$checks))?"checked":""; ?>/>
                                        
                                    </div>
                            </div>
                            <div class="col-sm-3 sidegap_box">
                                <div class="form-group btm_border">
                                    <label class="control-label" for="demo-hor-6">Enter location</label>
                                    <input id="searchTextField" type="text" size="50" placeholder="Enter a location" autocomplete="on" runat="server"  style="height: 40px;margin-bottom: 10px;border: 1px solid;border-radius: 7px;padding: 10px;">
                                </div>
                            </div>
                            </div>
                             
                             
                        
                            
                            <div id="googleMap" style="width:100%;height:400px;"></div>
                                      
                                <div class="row" style="font-size: 16px;margin-top: 22px !important;    margin-bottom: 24px !important;">
                                    <div class="col-sm-3 sidegap_box">
                                <div class="form-group btm_border" style="padding:35px 0 0;">
                                    <label class="control-label" for="demo-hor-6">Or Enter Cordinates</label>
                                    
                                </div>
                            </div>
                            <div class="col-sm-3 sidegap_box">
                                <div class="form-group btm_border">
                                    <label class="control-label" for="demo-hor-6">Latitude:</label>
                                    <input type="text" class="form-control required" id="cityLat" value="<?= $row['lat']; ?>" name="lat" / style="border: 1px solid;border-radius: 7px;padding: 5px;"></div>
                                    
                                </div>
                                <div class="col-sm-3 sidegap_box">
                                <div class="form-group btm_border">
                                    <label class="control-label" for="demo-hor-6">Longitude:</label>
                                    <input type="text" class="form-control required"  id="cityLng" value="<?= $row['lng']; ?>" name="lng" / style="border: 1px solid;border-radius: 7px;padding: 5px;"></div>
                                    
                                </div>
                            </div>
                                  
                                    

                                 <div class="row">
                                     <div class="col-sm-3 sidegap_box">
                                <div class="form-group btm_border">
                                    <label class="control-label" for="demo-hor-6"><?php echo translate('business_email');?></label>
                                   <input type="email" name="bussniuss_email" id="demo-hor-6" min='0' step='.01' placeholder="<?php echo translate('business_email');?>" value="<?= $row['bussniuss_email'] ?>" class="form-control required">
                                </div>
                            </div>
                            <div class="col-sm-3 sidegap_box">
                                <div class="form-group btm_border">
                                    <label class="control-label" for="demo-hor-6"><?php echo translate('business_phone');?></label>
                                    <input type="text" name="bussniuss_phone" id="demo-hor-6" min='0' step='.01' placeholder="<?php echo translate('business_phone');?>" value="<?= $row['bussniuss_phone'] ?>" class="form-control required">
                                </div>
                            </div>

                                 </div>
                                   
                            