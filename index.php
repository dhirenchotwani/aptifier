<?php
include_once('classes/Functions.php');
include_once('classes/User.php');
$obj=new User();
if($obj->isCookieSet()){
	Functions::redirect('includes/dashboard.php');
}
else{
?>
<html>

<head>
	<style>
		
		.vd {
			padding-right: 30px;
			color: #08476E;
			letter-spacing: 1px;


		}

		.vd:hover {
			color: #066fac;
		}

		footer {
			background-color: #08476E;
			padding-top: 30px;

		}

		footer p {
			font-size: 16px;
			font-weight: 300;
		}

		.contact-left h3,
		.contact-right h3 {
			color: #fff;
			font-size: 28px;
			font-weight: 700;
		}

		.contact-left p {
			color: #fff;
			margin-bottom: 30px;
		}

		.contact-info {
			background: url('assets/images/world-map.png') no-repeat;
			background-size: contain;
		}

		address {
			color: #fff;
		}

		address strong,
		.phone-fax-email strong {
			font-size: 16px;
			letter-spacing: 1px;
		}

		.form-control {
			background-color: transparent;
			border-radius: 0;
			color: #fff;
			font-size: 16px;
			font-weight: 300;
			border-color: #fff;
			margin-bottom: 20px;
			padding: 8px 15px;
		}

		/*

	</style>


	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>Aptifiers!</title>
	<link rel="shortcut icon" href="assets/data2/images/faviconb.png" />
	<link rel="stylesheet" type="text/css" href="assets/engine2/style.css" />
    <script type="text/javascript" src="assets/engine2/jquery.js"></script>
	
	<link rel="stylesheet" href="assets/css/bootstrap2.min.css">
	<link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
	
	
	<!-- Start WOWSlider.com HEAD section --> <!-- add to the <head> of your page -->
	<link rel="stylesheet" type="text/css" href="assets/engine2/style.css" />
	<!--script type="text/javascript" src="engine2/jquery.js"></script-->
	<!-- End WOWSlider.com HEAD section --></head>
<body style="">
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="wg-nav-wrapper">
				<div class="nav-header">
<!--					<a href="#" class="navbar-brand"><img src="assets/images/" alt="logo" width="171" height="81" style="margin:15px 45px 15px"></a>-->
									
				<a href="#"><img src="assets/data2/images/155120841628803503.png" alt=""></a>
					<div style="display: inline; margin:30px 400px 30px;color:#066fac">
					
						
						<a href="#about" class="vd" style="text-decoration: none;">About</a>
						<a href="#contact" class="vd" style="text-decoration: none;">Contact</a>
						<a href="includes/register.php" class="btn" style="text-decoration: none;color: #fff;width:90px;margin-left: 20px;background-color:#08476E">Sign Up</a>
						<a href="includes/login.php" class="btn" style="text-decoration: none;color: #fff;width:90px;margin-left: 20px;background-color:#08476E ">Login</a>
					</div>
				</div>
				<!--nav-header-->
			</div>
			<!--wg-nav-wrapper-->
		</div>
		<!--container-fluid-->
	</nav>
	<section id="home">
  
<!-- Start WOWSlider.com BODY section --> <!-- add to the <body> of your page -->
	<div id="wowslider-container2">
	<div class="ws_images"><ul>
		<li><img src="assets/data2/images/web_1280__1.png" alt="Web 1280 – 1"  id="wows2_0"/></li>
		<li><img src="assets/data2/images/web_1280__2.png" alt="bootstrap image slider"  id="wows2_1"/></li>
		<li><img src="assets/data2/images/web_1280__3.png" alt="Web 1280 – 3"  id="wows2_2"/></li>
	</ul></div>
	
	</div>	
	<script type="text/javascript" src="assets/engine2/wowslider.js"></script>
	<script type="text/javascript" src="assets/engine2/script.js"></script>
	<!-- End WOWSlider.com BODY section -->


	</section>
	
	

	
	
	
	
	
	

	<div class="container-fluid" id="about">
		<h1 style="text-align: center;margin-top:120px;color:#04456B;letter-spacing: 3px;font-weight:350 ">ABOUT US</h1>
		<p style="text-align: center;margin-top:25px;color:#04456B;font-weight:350;font-size: 18px;">A Place where a student can test its skills!</p>
		<p style="text-align:center;margin:25px 150px 15px 150px;color:#04456B;font-weight:350;font-size:16px;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fuga iusto placeat sed similique alias iure quidem reprehenderit ab, eligendi, dolores esse magnam? Cumque possimus alias, dicta quaerat magni, labore distinctio! ipsum dolor sit amet, consectetur adipisicing elit. Ducimus nobis veniam reprehenderit assumenda mollitia vel laudantium ratione error dolor sequi repudiandae voluptates obcaecati similique cumque repellendus non, porro, eos placeat.</p>
	</div>

	<footer id="contact" style="margin-top:150px;">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-sm-6">
					<div class="contact-left">


						<div class="contact-info" id="contact">
							<address style="margin-top: 30px;">
 									<strong>Headquaters</strong>
 									<p style="padding-top: 20px;">313,Evergreen CHS <br>
 									Airoli sector 15, <br>
 									New Bombay, <br>
 									Mumbai-55.
 									</p>
 								</address>

							<div class="phone-fax-email">
								<p>
									<strong>Phone:</strong> <span>(719)-778-8804</span>
									<br/>
									<strong>Fax:</strong> <span>(719)-778-8804 8890</span>
									<br/>
									<strong>Email:</strong> <span>info@Aptifier.in</span>
									<br/>
								</p>
							</div>
						</div>

					</div>
				</div>
				<div class="col-md-6 col-sm-6">
					<div class="contact-right">
						<h2 style="font-weight: 300;letter-spacing: 3px;color: white;padding-bottom: 20px;">Contact Us</h2>
						<form action="#">
							<input type="text" name="full-name" placeholder="Full Name" class="form-control">
							<input type="email" name="email" placeholder="Email Address" class="form-control">
							<textarea name="message" rows="3" placeholder="your message.." class="form-control"></textarea>

							<div class="send-btn"><a href="" class="btn" style="color:#066fac;background: #fff;font-weight:500;width:200px;">SEND</a></div>
						</form>
					</div>
				</div>
			</div>

		</div>


	</footer>
	<div class="row ">
		<div class="col-md-12 col-sm-6">
			<p class="copy" style="text-align:center;background:#08476E;color: white;letter-spacing: 2px;width: 100%;height:80px; padding-top: 30px;">Copyrights @ Aptifier, 2018</p>
		</div>

	</div>
</body>

</html>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                      
	
<?php
}
?>