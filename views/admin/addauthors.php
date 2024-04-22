<?php
require_once('../layouts/Header.php');
require_once __DIR__ . '/../../models/Author.php';

$sm = AppManager::getSM();
$error = $sm->getAttribute("error");

$authorModel = new Author();
$authors = $authorModel->getAll();



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
        
    <div class="row gx-3">
<div class="col-xxl-12">
<div class="card">
	<div class="card-header">
		<div class="card-title"></div>
            <form id="create-author-form" action="<?= url('services/ajax_functions.php') ?>" enctype="multipart/form-data">
                <input type="hidden" name="action" value="create_author">
                <div class="row gx-3">
					<div class="col-xxl-12">
						<div class="form-section-title p-3 mt-4 mb-3 fw-bold">
                        Author Information						
                        </div>
					</div>
                

                    <div class="col-xxl-4 col-lg-4 col-sm-4 col-12">
						<div class="mb-3">
                            <label for="AuthorName" class="form-label">Add Author</label>
                            <input type="text" id="AuthorName" name="AuthorName" class="form-control" placeholder="Enter Author" required />
                        </div>
                    </div>
					<div class="mb-3">
					<label class="form-label">Status</label>
					<div>
						<div class="form-check form-check-inline">
						<input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" checked="" />
						<label class="form-check-label" for="inlineRadio1">Active</label>
						</div>
						<div class="form-check form-check-inline">
					    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2"  />
						<label class="form-check-label" for="inlineRadio2">Inactive</label>
						</div>
					</div>
				</div>
            </div>
                    <div id="additional-fields"></div>
                    <div class="mb-3 mt-3">
                        <div id="alert-container"></div>
                    </div>
                </div>
                <div class="row gx-3">
					<div class="col-xxl-12">
						<div class="d-flex gap-2 justify-content-end">
                        <button type="button" id="create-now" class="btn btn-success">
														Submit
													</button>
													<button type="button" id="create-now" class="btn btn-red">
													</button>
												</div>
											</div>
										</div>
                <div class="row gx-3">
					<div class="col-xxl-12">
						<div class="d-flex gap-2 justify-content-end">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-red" data-bs-dismiss="modal">
                                </button>
                                <button type="button" id="create-now" class="btn btn-red"></button>
                            </div>
                        </div>
                    </div>
                </div>
                                </div>

            </form>
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
            var form = $('#create-author-form')[0];
            $('#create-author-form')[0].reportValidity();

            // Check form validity
            if (form.checkValidity()) {
                // Create a FormData object
                var formData = new FormData($('#create-author-form')[0]);

                // Perform AJAX request
                $.ajax({
                    url: $('#create-author-form').attr('action'),
                    type: 'POST',
                    data: formData,
                    contentType: false, // Don't set content type
                    processData: false, // Don't process the data
                    dataType: 'json',
                    success: function(response) {
                        showAlert(response.message, response.success ? 'success' : 'red');
                        if (response.success) {
                            $('#createAuthorModal').modal('hide');
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
                showAlert(message, 'light');
            }
        });

        });
    

    

</script>

