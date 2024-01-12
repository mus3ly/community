
                            <div class="row">
                               
                            <div class="col-sm-4 sidegap_box">
                                <div class="form-group btm_border">
                                    <label class="control-label" for="demo-hor-6">Enter location</label><br>
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
                                  
                                    

                                 