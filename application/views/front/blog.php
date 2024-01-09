<?php

die('summery');
$url = base_url('updated/');
 include "header_new.php";
?>
<main>
    <section class="page-section with-sidebar">
      <div class="container">
        <div class="row">
          <!-- SIDEBAR -->
          <!-- /SIDEBAR -->
          <!-- CONTENT -->
          <div class="col-md-12 content" id="content">
               	<?php
                	foreach($product_details as $row){
                	    $img = '';
                	    if(isset($row['comp_cover']) && $row['comp_cover'])
                        {
                            $img = $this->crud_model->size_img($row['comp_cover'],500,500);
                        }
				?>
            <article class="post-wrap post-single">
              <div class="post-media" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="0">
                <img class="img-fluid" src="<?php echo $img; ?>" alt="" />
                <div class="media-overlay"></div>
              </div>

              <div class="post-body" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                <div class="post-header" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                  <h2 class="post-title">
                    <?php echo $row['title']; ?> </h2>
                  <div class="post-meta">
                    <P class="low_me">
                        
                        
                      By
                      <span class="name"><?php echo $row['author']; ?></span> |
                      <span class="date"><?= $newDate = formate_date($row['date']);?></span>
                    </p>
                  </div>
                </div>
                <?php
                var_dump($row);
                ?>
                <div class="post-excerpt">
                    <p>
                        	<?php echo $row['summery']; ?>
                    </p>
                    <p>
                            	<?php echo $row['description']; ?>
                            </p>
                </div>
              </div>
            </article>
            <hr class="page-divider" />
    <?php
					}
				?>
            <div class="row">
              <div class="col-md-12">
              </div>
            </div>
            
          </div>
          <!-- /CONTENT -->
        </div>
      </div>
    </section>
  </main>
  
<?php
 include "footer_new.php";
?>
