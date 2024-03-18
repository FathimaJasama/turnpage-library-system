<?php

require_once('../layouts/Header.php');

// DB credentials.

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
    $newpassword = md5($_POST['newpassword']);

    // Check if the provided email exists in the database
    $sql = "SELECT EmailId FROM tblstudents WHERE EmailId = :email";
    $query = $dbh->prepare($sql);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);

    if($query->rowCount() > 0) {
        // Update the password for the provided email
        $sql = "UPDATE tblstudents SET Password = :newpassword WHERE EmailId = :email";
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


