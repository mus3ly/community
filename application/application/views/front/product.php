<?php
$url = base_url('updated/');
 include "header_new.php";
?>
<?php
$pro = array();



if(isset($product_data[0]))

{

    $pro = $product_data[0];

}
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
if(isset($imgs[0]))
{
    $fimg = $this->crud_model->size_img($imgs[0]['img'],500,500);
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
                      <?php
                      foreach($imgs as $k=> $v)
                      {
                          ?>
                    <img
                      src="<?= $v ?>"
                      alt="shoe image">
                      <?php
                      }
                      ?>
                  </div>
                </div>
                <div class="img-select">
                      <?php
                      foreach($imgs as $k=> $v)
                      {
                          ?>
                          <div class="img-item">
                    <a href="#" data-id="2">
                      <img
                        src="<?= $v ?>"
                        alt="shoe image">
                    </a>
                  </div>
                      <?php
                      }
                      ?>
                </div>
              </div>
            </aside>
            <div class="col-lg-6">
              <div class="product-details-side" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
                <div class="ps-lg-3">
                  <h4 class="title text-dark">
                    <?php echo $row['title'];?>
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
                      With supporting text below as a natural lead-in to additional content. Lorem ipsum dolor sit amet,
                      consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                      Ut
                      enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                      consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat
                      nulla
                      pariatur.
                    </p>
                    <div class="row my-2">
                      <div class="col-12 col-md-6">
                        <ul class="list-unstyled mb-0">
                          <li><i class="fas fa-check-square me-2"></i>Some great feature name here</li>
                          <li><i class="fas fa-check-square me-2"></i>Lorem ipsum dolor sit amet, consectetur</li>
                          <li><i class="fas fa-check-square me-2"></i>Duis aute irure dolor in reprehenderit</li>
                          <li><i class="fas fa-check-square me-2"></i>Optical heart sensor</li>
                        </ul>
                      </div>
                      <div class="col-12 col-md-6 mb-0">
                        <ul class="list-unstyled">
                          <li><i class="fas fa-check-square me-2"></i>Easy fast and ver good</li>
                          <li><i class="fas fa-check-square me-2"></i>Some great feature name here</li>
                          <li><i class="fas fa-check-square me-2"></i>Modern style and design</li>
                        </ul>
                      </div>
                    </div>
                    <table class="table border mt-3 mb-2">
                      <tr>
                        <th class="py-2">Display:</th>
                        <td class="py-2">13.3-inch LED-backlit display with IPS</td>
                      </tr>
                      <tr>
                        <th class="py-2">Processor capacity:</th>
                        <td class="py-2">2.3GHz dual-core Intel Core i5</td>
                      </tr>
                      <tr>
                        <th class="py-2">Camera quality:</th>
                        <td class="py-2">720p FaceTime HD camera</td>
                      </tr>
                      <tr>
                        <th class="py-2">Memory</th>
                        <td class="py-2">8 GB RAM or 16 GB RAM</td>
                      </tr>
                      <tr>
                        <th class="py-2">Graphics</th>
                        <td class="py-2">Intel Iris Plus Graphics 640</td>
                      </tr>
                    </table>
                  </div>
                  <div class="tab-pane fade mb-2" id="ex1-pills-2" role="tabpanel" aria-labelledby="ex1-tab-2">
                    <p>Tab content or sample information now <br />
                      Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                      labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                      nisi ut
                      aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                      cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
                      culpa qui
                      officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet, consectetur adipisicing
                      elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                      quis
                      nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo</p>
                  </div>
                  <div class="tab-pane fade mb-2" id="ex1-pills-3" role="tabpanel" aria-labelledby="ex1-tab-3">
                    <p>Another tab content or sample information now <br />
                      Dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore
                      magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                      ex ea
                      commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                      fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia
                      deserunt
                      mollit anim id est laborum.</p>
                  </div>
                  <div class="tab-pane fade mb-2" id="ex1-pills-4" role="tabpanel" aria-labelledby="ex1-tab-4">
                    <p>Some other tab content or sample information now <br />
                      Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                      labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                      nisi ut
                      aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                      cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
                      culpa qui
                      officia deserunt mollit anim id est laborum.</p>
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
                    <div class="d-flex mb-3">
                      <a href="#" class="me-3">
                        <img src="https://bootstrap-ecommerce.com/bootstrap5-ecommerce/images/items/8.webp"
                          style="min-width: 96px; height: 96px;" class="img-md img-thumbnail" />
                      </a>
                      <div class="info">
                        <a href="#" class="nav-link mb-1">
                          Rucksack Backpack Large <br />
                          Line Mounts
                        </a>
                        <strong class="text-dark"> $38.90</strong>
                      </div>
                    </div>

                    <div class="d-flex mb-3">
                      <a href="#" class="me-3">
                        <img src="https://bootstrap-ecommerce.com/bootstrap5-ecommerce/images/items/9.webp"
                          style="min-width: 96px; height: 96px;" class="img-md img-thumbnail" />
                      </a>
                      <div class="info">
                        <a href="#" class="nav-link mb-1">
                          Summer New Men's Denim <br />
                          Jeans Shorts
                        </a>
                        <strong class="text-dark"> $29.50</strong>
                      </div>
                    </div>

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
 include "footer_new.php";
?>
