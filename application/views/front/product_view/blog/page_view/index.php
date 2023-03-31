<?php
// die('ok');
$pro = array();
if(isset($product_data[0]))
{
    $pro = $product_data[0];

    
}
$pros = $this->db->where('added_by',$pro['added_by'])->get('product')->result_array();

//galary
$imgs = $this->db->where('pid',$pro['product_id'])->get('product_to_images')->result_array();

$fimg = '';
if(isset($imgs[0]))
{
    $fimg = $this->crud_model->size_img($imgs[0]['img'],500,500);
}
$logo = '';
$cat = '';
if($pro['category'])
{
    $c = $this->db->where('category_id',$pro['category'])->get('category')->row();
    if(isset($c->category_name))
    {
        $cat = $c->category_name;
    }
}
    $address = '';
    if($pro['lat'] && $pro['lng'])
    {
        $lat = $pro['lat'];
        $long = $pro['lng'];
        $url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=$lat,$long&sensor=false&key=".$this->config->item('map_key');
;
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_ENCODING, "");
$curlData = curl_exec($curl);
curl_close($curl);

$data = json_decode($curlData);
if(isset($data->results[0]->formatted_address))
{
    $address = $data->results[0]->formatted_address;
}


    }
if(true)
                                            // {
                                            //     $logo = $this->crud_model->size_img($pro['comp_logo'],100,100);
                                            // }
                                            
                                              if($pro['comp_logo'])
                        {
                            $logo = $this->crud_model->get_img($pro['comp_logo']);
                            if(isset($logo->secure_url) && !empty($logo->secure_url))
                            {
                                $logo = $logo->secure_url;
                            }

                        }
                        else
                        {
                            $logo = $this->crud_model->file_view('product',$product_id,'','','thumb','src','multi','one');

                        }
?>
<?php
?>
<?php
if(isset($_GET['test']))
{
    include "index_new.php";
    die();
}
?>
<section class="page-section with-sidebar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            <div class="header_titles">
                 <div class="post-header">
                        <h2 class="post-title">
                        	<?php echo $pro['title']; ?>
                        </h2>
                        <div class="short_desc">
                            <p><?= $pro['main_heading'];?></p>
                        </div>
                        <div class="post-meta">
							<?php echo translate('by'); ?> 
							<?php echo $pro['author_name']; ?> /
                            <?php echo date('Y-m-d', strtotime($pro['posted_date'])); ?>
                        </div>
                    </div>
            </div>
            </div>
            <div class="col-md-9 content" id="content2">
            
            	<article class="post-wrap post-single">
            	   
                    <div class="post-media">
                        <?php
                   
                        ?>
                        <img class="img-responsive" src="<?php echo $logo; ?>" alt=""/>
                    </div>
                    <div class="social_btn">
                        <a href="#" class="btn btn-primary color_chng">Facebook <i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#" class="btn btn-danger color_chnge">Twitter <i class="fa-brands fa-twitter"></i></a>
                    </div>
                    <div class="post-header">
       
                    </div>
                    <div class="buttons">
                        <div id="share"></div>
                    </div>
                    <div class="post-body">
                        <div class="post-excerpt">
                            <p class="text-xl">
                        		<?php echo $pro['main_heading']; ?>
                            </p>
                            <p>
                            	<?php echo $pro['description']; ?>
                            </p>
                        </div>
                    </div>
                </article>
               <hr class="page-divider"/>
             
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
            <!-- SIDEBAR -->
           <?php ?>
           
           <aside class="col-md-3 sidebar hidden-sm hidden-xs" id="sidebar2">
               <div class="ad_box">
                   
               </div>
                <!-- widget shop categories -->
                
            <div class="widget shop-categories">
                    <div class="widget-content">
                        <ul>
                            <!--<li><a class="new_hd" href="<?php echo base_url(); ?>home/blog/"><?php echo translate('all_blogs');?></a></li>-->
                            <?php
                            // var_dump($pro['product_id']);
                                $categories=$this->db->where('is_blog', 1)->where('product_id !=', $pro['product_id'])->order_by('product_id', 'DESC')->limit(10,1)->get('product')->result_array();  
                               foreach($categories as $row){
                                   $vendorlogo  = '' ;
                                      if($row['comp_logo'])
                        {
                            $vendorlogo = $this->crud_model->get_img($row['comp_logo']);
                            if(isset($vendorlogo->secure_url))
                            {
                                $vendorlogo = $vendorlogo->secure_url;
                            }

                        }
                        else
                        {
                            $vendorlogo = $this->crud_model->file_view('product',$product_id,'','','thumb','src','multi','one');

                        }
                            ?>
                                <li>
                                    <span class="new_img1">
                                    <a href="#"><img src="<?= $vendorlogo ;?>" alt=""></a>
                                    <a href="<?php echo base_url().$row['slug']; ?>">
                                        <?php echo $row['title']; ?> 
                                    </a>
                                    
                                    </span>
                                </li>
                            <?php 
                                }
                            ?>
                        </ul>
                    </div>
                </div>
                <!-- /widget shop categories -->
                <!-- widget tabs -->
              <?php /*  <div class="widget widget-tabs">
                    <div class="widget-content special-blogs">
                        <ul id="tabs" class="nav nav-justified">
                            <li class="active">
                                <a href="#tab-s1" data-toggle="tab">
                                  <?php echo translate('recent');?>
                                </a>
                            </li>
                            <li>
                                <a href="#tab-s2" data-toggle="tab">
                                    <?php echo translate('popular');?>
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <!-- tab 1 -->
                            <div class="tab-pane fade in active" id="tab-s1">
                                <div class="product-list">
                                <?php
                                    $this->db->limit(3);
                                    $this->db->order_by("blog_id", "desc");
                                    $latest=$this->db->get('blog')->result_array();
                                    foreach($latest as $row){
                                ?>
                                    <div class="media">
                                        <a class="pull-left media-link" href="<?php echo $this->crud_model->blog_link($row['blog_id']); ?>">
                                            <img class="img-responsive" src="<?php echo $this->crud_model->file_view('blog',$row['blog_id'],'','','thumb','src','',''); ?>" alt=""/>
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <div class="media-body">
                                            <h6 class="media-heading">
                                                <a href="<?php echo $this->crud_model->blog_link($row['blog_id']); ?>">
                                                    <?php echo $row['title']; ?>
                                                </a>
                                            </h6>
                                            <div class="date">
                                                <ins><?php echo $row['date']; ?></ins>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                    }
                                ?>
                                </div>
                            </div>
                            <!-- tab 2 -->
                            <div class="tab-pane fade" id="tab-s2">
                                <div class="product-list">
                                    <?php
                                    $this->db->limit(3);
                                    $this->db->order_by("number_of_view", "desc");
                                    $popular=$this->db->get('blog')->result_array();
                                    foreach($popular as $row){
                                ?>
                                    <div class="media">
                                        <a class="pull-left media-link" href="<?php echo $this->crud_model->blog_link($row['blog_id']); ?>">
                                            <img class="img-responsive" src="<?php echo $this->crud_model->file_view('blog',$row['blog_id'],'','','thumb','src','',''); ?>" alt=""/>
                                            <i class="fa fa-eye"></i>
                                        </a>
                                        <div class="media-body">
                                            <h6 class="media-heading">
                                                <a href="<?php echo $this->crud_model->blog_link($row['blog_id']); ?>">
                                                    <?php echo $row['title']; ?>
                                                </a>
                                            </h6>
                                            <div class="date">
                                                <ins><?php echo $row['date']; ?></ins>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                    }
                                ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> */?>
                <!-- /widget tabs -->
            </aside>
            <?php
                
                ?>
            <!-- /SIDEBAR -->
            <!-- CONTENT -->
           <div class="row">
           
            
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