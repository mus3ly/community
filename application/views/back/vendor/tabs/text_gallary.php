<div id="text_gallary" class="tab-pane fade <?= ($active_tab == 'text_gallary')?"active in":''; ?>">
                        <div class="col-md-12">
                                    <div id="text_div" >
                                    <?php
                                        if($row['text'])
                                        {
                                            $feature  = json_decode($row['text'],true);
                                            foreach ($feature as $key => $value) {
                                                if($key == 0)
                                                {
                                                    ?>
                                                    <div class="feature_single" >
                                                        <input type="text" class="form-control" value="<?= $value['fhead'] ?>" name="text[0][fhead]" style="width:45%;float:left;" placeholder="Heading" />
                                                        <textarea class="form-control" name="text[0][fdet]" style="width:45%;float:left;" placeholder="Details"><?= $value['fdet'] ?></textarea>
                                                        <button style="width:4px;" class="btn btn-success" onclick="add_text()" >+</buuton>
                                                    </div>
                                                    <?php
                                                }
                                                else{
                                                    ?>
                                                    <div class="feature_single"  id="fid_<?= $key ?>">
                                                        <input type="text" class="form-control" value="<?= $value['fhead'] ?>" name="text[<?= $key ?>][fhead]" style="width:45%;float:left;" placeholder="Heading" />
                                                        <textarea class="form-control" name="text[<?= $key ?>][fdet]" style="width:45%;float:left;" placeholder="Details"><?= $value['fdet'] ?></textarea>
                                                        <button style="width:4px;" class="btn btn-danger" onclick="remove_text('<?= $key; ?>')" >-</buuton>
                                                    </div>
                                              
                                                    <?php
                                                }
                                            }
                                        }
                                        else
                                        {?>
                                        
                                        <div class="feature_single" >
                                            <input type="text" class="form-control" name="text[0][fhead]" style="width:45%;float:left;" placeholder="Heading" />
                                            <textarea class="form-control" name="text[0][fdet]" style="width:45%;float:left;" placeholder="Details"></textarea>
                                            <button style="width:4px;" class="btn btn-success" onclick="add_text()" >+</buuton>
                                        </div>
                                        <?php  
                                        }
                                        ?>
                                        

                                    </div>
                                    </div>
                        </div>