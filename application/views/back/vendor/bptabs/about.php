<?php
$checks = array();
if($row['enable_checks'])
{
$checks = json_decode($row['enable_checks']);
}
?>
<div id="about">
                     </div>
                     <div class="form-group btm_border">
                     <div class="col-sm-4"></div>
                     <div class="col-sm-8"></div>
                     <label class="col-sm-4 control-label" for="">
                     <?php echo translate('Title');?>
                     </label>
                     <div class="col-sm-6">
                     <input type="text" name="about_title" value="<?php echo $row['about_title'];?>"
                        placeholder="<?php echo translate('About us')?>"
                        class="form-control ">
                     </div>
                     <div class="col-sm-2"></div>
                     </div>
                     <div class="form-group btm_border">
                     <div class="col-sm-4"></div>
                     <div class="col-sm-8"></div>
                     <label class="col-sm-4 control-label" for="">
                     <?php echo translate(' More Info');?>
                     </label>
                     <div class="col-sm-6">
                     <textarea  
                        class="form-control" name="about_desc" rows='4' ><?php echo $row['about_desc']; ?></textarea>
                     </div> 
                     <div class="col-sm-2"></div>
                     </div>
                     <div class="form-group btm_border">
                     <label class="col-sm-4 control-label" for="demo-hor-11"><?php echo translate('Categories');?></label>
                     <div class="col-sm-6">
                     <input type="text" name="cats" value="<?= $row['cats']; ?>" data-role="tagsinput" placeholder="<?php echo translate('enter comma (,) to add more');?>" class="form-control">
                     </div>
                     </div>
                     <div class="form-group btm_border">
                     <div class="col-sm-4"></div>
                     <div class="col-sm-8"></div>
                     <label class="col-sm-4 control-label" for="">
                     <?php echo translate(' Address');?>
                     </label>
                     <div class="col-sm-6">
                     <textarea name="about_address"  placeholder="<?php echo translate('Ex. New Yamaha Sports bike in 2020 from Japan')?>"
                        class="form-control" rows='4' ><?php echo $row['about_address']; ?></textarea>
                     </div>
                     <div class="col-sm-2"></div>
                     </div>
                     <div class="form-group btm_border">
                     <label class="col-sm-4 control-label" for="demo-hor-11"><?php echo translate('Opening Time');?></label>
                     <div class="col-sm-6">
                     <input type="time" name="openig_time" value="<?= date("h:i:s", strtotime( $row['openig_time'])); ?>"  placeholder="<?php echo translate('opening');?>" class="form-control">
                     </div>
                     </div>
                     <div class="form-group btm_border">
                     <label class="col-sm-4 control-label" for="demo-hor-11"><?php echo translate('Closing Time');?></label>
                     <div class="col-sm-6">
                     <input type="time" name="closing_time" value="<?= date("h:i:s", strtotime( $row['closing_time'])); ?>" placeholder="<?php echo translate('closing');?>" class="form-control">
                     </div>
                     </div>
                     </div>