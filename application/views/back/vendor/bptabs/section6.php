<?php
$checks = array();
if($row['enable_checks'])
{
$checks = json_decode($row['enable_checks']);
}
?>
  <div class="row">
                         <div class="col-md-12">
<div id="about">
                     </div>
                     <div class="form-group btm_border">
                     <div class="col-sm-4"></div>
                     <div class="col-sm-8"></div>
                     <label class="control-label" for="">
                     <?php echo translate('Title');?>
                     </label>
                    <br>
                     <input type="text" name="about_title" class="form-control" value="<?php echo $row['about_title'];?>"
                        placeholder="<?php echo translate('About us')?>"
                        >
                 
                  
                     </div>
                     <div class="form-group btm_border">
                     <div class="col-sm-4"></div>
                     <div class="col-sm-8"></div>
                     <label class="control-label" for="">
                     <?php echo translate(' More Info');?>
                     </label>
                     <textarea  
                        class="form-control" name="about_desc" rows='4' ><?php echo $row['about_desc']; ?></textarea>
                     </div>

                     <div class="form-group btm_border">
                     <label class="control-label" for="demo-hor-11"><?php echo translate('Categories');?></label>
                     <input type="text" name="cats" value="<?= $row['cats']; ?>" data-role="tagsinput" placeholder="<?php echo translate('enter comma (,) to add more');?>" class="form-control">
                     </div>
                     <div class="form-group btm_border">
                     <div class="col-sm-4"></div>
                     <div class="col-sm-8"></div>
                     <label class="control-label" for="">
                     <?php echo translate(' Address');?>
                     </label>
                     <textarea name="about_address"  placeholder="<?php echo translate('Ex. New Yamaha Sports bike in 2020 from Japan')?>"
                        class="form-control" rows='4' ><?php echo $row['about_address']; ?></textarea>

                     </div>
                     <div class="form-group btm_border">
                     <label class="control-label" for="demo-hor-11"><?php echo translate('Opening Time');?></label>
                     <input type="time" name="openig_time" value="<?= date("h:i:s", strtotime( $row['openig_time'])); ?>"  placeholder="<?php echo translate('opening');?>" class="form-control">
                     </div>
                     <div class="form-group btm_border">
                     <label class="control-label" for="demo-hor-11"><?php echo translate('Closing Time');?></label>
                    
                     <input type="time" name="closing_time" value="<?= date("h:i:s", strtotime( $row['closing_time'])); ?>" placeholder="<?php echo translate('closing');?>" class="form-control">
                   
                     </div>
                     </div>
                      </div>
                     