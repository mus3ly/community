<?php


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
            <article class="post-wrap post-single">
              <div class="post-body single-page-body">
                <div class="post-excerpt">
                  <?php 
// 		echo 'nimra';
            foreach($page_items as $item){
            $parts	= json_decode($item['parts'],true); 
                foreach($parts as $row){
                $size		= $row['size'];
                $type		= $row['type'];
                $content	= $row['content'];
                $widget		= $row['widget'];	
        ?>
                <div class="col-md-<?php echo $size; ?>">
                    <?php
                        if($type == 'content'){
                            echo $content;
                        } else if ($type == 'widget')
                        {
                            $widget_set = explode(',',$widget);
                    ?>
                    <div class="row">
                        <?php
						foreach($widget_set as $row2){
                        	echo $this->html_model->widget($row2);
						}
						?>
                    </div>
                    <?php
                        }
                    ?>
                </div>
        <?php
                }
            }
        ?>
                </div>
              </div>
            </article>
            <hr class="page-divider" />
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
