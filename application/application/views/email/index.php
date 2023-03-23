<!--<p><span removed]="font-weight: bold;">Hi [[to]],</span></p>-->

<!--<p>[[meg]]</p>-->

<!--<p><br></p>-->

<!--<p><span removed]="font-weight: bold;">Thanks,</span></p>-->

<!--<p><span removed]="">[[from]]</span></p>-->
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Community Hub Land</title>
	<link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,300;0,400;1,700;1,900&family=Roboto:wght@100;300;500;700;900&display=swap" rel="stylesheet">
	<link rel="stylesheet"
  href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
</head>
	<style>
		*{
			margin: 0;
			padding: 0;
			list-style: none;
			text-decoration: none;
			box-sizing: border-box;
			font-family: 'Lato', sans-serif;
			font-family: 'Roboto', sans-serif;
		}
		nav{
			display: flex;
			justify-content: center;
			min-height: 120px;
			align-items: center;
			background: white;
		}
		nav a img{
			width: 200px;
		}
		#bg_color{
			background-color: #e6875b;
			
			width: 70%;
			margin: 0 auto;
		}
		.banner_img{
			display: flex;
			align-items: center;
			justify-content: center;
			background-position: center;
			background-repeat: no-repeat;
			background-size: cover;

		}
		.banner_img img{
			width: 100%;
		}
		.container{
			width: 70%;
			margin: 0 auto;
		}
		.text_wrapper h4{
			font-family: lato;
			font-size: 20px;
			font-weight: 700;
			color: #33334C;
			margin: 40px 0;
		}
		.text_wrapper p{
			font-size: 18px;
			color: #383853;
			font-weight: 400;
			line-height: 1.5;
		}
		footer{
			background-color: #303030;
			width: 70%;
			margin: 0 auto;
		}
		.left{
			display: flex;
			width: 50%;
			padding: 50px;
			justify-content: center;
			height: 100%;
			margin: 0 10px;
			min-height: 300px;
			justify-content: space-around;
			
		}
		.sub_left_1 li a{
			
			color: whitesmoke;
			font-weight: 400;
			line-height: 3;
			width: 25%;

		}
		.sub_left_2 li a{
			color: whitesmoke;
			font-weight: 400;
			width: 25%;
			line-height: 3;
		}
		.footer_wrapper{
			display: flex;
			
			
		}
		.social{
			    margin-bottom: 8px;
    margin-top: 15px;
		}
		.social a i{
			color: white;
			font-size: 30px;
			letter-spacing: 5px;

		}
		.right{
			padding: 50px;
			border-left: 2px solid #dddd;

		}
		.adress li a{
			
			color: whitesmoke;
			font-weight: 400;
			line-height: 2;
		}
		@media (max-width:500px){
			.footer_wrapper{
				display: block;
			}
			.left{
				    display: block;
    width: 50%;
    padding: 10px;
    justify-content: center;
    height: 100%;
    margin: 0 10px;
    min-height: 300px;
    justify-content: space-around;
			}
			.right{
				padding: 10px;
				margin: 0 10px;
				border: none;
			}
		}
	</style>
</head>
<body>
	<header>
		<nav>
			<a href="#"><img src="<?php echo base_url();?>uploads/img/logo.png"></a>
		</nav>
	</header>
	<section id="bg_color">
		<div class="container">
		<div class="banner_img">
			<img src="<?php echo base_url();?>uploads/img/banner.png">
		</div>
		</div>
	</section>
	<section id="text_section">
		<div class="container">
			<div class="text_wrapper">
			<h4>Hi Michelle</h4>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
			<h4>Team CommunityHubland</h4>
		</div>
		</div>
	</section>
	<footer style="color: whitesmoke;">
			<div class="footer_wrapper">
			<div class="left">
				<div class="sub_left_1">
				
					<li><a href="#">Contact Us</a></li>
					<li><a href="#">Help Center</a></li>
					<li><a href="#">Terms</a></li>
					<li><a href="#">Privacy</a></li>
				
				</div>
				<div class="sub_left_2">
					<li><a href="">Help Prefrences</a></li>
					<li><a href="">Unsubcribe</a></li>
				</div>

			</div>
			<div class="right">
				<div class="social">
					<a href="#"><i class='bx bxl-facebook'></i></a>
					<a href="#"><i class='bx bxl-twitter' ></i></a>
					<a href="#"><i class='bx bxl-instagram' ></i></a>
				</div>
				<div class="adress">
					<li><a href="#">CommunityHubland Company</a></li>
					<li><a href="#">Adress Line</a></li>
					<li><a href="#">City,Country</a></li>
					<li><a href="#">CommunityHubland.Com</a></li>
				</div>
			</div>
		</div>
	</footer>
</body>
</html>