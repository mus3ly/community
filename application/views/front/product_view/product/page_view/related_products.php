<section class="page-section related_pro">
    <div class="container">
        <div class="head__related">
            <h3 class="title">
                        <?php echo translate('related_products');?>
                    </h3>
        </div>
        <div class="recommendation">
                <div class="row">
                    
                    <?php
                        $recommends=$this->crud_model->product_list_set('related',12,$row['product_id']);
                        foreach($recommends as $rec){
                    ?>
                    <div class="col-md-2 col-sm-6 col-xs-6 sidegapp">
                        <div class="recommend_box_1">
                            <a class="link" href="<?php echo $this->crud_model->product_link($rec['product_id']); ?>">
                                <div class="image-box" style="background-image:url('<?php echo $this->crud_model->file_view('product',$rec['product_id'],'','','thumb','src','multi','one'); ?>');background-size:cover; background-position:center;">
                                </div>
                                <h4 class="caption-title " >
                                    <b><?=$rec['title']?></b>
                                </h4>
                                <?php $rating = $this->crud_model->rating($rec['product_id']); ?>
                                <div  class="rateit" data-rateit-value="<?= $rating ?>" data-rateit-ispreset="true" data-rateit-readonly="true"></div>
                                <div class="price clearfix">
                                    <?php if($rec['discount'] > 0){ ?> 
                                        <ins>
                                            <?php echo currency($this->crud_model->get_product_price($rec['product_id'])); ?>
                                        </ins>
                                        <del><?php echo currency($rec['sale_price']); ?></del>
                                    <?php 
                                    }
                                    else{
                                    ?>
                                    <ins>
                                        <?php echo currency($rec['sale_price']); ?>
                                    </ins>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </a>
                        </div>
                    </div>
                    <?php
                        }
                    ?>
                </div>
            </div>
    </div>
</section>