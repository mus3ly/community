
<?php
$url = base_url('updated/');
 include "header_new.php";
?>
<style>
    /* styles.css */
    .zoom-image {
        position: relative;
        overflow: hidden;
        padding-top: calc(var(--bs-gutter-x) * .5);
        padding-bottom: calc(var(--bs-gutter-x) * .5);

    }
    
    .zoom-image img {
        width: 100%;
        transition: transform 0.3s ease;
    }
    
    .zoom-image:hover img {
        transform: scale(1.1); /* Zoom in on hover by scaling the image */
        z-index: -1; /* Place the zoomed image behind the parent div */
    }
    
    

</style>
<main>
    <section class="page-section with-sidebar">

    <div class="container">
        <div class="row">
            <div class="text-center heading">
                <h1>About Us</h1>
            </div>
            <div class="text-center">
                <p>Building Communities, Boosting Businesses</p>
                <p>Welcome to Community HubLand, where our mission is to simplify the journey of running a small business while fostering connections within thriving communities.</p>
            </div>
        </div>
        
        
        
        <div class="row box shadow my-5 about-us">
            <div class="col-md-6 p-4">
                
                <h4>Our Vision</h4>
                <p>At Community HubLand, we firmly believe that every small business owner, entrepreneur, blogger, or creative mind deserves a chance to succeed, regardless of the challenges they face. We envision a world where powerful digital tools and strong communities converge to uplift individuals and their businesses.</p>

                <h4>Your Success is Our Top Priority</h4>
                <p>Running a small business often feels like a solitary endeavor. That's why we've created a platform that not only provides robust digital tools and services but also nurtures connections among like-minded individuals. We're here to support you every step of the way, equipping you with the tools you need to thrive in the digital age.</p>

                <h4>What Sets Us Apart</h4>
                <p>Community HubLand isn't just about business; it's about community. We've established a space where small business owners, bloggers, entrepreneurs, and creative minds can come together, sharing experiences and knowledge to benefit one another and the communities they serve.</p>
                
                <p>Moreover, Community HubLand is a proud winner of the Business in Focus Green Goal award, ensuring a positive impact on our environment. Also, Community HubLand gives back 10% to support local initiatives. Hence, when your business grows, planet & neighborhood thrives.</p>
            </div>
            <div class="col-md-6">
                <div class="img zoom-image">
                    <img src="https://images.placeholders.dev/?width=600&height=600&text=Made%20with%20placeholders.dev&bgColor=%23f7f6f6&textColor=%236d6e71"
                        alt="Community HubLand Image" class="img-fluid">
                </div>
            </div>
        </div>
        <div class="row box shadow my-5">
            <div class="col-md-6">
                <div class="img zoom-image">
                    <img src="https://images.placeholders.dev/?width=600&height=300&text=Made%20with%20placeholders.dev&bgColor=%23f7f6f6&textColor=%236d6e71"
                        alt="Community HubLand Image" class="img-fluid">
                </div>
            </div>
            <div class="col-md-6 p-4">
                <h4>Our Team</h4>
                <p>Our dedicated team of professionals is passionate about helping you succeed. With years of experience in various industries, we bring a wealth of knowledge and expertise to the table. Meet the people who are committed to making your journey with Community HubLand a remarkable one.</p>
                <p>From our CEO to our talented developers and support staff, every member of our team is dedicated to providing you with the best solutions and support.</p>
            </div>
        </div>
        <div class="row box shadow my-5">
            <div class="col-md-6 p-4">
                <h4>Community Impact</h4>
                <p>We believe in giving back to the communities we serve. Through our Community Impact program, we actively support local initiatives, charities, and causes. We're committed to making a positive difference in the world, one community at a time.</p>
                <p>By partnering with local organizations and participating in community events, we aim to create a lasting impact and contribute to the well-being of our communities. Together, we can make a difference.</p>
            </div>
            <div class="col-md-6">
                <div class="img zoom-image">
                    <img src="https://images.placeholders.dev/?width=600&height=300&text=Made%20with%20placeholders.dev&bgColor=%23f7f6f6&textColor=%236d6e71"
                        alt="Community HubLand Image" class="img-fluid">
                </div>
            </div>
        </div>






    </div>
    </section>
    
  </main>
<?php
 include "footer_new.php";
?>
