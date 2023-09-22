                <style type="text/css">
    .get_into .logo_top{
        display: none;
    }
    .get_into .title{
        width: 100%;
        margin-bottom: 20px;
    }
    .logup_btn{
        background: #f2651f;
        width: auto;
        border-radius: 4px;
    }
    .form-login .row div[class*="col-"], .form-login .row aside[class*="col-"] {
    margin-top: 0;
    margin: 0 0 17px;
}
</style>

                 <style>
    #pricing-table {
	margin: 10px auto;
	text-align: center;
    transition: 0.3s;
}
#pricing-table:hover{
      transform: scale(1.1);
      box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
    
}
#pricing-table .plan {
	font: 12px 'Lucida Sans', 'trebuchet MS', Arial, Helvetica;
	text-shadow: 0 1px rgba(255,255,255,.8);        
	background: #fff;      
	border: 1px solid #ddd;
	color: #333;
	padding: 20px;
	width: 100%; /* plan width = 180 + 20 + 20 + 1 + 1 = 222px */      
	float: left;
	position: relative;
}
#pricing-table h3 {
	font-size: 20px;
	font-weight: normal;
	padding: 20px;
	margin: -20px -20px 50px -20px;
	background-color: #eee;
	background-image: -moz-linear-gradient(#fff,#eee);
	background-image: -webkit-gradient(linear, left top, left bottom, from(#fff), to(#eee));    
	background-image: -webkit-linear-gradient(#fff, #eee);
	background-image: -o-linear-gradient(#fff, #eee);
	background-image: -ms-linear-gradient(#fff, #eee);
	background-image: linear-gradient(#fff, #eee);
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
	text-shadow: 0 1px 0 rgba(0,0,0,.3);        
	-moz-box-shadow: 0 1px 0 rgba(255, 255, 255, .5), 0 2px 0 rgba(0, 0, 0, .7);
	-webkit-box-shadow: 0 1px 0 rgba(255, 255, 255, .5), 0 2px 0 rgba(0, 0, 0, .7);
	box-shadow: 0 1px 0 rgba(255, 255, 255, .5), 0 2px 0 rgba(0, 0, 0, .7);
}

#pricing-table .signup:hover {
	background-color: #F57D20;
	background-image: -moz-linear-gradient(#F57D20, #f5a020);
	background-image: -webkit-gradient(linear, left top, left bottom, from(#F57D20), to(#f5a020));      
	background-image: -webkit-linear-gradient(#F57D20,#f5a020);
	background-image: -o-linear-gradient(#F57D20,#f5a020);
	background-image: -ms-linear-gradient(#F57D20,#f5a020);
	background-image: linear-gradient(#F57D20,#f5a020); 
}

#pricing-table .signup:active, #pricing-table .signup:focus {
	background: #F57D20;       
	top: 2px;
	-moz-box-shadow: 0 0 3px rgba(0, 0, 0, .7) inset;
	-webkit-box-shadow: 0 0 3px rgba(0, 0, 0, .7) inset;
	box-shadow: 0 0 3px rgba(0, 0, 0, .7) inset; 
}
.clear:before, .clear:after {
  content:"";
  display:table
}

.clear:after {
  clear:both
}

.clear {
  zoom:1
}
#pricing-table h3 span {
    display: block;
    font: bold 25px/100px Georgia, Serif;
    color: #777;
    background: #fff;
    border: 5px solid #fff;
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

</style>

                      <div class="row container" style="width:104%;">
                        
					  <div class="col-md-3 col-sm-12 col-xs-12">
                             <!-- here -->
                              <div id="pricing-table" class="clear">
                                <div class="plan">
                                    <h3>Free<span><img src="<?php echo $this->crud_model->file_view('membership',0,'100','','thumb','src','','','.png') ?>" 
                        width="48.5%" id='blah' > </span></h3>
                                    <a class="signup" href="<?= base_url('vendor_logup/registration'); ?>?pack=0">Sign up</a>         
                                    <ul>
                                        <li><b><?php echo $this->db->get_where('general_settings',array('type'=>'default_member_product_limit'))->row()->value; ?> </b> Products limit</li>
                                        <li><b>30 day </b> Time span</li>
                                        <li>Buy in <b>Free</b></li>
                                    </ul> 
                                </div>
                                </div>
                              
                          </div>
						<?php
                        foreach ($pkgs as $k => $v) {
                          ?>
                          <div class="col-md-3 col-sm-12 col-xs-12">
                             <!-- here -->
                              <div id="pricing-table" class="clear">
                                <div class="plan">
                                    <h3><?= $v['title'] ?><span><img width="70" height="70" class="img-md img-circle"
                    src="<?php echo $this->crud_model->file_view('membership',$v['membership_id'],'100','','thumb','src','','','.png') ?>"  /></span></h3>
                                    <a class="signup" href="<?= base_url('vendor_logup/registration'); ?>?pack=<?= $v['membership_id'] ?>">Sign up</a>         
                                    <ul>
                                        <li><b><?=  $v['product_limit'] ?> </b> Avalible Ads</li>
                                        <li><b><?=  $v['timespan'] ?> day </b> Time span</li>
                                        <li>Buy in<b><?=  $v['price'] ?> £ </b></li>
                                    </ul> 
                                </div>
                                </div>
                              
                          </div>
                          <?php
                        }
                        ?>
                          <a class="pkg_skip" href="<?= base_url('vendor_logup/registration'); ?>?pack=0">Skip and continue</a>
                      </div>
