
<?php
$url = base_url('html/');
include "header.php";
?>
    <!-- /HEADER -->

    <!-- CONTENT AREA -->
    <?php
    // die($page_name);
    ?>
    <div class="content-area" page_name="<?= $page_name?>">
        <?php
        include $page_name.'/index.php';
        ?>
    </div>
    
<?php
include "footer.php";
?>


<script src="<?= $url ?>js/jquery.js"></script>
<script src="<?= $url ?>js/owl.carousel.js"></script>
<script src="<?= $url ?>js/custom.js"></script>
<script src="<?= $url ?>js/bootstrap.min.js"></script>


</body>
</html>
