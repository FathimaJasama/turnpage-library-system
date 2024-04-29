<?php
require_once('../layouts/Header.php');
require_once __DIR__ . '/../../models/Issuebook.php';

$sm = AppManager::getSM();
$error = $sm->getAttribute("error");

$issuebookModel = new Issuebook();
$issuebooks = $issuebookModel->getAll();



$currentUrl = $_SERVER['SCRIPT_NAME'];

// Extract the last filename from the URL
$currentFilename = basename($currentUrl);  // e.g., "dashboard.php"
?>
<div class="content-wrapper-scroll">

    <!-- Main header starts -->
    <div class="main-header d-flex align-items-center justify-content-between position-relative">
        <div class="d-flex align-items-center justify-content-center">
            <div class="page-icon">
                <i class="bi bi-file-person-fill"></i>
            </div>
            <div class="page-title d-none d-md-block">
                <h5>Add Author</h5>
            </div>
        </div>

    </div>

    <div class="content-wrapper">
        <div class="subscribe-header">
            <section class="content m-3">
                <div class="container-fluid">
                    <div class="card">
                        <div class="row gx-3">
                            <div class="col-xxl-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-title">Form Layout</div>
                                    </div>
                                    <div class="card-body">
                                        <!-- Row start -->
                                        <div class="row gx-3">
                                            <div class="col-xxl-3 col-lg-3 col-sm-4 col-12">
                                                <div class="mb-3">
                                                    <form id="create-issuebook-form" action="<?= url('services/ajax_functions.php') ?>" enctype="multipart/form-data">
                                                        <input type="hidden" name="action" value="create_issuebook">
                                                        <label class="form-label">Book ID</label>
                                                        <input type="text" name="BookId" id="BookId" class="form-control" placeholder="Enter fullname" required/>
                                                </div>
                                            </div>
                                            <div class="col-xxl-3 col-lg-3 col-sm-4 col-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Student ID</label>
                                                    <input type="text" class="form-control" name="StudentId" id="StudentId" placeholder="Enter email address" required />
                                                </div>
                                            </div>
                                            <div class="mb-3 mt-3">
                                        <div id="alert-container">
                                        </div>
                                    </div>
                                        </div>
                                    </div>
                                    <!-- Row end -->
                                    <hr />
                                    <!-- Row start -->
                                    <div class="row gx-3">
                                        <div class="col-xxl-12">
                                            <div class="d-flex gap-2 justify-content-end">
                                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                    Cancel
                                                </button>
                                                <button type="button" id="create-now" class="btn btn-success">
                                                    Submit
                                                </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Row end -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Row end -->
                </div>
        </div>
        </section>
    </div>


    <?php
    require_once('../layouts/Footer.php');
    ?>
    <script>
        $(document).ready(function() {
            $('#create-now').on('click', function() {
                // Get the form element
                var form = $('#create-issuebook-form')[0];
                $('#create-issuebook-form')[0].reportValidity();

                // Check form validity
                if (form.checkValidity()) {
                    // Get the value of ReturnDate and format it as YYYY-MM-DD
                    // var returnDate = $('#ReturnDate').val();
                    // var formattedReturnDate = returnDate.split('-').reverse().join('-');

                    // Create a FormData object
                    var formData = new FormData($('#create-issuebook-form')[0]); // Set the formatted ReturnDate in the formData
                    // formData.set('ReturnDate', formattedReturnDate);


                    // Perform AJAX request
                    $.ajax({
                        url: $('#create-issuebook-form').attr('action'),
                        type: 'POST',
                        data: formData,
                        contentType: false, // Don't set content type
                        processData: false, // Don't process the data
                        dataType: 'json',
                        success: function(response) {
                            showAlert(response.message, response.success ? 'primary' : 'red');
                            if (response.success) {
                                setTimeout(function() {
                                    location.reload();
                                }, 2000);
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
                    showAlert(message, 'light');
                }
            });

        });
    </script>