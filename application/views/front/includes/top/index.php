
<title><?php echo $page_title; ?></title>
<meta charset="UTF-8">

<meta name="description" content="<?php echo $description;?>">

<meta name="keywords" content="<?php echo $keywords; ?>">

<meta name="author" content="<?php echo $author; ?>">

<meta name="revisit-after" content="<?php echo $revisit_after; ?> days">

<meta name="viewport" content="width=device-width, initial-scale=1.0">



<?php
include 'meta/'.$meta_file.'.php';

?>
<meta name="google-site-verification" content="o1CVY96Hb6p7kYGVGHvkEAU-5fSF62b9LWVT6IDwE34" />

<!-- Favicon -->

<?php $ext =  $this->db->get_where('ui_settings',array('type' => 'fav_ext'))->row()->value;?>

<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url(); ?>template/front/ico/apple-touch-icon-144-precomposed.png">



<link rel="shortcut icon" href="<?php echo base_url(); ?>uploads/others/favicon.<?php echo $ext; ?>">





<?php if($this->crud_model->get_type_name_by_id('general_settings','80','value') == 'ok'){?>

    <!-- Google Analytics -->

    <script>

        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){

            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),

            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)

        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');



        ga('create', "<?php echo $this->db->get_where('general_settings',array('type'=>'google_analytics_key'))->row()->value; ?>", 'auto');

        ga('send', 'pageview');

    </script>

    <!-- End Google Analytics -->

<?php } ?>



<?php $pixel_code = $this->crud_model->get_settings_value('general_settings','facebook_pixel_id','value'); ?>

<?php if($this->crud_model->get_settings_value('general_settings','facebook_pixel_set','value') == 'ok') { ?>

    <!-- Facebook Pixel Code -->

    <script>

        !function(f,b,e,v,n,t,s)

        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?

            n.callMethod.apply(n,arguments):n.queue.push(arguments)};

            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';

            n.queue=[];t=b.createElement(e);t.async=!0;

            t.src=v;s=b.getElementsByTagName(e)[0];

            s.parentNode.insertBefore(t,s)}(window, document,'script',

            'https://connect.facebook.net/en_US/fbevents.js');

        fbq('init', '<?= $pixel_code?>');

        fbq('track', 'PageView');

    </script>

    <noscript><img height="1" width="1" style="display:none"

                   src="https://www.facebook.com/tr?id=<?= $pixel_code?>&ev=PageView&noscript=1"

        /></noscript>

    <!-- End Facebook Pixel Code -->

<?php } ?>



<?php if($this->crud_model->get_settings_value('general_settings','facebook_chat_set','value') == 'ok') { ?>

    <?php $facebook_chat_page_id = $this->crud_model->get_settings_value('general_settings','facebook_chat_page_id','value'); ?>

    <?php $facebook_chat_theme_color = $this->crud_model->get_settings_value('general_settings','facebook_chat_theme_color','value'); ?>

    <?php $facebook_chat_logged_in_greeting = $this->crud_model->get_settings_value('general_settings','facebook_chat_logged_in_greeting','value'); ?>

    <?php $facebook_chat_logged_out_greeting = $this->crud_model->get_settings_value('general_settings','facebook_chat_logged_out_greeting','value'); ?>

<!-- facebook chat starts -->

<!-- facebook chat ends -->

<?php } ?>








<!-- Theme CSS -->




<link href="<?php echo base_url(); ?>template/front/plugins/smedia/custom-1.css" rel="stylesheet">



<!-- Head Libs -->


<script src="<?php echo base_url(); ?>template/front/plugins/jquery/jquery-1.11.1.min.js"></script>

<?php

$font =  $this->db->get_where('ui_settings',array('type' => 'font'))->row()->value;

?>



<?php
include $asset_page.'.php';

?>

		