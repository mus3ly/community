<div class="row">
    <div class="col=md=12"><label>Select Tabs</label></div>
    <div class="form-group btm_border">
        <?php
        
        $tabs = ($row['tabs'])?json_decode($row['tabs'],true):array();
        ?>
                                <label><?php echo translate('tab_1');?></label>
                                <div class="col-sm-12">
                                    <?php 
                                    echo $this->crud_model->select_html('modules','tabs[0]','label','edit',' ',(isset($tabs[0])?$tabs[0]:''),NULL,NULL,NULL); ?>
                                </div>
                            </div>
    <div class="form-group btm_border">
                                <label><?php echo translate('tab_2');?></label>
                                <div class="col-sm-12">
                                    <?php 
                                    echo $this->crud_model->select_html('modules','tabs[1]','label','edit',' ',(isset($tabs[1])?$tabs[1]:''),NULL,NULL,NULL); ?>
                                </div>
                            </div>
    <div class="form-group btm_border">
                                <label><?php echo translate('tab_3');?></label>
                                <div class="col-sm-12"> 
                                    <?php 
                                    echo $this->crud_model->select_html('modules','tabs[2]','label','edit',' ',(isset($tabs[2])?$tabs[2]:''),NULL,NULL,NULL); ?>
                                </div>
                            </div>
</div>