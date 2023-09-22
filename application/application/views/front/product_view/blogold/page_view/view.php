<?php
$pro = array();
if(isset($product_data[0]))
{
    $pro = $product_data[0];
}
$pros = $this->db->where('added_by',$pro['added_by'])->get('product')->result_array();
?>
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>

   <style type="text/css">
      /*! CSS Used from: Embedded */
      div,span,h1,h2,p,a,img,ul,li,fieldset,form,aside{margin:0px;padding:0px;border:0px;font:inherit;vertical-align:baseline;}
      aside{display:block;}
      ul{list-style:none;}
      /*! CSS Used from: Embedded */
      .css-1kngrp9{font-family:"Open Sans", "Helvetica Neue", Helvetica, Arial, sans-serif;color:rgb(200, 201, 202);line-height:22px;font-size:16px;overflow:hidden;position:absolute;top:0px;left:0px;user-select:none;pointer-events:none;}
      /*! CSS Used from: https://s3-media0.fl.yelpcdn.com/assets/public/yelp-frontend-commons-pkg.yji-32a65d2ec0b8678f6d9d.css */
      .margin-l1__09f24__m8GL9{margin-left:8px!important;}
      .margin-r1__09f24__rN_ga{margin-right:8px!important;}
      .margin-t2__09f24__b0bxj{margin-top:16px!important;}
      .margin-t3__09f24__riq4X{margin-top:24px!important;}
      .margin-t4__09f24__G0VVf{margin-top:32px!important;}
      .margin-b1__09f24__vaLrm{margin-bottom:8px!important;}
      .margin-b2__09f24__CEMjT{margin-bottom:16px!important;}
      .margin-b3__09f24__l9v5d{margin-bottom:24px!important;}
      .padding-l0-5__09f24__tBn3z{padding-left:4px!important;}
      .padding-l3__09f24__IOjKY{padding-left:24px!important;}
      .padding-r3__09f24__eaF7p{padding-right:24px!important;}
      .padding-t3__09f24__TMrIW{padding-top:24px!important;}
      .padding-b3__09f24__S8R2d{padding-bottom:24px!important;}
      .padding-b6__09f24__hfdiP{padding-bottom:48px!important;}
      .display--inline__09f24__c6N_k{display:inline;}
      .display--inline-block__09f24__fEDiJ{display:inline-block;}
      .border--bottom__09f24___mg5X{border-bottom:1px solid #ebebeb;}
      .border-color--default__09f24__NPAKY{border-color:#ebebeb;}
      .background-color--white__09f24__ulvSM{background-color:#fff;}
      .overflow--hidden__09f24___ayzG{overflow:hidden;}
      .nowrap__09f24__lBkC2{white-space:nowrap;}
      @media only screen and (max-width:1023px){
      .responsive .responsive-hidden-medium__09f24__yxacI{display:none!important;}
      }
      .container__09f24__l8gaY{background-color:#fff;min-width:1020px;}
      @media only screen and (max-width:989px){
      .responsive .container__09f24__l8gaY{min-width:0;}
      }
      .content__09f24__NVMF4{margin:0 auto;max-width:1194px;padding:0 15px;}
      .arrange__09f24__LDfbs{display:table;min-width:100%;table-layout:auto;}
      .arrange__09f24__LDfbs .arrange-unit__09f24__rqHTg{box-sizing:border-box;display:table-cell;vertical-align:top;}
      .arrange-unit-fill__09f24__CUubG{width:100%;}
      .vertical-align-middle__09f24__zU9sE>.arrange-unit__09f24__rqHTg{vertical-align:middle;}
      .gutter-1__09f24__yAbCL{border-collapse:initial;border-spacing:8px 0;margin-left:-8px;margin-right:-8px;}
      .gutter-1__09f24__yAbCL>.arrange-unit__09f24__rqHTg{border-collapse:collapse;border-spacing:0;margin-left:4px;margin-right:4px;}
      .gutter-1-5__09f24__vMtpw{border-collapse:initial;border-spacing:12px 0;margin-left:-12px;margin-right:-12px;}
      .gutter-1-5__09f24__vMtpw>.arrange-unit__09f24__rqHTg{border-collapse:collapse;border-spacing:0;margin-left:6px;margin-right:6px;}
      /*! CSS Used from: https://s3-media0.fl.yelpcdn.com/assets/public/yelp-frontend-gondola-war-compose-pkg.yji-26e90cf440c1b4a92d0e.css */
      .elite-badge__09f24__dykWK{position:relative;top:4px;vertical-align:top;}
      .offscreen__09f24__gZT9P{clip:rect(0 0 0 0);height:1px;left:-9999px;overflow:hidden;position:absolute;top:auto;width:1px;}
      .i-stars__09f24__M1AR7{background:url(https://s3-media0.fl.yelpcdn.com/assets/public/stars_v2.yji-59bbc2cf8e3d4be04fcc.png) no-repeat;background-size:176px 680px;display:inline-block;vertical-align:middle;}
      @media print{
      .i-stars__09f24__M1AR7{background-image:none!important;}
      .i-stars__09f24__M1AR7 img{height:auto;position:relative;width:auto;}
      }
      .i-stars--large-3__09f24__shqlT{background-position:0 -192px;height:32px;width:176px;}
      .i-stars--regular-2__09f24__mq_AY{background-position:0 -400px;height:20px;width:108px;}
      @media print{
      .i-stars--regular-2__09f24__mq_AY img{left:0;top:-400px;}
      }
      .i-stars--regular-4__09f24__qui79{background-position:0 -480px;height:20px;width:108px;}
      @media print{
      .i-stars--regular-4__09f24__qui79 img{left:0;top:-480px;}
      }
      .i-stars--regular-5__09f24__tKNMk{background-position:0 -500px;height:20px;width:108px;}
      @media print{
      .i-stars--regular-5__09f24__tKNMk img{left:0;top:-500px;}
      }
      @media (-webkit-min-device-pixel-ratio:2),(min-resolution:192dpi){
      .i-stars__09f24__M1AR7{background-image:url(https://s3-media0.fl.yelpcdn.com/assets/public/stars_v2@2x.yji-e3971df417f2617269e5.png);}
      }
      .rating-selector__09f24__LNhhs{display:inline-block;vertical-align:middle;}
      .description__09f24__qRKe3{float:left;margin:8px 0 0 12px;}
      @media only screen and (max-width:479px){
      .responsive .description__09f24__qRKe3{float:unset;margin:8px 0 0;}
      }
      .description-text--non-zero__09f24__Ln52s{color:#2d2e2f;}
      @media only screen and (max-width:479px){
      .responsive .description-text--non-zero__09f24__Ln52s{font-size:14px;line-height:1.28571em;}
      }
      .stars__09f24__qckiD{float:left;}
      @media only screen and (max-width:479px){
      .responsive .stars__09f24__qckiD{float:unset;}
      }
      .star__09f24__VkGcP{float:left;height:32px;padding-left:4px;width:32px;}
      .star__09f24__VkGcP:first-child{padding-left:0;}
      .label__09f24__GnhA2{display:none;}
      .input__09f24__IPTwS[type=radio]{-webkit-appearance:none;appearance:none;border:none;border-radius:4px;cursor:pointer;height:inherit;margin:0;outline:0;padding:0;width:inherit;}
      .input__09f24__IPTwS[type=radio]:focus{outline:2px solid #027a97;outline-offset:1px;}
      .input__09f24__IPTwS[type=radio]:focus:not(:focus-visible){outline:0;}
      .input-wrapper__09f24__u2wFT{height:32px;width:32px;}
      .header__09f24__SEy5F{align-items:center;display:flex;flex-wrap:wrap;margin:0 -24px;padding-bottom:24px;padding-top:36px;}
      .biz-header-title-container__09f24__gKmY4{flex:1;margin:0 24px;max-width:calc(100% - 48px);white-space:nowrap;}
      @media only screen and (max-width:479px){
      .biz-header-title-container__09f24__gKmY4{min-width:calc(100% - 48px);white-space:normal;}
      }
      .biz-header-title-link__09f24__DJFkk{display:block;max-width:100%;overflow:hidden;-webkit-text-decoration-line:none!important;text-decoration-line:none!important;text-overflow:ellipsis;}
      .biz-header-guidelines-container__09f24__XD_xp{flex:0 0 auto;margin:0 24px;}
      @media only screen and (max-width:479px){
      .biz-header-guidelines-container__09f24__XD_xp{margin-top:3px;}
      }
      .content__09f24__AjZ3s{flex:auto;overflow-x:hidden;position:relative;}
      .content-inner__09f24__mIjzs{max-width:625px;}
      .arrow-button__09f24__Tt3dz{background-color:#fff;border:1px solid #ebebeb;border-radius:3px 0 0 3px;border-right:0;left:-20px;padding:8px 1px 8px 2px;position:absolute;top:15px;}
      .sidebar__09f24__D0ndm{border-left:1px solid #ebebeb;height:100%;padding-left:20px;position:absolute;right:0;top:0;transition:transform .25s ease;width:320px;}
      .sidebar-inner__09f24__9wnuF{height:100%;overflow-x:hidden;overflow-y:scroll;padding-right:20px;position:relative;transition:visibility .25s ease;}
      /*! CSS Used from: Embedded */
      div,span,h1,h2,p,a,img,ul,li,fieldset,form,aside{margin:0;padding:0;border:0;font-size:100%;font:inherit;vertical-align:baseline;}
      aside{display:block;}
      ul{list-style:none;}
      .css-1q6i1gy{font-family:'Open Sans','Helvetica Neue',Helvetica,Arial,sans-serif;border-radius:3px;-webkit-text-decoration:none;text-decoration:none;font-weight:600;color:rgba(2,122,151,1);font-size:14px;line-height:20px;}
      .css-1q6i1gy:hover{-webkit-text-decoration:underline;text-decoration:underline;}
      .css-1q6i1gy:focus{outline:2px solid rgba(0,112,204,1);outline-offset:1px;}
      .css-1q6i1gy:focus:not(:focus-visible){outline:0;}
      .css-1rdz0vz{-webkit-align-items:center;-webkit-box-align:center;-ms-flex-align:center;align-items:center;-webkit-appearance:none;-moz-appearance:none;appearance:none;background-image:none;background-repeat:no-repeat;border:0;border-radius:4px;box-shadow:none;box-sizing:border-box;display:-webkit-inline-box;display:-webkit-inline-flex;display:-ms-inline-flexbox;display:inline-flex;cursor:pointer;height:40px;-webkit-box-pack:center;-webkit-justify-content:center;-ms-flex-pack:center;justify-content:center;margin:0;padding-bottom:8px;padding-left:16px;padding-right:16px;padding-top:8px;position:relative;text-align:center;-webkit-transition:all 0.8s;transition:all 0.8s;-webkit-transition-property:background-image,background-color,background-position,background-size,border-color,box-shadow,opacity;transition-property:background-image,background-color,background-position,background-size,border-color,box-shadow,opacity;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;vertical-align:middle;width:auto;background-color:transparent;border:1px solid rgba(200,201,202,1);color:rgba(45,46,47,1);background-position:calc(var(--mousedown-x) - calc(var(--button-width,100px) * 200) / 2) calc(var(--mousedown-y) - calc(var(--button-width,100px) * 200) / 2);background-size:calc(var(--button-width,100px) * 200) calc(var(--button-width,100px) * 200);}
      .css-1rdz0vz:disabled{background-color:rgba(235,235,235,1);background-image:none;border-color:rgba(235,235,235,1);box-shadow:none;color:rgba(200,201,202,1);outline:none;pointer-events:none;-webkit-transition:none;transition:none;}
      .css-1rdz0vz:hover{box-shadow:0 1px 4px 0 rgba(0,0,0,0.3);}
      @media only screen and (max-width:599px){
      .responsive .css-1rdz0vz{box-shadow:none;font-weight:normal;}
      }
      .css-1rdz0vz:focus{outline:2px solid rgba(0,112,204,1);outline-offset:1px;}
      .css-1rdz0vz:focus:not(:focus-visible){outline:0;}
      @media (pointer:coarse){
      .css-1rdz0vz:hover{box-shadow:none;}
      }
      .css-1rdz0vz:active{color:rgba(45,46,47,1);}
      .css-1rdz0vz:disabled{background-color:transparent;border:1px solid rgba(227,227,227,1);}
      .css-1rdz0vz:focus{background-color:rgba(0,0,0,0.12);}
      .css-1rdz0vz:hover{background-color:rgba(0,0,0,0.12);color:rgba(45,46,47,1);box-shadow:none;}
      .css-1enow5j{font-family:'Open Sans','Helvetica Neue',Helvetica,Arial,sans-serif;font-size:12px;font-weight:600;-webkit-letter-spacing:0px;-moz-letter-spacing:0px;-ms-letter-spacing:0px;letter-spacing:0px;line-height:16px;color:inherit;text-align:center;max-width:100%;overflow:hidden!important;text-overflow:ellipsis!important;white-space:nowrap!important;word-wrap:normal!important;font-family:'Poppins','Helvetica Neue',Helvetica,Arial,sans-serif!important;font-size:16px!important;font-weight:500!important;-webkit-letter-spacing:-0.2px!important;-moz-letter-spacing:-0.2px!important;-ms-letter-spacing:-0.2px!important;letter-spacing:-0.2px!important;line-height:24px!important;margin-top:1px!important;}
      .css-133wuwu{font-family:'Poppins','Helvetica Neue',Helvetica,Arial,sans-serif;font-size:28px;font-weight:700;-webkit-letter-spacing:-0.4px;-moz-letter-spacing:-0.4px;-ms-letter-spacing:-0.4px;letter-spacing:-0.4px;line-height:36px;word-wrap:break-word!important;word-break:break-word!important;overflow-wrap:break-word!important;color:rgba(45,46,47,1);}
      @media only screen and (max-width:599px){
      .responsive .css-133wuwu{font-family:'Poppins','Helvetica Neue',Helvetica,Arial,sans-serif;font-size:24px;font-weight:700;-webkit-letter-spacing:-0.4px;-moz-letter-spacing:-0.4px;-ms-letter-spacing:-0.4px;letter-spacing:-0.4px;line-height:32px;}
      }
      .css-14s1wf{border:1px solid rgba(200,201,202,1)!important;border-radius:4px;cursor:text;max-width:630px;min-height:320px;display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-flex-direction:column;-ms-flex-direction:column;flex-direction:column;}
      @media only screen and (max-width:599px){
      .responsive .css-14s1wf{min-height:440px;}
      }
      .css-10687n6{-webkit-align-content:normal;-ms-flex-line-pack:normal;align-content:normal;-webkit-align-items:baseline;-webkit-box-align:baseline;-ms-flex-align:baseline;align-items:baseline;box-sizing:border-box;display:-webkit-box;display:-webkit-flex;display:-ms-flexbox;display:flex;-webkit-flex-direction:row;-ms-flex-direction:row;flex-direction:row;-webkit-flex-wrap:nowrap;-ms-flex-wrap:nowrap;flex-wrap:nowrap;-webkit-box-pack:normal;-webkit-justify-content:normal;-ms-flex-pack:normal;justify-content:normal;}
      .css-1r871ch{box-sizing:border-box;-webkit-box-flex:1;-webkit-flex-grow:1;-ms-flex-positive:1;flex-grow:1;}
      .css-qgunke{font-family:'Open Sans','Helvetica Neue',Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;-webkit-letter-spacing:0px;-moz-letter-spacing:0px;-ms-letter-spacing:0px;letter-spacing:0px;line-height:20px;color:rgba(45,46,47,1);text-align:left;}
      .css-aurft1{box-sizing:border-box;}
      .css-1bqnmih{-webkit-flex:1;-ms-flex:1;flex:1;position:relative;}
      .css-1sdb4og{font-family:'Open Sans','Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;line-height:22px;outline:none;border:0;width:100%;padding:0;resize:none;color:rgba(45,46,47,1);}
      .css-c7yo1x{min-height:24px;}
      .css-hv9ohz{-webkit-align-items:center;-webkit-box-align:center;-ms-flex-align:center;align-items:center;-webkit-appearance:none;-moz-appearance:none;appearance:none;background-image:none;background-repeat:no-repeat;border:0;border-radius:4px;box-shadow:none;box-sizing:border-box;display:-webkit-inline-box;display:-webkit-inline-flex;display:-ms-inline-flexbox;display:inline-flex;cursor:pointer;height:40px;-webkit-box-pack:center;-webkit-justify-content:center;-ms-flex-pack:center;justify-content:center;margin:0;padding-bottom:8px;padding-left:16px;padding-right:16px;padding-top:8px;position:relative;text-align:center;-webkit-transition:all 0.8s;transition:all 0.8s;-webkit-transition-property:background-image,background-color,background-position,background-size,border-color,box-shadow,opacity;transition-property:background-image,background-color,background-position,background-size,border-color,box-shadow,opacity;-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;user-select:none;vertical-align:middle;width:100%;background-color:rgb(243 99 34);color:rgba(255,255,255,1);background-position:calc(var(--mousedown-x) - calc(var(--button-width,100px) * 200) / 2) calc(var(--mousedown-y) - calc(var(--button-width,100px) * 200) / 2);background-size:calc(var(--button-width,100px) * 200) calc(var(--button-width,100px) * 200);}
      .css-hv9ohz:disabled{background-color:rgba(235,235,235,1);background-image:none;border-color:rgba(235,235,235,1);box-shadow:none;color:rgba(200,201,202,1);outline:none;pointer-events:none;-webkit-transition:none;transition:none;}
      .css-hv9ohz:hover{box-shadow:0 1px 4px 0 rgba(0,0,0,0.3);}
      @media only screen and (max-width:599px){
      .responsive .css-hv9ohz{box-shadow:none;font-weight:normal;}
      }
      .css-hv9ohz:focus{outline:2px solid rgba(0,112,204,1);outline-offset:1px;}
      .css-hv9ohz:focus:not(:focus-visible){outline:0;}
      @media (pointer:coarse){
      .css-hv9ohz:hover{box-shadow:none;}
      }
      .css-hv9ohz:active{color:rgba(255,255,255,1);}
      .css-hv9ohz:focus{background-color:rgb(249,19,27);}
      .css-hv9ohz:hover{background-color:rgb(244,13,21);color:rgba(255,255,255,1);}
      .css-6a0jil{width:16px;height:16px;display:inline-block;vertical-align:middle;position:relative;overflow:hidden;top:-0.1em;fill:rgba(45,46,47,1);}
      .css-6a0jil::before{position:absolute;display:block;left:0;}
      .css-6a0jil::after{content:'';display:block;position:absolute;left:0;right:0;top:0;bottom:0;}
      .css-6a0jil svg{position:absolute;width:100%;height:100%;fill:inherit;display:block;left:0;top:0;right:0;bottom:0;}
      .css-h19vjk{font-family:'Poppins','Helvetica Neue',Helvetica,Arial,sans-serif;font-size:20px;font-weight:700;-webkit-letter-spacing:-0.4px;-moz-letter-spacing:-0.4px;-ms-letter-spacing:-0.4px;letter-spacing:-0.4px;line-height:28px;word-wrap:break-word!important;word-break:break-word!important;overflow-wrap:break-word!important;color:rgba(45,46,47,1);}
      @media only screen and (max-width:599px){
      .responsive .css-h19vjk{font-family:'Poppins','Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:700;-webkit-letter-spacing:-0.2px;-moz-letter-spacing:-0.2px;-ms-letter-spacing:-0.2px;letter-spacing:-0.2px;line-height:24px;}
      }
      .css-1pz4y59{border-radius:50%;vertical-align:middle;box-sizing:border-box;}
      .css-ux5mu6{font-family:'Open Sans','Helvetica Neue',Helvetica,Arial,sans-serif;font-size:16px;font-weight:700;-webkit-letter-spacing:0px;-moz-letter-spacing:0px;-ms-letter-spacing:0px;letter-spacing:0px;line-height:24px;color:rgba(45,46,47,1);text-align:left;}
      .css-1q44n7j{-webkit-appearance:none;-moz-appearance:none;appearance:none;display:inline-block;-webkit-text-decoration:none;text-decoration:none;box-sizing:border-box;color:rgba(255,255,255,1);padding:4px;border-radius:4px;height:16px;white-space:nowrap;background-color:rgb(242 97 34);border:0;outline:none;margin:0;vertical-align:inherit;cursor:pointer;opacity:1;-webkit-transition:background-color 0.2s ease;transition:background-color 0.2s ease;}
      .css-1q44n7j:hover{background-color:#c70606;-webkit-text-decoration:none;text-decoration:none;}
      .css-1q44n7j:focus{outline:2px solid rgba(0,112,204,1);outline-offset:1px;}
      .css-1q44n7j:focus:not(:focus-visible){outline:0;}
      .css-1adhs7a{font-family:'Open Sans','Helvetica Neue',Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;-webkit-letter-spacing:0px;-moz-letter-spacing:0px;-ms-letter-spacing:0px;letter-spacing:0px;line-height:20px;color:inherit;text-align:left;font-size:10px;line-height:8px;font-weight:bold;vertical-align:top;}
      .css-1nrzw89{width:16px;height:16px;display:inline-block;vertical-align:middle;position:relative;overflow:hidden;top:-0.1em;fill:rgba(110,112,114,1);}
      .css-1nrzw89::before{position:absolute;display:block;left:0;}
      .css-1nrzw89::after{content:'';display:block;position:absolute;left:0;right:0;top:0;bottom:0;}
      .css-1nrzw89 svg{position:absolute;width:100%;height:100%;fill:inherit;display:block;left:0;top:0;right:0;bottom:0;}
      .css-1fnccdf{font-family:'Open Sans','Helvetica Neue',Helvetica,Arial,sans-serif;font-size:14px;font-weight:600;-webkit-letter-spacing:0px;-moz-letter-spacing:0px;-ms-letter-spacing:0px;letter-spacing:0px;line-height:20px;color:rgba(110,112,114,1);text-align:left;}
      .css-chan6m{font-family:'Open Sans','Helvetica Neue',Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;-webkit-letter-spacing:0px;-moz-letter-spacing:0px;-ms-letter-spacing:0px;letter-spacing:0px;line-height:20px;color:rgba(110,112,114,1);text-align:left;}
      .css-2sacua{font-family:'Open Sans','Helvetica Neue',Helvetica,Arial,sans-serif;font-size:14px;font-weight:400;-webkit-letter-spacing:0px;-moz-letter-spacing:0px;-ms-letter-spacing:0px;letter-spacing:0px;line-height:20px;color:rgba(45,46,47,1);text-align:left;margin-bottom:16px;}
      .css-105z2ub{-webkit-appearance:none;-moz-appearance:none;appearance:none;background-color:transparent;border:0;border-radius:3px;box-shadow:none;color:rgba(2,122,151,1);cursor:pointer;font-size:inherit;padding:0;margin:0;}
      .css-105z2ub:active,.css-105z2ub:hover{color:rgba(2,122,151,1);outline:none;-webkit-text-decoration:underline;text-decoration:underline;}
      .css-105z2ub:focus{outline:2px solid rgba(0,112,204,1);outline-offset:1px;}
      .css-105z2ub:focus:not(:focus-visible){outline:0;}
      @media (pointer:coarse){
      .css-105z2ub:hover{-webkit-text-decoration:none;text-decoration:none;}
      }
      .css-15j7fnr{font-family:'Open Sans','Helvetica Neue',Helvetica,Arial,sans-serif;font-size:inherit;font-weight:400;-webkit-letter-spacing:0px;-moz-letter-spacing:0px;-ms-letter-spacing:0px;letter-spacing:0px;line-height:inherit;color:inherit;text-align:left;font-weight:600;}
      .css-war30n{font-family:'Open Sans','Helvetica Neue',Helvetica,Arial,sans-serif;font-size:14px;font-weight:600;-webkit-letter-spacing:0px;-moz-letter-spacing:0px;-ms-letter-spacing:0px;letter-spacing:0px;line-height:20px;color:inherit;text-align:left;}


      @media(max-width: 767px){
         .container{
            width: auto;
         }
         .container__09f24__l8gaY ,.content__09f24__NVMF4,.content-inner__09f24__mIjzs{
             min-width: 100%;
         }
         .header__09f24__SEy5F {
             display: inherit;
             flex-wrap: inherit;
             margin: 0;
         }
         .sidebar__09f24__D0ndm {
             position: static;
             width: 100%;
         }
         .css-1kngrp9 {
             position: static;
         }
         .css-14s1wf {
             max-width: 100%;
             min-height: auto;
         }
         .css-c7yo1x {
             min-height: auto;
         }
      }
     
   </style>
</head>
<div class=" content__09f24__AjZ3s border-color--default__09f24__NPAKY">
   <div class=" container__09f24__l8gaY">
      <div class=" content__09f24__NVMF4">
         <main class="border-color--default__09f24__NPAKY" id="main-content">
            <div class=" content-inner__09f24__mIjzs border-color--default__09f24__NPAKY">
               <div class=" header__09f24__SEy5F border-color--default__09f24__NPAKY">
                  <div class=" biz-header-title-container__09f24__gKmY4 border-color--default__09f24__NPAKY">
                     <a href="#" class="biz-header-title-link__09f24__DJFkk css-1q6i1gy" target="_blank" rel="noopener noreferrer" role="link">
                        <h1 class="css-133wuwu"><?= $pro['title'] ?></h1>
                     </a>
                  </div>
                  <div class=" biz-header-guidelines-container__09f24__XD_xp border-color--default__09f24__NPAKY"><a href="#" class="review-guidelines-link css-1q6i1gy" role="link">Read our review guidelines</a></div>
               </div>
               <div class=" border-color--default__09f24__NPAKY">
                  <form class="" action="<?= base_url('home/add_rate') ?>" >
                     <div class=" border-color--default__09f24__NPAKY">
                        <div class=" css-14s1wf padding-t3__09f24__TMrIW padding-r3__09f24__eaF7p padding-b3__09f24__S8R2d padding-l3__09f24__IOjKY border-color--default__09f24__NPAKY" role="presentation">
                           <div class=" css-10687n6 margin-b3__09f24__l9v5d border-color--default__09f24__NPAKY" gap="1">
                              <div class=" css-1r871ch border-color--default__09f24__NPAKY">
                                 <fieldset class=" rating-selector__09f24__LNhhs">
                                    <div id="rateYo"></div>
                                    <input type="hidden" value="0" name="rating" id="rate" />
                                    <input type="hidden" value="<?= $pro['product_id'] ?>" name="pid" id="pid" />
                                    <div class=" description__09f24__qRKe3 border-color--default__09f24__NPAKY" aria-hidden="true">
                                       <p class="description-text--non-zero__09f24__Ln52s css-qgunke">/</p>
                                    </div>
                                 </fieldset>
                              </div>
                              <div class=" css-aurft1 border-color--default__09f24__NPAKY nowrap__09f24__lBkC2"></div>
                           </div>
                           <div class=" css-1bqnmih border-color--default__09f24__NPAKY">
                              <div class="css-1sdb4og" contenteditable="true" spellcheck="true" data-lexical-editor="true" style="user-select: text; white-space: pre-wrap; word-break: break-word;" role="textbox">
                                 <p><br></p>
                              </div>
                              <textarea name="comment" class="" placeholder="Add comment here"></textarea>
                           </div>
                           <div class=" css-c7yo1x margin-t3__09f24__riq4X border-color--default__09f24__NPAKY background-color--white__09f24__ulvSM"></div>
                        </div>
                     </div>
                     <div class=" margin-t4__09f24__G0VVf padding-b6__09f24__hfdiP border-color--default__09f24__NPAKY" style="max-width:200px"><button type="button"  id="rate_form" class=" css-hv9ohz" data-activated="false" data-testid="post-button" value="submit" data-button="true"><span class="css-1enow5j" data-font-weight="semibold">Post Review</span></button></div>
                  </form>
                  <div></div>
               </div>
            </div>
         </main>
      </div>
   </div>
   <aside class=" border-color--default__09f24__NPAKY">
      <div class=" sidebar__09f24__D0ndm responsive-hidden-medium__09f24__yxacI border-color--default__09f24__NPAKY">
         
         <div class=" sidebar-inner__09f24__9wnuF sidebar-inner border-color--default__09f24__NPAKY">
            <div class=" margin-t2__09f24__b0bxj margin-b2__09f24__CEMjT border-color--default__09f24__NPAKY">
               <h2 class="css-h19vjk">Recent Reviews</h2>
            </div>
                            <div class="row">
                    <?php
                    // var_dump($pro);
                    $rating = $this->db->where('product_id', $pro['product_id'])->get('user_rating')->result_array();
                    // var_dump($rating);
                    foreach($rating as $k=> $v){
                    ?>
                    <div class="col-sm-12 cilent_gapp" style="margin-bottom: 20px;">
                        <div class="info_client">
                            <?php
                            
                            $user_id = $v['user_id'];
                            $users = $this->db->where('user_id', $user_id)->get('user')->row();
                            // var_dump($users);
                            ?>
                            <img src="
                            <?php 
                                // $user_id = $v['user_id'];
                                if(file_exists('uploads/user_image/user_'.$user_id.'.jpg')){ 
                                    
                                    echo $this->crud_model->file_view('user',$user_id,'100','100','no','src','','','.jpg').'?t='.time();
                                } else if(empty($row['fb_id']) !== true){ 
                                    echo 'https://graph.facebook.com/'. $row['fb_id'] .'/picture?type=large';
                                } else if(empty($row['g_id']) !== true ){
                                    echo $row['g_photo'];
                                } else {
                                    echo base_url().'uploads/user_image/default.jpg';
                                } 
                            ?>
                            " alt="">
                            <h4><?= $users->username?></h4>
                            <p>“<?= $v['comment'];?>”</p>
                            <div class="rating">
                                <?php
                                for($i =1; $i<=5;$i++)
                                {
                                    if($i<= $v['rating'])
                                    {
                                        ?>
                                        <i class="fa fa-star"></i>
                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                        <i class="fa fa-star gray"></i>
                                        <?php
                                    }
                                }
                                ?>
                            <span><?= $v['rating'];?></span>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                </div>

            <!--<div class=" margin-r1__09f24__rN_ga margin-b3__09f24__l9v5d padding-b3__09f24__S8R2d border--bottom__09f24___mg5X border-color--default__09f24__NPAKY" style="word-break:break-word">-->
            <!--   <div class=" margin-b3__09f24__l9v5d border-color--default__09f24__NPAKY">-->
            <!--      <div class=" border-color--default__09f24__NPAKY" role="region" aria-label="Priyanka K.">-->
            <!--         <div class=" arrange__09f24__LDfbs gutter-1__09f24__yAbCL vertical-align-middle__09f24__zU9sE border-color--default__09f24__NPAKY">-->
            <!--            <div class=" arrange-unit__09f24__rqHTg border-color--default__09f24__NPAKY">-->
            <!--               <div class=" css-0 border-color--default__09f24__NPAKY"><img class=" css-1pz4y59" src="https://ads.strokedev.net/template/front/images/ls.jpg" srcset="https://ads.strokedev.net/template/front/images/ls.jpg" alt="Photo of Priyanka K." height="40" width="40" loading="lazy" draggable="true"></div>-->
            <!--            </div>-->
            <!--            <div class=" arrange-unit__09f24__rqHTg arrange-unit-fill__09f24__CUubG border-color--default__09f24__NPAKY">-->
            <!--               <div class=" user-passport-info border-color--default__09f24__NPAKY">-->
            <!--                  <span class="fs-block css-ux5mu6" data-font-weight="bold">Priyanka K.</span>-->
            <!--                  <div class=" elite-badge__09f24__dykWK display--inline-block__09f24__fEDiJ margin-l1__09f24__m8GL9 border-color--default__09f24__NPAKY"><a href="#" class="css-1q44n7j"><span class="css-1adhs7a">Elite 22</span></a></div>-->
            <!--               </div>-->
            <!--               <div class=" display--inline-block__09f24__fEDiJ border-color--default__09f24__NPAKY">-->
            <!--                  <div class=" user-passport-stats__09f24__NQxB4 border-color--default__09f24__NPAKY">-->
            <!--                     <div class=" display--inline-block__09f24__fEDiJ margin-r1__09f24__rN_ga border-color--default__09f24__NPAKY" aria-label="Friends">-->
            <!--                        <span alt="" aria-hidden="true" role="img" class="icon--16-friends-v2 css-1nrzw89">-->
            <!--                           <svg width="16" height="16" class="icon_svg">-->
            <!--                              <path d="M11.231 1.25H4.769A3.523 3.523 0 001.25 4.77v6.46a3.523 3.523 0 003.519 3.52h6.462a3.524 3.524 0 003.519-3.52V4.77a3.523 3.523 0 00-3.519-3.52zm-6.462 1.5h6.462a2.022 2.022 0 012.019 2.02v6.223a8.71 8.71 0 00-2.218-1.177c.164-.395.249-.819.25-1.247V7.562a3.281 3.281 0 10-6.563 0v1.007c0 .428.085.852.249 1.247-.792.283-1.54.68-2.218 1.177V4.77a2.022 2.022 0 012.019-2.02zm5.012 5.82a1.781 1.781 0 01-3.562 0V7.561a1.781 1.781 0 013.562 0v1.007zm1.45 4.68H4.769a2.007 2.007 0 01-1.49-.668.415.415 0 01.15-.237 7.259 7.259 0 012.498-1.254 3.21 3.21 0 004.144.002c.907.25 1.756.676 2.5 1.252.076.06.129.143.15.237a2.007 2.007 0 01-1.49.668z"></path>-->
            <!--                           </svg>-->
            <!--                        </span>-->
            <!--                        <span class=" display--inline__09f24__c6N_k padding-l0-5__09f24__tBn3z border-color--default__09f24__NPAKY"><span class=" css-1fnccdf" data-font-weight="semibold">169</span></span>-->
            <!--                     </div>-->
            <!--                     <div class=" display--inline-block__09f24__fEDiJ margin-r1__09f24__rN_ga border-color--default__09f24__NPAKY" aria-label="Reviews">-->
            <!--                        <span alt="" aria-hidden="true" role="img" class="icon--16-review-v2 css-1nrzw89">-->
            <!--                           <svg width="16" height="16" class="icon_svg">-->
            <!--                              <path d="M11.231 14.75H4.769a3.524 3.524 0 01-3.519-3.52V4.77a3.523 3.523 0 013.519-3.52h6.462a3.523 3.523 0 013.519 3.52v6.46a3.523 3.523 0 01-3.519 3.52zm-6.462-12A2.022 2.022 0 002.75 4.77v6.46a2.022 2.022 0 002.019 2.02h6.462a2.022 2.022 0 002.019-2.02V4.77a2.022 2.022 0 00-2.019-2.02H4.769z"></path>-->
            <!--                              <path d="M11.226 7.229a.5.5 0 00-.404-.341l-1.64-.239-.734-1.486a.522.522 0 00-.896 0L6.818 6.65l-1.64.239a.5.5 0 00-.277.853l1.187 1.156-.28 1.633a.5.5 0 00.725.528L8 10.286l1.467.772a.498.498 0 00.725-.528l-.28-1.633L11.1 7.741a.5.5 0 00.127-.512z"></path>-->
            <!--                           </svg>-->
            <!--                        </span>-->
            <!--                        <span class=" display--inline__09f24__c6N_k padding-l0-5__09f24__tBn3z border-color--default__09f24__NPAKY"><span class=" css-1fnccdf" data-font-weight="semibold">111</span></span>-->
            <!--                     </div>-->
            <!--                     <div class=" display--inline-block__09f24__fEDiJ margin-r1__09f24__rN_ga border-color--default__09f24__NPAKY" aria-label="Photos">-->
            <!--                        <span alt="" aria-hidden="true" role="img" class="icon--16-photos-v2 css-1nrzw89">-->
            <!--                           <svg width="16" height="16" class="icon_svg">-->
            <!--                              <path d="M5.076 6.674a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"></path>-->
            <!--                              <path d="M11.231 1.25H4.769A3.523 3.523 0 001.25 4.77v6.46c.002.441.087.878.252 1.287l-.003.003.005.005a3.519 3.519 0 003.265 2.225h6.462a3.524 3.524 0 003.519-3.52V4.77a3.523 3.523 0 00-3.519-3.52zM2.75 11.23V4.77a2.022 2.022 0 012.019-2.02h6.462a2.022 2.022 0 012.019 2.02v4.096l-1.363-1.08a4.097 4.097 0 00-5.3.163l-3.822 3.433c-.004-.05-.015-.1-.015-.152zm8.481 2.02H4.769a2 2 0 01-1.298-.486l4.118-3.7a2.6 2.6 0 013.365-.103l2.296 1.82v.45a2.022 2.022 0 01-2.019 2.019z"></path>-->
            <!--                           </svg>-->
            <!--                        </span>-->
            <!--                        <span class=" display--inline__09f24__c6N_k padding-l0-5__09f24__tBn3z border-color--default__09f24__NPAKY"><span class=" css-1fnccdf" data-font-weight="semibold">140</span></span>-->
            <!--                     </div>-->
            <!--                  </div>-->
            <!--               </div>-->
            <!--            </div>-->
            <!--         </div>-->
            <!--      </div>-->
            <!--   </div>-->
            <!--   <div class=" arrange__09f24__LDfbs gutter-1-5__09f24__vMtpw margin-b1__09f24__vaLrm border-color--default__09f24__NPAKY">-->
            <!--      <div class=" arrange-unit__09f24__rqHTg border-color--default__09f24__NPAKY">-->
            <!--         <span class=" display--inline__09f24__c6N_k border-color--default__09f24__NPAKY">-->
            <!--            <div class=" i-stars__09f24__M1AR7 i-stars--regular-5__09f24__tKNMk border-color--default__09f24__NPAKY overflow--hidden__09f24___ayzG" aria-label="5 star rating" role="img"><img class=" offscreen__09f24__gZT9P" src="https://s3-media0.fl.yelpcdn.com/assets/public/stars_v2.yji-59bbc2cf8e3d4be04fcc.png" width="132" height="560" alt=""></div>-->
            <!--         </span>-->
            <!--      </div>-->
            <!--      <div class=" arrange-unit__09f24__rqHTg arrange-unit-fill__09f24__CUubG border-color--default__09f24__NPAKY">-->
            <!--         <p class=" css-chan6m">7/18/2022</p>-->
            <!--      </div>-->
            <!--   </div>-->
            <!--   <div class=" border-color--default__09f24__NPAKY">-->
            <!--      <div class=" border-color--default__09f24__NPAKY" role="region" aria-live="polite" id="expander-link-content-a4ca5e1e-1032-4525-9399-3bfeb43ab2fb">-->
            <!--         <div class=" border-color--default__09f24__NPAKY">-->
            <!--            <p class=" css-2sacua">Tried their amazing vegetarian burger today as takeout, and I'm an instant fan. I didn't need to add sauces to give it flavor since it had its own personality!</p>-->
            <!--            <p class=" css-2sacua">My husband tried out the chicken burger which he thoroughly enjoyed as well.</p>-->
            <!--            <p class=" css-2sacua">Honestly I was starving and I could have had two of the burgers to feel full.</p>-->
            <!--            <p class=" css-qgunke">Can't wait to check out this place in person!</p>-->
            <!--         </div>-->
            <!--      </div>-->
            <!--      <button class=" css-105z2ub" aria-expanded="true" aria-controls="expander-link-content-a4ca5e1e-1032-4525-9399-3bfeb43ab2fb" type="submit">-->
            <!--         <span class="css-15j7fnr">-->
            <!--            <p class=" css-war30n" data-font-weight="semibold">Read less</p>-->
            <!--         </span>-->
            <!--      </button>-->
            <!--   </div>-->
            <!--</div>-->
           
            
            
            
         </div>
      </div>
   </aside>
</div>
<script>
    $(function () {
 
  $("#rateYo").rateYo({
    starWidth: "40px",
    fullStar: true,
    onSet: function (rating, rateYoInstance) {
        $('#rate').val(rating);
    }
  });
 
});
$('#rate_form').click(function(){
    var form = $('form');
    var here = $(this);
    $.ajax({
				url: form.attr('action')+'?'+form.serialize(), // form action url
				type: 'POST', // form submit method get/post
				dataType: 'html', // request type html/json/xml
				data: form.serialize(), // serialize form data 
				cache       : false,
				contentType : false,
				processData : false,
				beforeSend: function() {
					here.addClass('disabled');
					here.html('submitting'); // change submit button text
				},
				success: function(data) {
					here.fadeIn();
					here.html('Post Review');
					here.removeClass('disabled');
					if(data == '1'){
						notify('Review add successfully!','success','bottom','right');
						window.location.replace("<?php echo $this->crud_model->product_link($pro['product_id']); ?>");

					}else {
						notify(data,'warning','bottom','right');
					}
				},
				error: function(e) {
					console.log(e)
				}
			});
});
</script>