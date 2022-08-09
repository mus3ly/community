<?php
$cat = $this->db->where('category_id',$category)->get('category')->row();
$img = '';
                        if($comp_cover)
                        {
                            $img = $this->crud_model->get_img($comp_cover);
                            if(isset($img->secure_url))
                            {
                                $img = $img->secure_url;
                            }

                        }
                        else
                        {
                            $img = $this->crud_model->file_view('product',$product_id,'','','thumb','src','multi','one');

                        }
                        ?>
                           <div class="item" data-lat="<?= $lat; ?>" data-lng="<?= $lng; ?>">

                            <div>
                                <?php
                                if($lat && $lng)
                                {
                                    ?>
                                    <i onclick="open_marker(<?= $lat, $lng ?>)" class="fa-solid fa-location-dot"></i>

                                    <?php
                                }
                                ?>
                            </div>
                                <a href="<?php echo $this->crud_model->product_link($product_id); ?>">  
                               <div class="strip">
                                    <figure>
                                        <!-- <span class="ribbon off">-40%</span> -->
                                        <img src="<?= $img?>"  class="owl-lazy" alt="" style="opacity: 1;">
                                        <a class="strip_info">
                                            <?php
                                            if(isset($cat->category_name))
                                            {
                                                ?>
                                            <small><?= $cat->category_name ?></small>
                                            <?php
                                            }
                                            ?>
                                            <div class="item_title">
                                                <h3><?php echo $title; ?></h3>
                                                <small>27 Old Gloucester St</small>
                                            </div>
                                        </a>
                                    </figure>
                                    
                                </div>
                                </a>
                           </div>
                        