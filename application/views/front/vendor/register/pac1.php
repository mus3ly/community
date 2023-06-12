<style type="text/css">
    .get_into .logo_top {
        display: none;
    }

    .get_into .title {
        width: 100%;
        margin-bottom: 20px;
    }

    .logup_btn {
        background: #f2651f;
        width: auto;
        border-radius: 4px;
    }

    .form-login .row div[class*="col-"], .form-login .row aside[class*="col-"] {
        margin-top: 0;
        margin: 0 0 17px;
    }

    nav > .nav.nav-tabs {

        border: none;
        color: #fff;
        background: #272e38;
        border-radius: 0;

    }

    nav > div a.nav-item.nav-link,
    nav > div a.nav-item.nav-link.active {
        border: 1px solid #cccccc38;
        padding: 18px 25px;
        color: #fff;
        background: #272e38;
        border-radius: 0;
    }

    nav > div a.nav-item.nav-link.active:after {
        content: "";
        position: relative;
        bottom: -53px;
        left: -17%;
        border: 15px solid transparent;
        border-top-color: #d1d1d1;
    }

    .tab-content {
        background: #fdfdfd;
        line-height: 25px;
        border: 1px solid #ddd;
        padding: 30px 25px;
        display: -webkit-box;
        width: 100%;
    }

    #pricing-table li {
        font-size: 16px;
    }

    nav > div a.nav-item.nav-link:hover,
    nav > div a.nav-item.nav-link:focus {
        border: 1px solid transparent;
        background: #f26129;
        color: #fff;
        border-radius: 0;
        transition: background 0.20s linear;
    }
</style>

<style>
    #pricing-table {
        margin: 10px auto;
        text-align: center;
        transition: 0.3s;
    }

    #pricing-table .plan {
        font: 12px 'Lucida Sans', 'trebuchet MS', Arial, Helvetica;
        text-shadow: 0 1px rgba(255, 255, 255, .8);
        background: #fff;
        border: 1px solid #f26129;
        color: #333;
        padding: 20px;
        width: 100%; /* plan width = 180 + 20 + 20 + 1 + 1 = 222px */
        float: left;
        position: relative;
        border-radius: 10px;
    }
    .img-circle {
        border-radius: 50%;
        margin-top: 14px;
        margin-left: 3px;
    }
    #pricing-table h3 {
        /*font-size: 20px;*/
        /*font-weight: 600 !important;*/
        /*padding: 20px;*/
        /*margin: -20px -20px 50px -20px;*/
        /*background-color: #eee;*/
        /*background-image: -moz-linear-gradient(#fff, #eee);*/
        /*background-image: -webkit-gradient(linear, left top, left bottom, from(#fff), to(#eee));*/
        /*background-image: -webkit-linear-gradient(#fff, #eee);*/
        /*background-image: -o-linear-gradient(#fff, #eee);*/
        /*background-image: -ms-linear-gradient(#fff, #eee);*/
        /*background-image: linear-gradient(#fff, #eee);*/

        font-size: 20px;
        font-weight: 600 !important;
        padding: 20px;
        margin: -20px -20px 50px -20px;
        background: #f26129;
        color: #fff;
    }

    #pricing-table ul {
        margin: 20px 0 0 0;
        padding: 0;
        list-style: none;
    }

    #pricing-table li {
        border-top: 1px solid #ddd;
        padding: 10px 0;
    }

    #pricing-table .signup {
        position: relative;
        padding: 8px 20px;
        margin: 20px 0 0 0;
        color: #fff;
        font: bold 14px Arial, Helvetica;
        text-transform: uppercase;
        text-decoration: none;
        display: inline-block;
        background-color: #F57D20;
        -moz-border-radius: 3px;
        -webkit-border-radius: 3px;
        border-radius: 3px;
        text-shadow: 0 1px 0 rgba(0, 0, 0, .3);
        -moz-box-shadow: 0 1px 0 rgba(255, 255, 255, .5), 0 2px 0 rgba(0, 0, 0, .7);
        -webkit-box-shadow: 0 1px 0 rgba(255, 255, 255, .5), 0 2px 0 rgba(0, 0, 0, .7);
        box-shadow: 0 1px 0 rgba(255, 255, 255, .5), 0 2px 0 rgba(0, 0, 0, .7);
    }

    #pricing-table .signup:hover {
        background-color: #F57D20;
        background-image: -moz-linear-gradient(#F57D20, #f5a020);
        background-image: -webkit-gradient(linear, left top, left bottom, from(#F57D20), to(#f5a020));
        background-image: -webkit-linear-gradient(#F57D20, #f5a020);
        background-image: -o-linear-gradient(#F57D20, #f5a020);
        background-image: -ms-linear-gradient(#F57D20, #f5a020);
        background-image: linear-gradient(#F57D20, #f5a020);
    }

    #pricing-table .signup:active, #pricing-table .signup:focus {
        background: #F57D20;
        top: 2px;
        -moz-box-shadow: 0 0 3px rgba(0, 0, 0, .7) inset;
        -webkit-box-shadow: 0 0 3px rgba(0, 0, 0, .7) inset;
        box-shadow: 0 0 3px rgba(0, 0, 0, .7) inset;
    }

    .clear:before, .clear:after {
        content: "";
        display: table
    }

    .clear:after {
        clear: both
    }

    .clear {
        zoom: 1
    }

    #pricing-table h3 span {
        display: block;
        font: bold 25px/100px Georgia, Serif;
        color: #777;
        background: #fff;
        /*border: 5px solid #fff;*/
        height: 100px;
        width: 100px;
        margin: 10px auto -65px;
        -moz-border-radius: 100px;
        -webkit-border-radius: 100px;
        border-radius: 100px;
        -moz-box-shadow: 0 5px 20px #ddd inset, 0 3px 0 #999 inset;
        -webkit-box-shadow: 0 5px 20px #ddd inset, 0 3px 0 #999 inset;
        box-shadow: 0 5px 20px #ddd inset, 0 3px 0 #999 inset;
    }

    .skip_box {
        text-align: center;
        clear: both;
        width: 100%;
        padding: 32px 0 0;
    }

    .skip_box a {
        background: #e15b04;
        color: #fff;
        border-radius: 4px;
        padding: 10px 19px;
        display: inline-block;
    }

    #nav-tab .active {
        background: #f26129;
    }

    .sidgapp {
        padding: 0 5px;
    }

    @media (max-width: 1024px) {
        .container {
            width: 100%;
            max-width: 100%;
        }

        #pricing-table li {
            font-size: 13px;
        }

    }

    @media (max-width: 767px) {
        .container {
            width: auto;
            max-width: 100%;
        }

        #pricing-table li {
            font-size: 14px;
        }

        .vendor_box {
            margin-top: 0;
        }

        .nav-fill .nav-item {
            text-align: center;
            width: 33%;
            padding: 11px 3px !important;
            text-align: center;
            display: inline-block;
            font-size: 11px;
        }

        nav > div a.nav-item.nav-link.active:after {
            border-top-color: transparent;
        }

        .tab-content > .tab-pane {
            padding: 0;
        }

        .col-sm-12, .col-xs-12 {
            padding: 0;
        }

    }
    /* common */
    .ribbon {
        width: 100px;
        height: 100px;
        overflow: hidden;
        position: absolute;
    }
    .ribbon::before,
    .ribbon::after {
        position: absolute;
        z-index: -1;
        content: '';
        display: block;
        border: 3px solid #1eb5ff;
    }
    .ribbon span {
        position: absolute;
        display: block;
        width: 165px;
        padding: 5px 0;
        background-color: #1eb5ff;
        box-shadow: 0 5px 10px rgba(0,0,0,.1);
    }

    /* top right*/
    .ribbon-top-right {
        top: -3px;
        right: -3px;
        z-index: 9001;
    }
    .ribbon-top-right::before,
    .ribbon-top-right::after {
        border-top-color: transparent;
        border-right-color: transparent;
    }
    .ribbon-top-right::before {
        top: 0;
        left: 0;
    }
    .ribbon-top-right::after {
        bottom: 0;
        right: 0;
    }
    .ribbon-top-right span {
        left: -22px;
        top: 21px;
        transform: rotate(45deg);
    }

</style>

                      <div class="container ">


                          <!--start-->


                          <div class="">
              <div class="row">
                <div class="col-xs-12 ">
                  <nav>
                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                        <?php
                        foreach($cat as $k => $v){
                            $nav = str_replace(' ','', $v['name']);
                        ?>
                      <a class="nav-item nav-link <?= (!$k)?"active":"";?>" id="<?= $v['id']; ?>" data-toggle="tab" href="#<?php echo $nav; ?>" role="tab" aria-controls="nav-<?php echo $nav; ?>" aria-selected="true"><?php echo $v['name']; ?></a>
                      <?php
                        }
                      ?>
                      <!--<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Platinum</a>-->
                      <!--<a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Gold</a>-->
                    </div>
                  </nav>

                  <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                    <?php
                        foreach($cat as $k => $v){
                            $nav = str_replace(' ','', $v['name']);
                        ?>
                    <div class="col-md-12 tab-pane fade <?= (!$k)?" active in ":"";?>" id="<?php echo $nav; ?>" role="tabpanel" aria-labelledby="<?= $v['id']; ?>">
                      <?php
                      $pkg = $this->db->where('mcat', $v['id'])->get('membership')->result_array();
                        foreach ($pkg as $k => $v) {
                          ?>
                          <div class="col-sm-3 sidgapp">
                             <!-- here -->
                              <div id="pricing-table" class="clear">
                                <div class="plan">
                                    <h3><?= $v['title'] ?><span><img width="70" height="70" class="img-md img-circle"
                    src="<?php echo $this->crud_model->file_view('membership',$v['membership_id'],'100','','thumb','src','','','.png') ?>"  /></span></h3>
                                    <a class="signup" href="<?= base_url('vendor_logup/registration'); ?>?pack=<?= $v['membership_id'] ?>">Sign up</a>
                                    <ul>
                                        <li><b><?= $v['product_limit'] ?> </b>  Ads</li>
                                        <li><b><?= $v['timespan'] ?> days </b> </li>
                                        <li><b>£<?= $v['price'] ?>  </b></li>
                                    </ul>
                                </div>
                                </div>

                          </div>
                          <?php
                        }
                        ?>
                    </div>
                   <?php
                        }
                      ?>
                  </div>

                </div>
              </div>


              <div class="skip_box">
                            <a class="pkg_skip" href="<?= base_url('vendor_logup/registration'); ?>?pack=0">Skip and continue</a>
                          </div>
        </div>
      </div>
</div>




                          <!--start-->



                      </div>
<script>
    $(".nav .nav-link").on("click", function(){
        $(".nav").find(".active").removeClass("active");
        $(this).addClass("active");
    });
</script>
