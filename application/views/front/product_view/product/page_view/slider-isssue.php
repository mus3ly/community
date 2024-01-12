<?php
$url = base_url('updated/');
?>
<?php
$pro = array();



if(isset($product_data[0]))

{

    $pro = $product_data[0];

}
$vendor_id = json_decode($pro['added_by']);
$id = $vendor_id->id;
$vendor = $this->db->where('vendor_id', $id)->get('vendor')->row_array();

// get product
$n = $this->db->where('product_id', $vendor['bpage'])->where('is_bpage', 1)->get('product')->row_array();
$bpage_slug = '';
if(isset($n['slug']))
$bpage_slug = $n['slug'];
$logo = base_url('img_avatar.png');
if($pro['comp_logo'])

{

    $logo = $this->crud_model->get_img($pro['comp_logo']);

    if(isset($logo->path))

    {

        $logo = base_url().$logo->path;

    }

}


                // $cover = base_url().'template/front/images/info-graphic.png';

                if($pro['firstImg']) {

                    $cover = $this->crud_model->size_img($pro['firstImg'],820,312);

                }

                ?>
                <?php
$pro = array();
if(isset($product_data[0]))
{ 
    $pro = $product_data[0];

    
}
$row = $pro;
    $imgs = $this->db->where('pid',$pro['product_id'])->get('product_to_images')->result_array();
$nimgs = array();
if(isset($pro['comp_cover']) && $pro['comp_cover'])
{
$nimgs[] = $this->crud_model->size_img($pro['comp_cover'],500,500);
}
foreach($imgs as $k=> $v)
{
    $nimgs[] = $this->crud_model->size_img($v['img'],500,500);
}
$imgs = $nimgs;
$fimg = '';
if(isset($nimgs[0]))
{
    $fimg = $nimgs[0];
}
    $thumbs = $this->crud_model->file_view('product',$row['product_id'],'','','thumb','src','multi','all');
    $mains = $this->crud_model->file_view('product',$row['product_id'],'','','no','src','multi','all'); 
?>
                <main>
    <section class="product-page">
      <!-- content -->
        <div class="container">
          <div class="row gx-5">
            <aside class="col-lg-6">
              <div class="product-imgs" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="0">
                <div class="img-display">
                  <div class="img-showcase">
                    <img
                      src="https://fadzrinmadu.github.io/hosted-assets/product-detail-page-design-with-image-slider-html-css-and-javascript/shoe_1.jpg"
                      alt="shoe image">
                    <img
                      src="https://fadzrinmadu.github.io/hosted-assets/product-detail-page-design-with-image-slider-html-css-and-javascript/shoe_2.jpg"
                      alt="shoe image">
                    <img
                      src="https://fadzrinmadu.github.io/hosted-assets/product-detail-page-design-with-image-slider-html-css-and-javascript/shoe_3.jpg"
                      alt="shoe image">
                    <img
                      src="https://fadzrinmadu.github.io/hosted-assets/product-detail-page-design-with-image-slider-html-css-and-javascript/shoe_4.jpg"
                      alt="shoe image">
                  </div>
                </div>
                <div class="img-select">
                  <div class="img-item">
                    <a href="#" data-id="1">
                      <img
                        src="https://fadzrinmadu.github.io/hosted-assets/product-detail-page-design-with-image-slider-html-css-and-javascript/shoe_1.jpg"
                        alt="shoe image">
                    </a>
                  </div>
                  <div class="img-item">
                    <a href="#" data-id="2">
                      <img
                        src="https://fadzrinmadu.github.io/hosted-assets/product-detail-page-design-with-image-slider-html-css-and-javascript/shoe_2.jpg"
                        alt="shoe image">
                    </a>
                  </div>
                  <div class="img-item">
                    <a href="#" data-id="3">
                      <img
                        src="https://fadzrinmadu.github.io/hosted-assets/product-detail-page-design-with-image-slider-html-css-and-javascript/shoe_3.jpg"
                        alt="shoe image">
                    </a>
                  </div>
                  <div class="img-item">
                    <a href="#" data-id="4">
                      <img
                        src="https://fadzrinmadu.github.io/hosted-assets/product-detail-page-design-with-image-slider-html-css-and-javascript/shoe_4.jpg"
                        alt="shoe image">
                    </a>
                  </div>
                </div>
              </div>
            </aside>
            <div class="col-lg-6">
              <div class="product-details-side" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
                <div class="ps-lg-3">
                  <h4 class="title text-dark">
                    Quality Men's Hoodie for Winter, Men's Fashion <br />
                    Casual Hoodie
                  </h4>
                  <div class="d-flex flex-row my-3">
                    <div class="stars mb-1 me-2">
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i>
                      <i class="fas fa-star-half-alt"></i>
                      <span class="ms-1">
                        4.5
                      </span>
                    </div>
                    <span class="text-muted">154 reviews</span>
                    <span class="stock ms-2">In stock</span>
                  </div>

                  <div class="mb-3">
                    <span class="h5 price">$75.00</span>
                    <span class="text-muted">/per box</span>
                  </div>

                  <p>
                    Modern look and quality demo item is a streetwear-inspired collection that continues to break away
                    from the conventions of mainstream fashion. Made in Italy, these black and brown clothing low-top
                    shirts for
                    men.
                  </p>

                  <div class="row">
                    <dt class="col-3">Type:</dt>
                    <dd class="col-9">Regular</dd>

                    <dt class="col-3">Color</dt>
                    <dd class="col-9">Brown</dd>

                    <dt class="col-3">Material</dt>
                    <dd class="col-9">Cotton, Jeans</dd>

                    <dt class="col-3">Brand</dt>
                    <dd class="col-9">Reebook</dd>
                  </div>

                  <hr />

                  <div class="row mb-4">
                    <div class="col-md-4 col-6">
                      <label class="mb-2">Size</label>
                      <select class="form-select">
                        <option>Small</option>
                        <option>Medium</option>
                        <option>Large</option>
                      </select>
                    </div>
                    <!-- col.// -->
                    <div class="col-md-4 col-6 mb-3">
                      <label class="mb-2 d-block">Quantity</label>
                      <div class="input-group mb-3">
                        <button class="btn px-3" type="button" id="button-addon1" data-mdb-ripple-color="dark">
                          <i class="fas fa-minus"></i>
                        </button>
                        <input type="text" class="form-control text-center" placeholder="1"
                          aria-label="Example text with button addon" aria-describedby="button-addon1" />
                        <button class="btn px-3" type="button" id="button-addon2" data-mdb-ripple-color="dark">
                          <i class="fas fa-plus"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                  <div class="btns">
                    <a href="#" class="primary-btn"> <i class="fa fa-shopping-basket me-2"></i> Add to cart </a>
                    <a href="#" class="secondary-btn icon-hover"> <i class=" me-2 fa fa-heart fa-lg"></i> Save </a>
                    <a href="#" class="secondary-btn icon-hover"> <i
                        class=" me-2 fa-solid fa-arrow-right-arrow-left"></i>Compare </a>
                    <a href="#" class="btn btn-warning"><i class=" me-2 fa fa-paper-plane"></i> Contact Seller</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      <!-- content -->

      <div class="py-4 product-details-tabs">
        <div class="container">
          <div class="row gx-4">
            <div class="col-lg-8 mb-4">
              <div class="border rounded-2 px-3 py-2 bg-white" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                <!-- Pills navs -->
                <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
                  <li class="nav-item d-flex" role="presentation">
                    <a class="nav-link d-flex align-items-center justify-content-center w-100 active" id="ex1-tab-1"
                      data-bs-toggle="pill" href="#ex1-pills-1" role="tab" aria-controls="ex1-pills-1"
                      aria-selected="true">Specification</a>
                  </li>
                  <li class="nav-item d-flex" role="presentation">
                    <a class="nav-link d-flex align-items-center justify-content-center w-100" id="ex1-tab-2"
                      data-bs-toggle="pill" href="#ex1-pills-2" role="tab" aria-controls="ex1-pills-2"
                      aria-selected="false">Warranty info</a>
                  </li>
                  <li class="nav-item d-flex" role="presentation">
                    <a class="nav-link d-flex align-items-center justify-content-center w-100" id="ex1-tab-3"
                      data-bs-toggle="pill" href="#ex1-pills-3" role="tab" aria-controls="ex1-pills-3"
                      aria-selected="false">Shipping info</a>
                  </li>
                  <li class="nav-item d-flex" role="presentation">
                    <a class="nav-link d-flex align-items-center justify-content-center w-100" id="ex1-tab-4"
                      data-bs-toggle="pill" href="#ex1-pills-4" role="tab" aria-controls="ex1-pills-4"
                      aria-selected="false">Seller profile</a>
                  </li>
                </ul>
                <!-- Pills navs -->

                <!-- Pills content -->
                <div class="tab-content" id="ex1-content">
                  <div class="tab-pane fade show active" id="ex1-pills-1" role="tabpanel" aria-labelledby="ex1-tab-1">
                    <p>
                      <?= $row['specification'] ?>
                    </p>
                    <div class="row my-2">
                      <div class="col-12 col-md-6">
                        <ul class="list-unstyled mb-0">
                          <?php
                          $left = $right = array();
                          $chek = json_decode($row['checkbox_xtra_fields']);
                                foreach($chek as $k=> $v)
                                {
                                    if(empty($v))
                                    {
                                        unset($chek[$k]);
                                    }
                                }
                                foreach($chek as $k=> $v)
                                {
                                  if($k%2 == 0)
                                  {
                                    $left[] = $v;
                                  }
                                  else
                                  {
                                    $right[] = $v;
                                  }
                                }

                          ?>
                          <?php
                          foreach ($left as $key => $value) {
                            ?>
                            <li><i class="fas fa-check-square me-2"></i><?= $valus ?></li>

                            <?php
                          }

                          ?>
                        </ul>
                      </div>
                      <div class="col-12 col-md-6 mb-0">
                        <ul class="list-unstyled">
                          <?php
                          foreach ($right as $key => $value) {
                            ?>
                            <li><i class="fas fa-check-square me-2"></i><?= $valus ?></li>

                            <?php
                          }

                          ?>
                        </ul>
                      </div>
                    </div>
                    <table class="table border mt-3 mb-2">
                        <?php
                        $additional_fields = json_decode($row['additional_fields'], true);
    $names = array();
    $valus = array();
    if(isset($additional_fields['name']) && $additional_fields['name'])
    {
        $names = json_decode($additional_fields['name'],true);
        $valus = json_decode($additional_fields['value'],true);
    }
    if($valus && $names)
    {
        $col1= array();
        $col2= array();
        $i = 1;
        $lim = 30;
        $accor = array();
        foreach($names as $k=> $v)
        {
            if(strlen($valus[$k]) > $lim)
            {
                $accor[$v] = $valus[$k];
            }
            else
            {
            $i++;
            
            if($i%2 == 0)
            {
                if($valus[$k])
                $col1[$v] = $valus[$k];
            }
            else
            {
                if($valus[$k])
                $col2[$v] = $valus[$k];
            }
            }
        }
        foreach($names as $k=> $v)
        {
          ?>
          <tr>
              <th class="py-2"><?= $v ?>:</th>
                        <td class="py-2"><?= $valus[$k]; ?></td>
                      </tr>
          <?php
        }
    }

                        ?>
                    </table>
                  </div>
                  <div class="tab-pane fade mb-2" id="ex1-pills-2" role="tabpanel" aria-labelledby="ex1-tab-2">
                    <p>
                      <?= $row['warranty_info'] ?>
                    </p>
                  </div>
                  <div class="tab-pane fade mb-2" id="ex1-pills-3" role="tabpanel" aria-labelledby="ex1-tab-3">
                    <p>
                      <?= $row['shipping_info'] ?>
                    </p>
                  </div>
                  <div class="tab-pane fade mb-2" id="ex1-pills-4" role="tabpanel" aria-labelledby="ex1-tab-4">
                    <p>
                      <?= $row['seller_profile'] ?>
                    </p>
                  </div>
                </div>
                <!-- Pills content -->
              </div>
            </div>
            <div class="col-lg-4">
              <div class="px-0 rounded-2 shadow-0" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="300">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">Similar items</h5>
                    <?php
                    $rel = $this->db->where('product_id !=',$row['product_id'])->where('module',$row['module'])->limit(5)->get('product')->result_array();
                    // $rel = $this->db->where('module',$row['module'])->limit(5)->get('product')->result_array();
                    foreach ($rel as $key => $value) {
                      $cov = '';
                      if(isset($value['comp_cover']) && $value['comp_cover'])
{
$cov = $this->crud_model->size_img($value['comp_cover'],500,500);
}
                      ?>
                      <div class="d-flex mb-3">
                      <a href="<?= base_url($value['slug']) ?>" class="me-3">
                        <img src="<?= $cov ?>"
                          style="max-width: 96px; height: 96px;" class="img-md img-thumbnail" />
                      </a>
                      <div class="info">
                        <a href="#" class="nav-link mb-1">
                          <?= $value['title']; ?><br />
                          Jeans Shorts
                        </a>
                        <strong class="text-dark"> $<?= $value['sale_price'] ?></strong>
                      </div>
                    </div>
                      <?php
                    }

                    ?>

                    

                    <div class="d-flex mb-3">
                      <a href="#" class="me-3">
                        <img src="https://bootstrap-ecommerce.com/bootstrap5-ecommerce/images/items/10.webp"
                          style="min-width: 96px; height: 96px;" class="img-md img-thumbnail" />
                      </a>
                      <div class="info">
                        <a href="#" class="nav-link mb-1"> T-shirts with multiple colors, for men and lady </a>
                        <strong class="text-dark"> $120.00</strong>
                      </div>
                    </div>

                    <div class="d-flex">
                      <a href="#" class="me-3">
                        <img src="https://bootstrap-ecommerce.com/bootstrap5-ecommerce/images/items/11.webp"
                          style="min-width: 96px; height: 96px;" class="img-md img-thumbnail" />
                      </a>
                      <div class="info">
                        <a href="#" class="nav-link mb-1"> Blazer Suit Dress Jacket for Men, Blue color </a>
                        <strong class="text-dark"> $339.90</strong>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  <?php
  $product = 1;
  ?>