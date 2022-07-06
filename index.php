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


	<!-- footer Start -->
	<footer class="footer section bg" style="border-top: 1px solid black;">
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