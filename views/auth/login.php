<?php

require_once('./../../config.php');
include __DIR__ . '/../../helpers/AppManager.php';

$sm = AppManager::getSM();
$error = $sm->getAttribute("error");

?>

<!DOCTYPE html>
<html lang="en">

	<head>
		<!-- Required meta tags -->
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

		<!-- Meta -->
		<meta name="description" content="Sapphire - Responsive Bootstrap 5 Dashboard Template" />
		<meta name="author" content="Bootstrap Gallery" />
		<link rel="canonical" href="https://www.bootstrap.gallery/">
		<meta property="og:url" content="https://www.bootstrap.gallery">
		<meta property="og:title" content="Admin Templates - Dashboard Templates | Bootstrap Gallery">
		<meta property="og:description" content="Marketplace for Bootstrap Admin Dashboards">
		<meta property="og:type" content="Website">
		<meta property="og:site_name" content="Bootstrap Gallery">
		<link rel="shortcut icon" href="<?=asset("assets/images/favicon.svg")?>" />

		<!-- Title -->
		<title>Bootstrap</title>

		<!-- *************
			************ Common Css Files *************
		************ -->
		<!-- Bootstrap css -->
		<link rel="stylesheet" href="<?=asset("assets/css/bootstrap.min.css") ?>"/>

		<!-- Bootstrap font icons css -->
		<link rel="stylesheet" href="<?=asset("assets/fonts/bootstrap/bootstrap-icons.css")?>" />

		<!-- Main css -->
		<link rel="stylesheet" href="<?=asset("assets/css/main.min.css")?>" />

		<!-- Login css -->
		<link rel="stylesheet" href="<?=asset("assets/css/login.css")?>" />
	</head>

	

	<body class="login-container">
		<!-- Login box start -->
		<div class="container">
				<div class="login-box rounded-2 p-5">
					<div class="login-form">
						<a href="index.html" class="login-logo mb-3">
							<img src="<?=asset("assets/images/openbook3.PNG")?>" alt="Crowdnub Admin"/>   <div class="page-title d-none d-md-block"><h4  class="m-0" >Library<br>Management<br> System</h4 ></div>
						</a>
						<h5 class="fw-light mb-3">Sign in to access dashboard.</h5>
						<form id="formAuthentication" class="mb-3" action="../../services/auth.php" method="post">
						<div class="mb-3">
							<label for="email" class="form-label">Your Email</label>
							<input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" autofocus required />
						</div>
						<div class="mb-3">
							<label class="form-label">Your Password</label>
							<input type="password" class="form-control" name="password" id="password" placeholder="Enter password" aria-describedby="password" required />
						</div>
						
                        <?php if (!empty($error)) : ?>
                    <div class="text-red font-x"><?= ($error ?? "") ?></div>
                    <?php endif; ?>
						<div class="d-flex align-items-center justify-content-between">
							<div class="form-check m-0">
								<input class="form-check-input" type="checkbox" value="" id="rememberPassword" />
								<label class="form-check-label" for="rememberPassword">Remember</label>
							</div>
							<a href="forgot-password.html" class="text-blue text-decoration-underline">Lost password?</a>
						</div>
						<div class="d-grid py-3">
							<button type="submit" class="btn btn-lg btn-primary">
								Login
							</button>
						</div>
					
						<!-- <div class="d-flex gap-2 justify-content-center">
							<button type="submit" class="btn btn-outline-light">
								<img src="assets/images/google.svg" class="login-icon" alt="Login with Google" />
							</button>
							<button type="submit" class="btn btn-outline-light">
								<img src="assets/images/facebook.svg" class="login-icon" alt="Login with Facebook" />
							</button>
						</div> -->
						<div class="text-center pt-3">
							<span>Not registered?</span>
							<a href="signup.html" class="text-blue text-decoration-underline ms-2">
								Create an account</a>
						
                   
					</div>
				</div>
                
			</form>
		</div>
		<!-- Login box end -->
	</body>

</html>