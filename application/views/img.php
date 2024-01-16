                                        <div class="form-group">
                                    <label><?= (isset($img->label)&& $img->label)?$img->label:''; ?></label><span><?= ($img->detail)?'('.$img->detail.')':'' ?></span>
                                    <br>
                                        <div class="btn btn-default btn-file"> <?php echo translate('choose_');?><?= (isset($img->label)&& $img->label)?$img->label:''; ?>
                                            <input data-id="<?= $media ?>" type="file" value="<?= $media ?>" name="<?= (isset($img->img_key) && $img->img_key)?$img->img_key:''; ?>_file" id="<?= (isset($img->img_key)&& $img->img_key)?$img->img_key:''; ?>"  class="form-control <?= (isset($img->is_required)&& $img->is_required)?'required':''; ?>">
                                        </div>
                                        <div class"img_alert" id="<?= (isset($img->img_key) && $img->img_key)?$img->img_key:''; ?>_alert"></div>
                                        <br>
                                        <input type="hidden" value="<?= $media ?>" id="<?= (isset($img->img_key)&& $img->img_key)?$img->img_key:''; ?>_img" name="<?= (isset($img->img_key)&& $img->img_key)?$img->img_key:''; ?>" />
                                        <span id="<?= (isset($img->img_key)&& $img->img_key)?$img->img_key:''; ?>_box" >

                                            <?php
                                                if($media)
                                                {
                                                    $img = $this->crud_model->size_img($media,100,100);
                                                    ?>
                                                    <div style='float:left;border:4px solid #303641;padding:5px;margin:5px;'><img height='80' src="<?= $img;?>" data-id="_paris/uploads/product" alt="<?= (isset($img->label)&& $img->label)?$img->label:''; ?>"/></div<?php
                                                }
                                            ?>
                                        </span>
                                        </div>