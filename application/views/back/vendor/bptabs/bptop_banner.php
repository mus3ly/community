<div class="row">
    <div class="col-md-12">
                                <div class="form-group">
                                    
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <?php
                                    $comp_cover =  (isset($row['comp_cover']
)&& $row['comp_cover']
)?$row['comp_cover']
:0;
                                    $this->crud_model->img_field(1,$comp_cover);
                                    ?>
                                </div>
                            </div>
</div>