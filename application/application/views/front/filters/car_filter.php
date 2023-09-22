<?php
if(isset($type) && $type == 'html')
{
    ?>
<div class="row">
        <div class="col-md-6 p-0">
    <div class="" id="model_outer">  
                            <select id="model_filter" type="model" col="model" name="ad_field_names[]" onchange="update_filter('model','model')" class="form-control required js-example-basic-single" placeholder="eg: Honda, BMW">
                                <option value="0">Select Make</option>
                                                                    <option value="Honda">Honda</option>
                                                                        <option value="mercedes">mercedes</option>
                                                                        <option value="Honda3">Honda3</option>
                                                                </select>
                            </div>
    </div>
        <div class="col-md-6 p-0">
    <input type="number" id="vehicle_Seats_filter" col="seats" rows="9" onkeyup="update_filter('vehicle_Seats','seats')" class="form-control required" placeholder="eg: 7 seater" value="" data-height="100" name="ad_field_values[]">
    </div>
    </div>
    <div class="row">
    <div class="responnsive_modal_to col-md-6 p-0 ">
    <input type="number" id="modal_from_filter" col="modelf" rows="9" onkeyup="update_filter('modal_from','modelf')" class="form-control required" placeholder="eg: Model from" value="" data-height="100" name="ad_field_values[]">
    </div>
    <div class="responnsive_modal_from col-md-6 p-0">
    <input type="number" id="modal_to_filter" col="modelt" rows="9" onkeyup="update_filter('modal_to','modelt')" class="form-control required" placeholder="eg: Model to" value="" data-height="100" name="ad_field_values[]">
    </div>
    </div>
<?php
}
elseif(isset($type) && $type == 'top')
{
    ?>
    <input type="hidden" id="modelf" name="modelf" />
    <input type="hidden" id="modelt" name="modelt" />
    <?php
}
elseif(isset($type) && $type == 'js')
{
    ?>
    <?php
}
?>