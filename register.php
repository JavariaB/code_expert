<?php

session_start();

$error = $success = '';

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

		if (isset($_POST['email']) && !empty($_POST['email'])) {
			if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
				$errors['email'] = 'Email address must be a valid email.';
			}

			$result = $conn->query(sprintf('SELECT id FROM users WHERE email = "%s"', $_POST['email']));

			if (is_object($result) && $result->num_rows > 0) {
				$errors['email'] = 'This email has already registered. Login instead.';
			}
		} else {
			$errors['email'] = 'Email Address is required';
		}

		if (isset($_POST['phone']) && !empty($_POST['phone'])) {
			if (strlen($_POST['phone']) < 8 || !preg_replace('/[^0-9]/', '', $_POST['phone'])) {
				$errors['phone'] = 'Phone number is not valid.';
			}

			$result = $conn->query(sprintf('SELECT id FROM users WHERE phone = "%s"', $_POST['phone']));

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
		} else {
			$errors['disease'] = 'Please fill in the filed with either disease name or N/A';
		}

		if (isset($_POST['address']) && !empty($_POST['address'])) {
			if (strlen($_POST['address']) < 3) {
				$errors['address'] = 'address must be at least 3 characters long.';
			}
		} else {
			$errors['address'] = 'address is required';
		}

		if (isset($_POST['password']) && !empty($_POST['password'])) {
			if (strlen($_POST['password']) < 8) {
				$errors['password'] = 'Password must be at least 8 characters long.';
			}
			if (!preg_match('/[A-Z]+/', $_POST['password'])) {
				$errors['password'] = 'Password must include at least one upper case letter.';
			}
			if (!preg_match('/[a-z]+/', $_POST['password'])) {
				$errors['password'] = 'Password must include at least one lower case letter.';
			}
			if (!preg_match('/[0-9]+/', $_POST['password'])) {
				$errors['password'] = 'Password must include at least one number.';
			}
			if (!preg_match('/[^\w]+/', $_POST['password'])) {
				$errors['password'] = 'Password must include at least one special character.';
			}
		} else {
			$errors['password'] = 'Password is required';
		}

		if (!isset($_POST['confirm_password']) || empty($_POST['confirm_password'])) {
			$errors['confirm_password'] = 'Confirm password is required';
		}

		if (isset($_POST['password']) && !empty($_POST['password']) && isset($_POST['confirm_password']) && !empty($_POST['confirm_password']) && $_POST['password'] !== $_POST['confirm_password']) {
			$errors['confirm_password'] = 'Password must match the confirm password';
		}

		if (!isset($_POST['terms']) || empty($_POST['terms'])) {
			$errors['terms'] = 'Please read and accept the terms and condition';
		}

		if (empty($errors)) {

			$sql = $conn->prepare('INSERT INTO users (name, email, phone, disease, address, password) VALUES (?, ?, ?, ?, ?, ?)');

			if (!$sql) throw new Exception($conn->error);

			$hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

			$sql->bind_param('ssssss', $_POST['name'], $_POST['email'], $_POST['phone'], $_POST['disease'], $_POST['address'], $hashed_password);

			if (!$sql->execute()) {
				throw new Exception($conn->error);
			}

			$success = 'Your account has been created successfully. You can now <b><a href="login.php">login</a></b>';
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

	<title>Fresh Organic - Register</title>

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

	<section class="contact-form-wrap section pt-5">
		<div class="container">

			<div class="row justify-content-center">
				<div class="col-lg-6">
					<div class="section-title text-center mb-4">
						<h2 class="text-md mb-2" Style="color: #08350C">Registraion Form</h2>
						<div class="divider mx-auto my-4"></div>
						<p Style="color: #08350C">Fill out the fields carefully for registration.</p>
					</div>
				</div>
			</div>

			<?php if (!empty($success)) : ?>
				<div class="row justify-content-md-center">
					<div class="col-8">
						<div class="alert alert-success contact__msg" role="alert">
							<strong>Success: </strong><?= $success ?>
						</div>
					</div>
				</div>
			<?php endif; ?>

			<?php if (!empty($error)) : ?>
				<div class="row justify-content-md-center">
					<div class="col-8">
						<div class="alert alert-danger contact__msg" role="alert">
							<strong>Error: </strong><?= $error ?>
						</div>
					</div>
				</div>
			<?php endif; ?>

			<div class="row justify-content-md-center mt-3">
				<div class="col-lg-8 col-md-8 col-sm-8">
					<form id="registration-form" class="contact__form" method="post" action="">
						<div class="form-group">
							<label for="name">Full Name <span class="text-danger">*</span></label>
							<input name="name" id="name" type="text" placeholder="Enter your full name" class="form-control <?= empty($errors['name']) ?: 'invalid-input' ?>" value="<?= isset($_POST['name']) && $has_errors ? $_POST['name'] : '' ?>">
							<?php if (!empty($errors['name'])) : ?>
								<small class="text-danger"><?= $errors['name'] ?></small>
							<?php endif; ?>
						</div>
						<div class="form-group">
							<label for="email">Email Address <span class="text-danger">*</span></label>
							<input name="email" id="email" type="email" class="form-control <?= empty($errors['email']) ?: 'invalid-input' ?>" placeholder="Enter your email address" value="<?= isset($_POST['email']) && $has_errors ? $_POST['email'] : '' ?>">
							<?php if (!empty($errors['email'])) : ?>
								<small class="text-danger"><?= $errors['email'] ?></small>
							<?php endif; ?>
						</div>
						<div class="form-group">
							<label for="phone">Phone <span class="text-danger">*</span></label>
							<input name="phone" id="phone" type="text" class="form-control <?= empty($errors['phone']) ?: 'invalid-input' ?>" placeholder="Enter your phone number" value="<?= isset($_POST['phone']) && $has_errors ? $_POST['phone'] : '' ?>">
							<?php if (!empty($errors['phone'])) : ?>
								<small class="text-danger"><?= $errors['phone'] ?></small>
							<?php endif; ?>
						</div>
						<div class="form-group">
							<label for="disease">Disease (If any)<span class="text-danger">*</span></label>
							<input name="disease" id="disease" type="text" class="form-control <?= empty($errors['disease']) ?: 'invalid-input' ?>" placeholder="Enter the disease name if you have any or write N/A if you do not!" value="<?= isset($_POST['disease']) && $has_errors ? $_POST['disease'] : '' ?>">
							<?php if (!empty($errors['disease'])) : ?>
								<small class="text-danger"><?= $errors['disease'] ?></small>
							<?php endif; ?>
						</div>
						<div class="form-group">
							<label for="address">Address<span class="text-danger">*</span></label>
							<input name="address" id="address" type="text" class="form-control <?= empty($errors['address']) ?: 'invalid-input' ?>" placeholder="Enter the address" value="<?= isset($_POST['address']) && $has_errors ? $_POST['address'] : '' ?>">
							<?php if (!empty($errors['address'])) : ?>
								<small class="text-danger"><?= $errors['address'] ?></small>
							<?php endif; ?>
						</div>
						<div class="form-group">
							<label for="password">Password <span class="text-danger">*</span></label>
							<input name="password" id="password" type="password" class="form-control <?= empty($errors['password']) ?: 'invalid-input' ?>" placeholder="Enter new password">
							<?php if (!empty($errors['password'])) : ?>
								<small class="text-danger"><?= $errors['password'] ?></small>
							<?php endif; ?>
						</div>
						<div class="form-group">
							<label for="confirm_password">Confirm Password <span class="text-danger">*</span></label>
							<input name="confirm_password" id="confirm_password" type="password" class="form-control <?= empty($errors['confirm_password']) ?: 'invalid-input' ?>" placeholder="Re-enter the password">
							<?php if (!empty($errors['confirm_password'])) : ?>
								<small class="text-danger"><?= $errors['confirm_password'] ?></small>
							<?php endif; ?>
						</div>
						<div class="form-group">
							<input name="terms" id="terms" type="checkbox" value="1" <?= isset($_POST['terms']) && isset($_POST['terms'])  == 1 && $has_errors ? 'checked' : '' ?> required>
							<label for="terms"> I agree the <a href="javascript:void(0);">Terms</a> and <a href="javascript:void(0);">Conditions</a>.</label>
							<?php if (!empty($errors['terms'])) : ?>
								<br><small class="text-danger"><?= $errors['terms'] ?></small>
							<?php endif; ?>
						</div>

						<div class="text-center">
							<input class="btn btn-main btn-round-full" name="submit" type="submit" Style="background-color: #08350C; border-color: #08350C" value="Register"></input>
						</div>
					</form>

					<div class="row">
						<div class="col-12 text-center mt-4">
							<p Style="color: #08350C">Already registered? <a href="login.php">Login</a></p>
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