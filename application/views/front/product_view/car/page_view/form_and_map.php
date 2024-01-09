<div class="container">
      <div class="orange_pathwrap" id="bpage_form">
        <div class="iframe_box">
          <div class="getin_touch">
            <div class="row">
              <div class="col-md-12 col-lg-6 order-lg-2">
                <div class="map-side">
                  <iframe
                    src="https://www.google.com/maps/embed/v1/view?key=<?= $this->config->item('map_key'); ?>&center=<?= $pro['lat'] ?>,<?= $pro['lng'] ?>&zoom=12"
                    width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
              </div>
              <div class="col-md-12 col-lg-6 order-lg-1">
                <div class="form-side">
                  <h3>Get In Touch</h3>
                  <form action="#" method="">
  
                    <input type="hidden" name="pid" id="pid1" value="1">
  
                    <div class="row">
  
                      <div class="col-sm-6 form_gapp">
                        <div class="form_box">
                          <div class="input-group mb-3">
                            <span class="input-group-text">
                              <i class="fa fa-user"></i>
                            </span>
                            <input type="text" class="form-control" id="fname__" placeholder="First Name">
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-6 form_gapp">
                        <div class="form_box">
                          <div class="input-group mb-3">
                            <span class="input-group-text">
                              <i class="fa fa-user"></i>
                            </span>
                            <input type="text" class="form-control" id="lname" placeholder="Last Name">
                          </div>
                        </div>
                      </div>
  
                      <div class="col-sm-6 form_gapp">
                        <div class="form_box">
                          <div class="input-group mb-3">
                            <span class="input-group-text">
                              <i class="fa fa-envelope"></i>
                            </span>
                            <input type="email" class="form-control" id="email__" placeholder="Your email">
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-6 form_gapp">
                        <div class="form_box">
                          <div class="input-group mb-3">
                            <span class="input-group-text">
                              <i class="fa fa-phone"></i>
                            </span>
                            <input type="text" class="form-control" id="phone" placeholder="Phone">
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-12 form_gapp">
                        <div class="form_box">
                          <div class="input-group align-items-start mb-3">
                            <span class="input-group-text pt-3">
                              <i class="fa fa-message"></i>
                            </span>
                            <textarea class="form-control" id="message__" placeholder="Leave a comment here"
                              style="height: 100px"></textarea>
                          </div>
                        </div>
                      </div>
  
                    </div>
  
                    <div class="row">
  
                      <div class="col-sm-12 form_gapp">
  
                        <div class="form_box form-btns">
  
                          <button class="form-btn" type="button" onclick="SEND_CONTACT('<?= $pro['product_id'] ?>')">Send</button>
  
                          <a href="https://maps.google.com/?q=<?= $pro['lat'] ?>,<?= $pro['lng'] ?>" class="form-btn">
                            GET DIRECTION
                          </a>
  
                        </div>
  
                      </div>
  
                    </div>
  
                  </form>
                </div>
              </div>
            </div>
          </div>
  
        </div>
  
      </div>
    </div>