<?php


$url = base_url('updated/');
 include "header_new.php";
?>
<?php
$filename = dirname(__FILE__).'/pages/'.$page.'.php';

if (file_exists($filename) && isset($page)) {
    include $filename;
} else {
    echo "The file $filename does not exist";
}
?>
<?php
 include "footer_new.php";
?>
