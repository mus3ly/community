
<?php
$url = base_url('html/');
include "header.php";
?>


<div class="main_warp">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 graphic_img">
                <img src="<?= ($data['1st_section']['right_img'])?$data['1st_section']['right_img']:base_url().'/uploads/others/parralax_search.webp'; ?>" alt="">
            </div>
            <div class="col-sm-6 perfect_place">
                <h5>Amet consectetur adipisicing New</h5>
                <h3>Find Your <b>Perfect Place.</b></h3>
                <div class="search_bar">
                    <form action="<?= base_url(); ?>">
                    <img src="images/Location.png" alt="">
                    <input type="text" placeholder="Find Your  Place" name="q">
                    <button type="submit">Search</button>
                    </form>
                </div>


                <?php
                if(file_exists(FCPATH."cat_menu.php"))
                {
                    include FCPATH."cat_menu.php";
                }
                ?>


                
                
            </div>
        </div>
    </div>
</div>
<div class="right_dotted">
    <img src="images/doted-lines-right.png" alt="">
</div>


<div class="list_business">
    <div class="container">
        <div class="plus_dot">
            <div class="right_plus">
                <img src="images/plus-gray.png" alt="">
            </div>
            <h4>You can now list your business in less than 5 minutes</h4>
            <p>You can now list your business in less than 5 minutes - gain access to own business page -  or order a custom built digital solution. Getting work done has never been easier</p>
            <div class="orange_plus">
                <img src="images/orange-plus.png" alt="">
            </div>
        </div>
    </div>
</div>


<div class="icon_box_wrap">
    <div class="container">
        
        <div class="row">
            <div class="col-sm-4 sidegapp">
                <div class="info_box_shadow">
                    <div class="shadow_icon">
                        <img src="images/business-icon.png" alt="">
                    </div>
                    <b>Business Webpage</b>
                    <ul>
                        <li>Beautiful home page</li>
                        <li>Beautiful home page</li>
                        <li>Contact form</li>
                        <li>Textual Galeries</li>
                        <li>Reviews</li>
                        <li>Link to backend tools</li>
                        <li>Textual Galeries</li>
                    </ul>
                    <div class="bottom_path active_path">
                        <img src="images/rectangle.png" alt="">
                    </div>
                </div>
            </div>
            <div class="col-sm-4 sidegapp">
                <div class="info_box_shadow">
                    <div class="shadow_icon">
                        <img src="images/category.png" alt="">
                    </div>
                    <b>Ads in any Categories</b>
                    <ul>
                        <li>Business Events</li>
                        <li>Job openings</li>
                        <li>Business Services</li>
                        <li>Business Products</li>
                        <li>Any personal products</li>
                        <li>Voluntary positions</li>
                    </ul>
                    <div class="bottom_path">
                        <img src="images/rectangle.png" alt="">
                    </div>
                </div>
            </div>
            <div class="col-sm-4 sidegapp">
                <div class="info_box_shadow">
                    <div class="shadow_icon">
                        <img src="images/users.png" alt="">
                    </div>
                    <b>Marketing via Affiliates</b>
                    <ul>
                        <li>Join vendor affiliate programme</li>
                        <li>Automated affiliate commissions</li>
                        <li>Share with affiliates</li>
                        <li>Share with affiliates</li>
                        <li>Add designed media to platform for affiliates to share</li>
                    </ul>
                    <div class="bottom_path">
                        <img src="images/rectangle.png" alt="">
                    </div>
                </div>
            </div>
        </div>
        <div class="arrow_doted">
            <img src="images/arrowdot.png" alt="">
        </div>
        <div class="plus_dotted">
            <img src="images/plus-gray.png" alt="">
        </div>

        <div class="row" id="last_child">
            <div class="col-sm-4 sidegapp">
                <div class="info_box_shadow">
                    <div class="shadow_icon">
                        <img src="images/blogging.png" alt="">
                    </div>
                    <b>Blogging page</b>
                    <ul>
                        <li>Beautiful home page</li>
                        <li> Links to other features</li>
                        <li>Contact form</li>
                        <li>Textual Galeries</li>
                        <li>Reviews</li>
                        <li>Link to backend tools</li>
                        <li>Textual Galeries</li>
                    </ul>
                    <div class="bottom_path">
                        <img src="images/rectangle.png" alt="">
                    </div>
                </div>
            </div>
            <div class="col-sm-4 sidegapp">
                <div class="info_box_shadow">
                    <div class="shadow_icon">
                        <img src="images/instagram.png" alt="">
                    </div>
                    <b>Share on Social Media</b>
                    <ul>
                        <li>Business Events</li>
                        <li>Job openings</li>
                        <li>Business Services</li>
                        <li>Business Products</li>
                        <li>Any personal products</li>
                        <li>Voluntary positions</li>
                    </ul>
                    <div class="bottom_path">
                        <img src="images/rectangle.png" alt="">
                    </div>
                </div>
            </div>
            <div class="col-sm-4 sidegapp">
                <div class="info_box_shadow">
                    <div class="shadow_icon">
                        <img src="images/add-shop.png" alt="">
                    </div>
                    <b>Add to Shop</b>
                    <ul>
                        <li>Join vendor affiliate programme</li>
                        <li>Automated affiliate commissions</li>
                        <li>Share with affiliates</li>
                        <li>Share with affiliates</li>
                        <li>Add designed media to platform for affiliates to share</li>
                    </ul>
                    <div class="bottom_path">
                        <img src="images/rectangle.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="community_wrap">
    <div class="container">
        <div class="clipart">
            <img src="images/business_graphic-clipart.png" alt="">
        </div>
        <div class="row">
            <div class="col-sm-6 communitybox every_business">
                <h3>Every Business has something to <span>offer their community</span></h3>
                <p>On Community HubLand, you list your Events, Jobs, Blogs, Properties, and more. All the basics your business needs for success</p>
                <ul>
                    <li><img src="images/Tick-Square.png" alt=""> Own a business website</li>
                    <li><img src="images/Tick-Square.png" alt=""> Access to your business affiliate marketing platform</li>
                    <li><img src="images/Tick-Square.png" alt=""> Post products in shops and receive payments</li>
                    <li><img src="images/Tick-Square.png" alt=""> Blog away with your audience</li>
                    <li><img src="images/Tick-Square.png" alt=""> Post ads in any category</li>
                </ul>
                <b>Price?</b>
                <h5>Less than a the cost of a breakfast a month</h5>
            </div>
            <div class="col-sm-6 business_graphic">
                <img src="images/business_graphic.png" alt="">
                <div class="circle_clipart">
                    <img src="images/circle-clipart.png" alt="">
                </div>
            </div>
        </div>
        <div class="dotted_lines_clipart">
            <img src="images/dotted_lines_clipart.png" alt="">
        </div>
    </div>
</div>

<div class="orange_card">
    <div class="container">
        <div class="orange_card_box">
            <div class="full_circle">
                <img src="images/business-card-right.png" alt="">
            </div>
            <p>COMMUNITY HUBLAND DIGITAL SERVICES</p>
            <h4>Professional Business Solutions <span>Designed For You</span></h4>
            <p class="hire_para">Hire our experienced team of programmers, digital designers, and marketing professionals, who <span>know how to deliver results. With your requirements, we will help you identify your needs to</span> reach solutions</p>
            <div class="row">
                <div class="col-sm-6 checkbox_tick">
                    <img src="images/Tick-Square.png" alt="">
                    <h4>WEB & ENTERPRISE PORTALS</h4>
                    <p>Incredible UX and compelling functionality under the hood</p>
                </div>
                <div class="col-sm-6 checkbox_tick">
                    <img src="images/Tick-Square.png" alt="">
                    <h4>ECOMMERCE DEVELOPMENT </h4>
                    <p>Fully customized eCommerce solution for your online store</p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 checkbox_tick">
                    <img src="images/Tick-Square.png" alt="">
                    <h4>GRAPHICS ANALYSIS</h4>
                    <p>Solutions empowered with computer Graphic Designing</p>
                </div>
            </div>
            <div class="learn_more_btns">
                <a href="#" class="our_projects">OUR PROJECTS</a>
                <a href="#" class="learn_more">LEARN MORE</a>
            </div>
            <div class="bottom_circled">
                <img src="images/bottom-circled.png" alt="">
            </div>
        </div>
    </div>
</div>


<div class="advertise_wrap">
    <div class="purple_line">
        <img src="images/base-icon.png" alt="">
    </div>
    <div class="container">
        <div class="row" id="advertise_info">
            <div class="col-sm-6 business_graphic">
                <img src="images/info-graphic.png" alt="">
                <div class="purple_dot" style="top: auto;bottom: -61px;">
                        <img src="images/purple.png" alt="">
                    </div>
            </div>
            <div class="col-sm-6 communitybox">
                <b>ADVERTISE ON COMMUNITY HUBLAND DIRECTORY SITE</b>
                <h3>Advertise your professional business on Community HubLand directory site</h3>
                <p>Reach larger interested audience with a digital presence that manage, monitor and consolidate all your business in one place. Get started with us and receive:</p>
                <ul>
                    <li>
                        <img src="images/Tick-Square.png" alt="">
                         ADVERTISEMENT SPOT
                         <p>Get listed on main directory site under your industry</p>
                    </li>
                    <li>
                        <img src="images/Tick-Square.png" alt="">
                         WEB PAGE
                         <p>You will be provided a web page where you can list more information about your business</p>
                    </li>
                    <li>
                        <img src="images/Tick-Square.png" alt="">
                         AFFILIATE 
                         <p>Become an affiliate and earn great rewards Advertise with Us</p>
                    </li>
                </ul>
                <div class="learn_more_btns">
                <a href="#" class="our_projects">Advertise  With Us</a>
                    <div class="purple_dot">
                        <img src="images/purple.png" alt="">
                    </div>
                </div>
                
            </div>
            
        </div>
    </div>
    <div class="upper_line_dot">
        <img src="images/doted-lines-right.png" alt="">
    </div>
</div>


<div class="verifed_listings">
    <div class="vertical_dot">
        <img src="images/vertical.png" alt="">
    </div>
    <div class="container">
        <div class="verify_head">
            <h3>Verified Listings</h3>
            <p>Explore and contact businesses directly with no obligation</p>
            <div class="listing_lines">
                <img src="images/Group.png" alt="">
            </div>
        </div>
        <?php
        include "feature_products.php";
        ?>
        <div class="orange_purple">
            <img src="images/arrow-purple.png" alt="">
        </div>
    </div>
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
