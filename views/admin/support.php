<?php
require_once('../layouts/Header.php');
require_once __DIR__ . '/../../models/Message.php';

$sm = AppManager::getSM();
$error = $sm->getAttribute("error");

$messageModel = new Message();
$messages = $messageModel->getAll();

$currentUrl = $_SERVER['SCRIPT_NAME'];

// Extract the last filename from the URL
$currentFilename = basename($currentUrl);  // e.g., "dashboard.php"
?>


<div class="content-wrapper-scroll">

<!-- Main header starts -->
<div class="main-header d-flex align-items-center justify-content-between position-relative">
    <div class="d-flex align-items-center justify-content-center">
        <div class="page-icon">
            <i class="bi bi-code-square"></i>
        </div>
        <div class="page-title d-none d-md-block">
            <h5>Support</h5>
        </div>
    </div>

</div>
<!-- Main header ends -->

<div class="content-wrapper">
	<div class="subscribe-header">
	<section class="content m-3">
        <div class="container-fluid">
			<div class="row justify-content-center">
				<div class="col-xxl-10">
					<div class="card mb-5">
						<div class="card-body p-5">
							<h4 class="text-center">
								Can't find what you are looking for? Let us know!
							</h4>
							<form id="create-message-form" action="<?= url('services/ajax_functions.php') ?>" enctype="multipart/form-data">
                				<input type="hidden" name="action" value="create_message">
								<!-- Row start -->
								<div class="row justify-content-center">
									<div class="col-sm-6 col-12">
										<div class="mb-3 mt-5">
										
											<label for="Name" class="form-label">Name</label>
												<input type="text" class="form-control" name="Name" id="Name" placeholder="Enter full name" required />
										</div>
										<div class="mb-3">
											<label for="EmailId" class="form-label">Email</label>
											<input type="email" class="form-control" name="EmailId" id="EmailId" placeholder="Enter email address" required />
										</div>
										<div class="mb-3">
										<label for="Message" class="form-label">Message</label>
										<textarea class="form-control" name="Message" id="Message" placeholder="Enter message in 50 words" rows="5" required></textarea>
										</div>
										<div id="additional-fields"></div>
                    					<div class="mb-3 mt-3">
                        					<div id="alert-container">
											</div>
                    					</div>
										<div class="mb-3">
											<div class="d-flex gap-2 justify-content-end">
												<button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">
													Cancel
												</button>
												<button type="button" id="create-now" class="btn btn-success">
													Submit
												</button>
											</div>
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
					<!-- Content wrapper end -->

	</div>
	<!-- Content wrapper scroll end -->

<!-- App Footer start -->
<div class="app-footer">
<span>© Library Management System 2024</span>
</div>
<!-- App footer end -->

</div>
<!-- Main container end -->

</div>

<?php
require_once('../layouts/Footer.php');
?>

<script>
$(document).ready(function() {
	$('#create-now').on('click', function() {
	// Get the form element
	var form = $('#create-message-form')[0];
	$('#create-message-form')[0].reportValidity();

	// Check form validity
	if (form.checkValidity()) {
		// Create a FormData object
		var formData = new FormData($('#create-message-form')[0]);

		// Perform AJAX request
		$.ajax({
			url: $('#create-message-form').attr('action'),
			type: 'POST',
			data: formData,
			contentType: false, // Don't set content type
			processData: false, // Don't process the data
			dataType: 'json',
			success: function(response) {
				showAlert(response.message, response.success ? 'green' : 'red');
				if (response.success) {
					$('#createMessageModal').modal('hide');
					setTimeout(function() {
						location.reload();
					}, 3000);
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