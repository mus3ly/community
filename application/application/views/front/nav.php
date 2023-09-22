<div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav ms-auto">
            <?php
            include FCPATH.'topbar.php';
            
        ?>
            <li class="nav-item">
              <a class="nav-link" href="#">FAQ</a>
            </li>
            <li class="nav-item add-listing">
              <a href="<?= base_url('//vendor_logup/registration'); ?>" class="">SIGN-UP
              </a>
            </li>
            <li class="nav-item dropdown signup">
              <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-box-arrow-in-right"></i>
              </a>
              <ul class="dropdown-menu">
                <?php
              if ($this->session->userdata('user_login') == "yes") {
                  ?>
                        <li><a class="dropdown-item" href="<?= base_url('/home/affliate'); ?>">Affliate</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('/home/profile'); ?>">Settings</a></li>
                        <li><a class="dropdown-item " href="<?= base_url('/home/profile'); ?>">Profile</a></li>
                        <li><a  class="dropdown-item" href="<?= base_url('/home/Logout'); ?>">Logout</a></li>
                  <?php
              }
              else
              {
                  ?>
                    <li><a  class="dropdown-item" href="<?= base_url('login_set/login');?>"> Customer Login</a></li>
                                <li><a  class="dropdown-item" href="<?= base_url('home/login_set/registration');?>"> Customer Sign-up</a></li>
                                <li><a  class="dropdown-item" href="<?= base_url('vendor');?>"> Vendor Login</a></li>
                                <li><a class="dropdown-item" href="<?= base_url('vendor_logup/registration');?>"> Vendor Sign-up</a></li>
                  <?php
              }
              ?>
              </ul>
            </li>
            <li class="nav-item cart-btn-item">
              <a href="<?= base_url('/home/cart_checkout'); ?>" class="btn btn-theme-transparent" data-toggle="modal" data-target="#popup-cart">
                  <span class="hidden-xs">
                  <span class="cart_num">0</span>
                </span>
                <i class="fa fa-shopping-cart"></i>
                
              </a>
            </li>
                                                   

                            </ul>
                        </div>