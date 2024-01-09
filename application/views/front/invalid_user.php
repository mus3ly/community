<?php


$url = base_url('updated/');
 include "header_new.php";
?>
<style>
    .page-section{
        text-align:center;
        
        
    }
    .success-message svg{
        width:70px;
        font-size:60px;
    }
    .success-message__title{
        color:red;
    }
    .success-message__content p{
        color:£bec4bf;
        font-size:20px;
    }
</style>

<section class="page-section">
    <div class="container">
         <div class="success-message">

    <svg class="success-message__icon icon-checkmark" fill="red" xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM175 175c9.4-9.4 24.6-9.4 33.9 0l47 47 47-47c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9l-47 47 47 47c9.4 9.4 9.4 24.6 0 33.9s-24.6 9.4-33.9 0l-47-47-47 47c-9.4 9.4-24.6 9.4-33.9 0s-9.4-24.6 0-33.9l47-47-47-47c-9.4-9.4-9.4-24.6 0-33.9z"/></svg>
    <h1 class="success-message__title">Invalid Link</h1>
    <div class="success-message__content">
        <p>If you have already verified your email, sign in to your account after admin's approval.</p>
    </div>
</div>   
    </div>
</section>
<?php
 include "footer_new.php";
?>
