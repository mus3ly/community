<?php
$cat = $this->db->where('category_id',$category)->get('category')->row();
$img = '';
                        if($comp_logo)
                        {
                            $img = $this->crud_model->get_img($comp_logo);
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

                            <div>
                                <?php
                                if($lat && $lng)
                                /*{
                                    ?>
                                    <i onclick="open_marker(<?= $lat, $lng ?>)" class="fa-solid fa-location-dot"></i>

                                    <?php
                                }*/
                                ?>
                            </div>

            <div class="col-sm-4 listingbox item" data-lat="<?= $lat; ?>" data-lng="<?= $lng; ?>">
                <a href="<?php echo $this->crud_model->product_link($product_id); ?>">
                    <div class="hover_listingbox">
                        <img src="<?= $img; ?>" alt="">
                    </div>
                    <div class="hover_box_list">
                        <h4><?= $title ?></h4>
                        <p><?= $slogan; ?></p>
                    </div>
                </a>
            </div>
                      