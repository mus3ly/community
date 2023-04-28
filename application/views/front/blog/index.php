<?php 

?>
<input type="hidden" value="<?php echo $category; ?>" id="blog_cat" />
<!-- PAGE WITH SIDEBAR -->



<div class="container">
    <div class="row">
    <div class="col-sm-3 sidebarinfos">
        <div class="row">
    <?php
        echo $this->html_model->widget('special_blogs');
    ?>
    </div>
    </div>
    <div class="col-sm-9">
        <div class="accordion_wrp">
    <div class="">
        <div class="accordion">
            <?php
            foreach($blogs as $k => $v){
                // var_dump($v);
            ?>
    <div class="accordion-item">
      <h2 id="accordion-button-1" aria-expanded="false">
          <div class="accordian_wrapper">
          <div class="left_acordians">
          <span class="accordion-title"><?= strWordCut($v['title'],40); ?></span>
          </div>
           <div class="right_acordians"> 
          <span><b>by</b> <?= $v['author'];?></span> 
          <span><?= date("D, d M", strtotime($v['date']));?></span>
          </div>
          </div>
          <span class="icon" aria-hidden="true"></span>
          </h2>
      <div class="accordion-content under_acordn_content">
          <h1><?= $v['title']; ?></h1>
          <div class="row">
              <div class="col-sm-12 col-md-3">
                 <img class="img-sm" style="width:100%; height:auto !important; border:1px solid #ddd;padding:2px; border-radius:2px !important;" src="<?php echo $this->crud_model->file_view('blog',$v['blog_id'],'','','thumb','src','',''); ?>"  />
                
              </div>
              <div class="col-sm-12 col-md-9">
                    <p><?= $v['summery']; ?></p>
                    <p><?= $v['description']; ?></p>
              </div>
          </div>
       
        
      </div>
    </div>
    <?php } ?>
   
  </div>
    </div>
</div>
    </div>
</div>
</div>
<section class="page-section with-sidebar">
    <div class="container">
        <div class="row">
            <!-- SIDEBAR -->
            <?php 
                include 'sidebar.php';
            ?>
            <!-- /SIDEBAR -->
            <!-- CONTENT -->
            <!--<div class="col-md-9 content" id="content">-->
                <!--<div id="blog-content">-->
                <!--</div>-->
            <!--</div>-->
            <!-- /CONTENT -->
        </div>
    </div>
</section>
<!-- /PAGE WITH SIDEBAR -->
<script>
	function get_blogs_by_cat(category){	
		$("#blog-content").load("<?php echo base_url()?>home/blog_by_cat/"+category);
	}
	$(document).ready(function(){
		var category=$('#blog_cat').val();
		get_blogs_by_cat(category);
    });
</script>

<script type="text/javascript">
    const items = document.querySelectorAll(".accordion-item h2");

function toggleAccordion() {
  const itemToggle = this.getAttribute('aria-expanded');
  
  for (i = 0; i < items.length; i++) {
    items[i].setAttribute('aria-expanded', 'false');
  }
  
  if (itemToggle == 'false') {
    this.setAttribute('aria-expanded', 'true');
  }
}

items.forEach(item => item.addEventListener('click', toggleAccordion));



</script>

