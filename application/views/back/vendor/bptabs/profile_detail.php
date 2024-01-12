<div id="profile_detail" class="tab-pane fade active in">
                        
                        <div class="row">
                            <div class="col-sm-3 sidegap_box">
                                <div class="form-group btm_border">
                                    <label class="control-label" for="demo-hor-6"><?php echo translate('Name');?></label>
                                    <input type="text" name="name1" id="demo-hor-6" min='0' step='.01' placeholder="<?php echo translate('name');?>" value="<?= $q['name'];?>" class="form-control ">
                                </div>
                            </div>
                            <div class="col-sm-3 sidegap_box">
                                <div class="form-group btm_border">
                                    <label class="control-label" for="demo-hor-6"><?php echo translate('display_name');?></label>
                                    <input type="text" name="company" id="demo-hor-6" min='0' step='.01' placeholder="<?php echo translate('display_name');?>" value="<?= $q['company'];?>" class="form-control ">
                                </div>
                            </div>
                            <div class="col-sm-3 sidegap_box">
                                <div class="form-group btm_border">
                                    <label class="control-label" for="demo-hor-6"><?php echo translate('phone');?></label>
                                    <input type="text" name="pphone" id="demo-hor-6" min='0' step='.01' placeholder="<?php echo translate('phone');?>" value="<?= $q['phone'];?>" class="form-control ">
                                </div>
                            </div>
                            <div class="col-sm-3 sidegap_box">
                                <div class="form-group btm_border">
                                    <label class="control-label" for="demo-hor-6"><?php echo translate('whatsapp_number');?></label>
                                    <input type="text" name="whatsapp_number" id="demo-hor-6" min='0' step='.01' placeholder="<?php echo translate('whatsapp_number');?>" value="<?= $row['whatsapp_number'];?>" class="form-control ">
                                </div>
                            </div>
                            <div class="col-sm-3 sidegap_box">
                                <div class="form-group btm_border">
                                    <label class="control-label" for="demo-hor-6"><?php echo translate('email');?></label>
                                    <input type="email" name="email1" id="demo-hor-6" min='0' step='.01' placeholder="<?php echo translate('email');?>" value="<?= $q['email'] ?>" class="form-control ">
                                </div>
                            </div>
                            <div class="col-sm-3 sidegap_box">
                                <div class="form-group btm_border">
                                    <label class="control-label" for="demo-hor-6"><?php echo translate('address1');?></label>
                                    <input type="text" name="address" id="demo-hor-6" min='0' step='.01' placeholder="<?php echo translate('address');?>" value="<?= $q['address1'] ?>" class="form-control ">
                                </div>
                            </div>
                            <div class="col-sm-3 sidegap_box">
                                <div class="form-group btm_border">
                                    <label class="control-label" for="demo-hor-6"><?php echo translate('address2');?></label>
                                    <input type="text" name="address2" id="demo-hor-6" min='0' step='.01' placeholder="<?php echo translate('address2');?>" value="<?= $q['address2'] ?>" class="form-control ">
                                </div>
                            </div>
                              <?php
                               /*
                                ?>
                             <div class="col-sm-3 sidegap_box">
                                <label class="control-label" for="demo-hor-2"><?php echo translate('bussniss_type');?></label>
                                <div>
                                    <?php
                           $coun = $this->db->where('category_id',$q['cat1'] )->get('category')->row(); 
                           ?>
                                   <input type="text" value="<?= $coun->category_name; ?>" class="form-control" disabled>
                                </div>
                            </div>
              
                             <div class="col-sm-3 sidegap_box">
                                <label class="control-label" for="demo-hor-2"><?php echo translate('main_Business_Category');?></label>
                              <div>
                                    <?php
                           $coun = $this->db->where('category_id',$q['cat2'] )->get('category')->row(); 
                           ?>
                                   <input type="text" value="<?= $coun->category_name; ?>" class="form-control" disabled>
                                </div>
                            </div>
                        
                             <div class="col-sm-3 sidegap_box">
                                <label class="control-label" for="demo-hor-2"><?php echo translate('industry_category');?></label>
                                <div>
                                    <?php
                           $coun = $this->db->where('category_id',$q['cat3'] )->get('category')->row(); 
                           ?>
                                   <input type="text" value="<?= $coun->category_name; ?>" class="form-control" disabled>
                                </div>
                            </div>
                              <?php
                */
                ?>
                            <div class="col-sm-3 sidegap_box">
                                <div class="form-group btm_border">
                    <?php
                    $coun = $this->db->where('countries_id',$q['country'] )->get('countries')->row();
                    // var_dump($coun->name);
                    ?>
                                    <label class="control-label" for="demo-hor-6"><?php echo translate('country');?></label>
                                     <?php echo $this->crud_model->select_html('countries','country','name','edit','demo-chosen-select  select_country',$q['country'],'',NULL,'select_country'); ?>
                                </div>
                            </div>
                             <div class="col-sm-3 sidegap_box">
                                <div class="form-group btm_border">
                                    <label class="control-label" for="demo-hor-6"><?php echo translate('state');?></label>
                                <div  id="stats_select">
                                        <?php echo $this->crud_model->select_html('states','state','name','edit','select_state demo-chosen-select ',$row['state'],'',NULL,'select_state'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3 sidegap_box">
                                <div class="form-group btm_border">
                                    <label class="control-label" for="demo-hor-6"><?php echo translate('city');?></label>
                                    <input type="text" name="city" id="demo-hor-6" min='0' step='.01' placeholder="<?php echo translate('city');?>" value="<?= $q['city'] ?>" class="form-control ">
                                </div>
                            </div>
                           
                      
                            <div class="col-sm-3 sidegap_box">
                                <div class="form-group btm_border">
                                    <label class="control-label" for="demo-hor-6"><?php echo translate('zip_code');?></label>
                                    <input type="text" name="zip_code" id="demo-hor-6" min='0' step='.01' placeholder="<?php echo translate('zip_code');?>" value="<?= $q['zip'] ?>" class="form-control ">
                                </div>
                            </div>
                            <div class="col-sm-3 sidegap_box">
                                <div class="form-group btm_border">
                                    <label class="control-label" for="demo-hor-6"><?php echo translate('Default tab');?></label>
                                    <select name="default_tab" class="form-control ">
                                        <option value="tab_1">Profile</option>
                                        <option value="tab_3">Blog</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                      
                             
                            <!--<div class="form-group btm_border">-->
                            <!--    <label class="col-sm-4 control-label" for="demo-hor-6"><?php echo translate('business_type');?></label>-->
                            <!--    <div class="col-sm-4">-->
                            <!--        <input type="text" name="btype" id="demo-hor-6" min='0' step='.01' placeholder="<?php echo translate('business_type');?>" value="<?= $q['buss_type'] ?>" class="form-control ">-->
                                  
                            <!--    </div>-->
                            <!--</div>-->
                             
                             
                            
                            
                            
                            
                        </div>