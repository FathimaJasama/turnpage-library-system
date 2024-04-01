<?php

require_once('../layouts/Header.php');

// DB credentials.

$pm = AppManager::getPM();
$sm = AppManager::getSM();

$email = $_POST['email'];
$password = $_POST['password'];

if (empty($email) || empty($password)) {
    $sm->setAttribute("error", 'Please fill all required fields!');
    header("Location: " . $_SERVER['HTTP_REFERER']);
} else {
    $param = array(':email' => $email);


$message = ''; // Initialize an empty variable to store alert messages.

if(isset($_POST['submit'])) {
    $email = $_POST['email'];
    $newpassword = md5($_POST['newpassword']);

    // Check if the provided email exists in the database
    $param = array(':email' => $EmailId);
    $sql = $pm->run("SELECT EmailId FROM students WHERE EmailId = :email");
    $query = $dbh->prepare($sql);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    if($query->rowCount() > 0) {
        // Update the password for the provided email
        $password = $pm->run("UPDATE students SET Password = :newpassword WHERE EmailId = :email");
        if ($password != null) {
    
        $message = "Your password has been successfully changed.";
    } else {
        $message = "Email does not exist.";
    }
}

?>

<div class="content-wrapper-scroll">
	<!-- Main header starts -->
	<div class="main-header d-flex align-items-center justify-content-between position-relative">
						<div class="d-flex align-items-center justify-content-center">
							<div class="page-icon">
								<i class="bi bi-file-person-fill"></i>
							</div>
							<div class="page-title d-none d-md-block">
								<h5>Change Password</h5>
							</div>
						</div>
					</div>
					<!-- Main header ends -->

		<!-- Content wrapper start -->
		<div class="content-wrapper">
        <div class="col-sm-12 col-12">

            <!-- Login box start -->
                <form method="post" action="">
                <div class="login-box rounded-2 p-5">
                    <div class="login-form">
                    
                    
                    <?php if(!empty($message)): ?>
                        <div class="alert alert-primary fade show" <?php echo ($message === "Your password has been successfully changed.") ? "green" : "red"; ?> role="alert">
                        <?php echo $message; ?>
                        </div>
                        <?php endif; ?>
                        <div class="mb-3">
                            <label class="form-label"  >Your Email</label>
                            <input type="text" class="form-control" name="email" placeholder="Enter your email" required />
                        </div>
                        <div class="mb-3">
                        <label class="form-label">New Password</label>
                        <input type="password" class="form-control" name="newpassword" placeholder="Enter new password" required />
                        </div>
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

                    				
<?php
require_once('../layouts/Footer.php');
?>
</html>


