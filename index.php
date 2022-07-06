<?php session_start(); ?>

<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

	<title>Fresh Organic - Home</title>

	<!-- favicon -->
	<link rel="shortcut icon" type="image/x-icon" href="/images/favicon.ico" />

	<!-- bootstrap.min css -->
	<link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.min.css">

	<!-- Icon Font Css -->
	<link rel="stylesheet" href="plugins/icofont/icofont.min.css">

	<!-- Slick Slider  CSS -->
	<link rel="stylesheet" href="plugins/slick-carousel/slick/slick.css">
	<link rel="stylesheet" href="plugins/slick-carousel/slick/slick-theme.css">

	<!-- Main Stylesheet -->
	<link rel="stylesheet" href="css/style.css">

</head>

<body id="top" Style="background-color: #E0F5C9">

	<header>
		<div class="header-top-bar" Style="background-color: #08350C ">
			<div class="container">
				<div class="row align-items-center">
				<div class="col-lg-6">
					</div>
					<div class="col-lg-6">
					<div class="text-lg-right top-right-bar mt-2 mt-lg-0">
							<?php if (isset($_SESSION['id']) && !empty($_SESSION['id'])) : ?>
								<a href="admin/profile.php" class="pr-3"><span>Welcome <?= ucwords($_SESSION['name']) ?>!</span></a>
								<a href="logout.php" class="pr-3"><span>Logout</span></a>
							<?php else : ?>
								<a href="login.php" class="pr-3"><span>Login</span></a>
								<a href="register.php" class="pr-3"><span>Register</span></a>
							<?php endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<nav class="navbar navbar-expand-lg navigation" id="navbar">
			<div class="container">
				<a class="navbar-brand" href="index.php">
					<img src="images/veganlogo.jpg" width= 100px height= 50px alt="" class="img-fluid">
				</a>
			</div>
		</nav>
	</header>

	<!-- Slider Start -->
	<section class="banner">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-12 col-xl-7">
					<div class="block">
						
					<span class="text-uppercase text-sm letter-spacing "> Your diet our responsibility  </span>
					<h1 class="mb-3 mt-3" > Your most trusted diet partner </h1>

					<p class="mb-4 pr-5"> Healthy diet leads to healthy lifestyle. Do you want to move forward towards a healthy living? Then what are you waiting for?</p>
						
					<div class="btn-container ">
							<a href="login.php"  class="btn btn-main-2 btn-icon btn-round-full" Style="background-color: #08350C; border-color: #08350C">Let's get started!<i class="icofont-simple-right ml-2  "></i></a>
					</div>

					</div>
				</div>
			</div>
		</div>
	</section>


	<div style=padding:50px;>
	</div>


	<!--Features-->
	<section class="fetaure-page ">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-6">
					<div class="about-block-item mb-5 mb-lg-0">
						<img src="images/about/about-1.jpg" alt="" class="img-fluid w-100">
						<h4 class="mt-3">lighter and healthier</h4>
						<p>Vegan diet promotes weight loss. Enjoy feeling light, healthy and pretty.</p>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="about-block-item mb-5 mb-lg-0">
						<img src="images/about/about-2.jpg" alt="" class="img-fluid w-100">
						<h4 class="mt-3">Happy Heart</h4>
						<p>Vegan diet reduces risk of heart diseases by reducing cholestrol level.</p>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="about-block-item mb-5 mb-lg-0">
						<img src="images/about/about-3.jpg" alt="" class="img-fluid w-100">
						<h4 class="mt-3">Diabetes control</h4>
						<p>Vegan diet manages diabetes by lowering A1C levels.</p>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<div class="about-block-item">
						<img src="images/about/about-4.jpg" alt="" class="img-fluid w-100">
						<h4 class="mt-3">Happy life</h4>
						<p>Vegan diet lowers your chances of getting certain types of cancer, such as colon cancer.</p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<div style=padding:50px;>
	</div>


	<!--Slider-->
	<div class="container">
		<div class="section-title text-center">
			<h2 Style="color: #08350C">Users Reviews</h2>
		</div>
			<div class="row align-items-center">
				<div class="col-lg-12 testimonial-wrap-2">
					<div class="testimonial-block style-2  gray-bg">
						<i class="icofont-quote-right"></i>

						<div class="testimonial-thumb">
							<img src="images/team/test-thumb1.jpg" alt="" class="img-fluid">
						</div>

						<div class="client-info ">
							<h4>Amazing service!</h4>
							<span>Hashim Kardar</span>
							<p>
								I enjoyed using this website. The system is easy to use and helped me stay up-to-date.
							</p>
						</div>
					</div>

					<div class="testimonial-block style-2  gray-bg">
						<div class="testimonial-thumb">
							<img src="images/team/test-thumb2.jpg" alt="" class="img-fluid">
						</div>

						<div class="client-info">
							<h4>best Motivation!</h4>
							<span>Abdar Ubaid</span>
							<p>
								Interactive design for motivation, helped me to follow vegan diet.
							</p>
						</div>

						<i class="icofont-quote-right"></i>
					</div>

					<div class="testimonial-block style-2  gray-bg">
						<div class="testimonial-thumb">
							<img src="images/team/test-thumb3.jpg" alt="" class="img-fluid">
						</div>

						<div class="client-info">
							<h4>Good Support!</h4>
							<span>Saadi Yousuf</span>
							<p>
								They provide great service facility. Its easy to contact them and they replay in time.
							</p>
						</div>

						<i class="icofont-quote-right"></i>
					</div>

					<div class="testimonial-block style-2  gray-bg">
						<div class="testimonial-thumb">
							<img src="images/team/test-thumb4.jpg" alt="" class="img-fluid">
						</div>

						<div class="client-info">
							<h4>Nice Environment!</h4>
							<span>Maryam Noor</span>
							<p class="mt-4">
								Overall website's enviroment is user friendly and easy to follow up.
							</p>
						</div>
						<i class="icofont-quote-right"></i>
					</div>

					<div class="testimonial-block style-2  gray-bg">
						<div class="testimonial-thumb">
							<img src="images/team/test-thumb1.jpg" alt="" class="img-fluid">
						</div>

						<div class="client-info">
							<h4>Useful suggestions!</h4>
							<span>Hassan Raza</span>
							<p>
								Best website to find alternatives of Pakistani traditional foods. Highly recommended.
							</p>
						</div>
						<i class="icofont-quote-right"></i>
					</div>
				</div>
			</div>
		</div>

	
	 <div style=padding:100px;>
	</div>

	<!-- footer Start -->
	<footer class="footer section bg" style="border-top: 1px solid black;">
		<div class="container">
			<div class="row">
				<div class="col-lg-4 mr-auto col-sm-6">
					<div class="widget mb-5 mb-lg-0">
						<div class="logo mb-4">
							<img src="images/veganlogo.jpg" width= 150px height= 100px alt="" class="img-fluid">
						</div>

						<p>Our goal is to preserve nature and to provide a full meat sensation diet for food lovers. Live long, eat vegan.</p>

						<ul class="list-inline footer-socials mt-4">
							<li class="list-inline-item">
								<a href="javascript:void(0);">
									<i class="icofont-facebook"></i>
								</a>
							</li>
							<li class="list-inline-item">
								<a href="javascript:void(0);">
									<i class="icofont-twitter"></i>
								</a>
							</li>
							<li class="list-inline-item">
								<a href="javascript:void(0);">
									<i class="icofont-linkedin"></i>
								</a>
							</li>
						</ul>
					</div>
				</div>	

				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="widget widget-contact mb-5 mb-lg-0">
						<h4 class="text-capitalize mb-3" Style="color: #08350C">Get in Touch</h4>
						<div class="divider mb-4" Style="background-color: #08350C"></div>

						<div class="footer-contact-block mb-4">
							<div class="icon d-flex align-items-center">
								<i class="icofont-email mr-3"></i>
								<span class="h6 mb-0">Support Available for 24/7</span>
							</div>
							<h4 class="mt-2"><a href="tel:+23-345-67890">support@domain.com</a></h4>
						</div>

						<div class="footer-contact-block">
							<div class="icon d-flex align-items-center">
								<i class="icofont-support mr-3"></i>
								<span class="h6 mb-0">Mon to Fri : 08:30 - 18:00</span>
							</div>
							<h4 class="mt-2"><a href="tel:+23-345-67890">+92-123-4567</a></h4>
						</div>
					</div>
				</div>
			</div>

			<div class="footer-btm py-4 mt-5">
				<div class="row align-items-center justify-content-between">
					<div class="col-lg-6">
						<div class="copyright">
							&copy; Copyright Reserved, <?= date('Y') ?>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-lg-4">
						<a class="backtop js-scroll-trigger" href="#top" Style="background-color: #08350C">
							<i class="icofont-long-arrow-up"></i>
						</a>
					</div>
				</div>
			</div>
		</div>
	</footer>

	<!-- Main jQuery -->
	<script src="plugins/jquery/jquery.js"></script>

	<!-- Bootstrap 4.3.2 -->
	<script src="plugins/bootstrap/js/popper.js"></script>
	<script src="plugins/bootstrap/js/bootstrap.min.js"></script>
	<script src="plugins/counterup/jquery.easing.js"></script>

	<!-- Slick Slider -->
	<script src="plugins/slick-carousel/slick/slick.min.js"></script>

	<!-- Counterup -->
	<script src="plugins/counterup/jquery.waypoints.min.js"></script>

	<script src="plugins/shuffle/shuffle.min.js"></script>
	<script src="plugins/counterup/jquery.counterup.min.js"></script>


	<script src="js/script.js"></script>

</body>

</html>