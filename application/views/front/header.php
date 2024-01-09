<?php
$url = base_url('html/');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Community Hubland</title>

  <!-- Favicons -->
  <link href="<?=$url ?>/assetsimages/favicon.png" rel="icon">
  <link href="<?=$url ?>/assetsimages/favicon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="crossorigin">
  <link
    href="https://fonts.googleapis.com/css2?family=Catamaran:wght@300;400;500;600;700&amp;family=Inter:wght@300;400;500;600;700&amp;display=swap"
    rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css' />
  <link rel='stylesheet'
    href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css' />
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css' />
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/<?=$url ?>/assetsowl.carousel.min.css' />
  <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

  <!-- Template Main CSS File -->
  <link href="<?=$url ?>/assetsscss/style.css" rel="stylesheet">

</head>

<body>
    
  <!-- Shape Boxes -->
  <div class="dotted_lines">
    <img src="<?=$url ?>/assetsimages/doted-lines.png" alt="">
  </div>
  <!-- <div class="ellipse">
        <img src="<?=$url ?>/assetsimages/Ellipse.png" alt="">
    </div> -->
  <div class="lines_shape">
    <img src="<?=$url ?>/assetsimages/lines-shape.png" alt="">
  </div>
  <!-- <div class="rounded_box">
        <img src="<?=$url ?>/assetsimages/rounded.png" alt="">
    </div> -->

  <!-- Header -->
  <header data-aos="fade-down" data-aos-duration="1000">
    <nav class="navbar navbar-expand-lg">
      <div class="container">
        <a class="navbar-brand" href="index.html">
          <img src="<?=$url ?>/assetsimages/logo.png" alt="Logo" class="img-fluid">
        </a>
        <div class="mobile-open">
          <a href="#" class="cart-btn-mb btn btn-theme-transparent hidden-ld" data-toggle="modal" data-target="#popup-cart">
            <i class="fa fa-shopping-cart"></i>
            <span class="hidden-xs">
              <span class="cart_num">0</span>
            </span>
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="fa fa-bars"></span>
          </button>
        </div>

        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                COMMUNITY PEGS
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Jobs</a></li>
                <li><a class="dropdown-item" href="#">Charities</a></li>
                <li><a class="dropdown-item" href="#">Education</a></li>
                <li><a class="dropdown-item" href="#">Worship</a></li>
                <li><a class="dropdown-item" href="#">Blogs</a></li>
                <li><a class="dropdown-item" href="#">Markets</a></li>
                <li><a class="dropdown-item" href="#">Short Stays</a></li>
                <li><a class="dropdown-item" href="#">Activities</a></li>
                <li><a class="dropdown-item" href="#">Other</a></li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Shop</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                aria-expanded="false">
                Directory
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">All Listings</a></li>
                <li><a class="dropdown-item" href="#">Places</a></li>
                <li><a class="dropdown-item" href="#">Affiliate</a></li>
                <li><a class="dropdown-item" href="#">Blogs</a></li>
                <li><a class="dropdown-item" href="#">Job</a></li>
                <li><a class="dropdown-item" href="#">Event</a></li>
                <li><a class="dropdown-item" href="#">News</a></li>
                <li><a class="dropdown-item" href="#">Charities</a></li>
                <li><a class="dropdown-item" href="#">Properties</a></li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Account</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">FAQ</a>
            </li>
            <li class="nav-item add-listing">
              <a href="vendor_logup/registration.html" class="">Sign-up
               <!-- <i class="fa fa-plus"></i>-->
              </a>
            </li>
            <li class="nav-item dropdown signup">
              <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-box-arrow-in-right"></i>
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Customer Login</a></li>
                <li><a class="dropdown-item" href="#">Customer Sign-up</a></li>
                <li><a class="dropdown-item" href="#">Vendor Login</a></li>
                <li><a class="dropdown-item" href="#">Vendor Sign-up</a></li>
              </ul>
            </li>
            <li class="nav-item cart-btn-item">
              <a href="#" class="btn btn-theme-transparent" data-toggle="modal" data-target="#popup-cart">
                <i class="fa fa-shopping-cart"></i>
                <span class="hidden-xs">
                  <span class="cart_num">0</span>
                  Item(s)
                </span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>
