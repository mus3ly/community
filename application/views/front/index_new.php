<?php

$url = base_url('updated/').'/';
 include "header_new.php";
?>

    <?php
    // die($page_name);
    ?>
    <div class="content-area" page_name="<?= $page_name?>">
        <?php
        include $page_name.'/index.php';
        ?>
    </div>
    
    <!-- /CONTENT AREA -->
<?php
 include "footer_new.php";
?>
