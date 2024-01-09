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
    }
    .success-message__title{
        color:rgba(50,168,64);
    }
    .success-message__content p{
        color:£bec4bf;
        font-size:20px;
    }
</style>

<section class="page-section">
    <div class="container">
         <div class="success-message">
    <svg viewBox="0 0 76 76" class="success-message__icon icon-checkmark">
        <circle cx="38" cy="38" r="36"/>
        <path fill="none" stroke="#FFFFFF" stroke-width="5" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10" d="M17.7,40.9l10.9,10.9l28.7-28.7"/>
    </svg>
    <h1 class="success-message__title">Your email has been verified!</h1>
    <div class="success-message__content">
        <p>Please await your account approval email, before signing in to your vendor account.</p>
        <p>We will respond in approximately 34 minutes!</p>
    </div>
</div>   
    </div>
</section>
<?php
 include "footer_new.php";
?>
