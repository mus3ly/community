<?php
$file = 'main.php';
if(isset($ng))
{
    $file = 'edit.php';
}
if(isset($ng) && isset($_GET['edit']) && $_GET['edit'] == 2)
{
    $file = 'edit1.php';
}
if(isset($ng) && isset($_GET['edit']) && $_GET['edit'] == 3)
{
    $file = 'edit2.php';
}
if(isset($_GET['rate']))
{
    
    $rate = $_GET['rate'];
    $file = 'rate.php';
}
if(isset($_GET['view']))
{
    
    $rate = $_GET['view'];
    $file = 'view.php';
}
else if(isset($_GET['comment']))
{
    $file = 'comment.php';
}
include $file;
?>