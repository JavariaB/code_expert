<?php

session_start();

if (!isset($_SESSION['id']) || empty($_SESSION['id'])) header('Location: ../index.php');

$error = $success = ''; 
$errors = [];

$conn = mysqli_connect('localhost', 'root', '', 'code_expert');

try {
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		$errors = [];

		if (isset($_POST['name']) && !empty($_POST['name'])) {
			if (strlen($_POST['name']) < 3) {
				$errors['name'] = 'Name must be at least 3 characters long.';
			}
		} else {
			$errors['name'] = 'Name is required';
		}

		if (isset($_POST['phone']) && !empty($_POST['phone'])) {
			if (strlen($_POST['phone']) < 8 || !preg_replace('/[^0-9]/', '', $_POST['phone'])) {
				$errors['phone'] = 'Phone number is not valid.';
			}

			$result = $conn->query(sprintf('SELECT id FROM users WHERE phone = "%s" AND id != %d', $_POST['phone'], $_SESSION['id']));

			if (is_object($result) && $result->num_rows > 0) {
				$errors['phone'] = 'This phone has already taken.';
			}
		} else {
			$errors['phone'] = 'Phone number is required';
		}

		if (isset($_POST['disease']) && !empty($_POST['disease'])) {
			if (strlen($_POST['disease']) < 3) {
				$errors['disease'] = 'Disease name must be at least 3 characters long.';
			}
		}

		if (isset($_POST['address']) && !empty($_POST['address'])) {
			if (strlen($_POST['address']) < 3) {
				$errors['address'] = 'Address must be at least 3 characters long.';
			}
		} else {
			$errors['address'] = 'Address is required';
		}

		if (empty($errors)) {

			$sql = $conn->prepare('UPDATE users SET name = ?, phone = ?, disease = ?, address = ? where id = ?');

			if (!$sql) throw new Exception($conn->error);

			$sql->bind_param('ssssi', $_POST['name'], $_POST['phone'], $_POST['disease'], $_POST['address'], $_SESSION['id']);

			if (!$sql->execute()) throw new Exception($conn->error);
		
			$_SESSION['name'] = $_POST['name'];
			$_SESSION['phone'] = $_POST['phone'];
			$_SESSION['disease'] = $_POST['disease'];
			$_SESSION['address'] = $_POST['address'];

			$success = 'Profile updated successfully.';
		}
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

	<title>Fresh Organic - Profile</title>

	<base href="../">

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
		<div class="header-top-bar" Style="background-color: #08350C">
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
									<h2 class="mb-3">Profile</h2>

									<p class="mb-4">You can also update your profile from this page.</p>

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

									<ul class="nav nav-tabs" id="myTab" role="tablist">
											<li class="nav-item" role="presentation">
												<a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="true">Profile Information</a>
											</li>
											<li class="nav-item" role="presentation">
												<a class="nav-link" id="qr-tab" data-toggle="tab" href="#qr" role="tab" aria-controls="qr" aria-selected="false">Free Voucher</a>
											</li>
									</ul>

									<div class="tab-content" id="myTabContent">
										<div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
											<form class="pt-4" action="" method="post">
												<div class="row">
													<div class="col-3">
														<label for="name">Full Name <span class="text-danger">*</span></label>
													</div>
													<div class="col-9">
														<div class="form-group">
															<input name="name" id="name" type="text" class="form-control <?= empty($errors['name']) ?: 'invalid-input' ?>" value="<?= isset($_POST['name']) && $has_errors ? $_POST['name'] : $_SESSION['name'] ?>">
															<?php if (!empty($errors['name'])) : ?>
																<small class="text-danger"><?= $errors['name'] ?></small>
															<?php endif; ?>
														</div>
													</div>
												</div>

												<div class="row">
													<div class="col-3">
														<label for="email">Email Address <span class="text-danger">*</span></label>
													</div>
													<div class="col-9">
														<div class="form-group">
															<input id="email" type="email" class="form-control" value=" <?= $_SESSION['email'] ?>" readonly>
														</div>
													</div>
												</div>

												<div class="row">
													<div class="col-3">
														<label for="phone">Phone <span class="text-danger">*</span></label>
													</div>
													<div class="col-9">
														<div class="form-group">
															<input name="phone" id="phone" type="text" class="form-control <?= empty($errors['phone']) ?: 'invalid-input' ?>" value="<?= isset($_POST['phone']) && $has_errors ? $_POST['phone'] : $_SESSION['phone'] ?>">
															<?php if (!empty($errors['phone'])) : ?>
																<small class="text-danger"><?= $errors['phone'] ?></small>
															<?php endif; ?>
														</div>
													</div>
												</div>

												<div class="row">
													<div class="col-3">
														<label for="disease">Disease (if any)</label>
													</div>
													<div class="col-9">
														<div class="form-group">
															<input name="disease" id="disease" type="text" class="form-control <?= empty($errors['disease']) ?: 'invalid-input' ?>" value="<?= isset($_POST['disease']) && $has_errors ? $_POST['disease'] : $_SESSION['disease'] ?>">
															<?php if (!empty($errors['disease'])) : ?>
																<small class="text-danger"><?= $errors['disease'] ?></small>
															<?php endif; ?>
														</div>
													</div>
												</div>

												<div class="row">
													<div class="col-3">
														<label for="address">Address <span class="text-danger">*</span></label>
													</div>
													<div class="col-9">
														<div class="form-group">
															<input name="address" id="address" type="text" class="form-control <?= empty($errors['address']) ?: 'invalid-input' ?>" value="<?= isset($_POST['address']) && $has_errors ? $_POST['address'] : $_SESSION['address'] ?>">
															<?php if (!empty($errors['address'])) : ?>
																<small class="text-danger"><?= $errors['address'] ?></small>
															<?php endif; ?>
														</div>
													</div>
												</div>

												<div class="row">
													<div class="col-3"></div>
													<div class="col-9">
														<div>
															<input class="btn btn-main btn-round-full mt-2" name="submit" type="submit" Style="background-color: #08350C; border-color: #08350C" value="Update Profile"></input>
														</div>
													</div>
												</div>
											</form>
										</div>

										<div class="tab-pane fade" id="qr" role="tabpanel" aria-labelledby="qr-tab">
											<div class="text-center pt-2 about-block-item mb-5 mb-lg-0">
												<h4 class="mt-3">Free Vegan Food Voucher</h4>
												<p>You can scan this QR code at your nearby vegan restaurant to get amazing discounts. Enjoy!!</p>
												<img src="images/qr.jpg" width= 200px height= 200px alt="" class="img-fluid">
											</div>
										</div>
									</div>
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

</body>

</html>