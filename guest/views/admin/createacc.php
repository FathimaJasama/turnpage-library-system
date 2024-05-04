<?php
require_once('./../../config.php');
include __DIR__ . '/../../helpers/AppManager.php';
require_once __DIR__ . '/../../models/Student.php';

$sm = AppManager::getSM();
$error = $sm->getAttribute("error");

$studentModel = new Student();
$students = $studentModel->getAll();



$currentUrl = $_SERVER['SCRIPT_NAME'];

// Extract the last filename from the URL
$currentFilename = basename($currentUrl);  // e.g., "dashboard.php"
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
    <link rel="shortcut icon" href="<?= asset("assets/images/favicon.svg") ?>" />

    <!-- Title -->
    <title>Bootstrap</title>

    <!-- *************
			************ Common Css Files *************
		************ -->
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="<?= asset("assets/css/bootstrap.min.css") ?>" />

    <!-- Bootstrap font icons css -->
    <link rel="stylesheet" href="<?= asset("assets/fonts/bootstrap/bootstrap-icons.css") ?>" />

    <!-- Main css -->
    <link rel="stylesheet" href="<?= asset("assets/css/main.min.css") ?>" />

    <!-- *************
			************ Vendor Css Files *************
		************ -->

    <!-- Scrollbar CSS -->
    <link rel="stylesheet" href="<?= asset("assets/vendor/overlay-scroll/OverlayScrollbars.min.css") ?>" />

    <!-- Date Range CSS -->
    <link rel="stylesheet" href="<?= asset("assets/vendor/daterange/daterange.css") ?>" />

    <!-- Dropzone CSS -->
    <link rel="stylesheet" href="<?= asset("assets/vendor/dropzone/dropzone.min.css") ?>" />

    <!-- Login css -->
    <link rel="stylesheet" href="<?= asset("assets/css/login.css") ?>" />

    <link rel="stylesheet" href="<?= asset("assets/css/bootstrap.min.css") ?>" />

    <!-- Bootstrap font icons css -->
    <link rel="stylesheet" href="<?= asset("assets/fonts/bootstrap/bootstrap-icons.css") ?>" />

    <!-- Main css -->
    <link rel="stylesheet" href="<?= asset("assets/css/main.min.css") ?>" />

    <!-- Login css -->
    <link rel="stylesheet" href="<?= asset("assets/css/login.css") ?>" />
</head>

<!-- Main header ends -->

<!-- Content wrapper start -->

<!-- Modal -->

<body class="login-container text:align-centre">
    <!-- Login box start -->
    <div class="container">
        <div class="login-box rounded-5 p-4">
            <div class="login-form">
                <a href="#" class="login-logo mb-3">
                    <img src="<?= asset("assets/images/openbook3.PNG") ?>" alt="Crowdnub Admin" />
                    <div class="page-title d-none d-md-block">
                        <h4 class="m-0">Library<br>Management<br> System</h4>
                    </div>
                </a>
                <!-- <h5 class="fw-light mb-3">Sign up to access dashboard.</h5> -->
                <form id="create-student-form" action="<?= url('services/ajax_functions.php') ?>" enctype="multipart/form-data">
                    <input type="hidden" name="action" value="create_student">
                    <div class="modal-header">
                        <h5 class="fw-light mb-3 id=" exampleModalLabel1">Create an Account</h5>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col mb-3">
                                <label for="StudentId" class="form-label">NIC Number</label>
                                <input type="text" id="StudentId" name="StudentId" class="form-control" placeholder="Enter Student Id" required />
                            </div>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="Photo" class="form-label">Photo</label>
                            <input class="form-control" name="Photo" id="editPhoto" type="file" accept="image/*">
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="FullName" class="form-label">Student Name</label>
                                <input type="text" id="FullName" name="FullName" class="form-control" placeholder="Enter Name" required />
                            </div>
                        </div>
                        <div class="row g-1">
                            <div class="col mb-0">
                                <label for="EmailId" class="form-label">Email</label>
                                <input type="email" id="EmailId" name="EmailId" class="form-control" placeholder="xxxx@xxx.xx" required />
                            </div>
                        </div>
                        <div class="row g-2 mt-2">
                            <div class="col mb-0 form-password-toggle">
                                <label class="form-label" for="Password">Password</label>
                                <div class="input-group">
                                    <input type="password" name="Password" class="form-control" id="Password" placeholder="············" aria-describedby="basic-default-password2" required>
                                    <span id="basic-default-Password2" class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                            </div>
                            <div class="col mb-0 form-password-toggle">
                                <label class="form-label" for="basic-default-password12">Confirm Password</label>
                                <div class="input-group">
                                    <input type="password" name="confirm_password" class="form-control" id="basic-default-password12" placeholder="············" aria-describedby="basic-default-password2" required>
                                    <span id="basic-default-password2" class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="row g-1">
                            <div class="col mb-0">
                                <label for="MobileNumber" class="form-label">Mobile Number</label>
                                <input type="tel" id="MobileNumber" name="MobileNumber" class="form-control" placeholder="123-456-7890" required />
                            </div>
                        </div>
                        <div id="additional-fields"></div>
                        <div class="mb-3 mt-3">
                            <div id="alert-container"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Close
                        </button>
                        <button type="button" id="create-now" class="btn btn-primary">Save</button>
                    </div>
                </form>
                <div class="text-center pt-3">
                    <span>Already registered?</span>
                    <a href="<?= asset("views/auth/login-student.php") ?>" class="text-blue text-decoration-underline ms-2">
                        Sign in
                    </a>
                </div>
            </div>

        </div>
    </div>
    </div>

    </div>
    </div>



</body>


<?php require_once('../layouts/Footer.php');
?>
<script>
    $(document).ready(function() {
        $('#create-now').on('click', function() {
            // Get the form element
            var form = $('#create-student-form')[0];
            $('#create-student-form')[0].reportValidity();

            // Check form validity
            if (form.checkValidity()) {
                // Create a FormData object
                var formData = new FormData($('#create-student-form')[0]);

                // Perform AJAX request
                $.ajax({
                    url: $('#create-student-form').attr('action'),
                    type: 'POST',
                    data: formData,
                    contentType: false, // Don't set content type
                    processData: false, // Don't process the data
                    dataType: 'json',
                    success: function(response) {
                        showAlert(response.message, response.success ? 'green' : 'red');
                        if (response.success) {
                            $('#createStudentModal').modal('hide');
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        }
                    },
                    error: function(error) {
                        // Handle the error
                        console.error('Error submitting the form:', error);
                    },
                    complete: function(response) {
                        // This will be executed regardless of success or error
                        console.log('Request complete:', response);
                    }
                });
            } else {
                var message = ('Form is not valid. Please check your inputs.');
                showAlert(message, 'danger');
            }
        });

    });
</script>