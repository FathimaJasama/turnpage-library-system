<?php
include __DIR__ . '/../../config.php';
include __DIR__ . '/../../helpers/AppManager.php';

// Establish database connection.
try
{
$dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME,DB_USERNAME, DB_PASSWORD,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
}
catch (PDOException $e)
{
exit("Error: " . $e->getMessage());
}

$message = ''; // Initialize an empty variable to store alert messages.

if(isset($_POST['submit'])) {
    $email = $_POST['email'];
    $newpassword = password_hash($_POST['newpassword'], PASSWORD_DEFAULT);

    // Check if the provided email exists in the database
    $sql = "SELECT EmailId FROM students WHERE EmailId = :email";
    $query = $dbh->prepare($sql);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    if($query->rowCount() > 0) {
        // Update the password for the provided email
        $sql = "UPDATE students SET Password = :newpassword WHERE EmailId = :email";
        $chngpwd = $dbh->prepare($sql);
        $chngpwd->bindParam(':email', $email, PDO::PARAM_STR);
        $chngpwd->bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
        $chngpwd->execute();
        $message = "Your password has been successfully changed.";
    } else {
        $message = "Email does not exist.";
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
		<link rel="shortcut icon" href="<?=asset("assets/images/openbook4.png")?>" />

		<!-- Title -->
		<title>TurnPage Library System</title>

		<!-- *************
			************ Common Css Files *************
		************ -->
		<!-- Bootstrap css -->
		<link rel="stylesheet" href="<?=asset("assets/css/bootstrap.min.css")?>" />

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
        <form method="post" action="">
				<div class="login-box rounded-2 p-5">
					<div class="login-form">

					<a href="#" class="login-logo mb-3">
							<img src="<?=asset("assets/images/openbook3.PNG")?>" alt="Crowdnub Admin"/>   <div class="page-title d-none d-md-block"><h4  class="m-0" >Library<br>Management<br> System</h4 ></div>
						</a>
						<h5 class="fw-light mb-5">
							In order to access your account, please enter the email id you
							provided during the registration process.
						</h5>
						<div class="mb-3">
							<label class="form-label">Your Email</label>
							<input type="text" class="form-control" id=email name=email placeholder="Enter your email" />
						</div>
						</div>
                        <div class="mb-3">
                        <label class="form-label">New Password</label>
                        <input type="password" class="form-control" id="newpassword" name="newpassword" placeholder="Enter new password" required />
                        </div>
						<?php if(!empty($message)): ?>
                        <div class="alert alert-primary fade show" <?php echo ($message === "Your password has been successfully changed.") ? "green" : "red"; ?> role="alert">
                        <?php echo $message; ?>
                        </div>
                        <?php endif; ?>
                        <div class="d-grid pt-3">
                        <button type="submit" class="btn btn-lg btn-primary" name="submit">Submit</button>
                        </div>
					</div>
				</div>
			</form>
		</div>
		<!-- Login box end -->
	</body>

</html>

<?php
require_once('../layouts/Footer.php');
?>
