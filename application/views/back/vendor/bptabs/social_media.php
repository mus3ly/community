<div id="social_media">
                        <div class="form-group btm_border ">
                            <?php
                            $old = $row['social_media'];
                            $old = json_decode($old,true);
                            // var_dump($social_media);
                            $img ='';
                            foreach($social_media as $k => $v){
                                $id = $v['id'];
                                // var_dump( $v);
                                // var_dump( $old);
                                
                            if($v['img']){
                               $img = $this->crud_model->get_img($v['img'])->secure_url;
                             } 

                            ?>
                            <div class="row">
                                <div class="col-sm-4 control-label social_image" for="">
                                    <img width="20" height="20" src="<?= $img?>" >
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" name="social_media[<?php echo $v['id']; ?>]" value="<?= isset($old[$v['id']])?$old[$v['id']]:''; ?>" placeholder="<?php echo $v['name']; ?>"
                                           class="form-control ">
                                </div>
                                <div class="col-sm-2"></div>
                                </div>
                                <?php
                                }
                                ?>
                            </div>
                            
                        </div>