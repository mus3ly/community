<?php
$file = 'main.php';
if(isset($_GET['rate']))
{
    
    $rate = $_GET['rate'];
    $file = 'rate.php';
}
else if(isset($_GET['comment']))
{
    $file = 'comment.php';
}
include $file;
?>