<?php

session_start();

if (!isset($_SESSION['id']) || empty($_SESSION['id'])) header('Location: ../../index.php');

$error = $success = '';

$conn = mysqli_connect('localhost', 'root', '', 'code_expert');

try {
	$hasId = isset($_GET['id']) && !empty($_GET['id']);

    if ($hasId) {
	    $sql = "SELECT * FROM alternative WHERE parent_id =".$_GET['id'];
	    $result = $conn->query($sql);
	} else {
	    $sql = "SELECT * FROM food";
	    $result = $conn->query($sql);
	}
} catch (Exception $e) {
	$error = $e->getMessage();
} finally {
	$conn->close();
}



$has_errors = !empty($error) || !empty($errors);

?>

<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

	<title>Fresh Organic - Food Alternatives</title>

	<base href="../../">

	<!-- favicon -->
	<link rel="shortcut icon" type="image/x-icon" href="/images/favicon.ico" />

	<!-- bootstrap.min css -->
	<link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.min.css">

	<!-- Icon Font Css -->
	<link rel="stylesheet" href="plugins/icofont/icofont.min.css">

	<!-- Slick Slider  CSS -->
	<link rel="stylesheet" href="plugins/slick-carousel/slick/slick.css">
	<link rel="stylesheet" href="plugins/slick-carousel/slick/slick-theme.css">

	<!-- Bootstrap datepicker -->
	<link rel="stylesheet" href="plugins/bs-datepicker/css/bootstrap-datepicker3.standalone.css">

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

	<section class="section blog-wrap pt-5">
		<div class="container">
			<div class="row">
				<div class="col-lg-3">
					<div class="sidebar-wrap pl-lg-4 mt-5 mt-lg-0">

					<div class="sidebar-widget category mb-3">
							<h5 class="mb-4">Navigation</h5>

							<ul class="list-unstyled">
								<li class="align-items-center">
									<a href="admin/profile.php">Profile</a>
								</li>
								<li class="align-items-center">
									<a href="admin/change-password.php">Change Password</a>
								</li>
								<li class="align-items-center">
									<a href="admin/diet/add.php">Add New Diet Plan</a>
								</li>
								<li class="align-items-center">
									<a href="admin/diet/list.php">Diet Plan List</a>
								</li>
								<li class="align-items-center">
									<a href="admin/diet/food.php">Food Alternatives</a>
								</li>
							</ul>
						</div>

					</div>
				</div>

				<div class="col-lg-9">
					<div class="row">
						<div class="col-lg-12 col-md-12 mb-5">
							<div class="blog-item">
								<div class="blog-item-content">
									<h2 class="mb-3">Food Alternatives</h2>

									<p class="mb-4">Select your favourite food and find new favourites with better health factors!!</p>

									<?php if ($hasId) { ?>
									<p>
										<a href="admin/diet/food.php">< Go Back</a>
									</p>
									<?php } ?>

									<?php if (!empty($success)) : ?>
										<div class="row justify-content-md-center mb-3">
											<div class="col-12">
												<div class="alert alert-success contact__msg" role="alert">
													<strong>Success: </strong><?= $success ?>
												</div>
											</div>
										</div>
									<?php endif; ?>

									<?php if (!empty($error)) : ?>
										<div class="row justify-content-md-center mb-3">
											<div class="col-12">
												<div class="alert alert-danger contact__msg" role="alert">
													<strong>Error: </strong><?= $error ?>
												</div>
											</div>
										</div>
									<?php endif; ?>

									<?php if ($result->num_rows > 0) { ?>
									<div class="row">
										<?php while($food = $result->fetch_assoc()) { ?>
										<div class="col-lg-3 col-md-6">
											<?php if ($hasId) { ?>
											<div class="about-block-item mb-5 mb-lg-0">
												<img src="<?=$food['url']?>" alt="" class="img-fluid w-100">
												<h4 class="mt-3"><?=$food['name']?></h4>
											</div>
											<?php } else { ?>
											<a href="admin/diet/food.php?id=<?=$food['id']?>">
												<div class="about-block-item mb-5 mb-lg-0">
													<img src="<?=$food['url']?>" alt="" class="img-fluid w-100">
													<h4 class="mt-3"><?=$food['name']?></h4>
												</div>
											</a>
											<?php } ?>
										</div>
										<?php } ?>
									</div>
									<?php } ?>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

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

	<!-- Bootstrap datepicker -->
	<script src="plugins/bs-datepicker/js/bootstrap-datepicker.min.js"></script>

	<script>
		$(function() {
			$('#dob').datepicker({
				format: "dd-M-yyyy",
				endDate: "date()",
				autoclose: true,
				todayHighlight: true
			});
		});
	</script>

</body>

</html>