
 <!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php
  $home_style = $this->db->get_where('ui_settings', array('type' => 'home_page_style'))->row()->value;
    $vendor_system   =  $this->crud_model->get_settings_value('general_settings','vendor_system');
    $physical_system =  $this->crud_model->get_settings_value('general_settings','physical_product_activation');
    $digital_system  =  $this->crud_model->get_settings_value('general_settings','digital_product_activation');
    $description     =  $this->crud_model->get_settings_value('general_settings','meta_description');
    $keywords        =  $this->crud_model->get_settings_value('general_settings','meta_keywords');
    $author          =  $this->crud_model->get_settings_value('general_settings','meta_author');
    $system_name     =  $this->crud_model->get_settings_value('general_settings','system_name');
    $system_title    =  $this->crud_model->get_settings_value('general_settings','system_title');
    $map_api_key     =  $this->crud_model->get_settings_value('general_settings','api_key');
    $revisit_after   =  $this->crud_model->get_settings_value('general_settings','revisit_after');
  include 'includes/top/index.php';
  ?>

  <!-- Favicons -->
  <link href="<?= $url ?>assets/images/favicon.png" rel="icon">
  <link href="<?= $url ?>assets/images/favicon.png" rel="apple-touch-icon">

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
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css' />
  <!-- <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" /> -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simple-notify@0.5.5/dist/simple-notify.min.css" />


  <!-- Template Main CSS File -->
  <link href="<?= $url ?>assets/scss/style.css" rel="stylesheet">

</head>

<body>
    <?php
    include "preloader.php";
    ?>
  <!-- Shape Boxes -->
  <div class="dotted_lines">
    <img src="<?= $url ?>assets/images/doted-lines.png" alt="">
  </div>
  <!-- <div class="ellipse">
        <img src="<?= $url ?>assets/images/Ellipse.png" alt="">
    </div> -->
  <div class="lines_shape">
    <img src="<?= $url ?>assets/images/lines-shape.png" alt="">
  </div>
  <!-- <div class="rounded_box">
        <img src="<?= $url ?>assets/images/rounded.png" alt="">
    </div> -->

  <!-- Header -->
  <header>
    <nav class="navbar navbar-expand-lg">
      <div class="container">
        <a class="navbar-brand" href="<?= base_url(); ?>">
          <img src="<?= $url ?>assets/images/logo.png" alt="Logo" class="img-fluid">
        </a>
        <div class="mobile-open">
          <a href="<?= base_url('/home/cart_checkout'); ?>" class="cart-btn-mb btn btn-theme-transparent hidden-ld" data-toggle="modal" data-target="#popup-cart">
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
        <?php
        include 'nav.php';
        ?>
        
      </div>
    </nav>
  </header>
  