<?php

include __DIR__ . '/../../config.php';
include __DIR__ . '/../../helpers/AppManager.php';

$pm = AppManager::getPM();
$sm = AppManager::getSM();

$error = $sm->getAttribute("error");



if(isset($_POST['submit'])) {

    $email = $_POST['EmailId'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    // Validation checks
    if (empty($email) || empty($newPassword) || empty($confirmPassword)) {
        $sm->setAttribute("error", 'Please fill all required fields!');
        header("Location:" . $_SERVER['HTTP_REFERER']);
        exit;
    }

    if ($newPassword !== $confirmPassword) {
        $sm->setAttribute("error", 'New password and confirm password do not match!');
        header("Location:" . $_SERVER['HTTP_REFERER']);
        exit;
    }

    // Check if the email exists in the database
    $param = array(':EmailId' => $email);
    $student = $pm->run("SELECT * FROM students WHERE EmailId = :EmailId", $param, true);

    if ($student != null) {
        // Hash the new password
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Update the password in the database
        $updateParam = array(':EmailId' => $email, ':password' => $hashedPassword);
        $pm->run("UPDATE students SET Password = :password WHERE EmailId = :EmailId", $updateParam);

        // Set success message
        $sm->setAttribute("success", 'Password changed successfully!');
        header('Location:' . $_SERVER['HTTP_REFERER']);
        exit;
    } else {
        // If email is not found in the database, show error
        $sm->setAttribute("error", 'Invalid email address!');
        header("Location:" . $_SERVER['HTTP_REFERER']);
        exit;
    }


if(isset($_POST['submit'])) {
    // Validation, database interaction, and password update logic remains the same as before
    if (!empty($error) || !empty($success)) {
        // If error or success messages are already set, do not override them
        header("Location:" . $_SERVER['HTTP_REFERER']);
        exit;
    }
}
}
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
		<title>Bootstrap Gallery - Admin Dashboards</title>

		<!-- *************
			************ Common Css Files *************
		************ -->
		<!-- Bootstrap css -->
        <link rel="stylesheet" href="<?=asset("assets/css/bootstrap.min.css")?>" />

<!-- Bootstrap font icons css -->
        <link rel="stylesheet" href="<?=asset("assets/fonts/bootstrap/bootstrap-icons.css")?>" />

<!-- Main css -->
        <link rel="stylesheet" href="<?=asset("assets/css/main.min.css")?>" />

<!-- *************
    ************ Vendor Css Files *************
************ -->

<!-- Scrollbar CSS -->
        <link rel="stylesheet" href="<?=asset("assets/vendor/overlay-scroll/OverlayScrollbars.min.css")?>" />

<!-- Date Range CSS -->
        <link rel="stylesheet" href="<?=asset("assets/vendor/daterange/daterange.css")?>" />

<!-- Dropzone CSS -->
        <link rel="stylesheet" href="<?=asset("assets/vendor/dropzone/dropzone.min.css")?>" />

<!-- Login css -->
        <link rel="stylesheet" href="<?=asset("assets/css/login.css")?>" />

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

					<a href="#" class="login-logo mb-3">
							<img src="<?=asset("assets/images/openbook3.PNG")?>" alt="Crowdnub Admin"/>   <div class="page-title d-none d-md-block"><h4  class="m-0" >Library<br>Management<br> System</h4 ></div>
						</a>
						<h5 class="fw-light mb-5">
							In order to access your account, please enter the email id you
							provided during the registration process.
						</h5>
                    </div>
                    <form id="formAuthentication"0 class="mb-3" action="" method="post">

                        <div class="mb-3">
                            <label class="EmailId"  >Your Email</label>
                            <input type="text" class="form-control" id="EmailId" name="EmailId" placeholder="Enter your email" required />
                        </div>
                        <div class="mb-3">
                        <label class="newPassword">New Password</label>
                        <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="Enter new password" required />
                        </div>
                        <div class="mb-3">
                        <label class="confirmPassword">Confirm Password</label>
                        <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Enter new password" required />
                        </div>
                        <div id="additional-fields"></div>
                    					<div class="mb-3 mt-3">
                        					<div id="alert-container">
											</div>
                    					</div>
                        <?php if (!empty($error)) : ?>
                    <div class="text-red font-x"><?= ($error ?? "") ?></div>
                    <?php endif; ?>
                        <div class="d-grid pt-3">
                        <button type="submit" class="btn btn-lg btn-primary" name="submit">Submit</button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
</div>
<!-- Content wrapper scroll end -->

</html>                 				




