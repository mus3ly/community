<div id="info_section1" class="tab-pane fade ">
                             <div class="form-group btm_border" style="padding-top:30px;">
                                More Details
                                <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('check_this_to_show_on_front');?></label>
                                <div class="col-sm-6">
                                  <input type="checkbox" id="demoCheckbox" name="checks[]" value="extra_info" class="checkbox_class" <?= (in_array('extra_info',$checks))?"checked":""; ?>/>
                                </div>
                            </div>
                        <div class="form-group btm_border">
                                    <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('section_heading');?></label>
                                    <div class="col-sm-6">
                                        <input type="text" name="extra_section_heading" id="demo-hor-1" value="<?php echo $row['extra_section_heading']; ?>" placeholder="<?php echo translate('extra_section_heading');?>" class="form-control ">
                                    </div>
                                </div>
                        <div class="form-group btm_border">
                                    <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('number_of_column');?></label>
                                    <div class="col-sm-6">
                                        <select class="form-control exra_chnge"  name="number_of_column">
                                        <?php
                                        for($i = 1;$i<=3;$i++)
                                        {
                                            ?>
                                            <option value="<?= $i; ?>" <?= (isset($row['number_of_column']) && $row['number_of_column'] == $i)?"selected":""; ?> ><?= $i ?><?= ($i== 1)?"column":"columns" ?></option>
                                            <?php
                                        }
                                        ?>    
                                        </select>
                                        
                                </div>
                                </div>
                                <?php
                                $content = json_decode($row['etra_content'],true);
                                // var_dump($content);
                                ?>
                                <?php
                                
                                        for($i = 0;$i<=2;$i++)
                                        {
                                            
                                            ?>
                                            <div class="form-group btm_border">
                                                <label class="col-sm-4 control-label" for="demo-hor-13"><?php echo translate('column'.($i+1).'_Details'); ?></label>                
                                                <div class="col-sm-6">
                                                    <select class="form-control exra_chnge" id="type_<?= $i ?>" onchange="chcont_type(<?= $i ?>)" name="etra_content[<?= $i ?>][type]">
                                         <option value="0" <?= ($content[$i]['type'] == '0')?"selected":"" ?> >Select content type</option> 
                                         <option value="text" <?= ($content[$i]['type'] == 'text')?"selected":"" ?>>Text</option> 
                                         <option value="img" <?= ($content[$i]['type'] == 'img')?"selected":"" ?>>Image</option>
                                     </select>               
                                            </div>
                                            </div>
                                 <div class="" id="col<?= $i+1 ?>_div" style="display:<?= (($i+1) <= $row['number_of_column'])?"block":"none";?>" >
                                     
                                
                                <div class="" id="text_<?= $i ?>" style="display:<?= (isset($content[$i]['type']) && $content[$i]['type'] == 'text')?"block":"none" ?>">
                                    <textarea rows="9" name="info_desc" id="info_desc"  class="summernotes" data-height="200" data-name="etra_content[<?= $i ?>][data]"><?= (isset($content[$i]))?$content[$i]['data']:"" ?></textarea>
                                </div>
                                <div class="" id="img_<?= $i ?>"  style="display:<?= (isset($content[$i]['type']) && $content[$i]['type'] == 'img')?"block":"none" ?>">
                                    <div class="form-group btm_border">
                                        <label class="col-sm-4 control-label" style="display: block;" for="demo-hor-6">Column <?= $i ?> Image</label>
                                         
                                      <div class="col-sm-6">
                                        <span class="pull-left btn btn-default btn-file"> <?php echo translate('choose_file');?>
                                            <input type="file" name="img_col<?= $i ?>" id="" onchange="preview(this,<?= $i ?>);" id="demo-hor-inputpass" class="form-control">
                                        </span>
                                        </div>
                                        
                                </div>
                                <div class="col-sm-4"></div>
                                <div class="col-sm-6">
                                <span class="img_fix" id="previewImgcol<?= $i ?>" >
                                            <?php
                                                if($content[$i]['data'])
                                                {
                                                    $img = base_url($content[$i]['data']);
                                                    ?>
                                                    <img class="img-responsive" width="500" src="<?= $img?>" data-id="_paris/uploads/product" alt="User_Image"><?php
                                                }
                                            ?>
                                        </span>
                                </div>
                                </div>
                                <?php
                                        }
                                ?>
                             
                        </div>
                        <div id="info_section" class="tab-pane fade ">
                             <div class="form-group btm_border" style="padding-top:30px;">
                                <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('check_this_to_show_on_front');?></label>
                                <div class="col-sm-6">
                                  <input type="checkbox" id="demoCheckbox" name="checks[]" value="more_info" class="checkbox_class" <?= (in_array('more_info',$checks))?"checked":""; ?>/>
                                </div>
                            </div>
                        <div class="form-group btm_border">
                                    <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('info_heading');?></label>
                                    <div class="col-sm-6">
                                        <input type="text" name="info_head" id="demo-hor-1" value="<?php echo $row['info_head']; ?>" placeholder="<?php echo translate('main_heading');?>" class="form-control ">
                                    </div>
                                </div>
                                 <div class="form-group btm_border">
                                <label class="col-sm-4 control-label" for="demo-hor-13"><?php echo translate('description'); ?></label>
                                <div class="col-sm-6">
                                    <textarea rows="9" name="info_desc"  class="summernotes" data-height="200" data-name="info_desc"><?php echo $row['info_desc']; ?></textarea>
                                </div>
                                </div>
                               
                                <div class="form-group btm_border">
                                    <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('Button_text');?></label>
                                <div class="col-sm-6">
                                        <input type="text" class="form-control" value="<?= $row['info_button'] ?>" name="button_txt" style="width:45%;float:left;" placeholder="Heading" />
                                </div>
                                 <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('Button_URL');?></label>
                                 <div class="col-sm-6">
                                        <input type="text" class="form-control" value="<?= $row['button_url'] ?>" name="button_url" style="width:45%;float:left;" placeholder="Url" />     
                                    </div>
                                    </div>
                          
                        </div>
                        <div id="location" class="tab-pane fade ">
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
                                    <input type="text" class="form-control " id="cityLat" value="<?= $row['lat']; ?>" name="lat" / style="border: 1px solid;border-radius: 7px;padding: 5px;"></div>
                                    
                                </div>
                                <div class="col-sm-3 sidegap_box">
                                <div class="form-group btm_border">
                                    <label class="control-label" for="demo-hor-6">Longitude:</label>
                                    <input type="text" class="form-control "  id="cityLng" value="<?= $row['lng']; ?>" name="lng" / style="border: 1px solid;border-radius: 7px;padding: 5px;"></div>
                                    
                                </div>
                            </div>
                                  
                                    

                                 <div class="row">
                                     <div class="col-sm-3 sidegap_box">
                                <div class="form-group btm_border">
                                    <label class="control-label" for="demo-hor-6"><?php echo translate('business_email');?></label>
                                   <input type="email" name="bussniuss_email" id="demo-hor-6" min='0' step='.01' placeholder="<?php echo translate('business_email');?>" value="<?= $row['bussniuss_email'] ?>" class="form-control " disabled>
                                </div>
                            </div>
                            <div class="col-sm-3 sidegap_box">
                                <div class="form-group btm_border">
                                    <label class="control-label" for="demo-hor-6"><?php echo translate('business_phone');?></label>
                                    <input type="text" name="bussniuss_phone" id="demo-hor-6" min='0' step='.01' placeholder="<?php echo translate('business_phone');?>" value="<?= $row['bussniuss_phone'] ?>" class="form-control " disabled>
                                </div>
                            </div>

                                 </div>
                                   
                            
                        </div>
                        <div id="amenitys" class="tab-pane fade <?= ($active_tab == 'amenitys')?"active in":''; ?>">
                              <div class="form-group btm_border" >
                                <label class="col-sm-4 control-label" for="demo-hor-11"><?php echo translate('Add_Amenities');?></label>
                                <div class="col-sm-6 adding_position">
                                    <input type="checkbox" name="checkamenities" value="yes" class="" id="amen_check" <?= isset($row['amen_check']) && 
                                    $row['amen_check'] == 'yes' ?'checked':'';
                                    ?>>
                                </div>
                     <div class="form-group btm_border">
                                    <label class="col-sm-4 control-label" for="demo-hor-1">Select Amenities</label>
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
                        </div>
                        <div id="event_images" class="tab-pane fade ">
                          <div class="form-group btm_border" style="padding-top:30px;">
                                <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('check_this_to_show_on_front');?></label>
                                <div class="col-sm-6">
                                  <input type="checkbox" id="demoCheckbox" name="checks[]" value="event_images" class="checkbox_class" <?= (in_array('event_images',$checks))?"checked":""; ?>/>
                                </div>
                            </div>
                            <div class="form-group btm_border">
                                <label class="col-sm-4 control-label" for="demo-hor-12"><?php echo translate('Title');?></label>
                                <div class="col-sm-6">
                                    <input type="text" name="gtitle" id="demo-hor-1" value="<?php echo  $row['gallery_lable'];?>" placeholder="Gallery Title" class="form-control " >
                                  
                                   
                                </div>
                            </div>
                            <div class="form-group btm_border">
                                <label class="col-sm-4 control-label" for="demo-hor-12"><?php echo translate('Description');?></label>
                                <div class="col-sm-6">
                                    <input type="text" name="gdesc" id="demo-hor-1" value="<?php echo  $row['gallery_text'];?>" placeholder="Gallery Description" class="form-control " >
                                  
                                   
                                </div>
                            </div>
                            <div class="form-group btm_border">
                                <label class="col-sm-4 control-label" for="demo-hor-12"><?php echo translate('images');?></label>
                                <div class="col-sm-6">
                                    <span class="pull-left btn btn-default btn-file" id="gimgs_txt"> <?php echo translate('choose_file');?>
                                        <input type="file" name="images[]" onchange="preview(this);" id="gimgs" class="form-control">
                                    </span>
                                    <br><br>
                                    <span id="previewImg" ></span>
                                    <br><br>
                                    <div class="gallary_images">
                                        <ul>
                                        <?php
                                        $this->db->order_by("id", "desc");
                                        $imgs = $this->db->where('pid',$row['product_id'])->get('product_to_images')->result_array();
                                        foreach ($imgs as $key => $value) {
                                            $img = $this->crud_model->size_img($value['img'],100,100);
                                            ?>
                                            <li id="gimg_<?= $value['id']; ?>">
                                                <div onclick="delimg('<?= $value['id']; ?>')" class="del_icon">
                                                    <i class="fa-solid fa-xmark"></i>
                                                </div>
                                                <img src="<?= $img ?>"/>
                                                </li>
                                                

                                            <?php
                                        }
                                        ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="text_gallary" class="tab-pane fade ">text_gallary</div>
                        <!--<div id="general" class="tab-pane fade ">
                        <div class="form-group btm_border">
                                <label class="col-sm-4 control-label" for="demo-hor-11"><?php echo translate('tags');?></label>
                                <div class="col-sm-6">
                                    <input type="text" name="tag" data-role="tagsinput" placeholder="<?php echo translate('tags');?>" value="<?php echo $row['tag']; ?>" class="form-control">
                                </div>
                            </div>
                            
                            <div class="form-group btm_border">
                                <label class="col-sm-4 control-label" for="demo-hor-13"><?php echo translate('description'); ?></label>
                                <div class="col-sm-6">
                                    <textarea rows="9" name="description"  class="summernotes" data-height="200" data-name="description"><?php echo $row['description']; ?></textarea>
                                </div>
                            </div>

                            <div class="form-group btm_border">
                                <div class="col-sm-4"></div>
                                <div class="col-sm-8"><small>*<?php echo translate('Write an seo friendly title within 60 characters')?></small></div>
                                <label class="col-sm-4 control-label" for="">
                                    <?php echo translate('Seo Friendly Title');?>
                                </label>
                                
                            
                            <div id="more_additional_fields"></div>
                            <div class="form-group btm_border">
                                <label class="col-sm-4 control-label" for="demo-hor-inputpass"></label>
                                            <span class="btn btn-purple btn-labeled fa fa-hand-o-right pull-right" onclick="next_tab()"><?php echo translate('next'); ?></span>
                <span class="btn btn-purple btn-labeled fa fa-hand-o-left pull-right" onclick="previous_tab()"><?php echo translate('previous'); ?></span>
                            </div>
                            

                        </div>-->
                        <div id="event_images" class="tab-pane fade ">
        
                             <div class="form-group btm_border" style="padding-top:30px;">
                                <label class="col-sm-4 control-label" for="demo-hor-1"><?php echo translate('check_this_to_show_on_front');?></label>
                                <div class="col-sm-6">
                                  <input type="checkbox" id="demoCheckbox" name="checks[]" value="gallery_image" class="checkbox_class" <?= (isset($checks) && in_array('gallery_image', $checks))?"checked":""?>/>
                                </div>
                            </div>

                            <div class="form-group btm_border">
                                <label class="col-sm-4 control-label" for="demo-hor-13"></label>
                                <div class="col-sm-6">
                                    <?php 
                                        $images = $this->crud_model->file_view('product',$row['product_id'],'','','thumb','src','multi','all');
                                        if($images && $num_of_imgs){
                                            foreach ($images as $row1){
                                                $a = explode('.', $row1);
                                                $a = $a[(count($a)-2)];
                                                $a = explode('_', $a);
                                                $p = $a[(count($a)-2)];
                                                $i = $a[(count($a)-3)];
                                    ?>
                                        <div class="delete-div-wrap">
                                            <span class="close">&times;</span>
                                            <div class="inner-div">
                                                <img class="img-responsive" width="100" src="<?php echo $row1; ?>" data-id="<?php echo $i.'_'.$p; ?>" alt="User_Image" >
                                            </div>
                                        </div>
                                    <?php 
                                            }
                                        } 
                                    ?>
                                </div>
                            </div>

                        </div>
                            </div>