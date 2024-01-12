<style>
.chosen-drop{
    z-index: 99999;
    overflow: hidden;
    position: absolute !important;
}
    .margin-left-50{
        margin-left: 50px !important;
    }
    .card{
        background:#fff;
        padding 10px;
    }
    .mainnav-sm #main_menu{
        display:none !important;
    }
    .mainnav-lg #main_menu{
        display:block !important;
    }
    #product_add4 .form-group span{
        margin-left: 16px;
        font-size: 11px;
    }
    .label-danger
    {
        float:none !important;
    }
    .h-100
    {
        height: 100% !important;
    }
    .border{
        border:1px solid #e9e9e9;
        border-radius:5px;
        margin:5px;
    }
    .card .card-header h5{
        font-size:2rem !important;
    }
    .card .card-header {
    display: -webkit-box;
    display: -ms-flexbox;
        border-top: 2px solid orange;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: justify;
    -ms-flex-pack: justify;
    justify-content: space-between;
    position: relative;
    padding: 12px 25px;
    border-bottom: 1px solid #ebedf2;
    min-height: 50px;
    border-top-left-radius: 4px;
    border-top-right-radius: 4px;
    background-color: transparent;
}
.gallary_images ul li {
    width: 250px;
    height: 180px;
    position:relative;
    margin-bottom:10px;
}
.gallary_images ul li img{
    width:100%;
    height:100%;
}
.btm_border label{
    text-align:left!important;
}
.footer_btns{
    position:fixed;
    right:0;
    bottom:10px;
    z-index:123;
}
.alert_red{
    width:96%;
    float:right;
}
@media(max-width:767px){
.mobile_res{
    margin: 0!important;
    padding:0!important;
}
.margin_sm_0{
    margin:0!important;
}
.position_alert{
    position: relative;
    margin-top: 170px;
}
.alert_red {
    z-index: 99;
    position: absolute;
    top: -60px;
    width:100%;

}
.brand-title .brand-text{
    line-height:1.7!important;
    font-size:14px;
}
.tgl-menu-btn .mainnav-toggle{
    margin-right:15px;
}
.navbar-top-links .tgl-menu-btn {
    margin-right:15px;
}
.margin-left-50{
    margin:0!important;
}
#container.mainnav-in.footer-fixed #footer, #container.mainnav-in #content-container, #container.mainnav-in #footer {
    left: 215px!important;
}


.cat_breed .sec_sev_close{
        font-size: 18px!important;
}
.cat_breed p {
    position: relative;
    width: 44%!important;
}
#bpage_cats{
    width:100%!important;
}
.gallary_images ul {
    padding: 0;

    display: flex!important;
    gap: 15px;
    align-items: center;
}
.gallary_images ul li {
   height: auto!important;
   width:50%!important;
   
}
.card .card-body {
     padding: 0!important;
}}
</style>
<style>
    /*

Don't modify this file.
use custom-style.css

*/

:root {
    --blue: #007bff;
    --indigo: #6610f2;
    --purple: #6f42c1;
    --pink: #e83e8c;
    --red: #dc3545;
    --orange: #fd7e14;
    --yellow: #ffc107;
    --green: #28a745;
    --teal: #20c997;
    --cyan: #17a2b8;
    --white: #fff;
    --gray: #6c757d;
    --gray-dark: #343a40;
    --primary: #000;
    --hov-primary: #000;
    --soft-primary: rgba(245, 161, 0, 0.15);
    --secondary: #8f97ab;
    --soft-secondary: rgba(143, 151, 171, 0.15);
    --success: #0abb75;
    --soft-success: rgba(10, 187, 117, 0.15);
    --info: #25bcf1;
    --soft-info: rgba(37, 188, 241, 0.15);
    --warning: #ffc519;
    --soft-warning: rgba(255, 197, 25, 0.15);
    --danger: #ef486a;
    --soft-danger: rgba(239, 72, 106, 0.15);
    --light: #fcfcfc;
    --dark: #111723;
    --soft-dark: rgba(42, 50, 66, 0.15);
    --breakpoint-xs: 0;
    --breakpoint-sm: 576px;
    --breakpoint-md: 768px;
    --breakpoint-lg: 992px;
    --breakpoint-xl: 1200px;
    --font-family-sans-serif: -apple-system, BlinkMacSystemFont, "Segoe UI",
        Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif,
        "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol",
        "Noto Color Emoji";
    --font-family-monospace: SFMono-Regular, Menlo, Monaco, Consolas,
        "Liberation Mono", "Courier New", monospace;
}
.tagify {
    --tags-border-color: #e2e5ec;
    --tag-bg: #e2e5ec;
    --tag-hover: #d9e6ff;
    --tag-text-color: #212529;
    --tag-text-color--edit: #212529;
    --tag-pad: 0.3rem 0.5rem;
    --tag-inset-shadow-size: 1.1em;
    --tag-invalid-color: #d39494;
    --tag-invalid-bg: rgba(253, 57, 75, 0.5);
    --tag-remove-bg: rgba(253, 57, 75, 0.3);
    --tag-remove-btn-bg: none;
    --tag-remove-btn-bg--hover: #fd394b;
    --tag--min-width: 1ch;
    --tag--max-width: auto;
    --tag-hide-transition: 0.3s;
    --loader-size: 0.8em;
}
pre {
    white-space: initial;
}
small {
    font-size: 11px;
    opacity: 0.6;
}

/* common helper utilites */
.c-scrollbar::-webkit-scrollbar {
    width: 4px;
    background: #1e1e2d;
    border-radius: 3px;
}
.c-scrollbar::-webkit-scrollbar-track {
    background: transparent;
}
.c-scrollbar::-webkit-scrollbar-thumb {
    background: rgba(255, 255, 255, 0.2);
    border-radius: 3px;
}
.c-scrollbar {
    scrollbar-color: rgba(255, 255, 255, 0.2);
    scrollbar-width: thin;
}

.c-scrollbar-light::-webkit-scrollbar,
.uppy-Dashboard-files::-webkit-scrollbar,
.bootstrap-select .dropdown-menu .inner::-webkit-scrollbar {
    width: 4px;
    background: rgba(24, 28, 41, 0.08);
    border-radius: 3px;
}
.c-scrollbar-light::-webkit-scrollbar-track,
.uppy-Dashboard-files::-webkit-scrollbar-track,
.bootstrap-select .dropdown-menu .inner::-webkit-scrollbar-track {
    background: transparent;
}
.c-scrollbar-light::-webkit-scrollbar-thumb,
.uppy-Dashboard-files::-webkit-scrollbar-thumb,
.bootstrap-select .dropdown-menu .inner::-webkit-scrollbar-thumb {
    background: rgba(24, 28, 41, 0.1);
    border-radius: 3px;
}
.c-scrollbar-light,
.uppy-Dashboard-files,
.bootstrap-select .dropdown-menu .inner {
    scrollbar-color: rgba(24, 28, 41, 0.08);
    scrollbar-width: thin;
}

.no-scrollbar::-webkit-scrollbar {
    width: 0;
}
.no-scrollbar::-webkit-scrollbar-track {
    background: transparent;
}
.no-scrollbar::-webkit-scrollbar-thumb {
    background: transparent;
}

.img-fit {
    max-height: 100%;
    width: 100%;
    object-fit: cover;
}

.overlay {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    transition: all 0.3s ease-in;
    -webkit-transition: all 0.3s ease-in;
    z-index: 1;
    background-color: rgba(0, 0, 0, 0.6);
}
.overlay.overlay-fixed {
    position: fixed;
}
.hov-overlay .overlay,
.hov-container .hov-box {
    visibility: hidden;
    opacity: 0;
    -webkit-transition: visibility 0.3s ease, opacity 0.3s ease;
    transition: visibility 0.3s ease, opacity 0.3s ease;
}
.hov-overlay:hover .overlay,
.hov-container:hover .hov-box {
    visibility: visible;
    opacity: 1;
}
.fullscreen {
    min-height: 100vh;
}
.holiday .card-body{
    background: #ff9500;
}
.holiday .card-body img{
    width: 100%;
}

/*modal 1050
backdrop 1040
fixed-bottom 1030*/

.z--1 {
    z-index: -1 !important;
}
.z-0 {
    z-index: 0 !important;
}
.z-1 {
    z-index: 1 !important;
}
.z-2 {
    z-index: 2 !important;
}
.z-3 {
    z-index: 3 !important;
}
.z-1020 {
    z-index: 1020 !important;
}
.z-1035 {
    z-index: 1035 !important;
}
.z-1045 {
    z-index: 1045 !important;
}

.minw-0 {
    min-width: 0;
}
.text-truncate-2 {
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
}
.text-truncate-3 {
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
}
.c-pointer {
    cursor: pointer !important;
}
.c-not-allowed {
    cursor: not-allowed !important;
}
.c-default {
    cursor: default !important;
}

.attached-top,
.attached-bottom {
    position: absolute;
    left: 0;
    right: 0;
    width: 100%;
    z-index: 2;
}
.attached-top {
    top: 0;
}
.attached-bottom {
    bottom: 0;
}
.separator {
    position: relative;
    text-align: center;
    z-index: 1;
}

.separator:before {
    position: absolute;
    content: "";
    width: 100%;
    height: 1px;
    background: #ebedf2;
    left: 0;
    right: 0;
    top: 50%;
    z-index: -1;
}
.absolute-center {
    position: absolute;
    top: 50%;
    left: 50%;
    -webkit-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%);
}
.absolute-full {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    width: 100%;
    height: 100%;
}
.absolute-top-right {
    position: absolute;
    top: 0;
    right: 0;
}
[dir="rtl"] .absolute-top-right {
    right: auto;
    left: 0;
}
.absolute-top-left {
    position: absolute;
    top: 0;
    left: 0;
}
[dir="rtl"] .absolute-top-left {
    left: auto;
    right: 0;
}
.absolute-bottom-right {
    position: absolute;
    bottom: 0;
    right: 0;
}
[dir="rtl"] .absolute-bottom-right {
    left: auto;
    right: 0;
}
.absolute-bottom-left {
    position: absolute;
    bottom: 0;
    left: 0;
}
[dir="rtl"] .absolute-bottom-left {
    left: auto;
    right: 0;
}
.absolute-top-center {
    position: absolute;
    top: 0;
    left: 50%;
    -webkit-transform: translateX(-50%);
    transform: translateX(-50%);
}
.sticky-bottom {
    position: -webkit-sticky;
    position: sticky;
    bottom: 0;
    z-index: 1020;
}
.recommended-ribbon {
    font-size: 12px;
    font-weight: 700;
    text-transform: uppercase;
    color: #fff;
    background: #ff0000;
    transform: rotate(45deg);
    -webkit-transform: rotate(45deg);
    padding: 5px 30px;
    top: 29px;
    right: -40px;
}

.dot-loader > div {
    display: inline-flex;
    width: 8px;
    height: 8px;
    border-radius: 100%;
    margin: 0 2px;
    background: #777;
    -webkit-animation: loader 1.48s ease-in-out infinite both;
    animation: loader 1.48s ease-in-out infinite both;
}
.dot-loader > div:nth-child(1) {
    -webkit-animation-delay: -0.32s;
    animation-delay: -0.32s;
}
.dot-loader > div:nth-child(2) {
    -webkit-animation-delay: -0.16s;
    animation-delay: -0.16s;
}

@-webkit-keyframes loader {
    0%,
    80%,
    100% {
        -webkit-transform: scale(0);
        transform: scale(0);
        opacity: 0.2;
    }
    40% {
        -webkit-transform: scale(1);
        transform: scale(1);
        opacity: 0.8;
    }
}

@keyframes loader {
    0%,
    80%,
    100% {
        -webkit-transform: scale(0);
        transform: scale(0);
        opacity: 0.2;
    }
    40% {
        -webkit-transform: scale(1);
        transform: scale(1);
        opacity: 0.8;
    }
}
@media (max-width: 991.98px) {
    .mobile-hor-swipe {
        -webkit-overflow-scrolling: touch;
        overflow-x: auto;
        white-space: nowrap;
    }
}
.top-0 {
    top: 0 !important;
}
.top-100 {
    top: 100% !important;
}
.bottom-0 {
    bottom: 0 !important;
}
.bottom-100 {
    bottom: 100% !important;
}
.left-0 {
    left: 0 !important;
}
.left-100 {
    left: 100% !important;
}
.right-0 {
    right: 0 !important;
}
.right-100 {
    right: 100% !important;
}

/*bootstrap extend*/
.fw-100 {
    font-weight: 100 !important;
}
.fw-200 {
    font-weight: 200 !important;
}
.fw-300 {
    font-weight: 300 !important;
}
.fw-400 {
    font-weight: 400 !important;
}
.fw-500 {
    font-weight: 500 !important;
}
.fw-600 {
    font-weight: 600 !important;
}
.fw-700 {
    font-weight: 700 !important;
}
.fw-800 {
    font-weight: 800 !important;
}
.fw-900 {
    font-weight: 900 !important;
}

.fs-8 {
    font-size: 0.5rem !important;
}
.fs-9 {
    font-size: 0.5625rem !important;
}
.fs-10 {
    font-size: 0.625rem !important;
}
.fs-11 {
    font-size: 0.6875rem !important;
}
.fs-12 {
    font-size: 0.75rem !important;
}
.fs-13 {
    font-size: 0.8125rem !important;
}
.fs-14 {
    font-size: 0.875rem !important;
}
.fs-15 {
    font-size: 0.9375rem !important;
}
.fs-15 {
    font-size: 0.9375rem !important;
}
.fs-16 {
    font-size: 1rem !important;
}
.fs-17 {
    font-size: 1.0625rem !important;
}
.fs-18 {
    font-size: 1.125rem !important;
}
.fs-19 {
    font-size: 1.1875rem !important;
}
.fs-20 {
    font-size: 1.25rem !important;
}
.fs-21 {
    font-size: 1.3125rem !important;
}
.fs-22 {
    font-size: 1.375rem !important;
}
.fs-23 {
    font-size: 1.4375rem !important;
}
.fs-24 {
    font-size: 1.5rem !important;
}

.ts-01 {
    -webkit-text-stroke: 0.1px;
    text-stroke: 0.1px;
}
.ts-02 {
    -webkit-text-stroke: 0.2px;
    text-stroke: 0.2px;
}
.ts-03 {
    -webkit-text-stroke: 0.3px;
    text-stroke: 0.3px;
}
.ts-04 {
    -webkit-text-stroke: 0.4px;
    text-stroke: 0.4px;
}
.ts-05 {
    -webkit-text-stroke: 0.5px;
    text-stroke: 0.5px;
}
.ts-06 {
    -webkit-text-stroke: 0.6px;
    text-stroke: 0.6px;
}
.ts-07 {
    -webkit-text-stroke: 0.7px;
    text-stroke: 0.7px;
}
.ts-08 {
    -webkit-text-stroke: 0.8px;
    text-stroke: 0.8px;
}
.ts-09 {
    -webkit-text-stroke: 0.9px;
    text-stroke: 0.9px;
}
.ts-10 {
    -webkit-text-stroke: 1px;
    text-stroke: 1px;
}
.ts-20 {
    -webkit-text-stroke: 2px;
    text-stroke: 2px;
}
.ts-30 {
    -webkit-text-stroke: 3px;
    text-stroke: 3px;
}
.ts-40 {
    -webkit-text-stroke: 4px;
    text-stroke: 4px;
}
.ts-50 {
    -webkit-text-stroke: 5px;
    text-stroke: 5px;
}

.lh-1 {
    line-height: 1 !important;
}
.lh-1-1 {
    line-height: 1.1 !important;
}
.lh-1-2 {
    line-height: 1.2 !important;
}
.lh-1-3 {
    line-height: 1.3 !important;
}
.lh-1-4 {
    line-height: 1.4 !important;
}
.lh-1-5 {
    line-height: 1.5 !important;
}
.lh-1-6 {
    line-height: 1.6 !important;
}
.lh-1-7 {
    line-height: 1.7 !important;
}
.lh-1-8 {
    line-height: 1.8 !important;
}
.lh-1-9 {
    line-height: 1.9 !important;
}
.lh-2 {
    line-height: 2 !important;
}

.opacity-0 {
    opacity: 0 !important;
}
.opacity-10 {
    opacity: 0.1 !important;
}
.opacity-20 {
    opacity: 0.2 !important;
}
.opacity-30 {
    opacity: 0.3 !important;
}
.opacity-40 {
    opacity: 0.4 !important;
}
.opacity-50 {
    opacity: 0.5 !important;
}
.opacity-60 {
    opacity: 0.6 !important;
}
.opacity-70 {
    opacity: 0.7 !important;
}
.opacity-80 {
    opacity: 0.8 !important;
}
.opacity-90 {
    opacity: 0.9 !important;
}
.opacity-100 {
    opacity: 1 !important;
}

.hov-opacity-0:hover {
    opacity: 0 !important;
}
.hov-opacity-10:hover {
    opacity: 0.1 !important;
}
.hov-opacity-20:hover {
    opacity: 0.2 !important;
}
.hov-opacity-30:hover {
    opacity: 0.3 !important;
}
.hov-opacity-40:hover {
    opacity: 0.4 !important;
}
.hov-opacity-50:hover {
    opacity: 0.5 !important;
}
.hov-opacity-60:hover {
    opacity: 0.6 !important;
}
.hov-opacity-70:hover {
    opacity: 0.7 !important;
}
.hov-opacity-80:hover {
    opacity: 0.8 !important;
}
.hov-opacity-90:hover {
    opacity: 0.9 !important;
}
.hov-opacity-100:hover {
    opacity: 1 !important;
}

.shadow-xs {
    box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.05) !important;
}
.shadow-sm {
    box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05) !important;
}
.shadow {
    box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06) !important;
}
.shadow-md {
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1),
        0 2px 4px -1px rgba(0, 0, 0, 0.06) !important;
}
.shadow-lg {
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1),
        0 4px 6px -2px rgba(0, 0, 0, 0.05) !important;
}
.shadow-xl {
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1),
        0 10px 10px -5px rgba(0, 0, 0, 0.04) !important;
}
.shadow-2xl {
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25) !important;
}
.shadow-none {
    box-shadow: none !important;
}

.hov-shadow-xs:hover {
    box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.05) !important;
}
.hov-shadow-sm:hover {
    box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05) !important;
}
.hov-shadow:hover {
    box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06) !important;
}
.hov-shadow-md:hover {
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1),
        0 2px 4px -1px rgba(0, 0, 0, 0.06) !important;
}
.hov-shadow-lg:hover {
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1),
        0 4px 6px -2px rgba(0, 0, 0, 0.05) !important;
}
.hov-shadow-xl:hover {
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1),
        0 10px 10px -5px rgba(0, 0, 0, 0.04) !important;
}
.hov-shadow-2xl:hover {
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25) !important;
}
.hov-shadow-none:hover {
    box-shadow: none !important;
}

.bg-cover {
    background-size: cover;
}
.bg-center {
    background-position: center center;
}
.bg-no-repeat {
    background-repeat: no-repeat;
}

.bg-primary {
    background-color: var(--primary) !important;
}
.bg-soft-primary {
    background-color: var(--soft-primary) !important;
}
.bg-secondary {
    background-color: var(--secondary) !important;
}
.bg-soft-secondary {
    background-color: var(--soft-secondary) !important;
}
.bg-success {
    background-color: var(--success) !important;
}
.bg-soft-success {
    background-color: var(--soft-success) !important;
}
.bg-info {
    background-color: var(--info) !important;
}
.bg-soft-info {
    background-color: var(--soft-info) !important;
}
.bg-warning {
    background-color: var(--warning) !important;
}
.bg-soft-warning {
    background-color: var(--soft-warning) !important;
}
.bg-danger {
    background-color: var(--danger) !important;
}
.bg-soft-danger {
    background-color: var(--soft-danger) !important;
}
.bg-dark {
    background-color: var(--dark) !important;
}
.bg-soft-dark {
    background-color: var(--soft-dark) !important;
}
.bg-light {
    background-color: var(--light) !important;
}
.bg-black {
    background-color: #0d111b !important;
}

.hov-bg-primary:hover {
    background-color: var(--primary) !important;
}
.hov-bg-soft-primary:hover {
    background-color: var(--soft-primary) !important;
}
.hov-bg-secondary:hover {
    background-color: var(--secondary) !important;
}
.hov-bg-soft-secondary:hover {
    background-color: var(--soft-secondary) !important;
}
.hov-bg-success:hover {
    background-color: var(--success) !important;
}
.hov-bg-soft-success:hover {
    background-color: var(--soft-success) !important;
}
.hov-bg-info:hover {
    background-color: var(--info) !important;
}
.hov-bg-soft-info:hover {
    background-color: var(--soft-info) !important;
}
.hov-bg-warning:hover {
    background-color: var(--warning) !important;
}
.hov-bg-soft-warning:hover {
    background-color: var(--soft-warning) !important;
}
.hov-bg-danger:hover {
    background-color: var(--danger) !important;
}
.hov-bg-soft-danger:hover {
    background-color: var(--soft-danger) !important;
}
.hov-bg-dark:hover {
    background-color: var(--dark) !important;
}
.hov-bg-soft-dark:hover {
    background-color: var(--soft-dark) !important;
}
.hov-bg-light:hover {
    background-color: var(--light) !important;
}
.hov-bg-black:hover {
    background-color: #0d111b !important;
}
.hov-bg-white:hover {
    background-color: #fff !important;
}

.bg-grad-1 {
    background-color: #eb4786;
    background-image: linear-gradient(315deg, #eb4786 0%, #b854a6 74%);
}
.bg-grad-2 {
    background-color: #875fc0;
    background-image: linear-gradient(315deg, #875fc0 0%, #5346ba 74%);
}
.bg-grad-3 {
    background-color: #47c5f4;
    background-image: linear-gradient(315deg, #47c5f4 0%, #6791d9 74%);
}
.bg-grad-4 {
    background-color: #ffb72c;
    background-image: linear-gradient(315deg, #ffb72c 0%, #f57f59 74%);
}

[class*="border"],
hr {
    border-color: #e0e0e0 !important;
}

.border-gray-100 {
    border-color: #f7fafc !important;
}
.border-gray-200 {
    border-color: #edf2f7 !important;
}
.border-gray-300 {
    border-color: #e2e8f0 !important;
}
.border-gray-400 {
    border-color: #cbd5e0 !important;
}
.border-gray-500 {
    border-color: #a0aec0 !important;
}
.border-gray-600 {
    border-color: #718096 !important;
}
.border-gray-700 {
    border-color: #4a5568 !important;
}
.border-gray-800 {
    border-color: #2d3748 !important;
}
.border-gray-900 {
    border-color: #1a202c !important;
}

.border-primary {
    border-color: var(--primary) !important;
}
.border-secondary {
    border-color: var(--secondary) !important;
}
.border-success {
    border-color: var(--success) !important;
}
.border-info {
    border-color: var(--info) !important;
}
.border-warning {
    border-color: var(--warning) !important;
}
.border-danger {
    border-color: var(--danger) !important;
}
.border-light {
    border-color: var(--light) !important;
}
.border-dark {
    border-color: var(--dark) !important;
}

.border-soft-primary {
    border-color: var(--soft-primary) !important;
}
.border-soft-secondary {
    border-color: var(--soft-secondary) !important;
}
.border-soft-success {
    border-color: var(--soft-success) !important;
}
.border-soft-info {
    border-color: var(--soft-info) !important;
}
.border-soft-warning {
    border-color: var(--soft-warning) !important;
}
.border-soft-danger {
    border-color: var(--soft-danger) !important;
}
.border-soft-dark {
    border-color: var(--soft-dark) !important;
}
.spinner-border {
    border-right-color: transparent !important;
}

.border-width-2 {
    border-width: 2px !important;
}
.border-width-3 {
    border-width: 3px !important;
}
.border-width-4 {
    border-width: 4px !important;
}

.border-dotted {
    border-style: dotted !important;
}
.border-dashed {
    border-style: dashed !important;
}

.text-primary {
    color: var(--primary) !important;
}
.text-soft-primary {
    color: var(--soft-primary) !important;
}
.text-secondary {
    color: var(--secondary) !important;
}
.text-soft-secondary {
    color: var(--soft-secondary) !important;
}
.text-success {
    color: var(--success) !important;
}
.text-soft-success {
    color: var(--soft-success) !important;
}
.text-info {
    color: var(--info) !important;
}
.text-soft-info {
    color: var(--soft-info) !important;
}
.text-warning {
    color: var(--warning) !important;
}
.text-soft-warning {
    color: var(--soft-warning) !important;
}
.text-danger {
    color: var(--danger) !important;
}
.text-soft-danger {
    color: var(--soft-danger) !important;
}
.text-dark {
    color: var(--dark) !important;
}
.text-soft-dark {
    color: var(--soft-dark) !important;
}
.text-light {
    color: var(--light) !important;
}
.text-inherit {
    color: inherit !important;
}

.hov-text-primary:hover {
    color: var(--primary) !important;
}
.hov-text-soft-primary:hover {
    color: var(--soft-primary) !important;
}
.hov-text-secondary:hover {
    color: var(--secondary) !important;
}
.hov-text-soft-secondary:hover {
    color: var(--soft-secondary) !important;
}
.hov-text-success:hover {
    color: var(--success) !important;
}
.hov-text-soft-success:hover {
    color: var(--soft-success) !important;
}
.hov-text-info:hover {
    color: var(--info) !important;
}
.hov-text-soft-info:hover {
    color: var(--soft-info) !important;
}
.hov-text-warning:hover {
    color: var(--warning) !important;
}
.hov-text-soft-warning:hover {
    color: var(--soft-warning) !important;
}
.hov-text-danger:hover {
    color: var(--danger) !important;
}
.hov-text-soft-danger:hover {
    color: var(--soft-danger) !important;
}
.hov-text-dark:hover {
    color: var(--dark) !important;
}
.hov-text-soft-dark:hover {
    color: var(--soft-dark) !important;
}
.hov-text-light:hover {
    color: var(--light) !important;
}
.hov-text-white:hover {
    color: #fff !important;
}

.w-auto {
    width: auto;
}
.w-5px,
.size-5px {
    width: 5px;
}
.w-10px,
.size-10px {
    width: 10px;
}
.w-15px,
.size-15px {
    width: 15px;
}
.w-20px,
.size-20px {
    width: 20px;
}
.w-25px,
.size-25px {
    width: 25px;
}
.w-30px,
.size-30px {
    width: 30px;
}
.w-35px,
.size-35px {
    width: 35px;
}
.w-40px,
.size-40px {
    width: 40px;
}
.w-45px,
.size-45px {
    width: 45px;
}
.w-50px,
.size-50px {
    width: 50px;
}
.w-60px,
.size-60px {
    width: 60px;
}
.w-70px,
.size-70px {
    width: 70px;
}
.w-80px,
.size-80px {
    width: 80px;
}
.w-90px,
.size-90px {
    width: 90px;
}
.w-100px,
.size-100px {
    width: 100px;
}
.w-110px,
.size-110px {
    width: 110px;
}
.w-120px,
.size-120px {
    width: 120px;
}
.w-130px,
.size-130px {
    width: 130px;
}
.w-140px,
.size-140px {
    width: 140px;
}
.w-150px,
.size-150px {
    width: 150px;
}
.w-160px,
.size-160px {
    width: 160px;
}
.w-170px,
.size-170px {
    width: 170px;
}
.w-180px,
.size-180px {
    width: 180px;
}
.w-190px,
.size-190px {
    width: 190px;
}
.w-200px,
.size-200px {
    width: 200px;
}
.w-210px,
.size-210px {
    width: 210px;
}
.w-220px,
.size-220px {
    width: 220px;
}
.w-230px,
.size-230px {
    width: 230px;
}
.w-240px,
.size-240px {
    width: 240px;
}
.w-250px,
.size-250px {
    width: 250px;
}
.w-260px,
.size-260px {
    width: 260px;
}
.w-270px,
.size-270px {
    width: 270px;
}
.w-280px,
.size-280px {
    width: 280px;
}
.w-290px,
.size-290px {
    width: 290px;
}
.w-300px,
.size-300px {
    width: 300px;
}
.w-310px,
.size-310px {
    width: 310px;
}
.w-320px,
.size-320px {
    width: 320px;
}
.w-330px,
.size-330px {
    width: 330px;
}
.w-340px,
.size-340px {
    width: 340px;
}
.w-350px,
.size-350px {
    width: 350px;
}
.w-360px,
.size-360px {
    width: 360px;
}
.w-370px,
.size-370px {
    width: 370px;
}
.w-380px,
.size-380px {
    width: 380px;
}
.w-390px,
.size-390px {
    width: 390px;
}
.w-400px,
.size-400px {
    width: 400px;
}
.w-410px,
.size-410px {
    width: 410px;
}
.w-420px,
.size-420px {
    width: 420px;
}
.w-450px,
.size-450px {
    width: 450px;
}
.w-500px,
.size-500px {
    width: 500px;
}

.h-auto {
    height: auto;
}
.h-5px,
.size-5px {
    height: 5px;
}
.h-10px,
.size-10px {
    height: 10px;
}
.h-15px,
.size-15px {
    height: 15px;
}
.h-20px,
.size-20px {
    height: 20px;
}
.h-25px,
.size-25px {
    height: 25px;
}
.h-30px,
.size-30px {
    height: 30px;
}
.h-35px,
.size-35px {
    height: 35px;
}
.h-40px,
.size-40px {
    height: 40px;
}
.h-45px,
.size-45px {
    height: 45px;
}
.h-50px,
.size-50px {
    height: 50px;
}
.h-60px,
.size-60px {
    height: 60px;
}
.h-70px,
.size-70px {
    height: 70px;
}
.h-80px,
.size-80px {
    height: 80px;
}
.h-90px,
.size-90px {
    height: 90px;
}
.h-100px,
.size-100px {
    height: 100px;
}
.h-110px,
.size-110px {
    height: 110px;
}
.h-120px,
.size-120px {
    height: 120px;
}
.h-130px,
.size-130px {
    height: 130px;
}
.h-140px,
.size-140px {
    height: 140px;
}
.h-150px,
.size-150px {
    height: 150px;
}
.h-160px,
.size-160px {
    height: 160px;
}
.h-170px,
.size-170px {
    height: 170px;
}
.h-180px,
.size-180px {
    height: 180px;
}
.h-190px,
.size-190px {
    height: 190px;
}
.h-200px,
.size-200px {
    height: 200px;
}
.h-210px,
.size-210px {
    height: 210px;
}
.h-220px,
.size-220px {
    height: 220px;
}
.h-230px,
.size-230px {
    height: 230px;
}
.h-240px,
.size-240px {
    height: 240px;
}
.h-250px,
.size-250px {
    height: 250px;
}
.h-260px,
.size-260px {
    height: 260px;
}
.h-270px,
.size-270px {
    height: 270px;
}
.h-280px,
.size-280px {
    height: 280px;
}
.h-290px,
.size-290px {
    height: 290px;
}
.h-300px,
.size-300px {
    height: 300px;
}
.h-310px,
.size-310px {
    height: 310px;
}
.h-320px,
.size-320px {
    height: 320px;
}
.h-330px,
.size-330px {
    height: 330px;
}
.h-340px,
.size-340px {
    height: 340px;
}
.h-350px,
.size-350px {
    height: 350px;
}
.h-360px,
.size-360px {
    height: 360px;
}
.h-370px,
.size-370px {
    height: 370px;
}
.h-380px,
.size-380px {
    height: 380px;
}
.h-390px,
.size-390px {
    height: 390px;
}
.h-400px,
.size-400px {
    height: 400px;
}
.h-410px,
.size-410px {
    height: 410px;
}
.h-420px,
.size-420px {
    height: 420px;
}
.h-450px,
.size-450px {
    height: 450px;
}
.h-500px,
.size-500px {
    height: 500px;
}

.pl-6,
.px-6,
.p-6 {
    padding-left: 4rem;
}
.pl-7,
.px-7,
.p-7 {
    padding-left: 5rem;
}
.pl-8,
.px-8,
.p-8 {
    padding-left: 6rem;
}
.pl-9,
.px-9,
.p-9 {
    padding-left: 8rem;
}
.pl-10,
.px-10,
.p-10 {
    padding-left: 10rem;
}
.pl-11,
.px-11,
.p-11 {
    padding-left: 12rem;
}
.pl-12,
.px-12,
.p-12 {
    padding-left: 16rem;
}

.pr-6,
.px-6,
.p-6 {
    padding-right: 4rem;
}
.pr-7,
.px-7,
.p-7 {
    padding-right: 5rem;
}
.pr-8,
.px-8,
.p-8 {
    padding-right: 6rem;
}
.pr-9,
.px-9,
.p-9 {
    padding-right: 8rem;
}
.pr-10,
.px-10,
.p-10 {
    padding-right: 10rem;
}
.pr-11,
.px-11,
.p-11 {
    padding-right: 12rem;
}
.pr-12,
.px-12,
.p-12 {
    padding-right: 16rem;
}

.pt-6,
.py-6,
.p-6 {
    padding-top: 4rem;
}
.pt-7,
.py-7,
.p-7 {
    padding-top: 5rem;
}
.pt-8,
.py-8,
.p-8 {
    padding-top: 6rem;
}
.pt-9,
.py-9,
.p-9 {
    padding-top: 8rem;
}
.pt-10,
.py-10,
.p-10 {
    padding-top: 10rem;
}
.pt-11,
.py-11,
.p-11 {
    padding-top: 12rem;
}
.pt-12,
.py-12,
.p-12 {
    padding-top: 16rem;
}

.pb-6,
.py-6,
.p-6 {
    padding-bottom: 4rem;
}
.pb-7,
.py-7,
.p-7 {
    padding-bottom: 5rem;
}
.pb-8,
.py-8,
.p-8 {
    padding-bottom: 6rem;
}
.pb-9,
.py-9,
.p-9 {
    padding-bottom: 8rem;
}
.pb-10,
.py-10,
.p-10 {
    padding-bottom: 10rem;
}
.pb-11,
.py-11,
.p-11 {
    padding-bottom: 12rem;
}
.pb-12,
.py-12,
.p-12 {
    padding-bottom: 16rem;
}

.pl-5px,
.px-5px,
.p-5px {
    padding-left: 5px;
}
.pl-10px,
.px-10px,
.p-10px {
    padding-left: 10px;
}
.pl-15px,
.px-15px,
.p-15px {
    padding-left: 15px;
}
.pl-20px,
.px-20px,
.p-20px {
    padding-left: 20px;
}
.pl-25px,
.px-25px,
.p-25px {
    padding-left: 25px;
}
.pl-30px,
.px-30px,
.p-30px {
    padding-left: 30px;
}

.pr-5px,
.px-5px,
.p-5px {
    padding-right: 5px;
}
.pr-10px,
.px-10px,
.p-10px {
    padding-right: 10px;
}
.pr-15px,
.px-15px,
.p-15px {
    padding-right: 15px;
}
.pr-20px,
.px-20px,
.p-20px {
    padding-right: 20px;
}
.pr-25px,
.px-25px,
.p-25px {
    padding-right: 25px;
}
.pr-30px,
.px-30px,
.p-30px {
    padding-right: 30px;
}

.pt-5px,
.py-5px,
.p-5px {
    padding-top: 5px;
}
.pt-10px,
.py-10px,
.p-10px {
    padding-top: 10px;
}
.pt-15px,
.py-15px,
.p-15px {
    padding-top: 15px;
}
.pt-20px,
.py-20px,
.p-20px {
    padding-top: 20px;
}
.pt-25px,
.py-25px,
.p-25px {
    padding-top: 25px;
}
.pt-30px,
.py-30px,
.p-30px {
    padding-top: 30px;
}

.pb-5px,
.py-5px,
.p-5px {
    padding-bottom: 5px;
}
.pb-10px,
.py-10px,
.p-10px {
    padding-bottom: 10px;
}
.pb-15px,
.py-15px,
.p-15px {
    padding-bottom: 15px;
}
.pb-20px,
.py-20px,
.p-20px {
    padding-bottom: 20px;
}
.pb-25px,
.py-25px,
.p-25px {
    padding-bottom: 25px;
}
.pb-30px,
.py-30px,
.p-30px {
    padding-bottom: 30px;
}

.col-xxl-1,
.col-xxl-2,
.col-xxl-3,
.col-xxl-4,
.col-xxl-5,
.col-xxl-6,
.col-xxl-7,
.col-xxl-8,
.col-xxl-9,
.col-xxl-10,
.col-xxl-11,
.col-xxl-12,
.col-xxl,
.col-xxl-auto {
    position: relative;
    width: 100%;
    padding-right: 15px;
    padding-left: 15px;
}

.gutters-5 {
    margin-right: -5px;
    margin-left: -5px;
}
.gutters-5 > .col,
.gutters-5 > [class*="col-"] {
    padding-right: 5px;
    padding-left: 5px;
}
.gutters-10 {
    margin-right: -10px;
    margin-left: -10px;
}
.gutters-10 > .col,
.gutters-10 > [class*="col-"] {
    padding-right: 10px;
    padding-left: 10px;
}
.gutters-20 {
    margin-right: -20px;
    margin-left: -20px;
}
.gutters-20 > .col,
.gutters-20 > [class*="col-"] {
    padding-right: 20px;
    padding-left: 20px;
}
.gutters-25 {
    margin-right: -25px;
    margin-left: -25px;
}
.gutters-25 > .col,
.gutters-25 > [class*="col-"] {
    padding-right: 25px;
    padding-left: 25px;
}
.gutters-30 {
    margin-right: -30px;
    margin-left: -30px;
}
.gutters-30 > .col,
.gutters-30 > [class*="col-"] {
    padding-right: 30px;
    padding-left: 30px;
}

[dir="rtl"] .row-cols-1 > * {
    -ms-flex: 0 0 100%;
    flex: 0 0 100%;
    max-width: 100%;
}
[dir="rtl"] .row-cols-2 > * {
    -ms-flex: 0 0 50%;
    flex: 0 0 50%;
    max-width: 50%;
}
[dir="rtl"] .row-cols-3 > * {
    -ms-flex: 0 0 33.333333%;
    flex: 0 0 33.333333%;
    max-width: 33.333333%;
}
[dir="rtl"] .row-cols-4 > * {
    -ms-flex: 0 0 25%;
    flex: 0 0 25%;
    max-width: 25%;
}
[dir="rtl"] .row-cols-5 > * {
    -ms-flex: 0 0 20%;
    flex: 0 0 20%;
    max-width: 20%;
}
[dir="rtl"] .row-cols-6 > * {
    -ms-flex: 0 0 16.666667%;
    flex: 0 0 16.666667%;
    max-width: 16.666667%;
}
/* sm */
@media (min-width: 576px) {
    .border-sm {
        border: 1px solid #e2e5ec !important;
    }
    .border-sm-top {
        border-top: 1px solid #e2e5ec !important;
    }
    .border-sm-right {
        border-right: 1px solid #e2e5ec !important;
    }
    .border-sm-bottom {
        border-bottom: 1px solid #e2e5ec !important;
    }
    .border-sm-left {
        border-left: 1px solid #e2e5ec !important;
    }
    .border-sm-0 {
        border: 0 !important;
    }
    .border-sm-top-0 {
        border-top: 0 !important;
    }
    .border-sm-right-0 {
        border-right: 0 !important;
    }
    .border-sm-bottom-0 {
        border-bottom: 0 !important;
    }
    .border-sm-left-0 {
        border-left: 0 !important;
    }

    .w-sm-25 {
        width: 25% !important;
    }
    .w-sm-50 {
        width: 50% !important;
    }
    .w-sm-75 {
        width: 75% !important;
    }
    .w-sm-100 {
        width: 100% !important;
    }
    .w-sm-auto {
        width: auto !important;
    }

    .pl-sm-6,
    .px-sm-6,
    .p-sm-6 {
        padding-left: 4rem;
    }
    .pl-sm-7,
    .px-sm-7,
    .p-sm-7 {
        padding-left: 5rem;
    }
    .pl-sm-8,
    .px-sm-8,
    .p-sm-8 {
        padding-left: 6rem;
    }
    .pl-sm-9,
    .px-sm-9,
    .p-sm-9 {
        padding-left: 8rem;
    }
    .pl-sm-10,
    .px-sm-10,
    .p-sm-10 {
        padding-left: 10rem;
    }
    .pl-sm-11,
    .px-sm-11,
    .p-sm-11 {
        padding-left: 12rem;
    }
    .pl-sm-12,
    .px-sm-12,
    .p-sm-12 {
        padding-left: 16rem;
    }

    .pr-sm-6,
    .px-sm-6,
    .p-sm-6 {
        padding-right: 4rem;
    }
    .pr-sm-7,
    .px-sm-7,
    .p-sm-7 {
        padding-right: 5rem;
    }
    .pr-sm-8,
    .px-sm-8,
    .p-sm-8 {
        padding-right: 6rem;
    }
    .pr-sm-9,
    .px-sm-9,
    .p-sm-9 {
        padding-right: 8rem;
    }
    .pr-sm-10,
    .px-sm-10,
    .p-sm-10 {
        padding-right: 10rem;
    }
    .pr-sm-11,
    .px-sm-11,
    .p-sm-11 {
        padding-right: 12rem;
    }
    .pr-sm-12,
    .px-sm-12,
    .p-sm-12 {
        padding-right: 16rem;
    }

    .pt-sm-6,
    .py-sm-6,
    .p-sm-6 {
        padding-top: 4rem;
    }
    .pt-sm-7,
    .py-sm-7,
    .p-sm-7 {
        padding-top: 5rem;
    }
    .pt-sm-8,
    .py-sm-8,
    .p-sm-8 {
        padding-top: 6rem;
    }
    .pt-sm-9,
    .py-sm-9,
    .p-sm-9 {
        padding-top: 8rem;
    }
    .pt-sm-10,
    .py-sm-10,
    .p-sm-10 {
        padding-top: 10rem;
    }
    .pt-sm-11,
    .py-sm-11,
    .p-sm-11 {
        padding-top: 12rem;
    }
    .pt-sm-12,
    .py-sm-12,
    .p-sm-12 {
        padding-top: 16rem;
    }

    .pb-sm-6,
    .py-sm-6,
    .p-sm-6 {
        padding-bottom: 4rem;
    }
    .pb-sm-7,
    .py-sm-7,
    .p-sm-7 {
        padding-bottom: 5rem;
    }
    .pb-sm-8,
    .py-sm-8,
    .p-sm-8 {
        padding-bottom: 6rem;
    }
    .pb-sm-9,
    .py-sm-9,
    .p-sm-9 {
        padding-bottom: 8rem;
    }
    .pb-sm-10,
    .py-sm-10,
    .p-sm-10 {
        padding-bottom: 10rem;
    }
    .pb-sm-11,
    .py-sm-11,
    .p-sm-11 {
        padding-bottom: 12rem;
    }
    .pb-sm-12,
    .py-sm-12,
    .p-sm-12 {
        padding-bottom: 16rem;
    }

    .pl-sm-5px,
    .px-sm-5px,
    .p-sm-5px {
        padding-left: 5px;
    }
    .pl-sm-10px,
    .px-sm-10px,
    .p-sm-10px {
        padding-left: 10px;
    }
    .pl-sm-15px,
    .px-sm-15px,
    .p-sm-15px {
        padding-left: 15px;
    }
    .pl-sm-20px,
    .px-sm-20px,
    .p-sm-20px {
        padding-left: 20px;
    }
    .pl-sm-25px,
    .px-sm-25px,
    .p-sm-25px {
        padding-left: 25px;
    }
    .pl-sm-30px,
    .px-sm-30px,
    .p-sm-30px {
        padding-left: 30px;
    }

    .pr-sm-5px,
    .px-sm-5px,
    .p-sm-5px {
        padding-right: 5px;
    }
    .pr-sm-10px,
    .px-sm-10px,
    .p-sm-10px {
        padding-right: 10px;
    }
    .pr-sm-15px,
    .px-sm-15px,
    .p-sm-15px {
        padding-right: 15px;
    }
    .pr-sm-20px,
    .px-sm-20px,
    .p-sm-20px {
        padding-right: 20px;
    }
    .pr-sm-25px,
    .px-sm-25px,
    .p-sm-25px {
        padding-right: 25px;
    }
    .pr-sm-30px,
    .px-sm-30px,
    .p-sm-30px {
        padding-right: 30px;
    }

    .pt-sm-5px,
    .py-sm-5px,
    .p-sm-5px {
        padding-top: 5px;
    }
    .pt-sm-10px,
    .py-sm-10px,
    .p-sm-10px {
        padding-top: 10px;
    }
    .pt-sm-15px,
    .py-sm-15px,
    .p-sm-15px {
        padding-top: 15px;
    }
    .pt-sm-20px,
    .py-sm-20px,
    .p-sm-20px {
        padding-top: 20px;
    }
    .pt-sm-25px,
    .py-sm-25px,
    .p-sm-25px {
        padding-top: 25px;
    }
    .pt-sm-30px,
    .py-sm-30px,
    .p-sm-30px {
        padding-top: 30px;
    }

    .pb-sm-5px,
    .py-sm-5px,
    .p-sm-5px {
        padding-bottom: 5px;
    }
    .pb-sm-10px,
    .py-sm-10px,
    .p-sm-10px {
        padding-bottom: 10px;
    }
    .pb-sm-15px,
    .py-sm-15px,
    .p-sm-15px {
        padding-bottom: 15px;
    }
    .pb-sm-20px,
    .py-sm-20px,
    .p-sm-20px {
        padding-bottom: 20px;
    }
    .pb-sm-25px,
    .py-sm-25px,
    .p-sm-25px {
        padding-bottom: 25px;
    }
    .pb-sm-30px,
    .py-sm-30px,
    .p-sm-30px {
        padding-bottom: 30px;
    }

    .w-sm-auto {
        width: auto;
    }
    .w-sm-5px,
    .size-sm-5px {
        width: 5px;
    }
    .w-sm-10px,
    .size-sm-10px {
        width: 10px;
    }
    .w-sm-15px,
    .size-sm-15px {
        width: 15px;
    }
    .w-sm-20px,
    .size-sm-20px {
        width: 20px;
    }
    .w-sm-25px,
    .size-sm-25px {
        width: 25px;
    }
    .w-sm-30px,
    .size-sm-30px {
        width: 30px;
    }
    .w-sm-35px,
    .size-sm-35px {
        width: 35px;
    }
    .w-sm-40px,
    .size-sm-40px {
        width: 40px;
    }
    .w-sm-45px,
    .size-sm-45px {
        width: 45px;
    }
    .w-sm-50px,
    .size-sm-50px {
        width: 50px;
    }
    .w-sm-60px,
    .size-sm-60px {
        width: 60px;
    }
    .w-sm-70px,
    .size-sm-70px {
        width: 70px;
    }
    .w-sm-80px,
    .size-sm-80px {
        width: 80px;
    }
    .w-sm-90px,
    .size-sm-90px {
        width: 90px;
    }
    .w-sm-100px,
    .size-sm-100px {
        width: 100px;
    }
    .w-sm-110px,
    .size-sm-110px {
        width: 110px;
    }
    .w-sm-120px,
    .size-sm-120px {
        width: 120px;
    }
    .w-sm-130px,
    .size-sm-130px {
        width: 130px;
    }
    .w-sm-140px,
    .size-sm-140px {
        width: 140px;
    }
    .w-sm-150px,
    .size-sm-150px {
        width: 150px;
    }
    .w-sm-160px,
    .size-sm-160px {
        width: 160px;
    }
    .w-sm-170px,
    .size-sm-170px {
        width: 170px;
    }
    .w-sm-180px,
    .size-sm-180px {
        width: 180px;
    }
    .w-sm-190px,
    .size-sm-190px {
        width: 190px;
    }
    .w-sm-200px,
    .size-sm-200px {
        width: 200px;
    }
    .w-sm-210px,
    .size-sm-210px {
        width: 210px;
    }
    .w-sm-220px,
    .size-sm-220px {
        width: 220px;
    }
    .w-sm-230px,
    .size-sm-230px {
        width: 230px;
    }
    .w-sm-240px,
    .size-sm-240px {
        width: 240px;
    }
    .w-sm-250px,
    .size-sm-250px {
        width: 250px;
    }
    .w-sm-260px,
    .size-sm-260px {
        width: 260px;
    }
    .w-sm-270px,
    .size-sm-270px {
        width: 270px;
    }
    .w-sm-280px,
    .size-sm-280px {
        width: 280px;
    }
    .w-sm-290px,
    .size-sm-290px {
        width: 290px;
    }
    .w-sm-300px,
    .size-sm-300px {
        width: 300px;
    }
    .w-sm-310px,
    .size-sm-310px {
        width: 310px;
    }
    .w-sm-320px,
    .size-sm-320px {
        width: 320px;
    }
    .w-sm-330px,
    .size-sm-330px {
        width: 330px;
    }
    .w-sm-340px,
    .size-sm-340px {
        width: 340px;
    }
    .w-sm-350px,
    .size-sm-350px {
        width: 350px;
    }
    .w-sm-360px,
    .size-sm-360px {
        width: 360px;
    }
    .w-sm-370px,
    .size-sm-370px {
        width: 370px;
    }
    .w-sm-380px,
    .size-sm-380px {
        width: 380px;
    }
    .w-sm-390px,
    .size-sm-390px {
        width: 390px;
    }
    .w-sm-400px,
    .size-sm-400px {
        width: 400px;
    }
    .w-sm-410px,
    .size-sm-410px {
        width: 410px;
    }
    .w-sm-420px,
    .size-sm-420px {
        width: 420px;
    }
    .w-sm-450px,
    .size-sm-450px {
        width: 450px;
    }
    .w-sm-500px,
    .size-sm-500px {
        width: 500px;
    }

    .h-sm-auto {
        height: auto;
    }
    .h-sm-5px,
    .size-sm-5px {
        height: 5px;
    }
    .h-sm-10px,
    .size-sm-10px {
        height: 10px;
    }
    .h-sm-15px,
    .size-sm-15px {
        height: 15px;
    }
    .h-sm-20px,
    .size-sm-20px {
        height: 20px;
    }
    .h-sm-25px,
    .size-sm-25px {
        height: 25px;
    }
    .h-sm-30px,
    .size-sm-30px {
        height: 30px;
    }
    .h-sm-35px,
    .size-sm-35px {
        height: 35px;
    }
    .h-sm-40px,
    .size-sm-40px {
        height: 40px;
    }
    .h-sm-45px,
    .size-sm-45px {
        height: 45px;
    }
    .h-sm-50px,
    .size-sm-50px {
        height: 50px;
    }
    .h-sm-60px,
    .size-sm-60px {
        height: 60px;
    }
    .h-sm-70px,
    .size-sm-70px {
        height: 70px;
    }
    .h-sm-80px,
    .size-sm-80px {
        height: 80px;
    }
    .h-sm-90px,
    .size-sm-90px {
        height: 90px;
    }
    .h-sm-100px,
    .size-sm-100px {
        height: 100px;
    }
    .h-sm-110px,
    .size-sm-110px {
        height: 110px;
    }
    .h-sm-120px,
    .size-sm-120px {
        height: 120px;
    }
    .h-sm-130px,
    .size-sm-130px {
        height: 130px;
    }
    .h-sm-140px,
    .size-sm-140px {
        height: 140px;
    }
    .h-sm-150px,
    .size-sm-150px {
        height: 150px;
    }
    .h-sm-160px,
    .size-sm-160px {
        height: 160px;
    }
    .h-sm-170px,
    .size-sm-170px {
        height: 170px;
    }
    .h-sm-180px,
    .size-sm-180px {
        height: 180px;
    }
    .h-sm-190px,
    .size-sm-190px {
        height: 190px;
    }
    .h-sm-200px,
    .size-sm-200px {
        height: 200px;
    }
    .h-sm-210px,
    .size-sm-210px {
        height: 210px;
    }
    .h-sm-220px,
    .size-sm-220px {
        height: 220px;
    }
    .h-sm-230px,
    .size-sm-230px {
        height: 230px;
    }
    .h-sm-240px,
    .size-sm-240px {
        height: 240px;
    }
    .h-sm-250px,
    .size-sm-250px {
        height: 250px;
    }
    .h-sm-260px,
    .size-sm-260px {
        height: 260px;
    }
    .h-sm-270px,
    .size-sm-270px {
        height: 270px;
    }
    .h-sm-280px,
    .size-sm-280px {
        height: 280px;
    }
    .h-sm-290px,
    .size-sm-290px {
        height: 290px;
    }
    .h-sm-300px,
    .size-sm-300px {
        height: 300px;
    }
    .h-sm-310px,
    .size-sm-310px {
        height: 310px;
    }
    .h-sm-320px,
    .size-sm-320px {
        height: 320px;
    }
    .h-sm-330px,
    .size-sm-330px {
        height: 330px;
    }
    .h-sm-340px,
    .size-sm-340px {
        height: 340px;
    }
    .h-sm-350px,
    .size-sm-350px {
        height: 350px;
    }
    .h-sm-360px,
    .size-sm-360px {
        height: 360px;
    }
    .h-sm-370px,
    .size-sm-370px {
        height: 370px;
    }
    .h-sm-380px,
    .size-sm-380px {
        height: 380px;
    }
    .h-sm-390px,
    .size-sm-390px {
        height: 390px;
    }
    .h-sm-400px,
    .size-sm-400px {
        height: 400px;
    }
    .h-sm-410px,
    .size-sm-410px {
        height: 410px;
    }
    .h-sm-420px,
    .size-sm-420px {
        height: 420px;
    }
    .h-sm-450px,
    .size-sm-450px {
        height: 450px;
    }
    .h-sm-500px,
    .size-sm-500px {
        height: 500px;
    }

    .sm-no-gutters {
        margin-right: -0px;
        margin-left: -0px;
    }
    .sm-no-gutters > .col,
    .sm-no-gutters > [class*="col-"] {
        padding-right: 0px;
        padding-left: 0px;
    }
    .sm-gutters-5 {
        margin-right: -5px;
        margin-left: -5px;
    }
    .sm-gutters-5 > .col,
    .sm-gutters-5 > [class*="col-"] {
        padding-right: 5px;
        padding-left: 5px;
    }
    .sm-gutters-10 {
        margin-right: -10px;
        margin-left: -10px;
    }
    .sm-gutters-10 > .col,
    .sm-gutters-10 > [class*="col-"] {
        padding-right: 10px;
        padding-left: 10px;
    }
    .sm-gutters-15 {
        margin-right: -15px;
        margin-left: -15px;
    }
    .sm-gutters-15 > .col,
    .sm-gutters-15 > [class*="col-"] {
        padding-right: 15px;
        padding-left: 15px;
    }
    .sm-gutters-20 {
        margin-right: -20px;
        margin-left: -20px;
    }
    .sm-gutters-20 > .col,
    .sm-gutters-20 > [class*="col-"] {
        padding-right: 20px;
        padding-left: 20px;
    }
    .sm-gutters-25 {
        margin-right: -25px;
        margin-left: -25px;
    }
    .sm-gutters-25 > .col,
    .sm-gutters-25 > [class*="col-"] {
        padding-right: 25px;
        padding-left: 25px;
    }
    .sm-gutters-30 {
        margin-right: -30px;
        margin-left: -30px;
    }
    .sm-gutters-30 > .col,
    .sm-gutters-30 > [class*="col-"] {
        padding-right: 30px;
        padding-left: 30px;
    }

    .flex-grow-sm-0 {
        -ms-flex-positive: 0 !important;
        flex-grow: 0 !important;
    }
    .flex-grow-sm-1 {
        -ms-flex-positive: 1 !important;
        flex-grow: 1 !important;
    }
    [dir="rtl"] .row-cols-sm-1 > * {
        -ms-flex: 0 0 100%;
        flex: 0 0 100%;
        max-width: 100%;
    }
    [dir="rtl"] .row-cols-sm-2 > * {
        -ms-flex: 0 0 50%;
        flex: 0 0 50%;
        max-width: 50%;
    }
    [dir="rtl"] .row-cols-sm-3 > * {
        -ms-flex: 0 0 33.333333%;
        flex: 0 0 33.333333%;
        max-width: 33.333333%;
    }
    [dir="rtl"] .row-cols-sm-4 > * {
        -ms-flex: 0 0 25%;
        flex: 0 0 25%;
        max-width: 25%;
    }
    [dir="rtl"] .row-cols-sm-5 > * {
        -ms-flex: 0 0 20%;
        flex: 0 0 20%;
        max-width: 20%;
    }
    [dir="rtl"] .row-cols-sm-6 > * {
        -ms-flex: 0 0 16.666667%;
        flex: 0 0 16.666667%;
        max-width: 16.666667%;
    }
}
/* md */
@media (min-width: 768px) {
    .border-md {
        border: 1px solid #e2e5ec !important;
    }
    .border-md-top {
        border-top: 1px solid #e2e5ec !important;
    }
    .border-md-right {
        border-right: 1px solid #e2e5ec !important;
    }
    .border-md-bottom {
        border-bottom: 1px solid #e2e5ec !important;
    }
    .border-md-left {
        border-left: 1px solid #e2e5ec !important;
    }
    .border-md-0 {
        border: 0 !important;
    }
    .border-md-top-0 {
        border-top: 0 !important;
    }
    .border-md-right-0 {
        border-right: 0 !important;
    }
    .border-md-bottom-0 {
        border-bottom: 0 !important;
    }
    .border-md-left-0 {
        border-left: 0 !important;
    }

    .w-md-25 {
        width: 25% !important;
    }
    .w-md-50 {
        width: 50% !important;
    }
    .w-md-75 {
        width: 75% !important;
    }
    .w-md-100 {
        width: 100% !important;
    }
    .w-md-auto {
        width: auto !important;
    }

    .pl-md-6,
    .px-md-6,
    .p-md-6 {
        padding-left: 4rem;
    }
    .pl-md-7,
    .px-md-7,
    .p-md-7 {
        padding-left: 5rem;
    }
    .pl-md-8,
    .px-md-8,
    .p-md-8 {
        padding-left: 6rem;
    }
    .pl-md-9,
    .px-md-9,
    .p-md-9 {
        padding-left: 8rem;
    }
    .pl-md-10,
    .px-md-10,
    .p-md-10 {
        padding-left: 10rem;
    }
    .pl-md-11,
    .px-md-11,
    .p-md-11 {
        padding-left: 12rem;
    }
    .pl-md-12,
    .px-md-12,
    .p-md-12 {
        padding-left: 16rem;
    }

    .pr-md-6,
    .px-md-6,
    .p-md-6 {
        padding-right: 4rem;
    }
    .pr-md-7,
    .px-md-7,
    .p-md-7 {
        padding-right: 5rem;
    }
    .pr-md-8,
    .px-md-8,
    .p-md-8 {
        padding-right: 6rem;
    }
    .pr-md-9,
    .px-md-9,
    .p-md-9 {
        padding-right: 8rem;
    }
    .pr-md-10,
    .px-md-10,
    .p-md-10 {
        padding-right: 10rem;
    }
    .pr-md-11,
    .px-md-11,
    .p-md-11 {
        padding-right: 12rem;
    }
    .pr-md-12,
    .px-md-12,
    .p-md-12 {
        padding-right: 16rem;
    }

    .pt-md-6,
    .py-md-6,
    .p-md-6 {
        padding-top: 4rem;
    }
    .pt-md-7,
    .py-md-7,
    .p-md-7 {
        padding-top: 5rem;
    }
    .pt-md-8,
    .py-md-8,
    .p-md-8 {
        padding-top: 6rem;
    }
    .pt-md-9,
    .py-md-9,
    .p-md-9 {
        padding-top: 8rem;
    }
    .pt-md-10,
    .py-md-10,
    .p-md-10 {
        padding-top: 10rem;
    }
    .pt-md-11,
    .py-md-11,
    .p-md-11 {
        padding-top: 12rem;
    }
    .pt-md-12,
    .py-md-12,
    .p-md-12 {
        padding-top: 16rem;
    }

    .pb-md-6,
    .py-md-6,
    .p-md-6 {
        padding-bottom: 4rem;
    }
    .pb-md-7,
    .py-md-7,
    .p-md-7 {
        padding-bottom: 5rem;
    }
    .pb-md-8,
    .py-md-8,
    .p-md-8 {
        padding-bottom: 6rem;
    }
    .pb-md-9,
    .py-md-9,
    .p-md-9 {
        padding-bottom: 8rem;
    }
    .pb-md-10,
    .py-md-10,
    .p-md-10 {
        padding-bottom: 10rem;
    }
    .pb-md-11,
    .py-md-11,
    .p-md-11 {
        padding-bottom: 12rem;
    }
    .pb-md-12,
    .py-md-12,
    .p-md-12 {
        padding-bottom: 16rem;
    }

    .pl-md-5px,
    .px-md-5px,
    .p-md-5px {
        padding-left: 5px;
    }
    .pl-md-10px,
    .px-md-10px,
    .p-md-10px {
        padding-left: 10px;
    }
    .pl-md-15px,
    .px-md-15px,
    .p-md-15px {
        padding-left: 15px;
    }
    .pl-md-20px,
    .px-md-20px,
    .p-md-20px {
        padding-left: 20px;
    }
    .pl-md-25px,
    .px-md-25px,
    .p-md-25px {
        padding-left: 25px;
    }
    .pl-md-30px,
    .px-md-30px,
    .p-md-30px {
        padding-left: 30px;
    }

    .pr-md-5px,
    .px-md-5px,
    .p-md-5px {
        padding-right: 5px;
    }
    .pr-md-10px,
    .px-md-10px,
    .p-md-10px {
        padding-right: 10px;
    }
    .pr-md-15px,
    .px-md-15px,
    .p-md-15px {
        padding-right: 15px;
    }
    .pr-md-20px,
    .px-md-20px,
    .p-md-20px {
        padding-right: 20px;
    }
    .pr-md-25px,
    .px-md-25px,
    .p-md-25px {
        padding-right: 25px;
    }
    .pr-md-30px,
    .px-md-30px,
    .p-md-30px {
        padding-right: 30px;
    }

    .pt-md-5px,
    .py-md-5px,
    .p-md-5px {
        padding-top: 5px;
    }
    .pt-md-10px,
    .py-md-10px,
    .p-md-10px {
        padding-top: 10px;
    }
    .pt-md-15px,
    .py-md-15px,
    .p-md-15px {
        padding-top: 15px;
    }
    .pt-md-20px,
    .py-md-20px,
    .p-md-20px {
        padding-top: 20px;
    }
    .pt-md-25px,
    .py-md-25px,
    .p-md-25px {
        padding-top: 25px;
    }
    .pt-md-30px,
    .py-md-30px,
    .p-md-30px {
        padding-top: 30px;
    }

    .pb-md-5px,
    .py-md-5px,
    .p-md-5px {
        padding-bottom: 5px;
    }
    .pb-md-10px,
    .py-md-10px,
    .p-md-10px {
        padding-bottom: 10px;
    }
    .pb-md-15px,
    .py-md-15px,
    .p-md-15px {
        padding-bottom: 15px;
    }
    .pb-md-20px,
    .py-md-20px,
    .p-md-20px {
        padding-bottom: 20px;
    }
    .pb-md-25px,
    .py-md-25px,
    .p-md-25px {
        padding-bottom: 25px;
    }
    .pb-md-30px,
    .py-md-30px,
    .p-md-30px {
        padding-bottom: 30px;
    }

    .w-md-auto {
        width: auto;
    }
    .w-md-5px,
    .size-md-5px {
        width: 5px;
    }
    .w-md-10px,
    .size-md-10px {
        width: 10px;
    }
    .w-md-15px,
    .size-md-15px {
        width: 15px;
    }
    .w-md-20px,
    .size-md-20px {
        width: 20px;
    }
    .w-md-25px,
    .size-md-25px {
        width: 25px;
    }
    .w-md-30px,
    .size-md-30px {
        width: 30px;
    }
    .w-md-35px,
    .size-md-35px {
        width: 35px;
    }
    .w-md-40px,
    .size-md-40px {
        width: 40px;
    }
    .w-md-45px,
    .size-md-45px {
        width: 45px;
    }
    .w-md-50px,
    .size-md-50px {
        width: 50px;
    }
    .w-md-60px,
    .size-md-60px {
        width: 60px;
    }
    .w-md-70px,
    .size-md-70px {
        width: 70px;
    }
    .w-md-80px,
    .size-md-80px {
        width: 80px;
    }
    .w-md-90px,
    .size-md-90px {
        width: 90px;
    }
    .w-md-100px,
    .size-md-100px {
        width: 100px;
    }
    .w-md-110px,
    .size-md-110px {
        width: 110px;
    }
    .w-md-120px,
    .size-md-120px {
        width: 120px;
    }
    .w-md-130px,
    .size-md-130px {
        width: 130px;
    }
    .w-md-140px,
    .size-md-140px {
        width: 140px;
    }
    .w-md-150px,
    .size-md-150px {
        width: 150px;
    }
    .w-md-160px,
    .size-md-160px {
        width: 160px;
    }
    .w-md-170px,
    .size-md-170px {
        width: 170px;
    }
    .w-md-180px,
    .size-md-180px {
        width: 180px;
    }
    .w-md-190px,
    .size-md-190px {
        width: 190px;
    }
    .w-md-200px,
    .size-md-200px {
        width: 200px;
    }
    .w-md-210px,
    .size-md-210px {
        width: 210px;
    }
    .w-md-220px,
    .size-md-220px {
        width: 220px;
    }
    .w-md-230px,
    .size-md-230px {
        width: 230px;
    }
    .w-md-240px,
    .size-md-240px {
        width: 240px;
    }
    .w-md-250px,
    .size-md-250px {
        width: 250px;
    }
    .w-md-260px,
    .size-md-260px {
        width: 260px;
    }
    .w-md-270px,
    .size-md-270px {
        width: 270px;
    }
    .w-md-280px,
    .size-md-280px {
        width: 280px;
    }
    .w-md-290px,
    .size-md-290px {
        width: 290px;
    }
    .w-md-300px,
    .size-md-300px {
        width: 300px;
    }
    .w-md-310px,
    .size-md-310px {
        width: 310px;
    }
    .w-md-320px,
    .size-md-320px {
        width: 320px;
    }
    .w-md-330px,
    .size-md-330px {
        width: 330px;
    }
    .w-md-340px,
    .size-md-340px {
        width: 340px;
    }
    .w-md-350px,
    .size-md-350px {
        width: 350px;
    }
    .w-md-360px,
    .size-md-360px {
        width: 360px;
    }
    .w-md-370px,
    .size-md-370px {
        width: 370px;
    }
    .w-md-380px,
    .size-md-380px {
        width: 380px;
    }
    .w-md-390px,
    .size-md-390px {
        width: 390px;
    }
    .w-md-400px,
    .size-md-400px {
        width: 400px;
    }
    .w-md-410px,
    .size-md-410px {
        width: 410px;
    }
    .w-md-420px,
    .size-md-420px {
        width: 420px;
    }
    .w-md-450px,
    .size-md-450px {
        width: 450px;
    }
    .w-md-500px,
    .size-md-500px {
        width: 500px;
    }

    .h-md-auto {
        height: auto;
    }
    .h-md-5px,
    .size-md-5px {
        height: 5px;
    }
    .h-md-10px,
    .size-md-10px {
        height: 10px;
    }
    .h-md-15px,
    .size-md-15px {
        height: 15px;
    }
    .h-md-20px,
    .size-md-20px {
        height: 20px;
    }
    .h-md-25px,
    .size-md-25px {
        height: 25px;
    }
    .h-md-30px,
    .size-md-30px {
        height: 30px;
    }
    .h-md-35px,
    .size-md-35px {
        height: 35px;
    }
    .h-md-40px,
    .size-md-40px {
        height: 40px;
    }
    .h-md-45px,
    .size-md-45px {
        height: 45px;
    }
    .h-md-50px,
    .size-md-50px {
        height: 50px;
    }
    .h-md-60px,
    .size-md-60px {
        height: 60px;
    }
    .h-md-70px,
    .size-md-70px {
        height: 70px;
    }
    .h-md-80px,
    .size-md-80px {
        height: 80px;
    }
    .h-md-90px,
    .size-md-90px {
        height: 90px;
    }
    .h-md-100px,
    .size-md-100px {
        height: 100px;
    }
    .h-md-110px,
    .size-md-110px {
        height: 110px;
    }
    .h-md-120px,
    .size-md-120px {
        height: 120px;
    }
    .h-md-130px,
    .size-md-130px {
        height: 130px;
    }
    .h-md-140px,
    .size-md-140px {
        height: 140px;
    }
    .h-md-150px,
    .size-md-150px {
        height: 150px;
    }
    .h-md-160px,
    .size-md-160px {
        height: 160px;
    }
    .h-md-170px,
    .size-md-170px {
        height: 170px;
    }
    .h-md-180px,
    .size-md-180px {
        height: 180px;
    }
    .h-md-190px,
    .size-md-190px {
        height: 190px;
    }
    .h-md-200px,
    .size-md-200px {
        height: 200px;
    }
    .h-md-210px,
    .size-md-210px {
        height: 210px;
    }
    .h-md-220px,
    .size-md-220px {
        height: 220px;
    }
    .h-md-230px,
    .size-md-230px {
        height: 230px;
    }
    .h-md-240px,
    .size-md-240px {
        height: 240px;
    }
    .h-md-250px,
    .size-md-250px {
        height: 250px;
    }
    .h-md-260px,
    .size-md-260px {
        height: 260px;
    }
    .h-md-270px,
    .size-md-270px {
        height: 270px;
    }
    .h-md-280px,
    .size-md-280px {
        height: 280px;
    }
    .h-md-290px,
    .size-md-290px {
        height: 290px;
    }
    .h-md-300px,
    .size-md-300px {
        height: 300px;
    }
    .h-md-310px,
    .size-md-310px {
        height: 310px;
    }
    .h-md-320px,
    .size-md-320px {
        height: 320px;
    }
    .h-md-330px,
    .size-md-330px {
        height: 330px;
    }
    .h-md-340px,
    .size-md-340px {
        height: 340px;
    }
    .h-md-350px,
    .size-md-350px {
        height: 350px;
    }
    .h-md-360px,
    .size-md-360px {
        height: 360px;
    }
    .h-md-370px,
    .size-md-370px {
        height: 370px;
    }
    .h-md-380px,
    .size-md-380px {
        height: 380px;
    }
    .h-md-390px,
    .size-md-390px {
        height: 390px;
    }
    .h-md-400px,
    .size-md-400px {
        height: 400px;
    }
    .h-md-410px,
    .size-md-410px {
        height: 410px;
    }
    .h-md-420px,
    .size-md-420px {
        height: 420px;
    }
    .h-md-450px,
    .size-md-450px {
        height: 450px;
    }
    .h-md-500px,
    .size-md-500px {
        height: 500px;
    }

    .md-no-gutters {
        margin-right: -0px;
        margin-left: -0px;
    }
    .md-no-gutters > .col,
    .md-no-gutters > [class*="col-"] {
        padding-right: 0px;
        padding-left: 0px;
    }
    .md-gutters-5 {
        margin-right: -5px;
        margin-left: -5px;
    }
    .md-gutters-5 > .col,
    .md-gutters-5 > [class*="col-"] {
        padding-right: 5px;
        padding-left: 5px;
    }
    .md-gutters-10 {
        margin-right: -10px;
        margin-left: -10px;
    }
    .md-gutters-10 > .col,
    .md-gutters-10 > [class*="col-"] {
        padding-right: 10px;
        padding-left: 10px;
    }
    .md-gutters-15 {
        margin-right: -15px;
        margin-left: -15px;
    }
    .md-gutters-15 > .col,
    .md-gutters-15 > [class*="col-"] {
        padding-right: 15px;
        padding-left: 15px;
    }
    .md-gutters-20 {
        margin-right: -20px;
        margin-left: -20px;
    }
    .md-gutters-20 > .col,
    .md-gutters-20 > [class*="col-"] {
        padding-right: 20px;
        padding-left: 20px;
    }
    .md-gutters-25 {
        margin-right: -25px;
        margin-left: -25px;
    }
    .md-gutters-25 > .col,
    .md-gutters-25 > [class*="col-"] {
        padding-right: 25px;
        padding-left: 25px;
    }
    .md-gutters-30 {
        margin-right: -30px;
        margin-left: -30px;
    }
    .md-gutters-30 > .col,
    .md-gutters-30 > [class*="col-"] {
        padding-right: 30px;
        padding-left: 30px;
    }

    .flex-grow-md-0 {
        -ms-flex-positive: 0 !important;
        flex-grow: 0 !important;
    }
    .flex-grow-md-1 {
        -ms-flex-positive: 1 !important;
        flex-grow: 1 !important;
    }

    [dir="rtl"] .row-cols-md-1 > * {
        -ms-flex: 0 0 100%;
        flex: 0 0 100%;
        max-width: 100%;
    }
    [dir="rtl"] .row-cols-md-2 > * {
        -ms-flex: 0 0 50%;
        flex: 0 0 50%;
        max-width: 50%;
    }
    [dir="rtl"] .row-cols-md-3 > * {
        -ms-flex: 0 0 33.333333%;
        flex: 0 0 33.333333%;
        max-width: 33.333333%;
    }
    [dir="rtl"] .row-cols-md-4 > * {
        -ms-flex: 0 0 25%;
        flex: 0 0 25%;
        max-width: 25%;
    }
    [dir="rtl"] .row-cols-md-5 > * {
        -ms-flex: 0 0 20%;
        flex: 0 0 20%;
        max-width: 20%;
    }
    [dir="rtl"] .row-cols-md-6 > * {
        -ms-flex: 0 0 16.666667%;
        flex: 0 0 16.666667%;
        max-width: 16.666667%;
    }
}
/* lg */
@media (min-width: 992px) {
    .border-lg {
        border: 1px solid #e2e5ec !important;
    }
    .border-lg-top {
        border-top: 1px solid #e2e5ec !important;
    }
    .border-lg-right {
        border-right: 1px solid #e2e5ec !important;
    }
    .border-lg-bottom {
        border-bottom: 1px solid #e2e5ec !important;
    }
    .border-lg-left {
        border-left: 1px solid #e2e5ec !important;
    }
    .border-lg-0 {
        border: 0 !important;
    }
    .border-lg-top-0 {
        border-top: 0 !important;
    }
    .border-lg-right-0 {
        border-right: 0 !important;
    }
    .border-lg-bottom-0 {
        border-bottom: 0 !important;
    }
    .border-lg-left-0 {
        border-left: 0 !important;
    }

    .w-lg-25 {
        width: 25% !important;
    }
    .w-lg-50 {
        width: 50% !important;
    }
    .w-lg-75 {
        width: 75% !important;
    }
    .w-lg-100 {
        width: 100% !important;
    }
    .w-lg-auto {
        width: auto !important;
    }

    .pl-lg-6,
    .px-lg-6,
    .p-lg-6 {
        padding-left: 4rem;
    }
    .pl-lg-7,
    .px-lg-7,
    .p-lg-7 {
        padding-left: 5rem;
    }
    .pl-lg-8,
    .px-lg-8,
    .p-lg-8 {
        padding-left: 6rem;
    }
    .pl-lg-9,
    .px-lg-9,
    .p-lg-9 {
        padding-left: 8rem;
    }
    .pl-lg-10,
    .px-lg-10,
    .p-lg-10 {
        padding-left: 10rem;
    }
    .pl-lg-11,
    .px-lg-11,
    .p-lg-11 {
        padding-left: 12rem;
    }
    .pl-lg-12,
    .px-lg-12,
    .p-lg-12 {
        padding-left: 16rem;
    }

    .pr-lg-6,
    .px-lg-6,
    .p-lg-6 {
        padding-right: 4rem;
    }
    .pr-lg-7,
    .px-lg-7,
    .p-lg-7 {
        padding-right: 5rem;
    }
    .pr-lg-8,
    .px-lg-8,
    .p-lg-8 {
        padding-right: 6rem;
    }
    .pr-lg-9,
    .px-lg-9,
    .p-lg-9 {
        padding-right: 8rem;
    }
    .pr-lg-10,
    .px-lg-10,
    .p-lg-10 {
        padding-right: 10rem;
    }
    .pr-lg-11,
    .px-lg-11,
    .p-lg-11 {
        padding-right: 12rem;
    }
    .pr-lg-12,
    .px-lg-12,
    .p-lg-12 {
        padding-right: 16rem;
    }

    .pt-lg-6,
    .py-lg-6,
    .p-lg-6 {
        padding-top: 4rem;
    }
    .pt-lg-7,
    .py-lg-7,
    .p-lg-7 {
        padding-top: 5rem;
    }
    .pt-lg-8,
    .py-lg-8,
    .p-lg-8 {
        padding-top: 6rem;
    }
    .pt-lg-9,
    .py-lg-9,
    .p-lg-9 {
        padding-top: 8rem;
    }
    .pt-lg-10,
    .py-lg-10,
    .p-lg-10 {
        padding-top: 10rem;
    }
    .pt-lg-11,
    .py-lg-11,
    .p-lg-11 {
        padding-top: 12rem;
    }
    .pt-lg-12,
    .py-lg-12,
    .p-lg-12 {
        padding-top: 16rem;
    }

    .pb-lg-6,
    .py-lg-6,
    .p-lg-6 {
        padding-bottom: 4rem;
    }
    .pb-lg-7,
    .py-lg-7,
    .p-lg-7 {
        padding-bottom: 5rem;
    }
    .pb-lg-8,
    .py-lg-8,
    .p-lg-8 {
        padding-bottom: 6rem;
    }
    .pb-lg-9,
    .py-lg-9,
    .p-lg-9 {
        padding-bottom: 8rem;
    }
    .pb-lg-10,
    .py-lg-10,
    .p-lg-10 {
        padding-bottom: 10rem;
    }
    .pb-lg-11,
    .py-lg-11,
    .p-lg-11 {
        padding-bottom: 12rem;
    }
    .pb-lg-12,
    .py-lg-12,
    .p-lg-12 {
        padding-bottom: 16rem;
    }

    .pl-lg-5px,
    .px-lg-5px,
    .p-lg-5px {
        padding-left: 5px;
    }
    .pl-lg-10px,
    .px-lg-10px,
    .p-lg-10px {
        padding-left: 10px;
    }
    .pl-lg-15px,
    .px-lg-15px,
    .p-lg-15px {
        padding-left: 15px;
    }
    .pl-lg-20px,
    .px-lg-20px,
    .p-lg-20px {
        padding-left: 20px;
    }
    .pl-lg-25px,
    .px-lg-25px,
    .p-lg-25px {
        padding-left: 25px;
    }
    .pl-lg-30px,
    .px-lg-30px,
    .p-lg-30px {
        padding-left: 30px;
    }

    .pr-lg-5px,
    .px-lg-5px,
    .p-lg-5px {
        padding-right: 5px;
    }
    .pr-lg-10px,
    .px-lg-10px,
    .p-lg-10px {
        padding-right: 10px;
    }
    .pr-lg-15px,
    .px-lg-15px,
    .p-lg-15px {
        padding-right: 15px;
    }
    .pr-lg-20px,
    .px-lg-20px,
    .p-lg-20px {
        padding-right: 20px;
    }
    .pr-lg-25px,
    .px-lg-25px,
    .p-lg-25px {
        padding-right: 25px;
    }
    .pr-lg-30px,
    .px-lg-30px,
    .p-lg-30px {
        padding-right: 30px;
    }

    .pt-lg-5px,
    .py-lg-5px,
    .p-lg-5px {
        padding-top: 5px;
    }
    .pt-lg-10px,
    .py-lg-10px,
    .p-lg-10px {
        padding-top: 10px;
    }
    .pt-lg-15px,
    .py-lg-15px,
    .p-lg-15px {
        padding-top: 15px;
    }
    .pt-lg-20px,
    .py-lg-20px,
    .p-lg-20px {
        padding-top: 20px;
    }
    .pt-lg-25px,
    .py-lg-25px,
    .p-lg-25px {
        padding-top: 25px;
    }
    .pt-lg-30px,
    .py-lg-30px,
    .p-lg-30px {
        padding-top: 30px;
    }

    .pb-lg-5px,
    .py-lg-5px,
    .p-lg-5px {
        padding-bottom: 5px;
    }
    .pb-lg-10px,
    .py-lg-10px,
    .p-lg-10px {
        padding-bottom: 10px;
    }
    .pb-lg-15px,
    .py-lg-15px,
    .p-lg-15px {
        padding-bottom: 15px;
    }
    .pb-lg-20px,
    .py-lg-20px,
    .p-lg-20px {
        padding-bottom: 20px;
    }
    .pb-lg-25px,
    .py-lg-25px,
    .p-lg-25px {
        padding-bottom: 25px;
    }
    .pb-lg-30px,
    .py-lg-30px,
    .p-lg-30px {
        padding-bottom: 30px;
    }

    .w-lg-auto {
        width: auto;
    }
    .w-lg-5px,
    .size-lg-5px {
        width: 5px;
    }
    .w-lg-10px,
    .size-lg-10px {
        width: 10px;
    }
    .w-lg-15px,
    .size-lg-15px {
        width: 15px;
    }
    .w-lg-20px,
    .size-lg-20px {
        width: 20px;
    }
    .w-lg-25px,
    .size-lg-25px {
        width: 25px;
    }
    .w-lg-30px,
    .size-lg-30px {
        width: 30px;
    }
    .w-lg-35px,
    .size-lg-35px {
        width: 35px;
    }
    .w-lg-40px,
    .size-lg-40px {
        width: 40px;
    }
    .w-lg-45px,
    .size-lg-45px {
        width: 45px;
    }
    .w-lg-50px,
    .size-lg-50px {
        width: 50px;
    }
    .w-lg-60px,
    .size-lg-60px {
        width: 60px;
    }
    .w-lg-70px,
    .size-lg-70px {
        width: 70px;
    }
    .w-lg-80px,
    .size-lg-80px {
        width: 80px;
    }
    .w-lg-90px,
    .size-lg-90px {
        width: 90px;
    }
    .w-lg-100px,
    .size-lg-100px {
        width: 100px;
    }
    .w-lg-110px,
    .size-lg-110px {
        width: 110px;
    }
    .w-lg-120px,
    .size-lg-120px {
        width: 120px;
    }
    .w-lg-130px,
    .size-lg-130px {
        width: 130px;
    }
    .w-lg-140px,
    .size-lg-140px {
        width: 140px;
    }
    .w-lg-150px,
    .size-lg-150px {
        width: 150px;
    }
    .w-lg-160px,
    .size-lg-160px {
        width: 160px;
    }
    .w-lg-170px,
    .size-lg-170px {
        width: 170px;
    }
    .w-lg-180px,
    .size-lg-180px {
        width: 180px;
    }
    .w-lg-190px,
    .size-lg-190px {
        width: 190px;
    }
    .w-lg-200px,
    .size-lg-200px {
        width: 200px;
    }
    .w-lg-210px,
    .size-lg-210px {
        width: 210px;
    }
    .w-lg-220px,
    .size-lg-220px {
        width: 220px;
    }
    .w-lg-230px,
    .size-lg-230px {
        width: 230px;
    }
    .w-lg-240px,
    .size-lg-240px {
        width: 240px;
    }
    .w-lg-250px,
    .size-lg-250px {
        width: 250px;
    }
    .w-lg-260px,
    .size-lg-260px {
        width: 260px;
    }
    .w-lg-270px,
    .size-lg-270px {
        width: 270px;
    }
    .w-lg-280px,
    .size-lg-280px {
        width: 280px;
    }
    .w-lg-290px,
    .size-lg-290px {
        width: 290px;
    }
    .w-lg-300px,
    .size-lg-300px {
        width: 300px;
    }
    .w-lg-310px,
    .size-lg-310px {
        width: 310px;
    }
    .w-lg-320px,
    .size-lg-320px {
        width: 320px;
    }
    .w-lg-330px,
    .size-lg-330px {
        width: 330px;
    }
    .w-lg-340px,
    .size-lg-340px {
        width: 340px;
    }
    .w-lg-350px,
    .size-lg-350px {
        width: 350px;
    }
    .w-lg-360px,
    .size-lg-360px {
        width: 360px;
    }
    .w-lg-370px,
    .size-lg-370px {
        width: 370px;
    }
    .w-lg-380px,
    .size-lg-380px {
        width: 380px;
    }
    .w-lg-390px,
    .size-lg-390px {
        width: 390px;
    }
    .w-lg-400px,
    .size-lg-400px {
        width: 400px;
    }
    .w-lg-410px,
    .size-lg-410px {
        width: 410px;
    }
    .w-lg-420px,
    .size-lg-420px {
        width: 420px;
    }
    .w-lg-450px,
    .size-lg-450px {
        width: 450px;
    }
    .w-lg-500px,
    .size-lg-500px {
        width: 500px;
    }

    .h-lg-auto {
        height: auto;
    }
    .h-lg-5px,
    .size-lg-5px {
        height: 5px;
    }
    .h-lg-10px,
    .size-lg-10px {
        height: 10px;
    }
    .h-lg-15px,
    .size-lg-15px {
        height: 15px;
    }
    .h-lg-20px,
    .size-lg-20px {
        height: 20px;
    }
    .h-lg-25px,
    .size-lg-25px {
        height: 25px;
    }
    .h-lg-30px,
    .size-lg-30px {
        height: 30px;
    }
    .h-lg-35px,
    .size-lg-35px {
        height: 35px;
    }
    .h-lg-40px,
    .size-lg-40px {
        height: 40px;
    }
    .h-lg-45px,
    .size-lg-45px {
        height: 45px;
    }
    .h-lg-50px,
    .size-lg-50px {
        height: 50px;
    }
    .h-lg-60px,
    .size-lg-60px {
        height: 60px;
    }
    .h-lg-70px,
    .size-lg-70px {
        height: 70px;
    }
    .h-lg-80px,
    .size-lg-80px {
        height: 80px;
    }
    .h-lg-90px,
    .size-lg-90px {
        height: 90px;
    }
    .h-lg-100px,
    .size-lg-100px {
        height: 100px;
    }
    .h-lg-110px,
    .size-lg-110px {
        height: 110px;
    }
    .h-lg-120px,
    .size-lg-120px {
        height: 120px;
    }
    .h-lg-130px,
    .size-lg-130px {
        height: 130px;
    }
    .h-lg-140px,
    .size-lg-140px {
        height: 140px;
    }
    .h-lg-150px,
    .size-lg-150px {
        height: 150px;
    }
    .h-lg-160px,
    .size-lg-160px {
        height: 160px;
    }
    .h-lg-170px,
    .size-lg-170px {
        height: 170px;
    }
    .h-lg-180px,
    .size-lg-180px {
        height: 180px;
    }
    .h-lg-190px,
    .size-lg-190px {
        height: 190px;
    }
    .h-lg-200px,
    .size-lg-200px {
        height: 200px;
    }
    .h-lg-210px,
    .size-lg-210px {
        height: 210px;
    }
    .h-lg-220px,
    .size-lg-220px {
        height: 220px;
    }
    .h-lg-230px,
    .size-lg-230px {
        height: 230px;
    }
    .h-lg-240px,
    .size-lg-240px {
        height: 240px;
    }
    .h-lg-250px,
    .size-lg-250px {
        height: 250px;
    }
    .h-lg-260px,
    .size-lg-260px {
        height: 260px;
    }
    .h-lg-270px,
    .size-lg-270px {
        height: 270px;
    }
    .h-lg-280px,
    .size-lg-280px {
        height: 280px;
    }
    .h-lg-290px,
    .size-lg-290px {
        height: 290px;
    }
    .h-lg-300px,
    .size-lg-300px {
        height: 300px;
    }
    .h-lg-310px,
    .size-lg-310px {
        height: 310px;
    }
    .h-lg-320px,
    .size-lg-320px {
        height: 320px;
    }
    .h-lg-330px,
    .size-lg-330px {
        height: 330px;
    }
    .h-lg-340px,
    .size-lg-340px {
        height: 340px;
    }
    .h-lg-350px,
    .size-lg-350px {
        height: 350px;
    }
    .h-lg-360px,
    .size-lg-360px {
        height: 360px;
    }
    .h-lg-370px,
    .size-lg-370px {
        height: 370px;
    }
    .h-lg-380px,
    .size-lg-380px {
        height: 380px;
    }
    .h-lg-390px,
    .size-lg-390px {
        height: 390px;
    }
    .h-lg-400px,
    .size-lg-400px {
        height: 400px;
    }
    .h-lg-410px,
    .size-lg-410px {
        height: 410px;
    }
    .h-lg-420px,
    .size-lg-420px {
        height: 420px;
    }
    .h-lg-450px,
    .size-lg-450px {
        height: 450px;
    }
    .h-lg-500px,
    .size-lg-500px {
        height: 500px;
    }

    .lg-no-gutters {
        margin-right: -0px;
        margin-left: -0px;
    }
    .lg-no-gutters > .col,
    .lg-no-gutters > [class*="col-"] {
        padding-right: 0px;
        padding-left: 0px;
    }
    .lg-gutters-5 {
        margin-right: -5px;
        margin-left: -5px;
    }
    .lg-gutters-5 > .col,
    .lg-gutters-5 > [class*="col-"] {
        padding-right: 5px;
        padding-left: 5px;
    }
    .lg-gutters-10 {
        margin-right: -10px;
        margin-left: -10px;
    }
    .lg-gutters-10 > .col,
    .lg-gutters-10 > [class*="col-"] {
        padding-right: 10px;
        padding-left: 10px;
    }
    .lg-gutters-15 {
        margin-right: -15px;
        margin-left: -15px;
    }
    .lg-gutters-15 > .col,
    .lg-gutters-15 > [class*="col-"] {
        padding-right: 15px;
        padding-left: 15px;
    }
    .lg-gutters-20 {
        margin-right: -20px;
        margin-left: -20px;
    }
    .lg-gutters-20 > .col,
    .lg-gutters-20 > [class*="col-"] {
        padding-right: 20px;
        padding-left: 20px;
    }
    .lg-gutters-25 {
        margin-right: -25px;
        margin-left: -25px;
    }
    .lg-gutters-25 > .col,
    .lg-gutters-25 > [class*="col-"] {
        padding-right: 25px;
        padding-left: 25px;
    }
    .lg-gutters-30 {
        margin-right: -30px;
        margin-left: -30px;
    }
    .lg-gutters-30 > .col,
    .lg-gutters-30 > [class*="col-"] {
        padding-right: 30px;
        padding-left: 30px;
    }

    .flex-grow-lg-0 {
        -ms-flex-positive: 0 !important;
        flex-grow: 0 !important;
    }
    .flex-grow-lg-1 {
        -ms-flex-positive: 1 !important;
        flex-grow: 1 !important;
    }
    [dir="rtl"] .row-cols-lg-1 > * {
        -ms-flex: 0 0 100%;
        flex: 0 0 100%;
        max-width: 100%;
    }
    [dir="rtl"] .row-cols-lg-2 > * {
        -ms-flex: 0 0 50%;
        flex: 0 0 50%;
        max-width: 50%;
    }
    [dir="rtl"] .row-cols-lg-3 > * {
        -ms-flex: 0 0 33.333333%;
        flex: 0 0 33.333333%;
        max-width: 33.333333%;
    }
    [dir="rtl"] .row-cols-lg-4 > * {
        -ms-flex: 0 0 25%;
        flex: 0 0 25%;
        max-width: 25%;
    }
    [dir="rtl"] .row-cols-lg-5 > * {
        -ms-flex: 0 0 20%;
        flex: 0 0 20%;
        max-width: 20%;
    }
    [dir="rtl"] .row-cols-lg-6 > * {
        -ms-flex: 0 0 16.666667%;
        flex: 0 0 16.666667%;
        max-width: 16.666667%;
    }
}
/* xl */
@media (min-width: 1200px) {
    .border-xl {
        border: 1px solid #e2e5ec !important;
    }
    .border-xl-top {
        border-top: 1px solid #e2e5ec !important;
    }
    .border-xl-right {
        border-right: 1px solid #e2e5ec !important;
    }
    .border-xl-bottom {
        border-bottom: 1px solid #e2e5ec !important;
    }
    .border-xl-left {
        border-left: 1px solid #e2e5ec !important;
    }
    .border-xl-0 {
        border: 0 !important;
    }
    .border-xl-top-0 {
        border-top: 0 !important;
    }
    .border-xl-right-0 {
        border-right: 0 !important;
    }
    .border-xl-bottom-0 {
        border-bottom: 0 !important;
    }
    .border-xl-left-0 {
        border-left: 0 !important;
    }

    .w-xl-25 {
        width: 25% !important;
    }
    .w-xl-50 {
        width: 50% !important;
    }
    .w-xl-75 {
        width: 75% !important;
    }
    .w-xl-100 {
        width: 100% !important;
    }
    .w-xl-auto {
        width: auto !important;
    }

    .pl-xl-6,
    .px-xl-6,
    .p-xl-6 {
        padding-left: 4rem;
    }
    .pl-xl-7,
    .px-xl-7,
    .p-xl-7 {
        padding-left: 5rem;
    }
    .pl-xl-8,
    .px-xl-8,
    .p-xl-8 {
        padding-left: 6rem;
    }
    .pl-xl-9,
    .px-xl-9,
    .p-xl-9 {
        padding-left: 8rem;
    }
    .pl-xl-10,
    .px-xl-10,
    .p-xl-10 {
        padding-left: 10rem;
    }
    .pl-xl-11,
    .px-xl-11,
    .p-xl-11 {
        padding-left: 12rem;
    }
    .pl-xl-12,
    .px-xl-12,
    .p-xl-12 {
        padding-left: 16rem;
    }

    .pr-xl-6,
    .px-xl-6,
    .p-xl-6 {
        padding-right: 4rem;
    }
    .pr-xl-7,
    .px-xl-7,
    .p-xl-7 {
        padding-right: 5rem;
    }
    .pr-xl-8,
    .px-xl-8,
    .p-xl-8 {
        padding-right: 6rem;
    }
    .pr-xl-9,
    .px-xl-9,
    .p-xl-9 {
        padding-right: 8rem;
    }
    .pr-xl-10,
    .px-xl-10,
    .p-xl-10 {
        padding-right: 10rem;
    }
    .pr-xl-11,
    .px-xl-11,
    .p-xl-11 {
        padding-right: 12rem;
    }
    .pr-xl-12,
    .px-xl-12,
    .p-xl-12 {
        padding-right: 16rem;
    }

    .pt-xl-6,
    .py-xl-6,
    .p-xl-6 {
        padding-top: 4rem;
    }
    .pt-xl-7,
    .py-xl-7,
    .p-xl-7 {
        padding-top: 5rem;
    }
    .pt-xl-8,
    .py-xl-8,
    .p-xl-8 {
        padding-top: 6rem;
    }
    .pt-xl-9,
    .py-xl-9,
    .p-xl-9 {
        padding-top: 8rem;
    }
    .pt-xl-10,
    .py-xl-10,
    .p-xl-10 {
        padding-top: 10rem;
    }
    .pt-xl-11,
    .py-xl-11,
    .p-xl-11 {
        padding-top: 12rem;
    }
    .pt-xl-12,
    .py-xl-12,
    .p-xl-12 {
        padding-top: 16rem;
    }

    .pb-xl-6,
    .py-xl-6,
    .p-xl-6 {
        padding-bottom: 4rem;
    }
    .pb-xl-7,
    .py-xl-7,
    .p-xl-7 {
        padding-bottom: 5rem;
    }
    .pb-xl-8,
    .py-xl-8,
    .p-xl-8 {
        padding-bottom: 6rem;
    }
    .pb-xl-9,
    .py-xl-9,
    .p-xl-9 {
        padding-bottom: 8rem;
    }
    .pb-xl-10,
    .py-xl-10,
    .p-xl-10 {
        padding-bottom: 10rem;
    }
    .pb-xl-11,
    .py-xl-11,
    .p-xl-11 {
        padding-bottom: 12rem;
    }
    .pb-xl-12,
    .py-xl-12,
    .p-xl-12 {
        padding-bottom: 16rem;
    }

    .pl-xl-5px,
    .px-xl-5px,
    .p-xl-5px {
        padding-left: 5px;
    }
    .pl-xl-10px,
    .px-xl-10px,
    .p-xl-10px {
        padding-left: 10px;
    }
    .pl-xl-15px,
    .px-xl-15px,
    .p-xl-15px {
        padding-left: 15px;
    }
    .pl-xl-20px,
    .px-xl-20px,
    .p-xl-20px {
        padding-left: 20px;
    }
    .pl-xl-25px,
    .px-xl-25px,
    .p-xl-25px {
        padding-left: 25px;
    }
    .pl-xl-30px,
    .px-xl-30px,
    .p-xl-30px {
        padding-left: 30px;
    }

    .pr-xl-5px,
    .px-xl-5px,
    .p-xl-5px {
        padding-right: 5px;
    }
    .pr-xl-10px,
    .px-xl-10px,
    .p-xl-10px {
        padding-right: 10px;
    }
    .pr-xl-15px,
    .px-xl-15px,
    .p-xl-15px {
        padding-right: 15px;
    }
    .pr-xl-20px,
    .px-xl-20px,
    .p-xl-20px {
        padding-right: 20px;
    }
    .pr-xl-25px,
    .px-xl-25px,
    .p-xl-25px {
        padding-right: 25px;
    }
    .pr-xl-30px,
    .px-xl-30px,
    .p-xl-30px {
        padding-right: 30px;
    }

    .pt-xl-5px,
    .py-xl-5px,
    .p-xl-5px {
        padding-top: 5px;
    }
    .pt-xl-10px,
    .py-xl-10px,
    .p-xl-10px {
        padding-top: 10px;
    }
    .pt-xl-15px,
    .py-xl-15px,
    .p-xl-15px {
        padding-top: 15px;
    }
    .pt-xl-20px,
    .py-xl-20px,
    .p-xl-20px {
        padding-top: 20px;
    }
    .pt-xl-25px,
    .py-xl-25px,
    .p-xl-25px {
        padding-top: 25px;
    }
    .pt-xl-30px,
    .py-xl-30px,
    .p-xl-30px {
        padding-top: 30px;
    }

    .pb-xl-5px,
    .py-xl-5px,
    .p-xl-5px {
        padding-bottom: 5px;
    }
    .pb-xl-10px,
    .py-xl-10px,
    .p-xl-10px {
        padding-bottom: 10px;
    }
    .pb-xl-15px,
    .py-xl-15px,
    .p-xl-15px {
        padding-bottom: 15px;
    }
    .pb-xl-20px,
    .py-xl-20px,
    .p-xl-20px {
        padding-bottom: 20px;
    }
    .pb-xl-25px,
    .py-xl-25px,
    .p-xl-25px {
        padding-bottom: 25px;
    }
    .pb-xl-30px,
    .py-xl-30px,
    .p-xl-30px {
        padding-bottom: 30px;
    }

    .w-xl-auto {
        width: auto;
    }
    .w-xl-5px,
    .size-xl-5px {
        width: 5px;
    }
    .w-xl-10px,
    .size-xl-10px {
        width: 10px;
    }
    .w-xl-15px,
    .size-xl-15px {
        width: 15px;
    }
    .w-xl-20px,
    .size-xl-20px {
        width: 20px;
    }
    .w-xl-25px,
    .size-xl-25px {
        width: 25px;
    }
    .w-xl-30px,
    .size-xl-30px {
        width: 30px;
    }
    .w-xl-35px,
    .size-xl-35px {
        width: 35px;
    }
    .w-xl-40px,
    .size-xl-40px {
        width: 40px;
    }
    .w-xl-45px,
    .size-xl-45px {
        width: 45px;
    }
    .w-xl-50px,
    .size-xl-50px {
        width: 50px;
    }
    .w-xl-60px,
    .size-xl-60px {
        width: 60px;
    }
    .w-xl-70px,
    .size-xl-70px {
        width: 70px;
    }
    .w-xl-80px,
    .size-xl-80px {
        width: 80px;
    }
    .w-xl-90px,
    .size-xl-90px {
        width: 90px;
    }
    .w-xl-100px,
    .size-xl-100px {
        width: 100px;
    }
    .w-xl-110px,
    .size-xl-110px {
        width: 110px;
    }
    .w-xl-120px,
    .size-xl-120px {
        width: 120px;
    }
    .w-xl-130px,
    .size-xl-130px {
        width: 130px;
    }
    .w-xl-140px,
    .size-xl-140px {
        width: 140px;
    }
    .w-xl-150px,
    .size-xl-150px {
        width: 150px;
    }
    .w-xl-160px,
    .size-xl-160px {
        width: 160px;
    }
    .w-xl-170px,
    .size-xl-170px {
        width: 170px;
    }
    .w-xl-180px,
    .size-xl-180px {
        width: 180px;
    }
    .w-xl-190px,
    .size-xl-190px {
        width: 190px;
    }
    .w-xl-200px,
    .size-xl-200px {
        width: 200px;
    }
    .w-xl-210px,
    .size-xl-210px {
        width: 210px;
    }
    .w-xl-220px,
    .size-xl-220px {
        width: 220px;
    }
    .w-xl-230px,
    .size-xl-230px {
        width: 230px;
    }
    .w-xl-240px,
    .size-xl-240px {
        width: 240px;
    }
    .w-xl-250px,
    .size-xl-250px {
        width: 250px;
    }
    .w-xl-260px,
    .size-xl-260px {
        width: 260px;
    }
    .w-xl-270px,
    .size-xl-270px {
        width: 270px;
    }
    .w-xl-280px,
    .size-xl-280px {
        width: 280px;
    }
    .w-xl-290px,
    .size-xl-290px {
        width: 290px;
    }
    .w-xl-300px,
    .size-xl-300px {
        width: 300px;
    }
    .w-xl-310px,
    .size-xl-310px {
        width: 310px;
    }
    .w-xl-320px,
    .size-xl-320px {
        width: 320px;
    }
    .w-xl-330px,
    .size-xl-330px {
        width: 330px;
    }
    .w-xl-340px,
    .size-xl-340px {
        width: 340px;
    }
    .w-xl-350px,
    .size-xl-350px {
        width: 350px;
    }
    .w-xl-360px,
    .size-xl-360px {
        width: 360px;
    }
    .w-xl-370px,
    .size-xl-370px {
        width: 370px;
    }
    .w-xl-380px,
    .size-xl-380px {
        width: 380px;
    }
    .w-xl-390px,
    .size-xl-390px {
        width: 390px;
    }
    .w-xl-400px,
    .size-xl-400px {
        width: 400px;
    }
    .w-xl-410px,
    .size-xl-410px {
        width: 410px;
    }
    .w-xl-420px,
    .size-xl-420px {
        width: 420px;
    }
    .w-xl-450px,
    .size-xl-450px {
        width: 450px;
    }
    .w-xl-500px,
    .size-xl-500px {
        width: 500px;
    }

    .h-xl-auto {
        height: auto;
    }
    .h-xl-5px,
    .size-xl-5px {
        height: 5px;
    }
    .h-xl-10px,
    .size-xl-10px {
        height: 10px;
    }
    .h-xl-15px,
    .size-xl-15px {
        height: 15px;
    }
    .h-xl-20px,
    .size-xl-20px {
        height: 20px;
    }
    .h-xl-25px,
    .size-xl-25px {
        height: 25px;
    }
    .h-xl-30px,
    .size-xl-30px {
        height: 30px;
    }
    .h-xl-35px,
    .size-xl-35px {
        height: 35px;
    }
    .h-xl-40px,
    .size-xl-40px {
        height: 40px;
    }
    .h-xl-45px,
    .size-xl-45px {
        height: 45px;
    }
    .h-xl-50px,
    .size-xl-50px {
        height: 50px;
    }
    .h-xl-60px,
    .size-xl-60px {
        height: 60px;
    }
    .h-xl-70px,
    .size-xl-70px {
        height: 70px;
    }
    .h-xl-80px,
    .size-xl-80px {
        height: 80px;
    }
    .h-xl-90px,
    .size-xl-90px {
        height: 90px;
    }
    .h-xl-100px,
    .size-xl-100px {
        height: 100px;
    }
    .h-xl-110px,
    .size-xl-110px {
        height: 110px;
    }
    .h-xl-120px,
    .size-xl-120px {
        height: 120px;
    }
    .h-xl-130px,
    .size-xl-130px {
        height: 130px;
    }
    .h-xl-140px,
    .size-xl-140px {
        height: 140px;
    }
    .h-xl-150px,
    .size-xl-150px {
        height: 150px;
    }
    .h-xl-160px,
    .size-xl-160px {
        height: 160px;
    }
    .h-xl-170px,
    .size-xl-170px {
        height: 170px;
    }
    .h-xl-180px,
    .size-xl-180px {
        height: 180px;
    }
    .h-xl-190px,
    .size-xl-190px {
        height: 190px;
    }
    .h-xl-200px,
    .size-xl-200px {
        height: 200px;
    }
    .h-xl-210px,
    .size-xl-210px {
        height: 210px;
    }
    .h-xl-220px,
    .size-xl-220px {
        height: 220px;
    }
    .h-xl-230px,
    .size-xl-230px {
        height: 230px;
    }
    .h-xl-240px,
    .size-xl-240px {
        height: 240px;
    }
    .h-xl-250px,
    .size-xl-250px {
        height: 250px;
    }
    .h-xl-260px,
    .size-xl-260px {
        height: 260px;
    }
    .h-xl-270px,
    .size-xl-270px {
        height: 270px;
    }
    .h-xl-280px,
    .size-xl-280px {
        height: 280px;
    }
    .h-xl-290px,
    .size-xl-290px {
        height: 290px;
    }
    .h-xl-300px,
    .size-xl-300px {
        height: 300px;
    }
    .h-xl-310px,
    .size-xl-310px {
        height: 310px;
    }
    .h-xl-320px,
    .size-xl-320px {
        height: 320px;
    }
    .h-xl-330px,
    .size-xl-330px {
        height: 330px;
    }
    .h-xl-340px,
    .size-xl-340px {
        height: 340px;
    }
    .h-xl-350px,
    .size-xl-350px {
        height: 350px;
    }
    .h-xl-360px,
    .size-xl-360px {
        height: 360px;
    }
    .h-xl-370px,
    .size-xl-370px {
        height: 370px;
    }
    .h-xl-380px,
    .size-xl-380px {
        height: 380px;
    }
    .h-xl-390px,
    .size-xl-390px {
        height: 390px;
    }
    .h-xl-400px,
    .size-xl-400px {
        height: 400px;
    }
    .h-xl-410px,
    .size-xl-410px {
        height: 410px;
    }
    .h-xl-420px,
    .size-xl-420px {
        height: 420px;
    }
    .h-xl-450px,
    .size-xl-450px {
        height: 450px;
    }
    .h-xl-500px,
    .size-xl-500px {
        height: 500px;
    }

    .xl-no-gutters {
        margin-right: -0px;
        margin-left: -0px;
    }
    .xl-no-gutters > .col,
    .xl-no-gutters > [class*="col-"] {
        padding-right: 0px;
        padding-left: 0px;
    }
    .xl-gutters-5 {
        margin-right: -5px;
        margin-left: -5px;
    }
    .xl-gutters-5 > .col,
    .xl-gutters-5 > [class*="col-"] {
        padding-right: 5px;
        padding-left: 5px;
    }
    .xl-gutters-10 {
        margin-right: -10px;
        margin-left: -10px;
    }
    .xl-gutters-10 > .col,
    .xl-gutters-10 > [class*="col-"] {
        padding-right: 10px;
        padding-left: 10px;
    }
    .xl-gutters-15 {
        margin-right: -15px;
        margin-left: -15px;
    }
    .xl-gutters-15 > .col,
    .xl-gutters-15 > [class*="col-"] {
        padding-right: 15px;
        padding-left: 15px;
    }
    .xl-gutters-20 {
        margin-right: -20px;
        margin-left: -20px;
    }
    .xl-gutters-20 > .col,
    .xl-gutters-20 > [class*="col-"] {
        padding-right: 20px;
        padding-left: 20px;
    }
    .xl-gutters-25 {
        margin-right: -25px;
        margin-left: -25px;
    }
    .xl-gutters-25 > .col,
    .xl-gutters-25 > [class*="col-"] {
        padding-right: 25px;
        padding-left: 25px;
    }
    .xl-gutters-30 {
        margin-right: -30px;
        margin-left: -30px;
    }
    .xl-gutters-30 > .col,
    .xl-gutters-30 > [class*="col-"] {
        padding-right: 30px;
        padding-left: 30px;
    }

    .flex-grow-xl-0 {
        -ms-flex-positive: 0 !important;
        flex-grow: 0 !important;
    }
    .flex-grow-xl-1 {
        -ms-flex-positive: 1 !important;
        flex-grow: 1 !important;
    }

    [dir="rtl"] .row-cols-xl-1 > * {
        -ms-flex: 0 0 100%;
        flex: 0 0 100%;
        max-width: 100%;
    }
    [dir="rtl"] .row-cols-xl-2 > * {
        -ms-flex: 0 0 50%;
        flex: 0 0 50%;
        max-width: 50%;
    }
    [dir="rtl"] .row-cols-xl-3 > * {
        -ms-flex: 0 0 33.333333%;
        flex: 0 0 33.333333%;
        max-width: 33.333333%;
    }
    [dir="rtl"] .row-cols-xl-4 > * {
        -ms-flex: 0 0 25%;
        flex: 0 0 25%;
        max-width: 25%;
    }
    [dir="rtl"] .row-cols-xl-5 > * {
        -ms-flex: 0 0 20%;
        flex: 0 0 20%;
        max-width: 20%;
    }
    [dir="rtl"] .row-cols-xl-6 > * {
        -ms-flex: 0 0 16.666667%;
        flex: 0 0 16.666667%;
        max-width: 16.666667%;
    }
}

/* xxl */
@media (min-width: 1500px) {
    .border-xxl {
        border: 1px solid #e2e5ec !important;
    }
    .border-xxl-top {
        border-top: 1px solid #e2e5ec !important;
    }
    .border-xxl-right {
        border-right: 1px solid #e2e5ec !important;
    }
    .border-xxl-bottom {
        border-bottom: 1px solid #e2e5ec !important;
    }
    .border-xxl-left {
        border-left: 1px solid #e2e5ec !important;
    }
    .border-xxl-0 {
        border: 0 !important;
    }
    .border-xxl-top-0 {
        border-top: 0 !important;
    }
    .border-xxl-right-0 {
        border-right: 0 !important;
    }
    .border-xxl-bottom-0 {
        border-bottom: 0 !important;
    }
    .border-xxl-left-0 {
        border-left: 0 !important;
    }

    .w-xxl-25 {
        width: 25% !important;
    }
    .w-xxl-50 {
        width: 50% !important;
    }
    .w-xxl-75 {
        width: 75% !important;
    }
    .w-xxl-100 {
        width: 100% !important;
    }
    .w-xxl-auto {
        width: auto !important;
    }

    .container {
        max-width: 1400px;
    }
    .col-xxl {
        -ms-flex-preferred-size: 0;
        flex-basis: 0;
        -ms-flex-positive: 1;
        flex-grow: 1;
        max-width: 100%;
    }
    .row-cols-xxl-1 > * {
        -ms-flex: 0 0 100%;
        flex: 0 0 100%;
        max-width: 100%;
    }
    .row-cols-xxl-2 > * {
        -ms-flex: 0 0 50%;
        flex: 0 0 50%;
        max-width: 50%;
    }
    .row-cols-xxl-3 > * {
        -ms-flex: 0 0 33.333333%;
        flex: 0 0 33.333333%;
        max-width: 33.333333%;
    }
    .row-cols-xxl-4 > * {
        -ms-flex: 0 0 25%;
        flex: 0 0 25%;
        max-width: 25%;
    }
    .row-cols-xxl-5 > * {
        -ms-flex: 0 0 20%;
        flex: 0 0 20%;
        max-width: 20%;
    }
    .row-cols-xxl-6 > * {
        -ms-flex: 0 0 16.666667%;
        flex: 0 0 16.666667%;
        max-width: 16.666667%;
    }
    .col-xxl-auto {
        -ms-flex: 0 0 auto;
        flex: 0 0 auto;
        width: auto;
        max-width: 100;
    }
    .col-xxl-1 {
        -ms-flex: 0 0 8.333333%;
        flex: 0 0 8.333333%;
        max-width: 8.333333%;
    }
    .col-xxl-2 {
        -ms-flex: 0 0 16.666667%;
        flex: 0 0 16.666667%;
        max-width: 16.666667%;
    }
    .col-xxl-3 {
        -ms-flex: 0 0 25%;
        flex: 0 0 25%;
        max-width: 25%;
    }
    .col-xxl-4 {
        -ms-flex: 0 0 33.333333%;
        flex: 0 0 33.333333%;
        max-width: 33.333333%;
    }
    .col-xxl-5 {
        -ms-flex: 0 0 41.666667%;
        flex: 0 0 41.666667%;
        max-width: 41.666667%;
    }
    .col-xxl-6 {
        -ms-flex: 0 0 50%;
        flex: 0 0 50%;
        max-width: 50%;
    }
    .col-xxl-7 {
        -ms-flex: 0 0 58.333333%;
        flex: 0 0 58.333333%;
        max-width: 58.333333%;
    }
    .col-xxl-8 {
        -ms-flex: 0 0 66.666667%;
        flex: 0 0 66.666667%;
        max-width: 66.666667%;
    }
    .col-xxl-9 {
        -ms-flex: 0 0 75%;
        flex: 0 0 75%;
        max-width: 75%;
    }
    .col-xxl-10 {
        -ms-flex: 0 0 83.333333%;
        flex: 0 0 83.333333%;
        max-width: 83.333333%;
    }
    .col-xxl-11 {
        -ms-flex: 0 0 91.666667%;
        flex: 0 0 91.666667%;
        max-width: 91.666667%;
    }
    .col-xxl-12 {
        -ms-flex: 0 0 100%;
        flex: 0 0 100%;
        max-width: 100%;
    }
    .offset-xxl-0 {
        margin-left: 0;
    }
    .offset-xxl-1 {
        margin-left: 8.333333%;
    }
    .offset-xxl-2 {
        margin-left: 16.666667%;
    }
    .offset-xxl-3 {
        margin-left: 25%;
    }
    .offset-xxl-4 {
        margin-left: 33.333333%;
    }
    .offset-xxl-5 {
        margin-left: 41.666667%;
    }
    .offset-xxl-6 {
        margin-left: 50%;
    }
    .offset-xxl-7 {
        margin-left: 58.333333%;
    }
    .offset-xxl-8 {
        margin-left: 66.666667%;
    }
    .offset-xxl-9 {
        margin-left: 75%;
    }
    .offset-xxl-10 {
        margin-left: 83.333333%;
    }
    .offset-xxl-11 {
        margin-left: 91.666667%;
    }

    .pl-xxl-6,
    .px-xxl-6,
    .p-xxl-6 {
        padding-left: 4rem;
    }
    .pl-xxl-7,
    .px-xxl-7,
    .p-xxl-7 {
        padding-left: 5rem;
    }
    .pl-xxl-8,
    .px-xxl-8,
    .p-xxl-8 {
        padding-left: 6rem;
    }
    .pl-xxl-9,
    .px-xxl-9,
    .p-xxl-9 {
        padding-left: 8rem;
    }
    .pl-xxl-10,
    .px-xxl-10,
    .p-xxl-10 {
        padding-left: 10rem;
    }
    .pl-xxl-11,
    .px-xxl-11,
    .p-xxl-11 {
        padding-left: 12rem;
    }
    .pl-xxl-12,
    .px-xxl-12,
    .p-xxl-12 {
        padding-left: 16rem;
    }

    .pr-xxl-6,
    .px-xxl-6,
    .p-xxl-6 {
        padding-right: 4rem;
    }
    .pr-xxl-7,
    .px-xxl-7,
    .p-xxl-7 {
        padding-right: 5rem;
    }
    .pr-xxl-8,
    .px-xxl-8,
    .p-xxl-8 {
        padding-right: 6rem;
    }
    .pr-xxl-9,
    .px-xxl-9,
    .p-xxl-9 {
        padding-right: 8rem;
    }
    .pr-xxl-10,
    .px-xxl-10,
    .p-xxl-10 {
        padding-right: 10rem;
    }
    .pr-xxl-11,
    .px-xxl-11,
    .p-xxl-11 {
        padding-right: 12rem;
    }
    .pr-xxl-12,
    .px-xxl-12,
    .p-xxl-12 {
        padding-right: 16rem;
    }

    .pt-xxl-6,
    .py-xxl-6,
    .p-xxl-6 {
        padding-top: 4rem;
    }
    .pt-xxl-7,
    .py-xxl-7,
    .p-xxl-7 {
        padding-top: 5rem;
    }
    .pt-xxl-8,
    .py-xxl-8,
    .p-xxl-8 {
        padding-top: 6rem;
    }
    .pt-xxl-9,
    .py-xxl-9,
    .p-xxl-9 {
        padding-top: 8rem;
    }
    .pt-xxl-10,
    .py-xxl-10,
    .p-xxl-10 {
        padding-top: 10rem;
    }
    .pt-xxl-11,
    .py-xxl-11,
    .p-xxl-11 {
        padding-top: 12rem;
    }
    .pt-xxl-12,
    .py-xxl-12,
    .p-xxl-12 {
        padding-top: 16rem;
    }

    .pb-xxl-6,
    .py-xxl-6,
    .p-xxl-6 {
        padding-bottom: 4rem;
    }
    .pb-xxl-7,
    .py-xxl-7,
    .p-xxl-7 {
        padding-bottom: 5rem;
    }
    .pb-xxl-8,
    .py-xxl-8,
    .p-xxl-8 {
        padding-bottom: 6rem;
    }
    .pb-xxl-9,
    .py-xxl-9,
    .p-xxl-9 {
        padding-bottom: 8rem;
    }
    .pb-xxl-10,
    .py-xxl-10,
    .p-xxl-10 {
        padding-bottom: 10rem;
    }
    .pb-xxl-11,
    .py-xxl-11,
    .p-xxl-11 {
        padding-bottom: 12rem;
    }
    .pb-xxl-12,
    .py-xxl-12,
    .p-xxl-12 {
        padding-bottom: 16rem;
    }

    .pl-xxl-5px,
    .px-xxl-5px,
    .p-xxl-5px {
        padding-left: 5px;
    }
    .pl-xxl-10px,
    .px-xxl-10px,
    .p-xxl-10px {
        padding-left: 10px;
    }
    .pl-xxl-15px,
    .px-xxl-15px,
    .p-xxl-15px {
        padding-left: 15px;
    }
    .pl-xxl-20px,
    .px-xxl-20px,
    .p-xxl-20px {
        padding-left: 20px;
    }
    .pl-xxl-25px,
    .px-xxl-25px,
    .p-xxl-25px {
        padding-left: 25px;
    }
    .pl-xxl-30px,
    .px-xxl-30px,
    .p-xxl-30px {
        padding-left: 30px;
    }

    .pr-xxl-5px,
    .px-xxl-5px,
    .p-xxl-5px {
        padding-right: 5px;
    }
    .pr-xxl-10px,
    .px-xxl-10px,
    .p-xxl-10px {
        padding-right: 10px;
    }
    .pr-xxl-15px,
    .px-xxl-15px,
    .p-xxl-15px {
        padding-right: 15px;
    }
    .pr-xxl-20px,
    .px-xxl-20px,
    .p-xxl-20px {
        padding-right: 20px;
    }
    .pr-xxl-25px,
    .px-xxl-25px,
    .p-xxl-25px {
        padding-right: 25px;
    }
    .pr-xxl-30px,
    .px-xxl-30px,
    .p-xxl-30px {
        padding-right: 30px;
    }

    .pt-xxl-5px,
    .py-xxl-5px,
    .p-xxl-5px {
        padding-top: 5px;
    }
    .pt-xxl-10px,
    .py-xxl-10px,
    .p-xxl-10px {
        padding-top: 10px;
    }
    .pt-xxl-15px,
    .py-xxl-15px,
    .p-xxl-15px {
        padding-top: 15px;
    }
    .pt-xxl-20px,
    .py-xxl-20px,
    .p-xxl-20px {
        padding-top: 20px;
    }
    .pt-xxl-25px,
    .py-xxl-25px,
    .p-xxl-25px {
        padding-top: 25px;
    }
    .pt-xxl-30px,
    .py-xxl-30px,
    .p-xxl-30px {
        padding-top: 30px;
    }

    .pb-xxl-5px,
    .py-xxl-5px,
    .p-xxl-5px {
        padding-bottom: 5px;
    }
    .pb-xxl-10px,
    .py-xxl-10px,
    .p-xxl-10px {
        padding-bottom: 10px;
    }
    .pb-xxl-15px,
    .py-xxl-15px,
    .p-xxl-15px {
        padding-bottom: 15px;
    }
    .pb-xxl-20px,
    .py-xxl-20px,
    .p-xxl-20px {
        padding-bottom: 20px;
    }
    .pb-xxl-25px,
    .py-xxl-25px,
    .p-xxl-25px {
        padding-bottom: 25px;
    }
    .pb-xxl-30px,
    .py-xxl-30px,
    .p-xxl-30px {
        padding-bottom: 30px;
    }

    .w-xxl-auto {
        width: auto;
    }
    .w-xxl-5px,
    .size-xxl-5px {
        width: 5px;
    }
    .w-xxl-10px,
    .size-xxl-10px {
        width: 10px;
    }
    .w-xxl-15px,
    .size-xxl-15px {
        width: 15px;
    }
    .w-xxl-20px,
    .size-xxl-20px {
        width: 20px;
    }
    .w-xxl-25px,
    .size-xxl-25px {
        width: 25px;
    }
    .w-xxl-30px,
    .size-xxl-30px {
        width: 30px;
    }
    .w-xxl-35px,
    .size-xxl-35px {
        width: 35px;
    }
    .w-xxl-40px,
    .size-xxl-40px {
        width: 40px;
    }
    .w-xxl-45px,
    .size-xxl-45px {
        width: 45px;
    }
    .w-xxl-50px,
    .size-xxl-50px {
        width: 50px;
    }
    .w-xxl-60px,
    .size-xxl-60px {
        width: 60px;
    }
    .w-xxl-70px,
    .size-xxl-70px {
        width: 70px;
    }
    .w-xxl-80px,
    .size-xxl-80px {
        width: 80px;
    }
    .w-xxl-90px,
    .size-xxl-90px {
        width: 90px;
    }
    .w-xxl-100px,
    .size-xxl-100px {
        width: 100px;
    }
    .w-xxl-110px,
    .size-xxl-110px {
        width: 110px;
    }
    .w-xxl-120px,
    .size-xxl-120px {
        width: 120px;
    }
    .w-xxl-130px,
    .size-xxl-130px {
        width: 130px;
    }
    .w-xxl-140px,
    .size-xxl-140px {
        width: 140px;
    }
    .w-xxl-150px,
    .size-xxl-150px {
        width: 150px;
    }
    .w-xxl-160px,
    .size-xxl-160px {
        width: 160px;
    }
    .w-xxl-170px,
    .size-xxl-170px {
        width: 170px;
    }
    .w-xxl-180px,
    .size-xxl-180px {
        width: 180px;
    }
    .w-xxl-190px,
    .size-xxl-190px {
        width: 190px;
    }
    .w-xxl-200px,
    .size-xxl-200px {
        width: 200px;
    }
    .w-xxl-210px,
    .size-xxl-210px {
        width: 210px;
    }
    .w-xxl-220px,
    .size-xxl-220px {
        width: 220px;
    }
    .w-xxl-230px,
    .size-xxl-230px {
        width: 230px;
    }
    .w-xxl-240px,
    .size-xxl-240px {
        width: 240px;
    }
    .w-xxl-250px,
    .size-xxl-250px {
        width: 250px;
    }
    .w-xxl-260px,
    .size-xxl-260px {
        width: 260px;
    }
    .w-xxl-270px,
    .size-xxl-270px {
        width: 270px;
    }
    .w-xxl-280px,
    .size-xxl-280px {
        width: 280px;
    }
    .w-xxl-290px,
    .size-xxl-290px {
        width: 290px;
    }
    .w-xxl-300px,
    .size-xxl-300px {
        width: 300px;
    }
    .w-xxl-310px,
    .size-xxl-310px {
        width: 310px;
    }
    .w-xxl-320px,
    .size-xxl-320px {
        width: 320px;
    }
    .w-xxl-330px,
    .size-xxl-330px {
        width: 330px;
    }
    .w-xxl-340px,
    .size-xxl-340px {
        width: 340px;
    }
    .w-xxl-350px,
    .size-xxl-350px {
        width: 350px;
    }
    .w-xxl-360px,
    .size-xxl-360px {
        width: 360px;
    }
    .w-xxl-370px,
    .size-xxl-370px {
        width: 370px;
    }
    .w-xxl-380px,
    .size-xxl-380px {
        width: 380px;
    }
    .w-xxl-390px,
    .size-xxl-390px {
        width: 390px;
    }
    .w-xxl-400px,
    .size-xxl-400px {
        width: 400px;
    }
    .w-xxl-410px,
    .size-xxl-410px {
        width: 410px;
    }
    .w-xxl-420px,
    .size-xxl-420px {
        width: 420px;
    }
    .w-xxl-450px,
    .size-xxl-450px {
        width: 450px;
    }
    .w-xxl-500px,
    .size-xxl-500px {
        width: 500px;
    }

    .h-xxl-auto {
        height: auto;
    }
    .h-xxl-5px,
    .size-xxl-5px {
        height: 5px;
    }
    .h-xxl-10px,
    .size-xxl-10px {
        height: 10px;
    }
    .h-xxl-15px,
    .size-xxl-15px {
        height: 15px;
    }
    .h-xxl-20px,
    .size-xxl-20px {
        height: 20px;
    }
    .h-xxl-25px,
    .size-xxl-25px {
        height: 25px;
    }
    .h-xxl-30px,
    .size-xxl-30px {
        height: 30px;
    }
    .h-xxl-35px,
    .size-xxl-35px {
        height: 35px;
    }
    .h-xxl-40px,
    .size-xxl-40px {
        height: 40px;
    }
    .h-xxl-45px,
    .size-xxl-45px {
        height: 45px;
    }
    .h-xxl-50px,
    .size-xxl-50px {
        height: 50px;
    }
    .h-xxl-60px,
    .size-xxl-60px {
        height: 60px;
    }
    .h-xxl-70px,
    .size-xxl-70px {
        height: 70px;
    }
    .h-xxl-80px,
    .size-xxl-80px {
        height: 80px;
    }
    .h-xxl-90px,
    .size-xxl-90px {
        height: 90px;
    }
    .h-xxl-100px,
    .size-xxl-100px {
        height: 100px;
    }
    .h-xxl-110px,
    .size-xxl-110px {
        height: 110px;
    }
    .h-xxl-120px,
    .size-xxl-120px {
        height: 120px;
    }
    .h-xxl-130px,
    .size-xxl-130px {
        height: 130px;
    }
    .h-xxl-140px,
    .size-xxl-140px {
        height: 140px;
    }
    .h-xxl-150px,
    .size-xxl-150px {
        height: 150px;
    }
    .h-xxl-160px,
    .size-xxl-160px {
        height: 160px;
    }
    .h-xxl-170px,
    .size-xxl-170px {
        height: 170px;
    }
    .h-xxl-180px,
    .size-xxl-180px {
        height: 180px;
    }
    .h-xxl-190px,
    .size-xxl-190px {
        height: 190px;
    }
    .h-xxl-200px,
    .size-xxl-200px {
        height: 200px;
    }
    .h-xxl-210px,
    .size-xxl-210px {
        height: 210px;
    }
    .h-xxl-220px,
    .size-xxl-220px {
        height: 220px;
    }
    .h-xxl-230px,
    .size-xxl-230px {
        height: 230px;
    }
    .h-xxl-240px,
    .size-xxl-240px {
        height: 240px;
    }
    .h-xxl-250px,
    .size-xxl-250px {
        height: 250px;
    }
    .h-xxl-260px,
    .size-xxl-260px {
        height: 260px;
    }
    .h-xxl-270px,
    .size-xxl-270px {
        height: 270px;
    }
    .h-xxl-280px,
    .size-xxl-280px {
        height: 280px;
    }
    .h-xxl-290px,
    .size-xxl-290px {
        height: 290px;
    }
    .h-xxl-300px,
    .size-xxl-300px {
        height: 300px;
    }
    .h-xxl-310px,
    .size-xxl-310px {
        height: 310px;
    }
    .h-xxl-320px,
    .size-xxl-320px {
        height: 320px;
    }
    .h-xxl-330px,
    .size-xxl-330px {
        height: 330px;
    }
    .h-xxl-340px,
    .size-xxl-340px {
        height: 340px;
    }
    .h-xxl-350px,
    .size-xxl-350px {
        height: 350px;
    }
    .h-xxl-360px,
    .size-xxl-360px {
        height: 360px;
    }
    .h-xxl-370px,
    .size-xxl-370px {
        height: 370px;
    }
    .h-xxl-380px,
    .size-xxl-380px {
        height: 380px;
    }
    .h-xxl-390px,
    .size-xxl-390px {
        height: 390px;
    }
    .h-xxl-400px,
    .size-xxl-400px {
        height: 400px;
    }
    .h-xxl-410px,
    .size-xxl-410px {
        height: 410px;
    }
    .h-xxl-420px,
    .size-xxl-420px {
        height: 420px;
    }
    .h-xxl-450px,
    .size-xxl-450px {
        height: 450px;
    }
    .h-xxl-500px,
    .size-xxl-500px {
        height: 500px;
    }

    .xxl-no-gutters {
        margin-right: -0px;
        margin-left: -0px;
    }
    .xxl-no-gutters > .col,
    .xxl-no-gutters > [class*="col-"] {
        padding-right: 0px;
        padding-left: 0px;
    }
    .xxl-gutters-5 {
        margin-right: -5px;
        margin-left: -5px;
    }
    .xxl-gutters-5 > .col,
    .xxl-gutters-5 > [class*="col-"] {
        padding-right: 5px;
        padding-left: 5px;
    }
    .xxl-gutters-10 {
        margin-right: -10px;
        margin-left: -10px;
    }
    .xxl-gutters-10 > .col,
    .xxl-gutters-10 > [class*="col-"] {
        padding-right: 10px;
        padding-left: 10px;
    }
    .xxl-gutters-15 {
        margin-right: -15px;
        margin-left: -15px;
    }
    .xxl-gutters-15 > .col,
    .xxl-gutters-15 > [class*="col-"] {
        padding-right: 15px;
        padding-left: 15px;
    }
    .xxl-gutters-20 {
        margin-right: -20px;
        margin-left: -20px;
    }
    .xxl-gutters-20 > .col,
    .xxl-gutters-20 > [class*="col-"] {
        padding-right: 20px;
        padding-left: 20px;
    }
    .xxl-gutters-25 {
        margin-right: -25px;
        margin-left: -25px;
    }
    .xxl-gutters-25 > .col,
    .xxl-gutters-25 > [class*="col-"] {
        padding-right: 25px;
        padding-left: 25px;
    }
    .xxl-gutters-30 {
        margin-right: -30px;
        margin-left: -30px;
    }
    .xxl-gutters-30 > .col,
    .xxl-gutters-30 > [class*="col-"] {
        padding-right: 30px;
        padding-left: 30px;
    }

    [dir="rtl"] .row-cols-xxl-1 > * {
        -ms-flex: 0 0 100%;
        flex: 0 0 100%;
        max-width: 100%;
    }
    [dir="rtl"] .row-cols-xxl-2 > * {
        -ms-flex: 0 0 50%;
        flex: 0 0 50%;
        max-width: 50%;
    }
    [dir="rtl"] .row-cols-xxl-3 > * {
        -ms-flex: 0 0 33.333333%;
        flex: 0 0 33.333333%;
        max-width: 33.333333%;
    }
    [dir="rtl"] .row-cols-xxl-4 > * {
        -ms-flex: 0 0 25%;
        flex: 0 0 25%;
        max-width: 25%;
    }
    [dir="rtl"] .row-cols-xxl-5 > * {
        -ms-flex: 0 0 20%;
        flex: 0 0 20%;
        max-width: 20%;
    }
    [dir="rtl"] .row-cols-xxl-6 > * {
        -ms-flex: 0 0 16.666667%;
        flex: 0 0 16.666667%;
        max-width: 16.666667%;
    }

    .flex-grow-xxl-0 {
        -ms-flex-positive: 0 !important;
        flex-grow: 0 !important;
    }
    .flex-grow-xxl-1 {
        -ms-flex-positive: 1 !important;
        flex-grow: 1 !important;
    }
}

/*bootstrap, global reset*/
body {
    margin: 0;
    font-family: "Roboto", Helvetica, sans-serif;
    font-size: 13px;
    font-weight: 400;
    line-height: 1.5;
    color: #1b1b28;
    max-width: 100vw;
    overflow-x: hidden;
}
a,
button,
input,
textarea,
.btn,
.has-transition {
    -webkit-transition: all 0.3s ease;
    transition: all 0.3s ease;
}
a {
    color: var(--primary);
}
a:hover {
    text-decoration: none;
    color: var(--hov-primary);
}
:focus,
a:focus,
button:focus,
.page-link:focus,
.custom-file-input:focus ~ .custom-file-label {
    box-shadow: none;
    outline: none;
}
input[type="search"]::-webkit-search-decoration,
input[type="search"]::-webkit-search-cancel-button,
input[type="search"]::-webkit-search-results-button,
input[type="search"]::-webkit-search-results-decoration {
    display: none;
}
input[type="number"]::-webkit-outer-spin-button,
input[type="number"]::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
}
input[type="number"] {
    -moz-appearance: textfield;
}

/*mobile toggler*/
.aiz-mobile-toggler {
    position: relative;
    overflow: hidden;
    margin: 0;
    padding: 0;
    font-size: 0;
    text-indent: -9999px;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    -webkit-box-shadow: none;
    box-shadow: none;
    border-radius: 0;
    border: none;
    cursor: pointer;
    background: 0 0;
    outline: 0 !important;
    width: 20px;
    height: 20px;
    -webkit-transition: all 0.4s ease;
    transition: all 0.4s ease;
}

.aiz-mobile-toggler span {
    display: block;
    position: absolute;
    top: 9px;
    height: 2px;
    min-height: 2px;
    width: 100%;
    border-radius: 2px;
    -webkit-transition: all 0.4s ease;
    transition: all 0.4s ease;
    background: #9c9c9c;
}

.aiz-mobile-toggler span:before,
.aiz-mobile-toggler span:after {
    position: absolute;
    display: block;
    left: 0;
    width: 100%;
    height: 2px;
    min-height: 2px;
    content: "";
    border-radius: 2px;
    -webkit-transition: all 0.4s ease;
    transition: all 0.4s ease;
    background: #9c9c9c;
}
.aiz-mobile-toggler.light span,
.aiz-mobile-toggler.light span:before,
.aiz-mobile-toggler.light span:after {
    background: #fff;
}
.aiz-mobile-toggler span:before {
    -webkit-transition: all 0.4s ease;
    transition: all 0.4s ease;
    left: auto;
    left: 0;
    width: 50%;
    top: -7px;
}

.aiz-mobile-toggler span:after {
    -webkit-transition: all 0.4s ease;
    transition: all 0.4s ease;
    left: auto;
    left: 0;
    width: 75%;
    bottom: -7px;
}
button:hover .aiz-mobile-toggler span,
button:hover .aiz-mobile-toggler span:before,
button:hover .aiz-mobile-toggler span:after {
    background-color: #fff;
}

/*aiz styles*/
.aiz-main-wrapper {
    min-height: 100vh;
    max-width: 100vw;
    background-color: #fff;
}

.aiz-titlebar h1,
.aiz-titlebar .title {
    font-size: 1rem;
    font-weight: 500;
}

.aiz-content-wrapper {
    padding-left: 0;
    padding-top: 85px;
    height: 100%;
    min-height: 100vh;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-direction: column;
    flex-direction: column;
    transition: all 0.3s;
    -webkit-transition: all 0.3s;
}
.aiz-main-content {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-direction: column;
    flex-direction: column;
    -ms-flex-positive: 1;
    flex-grow: 1;
}
/* lg */
@media (min-width: 992px) {
    .aiz-content-wrapper {
        padding-top: 100px;
    }
}
/* xl */
@media (min-width: 1200px) {
    .aiz-content-wrapper {
        padding-left: 265px;
    }
    [dir="rtl"] .aiz-content-wrapper {
        padding-left: 0;
        padding-right: 265px;
    }
    .side-menu-closed .aiz-content-wrapper {
        padding-left: 0;
    }
}

/*topbar*/
.aiz-topbar {
    position: fixed;
    top: 0;
    width: 100%;
    height: 65px;
    left: 0;
    z-index: 97;
    background-color: #fff;
    -webkit-box-shadow: 0 10px 30px 0 rgba(121, 121, 162, 0.1);
    box-shadow: 0 10px 30px 0 rgba(121, 121, 162, 0.1);
    transition: all 0.3s;
    -webkit-transition: all 0.3s;
}
.layout-2 .aiz-topbar{
    -webkit-box-shadow: none;
    box-shadow: none;
}
.aiz-topbar-logo-wrap img {
    height: 30px;
}
.aiz-topbar-user,
.aiz-topbar-user:hover {
    color: var(--gray-dark);
}
.aiz-topbar-item {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-pack: distribute;
    justify-content: space-around;
    -ms-flex-align: stretch;
    align-items: stretch;
}
/* lg */
@media (min-width: 992px) {
    .aiz-topbar {
        height: 80px;
    }
}
/* xl */
@media (min-width: 1200px) {
    .aiz-topbar {
        width: calc(100% - 265px);
        left: 265px;
    }
    .layout-2 .aiz-topbar{
        left: 0;
        width: 100%;
    }
    [dir="rtl"] .aiz-topbar {
        left: auto;
        right: 265px;
    }
    [dir="rtl"] .layout-2 .aiz-topbar {
        left: 0;
        right: 0;
    }
    .side-menu-closed .aiz-topbar {
        left: 0;
        width: 100%;
    }
    [dir="rtl"] .side-menu-closed .aiz-topbar {
        left: auto;
        right: 0;
        width: 100%;
    }
}

/*siebar nav*/
.aiz-sidebar-overlay {
    cursor: pointer;
    position: fixed;
    left: 0;
    right: 0;
    bottom: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.3);
    z-index: 98;
    visibility: hidden;
    opacity: 0;
    -webkit-transition: visibility 0.3s ease, opacity 0.3s ease;
    transition: visibility 0.3s ease, opacity 0.3s ease;
}
@media (max-width: 1199.98px) {
    .side-menu-open .aiz-sidebar-overlay {
        visibility: visible;
        opacity: 1;
    }
}
.aiz-sidebar.left {
    position: fixed;
    top: 0;
    bottom: 0;
    left: -265px;
    height: 100vh;
    overflow-y: auto;
    z-index: 99;
    background-color: #181827;
    width: 265px;
    -webkit-transition: left 0.3s ease;
    transition: left 0.3s ease;
}
@media (min-width: 1200px) {
    .layout-2 .aiz-sidebar{
        top: 80px;
        height: calc(100vh - 80px);
    }
}
[dir="rtl"] .aiz-sidebar.left {
    left: auto;
    right: -265px;
    -webkit-transition: right 0.3s ease;
    transition: right 0.3s ease;
}
.side-menu-open .aiz-sidebar-wrap .left {
    left: 0px;
}
[dir="rtl"] .side-menu-open .aiz-sidebar-wrap .left {
    right: 0;
}
.aiz-side-nav-logo-wrap a {
    padding: 17px 25px;
}

.aiz-side-nav-logo-wrap img {
    height: 31px;
}
.aiz-side-nav-logo-wrap {
    background-color: #000000;
}

.aiz-side-nav-wrap {
    padding: 15px 0;
}
.aiz-side-nav-list {
    list-style: none;
    padding: 0;
    margin: 0;
}
.aiz-side-nav-list .level-2:not(.mm-show):not(.mm-collapsing),
.aiz-side-nav-list .level-3:not(.mm-show):not(.mm-collapsing) {
    visibility: hidden;
    height: 0;
}
.aiz-side-nav-list .aiz-side-nav-link {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-flex: 1;
    -ms-flex-positive: 1;
    flex-grow: 1;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    padding: 12px 25px;
    font-size: 0.875rem;
    font-weight: 400;
    color: #fff;
    text-transform: capitalize;
}
.layout-2 .aiz-side-nav-list .aiz-side-nav-link{
    color: #444444;
    font-size: 13px;
    font-weight: 600;
    padding: 12px 10px;
    margin-bottom: 5px;
    border-radius: 6px;
}
.layout-2 .aiz-side-nav-list .aiz-side-nav-link svg *{
    fill: #BDBDBD
}
.aiz-side-nav-list .aiz-side-nav-link > svg {
    margin-right: 20px;
}
[dir="rtl"] .aiz-side-nav-list .aiz-side-nav-link > svg {
    margin-right: 0;
    margin-left: 20px;
}
.aiz-side-nav-list .aiz-side-nav-icon {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    color: #7a7c9e;
    margin-right: 6px;
    -webkit-transition: all 0.3s ease;
    transition: all 0.3s ease;
}
[dir="rtl"] .aiz-side-nav-list .aiz-side-nav-icon {
    margin-right: 0px;
    margin-left: 6px;
}
.aiz-side-nav-list .aiz-side-nav-text {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-flex: 1;
    -ms-flex-positive: 1;
    flex-grow: 1;
}
.aiz-side-nav-list .aiz-side-nav-arrow {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: end;
    -ms-flex-pack: end;
    justify-content: flex-end;
    font-size: 80%;
}
.aiz-side-nav-list .aiz-side-nav-link:hover .aiz-side-nav-icon {
    color: #9191a0;
}
.aiz-side-nav-list .aiz-side-nav-arrow::after {
    content: "\f105";
    font-family: "Line Awesome Free";
    font-weight: 900;
    -webkit-transition: all 0.3s ease;
    transition: all 0.3s ease;
}
[dir="rtl"] .aiz-side-nav-list .aiz-side-nav-arrow::after {
    content: "\f104";
}
.aiz-side-nav-list [aria-expanded="true"] .aiz-side-nav-arrow::after {
    -webkit-transform: rotate(90deg);
    transform: rotate(90deg);
}
[dir="rtl"]
    .aiz-side-nav-list
    [aria-expanded="true"]
    .aiz-side-nav-arrow::after {
    -webkit-transform: rotate(-90deg);
    transform: rotate(-90deg);
}
.aiz-side-nav-list .level-2 .aiz-side-nav-link {
    padding: 10px 25px 10px 54px;
    position: relative;
    font-size: 0.8125rem;
}
.layout-2 .aiz-side-nav-list .level-2 .aiz-side-nav-link {
    padding: 10px 25px 10px 45px;
}
[dir="rtl"] .aiz-side-nav-list .level-2 .aiz-side-nav-link {
    padding: 10px 54px 10px 25px;
}
[dir="rtl"] .layout-2 .aiz-side-nav-list .level-2 .aiz-side-nav-link {
    padding: 10px 45px 10px 25px;
}
.aiz-side-nav-list .level-3 .aiz-side-nav-link {
    padding-left: 68px;
}

.aiz-side-nav-list .level-2 .aiz-side-nav-link:after {
    position: absolute;
    content: "";
    height: 6px;
    width: 6px;
    border: 1px solid #707070;
    border-radius: 50%;
    top: calc(50% - 3px);
    left: 40px;
    -webkit-transition: all 0.3s ease;
    transition: all 0.3s ease;
}
.layout-2 .aiz-side-nav-list .level-2 .aiz-side-nav-link:after {
    left: 20px;
}
.aiz-side-nav-list .level-3 .aiz-side-nav-link:after {
    left: 54px;
}
[dir="rtl"] .aiz-side-nav-list .level-2 .aiz-side-nav-link:after {
    left: 0px;
    right: 40px;
}
[dir="rtl"] .layout-2 .aiz-side-nav-list .level-2 .aiz-side-nav-link:after {
    left: 0px;
    right: 20px;
}
[dir="rtl"] .aiz-side-nav-list .level-3 .aiz-side-nav-link:after {
    right: 54px;
}

.aiz-side-nav-list .aiz-side-nav-link:hover,
.aiz-side-nav-list .aiz-side-nav-link.level-2-active,
.aiz-side-nav-list .aiz-side-nav-link.level-3-active,
.aiz-side-nav-list .aiz-side-nav-link.active {
    color: var(--primary);
    background-color: #dfedf5;
}
.aiz-side-nav-list .aiz-side-nav-link:hover > svg,
.aiz-side-nav-list .aiz-side-nav-link:hover > svg *,
.aiz-side-nav-list .aiz-side-nav-link.active > svg,
.aiz-side-nav-list .aiz-side-nav-link.active > svg *,
.aiz-side-nav-list .aiz-side-nav-link.level-2-active > svg,
.aiz-side-nav-list .aiz-side-nav-link.level-2-active > svg * {
    fill: var(--primary);
}

.aiz-side-nav-list .level-2 .aiz-side-nav-link:hover:after,
.aiz-side-nav-list .level-2 .aiz-side-nav-link.active:after {
    background: #707070;
}

.layout-2 .aiz-side-nav-list .aiz-side-nav-link:hover,
.layout-2 .aiz-side-nav-list .aiz-side-nav-link.level-2-active,
.layout-2 .aiz-side-nav-list .aiz-side-nav-link.level-3-active,
.layout-2 .aiz-side-nav-list .aiz-side-nav-link.active{
    background-color: var(--primary);
    color: #fff;
}
.layout-2 .aiz-side-nav-list .aiz-side-nav-link:hover > svg,
.layout-2 .aiz-side-nav-list .aiz-side-nav-link:hover > svg *,
.layout-2 .aiz-side-nav-list .aiz-side-nav-link.active > svg,
.layout-2 .aiz-side-nav-list .aiz-side-nav-link.active > svg *,
.layout-2 .aiz-side-nav-list .aiz-side-nav-link.level-2-active > svg,
.layout-2 .aiz-side-nav-list .aiz-side-nav-link.level-2-active > svg * {
    fill: #fff;
}

/* xl */
@media (min-width: 1200px) {
    .aiz-sidebar.left {
        left: 0px;
    }
    [dir="rtl"] .aiz-sidebar.left {
        left: auto;
        right: 0;
    }
    .side-menu-closed .aiz-sidebar.left {
        left: -265px;
    }
    [dir="rtl"] .side-menu-closed .aiz-sidebar.left {
        left: auto;
        right: -265px;
    }
}

/*dropdown*/
.dropdown-toggle {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-align: center;
    align-items: center;
}
.dropdown-toggle::after {
    border: 0;
    content: "\f107";
    font-family: "Line Awesome Free";
    font-weight: 900;
    font-size: 80%;
    margin-left: 0.3rem;
}
.dropup .dropdown-toggle::after {
    border: 0;
    content: "\f106";
}
.dropdown-toggle.no-arrow::after {
    content: none;
}
.dropdown-menu {
    border-color: #e2e5ec;
    margin: 0;
    border-radius: 0;
    min-width: 14rem;
    font-size: inherit;
    padding: 0;
    -webkit-box-shadow: 0 0 50px 0 rgba(82, 63, 105, 0.15);
    box-shadow: 0 0 50px 0 rgba(82, 63, 105, 0.15);
    padding: 0.5rem 0;
    border-radius: 4px;
    max-width: 100%;
}
.dropdown-menu-animated {
    display: block;
    visibility: hidden;
    opacity: 0;
    -webkit-transition: margin-top 0.3s, visibility 0.3s, opacity 0.3s;
    transition: margin-top 0.3s, visibility 0.3s, opacity 0.3s;
    margin-top: 20px !important;
}
.show.dropdown-menu {
    visibility: visible;
    opacity: 1;
    margin-top: 0 !important;
}
.dropdown-menu.dropdown-menu-xs {
    width: 160px;
    min-width: 160px;
}
.dropdown-menu.dropdown-menu-sm {
    width: 240px;
    min-width: 240px;
}
.dropdown-menu.dropdown-menu-md {
    width: 260px;
    min-width: 260px;
}
.dropdown-menu.dropdown-menu-lg {
    width: 320px;
    min-width: 320px;
}
.dropdown-menu.dropdown-menu-xl {
    width: 380px;
    min-width: 380px;
}
.dropdown-item {
    display: block;
    width: 100%;
    padding: 0.5rem 1.5rem;
    clear: both;
    font-weight: 400;
    color: #74788d;
    text-align: inherit;
    white-space: nowrap;
    background-color: transparent;
    border: 0;
}
.dropdown-item.active,
.dropdown-item:hover,
.dropdown-item:active {
    color: #fff !important;
    background-color: var(--primary);
}
/*card elements*/
.card {
    -webkit-box-shadow: none;
    box-shadow: none;
    background-color: #fff;
    margin-bottom: 20px;
    border-color: #ebedf2;
}
.card .card-header {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: justify;
    -ms-flex-pack: justify;
    justify-content: space-between;
    position: relative;
    padding: 12px 25px;
    border-bottom: 1px solid #ebedf2;
    min-height: 50px;
    border-top-left-radius: 4px;
    border-top-right-radius: 4px;
    background-color: transparent;
}
.card .card-body {
    padding: 20px 25px;
    border-radius: 4px;
    overflow:hidden;
}
.card .card-footer {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: justify;
    -ms-flex-pack: justify;
    justify-content: space-between;
    border-bottom-left-radius: 4px;
    border-bottom-right-radius: 4px;
    border-top: 1px solid #ebedf2;
    background-color: transparent;
    padding: 12px 25px;
}
.card-bordered {
    border: 1px solid #ebedf2;
}


.aiz-p-hov-icon a {
    display: block;
    height: 32px;
    width: 32px;
    line-height: 32px;
    border-radius: 50%;
    text-align: center;
    background: #fff;
    margin-top: 5px;
    margin-right: 5px;
    color: #333;
    font-size: 15px;
    box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1), 0 3px 8px rgba(0, 0, 0, 0.12);
    transform: translateX(calc(100% + 7px));
    -webkit-transform: translateX(calc(100% + 7px));
}
[dir="rtl"] .aiz-p-hov-icon a {
    transform: translateX(calc(-100% - 7px));
    -webkit-transform: translateX(calc(-100% - 7px));
    margin-left: 5px;
}
.aiz-p-hov-icon a:hover {
    background: var(--primary);
    color: #fff;
}
.aiz-p-hov-icon a:nth-child(2) {
    transition-delay: 0.05s;
    -webkit-transition-delay: 0.05s;
}
.aiz-p-hov-icon a:nth-child(3) {
    transition-delay: 0.1s;
    -webkit-transition-delay: 0.1s;
}
.aiz-card-box {
    overflow: hidden;
}
.aiz-card-box:hover .aiz-p-hov-icon a {
    transform: translateX(0);
    -webkit-transform: translateX(0);
}

/*tabs*/
.aiz-nav-tabs a.active {
    border-bottom: 2px solid var(--primary);
}

/*aiz steps*/
.aiz-steps .icon {
    height: 40px;
    width: 40px;
    line-height: 40px;
    margin-left: auto;
    margin-right: auto;
    background: var(--secondary);
    font-size: 20px;
    border-radius: 50%;
    color: #fff;
    margin-bottom: 10px;
    position: relative;
    z-index: 1;
}
.aiz-steps > * {
    opacity: 0.4;
}
.aiz-steps > *:not(:first-of-type):before {
    position: absolute;
    width: calc(100% - 20px);
    height: 4px;
    background: var(--secondary);
    content: "";
    right: calc(50% + 20px);
    top: 18px;
    z-index: 0;
    opacity: 0.4;
}
[dir="rtl"] .aiz-steps > *:not(:first-of-type):before {
    left: calc(50% + 20px);
    right: auto;
}
.aiz-steps .title {
    font-size: 15px;
    font-weight: 600;
}
.aiz-steps .done .icon,
.aiz-steps .done:before {
    background: var(--primary) !important;
}
.aiz-steps .done,
.aiz-steps .active,
.aiz-steps .done:before,
.aiz-steps .active:before {
    opacity: 1 !important;
}
.aiz-steps .active .icon {
    background: var(--success);
}
.aiz-steps.arrow-divider > *:not(:first-of-type) {
    position: relative;
}
.aiz-steps.arrow-divider > *:not(:first-of-type):before {
    position: absolute;
    content: "\f105";
    font-family: "Line Awesome Free";
    font-weight: 900;
    top: 5px;
    left: -13px;
    font-size: 22px;
    opacity: 0.2 !important;
    height: auto;
    width: auto;
    background-color: transparent !important;
}
[dir="rtl"] .aiz-steps.arrow-divider > *:not(:first-of-type):before {
    left: -5px;
    right: auto;
    content: "\f104";
}

/*countdown*/
.aiz-count-down {
    display: flex;
    direction: ltr;
}
.aiz-count-down .countdown-item {
    padding: 4px 6px;
    background: var(--primary);
    color: #fff;
    border-radius: 3px;
    margin: 0 3px;
}
.aiz-count-down-lg .countdown-item {
    padding: 6px 10px;
    font-size: 16px;
}

/*form elements*/
.label-danger
{
    float:right;
}
.form-control {
    padding: 0.6rem 1rem;
    font-size: 0.875rem;
    height: calc(1.3125rem + 1.2rem + 2px);
    border: 1px solid #e2e5ec;
    color: #000;
}
.form-control-sm {
    height: calc(1.5rem + 0.8rem + 2px);
    padding: 0.4rem 0.7rem;
    font-size: 0.8125rem;
    line-height: 1.5;
    border-radius: 0.25rem;
}
.form-control-lg {
    height: calc(1.5rem + 1.5rem + 2px);
    padding: 0.75rem 1rem;
    font-size: 1rem;
    line-height: 1.5;
    border-radius: 0.3rem;
}
.form-control:focus {
    border-color: var(--primary);
    box-shadow: none;
}
.form-control::-webkit-input-placeholder {
    color: #898b92;
}
.form-control:-ms-input-placeholder {
    color: #898b92;
}
.form-control::placeholder {
    color: #898b92;
}
.form-control:disabled,
.form-control[readonly] {
    background-color: #f7f8fa;
    opacity: 1;
    border-color: #e2e5ec;
}
.resize-off {
    resize: none;
}
.custom-file-input:focus ~ .custom-file-label {
    border-color: #e2e5ec;
}
.custom-file {
    height: calc(1.3125rem + 1.2rem + 2px);
    overflow: hidden;
}
.custom-file-input {
    height: 0;
    width: 0;
    opacity: 0;
    position: absolute;
}
.custom-file-name {
    white-space: nowrap;
}
.custom-file-label,
.custom-file-label::after {
    padding: 0.6rem 1rem;
    font-size: 0.875rem;
    height: calc(1.3125rem + 1.2rem + 2px);
    border: 1px solid #e2e5ec;
    color: #898b92;
}
.custom-file-label::after {
    height: calc(1.3125rem + 1.2rem);
}
.custom-file-sm {
    height: calc(1.5rem + 0.8rem + 2px);
}
.custom-file-sm .custom-file-label,
.custom-file-sm .custom-file-label::after {
    height: calc(1.5rem + 0.8rem + 2px);
    padding: 0.4rem 0.7rem;
    font-size: 0.8125rem;
    line-height: 1.5;
}
.custom-file-sm .custom-file-label::after {
    height: calc(1.5rem + 0.8rem);
}

.custom-file-lg {
    height: calc(1.5rem + 1.5rem + 2px);
}
.custom-file-lg .custom-file-label,
.custom-file-lg .custom-file-label::after {
    height: calc(1.5rem + 1.5rem + 2px);
    padding: 0.75rem 1rem;
    font-size: 1rem;
    line-height: 1.5;
}
.custom-file-lg .custom-file-label::after {
    height: calc(1.5rem + 1.5rem);
}

/*custom checkbox, radio*/
.aiz-checkbox-list {
    padding: 0 0;
}
.aiz-checkbox,
.aiz-radio {
    display: inline-block;
    position: relative;
    padding-left: 28px;
    margin-bottom: 10px;
    cursor: pointer;
    font-size: 0.875rem;
    -webkit-transition: all 0.3s ease;
    transition: all 0.3s ease;
}
[dir="rtl"] .aiz-checkbox,
[dir="rtl"] .aiz-radio {
    padding-right: 28px;
    padding-left: 0;
}
.aiz-checkbox-list .aiz-checkbox,
.aiz-radio-list .aiz-radio {
    display: block;
}
.aiz-checkbox.aiz-checkbox-disabled,
.aiz-radio.aiz-radio-disabled {
    opacity: 0.8;
    cursor: not-allowed;
}
.aiz-checkbox-inline .aiz-checkbox,
.aiz-radio-inline .aiz-radio {
    display: inline-block;
    margin-right: 15px;
    margin-bottom: 5px;
}
.aiz-checkbox-inline .aiz-checkbox:last-child,
.aiz-radio-inline .aiz-radio:last-child {
    margin-right: 0;
}
.aiz-checkbox > input,
.aiz-radio > input {
    position: absolute;
    z-index: -1;
    opacity: 0;
}
.aiz-square-check,
.aiz-rounded-check {
    background: 0 0;
    position: relative;
    height: 16px;
    width: 16px;
    border: 1px solid #d1d7e2;
}

.aiz-checkbox .aiz-square-check,
.aiz-checkbox .aiz-rounded-check,
.aiz-radio .aiz-square-check,
.aiz-radio .aiz-rounded-check {
    position: absolute;
    top: 2px;
    left: 0;
}
[dir="rtl"] .aiz-checkbox .aiz-square-check,
[dir="rtl"] .aiz-checkbox .aiz-rounded-check,
[dir="rtl"] .aiz-radio .aiz-square-check,
[dir="rtl"] .aiz-radio .aiz-rounded-check {
    left: auto;
    right: 0;
}
.aiz-square-check {
    border-radius: 3px;
}
.aiz-rounded-check {
    border-radius: 50%;
}
.aiz-square-check:after,
.aiz-rounded-check:after {
    content: "";
    position: absolute;
    visibility: hidden;
    opacity: 0;
    top: 50%;
    left: 50%;
    -webkit-transition: all 0.3s ease;
    transition: all 0.3s ease;
}
.aiz-square-check:after {
    margin-left: -2px;
    margin-top: -6px;
    width: 5px;
    height: 10px;
    border-width: 0 2px 2px 0 !important;
    -webkit-transform: rotate(45deg);
    transform: rotate(45deg);
    border: solid var(--primary);
}
.aiz-rounded-check:after {
    margin-left: -3px;
    margin-top: -3px;
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: var(--primary);
}
.aiz-checkbox > input:checked ~ .aiz-square-check:after,
.aiz-radio > input:checked ~ .aiz-square-check:after,
.aiz-checkbox > input:checked ~ .aiz-rounded-check:after,
.aiz-radio > input:checked ~ .aiz-rounded-check:after {
    visibility: visible;
    opacity: 1;
}

/*aiz megabox*/
.aiz-megabox {
    position: relative;
    cursor: pointer;
}
.aiz-megabox input {
    position: absolute;
    z-index: -1;
    opacity: 0;
}
.aiz-megabox .aiz-megabox-elem {
    border: 1px solid #e2e5ec;
    border-radius: 0.25rem;
    -webkit-transition: all 0.3s ease;
    transition: all 0.3s ease;
    border-radius: 0.25rem;
}
.aiz-megabox > input:checked ~ span .aiz-rounded-check:after,
.aiz-megabox > input:checked ~ span .aiz-square-check:after {
    visibility: visible;
    opacity: 1;
}

.aiz-megabox > input:checked ~ .aiz-megabox-elem,
.aiz-megabox > input:checked ~ .aiz-megabox-elem {
    border-color: var(--primary);
}

/*input group/ form group*/
.input-group > .input-group-prepend > .form-control {
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
}
textarea.form-control{
    height:120px !important;
}
.input-group-text {
    padding: 0.6rem 1rem;
    font-size: 0.875rem;
    line-height: 1.5;
    color: #74788d;
    background-color: #f7f8fa;
    border: 1px solid #e2e5ec;
    border-radius: 4px;
}
.input-group-sm > .custom-select,
.input-group-sm > .form-control:not(textarea) {
    height: calc(1.5em + 0.8rem + 2px);
}
.input-group-sm > .custom-select,
.input-group-sm > .form-control,
.input-group-sm > .input-group-append > .btn,
.input-group-sm > .input-group-append > .input-group-text,
.input-group-sm > .input-group-prepend > .btn,
.input-group-sm > .input-group-prepend > .input-group-text {
    padding: 0.4rem 0.7rem;
    font-size: 0.8125rem;
}

/*input with icon*/
.aiz-input-icon {
    position: relative;
}
.aiz-input-icon.aiz-input-icon--left .form-control {
    padding-left: 2.6rem;
}
.aiz-input-icon.aiz-input-icon--right .form-control {
    padding-right: 2.6rem;
}
.aiz-input-icon > .aiz-input-icon__icon {
    position: absolute;
    height: 100%;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    top: 0;
    width: 2.6rem;
}
.aiz-input-icon--left > .aiz-input-icon__icon {
    left: 0;
}
.aiz-input-icon--right > .aiz-input-icon__icon {
    right: 0;
}
/*switch*/
.aiz-switch input:empty {
    height: 0;
    width: 0;
    overflow: hidden;
    position: absolute;
    opacity: 0;
}
.aiz-switch input:empty ~ span {
    display: inline-block;
    position: relative;
    text-indent: 0;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    line-height: 24px;
    height: 21px;
    width: 40px;
    border-radius: 12px;
}
.aiz-switch input:empty ~ span:after,
.aiz-switch input:empty ~ span:before {
    position: absolute;
    display: block;
    top: 0;
    bottom: 0;
    left: 0;
    content: " ";
    -webkit-transition: all 0.1s ease-in;
    transition: all 0.1s ease-in;
    width: 40px;
    border-radius: 12px;
}
.aiz-switch input:empty ~ span:before {
    background-color: #e8ebf1;
}
.aiz-switch input:empty ~ span:after {
    height: 17px;
    width: 17px;
    line-height: 20px;
    top: 2px;
    bottom: 2px;
    margin-left: 2px;
    font-size: 0.8em;
    text-align: center;
    vertical-align: middle;
    color: #f8f9fb;
    background-color: #fff;
}
.aiz-switch input:checked ~ span:after {
    background-color: var(--primary);
    margin-left: 20px;
}
.aiz-switch-secondary input:checked ~ span:after {
    background-color: var(--secondary);
}
.aiz-switch-success input:checked ~ span:after {
    background-color: var(--success);
}
.aiz-switch-info input:checked ~ span:after {
    background-color: var(--info);
}
.aiz-switch-warning input:checked ~ span:after {
    background-color: var(--warning);
}
.aiz-switch-danger input:checked ~ span:after {
    background-color: var(--danger);
}
.aiz-switch-light input:checked ~ span:after {
    background-color: var(--light);
}
.aiz-switch-dark input:checked ~ span:after {
    background-color: var(--dark);
}

/*bootstrap select */
.bootstrap-select .dropdown-toggle:focus,
.bootstrap-select > select.mobile-device:focus + .dropdown-toggle {
    outline: none !important;
}
.bootstrap-select .dropdown-toggle {
    color: #898b92;
    background-color: transparent !important;
    border-color: #e2e5ec;
}
.bootstrap-select.form-control-sm .dropdown-toggle {
    padding: 0.416rem 0.7rem;
    height: calc(1.5rem + 0.8rem + 2px);
}
.bootstrap-select.form-control-lg .dropdown-toggle {
    height: calc(1.5rem + 1.5rem + 2px);
    padding: 0.75rem 1rem;
    font-size: 1rem;
}
.bootstrap-select .dropdown-toggle:active,
.bootstrap-select .dropdown-toggle:focus,
.show.bootstrap-select .dropdown-toggle {
    border-color: var(--primary) !important;
}
.bootstrap-select .dropdown-menu .selected span.check-mark {
    right: 12px;
    top: 11px;
}
.bootstrap-select .bs-ok-default:after {
    width: 6px;
    height: 12px;
    border-width: 0 2px 2px 0;
    border-color: #6f6f80;
}
.dropdown-item:hover .bs-ok-default:after {
    border-color: #fff;
}
.bootstrap-select .no-results {
    padding: 8px 10px;
    background: #f5f5f5;
    margin: 0 8px;
    border-radius: 3px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    max-width: 100%;
}
.bootstrap-select .dropdown-menu .notify {
    width: calc(100% - 20px);
    margin: 0 10px;
    min-height: 26px;
    padding: 8px 12px;
    background: #f2f3f8;
    border: 1px solid #e3e3e3;
    border-radius: 3px;
    -webkit-box-shadow: none;
    box-shadow: none;
    opacity: 1;
}
.bootstrap-select .notify.fadeOut {
    -webkit-animation: bs-notify-fadeOut 2s linear 0.2s;
    -o-animation: bs-notify-fadeOut 2s linear 0.2s;
    animation: bs-notify-fadeOut 2s linear 0.2s;
}
.bootstrap-select .bs-actionsbox .btn-group button:first-child {
    border-right: 1px solid #fff;
}

.bootstrap-select .bs-actionsbox .btn-group button:last-child {
    border-left: 1px solid #fff;
}

.bootstrap-select .bs-actionsbox .btn-group button {
    padding: 0.6rem 0.5rem;
    line-height: 1;
}
.bootstrap-select .dropdown-menu li,
.bootstrap-select .dropdown-toggle .filter-option-inner-inner {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
.bootstrap-select .dropdown-menu li a span.text {
    max-width: 100%;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    margin-right: 0;
    vertical-align: bottom;
}
[dir="rtl"] .bootstrap-select .dropdown-toggle .filter-option {
    float: right;
    text-align: right;
}
/*tagify tag input*/

.aiz-tag-input {
    height: auto;
    padding: 0.465rem 1rem 0.2rem;
}
.aiz-tag-input .tagify__input {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
.aiz-tag-input .tagify__input:before {
    line-height: 1;
    position: static;
}
.aiz-tag-input .tagify__tag,
.aiz-tag-input .tagify__input {
    margin: 0px 5px 5px 0px;
}
.aiz-tag-input .tagify__tag__removeBtn {
    font: 12px Serif;
    line-height: 1.5;
}
.aiz-tag-input .tagify__tag__removeBtn:hover + div > span {
    opacity: 1;
}

/*text editor - summernote */
.note-editor .note-dropzone {
    opacity: 0 !important;
}
.note-editor.note-frame {
    border: 1px solid #e2e5ec;
    box-shadow: none;
    background: #f7f8fa;
}
.note-editor.note-frame .panel-heading.note-toolbar {
    background: #f7f8fa;
}
.note-editor .card-header.note-toolbar {
    padding: 5px 10px 10px 10px;
    border-top-left-radius: 4px;
    border-top-right-radius: 4px;
    display: block;
    min-height: auto;
}
.note-editor.note-frame .note-statusbar {
    border-color: #e2e5ec;
    background-color: #f7f8fa;
}
.note-editor.note-airframe .note-statusbar .note-resizebar .note-icon-bar,
.note-editor.note-frame .note-statusbar .note-resizebar .note-icon-bar {
    border-color: #afafb9;
}
.note-toolbar .note-btn {
    border-color: #e2e5ec;
}
.note-popover
    .popover-content
    .note-color
    .note-dropdown-menu
    .note-palette
    .note-color-reset:hover,
.note-popover
    .popover-content
    .note-color
    .note-dropdown-menu
    .note-palette
    .note-color-select:hover,
.note-toolbar
    .note-color
    .note-dropdown-menu
    .note-palette
    .note-color-reset:hover,
.note-toolbar
    .note-color
    .note-dropdown-menu
    .note-palette
    .note-color-select:hover {
    background-color: var(--primary);
    color: var(--white);
}
.note-popover .popover-content .note-btn-group .note-table,
.note-toolbar .note-btn-group .note-table,
.note-editor .note-toolbar .dropdown-menu {
    min-width: 190px;
}
.note-popover .popover-content .note-color-all .note-dropdown-menu,
.note-toolbar .note-color-all .note-dropdown-menu {
    min-width: 340px;
}
.note-dropdown-menu .dropdown-item > * {
    padding: 0 !important;
}
.note-dropdown-menu .dropdown-item h1 {
    font-size: 2rem;
}
.note-dropdown-menu .dropdown-item h2 {
    font-size: 1.75rem;
}
.note-dropdown-menu .dropdown-item h3 {
    font-size: 1.5rem;
}
.note-dropdown-menu .dropdown-item h4 {
    font-size: 1.25rem;
}
.note-dropdown-menu .dropdown-item h5 {
    font-size: 1rem;
}
.note-dropdown-menu .dropdown-item h6 {
    font-size: 0.875rem;
}
.note-modal .note-group-select-from-files {
    display: none !important;
}
@media (max-width: 575px) {
    .note-video-clip {
        max-width: 100%;
        height: auto;
    }
}
.aiz-editor-data img {
    max-width: 100% !important;
    height: auto !important;
}

/*ecom pos ui*/
.aiz-pos-product-list {
    overflow-y: auto;
    max-height: calc(100vh - 220px);
    height: calc(100vh - 220px);
    overflow-x: hidden;
}
.aiz-pos-cart-list {
    overflow-y: auto;
    max-height: calc(100vh - 490px);
    height: calc(100vh - 490px);
    overflow-x: hidden;
}

/*Aiz Uploader*/

.uppy-Root *:focus {
    outline: none !important;
}
.uppy-size--md .uppy-DashboardItem-progressIndicator,
.uppy-DashboardContent-bar .uppy-DashboardContent-back {
    visibility: hidden;
    opacity: 0;
}
.uppy-Dashboard-inner {
    width: 100% !important;
    height: 100% !important;
}
.uppy-Root {
    height: 100% !important;
}
.uppy-DashboardContent-addMore svg {
    margin-bottom: 0;
}
.card-file {
    padding: 8px;
    position: relative;
    border-color: rgb(223, 224, 228);
    transition: all 0.2s ease-in-out;
    margin-bottom: 20px;
}

.card-file .card-body h6 {
    font-size: 0.8rem;
    margin-bottom: 0;
}

.card-file .card-body p {
    margin-bottom: 0;
    font-size: 9px;
    color: #8392a5;
}
.card-file .card-file-thumb {
    height: 120px;
    background-color: #f5f6fa;
    display: flex;
    align-items: center;
    justify-content: center;
}

.card-file .card-body {
    padding: 10px 0 0;
}

.card-file .card-file-thumb i {
    font-size: 50px;
    color: #b3becc;
}

.aiz-uploader-backdrop {
    position: fixed;
    top: 0;
    left: 0;
    z-index: 1040;
    width: 100vw;
    height: 100vh;
    background-color: rgba(0, 0, 0, 0.2);
}
[data-toggle="aizuploader"] {
    cursor: pointer;
}
.aiz-uploader-all {
    margin-left: -10px;
    margin-right: -10px;
    overflow-y: auto;
    height: calc(100vh - 303px);
}
.uppy-Dashboard-files {
    max-height: calc(100vh - 363px);
}
.aiz-file-box-wrap {
    padding: 0 10px;
    width: 50%;
    float: left;
}
.aiz-file-box-wrap[aria-hidden="true"] {
    display: none;
}
.aiz-file-box {
    position: relative;
}
.aiz-file-box:before {
    content: "";
    display: block;
    padding-top: 100%;
}
.aiz-file-box .dropdown-file {
    position: absolute;
    top: 6px;
    right: 9px;
    z-index: 1;
}
.aiz-file-box .dropdown-file > a {
    color: #5a5a5a;
    font-size: 22px;
    background: #f5f6fa;
    cursor: pointer;
}
.aiz-file-box .card-file {
    cursor: pointer;
    overflow: hidden;
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    opacity: 1;
}
.aiz-file-box .card-file .card-file-thumb {
    position: absolute;
    width: calc(100% - 16px);
    top: 8px;
    left: 8px;
    height: calc(100% - 55px);
}

.aiz-file-box .card-file .card-body {
    position: absolute;
    width: calc(100% - 16px);
    bottom: 5px;
    left: 8px;
}
[data-selected="true"] .aiz-uploader-select {
    border-color: #007bff;
    background: rgba(0, 123, 255, 0.05);
}
.modal-adaptive {
    height: calc(100vh - 60px);
    margin: 30px auto !important;
}

/*File preview + remove*/
.file-preview-item h6 {
    font-size: 13px;
    margin-bottom: 0;
}

.file-preview-item {
    padding: 8px;
    border: 1px solid #ebedf2;
    border-radius: 0.25rem;
}

.file-preview-item p {
    font-size: 10px;
    margin-bottom: 0;
    color: var(--secondary);
}
.file-preview-item .thumb {
    -ms-flex: 0 0 50px;
    flex: 0 0 50px;
    max-width: 50px;
    height: 45px;
    width: 50px;
    text-align: center;
    background: #f1f2f4;
    font-size: 20px;
    color: #92969b;
    border-radius: 0.25rem;
    overflow: hidden;
}
.file-preview-item .remove {
    -ms-flex: 0 0 52px;
    flex: 0 0 52px;
    max-width: 52px;
    width: 52px;
}
.file-preview-item .body {
    min-width: 0;
}

.file-preview.box a {
    color: inherit;
}
.file-preview.box:after {
    content: "";
    clear: both;
    display: table;
}
.file-preview.box .file-preview-item {
    width: 160px;
    float: left;
    margin-right: 0.5rem;
    padding: 0;
    display: block !important;
    position: relative;
}
.file-preview.box .thumb {
    width: 100%;
    max-width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 120px;
    border-radius: 0;
    border-top-left-radius: 0.25rem;
    border-top-right-radius: 0.25rem;
}
.file-preview.box.sm .file-preview-item {
    width: 100px;
}
.file-preview.box.sm .thumb {
    height: 52px;
}

.file-preview.box .body {
    padding: 0;
    padding: 8px 8px 2px;
}
.file-preview.box .remove {
    position: absolute;
    top: -6px;
    right: -6px;
    width: auto;
    max-width: 100%;
}
.file-preview.box .remove .btn {
    padding: 0;
    width: 26px;
    height: 26px;
    border-radius: 50%;
    background: #eaeaea;
}

@media (min-width: 576px) {
    /*sm*/
    .modal-adaptive {
        max-width: 540px;
    }
    .aiz-file-box-wrap {
        width: 33.3333%;
    }
}
@media (min-width: 768px) {
    /*md*/
    .modal-adaptive {
        max-width: 720px;
    }
    .aiz-file-box-wrap {
        width: 25%;
    }
    .modal-md {
        max-width: 600px;
    }
}
@media (min-width: 992px) {
    /*lg*/
    .modal-adaptive {
        max-width: 960px;
    }
    .aiz-file-box-wrap {
        width: 20%;
    }
}
@media (min-width: 1200px) {
    /*xl*/
    .modal-adaptive {
        max-width: 1140px;
    }
    .aiz-file-box-wrap {
        width: 16.66666%;
    }
}
@media (min-width: 1500px) {
    /*xxl*/
    .modal-adaptive {
        max-width: 1400px;
    }
}
@media (max-width: 767px) {
    .aiz-uploader-search i {
        font-size: 23px;
        cursor: pointer;
        padding: 4px;
        margin-right: 5px;
        position: relative;
        z-index: 2;
        top: 3px;
    }

    .aiz-uploader-search input {
        position: absolute;
        z-index: 1;
        top: 0;
        right: 5px;
        left: 5px;
        width: calc(100% - 10px);
        height: 100%;
        visibility: hidden;
        opacity: 0;
        transition: all 0.3s;
        -webkit-transition: all 0.3s;
    }

    .aiz-uploader-search.open input {
        visibility: visible;
        opacity: 1;
    }
}

.search-icon {
    position: relative;
    display: inline-block;
    width: 32px;
    height: 32px;
    overflow: hidden;
    white-space: nowrap;
    color: transparent;
    z-index: 3;
}
.search-icon:hover {
    color: transparent;
}
.search-icon::before,
.search-icon::after {
    content: "";
    position: absolute;
    -webkit-transition: opacity 0.3s;
    -moz-transition: opacity 0.3s;
    transition: opacity 0.3s;
    -webkit-transform: translateZ(0);
    -moz-transform: translateZ(0);
    -ms-transform: translateZ(0);
    -o-transform: translateZ(0);
    transform: translateZ(0);
    -webkit-backface-visibility: hidden;
    backface-visibility: hidden;
}
.search-icon::before {
    top: 7px;
    left: 7px;
    width: 14px;
    height: 14px;
    border-radius: 50%;
    border: 2px solid #686f7a;
}
.search-icon::after {
    height: 2px;
    width: 8px;
    background: #686f7a;
    bottom: 10px;
    right: 7px;
    -webkit-transform: rotate(45deg);
    -moz-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    -o-transform: rotate(45deg);
    transform: rotate(45deg);
}
.search-icon span {
    position: absolute;
    height: 100%;
    width: 100%;
    top: 0;
    left: 0;
}
.search-icon span::before,
.search-icon span::after {
    content: "";
    position: absolute;
    display: inline-block;
    height: 2px;
    width: 18px;
    top: 50%;
    margin-top: -1px;
    left: 50%;
    margin-left: -8px;
    background: #686f7a;
    opacity: 0;
    -webkit-transform: translateZ(0);
    -moz-transform: translateZ(0);
    -ms-transform: translateZ(0);
    -o-transform: translateZ(0);
    transform: translateZ(0);
    -webkit-backface-visibility: hidden;
    backface-visibility: hidden;
    -webkit-transition: opacity 0.3s, -webkit-transform 0.3s;
    -moz-transition: opacity 0.3s, -moz-transform 0.3s;
    transition: opacity 0.3s, transform 0.3s;
}
.search-icon span::before {
    -webkit-transform: rotate(45deg);
    -moz-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    -o-transform: rotate(45deg);
    transform: rotate(45deg);
}
.search-icon span::after {
    -webkit-transform: rotate(-45deg);
    -moz-transform: rotate(-45deg);
    -ms-transform: rotate(-45deg);
    -o-transform: rotate(-45deg);
    transform: rotate(-45deg);
}
.open .search-icon::before,
.open .search-icon::after {
    opacity: 0;
}
.open .search-icon span::before,
.open .search-icon span::after {
    opacity: 1;
}
.open .search-icon span::before {
    -webkit-transform: rotate(135deg);
    -moz-transform: rotate(135deg);
    -ms-transform: rotate(135deg);
    -o-transform: rotate(135deg);
    transform: rotate(135deg);
}
.open .search-icon span::after {
    -webkit-transform: rotate(45deg);
    -moz-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    -o-transform: rotate(45deg);
    transform: rotate(45deg);
}
.mobile-search.is-visible {
    opacity: 1;
    visibility: visible;
    -webkit-transition: opacity 0.3s 0s, visibility 0s 0s;
    -moz-transition: opacity 0.3s 0s, visibility 0s 0s;
    transition: opacity 0.3s 0s, visibility 0s 0s;
}

/*date range*/
.daterangepicker {
    border-color: #e2e5ec;
    -webkit-box-shadow: 0 0 50px 0 rgba(82, 63, 105, 0.15);
    box-shadow: 0 0 50px 0 rgba(82, 63, 105, 0.15);
    font-family: inherit;
}
.daterangepicker:before {
    border-bottom-color: #e2e5ec;
}
.daterangepicker th {
    font-weight: 600;
}
.daterangepicker .calendar-table .next span,
.daterangepicker .calendar-table .prev span {
    border-width: 0 1px 1px 0;
    border-color: var(--dark);
}
.daterangepicker .calendar-table .next span {
    margin-left: -5px;
}
.daterangepicker td.available:hover,
.daterangepicker th.available:hover,
.daterangepicker .ranges li:hover {
    background-color: var(--light);
}
.daterangepicker .calendar-table td,
.daterangepicker .calendar-table th {
    min-width: 30px;
    width: 30px;
    height: 30px;
    -webkit-transition: all 0.3s ease;
    transition: all 0.3s ease;
}
.daterangepicker td.in-range {
    background-color: var(--soft-primary);
}
.daterangepicker td.active,
.daterangepicker td.active:hover,
.daterangepicker .ranges li.active {
    background-color: var(--primary);
}
.daterangepicker .drp-buttons .btn {
    font-weight: 500;
}
.daterangepicker select.monthselect,
.daterangepicker select.yearselect {
    border-color: var(--light);
    padding: 3px;
}
.daterangepicker .calendar-time {
    padding-right: 8px;
    display: -ms-flexbox;
    display: flex;
}

.daterangepicker select.ampmselect,
.daterangepicker select.hourselect,
.daterangepicker select.minuteselect,
.daterangepicker select.secondselect {
    background-color: transparent;
    border-color: var(--light);
}

/*time picker*/
.bootstrap-timepicker-widget.timepicker-orient-top {
    margin-top: 6px;
}
.bootstrap-timepicker-widget.timepicker-orient-bottom {
    margin-top: -2px;
}
.bootstrap-timepicker-widget.timepicker-orient-top:before {
    border-bottom-color: #e2e5ec;
}
.bootstrap-timepicker-widget.timepicker-orient-bottom:before {
    border-top-color: #e2e5ec;
}

.bootstrap-timepicker-widget table td a:hover {
    background-color: var(--light);
    border-color: var(--light);
}
.bootstrap-timepicker-widget table td input {
    border: 0;
}

/*button element*/
.btn.focus,
.btn:focus:not(.btn-shadow) {
    box-shadow: none !important;
    outline: none;
}
.btn {
    padding: 0.6rem 1.2rem;
    font-size: 0.875rem;
    color: #2a3242;
    font-weight: inherit;
}
.btn-shadow:hover {
    -webkit-transform: translateY(-1px);
    transform: translateY(-1px);
    box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.05), 0px 8px 8px rgba(0, 0, 0, 0.05),
        0px 16px 16px rgba(0, 0, 0, 0.05), 0px 32px 32px rgba(0, 0, 0, 0.05);
}
.btn-circle {
    border-radius: 50em;
}
.btn-icon {
    font-size: 1rem;
    line-height: 1.4;
    padding: 0.6rem;
    width: calc(2.5125rem + 2px);
    height: calc(2.5125rem + 2px);
}
.btn-xs {
    padding: 0.25rem 0.75rem;
    font-size: 0.75rem;
}
.btn-sm {
    padding: 0.416rem 1rem;
    font-size: 0.8125rem;
}
.btn-sm.btn-icon {
    padding: 0.416rem;
    width: calc(2.02rem + 2px);
    height: calc(2.02rem + 2px);
}
.btn-lg {
    padding: 0.75rem 1.5rem;
    font-size: 1rem;
}
.btn-lg.btn-icon {
    padding: 0.75rem;
    font-size: 1.2rem;
    width: calc(3rem + 2px);
    height: calc(3rem + 2px);
}
.btn-primary:hover,
.btn-primary:focus,
.btn-primary:active,
.btn-primary.disabled,
.btn-primary:disabled,
.btn-primary:not(:disabled):not(.disabled).active,
.btn-primary:not(:disabled):not(.disabled):active,
.show > .btn-primary.dropdown-toggle,
.btn-outline-primary:not(:disabled):not(.disabled).active,
.btn-outline-primary:not(:disabled):not(.disabled):active,
.show > .btn-outline-primary.dropdown-toggle {
    background-color: var(--hov-primary);
    border-color: var(--hov-primary);
}
.btn-primary,
.btn-soft-primary:hover,
.btn-outline-primary:hover {
    background-color: var(--primary);
    border-color: var(--primary);
    color: var(--white);
}
.btn-secondary,
.btn-soft-secondary:hover,
.btn-outline-secondary:hover {
    background-color: var(--secondary);
    border-color: var(--secondary);
    color: var(--white);
}
.btn-success,
.btn-soft-success:hover,
.btn-outline-success:hover {
    background-color: var(--success);
    border-color: var(--success);
    color: var(--white);
}
.btn-danger,
.btn-soft-danger:hover,
.btn-outline-danger:hover {
    background-color: var(--danger);
    border-color: var(--danger);
    color: var(--white);
}
.btn-warning,
.btn-soft-warning:hover,
.btn-outline-warning:hover {
    background-color: var(--warning);
    border-color: var(--warning);
}
.btn-info,
.btn-soft-info:hover,
.btn-outline-info:hover {
    background-color: var(--info);
    border-color: var(--info);
    color: var(--white);
}
.btn-light,
.btn-outline-light:hover {
    background-color: var(--light);
    border-color: var(--light);
}
.btn-dark,
.btn-soft-dark:hover,
.btn-outline-dark:hover {
    background-color: var(--dark);
    border-color: var(--dark);
    color: var(--white);
}
.btn-link {
    color: var(--primary);
}
.btn-link:hover {
    color: var(--hov-primary);
}
.btn-clean:hover {
    background-color: var(--light);
    border-color: var(--light);
}

/*soft buttons*/
.btn-soft-primary {
    background-color: var(--soft-primary);
    color: var(--primary);
}
.btn-soft-secondary {
    background-color: var(--soft-secondary);
    color: var(--dark);
}
.btn-soft-success {
    background-color: var(--soft-success);
    color: var(--success);
}
.btn-soft-danger {
    background-color: var(--soft-danger);
    color: var(--danger);
}
.btn-soft-warning {
    background-color: var(--soft-warning);
    color: var(--warning);
}
.btn-soft-info {
    background-color: var(--soft-info);
    color: var(--info);
}
.btn-soft-dark {
    background-color: var(--soft-dark);
    color: var(--dark);
}

/*outline buttons*/
.btn-outline-primary {
    border-color: var(--primary);
    color: var(--primary);
}
.btn-outline-secondary {
    border-color: var(--secondary);
    color: var(--dark);
}
.btn-outline-success {
    border-color: var(--success);
    color: var(--success);
}
.btn-outline-danger {
    border-color: var(--danger);
    color: var(--danger);
}
.btn-outline-warning {
    border-color: var(--warning);
    color: var(--warning);
}
.btn-outline-info {
    border-color: var(--info);
    color: var(--info);
}
.btn-outline-light {
    border-color: var(--light);
    color: var(--dark);
}
.btn-outline-dark {
    border-color: var(--dark);
    color: var(--dark);
}

/*footable*/
.aiz-table {
    opacity: 0;
    height: 0;
}
div.footable-loader {
    height: 220px;
}
.aiz-table.footable,
.aiz-table.footable-details {
    opacity: 1;
    height: auto;
}
div.footable-loader > span.fooicon {
    border: 4px solid #1e1e2d;
    border-right-color: transparent;
    border-radius: 50%;
}
div.footable-loader > span.fooicon:before,
div.footable-loader > span.fooicon:after {
    content: none;
}
.aiz-table thead th {
    border-top: 0;
    border-bottom: 1px solid #eceff7;
}
.aiz-table th {
    font-weight: 600;
}
.aiz-table td,
.aiz-table th {
    border-top: 1px solid #eceff7;
}
.aiz-table td,
.aiz-table th {
    padding: 1rem 0.75rem;
}
.aiz-table.table-bordered td,
.aiz-table.table-bordered th {
    border: 1px solid #eceff7;
}
.aiz-table .footable-detail-row > td {
    padding: 0;
}
.aiz-table .footable-toggle {
    height: 16px;
    width: 16px;
    line-height: 16px;
    font-size: 16px;
    border-radius: 4px;
    text-align: center;
    opacity: 1;
    color: var(--primary);
    background-color: var(--soft-primary);
    margin-right: 10px;
}
.aiz-table .footable-toggle.fooicon-minus {
    color: var(--white);
    background-color: var(--primary);
}
.aiz-table.footable > tbody > tr.footable-empty > td {
    font-size: 20px;
    position: relative;
    padding-top: 100px;
}

.aiz-table.footable > tbody > tr.footable-empty > td:before {
    content: "\f119";
    font-family: "Line Awesome Free";
    font-weight: 900;
    position: absolute;
    left: 50%;
    top: 20px;
    font-size: 60px;
    opacity: 0.5;
    transform: translate(-50%, 0px);
}
.aiz-table .footable-pagination-wrapper {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-pack: space-between;
    justify-content: space-between;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    margin-top: 1rem;
}

.aiz-table .footable-page-link,
.aiz-table .footable-page.disabled .footable-page-link {
    min-width: 36px;
    min-height: 36px;
    line-height: 36px;
    text-align: center;
    padding: 0;
    border: 0;
    font-size: 0.875rem;
    border-radius: 50% !important;
    color: var(--dark);
    display: inline-block;
}

.aiz-table .footable-page {
    margin: 0 2px;
}

.aiz-table .active .footable-page-link,
.aiz-table .footable-page-link:hover {
    background-color: var(--primary);
    color: #fff;
}

/*notify*/
.aiz-notify {
    min-width: 350px;
    max-width: 350px;
    padding-right: 50px;
    border-radius: 0.25rem;
    overflow: hidden;
    border: 0;
    color: var(--white);
    box-shadow: 0 5px 20px 0 rgba(38, 45, 58, 0.2);
    -webkit-box-shadow: 0 5px 20px 0 rgba(38, 45, 58, 0.2);
    padding: 1.25rem 1.25rem;
    font-size: 0.875rem;
    z-index: 1060 !important;
}
[dir="rtl"] .aiz-notify {
    text-align: right !important;
}
.aiz-notify .close {
    top: 50% !important;
    height: 20px;
    width: 20px;
    margin-top: -10px;
    font-size: 20px;
    line-height: 20px;
    color: var(--white);
    opacity: 0.7;
    right: 15px !important;
    text-shadow: none;
}
[dir="rtl"] .aiz-notify .close {
    right: auto !important;
    left: 15px !important;
}
.aiz-notify .close:before {
    content: "";
    position: absolute;
    border-radius: 50%;
    background-color: #fff;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    -webkit-transition: all 0.3s ease;
    transition: all 0.3s ease;
    z-index: -1;
    opacity: 0;
}
.aiz-notify .close:hover {
    color: var(--dark);
    opacity: 1;
}
.aiz-notify .close:hover:before {
    opacity: 1;
    background-color: #fff;
    width: 170%;
    height: 170%;
    top: -35%;
    left: -35%;
    -webkit-transition: all 0.3s ease;
    transition: all 0.3s ease;
}
.aiz-notify .progress {
    height: 3px;
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    width: 100%;
    border-radius: 0;
    background-color: transparent;
}
.aiz-notify .progress-bar {
    background-color: var(--white);
}
.aiz-notify.alert-success {
    background-color: var(--success);
}
.aiz-notify.alert-danger {
    background-color: var(--danger);
}
.aiz-notify.alert-primary {
    background-color: var(--primary);
}
.aiz-notify.alert-warning {
    background-color: var(--warning);
}
.aiz-notify.alert-info {
    background-color: var(--info);
}
.aiz-notify.alert-dark {
    background-color: var(--dark);
}
.aiz-notify.alert-secondary {
    background-color: var(--secondary);
}
.aiz-notify.alert-light,
.aiz-notify.alert-light .close {
    background-color: var(--light);
    color: var(--dark);
}
.aiz-notify.alert-light .progress-bar {
    background-color: var(--primary);
}
@media (max-width: 575px) {
    .aiz-notify {
        width: calc(100% - 40px);
        min-width: auto;
    }
}

/*pagination*/
.aiz-pagination-center .pagination {
    -ms-flex-pack: center;
    justify-content: center;
}
.aiz-pagination-right .pagination {
    -ms-flex-pack: end;
    justify-content: flex-end;
}
.aiz-pagination .pagination {
    margin-bottom: 0;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
}

.pagination .page-link,
.page-item.disabled .page-link {
    min-width: 36px;
    min-height: 36px;
    line-height: 36px;
    text-align: center;
    padding: 0;
    border: 0;
    font-size: 0.875rem;
    border-radius: 50% !important;
    color: var(--dark);
}

.pagination .page-item {
    margin: 0 2px;
}

.pagination .active .page-link {
    background-color: var(--primary);
}
.pagination .page-link:hover {
    background-color: var(--primary);
    color: #fff;
}

/*modal*/
.modal.website-popup {
    display: block;
}
.modal-open .modal {
    overflow-x: hidden;
    overflow-y: hidden;
}
.modal-backdrop {
    background-color: #11151d;
}
.modal-content {
    border: 1px solid rgba(20, 20, 35, 0.2);
}
.modal-content .modal-header {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: justify;
    -ms-flex-pack: justify;
    justify-content: space-between;
    position: relative;
    padding: 12px 25px;
    border-bottom: 1px solid #ebedf2;
    min-height: 60px;
    background-color: transparent;
}
.modal-header .close {
    font-size: 0;
}
.modal-header .close:before {
    font-family: "Line Awesome Free";
    font-weight: 900;
    content: "\f00d";
    font-size: 20px;
}
.modal-content .modal-body {
    padding: 20px 25px;
    overflow-y: auto;
    max-height: 70vh;
}
@media (min-width: 768px) {
    .modal-content .modal-body {
        max-height: 80vh;
    }
}
.modal-content .modal-footer {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: end;
    -ms-flex-pack: end;
    justify-content: flex-end;
    position: relative;
    padding: 10px 25px;
    border-top: 1px solid #ebedf2;
    min-height: 60px;
    background-color: transparent;
}
.modal.fade .modal-dialog.modal-dialog-zoom {
    -webkit-transform: translate(0, 0) scale(0.8);
    transform: translate(0, 0) scale(0.8);
    transition: -webkit-transform 0.3s ease-out;
    transition: transform 0.3s ease-out;
    transition: transform 0.3s ease-out, -webkit-transform 0.3s ease-out;
}
.modal.show .modal-dialog.modal-dialog-zoom {
    -webkit-transform: translate(0, 0) scale(1);
    transform: translate(0, 0) scale(1);
}
.modal.modal-static .modal-dialog.modal-dialog-zoom {
    -webkit-transform: scale(1.02);
    transform: scale(1.02);
}

.modal.fade .modal-dialog-right {
    position: absolute;
    right: 0;
    top: 0;
    bottom: 0;
    height: 100%;
    margin: 0;
    width: 400px;
    max-width: 80vw;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -ms-flex-flow: column nowrap;
    flex-flow: column nowrap;
    background-color: #fff;
    -ms-flex-line-pack: center;
    align-content: center;
    -webkit-transform: translate(50px, 0);
    transform: translate(50px, 0);
}
.modal.show .modal-dialog-right {
    -webkit-transform: translate(0px, 0);
    transform: translate(0px, 0);
}
.modal-dialog-right .modal-content {
    height: 100%;
    border: 0;
    border-radius: 0;
}
.modal-dialog-right .modal-body {
    max-height: 86vh;
}

/*badges*/
.badge {
    display: -webkit-inline-box;
    display: -ms-inline-flexbox;
    display: inline-flex;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    height: 18px;
    width: 18px;
    font-size: 0.65rem;
    font-weight: 500;
    line-height: unset;
}
.badge-circle {
    border-radius: 50%;
}
.badge-sm {
    height: 14px;
    width: 14px;
    font-size: 0.55rem;
}
.badge-md {
    height: 24px;
    width: 24px;
    font-size: 0.75rem;
}
.badge-lg {
    height: 28px;
    width: 28px;
    font-size: 0.85rem;
}
.badge.badge-dot {
    display: -webkit-inline-box;
    display: -ms-inline-flexbox;
    display: inline-flex;
    height: 4px;
    width: 4px;
    padding: 0;
}
.badge-dot.badge-md {
    height: 8px;
    width: 8px;
}
.badge-dot.badge-lg {
    height: 12px;
    width: 12px;
}
.badge-inline {
    width: auto;
}
.badge-status {
    position: absolute;
    top: calc(15% - 4px);
    right: calc(15% - 4px);
    font-size: 1px;
}
.badge-status:before {
    position: absolute;
    width: calc(100% + 6px);
    height: calc(100% + 6px);
    border: 3px solid #fff;
    top: -3px;
    left: -3px;
    content: "";
    border-radius: 50%;
}
.badge-md.badge-status {
    top: calc(15% - 5px);
    right: calc(15% - 5px);
}
.badge-lg.badge-status {
    top: calc(15% - 6px);
    right: calc(15% - 6px);
}
.badge-primary {
    background-color: var(--primary);
}
.badge-secondary {
    background-color: var(--secondary);
}
.badge-success {
    background-color: var(--success);
}
.badge-danger {
    background-color: var(--danger);
}
.badge-warning {
    background-color: var(--warning);
}
.badge-info {
    background-color: var(--info);
}
.badge-light {
    background-color: var(--light);
}
.badge-dark {
    background-color: var(--dark);
}
.badge-soft-primary {
    background-color: var(--soft-primary);
    color: var(--primary);
}
.badge-soft-secondary {
    background-color: var(--soft-secondary);
    color: var(--secondary);
}
.badge-soft-success {
    background-color: var(--soft-success);
    color: var(--success);
}
.badge-soft-danger {
    background-color: var(--soft-danger);
    color: var(--danger);
}
.badge-soft-warning {
    background-color: var(--soft-warning);
    color: var(--warning);
}
.badge-soft-info {
    background-color: var(--soft-info);
    color: var(--info);
}
.badge-soft-dark {
    background-color: var(--soft-dark);
    color: var(--dark);
}

.list-group-item {
    border-color: #ebedf2;
}
.list-group-raw .list-group-item {
    border: 0;
}

/*slick carousel*/
.aiz-carousel > * {
    display: none;
}
.slick-initialized.aiz-carousel > *,
.aiz-carousel > *:first-child {
    display: block;
}
.aiz-carousel.gutters-5 {
    width: calc(100% + 10px);
}
.aiz-carousel.gutters-5 .carousel-box {
    padding-left: 5px;
    padding-right: 5px;
}
.aiz-carousel.gutters-10 {
    width: calc(100% + 20px);
}
.aiz-carousel.gutters-10 .carousel-box {
    padding-left: 10px;
    padding-right: 10px;
}
.aiz-carousel.gutters-15 {
    width: calc(100% + 30px);
}
.aiz-carousel.gutters-15 .carousel-box {
    padding-left: 15px;
    padding-right: 15px;
}
.aiz-carousel-full * {
    height: 100%;
}
.aiz-carousel .slick-arrow {
    position: absolute;
    top: 50%;
    z-index: 2;
    transform: translateY(-50%);
    -webkit-transform: translateY(-50%);
    width: 40px;
    height: 40px;
    background: #fff;
    border-radius: 50em;
    border: 0;
    box-shadow: 0 0 1px 1px rgba(20, 23, 28, 0.1),
        0 3px 1px 0 rgba(20, 23, 28, 0.1);
    font-size: 15px;
    line-height: 40px;
    padding: 0;
    text-align: center;
}
.aiz-carousel .slick-prev:hover,
.aiz-carousel .slick-next:hover {
    box-shadow: 0 2px 8px 2px rgba(20, 23, 28, 0.15) !important;
}
.aiz-carousel .slick-prev {
    left: 10px;
}
.aiz-carousel.hide-disabled .slick-disabled {
    display: none !important;
}

.aiz-carousel .slick-next {
    right: 10px;
}
.aiz-carousel .slick-dots {
    list-style: none;
    display: flex;
    justify-content: center;
    margin-top: 10px;
    margin-bottom: 0;
    padding-left: 0;
}
.aiz-carousel .slick-dots button {
    height: 11px;
    width: 11px;
    padding: 0px;
    color: transparent;
    border: 0;
    background: #ddd;
    border-radius: 50%;
    margin: 0 3px;
}
.aiz-carousel .slick-dots .slick-active button {
    background: var(--primary);
}
.aiz-carousel.dots-inside-bottom .slick-dots {
    position: absolute;
    bottom: 10px;
    left: 50%;
    transform: translateX(-50%);
    -webkit-transform: translateX(-50%);
}
.half-outside-arrow .slick-prev {
    left: -10px;
}
.half-outside-arrow .slick-next {
    right: -10px;
}
.slick-vertical .slick-arrow {
    top: auto;
    left: 50%;
    transform: translateX(-50%) rotate(90deg);
    -webkit-transform: translateX(-50%) rotate(90deg);
}
.slick-vertical .slick-prev {
    top: -10px;
}
.slick-vertical .slick-next {
    bottom: -10px;
}
.slick-vertical .slick-current .carousel-box {
    border-color: var(--primary) !important;
    border-width: 2px !important;
}

/*range slider - no ui slider*/
.aiz-range-slider .noUi-connect {
    background: var(--primary);
}
.aiz-range-slider .noUi-target {
    border-color: var(--soft-secondary);
}

/*iti mobile number select*/
.iti {
    display: block;
    width: 100%;
}
.iti--allow-dropdown input {
    padding-left: 95px !important;
}
.iti--separate-dial-code .iti__selected-flag,
.iti--allow-dropdown .iti__flag-container:hover .iti__selected-flag {
    background: #fff;
    margin-left: 2px;
    border-right: 1px solid #e2e5ec;
}
/*avatar*/

.avatar {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    display: -webkit-inline-box;
    display: -ms-inline-flexbox;
    display: inline-flex;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    font-weight: 600;
    font-size: 1.7em;
    position: relative;
}
.avatar img {
    object-fit: cover;
    max-width: 100%;
    width: 100%;
    border-radius: 50%;
    height: 100%;
}
.avatar-xxs {
    width: 20px;
    height: 20px;
    font-size: 0.7em;
}
.avatar-xs {
    width: 32px;
    height: 32px;
    font-size: 0.8em;
}
.avatar-sm {
    width: 44px;
    height: 44px;
    font-size: 1.1em;
}
.avatar-md {
    width: 64px;
    height: 64px;
    font-size: 1.4em;
}
.avatar-lg {
    width: 100px;
    height: 100px;
    font-size: 2em;
}
.avatar-xl {
    width: 120px;
    height: 120px;
    font-size: 2.3em;
}
.avatar-xxl {
    width: 150px;
    height: 150px;
    font-size: 2.6em;
}
.avatar-rounded,
.avatar-rounded img {
    border-radius: 0.3em;
}
.avatar-square,
.avatar-square img {
    border-radius: 0;
}

/*rating*/
.rating i {
    color: #c3c3c5;
    font-size: 1rem;
    letter-spacing: -1px;
    -webkit-transition: all 0.3s;
    transition: all 0.3s;
}
.rating i.hover,
.rating i.active,
.text-rating {
    color: #ffa707;
}
.bg-rating {
    background-color: #ffa707;
}
.rating i.half {
    position: relative;
}
.rating i.half:after {
    position: absolute;
    content: "\f089";
    top: 0;
    left: 0;
    font-size: inherit;
    color: #ffa707;
    z-index: 1;
}
[dir="rtl"] .rating i.half {
    -webkit-transform: scale(-1, 1);
    transform: scale(-1, 1);
}
.rating-sm i {
    font-size: 0.8125rem;
}
.rating-lg i {
    font-size: 1.125rem;
}
.rating-input label {
    cursor: pointer;
}
.rating-input input {
    display: none;
}

/*chat*/
.aiz-chat {
    overflow: hidden;
    -webkit-box-shadow: 0 0 13px 0 rgba(82, 63, 105, 0.05);
    box-shadow: 0 0 13px 0 rgba(82, 63, 105, 0.05);
    background: #fff;
    border-radius: 4px;
    border: 1px solid #ebedf2;
}
.aiz-chat .chat-user-list {
    height: calc(80vh - 44px);
    max-height: calc(80vh - 44px);
    overflow-y: auto;
}
.chat-user-list-wrap .overlay {
    -webkit-transition: all 0.3s ease;
    transition: all 0.3s ease;
    opacity: 0;
    visibility: hidden;
}

.aiz-chat .chat-list-wrap {
    height: calc(80vh - 160px);
    max-height: calc(80vh - 160px);
    overflow-y: auto;
}
.aiz-chat .chat-list {
    min-height: 100%;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-direction: column;
    flex-direction: column;
    -ms-flex-pack: end;
    justify-content: flex-end;
}

.chat-box-wrap {
    position: relative;
    padding: 80px 0;
}

.chat-coversation {
    max-width: 450px;
    margin: 10px 0;
}
.chat-coversation .avatar {
    margin-right: 15px;
    margin-bottom: 12px;
}
.chat-coversation .media {
    -ms-flex-align: end;
    align-items: flex-end;
}
.chat-coversation .media-body .text {
    background: var(--light);
    padding: 10px 20px;
    line-height: 1.7;
    border-radius: 4px;
}
.chat-coversation .media-body .time {
    font-size: 10px;
    opacity: 0.5;
    display: block;
}

.chat-coversation.right {
    margin-left: auto;
}
.chat-coversation.right .avatar {
    margin-right: 0px;
    margin-left: 15px;
}
.chat-coversation.right .time {
    text-align: right;
}
.chat-coversation.right .media-body .text {
    background: var(--primary);
    color: #fff;
}

.chat-footer .input-group {
    background: var(--light);
    border: 1px solid #e2e5ec;
    border-radius: 50em;
}

.chat-footer .form-control {
    background: transparent;
    border-color: transparent;
}

.chat-footer .input-group > .input-group-append > .btn {
    border-radius: 50em;
}

.chat-header .active .la-info-circle:before {
    content: "\f00d";
}
.chat-info-wrap {
    -webkit-transition: all 0.3s ease;
    transition: all 0.3s ease;
    position: absolute;
    width: 100%;
    height: calc(80vh - 154px);
    top: 77px;
    right: 0;
    z-index: 2;
    opacity: 0;
    visibility: hidden;
}
.chat-info-wrap .overlay {
    -webkit-transition: all 0.3s ease;
    transition: all 0.3s ease;
    opacity: 0;
    visibility: hidden;
}
.chat-info-wrap .chat-info {
    -webkit-transition: all 0.3s ease;
    transition: all 0.3s ease;
    -webkit-transform: translateX(100%);
    transform: translateX(100%);
    position: absolute;
    height: 100%;
    width: 400px;
    max-width: 100%;
    right: 0;
    top: 0;
    bottom: 0;
    background: #fff;
    opacity: 0;
    visibility: hidden;
    overflow-y: auto;
}
.chat-info-wrap.active,
.chat-info-wrap.active .overlay,
.chat-info-wrap.active .chat-info {
    opacity: 1;
    visibility: visible;
}
.chat-info-wrap.active .chat-info {
    -webkit-transform: translateX(0%);
    transform: translateX(0%);
}
@media (max-width: 991px) {
    .chat-user-list-wrap {
        -webkit-transition: all 0.3s ease;
        transition: all 0.3s ease;
        position: fixed;
        width: 100%;
        height: 100%;
        top: 0;
        right: 0;
        z-index: 9;
        opacity: 0;
        visibility: hidden;
    }
    .chat-user-list-wrap .chat-user-list-header {
        -webkit-transition: all 0.3s ease;
        transition: all 0.3s ease;
        -webkit-transform: translateX(100%);
        transform: translateX(100%);
        position: absolute;
        width: 340px;
        max-width: 100%;
        right: 0;
        top: 0;
        background: #fff;
        opacity: 0;
        visibility: hidden;
        z-index: 1;
    }
    .chat-user-list-wrap .chat-user-list {
        -webkit-transition: all 0.3s ease;
        transition: all 0.3s ease;
        -webkit-transform: translateX(100%);
        transform: translateX(100%);
        position: absolute;
        height: calc(100% - 44px);
        max-height: none;
        width: 340px;
        max-width: 100%;
        right: 0;
        top: 44px;
        bottom: 0;
        background: #fff;
        opacity: 0;
        visibility: hidden;
        overflow-y: auto;
        z-index: 1;
    }
    .chat-user-list-wrap.active,
    .chat-user-list-wrap.active .overlay,
    .chat-user-list-wrap.active .chat-user-list-header,
    .chat-user-list-wrap.active .chat-user-list {
        opacity: 1;
        visibility: visible;
    }
    .chat-user-list-wrap.active .chat-user-list-header,
    .chat-user-list-wrap.active .chat-user-list {
        -webkit-transform: translateX(0%);
        transform: translateX(0%);
    }
}

/*social icon colored*/
ul.social a {
    display: inline-block;
    width: 36px;
    height: 36px;
    border-radius: 50em;
    line-height: 39px;
    text-align: center;
    font-size: 18px;
}
ul.social a:hover {
    -webkit-transform: translateY(-3px);
    transform: translateY(-3px);
}
ul.social i {
    color: #171727;
}

ul.social.colored i {
    color: #fff;
}
ul.social.colored [class*="facebook"] {
    background-color: #3b5998;
}
ul.social.colored [class*="twitter"] {
    background-color: #1da1f2;
}
ul.social.colored [class*="google"] {
    background-color: #e62833;
}
ul.social.colored [class*="youtube"] {
    background-color: #ff0000;
}
ul.social.colored [class*="instagram"] {
    background-color: #bd32a2;
}
ul.social.colored [class*="tripadvisor"] {
    background-color: #32da9d;
}
ul.social.colored [class*="linkedin"] {
    background-color: #0070ac;
}

.aiz-cookie-alert {
    position: fixed;
    bottom: 20px;
    left: 20px;
    right: 20px;
    max-width: 300px;
    z-index: 1070;
    display: none;
}
.aiz-cookie-alert.show {
    display: block;
}
/*messnger icon mobile*/
.fb_dialog_mobile iframe {
    bottom: 70px !important;
}

/*pages*/

.aiz-auth-form {
    max-width: 480px;
}

/*front pages*/

/*user panel*/
.aiz-user-sidenav-wrap {
    -ms-flex: 0 0 265px;
    flex: 0 0 265px;
    max-width: 265px;
    -webkit-box-shadow: 0 0 13px 0 rgba(82, 63, 105, 0.05);
    box-shadow: 0 0 13px 0 rgba(82, 63, 105, 0.05);
    background: #fff;
    border-radius: 4px;
    /*max-height: 100vh;
    overflow-y: auto;*/
    border: 1px solid #ebedf2;
}

.aiz-user-panel {
    -ms-flex-positive: 1;
    flex-grow: 1;
    padding-left: 30px;
}
[dir="rtl"] .aiz-user-panel {
    padding-right: 30px;
    padding-left: 0;
}
.aiz-user-sidenav .aiz-side-nav-list .aiz-side-nav-link {
    color: #63666b;
    font-weight: 500;
    font-size: 0.8125rem;
    border-left: 3px solid transparent;
}

.aiz-user-sidenav .aiz-side-nav-link.level-2-active,
.aiz-user-sidenav .aiz-side-nav-link.level-3-active {
    background-color: transparent;
    color: var(--primary);
}
.aiz-user-sidenav .level-2-active .aiz-side-nav-icon,
.aiz-user-sidenav .level-3-active .aiz-side-nav-icon {
    color: var(--primary);
}
.aiz-user-sidenav .aiz-side-nav-link.active,
.aiz-user-sidenav .aiz-side-nav-link:hover {
    background-color: var(--soft-primary);
    border-left-color: var(--primary);
}
.aiz-user-sidenav .level-2 .aiz-side-nav-link:hover:after,
.aiz-user-sidenav .level-2 .aiz-side-nav-link.active:after {
    background: var(--primary);
    border-color: var(--primary);
}
.aiz-user-sidenav .active .aiz-side-nav-icon {
    color: var(--primary);
}

@media (max-width: 1199px) {
    .aiz-user-sidenav-wrap {
        display: none;
    }
    .aiz-user-panel {
        padding-left: 0px;
    }
    [dir="rtl"] .aiz-user-panel {
        padding-right: 0px;
    }
}
.aiz-mobile-side-nav .aiz-user-sidenav-wrap {
    display: block;
    max-width: initial;
    border: 0;
}
.sidebar-cart .cart-toggler {
    position: fixed;
    right: 0;
    top: 50%;
    transform: translateY(-50%);
    border: 0;
    background: var(--primary);
    border-top-left-radius: 5px;
    border-bottom-left-radius: 5px;
    padding: 10px;
    color: #fff;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
}

.sidebar-cart .cart-toggler .price {
    background: #fff;
    color: var(--primary);
    border-radius: 3px;
    margin-top: 10px;
    font-weight: 500;
    padding: 5px;
}
.cart-item:not(:last-of-type) {
    margin-bottom: 10px;
    padding-bottom: 10px;
    border-bottom: 1px solid var(--light);
}

/*hover category menu*/
.aiz-category-menu .sub-cat-menu {
    display: none;
    position: absolute;
    width: calc(100% - 25%);
    left: calc(25% - 10px);
    height: calc(100% + 20px);
    overflow: hidden;
    top: 0;
    z-index: 9;
    background-color: #fff;
    overflow-y: auto;
}
[dir="rtl"] .aiz-category-menu .sub-cat-menu {
    left: auto;
    right: calc(25% - 10px);
}
.aiz-category-menu .category-nav-element:hover .sub-cat-menu {
    display: block;
}
.aiz-category-menu .category-nav-element:hover > a {
    position: relative;
    z-index: 10;
    background: #fff;
    box-shadow: -2px 3px 5px rgb(0 0 0 / 0.1);
}
.hover-category-menu .all-category::before {
    position: absolute;
    content: "";
    width: 50px;
    height: 20px;
    bottom: 100%;
    right: 0;
}
.hover-category-menu .all-category::before {
    position: absolute;
    content: "";
    height: 12px;
    width: 12px;
    border-top: 0;
    border-right: 12px solid transparent;
    border-bottom: 12px solid var(--soft-primary);
    border-left: 12px solid transparent;
    top: -12px;
    right: 20px;
}
[dir="rtl"] .hover-category-menu .all-category::before {
    left: 20px;
    right: auto;
}

/*front widgets (footer)*/

/*footer widgets*/
.aiz-front-widget .title {
    font-size: 12px;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    margin-bottom: 20px;
}
.aiz-front-widget .menu {
    list-style: none;
    padding: 0;
    margin: 0;
}

.aiz-front-widget .menu a {
    display: inline-block;
    color: inherit;
    padding: 5px 0;
}

.aiz-front-widget .menu a:hover {
    transform: translateX(5px);
    -webkit-transform: translateX(5px);
}

/*header*/
.aiz-header {
    box-shadow: 0 10px 30px rgba(34, 44, 62, 0.05);
    border-bottom: 1px solid #edf0f5;
}

/*subheader*/
.aiz-subheader {
    border-bottom: 1px solid #edf0f5;
}

.aiz-subheader a {
    color: #6f6f6f;
}

.aiz-subheader a:hover {
    color: var(--primary);
}

/*navbar*/
.aiz-navbar .search .input-group > select,
.aiz-navbar .search .bootstrap-select {
    min-width: 160px;
}

.aiz-navbar .search .input-group-prepend {
    min-width: 280px;
}

.aiz-navbar .menu a {
    color: #505050;
    font-weight: 500;
    font-size: 13px;
}
.aiz-navbar .menu a.btn-primary {
    color: #fff;
}
@media (max-width: 991px) {
    .front-header-search {
        position: absolute;
        z-index: 1;
        width: 100%;
        height: 100%;
        top: 0;
        right: 0;
        left: 0;
        opacity: 0;
        transform: translateY(-100%);
        -webkit-transform: translateY(-100%);
        transition: all 0.3s;
        -webkit-transition: all 0.3s;
    }
    .front-header-search.active {
        transform: translateY(0%);
        -webkit-transform: translateY(0%);
        opacity: 1;
    }
}

/*slider mobile auto height*/
@media (max-width: 767.98px) {
    .mobile-img-auto-height img {
        height: auto;
    }
}

/*footer*/
.aiz-footer {
    background: #151c29;
    padding-top: 70px;
}

.aiz-front-widget .title {
    color: #717b8c;
}
.aiz-footer .menu a {
    color: #cfd3da;
}
.aiz-footer p {
    color: #cbcdd2;
}

/*copyright*/
.aiz-footer-copyright {
    border-top: 1px solid #283244;
}

[dir="rtl"] .la-angle-right {
    transform: rotate(180deg);
    -webkit-transform: rotate(180deg);
}

[dir="rtl"] .slick-arrow .la-angle-right {
    transform: rotate(0deg);
    -webkit-transform: rotate(0deg);
}

.category-filter li {
    font-weight: 400;
}

.category-filter a {
    color: inherit;
    display: block;
    padding: 5px 0;
}

.category-filter .go-back {
    font-weight: 500;
}
.category-filter .go-back ~ li:not(.go-back) {
    margin-left: 20px;
}
.category-filter .go-back a:before {
    content: "\f104";
    font-family: "Line Awesome Free";
    font-weight: 900;
    text-rendering: optimizeLegibility;
    text-transform: none;
    -moz-osx-font-smoothing: grayscale;
    -webkit-font-smoothing: antialiased;
    opacity: 0.7;
    font-size: 90%;
    margin-right: 5px;
}

.category-filter .child a {
    padding-left: 17px;
}

/*workdesk*/
.card-project {
    border-left: 3px solid transparent;
}

.card-project:not(:last-of-type) {
    border-bottom: 1px solid #ebedf2;
}

.card-project:hover {
    border-left-color: var(--primary);
    box-shadow: 0 0 4px 0 rgba(0, 0, 0, 0.08), 0 2px 4px 0 rgba(0, 0, 0, 0.12);
}

/* collapse side bar*/

.collapse-sidebar-wrap .overlay {
    opacity: 0;
    visibility: hidden;
}

.collapse-sidebar-wrap .overlay {
    opacity: 0;
    visibility: hidden;
}
.sidebar-all {
    -webkit-transition: all 0.3s ease;
    transition: all 0.3s ease;
    position: fixed;
    height: 100%;
    width: 100%;
    top: 0;
    left: 0;
    z-index: 1;
}
.sidebar-all .collapse-sidebar {
    -webkit-transition: all 0.3s ease;
    transition: all 0.3s ease;
    position: fixed;
    width: 340px;
    max-width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    z-index: 2;
    -webkit-transform: translateX(-100%);
    transform: translateX(-100%);
    overflow-y: auto;
}
.sidebar-all.sidebar-right .collapse-sidebar {
    -webkit-transform: translateX(100%);
    transform: translateX(100%);
    left: auto;
    right: 0;
}
.sidebar-all.sidebar-auto .collapse-sidebar {
    width: auto;
    max-width: 100%;
    height: auto;
    -webkit-transform: translate(-50%, -100px);
    transform: translate(-50%, -100px);
    left: 50%;
    top: 0;
}
.sidebar-all.sidebar-full .collapse-sidebar {
    width: 100%;
    max-width: 100%;
    -webkit-transform: translateX(100%);
    transform: translateX(100%);
    left: auto;
    right: 0;
}
.sidebar-all,
.sidebar-all .collapse-sidebar,
.sidebar-all .overlay {
    opacity: 0;
    visibility: hidden;
}
@media (max-width: 575.98px) {
    .sidebar-sm {
        -webkit-transition: all 0.3s ease;
        transition: all 0.3s ease;
        position: fixed;
        height: 100%;
        width: 100%;
        top: 0;
        left: 0;
        z-index: 1;
    }
    .sidebar-sm .collapse-sidebar {
        -webkit-transition: all 0.3s ease;
        transition: all 0.3s ease;
        position: fixed;
        width: 340px;
        max-width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        z-index: 2;
        -webkit-transform: translateX(-100%);
        transform: translateX(-100%);
        overflow-y: auto;
    }
    .sidebar-sm.sidebar-right .collapse-sidebar {
        -webkit-transform: translateX(100%);
        transform: translateX(100%);
        left: auto;
        right: 0;
    }
    .sidebar-sm.sidebar-auto .collapse-sidebar {
        width: auto;
        max-width: 100%;
        height: auto;
        -webkit-transform: translate(-50%, -100px);
        transform: translate(-50%, -100px);
        left: 50%;
        top: 0;
    }
    .sidebar-sm.sidebar-full .collapse-sidebar {
        width: 100%;
        max-width: 100%;
        -webkit-transform: translateX(100%);
        transform: translateX(100%);
        left: auto;
        right: 0;
    }
    .sidebar-sm,
    .sidebar-sm .collapse-sidebar,
    .sidebar-sm .overlay {
        opacity: 0;
        visibility: hidden;
    }
}
@media (max-width: 767.98px) {
    .sidebar-md {
        -webkit-transition: all 0.3s ease;
        transition: all 0.3s ease;
        position: fixed;
        height: 100%;
        width: 100%;
        top: 0;
        left: 0;
        z-index: 1;
    }
    .sidebar-md .collapse-sidebar {
        -webkit-transition: all 0.3s ease;
        transition: all 0.3s ease;
        position: fixed;
        width: 400px;
        max-width: 320px;
        height: 100%;
        top: 0;
        left: 0;
        z-index: 2;
        -webkit-transform: translateX(-100%);
        transform: translateX(-100%);
        overflow-y: auto;
    }
    .sidebar-md.sidebar-right .collapse-sidebar {
        -webkit-transform: translateX(100%);
        transform: translateX(100%);
        left: auto;
        right: 0;
    }
    .sidebar-md.sidebar-auto .collapse-sidebar {
        width: auto;
        max-width: 100%;
        height: auto;
        -webkit-transform: translate(-50%, -100px);
        transform: translate(-50%, -100px);
        left: 50%;
        top: 0;
    }
    .sidebar-md.sidebar-full .collapse-sidebar {
        width: 100%;
        max-width: 100%;
        -webkit-transform: translateX(100%);
        transform: translateX(100%);
        left: auto;
        right: 0;
    }
    .sidebar-md,
    .sidebar-md .collapse-sidebar,
    .sidebar-md .overlay {
        opacity: 0;
        visibility: hidden;
    }
}

@media (max-width: 991.98px) {
    .sidebar-lg {
        -webkit-transition: all 0.3s ease;
        transition: all 0.3s ease;
        position: fixed;
        height: 100%;
        width: 100%;
        top: 0;
        left: 0;
        z-index: 1;
    }
    .sidebar-lg .collapse-sidebar {
        -webkit-transition: all 0.3s ease;
        transition: all 0.3s ease;
        position: fixed;
        width: 400px;
        max-width: 320px;
        height: 100%;
        top: 0;
        left: 0;
        z-index: 2;
        -webkit-transform: translateX(-100%);
        transform: translateX(-100%);
        overflow-y: auto;
    }
    .sidebar-lg.sidebar-right .collapse-sidebar {
        -webkit-transform: translateX(100%);
        transform: translateX(100%);
        left: auto;
        right: 0;
    }
    .sidebar-lg.sidebar-auto .collapse-sidebar {
        width: auto;
        max-width: 100%;
        height: auto;
        -webkit-transform: translate(-50%, -100px);
        transform: translate(-50%, -100px);
        left: 50%;
        top: 0;
    }
    .sidebar-lg.sidebar-full .collapse-sidebar {
        width: 100%;
        max-width: 100%;
        -webkit-transform: translateX(100%);
        transform: translateX(100%);
        left: auto;
        right: 0;
    }
    .sidebar-lg,
    .sidebar-lg .collapse-sidebar,
    .sidebar-lg .overlay {
        opacity: 0;
        visibility: hidden;
    }
}

@media (max-width: 1199.98px) {
    .sidebar-xl {
        -webkit-transition: all 0.3s ease;
        transition: all 0.3s ease;
        position: fixed;
        height: 100%;
        width: 100%;
        top: 0;
        left: 0;
        z-index: 1;
    }
    .sidebar-xl .collapse-sidebar {
        -webkit-transition: all 0.3s ease;
        transition: all 0.3s ease;
        position: fixed;
        width: 400px;
        max-width: 320px;
        height: 100%;
        top: 0;
        left: 0;
        z-index: 2;
        -webkit-transform: translateX(-100%);
        transform: translateX(-100%);
        overflow-y: auto;
    }
    .sidebar-xl.sidebar-right .collapse-sidebar {
        -webkit-transform: translateX(100%);
        transform: translateX(100%);
        left: auto;
        right: 0;
    }
    .sidebar-xl.sidebar-auto .collapse-sidebar {
        width: auto;
        max-width: 100%;
        height: auto;
        -webkit-transform: translate(-50%, -100px);
        transform: translate(-50%, -100px);
        left: 50%;
        top: 0;
    }
    .sidebar-xl.sidebar-full .collapse-sidebar {
        width: 100%;
        max-width: 100%;
        -webkit-transform: translateX(100%);
        transform: translateX(100%);
        left: auto;
        right: 0;
    }
    .sidebar-xl,
    .sidebar-xl .collapse-sidebar,
    .sidebar-xl .overlay {
        opacity: 0;
        visibility: hidden;
    }
}

.collapse-sidebar-wrap.active,
.collapse-sidebar-wrap.active .collapse-sidebar,
.collapse-sidebar-wrap.active .overlay {
    opacity: 1;
    visibility: visible;
}
.collapse-sidebar-wrap.active .collapse-sidebar {
    -webkit-transform: translate(0%, 0%);
    transform: translate(0%, 0%);
    background-color: #fff;
}
.collapse-sidebar-wrap.active .sidebar-auto {
    -webkit-transform: translate(-50%, 0px);
    transform: translate(-50%, 0px);
}

.iqty-btns {
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    border-radius: 0.25rem;
}

.iqty-btns.vertical {
    -ms-flex-direction: column;
    flex-direction: column;
}

.iqty-btns .form-control {
    border: 0;
    background: transparent;
}

.iqty-btns .form-control,
.iqty-btns .btn {
    width: 30px;
    height: 30px;
    padding: 0;
    text-align: center;
    line-height: 30px;
}

</style>
<style>

#checkbox_information .form-group h5{
    color: white !important;
  
    text-align: center;
    background-color: #f36022;
    margin-left: 20%;
    margin-right: 20%;
    padding: 7px !important;
    border-radius: 10px;
}

.sec-heading{
    margin-left: 20%;
    margin-top: 30px;
    margin-right: 20%;
}

.sec-heading label{
    margin-bottom:10px;
    font-weight:bold;
}

.breaddcum{
    display:flex !important;
    justify-content:center !important;
}

#checkbox_information .col-sm-9{
        margin-left: 20%;
    padding: 0px;
    width:60%;

}

#checkbox_information .form-control{
    height:40px;
}


#checkbox_information .btn-labeled:not(.btn-block):not(.form-icon){
    padding-right:22px;
}

#checkbox_information .col-sm-12 {
        display: flex;
    justify-content: center;
    align-items: center;
}
 .pull-center {
  text-align: center !important;
    font-size: 15px;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
}

.pull-center i{
    margin-left: 14%;
}


@media(max-width:991px){
    #checkbox_information .form-group h5{

    margin-left: 00%;
    margin-right: 0%;
   
}

.sec-heading{
    margin-left: 0%;
    margin-top: 20px;
    margin-right: 0%;
}


.pull-center i{
    margin-left: 0%;
}
#checkbox_information .col-sm-9{
        margin-left: 10%;
    padding: 0px;
    width:90%;

}
.scroll_img{ 
    height:500px!important;
 
}



}



 #select_amn2{
    display: flex;
}
 .cat_breed ul{
    display: flex;
    flex-wrap: wrap;
    padding:0;
}
#select_amn2 p{
 background-color: #F26122;
    padding: 9px;
    width: auto;
    margin: 2px 4px;
    color: white;

}
#select_amn2 p{
    position:relative;
    
}
.cat_breed p{
 background-color: #F26122;
    padding: 9px;
    width: auto;
    margin: 2px 4px;
    color: white;

}
.cat_breed p{
    position:relative;
    
}
.flip-card-front i{
    opacity:0;
    transition:all .3s;
}
.flip-card-front:hover i{
    opacity:1;
   
}
#select_amn2 .sec_sev_close{
    color: red; background: #000;
    position: absolute;
    padding: 0px 4px;
    right: -4px; 
    top: -6px;
    border-radius: 20px; 
    line-height: 1; 
    display: inline-block; 
    font-size: 15px!important;
    cursor:pointer!important;
    }
.cat_breed .sec_sev_close{
    color: red; background: #000;
    position: absolute;
    padding: 0px 4px;
    right: -4px; 
    top: -6px;
    border-radius: 20px; 
    line-height: 1; 
    display: inline-block; 
    font-size: 15px;
    cursor:pointer!important;
    }

    #mainnav-container{
        left :0px !important;
    }ima
    .gallary_images{}
    .gallary_images ul{
        list-style: none;
        display: inline-block;
    }
    .gallary_images ul li{
        display: inline-block;
    }
  .feature_single{
    width: 100%;
    overflow:hidden;
  }
  .error{
        border-color: red !important;

}
    .del_icon
    {
    position: absolute;
    font-size: large;
    color: red;
    right:0;
    border-radius:50%;
    width: 23px;
    background: #4f3b3b;
    padding: 5px;
    height: 25px;
    }
    .del_icon i{
        float: right;
    }
    #add_amn{
    max-height: 150px;
    min-width: 0px;
    overflow-y: scroll;
}
    .gallary_images ul li img{}
.btn1{
    
    outline: 0!important;
    border: none;
    background: transparent;
}
btn1 .fa{
    font-size: 25px;
    color: #cecece;
}
.form h4{
    font-size:14px;
}
.form .btn{
    background-color: white;
    border: 1px dashed #cecece;
}
.drop_box {
  margin: 10px 0;
  padding: 30px;
  display: flex;
  background-color: #ededed;
  align-items: center;
  justify-content: center;
  flex-direction: column;
  border: 2px dashed #cecece;
  border-radius: 5px;
  width:150px;
}
.flip-card > .active, .flip-card-front:hover,.flip-card-front:focus{
    background-color:#fecb00;
}
.flip-card-inner .active{
}
.form input {
  margin: 10px 0;
  width: 100%;
  background-color: #e2e2e2;
  border: none;
  outline: none;
  padding: 12px 20px;
  border-radius: 4px;
}
.flip-card {
  background-color: transparent;
  width: 100%;
    height: 110px;
        margin: 10px 0;
  perspective: 1000px;}
.flip-card-front p{
        position: absolute;
    top: 43%;
    bottom: 50%;
    left: 50%;
    transform: translate(-50%,-50%);
}

.flip-card-inner {
  position: relative;
  width: 100%;
  height: 100%;
  text-align: center;
  transition: transform 0.6s;
  transform-style: preserve-3d;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
}

.flip-card:hover .flip-card-inner {

}

.flip-card-front, .flip-card-back {
  position: absolute;
  width: 100%;
  height: 100%;
  -webkit-backface-visibility: hidden;
  backface-visibility: hidden;
}
.flip-card-back p{
      padding: 50px 0 50px;
}
.flip-card-front i{
    font-size: 25px;
    padding: 8px 9px;
    margin-top: 25px;
    border-radius: 40px;
}
.flip-card-back {
  background-color: black;
  color: white;
  transform: rotateX(180deg);
}
.scroll_img{ 
    height:1235px;
    overflow-y:scroll !important;
}
.scroll_img img{
    width:100%;
}
.remove-parent{
    z-index:9999;
    position:relative;
}
select {
    width: 100%!important;
    height: 30px;
   
}
</style>