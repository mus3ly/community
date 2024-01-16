<style>
  @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap');
  
  *{
      font-family: 'Roboto', sans-serif;
  }
  .share_icon{
          position: absolute;
    top: 8px;
    right: 15px;
    font-size: 20px;
    cursor: pointer;
  }
 
</style>
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
                    <div class="post-media">
                        <img class="img-responsive" src="<?php echo $img; ?>" alt=""/>
                    </div>
                    
                    <div class="buttons">
                        <div id="share"></div>
                    </div>
                    <div class="post-body">
                        <div class="post-header aos-init aos-animate" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                  <h2 class="post-title"><?php echo $row['title']; ?></h2>
                  <div class="post-meta">
                    <p class="low_me">
                      By
                      <span class="name"><?php echo $row['author']; ?> </span> |
                      <span class="date"><?=($row['update_at'] > $row['posted_on'])?'Updated at ':'Posted at ' ?><?php
                        $newDate = formate_date($row['posted_on']);
                        if($row['update_at'] > $row['posted_on'])
                        {
                            $newDate = formate_date($row['update_at']);
                        }
                        else
                        {
                            $newDate = formate_date($row['create_at']);
                        }
                        echo $newDate;
                        
                        ?></span>
                      <a href="#" style="margin-left: 5px;" onclick="share_icon('<?= $product_id ?>')"><i class="bi bi-share"></i></a>
                    </p>
                  </div>
                </div>
                        <div class="post-excerpt">
                            <br>
                            <p>
                            	<?php echo $row['description']; ?>
                            </p>
                        </div>
                    </div>
                </article>
               <hr class="page-divider"/>
                <?php
					}
				?>
                <div class="row">
                	<div class="col-md-12">
                		<?php
							$discus_id = $this->db->get_where('general_settings',array('type'=>'discus_id'))->row()->value;
							$fb_id = $this->db->get_where('general_settings',array('type'=>'fb_comment_api'))->row()->value;
							$comment_type = $this->db->get_where('general_settings',array('type'=>'comment_type'))->row()->value;
						?>
						<?php if($comment_type == 'disqus'){ ?>
                        <div id="disqus_thread"></div>
                        <script type="text/javascript">
                            /* * * CONFIGURATION VARIABLES * * */
                            var disqus_shortname = '<?php echo $discus_id; ?>';
                            
                            /* * * DON'T EDIT BELOW THIS LINE * * */
                            (function() {
                                var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
                                dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
                                (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
                            })();
                        </script>
                        <script type="text/javascript">
                            /* * * CONFIGURATION VARIABLES * * */
                                var disqus_shortname = '<?php echo $discus_id; ?>';
                            
                            /* * * DON'T EDIT BELOW THIS LINE * * */
                            (function () {
                                var s = document.createElement('script'); s.async = true;
                                s.type = 'text/javascript';
                                s.src = '//' + disqus_shortname + '.disqus.com/count.js';
                                (document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
                            }());
                        </script>
                        <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>
                        <?php
                            }
                            else if($comment_type == 'facebook'){
                        ?>
            
                            <div id="fb-root"></div>
                            <script>(function(d, s, id) {
                              var js, fjs = d.getElementsByTagName(s)[0];
                              if (d.getElementById(id)) return;
                              js = d.createElement(s); js.id = id;
                              js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4&appId=<?php echo $fb_id; ?>";
                              fjs.parentNode.insertBefore(js, fjs);
                            }(document, 'script', 'facebook-jssdk'));</script>
                            <div class="fb-comments" data-href="<?php echo $this->crud_model->product_link($row['product_id']); ?>" data-numposts="5"></div>
            
                        <?php
                            }
                        ?>
                	</div>
                </div>
            </div>
            <!-- /CONTENT -->
        </div>
    </div>
</section>
<script>
	$(document).ready(function() {
		$('#share').share({
			networks: ['facebook','googleplus','twitter','linkedin','tumblr','in1','stumbleupon','digg'],
			theme: 'square'
		});
	});
</script>