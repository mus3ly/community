<div id="seo_section">
                        <div class="form-group btm_border">
                                <div class="col-sm-4"></div>
                                <div class="col-sm-8"><small>*<?php echo translate('Write an seo friendly title within 60 characters')?></small></div>
                                <label class="col-sm-4 control-label" for="">
                                    <?php echo translate('Seo Friendly Title');?>
                                </label>
                                <div class="col-sm-6">
                                    <input type="text" name="seo_title" value="<?php echo $row['seo_title']; ?>"
                                           placeholder="<?php echo translate('Ex. Yamaha RT - Model 2020')?>"
                                           class="form-control ">
                                </div>
                                <div class="col-sm-2"></div>
                            </div>
                            <div class="form-group btm_border">
                                <div class="col-sm-4"></div>
                                <div class="col-sm-8"><small>*<?php echo translate('Write an seo friendly description within 160 characters')?></small></div>
                                <label class="col-sm-4 control-label" for="">
                                    <?php echo translate('Seo Friendly Description');?>
                                </label>
                                <div class="col-sm-6">
                                        <textarea name="seo_description"
                                                  placeholder="<?php echo translate('Ex. New Yamaha Sports bike in 2020 from Japan')?>"
                                                  class="form-control " rows='4' ><?php echo $row['seo_description']; ?></textarea>
                                </div>
                                <div class="col-sm-2"></div>
                            </div>
                            <div class="form-group btm_border">
                                <label class="col-sm-4 control-label" for="demo-hor-11"><?php echo translate(' SEO Tags');?></label>
                                <div class="col-sm-6">
                                    <input type="text" name="tag" value="<?= $row['tag']; ?>" data-role="tagsinput" placeholder="<?php echo translate('enter comma (,) to add more');?>" class="form-control">
                                </div>
                            </div>
                        </div>